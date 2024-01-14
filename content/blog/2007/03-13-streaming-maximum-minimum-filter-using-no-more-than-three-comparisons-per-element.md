---
date: "2007-03-13 12:00:00"
title: "Streaming Maximum-Minimum Filter Using No More than Three Comparisons per Element"
---



My paper [Streaming Maximum-Minimum Filter Using No More than Three Comparisons per Element](http://arxiv.org/abs/cs/0610046) will appear in the Nordic Journal of Computing. Despite the scary title, anyone with an elementary Mathematics background can read and appreciate the paper. There are mathematical proofs, but they are simple. The algorithm itself is very simple (that is the whole point of my paper). I am pretty proud of this small paper because I think I was able to find one of the few remaining basic algorithmic problems that did not have a satisfactory solution: people have worked on this problem for the last 20 years and it seems to me that they found increasingly complicated solutions, whereas what I propose goes back to the roots (it looks a lot like the early solutions that were proposed).
This is subjective, of course, since people patented previous solutions to this problem and some would object that they already have better solutions (in some technical sense). Some may also object that it is not a basic problem, or that there are many more basic problems out there to be found. Well, read my paper and see for yourself.

Here is the abstract:

>The running maximum-minimum (max-min) filter computes the maxima and minima over running windows of size w. This filter has numerous applications in signal processing and time series analysis. We present an easy-to-implement online algorithm requiring no more than 3 comparisons per element, in the worst case. Comparatively, no algorithm is known to compute the running maximum (or minimum) filter in 1.5 comparisons per element, in the worst case. Our algorithm has reduced latency and memory usage.


There is one very interesting open problem arising from this paper. Can you find an optimal algorithm (and prove it is optimal) of the running max-min problem or at least, a tight lower bound on the number of comparisons per element required? I conjecture that my solution, being so elegant, is probably optimal is some sense, but I could not prove it. Further investigations of this problem are probably not difficult, but they may require more complicated Mathematics.

