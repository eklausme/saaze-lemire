---
date: "2016-09-28 12:00:00"
title: "Sorting already sorted arrays is much faster?"
index: false
---

[10 thoughts on &ldquo;Sorting already sorted arrays is much faster?&rdquo;](/lemire/blog/2016/09-28-sorting-already-sorted-arrays-is-much-faster)

<ol class="comment-list">
<li id="comment-253800" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-28T16:19:36+00:00">September 28, 2016 at 4:19 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve tried to find a difference between Dutch National Flag algorithms based on the number of swaps they do, but nothing seemed to show up in the timings. </p>
<p>String sorting is also particularly interesting on current architectures, for both caching and branch prediction reasons. </p>
<p>One typo to note: you put an n in front of &ldquo;log n is 20&rdquo;.</p>
</div>
<ol class="children">
<li id="comment-253804" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-28T17:00:40+00:00">September 28, 2016 at 5:00 pm</time></a> </div>
<div class="comment-content">
<p>Variable-length or very long strings can make it hard for the processor to look ahead. That&rsquo;s why it is a good idea to get rid of strings when you can.</p>
</div>
<ol class="children">
<li id="comment-253823" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-28T19:34:08+00:00">September 28, 2016 at 7:34 pm</time></a> </div>
<div class="comment-content">
<p>Well, I could go on about that, but for long strings (total distinguishing prefixes D &gt;&gt; n log n) the most common character comparison is equality, so branch prediction is pretty easy. It&rsquo;s the cache complexity that sucks &#8212; many classic algorithms are O(D) in cache misses.</p>
</div>
<ol class="children">
<li id="comment-253826" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-28T20:17:44+00:00">September 28, 2016 at 8:17 pm</time></a> </div>
<div class="comment-content">
<p><em>so branch prediction is pretty easy</em></p>
<p>I did not use the expression &ldquo;branch prediction&rdquo; anywhere because I think that counting branch mispredictions is too simplistic.</p>
<p>Variable-length strings can seriously hurt superscalar execution even if there are few branch mispredictions&#8230; because the processor can&rsquo;t tell when the string ends&#8230; and so it does not start working on the next string.</p>
<p>You are right that memory accesses are going to be expensive, but if they can be predicted ahead of time, they can be free&#8230; because the data has been prefetched. </p>
<p>The problem with variable-length strings is that they can blind the processors to what is coming next. It just sees the string and does not look at the work that needs to be done after looping over the string.</p>
<p>Of course, if the strings do not fit in CPU cache, then you are going to start having performance trouble&#8230; at some point, you cannot sort faster than you can read and write to RAM&#8230; but there are cache-friendly algorithms that can help&#8230;</p>
</div>
<ol class="children">
<li id="comment-253843" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-28T23:04:41+00:00">September 28, 2016 at 11:04 pm</time></a> </div>
<div class="comment-content">
<p>I see, yes I did mistake branch prediction for cache prediction. The latter indeed suffers with anything using indirect references, which the memory predictor can&rsquo;t predict, and the pointers are by definition permuted vs. the original data (or at least they become that way after a few rounds). That&rsquo;s what makes it so exciting.</p>
<p>The good news is that it&rsquo;s possible to sort with only O(n log n) real cache misses, with the other O(D) character accesses being contiguous and prefetchable.</p>
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
<li id="comment-253924" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/073f67f5295376245c787a0aa3b99842?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/073f67f5295376245c787a0aa3b99842?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michel Lemay</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-29T13:31:31+00:00">September 29, 2016 at 1:31 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel, so what is the result of that timsort on your machine?</p>
</div>
<ol class="children">
<li id="comment-253925" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-29T13:51:53+00:00">September 29, 2016 at 1:51 pm</time></a> </div>
<div class="comment-content">
<p>@Michel</p>
<p>Timsort is a pretty good idea. It is 50% slower on shuffled arrays, but drastically (10x) faster on sorted ones.</p>
<pre>
std::sort(v.begin(), v.end()) [           std::sort(v.begin(), v.end())]:  40.95 cycles per element
gfx::timsort(v.begin(), v.end()) [           std::sort(v.begin(), v.end())]:  2.01 cycles per element
std::sort(v.begin(), v.end()) [ std::random_shuffle(v.begin(), v.end())]:  234.56 cycles per element
gfx::timsort(v.begin(), v.end()) [ std::random_shuffle(v.begin(), v.end())]:  341.48 cycles per element
std::sort(v.begin(), v.end()) [         std::sort(v.rbegin(), v.rend())]:  32.29 cycles per element
gfx::timsort(v.begin(), v.end()) [         std::sort(v.rbegin(), v.rend())]:  2.65 cycles per element
</pre>
</div>
</li>
</ol>
</li>
<li id="comment-254027" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/906dfe604654ebb81a883b1af0c36df1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/906dfe604654ebb81a883b1af0c36df1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://dev.krzaq.cc" class="url" rel="ugc external nofollow">KrzaQ</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-30T09:08:17+00:00">September 30, 2016 at 9:08 am</time></a> </div>
<div class="comment-content">
<p>You should compare different implementations of the standard library. If I recall correctly, clang&rsquo;s `libc++` is optimized for the common cases, whereas gcc&rsquo;s `libstdc++` is not.</p>
</div>
<ol class="children">
<li id="comment-254061" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-30T13:56:55+00:00">September 30, 2016 at 1:56 pm</time></a> </div>
<div class="comment-content">
<p>Do you expect that my analysis will depend on the standard library I use?</p>
</div>
<ol class="children">
<li id="comment-255782" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/906dfe604654ebb81a883b1af0c36df1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/906dfe604654ebb81a883b1af0c36df1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://dev.krzaq.cc" class="url" rel="ugc external nofollow">KrzaQ</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-14T20:20:28+00:00">October 14, 2016 at 8:20 pm</time></a> </div>
<div class="comment-content">
<p>I sure hope so, otherwise their optimizations would be pointless 🙂</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
