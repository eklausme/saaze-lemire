---
date: "2018-04-04 12:00:00"
title: "Caching hash values for speed (Swift-language edition)"
index: false
---

[5 thoughts on &ldquo;Caching hash values for speed (Swift-language edition)&rdquo;](/lemire/blog/2018/04-04-caching-hash-values-for-speed-swift-language-edition)

<ol class="comment-list">
<li id="comment-300027" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d088b64dd03b0d2c81849fa1c7f226f8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d088b64dd03b0d2c81849fa1c7f226f8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">jh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-05T06:09:03+00:00">April 5, 2018 at 6:09 am</time></a> </div>
<div class="comment-content">
<p>Well this is expected since you didn&rsquo;t include the extra time it takes to init the BufferedTriples, no? The more you get to re-use the same instances the more beneficial this is.</p>
</div>
<ol class="children">
<li id="comment-300066" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-05T13:41:46+00:00">April 5, 2018 at 1:41 pm</time></a> </div>
<div class="comment-content">
<p><em>you didn&rsquo;t include the extra time it takes to init the BufferedTriples, no?</em></p>
<p>I did not. However, once you have the hash value, you can re-use many times.</p>
<p>I do not advocate pre-computing the hash values in general.</p>
</div>
</li>
</ol>
</li>
<li id="comment-300064" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1d541b0d2e3837f334c847d634621490?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1d541b0d2e3837f334c847d634621490?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michel Lemay</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-05T13:28:11+00:00">April 5, 2018 at 1:28 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel, I find your post interesting and I observed similar measurements. However, you still have to compute the hash value, be it in the constructor of your object or at lookup time. So unless you reuse the same object instances over and over, you will just move the computation on a different code path. In the last few cases where I had to profile hashmap lookups, it was with caches. I would check if a given key object (tuple of something) would exists in the cache. In this typical use case, keys are rarely available in final form and must be constructed at the point of lookup and dominate execution time.</p>
</div>
<ol class="children">
<li id="comment-300067" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-05T14:03:04+00:00">April 5, 2018 at 2:03 pm</time></a> </div>
<div class="comment-content">
<p>Though you are correct, I think it is a bit less trivial than what your arguments might imply. If you try running my tests (Swift runs well on Linux), you&rsquo;ll notice that I record the time required to construct Triples and BufferedTriples and the difference is small.</p>
</div>
</li>
</ol>
</li>
<li id="comment-380056" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ad09fdcf485291f372a3811f5c2fb61e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ad09fdcf485291f372a3811f5c2fb61e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Yvo</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-07T20:10:32+00:00">January 7, 2019 at 8:10 pm</time></a> </div>
<div class="comment-content">
<p>What would be a good way to cache the hash value using the new Hasher protocol? The hashValue int will probably eventually be deprecated.</p>
</div>
</li>
</ol>
