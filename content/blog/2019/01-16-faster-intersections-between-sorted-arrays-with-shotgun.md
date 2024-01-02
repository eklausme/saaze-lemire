---
date: "2019-01-16 12:00:00"
title: "Faster intersections between sorted arrays with shotgun"
---



A common problem within databases and search engines is to compute the intersection between two sorted array. Typically one array is much smaller than the other one.

The conventional strategy is the &ldquo;galloping intersection&rdquo;. In effect, you go through the values in the small arrays and then do a [binary search in the large array](https://en.wikipedia.org/wiki/Binary_search_algorithm). A binary search is a simple but effective algorithm to search through a sorted array. Given a target, you compare with with the midpoint value. If your target is smaller than the midpoint value, you search in the first half of the array, otherwise you search in the second half. You can recurse through the array in this manner, cutting the search space in half each time. Thus the search time is logarithmic.

If the small array has M elements and the large array has N elements, then the complexity of a galloping search is O(M log N). In fact, you can be more precise: you never need more than M * log N + M comparisons.

Can you do better? You might.

Let me describe an improved strategy which I call &ldquo;shotgun intersection&rdquo;. It has been in production use for quite some time, through the [CRoaring library](https://github.com/RoaringBitmap/CRoaring), a C/C++ implementation of [Roaring Bitmaps](https://roaringbitmap.org).

The idea is that galloping search implies multiple binary searches in sequence through basically the same array. Doing them consecutively might not be best. A binary search, when the large array is not in cache, is memory-bound: it waits for the memory subsystem to deliver the data. So you are constantly waiting. What if you tried to do something else while you wait. What about starting right away on the next binary search?

That is how a shotgun search works. You take, say, the first four values from the small array. You load the midpoint value from the large array, then you compare all of your four values against this midpoint value. If the target value is larger, you set a corresponding index so that the next search will hit the second half of the array. And so forth. In effect, shotgun search does many binary searches at once.

[I make my Java code available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/01/15), if you want a full implementation.

Does it help? It does. Sometimes it helps a lot. Let us intersect an array made of 32 integers with an array made of 100 million sorted integers. I use a cannonlake processor with Java 8.

1-way                    |1.3 microseconds         |
-------------------------|-------------------------|
4-way                    |0.9 microseconds         |


__Credit__: Shotgun intersections are based on an idea and an initial implementation by Nathan Kurz. I&rsquo;d like to thank Travis Downs for inspiring discussions.

