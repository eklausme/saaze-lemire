---
date: "2014-01-21 12:00:00"
title: "Are C++ and Java declining?"
---



In a recent Dr. Dobb&rsquo;s article, Binstock announced the decline of Java and C++:

> By all measures, C++ use declined last year, demonstrating that C++11 was not enough to reanimate the language&rsquo;s fortunes (&hellip;) Part of C++&rsquo;s decline might be due to the emergence of competing native languages.

> Mobile programming kept Objective-C advancing and it limited Java&rsquo;s decline. The latter was surely due to the language falling out of fashion (&hellip;) and the pressure exerted by other JVM languages (&hellip;)

The article provides no data to back up these &ldquo;declines&rdquo;. So let us look at the data ourselves. The article cites Ohloh. What Ohloh seems to do is look at the number of commits per programming language. According to Ohloh, both Java and C++ appear quite stable. They both have about 10% of the share of commits in open source projects, and that has been true for the last 6 years or so (C++ is the orange line while Java is the purple one).

So it is not clear what Binstock meant when he wrote that by all measures, C++ declined.

Finally, the article cites the [Tiobe index](http://www.tiobe.com/index.php/content/paperinfo/tpci/index.html). That is the only source that does show a decline. Java went from 24% to 17% in the last 5 years whereas C++ went from 15% to about 7%. But let us put this &ldquo;decline&rdquo; in perspective. Java is still within 1% of being the most popular language according to Tiobe while C++ is still in fourth place. What is more striking is that Objective C went from 0% to over 10% in a few short years (because of its use on Apple iOS).

But Binford points us to 2013. During that year, C++ went from 9.1% to 7.5%. A significant drop, to be sure. However, a much more significant story is that Python went from 4.2% to 2.4%. Maybe these wild variations should lead to us to question the Tiobe index over short periods of time?

If Android were to drop Java as the default language, we might be able to talk about an actual decline in Java use. However, Google did the opposite of dropping Java: [they just upgraded their support for Java](https://en.wikipedia.org/wiki/Dalvik_(software)#Android.27s_ART_virtual_machine). Java is clearly in good shape.

I don&rsquo;t know what the near future hold for C++. We did get a very strong upgrade that was quickly adopted by all vendors (C++11). However, C++ remains a very difficult language to master. It is not for everyone.

