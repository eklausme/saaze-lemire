---
date: "2022-05-25 12:00:00"
title: "Parsing JSON faster with Intel AVX-512"
index: false
---

[3 thoughts on &ldquo;Parsing JSON faster with Intel AVX-512&rdquo;](/lemire/blog/2022/05-25-parsing-json-faster-with-intel-avx-512)

<ol class="comment-list">
<li id="comment-634491" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Joe Duarte</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-05-27T19:36:08+00:00">May 27, 2022 at 7:36 pm</time></a> </div>
<div class="comment-content">
<p>Nice work Daniel.</p>
<p>Note that you said you got a &ldquo;doubling&rdquo; of speed in the first benchmark, but it&rsquo;s only a 61% bump.</p>
<p>And this bit is missing the word *instructions*: &ldquo;There are many AVX-512 that we are not using&#8230;&rdquo; There&rsquo;s also a &ldquo;most&rdquo; that should be &ldquo;mostly&rdquo;.</p>
</div>
<ol class="children">
<li id="comment-634492" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-05-27T20:17:38+00:00">May 27, 2022 at 8:17 pm</time></a> </div>
<div class="comment-content">
<p>Thank you.</p>
</div>
</li>
</ol>
</li>
<li id="comment-648998" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fd27818d065c145d2b963c0fad9b6db7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fd27818d065c145d2b963c0fad9b6db7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Valen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-20T07:04:48+00:00">January 20, 2023 at 7:04 am</time></a> </div>
<div class="comment-content">
<p>AMD Zen 4 has AVX-512</p>
</div>
</li>
</ol>
