---
date: "2022-11-08 12:00:00"
title: "Modern vector programming with masked loads and stores"
---



When you start a program, it creates a &lsquo;process&rsquo; which own its memory. Memory is allocated to a software process in blocks called &lsquo;pages&rsquo;. These pages might span 4kB, 16kB or more. For a given process, it is safe to read and write within these pages.

In your code, you might allocate a 32-byte array. How much memory does the array require? The answer is that the allocation of the array might require no extra memory because the process had already the room needed in its pages, or else, the array might entice the operating system to grant the process many more pages. Similarly, &lsquo;freeing&rsquo; the array does not (generally) reclaim the memory.

In general, the operating system and the processor do not care when your program reads and writes anywhere within the pages allocated to it. These pages are the &lsquo;segment&rsquo; that the process owns. When you do access a forbidden page, one that was not allocated to your process, then you normally get a [segmentation fault](https://en.wikipedia.org/wiki/Segmentation_fault). Most of the time, it means that your program crashes.

Interestingly,  if I allocate a small array and then I read beyond its bounds, the program will often not immediately crash and may even remain correct. Thus you can allocate an array with room for two integers, read three integers from it, and your program might &lsquo;work&rsquo;. The following function is wrong but it might very well work fine for years&hellip; (and then it will mysterious crash)
```C
int f() {
    int* data = new int[2];
    data[0] = 1;
    data[1] = 2;
    int x = data[0];
    int y = data[1];
    int z = data[2];
    delete[] data;
    return x + y;
} 
```


But why would you ever want to read beyond the bounds of the allocated memory? For performance and/or convenience.

Modern processors have vector instructions designed to work on &lsquo;large registers&rsquo;. For example, recent Intel processors have 512-bit registers. Such a register can store 16 standard floating-point values. The following code will compute the dot product between two vectors very quickly&hellip; (read the comments in the code to follow through)
```C
float dot512fma(float *x1, float *x2, size_t length) {
  // create a vector of 16 32-bit floats (zeroed)
  __m512 sum = _mm512_setzero_ps();
  for (size_t i = 0; i < length; i += 16) {
    // load 16 32-bit floats
    __m512 v1 = _mm512_loadu_ps(x1 + i);
    // load 16 32-bit floats

    __m512 v2 = _mm512_loadu_ps(x2 + i);
    // do sum[0] += v1[i]*v2[i] (fused multiply-add)
    sum = _mm512_fmadd_ps(v1, v2, sum);
  }
  // reduce: sums all elements
  return _mm512_reduce_add_ps(sum);
}
```


There is a problem with this code, however. If length is not a multiple of sixteen, then we might read too much data. This might or might not crash the program, and it may give wrong results.

What might you do? With earlier processors, you had to handle it in an ad hoc manner.

The solution today is to use masked loads, to load just the data that is safe to read in wide register. For AVX-512, it has hardly any overhead, except for the computation of the mask itself. You might code it as follows:
```C
float dot512fma(float *x1, float *x2, size_t length) {
  // create a vector of 16 32-bit floats (zeroed)
  __m512 sum = _mm512_setzero_ps();
  size_t i = 0;
  for (; i + 16 <= length; i+=16) {
    // load 16 32-bit floats
    __m512 v1 = _mm512_loadu_ps(x1 + i);
    // load 16 32-bit floats
    __m512 v2 = _mm512_loadu_ps(x2 + i);
    // do sum[0] += v1[i]*v2[i] (fused multiply-add)
    sum = _mm512_fmadd_ps(v1, v2, sum);
  }
  if  (i  < length) {
    // load 16 32-bit floats, load only the first length-i floats
    // other floats are automatically set to zero
    __m512 v1 = _mm512_maskz_loadu_ps((1<<(length-i))-1, x1 + i);
    // load 16 32-bit floats, load only the first length-i floats
    __m512 v2 = _mm512_maskz_loadu_ps((1<<(length-i))-1, x2 + i);
    // do sum[0] += v1[i]*v2[i] (fused multiply-add)
    sum = _mm512_fmadd_ps(v1, v2, sum);
  }
  // reduce: sums all elements
  return _mm512_reduce_add_ps(sum);
}
```


As you can see, I have added a final branch which works with a computed mask. The mask is computed using arithmetic. In this case, I use an ugly formula: ((1&lt;&lt;(length-i))-1).

It is also possible to use just one loop, and to update the mask for the final iteration, but it makes the code slightly harder to understand in my view.

In any case, using masks, I achieve high performance: I use fast AVX-512 instructions throughout. It is also convenient: I can write the entire function with the same coding style.

A sensible question is whether these masked loads and stores are really safe with respect to segmentation faults. You can check it by repeatedly writing and loading just beyond the allocated memory, eventually you will cause a segmentation fault. [I have written a small C++ test](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2022/11/08). The following code always crashes at the last line of the loop, where status has value &lsquo;RIGHT_AFTER&rsquo;.
```C
  uint8_t *data = new uint8_t[1024];
  size_t ps = page_size();
  // round up to the end of the page:
  uintptr_t page_limit = ps - (reinterpret_cast<uintptr_t>(data) % ps) - 1;
  __m128i ones = _mm_set1_epi8(1); // register filled with ones
  for (int z = 0;; z++) {
    status = RIGHT_BEFORE;
    data[z * ps + page_limit] = 1;
    status = AVX512_STORE;
    _mm_mask_storeu_epi8(data + z * ps + page_limit, 1, ones);
    status = AVX512_LOAD;
    __m128i oneandzeroes = _mm_maskz_loadu_epi8(1, data + z * ps + page_limit);
    status = RIGHT_AFTER;
    data[z * ps + page_limit + 1] = 1;
  }

```




What about ARM processors ? Thankfully, you can do much of the same thing using Amazon&rsquo;s graviton processors. A dot product might look as follows:
```C
float dotsve(float *x1, float *x2, int64_t length) {
  int64_t i = 0;
  svfloat32_t sum = svdup_n_f32(0);
  while(i + svcntw() <= length) {
    svfloat32_t in1 = svld1_f32(svptrue_b32(), x1 + i);
    svfloat32_t in2 = svld1_f32(svptrue_b32(), x2 + i);
    sum = svmad_f32_m(svptrue_b32(), in1, in2, sum);
    i += svcntw();
  }
  svbool_t while_mask = svwhilelt_b32(i, length);
  do {
    svfloat32_t in1 = svld1_f32(while_mask, x1 + i);
    svfloat32_t in2 = svld1_f32(while_mask, x2 + i);
    sum = svmad_f32_m(svptrue_b32(), in1, in2, sum);
    i += svcntw();
    while_mask = svwhilelt_b32(i, length);
  } while (svptest_any(svptrue_b32(), while_mask));

  return svaddv_f32(svptrue_b32(),sum);
}
```


It is the same algorithm. One difference is that SVE has its own intrinsic functions to general masks. Furthermore, while AVX-512 allow you to pick different register sizes, SVE hides away the register sizes, so that your binary code should run irrespective of the register size. SVE has also &lsquo;non-faulting&rsquo; loads and other options.

[My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2022/11/08): both the AVX-512 code and the ARM/SVE2 code (in a separate directory). You may need access to AWS (Amazon) to run the ARM/SVE2 code.

&nbsp;

