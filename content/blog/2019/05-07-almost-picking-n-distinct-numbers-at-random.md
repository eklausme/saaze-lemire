---
date: "2019-05-07 12:00:00"
title: "Almost picking N distinct numbers at random"
---



In [Picking N distinct numbers at random: how to do it fast?](/lemire/blog/2013/08/16/picking-n-distinct-numbers-at-random-how-to-do-it-fast/), I describe how to quickly pick N distinct integer values at random from a range of integer values. It comes down to using either bitset/bitmap or a hash set.

The bitset approach is very fast when you need to pick many integer values out of a small range. The hash set approach is very fast if you need to pick very few values, irrespective of the range of values.

What about the middle ground? What if you need to pick lots of integer values from an even greater range?

Because N is large, you may not care to get exactly N values. That is, if you need to pick 100 million integer values at random, it might be fine to pick 99,999,999 integer values.

What can you do?

1. Fill an array with N randomly generated integer values (using a uniform distribution).
1. Sort the array.
1. Remove duplicates.


That is pretty good, but the sort function could be expensive if N is large: it is O(N log N), after all.

Assuming that there are no duplicates, can we model this using probabilities? What is the distribution corresponding to the first value? We have N values picked out of a large range. So the probability that any value has been picked is N over the range. We recognize the [geometric distribution](https://en.wikipedia.org/wiki/Geometric_distribution). Once you have found the first value, you can repeat this same reasoning except that we now have N-1 values over a somewhat restricted range (because we generate them in sorted order).

1. Generate a value over the range R using a geometric distribution with probability N/R.
1. Append the value to my output array.
1. Reduce the range R with the constraint that all future values must be larger than the last value appended to the output array.
1. Decrement N by one.
1. Repeat until N is 0.


You can use the fact that we can cheaply generate numbers according to a geometric distribution:
```C
floor(log(random_number_in_0_1()) /log(1-p));
```


All you need is a way to generate random numbers in the unit interval [0,1] but that is easy. In C++ and many other programming languages, you have builtin support for geometric distributions.

The net result is an O(N) algorithm to pick N values at random over a range.

There is a catch, however. My model is not quite correct. For one thing, we do not quite have a geometric distribution: it is only valid if the range is very, very large. This manifests itself by the fact that the values I generate may exceed the range (a geometric distribution is unbounded). We can patch things up by stopping the algorithm once a value exceeds the range or some other anomaly occurs.

So I ran a benchmark where I have to pick 100,000,000 values among all integers smaller than 40,000,000,000. I get that the time per value generated is about half using the geometric-distribution approach:

sort-based               |170 ns                   |
-------------------------|-------------------------|
geometric                |80 ns                    |


For larger arrays, I can achieve 3x to 4x gains but then my software runs out of memory.

[My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/05/07).

What else could you do? Another practical approach would be to divide up the range into many small subranges and to use the fact that the number of values within each subrange follows a [binomial distribution](https://en.wikipedia.org/wiki/Binomial_distribution) (which can be approximated by a normal distribution), to do a divide-and-conquer approach: instead of having to pick many values in a large range problem, we would have several small &ldquo;pick few values into a small range&rdquo; problems. For each small problem, you can afford to do a sort-based approach since sorting small arrays is fast.

