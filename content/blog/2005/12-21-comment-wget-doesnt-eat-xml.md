---
date: "2005-12-21 12:00:00"
title: "Wget doesn&#8217;t eat XML"
index: false
---

[One thought on &ldquo;Wget doesn&#8217;t eat XML&rdquo;](/lemire/blog/2005/12-21-wget-doesnt-eat-xml)

<ol class="comment-list">
<li id="comment-4547" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ac2fd70929515b458314c3d73c88a8f1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ac2fd70929515b458314c3d73c88a8f1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Michael Barth</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-05-06T05:03:16+00:00">May 6, 2006 at 5:03 am</time></a> </div>
<div class="comment-content">
<p>Hello,</p>
<p>I think wgets refusal to check for links inside the xml is more likely a result of only parsing text/html documents than a problem of parsing.<br/>
You can ask wget to regard all possible mime types as html to check with wget -F</p>
<p>with kind regards<br/>
Michael</p>
</div>
</li>
</ol>
