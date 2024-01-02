---
date: "2008-11-07 12:00:00"
title: "Understanding what makes database indexes work"
---



__Why do database indexes work?__

In a [previous post](http://www.daniel-lemire.com/blog/archives/2008/10/31/a-no-free-lunch-theorem-for-database-indexes/), I explained that only two factors make indexing possible:

- your index expects specific queries
- or you make specific assumptions about the data sets.


In other cases, you are better off just scanning the entire data set.

__What makes database indexes work?__

As far as I know, there are only 6 strategies that make indexes work. By combining them in different ways, we get all of the various existing schemes. (I would love to hear your feedback on this claim!)

<em>1. You expect specific queries: restructure your data! </em>

Suppose you know ahead of time that you will only need to select some of the elements in your data set. Then you can taylor an index for such queries and thus avoid scanning much of the content. For example, an inverted index in full-text search will select which documents contain the various keywords. Instead of working with all documents, you will only worry about the ones matching at least one keyword. Indexing a column with a B-tree or a hash table is another scenario where you try to immediately go to the relevant rows in a table. 

Of course, if I look for all documents containing the words &ldquo;the&rdquo; and &ldquo;will&rdquo;, and want to know how many there are and what is their average length, such a form of indexing will not help.

<em>2. You expect specific queries: materialize them! </em>

Another commonly used strategy is view materialization. If 10% of all visitors on Google type in the word &ldquo;sex&rdquo;, they might as well precompute the result of the query. In Business Intelligence, if you can expect your users to mostly care about results aggregated over weeks, months or years, it makes sense to precompute these values instead of always working from the raw data. Alternatively, you can materialize intermediate elements that are needed to compute your results. For example, even if people do not need data aggregated per day, precomputing it might be useful for computing weekly numbers faster.

This form of indexing tends to work well to address the most popular queries, but it fails when people have more specific needs.

<em>3. You expect specific queries: redundancy is (sometimes) your friend </em>

When you do not know exactly which queries to expect, you can try to index the data in different ways, for different queries. For example, you could both use a B-tree and a hash table, and determine at query time which is the best evaluation strategy. You might even determine that the best way is to forgo the indexes and scan the raw data!

<em>4. Use multiresolution! </em>

Suppose that you look for specific images, but you may still need to scan 50% of them. An index that would point you to only the relevant images might not be effective. Instead, you should try to quickly discard the irrelevant candidates. What you could do is create thumbnails (low resolution images). Then you can dismiss quickly the images that are obviously not a good match. Naturally, you can have progressively finer resolutions. 

Database indexes often bin values together. For example, if you could bin all workers earning between $10,000 and $30,000, then all workers earning between $30,000 and $50,000, and so on. If you are looking for workers earning between $40,000 and $45,000, you can first find all works that are in the $30,000-$50,000 bin, and then look up their actual salaries, one by one. You can adapt the bins either to the data distribution or to the types of queries you expect.

For more examples, see my post [How to speed up retrieval without any index?](http://www.daniel-lemire.com/blog/archives/2008/11/20/how-to-speed-up-retrieval-without-any-index/).

<em>5. Your data is not random: compress it! </em>

Most real-world data is highly compressible. By compressing the data, you can make it so that your CPU and IO subsystem process less data. However, you have to worry about bottlenecks. Too much compression may overload your CPU. Too little compression and most time will be spent in loading the data from disk. Two techniques are often combined to get good results out of compression: sorting and [run-length encoding](https://en.wikipedia.org/wiki/Run-length_encoding). 

<em>6. In any case: optimize your code </em>

You should be using cache-aware and [CPU-aware](http://arxiv.org/abs/0808.2083) indexes. Be aware that comparing two bits together may take nearly as long as comparing two integers. Be aware that jumping all over the place (as in a B-tree) takes longer than processing the data by tiny chunks.

