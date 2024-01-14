---
date: "2020-12-13 12:00:00"
title: "ARM MacBook vs Intel MacBook: a SIMD benchmark"
---



[In my previous blog post](/lemire/blog/2020/12/11/arm-macbook-vs-intel-macbook/), I compared the performance of my new ARM-based MacBook Pro with my 2017 Intel-based MacBook Pro. I used a number parsing benchmark. In some cases, the ARM-based MacBook Pro was nearly twice as fast as the older Intel-based MacBook Pro.

I think that the Apple M1 processor is a breakthrough in the laptop industry. It has allowed Apple to sell the first ARM-based laptop that is really good. It is not just the chip, of course. It is everything around it. For example, I fully expect that most people who buy these new ARM-based laptops to never realize that they are not Intel-based. The transition is that smooth.

I am excited because I think it will drive other laptop to rethink their designs. You can buy a thin laptop from Apple with a 20-hour battery life and the ability to do intensive computations like a much larger and heavier laptop would.

(This blog post has been updated after a corrected a methodological mistake. I was running the Apple M1 processor under x64 emulation.)

Yet I did not think that the new Apple processor is better than Intel processors in all things. One obvious caveat is that I am comparing the Apple M1 (a 2020 processor) with an older Intel processor (released in 2017). But I thought that even the older Intel processors can have an edge over the Apple M1 in some tasks and I wanted to make this clear. I did not think it was controversial. Yet I was criticized for making the following remark:

> In some respect, the Apple M1 chip is far inferior to my older Intel processor. The Intel processor has nifty 256-bit SIMD instructions. The Apple chip has nothing of the sort as part of its main CPU. So I could easily come up with examples that make the M1 look bad.


This rubbed many readers the wrong way. They pointed out that ARM processors do have 128-bit SIMD instructions called NEON. They do. In some ways, the NEON instruction set is nicer than the x64 SSE/AVX one. Recent Apple ARM processors have four execution units capable of SIMD processing while Intel processors only have three. Furthermore, the Intel execution units have more restrictions. Thus 64-bit ARM NEON routines will outperform comparable SSE2 (128-bit SIMD) Intel routines despite the fact that they both work over 128-bit registers. In fact, [I have a blog post making this point by using the iPhone&rsquo;s processor](/lemire/blog/2019/07/10/parsing-json-using-simd-instructions-on-the-apple-a12-processor/).

But it does not follow that the 128-bit ARM NEON instructions are generally a match for the 256-bit SIMD instructions Intel and AMD offer.

Let us test out the issue. The [simdjson library](https://simdjson.org) offers SIMD-heavy functions to minify JSON and validate UTF-8 inputs. [I wrote a benchmark program](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2020/12/benchmark.cpp) that loads a file in memory and then repeatedly calls the minify and validate function, looking for the best possible speed. [Anyone with a MacBook and Xcode should be able to reproduce my results](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2020/12).

The vectorized UTF-8 validation algorithm is described in [Validating UTF-8 In Less Than One Instruction Per Byte](https://arxiv.org/pdf/2010.03090.pdf) (published in Software: Practice and Experience).

The simdjson library relies on an abstraction layer so that functions are implemented using higher-level C++ which gets translated into efficient SIMD intrinsic functions specific to the targeted system. That is, we are not comparing different hand-tuned assembly functions. [You can check out the UTF-8 validation code for yourself online](https://github.com/simdjson/simdjson/blob/master/src/generic/stage1/utf8_lookup4_algorithm.h).

Let us look at the results:

&nbsp;                   |minify                   |UTF-8 validate           |
-------------------------|-------------------------|-------------------------|
Apple M1 (2020 MacBook Pro) |6.6 GB/s                 |33 GB/s                  |
Intel Kaby Lake (2017 MacBook Pro) |7.7 GB/s                 |29 GB/s                  |
Intel/M1 ratio           |1.2                      |0.9                      |


As you can see, the older Intel processor is slightly superior to the Apple M1 in the minify test.

Of course, it is only one set of benchmarks. There are many confounding factors. Did the algorithmic choices favour the AVX2 ISA? It is possible. Thankfully all of the source code is available so any such bias can be assessed.

