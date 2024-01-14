---
date: "2018-07-05 12:00:00"
title: "How quickly can you compute the dot product between two large vectors?"
index: false
---

[31 thoughts on &ldquo;How quickly can you compute the dot product between two large vectors?&rdquo;](/lemire/blog/2018/07-05-how-quickly-can-you-compute-the-dot-product-between-two-large-vectors)

<ol class="comment-list">
<li id="comment-313956" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24cfa9591263008553ae4c125b6a9934?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24cfa9591263008553ae4c125b6a9934?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">wmu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-05T19:10:30+00:00">July 5, 2018 at 7:10 pm</time></a> </div>
<div class="comment-content">
<p>You didn&rsquo;t try the dot product instruction available since SSE 4.1: DPPS. SSE code that use this instruction: <a href="https://github.com/WojciechMula/toys/blob/master/sse-dotprod/sse-dpps.c" rel="nofollow ugc">https://github.com/WojciechMula/toys/blob/master/sse-dotprod/sse-dpps.c</a></p>
</div>
<ol class="children">
<li id="comment-313960" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-05T19:17:57+00:00">July 5, 2018 at 7:17 pm</time></a> </div>
<div class="comment-content">
<p>It is going to be slower, no? Keep in mind that I am using large inputs.</p>
</div>
<ol class="children">
<li id="comment-314217" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24cfa9591263008553ae4c125b6a9934?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24cfa9591263008553ae4c125b6a9934?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">wmu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-06T12:37:05+00:00">July 6, 2018 at 12:37 pm</time></a> </div>
<div class="comment-content">
<p>Perhaps it&rsquo;d be slower (AFAIR dpps throughput is low); I&rsquo;m curious how bad it&rsquo;d be.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-314127" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/253139dd9bc1e911c7a0be5415c16378?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/253139dd9bc1e911c7a0be5415c16378?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sagar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-06T06:39:33+00:00">July 6, 2018 at 6:39 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m confused about your conclusion (2) that the operation is compute bound. As your benchmarks suggest and you have stated, the dot product operation is clearly memory bound when the input size is large. Do you mean that the bottleneck is the number of floating point units rather than instruction decode or something when the inputs size is small?</p>
</div>
<ol class="children">
<li id="comment-314220" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-06T12:44:37+00:00">July 6, 2018 at 12:44 pm</time></a> </div>
<div class="comment-content">
<p>I refer to the standard-compliant version. The use of the fast intrinsics is not equivalent to the standard C code I offered.</p>
<p>Standard-compliant dot product is, in my tests, entirely compute bound. Look at my table, follow the last column.</p>
<p>Once you allow yourself to use fast SIMD instructions, then the problem becomes memory-bound&#8230; for large arrays.</p>
</div>
</li>
</ol>
</li>
<li id="comment-314141" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-06T07:29:24+00:00">July 6, 2018 at 7:29 am</time></a> </div>
<div class="comment-content">
<p>Unless compilers are more clever than I thought (and I think you don&rsquo;t actually care about exact order of floating point additions anyway, if my glance on code was correct) it would seem you are creating an unnecessarily tight dependency chain from one sum to another, and this&#8230; might be a limiting factor for throughput. Or are compilers that (overly) clever they would rewrite vector addition intrinsics with -ffast-math?</p>
<p>I would consider trying out a small amount of strided vector sums whose intermediate results would fit in the ISA register set. Then just sum stride vectors like you sum vector entries (&ldquo;buffer&rdquo;) now.</p>
</div>
<ol class="children">
<li id="comment-314221" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-06T12:45:29+00:00">July 6, 2018 at 12:45 pm</time></a> </div>
<div class="comment-content">
<p>As a side note: at least Skylake CPUs have reciprocally throughput of two multiply-accumulates per clock cycle, but the latency of one instruction is four cycles, which is much more pronounced than one you would see in an operation such as a sum of vector elements. This might completely dominate your results on small inputs, and this &ldquo;four cycles per pair of floats&rdquo; seems curiously close to that.</p>
</div>
<ol class="children">
<li id="comment-314238" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-06T13:27:44+00:00">July 6, 2018 at 1:27 pm</time></a> </div>
<div class="comment-content">
<p>My analysis is based on code I wrote using intrinsics, without multiply-accumulates. I suspect that in the fast-math mode, the compiler might use vfmadd instructions.</p>
<p>In any case, my analysis was a &ldquo;back of the envelope&rdquo; thing without a serious look at the sources of contention. I just wanted to check that things ran roughly as fast as they should.</p>
</div>
<ol class="children">
<li id="comment-314665" class="comment even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/38a2274db3b64c309aed98275d99a009?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/38a2274db3b64c309aed98275d99a009?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mathias Gaunard</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-07T09:31:33+00:00">July 7, 2018 at 9:31 am</time></a> </div>
<div class="comment-content">
<p>the compiler is allowed to replace multiply+add by a single multiply-add even without fast-math.</p>
</div>
<ol class="children">
<li id="comment-314708" class="comment byuser comment-author-lemire bypostauthor odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-07T13:36:26+00:00">July 7, 2018 at 1:36 pm</time></a> </div>
<div class="comment-content">
<p>Can you get a compiler to produce a memory-bound code while remaining standard compliant? (No fast-math)</p>
</div>
<ol class="children">
<li id="comment-314713" class="comment even depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/38a2274db3b64c309aed98275d99a009?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/38a2274db3b64c309aed98275d99a009?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mathias Gaunard</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-07T14:06:33+00:00">July 7, 2018 at 2:06 pm</time></a> </div>
<div class="comment-content">
<p>not unless you make the code do several sums in parallel or use integers</p>
</div>
<ol class="children">
<li id="comment-314735" class="comment odd alt depth-7">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-07T16:49:25+00:00">July 7, 2018 at 4:49 pm</time></a> </div>
<div class="comment-content">
<p>If one would truly want to maintain the simple sequential order of additions, one could pre-permute vectors to produce this order of summation even with parallel (vectorised) sums. I think it might be completely plausible for some tasks (such as simple neural networks). It&rsquo;s a different question if the summation order actually matters much except when using some sort of exotic reduced precision floats.</p>
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
<li id="comment-314240" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-06T13:28:46+00:00">July 6, 2018 at 1:28 pm</time></a> </div>
<div class="comment-content">
<p>Got any code?</p>
</div>
<ol class="children">
<li id="comment-314249" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-06T14:02:13+00:00">July 6, 2018 at 2:02 pm</time></a> </div>
<div class="comment-content">
<p>This applies to all variants, but effect is quite clear already on plain dot function (really dumb loop unrolling, but this way I&rsquo;m more convinced the compiler does what I want):</p>
<p><code>__attribute__((noinline)) float dot(float *x1, float *x2, size_t len) {<br/>
float sum0, sum1, sum2, sum3, sum4, sum5, sum6, sum7;<br/>
sum0 = sum1 = sum2 = sum3 = sum4 = sum5 = sum6 = sum7 = 0;<br/>
for (size_t i = 0; i &lt; len;) {<br/>
sum0 += x1[i] * x2[i];<br/>
i++;<br/>
sum1 += x1[i] * x2[i];<br/>
i++;<br/>
sum2 += x1[i] * x2[i];<br/>
i++;<br/>
sum3 += x1[i] * x2[i];<br/>
i++;<br/>
sum4 += x1[i] * x2[i];<br/>
i++;<br/>
sum5 += x1[i] * x2[i];<br/>
i++;<br/>
sum6 += x1[i] * x2[i];<br/>
i++;<br/>
sum7 += x1[i] * x2[i];<br/>
i++;<br/>
}<br/>
return sum0 + sum1 + sum2 + sum3 + sum4 + sum5 + sum6 + sum7;<br/>
}<br/>
</code></p>
<p>Of course, order of floating point additions makes the result pedantically different from original, but if you would be performing vector dot products with constant vectors, you might permute vectors to produce the preferred order of additions.</p>
</div>
<ol class="children">
<li id="comment-314254" class="comment even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-06T14:09:55+00:00">July 6, 2018 at 2:09 pm</time></a> </div>
<div class="comment-content">
<p>Heh. What I thought the compiler was about to do to my code is to break dependencies, but it actually autovectorized the loop, at least on my Mac. This doesn&rsquo;t actually demonstrate what I attempted to do.</p>
</div>
<ol class="children">
<li id="comment-314258" class="comment byuser comment-author-lemire bypostauthor odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-06T14:17:19+00:00">July 6, 2018 at 2:17 pm</time></a> </div>
<div class="comment-content">
<p>Your compiler should autovectorize my original loop too.</p>
</div>
<ol class="children">
<li id="comment-314271" class="comment even depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-06T14:49:04+00:00">July 6, 2018 at 2:49 pm</time></a> </div>
<div class="comment-content">
<p>It doesn&rsquo;t without -ffast-math, because that would violate semantics of floating point math on C.</p>
<p>The following comical contraption autovectorises and removes loop dependencies as far as I can understand on my compiler (Apple LLVM version 9.1.0 (clang-902.0.39.2)), even without -ffast-math. It does stumble a bit at least on my system on final summation, but that&rsquo;s only a minor part of it all:</p>
<p><code>__attribute__((noinline)) float dot(float *x1, float *x2, size_t len) {<br/>
float sum00, sum01, sum02, sum03, sum04, sum05, sum06, sum07;<br/>
float sum10, sum11, sum12, sum13, sum14, sum15, sum16, sum17;<br/>
float sum20, sum21, sum22, sum23, sum24, sum25, sum26, sum27;<br/>
float sum30, sum31, sum32, sum33, sum34, sum35, sum36, sum37;<br/>
float sum40, sum41, sum42, sum43, sum44, sum45, sum46, sum47;<br/>
float sum50, sum51, sum52, sum53, sum54, sum55, sum56, sum57;<br/>
float sum60, sum61, sum62, sum63, sum64, sum65, sum66, sum67;<br/>
float sum70, sum71, sum72, sum73, sum74, sum75, sum76, sum77;<br/>
sum00 = sum01 = sum02 = sum03 = sum04 = sum05 = sum06 = sum07 = 0;<br/>
sum10 = sum11 = sum12 = sum13 = sum14 = sum15 = sum16 = sum17 = 0;<br/>
sum20 = sum21 = sum22 = sum23 = sum24 = sum25 = sum26 = sum27 = 0;<br/>
sum30 = sum31 = sum32 = sum33 = sum34 = sum35 = sum36 = sum37 = 0;<br/>
sum40 = sum41 = sum42 = sum43 = sum44 = sum45 = sum46 = sum47 = 0;<br/>
sum50 = sum51 = sum52 = sum53 = sum54 = sum55 = sum56 = sum57 = 0;<br/>
sum60 = sum61 = sum62 = sum63 = sum64 = sum65 = sum66 = sum67 = 0;<br/>
sum70 = sum71 = sum72 = sum73 = sum74 = sum75 = sum76 = sum77 = 0;<br/>
for (size_t i = 0; i &lt; len;) {<br/>
sum00 += x1[i] * x2[i];<br/>
i++;<br/>
sum01 += x1[i] * x2[i];<br/>
i++;<br/>
sum02 += x1[i] * x2[i];<br/>
i++;<br/>
sum03 += x1[i] * x2[i];<br/>
i++;<br/>
sum04 += x1[i] * x2[i];<br/>
i++;<br/>
sum05 += x1[i] * x2[i];<br/>
i++;<br/>
sum06 += x1[i] * x2[i];<br/>
i++;<br/>
sum07 += x1[i] * x2[i];<br/>
i++;</p>
<p> sum10 += x1[i] * x2[i];<br/>
i++;<br/>
sum11 += x1[i] * x2[i];<br/>
i++;<br/>
sum12 += x1[i] * x2[i];<br/>
i++;<br/>
sum13 += x1[i] * x2[i];<br/>
i++;<br/>
sum14 += x1[i] * x2[i];<br/>
i++;<br/>
sum15 += x1[i] * x2[i];<br/>
i++;<br/>
sum16 += x1[i] * x2[i];<br/>
i++;<br/>
sum17 += x1[i] * x2[i];<br/>
i++;</p>
<p> sum20 += x1[i] * x2[i];<br/>
i++;<br/>
sum21 += x1[i] * x2[i];<br/>
i++;<br/>
sum22 += x1[i] * x2[i];<br/>
i++;<br/>
sum23 += x1[i] * x2[i];<br/>
i++;<br/>
sum24 += x1[i] * x2[i];<br/>
i++;<br/>
sum25 += x1[i] * x2[i];<br/>
i++;<br/>
sum26 += x1[i] * x2[i];<br/>
i++;<br/>
sum27 += x1[i] * x2[i];<br/>
i++;</p>
<p> sum30 += x1[i] * x2[i];<br/>
i++;<br/>
sum31 += x1[i] * x2[i];<br/>
i++;<br/>
sum32 += x1[i] * x2[i];<br/>
i++;<br/>
sum33 += x1[i] * x2[i];<br/>
i++;<br/>
sum34 += x1[i] * x2[i];<br/>
i++;<br/>
sum35 += x1[i] * x2[i];<br/>
i++;<br/>
sum36 += x1[i] * x2[i];<br/>
i++;<br/>
sum37 += x1[i] * x2[i];<br/>
i++;</p>
<p> sum40 += x1[i] * x2[i];<br/>
i++;<br/>
sum41 += x1[i] * x2[i];<br/>
i++;<br/>
sum42 += x1[i] * x2[i];<br/>
i++;<br/>
sum43 += x1[i] * x2[i];<br/>
i++;<br/>
sum44 += x1[i] * x2[i];<br/>
i++;<br/>
sum45 += x1[i] * x2[i];<br/>
i++;<br/>
sum46 += x1[i] * x2[i];<br/>
i++;<br/>
sum47 += x1[i] * x2[i];<br/>
i++;</p>
<p> sum50 += x1[i] * x2[i];<br/>
i++;<br/>
sum51 += x1[i] * x2[i];<br/>
i++;<br/>
sum52 += x1[i] * x2[i];<br/>
i++;<br/>
sum53 += x1[i] * x2[i];<br/>
i++;<br/>
sum54 += x1[i] * x2[i];<br/>
i++;<br/>
sum55 += x1[i] * x2[i];<br/>
i++;<br/>
sum56 += x1[i] * x2[i];<br/>
i++;<br/>
sum57 += x1[i] * x2[i];<br/>
i++;</p>
<p> sum60 += x1[i] * x2[i];<br/>
i++;<br/>
sum61 += x1[i] * x2[i];<br/>
i++;<br/>
sum62 += x1[i] * x2[i];<br/>
i++;<br/>
sum63 += x1[i] * x2[i];<br/>
i++;<br/>
sum64 += x1[i] * x2[i];<br/>
i++;<br/>
sum65 += x1[i] * x2[i];<br/>
i++;<br/>
sum66 += x1[i] * x2[i];<br/>
i++;<br/>
sum67 += x1[i] * x2[i];<br/>
i++;</p>
<p> sum70 += x1[i] * x2[i];<br/>
i++;<br/>
sum71 += x1[i] * x2[i];<br/>
i++;<br/>
sum72 += x1[i] * x2[i];<br/>
i++;<br/>
sum73 += x1[i] * x2[i];<br/>
i++;<br/>
sum74 += x1[i] * x2[i];<br/>
i++;<br/>
sum75 += x1[i] * x2[i];<br/>
i++;<br/>
sum76 += x1[i] * x2[i];<br/>
i++;<br/>
sum77 += x1[i] * x2[i];<br/>
i++;<br/>
}</p>
<p> return<br/>
sum00 + sum10 + sum20 + sum30 + sum40 + sum50 + sum60 + sum70 +<br/>
sum01 + sum11 + sum21 + sum31 + sum41 + sum51 + sum61 + sum71 +<br/>
sum02 + sum12 + sum22 + sum32 + sum42 + sum52 + sum62 + sum72 +<br/>
sum03 + sum13 + sum23 + sum33 + sum43 + sum53 + sum63 + sum73 +<br/>
sum04 + sum14 + sum24 + sum34 + sum44 + sum54 + sum64 + sum74 +<br/>
sum05 + sum15 + sum25 + sum35 + sum45 + sum55 + sum65 + sum75 +<br/>
sum06 + sum16 + sum26 + sum36 + sum46 + sum56 + sum66 + sum76 +<br/>
sum07 + sum17 + sum27 + sum37 + sum47 + sum57 + sum67 + sum77;<br/>
}<br/>
</code></p>
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
<li id="comment-314588" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/14d5cef9d2549ed933b1dd68bf8cabe1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/14d5cef9d2549ed933b1dd68bf8cabe1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">John Campbell</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-07T04:54:05+00:00">July 7, 2018 at 4:54 am</time></a> </div>
<div class="comment-content">
<p>I didn&rsquo;t note the processor you used for the test but my experience (40 years of trying to improve dot_product using Fortran) would suggest a similar conclusion.</p>
<p>Recently, for Intel i5 and i7 processors:</p>
<p>CPU frequency is not significant (but should be for small len?).<br/>
Memory transfer rates are significant (especially for large len).<br/>
L3 cache defines when AVX improvement declines as data must be in cache for AVX+ to work effectively.<br/>
Using !$OMP doesn&rsquo;t help as there is not enough work for each thread to overcome the thread initialisation overhead.</p>
<p>I have been trying to understand how to code the DO (for) loop so the compiler will provide an optimised instruction set for claimed AVX+ support. The advertised performance can be very impressive. Then there is the issue of transferring this calculation into a real code with other memory demands, besides X1 and X2. For me, this remains elusive.</p>
<p>Strategies where the data is blocked to reduce memory &lt;&gt; cache transfers do help. It would be interesting to see test results for architecture with larger cache.</p>
<p>There is also the situation where for multiple CPU : shared memory, what other tasks are running.</p>
</div>
</li>
<li id="comment-315888" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/915d635425bd290ca15a7765a88c8e5f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/915d635425bd290ca15a7765a88c8e5f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.evanjones.ca/" class="url" rel="ugc external nofollow">Evan Jones</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-10T12:59:41+00:00">July 10, 2018 at 12:59 pm</time></a> </div>
<div class="comment-content">
<p>This is a fascinating micro-experiment, thanks! I find trying to understand these things useful for improving my intuition about computer system performance.</p>
<p>The general trend that concerns me is how are we going to make &ldquo;general software&rdquo; faster now that single thread performance is not increasing? As your experiment shows, we can get tremendous improvements (3-7X!) if we use application-specific hardware, but the difficulty of writing the code increases substantially.</p>
<p>I think it is an interesting time to be involved in trying to improve software performance.</p>
</div>
<ol class="children">
<li id="comment-316284" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-11T15:37:03+00:00">July 11, 2018 at 3:37 pm</time></a> </div>
<div class="comment-content">
<p><em>As your experiment shows, we can get tremendous improvements (3-7X!) if we use application-specific hardware, but the difficulty of writing the code increases substantially.</em></p>
<p>Though that&rsquo;s true, I would argue that a lot of energy goes toward making sure that most programmers can get the great performance without having to worry about it. The goal is that few of us should ever need to worry day-to-day about performance so that most programmers can be free to focus on other things.</p>
<p>There is division of labor involved. If you are doing a lot of dot products, you shouldn&rsquo;t write them by hand yourself&#8230; find a library that does it for you.</p>
</div>
</li>
<li id="comment-316285" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-11T15:40:24+00:00">July 11, 2018 at 3:40 pm</time></a> </div>
<div class="comment-content">
<p><a href="https://morepypy.blogspot.com/2018/06/repeating-matrix-multiplication.html" rel="nofollow">PyPy blog</a> recently featured a possibly unintentionally tragicomical comparison of levels of performance between script languages and fine-tuned implementations taking advantage of domain-specific instructions on modern CPUs:</p>
<p><img src="https://1.bp.blogspot.com/-Jy_op9XTgH0/Wyo4IWrqNoI/AAAAAAAAh3w/bVrxPRSCHtY3AB8ITqe-QsqBYWCsGY7cQCPcBGAYYCw/s1600/matmul.png" /></p>
<p>Of course most people understand that implementing matrix multiplication in a scripting language is going to be inefficient, but I suspect many don&rsquo;t quite comprehend how inefficient it can be.</p>
</div>
<ol class="children">
<li id="comment-316286" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-11T15:41:43+00:00">July 11, 2018 at 3:41 pm</time></a> </div>
<div class="comment-content">
<p>Maybe that inline image didn&rsquo;t come through then. Anyway, it&rsquo;s included in the linked blog post.</p>
</div>
<ol class="children">
<li id="comment-316291" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-11T16:04:23+00:00">July 11, 2018 at 4:04 pm</time></a> </div>
<div class="comment-content">
<p>I hacked your comment so that the figure comes up, at least for now.</p>
<blockquote>
<p>Of course most people understand that implementing matrix multiplication in a scripting language is going to be inefficient, but I suspect many don&rsquo;t quite comprehend how inefficient it can be.</p>
</blockquote>
<p>Right. Part of the problem is people tend to use one tool and do everything with this one tool, with no context awareness.</p>
</div>
<ol class="children">
<li id="comment-316803" class="comment odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/915d635425bd290ca15a7765a88c8e5f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/915d635425bd290ca15a7765a88c8e5f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.evanjones.ca/" class="url" rel="ugc external nofollow">Evan Jones</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-13T00:58:44+00:00">July 13, 2018 at 12:58 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m also personally concerned about &ldquo;general application&rdquo; performance, where the CPU time is not spent in a small number of primitives like say deep learning training or large matrix math for scientific simulations. If you look at the profile for busy servers at Internet services (my personal experience), they tend to be fairly flat, with CPU cycles getting spent all over the place. If we want to be able to process more requests, are we just going to need bigger data centers and more electricity if CPUs no longer get faster?</p>
<p>Certainly step one is probably to stop writing these applications in Python and Ruby, as the benchmark mentioned above demonstrates.</p>
</div>
<ol class="children">
<li id="comment-316813" class="comment byuser comment-author-lemire bypostauthor even depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-13T01:50:52+00:00">July 13, 2018 at 1:50 am</time></a> </div>
<div class="comment-content">
<blockquote>
<p>I&rsquo;m also personally concerned about â€œgeneral applicationâ€ performance, where the CPU time is not spent in a small number of primitives</p>
</blockquote>
<p>So my blog post is not representative of actual loads, I am aware of that.</p>
<blockquote>
<p>If we want to be able to process more requests, are we just going to need bigger data centers and more electricity if CPUs no longer get faster?</p>
</blockquote>
<p>For now, electricity bills are not a concern. Chips and electricity are still way, way cheaper than developers for most applications. The big whales (Facebook, Google&#8230;) may have core applications where throwing millions of engineer time at the problem for years makes sense&#8230; but most businesses do not.</p>
<p>Possibly this could change if we get huge AI applications&#8230; but we are not there (except maybe within the core of the whales).</p>
<p>My experience is that most businesses are concerned with quality-of-service issues. They don&rsquo;t mind spinning twice as many cores&#8230; but they do mind having high latency. Throwing more machines at a problem does not make the latency go down magically.</p>
<blockquote>
<p>Certainly step one is probably to stop writing these applications in Python and Ruby, as the benchmark mentioned above demonstrates.</p>
</blockquote>
<p>As you well know, it is entirely possible to get great performance with Python <em>if</em> you have the critical parts written in a faster language.</p>
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
<li id="comment-317001" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0106ac4af74089858b4787c11d468e0a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0106ac4af74089858b4787c11d468e0a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bart Oldeman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-13T17:54:51+00:00">July 13, 2018 at 5:54 pm</time></a> </div>
<div class="comment-content">
<p>Yes for long vectors this is well understood and can be measured using the STREAM benchmark:<br/>
<a href="https://www.cs.virginia.edu/stream/" rel="nofollow ugc">https://www.cs.virginia.edu/stream/</a></p>
<p>For short vectors compiler autovectorization will do an ok job but GCC will not do reductions by default, you need to at least enable -fno-math-errno -fno-signed-zeros -fno-trapping-math -fassociative-math (all a subset of the much more aggressive -ffast-math); #pragma omp simd reduction(+:result) also forces the compiler to vectorize without those flags.</p>
<p>I did some testing to evaluate possibilities for our new Beluga system (for Compute Canada here in Montreal, coming soon &#8212; you should get an account too, it&rsquo;s free for all Canadian academics :), see the table below.</p>
<p>The 6.7 number above looks memory bound, and resonates with the Broadwell number of 17.4 GB/s (2.6GHz * 6.7)</p>
<p>Broadwell = E5-2683 (16 cores/socket, 2 sockets)<br/>
Skylake = Gold 6148 (20 cores/socket, 2 sockets)<br/>
EPYC = EPYC 7601 (32 cores/socket, 2 sockets)<br/>
n Broadwell Skylake EPYC<br/>
1 17.4 10.3 26.2<br/>
2 34.8 20.3 52.2<br/>
4 65.8 40.2 104.4<br/>
6 92.4 59.5<br/>
8 109.8 78.3 207.6<br/>
10 118.3 96.3<br/>
12 120.8 113.4<br/>
14 120.4 130.8<br/>
16 120.3 146.3 271.7<br/>
20 119.3 164.5<br/>
24 118.7 175.1<br/>
28 117.1 179.8<br/>
32 117.0 181.3 279.0<br/>
36 &#8212;&#8211; 181.8<br/>
40 &#8212;&#8211; 183.2<br/>
64 &#8212;&#8211; &#8212;&#8211; 267.6</p>
</div>
<ol class="children">
<li id="comment-317233" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-14T07:15:39+00:00">July 14, 2018 at 7:15 am</time></a> </div>
<div class="comment-content">
<p>I think it&rsquo;s pretty easy to reason that dot product code is always memory bound (when vectorisation tricks are allowed) as, for example on Skylake, reciprocal throughput of multiply-accumulates is two per clock cycle, and each such operation needs two memory reads, but the CPU can perform only two reads per clock cycle, even at the best case scenario when all data is available optimally on L1.</p>
<p>For matrix multiply the scenario is different: for non-small matrices, amount of reads per multiply-accumulate operation can approach 1, which would put memory and computation operations nicely in balance on this microarchitecture. But of course this applies only to operations which can be performed at full L1 access rate!</p>
</div>
</li>
</ol>
</li>
<li id="comment-324174" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-29T01:18:01+00:00">July 29, 2018 at 1:18 am</time></a> </div>
<div class="comment-content">
<p>As with many performance related discussions, one should draw a distinction between <em>latency</em> and <em>throughput</em>.</p>
<p>I think those who say that computation is more likely to bottleneck an algorithm than memory access have a good argument on the throughput side, but not as much on the latency side. This is because memory bandwidth has at least largely kept up with advances in computational speed [2], but latency has not. In fact latency has barely budged in a decade or more. There&rsquo;s some expression about it that I forget, something like &ldquo;More bandwidth is merely expensive, but better latency often can&rsquo;t be had at any price&rdquo;.</p>
<p>Some back of the envelope calculations for bandwidth, CPU vs memory. Current single core bandwidths for recent Intel chips are in the 15 &#8211; 30 GB range. Let&rsquo;s say 20 GB. For a 3 GHz chip, that means about 7 bytes of bandwidth per cycle. On the computation size, if you are using scalar 64-bit instructions, you are going to execute <em>at most</em> 4 per cycle, i.e., 32 bytes of output per cycle, at best. More realistic code with an IPC of 1 will be at 8 bytes per cycle of computation. So we can say the computation/bandwidth ratio is somewhere between 4.8 and 1.2: meaning that each bit of data is touched by more than 4.8 to 1.2 instructions, you are likely to be computation limited, not bandwidth limited.</p>
<p>Certainly most non-trivial algorithms are doing to exceed the low end of that range: it is rare that an algorithm would only execute a single computation on each word of data. In general we could say that except for high IPC, simple code scalar algorithms are likely to be limited by computation in a bandwidth sense. Vectorized codes are another matter, since AVX2 (for example) multiplies this ratio by 4, so there are many interesting algorithms are that are still bandwidth limited (well-implemented dot products being among them) when using SIMD algorithms. On the flip side, many algorithms operate on 32-bit values or even bytes, dividing the ratios discussed by 2 or 8, making them <em>very</em> likely to be computation bound.</p>
<p>Let&rsquo;s do the same calculation for latency!</p>
<p>Most ALU operations on modern chips take 1 cycle, although multiplication and some other operations often take a handful of cycles (3 on modern Intel and AMD), and division is usually much slower at 20 or more cycles. Let&rsquo;s take 1 cycle as typical. A miss to DRAM takes at best 50 nanoseconds or so on the most favorable hardware (which, perhaps unexpectedly, is &ldquo;low-end&rdquo; stuff like client chips) while it approaches or exceeds 100 nanoseconds on heavy-duty hardware (chips with server uncore, multiple sockets, registered DIMMs, etc). Converted into cycles at 3 GHz, that&rsquo;s 150 to 300 cycles.</p>
<p>So the computation/memory ratio now is 150 to 300 for single cycle instructions, or 50 to 100 for 3-cycle instructions. In other worse, close to a couple of orders of magnitude larger than before. Almost any algorithm that is latency bound and includes misses to memory in the dependency chain is likely to be memory bound, unless it is doing a ton of extra work (say at least 100 instructions per retrieved value).</p>
<p>The bandwidth and latency computation/memory ratios have been diverging over time (indeed, back in the days before caches the reciprocal throughput and latency were often identical: one memory access per cycle available that same cycle was common). I expect them to diverge more over time, as computation and bandwidth continues to increase, but latency is likely to stagnate.</p>
<p>A note about multiple cores: the tests above are implicitly for a single core. The pictures changes quite a bit with multiple cores: computation scales almost[Note 1] perfectly with additional cores, but memory bandwidth is generally shared among all cores on a socket. Modern Intel CPUs can&rsquo;t always max out the memory bandwidth with a single core, but usually a few will do it. In particular, a single core may have a bandwidth of 25 GB/s, but the maximum available bandwidth across all cores is only 50 GB/s, so with 10 cores running at once, you&rsquo;ll only have 1/5th the pro rata bandwidth you had in the single core case. This effect is especially pronounced on very high core count chips: chips can have 20+ cores, but no real increase in memory bandwidth over any other quad channel parts (and even the lowliest Intel chips are dual channel, I think, so there&rsquo;s only a 2x scaling in memory bandwidth from a $100 chip to a $10,000 one).</p>
<p>BTW, your test is actually kind of comparing a latency bound computation scenario to a bandwidth bound memory one: AVX2 chips like Skylake can sustain 2 full-width FMAs per cycle (2&#215;8 = 16 total input pairs), so you should be seeing something like 0.0625 cycles per pair (or maybe half that if using separate M and A), rather than 0.55: you get the worse result because the algorithm is bottlenecked on the addition latency with the single accumulator. With a throughput of 2 per cycle but a latency of 4 cycles, you need 8 accumulators (8 parallel computation chains) to get full throughput. The memory accesses aren&rsquo;t part of the chain though (in the dependency graph they are root nodes with no important parents), so they are only throughput limited. So the comparison ended up being between computational latency and memory throughput.</p>
<p>[Note 1] One reason computation resources may not scale perfectly with increasing core usage is variable (lower) turbo ratios when more cores are used, and thermal, power or current limits. These effects are usually in the 10s of percent, however, compared to pro rata bandwidth limits of 5 or 10 <em>times</em> on high core count CPUs.</p>
<p>[Note 2] Here is <a href="https://fgiesen.wordpress.com/2017/04/11/memory-bandwidth/" rel="nofollow">a good blog entry</a> on the topic.</p>
</div>
<ol class="children">
<li id="comment-426509" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b1b7dc4b18224efab9f7dd744b341a02?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b1b7dc4b18224efab9f7dd744b341a02?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Yongkee Kwon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-07T21:04:45+00:00">September 7, 2019 at 9:04 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for the interesting article as always.</p>
<p>I&rsquo;ve enjoyed reading lots of interesting discussions while I am not sure if I entirely agree with all the above. Moreover, I&rsquo;m a bit surprised to see no one brought up a hardware prefetcher in the discussion.</p>
<p>Even when the vectors are big enough not to fit in any of caches, it doesn&rsquo;t mean that the data is brought from memory especially if the test was repeated some number of times (50 in this example?)</p>
<p>I wonder what it would look like if the hardware prefetcher is turned off and if the above conclusions remain same or not.</p>
</div>
</li>
</ol>
</li>
<li id="comment-647378" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8269f4f23b085092b630bc0b80667805?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8269f4f23b085092b630bc0b80667805?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.featurebase.com/about" class="url" rel="ugc external nofollow">HO Maycotte</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-08T14:08:47+00:00">November 8, 2022 at 2:08 pm</time></a> </div>
<div class="comment-content">
<p>This is really interesting, thank you for sharing&#8230;and I especially love your comment that a &ldquo;few of us should ever need to worry day-to-day about performance so that most programmers can be free to focus on other things.”</p>
<p>So my question is this, if you could have a very efficient in memory index for dot products and precompute them ahead of time&#8230;what impact would that have on the end user? At FeatureBase/Pilosa we have been running some experiments on this front recently. </p>
<p>Thanks and I hope all is well!</p>
</div>
<ol class="children">
<li id="comment-647379" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-08T16:47:51+00:00">November 8, 2022 at 4:47 pm</time></a> </div>
<div class="comment-content">
<p><em>if you could have a very efficient in memory index for dot products and precompute them ahead of time…what impact would that have on the end user?</em></p>
<p>I would think that it depends on the size of your inputs. There is probably little value in precomputing the dot-product between small arrays. However, for larger arrays, the memory bandwidth saved could be benefitial.</p>
</div>
</li>
</ol>
</li>
</ol>
