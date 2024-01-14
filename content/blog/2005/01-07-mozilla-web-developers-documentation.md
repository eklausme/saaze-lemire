---
date: "2005-01-07 12:00:00"
title: "Mozilla Web Developer´s documentation"
---



I wasted a lot of time last night searching for JavaScript documentation. My friend Scott Flinn was nice enough to give me these pointers regarding DOM and general Web work:

- [http://www.mozilla.org/docs/dom/](https://developer.mozilla.org/en-US/docs/Web/API/Document_Object_Model)
- [http://www.mozilla.org/docs/web-developer/](https://developer.mozilla.org/en-US/docs/Web/Guide)


This is much better than flying blind, but I wish I had something more like the [Java API documentation](http://docs.oracle.com/javase/1.5.0/docs/api/).

BTW if you don&rsquo;t know Scott Flinn, you should. He is probably the best technical resource I ever met. And I don&rsquo;t mean &ldquo;technical resource&rdquo; in an insulting way. He simply understands hands-on technology very deeply. He is also a pessimist like myself, so we do get along, I think.

Here&rsquo;s some advice from Scott:

>If you just want core JavaScript stuff, then you use [Rhino](https://developer.mozilla.org/en-US/docs/Mozilla/Projects/Rhino/Download_Rhino) or<br/>
SpiderMonkey (the Mozilla implementations in Java and C++ respectively).<br/>
I swear by Rhino. You just drop js.jar into your extensions directory<br/>
and add this simple script to your path:

 #!/bin/sh<br/>
java org.mozilla.javascript.tools.shell.Main

Then &lsquo;rhino&rsquo; will give you a command line prompt that will evaluate<br/>
arbitrary JavaScript expressions. The nice part is that you have<br/>
a bridge to Java, so you can do things like:

 js> sb = new java.lang.StringBuffer( &lsquo;This&rsquo; );<br/>
This<br/>
js> sb.append( &lsquo; works!&rsquo; );<br/>
This works!<br/>
js> sb<br/>
This works!



What I did was to [download Rhino](https://developer.mozilla.org/en-US/docs/Mozilla/Projects/Rhino/Download_Rhino), open the archive, and type &ldquo;java -jar js.jar&rdquo;. It brought up a console. System.out doesn&rsquo;t work, but you can print using the &ldquo;print&rdquo; command. (Update:Obviously, you have to do java.lang.System.out&hellip;)

