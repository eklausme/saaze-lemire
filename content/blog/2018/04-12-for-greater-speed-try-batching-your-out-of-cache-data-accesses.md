---
date: "2018-04-12 12:00:00"
title: "For greater speed, try batching your out-of-cache data accesses"
---



In software, we use hash tables to implement sets and maps. A hash table works by first mapping a key to a random-looking address in an array.

In a recent series of blog posts ([1](/lemire/blog/2018/03/28/when-accessing-hash-tables-how-much-time-is-spent-computing-the-hash-functions/), [2](/lemire/blog/2018/03/29/should-you-cache-hash-values-even-for-trivial-classes/), [3](/lemire/blog/2018/04/04/caching-hash-values-for-speed-swift-language-edition/)), I have documented the fact that precomputing the hash values often accelerates hash tables.

Some people thought that I was merely making the trivial point that precomputing the hash values saved you the time to compute the hash values. That is true, but there is more to it.

On recent Intel processors, batching your load requests can be very helpful. Let me illustrate with some code.

I am going to use a simple hash function that takes integer values and return &ldquo;mixed up&rdquo; values:
```C
uint32_t murmur32(uint32_t h) {
  h ^= h >> 16;
  h *= UINT32_C(0x85ebca6b);
  h ^= h >> 13;
  h *= UINT32_C(0xc2b2ae35);
  h ^= h >> 16;
  return h;
}
```


This function is not very expensive, but it is efficient at generating random-looking outputs.

In a complete loop, it takes between 7 and 8 cycles to compute and store a bunch of these hash values (modulo the array size) using a recent Intel processor.

Let us put this function to good use to randomly go pick up values in a large array and sum them up:
```C
uint64_t sumrandom(uint64_t *values, size_t size) {
  uint64_t sum = 0;
  for (size_t k = 0; k < size; ++k) {
    sum += values[murmur32(k) % size ];
  }
  return sum;
}
```


You expect that the bulk of the time needed to execute this code would have to do with data accesses (given a large array). And indeed, for arrays exceeding my cache, it takes about 46 cycles per value to compute the sum.

So it means that about 40 cycles are due to the random look-up of the values.

Is that right?

Let us do something more complicated, where we first compute the hash values and then we do the look-ups&hellip;
```C
uint64_t sumrandomandindexes(uint64_t *values, uint32_t *indexes, size_t size) {
  uint64_t sum = 0;
  for (size_t k = 0; k < size; ++k) {
    indexes[k] = murmur32(k) % size ;
  }
  for (size_t k = 0; k < size; ++k) {
    sum += values[indexes[k]];
  }
  return sum;
}
```


This looks more expensive, but it is not. It runs in about 32 cycles per operation. That is, separating the task into two separate tasks, and doing overall more stores and loads, is significantly cheaper. It should not make sense, but the result is robust. (Note that simply unrolling the loop a few times might serve us well, I used an extreme example to make my point.)

operation                |cost                     |
-------------------------|-------------------------|
hash function            |~8 cycles per value      |
sum over random values   |~46 cycles               |
hash function followed by sum |~32 cycles               |


[My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/04/12). I used GNU GCC compiler 6.0 as it gives the best results on this test.

So what is happening? When I use the Linux `perf` command to count the number of cache misses (<tt>perf stat -B -e cache-misses</tt>), I find that the approach the computes the hash values separately from the data loads has about 50% fewer cache misses.

Thus Intel processors have an easier time avoiding cache misses when the data loads are batched.

I have not verified how other processors fare. Do you know?

