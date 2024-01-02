---
date: "2019-12-06 12:00:00"
title: "AMD Zen 2 and branch mispredictions"
---



Intel makes some of the very best processors many can buy. For a long time, its main rival (AMD) failed to compete. However, its latest generation of processors (Zen 2) appear to roughly match Intel, at a lower price point.

[In several benchmarks that I care about](/lemire/blog/2019/12/05/instructions-per-cycle-amd-versus-intel/), my good old Intel Skylake (2015) processor beats my brand-new Zen 2 processor.

To try to narrow it down, I create a fun benchmark. I run the follow algorithm where I generate random integers quickly, and then check the two least significant bits. By design, no matter how good the processor is, there should be one mispredicted branch per loop iteration.
```C
while (true) {
   r = random_integer()
   if (( r AND 1) == 1) {
     write r to output
   }
   if (( r AND 2) == 2) {
     write r to output
   }
}
```


I record the number of CPU cycles per loop iteration. This number is largely independent from processor frequency, memory access and so forth. The main bottleneck in this case is branch misprediction.

Intel Skylake            |29.7 cycles              |
-------------------------|-------------------------|
AMD Zen 2                |31.7 cycles              |


Thus it appears that in this instance the AMD Zen 2 has two extra cycles of penalty per mispredicted branch. If you run the same benchmark without the branching, the difference in execution time is about 0.5 cycles in favour of the Skylake processor. This suggests that AMD Zen 2 might waste between one to two extra cycles per mispredicted branch.

[My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/12/06). I define a docker container so my results are easy to reproduce.

