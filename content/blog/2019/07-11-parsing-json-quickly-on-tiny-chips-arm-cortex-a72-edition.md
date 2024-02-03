---
date: "2019-07-11 12:00:00"
title: "Parsing JSON quickly on tiny chips (ARM Cortex-A72 edition)"
---



[I own an inexpensive card-size ROCKPro64 computer ($60)](/lemire/blog/2019/05/14/setting-up-a-rockpro64-powerful-single-card-computer/). It has a ARM Cortex-A72 processors, the same processors you find in the recently released [Raspberry Pi 4](https://www.amazon.com/CanaKit-Raspberry-Basic-Kit-2GB/dp/B07TYK4RL8/). These are processors similar to those you find in your smartphone, although they are far less powerful than the best Qualcomm and Apple have to offer.

A common task in data science is to parse [JSON documents](https://www.json.org). [We wrote a fast JSON parser in C++ called simdjson](https://github.com/lemire/simdjson); to go fast, it uses fancy (&lsquo;[SIMD](https://en.wikipedia.org/wiki/SIMD)&lsquo;) instructions. I wondered how well it would fare on the ARM Cortex-A72 processor.

I am comparing against to top-of-the-line fast parsers (RapidJSON and sajson). I cannot stress enough how good these parsers are: out of dozens of JSON parsers, they clearly stand out. I think it is fair to say that RapidJSON is the &lsquo;standard&rsquo; parser in C++. Of course, our parser (simdjson) is good too.

Here are the speeds compared on some of our standard documents, I use GNU GCC 8.3.

file                     |simdjson                 |RapidJSON                |sajson*                  |
-------------------------|-------------------------|-------------------------|-------------------------|
twitter                  |0.39 GB/s                |0.14 GB/s                |0.27 GB/s                |
update-center            |0.35 GB/s                |0.14 GB/s                |0.27 GB/s                |
github_events            |0.39 GB/s                |0.20 GB/s                |0.29 GB/s                |
gsoc-2018                |0.52 GB/s                |0.20 GB/s                |0.36GB/s                 |


So it is interesting to note that code optimized with fancy &lsquo;[SIMD](https://en.wikipedia.org/wiki/SIMD)&lsquo; instructions runs fast even on small ARM processors.

Yet these speeds are far below what is possible on better processors. Our simdjson parser on an Intel processor can easily achieve speeds well beyond 2 GB/s. There are at least three reasons for the vast difference:

1. Intel processors have &lsquo;faster&rsquo; instructions (AVX2) that can process 256-bit registers. There is no equivalent on ARM. In our case, this means that the Intel processor only need about 75% as many instructions as the ARM processors.
1. Intel processors run at a higher clock. It is easy to find an Intel processor that reach 3.5 GHz or more, maybe much more. My ROCKPro64 runs at 1.8 GHz, so roughly half the speed.
1. Intel processors easily retire 3 instructions per cycle on a task like JSON parsing whereas the ARM Cortex-A72 is capable of about half of that.


The last two points alone explain about a 4x difference in favour of Intel processors.

To reproduce the results, using [Docker](https://www.docker.com), you can do&hellip;
```C
git clone https://github.com/lemire/simdjson.git
cd simdjson
docker build -t simdjson .
docker run --privileged -t simdjson
```


__Credit__: [Geoff Langdale](https://branchfree.org) with contributions from Yibo Cai and [Io Daza Dillon](https://github.com/ioioioio).

&nbsp;

*- sajson does not do complete UTF-8 validation unlike the other two parsers.

&nbsp;

