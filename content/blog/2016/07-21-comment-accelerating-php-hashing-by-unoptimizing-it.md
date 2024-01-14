---
date: "2016-07-21 12:00:00"
title: "Accelerating PHP hashing by &#8220;unoptimizing&#8221; it"
index: false
---

[4 thoughts on &ldquo;Accelerating PHP hashing by &#8220;unoptimizing&#8221; it&rdquo;](/lemire/blog/2016/07-21-accelerating-php-hashing-by-unoptimizing-it)

<ol class="comment-list">
<li id="comment-247616" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9261e8f3d3df94125bb406a0f90dda50?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9261e8f3d3df94125bb406a0f90dda50?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Isinlor</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-22T08:00:34+00:00">July 22, 2016 at 8:00 am</time></a> </div>
<div class="comment-content">
<p>I allowed myself to post your finding on PHP reddit to spread them in community 🙂 .</p>
<p><a href="https://www.reddit.com/r/PHP/comments/4u1l5z/accelerating_php_hashing_by_unoptimizing_it/" rel="nofollow ugc">https://www.reddit.com/r/PHP/comments/4u1l5z/accelerating_php_hashing_by_unoptimizing_it/</a></p>
</div>
<ol class="children">
<li id="comment-247640" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5277207dadc9ce68a228f38bf8d5f6a7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5277207dadc9ce68a228f38bf8d5f6a7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">mmc</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-22T17:37:17+00:00">July 22, 2016 at 5:37 pm</time></a> </div>
<div class="comment-content">
<p>33 is not prime 🙂</p>
</div>
<ol class="children">
<li id="comment-247650" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-22T19:44:12+00:00">July 22, 2016 at 7:44 pm</time></a> </div>
<div class="comment-content">
<p>Point taken. It is odd so coprime with respect to powers of two.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-247658" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Simon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-22T22:18:52+00:00">July 22, 2016 at 10:18 pm</time></a> </div>
<div class="comment-content">
<p>I raced the DJB hash, the DJB hash with multiplier, and murmurhash3 on a Haswell CPU with ~ 8000 real keys which get hashed when &lsquo;php -v&rsquo; in invoked.</p>
<p>I found that they all run at about the same speed on the Haswell. mmh3 never gets into its stride because although it doesn&rsquo;t hash inefficiently byte by byte, it does do for the tail block of up to 15 bytes, and all of the real keys are under 39 bytes long.</p>
<p>So I raced again using the real set of keys which had been padded to the next 16 byte boundary. This means mmh3 never had to run its slow byte by byte tail code. The result is that mmh3 is nearly 50% faster than the DJB hash.</p>
<p>This makes me wonder how easy it would be to replace the DJB hash in PHP with mmh3, and change PHP strings so that they are always stored padded to the next 16 byte boundary. It would be interesting to see if any larger PHP scripts end up running faster?</p>
</div>
</li>
</ol>
