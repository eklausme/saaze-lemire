---
date: "2019-04-27 12:00:00"
title: "Speeding up a random-access function?"
index: false
---

[6 thoughts on &ldquo;Speeding up a random-access function?&rdquo;](/lemire/blog/2019/04-27-speeding-up-a-random-access-function)

<ol class="comment-list">
<li id="comment-403915" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ea7f66524f0528ccf9d6a2a875094ea0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ea7f66524f0528ccf9d6a2a875094ea0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Maël Kebiriou</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-27T11:50:06+00:00">April 27, 2019 at 11:50 am</time></a> </div>
<div class="comment-content">
<p>I designed something similar but with the temporary buffers containing larger batches. Only the tail of the buffer stays in cache for appending. Once a buffer is above a water line, it is emptied into the main array with good locality. The hardware prefetcher helps with the sequential reads from the buffers.</p>
<p>This doesn&rsquo;t scale to very large array: at one point, either the bucket size or the buffer tails won&rsquo;t fit in the cache anymore. It make me wondering if this algorithm can be efficiently layered. Something like the funnelsort approach.</p>
<p>I tried using non temporal writes to the buffers, but for variable or sub 64B item sizes, it still needs some place to do the write combining, like the actual WCB buffers or yet another temporary buffer in cache. This doesn&rsquo;t work so well once the number of buckets gets very large.</p>
<p>I will compare your code against my method once I get back to this project.</p>
<p>I&rsquo;m also curious to see how it compares with prefetches and a ring delay. This random accesses situation might be the only valid use case for manual prefetches.</p>
</div>
</li>
<li id="comment-403960" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/455da12ee7a27b3fbac08e0374ba445e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/455da12ee7a27b3fbac08e0374ba445e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Alexander Monakov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-27T16:27:34+00:00">April 27, 2019 at 4:27 pm</time></a> </div>
<div class="comment-content">
<p>I am confused: if you know that THP setting matters here, why is rest of the text is focusing purely on cache misses? With such a huge array (4GB), address translation misses with 4K pages will likely be the dominating factor, and indeed a quick test with hugepages allowed shows that they bring a 2x-3x speedup (on Sandybridge).</p>
</div>
<ol class="children">
<li id="comment-404351" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-29T17:52:55+00:00">April 29, 2019 at 5:52 pm</time></a> </div>
<div class="comment-content">
<p>Page faults occur as part of a cache miss.</p>
</div>
<ol class="children">
<li id="comment-404366" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/455da12ee7a27b3fbac08e0374ba445e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/455da12ee7a27b3fbac08e0374ba445e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alexander Monakov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-29T20:08:00+00:00">April 29, 2019 at 8:08 pm</time></a> </div>
<div class="comment-content">
<p>As far as I can tell, page faults are not relevant for performance here, because they mostly occur on initial accesses to the array (i.e. in memset). Once address mapping is populated, subsequent accesses cause TLB misses that are resolved via page-table walks, without causing faults.</p>
<p>TLB misses do not necessarily imply cache misses, it&rsquo;s possible to have data in cache that needs a page walk because the relevant TLB entry has been evicted.</p>
</div>
<ol class="children">
<li id="comment-404368" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-29T20:25:19+00:00">April 29, 2019 at 8:25 pm</time></a> </div>
<div class="comment-content">
<p>I have the same comeback. A TLB is a cache. A page walk occurs following a cache miss (at the TLB level). I&rsquo;d grant you that it is not how most people would understand the term, but maybe you can believe me that this is what I had in mind. To be clear, as your first comment implies, I am aware that page size is an important factor in this benchmark.</p>
<p>In case there is any doubt: I am not claiming (at all) that my solution (with or without playing with the page size) is best. It is definitively the case that you can improve it with large/huge pages (thanks for pointing it out).</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-403984" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1d4e09e6b2678777e1daec092302469b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1d4e09e6b2678777e1daec092302469b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">gene</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-27T19:21:53+00:00">April 27, 2019 at 7:21 pm</time></a> </div>
<div class="comment-content">
<p>I would discuss buddy memory system and Linux kernel caching which may have used it at one point.</p>
</div>
</li>
</ol>
