---
date: "2017-09-26 12:00:00"
title: "Runtime constants: Go vs. C++"
index: false
---

[13 thoughts on &ldquo;Runtime constants: Go vs. C++&rdquo;](/lemire/blog/2017/09-26-runtime-constants-go-vs-c)

<ol class="comment-list">
<li id="comment-287185" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8b70790f2d886a2568bf35f10a3af9b1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8b70790f2d886a2568bf35f10a3af9b1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Will Fitzgerald</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-26T16:26:33+00:00">September 26, 2017 at 4:26 pm</time></a> </div>
<div class="comment-content">
<p>The thing is, that&rsquo;s really unsafe code.</p>
</div>
<ol class="children">
<li id="comment-287187" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-26T16:36:53+00:00">September 26, 2017 at 4:36 pm</time></a> </div>
<div class="comment-content">
<p>I take your point, and maybe comparing against C++ is not &ldquo;fair&rdquo;. But, as a programmer, you must be aware of the trade-offs you are making.</p>
<p>As I stress in the post, I do like Go.</p>
</div>
</li>
<li id="comment-287196" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24cfa9591263008553ae4c125b6a9934?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24cfa9591263008553ae4c125b6a9934?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">wmu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-26T17:44:25+00:00">September 26, 2017 at 5:44 pm</time></a> </div>
<div class="comment-content">
<p>When we change Daniel&rsquo;s procedure and pass the length as a parameter, a decent GCC is still able to inline call with the compile-time constant (and unroll the loop accordingly, even using SIMD instructions).</p>
<p>Take a look: <a href="https://godbolt.org/g/ZzBvJu" rel="nofollow ugc">https://godbolt.org/g/ZzBvJu</a></p>
</div>
<ol class="children">
<li id="comment-287197" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-26T17:49:27+00:00">September 26, 2017 at 5:49 pm</time></a> </div>
<div class="comment-content">
<p>I have not checked, but I suspect that Go won&rsquo;t inline, let alone use SIMD instructions in this scenario.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-287191" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3056f1011deed57876c4a08713f0e1e7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3056f1011deed57876c4a08713f0e1e7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.pelock.com" class="url" rel="ugc external nofollow">Bartosz WÃ³jcik</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-26T17:16:34+00:00">September 26, 2017 at 5:16 pm</time></a> </div>
<div class="comment-content">
<p>I need to look at the generated code by the Go compiler from 2017, back in 2014 I take a look at the generated code and it was terrible!</p>
<p><a href="http://www.secnews.pl/2014/09/05/technologiczna-bieda-kompilatora-go/" rel="nofollow ugc">http://www.secnews.pl/2014/09/05/technologiczna-bieda-kompilatora-go/</a></p>
<p>You can look at the assembly output from my examples, it looks worse than hand written assembly.</p>
</div>
<ol class="children">
<li id="comment-287192" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-26T17:29:57+00:00">September 26, 2017 at 5:29 pm</time></a> </div>
<div class="comment-content">
<p>The assembly does not look nice. I give the full command one needs to input to generate the assembly, but I omit the assembly because it is quite verbose.</p>
<p>This being said, the assembly produced by modern-day programming languages is often hard to parse. That&rsquo;s not necessarily a bad sign&#8230; programming languages have gotten more sophisticated and they need to do more&#8230; </p>
<p>This makes it harder for programmers to understand the trade-offs involved because so much more is hidden away.</p>
</div>
</li>
<li id="comment-287194" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24cfa9591263008553ae4c125b6a9934?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24cfa9591263008553ae4c125b6a9934?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">wmu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-26T17:35:01+00:00">September 26, 2017 at 5:35 pm</time></a> </div>
<div class="comment-content">
<p>They have replaced the compiler a year ago (or so). It would be nice to recheck the code from your article.</p>
</div>
</li>
</ol>
</li>
<li id="comment-287199" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2aacafa76beb78c7beb2f8f58417935d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2aacafa76beb78c7beb2f8f58417935d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://majid.info/" class="url" rel="ugc external nofollow">Fazal Majid</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-26T18:14:29+00:00">September 26, 2017 at 6:14 pm</time></a> </div>
<div class="comment-content">
<p>How do gccgo or llvm compare?</p>
</div>
<ol class="children">
<li id="comment-287200" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-26T18:19:39+00:00">September 26, 2017 at 6:19 pm</time></a> </div>
<div class="comment-content">
<p>I mention clang in my post (LLVM). For this example, it makes no difference whether you use GNU GCC or LLVM&rsquo;s clang.</p>
<p>I would not expect good things out of gccgo.</p>
</div>
</li>
</ol>
</li>
<li id="comment-287212" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Oren Tirosh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-26T20:26:50+00:00">September 26, 2017 at 8:26 pm</time></a> </div>
<div class="comment-content">
<p>I suspect Swift (llvm based) will optimize the equivalent code nicely. </p>
<p>Not an Apple fanboy here. I almost missed this really nice language because I treated it as &ldquo;that language for writing iPhone apps&rdquo;. It is fully supported on Linux and deserves at least as much attention as Go.</p>
</div>
<ol class="children">
<li id="comment-287217" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-26T21:25:55+00:00">September 26, 2017 at 9:25 pm</time></a> </div>
<div class="comment-content">
<p><a href="https://lemire.me/blog/2017/09/26/runtime-constants-swift/">You are correct regarding Swift</a>.</p>
</div>
</li>
</ol>
</li>
<li id="comment-287293" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2de5370ae7d40b03f4cfa3be812b724e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2de5370ae7d40b03f4cfa3be812b724e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Arun</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-27T16:40:39+00:00">September 27, 2017 at 4:40 pm</time></a> </div>
<div class="comment-content">
<p>DLang vectorizes this nicely. Look at <a href="https://godbolt.org/g/J6Sx6N" rel="nofollow ugc">https://godbolt.org/g/J6Sx6N</a></p>
</div>
<ol class="children">
<li id="comment-287294" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Daniel Lemire</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-27T16:45:21+00:00">September 27, 2017 at 4:45 pm</time></a> </div>
<div class="comment-content">
<p>Can the D compiler recognize that the parameter is effectively a constant and optimize accordingly?</p>
</div>
</li>
</ol>
</li>
</ol>
