---
date: "2022-12-19 12:00:00"
title: "Implementing &#8216;strlen&#8217; using SVE"
index: false
---

[3 thoughts on &ldquo;Implementing &#8216;strlen&#8217; using SVE&rdquo;](/lemire/blog/2022/12-19-implementing-strlen-using-sve)

<ol class="comment-list">
<li id="comment-648516" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/28e3a6e2c8201e531d5ea4ff1a1067f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/28e3a6e2c8201e531d5ea4ff1a1067f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Laurent</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-21T11:12:32+00:00">December 21, 2022 at 11:12 am</time></a> </div>
<div class="comment-content">
<p>Hello,</p>
<p>As per specification, SVE vector length can&rsquo;t exceed 2048 bits/256 bytes so svcntb will never be larger than 256.</p>
<p>Beyond the slide deck you linked, Arm has published several routines here: <a href="https://github.com/ARM-software/optimized-routines/tree/master/string/aarch64" rel="nofollow ugc">https://github.com/ARM-software/optimized-routines/tree/master/string/aarch64</a></p>
</div>
<ol class="children">
<li id="comment-648517" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-21T13:41:19+00:00">December 21, 2022 at 1:41 pm</time></a> </div>
<div class="comment-content">
<p>Thanks: it is great to find out that my missing check was unnecessary.</p>
</div>
</li>
</ol>
</li>
<li id="comment-648603" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-27T20:24:50+00:00">December 27, 2022 at 8:24 pm</time></a> </div>
<div class="comment-content">
<p>As an aside, how much gain is there in eliminating the edge cases?</p>
<p>When writing string-use-intense applications, I tended to allocate string buffers of a power-of-two size (256 bytes or less), from a string pool, and reallocate through a free-list. Did this for efficiency in allocation (measured). As a side-effect those page-aligned size-quantized buffers would fit your algorithm without edge cases. Has to be some gain there.</p>
<p>How far does this go &#8211; if you design a string-class to take full advantage through eliminating edge-cases?</p>
<p>When we allocate a string buffer, we could always zero-fill the buffer (there will always be a zero), or non-zero-fill the buffer (only zero belongs to the written data). </p>
<p>Most application-strings are short &#8211; less than 256 bytes, and mostly less than 80 bytes. How much gain in unrolling the loop?</p>
<p>Clearly for very long strings, the edge-case hardly matters. But most strings are short &#8211; near to the size of a vector-stride.</p>
</div>
</li>
</ol>
