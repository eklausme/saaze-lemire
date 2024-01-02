---
date: "2010-11-29 12:00:00"
title: "Why do we need database joins?"
---



In a [recent post](/lemire/blog/archives/2010/06/28/nosql-or-nojoin/), I argued that the current [NoSQL](https://en.wikipedia.org/wiki/NoSQL) trend could be called NoJoin. My argument boils down to the fact that SQL entices you to normalize your data which creates complicated schemas. Meanwhile, NoSQL database systems use simple schemas and are therefore easier to scale out.

Curt Monash has a [reasonable post](http://www.dbms2.com/2010/11/29/document-database-without-joins/) where he points out that __we need joins because we normalize__. Furthermore, he offers reasons for normalization:

- To simplify the programming of the updates. Simply put, if the string &ldquo;Montreal&rdquo; appears once in your database, and the city changes its name, it is trivial to do the update. This applies mostly when you have complex schemas.
- For faster updates. Updating a single entry in a database is much faster than searching and updating for all occurrences of the value &ldquo;Montreal&rdquo;. This is mostly applicable when you have large update volumes.


However, the case against joins is also strong:

- Normalization makes your schemas complex. I have seen university databases made of hundreds of tables. The average query is well over 256 characters and involves dozens of joins. It is simply impossible to make sense of the content of any one table. Building new applications on top of this mess is expensive and bug prone. Complexity is bad for your health.
- Database engines can compress the data automagically so normalization to save space is a waste of time. 


The dogma of normalization too often leads to [over-engineering](https://en.wikipedia.org/wiki/Overengineering). We are so afraid that a programming error could leave the database in a wrongful state that we invest massively in inflexible schemas. In turn, this over-engineering comes back to haunt us when we need to be more agile, or to scale out.

__Example: __

__ __Suppose you want to design a database of research papers. Let us simplify the problem by omitting the paper identifiers, the dates, and so on. Let us also assume that there is only one author per paper. Maybe your main table looks like this:

authorID                 |author name              |publisher                |title                    |
-------------------------|-------------------------|-------------------------|-------------------------|
smith01                  |John Smith               |Springer                 |Databases are bad        |
lampron01                |Nathalie Lampron         |IEEE                     |The other guy is wrong, databases are good |


Being helpful, your friendly database expert points out that your database schema is not even in the [second normal form](https://en.wikipedia.org/wiki/Second_normal_form). Clearly, you are an amateur. Being helpful, he creates a secondary table which maps the authorID field to an author name. And voilÃ ! You have saved storage, and won&rsquo;t ever get someone&rsquo;s name wrong. Updates to someone&rsquo;s name will be much faster in the future.

But wait?!? What if Nathalie gets married and changes name? And indeed, people have their names changed all the time. Yet, we never retroactively change the names of the authors on a paper. Maybe you never thought about it, but many ladies hold two or more names in their lifetime. Did the bunch of guys in IT knew about this? (As an aside, are the digital librarians worried at all about researchers changing name and seeing their publication list cut in half? Yes: See update below.)

My point is that normalization effectively enforces dependencies decided upon when you created the schema. These envisioned dependencies break down all the time. Life is complicated. I could come up with hundreds of examples. __Strict normalization makes as much sense as the [waterfall model](https://en.wikipedia.org/wiki/Waterfall_method).__

What about the physical layer? Because normalization has removed entire fields from the main table, you might think that normalization will save storage! That may well be true in the database engine you are using. However, other database engines will automatically detect the dependencies and compress the data accordingly. In this case, it is trivial to discover that there  is a bijective (1-to-1) mapping between author ID and author name. And if the bijectivity breaks down, the database engine will simply have to work a bit harder to compress the data. Your code won&rsquo;t break down. It won&rsquo;t need to be retested. (To be fair, I don&rsquo;t know if any database system gets this right.)

__Update:__ Apparently, Otfried Cheong&mdash;a Computer Science professor in Korea&mdash;once published as Otfried Schwarzkopf. At least, the two names are merged on [DBLP](http://www.informatik.uni-trier.de/~ley/db/indices/a-tree/c/Cheong:Otfried.html). It suggests that DBLP can cope with researchers changing their name.

