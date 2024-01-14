---
date: "2023-12-08 12:00:00"
title: "Fast Buffer-to-String conversion in JavaScript with a Lookup Table"
index: false
---

[2 thoughts on &ldquo;Fast Buffer-to-String conversion in JavaScript with a Lookup Table&rdquo;](/lemire/blog/2023/12-08-fast-buffer-to-string-conversion-in-javascript-with-a-lookup-table)

<ol class="comment-list">
<li id="comment-656898" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e8dfea32f5fdc2e143c586b0015ba503?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e8dfea32f5fdc2e143c586b0015ba503?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Yann</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-13T10:21:48+00:00">December 13, 2023 at 10:21 am</time></a> </div>
<div class="comment-content">
<p>to cope with case, replacing &ldquo;(s[0] == 116 || s[0] == 84)&rdquo; with &ldquo;(s[0] &amp; 0xDF == 84)&rdquo;<br/>
and the others accordingly, makes the codes slightly faster for me.</p>
</div>
<ol class="children">
<li id="comment-656908" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-13T15:42:18+00:00">December 13, 2023 at 3:42 pm</time></a> </div>
<div class="comment-content">
<p>I am hoping that compilers can handle this optimization. Nevertheless, I have checked in a new Python script that can generate the code in this manner.</p>
</div>
</li>
</ol>
</li>
</ol>
