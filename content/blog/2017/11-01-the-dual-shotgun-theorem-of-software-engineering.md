---
date: "2017-11-01 12:00:00"
title: "The dual-shotgun theorem of software engineering"
---



There is a long-standing problem in software engineering: how does one recognize good code? It would be great if you could point a tool at a software base and get an objective measure of how good the code is. There are tools that pretend to do this, there are textbooks that pretend to guide you toward this objective, but nothing that I care to rely upon.

I have been arguing with folks on Twitter, including [Brian Marick](http://www.exampler.com), about what makes good code. It all started from a quote by [Alexis King](https://lexi-lambda.github.io/resume.html) retweeted by [Eugene Wallingford ](http://www.cs.uni.edu/~wallingf/):

> &ldquo;The best software is the software that is easy to change.&rdquo;


Hear, hear.

People who never program always tend to assume that once you have code that does something &ldquo;close&rdquo; to what you need, then, surely, it is not much effort to bring the code to change a tiny bit its behavior.

Alas, a tiny change in functionality might require a full rewrite.

Not all code is equal in this manner, however. Some code is much easier to change.

You can pretty much recognize bad code without ever looking at it by asking the programmer to make a small change. How long does it take to add a new field to the user accounts&hellip; How long does it take to allow users to export their data in XML&hellip; How long does it take to add support for USB devices&hellip; and so forth.

We see companies collapsing under the weight of their software all the time. You have this company and it has not updated its software in the longest time&hellip; why is that? It might be that software updates are not a priority, but it could also very well be that they have 10 software engineers hard at work and achieving very little results because they are stuck in a pit of bad software.

As a practical matter, it is simply not convenient to ask for small changes constantly to measure the quality of your code. In any case, how do you recognize in the abstract a &ldquo;small&rdquo; change? Is getting your corporate website to work on mobile a small or large change?

The problem, also, is that really bad code grows out of sequences of small changes. Many small changes are bad ideas that should not get implemented.

It is like a Heisenberg effect: to measure the code quality through many small changes, you have to change it in a way that might lead to poor code. What you would need to do it is to ask for small changes, have experts verify that they are small changes, and then immediately retract the request and undo the small change. That would work beautifully, I think, to ensure that you always have great code but your programmers would quickly resign. Psychologically, it is untenable.

As an alternative, I have the following conjecture which I call the dual-shotgun theorem:

> Code that is both correct and fast can be modified easily.


The proof? Code is not correct and fast on its own, you have to change it to make it correct and fast. If it is hard to change the code, it is hard to make it correct and fast.

Let me define my terms.

- Code is correct if it does what we say it does. If you are not a programmer, or if you are a beginner, you might think that it is a trivial requirement&hellip; but it is actually very hard. Code is never perfectly correct. It is impossibly hard to do anything non-trivial without having some surprises from time to time. We call them bugs.
- Code is fast if another engineer doing a rewrite can&rsquo;t expect to produce equivalent software that is much faster without massive efforts. If you are programming alone or only starting out, you might think that your code is plenty fast&hellip; but if you work with great programmers, you might be surprised by how quickly they can delete whole pages of code to make it run 10x faster.


Both of these characteristics are actionable. Good programmers constantly measure how correct and how fast their code is. We have unit tests, benchmarks and so forth. These things can be automated.

They are not trivial pursuits. It is hard to know for certain how correct and how fast your code is, but you can productively work toward making your code more correct and faster.

It is a lot harder to work toward code that is easy to modify. One approach that people use deliberately for this goal is to use more abstract software. So you end up with layers upon layers of JavaScript frameworks. The result is slow code that fills up with weird bugs caused by leaky abstractions. Or they use higher-level programming languages like Visual Basic and end up in a mess of spaghetti code.

The irony is that code that is designed to be flexible is often neither correct nor fast, and usually hard to modify. Code designed to be flexible is nearly synonymous with &ldquo;overengineered&rdquo;. Overengineering is the source of all evils.

Yes, you have heard that early optimization was the source of all evils, but if you read Knuth in context, what he was objecting to was the production of code (with GOTOs) that is hard to read, hard to verify, and probably not much faster, if faster at all.

My theory is that if you focus on correctness and performance (in this order) then you will get code that is easy to modify when the time comes. It will work irrespective of the programming language, problem domain, and so forth.

Some might object that we have great tools to measure code complexity, and thus the difficulty of the code. Take [cyclomatic complexity](https://en.wikipedia.org/wiki/Cyclomatic_complexity) which essentially measure how many branches your code generates. But if you have many branches, it will be hard for your code to be correct. And frequent branches are also bad for performance. So cyclomatic complexity brings no new information. And, of course, overengineered code is often filled with what are effectively branches, although they may not come in the recognizable form of &ldquo;if&rdquo; statements.

What is nice about my conjecture is that it is falsifiable. That is, if you can come up with code that is fast and correct, but hard to modify, then you have falsified my conjecture. So it is scientific!

If you come up with a counterexample, that is code that is correct and fast, but hard to modify, you have to explain how the code came to be correct and fast if it is hard to modify.

