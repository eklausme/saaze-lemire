---
date: "2021-04-09 12:00:00"
title: "How fast can you sort arrays of integers in Java?"
index: false
---

[7 thoughts on &ldquo;How fast can you sort arrays of integers in Java?&rdquo;](/lemire/blog/2021/04-09-how-fast-can-you-sort-arrays-of-integers-in-java)

<ol class="comment-list">
<li id="comment-581934" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://zeux.io" class="url" rel="ugc external nofollow">Arseny Kapoulkine</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-09T17:01:57+00:00">April 9, 2021 at 5:01 pm</time></a> </div>
<div class="comment-content">
<p>FWIW for large data arrays I&rsquo;d recommend a 3-pass radix sort (using 11, 11 and 10 bits of the input values). This requires a bit more space, with the histogram/offset array adding up to 20 KB but that still fits within L1 reasonably comfortably and as such usually wins significantly on moderately large inputs.</p>
</div>
<ol class="children">
<li id="comment-581939" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-09T20:15:35+00:00">April 9, 2021 at 8:15 pm</time></a> </div>
<div class="comment-content">
<p>At least with a C++ LSD radix sort, I found 8 bits generally better than 11 bits: performance started dropping off heavily right after 8 bits as there are too many buckets to be easily held in the L1 cache (typically has 512 cache lines on x86) and the L1 TLB.</p>
<p>Of course, this depends a lot on the hardware, the size of the data being sorted, and other details of the implementation (e.g., if there is an intermediate buffering step where smaller buckets are accumulated before being copied out to the final buckets, larger radices may perform better).</p>
<p>Especially, it depends on the data distribution: if many fewer than available the <code>2^radix</code> buckets are actually used, larger radices are better since the caching penalty is reduced or eliminated. In principle, one could look at the histogram and try to pick the radix dynamically based on what&rsquo;s likely to be good for that distribution.</p>
</div>
<ol class="children">
<li id="comment-581944" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-09T20:57:39+00:00">April 9, 2021 at 8:57 pm</time></a> </div>
<div class="comment-content">
<p>I want to revoke my use of &ldquo;generally better&rdquo; in the first sentence. I should really say &ldquo;I found 8 bits better in my specific scenario of sorting uniformly random values&rdquo;.</p>
</div>
<ol class="children">
<li id="comment-581950" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2c9232413f06bfd206984132efa05fd9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2c9232413f06bfd206984132efa05fd9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/eloj/radix-sorting" class="url" rel="ugc external nofollow">Eddy</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-09T23:35:37+00:00">April 9, 2021 at 11:35 pm</time></a> </div>
<div class="comment-content">
<p>This is my experience also with 11-bit radix. It was surprisingly bad (on random input). I&rsquo;m surprised to see it recommended, honestly.</p>
<p>I think you&rsquo;re better off using 8-bits and relying on column-skipping to shave off (likely high-order bits) for when the data isn&rsquo;t random.</p>
</div>
</li>
<li id="comment-581951" class="comment even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://zeux.io" class="url" rel="ugc external nofollow">Arseny Kapoulkine</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-10T00:42:05+00:00">April 10, 2021 at 12:42 am</time></a> </div>
<div class="comment-content">
<p>You&rsquo;re right; for arrays of random integers indeed 4-pass sort seems to often win by a bit. I need to update my priors; my data was mostly based on experience with in-order Cell systems, and I haven&rsquo;t rebenchmarked this specific problem on modern Intel chips until now&#8230;</p>
<p>fwiw source <a href="https://gist.github.com/zeux/2e4edeef8a09ee0bfab3ec76858aaec1" rel="nofollow ugc">https://gist.github.com/zeux/2e4edeef8a09ee0bfab3ec76858aaec1</a></p>
</div>
<ol class="children">
<li id="comment-584753" class="comment odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://zeux.io" class="url" rel="ugc external nofollow">Arseny Kapoulkine</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-22T15:47:57+00:00">May 22, 2021 at 3:47 pm</time></a> </div>
<div class="comment-content">
<p>FWIW I&rsquo;ve ran the benchmark from <a href="https://gist.github.com/zeux/2e4edeef8a09ee0bfab3ec76858aaec1" rel="nofollow ugc">https://gist.github.com/zeux/2e4edeef8a09ee0bfab3ec76858aaec1</a> on an AMD Ryzen 5900X and I am getting different results from Intel &#8211; on Intel 4-pass is winning by a fair margin, but on Ryzen 3-pass is noticeably faster on sorting ints (and still a touch slower on floats but the difference isn&rsquo;t very significant).</p>
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
<li id="comment-582130" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">George Spelvin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-13T10:21:35+00:00">April 13, 2021 at 10:21 am</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s possible to save some memory and only keep two levels&rsquo; histograms in memory at one time by creating the next level&rsquo;s histogram as you&rsquo;re distributing the current one.</p>
<p>But this probably isn&rsquo;t worth it. Each histogram requires only 1KiB (it&rsquo;s not hard to adjust the prefix sum loop to get rid of the 257th element), but you need 256 cache lines (16 KiB) for the active head of each bucket.</p>
<p>That&rsquo;s probably why going to 11 bits is a disaster; a typical 64K L1D only has 1024 lines. So randomly writing to 2048 buffers is going to thrash the hell out of it.</p>
</div>
</li>
</ol>
