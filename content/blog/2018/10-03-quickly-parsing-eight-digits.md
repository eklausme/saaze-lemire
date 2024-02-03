---
date: "2018-10-03 12:00:00"
title: "Quickly parsing eight digits"
---



[In my previous post](/lemire/blog/2018/09/30/quickly-identifying-a-sequence-of-digits-in-a-string-of-characters/), I described how we can quickly determine whether eight characters are made of digits (e.g., &lsquo;13223244&rsquo;). It takes a bit over 2 cycles. Suppose that you want to turn this string into an integer value.

Most programmers would implement it as a simple loop:
```C
uint32_t parse_eight_digits(const unsigned char *chars) {
  uint32_t x = chars[0] - '0';
  for (size_t j = 1; j < 8; j++)
    x = x * 10 + (chars[j] - '0');
  return x;
}
```


Can you do better?

If you are willing to use SIMD instructions through Intel intrinsics, then[ Mula has worked out as nice function that looks like this](http://0x80.pl/notesen/2014-10-15-parsing-decimal-numbers-part-2-sse.html):
```C
uint32_t parse_eight_digits_ssse3(const char *chars) {
  __m128i ascii0 = _mm_set1_epi8('0');
  __m128i mul_1_10 =
      _mm_setr_epi8(10, 1, 10, 1, 10, 1, 10, 1,
                        10, 1, 10, 1, 10, 1, 10, 1);
  __m128i mul_1_100 = _mm_setr_epi16(100, 1, 100, 1,
                       100, 1, 100, 1);
  const __m128i mul_1_10000 =
      _mm_setr_epi16(10000, 1, 10000, 1, 10000, 1, 10000, 1);
  __m128i input = _mm_sub_epi8(
               _mm_loadl_epi64((__m128i *)chars), ascii0);
  __m128i t1 = _mm_maddubs_epi16(input, mul_1_10);
  __m128i t2 = _mm_madd_epi16(t1, mul_1_100);
  __m128i t3 = _mm_packus_epi32(t2, t2);
  __m128i t4 = _mm_madd_epi16(t3, mul_1_10000);
  return _mm_cvtsi128_si32(t4);
}
```


I am not going to go through what this function does. The important point to understand about Mula&rsquo;s function is that it actually converts sixteen digits to integers. In other words, using Mula&rsquo;s function to parse eight digits, I handicap it by a factor of two, forcing it to waste a lot of effort.

Let me go straight at the speed results. I report throughput: how long it takes to parse an integer from a stream on average.

GCC 8.1 (-O3)

conventional             |3.9 cycles               |
-------------------------|-------------------------|
Mula                     |3.0 cycles               |


CLANG 6.0 (-O3)

conventional             |8.4 cycles               |
-------------------------|-------------------------|
Mula                     |3.2 cycles               |


So despite the handicap that MuÅ‚a&rsquo;s function has, it is still considerably faster than the conventional code. If I could parse pairs of eight digits instead of individual sets of eight digits, I could go nearly twice as fast.

I do not benchmark the latency. The latency story could be less positive for the MuÅ‚a&rsquo;s function which relies on instructions that have high throughput but also high latency.

Some of you might be thinking that there is surely a way to go faster, or, at least, to get rid of the need for Intel intrinsic functions. I tried to pull the same SIMD-within-a-register (SWAR) trick as in my previous post, but the best I could do was only barely faster than the conventional approach. To get it down to Mula&rsquo;s speed, I would need shave another two cycles from it. I think it is possible. Here is the best I have so far using the SWAR approach:
```C
uint32_t parse_eight_digits_swar(const char *chars) {
  uint64_t val;
  memcpy(&val, chars, 8);
  val = val - 0x3030303030303030;
  uint64_t byte10plus   = ((val
      * (1 + (0xa  <<  8))) >>  8)
      & 0x00FF00FF00FF00FF;
  uint64_t short100plus = ((byte10plus
       * (1 + (0x64 << 16))) >> 16)
       & 0x0000FFFF0000FFFF;
  short100plus *= (1 + (10000ULL << 32));
  return short100plus >> 32;
}
```


At a glance, I repeat the sequence (multiplication, shift, mask) three times to aggregate eight digits. To go to 2<sup><em>N</em></sup> digits, I would need _N_ such sequences. That is, I have a logarithmic-time algorithm that is limited by the size of my registers. It is good, but the fact that each step depends on the completion of the previous step is less good: it means that the latency is relatively high.

[My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/10/03).

__Credit__: My SWAR function is an extension to eight digits of [related functions](http://0x80.pl/notesen/2014-10-12-parsing-decimal-numbers-part-1-swar.html) by Mula on shorter sequences of digits. It was improved by Travis Downs who pointed out that we do not need to swap the bytes.

__Update__: [There is a better SWAR function described in a more recent blog post](/lemire/blog/2022/01/21/swar-explained-parsing-eight-digits/).

