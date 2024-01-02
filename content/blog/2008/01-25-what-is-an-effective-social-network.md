---
date: "2008-01-25 12:00:00"
title: "What is an effective social network?"
---



Many democratic systems require vote diversity. You __do not__ get elected prime minister of Canada by rallying the largest number of voters. You also need to have your votes spread out over several regions.

Similarly, Scott Karp argues that completely open social networks fail. He takes two examples: [Digg](https://en.wikipedia.org/wiki/Digg) and [Wikipedia](https://en.wikipedia.org/wiki/Wikipedia). 

Digg recommends web sites based on user votes. They recently modified their algorithm: 

> The algorithm change effectively holds back from the homepage any story that is Dugg by the same groups of friends, i.e. a group that is not â€œdiverse,â€ (&hellip;)


As for wikipedia, Karp points out that it is not a really open system since a group of editors have a great deal of control.

 [Stephen Downes asks an interesting question](https://halfanhour.blogspot.com/2008/01/failure-of-completely-open-networks.html): what constraints make a network effective?

> The <em>wisdom of crowds</em> is not obtained by mere voting. What is required &mdash; as the new Digg algorithm explicitly recognizes &mdash; is diversity.


I would like to formalize this problem. You are given a set of users and their votes on several issues as in the [Digg](https://en.wikipedia.org/wiki/Digg) community. You are not given out explicitly what the cliques &mdash; or set of friends &mdash; are. Is there a canonical way to take into account diversity when counting votes?

