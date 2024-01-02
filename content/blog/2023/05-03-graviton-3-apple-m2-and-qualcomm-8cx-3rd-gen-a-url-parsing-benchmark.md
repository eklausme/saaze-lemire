---
date: "2023-05-03 12:00:00"
title: "Graviton 3, Apple M2 and Qualcomm 8cx 3rd gen: a URL parsing benchmark"
---



Whenever you enter a URL into a system, it must be parsed and validated. It is a surprisingly challenging task: it may require hundreds of nanoseconds and possibly over a thousand cycles to parse a typical URL.

We can use URL parsing as a reasonable benchmark of a system performance. Of course, no single measure is sufficient&hellip; but URL parsing is interesting because it is a fairly generic task involving strings, and substrings, and characters searches and so forth.

I am going to compare the following ARM-based systems:

- <tt>c7g.large</tt>: Amazon Graviton 3 running Ubuntu 22.04 (GCC 11)
- <tt>macBook Air 2022</tt>: Apple M2 LLVM 14
- <tt>Windows Dev Kit 2023</tt>: Qualcomm 8cx 3rd gen running Ubuntu 22.04 (GCC 11) inside WSL (Windows 11)


The [Windows Dev Kit is a little plastic box](https://www.microsoft.com/en-us/d/windows-dev-kit-2023/94K0P67W7581?activetab=pivot:overviewtab) designed to allow Windows developers to get their applications ready for Windows for 64-bit ARM. It is a tiny low-power device that I leave on my desk. The Amazon Graviton 3 nodes from Amazon are their best ARM-based servers. The macBook Air contains one of the best laptop processors on the market.

The benchmark we run loads 100,000 URLs found on the top 100 most visited web sites. It is single-threaded and requires no disk or network access: it is a pure CPU test.

I run the following routine:

- <tt>git clone https://github.com/ada-url/ada</tt>
- <tt>cd ada</tt>
- <tt>cmake -B build -D ADA_BENCHMARKS=ON</tt>
- <tt>cmake --build build --target benchdata</tt>
- <tt>./build/benchmarks/benchdata --benchmark_filter=BasicBench_AdaURL_aggregator_href</tt>


Graviton 3               |285 ns/url               |
-------------------------|-------------------------|
Apple M2                 |190 ns/url               |
Qualcomm 8cx 3rd gen     |245 ns/url               |


We can also plot these average timings.

<a href="https://lemire.me/blog/wp-content/uploads/2023/05/Screenshot-2023-05-03-at-11.04.15-AM.png"><img decoding="async" class="alignnone size-large wp-image-20509" src="https://lemire.me/blog/wp-content/uploads/2023/05/Screenshot-2023-05-03-at-11.04.15-AM-1024x700.png" alt width="70%" srcset="https://lemire.me/blog/wp-content/uploads/2023/05/Screenshot-2023-05-03-at-11.04.15-AM-1024x700.png 1024w, https://lemire.me/blog/wp-content/uploads/2023/05/Screenshot-2023-05-03-at-11.04.15-AM-300x205.png 300w, https://lemire.me/blog/wp-content/uploads/2023/05/Screenshot-2023-05-03-at-11.04.15-AM-768x525.png 768w, https://lemire.me/blog/wp-content/uploads/2023/05/Screenshot-2023-05-03-at-11.04.15-AM.png 1036w" sizes="(max-width: 1024px) 100vw, 1024px" /></a>

On this particular benchmark, the Qualcomm processor is 30% slower than the Apple M2 processor. That is to be expected: Apple Silicon is generally superior.

However, in this particular test, the Qualcomm system beats the Graviton 3 node from Amazon. On a related benchmark, [I showed that the Graviton 3 had competitive performance and could beat state-of-the-art Intel Ice Lake nodes](/lemire/blog/2023/03/01/arm-vs-intel-on-amazons-cloud/). [Amazon themselves claim that Graviton 3 instances might be superior for machine learning tasks](https://aws.amazon.com/fr/blogs/machine-learning/optimized-pytorch-2-0-inference-with-aws-graviton-processors/).

We can try to correct for frequency differences. The Graviton runs at 2.6 GHz, the Apple M2 runs at 3.5 GHz and the Qualcomm processor at 3.0 GHz. Let us correct the numbers:

Graviton 3 (model)       |245 ns/url (corrected for 3 GHz) |
-------------------------|-------------------------|
Apple M2 (model)         |220 ns/url (corrected for 3 GHz) |
Qualcomm 8cx 3rd gen     |245 ns/url               |


Note that you cannot blindly correct for frequency in this manner because it is not physically possible to just change the frequency as I did: it is a model to help us think.

Overall, these numbers suggest that the Qualcomm processor is competitive. It is not likely to establish speed records, but I would not shy away from a Qualcomm-based system if it is meant for low power usage.

How likely is it that my results are misleading? They seem to match roughly the results that Alex Ellis got running a more complete benchmark:

<a href="https://twitter.com/alexellisuk/status/1587041579042217986"><img decoding="async" class="alignnone size-large wp-image-20511" src="https://lemire.me/blog/wp-content/uploads/2023/05/Screenshot-2023-05-03-at-11.27.15-AM-983x1024.png" alt width="70%" srcset="https://lemire.me/blog/wp-content/uploads/2023/05/Screenshot-2023-05-03-at-11.27.15-AM-983x1024.png 983w, https://lemire.me/blog/wp-content/uploads/2023/05/Screenshot-2023-05-03-at-11.27.15-AM-288x300.png 288w, https://lemire.me/blog/wp-content/uploads/2023/05/Screenshot-2023-05-03-at-11.27.15-AM-768x800.png 768w, https://lemire.me/blog/wp-content/uploads/2023/05/Screenshot-2023-05-03-at-11.27.15-AM.png 1068w" sizes="(max-width: 983px) 100vw, 983px" /></a>

So I believe that my result is roughly correct: Qualcomm is inferior to Apple Silicon, but not by a very wide margin.

A separate issue is the Windows performance itself. Much of Windows is still x86 specific and though Windows can run x86 applications in emulation under 64-bit ARM, there is a penalty which could be substantial. Nevertheless, my own experience has been quite good. Of course, I do not play games on these machines nor do I do video editing. Your mileage will vary.

__Further reading__: [Linux on Microsoft Dev Kit 2023](https://blog.alexellis.io/linux-on-microsoft-dev-kit-2023/)

