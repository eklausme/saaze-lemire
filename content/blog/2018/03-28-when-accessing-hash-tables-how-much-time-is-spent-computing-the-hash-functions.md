---
date: "2018-03-28 12:00:00"
title: "When accessing hash tables, how much time is spent computing the hash functions?"
---



Suppose that you create a large set of objects that you store in a hash table. Let us take 10 million<a href="https://lemire.me/blog/2018/03/29/should-you-cache-hash-values-even-for-trivial-classes/"></a> objects. It is large enough that it probably will not fit in the cache memory of your processor. Let us keep the objects simple&hellip; say they are lists of three integers.

In Java, it looks like this&hellip;
```C
int N = 10000000;
HashSet<List<Integer>> hm = new HashSet<List<Integer>>();
for(int k = 0; k < N; k++) {
     List<Integer> s = new ArrayList<Integer>(3);
     for(int z = 0; z < 3; z++) s.add(k * z - 2);
     hm.add(s);
}
```


Then you take another set made of a small number of values, say 100 objects. You count how many of these values are within the large set.
```C
int count = 0;
for(List<Integer> st : small_hm) {
    if(s.hm.contains(st)) count++;
}
```


Because of the way a hash table works, each of your target objects is first hashed, which means that we apply some function that returns a random-like integer. Then we look up the value at an address determined by the hash value in the large hash table.

Java uses a really simple hash function:
```C
int hashCode = 1;
for (Integer e : list)
    hashCode = 31*hashCode + e.hashCode();
```


Moreover, the hash value of each Integer object is the integer value itself. Thus hashing a list of integers in Java ought to be fast.

Meanwhile, accessing a table that is outside of the CPU cache is potentially expensive. But how expensive? Can we consider the computation of the hash values negligible?

[I decided to run a small experiment](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/03/28).

Computing hash values (100) |Accessing the large table (10,000,000) |
-------------------------|-------------------------|
0.9 us                   |0.7 us                   |


Thus, for an out-of-cache hash table in this test, the majority of the time is due to the computation of the hash values! The result is even stronger when the table is reduced in size so that it fits in cache.

There are certainly cases where cache misses will pile up and make anything else look ridiculously expensive. However, you might be more computationally bound than you think.

As an aside, it means that precomputing the hash values of your objects, so that they do not need to be computed each time they are needed, can speed up your code noticeably.

[My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/03/28).

__Update__: as pointed out by Evan in the comments, the HashSet class will then do extra bit-mixing work on top of what the Java hashCode method returns. It should be considered part of the hash-value computation. Unfortunately, it is not easy to estimate this cost so I have attributed it to the table-access cost. Therefore I underestimate the fraction of the time spent computing the hash value.

__Follow-up__: See [Should you cache hash values even for trivial classes?](/lemire/blog/2018/03/29/should-you-cache-hash-values-even-for-trivial-classes/) and [For greater speed, try batching your out-of-cache data accesses](/lemire/blog/2018/04/12/for-greater-speed-try-batching-your-out-of-cache-data-accesses/)

