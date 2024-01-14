---
date: "2019-07-23 12:00:00"
title: "Arbitrary byte-to-byte maps using ARM NEON?"
index: false
---

[17 thoughts on &ldquo;Arbitrary byte-to-byte maps using ARM NEON?&rdquo;](/lemire/blog/2019/07-23-arbitrary-byte-to-byte-maps-using-arm-neon)

<ol class="comment-list">
<li id="comment-419700" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-23T22:01:39+00:00">July 23, 2019 at 10:01 pm</time></a> </div>
<div class="comment-content">
<p>The TBX instruction (as opposed to TBL) is designed for this purpose and saves you doing the merge operations.</p>
<p>I suppose you could try a bunch of VPSHUFB&rsquo;s on x86, but it&rsquo;s not quite as efficient; might be enough to beat scalar code perhaps? TBL4/TBX4 isn&rsquo;t exactly fast on ARM, so the shuffles on x86 may have a chance&#8230;</p>
<p>Fast arbitrary 8-bit-&gt;8-bit mapping is nice, but I think only AVX512-VBMI can make it efficient.</p>
</div>
<ol class="children">
<li id="comment-419718" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-24T00:35:46+00:00">July 24, 2019 at 12:35 am</time></a> </div>
<div class="comment-content">
<blockquote>
<p>The TBX instruction (as opposed to TBL) is designed for this purpose<br/>
and saves you doing the merge operations.</p>
</blockquote>
<p>In my tests, it is slower. Here is what I tried&#8230;</p>
<pre><code>uint8x16_t simd_transform16x(uint8x16x4_t * table, uint8x16_t input) {
  uint8x16_t  t1 = vqtbx4q_u8(input, table[0],  input);
  t1 = vqtbx4q_u8(t1, table[1],  veorq_u8(input, vdupq_n_u8(0x40)));
  t1 = vqtbx4q_u8(t1, table[2],  veorq_u8(input, vdupq_n_u8(0x80)));
  t1 = vqtbx4q_u8(t1, table[3],  veorq_u8(input, vdupq_n_u8(0xc0)));
  return t1;
}
</code></pre>
<p>Am I misusing TBX&#8230;?</p>
</div>
<ol class="children">
<li id="comment-419726" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-24T02:07:03+00:00">July 24, 2019 at 2:07 am</time></a> </div>
<div class="comment-content">
<p>The first call should be TBL, not TBX. TBX&rsquo;s destination register is read+modify, so there&rsquo;d be a forced move since you still refer to &lsquo;input&rsquo; later on.<br/>
Other than that, it looks fine, and I don&rsquo;t know why it&rsquo;d be slower.</p>
<p>I&rsquo;m not familiar with the OoO behaviour on the A72. TBL and TBX are the same speed, but TBX does force a dependency chain. Usually doesn&rsquo;t matter on OoO processors, because they can schedule it in parallel with the next loop iteration.<br/>
According to the ARM optimization manual, TBL4/TBX4 have a latency of 15 cycles, but no throughput info is given, so you really do want to try to get the instructions to run in parallel.</p>
<p>Maybe you could test with a combination of the two, e.g.:</p>
<p><code>uint8x16_t simd_transform16x2(uint8x16x4_t * table, uint8x16_t input) {<br/>
uint8x16_t t1 = vqtbl4q_u8(table[0], input);<br/>
t1 = vqtbx4q_u8(t1, table[1], veorq_u8(input, vdupq_n_u8(0x40)));<br/>
uint8x16_t t2 = vqtbl4q_u8(table[2], veorq_u8(input, vdupq_n_u8(0x80)));<br/>
t2 = vqtbx4q_u8(t2, table[3], veorq_u8(input, vdupq_n_u8(0xc0)));<br/>
return vorrq_u8(t1, t2);<br/>
}<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-419822" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-24T17:00:13+00:00">July 24, 2019 at 5:00 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>Usually doesn’t matter on OoO processors, because they can schedule it<br/>
in parallel with the next loop iteration.</p>
</blockquote>
<p>At 15 cycles of latency per TBX4, that&rsquo;s a full 60 cycles of latency for the whole chain. I don&rsquo;t know what the OoO window is on the A72, but it is hard to imagine that you can totally hide such latency.</p>
<p>Even if you break it into two distinct part&#8230; you are still left with 30 + 3&#8230; 33 cycles of latency. It makes really hard to go really fast unless you have a crazily long instruction window&#8230;</p>
<p>(I&rsquo;ll run more tests.)</p>
</div>
</li>
<li id="comment-419849" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-24T23:57:32+00:00">July 24, 2019 at 11:57 pm</time></a> </div>
<div class="comment-content">
<p>Your new approach is better but still apparently slower than what I describe in my blog post&#8230;</p>
<pre><code>transform(map, values,volume)                               :  4959 ns total,  1.21 ns per input key
neon_transform(map, values,volume)                          :  5542 ns total,  1.35 ns per input key
neon_transformx(map, values,volume)                         :  7583 ns total,  1.85 ns per input key
neon_transformx2(map, values,volume)                        :  5833 ns total,  1.42 ns per input key
</code></pre>
</div>
<ol class="children">
<li id="comment-419857" class="comment byuser comment-author-lemire bypostauthor odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-25T01:07:55+00:00">July 25, 2019 at 1:07 am</time></a> </div>
<div class="comment-content">
<p>On an Amazon instance, I get slightly better results (different compiler, however)&#8230; with a 2% gain for your approach&#8230; (it appears to be a genuine 2% gain).</p>
<pre><code>transform(map, values,volume)                               :  3612 ns total,  0.88 ns per input key
neon_transform(map, values,volume)                          :  4344 ns total,  1.06 ns per input key
neon_transformx(map, values,volume)                         :  6036 ns total,  1.47 ns per input key
neon_transformx2(map, values,volume)                        :  4248 ns total,  1.04 ns per input key
</code></pre>
</div>
<ol class="children">
<li id="comment-419866" class="comment even depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-25T03:05:03+00:00">July 25, 2019 at 3:05 am</time></a> </div>
<div class="comment-content">
<p><a href="https://www.tomshardware.co.uk/arm-cortex-a72-architecture,review-33404.html" rel="nofollow">This page</a> states that the A72 has a 128 entry ROB, so a 60 latency chain might be problematic? <a href="https://www.cnx-software.com/2017/08/07/how-arm-nerfed-neon-permute-instructions-in-armv8/" rel="nofollow">This page</a> suggests that the throughput for TBL4 is 2 per clock (no clue on accuracy), which seems to suggest that you&rsquo;d need 30(!) lookups in parallel to maximise throughput.</p>
<p>Your test results (thanks for posting them) seem to suggest that the latency is a problem. I suppose, since the compiler probably isn&rsquo;t doing it, you could manually unroll the loop and interleave the TBL instructions to help the processor run stuff in parallel. Unrolling 4 times may be enough &#8211; it should achieve the same level of concurrency, but reduce the need for merging instructions.</p>
</div>
<ol class="children">
<li id="comment-419950" class="comment byuser comment-author-lemire bypostauthor odd alt depth-7">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-25T13:59:27+00:00">July 25, 2019 at 1:59 pm</time></a> </div>
<div class="comment-content">
<p>The version I present in my blog post with TBL4 does not have a 30 cycle latency. It can do four TBL4&#8230; somewhat in parallel&#8230; and then it needs to &ldquo;OR&rdquo; the results together (since there are four of them, this requires 3 ORs, but two of them can be done in parallel).</p>
<p>However, TBX4 can save us one bitwise OR so it should be faster, at least in theory, because it reduces the instruction count. However, it comes at a cost: longer dependency chains.</p>
<p>Doing more lookups in parallel should help, but as you observe, a 60-cycle dependency chain is really hard to hide. So the question as to how useful TBX is compared to TBL remains open. The evidence so far suggests that TBX is only moderately useful.</p>
</div>
</li>
<li id="comment-419999" class="comment even depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-25T19:15:03+00:00">July 25, 2019 at 7:15 pm</time></a> </div>
<div class="comment-content">
<p>I find a bit hard to believe that the TBL4 implementations all have 2 per clock throughput. A TLB4 would need to read from 5 source registers (the 4 table registers and the control), so 2 per cycle means 10 vector reads per cycle which is a huge amount &#8211; plus whatever other reads you do on other vector units at the same time. That&rsquo;s more reasons that much bigger contemporary chips.</p>
<p>Someone should test it&#8230;</p>
</div>
<ol class="children">
<li id="comment-420150" class="comment odd alt depth-8">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-26T12:23:01+00:00">July 26, 2019 at 12:23 pm</time></a> </div>
<div class="comment-content">
<p>The throughput definitely does seem weird. The official A72 optimization guide explicitly leaves them out under AArch64, though does specify 2 per clock for AArch32 operation (4x 64-bit registers) &#042;. My guess is that the post just went with the 2 per clock for all TBL/TBX instructions.</p>
<p>&#042; Even if we interpret 4x 64-bit registers as 2x 128-bit, a VTBX4 in AArch32 would require 4 vector reads (2x source table + source indicies + destination (I assume it needs to read the destination to blend in the bytes?)) per instruction, so doing 2x VTBX4 per clock would mean 8 reads/clock. Entirely possible that the guide is wrong though.</p>
<p>Considering that ORR is a very fast operation, and the cost of TBL4/TBX4 so large, I don&rsquo;t expect too much of a gain from TBX, but I imagine that there should be one if you can get it to parallelize well.</p>
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
<li id="comment-419708" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-23T22:53:18+00:00">July 23, 2019 at 10:53 pm</time></a> </div>
<div class="comment-content">
<p>I think you have enough registers in NEON (64-bit) for the full 256-&gt;256 lookup: 32 128-bit registers. So your 16 table registers fit easily, and only a handful of extras are needed for temporaries, etc.</p>
<p>It&rsquo;s slow just because it needs 2x as many tbl instructions, and those instructions dominate runtime. Indeed, it is approximately 2x as slow, as you&rsquo;d expect.</p>
</div>
<ol class="children">
<li id="comment-419716" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-24T00:21:28+00:00">July 24, 2019 at 12:21 am</time></a> </div>
<div class="comment-content">
<p>I think you are correct.</p>
</div>
<ol class="children">
<li id="comment-419720" class="comment byuser comment-author-lemire bypostauthor even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-24T00:41:47+00:00">July 24, 2019 at 12:41 am</time></a> </div>
<div class="comment-content">
<p>I was somehow under the impression that NEON had 16 registers, but aarch64 has 32 128-bit registers. This is more than I thought!</p>
</div>
<ol class="children">
<li id="comment-419820" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-24T16:39:33+00:00">July 24, 2019 at 4:39 pm</time></a> </div>
<div class="comment-content">
<p>Yeah both 32-bit and 64-bit ARM have 32 NEON registers, but in the 32-bit case they are only 64-bit wide.</p>
</div>
<ol class="children">
<li id="comment-419824" class="comment byuser comment-author-lemire bypostauthor even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-24T17:05:08+00:00">July 24, 2019 at 5:05 pm</time></a> </div>
<div class="comment-content">
<p>So NEON is somewhat close to AVX in terms of total register space, at least if you just look at the ISA. Right?</p>
<p>That is, I can glue together virtually pairs of NEON 128-bit registers and make myself sixteen 256-bit registers &ldquo;à la AMD&rdquo;.</p>
</div>
<ol class="children">
<li id="comment-419833" class="comment odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-24T18:32:55+00:00">July 24, 2019 at 6:32 pm</time></a> </div>
<div class="comment-content">
<p>Yes, it is identical in the sense that they both have 512 bytes of register space, either 32 x 16b or 16 x 32b.</p>
<p>AVX-512 quadruples that (!!) to 2048 bytes: 32 x 64b.</p>
<blockquote><p>
That is, I can glue together virtually pairs of NEON 128-bit registers<br/>
and make myself sixteen 256-bit registers “à la AMD”.
</p></blockquote>
<p>Well logically, yes. You can glue together any number of registers &ldquo;in software&rdquo; to create a longer &ldquo;register&rdquo;. It&rsquo;s quite a bit different than what AMD did though, in the sense that they did it in hardware. In software you need N instructions to execute on wider &ldquo;meta instruction&rdquo; when you glue together N registers. In hardware, you only need 1: the expansion to N operations happens internally.</p>
<p>In many cases this is much more efficient, since you can run into front-end limitations with so many instructions. This is a primary reason why CPU SIMD gets wider, rather than simply adding more EUs at the same width. That is, we have AVX-512 rather than simply 2x as many 256-bit units, even though 2x as many units is basically strictly more flexible &#8211; it is too hard to keep all those units fed at the front end: the CPU needs to be very wide.</p>
<p>GPUs have taken the opposite approach, which ever-increasing numbers of smallish-width EUs which now number in the 1000s on the fastest chips. They can do that because the whole execution model is quite different.</p>
<p>It&rsquo;s worth noting that I although we are calling it &ldquo;a la AMD&rdquo;, Intel used the same strategy for SSE and AVX: AVX-512 was the first time since MMX they didn&rsquo;t release the initial chips after a width expansion with half-width EUs.</p>
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
<li id="comment-594400" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-12T05:41:36+00:00">August 12, 2021 at 5:41 am</time></a> </div>
<div class="comment-content">
<p>I tried this on an M1 Macbook Air and got these values; transform and transformx2 seem to be identical most of the time, but I get a lot of variation between runs.</p>
<p><code> transform(map, values,volume) : 4083 ns total, 1.00 ns per input key<br/>
neon_transform(map, values,volume) : 1416 ns total, 0.35 ns per input key<br/>
neon_transformx(map, values,volume) : 1583 ns total, 0.39 ns per input key<br/>
neon_transformx2(map, values,volume) : 1417 ns total, 0.35 ns per input key<br/>
neon_transform_ascii(map, values,volume) : 625 ns total, 0.15 ns per input key<br/>
neon_transform_ascii64(map, values,volume) : 417 ns total, 0.10 ns per input key<br/>
neon_transform_nada(map, values,1000) : 7041 ns total, 7.04 ns per input key<br/>
neon_transform_nada(map, values,10000) : 70417 ns total, 7.04 ns per input key<br/>
</code></p>
</div>
</li>
</ol>
