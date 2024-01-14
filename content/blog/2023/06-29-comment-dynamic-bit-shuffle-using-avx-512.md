---
date: "2023-06-29 12:00:00"
title: "Dynamic bit shuffle using AVX-512"
index: false
---

[15 thoughts on &ldquo;Dynamic bit shuffle using AVX-512&rdquo;](/lemire/blog/2023/06-29-dynamic-bit-shuffle-using-avx-512)

<ol class="comment-list">
<li id="comment-652595" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-29T20:48:33+00:00">June 29, 2023 at 8:48 pm</time></a> </div>
<div class="comment-content">
<p>Likely faster to just use the purpose built <code>vpshufbitqmb</code>: <a href="https://godbolt.org/z/qssovhbcr" rel="nofollow ugc">https://godbolt.org/z/qssovhbcr</a></p>
</div>
<ol class="children">
<li id="comment-652598" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-29T21:51:01+00:00">June 29, 2023 at 9:51 pm</time></a> </div>
<div class="comment-content">
<p>Blog post updated, thanks.</p>
</div>
<ol class="children">
<li id="comment-652617" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4bc21acc099b8494cec70b866e9b5b22?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4bc21acc099b8494cec70b866e9b5b22?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sasha Krassovsky</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-30T19:07:17+00:00">June 30, 2023 at 7:07 pm</time></a> </div>
<div class="comment-content">
<p>Have you profiled <code>bitshuffle</code>? I remember trying to implement bit unpacking with it and it was MUCH slower than the AVX2 version of fastunpack.</p>
</div>
<ol class="children">
<li id="comment-652618" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-30T19:24:27+00:00">June 30, 2023 at 7:24 pm</time></a> </div>
<div class="comment-content">
<p>I haven&rsquo;t benchmarked it. What is certain is that we have far fewer instructions with it.</p>
</div>
</li>
<li id="comment-652621" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-01T00:26:27+00:00">July 1, 2023 at 12:26 am</time></a> </div>
<div class="comment-content">
<p>Keep in mind that this article is about <em>arbitrarily</em> shuffling <em>one</em> 64-bit integer.</p>
<p>If you&rsquo;re handling more than one integer, and the permutation isn&rsquo;t so arbitrary, there may be faster approaches.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-652602" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2aacafa76beb78c7beb2f8f58417935d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2aacafa76beb78c7beb2f8f58417935d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://majid.info/" class="url" rel="ugc external nofollow">Fazal Majid</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-30T01:17:34+00:00">June 30, 2023 at 1:17 am</time></a> </div>
<div class="comment-content">
<p>And ARM does it in a single rbit instruction&#8230;</p>
<p>Who is the RISC again?</p>
</div>
<ol class="children">
<li id="comment-652603" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-30T02:05:32+00:00">June 30, 2023 at 2:05 am</time></a> </div>
<div class="comment-content">
<p><code>rbit</code> only reverses bits. It doesn&rsquo;t do an arbitrary bit shuffle.</p>
<p>AArch64&rsquo;s NEON would actually do a decent job (better than SSE4), but the instruction sequence would be much longer than what is achievable with AVX-512.</p>
<p>Having said that, an AVX2/NEON implementation would be interesting. Should be possible to rshift the indexes by 3, shuffle bytes into the right location, then use a <code>TEST</code> to amplify the relevant bits, then extract them.</p>
</div>
<ol class="children">
<li id="comment-652626" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/87f06afd784d1cf0462f683f7075feaa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/87f06afd784d1cf0462f683f7075feaa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Laine Taffin Altman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-01T04:16:01+00:00">July 1, 2023 at 4:16 am</time></a> </div>
<div class="comment-content">
<p>Speaking of AArch64—how does SVE(2) fare at this? Might you be able to cleverly exploit BGRP/BDEP/BEXT for this, or just do something similar to AVX-512 using the predicate registers?</p>
</div>
<ol class="children">
<li id="comment-652636" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-01T17:16:27+00:00">July 1, 2023 at 5:16 pm</time></a> </div>
<div class="comment-content">
<p>One fun issue is that SVE has variable length registers.</p>
</div>
</li>
</ol>
</li>
<li id="comment-652627" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/87f06afd784d1cf0462f683f7075feaa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/87f06afd784d1cf0462f683f7075feaa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Laine Taffin Altman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-01T04:44:59+00:00">July 1, 2023 at 4:44 am</time></a> </div>
<div class="comment-content">
<p>Ooo, wait, idea! Totally untested asm follows; should fit the same C signature as the rest:</p>
<p><code>mov x2, #0<br/>
mov d0, #0<br/>
loop:<br/>
whilelo p0.d, x2, #64<br/>
b.none loop_end<br/>
mov z1.d, p0/z, x0<br/>
ld1d z2.d, p0/z, [x1, x2]<br/>
lsr z1.d, p0/m, z2.d<br/>
and z1.d, p0/m, #1<br/>
lsl z1.d, p0/m, z2.d<br/>
orv d1, p0, z1<br/>
orr d0, d0, d1<br/>
incd x2<br/>
b loop<br/>
loop_end:<br/>
mov x0, d0<br/>
ret<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-652643" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-02T01:43:25+00:00">July 2, 2023 at 1:43 am</time></a> </div>
<div class="comment-content">
<p>Untested here as well, but my gut says that won&rsquo;t work, because you&rsquo;re shifting the bits back to their original position after singling them out. You could probably make it work if the <code>lsl</code> shifted the bits based on <code>index</code> (which needs to be incremented each loop cycle).</p>
<p>More problematic is that you&rsquo;re only processing one bit per 64, which doesn&rsquo;t exactly scream fast (not to mention that horizontal reductions like <code>orv</code> typically aren&rsquo;t highly performant either).</p>
<p>The challenge with SVE2 is that the vector width isn&rsquo;t fixed, whilst this is a fixed width problem (single 64-bit value).<br/>
You could take a similar approach to an SSE/NEON implementation, using a TBL+shift then extracting bits via the predicate. For vector width &gt;=512-bit, you could also use a similar approach to what&rsquo;s described in the first post (skipping the need to shift), though you&rsquo;d need to implement two code paths with this technique.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-652608" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6504fad0830c1dd03086ee35097cea11?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6504fad0830c1dd03086ee35097cea11?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">camel-cdr</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-30T09:32:51+00:00">June 30, 2023 at 9:32 am</time></a> </div>
<div class="comment-content">
<p>I had a go at a rvv implementation, I&rsquo;m not able to test it rn, but I think it&rsquo;s roughly correct. Probably not optimal though:</p>
<p><code>vsetivli x0, 1, e64, m1, ma, ta<br/>
vle8.v v0, (a0) # load uint64_t<br/>
vsetivli x0, 64, e16, m8, ma, ta<br/>
vle8.v v8, (a1) # load uint16_t[64]<br/>
vsetivli x0, 64, e8, m4, ma, ta<br/>
vmv.v.i v4, 1<br/>
vmv.v.i v4, 0, v0 # mask to 0/1 bytes<br/>
vrgathere16.vv v4, v4, v8 # gather does the shuffle<br/>
vmseq.vi v0, v4, 0 # 0/1 bytes to mask<br/>
vsetivli x0, 1, e64, m1, ma, ta<br/>
vse8.v v0, (a1) # store mask<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-652609" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6504fad0830c1dd03086ee35097cea11?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6504fad0830c1dd03086ee35097cea11?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">camel-cdr</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-30T09:35:04+00:00">June 30, 2023 at 9:35 am</time></a> </div>
<div class="comment-content">
<p>I forgot to mention that the above should work for any implementation with a vlen&gt;=128.</p>
</div>
<ol class="children">
<li id="comment-652612" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6504fad0830c1dd03086ee35097cea11?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6504fad0830c1dd03086ee35097cea11?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">camel-cdr</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-30T16:05:58+00:00">June 30, 2023 at 4:05 pm</time></a> </div>
<div class="comment-content">
<p>Edit: It should&rsquo;ve been vmerge.vim instead of the second vmv.v.i, because that one isn&rsquo;t maskable.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-652611" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6f6634857da64cf0d6ce68952e51620d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6f6634857da64cf0d6ce68952e51620d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">MajorTom</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-30T14:09:25+00:00">June 30, 2023 at 2:09 pm</time></a> </div>
<div class="comment-content">
<p>I don’t know when, or why, but you just saved me hours upon hours of research in the future. Thanks in advance!</p>
</div>
</li>
</ol>
