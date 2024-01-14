---
date: "2016-09-29 12:00:00"
title: "Can Swift code call C code without overhead?"
index: false
---

[6 thoughts on &ldquo;Can Swift code call C code without overhead?&rdquo;](/lemire/blog/2016/09-29-can-swift-code-call-c-code-without-overhead)

<ol class="comment-list">
<li id="comment-253945" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1e5aa68931fd6f60e25314cc2f18d12b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1e5aa68931fd6f60e25314cc2f18d12b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">qznc</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-29T17:33:43+00:00">September 29, 2016 at 5:33 pm</time></a> </div>
<div class="comment-content">
<p>I would assume swift test is for unit tests, not benchmarks. Why would you think benchmarks are part of the tests?</p>
</div>
<ol class="children">
<li id="comment-253946" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-29T17:45:14+00:00">September 29, 2016 at 5:45 pm</time></a> </div>
<div class="comment-content">
<p>I would also prefer to have benchmarks separated from unit tests&#8230;<br/>
I think Swift thinks of these as &ldquo;performance tests&rdquo;.</p>
<p>But this aside, I&rsquo;d like to run my unit tests with both release and debug binaries.</p>
</div>
</li>
</ol>
</li>
<li id="comment-254015" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4be6359d5120079e76651e836a213e6d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4be6359d5120079e76651e836a213e6d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Pablo Guerrero</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-30T06:43:21+00:00">September 30, 2016 at 6:43 am</time></a> </div>
<div class="comment-content">
<p>Have you tried to write high-performance code with Rust? I think it could be faster than swift, and it should also have zero overhead calling C code if needed.</p>
</div>
</li>
<li id="comment-254039" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">jld</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-30T10:45:35+00:00">September 30, 2016 at 10:45 am</time></a> </div>
<div class="comment-content">
<p>Since you can also have garbage collection for C and C++ there is little reason to bother with &ldquo;shiny&rdquo; new languages which bring brand new bugs and poor libraries.<br/>
<a href="http://www.hboehm.info/gc/" rel="nofollow ugc">http://www.hboehm.info/gc/</a></p>
</div>
<ol class="children">
<li id="comment-254060" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-30T13:55:47+00:00">September 30, 2016 at 1:55 pm</time></a> </div>
<div class="comment-content">
<p>I like C and C++, a lot. </p>
<p>But first, they are moving targets, see <a href="https://lemire.me/blog/2016/09/14/the-new-c-standards-are-worth-it/" rel="ugc">http://lemire.me/blog/2016/09/14/the-new-c-standards-are-worth-it/</a> Standing still is just not an option in computing. </p>
<p>Second, these new shiny languages come with nice features like standard and universal tools to test, build and manage dependencies. Also they tend to do away with undefined behaviours. Garbage collection is just one of many small features.</p>
<p>Third, there are entire platforms where some language dominates. You can&rsquo;t do web without JavaScript. You can&rsquo;t keep doing iOS without Swift. You can&rsquo;t do Android without Java. You probably shouldn&rsquo;t do video games without C++.</p>
</div>
</li>
</ol>
</li>
<li id="comment-369068" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2c4b4dadbc91bfa870768c2d3b3cbbae?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2c4b4dadbc91bfa870768c2d3b3cbbae?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.fb.com" class="url" rel="ugc external nofollow">nick patel</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-29T05:09:25+00:00">November 29, 2018 at 5:09 am</time></a> </div>
<div class="comment-content">
<p>nice post</p>
</div>
</li>
</ol>
