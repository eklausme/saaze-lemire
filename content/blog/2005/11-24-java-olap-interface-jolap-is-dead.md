---
date: "2005-11-24 12:00:00"
title: "Java OLAP Interface (JOLAP) is dead?"
---



It looks like JOLAP is dead. The final specification has been <a href="https://www.jcp.org/en/jsr/detail?id=069">approved on June 15<sup>th</sup> 2004</a>. However, to this day, except for [Mondrian](http://mondrian.sourceforge.net/) and Xelopes, I know of no implementation of JOLAP. According this this [thread](https://community.oracle.com/message/1122807?tstart=0), Oracle has no intention of ever supporting JOLAP.

On the other hand, [Oracle doesn&rsquo;t support nor does it plan to support MDX or derived technologies](http://www.microsoft.com/en-us/server-cloud/products/sql-server/) such as [XML for Analysis (XMLA)](http://www.simba.com/) and more recent specifications. But, you can get MDX support in Mondrian and in [SQL Server standard edition or better](http://www.microsoft.com/en-us/server-cloud/products/sql-server/). I am pretty sure IBM supports MDX and maybe XMLA, but with recent changes in their OLAP product line, I must admit I&rsquo;m a bit confused.

This leaves us with no cross-platform [OLAP](https://en.wikipedia.org/wiki/Olap) query standard. After all these failed attempts, it is very depressing. 

__Update__: Daniel Guerrero from [Ideasoft](http://www.ideasoft.biz) correctly pointed out to be that the current JOLAP spec. has not been published yet as a Final Release, but only as a Final Draft. The Final Draft has been approved in June 2004 (though IBM abstained), and normally, the Final Draft ought to be a Final Release by now, but this didn&rsquo;t happen. The difference is significant because, right now, the JOLAP license, granted by Hyperion, is for evaluation purposes only. This means you can&rsquo;t go out and implement JOLAP without risking legal troubles. We can imagine many scenarios on what is happening, but I&rsquo;ll vote for an Intellectual Property issue.

