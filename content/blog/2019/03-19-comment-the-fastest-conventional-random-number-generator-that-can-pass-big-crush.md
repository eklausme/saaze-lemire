---
date: "2019-03-19 12:00:00"
title: "The fastest conventional random number generator that can pass Big Crush?"
index: false
---

[43 thoughts on &ldquo;The fastest conventional random number generator that can pass Big Crush?&rdquo;](/lemire/blog/2019/03-19-the-fastest-conventional-random-number-generator-that-can-pass-big-crush)

<ol class="comment-list">
<li id="comment-395955" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Cyril</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-19T20:45:58+00:00">March 19, 2019 at 8:45 pm</time></a> </div>
<div class="comment-content">
<p>Armv8 has UMULH instruction for getting bits [127:64] of the 64&#215;64 multiplication, so it should be the same amount of the instructions, as on x64.</p>
</div>
<ol class="children">
<li id="comment-395959" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-19T20:58:12+00:00">March 19, 2019 at 8:58 pm</time></a> </div>
<div class="comment-content">
<p>On x64, you need a single instruction to generate the 128 bits of the product of two 64-bit values. As far as I know, on ARM, you will need to multiplication instructions (mul and umulh) to get the same result, and the umulh instruction is sometimes much slower than the mul instruction.</p>
</div>
<ol class="children">
<li id="comment-396137" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cyril</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-20T13:02:35+00:00">March 20, 2019 at 1:02 pm</time></a> </div>
<div class="comment-content">
<p>Total amount of instructions is same, but on the arm it is 3 multiplications: umulh, madd, mul. On x64 it is: mulx, imul, add.<br/>
Indeed umulh is slower than mul, but not dramatically. Execution throughputs are 1/4 vs 1/3 on Cortex A57.</p>
</div>
<ol class="children">
<li id="comment-396156" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-20T16:46:07+00:00">March 20, 2019 at 4:46 pm</time></a> </div>
<div class="comment-content">
<p>From <a href="https://arxiv.org/pdf/1902.01961.pdf" rel="nofollow">Faster Remainder by Direct Computation</a>:</p>
<blockquote>
<p>We believe that the reduced speed has to do with the performance of the multiplication instructions of our Cortex A57 processor. To compute the most significant 64 bits of a 64-bit product as needed by our functions, we must use the multiply-high instructions (umulh and smulh), but they require six cycles of latency and they prevent the execution of other multi-cycle instructions for an additional three cycles.<br/>
The latency numbers are there: <a href="http://infocenter.arm.com/help/topic/com.arm.doc.uan0015b/Cortex_A57_Software_Optimization_Guide_external.pdf" rel="nofollow ugc">http://infocenter.arm.com/help/topic/com.arm.doc.uan0015b/Cortex_A57_Software_Optimization_Guide_external.pdf</a></p>
</blockquote>
<p>Quoting directly from the ARM documentation:</p>
<blockquote>
<p>Multiply high operations stall the multiplier pipeline for N extra cycles before any other type M op can be issued to that pipeline, with N shown in parentheses.</p>
</blockquote>
</div>
<ol class="children">
<li id="comment-396159" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cyril</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-20T16:52:36+00:00">March 20, 2019 at 4:52 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s correct, but from the same doc: latency for 64&#215;64 MUL is 5 cycles and 3 cycles M pipeline stall. 5 cycles latency does not look much faster than 6.</p>
</div>
<ol class="children">
<li id="comment-396165" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-20T17:30:14+00:00">March 20, 2019 at 5:30 pm</time></a> </div>
<div class="comment-content">
<p>Cyril&#8230; We go from two multiplications (on x64) to three multiplications, including one that is particularly expensive. The instruction count might be the same, but we know not to determine the speed of a piece of code to its instruction count when some instructions are much more expensive than others.</p>
<p>See my follow-up blog post: <a href="https://lemire.me/blog/2019/03/20/arm-and-intel-have-different-performance-characteristics-a-case-study-in-random-number-generation/">ARM and Intel have different performance characteristics: a case study in random number generation</a>. I show that wyhash, which is so good on x64, is no longer too great on ARM.</p>
<p>I don&rsquo;t report the Lehmer&rsquo;s results in this following blog post&#8230; but maybe you will trust me, after reading that other blog post, if I tell you that neither Lehmer&rsquo;s nor wyhash are competitive on my ARM server.</p>
<p>I&rsquo;ll be glad to give you access to my ARM server if you want to prove me wrong&#8230;</p>
</div>
<ol class="children">
<li id="comment-396538" class="comment even depth-7">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cyril</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-21T21:17:33+00:00">March 21, 2019 at 9:17 pm</time></a> </div>
<div class="comment-content">
<p>BTW Cortex A75 is better example where umulh is slow. While on A57 it is more or less the same, as regular mul in terms of latency and cpu cycles, on A75 it is exactly 2 times slower, then mul. <a href="https://static.docs.arm.com/101398/0200/arm_cortex_a75_software_optimization_guide_v2.pdf" rel="nofollow ugc">https://static.docs.arm.com/101398/0200/arm_cortex_a75_software_optimization_guide_v2.pdf</a> (page 16)<br/>
Unfortunately I don&rsquo;t have access to the real A75 hardware and can&rsquo;t run your tests.</p>
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
<li id="comment-395956" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/455da12ee7a27b3fbac08e0374ba445e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/455da12ee7a27b3fbac08e0374ba445e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alexander Monakov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-19T20:45:59+00:00">March 19, 2019 at 8:45 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
Can you do better without using any specialized instruction?
</p></blockquote>
<p>Yes: in Lehmer&rsquo;s generator, dependency chain is 5 cycles (4 cycles for high-part result of low-parts multiplication, plus 1 cycle for adding the result of high×low multiplication), there&rsquo;s only one multiply unit, and so with only two independent generators the multiplier is not fully utilized: we&rsquo;re supplying 4 multiply ops each 5 cycles.</p>
<p>Thus, using 3 independent generators improves the situation (without running into undesirable effects like register spilling).</p>
</div>
<ol class="children">
<li id="comment-395964" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-19T21:17:56+00:00">March 19, 2019 at 9:17 pm</time></a> </div>
<div class="comment-content">
<p>You are correct. I have updated my blog post and credited you.</p>
<p>For people reading this. The processor can issue a multiplication per cycle but it takes three cycles for it to complete. Hence the number three. We need three streams to keep it busy all the time.</p>
<p>And, of course, if the rest of your application needs the multiply unit, you are in trouble.</p>
<p>(This is specific to current x64 processors.)</p>
</div>
<ol class="children">
<li id="comment-395965" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/455da12ee7a27b3fbac08e0374ba445e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/455da12ee7a27b3fbac08e0374ba445e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alexander Monakov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-19T21:28:24+00:00">March 19, 2019 at 9:28 pm</time></a> </div>
<div class="comment-content">
<p>Uhm. Your answers to Cyril and me are written as if Lehmer&rsquo;s generator uses a 64×64 bit multiplication, but the code you show actually needs a 128×64 bit multiplication, and there&rsquo;s no way to express that as one multiplication instruction, not on AMD64, not on AArch64. Check the assembly generated by GCC: you&rsquo;ll see one &lsquo;mul&rsquo; instruction and one &lsquo;imul&rsquo; instruction.</p>
</div>
<ol class="children">
<li id="comment-395970" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-19T21:47:46+00:00">March 19, 2019 at 9:47 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>Your answers to Cyril and me are written as if Lehmer’s generator uses a 64×64 bit multiplication, but the code you show actually needs a 128×64 bit multiplication, and there’s no way to express that as one multiplication instruction, not on AMD64, not on AArch64.</p>
</blockquote>
<p>My blog post states:</p>
<p><em>Once compiled for an x64 processor, the generator boils down to two 64-bit multiplication instructions and one addition.</em></p>
<p>That&rsquo;s for x64. Cyril stated that on ARM, you&rsquo;d have the same number of multiplications. I don&rsquo;t think that&rsquo;s correct. For ARM, you are going to need something like three multiplications, one of which will be UMULH, which is slow on the ARM machines I know.</p>
<p>As for my answer to your comment, as long as you have enough registers, it should be obvious that you can issue one multiplication per cycle if you have three generators because of the three cycle latency (assuming you have a superscalar processor with sufficient width to fit in the loads and the adds). It is also obvious from your analysis that two generators are not enough.</p>
</div>
<ol class="children">
<li id="comment-395985" class="comment odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/455da12ee7a27b3fbac08e0374ba445e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/455da12ee7a27b3fbac08e0374ba445e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alexander Monakov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-19T22:51:28+00:00">March 19, 2019 at 10:51 pm</time></a> </div>
<div class="comment-content">
<p>My bad — misinterpreted what you said the first time around. Sorry. On AArch64 there should be one more mul (so three in total rather than two as on AMD64).</p>
<p>I still think your follow-up to my comment was somewhat confusing: with two generators, you have <em>four</em> independent multiplications, which is enough to cover the basic three-cycle latency. The problem is that dependency cycle is not 3 ticks (and I suspect I miscalculated earlier and just from nominal latencies the critical cycle is 4 ticks, not 5).</p>
</div>
<ol class="children">
<li id="comment-395989" class="comment byuser comment-author-lemire bypostauthor even depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-19T23:05:23+00:00">March 19, 2019 at 11:05 pm</time></a> </div>
<div class="comment-content">
<p>According to Agner Fog, we have the following on recent Intel processors&#8230; for register inputs, you have 3 cycles of latency for 64-bit multiplications (one extra cycle for 32-bit but it is irrelevant here).</p>
<p>Of course, if one of the inputs is in memory, then the latency is expected to be longer&#8230; but let us ignore this for the time being.</p>
<p>You have a dependency chain of at least 5 cycles as per your analysis. Maybe you want to argue that the dependency chain is longer, fine&#8230; but let us agree that it is <em>at least</em> 5 cycles. In 5 cycles, you do two multiplications. So that&rsquo;s one multiplication every 5/2 = 2.5 cycles. Intel processors can do one multiplication <em>every cycle</em>.</p>
<p>I think it follows that we need to have more than two generators to keep the multiplication unit fully occupied.</p>
<p>Now this is a bit rough because we are making the implicit assumption that we are strictly limited by the multiplication. We probably need to do a better job analyzing the flow of instructions to really understand what is going on.</p>
<p><a href="https://www.agner.org/optimize/instruction_tables.pdf" rel="nofollow ugc">https://www.agner.org/optimize/instruction_tables.pdf</a></p>
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
<li id="comment-396168" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-20T17:48:46+00:00">March 20, 2019 at 5:48 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t see any reason to believe that 3 independently seeded generators would be unsafe compared to using a single generator. If anything, it could be slightly better since there is 3x the state and 3 uncorrelated streams rather than 1.</p>
<p>Of course, I guess you could just bundle up your 3x generator and put it through the available tests like big crush.</p>
<p>That aside, once you accept multiple generators and so effectively measure throughput rather than value-to-value latency, won&rsquo;t the fastest approach be SIMD? That changes the playing field dramatically (e.g., there aren&rsquo;t even any 64-bit input multiplications available up to and including AVX2).</p>
</div>
<ol class="children">
<li id="comment-396176" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-20T18:37:34+00:00">March 20, 2019 at 6:37 pm</time></a> </div>
<div class="comment-content">
<p><em>I don’t see any reason to believe that 3 independently seeded generators would be unsafe (&#8230;) </em></p>
<p>In this instance, I also cannot imagine what the problem might be, but I thought I&rsquo;d be prudent and urge people to check before they adopt this!</p>
<p><em>won’t the fastest approach be SIMD? </em></p>
<p>Yeah but I excluded SIMD deliberately here.</p>
<p>I also did not discuss latency.</p>
</div>
<ol class="children">
<li id="comment-396302" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-21T03:21:32+00:00">March 21, 2019 at 3:21 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
Yeah but I excluded SIMD deliberately here.
</p></blockquote>
<p>Maybe it got lost in an edit, because another commenter quotes &ldquo;Can you do better without any specialized instructions&rdquo; but I don&rsquo;t see that now.</p>
<p>One could argue that the rules of the game are a bit unclear: for example, when you use 2 or 3 Lehmer generators, you unroll the loop by 2 or 3 and call each in turn in the &ldquo;user&rdquo; code &#8211; so it&rsquo;s not really implementing the RNG API, but rather an end-user optimization using separate generators which may be easy or hard to use in practice depending on the situation.</p>
<p>To keep the same API you could wrap the 2 or 3 generators up into one that gives the usual interface and alternates among the generators using an internal flag. In <em>principle</em> a compiler could even undo this packaging as an optimization, if it unrolled the loop body by the right amount and compiled away the control flow &#8211; but I think it is unlikely with today&rsquo;s compilers in most scenarios.</p>
</div>
<ol class="children">
<li id="comment-396569" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-22T00:04:48+00:00">March 22, 2019 at 12:04 am</time></a> </div>
<div class="comment-content">
<p>You are correct that I wasn&rsquo;t clear as to the rules of the game. But we both know that SIMD could kill these scalar functions, as long as the compiler can&rsquo;t autovectorize well.</p>
</div>
<ol class="children">
<li id="comment-396730" class="comment odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-22T18:35:00+00:00">March 22, 2019 at 6:35 pm</time></a> </div>
<div class="comment-content">
<p>Auto-vectorization <em>is</em> SIMD, no?</p>
<p>Well I would say it isn&rsquo;t totally obvious that SIMD will do <em>much</em> better here since both presented approaches use wide integer multiplications which is a weak spot for x86 SIMD, which doesn&rsquo;t offer any 64-bit input multiplications at all.</p>
<p>&#8230; but yeah I guess SIMD would win perhaps with something like xorshift variant.</p>
</div>
<ol class="children">
<li id="comment-396749" class="comment byuser comment-author-lemire bypostauthor even depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-22T19:55:56+00:00">March 22, 2019 at 7:55 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>Auto-vectorization is SIMD, no?</p>
</blockquote>
<p>When I refer to SIMD, I include auto-vectorization, always. In my comment above, I should qualify&#8230; with &ldquo;programmer&rsquo;s deliberate use of SIMD&rdquo;.</p>
</div>
</li>
<li id="comment-396795" class="comment odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9fb56b5f9e8fbd89570fe54ed991d307?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9fb56b5f9e8fbd89570fe54ed991d307?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://eskamation.de" class="url" rel="ugc external nofollow">Stefan Kanthak</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-22T23:19:00+00:00">March 22, 2019 at 11:19 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
… but yeah I guess SIMD would win perhaps with something like xorshift variant.
</p></blockquote>
<p>Don&rsquo;t guess, just test it!<br/>
On x86-32, 64-bit PRNGs which don&rsquo;t need a 64*64-bit multiplication or division run a <strong>BIT</strong> faster when implemented using MMX (or SSE).</p>
<p>If you can run PE32/PE32+ executables: fetch <a href="//skanthak.homepage.t-online.de/temp/rngbench.mmx]" rel="nofollow">MMX</a>, <a href="https://skanthak.homepage.t-online.de/temp/rngbench.com" rel="nofollow">32-bit</a> and <a href="https://skanthak.homepage.t-online.de/temp/rngbench.exe" rel="nofollow">64-bit</a> implementation; these run the PRNGs from <a href="https://skanthak.homepage.t-online.de/nomsvcrt.html" rel="nofollow">NOMSVCRT</a> in a tight loop. For a more realistic test, fetch <a href="https://skanthak.homepage.t-online.de/temp/rngcheck.mmx" rel="nofollow">MMX</a>, <a href="https://skanthak.homepage.t-online.de/temp/rngcheck.com" rel="nofollow">32-bit</a> and <a href="https://skanthak.homepage.t-online.de/temp/rngcheck.exe" rel="nofollow">64-bit</a> implementation: these run the same PRNGs with the MonteCarlo approximation I already mentioned here.</p>
</div>
<ol class="children">
<li id="comment-397642" class="comment even depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-27T18:24:36+00:00">March 27, 2019 at 6:24 pm</time></a> </div>
<div class="comment-content">
<p>Right, but which can pass Big Crush from TestU01?</p>
</div>
<ol class="children">
<li id="comment-397660" class="comment odd alt depth-8 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9fb56b5f9e8fbd89570fe54ed991d307?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9fb56b5f9e8fbd89570fe54ed991d307?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://eskamation.de" class="url" rel="ugc external nofollow">Stefan Kanthak</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-27T21:06:04+00:00">March 27, 2019 at 9:06 pm</time></a> </div>
<div class="comment-content">
<p>Testing a 64-bit PRNG with TestU01 is <strong>NO GOOD IDEA</strong>, better use Practically Random instead.<br/>
A properly implemented 64-bit PRNG produces the same sequence on x32 and x64 (or any other processor architecture), with or without the use of MMX/SSE/Neon/AVX.<br/>
Bob Jenkin&rsquo;s Small Fast prng64(), the enhanced and <strong>true</strong> middle-square msqr64(), the hashed arithmetic progression drbg64() (same as Daniel&rsquo;s adaption of wyprng()), the scrambled MCG smcg64() pass full runs of PractRand up to 32TB.<br/>
The square-with-carry I mentioned here passes at least up to 4TB.</p>
</div>
<ol class="children">
<li id="comment-397664" class="comment byuser comment-author-lemire bypostauthor even depth-9 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-27T21:18:08+00:00">March 27, 2019 at 9:18 pm</time></a> </div>
<div class="comment-content">
<p><em>Testing a 64-bit PRNG with TestU01 is NO GOOD IDEA, better use Practically Random instead.</em></p>
<p>How can it possibly be a bad idea? I would agree that you should use Practically Random, but what harm may come from running Big Crush&#8230; other than climate change due to CPU heat?</p>
<p>Though I agree that PractRand seems both more modern and possibly all around better&#8230; it is certainly easier from a software engineering point of view&#8230; TestU01 is the one benchmark we have that is backed by years of peer-reviewed research&#8230; and its Big Crush is a &ldquo;de facto&rdquo; standard. It is also a static and determined target as long as you describe how you ran the tests (you need to be specific because Big Crush is essentially a 31-bit test).</p>
</div>
<ol class="children">
<li id="comment-397669" class="comment odd alt depth-10">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9fb56b5f9e8fbd89570fe54ed991d307?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9fb56b5f9e8fbd89570fe54ed991d307?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://eskamation.de" class="url" rel="ugc external nofollow">Stefan Kanthak</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-27T21:58:24+00:00">March 27, 2019 at 9:58 pm</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s no good idea (I didn&rsquo;t say bad idea) because TestU01 was designed for 32-bit numbers, so you need to take quite some precautions or apply spoon-feeding when testing 64-bit PRNGs.</p>
</div>
</article>
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
</ol>
</li>
</ol>
</li>
<li id="comment-396174" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9fb56b5f9e8fbd89570fe54ed991d307?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9fb56b5f9e8fbd89570fe54ed991d307?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://eskamation.de" class="url" rel="ugc external nofollow">Stefan Kanthak</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-20T18:32:15+00:00">March 20, 2019 at 6:32 pm</time></a> </div>
<div class="comment-content">
<p>While Lehmer&rsquo;s multiplicative congruential generator is fast, it does <strong>NOT</strong> pass PractRand 0.94 (but you know this already). In <a href="http://www.pcg-random.org/posts/does-it-beat-the-minimal-standard.html" rel="nofollow">does it beat the minimal standard</a> and <a href="http://www.pcg-random.org/posts/too-big-to-fail.html" rel="nofollow">too big to fail</a> Melissa O&rsquo;Neill tested these generators with PractRand 0.93, where they passed.</p>
<p>Consider an idea from George Marsaglia instead: save and add the &ldquo;carry&rdquo; of the multiplication, giving a multiply-with-carry generator:</p>
<p><code>uint64_t seed = 0, carry = 0x...;<br/>
uint64_t square_with_carry() {<br/>
__uint128_t mwc = (__uint128_t) seed * 0x... + carry;<br/>
seed = mwc;<br/>
carry = square &gt;&gt; 64;<br/>
return seed;<br/>
}<br/>
</code></p>
<p>Or a square-with-carry generator:</p>
<p><code>uint64_t seed = 0, carry = 0xb5ad4eceda1ce2a9;<br/>
uint64_t square_with_carry() {<br/>
__uint128_t square = (__uint128_t) seed * seed + carry;<br/>
seed = square;<br/>
carry = square &gt;&gt; 64;<br/>
return seed;<br/>
}<br/>
</code></p>
<p>This 64-bit generator passes the PractRand test suite (version 0.94) at least up to 4 TB!<br/>
See <a href="https://godbolt.org/z/qFfRYh" rel="nofollow">source</a> and <a href="https://godbolt.org/z/4jf1i_" rel="nofollow">source</a> for the code generated by GCC 8.2 and clang 7.0 respectively, plus <a href="https://godbolt.org/z/9RRnBL" rel="nofollow">VC source</a> for an implementation using Microsofts Visual C compiler (which does not support a 128 bit integer type).<br/>
I used the latter for the PractRand test.</p>
</div>
<ol class="children">
<li id="comment-396178" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-20T18:42:27+00:00">March 20, 2019 at 6:42 pm</time></a> </div>
<div class="comment-content">
<p>I turned your comment into an issue on GitHub: <a href="https://github.com/lemire/testingRNG/issues/14" rel="nofollow ugc">https://github.com/lemire/testingRNG/issues/14</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-396561" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cyril</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-21T23:27:36+00:00">March 21, 2019 at 11:27 pm</time></a> </div>
<div class="comment-content">
<p>I was trying to understand why Lehmer’s with 3 generators is more performant on A53, while single generator perfectly loads pipeline with something about 9 cycles consumed and 12 cycles latency (this is calculated by A57 reference, but should be relevant for A53 too). 3 instructions are required:</p>
<p><code>umulh x9, x22, x23<br/>
mul x22, x22, x23<br/>
madd x19, x19, x23, x9<br/>
</code></p>
<p>Then I realised that test uses different iterations count, so basically it tests branch prediction efficiency. After running the fixed version results became more reasonable:</p>
<p><code>wyrng 0.009253 s<br/>
splitmix64 0.007591 s<br/>
lehmer64 0.007093 s<br/>
lehmer64 (2) 0.00733 s<br/>
lehmer64 (3) 0.007269 s</p>
<p>Next we do random number computations only, doing no work.<br/>
wyrng 0.011513 s<br/>
splitmix64 0.008451 s<br/>
lehmer64 0.00664 s<br/>
lehmer64 (2) 0.006763 s<br/>
lehmer64 (3) 0.006762 s<br/>
</code></p>
<p><a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/pull/30" rel="nofollow ugc">https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/pull/30</a></p>
</div>
</li>
<li id="comment-396566" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-22T00:02:18+00:00">March 22, 2019 at 12:02 am</time></a> </div>
<div class="comment-content">
<p>Excellent, thanks.</p>
</div>
<ol class="children">
<li id="comment-396723" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9fb56b5f9e8fbd89570fe54ed991d307?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9fb56b5f9e8fbd89570fe54ed991d307?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://eskamation.de" class="url" rel="ugc external nofollow">Stefan Kanthak</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-22T18:03:15+00:00">March 22, 2019 at 6:03 pm</time></a> </div>
<div class="comment-content">
<p>Running the PRNGs in a tight loop just summing their results is typically not seen in practice: real-world applications perform some (more) computation with the random numbers.<br/>
Consider to change your timing setup a little bit and perform some (silly, but yet sufficient) computation, like the MonteCarlo determination of pi:</p>
<p><code>unsigned hits = 4000000;<br/>
for (unsigned i = hits; i &gt; 0; i--)<br/>
{ const unsigned x = prng(), y = prng();<br/>
const unsigned long long z = ~0ULL * ~0ULL;<br/>
hits -= z - (unsigned long long) x * x &lt; (unsigned long long) y * y;<br/>
}<br/>
printf("Pi = %lu.%06lu\n", hits / 1000000, hits % 1000000);<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-396757" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-22T20:43:54+00:00">March 22, 2019 at 8:43 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>Running the PRNGs in a tight loop just summing their results is typically not seen in practice</p>
</blockquote>
<p>It is not. Indeed. You are correct.</p>
<p>What is up with &lsquo;z&rsquo; in your code? Why not just write &lsquo;1&rsquo;?</p>
</div>
<ol class="children">
<li id="comment-396779" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9fb56b5f9e8fbd89570fe54ed991d307?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9fb56b5f9e8fbd89570fe54ed991d307?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://eskamation.de" class="url" rel="ugc external nofollow">Stefan Kanthak</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-22T22:11:40+00:00">March 22, 2019 at 10:11 pm</time></a> </div>
<div class="comment-content">
<p>The (f)ull and true square of ~0UL alias UINT_MAX is not &lsquo;1&rsquo;, but ~0ULL * ~0ULL or (~1ULL &lt;&lt; 32) | 1ULL: (x-1)<em>(x-1) = x</em>x &#8211; 2*x + 1. While precision surely does not matter for this MonteCarlo approximation, I don&rsquo;t want to give a bad or questionable example.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-396731" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jörn Engel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-22T18:35:27+00:00">March 22, 2019 at 6:35 pm</time></a> </div>
<div class="comment-content">
<p>wyhash64 is half-awesome, half-questionable.</p>
<p>It is similar to PCG in that it combines a weak base generator and an output function to create a strong generator. One problem with PCG is that the base generator&rsquo;s critical path is using MUL+ADD, which takes 4 cycles on Intel. No matter how fast the output function, performance cannot exceed one output per 4 cycles.</p>
<p>wyhash64 uses ADD for the base generator, latency 4 cycles. That&rsquo;s awesome. Base generator is weaker than an LCG, but we can compensate with a stronger output function. The carry bits still result in some amount of randomness that we can &ldquo;amplify&rdquo; by multiplications.</p>
<p>Questionable is the output function. XOR of the low and high multiplication result is not an invertible function, so some outputs are impossible to generate. See for yourself:<br/>
long total = 0;<br/>
for (int m = 1; m &lt; 65536; m += 2) {<br/>
uint8_t hit[65536] = { 0, };<br/>
for (int i = 0; i &lt; 65536; i++) {<br/>
uint32_t state = i;<br/>
state *= m;<br/>
state ^= state &gt;&gt; 16;<br/>
hit[state &amp; 0xffff]++;<br/>
}<br/>
int hits = 0;<br/>
for (int i = 0; i &lt; 65536; i++)<br/>
hits += !!hit[i];<br/>
printf(&ldquo;%5d: %5d\n&rdquo;, m, hits);<br/>
total += hits;<br/>
}<br/>
printf(&ldquo;average: %5ld\n&rdquo;, total / 32768);</p>
<p>Not sure how bad the problem is for 64bit multiplication, but I would expect about half of all 64bit numbers to be absent from the output. Arguably that is bad. Or good, depending on one&rsquo;s view.</p>
<p>The bad side is pretty obvious. The good side is that collisions in the output functions means random numbers get generated multiple times before the 64bit counter loops. So this PRNG doesn&rsquo;t fail a birthday paradox test, in spite of having 64bit state and 64bit output.</p>
<p>Assuming you consider the non-invertible output function to be bad, that should be relatively easy to fix. Use regular 64bit multiplication and xorshift.<br/>
state ^= state &gt;&gt; 32;<br/>
state *= M1;<br/>
state ^= state &gt;&gt; 32;<br/>
state *= M2;<br/>
state ^= state &gt;&gt; 32;<br/>
Something like the above should work. It should also be faster on Arm, 32bit x86 and some other architectures. We might get away with a single multiplication if we use a random xorshift like PCG does. I should try some variant and see if they survive practrand.</p>
</div>
<ol class="children">
<li id="comment-396761" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-22T20:58:03+00:00">March 22, 2019 at 8:58 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>XOR of the low and high multiplication result is not an invertible function</p>
</blockquote>
<p>This is mathematically intuitive.</p>
</div>
</li>
<li id="comment-396766" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jörn Engel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-22T21:24:54+00:00">March 22, 2019 at 9:24 pm</time></a> </div>
<div class="comment-content">
<p>Based on fairly quick tests, the two fastest output functions that might work (up to several Gigabytes at least) are:</p>
<p><code>state ^= state &gt;&gt; 32;<br/>
state *= M1;<br/>
state ^= state &gt;&gt; 32;<br/>
state *= M2;<br/>
state ^= state &gt;&gt; 32;<br/>
</code></p>
<p>and:</p>
<p><code>old ^= old &gt;&gt; ((old &gt;&gt; 59) + 5);<br/>
old *= M1;<br/>
old ^= old &gt;&gt; ((old &gt;&gt; 59) + 5);<br/>
</code></p>
<p>I don&rsquo;t think it makes a difference whether you use the same or two different multipliers. You can also make the multiplier and the increment of the base generator the same. In a way, the increment is just another multiplier anyway.</p>
<p>My usual rules for the multiplier are that it has to be odd (obviously) have a popcount of roughly 32 and should avoid long stretches of 0 or 1. Pick your favorite commit hash, skip any hex digits that are 0 or f and ensure the last bit is 1 and you have a good multiplier.</p>
<p>And because the precise multiplier doesn&rsquo;t matter very much, it is easy to have multiple independent PRNG using different multipliers. Multipliers still have to be checked, but the check is much easier than a multi-dimensional spectral test for an LCG.</p>
</div>
</li>
<li id="comment-396789" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9fb56b5f9e8fbd89570fe54ed991d307?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9fb56b5f9e8fbd89570fe54ed991d307?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://eskamation.de" class="url" rel="ugc external nofollow">Stefan Kanthak</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-22T22:49:52+00:00">March 22, 2019 at 10:49 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
It is similar to PCG in that it combines a weak base generator and an output function to create a strong generator.
</p></blockquote>
<p>Better compare it with Fortuna-like designs, which apply a block cipher or hash function to a simple counter: the first part of wyhash64 is an arithmetic progression alias Weyl sequence.<br/>
It differs from other generators which use a simple multiplicative (non-cryptographic) hash function by &lsquo;folding&rsquo; the high part of the product back into the output.</p>
</div>
</li>
</ol>
</li>
<li id="comment-547945" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f2c8ec8169a7f53bd609558434328a36?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f2c8ec8169a7f53bd609558434328a36?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tyge Løvset</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-08-06T09:51:00+00:00">August 6, 2020 at 9:51 am</time></a> </div>
<div class="comment-content">
<p>16 months since this article was published, so here is a small update on this subject. I posted a proposal for a PRNG (<strong>tylo64</strong>) over at the <strong>numpy</strong> github in June:<br/>
<a href="https://github.com/numpy/numpy/issues/16313#issuecomment-641897028" rel="nofollow ugc">https://github.com/numpy/numpy/issues/16313#issuecomment-641897028</a></p>
<p>It is heavily inspired by <strong>sfc64</strong>, but with improvements that makes it even <strong>quite a bit faster than wyHash</strong> (see below), and at the same time robust for massive parallel usage, due to the added user specified Weyl increment. I.e. each k (odd number) guaratees a unique period of 2^64 (but average ~ 2^94). This feature practically removes the need for a jump function (which sfc64 and tylo64 is missing).</p>
<p>Statistically, I have ran PractRand to 4 TB without issues &#8211; also the 32bit variant of it as recommened by Melissa O&rsquo;Neill. Note also, this implementation does not rely on hardware support for fast multiplication or 128-bit arithmetic, like wyhash.</p>
<p><strong>In numpy, they have now added my proposed Weyl sequence to the original sfc64</strong> (requires 320 bits state): <a href="https://bashtage.github.io/randomgen/bit_generators/sfc.html" rel="nofollow ugc">https://bashtage.github.io/randomgen/bit_generators/sfc.html</a></p>
<p>My proposed PRNG has 256-bit state, and is faster probably because it updates only 196-bit state per number, vs 256-bit in sfc64, as they do essentially the same number and types of operations. Real world Monte Carlo test follows, as suggested by Stefan Kanthak:</p>
<p><code>// Output on AMD Ryzen 7 2700X cpu:<br/>
// tylo64: Pi = 3.14153238: 0.719000 secs<br/>
// wyhash64: Pi = 3.14167794: 1.003000 secs</p>
<p>#include &lt;stdint.h&gt;<br/>
#include &lt;time.h&gt;<br/>
#include &lt;stdio.h&gt;</p>
<p>static uint64_t wyhash64_x;<br/>
static uint64_t tylo64_x[4];</p>
<p>uint64_t wyhash64() {<br/>
wyhash64_x += 0x60bee2bee120fc15;<br/>
__uint128_t tmp;<br/>
tmp = (__uint128_t) wyhash64_x * 0xa3b195354a39b70d;<br/>
uint64_t m1 = (tmp &gt;&gt; 64) ^ tmp;<br/>
tmp = (__uint128_t)m1 * 0x1b03738712fad5c9;<br/>
uint64_t m2 = (tmp &gt;&gt; 64) ^ tmp;<br/>
return m2;<br/>
}</p>
<p>uint64_t tylo64() {<br/>
enum {LROT = 24, RSHIFT = 11, LSHIFT = 3};<br/>
const uint64_t b = tylo64_x[1], result = tylo64_x[0] ^ (tylo64_x[2] += tylo64_x[3]|1);<br/>
tylo64_x[0] = (b + (b &lt;&lt; LSHIFT)) ^ (b &gt;&gt; RSHIFT);<br/>
tylo64_x[1] = ((b &lt;&lt; LROT) | (b &gt;&gt; (64 - LROT))) + result;<br/>
return result;<br/>
}</p>
<p>#define COMPUTE_PI(prng) { \<br/>
hits = N; \<br/>
clock_t diff, before = clock(); \<br/>
for (unsigned i = hits; i &gt; 0; i--) { \<br/>
const uint32_t x = prng(), y = prng(); \<br/>
hits -= z - (uint64_t) x * x &lt; (uint64_t) y * y; \<br/>
} \<br/>
diff = clock() - before; \<br/>
printf("Pi = %lu.%06lu: %f secs\n", hits / (N/4), hits % (N/4), (float) diff / CLOCKS_PER_SEC); \<br/>
}</p>
<p>int main()<br/>
{<br/>
size_t N = 400000000, hits;<br/>
const uint64_t z = ~0ULL * ~0ULL;<br/>
wyhash64_x = tylo64_x[0] = tylo64_x[1] = tylo64_x[2] = tylo64_x[3] = time(NULL); // seed<br/>
COMPUTE_PI(tylo64)<br/>
COMPUTE_PI(wyhash64)<br/>
}<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-649911" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/75fdac0d8a507982fb7081183fbea152?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/75fdac0d8a507982fb7081183fbea152?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tom</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-22T06:22:50+00:00">March 22, 2023 at 6:22 am</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t know wether people from Numpy are aware of that, but in SFC64 the least significant bits for counter-like initialization for different streams are extremely correlated. Try to initalize SFC64 by some fixed s[3] = { 5, 11, 13 } and use weyl additive constans to initalize different streams: 1, 3, 5, 7, &#8230; Now we could get uncorrelated results, starting from first ouput. But least significant bits for first outputs for consequtive streams are looping: 1010101&#8230; Similarly is in case of higher bits.</p>
<p>PractRand would not detect it, if we are would test only few interleaved streams. But this correlations are there. So we can&rsquo;t initialize this generator this way if we want to avoid correlations. These correlations quickly disappear as more results are generated. But how many results must be skipped to avoid correlation, or how to initialize the generator to avoid such problems? Nobody took care of it.</p>
<p>I suspect the same problem with your generator.</p>
</div>
</li>
</ol>
</li>
<li id="comment-615303" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a17c018c6abda50eeb3fba10fdb0a73e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a17c018c6abda50eeb3fba10fdb0a73e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Joe</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-06T08:02:18+00:00">January 6, 2022 at 8:02 am</time></a> </div>
<div class="comment-content">
<p>I might be missing something from reading the article, but why does the wyhash64() C function in the post differ from the linked Swift implementation? They seem like two different algorithms.</p>
<p><a href="https://github.com/lemire/SwiftWyhash/blob/master/Sources/SwiftWyhash/SwiftWyhash.swift" rel="nofollow ugc">https://github.com/lemire/SwiftWyhash/blob/master/Sources/SwiftWyhash/SwiftWyhash.swift</a></p>
</div>
<ol class="children">
<li id="comment-615506" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-08T02:00:21+00:00">January 8, 2022 at 2:00 am</time></a> </div>
<div class="comment-content">
<p>There are different wyhash functions.</p>
<p>Note that I did not invent these functions.</p>
</div>
<ol class="children">
<li id="comment-649227" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e6ba54eb8bace7e5f0d94975c1d3e608?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e6ba54eb8bace7e5f0d94975c1d3e608?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thom Chiovoloni</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-11T15:47:16+00:00">February 11, 2023 at 3:47 pm</time></a> </div>
<div class="comment-content">
<p>Do they both pass the same statistical tests? It does not appear that the testingRNG repo mentions it or contains results for (the smaller) wyrand, which has become more common in the wild from what I&rsquo;ve seen (presumably due to increased perf/reduced size).</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-622073" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/75fdac0d8a507982fb7081183fbea152?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/75fdac0d8a507982fb7081183fbea152?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tom</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-03-04T16:33:41+00:00">March 4, 2022 at 4:33 pm</time></a> </div>
<div class="comment-content">
<p>Have you tested the xoroshiro family? According to Vigna&rsquo;s results, they are the fastest:</p>
<p><a href="https://prng.di.unimi.it" rel="nofollow ugc">https://prng.di.unimi.it</a></p>
<p> On the other hand, its results differ significantly from this: </p>
<p><a href="https://github.com/lemire/testingRNG" rel="nofollow ugc">https://github.com/lemire/testingRNG</a></p>
<p>I wonder what is faster, truncated LCG or Vigna&rsquo;s xoroshiro128+? By the way, why does his results show such advantages on PCG, and according to your results, xoroshiro generators do not have such advantages (relatively)? According to your results, these:<br/>
&#8211; xoroshiro128plus: 0.83 cycles per byte<br/>
&#8211; pcg64: 0.97 cycles per byte<br/>
are almost the same. According to Vigna results xoroshiro128+ is almost 3 times faster than PCG64.</p>
</div>
<ol class="children">
<li id="comment-622219" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Joern Engel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-03-07T01:21:24+00:00">March 7, 2022 at 1:21 am</time></a> </div>
<div class="comment-content">
<p>Not sure if this was xorshift or xoroshiro, but I used one of them and eventually learned the hard way that the PRNG had two sequences of numbers. One of them was covering all numbers except zero, the other was&#8230; zero.</p>
<p>That is a rather nasty failure mode. As a naïve user, one of the most natural initialization values for your PRNG state would be zero. Zero also happens to be the one value that leads to catastrophic failure &#8211; every random number you generate is zero. Any software where the most natural way of using it leads to catastrophic failure should be avoided. Even if you know the pitfall and make sure to use proper initialization values, someone else will modify your code in the future and expose the catastrophic failure again.</p>
</div>
</li>
</ol>
</li>
<li id="comment-649967" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f2c8ec8169a7f53bd609558434328a36?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f2c8ec8169a7f53bd609558434328a36?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tyge Løvset</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-27T11:38:32+00:00">March 27, 2023 at 11:38 am</time></a> </div>
<div class="comment-content">
<p>In the PractRand implementation, SFC64 has a seed function which skips 12 outputs, and the author discusses the required number:</p>
<p>&ldquo;16 outputs skipped &#8211; sfc64 is held to a higher standards for seeding than sfc32 because it is rated for more parallel scenarios<br/>
no wait, it&rsquo;s rated the same as sfc32, there&rsquo;s no reason for 16 rounds, stick to 12&rdquo;</p>
<p>BTW. I have abandoned my above generator, and now use a variant which is very similar to SFC64, but with an extra 64-bit state to generate 2^63 unique threads, and a different output function. This still needs to skip some initial rounds if the seed is weak. Interestingly, this is as fast or faster than SFC64 with the clang compiler.</p>
<p><code>uint64_t STC64(uint64_t s[5]) { // s[4] must be odd<br/>
enum {LR=24, RS=11, LS=3};<br/>
const uint64_t result = (s[0] ^ (s[3] += s[4])) + s[1];<br/>
s[0] = s[1] ^ (s[1] &gt;&gt; RS);<br/>
s[1] = s[2] + (s[2] &lt;&lt; LS);<br/>
s[2] = ((s[2] &lt;&lt; LR) | (s[2] &gt;&gt; (64 - LR))) + result;<br/>
return result;<br/>
}<br/>
</code></p>
</div>
</li>
</ol>
