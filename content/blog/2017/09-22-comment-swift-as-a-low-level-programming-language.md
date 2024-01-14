---
date: "2017-09-22 12:00:00"
title: "Swift as a low-level programming language?"
index: false
---

[6 thoughts on &ldquo;Swift as a low-level programming language?&rdquo;](/lemire/blog/2017/09-22-swift-as-a-low-level-programming-language)

<ol class="comment-list">
<li id="comment-286587" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f8a7ccb41af2422d10599464b96cf034?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f8a7ccb41af2422d10599464b96cf034?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://franklinchen.com/" class="url" rel="ugc external nofollow">Franklin Chen</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-22T02:35:14+00:00">September 22, 2017 at 2:35 am</time></a> </div>
<div class="comment-content">
<p>The question of whether low-level primitives are available to a programmer is not really a programming language issue, but a standard library issue. For example, Haskell allows extremely low-level programming if you really want to do it there and use the GHC compiler, e.g. <a href="https://hackage.haskell.org/package/ghc-prim-0.5.1.0/docs/GHC-Prim.html" rel="nofollow ugc">https://hackage.haskell.org/package/ghc-prim-0.5.1.0/docs/GHC-Prim.html</a> has all this popCnt stuff for its unboxed machine-level types.</p>
</div>
</li>
<li id="comment-286590" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-22T02:43:27+00:00">September 22, 2017 at 2:43 am</time></a> </div>
<div class="comment-content">
<p>I consider the standard library of a programming language as a defining characteristic of the language.</p>
<p>It is entirely possible that Haskell is practical for low-level programming. Of course, you should check the resulting assembly. Have you done so?</p>
</div>
</li>
<li id="comment-286638" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Oren Tirosh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-22T16:11:03+00:00">September 22, 2017 at 4:11 pm</time></a> </div>
<div class="comment-content">
<p>&gt; If you are not targeting iOS, it is crazy to use Swift for high-performance low-level programming.</p>
<p>Agreed. Using it *specifically* for high performance low level stuff is probably a bit crazy. </p>
<p>But using Swift for system programming on a non-Apple platform is getting less and less crazy with every day (for certain values of &ldquo;system programming&rdquo;). Especially now that v4 was released. </p>
<p>For many years, I have been looking for an expressive, safe and concise high-level language that produces native code in standard relocatable object files and interoperates with C. Not some specialized module or class files. No interpreter or runtime required to launch it.</p>
<p>Definitely not an Apple fanboy here. I was actually annoyed to discover that a language fitting this description was coming from Apple. </p>
<p>Swift is still far from being a conservative choice in non-Apple shops. But we may be at the point where early adopters of Swift in such environments will benefit from it more than the inevitable pain that will occasionally be caused by such a choice.</p>
</div>
<ol class="children">
<li id="comment-286641" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-22T16:35:43+00:00">September 22, 2017 at 4:35 pm</time></a> </div>
<div class="comment-content">
<p>I agree with everything you wrote.</p>
</div>
</li>
</ol>
</li>
<li id="comment-286907" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/11246ef0203dec00e61a34f4d35987e7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/11246ef0203dec00e61a34f4d35987e7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Paul Jurczak</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-25T10:14:39+00:00">September 25, 2017 at 10:14 am</time></a> </div>
<div class="comment-content">
<p>Have a look at Julia (<a href="https://julialang.org/" rel="nofollow ugc">https://julialang.org/</a>). It is still a bit of a work in progress, but you may like it.</p>
</div>
</li>
<li id="comment-402152" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1733b937ee56f028bc14fdb4ce591c1b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1733b937ee56f028bc14fdb4ce591c1b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Gou Long</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-17T19:35:54+00:00">April 17, 2019 at 7:35 pm</time></a> </div>
<div class="comment-content">
<p>C++ is really nice if you use stuff like boost. I don&rsquo;t really like Swift outside of Apple&rsquo;s frameworks. It&rsquo;s kind of icky for the high level stuff like Python, and it&rsquo;s not as general as C++.</p>
</div>
</li>
</ol>
