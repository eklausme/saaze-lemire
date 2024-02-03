---
date: "2018-06-07 12:00:00"
title: "Vectorizing random number generators for greater speed: PCG and xorshift128+ (AVX-512 edition)"
---



Most people designing random number generators program using regular code. If they are aiming for speed, they probably write functions in C. However, our processors have fast &ldquo;vectorized&rdquo; (or SIMD) instructions that can allow you to go faster. These instructions do several operations at once. For example, recent Skylake-X processors from Intel can do eight 64-bit multiplications with a single instruction.

[There is a vectorized version of the Mersenne Twister generator](https://link.springer.com/chapter/10.1007/978-3-540-74496-2_36) used in some C++ standard libraries, but the Mersenne Twister is not particularly fast to begin with.

What happens if we vectorize really fast generators?

I had good luck vectorizing [Vigna&rsquo;s xorshift128+ random number generator](https://github.com/lemire/SIMDxorshift). A generator like it is part of some JavaScript engines. The xorshift128+ generator produces 64-bit values, but you can consider them as two 32-bit values. On my Skylake-X processor, I can generate 32-bit random integers at a rate of 2 cycles per integer using xorshift128+. That&rsquo;s almost twice as fast as when using the default, scalar implementation in C.

scalar xorshift128+      |3.6 cycles per 32-bit word |
-------------------------|-------------------------|
SIMD xorshift128+        |1.0 cycles per 32-bit word |


[PCG is a family of random number generators invented by O&rsquo;Neill](http://www.pcg-random.org). Can we do the same with PCG? I took a first stab at it with my [simdpcg library](https://github.com/lemire/simdpcg). My vectorized PCG ends up using about 1 cycle per integer, so it has the same speed as the vectorized xorshift128+.

scalar PCG               |4.3 cycles per 32-bit word |
-------------------------|-------------------------|
SIMD PCG                 |1.0 cycles per 32-bit word |


In these tests, I simply write out the random number to a small array in cache. I only measure raw throughput. To get these good results, I &ldquo;cheat&rdquo; a bit by interleaving several generators in the vectorized versions. Indeed, without this interleave trick, I find that the processor is almost running idle due to data dependencies.

My C code is available:

- [simdpcg: a vectorized version of the PCG random number generator](https://github.com/lemire/simdpcg)
- [SIMDxorshift: Vectorized (SIMD) version of xorshift128+](https://github.com/lemire/SIMDxorshift)


Sadly, I expect that most of my readers do not yet have processors with support for AVX-512 instructions. They are available as part of the Skylake-X and Cannonlake processors. Intel has not been doing a great job at selling these new processors in great quantities. You may be able to have access to such processors using the cloud.

__Update__: In my initial version, I reported worse performance on xorshift128+. Samuel Neves pointed out to me that this is due to the lack of inlining, because I compile the xorshift128+ functions in their own object files. We can solve this particular problem using link time optimization (LTO), effectively by passing the <tt>-flto</tt> flag as part of the compile command line. As usual, results will vary depending on your compiler and processor.

__Further reading__: See [Xorshift1024*, Xorshift1024+, Xorshift128+ and Xoroshiro128+ fail statistical tests for linearity](https://www.sciencedirect.com/science/article/pii/S0377042718306265?dgcid=author), Journal of Computational and Applied Mathematics, to appear (Available online 22 October 2018)

