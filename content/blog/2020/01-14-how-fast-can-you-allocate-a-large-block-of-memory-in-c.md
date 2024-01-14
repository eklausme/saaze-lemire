---
date: "2020-01-14 12:00:00"
title: "How fast can you allocate a large block of memory in C++?"
---



In C++, the most basic memory allocation code is just a call to the new operator:
```C
char *buf = new char[s];
```


According to a textbook interpretation, we just allocated <tt>s</tt> bytes<sup>[1](#footnote1).</sup>

If you benchmark this line of code, you might find that it almost entirely free on a per-byte basis for large values of <tt>s</tt>. But that is because we are cheating: the call to the new operation &ldquo;virtually&rdquo; allocates the memory, but you may not yet have actual memory that you can use. As you access the memory buffer, the system may then decide to allocate the memory pages (often in blocks of 4096 bytes). Thus the cost of memory allocation can be hidden. The great thing with a virtual allocation is that if you never access the memory, you may never pay a price for it.

If you actually want to measure the memory allocation in C++, then you need to ask the system to give you `s` bytes of allocated and initialized memory. You can achieve the desired result in C++ by adding parentheses after the call to the new operator:
```C
char *buf = new char[s]();
```


Then the operating system actually needs to allocate and initialize memory<sup>[2](#footnote2)</sup>. It may still cheat in the sense that it may recycle existing blocks of memories or otherwise delay allocation. And I expect that it might do so routinely if the value of `s` is small. But it gets harder for the system to cheat as `s` grows larger.

What happens if you allocate hundreds of megabytes in such a manner? The answer depends on the size of the pages. By default, your system probably uses small (4kB) pages. Under Linux, you can enable &ldquo;transparent huge pages&rdquo; which dynamically switches to large pages when large blocks of memory are needed. Using larger pages means having to allocate and access fewer pages, so it tends to be cheaper.

In both instances, I get around a couple of gigabytes per second on a recent Linux system (Ubuntu 16.04) running a conventional Skylake processor. For comparison, you can set memory to zero at tens gigabytes per second and my disk can feed data to the system at more than 2 GB/s. Thus, at least on the system I am currently using, memory allocation is not cheap. [My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2020/01/14), I use GNU GCC 8.3 with the -O2 optimization flag.

&nbsp;                   |Allocating 512MB         |Setting 512MB to zero    |
-------------------------|-------------------------|-------------------------|
regular pages (4kB)      |1.6 GB/s                 |30 GB/s                  |
transparent huge pages   |2.4 GB/s                 |30 GB/s                  |


You can do better with different C++ code, see my follow-up post [Allocating large blocks of memory: bare-metal C++ speeds](/lemire/blog/2020/01/17/allocating-large-blocks-of-memory-bare-metal-c-speeds/).

__Further remarks__. Of course, you can reuse the allocated memory for greater speeds. The memory allocator in my standard library could possibly do this already when I call the new operator followed by the delete operator in a loop. However, you still need to allocate the memory at some point, if only at the beginning of your program. If you program needs to allocate 32 GB of memory, and you can only do so at 1.4 GB/s, then your program will need to spend 23 seconds on memory allocation alone.

__Footnotes__:

1. <a name="footnote1"></a>Several readers have asked why I am ignoring C functions like <tt>calloc</tt>, `malloc` and <tt>mmap</tt>. The reason is simple: this post is focusing on idiomatic C++.
1. <a name="footnote2"></a>You might wonder why the memory needs to be initialized. The difficulty has to do with security. Though it is certainly possible for the operating system to give you direct access to memory used by another process, it cannot also pass along the data. Thus it needs to erase the data. To my knowledge, most systems achieve this result by zeroing the new memory.


