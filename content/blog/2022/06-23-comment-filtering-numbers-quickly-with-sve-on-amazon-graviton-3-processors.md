---
date: "2022-06-23 12:00:00"
title: "Filtering numbers quickly with SVE on Amazon Graviton 3 processors"
index: false
---

[4 thoughts on &ldquo;Filtering numbers quickly with SVE on Amazon Graviton 3 processors&rdquo;](/lemire/blog/2022/06-23-filtering-numbers-quickly-with-sve-on-amazon-graviton-3-processors)

<ol class="comment-list">
<li id="comment-637567" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-06-28T00:51:44+00:00">June 28, 2022 at 12:51 am</time></a> </div>
<div class="comment-content">
<p>Now I have to ask: how big is the vector?</p>
</div>
<ol class="children">
<li id="comment-637608" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-06-28T15:26:44+00:00">June 28, 2022 at 3:26 pm</time></a> </div>
<div class="comment-content">
<p>Ah. It is a secret.</p>
<p>(It appears to be 32 bytes.)</p>
</div>
<ol class="children">
<li id="comment-637613" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-06-28T15:54:52+00:00">June 28, 2022 at 3:54 pm</time></a> </div>
<div class="comment-content">
<p>You can actually figure it out from first principles. There are 9 instructions in the main loop&#8230;<br/>
<code><br/>
.LBB0_1: // =>This Inner Loop Header: Depth=1<br/>
ld1w { z0.s }, p0/z, [x0, x8, lsl #2]<br/>
add x8, x10, x8<br/>
cmpge p1.s, p0/z, z0.s, #0<br/>
compact z0.s, p1, z0.s<br/>
cntp x11, p0, p1.s<br/>
st1w { z0.s }, p0, [x2, x9, lsl #2]<br/>
add x9, x11, x9<br/>
whilelt p0.s, x8, x1<br/>
b.ne .LBB0_1<br/>
</code></p>
<p>I report 1.125 instructions per 32-bit words. 1.125 instruction/word*8 words = 9 instructions.</p>
<p>8 32-bit words is 8*4 = 32 bytes.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-639459" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5b398936012c5ab568223ef64750d802?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5b398936012c5ab568223ef64750d802?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Samuel Lee</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-14T01:36:47+00:00">July 14, 2022 at 1:36 am</time></a> </div>
<div class="comment-content">
<p>I understand Graviton3 is based on Neoverse V1 (<a href="https://developer.arm.com/documentation/PJDOC-466751330-9685/0101/" rel="nofollow ugc">https://developer.arm.com/documentation/PJDOC-466751330-9685/0101/</a>).</p>
<p>I&rsquo;m sure there is performance on the table if you were to unroll &#8211; looking at the V1 software optimization guide I think the critical resource is the M0 pipe where all of the predicate handling instructions are run &#8211; with cmpge having a latency of 4 cycles.</p>
<p>I think to maximise perf you would have a main loop where you ensure the load mask is all true for the next 4 loads, something like: <a href="https://godbolt.org/z/Mxh7sTen7" rel="nofollow ugc">https://godbolt.org/z/Mxh7sTen7</a><br/>
(I just checked it compiles / looks good, I have not actually tried to run it, so apologies if there is a dumb logic error!)</p>
<p>I _think_ this should mean we can get close to saturating the M0 pipe assuming we don&rsquo;t hit some bottleneck somewhere else I missed. We have 4x cmpge and 4x incp instructions using M0 per loop. So best case performance would be 0.25 cycles/integer (8 cycles / 32 integers), so about ~3x faster! 🙂</p>
</div>
</li>
</ol>
