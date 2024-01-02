---
date: "2019-05-15 12:00:00"
title: "Bitset decoding on Apple´s A12"
---



In my post [Really fast bitset decoding for “average” densities](/lemire/blog/2019/05/03/really-fast-bitset-decoding-for-average-densities/), I reported on our work accelerating the decoding of bitsets. E.g., given a 64-bit register, you want to find the location of every 1-bit. So given 0b110011, you would want to get 0, 1, 4, 5. We want to do this operation with many such registers. When the content of the register is hard to predict, you can be almost certain to get a mispredicted branch with every new register to be decoded. On modern processors with deep and wide pipelines, these mispredictions can become a bottleneck.

On recent x64 processors, we find that it is beneficial to decode in bulk: e.g., assume that there are at least 4 set bits, decode them without checking whether there are four of them. The code might look as follow:
```C
  while (word != 0) {
    result[i] = trailingzeroes(word);
    word = word & (word - 1);
    result[i+1] = trailingzeroes(word);
    word = word & (word - 1);
    result[i+2] = trailingzeroes(word);
    word = word & (word - 1);
    result[i+3] = trailingzeroes(word);
    word = word & (word - 1);
    i+=4;
  }
```


So we are trading branches for a few more instructions. If the branches are easy to predict, that is a bad trade, but if the branches are hard to predict, it can be beneficial.

We consider the scenario where the input data contains neither very many nor very few 1-bit, and where their distribution is hard to predict. With our approach, we can get it down to less than 3.5 cycles per 1-bit decoded on recent Intel processors. To achieve this kind of speed, we retire nearly 2.5 instructions per cycle.

What about ARM processors? Sadly, I have not yet been able to reliably measure the same kind of high speed. The Linux-based ARM systems I have seem to be limited to a quasi-scalar execution mode, retiring never much more than 1.5 instructions per cycle. Either these ARM processors are not powerful enough, or else I am not benchmarking properly.

An additional difficulty is that ARM processors do not have a fast 64-bit population-count instruction (to determine the number of 1-bit per register). Instead, you must use an instruction which finds the number of 1-bit per byte, and sum that up using another instruction. So while one instruction suffices on an Intel processor, at least two (or more) instructions are necessary, and so the cost and total latency is higher. Similarly ARM processors lack a &ldquo;trailing zero&rdquo; instruction: you have to reverse the bit order and use a &ldquo;leading zero&rdquo; instruction. So maybe ARM processors are just fundamentally at a disadvantage on this task compared to Intel processors. But I am not convinced that it is the case. If I look at the instructions counts, they seem to be similar between ARM and Intel code. That is, while ARM makes you work harder to compute some operations, Intel has its own limitations. It may all average out.

So I&rsquo;d like to be certain that I have a powerful ARM processor to give ARM a fighting chance. Thankfully I do have many powerful ARM processors&hellip; I have one in my iPhone for example. Trouble is, I cannot instrument it and install Linux on it. I cannot easily use any compiler I&rsquo;d like. Still, I can run benchmarks and record the time elapsed. All I need to do is write a little mobile application. I record the nanoseconds per set bit. It seems that the Apple A12 in my iPhone is limited to 2.5 GHz, so I multiply the result by 2.5 to get the number of cycles.

conventional             |1.7 ns                   |4.125 cycles             |
-------------------------|-------------------------|-------------------------|
fast                     |1.2 ns                   |3 cycles                 |


If these numbers can be trusted, then the Apple A12 might possibly be more efficient than an Intel Skylake processor (3.5 cycles vs. 3 cycles). Given that Apple&rsquo;s A12 is reputed to have a really wide pipeline, this sounds credible.

Using Apple&rsquo;s Instruments tool, I got that the fast decoding approach runs at 3.7 instructions per cycle.

[My code is available](https://github.com/lemire/iosbitmapdecoding). If you have a Mac and an iPhone, you should be able to reproduce my results.

__Update__: The latest version of my code measures the clock speed as part of the benchmark.

