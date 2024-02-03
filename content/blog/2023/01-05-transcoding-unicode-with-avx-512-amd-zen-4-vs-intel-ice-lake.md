---
date: "2023-01-05 12:00:00"
title: "Transcoding Unicode with AVX-512: AMD Zen 4 vs. Intel Ice Lake"
---



Most systems today rely on Unicode strings. However, we have two popular Unicode formats: UTF-8 and UTF-16. We often need to convert from one format to the other. For example, you might have a database formatted with UTF-16, but you need to produce JSON documents using UTF-8. This conversion is often called &lsquo;transcoding&rsquo;.

In the last few years, we wrote a specialized library that process Unicode strings, with a focus on performance: the [simdutf library](https://github.com/simdutf/simdutf). The library is used by JavaScript runtimes ([Node JS](https://nodejs.org/en/) and [bun](https://bun.sh)).

The simdutf library is able to benefit from the latest and most powerful instructions on your processors. In particular, it does well with recent processors with AVX-512 instructions (Intel Ice Lake, Rocket Lake, as well as AMD Zen 4).

I do not yet have a Zen 4 processor, but Velu Erwan was kind of enough to benchmark it for me. A reasonable task is to transcode an Arabic file from UTF-8 to UTF-16: it is typically a non-trivial task because Arabic UTF-8 is a mix of one-byte and two-byte characters that we must convert to two-byte UTF-16 characters (with validation). The steps required (under Linux) are as follows:
```C
git clone https://github.com/simdutf/simdutf &&
cd simdutf &&
cmake -B build && cmake --build build &&
wget –content-disposition https://cutt.ly/d2cIxRx &&
./build/benchmarks/benchmark -F Arabic-Lipsum.utf8.txt -P convert_utf8
```


(Ideally, run the last command with privileged access to the performance counters.)

Like Intel, [AMD has its own compiler](https://developer.amd.com/amd-aocc/). I did not have access to the Intel compiler for my tests, but Velu has the AMD compiler.

A sensible reference point is the iconv function, as it is provided by the runtime library. The AMD processor is running much faster than the Intel core (5.4 GHz vs. 3.4 GHz). We use GCC 12.

transcoder               |Intel Ice Lake (GCC)     |AMD Zen 4 (GCC)          |AMD Zen 4 (AMD compiler) |
-------------------------|-------------------------|-------------------------|-------------------------|
iconv                    |0.70 GB/s                |0.97 GB/s                |0.98 GB/s                |
simdutf                  |7.8 GB/s                 |11 GB/s                  |12 GB/s                  |


At a glance, the Zen 4 processor is slightly less efficient on a per-cycle basis when running the simdutf AVX-512 code (2.8 instructions/cycle for AMD versus 3.1 instructions/cycle for Intel) but keep in mind that we did not have access to a Zen 4 processor when tuning our code. The efficiency difference is small enough that we can consider the processors roughly on par pending further investigations.

The big difference that the AMD Zen 4 runs at a much higher frequency. [If I rely on wikipedia](https://en.wikipedia.org/wiki/Ice_Lake_(microprocessor)), I do not think that there is an Ice Lake processor that can match the 5.4 GHz. However, [some Rocket Lake processors come close](https://en.wikipedia.org/wiki/Rocket_Lake).

In our benchmarks, we track the CPU frequency and we get the same measured frequency when running an AVX-512 as when running conventional code (iconv).  Thus AVX-512 can be really advantageous.

These results suggest that AMD Zen 4 is matching Intel Ice Lake in AVX-512 performance. Given that the Zen 4 microarchitecture is the first AMD attempt at supporting AVX-512 commercially, it is a remarkable feat.

__Further reading__: [AMD Zen 4 performance while parsing JSON](https://www.phoronix.com/review/amd-zen4-avx512/2) (phoronix.com).

__Note__: Raw AMD results are available: [GCC 12](http://pastebin.fr/113930) and [AOCC](http://pastebin.fr/113929).

__Credit__: Velu Erwan got the processor from AMD France. The exact specification is AMD 7950X, 2x16GB DDR5 4800MT reconfig as 5600MT. The UTF-8 to UTF-16 transcoder is largely based on the work of Robert Clausecker.

