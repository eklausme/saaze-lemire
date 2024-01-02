---
date: "2019-04-12 12:00:00"
title: "Why are unrolled loops faster?"
---



A common optimization in software is to &ldquo;unroll loops&rdquo;. It is best explained with an example. Suppose that you want to compute the scalar product between two arrays:
```C
  sum = 0;
  for (i = 0; i < length; i++)
    sum += x[i] * y[i];
```


An unrolled loop might look as follows:
```C
  sum = 0;
  i = 0;
  if (length > 3)
    for (; i < length - 3; i += 4)
      sum += x[i] * y[i] + x[i + 1] * y[i + 1] +
             x[i + 2] * y[i + 2] + x[i + 3] * y[i + 3];
  for (; i < length; i++)
    sum += x[i] * y[i];
```


Mathematically, both pieces of code are equivalent. However, the unrolled version is often faster. In fact, many compilers will happily (and silently) unroll loops for you (though not always).

Unrolled loops are not always faster. They generate larger binaries. They require more instruction decoding. They use more memory and instruction cache. Many processors have optimizations specific to small tight loops: manual loop unrolling generating dozens of instructions within the loop tend to defeat these optimizations.

But why would unrolled loops be faster in the first place? One reason for their increased performance is that they lead to fewer instructions being executed. 

Let us estimate the number of instructions that we need to be executed with each iteration of the simple (rolled) loop. We need to load two values into registers. We need to execute a multiplication. And then we need to add the product to the sum. That is a total of four instructions. Unless you are cheating (e.g., by using SIMD instructions), you cannot do better than four instructions.

How many instruction do we measure per iteration of the loop? Using a state-of-the-art compiler (GNU GCC 8), I get 7 instructions. Where do these 3 extra instructions come from? We have a loop counter which needs to be incremented. Then this loop counter must be compared with the end-of-loop condition, and finally there is a branch instruction. These three instructions are &ldquo;inexpensive&rdquo;. There is probably some instruction fusion happening and other clever optimizations. Nevertheless, these instructions are not free.

Let us grab the numbers on an Intel (Skylake) processor:

amount of unrolling      |instructions per pair    |cycles per pair          |
-------------------------|-------------------------|-------------------------|
1                        |7                        |1.6                      |
2                        |5.5                      |1.6                      |
4                        |5                        |1.3                      |
8                        |4.5                      |1.4                      |
16                       |4.25                     |1.6                      |


[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/04/12).

The number of instructions executed diminishes progressively (going toward 4) as the overhead of the loop becomes smaller and smaller due to unrolling. However, the speed, as measured in number of cycles, does not keep on decreasing: the sweet spot is about 4 or 8 unrolling. In this instance, unrolling is mostly beneficial because of the reduced instruction overhead of the loop&hellip; but too much unrolling will eventually harm the processing.

There are other potential benefits of loop unrolling in more complicated instances. For example, some loaded values can be carried between loop iterations, thus saving load instructions. If there are branches within the loop, it may help or harm branch prediction to unroll. However, I find that a reduced number of instructions is often in the cards.

