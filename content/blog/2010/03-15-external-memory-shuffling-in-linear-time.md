---
date: "2010-03-15 12:00:00"
title: "External-memory shuffling in linear time?"
---



You can sort [large files while using little memory](https://en.wikipedia.org/wiki/External_sorting). The [Unix ](http://www.gnu.org/software/coreutils/manual/html_node/sort-invocation.html)<tt>[sort](http://www.gnu.org/software/coreutils/manual/html_node/sort-invocation.html)</tt> tool is a widely available implementation of this idea. Files are written to disk sequentially, without random access. Thus, you can also sort variable-length records, such as lines of text.

What about shuffling? Using the [Fisher-Yates algorithm](https://en.wikipedia.org/wiki/Fisher%E2%80%93Yates_shuffle) also known as Knuth algorithm, you can shuffle large files while using almost no memory. But you need [random access](https://en.wikipedia.org/wiki/Random_access) to your files. Thus it is not applicable to variable-length records. And indeed, the Unix `sort` command cannot shuffle. (It has a random-sort option, but it is not a shuffle. Meanwhile, the <a href="http://www.gnu.org/software/coreutils/manual/html_node/shuf-invocation.html#shuf-invocation"><tt>shuf</tt></a> command runs in RAM.)

__A solution:__ Tag each record with a random number. Pick random numbers from a very large set so that the probability that any two lines have the same random number is small. Then use external-memory sorting. You can implement something similar as [a single line in Unix](http://www.daniel-lemire.com/blog/archives/2008/02/13/external-memory-shuffles/).

__A better solution?__ Shuffling is possible in linear time O(<em>n</em>). Sorting is a harder problem (in <em>O</em>(<em>n</em> log <em>n</em>)). Thus, using a sort algorithm for shufflin as we just did is inelegant. Can we shuffle in linear time without random access with variable-length records?

Maybe we could try something concrete? Consider this algorithm:

- Create N temporary files, choose N large enough so that your entire set divided by N is likely to fit in RAM.
- Assign each string to one temporary file at random.
- Shuffle the temporary files in RAM.
- Concatenate the temporary files.


Something similar was described by P. Sanders in [Random Permutations on Distributed, External and Hierarchical Memory](http://www.mpi-inf.mpg.de/~sanders/papers/randperm.ps.gz) (Information Processing Letters, 1998). See also the earlier work by Sandelius (A simple randomization procedure, 1962) as well as Rao (Generation of random permutation of given number of elements using random sampling numbers, 1961).

