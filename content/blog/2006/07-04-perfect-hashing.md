---
date: "2006-07-04 12:00:00"
title: "Perfect Hashing"
---



Suppose you could build a collision-free hash table, how fast would it be? It would be extremely fast, almost as fast as looking up data in an array.

As it turns out, collision-free hash tables have been possible for quite something and that&rsquo;s called __perfect hashing__. See for example [GNU gperf](http://www.gnu.org/software/gperf/), for an implementation.

One way to building a collision-free hash table is to use two hashes: _r_ mod _q_ and _r_ mod <em>p</em>. It is important that _p_ and _q_ be coprimes and that _q_ be large enough to store all of your data. Then, these two hashes are used to create two layers of hash tables (h1 and h2): given the key a, you retrieve its value h(a) by computing h1(h2(a)). In other words, h1 stores the values and h2 uses your keys. Using two hash tables buys you the freedom of choosing (through heuristics) the values of h2, or equivalently, the keys of h1.

The downsides are that construction time might be slower and that the data structure cannot be easily updated. The upsides is that you can use very little storage and have tremendously fast look-ups.

__Reference__:<br/>
S. Lefebvre, H. Hoppe, [Perfect spatial hashing](http://research.microsoft.com/en-us/um/people/hoppe/perfecthash.pdf), ACM SIGGRAPH 2006.

