---
date: "2006-11-06 12:00:00"
title: "Looking for an all-recording plug-in for Firefox"
index: false
---

[7 thoughts on &ldquo;Looking for an all-recording plug-in for Firefox&rdquo;](/lemire/blog/2006/11-06-looking-for-an-all-recording-plug-in-for-firefox)

<ol class="comment-list">
<li id="comment-45036" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a92c5b4df6ec1769a72b00dae3fd2192?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a92c5b4df6ec1769a72b00dae3fd2192?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.seanmcgrath.me/" class="url" rel="ugc external nofollow">Sean McGrath</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-11-06T20:50:31+00:00">November 6, 2006 at 8:50 pm</time></a> </div>
<div class="comment-content">
<p>Hammerspace sounds cool and the idea behind it sound great too. </p>
<p>I&rsquo;d be willing to help with developing it. I&rsquo;ve been meaning to try a firefox plugin for some time now. I really don&rsquo;t know the first thing about it though. I&rsquo;m a quick learner though.</p>
</div>
</li>
<li id="comment-45094" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ab82fd8b5ffe4d09c2bb5f9c14d34b09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ab82fd8b5ffe4d09c2bb5f9c14d34b09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Parand</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-11-06T23:53:26+00:00">November 6, 2006 at 11:53 pm</time></a> </div>
<div class="comment-content">
<p>Does it have to be a Firefox plugin? I&rsquo;m guessing you can setup a proxy server that records everything it proxies. You&rsquo;ll pay a bit of a performance penalty, but it&rsquo;ll be a nice and simple solution.</p>
</div>
</li>
<li id="comment-45038" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6b8344542d3435f6c2fb097ce10b6b67?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6b8344542d3435f6c2fb097ce10b6b67?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">gmarketer</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-11-06T20:52:09+00:00">November 6, 2006 at 8:52 pm</time></a> </div>
<div class="comment-content">
<p>Maybe ScrapBook extension could help you? <a href="http://amb.vis.ne.jp/mozilla/scrapbook/" rel="nofollow ugc">http://amb.vis.ne.jp/mozilla/scrapbook/</a></p>
</div>
</li>
<li id="comment-45223" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ccf550c5274e1418c56c00f70713af3f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ccf550c5274e1418c56c00f70713af3f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Amir Langer</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-11-07T06:53:06+00:00">November 7, 2006 at 6:53 am</time></a> </div>
<div class="comment-content">
<p>Try Charles:</p>
<p><a href="http://xk72.com/charles/index.php" rel="nofollow ugc">http://xk72.com/charles/index.php</a></p>
<p>It is a proxy solution and you will need to somehow make it persist the data (it records everything into memory), but it does the other 90% of what you need.</p>
</div>
</li>
<li id="comment-45250" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3ec443d910e47d436be3cb42967fba3c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3ec443d910e47d436be3cb42967fba3c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Scott Flinn</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-11-07T08:13:47+00:00">November 7, 2006 at 8:13 am</time></a> </div>
<div class="comment-content">
<p>Very cool idea. Sounds like something I might want to use myself. Personally, I&rsquo;d probably favour the proxy solution because I use a variety of different browsers.</p>
<p>I wrote something similar while at NRC. I needed a Web crawler that could evaluate JavaScript in an authentic browser environment, complete with a DOM and all the usual embedding connections. So I wrote the crawler as a Mozilla extension. It didn&rsquo;t actually write things to file (it wrote summaries to a DB), but that&rsquo;s pretty easy. What it *did* do was figure out all the containment relationships so that it could fix up links for local use, the way wget does. It was actually kind of tricky figuring out how to associate independent requests with each other &#8212; e.g., was that page loaded into a top level window, or into an iframe on some page? But Mozilla (and hence Firefox) has enough hooks to do it, if only barely.</p>
<p>I&rsquo;d love to help. I wish I had the time. If a few months go by and you&rsquo;re still looking for something like this, the timing might be better for me.</p>
</div>
</li>
<li id="comment-47964" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/98494a31920a4d5859daba9182122972?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/98494a31920a4d5859daba9182122972?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-11-15T00:43:58+00:00">November 15, 2006 at 12:43 am</time></a> </div>
<div class="comment-content">
<p>Um. No one mentioned Slogger? That&rsquo;s exactly what you want. </p>
<p><a href="http://www.kenschutte.com/slogger/" rel="nofollow ugc">http://www.kenschutte.com/slogger/</a></p>
</div>
</li>
<li id="comment-48524" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dba9961f843ebf783b89418e09b87342?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dba9961f843ebf783b89418e09b87342?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marc</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-11-17T13:21:56+00:00">November 17, 2006 at 1:21 pm</time></a> </div>
<div class="comment-content">
<p>Please add firefox cookies/bad web sites immunization in next version!<br/>
Firefox 2 cannot reject third party cookies!!!!!!!!</p>
</div>
</li>
</ol>
