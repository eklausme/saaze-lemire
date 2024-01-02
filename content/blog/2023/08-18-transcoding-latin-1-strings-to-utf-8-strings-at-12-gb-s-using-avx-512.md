---
date: "2023-08-18 12:00:00"
title: "Transcoding Latin 1 strings to UTF-8 strings at 18 GB/s using AVX-512"
---



Though most strings online today follow the Unicode standard (e.g., using UTF-8), the Latin 1 standard is still in widespread inside some systems (such as browsers) as JavaScript strings are often stored as either Latin 1, UTF-8 or UTF-16 internally. Latin 1 captures the first 256 characters from the Unicode standard and represents them as a single byte per character.

In a previous [blog post](/lemire/blog/2023/08/12/transcoding-utf-8-strings-to-latin-1-strings-at-12-gb-s-using-avx-512/), we examined how we could convert UTF-8 strings to Latin 1. I want to examine the reverse problem, the transcoding of Latin 1 strings to UTF-8. We receive a byte array, and each byte is one character. There is no need for any validation. However, some characters (the ASCII characters) are mapped to one byte whereas all others should be mapped to two bytes.

You can code it in C using code such as this routine:
```C
 unsigned char byte = data[pos];
if ((byte & 0x80) == 0) { // if ASCII
  // will generate one UTF-8 byte
  *utf8_output++ = (char)(byte);
  pos++;
} else {
  // will generate two UTF-8 bytes
  *utf8_output++ = (char)((byte >> 6) | 0b11000000);
  *utf8_output++ = (char)((byte & 0b111111) | 0b10000000);
  pos++;
}

```


Can we do better using the new AVX-512 instructions available on recent Intel (e.g. Ice Lake) and AMD (e.g., Zen4) processors?

We can try to do it as follows:

1. Load 32 bytes into a register.
1. Identify all the non-ASCII bytes (they have the most significant bit set to 1).
1. Identify the bytes that have their two most significant bits set by comparing with 192.
1. Cast all bytes to 16-bit words into a 64-byte register.
1. Add 0xc200 to all 16-bit words, as the most significant byte in a 16-bit word must be either 0xc2 or 0xc3.
1. Add 0x00c0 to the 16-bit words where the corresponding byte had its two most significant bit set, this will move up a bit value so that the most signficant byte may become 0xc3.
1. Flip the order of the bytes within each 16-bit word since UTF-8 is big endian.
1. Remove one byte (&lsquo;compress&rsquo;) where we had an ASCII byte.
1. Store the result (can be between 32 bytes and 64 bytes).


Using Intel intrinsics, the result might look as follows:
```C
__m256i input = _mm256_loadu_si256((__m256i *)(buf + pos));
__mmask32 nonascii = _mm256_movepi8_mask(input);
int output_size = 32 + _popcnt32(nonascii);
uint64_t compmask = ~_pdep_u64(~nonascii, 0x5555555555555555);
__mmask32 sixth =
_mm256_cmpge_epu8_mask(input, _mm256_set1_epi8(192));
__m512i input16 = _mm512_cvtepu8_epi16(input);
input16 =_mm512_add_epi16(input16, _mm512_set1_epi16(0xc200));
__m512i output16 =
_mm512_mask_add_epi16(input16, sixth, input16,
_mm512_set1_epi16(0x00c0));
output16 = _mm512_shuffle_epi8(output16, byteflip);
__m512i output = _mm512_maskz_compress_epi8(compmask, output16);

```


Our AVX-512 registers can load and process 64 bytes at a time, but this approach  consumes only 32 bytes (instead of 64 bytes). An anonymous reader has contributed a better approach:

- Load 64 bytes into a register.
- Identify all the non-ASCII bytes (they have the most significant bit set to 1).
- Identify the bytes that have their two most significant bits set by comparing with 192.
- Create a &lsquo;compression&rsquo; mask where ASCII characters correspond to 01 whereas non-ASCII characters correspond to 11: we need to distinct 64-bit masks.
- We use the vpshldw instruction (instead of the vpmovzxbw instruction) to upscale the bytes to 16-bit value, adding the 0b11000000 leading byte in the process. We adjust for the bytes that have their two most significant bits. This takes care of the first 32 bytes, assuming we interleaved the bytes.
- The second part (next 32 bytes) are handled with bitwise logical operations.
- We save two blocks of 32 bytes.


