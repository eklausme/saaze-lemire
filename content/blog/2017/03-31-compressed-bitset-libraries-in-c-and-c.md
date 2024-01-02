---
date: "2017-03-31 12:00:00"
title: "Compressed bitset libraries in C and C++"
---



The bitset data structure is a clever way to represent efficiently sets of integers. It supports fast set operations such as union, difference, intersection. For better scalability, we compress bitsets. Bitsets are not always the right data structure, but when they are applicable, they work well.

Here are some open-source libraries implementing (compressed) bitsets in C and C++:

- [CRoaring](https://github.com/RoaringBitmap/CRoaring): It implements the [Roaring compressed format](http://roaringbitmap.org/) in C, with a C++ wrapper. Works with GCC, clang, and Visual Studio. Hosted on GitHub.
- [EWAHBoolArray](https://github.com/lemire/EWAHBoolArray): It implements the EWAH compressed format in C++. A C version of this library is included, in part, within Git, a tool familiar to many programmers. Similar to WAH and Concise (see below), but faster. Works with GCC, clang, and Visual Studio. Hosted on GitHub.
- [cbitset](https://github.com/lemire/cbitset): It implements an uncompressed bitset in C. Works with GCC and clang. Hosted on GitHub.
- [Concise](https://github.com/lemire/Concise): This C++ library implements both the WAH and CONCISE compressed formats. Works with GCC and clang. Hosted on GitHub.
- [BitMagic](http://bmagic.sourceforge.net/): This C++ library implements its own compressed format. Somewhat similar to Roaring, but can use more memory. Works with GCC, clang, Visual Studio. Hosted on sourceforge.


I can vouch for all of these libraries: I would use them in production. They are all available under liberal licenses. I should add that I am involved with all of them, except BitMagic.

