---
date: "2018-08-15 12:00:00"
title: "The dangers of AVX-512 throttling: a 3% impact on Xeon Gold processors?"
---



Intel&rsquo;s latest processors come with powerful new instructions from the AVX-512 family. These instructions operate over 512-bit registers. They use more power than regular (64-bit) instructions. Thus, on some Intel processors, the processor core that is using AVX-512 might run at a lower frequency, to keep the processor from overheating or using too much power.

Can we measure this effect?

In a recent post, I used a benchmark provided by Vlad Krasnov from Cloudfare, on a Xeon Gold 5120 processor. In the test provided by Krasnov, the use of AVX-512 actually made things faster.

So I just went back to an earlier benchmark I designed myself. It is a CPU-intensive Mandelbrot computation, with very few bogus AVX-512 instructions thrown in (about 32,000). The idea is that if AVX-512 cause frequency throttling, the whole computation will be slowed. I use two types of AVX-512 instructions: light (additions) and heavy (multiplications).

I measured the effect of AVX-512 throttling on the Skylake X server I own&hellip; but what about the Xeon Gold 5120 processor?

I run the benchmark ten times and measure the wall-clock time using the Linux/bash `time` command. I sleep 2 seconds after each sequence of ten tests. A complete script is provided. In practice, I just run the benchmark.sh script after typing `make` and I record the `user` timings of each test.

Here are my raw numbers from one run (there are run-run variations in the 1-2% range):

No AVX-512               |Light AVX-512            |Heavy AVX-512            |
-------------------------|-------------------------|-------------------------|
9.43 s                   |9.84 s                   |9.78 s                   |


Thus AVX-512 incurs a 3-4% penalty. I can&rsquo;t measure a difference between light and heavy AVX-512 instructions.

Is that a lot? It is hard for me to get terribly depressed at the fact that a benchmark I specifically designed to make AVX-512 look bad sees a 3% performance degradation on one core. Real code is not going to use AVX-512 in such a manner: the AVX-512 instructions will do useful work. It is not super difficult to recoup a 3% difference.

So single-core and sporadic usage of AVX-512 instructions looks to be harmless. You have to use multiple cores to get in real trouble.

__Further reading__: [AVX-512: when and how to use these new instructions](/lemire/blog/2018/09/07/avx-512-when-and-how-to-use-these-new-instructions/)

