---
date: "2023-05-26 12:00:00"
title: "Expected performance of a Bloom filter"
---



A hash function is a function that maps a value (such as a string) to an integer value. Typically, we want random-looking values.

A <a href="https://en.wikipedia.org/wiki/Bloom_filter"><em>Bloom filter</em></a> is a standard data structure in computer science to approximate a set. Basically, you start with a large array of bits, all initialized at zero. Each time you want to add an element to the set, you compute _k_ different hash values and you set the bits at the _k_ corresponding locations to one.

A fun application of a Bloom filter is a [compromised password application](https://github.com/FastFilter/FilterPassword): given a large set of passwords, you want a concise data structure that indicates whether a password belongs to the set.

To check whether an element is in the set, you compute, again, _k_ different hash values and you check the bits at the corresponding _k_ locations. If the value is in the set, then all k bits have to have value 1. If not, then you know for sure that the value is not in the set.

The way we naturally implement a Bloom filter is through a loop, where we check for each bit value in the sequence, stopping as soon as a 0 bit is found.

Unfortunately, it is possible for the Bloom filter to be wrong: all the _k_ bits could be 1s out of luck. If that happens, you have a false positive. The false positives are often not a problem in practice because you can prune them out with a secondary application. For example, if you want to make sure that the password has been compromised, you may simply look it up in a conventional database. The Bloom filter will still handle most cases.

By spending about 12 bits per value (12 bits time the size of the set) and using 8 hash functions, the probability of a false positive is about 1/256 (or 0.3%) which is reasonable.

If you know a bit about software performance, the 8 bits could be concerning. Looking up 8 values at random location in memory is not cheap. And, indeed, when the element is in the set, you must check all 8 locations. It is expensive.

What if the value is not in the set, however? If your Bloom filter is configured optimally, for the lowest false-positive rate given a storage budget per element, about 50% of all bits in the array of bits are 1s.

How many random bits must we access before we find a 0 in such a case? We stop after one bit 1/2 the time, then a quarter of the time after two bits, and so forth. So the expected value is 1/2 + 1/4*2 + 1/8*3 + 1/16 *4 +&hellip; which tends towards 2. The answer does not depend much on the number of hash functions <em>k</em>.

This means that if you are using a Bloom filter in a scenario where the values are likely not in the set, you can get away with very few memory accesses.

Of course, the processor is not going to naively load each bit one by one. It will do speculative loads. Thankfully, we can use performance counters to measure the actual number of loads.

Another concern for programmers who are interested in performance is the number of mispredicted branches. Interestingly, the relationship is reversed: if your elements are not in the set, then you face unpredictable branches (so a bad performance) but if they are in the set, then the branches are perfectly predictable.

Let us consider the performance metrics of the Bloom filter when we have a false positive (miss) and an actual positive (hit). I use an Intel Ice Lake server with a filter that exceeds the CPU cache, and I record CPU performance counters.

number of hash functions |bits per values          |cache misses per miss    |cache misses per hit     |mispredict per miss      |mispredict per hit       |
-------------------------|-------------------------|-------------------------|-------------------------|-------------------------|-------------------------|
8                        |12                       |3.5                      |7.5                      |0.95                     |0.0                      |
11                       |16                       |3.8                      |10.5                     |0.95                     |0.0                      |


For the misprediction tests, I use either the regime where all values are in the sets, or no value is in the set.

What is the performance of both hits and misses? We find that the performance of a miss does not depend too much on the number of hash functions, as you would expect. The cost of a hit grows roughly in proportion of the number of hash functions, as you would expect.

number of hash functions |bits per values          |cycles/miss              |cycles/hit               |
-------------------------|-------------------------|-------------------------|-------------------------|
8                        |12                       |135                      |170                      |
11                       |16                       |140                      |230                      |


You can reproduce my results with the [fastfilter_cpp](https://github.com/FastFilter/fastfilter_cpp).

Let us now consider, for the same problem size, binary fuse filters ([Go implementation](https://github.com/FastFilter/xorfilter), [C single-header implementation](https://github.com/FastFilter/xor_singleheader), [Rust implementation](https://github.com/prataprc/xorfilter), [zig implementation](https://github.com/hexops/fastfilter), [Julia implementation](https://github.com/JokingHero/FastFilter.jl)). They use a slightly different approach (see [paper](https://arxiv.org/abs/2201.01174)): we can either use a flat 3 accesses per value or a flat 4 accesses per value.

&nbsp;                   |cache misses per value   |mispredict per value     |
-------------------------|-------------------------|-------------------------|
3-wise binary fuse       |2.8                      |0.0                      |
4-wise binary fuse       |3.7                      |0.0                      |


So the 4-wise filters has about as many cache misses as the Bloom filter. Yet they are significantly faster than Bloom filters.

&nbsp;                   |cycles per access        |
-------------------------|-------------------------|
3-wise binary fuse       |85                       |
4-wise binary fuse       |100                      |


