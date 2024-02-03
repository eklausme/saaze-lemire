---
date: "2008-01-19 12:00:00"
title: "Database indexes are less useful than you think"
---



An [index](https://en.wikipedia.org/wiki/Index_%28information_technology%29) helps you find an item without scanning all of the data. [David DeWitt](https://en.wikipedia.org/wiki/David_DeWitt) and and [Michael Stonebraker](https://en.wikipedia.org/wiki/Michael_Stonebraker) [have made comments](http://www.databasecolumn.com/2008/01/mapreduce-a-major-step-back.html) opposing [index-light systems](http://www.monash.com/whitepapers.html) such as [MapReduce](https://en.wikipedia.org/wiki/MapReduce), [SimpleDB](https://en.wikipedia.org/wiki/SimpleDB), and [CouchDB](https://en.wikipedia.org/wiki/CouchDB).

But David DeWitt and and Michael Stonebraker failed to tell us about [schemas falling apart as you scale up](http://www.intertwingly.net/blog/2007/09/12/Dare-Takes-a-Look-at-CouchDB). To them, database theory took us out of the dark ages and these new kids are taking up back in caves. I have a different take:

- Initially, you have a messy start-up. You do the accounting, Joe takes care of hiring the new staff and your wife answers the phone. This is an analogy to the early database days before schemas and relational models. 
- The company grows and you organize it clearly. You now have an IT department, an accounting department, and so on. This is analogous the classical database technology David and Michael say we should respect.
- Eventually, you have 1500 employees, half of them working from home in India. Nobody knows how many IT departments you have or whether you have one at all. By analogy, as you scale up, the classical database schemas and indexes become much less useful.


__Update__: Here is a comment by Mark C. Chu-Carroll&hellip;

> (&hellip;) indexing is a great tool if your data is tabular, and you have a central index that you can work with. But if your task isn&rsquo;t fundamentally relational, and what you really need is computation then indexes aren&rsquo;t going to help.



