---
date: "2010-10-26 12:00:00"
title: "Who is going to need a database engine in 2020?"
---



Given the [Big Data](https://en.wikipedia.org/wiki/Big_data) phenomenon, you might think that everyone is becoming a database engineer. Unfortunately, writing a database engine is hard:

- [Concurrency](https://en.wikipedia.org/wiki/Concurrency_(computer_science)) is difficult. Whenever a data structure is modified by different processes or threads, it can end up in an inconsistent state. Database engines cope with concurrency in different ways: e.g., through [locking](https://en.wikipedia.org/wiki/Lock_(database)) or [multiversion concurrency control](https://en.wikipedia.org/wiki/Multi-Version_Concurrency_Control). While these techniques are well known, few programmers have had a chance to master them.
- [Persistence](https://en.wikipedia.org/wiki/Persistence_(computer_science)) is also difficult. You must somehow keep the database on a slow disk, while keeping some of the data in RAM. At all times, the content of the disk should be consistent. Moreover, you must avoid data loss as much as possible.


So, developers almost never write their own custom engines. Some might say that it is an improvement over earlier times when developers absolutely had to craft everything by hand, down to the [B-trees](https://en.wikipedia.org/wiki/B-tree).  The result was often expensive projects with buggy results.

However, consider that even a bare-metal language like C++ is getting support for  [concurrency and threads](https://en.wikipedia.org/wiki/B-tree) and esoteric features like [regular expressions](https://en.wikipedia.org/wiki/Regular_expressions). Moreover, Oracle working hard at killing the [Java Community Process](http://www.computerworld.com.au/article/365575/java_politics_brews_conflicts_between_oracle_jcp_participants/) will incite Java developers to __migrate to better languages__.

Meanwhile, in-memory databases are finally practical and inexpensive. Indeed, whereas a 16 GB in-memory database was insane ten years ago, you can order a desktop with 32 GB of RAM from Apple&rsquo;s web site right now. Moreover, memory capacity [grows exponentially](http://www.singularity.com/charts/page58.html): __Apple will sell desktops with 1 TB of RAM in 2020__. And researchers [predict](http://spectrum.ieee.org/semiconductors/memory/resistive-ram-gains-ground) that  non-volatile [Resistive RAM](https://en.wikipedia.org/wiki/Resistive_RAM) (RRAM) may replace DRAM. __Non-volatile internal memory would make persistence much easier.__

But why would you ever want to write your own database engine?

- For speed, some engines force you use nasty things like stored procedures. It is a drastically limited programming model.
- The mismatch between how the programmer thinks and how the database engine works can lead to massive overhead. As crazy as it sounds, I can see a day when writing your engine will save time. Or, at least, save headaches.
- __Clever programmers can write much faster specialized engines.__


Obviously, programmers will need help. They will need __great librairies to help with data processing, data compression, and data architecture__. Oh! And they will need powerful programming languages.

