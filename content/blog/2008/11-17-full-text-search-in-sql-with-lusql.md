---
date: "2008-11-17 12:00:00"
title: "Full text search in SQL with LuSql"
---



MySQL supports natively [full text search](http://dev.mysql.com/doc/refman/5.0/en/fulltext-search.html); many database engines do. However, few databases can match a dedicated search engine library like [Lucene](http://lucene.apache.org/core/). Moreover, even if you do not need the power of Lucene, sometimes you are forced to use a database engine that does not support full text search (like raw [CSV](https://en.wikipedia.org/wiki/Comma-separated_values) files).
It would be nice to be able to combine a true search engine with any database engine.
If you are willing to use Java, then Glen Newton from NRC has the solution: LuSql. It allows you to index with Lucene any database accessible by Java (through JDBC). He says it has been extensively tested. It is open source and free.

