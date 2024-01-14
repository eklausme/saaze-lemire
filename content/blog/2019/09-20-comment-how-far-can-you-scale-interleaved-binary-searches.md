---
date: "2019-09-20 12:00:00"
title: "How far can you scale interleaved binary searches?"
index: false
---

[7 thoughts on &ldquo;How far can you scale interleaved binary searches?&rdquo;](/lemire/blog/2019/09-20-how-far-can-you-scale-interleaved-binary-searches)

<ol class="comment-list">
<li id="comment-428063" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/78a0b1c2f2138bb3575eefc4d00b5e51?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/78a0b1c2f2138bb3575eefc4d00b5e51?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Wes Felter</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-20T22:00:31+00:00">September 20, 2019 at 10:00 pm</time></a> </div>
<div class="comment-content">
<p>Do you really mean page faults or TLB misses? You might also validate this by comparing the TLB reach of the processor to the data size.</p>
</div>
<ol class="children">
<li id="comment-428068" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-20T22:25:41+00:00">September 20, 2019 at 10:25 pm</time></a> </div>
<div class="comment-content">
<p><em>Do you really mean page faults or TLB misses? </em></p>
<p>I meant TLB misses, thanks. I tried to avoid to introduce the concept of TLB in the post, hence the confusion.</p>
</div>
</li>
</ol>
</li>
<li id="comment-428473" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f256678460c5afe31bdab98049fcde6f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f256678460c5afe31bdab98049fcde6f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Peter F.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-22T18:52:19+00:00">September 22, 2019 at 6:52 pm</time></a> </div>
<div class="comment-content">
<p>Isn&rsquo;t the limit due to memory level parallelism, you wrote about earlier?</p>
<p><a href="https://lemire.me/blog/2018/11/13/memory-level-parallelism-intel-skylake-versus-apple-a12-a12x/" rel="ugc">https://lemire.me/blog/2018/11/13/memory-level-parallelism-intel-skylake-versus-apple-a12-a12x/</a></p>
</div>
<ol class="children">
<li id="comment-428487" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-22T19:59:57+00:00">September 22, 2019 at 7:59 pm</time></a> </div>
<div class="comment-content">
<p>But we are still a way off from the level of parallelism we should have.</p>
</div>
</li>
<li id="comment-430010" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Oren Tirosh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-04T07:40:23+00:00">October 4, 2019 at 7:40 am</time></a> </div>
<div class="comment-content">
<p>What about core or hyperthread level parallelism? Does it share the same resources and limits? Some of them?</p>
</div>
<ol class="children">
<li id="comment-430011" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-04T07:50:54+00:00">October 4, 2019 at 7:50 am</time></a> </div>
<div class="comment-content">
<p>You can have more than one thread per core to make better use of your memory ressources but you are going to have to pay the overhead of threads&#8230;</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-430013" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Oren Tirosh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-04T08:08:32+00:00">October 4, 2019 at 8:08 am</time></a> </div>
<div class="comment-content">
<p>Using cores or hyperthreads can be used to learn the limits to know whether further optimization is theoretically possible &#8211; and predict whether this technique might be useful in boosting the overall performance of a parallel application or just squeeze out single-core benchmarks and unique scenarios.</p>
</div>
</li>
</ol>
