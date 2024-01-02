---
date: "2005-09-02 12:00:00"
title: "Winfixer got to me, but I had the last word"
---



I run Linux with Firefox exclusively. Hence, I don&rsquo;t need a product which supposedly fixes Windows. Such a product, called Winfixer, has managed to install a popup in my Firefox. Every time I start Firefox, a Winfixer popup tells me they found several problems on my machine (yeah! right!), I searched on the web for help, but all I see are ways to seek and destroy a trojan under Windows. The thing is, under Linux, I only run Firefox as an unpriviliged user, so it is very unlikely that a Linux trojan written by Winfixer infested my system. What is more likely is that Firefox, or an extension I use, has a fault of some sort allowing web sites to leave JavaScript commands to be executed whenever I start Firefox. I suspect the SessionSaver extension to be guilty.

In any case, why should I tolerate these popups?

To get rid of them, I added the following line in /etc/hosts
```C

127.0.0.1       www.winfixer.com
```


(You can do something similar under Windows by [editing the LMHOSTS file](https://support.microsoft.com/en-us/kb/314108). I suspect you can also do something similar under MacOS.)

That&rsquo;s it. No more insanity. It is now impossible for any script on my machine to query their domain.

Hint to system administrators: blacklist the winfixer domain __now__.

This leaves two questions:

- Is it morality acceptable for a company like Winfixer to use such means to sell their product? Is it even legal?
- Who are the idiots buying Winfixer?


