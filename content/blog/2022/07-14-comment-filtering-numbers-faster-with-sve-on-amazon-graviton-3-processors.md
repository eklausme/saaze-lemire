---
date: "2022-07-14 12:00:00"
title: "Filtering numbers faster with SVE on Graviton 3 processors"
index: false
---

[6 thoughts on &ldquo;Filtering numbers faster with SVE on Graviton 3 processors&rdquo;](/lemire/blog/2022/07-14-filtering-numbers-faster-with-sve-on-amazon-graviton-3-processors)

<ol class="comment-list">
<li id="comment-639486" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Joern Engel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-14T16:37:20+00:00">July 14, 2022 at 4:37 pm</time></a> </div>
<div class="comment-content">
<p>&gt; since it is best on</p>
<p>I suspect you meant &ldquo;based on&rdquo;.</p>
</div>
<ol class="children">
<li id="comment-639488" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-14T16:43:27+00:00">July 14, 2022 at 4:43 pm</time></a> </div>
<div class="comment-content">
<p>Correct. Thanks.</p>
</div>
</li>
</ol>
</li>
<li id="comment-639627" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Joern Engel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-15T16:50:37+00:00">July 15, 2022 at 4:50 pm</time></a> </div>
<div class="comment-content">
<p>Thank you both for doing this work!</p>
<p>I was rather impressed with SVE and thought of it as a clearly superior vector instruction set. Having to do manual loop unrolling for performance would negate much of what makes SVE such a nice instruction set.</p>
<p>It is notable, however, that the problem you benchmarked is basically two instructions, plus a load/store pair, plus loop overhead. Most actual code I deal with is much larger, reducing the relative cost of the loop overhead. That also reduces the benefit of loop unrolling and I would typically not bother.</p>
<p>Even if some loops are as simple as your example, they typically don&rsquo;t dominate runtime and one should concentrate more on other code. So after my initial shock, I don&rsquo;t think this is such a big problem for SVE.</p>
<p>Still, good to know how about such problems. Thank you for highlighting them!</p>
</div>
<ol class="children">
<li id="comment-639629" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-15T16:55:32+00:00">July 15, 2022 at 4:55 pm</time></a> </div>
<div class="comment-content">
<p>My post is not meant to imply that there is a problem with SVE.</p>
</div>
</li>
<li id="comment-639778" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-16T23:58:22+00:00">July 16, 2022 at 11:58 pm</time></a> </div>
<div class="comment-content">
<p>I would disagree that small loops like this are uncommon.</p>
<p>Small loops like this are common, and form the basis for optimized versions of common library routines like memcpy, strlen, memchr, and routines in higher level languages, etc. They also form important primitives in applications like databases where you might wish to take the bitwise AND or OR of two bitmaps, etc.</p>
<p>Furthermore, small loops are the ones where you stand the best chance of getting a good auto-vectorization out of the compiler, further increasing their importance under vectorization.</p>
<p>In my experience there is a *huge* amount to gain from modest unrolls of 2-8 iterations of many real-world vectorized (and not vectorized) loops, even without SVE.</p>
</div>
<ol class="children">
<li id="comment-639818" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5b398936012c5ab568223ef64750d802?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5b398936012c5ab568223ef64750d802?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Samuel Lee</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-17T15:57:13+00:00">July 17, 2022 at 3:57 pm</time></a> </div>
<div class="comment-content">
<p>Indeed! Being able to handle small buffer tail of an otherwise unrolled loop with a few predicated SVE instructions is much cleaner than having to fall back to scalar code.</p>
<p>For large inputs, unrolling can definitely be beneficial; not only do you reduce the proportion of instructions that are doing the loop handling, in many cases you can reduce the dependencies between instructions (e.g. if instructions in the body of the loop depends on the loop counter, you can end up serializing on updates to the loop counter, reducing the ability to take advantage of instruction-level-parallelism).<br/>
These benefits are independent of the instruction set, provided you have enough registers to play with.</p>
<p>In this case it also a benefit because the throughput of predicate handling instructions appears to be limited for the V1, and in the unrolled loop we can make assumptions to reduce proportion of instructions that use this critical resource.</p>
<p>I think ideally compilers would be able to automatically do this sort of unrolling of SVE code in the future (whether autovectorized or intrinsics).</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
