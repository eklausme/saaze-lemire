---
date: "2010-06-16 12:00:00"
title: "Indexing XML"
---



It is often important to index [XPath](https://en.wikipedia.org/wiki/XPath) queries. Not only is XPath useful on its own, but it is also the basis for the [FLWOR](https://en.wikipedia.org/wiki/FLWOR) expressions in [XQuery](https://en.wikipedia.org/wiki/XQuery).

A typical XPath expression will select only a small fraction of any XML document (such as the value of a particular attribute). Thus, a sensible strategy is to represent the XML documents as tables. There are several possible maps from XML documents to tables. One of the most common is ORDPATH.

In the ORDPATH model, the root node receives the identifier 1, the first node contained in the root node receives the identifier 1.1, the second one receives the identifier 1.2, and so on. Given the ORDPATH identifiers, we can easily determine whether two nodes are neighbors, or whether they have a child-parent relationship.

As an example, here&rsquo;s an XML document and its (simplified) ORDPATH representation:

<code><br/>
&lt;liste temps="janvier" &gt;<br/>
&lt;bateau /&gt;<br/>
&lt;bateau &gt;<br/>
&lt;canard /&gt;<br/>
&lt;/bateau&gt;<br/>
&lt;/liste&gt;<br/>
</code>

ORDPATH                  |name                     |type                     |value                    |
-------------------------|-------------------------|-------------------------|-------------------------|
1                        |liste                    |element                  |&#8211;                  |
1.1                      |temps                    |attribute                |janvier                  |
1.2                      |bateau                   |element                  |&#8211;                  |
1.3                      |bateau                   |element                  |&#8211;                  |
1.3.1                    |canard                   |element                  |&#8211;                  |


Given a table, we can easily index it using standard indexes such as B trees or hash tables. For example, if we index the value column, we can quickly process the XPath expression @temps=&rdquo;janvier&rdquo;.

Effectively, we can map XPath and XQuery queries into SQL. This leaves relatively little room for XML-specific indexes. I am certain that XML database designers have even smarter strategies, but do they work significantly better?

__Reference__: P. O&rsquo;Neil, et al.. [ORDPATHs: insert-friendly XML node labels](http://www.cs.umb.edu/~poneil/ordpath.pdf). 2004.

__Further reading__: [Native XML databases: have they taken the world over yet?](/lemire/blog/2008/12/04/native-xml-databases-have-they-taken-the-world-over-yet/)

