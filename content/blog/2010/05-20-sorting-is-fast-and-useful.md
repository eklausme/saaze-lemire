---
date: "2010-05-20 12:00:00"
title: "Sorting is fast and useful"
---



I like to [sort things](http://arxiv.org/abs/0901.3751). If you should learn one thing about Computer Science is that __sorting is fast and useful__.

Here&rsquo;s a little example. You want to check __quickly__ whether an integer belongs to a set. Maybe you want to determine whether a userID is valid. The solutions:

- Use a [hash table](https://en.wikipedia.org/wiki/Hash_table). Java programmers use the [HashSet](http://docs.oracle.com/javase/1.5.0/docs/api/java/util/HashSet.html) class.
- Use a tree structure such as a [red-black tree](https://en.wikipedia.org/wiki/Red-black_tree) or a [B-tree](https://en.wikipedia.org/wiki/B-tree). Java programmers use the [TreeSet](http://docs.oracle.com/javase/1.5.0/docs/api/java/util/TreeSet.html) class.
- If your set of integers changes rarely, you can sort it, and then try to locate integers using [binary search](https://en.wikipedia.org/wiki/Binary_search).


I [wrote a Java benchmark](http://pastebin.com/Lmcu9KBw) to compare the three solutions:
<p style="text-align: center;"><img decoding="async" src="https://lh4.ggpht.com/__I-3q9m-Gqo/S_XjF3C_loI/AAAAAAAABso/d1Mqv1jxjZw/s800/Screen%20shot%202010-05-20%20at%209.33.57%20PM.png" alt />

Binary search over a sorted array is a __only 10% slower__ than the HashSet. Yet, __the sorted array uses half the memory__. Hence, using a sorted array is the clear winner for this problem.

If you think that&rsquo;s a little bit silly, consider that [column-oriented](https://en.wikipedia.org/wiki/Column-oriented_DBMS) DBMSes like [Vertica](https://en.wikipedia.org/wiki/Vertica) use binary search over sorted columns as an indexing technique.

__Code__: Source code posted on my blog is available from a [github repository](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog).

