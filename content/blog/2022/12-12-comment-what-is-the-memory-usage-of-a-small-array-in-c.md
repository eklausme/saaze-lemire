---
date: "2022-12-12 12:00:00"
title: "What is the memory usage of a small array in C++?"
index: false
---

[7 thoughts on &ldquo;What is the memory usage of a small array in C++?&rdquo;](/lemire/blog/2022/12-12-what-is-the-memory-usage-of-a-small-array-in-c)

<ol class="comment-list">
<li id="comment-648405" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/19a4854800515bc238ce72a07637a256?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/19a4854800515bc238ce72a07637a256?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">leo</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-12T17:04:53+00:00">December 12, 2022 at 5:04 pm</time></a> </div>
<div class="comment-content">
<p>hi, daniel, I think it was not caused by different compilers, but caused by different malloc implements, or same malloc in different cpu archs/OSs.</p>
</div>
</li>
<li id="comment-648410" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e3a1d35ba3233e3735ba5f7517cd6bf7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e3a1d35ba3233e3735ba5f7517cd6bf7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Silverback</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-12T21:06:15+00:00">December 12, 2022 at 9:06 pm</time></a> </div>
<div class="comment-content">
<p>Can you test this using zig ?</p>
</div>
</li>
<li id="comment-648420" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">me</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-13T09:15:21+00:00">December 13, 2022 at 9:15 am</time></a> </div>
<div class="comment-content">
<p>Thank you. On glibc it is even more than I would have expected. Surprising to see that Apple (NetBSD?) fares better.<br/>
I guess with C++, a common improvement is to use Boost.Pool if you have many such tiny objects.<br/>
<a href="https://www.boost.org/doc/libs/1_80_0/libs/pool/doc/html/boost_pool/pool/introduction.html" rel="nofollow ugc">https://www.boost.org/doc/libs/1_80_0/libs/pool/doc/html/boost_pool/pool/introduction.html</a><br/>
Given that Java stores (and exposes) the length of the array (i.e., Java arrays are more like a struct { int32 length; byte[] data }) it does fairly well in memory overhead. I would have thought that for a pure byte[4] allocation, C can do with 4-8 bytes.</p>
</div>
</li>
<li id="comment-648430" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dce09498a43bb04e10c2f76a5043809e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dce09498a43bb04e10c2f76a5043809e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Patrick Van Cauteren</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-14T07:42:42+00:00">December 14, 2022 at 7:42 am</time></a> </div>
<div class="comment-content">
<p>It indeed depends on the implementation. I have an implementation (overwriting new and delete) that aligns on 8 bytes, so one million arrays of 4 bytes would only require 8 MiB (plus a small fraction for some housekeeping).<br/>
In theory it would be possible to write an implementation that requires even less (4 MiB), assuming that it&rsquo;s ok to align 4 byte allocations on an address that&rsquo;s a multiple of 4 bytes.</p>
</div>
</li>
<li id="comment-648481" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a3aa2302f73304b92c4211d58d5867f2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a3aa2302f73304b92c4211d58d5867f2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wild Pointer</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-19T01:14:36+00:00">December 19, 2022 at 1:14 am</time></a> </div>
<div class="comment-content">
<p>You&rsquo;re not measuring just the array, you&rsquo;re measuring the array + malloc overhead + cache alignment overhead + whatever implementation overhead. Pretty common knowledge going back as far as I can remember.</p>
</div>
<ol class="children">
<li id="comment-648570" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c7fc46ca0969fcdbb033671e3646b729?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c7fc46ca0969fcdbb033671e3646b729?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Yakov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-25T00:14:17+00:00">December 25, 2022 at 12:14 am</time></a> </div>
<div class="comment-content">
<p>Daniel, you should not expect the idiomatic usage of C++, or C for that matter, to be terribly efficient.<br/>
I find the impl shifts away from the standard together with the requirements.<br/>
If your memory consumption and/or allocation latency hurts you, you quickly discover custom allocators, how to replace malloc with something thinner and faster, and some more things.<br/>
I&rsquo;d also recommend reading &ldquo;what every programmer should know about CPU and memory&rdquo;<br/>
😀<br/>
Yakov</p>
</div>
</li>
</ol>
</li>
<li id="comment-648605" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-27T20:46:39+00:00">December 27, 2022 at 8:46 pm</time></a> </div>
<div class="comment-content">
<p>The point to be made here is there is cost in size and time to small allocations. Maybe you already know this, but more than a few of our peers are foggy on the topic. </p>
<p>Have you ever read code from others that contains:<br/>
1. Heap allocation that could be static?<br/>
2. Many small heap allocations in a much-repeated loop?<br/>
3. One-at-a-time heap allocation of a large number of objects of a single type? </p>
<p>To the performance-oriented folk &#8211; for the mental itch invoked by the above &#8211; you are welcome. 🙂</p>
<p>Keep in mind that the average programmer is just that. This sort of reminder is not out of place.</p>
</div>
</li>
</ol>
