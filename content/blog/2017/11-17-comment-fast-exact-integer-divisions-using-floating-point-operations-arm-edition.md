---
date: "2017-11-17 12:00:00"
title: "Fast exact integer divisions using floating-point operations (ARM edition)"
index: false
---

[4 thoughts on &ldquo;Fast exact integer divisions using floating-point operations (ARM edition)&rdquo;](/lemire/blog/2017/11-17-fast-exact-integer-divisions-using-floating-point-operations-arm-edition)

<ol class="comment-list">
<li id="comment-291642" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Cyril</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-18T11:52:00+00:00">November 18, 2017 at 11:52 am</time></a> </div>
<div class="comment-content">
<p>One important note, about UDIV/SDIV instruction on arm64 form ARMv8 ISA: &rdquo; The divide instructions do not generate a trap upon division by zero, but write zero to the destination register.&rdquo;</p>
</div>
</li>
<li id="comment-292725" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d081923c9998bd094289a54a0ee1045b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d081923c9998bd094289a54a0ee1045b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">eden segal</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-05T10:46:04+00:00">December 5, 2017 at 10:46 am</time></a> </div>
<div class="comment-content">
<p>Can you check the same on 16 bit integers and 32 bit floats? Maybe the arm processor divisor is not fast, say go through a lot of uops to get the results, but the 32 bit float is more probable to be fast.<br/>
Another caveat is that in SKX you are pushed more for a division less algorithm as you have only a double pumped 256b divisor for a 512b vector. Still no integer divisor so it&rsquo;s much more fast than scalar int.</p>
</div>
<ol class="children">
<li id="comment-292744" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-05T20:50:01+00:00">December 5, 2017 at 8:50 pm</time></a> </div>
<div class="comment-content">
<p>You can pull the same trick with 16-bit integers, yes. It is a good observation.</p>
</div>
</li>
</ol>
</li>
<li id="comment-651557" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5067eb1af1dee01029d2f796e444ce82?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5067eb1af1dee01029d2f796e444ce82?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Timothy Herchen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-08T20:16:36+00:00">May 8, 2023 at 8:16 pm</time></a> </div>
<div class="comment-content">
<p>This is nice. Note that if you need signed (floor) integer division this way, you can set the FP control register to round toward -inf (<code>_mm_setcsr(_MM_ROUND_TOWARD_ZERO)</code>, or <code>fesetround</code> for portability).</p>
</div>
</li>
</ol>
