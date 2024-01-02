---
date: "2006-08-11 12:00:00"
title: "Database-less: the new trend"
---



Following [Tim Bray](http://www.tbray.org/ongoing/When/200x/2006/07/17/No-Databases), Kunal Anand argues in favor of database-less systems. Or rather, of relational-database-less systems. Because really, what is a store of XML files if not some form of database?

Several years ago, I wrote a [GPL posting board](http://sourceforge.net/projects/webforum/). I claim I wrote the first GPL Java-based posting board. Interestingly, it was later studied in a M.Sc. thesis for the type of multithreading I used. I grew bored with the project mostly because I don&rsquo;t have time for web dev. work. One choice I made at the time was to use flat text files for the database.

The project became hard to manage at some point mostly because XML tools back then were primitive so I didn&rsquo;t use them. So, serialization and data structures were hand coded. These days, with XML tools being what they are, I really can see people building production systems, very scalable ones, without any relational database. Something like a posting board is mostly static anyhow, so you could rather easily regenerate all needed XML files when new posts come in.

I bet that, actually, for moderately small projects, an XML solution is probably generally more scalable and flexible. It might be slightly harder to get started, but serving text files is so much simpler for the machine than requesting data from an SQL engine!

<em>SQL is so passé.</em>

