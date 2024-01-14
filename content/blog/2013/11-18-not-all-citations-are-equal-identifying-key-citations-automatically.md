---
date: "2013-11-18 12:00:00"
title: "Not all citations are equal: identifying key citations automatically"
---



Suppose that you are researching a given issue. Maybe you have a medical condition or you are looking for the best algorithm to solve your current problem.

A good heuristic is to enter reasonable keywords in Google Scholar. This will return a list of related research papers. If you are lucky, you may even have access to the full text of these research papers.

Is that good enough? No.

Scholarship, on the whole, tends to improve with time. More recent papers incorporate the best ideas from past work and correct mistakes. So, if you have found a given research paper, you&rsquo;d really want to also get a list of all papers building on it&hellip;
Thankfully, a tool like Google Scholar allows you to quickly access a list of papers citing a given paper.
Great, right? So you just pick your research paper and review the papers citing them.

If you have ever done this work, you know that most of your effort will be wasted. Why? Because most citations are shallow. Almost none of the citing papers will build on the paper you picked. In fact, many researchers barely even read the papers that they cite.
Ideally, you&rsquo;d want Google Scholar to automatically tell apart the shallow citations from the real ones.

This whole problem should be familiar to anyone involved in web search. Lots of people try to artificially boost the ranking of their web sites. How did the likes of Google respond? By getting smarter: they use machine learning to learn the best ranking using many parameters (not just citations).
It seems we should do the same thing with research papers. Last year, I [looked in the problem](/lemire/blog/2012/03/20/from-counting-citations-to-measuring-usage-help-needed/) and found that machine learning folks had not addressed this issue to my satisfaction. To help attract attention to this problem, we asked volunteers to identify which references, in their own papers, were really influential. We recently [made the dataset available](https://lemire.me/citationdata/).

The result? Our [dataset](https://lemire.me/citationdata/) contains 100 annotated papers. Each paper cites an average of 30 papers, out of which only about 3 are influential.

If you can write software to identify these influential citations, then you could make a system like Google Scholar much more useful. The same way GMail sorts my mail into &ldquo;priority&rdquo; and &ldquo;the rest&rdquo;, you could imagine Google Scholar sorting the citations into &ldquo;important&rdquo; and &ldquo;the rest&rdquo;. Google Scholar could also offer better ranking. That would be a great time saver.

Though we make the dataset available, we did not want to passively wait from someone to check whether it was possible to do something with it. The result was [a paper recently accepted by JASIST](https://lemire.me/fr/abstracts/JASIST2013.html) for publication, probably in 2014. Some findings that I find interesting:

- Out of dozens of features, the most important feature is how often the reference is cited in the citing paper. That is, if you keep citing a reference, then you are more likely to be building on this reference.
- The recency of a reference matters. For example, if you are citing a paper that just appeared, your citation is more likely to be shallow.- We have been using citations to measure the impact of a researcher, through the [h-index](https://en.wikipedia.org/wiki/H-index). Could we get a better measure if we gave more weight to influential references? To this end, we proposed the hip-index and it appears to be better than the h-index. See [Andre Vellino&rsquo;s blog post](https://synthese.wordpress.com/2013/11/16/hip-index/) on this topic.


You can grab the [preprint](https://lemire.me/fr/documents/publications/citationjasist2013.pdf) right away. Though I think the paper does a good job at covering the basic features, there is much room for improvement and related work. We have an extensive <em>future work</em> section which you should check out if you are interested in contributing to this important problem.
__Credit__: Most of the credit for this work goes to my co-authors. Much of the heavy lifting was done by Xiaodan Zhu.
