---
date: "2016-12-21 12:00:00"
title: "Performance overhead when calling assembly from Go"
index: false
---

[4 thoughts on &ldquo;Performance overhead when calling assembly from Go&rdquo;](/lemire/blog/2016/12-21-performance-overhead-when-calling-assembly-from-go)

<ol class="comment-list">
<li id="comment-264578" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e5ffde6fe345b8db1a14c4393e41aac8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e5ffde6fe345b8db1a14c4393e41aac8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">me</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-03T22:20:57+00:00">January 3, 2017 at 10:20 pm</time></a> </div>
<div class="comment-content">
<p>What &ldquo;more modern&rdquo; languages have you evaluated with respect to their overhead of calling C or assembly?<br/>
So Go comes at some overhead, what about Rust, Julia, Swift? These should come at zero overhead, as they use LLVM?<br/>
Vala? As it apparently is compiled &lsquo;into&rsquo; C code, there shouldn&rsquo;t be much overhead.<br/>
Dart? Apparently you can use SIMD in Dart somehow. Probably not when compiling into JavaScript though.<br/>
I have always been wondering what language to use for my next project; as I have always been hitting the limits of Java. Go and Rust have been two candidates to learn.</p>
</div>
<ol class="children">
<li id="comment-264591" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-04T02:21:15+00:00">January 4, 2017 at 2:21 am</time></a> </div>
<div class="comment-content">
<p><em> So Go comes at some overhead, what about Rust, Julia, Swift? These should come at zero overhead, as they use LLVM?</em></p>
<p>Swift can call C without overhead&#8230;</p>
<p><a href="https://lemire.me/blog/2016/09/29/can-swift-code-call-c-code-without-overhead/" rel="ugc">http://lemire.me/blog/2016/09/29/can-swift-code-call-c-code-without-overhead/</a></p>
<p>I don&rsquo;t know about Julia and Rust.</p>
<p><em>Go and Rust have been two candidates to learn.</em></p>
<p>Go can be learned quickly. So there is that.</p>
<p>Swift is more challenging but a lot of fun, and certainly more interesting than Java.</p>
<p>I don&rsquo;t know a lot about Rust. Looked ok at a glance.</p>
</div>
</li>
</ol>
</li>
<li id="comment-265200" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/621dd8a9696960eac2ecb815539f4f72?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/621dd8a9696960eac2ecb815539f4f72?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://fuz.su" class="url" rel="ugc external nofollow">fuz</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-09T22:49:16+00:00">January 9, 2017 at 10:49 pm</time></a> </div>
<div class="comment-content">
<p>Note that while tzcnt is â€œnew,â€ it is merely a variant of the good old bsf instruction with some extra behaviour. bsf was introduced with the 80386.</p>
</div>
<ol class="children">
<li id="comment-265262" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-10T14:12:42+00:00">January 10, 2017 at 2:12 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s true. The behavior is different if the input word is zero&#8230;</p>
</div>
</li>
</ol>
</li>
</ol>
