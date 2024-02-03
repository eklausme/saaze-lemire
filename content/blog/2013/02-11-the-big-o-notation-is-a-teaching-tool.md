---
date: "2013-02-11 12:00:00"
title: "The big-O notation is a teaching tool"
---



One of my clients once got upset. Indeed, the running time of our image processing algorithm grew by a factor of four when he doubled the resolution of an image. No programmer would be surprised by this observation. (Hint: doubling the resolution multiplies the number of pixels by four.)

Indeed, all programmers eventually notice that some programs run much slower as more data was added. They know that if you try to sort data naively, doubling the size of the data multiplies the running time by four. It is a fundamental realization: scale matters when programming. Processing twice as much data is at least twice as hard, but often much harder.

We could wait for kids to learn this lesson by themselves, but it is more efficient to get them started right away on the right foot. Thus, one of the first things any computer science student learns is the big-O notation. They learn that printing out all values in an array takes <em>O</em>(<em>n</em>) time whereas sorting the same array with the [bubble sort](https://en.wikipedia.org/wiki/Bubble_sort) algorithm can take <em>O</em>(<em>n</em><sup>2</sup>) time. The latter result is a fancy way of saying that doubling the data size will multiply the running time by a factor of four, in the worst case.

Simple models are immensely useful as teaching tools and communication devices. But don&rsquo;t confuse teaching tools with reality! For example, I know exactly how a gas engine works in the sense that I once computed the power of an engine from the equations of thermodynamics. But General Motors is simply not going to hire me to design their new engines. In the same way, even if you master the big-O notation, you are unlikely to get a call from Google to design their next search engine.

Unfortunately, some people idealize the big-O notation. They view it as a goal in itself. In academia, it comes about because the big-O notation is mathematically convenient in the same way it is convenient to search for your keys near a lamp even if you lost them in a dark alley nearby.

The problem with the big-O notation is that it is only meant to help you think about algorithmic problems. It is not meant to serve as the basis by which you select an algorithm!

When asked why the algorithm with better big-O running time fails to be faster, people often give the wrong answers:

- __Our current computer architecture favours the other algorithm.__ What they often imply is that future computer architectures will prove them right. Why think that the future computer architectures will become more like simple theoretical models of the past? When pressed, are they able to come up with many examples where this has happened in the past?
- __With the faster algorithm having worse big-O running time, you are exposed to denial-of-service attacks.__ A good engineer will avoid switching to a slower algorithm for all processing, just so that he can avoid a dangerous special case. Often, a fast algorithm that has a few bad corner cases can be modified so that the bad cases are either promptly detected or made better. You can also use different algorithms depending on the size of the data. 
- __If you had more data, the algorithm with better big-O running time would win out.__ Though, in theory, moving from a 10KB data set to a 10TB data set is the equivalent of turning a knob&hellip; in practice, it often means switching to a whole other architecture, often requiring different algorithms. For example, who can compare QuickSort against MergeSort over 10TB of data? In practice, the size of the data set (<em>n</em>) is bounded. It makes absolutely no practical sense to let _n_ grow to infinity. It is a thought experiment, not something you can actual realize. 
- __You don&rsquo;t understand computational complexity.__ This is probably the most annoying comment any theoretician can make. The purpose of the big-O notation is to codify succinctly the experience of any good programmer so that we can quickly teach it. If you are discussing a problem with an experienced programmer, don&rsquo;t assume he can&rsquo;t understand his problems.
- __Using algorithms with high big-O running times is bad engineering.__  This statement amounts to saying that construction workers should not use power tools because they could cut their fingers off. Case in point: the evaluation of [regular expressions commonly used in Perl or Java is NP-hard](http://perl.plover.com/NPC/NPC-3SAT.html). A short regular expression can be used to [crash a server](https://en.wikipedia.org/wiki/ReDoS). Yet advanced regular expressions are used everywhere, from the Oracle database engine hosting your bank account to your browser.

On the general question of what is good engineering, then my view is that it is not about guaranteeing that nothing bad will happen because it will. Our software architecture is built on C and C++. Our hardware is overwhelmingly built without redundancies. Bad things always happen. I would argue that good engineering is being aware of the pitfalls, mitigating possible problems as much as possible and planning for failure.


__Further reading__: [O-notation considered harmful](http://jng.imagine27.com/index.php/2013-02-10-121226_analytic-combinatorics-is-better-o-nation-considered-harmful.html), [&ldquo;In the long run&hellip;&rdquo;](http://blog.geomblog.org/2012/05/in-long-run.html)

