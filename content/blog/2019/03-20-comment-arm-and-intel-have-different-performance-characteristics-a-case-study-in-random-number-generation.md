---
date: "2019-03-20 12:00:00"
title: "ARM and Intel have different performance characteristics: a case study in random number generation"
index: false
---

[13 thoughts on &ldquo;ARM and Intel have different performance characteristics: a case study in random number generation&rdquo;](/lemire/blog/2019/03-20-arm-and-intel-have-different-performance-characteristics-a-case-study-in-random-number-generation)

<ol class="comment-list">
<li id="comment-396166" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-20T17:35:16+00:00">March 20, 2019 at 5:35 pm</time></a> </div>
<div class="comment-content">
<p>Computing the high bits of 64&#215;64 is <em>how</em> expensive on this ARM server? I mean there&rsquo;s a 20x relative difference in performance&#8230;</p>
<p>What type of ARM? &ldquo;Skylarke ARM&rdquo; doesn&rsquo;t turn up many hits &#8211; mostly stuff about a nice farm that does weddings.</p>
</div>
<ol class="children">
<li id="comment-396195" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7fe97c752a2ceafa12a11387ceaaa5d5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7fe97c752a2ceafa12a11387ceaaa5d5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Ricardo Bánffy</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-20T19:44:36+00:00">March 20, 2019 at 7:44 pm</time></a> </div>
<div class="comment-content">
<p>You can find more info on that specific ARM implementation here: <a href="https://en.wikichip.org/wiki/apm/microarchitectures/skylark" rel="nofollow ugc">https://en.wikichip.org/wiki/apm/microarchitectures/skylark</a></p>
</div>
</li>
<li id="comment-396198" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-20T19:45:50+00:00">March 20, 2019 at 7:45 pm</time></a> </div>
<div class="comment-content">
<p>There was a typo in my post. It is Skylark&#8230; <a href="https://en.wikichip.org/wiki/apm/microarchitectures/skylark" rel="nofollow ugc">https://en.wikichip.org/wiki/apm/microarchitectures/skylark</a></p>
<p>I can give you access to the box.</p>
</div>
</li>
<li id="comment-396202" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-20T19:51:14+00:00">March 20, 2019 at 7:51 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t have exact numbers for Skylark. On a Cortex A57 processor, to compute the most significant 64 bits of a 64-bit product, you must use the multiply-high instructions (umulh and smulh), but they require six cycles of latency and they prevent the execution of other multi-cycle instructions for an additional three cycles.</p>
<p><a href="http://infocenter.arm.com/help/topic/com.arm.doc.uan0015b/Cortex_A57_Software_Optimization_Guide_external.pdf" rel="nofollow ugc">http://infocenter.arm.com/help/topic/com.arm.doc.uan0015b/Cortex_A57_Software_Optimization_Guide_external.pdf</a></p>
</div>
<ol class="children">
<li id="comment-579928" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maynard Handley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-17T01:43:58+00:00">March 17, 2021 at 1:43 am</time></a> </div>
<div class="comment-content">
<p>Daniel, if you have access to an M1, try the performance there, along with looking at the assembly.</p>
<p>Of course there is the basic &ldquo;M1 is fast&rdquo; stuff, that&rsquo;s not interesting.</p>
<p>What&rsquo;s interesting is that the 128b multiply should be coded as a UMULH and a MUL instruction pair. Apple has a more or less generic facility to support instructions with multiple destination registers, which means that, in principle, these two multiplies could be fused, and thus executed faster than two successive independent multiply-type operations.</p>
<p>Does Apple in fact do this? Is 128b multiplication considered a common enough operation to special-case? Who knows? But they do, of course, special case and fuse various of the other obvious specialized crypto instruction pairs.</p>
</div>
<ol class="children">
<li id="comment-580023" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-17T23:12:49+00:00">March 17, 2021 at 11:12 pm</time></a> </div>
<div class="comment-content">
<p>See <a href="https://lemire.me/blog/2021/03/17/apples-m1-processor-and-the-full-128-bit-integer-product/" rel="ugc">https://lemire.me/blog/2021/03/17/apples-m1-processor-and-the-full-128-bit-integer-product/</a></p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-396465" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cyril</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-21T15:15:46+00:00">March 21, 2019 at 3:15 pm</time></a> </div>
<div class="comment-content">
<p>Results form Pine64 on CortexA53:</p>
<p>wyrng 0.013576 s<br/>
bogus:14643616649108139168<br/>
splitmix64 0.010964 s<br/>
bogus:18305447471597396837</p>
</div>
<ol class="children">
<li id="comment-396467" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cyril</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-21T15:24:10+00:00">March 21, 2019 at 3:24 pm</time></a> </div>
<div class="comment-content">
<p>And here is the numbers form my laptop, Intel i5-4250U.<br/>
wyrng 0.000929 s<br/>
bogus:15649925860098344998<br/>
splitmix64 0.000842 s<br/>
bogus:15901732380406292985</p>
</div>
<ol class="children">
<li id="comment-396473" class="comment byuser comment-author-lemire bypostauthor even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-21T15:48:57+00:00">March 21, 2019 at 3:48 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t benchmark on laptops, but here is what I get on my haswell server (i7-4770):</p>
<pre><code>$ g++ --version
g++ (Ubuntu 5.5.0-12ubuntu1~16.04) 5.5.0 20171010
$ g++  -std=c++11 -O2 -fno-tree-vectorize -o fastestrng fastestrng.cpp &amp;&amp; ./fastestrng
wyrng       0.000431 s
bogus:14643616649108139168
splitmix64      0.000587 s
bogus:18305447471597396837
lehmer64    0.000569 s
bogus:16285628012437095220
lehmer64 (3)    0.000392 s
bogus:15342908890590157271
lehmer64 (3)    0.000379 s
bogus:18372309517275774290

