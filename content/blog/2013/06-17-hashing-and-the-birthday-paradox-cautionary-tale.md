---
date: "2013-06-17 12:00:00"
title: "Hashing and the Birthday paradox: a cautionary tale"
---



If you meet a stranger, the probability that he will have the same birth date as yourself is probably less than 1%. It is roughly 1/365 if you make simplifying assumptions. The Birthday paradox is the observation that given a full classroom (say 60 students), it is almost certain that two students will have the same birth date.

Our software routinely relies on hashing functions, which are just (randomly chosen) maps from elements to values. When two distinct elements have the same hash value, we say that there is a collision. In many applications, collisions are a bad thing.

If you choose hash values in a small set (say {0,1,2,3}), collisions are likely. Hence, we typically pick hash values from large sets (say all 32-bit integers).

Still, software hashing is subject to the Birthday paradox. How bad is it? Assuming that hashing is perfectly random, Steven Pigeon [worked out](https://hbfs.wordpress.com/2012/03/30/finding-collisions/) some of the mathematics. To have a significant (50%) risk to find a collision when using 128-bit hash values, quintillions of elements are required. For 32-bit hash values, the result is not so good: only 77,000 elements are required.

But can you trust these results when working with actual hash values in your software? Probably not. For example, hash values generated by your software might not even be random. (In such a case, the probability of a collision is either 1 or 0 and the Birthday paradox does not apply.) And if it is random, as with the Ruby language, it is unlikely to be truly random&hellip;

(At this point, some people might object that hashing cannot be random&hellip; as the same element must always be mapped to the same hash value&hellip; and this is true, except that you can generate and store a random map on demand.)

In practice, you will be lucky if you get [strong universality](http://arxiv.org/abs/1202.4961). Strong universality means that if you take any two distinct elements and hash them, the result is as good as perfectly random. However, it tells you little about what happens if you hash thousands of elements simultaneously.

I decided to test this out experimentally. I wrote a small Java benchmark. I picked some collection of strings: I grow the size of the set as a parameter. My collision probability estimation routine is crude, but it should give us some idea:

Number of elements       |Strongly universal       |Perfectly random         |
-------------------------|-------------------------|-------------------------|
100                      |0%                       |0%                       |
1000                     |100%                     |0%                       |
10000                    |100%                     |1.6%                     |
77163                    |100%                     |50.1%                    |


As we can see, the strongly universal function fares much worse than a purely random hashing function would. With just 1000 items, you are sure to encounter a collision! Of course, I cheated in the sense that I tweaked the test case until I got this bad result. But that is exactly what an adversary desiring to crashing your software might do.

In this case, we used a hash function with strong theoretical properties ([Multilinear](http://arxiv.org/abs/1202.4961)). If you use Java&rsquo;s [hashCode method](/lemire/blog/2012/01/17/use-random-hashing-if-you-care-about-security/), then you are in much worse shape: the strings Ace and BDe always collide!

The mathematical results from the Birthday paradox should be viewed as best case scenarios. Hashing might be much less reliable in practice.

__Source code__: The source code of my example [is on GitHub](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2013/06/17/Birthday.java).

