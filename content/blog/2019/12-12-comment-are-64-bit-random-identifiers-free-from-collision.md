---
date: "2019-12-12 12:00:00"
title: "Are 64-bit random identifiers free from collision?"
index: false
---

[8 thoughts on &ldquo;Are 64-bit random identifiers free from collision?&rdquo;](/lemire/blog/2019/12-12-are-64-bit-random-identifiers-free-from-collision)

<ol class="comment-list">
<li id="comment-464200" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4ca67c5e98323c3bb628f4f815de762e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4ca67c5e98323c3bb628f4f815de762e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://leduotang.ca/sylvain" class="url" rel="ugc external nofollow">Sylvain Hallé</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-13T00:05:17+00:00">December 13, 2019 at 12:05 am</time></a> </div>
<div class="comment-content">
<p>Interesting! I&rsquo;d be curious to know why you wrote a post about that. Did you encounter such a problem in your own work?</p>
</div>
<ol class="children">
<li id="comment-466154" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-13T14:44:24+00:00">December 13, 2019 at 2:44 pm</time></a> </div>
<div class="comment-content">
<p>Yes. Some people report using 64-bit hash values as identifiers and they sometimes believe that it makes collision highly improbable. That&rsquo;s true when dealing with tiny sets, but as I demonstrate, for many practical cases, collisions are actually quite likely.</p>
<p>So, yes, this post is motivated by my discussions with people building systems.</p>
</div>
</li>
</ol>
</li>
<li id="comment-466623" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/197266eab5b4d533a5ec3ea83efe2143?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/197266eab5b4d533a5ec3ea83efe2143?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Peter</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-13T21:58:39+00:00">December 13, 2019 at 9:58 pm</time></a> </div>
<div class="comment-content">
<p>And with 64-bits, they are easy to find! I did this exercise recently with FNV-1a: <a href="https://twitter.com/pstbrn/status/1201044024892829697" rel="nofollow ugc">https://twitter.com/pstbrn/status/1201044024892829697</a></p>
</div>
<ol class="children">
<li id="comment-466631" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/197266eab5b4d533a5ec3ea83efe2143?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/197266eab5b4d533a5ec3ea83efe2143?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Peter</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-13T22:00:52+00:00">December 13, 2019 at 10:00 pm</time></a> </div>
<div class="comment-content">
<p>(This is hash collisions, not random identifiers. But finding them used the same principle – birthday attack.)</p>
</div>
</li>
</ol>
</li>
<li id="comment-467558" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://h2database.com" class="url" rel="ugc external nofollow">Thomas Müller Graf</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-14T17:29:18+00:00">December 14, 2019 at 5:29 pm</time></a> </div>
<div class="comment-content">
<p>Randomly generated UUIDs, which are 122 bits, are less problematic: the probability of getting a duplicate is much lower than the probability of being hit by a meteorite (I calculated that some time ago and put it on Wikipedia, but somebody edited it away).</p>
<p>128-bit values are even better. However, there is a risk if you generate them with a &ldquo;lower quality&rdquo; hash function (not sure what low quality is&#8230; Murmur hash seems OK, SipHash is better I think). If an attacker can supply the data, then MD4, MD5, and even SHA-1 are risky: the attacker could use specially crafted data that will result in a hash collision. So, for this case, better use SHA-256.</p>
</div>
</li>
<li id="comment-476616" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3d6bd74e2e7210c80f9e12d1638878d2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3d6bd74e2e7210c80f9e12d1638878d2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">John the Scott</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-21T16:45:02+00:00">December 21, 2019 at 4:45 pm</time></a> </div>
<div class="comment-content">
<p>what about a 160 bit hash built by ripemd(sha256), i.e, bitcoin?</p>
</div>
<ol class="children">
<li id="comment-477310" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-23T16:11:25+00:00">December 23, 2019 at 4:11 pm</time></a> </div>
<div class="comment-content">
<p>160-bit is perfectly fine.</p>
<p>There is a huge difference between 64-bit and 160-bit.</p>
</div>
</li>
</ol>
</li>
<li id="comment-650945" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9a78129936336ad2d7c08960afcbeb11?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9a78129936336ad2d7c08960afcbeb11?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://ricardogeek.com" class="url" rel="ugc external nofollow">Ricardo</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-18T00:52:49+00:00">April 18, 2023 at 12:52 am</time></a> </div>
<div class="comment-content">
<p>And that is why I always choose sequential id assignment instead of random 🙂</p>
<p>This is, however, an interesting idea. What would be the probability to collide twice in a row if whenever we find a collision we retry and generate a new random 64-bot id?</p>
</div>
</li>
</ol>
