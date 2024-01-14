---
date: "2009-11-24 12:00:00"
title: "Run-length encoding (part I)"
index: false
---

[6 thoughts on &ldquo;Run-length encoding (part I)&rdquo;](/lemire/blog/2009/11-24-run-length-encoding-part-i)

<ol class="comment-list">
<li id="comment-51922" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Kevembuangga</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-11-25T02:36:05+00:00">November 25, 2009 at 2:36 am</time></a> </div>
<div class="comment-content">
<p>With this &ldquo;obsessive&rdquo; interest in RLE may be you should think again about the compression scheme we talked about in emails on 19 Sep 2009 and which you didn&rsquo;t seem to grok:<br/>
It&rsquo;s actually iterated hierarchical RLE with a fancy encoding of (what serves as) &ldquo;counters&rdquo;.</p>
</div>
</li>
<li id="comment-51923" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f4443b09ffb634fb76994d519521b047?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f4443b09ffb634fb76994d519521b047?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Parand</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-11-25T03:42:47+00:00">November 25, 2009 at 3:42 am</time></a> </div>
<div class="comment-content">
<p>Thanks Daniel for the beautifully concise explanation of RLE. Makes me wonder how it can seem complex in other explanations.</p>
</div>
</li>
<li id="comment-51924" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-11-25T07:27:02+00:00">November 25, 2009 at 7:27 am</time></a> </div>
<div class="comment-content">
<p>@Kevembuangga I&rsquo;m interested in RLE because it is a fundamental idea. I&rsquo;ll gladly study any form of RLE <strong>if</strong> I have proper documentation.</p>
<p>I could try to guess what <em>iterated hierarchical RLE with a fancy encoding </em> means, but that is not a very interesting game.</p>
</div>
</li>
<li id="comment-51925" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kevembuangga</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-11-26T02:31:07+00:00">November 26, 2009 at 2:31 am</time></a> </div>
<div class="comment-content">
<p><i>I&rsquo;ll gladly study any form of RLE if I have proper documentation.</i></p>
<p>I am afraid there isn&rsquo;t any documentation.<br/>
As I told you this is something I stumbled upon when peeking at reverse engineering of a compression utility.<br/>
This wasn&rsquo;t academic, only engineering, sorry 🙂</p>
</div>
</li>
<li id="comment-51926" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kevembuangga</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-11-26T02:43:13+00:00">November 26, 2009 at 2:43 am</time></a> </div>
<div class="comment-content">
<p>P.S. To explain my (lack of) motivation, since I do not personally enjoy the hairsplitting about nitty gritty details and umphteenth decimals which show up in &ldquo;academic&rdquo; research I don&rsquo;t feel it&rsquo;s worth the effort to elaborate on this.<br/>
I am not even sure it is worth <i>your</i> efforts, it may lack &ldquo;nice properties&rdquo; to write about, yet it <b>was</b> effective in a commercial product.</p>
</div>
</li>
<li id="comment-51928" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-11-26T07:13:33+00:00">November 26, 2009 at 7:13 am</time></a> </div>
<div class="comment-content">
<p>@Kevembuangga Let me put it differently. Could you implement the a scheme like the one you described?</p>
</div>
</li>
</ol>
