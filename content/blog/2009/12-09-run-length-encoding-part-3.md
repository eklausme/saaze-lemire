---
date: "2009-12-09 12:00:00"
title: "Run-length encoding (part 3)"
---



In [Run-length encoding (part 1)](/lemire/blog/2009/11/24/run-length-encoding-part-i/), I presented the various run-length encoding formats. In [part 2](/lemire/blog/2009/11/27/run-length-encoding-part-2/), I discussed the coding of the counters. In this third part, I want to discuss the ordering of the elements.

Indeed, the compression efficiency of run-length encoding depends on the ordering. For example, the sequence `aaabbb` is far more compressible than the sequence <tt>ababab</tt>.

__Reordering sequences__

Text, images, and sound are stored on disk as strings. Intuitively, we may think that strings cannot be reordered without losing information. But this intuition is wrong!

You can reorder strings without losing any information, as long as the reordering is [invertible](https://en.wikipedia.org/wiki/Inverse_function). The [Burrowsâ€“Wheeler](https://en.wikipedia.org/wiki/Burrows%E2%80%93Wheeler_transform) transformâ€”invented in 1994â€”is an invertible transform which tends to generate streams of repeated characters. It is used by the open source [bzip2 software](http://bzip.org/). This invertible reordering trick works so well that bzip2 is &ldquo;within 10% to 15% of the best available techniques, whilst being around twice as fast at compression and six times faster at decompression.&rdquo;

__Ordering sets__

Sometimes we want to compress sets of elements. For example, the ordering of the rows in a relational database is semantically irrelevant. Similarly, in a phone directory, we are not concerned about the order of the entries. Of course, we are trained to expect entries to be sorted lexicographically starting from the last names:

Last name                |First name               |
-------------------------|-------------------------|
Abeck                    |John                     |
Becket                   |Patricia                 |
Smith                    |John                     |
Tucker                   |Patricia                 |


Such sequences of tuples can be compressed column-wise: compress each column with run-length encoding. Reordering the rows so as to maximize compression is NP-hard by reduction from the [Hamiltonian path](https://en.wikipedia.org/wiki/Hamiltonian_path) problem. Moreover, it can be reduced to an instance of the [traveling salesman problem](https://en.wikipedia.org/wiki/Travelling_salesman_problem).

Fortunately, a simple and efficient heuristic is available. Reorder the columns in increasing cardinality: put the columns having the fewest number of distinct values first. Next, sort the table lexicographically.

Applying this heuristic, our previous table becomes:

First name               |Last name                |
-------------------------|-------------------------|
John                     |Abeck                    |
John                     |Smith                    |
Patricia                 |Becket                   |
Patricia                 |Tucker                   |


__Further reading__:
Daniel Lemire and Owen Kaser, [ Reordering Columns for Smaller Indexes](http://arxiv.org/abs/0909.1346), Information Sciences 181 (12), 2011.

Daniel Lemire, Owen Kaser, Eduardo Gutarra, [Reordering Rows for Better Compression: Beyond the Lexicographic Order](http://arxiv.org/abs/1207.2189), ACM Transactions on Database Systems 37 (3), 2012.

