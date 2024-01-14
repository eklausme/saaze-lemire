---
date: "2009-09-16 12:00:00"
title: "Relational databases: are they obsolete?"
---



[Michael Stonebraker](https://en.wikipedia.org/wiki/Michael_Stonebraker) is [predicting](http://storagemojo.com/2009/09/14/rdbms-going-like-mainframes/) that the dominance of the generic relational database is coming to an end. Having recently founded several database companies, he has a vested interested in this prediction .

Here is Stonebraker logic: we can outperform relational databases with specialized solutions. Therefore, users will migrate to specialized engines. In effect, specialized players such as [Vertica](http://www.vertica.com/) will grab market shares from Oracle Database and Microsoft SQL Server.

Unfortunately, Stonebraker&rsquo;s arguments are misleading. As far as performance is concerned, Stonebraker is obviously right: we are undergoing major changes. As [pointed out by Daniel Tunkelang](http://thenoisychannel.com/2009/08/29/free-as-in-freebase), you can store a lot of data in 32GB of RAM. [Solid-state drives](/lemire/blog/2008/02/02/random-write-performance-in-solid-state-drives/) can be used to wipe out some IO bottlenecks. Yet, these technological changes will not change the game for two reasons:

- __We have always been able to outperform generic relational databases__: (1) column stores have been around since the seventies when they were called transposed files (2) search engines have always used their own indexes (3) lightweight key-value engines like [Tokyo Cabinet](http://1978th.net/tokyocabinet/) have always been around. Generic relational databases did not achieve dominance due to their superior performance.
- __Generic relational databases are frequently catching up to specialized engines.__ In particular, they are not limited to row stores. [Curt Monash&rsquo;s blog post](http://www.dbms2.com/2009/09/03/oracle-11g-exadata-hybrid-columnar-compression/) on Oracle&rsquo;s hybrid columnar approach makes this obvious. Nicolas Bruno, in [Teaching an Old Elephant New Tricks](http://research.microsoft.com/apps/pubs/default.aspx?id=74156), predicted that the lessons learned by start-ups such as Vertica will be integrated into traditional relational engines.


__Further reading__: I was motivated by the latest [StorageMojo blog post](http://storagemojo.com/2009/09/14/rdbms-going-like-mainframes/). See also my blog posts [Trading compression for speed with vectorization](/lemire/blog/2009/08/28/trading-compression-for-speed-with-vectorization/), [Changing your perspective: horizontal, vertical and hybrid data models](/lemire/blog/2009/09/04/changing-your-perspective-horizontal-vertical-and-hybrid-data-models/), [Column stores and row stores: should you care?](/lemire/blog/2009/07/03/column-stores-and-row-stores-should-you-care/) and [Native XML databases: have they taken the world over yet?](/lemire/blog/2008/12/04/native-xml-databases-have-they-taken-the-world-over-yet/)

