---
date: "2011-09-26 12:00:00"
title: "Two 32-bit hash functions from a 64-bit hash function?"
index: false
---

[10 thoughts on &ldquo;Two 32-bit hash functions from a 64-bit hash function?&rdquo;](/lemire/blog/2011/09-26-two-32-bit-hash-functions-from-a-64-bit-hash-function)

<ol class="comment-list">
<li id="comment-54727" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-09-26T10:09:45+00:00">September 26, 2011 at 10:09 am</time></a> </div>
<div class="comment-content">
<p>@Turney</p>
<p><em>If the boilerplate text is given in advance, you could generate a perfect hash function. Then you wouldn&rsquo;t need to store the keys.</em></p>
<p>Your domain space is not limited to boilerplate text.</p>
</div>
</li>
<li id="comment-54726" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Peter Turney</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-09-26T09:59:25+00:00">September 26, 2011 at 9:59 am</time></a> </div>
<div class="comment-content">
<p><i>Can you implement a hash table without storing the keys?</i></p>
<p>If the boilerplate text is given in advance, you could generate a perfect hash function. Then you wouldn&rsquo;t need to store the keys.</p>
<p><a href="https://en.wikipedia.org/wiki/Perfect_hash_function" rel="nofollow ugc">http://en.wikipedia.org/wiki/Perfect_hash_function</a></p>
</div>
</li>
<li id="comment-54728" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Peter Turney</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-09-26T10:33:33+00:00">September 26, 2011 at 10:33 am</time></a> </div>
<div class="comment-content">
<p><i>Can you implement a hash table without storing the keys?</i></p>
<p>If you have multiple hash functions, you call the first one to see whether the text might be boiler plate. You only need to call the second one if the text is possibly boiler plate. If the text is mostly non-boiler plate and the first hash table is mostly empty, then you&rsquo;ll rarely need to call the second (third, fourth, &#8230;) hash function(s). On average, you&rsquo;ll only make slightly more than one hash call per chunk of text.</p>
</div>
</li>
<li id="comment-54729" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Peter Turney</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-09-26T10:43:14+00:00">September 26, 2011 at 10:43 am</time></a> </div>
<div class="comment-content">
<p>Given hash functions f1, f2, f3, &#8230;, fn, use f1 to index into a hash table and store the values of f2 &#8230; fn in that slot in the hash table. Most text will likely index into empty slots, so only f1 will need to be calculated. If the slot is not empty, then you calculate f2. If the value, matches, then try f3, and so on. It&rsquo;s unlikely that all fn would match for a non-boiler plate text. On average, you would only need to calculate f1. And you wouldn&rsquo;t be storing the keys.</p>
</div>
</li>
<li id="comment-54730" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c47d7a71160b9ec79d34316139ff3cdb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c47d7a71160b9ec79d34316139ff3cdb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://futurepaul.blogspot.com" class="url" rel="ugc external nofollow">Paul</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-09-26T10:50:29+00:00">September 26, 2011 at 10:50 am</time></a> </div>
<div class="comment-content">
<p>@Daniel</p>
<p>You could still define a Perfect Hash function if you&rsquo;re a little loose with your definition of &ldquo;distinct element&rdquo;. If you define any two elements of non-boilerplate as identical (since we&rsquo;re only interested in boilerplate), you could write a hash that maps any nonboiler plate to zero, and otherwise maps to a hash for that text.</p>
<p>Of course, if you have the boilerplate, you could just write a trie or finite state machine to detect them.</p>
<p>@Peter</p>
<p>On a single pass of data, you&rsquo;d still need to compute f1&#8230;fn for every piece of text. You don&rsquo;t know during the initial computation how deep you need to hash. If you only do f1, since you hit an empty slot, and a later piece of text collides you&rsquo;d need to go back and retrieve the original text. That basic idea would work well for a two pass detection though: You use a hash to see what could possibly be boilerplate (vs. innocent collisions), then you do a second pass over that much smaller set, hopefully down into the region that full keys can fit in memory.</p>
</div>
</li>
<li id="comment-54731" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Peter Turney</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-09-26T11:18:32+00:00">September 26, 2011 at 11:18 am</time></a> </div>
<div class="comment-content">
<p><i>You don&rsquo;t know during the initial computation how deep you need to hash.</i></p>
<p>If the boiler plate is given in advance, you do one pass through the boiler plate collection, then you can handle a constant stream of non-boiler text. All you need to know is a rough estimate of the size of the boiler plate collection.</p>
<p>If the boiler plate is not given in advance, you&rsquo;ll need to make two passes through the data, regardless of what algorithm you use, or you&rsquo;re certain to mess up on the first few documents you see. Also, high frequency text is not necessarily boiler plate. Might be a famous quotation, for example.</p>
</div>
</li>
<li id="comment-54735" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-09-28T12:54:18+00:00">September 28, 2011 at 12:54 pm</time></a> </div>
<div class="comment-content">
<p>@Itman</p>
<p>(1) There are definitively applications where hashing is a bottleneck. It is why people spent so much time designing fast hash functions.</p>
<p>(2) Your processor is likely to pipeline the computation of hash functions and you can use many tricks if you code it in assembly.</p>
<p>(3) Not every machine these days run an Intel processors. What about your iPhone?</p>
</div>
</li>
<li id="comment-54737" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-09-28T13:06:55+00:00">September 28, 2011 at 1:06 pm</time></a> </div>
<div class="comment-content">
<p>@Item</p>
<p>(1) I guess it depends whether your Bloom filter fits in CPU cache.</p>
<p>(3) I think more and more serious applications run on tablets and mobile phones.</p>
</div>
</li>
<li id="comment-54734" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-09-28T11:47:14+00:00">September 28, 2011 at 11:47 am</time></a> </div>
<div class="comment-content">
<p>Daniel,</p>
<p>Sorry did not have time to read any of these articles. Yet, I wonder if it&rsquo;s really computation that takes a lot of time. And not the time wasted in missing the cache (accessing bits in the Bloom-filter table or the string for which hash values are computed)?</p>
<p>BTW, a lot of hash functions can be computed in parallel. What about using SIMD intel extensions?</p>
</div>
</li>
<li id="comment-54736" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-09-28T13:01:44+00:00">September 28, 2011 at 1:01 pm</time></a> </div>
<div class="comment-content">
<p>Daniel</p>
<p>(1) True, but is it really the case for a Bloom-filter?</p>
<p>(3) It is also true, but those gadgets are mostly for fun (with a few exceptions). You are not going to run boilerplate detecting applications on smartphones? If not, you will quickly find out that everything else today is Intel 🙂</p>
</div>
</li>
</ol>
