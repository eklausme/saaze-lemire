---
date: "2015-01-08 12:00:00"
title: "Fast unary decoding"
---



Computers store numbers in binary form using a fixed number of bits. For example, Java will store integers using 32 bits (when using the `int` type). This can be wasteful when you expect most integers to be small. For example, maybe most of your integers are smaller than 8. In such a case, a unary encoding can be preferable. In one form of unary encoding, to store the integer x, we first write _x_ zeroes followed by the integer 1. The following table illustrates the idea:

&nbsp;Number&nbsp;       |&nbsp;8-bit binary&nbsp; |&nbsp;unary&nbsp;        |
-------------------------|-------------------------|-------------------------|
0                        |00000000                 |1                        |
1                        |00000001                 |01                       |
2                        |00000010                 |001                      |


Thus, to code the sequence 0, 0, 1, 2, 0, we might use 1-1-01-001-1 stored as the byte value 11010011. To recover the sequence from a unary coded stream, it suffices to seek the bits with value 1. A naive decoder will simply examine each bit value, in sequence. (See [code sample](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2015/01/08/unarydecoding.cpp#L51-L65).) We should not expect this approach to be fast.

A common optimization is to use a table look-up. Indeed, we can construct a table with 256 entries where, for each byte value, we store the number of 1s and their position. ([See code sample](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2015/01/08/unarydecoding.cpp#L378-L392).) This can be several times faster.

A possibly faster alternative is to use the fact that all modern processors have [Hamming weight](https://en.wikipedia.org/wiki/Hamming_weight) instructions: fast instructions telling you how many bits with value 1 are present in a 64-bit word (<tt>popcnt</tt> on Intel processors supporting SSE4.2). Similarly, one can use an instruction that counts the number of trailing zeroes (<tt>lzcnt</tt> or `bsf` on Intel processors). We can put such instructions to good use for unary decoding. ([See `popcnt` code sample](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2015/01/08/unarydecoding.cpp#L95-L116) and <a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2015/01/08/unarydecoding.cpp#L394-L415">See <tt>lzcnt</tt>/<tt>bsf</tt> code sample</a>.)

According to my tests, on recent Intel processors, the latter approach is much faster, decoding integers at speeds of over 800 millions integers per second, being roughly twice as fast as a table-based approach. See the next figure.

<a href="https://raw.githubusercontent.com/lemire/Code-used-on-Daniel-Lemire-s-blog/master/2015/01/08/results.png"><img decoding="async" src="https://raw.githubusercontent.com/lemire/Code-used-on-Daniel-Lemire-s-blog/master/2015/01/08/results.png" width="400" /></a>

As usual, [my source code is freely available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2015/01/08).

