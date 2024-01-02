---
date: "2011-08-29 12:00:00"
title: "Why can´t hash tables preserve the order of keys?"
---



One of the most common data structuring in Computer Science is the [hash table](https://en.wikipedia.org/wiki/Hash_table). It is used to store key-value pairs. For example, it is a good data structure to implement a phone directory: given the name of the individual, find his phone number.

Implementing a hash table is not difficult. Start with an array of size <em>N</em>. Each element of the array can be used to store a list of elements. You need a hash function _f_ which maps keys (e.g. people&rsquo;s name) to an integer in {0, 1, &hellip;, <em>N</em>-1}. Store the key-value pair (<em>k</em>,<em>v</em>) at location <em>f</em>(<em>k</em>) in the array. Assuming that

1. the computation of <em>f</em>(<em>k</em>) is independent of the number of keys, and that
1. the hash function distributes the keys disperses the elements properly in the array,


then a hash table has constant-time look-ups.

The problem with hash tables is that they don&rsquo;t necessarily store the data in order. For example, if you have retrieved the phone number of &ldquo;Smith, Jill&rdquo;, you can&rsquo;t expect the phone number of &ldquo;Smith, John&rdquo; to be nearby.

This can be a big problem in practice. It is especially bad if the hash table is on a high-latency medium, like a spinning disk. But it can also hurt you if you have a gigantic hash table in RAM.

At this point, the astute engineer might decide to switch to another data structure such as a tree (e.g., [red-black](https://en.wikipedia.org/wiki/Red-black_tree) or&nbsp; the [B-tree](https://en.wikipedia.org/wiki/B-tree)). But trees have slower look-ups because you have to do a [binary search](https://en.wikipedia.org/wiki/Binary_search) to retrieve your key. (That is, you require up to log _n_ comparisons where _n_ is the number of elements in your tree.)

An even more ambitious engineer could ask a more fundamental question:

__Question__: Why can&rsquo;t hash tables preserve the order of keys?

__Answer__: There is no fundamental reason why they can&rsquo;t.

If you knew enough about your problem, you could design an order preserving hash function (i.e., <em>f</em>(<em></em><em>k</em>2)&lt; <em>f</em>(<em>k</em>1) whenever <em>k</em>2&lt; <em>k</em>1). The problem is that designing such a function that can be both computed quickly and such that it disperses keys adequately is hard work.

We can find many examples of order-preserving hash tables in real-life. A friend of mine would store his research papers in one of dozen of files. He would use the last name of the first author. He then wrote on the cover of each (physical) file the range of last names that this file covered. Of course, in his head, he applied some type of binary search, but the essential point is that his brain took a key (the last name of the first author) and it converted it to the location of the files. The files themselves were not organized as a tree. His brain computed the hash function.

Alas we can&rsquo;t always abstract out the cost of computing the hash function. But let us think: we may not really need the hash function to be order-preserving. All we may need is that nearby keys (e.g., all Smiths) are hashed to nearby locations. But you often have this feature, almost for free!

Let us consider an example. Suppose that the array supporting your hash table has 2<sup>24</sup> elements. Then Java would put the following keys at the following locations:

&ldquo;Smith, A&rdquo;   |1674                     |
-------------------------|-------------------------|
&ldquo;Smith, B&rdquo;   |1675                     |
&ldquo;Smith, C&rdquo;   |1676                     |


That is, these similar keys will be located nearby! This is no accident: in Java, strings that only differ by the last character are always hashed nearby.

That is, by using only the first character of each first name in the key, instead of the entire first name, I can make sure that all individuals with the same last name a located nearby. By scanning at most 26 buckets, you could retrieve all the Smiths.

__Conclusion__: It is possible but difficult to build order-preserving hash tables. However, many hash functions have good locality: nearby keys are nearby in the hash table.

__Further reading__: See [Locality preserving hashing](https://en.wikipedia.org/wiki/Locality_preserving_hashing) on Wikipedia for a related idea.

