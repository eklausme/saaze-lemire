---
date: "2013-09-13 12:00:00"
title: "Are 8-bit or 16-bit counters faster than 32-bit counters?"
index: false
---

[One thought on &ldquo;Are 8-bit or 16-bit counters faster than 32-bit counters?&rdquo;](/lemire/blog/2013/09-13-are-8-bit-or-16-bit-counters-faster-than-32-bit-counters)

<ol class="comment-list">
<li id="comment-93205" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3ccaf45d7ab8ecc0e412fe911c9b9d10?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3ccaf45d7ab8ecc0e412fe911c9b9d10?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">John Regehr</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-09-13T19:18:52+00:00">September 13, 2013 at 7:18 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;d revise the conclusion a bit: Keep your working set inside the caches. This has nothing to do with counting, for performance purposes you&rsquo;re just touching RAM.</p>
</div>
</li>
</ol>
