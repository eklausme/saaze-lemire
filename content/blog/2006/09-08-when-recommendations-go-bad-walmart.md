---
date: "2006-09-08 12:00:00"
title: "When recommendations go bad: Walmart"
---



Through [Bruce Spencer](http://www.cs.unb.ca/~bspencer/), I learned about the Walmart recommendation engine fiasco: people searching for Planet of the Apes were directed to movies about Martin Luther King Jr. Note that Walmart does not seem to use a collaborative filtering engine, but rather uses manually entered association rules, or so they claim. But there has been examples of offensive recommendations before which were based on collaborative filtering.

This brings about a new problem in collaborative filtering and recommender engines: how to avoid offensive recommendations.

This one is tough. What if people who like Martin Luther King movies are more likely to buy porn? It could be. (Please, don&rsquo;t sue me, this is just an academic example.) What happens then?

How is Machine Learning to know that this is not a good association? How do we even know as human beings in the first place?

This is a hard and important problem.

