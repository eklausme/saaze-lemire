---
date: "2019-03-12 12:00:00"
title: "Multiplying by the inverse is not the same as the division"
---



In school, we learn that the division is the same as multiplying the inverse (or reciprocal), that is x / y = x * (1/y). In software, this does not work as-is when working with integers since 1/y is not an integer when y is an integer (except for y = 1 or y = -1). However, computers have floating-point numbers which are meant to emulate real numbers. It is reasonable to expect that x / y = x * (1/y) will work out with floating-point numbers. It does not.

I woke up this morning reading a [blog post by Reynolds on how to compute the inverse quickly when the divisor is known ahead of time](http://marc-b-reynolds.github.io/math/2019/03/12/FpDiv.html). Reynolds is concerned with performance, but his post reminded me of the fact that, in general, multiplying by the inverse is not the same as dividing.

For example, dividing by 3.1416 and multiplying by 1/3.1416 do not result in the same numbers, when doing the computation on a computer.

To prove it, let me pull out my node (JavaScript) console&hellip;
```C
> x = 651370000000
> x / 3.1416 * 3.1416
651370000000
> invd = 1 / 3.1416
> x * invd * 3.1416
</span><span style="color: #008000;">651370000000.000__1__</span>```


Maybe only JavaScript is broken? Let us try in Python&hellip;
```C
>>> x = 651370000000
>>> x / 3.1416 * 3.1416
651370000000.0
>>> invd = 1 / 3.1416
>>> x * invd * 3.1416
</span><span style="color: #008000;">651370000000.000__1__</span>```


Always keep in mind that floating-point numbers are different from real numbers&hellip; [for example, half of all floating-point numbers are in the interval [-1,1]](/lemire/blog/2017/02/28/how-many-floating-point-numbers-are-in-the-interval-01/).

__Further reading__: [What every computer scientist should know about floating-point arithmetic](https://dl.acm.org/citation.cfm?id=103163) and [Faster Remainder by Direct Computation: Applications to Compilers and Software Libraries](https://arxiv.org/abs/1902.01961)

