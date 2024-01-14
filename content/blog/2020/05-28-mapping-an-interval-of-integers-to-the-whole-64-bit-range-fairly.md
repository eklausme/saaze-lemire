---
date: "2020-05-28 12:00:00"
title: "Mapping an interval of integers to the whole 64-bit range, fairly?"
---



In my blog post [A fast alternative to the modulo reduction](/lemire/blog/2016/06/27/a-fast-alternative-to-the-modulo-reduction/), I described how one might map 64-bit values to an interval of integers (say from 0 to N) with minimal bias and without using an expensive division. All one needs to do is to compute x * N ÷ 2<sup>64</sup> where &lsquo;÷&rsquo; is the integer division. A division by a power of two is just a shift. Such an approach is simple and efficient.

Let us consider the opposite problem.

Suppose that I give you integers in the range from 0 (inclusively) to some value N (exclusively). We want to map these values to integers spanning the whole 64-bit range. Obviously, since we only have N distinct values to start with, we cannot expect our function to cover all possible 64-bit values. Nevertheless, we would like to be &ldquo;as fair as possible&rdquo;. Let us use only integers.

Let 2<sup>64</sup> ÷ N be the integer division of 2<sup>64</sup>  by N. Let 2<sup>64</sup> % N be the remainder of the integer division. Because N is a constant, these are constants as well.

As a first attempt, I might try to map integer x using the function (2<sup>64</sup> ÷ N) * x. It works beautifully when N is a power of two, but, in general, it is a tad crude. In particular, the result of this multiplication can never exceed N &#8211; (2<sup>64</sup> % N) whereas it starts at value 0 when x is 0 so it is biased toward smaller values when (2<sup>64</sup> % N) is non-zero (which is always true when N is not a power of two).

Let 2<sup>64</sup> % N be the remainder of the integer division. To compensate, we need to add a value that can up to 2<sup>64</sup> % N. Mapping integers in the interval from 0 to N to integers in the interval from 0 to 2<sup>64</sup> % N cannot be done with a simple multiplication. We do not want to use divisions in general because they are expensive. However, we can use a shift, that is, a division by a power of two. So let us look for a map of the form (2<sup>64</sup> ÷ N) * x + (u * x)÷2<sup>64</sup>  for some unknown value u. We know that x can never exceed N, but that when x reaches N, the value of (u * x)÷2<sup>64</sup> should be close to 2<sup>64</sup> % N. So we set (u * N)÷2<sup>64 </sup> to 2<sup>64</sup> % N and solve for u, which gives us that u must be at least (2<sup>64</sup> % N) * 2<sup>64</sup> ÷ N.

The values (2<sup>64</sup> ÷ N) and (2<sup>64</sup> % N) * 2<sup>64</sup> ÷ N need to computed just once: let us call them m and n respectively. We finally get the function m * x + (n * x)÷2<sup>64</sup>. In Python, the code might look as follows&hellip;
```C
def high(x,y):
    return (x*y >> 64) % 2**64

def inv(x):
   n = ((2**64) % N)*2**64 // N
   m = 2**64 // N
   return m*(x+1) + high(x,n)
```


How good is this formula? To test it out, I can test how well it can invert the approach that goes in the other direction. That is, if I plug x * N ÷ 2<sup>64</sup>, I would hope to get back x, or something very close for suitable values of N. That is, I want m * x * N ÷ 2<sup>64</sup> + (n * x * N ÷ 2<sup>64</sup>)÷2<sup>64</sup> to be almost x. In general, I cannot hope to find x exactly because some information was lost in the process. Yet I expect to have a lower bound on the error of ceil(2<sup>64</sup>/ N). [I benchmark my little routine using a probabilistic test](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2020/05/28/prob.py) and the results are promising. In the worst case, I can be orders of magnitude larger than the lower bound, but most of the time, my estimated error is lower than the lower bound. This suggests that though my approach is not quite suitable to get back x, with a little bit of extra mathematics and a few more instructions, I could probably make it work exactly within a strict error bound.

