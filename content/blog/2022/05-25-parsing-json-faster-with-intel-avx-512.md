---
date: "2022-05-25 12:00:00"
title: "Parsing JSON faster with Intel AVX-512"
---



Many recent Intel processors benefit from a new family of instructions called AVX-512. These instructions operate over wide registers (up to 512 bits) and follow the [Single instruction, multiple data (SIMD) paradigm](https://en.wikipedia.org/wiki/Single_instruction,_multiple_data). These new AVX-512 instructions allow you to break some speed records, such as decoding [base64](https://en.wikipedia.org/wiki/Base64) data at [the speed of a memory copy](https://arxiv.org/abs/1910.05109).

Most modern processors have SIMD instructions. The AVX-512 instructions are wider (more bits per register), but that is not necessarily their main appeal. If you merely take existing SIMD algorithms and apply them to AVX-512, you will probably not benefit as much as you would like. It is true that wider registers are beneficial, but in superscalar processors (processors that can issue several instructions per cycle), the number of instructions you can issue per cycle matters as much if not more. Typically, 512-bit AVX-512 instructions are more expensive and the processor can issue fewer of them per cycle. To fully benefit from AVX-512, you need to carefully design your code. It is made more challenging by the fact that Intel is releasing these instructions progressively: the recent processors have many new powerful AVX-512 instructions that were not initially available. Thus, AVX-512 is not &ldquo;one thing&rdquo; but rather a family of instruction sets.

Furthermore, early implementations of the AVX-512 instructions often lead to measurable downclocking: the processor would reduce its frequency for a time following the use of these instructions. Thankfully, the latest Intel processors to support AVX-512 (Rocket Lake and Ice Lake) [have done away with this systematic frequency throttling](https://travisdowns.github.io/blog/2020/08/19/icl-avx512-freq.html). Thankfully, it is easy to detect these recent processors at runtime.

Amazon&rsquo;s powerful Intel servers are based on Ice Lake. Thus if you are deploying your software applications to the cloud on powerful servers, you probably have pretty good support for AVX-512 already !

A few years ago, we released a [really fast C++ JSON parser called simdjson](https://simdjson.org). It is somewhat unique as a parser in the fact that it relies critically on SIMD instructions. On several metrics, it was and still is the fastest JSON parser though other interesting competitors have emerged.

Initially, I had written a quick and dirty AVX-512 kernel for simdjson. We never merged it and after a time, I just deleted it. I then forgot about it.

Thanks to contributions from talented Intel engineers (Fangzheng Zhang and Weiqiang Wan) as well as indirect contributions from readers of this blog (Kim Walisch and Jatin Bhateja), we produced a new and shiny AVX-512 kernel. As always, keep in mind that the simdjson is the work of many people, a whole community of dozens of contributors. I must express my gratitude to Fangzheng Zhang who first wrote to me about an AVX-512 port.

[We just released in the latest version of simdjson](https://github.com/simdjson/simdjson/releases). It breaks new speed records.

Let us consider an interesting test where you seek to scan a whole file (spanning kilobytes) to find a value corresponding to some identifier. In simdjson, the code is as follows:
```C
   auto doc = parser.iterate(json);    
   for (auto tweet : doc.find_field("statuses")) {
      if (uint64_t(tweet.find_field("id")) == find_id) {
        result = tweet.find_field("text");
        return true;
      }
    }
    return false;
```


On a Tiger Lake processor, with GCC 11, I get a 60% increase in the processing speed, expressed by the number of input bytes processed per second.

simdjson (512-bit SIMD): new |7.4 GB/s                 |
-------------------------|-------------------------|
simdjson (256-bit SIMD): old |4.6 GB/s                 |


The speed gain is so important because in this task we mostly just read the data, and we do relatively little secondary processing. We do not create a tree out of the JSON data, we do not create a data structure.

The simdjson library has a minify function which just strips unnecessary spaces from the input. Maybe surprisingly, we are more than twice as fast as the previous baseline:

simdjson (512-bit SIMD): new |12 GB/s                  |
-------------------------|-------------------------|
simdjson (256-bit SIMD): old |4.3 GB/s                 |


Another reasonable benchmark is to fully parse the input into a DOM tree with full validation. Parsing a standard JSON file (<tt>twitter.json</tt>), I get nearly a 30% gain:

simdjson (512-bit SIMD): new |3.6 GB/s                 |
-------------------------|-------------------------|
simdjson (256-bit SIMD): old |2.8 GB/s                 |


While 30% may sound unexciting, we are starting from a fast baseline.

Could we do better? Assuredly. There are many AVX-512 instructions that we are not using yet. We do not use ternary Boolean operations (<tt>vpternlog</tt>). We are not using the new powerful shuffle functions (e.g., <tt>vpermt2b</tt>). We have an example of coevolution: better hardware requires new software which, in turn, makes the hardware shine.

Of course, to get these new benefits, you need recent Intel processors with adequate AVX-512 support and, evidently, you also need relatively recent C++ processors. Some of the recent laptop-class Intel processors do not support AVX-512 but you should be fine if you rely on AWS and have big Intel nodes.

You can grab our [release directly](https://github.com/simdjson/simdjson/releases/tag/v2.0.0) or wait for it to reach one of the standard package managers (MSYS2, conan, vcpkg, brew, debian, FreeBSD, etc.).

&nbsp;

__Note__: AMD Zen 4 has AVX-512 support and can run the simdjson AVX-512 kernel.

