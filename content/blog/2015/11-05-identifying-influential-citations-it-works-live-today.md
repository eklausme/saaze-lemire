---
date: "2015-11-05 12:00:00"
title: "Identifying influential citations: it works live today!"
---



Life has a way to give me what I want. Back in 2009, I [wrote](/lemire/blog/2009/09/02/author-centric/) that instead of following conferences or journals, I would rather follow individual researchers. At the time, there was simply no good way to do this, other than visiting constantly the web page of a particular researcher. A few years later, Google Scholar offered &ldquo;[author profiles](https://scholar.google.com/citations?user=q1ja-G8AAAAJ)&rdquo; where you can subscribe to your favorite researchers and get an email when they publish new work. Whenever I encounter someone who does nice work, I make sure to subscribe to their Google profile.

This week, I got another of my wishes granted.

Unsurprisingly, most academics these days swear by [Google Scholar](https://scholar.google.com/). It is the single best search engine for research papers. It has multiplied my productivity when doing literature surveys.

There have been various attempts to compete with Google Scholar, but few have lasted very long or provided value. The Allen Institute for Artificial Intelligence has launched its own Google Scholar called [Semantic Scholar](https://www.semanticscholar.org/). For the time being, they have only indexed computer science papers, and their coverage falls short of what Google Scholar can offer. Still, competition is always welcome!

I am very excited about one of the features they have added: the automatic identification of influential citations. That is something I have long wanted to see&hellip; and it is finally here! In time, this might come to play a very important role.

Let me explain.

Scientists play this game where they try to publish as many papers as possible, and to get as many people as possible to cite their papers. If you are any good, you will produce some papers, and a few people will read and cite your work.

So we have started counting references as a way to measure a scientist&rsquo;s worth. And we also measure how important a given research paper is based on how often it has been cited.

That sounds reasonable&hellip; until you look at the problem more closely. Once you look at how and why people cite previous work, you realize that most citations are &ldquo;shallow&rdquo;. You might build your new paper on one or two influential papers, maybe 3 or 4&hellip; but you rarely build on 20, 30 or 50 previous research papers. In fact, you probably haven&rsquo;t read half of the papers you are citing.

If we are going to use citation counting as a proxy for quality, we need a way to tell apart the meaningful references from the shallow ones. Surely machine learning can help!

Back in 2012, I asked [why it wasn&rsquo;t done](/lemire/blog/2012/03/20/from-counting-citations-to-measuring-usage-help-needed/). Encouraged by the reactions I got, we collected data from many helpful volunteers. [The dataset with the list of volunteers who helped is still available](https://lemire.me/citationdata/).

The next year (2013), [we wrote a paper about it](/lemire/blog/2013/11/18/not-all-citations-are-equal-identifying-key-citations-automatically/): [Measuring academic influence: Not all citations are equal](http://arxiv.org/abs/1501.06587) (published by [JASIST in 2015](http://arxiv.org/ct?url=http%3A%2F%2Fdx.doi.org%2F10%252E1002%2Fasi%252E23179&#038;v=fefd61d7)). The work shows that, yes, indeed, machine learning can identify influential references. There is no good reason to consider all citations as having equal weights. We also discussed many of the potential applications such as better rankings for researchers, better paper recommender systems and so forth. And then among others, Valenzuela et al. wrote a follow-up paper, using a lot more data: [Identifying Meaningful Citations](http://allenai.org/content/publications/ValenzuelaHaMeaningfulCitations.pdf).

What gets me really excited is that the idea has now been put in practice: as of this week, Semantic Scholar allows you to browse the references of a paper ranked by how influential the reference was to this particular work. Just [search for a paper](https://www.semanticscholar.org/paper/2749cb94f92170f79d0e8ad266605a871767f38a) and look for the references said to have &ldquo;strongly influenced this paper&rdquo;.

I hope that people will quickly build on the idea. Instead of stupidly counting how often someone has been cited, you should be tracking the work that he has influenced. If you have liked a paper, why not recommend paper that it has strongly influenced?

This is of course only the beginning. If you stop looking at research papers as silly bags of words having some shallow metadata&hellip; and instead throw the full might of machine learning at it&hellip; who knows what is possible!

Whenever people lament that technology is stalling, I just think that they are not very observant. Technology keeps on granting my wishes, one after the other!

__Credit__: I am grateful to Peter Turney for pointing out this feature to me. 

