---
date: "2008-03-25 12:00:00"
title: "Multicore programming? Yawn!"
---



It looks like [Intel is trying to push parallel programming](http://developers.slashdot.org/story/08/03/25/0145208/more-interest-in-parallel-programming-outside-the-us). No doubt many colleges are going to keep surfing on the parallel-programming hype &mdash; to predict a new surge of interest in Computer Science. Alas, there is no upcoming multicore revolution in computer programming.

- For a large fraction of enterprise problems, the bottleneck is at the database level. The ubiquity of Web servers and distributed databases (see CouchDB) imply that many such problems are already parallelized. Database techniques like [partitioning](https://en.wikipedia.org/wiki/Partition_(database)) have been around for years to help you parallelize your databases. This blog runs on a server with several processors, and it has done so for years. Nothing new on the horizon.
- [MapReduce](https://en.wikipedia.org/wiki/Mapreduce) and [Hadoop](https://en.wikipedia.org/wiki/Hadoop) help you parallelize many of the remaining hard data processing problems without having to mess with threads, locking and synchronization.
- Many hard problems are memory-bound: they are hard because all of the data does not fit in memory. If your problem is memory-bound or IO-bound, throwing more processing cores at it may not help at all. 


I have stated for a couple of years that storage, not processing power, is changing Information Technology. What is most amazing is our ability to record almost every single bit of information, and never have to delete or forget anything. On this topic, see my posts [One More Step Toward Infinite Storage](/lemire/blog/2007/03/06/wired-ap-technology-and-business-news-from-the-outside-world-on-wiredcom/), [Solid-state drives: when external memory becomes as fast as internal memory](/lemire/blog/2008/01/15/solid-state-drives-when-external-memory-becomes-as-fast-as-internal-memory/) and [What is infinite storage?](/lemire/blog/2006/10/26/what-is-infinite-storage/)

The truth is that we are not very good at dealing with large quantities of data. Anyone knows what to do when handed 50 terabytes of raw data? Few of us have the required skills to manage and leverage extremely large databases. Those will be the valuable skills in the future.

