---
date: "2018-01-09 12:00:00"
title: "How fast can you bit-interleave 32-bit integers? (SIMD edition)"
---



In a [previous post](/lemire/blog/2018/01/08/how-fast-can-you-bit-interleave-32-bit-integers/), I asked how fast one could interleave the bits between two 32-bit integers. That is, given 0b1011 (11 in decimal) and 0b1100 (12 in decimal), I want the number 0b11011010.

On recent (2013) Intel processors, the answer is that you process one pair of integers every two cycles using the `pdep` instruction. Deinterleaving can be done just as quickly using the `pext` instruction.

There are a few downsides to relying on the `pdep` instruction:

- It is only available on recent x64 processors.
- It is very slow on even the most recent AMD processors.


What else can we do? We can vectorize the processing. Recent x64 processors support the AVX2 instruction set. Vector instructions tend to get better over time. For example, we can expect future processors to include wider instructions (AVX-512 on x64 processors and ARM SVE). So vectorization is a good long-term investment.

For the most part, the approach I have taken is derived from the scalar approach. That is, we start by interleaving each element of the pair with zeros&hellip;
```C
uint64_t interleave_uint32_with_zeros(uint32_t input)  {
    uint64_t word = input;
    word = (word ^ (word << 16)) & 0x0000ffff0000ffff;
    word = (word ^ (word << 8 )) & 0x00ff00ff00ff00ff;
    word = (word ^ (word << 4 )) & 0x0f0f0f0f0f0f0f0f;
    word = (word ^ (word << 2 )) & 0x3333333333333333;
    word = (word ^ (word << 1 )) & 0x5555555555555555;
    return word;
}
```


And then we put the result back together, shifting one of the by one bit&hellip;
```C
interleave_uint32_with_zeros(x) 
  | (interleave_uint32_with_zeros(y) << 1);
```


With vector instructions, we can skip part of the processing because it is easy to shuffle bytes (with the `_mm256_shuffle_epi8` intrinsic). I need to credit Geoff Langdale because I was initially, stupidly, trying to shuffle the bytes with shifts as in the scalar code. Otherwise, the code is very similar, except that it relies on intrinsics.
```C
__m256i interleave_uint8_with_zeros_avx(__m256i word) {
  const __m256i m3 = _mm256_set1_epi64x(0x0f0f0f0f0f0f0f0f);
  const __m256i m4 = _mm256_set1_epi64x(0x3333333333333333);
  const __m256i m5 = _mm256_set1_epi64x(0x5555555555555555);
  word = _mm256_xor_si256(word, _mm256_slli_epi16(word, 4));
  word = _mm256_and_si256(word, m3);
  word = _mm256_xor_si256(word, _mm256_slli_epi16(word, 2));
  word = _mm256_and_si256(word, m4);
  word = _mm256_xor_si256(word, _mm256_slli_epi16(word, 1));
  word = _mm256_and_si256(word, m5);
  return word;
}

void interleave_avx2(uint32_2 *input, uint64_t *out) {
  __m256i xy = _mm256_lddqu_si256((const __m256i *)input);
  __m256i justx = _mm256_shuffle_epi8(
      xy, _mm256_set_epi8(-1, 11, -1, 10, -1, 9, -1, 8,
            -1, 3, -1, 2, -1, 1, -1, 0, -1, 11, -1, 10,
            -1, 9, -1, 8, -1, 3, -1, 2, -1, 1,-1, 0));
  __m256i justy = _mm256_shuffle_epi8(
      xy, _mm256_set_epi8(-1 15, -1, 14, -1, 13, -1, 12, 
             -1, 7, -1, 6, -1, 5, -1, 4, -1, 15, -1, 14, -1, 
             -1, 13, -1, 12, -1, 7, -1, 6, -1, 5, -1, 4));
  justx = interleave_uint8_with_zeros_avx(justx);
  justy = interleave_uint8_with_zeros_avx(justy);
  __m256i answer = _mm256_or_si256(justx, 
            _mm256_slli_epi16(justy, 1));
  _mm256_storeu_si256((__m256i *)out, answer);
}
```


Is this the best you can do? Kendall Willets commented that you can use a look-up for the interleave. Let us put this to good use:
```C
__m256i interleave_uint8_with_zeros_avx_lut(__m256i word) {
  const __m256i m = _mm256_set_epi8(85, 84, 81, 80, 69, 68,
               65, 64, 21, 20, 17, 16, 5, 4, 1, 0, 85, 84, 
               81, 80, 69, 68, 65, 64, 21, 20, 17, 16, 5, 
               4, 1, 0);
  __m256i lownibbles =
      _mm256_shuffle_epi8(m, _mm256_and_si256(word,
            _mm256_set1_epi8(0xf)));
  __m256i highnibbles = _mm256_and_si256(word, 
          _mm256_set1_epi8(0xf0));
   highnibbles = _mm256_srli_epi16(highnibbles,4);
   highnibbles = _mm256_shuffle_epi8(m, highnibbles);
   highnibbles =  _mm256_slli_epi16(highnibbles, 8);
  return _mm256_or_si256(lownibbles,highnibbles);
}
```


So how well does it do?

shifts                   |3.6 cycles               |
-------------------------|-------------------------|
pdep                     |2.1 cycles               |
SIMD                     |2.2 cycles               |
SIMD (with lookup)       |1.6 cycles               |


So, roughly speaking, the vector code is just as fast as the code using the `pdep` instruction on my Skylake processor. I have not tested it on an AMD processor, but it should run fine (although maybe not as efficiently).

You can improve slightly the performance (down to 2.1 cycles) at the expense of using about twice as much code if you use an idea Geoff offered: save the final shift by using two-interleaving-with-zeros functions.

When you use table lookups, the interleave the nibbles, then the vectorized code is clearly faster than the `pdep` instruction.

It could probably be ported to ARM NEON, but I am not sure it would be efficient on current ARM processors because they only have 128-bit vector registers. Moreover, ARM processors can do the XOR and the shift operation in a single instruction.

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/01/09).

(This post was updated with better results.)

Further reading: [Geohash in Golang Assembly](https://mmcloughlin.com/posts/geohash-assembly)

