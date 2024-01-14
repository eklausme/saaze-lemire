---
date: "2013-09-17 12:00:00"
title: "What do computer scientists know about performance?"
---



Scientists make predictions and are judged on these predictions. If you study global warming, then your job is to predict the climate for the next few decades. But what do computer scientists predict with respect to performance?

A lot of classical computer science is focused on performance. That is, it provides us with a repertoire of data structures and algorithms. You can solve 99.9% of all practical software problems using textbook data structures and algorithms. From time to time, you may need to invent something new&hellip; but there is very little you cannot do efficiently with heaps, hash tables, trees, graphs, sorting algorithms&hellip;

This leaves us with the impression that computer science tells us a lot about efficiency. And, for an untrained programmer, using the tools of computer science, that is, using the right standard data structures and the right standard algorithms, goes a long way toward improving efficiency for large problems.

That&rsquo;s because computer science is just great at predicting the asymptotical performance of algorithms. I cannot stress this last point enough, so let me tell you about my own story.

Like many people of my generation, I started programming when I was around 12 on a [TRS-80](https://en.wikipedia.org/wiki/TRS-80_Color_Computer) my parent bought me. They had no idea what they had unleashed. My TRS-80 came with a beautiful manual from which I taught myself programming (in basic, unfortunately).
When I finished high school, I thought I was a pretty neat programmer. I could basically program anything. Or so I thought.

In my first Physics college class, the professor noticed that I was bored to death so he took upon himself to challenge me. He gave me access to an Apple II and asked me to &ldquo;simulate a galaxy&rdquo; by modelling gravitational forces.
I could model one, two or three stars well enough using a naive numerical method. However, as I added stars, my model got slower. Much slower. It did not help when I switched to a more advanced computer. Though I had had no exposure to computational complexity, I recognized that something was up. And this is one of the great lessons that computer science teaches us: think about how the speed of your programs scale. Had I taken a good computer science class, I wouldn&rsquo;t have been caught in a dead-end&hellip;

Let us fast-forward a couple of decades&hellip; Today I would never try to simulate a galaxy by considering the effect of each star of all other stars. I would recognize this as a dead-end right away, without thinking.

However, computational complexity accounts for less than 1% of the work I do when I program for efficiency. In practice, chasing efficiency (for me) is all about reducing the factors. The goal is hardly never to replace an <em>O</em>(<em>N</em><sup>2</sup>) algorithm by an <em>O</em>(<em>N</em>) algorithm. The goal is to reduce the running time of a program by 50%.
Why can&rsquo;t computer science help us with constant factors? It can but computer scientists spend little time on the the key factors impacting efficiency: pipeline width, number of units, throughput and latency of the various instructions, memory latency and bandwidth, CPU caching strategies, CPU branching predictions, instruction reordering, superscalar execution, compiler heuristics and vectorization&hellip; and so on.

Sometimes, computer scientists will be even dismissive of such constant factors. For example, they may object that as computers get faster anyhow, investing in making your code run twice as fast is wasted effort. Thankfully, not all computer scientists have this attitude. Knuth famously wrote:

> In established engineering disciplines a 12% improvement, easily obtained, is never considered marginal and I believe the same viewpoint should prevail in software engineering.


Knuth is correct by the way: if you get hired by Google and manage to improve the performance of a key system by 12%, you are probably in a good position to ask for a huge raise. The difference between running 100 servers and 112 servers can mean a lot of money. Shaving off 12% to the latency can be worth millions of dollars. You are much less likely to be able to replace a key <em>O</em>(<em>N</em><sup>2</sup>) algorithm by an equivalent <em>O</em>(<em>N</em>) algorithm. Google engineers are probably good enough that opportunities to reduce the complexity are rare.

How do we proceed to target these 12% gains? There are some guiding principles: keep memory access local, avoid difficult-to-predict branches&hellip; But even though computer science can help model either of these (e.g., use a complexity measures based on branching, or use a memory model with caching), I don&rsquo;t know of any practical framework to really take them into account in a useful way.
Ultimately, it is all about being able to predict. Given two algorithms, if you want to predict which one will fare better by a constant factor&hellip; then computer science often leaves you dry. Your options are to ask a more experience programmer, or maybe to implement both to try and see.

This is often an expensive and crude process. When I review papers, I am often stuck in how to assess the efficiency of their implementation. It all comes down to trusting the authors. Very few papers are able to conclude something like this: &ldquo;in the worst case, our implementation is within 10% of optimality&rdquo; or &ldquo;no software could be twice as fast as ours in solving this problem&rdquo;.

I think that computer science needs to try harder.

