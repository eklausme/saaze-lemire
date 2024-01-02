---
date: "2020-03-15 12:00:00"
title: "Number of atoms in the universe versus floating-point values"
---



<a href="https://en.wikipedia.org/wiki/Observable_universe#Matter_content_–_number_of_atoms">It is estimated that there are about 10<sup>80</sup> atoms in the universe.</a> The estimate for the [total number of electrons is similar](https://en.wikipedia.org/wiki/Eddington_number).

It is a huge number and it far exceeds the maximal value of a single-precision floating-point type in our current computers (which is about 10<sup>38</sup>).

Yet the maximal value that we can represent using the common double-precision floating-point type is larger than 10<sup>308</sup>. It is an unimaginable large number. There will never be any piece of engineering involving as many as 10<sup>308</sup> parts.

Using a double-precision floating-point value, we can represent easily the number of atoms in the universe. We could also represent the number of ways you can pick any three individual atoms at random in the universe.

If your software ever produces a number so large that it will not fit in a double-precision floating-point value, chances are good that you have a bug.




__Further reading__: Lloyd N. Trefethen, [Numerical Analysis](https://people.maths.ox.ac.uk/trefethen/NAessay.pdf), Princeton Companion to Mathematics, 2008

&nbsp;




