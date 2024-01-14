---
date: "2010-06-28 12:00:00"
title: "NoSQL or NoJoin?"
---



Several major players built alternatives to conventional database systems: Google created [BigTable](https://en.wikipedia.org/wiki/BigTable), Amazon built [Dynamo](https://en.wikipedia.org/wiki/Dynamo_(storage_system)) and Facebook initiated [Cassandra](https://en.wikipedia.org/wiki/Apache_Cassandra). There are many other comparable open source initiatives such as [CouchDB](https://en.wikipedia.org/wiki/CouchDB) and [MongoDB](https://en.wikipedia.org/wiki/MongoDB). These systems are part of a trend called [NoSQL](https://en.wikipedia.org/wiki/Nosql) because it is not centered around the [SQL](https://en.wikipedia.org/wiki/Sql) language. While there has always been non SQL-based database systems, the rising popularity of these alternatives in industry is drawing attention.

In [The &ldquo;NoSQL&rdquo; Discussion has Nothing to Do With SQL](http://cacm.acm.org/blogs/blog-cacm/50678-the-nosql-discussion-has-nothing-to-do-with-sql/fulltext), Stonebraker opposes the [NoSQL trend](https://en.wikipedia.org/wiki/Nosql) in those terms:

> (&hellip;) blinding performance depends on removing overhead. Such overhead has nothing to do with SQL, but instead revolves around traditional implementations of ACID transactions, multi-threading, and disk management.


In effect, Stonebraker says that all of the benefits of the NoSQL systems have nothing to do with ditching the SQL language. Of course, because the current breed of SQL is Turing complete, it is difficult to argue against SQL at the formal level. In theory, all Turing complete languages are interchangeable. You can do everything (bad and good) in SQL.

However, in practice, SQL is based on joins and related low-level issues like foreign keys. SQL entices people to [normalize their data](https://en.wikipedia.org/wiki/Database_normalization). Normalization fragments databases into smaller tables which is great for data integrity and beneficial for some [transactional systems](https://en.wikipedia.org/wiki/Database_transaction#Transactional_databases). However, joins are expensive. Moreover, joins require strong consistency and fixed schemas.

In turn, avoiding join operations makes it possible to maintain flexible or informal schemas, and to [scale horizontally](https://en.wikipedia.org/wiki/Scalability#Scale_horizontally_.28scale_out.29). Thus, the NoSQL solutions should really be called NoJoin because they are mostly defined by avoidance of the [join operation](https://en.wikipedia.org/wiki/Join_(SQL)).

How do we compute joins? There are two main techniques :

- When dealing with large tables, you may prefer the [sort merge](https://en.wikipedia.org/wiki/Sort-merge_join) algorithm. Because it requires sorting tables, it runs in <em>O</em>(<em>n</em> log <em>n</em>). (If your tables are already sorted in the correct order, sort merge is automatically the best choice.)
- For in-memory tables, [hash joins](https://en.wikipedia.org/wiki/Hash_join) are preferable because they run in linear time <em>O</em>(<em>n</em>). However, the characteristics of modern hardware are increasing detrimental to the hash join alternative (see C. Kim, et al. [Sort vs. Hash revisited](http://www.vldb.org/pvldb/2/vldb09-257.pdf). 2009).


(It is also possible to use [bitmap indexes](https://en.wikipedia.org/wiki/Bitmap_index) to precompute joins.) In any case, short of precomputing the joins, joining large tables is expensive and requires source tables to be consistent.

__Conclusion:__ SQL is a fine language, but it has some biases that may trap developers. What works well in a business transaction system, may fail you in other instances.

