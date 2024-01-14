---
date: "2017-09-15 12:00:00"
title: "How fast are malloc_size and malloc_usable_size in C?"
---



When programming in C, we allocate memory dynamically using the `malloc` function, by passing how many bytes we wish to allocate. If successful, the function returns a pointer to the newly allocated memory. Later we can free the allocated memory with the `free` function.

In general, unless you are keeping track of it yourself, you cannot recover the number of bytes you wanted to allocate. That&rsquo;s because the `malloc` function can allocate more memory than you request. For example, if you call <tt>malloc(1)</tt>, you should not assume that only one byte was allocated.

However, you can ask the system to report the number of allocated bytes. It will always be at least as much as you requested but could be more (possibly a lot more). Under macOS, you call `malloc_size` and under Linux you call <tt>malloc_usable_size</tt>.
I have never seen these functions actually used in the wild. But they could possibly be useful. For example, if you allocate memory for a string buffer, why would you painfully keep track of how much memory you wanted when you can simply request the potentially more useful allocated number of allocated bytes?

At a minimum, these functions could help with debugging: you could easily check dynamically that you have enough memory allocated throughout the life of your problem.

One reason to avoid these functions is that they are not standard. This means that if your code relies on them, it is possible that you could have difficulties porting your code to a new platform in the future.

Another good reason to track the number of bytes yourself is performance.

So how fast are they?

&nbsp;                   |macOS                    |Linux                    |
-------------------------|-------------------------|-------------------------|
Time (CPU cycles)        |~50                      |~10                      |


On Linux, `malloc_usable_size` is fast enough for almost every purpose, except maybe for your most performance-critical code. On macOS, `malloc_size` should be used sparingly.

This matches a performance pattern I have observed: the standard C libraries under Linux have very fast memory allocation compared to Apple platforms.

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2017/09/12).

__Credit__: This blog post was inspired by Slava Pestov.

