---
date: "2020-12-11 12:00:00"
title: "ARM MacBook vs Intel MacBook"
index: false
---

[36 thoughts on &ldquo;ARM MacBook vs Intel MacBook&rdquo;](/lemire/blog/2020/12-11-arm-macbook-vs-intel-macbook)

<ol class="comment-list">
<li id="comment-561646" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6c0a386a516bb9ec67a653972c640dac?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6c0a386a516bb9ec67a653972c640dac?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Leif</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-12T02:03:07+00:00">December 12, 2020 at 2:03 am</time></a> </div>
<div class="comment-content">
<p>I would try to use debug tools to generate flame graphs, or river diagrams, of where each algorithm is spending its time. Something like <a href="http://www.brendangregg.com/FlameGraphs/cpu-mysql-updated.svg" rel="nofollow ugc">this example</a>.</p>
<p>That might provide some insight into commonalities and differences in the underlying libraries and functions.</p>
</div>
</li>
<li id="comment-561652" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a3974eb09df2608285d98eb1b18a1fdb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a3974eb09df2608285d98eb1b18a1fdb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Michael</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-12T02:35:43+00:00">December 12, 2020 at 2:35 am</time></a> </div>
<div class="comment-content">
<p>You write that &ldquo;[t]he Intel processor has nifty 256-bit SIMD instructions. The Apple chip has nothing of the sort as part of its main CPU.&rdquo;</p>
<p>The M1, like most modern ARM v8 CPUs, uses the NEON SIMD extension. The M1 has four 128-bit NEON pipelines, see <a href="https://www.anandtech.com/show/16226/apple-silicon-m1-a14-deep-dive/2" rel="nofollow ugc">the AnandTech overview</a>.</p>
<p>So the SIMD unit in the M1 is only half as wide as on current x86-64 CPUs, but &ldquo;nothing of the sort&rdquo; sounds a bit extreme&#8230;</p>
</div>
<ol class="children">
<li id="comment-561751" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-12T14:47:12+00:00">December 12, 2020 at 2:47 pm</time></a> </div>
<div class="comment-content">
<p>I am aware of NEON, but it is no match for AVX2 in general. Doubling the register width makes a big difference, at least in some cases.</p>
</div>
<ol class="children">
<li id="comment-561784" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b9620cb172292493f9c02c8f37c6cc7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b9620cb172292493f9c02c8f37c6cc7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Royi</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-12T19:44:40+00:00">December 12, 2020 at 7:44 pm</time></a> </div>
<div class="comment-content">
<p>I think in that regard they are on par.<br/>
Per core the Intel usually have 2 ports for 256 Bit so in total it works on 512 Bit of data ( I am not talking about the CPU&rsquo;s with AVX512, I&rsquo;m talking about the Skylake derived CPU&rsquo;s).</p>
<p>The M1 has 4 units of 128 Bit each. In total it is also 512.<br/>
Since it has much wider decoding front it won&rsquo;t get hurt by not having a 256 Bit operation in a single OP.</p>
</div>
<ol class="children">
<li id="comment-561788" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-12T20:51:03+00:00">December 12, 2020 at 8:51 pm</time></a> </div>
<div class="comment-content">
<p>Do you have benchmark numbers of a comparison between AVX2 on a recent x64 processor (Intel/AMD) and the equivalent on ARM NEON?</p>
</div>
<ol class="children">
<li id="comment-561832" class="comment odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b9620cb172292493f9c02c8f37c6cc7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b9620cb172292493f9c02c8f37c6cc7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Royi</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T08:04:30+00:00">December 13, 2020 at 8:04 am</time></a> </div>
<div class="comment-content">
<p>What about the SpecFP in the Anandtech review?<br/>
I&rsquo;d guess Clang will generate in many cases vectorized code so you&rsquo;ll be able to see.</p>
<p>But since you have the hardware, why not give it a try?</p>
</div>
<ol class="children">
<li id="comment-561855" class="comment even depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ddbb87aa781f694bc3cb1ec83ea9f7f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ddbb87aa781f694bc3cb1ec83ea9f7f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Andrei F</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T13:51:28+00:00">December 13, 2020 at 1:51 pm</time></a> </div>
<div class="comment-content">
<p>Daniel&rsquo;s background stance on this type of benchmarking surrounds software with heavy usage of intrinsics and optimised routines.</p>
<p>While the compiler will spit out some SIMD here and there where it can, SPECfp is uses general use-case code without such hand-crafted vectorisation, and as such the performance uplift and impact is very minor.</p>
</div>
</li>
</ol>
</li>
<li id="comment-561854" class="comment odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ddbb87aa781f694bc3cb1ec83ea9f7f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ddbb87aa781f694bc3cb1ec83ea9f7f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Andrei F</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T13:48:06+00:00">December 13, 2020 at 1:48 pm</time></a> </div>
<div class="comment-content">
<p>How can you claim NEON is no match for AVX2 and then ask for performance numbers? That&rsquo;s pretty a irresponsible stance.</p>
<p>Vector size is irrelevant to the performance discussion because each µarch will be optimised around their particular setup. The total execution throughput of the M1 isn&rsquo;t any less than that of your Kaby Lake chip &#8211; which is what matters.</p>
<p>As other have noted, there&rsquo;s plenty of NEON optimised software out there and it runs perfectly fine.</p>
<p>You can even try something a simple as a portability layer to run your own benchmarks of your own AVX2 packages:</p>
<p><a href="https://simd-everywhere.github.io/blog/2020/06/22/transitioning-to-arm-with-simde.html" rel="nofollow ugc">https://simd-everywhere.github.io/blog/2020/06/22/transitioning-to-arm-with-simde.html</a></p>
<p>For the vast majority of cases NEON should be functionally equivalent to AVX.</p>
</div>
<ol class="children">
<li id="comment-561866" class="comment byuser comment-author-lemire bypostauthor even depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T16:54:04+00:00">December 13, 2020 at 4:54 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>How can you claim NEON is no match for AVX2 and then ask for performance numbers? That’s pretty a irresponsible stance.</p>
</blockquote>
<p>I don&rsquo;t think it is irresponsible to ask for performance numbers. I do not like to argue in the abstract.</p>
</div>
<ol class="children">
<li id="comment-561870" class="comment byuser comment-author-lemire bypostauthor odd alt depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T18:31:57+00:00">December 13, 2020 at 6:31 pm</time></a> </div>
<div class="comment-content">
<p>See my post <a href="https://lemire.me/blog/2020/12/13/arm-macbook-vs-intel-macbook-a-simd-benchmark/">ARM MacBook vs Intel MacBook: a SIMD benchmark</a></p>
</div>
<ol class="children">
<li id="comment-561939" class="comment byuser comment-author-lemire bypostauthor even depth-8">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T23:01:26+00:00">December 13, 2020 at 11:01 pm</time></a> </div>
<div class="comment-content">
<p>BTW I was wrong. Not wrong to ask for benchmarks, but wrong in the belief that the M1 would not match AVX2.</p>
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
<li id="comment-561798" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-12T22:56:02+00:00">December 12, 2020 at 10:56 pm</time></a> </div>
<div class="comment-content">
<p>Intel CPUs have <strong>3x</strong> 256-bit ports, not 2x. Take note that wider SIMD doesn&rsquo;t only affect the EUs, it&rsquo;ll help with increasing effective PRF size, load/store etc.</p>
<p>Of course, not all EUs support all operations, but I have no clue what the distribution is like on M1.</p>
</div>
<ol class="children">
<li id="comment-561833" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b9620cb172292493f9c02c8f37c6cc7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b9620cb172292493f9c02c8f37c6cc7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Royi</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T08:06:14+00:00">December 13, 2020 at 8:06 am</time></a> </div>
<div class="comment-content">
<p>Intel Skylake, as far I can see and tell by WikiChip Page for Skylake has port for Floating Point operations with 256 Bit Width.</p>
<p>The server variation of Skylake has 2 x 512 Bit.<br/>
Later architectures have some other configurations.</p>
</div>
<ol class="children">
<li id="comment-561834" class="comment odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b9620cb172292493f9c02c8f37c6cc7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b9620cb172292493f9c02c8f37c6cc7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Royi</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T08:09:16+00:00">December 13, 2020 at 8:09 am</time></a> </div>
<div class="comment-content">
<p>A typo, I meant has 2 ports for Floating Point operations. Each port is capable of 256 Bit operations (AVX2).</p>
</div>
<ol class="children">
<li id="comment-561941" class="comment even depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T23:04:48+00:00">December 13, 2020 at 11:04 pm</time></a> </div>
<div class="comment-content">
<p>There are 3x 256-bit ports (0, 1, 5) on Skylake. For example, Skylake can perform <a href="https://uops.info/html-instr/VPADDB_YMM_YMM_YMM.html#SKL" rel="nofollow ugc">3x 256b <code>VPADDB</code> per clock</a>.<br/>
If you silo yourself to FP operations only, then only ports 0 and 1 can execute them (though stuff like bitwise logic, e.g. <code>VXORPS</code>, can run on port 5).</p>
<p>Note that 256b FP operations were added in AVX. AVX2 adds 256b <em>integer</em> operations.</p>
</div>
<ol class="children">
<li id="comment-562087" class="comment odd alt depth-8 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b9620cb172292493f9c02c8f37c6cc7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b9620cb172292493f9c02c8f37c6cc7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Royi</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-14T22:43:55+00:00">December 14, 2020 at 10:43 pm</time></a> </div>
<div class="comment-content">
<p>Have you looked at the WikiChip architecture page?</p>
<p>For <em>Floating Point</em> operations there are only 2 ports.</p>
</div>
<ol class="children">
<li id="comment-562097" class="comment even depth-9 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-15T00:20:35+00:00">December 15, 2020 at 12:20 am</time></a> </div>
<div class="comment-content">
<p>Yes, I&rsquo;ve read that page, several times in fact.</p>
<p>Have you read and understood my previous comment? I&rsquo;m guessing no, as you seem to be completely ignoring it.</p>
</div>
<ol class="children">
<li id="comment-562098" class="comment byuser comment-author-lemire bypostauthor odd alt depth-10">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-15T00:23:04+00:00">December 15, 2020 at 12:23 am</time></a> </div>
<div class="comment-content">
<p>You guys are saying the same thing.</p>
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
<li id="comment-561810" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maynard Handley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T01:05:37+00:00">December 13, 2020 at 1:05 am</time></a> </div>
<div class="comment-content">
<p>You (and other commenters) are aware of NEON, but apparently not of AMX.<br/>
AMX may not work for the sorts of JSON parsing weirdness for which you use AVX256 (that&rsquo;ll have to wait for SVE/2, probably next year) but it does solve the problem of &ldquo;I want to execute dense linear algebra fast&rdquo;.</p>
<p>You might want to run some comparisons of that for your M1 vs Intel MacBooks&#8230; The API&rsquo;s to look at are in Accelerate()<br/>
<a href="https://developer.apple.com/documentation/accelerate" rel="nofollow ugc">https://developer.apple.com/documentation/accelerate</a></p>
</div>
<ol class="children">
<li id="comment-561873" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T18:37:26+00:00">December 13, 2020 at 6:37 pm</time></a> </div>
<div class="comment-content">
<p>I am aware of the Neural Engine but I considered it to be outside of the scope of this blog post.</p>
</div>
<ol class="children">
<li id="comment-561907" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maynard Handley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T20:34:51+00:00">December 13, 2020 at 8:34 pm</time></a> </div>
<div class="comment-content">
<p>Apple AMX (not Intel AMX) is not neural engine, it is on-CPU, no different conceptually from from NEON.</p>
</div>
<ol class="children">
<li id="comment-562093" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-14T23:43:08+00:00">December 14, 2020 at 11:43 pm</time></a> </div>
<div class="comment-content">
<p>I stand corrected but it would still be outside the scope of the blog post. No matrix multiplication in sight.</p>
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
<li id="comment-561657" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0681a1cea7e156d7b381f89c92a0dba7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0681a1cea7e156d7b381f89c92a0dba7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://colour-science.org" class="url" rel="ugc external nofollow">Thomas Mansencal</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-12T02:51:09+00:00">December 12, 2020 at 2:51 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
In my basic tests, I general random
</p></blockquote>
<p>“generate”</p>
</div>
<ol class="children">
<li id="comment-561752" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-12T14:47:38+00:00">December 12, 2020 at 2:47 pm</time></a> </div>
<div class="comment-content">
<p>Thank you.</p>
</div>
</li>
</ol>
</li>
<li id="comment-561725" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">me</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-12T10:01:45+00:00">December 12, 2020 at 10:01 am</time></a> </div>
<div class="comment-content">
<p>Can you do a IO bound benchmark as reference?<br/>
How long does it take to count the number of 1&rsquo;s in the input files?</p>
<p>Don&rsquo;t you have concerns about Apple taxing all software on OSX via the play store with 30%?</p>
</div>
<ol class="children">
<li id="comment-561750" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-12T14:37:27+00:00">December 12, 2020 at 2:37 pm</time></a> </div>
<div class="comment-content">
<p>IO benchmarks are methodologically much more difficult.</p>
</div>
</li>
</ol>
</li>
<li id="comment-561740" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cyril</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-12T12:07:47+00:00">December 12, 2020 at 12:07 pm</time></a> </div>
<div class="comment-content">
<p>It would be interesting to compare SIMD performance too. M1 has 128bit NEON registers, but 4 SIMD execution units, all with mul support, comparing to 2+1 in Kaby Lake.</p>
</div>
<ol class="children">
<li id="comment-561891" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T19:41:37+00:00">December 13, 2020 at 7:41 pm</time></a> </div>
<div class="comment-content">
<p>I have added a SIMD benchmark.</p>
</div>
<ol class="children">
<li id="comment-561894" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cyril</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T19:46:08+00:00">December 13, 2020 at 7:46 pm</time></a> </div>
<div class="comment-content">
<p>Cool, thanks, looks very interesting. Another curious test is Lemire random number generator. M1 has 2 mul execution units for the integer pipeline, so it it can do 2 of 3 required multiplications in parallel. Probably it&rsquo;s time for me to order device with M1&#8230;</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-561761" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://blog.lbs.ca/" class="url" rel="ugc external nofollow">Dominic Amann</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-12T15:57:32+00:00">December 12, 2020 at 3:57 pm</time></a> </div>
<div class="comment-content">
<p>It would be interesting to see similar benchmarks for Risc V.</p>
</div>
<ol class="children">
<li id="comment-561800" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-12T22:57:54+00:00">December 12, 2020 at 10:57 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t believe any RISC-V processor is even remotely close to the level of performance of current top-end x86/ARM cores.</p>
</div>
</li>
</ol>
</li>
<li id="comment-561811" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maynard Handley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T01:12:26+00:00">December 13, 2020 at 1:12 am</time></a> </div>
<div class="comment-content">
<p>&ldquo;I do not yet understand why the fast_float library is so much faster on the Apple M1. It contains no ARM-specific optimization.&rdquo;</p>
<p>It&rsquo;s far from perfect but XCode/Instruments gives you access to performance counters on M1. You could start by looking at the usual suspects &#8211; number of instructions executed and retired and number of branches and branch mispredicts.<br/>
(I assume both the instruction flow and data memory flow are trivial enough that they aren&rsquo;t blocking. So it boils down to<br/>
&#8211; CPU width<br/>
&#8211; branch mispredicts<br/>
&#8211; ability to look ahead past shallow-ish dependency chains (ie deep issue queue)<br/>
I&rsquo;m not sure how you could get at the this third one. x86 probably has a perf counter that gives the average depth of the I queue, but M1 may not make such a counter user-visible &#8212; though I expect it is there)</p>
</div>
<ol class="children">
<li id="comment-561868" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T17:52:40+00:00">December 13, 2020 at 5:52 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>You could start by looking at the usual suspects – number of<br/>
instructions executed and retired and number of branches and branch<br/>
mispredicts.</p>
</blockquote>
<p>Because I have studied this code a bit (with performance counters), I know that the fast_float code has very few branch mispredictions. So I do not think that branch predictions is important in the sense that I expect both processors to predict the branch very well. Of course, from that point forward, if both have eliminated the branch misprediction bottleneck, one might do better than the other at pipelining the code.</p>
<p>Given that I expect relatively few mispredictions, I expect that the number of instructions retired is going to be roughly the same as it would be on any other ARM processor. It is possible that Apple has some neat optimizer tricks in its version of LLVM, but this code is quite generic and boring. There is only so much Apple could do.</p>
</div>
<ol class="children">
<li id="comment-562102" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maynard Handley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-15T02:21:40+00:00">December 15, 2020 at 2:21 am</time></a> </div>
<div class="comment-content">
<p>Well that&rsquo;s the point isn&rsquo;t it? Clarify the obvious basic things<br/>
&#8211; same number of instructions?<br/>
&#8211; same number of mispredicts?<br/>
&#8211; but 1.8x the performance so more than 2x the IPC. Where&rsquo;s that coming from?</p>
<p>IF you insist on the two points stipulated above, what&rsquo;s left?<br/>
The only three issues remaining that I can see are<br/>
&#8211; memory aliasing/forwarding. I don&rsquo;t know how important that is with this type of code. Is there a lot of writing to a location then immediately reading back from that location?<br/>
&#8211; dependency chains. If the most common dependency chains are (to guess numbers) around 150 instructions long, and x86&rsquo;s issue queue is 100 instructions long while Apple&rsquo;s is 200 long, then Apple can always be running two dependency chains in parallel, while most of the time Intel is operating on only one of them.<br/>
&#8211; (the opposite of the above; dependency chains are very unimportant) ie the code does a lot of &ldquo;parallel&rdquo; work (many independent operations at every stage) so that Apple&rsquo;s 8-wide decode and extreme flexibility in wide issue are no match for Intel&rsquo;s 4 (or 5 or whatever depending on the precise details) decode width and less flexible issue.</p>
<p>Basically where I&rsquo;m coming from is that this stuff isn&rsquo;t magic; there are reasons Apple achieve their 2+x IPC. But we won&rsquo;t discover them if (as so much of the internet insists) every time any particular aspect of the M1 is suggested as being better than x86 (better branch prediction, better memory aliasing support, &#8230;) the immediate assumption is that either Apple is <em>not</em> better along that dimension or, &ldquo;so what if they are, it doesn&rsquo;t matter&rdquo;.</p>
<p>At the very least I think it&rsquo;s important to validate assumptions like &ldquo;of course they have more or less the same number of instructions executed&rdquo;. Intel and ARMv8 both have &ldquo;rich&rdquo; instructions, ie instructions that do two things in one (eg on ARM shift-and-add, on Intel load-and-add). They then both crack these in different ways, then fuse the pieces in different ways.<br/>
My <em>guess</em> is that the ARM rich instructions are a better match to current technology (ie most of the ARM rich instructions can execute as a single cycle, whereas most of the Intel ones land up being cracked to two different types of operations and can&rsquo;t benefit from any sort of single-cycle &ldquo;lots of ALU&rsquo;ing&rdquo;.) I&rsquo;m not sure quite how one could test that claim, given that I don&rsquo;t even know what performance counters Apple provides to us. But certainly on the Intel side we could learn (?)<br/>
&#8211; instruction count<br/>
&#8211; micro-ops counts<br/>
&#8211; fused ops count?<br/>
Which gives us info on that side, which we can then compare with as much as Apple tells us. Even knowing the Intel IPC (close to 1? close to 4?) gives one a start in asking what&rsquo;s limiting performance.</p>
</div>
<ol class="children">
<li id="comment-562208" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-15T19:08:47+00:00">December 15, 2020 at 7:08 pm</time></a> </div>
<div class="comment-content">
<p>@Maynard</p>
<p>For some context, I have not given this issue any time at all. It is not that I do not appreciate the question, and I will try to answer it, but these things take more than 30 seconds.</p>
<blockquote>
<p>but 1.8x the performance so more than 2x the IPC.</p>
</blockquote>
<p>I do not know this for a fact but it is how it looks. It must be wrong, however. I honestly do not know what to think at this point.</p>
<p>Where’s that coming from?</p>
<blockquote>
<p>memory aliasing/forwarding. I don’t know how important that is with this type of code. Is there a lot of writing to a location then immediately reading back from that location?</p>
</blockquote>
<p>No. There is no (substantial) memory writes in the hot loops being benchmarked. You just read strings and compare the results with a min/max threshold.</p>
<blockquote>
<p>dependency chains. If the most common dependency chains are (to guess numbers) around 150 instructions long, and x86’s issue queue is 100 instructions long while Apple’s is 200 long, then Apple can always be running two dependency chains in parallel, while most of the time Intel is operating on only one of them. – (the opposite of the above; dependency chains are very unimportant) ie the code does a lot of “parallel” work (many independent operations at every stage) so that Apple’s 8-wide decode and extreme flexibility in wide issue are no match for Intel’s 4 (or 5 or whatever depending on the precise details) decode width and less flexible issue.</p>
</blockquote>
<p>The M1 could retire more instructions per cycle but could it retire 2x the number of instructions?</p>
<p>It would need to retire something like 8 instructions per cycle. I am not kidding.</p>
<blockquote>
<p>Basically where I’m coming from is that this stuff isn’t magic; there are reasons Apple achieve their 2+x IPC. But we won’t discover them if (as so much of the internet insists) every time any particular aspect of the M1 is suggested as being better than x86 (better branch prediction, better memory aliasing support, …) the immediate assumption is that either Apple is not better along that dimension or, “so what if they are, it doesn’t matter”.</p>
</blockquote>
<p>I did not imply that your question did not matter. In fact, I raised the question in my blog post because I think it is interesting.</p>
<blockquote>
<p>At the very least I think it’s important to validate assumptions like “of course they have more or less the same number of instructions executed”. Intel and ARMv8 both have “rich” instructions, ie instructions that do two things in one (eg on ARM shift-and-add, on Intel load-and-add). They then both crack these in different ways, then fuse the pieces in different ways.</p>
</blockquote>
<p>I have benchmarked this code on ARM processors before&#8230; just not on the A1. I am not new to ARM&#8230; I had an AMD ARM server&#8230;</p>
<p>I have strong reasons to expect that the numbers of instructions retired on different ARM processors are going to be the same because (1) I expect the compiled binaries to be similar (2) I expect that there are few mispredicted branches.</p>
<p>Then, of course, the M1 could do all sorts of fusion and stuff&#8230;</p>
<blockquote>
<p>My guess is that the ARM rich instructions are a better match to current technology (ie most of the ARM rich instructions can execute as a single cycle, whereas most of the Intel ones land up being cracked to two different types of operations and can’t benefit from any sort of single-cycle “lots of ALU’ing”.) I’m not sure quite how one could test that claim, given that I don’t even know what performance counters Apple provides to us. But certainly on the Intel side we could learn (?) – instruction count – micro-ops counts – fused ops count? Which gives us info on that side, which we can then compare with as much as Apple tells us. Even knowing the Intel IPC (close to 1? close to 4?) gives one a start in asking what’s limiting performance.</p>
</blockquote>
<p>The AMD Zen 2 IPC is 4 or even slightly better than 4.</p>
<p>I have all the numbers for these&#8230; Just run my benchmark under Linux, it is instrumented and will give you straight back (without calling perf) the counter values.</p>
<p>It is all there&#8230; 🙂</p>
<p>It is not that I don&rsquo;t care about the questions you are asking. I do care. But like all of us, I have only 26 hours per day. 🙂</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-562224" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maynard Handley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-15T20:59:40+00:00">December 15, 2020 at 8:59 pm</time></a> </div>
<div class="comment-content">
<p>M1 probably CAN retire 8 instructions per cycle&#8230; It can certainly decode 8 per cycle so if anything retire will be 8 or higher. Issue is of course way higher, but the important number is 6 wide fixed point issue. Throw in some load/stores and branches and you’re easily also at 8wide issue.<br/>
A7 started at 6 wide, and around A11 bumped that to 8.</p>
<p>Maybe it is as simple as — this is VERY ILP friendly code, and Apple can execute it at IPC of 8.</p>
</div>
</li>
</ol>
