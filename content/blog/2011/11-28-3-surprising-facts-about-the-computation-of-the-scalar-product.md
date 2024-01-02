---
date: "2011-11-28 12:00:00"
title: "3 surprising facts about the computation of scalar products"
---



The speed of many algorithms depends on how quickly you can multiply matrices or compute distances. In turn, these computations depend on the scalar product. Given two arrays such as (1,2) and (5,3), the scalar product is the sum of products 1 Ã— 5 + 2 Ã— 3. We have strong incentives to compute the scalar product as quickly as possible. Here are a few facts that I find surprising:

- __Recent processors (e.g., Intel i7) can multiply and add a 32-bit number in a single CPU cycle or less.__ For each component in the arrays, we need to execute one multiplication and one addition. The latency of the multiplication is at least 3 cycles, meaning that we require 3 cycles to complete a multiplication. Similarly, additions require at least one cycle. Yet processors make aggressive use of pipe-lining: they execute several multiplications simultaneously so that they can produce one result every cycle.
- __If you work with 64-bit integers and use some recent GNU GCC compilers (e.g., 4.5), you should disable Streaming SIMD Extensions (SSE) for better speed.__ In theory, the [SSE](https://en.wikipedia.org/wiki/Streaming_SIMD_Extensions) instructions are ideally suited to the computation of scalar products. Yet the throughput with 64-bit integers goes from 1.3 cycle per multiplication with SSE2 disabled to 3.4 cycles per multiplication with SSE2. There is an optimization bug in the otherwise excellent GNU GCC compiler. Update: According to the numbers provided by John Regehr, this problem also affects some Intel compilers.
- __When using SSE, 64-bit floating point numbers may be faster than 32-bit floating numbers.__ Years ago I was told to avoid 64-bit floating point numbers for performance reasons. It is not automatically good advice on all compilers especially if you require standards compliance.


For my tests, I initially used the flags &ldquo;-funroll-loops -O3&rdquo; on a recent Intel i7-2600 with the GNU GCC compiler version 4.5. In each instance, I have tested with and without manual loop-unrolling and I only report the best score (in cycles per multiplication). The C code is [available](http://pastebin.com/DY2KFmX4).

computation              |with SSE                 |SSE2 disabled (-mno-sse2) |with AVX (-mavx)         |
-------------------------|-------------------------|-------------------------|-------------------------|
32-bit integers          |1.0                      |1.1                      |__0.5__                  |
64-bit integers          |3.4                      |__1.3__                  |3.4                      |
float                    |__10__                   |__10__                   |__10__                   |
double                   |__7.0__                  |170                      |__7.0__                  |


Upgrading to GCC 4.6.2 and replacing -O3 by the new -Ofast flag changes the results quite a bit at the expense of reliability (-Ofast disregards standards compliance).

computation              |with SSE                 |SSE2 disabled (-mno-sse2) |with AVX (-mavx)         |
-------------------------|-------------------------|-------------------------|-------------------------|
32-bit integers          |1.0                      |1.1                      |__0.5__                  |
64-bit integers          |__1.0__                  |1.1                      |__1.0__                  |
float                    |0.7                      |0.9                      |__0.3__                  |
double                   |5.1                      |__2.5__                  |5.0                      |


__Further reading__: See my previous post on this topic [Fast computation of scalar products, and some lessons in optimization](/lemire/blog/2011/08/11/fast-computation-of-scalar-products-and-some-lessons-in-optimization/)

__Code:__ Source code posted on my blog is available from a [github repository](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog).

