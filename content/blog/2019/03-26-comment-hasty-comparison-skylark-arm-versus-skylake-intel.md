---
date: "2019-03-26 12:00:00"
title: "Hasty comparison: Skylark (ARM) versus Skylake (Intel)"
index: false
---

[18 thoughts on &ldquo;Hasty comparison: Skylark (ARM) versus Skylake (Intel)&rdquo;](/lemire/blog/2019/03-26-hasty-comparison-skylark-arm-versus-skylake-intel)

<ol class="comment-list">
<li id="comment-397550" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Cyril</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-27T08:19:17+00:00">March 27, 2019 at 8:19 am</time></a> </div>
<div class="comment-content">
<p>On my Haswell Macbook the results are closer to your results form Skylark.</p>
<p><code>create(): 16.143000 ms<br/>
bitset_count(b1): 1.414000 ms<br/>
iterate(b1): 5.797000 ms<br/>
iterate2(b1): 1.704000 ms<br/>
iterate3(b1): 3.577000 ms<br/>
iterateb(b1): 4.935000 ms<br/>
iterate2b(b1): 1.632000 ms<br/>
iterate3b(b1): 4.668000 ms<br/>
</code></p>
<p>And profiler shows, that most of the time is spent in bzero (which is part of realloc I suppose)</p>
<p><code>564.40 ms 100.0% 0 s lemirebenchmark (8498)<br/>
559.40 ms 99.1% 0 s start<br/>
559.20 ms 99.0% 276.80 ms main<br/>
207.50 ms 36.7% 60.50 ms create<br/>
138.90 ms 24.6% 138.90 ms _platform_bzero$VARIANT$Haswell<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-397583" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-27T12:09:06+00:00">March 27, 2019 at 12:09 pm</time></a> </div>
<div class="comment-content">
<p>Yes&#8230; memory allocations are slow and expensive under macOS compared to Linux. That&rsquo;s a software issue (evidently).</p>
<p>That&rsquo;s why I am not convinced that the relative weakness of the Skylark processor that I find is related to the processor. It might how memory allocations are implemented under Linux for ARM.</p>
</div>
<ol class="children">
<li id="comment-397671" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cyril</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-27T22:18:49+00:00">March 27, 2019 at 10:18 pm</time></a> </div>
<div class="comment-content">
<p>Yes, this looks like speed difference is in kernel mode page faults handling. Linux test on Ivy Bridge shows performance similar to Skylake.</p>
</div>
<ol class="children">
<li id="comment-397679" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-27T22:54:09+00:00">March 27, 2019 at 10:54 pm</time></a> </div>
<div class="comment-content">
<p>Further testing suggests that upgrading glibc might improve performance drastically.</p>
</div>
<ol class="children">
<li id="comment-397759" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cyril</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-28T10:03:35+00:00">March 28, 2019 at 10:03 am</time></a> </div>
<div class="comment-content">
<p>My test platform on CortexA53 have glibc 2.28 and Linux alarm 5.0.4-1-ARCH. Results:</p>
<p><code>create(): 45.415000 ms<br/>
bitset_count(b1): 8.408000 ms<br/>
iterate(b1): 25.324000 ms<br/>
iterate2(b1): 11.455000 ms<br/>
iterate3(b1): 30.555000 ms<br/>
iterateb(b1): 25.781000 ms<br/>
iterate2b(b1): 21.812000 ms<br/>
iterate3b(b1): 32.944000 ms<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-397781" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-28T13:11:05+00:00">March 28, 2019 at 1:11 pm</time></a> </div>
<div class="comment-content">
<p>I need to find a way to upgrade my glibc somehow to run my own tests.</p>
</div>
<ol class="children">
<li id="comment-397797" class="comment even depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jörn Engel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-28T17:11:27+00:00">March 28, 2019 at 5:11 pm</time></a> </div>
<div class="comment-content">
<p>People writing their own malloc love to compare against glibc malloc, because it is such an easy target to beat.</p>
<p>You can try LD_PRELOAD with jemalloc or tcmalloc.</p>
</div>
<ol class="children">
<li id="comment-397806" class="comment odd alt depth-8 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cyril</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-28T18:41:45+00:00">March 28, 2019 at 6:41 pm</time></a> </div>
<div class="comment-content">
<p>Probably kernel version is more important here, memset spends most time in kernel page fault function.</p>
</div>
<ol class="children">
<li id="comment-397811" class="comment byuser comment-author-lemire bypostauthor even depth-9 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-28T19:16:19+00:00">March 28, 2019 at 7:16 pm</time></a> </div>
<div class="comment-content">
<p>See my &ldquo;update 2&rdquo;. I was able to drastically improve speed by switching to a new memory allocation library.</p>
</div>
<ol class="children">
<li id="comment-397972" class="comment odd alt depth-10 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cyril</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-29T10:55:47+00:00">March 29, 2019 at 10:55 am</time></a> </div>
<div class="comment-content">
<p>Interesting. I tried to build with jmalloc on my CortexA53 and create test is slower, than with glibc:</p>
<p>45 ms for glibc vs 66 for jmalloc<br/>
Here is straces for both cases, syscalls used for memory allocations are different: <a href="https://gist.github.com/notorca/b8ab4ef1ef7780db8fa911b83aedac6f" rel="nofollow ugc">https://gist.github.com/notorca/b8ab4ef1ef7780db8fa911b83aedac6f</a></p>
</div>
</article>
</li>
<li id="comment-397988" class="comment byuser comment-author-lemire bypostauthor even depth-10">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-29T13:02:08+00:00">March 29, 2019 at 1:02 pm</time></a> </div>
<div class="comment-content">
<p>My own results are similar in the sense that jemalloc seems to issue many more system calls (which I find surprising):</p>
<p><a href="https://gist.github.com/lemire/7ca46ac9a28acce3f2654b9ce7a2350e" rel="nofollow ugc">https://gist.github.com/lemire/7ca46ac9a28acce3f2654b9ce7a2350e</a></p>
</div>
</article>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-397818" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b08f2b3abb369b2a2f161e1f490d4e13?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b08f2b3abb369b2a2f161e1f490d4e13?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ed Vielmetti</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-28T21:12:55+00:00">March 28, 2019 at 9:12 pm</time></a> </div>
<div class="comment-content">
<p>As I noted on Twitter, I think one way of getting more reproducible results is to use a container setup to make your dependencies more specific.</p>
</div>
<ol class="children">
<li id="comment-397828" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-28T21:45:40+00:00">March 28, 2019 at 9:45 pm</time></a> </div>
<div class="comment-content">
<p>Yes, you are probably right.</p>
</div>
</li>
</ol>
</li>
<li id="comment-398718" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f79a7909dfca0088f4fdc01f109f497e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f79a7909dfca0088f4fdc01f109f497e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Isaac Gouy</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-01T23:43:54+00:00">April 1, 2019 at 11:43 pm</time></a> </div>
<div class="comment-content">
<p>Seems like you may have removed <code>#pragma omp parallel for</code> from the mandelbrot program?</p>
<p>Some people are cross-checking your code against the benchmarks game website and becoming a little confused by that difference, so performance it may help to say in the blog post whatever you did or did not change.</p>
</div>
<ol class="children">
<li id="comment-398881" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-02T15:57:09+00:00">April 2, 2019 at 3:57 pm</time></a> </div>
<div class="comment-content">
<p>Isaac: <a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/03/26" rel="nofollow">my code is available</a>. You are correct that I did not go into the details, but I encourage you to review my code. It is implicit that the benchmarks are single-threaded. We are interested in the performance of each core, not of the whole system.</p>
</div>
</li>
</ol>
</li>
<li id="comment-400372" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-08T21:16:01+00:00">April 8, 2019 at 9:16 pm</time></a> </div>
<div class="comment-content">
<p>Yes, it&rsquo;s unfortunate that distros don&rsquo;t install an up to date GCC/GLIBC. Worse, both have many useless security features enabled which can severely impact performance. However it&rsquo;s relatively easy to build your own GCC and GLIBC, so that&rsquo;s what I strongly recommend for benchmarking. Use the newly built GCC for building GLIBC. You can statically link any application with GLIBC &#8211; this works without needing schroot/docker and avoids dynamic linking overheads.</p>
<p>GLIBC malloc has been improved significantly in the last few years: a fast-path was added for small block handling, and single-threaded paths avoid all atomic operations. I&rsquo;ve seen the latter speed up malloc intensive code like Binarytree by 3-5 times on some systems. Note GLIBC has a low level hack for x86 which <em>literally</em> jumps over the lock prefix byte of atomic instructions. So the gain is less on x86, but it avoids nasty predecode conflicts which appear expensive.</p>
</div>
<ol class="children">
<li id="comment-401760" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-15T16:48:34+00:00">April 15, 2019 at 4:48 pm</time></a> </div>
<div class="comment-content">
<p>Btw Just to add, binarytree shows sub 20 second results on an Arm server with a recent GLIBC. GLIBC is faster than Jemalloc on this benchmark.</p>
</div>
<ol class="children">
<li id="comment-401761" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-15T17:01:13+00:00">April 15, 2019 at 5:01 pm</time></a> </div>
<div class="comment-content">
<p><em>GLIBC is faster than Jemalloc on this benchmark.</em></p>
<p>That&rsquo;s good to know. My intuition is that, at least on Linux, the GCC stack has great memory allocation.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
