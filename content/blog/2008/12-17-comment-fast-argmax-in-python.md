---
date: "2008-12-17 12:00:00"
title: "Fast argmax in Python"
index: false
---

[5 thoughts on &ldquo;Fast argmax in Python&rdquo;](/lemire/blog/2008/12-17-fast-argmax-in-python)

<ol class="comment-list">
<li id="comment-54217" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/da44bfe3910eb4d9dd46b6d3a9664bd6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/da44bfe3910eb4d9dd46b6d3a9664bd6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">bartkiller</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-02-13T14:55:13+00:00">February 13, 2011 at 2:55 pm</time></a> </div>
<div class="comment-content">
<p>Complexity of these operations with regard to array length would be more interesting. I think that your conclusion is a bit too wide.</p>
</div>
<ol class="children">
<li id="comment-399182" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-03T19:35:32+00:00">April 3, 2019 at 7:35 pm</time></a> </div>
<div class="comment-content">
<p>They all have linear complexity.</p>
</div>
</li>
</ol>
</li>
<li id="comment-55192" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/38fc5042b5264f043abcba918525772f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/38fc5042b5264f043abcba918525772f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">bbq</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-04-19T09:09:16+00:00">April 19, 2012 at 9:09 am</time></a> </div>
<div class="comment-content">
<p>Interesting!<br/>
The first solution is amazing!</p>
</div>
</li>
<li id="comment-261234" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/372dc805273f66104f9ee8ff4edd246a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/372dc805273f66104f9ee8ff4edd246a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">staniec</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-11-28T16:17:34+00:00">November 28, 2016 at 4:17 pm</time></a> </div>
<div class="comment-content">
<p>What about:</p>
<p>max(range(len(array)), key=lambda x: array[x])</p>
</div>
<ol class="children">
<li id="comment-399136" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3670dccbbf1158a8e6f95b0b87f2d05d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3670dccbbf1158a8e6f95b0b87f2d05d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">GS</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-03T13:46:25+00:00">April 3, 2019 at 1:46 pm</time></a> </div>
<div class="comment-content">
<p>Slower than <code>a.index(max(a))</code>. (Tested by ipython <code>%timeit</code>)</p>
</div>
</li>
</ol>
</li>
</ol>
