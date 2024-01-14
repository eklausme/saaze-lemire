---
date: "2022-06-28 12:00:00"
title: "Looking at assembly code with gdb"
index: false
---

[5 thoughts on &ldquo;Looking at assembly code with gdb&rdquo;](/lemire/blog/2022/06-28-looking-at-assembly-code-with-gdb)

<ol class="comment-list">
<li id="comment-637678" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">George Spelvin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-06-29T16:31:57+00:00">June 29, 2022 at 4:31 pm</time></a> </div>
<div class="comment-content">
<p>I generally use <code>objdump -dr</code> to look at generated code. </p>
<p>While <code>gdb</code> can do it, <code>objdump</code> is the tool designed for the job.</p>
<p>(There are arguments to select the range <code>objdump</code> disassembles, but I find it easier to just pipe the output through <code>less</code> and search.)</p>
</div>
<ol class="children">
<li id="comment-637688" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-06-29T20:16:32+00:00">June 29, 2022 at 8:16 pm</time></a> </div>
<div class="comment-content">
<p>I prefer <tt>gdb</tt> but it is true that <tt>objdump</tt> works well too.</p>
</div>
</li>
</ol>
</li>
<li id="comment-638055" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Oren T</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-02T18:59:50+00:00">July 2, 2022 at 6:59 pm</time></a> </div>
<div class="comment-content">
<p>Godbolt?</p>
</div>
<ol class="children">
<li id="comment-638067" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-02T22:50:09+00:00">July 2, 2022 at 10:50 pm</time></a> </div>
<div class="comment-content">
<p>Godbolt is great but it is not always possible to use it conveniently.</p>
</div>
</li>
</ol>
</li>
<li id="comment-638939" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b7f113781e8d489eca577ee2b35a4fe9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b7f113781e8d489eca577ee2b35a4fe9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://jaskaran.org" class="url" rel="ugc external nofollow">Jaskaran Singh</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-08T20:16:55+00:00">July 8, 2022 at 8:16 pm</time></a> </div>
<div class="comment-content">
<p>Have you tried radare? Would be interesting to know your review of it.</p>
</div>
</li>
</ol>
