---
date: "2005-10-18 12:00:00"
title: "Oracle and MySQL &#8212; is MySQL in a weak position?"
---



Oracle has recently bought Innobase which makes one library MySQL relies upon for storing its tables. One user on [slashdot ](http://ask.slashdot.org/article.pl?sid=05/10/18/2126237&#038;tid=221&#038;tid=4&#038;tid=8) had the following insightful comment:

> Among the technologies that MySQL licenses from third parties under commercial redistribution licenses:

Berkeley DB (Sleepycat Software)<br/>
InnoDB (Oracle, formerly Innobase)<br/>
MaxDB (SAP AG)

See the problem? MySQL itself is largely a language parser and a simple and technically inadequate storage engine (for anything where data integrity matters). In other words they don&rsquo;t own any of the foundations of their technologies.


This is interesting. We always encourage developers to use and reuse existing libraries. Should MySQL be blamed for doing so?

The comparison with PostgreSQL is interesting. PostgreSQL works in a decentralized way as opposed to MySQL which is developed by single company, using libraries.

I think that MySQL could definitively be a fragile product whose development could be impaired through various business decisions. However, I think it has nothing to do with the fact that MySQL relies on libraries it hasn&rsquo;t written, but rather on the fact that there is no community of MySQL developers.

Free Sofware is not a cure to the world&rsquo;s hunger.However, building software using a highly distributed community might very be the best possible way to develop generic software.

