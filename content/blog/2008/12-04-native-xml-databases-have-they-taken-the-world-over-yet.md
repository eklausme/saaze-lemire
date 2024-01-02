---
date: "2008-12-04 12:00:00"
title: "Native XML databases: have they taken the world over yet?"
---



Some years ago, the database research community jumped into XML. Finally, something new to work on! For about 5 years now, I have seen predictions that the XML databases would take the world over. Every organization would soon have its XML database. People would run web sites out of XML databases. Countless start-ups emerged ready to become the next Oracle.

What happened in practise is a bit underwhelming. Oracle, Microsoft, MySQL and others all included some XML support in their relational databases, but native XML databases failed to grab any market share.

Where are we?

- Regarding programming languages, [XQuery](http://www.w3.org/TR/xquery/) finally became a W3C recommendation in January 2007. More or less, XQuery together with XPath specify the equivalent of a <kbd>select</kbd> instruction in SQL.
- What if you want to update your XML database?<br/>
[XUpdate](http://xmldb-org.sourceforge.net/xupdate/) has been around for some time, but it is not widely supported. The W3C is working on something called [XQuery Update Facility](http://www.w3.org/TR/xquery-update-10/).
- Interfacing XQuery with your favorite programming language is still awkward. We have an [API for XML databases](http://xmldb-org.sourceforge.net/xapi/) (XML:DB), but I am not sure how well it is supported by the various vendors.


Want to take an XML database out for a spin? Some XML databases worthy of mention:

- [eXist](http://exist-db.org/exist/apps/homepage/index.html) is open source and free.
- Sedna is another free XML database.


__My take__: Once again, the relational data model shows great resilience in the marketplace. It is entirely possible that XML databases may go the way of the objected-oriented databases: useful for some niche problems, but nothing more. We could blame the lack of standards for the failure of XML databases, but SQL was never standardized and still took off.

I like XML. I like CSS. I like XSLT/XPath. But I have always be less certain about XQuery.

XML databases look too much like a solution in search of a problem.

__Reference__: The W3C publishes the result of their [XQuery conformance testing](http://dev.w3.org/2006/xquery-test-suite/PublicPagesStagingArea/XQTSReportSimple.html). There is a lot of room for improvement!

