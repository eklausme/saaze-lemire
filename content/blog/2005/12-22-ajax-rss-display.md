---
date: "2005-12-22 12:00:00"
title: "AJAX RSS Display"
---



Using JavaScript only without any server-side script, you want to be able to display a RSS feed? Easy! (But it took me 3 hours of hacking.) First setup a web page like this (__write your own HTML__, this is only an example):

<code>&lt;html><br/>
&lt;head><br/>
&lt;title>JavaScript RSS Reader&lt;/title><br/>
&lt;script language="JavaScript" xsrc="rss.js"<br/>
mce_src="rss.js" >&lt;/script><br/>
&lt;/head><br/>
&lt;body><br/>
&lt;h1>JavaScript RSS Reader&lt;/h1><br/>
&lt;div id="rss">&lt;/div><br/>
&lt;script language="JavaScript"><br/>
displayRSS("http://www.domain.com/rssfeed");<br/>
&lt;/script><br/>
&lt;/body></code>

You can [download the rss.js script](http://pastebin.com/MtJ5Fr9d).

VoilÃ ! No need for any server-side processing of the RSS feeds. You can magically display RSS feeds everywhere. Of course, this will only work with recent browsers.

Why is this useful? I found that the typical PHP-based solutions to parse RSS feeds were a pain to setup.

The downside? The RSS feed is read each time the page is displayed. However, the browser does a lot of the work (XML parsing) so I suspect this is an acceptable solution.

Any limitations? The only limitation is that the RSS feed must come from the same domain name as the HTML page because of the JavaScript security model. You can get around this limitation by making local copies of the RSS feeds using simple tools like wget and cron. I really wish the security model could be relaxed as it would make JavaScript much more potent.

Here&rsquo;s an excellent reference on AJAX: [using the XMLHttpRequest object](http://jibbering.com/2002/4/httprequest.html). It is a bit technical, and it is not complete, but it is the most concise and useful reference I found.

__Update:__ [Stephen Downes](http://www.downes.ca/cgi-bin/page.cgi?post=33046) reported this script in his newsletter.

__Update 2:__ Please do not load the script from my server, make a copy! You are stealing my bandwidth! If so many people keep doing it, I will have to get nasty.

__Update 3:__ No, this will not work with Atom. Nor will it work with all versions of RSS. You need to hack the JavaScript if you want to support anything but RSS 2.0. I have nothing against Atom, I just didn&rsquo;t need to support it.

