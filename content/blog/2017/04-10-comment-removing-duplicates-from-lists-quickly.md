---
date: "2017-04-10 12:00:00"
title: "Removing duplicates from lists quickly"
index: false
---

[13 thoughts on &ldquo;Removing duplicates from lists quickly&rdquo;](/lemire/blog/2017/04-10-removing-duplicates-from-lists-quickly)

<ol class="comment-list">
<li id="comment-277717" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1e5aa68931fd6f60e25314cc2f18d12b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1e5aa68931fd6f60e25314cc2f18d12b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://beza1e1.tuxen.de" class="url" rel="ugc external nofollow">qznc</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-10T18:02:31+00:00">April 10, 2017 at 6:02 pm</time></a> </div>
<div class="comment-content">
<p>As a compiler writer, I can nitpick a little about your &ldquo;branchless&rdquo; version. It does not matter for optimizing compilers, if you use a conditional &ldquo;newv != oldv&rdquo; as an if condition or not. The significant change is to make the store instruction unconditional (moving it out of the if branch). So `if (newv != oldv) { pos++; }` should be as fast as hope_unique.</p>
</div>
</li>
<li id="comment-277718" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://boytsov.info" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-10T18:13:01+00:00">April 10, 2017 at 6:13 pm</time></a> </div>
<div class="comment-content">
<p>Great point, but does the optimizing compiler completely removes the branching operation in this case (and also in the case of a ternary operator)? Could it be (I am just perhaps fantasizing) that CPU&rsquo;s can somehow optimize pipeline in the case of short jumps (without further branches?). For example, if you need to skip a few instructions, you don&rsquo;t need to purge the pipeline completely, it likely already started processing instructions after the short jump. So, if the jump happens when it&rsquo;s not expected, we can simply add a few micro-commands and continue (and remove commands from the failed branch). This should be much faster, right?</p>
</div>
<ol class="children">
<li id="comment-277725" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-10T19:57:58+00:00">April 10, 2017 at 7:57 pm</time></a> </div>
<div class="comment-content">
<p><em>does the optimizing compiler completely removes the branching operation</em></p>
<p>Yes as far as the assembly being produced. However different compilers implement it differently. The Intel compiler seems to rely on <tt>cmov</tt> whereas GCC favors <tt>setne</tt> followed by a move.</p>
<p><em>For example, if you need to skip a few instructions, you don&rsquo;t need to purge the pipeline completely, it likely already started processing instructions after the short jump. So, if the jump happens when it&rsquo;s not expected, we can simply add a few micro-commands and continue (and remove commands from the failed branch). This should be much faster, right?</em></p>
<p>In this case, there is data dependency between the steps, plus we have memory accesses.</p>
</div>
</li>
</ol>
</li>
<li id="comment-277719" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://boytsov.info" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-10T18:14:53+00:00">April 10, 2017 at 6:14 pm</time></a> </div>
<div class="comment-content">
<p>Nice post, great that you publish the AVX code. Would you care to elaborate what it does at a high level? I think this would be quite helpful.</p>
</div>
<ol class="children">
<li id="comment-277720" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-10T18:17:49+00:00">April 10, 2017 at 6:17 pm</time></a> </div>
<div class="comment-content">
<p>I really should explain it better, shouldn&rsquo;t I? More later&#8230;</p>
</div>
<ol class="children">
<li id="comment-277724" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://boytsov.info" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-10T19:43:45+00:00">April 10, 2017 at 7:43 pm</time></a> </div>
<div class="comment-content">
<p>This would helpful, please, also see my other question above. I didn&rsquo;t check this, but does CPU really have a branchless increment that can be used instead of the explicit branch that would be otherwise used to implement a ternary operator?</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-277729" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/80217f5897e4d7508f00e827ddbc2d80?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/80217f5897e4d7508f00e827ddbc2d80?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ian Henderson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-10T22:27:06+00:00">April 10, 2017 at 10:27 pm</time></a> </div>
<div class="comment-content">
<p>Could you rearrange uniqshuf to avoid the call to _mm256_permutevar8x32_epi32(recon,mbom)?</p>
</div>
<ol class="children">
<li id="comment-277730" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-10T22:28:25+00:00">April 10, 2017 at 10:28 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t see how, but I&rsquo;d be interested in any alternative design you might have.</p>
</div>
</li>
</ol>
</li>
<li id="comment-277733" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8555deac4af7df1dcd2e8ce693d2a9ba?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8555deac4af7df1dcd2e8ce693d2a9ba?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Matt</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-10T23:06:11+00:00">April 10, 2017 at 11:06 pm</time></a> </div>
<div class="comment-content">
<p>If you remove duplicates by sorting the vector first, then isn&rsquo;t the O( n.log(n) ) sort going to be the slow part, rather than the subsequent O(n) removal of adjacent duplicates?</p>
<p>For sufficiently large n I&rsquo;d have expected using an O(n) hash set to be faster because you don&rsquo;t need to sort the input first. I&rsquo;d also expect a hash set to be hard to vectorize however. I wonder how big n has to be before a hash set is faster in practice.</p>
</div>
</li>
<li id="comment-277756" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e133b3d131cabd6352c2be948252c58d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e133b3d131cabd6352c2be948252c58d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://vittorioromeo.info" class="url" rel="ugc external nofollow">Vittorio Romeo</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-11T11:12:01+00:00">April 11, 2017 at 11:12 am</time></a> </div>
<div class="comment-content">
<p>Nice post. Did you submit the &ldquo;branchless&rdquo; improvements to libstdc++/libc++?</p>
</div>
<ol class="children">
<li id="comment-277767" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-11T13:46:28+00:00">April 11, 2017 at 1:46 pm</time></a> </div>
<div class="comment-content">
<p>It is possible that this type of optimization violates the STL specification.</p>
<p>STL is not designed to be as fast as possible, but rather to be as generic as possible.</p>
</div>
</li>
</ol>
</li>
<li id="comment-277800" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eb8534c32c33f1823c5cc1b2f9055d4a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eb8534c32c33f1823c5cc1b2f9055d4a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jerry Coffin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-11T20:45:27+00:00">April 11, 2017 at 8:45 pm</time></a> </div>
<div class="comment-content">
<p>&gt; In C++, we have an STL function for this very purpose: std::unique. On a recent Intel processor, it takes over 11 cycles per value in the array. </p>
<p>You really need to qualify this much more carefully. In particular, there is no &ldquo;it&rdquo; to discuss here. There are several different implementations of the standard library. You may be using one that happens to run at this speed&#8211;but I might be using one that&rsquo;s half as fast, or twice as fast (or might use AVX code to implement it, so it&rsquo;s the same speed as your fastest version).</p>
<p>The standard specifies an interface. It does include complexity guarantees, but producing the best implementation for a particular target (architecture, OS, whatever) is left to&#8230;the implementation.</p>
</div>
<ol class="children">
<li id="comment-277805" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-11T21:10:45+00:00">April 11, 2017 at 9:10 pm</time></a> </div>
<div class="comment-content">
<p>You are correct. I am taking liberties, but I justify it by providing convenient access to my source code.</p>
</div>
</li>
</ol>
</li>
</ol>
