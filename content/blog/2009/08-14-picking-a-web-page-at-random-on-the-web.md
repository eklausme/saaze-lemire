---
date: "2009-08-14 12:00:00"
title: "Picking a web page at random on the Web"
---



To do statistics over the Web, we need samples. Thus, I want to know how to pick a Web page at random, without making much effort. If you are Google or Microsoft, it is easy. But what about the rest of us? And what if I want to pick users at random on Facebook?

In effect, I want to sample a virtually infinite data set: I consider the Web to be infinite because I cannot enumerate all elements in it. Given finite resources against an infinite data set, can I sample fairly?

Thankfully, the objects in this set are __linked__ and __indexed__. Hence, I came up with two sampling strategies:

- __Using the hyperlinks:__ Start with any Web page. Recursively follow hyperlinks until you have many Web pages. Pick a page at random in this set. (Mathematically, I am sampling nodes in an infinite graph.)
- __Using the index:__ Sampling items Pick a set of common words, enter them into a search engine. Pick a page at random in the result set.


Are there any other strategies? What can I say (if anything) about the biases of my sampling?

__Further reading__: Benoit, D. and Slauenwhite, D. and Schofield, N. and Trudel, A., [World&rsquo;s First Class C Web Census: The First Step in a Complete Census of the Web](http://www.academypublisher.com/jnw/vol02/no02/jnw02024556.pdf), Journal of Networks 2 (2), 2007.

__Update__: An anonymous reader points me to Ziv Bar-Yossef and Maxim Gurevich, [Random sampling from a search engine&rsquo;s index](http://portal.acm.org/citation.cfm?id=1411509.1411514), JACM 55 (5), 2008.

__Update 2__: [Chris Brew](http://www.ling.ohio-state.edu/~cbrew/index.html) points me to Henzinger et al., [On Near-Uniform URL Sampling](http://www9.org/w9cdrom/88/88.html), WWW 2000.

__Update 3__: Regarding Facebook, I found Gjoka et al., [Unbiased Sampling of Facebook](http://arxiv.org/pdf/0906.0060), 2009.

