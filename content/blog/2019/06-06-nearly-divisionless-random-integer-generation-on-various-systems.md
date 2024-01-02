---
date: "2019-06-06 12:00:00"
title: "Nearly Divisionless Random Integer Generation On Various Systems"
---



It is common in software to need random integers within a range of values. For example, you may need to pick an object at random in an array. Random shuffling algorithms require such random integers.

Typically, you generate integers uniformly at random over the full range (say a 64-bit integer in [0, 2<sup>64</sup>) or a 32-bit integer in [0, 2<sup>32</sup>)). From these integers, you find a way to get integers without a range. O&rsquo;Neill [showed that this apparently unimportant operation can be more expensive than generating the original random integers](http://www.pcg-random.org/posts/bounded-rands.html).

Naively, you could take the random integer and compute the remainder of the division by the size of the interval. It works because the remainder of the division by D is always smaller than D. Yet it introduces a statistical bias. You can do better without being slower. The conventional techniques supported in Java and Go require at least one or two integer division per integer generated. Unfortunately, division instructions are relatively expensive.

If you are willing to suffer a slight statistical bias, you can generate a floating-point values in [0,1) and multiply the result by the size of the interval. It avoids the division but introduces other overhead.

[There is a better approach that requires no division most of the time](https://arxiv.org/abs/1805.10941):
```C
uint64_t nearlydivisionless ( uint64_t s ) {
  uint64_t x = random64 () ;
  __uint128_t m = ( __uint128_t ) x * ( __uint128_t ) s;
  uint64_t l = ( uint64_t ) m;
  if (l < s) {
    uint64_t t = -s % s;
    while (l < t) {
      x = random64 () ;
      m = ( __uint128_t ) x * ( __uint128_t ) s;
      l = ( uint64_t ) m;
    }
  }
  return m >> 64;
}
```


Let us suppose that I shuffle an array of size 1000. I generate 64-bit integers (or floating-point numbers) which I convert to indexes. I use C++ but I reimplement the algorithm used in Java. Let me look at the number of nanoseconds per input key being shuffled on a Skylake processor (Intel):

Java&rsquo;s approach    |7.30 ns                  |
-------------------------|-------------------------|
Floating point approach (biased) |6.23 ns                  |
Nearly division-free     |1.91 ns                  |


So the division-free approach is much better.

Is this result robust to the hardware? Let us try on Cannon Lake processor where the division instruction is faster&hellip;

Java&rsquo;s approach    |3.75 ns                  |
-------------------------|-------------------------|
Floating point approach (biased) |8.24 ns                  |
Nearly division-free     |2.53 ns                  |


The division-free approach is less beneficial because of the faster division, but the gains are still there.

What about an ARM processor? Let us try on an Ampere Skylark.

Java&rsquo;s approach    |20.67 ns                 |
-------------------------|-------------------------|
Floating point approach (biased) |14.73 ns                 |
Nearly division-free     |8.24 ns                  |


Again, the division-free approach wins.

Practically speaking, avoiding integer divisions is a good way to generate faster code.

[I make my code available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/06/06). To ease reproducibility, I have used docker containers: you should be able to reproduce my results.

__Further reading__: [Fast Random Integer Generation in an Interval](https://arxiv.org/abs/1805.10941), ACM Transactions on Modeling and Computer Simulation 29 (1), 2019

