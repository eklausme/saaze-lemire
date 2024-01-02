---
date: "2009-11-12 12:00:00"
title: "Which should you pick: a bitmap index or a B-tree?"
---



Morteza Zaker sent me pointer to their work comparing bitmap indexes and B-trees in the Oracle database. They examine the folklore surrounding bitmap indexesâ€”which are often thought to be mostly useful over low cardinality columns (columns having few distinct values, such as <em>gender</em>). Their conclusion is that <em>__the Bitmap index is the conclusive choice for data warehouse design for columns with high or low cardinality__</em>. Their claim is backed by experiments using columns with millions of distinct values. This confirms the observation made in my earlier post: [The mythical bitmap index](/lemire/blog/2008/08/20/the-mythical-bitmap-index/).

They make an interesting distinction between full cardinality columns, columns where each value appears only once, and high cardinality columns where at least a few values are often repeated (think about storing last names). A __bitmap index is inadequate for a full cardinality column__ because there is no compression possible, and this is probably how the folklore around bitmap indexes came about. Yet, unlike transaction processing, data warehousing is usually not concerned with full cardinality columns.

__Reference__: Zaker et al., [An Adequate Design for Large Data Warehouse Systems: Bitmap Index Versus B-Tree Index](http://www.universitypress.org.uk/journals/cc/cc-21.pdf), IJCC 2 (2), 2008.

__Further reading__: [Trading compression for speed with vectorization](/lemire/blog/2009/08/28/trading-compression-for-speed-with-vectorization/), [To improve your indexes: sort your tables!](/lemire/blog/2008/11/11/to-improve-your-indexes-sort-your-tables/) and my research paper [Sorting improves word-aligned bitmap indexes](http://arxiv.org/abs/0901.3751).

