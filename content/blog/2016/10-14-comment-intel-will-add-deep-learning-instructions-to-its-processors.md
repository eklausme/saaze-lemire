---
date: "2016-10-14 12:00:00"
title: "Intel will add deep-learning instructions to its processors"
index: false
---

[12 thoughts on &ldquo;Intel will add deep-learning instructions to its processors&rdquo;](/lemire/blog/2016/10-14-intel-will-add-deep-learning-instructions-to-its-processors)

<ol class="comment-list">
<li id="comment-255773" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3056f1011deed57876c4a08713f0e1e7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3056f1011deed57876c4a08713f0e1e7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://www.pelock.com" class="url" rel="ugc external nofollow">Bartosz WÃ³jcik</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-14T19:02:47+00:00">October 14, 2016 at 7:02 pm</time></a> </div>
<div class="comment-content">
<p>I hope one day, me and one of my Intel CPU cores will be real buddies, hanging around, talking smack and I won&rsquo;t choke him and his 127 twins to 99% anymore 🙂</p>
</div>
<ol class="children">
<li id="comment-255847" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d32f8035fa9cb89a6d5ca68b4c8de67a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d32f8035fa9cb89a6d5ca68b4c8de67a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Michael Hay</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-15T09:18:27+00:00">October 15, 2016 at 9:18 am</time></a> </div>
<div class="comment-content">
<p>Intel has Altera&rsquo;s acquisition also up their sleeves. They could more easily build learning assists, AI systems, etc. with flexible hardware. The challenge with FPGAs today is the toolchain is at least 10 years behind standard C, Java, etc. compilers. So there is a lot of work to do. We kind of need something like the defunct project from IBM called LIME or Maxeler&rsquo;s OpenSPL efforts.</p>
<p>To me the magic of the human mind is that the software and the wetware and the software evolve together. With silicon hardware and software there is a very slow mutual evolution.</p>
</div>
</li>
</ol>
</li>
<li id="comment-255891" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4cc5a34e5f5f16f31f3663d20750e8ab?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4cc5a34e5f5f16f31f3663d20750e8ab?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Srigi</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-15T19:15:37+00:00">October 15, 2016 at 7:15 pm</time></a> </div>
<div class="comment-content">
<p>How exactly this kind of instructions are feeded by RAM?<br/>
Because if you got 64B per tick (simplified), I suppose CPU run out of data supply pretty quick. RAM/cache bandwidth is way lower than this processing speed.</p>
</div>
<ol class="children">
<li id="comment-256105" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-17T15:05:26+00:00">October 17, 2016 at 3:05 pm</time></a> </div>
<div class="comment-content">
<p>We would need to see what the specifics are&#8230; My experience has been that the L1 cache is fast enough that even with AVX-512, cache speed is not a bottleneck. However, if you can&rsquo;t load up the data in cache fast enough, my experience has been that RAM access speed is already a major bottleneck, even without any fancy instruction.</p>
</div>
</li>
</ol>
</li>
<li id="comment-255900" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1d1382344586ecff844dacff698c2efb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1d1382344586ecff844dacff698c2efb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">marc</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-15T21:37:55+00:00">October 15, 2016 at 9:37 pm</time></a> </div>
<div class="comment-content">
<p>If this is unspecific vector computation, is means deep learning is a hype label for what we have been enjoying with matlab/R/numpy vector computation for ages ? OK, deep learning has high impact, but it is much more specific than &ldquo;vector computation&rdquo;</p>
</div>
<ol class="children">
<li id="comment-256103" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-17T14:47:08+00:00">October 17, 2016 at 2:47 pm</time></a> </div>
<div class="comment-content">
<p>Vector instructions at the hardware level are related but distinct from vector-oriented programming.</p>
</div>
</li>
</ol>
</li>
<li id="comment-256066" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7843307a1f8a74b602624c5a3f15d71c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7843307a1f8a74b602624c5a3f15d71c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tomasz Jamroszczak</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-17T08:30:56+00:00">October 17, 2016 at 8:30 am</time></a> </div>
<div class="comment-content">
<p>For a moment I thought Intel will add deep learning for just-in-time optimizations of code.</p>
</div>
</li>
<li id="comment-256108" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ea4a09f32fa08e754f344887617af6ba?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ea4a09f32fa08e754f344887617af6ba?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://benbernardblog.com" class="url" rel="ugc external nofollow">Benoit Bernard</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-17T15:33:13+00:00">October 17, 2016 at 3:33 pm</time></a> </div>
<div class="comment-content">
<p>Do we have a rough idea of the performance gains that will be brought by those new Intel instructions? In other words, how will it compare to GPUs, performance-wise?</p>
</div>
<ol class="children">
<li id="comment-256127" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-17T19:26:08+00:00">October 17, 2016 at 7:26 pm</time></a> </div>
<div class="comment-content">
<p><em> In other words, how will it compare to GPUs, performance-wise?</em></p>
<p>Given that we do not even know what these instructions are, exactly, it is hard to know exactly.</p>
<p>However, we can tell a few things from basic knowledge of Intel technology. Intel processors cannot compete on raw processing speed with GPUs. It could be that I am wrong, but I don&rsquo;t think that these instructions will change this picture.</p>
<p>GPUs are powerful, true&#8230; but they are also specialized. This makes them a poor fit for many common problems&#8230; whereas Intel&rsquo;s CPU are much more broadly applicable.</p>
<p>So, what if you have problems where deep learning is only part of what your system has to do? Then maybe the GPU is no longer the best solution. Maybe some Intel processor with both general purpose and deep learning capabilities becomes the best bet.</p>
<p>We should keep in mind that Intel&rsquo;s money comes (largely) from cloud infrastructures. Intel has to convince people like Amazon and Google to buy its processors. These people do a lot of work besides deep learning.</p>
</div>
</li>
</ol>
</li>
<li id="comment-256325" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f9e36d05b02beec30222c42f59023c4a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f9e36d05b02beec30222c42f59023c4a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://mldb.ai" class="url" rel="ugc external nofollow">Jeremy Barnes</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-19T15:15:44+00:00">October 19, 2016 at 3:15 pm</time></a> </div>
<div class="comment-content">
<p>I was disappointed to not actually see the details of the instructions, but I guess we can always speculate.</p>
<p>I suspect that these will be tailored towards int8,int16,fp16,fp32 512 bit wide dot product and accumulate (useful for inference), and possibly instructions to accelerate FFTs and convolutions (similar to the SSE4.2 string instructions, but for convolutions instead of string matching).</p>
<p>With a 64 wide int8 one per cycle throughput dot product (128 ops), which is more and more feasible for inference (but not training) of neural networks, a 32 core system could perform 128&#215;32 = 4096 int8 ops per cycle, or around 8 TOPS on a 2GHz system. This is less than the 40TOPS the dp4a instruction can get on a Titan X, but it&rsquo;s at least in the same ballpark. It probably wouldn&rsquo;t burn too much area either.</p>
<p>A 32 width fp16 dot product operator (64 flops/cycle) would be at 4TFLOPs, which compares favorably with the 10TFLOPs available on a Titan X, but would take significantly more area and probably need a deeper pipeline.</p>
<p>Direct convolution instructions would play to the strengths of the SIMD model (eg, the ability to parallel shift like in the string instructions), and may be able to provide impressive performance especially in int8 mode.</p>
</div>
</li>
<li id="comment-256457" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e4c67e3a7cac300ef10aca93989d2407?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e4c67e3a7cac300ef10aca93989d2407?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Head. S</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-20T19:37:20+00:00">October 20, 2016 at 7:37 pm</time></a> </div>
<div class="comment-content">
<p>What do you think about AMD &ldquo;Bristol Ridge&rdquo;? Could we take those GPU cores for the purpose?</p>
</div>
<ol class="children">
<li id="comment-256463" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-20T20:00:55+00:00">October 20, 2016 at 8:00 pm</time></a> </div>
<div class="comment-content">
<p>@Head</p>
<p>I have not been following AMD at all, but most of our main CPUs have integrated GPUs which are often idle. This seems wasteful, but I have not heard much about it.</p>
</div>
</li>
</ol>
</li>
</ol>
