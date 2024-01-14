---
date: "2023-08-18 12:00:00"
title: "Transcoding Latin 1 strings to UTF-8 strings at 18 GB/s using AVX-512"
index: false
---

[One thought on &ldquo;Transcoding Latin 1 strings to UTF-8 strings at 18 GB/s using AVX-512&rdquo;](/lemire/blog/2023/08-18-transcoding-latin-1-strings-to-utf-8-strings-at-12-gb-s-using-avx-512)

<ol class="comment-list">
<li id="comment-654177" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-08-19T03:33:43+00:00">August 19, 2023 at 3:33 am</time></a> </div>
<div class="comment-content">
<p>My attempt: <a href="https://pastebin.com/pkswn1yt" rel="nofollow ugc">https://pastebin.com/pkswn1yt</a></p>
<p>The general problem with expanding is that you&rsquo;re only processing half the vector at a time.<br/>
If the likelihood of non-ASCII characters is rare, converting from UTF-8 makes better use of the vector width than converting to UTF-8.<br/>
In such a case, you can try to claw back some performance by adding shortcuts if few non-ASCII characters are detected. Though weirdly, it doesn&rsquo;t seem to work too well in my case; haven&rsquo;t really investigated why.</p>
</div>
</li>
</ol>
