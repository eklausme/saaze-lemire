---
date: "2018-03-08 12:00:00"
title: "Iterating over set bits quickly (SIMD edition)"
index: false
---

[13 thoughts on &ldquo;Iterating over set bits quickly (SIMD edition)&rdquo;](/lemire/blog/2018/03-08-iterating-over-set-bits-quickly-simd-edition)

<ol class="comment-list">
<li id="comment-298063" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f38a8dc91f316cac1f78e64de271e215?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f38a8dc91f316cac1f78e64de271e215?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://github.com/powturbo" class="url" rel="ugc external nofollow">powturbo</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-08T05:42:24+00:00">March 8, 2018 at 5:42 am</time></a> </div>
<div class="comment-content">
<p>congratulation! your lookup tables are quite large for AVX2.<br/>
In <a href="https://github.com/powturbo/TurboPFor" rel="nofollow">TurboPFor:Integer Compression</a> I&rsquo;m using a using a 2k table instead of a 8k table and converting the mask with: _mm256_cvtepu8_epi32(_mm_cvtsi64_si128(*(uint64_t *)(vecDecodeTable[byteA]))).</p>
<p>I&rsquo;m also using popcount instead of a length table for advanceA/B.</p>
</div>
<ol class="children">
<li id="comment-298085" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-08T15:40:21+00:00">March 8, 2018 at 3:40 pm</time></a> </div>
<div class="comment-content">
<p>For comparison purposes, I have added &ldquo;turbo&rdquo; versions of the functions to my repository which follow your description.</p>
</div>
</li>
</ol>
</li>
<li id="comment-298067" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24cfa9591263008553ae4c125b6a9934?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24cfa9591263008553ae4c125b6a9934?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">wmu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-08T07:12:09+00:00">March 8, 2018 at 7:12 am</time></a> </div>
<div class="comment-content">
<p>It&rsquo;d be great if you checked performance for higher densities, like 0.75, 0.80, 0.99.</p>
</div>
<ol class="children">
<li id="comment-298086" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-08T15:40:51+00:00">March 8, 2018 at 3:40 pm</time></a> </div>
<div class="comment-content">
<p>I have added density 0.9 to the blog post. The results are very positive.</p>
</div>
<ol class="children">
<li id="comment-298093" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24cfa9591263008553ae4c125b6a9934?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24cfa9591263008553ae4c125b6a9934?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">wmu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-08T17:08:45+00:00">March 8, 2018 at 5:08 pm</time></a> </div>
<div class="comment-content">
<p>Thanks, that&rsquo;s really great.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-298100" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9a04e8a51472b7293aaf6a8fa0516a9c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9a04e8a51472b7293aaf6a8fa0516a9c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jeff Vienneau</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-08T22:01:05+00:00">March 8, 2018 at 10:01 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for sharing I love these types of articles.</p>
<p>I&rsquo;m assuming the number of bitmap passes is large enough justfy to pulling the 8kB lookup table in cache for the use case?</p>
<p>What would this be used for?</p>
</div>
<ol class="children">
<li id="comment-298113" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-09T01:38:47+00:00">March 9, 2018 at 1:38 am</time></a> </div>
<div class="comment-content">
<p><em>What would this be used for?</em></p>
<p>This comes up often enough. For example, I expect we could speed up <a href="http://roaringbitmap.org" rel="nofollow">Roaring bitmaps</a>.</p>
</div>
</li>
</ol>
</li>
<li id="comment-299935" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/02d0d44f493c60abaf70bdcbb6cf5c84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/02d0d44f493c60abaf70bdcbb6cf5c84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Erling Andersen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-04T12:53:21+00:00">April 4, 2018 at 12:53 pm</time></a> </div>
<div class="comment-content">
<p>An application.</p>
<p>Assume you want to find the union of some index sets. Also assume the union should be sorted. This relevant when doing a socalled symbolic Cholesky factorization.</p>
<p>Most likely you will have a bit vector that marks whether an element is in the union. If you have the bit vector it might be more efficient to generated the sorted union from that than doing a quicksort.</p>
</div>
<ol class="children">
<li id="comment-299936" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-04T13:08:35+00:00">April 4, 2018 at 1:08 pm</time></a> </div>
<div class="comment-content">
<p>You are correct.</p>
</div>
</li>
</ol>
</li>
<li id="comment-603264" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c1f4b4c34700a8fce329e7f3f5d68c35?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c1f4b4c34700a8fce329e7f3f5d68c35?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kay Werndli</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-24T15:06:03+00:00">October 24, 2021 at 3:06 pm</time></a> </div>
<div class="comment-content">
<p>I know this is an older post and I hope no-one minds the late comment. First of all: thank you (and powturbo) so much for posting this! I was in the process of optimising a genetic algorithm and identified a part of it as the bottleneck, where I was iterating over the set bits of a lot of 64-bit integers. My original approach was pretty much what you described in your previous post (taking advantage of tzcnt). Replacing that with a version similar to what you outlined here single-handedly brought down the runtime for evaluating a single generation from 3.5 s to 0.6 s. I had to run multiple tests, comparing the results against my previous implementation, because I couldn&rsquo;t believe how fast it was all of a sudden. So again: thank you very much!</p>
<p>Having looked at the code you posted on GitHub, I have one (probably naive) question: It seems like there, you&rsquo;re explicitly aligning the lookup tables to 16-bytes and then use aligned loads to read 256-bit vectors from the table. I was under the impression that unaligned loads required 32-byte alignments but I&rsquo;m really not that experienced in that area and was curious where my misunderstanding lies.</p>
</div>
<ol class="children">
<li id="comment-603274" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-24T17:00:42+00:00">October 24, 2021 at 5:00 pm</time></a> </div>
<div class="comment-content">
<p>You are correct. The alignment should match the vector width.</p>
</div>
</li>
</ol>
</li>
<li id="comment-652288" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d3c8f93bc31e00271035a656d921947a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d3c8f93bc31e00271035a656d921947a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">dist1ll</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-11T16:47:48+00:00">June 11, 2023 at 4:47 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for the great article, and sorry for necroposting.</p>
<p>Do I read correctly that the SIMD version&rsquo;s output contains additional zeroes, unlike the compact representation of the naive implementation?</p>
</div>
<ol class="children">
<li id="comment-652292" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-11T18:38:37+00:00">June 11, 2023 at 6:38 pm</time></a> </div>
<div class="comment-content">
<p>The SIMD version writes the result out in blocks, you are correct.</p>
</div>
</li>
</ol>
</li>
</ol>
