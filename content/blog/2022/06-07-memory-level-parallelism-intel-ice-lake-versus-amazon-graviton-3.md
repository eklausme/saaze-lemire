---
date: "2022-06-07 12:00:00"
title: "Memory-level parallelism : Intel Ice Lake versus Amazon Graviton 3"
---



One of the most expensive operation in a processor and memory system is a random memory access. If you try to read a value in memory, it can take tens of nanosecond on average or more. If you are waiting on the memory content for further action, your processor is effectively stalled. While our processors are generally faster, the memory latency has not improved quickly and the latency can even be higher on some of the most expensive processors. For this reason, a modern processor core can issue multiple memory requests at a given time. That is, the processor tries to load one memory element, keeps going, and can issue another load (even though the previous load is not completed), and so forth. Not long ago, Intel processor cores could support about 10 independent memory requests at a time. I benchmarked some small ARM cores that could barely issue 4 memory requests.

Today, the story is much nicer. The powerful processor cores can all sustain many memory requests. They support better <em>memory-level parallelism</em>.

To measure the performance of the processor, we use a pointer-chasing scheme where you ask a C program to load a memory address which contains the next memory address and so forth. If a processor could only sustain a single memory request, such a test would use all available ressources. We then modify this test so that we have have two interleaved pointer-chasing scheme, and then three and then four, and so forth. We call each new interleaved pointer-chasing component a &lsquo;lane&rsquo;.

As you add more lanes, you should see better performance, up to a maximum. The faster the performance goes up as you add lane, the more memory-level parallelism your processor core has. The best Amazon (AWS) servers come with either Intel Ice Lake or Amazon&rsquo;s very own Graviton 3. I benchmark both of them, using a core of each type. The Intel processor has the upper hand in absolute terms. We achieve a 12 GB/s maximal bandwidth compared to 9 GB/s for the Graviton 3. The one-lane latency is 120 ns for the Graviton 3 server versus 90 ns for the Intel processor. The Graviton 3 appears to sustain about 19 simultaneous loads per core against about 25 for the Intel processor.

Thus Intel wins, but the Graviton 3 has nice memory-level parallelism&hellip; much better than the older Intel chips (e.g., Skylake) and much better than the early attempts at ARM-based servers.

<a href="https://lemire.me/blog/wp-content/uploads/2022/06/results.png"><img decoding="async" class="alignnone size-medium wp-image-19761" src="https://lemire.me/blog/wp-content/uploads/2022/06/results.png" alt width="70%" srcset="https://lemire.me/blog/wp-content/uploads/2022/06/results.png 640w, https://lemire.me/blog/wp-content/uploads/2022/06/results-300x225.png 300w" sizes="(max-width: 640px) 100vw, 640px" /></a>

[The source code is available](https://github.com/lemire/testingmlp). I am using Ubuntu 22.04 and GCC 11. All machines have small page sizes (4kB). I chose not to tweak the page size for these experiments.

Prices for Graviton 3 are 2.32&nbsp;$US/hour (64 vCPU) compared to 2.448&nbsp;$US/hour for Ice Lake. So Graviton 3 appears to be marginally cheaper than the Intel chips.

When I write these posts, comparing one product to another, there is always hate mail afterward. So let me be blunt. I love all chips equally.

If you want to know which system is best for your application: run benchmarks. [Comprehensive benchmarks found that Amazon&rsquo;s ARM hardware could be advantageous for storage-intensive tasks](https://redpanda.com/blog/aws-graviton-2-arm-vs-x86-comparison/).

__Further reading__: I enjoyed [Graviton 3: First Impressions](https://chipsandcheese.com/2022/05/29/graviton-3-first-impressions/).

