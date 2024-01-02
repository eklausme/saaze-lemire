---
date: "2016-12-20 12:00:00"
title: "What is a useful theory?"
---



I was an adept, as a teenager and a young adult, of [thinkism](http://kk.org/thetechnium/thinkism/). Thinkism is the idea that intelligence alone can solve problems. I thought I was smart so that I could just sit down and solve important problems. One after the other. Whatever contributions I ended up making had little to do with sitting down and thinking hard&hellip; and much more to do with getting dirty.

When you learn mathematics, you are given theorems that all seem to descend from the minds of brilliant men (and, in some cases, women). So you think that society makes progress when people sit down and think really hard about problems.

Then you realize that it is not quite how the world advances. There is often a myriad of minor conceptual advances&hellip; solar panels don&rsquo;t go from being overly expensive and inefficient to being cheaper than oil due to one breakthrough&hellip; the progress follows some kind of random walk. You come to realize that most of the things we think we know are not quite right. Even the simplest ideas are often misleading. We generally move forward, but there are steps backward as well. And, more critically, useful theories from the past can suddenly become anchors.

Progress is Darwinian, not Cartesian.

You can recognize good theoretical ideas because they make you smarter. Algebra is one such idea. For example, when I try to explain mathematical ideas to kids who have not yet taken algebra, I struggle.

Before you learn any new theory, you ought to figure out what kind of problems will become easier.

[One concept I have criticized is &ldquo;probability&rdquo;](/lemire/blog/2014/02/28/probabilities-in-computing-they-may-not-mean-what-you-think-they-mean/). That&rsquo;s a controversial stance because so much of software, engineering, and machine learning appears to rely on probabilities. My own research makes abundant use of probability theory. However, I struggle to find real-world problems that become easier once you introduce probability theory. It is not that there is any shortage of hard problems worth solving&hellip; it is that too few of these problems are made easier when applying probabilities.

I remember being on the examination committee of a Ph.D. student a few years back. She was making use of probabilities and Bayesian networks throughout her presentation. At some point, to test her out, I asked what should have been a trivial hypothetical question&hellip; all she needed to do is really know what independent probabilities are&hellip; Not only did she failed to answer properly, I suspect that many of the other members of the examining board failed to realize she was confused.

I cannot blame her because I get probabilities wrong all the time. Let us consider the [Monty Hall problem](https://en.wikipedia.org/wiki/Monty_Hall_problem), as stated on Wikipedia:

> Suppose you&rsquo;re on a game show, and you&rsquo;re given the choice of three doors: Behind one door is a car; behind the others, goats. You pick a door, say No. 1, and the host, who knows what&rsquo;s behind the doors, opens another door, say No. 3, which has a goat. He then says to you, &ldquo;Do you want to pick door No. 2?&rdquo; Is it to your advantage to switch your choice?


I have been confused by this problem&hellip; that&rsquo;s ok, maybe I am just not that smart&hellip; but I have watched several people with a science Ph.D. being unable to even think about the problem, even when they took all the probability theory that they need to answer this question.

In this case, the problem is not hard if you stop short of using probability theory. You can just enumerate the possibilities:

1. Door 1: Goat, Door 2: Car, Door 3: Goat
1. Door 1: Car, Door 2: Goat, Door 3: Goat
1. Door 1: Goat, Door 2: Goat, Door 3: Car


So you have picked Door 1. In the first scenario, the host will pick Door 2, and switching is the right move. In the second scenario, switching is the bad move. In the last scenario, switching would again be the right move. So in 2 out of 3 scenarios, switching is the right move.

If I explain it in this manner, I am convinced that even 10-year-olds can understand.

I have argued in more details in my blog post [Probabilities are unnecessary mathematical artifacts](/lemire/blog/2011/06/23/probabilities-are-unnecessary-mathematical-artifacts/) that we should use different tools that make it easier for us to get the right answer.

My friend Antonia Badia wrote to me&hellip;

> (&hellip;) it&rsquo;s impossible to do Artificial Intelligence today without using probabilities.


I suspect he is right. However, the fact that we use painful tools today can be interpreted as a hint that there are massive conceptual breakthroughs to be made in the near future.

We should not assume that ideas are universally useful. We live on a moving landscape.

Calculus, as it is currently taught, was made exceedingly abstract so that pre-computing scientists could do their work. But in the computing era, it makes less and less sense. [Zeilberger](http://www.math.rutgers.edu/~zeilberg/) correctly argued, in my mind, that we should just do away with the concept of infinity&hellip;

> So I deny even the existence of the Peano axiom that every integer has a successor. Eventually, we would get an overflow error in the big computer in the sky, and the sum and product of any two integers is well-defined only if the result is less than p, or if one wishes, one can compute them modulo p. Since p is so large, this is not a practical problem, since the overflow in our earthly computers comes so much sooner than the overflow errors in the big computer in the sky. (Zeilberger in [&ldquo;Real&rdquo; Analysis is a Degenerate Case of Discrete Analysis](https://pdfs.semanticscholar.org/ad21/656338760ff498b687061dfe3c2bf2895f89.pdf))


Even if you disagree with Zeilberger, I don&rsquo;t think that there can be much disagreement on the fact that school-taught mathematics pays little attention to modern-day problems. The long division is about as useful as Latin.

So, yes, a useful theory is one that makes you smarter. We are surrounded by theories that fail to pass this basic test. It is a problem and an opportunity.

__<br/>
Further reading__: [Kuhn&rsquo;s Structure of Scientific Revolutions](http://carlroberts.us/?p=241), [Pragmatism (Wikipedia)](https://en.wikipedia.org/wiki/Pragmatism)

