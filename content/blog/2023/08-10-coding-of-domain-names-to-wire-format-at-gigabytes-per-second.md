---
date: "2023-08-10 12:00:00"
title: "Coding of domain names to wire format at gigabytes per second"
---



When you enter in your browser the domain name <tt>lemire.me</tt>, it eventually gets encoded into a so-called wire format. The name <tt>lemire.me</tt> contains two labels, one of length 6 (<tt>lemire</tt>) and one of length two (<tt>me</tt>). The wire format starts with <tt><em>6</em>lemire<em>2</em>me</tt>: that is, imagining that the name starts with an imaginary dot, all dots are replaced by the length (in bytes) of the upcoming label. The numbers are stored as byte values, not ASCII digits. There is also a final zero byte. [RFC 1035 specifies the format](https://www.rfc-editor.org/rfc/rfc1035):

> Each label is represented as a one octet length field followed by that number of octets. Since every domain name ends with the null label of the root, a domain name is terminated by a length byte of zero. The high order two bits of every length octet must be zero, and the remaining six bits of the length field limit the label to 63 octets or less. To simplify implementations, the total length of a domain name (i.e., label octets and label length octets) is restricted to 255 octets or less.


I find the problem interesting because the wire format is an &ldquo;indexed&rdquo; format: you can easily iterate over the labels, jumping in constant time over them, knowing the exact length, and so forth. Thus, coding strings into the wire format is a form of indexing.

How quickly can we do it?

You can use conventional code to convert the name to the wire format. You copy non-dot characters and when you encounter a dot, you write the distance to the previous dot (imagining that there is a virtual first dot). In C, it might look as follows (omitting the final zero byte):
```C
 char *src = "lemire.me";
 uint8_t *dst = ...; // buffer
 uint8_t *counter = dst++;
 do {
   while (is_name_character(*src)) {
    *dst++ = (uint8_t)*src; src++;
  }
  *counter = (uint8_t)(dst - counter - 1);
  counter = dst++;
  if (*src != '.') { break; }
  src++;
 } while (true);

```


Can you do better?

You can use Single instruction, multiple data (SIMD) instructions. You load 16, 32 or 64 characters in wide register. You locate the dots. You construct a new register where the dots are replaced by position indexes and everything else is zeroed. E.g., starting with
```C
.a.bcde.
```


You mark the location of the dots:
```C
0 0 0xff 0 0 0 0 0xff
```


You compute the byte-wise AND with the following constant:
```C
0 1 2 3 4 5 6 7
```


and you get an array where the dots have been replaced by indexes&hellip;
```C
0 0 2 0 0 0 0 7
```


You then do a prefix computation, propagating the values:
```C
0 2 2 7 7 7 7 7
```


This can be done using a logarithmic algorithm: shifting the values off by 1 byte, comparing, shifting the values off by 2 bytes, comparing, and so forth.

Finally, we can shift by one and subtract the result. Masking off the result so that we are only keeping where the dots are, we get the desired counts:
```C
2 - 5 - - - - 0
```


You can then blend the results:
```C
2 a 5 b c d e 0
```


If you use Intel intrinsics, the code might look like this&hellip; It is a bit technical so I am not going to explain it further, but the idea is as I explained&hellip;
```C
__m128i dot_to_counters(__m128i input) {
  __m128i dots = _mm_cmpeq_epi8(input, _mm_set1_epi8('.'));
  __m128i sequential =
_mm_setr_epi8(-128, -127, -126, -125, -124, -123, -122, -121, -120, -119,
-118, -117, -116, -115, -114, -113);
  __m128i dotscounts = _mm_and_si128(dots, sequential);
  __m128i origdotscounts = dotscounts;
  dotscounts = _mm_min_epi8(_mm_alignr_epi8(zero, dotscounts, 1),
    dotscounts);
  dotscounts = _mm_min_epi8(_mm_alignr_epi8(zero, dotscounts, 2),
    dotscounts);
  dotscounts = _mm_min_epi8(_mm_alignr_epi8(zero, dotscounts, 4),
    dotscounts);
  dotscounts = _mm_min_epi8(_mm_alignr_epi8(zero, dotscounts, 8),
    dotscounts);
  __m128i next = _mm_alignr_epi8(_mm_setzero_si128(), dotscounts, 1);
  dotscounts = _mm_subs_epu8(next, origdotscounts);
  dotscounts = _mm_subs_epu8(dotscounts, _mm_set1_epi8(1));
  return _mm_blendv_epi8(input, dotscounts, dots);
}

```


I call this strategy  &ldquo;Prefix-Minimum&rdquo;. It is essentially data independent. It does not matter where the dots are, the code is always the same. Processors like that a lot!

Prefix-Minimum will be fast, especially if you use wide registers (e.g., 32 bytes with AVX2 instructions). However, it does not offer a direct path to validating the inputs: are the counters in the proper range? Do you have overly long labels?

If you need to reason about where the dots are, the best way is probably to build an index in the spirit of the [simdjson library](https://simdjson.org) (our [original paper is available as PDF](https://arxiv.org/abs/1902.08318)). For example, you can load 64 bytes of data, and construct a 64-bit word where each bit correspond to a byte value, and the byte is set to 1 if the corresponding byte is a dot (&lsquo;.&rsquo;), you can then iterate through the bits, as a bitset. The construction of the 64-bit word might look as follows using Intel instructions and AVX2:
```C
__m256i input1 = _mm256_loadu_si256((const __m256i *)src);
__m256i input2 = _mm256_loadu_si256((const __m256i *)(src + 32));
uint32_t dots1 = (uint32_t)_mm256_movemask_epi8(
_mm256_cmpeq_epi8(input1, _mm256_set1_epi8('.')));
uint32_t dots2 = (uint32_t)_mm256_movemask_epi8(
_mm256_cmpeq_epi8(input2, _mm256_set1_epi8('.')));
uint64_t DOTS = (((uint64_t)dots2) << 32) | dots1;
```


I implemented different strategies using AVX2 intrinsics. We can use [a database of popular domain names](https://s3-us-west-1.amazonaws.com/umbrella-static/index.html) for testing. Results vary depending on the system. I use GCC 11 and an Ice Lake server.

technique                |CPU cycles/string        |instructions/string      |
-------------------------|-------------------------|-------------------------|
conventional             |150                      |240                      |
Prefix-Minimum (256 bits) |44                       |77                       |
simdjson-like (256 bits) |56                       |77                       |


[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/08/09).

The Prefix-Minimum approach is fastest. Observe how the Prefix-Minimum approach is faster than the simdjson-like approach, despite executing the same number of instructions. That is because it is able to retire more instructions per cycle. The downside of the Prefix-Minimum approach is that it does not validate the label length.

The simdjson-like approach does full validation and is still quite fast: over three times faster than the conventional approach. It is sufficient to break the gigabyte per second barrier (1.7 GB/s in these experiments).

Being able to validate the counter values with the Prefix-Minimum without adding too much overhead would be fantastic: it might be possible to get the best speed without compromising on the validation. It remains an open problem whether it is possible.

I suspect that my implementations can be improved, by at least 20%.

Future work should consider AVX-512. I have the sketch of an implementation using AVX-512 but it is not faster. Porting to ARM NEON would be interesting.

__Credit__: The work was motivated by the simdzone project by NLnetLabs.

