---
date: "2009-08-28 12:00:00"
title: "Trading compression for speed with vectorization"
---



[Bitmap indexes](https://en.wikipedia.org/wiki/Bitmap_index) are used by search engines (such as [Apache Lucene](http://lucene.apache.org/core/)), they are available in DBMSes such as Oracle and [PostgreSQL](http://www.postgresql.org/). They are used in column stores such as the Open Source engines [Eigenbase](http://www.eigenbase.org/) and [C-Store](http://db.csail.mit.edu/projects/cstore/), as well as by many commercial solutions such as [Vertica](http://www.vertica.com/).

Bitmap indexes are silly data structures. Map each value to an array of booleans. Hence, if you have _n_ rows in your table, and _k_ distinct values, you get an _n_ by _k_ matrix containing booleans. Thus, some people falsely assume that [bitmap indexes are only adequate when there are few distinct values](/lemire/blog/2008/08/20/the-mythical-bitmap-index/) (e.g., the gender column, male and female being the only two options). Howeverâ€”using techniques based on [run-length encoding](https://en.wikipedia.org/wiki/Run-length_encoding)â€”the total size of your bitmaps is proportional to the size of the original table, __irrespective of the number of distinct values__!

Bitmap indexes are fast because they benefit from [vectorization](https://en.wikipedia.org/wiki/Vectorization_(computer_science)). Indeed, let the predicate &ldquo;sex=male&rdquo; is satisfied on rows 1, 5, 32, 45, 54 and 63. I can determine which rows satisfy the extended predicate &ldquo;(sex=male) AND (city=Montreal)&rdquo; using __a single instruction__! The secret? A bitwise AND between the bitmaps &ldquo;sex=male&rdquo; and &ldquo;city=Montreal&rdquo;. You can compute unions, differences and intersections between sets of integers in [1,<em>__N__</em>] using only <em>N</em>/64 operations. All microprocessors have built-in parallelism because they operate on several bits at once.

To benefit from vectorization, you need to store the data in a word-aligned manner: that is, you store consecutive segments of bits uncompressed. The longer the words, the less compression. Roughly speaking, 64-bit bitmap indexes are nearly twice as large as 32-bit bitmap indexes. What is the effect on the processing speed? We found that despite being much larger, 64-bit bitmap indexes were faster. That is right: it was faster to load twice as much data from disk!

Yet, we often equate concise data structures with more speed. This assumption can be misguided. Given a choice between more compression, or more vectorization, I would choose more vectorization.

__References__:

- Daniel Lemire, Owen Kaser, Kamel Aouiche, [Sorting improves word-aligned bitmap indexes](http://arxiv.org/abs/0901.3751), , Data &#038; Knowledge Engineering, Volume 69, Issue 1, 2010, Pages 3-28. ([View it on scribdb](http://www.scribd.com/doc/19186985/Sorting-improves-word-aligned-bitmap-indexes-to-appear-in-Data-Knowledge-Engineering).)
- [Lemur Bitmap Index C++ Library](https://github.com/lemire/ewahboolarray) (open source software library)


__Further reading__: See my posts [Compressed bitmaps in Java](/lemire/blog/2009/02/03/just-published-java-compressed-bitmap-class/), [To improve your indexes: sort your tables!](/lemire/blog/2008/11/11/to-improve-your-indexes-sort-your-tables/), and [The mythical bitmap index](/lemire/blog/2008/08/20/the-mythical-bitmap-index/).

