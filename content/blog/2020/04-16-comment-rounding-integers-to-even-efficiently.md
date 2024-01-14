---
date: "2020-04-16 12:00:00"
title: "Rounding integers to even, efficiently"
index: false
---

[2 thoughts on &ldquo;Rounding integers to even, efficiently&rdquo;](/lemire/blog/2020/04-16-rounding-integers-to-even-efficiently)

<ol class="comment-list">
<li id="comment-501633" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/772a802341e3848e248626d044dc2493?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/772a802341e3848e248626d044dc2493?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Falk Hüffner</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-17T20:08:54+00:00">April 17, 2020 at 8:08 pm</time></a> </div>
<div class="comment-content">
<p>Depending on which instructions are available, you might get slightly better code by replacing the last two lines with</p>
<p><code>return (d | (roundup ^ ismultiple)) &amp; roundup;<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-501645" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-17T21:56:03+00:00">April 17, 2020 at 9:56 pm</time></a> </div>
<div class="comment-content">
<p>Wow. I doubt it will be faster, at least on recent x64 processors, but your approach is nicer in that it is explicitly branchless. I like it a lot!!!</p>
</div>
</li>
</ol>
</li>
</ol>
