---
date: "2009-02-03 12:00:00"
title: "Compressed bitmaps in Java"
index: false
---

[7 thoughts on &ldquo;Compressed bitmaps in Java&rdquo;](/lemire/blog/2009/02-03-just-published-java-compressed-bitmap-class)

<ol class="comment-list">
<li id="comment-50601" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-02-03T13:30:33+00:00">February 3, 2009 at 1:30 pm</time></a> </div>
<div class="comment-content">
<p>@Anonymous</p>
<p>My statement is very clear: to my knowledge, there is no patent violation. However, I am a researcher, not a patent lawyer.</p>
</div>
</li>
<li id="comment-50600" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c7414419c28fde3050bf5355fcdc734a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c7414419c28fde3050bf5355fcdc734a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Anonymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-02-03T12:55:49+00:00">February 3, 2009 at 12:55 pm</time></a> </div>
<div class="comment-content">
<p>I have just downloaded the software. I have just one preliminary question: how are you sure that EWAH is not patented. In other words why do you think that a patent on WAH does not cover EWAH as well.</p>
</div>
</li>
<li id="comment-50620" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0679d66c5ec76c5aba5412c08d0d4d4e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0679d66c5ec76c5aba5412c08d0d4d4e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jaroslaw</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-02-09T05:07:41+00:00">February 9, 2009 at 5:07 am</time></a> </div>
<div class="comment-content">
<p>Hi,</p>
<p>Great paper, great wok, nothing to add&#8230; I&rsquo;m currently in Dublin, Ireland, it is amazing that I can download your paper and enjoy your work. Thanks a lot!</p>
</div>
</li>
<li id="comment-54167" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-01-27T19:42:39+00:00">January 27, 2011 at 7:42 pm</time></a> </div>
<div class="comment-content">
<p>No. It is a matter of trade-off: if you want fast random access, a different (less aggressive) form of compression is required. Thanks for the question.</p>
</div>
</li>
<li id="comment-54166" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0ba5b8fe10d0c347e2f9b66ddbe2869d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0ba5b8fe10d0c347e2f9b66ddbe2869d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Igor</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-01-27T15:42:54+00:00">January 27, 2011 at 3:42 pm</time></a> </div>
<div class="comment-content">
<p>Daniel,</p>
<p>Is there a way to check whether a bit at the given position is set? In the constant time of course, not using the iterator. Thanks in advance.</p>
</div>
</li>
<li id="comment-287508" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c0aa4400eb4bc93197f9f6c5f2f5f647?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c0aa4400eb4bc93197f9f6c5f2f5f647?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sam</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-29T12:38:27+00:00">September 29, 2017 at 12:38 pm</time></a> </div>
<div class="comment-content">
<p>What are your thoughts on a Javascript implementation of EWAH?<br/>
I&rsquo;m curious if the benefits of cache coherency would outweigh the lack of 64-bit integer support and other JS inefficiencies.</p>
</div>
<ol class="children">
<li id="comment-287510" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-29T12:43:46+00:00">September 29, 2017 at 12:43 pm</time></a> </div>
<div class="comment-content">
<p>I have a fast implementation of regular/uncompressed bitsets in JavaScript and it is mostly decent. I suspect you could make a 32-bit EWAH work.</p>
</div>
</li>
</ol>
</li>
</ol>
