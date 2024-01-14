---
date: "2021-10-14 12:00:00"
title: "Calling a dynamically compiled function from Go"
index: false
---

[5 thoughts on &ldquo;Calling a dynamically compiled function from Go&rdquo;](/lemire/blog/2021/10-14-calling-a-dynamically-compiled-function-from-go)

<ol class="comment-list">
<li id="comment-602329" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f8a7ccb41af2422d10599464b96cf034?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f8a7ccb41af2422d10599464b96cf034?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://franklinchen.com" class="url" rel="ugc external nofollow">Franklin Chen</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-15T22:32:29+00:00">October 15, 2021 at 10:32 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve been waiting decades for <a href="https://en.wikipedia.org/wiki/Multi-stage_programming" rel="nofollow ugc">Multi-stage programming</a> to become mainstream. <a href="https://okmij.org/ftp/ML/MetaOCaml.html" rel="nofollow ugc">MetaOCaml</a> has been around for decades but is still a limited fork of OCaml. More recently, <a href="https://epfldata.github.io/squid/home.html" rel="nofollow ugc">Squid for Scala</a> is still experimental. Etc.</p>
</div>
<ol class="children">
<li id="comment-602555" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f8a7ccb41af2422d10599464b96cf034?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f8a7ccb41af2422d10599464b96cf034?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://franklinchen.com" class="url" rel="ugc external nofollow">Franklin Chen</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-17T15:43:57+00:00">October 17, 2021 at 3:43 pm</time></a> </div>
<div class="comment-content">
<p>By coincidence, I just found out that the <a href="https://twitter.com/GPCECONF/status/1449712775744442370" rel="nofollow ugc">Best Research Paper Award at GPCE 2021 (International Conference on Generative Programming: Concepts &amp; Experiences)</a> went to the Scala-based work &ldquo;Multi-Stage Programming with Generative and Analytical Macros&rdquo; being presented tomorrow.</p>
</div>
</li>
</ol>
</li>
<li id="comment-602376" class="comment byuser comment-author-andrew even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2d3e32506243224474e7292fab5fddba?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2d3e32506243224474e7292fab5fddba?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Andrew Dalke</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-16T07:12:07+00:00">October 16, 2021 at 7:12 am</time></a> </div>
<div class="comment-content">
<p>It can also be used to prototype if the increase in performance justifies including some sort of JIT package. Incorporating LLVM in the package should be more robust than depending on the run-time environment, and be able to free memory, but isn&rsquo;t as quick to get set up as your example here.</p>
<p>I used something like this (although in Python) at <a href="http://www.dalkescientific.com/writings/diary/archive/2005/03/02/faster_fingerprint_substructure_tests.html" rel="nofollow ugc">http://www.dalkescientific.com/writings/diary/archive/2005/03/02/faster_fingerprint_substructure_tests.html</a> .</p>
</div>
</li>
<li id="comment-603047" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cae964766f3e2cd08f9b9fc82fcc65aa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cae964766f3e2cd08f9b9fc82fcc65aa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Benno Meier</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-22T20:10:38+00:00">October 22, 2021 at 8:10 pm</time></a> </div>
<div class="comment-content">
<p>Thank you for the interesting article. Shouldn&rsquo;t there be a Makefile in the github repo folder?</p>
</div>
<ol class="children">
<li id="comment-603051" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-22T20:42:12+00:00">October 22, 2021 at 8:42 pm</time></a> </div>
<div class="comment-content">
<p>It was missing. I fixed this omission.</p>
</div>
</li>
</ol>
</li>
</ol>
