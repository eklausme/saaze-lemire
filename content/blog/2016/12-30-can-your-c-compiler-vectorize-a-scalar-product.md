---
date: "2016-12-30 12:00:00"
title: "Can your C compiler vectorize a scalar product?"
---



If you have spent any time at all on college-level mathematics, you have probably heard of the scalar product:
```C
float scalarproduct(float * array1, float * array2, size_t length) {
  float sum = 0.0f;
  for (size_t i = 0; i < length; ++i) {
    sum += array1[i] * array2[i];
  }
  return sum;
}
```


Most people who need to do fancy things like dot products or matrix multiplications use hand-tuned libraries&hellip; but there are very reasonable reasons for the average programmer to come up with code that looks like a scalar product. 

Vendors like Intel know that scalar products are important, so they have dedicated instructions to speed-up the computation of the scalar product. The approach taken by Intel involves [SIMD instructions](https://en.wikipedia.org/wiki/SIMD). SIMD instructions work over vectors of several words (such as 8 floats) at once. Using intrinsics, you can write your own hand-tuned scalar product&hellip; 
```C
float avx_scalarproduct(float * array1, float * array2, 
          size_t length) {
  __m256 vsum = _mm256_setzero_ps();
  size_t i = 0;
  for (; i + 7 < length; i += 8) { // could unroll further
    vsum = _mm256_fmadd_ps(_mm256_loadu_ps(array1 + i),
                       _mm256_loadu_ps(array2 + i),vsum);
  }
  float buffer[8];
  _mm256_storeu_ps(buffer,vsum);
  float sum = buffer[0] + buffer[1] + 
                      buffer[2] + buffer[3] + 
                      buffer[4] + buffer[5] + 
                      buffer[6] + buffer[7];
  for (; i < length; ++i) {
      sum += array1[i] * array2[i];
  }
  return sum;
}
```


Wow. Who wants to deal with code that looks so messy? With more effort, I can improve the performance further, but simply unrolling, but the code looks even more bizarre.

So is it worth the effort? 

No. The GNU GCC compiler is able to compile my simple pure-C function to code that is as good as my hand-tuned function. (One caveat: you have to compile the code with the <tt>-ffast-math</tt> flag.) And the code produced by LLVM&rsquo;s clang is more than twice as fast as my &ldquo;hand-tuned&rdquo; code (it corresponds to a fully unrolled version).

[The source code of my full benchmark is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2016/12/29).

We can examine the assembly directly and verify that clang makes generous use of the <tt>[vfmadd231ps](http://www.felixcloutier.com/x86/VFMADD132PS:VFMADD213PS:VFMADD231PS.html)</tt> instruction.

<iframe width="100%" height="400px" src="https://gcc.godbolt.org/e#compiler:clang390,filters:'compileOnChange,labels,directives,commentOnly,intel',options:'-O3+-ffast-math+-mfma+-mavx2',source:'%23include+%3Cstddef.h%3E%0A%0Afloat+scalarproduct(float+*+array1,+float+*+array2,+size_t+length)+%7B%0A++float+sum+%3D+0.0f%3B%0A++for+(size_t+i+%3D+0%3B+i+%3C+length%3B+%2B%2Bi)+%7B%0A++++sum+%2B%3D+array1%5Bi%5D+*+array2%5Bi%5D%3B%0A++%7D%0A++return+sum%3B%0A%7D'"></iframe>

The fully unrolled scalar product code (see my [GitHub repo](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2016/12/29/scalarproduct.c#L21-L61)) runs at a speed of about 0.2 cycles per pair of input floats. That&rsquo;s what the clang compiler can produce and it is an order of magnitude faster than the regular code. 

Why does any of this matters?

The larger question is: how do we scale up our software so that it can benefit from advanced parallelism? We know that multicore processing only helps so much: adding new cores to a processor adds a lot of complexity. It is really hard to test multicore software. Vectorization (through SIMD instructions) is conceptually much simpler. There are some minor downsides to wide vector instructions, such as the fact that we end up more register space and more expensive context switching, but it is simply not comparable to the difficulties inherent to multicore parallelism. 

The fact that optimizing compilers are pretty good with SIMD instructions makes these instructions very compelling. We have ease of programming and performance in one nice bundle. In 2017, Intel should ship commodity processors with AVX-512 support, meaning that single instructions can process 512-bit registers. Soon enough, your compiler will take your good old code and multiply its speed, without any input on your part. 

__Note__: This blog post was motivated by a [Twitter exchange with Maxime Chevalier](https://twitter.com/love2code/status/811980789659234304). My original claim was that the Swift compiler could probably automatically vectorize matrix multiplications, if I write it carefully. It is certainly true when I use a C compiler, but I don&rsquo;t know how to get the same result in the Swift language given that I don&rsquo;t know whether there is an equivalent to the <tt>-ffast-math</tt> flag in Swift. Thankfully, [Swift code can call C without overhead](/lemire/blog/2016/09/29/can-swift-code-call-c-code-without-overhead/), so you can probably simply rewrite your performance-sensitive floating-point code in C and all it from Swift. Or maybe the Swift engineers could give us <tt>-ffast-math</tt> in Swift?

