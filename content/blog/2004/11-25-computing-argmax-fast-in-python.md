---
date: "2004-11-25 12:00:00"
title: "Computing argmax fast in Python"
---



__Update__: see [Fast argmax in Python](/lemire/blog/2008/12/17/fast-argmax-in-python/) for the final word.

Python doesn&rsquo;t come with an argmax function built-in. That is, a function that tells you where a maximum is in an array. And I keep needing to write my own argmax function so I&rsquo;m getting better and better at it. Here&rsquo;s the best I could come up with so far:

<code>from itertools import izip<br/>
argmax = lambda array: max(izip(array, xrange(len(array))))[1]<br/>
</code>

The really nice thing about izip and xrange is that they don&rsquo;t actually output arrays, but only lazy iterators. You also have plenty of similar functions such as imap or ifilter. Very neat.

Here&rsquo;s a challenge to you: can you do better? That is, can you write a faster, less memory hungry function? If not, did I find the optimal solution? If so, do I get some kind of prize?

Next, suppose you want to find argmax, but excluding some set of bad indexes, you can do it this way&hellip;

<code>from itertools import izip<br/>
argmaxbad = lambda array,badindexes: max(ifilter(lambda t: t[1] not in badindexes,izip(array, xrange(len(array)))))[1]<br/>
</code>

Python is amazingly easy.

As a side-note, you can also do intersections and union of sets in Python in a similar (functional) spirit:<br/>
<code>def intersection(set1,set2): return filter(lambda s:s in set2,set1)<br/>
def union(set1, set2): return set1 + filter(lambda s:s not in set1, set2)<br/>
</code>

__Update__: you can do the same things with hash tables:<br/>
<code>max(izip(hashtable[max].itervalues(), hashtable[max].iterkeys()))[1]</code>

