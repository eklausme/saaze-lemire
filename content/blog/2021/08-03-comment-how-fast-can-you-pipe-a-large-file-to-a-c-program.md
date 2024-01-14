---
date: "2021-08-03 12:00:00"
title: "How fast can you pipe a large file to a C++ program?"
index: false
---

[19 thoughts on &ldquo;How fast can you pipe a large file to a C++ program?&rdquo;](/lemire/blog/2021/08-03-how-fast-can-you-pipe-a-large-file-to-a-c-program)

<ol class="comment-list">
<li id="comment-593201" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/56417ba443b6bdc8244d40a687f1ce4c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/56417ba443b6bdc8244d40a687f1ce4c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Dave</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-03T17:49:56+00:00">August 3, 2021 at 5:49 pm</time></a> </div>
<div class="comment-content">
<p>Interestingly, if I switch from using std::cin to using fread(3) on stdin, I get speeds closer to 2.6 GB/s on my Intel MacBook Pro running Catalina. Using std::cin is extremely slow. Using read(2) instead of read is a tad faster.</p>
</div>
<ol class="children">
<li id="comment-593207" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-03T18:25:18+00:00">August 3, 2021 at 6:25 pm</time></a> </div>
<div class="comment-content">
<p>Verified. I have updated the blog post.</p>
</div>
<ol class="children">
<li id="comment-593228" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Arseny Kapoulkine</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-03T20:59:11+00:00">August 3, 2021 at 8:59 pm</time></a> </div>
<div class="comment-content">
<p>I would also recommend using <code>write</code> to maximize write throughput in case that&rsquo;s the new bottleneck (the overhead of iostream varies per platform but is almost always observably bad&#8230;)</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-593209" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b2eeb7feb4d0d538da215e2bc7b8ab2b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b2eeb7feb4d0d538da215e2bc7b8ab2b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mike Hurwitz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-03T18:52:10+00:00">August 3, 2021 at 6:52 pm</time></a> </div>
<div class="comment-content">
<p>I ran your tests and was able to average ~3GBps using <code>cpispeed</code>, though only 0.02GBps using pipespeed. The previous poster&rsquo;s comment seems appropriate.</p>
<p>I threw together a <a href="https://github.com/dangermike/pipetest" rel="nofollow ugc">quick test in Go</a> (my language of choice) to see what kind of throughput I could get. With 4MB buffers I was seeing ~3.9GBps without cleaning my environment at all (Chrome running, e tc.).</p>
<p>Just for fun, I also put <code>pv</code> between the emitter and collectors in both your tests and mine. I chose <code>pv</code> because it&rsquo;s a very common C-based tool that handles pipes. I saw a measurable but fairly slight drop in both benchmarks with <code>pv</code> in the middle. I guess that shows that <code>pv</code> is using one of the more efficient APIs rather than std::cin.</p>
</div>
<ol class="children">
<li id="comment-593210" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-03T18:56:20+00:00">August 3, 2021 at 6:56 pm</time></a> </div>
<div class="comment-content">
<p>I love your &lsquo;quick test in Go&rsquo;.</p>
</div>
</li>
</ol>
</li>
<li id="comment-593251" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e13cd2e4e1b0862870951e75b99f8680?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e13cd2e4e1b0862870951e75b99f8680?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://billywhizz.io" class="url" rel="ugc external nofollow">Andrew Johnston</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-03T23:46:09+00:00">August 3, 2021 at 11:46 pm</time></a> </div>
<div class="comment-content">
<p>yes. using system api is much faster! i did some experiments a while ago with javascript and you can achieve these same speeds too: <a href="https://just.billywhizz.io/blog/on-javascript-performance-02/" rel="nofollow ugc">https://just.billywhizz.io/blog/on-javascript-performance-02/</a>. the problem here is a lot of the time is being taken up by syscalls and the context switching into the kernel.</p>
<p>i think it would be possible to go (much) faster if we could do something entirely in userspace with, for example, io_uring on linux? <a href="https://unixism.net/loti/" rel="nofollow ugc">https://unixism.net/loti/</a></p>
</div>
</li>
<li id="comment-593289" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a750242db0e06a602a55054987a74f6d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a750242db0e06a602a55054987a74f6d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Attractive Chaos</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-04T03:44:04+00:00">August 4, 2021 at 3:44 am</time></a> </div>
<div class="comment-content">
<p>Have you tried to apply &ldquo;std::ios::sync_with_stdio(false);&rdquo;? See <a href="https://stackoverflow.com/a/9026594/" rel="nofollow ugc">https://stackoverflow.com/a/9026594/</a></p>
</div>
<ol class="children">
<li id="comment-593349" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-04T15:41:10+00:00">August 4, 2021 at 3:41 pm</time></a> </div>
<div class="comment-content">
<p>I do, please see source code in GitHub.</p>
</div>
</li>
</ol>
</li>
<li id="comment-593293" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f4ba0c9119010302832e1d129b38228b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f4ba0c9119010302832e1d129b38228b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://darkcoding.net" class="url" rel="ugc external nofollow">Graham King</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-04T04:48:49+00:00">August 4, 2021 at 4:48 am</time></a> </div>
<div class="comment-content">
<p>Interesting question, thanks!</p>
<p>I made a Rust version. I get about 5 or 6 GB/s on Linux (Fedora 34 on a Thinkpad T15). I can get over 7 GB/s piping straight into <code>pv</code> though, so my reader must be the bottleneck.</p>
<p><a href="https://gist.github.com/grahamking/a1bd00581fd15908338ee65f7937cbf1" rel="nofollow ugc">https://gist.github.com/grahamking/a1bd00581fd15908338ee65f7937cbf1</a></p>
</div>
</li>
<li id="comment-593313" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">me</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-04T08:14:30+00:00">August 4, 2021 at 8:14 am</time></a> </div>
<div class="comment-content">
<p>&ldquo;Plumbing&rdquo; sounds so much like waste.</p>
<p>But pipes were even used to send messages such as orders in a factory with quite some success: <a href="https://en.wikipedia.org/wiki/Pneumatic_tube" rel="nofollow ugc">https://en.wikipedia.org/wiki/Pneumatic_tube</a> and these would commonly be placed vertical.</p>
</div>
</li>
<li id="comment-593320" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e7796fa7ccd51deb0e80c4fd12e80e57?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e7796fa7ccd51deb0e80c4fd12e80e57?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alex</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-04T09:19:38+00:00">August 4, 2021 at 9:19 am</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t have mac with dev tools at hand to verify, but some versions of C++ standard library generate very inefficient code in debug.<br/>
I wonder if you will get better results by adding <code>-O</code> in there.</p>
</div>
</li>
<li id="comment-593332" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cfb6ad92f49861194ac6a0712ded6836?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cfb6ad92f49861194ac6a0712ded6836?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Florian Lemaitre</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-04T11:36:06+00:00">August 4, 2021 at 11:36 am</time></a> </div>
<div class="comment-content">
<p>At some point, I was using pipes to transfer a raw video stream from <code>raspividyuv</code> to my program, but the pipe throughput was too low to be processed in realtime.<br/>
So I tried replacing the pipe with a UNIX socket (replace <code>pipe</code> with <code>socketpair</code>) and the speedup was impressive: from 200 MB/s to 700 MB/s on a raspberry pi 3.</p>
<p>Apart from the code creating the &ldquo;pipe&rdquo; nothing was changed, and in particular, the reading and writing code were exactly the same.</p>
<p>This made me wondering: why a socket is faster than a pipe?</p>
</div>
</li>
<li id="comment-593359" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ad4ee71956de6520a70d92a93b0ad145?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ad4ee71956de6520a70d92a93b0ad145?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Antoine</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-04T17:10:06+00:00">August 4, 2021 at 5:10 pm</time></a> </div>
<div class="comment-content">
<p>This is probably the C++ IO APIs showing their inadequacy. Even using Python you can probably achieve more than that (sorry, I don&rsquo;t have a reproducer to submit :-)).</p>
</div>
</li>
<li id="comment-593370" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/66c2e280e1e94651b19c1f056212e716?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/66c2e280e1e94651b19c1f056212e716?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Element14</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-04T19:25:25+00:00">August 4, 2021 at 7:25 pm</time></a> </div>
<div class="comment-content">
<p>20 years ago when I was still in high school I dabbled in competitive programming a bit. Back when g++ was still version 3.x, it was a common pitfall to use #include for anything that involved heavy IO. Programs would literally run out of time just reading input.</p>
<p>It seems that in some implementations of iostream the issue is still here. At any rate there&rsquo;s too much &ldquo;magic&rdquo; in C++ standard library that using fread (or better yet just the posix read()) would give much more accurate results if one is trying to measure the performance of OS pipes.</p>
</div>
</li>
<li id="comment-593511" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/81c6c8040fc0263607edd05c09dacf6b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/81c6c8040fc0263607edd05c09dacf6b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Julian</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-05T12:05:43+00:00">August 5, 2021 at 12:05 pm</time></a> </div>
<div class="comment-content">
<p>By the way, since you&rsquo;re comparing with read(2) already, I notice that using vmsplice(2) on Linux immediately triples my results.</p>
</div>
</li>
<li id="comment-594048" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://blog.lbs.ca" class="url" rel="ugc external nofollow">Dominic Amann</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-09T16:52:44+00:00">August 9, 2021 at 4:52 pm</time></a> </div>
<div class="comment-content">
<p>I would be curious how the Windows pipe would compare. boost::system includes a simple pipe implementation that is cross platform for Windows and Linux.</p>
</div>
</li>
<li id="comment-594049" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://blog.lbs.ca" class="url" rel="ugc external nofollow">Dominic Amann</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-09T16:53:27+00:00">August 9, 2021 at 4:53 pm</time></a> </div>
<div class="comment-content">
<p>I would be curious how the Windows pipe would compare. boost::process includes a simple pipe implementation that is cross platform for Windows and Linux.</p>
</div>
</li>
<li id="comment-594361" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0d5a5c6e09634c94aecf1cc6f01115ca?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0d5a5c6e09634c94aecf1cc6f01115ca?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dmitry Ganyushin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-11T17:47:44+00:00">August 11, 2021 at 5:47 pm</time></a> </div>
<div class="comment-content">
<p>You probably should not send data like this in production anyway. Maybe the right way to send the data is to use some special libraries that allow you to stream data from one application to another. Maybe this library:<br/>
<a href="https://adios2.readthedocs.io/en/latest/engines/engines.html#sst-sustainable-staging-transport" rel="nofollow ugc">https://adios2.readthedocs.io/en/latest/engines/engines.html#sst-sustainable-staging-transport</a></p>
</div>
</li>
<li id="comment-595151" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6594974f5c35271105c5023d1c184f07?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6594974f5c35271105c5023d1c184f07?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ilya Popov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-18T18:35:09+00:00">August 18, 2021 at 6:35 pm</time></a> </div>
<div class="comment-content">
<p>This is a libc++ issue. On Ubuntu 21.04, when I compile with GCC 10.3, I get about 2.7-3.0 GB/s for both variants (cin and read). When I compile with Clang++ 11 using libstdc++, I get similar numbers. But when I compile with <code>clang++ -stdlib=libc++</code> I get those 0.1GB/s vs 2.5 GB/s numbers. So the problem is QoI of libc++.</p>
</div>
</li>
</ol>
