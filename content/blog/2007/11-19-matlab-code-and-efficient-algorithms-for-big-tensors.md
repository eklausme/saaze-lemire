---
date: "2007-11-19 12:00:00"
title: "Matlab code and efficient algorithms for BIG tensors"
---



Peter released a technical report (available from [arxiv](http://arxiv.org/abs/0711.2023)) on the computation of the Tucker decomposition on large tensors: the Tucker decomposition is just a multidimensional generalization of the [Singular Value Decomposition](https://en.wikipedia.org/wiki/Singular_Value_Decomposition) (SVD). The report includes a new algorithm designed by Peter which is more accurate than competing Matlab implementations, in the case where you have very large tensors (3 or 4 dimensional) and need external memory computations.

There exist [incremental SVD algorithms](http://glaros.dtc.umn.edu/gkhome/fetch/papers/incsvdICCIT02.pdf). It does seem to me that a nice property of Turney&rsquo;s tensor algorithm is that it can be made part of an incremental scheme efficiently.

Another challenge would be to have a serious look at parallel implementations. I think that Turney&rsquo;s scheme could benefit tremendously from several processors.

