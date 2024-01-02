---
date: "2007-02-11 12:00:00"
title: "HTML/CSS Trick of the day"
---



Do not worry, this blog will not turn into an HTML/CSS blog, but here is a nice trick to select all hyperlinks with absolute URIs:

<code><br/>
a[href^="http"] {<br/>
background:yellow;<br/>
}<br/>
</code><code>

This will, naturally, probably never work with Microsoft browsers, but it with Firefox 2.0.</code>

