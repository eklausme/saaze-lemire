---
date: "2013-07-10 12:00:00"
title: "Should computer scientists run experiments?"
---



Jeffrey Ullman, a famous computer science professor, [published an essay](http://i.stanford.edu/~ullman/pub/experiments.pdf) pushing back about the need to run experiments in computer science. Apparently, some conference reviewers gave him a hard time regarding a paper he submitted because it did not include experiments.

I am in general agreement with him: not every research paper should include experiments. That is obviously an excessive requirement. I also think that building theoretical models is very important. Experiments alone are unsatisfying. Indeed, science is not merely about running experiments. Imagine if we did not have Newton&rsquo;s laws? Would we need to run experiments on every new object to see how it behaves when we push it? Experiments are often badly designed and misleading. I don&rsquo;t tend to trust a paper that includes experiments more than another paper. In fact, a paper with a useful theoretical results can be much more powerful than any large set of experiments&hellip; since it is often easier to check the mathematics than to be sure that the experiments were carried on fairly. There is also a sense in which experiments can be pointless. For example, I was once asked to show experimentally that an algorithm based on external-memory sorting could scale up.

But, at some point, Ullman linked to my blog post [A criticism of computer science: models or modèles?](/lemire/blog/2013/05/17/a-criticism-of-computer-science-models-or-modeles/) This brought mixed feelings. I think he misrepresented my opinions:

> In this article, the author argues that one should never use a model that is not real running time on a real computer. For example, this author would not accept the O(n log n) lower bound on sorting, because it is based on counting comparisons rather than machine instructions executed.


I don&rsquo;t think that my blog post says anything of the sort. I disagree with this statement even though Ullman is under the impression that it is what I believe. I think that our knowledge that sorting (in general) requires at least n log n comparisons is critical and fundamental. If you were to learn one thing from computer science, it would probably not be a bad choice. But it is also practically incorrect: you can use [Pigeonhole sort](https://en.wikipedia.org/wiki/Pigeonhole_sort) or [Radix sort](/lemire/blog/2021/04/09/how-fast-can-you-sort-arrays-of-integers-in-java/) to achieve sorting in linear time (so better than O(n log n)). And you are probably relying daily on software that sort data faster.

Models are always simplifications. However, if your model is _right_ by definition&hellip; that is, if no comparison with real world could lead you to conclude that your model is wrong, then it is not a scientific model. It might be a tremendously useful mathematical construction&hellip; but it is not science.

In his essay, Ullman concludes from the model:

> Returning to the sorting example, if you know one algorithm is O(n log n) and another is O(n<sup>2</sup>), you might not know which is really better for small n, but you know for certain that the first is better for matters a database researcher might be interested in.


Of course, [Quicksort](https://en.wikipedia.org/wiki/Quicksort) is an O(n<sup>2</sup>) algorithm that is often used by professional software engineers including those building database engines. My point is that Ullman&rsquo;s models are much less informative than one might think.

It is a scientific fact that the sorting algorithm used in Java, [Timsort](https://en.wikipedia.org/wiki/Timsort), is often preferable to the classical algorithms like merge sort or quick sort. We can run extensive experiments to check that fact. There is also a theoretical analysis that explains why Timsort can often be better. That&rsquo;s a scientific approach.

Working with models without experiments is akin to mathematics. If you model is right, you ought to be able to demonstrate it with experiments. 

Not everything needs to be science. For example, [Codd](https://en.wikipedia.org/wiki/Edgar_F._Codd)&lsquo;s work on relational algebra (the foundation for SQL) has been impactful. I am really happy we have SQL and everything that was built on it. But notice that it was built by people who didn&rsquo;t merely come up with models&hellip; they implemented their ideas and had them face the real world.

The problem is that if we don&rsquo;t require people to test out their ideas in the real world, we are going to get thousands of rambling researchers for every Codd. Sometimes, that is the impression that academic research in computer science gives.

Some researchers will eagerly point out that pure theory often proves useful in unexpected ways. But that is also true of art and philosophy. What sets our current civilization apart from the preceding ones is that we are founded on the scientific paradigm. The industrial revolution was possible because hackers built machines that worked, and irrespective of what the great minds of the time thought, they were adopted. In effect, results are what matters, not how smart you are or how prestigious your position is.

I do not believe we should do away with mathematics, art and philosophy, but we need to be watchful. Do you use a model because influential people are supporting it or because it fits the facts?

Continue reading with my post on [Big-O notation and real-world performance](/lemire/blog/2013/07/11/big-o-notation-and-real-world-performance/).

