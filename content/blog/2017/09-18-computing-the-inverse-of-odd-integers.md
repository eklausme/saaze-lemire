---
date: "2017-09-18 12:00:00"
title: "Computing the inverse of odd integers"
---



Given <tt>x</tt>, its (multiplicative) inverse is another value `y` such that <tt>x<tt>*</tt>y = y<tt>*</tt>x = 1</tt>. We all know that the multiplicative inverse of `x` is <tt>1/x</tt> and it exists as long as `x` is non-zero. That&rsquo;s for real numbers, or at least, rational numbers.

But the idea of a multiplicative inverse is more general.

It certainly fails integers in general. I.e., there is no integer `x` such that <tt> 2 x </tt> is 1. But, maybe surprisingly, all odd integers have an inverse if you use normal computer arithmetic. Indeed, when your processor computes <tt>x<tt>*</tt>y</tt>, then it actually outputs <tt>x<tt>*</tt>y modulo 2<sup>32</sup></tt> or <tt>x<tt>*</tt>y modulo 2<sup>64</sup></tt> depending on whether you use 32-bit or 64-bit instructions. (The value <tt>x<tt>*</tt>y modulo 2<sup>64</sup></tt> can be defined as the remainder of the division of <tt>x<tt>*</tt>y</tt> by <tt>2<sup>64</sup></tt>.)

Let me briefly explain why there must be an inverse. You can skip this part if you want. Take any odd integer <tt>x</tt>. Because `x` is odd, then it is not divisible by 2. In fact, that&rsquo;s what it means to be odd. But this also means that powers of `x` will also be odd. E.g., <tt>x<sup>k</sup></tt> is also odd for any integer <tt>k</tt>. Ok. So <tt>x<sup>k</sup> modulo 2<sup>64</sup></tt> is never going to be zero. The only way it could be zero is if x<sup>k</sup> were divisible by 2<sup>64</sup>, but that&rsquo;s impossible because it is an odd value. At the same time, we only have a finite number of distinct odd values smaller than 2<sup>64</sup>. So it must be the case that <tt>x<sup>k</sup> modulo 2<sup>64</sup> = <tt>x<sup>k'</sup> modulo 2<sup>64</sup></tt></tt> for some pair of powers `k` and <tt>k'</tt>. Assume without loss of generality that `k` is larger than <tt>k'</tt>. Then we have that <tt>x<sup>k-k'</sup> modulo 2<sup>64</sup> = 1 modulo 2<sup>64</sup></tt> (I am not proving this last step, but you can figure it out from the previous one). And thus it follows that <tt>x<sup>k-k'-1</sup></tt> is the inverse of <tt>x</tt>. If you did not follow this sketch of a proof, don&rsquo;t worry.

So how do you find this inverse? You can brute force it, which works well for 32-bit values, but not so well for 64-bit values.

