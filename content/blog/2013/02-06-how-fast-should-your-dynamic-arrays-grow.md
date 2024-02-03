---
date: "2013-02-06 12:00:00"
title: "How fast should your dynamic arrays grow?"
---



When programming in Java or C++, your arrays have fixed sizes. So if you have an array of 32 integers and you need an array with 33 integers, you may need to create a whole new array. It is inconvenient. Thus, both Java and C++ provide dynamic arrays. In C++, people most commonly use the STL vector whereas, in Java, the ArrayList class is popular.

Dynamic arrays are simple. They use an underlying array that might be larger than needed. As the dynamic array grows in size, the underlying array might become too small. At this point, we increase the underlying array. However, each time we do so, we have to copy all of the data over, allocate a new array and clear from memory the older array. That is a relatively expensive computation. To minimize the running time, we often grow the underlying array by a factor _x_ (e.g., if x is 2, then the underlying arrays always doubles in size).

A nice result from computer science is that even if we grow the dynamic array by one element _N_ times, the running time will still be in linear time because of the particular way we grow the underlying array. Indeed, roughly speaking, we have to copy about _N_ + <em>N</em>/<em>x</em> + <em>N</em>/<em>x</em><sup>2</sup> + &hellip; or _N_ <em>x</em> / (<em>x</em> &#8211; 1) elements to construct a dynamic array of _N_ elements (for _N_ large). Hence, the running time is linear in <em>N</em>.

However, the complexity still depends on <em>x</em>. Clearly, the larger _x_ is, the fewer elements you need to copy.

- When _x_ is 3/2, we need to copy about 3 _N_ elements to create a dynamic array of size <em>N</em>. 
- When _x_ is 2, we need to copy only about 2 _N_ elements.
- When _x_ is 4, we need to copy only about 1.3 _N_ elements.


It would seem best to pick _x_ as large as possible. However, larger values of _x_ might also grow the underlying array faster than needed. This wastes memory and might slow you down.

So how fast do people grow their arrays?

- In Java, ArrayList uses _x_ = 3/2.
- In C++, the GCC STL implementation uses _x_ = 2.


The Java engineers are more conservative than the C++ hackers. But who is right? And does it matter?

To investigate the problem, I wrote a small benchmark in C++. First, I create a large static array and set its integer values to 0, 1, 2, &hellip; Then I do the same thing with dynamic arrays using various growth factors <em>x</em>. I report the speeds in millions of integers per second (mis) on an Intel Core i7 with GCC 4.7.

&nbsp;&nbsp;<em>x</em>&nbsp;&nbsp; |&nbsp;&nbsp;speed (mis)&nbsp;&nbsp; |
-------------------------|-------------------------|
static array             |2500                     |
1.5                      |240                      |
2                        |340                      |
4                        |480                      |


Of course, this test is only an anecdote, but it does suggest that

- dynamic arrays can add significant overhead
- and that a small growth factor might be particularly slow if you end up constructing a large array.


To alleviate these problems, both the C++ STL vector and the Java ArrayList allow you to set a large capacity for the underlying array.

Of course, people writing high-performance code know to avoid dynamic arrays. Still, I was surprised at how large the overhead of a dynamic array was in my tests.

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2013/01/31/dynarray.cpp).

__Note__: Yes, if you run your own benchmarks, the results will differ. Also, I am deliberately keeping the mathematical details to a minimum. Please do not nitpick my theoretical analysis.

__Update:__ Elazar Leibovich pointed me to an alternative to the STL vector template created by Facebook engineers. The [documentation is interesting](https://github.com/facebook/folly/blob/master/folly/docs/FBVector.md). Gregory Pakosz pointed me to another [page](http://www.gotw.ca/gotw/043.htm) with a related discussion about Java.

