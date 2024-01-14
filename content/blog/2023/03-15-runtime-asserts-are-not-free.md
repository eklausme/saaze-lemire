---
date: "2023-03-15 12:00:00"
title: "Runtime asserts are not free"
---



When writing software in C and C++, it is common to add C asserts to check that some conditions are satisfied at runtime. Often, it is a simple comparison between two values.

In many instances, these asserts are effectively free as far as performance goes, but not always. If they appear within a tight loop, they may impact the performance.

One might object that you can choose to only enable assertions for the debug version of your binary&hellip; but this choice is subject to debate. Compilers like GCC or clang (LLVM) do not deactivate asserts when compiling with optimizations. Some package maintainers require all asserts to remain in the release binary.

What do I mean by expensive? Let us consider an example. Suppose I want to copy an array. I might use the following code:
```C
for (size_t i = 0; i < N; i++) {
  x1[i] = x2[i];
}

```


Suppose that I know that all my values are smaller than some threshold, but I want to be double sure. So during the copy, I might add a check:
```C
for (size_t i = 0; i < N; i++) {
  assert(x2[i] < RAND_MAX);
  x1[i] = x2[i];
}

```


It is an inexpensive check. But how much does it cost me?[ I wrote a small benchmark](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/03/15b) which I run on an M2 processor after compiling the code with clang (LLVM 14). I get the following result:

simple loop              |0.3 ns/word              |
-------------------------|-------------------------|
loop with assert         |0.9 ns/word              |


So adding the assert multiply the running time by a factor of three in this instance. Your results will vary but you should not be surprised if the version with asserts is significantly slower.

So asserts are not free. To make matters more complicated, some projects refuse to rely on library that terminates on errors. So having asserts in your library may disqualify it for some uses.

You will find calls to asserts in my code. I do not argue that you should never use them. But spreading asserts in performance critical code might be unwise.

