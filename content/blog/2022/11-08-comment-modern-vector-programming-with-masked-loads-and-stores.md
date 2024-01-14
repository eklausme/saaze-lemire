---
date: "2022-11-08 12:00:00"
title: "Modern vector programming with masked loads and stores"
index: false
---

[12 thoughts on &ldquo;Modern vector programming with masked loads and stores&rdquo;](/lemire/blog/2022/11-08-modern-vector-programming-with-masked-loads-and-stores)

<ol class="comment-list">
<li id="comment-647390" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/77e4428df13e21425afb490a7e2098cd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/77e4428df13e21425afb490a7e2098cd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Markus Schaber</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-09T13:02:08+00:00">November 9, 2022 at 1:02 pm</time></a> </div>
<div class="comment-content">
<p>It seems that the footnote is missing, and another sentence is truncated: &ldquo;It could also discourage the&rdquo;.</p>
</div>
<ol class="children">
<li id="comment-647392" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-09T13:15:08+00:00">November 9, 2022 at 1:15 pm</time></a> </div>
<div class="comment-content">
<p>Thanks. These were additional edits that I forgot to discard.</p>
</div>
</li>
</ol>
</li>
<li id="comment-647398" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marcin Zukowski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-09T20:31:56+00:00">November 9, 2022 at 8:31 pm</time></a> </div>
<div class="comment-content">
<p>Pretty cool! </p>
<p>Yeah, reading the tail of a stream is often tricky to get both fast and correct. I&rsquo;ve seen a similar problem for hash functions for short strings, came up with a different approach (probably also applicable here), where we read &ldquo;garbage&rdquo; memory, but we can guarantee it&rsquo;s &ldquo;safe&rdquo; by checking if we&rsquo;re close to the page boundary. I think t1ha folks included that in their project. See here if you&rsquo;re curious: <a href="https://marcinzukowski.github.io/hash-tailer/" rel="nofollow ugc">https://marcinzukowski.github.io/hash-tailer/</a>.</p>
<p>And thanks for your awesome blog posts in general! 🙂</p>
</div>
<ol class="children">
<li id="comment-647399" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-09T20:36:03+00:00">November 9, 2022 at 8:36 pm</time></a> </div>
<div class="comment-content">
<p>Thanks Marcin. You may not remember, but we once spent a week together in Germany !</p>
</div>
<ol class="children">
<li id="comment-647400" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marcin Zukowski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-09T20:38:01+00:00">November 9, 2022 at 8:38 pm</time></a> </div>
<div class="comment-content">
<p>Of course, Dagstuhl, one of my fave places in the world 🙂<br/>
<a href="https://lemire.me/img/news/2018/dagstuhl.18251.04.jpg" rel="ugc">https://lemire.me/img/news/2018/dagstuhl.18251.04.jpg</a></p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-647401" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c037943f040e914d8b8da46c905482c2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c037943f040e914d8b8da46c905482c2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alex Petty</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-09T21:07:12+00:00">November 9, 2022 at 9:07 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve mitigated this problem by manually calling resize() on vectors to enlarge them sufficiently beyond their size such that over-reads are guaranteed to not segfault, but that&rsquo;s an expensive solution if it causes a large copy.</p>
<p>A better solution seems to align every allocation that might be accessed with vectorized loads to the largest vector size that it will be accessed with, because then it&rsquo;s guaranteed that reads of that size will not over-run a page. Easy to do in C with aligned_alloc, unfortunately pretty un-ergonomic to do with vectors in C++. c++17&rsquo;s aligned new helps, but it&rsquo;s still messy: <a href="https://stackoverflow.com/questions/60169819/modern-approach-to-making-stdvector-allocate-aligned-memory" rel="nofollow ugc">https://stackoverflow.com/questions/60169819/modern-approach-to-making-stdvector-allocate-aligned-memory</a></p>
<p>I have not considered any potential downsides of having most large allocations aligned to m512i, if there are any.</p>
</div>
<ol class="children">
<li id="comment-647403" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-09T22:02:48+00:00">November 9, 2022 at 10:02 pm</time></a> </div>
<div class="comment-content">
<p>Overallocation is certainly a viable approach but you cannot always rely on it being done (by libraries you are using).</p>
</div>
</li>
</ol>
</li>
<li id="comment-647422" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dc1e44d52927c340c4f644a5d909c096?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dc1e44d52927c340c4f644a5d909c096?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Matthew Stoltenberg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-10T22:06:31+00:00">November 10, 2022 at 10:06 pm</time></a> </div>
<div class="comment-content">
<p>What I&rsquo;ve found works really well for me at my current job is to write the main part of the loop as an inline function taking the __m512/svfloat32_t registers and any mask/predicates as variables. This allows me to not repeat myself for the main part of the loop and the remainders.</p>
</div>
<ol class="children">
<li id="comment-647423" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-10T22:09:06+00:00">November 10, 2022 at 10:09 pm</time></a> </div>
<div class="comment-content">
<p>I agree that it seems like a good design.</p>
</div>
<ol class="children">
<li id="comment-647434" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marcin Zukowski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-11T00:43:52+00:00">November 11, 2022 at 12:43 am</time></a> </div>
<div class="comment-content">
<p>But doen&rsquo;t that assume that the versions with and without _maskz (on x86) are equivalent in performance? Perhaps they are, but I&rsquo;d double check 🙂</p>
</div>
<ol class="children">
<li id="comment-647435" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-11T01:00:01+00:00">November 11, 2022 at 1:00 am</time></a> </div>
<div class="comment-content">
<p>You should always measure but I believe it is true (so far) and that’s what I claim in the blog post. The computation of the masks is not free, however.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-648011" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c5d744640b5a0d326bf75e5579487324?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c5d744640b5a0d326bf75e5579487324?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://easyperf.net" class="url" rel="ugc external nofollow">Denis Bakhvalov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-28T16:54:04+00:00">November 28, 2022 at 4:54 pm</time></a> </div>
<div class="comment-content">
<p>[A little late to the party&#8230;] Sometimes, those masked load/stores also could become hot if the number of processed elements is low (&lt;16, loop never executes). I solved such an issue simply by allocating 16 dummy bytes (for SSE) at the end to avoid access violations by crossing page boundaries.</p>
</div>
</li>
</ol>
