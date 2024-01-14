---
date: "2017-09-26 12:00:00"
title: "Runtime constants: Swift"
index: false
---

[4 thoughts on &ldquo;Runtime constants: Swift&rdquo;](/lemire/blog/2017/09-26-runtime-constants-swift)

<ol class="comment-list">
<li id="comment-287246" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Oren Tirosh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-27T05:26:24+00:00">September 27, 2017 at 5:26 am</time></a> </div>
<div class="comment-content">
<p>It is a design choice to make range checks a fatal error rather than a catchable exception. Those are meant for handling expected runtime failure conditions, not something that is quite clearly a programmer error.</p>
<p>It is not a choice everyone will agree with. I am not sure I agree with it. But it is by design, not an oversight. Making something a catchable exception will affect the function signature (add &ldquo;raises&rdquo;) and any code that uses it.</p>
</div>
<ol class="children">
<li id="comment-287304" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-27T19:38:28+00:00">September 27, 2017 at 7:38 pm</time></a> </div>
<div class="comment-content">
<p>I understand the spirit. So if you have an application that manipulates your data, and it gets into a state that was not expected, what do you do?</p>
<p>There is a wrong answer. In C and C++, you just do random shit. The program you are running could start deleting all your files. Who knows? I don&rsquo;t think we want this anymore.</p>
<p>Swift seems to be going with&#8230; let us crash hard.</p>
<p>Is that good?</p>
</div>
<ol class="children">
<li id="comment-287607" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Oren Tirosh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-30T10:14:09+00:00">September 30, 2017 at 10:14 am</time></a> </div>
<div class="comment-content">
<p>Another way of saying the same thing is to note that Swift automatically puts ASSERT() on all array indexing operations. </p>
<p>Now the arguments around assert, what is or isn&rsquo;t worth asserting, assertions on debug vs release builds etc are all old and well-hashed. And definitely not settled conclusively one way or the other.</p>
<p>Perhaps the most controversial thing Swift has done here is calling it a &ldquo;crash&rdquo; rather than &ldquo;assertion failed &#8211; range check error&rdquo;.</p>
</div>
<ol class="children">
<li id="comment-287617" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-30T12:54:22+00:00">September 30, 2017 at 12:54 pm</time></a> </div>
<div class="comment-content">
<p>I called it a crash because in release mode, you get no message, just a program termination.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
