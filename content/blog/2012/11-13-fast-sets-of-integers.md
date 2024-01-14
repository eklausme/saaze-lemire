---
date: "2012-11-13 12:00:00"
title: "Fast sets of integers"
---



Maintaining a set of integers is a common problem in programming. It can also be implemented in many different ways.

Maybe the most common implementation uses a hashing (henceforth hashset): it provides optimal expected-time complexity. That is, we expect that it takes a constant time to add or remove an integer (O(1)), and it takes a time proportional to the cardinality of the set to iterate through the elements. For this purpose, Java provides the [HashSet](http://docs.oracle.com/javase/6/docs/api/java/util/HashSet.html) class.

An alternative implementation is the [bitset](https://en.wikipedia.org/wiki/Bitset): essentially, it is an array of boolean values. It ensures that adding and removing integers takes a constant time. However, iterating through the elements could be less than optimal: if your universe contains _N_ integers, it may take a time proportional to _N_ to enumerate the integers irrespective of the number of integers in the set.

So, suppose you expect to have 1000 integers in the range from 0 to <em>N</em>. Which data structure is best? The hashset or the bitset? Clearly, if _N_ is sufficient large, the hashset will be best. But how large must _N_ be?

I decided to implement a quick test to determine the answer. Instead of using the standard Java [BitSet](http://docs.oracle.com/javase/6/docs/api/java/util/BitSet.html), I decided to write my own bitset (henceforth [StaticBitSet](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2012/11/13/src/StaticBitSet.java)) that is faster in my tests. For the hashset, I compared both the standard HashSet and [TIntHashSet](http://trove4j.sourceforge.net/javadocs/gnu/trove/set/hash/TIntHashSet.html) and found that there was little difference in performance in my tests, so I report just the results with the standard HashSet (from the [OpenJDK 7](http://openjdk.java.net/projects/jdk7/)).

The following table reports the speed in millions of elements per second for adding, removing and iterating through 1000 elements in the range from 0 to N.
&nbsp;&nbsp;N&nbsp;&nbsp; |&nbsp;&nbsp;bitset&nbsp;&nbsp; |&nbsp;&nbsp;hashset&nbsp;&nbsp; |
-------------------------|-------------------------|-------------------------|
100,000                  |77                       |18                       |
1,000,000                |45                       |19                       |
10,000,000               |11                       |18                       |


These numbers are consistent with the theory. The speed of the hashset data structure is relatively independent from _N_ whereas the performance of the bitset degrades as _N_ increases. However, what might be surprising, is how large _N_ needs to be before the bitset is beaten. The bitset only starts failing you (in this particular test) when the ratio of the size of the universe to the size of the set exceeds 1,000.

The bitset data structure is more generally applicable than you might think.

__Source__: My [Java source code](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2012/11/13) is available, as usual.
__Further reading__: In to [Sorting is fast and useful](/lemire/blog/2010/05/20/sorting-is-fast-and-useful/), I showed that binary search over sorted array of integers could be a competitive way to test whether a value belongs to a set.

