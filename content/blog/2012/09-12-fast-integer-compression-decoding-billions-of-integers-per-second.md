---
date: "2012-09-12 12:00:00"
title: "Fast integer compression: decoding billions of integers per second"
---



Databases and search engines often store arrays of integers. In search engines, we have inverted indexes that map a query term to a list of document identifiers. This list of document identifiers can be seen as a sorted array of integers. In databases, indexes often work similarly: they map a column value to row identifiers. You also get arrays of integers in databases through dictionary coding: you map all column values to an integer in a one-to-one manner.

Our modern processors are good at processing integers. However, you also want to keep much of the data close to the CPU for better speed. Hence, computer scientists have worked on fast integer compression techniques for the last 4 decades. One of the earliest clever techniques is [Elias coding](https://en.wikipedia.org/wiki/Elias_gamma). Over the years, many new techniques have been developed: [Golomb and Rice coding](https://en.wikipedia.org/wiki/Golomb_coding), [Frame-of-Reference and PFOR-Delta](/lemire/blog/2012/02/08/effective-compression-using-frame-of-reference-and-delta-coding/), the Simple family, and so on.

The general story is that while people initially used bit-level codes (e.g., [gamma codes](https://en.wikipedia.org/wiki/Elias_gamma)), simpler byte-level codes like [Google&rsquo;s group varint](https://static.googleusercontent.com/media/research.google.com/en//people/jeff/WSDM09-keynote.pdf) are more practical. Byte-level codes like what Google uses do not compress as well, and there is less opportunity for fancy information theoretical mathematics. However, they can be much faster.

Yet we noticed that there was no trace in the literature of a sensible integer compression scheme running on desktop processor able to decompress data at a rate of billions of integers per second. The best schemes, such as [Stepanov](https://en.wikipedia.org/wiki/Alexander_Stepanov) et al.&rsquo;s [varint-G8IU](http://dl.acm.org/citation.cfm?id=2063627) report top speeds of 1.5 billion integers per second.
As your may expect, we eventually found out that it was entirely feasible to decoding billions of integers per second. We designed a new scheme that typically compress better than Stepanov et al.&rsquo;s varint-G8IU or Zukowski et al.&rsquo;s [PFOR-Delta](http://oai.cwi.nl/oai/asset/15564/15564B.pdf), sometimes quite a bit better, while being twice as fast over real data residing in RAM (we call it SIMD-BP128). That is, we cleanly exceed a speed of 2 billions integers per second on a regular desktop processor.

We posted our [paper](http://arxiv.org/abs/1209.2137) online together with [our software](https://github.com/lemire/FastPFor). Note that our scheme is __not__ patented whereas many other schemes are.

So, how did we do it? Some insights:

- We find that it is generally faster if we compress and decompress the integers in relatively large blocks (more than 4 integers). A common strategy is [bit packing](/lemire/blog/2012/03/06/how-fast-is-bit-packing/). We found that bit packing could be much faster (about twice as fast) if we used [vectorization](https://en.wikipedia.org/wiki/Vectorization_(parallel_computing)) (e.g., [SSE2](https://en.wikipedia.org/wiki/SSE2) instructions). Vectorization is the simple idea that your processor can process several values (say 4 integers) in one operation: for example, you can add 4 integers to 4 other integers with one instruction. Because bit unpacking is the key step in several algorithms, we can effectively double the decompression speed if we double the bit unpacking speed.- Most of the integer compression schemes rely on delta coding. That is, instead of storing the integers themselves, we store the difference between the integers. During decompression, we effectively need to compute the prefix sum. If you have taken calculus, think about it this way: we store the derivative and must compute the integral to recover the original function. We found out that this can use up quite a bit of time. And if you have doubled the speed of the rest of the processing, then it becomes a serious bottleneck. So we found that it is essential to also vectorize the computation of the prefix sum.


After all this work, it is my belief that, to be competitive, integer compression schemes need to fully exploit the vectorized instructions available in modern processors. That is, it is not enough to just write clean C or C++, you need to design vectorized algorithms from the ground up. However, it is not a matter of blindly coming up with a vectorized algorithm: getting a good speed and a good compression rate is a challenge.

__Credit__: This work was done with [Leonid Boytsov](http://searchivarius.org/about). We have also benefited from the help of several people. I am grateful to O. Kaser for our early work on this problem.

__Software__: A fully tested open source implementation is available from github. As caveat, we used C++11 so that a C++11 compiler is required (e.g., GNU GCC 4.7).

__Limitations__: To be able to compare various alternatives, we have uncoupled some decoding steps so that at least two passes are necessary over the data. In some cases, better speed could be possible if the processing was merged into one pass. We are working on further optimizations.

__Further reading__: [More database compression means more speed? Right?](/lemire/blog/2009/11/13/more-database-compression-means-more-speed-right/), [Effective compression using frame-of-reference and delta coding](/lemire/blog/2012/02/08/effective-compression-using-frame-of-reference-and-delta-coding/)

__Update__: The article has been accepted for publication in Software Practice &#038; Experience.

__Quick links__: [The paper](http://arxiv.org/abs/1209.2137), [the software](https://github.com/lemire/FastPFor).

