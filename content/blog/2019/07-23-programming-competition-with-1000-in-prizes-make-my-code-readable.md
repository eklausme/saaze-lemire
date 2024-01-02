---
date: "2019-07-23 12:00:00"
title: "Programming competition with $1000 in prizes: make my code readable!"
---



[Colm MacCárthaigh](https://www.notesfromthesound.com) is organizing a programming competition with three 3 prizes: $500, $300, $200. The objective? Produce the most readable, easy to follow, and well tested implementation of the <em>nearly divisionless</em> random integer algorithm. The scientific reference is [Fast Random Integer Generation in an Interval](https://arxiv.org/abs/1805.10941) (ACM Transactions on Modeling and Computer Simulation, 2019). I have a few blog posts on the topic such as [Nearly Divisionless Random Integer Generation On Various Systems](/lemire/blog/2019/06/06/nearly-divisionless-random-integer-generation-on-various-systems/).

This algorithm has been added to the [Swift standard library](https://github.com/apple/swift/pull/25286) by Pavol Vaskovic. It has also been added to the [Go standard library](https://github.com/golang/go/blob/669ac1228a51f7724baab9325d57ac04025db493/src/math/rand/rand.go#L150) by Josh Snyder. [And it is part of the Python library Numpy](https://github.com/numpy/numpy/blob/6420e7f528a6c42422966544e453bdb2805ff620/numpy/random/generator.pyx#L421) thanks to Bernardt Duvenhage and others.

I have a [C++ repository on GitHub with relevant experiments](https://github.com/lemire/FastShuffleExperiments) as well as a [Python extension](https://github.com/lemire/fastrand).

Colm wants the implementation to be licensed under the Apache Software License 2.0. It could be in any programming language you like. The deadline is September 1st 2019. You can find [Colm on Twitter](https://twitter.com/colmmacc).

