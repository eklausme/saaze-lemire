---
date: "2018-01-04 12:00:00"
title: "Don´t make it appear like you are reading your own recent writes"
---



[Richard Statin recently published a Java benchmark](http://richardstartin.uk/the-much-aligned-garbage-collector/) where the performance of a loop varies drastically depending on the size of the arrays involved. The loop is simple:
```C
for (int i = 0; i < a.length; ++i) {
  a[i] += s * b[i];
}
```


If the array size is 1000, the performance is lower than if the array size is 1024. The weird result only occurs if AVX2 autovectorization is enabled, that is, only if Java uses vector instructions.

It is hard to reason from a Java benchmark. So many things could be going on! What is the address of the arrays? I am sure you can find out, but it is ridiculously hard.

Let me rewrite the loop in C using AVX2 intrinsics:
```C
void vecdaxpy(double * a, double * b, double s, size_t len) {
    const __m256d vs = _mm256_set1_pd(s);
    for (size_t i = 0; i + 4 <= len ; i += 4) {
      const __m256d va = _mm256_loadu_pd(a + i);
      const __m256d vb = _mm256_loadu_pd(b + i);
      const __m256d mults = _mm256_mul_pd(vb,vs);
      const __m256d vavb = _mm256_add_pd(va,mults);
      _mm256_storeu_pd(a + i,vavb);
    }
}
```


In Java, you have to work hard to even know that it managed to vectorize the loop the way you expect. With my C intrinsics, I have a pretty good idea of what the compiler will produce.

I can allocate one large memory block and fit two arrays of size N, for various values of N, in a continuous manner. It seems that this is what Richard expected Java to do, but we cannot easily know how and where Java allocates its memory.

I can then report how many cycles are used per pair of elements (I divide by N):
```C

$ gcc -O3 -o align align.c -mavx2  && ./align
N = 1000
vecdaxpy(a,b,s,N)   	:  0.530 cycles per operation
N = 1004
vecdaxpy(a,b,s,N)   	:  0.530 cycles per operation
N = 1008
vecdaxpy(a,b,s,N)   	:  0.530 cycles per operation
N = 1012
vecdaxpy(a,b,s,N)   	:  0.528 cycles per operation
N = 1016
vecdaxpy(a,b,s,N)   	:  0.530 cycles per operation
N = 1020
vecdaxpy(a,b,s,N)   	:  0.529 cycles per operation
N = 1024
vecdaxpy(a,b,s,N)   	:  0.525 cycles per operation
```


So the speed is constant with respect to N (within an error margin of 1%).

There are four doubles in each 256-bit registers, so I use about 2 cycles to process a pair of 256-bit registers. That sounds about right. I need to load two registers, do a multiplication, an addition, and a store. It is not possible to do two loads and a store in one cycle, so 2 cycles seem close to the best one can do.

I could flush the arrays from cache, and things get a bit slower (over four times slower), but the speed is still constant with respect to N.

Whatever hardware issue you think you have encountered, you ought to be able to reproduce it with other (simpler) programming languages. Anything hardware related should be reproducible with several programming languages. Why reason about performance from Java alone, unless it is a Java-specific issue? If you cannot reproduce it with another programming language, how can you be sure that you have the right model?

Still, Richard&rsquo;s result is real. If I use arrays of size just under a multiple of 4kB, and I offset them just so that they are not 32-byte aligned (the size of a vector register), I get a 50% performance penalty.

Intel CPU discriminates between memory addresses based on their least significant bits (e.g., the least significant 12 bits). A worst-case scenario is one where you read memory at an address that looks (as far as the least significant bits are concerned) like an address that was very recently written to.

[The Intel documentation calls this 4K Aliasing](https://www.intel.com/content/dam/www/public/us/en/documents/manuals/64-ia-32-architectures-optimization-manual.pdf):

> 4-KByte memory aliasing occurs when the code stores to one memory location and shortly after that it loads from a different memory location with a 4-KByte offset between them. The load and store have the same value for bits 5 &#8211; 11 of their addresses and the accessed byte offsets should have partial or complete overlap. 4K aliasing may have a five-cycle penalty on the load latency. This penalty may be significant when 4K aliasing happens repeatedly and the loads are on the critical path. If the load spans two cache lines it might be delayed until the conflicting store is committed to the cache. Therefore 4K aliasing that happens on repeated unaligned Intel AVX loads incurs a higher performance penalty.


You can minimize the risk of trouble by aligning your data on 32-byte boundaries. It is likely that Java does not align arrays on cache lines or even on 32-byte boundaries. Touching more than one 32-byte region increases the likelihood of aliasing.

The problem encountered by Richard is different from an old-school data alignment issue where loads are slower because the memory address is not quite right. Loading and storing vector registers quickly does not require alignment. The problem we have in Richard&rsquo;s example is that we are storing values, and then it looks (from the processor&rsquo;s point of view) like we might be loading it again quickly&hellip; this confusion incurs a penalty.

What would happen if Richard flipped a and b in his code?
```C
for (int i = 0; i < a.length; ++i) {
  b[i] += s * a[i];
}
```


Because we write to array b in this example (instead of array a), then I suspect he would get that the worst case is having arrays of size just slightly over 4kB.

He could also try to iterate over the data in reverse order but this could confuse the compiler and prevent autovectorization.

I also suspect that this type of aliasing is only going to get worse as vector registers get larger (e.g., as we move to AVX-512). In the [C version of Roaring bitmaps](https://github.com/RoaringBitmap/CRoaring), we require 32-byte alignment when allocating bitsets. We might consider 64-byte alignment in the future.

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/01/04).

(To make sure you results are stable, avoid benchmarking on a laptop. Use a desktop configured for testing with a flat CPU frequency.)

