---
date: "2021-10-27 12:00:00"
title: "In C, how do you know if the dynamic allocation succeeded?"
index: false
---

[10 thoughts on &ldquo;In C, how do you know if the dynamic allocation succeeded?&rdquo;](/lemire/blog/2021/10-27-in-c-how-do-you-know-if-the-dynamic-allocation-succeeded)

<ol class="comment-list">
<li id="comment-603700" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fe4f333e5a9165ea1eee399317618b70?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fe4f333e5a9165ea1eee399317618b70?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">roystgnr</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-27T16:36:00+00:00">October 27, 2021 at 4:36 pm</time></a> </div>
<div class="comment-content">
<p>And shared libraries might be counted in both real and virtual memory for every process that uses them even though they&rsquo;re taking up the same pages of read-only or copy-on-write memory, and memory mapped files might be counted in their entirety in virtual memory even if only a small section of the file ever gets read, and on Linux the Out-Of-Memory killer might choose to kill a *different* process when your process tries to get real access to overallocated virtual memory, and the C shared library might not *really* release the memory you free() because it&rsquo;s faster to keep it around to avoid hitting up the kernel when you next try to malloc(), and none of this stuff is set in stone in a standard so for all I know anything or everything I&rsquo;ve just recalled might be years out of date&#8230;</p>
<p>I hate this stuff. At least heap allocation all ends up going through a few bottleneck APIs, so you can get a vague handle on memory usage optimization with an LD_PRELOAD to intercept and tally those calls.</p>
<p>I was originally going to comment that it was disappointing when your blog post didn&rsquo;t really answer the question posed in your blog title, especially compared to your usual detailed answers to these sorts of questions. But I guess that&rsquo;s not at all your fault; the best answer we can get might really be: if nothing crashes later then the allocation must have succeeded in some sense? I assume this is why some embedded systems people end up trying to just keep everything on the stack or in static globals.</p>
</div>
<ol class="children">
<li id="comment-603702" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-27T16:42:02+00:00">October 27, 2021 at 4:42 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for the comment. I do not answer my own question because it is, as you remarked, non-trivial, at least if you rely on purely standard C.</p>
</div>
</li>
<li id="comment-604761" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2a52bea76490fcce15ff68d2cee4055f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2a52bea76490fcce15ff68d2cee4055f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Georg Nikodym</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-11-03T16:29:42+00:00">November 3, 2021 at 4:29 pm</time></a> </div>
<div class="comment-content">
<p>In embedded:</p>
<p>&#8211; we rarely have a lot of memory and not all of it has the same properties<br/>
&#8211; standard C doesn&rsquo;t have a way to interrogate your heap (or stack) utilization&#8230;<br/>
&#8211; other platform specific stuff (heck, you might not even have an allocator)<br/>
&#8211; debugging can be quite challenging</p>
<p>all contributing to the &ldquo;odd&rdquo; ways we write C code.</p>
</div>
<ol class="children">
<li id="comment-605281" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5e9d03bb7a49c6b3a77752c93042e856?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5e9d03bb7a49c6b3a77752c93042e856?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">M.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-11-05T22:03:12+00:00">November 5, 2021 at 10:03 pm</time></a> </div>
<div class="comment-content">
<p>Also in embedded we aren&rsquo;t sharing the memory with other processes so it&rsquo;s all ours from the get go.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-603704" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4f6c84e03d267b25373e39406094b913?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4f6c84e03d267b25373e39406094b913?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alex</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-27T16:54:07+00:00">October 27, 2021 at 4:54 pm</time></a> </div>
<div class="comment-content">
<p>This actually has more to do with how &ldquo;overcommit&rdquo; is set up on the system, than with the difference between virtual and physical memory. </p>
<p>You may try the same on a Linux system with overcommit turned off. This is done with /proc/sys/vm/overcommit_memory unless I remember wrong. Or, try on a Windows system &#8211; Windows does not allow overcommit (but still uses the same virtual/physical memory design).</p>
<p>The VM subsystem knows perfectly well that you&rsquo;re allocating more than it can deliver, despite the memory being virtual. Overcommit was originally allowed to ease porting of some older software to Linux. Today it may make sense if a process uses vast address space for IO &#8211; that is not backed up by actual memory pages &#8211; but in general, turning overcommit off is a good thing for development. Makes finding memory related issues a lot quicker.</p>
</div>
</li>
<li id="comment-603708" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1e188fb44b7cbb476811e5c010e1ad03?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1e188fb44b7cbb476811e5c010e1ad03?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Raivokas Ripuli</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-27T19:59:47+00:00">October 27, 2021 at 7:59 pm</time></a> </div>
<div class="comment-content">
<p>This is operating system issue. Linux has 3 overcommit modes, heuristic (default), always, and never. </p>
<p><a href="https://www.kernel.org/doc/Documentation/vm/overcommit-accounting" rel="nofollow ugc">https://www.kernel.org/doc/Documentation/vm/overcommit-accounting</a></p>
</div>
<ol class="children">
<li id="comment-605272" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/78de6d40deced98e3b91810596f23a0f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/78de6d40deced98e3b91810596f23a0f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">tdiff</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-11-05T20:26:30+00:00">November 5, 2021 at 8:26 pm</time></a> </div>
<div class="comment-content">
<p>Interestingly, it says &ldquo;Obvious overcommits of address space are refused.&rdquo; Does it mean we can observe malloc failure in this mode?</p>
</div>
</li>
</ol>
</li>
<li id="comment-603780" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/57cdedec80637e804b4d0593f01ebcfc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/57cdedec80637e804b4d0593f01ebcfc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alexander Adler</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-28T13:57:17+00:00">October 28, 2021 at 1:57 pm</time></a> </div>
<div class="comment-content">
<p>I tried on my box: If /proc/sys/vm/overcommit_memory is zero, the process exits cleanly with “error!”; if it is one, the process is terminated by the OOM killer after some time (my Laptop does not have 1T 😉</p>
<p>Normally, I have /proc/sys/vm/overcommit_memory set to zero. As the other Alex said, it is convenient for developing.</p>
</div>
</li>
<li id="comment-603784" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/30de1fbe4f575a8d8659dcd3fadbf632?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/30de1fbe4f575a8d8659dcd3fadbf632?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jakub</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-28T14:56:58+00:00">October 28, 2021 at 2:56 pm</time></a> </div>
<div class="comment-content">
<p>Recommend taking a look here for anyone who is interested in some more details about overcommit and OOM killer.</p>
</div>
<ol class="children">
<li id="comment-603874" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/30de1fbe4f575a8d8659dcd3fadbf632?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/30de1fbe4f575a8d8659dcd3fadbf632?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jakub</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-29T09:38:59+00:00">October 29, 2021 at 9:38 am</time></a> </div>
<div class="comment-content">
<p>Link got removed, pasting here again: <a href="https://www.win.tue.nl/~aeb/linux/lk/lk-9.html#ss9.6" rel="nofollow ugc">https://www.win.tue.nl/~aeb/linux/lk/lk-9.html#ss9.6</a></p>
</div>
</li>
</ol>
</li>
</ol>
