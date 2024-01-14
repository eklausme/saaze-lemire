---
date: "2004-10-31 12:00:00"
title: "McGrath on XML usage for Web clients"
---



[Interesting post by Sean McGrath](https://seanmcgrath.blogspot.com/archives/2004_10_24_seanmcgrath_archive.html#109912951985490558) (not the [inDiscover](http://www.indiscover.net)&lsquo;s Sean McGrath, the Propylon&rsquo;s Sean McGrath) on how [Gmail](https://accounts.google.com/ServiceLogin?service=mail&amp;passive=true&amp;rm=false&amp;continue=https://mail.google.com/mail/&amp;ss=1&amp;scc=1&amp;ltmpl=default&amp;ltmplcache=2&amp;emr=1&amp;osid=1) (Google Mail) was designed. For those who don&rsquo;t know Gmail is a revolutionary Web mail service Ã  la Hotmail, a step beyond anything else I had ever seen. He explains that Gmail is thin client running thanks to javascript (and not Java!!!).

This bring him to raise an interesting question. Why doesn&rsquo;t Gmail sends XML back and forth? Indeed, isn&rsquo;t XML the data format of the Web? Here&rsquo;s what he has to say:

>Web clients carry around a basic, low level programming language called Javascript. The real beauty of Javascript is that it is dynamic &#8211; you can blurr the distinction between code and data. You can hoist the level of abstraction you work with in your app by layering domain specific concepts on top of it in the form of functions and data structures. You can sling across data structures already teed up for use on the other end with the aid of the magic of &ldquo;eval&rdquo;. You can implement complex behaviour by sending across a program to be run rather than trying to explain what you want done declaratively to the other side.

Now, in such a world &#8211; would you send XML data to and from? Developers with a static typing programming language background might be inclined to say yes but I suspect javascriptophiles, lispers, pythoneers and rubyites are more likely to say no. Reason being, it is so much more natural to exchange lumps of code &#8211; mere text strings remember &#8211; that can be eval&rsquo;ed to re-create the data structure you have in the XML.



I think he is very much on target in the sense that people who see everything as Java or C# are likely to perceive XML very much differently from people using higher level languages.

The lesson here people is that you should master a range of languages and not one or two. And no, taking a class in Haskell once in your life doesn&rsquo;t qualify.

