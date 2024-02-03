---
date: "2008-01-28 12:00:00"
title: "The network is the bottleneck?"
---



There is a really nice article on [StorageMojo](http://storagemojo.com/2008/01/27/cloud-computing-is-foggy-thinking/) about [Cloud Computing](https://en.wikipedia.org/wiki/Cloud_computing). Cloud Computing is more or less the idea that you can offload your storage and processing tasks to a very large set of computers, typically maintained by some large company (such as Amazon). The novelty is that you abstract out where the data is held and which machine does the processing &mdash; not unlike what [MapReduce](https://en.wikipedia.org/wiki/MapReduce) does.

This new level of abstraction is probably a significant step forward in the way we write software. Google has shown that hand-crafting parallel algorithms is often neither necessary nor useful.

In any case, StorageMojo points out that memory and CPU cycles are becoming ridiculously cheap. Meanwhile, bandwidth is becoming a serious limitation. Therefore, he says, companies are not about to outsource their computing needs to cloud computing. It is too inexpensive to create &mdash; and maintain &mdash; your own computing infrastructure.

The first problem with his argument is that bandwidth increases with storage, automagically. Indeed, I can just drop a large hard drive in the trunk of my car and drive to destination! Our real curse is latency. However, if the organization you work for is like mine, latency-resilience is already built in the system. In a university, nobody expects the data entered yesterday to come up in the report next week.

The second problem with his argument is that paying experts to maintain your own server is almost certainly more expensive than whatever bandwidth costs cloud computing can occur. Maintaining databases and number-crunching computers is a boring task and it will get unavoidably outsourced.