Next we do random number computations only, doing no work.
wyrng       0.000442 s
bogus:15649925860098344998
splitmix64      0.000567 s
bogus:15901732380406292985
lehmer64    0.000568 s
bogus:6253507633689833227
lehmer64 (2)    0.000459 s
bogus:17457190375316347997
lehmer64 (3)    0.000361 s
bogus:4305661330232405915
</code></pre>
<p>Email me if you want access to it.</p>
</div>
<ol class="children">
<li id="comment-396477" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cyril</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-21T16:13:29+00:00">March 21, 2019 at 4:13 pm</time></a> </div>
<div class="comment-content">
<p>I have enough hardware to test, next I want to try on 64bit Atom. But my point here, performance of such things does not really depends on the instructions set (ARMv8 vs amd64). It depends on internal CPU architecture. Cortex A53 and Apple A11 are both armv8 cpus, but on A11 wyrng is faster and on A53 splitmix64 is faster.</p>
</div>
<ol class="children">
<li id="comment-396478" class="comment byuser comment-author-lemire bypostauthor even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-21T16:22:12+00:00">March 21, 2019 at 4:22 pm</time></a> </div>
<div class="comment-content">
<p>I agree.</p>
</div>
<ol class="children">
<li id="comment-396548" class="comment odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cyril</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-21T21:52:14+00:00">March 21, 2019 at 9:52 pm</time></a> </div>
<div class="comment-content">
<p>Another important point in such comparisons is compiler. On my CortexA53 lehmer64 (2) is fastest with gcc, and lehmer64 (3) is fastest with clang. Looks like gcc generates full 128&#215;128 bit multiplication, while clang generates 128&#215;64.</p>
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
<li id="comment-396476" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cyril</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-21T16:06:40+00:00">March 21, 2019 at 4:06 pm</time></a> </div>
<div class="comment-content">
<p>And on iPhone X with AppleA11 wyrng is faster:<br/>
wyrng 0.000563 s<br/>
bogus:12179112671541558566<br/>
splitmix64 0.000728 s<br/>
bogus:808196752756138662</p>
</div>
</li>
</ol>
</li>
</ol>
