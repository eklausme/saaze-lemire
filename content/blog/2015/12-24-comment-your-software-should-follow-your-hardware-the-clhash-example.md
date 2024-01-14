---
date: "2015-12-24 12:00:00"
title: "Your software should follow your hardware: the CLHash example"
index: false
---

[3 thoughts on &ldquo;Your software should follow your hardware: the CLHash example&rdquo;](/lemire/blog/2015/12-24-your-software-should-follow-your-hardware-the-clhash-example)

<ol class="comment-list">
<li id="comment-219129" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Simon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-12-25T16:54:14+00:00">December 25, 2015 at 4:54 pm</time></a> </div>
<div class="comment-content">
<p>I noticed that skylake CPUs can take the new faster DDR4 RAM. How does this factor into the 5 to 10%, of at all?</p>
</div>
</li>
<li id="comment-219135" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/434f10a650dac564db4cd18e78717ff6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/434f10a650dac564db4cd18e78717ff6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.singliar.info" class="url" rel="ugc external nofollow">Tomas</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-12-25T17:43:38+00:00">December 25, 2015 at 5:43 pm</time></a> </div>
<div class="comment-content">
<p>How do you write software to take advantage of new instructions? It would seem that either a compiler needs to support it first (and support it well, including optimization), or you have to get down to assembler.</p>
</div>
<ol class="children">
<li id="comment-219176" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9586b1b724e763cbd4360f23054483f7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9586b1b724e763cbd4360f23054483f7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jim</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-12-26T02:51:37+00:00">December 26, 2015 at 2:51 am</time></a> </div>
<div class="comment-content">
<p>@Tomas: you can use Intel Inrinsics. You can browse them with <a href="https://software.intel.com/sites/landingpage/IntrinsicsGuide/" rel="nofollow ugc">https://software.intel.com/sites/landingpage/IntrinsicsGuide/</a>. You can see their use in <a href="https://github.com/lemire/StronglyUniversalStringHashing/blob/6486be54da481121293f4f28a954371a907da700/include/clmul.h#L16" rel="nofollow ugc">https://github.com/lemire/StronglyUniversalStringHashing/blob/6486be54da481121293f4f28a954371a907da700/include/clmul.h#L16</a></p>
</div>
</li>
</ol>
</li>
</ol>
