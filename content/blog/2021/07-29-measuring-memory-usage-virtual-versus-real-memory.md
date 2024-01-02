---
date: "2021-07-29 12:00:00"
title: "Measuring memory usage: virtual versus real memory"
---



Software developers are often concerned with the memory usage of their applications, and rightly so. Software that uses too much memory can fail, or be slow.

Memory allocation will not work the same way under all systems. However, at a high level, most modern operating systems have virtual memory and physical memory (RAM). When you write software, you read and write memory at addresses. On modern systems, these addresses are 64-bit integers. For all practical purposes, you have an infinite number of these addresses: each running program could access hundreds of terabytes.

However, this memory is <em>virtual</em>. It is easy to forget what virtual means. It means that we simulate something that is not really there. So if you are programming in C or C++ and you allocate 100 MB, you may not use 100 MB of real memory at all. The following line of code may not cost any real memory at all:
```C
  constexpr size_t N = 100000000;
  char *buffer = new char[N]; // allocate 100MB
```


Of course, if you write or read memory at these &lsquo;virtual&rsquo; memory addresses, some real memory will come into play. You may think that if you allocate an object that spans 32 bytes, your application might receive 32 bytes of real memory. But operating systems do not work with such fine granularity. Rather they allocate memory in units of &ldquo;pages&rdquo;. How big is a page depends on your operating system and on the configuration of your running process. On PCs, a page might often be as small as 4 kB, but it is often larger on ARM systems. Operating systems allow you to request large pages (e.g., one gigabyte). Your application receives &ldquo;real&rdquo; memory in units of pages. You can never just get &ldquo;32 bytes&rdquo; of memory from the operating system.

It means that there is no sense micro-optimizing the memory usage of your application: you should think in terms of pages. Furthermore, [receiving pages of memory is a relative expensive process](/lemire/blog/2020/01/14/how-fast-can-you-allocate-a-large-block-of-memory-in-c/). So you probably do not want to constantly grab and release memory if efficiency is important to you.

Once you have allocated virtual memory, can we predict the actual (real) memory usage within the following loop?
```C
  for (size_t i = 0; i < N; i++) {
    buffer[i] = 1;
  }
```


The result will depend on your system. But a simple model is as follows: count the number of consecutive pages you have accessed, assuming that your pointer begins at the start of a page. The memory used by the pages is a lower-bound on the memory usage of your process, assuming that the system does not use other tricks (like memory compression or other heuristics).

[I wrote a little C++ program under Linux which prints out the memory usage at regular intervals within the loop](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2021/07/29). I use about 100 samples. As you can see in the following figure, my model (indicated by the green line) is an excellent predictor of the actual memory usage of the process.

<a href="https://lemire.me/blog/wp-content/uploads/2021/07/plot.png"><img decoding="async" class="alignnone size-full wp-image-19410" src="https://lemire.me/blog/wp-content/uploads/2021/07/plot.png" alt width="70%" srcset="https://lemire.me/blog/wp-content/uploads/2021/07/plot.png 640w, https://lemire.me/blog/wp-content/uploads/2021/07/plot-300x225.png 300w" sizes="(max-width: 640px) 100vw, 640px" /></a>

Thus a reasonable way to think about your memory usage is to count the pages that you access. The larger the pages, the higher will be the cost in this model. It may thus seem that if you want to be frugal with memory usage, you would use smaller pages. Yet a mobile operating system like Apple&rsquo;s iOS has relatively larger pages (16 kB) than most PCs (4 kb). Given a choice, I would almost always opt for bigger pages because they make memory allocation and access cheaper. Furthermore, you should probably not worry too much about virtual memory. Do not blindly count the address ranges that your application has requested. It might have little to no relation with your actual memory usage.

Modern systems have a lot of memory and very clever memory allocation techniques. It is wise to be concerned with the overall memory usage of your application, but you are more likely to fix your memory issues at the software architecture level than by micro-optimizing the problem.

