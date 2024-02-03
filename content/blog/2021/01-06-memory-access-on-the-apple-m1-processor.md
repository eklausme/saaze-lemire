---
date: "2021-01-06 12:00:00"
title: "Memory access on the Apple M1 processor"
---



When a program is mostly just accessing memory randomly, a standard cost model is to count the number of distinct random accesses. The general idea is that memory access is much slower than most other computational tasks.

Furthermore, the cost model can be extended to count &ldquo;nearby&rdquo; memory accesses as free. That is, if I read a byte at memory address _x_ and then I read a byte at memory address <em>x</em>+1, I can assume that the second byte comes &ldquo;for free&rdquo;.

This naive memory-access model is often sensible. However, you should always keep in mind that it is merely a model. A model can fail to predict real performance.

How might it fail? A CPU core can issue multiple memory requests at once. So if I need to access 7 memory locations at once, I can issue 7 memory requests and wait for them. It it is likely that waiting for 7 memory requests is slower than waiting for a single memory request, but is it likely to be 7 times slower?

The latest Apple laptop processor, the M1, has apparently a lot of memory-level parallelism. It looks like a single core has about [28 levels of memory parallelism](https://github.com/lemire/testingmlp), and possibly more.<a href="https://lemire.me/blog/wp-content/uploads/2021/01/results.png"><img fetchpriority="high" decoding="async" class="alignnone size-full wp-image-19010" src="https://lemire.me/blog/wp-content/uploads/2021/01/results.png" alt width="640" height="480" srcset="https://lemire.me/blog/wp-content/uploads/2021/01/results.png 640w, https://lemire.me/blog/wp-content/uploads/2021/01/results-300x225.png 300w" sizes="(max-width: 640px) 100vw, 640px" /></a>

Such a high degree of memory-level parallelism makes it less likely that our naive random-memory model applies.

To test it out, I designed the following benchmark where I compare three functions. The first one just grabs pairs of randomly selected bytes and it computes a bitwise XOR between them before adding them to a counter:
```C
  for(size_t i = 0; i < 2*M; i+= 2) {
    answer += array[random[i]] ^ array[random[i + 1]];
  }
```


We compare against a 3-wise version of this function:
```C
  for(size_t i = 0; i < 3*M; i+= 3) {
    answer += array[random[i]] ^ array[random[i + 1]]
              ^ array[random[i + 2]];
  }
```


Our naive memory-access cost model predicts that the second function should be 50% more expensive. However many other models (such as a simple instruction count) would also predict a 50% overhead.

To give our naive memory-access model a run for its money, let us throw in a 2-wise version that also accesses nearby values (with one-byte offset):
```C
  for(size_t i = 0; i < 2*M; i+= 2) {
    int idx1 = random[i];
    int idx2 = random[i + 1];

    answer += array[idx1] ^ array[idx1 + 1]
           ^ array[idx2]  ^ array[idx2 + 1];
  }
```


Our naive memory-access cost model would predict that first and last function should have about the same running time while the second function should be 50% more expensive.

Let us measure it out. I use a 1GB array and I report the average time spent in nanosecond on each iteration.

2-wise                   |8.9 ns                   |
-------------------------|-------------------------|
3-wise                   |13.0 ns                  |
2-wise +                 |12.5 ns                  |


At first glance, our naive memory-access model is validated: the 3-wise function is 46% more expensive than the 2-wise function. Yet we should not be surprised because most reasonable models would make such a prediction since in almost every way, the function does 50% more work.

It is more interesting to compare the two 2-wise function&hellip; the last one is 40% more expensive than the first 2-wise function. It contradicts our prediction. And so, at least in this instance, our simple memory-access cost model fails us on the Apple M1 processor.

__Notes__:

1. [My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2021/01/06). The run-to-run variability is relatively high on such a test, but the conclusion is robust, on my Apple M1 system.
1. [I posted the assembly online](https://gist.github.com/lemire/1c9e8827b45d057d7546e2743ad34496).
1. Importantly, I do not predict that other systems will follow the same pattern. Please do not run this benchmark on your non-M1 PC and expect comparable results.
1. This benchmark is meant to be run on an Apple MacBook with the M1 processor, compiled with Apple&rsquo;s clang compiler. It is not meant to be used on other systems.


