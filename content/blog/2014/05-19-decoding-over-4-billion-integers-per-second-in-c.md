---
date: "2014-05-19 12:00:00"
title: "Decoding over 4 billion integers per second in C"
---



Programmers routinely work with lists of integers. [We recently showed](/lemire/blog/2012/09/12/fast-integer-compression-decoding-billions-of-integers-per-second/) how to compress such lists of integers close to their entropy, while being able to [decompress billions of integers per second](http://onlinelibrary.wiley.com/doi/10.1002/spe.2203/abstract).

To ensure anyone could do it, we published the [FastPFOR C++ library](https://github.com/lemire/FastPFOR). We also published the [JavaFastPFOR Java library](https://github.com/lemire/JavaFastPFOR) and there is even a corresponding [Go library](https://github.com/dataence/encoding).

However, I wanted to provide also a low-level C library that advanced programmers could embed deep in their own software without the inconvenience of a bulky C++ research library.

So we wrote the [SIMDComp library](https://github.com/lemire/simdcomp). It is a minimalist C library. On a recent PC, it will decompress integers at over 4 billion integers per second: less than one CPU cycle per integer. We use a liberal open source license so it should be suitable for all your projects.

To test it out for yourself, [grab a copy](https://github.com/lemire/simdcomp), and type &ldquo;make example; ./example&rdquo;.

