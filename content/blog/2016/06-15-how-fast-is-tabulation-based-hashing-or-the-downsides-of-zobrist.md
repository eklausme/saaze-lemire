---
date: "2016-06-15 12:00:00"
title: "How fast is tabulation-based hashing? The downsides of Zobrist&#8230;"
---



In practice, hashing is the process of taking an input, such as a string, and turning it into an integer value. It is a fundamental tool in programming, as most software relies on hashing in one way or another. We often expect hashing to appear &ldquo;random&rdquo; so that any two strings are unlikely to have the same hash value.
One of the earliest and simplest forms of hashing is [Zobrist hashing](https://en.wikipedia.org/wiki/Zobrist_hashing). Suppose you want to hash strings of up to 16 characters. For each possible 16 character positions, you generate a table made of 256 randomly chosen words. To hash a given string, you pick the first character, look up the corresponding chosen word in the first table, then you pick the second character and look up the word in the second table&hellip; and you XOR the retrieved words. In C, you get something like this:
```C
for (size_t i = 0; i < length ; i++ )
      h ^= hashtab [ i ] [ s[ i ] ];
return h;
```


Zobrist hashing is an instance of a more general class of hashing said to be tabulation-based.

The benefits of Zobrist are obvious. It is simple. It can be implemented in seconds. It has excellent theoretical properties and is generally very convenient.

The first downside is also obvious: Zobrist hashing uses a lot of memory. To be able to hash all 4-byte strings to 64-bit values, you need 8 KB. But let us ignore this obvious downside.

State-of-the-art universal hash functions such as [CLHash can process over 10 bytes per cycle on a recent Intel processor](/lemire/blog/2015/12/24/your-software-should-follow-your-hardware-the-clhash-example/). The good old CityHash can process over 4 bytes per cycle.

How fast can Zobrist hashing be? To get a better idea, I implemented [Zobrist hashing as a small C library](https://github.com/lemire/zobristhashing). How fast is it? Not very fast. I can barely process 0.65 bytes per cycle when hashing repeatedly the same short string, taking into account the function-call overhead. Thus, tabulation-based hashing is probably about an order of magnitude slower than commonly used fast hash functions, assuming you can avoid cache misses.

In an exhaustive experimental evaluation of hash-table performance, Richter et al. ([VLDB, 2016](https://infosys.cs.uni-saarland.de/publications/p249-richter.pdf)) found that Zobrist hashing produces a low throughput. Consequently, the authors declare it to be &ldquo;less attractive in practice&rdquo; than its strong randomness properties would suggest.

__Software reference__. [zobristhashing: Zobrist hashing in C](https://github.com/lemire/zobristhashing)

