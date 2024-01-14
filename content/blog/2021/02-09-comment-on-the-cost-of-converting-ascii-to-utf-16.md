---
date: "2021-02-09 12:00:00"
title: "On the cost of converting ASCII to UTF-16"
index: false
---

[15 thoughts on &ldquo;On the cost of converting ASCII to UTF-16&rdquo;](/lemire/blog/2021/02-09-on-the-cost-of-converting-ascii-to-utf-16)

<ol class="comment-list">
<li id="comment-573872" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">me</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-10T02:43:28+00:00">February 10, 2021 at 2:43 am</time></a> </div>
<div class="comment-content">
<p>Java by now also has ASCII strings stored as bytes. Largely to conserve memory.</p>
</div>
</li>
<li id="comment-573896" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-10T05:13:24+00:00">February 10, 2021 at 5:13 am</time></a> </div>
<div class="comment-content">
<p>A well-optimised memcpy is mostly limited by write throughput on modern architectures and toutf16 has double the write throughput in comparison to read throughput. Although I didn&rsquo;t really dive deep into code, it would seem that compilers eagerly use native vectorised unpack/zero extend instructions on the fastest parts of the compiled function, thus making the conversion itself mostly a triviality. I&rsquo;m not entirely convinced that I&rsquo;d understand why the choice of instructions would be optimal (in particular, compilers don&rsquo;t seem eager to use AVX-512 registers), but write throughput of those functions matches memcpy &#8211; which alone makes me wonder if there&rsquo;s any practical room for improvement for non-small inputs.</p>
</div>
<ol class="children">
<li id="comment-573964" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-10T17:15:43+00:00">February 10, 2021 at 5:15 pm</time></a> </div>
<div class="comment-content">
<p><em>A well-optimised memcpy is mostly limited by write throughput on modern architectures and toutf16 has double the write throughput in comparison to read throughput.</em></p>
<p>That sounds reasonable, yes.</p>
<p><em>which alone makes me wonder if there’s any practical room for improvement for non-small inputs.</em></p>
<p>It is an interesting question.</p>
</div>
</li>
</ol>
</li>
<li id="comment-573901" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Oren Tirosh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-10T05:55:40+00:00">February 10, 2021 at 5:55 am</time></a> </div>
<div class="comment-content">
<p>The overhead is largely in having to perform an additional copy and the larger memory footprint. The conversion during the copying is probably less significant.</p>
</div>
<ol class="children">
<li id="comment-573962" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-10T17:14:17+00:00">February 10, 2021 at 5:14 pm</time></a> </div>
<div class="comment-content">
<p>I agree and I believe that I allude to this fact at the end of the post.</p>
</div>
</li>
</ol>
</li>
<li id="comment-573961" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/693444e5424f08503eb24d00d37271c1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/693444e5424f08503eb24d00d37271c1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mischa Sandberg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-10T17:00:47+00:00">February 10, 2021 at 5:00 pm</time></a> </div>
<div class="comment-content">
<p>At a guess, the larger the block being translated as a unit, the more the bottleneck is at the bus, or ram. I work with such volumes, but broken into many separate units; far less using the same cache line or memory pages. Would you consider comparing single-block translations, with ones having no streaming advantages?</p>
</div>
</li>
<li id="comment-575319" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.joseduarte.com" class="url" rel="ugc external nofollow">José Duarte</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-17T20:41:56+00:00">February 17, 2021 at 8:41 pm</time></a> </div>
<div class="comment-content">
<p>That Apple M1 chip sure is impressive.</p>
<p>Why did you switch compilers? That potentially invalidates your test, since you&rsquo;ve got gcc 8 vs. clang 12, which adds another variable differentiating your two results. If clang 12 is the only compiler that supports the M1 CPU, then just use clang 12 for the Zen 2 as well. (Does a compiler need to support the M1 specifically, or is it fine to just specify Armv8.x?)</p>
<p>The exact AMD CPU model and clock speed would also be helpful. Zen 2 is a whole family of CPUs with different performance.</p>
<p>I&rsquo;m sometimes not clear on the compiler flags you use besides -O3, if any. There are a lot more flags to leverage, many of which aren&rsquo;t included in -O2 or -O3. CPU target is a big one, and I&rsquo;m not clear on how you handle it, like -march=tigerlake or whatever. It&rsquo;s possible that a compiler will use some instructions only when certain CPU minimum targets are specified, and they&rsquo;re not all SIMD instructions. e.g. the Bit Manipulation Instructions, POPCNT, TSX, or the arbitrary precision arithmetic in Broadwell. None of those would likely matter here, but they might in other contexts.</p>
</div>
<ol class="children">
<li id="comment-575325" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-17T20:56:23+00:00">February 17, 2021 at 8:56 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>Why did you switch compilers? That potentially invalidates your test, since you’ve got gcc 8 vs. clang 12, which adds another variable differentiating your two results.</p>
</blockquote>
<p>Apple makes its own compilers for its hardware which are related to LLVM clang, but distinct. My AMD Rome (Zen2) processor runs on a Linux server where GNU GCC is more commonly used.</p>
<blockquote>
<p>If clang 12 is the only compiler that supports the M1 CPU, then just use clang 12 for the Zen 2 as well. (Does a compiler need to support the M1 specifically, or is it fine to just specify Armv8.x?) The exact AMD CPU model and clock speed would also be helpful. Zen 2 is a whole family of CPUs with different performance. I’m sometimes not clear on the compiler flags you use besides -O3, if any. There are a lot more flags to leverage, many of which aren’t included in -O2 or -O3. CPU target is a big one, and I’m not clear on how you handle it, like -march=tigerlake or whatever. It’s possible that a compiler will use some instructions only when certain CPU minimum targets are specified, and they’re not all SIMD instructions. e.g. the Bit Manipulation Instructions, POPCNT, TSX, or the arbitrary precision arithmetic in Broadwell. None of those would likely matter here, but they might in other contexts.</p>
</blockquote>
<p>As is nearly always the code with my blog, <a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2021/02/09" rel="nofollow ugc">I provide the source code along with the build setup that I used</a>, just follow the hyperlinks. It would sure be interesting to investigate all of the points you raise. I invite you to do so!</p>
</div>
</li>
</ol>
</li>
<li id="comment-575377" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://travisdowns.github.io/blog/2019/06/11/speed-limits.html#load-throughput-limit" class="url" rel="ugc external nofollow">Travis Downs</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-17T23:12:05+00:00">February 17, 2021 at 11:12 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m not quite sure about the conclusion. In particular, you &ldquo;measure the throughput based on the input size&rdquo;. So the <code>memcpy</code> variant is writing half the number of bytes (and most architectures including M1 and Zen have lower store vs load throughput in L1D).</p>
<p>Wouldn&rsquo;t it make more sense to base it on the (twice as large) output size if you are trying to make a claim about the cost of computation (ASCII-&gt;UTF-16 expansion) versus the raw copy?</p>
<p>E.g, if you had a system that stored strings in ASCII and processed them in UTF-16, and wanted to compare it to a system that both stored and processed them in UTF-16, from these results you might conclude that the later would be faster since getting the string from storage is &ldquo;just a memcpy and memcpy is ~2x as fast&rdquo; &#8211; but that&rsquo;s not true because your memcpy will be 2x the size compared to what you are doing in this benchmark.</p>
<p>Furthermore, in the case where you are going from UTF-16 to ASCII, you&rsquo;d probably find that the &ldquo;converting&rdquo; case is faster than the non-converting UTF-16-&gt;UTF-16 case (since now half as much data is written).</p>
<p>So I&rsquo;d actually draw a somewhat different conclusion: converting between ASCII and UTF-16 is basically free if it is part of a copy, and speed primarily depends on the size of the written data. So it is feasible to use ASCII in parts of your pipeline even if other parts require UTF-16 <em>if</em> you have a copy that can serve dual-purpose to expand/compress the data.</p>
<p>Of course, just using ASCII everywhere is fastest: smallest working set and no conversion, but I don&rsquo;t think this was in doubt!</p>
</div>
<ol class="children">
<li id="comment-575388" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-17T23:27:24+00:00">February 17, 2021 at 11:27 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p> Wouldn’t it make more sense to base it on the (twice as large) output size if you are trying to make a claim about the cost of computation (ASCII->UTF-16 expansion) versus the raw copy?</p>
</blockquote>
<p>I could have presented it in this manner, yes. And I grant you that it might have made it clearer.</p>
<blockquote>
<p>E.g, if you had a system that stored strings in ASCII and processed them in UTF-16, and wanted to compare it to a system that both stored<br/>
and processed them in UTF-16, from these results you might conclude that the later would be faster</p>
</blockquote>
<p>I am sure that one could think that but it would not be a fair to blame me for it!</p>
<blockquote>
<p>Furthermore, in the case where you are going from UTF-16 to ASCII, you’d probably find that the “converting” case is faster than the non-converting UTF-16->UTF-16 case (since now half as much data is written).</p>
</blockquote>
<p>Which would be consistent with the model submitted in the blog post: &lsquo;With code that reads and writes a lot of data, it is often sensible to use as a model the number of written bytes.&rsquo;.</p>
<blockquote>
<p>(&#8230;) speed primarily depends on the size of the written data (&#8230;)</p>
</blockquote>
<p>Again, the blog post states&#8230; &lsquo;With code that reads and writes a lot of data, it is often sensible to use as a model the number of written bytes.&rsquo;.</p>
</div>
</li>
</ol>
</li>
<li id="comment-575394" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://travisdowns.github.io/blog/2019/06/11/speed-limits.html#load-throughput-limit" class="url" rel="ugc external nofollow">Travis Downs</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-17T23:53:56+00:00">February 17, 2021 at 11:53 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
I am sure that one could think that but it would not be a fair to blame me for it!
</p></blockquote>
<p>Then what <em>is</em> the claim exactly?</p>
<p>Roughly, I understood it as: doing the conversion has a computational cost above and beyond the pure copy.</p>
<p>Now, one can consider two types of &ldquo;pure copies&rdquo; here to compare with the ASCII-&gt;UTF16 conversion: ASCII-&gt;ASCII and UTF16-&gt;UTF16. It&rsquo;s <code>memcpy</code> either way, but the input and output are twice the size in the latter case.</p>
<p>Now, I would interpret your claim as applying to both cases: they should both be faster than the converting case. Otherwise, if it only applies to the ASCII-&gt;ASCII case, the result is entirely obvious: even without considering computation, reading N bytes and writing 2N bytes is going to be slower than reading N and writing N.</p>
<p>Furthermore, in this case you can&rsquo;t really determine whether the faster cost is due to &ldquo;less copying&rdquo; or &ldquo;less computation&rdquo; because it is less in both respects. So I submit that UTF16-&gt;UTF16 copy is the more interesting case, and therefore I am assigning you some faction of the blame (like an insurance adjuster). 🙂</p>
<blockquote><p>
Which would be consistent with the model submitted in the blog post:<br/>
‘With code that reads and writes a lot of data, it is often sensible<br/>
to use as a model the number of written bytes.’.
</p></blockquote>
<p>I think this is what confused me the most. When I originally read it, I took this to mean that you&rsquo;d measure both the expand and <code>memcpy</code> approach using the number of written bytes, i.e., a N-&gt;2N expansion versus a 2N-&gt;2N memcpy, but you actually use input bytes for the measurement (which I picked up on after looking at the code, although you do mention it).</p>
<p>So on what basis do you make the claim &ldquo;the computational cost alone might be twice that of a memory copy&rdquo;? It is quite the opposite: the computational cost appears to be basically zero, with the determining factor related to bytes written. E.g., if you had a weird memcpy that interleaved full vectors (so the number and type of instructions was the same, but it had an output region 2x the size) I&rsquo;d expect it to perform similarly to the expand case (for vectors less than a cache line in size).</p>
</div>
<ol class="children">
<li id="comment-575401" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-18T00:55:33+00:00">February 18, 2021 at 12:55 am</time></a> </div>
<div class="comment-content">
<p>Oops this comment was intended to be nested under <a href="https://lemire.me/blog/2021/02/09/on-the-cost-of-converting-ascii-to-utf-16/#comment-575388">Daniel&rsquo;s reply</a>.</p>
</div>
<ol class="children">
<li id="comment-575402" class="comment byuser comment-author-lemire bypostauthor even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-18T01:00:06+00:00">February 18, 2021 at 1:00 am</time></a> </div>
<div class="comment-content">
<p>The computational cost model is stated as &ldquo;With code that reads and writes a lot of data, it is often sensible to use as a model the number of written bytes.&rdquo;</p>
</div>
<ol class="children">
<li id="comment-575414" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-18T04:33:09+00:00">February 18, 2021 at 4:33 am</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s perhaps I misunderstood the thrust of this post. I thought it was discussing and providing some evidence for the cost of converting between ASCII and UTF-16 (hence the conversion test), compared against the alternative of fewer or no conversions (thus, to an &ldquo;all ASCII&rdquo; or &ldquo;all UTF-16&rdquo; implementation).</p>
<p>Based on your replies, it seems maybe you were rather comparing ASCII vs UTF-16? As in, what is the cost of using UTF-16 rather that ASCII? The conclusion being that UTF-16 is twice as slow under the model that uses the number of bytes written.</p>
<p>Still, I confused by some parts, e.g.:</p>
<blockquote><p>
I expect that it is entirely possible to greatly accelerate my C function.
</p></blockquote>
<p>However, since your results show that the C function is performing at almost exactly the same speed as a memcpy that writes the same number of bytes (slightly <em>better</em> in the Zen case, slightly worse in the M1) case, wouldn&rsquo;t you conclude your C function is running at essentially the speed limit already?</p>
</div>
<ol class="children">
<li id="comment-575521" class="comment byuser comment-author-lemire bypostauthor even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-18T12:48:25+00:00">February 18, 2021 at 12:48 pm</time></a> </div>
<div class="comment-content">
<p>On a 10kB, this code may well be optimal but I have no reason to expect that my hastily written loop will compile to optimal code generally. Maybe it is do, but my investigation was insufficient to draw this conclusion.</p>
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
