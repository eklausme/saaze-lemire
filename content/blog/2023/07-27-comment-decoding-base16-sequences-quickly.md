---
date: "2023-07-27 12:00:00"
title: "Decoding base16 sequences quickly"
index: false
---

[4 thoughts on &ldquo;Decoding base16 sequences quickly&rdquo;](/lemire/blog/2023/07-27-decoding-base16-sequences-quickly)

<ol class="comment-list">
<li id="comment-653269" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2f4c567fa22e1d1949be12e161fcab5b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2f4c567fa22e1d1949be12e161fcab5b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">aqrit</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-27T19:43:48+00:00">July 27, 2023 at 7:43 pm</time></a> </div>
<div class="comment-content">
<p>Geoff Langdale&rsquo;s implementation was likely meant to be SSE2 compatible, whereas vectorized table lookups require SSSE3.</p>
</div>
<ol class="children">
<li id="comment-653272" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-27T21:28:44+00:00">July 27, 2023 at 9:28 pm</time></a> </div>
<div class="comment-content">
<p>You can find the implementation there:<br/>
<a href="https://github.com/WojciechMula/toys/blob/master/simd-parse-hex/geoff_algorithm.cpp" rel="nofollow ugc">https://github.com/WojciechMula/toys/blob/master/simd-parse-hex/geoff_algorithm.cpp</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-653502" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/275d6ccbf6ac0d40942ed813e1aa38c7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/275d6ccbf6ac0d40942ed813e1aa38c7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">sasuke420</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-08-05T18:10:12+00:00">August 5, 2023 at 6:10 pm</time></a> </div>
<div class="comment-content">
<p>for my current solution to this sort of problem at <a href="https://highload.fun/" rel="nofollow ugc">https://highload.fun/</a> I am using this sequence</p>
<p><code>const u8x32 pack_odd = _mm256_setr_epi8(<br/>
15, 13, 11, 9, 7, 5, 3, 1, 15, 13, 11, 9, 7, 5, 3, 1,<br/>
15, 13, 11, 9, 7, 5, 3, 1, 15, 13, 11, 9, 7, 5, 3, 1);<br/>
....<br/>
const u8x32 f_0 = _mm256_slli_epi16(e_0, 12);<br/>
const u8x32 g_0 = _mm256_or_si256(f_0, e_0);<br/>
const u8x32 h_0 = _mm256_shuffle_epi8(g_0, pack_odd);<br/>
</code></p>
<p>rather than something like</p>
<p><code>__m128i t3 = _mm_maddubs_epi16(v, _mm_set1_epi16(0x0110));<br/>
__m128i t5 = _mm_packus_epi16(t3, t3);<br/>
</code></p>
<p>I&rsquo;ll have to try that out. The docs say I&rsquo;ll suffer some latency loss, but it could still be a win.</p>
</div>
<ol class="children">
<li id="comment-653503" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/275d6ccbf6ac0d40942ed813e1aa38c7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/275d6ccbf6ac0d40942ed813e1aa38c7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">sasuke420</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-08-05T18:12:07+00:00">August 5, 2023 at 6:12 pm</time></a> </div>
<div class="comment-content">
<p>Well, now that I look at what I&rsquo;ve posted it looks like I am packing and bswapping at the same time, so I would need the shuffle anyway.</p>
</div>
</li>
</ol>
</li>
</ol>
