---
date: "2013-09-13 12:00:00"
title: "Are 8-bit or 16-bit counters faster than 32-bit counters?"
---



Programmers often want to count things. They typically use 32-bit counters (e.g., the int type in Java).
But what if you are counting small numbers? Maybe a 16-bit counter could be enough (e.g., the short type in Java). Obviously, using fewer bits saves memory. Saving memory often makes programs run faster.

However, something evil could also happen. Maybe compilers or CPUs are optimized for 32-bit arithmetic?

I designed a small experiment. I build an array of counters. I repeatedly increment some of the counters. I then run through the array seeking counter values that exceed some threshold. [My code is freely available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2013/09/13/bytecounting).

One parameter is the size of the array. I expect that for tiny numbers of counters, the number of bits will be irrelevant: all of the counters can fit in CPU cache.
Another parameter is the language. Does Java behave differently from C++? You would hope not, but C++ compilers can pull tricks that Java can&rsquo;t, and vice versa.

I ran my tests on a recent Intel Core i7 processor. I was surprised to find that the Java and C++ speeds were almost the same:

&nbsp;Number of counters&nbsp; |&nbsp;8 bits&nbsp;       |&nbsp;16 bits&nbsp;      |&nbsp;32 bits&nbsp;      |&nbsp;64 bits&nbsp;      |
-------------------------|-------------------------|-------------------------|-------------------------|-------------------------|
2<sup>16</sup>           |94                       |94                       |94                       |94                       |
2<sup>23</sup>           |44                       |28                       |22                       |22                       |


As expected, when there are few counters, it does not matter how many bits you use. However, when the number of counters becomes large, using 8-bit counters instead of 32-bit counters can double the speed.

__Conclusion__: When you have many, it could be worth your time to benchmark an alternative using 8-bit or 16-bit counters.

