---
date: "2013-06-17 12:00:00"
title: "Hashing and the Birthday paradox: a cautionary tale"
index: false
---

[6 thoughts on &ldquo;Hashing and the Birthday paradox: a cautionary tale&rdquo;](/lemire/blog/2013/06-17-hashing-and-the-birthday-paradox-cautionary-tale)

<ol class="comment-list">
<li id="comment-87874" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Itman</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-06-18T10:55:48+00:00">June 18, 2013 at 10:55 am</time></a> </div>
<div class="comment-content">
<p>A single collision is not necessarily bad.</p>
</div>
</li>
<li id="comment-87885" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Itman</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-06-18T13:24:50+00:00">June 18, 2013 at 1:24 pm</time></a> </div>
<div class="comment-content">
<p>Of course, they are not. The question, is how far do they diverge from randomness?</p>
</div>
</li>
<li id="comment-87886" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Itman</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-06-18T13:28:30+00:00">June 18, 2013 at 1:28 pm</time></a> </div>
<div class="comment-content">
<p>BTW, there are methods to avoid collisions: perfect hashing &amp; cuckoo hashing. I have not tried the latter, but the former seems to be a 2-3x times slower than regular hashing on average despite having &ldquo;ideal&rdquo; properties.</p>
</div>
</li>
<li id="comment-87884" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-06-18T13:19:23+00:00">June 18, 2013 at 1:19 pm</time></a> </div>
<div class="comment-content">
<p>No. My only point is that treating hash values as if they are truly random can be misleading.</p>
</div>
</li>
<li id="comment-87889" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-06-18T14:08:32+00:00">June 18, 2013 at 2:08 pm</time></a> </div>
<div class="comment-content">
<p>@Itman</p>
<p>Cuckoo hashing assumes some degree of &ldquo;randomness&rdquo; (as measured by k-wise independence). So while it is interesting in how it deals with collisions, it does not do away with the question of how much randomness is involved.</p>
</div>
</li>
<li id="comment-87949" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/59333540b40733403e8aad101f8269b9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/59333540b40733403e8aad101f8269b9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Graham</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-06-19T03:58:18+00:00">June 19, 2013 at 3:58 am</time></a> </div>
<div class="comment-content">
<p>I like the fact that a man named Pigeon is investigating the Pigeonhole Principle.</p>
</div>
</li>
</ol>
