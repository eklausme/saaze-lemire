---
date: "2009-07-03 12:00:00"
title: "Column stores and row stores: should you care?"
---



Most database users know row-oriented databases such as Oracle or MySQL. In such engines, the data is organized by rows. Database researcher and guru [Michael Stonebraker](https://en.wikipedia.org/wiki/Michael_Stonebraker) has been advocating column-oriented databases. The idea is quite simple: by organizing the data into columns, we can compress it more efficiently (using simple ideas like [run-length encoding](https://en.wikipedia.org/wiki/Run-length_encoding)). He even founded a company, [Vertica](http://www.vertica.com/), to sell this idea.

Daniel Tunkelang is [back from SIGMOD](http://thenoisychannel.com/2009/07/02/the-wild-world-of-sigmod/): he reports that column-oriented databases have grabbed much mindshare. While I did not attend SIGMOD, I am not surprised. [Daniel Abadi](http://cs-www.cs.yale.edu/homes/dna/) was awarded the 2008 SIGMOD Jim Gray Doctoral Dissertation Award for his excellent thesis on Column-Oriented Database Systems. Such great work supported by influential people such as Stonebraker is likely to get people talking.

But are column-oriented databases the __next big thing__? No.

- Column stores have been around for a long time in the form of bitmap and projection indexes. Conceptually, there is little difference. (See my [own work on bitmap indexes](http://arxiv.org/abs/0901.3751).)
- While it is trivial to change or delete a row in a row-oriented database, it is harder in column-oriented databases. Hence, applications are limited to data warehousing.
- Column-oriented databases are faster for some applications. Sometimes faster by two orders of magnitude, especially on low selectivity queries. Yet, part of these gains are due to the recent evolution in our hardware. Hardware configurations where reading data sequentially is very cheap favor sequential organization of the data such as column stores. What might happen in the world of storage and microprocessors in the next ten years?


I believe Nicolas Bruno said it best in [Teaching an Old Elephant New Tricks](http://research.microsoft.com/apps/pubs/default.aspx?id=74156):

> (&hellip;) some C-store proponents argue that C-stores are fundamentally dif<span>ferent from traditional engines, and therefore their beneï¬ts cannot<span> be incorporated into a relational engine short of a complete<span> </span>rewrite<span> (&hellip;) we (&hellip;) show that many of the<span> beneï¬ts of C-stores can indeed be simulated in traditional engines<span> with no changes whatsoever.  Finally, we predict that traditional relational engines will<span> eventually leverage most of the beneï¬ts of C-stores natively, as is<span> currently happening in other domains such as XML data.<span> </span></span></span></span></span></span></span></span>


That is not to say that you should avoid Vertica&rsquo;s products or do research on column-oriented databases. However, do not bet your career on them. The hype will not last.

(For a contrarian point of view, read Adabi and Madden&rsquo;s blog post on why column stores are fundamentally superior.)

