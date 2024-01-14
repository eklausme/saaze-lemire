---
date: "2011-04-13 12:00:00"
title: "The Open Java API for OLAP is growing up!"
---



<img decoding="async" style="margin: 10px; float: right;" src="http://www.olap4j.org/images/olap4j_logo.png" alt="olap4j log" /><br/>
Software is typically built using two types of programming languages. On the one hand, we have query languages (e.g., XQuery, SQL or [MDX](https://en.wikipedia.org/wiki/Multidimensional_Expressions)). On the other, we have the regular programming languages (C/C++, Java, Python, Ruby). A lot of effort is spent on the mismatch between these two programming styles. It remains a sore point in many projects.

Microsoft has been trying especially hard to resolve this mismatch. Their [LINQ](https://en.wikipedia.org/wiki/Language_Integrated_Query) component allows you to use relational or XML data sources directly in your favorite language (e.g., C#).

Oracle has its own solution, the [Oracle Java API](https://en.wikipedia.org/wiki/Oracle_OLAP). It allows you to query OLAP databases directly from Java, without SQL or MDX.

Unfortunately, these solutions are vendor-specific. With the rise of [Open Source Business Intelligence](https://en.wikipedia.org/wiki/Business_intelligence_tools#Open_source_free_products), we seek open solutions which are shared and co-developed.

That is what the [Open Java API for OLAP](http://www.olap4j.org/) (olap4j) is. Anyone can build an OLAP engine and offer support for olap4j. You then get MDX support for free. Best of all, an application written against olap4j should work with any olap4j-compliant OLAP server which includes SQL Server Analysis Service and SAP Business Information Warehouse. And if you add [Mondrian](http://sourceforge.net/projects/mondrian/), you can get olap4j compliance out of any common relational database management system such as MySQL.

Lead by the Linus Torvalds of OLAP (Julian Hyde), olap4j finally reached version 1.0. A leading-edge feature I find interesting is that olap4j supports notifications which should enable real-time OLAP applications. Whenever something changes at the database level, the OLAP server can notify its clients, effectively pushing a notification. One obvious application is in the financial industry where data must be quickly updated.

__Further reading__: The [press release](http://www.pentaho.com/news/releases/pentaho-announces-a-new-era-in-open-standards-for-analytics/) for olap4j 1.0. [Julian Hyde&rsquo;s blog post](https://julianhyde.blogspot.com/2011/04/olap4j-version-10-released.html) on this topic. [Luc Boudreau&rsquo;s blog post](https://devdonkey.blogspot.com/2011/04/olap4j-10-is-here.html). See also some of my older blog posts: [JOLAP is dead, OLAP4J lives?](/lemire/blog/2008/11/06/jolap-is-dead-olap4j-lives/) (2008) and [JOLAP versus the Oracle Java API](/lemire/blog/2006/01/17/jolap-versus-the-oracle-java-api/) (2006).

