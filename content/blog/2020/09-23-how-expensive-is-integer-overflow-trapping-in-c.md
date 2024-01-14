---
date: "2020-09-23 12:00:00"
title: "How expensive is integer-overflow trapping in C++?"
---



Integers in programming languages have a valid range but arithmetic operations can result in values that exceed such ranges. For example, adding two large integers can result in an integer that cannot be represented in the integer type. We often refer to such error conditions as overflows.

In a programming languages like Swift, an overflow will result in the program aborting its execution. The rationale is that once an arithmetic operation has failed, everything else the program might be doing is suspect and you are better off aborting the program. Most other programming languages are not so cautious. For example, a Rust program compiled in release mode will not abort by default.

In C++, most compilers will simply ignore the overflow. However, popular compilers give you choices. When using GCC and clang, you can specify that integer overflows should result in a program crash (abort) using the <tt>-ftrapv</tt> flag.

I was curious about the performance implications so [I wrote a small program that simply adds all of the values in a large array](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2020/09/23). The answer I sought turns out to depend critically on the choice of compiler:

&nbsp;                   |GCC 9                    |clang 9                  |
-------------------------|-------------------------|-------------------------|
no trapping              |0.17 ns/int              |0.11 ns/int              |
trapping                 |2.1 ns/int               |0.32 ns/int              |
slowdown                 |12 x                     |3 x                      |


With no trapping, the clang compiler beats GCC (0.11 vs. 0.17) by a 50% margin but this should not preoccupy us too much: it is a single microbenchmark.

What is a lot more significant is that enabling overflow trapping in GCC incurs an order of magnitude slowdown. Though it is only one microbenchmark, the size of the result suggests that we should be concerned. Looking at the assembly, I find that the clang compiler generates sensible code on x64 processor, with simple jumps added when the overflow is detected. Meanwhile, GCC seems to call poorly optimized runtime library functions.

Overall this one test does establish that checking for overflows can be expensive.
__Credit__: This blog post was motivated by an email by Stefan Kanthak.

