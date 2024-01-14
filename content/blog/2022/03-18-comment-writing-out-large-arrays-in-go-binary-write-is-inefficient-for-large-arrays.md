---
date: "2022-03-18 12:00:00"
title: "Writing out large arrays in Go: binary.Write is inefficient for large arrays"
index: false
---

[3 thoughts on &ldquo;Writing out large arrays in Go: binary.Write is inefficient for large arrays&rdquo;](/lemire/blog/2022/03-18-writing-out-large-arrays-in-go-binary-write-is-inefficient-for-large-arrays)

<ol class="comment-list">
<li id="comment-623628" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ab77f5ba95a5361f8de1d8a71d82f087?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ab77f5ba95a5361f8de1d8a71d82f087?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">pasha</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-03-18T22:56:00+00:00">March 18, 2022 at 10:56 pm</time></a> </div>
<div class="comment-content">
<p>For go 1.18 i have a little different results</p>
</div>
</li>
<li id="comment-623630" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/665b5f11dfc1fa01685d95dbee607d7b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/665b5f11dfc1fa01685d95dbee607d7b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">mischa sandberg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-03-19T01:09:03+00:00">March 19, 2022 at 1:09 am</time></a> </div>
<div class="comment-content">
<p>Was mmap (including the time to .Flush()) worth considering?</p>
</div>
<ol class="children">
<li id="comment-623635" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-03-19T03:47:43+00:00">March 19, 2022 at 3:47 am</time></a> </div>
<div class="comment-content">
<p>Maybe. Did you happen to try it out?</p>
</div>
</li>
</ol>
</li>
</ol>
