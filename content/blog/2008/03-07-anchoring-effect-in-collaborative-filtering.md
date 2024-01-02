---
date: "2008-03-07 12:00:00"
title: "Anchoring effect in collaborative filtering"
---



Wired has an article on Potter, the new [Netflix](http://www.daniel-lemire.com/blog/archives/2007/12/13/netflix-an-interesting-machine-learning-game-but-is-it-good-science/) competitor who took everyone by surprise &mdash; making it at the top of the list all of a sudden, passing off people who worked much longer in the competition. His insight is to correct for anchoring: a user who has recently given a lot of above-average ratings is likely to continue.

I worked on a similar effect back in 2003. Here is what I concluded:

> We show that by normalizing users with respect to the mean, the amplitude, and, possibly, the number of their ratings, we improve accuracy. We stress that the normalization is per user as opposed to per item. ([Scale And Translation Invariant Collaborative Filtering Systems](https://lemire.me/fr/abstracts/IR2003.html), 2005)


Source: [Andre Vellino](https://synthese.wordpress.com/2008/03/06/netflix-prize-article-in-wired/).

