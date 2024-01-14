---
date: "2006-06-29 12:00:00"
title: "Geometric Wavelets"
---



Ah! Just learned about [Geometric Wavelets](https://scholar.google.com/scholar?hl=en&#038;lr=&#038;c2coff=1&#038;q=%22geometric+wavelets%22). Most recent work on wavelets as been very uninspiring to me, but this is pretty good. Seems it has been around for a number of years (most recent paper I can see is Le Pennec and Mallat in 2000).

The idea is simple, but I only saw one talk about it, so don&rsquo;t take my word for it, read the papers.
Take a function f(x) over any (convex) region S. The function is approximated by some polynomial (of fixed degree), call it p(x). Split the region exactly in two by a straight line, so that the two remaining regions S1 and S2 are still convex. Over each subregions, by regression, solve for the polynomials (of fixed degree) p1(x) and p2(x) approximating f(x). Optimize the splitting so that the approximation error made by p1 and p2 is minimal. Then your two new wavelets are the polynomials p(x)-p1(x) and p(x)-p2(x) limited to S1 and S2 respectively. These wavelets are not continuous, but if f(x) is itself a polynomial (up to a fixed degree), then the wavelets vanish. Repeat this splitting for as long as you need to.

The gist of the result is that you can do state-of-the-art image compression. This is surprising because the wavelets are rather complex and difficult to encode especially if you consider that encoding their support region is no joke. The key point is that you can define the region over which each wavelet is defined simply by encoding the various splitting lines, and that&rsquo;s an easier problem than encoding polygonal regions from scratch.

I strongly suspect that these algorithms are not practical though. They use up too many CPU cycles to save up on bandwidth and storage space in a world where storage is infinite but CPU cycles are comparatively more expensive. But the idea is neat!

