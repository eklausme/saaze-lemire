---
date: "2018-03-29 12:00:00"
title: "Should you cache hash values even for trivial classes?"
index: false
---

[7 thoughts on &ldquo;Should you cache hash values even for trivial classes?&rdquo;](/lemire/blog/2018/03-29-should-you-cache-hash-values-even-for-trivial-classes)

<ol class="comment-list">
<li id="comment-299595" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Leonid Boytsov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-29T22:56:30+00:00">March 29, 2018 at 10:56 pm</time></a> </div>
<div class="comment-content">
<p>Daniel,</p>
<p>Java Objects are bloated. For most efficient storage of triples, one needs to use type[3], e.g., int[3].</p>
</div>
<ol class="children">
<li id="comment-299596" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-29T23:04:14+00:00">March 29, 2018 at 11:04 pm</time></a> </div>
<div class="comment-content">
<p>You cannot use Java arrays as keys in a hash table. Try it.</p>
</div>
<ol class="children">
<li id="comment-299864" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://boytsov.info" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-03T15:46:19+00:00">April 3, 2018 at 3:46 pm</time></a> </div>
<div class="comment-content">
<p>Sorry, I forgot about this. BTW, I tried to keep integers as 3-int array <em>INSIDE</em> an object, but this only slowed things down. In a hindsight, this apparently only creates an extra &ldquo;lookup layer&rdquo;.</p>
</div>
<ol class="children">
<li id="comment-299880" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-03T20:51:02+00:00">April 3, 2018 at 8:51 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>Sorry, I forgot about this.</p>
</blockquote>
<p>Honestly, I looked it up while preparing this blog post. I could not believe that arrays did not hash properly (as values) in Java. Mind you, I still cannot believe that Java lacks value types.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-299648" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/19ead13ca86ff69e17b7187edc192480?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/19ead13ca86ff69e17b7187edc192480?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://jpbempel.blogspot.com" class="url" rel="ugc external nofollow">Jean-Philippe Bempel</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-30T15:27:22+00:00">March 30, 2018 at 3:27 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,</p>
<p>for me it&rsquo;s not the computation in itself, but accessing data for computing the hash. Zven in L1, accessing data will be slower than performing add and mul operations</p>
<p>Cheers!</p>
</div>
<ol class="children">
<li id="comment-299649" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-30T15:48:18+00:00">March 30, 2018 at 3:48 pm</time></a> </div>
<div class="comment-content">
<p><em>for me it&rsquo;s not the computation in itself, but accessing data for computing the hash. Zven in L1, accessing data will be slower than performing add and mul operations</em></p>
<p>This can be tested. Lay out the objects in L1 cache and check how many instructions you get per cycle while computing hash values. If you are correct, then you will get far fewer than one instruction per cycle (the CPU will spin empty).</p>
<p>I believe you are not correct but I&rsquo;d be interested in seeing the numbers.</p>
</div>
</li>
</ol>
</li>
<li id="comment-299692" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dbc60362bf2df08202ff198e00085a5c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dbc60362bf2df08202ff198e00085a5c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">alfC</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-31T04:02:15+00:00">March 31, 2018 at 4:02 am</time></a> </div>
<div class="comment-content">
<p>Mmm, there must be some big trade off somewhere. To begin, an increase of memory footprint and a decrease in the cache utilization. Mutability will have cost as well. Did you try it in the context of C++?</p>
</div>
</li>
</ol>
