---
date: "2018-02-28 12:00:00"
title: "Vectorized shifts: are immediates faster?"
---



Our processors are all equipped with vector instructions also called SIMD (single instruction multiple data). One common instruction is the &ldquo;shift&rdquo;. Roughly speaking, a shift is either a multiplication by a power of two or a division by a power of two, when considering the data as unsigned integers. Thus 1&lt;&lt;3 is 8.

Older Intel and AMD processors have shift instructions so that you can shift several integers at once. So given [1,2,3,4], you can compute [1&lt;&lt;3, 2&lt;&lt;3, 3&lt;&lt;3, 4&lt;&lt;3] using a single instruction. It is faster, obviously.

However, one form of these instructions can only shift by an &ldquo;immediate&rdquo; integer value, that is, the integer must be passed explicitly to the instructions (as opposed to being read from a register). That is an annoying constraint. It is good if you want to shift all your values by 3 bits, and 3 is a fixed quantity, but what if you want to shift by a quantity that is known only at runtime? You can&rsquo;t. Thus older processors can&rsquo;t vectorize the following code very well using immediate integers:
```C
void scalarshift(uint32_t *array, size_t N,  int shift) {
  for (size_t k = 0; k < N; ++k) {
    array[k] = array[k] >> shift;
  }
}
```


Thankfully, there is also a version of this instruction that takes a non-immediate value, but it must be passed as a vector register: you store the shift count in the first few bits of the vector register.

More recent processors can do variable shifts. Thus given the vectors [1,2,3,4] and [7,8,9,10], one could compute [1&lt;&lt;7, 2&lt;&lt;8, 3&lt;&lt;9, 4&lt;&lt;10] in one instruction. And the vector [7,8,9,10] does not need to be known at compile time.
For some reason, Intel has preserved the older form of the instructions. If you have an immediate integer, you can shift with it. This saves you from having to populate a shift vector and explicitly occupying a register.

But is using immediate integers when possible worth it from a performance point of view? Agner Fog&rsquo;s instruction table shows little difference between the two forms of the instruction, but I wanted to check for myself. Thus I wrote two versions of the same code, shifting a whole array.

The version with immediate values looks like this&hellip;
```C
void vectorshift(uint32_t *array, size_t N) {
  __m256i * a = (__m256i *) array;
  for (size_t k = 0; k  < N / 8 ; k ++, a++) {
    __m256i v = _mm256_loadu_si256(a);
    v = _mm256_srli_epi32(v,SHIFT);
    _mm256_storeu_si256(a,v);
  }
}
```


It looks messy because I use intrinsic functions, but you should be able to figure out quickly what my code is doing.

The version with variable shifts is just a bit more complicated&hellip;
```C
void vectorshift(uint32_t *array, size_t N, int shift) {
  __m256i * a = (__m256i *) array;
  __m256i s = _mm256_set1_epi32(shift);
  for (size_t k = 0; k  < N / 8 ; k ++, a++) {
    __m256i v = _mm256_loadu_si256(a);
    v = _mm256_srlv_epi32(v,s);
    _mm256_storeu_si256(a,v);
  }
}
```


In practice, you want to generously unroll these loops for greater speed.

What is the verdict? On a skylake processor, both reach an identical speed, at 0.35 cycles per input integer. The instruction count is nearly identical.

Thus it is probably not worth bothering with shifts by immediate values for performance reasons.

[My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/02/28).

