---
date: "2013-07-11 12:00:00"
title: "Big-O notation and real-world performance"
---



Classical Newtonian mechanics is always mathematically consistent. However, Newtonian mechanics assumes that bodies move without friction and that we stay far from the speed of light. When your car is stuck in the mud or you are running an intergalactic spaceship, frictionless Newtonian mechanics is the wrong model __even though__ it remains mathematically consistent. Why do we still use Newtonian mechanics? Because it gets the job done in many practical cases.

Similarly, in computer science, we routinely analyze algorithms using the [big-O notation](https://en.wikipedia.org/wiki/Big_O_notation). This notation is always mathematically consistent. In this sense, it is always right.

However, most computer scientists and engineers use the big-O notation as a model for real-world performance (at a high level). So if a computer scientist tells you that algorithm X runs in time O(<em>n</em><sup>2</sup>) whereas a algorithm Y runs in time O(<em>n</em> log <em>n</em>), you expect that for some large but reasonable value of _n_ and for some data, algorithm Y will be faster than algorithm X. If it does not happen, it does not mean that the big-O notation is mathematically wrong, but it means that it is wrong as model for real-world performance. It must be rejected. That is, the big-O notation does not model real-world performance and is not useful as a scientific model. That&rsquo;s just like saying that if you run an intergalactic spaceship, Newtonian mechanics is wrong. It is not up to debate: Newtonian mechanics will simply fail to model how your engine relate to the speed of your ship.

What do I mean by large but reasonable value of <em>n</em>? First we must agree that there is a limit. Just consider that our solar system is finite. We could spend all our ressources on a single massive computer, but it would still be finite. Even if we were to expand the computer to encompass all of the universe, it would still be finite. So there is clearly a limit to how big _n_ can be. In practice, this limit is set by the practical problems we encounter. If, for your problems, _n_ is too small, then the big-O notation is the wrong model for you.

To make matters worse, nobody uses the same program to process 10KB and to process 100TB of data. Suresh [summarizes](http://blog.geomblog.org/2012/05/in-long-run.html) the problem:

> Asymptotics will eventually win out, as long as everything else stays fixed. But that&rsquo;s the precise problem. Everything else doesn&rsquo;t stay fixed. Well before your _n_ log _n_ algorithm beats the <em>n</em><sup>2</sup> algorithm, we run out of memory, or local cache, or something else, and the computational model changes on us.


So even if your algorithm would eventually win out for a value of _n_ that is not outrageous, your asymptotic analysis can still be irrelevant because larger values of _n_ are handled with a different architecture.

Ultimately, the big-O notation is a tremendously useful but crude tool. It is great to convey broad ideas. It can help to explain some simple decisions. For example, if you need to search an element in an array and you expect the array to be large, you might just say that you opt for a binary search instead of a sequential scan because the former has O(log <em>n</em>) complexity wheres the latter has O(<em>n</em>) complexity. It is unlikely that your colleagues will expect you to run benchmarks. In this case, the big-O notation captures and summarizes our knowledge of the problem.

However, when designing a software system, the fraction of your decisions that rely on big-O analysis is small. Good engineers rely on more sophisticated models and metrics. In this sense, it is unfair to compare the big-O notation with Newtonian mechanics. The latter allows you to model complex problems from start to finish with exact results (under some assumptions that can be almost realized). The big-O notation is far more limited in its applications. Of course, when it is applicable, the big-O notation is tremendously powerful.

Continue reading with my post [Better computational complexity does not imply better speed](/lemire/blog/2019/11/26/better-computational-complexity-does-not-imply-better-speed/).

