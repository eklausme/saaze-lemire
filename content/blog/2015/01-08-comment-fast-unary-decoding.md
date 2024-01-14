---
date: "2015-01-08 12:00:00"
title: "Fast unary decoding"
index: false
---

[9 thoughts on &ldquo;Fast unary decoding&rdquo;](/lemire/blog/2015/01-08-fast-unary-decoding)

<ol class="comment-list">
<li id="comment-144987" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" decoding="async" /> <b class="fn">JS</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-01-08T13:40:06+00:00">January 8, 2015 at 1:40 pm</time></a> </div>
<div class="comment-content">
<p>See also __builtin_ctzll, _mm_tzcnt_64 and friends.</p>
</div>
</li>
<li id="comment-144989" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-01-08T14:16:16+00:00">January 8, 2015 at 2:16 pm</time></a> </div>
<div class="comment-content">
<p>This looks like some fun bit-twiddling.</p>
<p>For the table-based method, would it work if for each byte you just store the lsb position and the byte without the lsb? </p>
<p>Then you just look up the lsb position, replace the looked-up operand with its lsb-less version, and iterate until 0.</p>
</div>
</li>
<li id="comment-144992" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-01-08T15:27:07+00:00">January 8, 2015 at 3:27 pm</time></a> </div>
<div class="comment-content">
<p>@KWillets</p>
<p>Part of my motivation for posting this here is to encourage others to try their own designs. There are many other strategies.</p>
<p>I think that your approach would use less memory, but I think it would be slower.</p>
</div>
</li>
<li id="comment-144993" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-01-08T15:28:58+00:00">January 8, 2015 at 3:28 pm</time></a> </div>
<div class="comment-content">
<p>@JS</p>
<p>I think that the instruction you want is popcnt with the corresponding _mm_popcnt_u64 intrinsic. I believe that other instructions are likely to give you slower code.</p>
<p>Update: This conjecture was false.</p>
</div>
</li>
<li id="comment-145008" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anonymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-01-08T19:14:40+00:00">January 8, 2015 at 7:14 pm</time></a> </div>
<div class="comment-content">
<p>@Daniel,</p>
<p>actually, you may be wrong. I tried the suggested function and it was always faster. On my laptop the difference is small, but it is more dramatic on fastpfor for some reason.</p>
<p>Try this implementation:</p>
<p>int bitscanunary_ctzl(long *bitmap, int bitmapsize, int *out) {<br/>
int pos = 0;<br/>
int val = 0, newval = 0;<br/>
for(int k = 0; k &lt; bitmapsize; ++k) {<br/>
unsigned long bitset = bitmap[k];<br/>
while (bitset != 0) {<br/>
long t = bitset &amp; -bitset;<br/>
int r = __builtin_ctzl(bitset);<br/>
newval = k * 64 + r;<br/>
out[pos++] = newval &#8211; val;<br/>
val = newval;<br/>
bitset ^= t;<br/>
}<br/>
}<br/>
return pos;<br/>
}</p>
</div>
</li>
<li id="comment-145024" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-01-08T21:39:58+00:00">January 8, 2015 at 9:39 pm</time></a> </div>
<div class="comment-content">
<p>@Anonymous</p>
<p>Indeed, the approach __builtin_ctzl can be faster. I was wrong. I have updated my blog post.</p>
</div>
</li>
<li id="comment-247064" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fa0a21a08d4f80989ffb4fa1ffcbfa5e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fa0a21a08d4f80989ffb4fa1ffcbfa5e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bulat Ziganshin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-15T18:27:44+00:00">July 15, 2016 at 6:27 pm</time></a> </div>
<div class="comment-content">
<p>I think that any possible implementation would stall a lot due to instruction dependencies. by running multiple decoders in parallel (in the same OS thread) you can make it much faster. the same may apply to your turbopfor library</p>
</div>
</li>
<li id="comment-591491" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/59edf34afc9c92feaeff1b70c730fed8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/59edf34afc9c92feaeff1b70c730fed8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-20T11:28:41+00:00">July 20, 2021 at 11:28 am</time></a> </div>
<div class="comment-content">
<p>The graph seems strange &#8211; I expect that the lookup table approach will take a constant time regardless of the number of set bits in a byte.</p>
</div>
<ol class="children">
<li id="comment-591501" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-20T12:46:46+00:00">July 20, 2021 at 12:46 pm</time></a> </div>
<div class="comment-content">
<p>Decoding speed does depend on the density. Why would it not?</p>
<p>This being said, the code is available. I invite you to review the code and run it for yourself if you&rsquo;d like.</p>
</div>
</li>
</ol>
</li>
</ol>
