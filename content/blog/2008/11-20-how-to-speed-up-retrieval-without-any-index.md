---
date: "2008-11-20 12:00:00"
title: "How to speed up retrieval without any index?"
---



John Cook gives us a nice recipe to [quickly find all squares in a set of integers](http://www.johndcook.com/blog/2008/11/17/fast-way-to-test-whether-a-number-is-a-square/). For example, given 3, 4, 9, 15, you want your algorithm to identify 4 and 9 as squares.

The naÃ¯ve way to solve this problem goes as follows:

1. For each element&hellip;
1. check whether sqrt(x) is an integer.


This may prove too expensive since the square-root operation must be computed using a floating-point algorithm.

A better way is to look at the first 4 bits of each integer. If the integer is a square, then the first 4 bits must have value 0, 1, 4, or 9. If you have a random distribution of numbers, this means that you can quickly discard 3 out of 4 numbers.

It is not immediately obvious that you will speed up the retrieval because inserting this check will add some overhead. However, it doubles the speed according to John. It is even less obvious that checking the first 8 or 16 bits instead of just the first 4 bits, can help. John says it does not help in one C++ implementation, but it does in a C# implementation.

This sort of strategy is entirely general. The research question is how much work should you do on fast dismissal? Too much effort toward dismissing lots of candidates might be counterproductive. Too little and your performance might not improve optimally.

Recently I started to wonder whether we could make it multipass: you first dismiss a few candidates with a cheap test, then on the survivors you use a more expensive test and so on. For example, you first check the first 4 bits, and if you cannot dismiss the candidate, you check the next 4 bits and so on. It is not a surprising idea, but figuring out whether it is worth the effort is a research question.

To make my point, I have worked on fast retrieval under the [Dynamic Time Warping](https://en.wikipedia.org/wiki/Dynamic_time_warping) (DTW) distance, a nonlinear distance measure between time series. The DTW does not satisfy a triangle inequality. It is commonly used as a pattern recognition technique when comparing time series. It was initially designed to compare voice samples, allowing for changes in voice rhythm.

[Eamonn Keogh](http://www.cs.ucr.edu/~eamonn/) from <del datetime="2008-11-25T22:10:13+00:00">UCI</del>UCR has come up with a simple but nearly optimal way to compute a lower bound to the DTW between any two times series, called LB_Keogh (named after himself). Just like in the John Cook algorithm, this lower bound __quickly discards the false negatives__. If you are interested, Eamonn has applied LB_Keogh to just about every time series problem you can think of. (Update: one hundred people or more also used LB_Keogh in their work, see comments below.)

I improved over LB_Keogh as follows. If LB_Keogh is not good enough (and only if it is not good enough), I compute a tighter lower bound (called LB_Improved). Surprisingly, in many cases, I can improve the retrieval time by a factor of two or more.

I have published my work as a [software library](https://github.com/lemire/lbimproved), but also as the following paper:

> Daniel Lemire, [Faster Retrieval with a Two-Pass Dynamic-Time-Warping Lower Bound](http://arxiv.org/abs/0811.3301), to appear in Pattern Recognition.


This sort of work is much more difficult than it appears. I could have easily made my method look good by optimizing it, while leaving the competing methods unoptimized. By publishing my implementation, I go a long way toward keeping me honest. If I fooled myself and the reviewers, someone might find out by surveying my source code.

