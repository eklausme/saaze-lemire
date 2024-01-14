---
date: "2010-12-07 12:00:00"
title: "Who will need database administrators in 2020?"
---



In response to my [Why do we need database joins?](/lemire/blog/2010/11/29/why-do-we-need-database-joins/) post, many readers stressed the importance of strict database schemas to preserve data integrity. In short, we want [database administrators](https://en.wikipedia.org/wiki/Database_administrator) (DBA) to input constraints at design time so that the integrity of the database is insured no matter how lousy your programmers are. There is nothing a DBA hates more than having to recover a database from the backup tapes. And several businesses simply cannot afford to have their databases disrupted.

And really, businesses can be careless with their data. I have repeatedly seen businesses and public organizations hire students or recent graduates for 3 months so that they can add a feature or quickly build a web application. Every single time, I cringe. And almost every single time it ends badly. Managers shouldn&rsquo;t mess with software and data without real professionals. Alas, the bad ones often do. In such a context, __we need DBAs to protect the data, to keep the useful applications running__.

So, unsurprisingly, we keep hearing that NoSQL databases fail to get any traction in large organizations. Is this a surprise? NoSQL tends to do away with schemas. It gives a lot more power to the programmer. More power to screw up as well. So,  we are getting at the heart of the matter. __NoSQL is not meant for DBAs.__ In fact, it is a [coup](http://highscalability.com/blog/2010/12/6/what-the-heck-are-you-actually-using-nosql-for.html ) against DBAs:

> NoSQL is for programmers. This is a developer led coup. The response to a database problem can&rsquo;t always be to hire a really knowledgeable DBA, get your schema right, denormalize a little, etc., programmers would prefer a system that they can make work for themselves.


In effect, __NoSQL developers are working to make DBAs less relevant__ (or even irrelevant). And, if history is our guide, they will succeed. I wouldn&rsquo;t be surprised if in ten years, we declared database administration to be an obsolete occupation. The software will protect the data better than any DBA ever could. This revolution, however, cannot come from the vendors who sell to DBAs. We must have [disruptive innovation](https://en.wikipedia.org/wiki/Disruptive_innovation). And this is exactly what NoSQL is.

__Note:__ I have nothing against DBAs. I expect to be obsolete myself by 2020. (And hopefully, I&rsquo;ll find a way to retire early.)

