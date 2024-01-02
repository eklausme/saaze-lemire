---
date: "2016-08-09 12:00:00"
title: "How many reversible integer operations do you know?"
---



Most operations on a computer are not reversible&hellip; meaning that once done, you can never go back. For example, if you divide integers by 2 to get a new integer, some information is lost (whether the original number was odd or even). With fixed-size arithmetic, multiplying by two is also irreversible because you lose the value of the most significant bit.

Let us consider fixed-size integers (say 32-bit integers). We want functions that take as input one fixed integer and output another fixed-size integer. 

How many reversible operations do we know?

1. Trivially, you can add or subtract by a fixed quantity. To reverse the operation, just flip the sign or switch from add to subtract.
1. You can compute the exclusive or (XOR) with a fixed quantity. This operation is its own inverse.
1. You can multiply by an odd integer. You&rsquo;d think that reversing such a multiplication could be accomplished by a simple integer division, but that is not the case. Still, [it is reversible and the inverse can be computed efficiently](/lemire/blog/2017/09/18/computing-the-inverse-of-odd-integers/). By extension, the carryless (or polynomial) multiplication supported by modern processors can also be reversible.
1. You [can rotate the bits](https://en.wikipedia.org/wiki/Circular_shift) right or left using the `ror` or `rol` instructions on an Intel processor or with a couple of shifts such as <tt>(x >>> (-b)) | ( x << b))</tt> or <tt>(x << (-b)) | ( x >>> b))</tt> in Java. To reverse, just rotate the other way. If you care about signed integers, there is an interesting variation that is also invertible: the "signed" rotate (defined as <tt>(x >> (-b)) | ( x << b))</tt> in Java) which propagates the signed bit of [two's complement](https://en.wikipedia.org/wiki/Two%27s_complement) encoding.
1. You can XOR the rotations of a value as long as you have an odd number of them. [Reynolds describes how to invert the result](http://marc-b-reynolds.github.io/math/2017/10/13/XorRotate.html). 
1. You can compute the addition of a value with its shifts (e.g., <tt> x + ( x << a) </tt>). This is somewhat equivalent to multiplication by an odd integer. 
1. You can compute the XOR of a value with its shifts (e.g., <tt> x ^ ( x >> a) </tt> or <tt> x ^ ( x << a) </tt>). This is somewhat equivalent to a carryless (or polynomial) multiplication. 
1. You can reverse the bytes of an integer (<tt>bswap</tt> on Intel processors). This function is its own inverse. You can also reverse the order of the bits (<tt>rbit</tt> on ARM processors). 
1. (New!) Jukka Suomela points out that you can do bit interleaving (e.g., interleave the least significant 16 bits with most significant 16 bits) with instructions such as `pdep` on Intel processors. You can also compute the [lexicographically-next-bit permutation](https://graphics.stanford.edu/~seander/bithacks.html#NextBitPermutation).


You can then compose these operations, generating new reversible operations.

__Related:__ Quite some time after I wrote this post, [Reynolds came up with a super nice version that reviews many similar techniques](http://marc-b-reynolds.github.io/math/2017/10/13/IntegerBijections.html).

__Pedantic note__: some of these operations are not reversible on some hardware and in some programming languages. For example, signed integer overflows are undefined in C and C++.

