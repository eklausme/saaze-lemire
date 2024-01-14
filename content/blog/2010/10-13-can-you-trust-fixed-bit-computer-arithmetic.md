---
date: "2010-10-13 12:00:00"
title: "Can you trust fixed-bit computer arithmetic?"
---



Suppose that you have 10 pictures, and all lined up, they take 100 pixels. Is it safe to say that each picture has a width of _x_ pixels if 10&nbsp;<em>x</em> = 100?

We all know that <em>a x</em> = _b_ has a __unique__ solution _x_ as long as _a_ is non-zero. If you work with integers, then you can say that there is __at most one solution__.

Unfortunately, computer arithmetic is uglier. Over 32-bit integers, the equation <em>a x</em>= 0 has 2<sup>31</sup> solutions if _a_ = 2<sup>31</sup>. Indeed, as long as _x_ is even, 2<sup>31</sup> _x_ = 0.

But notice how I had to choose a large value of _a_ to make computer arithmetic look bad. What if _a_ is small? Certainly, if _a_ = 1, then there is exactly one solution. If _a_ = 2, then there are at most two solutions: 2 _x_ can take any odd even and the most significant bit of _x_ is discarded.

We can generalize this result a bit: if _a_ = 2<sup><em>L</em></sup>, then there are at most 2<sup><em>L</em></sup> solutions <em>x</em>.

But we can generalize it even further! We have that <em>a x</em> = _b_ has at most 2<sup><em>L</em></sup> integer solutions _x_ if _a_ is an <em>L</em>-bit non-zero integer. That is, __as long as__ <em>__a__</em>__ is small, then__ <em>__a x__</em>__ =__ <em>__b__</em>__ has few solutions__. The proof is technical, but not difficult:

> Proof (Sketch). Let _a_ is an <em>L</em>-bit non-zero integer and suppose we work with <em>K</em>-bit arithmetic. We consider the equation <em> a x </em> div 2<sup><em>L</em></sup> = _b_ modulo 2<sup><em>K &#8211; L</em></sup>. Let _j_ be the first non-zero bit of a. E.g., if <em>a </em>= 7 then _j_ = 1. Because <em>a<sub>i</sub></em> = 0 for <em>i &lt; j</em>, we have that the value of <em>a x </em> 2<sup><em>L</em></sup> is independent of the last _j_ -1 bits of <em>x</em>. Moreover, we have that the most significant bit of _x_ which matters (<em>x<sub>K-j<span style="font-style: normal;">+1</span></sub></em>) only matters for the last bit of <em>a x</em>. We can solve for this last effectual bit <em>x<sub>K-j<span style="font-style: normal;">+1</span></sub></em> in <em>(ax)<sub>K</sub></em> = <em>b<sub>K-L</sub></em> as a function of <em>b<sub>K-L</sub></em>, _a_ and the lesser bits of <em>x</em>. We can continue solving for the lesser bits of _x_ by consider <em>a x</em> = _b_ minus the last bit. (In effect, we have reduced the problem in an integer ring with <em>K</em>&nbsp;bits to a similar problem in integer ring with <em>K</em>-1&nbsp;bits.) After <em>K-L</em>&nbsp;steps, the process terminates (<em>K=L</em>) leaving <em>L</em>&nbsp;bits in _x_ that can be set freely generating 2<sup><em>L</em></sup>&nbsp;different solutions. QED


__Getting back to our orignal problem:__ Because the integer 10 can be written using 4 bits (0b1010), the equation 10 _x_ = 100 has at most 2<sup>4</sup> = 16 solutions. So if _x_ was just picked at random, chances are good that the assertion would fail: for 32-bit integers, the probability of a false positive is at most 15/2<sup>32</sup> which is much, much less than 1%.

__Further reading__: M. Dietzfelbinger, Universal hashing and <em>k</em>-wise independent random variables via integer arithmetic without primes, in: STACS&rsquo;96, 1996.

