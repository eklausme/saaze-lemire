---
date: "2009-01-15 12:00:00"
title: "The Claremont report on database research"
---



Every few years, the database research community prepares a report listing the most promising research directions. The previous one was called the Lowell report, and I [was inspired by it](/lemire/blog/2006/12/05/the-future-of-database-research/). The latest one is called the [Claremont](http://dl.acm.org/citation.cfm?id=1462571.1462573&amp;coll=ACM&amp;dl=ACM&amp;idx=J689&amp;part=newsletter&amp;WantType=Newsletters&amp;title=ACM%2520SIGMOD%2520Record) report.

Some bits I found interesting:

- There is a call to exploit <em>remote RAM and Flash as persistent media, rather than relying solely on magnetic disk</em>. Indeed, Solid State Drives are an order of magnitude faster than our spinning disks and large pools of RAM are becoming affordable. __External-memory algorithms are no longer a hot topic?__ (Yes, it is [not that simple](/lemire/blog/2008/02/02/random-write-performance-in-solid-state-drives/).)
- Web 2.0-style applications bring new database workloads. I did some work on [merging Web 2.0 and OLAP](http://arxiv.org/abs/0710.2156) and can testify that the __Social Web is a good source of new database problems__.
- They recommend integrating compression and query optimization. My work on [compression in bitmap indexes](http://arxiv.org/abs/0808.2083) that __there are still open issues regarding compression in databases__. Mostly, whereas information theory has taught us much about how to optimally compress, we have learned relatively little about how to __use compression to save CPU cycles__.


