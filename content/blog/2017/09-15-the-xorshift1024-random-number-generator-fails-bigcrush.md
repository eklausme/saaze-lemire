---
date: "2017-09-15 12:00:00"
title: "The Xorshift1024* random number generator fails BigCrush"
---



In software, we use random number generators to simulate randomness. They take the form of functions which return numbers that appear random. To test their quality, we apply statistical tests. The goal standard is a statical test called BigCrush. It tests that quality of 32-bit random values.

In an earlier post, I reported that contrary to what you can read on the [Xorshift Wikipedia page](https://en.wikipedia.org/wiki/Xorshift), the Xorshift128+ random number generator fails BigCrush. This is somewhat significant because Xorshift128+ has been widely adopted.

The [Xorshift Wikipedia page](https://en.wikipedia.org/wiki/Xorshift) also states that a more expensive generator, xorshift1024*, passes BigCrush. So I wondered, does it, indeed, pass BigCrush?

So I used my testing framework to run BigCrush. I use four different &ldquo;seeds&rdquo; and I only worry about a failure if it occurs with all four seeds, and with an excessively improbable p-value. Because xorshift1024* generates 64-bit outputs, and BigCrush requires 32-bit inputs, I only keep the 32 least significant bits of each word produced by xorshift1024*.

Here are my results:
```C
 ./summarize.pl testxorshift1024star*.log
reviewing xorshift1024star lsb 32-bits
Summary for xorshift1024star lsb 32-bits (4 crushes):
- #81: LinearComp, r = 29: FAIL!! -- p-values too unlikely (1 - eps1, 1 - eps1, 1 - eps1, 1 - eps1) -- ALL CRUSHES FAIL!!

reviewing xorshift1024star lsb 32-bits (bit reverse)
Summary for xorshift1024star lsb 32-bits (bit reverse) (4 crushes):
- #80: LinearComp, r = 0: FAIL!! -- p-values too unlikely (1 - eps1, 1 - eps1, 1 - eps1, 1 - eps1) -- ALL CRUSHES FAIL!!
```


So xorshift1024* fails BigCrush systematically when providing the values as is (log file [1](https://github.com/lemire/testingRNG/blob/master/testu01/results/testxorshift1024star-S412451-b.log), [2](https://github.com/lemire/testingRNG/blob/master/testu01/results/testxorshift1024star-S848432-b.log), [3](https://github.com/lemire/testingRNG/blob/master/testu01/results/testxorshift1024star-S987654-b.log), [4](https://github.com/lemire/testingRNG/blob/master/testu01/results/testxorshift1024star-b.log)), and it fails again with reversing the bit order (log file [1](https://github.com/lemire/testingRNG/blob/master/testu01/results/testxorshift1024star-S412451-z-b.log), [2](https://github.com/lemire/testingRNG/blob/master/testu01/results/testxorshift1024star-S848432-z-b.log), [3](https://github.com/lemire/testingRNG/blob/master/testu01/results/testxorshift1024star-S987654-z-b.log), [4](https://github.com/lemire/testingRNG/blob/master/testu01/results/testxorshift1024star-z-b.log)).

So [the Wikipedia entry](https://en.wikipedia.org/wiki/Xorshift) is misleading. Both xorshift128+ and xorshift1024* fail BigCrush.

[My code is available for review](https://github.com/lemire/testingRNG/), and you can rerun the tests for yourself.

__Further reading__: See [Xorshift1024*, Xorshift1024+, Xorshift128+ and Xoroshiro128+ fail statistical tests for linearity](https://www.sciencedirect.com/science/article/pii/S0377042718306265?dgcid=author), Journal of Computational and Applied Mathematics, to appear (Available online 22 October 2018)

