---
date: "2011-08-15 12:00:00"
title: "The Web is killing database systems"
---



A typical enterprise computing architecture relies on databases, professionally managed by [DBAs](https://en.wikipedia.org/wiki/Database_administrator). Developers grow applications which all update or query the same databases. The value is not in the software per se, but in the data architecture.

Given the DNA of our industrial-age organizations, this makes sense. The data was stored in books and entered by clerks. The clerks have to be interchangeable, easily replaceable. The data, however, is the blood of your company. When running a factory, if you can&rsquo;t keep track of sales and income, you die. Software replaced the clerks, but it is just as insignificant, just as replaceable. The database system itself is akin to the books: it is not thought of as software, but as support for the data. In this sense, database systems acquire a mythical status in enterprise computing. You get people swearing by the database system as if it were a religion. Of course, enterprises are often stuck with software that they cannot replace. But this is often seen as a weakness. Meanwhile, being stuck with a database system is not a concern in enterprise computing.

People often think that a company like Google is all about the data. But, of course, this is wrong. I could wipe out all of Google&rsquo;s databases. It would hurt Google&rsquo;s stock prices. But within 6 months to a year, Google would be back where it is. Part of the value of Google is the brand itself. But if brand was everything, then Microsoft or Yahoo! would have wiped out Google a long time ago. The value of Google is in the software itself (and in its software engineers).

For many people who love software, the natural evolution of your architecture goes as follows:

1. Build application with what is effectively an embedded database. If you use a database system, it is mostly to save yourself some coding.
1. If others need your data, you build an [API ](https://en.wikipedia.org/wiki/Api)engineered from your application (typically as a [web service](https://en.wikipedia.org/wiki/Representational_State_Transfer)). Instead of offering people direct access to part of your database, you effectively build a machine-friendly version of your application.


This means that the ratio between applications and databases moves closer to 1. Let us call this model software-centric.

One of the reasons a database system like Oracle is valuable in enterprise computing is that you can throw away the applications, and you still have your data. It is data-centric. But if you use Oracle with the software-centric model, the value lies entirely in the scalability, expressivity and reliability of Oracle&rsquo;s software. While Oracle makes solid software, other people may make software that is a better fit for the application at hand.

The software-centric model also allows more innovation. It is not tempting to invent something better than the double-entry accounting system: it works and all clerks should know about it. Similar, in traditional enterprise computing, it is not tempting to use something other than a relational database. But in the software-centric model, only few people will ever touch the database system, assuming there is one. And, in fact, developers often change the database system. For this reason, they do not want others to access the database directly.

In a typical enterprise computing database, the semantics must lie with the database (e.g., through documentation) because we want to be able to throw away the software. The software-centric system also captures the semantics in software. While this can be tragic if you have poor programmers, this can be a blessing if you have top-notch programmers. There is nothing more reusable than a well-designed API.

So? Which is better? The software-centric or the data-centric approach?&nbsp; Most large organizations have many bad programmers. This should not come as a surprise: they don&rsquo;t value software much. So, the software-centric approach would be a catastrophe for them. And, at least so far, they have not had much need for great software.

But the innovation is with software-centric engineering. This means that eventually, software-centric tools will be orders of magnitude better than the data-centric ones. The IT department at your local large company is already outgunned a hundred-to-one by what Google can offer. The gap will grow wider until data-centric systems are finally retired.

The Web, like nothing else, has embraced the software-centric approach. In this sense, the Web is killing database systems. How else could you explain the relative dominance of MySQL? (Remember that Facebook uses MySQL.) MySQL is hardly the best database system around, even among free solutions. The truth is that the database system no longer matters.

