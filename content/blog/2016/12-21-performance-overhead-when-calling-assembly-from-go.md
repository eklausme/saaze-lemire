---
date: "2016-12-21 12:00:00"
title: "Performance overhead when calling assembly from Go"
---



The Go language allows you to call C functions and to rewrite entire functions in assembly. As I have previously documented, [calling C functions from Go comes with a significant overhead](/lemire/blog/2014/02/14/getting-good-performance-in-go-by-rewriting-parts-in-c/). It still makes sense, but only for sizeable functions, or when performance is irrelevant.

What about functions written in assembly? To illustrate the performance constraints, I am going to use an example designed by Jason Aten.
Recent Intel processors have an instruction (<tt>tzcnt</tt>) that counts the &ldquo;number of trailing zeroes&rdquo; of an integer. That is, given a non-zero unsigned integer, you count the number of consecutive zeros starting from the least significant bits. For example, all odd integers have no trailing zero, all integers divisible by 4 have at least two trailing zeros and so forth. You might reasonably wonder why anyone would care about such an operation&hellip; it is often used to iterate over the 1-bit in a word. It is useful in data compression, indexing and cryptography.

A fast way to compute the number of trailing zeros without special instructions is as follows&hellip; (see Leiserson and Prokop, [Using de Bruijn Sequences to Index a 1 in a Computer Word](http://supertech.csail.mit.edu/papers/debruijn.pdf), 1998)
```Go
table[((x&-x)*0x03f79d71b4ca8b09)>>58]
```


where `table` is a short array of bytes that fits in a cache line&hellip;
```Go
var table = []byte{
	0, 1, 56, 2, 57, 49, 28, 3, 61,
        58, 42, 50, 38, 29, 17, 4, 62, 
        47, 59, 36, 45, 43, 51, 22, 53,
        39, 33, 30, 24, 18, 12, 5, 63, 
        55, 48, 27, 60, 41, 37, 16, 46,
        35, 44, 21, 52, 32, 23, 11,54,
        26, 40, 15, 34, 20, 31, 10, 25,
        14, 19, 9, 13, 8, 7, 6,
}
```


Such a function is going to be fast, using only a handful of machine instructions and running in a handful of cycles. Still, Intel&rsquo;s `tzcnt` instruction is superior, as it is a single instruction of a cost comparable to a single multiplication. Roughly speaking, we could expect `tzcnt` to be twice as fast.

Go can call `tzcnt` through a function written in assembly. So it seems that Go can easily make use of such instructions. Sadly no. Based on Aten&rsquo;s code, [I designed a benchmark](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2016/12/21). I am using a test server with a Skylake processor running at a flat 3.4 GHz, and my benchmark measures the instruction throughput. I think that the results speak for themselves:

pure Go (de Bruijn)      |3.55 cycles/call         |
-------------------------|-------------------------|
assembly                 |11.5 cycles/call         |


In this instance, the function that calls `tzcnt` (and does little else) runs at nearly half the speed of the pure Go function. Evidently, Go does not take the assembly and inline it.
[Programmers have asked the Go authors to inline assembly calls](https://github.com/golang/go/issues/17373), but there seems to be little support from the core Go team for such an approach.
My point is not that you can&rsquo;t accelerate Go code using functions written in assembly but rather that if the function is tiny, the function-call overhead will make the performance worse. So you will be better off using pure Go.

[The source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2016/12/21).

