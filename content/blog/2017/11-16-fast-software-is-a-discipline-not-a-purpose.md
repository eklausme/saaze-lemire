---
date: "2017-11-16 12:00:00"
title: "Fast software is a discipline, not a purpose"
---



When people train, they usually don&rsquo;t try to actually run faster or lift heavier weights. As a relatively healthy computer science professor, how fast I run or how much I can lift is of no practical relevance. However, whether I can walk the stairs without falling apart is a metric.

I am not an actor or a model. Who cares how much I weight? I care: it is a metric.

I could probably work in a dirty office without ill effect, but I just choose not to.

So when I see inefficient code, I cringe. I am being told that it does not matter. Who cares? We have plenty of CPU cycles. I think you should care, it is a matter of discipline.

Yes, only about 1% of all code being written really matters. Most people write code that may as well be thrown out.
But then, I dress cleanly every single day even if I stay at home. And you should too.

I do not care which programming language you use. It could be C, it could be JavaScript. If your code is ten times slower than it should, I think it shows that you do not care, not really. And it bothers me. It should bother you because it tells us something about your work. It is telling us that you do not care, not really.

Alexander Jay sent me a nice email. He reviewed some tricks he uses to write fast code. It inspired me these recommendations:

- Avoid unnecessary memory allocations.
- Avoid multiple passes over the data when one would do.
- Avoid unnecessary runtime inferences and branches.
- Avoid unnecessary performance-adverse abstraction.
- Prefer simple value types when they suffice.
- Learn how the data is actually represented in bits, and learn to dance with these bits when you need to.


Alexander asked me &ldquo;At what point would you consider the focus on optimization a wasted effort? &rdquo; My answer: &ldquo;At what point do you consider being fit and clean a wasted effort?&rdquo;

There is a reason we don&rsquo;t tend to hire people who show up to work in dirty t-shirts. It is not that we particularly care about dirty t-shirts, it is that we want people who care about their work.

If you want to show care for your software, you first have to make it clean, correct and fast. If you start caring about bugs and inefficiencies, you will write good software. It is that simple.

