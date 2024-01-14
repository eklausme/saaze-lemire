---
date: "2016-12-30 12:00:00"
title: "Can your C compiler vectorize a scalar product?"
index: false
---

[11 thoughts on &ldquo;Can your C compiler vectorize a scalar product?&rdquo;](/lemire/blog/2016/12-30-can-your-c-compiler-vectorize-a-scalar-product)

<ol class="comment-list">
<li id="comment-264183" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6ae3697b2cf910eb587338b46daf7856?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6ae3697b2cf910eb587338b46daf7856?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">G.T.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-30T12:10:14+00:00">December 30, 2016 at 12:10 pm</time></a> </div>
<div class="comment-content">
<p>Can gcc similarly vectorize comlpex version of this code?</p>
</div>
<ol class="children">
<li id="comment-264211" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-30T17:47:52+00:00">December 30, 2016 at 5:47 pm</time></a> </div>
<div class="comment-content">
<p>GCC can vectorize, but not as well as clang.</p>
</div>
</li>
</ol>
</li>
<li id="comment-264194" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Leonid Boytsov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-30T15:42:30+00:00">December 30, 2016 at 3:42 pm</time></a> </div>
<div class="comment-content">
<p>Ohhh wow. This is interesting from several points of view. We have been trying for a while to speed up scalar product with AVX. The gains were only marginal (say 10-20%). However, this version is, indeed, faster. So, this is the first piece of code useful to me, where AVX is much faster.</p>
<p>Second, auto-vectorization is actually quite unreliable. For one thing, only very simple things can be vectorized. For another, what I noticed that it varies quite a bit accross compilers. Your example is great, because the new Clang does use a new command, the gcc (4.x and 5.x alike) does not! What is worse, older versions of Clang sometimes refused to vectorize even scalar products and similar simple things. So, basically, you shouldn&rsquo;t rely on the compiler.</p>
<p>Third, it is obvious that when things became so messy, the Intel architecture is up for a huge redesign. They can&rsquo;t pile one set of crutches over another one. SIMD should be implemented in a more generic fashion.</p>
</div>
<ol class="children">
<li id="comment-264200" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2904f5a6298e35c50e5f3ff44617310b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2904f5a6298e35c50e5f3ff44617310b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Arun Nair</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-30T16:52:55+00:00">December 30, 2016 at 4:52 pm</time></a> </div>
<div class="comment-content">
<p>@Leonid:<br/>
I&rsquo;m not a compiler expert, but in general, a requirement for autovectorization is the absence of loop-carried dependencies across adjacent loops (i.e. one iteration of the loop should be independent of the other). In this case, the compiler will unroll the loop and group instructions together in a SIMD fashion. One has to do the same thing to get one&rsquo;s code accelerated on a GPGPU (that, and more). </p>
<p>Intel&rsquo;s icc compiler generally does a far better job of autovectorization than clang or gcc. Perhaps it identifies vectorization opportunities better than clang/gcc. It does vary greatly between versions of compilers presumably because these capabilities are getting added over time. </p>
<p>Finally, stating the obvious, but vectorization will only really help you if your code is bottlenecked by compute, and not waiting on memory.</p>
</div>
<ol class="children">
<li id="comment-264208" class="comment byuser comment-author-lemire bypostauthor even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-30T17:45:21+00:00">December 30, 2016 at 5:45 pm</time></a> </div>
<div class="comment-content">
<p><em>Intel&rsquo;s icc compiler generally does a far better job of autovectorization than clang or gcc. </em></p>
<p>Though I do not report my results with Intel&rsquo;s icc, I tested it and it did no better than GCC. They are both bested by clang.</p>
</div>
<ol class="children">
<li id="comment-264219" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2904f5a6298e35c50e5f3ff44617310b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2904f5a6298e35c50e5f3ff44617310b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Arun Nair</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-30T19:16:45+00:00">December 30, 2016 at 7:16 pm</time></a> </div>
<div class="comment-content">
<p>Ah, yes, I should&rsquo;ve compared the disassembly in the compiler explorer itself. Since sum is a loop-carried dependence, the common loop-unrolling trick doesn&rsquo;t work. From glancing at the disassembly, clang&rsquo;s output does a vectorized reduction until the iteration count is less than 32, and then switches to scalar for the final reduction. </p>
<p>As a very basic experiment, if you replace &ldquo;sum&rdquo; in your code with another array that is indexed by variable &ldquo;k&rdquo; in an outer for loop, or pass sum as a pointer into the function, the vectorization goes away. It may be due to the conservatism around pointer aliasing, or that clang is looking for a very specific pattern that looks like a reduction. Even so, very impressive. </p>
<p>In general, however, my experience has been that icc does (or at least did a year ago) vectorize much better than gcc and clang in the general case.</p>
</div>
<ol class="children">
<li id="comment-264222" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2904f5a6298e35c50e5f3ff44617310b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2904f5a6298e35c50e5f3ff44617310b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Arun Nair</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-30T19:28:28+00:00">December 30, 2016 at 7:28 pm</time></a> </div>
<div class="comment-content">
<p>PS: If you don&rsquo;t pass the outer array (indexed on k, as noted above) as a parameter (malloc internally and return a pointer), it vectorizes fine. So, I think it&rsquo;s the passing a pointer part that trips it up. </p>
<p>Thanks, I learned something today 🙂</p>
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
<li id="comment-264203" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2904f5a6298e35c50e5f3ff44617310b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2904f5a6298e35c50e5f3ff44617310b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Arun Nair</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-30T17:02:13+00:00">December 30, 2016 at 5:02 pm</time></a> </div>
<div class="comment-content">
<p>Daniel: Here&rsquo;s a link to ffast-math. <a href="https://gcc.gnu.org/wiki/FloatingPointMath" rel="nofollow ugc">https://gcc.gnu.org/wiki/FloatingPointMath</a>. You may get a different result from the unvectorized version of this code due to rounding issues in floating point (a*b+a*c != a*(b+c) in FP). Vectorization may result in arithmetic order being changed (mathematically correct if you had infinite precision FP). It also treats denormals (very small fractions) as zero. Most scientific code is OK with this, but it&rsquo;s something to be aware of.</p>
</div>
</li>
<li id="comment-264575" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e5ffde6fe345b8db1a14c4393e41aac8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e5ffde6fe345b8db1a14c4393e41aac8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">me</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-03T22:04:44+00:00">January 3, 2017 at 10:04 pm</time></a> </div>
<div class="comment-content">
<p>Many data sets will be low-dimensional (say, less than 8 dimensions), or will use spare representations.</p>
</div>
<ol class="children">
<li id="comment-264590" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-04T02:12:08+00:00">January 4, 2017 at 2:12 am</time></a> </div>
<div class="comment-content">
<p>This is a microbenchmark but some applications will definitively benefit from vectorized scalar products.</p>
</div>
</li>
<li id="comment-265616" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Leonid Boytsov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-12T01:51:58+00:00">January 12, 2017 at 1:51 am</time></a> </div>
<div class="comment-content">
<p>For sparse representation, vectorization is also possible (see, e.g., <a href="https://github.com/searchivarius/nmslib/blob/master/similarity_search/src/distcomp_sparse_scalar_fast.cc" rel="nofollow ugc">https://github.com/searchivarius/nmslib/blob/master/similarity_search/src/distcomp_sparse_scalar_fast.cc</a>), but it currently won&rsquo;t be autovectorized.</p>
</div>
</li>
</ol>
</li>
</ol>
