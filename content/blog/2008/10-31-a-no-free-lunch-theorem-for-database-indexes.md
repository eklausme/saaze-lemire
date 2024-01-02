---
date: "2008-10-31 12:00:00"
title: "A no free lunch theorem for database indexes?"
---



As a trained mathematician, I like to pull back and ask what are the fundamental limitations I face. 

A common misconception in our Google-era is that database performance is a technical matter easily fixed by throwing enough hardware at the problem. We apparently face no fundamental limitation. To a large extend, this statement is correct. Thanks to the [B-tree](https://en.wikipedia.org/wiki/B-tree) and related data structures, we can search for most things very quickly. Roughly, the database problems are solved, as long as you consider only a specific type of queries: queries targeting only a small subset of your data.

What if you want to consider more general queries? Can you hope to find a magical database index that solves all your problems?

I spent part of my morning looking for a [No Free Lunch (NFL) theorem](https://en.wikipedia.org/wiki/No_free_lunch_theorem) for database indexes. I would like to propose one:

> Any two database indexes are equivalent when their performance is average across all possible content and queries. (Naturally, it is ill-posed.)


I draw your attention to how limited your interaction with tools that produce aggregates, such as [Google Analytics](https://www.google.com/analytics/), are. Basically, you navigate through precomputed data. You may not realize it, but the tool does not let you craft your own queries. [Jim Gray](https://en.wikipedia.org/wiki/Jim_Gray_(computer_scientist)) taught us to push these techniques further with structures such as the [data cube](https://en.wikipedia.org/wiki/OLAP_cube) (which wikipedia insists on calling an OLAP cube). However, precomputation is just a particular form of indexing. It helps tremendously when the queries take a particular form, but when you average over all possible queries, it is unhelpful.

What if you want to consider general queries, and still get fast results? Then you have to assume something about your data. I suggest you assume that your data is highly compressible. [Run-length encoding](http://arxiv.org/abs/0808.2083) has been shown to help database queries tremendously.

Short of these two types of assumptions (specific queries or specific data sets), the only way you can improve the current indexes is by constant factors&#8212;you can double the performance of existing B-tree indexes, maybe. Or else, you can throw in more CPUs, more disks, and more memory. 

For now, I will stick with my puny computers, and I will assume that the data is highly compressible. It seems to work well in real life.

