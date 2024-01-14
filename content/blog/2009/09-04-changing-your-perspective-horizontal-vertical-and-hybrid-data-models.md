---
date: "2009-09-04 12:00:00"
title: "Changing your perspective: horizontal, vertical and hybrid data models"
---



Data has natural layouts:

- text is written from the first to the last word,
- database tables are written one row at a time,
- Google presents results one document at a time,
- the early recommender systems compared users to other users,
- discussions are organized in newsgroups and posting boards by topic,
- research papers are organized in journals and conferences,
- objects have attributes (a ball is red), and from these attributes we determine similarities between objects.


Using a database terminology, these are _horizontal_ layouts.

We can rotate these models to create vertical layouts:

- Instead of writing text sequentially, we can store the locations of each word in an [inverted index](https://en.wikipedia.org/wiki/Inverted_index).
- Instead of writing database tables row-by-row (e.g., Oracle, MySQL), we can write databases [column by column](https://en.wikipedia.org/wiki/Column-oriented_DBMS) (e.g., [C-Store](https://en.wikipedia.org/wiki/C-store)/[Vertica](https://en.wikipedia.org/wiki/Vertica), [LucidDB](https://en.wikipedia.org/wiki/LucidDB), [Sybase IQ](https://en.wikipedia.org/wiki/Sybase_IQ), and my [Lemur Bitmap Index Library](https://github.com/lemire/ewahboolarray)).
- Instead of presenting results sets one document at a time, we present [tag clouds](https://en.wikipedia.org/wiki/Tag_clouds) and use [faceted search](https://en.wikipedia.org/wiki/Faceted_search) to support exploration. Thus, instead of listing documents, [we focus on attributes](http://arxiv.org/abs/0905.2657) (date, topic, author).
- Recommender systems are often more scalable when they compare items instead of users: the most famous example is [Greg Linden](https://glinden.blogspot.com/)&lsquo;s Amazon recommender (if you liked this book, you may like&hellip;). For example, the [Slope One algorithms](https://en.wikipedia.org/wiki/Slope_One) outperform many user-to-user algorithms.
- The social web started out with topic-oriented newsgroups and posting boards, but it is not dominated by user-centric blogs and social sites (such as Facebook or Twitter). Since then, we have realized that user-oriented blogs can be preferable.
- While research papers are published in conferences and journals, I argue that we should turn this around and [organize research papers by author](/lemire/blog/2009/09/02/author-centric/) through author-specific feeds.
- Some AI researchers are suggesting that relations might be primary whereas attributes would be secondary.

Many of the best solutions are hybrids. For example, text search sometimes require full-text indexes such as [suffix arrays](https://en.wikipedia.org/wiki/Suffix_array) and Oracle [recently announced a row/column hybrid](http://www.dbms2.com/2009/09/03/oracle-11g-exadata-hybrid-columnar-compression/).

> __Take away message____:__ If you are stuck, try to rotate your data model. If neither the vertical nor the horizontal model is a good fit, create an hybrid.



