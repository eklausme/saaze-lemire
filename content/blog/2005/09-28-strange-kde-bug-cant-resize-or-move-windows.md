---
date: "2005-09-28 12:00:00"
title: "Strange KDE bug: can´t resize or move windows"
---



Today, I hit a strange KDE bug. I couldn&rsquo;t move or resize windows. Here&rsquo;s the cure:

<code> killall kwin<br/>
kwrapper kwin -replace &<br/>
</code>

