---
date: "2019-03-20 12:00:00"
title: "ARM and Intel have different performance characteristics: a case study in random number generation"
---



[In my previous post](/lemire/blog/2019/03/19/the-fastest-conventional-random-number-generator-that-can-pass-big-crush/), I reviewed a new fast random number generator called wyhash. I commented that I expected it to do well on x64 processors (Intel and AMD), but not so well on ARM processors.

Let us review again wyhash:
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

It is only two multiplications (plus a few cheap operations like add and XOR), but these are full multiplications producing a 128-bit output.

Let us compare with a similar but conventional generator (splitmix) developed by Steele et al. and part of the Java library:
```C
 uint64_t splitmix64(void) {
  splitmix64_x += 0x9E3779B97F4A7C15;
  uint64_t z = splitmix64_x;
  z = (z ^ (z >> 30)) * 0xBF58476D1CE4E5B9;
  z = (z ^ (z >> 27)) * 0x94D049BB133111EB;
  return z ^ (z >> 31);
}
```


We still have two multiplications, but many more operation. So you would expect splitmix to be slower. And it is, on my typical x64 processor.

[Let me reuse my benchmark](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/03/20) where I simply sum up 524288 random integers are record how long it takes&hellip;

&nbsp;                   |Skylake x64              |[Skylark](https://en.wikichip.org/wiki/ampere_computing/emag) ARM |
-------------------------|-------------------------|-------------------------|
wyhash                   |0.5 ms                   |1.4 ms                   |
splitmix                 |0.6 ms                   |0.9 ms                   |


According to my tests, on the x64 processor, wyhash is faster than splitmix. When I switch to my ARM server, wyhash becomes slower.

The difference is that the computation of the most significant bits of a 64-bit product on an ARM processor requires a separate and potentially expensive instruction.

Of course, your results will vary depending on your exact processor and exact compiler.

__Note__: I have about half a million integers, so if you double my numbers, you will get a rough estimate of the number of nanoseconds per 64-bit integer generated.

__Update 1__: W. Dijkstra correctly pointed out that wyhash could not, possibly, be several times faster than splitmix in a fair competition. I initially reported bad results with splitmix, but after disabling autovectorization (-fno-tree-vectorize), the results are closer. He also points out that results are vastly different on other ARM processors like Falkor and ThunderX2.

__Update 2__: One reading of this blog post is that I am pretending to compare Intel vs. ARM and to qualify one as being better than the other one. That was never my intention. My main message is that the underlying hardware matters a great deal when trying to determine which code is fastest.

__Update 3__. My initial results made the ARM processor look bad. Switching to a more recent compiler (GNU GCC 8.3) resolved the issue.

