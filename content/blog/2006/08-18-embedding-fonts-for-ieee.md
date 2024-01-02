---
date: "2006-08-18 12:00:00"
title: "Embedding fonts for IEEE"
---



IEEE requires that your PDF files embed all fonts. If you are including figures, it might prove difficult to embed them. Here is a recipe that works. Start with a file called &ldquo;ICRA05.pdf&rdquo;.

1. convert to ps: <span style="color: #555;">pdftops ICRA05.pdf</span>
1. convert back to pdf using prepress settings: <span style="color: #555;">ps2pdf14 -dPDFSETTINGS=/prepress ICRA05.ps</span>
1. check new <span style="color: #555;">ICRA05.pdf</span> for horrendous formatting errors due to double conversion.


(Source: Owen Kaser.)

Subscribe to this blog<br/>
<a title="Subscribe to my feed" href="https://lemire.me/blog/feed/" rel="alternate" type="application/rss+xml">in a reader</a><br/>
or [by Email.](http://www.feedburner.com/fb/a/emailverifySubmit?feedId=1396075&amp;loc=en_US)

