---
date: "2016-08-25 12:00:00"
title: "Faster dictionary decoding with SIMD instructions"
index: false
---

[4 thoughts on &ldquo;Faster dictionary decoding with SIMD instructions&rdquo;](/lemire/blog/2016/08-25-faster-dictionary-decoding-with-simd-instructions)

<ol class="comment-list">
<li id="comment-250747" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1cd46a26ceada395ae900bd4cd40a052?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1cd46a26ceada395ae900bd4cd40a052?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://fulmicoton.com" class="url" rel="ugc external nofollow">Paul Masurel</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-26T05:42:00+00:00">August 26, 2016 at 5:42 am</time></a> </div>
<div class="comment-content">
<p>Hi! Do you think this instruction be used in a search scenario, to gather matching docs &ldquo;docvalues&rdquo; (for scoring, or aggregating statistics).</p>
</div>
<ol class="children">
<li id="comment-250786" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-26T13:10:54+00:00">August 26, 2016 at 1:10 pm</time></a> </div>
<div class="comment-content">
<p>Yes, it definitively can be used within a search engine.</p>
</div>
<ol class="children">
<li id="comment-251003" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1cd46a26ceada395ae900bd4cd40a052?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1cd46a26ceada395ae900bd4cd40a052?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://fulmicoton.com" class="url" rel="ugc external nofollow">Paul Masurel</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-29T02:52:36+00:00">August 29, 2016 at 2:52 am</time></a> </div>
<div class="comment-content">
<p>Thanks!</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-251150" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/530ee6794861e89d935ced6a18bb87a4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/530ee6794861e89d935ced6a18bb87a4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://jeffplaisance.com" class="url" rel="ugc external nofollow">Jeff Plaisance</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-30T17:44:10+00:00">August 30, 2016 at 5:44 pm</time></a> </div>
<div class="comment-content">
<p>I did not realize that Intel had improved the gather performance in their latest processors. I have a few things I wanted to try speeding up with gather but since it wasn&rsquo;t any faster than sequential loads in Haswell I&rsquo;d shelved those ideas. The most straightforward one is a base64 decoder that uses a 65536 entry lookup table to lookup 8 groups of 2 bytes at a time and decode that into 12 bytes of output. Not sure if it&rsquo;ll be faster than a conventional decoder but it&rsquo;s probably worth testing.</p>
</div>
</li>
</ol>
