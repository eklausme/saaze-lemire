---
date: "2016-06-15 12:00:00"
title: "How fast is tabulation-based hashing? The downsides of  Zobrist&#8230;"
index: false
---

[5 thoughts on &ldquo;How fast is tabulation-based hashing? The downsides of Zobrist&#8230;&rdquo;](/lemire/blog/2016/06-15-how-fast-is-tabulation-based-hashing-or-the-downsides-of-zobrist)

<ol class="comment-list">
<li id="comment-245297" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/58468bfe715af829e491d0d90edfeef1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/58468bfe715af829e491d0d90edfeef1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Jim Apple</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-25T01:29:24+00:00">June 25, 2016 at 1:29 am</time></a> </div>
<div class="comment-content">
<p>The usual strategy is to use a fast hash function to hash down to 32 or 64 bits and then use tabulation hashing on that 32-to-64-bit value.</p>
</div>
<ol class="children">
<li id="comment-245298" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-25T01:49:29+00:00">June 25, 2016 at 1:49 am</time></a> </div>
<div class="comment-content">
<p>There are real-world systems that use Zobrist hashing as I described it. See for example Gigablast (<a href="https://www.gigablast.com/" rel="nofollow ugc">https://www.gigablast.com/</a>). Of course, you can use tabulation-based as a final step, and then its speed is less of a concern. You should still expect it to be slower than arithmetic-based functions.</p>
</div>
<ol class="children">
<li id="comment-245301" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/58468bfe715af829e491d0d90edfeef1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/58468bfe715af829e491d0d90edfeef1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jim Apple</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-25T02:03:29+00:00">June 25, 2016 at 2:03 am</time></a> </div>
<div class="comment-content">
<p>I agree with your expectation of slowness compared to arithmetic functions. However, I suspect it is the fastest known hash function for 32-bit or 64-bit input that has the nice theoretical guarantees it has for hash tables, including for linear probing and cuckoo hashing, as noted in the work of Mihai PÄƒtraÈ™cu and Mikkel Thorup.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-245325" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/58468bfe715af829e491d0d90edfeef1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/58468bfe715af829e491d0d90edfeef1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jim Apple</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-25T13:56:17+00:00">June 25, 2016 at 1:56 pm</time></a> </div>
<div class="comment-content">
<p>Where is the crossover point between CLHash and tabulation hashing? That is, if my input is guaranteed to be 64 bytes long, in your recent experiments, is Zobrist or CLHash faster? What about 16 bytes or 1024 bytes?</p>
</div>
<ol class="children">
<li id="comment-245340" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-25T14:26:34+00:00">June 25, 2016 at 2:26 pm</time></a> </div>
<div class="comment-content">
<p>Your 16-byte Zobrist hashing would use 16kB of memory. Cache faults, if they occur, could dominate running time for sure. Maybe you can hold the 16kB in L1 cache and avoid expensive cache misses. Then you might do well. But this 16kB of L1 cache is a precious resource that the rest of your code might need&#8230;</p>
<p>If you have little need for the L1 cache, maybe because you are working with small data structures, or you have mostly sequential access&#8230; then Zobrist would do well.</p>
<p>Otherwise, it will start to generate cache faults.</p>
<p>As usual, there is nothing better than actual testing.</p>
</div>
</li>
</ol>
</li>
</ol>
