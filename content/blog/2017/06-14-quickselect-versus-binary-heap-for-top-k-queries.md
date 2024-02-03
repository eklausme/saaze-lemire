---
date: "2017-06-14 12:00:00"
title: "QuickSelect versus binary heap for top-k queries"
---



In a previous post, I considered the problem of finding the _k_ smallest (or _k_ largest) elements from a stream of values.

The naive approach is to collect all the values in an array, sort the array, and return the first _k_ values. When an index is not available, that is how some relational databases reportedly solve SELECT/ORDER BY/LIMIT queries. It is also how many programmers will solve this problem.

Using a JavaScript benchmark, I showed that an approach based on a binary heap could be [several times faster](/lemire/blog/2017/06/06/quickly-returning-the-top-k-elements-computer-science-vs-the-real-world/). That is a net win for computer science since an approach based on a binary heap has complexity <em>O</em>( _n_ log _k_ ) where _n_ is the number of elements. Moreover the binary heap is attractive because it has an optimal storage requirement of <em>O</em>( _k_ ).

Lots of people objected that we could do even better using an algorithm called [QuickSelect](https://en.wikipedia.org/wiki/Quickselect) (e.g., Rasmus Pagh). Whereas QuickSelect has far higher memory requirements than a binary heap (<em>O</em>( _n_ )) and a worst complexity of <em>O</em>( <em>n</em><sup>2</sup> ), it has a superior average case complexity of <em>O</em>( _n_ ). (Note: you can combine a binary heap and QuickSelect using [introselect](https://en.wikipedia.org/wiki/Introselect), I do not consider this possibility.)

Finally, Anno Langen sent me a code sample in JavaScript, so I no longer any excuse not to test QuickSelect. I put together a [JavaScript benchmark](https://github.com/lemire/QuickSelect.js/tree/master/benchmark) that you can run and review.

In this benchmark, we receive 1408 random integers and we must collect the smallest 128.

The approach using a binary heap can run about 37,000 times a second, whereas QuickSelect runs 45,000 times per second, or about 20% faster. They are both about an order of magnitude faster than the naive sort/slice approach.

For all practical purposes, 20% faster is negligible in this case. I have actually hit a sweet spot where QuickSelect and the binary heap are comparable.

What are other cases of interest?

- If you only seek the top 5 elements out of an array, then the binary heap is likely to beat QuickSelect, irrespective of how many elements I have. The binary heap will fit in one or two cache lines, and the log _k_ factor will be small. 
- If I keep _k_ at a sizeable 128, but I increase substantially the size of the array, then QuickSelect will start to win big.
- However, if I keep increasing the array size, the benefits of QuickSelect might start to fade. Indeed, QuickSelect will start to operate in RAM whereas the binary heap will remain in CPU cache. QuickSelect will become increasingly limited by potentially expensive cache misses.
- QuickSelect still has the worst case quadratic-time scenario that could be triggered by really bad input data. The binary heap is more likely to provide consistent speed.


What else could we do?

- Martin Cohen suggested a [simple insertion sort](/lemire/blog/2017/06/06/quickly-returning-the-top-k-elements-computer-science-vs-the-real-world/#comment-281015) on the basis that, for large streams, you are unlikely to encounter many candidates for the top-<em>k</em> position. This would probably work well for very long streams, but it could degenerate badly in some cases.
- Michel Lemay refered to a fancier approach used by [Google Guava](https://plus.google.com/+googleguava/posts/QMD74vZ5dxc): maintain a buffer of 2<em>k</em> elements initially empty. Fill it up. Once it is full, use QuickSelect on it and discard half of it. Rinse and repeat. This seems like an appealing idea and Michel testifies that it provides very good practical performance.


So I am probably going to have to return to this problem.

Follow-up blog post: [Top speed for top-k queries](/lemire/blog/2017/06/21/top-speed-for-top-k-queries/).

