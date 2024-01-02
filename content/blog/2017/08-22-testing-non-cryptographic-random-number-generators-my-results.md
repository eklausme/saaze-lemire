---
date: "2017-08-22 12:00:00"
title: "Testing non-cryptographic random number generators: my results"
---



In software, we use random number generators to emulate &ldquo;randomness&rdquo; in games, simulations, probabilistic algorithms and so on. There are many definitions of what it means to be random, but in practice, what we do is run statistical tests on the output of the random number generators.

These tests are not perfect, because even a purely random sequence could fail particular tests just out of bad luck. Extraordinarily bad events do happen on occasion. However, we can repeat these tests and if they keep failing, we can gain confidence that something is wrong. By &ldquo;wrong&rdquo;, we mean that the output does not quite look random.

One concern is that running these tests can be difficult, and inconvenient. To alleviate this problem, I created a [GitHub repository](https://github.com/lemire/testingRNG) where you can find scripts that should allow you to test several different random number generators using a single command line.

I am focusing on fast non-cryptographic random number generators, the type that most programmers use for hash tables, simulations, games, and so forth. I stress that we are not interested in cryptographic security. Cryptography is a whole other world that we are going to leave to cryptographers.

__The contenders__

I chose the following generators since they are widespread and fast:

- splitmix64 is a random number generator part of the [standard Java API](https://docs.oracle.com/javase/8/docs/api/java/util/SplittableRandom.html) (SplittableRandom). It produces 64-bit numbers.
- pcg32 and pcg64 are instances of the PCG family designed by O&rsquo;Neill. They produce either 32-bit or 64-bit outputs.
- xorshift32 is a classical xorshift random number generator you can read about in textbooks.
- Finally, xorshift128plus and xoroshiro128plus are recently proposed random number generator by Vigna et al. They produce 64-bit numbers.


No doubt I could have added many more&hellip;

__Speed__

First, I decided to look at raw speed on recent x64 processors:

xoroshiro128plus         |0.85 cycles per byte     |
-------------------------|-------------------------|
splitmix64               |0.89 cycles per byte     |xorshift128plus          |0.91 cycles per byte     |pcg64                    |1.27 cycles per byte     |pcg32                    |1.81 cycles per byte     |xorshift32               |2.33 cycles per byte     |


Basically, splitmix64 and the generators proposed by Vigna et al. are roughly equally fast. O&rsquo;Neill&rsquo;s PCG schemes are slightly slower. I should point out that all of them are much faster than whatever your C library provides (<tt>rand</tt>).

Let us move on to statistical testing.

__Practically Random__

A convenient testing framework is [Practically Random](https://sourceforge.net/projects/pracrand/). It is a recently proposed piece of code that will eat as many random bytes as you want and check for randomness. You can let the program run for as long as you want. I went with a nice round number: I test 512GB of random bytes.

Only splitmix64 and the PCG schemes pass Practically Random (512GB).

You can, however, make xoroshiro128plus pass if you turn it into a 32-bit generator by dropping the least significant bits. Naturally, if you do so, you will diminish the speed of the generator by half. You might be able to do well by discarding fewer than 32 bits, but I did not investigate this approach because I prefer generators to produce either 32 bits or 64 bits.

__TestU01__

Another well-established framework is L&rsquo;Ecuyer&rsquo;s TestU01. I run TestU01 in &ldquo;big crush&rdquo; mode using different seeds. Only when I see repeated failures with distinct seeds do I report a failure.

- xoroshiro128+ fails MatrixRank and LinearComp
- splitmix64 passes
- xorshift128+ fails MatrixRank and LinearComp
- pcg32 passes
- pcg64 passes
- xorshift32 fails decisively


Evidently, L&rsquo;Ecuyer&rsquo;s big crush benchmark is hard to pass. I should stress that it is likely possible to cause more failures by changing the conditions of the tests. That is, it is not because I do not report a failure that one does not exist, I may simply not have detected it.

[I stress that these results are entirely reproducible. I provide all the software, all the scripts as well as my own outputs for public review.](https://github.com/lemire/testingRNG)

__Analysis__

- [ Blackman and Vigna report that xoroshiro128+ passes their big-crush tests](http://xoroshiro.di.unimi.it/xoroshiro128plus.c). Sadly, it does not pass my big-crush tests. Note that you can verify my results for yourself and rerun the code!Of course, Blackman and Vigna did run big crush and did get passing scores, but their testing conditions no doubt differ.

It is already documented that xoroshiro128+ fails practically random.
- Though xorshift128+ has been widely adopted, it fails both big crush and practically random. The failure is rather decisive.
- Fortunately, Java&rsquo;s splitmix64 appears to pass big crush and practically random.
- The PCG schemes pass all tests.


__Going forward!__

Part of my motivation when writing this blog post was [Vigna&rsquo;s remark](https://v8project.blogspot.ca/2015/12/theres-mathrandom-and-then-theres.html?showComment=1452592903162#c1549004517443909784): &ldquo;Note that (smartly enough) the PCG author avoids carefully to compare with xorshift128+ or xorshift1024*.&rdquo;

I am hoping that this blog post helps fill this gap. Evidently, my analysis is incomplete and we need to keep investigating. However, I hope that I have given you an interest for testing random number generators. If you grab my [GitHub repository](https://github.com/lemire/testingRNG), it should be easy to get started.

Speaking for myself, as an independent party, I would rather have independent assessments. It is fine for O&rsquo;Neill and Vigna to have Web sites where they compare their work to other techniques, but it is probably best for all of us if we collectively review these techniques independently. Please join me. To get you started: it is possible that I made mistakes. Please apply [Linus&rsquo;s Law](https://en.wikipedia.org/wiki/Linus%27s_Law) and help dig out the bugs!

What would be interesting is to help document better these random number generators. For example, [Xoroshiro128+ has a wikipedia entry](https://en.wikipedia.org/wiki/Xoroshiro128%2B) (that looks messy to me), but the other schemes I have considered do not, as far as I can tell, have wikipedia entries, yet they are worthy of documentation in my opinion.

I am also in the process of adding more generators to the benchmark.

__Disclaimer__: I have no vested interest whatsoever in the success or failure of any of these generators. As a Java programmer, I am slightly biased in favor of splitmix64, however.

__Further reading__: See [Xorshift1024*, Xorshift1024+, Xorshift128+ and Xoroshiro128+ fail statistical tests for linearity](https://www.sciencedirect.com/science/article/pii/S0377042718306265?dgcid=author), Journal of Computational and Applied Mathematics, to appear (Available online 22 October 2018)

