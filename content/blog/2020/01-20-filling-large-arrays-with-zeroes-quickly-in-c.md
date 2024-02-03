---
date: "2020-01-20 12:00:00"
title: "Filling large arrays with zeroes quickly in C++"
---



[Travis Downs reports that some C++ compilers have trouble filling up arrays with values at high speed](https://travisdowns.github.io/blog/2020/01/20/zero.html). Typically, to fill an array with some value, C++ programmers invoke the <tt>std::fill</tt>. We might assume that for a task as simple as filling an array with zeroes, the C++ standard library would provide the absolute best performance. However, with GNU GCC compilers, that is not the case.

The following line of C++ code gets compiled as a loop that fills each individual byte with zeroes when applying the conventional -O2 optimization flag.
```C
std::fill(p, p + n, 0);
```


When the array is large, it can become inefficient compared to a highly efficient implementation like the C function like <tt>memset</tt>.
```C
memset(p, 0, n);
```


Travis reports that the difference is a factor of thirty. He also explains how to fix the C++ so that it is as fast as the `memset` function.

What about very large arrays? What if you need to write zeroes all over a 2GB array?

<tt>memset</tt>          |30 GB/s                  |
-------------------------|-------------------------|
<tt>std::fill</tt>       |1.7 GB/s                 |


Roughly speaking, the `memset` function is 15 times faster than <tt>std::fill</tt> in my test. This demonstrates that even if you are working with large volumes of data, you can be easily limited by your inefficient implementations. You are not automatically limited by your memory bandwidth. In fact, <tt>std::fill</tt> in this instance cannot even keep up with a good network adaptor or a fast disk. [We routinely parse JSON data, and write out DOM trees, at speeds far higher than 1.7 GB/s](https://github.com/lemire/simdjson).

Another lesson I would derive from this example is that writing your code in idiomatic C++ is not sufficient to guarantee good performance. There is a lot of engineering involved in making C++ fast, and though it often works out magically, it can fail too.

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2020/01/20).

