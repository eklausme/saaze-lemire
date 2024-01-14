---
date: "2008-08-18 12:00:00"
title: "Back from vacations"
---



I took some time off this year. No, we did not go anywhere specific. I just took two weeks off with my two sons. We had fun.
It has been years since I took time totally off. For irrational reasons, I would always keep my research going at a reduced rate during my time off. Not this year! I was 100% with my family&hellip; most of the time.

There still were a few exceptions. For example, DOLAP 2008 accepted our [bitmap-index paper](http://arxiv.org/abs/0808.2083) and we had to revise the paper within a few days. I really like this paper.
The problem we work on is simple: improve the compression and speed of bitmap indexes by row reordering. A bitmap index is a like a binary matrix with millions or billions of rows. Each column is compressed using a variant of [run-length encoding](https://en.wikipedia.org/wiki/Run-length_encoding). At query-time, the you load a few columns and apply logical operations (AND/OR) between them. Better compression translates into a faster index because the time required to perform logical operations over bitmaps is proportional to their compressed size. Finding the optimal row order is NP-hard.
A simple heuristic is to lexicographically sort the rows. It works surprisingly well. Fancier heuristics work slightly better. There are limits to how sophisticated your heuristic can get, however, since you need to scale to billions of rows. Fancy graph algorithms are out (as far as I can tell). (Processing the data in small blocks without merging does not work well.) The gist of our paper is that it is very difficult to predict which heuristic will work best, even with simple synthetic data. It was a difficult paper to write, and I am happy that the reviewers did not dismiss it since it breaks the traditional &ldquo;A is better than B&rdquo; research model. What our paper establishes is that it is a deeper problem than you might think at first. Fortunately, there are still a few elegant conclusions we came to.

Ok. Enough about research. Here is my youngest son on a poney:

<img decoding="async" src="https://lh3.ggpht.com/nathalie.lampron/SJzw3K-6C8I/AAAAAAAAAfM/90Jnm5KNkMY/P1010090.JPG?imgmax=512" />

