---
date: "2007-05-31 12:00:00"
title: "The Google Similarity Distance"
---



I read a paper on the [Google Similarity Distance](http://arxiv.org/abs/cs/0412098) this morning by Cilibrasi and Vitanyi. They search for word cooccurrences using the Google search engine. Their formula goes as follows: (G(x,y)-min(G(x,x),G(y,y)))/max(G(x,x),G(y,y)) where G is the &ldquo;Google code&rdquo; function. The Google code function is defined as -log g(x,y) where g(x,y) is the normalized number of web pages containing both term x and term y: the normalization is such that if you sum up g(x,y) over all x,y then you get 1.0. With this simple approach, they seem to be able to translate between English and Spanish, build a thesaurus, and so on. This reminds me a bit of the recent work done by Turney on analogies.

