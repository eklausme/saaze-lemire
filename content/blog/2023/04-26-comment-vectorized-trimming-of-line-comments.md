---
date: "2023-04-26 12:00:00"
title: "Vectorized trimming of line comments"
index: false
---

[2 thoughts on &ldquo;Vectorized trimming of line comments&rdquo;](/lemire/blog/2023/04-26-vectorized-trimming-of-line-comments)

<ol class="comment-list">
<li id="comment-651560" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a22c7cbbd02ec5a3e5e4d852c69992c3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a22c7cbbd02ec5a3e5e4d852c69992c3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">yescallop</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-09T06:23:05+00:00">May 9, 2023 at 6:23 am</time></a> </div>
<div class="comment-content">
<p>Hard to imagine at first this can be managed using big integer subtraction! <a href="https://github.com/yescallop/simd-playground/blob/main/trim-line-comments/src/main.rs" rel="nofollow ugc">Here</a> is my attempt to implement this with Intel AVX-512.</p>
</div>
<ol class="children">
<li id="comment-651577" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-10T21:16:39+00:00">May 10, 2023 at 9:16 pm</time></a> </div>
<div class="comment-content">
<p>Thanks!</p>
</div>
</li>
</ol>
</li>
</ol>
