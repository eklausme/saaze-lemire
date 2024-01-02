---
date: "2007-02-12 12:00:00"
title: "Web Semantics is Localized"
---



The Web, and the principles behind it, is mostly asemantic from a Computer Science point of view. I claim that most of the semantics is, in fact, highly local, at the __document level__.

First, observe that cross-document semantics is almost absent.

- The only semantics in hyperlinks is &ldquo;this resource points to this other resource which may or may not exist, which may or may not change over time&rdquo;. 
- Resource Identifiers or URLs or URIs are a way to name each resource. No particular semantics there. 
- The HTTP protocol (and related protocols) has some explicit semantics, but it is very simple (GET, POST, &hellip;). 


However, HTML and related markup languages are where most of the semantics lie. You can get the title of the page, for example, from any well formed HTML page. It is still fairly primitive, and in practice, there might be hardly any semantics present at all, but if there is any on the Web, that&rsquo;s where it is.

Why? As I said before, [semantics is complexity and complexity is hard](/lemire/blog/2007/01/14/too-much-semantics-is-harmful-in-information-technology/). But local complexity and thus, local semantics, is easier to manage. You can have a very complex algorithms that could still be practical in daily use. Consider image compression software. But the __complexity needs to be localized__.

Any attempt at making the Web semantically richer in a cross-document way is bound to fail. (I claim.) Feel free to build complex documents on your own. My blog is certainly a complex beast, and I have crazy semantics going on under the hood. But to export complexity on a global scale is silly. (I claim.)

