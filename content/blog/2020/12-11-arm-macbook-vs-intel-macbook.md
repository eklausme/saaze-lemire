---
date: "2020-12-11 12:00:00"
title: "ARM MacBook vs Intel MacBook"
---



Up to yesterday, my laptop was a large 15-inch MacBook Pro. It contains an [Intel Kaby Lake processor](https://ark.intel.com/content/www/us/en/ark/products/97185/intel-core-i7-7700hq-processor-6m-cache-up-to-3-80-ghz.html) (3.8 GHz). I just got a brand-new 13-inch 2020 MacBook Pro with Apple&rsquo;s M1 ARM chip (3.2 GHz).

How do they compare? I like precise data points.

Recently, I have been busy benchmarking number parsing routines where you convert a string into a floating-point number. That seems like an interesting comparison. In my basic tests, I generate random floating-point numbers in the unit interval (0,1) and I parse them back exactly. The decimal [significand](https://en.wikipedia.org/wiki/Significand) spans 17 digits.

I run the same benchmarking program on both machines. I am compiling both benchmarks identically, using Apple builtin&rsquo;s Xcode system with the LLVM C++ compiler. Evidently, the binaries will differ since one is an ARM binary and the other is a x64 binary. Both machines have been updated to the most recent compiler and operating system.

My results are as follows:

&nbsp;                   |Intel x64                |Apple M1                 |difference               |
-------------------------|-------------------------|-------------------------|-------------------------|
strtod                   |80 MB/s                  |115 MB/s                 |40%                      |
abseil                   |460 MB/s                 |580 MB/s                 |25%                      |
[fast_float](https://github.com/fastfloat/fast_float) |1000 MB/s                |1800 MB/s                |80%                      |


[My benchmarking software is available on GitHub](https://github.com/lemire/simple_fastfloat_benchmark). To reproduce, install Apple&rsquo;s Xcode (with command line tools), [CMake](https://cmake.org/download/) (install for command-line use) and type <tt>cmake -B build &amp;&amp; cmake --build build &amp;&amp; ./build/benchmarks/benchmark</tt>. It uses the the default Release mode in CMake (flags <tt>-O3 -DNDEBUG</tt>).

I do not yet understand why the [fast_float](https://github.com/fastfloat/fast_float) library is so much faster on the Apple M1. It contains no ARM-specific optimization.

__Note__: I dislike benchmarking on laptops. In this case, the tests are short and I do not expect the processors to be thermally constrained.

__Update__. The original post had the following statement:

> In some respect, the Apple M1 chip is far inferior to my older Intel processor. The Intel processor has nifty 256-bit SIMD instructions. The Apple chip has nothing of the sort as part of its main CPU. So I could easily come up with examples that make the M1 look bad.


This turns out to be false. See my post <a href="https://lemire.me/blog/2020/12/13/arm-macbook-vs-intel-macbook-a-simd-benchmark/" rel="bookmark">ARM MacBook vs Intel MacBook: a SIMD benchmark</a>

