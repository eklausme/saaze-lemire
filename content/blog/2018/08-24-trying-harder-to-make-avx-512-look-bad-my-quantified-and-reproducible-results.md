---
date: "2018-08-24 12:00:00"
title: "Trying harder to make AVX-512 look bad: my quantified and reproducible results"
---



Intel&rsquo;s latest processors have fancy instructions part of the AVX-512 family. The AVX-512 instructions are useful for numerical work and sophisticated computing (e.g., cryptography, multimedia), but not necessarily useful for mundane tasks. 

Intel documents that the use of AVX-512 instructions can lower the frequency of the processor. How big the effect is depends on the processor. 

Arguably, some of the best Intel processors are the Xeon Gold processors. They are readily available at cloud vendors like [Packet](https://www.packet.net).

I have written a new benchmark that computes, in parallel, some complicated mathematical result. Selectively, I can insert a few AVX-512 instructions in the code. These instructions do not help in any way the computation, I only insert them as an attempt to slow down the processor, as much as possible. That is, I am trying to make Intel look bad. [It is a follow-up on a similar single-threaded experience where I reported a barely noticeable effect due to AVX-512](/lemire/blog/2018/08/15/the-dangers-of-avx-512-throttling-a-3-impact/).

The more threads I use, the more work the program does. Each thread does the same work. So a 10-thread version does 10 times the work of a 1-thread version. The machine I am using has two 14-core processors. I am told that AVX-512 hurts these processors most when using 9 threads or more, per processor&hellip; so I go up to 20 threads. Intel distinguishes between simple AVX-512 instructions and heavy ones (such as multiplications).

[I give all my raw results and scripts](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/08/24), but here are the rounded up numbers:

number of threads        |no-AVX512                |simple AVX-512           |heavy AVX-512            |
-------------------------|-------------------------|-------------------------|-------------------------|
1 thread                 |0.945 s                  |0.985 s                  |0.985 s                  |
10 threads               |10.8 s                   |11 s                     |11 s                     |
20 threads               |21 s                     |25 s                     |25 s                     |


So at the extreme, doing everything I can do make Intel AVX-512 look bad using a few AVX-512 instructions in a larger program, I get a 15-20% increase in the running time.

Is that bad? If you are continuously using sporadic AVX-512 instructions over many cores and they don&rsquo;t accelerate your software by at least 20% on a fixed clock frequency budget, then you are losing out on this processor.

[As it turns out, you can get more severely hit by heavy AVX-512, but you have to do it in a sustained way](/lemire/blog/2018/08/25/avx-512-throttling-heavy-instructions-are-maybe-not-so-dangerous/).

__Further reading__: [AVX-512: when and how to use these new instructions](/lemire/blog/2018/09/07/avx-512-when-and-how-to-use-these-new-instructions/)

