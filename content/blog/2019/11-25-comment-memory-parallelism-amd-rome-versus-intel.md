---
date: "2019-11-25 12:00:00"
title: "Memory parallelism: AMD Rome versus Intel"
index: false
---

[17 thoughts on &ldquo;Memory parallelism: AMD Rome versus Intel&rdquo;](/lemire/blog/2019/11-25-memory-parallelism-amd-rome-versus-intel)

<ol class="comment-list">
<li id="comment-449697" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fb3c64ff1f1464306bacc210c73d9287?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fb3c64ff1f1464306bacc210c73d9287?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.thequestforoptimality.com/" class="url" rel="ugc external nofollow">Marc-André Carle</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-25T19:21:19+00:00">November 25, 2019 at 7:21 pm</time></a> </div>
<div class="comment-content">
<p>Very interesting. A lot has changed since I studied algorithmics. It is not easy to keep track of technological advances and their impacts on how to write fast code, even more so when programming is not a central part of one&rsquo;s job.</p>
<p>Is the graph from a paper or it is based on an ad-hoc test you made for this blog post specifically?</p>
</div>
<ol class="children">
<li id="comment-449709" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-25T20:18:52+00:00">November 25, 2019 at 8:18 pm</time></a> </div>
<div class="comment-content">
<p>The graph was built just for the blog post. I make the <a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/11/25" rel="nofollow ugc">raw results available</a>. I use the <a href="https://github.com/lemire/testingmlp" rel="nofollow ugc">testingmlp software package</a>.</p>
</div>
</li>
</ol>
</li>
<li id="comment-449802" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/15f5e601bc93561627decddd6e2e7020?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/15f5e601bc93561627decddd6e2e7020?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Luis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-26T11:00:19+00:00">November 26, 2019 at 11:00 am</time></a> </div>
<div class="comment-content">
<p>Is it possible to see the source code? I am intrigued by the memory lines correlation.</p>
</div>
<ol class="children">
<li id="comment-449804" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/15f5e601bc93561627decddd6e2e7020?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/15f5e601bc93561627decddd6e2e7020?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Luis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-26T11:01:35+00:00">November 26, 2019 at 11:01 am</time></a> </div>
<div class="comment-content">
<p>*I meant lanes, of course</p>
</div>
<ol class="children">
<li id="comment-449813" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-26T13:14:03+00:00">November 26, 2019 at 1:14 pm</time></a> </div>
<div class="comment-content">
<p>I provide a link to the source code, see at the bottom of the post.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-449806" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/00d1c2c85d66f9a50744e7e7c8c35ce2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/00d1c2c85d66f9a50744e7e7c8c35ce2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">chx</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-26T11:17:42+00:00">November 26, 2019 at 11:17 am</time></a> </div>
<div class="comment-content">
<p>I somewhat doubt you were testing Cannon Lake&#8230;? That&rsquo;s a broken CPU shipped in very low quantities and by now EOL. Did you mean Ice Lake?</p>
</div>
<ol class="children">
<li id="comment-449814" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-26T13:20:12+00:00">November 26, 2019 at 1:20 pm</time></a> </div>
<div class="comment-content">
<p>Yes, I mean Cannon Lake. I am still hoping to get an Ice Lake server but I could only find laptops so far.</p>
<p>Cannon Lake is a sane CPU, but yes it is uncommon.</p>
</div>
</li>
</ol>
</li>
<li id="comment-449870" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3f084aad613fb043ddd77b18f48dbbb6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3f084aad613fb043ddd77b18f48dbbb6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Adam Scott</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-26T19:53:35+00:00">November 26, 2019 at 7:53 pm</time></a> </div>
<div class="comment-content">
<p>Very informative and the code looks great. In my experience profiling on a SandyBridge CPU, I saw what looked like a memory performance bottleneck. Now I have a good way to compare. It looks like C++11 is a requirement, so will use on newer machines.</p>
</div>
</li>
<li id="comment-450261" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/87f4c53ee0d3086c92299ab3d360e5b3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/87f4c53ee0d3086c92299ab3d360e5b3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ryan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-27T15:49:35+00:00">November 27, 2019 at 3:49 pm</time></a> </div>
<div class="comment-content">
<p>How does memory parallelism relate to SIMD parallelism? i.e. Would a SIMD instruction only need 1 read to access a chunk of data.</p>
<p>On the CPU, are multiple nearby memory requests coalesced into a single read?</p>
</div>
<ol class="children">
<li id="comment-450304" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-27T18:58:10+00:00">November 27, 2019 at 6:58 pm</time></a> </div>
<div class="comment-content">
<p>Reading into a SIMD register can count issue a single instruction and load more data than is possible with a general-purpose register.</p>
<p>But it is not clear to me how this relate to the numbers I provide here: you access cache lines (typically 64 bytes) even if you only need 1 byte.</p>
</div>
</li>
</ol>
</li>
<li id="comment-450409" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-28T01:12:11+00:00">November 28, 2019 at 1:12 am</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s a good result from Zen2. I wonder there was an improvement here over Zen? I thought Zen topped out at around 12-16 but I could be mis-remembering.</p>
<p>In fact we can&rsquo;t even tell from that chart where Zen2 (or CNL, probably) even tops out.</p>
<p>Do I read the chart correctly that all 3 systems have nearly identical single-lane throughput, or was it normalized somehow?</p>
</div>
<ol class="children">
<li id="comment-450670" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-28T13:18:24+00:00">November 28, 2019 at 1:18 pm</time></a> </div>
<div class="comment-content">
<p>@Travis I posted the raw results. See the end of the post. Not, there was no normalization, this is the computed bandwidth.</p>
<p>I think that there are differences in single-lane bandwidth, though it is not large. You can see it just with the plot (the lines don&rsquo;t quite overlap).</p>
</div>
<ol class="children">
<li id="comment-450715" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-28T17:57:20+00:00">November 28, 2019 at 5:57 pm</time></a> </div>
<div class="comment-content">
<p>Ah, I see the raw results. There is a flaw with using clock() on some systems and it is evident here: the resolution is very low. I had it on my TODO to fix it, but never go around to it I guess.</p>
</div>
</li>
<li id="comment-450716" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-28T18:05:20+00:00">November 28, 2019 at 6:05 pm</time></a> </div>
<div class="comment-content">
<p>Unless I am misreading something, the data does not correspond to the chart? E.g., the last three BW values <a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2019/11/25/rome.txt" rel="nofollow ugc">for Rome</a> are all identical (9752) for 23, 24, 25 but the purple line in the chart is clearly different (and seems to be &gt; 9752) as it does not flatline for those points.</p>
</div>
<ol class="children">
<li id="comment-450758" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-28T20:44:02+00:00">November 28, 2019 at 8:44 pm</time></a> </div>
<div class="comment-content">
<p>You are correct. I just forgot to update the numbers, though I did update the figure. So the mistake I made initially was in not using huge pages.</p>
<p>I&rsquo;ll push an update.</p>
</div>
<ol class="children">
<li id="comment-450885" class="comment odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-29T03:49:23+00:00">November 29, 2019 at 3:49 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m working on some updates to the tool that among other things avoid the poor resolution of clock() on CentSO, so the chart won&rsquo;t be so quantized.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-451341" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-30T00:18:39+00:00">November 30, 2019 at 12:18 am</time></a> </div>
<div class="comment-content">
<p>MLP analysis has cracked the mainstream tech press, see for example <a href="https://www.anandtech.com/show/14605/the-and-ryzen-3700x-3900x-review-raising-the-bar/2#mlppic" rel="nofollow ugc">this Zen review</a> by Andrei and Gavin at AnandTech.</p>
<p>I like the way the chart is made, across various sizes and normalized to the 1-mlp speed (so the y-axis is &ldquo;speedup relative to 1-mlp&rdquo;).</p>
<p><a href="https://www.anandtech.com/show/14605/the-and-ryzen-3700x-3900x-review-raising-the-bar/2#mlppic" rel="nofollow ugc">Here are some more charts</a> in this vein that I made now. Andrei claims that SKX can reach much more than 10, MLP, e.g., based on <a href="https://images.anandtech.com/doci/12545/8280mlp.png" rel="nofollow ugc">this chart</a> which shows it hitting speedups of more than 25x, but I have to think this is measurement error. I couldn&rsquo;t replicate it (admittedly on different-but-stil-SKX hardware).</p>
</div>
</li>
</ol>
