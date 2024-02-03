---
date: "2012-02-17 12:00:00"
title: "Bitmaps are surprisingly efficient"
---



Imagine you have to copy an array, and update a few values in the process. What is the most efficient implementation?

Let us look at a concrete example. I am given this array:<br/>
<code>0,5,1,4,5,1,10,4.</code><br/>
I want to create a new array with these values:<br/>
<code>0,5,1,<span style="color:red;font-weight:bold;">40</span>,5,1,<span style="color:red;font-weight:bold;">100</span>,4.</code>

Most programmers would follow the following algorithm:

1. Copy the array first;
1. Iterate over the list of positions and updated values ([3,<span style="color:red;font-weight:bold;">40</span>], [6,<span style="color:red;font-weight:bold;">100</span>]) and correct the values.


If there are very few values that need to be updated compared to the size of the array, this approach is probably optimal. The copy of the array itself is very efficient because it is entirely [vectorizable](https://en.wikipedia.org/wiki/Vectorization_%28parallel_computing%29): the processor does not need to copy values one at a time, it can copy two or four at a time.

But what if 10%, 20% or even 30% of the values need to be updated after the copy? Then storing the list of positions can become wasteful. For my toy problem, I have two positions to record (3 and 6): it can use 64 bits when using 32-bit integers. If I want to be more efficient, I can use 8-bit integers, thus using a total of 16 bits. (Most modern computers favor 32-bit integers, and it is generally not computationally efficient to use integers with anything other than 8, 16, 32 or 64 bits.)

A more memory-conscious approach is to use a bitmap. That is, I store the following value using a binary notation:<br/>
<code>000<span style="color:red;font-weight:bold;">1</span>00<span style="color:red;font-weight:bold;">1</span>0</code><br/>
I put a 1 at the third and sixth position and elsewhere a 0. This makes up the integer 72. In this manner, I never need more than one bit per value. In this case, I use only 8 bits in total, a saving of 50% compared to the alternative where I store each position using an integer.

We need a different implementation however, one where you check the bits of the bitmap before copying.

- for every position in the array

- if the bitmap value is 0 then copy the value from the source array;
- if the bitmap value is 1 then copy the next available updated value.



This new algorithm looks inefficient. There is a lot of branching inside a tight loop. Yet the bitmap approach can be faster when the density of updates is high enough (>2%), as the next table shows.

density (%)              |&nbsp;&nbsp;&nbsp;time&nbsp;&nbsp;&nbsp; |&nbsp;&nbsp;time with bitmaps&nbsp;&nbsp; |&nbsp;&nbsp;straight copy&nbsp;&nbsp; |
-------------------------|-------------------------|-------------------------|-------------------------|
17                       |48                       |__26__                   |__24__                   |
9                        |47                       |__26__                   |__24__                   |
6                        |45                       |__26__                   |__24__                   |
5                        |43                       |__26__                   |__24__                   |
4                        |41                       |__26__                   |__24__                   |
3                        |38                       |__26__                   |__24__                   |
2                        |35                       |__26__                   |__24__                   |


<a href="http://pastebin.com/fU18McyU"><br/>
My C++ code is online</a>. I used GNU GCC 4.6.2 with only the -Ofast flag. Hardware-wise, I am using a recent MacBook Air with an Intel Core i7. (I stress that using GCC 4.6 is important. Older compilers might give different results. Also, the Core i7 is a processors with aggressive superscalar execution: cheaper processors might give different results.)

As you can see, the bitmap approach is optimal: a copy with updated values indicated by a bitmap is just as fast as a simple copy (within 10%).

(I updated the numbers on Feb. 23rd 2012. Originally, my code processed the bitmaps 32 bits at a time. I found that it was much faster to process them 8 bits at a time, probably because it allows better loop unrolling. I updated the code again on Feb. 27th 2012 after a bug report by Martin Trenkmann, the numbers were slightly updated as well.)

__Conclusion__ Indicating exceptions using a bitmap can save memory without any penalty to the running time.

__Code__: Source code posted on my blog is available from a [github repository](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog).