&nbsp;

The code using AVX-512 intrinsics might look at follows:
```C
__mmask32 nonascii = _mm256_movepi8_mask(input);
__mmask64 sixth =
_mm512_cmpge_epu8_mask(input, _mm512_set1_epi8(-64));
const uint64_t alternate_bits = UINT64_C(0x5555555555555555);
uint64_t ascii = ~nonascii;
uint64_t maskA = ~_pdep_u64(ascii, alternate_bits);
uint64_t maskB = ~_pdep_u64(ascii>>32, alternate_bits);
// interleave bytes from top and bottom halves (abcd...ABCD -> aAbBcCdD)
__m512i input_interleaved = _mm512_permutexvar_epi8(_mm512_set_epi32(
0x3f1f3e1e, 0x3d1d3c1c, 0x3b1b3a1a, 0x39193818,
0x37173616, 0x35153414, 0x33133212, 0x31113010,
0x2f0f2e0e, 0x2d0d2c0c, 0x2b0b2a0a, 0x29092808,
0x27072606, 0x25052404, 0x23032202, 0x21012000
), input);
// double size of each byte, and insert the leading byte
__m512i outputA = _mm512_shldi_epi16(input_interleaved, _mm512_set1_epi8(-62), 8);
outputA = _mm512_mask_add_epi16(outputA, (__mmask32)sixth, outputA, _mm512_set1_epi16(1 - 0x4000));
__m512i leadingB = _mm512_mask_blend_epi16((__mmask32)(sixth>>32), _mm512_set1_epi16(0x00c2), _mm512_set1_epi16(0x40c3));
__m512i outputB = _mm512_ternarylogic_epi32(input_interleaved, leadingB, _mm512_set1_epi16((short)0xff00), (240 & 170) ^ 204); // (input_interleaved & 0xff00) ^ leadingB
// prune redundant bytes
outputA = _mm512_maskz_compress_epi8(maskA, outputA);
outputB = _mm512_maskz_compress_epi8(maskB, outputB);

```


It is possible to do even better if you expect that the input is often ASCII or contains few non-ASCII bytes. You can branch on the case where a sequence of 64-bit is all ASCII and use a fast path in this case: trivially, we just store the 64 bytes we just read, as is.

I use GCC 11 on an Ice Lake server. [My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/08/18). For benchmarking, I use a French version of the Mars wikipedia entry.

technique                |CPU cycles/byte          |instructions/byte        |
-------------------------|-------------------------|-------------------------|
conventional             |1.7                      |5.0                      |
AVX-512 (32 bytes)       |0.26                     |0.77                     |
AVX-512 (64 bytes)       |0.21                     |0.54                     |
AVX-512 (64 bytes+branch) |0.17                     |0.45                     |


On a 3.2 GHz processor, the 32-byte AVX-512 routine reaches 12 GB/s. It is nearly seventimes faster than the conventional routine, and it uses six times fewer instructions. The approach consuming 64 bytes is faster than 14 GB/s, and the version with an ASCII branch breaks the 18 GB/s limit.

[This server has memory bandwidth of at least 15 GB/s](https://www.cs.virginia.edu/stream/ref.html), but the CPU cache bandwidth is several times higher. [There are disks with bandwidths of over 10 GB/s](https://www.tomshardware.com/news/phison-demos-ps5026-e26-max14um-gen5-ssd-with-a-14-gbs-read-speed).

__Remark__. Whenever I mention Latin 1, some people are prone to remark that browsers treat HTML pages declared as Latin 1 and ASCII as windows-1252. That is because modern web browsers do not support Latin 1 and ASCII in HTML. Even so, you should not use Latin 1, ASCII or even windows-1252 for your web pages. I recommend using Unicode (UTF-8). However, if you code in Python, Go or Node.js, and you declare a string as Latin 1, it should be Latin 1, not windows-1252. It is bug to confuse Latin 1, ASCII and windows-1252. They are different formats.

