---
date: "2017-11-16 12:00:00"
title: "Fast exact integer divisions using floating-point operations"
index: false
---

[11 thoughts on &ldquo;Fast exact integer divisions using floating-point operations&rdquo;](/lemire/blog/2017/11-16-fast-exact-integer-divisions-using-floating-point-operations)

<ol class="comment-list">
<li id="comment-291584" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/796b514885c46f26b3382fefc442d27b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/796b514885c46f26b3382fefc442d27b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Charlie</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-17T17:07:03+00:00">November 17, 2017 at 5:07 pm</time></a> </div>
<div class="comment-content">
<p>The awk programming language is defined to represent all numbers in (double precision) floating point. This may have been a more practical decision that I originally expected.</p>
<p>It would be interesting to see how the awka compiler performs versus a native C integer and/or floating point application that is heavy with division. From what I&rsquo;ve read here, awka could likely beat an a.out in some circumstances.</p>
</div>
</li>
<li id="comment-291587" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-17T18:05:18+00:00">November 17, 2017 at 6:05 pm</time></a> </div>
<div class="comment-content">
<p>While looking into this, I found there is an FIDIV instruction that auto-converts the divisor from int32 to double, but I don&rsquo;t see Godbolt choosing it for any compiler. It seems to have the same latency as FDIV, but instead I see compilers picking CVTSI2SD followed by FDIV.</p>
<p>Maybe I&rsquo;m missing something, but FIDIV seems like it should have lower reciprocal latency than the latter two instructions.</p>
</div>
<ol class="children">
<li id="comment-291590" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-17T18:50:28+00:00">November 17, 2017 at 6:50 pm</time></a> </div>
<div class="comment-content">
<p>Some old note that Agner Fog wrote:</p>
<p><em>FDIV takes 19, 33, or 39 clock cycles for 24, 53, and 64 bit precision respectively. FIDIV takes 3 clocks more.</em></p>
</div>
<ol class="children">
<li id="comment-291594" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kendall Willets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-17T19:15:47+00:00">November 17, 2017 at 7:15 pm</time></a> </div>
<div class="comment-content">
<p>I thought I saw some architectures in Agner&rsquo;s tables where FDIV and FIDIV have the same latency, but I didn&rsquo;t have time to dig into it.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-291615" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3d0e1c11ecadbf8c26e7cddae00665bd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3d0e1c11ecadbf8c26e7cddae00665bd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bryan McNett</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-18T02:29:42+00:00">November 18, 2017 at 2:29 am</time></a> </div>
<div class="comment-content">
<p>Occurs to me that the SSE2 instruction DIVPS performs two 64-bit float divides in parallel, and its modern variants would do four or eight in parallel, respectively. There exists no SSE instruction for integer divides.</p>
<p>It&rsquo;s not always possible to do so many divides in parallel, but it should be possible to adapt your test to use SSE intrinsics and see a corresponding speedup when doing uint32_t division as float64 using these SIMD instructions.</p>
</div>
</li>
<li id="comment-291618" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3d0e1c11ecadbf8c26e7cddae00665bd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3d0e1c11ecadbf8c26e7cddae00665bd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bryan McNett</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-18T02:42:16+00:00">November 18, 2017 at 2:42 am</time></a> </div>
<div class="comment-content">
<p>whoops, DIVPD not DIVPS 😐</p>
</div>
</li>
<li id="comment-291734" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c5d744640b5a0d326bf75e5579487324?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c5d744640b5a0d326bf75e5579487324?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Denis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-20T08:16:18+00:00">November 20, 2017 at 8:16 am</time></a> </div>
<div class="comment-content">
<p>Daniel, thank you for the great article!<br/>
Do you have maybe a good links how integer division is implemented in HW nowadays? I&rsquo;m rather interested in algorithm and high-level HW design.</p>
</div>
<ol class="children">
<li id="comment-291765" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-20T21:37:16+00:00">November 20, 2017 at 9:37 pm</time></a> </div>
<div class="comment-content">
<p>I have some idea about how additions and multiplications are implemented in hardware with circuits, but I have no idea whatsoever how the division is implemented at the hardware level&#8230;</p>
</div>
</li>
</ol>
</li>
<li id="comment-291874" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3d0e1c11ecadbf8c26e7cddae00665bd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3d0e1c11ecadbf8c26e7cddae00665bd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bryan McNett</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-22T00:11:49+00:00">November 22, 2017 at 12:11 am</time></a> </div>
<div class="comment-content">
<p>Have we looked at the assembly generated from the test program? I am starting to suspect that the compiler auto-vectorized the loop using SSE instructions. If the compiler used SSE2 to auto-vectorize, then it would have emitted the DIVPD instruction, as I mentioned earlier. This instruction has 2x parallelism, and is expected to have roughly double the performance of a non-parallel DIV instruction.</p>
</div>
<ol class="children">
<li id="comment-291877" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-22T00:23:57+00:00">November 22, 2017 at 12:23 am</time></a> </div>
<div class="comment-content">
<p>I posted my code online: </p>
<p><a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2017/11/16/divide.c" rel="nofollow ugc">https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2017/11/16/divide.c</a></p>
<p>So one can verify whether I made a mistake in my analysis.</p>
</div>
</li>
</ol>
</li>
<li id="comment-302370" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a1d92eb9746aa660daaff62d6ef59407?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a1d92eb9746aa660daaff62d6ef59407?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Andrew Paterson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-02T15:21:37+00:00">May 2, 2018 at 3:21 pm</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s worth bearing in mind, and this may be related to what Kendall Willets saw, that converting an integer to a floating point number is not a simple operation. I haven&rsquo;t benchmarked this since I had a 386 so take that with a grain of salt&#8230;</p>
</div>
</li>
</ol>
