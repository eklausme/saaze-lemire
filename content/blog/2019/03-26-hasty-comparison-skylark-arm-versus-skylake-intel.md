---
date: "2019-03-26 12:00:00"
title: "Hasty comparison: Skylark (ARM) versus Skylake (Intel)"
---



In a [previous post](/lemire/blog/2019/03/20/arm-and-intel-have-different-performance-characteristics-a-case-study-in-random-number-generation/), I ran a benchmark on an ARM server and again on an Intel-based server.  My purpose was to indicate that if one function is faster, even much faster, on one processor, you are not allowed to assume that it will also be faster on a vastly different processor. It wasn&rsquo;t meant to be a deep statement, but even simple facts need illustration. Nevertheless, it was interpreted as an ARM versus Intel comparison.

In the initial numbers that I offered, the ARM Skylark processor that I am using did very poorly compared to the Intel Skylake processor. Eric Wallace explained away the result:  The default compiler on my Linux CentOS machine appears to be unaware of my processor architecture (ARM Aarch64) and, incredibly enough, compiles the code down to 32-bit ARM instructions.

So let us get serious and use a recent compiler (GNU GCC 8) from now on.

And while we are at it, let us do a Skylark versus Skylake, ARM versus Intel, benchmark. I am going to pick three existing C programs from the [Computer Language Benchmark Games:](https://benchmarksgame-team.pages.debian.net/benchmarksgame/)

1. Binarytree is a memory access benchmark. The code constructs binary trees and must traverse them.
1. Mandelbrot is a number crunching benchmark.
1. Fasta is a randomized string generation benchmark.


The Skylark processor is from a 32-core box, the reported maximum frequency is 3.3GHz. The Skylake processor is from a 4-core box with a maximal frequency of 4GHz. Here are the numbers I get.

&nbsp;                   |Skylark (ARM)            |Skylake (Intel)          |
-------------------------|-------------------------|-------------------------|
Binarytree               |80 s                     |16 s                     |
Mandelbrot               |15 s                     |24 s                     |
Fasta                    |2.0 s                    |0.8 s                    |


[My benchmark is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/03/26).

What can we conclude from these numbers? Nothing except maybe that the Skylark box struggles with Binarytree. That benchmark is dominated by the cost of memory allocation/deallocation.

Let me try another benchmark, this time from the [cbitset library](https://github.com/lemire/cbitset):

&nbsp;                   |Skylark (ARM)            |Skylake (Intel)          |
-------------------------|-------------------------|-------------------------|
create                   |23 ms                    |4.0 ms                   |
bitset_count             |3.2 ms                   |4.4 ms                   |
iterate                  |5.0 ms                   |4.0 ms                   |


The &ldquo;create&rdquo; benchmark is basically a memory-intensive test, whereas the two other tests are computational. Again, it seems that ARM server struggles with memory allocations.

Is that something that has to do with the processor or the memory subsystem? Or is it a matter of compiler and standard libraries?

__Update__: Though the ARM processor has a relatively CentOS distribution, it comes with an older C library. Early testing seems to suggest that this software difference accounts for a sizeable fraction (though not all) of the performance gap between Skylake and Skylark.

__Update 2__: Using &lsquo;jemalloc&rsquo;, the &lsquo;Binarytree&rsquo; goes from 80 s to 44 s while the &lsquo;create&rsquo; timing goes from 23 ms to 13 ms. This gives me confidence that some of the performance gap reported about between Skylake and Skylark is due to software differences.

