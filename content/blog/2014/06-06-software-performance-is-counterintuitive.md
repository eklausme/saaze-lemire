---
date: "2014-06-06 12:00:00"
title: "Software performance is&#8230; counterintuitive"
---



There is a long tradition among computer scientists of counting the number of operations as a way to estimate the running cost of an algorithm. Many computer scientists and naive programmers believe that adding extra instructions to a piece of code necessarily slows this down.

This is just wrong. If the initial piece of code was dirt cheap, adding more instructions may come for free.

Let me give you an example. I work a lot with [bitmaps](https://en.wikipedia.org/wiki/Bitmap_index). A bitmap, in my context, is just an array of bits (bitset) that we pack into machine-size words (e.g., 64-bit integers). We can use them to represent sets of integers: the integer _i_ is in the set if the <em>i</em>th bit is set to true. The union between two such sets can be computed with a bitwise OR:
```C

for(int k = 0; k < length; ++k) {
  output[k] = input1[k] | input2[k];
}
```


Another common operation on bitmaps is the computation of their cardinality: the number of bits set to true or 1. The compiler I am using (GCC) provides a useful function to compute the number of 1s in a 64-bit word (<tt>__builtin_popcountl</tt>). So we can compute both the union of the two bitmaps and the cardinality of the result in one pass:
```C

int card = 0;
for(int k = 0; k < length; ++k) {
   output[k] = input1[k] | input2[k];
   card += __builtin_popcountl(output[k]);
}
return card;
```


This new loop looks a lot more expensive than the previous one. It does a lot more work!

[I implemented both in C](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2014/06/06/card.c) and benchmarked them on a recent PC (haswell, gcc 4.8). Here are the number of million of iterations per second of the two loops:

array size (one of 3 arrays) |&nbsp;bitwise-or&nbsp;   |&nbsp;bitwise-or and cardinality&nbsp; |
-------------------------|-------------------------|-------------------------|
8192 kB                  |550                      |550                      |
4096 kB                  |655                      |655                      |
1024 kB                  |1,400                    |1,310                    |
8 kB                     |1,900                    |1,500                    |


You read this right: the two loops have identical cost for moderately big arrays! 

What happens is that the `__builtin_popcountl` function is compiled down to a single instruction: <tt>popcnt</tt>, available on PC processors produced after 2008. This instruction is very efficient: it has a throughput of one instruction per CPU clock cycle. Moreover, recall that modern processors are superscalar: they can execute more than one operation at a time. To make things more complicated, the processor is also often starved for data as it needs to load data from RAM. In this case, the processor is able to compute of the cardinality __for free__ on megabytes of data. But even when all the data mostly fits in cache, the penalty for doing extra work can be small. The computation of the bitwise OR is so cheap that it leaves much of the silicon on your processor free to do other work __at the same time__ if needed.

Note that even for short arrays, we probably exaggerate the benefit of the short loop: in these particular tests, we loop many times over the same memory sections so that it remains in CPU cache whereas in an actual application we would suffer cache misses.

To recap, if you have to compute the bitwise OR between two arrays, you can do extra work (such as computing the number of 1s in the result) for free!

My observation will not surprise an expert programmer&hellip; However, many others are unaware that their mental model of computation (essentially a simple sequential Turing machine) is wrong. It is of little consequence&hellip; until they try to make sense of performance results&hellip; Sadly, the naive model of software performance is widespread in academia&hellip;

__Update__: To make things more complicated, Nathan Kurz showed that we can rewrite the short loop using AVX instructions, thus producing much faster code on short arrays that remain in cache.

