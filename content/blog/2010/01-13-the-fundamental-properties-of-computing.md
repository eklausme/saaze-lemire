---
date: "2010-01-13 12:00:00"
title: "The fundamental properties of computing"
---



Physics works with fundamental properties such as mass, speed, acceleration, energy, and so on. Quantum mechanics has a [well known trade-off](https://en.wikipedia.org/wiki/Heisenberg_uncertainty_principle) between position and momentum: you can know where I am, or how fast I am going, but not both at the same time.

Algorithms (and their implementations) also have fundamental properties. __Running time__ and __memory usage__ are the obvious ones. In practice, there is often a trade-off between memory usage and the running time: you can a low memory usage, or a short running time, but not both. Michael Mitzenmacher [reminded me](https://mybiasedcoin.blogspot.com/2010/01/algorithms-and-data-structures-course.html) this morning of another: __correctness__. On some difficult problems, you can get a low memory usage and a short running time if you accept an approximate solution.

I believe there are other fundamental properties like __latency__. Consider problems where the volume of the solution and of the input is large: statistics, image processing, finding some subgraph or sublist, text compression, and so on. In such instances, the solution comes out as a stream. You can measure the delay between the input and the output. For example, a program that compresses text by first scanning the whole text might have high latency, even if the overall running time is not large. Similarly, we can give the illusion that a Web browser is faster by beginning the Web page rendering faster, even if the overall running time of the rendering is the same. As another example, I once wrote a paper on computing the [running maximum/minimum of an array](http://arxiv.org/abs/cs/0610046) where latency was an issue.

It would be interesting to come up with a listing of all the fundamental properties of computing.

