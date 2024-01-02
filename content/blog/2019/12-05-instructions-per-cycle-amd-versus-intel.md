---
date: "2019-12-05 12:00:00"
title: "Instructions per cycle: AMD Zen 2 versus Intel"
---



The performance of a processor is determined by several factors. For example, processors with a higher frequency tend to do more work per unit of time. Physics makes it difficult to produce processors that have higher frequency.

Modern processors can execute many instructions per cycle. Thus a 3.4GHz processor has 3.4 billion cycles per second, but it might easily execute 7 billion instructions per second on a single core.

Up until recently, Intel produced the best commodity processors: its processors had the highest frequencies, the most instructions per cycle, the most powerful instructions and so forth. However, Intel is increasingly being challenged. One smaller company that is making Intel nervous is AMD.

[It has been reported that the most recent AMD processors](https://www.guru3d.com/articles_pages/amd_ryzen_7_3800x_review,9.html) surpass Intel in terms of instructions per cycle. However, it is not clear whether these reports are genuinely based on measures of instruction per cycle. Rather it appears that they are measures of the amount of work done per unit of time normalized by processor frequency.

In theory, a processor limited to one instruction per cycle could beat a modern Intel processor on many tasks if they had powerful instructions and faster data access. Thus &ldquo;work per unit of time normalized per CPU frequency&rdquo; and &ldquo;instructions per cycle&rdquo; are distinct notions.

I have only had access to a recent AMD processors (Zen 2) for a short time, but in this short time, I have routinely found that it has a lower number of instructions per cycle than even older Intel processors.

Let us consider a piece of software that has a high number of instructions per cycle, the fast JSON parser [simdjson](https://github.com/lemire/simdjson). I use GNU GCC 8 under Linux, I process a test file called twitter.json using the benchmark command line <tt>parse</tt>. I record the number of instructions per cycle, as measured by CPU counters, in the two stages of processing. The two stages together effectively parse a JSON document. This is an instruction-heavy benchmark: the numbers of mispredicted branches and cache misses are small. The Skylake processor has the highest frequency. I use an AMD Rome (server) processor.

I find that AMD is about 10% to 15% behind Intel.

processor                |IPC (stage 1)            |IPC (stage 2)            |
-------------------------|-------------------------|-------------------------|
[Intel Skylake](https://en.wikipedia.org/wiki/Skylake_(microarchitecture)) (2015) |3.5                      |3.0                      |
[Intel Cannon Lake](https://en.wikipedia.org/wiki/Cannon_Lake_(microarchitecture)) (2018) |3.6                      |3.1                      |
[Zen 2](https://en.wikipedia.org/wiki/Zen_2) (2019) |3.2                      |2.8                      |


Another problem that I like is bitset decoding. That is given an array of bits (0s and 1s), I want to find the location of the ones. See my blog post [Really fast bitset decoding for “average” densities](/lemire/blog/2019/05/03/really-fast-bitset-decoding-for-average-densities/). I benchmark just the &ldquo;basic&rdquo; decoder.
```C
void basic_decoder(uint32_t *base_ptr, uint32_t &base, 
  uint32_t idx, uint64_t bits) {
  while (bits != 0) {
    base_ptr[base] = idx + _tzcnt_u64(bits);
    bits = bits & (bits - 1);
    base++;
  }
}
```


[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/05/03).

processor                |IPC                      |
-------------------------|-------------------------|
[Intel Skylake](https://en.wikipedia.org/wiki/Skylake_(microarchitecture)) (2015) |2.1                      |
[Zen 2](https://en.wikipedia.org/wiki/Zen_2) (2019) |1.4                      |


So AMD runs at 2/3 the IPC of an old Intel processor. That is quite poor!

Of course, your results will vary. And I am quite willing to believe that in many, maybe even most, real-world cases, AMD Zen 2 can do more work per unit of work than the best Intel processors. However I feel that we should qualify these claims. I do not think it is entirely reasonable for AMD customers to expect better numbers of instructions per cycle on the tasks that they care about, and they may even find lower numbers. AMD Zen 2 does not dominate Intel Skylake, it is more reasonable to expect rough parity.

__Further reading__: [AMD Zen 2 and branch mispredictions](/lemire/blog/2019/12/06/amd-zen-2-and-branch-mispredictions/)



