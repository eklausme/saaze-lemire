---
date: "2021-09-11 12:00:00"
title: "Random identifiers are poorly compressible"
index: false
---

[2 thoughts on &ldquo;Random identifiers are poorly compressible&rdquo;](/lemire/blog/2021/09-11-random-identifiers-are-poorly-compressible)

<ol class="comment-list">
<li id="comment-597677" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Thomas Müller Graf</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-09-12T09:54:23+00:00">September 12, 2021 at 9:54 am</time></a> </div>
<div class="comment-content">
<p>Compressibility is one concern, performance is another (write, lookup,&#8230;). Some operations can be 100 times slower with random identifiers. To solve this, there is a new types of UUIDs that are &ldquo;less&rdquo; random: <a href="https://news.ycombinator.com/item?id=28088213" rel="nofollow ugc">https://news.ycombinator.com/item?id=28088213</a> &#8211; by using a more-or-less precise timestamp, plus some random bits. I think it would be interesting to analyze compressibility with those as well.</p>
</div>
</li>
<li id="comment-597680" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fb75fbfd9dd8d93d49ff88c152d82c92?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fb75fbfd9dd8d93d49ff88c152d82c92?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://neosmart.net/" class="url" rel="ugc external nofollow">Mahmoud Al-Qudsi</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-09-12T11:24:04+00:00">September 12, 2021 at 11:24 am</time></a> </div>
<div class="comment-content">
<p>The reason to use uuid column types in a database is so you can skip locking dB sequences or using synchronization strategies like HiLo and just generate collision-free identifiers client-side. Additionally, some databases will use the randomness to give you free uniformly distributed sharding.</p>
<p>But those random identifiers have no intrinsic value. So long as your database is a complete view of the data you wish to compress (i.e. a closed graph with nothing from the outside world pointing in) then one distinct identifier is as good as another. You can consider a compression strategy that replaces uuid x with an (irreversible) one-to-one mapping value y as a form of lossy compression that gives you an equivalent but not identical dataset upon decompression.</p>
<p>Depending on where, how, and why the compression is taking place, that could be good enough. If there is an additional non-constrained channel available for the non-hot path, the mapping could also be exported separately to allow for reversing the mappings out-of-band.</p>
</div>
</li>
</ol>
