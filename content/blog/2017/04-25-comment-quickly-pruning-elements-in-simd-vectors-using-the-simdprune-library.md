---
date: "2017-04-25 12:00:00"
title: "Quickly pruning elements in SIMD vectors using the simdprune library"
index: false
---

[9 thoughts on &ldquo;Quickly pruning elements in SIMD vectors using the simdprune library&rdquo;](/lemire/blog/2017/04-25-quickly-pruning-elements-in-simd-vectors-using-the-simdprune-library)

<ol class="comment-list">
<li id="comment-278735" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c62da1cd823176961c14bab1a5430c78?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c62da1cd823176961c14bab1a5430c78?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Gianluca Della Vedova</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-26T09:02:36+00:00">April 26, 2017 at 9:02 am</time></a> </div>
<div class="comment-content">
<p>In the example of the README of your project, shouldn&rsquo;t the zero vector 0,0,0,0,0,0,0,0 be a one vector 1,&#8230;,1?</p>
</div>
<ol class="children">
<li id="comment-278752" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-26T15:10:24+00:00">April 26, 2017 at 3:10 pm</time></a> </div>
<div class="comment-content">
<p>Yes. Fixed. Thank you.</p>
</div>
</li>
</ol>
</li>
<li id="comment-278758" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-26T17:41:23+00:00">April 26, 2017 at 5:41 pm</time></a> </div>
<div class="comment-content">
<p>There was a thread on stack exchange about packing left from a mask, and they recommended using PEXT to pull the bits. Would that work here?</p>
</div>
<ol class="children">
<li id="comment-278760" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-26T17:53:08+00:00">April 26, 2017 at 5:53 pm</time></a> </div>
<div class="comment-content">
<p>Yes. It can be made to work. It might be very useful for pruning bytes because the current solution, with a large table, is not ideal.</p>
<p>How to make it all come together for high efficiency is the tricky part.</p>
</div>
<ol class="children">
<li id="comment-278765" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-26T21:00:22+00:00">April 26, 2017 at 9:00 pm</time></a> </div>
<div class="comment-content">
<p>Here&rsquo;s the thread: <a href="http://stackoverflow.com/questions/36932240/avx2-what-is-the-most-efficient-way-to-pack-left-based-on-a-mask" rel="nofollow ugc">http://stackoverflow.com/questions/36932240/avx2-what-is-the-most-efficient-way-to-pack-left-based-on-a-mask</a></p>
<p>They also mention VCOMPRESSPS for 32-bit values under AVX512.</p>
</div>
<ol class="children">
<li id="comment-278766" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-26T21:06:40+00:00">April 26, 2017 at 9:06 pm</time></a> </div>
<div class="comment-content">
<p>I am aware of vcompress and it is mentioned in the README of the library. It is not super useful because none of us has access to it.</p>
<p>The BMI code is cool.</p>
</div>
<ol class="children">
<li id="comment-278769" class="comment byuser comment-author-lemire bypostauthor even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-26T22:55:39+00:00">April 26, 2017 at 10:55 pm</time></a> </div>
<div class="comment-content">
<p>I have added, for benchmarking purpose, the BMI approach and, in my tests, it is slower. The BMI instructions can be nice, but they often have high latency so if you string them with data dependencies, it is not always super efficient.</p>
</div>
<ol class="children">
<li id="comment-279106" class="comment odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-02T21:39:52+00:00">May 2, 2017 at 9:39 pm</time></a> </div>
<div class="comment-content">
<p>Ryzen instructions just came out on Agner&rsquo;s site, and PEXT/PDEP have reciprocal latency of 18 cycles. 🙁</p>
</div>
<ol class="children">
<li id="comment-279242" class="comment byuser comment-author-lemire bypostauthor even depth-7">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-04T16:07:38+00:00">May 4, 2017 at 4:07 pm</time></a> </div>
<div class="comment-content">
<p>@KWillets</p>
<p>That sounds bad. On the other hand, I am not sure that PEXT/PDEP is common in software, or even that it will become common.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
