---
date: "2015-05-05 12:00:00"
title: "Do better written papers get more citations?"
---



Everything else being equal, you would expect short and simple papers to get a wider readership. Long sentences, complicated terms, should all discourage readers from reading further.

So you would think that researchers and academics would outcompete each other, producing ever more accessible papers&hellip; to maximize the impact of their work.

Sadly, the incentives do not work in this manner:

- The most important step for many researchers is to get the paper published in a &ldquo;prestigious&rdquo; venue. They could not care less if only ten researchers ever manage to decipher half their manuscript&hellip; as long as it gets published somewhere prestigious.

You would think that the referees would recommend well written manuscripts&hellip; and everything else being equal, they will&hellip;

Except that pompous language exists for a reason: it is meant to impress the reader.

If you take a result and show that, ultimately, you can make it trivial&hellip; the referee might say &ldquo;it is nice, but the problem was clearly not very hard&rdquo;&hellip;

So, at least in Computer Science, research papers often end up filled with complicated details. Very few of them are distilled to the essential parts.

Authors respond to incentives: it is more important to impress the referee than to write well. 
- The second most important step for researchers is to get cited. You would think that well written work would get more citations&hellip; And there must be an effect: if people cannot quickly decipher what your work is about, they are less likely to cite you.

However, people generally do not read the work they cite. They may scan the abstract, the conclusion&hellip; but rarely all of it.

So papers containing a wide range of results, or more impressive-sounding claims, are probably more likely to be cited.

The way out of this trap is to measure influence instead of citations. That is, you can reliably identify the references that are essential to follow-up work (see [Zhu et al, 2015](http://arxiv.org/abs/1501.06587)). Sadly, it requires a bit more work than merely counting citations.


To measure the relationship between writing quality and citations, [Weinberger et al. (2015)](http://journals.plos.org/ploscompbiol/article?id=10.1371/journal.pcbi.1004205) have reviewed the abstracts (and not the whole papers) of several research articles. Though they do not express it in this manner, we could say that the quality of the writing has little to do with impact: differing from the average paper by more than one standard deviation on a desirable feature may coincide with a variation of the number of citations of about 5%. Their paper also fails to address the fact that citation counts have high statistical dispersion: most papers get few citations where a few get many. So any statistical analysis must be done with extra care: a few individual articles can account for much of the average. You need to take their results with a grain of salt. It worse than it sounds because, your goal as a researcher, is not increase the citations that one of your paper received from 5 to 6 (a 20% gain!)&hellip; whether it is 5 or 6, it is still inconsequential&hellip; your goal is to have about 100 citations or more for your paper&hellip; and whether you hit 80, 100, or 120 citations is irrelevant.

Nevertheless, their work shows that good writing can often coincide with fewer citations&hellip; Indeed, they found that long abstracts made of long sentences containing many adverbs and complicated or superlative words tends to coincide with more citations. They found that authors who stress the novelty of their results tend coincide with the most cited authors.

Thus, at least according to Weinberger et al. (2015), improving your writing can have a small negative effect. This should come as no surprise to those who have long observed that academic writing in unnecessarily dense. Authors write this way because it gets the job done.

Weinberger et al. explain their result as follows&hellip;

> Despite the fact that anybody in their right mind would prefer to read short, simple, and well-written prose with few abstruse terms, when building an argument and writing a paper, the limiting step is the ability to find the right article. For this, scientists rely heavily on search techniques, especially search engines, where longer and more specific abstracts are favored. Longer, more detailed, prolix prose is simply more available for search. This likely explains our results, and suggests the new landscape of linguistic fitness in 21st century science.


Search engines encourage us to write poorly? Do search engines favour results with long sentences and superlative words? I think not. In any case, to make this demonstration, the authors should repeat their survey with older papers, prior to the emergence of powerful academic search engines.

A much more likely phenomenon, in my opinion, is that when looking to quickly cite a reference, one seeks impressive-sounding papers.

I used a similar trick in high school. I wanted to stand apart and impress my teachers, so I would intentionally use a very rich vocabulary. I think it worked.

So, what should you do? If your goal is to be widely read, you should still write short sentences using simple words. If your goal is to impress strangers who will probably never read you, use long and impressive sentences.

I think that Weinberger et al. made their preference clear: ironically maybe, their paper is short, to the point and well written.

