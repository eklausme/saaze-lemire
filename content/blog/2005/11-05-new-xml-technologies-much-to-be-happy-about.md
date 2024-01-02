---
date: "2005-11-05 12:00:00"
title: "New XML technologies: much to be happy about!"
---



Through [Cafe con Leche](http://cafeconleche.org/) and other sources including W3C mailing lists, we learned that the W3C XQuery and XSL working groups have published a bunch of new recommendations regarding [XQuery 1.0](http://www.w3.org/TR/2005/CR-xquery-20051103/), [XSLT 2](http://www.w3.org/TR/2005/CR-xslt20-20051103/), and [XPath 2](http://www.w3.org/TR/2005/CR-xpath20-20051103/).

XSLT 2.0 is interesting because all those who had to use XSLT 1.0 for real work needed some processor-specific extensions such as [exslt](http://www.exslt.org/) and this need will mostly go away. It is a bit of a pain to have to require one processor or another just because you absolutely needed to use regular expressions, for example. However, the market will probably take some time to adopt it, but, at least, now that it is a candidate recommendation, programmers will get busy as they know that in a year or two, not supporting XSLT 2.0 will be a sin. I wonder how long it will take for the Firefox and Microsoft crews to support XSLT 2.0 in the browser?

Some [key cool features in XSLT 2.0](http://www.altova.com/XSLT_XPath_2.html):

- You can generate many documents instead of only one! You could do this with XSLT 1.0, but only using extensions.
- They&rsquo;ve done away completly with the Result Tree Fragments. If you don&rsquo;t know what those are, good for you. They were basically node-sets you could not query using XPath expressions. Was ugly! Using extensions, you could convert them to node-sets.
- You can define your own custom XPath functions! Cool!


XPath 2.0 is definitively much more powerful than XPath 1.0 and they say that 80% of the power of XQuery 1.0 (see below) is present in XPath 2.0. The ability to use regular expressions, loops and conditions expressions will make a huge difference:<br/>
<code> for $student in //class<br/>
return if ( count( $student/homework ) = 3 )<br/>
then "course completed" else "ongoing"</code><br/>
Also XPath 2.0 expressions __always__ return a &ldquo;sequence&rdquo; which makes XPath 2.0 conceptually simpler.

Regarding XQuery, I stand by my opinion that it might be one more failed recommendation by W3C, and [Tim Bray seems agree with me](http://www.tbray.org/ongoing/When/200x/2003/11/30/SearchXML):

>  I became uncomfortable with several aspects of the project, including its sprawling scope and tight XML-Schema integration (&hellip;) The marketplace will eventually judge.


I believe everything that can be done with XQuery can be done with XSLT. The only drawback to XSLT is that it requires declarative thinking whereas XQuery is more procedural. How is that a big deal? If XQuery gets adopted, will it mean that people aren&rsquo;t smart enough to figure out declarative programming? It ain&rsquo;t that hard! Kidding aside, if XQuery is to allow the masses to query XML documents, how many people are in &ldquo;the masses&rdquo;? It seems like it is a fairly small subset of the programming community anyhow, so why bother with XQuery when XSLT is really not so complicated.

In other related news, it seems like Firefox 1.5 will support SVG by default but with quite a number of limitations including the usage of fonts, animations, and filtering. It seems like [Canvas ](http://developer.mozilla.org/en/docs/Canvas_tutorial) will be an interesting tool to draw dynamically on the screen using JavaScript especially since Firefox SVG implementation doesn&rsquo;t support animation while Canvas does.

Now, if only we could get [AJAX](https://en.wikipedia.org/wiki/AJAX) standardized!

