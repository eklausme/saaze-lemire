---
date: "2006-11-23 12:00:00"
title: "XFig running on Mac OS X thanks to Fink"
---



After all the [bad mouthing I did over Fink and X11](http://www.daniel-lemire.com/blog/archives/2006/11/22/why-fink-is-broken-for-anything-but-non-x-applications/), I got to my office and did this:

<code>cp /private/etc/X11/xinit/xinitrc ~/.xinitrc<br/>
chmod +w ~/.xinitrc<br/>
vim ~/.xinitrc (add . /sw/bin/init.sh as the first line)<br/>
</code>

Then, a bit later, I got this (click to enlarge):

