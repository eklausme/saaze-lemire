---
date: "2006-01-03 12:00:00"
title: "Are debuggers obselete?"
index: false
---

[3 thoughts on &ldquo;Are debuggers obselete?&rdquo;](/lemire/blog/2006/01-03-are-debuggers-obselete)

<ol class="comment-list">
<li id="comment-3557" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-01-04T19:35:58+00:00">January 4, 2006 at 7:35 pm</time></a> </div>
<div class="comment-content">
<p>Yes, this is supposed to be an highly-commented-on controversial topic. I agree with your analysis regarding debuggers.</p>
<p>Regarding embedded applications versus web applications, do you really think there are more distinct embedded applications than web applications?</p>
</div>
</li>
<li id="comment-3556" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dada9de44173d6c1b13691554ef8e974?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dada9de44173d6c1b13691554ef8e974?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://expert-opinion.blogspot.com/" class="url" rel="ugc external nofollow">Michael Stiber</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-01-04T18:09:51+00:00">January 4, 2006 at 6:09 pm</time></a> </div>
<div class="comment-content">
<p>Is this supposed to be a highly-commented-on controversial topic, or one that helps people? :^)</p>
<p>I must admit, sheepishly, that I&rsquo;ve always been too lazy to learn to use a debugger and still rely on printf or the equivalent. Often, determine that the bug is more than 100,000 iterations into a 1,000,000 iteration loop; do any debuggers provide breakpoints that only trigger after being passed through n times? A binary search through the loop iterations is a fairly quick thing to do with a test and printf.</p>
<p>&ldquo;&#8230;most modern applications are web applications.&rdquo;</p>
<p>Now you&rsquo;re really just pandering for comments! Everyone knows most applications are embedded.</p>
</div>
</li>
<li id="comment-3559" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/16e6781358198f897718a6140467805c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/16e6781358198f897718a6140467805c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">uccai_siravas</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-01-05T13:23:04+00:00">January 5, 2006 at 1:23 pm</time></a> </div>
<div class="comment-content">
<p>I find the rbreak command of the gdb useful for understanding how modules are used in large programs. Suppose that all functions exported by module A starts with A_xxx, then setting rbreak ^A_.* and running the program gives us a clue how the module A is used.</p>
</div>
</li>
</ol>
