---
date: "2005-01-02 12:00:00"
title: "Current state of affairs in the XML world (according to me)"
---



I&rsquo;ve been working hard at an XML course for the last few months. While I&rsquo;ve been done a lot of e-business related work in recent years, I didn&rsquo;t consider myself an XML expert. 

Still, I&rsquo;ve been one of the early adopters regarding XML, starting out in 1997-1998 when it was still a cowboyland. I kept hacking away at XML until about 2001 and then I went away and did other things. I actually did a commercial project (as an technology architect) in 2001, but it was one of my last project before going back to academia ([Acadia University](http://www2.acadiau.ca/index.php)).

What happened between now and 2001? Well, Mozilla for one thing or, rather, true standard-compliant XML support in widely available browsers. Also, a lot, but really a lot of new &ldquo;standards&rdquo; have come along, things like XHTML and so on. 

In truth, I don&rsquo;t think much changed since 2001. Not as much as I thought.

After studying carefully what&rsquo;s out there, I come away with the following conclusions:

- Internet Explorer doesn&rsquo;t support basic things like XHTML and its general support for XML is quite lacking. It is simply not a good XML tool. Mozilla (including Firefox) is pretty good but there are a few gotchas: Mozilla just ignores DTDs (not validating) which brings about many problems (like missing entities) and you can&rsquo;t save or source-view the output of a XSLT transformation. Still, Mozilla is good enough. I don&rsquo;t know about Opera, but I heard good things.
- DTDs are just fine and they are more often than not an overkill. XML Schema and other formal ways to specify XML applications get little support in actual software and are just not so useful.
- Namespaces are a mess: they complicate things, they are incompatible with DTDs, and URIs as identifiers is a confusing idea. Yet, they work well enough and are usable.
- XSLT 1.0 is truly powerful and very convenient. Couple XSLT with [EXSLT extensions](http://exslt.org/) and you really can do pretty much anything you want. Exporting XML to HTML or to LaTeX is really easy. However, some things are tricky, like grouping. The best and fastest free XSLT engine I could find is [4suite](http://4suite.org/). XSLT 2.0 is still pretty much unsupported. Either way, whether you use EXSLT extensions or XSLT 2.0, you need things like regular expressions. 
- Programming for XML through something like DOM is a major pain. Maybe XOM is better, but the basic idea is that if you have powerful high level language like Python, Ruby, Javascript or Perl, DOM-like programming on top of XML is boring. It seems like it DOM was designed with Java or C++ in mind, languages that are already a pain to use in the first place. Still, DOM works well enough but I think you need to have XPath support in your language otherwise, things could get really verbose. (In Python, use the libxml2 wrapper.)
- Current RDF/XML is a pain, period. RDF itself is sane.


So, I think that a good XML project probably uses XSLT, maybe DTDs, a lot of XPath, but as little of the rest as possible.

