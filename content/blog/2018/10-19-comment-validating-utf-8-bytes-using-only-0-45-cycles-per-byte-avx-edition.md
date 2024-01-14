---
date: "2018-10-19 12:00:00"
title: "Validating UTF-8 bytes using only 0.45 cycles per byte (AVX edition)"
index: false
---

[4 thoughts on &ldquo;Validating UTF-8 bytes using only 0.45 cycles per byte (AVX edition)&rdquo;](/lemire/blog/2018/10-19-validating-utf-8-bytes-using-only-0-45-cycles-per-byte-avx-edition)

<ol class="comment-list">
<li id="comment-358806" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4525a248f51e9114788f3856727ca258?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4525a248f51e9114788f3856727ca258?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Ludovic Kuty</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-20T12:31:56+00:00">October 20, 2018 at 12:31 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;What if we use 256-byte registers instead?&rdquo; IMHO there is a typo</p>
</div>
</li>
<li id="comment-358822" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d10ca8d11301c2f4993ac2279ce4b930?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d10ca8d11301c2f4993ac2279ce4b930?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Badger</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-20T13:55:22+00:00">October 20, 2018 at 1:55 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;What if we use 256-byte registers instead?&rdquo;</p>
<p>Then we&rsquo;re living in the future where 64k-bit cpu&rsquo;s are normal! =)</p>
</div>
</li>
<li id="comment-359260" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7feb88c05acd40f7dbd7ac27c39854f4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7feb88c05acd40f7dbd7ac27c39854f4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michael Bisbjerg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-22T10:55:23+00:00">October 22, 2018 at 10:55 am</time></a> </div>
<div class="comment-content">
<p>Does the code assume that UTF-8 strings are always byte aligned?</p>
<p>The trouble with UTF-8 is the variable-length, so you will eventually have one that crosses a 32-byte boundary.</p>
</div>
<ol class="children">
<li id="comment-359306" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-22T15:44:47+00:00">October 22, 2018 at 3:44 pm</time></a> </div>
<div class="comment-content">
<p>There is no assumption made with respect to alignment.</p>
</div>
</li>
</ol>
</li>
</ol>
