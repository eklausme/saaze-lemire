---
date: "2018-01-02 12:00:00"
title: "Multicore versus SIMD instructions: the &#8220;fasta&#8221; case study"
---



Setting aside graphics processors, most commodity processors support at least two distinct parallel execution models.

1. Most programmers are familiar with the multicore model whereas we split the computation into distinct parts that get executed on distinct cores using threads or goroutine.Speeding up your program by using many cores is not exactly free, however. The cores you are using are not available to the other programs on your machine. Thus you may be able to complete the processing faster, but it is unclear if, all things said, you are going to use less energy. Moreover, on a busy server, multicore processing could offer little gain.

More critically, as a rule, you should not expect your program to go _N_ times faster even if you have _N_ cores. Even when your problems are conveniently [embarrassingly parallel](https://en.wikipedia.org/wiki/Embarrassingly_parallel), it can be difficult to scale in practice with the number of cores you have.

It is not uncommon for threaded programs to run slower.
1. There is another parallelization model: vectorization. Vectorization relies on [Single instruction, multiple data (SIMD) instructions](https://en.wikipedia.org/wiki/SIMD). It is relatively easy for hardware engineers to design SIMD instructions, so most processors have them.Sadly, unlike multicore programming, there is very little support within programming languages for vectorization. For the most part, you are expected to hope that your compiler will automatically vectorize your code. It works amazingly well, but compilers simply do not reengineer your algorithms&hellip; which is often what is needed to benefit fully from vectorization.


My belief is that the performance benefits of vectorization are underrated.

As an experiment, I decided to look at the [fasta benchmark](http://benchmarksgame.alioth.debian.org/u64q/fasta.html) from the [Computer Language Benchmarks Game](http://benchmarksgame.alioth.debian.org). It is a relatively simple &ldquo;random generation&rdquo; benchmark. As is typical, you get the best performance with C programs. I ran the current best-performing programs for [single-threaded (one core)](http://benchmarksgame.alioth.debian.org/u64q/program.php?test=fasta&amp;lang=gcc&amp;id=5) and [multithreaded (multicore) execution](http://benchmarksgame.alioth.debian.org/u64q/program.php?test=fasta&amp;lang=gcc&amp;id=2). The multicore approach shaves about 30% of the running time, but it uses the equivalent of two cores fully:

&nbsp;                   |elapsed time             |total time (all CPUs)    |
-------------------------|-------------------------|-------------------------|
single-threaded          |1.36 s                   |1.36 s                   |
multicore                |1.00 s                   |2.00 s                   |


Is the multicore approach &ldquo;better&rdquo;? It is debatable. There are many more lines of code, and the gain is not large.

The numbers on the Computer Language Benchmarks Game page differs from my numbers but the conclusion is the same: the multicore version is faster (up to twice as fast) but it uses twice the total running time (accounting for all CPUs).

I decided [to reengineer the single-threaded approach so that it would be vectorized](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2018/01/02/simdfasta.c). Actually, I only vectorized a small fraction of the code (what amounts to maybe 20 lines in the original code).

&nbsp;                   |elapsed time             |total time (all CPUs)    |
-------------------------|-------------------------|-------------------------|
vectorized               |0.31 s                   |0.31 s                   |


I am about four times faster, and I am only using one core.

My version is not strictly equivalent to the original, so extra work would be needed to qualify as a drop-in replacement, but I claim that it could be done without performance degradation.

[I make my code available so that you can easily reproduce my results](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/01/02) and correct as needed. Your results will vary depending on your compiler, hardware, system, and so forth.

