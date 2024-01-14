---
date: "2012-06-26 12:00:00"
title: "Which is fastest: read, fread, ifstream or mmap?"
---



If you program in C/C++, you have many options to read files:

- The standard C library offers a low-level read function. It is as simple as it gets.- The standard C library also offers a higher level [fread function](http://en.cppreference.com/w/c/io/fread). Unlike the read function, you can set a buffer size. Buffers can be good or bad. On the one hand, they reduce the number of disk accesses. On the other hand, they introduce an intermediate step between the disk and you data. That is, they may cause the data to be copied needlessly. Buffers usually makes software faster because copying data in memory is much faster than reading it from disk.
- In C++, you have [ifstream](http://en.cppreference.com/w/cpp/io/basic_ifstream). It is very similar to fread, but with a more object-oriented flavor.
- Finally, you can use [memory mapping](https://en.wikipedia.org/wiki/Mmap). Instead of reading blocks of data, you map the content of the file to a pointer and the operating system is responsible with filling in the data. It has the reputation to be very fast because the data on disk can be mapped directly to memory without any undue copying. However, in my experience, it is also less stable: you are unlikely to cause a bus error with fread or ifstream, but the slightest mistake with memory mapping and your program can crash.


For my work, a lot of the IO is based on sequential access. For this kind of access pattern, I have never found memory mapping to be useful. To support my claim, I created a little program that reads arrays of integers from a file, and does some minor computations on them. Memory mapping is not beneficial:

method                   |&nbsp;millions of int. per s&nbsp; |
-------------------------|-------------------------|
C read                   |70                       |

C fread                  |124                      |

C++ ifstream             |124                      |

mmap                     |125                      |



As usual, my [benchmark code](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2012/06/26/ioaccess.cpp) is available for inspection. I used a Linux desktop with an Intel Core i7 processor and GCC 4.7 with the -O3 flag for my tests.

__Conclusion__: For sequential access, both fread and ifstream are equally fast. Unbuffered IO (read) is slower, as expected. Memory mapping is not beneficial.

__Warning__: Benchmarking IO reliably is difficult. Results will vary depending on your configuration.

