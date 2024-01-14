---
date: "2023-02-07 12:00:00"
title: "Bit Hacking (with Go code)"
index: false
---

[9 thoughts on &ldquo;Bit Hacking (with Go code)&rdquo;](/lemire/blog/2023/02-07-bit-hacking-with-go-code)

<ol class="comment-list">
<li id="comment-649195" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Marcin Zukowski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-08T22:04:14+00:00">February 8, 2023 at 10:04 pm</time></a> </div>
<div class="comment-content">
<p>Interesting article, skimmed through it, lots of known techniques that are worth publicizing more!</p>
<p>The discussion of the knowledge of the internal representation of values made me think back to something I stumbled on recently in one Intel library.<br/>
It was a way to compute leading binary zeroes for architectures that don&rsquo;t have CLZ (I assume). Roughly this (simplified):</p>
<p><code> typedef union {<br/>
int64_t ui64;<br/>
double dbl;<br/>
} doubleint;</p>
<p>int clz(int64_t x) {<br/>
doubleint tmp;<br/>
if (x &gt;= 0x0020000000000000ull) { // x &gt;= 2^53<br/>
// split the 64-bit value in two 32-bit halves to avoid rounding errors<br/>
tmp.dbl = (double) (x &gt;&gt; 32); // exact conversion<br/>
return 31 - ((((unsigned int) (tmp.ui64 &gt;&gt; 52)) &amp; 0x7ff) - 0x3ff);<br/>
} else { // if x &lt; 2^53<br/>
tmp.dbl = (double) x; // exact conversion<br/>
return 63 - ((((unsigned int) (tmp.ui64 &gt;&gt; 52)) &amp; 0x7ff) - 0x3ff);<br/>
}<br/>
}<br/>
</code></p>
<p>What happens here is that the author exploits the fact that <code>double</code> normalizes the mantisa, and then extracts the number of leading zeroes from the <code>double's</code> exponent.</p>
<p>Fast? Yes, if we don&rsquo;t have CLZ. So no 🙂</p>
<p>Beautiful? For me, yes! 🙂</p>
</div>
</li>
<li id="comment-649196" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-08T22:29:03+00:00">February 8, 2023 at 10:29 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>lots of known techniques that are worth publicizing more!</p>
</blockquote>
<p>I think you can spend all your life being a very productive programmer without knowing any of this well. But I think you should know that it exists if you want to do serious programming.</p>
</div>
</li>
<li id="comment-649199" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8149b5bd66abbc94babfda2995153481?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8149b5bd66abbc94babfda2995153481?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nevin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-09T00:22:49+00:00">February 9, 2023 at 12:22 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
the number 1&lt;&lt;12 has 64-12=52 leading zeros followed by a 1 with 11 trailing zeros.
</p></blockquote>
<p>This is off-by-one.</p>
</div>
<ol class="children">
<li id="comment-649200" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-09T04:08:44+00:00">February 9, 2023 at 4:08 am</time></a> </div>
<div class="comment-content">
<p>Much appreciated.</p>
</div>
</li>
</ol>
</li>
<li id="comment-649201" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b3070ad3bb35d6e518f2dd2ba96c55c9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b3070ad3bb35d6e518f2dd2ba96c55c9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://eskamation.de" class="url" rel="ugc external nofollow">Stefan Kanthak</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-09T07:07:47+00:00">February 9, 2023 at 7:07 am</time></a> </div>
<div class="comment-content">
<p>&ldquo;Once we have determined that we have a value that might correspond to a surrogate pair, we may check that the first value x1 is valid (in the range 0xd800 to 0xdbff) with the condition (x-0xd800)&lt;=0x3ff, and similarly for the second value x2: (x-0xdc00)&lt;=0x3ff. &rdquo;</p>
<p>An initial (separate) test (x-0xd800) &lt;=x7ff) of high and low code unit is superfluous; ((x-0xd800)&lt;=0x3ff) &amp;&amp; ((x-0xdc00)&lt;=0x3ff) does the job.<br/>
What you but failed to mention is: the latter can be simplified to ((x-0xd800)|(x-0xdc00))&lt;=0x3ff eventually saving the conditional branch for &amp;&amp;</p>
</div>
</li>
<li id="comment-649203" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b3070ad3bb35d6e518f2dd2ba96c55c9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b3070ad3bb35d6e518f2dd2ba96c55c9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://eskamation.de" class="url" rel="ugc external nofollow">Stefan Kanthal</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-09T07:42:20+00:00">February 9, 2023 at 7:42 am</time></a> </div>
<div class="comment-content">
<p>&ldquo;We may then reconstruct the code point as ((x-0xd800)&lt;&lt;10) + x-0xdc00.&rdquo;</p>
<p>Nope! The code point is (1&lt;&lt;20) + ((x-0xd800)&lt;&lt;10) + x-0xdc00 or the equivalent (1&lt;&lt;20) | ((x-0xd800)&lt;&lt;10) | (x-0xdc00).</p>
</div>
<ol class="children">
<li id="comment-649208" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-09T13:47:33+00:00">February 9, 2023 at 1:47 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for catching the mistake !</p>
</div>
</li>
</ol>
</li>
<li id="comment-649219" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/032cfee9354a3b4e7484a2956c795aee?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/032cfee9354a3b4e7484a2956c795aee?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://BUGFIX-66.com" class="url" rel="ugc external nofollow">BUGFIX-66</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-10T15:15:12+00:00">February 10, 2023 at 3:15 pm</time></a> </div>
<div class="comment-content">
<p>A variety of interesting and useful bitwise trick and techniques from Hacker&rsquo;s Delight and The Art of Computer Programming (section 7.1.3) are available as Go programming puzzles here: <a href="https://BUGFIX-66.com" rel="nofollow ugc">https://BUGFIX-66.com</a> (Enjoy!)</p>
</div>
</li>
<li id="comment-649410" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/afaef1e78dce43ef7cc1658596d98f81?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/afaef1e78dce43ef7cc1658596d98f81?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">shogg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-21T21:39:48+00:00">February 21, 2023 at 9:39 pm</time></a> </div>
<div class="comment-content">
<p>A famous source for bit hacks is: <a href="https://graphics.stanford.edu/~seander/bithacks.html" rel="nofollow ugc">https://graphics.stanford.edu/~seander/bithacks.html</a></p>
<p>I applied one of them here in a programming challenge: <a href="https://github.com/plutov/practice-go/blob/fa1e3e4b874f6ce7844175ce5fd6546dcd48c544/brokennode/brokennode.go#L86" rel="nofollow ugc">https://github.com/plutov/practice-go/blob/fa1e3e4b874f6ce7844175ce5fd6546dcd48c544/brokennode/brokennode.go#L86</a></p>
<p>Great success.</p>
</div>
</li>
</ol>
