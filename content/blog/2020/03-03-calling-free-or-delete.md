---
date: "2020-03-03 12:00:00"
title: "Will calling &#8220;free&#8221; or &#8220;delete&#8221; in C/C++ release the memory to the system?"
---



In the C programming language, we typically manage memory manually. A typical heap allocation is a call to malloc followed by a call to free. In C++, you have more options, but it is the same routines under the hood.
```C
// allocate N kB
data = malloc(N*1024);
// do something with the memory
// ...
// release the memory
free(data);
```


It stands to reason that if your program just started and the value of _N_ is large, then the call to malloc will result in an increased memory usage by about _N_ kilobytes. And indeed, it is the case.

So what is the memory usage of your process after the call to &ldquo;free&rdquo;? Did the _N_ bytes return to the system?

The answer is that, in general, it is not the case. [I wrote a small program under Linux that allocates _N_ kilobytes and then frees them. It will then measure the RAM usage after the call to free](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2020/03/03). The exact results will depend on your system, standard library and so on, but I give my results as an illustration.

As you can observe in the table, the memory does sometimes get released, but only when it is a large block of over 30 MB in my tests. It is likely because in such cases a different code path is used (e.g., calling mmap, munmap). Otherwise, the process holds on to its memory, never again releasing it to the system.

memory requested         |memory usage after a free |
-------------------------|-------------------------|
1 kB                     |630 kB                   |
100 kB                   |630 kB                   |
1000 kB                  |2000 kB                  |
10,000 kB                |11,000 kB                |
20,000 kB                |21,000 kB                |
30,000 kB                |31,000 kB                |
40,000 kB                |1,200 kB                 |
50,000 kB                |1,300 kB                 |
100,000 kB               |1,300 kB                 |


Of course, there are ways to force the memory to be released to the system (e.g., [malloc_trim](https://stackoverflow.com/questions/15529643/what-does-malloc-trim0-really-mean) may help), but you should not expect that it will do so by default.

Though I use C/C++ as a reference, the exact same effect is likely to occur in a wide range of programming languages.

What are the implications?

- You cannot measure easily the memory usage of your data structures using the amount of memory that the processes use.
- It is easy for a process that does not presently hold any data to appear to be using a lot of memory.


__Further reading:__ [glibc malloc inefficiency](http://notes.secretsauce.net/notes/2016/04/08_glibc-malloc-inefficiency.html)

