---
date: "2009-04-21 12:00:00"
title: "Quantum databases: what are they good for?"
---



Hu et al. just posted [An efficient quantum search engine on unsorted database](http://arxiv.org/pdf/0904.3060v1.pdf). They refer to an older paper by Patel (2001), Quantum database search can do without sorting. Apparently without any data structure or preprocessing, logarithmic-time search queries are possible in quantum databases.

Even if we did have affordable quantum computers, this would not be a big selling point. Building B-trees or sorting tables is hardly prohibitive.

I would be more interested in how quantum databases can handle low selectivity queries. For example, can a quantum computer sum up a large array of numbers in near-constant time? Our current technology solves these problems with a mix of parallelism, compression and brute-force.

All I know about quantum computers is that we do not think they can solve NP-hard problems in polynomial time. Is there any reason to see a bright future in quantum databases?

