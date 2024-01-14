---
date: "2012-08-13 12:00:00"
title: "On feeding your CPU with data"
index: false
---

[8 thoughts on &ldquo;On feeding your CPU with data&rdquo;](/lemire/blog/2012/08-13-on-feeding-your-cpu-with-data)

<ol class="comment-list">
<li id="comment-55531" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d92b64b0bbc0f2b7297924e76c4a4a84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d92b64b0bbc0f2b7297924e76c4a4a84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://theprogrammersparadox.blogspot.com/" class="url" rel="ugc external nofollow">Paul W. Homer</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-08-13T11:40:55+00:00">August 13, 2012 at 11:40 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m not sure if it is true or not, but mainframes are often attributed with having much bigger pipes (to move data around). </p>
<p>Way back, I was working in C and a friend was in APL on a huge main-frame, we&rsquo;d write the same cpu intensive algorithms, then compare performance. I never kept track of the numbers, but it was clear that a time-slice off of my friend&rsquo;s machine was nearly equivalent to the speed of my workstation (which was state-of-the-art then) for smaller jobs, but for big bulk jobs his hardware was often stunningly faster. </p>
<p>Somewhere in the beginning of the OO age, everything became optimized for one-offs, rather than for bulk processing. Usually when I&rsquo;m optimizing code, the first thing I try is to deal with the data in bulk (followed by memoization) &#8230;</p>
<p>Paul.</p>
</div>
</li>
<li id="comment-55532" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8b35484cb70f22b7ea9ba5cce1f1378f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8b35484cb70f22b7ea9ba5cce1f1378f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">wn</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-08-13T11:42:16+00:00">August 13, 2012 at 11:42 am</time></a> </div>
<div class="comment-content">
<p>Are you sure it is an issue of where the data resides and not a scheduling one?</p>
</div>
</li>
<li id="comment-55533" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-08-13T11:57:38+00:00">August 13, 2012 at 11:57 am</time></a> </div>
<div class="comment-content">
<p>@wn</p>
<p>What do you mean by scheduling? The tests run very fast and I pick the best out of several runs.</p>
</div>
</li>
<li id="comment-55534" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-08-13T13:30:52+00:00">August 13, 2012 at 1:30 pm</time></a> </div>
<div class="comment-content">
<p>RAM is another form of secondary storage, like disk used to be. Cache is now what RAM was conceived to be: a flat memory space with constant access time.</p>
</div>
</li>
<li id="comment-55535" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8b35484cb70f22b7ea9ba5cce1f1378f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8b35484cb70f22b7ea9ba5cce1f1378f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">wn</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-08-13T17:50:23+00:00">August 13, 2012 at 5:50 pm</time></a> </div>
<div class="comment-content">
<p>How long do they run, on which OS, and at what priority? If the test process can be preempted by the OS, which is more likely to happen on longer runs (as with the large data arrays) then you might be measuring the switch contexts of processes without meaning to do so, and would probably want to eliminate that&#8230;</p>
</div>
</li>
<li id="comment-55536" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-08-13T17:53:27+00:00">August 13, 2012 at 5:53 pm</time></a> </div>
<div class="comment-content">
<p>@wn</p>
<p>I prefix them with &ldquo;nice -n -19&rdquo; on a Linux box. Moreover, they take only a few seconds to run and involve no IO.</p>
</div>
</li>
<li id="comment-55537" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dada9de44173d6c1b13691554ef8e974?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dada9de44173d6c1b13691554ef8e974?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://faculty.washington.edu/stiber/" class="url" rel="ugc external nofollow">Mike Stiber</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-08-14T20:50:39+00:00">August 14, 2012 at 8:50 pm</time></a> </div>
<div class="comment-content">
<p>And things are even more complicated if you&rsquo;re programming a GPU, which has an much more complicated memory architecture. Or, potentially, if you&rsquo;re doing multithreaded coding on a multicore machine.</p>
<p>Time to relearn computational complexity.</p>
</div>
</li>
<li id="comment-55538" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-08-15T11:21:00+00:00">August 15, 2012 at 11:21 am</time></a> </div>
<div class="comment-content">
<p>@Mike,</p>
<p>in regard to GPUs: what is the current main memory to/from GPU memory exchange rate?</p>
</div>
</li>
</ol>
