---
date: "2017-08-11 12:00:00"
title: "Optimizing polynomial hash functions (Java vs. Swift)"
index: false
---

[4 thoughts on &ldquo;Optimizing polynomial hash functions (Java vs. Swift)&rdquo;](/lemire/blog/2017/08-11-optimizing-polynomial-hash-functions-java-vs-swift)

<ol class="comment-list">
<li id="comment-284390" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://zeuxcg.org" class="url" rel="ugc external nofollow">Arseny Kapoulkine</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-19T07:56:45+00:00">August 19, 2017 at 7:56 am</time></a> </div>
<div class="comment-content">
<p>&gt; Swift crashes on signed overflows</p>
<p>This is accurate but slightly misleading &#8211; Swift traps on all integer overflows/underflows regardless of the signedness of the type.</p>
</div>
</li>
<li id="comment-285346" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a89eee08fd4486aa5392fbe1a7d63db7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a89eee08fd4486aa5392fbe1a7d63db7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.efiles.us" class="url" rel="ugc external nofollow">Hands Off crack for MacOS OSX v3.1.3 â€” 01-2017</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-04T17:08:15+00:00">September 4, 2017 at 5:08 pm</time></a> </div>
<div class="comment-content">
<p>This helps. Thanks!</p>
</div>
</li>
<li id="comment-290919" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b165010996033bc6602ed18ab6a883b0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b165010996033bc6602ed18ab6a883b0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://richardstartin.uk" class="url" rel="ugc external nofollow">Richard Startin</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-05T22:01:24+00:00">November 5, 2017 at 10:01 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel &#8211; I moved my site and it wasn&rsquo;t possible to set up hard redirects. For reference: the post you linked to about the Java benchmarks is now at <a href="http://richardstartin.uk/still-true-in-java-9-handwritten-hash-codes-are-faster/" rel="nofollow ugc">http://richardstartin.uk/still-true-in-java-9-handwritten-hash-codes-are-faster/</a></p>
</div>
<ol class="children">
<li id="comment-291032" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-07T15:23:48+00:00">November 7, 2017 at 3:23 pm</time></a> </div>
<div class="comment-content">
<p>I updated the link.</p>
</div>
</li>
</ol>
</li>
</ol>
