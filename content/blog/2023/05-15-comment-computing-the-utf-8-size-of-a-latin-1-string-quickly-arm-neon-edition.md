---
date: "2023-05-15 12:00:00"
title: "Computing the UTF-8 size of a Latin 1 string quickly (ARM NEON edition)"
index: false
---

[7 thoughts on &ldquo;Computing the UTF-8 size of a Latin 1 string quickly (ARM NEON edition)&rdquo;](/lemire/blog/2023/05-15-computing-the-utf-8-size-of-a-latin-1-string-quickly-arm-neon-edition)

<ol class="comment-list">
<li id="comment-651659" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-15T21:23:27+00:00">May 15, 2023 at 9:23 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
but once you reach speeds like 20 GB/s, it becomes difficult to go much faster without hitting memory and cache speed limits
</p></blockquote>
<p>Cache is often faster than 20GB/s, but all that depends on the CPU, RAM and size of data. You tested on an M2, but a Cortex A55 likely gives very different results, so one shouldn&rsquo;t overly assume general performance with just one test (particularly with ARM).</p>
<p>In terms of optimisation, I suspect a loop of <code>accum = vsraq_n_u8(accum, input, 7)</code> to be simpler/faster. You&rsquo;ll want to unroll it a bit, with multiple accumulators, to get around latency limitations of the instruction, and then will need to aggregate results every 255&#042;unroll iterations.</p>
</div>
<ol class="children">
<li id="comment-651661" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-15T22:44:11+00:00">May 15, 2023 at 10:44 pm</time></a> </div>
<div class="comment-content">
<p>I have updated the blog post with a faster routine. 🙂</p>
</div>
<ol class="children">
<li id="comment-651662" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-15T23:55:59+00:00">May 15, 2023 at 11:55 pm</time></a> </div>
<div class="comment-content">
<p>Well that goes to show that your initial assumption of 20GB/s being hard to exceed, can be achieved if you try. =)</p>
<p>Interested to see what you get with a <code>vsraq_n_u8</code> strategy!</p>
</div>
<ol class="children">
<li id="comment-651663" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-16T00:40:26+00:00">May 16, 2023 at 12:40 am</time></a> </div>
<div class="comment-content">
<p>Point taken.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-651664" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-16T00:45:57+00:00">May 16, 2023 at 12:45 am</time></a> </div>
<div class="comment-content">
<p>Your &lsquo;simpler&rsquo; variant may not compile without adding a <code>vreinterpretq_s8_u8</code> to the <code>vaddvq_s8</code> line.</p>
<p>Tested on a Neoverse N1:</p>
<p><code>scalar (with autovec)<br/>
ns/bytes 0.169661<br/>
GB/s 5.89412<br/>
ns/bytes 0.177977<br/>
GB/s 5.61869<br/>
ns/bytes 0.174651<br/>
GB/s 5.72571</p>
<p>kvakil<br/>
ns/bytes 0.0565536<br/>
GB/s 17.6824<br/>
ns/bytes 0.0565536<br/>
GB/s 17.6824<br/>
ns/bytes 0.0582169<br/>
GB/s 17.1771</p>
<p>faster<br/>
ns/bytes 0.0465735<br/>
GB/s 21.4714<br/>
ns/bytes 0.0482369<br/>
GB/s 20.731<br/>
ns/bytes 0.0482369<br/>
GB/s 20.731</p>
<p>shift<br/>
ns/bytes 0.0149701<br/>
GB/s 66.8<br/>
ns/bytes 0.0166334<br/>
GB/s 60.12<br/>
ns/bytes 0.0166334<br/>
GB/s 60.12<br/>
</code></p>
<p>Shift version: <a href="https://godbolt.org/z/azaqfP5ox" rel="nofollow ugc">https://godbolt.org/z/azaqfP5ox</a></p>
</div>
<ol class="children">
<li id="comment-651682" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5bebde4e761c492dd1fcec6f42d108ff?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5bebde4e761c492dd1fcec6f42d108ff?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dougall Johnson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-17T09:13:16+00:00">May 17, 2023 at 9:13 am</time></a> </div>
<div class="comment-content">
<p>Yeah, USRA is the perfect instruction for this task. On M2, with 3-cycle latency and 4-per-cycle throughput, you may want to split it across 12 seperate accumulator registers. However, you&rsquo;d be memory bound. M2 only has 3-per-cycle load throughput, so it should max-out at 9 separate accumulator registers. (48-bytes/cycle at 3.5GHz gives a theoretical 168GB/s, but that&rsquo;s just the maximum speed for loads.)</p>
</div>
<ol class="children">
<li id="comment-651707" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5b398936012c5ab568223ef64750d802?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5b398936012c5ab568223ef64750d802?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Samuel Lee</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-19T00:27:09+00:00">May 19, 2023 at 12:27 am</time></a> </div>
<div class="comment-content">
<p>I agree that to maximise throughput on Apple Firestorm it seems like at least 9 accumulators in the innermost loop, with 3 of them being written to by a USRA instruction per cycle is the best you can do. Dougall, I really appreciate <a href="https://dougallj.github.io/applecpu/" rel="nofollow ugc">https://dougallj.github.io/applecpu/</a> !</p>
<p>For Neoverse N1/N2, V1/V2 this is not quite optimal though; only half of their ASIMD pipelines support USRA, so for N1/N2 the maximum throughput is 16B/cycle, and for V1/V2 the maximum throughput is 32B/cycle when using USRA alone. <a href="https://developer.arm.com/documentation/#q=neoverse%20software%20optimization%20guide" rel="nofollow ugc">See the software optimization guides</a></p>
<p>For these microarchitectures I think it&rsquo;s better to have 2/3s of the accumulators written with USRA, and 1/3 of the accumulators written with 2 instructions: CMLT (zero) and SUB.</p>
<p>If scheduled correctly, this should give a 50% throughput improvement vs. using the pure USRA approach (i.e. 24B/cycle and 48B/cycle respectively).<br/>
You need at least 8 USRA accumulator registers to make full use of USRA on V1/V2 (4 cycles latency x 2 pipes throughput). Then you can have 4 accumulators for CMLT+SUB approach.</p>
<p>As Firestorm is bound by loads (3 ASIMD loads per cycle vs. 4 ASIMD execution units), this variant should run as fast on those uarch as the fully unrolled pure USRA approach.</p>
<p>(Untested!) example code here:<br/>
<a href="https://godbolt.org/z/1M8411fGf" rel="nofollow ugc">https://godbolt.org/z/1M8411fGf</a></p>
<p>Note it looks like GCC does what I intended, but clang unfortunately optimizes the 2 instructions back to USRA.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
