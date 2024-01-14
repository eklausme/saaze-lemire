---
date: "2017-10-31 12:00:00"
title: "A decade of using text-mining for citation function classification"
---



Academic work is typically filled with references to previous work. Unfortunately, most of these references have, at best, a tangential relevance. Thus you cannot trust that a paper that cites another actually &ldquo;builds on it&rdquo;. A more likely scenario is that the authors of the latest paper did not even read the older paper, and they are citing the previous work for various unscientific reasons.
Some time ago, I helped co-author a paper that aims to identify the &ldquo;influential&rdquo; references (Zhu et al., [Measuring academic influence: Not all citations are equal](https://arxiv.org/abs/1501.06587)). When we worked on this paper, there wasn&rsquo;t really much work at all on the subject of identifying automatically influential citations and, indeed, I think that the expression &ldquo;influence&rdquo; used with this technical meaning originated from our work.

Pride and Knoth published a superb paper on the matter: [Incidental or influential? &#8211; A decade of using text-mining for citation function classification](http://oro.open.ac.uk/51751/1/Pride_Knoth_A_decade_of_using_text_mining_for_citation_function_classification.pdf).

In their review, they confirm our own findings that few references are actually relevant:

> It is extremely interesting to note that all studies which employed human annotators to judge citation influence reported a broadly similar ratio of positive examples. This ranged from 10.3%, through 14.3%, to 17.9%. __This is an important finding as it gives a clear indication that only a relatively small percentage of all citations are actually influential at all. All of the studies find that the majority of citations are perfunctory at best.__ Negative citations are extremely rare (&hellip;)


They also confirm that the number of times you cite a reference is a strong indication of influence: e.g., if you mention a reference 10 times in your own paper, it is likely because this is an important reference for you.

> Our results therefore confirm that the number of times a citation appears is a strong indicator of that citation&rsquo;s influence.


However, they find something we had not discovered, namely that the similarity between abstracts is the most potent feature. That is, if you cite previous work using an abstract that looks like the previous work, it is likely that you have been genuinely influenced by the previous work. As far as I can tell, their result in this respect is a little at odd with previous work, so either they got it wrong or they have a new (and interesting) new result.

They failed to reproduce some of our results, and this might have to do with software issues:

> These results show that ParsCit correctly identified the exact number of citations in only 40% of cases. GrobID was even less successful. It was exactly correct in only one case and missed a significant number of citations in many others. We argue that this demonstrates a potentially serious failing in current methodologies that rely on PDF extraction for calculation of number of citations.


The quality of the software you are using in research is often underrated. If we screwed up the data processing: &ldquo;shame on us&rdquo;.

Another issue is &ldquo;author overlap&rdquo;: you are more likely to be influenced by work that you have written yourself. In our own paper, we did not find this to be a strong predictor but as observed by Pride and Knoth, this might have to do with the nature of our dataset which was annotated by the authors themselves. Clearly, I am strongly influenced by my own previous work, so I do believe that it ought to be a strong predictor. I would argue, however, that there is a special place in hell for people who are only influenced by themselves.

In any case, time has come, I think, to take this field seriously. The likes of Google should classify citations. It is almost meaningless to say that a paper was cited 100 times if you don&rsquo;t know how many of these citations are influential.

__Further reading__. Coincidentally, Nature has an editorial entitled [Neutral citation is poor scholarship](https://www.nature.com/articles/ng.3989) that states:

> Neutral, flavorless or unexamined mention predominates, and we believe this to be an increasing problem for the integrity of scientific communication, whether it is used in the Introduction or in the Results and Discussion.


