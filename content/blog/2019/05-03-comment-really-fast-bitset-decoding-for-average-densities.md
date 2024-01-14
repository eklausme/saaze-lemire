---
date: "2019-05-03 12:00:00"
title: "Really fast bitset decoding for &#8220;average&#8221; densities"
index: false
---

[35 thoughts on &ldquo;Really fast bitset decoding for &#8220;average&#8221; densities&rdquo;](/lemire/blog/2019/05-03-really-fast-bitset-decoding-for-average-densities)

<ol class="comment-list">
<li id="comment-405070" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24cfa9591263008553ae4c125b6a9934?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24cfa9591263008553ae4c125b6a9934?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">wmu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-04T12:06:29+00:00">May 4, 2019 at 12:06 pm</time></a> </div>
<div class="comment-content">
<p>You can make the code a bit faster on GCC 8, by using alternative C construction. If you introduce an auxiliary &ldquo;uint32_t* val = base_ptr + base&rdquo; and then each update will be like &ldquo;*val++ = static_cast(idx) + trailingzeroes(bits);&rdquo; then the compiler emits a slightly better machine code.</p>
<p>Before: instructions per cycle 2.57, cycles per value set: 3.797<br/>
After: instructions per cycle 2.45, cycles per value set: 3.428</p>
<p>10% for free, not that bad 🙂</p>
</div>
</li>
<li id="comment-405104" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-04T20:37:37+00:00">May 4, 2019 at 8:37 pm</time></a> </div>
<div class="comment-content">
<p>You could do better by matching the number of bits processed to typical input data. Eg. unconditionally do 6 bits, do 4 more if there are still bits left, and then loop 2 bits at a time. This reduces branch misses as well as unnecessary work when there are no more set bits.</p>
<p>However the most obvious way to speed this up further is to delay the decoding until you actually need it. This avoids the overhead of expanding the bitmap into a much larger data structure (max expansion is 64 times) and all associated cache overheads.</p>
<p>Also the latency of computing the next bit will be completely hidden, unlike in these examples where the 2-cycle latency of x = x &amp; (x &#8211; 1) is going to dominate (processing 2 64-bit masks in parallel may avoid this latency chain, but that makes things even more complex).</p>
</div>
<ol class="children">
<li id="comment-405480" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-07T11:51:58+00:00">May 7, 2019 at 11:51 am</time></a> </div>
<div class="comment-content">
<p>Note on a modern AArch64 core the basic decoder is fastest by default since it has the minimum number of instructions per bit set. Doing extra work doesn&rsquo;t offset the reduction in branch misses (which are fast on Arm cores due to shallow pipelines). Changing faster_decoder to do 6 bits first, then 4 bits and finally loop on 1 bit is ~10% faster than fast_decoder and 20% than simdjson_decoder.</p>
<p>Btw would it be reasonable to have a #if around #include &lt;x86intrin.h&gt; and evts.push_back(PERF_COUNT_HW_REF_CPU_CYCLES) so the code becomes more portable? That event fails on AArch64 kernels but this causes all other events to fail too&#8230;</p>
</div>
<ol class="children">
<li id="comment-405482" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-07T12:06:56+00:00">May 7, 2019 at 12:06 pm</time></a> </div>
<div class="comment-content">
<p>Thanks&#8230; I did not know that PERF_COUNT_HW_REF_CPU_CYCLES would fail on AArch64, thanks for pointing this out.</p>
<p>Yes, evidently, the x86intrin header needs to be guarded with appropriate checks.</p>
</div>
</li>
<li id="comment-405944" class="comment byuser comment-author-lemire bypostauthor even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-11T03:05:16+00:00">May 11, 2019 at 3:05 am</time></a> </div>
<div class="comment-content">
<p><em>Note on a modern AArch64 core the basic decoder is fastest by default since it has the minimum number of instructions per bit set. </em></p>
<p>Sorry if I took some time to get back to you on this. So I verify this result initially, on an older compiler, but after reading up that the latest GNU GCC improved code generation improved I tried with GNU GCC 9&#8230; The results appear to be equivalent to what I get on x64, thus apparently contradicting your statement&#8230;</p>
<p>I post my results as a MarkDown file&#8230;</p>
<p><a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2019/05/03/RESULTS_AARCH64_AMPERE.md" rel="nofollow ugc">https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2019/05/03/RESULTS_AARCH64_AMPERE.md</a></p>
<p>Furthermore, you will find a dockerfile to ease reproduction.</p>
</div>
<ol class="children">
<li id="comment-406020" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-11T16:50:56+00:00">May 11, 2019 at 4:50 pm</time></a> </div>
<div class="comment-content">
<p>Well you found a GCC9 bug! It incorrectly adds a useless popcount after the basic_decoder loop:</p>
<p><code> mov x0, x4<br/>
.L2758:<br/>
rbit x1, x0<br/>
clz x1, x1<br/>
add w1, w3, w1<br/>
str w1, [x19, w2, uxtw 2]<br/>
sub x1, x0, #1<br/>
add w2, w2, 1<br/>
ands x0, x0, x1<br/>
bne .L2758<br/>
fmov d0, x4<br/>
cnt v0.8b, v0.8b<br/>
addv b0, v0.8b<br/>
umov w0, v0.b[0]<br/>
add w20, w20, w0<br/>
</code></p>
<p>That adds extra latency and 6 instructions, slowing basic_decoder.</p>
</div>
<ol class="children">
<li id="comment-406026" class="comment byuser comment-author-lemire bypostauthor even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-11T17:27:55+00:00">May 11, 2019 at 5:27 pm</time></a> </div>
<div class="comment-content">
<p>Interesting.</p>
</div>
<ol class="children">
<li id="comment-406193" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-12T16:29:51+00:00">May 12, 2019 at 4:29 pm</time></a> </div>
<div class="comment-content">
<p>So I did additional testing.</p>
<blockquote><p>fast_decoder:<br/>
GCC8 => 8.8 cycles<br/>
CLANG8 => 8.7 cycles<br/>
GCC9 => 8.7 cycles</p>
<p>simdjson_decoder:<br/>
GCC8 => 12.6 cycles<br/>
CLANG8 => 9.6 cycles<br/>
GCC9 => 9.7 cycles</p>
<p>basic_decoder:<br/>
GCC8 => 8.5 cycles<br/>
CLANG8 => 11.8 cycles<br/>
GCC9 => 11.8 cycles</p></blockquote>
<p>I have updated the results in an markdown file in my repo (with the AMPERE string in the name). To ensure reproducibility, I have posted my scripts and docker files.</p>
<p>It seems that LLVM 8 compiles basic_decoder to the following&#8230;</p>
<blockquote><p>
.globl _Z13basic_decoderPjRjjm // &#8212; Begin function _Z13basic_decoderPjRjjm<br/>
.p2align 2<br/>
.type _Z13basic_decoderPjRjjm,@function<br/>
_Z13basic_decoderPjRjjm: // @_Z13basic_decoderPjRjjm<br/>
// %bb.0:<br/>
cbz x3, .LBB4_3<br/>
// %bb.1:<br/>
ldr w8, [x1]<br/>
.LBB4_2: // =>This Inner Loop Header: Depth=1<br/>
rbit x9, x3<br/>
clz x9, x9<br/>
add w9, w9, w2<br/>
str w9, [x0, w8, uxtw #2]<br/>
ldr w8, [x1]<br/>
sub x9, x3, #1 // =1<br/>
ands x3, x9, x3<br/>
add w8, w8, #1 // =1<br/>
str w8, [x1]<br/>
b.ne .LBB4_2<br/>
.LBB4_3:<br/>
ret<br/>
.Lfunc_end4:<br/>
.size _Z13basic_decoderPjRjjm, .Lfunc_end4-_Z13basic_decoderPjRjjm<br/>
// &#8212; End function</p></blockquote>
<p>As for the <tt>basic_decoder</tt> function under GCC-9, it compiles to&#8230;</p>
<blockquote><p> .global _Z13basic_decoderPjRjjm<br/>
.type _Z13basic_decoderPjRjjm, %function<br/>
_Z13basic_decoderPjRjjm:<br/>
.LFB1985:<br/>
.cfi_startproc<br/>
// bitmapdecoding.cpp:86: while (bits != 0) {<br/>
cbz x3, .L2222 // bits,<br/>
ldr w4, [x1] //, *base_15(D)<br/>
.p2align 3,,7<br/>
.L2225:<br/>
// bitmapdecoding.cpp:26: return __builtin_ctzll(input_num);<br/>
rbit x5, x3 // tmp102, bits<br/>
clz x5, x5 // tmp102, tmp102<br/>
// bitmapdecoding.cpp:87: base_ptr[base] = static_cast<uint32_t>(idx) + trailingzeroes(bits);<br/>
add w5, w2, w5 // tmp105, idx, tmp102<br/>
// bitmapdecoding.cpp:87: base_ptr[base] = static_cast</uint32_t><uint32_t>(idx) + trailingzeroes(bits);<br/>
str w5, [x0, w4, uxtw 2] // tmp105, *_5<br/>
// bitmapdecoding.cpp:88: bits = bits &#038; (bits &#8211; 1);<br/>
sub x4, x3, #1 // _7, bits,<br/>
// bitmapdecoding.cpp:86: while (bits != 0) {<br/>
ands x3, x3, x4 // bits, bits, _7<br/>
// bitmapdecoding.cpp:89: base++;<br/>
ldr w4, [x1] //, *base_15(D)<br/>
add w4, w4, 1 // _9, *base_15(D),<br/>
str w4, [x1] // _9, *base_15(D)<br/>
// bitmapdecoding.cpp:86: while (bits != 0) {<br/>
bne .L2225 //,<br/>
.L2222:<br/>
// bitmapdecoding.cpp:91: }<br/>
ret</uint32_t></p></blockquote>
</div>
<ol class="children">
<li id="comment-406195" class="comment byuser comment-author-lemire bypostauthor even depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-12T16:36:46+00:00">May 12, 2019 at 4:36 pm</time></a> </div>
<div class="comment-content">
<p>It is hard for me to understand your concern with the 2-cycle dependency. We are using, in the best case, 8.5 cycles per set bit&#8230; far more than 2 cycles.</p>
<p>Note that even in the best scenario, we are a full 2x the number of cycles that an Intel processor needs. That&rsquo;s not good.</p>
<p>What is troubling is that the basic_decoder runs at 1 instruction per cycle or less. So there is contention for <em>something</em> and it is not strictly just data dependency&#8230;</p>
</div>
<ol class="children">
<li id="comment-406211" class="comment byuser comment-author-lemire bypostauthor odd alt depth-8 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-12T18:26:37+00:00">May 12, 2019 at 6:26 pm</time></a> </div>
<div class="comment-content">
<p>Is this the best aarch64 can do for a population count?</p>
<p><a href="https://godbolt.org/z/7KtXbC" rel="nofollow ugc">https://godbolt.org/z/7KtXbC</a></p>
<p>This looks expensive&#8230; recent AMD x64 processors do the same with one instruction that can be executed 4 times per cycle.</p>
</div>
<ol class="children">
<li id="comment-406380" class="comment even depth-9 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-13T11:26:10+00:00">May 13, 2019 at 11:26 am</time></a> </div>
<div class="comment-content">
<p>Yes that&rsquo;s the right sequence given there is no integer instruction. So it&rsquo;s important not to use popcount on AArch64 as if it is really cheap.</p>
<p>I get less than 30 cycles per word on basic_decoder, which is faster than the x86 core you used. It may well be that branch prediction is the main performance limiter for sparse bitsets like this. So I still believe it&rsquo;s fastest to decode on demand rather than like this.</p>
</div>
<ol class="children">
<li id="comment-406387" class="comment byuser comment-author-lemire bypostauthor odd alt depth-10">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-13T12:17:37+00:00">May 13, 2019 at 12:17 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>I get less than 30 cycles per word on basic_decoder</p>
</blockquote>
<p>On a different processor, I presume? Because I&rsquo;d be pretty happy with 30 cycles per word &#8230; but I clearly do not get close to this (all my results are posted in my repo).</p>
</div>
</article>
</li>
<li id="comment-406398" class="comment even depth-10">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-13T13:39:15+00:00">May 13, 2019 at 1:39 pm</time></a> </div>
<div class="comment-content">
<p>Yes definitely. It seems Cortex cores can predict this better, for example Cortex-A72 has fewer than 13K mispredictions for all tests, but your results show over 20K mispredicts on x86 and Ampere.</p>
</div>
</article>
</li>
<li id="comment-406641" class="comment byuser comment-author-lemire bypostauthor odd alt depth-10">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-14T19:55:04+00:00">May 14, 2019 at 7:55 pm</time></a> </div>
<div class="comment-content">
<p>@Wilco</p>
<p><a href="https://lemire.me/blog/2019/05/14/setting-up-a-rockpro64-powerful-single-card-computer/">Took my some time, but I built up an ARM box of my own</a>.</p>
<p>I confirm that the Cortex-A72 is close to Intel Skylake as far as cycles, and mispredicted branches. Sometimes Intel does better, sometimes the A72 does better. The differences are not large from what I see (that&rsquo;s what you&rsquo;d expect from competitive technologies).</p>
<p>The Cortex-A72 is definitively superior on this benchmark than Ampere&rsquo;s Skylark.</p>
<p>It is still inferior to Intel in the end because it does not appear to be able to cram as many instructions per cycle&#8230;</p>
</div>
</article>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-406375" class="comment even depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-13T11:07:07+00:00">May 13, 2019 at 11:07 am</time></a> </div>
<div class="comment-content">
<p>So you can reproduce the slowdown of basic_decoder. Note you&rsquo;re quoting the non-inline version of basic_decoder rather than the main loop where it is inlined, which is where GCC9 adds the redundant popcount.</p>
</div>
<ol class="children">
<li id="comment-406737" class="comment byuser comment-author-lemire bypostauthor odd alt depth-8 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-15T01:51:43+00:00">May 15, 2019 at 1:51 am</time></a> </div>
<div class="comment-content">
<p>@Wilco</p>
<p>I have run the test on Apple&rsquo;s A12 using the current version of Xcode&#8230;</p>
<p><a href="https://github.com/lemire/iosbitmapdecoding" rel="nofollow ugc">https://github.com/lemire/iosbitmapdecoding</a></p>
<p>The numbers do not make much sense: they would imply that Apple&rsquo;s A12 is highly inefficient.</p>
</div>
<ol class="children">
<li id="comment-407798" class="comment byuser comment-author-lemire bypostauthor even depth-9">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-20T13:29:57+00:00">May 20, 2019 at 1:29 pm</time></a> </div>
<div class="comment-content">
<p>The opposite is true: the A12 is highly effective on a per cycle basis: <a href="https://lemire.me/blog/2019/05/15/bitset-decoding-on-apples-a12/" rel="ugc">https://lemire.me/blog/2019/05/15/bitset-decoding-on-apples-a12/</a></p>
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
<li id="comment-408458" class="comment odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-23T12:45:17+00:00">May 23, 2019 at 12:45 pm</time></a> </div>
<div class="comment-content">
<p>Reported on GCC bugzilla: <a href="https://gcc.gnu.org/bugzilla/show_bug.cgi?id=90594" rel="nofollow ugc">https://gcc.gnu.org/bugzilla/show_bug.cgi?id=90594</a></p>
</div>
<ol class="children">
<li id="comment-408462" class="comment byuser comment-author-lemire bypostauthor even depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-23T12:50:54+00:00">May 23, 2019 at 12:50 pm</time></a> </div>
<div class="comment-content">
<p>Excellent. We need good code generation.</p>
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
<li id="comment-405534" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jörn Engel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-07T20:53:17+00:00">May 7, 2019 at 8:53 pm</time></a> </div>
<div class="comment-content">
<p>A similar problem comes up when looking for certain bytes or patterns. Best approach is to use vector-comparisons and movemask, resulting in bitmaps and essentially your problem.</p>
<p>One idea I have yet to try is to sort bitmap-words based on popcount. Processing the sorted bitmap-words can completely eliminate the mispredicted branches. You have to do more memory operations, which will partially offset the misprediction savings. But more importantly the algorithm gets rather complicated, so you are trading your own time and sanity for runtime performance. So far I couldn&rsquo;t bring myself to make that trade.</p>
</div>
<ol class="children">
<li id="comment-405536" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-07T21:09:36+00:00">May 7, 2019 at 9:09 pm</time></a> </div>
<div class="comment-content">
<p>I have tried it and at least for my use cases it didn&rsquo;t turn out faster. The sorting ate up my savings (I used a type of radix sort which I think was basically ideal for this scenario).</p>
<p>However, as I recall by baseline was quite a bit faster than the ~4 cycles shown here: I think it was closer to 1.5 cycles.</p>
</div>
<ol class="children">
<li id="comment-405537" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-07T21:11:57+00:00">May 7, 2019 at 9:11 pm</time></a> </div>
<div class="comment-content">
<p>@Travis @Jörn</p>
<p>I did implement what you describe. It is in the code but not covered by the blog post&#8230;</p>
<p><a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2019/05/03/bitmapdecoding.cpp#L304" rel="nofollow ugc">https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2019/05/03/bitmapdecoding.cpp#L304</a></p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-406893" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/183065534e7fc7f0cd415be71beffc74?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/183065534e7fc7f0cd415be71beffc74?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Zach Bjornson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-15T21:59:09+00:00">May 15, 2019 at 9:59 pm</time></a> </div>
<div class="comment-content">
<p>This can be done branchlessly with AVX2+BMI2 if you use the technique described in <a href="https://stackoverflow.com/questions/36932240/avx2-what-is-the-most-efficient-way-to-pack-left-based-on-a-mask/36951611#36951611" rel="nofollow ugc">https://stackoverflow.com/questions/36932240/avx2-what-is-the-most-efficient-way-to-pack-left-based-on-a-mask/36951611#36951611</a>, using an array of sequential numbers as the src to the &ldquo;compress&rdquo; function.</p>
<p>With AVX512 you can do an entire 64-bit integer at once with a single instruction,<br/>
<code>vcompressps</code> (<code>_mm512_mask_compresstoreu_epi8(dest, bitset, rangeOf0Through64</code>).</p>
</div>
<ol class="children">
<li id="comment-406895" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/183065534e7fc7f0cd415be71beffc74?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/183065534e7fc7f0cd415be71beffc74?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Zach Bjornson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-15T22:02:30+00:00">May 15, 2019 at 10:02 pm</time></a> </div>
<div class="comment-content">
<p>(With AVX512_VBMI2*, not AVX512F.)</p>
<p>And now I see something like this mentioned in one of the further reading links :).</p>
</div>
</li>
<li id="comment-406898" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-15T22:11:17+00:00">May 15, 2019 at 10:11 pm</time></a> </div>
<div class="comment-content">
<p>I think that I allude to the vectorization option in my post, with the important caveat:</p>
<blockquote><p>If the words you are receiving have few 1-bits (say less than one 1-bit per 64-bit words), then you have the sparse regime, and it becomes important to detect quickly zero inputs, for example. If half of your bits are set, you have the dense regime and it is best handled using using vectorization and lookup tables.</p></blockquote>
<p>So I think vector instructions will have trouble coping with the kind of data I am considering in this post.</p>
<p>This is not to say that you cannot do it &ldquo;branchlessly&rdquo;: you can. You can bring down cache misses to almost zero. The trick is to do that while also not increasing instruction count too much.</p>
</div>
</li>
</ol>
</li>
<li id="comment-407715" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-20T03:54:31+00:00">May 20, 2019 at 3:54 am</time></a> </div>
<div class="comment-content">
<p>How well does a switch statement work? e.g.</p>
<p><code>int count = popcnt(word);<br/>
int* resultEnd = result + count;<br/>
switch(count) {<br/>
case 64: case 63: // ...etc<br/>
for(int i=-count+4; i; i++) {<br/>
resultEnd[i-4] = trailingzeroes(word);<br/>
word &amp;= word-1;<br/>
}<br/>
case 4: // add more cases if desired<br/>
resultEnd[-4] = trailingzeroes(word);<br/>
word &amp;= word-1;<br/>
case 3:<br/>
resultEnd[-3] = trailingzeroes(word);<br/>
word &amp;= word-1;<br/>
case 2:<br/>
resultEnd[-2] = trailingzeroes(word);<br/>
word &amp;= word-1;<br/>
case 1:<br/>
resultEnd[-1] = trailingzeroes(word);<br/>
case 0:<br/>
}<br/>
</code></p>
<p>This could reduce &ldquo;wasted&rdquo; actions. If the exact ordering doesn&rsquo;t matter, you could also skip the resultEnd calculation.</p>
<p>Also, the initial branch may be expensive in this case if the number of bits set isn&rsquo;t always the same. You could probably do some hybrid approach where you do a more coarse grained switch if the number of bits set happens to often fall within a particular range, e.g.:</p>
<p><code>int count4 = popcnt(word) &amp; -4;<br/>
// example for granularity = 4, change values if more appropriate<br/>
int* resultEnd = result + count4;<br/>
switch(count4) {<br/>
case 60: case 56: // ...etc<br/>
// do some loop<br/>
case 8:<br/>
resultEnd[-8] = trailingzeroes(word);<br/>
word &amp;= word-1;<br/>
resultEnd[-7] = trailingzeroes(word);<br/>
word &amp;= word-1;<br/>
resultEnd[-6] = trailingzeroes(word);<br/>
word &amp;= word-1;<br/>
resultEnd[-5] = trailingzeroes(word);<br/>
word &amp;= word-1;<br/>
case 4:<br/>
resultEnd[-4] = trailingzeroes(word);<br/>
word &amp;= word-1;<br/>
resultEnd[-3] = trailingzeroes(word);<br/>
word &amp;= word-1;<br/>
resultEnd[-2] = trailingzeroes(word);<br/>
word &amp;= word-1;<br/>
resultEnd[-1] = trailingzeroes(word);<br/>
word &amp;= word-1;<br/>
case 0:<br/>
resultEnd[0] = trailingzeroes(word);<br/>
word &amp;= word-1;<br/>
resultEnd[1] = trailingzeroes(word);<br/>
word &amp;= word-1;<br/>
resultEnd[2] = trailingzeroes(word);<br/>
}<br/>
</code></p>
<p>Although this approach does make it much closer to what you already have.</p>
<p>Depending on the bits set, a fast SIMD+lookup approach may still be reasonable even if there&rsquo;s a smallish number of bits typically set, e.g.</p>
<p><code>int wordPart16 = (word &amp; 0xffff) &lt;&lt; 4;<br/>
_mm_storeu_si128(result, _mm_load_si128((char*)table + wordPart16));<br/>
result += _mm_popcnt_u32(wordPart16);<br/>
wordPart16 = (word&gt;&gt;12) &amp; 0xffff0;<br/>
_mm_storeu_si128(result, _mm_load_si128((char*)table + wordPart16));<br/>
result += _mm_popcnt_u32(wordPart16);<br/>
wordPart16 = (word&gt;&gt;28) &amp; 0xffff0;<br/>
_mm_storeu_si128(result, _mm_load_si128((char*)table + wordPart16));<br/>
result += _mm_popcnt_u32(wordPart16);<br/>
wordPart16 = (word&gt;&gt;44) &amp; 0xffff0;<br/>
_mm_storeu_si128(result, _mm_load_si128((char*)table + wordPart16));<br/>
//result += _mm_popcnt_u32(wordPart16); // if needed<br/>
</code></p>
<p>This may still be competitive if there&rsquo;s only 6 bits per 64-bit word.</p>
</div>
<ol class="children">
<li id="comment-407800" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-20T13:48:16+00:00">May 20, 2019 at 1:48 pm</time></a> </div>
<div class="comment-content">
<p>I have tried both of these techniques. The vectorized decoding is already part of CRoaring <a href="https://github.com/RoaringBitmap/CRoaring/blob/master/src/bitset_util.c#L553" rel="nofollow ugc">https://github.com/RoaringBitmap/CRoaring/blob/master/src/bitset_util.c#L553</a></p>
<p>It works and this library is in production in some large corporations.</p>
<p>However, I have not managed to make it competitive in the average-density scenario.</p>
<p>I tried the switch case approach but I could not make it run faster though I must admit that I did not do much more than just code some C and record timings.</p>
<p>My benchmark is rather simple: have you tried modifying it to test your ideas? Get in touch if you get promising results.</p>
</div>
<ol class="children">
<li id="comment-407934" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-21T02:37:02+00:00">May 21, 2019 at 2:37 am</time></a> </div>
<div class="comment-content">
<p>Ah, you&rsquo;re using 32-bit indicies &#8211; that will seriously hurt a SIMD approach.<br/>
On the flipside, if AVX512 is usable, you can use the VCOMPRESSD technique instead, which should perform very well.</p>
<p>I suspect the naiive switch statement to perform better than the naiive loop approach. The performance of the jump could be problematic if there&rsquo;s any unpredictable variation in the number of bits set.<br/>
The coarse grained switch works better with variation of bits set, but is more similar to the simdjson decoder. Performance ultimately depends on the density characteristics I think; simdjson is probably slightly better if &lt;8 bits are usually set, as it can avoid a jump.</p>
<p>If it&rsquo;s rare that there will be more than 1 bit set per 4, one could break it into nibbles and use PSHUFB to obtain indicies, which could perform okay. Looking at your sample data though, this isn&rsquo;t the case, in fact, there seems to be a mix of densities, though they repeat regularly.</p>
<p>It looks like your benchmark requires Linux perf counters, so must be run on a Linux baremetal install (doesn&rsquo;t work in a Linux VM), which makes things a little tricky for me&#8230;</p>
</div>
<ol class="children">
<li id="comment-408006" class="comment even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-21T10:57:46+00:00">May 21, 2019 at 10:57 am</time></a> </div>
<div class="comment-content">
<p>Well, wasn&rsquo;t too far off what I had expected (I haven&rsquo;t checked these for accuracy, so these are just rough indications). Figures are cycles per word:</p>
<p>simdjson: 22.867<br/>
basic: 33.117<br/>
switch: 31.389<br/>
switch4: 30.199<br/>
switch8: 24.309<br/>
switch16: 23.028<br/>
vcompressd: 15.322</p>
</div>
<ol class="children">
<li id="comment-408108" class="comment byuser comment-author-lemire bypostauthor odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-21T21:25:09+00:00">May 21, 2019 at 9:25 pm</time></a> </div>
<div class="comment-content">
<p>Regarding the switch, I&rsquo;d want to have a close look at how the compiler implements it. The compiler is free to turn a switch case into branching. I am surprised by the vcompressd results.</p>
<p>Would you share your code? Maybe as a GitHub gist?</p>
</div>
<ol class="children">
<li id="comment-408190" class="comment even depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-22T10:26:31+00:00">May 22, 2019 at 10:26 am</time></a> </div>
<div class="comment-content">
<p>Yes, I confirmed that the switch is compiling to a jump, not a series of branches.</p>
<p>The vcompressd method is fairly straightforward:</p>
<p><code>#ifdef __AVX512F__<br/>
static inline void vcompressd(uint32_t *base_ptr, uint32_t &amp;base,<br/>
uint32_t idx, uint64_t bits) {<br/>
base_ptr += base;<br/>
base += hamming(bits);</p>
<p> __m512i indicies = _mm512_add_epi32(_mm512_set1_epi32(idx), _mm512_setr_epi32(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15));<br/>
uint32_t* upper_ptr = base_ptr + _mm_popcnt_u32(bits);</p>
<p> _mm512_mask_compressstoreu_epi32(base_ptr, bits, indicies);<br/>
indicies = _mm512_add_epi32(indicies, _mm512_set1_epi32(16));<br/>
// _mm_popcnt_u32 causes GCC to insert unnecessary MOVSX instructions (Clang not affected), so _mm_popcnt_u64 may be faster there<br/>
base_ptr += _mm_popcnt_u32(bits &amp; 0xffff);<br/>
bits &gt;&gt;= 16;<br/>
_mm512_mask_compressstoreu_epi32(base_ptr, bits, indicies);<br/>
indicies = _mm512_add_epi32(indicies, _mm512_set1_epi32(16));</p>
<p> bits &gt;&gt;= 16;<br/>
_mm512_mask_compressstoreu_epi32(upper_ptr, bits, indicies);<br/>
indicies = _mm512_add_epi32(indicies, _mm512_set1_epi32(16));<br/>
upper_ptr += _mm_popcnt_u32(bits &amp; 0xffff);<br/>
bits &gt;&gt;= 16;<br/>
_mm512_mask_compressstoreu_epi32(upper_ptr, bits, indicies);</p>
<p> //_mm256_zeroupper(); // automatically inserted by compiler; otherwise problematic if inlined and unrolled<br/>
}<br/>
#endif<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-408211" class="comment byuser comment-author-lemire bypostauthor odd alt depth-7">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-22T13:02:28+00:00">May 22, 2019 at 1:02 pm</time></a> </div>
<div class="comment-content">
<p>Thank you.</p>
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
<li id="comment-408191" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5b398936012c5ab568223ef64750d802?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5b398936012c5ab568223ef64750d802?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Samuel Lee</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-22T10:47:55+00:00">May 22, 2019 at 10:47 am</time></a> </div>
<div class="comment-content">
<p>Just stumbled across this &#8211; I&rsquo;ll try and do some experimenting with your code because it is an intriguing problem.</p>
<p>One small observation for targeting Aarch64 would be that given there is neither a count trailing zeros or an unset trailing zero instruction, repeating the construction:</p>
<p><code>base_ptr[X] = static_cast&lt;uint32_t&gt;(idx) + trailingzeroes(bits);<br/>
bits = bits &amp; (bits - 1);<br/>
</code></p>
<p>requires at least 5 data processing instructions:</p>
<p>rbit, clz, add (idx + leading_zero_count), sub (1), and</p>
<p>We probably should instead reverse bits once upfront.<br/>
Then we can explicitly count leading zeroes, and clear the most significant bit with 4 instructions:</p>
<p>clz, add (idx + leading_zero_count), asr (arithmetic shift right int64_t_min by leading_zero_count), bic (clear bits up to an including most significant set bit)</p>
<p>corresponding to C code something like:</p>
<p><code>lz = leadingzeroes(rev_bits);<br/>
base_ptr[X] = static_cast&lt;uint32_t&gt;(idx) + lz;<br/>
rev_bits = rev_bits &amp; ~(int64_t(0x1000000000000000) &gt;&gt; lz);<br/>
</code></p>
<p>Not tested this myself yet.</p>
</div>
<ol class="children">
<li id="comment-408212" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-22T13:02:36+00:00">May 22, 2019 at 1:02 pm</time></a> </div>
<div class="comment-content">
<p>Thank you.</p>
</div>
<ol class="children">
<li id="comment-429872" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-02T17:36:28+00:00">October 2, 2019 at 5:36 pm</time></a> </div>
<div class="comment-content">
<p>Implemented as follows:</p>
<pre><code>void basic_arm_decoder(uint32_t *base_ptr, uint32_t &amp;base, uint32_t idx,
                   uint64_t bits) {
  uint64_t rev_bits;
  __asm volatile ("rbit %0, %1" : "=r" (rev_bits) : "r" (bits) );
  while (rev_bits != 0) {
    int lz = __builtin_clzll(rev_bits);
     base_ptr[base] = static_cast&lt;uint32_t&gt;(idx) + lz;
    rev_bits = rev_bits &amp; ~(int64_t(0x8000000000000000) &gt;&gt; lz);
     base++;
  }
}
</code></pre>
<p>It does save quite a bit of instructions. Whether it is faster is less clear. On at least one ARM server I have, it is actually slower despite the instruction count.</p>
<p>See my code and benchmark at <a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2019/05/03/bitmapdecoding.cpp" rel="nofollow ugc">https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2019/05/03/bitmapdecoding.cpp</a></p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
