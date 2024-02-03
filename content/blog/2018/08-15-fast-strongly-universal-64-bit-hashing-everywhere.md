---
date: "2018-08-15 12:00:00"
title: "Fast strongly universal 64-bit hashing everywhere!"
---



In software, hashing is the process of taking a value and mapping it to a random-looking value. Suppose you are given 64-bit integers (a `long` in Java). You might want to &ldquo;hash&rdquo; these integers to other 64-bit values.

There are many good ways to achieve this result, but let me add some constraints:

1. The hashing should be strongly universal, also called pairwise independent. This means that if `h` is a hash function picked at random, then you want the knowledge that <tt>h(x)=y</tt> for some x and some y, to give you absolutely no information about the value of <tt>h(x')</tt> for <tt>x'</tt> distinct from <tt>x</tt>. That&rsquo;s not, as it appears, a security/cryptography issue, but more of a useful constraint for probabilistic algorithms. Indeed, there are many &ldquo;probabilistic&rdquo; algorithms that require different, and &ldquo;independent&rdquo;, hash functions. You want to be absolutely sure that your hash functions are unrelated. Strong universality is not perfect independence, but it is pretty good in practice.
1. You don&rsquo;t want to have large look-up tables occupying your cache.
1. You want to code that works efficiently in most programming languages (including, say, Java).


My proposal is as follows. Instead of trying to hash the 64-bit values to other 64-bit values directly, we can hash them to 32-bit values. If you repeat twice (using two different hash functions), you get the 64-bit result you seek. All that is needed per hash function are three 64-bit values chosen at random, and then two multiplications, two additions and a single shift. The two multiplications are faster than they appear because they can be executed simultaneously as there is no data dependency. Two get a full 64-bit output, you thus need four multiplications.
```C
// in Java, long is 64-bit, int 32-bit

long a,b,c; // randomly assigned 64-bit values

int hash32(long x) {
  int low = (int)x;
  int high = (int)(x >>> 32);
  return (int)((a * low + b * high + c) >>> 32);
}
```


How fast is it? We can try to compare it against a standard bit-mixing function:
```C
long murmur64(long h) {
  h ^= h >>> 33;
  h *= 0xff51afd7ed558ccdL;
  h ^= h >>> 33;
  h *= 0xc4ceb9fe1a85ec53L;
  h ^= h >>> 33;
  return h;
}
```


This bit-mixing function is &ldquo;obviously&rdquo; faster. It has half the number of multiplications, and none of the additions. However, in my tests, the difference is less than you might expect (only about 50%). Moreover if you do need two 32-bit hash values, the 64-bit mixing function loses much of its edge and is only about 25% faster.

[My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/08/15) so you can run your own Java benchmark.

How do I know that this hashing function is, indeed, strongly universal? We wrote a paper about it: [Strongly universal string hashing is fast](https://arxiv.org/abs/1202.4961). At the time, we were interested in hashing strings. The trick is to view a 64-bit word as a string of two 32-bit words. We could extend the same trick to 128-bit inputs or, indeed, inputs of any length.

