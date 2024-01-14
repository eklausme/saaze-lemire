---
date: "2023-10-17 12:00:00"
title: "Randomness in programming (with Go code)"
index: false
---

[4 thoughts on &ldquo;Randomness in programming (with Go code)&rdquo;](/lemire/blog/2023/10-17-randomness-in-programming-with-go-code)

<ol class="comment-list">
<li id="comment-655486" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ab77f5ba95a5361f8de1d8a71d82f087?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ab77f5ba95a5361f8de1d8a71d82f087?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Pasha</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-17T12:21:21+00:00">October 17, 2023 at 12:21 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for explaining</p>
</div>
</li>
<li id="comment-655500" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://zeux.io" class="url" rel="ugc external nofollow">Arseny Kapoulkine</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-18T02:14:01+00:00">October 18, 2023 at 2:14 am</time></a> </div>
<div class="comment-content">
<p>estimateCardinality will panic when any input hashes to 0.</p>
<p>Additionally it will grossly overrepresent the cardinality if any inputs hash to a small integer, and given the hash determinism and the ease with which this can be achieved as a result, this function should probably not be used in production code or, indeed, in example code.</p>
</div>
</li>
<li id="comment-655501" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://zeux.io" class="url" rel="ugc external nofollow">Arseny Kapoulkine</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-18T02:15:51+00:00">October 18, 2023 at 2:15 am</time></a> </div>
<div class="comment-content">
<p>Sent too early, meant to add &ldquo;or, indeed, in example code, absent a very large warning/disclaimer comment&rdquo;.</p>
</div>
</li>
<li id="comment-656304" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/70df0ae3d431061c72ffd10f81f41f5d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/70df0ae3d431061c72ffd10f81f41f5d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Henrik Johansen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-24T01:48:12+00:00">November 24, 2023 at 1:48 am</time></a> </div>
<div class="comment-content">
<p>I think the 2^24 random float values in 0 &#8211; 1 is simpler to explain if you start with the uniformity requirement.<br/>
Each exponent will have uniformly distributed values, and the exponent with largest distance between values is -1, covering 0.5 &#8211; 1.<br/>
To stay uniform, you can only use that many values in 0 &#8211; 0.5, hence<br/>
2^23 * 2 = 2^24</p>
</div>
</li>
</ol>
