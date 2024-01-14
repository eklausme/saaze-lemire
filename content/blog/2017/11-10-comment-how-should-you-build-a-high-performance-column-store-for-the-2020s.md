---
date: "2017-11-10 12:00:00"
title: "How should you build a high-performance column store for the 2020s?"
index: false
---

[8 thoughts on &ldquo;How should you build a high-performance column store for the 2020s?&rdquo;](/lemire/blog/2017/11-10-how-should-you-build-a-high-performance-column-store-for-the-2020s)

<ol class="comment-list">
<li id="comment-291176" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6a692e2e767b8728a164ef39287771ba?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6a692e2e767b8728a164ef39287771ba?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Priyanka</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-10T20:19:05+00:00">November 10, 2017 at 8:19 pm</time></a> </div>
<div class="comment-content">
<p>Hey!<br/>
That&rsquo;s a really nice post!</p>
<p>Also, checkout this link for blog posts on data science and programming etc. <a href="https://www.scholarspro.com/blog/" rel="nofollow ugc">https://www.scholarspro.com/blog/</a></p>
</div>
</li>
<li id="comment-291224" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ab5c26463154e12ad5e1eddc72f120e4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ab5c26463154e12ad5e1eddc72f120e4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">hh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-11T12:09:52+00:00">November 11, 2017 at 12:09 pm</time></a> </div>
<div class="comment-content">
<p>also you can check <a href="https://github.com/yandex/ClickHouse" rel="nofollow ugc">https://github.com/yandex/ClickHouse</a></p>
</div>
</li>
<li id="comment-291227" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5dcbbedd0c3ceebfb5d0051b426e38dc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5dcbbedd0c3ceebfb5d0051b426e38dc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://db.cs.cmu.edu" class="url" rel="ugc external nofollow">Andy Pavlo</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-11T13:08:54+00:00">November 11, 2017 at 1:08 pm</time></a> </div>
<div class="comment-content">
<p>You&rsquo;re forgetting query codegen + compilation. That makes a big difference in runtime performance.</p>
</div>
</li>
<li id="comment-291228" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/212115a31533862673813157bcfdd033?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/212115a31533862673813157bcfdd033?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://twitter.com/VladimirSitnikv" class="url" rel="ugc external nofollow">Vladimir Sitnikov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-11T13:25:53+00:00">November 11, 2017 at 1:25 pm</time></a> </div>
<div class="comment-content">
<p>It looks like the link &ldquo;FastPFor Java&rdquo; is referring to C++ (it is the same as C++ link). Is that intentional?</p>
</div>
<ol class="children">
<li id="comment-291238" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-11T18:14:28+00:00">November 11, 2017 at 6:14 pm</time></a> </div>
<div class="comment-content">
<p>It wasn&rsquo;t. I appreciate the correction.</p>
</div>
</li>
</ol>
</li>
<li id="comment-291283" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Oren Tirosh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-12T13:42:26+00:00">November 12, 2017 at 1:42 pm</time></a> </div>
<div class="comment-content">
<p>The Blosc meta-compression engine (blosc.org) is widely used in data science. It supports multiple codecs as well as pre-compression transforms that greatly improve compression ratios for many types of data.</p>
<p>The HDF group supports Blosc. Perhaps Arrow should consider it, too?</p>
<p><a href="https://www.hdfgroup.org/2016/02/the-blosc-meta-compressor/" rel="nofollow ugc">https://www.hdfgroup.org/2016/02/the-blosc-meta-compressor/</a></p>
</div>
</li>
<li id="comment-291758" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9747d48d3d8457ad319c271161debf50?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9747d48d3d8457ad319c271161debf50?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.tobiasmuehlbauer.com/" class="url" rel="ugc external nofollow">Tobias Muehlbauer</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-20T18:25:04+00:00">November 20, 2017 at 6:25 pm</time></a> </div>
<div class="comment-content">
<p>I agree with Andy that generating code at runtime and hotspot JIT compilation to machine code are making a big difference. We&rsquo;re hitting the limits of what&rsquo;s possible with interpretation.</p>
<p>Another aspect is logical query optimization that is often overlooked. Improvements in the execution layer and storage can give you a 10x improvement, picking the wrong plan due to missing or bad logical optimization can impact your performance by 100x-1000x.</p>
<p>One final aspect I want to mention is that there is a tendency to over-optimize for read/scan-only use cases. An increasingly important requirement is the ability to create the storage format quickly and to be able to maintain it efficiently (e.g., in-place updates).</p>
</div>
</li>
<li id="comment-552272" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b22397be08d21547a8d1763bcbe71c7d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b22397be08d21547a8d1763bcbe71c7d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Allan Wind</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-11T04:47:54+00:00">September 11, 2020 at 4:47 am</time></a> </div>
<div class="comment-content">
<p>&ldquo;useful top&rdquo; should be &ldquo;useful to&rdquo; in case you want to fix a 3 year old post.</p>
</div>
</li>
</ol>
