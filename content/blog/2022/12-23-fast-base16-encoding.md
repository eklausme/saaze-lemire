---
date: "2022-12-23 12:00:00"
title: "Fast base16 encoding"
---



Given binary data, we often need to encode it as ASCII text. Email and much of the web effectively works in this manner.

A popular format for this purpose is base64. With Muła, we showed that we could achieve excellent speed using vector instructions on commodity processors ([2018](https://arxiv.org/abs/1704.00605), [2020](https://arxiv.org/abs/1910.05109)). However, base64 is a bit tricky.

A much simpler format is just base16. E.g., you just transcribe each byte into two bytes representing the value in hexadecimal notation. Thus the byte value 1 becomes the two bytes &rsquo;01&rsquo;. The byte value 255 becomes &lsquo;FF&rsquo;, and so forth. In other words, you use one byte (or one character) per &lsquo;nibble&rsquo;: a byte is made of two nibbles: the most-significant 4 bits and the least-significant 4 bits.

How could encode base16 quickly? A reasonable approach might be to use a table. You grab one byte from the input and you directly lookup the 2 bytes from the output which you immediately write out:
```C
void encode_scalar(const uint8_t *source, size_t len, char *target) {
  const uint16_t table[] = {
      0x3030, 0x3130, 0x3230, 0x3330, 0x3430, ...
      0x6366, 0x6466, 0x6566, 0x6666};
  for (size_t i = 0; i < len; i++) {
    uint16_t code = table[source[i]];
    ::memcpy(target, &code, 2);
    target += 2;
  }
}
```


It requires a 512-byte table but that is not concerning.

Could we do better?

Milosz Krajewski wrote some good-looking [C# code using vector instructions](https://github.com/MiloszKrajewski/K4os.Text.BaseX). I wrote something that should be the equivalent using x64 C++. We have both routines for 128-bit and 256-bit vectors. My code is for demonstration purposes but it is essentially correct.

The core idea is not complicated. You must grab a vector of bytes. Then you must somehow expand it out: each nibble must go into a byte. And then the magic is this: we use the fast vectorized lookup (e.g., the pshufb instruction) to look up each nibble into a 16-byte table containing the letters &lsquo;0&rsquo;, &lsquo;1&rsquo;&hellip;&rsquo;a&rsquo;, &hellip;&rsquo;f&rsquo;.

Here is the 128-bit code using Intel intrinsics:
```C
  __m128i shuf = _mm_set_epi8('f', 'e', 'd', 'c', 'b', 'a', '9', '8', '7', '6',
                              '5', '4', '3', '2', '1', '0');
  size_t i = 0;
  __m128i maskf = _mm_set1_epi8(0xf);
  for (; i + 16 <= len; i += 16) {
    __m128i input = _mm_loadu_si128((const __m128i *)(source + i));
    __m128i inputbase = _mm_and_si128(maskf, input);
    __m128i inputs4 =
        _mm_and_si128(maskf, _mm_srli_epi16(input, 4));
    __m128i firstpart = _mm_unpacklo_epi8(inputs4, inputbase);
    __m128i output1 = _mm_shuffle_epi8(shuf, firstpart);
    __m128i secondpart = _mm_unpackhi_epi8(inputs4, inputbase);
    __m128i output2 = _mm_shuffle_epi8(shuf, secondpart);
    _mm_storeu_si128((__m128i *)(target), output1);
    target += 16;
    _mm_storeu_si128((__m128i *)(target), output2);
    target += 16;
  }
```




The 256-bit code is roughly the same, with one extra instruction to shuffle the bytes to compensate for the fact that 256-bit instructions work &lsquo;per lane&rsquo; (in units of 128-bit words). [My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2022/12/23/base16.cpp).

We might therefore expect the 256-bit to be maybe twice as fast? My results on an icelake processor with GCC11:

table lookup             |0.9 GB/s                 |
-------------------------|-------------------------|
128-bit vectors          |6.4 GB/s                 |
256-bit vectors          |11 GB/s                  |


We are not quite twice as fast, but close enough. I do not find these speeds very satisfying: I expect that less naive code could be faster.

Milosz gets much poorer results in C#: the 256-bit code is barely faster than the 128-bit code, but he does some relatively complicated computation in the 256-bit code instead of just calling the 256-bit shuffle instruction (<tt>vpshufb</tt>). (I suspect that he will soon fix this issue if he can.)

Our code would work on ARM as well after minor changes. For AVX-512 or SVE, we may need different approaches. We could add both encoding and decoding.

