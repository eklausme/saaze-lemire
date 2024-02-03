---
date: "2022-12-06 12:00:00"
title: "Optimizing compilers reload vector constants needlessly"
---



Modern processors have powerful vector instructions which allow you to load several values at once, and operate (in one instruction) on all these values. Similarly, they allow you to have vector constants. Thus if you wanted to add some integer (say 10001) to all integers in a large array, you might first load a constant with 8 times the value 10001, then you would load elements from your array, 8 elements by 8 elements, add the vector constant (thus do 8 additions at once), and then store the result. Everything else being equal, this might be 8 times faster.

An optimizing compiler might even do this optimization for you (a process called &lsquo;auto-vectorization). However, for more complex code, you might need to do it manually using &ldquo;intrinsic&rdquo; functions (e.g., _mm256_loadu_si256, _mm256_add_epi32, etc.).

Let us consider the simple case I describe, but where we process two arrays at once&hellip; using the same constant:
```C
#include <x86intrin.h>
#include <stdint.h>
void process_avx2(const uint32_t *in1, const uint32_t *in2, size_t len) {
  // define the constant, 8 x 10001
  __m256i c = _mm256_set1_epi32(10001);
  const uint32_t *finalin1 = in1 + len;
  const uint32_t *finalin2 = in2 + len;
  for (; in1 + 8 <= finalin1; in1 += 8) {
    // load 8 integers into a 32-byte register
    __m256i x = _mm256_loadu_si256((__m256i *)in1);
    // add the 8 integers just loaded to the 8 constant integers
    x = _mm256_add_epi32(c, x);
    // store the 8 modified integers
    _mm256_storeu_si256((__m256i *)in1, x);
  };
  for (; in2 + 8 <= finalin2; in2 += 8) {
    // load 8 integers into a 32-byte register
    __m256i x = _mm256_loadu_si256((__m256i *)in2);
    // add the 8 integers just loaded to the 8 constant integers
    x = _mm256_add_epi32(c, x);
    // store the 8 modified integers
    _mm256_storeu_si256((__m256i *)in2, x);
  }
}
```


My expectation, until recently, was that optimizing compilers would  keep the constant in a register, and never load it twice. Why would they?

Yet you can check that [GCC loads the constant twice](https://godbolt.org/z/G3z1qPG8M). You will recognize the assembly sequence:
```C
mov          eax, 10001 // load 10001 in a general register
vpbroadcastd ymm1, eax  // broadcast 10001 to all elements
```


In  this instance, other compilers (like LLVM) do better. However, in other instances, both LLVM and GCC happily [load constants more than once](https://godbolt.org/z/Gs3che1ds). Only the Intel compiler (ICC) seems to be able to avoid this issue with some consistency.

The processor has more than enough vector registers, so it is not a register allocation issue. Of course, there are instances where it is  best to avoid creating the constant, but you can check that even when the compiler ought to know that the constant is always needed, it may still create it twice. AVX-512 has introduced new mask types and they suffer from this effect as well.

Does it matter? In most cases, this effect should have little performance impact. It is almost surely only a few instructions of overhead per function.

It would be interesting to be able to instruct the compiler not to do reload the constants. You might think that the static keyword could help, but with LLVM, static vector variables may be protected by a lock, which probably makes your code even heavier.

&nbsp;

