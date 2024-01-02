---
date: "2006-04-21 12:00:00"
title: "When to use the geometric mean?"
---



This is better documented elsewhere, but I could not find a quick reference on the web as to when you&rsquo;d want to use the [geometric mean](https://en.wikipedia.org/wiki/Geometric_mean) instead of the arithmetic (usual) mean.

- Suppose that I&rsquo;m 30% richer than last year, but last year I was 20% richer than the year before&hellip; what is the average growth? Well, my current wealth is 1.3&nbsp;*&nbsp;1.2&nbsp;*&nbsp;<em>w</em> if _w_ is my wealth two years ago. I can expect that if _t_ is the average growth factor over the last two years, then my current wealth is <em>t</em>&nbsp;*&nbsp;<em>t</em>&nbsp;*&nbsp;<em>w</em>. Setting <em>t</em>&nbsp;=&nbsp;1.25 is the wrong answer. In such a case, choosing <em>t</em>&nbsp;=&nbsp;sqrt(1.3&nbsp;*&nbsp;1.2) solves the problem.
- Another case where the geometric mean makes sense is when you are stuck averaging numbers that are not comparable like the time necessary to build a data cube, versus the average query time. Indeed, if _a_ and _b_ are two numbers and _a_ is much smaller than <em>b</em>, then (2<em>a</em> +<em>b</em>)/2 is about the same as (<em>a+b</em>)/2. One component of your system is significantly worse and yet, you get the same __average__ performance? That&rsquo;s wrong. Computing sqrt (2<em>ab</em>) seems to make much more sense.


