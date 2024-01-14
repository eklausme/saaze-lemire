---
date: "2019-09-14 12:00:00"
title: "Speeding up independent binary searches by interleaving them"
index: false
---

[11 thoughts on &ldquo;Speeding up independent binary searches by interleaving them&rdquo;](/lemire/blog/2019/09-14-speeding-up-independent-binary-searches-by-interleaving-them)

<ol class="comment-list">
<li id="comment-427237" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Nathan Kurz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-14T21:01:43+00:00">September 14, 2019 at 9:01 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
Furthermore, it looks like I am already nearly maxing out the amount of memory-level parallelism (9 on Cannon Lake, 7 on Skylake, 5 on Skylark).
</p></blockquote>
<p>That&rsquo;s a bold claim, since that would imply there isn&rsquo;t really any room for further speedup! I thought Travis had concluded that Cannon Lake was actually able to sustain more than 20 outstanding L1 misses: <a href="https://www.realworldtech.com/forum/?threadid=181499&#038;curpostid=182779" rel="nofollow ugc">https://www.realworldtech.com/forum/?threadid=181499&#038;curpostid=182779</a>.</p>
<p>Measuring the speedup ratio does seem like a good way of estimating the degree of memory parallelism, though. I wondered how much the ordering of the small array would affect the results, so I tried deleting the std::sort at L1141. To my surprise, it seemed to have no effect. I would have thought that the searching for nearby results in succession would have resulted in better caching &#8212; and hence faster results &#8212; than searching for them in random order. Is it expected that this would have no effect?</p>
</div>
<ol class="children">
<li id="comment-427241" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-14T21:13:05+00:00">September 14, 2019 at 9:13 pm</time></a> </div>
<div class="comment-content">
<p>Actually, 20x might be an underestimation on Cannon Lake, so you are correct that I am way off from the maximum on this processor. However, on skylake, I am not too far off.</p>
</div>
</li>
</ol>
</li>
<li id="comment-427246" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/28c2ad0c8763feac0b431881de7f97fe?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/28c2ad0c8763feac0b431881de7f97fe?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.pvk.ca" class="url" rel="ugc external nofollow">Paul Khuong</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-14T21:23:40+00:00">September 14, 2019 at 9:23 pm</time></a> </div>
<div class="comment-content">
<p>nkurz:<br/>
L1141 looks like sorting the vector for bsearch. The targets are overwritten with rand() on L1199.</p>
<p>Re sorting the search keys. The top of the implicit search tree should remain in cache even with random ordering, so sorting the search keys might only be expected to help data cache hits in iterations ~11-12 and above. However, the density of search keys with respect to the size of the sorted array means that there will rarely be any overlap between the keys, at these later iterations. There might be an impact on TLB hits?</p>
<p>If we increase the number of searches by a factor of 100-1000, we should observe more sharing in cache hits. However, I expect we&rsquo;ll just end up underutilising the line fill buffers with a straight up sort of the search keys. It probably makes more sense to transpose the search keys into multiple (one per interleaved search) sorted substreams, after sorting.</p>
</div>
<ol class="children">
<li id="comment-427259" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Kurz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-14T23:08:23+00:00">September 14, 2019 at 11:08 pm</time></a> </div>
<div class="comment-content">
<p>Thank you, I was indeed lost with what was happening with that line. I&rsquo;m still somewhat lost, but perhaps getting closer to understanding.</p>
</div>
</li>
</ol>
</li>
<li id="comment-427247" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/93f5fbdd8c7941827fd66f21c8e28654?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/93f5fbdd8c7941827fd66f21c8e28654?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jon Stewart</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-14T21:24:14+00:00">September 14, 2019 at 9:24 pm</time></a> </div>
<div class="comment-content">
<p>Neat! Two other improvements for large arrays:</p>
<p>Cache the midpoints (corresponding to the first few levels of a binary search tree) in a small block, thereby reducing the number of memory accesses.<br/>
If the values are evenly distributed (e.g., they are hash values), one can scan the array and record the maximum error from the expected position. For example, the NIST’s NSRL hash set has ~34M unique SHA-1 values, requiring close to 700MB of memory to store as a sorted binary array. However, the maximum error is not that great: empirically, any hash value is within 16KB of its expected position. Although it takes a few more cycles to compute the expected position, the reduced window size allows for double the throughput over a naive binary search over the whole thing.</p>
</div>
</li>
<li id="comment-427261" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/74a5f0d4e1615193d25815690cacc5bc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/74a5f0d4e1615193d25815690cacc5bc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Greg Maxwell</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-14T23:24:06+00:00">September 14, 2019 at 11:24 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
It is hard to drastically improve on the binary search if you only need to do one.
</p></blockquote>
<p>Not so&#8211; if the data is well distributed (as is usually the case if your seeking on a hash, for example) then linearly interpolating will be dramatically faster than bisection: If the point you seek has a value 1/3 of the way between your current bounds, you seek 1/3 of the way. Care should be taken to switch back to bisection if interpolation isn&rsquo;t converging to avoid a linear worst case cost. There are simple procedures that guarantee a worst case only a small factor more probes than bisection, but on well conditioned data converges MUCH faster.</p>
<p>Similarly, when the bounds are too close, switching to a linear scan can be faster continuing to bisect.</p>
<p>Downside, of course&#8211; is that batching like you suggest works better with bisection because its easy to arrange lookups to share probe locations.</p>
</div>
</li>
<li id="comment-427292" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://example.com" class="url" rel="ugc external nofollow">degski</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-15T06:44:53+00:00">September 15, 2019 at 6:44 am</time></a> </div>
<div class="comment-content">
<p>Recently this was posted on HN: <a href="https://www.pvk.ca/Blog/2012/07/30/binary-search-is-a-pathological-case-for-caches/" rel="nofollow ugc">https://www.pvk.ca/Blog/2012/07/30/binary-search-is-a-pathological-case-for-caches/</a> , which has some interesting observations on bs, as well.</p>
</div>
</li>
<li id="comment-427605" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-18T18:18:43+00:00">September 18, 2019 at 6:18 pm</time></a> </div>
<div class="comment-content">
<p>All that neat and clean CS theory is worth less and less with modern architectures and real world datasets. Even with the simplest of algorithms you have to think of questions such as: Are your searches mostly hits or misses? Are your keys evenly distributed or not? Which parts of your data structures might be hot and which are cold? Can you increase benefits of locality without much overhead? All possible combinations of these and many other parameters are going to affect the choice of algorithm adaptation to the architecture deep below the simple-looking ISA model and probably even creating feedback loops to approaches you want to take.</p>
<p>Sometimes all this makes one feel that there has to be a good, but currently unknown approach (instead of plain black magic) to creating efficient solutions. That is, solid engineering backed up by good theory. Yet, I&rsquo;m perfectly unaware of it, and something like &ldquo;how can we make binary search efficient&rdquo; is like construction engineers considering proper use of a nail a mystery.</p>
</div>
</li>
<li id="comment-428814" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9391152264f5d5fe5e7f6db2de7ebdcb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9391152264f5d5fe5e7f6db2de7ebdcb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jakub Beránek</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-24T09:51:35+00:00">September 24, 2019 at 9:51 am</time></a> </div>
<div class="comment-content">
<p>This (and other forms of interleaving of memory access cost dominated algorithms) can be implemented easily using coroutines <a href="http://www.vldb.org/pvldb/vol11/p1702-jonathan.pdf" rel="nofollow ugc">http://www.vldb.org/pvldb/vol11/p1702-jonathan.pdf</a>.</p>
</div>
</li>
<li id="comment-428997" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/33bbbf4053c9c66fb798c6314b524983?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/33bbbf4053c9c66fb798c6314b524983?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">lyn</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-26T02:21:11+00:00">September 26, 2019 at 2:21 am</time></a> </div>
<div class="comment-content">
<p>If I have a single binary search to perform, then, am I better off to interleave it with 31 other, unimportant binary searches? I&rsquo;m confused a bit on the implications.</p>
</div>
<ol class="children">
<li id="comment-429040" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-26T13:20:43+00:00">September 26, 2019 at 1:20 pm</time></a> </div>
<div class="comment-content">
<p>Here is the second paragraph from the post:</p>
<blockquote><p>It is hard to drastically improve on the binary search if you only need to do one.</p></blockquote>
</div>
</li>
</ol>
</li>
</ol>
