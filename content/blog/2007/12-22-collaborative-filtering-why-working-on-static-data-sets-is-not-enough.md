---
date: "2007-12-22 12:00:00"
title: "Collaborative Filtering: Why working on static data sets is not enough"
---



As a scientist, it is important to question your assumptions. So far, most of the hard Computer Science research on [collaborative filtering](https://en.wikipedia.org/wiki/Collaborative_filtering) has used static data sets such as [Netflix](http://www.daniel-lemire.com/blog/archives/2007/12/21/how-to-win-the-netflix-1000000-prize/). Specifically, __it is assumed that the recommender systems do not impact the ratings and what items get rated__. A related assumption is that polls do not change how people vote (thanks to [Peter](http://www.apperceptual.com/) for this observation).

Yet, [people&rsquo;s preferences are often constructed in the process of elicitation](https://www.amazon.com/exec/obidos/ASIN/0521542200/decisionscien-20/104-8898607-1607167?%5Fencoding=UTF8&#038;camp=1789&#038;link%5Fcode=xm2). That is, collaborative filtering is a nonlinear problem: ratings feed into the recommender system which helps to determine what people rate, which, in turn, feeds back into the recommender system&hellip;

How could a researcher take this into account? It would be too expensive to try to simulate e-commerce sites with volunteers. We need to submit simulated users to a recommender system. The usefulness of the recommendations is a tricky thing to measure and cross-validation errors are probably not what you want to study exclusively, [diversity](http://digital.mit.edu/wise2006/papers/5A-1_Recommendations%20WISE%20Sep%2008.pdf) might be an important factor too.

__Note 1__: If someone out there know how to simulate users (something I do not know how to do), please get in touch! I have no idea how to do sane user modelling and I need help!

__Note 2__: Peter also once pointed me to the [Iterated Prisoner&rsquo;s Dilemma](https://en.wikipedia.org/wiki/Iterated_Prisoners_Dilemma) problem as something related.

