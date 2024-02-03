---
date: "2020-01-17 12:00:00"
title: "Allocating large blocks of memory: bare-metal C++ speeds"
---



[In a previous post](/lemire/blog/2020/01/14/how-fast-can-you-allocate-a-large-block-of-memory-in-c/), I benchmarked the allocation of large blocks of memory using idiomatic C++. I got a depressing result: the speed could be lower than 2 GB/s. For comparison, the disk in my laptop has greater bandwidth.

Methodologically, I benchmarked the &ldquo;new&rdquo; operator in C++ with initialization, using the GNU GCC compiler with the -O2 optimization flag<a href="#nefdsafoot1"><sup>1</sup></a>.
```C
char *buf = new char[s]();
```


It turns out that you can do better while sticking with C++. We cannot simply call the new operator without initialization because, in general, it does not result in the memory being actually allocated. However, we can allocate the memory and then make sure that we touch every &ldquo;page&rdquo; of memory. On modern Intel systems, pages are effectively always at least as large of 4kB, so we can touch the memory every 4kB. We might call this approach &ldquo;new and touch&rdquo;.
```C
char * buf = new char[size];
for (size_t i = 0; i < size; i += 4096) buf[i] = 0;
buf[size - 1] = 0;
```


Such a new-and-touch strategy should be close to &ldquo;bare-metal&rdquo; memory allocation speeds. So how fast is it? It depends on the page size. By default, most systems rely on small (4kB) pages. Allocating many small pages is expensive. Thankfully, Linux can be configured to use huge pages, transparently, via a feature called &ldquo;transparent huge pages&rdquo;. And it makes a huge difference!

&nbsp;                   |Allocating 512MB         |Setting 512MB to zero    |
-------------------------|-------------------------|-------------------------|
regular pages (4kB)      |3.9 GB/s                 |30 GB/s                  |
transparent huge pages   |20 GB/s                  |30 GB/s                  |


I am using a recent Linux system (Ubuntu 16.04), a Skylake processor and GNU GCC 8.3 with the -O2 optimization flag. [My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2020/01/14).

It is still the case that allocating memory on most systems is a non-trivial cost since they rely on small 4kB pages. There are fast disks available on the market that have more than 4 GB/s of bandwidth.

__Credit__: Thanks to Travis Downs and others for their insights and comments.

&nbsp;

<a name="nefdsafoot1"></a><sup>1</sup> Downs found that we get far better performance out of the new operator with initialization under GNU GCC with the more agressive -O3 optimization flag. Performance-wise, it should be close to the &ldquo;new and touch&rdquo; approach that I am describing.

