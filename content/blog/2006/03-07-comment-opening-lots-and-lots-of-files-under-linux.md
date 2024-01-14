---
date: "2006-03-07 12:00:00"
title: "Opening lots and lots of files under Linux"
index: false
---

[One thought on &ldquo;Opening lots and lots of files under Linux&rdquo;](/lemire/blog/2006/03-07-opening-lots-and-lots-of-files-under-linux)

<ol class="comment-list">
<li id="comment-26913" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dcd035eb74dd0cf41ed38899d2d7689d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dcd035eb74dd0cf41ed38899d2d7689d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Michael Grundvig</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-09-03T17:14:41+00:00">September 3, 2006 at 5:14 pm</time></a> </div>
<div class="comment-content">
<p>Fust as an FYI for people reading this, that setting also effects the number of open socket connections the OS will allow. If you are running something with a large number of concurrent connections (say, a chat server) you can into the same problem. The error message reported will generally be something like &ldquo;too many open files&rdquo;, a bit of a misnomer for sockets. Have fun!</p>
</div>
</li>
</ol>
