---
date: "2023-08-12 12:00:00"
title: "Transcoding UTF-8 strings to Latin 1 strings at 18 GB/s using AVX-512"
---



Most strings online are Unicode strings in the UTF-8 format. Other systems (e.g., Java, Microsoft) might prefer UTF-16. However, Latin 1 is still a common encoding (e.g., within JavaScript runtimes). Its relationship with Unicode is simple: Latin 1 includes the first 256 Unicode characters. It is rich enough to convert most of the standard European languages. If something is stored in Latin 1, it can be encoded using Unicode. The reverse is obviously false. Nevertheless, let us assume that you have a Unicode string in UTF-8 that you want to quickly transcode to Latin 1.

The transcoding can be done with a short routine in C:
```C
uint8_t leading_byte = data[pos]; // leading byte
if (leading_byte < 0b10000000) {
  *latin_output++ = leading_byte;
  pos++;
} else if ((leading_byte & 0b11100000) == 0b11000000) {
  *latin_output++ = (leading_byte & 1) << 6 | (data[pos + 1]);
  pos += 2;
}
```


It processes the data one byte at a time. There are two cases: ASCII bytes (one byte, one character) and two-byte characters (one leading byte, one continuation byte).

Can we do better?

We can use Single instruction, multiple data (SIMD) and specifically the advanced  SIMD instructions available on recent AMD Zen 4 and Intel Ice Lake processors: AVX-512 with VBMI2.

We can then process the data 64 bytes at a time. Using AVX-512, we lead 64 bytes. We identify the location of the ASCII bytes, the leading and the continuation bytes. These are identified using masks. We then modify the leading bytes, keeping one bit (just the least significant one) and shift it up by six positions. We then do two compression: one where we omit the continuation bytes, and one where we omit the newly transformed leading bytes. We then simply using a byte-wise logical OR, and we are done. Using Intel intrinsics, the code might look as follows:
```C
 __m512i input = _mm512_loadu_si512((__m512i *)(buf + pos));
__mmask64 ascii = _mm512_cmplt_epu8_mask(input, mask_80808080);
__mmask64 continuation = _mm512_cmplt_epi8_mask(input,
    _mm512_set1_epi8(-64));
__mmask64 leading = _kxnor_mask64(ascii, continuation);
__m512i highbits = _mm512_maskz_add_epi8(leading, input,
    _mm512_set1_epi8(62));
highbits = _mm512_slli_epi16(highbits, 6); // shift in position
input = _mm512_mask_blend_epi8(leading, input, highbits);
__m512i ascii_continuation = _mm512_maskz_compress_epi8(ascii |
    continuation, input);
__m512i ascii_leading = _mm512_maskz_compress_epi8(ascii | leading,
    input);
__m512i output = _mm512_or_si512(ascii_continuation, ascii_leading);
_mm512_storeu_epi8((__m512i*)latin_output, output);

```


Of course, we must also validate the input, and it adds some complexity, but not too much.

An anonymous reader points out to a significantly faster and simpler approach:

1. Load 64 bytes
1. Identify the leading bytes (non-continuation non-ASCII bytes) with a single comparison.
1. Test whether the leading bytes have their less significant bit set, and construct a mask with it.
1. Shift the mask by one position and set the second last bit to 1 in the contibuation bytes that are preceded by a leading byte. We can do it by subtracting 0b11000000 because we have that 0b10000000 &#8211; 0b11000000 is 0b11000000.
1. Prune all the leading bytes (non-continuation non-ASCII bytes) and write it out.


Using Intel intrinsics, the core implementation might be like so:
```C
__m512i input = _mm512_loadu_si512((__m512i *)(buf + pos));
__mmask64 leading = _mm512_cmpge_epu8_mask(input, _mm512_set1_epi8(-64));
__mmask64 bit6 = _mm512_mask_test_epi8_mask(leading, input, _mm512_set1_epi8(1));
input = _mm512_mask_sub_epi8(input, (bit6<<1) | next_bit6, input, _mm512_set1_epi8(-64));
next_bit6 = bit6 >> 63;
__mmask64 retain = ~leading;
__m512i output = _mm512_maskz_compress_epi8(retain, input);
int64_t written_out = _popcnt64(retain);
__mmask64 store_mask = (1ULL << written_out) - 1;
_mm512_mask_storeu_epi8((__m512i *)latin_output, store_mask, output);

```


I use GCC 11 on an Ice Lake server. [My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/08/11). For benchmarking, I use a French version of the Mars wikipedia entry that has been modified to fit in latin 1.

technique                |CPU cycles/byte          |instructions/byte        |
-------------------------|-------------------------|-------------------------|
conventional             |1.9                      |5.4                      |
AVX-512                  |0.3                      |0.75                     |
Faster AVX-512           |0.2                      |0.43                     |


On a 3.2 GHz processor, the AVX-512 routine reaches 12 GB/s. It is about 6 times faster than the conventional routine, and it uses 7 times fewer instructions. The faster AVX-512 routine 10 times faster than the conventional routine while using 11 times fewer instructions. It reaches 18 GB/s. It is likely faster than the RAM bandwidth which  [I estimate to be at least 15 GB/s](https://www.cs.virginia.edu/stream/ref.html), but the CPU cache bandwidth is several times higher. Keep in mind that [there are disks with a 14 GB/s bandwidth](https://www.tomshardware.com/news/phison-demos-ps5026-e26-max14um-gen5-ssd-with-a-14-gbs-read-speed).

This problem illustrates that AVX-512 can really do well on non-trivial string transformations without excessive cleverness.

__Remark__. Whenever I mention Latin 1, some people are prone to remark that browsers treat HTML pages declared as Latin 1 and ASCII as windows-1252. That is because modern web browsers do not support Latin 1 and ASCII in HTML. Even so, you should not use Latin 1, ASCII or even windows-1252 for your web pages. I recommend using Unicode (UTF-8). However, if you code in Python, Go or Node.js, and you declare a string as Latin 1, it should be Latin 1, not windows-1252. It is bug to confuse Latin 1, ASCII and windows-1252. They are different formats.

