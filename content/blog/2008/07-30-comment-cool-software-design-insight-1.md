---
date: "2008-07-30 12:00:00"
title: "Cool software design insight #1"
index: false
---

[2 thoughts on &ldquo;Cool software design insight #1&rdquo;](/lemire/blog/2008/07-30-cool-software-design-insight-1)

<ol class="comment-list">
<li id="comment-50061" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/880cbab435f00197613c9cc2065b4f5a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/880cbab435f00197613c9cc2065b4f5a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Daniel Haran</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-07-30T22:30:32+00:00">July 30, 2008 at 10:30 pm</time></a> </div>
<div class="comment-content">
<p>aka YAGNI: <a href="https://en.wikipedia.org/wiki/YAGNI" rel="nofollow ugc">http://en.wikipedia.org/wiki/YAGNI</a></p>
</div>
</li>
<li id="comment-50059" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dc20f7fc7b7dab70033b2a9d86c70144?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dc20f7fc7b7dab70033b2a9d86c70144?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://mark.reid.name" class="url" rel="ugc external nofollow">Mark Reid</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-07-30T18:06:48+00:00">July 30, 2008 at 6:06 pm</time></a> </div>
<div class="comment-content">
<p>I also came to the same conclusion after working as a commercial programmer for a few years. When it comes to code &ldquo;less is more&rdquo;.</p>
<p>While it&rsquo;s not a solution for everything, one thing test driven design does well is make you focus on the features that are essential. The best way to avoid useless features is not write them in the first place!</p>
<p>Instead, you write simple tests that exercises only the functionality you want and the game is then to implement enough code to get the tests passing and then stop. If you need more features, write new tests and repeat. </p>
<p>Not only do you avoid unnecessary, over-general code but writing the tests means when you do need to refactor to add new features you can easily check whether the old functionality is still working.</p>
</div>
</li>
</ol>
