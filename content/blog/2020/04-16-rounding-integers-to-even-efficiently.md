---
date: "2020-04-16 12:00:00"
title: "Rounding integers to even, efficiently"
---



When dividing a numerator _n_ by a divisor <em>d</em>, most programming languages round &ldquo;down&rdquo;. It means that 1/2 is 0. Mathematicians will insist that 1/2 and claim that you really are computing floor(1/2). But let me think like a programmer. So 3/2 is 1.

If you always want to round up, you can instead compute (<em>n </em>+ <em>d </em>&#8211; 1)/<em>d</em>.  If I want to apply it to _n_ is 3 and _d_ is 2, I do (3 + 2 &#8211; 1) /2 = 2.

We sometimes want to round the value to the nearest integer. So 1.4 becomes 1, 1.6 becomes 2. But what if you have 1.5 (the result of 3/2)? You can either round up or round down.

- You can round &ldquo;up&rdquo; when hitting the midpoint with  (<em>n </em>+ <em>d</em>/2)/<em>d</em>.
- You can round &ldquo;down&rdquo; when hitting the midpoint with (<em>n </em>&#8211; <em>d</em>/2)/<em>d</em>.


But there is a third common way to round. You want to round to even. It means that when you hit the midpoint, you round to the nearest even integer. So 1.5 becomes 2, 2.5 becomes 2, 3.5 becomes 4 and so forth. I am sure that it has been worked out before, but I could not find an example so I rolled my own:
```C
off = (n + d / 2)
roundup = off / d;
ismultiple = ((off % d) == 0);
iseven = (d & 1) == 0;
return (ismultiple && iseven) ? roundup - (roundup & 1) : roundup;
```


Though there is a comparison and what appears like a branch, I expect most compilers to produce essentially branchless code. The result should be about five instructions on most hardware. I expect that it will be faster than converting the result to a floating-point number, rounding it up and converting the resulting floating-point number back.

[I have posted working source code](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2020/04/16/round.c).

Why does it work?

Firstly, you never have to worry about hitting the midpoint if the divisor is odd. The remainder of a division by an odd number cannot be equal to d/2. Thus, starting from the round-up approach (<em>n </em>+ <em>d</em>/2)/<em>d</em> we only need to correct the result. When n is equal to d + d/2, we need to round up, when it is equal to 2 d + d/2 we need to round down and so forth.  So we only need to remove 1 from (<em>n </em>+ <em>d</em>/2)/<em>d </em>when _n_ is equal to 2<em>kd</em>+<em>d</em>/2 for some integer <em>k.</em> But when<em> n</em> is equal to 2<em>kd+d</em>/2, I have that <em>n + d</em>/<em>2</em> is equal to (2<em>k</em>+1)<em>d</em>. That is, the quotient is odd.

__Even better__: You can make it explicitly branchless (credit: Falk Hüffner):
```C
off = (n + d / 2)
roundup = off / d;
ismultiple = ((off % d) == 0);
return (d | (roundup ^ ismultiple)) & roundup
```


__Nitpicking__: You may be concerned with overflows. Indeed, if both _n_ and _d_ are large, it is possible for <em>n</em>+<em>d</em>/2 to exceed to allowable range. However, the above functions are used in the Linux kernel. And you can make them more robust at the expensive of a little bit more work.

__Credit__: This blog post was motivated by an email exchange with Colin Bartlett,

