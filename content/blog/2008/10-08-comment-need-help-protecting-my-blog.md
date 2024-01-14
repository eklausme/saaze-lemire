---
date: "2008-10-08 12:00:00"
title: "Need help protecting my blog"
index: false
---

[4 thoughts on &ldquo;Need help protecting my blog&rdquo;](/lemire/blog/2008/10-08-need-help-protecting-my-blog)

<ol class="comment-list">
<li id="comment-50187" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b1483f6f60a3f9948b9944ed337aa8f9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b1483f6f60a3f9948b9944ed337aa8f9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">luis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-10-08T22:21:46+00:00">October 8, 2008 at 10:21 pm</time></a> </div>
<div class="comment-content">
<p>It seems you are having SQL injection problems. If you have logs check when they were &ldquo;updated&rdquo; and the PHP requests before.</p>
<p>Good luck!</p>
</div>
</li>
<li id="comment-50189" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/880cbab435f00197613c9cc2065b4f5a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/880cbab435f00197613c9cc2065b4f5a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Daniel Haran</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-10-09T09:36:22+00:00">October 9, 2008 at 9:36 am</time></a> </div>
<div class="comment-content">
<p>Luis had the same idea I had: SQL injection. Grepping logs should help narrow down what happened; if you are on the latest WP, this is something a lot of people will want to know / fix.</p>
<p>Also, is your personal machine safe?</p>
</div>
</li>
<li id="comment-50188" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0c4376092afee27f7825ed676aeafbb1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0c4376092afee27f7825ed676aeafbb1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">David</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-10-09T08:07:43+00:00">October 9, 2008 at 8:07 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m no WordPress expert and only have a very the general comment but you may want to install Nessus and inspect your server from the outside.</p>
</div>
</li>
<li id="comment-50191" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anonymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-10-12T13:05:18+00:00">October 12, 2008 at 1:05 pm</time></a> </div>
<div class="comment-content">
<p>If it can help against spam. There&rsquo;s surely something equivalent in php.</p>
<p><a href="http://blog.madskristensen.dk/post/Simple-method-to-avoid-comment-spam.aspx" rel="nofollow ugc">http://blog.madskristensen.dk/post/Simple-method-to-avoid-comment-spam.aspx</a></p>
</div>
</li>
</ol>
