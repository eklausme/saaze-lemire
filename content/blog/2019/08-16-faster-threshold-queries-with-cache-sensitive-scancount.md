---
date: "2019-08-16 12:00:00"
title: "Faster threshold queries with cache-sensitive scancount"
---



Suppose that you are given 100 sorted arrays of integers. You can compute their union or their intersection. It is a common setup in data indexing: the integers might be unique identifiers.

But there is more than just intersections and unions&hellip; What if you want all values that appear in more than three arrays?

[A really good algorithm for this problem is called scancount](https://arxiv.org/abs/1402.4466). It is good because it is simple and usually quite fast.

Suppose that all my integers are in the interval [0, 20M). You start with an array of counters, initialized at zero. You scan all your arrays for each value in the array, you increment the corresponding counter. When you have scanned all arrays, you scan your counters, looking for counter values greater than your threshold (3).

The pseudocode looks like this&hellip;
```C
counter <- array of zeros
for array x in set of arrays {
    for value y in array x {
      counter[y] += 1
}
for i = 0; i < counter.size(); i++ {
  if(counter[i] > threshold)
     output i;
}
```


This algorithm is almost entirely bounded by &ldquo;memory accesses&rdquo;. Memory-wise if you only have about 100 arrays, you only need 8-bit counters. So I can store all counters in about 20 MB. Sadly, this means that the counters do not fit in processor cache.

Can you make scancount faster without sacrificing too much simplicity?

So far we did not use the fact that our arrays can be sorted. Because they are sorted, then you can solve the problem in &ldquo;cache-sensitive&rdquo; or &ldquo;cache-aware&rdquo; chunks.

Build a small array of counters, spanning maybe only 256 kB. Process all arrays, as with the naive scancount, but suspend the processing of this array as soon as a value in the array exceeds 262144. This allows you to find all matching values in the interval [0, 262144). Next repeat the problem with the next interval ([262144,524288)), and so forth. In this manner, you will have far fewer expensive cache misses.

[I implemented this solution in C++](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/08/16). Here are my results using random arrays, GNU GCC 8 and a Skylake processor. I report the number of CPU cycles per value in the arrays.

naive scancount          |37 cycles                |
-------------------------|-------------------------|
cache-sensitive scancount |16 cycles                |


__Further reading__: [Compressed bitmap indexes: beyond unions and intersections](https://arxiv.org/abs/1402.4466), Software: Practice &#038; Experience 46 (2), 2016.

