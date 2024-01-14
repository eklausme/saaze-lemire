---
date: "2007-01-18 12:00:00"
title: "Color terminal under Mac OS X"
index: false
---

[4 thoughts on &ldquo;Color terminal under Mac OS X&rdquo;](/lemire/blog/2007/01-18-color-terminal-under-mac-os-x)

<ol class="comment-list">
<li id="comment-49112" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7361130199533952178a6d87e9b29faa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7361130199533952178a6d87e9b29faa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Peter Turney</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-01-18T17:00:07+00:00">January 18, 2007 at 5:00 pm</time></a> </div>
<div class="comment-content">
<p>FYI, here is my PS1:</p>
<p>export PS1=&rdquo;[[e[33m]u@H [e[32m]w[e[0m]]n[[e[31m]![e[0m]] &gt; &rdquo;</p>
</div>
</li>
<li id="comment-49117" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f96b6dddce93b907792c91fa22f7324f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f96b6dddce93b907792c91fa22f7324f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">phil</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-01-20T00:26:26+00:00">January 20, 2007 at 12:26 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m pretty sure that in the normal course of events, bash reads your .bash_profile on login. Most .bash_profile files then source the .bashrc</p>
<p>Ex .bash_profile:</p>
<p># Get the aliases and functions<br/>
if [ -f ~/.bashrc ]; then<br/>
. ~/.bashrc<br/>
fi</p>
</div>
</li>
<li id="comment-49219" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">whiteknight</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-03-26T09:28:31+00:00">March 26, 2007 at 9:28 am</time></a> </div>
<div class="comment-content">
<p>login shells read .bash_profile<br/>
non login shells read .bashrc</p>
</div>
</li>
<li id="comment-50689" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/239cfdd66c7428c1f111be6bd06cd7ce?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/239cfdd66c7428c1f111be6bd06cd7ce?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://sethholloway.com/blog/" class="url" rel="ugc external nofollow">Seth</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-02-22T11:31:19+00:00">February 22, 2009 at 11:31 am</time></a> </div>
<div class="comment-content">
<p>This worked perfectly! Thank you very much for the clear write-up and great color scheme.</p>
</div>
</li>
</ol>
