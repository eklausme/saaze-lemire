---
date: "2005-05-23 12:00:00"
title: "Using XPath in Java without loading the external DTD"
index: false
---

[2 thoughts on &ldquo;Using XPath in Java without loading the external DTD&rdquo;](/lemire/blog/2005/05-23-using-xpath-in-java-without-loading-the-external-dtd)

<ol class="comment-list">
<li id="comment-2362" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-06-14T12:03:05+00:00">June 14, 2005 at 12:03 pm</time></a> </div>
<div class="comment-content">
<p>Whether or not you validate is not the same as loading the external DTD or not. Doing as you suggest will still result in Java trying to load the external DTD.</p>
</div>
</li>
<li id="comment-2360" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" decoding="async" /> <b class="fn">Anonymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-06-14T09:08:16+00:00">June 14, 2005 at 9:08 am</time></a> </div>
<div class="comment-content">
<p>Read the API: you just need an</p>
<p>dbfact.setValidating(false);</p>
</div>
</li>
</ol>
