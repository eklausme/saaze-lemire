---
date: "2020-12-13 12:00:00"
title: "ARM MacBook vs Intel MacBook: a SIMD benchmark"
index: false
---

[43 thoughts on &ldquo;ARM MacBook vs Intel MacBook: a SIMD benchmark&rdquo;](/lemire/blog/2020/12-13-arm-macbook-vs-intel-macbook-a-simd-benchmark)

<ol class="comment-list">
<li id="comment-561871" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3c291fad6afd235e336cf663aeaae83b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3c291fad6afd235e336cf663aeaae83b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Kiru</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T18:33:32+00:00">December 13, 2020 at 6:33 pm</time></a> </div>
<div class="comment-content">
<p>Typo: I am excited because I think it will drive other laptop <strong>makes</strong> to rethink their designs.</p>
</div>
<ol class="children">
<li id="comment-561989" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e7b2b732d7942d2899ff0f3c59ad5f09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e7b2b732d7942d2899ff0f3c59ad5f09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Bert</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-14T03:33:12+00:00">December 14, 2020 at 3:33 am</time></a> </div>
<div class="comment-content">
<p>This is true, whether you are an x86 loyalist or indifferent, the old assumptions are all being turned on their heads. I think we will see even more progress from AMD and Intel now that Apple is here to shake up the rankings.</p>
</div>
</li>
</ol>
</li>
<li id="comment-561879" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/987d19ba91e586f9cbfe5a36319184c7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/987d19ba91e586f9cbfe5a36319184c7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bob</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T19:07:03+00:00">December 13, 2020 at 7:07 pm</time></a> </div>
<div class="comment-content">
<p>I wonder when we will see laptops supporting ARM SVE (NEON successor)</p>
<p><a href="https://community.arm.com/developer/tools-software/hpc/b/hpc-blog/posts/technology-update-the-scalable-vector-extension-sve-for-the-armv8-a-architecture" rel="nofollow ugc">https://community.arm.com/developer/tools-software/hpc/b/hpc-blog/posts/technology-update-the-scalable-vector-extension-sve-for-the-armv8-a-architecture</a></p>
</div>
</li>
<li id="comment-561881" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f8f7c20086c74d1aeb7b88a35a8042c7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f8f7c20086c74d1aeb7b88a35a8042c7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">RAD</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T19:11:39+00:00">December 13, 2020 at 7:11 pm</time></a> </div>
<div class="comment-content">
<p>Are you familiar with <a href="https://developer.arm.com/tools-and-software/server-and-hpc/compile/arm-instruction-emulator/resources/tutorials/sve/sve-vs-sve2/introduction-to-sve2" rel="nofollow ugc">Arm SVE2</a>, Daniel? Are these SIMD instructions only available on Neoverse server cores like Amazon&rsquo;s Graviton?</p>
</div>
<ol class="children">
<li id="comment-561884" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T19:17:41+00:00">December 13, 2020 at 7:17 pm</time></a> </div>
<div class="comment-content">
<p>I do not think that SVE, let alone SVE2, is publicly available.</p>
</div>
<ol class="children">
<li id="comment-561904" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c53d81245d85989dd6aa2018a2278fd5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c53d81245d85989dd6aa2018a2278fd5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Joe Zbiciak</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T20:26:59+00:00">December 13, 2020 at 8:26 pm</time></a> </div>
<div class="comment-content">
<p>AFAIK, SVE is currently available on the Fugaku supercomputer. However, you can&rsquo;t exactly get one at NewEgg.</p>
<p>According to the <a href="https://www.servethehome.com/arm-neoverse-v1-and-n2-roadmap-update/" rel="nofollow ugc">roadmap published here,</a> it appears the Neoverse-V1 and Neoverse-N2 will be the first two designs from ARM itself to sport SVE.</p>
<p><a href="https://www.anandtech.com/show/16073/arm-announces-neoverse-v1-n2" rel="nofollow ugc">This article from AnandTech corroborates what I just said</a></p>
<p>SVE2 doesn&rsquo;t explicitly show up on any of those public roadmap slides, so it&rsquo;s probably a couple years out—at least in cores designed by ARM. Although, as AnandTech points out, &ldquo;SVE&rdquo; in the slide may actually refer to SVE2 in some cases.</p>
<p>ARM first disclosed SVE several years ago, but is only just now starting to make SVE-capable cores. I wouldn&rsquo;t be surprised if we had to wait another few years to buy an end product that offers SVE2.</p>
<p>Even though the Neoverse-V1 is &ldquo;available now,&rdquo; that doesn&rsquo;t mean I can go buy a machine sporting one. It means silicon vendors can license and start building chips around it. It&rsquo;ll be some time before you see volume product.</p>
<p>Why such slow adoption? Wide SIMD in the CPU just wasn&rsquo;t that important to cell phones. It&rsquo;s too power hungry, and it was hard to keep the ARM CPUs fed. Dedicated accelerators were a better fit in that product space, particularly from an energy efficiency standpoint.</p>
<p>In a workstation or server, you have different set of constraints. And, now we have some decent interconnects.</p>
<p>Challenges remain: it&rsquo;s one thing to plop down the functional units for these wide vectors. Managing power—both peak and transient—is another kettle of fish.</p>
</div>
<ol class="children">
<li id="comment-561959" class="comment even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bf3762847dd9a49b850e10a5064be409?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bf3762847dd9a49b850e10a5064be409?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">never_released</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-14T00:25:46+00:00">December 14, 2020 at 12:25 am</time></a> </div>
<div class="comment-content">
<p>Neoverse-V1 is ARMv8.4-A + 2x 256-bit SVE. (and was finished this year)<br/>
Neoverse-N2 is ARMv8.5-A + 2x 128-bit SVE2. (and will be in finished form next year)</p>
<p>Of course, that means finished on Arm&rsquo;s side, that means that we should expect Neoverse-V1 designs in 2021 and Neoverse-N2 designs in 2022.</p>
</div>
<ol class="children">
<li id="comment-561960" class="comment byuser comment-author-lemire bypostauthor odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-14T00:27:35+00:00">December 14, 2020 at 12:27 am</time></a> </div>
<div class="comment-content">
<p>That is great news.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-561912" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f8f7c20086c74d1aeb7b88a35a8042c7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f8f7c20086c74d1aeb7b88a35a8042c7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">RAD</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T20:47:25+00:00">December 13, 2020 at 8:47 pm</time></a> </div>
<div class="comment-content">
<p>It looks like there is compiler and emulator support for SVE/SVE2 but the only available silicon is the <a href="https://indico.math.cnrs.fr/event/4705/attachments/2362/2939/Arm_in_HPC.pdf#page=9" rel="nofollow ugc">Fujitsu A64FX (pdf)</a> with SVE.</p>
<p>You have identified an area that Apple/Amazon Arm64 silicon is playing catchup to x64 on both desktop and server: vectorized SIMD algorithms.</p>
</div>
<ol class="children">
<li id="comment-561975" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maynard Handley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-14T01:43:52+00:00">December 14, 2020 at 1:43 am</time></a> </div>
<div class="comment-content">
<p>Calling this catchup is misleading. SVE/2 is not just wider NEON, it is a rethinking of how to design a vector ISA a for much better compiler auto-vectorization (A very rough figure of merit is 128-bit wide SVE would run a “broad suite” of autovectorized code about 1.3x faster than NEON).<br/>
If we want to use these sorts of terms, leapfrogging would be more appropriate.</p>
</div>
<ol class="children">
<li id="comment-561980" class="comment byuser comment-author-lemire bypostauthor even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-14T01:55:28+00:00">December 14, 2020 at 1:55 am</time></a> </div>
<div class="comment-content">
<p>I think you misunderstand RAD&rsquo;s comment.</p>
<p>My feeling is that he was basing his statement on my (erroneous) earlier results.</p>
<p>I think that there is wide agreement that SVE is exciting new tech.</p>
</div>
</li>
<li id="comment-561995" class="comment odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/733e76b06db1b99819e6d0c05f784e02?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/733e76b06db1b99819e6d0c05f784e02?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">RAD</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-14T05:10:35+00:00">December 14, 2020 at 5:10 am</time></a> </div>
<div class="comment-content">
<p>SVE2 looks great but we are not going to see it in mainstream silicon until the next generation of Apple and Amazon chips at best. In every other area, the Apple M1 and Amazon Graviton 2 seem to offer the best bang-for-the-buck over x64. Until Neoverse V1/N2 silicon is available, I don&rsquo;t think we will see a business case for a scale-up in-memory column store like SAP HANA moving away from Intel.</p>
<p>Benchmarks using Daniel&rsquo;s EWAH and/or Roaring Bitmap projects should be able to approximate when Arm ports make sense. We need more real-world SIMD-centric benchmarks; maybe Lucene/ElasticSearch, Apache Arrow, DuckDB, ClickHouse?</p>
</div>
<ol class="children">
<li id="comment-567575" class="comment even depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6778237a282639b865e21f88d94abad9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6778237a282639b865e21f88d94abad9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://git.io/hyrise" class="url" rel="ugc external nofollow">Martin</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-15T20:39:31+00:00">January 15, 2021 at 8:39 pm</time></a> </div>
<div class="comment-content">
<p>A somewhat comparable system to DuckDB ist Hyrise. We just compared the performance of the M1 chip. It&rsquo;s impressive&#8230;</p>
<p><a href="https://twitter.com/hyrise_db/status/1350179043375804420" rel="nofollow ugc">https://twitter.com/hyrise_db/status/1350179043375804420</a></p>
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
<li id="comment-561895" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e132f271acff992740db55161c7120b4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e132f271acff992740db55161c7120b4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Rosetta</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T19:52:23+00:00">December 13, 2020 at 7:52 pm</time></a> </div>
<div class="comment-content">
<p>Check this comment: <a href="https://news.ycombinator.com/item?id=25409535" rel="nofollow ugc">https://news.ycombinator.com/item?id=25409535</a></p>
</div>
</li>
<li id="comment-561901" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/56d62b02d66d8ea14c5cce3408f3233b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/56d62b02d66d8ea14c5cce3408f3233b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">hn</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T20:10:22+00:00">December 13, 2020 at 8:10 pm</time></a> </div>
<div class="comment-content">
<p><a href="https://news.ycombinator.com/item?id=25409535" rel="nofollow ugc">https://news.ycombinator.com/item?id=25409535</a></p>
<blockquote><p>
&ldquo;This article has a mistake. I actually ran the benchmark, and it doesn&rsquo;t return a valid result on arm64 at all. The posted numbers match mine if I run it under Rosetta. Perhaps the author has been running their entire terminal in Rosetta and forgot.&rdquo;
</p></blockquote>
</div>
</li>
<li id="comment-561906" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1ebbe5376a96ea3229037e2763ec3c25?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1ebbe5376a96ea3229037e2763ec3c25?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jan Wassenberg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T20:33:14+00:00">December 13, 2020 at 8:33 pm</time></a> </div>
<div class="comment-content">
<p>It seems that <a href="https://www.fujitsu.com/global/products/computing/servers/supercomputer/" rel="nofollow ugc">A64FX is now being sold</a>, but not sure how feasible that is.</p>
</div>
</li>
<li id="comment-561911" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bbfea58059452e31d5e3a5f5766d4ba9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bbfea58059452e31d5e3a5f5766d4ba9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Vadim Lebedev</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T20:44:28+00:00">December 13, 2020 at 8:44 pm</time></a> </div>
<div class="comment-content">
<p>Given the fact the NVIDIA is buying ARM there is no negligible chance<br/>
that they change licensing policies&#8230;<br/>
However may the idea of successful ARM laptops will push somebody to try the same stint with MIPS.<br/>
This could be an extremely interesting development.</p>
</div>
</li>
<li id="comment-561916" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3b93c8471f584d466a4005bf32cf02c5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3b93c8471f584d466a4005bf32cf02c5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Veedrac</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T20:50:31+00:00">December 13, 2020 at 8:50 pm</time></a> </div>
<div class="comment-content">
<p>You should read the HN comments to this post, which claim you made an error generating these numbers, and the correct values for M1 are 6.6 GB/s and 16.5 GB/s.</p>
<p><a href="https://news.ycombinator.com/item?id=25408853" rel="nofollow ugc">https://news.ycombinator.com/item?id=25408853</a></p>
<p>I have not personally verified, but that sounds more in line with what the hardware can do.</p>
</div>
<ol class="children">
<li id="comment-561965" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-14T00:57:34+00:00">December 14, 2020 at 12:57 am</time></a> </div>
<div class="comment-content">
<p>Veedrac: they were correct. I made a mistake.</p>
</div>
</li>
</ol>
</li>
<li id="comment-561917" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5f06c7bd53b0c9f8bb41aac9ee7a8794?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5f06c7bd53b0c9f8bb41aac9ee7a8794?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://news.ycombinator.com/item?id=25408853" class="url" rel="ugc external nofollow">Glenn Jahnke</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T20:57:07+00:00">December 13, 2020 at 8:57 pm</time></a> </div>
<div class="comment-content">
<p>Some people over on Hacker News seem to think you ran your test with Rosetta on, the x86 emulation mode. Also the library seems to have difficulty properly detecting ARM. When these couple things were corrected, the benchmarks are pretty different.</p>
<p>Otherwise, a thoughtful benchmark!</p>
<p><a href="https://news.ycombinator.com/item?id=25408853" rel="nofollow ugc">https://news.ycombinator.com/item?id=25408853</a></p>
</div>
<ol class="children">
<li id="comment-561964" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-14T00:57:14+00:00">December 14, 2020 at 12:57 am</time></a> </div>
<div class="comment-content">
<p>Glenn: yes. They are correct. I made a mistake. The blog post has been updated.</p>
</div>
</li>
</ol>
</li>
<li id="comment-561919" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Kurz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T21:02:47+00:00">December 13, 2020 at 9:02 pm</time></a> </div>
<div class="comment-content">
<p>I know you don&rsquo;t usually read it, and I don&rsquo;t know why they didn&rsquo;t leave a comment here, but there are a few comments on HN that suggest you might have significant bug in your benchmark: <a href="https://news.ycombinator.com/item?id=25408853" rel="nofollow ugc">https://news.ycombinator.com/item?id=25408853</a>.</p>
<p>The summary would seem to be that ARM64 isn&rsquo;t being properly detected by the macros in the simdjson code, resulting in the executable using the &ldquo;generic fallback implementation&rdquo;. The simple fix is to add an explicit &ldquo;-DSIMDJSON_IMPLEMENTATION_ARM64=1&rdquo; to the compilation. With this, one of the commenters got &ldquo;minify&rdquo; at 6.64796 GB/s, and &ldquo;validate&rdquo; at 16.4721 GB/s, concluding &ldquo;That puts Intel at 1.17x and 1.15x for this specific test&rdquo;.</p>
</div>
<ol class="children">
<li id="comment-561932" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c14b6de086ac7275f80828a1a37fbaad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c14b6de086ac7275f80828a1a37fbaad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Carl</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T22:28:20+00:00">December 13, 2020 at 10:28 pm</time></a> </div>
<div class="comment-content">
<p>I believe that the big issue noted in the HN thread is that the Arm benchmarks appear to be using x86 code running under Rosetta. With real ARM64 code and more optimisation this gets the benchmarks to minify : 6.73381 GB/s and validate: 17.8548 GB/s so 1.16x and 1.06x.</p>
</div>
<ol class="children">
<li id="comment-561963" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-14T00:56:30+00:00">December 14, 2020 at 12:56 am</time></a> </div>
<div class="comment-content">
<p>That is correct. I mistakenly ran the M1 benchmarks under Rosetta 2. It is incredibly transparent&#8230;</p>
</div>
</li>
</ol>
</li>
<li id="comment-561933" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T22:28:55+00:00">December 13, 2020 at 10:28 pm</time></a> </div>
<div class="comment-content">
<p>Thanks Nate. I don&rsquo;t follow hacker news, but the mistake was pointed out to me on Twitter.</p>
<p>I have revised the blog post. I was wrong.</p>
<p>I am happy to admit it.</p>
</div>
<ol class="children">
<li id="comment-561979" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Kurz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-14T01:48:37+00:00">December 14, 2020 at 1:48 am</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,</p>
<p>I see now that you got lots of notification besides me. Sorry for adding to the pile. To partially make up for it, I ran your benchmark on a MacBook Air with Ice Lake for a more direct comparison:</p>
<p><code>% sysctl -n machdep.cpu.brand_string<br/>
Intel(R) Core(TM) i5-1030NG7 CPU @ 1.10GHz<br/>
% ./benchmark<br/>
simdjson v0.7.0<br/>
Detected the best implementation for your machine: haswell (Intel/AMD AVX2)<br/>
loading twitter.json<br/>
minify : 7.47081 GB/s<br/>
validate: 34.4244 GB/s<br/>
</code></p>
<p>I was hoping that we might be able to see the effect of AVX512, but I see now that the simdjson code doesn&rsquo;t yet support it. If you happen to an unreleased version that has it, I&rsquo;d be happy to test and report.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-561920" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6ab979b3fce5d9bad392044172743ef?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6ab979b3fce5d9bad392044172743ef?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sam</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T21:03:19+00:00">December 13, 2020 at 9:03 pm</time></a> </div>
<div class="comment-content">
<p>Comment from HN you might be interested in:</p>
<p>This article has a mistake. I actually ran the benchmark, and it doesn&rsquo;t return a valid result on arm64 at all. The posted numbers match mine if I run it under Rosetta. Perhaps the author has been running their entire terminal in Rosetta and forgot.<br/>
As I write this comment, the article&rsquo;s numbers are: (minify: 4.5 GB/s, validate: 5.4 GB/s). These almost exactly match my numbers under Rosetta (M1 Air, no system load):<br/>
% rm -f benchmark &amp;&amp; make &amp;&amp; file benchmark &amp;&amp; ./benchmark<br/>
c++ -O3 -o benchmark benchmark.cpp simdjson.cpp -std=c++11<br/>
benchmark: Mach-O 64-bit executable arm64<br/>
minify : 1.02483 GB/s<br/>
validate: inf GB/s</p>
<p><code>% rm -f benchmark &amp;&amp; arch -x86_64 make &amp;&amp; file benchmark &amp;&amp; ./benchmark<br/>
c++ -O3 -o benchmark benchmark.cpp simdjson.cpp -std=c++11<br/>
benchmark: Mach-O 64-bit executable x86_64<br/>
minify : 4.44489 GB/s<br/>
validate: 5.3981 GB/s<br/>
</code></p>
<p>Maybe this article is a testament to Rosetta instead, which is churning out numbers reasonable enough you don&rsquo;t suspect it&rsquo;s running under an emulator.</p>
<p>Update, I re-ran with messe&rsquo;s fix (from downthread):</p>
<p><code>% rm -f benchmark &amp;&amp; make &amp;&amp; file benchmark &amp;&amp; ./benchmark<br/>
c++ -O3 -o benchmark benchmark.cpp simdjson.cpp -std=c++11 -DSIMDJSON_IMPLEMENTATION_ARM64=1<br/>
benchmark: Mach-O 64-bit executable arm64<br/>
minify : 6.64796 GB/s<br/>
validate: 16.4721 GB/s<br/>
</code></p>
<p>That puts Intel at 1.17x and 1.15x for this specific test, not the 1.8x and 3.5x claimed in the article.</p>
<p>Also I looked at the generated NEON for validateUtf8 and it doesn&rsquo;t look very well interleaved for four execution units at a glance. I bet there&rsquo;s still M1 perf on the table here.</p>
<p><a href="https://news.ycombinator.com/user?id=bacon_blood" rel="nofollow ugc">https://news.ycombinator.com/user?id=bacon_blood</a></p>
</div>
</li>
<li id="comment-561921" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/495993a985b04e43ee93db28d7686cc4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/495993a985b04e43ee93db28d7686cc4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jacob</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T21:05:10+00:00">December 13, 2020 at 9:05 pm</time></a> </div>
<div class="comment-content">
<p>In the <a href="https://news.ycombinator.com/item?id=25408853" rel="nofollow ugc">discussion about this post at Hacker News</a> it has been pointed out that the stated numbers here appear to be based on running code compiled for X86 under Apple’s Rosetta translation. When compiled natively for ARM, the difference is apparently much smaller.</p>
</div>
<ol class="children">
<li id="comment-561976" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/495993a985b04e43ee93db28d7686cc4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/495993a985b04e43ee93db28d7686cc4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jacob</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-14T01:44:26+00:00">December 14, 2020 at 1:44 am</time></a> </div>
<div class="comment-content">
<p>Thanks for the quick update on a Sunday afternoon!</p>
<p>I’m looking forward to seeing how you can best make use of the new hardware.</p>
</div>
</li>
</ol>
</li>
<li id="comment-561923" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/820d0e4ee14e986a44d33782ca852f51?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/820d0e4ee14e986a44d33782ca852f51?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bob Dobbs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-13T21:42:08+00:00">December 13, 2020 at 9:42 pm</time></a> </div>
<div class="comment-content">
<p>You&rsquo;ve known for over an hour that your benchmark was grossly flawed, and that your results are farcical.</p>
<p>This is embarrassing. If you had any credibility at all you&rsquo;d at least put a mea culpa at the type, but if you&rsquo;re cowardly just deleted this fullstop.</p>
<p>The &ldquo;critics&rdquo;, it turns out, were absolutely right. You wrote some lazy nonsense, and when called on it, made even <em>worse</em> lazy nonsense. Ouch.</p>
</div>
<ol class="children">
<li id="comment-561958" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-14T00:23:42+00:00">December 14, 2020 at 12:23 am</time></a> </div>
<div class="comment-content">
<blockquote>
<p>You’ve known for over an hour that your benchmark was grossly flawed, and that your results are farcical.</p>
</blockquote>
<ol>
<li>
<p>I edited my code inside Visual Studio code. I opened a terminal within Visual Studio code and compiled there, not realizing that Visual Studio code itself was running under Rosetta 2. Whether it is &ldquo;a gross&rdquo; mistake is up to debate. I think it was an easy mistake to make&#8230;</p>
</li>
<li>
<p>It is Sunday here and I was with my family. I saw on Twitter that there was a mistake, and so I replied to the person that raised the issue that I would revisit the numbers. I did, a few hours later. Again: it is Sunday and I was with my family. The post was literally fixed the same day.</p>
</li>
</ol>
<p>Yes. I made a mistake. I admit. I also corrected it as quickly as possible.</p>
<blockquote>
<p>This is embarrassing. If you had any credibility at all you’d at least put a mea culpa at the type, but if you’re cowardly just deleted this fullstop.</p>
</blockquote>
<p>I added a paragraph in this blog post that says: &ldquo;(This blog post has been updated after a corrected a methodological mistake. I was running the Apple M1 processor under x64 emulation.)&rdquo;</p>
<p>The older blog post contains a note that describes how I was in error.</p>
<p>How am I being cowardly?</p>
<p>At no point did I try to hide that I made a mistake. In fact, I state it openly.</p>
<blockquote>
<p>The “critics”, it turns out, were absolutely right. You wrote some lazy nonsense, and when called on it, made even worse lazy nonsense. Ouch.</p>
</blockquote>
<p>I was wrong about SIMD performance on the Apple M1.</p>
<p>I get stuff wrong sometimes, especially when I write a quick blog post on a Sunday morning&#8230; But even when I am super careful, I sometimes make mistakes. That&rsquo;s why I always encourage people to challenge me, to revisit my numbers and so forth.</p>
</div>
</li>
<li id="comment-561967" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eb2a866d2af93f6d8d316c2f3e2adc75?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eb2a866d2af93f6d8d316c2f3e2adc75?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tim Miller</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-14T00:58:44+00:00">December 14, 2020 at 12:58 am</time></a> </div>
<div class="comment-content">
<p>Daniel, thank you for making simdjson available to the world. I think others would share my opinion that while rude, aggressive, and accusatory posts are unfortunately to be expected on the internet, no response is required. I hope this won&rsquo;t discourage you from posting in the future. Don&rsquo;t let the trolls get you down!</p>
</div>
</li>
<li id="comment-561978" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maynard Handley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-14T01:47:21+00:00">December 14, 2020 at 1:47 am</time></a> </div>
<div class="comment-content">
<p>Come on, dude that’s not necessary. There are few enough academics investigating ALL aspects of performance across a range of real life hardware.</p>
<p>Let he who is without sin cast the first stone; mote and beams; those remain wise words.</p>
</div>
</li>
<li id="comment-562018" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e7c2b00d7dd16d1e5baadffbbc556a13?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e7c2b00d7dd16d1e5baadffbbc556a13?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nitsan Wakart</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-14T10:33:40+00:00">December 14, 2020 at 10:33 am</time></a> </div>
<div class="comment-content">
<p>“As for literary criticism in general: I have long felt that any reviewer who expresses rage and loathing for a novel or a play or a poem is preposterous. He or she is like a person who has put on full armor and attacked a hot fudge sundae or a banana split.”</p>
<p>― kurt Vonnegut</p>
</div>
</li>
<li id="comment-562037" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bffe244179713fa7453baac2b4833d94?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bffe244179713fa7453baac2b4833d94?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Paul</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-14T13:37:20+00:00">December 14, 2020 at 1:37 pm</time></a> </div>
<div class="comment-content">
<p>Wow Bob, or is it Karen? Talk about over the top response and rude AF&#8230;</p>
</div>
</li>
</ol>
</li>
<li id="comment-561999" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4a203a48eb1cdb1b8c47d008f0c139c9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4a203a48eb1cdb1b8c47d008f0c139c9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Roman Gershman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-14T05:33:45+00:00">December 14, 2020 at 5:33 am</time></a> </div>
<div class="comment-content">
<p>Daniel, your work and research has an amazing impact on the engineering community.</p>
<p>You do not have to answer angry trolls that do not know you but gladly use any opportunity to humiliate and laugh at someone.</p>
</div>
</li>
<li id="comment-562008" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9aeeda62d18a1c755d0b879256470231?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9aeeda62d18a1c755d0b879256470231?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anthony Cayetano</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-14T07:40:08+00:00">December 14, 2020 at 7:40 am</time></a> </div>
<div class="comment-content">
<p>Because the M1 (and I’m assuming its future iterations) is a SoC; Data Processing that needs SIMD (matrices, vectors, etc.) is delegated to other specialised units such as the on-die GPU and Neural Processor. IIRC, the M1 features new SIMD instructions that complement both the GPU and Neural Unit, as to what degree they are purposed for depends on how Apple uses them for their Metal 2 API. This type of distributed processing is the new modern and I believe it’s the way to go.</p>
</div>
</li>
<li id="comment-562039" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bffe244179713fa7453baac2b4833d94?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bffe244179713fa7453baac2b4833d94?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Paul</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-14T13:51:24+00:00">December 14, 2020 at 1:51 pm</time></a> </div>
<div class="comment-content">
<p>To be completely fair, Kaby lake processors we&rsquo;re released in August of 2016, a roughly 4-year-old processor compared to the just released M1. Ice lake processors are also a year old and as the test done by Nathan Kurz above shows, the ice lake processor, does a much better job. It exceeds validate results of the latest M1 results at roughly 34.4 GB/s.</p>
<p>I wonder how much the Intel performance is impacted due to Meltdown and Spectre patches. Ice lake solved some but not all of those issues.</p>
</div>
<ol class="children">
<li id="comment-562041" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-14T14:04:31+00:00">December 14, 2020 at 2:04 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s why I stress the dates of the MacBook. It is not &ldquo;fair&rdquo;.</p>
<p>But it is more complicated even than that because the M1 uses less power than comparable Intel processors. So you&rsquo;d want to account for energy use as well&#8230; something I do not do.</p>
</div>
</li>
</ol>
</li>
<li id="comment-562058" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e64eb1d7af21b8a05976f003f2d70b20?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e64eb1d7af21b8a05976f003f2d70b20?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Matthaus Woolard</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-14T19:00:35+00:00">December 14, 2020 at 7:00 pm</time></a> </div>
<div class="comment-content">
<p>Since the GPU and CPU both share the same memory. What is the latency impact of dispatching SIMD heavy work to the GPU on the M1.</p>
</div>
</li>
<li id="comment-562119" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0fbcce1ed0ca3d5e371c9c1a4b6d2080?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0fbcce1ed0ca3d5e371c9c1a4b6d2080?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Brandon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-15T04:59:21+00:00">December 15, 2020 at 4:59 am</time></a> </div>
<div class="comment-content">
<p>The M1 performed <em>much</em> better than I expected in SIMD benchmarks, and the difference between 128 and 256-bit vector widths was the reason I was initially skeptical about Apple&rsquo;s performance claims. But looking at benchmarks makes me certain that Apple&rsquo;s Macbooks are headed in the right direction.</p>
<p>I&rsquo;m excited for the next iteration of Apple Silicon.</p>
</div>
</li>
<li id="comment-574955" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/811d69198d81dafc3e0bfd8ecccc1e8c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/811d69198d81dafc3e0bfd8ecccc1e8c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">McD</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-15T07:53:01+00:00">February 15, 2021 at 7:53 am</time></a> </div>
<div class="comment-content">
<p>A late comment but did you use the Accelerate Framework? Apparently this taps additional SIMD units not available directly and can have a significant performance impact.</p>
</div>
<ol class="children">
<li id="comment-575059" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-16T00:26:33+00:00">February 16, 2021 at 12:26 am</time></a> </div>
<div class="comment-content">
<p>@McD I am not very familiar with the Accelerate Framework. It appears to be a set of specialized functions.</p>
</div>
</li>
</ol>
</li>
</ol>
