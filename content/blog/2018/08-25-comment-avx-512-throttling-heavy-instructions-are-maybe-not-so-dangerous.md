---
date: "2018-08-25 12:00:00"
title: "AVX-512 throttling: heavy instructions are maybe not so dangerous"
index: false
---

[3 thoughts on &ldquo;AVX-512 throttling: heavy instructions are maybe not so dangerous&rdquo;](/lemire/blog/2018/08-25-avx-512-throttling-heavy-instructions-are-maybe-not-so-dangerous)

<ol class="comment-list">
<li id="comment-344307" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-25T06:12:25+00:00">August 25, 2018 at 6:12 am</time></a> </div>
<div class="comment-content">
<p>Note that heavy/light applies to both AVX2 and AVX-512.</p>
<p>So for example heavy AVX2 is in principle the same thing as light AVX-512 (best to show in a chart).</p>
<p>However, the same &ldquo;heavy doesn&rsquo;t necessarily mean heavy unless you do it a lot&rdquo; thing you discuss in this post applies to AVX2 heavy instructions, which in fact makes them quite different than AVX-512 light: because AVX-512 light take effect immediately as soon as one occurs (as far as I can tell), but AVX2 heavy need to be run a lot. So in practice, AVX2 heavy is lets you run one speed tier higher (the highest tier, in fact) compared to AVX-512 light.</p>
</div>
<ol class="children">
<li id="comment-344308" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-25T06:13:46+00:00">August 25, 2018 at 6:13 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
So in practice, AVX2 heavy is lets you run one speed tier higher (the<br/>
highest tier, in fact) compared to AVX-512 light.
</p></blockquote>
<p>That should read &ldquo;&#8230; AVX2 heavy <em>often lets</em> you run one speed tier higher&#8230;&rdquo;.</p>
</div>
</li>
</ol>
</li>
<li id="comment-344408" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b9620cb172292493f9c02c8f37c6cc7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b9620cb172292493f9c02c8f37c6cc7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Royi</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-25T11:38:00+00:00">August 25, 2018 at 11:38 am</time></a> </div>
<div class="comment-content">
<p>Nice forum thread on the subject:</p>
<p><a href="https://www.realworldtech.com/forum/?threadid=179654&#038;curpostid=179715" rel="nofollow ugc">https://www.realworldtech.com/forum/?threadid=179654&#038;curpostid=179715</a></p>
</div>
</li>
</ol>
