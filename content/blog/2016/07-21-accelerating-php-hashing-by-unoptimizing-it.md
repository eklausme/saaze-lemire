---
date: "2016-07-21 12:00:00"
title: "Accelerating PHP hashing by &#8220;unoptimizing&#8221; it"
---



Hashing is a software trick that can map strings to fixed-length integers, such as 32-bit integers. It is ubiquitous in modern software.

Languages like Java and PHP have the ability to store strings with their corresponding hash values. Still, the hash value must be computed at least once.

How much of a burden can this be? Suppose that we use 10 cycles per byte to hash a string. For a long 100-kilobyte string, that would be about a million CPU cycles. If your CPU runs at 2 GHz, you have 2 billion cycles per second. Hence, hashing your string should take no more than half a millisecond. Put another way, you can hash 2000 such strings per second.

Simon Hardy-Francis pointed out to me that this can still represent a performance bottleneck if your PHP application needs to repeatedly load large new strings.

So what does PHP use as a hash function? It uses fundamentally the Java hash function, a simple polynomial hash with an odd multiplier&hellip; (coprime with 2)
```C
for (int i = 0; i < len; i++) {
  hash = 33 * hash + str[i];
}
```


(Java multiplies by 31 instead of 33 but it is the same idea.)

A polynomial hash function with an odd multiplier is found everywhere and has a long history. It is the hash function used by the [Karp-Rabin string search algorithm](https://en.wikipedia.org/wiki/Rabin%E2%80%93Karp_algorithm).

As I have pointed out in [another post](/lemire/blog/2015/10/22/faster-hashing-without-effort/), for better performance, you want to unroll this function like so&hellip;
```C
for (; i + 3 < len; i += 4) {
   h = 33 * 33 * 33 * 33 * h 
       + 33 * 33 * 33 * str[i] 
       + 33 * 33 * str[i + 1] 
       + 33 * str[i + 2] 
       + str[i + 3];
}
for (; i < len; i++) {
   h = 33 * h + str[i];
}
```


The reason this might help might be that it breaks the data dependency: instead of having to wait for the previous multiplication to finish before another one can be issued, you can issue one new multiplication per cycle for up to four cycles in a row. Unrolling more might accelerating the code further.

The PHP developers implement the hash function with an extra optimization, however. Crediting Bernstein for the idea, they point out that&hellip;

> the multiply operation can be replaced by a faster operation based on just one shift plus either a single addition or subtraction operation


It is true that a shift followed by an addition might be slightly cheaper than a multiplication, but modern compilers are quite good at working this out on their own. They can transform your multiplications by a constant as they see fit.

In any case, so the PHP implementation is an [optimized version](https://github.com/php/php-src/blob/PHP-7.1/Zend/zend_string.h#L325) of the following&hellip;
```C
for (int i = 0; i < len; i++) {
  hash = ((hash << 5) + hash) + str[i];
}
```


The code is actually quite a bit more complicated because it is heavily unrolled, but it is algorithmically equivalent. Their code strongly discourages the compiler from ever using a multiplication.

So are the PHP developers correct? Should we work hard to avoid multiplications in C using Bernstein&rsquo;s trick? Let us put this theory to the test on a recent x64 processor. As usual, [my code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2016/07/21/simplehashing.c).

<td colspan="2">Polynomial hashing (cycles per byte) on Intel Skylake |

PHP (no multiplier)      |PHP (with multiplier)    |
2.35                     |1.75                     |


The multiplication-free PHP approach is 33% slower! Gregory Pakosz pointed out that you can do even better by[ unrolling the version with multiplier further](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2016/07/21/gpakosz/simplehashing.c), reaching 1.5 cycles per byte.

Embedded processors with slow multiplications might give different outcomes. But then, where do you expect PHP processes to run? Overwhelmingly, they run on Intel processors produced in the last ten years&hellip; and these processors have fast multipliers.

So I think that the PHP developers are leaving performance on the table. They could easily optimize the computation of the hash function without changing the result of the function. What is more, the code would be more readable if they left the multiplications! If you need to multiply by 33, just do it the simplest possible manner! If it is cheaper to do a shift, the compiler can probably figure it out before you do. If you do not trust your compiler, then, at least, run benchmarks!

Let us look at the larger issue. How fast are 1.5 or 1.75 cycles per byte? Not very fast. Google&rsquo;s CityHash uses about 0.25 cycles per byte whereas [the state-of-the-art CLHash](/lemire/blog/2015/12/24/your-software-should-follow-your-hardware-the-clhash-example/) uses about 0.1 cycles per byte on recent Intel processors. So with a more modern algorithm, PHP developers could multiply the speed of their hash functions&hellip; but that&rsquo;s for another day.

__Further reading__: This was merged into PHP via a commit called [Improve PHP hash function](https://github.com/php/php-src/commit/90e285f6fda679c18259e459c8585ebf284805b0) thanks to [Sebastian Pop](https://github.com/php/php-src/pull/4126).

