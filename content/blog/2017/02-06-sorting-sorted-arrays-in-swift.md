---
date: "2017-02-06 12:00:00"
title: "Sorting sorted arrays in Swift"
---



Sorting arrays quickly is a classical computer science problem. It is also a common task worth optimizing.

Sadly, there is no best approach, no silver bullet. Most people rely on whatever their programming language provides as a sorting function, but it is almost always suboptimal.

The new Swift language has made an interesting choice for a sorting function. They went with a variation on the textbook quicksort approach called [introsort](https://en.wikipedia.org/wiki/Introsort). Introsort is a popular choice, found in C++ standard libraries as well as in the Microsoft .Net platform. Introsort initially works like [quicksort](https://en.wikipedia.org/wiki/Quicksort), partitioning the data log(n) times, but it then falls back on [heapsort](https://en.wikipedia.org/wiki/Heapsort). This makes it a robust choice. That is, it is not possible to design a set of ever larger arrays so that the running time of the algorithm goes up quadratically. You have [linearithmic complexity](https://en.wikipedia.org/wiki/Time_complexity#Linearithmic_time). So far, it would seem that the Swift designers made a safe choice&hellip; Except for one thing&hellip; A critical step in quicksort, and introsort is effectively just a safe variant of quicksort, is to pick a good &ldquo;pivot&rdquo;. Swift&rsquo;s sort function uses the first value as the pivot.

That&rsquo;s a somewhat odd choice. The state-of-the-art is to pick the median of the first, last and middle element as pivot (median-of-3). Indeed, the GNU ISO C++ standard library uses a median-of-3 pivot (as per the <tt>stl_algo.h</tt> header).

The performance of the sorting algorithm is reliant on the pivot splitting the array in two. That is, the pivot should be close to the median of the array. 

But what if your array is already sorted? Then the first value of the array is the worst possible pivot!

We can test it out&hellip; calling the `sort` function on an array twice in Swift&hellip; the second call is almost assuredly going to take longer&hellip;
```C
array.sort() // fast
array.sort() // really slow
```


Of course, that&rsquo;s silly&hellip; why would you sort an array that&rsquo;s already sorted? Well. 

- In some instances, developers do not want to take any chances. They get an array from some other part of the code, they expect the array to be sorted, but they can&rsquo;t be entirely sure. To be safe, they will sort it again.
- Or maybe the array was sorted but the code had to change a value or two in the array. In these instances, the developer might think that resorting the array ought to be sufficiently cheap.


So even if it sounds silly, actual code often sorts arrays that are nearly sorted. For this reason, Java uses [Timsort](https://en.wikipedia.org/wiki/Timsort), a sort function optimized for &ldquo;almost sorted&rdquo; data. Swift made the opposite choice: its sort function does poorly on &ldquo;almost sorted&rdquo; data.

I think it is useful to know that in Swift, sorting an already sorted array is probably the worse possible scenario. If it happens a lot in your code, then you might want to use a different sort function.

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2017/02/06/sort).

__Update__: According to the comments, this was fixed in Swift&rsquo;s source code and will probably be fixed in future releases.

