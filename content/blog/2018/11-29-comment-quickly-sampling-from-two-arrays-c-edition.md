---
date: "2018-11-29 12:00:00"
title: "Quickly sampling from two arrays (C++ edition)"
index: false
---

[6 thoughts on &ldquo;Quickly sampling from two arrays (C++ edition)&rdquo;](/lemire/blog/2018/11-29-quickly-sampling-from-two-arrays-c-edition)

<ol class="comment-list">
<li id="comment-369650" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cc512c7233a3265baf43e60eba520c4a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cc512c7233a3265baf43e60eba520c4a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">A Subscriber</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-01T15:11:00+00:00">December 1, 2018 at 3:11 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t think the reservoir sampling is suitable here: the technique was explicitly designed to handle situations where the exact population size, N, is not known upfront. In particular it requires N steps in every N-choose-K scenario, even when only K steps are necessary. I believe Floyd&rsquo;s sampling algorithm should work better, since it is explicitly O(K).</p>
</div>
<ol class="children">
<li id="comment-369653" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-01T15:24:38+00:00">December 1, 2018 at 3:24 pm</time></a> </div>
<div class="comment-content">
<p>You are correct that reservoir sampling is applicable even when the size of the array is unknown. I don&rsquo;t think that it makes it unadvisable in other instances.</p>
<p>In my context, I am interested in sampling a fixed fraction of the input array (e.g., 50%). In such cases, the best possible complexity is linear in the size of the input.</p>
<p>My choice of algorithms and my implementation is surely not optimal, and certainly not in all cases. I&rsquo;d be very interested in a new, better implementation that can beat the 12 CPU cycles per input element I get. Can you please provide a code sample that I can benchmark?</p>
</div>
<ol class="children">
<li id="comment-369681" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cc512c7233a3265baf43e60eba520c4a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cc512c7233a3265baf43e60eba520c4a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">A Subscriber</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-01T17:35:35+00:00">December 1, 2018 at 5:35 pm</time></a> </div>
<div class="comment-content">
<p>I apologize for jumping to conclusions way too quickly and for shouting too loudly. 🙁</p>
<p>You are certainly correct that changing the sampling algorithm would buy absolutely nothing in the 50% case. Specifically, reservoir sampling requires N-K RNG calls while Floyd&rsquo;s requires K. Obviously, these are exactly same numbers.</p>
<p>I am very sorry for not paying attention.</p>
</div>
<ol class="children">
<li id="comment-369686" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-01T18:10:29+00:00">December 1, 2018 at 6:10 pm</time></a> </div>
<div class="comment-content">
<p>Your comment was interesting and forced me to elaborate on the context.</p>
<p>When sampling small numbers of values, you are quite correct that my approach would be inefficient.</p>
<p>Thanks for commenting.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-369800" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8e1cce73399411748ed72e9a20e8e405?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8e1cce73399411748ed72e9a20e8e405?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Daniel Watson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-02T05:38:05+00:00">December 2, 2018 at 5:38 am</time></a> </div>
<div class="comment-content">
<p>This seems like a good opportunity for the <a href="https://arxiv.org/pdf/1508.03167.pdf#page4" rel="nofollow"><code>Merge</code> algorithm</a> from the merge shuffle paper. It merges two shuffled arrays into a single shuffled array. (It can also be vectorized with AVX and likely quite well with AVX512).</p>
<p>Unfortunately it requires N-permutations of the two source arrays. Vectorized shuffling would help but with large arrays random memory access might slow things down.</p>
<p>A quick impl of <code>Merge</code> + <code>sse41_xorshift128plus_partialshuffle32</code> shows ~3.8 speedup, using your code.</p>
</div>
<ol class="children">
<li id="comment-370745" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8e1cce73399411748ed72e9a20e8e405?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8e1cce73399411748ed72e9a20e8e405?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Daniel Watson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-06T01:56:59+00:00">December 6, 2018 at 1:56 am</time></a> </div>
<div class="comment-content">
<p>Turns out a vectorized reservoir sampling (with <code>_mm_maskstore_ps</code>) is even faster, by about 2.5x.</p>
</div>
</li>
</ol>
</li>
</ol>
