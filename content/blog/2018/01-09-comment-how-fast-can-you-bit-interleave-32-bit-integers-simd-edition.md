---
date: "2018-01-09 12:00:00"
title: "How fast can you bit-interleave 32-bit integers? (SIMD edition)"
index: false
---

[8 thoughts on &ldquo;How fast can you bit-interleave 32-bit integers? (SIMD edition)&rdquo;](/lemire/blog/2018/01-09-how-fast-can-you-bit-interleave-32-bit-integers-simd-edition)

<ol class="comment-list">
<li id="comment-294750" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Nathan Kurz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-10T14:34:25+00:00">January 10, 2018 at 2:34 pm</time></a> </div>
<div class="comment-content">
<p>From here: *I am disappointed as I expected vector code to be about twice as fast.*</p>
<p>From previous: *The GCC compiler seems to hate my deinterleaving code and produces very slow binaries.*</p>
<p>I haven&rsquo;t gone through to figure out the expected speeds, but if you think it should be twice as fast, it seems likely that it could be made twice as fast. Is there reason to believe that this isn&rsquo;t another case of the compiler(s) creating suboptimal assembly for your otherwise fast algorithm? </p>
<p>My quick guess would be that the compiler is reloading all the 256-bit constants on every call. Normally, this wouldn&rsquo;t slow things down, but in a tightly tuned approach like yours it might be the limiting factor. Would 8 loads (and a possibly complex addressed store competing for the same address units) account for the observed speed?</p>
</div>
<ol class="children">
<li id="comment-294765" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-10T20:51:23+00:00">January 10, 2018 at 8:51 pm</time></a> </div>
<div class="comment-content">
<p>Kendall&rsquo;s comment pushed me to update the post with a table lookup approach, based on nibbles. My vector code is now clearly faster than pdep.</p>
<p>Possibly someone (maybe Kendall) can do even better.</p>
</div>
</li>
</ol>
</li>
<li id="comment-294760" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-10T17:33:12+00:00">January 10, 2018 at 5:33 pm</time></a> </div>
<div class="comment-content">
<p>I think the zero-interleaving can be around 6 AVX instructions per four 32-bit int&rsquo;s. The key is to shift/mask them into even and odd nybbles and look up their 8-bit expansions with vpshufb. After that it&rsquo;s just matter of getting the 32 bytes into the right order.</p>
</div>
</li>
<li id="comment-295742" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7c18bfe82b36486d64a11663633bacb1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7c18bfe82b36486d64a11663633bacb1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">James Prichard</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-28T13:07:35+00:00">January 28, 2018 at 1:07 pm</time></a> </div>
<div class="comment-content">
<p>Your nybble version is clever. Might it be suitable to contribute Intel&rsquo;s ray-tracing kernel framework?</p>
<p><a href="https://github.com/embree/embree/blob/master/common/math/math.h" rel="nofollow ugc">https://github.com/embree/embree/blob/master/common/math/math.h</a></p>
</div>
<ol class="children">
<li id="comment-295746" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-28T16:41:29+00:00">January 28, 2018 at 4:41 pm</time></a> </div>
<div class="comment-content">
<p>Hmmm&#8230; the same idea could be used, it looks like&#8230;</p>
</div>
<ol class="children">
<li id="comment-295815" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-29T20:41:13+00:00">January 29, 2018 at 8:41 pm</time></a> </div>
<div class="comment-content">
<p>I put my code in a small repo here: <a href="https://github.com/KWillets/simd_interleave" rel="nofollow ugc">https://github.com/KWillets/simd_interleave</a> . It&rsquo;s slightly different from Daniel&rsquo;s problem definition, so I didn&rsquo;t try to integrate it with his repo or tests, unfortunately.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-410947" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b1b9890a28908ca13d8ba0504139175?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b1b9890a28908ca13d8ba0504139175?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nils</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-08T06:08:49+00:00">June 8, 2019 at 6:08 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m late to the party, but I just want to point out, that on architectures where no pdep instruction is available, you can often abuse the galois field arithmetic instructions which made it into the instruction sets to speed up cryptography.</p>
<p>on ARM NEON for example if you square a number using <code>vmul_p8</code> you&rsquo;re bit interleaving with zeroes. On Intel <code>PCLMULQDQ</code> will do the same trick.</p>
</div>
</li>
<li id="comment-491891" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1f4a7e7a778335692fc21ba2c8e7434d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1f4a7e7a778335692fc21ba2c8e7434d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stefano Trevisani</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-02-24T19:45:19+00:00">February 24, 2020 at 7:45 pm</time></a> </div>
<div class="comment-content">
<p>Very nice! I ended up here while I was trying to compile my code (which uses pdep) on ARM, unfortunately yep, that&rsquo;s what RISC means I guess&#8230;<br/>
Just a note on the tests: please please use <code>struct timespec/clock_gettime()</code>. If you are just as picky as me about these little things, it will make a &ldquo;big&rdquo; difference on precision and WHAT you are going to actually measure (e.g. thread-time only clocks) 😀</p>
</div>
</li>
</ol>
