---
date: "2019-02-20 12:00:00"
title: "More fun with fast remainders when the divisor is a constant"
---



In software, compilers can often optimize away integer divisions, and replace them with cheaper instructions, especially when the divisor is a constant. I recently wrote about some work on [faster remainders when the divisor is a constant](/lemire/blog/2019/02/08/faster-remainders-when-the-divisor-is-a-constant-beating-compilers-and-libdivide/). I reported that it can be fruitful to compute the remainder directly, instead of first computing the quotient (as compilers are doing when the divisor is a constant).

To get good results, we can use an important insight that is not documented anywhere at any length: we can use 64-bit processor instructions to do 32-bit arithmetic. This is fair game and compilers could use this insight, but they do not do it systematically. Using this trick alone is enough to get substantial gains in some instances, if the algorithmic issues are just right.

So it is a bit complicated. Using 64-bit processor instructions for 32-bit arithmetic is sometimes useful. In addition, computing the remainder directly without first computing the quotient is sometimes useful. Let us collect a data point for fun and to motivate further work.

First let us consider how you might compute the remainder by leaving it up to the compiler to do the heavy lifting (D is a constant known to the compiler). I expect that the compiler will turn this code into a sequence of instructions over 32-bit registers:
```C
uint32_t compilermod32(uint32_t a) {
  return a % D;
}

```


Then we can compute the remainder directly, using some magical mathematics and 64-bit instructions:
```C
#define M ((uint64_t)(UINT64_C(0xFFFFFFFFFFFFFFFF) / (D) + 1))

uint32_t directmod64(uint32_t a) {
  uint64_t lowbits = M * a;
  return ((__uint128_t)lowbits * D) >> 64;
}
```


Finally, you can compute the remainder &ldquo;indirectly&rdquo; (by first computing the quotient) but using 64-bit processor instructions.
```C
uint32_t indirectmod64(uint32_t a) {
  uint64_t quotient = ( (__uint128_t) M * a ) >> 64;
  return a - quotient * D;
}
```


As a benchmark, I am going to compute a [linear congruential generator](https://en.wikipedia.org/wiki/Linear_congruential_generator) (basically a recursive linear function with a remainder thrown in), using these three approaches, plus the naive one. I use as a divisor the constant number 22, a skylake processor and the GNU GCC 8.1 compiler. For each generated number I measure the following number of CPU cycles (on average):

slow (division instruction) |29 cycles                |
-------------------------|-------------------------|
compiler (32-bit)        |12 cycles                |
direct (64-bit)          |10 cycles                |
indirect (64-bit)        |11 cycles                |


[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/02/19).

Depending on your exact platform, all three approaches (compiler, direct, indirect) could be a contender for best results. In fact, it is even possible that the division instruction could win out in some cases. For example, [on ARM and POWER processors, the division instruction does beat some compilers](https://arxiv.org/pdf/1902.01961.pdf).

Where does this leave us? There is no silver bullet but a simple C function can beat a state-of-the-art optimizing compiler. In many cases, we found that a direct computation of the 32-bit remainder using 64-bit instructions was best.

