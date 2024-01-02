---
date: "2007-12-07 12:00:00"
title: "For the Web hacker in you: Google Chart API"
---



I have said it again and again and I will keep on saying it: I am a hacker, a tweaker, a fiddler, and so on. And Google has just come up with one of the [most hackable Web API I have seen in years](https://developers.google.com/chart/?csw=1)! All it does, essentially, is to allow you to chart data on a Web site, but it does so very nicely using a [REST API](https://en.wikipedia.org/wiki/REST).

Suppose I want to create a bar chart made of the values 10, 58 and 95. The following URI (all on one line) will display the desired image:

<code><br/>
http://chart.apis.google.com/chart?chs=200x125<br/>
&amp;chd=t:10.0,58.0,95.0<br/>
&amp;cht=bvs<br/>
</code>

And the net result is this:

<a href="https://chart.apis.google.com/chart?chs=200x125&amp;chd=t:10.0,58.0,95.0&amp;cht=bvs&amp;chxt=y"><img decoding="async" src="https://chart.apis.google.com/chart?chs=200x125&amp;chd=t:10.0,58.0,95.0&amp;cht=bvs&amp;chxt=y" /></a>

If you are a Unix hacker, then Google just invented the Web equivalent to [gnuplot](https://en.wikipedia.org/wiki/Gnuplot).

__Update__: [Paul has some crazy plots!](https://blogs.oracle.com/roller-ui/errors/404.jsp) Here is one I like:

<img decoding="async" src="https://chart.apis.google.com/chart?cht=lc&#038;chd=s:9gounjqGJD&#038;chco=008000&#038;chls=2.0,4.0,1.0&#038;chs=200x125&#038;chxt=x&#038;chxl=0:||c|d|a|o|x|v|V|a|&#038;chm=a,990066,0,3.0,9.0|c,FF0000,0,1.0,20.0|d,80C65A,0,2.0,20.0|o,FF9900,0,4.0,20.0|s,3399CC,0,5.0,10.0|v,BBCCED,0,6.0,1.0|V,3399CC,0,7.0,1.0|x,FFCC33,0,8.0,20.0|h,000000,0,0.30,0.5" />

See also my posts [Writing and Maintaining Software are not Engineering Activities](/lemire/blog/2007/02/24/writing-and-maintaining-software-are-not-engineering-activities/), [The death of computing](/lemire/blog/2007/02/02/the-death-of-computing/) and [The end of SOA web services](/lemire/blog/2006/04/18/the-end-of-soa-web-services/).

__Source__: Parand.

(In other news, [Michael reports on Paperspine](https://expert-opinion.blogspot.com/2007/12/netflix-for-books.html), a service where you can get books delivered to your home Ã  la Netflix. I wonder whether they will invest as much as Netflix does on recommender systems? )

