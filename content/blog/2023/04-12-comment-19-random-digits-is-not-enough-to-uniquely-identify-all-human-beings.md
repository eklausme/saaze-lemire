---
date: "2023-04-12 12:00:00"
title: "19 random digits is not enough to uniquely identify all human beings"
index: false
---

[6 thoughts on &ldquo;19 random digits is not enough to uniquely identify all human beings&rdquo;](/lemire/blog/2023/04-12-19-random-digits-is-not-enough-to-uniquely-identify-all-human-beings)

<ol class="comment-list">
<li id="comment-650684" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Marcin Zukowski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-13T03:54:34+00:00">April 13, 2023 at 3:54 am</time></a> </div>
<div class="comment-content">
<p>This reminds me of an old idea for hash tables, useful esp. with complex keys.</p>
<p>With 128-bit hash values, if the hash function is good, the probability of an actual key conflict on the same hash value is smaller than the probability of a server getting hit by a comet 🙂 So we don&rsquo;t need to do the value equality check, possibly saving a lot of time.</p>
<p>Alas, I never trusted a hash function enough to actually apply this in a production system.</p>
</div>
<ol class="children">
<li id="comment-650710" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-13T13:14:54+00:00">April 13, 2023 at 1:14 pm</time></a> </div>
<div class="comment-content">
<p>I love your comment. See my blog post&#8230; <a href="https://lemire.me/blog/2013/06/17/hashing-and-the-birthday-paradox-cautionary-tale/" rel="ugc">Hashing and the Birthday paradox: a cautionary tale</a>.</p>
</div>
</li>
<li id="comment-650967" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/046f724891fd8da6b314b6517fec423b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/046f724891fd8da6b314b6517fec423b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jimbo</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-18T07:25:38+00:00">April 18, 2023 at 7:25 am</time></a> </div>
<div class="comment-content">
<p>It would be nice if you added the calculation for this probability.</p>
</div>
<ol class="children">
<li id="comment-650994" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-18T17:46:46+00:00">April 18, 2023 at 5:46 pm</time></a> </div>
<div class="comment-content">
<p>Have you checked out the earlier blog post I link to?</p>
<p><a href="https://lemire.me/blog/2019/12/12/are-64-bit-random-identifiers-free-from-collision/" rel="ugc">https://lemire.me/blog/2019/12/12/are-64-bit-random-identifiers-free-from-collision/</a></p>
</div>
</li>
<li id="comment-651015" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marcin Zukowski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-19T01:30:50+00:00">April 19, 2023 at 1:30 am</time></a> </div>
<div class="comment-content">
<p>Admittedly, it depends a bit on your assumptions and how you compute things</p>
<p>There are 3 considerations:</p>
<p>Size of a hash domain: <code>2^128</code><br/>
Number of distinct keys that might be used in the same environment where a collision might cause a problem &#8211; here one can argue, I think something like <code>2^50</code> is very generous.<br/>
Probability of a meteorite hitting the Earth</p>
<p>From 1 and 2 we can get the probability of collision of roughly 1 in <code>10^9</code>.</p>
<p>Assuming a civilization-destroying meteorite hits us every 1 million years, that means that a probability of it hitting on a given day is more than 1 in <code>10^9</code>.</p>
<p>😀</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-650946" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c45e4bfe3886328e3f90364a3c83bd24?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c45e4bfe3886328e3f90364a3c83bd24?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anonymouse</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-18T01:05:55+00:00">April 18, 2023 at 1:05 am</time></a> </div>
<div class="comment-content">
<p>There&rsquo;s a very recent preprint addressing exactly this problem: <a href="https://arxiv.org/pdf/2304.07109.pdf" rel="nofollow ugc">https://arxiv.org/pdf/2304.07109.pdf</a></p>
</div>
</li>
</ol>
