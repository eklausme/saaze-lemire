---
date: "2019-06-27 12:00:00"
title: "Bounding the cost of the intersection between a small array and a large array"
---



Consider the scenario where you are given a small sorted array of integers (e.g., [1,10,100]) and a large sorted array ([1,2,13,51,&hellip;]). You want to compute the intersection between these two arrays.

A simple approach would be to take each value in the small array and do a [binary search](https://en.wikipedia.org/wiki/Binary_search_algorithm) in the large array. Let the size of the large array be <em>n</em>, then a binary search takes up to log _n_ comparisons and data accesses. Of course, log <em>n</em>  may not be an integer, so I need to round it up to the smallest integer at least as large as log <em>n: </em>ceil( log <em>n </em>). If the small array contains _k_ elements, then I need a total of<em> k</em> ceil( log <em>n </em>) comparisons. Each comparison involves one data access in the large array.

Is _k_ log <em>n </em>comparisons the best bound? Clearly not: if _k_ is almost as big as <em>n</em>, then _k_ log <em>n </em>can far exceeds<em> k+n.</em> Yet a standard merge algorithm (as in the [Merge Sort](https://en.wikipedia.org/wiki/Merge_sort) algorithm) requires as little as <em>k+n</em> comparisons. So for the bound to be reasonable, we must require that _k_ is much smaller than <em>n</em>.

Even so, intuitively, it is wasteful to do _k_ distinct binary searches. If the values in the small array are in sorted order, then you have new knowledge after doing the first binary search that you can reuse to help in the next binary search.

How few comparisons can you do? We can use an information-theoretical argument. The basic idea behind such an argument is that for an algorithm based on a decision tree to generate _M_ distinct possible output, it must involve up to ceil( log( <em>M </em>) ) decisions in the worst case, a count corresponding to the height of the corresponding balanced tree.

To be clear, this means that if an adversary gets to pick the input data, and you have divine algorithm, then I can give you a lower bound on the number of decisions that your algorithm takes. It is entirely possible that, in practice, you will do better given some data; it is also entirely possible that you could do much worse, evidently. Nevertheless, let us continue.

We can recast the intersection problem as the problem of locating, for each key in the small value, the largest value in the large array that is small or equal to the key. How many possible outputs (of this algorithm) are there? I have to choose _k_ values from a set of _n_ elements, but the order does not matter: that&rsquo;s <em>n<sup>k</sup></em>/k! possibilities. This means that if my algorithm relies on a (balanced) decision tree, it must involve ceil( _k_ log <em>n</em> &#8211; log <em>k</em>! ) decisions.

Let us put some numbers in there. Suppose that _n_ is 4 million and _k_ is 1024. Then ceil( log <em>n </em>) is 22 so each key in the small array will involve 22 decisions. On a per key basis, our tighter model gives something like log <em>n</em> &#8211; (log <em>k</em>!)/<em>k.</em> The log of the factorial is almost equal to <em>k </em>log<em> k </em>by Stirling&rsquo;s approximation, so we can approximate the result as log <em>n &#8211; </em>log<em> k</em>.

Let us plug some numbers in these formula to track the lower bound on the number of decisions per key in the small array:

<em>k</em>               |log <em>n</em>           |log _n_ &#8211; (log <em>k</em>!) / <em>k</em> |
-------------------------|-------------------------|-------------------------|
8                        |22                       |20                       |
16                       |22                       |19                       |
64                       |22                       |17                       |
1024                     |22                       |13                       |


This suggests that you may be able to do quite a bit better than _k_ distinct binary searches.

Often, however, it is not so much the decisions that one cares about as much as the number of accesses. Can this value 13 in table when _n_ is 1024 be taken a lower bound on the number of accesses? Not as such because you can access one value from the large array and then reuse it for many comparisons.

To complicate matters, our systems have cache and cache lines. The cache means that repeated accesses to the same value can be much cheaper than accesses to distinct values and may even be free (if the value remains in a register). And our cache does not operate on a per-value basis, but rather data is loaded in chunks of, say, 64 bytes (a cache line).

All in all, my derivations so far may not be highly useful in practical applications, except maybe to argue that we ought to be able to beat the multiple binary search approach.

Can we sketch such an approach? Suppose that we start by sampling _B_ different values in the big array, at intervals of size _n_ / ( <em>B </em>+ 1 ). And then we issue the same _k_ binary searches, but targeting one of the interval of size _n_ / ( <em>B </em>+ 1 ). This will incur <em>B</em>  + _k_ log (<em>n / </em>( <em>B</em> + 1 )) accesses in the large array. Let us pick _B_ so as to minimize the number of accesses. We could pick _B_ to be _k_ / ln (2) &#8211; 1. We get _k_ / ln (2) &#8211; 1 + _k_ log (<em>n</em> ln (2) / <em>k</em>) accesses in the large array. For simplicity, I am ignoring the fact that _B_ must be an integer. I am also ignoring the cost of matching each value in the small array to the right subinterval. However, if I am only interested in the number of accesses in the large array, it is an irrelevant cost. Even so, under the assumption that _k_ is small, this is a small cost (O(<em>k</em>)).

Is _k_ / ln (2) + _k_ log (<em>n</em> ln (2) / <em>k</em>) accesses in the large array much better than the naive approach doing <em>k </em>log<em> n </em>accesses? It is unclear to me how much better it might be on real systems once caching effects are accounted for.

__Credit__:  Travis Downs for the initial questions and many ideas. The mistakes are mine.

__Further reading__: [SIMD Compression and the Intersection of Sorted Integers](https://arxiv.org/abs/1401.6399), Software: Practice and Experience 46 (6), 2016

