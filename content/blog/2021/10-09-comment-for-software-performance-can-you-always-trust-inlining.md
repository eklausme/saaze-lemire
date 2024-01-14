---
date: "2021-10-09 12:00:00"
title: "For software performance, can you always trust inlining?"
index: false
---

[6 thoughts on &ldquo;For software performance, can you always trust inlining?&rdquo;](/lemire/blog/2021/10-09-for-software-performance-can-you-always-trust-inlining)

<ol class="comment-list">
<li id="comment-601406" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5b603551ca2eadaf236e19a94d7a54f9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5b603551ca2eadaf236e19a94d7a54f9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Leo Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-10T03:22:02+00:00">October 10, 2021 at 3:22 am</time></a> </div>
<div class="comment-content">
<p>In early 2000s when I first got interested in compression algorithms for IR, I had found that a C++ compiler often refused to inline functions, which was detrimental to performance. So, I rewrote all these little functions as macros. Fun-fun. Now C++ compilers are more clever and this kinda of stuff is less useful (plus implementing everything using macros is difficult, you need to use some ugly hacks and things like ##), I guess it may still fail sometimes. And, of course, such failures are probably more common in C# and Java, which were always less geared towards efficiency compared to C++.</p>
</div>
</li>
<li id="comment-601416" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3347f1852ef13d4019cbc2fe71faef03?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3347f1852ef13d4019cbc2fe71faef03?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Dru Nelson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-10T04:54:48+00:00">October 10, 2021 at 4:54 am</time></a> </div>
<div class="comment-content">
<p>Interesting that it is generating 32 bit code instead of 64 bit Intel code.</p>
</div>
</li>
<li id="comment-602450" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/703b960f7bdfbd75f3a63dd3d4c38c66?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/703b960f7bdfbd75f3a63dd3d4c38c66?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.iprocess.firm.in/" class="url" rel="ugc external nofollow">Vipul Snehadeep Chawathe</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-16T17:07:51+00:00">October 16, 2021 at 5:07 pm</time></a> </div>
<div class="comment-content">
<p>As regular reader, I noticed recently, an erratic special character made your posts temporarily disappear from my handcrafted blog reader. I&rsquo;ve waited abit for correction. Please fix using validation from <a href="https://validator.w3.org/feed/check.cgi?url=https%3A%2F%2Flemire.me%2Fblog%2Ffeed%2F" rel="nofollow ugc">https://validator.w3.org/feed/check.cgi?url=https%3A%2F%2Flemire.me%2Fblog%2Ffeed%2F</a> Thank you.</p>
</div>
</li>
<li id="comment-606095" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/72dd22454252b42d846494efeda05651?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/72dd22454252b42d846494efeda05651?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">steve heller</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-11-10T14:57:26+00:00">November 10, 2021 at 2:57 pm</time></a> </div>
<div class="comment-content">
<p>The correct answer to &ldquo;For software performance, can you always trust X&rdquo; is &ldquo;No&rdquo;, for any value of X.</p>
</div>
</li>
<li id="comment-606102" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d0f8a29a43d98d1d6ecf3818b1869e69?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d0f8a29a43d98d1d6ecf3818b1869e69?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kunal</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-11-10T16:05:05+00:00">November 10, 2021 at 4:05 pm</time></a> </div>
<div class="comment-content">
<p>We have taken a note of this and opened <a href="https://github.com/dotnet/runtime/pull/61408" rel="nofollow ugc">https://github.com/dotnet/runtime/pull/61408</a> to fix the issue, but I believe the C# code itself to detect if there is ASCII or not can be simplified using MoveMask. Here is an example of how we do it : </p>
<p><a href="https://github.com/dotnet/runtime/blob/e64cce6fbbde72d1ea61010bd08f11ba7b51afc9/src/libraries/System.Private.CoreLib/src/System/Text/ASCIIUtility.cs#L290-L297" rel="nofollow ugc">https://github.com/dotnet/runtime/blob/e64cce6fbbde72d1ea61010bd08f11ba7b51afc9/src/libraries/System.Private.CoreLib/src/System/Text/ASCIIUtility.cs#L290-L297</a></p>
</div>
<ol class="children">
<li id="comment-606114" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-11-10T17:24:24+00:00">November 10, 2021 at 5:24 pm</time></a> </div>
<div class="comment-content">
<p>The proposed function (in the blog post) aims to determine if 16 bytes are made of ASCII digits. I am also not claiming that it is optimal (or even correct).</p>
</div>
</li>
</ol>
</li>
</ol>
