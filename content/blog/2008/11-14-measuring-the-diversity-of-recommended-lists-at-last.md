---
date: "2008-11-14 12:00:00"
title: "Measuring the diversity of recommended lists, at last"
---



For a number of years, algorithm researchers in collaborative filtering and recommender systems __have focused on accuracy as the sole performance metric__.

Imagine that you bought a couple of albums from Celine Dion and you liked them a lot. Then the best answer might be to suggest you buy all the other Dion albums. Or is it?

No. You do not want to optimize accuracy above all else. __You need to balance accuracy and diversity__. To any user, it is obvious. Researchers often prefer to ignore diversity because it is harder to measure.

Several people, [me included](http://www.daniel-lemire.com/blog/archives/2007/12/22/collaborative-filtering-why-working-on-static-data-sets-is-not-enough/), have argued in favour of diversity, but metric proposals were still missing. I have had on my to-do list to write a paper on __measuring__ the diversity of recommender systems. Unfortunately, I cannot cope with more than a few projects at any one time. Fortunately, it looks like I will not have to write this paper. Zhang and Hurley have done a good job at it:

> Zhang, M. and Hurley, N. 2008. [Avoiding monotony: improving the diversity of recommendation lists](http://doi.acm.org/10.1145/1454008.1454030). In Proceedings of the 2008 ACM Conference on Recommender Systems (Lausanne, Switzerland, October 23 &#8211; 25, 2008). RecSys &rsquo;08. ACM, New York, NY, 123-130.


Do not be put off by the mathematics: they are a tad formal, but the right ideas are there, just read slowly sections 3 and 4. Basically, diversity is measured as the __average dissimilarity between items__. That is a standard form of diversity measure. This strategy to measure diversity is not novel, but to my knowledge, they are the first to apply it to collaborative filtering.

What is next? You are looking for a paper idea?

- Take Zhang and Hurley&rsquo;s class of diversity measures, and apply them to existing recommender systems. Show that there is an accuracy-precision trade-off. All you need is a dissimilarity measure between items.
- Do user studies to prove people prefer a balance between diversity and accuracy.


__Requirement__: if you steal anyone of these ideas, you have to email me a copy of your paper once it is written.

