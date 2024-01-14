---
date: "2012-05-31 12:00:00"
title: "Data alignment for speed: myth or reality?"
---



Some compilers align data structures so that if you read an object using 4 bytes, its memory address is divisible by 4. There are two reasons for data alignment:

- Some processors require data alignment. For example, the ARM processor in your 2005-era phone might crash if you try to access unaligned data. However, your x86 laptop will happily process unaligned data most times and [so will your 64-bit ARM mobile phone](http://infocenter.arm.com/help/index.jsp?topic=/com.arm.doc.ddi0360f/CDFEJCBH.html).
- It is widely reported that data alignment improves performances even on processors that support unaligned processing such as your x86 laptop. For example, [an answer on Stack Overflow](http://stackoverflow.com/questions/1496848/does-unaligned-memory-access-always-cause-bus-errors/1496881#1496881) states that <em>it is significantly slower to access unaligned memory (as in, several times slower)</em>. The top page returned by Google for [data alignment](http://www.songho.ca/misc/alignment/dataalign.html) states that <em>if the data is misaligned of 4-byte boundary, CPU has to perform extra work (&hellip;) this process definitely slows down the performance (&hellip;)</em>. In 2008, Alexander Sandler reported that unaligned accesses could require [twice the number of clock cycles](http://www.alexonlinux.com/aligned-vs-unaligned-memory-access).


So, data alignment is important for performance.

Is it?

Whether you are using a 64-bit ARM processor or an x64 processor, compilers will happily load machine words from &ldquo;unaligned&rdquo; using a single instruction. The following code will typically compile to just two instructions:
```C
  uint64_t x1;
  uint64_t x2;
  memcpy(&x1, c  ,sizeof(uint64_t));
  memcpy(&x2, c+1,sizeof(uint64_t));
```


(Note that the memcpy calls are used here to load a word, not to copy an array.) The memcpy calls are even compatible with autovectorization. But are unaligned load slower?

I decided to write a little program to test it out. My program takes a long array, it initializes it, and it computes a [Karp-Rabin-like](https://en.wikipedia.org/wiki/Rolling_hash#Rabin-Karp_rolling_hash) hash value from the result. It repeats this operation on arrays that have a different offset from an aligned boundary. For example, when it uses 4-byte integers, it will try offsets of 0, 1, 2 and 3. If aligned data is faster, then the case with an offset of 0 should be faster.

I repeat all tests 20 times and report the average wall clock time (in milliseconds). My source code in C++ is [available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2012/05/31/test.cpp).

__4-byte integers__

offset                   |Core i7                  |Core 2                   |
-------------------------|-------------------------|-------------------------|
0                        |28.1                     |34.1                     |
1                        |28.7                     |38.1                     |
2                        |28.7                     |38.1                     |
3                        |28.7                     |38.1                     |


__8-byte integers__

offset                   |Core i7                  |Core 2                   |
-------------------------|-------------------------|-------------------------|
0                        |33.6                     |69.1                     |
1                        |33.6                     |77                       |
2                        |33.6                     |77                       |
3                        |33.6                     |77                       |
4                        |33.6                     |77                       |
5                        |33.6                     |77                       |
6                        |33.6                     |77                       |
7                        |33.6                     |77                       |


__Analysis__:

In this experiment as well as in my practice, I see no evidence that unaligned data processing could be <em>several times</em> slower. On a cheap Core 2 processor, there is a difference of about 10% in my tests. On a more recent processor (Core i7), there is __no measurable difference__.

On recent Intel processors ([Sandy Bridge](https://en.wikipedia.org/wiki/Sandy_Bridge_(microarchitecture)) and [Nehalem](https://en.wikipedia.org/wiki/Nehalem_(microarchitecture))), [there is no performance penalty for reading or writing misaligned memory operands](http://www.agner.org/optimize/blog/read.php?i=142&amp;v=t) according to Agner Fog. There might be more of a difference on some AMD processors, but the busy AMD server I tested showed no measurable penalty due to data alignment.

Intel processors use 64-byte cache lines and if you need to load a register overlapping two cache lines, it might limit the best speed you can get. But we are not talking about a severalfold penalty except maybe if you need to lock the instruction or deal with atomic variables (for parallel programming). Thus it only matters in very specific code where loading and storing data from the fastest CPU cache is a critical bottleneck, and even then, you should not expect a large difference in most cases.

__My claim__: On recent Intel and 64-bit ARM processors, data alignment does not make processing a lot faster. It is a micro-optimization. Data alignment for speed is a myth.

__Acknowledgement__: I am grateful to [Owen Kaser](http://pizza.unbsj.ca/~owen/backup/) for pointing me to the references on this issue.

__Further reading__: Laurent Gauthier provided [a counter-example](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2012/05/31) where unaligned access is significantly slower (by 50%). However, it involves a particular setup where you read words separated by specific intervals. Furthermore, it appears that Laurent&rsquo;s example no longer shows a difference on more recent processors.

