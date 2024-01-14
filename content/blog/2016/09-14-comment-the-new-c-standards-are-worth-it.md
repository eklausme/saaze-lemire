---
date: "2016-09-14 12:00:00"
title: "The new C standards are worth it"
index: false
---

[7 thoughts on &ldquo;The new C standards are worth it&rdquo;](/lemire/blog/2016/09-14-the-new-c-standards-are-worth-it)

<ol class="comment-list">
<li id="comment-252427" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://blog.lbs.ca/technology" class="url" rel="ugc external nofollow">Dominic Amann</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-15T01:09:56+00:00">September 15, 2016 at 1:09 am</time></a> </div>
<div class="comment-content">
<p>Good advances every one. I don&rsquo;t suspect they will be coming to the Linux Kernel any time soon &#8211; which is one of the only places where I use plain C.</p>
</div>
<ol class="children">
<li id="comment-252432" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-15T03:36:22+00:00">September 15, 2016 at 3:36 am</time></a> </div>
<div class="comment-content">
<p>Sadly no. It is a shame.</p>
</div>
</li>
<li id="comment-252453" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/72af716fb5a42b473c0d9df9b16815d2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/72af716fb5a42b473c0d9df9b16815d2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alex</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-15T10:52:00+00:00">September 15, 2016 at 10:52 am</time></a> </div>
<div class="comment-content">
<p>Try NetBSD 🙂</p>
</div>
</li>
</ol>
</li>
<li id="comment-252451" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6ad12be45ac6ad2cb9d1c717d1f81abf?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6ad12be45ac6ad2cb9d1c717d1f81abf?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Imran</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-15T10:40:13+00:00">September 15, 2016 at 10:40 am</time></a> </div>
<div class="comment-content">
<p>Would this work for people working on micro-controllers?</p>
</div>
<ol class="children">
<li id="comment-252459" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-15T13:30:25+00:00">September 15, 2016 at 1:30 pm</time></a> </div>
<div class="comment-content">
<p>Compilers for micro-controllers might not support even the C89 standard. However, a $5 Raspberry Pi would support C99.</p>
</div>
</li>
</ol>
</li>
<li id="comment-252489" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/38907a1ff475a70dc71663370685a1a1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/38907a1ff475a70dc71663370685a1a1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://fyngyrz.com" class="url" rel="ugc external nofollow">Ben</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-15T18:47:31+00:00">September 15, 2016 at 6:47 pm</time></a> </div>
<div class="comment-content">
<p>Mixing variables with code has always been a terrible idea / practice. Put them up front, together, so they can be found easily, so the compiler can allocate and release them in one stack frame, so you have an easier time seeing WTF you&rsquo;re doing in terms of memory load, so your IDE can tell you, all in one place, what you need to clean up. Never declare a function&rsquo;s variables away from the head of the function. You&rsquo;re just making things harder on everyone, including yourself, and you might be causing lousy code generation as well. The lazy-making &ldquo;benefit&rdquo; of scattering variables all over a function is wholly illusory. 40 years of coding experience speaking here.</p>
</div>
<ol class="children">
<li id="comment-252491" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-15T19:10:15+00:00">September 15, 2016 at 7:10 pm</time></a> </div>
<div class="comment-content">
<p><em>so the compiler can allocate and release them in one stack frame (&#8230;) and you might be causing lousy code generation as well</em></p>
<p>Any performance benefit you might perceive after declaring variables up front is, to use your own term, &ldquo;wholly illusory&rdquo;.</p>
<p>We can certainly debate maintainability and readability, but not performance.</p>
</div>
</li>
</ol>
</li>
</ol>
