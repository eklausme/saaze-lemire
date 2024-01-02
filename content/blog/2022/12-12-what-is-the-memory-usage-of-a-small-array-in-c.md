---
date: "2022-12-12 12:00:00"
title: "What is the memory usage of a small array in C++?"
---



In an earlier blog post, I reported that the memory usage of a small byte array in Java (e.g., an array containing 4 bytes) was about 24 bytes. In other words: allocating small blocks of memory has substantial overhead.

What happens in C++?

To find out, I can try to allocate one million 4-byte arrays and look at the total memory usage of the process. Of course, the memory usage of the process will include some overhead unrelated to the 4-byte arrays, but we expect that such overhead will be relatively small.

[From my benchmark](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2022/12/12), I get the following results&hellip;

system                   |memory usage (in bytes)  |
-------------------------|-------------------------|
GCC 8, Linux x86         |32 bytes                 |
LLVM 14, Apple aarch64   |16 bytes                 |


The results will vary depending on the configuration of your system, on your optimization level, and so forth.

But the lesson is that allocating four bytes (<tt>new char[4]</tt> or <tt>malloc(4)</tt>) does not use four bytes of memory&hellip; it will generally use much more.

