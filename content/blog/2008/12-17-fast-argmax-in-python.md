---
date: "2008-12-17 12:00:00"
title: "Fast argmax in Python"
---



In my post [Computing argmax fast in Python](/lemire/blog/2004/11/25/computing-argmax-fast-in-python/), I reported that Python has no builtin function to compute argmax, the position of a maximal value. I provided one such function and asked people to improve my solution. Here are the results:

argmax function          |running time             |
-------------------------|-------------------------|
array.index(max(array))  |0.1 s                    |
max(izip(array, xrange(len(array))))[1] |0.2 s                    |


__Conclusion__: array.index(max(array)) is simpler and faster.

__Update__: Please see [The language interpreters are the new machines](/lemire/blog/2011/06/14/the-language-interpreters-are-the-new-machines/).

