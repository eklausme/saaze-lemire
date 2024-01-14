---
date: "2020-06-19 12:00:00"
title: "Computational overhead due to Docker under macOS"
index: false
---

[9 thoughts on &ldquo;Computational overhead due to Docker under macOS&rdquo;](/lemire/blog/2020/06-19-computational-overhead-due-to-docker-under-macos)

<ol class="comment-list">
<li id="comment-527755" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">me</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-20T07:18:35+00:00">June 20, 2020 at 7:18 am</time></a> </div>
<div class="comment-content">
<p>It would be great if you&rsquo;d include numbers for a Linux and a Windows host, too. And also measure overheads on IO.<br/>
At 12 seconds run time, I&rsquo;d also average multiple runs to get a better estimate and avoid cold-start effects.</p>
</div>
</li>
<li id="comment-528797" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-20T17:09:54+00:00">June 20, 2020 at 5:09 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>It would be great if you’d include numbers for a Linux and a Windows host, too.</p>
</blockquote>
<p>For Linux, there is no computational overhead as far as I know. I think I mention this in the post.</p>
<p>For Windows, you have WSL as an option which complicates the analysis. And then you have WSL1 and WSL2.</p>
<blockquote>
<p>And also measure overheads on IO.</p>
</blockquote>
<p>IO is likely a much more complicated story because it comes in different forms and difference usage scenarios, and also because measuring IO is just flat out harder to do reliably, but we know the the overhead is going to be significant and, in some cases, large.</p>
<blockquote>
<p>At 12 seconds run time, I’d also average multiple runs to get a better estimate and avoid cold-start effects.</p>
</blockquote>
<p>The results are consistent and accurate (within a 1% margin of error). Note that I use a desktop (iMac). If you use a laptop, you are likely to get more noise in the measures. But on my iMac, the numbers are precisely reproducible, run to run.</p>
</div>
</li>
<li id="comment-530491" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/05b1d9a68d2c9ac5f73b577df4ea96b8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/05b1d9a68d2c9ac5f73b577df4ea96b8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://kaartics.wordpress.com/" class="url" rel="ugc external nofollow">Kaartic Sivaraam</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-21T05:13:15+00:00">June 21, 2020 at 5:13 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
If you want to squeeze every once of computation performance &#8230;
</p></blockquote>
<p>Typo: s/once/ounce/</p>
</div>
<ol class="children">
<li id="comment-530492" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/916a076f94744430f3fb4679b74876a6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/916a076f94744430f3fb4679b74876a6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://kaartics.wordpress.com/" class="url" rel="ugc external nofollow">Kaartic Sivaraam</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-21T05:15:08+00:00">June 21, 2020 at 5:15 am</time></a> </div>
<div class="comment-content">
<p>Also, you might likely want to mention that you run that loop a billion times. It took me some time to count those zeros. 🙂</p>
</div>
</li>
</ol>
</li>
<li id="comment-531004" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.joseduarte.com" class="url" rel="ugc external nofollow">José Duarte</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-21T15:00:22+00:00">June 21, 2020 at 3:00 pm</time></a> </div>
<div class="comment-content">
<p>Docker on Windows 10 uses Hyper-V by default, though this might require Windows 10 Pro. Hyper-V is a very solid hypervisor, I would bet higher performance than VirtualBox.</p>
<p>With the latest Windows 10 update, the 2004 release, Docker offers to use WSL2 as an alternative hypervisor, though I&rsquo;m not sure what that means under the hood. Is it Docker on top of Linux on top of Hyper-V? I would be surprised if Microsoft built a completely different hypervisor just for WSL(2).</p>
<p>I wonder how the container&rsquo;s OS image impacts things. It probably doesn&rsquo;t matter, but Ubuntu is enormous so I use Alpine.</p>
</div>
</li>
<li id="comment-533990" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ed9600f24dd9e3e96a2191dd87f9832?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ed9600f24dd9e3e96a2191dd87f9832?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://gpupowered.org" class="url" rel="ugc external nofollow">Prabindh</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-07T11:46:50+00:00">July 7, 2020 at 11:46 am</time></a> </div>
<div class="comment-content">
<p>Thanks for the post on MacOS. On Windows, a higher exit time from container is seen, and I filed a bug on Moby that is not yet addressed (<a href="https://github.com/moby/moby/issues/40832" rel="nofollow ugc">https://github.com/moby/moby/issues/40832</a>)</p>
</div>
</li>
<li id="comment-538608" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9b81cae1fb43808ac23a2188258ca9e4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9b81cae1fb43808ac23a2188258ca9e4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Robert Pankowecki</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-17T07:39:33+00:00">July 17, 2020 at 7:39 am</time></a> </div>
<div class="comment-content">
<p>Hey, can you try to reproduce <a href="https://github.com/docker/for-mac/issues/4769" rel="nofollow ugc">my micro-benchmark</a> ? My team is observing 40-80% overhead, not 3%.</p>
</div>
<ol class="children">
<li id="comment-538728" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-17T16:28:57+00:00">July 17, 2020 at 4:28 pm</time></a> </div>
<div class="comment-content">
<p>I wrote a comment in your issue after checking it out.</p>
</div>
</li>
</ol>
</li>
<li id="comment-555131" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2e0d5407ce8609047b8255c50405d7b1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2e0d5407ce8609047b8255c50405d7b1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Example</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-14T19:02:46+00:00">October 14, 2020 at 7:02 pm</time></a> </div>
<div class="comment-content">
<p>On Windows you also have the option to use the Windows Subsystem for Linux (WSL) in version 2. You can use docker either inside the Linux instance or still use the docker desktop for Windows if you need that GUI in the tray.</p>
</div>
</li>
</ol>
