---
date: "2007-02-07 12:00:00"
title: "Saner rules for udev"
index: false
---

[2 thoughts on &ldquo;Saner rules for udev&rdquo;](/lemire/blog/2007/02-07-saner-rules-for-udev)

<ol class="comment-list">
<li id="comment-49172" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/227dcc8c79584bb4af4f6a463c1aa6f7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/227dcc8c79584bb4af4f6a463c1aa6f7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">RivestF</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-02-08T10:32:51+00:00">February 8, 2007 at 10:32 am</time></a> </div>
<div class="comment-content">
<p>Weird change = -&gt; ==, and it does not seem consistent&#8230; !?! (Unless it is a difference between assumed to be constant versus variable?)</p>
</div>
</li>
<li id="comment-49173" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-02-08T11:02:36+00:00">February 8, 2007 at 11:02 am</time></a> </div>
<div class="comment-content">
<p>I think you have to read&#8230;.</p>
<p>a==1, b==2,c=4</p>
<p>as</p>
<p>i( a == 1 and b == 2) then c = 4</p>
<p>By rule-language people hate the &ldquo;if something then something else&rdquo;. They work very hard not to use it.</p>
</div>
</li>
</ol>
