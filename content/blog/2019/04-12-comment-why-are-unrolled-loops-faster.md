---
date: "2019-04-12 12:00:00"
title: "Why are unrolled loops faster?"
index: false
---

[7 thoughts on &ldquo;Why are unrolled loops faster?&rdquo;](/lemire/blog/2019/04-12-why-are-unrolled-loops-faster)

<ol class="comment-list">
<li id="comment-401244" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/43b40b1378619120f3b1d675783a4597?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/43b40b1378619120f3b1d675783a4597?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">IraqiGeek</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-12T18:44:40+00:00">April 12, 2019 at 6:44 pm</time></a> </div>
<div class="comment-content">
<p>How does this compare with unrolling using fmadd in SSE/AVX?</p>
</div>
<ol class="children">
<li id="comment-401246" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-12T18:54:24+00:00">April 12, 2019 at 6:54 pm</time></a> </div>
<div class="comment-content">
<p>Though SIMD instructions and the corresponding vectorization of the code are a form of &ldquo;loop unrolling&rdquo;, I implicitly ignored them for the purpose of this blog post (if you check my code, you&rsquo;ll notice that I deliberately disabled vectorization).</p>
<p>This being said, it would not change the story much: the reason vectorization speed things up is because it drastically reduces the number of instructions.</p>
</div>
</li>
</ol>
</li>
<li id="comment-401278" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/140c172be34a81d70d242a606aee156f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/140c172be34a81d70d242a606aee156f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://8ch.net/tech/index.html" class="url" rel="ugc external nofollow">Anon</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-12T21:44:46+00:00">April 12, 2019 at 9:44 pm</time></a> </div>
<div class="comment-content">
<p>Why doesn&rsquo;t the processor have for loops built in? Set the amount of instructions per loop and how many iterations and then start the loop. This gets you the best of both worlds. Less overhead from running compare and jump instructions and less overhead from the total size of the instructions.</p>
</div>
<ol class="children">
<li id="comment-401286" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-12T22:44:14+00:00">April 12, 2019 at 10:44 pm</time></a> </div>
<div class="comment-content">
<p>Processors do have optimizations specific to loops, but there is always some overhead. No free lunch.</p>
</div>
</li>
</ol>
</li>
<li id="comment-401285" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/362d00b93614534c0c1c2d5470bfcbb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/362d00b93614534c0c1c2d5470bfcbb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Robert</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-12T22:39:57+00:00">April 12, 2019 at 10:39 pm</time></a> </div>
<div class="comment-content">
<p>Also, branch predictions &#8230;</p>
</div>
</li>
<li id="comment-401326" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a71222d2ebb9a8e48389634656f86167?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a71222d2ebb9a8e48389634656f86167?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Pan Zhang</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-13T03:47:38+00:00">April 13, 2019 at 3:47 am</time></a> </div>
<div class="comment-content">
<p>Well, I think the processor probably has a micro architecture component called Loop Stream Detector(LSD) to help detect the loop and cache all the instruction decoding results for next iteration. Therefore, the performance improvement of unrolled loop does not come from fewer instructions to be executed and on the contrary, it is the more instructions needed to be executed in one iteration enables the possibilities for CPU back-end to execute in a more parallel manner.</p>
</div>
<ol class="children">
<li id="comment-401408" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-13T13:58:59+00:00">April 13, 2019 at 1:58 pm</time></a> </div>
<div class="comment-content">
<p>My expectation goes into the other direction. Techniques like LSD are meant to accelerate tight loops. If you unroll too much, you lose these processor optimizations.</p>
</div>
</li>
</ol>
</li>
</ol>
