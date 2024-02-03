---
date: "2021-08-03 12:00:00"
title: "How fast can you pipe a large file to a C++ program?"
---



Under many operating systems, you can send data from from one process to another using &lsquo;pipes&rsquo;. The term &lsquo;pipe&rsquo; is probably used by analogy with plumbing and we often use the the symbol &lsquo;<tt>|</tt>&lsquo; to represent a pipe (it looks like a vertical pipe).

Thus, for example, you can sort a file and send it as input to another process:

<code>sort file | dosomething</code>

The operating system takes care of the data. It can be more convenient than to send the data to a file first. You can have a long sequence of pipes, processing the data in many steps.

How efficient is it computationally?

The speed of a pipe depends on the program providing the data. So let us build a program that just outputs a lot of spaces very quickly:
```C
  constexpr size_t buflength = 16384;
  std::vector<char> buffer(buflength, ' ');
  for(size_t i = 0; i < repeat; i++) {
    std::cout.write(buffer.data(), buflength);
  }
```


For the receiving program, let us write a simple program that receives the data, little else:
```C
  constexpr size_t cache_length = 16384;
  char cachebuffer[cache_length];
  size_t howmany = 0;
  while(std::cin) {
    std::cin.read(cachebuffer, cache_length);
    howmany += std::cin.gcount();
  }
```


You could play with the buffer sizes: I use relatively large buffers to minimize the pipe overhead.

I am sure you could write more efficient programs, but I believe that most software using pipes is going to be less efficient than these two programs.

I guess speeds that are quite good under Linux but rather depressing under macOS:

macOS (Big Sur, Apple M1) |0.04 GB/s                |
-------------------------|-------------------------|
Linux (Centos 7, ARM Rome) |2 GB/s to 6.5 GB/s       |


Your results will be different: [please run my benchmark](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2021/08/03). It might be possible to go faster with larger inputs and larger buffers.

Even if the results are good under Linux, the bandwidth is not infinite. You will get better results passing data from within a program, even if you need to copy it.

As observed by one of the readers of this blog, you can fix the performance problem under macOS by falling back on a C API:
```C
  size_t howmany = 0;
  size_t tr;
  while((tr = read(0, cachebuffer, cache_length))) {
    howmany += tr;
  }
```


You lose portability, but you gain a lot of performance. I achieve a peak performance of 7 GB/s or above which is much more comparable to the cost of copying the data within a process.

It is not uncommon for standard C++ approaches to disappoint performance-wise.

