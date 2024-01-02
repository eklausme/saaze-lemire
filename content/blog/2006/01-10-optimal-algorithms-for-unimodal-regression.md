---
date: "2006-01-10 12:00:00"
title: "Optimal Algorithms for Unimodal Regression"
---



I don&rsquo;t usually post abstracts of papers other than my own here, but this one is particularly significant to me though I don&rsquo;t know the author. 

> 
This paper gives optimal algorithms for determining real-valued univariate unimodal regressions, that is, for determining the optimal regression which is increasing and then decreasing. Such regressions arise in a wide variety of applications. They are a form of shape-constrained nonparametric regression, closely related to isotonic regression. For the L2 metric our algorithm requires only O(n) time for regression on n points, while for the L1 metric it requires O(n logn) time. Previous algorithms only considered the L2 metric and required (n^2) time. All previous algorithms used multiple calls to isotonic regression, and our major contribution is to organize these into a prefix isotonic regression, whereby one computes the regression on all initial segments. The prefix approach utilizes the solution for one initial segment to aid in the solution of the next, which considerably reduces the total time required. Our prefix isotonic regression algorithm for<br/>
the L1 metric also supplies the first O(n log n) algorithm for L1 isotonic regression.


[Source](http://web.eecs.umich.edu/~qstout/pap/IF00unimod.pdf).

