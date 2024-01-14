---
date: "2022-11-29 12:00:00"
title: "How big are your SVE registers ? (AWS Graviton)"
index: false
---

[5 thoughts on &ldquo;How big are your SVE registers ? (AWS Graviton)&rdquo;](/lemire/blog/2022/11-29-how-big-are-your-sve-registers-aws-graviton)

<ol class="comment-list">
<li id="comment-648057" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-29T22:31:48+00:00">November 29, 2022 at 10:31 pm</time></a> </div>
<div class="comment-content">
<p>Interesting &#8211; svlen_* isn&rsquo;t documented in the current ACLE, but it seems like it may have been in an earlier version. It seems like current GCC/Clang accept it as well.</p>
<p>Should probably use the documented svcntb() instead though.</p>
<p>I think Neoverse V1 is the only ARM processor with 256-bit vectors. Neoverse V2 has reverted to 128-bit vectors.</p>
</div>
<ol class="children">
<li id="comment-648058" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-29T23:09:48+00:00">November 29, 2022 at 11:09 pm</time></a> </div>
<div class="comment-content">
<p>I agree that svcntb is nicer. Thanks.</p>
<p>The svlen_* intrinsics are documented in a currently available manual.</p>
<p>Reference:</p>
<p>Arm C Language Extensions for SVE<br/>
<a href="https://developer.arm.com/documentation/100987/0000/" rel="nofollow ugc">https://developer.arm.com/documentation/100987/0000/</a></p>
<p>Section 6.27.6. LEN: Return the number of elements in a vector</p>
</div>
<ol class="children">
<li id="comment-648066" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-30T12:03:29+00:00">November 30, 2022 at 12:03 pm</time></a> </div>
<div class="comment-content">
<p>Weird, I searched that exact document but search didn&rsquo;t find it for some reason. Oh well, thanks for the correction!</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-648070" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e9fee6ecae8cb1a321fab1e09099ed90?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e9fee6ecae8cb1a321fab1e09099ed90?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jorge Bellon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-30T15:05:18+00:00">November 30, 2022 at 3:05 pm</time></a> </div>
<div class="comment-content">
<p>ARM processors with wide vector registers may be difficult to find, but you can find wider vectors in Fugaku&rsquo;s Fujitsu A64FX CPUs. Their ARM cores also support SVE extensions with 512bit wide SIMD registers:<br/>
<a href="https://www.fujitsu.com/global/products/computing/servers/supercomputer/a64fx/" rel="nofollow ugc">https://www.fujitsu.com/global/products/computing/servers/supercomputer/a64fx/</a></p>
</div>
<ol class="children">
<li id="comment-648073" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-30T16:23:18+00:00">November 30, 2022 at 4:23 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for the link.</p>
</div>
</li>
</ol>
</li>
</ol>
