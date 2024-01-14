---
date: "2015-03-25 12:00:00"
title: "Accelerating intersections with SIMD instructions"
index: false
---

[16 thoughts on &ldquo;Accelerating intersections with SIMD instructions&rdquo;](/lemire/blog/2015/03-25-accelerating-intersections-with-simd-instructions)

<ol class="comment-list">
<li id="comment-153148" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/08273d5f7fe210be4bfcdd60b9b3fe09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/08273d5f7fe210be4bfcdd60b9b3fe09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.jandrewrogers.com/" class="url" rel="ugc external nofollow">J. Andrew Rogers</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-03-25T12:56:12+00:00">March 25, 2015 at 12:56 pm</time></a> </div>
<div class="comment-content">
<p>Superscalar architectures are significantly underexploited in practice, both by compilers and the microarchitectures themselves. While you gain some benefit automatically, the automatic exploitation still misses a large percentage of the internal parallelism available when you have several ALUs per core.</p>
<p>There is an informal discipline around writing C/C++ such that it exposes the ALU parallelism to the CPU while being a trivial and null reorganization of the code. Few people actually write code this way and the idioms are a bit outside the way programmers have learned to write their code; most programmers do not even know how to do it. Nonetheless, coding for ALU saturation reliably delivers 1.5-2x performance relative to what would otherwise be considered to be optimized C algorithms. This kind of uplift is particularly noticeable on more recent Intel cores like Haswell.</p>
<p>Exploiting superscalar microarchitectures has become worse as the number and complexity of the ALUs has increased.</p>
</div>
</li>
<li id="comment-153151" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-03-25T13:24:05+00:00">March 25, 2015 at 1:24 pm</time></a> </div>
<div class="comment-content">
<p>@Andrew</p>
<p>Agreed.</p>
<p>I would add that you do not need to write in C to optimize for superscalar execution. I bet that you can measure the effects in JavaScript these days&#8230;</p>
</div>
</li>
<li id="comment-153296" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/52f85331563403f1b2a2340a5458d48c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/52f85331563403f1b2a2340a5458d48c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ingo LÃ¼tkebohle</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-03-26T04:04:26+00:00">March 26, 2015 at 4:04 am</time></a> </div>
<div class="comment-content">
<p>Sounds interesting 🙂 where can i find more info on this way of coding?</p>
</div>
</li>
<li id="comment-153337" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-03-26T14:28:08+00:00">March 26, 2015 at 2:28 pm</time></a> </div>
<div class="comment-content">
<p>@Ingo</p>
<p>It is a good question.</p>
</div>
</li>
<li id="comment-153379" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2bc8b1ed21554addc6f0fc07c79ee950?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2bc8b1ed21554addc6f0fc07c79ee950?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Rajiv</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-03-26T20:02:36+00:00">March 26, 2015 at 8:02 pm</time></a> </div>
<div class="comment-content">
<p>Great article. For any one looking to find out about techniques/examples of creative uses of SIMD code, I have had a lot of luck looking up literature on gaming engines. An example here is a talk at GDC from an engineer at Insomniac games: <a href="https://deplinenoise.files.wordpress.com/2015/03/gdc2015_afredriksson_simd.pdf" rel="nofollow ugc">https://deplinenoise.files.wordpress.com/2015/03/gdc2015_afredriksson_simd.pdf</a></p>
<p>Game engines are kind of ideal for SIMD usage given they do the same work on a large number of objects over and over. Personally I have had pretty decent luck (more hits than misses) in employing SIMD code in general applications to speed things up. One of the really nice things SIMD code does for you is to make you really think about your memory layout. This kind of data oriented design thinking in my experience leads to great speedups even when it turns out that you cannot use SIMD.</p>
</div>
</li>
<li id="comment-153382" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2bc8b1ed21554addc6f0fc07c79ee950?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2bc8b1ed21554addc6f0fc07c79ee950?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Rajiv</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-03-26T20:08:32+00:00">March 26, 2015 at 8:08 pm</time></a> </div>
<div class="comment-content">
<p>I have also found SIMD to be of great use in encoding/decoding columnar data . Given most applications (even the ones without any disk/network IO) are memory bandwidth bound, encoding columns of data to make such smaller is often a win. SIMD lends itself pretty well for interesting ways to encode and decode such data on the fly without having to resort to full blown compression, which in many cases is way too expensive.<br/>
Daniel I&rsquo;d love to see more articles from you about creative uses of SIMD. You seem to have published a lot of papers where you&rsquo;ve used SIMD instructions to great effect. Great article and hope for more.</p>
</div>
</li>
<li id="comment-153403" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/96112d38f9249b06e6811e5aff6d0113?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/96112d38f9249b06e6811e5aff6d0113?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Philippecp</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-03-26T22:58:22+00:00">March 26, 2015 at 10:58 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve been interested in this paper and library for a while. Unfortunately the code isn&rsquo;t portable as it doesn&rsquo;t compile in MSVC. This is mostly because a few lines of inline assembly instead of intrinsics and some compiler specifics (__builtin_expect, etc.). Is there any plan to make this library portable so it can be more widely used?</p>
</div>
</li>
<li id="comment-153404" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/96112d38f9249b06e6811e5aff6d0113?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/96112d38f9249b06e6811e5aff6d0113?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Philippecp</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-03-26T23:02:59+00:00">March 26, 2015 at 11:02 pm</time></a> </div>
<div class="comment-content">
<p>@Andrew<br/>
Are you referring to the rules that allow for auto vectorization by the compiler like the ones mentioned in this block series:<br/>
<a href="http://blogs.msdn.com/b/nativeconcurrency/archive/2012/04/12/auto-vectorizer-in-visual-studio-11-overview.aspx" rel="nofollow ugc">http://blogs.msdn.com/b/nativeconcurrency/archive/2012/04/12/auto-vectorizer-in-visual-studio-11-overview.aspx</a></p>
</div>
</li>
<li id="comment-153462" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-03-27T08:49:08+00:00">March 27, 2015 at 8:49 am</time></a> </div>
<div class="comment-content">
<p>@Philippecp</p>
<p>As I do not program using MSVC, I rely on contributors (like you) to help with portability.</p>
<p>We have MSVC support for other projects, such as this one&#8230;</p>
<p><a href="https://github.com/lemire/FastPFor" rel="nofollow ugc">https://github.com/lemire/FastPFor</a></p>
<p>With cmake, it is reasonably easy to make portable builds.</p>
<p>I believe that someone could probably get the project to build under MSVC with a few hours of work. If you are interested in helping out, please get in touch!</p>
</div>
</li>
<li id="comment-153771" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-03-30T11:34:07+00:00">March 30, 2015 at 11:34 am</time></a> </div>
<div class="comment-content">
<p>@Philippecp</p>
<p>I have checked in a revision. The code no longer relies on inline assembly and __builtin_expect. So it should definitively be easier to use it with MSVC.</p>
<p>We still lack the build routines which could be provided with cmake.</p>
</div>
</li>
<li id="comment-463597" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1d510e41722c5b7ea95d2bb7ae3d205c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1d510e41722c5b7ea95d2bb7ae3d205c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bogdan Burlacu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-12T13:21:20+00:00">December 12, 2019 at 1:21 pm</time></a> </div>
<div class="comment-content">
<p>Hi,</p>
<p>How about intersecting arrays of 64-bit integers? Any special trick or just replace <code>_mm128</code> instructions with their <code>_mm256</code> counterparts, <code>f</code> suffix for <code>float</code> with <code>d</code> suffix for <code>double</code>, and so on?</p>
<p>Thanks,<br/>
Bogdan</p>
</div>
<ol class="children">
<li id="comment-463642" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-12T14:06:18+00:00">December 12, 2019 at 2:06 pm</time></a> </div>
<div class="comment-content">
<p>Using 64-bit integers reduce the benefits of SIMD instructions. I would first try to reengineer the problem.</p>
</div>
<ol class="children">
<li id="comment-463666" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1d510e41722c5b7ea95d2bb7ae3d205c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1d510e41722c5b7ea95d2bb7ae3d205c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bogdan Burlacu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-12T14:33:23+00:00">December 12, 2019 at 2:33 pm</time></a> </div>
<div class="comment-content">
<p>Thank you for your answer.<br/>
Unfortunately that is not possible &#8212; the values come from hashing a very large number of objects where the number of unique objects might exceed the range of a 32-bit integer. But I am still exploring possible options for re-engineering. I think even without a large benefit a SIMD implementation would still be faster than the scalar version.</p>
</div>
<ol class="children">
<li id="comment-463682" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-12T14:42:05+00:00">December 12, 2019 at 2:42 pm</time></a> </div>
<div class="comment-content">
<p>If you have 64-bit hash values, what is the probability that they will collide on their least significant 32 bits? Is it 1/2^32? Or 2e-8 percent?</p>
</div>
<ol class="children">
<li id="comment-464003" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1d510e41722c5b7ea95d2bb7ae3d205c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1d510e41722c5b7ea95d2bb7ae3d205c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bogdan Burlacu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-12T20:50:02+00:00">December 12, 2019 at 8:50 pm</time></a> </div>
<div class="comment-content">
<p>The author of XXHash (the one I use) claims that &ldquo;no bit can be used as a possible predictor for another bit.&rdquo;<br/>
So my initial guess would be 1/2^32.</p>
<p>However, I did a practical test and I got:</p>
<p>1.161% collision rate on the lower 32-bits for 100M unique 64-bit hash values<br/>
2.305% collision rate for 200M<br/>
3.431% collision rate for 300M</p>
<p>Which leaves me somewhere in the 1e-8 ballpark.<br/>
I am considering whether this is an artifact of how I&rsquo;m doing the hashing. But this means that the SIMD 32-bit intersection would be somewhat lossy.</p>
</div>
<ol class="children">
<li id="comment-464158" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-12T23:06:17+00:00">December 12, 2019 at 11:06 pm</time></a> </div>
<div class="comment-content">
<p>Please see my post: Are 64-bit random identifiers free from collision? <a href="https://lemire.me/blog/2019/12/12/are-64-bit-random-identifiers-free-from-collision/" rel="ugc">https://lemire.me/blog/2019/12/12/are-64-bit-random-identifiers-free-from-collision/</a></p>
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
