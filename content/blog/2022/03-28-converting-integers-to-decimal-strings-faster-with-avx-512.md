---
date: "2022-03-28 12:00:00"
title: "Converting integers to decimal strings faster with AVX-512"
---



In most systems, integers are stored using a fixed binary representation. It is common to store integers using 32-bit or 64-bit words. You sometimes need to convert it to a string. For example, the integer 12345 might need to be converted to the five characters &lsquo;12345&rsquo;.

In an [earlier blog post](/lemire/blog/2021/11/18/converting-integers-to-fix-digit-representations-quickly/), I presented the simpler problem of converting integers to fixed-digit strings, using exactly 16-characters with leading zeroes as needed. For example, the integer 12345 becomes the string &lsquo;0000000000012345&rsquo;.

For this problem, the most practical approach might be a tree-based version with a small table. The core idea is to start from the integer, compute an integer representing the 8 most significant decimal digits, and another integer representing the least significant 8 decimal digit. Then we repeat, dividing the two eight-digit integers into two four-digit integers, and so forth until we get to two-digit integers in which case we use a small table to convert them to a decimal representation. The code in C++ might look as follows:
```C
void to_string_tree_table(uint64_t x, char *out) {
  static const char table[200] = {
      0x30, 0x30, 0x30, 0x31, 0x30, 0x32, 0x30, 0x33, 0x30, 0x34, 0x30, 0x35,
      0x30, 0x36, 0x30, 0x37, 0x30, 0x38, 0x30, 0x39, 0x31, 0x30, 0x31, 0x31,
      0x31, 0x32, 0x31, 0x33, 0x31, 0x34, 0x31, 0x35, 0x31, 0x36, 0x31, 0x37,
      0x31, 0x38, 0x31, 0x39, 0x32, 0x30, 0x32, 0x31, 0x32, 0x32, 0x32, 0x33,
      0x32, 0x34, 0x32, 0x35, 0x32, 0x36, 0x32, 0x37, 0x32, 0x38, 0x32, 0x39,
      0x33, 0x30, 0x33, 0x31, 0x33, 0x32, 0x33, 0x33, 0x33, 0x34, 0x33, 0x35,
      0x33, 0x36, 0x33, 0x37, 0x33, 0x38, 0x33, 0x39, 0x34, 0x30, 0x34, 0x31,
      0x34, 0x32, 0x34, 0x33, 0x34, 0x34, 0x34, 0x35, 0x34, 0x36, 0x34, 0x37,
      0x34, 0x38, 0x34, 0x39, 0x35, 0x30, 0x35, 0x31, 0x35, 0x32, 0x35, 0x33,
      0x35, 0x34, 0x35, 0x35, 0x35, 0x36, 0x35, 0x37, 0x35, 0x38, 0x35, 0x39,
      0x36, 0x30, 0x36, 0x31, 0x36, 0x32, 0x36, 0x33, 0x36, 0x34, 0x36, 0x35,
      0x36, 0x36, 0x36, 0x37, 0x36, 0x38, 0x36, 0x39, 0x37, 0x30, 0x37, 0x31,
      0x37, 0x32, 0x37, 0x33, 0x37, 0x34, 0x37, 0x35, 0x37, 0x36, 0x37, 0x37,
      0x37, 0x38, 0x37, 0x39, 0x38, 0x30, 0x38, 0x31, 0x38, 0x32, 0x38, 0x33,
      0x38, 0x34, 0x38, 0x35, 0x38, 0x36, 0x38, 0x37, 0x38, 0x38, 0x38, 0x39,
      0x39, 0x30, 0x39, 0x31, 0x39, 0x32, 0x39, 0x33, 0x39, 0x34, 0x39, 0x35,
      0x39, 0x36, 0x39, 0x37, 0x39, 0x38, 0x39, 0x39,
  };
  uint64_t top = x / 100000000;
  uint64_t bottom = x % 100000000;
  uint64_t toptop = top / 10000;
  uint64_t topbottom = top % 10000;
  uint64_t bottomtop = bottom / 10000;
  uint64_t bottombottom = bottom % 10000;
  uint64_t toptoptop = toptop / 100;
  uint64_t toptopbottom = toptop % 100;
  uint64_t topbottomtop = topbottom / 100;
  uint64_t topbottombottom = topbottom % 100;
  uint64_t bottomtoptop = bottomtop / 100;
  uint64_t bottomtopbottom = bottomtop % 100;
  uint64_t bottombottomtop = bottombottom / 100;
  uint64_t bottombottombottom = bottombottom % 100;
  //
  memcpy(out, &table[2 * toptoptop], 2);
  memcpy(out + 2, &table[2 * toptopbottom], 2);
  memcpy(out + 4, &table[2 * topbottomtop], 2);
  memcpy(out + 6, &table[2 * topbottombottom], 2);
  memcpy(out + 8, &table[2 * bottomtoptop], 2);
  memcpy(out + 10, &table[2 * bottomtopbottom], 2);
  memcpy(out + 12, &table[2 * bottombottomtop], 2);
  memcpy(out + 14, &table[2 * bottombottombottom], 2);
}
```


