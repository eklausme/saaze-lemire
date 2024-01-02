---
date: "2023-03-01 12:00:00"
title: "ARM vs Intel on Amazon´s cloud: A URL Parsing Benchmark"
---



Twitter user opdroid1234 remarked that [they are getting more performance out of the ARM nodes than out of the Intel nodes on Amazon&rsquo;s cloud (AWS)](https://twitter.com/opdroid1234/status/1631041253843382274).

<a href="https://lemire.me/blog/wp-content/uploads/2023/03/Capture-decran-le-2023-03-01-a-17.48.42.png"><img loading="lazy" decoding="async" class="alignnone size-medium wp-image-20258" src="https://lemire.me/blog/wp-content/uploads/2023/03/Capture-decran-le-2023-03-01-a-17.48.42.png" alt width="600" height="206" srcset="https://lemire.me/blog/wp-content/uploads/2023/03/Capture-decran-le-2023-03-01-a-17.48.42.png 1166w, https://lemire.me/blog/wp-content/uploads/2023/03/Capture-decran-le-2023-03-01-a-17.48.42-300x103.png 300w, https://lemire.me/blog/wp-content/uploads/2023/03/Capture-decran-le-2023-03-01-a-17.48.42-1024x351.png 1024w, https://lemire.me/blog/wp-content/uploads/2023/03/Capture-decran-le-2023-03-01-a-17.48.42-768x263.png 768w" sizes="(max-width: 600px) 100vw, 600px" /></a>

I found previously that the [Graviton 3 processors had less bandwidth than comparable Intel systems](/lemire/blog/2022/06/07/memory-level-parallelism-intel-ice-lake-versus-amazon-graviton-3/). However, I have not done much in terms of raw compute power.

The Intel processors have the crazily good AVX-512 instructions: ARM processors have nothing close except for dedicated accelerators. But what about more boring computing?

We wrote a fast [URL parser](https://github.com/ada-url/ada) in C++. It does not do anything beyond portable C++: no assembly language, no explicit SIMD instructions, etc.

Can the ARM processors parse URLs faster?

I am going to compare the following node types:

- <tt>c6i.large</tt>: Intel Ice Lake (0.085 US$/hour)
- <tt>c7g.large</tt>: Amazon Graviton 3 (0.0725 US$/hour)


I am using Ubuntu 22.04 on both nodes. I make sure that cmake, ICU and GNU G++ are installed.

I run the following routine:

- <tt>git clone https://github.com/ada-url/ada</tt>
- <tt>cd ada</tt>
- <tt>cmake -B build -D ADA_BENCHMARKS=ON</tt>
- <tt>cmake --build build</tt>
- <tt>./build/benchmarks/bench --benchmark_filter=Ada</tt>


The results are that the ARM processor is indeed slightly faster:

Intel Ice Lake           |364 ns/url               |
-------------------------|-------------------------|
Graviton 3               |320 ns/url               |


The Graviton 3 processor is about 15% faster. It is not the 20% to 30% that opdroid1234 reports, but the Graviton 3 nodes are also slightly cheaper.

Please note that (1) I am presenting just one data point, I encourage you to run your own benchmarks (2) I am sure that opdroid1234 is being entirely truthful (3) I love all processors (Intel, ARM) equally (4) I am not claiming that ARM is better than Intel or AMD.

__Note__: I do not own stock in ARM, Intel or Amazon. I do not work for any of these companies.

__Further reading__: [Optimized PyTorch 2.0 inference with AWS Graviton processors](https://aws.amazon.com/fr/blogs/machine-learning/optimized-pytorch-2-0-inference-with-aws-graviton-processors/)

