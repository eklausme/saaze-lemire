---
date: "2005-10-28 12:00:00"
title: "The average of averages is not the average"
---



A fact that we teach in our OLAP class is that you can&rsquo;t take the average of averages and hope it will match the average. This is a common enough mistake for people working with databases and doing number crunching. It is only true if all of the averages are computed over sets having the same cardinality, otherwise it is false. In fancy terms, the average is not distributive though it is algebraic. This phenomenon has a name: the fact that the average of averages is not the average is an instance of Simpson&rsquo;s Paradox.

Here is an example, consider the following list of numbers:

- 3
- 4
- 6
- 5
- 4.5


The average is 4.5. However, we can split the list in two:<br/>
The average of the first list is 3.5:

- 3
- 4


The average of the second list is approximately 5.2:

- 6
- 5
- 4.5


However, the average of the two average is (5.2 +3.5)/2 which is less than 4.5!

This only works if the two sets have a different number of elements. 

