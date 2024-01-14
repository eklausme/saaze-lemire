---
date: "2010-12-20 12:00:00"
title: "For your in-memory databases, do you really need an index?"
---



For large data sets on disk, indexes are often essential. __However, if your data fits in RAM, indexes are often unnecessary.__ They may even be harmful.

Consider a table made of 10,000,000 rows and 10 columns. Using normalization, you can replace each value by a 32-bit integer for a total of 381 MB. How long does it take to scan it all?

- __When the data is on disk, it takes 0.5 s to scan the data.__ To maximize buffering, I have used a memory-mapped file.
- __When the data is in memory, it takes 0.06 s.__


Can you bring the 0.06 s figure down with an index? Maybe. But consider that :

- Indexes use memory, sometimes forcing you to store more data on disk.
- Indexes typically slow down construction and updates.
- Indexes typically only improve the performance of some queries. This is especially true with multidimensional data.


__Verify my results:__ My [Java code](http://pastebin.com/zadfzb4p) is available on paste.bin. I ran the tests on an iMac with an Intel Core i7 (2.8 GHz) processor.

__Source:__ This blog post was motivated by a question from [Julian Hyde](https://julianhyde.blogspot.com/), of [Mondrian](http://sourceforge.net/projects/mondrian/) fame.

__Further reading:__[ Understanding what makes database indexes work](/lemire/blog/2008/11/07/understanding-what-makes-database-indexes-really-work/)

__Code:__ Source code posted on my blog is available from a [github repository](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog).

