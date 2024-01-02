---
date: "2008-11-21 12:00:00"
title: "Recommender systems: where are we headed?"
---



Daniel Tunkelang [comments](http://thenoisychannel.com/2008/11/21/the-napoleon-dynamite-problem) on the recent progress in collaborative filtering:

> (&hellip;) the machine learning community, much like the information retrieval community, generally prefers black box approaches, (&hellip;) If the goal is to optimize one-shot recommendations, they are probably right. But I maintain that the process of picking a movie, like most information seeking tasks, is inherently interactive, (&hellip;)


I disagree with him. Even for non-interactive recommendations, the Machine Learning community is off-track for two reasons:

- They fail to take into account diversity. In Information Retrieval, we know that if precision is high (all documents are relevant) but recall is low (few of the relevant documents are presented), then the system is poor. There is no such balance in collaborative filtering. Precision above all else is the goal. This is wrong. [Diversity metrics must be used](/lemire/blog/2008/11/14/measuring-the-diversity-of-recommended-lists-at-last/).
- They work over static data sets. A system like Netflix is not static and so, accuracy on a static data set might be a good predictor for real-world performance. The problem is intrinsically nonlinear. People will rate different items, and they will rate differently, if you change the recommender system. The feedback loop may work against you or in your favour. The effect might be large or small. As far as I can tell, I am [the only one](http://www.daniel-lemire.com/blog/archives/2007/12/22/collaborative-filtering-why-working-on-static-data-sets-is-not-enough/) who keep pointing out this fundamental, but never addressed limitation of working over static data sets. __Update: This has absolutely nothing to do with online versus batch algorithms.__


See also my post [Netflix: an interesting Machine Learning game, but is it good science?](http://www.daniel-lemire.com/blog/archives/2007/12/13/netflix-an-interesting-machine-learning-game-but-is-it-good-science/)

__Note__: I organized the ACM KDD [Workshop on Large-Scale Recommender Systems and the Netflix Prize Competition](http://netflixkddworkshop2008.info/pc.html) along with people like Yehuda Koren. Yahuda is among the candidates to win the Netflix prize. I do not oppose the Netflix competition. I just do not think that it will solve our big problems.

