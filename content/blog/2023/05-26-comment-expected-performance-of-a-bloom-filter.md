---
date: "2023-05-26 12:00:00"
title: "Expected performance of a Bloom filter"
index: false
---

[2 thoughts on &ldquo;Expected performance of a Bloom filter&rdquo;](/lemire/blog/2023/05-26-expected-performance-of-a-bloom-filter)

<ol class="comment-list">
<li id="comment-651947" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ca0928b4e4a698cdd1c1660290c4d587?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ca0928b4e4a698cdd1c1660290c4d587?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://dend.ro" class="url" rel="ugc external nofollow">Laurentiu Nicola</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-28T07:59:35+00:00">May 28, 2023 at 7:59 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
By spending about 12 bits per value (12 bits time the size of the set)<br/>
and using 8 hash functions, the probability of a false positive is<br/>
about 1/256 (or 0.3%) which is reasonable.</p>
<p> If you know a bit about software performance, the 8 bits could be<br/>
concerning. Looking up 8 values at random location in memory is not<br/>
cheap. And, indeed, when the element is in the set, you must check all<br/>
12 locations. It is expensive.
</p></blockquote>
<p>I think you&rsquo;d still need to check 8, not 12 locations, one for each hash function, regardless of the filter size. Was that a typo?</p>
<p>Anyway, I&rsquo;ve never heard of XOR filters, thanks for the reference and nice benchmarks!</p>
<p>PS: your WordPress database doesn&rsquo;t like non-Swedish diacritics:</p>
<blockquote><p>
Illegal mix of collations (latin1_swedish_ci,IMPLICIT) and (utf8mb4_general_ci,COERCIBLE) for operation &lsquo;=&rsquo;
</p></blockquote>
</div>
<ol class="children">
<li id="comment-651962" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-28T22:49:33+00:00">May 28, 2023 at 10:49 pm</time></a> </div>
<div class="comment-content">
<p>Thanks. It was indeed a typo.</p>
<p>I know a lot about Unicode, but not a lot about how MySQL handles it.</p>
</div>
</li>
</ol>
</li>
</ol>
