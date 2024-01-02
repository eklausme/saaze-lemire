---
date: "2010-04-01 12:00:00"
title: "External-Memory Sorting in Java"
---



__Update__: this code is now obsolete. Please see the corresponding [Github project](https://github.com/lemire/externalsortinginjava).

Sometimes, you want to sort large file without first loading them into memory. The solution is to use [External Sorting](https://en.wikipedia.org/wiki/External_sorting). Typically, you divide the files into small blocks, sort each block in RAM, and then merge the result.

Many database engines and the [Unix sort](https://en.wikipedia.org/wiki/Sort_(Unix)) command support external sorting. But what if you want to avoid a database? Or what if you want to sort in a non-lexicographic order? Or maybe you just want a simple external sorting example?

When I could not find such a simple program, I wrote one.

Please help me improve it. It needs:

- To be easy to modify: the code must remain simple.
- It must scale to very large files.
- While scalability and simplicity are most important, it must also be sensibly efficient.


Once we have a good solution, I plan to post it on Google code and add a link in the [External Sorting](https://en.wikipedia.org/wiki/External_sorting) wikipedia entry. If you contribute to the code, please add your name so you can get credit.

__Reference__: ExternalSort.java, http://pastebin.com/H57TZF7e

