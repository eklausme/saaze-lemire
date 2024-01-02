---
date: "2023-02-16 12:00:00"
title: "Computing the UTF-8 size of a Latin 1 string quickly (AVX edition)"
---



Computers represent strings using bytes. Most often, we use the Unicode standard to represent characters in bytes. The universal format to exchange strings online is called UTF-8. It can represent over a million characters while retaining compatibility with the ancient ASCII format.

Though most of our software stack has moved to Unicode strings, there are still older standards like Latin 1 used for European strings. Thus we often need to convert Latin 1 strings to UTF-8. JavaScript strings are often stored as either Latin 1, UTF-8 or UTF-16 internally. It is useful to first compute the size (in bytes) of the eventual UTF-8 strings.

Thanfully, it is an easy problem: it suffices to count two output bytes for each input byte having the most significant bit set, and one output byte for other bytes. A relatively simple C++ function suffices:
```C
size_t scalar_utf8_length(const char * c, size_t len) {
  size_t answer = 0;
  for(size_t i = 0; i<len; i++) {
    if((c[i]>>7)) { answer++;}
  }
  return answer + len;
}

```


To go faster, we may want to use fancy &ldquo;SIMD&rdquo; instructions: instructions that process several bytes at once. Your compiler is likely to already do some autovectorization with the simple C function. At compile-time, it will use some SIMD instructions. However, you can try to do hand-code your own version.

We have several instruction sets to choose from, but let us pick the AVX2 instruction sets, available on most x64 processors today. AVX2 has a fast mask function that can extract all the most significant bits, and then another fast function that can count them (popcount). Thus the following routine should do well (credit to Anna Henningsen):
```C
size_t avx2_utf8_length_basic(const uint8_t *str, size_t len) {
  size_t answer = len / sizeof(__m256i) * sizeof(__m256i);
  size_t i;
  for (i = 0; i + sizeof(__m256i) <= len; i += 32) {
    __m256i input = _mm256_loadu_si256((const __m256i *)(str + i));
   answer += __builtin_popcount(_mm256_movemask_epi8(input));
  }
  return answer + scalar_utf8_length(str + i, len - i);
}

```


Can you do better? On Intel processors, both the &lsquo;movemask&rsquo; and population count instructions are fast, but they have some latency: it takes several cycles for them to execute. They may also have additional execution constraints. Part of the latency and constraints is not going to get better with instruction sets like AVX-512 because it requires moving from SIMD registers to general registers at every iterations. It will similarly be a bit of challenge to port this routine to ARM processors.

Thus we would like to rely on cheaper instructions, and stay in SIMD registers until the end. Even if it does not improve the speed of the AVX code, it may work better algorithmically with other instruction sets.

For this purpose, we can borrow a recipe from the paper [Faster Population Counts Using AVX2 Instructions](https://arxiv.org/pdf/1611.07612.pdf) (Computer Journal 61 (1), 2018). The idea is to quickly extract the bits, and add them to a counter that is within a SIMD register, and only exact the values at the end.

The code is slightly more complicated because we have an inner loop. Within the inner loop, we use 8-bit counters, only moving to 64-bit counters at the end of the inner loop. To ensure that there is no overflow, the inner loop can only run for 255 iterations. The code looks as follows&hellip;
```C
size_t avx2_utf8_length_mkl(const uint8_t *str, size_t len) {
  size_t answer = len / sizeof(__m256i) * sizeof(__m256i);
  size_t i = 0;
  __m256i four_64bits = _mm256_setzero_si256();
  while (i + sizeof(__m256i) <= len) {
    __m256i runner = _mm256_setzero_si256();
    size_t iterations = (len - i) / sizeof(__m256i);
    if (iterations > 255) { iterations = 255; }
    size_t max_i = i + iterations * sizeof(__m256i) - sizeof(__m256i);
    for (; i <= max_i; i += sizeof(__m256i)) {
      __m256i input = _mm256_loadu_si256((const __m256i *)(str + i));
      runner = _mm256_sub_epi8(
        runner, _mm256_cmpgt_epi8(_mm256_setzero_si256(), input));
    }
    four_64bits = _mm256_add_epi64(four_64bits, 
      _mm256_sad_epu8(runner, _mm256_setzero_si256()));
  }
  answer += _mm256_extract_epi64(four_64bits, 0) +
    _mm256_extract_epi64(four_64bits, 1) +
    _mm256_extract_epi64(four_64bits, 2) +
    _mm256_extract_epi64(four_64bits, 3);
    return answer + scalar_utf8_length(str + i, len - i);
}
```


We can also further unroll the inner loop to save a bit on the number of instructions.

I wrote a small benchmark with [8kB random inputs](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/02/16), with an AMD Rome (Zen2) server and GCC 11 (<tt>-O3 -march=native</tt>). The results will vary depending on your input, your compiler and your processor.

function                 |cycles/byte              |instructions/byte        |instructions/cycle       |
-------------------------|-------------------------|-------------------------|-------------------------|
scalar (no autovec)      |0.89                     |3.3                      |3.8                      |
scalar (w. autovec)      |0.56                     |0.71                     |1.27                     |
AVX2 (movemask)          |0.055                    |0.15                     |2.60                     |
AVX2 (in-SIMD)           |0.039                    |0.15                     |3.90                     |
AVX2 (in-SIMD/unrolled)  |0.028                    |0.07                     |2.40                     |


So the fastest method in my test is over 30 times faster than the purely scalar version. If I allow the scalar vector to be &lsquo;autovectorized&rsquo; by the compiler, it gets about 50% faster.

It is an interesting scenario because the number of instructions retired by cycle varies so much. The slightly more complex &ldquo;in-SIMD&rdquo; function does better than the &lsquo;movemask&rsquo; function because it manages to retire more instructions per cycle, in these tests. The unrolled version is fast and requires few instructions per cycle, but it has a &lsquo;relatively&rsquo; low number of instructions retired per cycle.

[My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/02/16). It should be possible to further tune this code. You need privileged access to run the benchmark because I rely on performance counters.

__Further work__: It is not necessary to use SIMD instructions explicitly, you can use [SWAR instead](https://github.com/oven-sh/bun/blob/main/src/string_immutable.zig#L1726-L1790) for a compromise between portability and performance.

__Follow-up__: I have a [NEON version](/lemire/blog/2023/05/15/computing-the-utf-8-size-of-a-latin-1-string-quickly-arm-neon-edition/) of this post.

__Remark__. Whenever I mention Latin 1, some people are prone to remark that browsers treat HTML pages declared as Latin 1 and ASCII as windows-1252. That is because modern web browsers do not support Latin 1 and ASCII in HTML. Even so, you should not use Latin 1, ASCII or even windows-1252 for your web pages. I recommend using Unicode (UTF-8). However, if you code in Python, Go or Node.js, and you declare a string as Latin 1, it should be Latin 1, not windows-1252. It is bug to confuse Latin 1, ASCII and windows-1252. They are different formats.

__Remark__. Whenever I mention Latin 1, some people are prone to remark that browsers treat HTML pages declared as Latin 1 and ASCII as windows-1252. That is because modern web browsers do not support Latin 1 and ASCII in HTML. Even so, you should not use Latin 1, ASCII or even windows-1252 for your web pages. I recommend using Unicode (UTF-8). However, if you code in Python, Go or Node.js, and you declare a string as Latin 1, it should be Latin 1, not windows-1252. It is bug to confuse Latin 1, ASCII and windows-1252. They are different formats.

