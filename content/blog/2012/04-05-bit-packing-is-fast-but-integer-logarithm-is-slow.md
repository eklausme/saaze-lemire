---
date: "2012-04-05 12:00:00"
title: "Bit packing is fast, but integer logarithm is slow"
---



In [How fast is bit packing?](/lemire/blog/archives/2012/03/06/how-fast-is-bit-packing/), we saw how to store non-negative integers smaller than 2<sup><em>N</em></sup> using _N_ bits per integer by a technique called bit packing. A careful C++ bit packing implementation is fast: e.g., over 1 billion integers per second.

However, before you pack the integers, you might need to scan them to determine the number of bits needed (<em>N</em>). Unfortunately, it is a relatively expensive process.

Given a positive integer <em>x</em>, we seek the smallest integer _N_ such that the integer _x_ is less than 2<sup><em>N</em></sup>. The value _N_ is often called the <em>integer logarithm</em> of <em>x</em>.

There are [several clever techniques](http://graphics.stanford.edu/~seander/bithacks.html#IntegerLog) to compute the integer logarithm using portable C code. Yet you can do better using processor-specific instructions. The GNU GCC compiler makes this easy with a special function that counts the number of leading zeros for 32-bit integers (<tt>__builtin_clz</tt>). Even so, it is relatively slow.

Thankfully, you can avoid computing the integer logarithm of each integer by a simple test involving a right shift:<br/>
<code><br/>
if((x>>b) !=0)<br/>
b = integer_logarithm(x);<br/>
</code><br/>
With proper loop unrolling, this is nearly as fast as bit packing.

__Update__: Preston Bannister correctly points out that you can do much better. Simply compute the logical or between all integers and then compute the integer logarithm of the result. It is much, much faster.

To experiment with this problem, I wrote a [small program](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2012/04/05/bit-packing-is-fast-but-integer-logarithm-is-slow) which finds the maximum integer logarithm of a large array of random integers. It then packs the integers using this logarithm. 

- I find that I can pack between 1 billion and 2 billions integers per second.
- I compute the maximum integer logarithm at a rate of 3 billion integers per second.


When plotting the speeds as functions of the actual maximum integer logarithm, we see that the computation of the logarithm is not sensitive to the value of the actual logarithm, except for the approach based on the `__builtin_clz` function which is slower when the logarithm is less than 8.

In my tests, I used the GNU GCC 4.6.2 compiler on an Intel core i7 processor. My code is [freely available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2012/04/05/bit-packing-is-fast-but-integer-logarithm-is-slow).

__Conclusion__ When packing an array of integers, finding the maximum logarithm can take anywhere from 1/4 to 1/3 of the running time. However, brute force techniques that compute the integer logarithm of every integer are much slower.

