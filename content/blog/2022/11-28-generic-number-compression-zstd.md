---
date: "2022-11-28 12:00:00"
title: "Generic number compression (zstd)"
---



I have done a lot of work that involves compressing and uncompressing data. Most often, I work on data that has specific characteristics, e.g., sorted integers. In such cases, one can do much better than generic compression routines (e.g., [zstd](https://en.wikipedia.org/wiki/Zstd), gzip) both in compression ratios and performance.

But how well do these generic techniques do for random integers and floats?

1. We generate 32-bit floats in the interval [0,1] and store then as double-precision (64-bit) floats. Roughly speaking, it should be possible to compress this data by a factor of two.
1. We generate 64-bit integers in the range [-127,127]. We should be able to compress this data by a factor of eight (from eight bytes to one byte).


What are the results? I use zstd v1.5.2 (with default flags) and a [couple of small programs](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2022/11/28).

source                   |compression ratio        |
-------------------------|-------------------------|
32-bit floats as 64-bit floats |2x                       |
64-bit integers in the range [-127,127] |5x                       |


The compression ratio is pretty good for the floating-point test, nearly optimal. For the 64-bit integers, the results are less exciting but you are within a factor of two of the ideal compression ratio.

__Update__: As reported in the comments, you can get much better compression ratios if you request more aggressive compression, although it also takes much more time.

