---
date: "2022-08-09 12:00:00"
title: "&#8220;Hello world&#8221; is slower in C++ than in C (Linux)"
---



A simple C program might print &lsquo;hello world&rsquo; on screen:
```C
#include <stdio.h>
#include <stdlib.h>

int main() {
    printf("hello world\n");
    return EXIT_SUCCESS;
}
```


You can write the equivalent in C++:
```C
#include <iostream>
#include <stdlib.h>

int main() {
    std::cout << "hello world" << std::endl;
    return EXIT_SUCCESS;
}
```


In the recently released C++20 standard, we could use <tt>std::format</tt> instead or wrap the stream in a `basic_osyncstream` for thread safety, but the above code is what you&rsquo;d find in most textbooks today.

How fast do these programs run? You may not care about the performance of these &lsquo;hello world&rsquo; programs per se, but many systems rely on small C/C++ programs running specific and small tasks. Sometimes you just want to run a small program to execute a computation, process a small file and so forth.

We can check the running time using a benchmarking tool such [as hyperfine](https://github.com/sharkdp/hyperfine). Such tools handle various factors such as shell starting time and so forth.

I do not believe that printing &lsquo;hello world&rsquo; itself should be slower or faster in C++ compared to C, at least not significantly. What we are testing by running these programs is the overhead due to the choice of programming language when launching the program. One might argue that in C++, you can use printf (the C function), and that&rsquo;s correct. You can code in C++ as if you were in C all of the time. It is not unreasonable, but we are interested in the performance when relying on conventional/textbook C++ using the standard C++ library.

Under Linux when using the standard C++ library (libstdc++), we can ask that the standard C++ be linked with the executable. The result is a much larger binary executable, but it may provide faster starting time.

Hyperfine tells me that the C++ program relying on the dynamically loaded C++ library takes almost 1 ms more time than the C program.

C                        |0.5 ms                   |
-------------------------|-------------------------|
C++ (dynamic)            |1.4 ms                   |
C++ (static)             |0.8 ms                   |


[My source code and Makefile are available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2022/08/09). I get these numbers on Ubuntu 22.04 LTS using an AWS node (Graviton 3).

If these numbers are to be believed, there may a significant penalty due to textbook C++ code for tiny program executions, under Linux.

Half a millisecond or more of overhead, if it is indeed correct, is a huge penalty for a tiny program like ‘hello workd’. And it only happens when I use dynamic loading of the C++ library: the cost is much less when using a statically linked C++ library.

It seems that loading the C++ library dynamically is adding a significant cost of up to 1 ms. We might check for a few additional confounding factors proposed by my readers.

1. The C compiler might not call the `printf` function, and might call the simpler `puts` function instead: we can fool the compiler into calling `printf` with the syntax <tt>printf("hello %s\n", "world")</tt>: it makes no measurable difference in our tests.
1. If we compile the C function using a C++ compiler, the problem disappears, as you would hope, and we match the speed of the C program.
1. Replacing  <tt>"hello world" &lt;&lt; std::endl;</tt> with <tt>"hello world\n";</tt> does not seem to affect the performance in these experiments. The C++ program remains much slower.
1. Adding <tt>std::ios_base::sync_with_stdio(false);</tt> before using <tt>std::cout</tt> also appears to make no difference. The C++ program remains much slower.


C (non trivial printf)   |0.5 ms                   |
-------------------------|-------------------------|
C++ (using printf)       |0.5 ms                   |
C++ (std::cout replaced by \n) |1.4 ms                   |
C++ (sync_with_stdio set to false) |1.4 ms                   |


Thus we have every indication that dynamically loading the C++ standard library takes a lot time, certainly hundreds of extra microseconds. It may be a one-time cost but if your programs are small, it can dominate the running time. Statically linking the C++ library helps, but it also creates larger binaries. You may reduce somewhat the size overhead with appropriate link-time flags such as <tt>--gc-sections</tt>, but a significant overhead remains in my tests.

__Note:__ This blog post has been edited to answer the multiple comments suggesting confounding factors, other than standard library loading, that the original blog post did not consider. I thank my readers for their proposals.

__Appendix 1__ We can measure precisely the loading time by preceding the execution of the function by <tt>LD_DEBUG=statistics</tt> (thanks to Grégory Pakosz for the hint). The C++ code requires more cycles. If we use <tt>LD_DEBUG=all</tt> (e.g., <tt>LD_DEBUG=all ./hellocpp</tt>), then we observe that the C++ version does much more work (more versions checks, more relocations, many more initializations and finalizers). In the comments, Sam Mason blames dynamic linking: on his machine he gets the following result&hellip;

> C code that dynamically links to libc takes ~240µs, which goes down to ~150µs when statically linked. A fully dynamic C++ build takes ~800µs, while a fully static C++ build is only ~190µs.


__Appendix 2__ We can try to use sampling-based profiling to find out where the programs speeds its time. Calling perf record/perf report is not terribly useful on my system. Some readers report that their profiling points the finger at locale initialization in this manner. I get a much more useful profile with <tt>valgrind --tool=callgrind command &amp;&amp; callgrind_annotate</tt>. The results are consistent with the theory that loading the C++ library dynamically is relatively expensive.

__Appendix 3__ It might get [better with GCC 13](https://developers.redhat.com/articles/2023/04/03/leaner-libstdc-gcc-13) which reduces the overhead of the iostream header.

