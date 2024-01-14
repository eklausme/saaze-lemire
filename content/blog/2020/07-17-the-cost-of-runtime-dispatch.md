---
date: "2020-07-17 12:00:00"
title: "The cost of runtime dispatch"
---



For high-performance software, it is sometimes needed to use different functions, depending on what the hardware supports. You might write different functions, some functions for advanced processors, others for legacy processors.

When you compile the code, the compiler does not yet know which code path will be taken. At runtime, when you start the program, the right function is chosen. This process is called runtime dispatch. Standard libraries will apply runtime dispatch without you having to do any work. However, if you write your own fancy code, you may need to apply runtime dispatching.

On Intel and AMD systems, you can do so by querying the processor, comparing the processor&rsquo;s answer with the various functions you have compiled. Under Visual Studio, [you can use __cpuid function](https://docs.microsoft.com/en-us/cpp/intrinsics/cpuid-cpuidex?view=vs-2019) while GNU GCC has [__get_cpuid](https://stackoverflow.com/questions/8407001/how-portable-is-get-cpuid).

How expensive is this step?

Of course, the answer depends on your exact system but can we get some idea? [I wrote a small C++ benchmark](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2020/07/16) and my estimate is between 100 ns and 150 ns. So it is several hundreds of cycles.

Though it is inexpensive, if you are repeatedly calling an inexpensive function, it may not be viable to pay this price each time. So you can simply do it once, and then point at the right function for all follow-up calls.

Your only mild concern should be concurrency: what if several threads call the same function for the first time at once? In a language like C++, it is unsafe to have several threads modify the same variable. Thankfully, it is a simple matter of requiring that the change and queries be done [atomically](https://en.cppreference.com/w/cpp/atomic/atomic). On Intel and AMD processors, atomic accesses are often effectively free.

If you are not planning on giving the user the ability to pick at runtime another function, you may also rely on the fact that as of C++11, the initialization of static variable is thread safe. However, the compiler still needs to guard access to the variable, so it may not be more efficient.

