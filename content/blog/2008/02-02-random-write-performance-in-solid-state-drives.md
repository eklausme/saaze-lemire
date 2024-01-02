---
date: "2008-02-02 12:00:00"
title: "Random Write Performance in Solid-State Drives"
---



I have written that solid-state memory drives (SSD) &mdash; as found in recent laptops such as the MacBook Air &mdash; [nearly bridge the gap between internal and external memory](/lemire/blog/2008/01/15/solid-state-drives-when-external-memory-becomes-as-fast-as-internal-memory/). Indeed, we went from 3&nbsp;orders of magnitude to 1 order of magnitude of difference between disk and RAM!

There is a catch however. SSDs can have terrible random write performance: at least two orders of magnitude slower than sequential writes!

Kevin Burton [points out](http://www.feedblog.org/) that &mdash; as a work-around &mdash; you can use [log-structured file system](https://en.wikipedia.org/wiki/Log-structured_file_system). In effect, random writes are replaced by appends at the end of a log of changes. There are certainly cases where log-structured file systems are appropriate &mdash; I don&rsquo;t know much about them &mdash; but are they appropriate for external-memory B-trees or hash tables?

However, some systems are designed to avoid random writes. For example, Google&rsquo;s [BigTable](https://en.wikipedia.org/wiki/BigTable) sorts data in memory before writing it to disk. Random writes are also minimized with most [column-based](https://en.wikipedia.org/wiki/Column-oriented_DBMS) databases and indexes such as C-store and [bitmap indexes](https://en.wikipedia.org/wiki/Bitmap_index).

It is an interesting time to be a database researcher!

