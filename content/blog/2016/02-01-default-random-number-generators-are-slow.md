---
date: "2016-02-01 12:00:00"
title: "Default random-number generators are slow"
---



Most languages like Java and Go, come with standard pseudo-random-number generators. Java uses a simple [linear congruential generator](https://en.wikipedia.org/wiki/Linear_congruential_generator). Starting with a seed value, it generates a new value with the reccurence formula:
```C
seed = (seed * 0x5DEECE66DL + 0xBL) & ((1L << 48) - 1);
```


The seed variable thus modified time and time again can be considered &ldquo;random&rdquo;. For many practical purposes, it is good enough.

It should also be quite fast. A multiplication has a latency of only 3 cycles on recent Intel processors, and that&rsquo;s the most expensive operation. Java should be able to generate a new 32-bit random number integer every 10 cycles or so on a recent PC.

And that is the kind of speed you get with a straight-forwad implementation:
```C
int next(int bits) {
    seed = (seed * 0x5DEECE66DL + 0xBL) & ((1L << 48) - 1);
    return (int) (seed >>> (48 - bits));
 }
```


Sadly, you should not trust this analysis. Java&rsquo;s <tt>Random.nextInt</tt> is several times slower at generating random numbers than you would expect as the next table shows.

Function                 |Timing (ns) on Skylake processor |
-------------------------|-------------------------|
<tt>Random.nextInt</tt>  |10.4                     |
my `next` function above |2.7                      |


That&rsquo;s a four-fold difference in performance between my implementation and the standard Java one!

Languages like Go do not fare any better. Even the venerable `rand` function from the C standard library is several times slower than you would expect.

Why? Because the standard Java API provides you with a concurrent random number generator. In effect, if you use the Java random number generator in a multithreaded context, it is safe: you will get &ldquo;good&rdquo; random number generator. Go and other languages do the same thing.

It is unclear to me why it is needed. You can easily get concurrency in a multithreaded context by using one seed per thread.

Evidently, language designers feel that random-number generators should be particularly idiot-proof. Why have the random-number generators received this particular type of attention? 

For users who want less overhead, the Java API provides a class in the concurrent package called `ThreadLocalRandom` that is nearly as far as my naive function, as the next table shows.

Function                 |Timing (ns) on Skylake processor |
-------------------------|-------------------------|
<tt>ThreadLocalRandom</tt> |3.2                      |


It turns out that the ThreadLocalRandom uses many optimization tricks, covering all of its functions, that the Random class does not have. 

In any case, if you need to write fast software that depends on random numbers (such as a simulation), you probably want to pick your own random-number generator.

__Reference__: As usual, my benchmarking software is [available online](https://github.com/lemire/microbenchmarks).

__Credit__: I am grateful to Viktor Szathmary for pointing out the `ThreadLocalRandom` class. 