It compiles down to dozens of instructions.

Could you do better without using a much larger table?

It turns out that you can do much better if you have a recent Intel processor with the appropriate AVX-512 instructions (IFMA, VBMI), as demonstrated by an Internet user called InstLatX64.

We rely on the observation that you can compute directly the quotient and the remainder of the division using a series of multiplications and shifts ([Lemire et al. 2019](https://arxiv.org/abs/1902.01961)).

The code is a bit technical, but remarkably, it does not require a table. And it generates several times fewer instructions. For the sake of simplicity, I merely provide an implementation using Intel intrinsics. Importantly, you are not expected to follow through with the code, but you should notice that it is rather short.
```C
void to_string_avx512ifma(uint64_t n, char *out) {
  uint64_t n_15_08  = n / 100000000;
  uint64_t n_07_00  = n % 100000000;
  __m512i bcstq_h   = _mm512_set1_epi64(n_15_08);
  __m512i bcstq_l   = _mm512_set1_epi64(n_07_00);
  __m512i zmmzero   = _mm512_castsi128_si512(_mm_cvtsi64_si128(0x1A1A400));
  __m512i zmmTen    = _mm512_set1_epi64(10);
  __m512i asciiZero = _mm512_set1_epi64('0');

  __m512i ifma_const	= _mm512_setr_epi64(0x00000000002af31dc, 0x0000000001ad7f29b, 
    0x0000000010c6f7a0c, 0x00000000a7c5ac472, 0x000000068db8bac72, 0x0000004189374bc6b,
    0x0000028f5c28f5c29, 0x0000199999999999a);
  __m512i permb_const	= _mm512_castsi128_si512(_mm_set_epi8(0x78, 0x70, 0x68, 0x60, 0x58,
    0x50, 0x48, 0x40, 0x38, 0x30, 0x28, 0x20, 0x18, 0x10, 0x08, 0x00));
  __m512i lowbits_h	= _mm512_madd52lo_epu64(zmmzero, bcstq_h, ifma_const);
  __m512i lowbits_l	= _mm512_madd52lo_epu64(zmmzero, bcstq_l, ifma_const);
  __m512i highbits_h	= _mm512_madd52hi_epu64(asciiZero, zmmTen, lowbits_h);
  __m512i highbits_l	= _mm512_madd52hi_epu64(asciiZero, zmmTen, lowbits_l);
  __m512i perm          = _mm512_permutex2var_epi8(highbits_h, permb_const, highbits_l);
  __m128i digits_15_0	= _mm512_castsi512_si128(perm);
  _mm_storeu_si128((__m128i *)out, digits_15_0);
}
```


Remarkably, the AVX-512 is 3.5 times faster than the table-based approach:

function                 |time per conversion      |
-------------------------|-------------------------|
table                    |8.8 ns                   |
AVX-512                  |2.5 ns                   |


I use GCC 9 and an Intel [Tiger Lake](https://en.wikipedia.org/wiki/Tiger_Lake) processor  (3.30GHz). [My benchmarking code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2022/03/24).

A downside of this nifty approach is that it is (obviously) non-portable. There are still few Intel processors supporting these nifty extensions, and it is currently limited to Intel: no AMD or ARM processor can do the same right now. However, the gain might be sufficient that it is worth the effort deploying it in some instances.

&nbsp;

