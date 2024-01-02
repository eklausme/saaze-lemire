---
date: "2017-11-16 12:00:00"
title: "Fast exact integer divisions using floating-point operations"
---



On current processors, integer division is slow. If you need to compute many quotients or remainders, you can be in trouble. You potentially need divisions when programming a [circular buffer](https://en.wikipedia.org/wiki/Circular_buffer), a hash table, generating random numbers, shuffling data randomly, sampling from a set, and so forth. 

There are many tricks to avoid performance penalties:

- You can avoid dividing by an arbitrary integer and, instead, divide by a known power of two.
- You can use a divisor that is known to your compiler at compile-time. In these cases, most optimizing compilers will &ldquo;optimize away&rdquo; the division using magical algorithms that precompute a fast division routine.
- If you have a divisor that is not known at a compile time, but that you reuse often, you can make use of a library like [liddivide](https://github.com/ridiculousfish/libdivide) to precompute a fast division routine.
- You can reengineer your code to avoid needing a division in the first place, see my post [A fast alternative to the modulo reduction](/lemire/blog/2016/06/27/a-fast-alternative-to-the-modulo-reduction/).


But sometimes, you are really stuck and need those divisions. The divisor is not frequently reused, and you have lots of divisions to do.

If you have 64-bit integers, and you need those 64 bits, then you might be in a bit of trouble. Those long 64-bit integers have a terribly slow division on most processors, and there may not be a trivial way to avoid the price.

However, if you have a 32-bit integers, you might have a way out. Modern 64-bit processors have 64-bit floating-pointer numbers using IEEE standards. These 64-bit floating-point numbers can be used to represent exactly all integers in the interval [0,2<sup>53</sup>). That means that you can safely cast your 32-bit unsigned integers as 64-bit floating-point numbers.

Furthermore, common x64 processors have fast floating-point divisions. And the division operation over floating-point numbers is certain to result in the closest number that the standard can represent. The division of an integer in [0,2<sup>32</sup>) by an integer in [1,2<sup>32</sup>) is sure to be in [0,2<sup>32</sup>). This means that you can almost replace the 32-bit integer division by a 64-bit floating point division:
```C
uint32_t divide(uint32_t a, uint32_t b) {
  double da = (double) a;
  double db = (double) b;
  double q = da/db;
  return (uint32_t) q;
}
```


Sadly, if you try to divide by zero, you will not get a runtime error, but rather some nonsensical result. Still, if you can be trusted to not divide by zero, this provides a fast and exact integer division routine. 

How much faster is it? [I wrote a small program to measure the throughput](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2017/11/16):

64-bit integer division  |25 cycles                |
-------------------------|-------------------------|
32-bit integer division (compile-time constant) |2+ cycles                |
32-bit integer division  |8 cycles                 |
32-bit integer division via 64-bit float |4 cycles                 |


These numbers are rough, but we can estimate that we double the throughput.

I am not entirely sure why compilers fail to exploit this trick. Of course, they would need to handle the division by zero, but that does not seem like a significant barrier. There is also another downside to the floating-point approach: it generates many more instructions.

Regarding signed integers, they work much the same, but you need extra care. For example, most processors rely on two&rsquo;s complement notation which implies that you have one negative number that cannot be represented as a positive number. Thus implementing &ldquo;x / (-1)&rdquo; can cause some headaches. You probably do not want to divide signed integers anyhow.

I plan to come back to the scenario where you have lots of 64-bit integer divisions with a dynamic divisor. 

This result is for current Intel x64 processors, [what happens on ARM processors is quite different](/lemire/blog/2017/11/17/fast-exact-integer-divisions-using-floating-point-operations-arm-edition/).

