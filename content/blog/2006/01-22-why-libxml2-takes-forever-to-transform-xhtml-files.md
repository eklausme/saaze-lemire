---
date: "2006-01-22 12:00:00"
title: "Why libxml2 takes forever to transform XHTML files"
---



For my [Online XML Course](https://lemire.me/tmpxml//), I process lots and lots of XHTML content using XSLT. Up until now, I avoided the [libxml2 XSLT processor](http://www.xmlsoft.org/) (xstlproc) because it was unacceptably slow.

Today, I found out what is happening. It loads all of the XHTML DTD files from W3C each and every time it processes an XHTML file. To get around the problem, use the &#8211;novalid flag when invoking the xsltproc command line. You might get warnings about problematic entities, so I suggest you try a DOCTYPE declaration like the following:

<code>&lt;!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"<br/>
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"[<br/>
&lt;!ENTITY laquo "&amp;#171;"><br/>
&lt;!ENTITY raquo "&amp;#187;"><br/>
&lt;!ENTITY oelig "&amp;#339;"><br/>
&lt;!ENTITY nbsp "&amp;#160;"><br/>
]></code>

