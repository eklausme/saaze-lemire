---
date: "2008-08-20 12:00:00"
title: "The mythical bitmap index"
---



A bitmap index is a popular data structure to speed up the retrieval of matching rows in a table. (It is also used in Information Retrieval, to retrieve matching words.)

Building a [bitmap index](https://en.wikipedia.org/wiki/Bitmap_index) is not hard. You match each possible value with a vector of bits. When the value occur, you insert the value &ldquo;true&rdquo; in the vector, otherwise you insert the value &ldquo;false&rdquo;. Hence, you get a set of vectors containing binary values. To find out when a particular value occur, you just load up the corresponding vector of bits. (You still need a B-tree or a hash table to map values of the corresponding vector.) In practice, programming with (compressed) vector of bits leads to much faster software than working of sets of row IDs.

The size of such a matrix is the number of distinct values times the number of rows. Hence, some people conclude that bitmap indexes are mostly good to index data were we have few distinct values. In fact, the first sentence of the [bitmap index article on wikipedia](https://en.wikipedia.org/wiki/Bitmap_index) tells us that bitmap indexes are meant to index data such as &ldquo;gender&rdquo; were only two values are possible.

Of course, this reasoning is wrong. Why?

Because bitmap indexes (the big matrix of zeroes and ones) are never stored uncompressed. You always manipulate them in compressed form.

How big is the compressed matrix? Let us see. By [run-length encoding](https://en.wikipedia.org/wiki/Run-length_encoding) (RLE), the simplest compression algorithm I know, each vector of bits has a compressed size at most proportional to the number of occurrences of the corresponding value. If you sum it up, __you have that the compressed size of a bitmap index is at most proportional to the size of your table__! __Irrespective of the number of distinct values!__

For a wide range of decision-support applications, bitmap indexes can match or surpass the performance of most indexes, irrespective of the number of distinct values.

You don&rsquo;t believe me? Read these [benchmarks](http://www.oracle.com/technetwork/articles/sharma-indexes-093638.html) using an Oracle database: &ldquo;In summary, bitmap indexes are best suited for [DSS](https://en.wikipedia.org/wiki/Decision_support_system) regardless of cardinality (&hellip;)&rdquo;.

With my very own [bitmap index library](https://github.com/lemire/ewahboolarray), I have scaled up to hundreds of millions of attribute values without a problem and tables having several gigabytes of data. And my budget is not comparable to Oracle (I have one developer, me).

I am not saying that bitmap indexes are always the best solution. Of course not! But there is no published evidence that the number of distinct values is a practical criterion.

Then why does the bitmap index article on wikipedia suggests otherwise? Because it is all over the blogosphere and posting boards&hellip; because when I tried to fix the wikipedia article, my changes got reverted. So, I post my rebuttal here. If you have practical evidence that bitmap indexes mostly work well when you have 2-3 attribute values, let us see it. Otherwise, help me kill this myth!

__Further reading__:

- Daniel Lemire, Owen Kaser, Kamel Aouiche, [Sorting improves word-aligned bitmap indexes](http://arxiv.org/abs/0901.3751). Data &#038; Knowledge Engineering 69 (1), pages 3-28, 2010. 
- [When is a bitmap faster than an integer list?](/lemire/blog/2012/10/23/when-is-a-bitmap-faster-than-an-integer-list/)
- [JavaEWAH](https://code.google.com/p/javaewah/): a compressed bitmap library in Java


