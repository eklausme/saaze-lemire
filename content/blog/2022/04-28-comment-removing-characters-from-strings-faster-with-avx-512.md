---
date: "2022-04-28 12:00:00"
title: "Removing characters from strings faster with AVX-512"
index: false
---

[7 thoughts on &ldquo;Removing characters from strings faster with AVX-512&rdquo;](/lemire/blog/2022/04-28-removing-characters-from-strings-faster-with-avx-512)

<ol class="comment-list">
<li id="comment-629959" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/665b5f11dfc1fa01685d95dbee607d7b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/665b5f11dfc1fa01685d95dbee607d7b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">mischa sandberg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-04-28T18:30:26+00:00">April 28, 2022 at 6:30 pm</time></a> </div>
<div class="comment-content">
<p>Seeing SSE2 used for string ops caused one colleague to remark, about that and AVX, &ldquo;Why didn&rsquo;t Intel just make REP SCASB (et al) fast?&rdquo; Torvalds might be right; meanwhile, we can be opportunistic about odd cases for using odd instruction sets. Or use them for fast APL functions 🙂</p>
</div>
<ol class="children">
<li id="comment-630247" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/647ae2ae302b76c301679527baa452ff?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/647ae2ae302b76c301679527baa452ff?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Adam Stylinski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-04-30T01:11:59+00:00">April 30, 2022 at 1:11 am</time></a> </div>
<div class="comment-content">
<p>I mean&#8230;they did for a few things in that family. ERMS or enhanced rep mov sb can be used for fast memsets and memmoves. Glibc is even aware of CPUs with that capability and when using that microcode trick is helpful. I think that family of &ldquo;rep&rdquo; semantics has some limitations for how much they can express. That and the micro op sequence it compiles to is probably a bit more complicated.</p>
</div>
<ol class="children">
<li id="comment-630936" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/665b5f11dfc1fa01685d95dbee607d7b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/665b5f11dfc1fa01685d95dbee607d7b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">mischa sandberg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-05-02T18:55:30+00:00">May 2, 2022 at 6:55 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for pointing out ERMS. A benchmark in Stackoverflow wasn&rsquo;t flattering (vs AVX), and the Intel Optimization Ref says ERMS&rsquo;s advantage is smaller code.<br/>
<a href="https://stackoverflow.com/questions/43343231/enhanced-rep-movsb-for-memcpy" rel="nofollow ugc">https://stackoverflow.com/questions/43343231/enhanced-rep-movsb-for-memcpy</a>.<br/>
For SSE2 memcpy, of blocks &gt; 192 bytes, I saw advantage from prefetchnta. Would that size be the same for AVX?</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-630121" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/34ad6d9afd8297e28056df8ddc2477cc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/34ad6d9afd8297e28056df8ddc2477cc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/kvr000/" class="url" rel="ugc external nofollow">Zbynek</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-04-29T13:29:41+00:00">April 29, 2022 at 1:29 pm</time></a> </div>
<div class="comment-content">
<p>I believe Linus Torvalds was more about the size of AVX-512 which takes huge amount of data during context switch and also about overheating which causes underclocking CPU if used too much. The same could be achieved if Intel extended 32 bytes AVX-2 and would likely have similar speed. I wrote similar code for matrix multiplication and the performance gain is far from linear, even ignoring underclocking.</p>
</div>
<ol class="children">
<li id="comment-630130" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-04-29T15:13:38+00:00">April 29, 2022 at 3:13 pm</time></a> </div>
<div class="comment-content">
<p>AVX-512 extends the ISA for 32-byte registers. In fact, the code I describe in my blog post is easily adapted to 32-byte registers.</p>
</div>
</li>
</ol>
</li>
<li id="comment-630289" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f06ea5e0a8f20e4e976b9bffe75d2781?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f06ea5e0a8f20e4e976b9bffe75d2781?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ravi</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-04-30T02:37:55+00:00">April 30, 2022 at 2:37 am</time></a> </div>
<div class="comment-content">
<p>You can discover specialized instructions in the Intel CPU using /proc/cpuinfo</p>
</div>
</li>
<li id="comment-630782" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3d48a53a64a55fe5ec1765e95f45aea3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3d48a53a64a55fe5ec1765e95f45aea3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Matt Williams</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-05-01T19:26:28+00:00">May 1, 2022 at 7:26 pm</time></a> </div>
<div class="comment-content">
<p>Great article! I&rsquo;m confused why you&rsquo;re using _mm512_mask_compressstoreu_epi16 rather than _mm512_mask_compressstoreu_epi8 &#8211; don&rsquo;t you want to write/not write at an 8-bit granularity rather than a 16-bit one?</p>
</div>
</li>
</ol>
