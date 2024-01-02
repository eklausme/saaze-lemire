---
date: "2012-08-13 12:00:00"
title: "On feeding your CPU with data"
---



 Can you guess the speed difference between these two lines of code? The first line of code does N additions:
```C
for (int i=0; i<N;i++) sum+=arr[i];
```


The second line of code does N/16 additions:
```C
for (int i=0; i<N;i+=16) sum+=arr[i];
```


A naive programmer might expect the second option to be 16 times faster. The actual answer is much more complicated and worth further study. I have implemented a [simple test](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2012/08/13/elazartest.cpp). 

I used the GNU GCC 4.5 compiler with the -O2 optimization flag. We can compute the complete sum faster using different compiler flags (-O3 -funroll-loops) and I present these results in a separate column (sum-unroll). In this last version, the compiler makes aggressive use of SSE instructions to vectorize the problem.

&nbsp;&nbsp;N&nbsp;&nbsp; |sum                      |sum-unroll               |1/16                     |
-------------------------|-------------------------|-------------------------|-------------------------|
20K&nbsp;&nbsp;          |&nbsp;&nbsp;1100&nbsp;&nbsp; |&nbsp;&nbsp;6700&nbsp;&nbsp; |&nbsp;&nbsp;20,000       |
400K&nbsp;&nbsp;         |&nbsp;&nbsp;1000&nbsp;&nbsp; |&nbsp;&nbsp;3700&nbsp;&nbsp; |&nbsp;&nbsp;5100         |
500M&nbsp;&nbsp;         |&nbsp;&nbsp;2100&nbsp;&nbsp; |&nbsp;&nbsp;3900&nbsp;&nbsp; |&nbsp;&nbsp;4200         |


The speeds are expressed in millions of integers per second. 

On tiny arrays, most of the data resides close to the CPU. Hence, computations are essentially CPU bound: doing fewer computations means more speed. 

The story with large arrays is different. There, skipping almost all of the data (15 integers out of 16) only buys you twice the speed! Moreover, once we take into account the vectorized version that the compiler produced (sum-unroll), the difference becomes almost insignificant! 

My source code is [available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2012/08/13/elazartest.cpp) as usual.

__Conclusion__: We are in the big data era. Maybe ironically, I sometimes get the impression that our processors are drinking data out of a straw. Whereas a speed of 20,000 million integers per second is possible when the data is cached, I barely surpass 4000 million integers per second when reading from RAM.

__Source__: I stole the problem from Elazar Leibovich who posted it privately on Google+.

