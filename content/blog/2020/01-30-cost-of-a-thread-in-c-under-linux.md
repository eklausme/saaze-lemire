---
date: "2020-01-30 12:00:00"
title: "Cost of a thread in C++ under Linux"
---



Almost all our computers are made of several processing cores. Thus it can be efficient to &ldquo;parallelize&rdquo; expensive processing in a multicore manner. That is, instead of using a single core to do all of the work, you divide the work among multiple cores. A standard way to approach this problem is to create threads.

A C++ thread object executes some functions, possibly on a thread created by the operating system, and goes away. If you wanted to increment a counter using a C++ thread, you could do it in this manner:
```C
auto mythread = std::thread([] { counter++; });
mythread.join();
```


It is obviously silly code that you should never use as is, it is a mere illustration. Creating a new thread is not free. Exactly how expensive it might be depends on several parameters. But can we get some rough idea?

For this purpose, I wrote a [small benchmark where I just create a thread](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2020/01/30), increment a counter and let the thread die. It is the time elapsed while waiting for the thread to run its course. My program computes the mean and standard error of the time, as well as the minimum and maximum duration of the test. For simplicity, I am just going to report the means:

system                   |time per thread          |
-------------------------|-------------------------|
Ampere server (Linux, ARM) |200,000 ns               |
Skylake server (Linux, Intel) |9,000 ns                 |
Rome server (Linux, AMD) |20,000 ns                |


I am deliberately not going into the details of the compiler, system library, operating system, RAM and all that fun stuff. You should not look at my table and make far reaching conclusions.

What is clear, however, is that creating a thread may cost thousands of CPU cycles. If you have a cheap function that requires only hundreds of cycles, it is almost surely wasteful to create a thread to execute it. The overhead alone is going to set you back.

There are clever ways to amortize the cost of a thread. For example, you may avoid the constant creation of new threads as in my benchmark. Yet to amortize, you still need to have enough work to make it worthwhile.

