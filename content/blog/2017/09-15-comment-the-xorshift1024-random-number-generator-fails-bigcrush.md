---
date: "2017-09-15 12:00:00"
title: "The Xorshift1024* random number generator fails BigCrush"
index: false
---

[5 thoughts on &ldquo;The Xorshift1024* random number generator fails BigCrush&rdquo;](/lemire/blog/2017/09-15-the-xorshift1024-random-number-generator-fails-bigcrush)

<ol class="comment-list">
<li id="comment-286030" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/575869bc1cf09af66d0b7c2ba9fe149a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/575869bc1cf09af66d0b7c2ba9fe149a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.cs.ru.nl/~arjen/" class="url" rel="ugc external nofollow">Arjen</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-16T08:22:05+00:00">September 16, 2017 at 8:22 am</time></a> </div>
<div class="comment-content">
<p>Looks like you should edit the Wikipedia page 😉</p>
</div>
<ol class="children">
<li id="comment-286068" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-16T20:24:40+00:00">September 16, 2017 at 8:24 pm</time></a> </div>
<div class="comment-content">
<p>Editing the Wikipedia pages requires mere seconds, I would rather that independent parties look at the evidence I provide and do the work. Maybe you&rsquo;d like to volunteer to edit the couple of pages in question?</p>
</div>
</li>
</ol>
</li>
<li id="comment-286249" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/221c34e76f43eb000312f7f5038eb619?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/221c34e76f43eb000312f7f5038eb619?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">GÃ© Weijers</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-18T18:44:51+00:00">September 18, 2017 at 6:44 pm</time></a> </div>
<div class="comment-content">
<p>It should come as no surprise that the low order bit(s) of these generators are LFSR sequences. Multiplying the output by any odd number preserves the low order bit.<br/>
It&rsquo;s not all that hard to come up with an RNG that passes TestU01.<br/>
Replacing the &lsquo;next&rsquo; function from the xorshift128+ generator with a variant seems to do the trick:</p>
<p>uint64_t next(void) {<br/>
uint64_t s1 = s[0];<br/>
const uint64_t s0 = s[1];<br/>
//const uint64_t result = s0 + s1;<br/>
const uint64_t result = rotl64(s0, s1 &amp; 0x3f);<br/>
s[0] = s0;<br/>
s1 ^= s1 &lt;&gt; 18) ^ (s0 &gt;&gt; 5); // b, c<br/>
return result;<br/>
}</p>
<p>I have no idea whether that&rsquo;s a high quality RNG, but the performance should be good on most modern processors that use a barrel shifter to implement rotate instructions. I &lsquo;designed&rsquo; it to pass a test suite. Is an RNG that passes TestU01 necessarily &lsquo;better&rsquo; than one that doesn&rsquo;t?</p>
</div>
<ol class="children">
<li id="comment-286255" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-18T19:01:03+00:00">September 18, 2017 at 7:01 pm</time></a> </div>
<div class="comment-content">
<p><em>Is an RNG that passes TestU01 necessarily â€˜better&rsquo; than one that doesn&rsquo;t?</em></p>
<p>I make no such claim myself, though if one is going to argue for statistical quality, one should have some kind of testable argument.</p>
</div>
</li>
</ol>
</li>
<li id="comment-287998" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e1fa5156884630676c054cb539a4141b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e1fa5156884630676c054cb539a4141b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://chasethedevil.github.io" class="url" rel="ugc external nofollow">logos01</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-04T14:40:03+00:00">October 4, 2017 at 2:40 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;The goal standard&rdquo; should be &ldquo;The gold standard&rdquo;</p>
</div>
</li>
</ol>
