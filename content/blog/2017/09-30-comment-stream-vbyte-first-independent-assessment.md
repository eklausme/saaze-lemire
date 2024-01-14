---
date: "2017-09-30 12:00:00"
title: "Stream VByte: first independent assessment"
index: false
---

[4 thoughts on &ldquo;Stream VByte: first independent assessment&rdquo;](/lemire/blog/2017/09-30-stream-vbyte-first-independent-assessment)

<ol class="comment-list">
<li id="comment-287755" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-02T05:19:47+00:00">October 2, 2017 at 5:19 am</time></a> </div>
<div class="comment-content">
<p>I made a start at SIMD-izing the encoding; so far my best estimate is at least 16 instructions per quadword. One hitch is that there is no SIMD unsigned gt/lt compare, so instead I&rsquo;m doing shift-right and compare to zero for the three different widths. The output bitmasks are conveniently -1 or 0 however, so we can just sum them together with 3 to get the 2-bit code value for each lane. </p>
<p>The shuffle looks like it will need a table unless there&rsquo;s some fancy way to build it &#8212; that&rsquo;s still on my todo list.</p>
</div>
<ol class="children">
<li id="comment-287818" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-02T23:36:23+00:00">October 2, 2017 at 11:36 pm</time></a> </div>
<div class="comment-content">
<p>Wow.</p>
<p>Note that there is an open issue regarding endianess&#8230; </p>
<p><a href="https://github.com/lemire/streamvbyte/issues/4" rel="nofollow ugc">https://github.com/lemire/streamvbyte/issues/4</a></p>
<p>It seems that the current encoder/decoder are little-endian whereas the paper describes a big-endian format. I have not had time to look into the matter, but for interoperability, this matters.</p>
<p><em> One hitch is that there is no SIMD unsigned gt/lt compare</em></p>
<p>I think that if you subtract 1&#038;lt&#038;lt(L-1) to L-bit integers prior to doing the signed comparison, you get an unsigned comparison.</p>
</div>
<ol class="children">
<li id="comment-287823" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kendall Willets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-03T00:26:46+00:00">October 3, 2017 at 12:26 am</time></a> </div>
<div class="comment-content">
<p>I did overlook the fact that the sub would only need to happen once for the three comparisons &#8212; I&rsquo;ll look at this again tonight.</p>
</div>
<ol class="children">
<li id="comment-287826" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-03T00:37:24+00:00">October 3, 2017 at 12:37 am</time></a> </div>
<div class="comment-content">
<p>I think you can almost always get unsigned comparisons very cheaply, which is probably why Intel did not bother adding support for it.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
