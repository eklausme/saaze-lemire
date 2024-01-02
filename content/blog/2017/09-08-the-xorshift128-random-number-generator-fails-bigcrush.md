---
date: "2017-09-08 12:00:00"
title: "The Xorshift128+ random number generator fails BigCrush"
---



In software, we generate randomness with algorithms called &ldquo;pseudo-random number generator&rdquo;, sometimes simply called &ldquo;random number generator&rdquo; or RNG. A popular random number generator is xorshift128+: [it is used by many JavaScript engines](https://v8project.blogspot.ca/2015/12/theres-mathrandom-and-then-theres.html). It was designed by an influential computer science professor, [Sebastiano Vigna](http://vigna.di.unimi.it/), who has done a lot of great work. I suspect that the JavaScript engineers made a fine choice by selecting xorshift128+.

How can you tell that your random number generator has a good quality? A standard test is [TestU01](http://simul.iro.umontreal.ca/testu01/) designed by professor L&rsquo;Ecuyer from the University of Montreal. TestU01 comes with different sets of tests, but BigCrush is the gold standard. A good random number generator should pass BigCrush when you pass the values as-is, as well as when you reverse the bits produced by the random number generator. Indeed, [Vigna writes about another popular random number generator](https://arxiv.org/pdf/1402.6246.pdf):

> A recent example shows the importance of testing the reverse generator. Saito and Matsumoto [2014] propose a different way to eliminate linear artifacts (&hellip;) However, while their generator passes BigCrush, its reverse fails systematically (&hellip;) which highlights a significant weakness in its lower bits.


Passing BigCrush, even after reversing the bits, is not an impossible task. The [SplittableRandom](https://docs.oracle.com/javase/8/docs/api/java/util/SplittableRandom.html) class in Java appears to pass ([Steele et al.](http://gee.cs.oswego.edu/dl/papers/oopsla14.pdf), 2014), and so does the [PCG family](http://www.pcg-random.org/). And, of course, all cryptographic random number generators pass BigCrush, irrespective of the order of the bits.

On Wikipedia, [we can read](https://en.wikipedia.org/wiki/Xorshift) about xorshift128+ passing BigCrush robustly:

> the following xorshift128+ generator uses 128 bits of state (&hellip;) It passes BigCrush, even when reversed.


Is Wikipedia correct? It offers a reference by Vigna who invented xorshift128+ ([Vigna, 2017](http://www.sciencedirect.com/science/article/pii/S0377042716305301)). Vigna&rsquo;s journal article states:

> (&hellip;) we propose a tightly coded xorshift128+ generator that does not fail any test from the BigCrush suite of TestU01 (even reversed) (&hellip;) xorshift128+ generator (&hellip;) is currently the fastest full-period generator we are aware of that does not fail systematically any BigCrush test (not even reversed)


That seems like a pretty definitive statement. It admits that there might be statistical failure, but no systematic one. So it would seem to support the Wikipedia entry.

The xorshift128+ code is not difficult:
```C
#include <stdint.h>
uint64_t s[2];
uint64_t next(void) {
  uint64_t s1 = s[0];
  uint64_t s0 = s[1];
  uint64_t result = s0 + s1;
  s[0] = s0;
  s1 ^= s1 << 23; // a
  s[1] = s1 ^ s0 ^ (s1 >> 18) ^ (s0 >> 5); // b, c
  return result;
}
```


This the version with the paramater recommended by Vigna, but the V8 JavaScript engine went with a slight variation:
```C
uint64_t s[2];
uint64_t next(void) {
  uint64_t s1 = s[0];
  uint64_t s0 = s[1];
  uint64_t result = s0 + s1;
  s[0] = s0;
  s1 ^= s1 << 23; // a
  s[1] = s1 ^ s0 ^ (s1 >> 17) ^ (s0 >> 26); // b, c
  return result;
}
```


(The code I offer is taken directly from the author&rsquo;s website and [is equivalent](https://github.com/lemire/testingRNG/tree/master/unit) to what we find on Wikipedia and in the research paper.)

Can we check the claim? The BigCrush benchmark is available as free software, but it is a pain to set it up and run it. So I [published a package to test it out](https://github.com/lemire/testingRNG). Importantly, you can check my software, compile it, run it, review it&hellip; at your leisure. I encourage you to do it! I use [Vigna&rsquo;s own C implementation](https://github.com/lemire/testingRNG/blob/master/source/xorshift128plus.h).

Statistical tests are never black and white, but you can use [p-values](https://en.wikipedia.org/wiki/P-value) to arrive at a reasonable decision as to whether the test passes or not. The BigCrush implementation does this analysis for us. To make things more complicated, random number generators rely on an initial &ldquo;seed&rdquo; that you input to initiate the generator. Provide a different seed and you will get different results.

So I did the following when running BigCrush:

- I use four different input seeds. I only care if a given test fails for all four seeds. I use 64-bit seeds from which I generate the needed 128-bit seed using another generator ([splitmix64](https://github.com/lemire/testingRNG/blob/master/source/splitmix64.h)), as recommended by Vigna. I just chose my seeds arbitrarily, you can try with your own if you have some free time!
- I only care when BigCrush gives me a conclusive p-value that indicates a clear problem.
- I use the least significant 32 bits produced by xorshift128+, in reversed bit order. (BigCrush expects 32-bit inputs.)


Let us review the results.

[seed: 12345678](https://github.com/lemire/testingRNG/blob/master/testu01/results/testxorshift128plus-z-b.log)
```C
 The following tests gave p-values outside [0.001, 0.9990]:
 (eps  means a value < 1.0e-300):
 (eps1 means a value < 1.0e-15):
       Test                          p-value
 ----------------------------------------------
 68  MatrixRank, L=1000, r=0          eps  
 71  MatrixRank, L=5000               eps  
 80  LinearComp, r = 0              1 - eps1
 ----------------------------------------------
```


[seed: 412451](https://github.com/lemire/testingRNG/blob/master/testu01/results/testxorshift128plus-S412451-z-b.log)
```C
The following tests gave p-values outside [0.001, 0.9990]:
 (eps  means a value < 1.0e-300):
 (eps1 means a value < 1.0e-15):
       Test                          p-value
 ----------------------------------------------
 68  MatrixRank, L=1000, r=0          eps  
 71  MatrixRank, L=5000               eps  
 80  LinearComp, r = 0              1 - eps1
 -----------------------------------------------
```


[seed: 987654](https://github.com/lemire/testingRNG/blob/master/testu01/results/testxorshift128plus-S987654-z-b.log)
```C
The following tests gave p-values outside [0.001, 0.9990]:
 (eps  means a value < 1.0e-300):
 (eps1 means a value < 1.0e-15):
       Test                          p-value
 ----------------------------------------------
 68  MatrixRank, L=1000, r=0          eps  
 71  MatrixRank, L=5000               eps  
 80  LinearComp, r = 0              1 - eps1
 ----------------------------------------------
```


[seed: 848432](https://github.com/lemire/testingRNG/blob/master/testu01/results/testxorshift128plus-S848432-z-b.log)
```C
 The following tests gave p-values outside [0.001, 0.9990]:
 (eps  means a value < 1.0e-300):
 (eps1 means a value < 1.0e-15):
       Test                          p-value
 ----------------------------------------------
 24  ClosePairs mNP1, t = 9          9.2e-5
 24  ClosePairs NJumps, t = 9        1.0e-4
 68  MatrixRank, L=1000, r=0          eps  
 71  MatrixRank, L=5000               eps  
 80  LinearComp, r = 0              1 - eps1
 ----------------------------------------------
```


The failure is equivalent if I use the alternate version of the code, as used by the V8 JavaScript engine.

__Analysis__

Xorshift128+ fails BigCrush when selecting the least significant 32 bits and reversing the bit order. The evidence is clear: I used four different seeds, and it failed MatrixRank and LinearComp in all four cases. [Thus the Wikipedia entry is misleading](https://en.wikipedia.org/wiki/Xorshift) in my opinion.

While I reversed the bit orders, you can also get systematic failures by simply reversing the byte orders. You select the least significant 32 bits, and reverse the resulting four bytes.

The recommended replacement for xorshift128+, xoroshiro128+, also fails BigCrush in a similar manner ([as you can verify by yourself](https://github.com/lemire/testingRNG)). Yet the [xoroshiro128+](https://en.wikipedia.org/wiki/Xoroshiro128%2B) Wikipedia page could serve as an unequivocal recommendation:

> Xoroshiro is the best general purpose algorithm currently available. (&hellip;) Mersenne Twister might still be a better choice for highly conservative projects unwilling to switch to such a new algorithm, but the current generation of statistically tested algorithms brings a baseline of assurance from the outset that previous generations lacked.


I feel that this would need to be qualified. In my tests, Xoroshiro is no faster than [SplittableRandom](https://docs.oracle.com/javase/8/docs/api/java/util/SplittableRandom.html) (which I call splitmix64 following Vigna&rsquo;s terminology), and SplittableRandom passes BigCrush while Xoroshiro does not. Recall that the [PCG functions](http://www.pcg-random.org/) also pass BigCrush and they are quite fast. There are other choices as well.

To be clear, there is probably no harm whatsoever at using xorshift128+, but it does systematically fail reasonable statistical tests. If your core argument for choosing a generator is that it passes hard statistical test, and it fails, I think you have to change your argument somewhat.

__Further reading__: See [Xorshift1024*, Xorshift1024+, Xorshift128+ and Xoroshiro128+ fail statistical tests for linearity](https://www.sciencedirect.com/science/article/pii/S0377042718306265?dgcid=author), Journal of Computational and Applied Mathematics, to appear (Available online 22 October 2018)

