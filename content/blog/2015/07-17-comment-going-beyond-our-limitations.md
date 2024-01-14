---
date: "2015-07-17 12:00:00"
title: "Going beyond our limitations"
index: false
---

[5 thoughts on &ldquo;Going beyond our limitations&rdquo;](/lemire/blog/2015/07-17-going-beyond-our-limitations)

<ol class="comment-list">
<li id="comment-175747" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/11246ef0203dec00e61a34f4d35987e7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/11246ef0203dec00e61a34f4d35987e7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Paul Jurczak</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-07-17T19:10:20+00:00">July 17, 2015 at 7:10 pm</time></a> </div>
<div class="comment-content">
<p>Lets not forget that hardware miniaturization is only one of the ways to achieve greater performance. Sooner or later more attention has to be devoted to reduce software bloat and to improve software optimization. </p>
<p>Many programmers who started their careers with hardware offering tens or hundreds of KB RAM and a few MHz of CPU clock speed are watching in horror multi-gigabyte installation files for many popular applications. Looking at my Windows 7 system I see the size of installed applications anywhere from 290KB to 8.2GB with median around 4.5MB, which is better than I expected, but it doesn&rsquo;t mean that there is no problem.</p>
</div>
</li>
<li id="comment-175766" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-07-17T20:43:40+00:00">July 17, 2015 at 8:43 pm</time></a> </div>
<div class="comment-content">
<p>@Paul</p>
<p>In many ways, the gains from software have matched the gains from hardware over time&#8230; </p>
<p>It is true that business apps have typically terrible performance, but that&rsquo;s because nobody cares&#8230; if you look at problems where performance matter&#8230; we have often software that is orders of magnitude faster than older software.</p>
<p>This being said, you are entirely correct that there is a lot of room for optimization at the software level, and not just constant factors.</p>
<p>Thankfully, tools (e.g., compilers, libraries) are improving all the time. One hopes that the nanobots that will live in our arteries in 2050 won&rsquo;t be programmed in 2015-era Java using Eclipse.</p>
</div>
</li>
<li id="comment-175864" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6243f334d2d3dfc1cbb654eb0a12860f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6243f334d2d3dfc1cbb654eb0a12860f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anonymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-07-18T02:51:47+00:00">July 18, 2015 at 2:51 am</time></a> </div>
<div class="comment-content">
<p>To me, one of the most promising non-conventional approach to make classical computers faster is rapid single flux quantum based processors (<a href="https://en.wikipedia.org/wiki/Rapid_single_flux_quantum" rel="nofollow ugc">https://en.wikipedia.org/wiki/Rapid_single_flux_quantum</a>). </p>
<p>RSFQ technology uses hardly any power (because the components are superconducting) and can easily run at clock frequencies of the order of 100 GHz. Of course the downside is that they RSFQs need cryogenic operating temperatures. However, this is not so much of an issue in large computing centers where the infrastructure is already a big investment. In a bit further away in the future, I could even imagine consumer level RSFQ processors with some kind of miniature cooling unit to keep the operating temperature low enough.</p>
<p>The operating principles of RSFQ processors have been proven, but there are still some engineering problems that need to be solved. However, it seems that the industry is not very interested in pursuing RSFQs for whatever reason. By googling, I can find several roadmaps and technology assessments (one by NSA) which all say that this technology should be doable within reasonable timescales.</p>
</div>
</li>
<li id="comment-176380" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-07-19T10:52:56+00:00">July 19, 2015 at 10:52 am</time></a> </div>
<div class="comment-content">
<p>This is an interesting perspective. As the number of cores increases, the cores would be come more and more independent. Clearly, if you 4 cores, they can be synced rather easily. Syncing thousands of cores would be way more problematic. Therefore, programming will become increasingly parallel. We already see this trend with GPUs and distributed systems.</p>
</div>
</li>
<li id="comment-176689" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-07-20T08:53:40+00:00">July 20, 2015 at 8:53 am</time></a> </div>
<div class="comment-content">
<p>@Anonymous</p>
<p>Is the solution to use RSFQ processors? Maybe.</p>
<p>But before we get too excited&#8230;</p>
<p>A frequency of 100 GHz implies one pulse every 10 picoseconds. In 10 picoseconds, light travels 3 mm. Building chips 3 mm wide still implies cramming circuits in a very small space. That is fine for simple circuits, but for a generic processor core, that is too small given our current technology.</p>
</div>
</li>
</ol>
