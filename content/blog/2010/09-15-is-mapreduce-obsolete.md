---
date: "2010-09-15 12:00:00"
title: "Is MapReduce obsolete?"
---



Last week, the Register [announced](http://www.theregister.co.uk/2010/09/09/google_caffeine_explained/) that Google moved &ldquo;away from [MapReduce](https://en.wikipedia.org/wiki/MapReduce).&rdquo; Given that several companies adopted MapReduce (hence copying Google), is Google moving a step ahead of its copycats? Moreover, Tony Bain is [asking](http://blog.tonybain.com/tony_bain/2010/09/was-stonebraker-right.html) today whether Stonebraker was right in stating that MapReduce was a &ldquo;a giant step backward.&rdquo; Is MapReduce itself any good?

As reported by the Register, one problem with MapReduce is that it is essentially batch-processing oriented. Once you start the process, you can&rsquo;t easily update the input data and expect the output to be sane. Thus, MapReduce is poor at real-time processing. Yet, it will remain fine for latence-oblivious applications such as [Extract-Transform-Load](https://en.wikipedia.org/wiki/Extract,_transform,_load) or number crunching.

We now expect Google to index my blog post within minutes after I post them. Google had to update its batch-oriented architecture for a real-time indexing approach. However, it is unclear whether this puts Google technologically ahead of, say, Microsoft Bing.

The big picture is maybe more interesting. We used to view the Web as a large collection of documentsâ€”as a library. Indexes updated daily were just fine. We now view the Web as an endless stream of dataâ€”like a live meeting between billions of people.

__Further reading__: Julian Hyde, [Data in Flight](http://queue.acm.org/detail.cfm?id=1667562), ACM Queue, 2009.

