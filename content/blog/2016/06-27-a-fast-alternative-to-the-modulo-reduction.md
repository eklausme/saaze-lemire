---
date: "2016-06-27 12:00:00"
title: "A fast alternative to the modulo reduction"
---



Suppose you want to pick an integer at random in a set of <em>N</em> elements. Your computer has functions to generate random 32-bit integers, how do you transform such numbers into indexes no larger than <em>N</em>? Suppose you have a hash table with a capacity <em>N</em>. Again, you need to transform your hash values (typically 32-bit or 64-bit integers) down to an index no larger than <em>N</em>. Programmers often get around this problem by making sure that _N_ is a power of two, but that is not always ideal.

We want a map that as fair as possible for an arbitrary integer <em>N</em>. That is, ideally, we would want that there are exactly 2<sup>32</sup>/<em>N</em> values mapped to each value in the range {0, 1 ,&hellip;, _N_ &#8211; 1} when starting from all 2<sup>32</sup> 32-bit integers.

Sadly, we cannot have a perfectly fair map if 2<sup>32</sup> is not divisible by <em>N</em>. But we can have the next best thing: we can require that there be either floor(2<sup>32</sup>/<em>N</em>) or ceil(2<sup>32</sup>/<em>N</em>) values mapped to each value in the range.

If _N_ is small compared to 2<sup>32</sup>, then this map could be considered as good as perfect.

The common solution is to do a modulo reduction: _x_ mod <em>N</em>. (Since we are computer scientists, we define the modulo reduction to be the remainder of the division, unless otherwise stated.)
```C
uint32_t reduce(uint32_t x, uint32_t N) {
  return x % N;
}
```


How can I tell that it is fair? Well. Let us just run through the values of _x_ starting with 0. You should be able to see that the modulo reduction takes on the values 0, 1, &hellip;, _N_ &#8211; 1, 0, 1, &hellip; as you increment <em>x</em>. Eventually, _x_ arrives at its last value (2<sup>32</sup> &#8211; 1), at which point the cycle stops, leaving the values 0, 1, &hellip;, (2<sup>32</sup> &#8211; 1) mod _N_ with ceil(2<sup>32</sup>/<em>N</em>) occurrences, and the remaining values with floor(2<sup>32</sup>/<em>N</em>) occurrences. It is a fair map with a bias for smaller values.

It works, but a modulo reduction involves a division, and divisions are expensive. Much more expensive than multiplications. A single 32-bit division on a recent x64 processor has a throughput of one instruction every six cycles with a latency of 26 cycles. In contrast, a multiplication has a throughput of one instruction every cycle and a latency of 3 cycles.

There are fancy tricks to &ldquo;precompute&rdquo; a modulo reduction so that it can be transformed into a couple of multiplications as well as a few other operations, as long as _N_ is known ahead of time. Your compiler will make use of them if _N_ is known at compile time. Otherwise, you can use a software library or work out your own formula.

But it turns out that you can do even better! That is, there is an approach that is easy to implement, and provides just as good a map, without the same performance concerns.

Assume that _x_ and _N_ are 32-bit integers, consider the 64-bit product _x_ * <em>N</em>. You have that (<em>x</em> * <em>N</em>) div 2<sup>32</sup> is in the range, and it is a fair map.
```C
uint32_t reduce(uint32_t x, uint32_t N) {
  return ((uint64_t) x * (uint64_t) N) >> 32 ;
}
```


Computing (<em>x</em> * <em>N</em>) div 2<sup>32</sup> is very fast on a 64-bit processor. It is a multiplication followed by a shift. On a recent Intel processor, I expect that it has a latency of about 4 cycles and a throughput of at least on call every 2 cycles.

So how fast is our map compared to a 32-bit modulo reduction?

To test it out, I have implemented a benchmark where you repeatedly access random indexes in an array of size <em>N</em>. The indexes are obtained either with a modulo reduction or our approach. On a recent Intel processor (Skylake), I get the following number of CPU cycles per accesses:

modulo reduction         |fast range               |
-------------------------|-------------------------|
8.1                      |2.2                      |


So it is four times faster! No bad.

As usual, [my code is freely available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2016/06/25/fastrange.c).

What can this be good for? Well&hellip; if you have been forcing your arrays and hash tables to have power-of-two capacities to avoid expensive divisions, you may be able to use the fast range map to support arbitrary capacities without too much of a performance penalty. You can also generate random numbers in a range faster, which matters if you have a very fast random number generator.

So how can I tell that the map is fair?

By multiplying by <em>N</em>, we take integer values in the range [0, 2<sup>32</sup>) and map them to multiples of _N_ in [0, _N_ * 2<sup>32</sup>). By dividing by 2<sup>32</sup>, we map all multiples of _N_ in [0, 2<sup>32</sup>) to 0, all multiples of _N_ in [2<sup>32</sup>, 2 * 2<sup>32</sup>) to one, and so forth. To check that this is fair, we just need to count the number of multiples of _N_ in intervals of length 2<sup>32</sup>. This count must be either ceil(2<sup>32</sup>/<em>N</em>) or floor(2<sup>32</sup>/<em>N</em>).

Suppose that the first value in the interval is a multiple of <em>N</em>: that is clearly the scenario that maximizes the number of multiples in the interval. How many will we find? Exactly ceil(2<sup>32</sup>/<em>N</em>). Indeed, if you draw sub-intervals of length <em>N</em>, then every complete interval begins with a multiple of _N_ and if there is any remainder, then there will be one extra multiple of <em>N</em>. In the worst case scenario, the first multiple of _N_ appears at position _N_ &#8211; 1 in the interval. In that case, we get floor(2<sup>32</sup>/<em>N</em>) multiples. To see why, again, draw sub-intervals of length <em>N</em>. Every complete sub-interval ends with a multiple of <em>N</em>.

This completes the proof that the map is fair.

For fun, we can be slightly more precise. We have argued that the number of multiples was maximized when a multiple of _N_ appears at the very beginning of the interval of length 2<sup>32</sup>. At the end, we get an incomplete interval of length 2<sup>32</sup> mod <em>N</em>. If instead of having the first multiple of _N_ appear at the very beginning of the interval, it appeared at index 2<sup>32</sup> mod <em>N</em>, then there would not be room for the incomplete subinterval at the end. This means that whenever a multiple of _N_ occurs before 2<sup>32</sup> mod <em>N</em>, then we shall have ceil(2<sup>32</sup>/<em>N</em>) multiples, and otherwise we shall have floor(2<sup>32</sup>/<em>N</em>) multiples.

Can we tell which outcomes occur with frequency floor(2<sup>32</sup>/<em>N</em>) and which occurs with frequency ceil(2<sup>32</sup>/<em>N</em>)? Yes. Suppose we have an output value <em>k</em>. We need to find the location of the first multiple of _N_ no smaller than _k_ 2<sup>32</sup>. This location is ceil(<em>k</em> 2<sup>32</sup> / <em>N</em>) _N_ &#8211; _k_ 2<sup>32</sup> which we just need to compare with 2<sup>32</sup> mod <em>N</em>. If it is smaller, then we have a count of ceil(2<sup>32</sup>/<em>N</em>), otherwise we have a count of floor(2<sup>32</sup>/<em>N</em>).

You can correct the bias with a rejection, see my post on [fast shuffle functions](/lemire/blog/2016/06/30/fast-random-shuffling/).

__Useful code__: I published a [C/C++ header on GitHub](https://github.com/lemire/fastrange) that you can use in your projects.

__Further reading__:

- Daniel Lemire, [Fast Random Integer Generation in an Interval](https://arxiv.org/abs/1805.10941), ACM Transactions on Modeling and Computer Simulation (to appear)
- Google Tensorflow adopted this approach through a contribution by David Andersen (see the commit [Switching the presized cuckoo map from using strict mod](https://github.com/tensorflow/tensorflow/commit/a47a300185026fe7829990def9113bf3a5109fed) and [Google+ post](https://github.com/tensorflow/tensorflow/commit/a47a300185026fe7829990def9113bf3a5109fed)).
- What is arguably the best Open Source Chess engine, Stockfish, [also adopted this approach](https://github.com/official-stockfish/Stockfish/commit/2198cd0524574f0d9df8c0ec9aaf14ad8c94402b).
- The technique described in this blog post is in used within [Microsoft Arriba](https://github.com/Microsoft/elfie-arriba/blob/V5/V5/V5/Collections/HashSet5.cs).
- [math/rand: speed up Int31n with multiply/shift instead of modulo (golang issue 16213)](https://github.com/golang/go/issues/16213), [runtime: speed up fastrand() % n](https://github.com/golang/go/commit/46a75870ad5b9b9711e69ffce3738a3ab2057789) (golang commit)
- Agner Fog, [Pseudo-Random Number Generators for Vector Processors and Multicore Processors](http://orbit.dtu.dk/files/118886115/Fog_Pseudo_Random_Number_Generators.pdf), Journal of Modern Applied Statistical Methods, 2015.
- Kenneth A. Ross, Efficient Hash Probes on Modern Processors, IBM Research Report RC24100 (W0611-039) November 8, 2006


(Update: I have made the proof more intuitive following a comment by Kendall Willets.)

