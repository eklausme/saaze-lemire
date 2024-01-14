---
date: "2023-09-13 12:00:00"
title: "Transcoding Unicode strings at crazy speeds with AVX-512"
index: false
---

[2 thoughts on &ldquo;Transcoding Unicode strings at crazy speeds with AVX-512&rdquo;](/lemire/blog/2023/09-13-transcoding-unicode-strings-at-crazy-speeds-with-avx-512)

<ol class="comment-list">
<li id="comment-654683" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-09-14T22:34:07+00:00">September 14, 2023 at 10:34 pm</time></a> </div>
<div class="comment-content">
<p>I think I understand what you&rsquo;re doing in expand_and_identify, you&rsquo;re trying every alignment of 4 bytes and compressing the ones that coincide with initials?</p>
</div>
<ol class="children">
<li id="comment-654697" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-09-15T14:39:21+00:00">September 15, 2023 at 2:39 pm</time></a> </div>
<div class="comment-content">
<p>I see you have been reading the code. This was the original approach for UTF-8 to UTF-16 but it has been replaced with something more efficient.</p>
</div>
</li>
</ol>
</li>
</ol>
