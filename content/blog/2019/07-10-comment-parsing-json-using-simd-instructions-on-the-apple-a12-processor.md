---
date: "2019-07-10 12:00:00"
title: "Parsing JSON using SIMD instructions on the Apple A12 processor"
index: false
---

[17 thoughts on &ldquo;Parsing JSON using SIMD instructions on the Apple A12 processor&rdquo;](/lemire/blog/2019/07-10-parsing-json-using-simd-instructions-on-the-apple-a12-processor)

<ol class="comment-list">
<li id="comment-416834" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-10T09:59:40+00:00">July 10, 2019 at 9:59 am</time></a> </div>
<div class="comment-content">
<p>Why not run the tests with the Skylake clocked at 2.5GHz instead? Test will still have caveats, but at least the numbers would be &ldquo;real&rdquo;.</p>
</div>
<ol class="children">
<li id="comment-416842" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-10T12:03:45+00:00">July 10, 2019 at 12:03 pm</time></a> </div>
<div class="comment-content">
<p>You could rescale everything from 3.7 GHz to 2.5 GHz if you&rsquo;d like. Given that we are essentially CPU bound, numbers scale with frequency linearly (to a good degree).</p>
</div>
<ol class="children">
<li id="comment-417012" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maynard Handley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-11T20:57:24+00:00">July 11, 2019 at 8:57 pm</time></a> </div>
<div class="comment-content">
<p>Actually the result as is is rather nice.<br/>
Apple has 3 SIMD units in the more recent chips, Intel has 2 SSE or AVX units. So you would expect, naively (and assuming perfect independence of all the important instructions) Apple at 2.5GHz to more or less match Skylake at 1.5*2.5GHz&#8230;</p>
<p>The next step would be Apple with SVE, but SVE (like first round AVX) is primarily FP, you’d really want SVE2.<br/>
My <em>guess!</em> is this year we get SVE (as two units, 256 wide) with SVE2 in two years. But what do I know?</p>
<p>You could also try using Apple’s JSON libraries. One would hope those are optimized (including for SIMD) though who knows? And they may be optimized for error-handling or a particular programming model rather than absolute performance?</p>
</div>
<ol class="children">
<li id="comment-417180" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-13T01:46:47+00:00">July 13, 2019 at 1:46 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
Intel has 2 SSE or AVX units
</p></blockquote>
<p>Recent Intel has three SIMD units, and AMD Zen (128-bit units) and Zen2 (256-bit units) have 4.</p>
<p>However, the Intel units are not symmetric: not all operations can occur on all units, although some can such as logical operations and some integer math. So depending on the mix of operations, an Intel chip might behave like it has 1, 2 or 3 SIMD units.</p>
<p>I don&rsquo;t think all of simdjson is vectorized, so the vector related scaling only affects a portion of the algorithm: the scaling of the other parts will depend on scalar performance.</p>
</div>
<ol class="children">
<li id="comment-417188" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maynard Handley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-13T02:09:41+00:00">July 13, 2019 at 2:09 am</time></a> </div>
<div class="comment-content">
<p>Thanks for the clarification.<br/>
Given your statements, I’m then really surprised at the gap. Of course Apple is wider, but this doesn’t seem like code for which that would help THAT much.</p>
<p>Is this a case where the NEON intrinsics are just a nicer fit to the problem? Or where certain high latency ops (at least lookups and permutes, for example) run in fewer cycles on Apple?</p>
</div>
<ol class="children">
<li id="comment-417197" class="comment odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-13T02:54:12+00:00">July 13, 2019 at 2:54 am</time></a> </div>
<div class="comment-content">
<p>What gap exactly? You mean the part where the Intel SSE throughput doesn&rsquo;t exceed the A12 performance by 3.7/2.5?</p>
<p>The implementation has a scalar part and an SIMD part, so the problem doesn&rsquo;t scale linearly with SIMD width (note also the AVX performance not being double the SSE performance on the same chip). So you can&rsquo;t apply your SIMD width calculation to the overall performance. We already know A12 usually does more scalar work per cycle, so this can explain it.</p>
<p>Also, you can&rsquo;t just count the number of SIMD EUs, because they are highly asymmetric on Intel and perhaps on Apple chips. If doesn&rsquo;t matter that you have three EUs if you are primary bound by say shuffles which only one EU supports.</p>
</div>
<ol class="children">
<li id="comment-417207" class="comment even depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maynard Handley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-13T03:45:40+00:00">July 13, 2019 at 3:45 am</time></a> </div>
<div class="comment-content">
<p>&ldquo;If doesn’t matter that you have three EUs if you are primary bound by say shuffles which only one EU supports.&rdquo;</p>
<p>OK, that&rsquo;s the sort of thing I was after.<br/>
As far as I can tell the Apple cores are extremely symmetric except for the usual weirdness around integer division and multiplication. I&rsquo;ve never seen anything to suggest asymmetric NEON support.</p>
<p>&ldquo;We already know A12 usually does more scalar work per cycle, so this can explain it.&rdquo;<br/>
This I&rsquo;m less convinced by, in that I find it hard to believe either core is hitting even an IPC of 4. I&rsquo;d expect that, even in carefully tweaked hand assembly, this is a hard problem to scale to high IPC.<br/>
Maybe I&rsquo;m wrong! That&rsquo;s just a gut feeling&#8230;</p>
</div>
<ol class="children">
<li id="comment-417208" class="comment odd alt depth-8">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-13T04:03:55+00:00">July 13, 2019 at 4:03 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
This I’m less convinced by, in that I find it hard to believe either core is hitting even an IPC of 4. I’d expect that, even in carefully tweaked hand assembly, this is a hard problem to scale to high IPC.<br/>
Maybe I’m wrong! That’s just a gut feeling…
</p></blockquote>
<p>What does IPC &gt; 4 have to do with anything?</p>
<p>A12 gets higher IPC (and higher &ldquo;work per cycle&rdquo; which is what we are really talking about) in general, but running at an IPC &gt; 4 is not in any way a prerequisite for that.</p>
<p>In general A12 does better than pure frequency scaling would suggest: both because the A12 is more braniac (does more work per cycle), and because scaling distorts things like misses to L3 or DRAM which are at least partly measured not in cycles but in real time (or DDR cycles or whatever, that doesn&rsquo;t scale with CPU frequency).</p>
<p>So if you are expecting an Intel chip at 3.7 GHz and an A12 chip at 2.5 GHz to perform in a ratio of 3.7/2.5 you&rsquo;ll be disappointed most of the time and I don&rsquo;t see any reason for this code to be different.</p>
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
</li>
<li id="comment-416866" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.joseduarte.com" class="url" rel="ugc external nofollow">José Duarte</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-10T15:42:32+00:00">July 10, 2019 at 3:42 pm</time></a> </div>
<div class="comment-content">
<p>Nice work. Can you clarify your note about not optimizing for the A12? First, what do you mean by &ldquo;ARM vs. Apple&rdquo;? Weren&rsquo;t they the same thing in this case? And what sort of optimizations did you not do for the A12 code? You used SIMD so I&rsquo;m not sure what else what was on the table.</p>
</div>
<ol class="children">
<li id="comment-416892" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-10T20:11:37+00:00">July 10, 2019 at 8:11 pm</time></a> </div>
<div class="comment-content">
<p><em>First, what do you mean by “ARM vs. Apple”?</em></p>
<p>It was a typo. It is Intel vs. Apple.</p>
<p><em>And what sort of optimizations did you not do for the A12 code? You used SIMD so I’m not sure what else what was on the table.</em></p>
<p>There are many design choices, there are often 10 different ways to implement a given function.</p>
<p>The fact that we use SIMD instructions for part of the code is no guarantee that we are making full use of the processor. It is very likely that someone who knows ARM well could beat our implementation&#8230; by an untold margin.</p>
<p>The AVX implementation received more tuning so it is less likely that you could beat it by much.</p>
<p>For example, our UTF-8 validation on ARM is likely slower than it should be and we even have better code samples (it is an issue in the project), we just did not have time to assess it.</p>
</div>
</li>
</ol>
</li>
<li id="comment-416963" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c97772f41d25c73c4e5d680e35f2fb41?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c97772f41d25c73c4e5d680e35f2fb41?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://nanxiao.me/en/" class="url" rel="ugc external nofollow">Nan Xiao</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-11T08:52:31+00:00">July 11, 2019 at 8:52 am</time></a> </div>
<div class="comment-content">
<p>Great article! Maybe a small typo in first section:</p>
<blockquote><p>
It a form of parallelism ..
</p></blockquote>
<p>Should not it be:</p>
<blockquote><p>
It is a form of parallelism &#8230;
</p></blockquote>
</div>
<ol class="children">
<li id="comment-416978" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-11T12:54:37+00:00">July 11, 2019 at 12:54 pm</time></a> </div>
<div class="comment-content">
<p>Thanks.</p>
</div>
</li>
</ol>
</li>
<li id="comment-417099" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f17480e4237db58d1a9b61b69d2e19cd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f17480e4237db58d1a9b61b69d2e19cd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Frank Wessels</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-12T17:07:38+00:00">July 12, 2019 at 5:07 pm</time></a> </div>
<div class="comment-content">
<p>In addition to Qualcomm/Apple you may also want to try the new ARM eMag core running at 3.3 GHz (32 cores).</p>
<p>Packet has a c2 type available with this CPU.</p>
</div>
<ol class="children">
<li id="comment-417106" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-12T17:32:12+00:00">July 12, 2019 at 5:32 pm</time></a> </div>
<div class="comment-content">
<p>I actually own an Ampere box! (And I have covered it a few times on this blog.)</p>
<p>It does have lots of cores&#8230; but it is not really competitive in terms of single-threaded performance especially when NEON is involved.</p>
<p>(I am still a fan of the company and will find a way to buy their second generation systems.)</p>
</div>
</li>
</ol>
</li>
<li id="comment-417997" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-15T18:57:27+00:00">July 15, 2019 at 6:57 pm</time></a> </div>
<div class="comment-content">
<p>I did an experiment to reduce the amount of unnecessary work in stage 1. Rather than flatten the bitmap in flatten_bits, we can just write the whole bitmap as is. Stage 2 then decodes it in UPDATE_CHAR one bit at a time. A simplistic implementation shows the following speedups on an AArch64 server for the 4 json files: 0.8%, -2.4%, 5.1%, 7.1%. Branch mispredictions are higher of course, but it&rsquo;s still faster overall.</p>
<p>While stage 1 achieves a great IPC of ~3 with very few branch mispredictions, the work it performs doesn&rsquo;t seem to be worthwhile enough to really help stage 2. Like I mentioned before, adding code to skip spaces in the parser should simplify stage 1 considerably and give larger speedups.</p>
</div>
<ol class="children">
<li id="comment-418405" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-16T23:58:35+00:00">July 16, 2019 at 11:58 pm</time></a> </div>
<div class="comment-content">
<p>Thanks. I will investigate this possible optimization.</p>
</div>
</li>
</ol>
</li>
<li id="comment-470989" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6588f5d1bcfa2b6da0f22874e76b20ce?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6588f5d1bcfa2b6da0f22874e76b20ce?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.facebook.com/" class="url" rel="ugc external nofollow">Facebook</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-16T06:11:02+00:00">December 16, 2019 at 6:11 am</time></a> </div>
<div class="comment-content">
<p>Apple&rsquo;s processor is what makes it unique &amp; popular. It&rsquo;s optimized so well in both Iphone &amp; Mac.</p>
</div>
</li>
</ol>
