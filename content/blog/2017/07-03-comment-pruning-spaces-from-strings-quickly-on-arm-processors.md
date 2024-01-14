---
date: "2017-07-03 12:00:00"
title: "Pruning spaces from strings quickly on ARM processors"
index: false
---

[19 thoughts on &ldquo;Pruning spaces from strings quickly on ARM processors&rdquo;](/lemire/blog/2017/07-03-pruning-spaces-from-strings-quickly-on-arm-processors)

<ol class="comment-list">
<li id="comment-282789" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8fd4a055522ce713cde7dd1cb4083cb2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8fd4a055522ce713cde7dd1cb4083cb2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Martins Mozeiko</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-04T03:56:00+00:00">July 4, 2017 at 3:56 am</time></a> </div>
<div class="comment-content">
<p>Here&rsquo;s branchless NEON version using VTBL1 instriction: <a href="https://gist.github.com/mmozeiko/be2e8afdf5a0a82b7dbdc8f013abfb5f" rel="nofollow ugc">https://gist.github.com/mmozeiko/be2e8afdf5a0a82b7dbdc8f013abfb5f</a></p>
<p>On my Raspberry Pi 3 (AArch64, Cortex-A53) benchmark compiled with clang 4.0.1 shows that this variant is a tiny bit faster than neon_despace:</p>
<p>despace(buffer, N) : 6.81 ns per operation<br/>
neon_despace(buffer, N) : 4.15 ns per operation<br/>
neon_despace_branchless(buffer, N) : 4.09 ns per operation</p>
</div>
<ol class="children">
<li id="comment-282834" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-04T19:47:51+00:00">July 4, 2017 at 7:47 pm</time></a> </div>
<div class="comment-content">
<p>Thanks. Currently, I get the following:</p>
<pre>
despace(buffer, N)                      :  1.40 ns per operation
neon_despace(buffer, N)                 :  1.07 ns per operation
neon_despace_branchless(buffer, N)      :  3.81 ns per operation
</pre>
<p>So it is not great.</p>
</div>
<ol class="children">
<li id="comment-282835" class="comment byuser comment-author-lemire bypostauthor even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-04T19:49:46+00:00">July 4, 2017 at 7:49 pm</time></a> </div>
<div class="comment-content">
<p>Update: This was gcc. If I compile with clang, I get the following:</p>
<pre>
despace(buffer, N)                      :  1.40 ns per operation
neon_despace(buffer, N)                 :  1.04 ns per operation
neon_despace_branchless(buffer, N)      :  1.01 ns per operation
</pre>
<p>I don&rsquo;t think that the difference between 1.04 and 1.01 is actually significant, but it still a nice result.</p>
</div>
<ol class="children">
<li id="comment-282854" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8fd4a055522ce713cde7dd1cb4083cb2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8fd4a055522ce713cde7dd1cb4083cb2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Martins Mozeiko</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-05T01:50:34+00:00">July 5, 2017 at 1:50 am</time></a> </div>
<div class="comment-content">
<p>I updated code to do only one VTBL1 instruction on AArch64 (based on information from Sam&rsquo;s comment).</p>
<p>Now the code is reasonably faster than &ldquo;neon_despace&rdquo; variant:<br/>
despace(buffer, N) : 6.65 ns per operation<br/>
neon_despace(buffer, N) : 4.00 ns per operation<br/>
neon_despace_branchless(buffer, N) : 3.54 ns per operation</p>
</div>
<ol class="children">
<li id="comment-282886" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cyril Lashkevich</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-05T14:47:48+00:00">July 5, 2017 at 2:47 pm</time></a> </div>
<div class="comment-content">
<p>But result is incorrect. The table for vqtblq1 should be calculated in different way.</p>
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
<li id="comment-282797" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/721f64fe2ed2c73ef16d61e15552c532?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/721f64fe2ed2c73ef16d61e15552c532?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://thedetectorist.co.uk" class="url" rel="ugc external nofollow">Alex @ thedetectorist</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-04T07:01:59+00:00">July 4, 2017 at 7:01 am</time></a> </div>
<div class="comment-content">
<p>Wow, impressive work, that&rsquo;s blazing fast even if it&rsquo;s an ARM. How did you figure this out?</p>
</div>
</li>
<li id="comment-282800" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/33bc7f2d39c57d4c5a8b983d04863869?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/33bc7f2d39c57d4c5a8b983d04863869?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.nexs-software.ie" class="url" rel="ugc external nofollow">Bryan O'Donoghue</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-04T09:05:07+00:00">July 4, 2017 at 9:05 am</time></a> </div>
<div class="comment-content">
<p>Interesting post &#8211; and good analysis on the # of cycles.</p>
<p>It would be very interesting to see a power comparison &#8211; after all if a 95w x86 takes 1.2 cycles to process something but a 20w ARM takes 2.4 cycles &#8211; the x86 is eating huge amounts of power to achieve its result.</p>
<p>What would the table look like if we broke it down using the # of cycles and the performance per watt ?</p>
<p>My guess is you&rsquo;d find the ARM beating the x86 significantly.</p>
</div>
<ol class="children">
<li id="comment-282845" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c46f70d81c200662d9e69b4f081fa2da?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c46f70d81c200662d9e69b4f081fa2da?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">matthew</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-04T21:58:43+00:00">July 4, 2017 at 9:58 pm</time></a> </div>
<div class="comment-content">
<p>There are 4.5W Kaby Lake CPUs out there which have SSE4, so I don&rsquo;t think you&rsquo;re going to get much joy by normalising for power.</p>
<p>I think this is just an instance where x86 has an instruction that ARM is missing. It&rsquo;s not really fundamental to the architecture of either CPU.</p>
</div>
</li>
</ol>
</li>
<li id="comment-282810" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cyril Lashkevich</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-04T14:11:58+00:00">July 4, 2017 at 2:11 pm</time></a> </div>
<div class="comment-content">
<p>is_not_zero can be implemented in one instruction on arm64.</p>
<p>static inline uint16_t is_not_zero(uint8x16_t v) {<br/>
return vaddlvq_u8(v);<br/>
}</p>
</div>
<ol class="children">
<li id="comment-282833" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-04T19:44:12+00:00">July 4, 2017 at 7:44 pm</time></a> </div>
<div class="comment-content">
<p>Thanks. It seems that <tt>vaddlvq_u8</tt> might be slower.</p>
</div>
<ol class="children">
<li id="comment-282849" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cyril Lashkevich</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-05T00:11:22+00:00">July 5, 2017 at 12:11 am</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s useful when you need count of 0xff in vector. It&rsquo;s (vaddlvq_u8(v) &gt;&gt; 8) + 1.</p>
</div>
<ol class="children">
<li id="comment-282850" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-05T00:29:53+00:00">July 5, 2017 at 12:29 am</time></a> </div>
<div class="comment-content">
<p>Yes. Important observation.</p>
<p>Wouldn&rsquo;t you prefer <tt>vaddlvq_u8(vorrq_u8(v,vdupq_n_u8(1)))</tt>? It is the same number of instructions and the movi call in a tight loop could get optimized away.</p>
</div>
<ol class="children">
<li id="comment-282884" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cyril Lashkevich</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-05T14:16:01+00:00">July 5, 2017 at 2:16 pm</time></a> </div>
<div class="comment-content">
<p>Depends on context. For example here using vaddlvq_u8 improves performance a bit. <a href="https://gist.github.com/notorca/c731fc6a916849c3be4f4a8f55b3c583" rel="nofollow ugc">https://gist.github.com/notorca/c731fc6a916849c3be4f4a8f55b3c583</a></p>
<p>Cortex A53 (pine64):<br/>
despace(buffer, N) : 3.48 ns per operation<br/>
neon_despace(buffer, N) : 2.11 ns per operation<br/>
neon_despace_branchless(buffer, N) : 2.04 ns per operation<br/>
neon_despace_branchless_my(buffer, N) : 1.83 ns per operation</p>
<p>iPhone SE:<br/>
pointer alignment = 32768 bytes<br/>
memcpy(tmpbuffer,buffer,N) : 0.093 ns per operation</p>
<p>despace(buffer, N) : 0.79 ns per operation<br/>
neon_despace(buffer, N) : 0.64 ns per operation<br/>
neon_despace_branchless(buffer, N) : 0.43 ns per operation<br/>
neon_despace_branchless_my(buffer, N) : 0.40 ns per operation</p>
</div>
<ol class="children">
<li id="comment-282895" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-05T20:32:20+00:00">July 5, 2017 at 8:32 pm</time></a> </div>
<div class="comment-content">
<p>On the processor I am using, vqmovn_u64 (uqxtn) has a latency of 4 and a throughput of 1; meanwhile uaddlv has a latency of 8 (over 8 bit values) and the same throughput. So vqmovn_u64 (uqxtn) is preferable I think.</p>
<p>Most other operations, such as a shift by an immediate (ushr) or a bitwise OR (vorr) has a latency of three. So something like <tt>vaddlvq_u8(vshrq_n_u8(v,7))</tt> ends up having a latency of 8+3= 11 cycles.</p>
</div>
</li>
</ol>
</li>
<li id="comment-282893" class="comment byuser comment-author-lemire bypostauthor even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-05T19:58:22+00:00">July 5, 2017 at 7:58 pm</time></a> </div>
<div class="comment-content">
<p>Or <tt>vaddlvq_u8(vshrq_n_u8(v,7))</tt>?</p>
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
<li id="comment-282827" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5b398936012c5ab568223ef64750d802?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5b398936012c5ab568223ef64750d802?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sam</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-04T18:27:03+00:00">July 4, 2017 at 6:27 pm</time></a> </div>
<div class="comment-content">
<p>Slight correction: In AArch64 the TBL instruction can shuffle 16B at once, this is exposed in the intrinsics with vqtblq.</p>
</div>
<ol class="children">
<li id="comment-282894" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-05T19:59:24+00:00">July 5, 2017 at 7:59 pm</time></a> </div>
<div class="comment-content">
<p>Yes it does, e.g., <tt>vqtbl1q_u8</tt>. My mistake.</p>
</div>
</li>
</ol>
</li>
<li id="comment-282963" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a7168e483cc5eac4b0928204956fc72e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a7168e483cc5eac4b0928204956fc72e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Derek Ledbetter</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-07T21:21:41+00:00">July 7, 2017 at 9:21 pm</time></a> </div>
<div class="comment-content">
<p>Your GitHub code has a mistake. The `vld4q_u8` intrinsic will interleave the words. For instance, the first vector will have characters { 0, 1, 2, 3, 16, 17, 18, 19, 32, 33, 34, 35, 48, 49, 50, 51 }. The correct method is to use `vld1q_u8` four times, incrementing the address by 16 each time.</p>
</div>
<ol class="children">
<li id="comment-282964" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-07T21:23:38+00:00">July 7, 2017 at 9:23 pm</time></a> </div>
<div class="comment-content">
<p>Good catch!</p>
</div>
</li>
</ol>
</li>
</ol>
