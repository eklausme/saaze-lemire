---
date: "2023-04-14 12:00:00"
title: "Interfaces are not free in Go"
index: false
---

[One thought on &ldquo;Interfaces are not free in Go&rdquo;](/lemire/blog/2023/04-14-interfaces-are-not-free-in-go)

<ol class="comment-list">
<li id="comment-650835" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bc8e800f96fe2525875a6b13d567b404?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bc8e800f96fe2525875a6b13d567b404?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Serge Gotsuliak</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-15T08:40:23+00:00">April 15, 2023 at 8:40 am</time></a> </div>
<div class="comment-content">
<p>Interface is just a struct with one field representing the type and second representing value. So to access the real value in run-time there are at least another extra level of indirection. That doesn&rsquo;t play well with modern CPUs where the memory access is the real bottleneck.</p>
</div>
</li>
</ol>
