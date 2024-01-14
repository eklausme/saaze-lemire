---
date: "2017-01-27 12:00:00"
title: "How expensive are the union and intersection of two unordered_set in C++?"
---



If you are using a modern C++ (C++11 or better), you have access to set data structures (<tt>unordered_set</tt>) which have the characteristics of a hash set. The standard does not provide us with built-in functions to compute the union and the intersection of such sets, but we can make our own. For example, the union of two sets A and B can be computed as follow:
```C
out.insert(A.begin(), A.end());
out.insert(B.begin(), B.end());
```


where `out` is an initially empty set. Because insertion in a set has expected constant-time performance, the computational complexity of this operation is <em>O</em>(size(A) + size(B)) which is optimal.
If you are a computer scientist who does not care about real-world performance, your work is done and you are happy.
But what if you want to build fast software for the real world? How fast are these C++ sets?

I decided to populate two sets with one million integers each, and compute how how many cycles it takes to compute the intersection and the union, and then I divide by 2,000,000 to get the time spent per input element.

intersection (<tt>unordered_set</tt>) |100 cycles/element       |
-------------------------|-------------------------|
union (<tt>unordered_set</tt>) |250 cycles/element       |


How good or bad is this? Well, we can also take these integers and put them in sorted arrays. Then we can invoke the `set_intersection` and `set_union` methods that STL offers.

<tt>set_intersection</tt> (<tt>std::vector</tt>) |3 cycles/element         |
-------------------------|-------------------------|
<tt>set_union</tt> (<tt>std::vector</tt>) |5 cycles/element         |


That&rsquo;s an order of magnitude better!

So while convenient, C++&rsquo;s `unordered_set` can also suffer from a significant performance overhead.

What about <tt>std::set</tt> which has the performance characteristics of a tree? Let us use code as follows where `out` is an initially empty set.
```C
std::set_union(A.begin(), A.end(), B.begin(), B.end(),
                        std::inserter(out,out.begin()));
```


<tt>set_intersection</tt> (<tt>std::set</tt>) |150 cycles/element       |
-------------------------|-------------------------|
<tt>set_union</tt> (<tt>std::set</tt>) |750 cycles/element       |


As we can see, results are considerably worse.

The lesson is that a simple data structure like that of <tt>std::vector</tt> can serve us well.

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2017/01/27).