Wikipedia has a page on this, entitled [modular multiplicative inverses](https://en.wikipedia.org/wiki/Modular_multiplicative_inverse). [It points to an Euclidean algorithm that appears to rely on repeated divisions](https://en.wikipedia.org/wiki/Extended_Euclidean_algorithm#Computing_multiplicative_inverses_in_modular_structures).

Thankfully, you can solve for the inverse efficiently using very little code.

One approach is based on &ldquo;Newton&rsquo;s method&rdquo;. That is, we start with a guess and from the guess, we get a better one, and so forth, until we naturally converge to the right value. So we need some formula <tt>f(y)</tt>, so that we can repeatedly call <tt>y = f(y)</tt> until `y` converges.

A useful recurrence formula is <tt>f(y) = y (2 - y <tt>* </tt>x) modulo 2<sup>64</sup></tt>. You can verify that if <tt> y </tt> is the 64-bit inverse of <tt>x</tt>, then this will output <tt>y</tt>. So the formula passes a basic sanity test. But would calling <tt>y = f(y)</tt> repeatedly converge to the inverse?

Suppose that <tt> y </tt> is not quite the inverse, suppose that <tt> x*y = 1 + z * 2<sup>N</sup></tt> for some `z` and some `N` that is smaller than 64. So `y` is the inverse &ldquo;for the first `N` bits&rdquo; (where &ldquo;first&rdquo; means &ldquo;least significant&rdquo;). That is, <tt> x <tt>* </tt>y modulo 2<sup>N</sup> = 1</tt>.

It is easy to find such a `y` for `N` greater than zero. Indeed, let <tt>y = 1</tt>, then <tt> x <tt>* </tt>y = 1 + z <tt>* </tt>2<sup>1</sup></tt>.

Ok, so substituting <tt> x<tt>*</tt>y = 1 + z <tt>* </tt>2<sup>N</sup></tt> in <tt>y<tt>*</tt>(2 - y <tt>* </tt>x ) modulo 2<sup>64</sup></tt>, we get <tt>y <tt>* </tt>(2 - ( 1 + z<tt>*</tt>2<sup>N</sup>) ) modulo 2<sup>64 </sup></tt>or <tt>y <tt>* </tt>( 1 - z <tt>* </tt>2<sup>N</sup> ) modulo 2<sup>64</sup></tt>. So I set <tt> y' = f(y) = y<tt>*</tt>(1 - z<tt>*</tt>2<sup>N</sup> ) modulo 2<sup>64</sup></tt>. What is <tt>x <tt>* </tt>y'</tt>? It is <tt> ( 1 + z <tt>* </tt>2<sup>N</sup> ) (1 - z <tt>* </tt>2<sup>N</sup> ) modulo 2<sup>64 </sup></tt>or <tt> ( 1 - z<sup>2</sup> * 2<sup>2 N</sup> ) modulo 2<sup>64</sup></tt>.

That is, if `y` was the inverse &ldquo;for the first `N` bits&rdquo;, then <tt>y' = f(y)</tt> is the inverse &ldquo;for the first <tt>2 N</tt> bits&rdquo;. In some sense, I double my precision each time I call the recurrence formula. This is great! This means that I will quickly converge to the inverse.

Can we do better, as an initial guess, than <tt>y = 1</tt>? Yes. We can start with a very interesting observation: if we use 3-bit words, instead of 32-bit or 64-bit words, then every number is its own inverse. E.g., you can check that <tt>3*3 modulo 8 = 1</tt>. Marc Reynolds points that you can get 4 bits of accuracy by starting out with <tt>x * x + x - 1</tt>. Brian Kessler points out that you can do even better: <tt>( 3 * x ) XOR 2</tt> provides 5 bits of accuracy.

So a good initial guess is <tt>y = <tt>( 3 * x ) XOR 2</tt></tt>, and that already buys us 5 bits. The first call to the recurrence formula gives me 10 bits, then 20 bits for the second call, then 40 bits, then 80 bits. So, we need to call our recurrence formula 2 times for 16-bit values, 3 times for 32-bit values and 4 times for 64-bit values. I could actually go to 128-bit values by calling the recurrence formula 5 times.

Here is the code to compute the inverse of a 64-bit integer:
```C
uint64_t f64(uint64_t x, uint64_t y) {
  return y * (2 - y * x);
}

uint64_t findInverse64(uint64_t x) {
  uint64_t y = (3 * x) ^ 2; // 5 bits
  y = f64(x, y); // 10 bits
  y = f64(x, y); // 20 bits
  y = f64(x, y); // 40 bits
  y = f64(x, y); // 80 bits
  return y;
}
```


<br/>
[I wrote a complete command-line program that can invert any odd number quickly](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2017/09/18/inverse.c).

Each call to the recurrence formula should consume about 5 CPU cycles so that the whole function should take no more than 25 cycles or no more than the cost of a single integer division. Actually, it might be cheaper than a single integer division.

Because of the way we construct the inverse, if you somehow knew the 32-bit inverse, you could call the recurrence formula just once to get the 64-bit inverse.

How did we arrive at this formula (<tt> y ( 2 - y <tt>* </tt>x ) </tt>)? <a href="https://en.wikipedia.org/wiki/Multiplicative_inverse">It is actually a straight-forward application of Newton&rsquo;s method as one would apply it to finding the zero of <tt>g(y) = 1/y - x</tt></a>. So there is no magic involved.

My code seems to assume that I am working with unsigned integers, but the same algorithm works with signed integers, and in binary form, it will provide the same results.

__Reference and further reading__:

- Granlund and Montgomery, SIGPLAN Not. (1994).
- [On Newton-Raphson iteration for multiplicative inverses modulo prime powers](https://arxiv.org/pdf/1209.6626v2.pdf) by Dumas (2012).
- Jeff Hurchalla wrote a paper on it: [Speeding up the Integer Multicative Inverse](https://arxiv.org/abs/2204.04342).


__Credit__: Marc Reynolds asked on Twitter for an informal reference on computing the multiplicative inverse modulo a power of two. It motivated me to write this blog post. [He finally wrote a decent article on the subject with many interesting remarks](http://marc-b-reynolds.github.io/math/2017/09/18/ModInverse.html).

