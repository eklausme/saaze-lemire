---
date: "2006-11-29 12:00:00"
title: "Got XFig to run under Mac OS X in less than an hour"
index: false
---

[One thought on &ldquo;Got XFig to run under Mac OS X in less than an hour&rdquo;](/lemire/blog/2006/11-29-got-xfig-to-run-under-mac-os-x-in-less-than-an-hour)

<ol class="comment-list">
<li id="comment-49939" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a459a189bdf3b9bca35b4440778755b2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a459a189bdf3b9bca35b4440778755b2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Bastian</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-06-01T02:58:39+00:00">June 1, 2008 at 2:58 am</time></a> </div>
<div class="comment-content">
<p>I just compiled xfig without fink. It&rsquo;s quite easy. Just get the latest sources for xfig and transfig from <a href="http://www.xfig.org" rel="nofollow ugc">http://www.xfig.org</a>. In the xfig sources you have to change to files.<br/>
First the file xfig.h, there you have to get sure that it does not define any srandom(). So search for it and delete the whole #if &#8230; #elif &#8230; #endif block where all the srandom()&rsquo;s are defined.<br/>
Then in the file w_keyboard.c you have to add a &ldquo;#define REG_NOERROR 0&rdquo; somewhere on top in a separate line. (The last symbol is a zero, not an capital o.)<br/>
In the Imakefile you have to comment out the BINDIR variable, the XAW3D variable and the USEJPEG variable.<br/>
In the transfig package you have to set the right path for XFIGLIBDIR in the fig2dev Imakefile. It&rsquo;s /usr/X11/lib/X11/xfig. And I also uncommented out the LATEX2E variable in the transfig Imakefile.<br/>
xfig compiles using &ldquo;xmkmf; make; make install&rdquo;. For transfig there was &ldquo;xmkmf; make Makefiles; make; make install&rdquo; necessary.<br/>
But better one read the README files before doing this. The parameters in the Imakefiles are described very well there and also the commands to compile the sources. Only the changes in the two files I made are not described there.</p>
</div>
</li>
</ol>
