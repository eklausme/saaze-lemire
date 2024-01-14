---
date: "2022-11-10 12:00:00"
title: "Measuring the memory usage of your C++ program"
index: false
---

[9 thoughts on &ldquo;Measuring the memory usage of your C++ program&rdquo;](/lemire/blog/2022/11-10-measuring-the-memory-usage-of-your-c-program)

<ol class="comment-list">
<li id="comment-647418" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fae1704291b10722d46c592ffed1815a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fae1704291b10722d46c592ffed1815a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://martin.ankerl.com/" class="url" rel="ugc external nofollow">Martin Leitner-Ankerl</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-10T19:31:30+00:00">November 10, 2022 at 7:31 pm</time></a> </div>
<div class="comment-content">
<p>I find it interesting that when you replace<br/>
<code><br/>
std::vector v2(1000000);<br/>
</code><br/>
with<br/>
<code><br/>
std::vector v2;<br/>
v2.reserve(1000000);<br/>
</code></p>
<p>Memory usage doesn&rsquo;t change at all after the reserve() call. Linux only provides allocated pages when they are actually touched</p>
</div>
<ol class="children">
<li id="comment-647420" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-10T19:57:21+00:00">November 10, 2022 at 7:57 pm</time></a> </div>
<div class="comment-content">
<p>It is a good point and I have updated the blog post accordingly.</p>
</div>
<ol class="children">
<li id="comment-647436" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9acee3f0ef79132b823e7cd6b6ab60f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9acee3f0ef79132b823e7cd6b6ab60f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.jabperf.com/" class="url" rel="ugc external nofollow">Mark Dawson Jr</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-11T01:57:49+00:00">November 11, 2022 at 1:57 am</time></a> </div>
<div class="comment-content">
<p>Yes, this is why I pre-allocate a large memory footprint and then touch/pin every allocated page at application start time in order to prevent latency hiccups from runtime page faults (which actually increase *real* memory usage).</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-647421" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1cc4a77a8256c3049728728c6c45625b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1cc4a77a8256c3049728728c6c45625b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">MD</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-10T21:16:04+00:00">November 10, 2022 at 9:16 pm</time></a> </div>
<div class="comment-content">
<p>See also: <a href="https://github.com/MattPD/cpplinks/blob/master/performance.tools.md#memory---profiling" rel="nofollow ugc">https://github.com/MattPD/cpplinks/blob/master/performance.tools.md#memory&#8212;profiling</a></p>
</div>
</li>
<li id="comment-647424" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ad7f60eb72a0d430aa61d24517fb4aa0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ad7f60eb72a0d430aa61d24517fb4aa0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Khalid Kunji</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-10T22:56:19+00:00">November 10, 2022 at 10:56 pm</time></a> </div>
<div class="comment-content">
<p>It can be a fun learning exercise, but isn&rsquo;t it a legal requirement to cover Valgrind whenever discussing C++ and memory? 😛<br/>
A quick look about Heaptrack suggests that people primarily sing its praises for speed. Perhaps I&rsquo;ll try it sometime as I did have an issue a few months ago where the code took a few hours to reach the pain point when run with Valgrind. The concerns with new tooling are of course to 1) get used to it and 2) wondering how buggy it is since it hasn&rsquo;t been as battle tested. </p>
<p>It&rsquo;s also doesn&rsquo;t inspire much confidence that when asked about related tools and why he made Heaptrack he replied, &ldquo;Hey Erwan,<br/>
the simple answer is that I was not aware of these solutions&#8230; &rdquo; Usually one would like to know something about what is available before diving in headfirst. </p>
<p>The Cherno over on YouTube has some nice videos on rolling a little bit of your own memory tracking.</p>
</div>
<ol class="children">
<li id="comment-647425" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-10T23:07:46+00:00">November 10, 2022 at 11:07 pm</time></a> </div>
<div class="comment-content">
<p>Valgrind 3.18 does not support these instructions. I have not tried with valgrind 3.19.</p>
</div>
</li>
</ol>
</li>
<li id="comment-647427" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/40a99e4781defef73486cd362ebb5f49?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/40a99e4781defef73486cd362ebb5f49?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tim Parker</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-10T23:15:38+00:00">November 10, 2022 at 11:15 pm</time></a> </div>
<div class="comment-content">
<p>As with the dynamic library performance article, understanding what you&rsquo;re actually measuring is often useful before making too many statements about the results.</p>
</div>
</li>
<li id="comment-647440" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cf25cfbc3dab1101c8473e8e89a6a689?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cf25cfbc3dab1101c8473e8e89a6a689?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://matklad.github.io/" class="url" rel="ugc external nofollow">matklad</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-11T10:33:19+00:00">November 11, 2022 at 10:33 am</time></a> </div>
<div class="comment-content">
<p>&gt; Ivica Bogosavljevic recommends that Linux users try heaptrack to better understand memory usage.</p>
<p>I can also recommend <a href="https://github.com/koute/bytehound" rel="nofollow ugc">https://github.com/koute/bytehound</a>, for me it gave much better visibility than heaptrack (the data collection algorithm is similar between the two, but in bytehound I can in one click get a flamegraph of live allocations at a given point in time, which I’ve found the most useful visualization)</p>
</div>
</li>
<li id="comment-647478" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/aa32b2c427749d0f308a33e50f8c3880?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/aa32b2c427749d0f308a33e50f8c3880?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Adrian Piccioli</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-14T02:32:52+00:00">November 14, 2022 at 2:32 am</time></a> </div>
<div class="comment-content">
<p>Easy guys, stop discussing</p>
<p>The NSA just &ldquo;prohibited&rdquo; C++ precisely because of memory concerns so all this discussion became virtual = 0</p>
<p>Good point is you can switch to Rust, yay!<br/>
Bad news is you will be no devs anymore:</p>
<p>You&rsquo;ll become the compiler! 🤣</p>
<p>On a serious note, endure: Our wages will mostly tenfold over time👌🏻</p>
</div>
</li>
</ol>
