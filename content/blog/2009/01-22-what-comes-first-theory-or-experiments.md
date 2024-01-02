---
date: "2009-01-22 12:00:00"
title: "What comes first, theory or experiments?"
---



In &ldquo;[my research process](/lemire/blog/2007/11/19/my-research-process/)&ldquo;, I explain how I proceed to produce research papers. As a [comment to my most recent post](/lemire/blog/2009/01/22/why-i-write-bad-papers-sometimes/), [Peter Turney](http://www.apperceptual.com/ ) wrote:

> I don&rsquo;t usually start writing until all the research is done. It sounds like you write and research in parallel.


From what I understand, Peter proceeds like this:

- Find a problem;
- Find some way to evaluate your solution (data+metric);
- Test several solutions experimentally;
- Do some theory if needed;
- If the results are interesting, write the paper knowing who you write it for.


His approach is efficient if you can implement and test algorithms very fast. (He is probably using high level languages.) However, he can waste time on implementation and testing. He wastes no time writing uninteresting papers.

My own process is slightly different:

- Find a problem;
- Consider a priori what we can tell about the problem and its solutions;
- Work out a theoretical framework, derive results, start crafting a paper;
- Think of experiments to run to validate/invalidate the theory or implement some solutions;
- Spend a long time revising the paper. Iterate several times between theory and experiments.
- Figure out where to submit it. Or throw away the paper.


Of course, my approach is almost totally inadequate for fields like Machine Learning where a priori work is often barren or irrelevant. Also, I end up writing uninteresting papersâ€”and throw them away (hopefully). I also cannot tell, when I start writing it, what the paper will say and to whom exactly it might be interesting. Hence, I often change the abstract and the title several times. Many sections that I write are thrown away. I have entire, very long papers, that nobody will ever read.

Hopefully, my process produces papers with a sane balance between theory and practice. At least, that is what I tell myself.

Here are a few of my papers that are typical of my approach:

- [Faster Retrieval with a Two-Pass Dynamic-Time-Warping Lower Bound](http://arxiv.org/abs/0811.3301) : I worked on this paper for over two years, crafting about one hundred pages of theoretical results. Most of my results were too weak for publication and were thrown away. At some point, I set the paper aside for about 6 months because I could not get a decisive theoretical results. I ran serious experiments only a few months before submission and I got surprisingly good results ([C++ code](https://github.com/lemire/lbimproved)). At least, __I__ was surprised by the experiment! There are several small theoretical improvements hidden in the paper. Plus, I collected a few nice observations.
- [Histogram-Aware Sorting for Enhanced Word-Aligned Compression in Bitmap Indexes](http://arxiv.org/abs/0808.2083): It took me about a year to get at this paper. The full extend of the work has been submitted as a journal article a few weeks ago. With Owen Kaser, we wrote about four times as many pages as we published. Initially, we spent a lot of time on theoretical concerns, mapping the problem to graph theory. We implemented some prototypes using fancy theoretical computer science, but they were outgunned by approaches based on mere sorting. I assume we got slightly depressed at some point. I ended writing a [bitmap index library](https://github.com/lemire/ewahboolarray) from scratch in C++. We then spent a lot of time both on further theory and increasingly serious experiments. All year long, both the theory and the experiments improved. Both experiments and theory suggested several new problems to me, and I will work on them in 2009.


Hence, I only write down the code after I have some interesting theoretical results. But I do not require the theoretical results to be worth a paper. Hence, I always start experiments after I have started a paper. Then I iterate, working on the paper (the theory) and on the experiments. The idea is that one is supposed to help the other. Experiments are meant to suggest new theory, and theory is supposed to suggest new experiments.

How do you work?

