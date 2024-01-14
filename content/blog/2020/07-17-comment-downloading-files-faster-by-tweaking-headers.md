---
date: "2020-07-17 12:00:00"
title: "Downloading files faster by tweaking headers"
index: false
---

[2 thoughts on &ldquo;Downloading files faster by tweaking headers&rdquo;](/lemire/blog/2020/07-17-downloading-files-faster-by-tweaking-headers)

<ol class="comment-list">
<li id="comment-539032" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e8f9e5293feb1792ee2ad1a8cf14051?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e8f9e5293feb1792ee2ad1a8cf14051?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://melsiddieg.github.io/" class="url" rel="ugc external nofollow">Mohammed O.E Abdallah</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-18T08:29:27+00:00">July 18, 2020 at 8:29 am</time></a> </div>
<div class="comment-content">
<p>Hi @lemire Thanks for following up on this issue.<br/>
using R curl package you can specify headers to accept gzip content and curl will automatically download and unzip for you</p>
<p><code>"Accept-Encoding": "deflate, gzip"<br/>
</code></p>
<p>I had to use it in my own package to support fast downloads in regions with low internet speed (developing countries). More importantly, using curl open the door to more speed enhancements including asynchronous downloads which cuts the download time even further especially if the dwonload server allows for concurrent downloads. I am not a network guru, but I think we can combine the goodies of curl and Rppsimdjson in a new package.</p>
</div>
</li>
<li id="comment-539082" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5726907110cebc4862b0650738fb420d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5726907110cebc4862b0650738fb420d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Dr. Shishir S. Urdhwareshe</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-18T17:25:11+00:00">July 18, 2020 at 5:25 pm</time></a> </div>
<div class="comment-content">
<p>Thanks.<br/>
And thanks also @Mohammed O.E Abdallah for suggesting simdjason library</p>
</div>
</li>
</ol>
