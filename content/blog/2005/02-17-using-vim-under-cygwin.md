---
date: "2005-02-17 12:00:00"
title: "Using Vim under Cygwin"
---



Cygwin is a marvelous idea: run a Linux-like shell under Windows. It allows me to run Python, CVS, Perl&hellip; almost everything I use under Linux, under Windows. Well, it doesn&rsquo;t quite work as well, but for small things, it does the job.

One thing that has annoyed me is their implementation of vim. The keyboard support is bad. In my .inputrc, I have these lines
```C

# enable 8-bits characters ...
set meta-flag on
set convert-meta off
set output-meta on
```


They seem to clash with vim in a bad way. Ah! But you can also install a version of vim running directly on top of windows. If you do this, then you can use this other version instead of the one that comes with cygwin.

All I had to do was to create this little script:
```C

 "/cygdrive/c/Program Files/Vim/vim63/vim.exe" `cygpath -w $1`
```


The trick here is that you need to convert Linux-like paths (like /tmp) into Windows path (C:&hellip;). My little script is bad in many ways, but it will work if you call vim with only a file name as an argument.

My solution does fail in some nasty ways. For example, when I do a CVS commit, I can&rsquo;t enter my comment. Bad.

See also my post [Grep is just not for matching lines anymore](http://www.daniel-lemire.com/blog/archives/2005/11/16/grep-is-just-not-for-matching-lines-anymore/).

Subscribe to this blog <a title="Subscribe to my feed" type="application/rss+xml" href="https://lemire.me/blog/feed/" rel="alternate"></a><br/>
<a title="Subscribe to my feed" type="application/rss+xml" href="https://lemire.me/blog/feed/" rel="alternate">in a reader</a><br/>
or [by Email.](http://www.feedburner.com/fb/a/emailverifySubmit?feedId=1396075&amp;loc=en_US)

