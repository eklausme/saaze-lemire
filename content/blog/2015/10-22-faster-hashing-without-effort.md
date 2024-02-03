---
date: "2015-10-22 12:00:00"
title: "Faster hashing without effort"
---



Modern software spends much time hashing objects. There are many fancy hash functions that are super fast. However, without getting fancy, we can easily double the speed of commonly used hash functions.

Java conveniently provides fast hash functions in its Arrays class. The Java engineers like to use a simple polynomial hash function:
```C
for (int i = 0; i < len; i++) {
   h = 31 * h + val[i];
 }
```


That function is very fast. Unfortunately, as it is written, it is not optimally fast for long arrays. The problem comes from the multiplication. To hash _n_ elements, we need to execute _n_ multiplications, and each multiplication relies on the result from the previous iteration. This introduces a data dependency. If your processor takes 3 cycles to complete the multiplication, then it might be idle half the time. (The compiler might use a shift followed by an addition to simulate the multiplication, but the idea is the same.) To compensate for the latency problem, you might unloop the function as follows:
```C
for (; i + 3 < len; i += 4) {
   h = 31 * 31 * 31 * 31 * h
       + 31 * 31 * 31 * val[i]
       + 31 * 31 * val[i + 1]
       + 31 * val[i + 2]
       + val[i + 3];
}
for (; i < len; i++) {
   h = 31 * h + val[i];
}
```


This new function breaks the data dependency. The four multiplications from the first loop can be done together. In the worst case, your processor can issue the multiplications one after the other, but without waiting for the previous one to complete. What is even better is that it can enter the next loop even before all the multiplications have time to finish, and begin new multiplications that do not depend on the variable <em>h</em>. For better effect, you can extend this process to blocks of 8 values, instead of blocks of 4 values.

So how much faster is the result? To hash a 64-byte char array on my machine&hellip;

- the standard Java function takes 54 nanoseconds,
- the version processing blocks of 4 values takes 36 nanoseconds,
- and the version processing blocks of 8 values takes 32 nanoseconds.


So a little bit of easy unrolling almost doubles the execution speed for moderately long strings compared to the standard Java implementation.

You can check [my source code](https://github.com/lemire/microbenchmarks/blob/master/src/main/java/me/lemire/hashing/InterleavedHash.java).

__Further reading__:

- [Faster 64-bit universal hashing using carry-less multiplications](http://arxiv.org/abs/1503.03465), Journal of Cryptographic Engineering, 2015.
- [Strongly universal string hashing is fast](http://arxiv.org/abs/1202.4961), Computer Journal 57(11), 2014.


See also [Duff&rsquo;s device](https://en.wikipedia.org/wiki/Duff%27s_device) for an entertaining and slightly related hack.

