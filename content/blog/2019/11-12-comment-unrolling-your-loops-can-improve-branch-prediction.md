---
date: "2019-11-12 12:00:00"
title: "Unrolling your loops can improve branch prediction"
index: false
---

[10 thoughts on &ldquo;Unrolling your loops can improve branch prediction&rdquo;](/lemire/blog/2019/11-12-unrolling-your-loops-can-improve-branch-prediction)

<ol class="comment-list">
<li id="comment-442483" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/474da44d45521246767ce75b7e4934e6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/474da44d45521246767ce75b7e4934e6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Michael R. Schmidt</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-12T23:38:33+00:00">November 12, 2019 at 11:38 pm</time></a> </div>
<div class="comment-content">
<p>Also, not branching (unrolling) is faster than branching.</p>
</div>
</li>
<li id="comment-442726" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://boytsov.info" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-14T02:10:38+00:00">November 14, 2019 at 2:10 am</time></a> </div>
<div class="comment-content">
<p>Interestingly, with simpler stuff, loop unrolling stopped be helpful quite a while ago. Perhaps, a compiler has been doing a better job compared to manual unrolling. What difference does it make here? The fact that there&rsquo;s a conditional?</p>
</div>
<ol class="children">
<li id="comment-443103" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-14T22:41:57+00:00">November 14, 2019 at 10:41 pm</time></a> </div>
<div class="comment-content">
<p>Loop unrolling significantly improves performance indeed. LLVM unrolls loops even with -O2 nowadays. Several targets are enabling it for -O2 in GCC10, motivated by higher SPEC scores.</p>
<p>Generally unrolling reduces instruction counts and branches, improves load/store addressing (eg. merging 2 loads or stores into a load-pair or store-pair instruction) and enables more instruction level parallellism.</p>
<p>The gain in this case is that removing the loop branch almost doubles the number of bits of the the branch history. This is used like a hash into the branch predictor tables, so more useful bits means it can not only remember more branches but also predict them better &#8211; much better in this case!</p>
</div>
<ol class="children">
<li id="comment-443119" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://boytsov.info" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-14T23:56:56+00:00">November 14, 2019 at 11:56 pm</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s a great point about increased capacity. However, if the loop is unrolled automatically, this would be true too. Apparently, GCC is more conservative in unrolling such loops?</p>
</div>
<ol class="children">
<li id="comment-443364" class="comment even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-15T10:59:01+00:00">November 15, 2019 at 10:59 am</time></a> </div>
<div class="comment-content">
<p>Well GCC does not unroll at all at any optimization level if you don&rsquo;t add -funroll-loops. However this will change with GCC10 for targets like AArch64 and Power which will unroll small loops with -O2 and higher.</p>
</div>
<ol class="children">
<li id="comment-443403" class="comment byuser comment-author-lemire bypostauthor odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-15T13:04:50+00:00">November 15, 2019 at 1:04 pm</time></a> </div>
<div class="comment-content">
<p>Are you implying that it won&rsquo;t unroll under x64?</p>
</div>
<ol class="children">
<li id="comment-443472" class="comment even depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-15T15:29:48+00:00">November 15, 2019 at 3:29 pm</time></a> </div>
<div class="comment-content">
<p>Basically yes. GCC does not unroll most loops even at -03. It will unroll if you ask it to with -funroll-loops, or if you use profile guided optimization.</p>
<p>There are some exceptions:</p>
<p>Small compile-time-known tripcount loops may be fully unrolled (no loop remains).<br/>
When loops are vectorized, they are implicitly unrolled since you need 4 or 8 or whatever iterations of the scalar loop to make a single vector iteration (however, unlike clang, the vector body isn&rsquo;t further unrolled).</p>
</div>
<ol class="children">
<li id="comment-447521" class="comment odd alt depth-7">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://boytsov.info" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-18T05:37:28+00:00">November 18, 2019 at 5:37 am</time></a> </div>
<div class="comment-content">
<p>Travis, great observation. Ok, now I see why some loops are unrolled (I was recently interested primarily in those that CAN be vectorized). Clearly, it&rsquo;s nearly impossible to vectorize if the loop has conditionals. But, if you unroll these, you get better branch prediction (great to know).</p>
</div>
</li>
</ol>
</li>
<li id="comment-443553" class="comment even depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-15T21:11:45+00:00">November 15, 2019 at 9:11 pm</time></a> </div>
<div class="comment-content">
<p>Indeed, GCC&rsquo;s x86 developers seem opposed to the idea of unrolling eventhough there is clear evidence it helps modern cores&#8230;</p>
<p>Note eventhough LLVM unrolls loops by default, it&rsquo;s not able to unroll this particular loop, not even with -funroll-all-loops, while GCC does it with -funroll-loops.</p>
</div>
<ol class="children">
<li id="comment-448002" class="comment odd alt depth-7">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-20T00:27:01+00:00">November 20, 2019 at 12:27 am</time></a> </div>
<div class="comment-content">
<p>There is clear evidence that unrolling some loops helps on modern codes.</p>
<p>The evidence is less clear that aggressively unrolling all loops helps.</p>
<p>Almost every loop is helped, in isolation, by unrolling. Many loops hurt, when in a real application, by unrolling.</p>
<p>I don&rsquo;t think the compiler vendors can solve that compromise: there is no absolutely correct answer. clang errs one way, gcc another. There is no happy medium because the right answer for a single function can be different depending on the application it is ultimately compiled into.</p>
<p>Only full LTO combined with full and accurate PGO can solve this, so we might as well give on up that dream for now. We have to rely on developers to annotate key loops.</p>
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
</li>
</ol>
