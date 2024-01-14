---
date: "2020-03-18 12:00:00"
title: "Avoiding cache line overlap by replacing one 256-bit store with two 128-bit stores"
index: false
---

[6 thoughts on &ldquo;Avoiding cache line overlap by replacing one 256-bit store with two 128-bit stores&rdquo;](/lemire/blog/2020/03-18-avoiding-cache-line-overlap-by-replacing-one-256-bit-store-with-two-128-bit-stores)

<ol class="comment-list">
<li id="comment-496956" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://example.com" class="url" rel="ugc external nofollow">degski</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-18T16:03:46+00:00">March 18, 2020 at 4:03 pm</time></a> </div>
<div class="comment-content">
<p>Multi-threading will influence that though, unless I&rsquo;m misunderstanding things. Changes in a cache-line on one core are not immediately visible in that cache-line viewed from another core [and not necessarily in that order] and needs to be &lsquo;synchronized&rsquo; [the tech-term is surely something else, but], which takes time/cycles.</p>
<p>In C++, the alignment of the object will be at least it&rsquo;s size, aligning on 48 bits is UB [casting a void pointer returned from malloc to a type, does not create (an) object(s) of that type and even for &lsquo;objects&rsquo; of type int, this is technically UB, one needs to go through placement new, which imposes the alignment].</p>
<p>Having said that, current compilers don&rsquo;t seem to have a problem with any of the above.</p>
</div>
<ol class="children">
<li id="comment-496985" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-18T21:01:36+00:00">March 18, 2020 at 9:01 pm</time></a> </div>
<div class="comment-content">
<p>In this instance, I am relying on Intel intrinsics which have &ldquo;unaligned&rdquo; as part of their specification (look for the small &ldquo;u&rdquo; in the name). So my code is not relying on undefined behaviour.</p>
</div>
</li>
</ol>
</li>
<li id="comment-499070" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/84663519e417a83e0ba5d38c8997586f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/84663519e417a83e0ba5d38c8997586f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">burak</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-02T18:22:18+00:00">April 2, 2020 at 6:22 pm</time></a> </div>
<div class="comment-content">
<p>Thank you for sharing this is very interesting read. Yet still I have to split __m256 is it correct? Right now I was struggling with similar problem and got exited when I read this post but I think still not the answer to my problem, that I had 12% cache misses because I had tiled/vectorized a 3 dim large nested array. So each iteration is jumping way forward, without tiling got 1% but additional second on process time</p>
</div>
<ol class="children">
<li id="comment-499077" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-02T19:38:21+00:00">April 2, 2020 at 7:38 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t understand why you would get more cache misses&#8230; It should not matter how you read the data as far as cache misses go. You could read the data byte-by-byte&#8230; and still get the same number of cache misses.</p>
</div>
<ol class="children">
<li id="comment-499082" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/84663519e417a83e0ba5d38c8997586f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/84663519e417a83e0ba5d38c8997586f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">burak</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-02T20:44:15+00:00">April 2, 2020 at 8:44 pm</time></a> </div>
<div class="comment-content">
<p>Sorry dont have exact answer and for cryptic code, still studying/working on it,now code looks like this:</p>
<p><code>..another loop...<br/>
int siz = n1 - (n1 &amp; 7);<br/>
int mi = dMatrixInfo[i][1];<br/>
for (int j = 0; j &lt; siz; j = j + 8) {<br/>
...<br/>
float *d2 = &amp;(d[mi * m++]);<br/>
float *d22 = &amp;(d[mi * m++]);<br/>
float *d23 = &amp;(d[mi * m++]);<br/>
float *d24 = &amp;(d[mi * m++]);<br/>
float *d25 = &amp;(d[mi * m++]);<br/>
float *d26 = &amp;(d[mi * m++]);<br/>
float *d27 = &amp;(d[mi * m++]);<br/>
float *d28 = &amp;(d[mi * m]);<br/>
int size = n2 - (n2 &amp; 7);<br/>
for (int k = 0; k &lt; size; k = k + 8) {<br/>
_mulAddBroadcast(&amp;d2[k], &amp;eVal, &amp;n[k]);<br/>
_mulAddBroadcast(&amp;d22[k], &amp;eVal2, &amp;n[k]);<br/>
_mulAddBroadcast(&amp;d23[k], &amp;eVal3, &amp;n[k]);<br/>
_mulAddBroadcast(&amp;d24[k], &amp;eVal4, &amp;n[k]);<br/>
_mulAddBroadcast(&amp;d25[k], &amp;eVal5, &amp;n[k]);<br/>
_mulAddBroadcast(&amp;d26[k], &amp;eVal6, &amp;n[k]);<br/>
_mulAddBroadcast(&amp;d27[k], &amp;eVal7, &amp;n[k]);<br/>
_mulAddBroadcast(&amp;d28[k], &amp;eVal8, &amp;n[k]);<br/>
....<br/>
</code></p>
<p>which I have tiled from</p>
<p><code>int size = n2 - (n2 &amp; 7);<br/>
for (int d = 0; d &lt; size; d += 8) {<br/>
_mulAddBroadcast(&amp;d2[d], &amp;eVal, &amp;n[d]);<br/>
}<br/>
for (int d = size; d &lt; n2; d++) {<br/>
d2[d] = fma(eVal, n[d], d2[d]);<br/>
}<br/>
</code></p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-501188" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/acd516f5768a6eb4d8efdabab9393bcb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/acd516f5768a6eb4d8efdabab9393bcb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.mayaofauckland.com" class="url" rel="ugc external nofollow">Charles Goodwin</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-14T22:27:46+00:00">April 14, 2020 at 10:27 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve been using headers on various data types, so a string might be stored as a pointer to the character data, with some extra information stored immediately before the first character in memory. If I access the character data, then step backwards to get an item from the header, am I likely to get a cache miss / stall that I might not get if I stored a pointer to the start of the header and accessed the character data as an offset from that?</p>
</div>
</li>
</ol>
