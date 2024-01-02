---
date: "2005-11-16 12:00:00"
title: "Grep is just not for matching lines anymore"
---



Thanks to Owen Kaser, I&rsquo;ve learned that grep can return just the match, and not the whole line.

These examples say it all:

<code>$ grep Ab phone<br/>
505-837-2938 Abby Abbott<br/>
212-940-2039 Abel Baker<br/>
301-302-3030 Abigail Adams<br/>
</code>

<code>$ grep â€“o 'Ab[^ ]*' phone<br/>
Abby<br/>
Abbott<br/>
Abel<br/>
Abigail</code>

So, you can get all email addresses in an HTML file using the following syntax (correct me if this is wrong):<br/>
<code>grep -o "[a-zA-Z\\.]*@[a-zA-Z\\.]*" somefile</code>

Under Windows, you can use the [Win32 port of grep](http://unxutils.sourceforge.net/) which has this feature. [Tim Charron&rsquo;s port of grep](http://www.interlog.com/~tcharron/grep.html) doesn&rsquo;t have it. Tim Charron&rsquo;s version is especially convenient since it supports a findutils-like function (grep -S &ldquo;pattern&rdquo; *.txt will go in subdirectories) whereas the [findutils port to Windows](http://gnuwin32.sourceforge.net/packages/findutils.htm) clashes with the Microsoft find command. (Don&rsquo;t tell me to use cygwin, I already do.)

Grep would be so much more useful however if it supported reluctant quantifiers.

