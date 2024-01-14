---
date: "2022-06-07 12:00:00"
title: "Memory-level parallelism : Intel Ice Lake versus Amazon Graviton 3"
index: false
---

[5 thoughts on &ldquo;Memory-level parallelism : Intel Ice Lake versus Amazon Graviton 3&rdquo;](/lemire/blog/2022/06-07-memory-level-parallelism-intel-ice-lake-versus-amazon-graviton-3)

<ol class="comment-list">
<li id="comment-635970" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/77e4428df13e21425afb490a7e2098cd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/77e4428df13e21425afb490a7e2098cd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Markus Schaber</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-06-08T09:11:35+00:00">June 8, 2022 at 9:11 am</time></a> </div>
<div class="comment-content">
<p>Everything has a downside, though: Sometimes, the CPU does not know yet whether it needs to access certain memory (e. G. if the code is behind a conditional branch whose result depends on other memory which is still being in progress).<br/>
Thus, the CPU speculatively reads the memory anyways, knowing the read may be wasted, but gaining speed in the other case.<br/>
As the world is not ideal, those speculative reads have some side effects (e. G. a different timing of later reads because the data may be in the cache or not). And this has been exploited, google for &ldquo;meltdown&rdquo; and &ldquo;spectre&rdquo; vulnerabilities.<br/>
(The explanation here is simplified.)</p>
</div>
</li>
<li id="comment-636217" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://www.joseduarte.com" class="url" rel="ugc external nofollow">Joe Duarte</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-06-11T19:14:25+00:00">June 11, 2022 at 7:14 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel, the Graviton 3 uses DDR5 RAM, and the Ice Lake uses DDR4. How do you think that shapes these results?</p>
<p>Interesting bit here: &ldquo;Out in memory, Graviton 3 noticeably regress in latency compared to Ampere Altra and Graviton 2. That’s likely due to DDR5, which has worse latency characteristics than DDR4. Graviton 3 also places memory controllers on separate IO chiplets. That could exacerbate DDR5’s latency issues.&rdquo;</p>
<p>From: <a href="https://chipsandcheese.com/2022/05/29/graviton-3-first-impressions/" rel="nofollow ugc">https://chipsandcheese.com/2022/05/29/graviton-3-first-impressions/</a></p>
<p>I remember this paper on page sizes. I wonder what the impact would be on this kind of pointer chasing test:</p>
<p>P. Weisberg and Y. Wiseman, &ldquo;Using 4KB page size for Virtual Memory is obsolete,&rdquo; 2009 IEEE International Conference on Information Reuse &amp; Integration, 2009, pp. 262-265, doi: 10.1109/IRI.2009.5211562.</p>
</div>
<ol class="children">
<li id="comment-636218" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-06-11T19:50:50+00:00">June 11, 2022 at 7:50 pm</time></a> </div>
<div class="comment-content">
<p>My post has this comment: &ldquo;I chose not to tweak the page size for these experiments.&rdquo; We know that increasing the page size would improve matters. I chose not to play with it.</p>
<p>I would agree that 4kB should be obsolete, but it is not up to me to change the default.</p>
<p>Regarding DDR5&#8230; this might very well be a factor in the random-access bandwidth. It is likely that the Intel servers have mature DDR4 with low latency.</p>
</div>
<ol class="children">
<li id="comment-636421" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Joe Duarte</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-06-13T03:20:40+00:00">June 13, 2022 at 3:20 am</time></a> </div>
<div class="comment-content">
<p>Yes, I was responding to your comment about 4 KB pages in my comment on the issue. I should&rsquo;ve made that clear. Since it&rsquo;s just a software setting, I&rsquo;m not sure why we&rsquo;d care about defaults. Lots of people run Linux servers with Large Pages or the giant or jumbo pages setting. I&rsquo;m not sure if exact page sizes can be set in Linux, Windows Server, and FreeBSD, but those researchers found 16 KB to be the sweet spot.</p>
</div>
<ol class="children">
<li id="comment-636443" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-06-13T12:08:00+00:00">June 13, 2022 at 12:08 pm</time></a> </div>
<div class="comment-content">
<p><em>I’m not sure why we’d care about defaults. </em></p>
<p>My expectation is that most people adopt the defaults, whatever their operating system is. So, yes, I care about the default for page sizes and I rarely change them myself.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
