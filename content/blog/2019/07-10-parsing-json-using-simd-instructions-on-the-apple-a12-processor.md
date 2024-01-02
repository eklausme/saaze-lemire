---
date: "2019-07-10 12:00:00"
title: "Parsing JSON using SIMD instructions on the Apple A12 processor"
---



Most modern processors have &ldquo;[SIMD instructions](https://en.wikipedia.org/wiki/SIMD)&ldquo;. These instructions operate over wide registers, doing many operations at once. For example, you can easy subtract 16 values from 16 other values in a single SIMD instruction. It is a form of parallelism that can drastically improve the performance of some applications like machine learning, image processing or numerical simulations.

A common data format on the Internet is JSON. It is a ubiquitous format for exchanging data between computers. If you are using some data-intensive web or mobile application written in this decade, it almost surely relies on JSON, at least in part.

Parsing JSON can become a bottleneck. The [simdjson C++ library](https://github.com/lemire/simdjson) applies SIMD instruction to the problem of parsing JSON data. [It works pretty well on modern Intel processors, the kind you have in your laptop](https://arxiv.org/abs/1902.08318) if you bought it in the last couple of years. These processors have wide (256-bit registers) and a corresponding set of instructions (AVX2) that is powerful.

It is not the end of the track: the upcoming generation of Intel processors support AVX-512 with its 512-bit registers. But such fancy processors are still uncommon, even though they will surely be everywhere in a few short years.

But what about processors that do not have such fancy SIMD instructions? The processor in your iPhone (an Apple A12) is an ARM processor and it &ldquo;merely&rdquo; has 128-bit registers, so half the width of current Intel processors and a quarter of the width of upcoming Intel processors.

It would not be fair to compare an ARM processor with its 128-bit registers to an Intel processor with 256-bit register&hellip; but we can even the odds somewhat by disabling the AVX2 instructions on the Intel processor, and forcing to rely only on smaller 128-bit registers (and the old SSE instructions sets).

Another source of concern is that mobile processors run at a lower clock frequency. You cannot easily compensate for differences in clock frequencies.

So let us run some code and look at a table of results! [I make available the source code necessary to build an ios app to test the JSON parsing speed](https://github.com/lemire/iossimdjson). If you follow my instructions, you should be able to reproduce my results. To run simdjson on an Intel processor, [you can use the tools provided with the simdjson library](https://github.com/lemire/simdjson). I rely on GNU GCC 8.3.

file                     |AVX (Intel Skylake 3.7 GHz) |SSE (Intel Skylake 3.7 GHz) |ARM (Apple A12 2.5 GHz)  |
-------------------------|-------------------------|-------------------------|-------------------------|
gsoc-2018                |3.2 GB/s                 |1.9 GB/s                 |1.7 GB/s                 |
twitter                  |2.2 GB/s                 |1.4 GB/s                 |1.3 GB/s                 |
github_events            |2.4 GB/s                 |1.6 GB/s                 |1.2 GB/s                 |
update-center            |1.9 GB/s                 |1.3 GB/s                 |1.1 GB/s                 |


So we find that the Apple A12 processor is somewhere between an Intel Skylake processor with AVX disabled and a full Intel Skylake processor, if you account for the fact that it runs at a lower frequency.

Having wider registers and more powerful instructions is an asset: no matter how you look at the numbers, AVX instructions are more powerful than ARM SIMD instructions. Once Intel makes AVX-512 widely available, it may leave many ARM processors in the dust as far as highly optimized codebases are concerned. In theory, ARM processors are supposed to get more modern SIMD instructions (e.g., via the Scalable Vector Extension), but we are not getting our hands on them yet. It would be interesting to know whether Qualcomm and Apple have plans to step up their game.

__Note__: There are many other differences between the two tests (Intel vs. Apple). Among them is the compiler. The SSE and NEON implementations have not been optimized. For example, I merely ran the code on the Apple A12 without even trying to make it run faster. We just checked that the implementations are correct and pass all our tests.

__Credit__: The simdjson port to 128-bit registers for Intel processors (SSE4.2) was mostly done by [Sunny Gleason](https://twitter.com/sunnygleason), the ARM port was mostly done by [Geoff Langdale](https://branchfree.org) with code from Yibo Cai. [Io Daza Dillon](https://github.com/ioioioio) completed the ports, did the integration work and testing.

