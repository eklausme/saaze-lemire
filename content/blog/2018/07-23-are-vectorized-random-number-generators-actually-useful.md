---
date: "2018-07-23 12:00:00"
title: "Are vectorized random number generators actually useful?"
---



Our processors benefit from &ldquo;SIMD&rdquo; instructions. These instructions can operate on several values at once, thus greatly accelerating some algorithms. [Earlier, I reported that you can multiply the speed of common (fast) random number generators such as PCG and xorshift128+ by a factor of three or four by vectorizing them using SIMD instructions](/lemire/blog/2018/06/07/vectorizing-random-number-generators-for-greater-speed-pcg-and-xorshift128-avx-512-edition/).

A reader challenged me: is this actually useful in practice?

There are problems where the generation of random number is critical to the performance. That is the case in many simulations, for example. The simplest and best known one is probably the random shuffling of arrays. The standard algorithm is quite simple:
```C
for (i = size; i > 1; i--) {
  var j = random_number(i);
  switch_values(array, i, j);
}
```


[If you are interested, O&rsquo;Neill wrote a whole blog post of this specific problem](http://www.pcg-random.org/posts/bounded-rands.html).

So can I accelerate the shuffling of an array using SIMD instructions?

So I threw together a vectorized shuffle and a regular (scalar) shuffle, both of them using O&rsquo;Neill&rsquo;s PCG32. The net result? I almost double the speed using SIMD instructions when the array is in cache:

SIMD shuffle             |3.5 cycles per entry     |
-------------------------|-------------------------|
scalar shuffle           |6.6 cycles per entry     |


[My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/07/23). I do not do anything sophisticated so I expect it is possible to do a lot better. My sole goal was to demonstrate that SIMD random number generators are practical.

