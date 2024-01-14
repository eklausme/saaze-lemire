---
date: "2018-10-03 12:00:00"
title: "Quickly parsing eight digits"
index: false
---

[23 thoughts on &ldquo;Quickly parsing eight digits&rdquo;](/lemire/blog/2018/10-03-quickly-parsing-eight-digits)

<ol class="comment-list">
<li id="comment-354008" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Travis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-03T20:15:50+00:00">October 3, 2018 at 8:15 pm</time></a> </div>
<div class="comment-content">
<p>You are still using an intrinsic function in __builtin_bswap64. Probably you could avoid it without any reduction in performance if your compiler has cam recognize some portable code that does a bswap.</p>
<p>I&rsquo;m not just being pedantic here: which are we allowed to use? Those that only operate on GP registers? Those that aren&rsquo;t x86-specifc? Those that are available in the Java Integer class? Some other criteria?</p>
</div>
<ol class="children">
<li id="comment-354014" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-03T20:30:16+00:00">October 3, 2018 at 8:30 pm</time></a> </div>
<div class="comment-content">
<p>I think you are right that one should clearly define the terms. So SWAR implies in my mind that you use general-purpose registers. However, it does say anything about the programming style or the restriction to programming languages. It is possible, in my mind, to have a SWAR algorithm that cannot be implemented in Java or JavaScript.</p>
<p>I should add that SWAR is not intrinsically (pun intended) better than other optimization paradigms. In this case, it is only annoying intellectually that it does not work well. You would think that it should.</p>
<p>I think we both expect optimizing C compilers to recognize a byte swapping pattern and to map it to the appropriate instruction. So from a performance point of view, I don&rsquo;t think I cheated.</p>
<p>I am not sure what the rules of the game have to be. If you look at my code on GitHub, you will notice that even tried AVX instructions! (And, maybe surprisingly, the result are even promising!)</p>
<p>I&rsquo;d be excited by anything that beats the best function I tested.</p>
</div>
<ol class="children">
<li id="comment-354023" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-03T21:24:38+00:00">October 3, 2018 at 9:24 pm</time></a> </div>
<div class="comment-content">
<p>I asked at least partly for a practical reason: I wanted to know if x86-specific GP register intrinsic functions such as pdep are allowed: these are similar in spirit to bswap, although perhaps a but further along the spectrum towards &ldquo;non portable&rdquo;, in that I don&rsquo;t expect any compiler today to recognize pdep and transform it and I&rsquo;m not aware of any other hardware that supports them. Side note: bswap recognition is actually <a href="https://godbolt.org/z/wxw8F2" rel="nofollow">more universal that I would have expected on recent compiler versions</a>. I guess the rules should depend on your motivation. Motivation for SWAR over SIMD specifically varies, but would often include the following scenarios: Targeting a language or runtime which doesn&rsquo;t support SIMD. Targeting hardware that doesn&rsquo;t support SIMD. Scenarios where the SWAR approaches beats SIMD The rules would then depend based on the above. For the first, you just allow what the language allows, so pdep would be out, and bswap would be in or out depending on the language (e.g., Java has it, standard C doesn&rsquo;t, but gcc does, etc). For the two latters cases, presumably &ldquo;anything goes&rdquo;: whatever you can get your language to support is fine, since the restrictions are at the hardware level. Note: I see now you actually wrote &ldquo;<em>Intel</em> intrinsic function&rdquo; so the rule could be to use any of the generic gcc builtins is OK, but not the Intel-specific ones.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-354041" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-04T00:04:17+00:00">October 4, 2018 at 12:04 am</time></a> </div>
<div class="comment-content">
<p>Well I managed shave off 3.2 cycles fairly &ldquo;easily&rdquo;. I just removed the <code>__attribute__((noinline))</code> from the front of the function.</p>
<p>Before that, I got (with gcc-7):</p>
<p><code>gcc-7 -O3 -g2 -o eightchartoi eightchartoi.c -march=haswell -fno-tree-vectorize<br/>
sum_8_digits(text, N) : 8.024 cycles per input byte (best) 8.068 cycles per input byte (avg)<br/>
sum_8_digits_unrolled(text, N) : 7.525 cycles per input byte (best) 7.535 cycles per input byte (avg)<br/>
sum_8_digits_swar(text, N) : 8.013 cycles per input byte (best) 8.160 cycles per input byte (avg)<br/>
sum_8_digits_ssse3(text, N) : 5.139 cycles per input byte (best) 5.171 cycles per input byte (avg)<br/>
sum_8_digits_avx(text, N) : 7.859 cycles per input byte (best) 8.017 cycles per input byte (avg)<br/>
</code></p>
<p>After that, I got:</p>
<p><code>sum_8_digits(text, N) : 2.255 cycles per input byte (best) 2.272 cycles per input byte (avg)<br/>
sum_8_digits_unrolled(text, N) : 2.509 cycles per input byte (best) 2.550 cycles per input byte (avg)<br/>
sum_8_digits_swar(text, N) : 4.836 cycles per input byte (best) 4.857 cycles per input byte (avg)<br/>
sum_8_digits_ssse3(text, N) : 3.080 cycles per input byte (best) 3.089 cycles per input byte (avg)<br/>
sum_8_digits_avx(text, N) : 6.512 cycles per input byte (best) 6.590 cycles per input byte (avg)<br/>
</code></p>
<p>So the _swar approach (assuming that&rsquo;s the one you have been measuring in your past), improved from ~8 cycles to ~4.8 cycles.</p>
<p>Of course, the ssse3 approach (I assume this is MuÅ‚a&rsquo;s function), also improved a lot too, from ~5.1 cycles to ~3.1, so the total ground gained wasn&rsquo;t much, and this is probably not what were asking for!</p>
<p>This is just a roundabout way of raising dual questions: &ldquo;What are you trying to measure?&rdquo; and &ldquo;How are you trying measure it?&rdquo;.</p>
<p>I was surprised to see the <code>((noinline))</code> stuff, which usually hasn&rsquo;t appeared in your benchmarks (as far as I remember). I guess it may have been a reaction to the times of the &ldquo;plain&rdquo; sum_8_digits[_unrolled] calls, which somehow pull in front of all the other guys. In fact, the result is &ldquo;impossibly good&rdquo;, if you assume the native approach needs at least 6 multiplications (7 appear in the code, but perhaps the *10 can be implemented using shift + addition tricks), that&rsquo;s a lower limit of 6 cycles, but it&rsquo;s manages to get somehow to 2.2. Probably the compiler notices that because of the overlapping definition of your measurement loop (you increment the char pointer by 1 not 8), you are performing a lot of redundant calculations, for example chars[7] will be multiplied by 1, 10, 100, 1000, etc on subsequent iterations of the loop. Equivalently, it notices that the result of one iteration i + 1, is the same as iteration i, times 10, plus an adjustment based on the two bytes that are different. That&rsquo;s just one or two multiplications per iteration.</p>
<p>((noinline)) is a big hammer to fix this problem! It influences each approach in a different way &#8211; this is obvious at the extreme for the naive approach which went from loser to winner, but it is true for intermediate approaches as well. For example, noinline will bloat the number of instructions, which will hurt instruction-limited approaches more (due to ROB size and other limitations).</p>
<p>It&rsquo;s not a simple topic, but I think it is very relevant here. Perhaps there are benchmarking methodologies that mostly avoid it (and can avoid other overhead such as the need to do an array read each iteration).</p>
</div>
<ol class="children">
<li id="comment-354043" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-04T00:18:46+00:00">October 4, 2018 at 12:18 am</time></a> </div>
<div class="comment-content">
<p>It seems that I have used noinline 82 times (82 files) in the GitHub repository of this blog&#8230;</p>
<p>I agree that there are downsides to preventing inlining.</p>
</div>
<ol class="children">
<li id="comment-354049" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-04T00:49:05+00:00">October 4, 2018 at 12:49 am</time></a> </div>
<div class="comment-content">
<p>Well as I mentioned, I don&rsquo;t recall having seen it, or at least not in a place that would matter &#8211; but, yes, you have used it many times! Many of those places, however, are duplicates in benchmark.h or in places where it doesn&rsquo;t matter (i.e,. on the function that has a loop inside, rather than on the function that is called from the loop as this case &#8211; divide.c is one exception I found).</p>
<p>By my measurement, even the newest Intel chips only execute a <em>completely empty</em> function at ~4.4 cycles per call, so you are already in the range of the function call &ldquo;overhead&rdquo; for this benchmark (although again, overheads aren&rsquo;t additive: you can often do 4 cycles of &ldquo;work&rdquo; for free in the function call shadow).</p>
<p>I really recommend against using this attribute in the hot loop of a benchmark, except very carefully. Definitely not as a &ldquo;ugh, compiler was smarter than I thought, let me disable inlining&rdquo; thing. You have already done a lot of work outside the benchmark to set up a loop which reads from memory, which should serve the same purpose (although it has its own overhead). If you avoid the overlapping in the loop the problem with the naive loop goes away.</p>
</div>
<ol class="children">
<li id="comment-354053" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-04T01:01:50+00:00">October 4, 2018 at 1:01 am</time></a> </div>
<div class="comment-content">
<p>Fair enough, I have updated the numerical results with inlining. The story does not really change in the sense that vectorization speeds things up, but not SWAR. I find this unsatisfying.</p>
</div>
<ol class="children">
<li id="comment-354060" class="comment odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-04T02:24:24+00:00">October 4, 2018 at 2:24 am</time></a> </div>
<div class="comment-content">
<p>Now I get quite different results than you with gcc-8 (ubuntu 8.1.0). I get:</p>
<p><code>sum_8_digits(text, N) : 3.862 cycles per input byte (best) 3.955 cycles per input byte (avg)<br/>
sum_8_digits_unrolled(text, N) : 4.033 cycles per input byte (best) 4.121 cycles per input byte (avg)<br/>
sum_8_digits_swar(text, N) : 4.217 cycles per input byte (best) 4.293 cycles per input byte (avg)<br/>
sum_8_digits_ssse3(text, N) : 2.955 cycles per input byte (best) 3.072 cycles per input byte (avg)<br/>
sum_8_digits_avx(text, N) : 6.517 cycles per input byte (best) 6.697 cycles per input byte (avg)<br/>
</code></p>
<p>Anyways, the gcc results I get of &lt; 4 cycles and probably the clang results are due to autovectorization. If I disable that with <code>-fno-tree-vectorize</code>, I get:</p>
<p><code>gcc-8 -O3 -g2 -o eightchartoi eightchartoi.c -march=native -fno-tree-vectorize<br/>
sum_8_digits(text, N) : 7.995 cycles per input byte (best) 8.220 cycles per input byte (avg)<br/>
sum_8_digits_unrolled(text, N) : 7.002 cycles per input byte (best) 7.299 cycles per input byte (avg)<br/>
sum_8_digits_swar(text, N) : 4.871 cycles per input byte (best) 4.935 cycles per input byte (avg)<br/>
sum_8_digits_ssse3(text, N) : 2.964 cycles per input byte (best) 3.167 cycles per input byte (avg)<br/>
sum_8_digits_avx(text, N) : 6.538 cycles per input byte (best) 6.825 cycles per input byte (avg)<br/>
</code></p>
<p>Which is a lot closer to your results. Maybe it&rsquo;s -march=native doing different things on different boxes. I get the results for -march=skylake and similar results for -march=haswell. Interestingly, this is the first code where I&rsquo;ve seen a performance difference between -march=haswell and -march=skylake.</p>
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
<li id="comment-354061" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-04T02:27:26+00:00">October 4, 2018 at 2:27 am</time></a> </div>
<div class="comment-content">
<p>Also I noticed the SWAR approach is being vectorized, so it becomes vectorized SWAR&#8230; which explains the 4.8 vs 4.2 cycles for SWAR above.</p>
</div>
</li>
<li id="comment-354342" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-05T03:45:47+00:00">October 5, 2018 at 3:45 am</time></a> </div>
<div class="comment-content">
<p>I never really answered question the question of &ldquo;why is SWAR worse (here)?&rdquo;</p>
<p>There are several of reasons why SWAR (at least with the existing algorithm) is not as good as SIMD for this problem. Some are kind of instrinsic to most/many SWAR algorithms, and some are more specific to this particular algorithm.</p>
<p>In general with SWAR stuff, to avoid carries and other &ldquo;bits&rdquo; from interfering across your SWAR elements, you often need a bunch of extra operations. In your algorithm these manifest mostly as the shift and mask operations you need at each step. If SIMD has built-in support for your element size, as x86 does here, then you don&rsquo;t need those there.</p>
<p>On a similar note, SIMD often has useful swizzle/shuffle/permute ops which might combine several scalar operations into one when heavy lifting is needed.</p>
<p>To verify this you can just count the ALU ops in the SSSE3 and SWAR algorithms. Both have 3 multiplication ops which do the heavy lifting, but the SIMD algorithm only has 2 additional ALU ops as part of the algorithm: for the initial subtract, and one &ldquo;pack&rdquo; operation to get things into place for the final multiply. You don&rsquo;t even need any shuffling between the first and second operation because MuÅ‚a was able to use different types of multiplication to get the desired operations directly.</p>
<p>On the other hand, the SWAR approach needs 7 extra ALU ops: 5 for the shift and mask ops, one for the initial subtract and one BSWAP (which counts double on Intel).</p>
<p>The SIMD algorithm does need an op the SWAR version doesn&rsquo;t: the final <code>_mm_cvtsi128_si32</code> call to move the result from SIMD register to GP one. One may argue that this isn&rsquo;t inherent in the algorithm: perhaps you wanted your result in a GP reg, but even if we count it, things aren&rsquo;t looking good at 7 vs 3 for SWAR vs SIMD. If we check the disassembly it reflect this, with 3 more operations for SWAR in the main loop than the SIMD version (we expected 4 but the compiler combined the load and bswap into movbe &#8211; but this doesn&rsquo;t actually speed things up, movbe counts as 3 ops in practice).</p>
<p>This is pretty typical of SWAR algorithms since you need to avoid adjacent elements from interfering. In certain cases you get lucky though and no interference is possible, or it can be counteracted cheaply &#8211; then SWAR really shines!</p>
<p>Another reason, relevant to your original results (and also still relevant since the text is kind of still talking about the case where the SWAR algorithm was barely better than the naive one and far from SIMD), is kind of weird and subtle.</p>
<p>Without inlining, the amount of code is significantly increased in the SWAR case since it needs to load those large 64-bit constants each time the function is called. Check out the assembly:</p>
<p><code>0000000000400910 &lt;parse_eight_digits_swar&gt;:<br/>
400910: movbe rax,QWORD PTR [rdi]<br/>
400915: movabs rdx,0xcfcfcfcfcfcfcfd0<br/>
40091f: add rax,rdx<br/>
400922: imul rax,rax,0x10a<br/>
400929: shr rax,0x8<br/>
40092d: movabs rdx,0xff00ff00ff00ff<br/>
400937: and rax,rdx<br/>
40093a: imul rax,rax,0x10064<br/>
400941: shr rax,0x10<br/>
400945: movabs rdx,0xffff0000ffff<br/>
40094f: and rax,rdx<br/>
400952: movabs rdx,0x100002710<br/>
40095c: imul rax,rdx<br/>
400960: shr rax,0x20<br/>
400964: ret<br/>
</code></p>
<p>Notice the disassembly: four copies of movabs with a big 64-bit constant: 3 for the mask constants and one for the final multiplication constant which exceeded 32 bits.</p>
<p>These instructions aren&rsquo;t super expensive, but they aren&rsquo;t super cheap either, and they take 9 bytes each so you may even have some front-end effects here (depending on how the uop cache handles these large constants). Note that this is only a problem with values that don&rsquo;t fit in a 32-bit signed value! For 32-bit constants, they can usually be included directly in the instruction that uses them as an immediate. The other two multiplications don&rsquo;t need this extra movabs because the constant fits in 32-bits.</p>
<p>This is actually interesting because we usually never thing of constants costing anything when we write code, after all they are &ldquo;calculated for free at compile time, right&rdquo;? Well they do often cost something, and on more RISCy platforms they often cost more (since support for immediates is usually much less or non-existent). This means that if you can tweak your algorithm to use smaller constants, or to use the same constant rather than different ones, you can get a speed up.</p>
<p>So what happens here in the SIMD case? After all, their constants are even bigger! Well as it turns out, this is also interesting. In general, compilers prefer to &ldquo;inline&rdquo; constants into the code, as shown above, but in SIMD-land there is no real way to specify any types of constants in the code (of course you can use special idioms to get things like &ldquo;all zeros&rdquo; or &ldquo;all ones). So the compiler will generally load the constant from a read-only copy of the constant in the .rodata section.</p>
<p>So the SSSE3 version is loading 3 x 16 = 48 bytes of constants from memory every time the function is called. Sounds bad, right? Well in general use it might not be great because you could suffer a length cache miss, but in a benchmark everything stays hot so loading constants this way may actually be better because (a) the compiler can often fold the constant load into an ALU op as a memory operand, making it &ldquo;free in the fused domain&rdquo; (b) these algorithms are all competing for ALU ports, but these loads happen on the load ports, an underutilized resource, whereas movabs needs an ALU port.</p>
<p>So let&rsquo;s look at the assembly. gcc isn&rsquo;t actually much of a fan of folding the constant loads into the ALU ops &#8211; it only does it once (the <code>vpaddb</code>):</p>
<p><code>0000000000400a00 &lt;parse_eight_digits_ssse3&gt;:<br/>
400a00: vmovq xmm0,QWORD PTR [rdi]<br/>
400a04: vpaddb xmm0,xmm0,XMMWORD PTR [rip+0x1c04] # 402610 &lt;__PRETTY_FUNCTION__.33289+0x10&gt;<br/>
400a0c: vmovdqa xmm1,XMMWORD PTR [rip+0x1c0c] # 402620 &lt;__PRETTY_FUNCTION__.33289+0x20&gt;<br/>
400a14: vpmaddubsw xmm0,xmm0,xmm1<br/>
400a19: vmovdqa xmm1,XMMWORD PTR [rip+0x1c0f] # 402630 &lt;__PRETTY_FUNCTION__.33289+0x30&gt;<br/>
400a21: vpmaddwd xmm0,xmm0,xmm1<br/>
400a25: vpackusdw xmm0,xmm0,xmm0<br/>
400a2a: vmovdqa xmm1,XMMWORD PTR [rip+0x1c0e] # 402640 &lt;__PRETTY_FUNCTION__.33289+0x40&gt;<br/>
400a32: vpmaddwd xmm0,xmm0,xmm1<br/>
400a36: vmovd eax,xmm0<br/>
400a3a: ret<br/>
</code></p>
<p>&#8230; but clang 5 is certainly good at it, it does it for all four:</p>
<p><code>0000000000400910 &lt;parse_eight_digits_ssse3&gt;:<br/>
400910: vmovq xmm0,QWORD PTR [rdi]<br/>
400914: vpaddb xmm0,xmm0,XMMWORD PTR [rip+0x1b44] # 402460 &lt;_IO_stdin_used+0x20&gt;<br/>
40091c: vpmaddubsw xmm0,xmm0,XMMWORD PTR [rip+0x1b4b] # 402470 &lt;_IO_stdin_used+0x30&gt;<br/>
400925: vpmaddwd xmm0,xmm0,XMMWORD PTR [rip+0x1b53] # 402480 &lt;_IO_stdin_used+0x40&gt;<br/>
40092d: vpackusdw xmm0,xmm0,xmm0<br/>
400932: vpmaddwd xmm0,xmm0,XMMWORD PTR [rip+0x1b56] # 402490 &lt;_IO_stdin_used+0x50&gt;<br/>
40093a: vmovd eax,xmm0<br/>
40093e: ret<br/>
</code></p>
<p>So in the case of clang, the function is half as long as the SWAR version!</p>
<p>If you enabling inlining, these constants can be hoisted out of the loop, so this disadvantage largely goes away.</p>
<p>Neither necessarily better reflects real-world use better: the function will not always be called in a loop, and register pressure might not allow hoisting, but since <em>this</em> benchmark is testing a loop, I think it makes sense to allow inlining and avoid this problem.</p>
<p>When you allow inlining, the results are more favorable for SWAR: I get about 5 cycles for SWAR versus 3 for SIMD and 7 for naive (unrolled), so SWAR is squarely in the middle.</p>
<p>One of the things that slows SWAR down is the bswap, but you don&rsquo;t need it: you can do the same reduction with a slightly different multiplier and skip the BSWAP:</p>
<p><code>uint32_t<br/>
parse_eight_digits_swar2(const unsigned char *chars) {<br/>
uint64_t val;<br/>
memcpy(&amp;val, chars, 8);<br/>
val = val - 0x3030303030303030;<br/>
uint64_t byte10plus = ((val * (1 + (0xa &lt;&lt; 8))) &gt;&gt; 8) &amp; 0x00FF00FF00FF00FF;<br/>
uint64_t short100plus = ((byte10plus * (1 + (0x64 &lt;&lt; 16))) &gt;&gt; 16) &amp; 0x0000FFFF0000FFFF;<br/>
short100plus *= (1 + (10000ULL &lt;&lt; 32));<br/>
return short100plus &gt;&gt; 32;<br/>
}<br/>
</code></p>
<p>This shaves about a cycle off of the timings (yeah, bswap sucks &#8211; its probably worse than a multiply here), so you can say that SWAR is 75% of the way to the SIMD solution (about 3 vs 4 cycles, vs 7 for the unrolled naive).</p>
<p>I tried a few things to reduce it further, but not much success: this version might be a bit faster (save one or two ops), but in practice the compiler wasn&rsquo;t smart enough to see the optimizations I had in mind so it generally ended up tied:</p>
<p><code>uint32_t<br/>
parse_eight_digits_swar3(const unsigned char *chars) {<br/>
uint64_t val;<br/>
memcpy(&amp;val, chars, 8);<br/>
// val = __builtin_bswap64(val); // because we are under little endian<br/>
val = val - 0x3030303030303030;<br/>
uint64_t byte10plus = ((val * (1 + (0xa &lt;&lt; 8))) &gt;&gt; 8) &amp; 0x00FF00FF00FF00FF;<br/>
uint64_t short100plus = (byte10plus * (1 + (0x64 &lt;&lt; 16)));<br/>
uint32_t bottom = short100plus &gt;&gt; 48;<br/>
uint32_t top = ((uint32_t)short100plus) &gt;&gt; 16;<br/>
return top * 10000u + bottom;<br/>
}<br/>
</code></p>
<p>You can shave another 0.5 cycles off with -funroll-loops, although SIMD gains about 0.3 cycles so the gap narrows only a bit (and not at all in a relative sense). I guess you could squeeze maybe another half cycle out down to 3 cycles with some hand written assembly or a bit more fiddling. That would be the hard lower limit for any algorithm with 3 multiplications, however, since they execute at best one per cycle.</p>
<p>To break the 3 cycle barrier you&rsquo;d have to get rid of one multiplication at least. In principle you can do it easily for the first multiplication, which is small enough to be done with some lea and add instructions, but the IPC of this code is already high (around 3) so this might slow things down. In fact I did try this and it did slow things down, but it is not entirely clear why.</p>
<p>The fact that IPC is still about 3 (slightly less even) means there is in principle room to make it a bit faster, since there is no carried dependency chain making it theoretically perfectly parallel. However, I think a problem is the long dependency chains which make it hard to schedule optimally. By my calculation, the latency of one iteration is about 18 cycles, and 13 instructions. So that&rsquo;s an IPC of 0.72 if one iteration at a time is executed: so to get to 3 IPC you need 4 iterations in parallel at least. That already means a lot of lookahead (but it <em>should be</em> well-within the capabilities of Skylake), but then the CPU isn&rsquo;t always scheduling optimally (e.g., it might sometimes schedule adds or shifts only port 1 which should be reserved just for multiplies&#8230;</p>
</div>
</li>
<li id="comment-354419" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-05T14:52:32+00:00">October 5, 2018 at 2:52 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for the thorough and insightful analysis.</p>
<blockquote>
<p>This is actually interesting because we usually never thing of constants costing anything when we write code, after all they are â€œcalculated for free at compile time, rightâ€? Well they do often cost something, and on more RISCy platforms they often cost more (since support for immediates is usually much less or non-existent). This means that if you can tweak your algorithm to use smaller constants, or to use the same constant rather than different ones, you can get a speed up.</p>
</blockquote>
<p>Are we sure that loading the constants is a bottleneck in this case?</p>
<p>As for RISCy platforms&#8230; though it is true that an ARM processor cannot load an arbitrary constant into a register in one instruction, my understanding that is that this is compensated by the fact that ARM processors can fuse successive load instructions so that the difference between, say, x64 and ARM, is much less significant than it appears in this respect. And, of course, ARM processors can load constants from memory in one instruction just like x64.</p>
<p>I must admit that I do not have a lot of experience with ARM processors, but I never encountered a case where x64 had an advantage over ARM because of the need to load the constants.</p>
</div>
</li>
<li id="comment-354440" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-05T16:56:41+00:00">October 5, 2018 at 4:56 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
Are we sure that loading the constants is a bottleneck in this case?
</p></blockquote>
<p>I suspected that it was, given that there is no big obvious bottleneck: just a lot of ALU instructions. So I went ahead and tested it: I just changed the constants so that they fit in 32 bits which gets rid of the movabs, but otherwise leaves the algorithm the same (of course now giving wrong answers for most inputs). The time drops from 7 cycles to 6 cycles. The entire difference between not inlining and inlining was 7 and 5 cycles, so we can say roughly half of the effect can be attributed this constant issue.</p>
<blockquote><p>
As for RISCy platformsâ€¦ though it is true that an ARM processor cannot<br/>
load an arbitrary constant into a register in one instruction, my<br/>
understanding that is that this is compensated by the fact that ARM<br/>
processors can fuse successive load instructions so that the<br/>
difference between, say, x64 and ARM, is much less significant than it<br/>
appears in this respect.
</p></blockquote>
<p>I think you are talking about needing to split constants into two 16-bit halves or something like that? Yes, that&rsquo;s another issue for fixed size instruction sets that I hadn&rsquo;t even thought about, although fusion, if implemented, can partly mitigate it as you point out.</p>
<p>I was actually talking about immediates here: if the instruction itself can accept an immediate, then the cost of &ldquo;loading&rdquo; the constant may truly be zero. x86 supports up to 32-bit immediates on most ALU instructions which is much more than typical RISC. Most RISCs due have some immediate support (often geared towards efficient constant loading), but I think it&rsquo;s reasonable to say that it would rarely be as extensive as the immediate support in x86.</p>
<blockquote><p>
And, of course, ARM processors can load constants from memory in one<br/>
instruction just like x64.
</p></blockquote>
<p>Yes, but as shown, x86 can and do load constants from memory in &ldquo;zero&rdquo; instructions since they have memory-source instructions &#8211; and this is one of the things that is usually listed as a difference between CISC and RISC.</p>
</div>
<ol class="children">
<li id="comment-354449" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-05T18:00:21+00:00">October 5, 2018 at 6:00 pm</time></a> </div>
<div class="comment-content">
<p>I have not tried to compile the above code on an ARM processor, but I would like to push back a little. I submit to you that for the examples we are considering now, there might be relatively little difference between ARM and x86 at least as far as instruction counts go. I would expect x86 to use fewer instructions, it often does, but I don&rsquo;t expect that it will be a deciding factor in the performance. (I am talking about 64-bit ARM, obviously.)</p>
<blockquote>
<p>I was actually talking about immediates here: if the instruction itself can accept an immediate, then the cost of â€œloadingâ€ the constant may truly be zero. x86 supports up to 32-bit immediates on most ALU instructions which is much more than typical RISC.</p>
</blockquote>
<p>Can you qualify the &ldquo;much more&rdquo; part? I am pretty sure that AArch64 has 24-bit immediates&#8230; which is less than x86, but maybe not &ldquo;much less&rdquo;.</p>
<p>My uneducated guess is that whatever performance difference there is between brand-new x86 processors and brand-new 64-bit processors is not down to the ISA. (There are obvious cases where the ISA makes a world of difference, but let us consider general purpose computing.)</p>
<p>I stress that I don&rsquo;t consider myself an expert on the ARM-vs-x86 topic.</p>
<blockquote>
<p>half of the effect can be attributed this constant issue.</p>
</blockquote>
<p>That&rsquo;s interesting.</p>
<p>In actual code, the function is likely always inlined so maybe you have better chances of having the constants preloaded even if you rarely call the function?</p>
</div>
</li>
</ol>
</li>
<li id="comment-354463" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-05T19:12:24+00:00">October 5, 2018 at 7:12 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
I have not tried to compile the above code on an ARM processor, but I<br/>
would like to push back a little. I submit to you that for the<br/>
examples we are considering now, there might be relatively little<br/>
difference between ARM and x86 at least as far as instruction counts<br/>
go.
</p></blockquote>
<p>Sure, I don&rsquo;t think I said otherwise. It is entirely possible that ARM is shorter as it often is due to three-register instructions and some other advantages.</p>
<p>I don&rsquo;t think ARM will actually use more than one instruction to load a 64-bit constant: it will probably just load it with one instruction from memory (constant pool or whatever they call it).</p>
<p>Remember, this is all a relatively artificial case we are talking about: where inlining was turned off using a special function attribute. This tends to emphasize things like &ldquo;constant loading&rdquo; that don&rsquo;t matter as much when full optimization is allowed, since they get hoisted out as the inlined code and timing results show.</p>
<p>Also, I&rsquo;m not trying to make any argument in favor of x86 over ARM or any other RISC instruction set. I&rsquo;ll be clear: x86-64 is a pretty poor design instruction set for the needs of a modern CPU, especially smaller cores. I&rsquo;m not assigning blame: this is clearly path-dependent and the design is from another era. New instruction sets like ARM64 are much superior.</p>
<p>Things like complex variable length instruction and large and variable-length immediate have a fairly heavy cost: but once you have paid that cost one should acknowledge at least that some cases are (relatively) more efficient because of it.</p>
<p>The idea that x86 has rich immediate support compared for most RISCs is, I think, totally uncontroversial. Whether it is a good idea is another thing entirely. We can even guess that Intel doesn&rsquo;t think it&rsquo;s a good idea: it has dropped immediate support on most of the few GP instructions it has added over the last decade (BMI1, BMI2 mostly), in favor of 3-register inputs. They kept memory source though!</p>
<blockquote><p>
Can you qualify the â€œmuch moreâ€ part? I am pretty sure that AArch64<br/>
has 24-bit immediatesâ€¦ which is less than x86, but maybe not â€œmuch<br/>
lessâ€.
</p></blockquote>
<p>I mean that it offers immediate versions of almost all general purpose ALU instructions (it seems like ARM also offers it for many, although it far from universal on RISCs in general) and even on things like store instructions. All immediate values can be up to 32-bits (sign extended) can be represented. In 32-bit code this means &ldquo;all immediates&rdquo; can be represented. As far as I know ARM generally uses 12-bit immediates. Note that I&rsquo;m mostly talking about immediates which are part of an ALU instruction. Yes, RISCs often have a special &ldquo;load immediate&rdquo; instruction for the purpose of loading constants, which uses a larger immediate, but then of course you are using extra instruction(s).</p>
<p>It also offers lea, which allows you to use the immediate offset support in the address encoding (also up to 32 bits) in a 3-operand addition.</p>
<p>So for original i386 I think you can say that that x86 supports any immediate you&rsquo;d want. In x86-64 this largess wasn&rsquo;t extended all the way to 64-bit immediates so the story is a bit more mixed (as we see with the movabs appearing here). In fact, ARM has <a href="https://dinfuehr.github.io/blog/encoding-of-immediate-values-on-aarch64/" rel="nofollow">special immediate encoding</a> for the bitwise ops, which still allocates fewer bits (only 13) than x86, but I think in a much more useful way: allow kind of &ldquo;broadcast&rdquo; immediates up to 64-bits, useful when there is a repeating pattern, just like your SWAR code. So probably ARM would do a better job on the mask values here, needing no constant load! While ARM is a member of the RISC family, this of course is not a typical RISC feature.</p>
<blockquote><p>
My uneducated guess is that whatever performance difference there is<br/>
between brand-new x86 processors and brand-new 64-bit processors is<br/>
not down to the ISA. (There are obvious cases where the ISA makes a<br/>
world of difference, but let us consider general purpose computing.)
</p></blockquote>
<p>My view is I think fairly conventional: the instruction set makes some difference. x86 is (today) a relatively poor instruction set so x86 pay some penalties for that. The penalties are not always simply in terms of performance: it may be in terms of engineering or validation effort, power usage, transistor count. So what may be a performance penalty in a simple design might be a removed in a more complicated design, at the expense of that complication.</p>
<p>You can see a lot of evidence of this in big x86 designs: things like the uop cache, micro-fusion, complex flag renaming/merging, stack engine, big investments in instruction decoders, large number of decode pipeline stages are largely a consequence of the ISA. Large CPUs have a massive overabundance of transistors &ldquo;per core&rdquo;, which have strongly diminishing returns in terms of single-threaded performance, so in some ways adding all of these things don&rsquo;t cost too much today in terms of power/performance, unit cost/performance metrics.</p>
<p>This was not true in the past, where there many good places to use more transistors and everyone knew about them, which I think is partly why there was a period where RISC designs were really able to use those to good effect to achieve superior performance.</p>
<p>For small cores, this effect is still largely there: x86 is a very poor choice for small cores, embedded cores, &ldquo;soft&rdquo; cores, sea-of-cores, etc. You just don&rsquo;t want to pay the x86 tax there.</p>
<p>You can find some formal treatment on the size of the x86 tax which IIRC is basically consistent with this idea.</p>
<p>About performance difference between new CPUs, I think it&rsquo;s largely a function of the engineering time, budget and skill (maybe skill and budget are the same thing in the end). It would be interesting to draw the curve for creating a brand new CPU from scratch: for budget vs achieved performance, for different ISAs.</p>
<p>For say RISCV vs x86, the curve would be stuck at zero until some fairly large amount because you&rsquo;d couldn&rsquo;t make a functional x86 CPU with its thousands of instructions and complex behaviors without a large effort. Then the curve would rise slowly since you need to get a lot of things right to get reasonably performance and the &ldquo;minimum viable implementation&rdquo; is likely to be very slow e.g., using lots of micro-coding and multiple instructions per cycle.</p>
<p>RISCV would come off of zero much earlier and rise much more quickly.</p>
<p>At some point, in the 10s or 100s of millions, the curves would start to converge, I think. I don&rsquo;t know if they would ever cross.</p>
<p>The ISA memory model is another cross cutting concern that can have a deep impact on performance, and has similar interesting &ldquo;budget vs performance&rdquo;, &ldquo;size vs performance&rdquo;, etc curves but this is long enough I think :).</p>
<blockquote><p>
In actual code, the function is likely always inlined so maybe you<br/>
have better chances of having the constants preloaded even if you<br/>
rarely call the function?
</p></blockquote>
<p>Hmm, I don&rsquo;t think so unless I misunderstand what you are saying. It would be better to say &ldquo;hoisted&rdquo; instead of &ldquo;preloaded&rdquo; &#8211; we are talking about scenarios where the compiler can recognize that a function is called multiple times <em>within a small region of code</em> and hence dedicates registers to hold the constants. Inlining is necessary but not sufficient: it just lets the compiler see re-use within a large scope and so gives it the chance to hoist. Registers are a precious resource and the way the ABI works means you aren&rsquo;t going to be able to do this except in a loop or when there are nearby calls and not much register pressure.</p>
<p>If a call is made not often, and from separated places in the code, the compiler isn&rsquo;t going to be able to do this. Anyways, it shouldn&rsquo;t because if a function is called &ldquo;not often&rdquo; who cares about 1 cycle more or less?</p>
<p>This also raises another point: I said that in real code the function will be inlined and the constants hoisted: but there is a limit even for loops and close-by-calls: each constant needs a register so if you have too many or the rest of the code needs more registers, this won&rsquo;t work. A good compromise would be to load the constant as-needed as a memory source operand but compilers rarely seem to do this.</p>
</div>
</li>
<li id="comment-354656" class="comment byuser comment-author-lemire bypostauthor even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-06T13:46:20+00:00">October 6, 2018 at 1:46 pm</time></a> </div>
<div class="comment-content">
<p>When looking for evidence of the x86 tax at kind of processors we now care about&#8230; in smartphones and up&#8230; it seems that the evidence is lacking and that the ISA is not important.</p>
<p>E.g.,</p>
<p><a href="https://www.extremetech.com/extreme/188396-the-final-isa-showdown-is-arm-x86-or-mips-intrinsically-more-power-efficient/3" rel="nofollow ugc">https://www.extremetech.com/extreme/188396-the-final-isa-showdown-is-arm-x86-or-mips-intrinsically-more-power-efficient/3</a></p>
</div>
<ol class="children">
<li id="comment-354687" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-06T18:01:25+00:00">October 6, 2018 at 6:01 pm</time></a> </div>
<div class="comment-content">
<p>What kind of evidence would you accept? I&rsquo;m quite sure any engineer at Intel even would tell you there is an inherent x86 tax.</p>
</div>
<ol class="children">
<li id="comment-354773" class="comment byuser comment-author-lemire bypostauthor even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-07T02:54:58+00:00">October 7, 2018 at 2:54 am</time></a> </div>
<div class="comment-content">
<p>We have high ranking Intel employees stating that the x86 tax is a myth. We have highly cited serious-looking research papers saying that the ISA differences are insignificant as far as power usage are concerned</p>
<p><a href="https://ieeexplore.ieee.org/abstract/document/6522302" rel="nofollow ugc">https://ieeexplore.ieee.org/abstract/document/6522302</a></p>
<p>I am well aware of the claims regarding the greater efficiency of RISC designs like ARM&#8230; but that there are credible contrary claims.</p>
</div>
<ol class="children">
<li id="comment-354788" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-07T04:16:41+00:00">October 7, 2018 at 4:16 am</time></a> </div>
<div class="comment-content">
<p>There are two different things here: I&rsquo;m not making any type of general RISC vs CISC argument: that is largely over, and the curve of optimal design points takes ideas from both camps. Many of the driving factors back in the heydey of that discussion simply don&rsquo;t exist any more.</p>
<p>I&rsquo;m just saying that the x86 design specifically is very suboptimal to what you&rsquo;d design if you were doing it again from scratch. They have maintained backwards compatibility to the 8086 or whatever, and the opcode space has been squeezed to the limit. Decoding is extremely complicated and requires something like <em>five</em> pipeline stages on x86. Two entire stages alone for figuring out where instructions begin and end!</p>
<p>So some super-human effort has been put into the effort to reduce the performance impact of the x86 tax &#8211; it&rsquo;s <em>still</em> a tax though: even if it is spread across metrics other than pure performance, like engineering effort and cost, transistor count, power use, the potential for bugs (see the LSD which had to be disabled on all Skylakes because it didn&rsquo;t work right due to obscure interactions between obscure x86 features).</p>
<p>I don&rsquo;t think you can conclude anything about the x86 tax from that paper. The primary conclusion should better be stated as &ldquo;micro-architecture is important&rdquo;. I find it curious they thought they could suss out the difference ISAs make by comparing wildly different implementations, by different companies with engineering budgets probably varying by an order of magnitude, aimed at different markets, running at different frequencies on different physical processes, with different compiler backends and optimizations, etc.</p>
<p>Most of the detailed stuff is fine, but then to somehow claim that this shows some that ISA differences are unimportant is borderline dishonest. If they say &ldquo;chips with different ISAs fall into the same performance ballpark&rdquo; I&rsquo;d simply agree!</p>
<p>We should be clear about the order of the effect we are talking about here: the x86 instruction set is quite sub-optimal, but that doesn&rsquo;t mean it&rsquo;s going to run at half the speed or something. I&rsquo;m pretty sure the effect is larger than 1%, but less than 20% (on performance). For example, decoding performance is rarely a bottleneck on modern Intel CPUs, so the tax is mostly due to second-order effects such as longer pipelines (slower flushes due to mispredicts, etc), larger I-cache use due to larger instructions, etc.</p>
<p>The effect was larger in the past where decoding the complex x86 instruction set was in fact a large bottleneck for lots of code.</p>
<p>Unless they were willing to lie to your face, or uninformed, I think even an Intel employee would tell you, in private, that there is an x86 tax but that it can be &ldquo;largely&rdquo; overcome through engineering, which is where we are today.</p>
</div>
<ol class="children">
<li id="comment-355145" class="comment byuser comment-author-lemire bypostauthor even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-08T15:11:54+00:00">October 8, 2018 at 3:11 pm</time></a> </div>
<div class="comment-content">
<p>Let us try to be precise. Here is the gist of their statement:</p>
<blockquote><p>Beyond micro-op translation, x86 ISA introduces no overheads over ARM ISA</p></blockquote>
<p>So you disagree with that, correct?</p>
<p>So, to be clear, they do agree that there is an overhead or &ldquo;x86 tax&rdquo;. They even state it openly:</p>
<blockquote><p>Considering very low performance processors, like the RISC ATmega324PA microcontroller (&#8230;) the overheads of a CISC ISA (specifically the complete x86 ISA) are clearly untenable. </p></blockquote>
<p>But then they follow with&#8230;</p>
<blockquote><p>Our study suggests that at performance levels in the range of A8 and higher, RISC/CISC is irrelevant for performance, power, and energy.</p></blockquote>
<p>To put it in clear terms, they are saying that there is an overhead, but it is a fixed overhead. For large cores, this overhead becomes negligible.</p>
<p>If I understand what you are saying is that this is wrong and the overhead if fixed in relative terms (say ~5%). Whether we have 100 million transitors or 100 billion transistors per core, the x86 overhead remains fixed as a percentage, say 5%. Is that correct?</p>
<p>Full paper:</p>
<p><a href="https://research.cs.wisc.edu/vertical/papers/2013/hpca13-isa-power-struggles.pdf" rel="nofollow ugc">https://research.cs.wisc.edu/vertical/papers/2013/hpca13-isa-power-struggles.pdf</a></p>
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
<li id="comment-355230" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-08T21:28:14+00:00">October 8, 2018 at 9:28 pm</time></a> </div>
<div class="comment-content">
<p>FWIW, I had read the paper (at least a deep skim) before my prior reply, so that reply was already in the context of the conclusions and the &ldquo;evidence&rdquo; in the full paper.</p>
<blockquote>
<blockquote><p>
Beyond micro-op translation, x86 ISA introduces no overheads over ARM ISA
</p></blockquote>
<p> So you disagree with that, correct?
</p></blockquote>
<p>I can more or less agree with that statement, although I&rsquo;d rather say &ldquo;very small overhead&rdquo; rather than &ldquo;no overheads&rdquo; which too absolute. It could certainly be that the performance overhead is negligible&rdquo; after micro-translation. After all, translation is the hard part!</p>
<p>So it&rsquo;s a bit like saying that it&rsquo;s just as cheap to live in Vancouver as Montreal, &ldquo;if you ignore the cost of housing&rdquo; or something like that.</p>
<p>More to the point, while I happen to mostly to agree with this statement &#8211; <em>the paper doens&rsquo;t show this at all</em>. I really don&rsquo;t know how they draw this conclusion. Let&rsquo;s say that their testing methodology was flawless and all the results are reproducible as presented. You&rsquo;ve basically benchmarked some chip against another one and I guess they cam out &ldquo;roughly equal&rdquo;. How the hell can you then claim that you learned something about some small part of a chip&rsquo;s performance (&ldquo;that the ISAs impose no overhead&rdquo;) where there is a laundry list of differences between the chips?</p>
<p>I could pick <em>any</em> feature that varies between them and simply claim &ldquo;feature X makes no difference&rdquo;, right? I could pick different sets of chips where there is a difference, and then claim the opposite, that feature X is useful? If had done the same benchmarks a couple of years before that, when ARM chips were generally further behind x86, you would &#8211; my the logic of these authors, conclude that the x86 is magic fairy dust that provides a huge boost in performance.</p>
<p>Similarly, if you wrote this paper today with something like the A12 as the representative on the ARM side, which by many accounts is competitive with the newest Intel Xeon CPUs in single-threaded performance &#8211; yet runs in a <em>phone</em>, you&rsquo;d probably conclude that the ARM ISA confers a huge advantage. Of course, all of conclusions are based on some faulty logic: chip performance varies for a huge variety of reasons and for &ldquo;big cores&rdquo; the ISA isn&rsquo;t near the top.</p>
<p>I understand the motivation here: positioning the paper as some kind of conclusion to the heated RISC vs CISC wars probably makes it a lot more interesting than &ldquo;we simulated and benchmarked some ARM and x86 chips and they fell into the same ballpark&rdquo;. Still, I think I might print out a copy of this one and put it in my bathroom in case I run out of toilet paper one day :).</p>
<blockquote><p>
To put it in clear terms, they are saying that there is an overhead,<br/>
but it is a fixed overhead. For large cores, this overhead becomes<br/>
negligible.</p>
<p> If I understand what you are saying is that this is wrong and the<br/>
overhead if fixed in relative terms (say ~5%). Whether we have 100<br/>
million transitors or 100 billion transistors per core, the x86<br/>
overhead remains fixed as a percentage, say 5%. Is that correct?
</p></blockquote>
<p>Well that&rsquo;s not too far off what I said above: there is an overhead, but the bigger your chip gets the more options you have for solutions which reduce the performance impact (perhaps at the cost of other metrics such as engineering cost, power, etc).</p>
<p>The cost is not &ldquo;fixed&rdquo; though, at least for reasonable definitions of the term. Chip design is a complex multi-dimensional problem. Let&rsquo;s consider at least the factors: (1) performance (2) power (3) chip size (roughly, transistor count) (4) design and validation cost.</p>
<p>One solution that modern x86 chips take to the decoding of the instruction stream is &ldquo;brute force&rdquo; &#8211; assume that an instruction might start at <em>any byte</em> within some window (16 bytes on most chips, 20 bytes on a few), and start decoding simultaneously at all positions, and then figure out the actual boundaries scanning forwards quickly from the last known boundary. This process is called &ldquo;pre-decoding&rdquo; and just finds the instruction lengths: you haven&rsquo;t even done the actual decoding yet.</p>
<p>Doing all this parallel work, within a small time budget (2 cycles on modern Intel) clearly has a significant size cost, so below some threshold, it is not viable at all: but the total size is likely small on a modern chip since this approach was adopted several uarches ago.</p>
<p>As far as performance goes, it probably scales more or less as other components do with frequency: if you keep the FO4 or whatever of your pipeline the same, it should keep working from generation to generation. If you want to make the chip wider, it is hard, because you need to increase the instructions you decode in parallel. You&rsquo;ll find people this is &ldquo;exponential complexity&rdquo; and is what blocks x86 from going wider, but I don&rsquo;t agree: it looks to be to be linear complexity in the number of instructions you want to decode, plus the critical path (the find boundary finding step) takes time proportional to the parallelism, so there is a tradeoff there (e.g., you might need 3 cycles if you want to decode 24 bytes instead of 16, or some other trick to make it faster).</p>
<p>Instruction decoding has long been a bottleneck in Intel processors, and this is absolutely due to the ISA. You can go through Agner&rsquo;s documents and see how many generations of Intel processors were often bottlenecked on &ldquo;the front end&rdquo;, and all the rules you had to follow to give decoding a fighting chance to keep up with the rest of the core. This bottleneck has finally been partly removed in recent CPUs, especially with the introduction of the uop cache. It&rsquo;s not free to have a uop cache though: it costs power and space on the die, it has its own hiccups from time to time, it costs a cycle to switch between the uop cache and the legacy decoders.</p>
<p>A lot of code takes good advantage of the uop cache, with high hit rates, but the uop cache has only ~1500 entries (and you can probably only use 2/3 of that), so a lot of code has moderate or low hit rates.</p>
<p>Going back to &ldquo;fixed or not&rdquo; let us consider code that goes through the legacy decoders. Lets say that x86 decoding adds 3 cycles to the pipeline length &#8211; which seems reasonable to me: end-to-end decoding takes about 4 cycles on modern Intel, and I expect it to take 1 on many modern ISAs. So the long pipeline hurts you when you take branch mispredictions and other types of mispredictions and in a couple of other less important cases. This cost is &ldquo;relative&rdquo; in that it hurts you roughly the same % even as your chip gets bigger and bigger. In fact it hurts you more as your chip gets wider, which often corresponds to bigger (but all current Intel mainstream chips have the same width). The cost may shrink as you branch prediction gets better however (again, all current Intel mainstream chips of the same generation use the same branch predictor). Let&rsquo;s arbitrarily say the last two sentences roughly cancel out, and even if their effects are fairly muted.</p>
<p>A few cycles added to the pipeline isn&rsquo;t all that terrible. It depends on the code you&rsquo;re running, but you&rsquo;re almost certainly talking a low single-digit percentage performance-wise. This effect however, sticks around across chip sizes, it is not &ldquo;fixed&rdquo; in the sense that it goes to zero as the chip gets bigger (at least not at the size of chips we have today). However, smaller chips maybe couldn&rsquo;t afford a 1500-entry uop cache at all.</p>
<p>Consider also that something complex like a uop cache that integrates with all the other moving parts and things like self-modifying cost probably has a large engineering cost. Maybe &ldquo;engineer cost&rdquo; isn&rsquo;t officially part of the optimization problem in this discussion: but even if we don&rsquo;t count it explicitly, it has an indirect cost: the features that would have been implemented if resources weren&rsquo;t diverted to a uop cache (and there are many other things on this list).</p>
<p>Going back to a thought experiment I mentioned earlier, I think a reasonable way to look at it is to hold most factors constant (or perhaps to slide one in a proportional way to the non-fixed one, e.g., allow sliding both transistor count and power), and then vary some input cost, like power or chip size, and imagine what the best possible x86 design would be versus a &ldquo;not x86&rdquo; which could be ARM or just a cleaned up version of x86, etc.</p>
<p>As I mentioned, I think at the low end the gap would be &ldquo;infinite&rdquo; since below some level of complexity you can&rsquo;t even implement the full x86 instruction set with its 2000+ instructions. At some fairly low level of complexity the cost of most the &ldquo;almost totally unused&rdquo; instructions becomes &ldquo;kind of fixed&rdquo;: once you have some microcoded path to handle all of them, the cost is sort of fixed and becomes relatively smaller as you keep sliding your x-axis metric higher.</p>
<p>However: even though the implementation complexity is fixed, there can be a vestigial impacts: the extra pipelines stages were an example above, but consider the instruction encoding: the less efficient instruction encoding whose basic opcode map dates 40 years and has since been stretched to the limit has a &ldquo;permanent&rdquo; impact on L1 hit rates, competition for the L2 and anything else where instruction size matters. That doesn&rsquo;t go to zero as the chip goes to zero, it is more or less a constant impact.</p>
<p>You can see the instruction size effect clearly: the big benefit of variable length ISAs is supposed to be their size benefit, and the more variable, the more entropy you can squeeze out. However, x86 is often barely smaller than fixed 4-byte ISAs, and it&rsquo;s getting worse as more SIMD is used which has to use the remaining scraps of the opcode map and hence several prefix bytes. If you compare against something &ldquo;lightly variable&rdquo; but still fast to decode like Thumb(2) the latter usually ends up considerably smaller.</p>
</div>
<ol class="children">
<li id="comment-355241" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-08T22:04:59+00:00">October 8, 2018 at 10:04 pm</time></a> </div>
<div class="comment-content">
<p>Lots of good points, Travis.</p>
</div>
</li>
<li id="comment-355250" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-08T22:37:05+00:00">October 8, 2018 at 10:37 pm</time></a> </div>
<div class="comment-content">
<p>There are a lot of typos there: usually I try to at least half-proof-read the posts, but this one was getting long so I just fired it off (which is also kind of why it ends abruptly). I hope the reader is able to read past them, but if argument there really doesn&rsquo;t make sense then &#8230; it&rsquo;s a typo :).</p>
<p>One more thing: there was a chance to clean this all up, years ago when AMD introduced the x86-64 instruction set. With years of hindsight and totally different process constraints compared to the the &ldquo;dawn of CMOS&rdquo; they could really at least changed the encoding scheme to make the instruction set a lot more compact, extensible and sane to encode. I think the high level state of the art in chip design and the target software ecosystem hasn&rsquo;t changed much since then, so a good design then would likely still be a good design then.</p>
<p>In particular, the chip always knows if its running in 32-bit or 64-bit or some other mode, so there is no &ldquo;software&rdquo; reason the x86-64 encoding couldn&rsquo;t be very different than x86-i386. If you wanted, you could still keep all the obscure unused instructions, but just shunt them off to some corner of the opcode map with a long encoding. Although one could reasonably argue that you could simply drop them (in fact, AMD did drop a few, like <a href="https://www.felixcloutier.com/x86/AAM.html" rel="nofollow">AAM</a> and <a href="https://www.felixcloutier.com/x86/AAD.html" rel="nofollow">AAD</a>) since there is no &ldquo;backwards compatibility&rdquo; issue and compilers aren&rsquo;t generating those weird instructions anyways.</p>
<p>However, they didn&rsquo;t. The opcodes and encoding scheme are largely unchanged, except approximately the minimal tweak necessary to carve out space for the REX-prefix. So, for example, you are stuck paying an extra byte for any instruction that wants to use any of the 8 new registers, or 64-bit registers, even though the true cost should be closer to 2 bits and 1 bit respectively.</p>
<p>Although I find it disappointing that&rsquo;s how the &ldquo;last chance&rdquo; to fix x86 turned out, I don&rsquo;t really blame AMD. They were releasing 64-bit support as the underdog, on chips that would have compete against Intel pretty much entirely on their 32-bit performance, and this was in the era where decoding was often still a big bottleneck. So a big stretch change like x86-64 was probably only possible if it didn&rsquo;t compromise 32-bit performance, and yet still performed well itself (if it was much slower than 32-bit, it would never get off the ground).</p>
<p>Probably the easiest way to do that was to share the decoding circuitry between 32-bit and 64-bit code. This would be easiest if the encodings didn&rsquo;t diverge radically: you pretty much only need to handle the REX-prefix differently. So that&rsquo;s what AMD did, and I guess it worked, because x86-64 crushed Itanium, a fresh design from the incumbent 10x their size. So whatever they did, it worked &#8211; but that doesn&rsquo;t mean we still can&rsquo;t shed a tear for what x86-64 could have been &#8211; in particular since today having split legacy decode paths for 32 and 64 bits probably wouldn&rsquo;t cost too much, and 32-bit code is increasingly rare.</p>
<p>Just to repeat, even though one might convincing argue that the way x86 encoding works is a big mess, my claim is still only that it costs you 1% to 20% on big chips (that&rsquo;s a range of uncertainty, not &ldquo;it costs you 20% on some big chips). It is not the end of the world. On the other hand, we&rsquo;ve seen barely single digit IPC gains on uarch in the last decade or so (Skylake, Skylake+, Skylake++, etc) &#8211; so a few % is looking pretty good in relative terms!</p>
</div>
</li>
</ol>
</li>
<li id="comment-635948" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c25018143b48222eb7661fc1c60abfff?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c25018143b48222eb7661fc1c60abfff?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://frachtenberg.org/eitan/pubs" class="url" rel="ugc external nofollow">Eitan Frachtenberg</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-06-08T02:58:27+00:00">June 8, 2022 at 2:58 am</time></a> </div>
<div class="comment-content">
<p>Another handy instruction that can help in number parsing is &ldquo;pext&rdquo;. I implemented a quick-and-dirty 8-digit conversion on top of you github benchmark, and the results on my 5950x (gcc-11) are competitive with all but swar and sse3:</p>
<p>sum_8_digits(text, N) : 2.948 cycles per input byte (best) 2.961 cycles per input byte (avg)<br/>
sum_8_digits_unrolled(text, N) : 2.826 cycles per input byte (best) 2.836 cycles per input byte (avg)<br/>
sum_8_digits_swar(text, N) : 1.785 cycles per input byte (best) 1.789 cycles per input byte (avg)<br/>
sum_8_digits_swarc(text, N) : 2.069 cycles per input byte (best) 2.073 cycles per input byte (avg)<br/>
sum_8_digits_ssse3(text, N) : 1.202 cycles per input byte (best) 1.211 cycles per input byte (avg)<br/>
sum_8_digits_avx(text, N) : 2.304 cycles per input byte (best) 2.311 cycles per input byte (avg)<br/>
sum_8_digits_pext(text, N) : 1.897 cycles per input byte (best) 1.927 cycles per input byte (avg) </p>
<p>The basic idea is use pext to compact the 8-byte string into a 4-byte number, eliminating the 0 bytes that precede each digit. Then, split these 4 bytes into a top and bottom 2-digit pairs and find their decimal representation in a lookup table:</p>
<p><code><br/>
uint32_t compact_8char_str(const char* str)<br/>
{<br/>
return _pext_u64(*(const uint64_t*)(str), 0x0F0F0F0F0F0F0F0F);<br/>
}</p>
<p>uint16_t *glut;</p>
<p>void init_lut()<br/>
{<br/>
const int TABLE_SIZE = 0x9FFF;<br/>
glut = (uint16_t *)malloc(sizeof(uint16_t) * TABLE_SIZE);<br/>
char str[9];<br/>
for (unsigned i = 0; i &gt; 16];<br/>
uint32_t top = glut[(uint16_t)condensed];<br/>
return top * 10000 + bottom;<br/>
}</p>
<p></code></p>
<p>Although the pext approach is slower than sse3, it&rsquo;s more general, because it can more easily port to different string sizes. In the original code challenge I copied this from (<a href="https://github.com/eitanf/micropt" rel="nofollow ugc">http://github.com/eitanf/micropt</a>), pext produces the fastest conversion of 3/4/5-digit strings.</p>
</div>
</li>
</ol>
