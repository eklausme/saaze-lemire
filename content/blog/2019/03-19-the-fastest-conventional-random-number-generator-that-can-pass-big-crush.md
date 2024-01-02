---
date: "2019-03-19 12:00:00"
title: "The fastest conventional random number generator that can pass Big Crush?"
---



In software, we sometimes want to generate (pseudo-)random numbers. The general strategy is to have a state (e.g., a 64-bit integer) and modify it each time we want a new random number. From this state, we can derive a &ldquo;random number&rdquo;.

How do you that you have generated something that can pass as a random number? A gold standard in this game is L&rsquo;Ecuyer&rsquo;s Big Crush benchmark. It is a set of statistical tests. It is not sufficient to &ldquo;pass&rdquo; Big Crush to be a good random number generator, but if you can&rsquo;t even pass Big Crush, you are in trouble.

When I need a super fast and super simple random number that qualifies, I go for Lehmer&rsquo;s generator:
```C
__uint128_t g_lehmer64_state;

uint64_t lehmer64() {
  g_lehmer64_state *= 0xda942042e4dd58b5;
  return g_lehmer64_state >> 64;
}
```


([Source code](https://github.com/lemire/testingRNG/blob/master/source/lehmer64.h))

Once compiled for an x64 processor, the generator boils down to two 64-bit multiplication instructions and one addition. It is hard to beat! The catch is that there is non-trivial data dependency between the calls when using the same state with each call: you may need to complete the two multiplications before you can start work on the next function call. Because our processors are superscalar (meaning that they can do several instructions per cycle), it is genuine concern. You can break this data dependency by having effectively two generators, using one and then the other.

Lehmer&rsquo;s generator passes Big Crush. There are many other fast generators that pass basic statistical tests, like PCG64, xorshift128+, but if you want raw speed, Lehmer&rsquo;s generator is great.

Recently, a new fast contender has been brought to my attention: wyhash. [It is closely related to a family of random number generators and hash functions called MUM](https://github.com/vnmakarov/mum-hash) and designed by Vladimir Makarov (there is a nearly identical generator by Makarov called mum-prng). The new contender works as follow:
```C
uint64_t wyhash64_x; 


uint64_t wyhash64() {
  wyhash64_x += 0x60bee2bee120fc15;
  __uint128_t tmp;
  tmp = (__uint128_t) wyhash64_x * 0xa3b195354a39b70d;
  uint64_t m1 = (tmp >> 64) ^ tmp;
  tmp = (__uint128_t)m1 * 0x1b03738712fad5c9;
  uint64_t m2 = (tmp >> 64) ^ tmp;
  return m2;
}
```


([Source code](https://github.com/lemire/testingRNG/blob/master/source/wyhash.h))

Wyhash (and presumably mum-prng) passes rigorous statistical tests.

On an x64 processor, the function generators two multiplications, one addition and two XOR. If you are counting, that&rsquo;s only two instructions more than Lehmer&rsquo;s generator. Like generators from the PCG family, wyhash updates its seed very simply, and so you can pipeline the generation of two or more random numbers with minimal data dependency between them: as soon as one addition is completed, you can start work on the second number.

Both of these generators might be relatively less performant on ARM processors due to the high cost of generating the full 128-bit product on ARM architectures. They are also both relatively harder to implement in a portable way.

This being said, which is faster on my x64 processor?

Let us run the experiments. I am going to work over sets of 524288 random numbers. I am using a skylake processor and GNU GCC 8. [I make my source code available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/03/19).

First, I just sum up the random numbers being generated.

wyhash                   |0.51 ms                  |
-------------------------|-------------------------|
Lehmer&rsquo;s           |0.63 ms                  |
Lehmer&rsquo;s (two gen.) |0.48 ms                  |
Lehmer&rsquo;s (three gen.) |0.37 ms                  |


From run to run, my margin of error is about 0.02.

Next I am going to store the random numbers in an array.

wyhash                   |0.6 ms                   |
-------------------------|-------------------------|
Lehmer&rsquo;s           |0.6 ms                   |
Lehmer&rsquo;s (two gen.) |0.6 ms                   |
Lehmer&rsquo;s (three gen.) |0.4 ms                   |


So using three Lehmer&rsquo;s generators is best.

Of course, using parallel generators in this manner could be statistically unsafe. One would want to run further tests.

__Credit__: Monakov suggested going to three generators. The post was updated accordingly.

__Further Reading__: There were apparently some Hacker News comments on both a new hash function ([XXH3](https://news.ycombinator.com/item?id=19402602)) and [wyhash](https://news.ycombinator.com/item?id=19357895).

__Credit__: Wyhash was invented by Wang Yi.

__Update__: [I have implemented wyhash in Swift](https://github.com/lemire/SwiftWyhash).

