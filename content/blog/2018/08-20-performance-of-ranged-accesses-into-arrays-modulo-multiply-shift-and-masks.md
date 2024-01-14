---
date: "2018-08-20 12:00:00"
title: "Performance of ranged accesses into arrays: modulo, multiply-shift and masks"
---



Suppose that you wish to access values in an array of size n, but instead of having indexes in [0,n), you have arbitrary non-negative integers. This sort of problems happen when you build a hash table or other array-backed data structure.

The naive approach to this problem is to use the remainder of the division by n (sometimes called a modulo reduction):
```C
uint32_t access(uint32_t * array, size_t n, size_t index) {
  return array[index % n];
}
```


However, if the compiler cannot inline this call and determine the value of n, then this code is likely to compile to a division instruction. Division instructions are among the slowest instructions on modern-day processors.
To avoid division, many people assume that n is a power of two. Then they use the mask trick: i &amp; (n-1) = i % n.
```C
uint32_t access(uint32_t * array, size_t n, size_t index) {
  return array[index & ( n - 1 )];
}
```


That&rsquo;s typically much faster. You do pay a price, however. Your array lengths must all be a power of two. It is a small price to pay, but a price nonetheless.

Another approach I like is the multiply-shift [fast alternative to the modulo reduction](/lemire/blog/2016/06/27/a-fast-alternative-to-the-modulo-reduction/) (see the [fastrange](https://github.com/lemire/fastrange) library). It involves a multiplication followed by a shift:
```C
uint32_t access(uint32_t * array, uint64_t n, size_t index) {
  return array[(index * n)>>32];
}
```


Undeniably, the masked approach ought to be faster. You cannot get much faster than a bitwise AND. It is nearly a free instruction on modern processors. Multiplications and shifts are typically more expensive.

But let us measure the throughput of these operations. One thing to take into account is that if you have to do more than one such access, the processor can vectorize it. That is, it can use fast instructions that do several multiplications at once. On x64 processors, the `vpmuludq` instruction can do four full 32-bit by 32-bit multiplications at once.

Let us try it out with the GCC compiler (5.5):

&nbsp;                   |no-AVX2                  |AVX2                     |
-------------------------|-------------------------|-------------------------|
modulo                   |8 cycles                 |8 cycles                 |
multiply-shift           |2.2 cycles               |1.5 cycles               |
mask                     |1.7 cycles               |1.7 cycles               |


Clearly, my particular compiler does a poor job at optimizing the masked approach. It should be able to beat the multiply-shift approach. Yet what I think should be evident is that the approach with a mask is not massively more efficient than the multiply-shift approach, and might even be slower (depending on your compiler).

In effect, it may not be warranted to force your array lengths to be a power of two. With careful engineering, you might get much of the same performance with any array length. It is especially likely to be true if you often access several values at once in your array, because you can rely on vectorization.

Relying on the compiler to do some vectorization magic is fine in most instances, but what if you want more control? My original code looks like this&hellip;
```C
uint32_t fastsum(uint32_t * z, uint32_t N, uint32_t * accesses, 
   uint32_t nmbr) {
  uint32_t sum = 0;
  uint64_t N64 = (uint64_t) N;
  for(uint32_t j = 0; j < nmbr ; ++j ) {
    sum += z[(accesses[j] * N64)>> 32] ;
  }
  return sum;
}
```


Here is a version with Intel intrinsics:
```C
uint32_t vectorsum(uint32_t * z, uint32_t N, uint32_t * accesses, 
     uint32_t nmbr) {
  __m256i Nvec = _mm256_set1_epi32(N);
  __m128i sum = _mm_setzero_si128();
  for(uint32_t j = 0; j < nmbr ; j+=4) {
     __m256i fourints = _mm256_loadu_si256(accesses + j;
     __m256i f4 =  _mm256_mul_epu32(fourints, Nvec);
     __m256i ft = _mm256_srli_epi64(f4,32);
     __m128i fi = _mm256_i64gather_epi32 (z,ft , 4);
     sum = _mm_add_epi32(sum, fi);
  }
  uint32_t buffer[4];
  _mm_storeu_si128((__m128i *)buffer,sum);
  return buffer[0] + buffer[1] + buffer[2] + buffer[3];
}
```


The catch is that you have to process values four at a time.

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/08/20).

