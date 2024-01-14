---
date: "2008-12-31 12:00:00"
title: "What makes recommender systems work?"
---



Why can we predict tastes? There are several possible explanations:

- Intrinsically, individuals have predictable tastes. To test this theory, we would need to isolate each individual. Collect their opinions. Then attempt to make predictions. (You also need to prevent the recommender system from giving feedback to the user!)
- People are influenced by the perceived popularity of items. People tend to like a movie more when they think it is a blockbuster. A  more general statement is: [Preferences are constructed in the process of elicitation](https://www.amazon.com/exec/obidos/ASIN/0521542200/decisionscien-20/104-8898607-1607167?%5Fencoding=UTF8&amp;camp=1789&amp;link%5Fcode=xm2).


Jon Dron linked to a 2007 New York Times article by Duncan J. Watts which [claims](http://www.nytimes.com/2007/04/15/magazine/15wwlnidealab.t.html?_r=4&amp;) that the second factor can easily dominate. The article is based on experiments. However, I have several arguments to support this claim.  Highly cited research papers are often no more interesting than regular papers. Except that you must also cite them, otherwise people will complain that you are missing a reference. The same is true with music or books. I often read novels based because many people read them: that is how, for example, I found [la compagnie des glaces](https://www.amazon.com/compagnie-glaces-ceinture-feu/dp/2265070750/ref=sr_1_1?ie=UTF8&amp;s=books&amp;qid=1230730696&amp;sr=8-1) or Dune.

Hence,  collaborative filtering is a circular process:

- People like certain items (mostly) because they perceive that similar people like them.
- Collaborative filtering matches people with such items.


Of course, that is a bit pessimistic: people are also influenced by the intrinsic values. However, how can you differentiate the social perception from the intrinsic value of an item? Is this novel entertaining, or is it popular? Outside a laboratory, we cannot tell these factors apart!

How well would collaborative filtering work if individuals were isolated? It would work poorly. There are millions of books and research articles. Many are quite good. Without a social component to push us in some directions, we would have diverse tastes.

