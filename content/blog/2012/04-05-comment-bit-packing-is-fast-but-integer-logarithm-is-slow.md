---
date: "2012-04-05 12:00:00"
title: "Bit packing is fast, but integer logarithm is slow"
index: false
---

[4 thoughts on &ldquo;Bit packing is fast, but integer logarithm is slow&rdquo;](/lemire/blog/2012/04-05-bit-packing-is-fast-but-integer-logarithm-is-slow)

<ol class="comment-list">
<li id="comment-55156" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-04-05T17:17:35+00:00">April 5, 2012 at 5:17 pm</time></a> </div>
<div class="comment-content">
<p>First, OR together all the integers (very fast), then right shift the result until you get all zeros (count the shifts).</p>
<p>Or am I missing something?</p>
</div>
</li>
<li id="comment-55157" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" decoding="async" /> <b class="fn">Luke</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-04-05T18:58:50+00:00">April 5, 2012 at 6:58 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for the blog and the code! I like your blog.<br/>
You should get a github/bitbucket account so we can browse your past code easier.<br/>
Thanks!</p>
</div>
</li>
<li id="comment-55158" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-04-05T19:10:18+00:00">April 5, 2012 at 7:10 pm</time></a> </div>
<div class="comment-content">
<p>@Luke</p>
<p>Thanks you are right.</p>
<p>Yes, I should create a repository on github for this code, you are right.</p>
</div>
</li>
<li id="comment-55159" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-04-05T20:15:41+00:00">April 5, 2012 at 8:15 pm</time></a> </div>
<div class="comment-content">
<p>@Preston </p>
<p>As usual, you make me look like an idiot. 😉</p>
<p>I&rsquo;m updating my blog post.</p>
</div>
</li>
</ol>
