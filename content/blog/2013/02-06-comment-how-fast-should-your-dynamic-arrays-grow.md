---
date: "2013-02-06 12:00:00"
title: "How fast should your dynamic arrays grow?"
index: false
---

[8 thoughts on &ldquo;How fast should your dynamic arrays grow?&rdquo;](/lemire/blog/2013/02-06-how-fast-should-your-dynamic-arrays-grow)

<ol class="comment-list">
<li id="comment-71651" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/206690a26526f07467ecfd6662f8b152?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/206690a26526f07467ecfd6662f8b152?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://karussell.wordpress.com/" class="url" rel="ugc external nofollow">Peter</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-02-07T09:17:08+00:00">February 7, 2013 at 9:17 am</time></a> </div>
<div class="comment-content">
<p>A problem what I stumbled over is if you have millions of entries in your list &#8211; you would then need more than double of the current size even if you just need one more entry. For my graphhopper project I just created a segmented array which entirely avoids copying and has a maximum amount of wasted capacity (==segment size). It has still the disadvantage of a bit slower access as you need some modulo operations to access the 2d array, but with bit operations you can get a bit faster. I didn&rsquo;t study the performance as memory requirements forced me to introduce it but nevertheless I would be interested if you could add this to your benchmarks + add one more for access time? <a href="https://github.com/graphhopper/graphhopper/blob/master/src/main/java/com/graphhopper/storage/RAMDataAccess.java" rel="nofollow ugc">https://github.com/graphhopper/graphhopper/blob/master/src/main/java/com/graphhopper/storage/RAMDataAccess.java</a></p>
</div>
</li>
<li id="comment-71652" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/206690a26526f07467ecfd6662f8b152?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/206690a26526f07467ecfd6662f8b152?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://karussell.wordpress.com/" class="url" rel="ugc external nofollow">Peter</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-02-07T09:20:09+00:00">February 7, 2013 at 9:20 am</time></a> </div>
<div class="comment-content">
<p>One more benefit of the segmented (double-array) solution is that you can grow the number of entries over 2^32 or 2^31 in case of Java.</p>
</div>
</li>
<li id="comment-71653" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-02-07T09:43:02+00:00">February 7, 2013 at 9:43 am</time></a> </div>
<div class="comment-content">
<p>@Peter</p>
<p>Thanks Peter. When I revisit this problem, I&rsquo;ll be sure to have a look at your solution.</p>
</div>
</li>
<li id="comment-71657" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e0dedec2ffb08c81d5eb0d3d8fb966d7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e0dedec2ffb08c81d5eb0d3d8fb966d7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">rog</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-02-07T12:49:21+00:00">February 7, 2013 at 12:49 pm</time></a> </div>
<div class="comment-content">
<p>For the record, the Go dynamic array (&ldquo;slice&rdquo;) implementation doubles the size until 1024 elements; after then the ratio is 5/4.</p>
<p><a href="https://golang.org/src/pkg/runtime/slice.c#L131" rel="nofollow ugc">http://golang.org/src/pkg/runtime/slice.c#L131</a></p>
</div>
</li>
<li id="comment-71660" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8767bd5b599615b306d847e15920f7d1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8767bd5b599615b306d847e15920f7d1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Valrandir</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-02-07T20:56:30+00:00">February 7, 2013 at 8:56 pm</time></a> </div>
<div class="comment-content">
<p>Thank you for that article, I enjoyed reading it.</p>
<p>Note that the Windows implementation of the STL is using a grow factor or 3/2, unlike the GCC implementation.</p>
<p>Also on reallocation, std::vector is not simply moving the data to the new memory block using for example memcpy, for rather it supports non-POD types and either call the move constructor or the move assignment operator for each element, one by one. Doing the same with c++11 disabled could be even more expansive.</p>
<p>It could be interesting to be able to specify which grow factor to use depending on one large the array already is, and also to set a flag telling the vector that we are storing Plain Old Data and that constructors needs not be called, instead enabling block copy.</p>
<p>To Peter:<br/>
The problem with segmented arrays is that since their memory is not allocated as one continuous block, they lose cache coherence. Reading one such array from beginning to end would jump though memory between each segments, forcing the cpu to fetch the data from the main memory instead of hitting the cpu cache.</p>
</div>
</li>
<li id="comment-71661" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-02-07T21:13:25+00:00">February 7, 2013 at 9:13 pm</time></a> </div>
<div class="comment-content">
<p>@ Valrandir</p>
<p>For my tests, I did not use the STL vector template. So the numbers I give use memcpy. I did benchmark with vector and it was indeed slower, probably for the reason you gave. I did not try STL with C++11 enabled.</p>
<p>As for segmented arrays&#8230; intuitively, if the segments are large enough, it should not create much harm if you are scanning all of the vector from the beginning till the end.</p>
</div>
</li>
<li id="comment-72855" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d7153ec197a843734580fdda09ead336?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d7153ec197a843734580fdda09ead336?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Amit Kumar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-02-21T14:16:11+00:00">February 21, 2013 at 2:16 pm</time></a> </div>
<div class="comment-content">
<p>Comparison with C++ deque would be interesting as it does not reallocate.</p>
</div>
</li>
<li id="comment-72859" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d7153ec197a843734580fdda09ead336?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d7153ec197a843734580fdda09ead336?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Amit Kumar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-02-21T14:24:07+00:00">February 21, 2013 at 2:24 pm</time></a> </div>
<div class="comment-content">
<p>One thing I noticed in the source code is that the access pattern used might favor the static array as the same block might be used by the OS to allocate and deallocate the static array.</p>
</div>
</li>
</ol>
