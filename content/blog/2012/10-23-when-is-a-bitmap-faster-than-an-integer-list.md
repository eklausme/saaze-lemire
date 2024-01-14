---
date: "2012-10-23 12:00:00"
title: "When is a bitmap faster than an integer list?"
---



You can represent a list of distinct integers no larger than _N_ using exactly _N_ bits: if the integer _i_ appears in your list, you set the _i_ <sup>th</sup> bit to true. Bits for which there is no corresponding integers are set to false. For example, the integers 3, 4, 7 can be represented as 00011001. As another example, the integers 1, 2, 7 can be represented as 01100001.

Bitmaps are great to compute intersections and unions fast. For example, to compute the union between 3, 4, 7 and 1, 2, 7, all I need to do is compute the bitwise OR between 00011001 and 01100001 (=01111001) which a computer can do in one CPU cycle. Similarly, the intersection can be computed as the bitwise AND between 00011001 and 01100001 (=00000001).
Though it does not necessarily make use of fancy SSE instructions on your desktop, bitmaps are nevertheless an example of [vectorization](https://en.wikipedia.org/wiki/Vectorization_(parallel_computing)). That is, we use the fact that the processor can process several bits with one instruction.

There are some downsides to the bitmap approach: you first have to construct the bitmaps and then you have to extract the set bits. Thankfully, there are fast algorithms to decode bitmaps.
Nevertheless, we cannot expect bitmaps to be always faster. If most bits are set to false, then you are better off working over sets of sorted integers. So where is the threshold?

I decided to use the JavaEWAH library to test it out. This library is used, among other things, by [Apache Hive](http://hive.apache.org/) to index queries over Hadoop. JavaEWAH uses compressed bitmaps (see [Lemire at al. 2010](http://arxiv.org/abs/0901.3751) for details) instead of the simple bitmaps I just described, but the core idea remains the same. I have also added a simpler [sparse bitmap implementation](https://github.com/lemire/sparsebitmap) to this test.

I generated random numbers using the ClusterData model proposed by [Vo Ngoc Anh and Alistair Moffat](http://onlinelibrary.wiley.com/doi/10.1002/spe.948/abstract). It is a decent model for &ldquo;real-world data&rdquo;.

Consider the computation of the intersection between any two random sets of integers. The next figure gives the speed (in millions of integers per second) versus the density measured as the number of integers divided by the range of values. The &ldquo;naive&rdquo; scheme refer to an intersection computed over a list of integers (without bitmaps).

I ran the test on a desktop core i7 computer.
__Conclusion__: Unsurprisingly, the break-even sparsity for JavaEWAH is about 1/32: if you have more than 1000 integers in the range [0,32000) then bitmaps might be faster than working over lists of integers. Of course, better speed is possible with some optimization and your data may differ from my synthetic data, but we have a ballpark estimate. A simpler [sparse bitmap implementation](https://github.com/lemire/sparsebitmap) can be useful over sparser data though it comes at a cost: the best speed is reduced compared to EWAH.

__Source code__: As usual, I provide [full source code](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2012/10/23) so that you can reproduce my results.

__Update__: This post was updated on Oct. 26th 2012.
