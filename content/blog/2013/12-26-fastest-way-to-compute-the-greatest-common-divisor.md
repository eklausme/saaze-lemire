---
date: "2013-12-26 12:00:00"
title: "Fastest way to compute the greatest common divisor"
---



Given two positive integers _x_ and <em>y</em>, the [greatest common divisor](https://en.wikipedia.org/wiki/Greatest_common_divisor) (GCD) _z_ is the largest number that divides both _x_ and <em>y</em>. For example, given 64 and 32, the greatest common divisor is 32.

There is a fast technique to compute the GCD called the [binary GCD algorithm](https://en.wikipedia.org/wiki/Binary_GCD_algorithm) or Stein&rsquo;s algorithm. [According to Wikipedia](https://en.wikipedia.org/wiki/Binary_GCD_algorithm#Efficiency), it is 60% faster than more common ways to compute the GCD.

I have honestly never written a program where computing the GCD was the bottleneck. However, [Pigeon wrote a blog post](https://hbfs.wordpress.com/2013/12/10/the-speed-of-gcd/) where the binary GCD fared very poorly compared to a simple implementation of [Euler&rsquo;s algorithm](https://en.wikipedia.org/wiki/Euclidean_algorithm) with remainders:
```C
unsigned gcd_recursive(unsigned a, unsigned b)
{
    if (b)
        return gcd_recursive(b, a % b);
    else
        return a;
}
```


Though Pigeon is a great hacker, I wanted to verify for myself. It seems important to know whether an algorithm that has its own wikipedia page is worth it. Unfortunately, the code on Wikipedia&rsquo;s page implementing the [binary GCD algorithm](https://en.wikipedia.org/wiki/Binary_GCD_algorithm) is either inefficient or slightly wrong. Here is a version using a GCC intrinsic function (<tt>__builtin_ctz</tt>) to find the <em>number of trailing zeros</em>:
```C
unsigned int gcd(unsigned int u, unsigned int v) {
  int shift;
  if (u == 0)
    return v;
  if (v == 0)
    return u;
  shift = __builtin_ctz(u | v);
  u >>= __builtin_ctz(u);
  do {
    unsigned m;
    v >>= __builtin_ctz(v);
    v -= u;
    m = (int)v >> 31;
    u += v & m;
    v = (v + m) ^ m;
  } while (v != 0);
  return u << shift;
}
```


My result? Using integers in [0,2000), the simple version Pigeon proposed does 25 millions GCDs per second, whereas my binary GCD does 39 millions GCDs per second, a difference of 55% on an Intel core i7 desktop. Why do my results disagree with Pigeon? His version of the binary GCD did not make use of the intrinsic `__builtin_ctz` and used an equivalent loop instead. When I implemented something similarly inefficient, I also got a slower result (17 millions GCDs per second) which corroborates Pigeon&rsquo;s finding.

[My benchmarking code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2013/12/26/gcd.cpp).

On a 64-bit machine, you probably can adapt this technique using the `__builtin_ctzll` intrinsic.

__Update__: You can read more about [sophisticated GCD algorithms](https://gmplib.org/manual/Greatest-Common-Divisor-Algorithms.html) in the gmplib manual.

__Conclusion__: The Binary GCD is indeed a faster way to compute the GCD for 32-bit integers, but only if you use the right instructions (e.g., <tt>__builtin_ctz</tt>). And someone [ought to update the corresponding Wikipedia page](https://en.wikipedia.org/wiki/Binary_GCD_algorithm).

