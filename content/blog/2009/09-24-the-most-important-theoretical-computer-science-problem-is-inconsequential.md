---
date: "2009-09-24 12:00:00"
title: "The most important Theoretical Computer Science problem is inconsequential"
---



Some consider the P = NP problem to be [the most important Theoretical Computer Science problem](https://en.wikipedia.org/wiki/P_%3D_NP_problem). It asks whether all problems whose solution can be verified quickly, can also be solved quickly. If you can answer this question, you win one million dollars.

The catch is that _quickly_ is defined as in <em>polynomial time</em>. Thus, if you can solve a problem in time <em>O</em>(<em>n</em><sup><em>x</em></sup>) where _x_ is the number of electrons in the universe, then you are quick.

This is an annoyingly silly definition. [Bubble sort](https://en.wikipedia.org/wiki/Bubblesort) is in O(<em>n</em><sup>2</sup>). Yet, try replacing all sorting within Google&rsquo;s infrastructure by this _quick_ algorithm. Google would die.

Lance Fortnow asks us to [take for granted](http://mags.acm.org/communications/200909/?folio=78&amp;CFID=54572392&amp;CFTOKEN=14190217) that proving P = NP implies we have fast algorithms for all NP problems. William Gasarch just [predicted](http://blog.computationalcomplexity.org/2009/09/my-two-cents-on-p-vs-np.html) that proving P â‰  NP would also help real world of algorithms. 

Unknowingly to them, [Zeilberger proved that P=NP](http://www.math.rutgers.edu/~zeilberg/mamarim/mamarimPDF/pnp.pdf) on April 1, 2009. Yet, nothing happened. (He was kidding. Or was he?) Anyhow, enough with the dogma! While intermediate steps in the solution of the problem might be critically important to our understanding of computation, knowing that P = NP is inconsequential technologically.

This is as silly as claiming that sending men to Mars will cure cancer. It might very well that the research necessary to send men to Mars might lead to major breakthroughs, but whether we go to Mars or not has nothing to do with cancer.

Yes, please send men on Mars. Yes, please work on the P = NP problem. But stop claiming the answer would change the world.

__Further reading:__ See my older post [Is P vs. NP a practical problem?](/lemire/blog/2007/05/23/is-p-vs-np-a-practical-problem/). Dick Lipton wrote a [related blog post as well](https://rjlipton.wordpress.com/about-me/).

