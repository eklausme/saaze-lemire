---
date: "2022-11-10 12:00:00"
title: "Measuring the memory usage of your C++ program"
---



In C++, we might implement dynamic lists using the vector template. The int-valued constructor of the vector template allocates at least enough memory to store the provided number of elements in a contiguous manner. How much memory does the following code use?
```C
  std::vector<uint8_t> v1(10);
  std::vector<uint8_t> v2(1000000);
```



The naive answer is 1000010 bytes or slightly less than 1 MB, but if you think a bit about it, you quickly realize that 1000010 bytes might be a lower bound. Indeed, the vector might allocate more memory and there is unavoidably some overhead for the vector instance.

Thankfully, it is easy to measure it. [I wrote a little C++ program](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2022/11/10) to measure actual memory usage in terms of allocated pages attributed to the program. We find that we use far more memory (2x or 4x more) than a naive analysis might suggest.

&nbsp;                   |start of the program     |after the first vector   |at the end               |
-------------------------|-------------------------|-------------------------|-------------------------|
ARM-based macOS          |1.25 MB                  |1.25 MB                  |2.25 MB                  |
Intel-based Linux        |1.94 MB                  |1.94 MB                  |4.35 MB                  |


Interestingly, reserving memory may not use any new memory as pointed by a reader (Martin Leitner-Ankerl). In my tests, adding the following two lines did not change memory usage:
```C
std::vector<uint8_t> v3;
v3.reserve(1000000000);
```


__Further reading__: [Measuring memory usage: virtual versus real memory](/lemire/blog/2021/07/29/measuring-memory-usage-virtual-versus-real-memory/)

__Tooling__: Ivica Bogosavljevic recommends that Linux users try [heaptrack](https://apps.kde.org/fr/heaptrack/) to better understand memory usage. Aleksey Kladov prefers [Bytehound](https://github.com/koute/bytehound).

