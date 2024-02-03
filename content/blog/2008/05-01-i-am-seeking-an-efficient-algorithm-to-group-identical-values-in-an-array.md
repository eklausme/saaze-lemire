---
date: "2008-05-01 12:00:00"
title: "Seeking an efficient algorithm to group identical values"
---



In the past, I have had luck with my requests for help, so here is another one.

Suppose you have a large array made of a large number of distinct values ({A,B,A,B,A,C,C}) and you want to group the identical values like so {A,A,A,B,B,C,C} or like so {C,C, A,A,A,B,B}. That is, you do not care about the order, you just want identical values to be clustered. How do you do it?

- You could sort the array assuming that there is an ordering between the objects. There are highly efficient external-memory sorting routines. They mostly rely on sequential IO and are amazingly fast.
- You can build a hash table. Because it is a linear time operation, for very large arrays, it should be faster than sorting, in theory. However, the catch is that external-memory hash tables are not very efficient because they rely on random IO and are prone to cache misses. Remember kids that 100&nbsp;<em>n</em> > _n_ log&nbsp;<em>n</em> despite what your math. teacher taught you.
- We can mix hashing and sorting. Scan the array, and randomly hash each value into one of L bins. You know that if the value x appears in bin i, then all values x are in the same bin. So, you can simply sort each bin and concatenate the bins in O(n log&nbsp;n/L) time, assuming your hashing is <em>good enough</em>. 
- One last possible trick might be to adapt fast duplicate detection algorithms such as the Teuhola-Wegner algorithm: J. Teuhola, L. Wegner, [Minimal space, average linear time duplicate deletion](http://dl.acm.org/citation.cfm?id=102868.102872), Communications of the ACM, 1991.


So, what do you think?

