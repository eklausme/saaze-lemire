---
date: "2012-06-26 12:00:00"
title: "Which is fastest: read, fread, ifstream or mmap?"
index: false
---

[34 thoughts on &ldquo;Which is fastest: read, fread, ifstream or mmap?&rdquo;](/lemire/blog/2012/06-26-which-is-fastest-read-fread-ifstream-or-mmap)

<ol class="comment-list">
<li id="comment-55336" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/01e95e6cea74015d7c6231757b88dc4c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/01e95e6cea74015d7c6231757b88dc4c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Todd Lipcon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-26T12:39:06+00:00">June 26, 2012 at 12:39 pm</time></a> </div>
<div class="comment-content">
<p>Results on my code i7 laptop don&rsquo;t match up:</p>
<p>fread 52.8416 63.133<br/>
fread w sbuffer 53.9027 64.6808<br/>
fread w lbuffer 55.4619 63.2864<br/>
read2 73.746 49.1903<br/>
mmap 78.9516 84.0752<br/>
Cpp 54.5601 60.8912</p>
<p>(so mmap actually turns out to be fastest)</p>
<p>When I add MAP_POPULATE so as to prefault the pages, mmap gets even better:</p>
<p>fread 49.8951 58.354<br/>
fread w sbuffer 50.2688 60.7751<br/>
fread w lbuffer 52.6344 62.8038<br/>
read2 65.793 48.9292<br/>
mmap 106.522 106.855<br/>
Cpp 47.5949 59.6341</p>
<p>But your point stands that it&rsquo;s worth benchmarking these things.</p>
<p>-Todd</p>
</div>
</li>
<li id="comment-55337" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-26T12:42:12+00:00">June 26, 2012 at 12:42 pm</time></a> </div>
<div class="comment-content">
<p>Todd, did you mean &ldquo;mmap gets even WORSE&rdquo;? This is very-very strange, because in all tests that I have heard about mmap beats everything (by a wide margin). Assuming that you check with files &ldquo;warmed up&rdquo; and cached by the OS.</p>
</div>
</li>
<li id="comment-55338" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/01e95e6cea74015d7c6231757b88dc4c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/01e95e6cea74015d7c6231757b88dc4c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Todd Lipcon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-26T12:43:45+00:00">June 26, 2012 at 12:43 pm</time></a> </div>
<div class="comment-content">
<p>No, mmap gets better &#8211; higher numbers are better here, unless I&rsquo;m misreading the benchmark code.</p>
</div>
</li>
<li id="comment-55339" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b969cb7d681c2a7bd5cbb50a1bbc78b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b969cb7d681c2a7bd5cbb50a1bbc78b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Pierre Barbier de Reuille</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-26T12:45:38+00:00">June 26, 2012 at 12:45 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t really get why, but I also have a Intel iCore 7, and, like Todd, I find mmap to be the fastest on my machine. Here are the results:</p>
<p>fread 79.1329 82.2618<br/>
fread w sbuffer 81.6359 82.9706<br/>
fread w lbuffer 78.7614 82.0594<br/>
read2 73.0988 48.8926<br/>
mmap 93.9841 94.7367<br/>
Cpp 86.4751 79.8615</p>
<p>Now, I ran it on a Linux box using debian-testing. Also, like for Todd, adding MAP_POPULATE makes mmap quite faster:</p>
<p>fread 85.8116 82.6478<br/>
fread w sbuffer 79.5079 82.5918<br/>
fread w lbuffer 82.6412 79.6012<br/>
read2 70.0466 46.6896<br/>
mmap 110.734 125.265<br/>
Cpp 82.4382 76.3553</p>
<p>(and as you can see there&rsquo;s quite a bit of variations from one run to the next).</p>
<p>-Pierre</p>
</div>
</li>
<li id="comment-55340" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-26T13:00:02+00:00">June 26, 2012 at 1:00 pm</time></a> </div>
<div class="comment-content">
<p>That is correct, the little program reports the speed, so higher numbers are better.</p>
<p>I don&rsquo;t get better speed with mmap on any of my machines, but if you read the last paragraph of my blog post, I had expected people to get vastly different results.</p>
<p>Unfortunately, IO is difficult to benchmark reliably.</p>
<p>I have changed my program to use MAP_POPULATE. It does improve speed quite a bit, but even so, mmap is slower than fread on my machines.</p>
</div>
</li>
<li id="comment-55341" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/08273d5f7fe210be4bfcdd60b9b3fe09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/08273d5f7fe210be4bfcdd60b9b3fe09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">J. Andrew Rogers</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-26T13:00:41+00:00">June 26, 2012 at 1:00 pm</time></a> </div>
<div class="comment-content">
<p>The default policy of mmap() is pretty poor for reading large sequential streams because mmap() has no idea what your access pattern is going to be and conservatively straddles the fence on behavior by default. Defining the behavior and policy with madvise() to something other than default is important if performance matters.</p>
<p>This is one of those cases where setting madvise() to MADV_SEQUENTIAL|MADV_WILLNEED over the file should make a significant difference. In principle, mmap() with madvise() flags properly set should be as fast as any other mechanism since most other mechanisms are using something like this under the hood.</p>
<p>I am not sure it is apples-to-apples to modify the default buffering behavior of the fread() case but not altering the default access policy of mmap().</p>
</div>
</li>
<li id="comment-55342" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-26T13:20:29+00:00">June 26, 2012 at 1:20 pm</time></a> </div>
<div class="comment-content">
<p>@Rogers</p>
<p>Thanks. Even with these hints, I get that mmap is significantly slower. Here is what I get on my desktop:</p>
<p>$ ./ioaccess </p>
<p>fread 130.308 122.366<br/>
fread w sbuffer 119.837 122.812<br/>
fread w lbuffer 125.437 122.767<br/>
read2 104.045 71.4784<br/>
mmap 95.8698 43.1566<br/>
fancy mmap 96.5595 77.5446<br/>
Cpp 118.777 116.532</p>
<p>where fancy mmap is what I get with madvise.</p>
<p>Of course, there are variations from run to run, but mmap is never faster in my tests.</p>
<p>I&rsquo;m testing on a Linux destop and a mac laptop. I vary the GCC compiler version, for fun&#8230; but no luck. I always find that memory mapping is slower.</p>
<p>I should stress that another reason to worry about memory mapping is how quickly it can bring down your program. For production code, hard crashes should be a concern.</p>
</div>
</li>
<li id="comment-55343" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-26T13:55:30+00:00">June 26, 2012 at 1:55 pm</time></a> </div>
<div class="comment-content">
<p>Ohhh, I see. I (as usual) confuse milliseconds (MIs) and millions of integers per seconds (MIs).</p>
<p>My results actually do match those of Daniel (on Linux/CentOS) and mmap beats everything else, but a difference is small 10-20% (with and without MAP_POPULATE).</p>
<p>A more interesting scenario would be to re-use the same file many times and not to re-map the data.</p>
</div>
</li>
<li id="comment-55344" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f93ba8ea9c25121eed04596f62100474?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f93ba8ea9c25121eed04596f62100474?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tom</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-26T15:40:55+00:00">June 26, 2012 at 3:40 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m confused what you are trying to measure:</p>
<p>1) Speed of shuffling data from the buffer cache (i.e. memory) into the process namespace?<br/>
2) or speed of reading data from disk with the generic io scheduler though different interfaces (and therefore presumably different hints to the kernel reg. expected access patterns).</p>
<p>If the latter did everyone running the benchmark flush their buffer caches e.g. with [1]?</p>
<p>[1]<br/>
echo 3 &gt; /proc/sys/vm/drop_caches</p>
</div>
</li>
<li id="comment-55345" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d15f6825d09bb820ab62dcd3174723b1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d15f6825d09bb820ab62dcd3174723b1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Peter De Wachter</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-26T15:45:38+00:00">June 26, 2012 at 3:45 pm</time></a> </div>
<div class="comment-content">
<p>You&rsquo;re testing with a file in /tmp. I suspect there&rsquo;ll be a big difference between a tmpfs and a disk-based file system.</p>
</div>
</li>
<li id="comment-55346" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-26T16:41:42+00:00">June 26, 2012 at 4:41 pm</time></a> </div>
<div class="comment-content">
<p>@Tom </p>
<p>Because the file is so big, it is very unlikely that it resides in the buffer. This being said, the benchmark could be improved, that is why I post the source code on github.</p>
<p>@Peter </p>
<p><em>You&rsquo;re testing with a file in /tmp. I suspect there&rsquo;ll be a big difference between a tmpfs and a disk-based file system</em></p>
<p>On my machine, files in /tmp are on disk.</p>
</div>
</li>
<li id="comment-55347" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/84d677b103b07194ea53a55cf323523c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/84d677b103b07194ea53a55cf323523c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Rasterman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-26T18:48:18+00:00">June 26, 2012 at 6:48 pm</time></a> </div>
<div class="comment-content">
<p>Caches, filesystem, ioscheduler, device readahead settings (/sys/devices/&#8230;/readahead_kb) etc. heavily.</p>
<p> as for stability, unless you jump outside the mmaped memory bounds only one thing will crash you. Its not a segv. it&rsquo;s a sigbus. You get this when the.memory is validly mapped but can&rsquo;t be accessed. example when you get i/o errors on your disk. This can be handled via a sigbus signal handler. Map in a page of /dev/zero on the page with the problem, set a flag, and check this flag at least once per page read. 🙂 handle failure appropriately for your situation.</p>
</div>
</li>
<li id="comment-55348" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-26T19:07:54+00:00">June 26, 2012 at 7:07 pm</time></a> </div>
<div class="comment-content">
<p>fread 34.9852 37.3454<br/>
fread w sbuffer 33.3594 37.9046<br/>
fread w lbuffer 33.7706 38.4986<br/>
read2 54.0629 27.0563<br/>
mmap 35.7301 50.655<br/>
fancy mmap 36.2806 50.3316<br/>
Cpp 41.2026 39.5535</p>
<p>I got differing results on Centos 5.2. I suspect it&rsquo;s misreporting cpu times, as I would see large variations in cpu-based throughput, but similar wallclock speeds run-to-run.</p>
<p>There were a few questionable things in the loop, like a vector that isn&rsquo;t used, so I took it out and had minimal improvement. Changing to MAP_SHARED had about a 10% positive effect. </p>
<p>Linus made some comments here: <a href="http://lkml.indiana.edu/hypermail/linux/kernel/0004.0/0728.html" rel="nofollow ugc">http://lkml.indiana.edu/hypermail/linux/kernel/0004.0/0728.html</a></p>
<p>Single map-and-scan is probably the worst scenario :(.</p>
</div>
</li>
<li id="comment-55349" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dc64045b6e0d5f043fbac23203aff377?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dc64045b6e0d5f043fbac23203aff377?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Neoh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-26T21:16:54+00:00">June 26, 2012 at 9:16 pm</time></a> </div>
<div class="comment-content">
<p>I have a laptop with intel i7 and gcc4.7 too, on Fedora Linux:</p>
<p>fread 92.2916 91.798<br/>
fread w sbuffer 75.9051 75.531<br/>
fread w lbuffer 84.1882 83.7542<br/>
read2 42.3798 42.2044<br/>
mmap 99.2518 67.327<br/>
fancy mmap 90.0927 88.8752<br/>
mmap (shared) 89.4623 88.51<br/>
fancy mmap (shared) 101.197 100.393<br/>
Cpp 95.7135 95.232</p>
</div>
</li>
<li id="comment-55350" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d41ee6ea5eda5e7b851ef32d62229bf5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d41ee6ea5eda5e7b851ef32d62229bf5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">vicaya</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-26T23:26:33+00:00">June 26, 2012 at 11:26 pm</time></a> </div>
<div class="comment-content">
<p>i/o is highly kernel and device dependent. people should post kernel versions (mmap(2) has different code paths for readahead than read(2)) and disk models (mostly because they affect the device drivers being picked up) besides cpu and compiler.</p>
</div>
</li>
<li id="comment-55369" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6fb24afeb6ad6063932b1f5b3213abba?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6fb24afeb6ad6063932b1f5b3213abba?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cartesius</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-29T11:43:10+00:00">June 29, 2012 at 11:43 am</time></a> </div>
<div class="comment-content">
<p>Ubuntu 12.04, 3.2.0-26-generic, ext4</p>
<p>fread 91.1748 90.8086<br/>
fread w sbuffer 93.3305 93.0044<br/>
fread w lbuffer 94.3807 94.1626<br/>
read2 55.2302 55.0486<br/>
mmap 109.469 108.818<br/>
fancy mmap 108.408 107.583<br/>
mmap (shared) 109.469 108.861<br/>
fancy mmap (shared) 108.233 107.534<br/>
Cpp 100.909 100.607</p>
</div>
</li>
<li id="comment-55370" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6fb24afeb6ad6063932b1f5b3213abba?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6fb24afeb6ad6063932b1f5b3213abba?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cartesius</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-29T11:57:01+00:00">June 29, 2012 at 11:57 am</time></a> </div>
<div class="comment-content">
<p>Well, I&rsquo;ve tuned a little bit your read(2) implementation and here are my final numbers for the above mentioned architecture. Read(2) on the __proper__ sized buffer cannot be slower than fread.</p>
<p>fread 94.3807 94.0505<br/>
fread w sbuffer 94.3807 94.098<br/>
fread w lbuffer 94.5136 94.3137<br/>
read2 100.607 100.331<br/>
mmap 107.712 107.07<br/>
fancy mmap 106.515 105.687<br/>
mmap (shared) 107.54 107.07<br/>
fancy mmap (shared) 106.685 105.791<br/>
Cpp 95.4547 95.1243</p>
</div>
</li>
<li id="comment-55371" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6fb24afeb6ad6063932b1f5b3213abba?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6fb24afeb6ad6063932b1f5b3213abba?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cartesius</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-29T12:05:27+00:00">June 29, 2012 at 12:05 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,<br/>
sorry for three posts but after another tuning I finally have the expected results, that is, the read(2) and mmap(2) should provide pretty comparable results for this specific task. It was said that mmap is much better suited for repeated and random reading.<br/>
Here are my tuned results: 🙂</p>
<p>fread 93.3305 93.0661<br/>
fread w sbuffer 93.5909 93.226<br/>
fread w lbuffer 94.116 93.8494<br/>
read2 105.18 104.814<br/>
mmap 105.345 104.869<br/>
fancy mmap 104.687 104.045<br/>
mmap (shared) 105.51 104.924<br/>
fancy mmap (shared) 104.687 104.047<br/>
Cpp 100.456 100.151</p>
</div>
</li>
<li id="comment-55373" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/01cc07930d88f6f16a6dbaa6590942f4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/01cc07930d88f6f16a6dbaa6590942f4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">maxime caron</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-02T23:50:06+00:00">July 2, 2012 at 11:50 pm</time></a> </div>
<div class="comment-content">
<p>Cartesius : What kind of tuning did you do? Could you please share the information with us please!</p>
</div>
</li>
<li id="comment-55374" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6fb24afeb6ad6063932b1f5b3213abba?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6fb24afeb6ad6063932b1f5b3213abba?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cartesius</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-03T03:49:23+00:00">July 3, 2012 at 3:49 am</time></a> </div>
<div class="comment-content">
<p>Maxime: In testread:<br/>
1. I changed the for-cycle into while-cycle and changed the conditions != sizeof(&#8230;) which I guess are not correct because read(2) syscall can give you also a partial result. Definitely on network socket, maybe also on block device.<br/>
2. I removed the first read(2) in the cycle which slows down whole computation.<br/>
3. I read the blocksize in a bigger chunk of data.<br/>
4. All reads are performed with a fixed IO buffer of size, say 64kB, no repeated vector.resize calls.</p>
<p>And as I&rsquo;ve said, read(2) by definition, cannot be any slower for this kind of scenario.</p>
<p>And the results prove it.</p>
</div>
</li>
<li id="comment-55502" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6b34a2a81515583dc95e5c0809db06bb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6b34a2a81515583dc95e5c0809db06bb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.craig-wood.com/nick/" class="url" rel="ugc external nofollow">Nick Craig-Wood</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T15:52:11+00:00">July 24, 2012 at 3:52 pm</time></a> </div>
<div class="comment-content">
<p>As I&rsquo;m learning Go at the moment I converted the code here:</p>
<p> <a href="https://gist.github.com/3172562" rel="nofollow ugc">https://gist.github.com/3172562</a></p>
<p>Interestingly it runs at almost identical speed to the &ldquo;basic sum (C++-like)&rdquo; using gcc 4.6.3 and g++ -funroll-loops -O3 -o cumuls cumuls.cpp</p>
<p>Go&rsquo;s compiler isn&rsquo;t particularly well optimised at the moment but I thought it did OK here.</p>
</div>
</li>
<li id="comment-55506" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6fb24afeb6ad6063932b1f5b3213abba?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6fb24afeb6ad6063932b1f5b3213abba?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cartesius</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T15:57:29+00:00">July 24, 2012 at 3:57 pm</time></a> </div>
<div class="comment-content">
<p>Nick:<br/>
Good to know. But I guess that this particulary simple scenario isn&rsquo;t a tough job for compiler because I assume that Go uses many well-implemented library functions e.g. for I/O.</p>
</div>
</li>
<li id="comment-55516" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6b34a2a81515583dc95e5c0809db06bb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6b34a2a81515583dc95e5c0809db06bb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.craig-wood.com/nick/" class="url" rel="ugc external nofollow">Nick Craig-Wood</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-25T04:14:30+00:00">July 25, 2012 at 4:14 am</time></a> </div>
<div class="comment-content">
<p>Actually I rather stupidly posted that comment on the wrong blog post so please ignore!</p>
</div>
</li>
<li id="comment-56319" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">jg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-02T18:03:44+00:00">October 2, 2012 at 6:03 pm</time></a> </div>
<div class="comment-content">
<p>nmap</p>
<p>Intel pentium dual-core t2390<br/>
debian 6.0.5<br/>
gcc 4.4.5</p>
<p>fread 12.7745 12.7489<br/>
fread w sbuffer 12.8726 12.798<br/>
fread w lbuffer 12.7382 12.5046<br/>
read2 10.6465 10.5533<br/>
mmap 15.8191 15.7597<br/>
fancy mmap 15.849 15.7929<br/>
mmap (shared) 15.7931 15.4621<br/>
fancy mmap (shared) 15.6933 15.6158<br/>
Cpp 11.1488 11.0111</p>
<p>fread 12.8775 12.8624<br/>
fread w sbuffer 12.8676 12.8215<br/>
fread w lbuffer 12.6327 12.1366<br/>
read2 10.5345 10.4342<br/>
mmap 15.8602 15.8455<br/>
fancy mmap 15.8228 15.7794<br/>
mmap (shared) 15.6239 14.9385<br/>
fancy mmap (shared) 15.5227 15.3789<br/>
Cpp 11.1174 10.9043</p>
</div>
</li>
<li id="comment-71375" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3264104e169604df0e5ce994c6426e79?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3264104e169604df0e5ce994c6426e79?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jacek</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-02-05T06:55:28+00:00">February 5, 2013 at 6:55 am</time></a> </div>
<div class="comment-content">
<p>When reading from file with your own buffering you&rsquo;ve got 3 levels of buffering overall:<br/>
1. Your buffer.<br/>
2. glib buffer for files<br/>
3. Kernel buffer managing pages<br/>
And then you have a mmap function, which allows you directly read from pages avoiding glibc buffering.<br/>
Do you believe that when reading directly from low-level buffers, avoiding library and system calls plus various checks and then reading such small amounts of data is so slow?</p>
<p>The answer lies in the bad benchmark code, giving false results. Cartesius has already pointed some hints about read() fix. Another hint would be opening all files first, setting them buffering (setvbuf) to avoid allocating space by library. Another step would be just to get timings after files were opened plus using bigger buffers. With small amount of data to be read the obvious winner is mmap, but the situation can change with bigger buffers and sequential reading, which can be interesting experiment.</p>
</div>
</li>
<li id="comment-71431" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-02-05T09:52:11+00:00">February 5, 2013 at 9:52 am</time></a> </div>
<div class="comment-content">
<p>@Jacek</p>
<p><em>Do you believe that when reading directly from low-level buffers, avoiding library and system calls plus various checks and then reading such small amounts of data is so slow? (&#8230;) The answer lies in the bad benchmark code, giving false results. </em></p>
<p>It is one thing to claim that the benchmark is faulty, it is another to propose a better one. The latter action is much more useful.</p>
</div>
</li>
<li id="comment-265552" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8f8c34d9c0f5cc495f71e71439c41a22?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8f8c34d9c0f5cc495f71e71439c41a22?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Gary</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-11T18:01:37+00:00">January 11, 2017 at 6:01 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for the code. I ported this to Windows and tested on Windows 8 and got the following on a Lenovo T440 i5 4300U CPU, 2.494 Ghz, 2 cores, 4 logical processors, LITEONIT LCS-256M6S drive:</p>
<p>fread 12.6044 9.21667<br/>
fread w sbuffer 13.7111 9.64173<br/>
fread w lbuffer 13.9331 11.7859<br/>
read2 28.9731 21.0076<br/>
mmap 30.459 21.5386<br/>
Cpp 13.5171 9.56955</p>
<p>With read2 modified as Cartesius described and to read in 4K blocks. So not much benefit of mmap over read2.</p>
<p>We have a product that is crashing because of memory mapped IO and it&rsquo;s running out of memory. If it were a buffered read instead then virtual memory would allow the product to continue to run without issue. Because it is a rather large product, there are numerous places in the code with pointer arithmetic making, making changing from memory mapped IO time consuming. It sure would be nice to have a class that allows you to easily turn on/off memory mapped IO. 🙂</p>
</div>
<ol class="children">
<li id="comment-265566" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-11T19:46:07+00:00">January 11, 2017 at 7:46 pm</time></a> </div>
<div class="comment-content">
<p>Would you share your Visual Studio port?</p>
</div>
</li>
</ol>
</li>
<li id="comment-270000" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ba9d440995dfdc657661e6c4e7d6a4df?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ba9d440995dfdc657661e6c4e7d6a4df?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.nextpoint.se" class="url" rel="ugc external nofollow">arthur</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-06T17:41:48+00:00">February 6, 2017 at 5:41 pm</time></a> </div>
<div class="comment-content">
<p>If this is still interesting, some time while ago, I was interesting to find out how much shuffling data around between buffers affects different std C funcions (fgetc, fgets, fread). I found that fread with a bigger buffer (around 16k &#8211; 4xBUFSIZ on my machine) gave best results. I didn&rsquo;t compared with memory mapped files since I was just interested to see how much overhead is between user program and library buffers. I am not sure how good my benchmark is, I am just as an amateur, but post with code can be seen at: <a href="http://www.nextpoint.se/?p=540" rel="nofollow ugc">http://www.nextpoint.se/?p=540</a> .</p>
</div>
</li>
<li id="comment-298760" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/52eef6caacdad926ee6b6c243e7e0122?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/52eef6caacdad926ee6b6c243e7e0122?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Uni</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-15T14:05:38+00:00">March 15, 2018 at 2:05 pm</time></a> </div>
<div class="comment-content">
<p>An interesting fact: Intel compiler can boost the speed of mmap greatly.</p>
<p>On my i7-3770 machine with Ubuntu 17.10, using gcc 7.2.0, the best result is:<br/>
fread 119.978 119.982<br/>
fread w sbuffer 120.694 120.697<br/>
fread w lbuffer 120.729 120.733<br/>
read2 46.7633 46.7649<br/>
mmap 223.929 223.932<br/>
fancy mmap 223.969 223.972<br/>
mmap (shared) 223.779 223.783<br/>
fancy mmap (shared) 224.043 224.048<br/>
Cpp 145.988 145.99</p>
<p>Using Intel C++ compiler 18.0.1, the result is:<br/>
fread 88.4261 88.4285<br/>
fread w sbuffer 87.6551 87.6574<br/>
fread w lbuffer 87.7999 87.8023<br/>
read2 45.4239 45.4254<br/>
mmap 790.271 790.232<br/>
fancy mmap 790.274 790.274<br/>
mmap (shared) 790.195 790.197<br/>
fancy mmap (shared) 791.301 791.208<br/>
Cpp 148.785 148.789</p>
<p>Yes, mmap gained a nearly 4x speedup! I have verified on two other machines, they also reported at least 3x speedup.</p>
</div>
</li>
<li id="comment-310069" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dedf061ce2d5cbc2db3bc96789b47cae?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dedf061ce2d5cbc2db3bc96789b47cae?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">P Wilson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-23T13:58:28+00:00">June 23, 2018 at 1:58 pm</time></a> </div>
<div class="comment-content">
<p>So I have a lot of experience with mmap and unfortunately how fast it works is highly dependent on the OS and what bells or whistles you have installed. Years ago Digital Unix had a well deserved reputation for being the fastest mmap. It was (and no doubt still is) just blazing fast. In fact Unix in general tends to have high quality fast mmap implementations. When I moved to the Linux world it was like being kicked by a horse. Memory mapping was either poorly implemented or just plain missing! It has slowly improved over the years but still leaves a lot to be desired on many versions of Linux. Memory mapping on windows has generally been okay, but there again they have been working on it and it has improved over time. I wish I had numbers from a good Digital Unix machine to blow your minds with but alas I don&rsquo;t&#8230; sorry.</p>
</div>
</li>
<li id="comment-554362" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e5f291499f7668e3082407e409c10ede?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e5f291499f7668e3082407e409c10ede?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tarek</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-05T11:56:47+00:00">October 5, 2020 at 11:56 am</time></a> </div>
<div class="comment-content">
<p>Results for Nvidia Jetson AGX Xavier:</p>
<p><code>fread 26.994 26.900<br/>
fread w sbuffer 22.935 22.842<br/>
fread w lbuffer 22.966 22.877<br/>
read2 20.435 20.363<br/>
mmap 198.547 196.867<br/>
fancy mmap 195.653 193.653<br/>
mmap (shared) 192.842 191.358<br/>
fancy mmap (shared) 195.653 193.608<br/>
Cpp 27.730 27.624<br/>
</code></p>
</div>
</li>
<li id="comment-588504" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3224b3af341c64022b0a1bb24847eec6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3224b3af341c64022b0a1bb24847eec6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Konstantin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-26T18:17:35+00:00">June 26, 2021 at 6:17 pm</time></a> </div>
<div class="comment-content">
<p>It looks like under the hood glibc can switch you to mmap.</p>
<p><a href="https://sourceware.org/git/?p=glibc.git;a=blob;f=libio/iofopen.c;h=965d21cd978f3acb25ca23152993d9cac9f120e3;hb=HEAD#l36" rel="nofollow ugc">https://sourceware.org/git/?p=glibc.git;a=blob;f=libio/iofopen.c;h=965d21cd978f3acb25ca23152993d9cac9f120e3;hb=HEAD#l36</a></p>
</div>
</li>
<li id="comment-656612" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/53cc2c41ee79dd9f162e4439b3889a40?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/53cc2c41ee79dd9f162e4439b3889a40?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Robert Wishlaw</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-04T08:35:47+00:00">December 4, 2023 at 8:35 am</time></a> </div>
<div class="comment-content">
<p>Fedora 39<br/>
gcc version 13.2.1 20231011 (Red Hat 13.2.1-4)<br/>
Ryzen 9 5950x</p>
<p>fread 153.758 153.323</p>
<p>fread w sbuffer 159.076 158.646</p>
<p>fread w lbuffer 159.097 158.67</p>
<p>read2 61.7936 61.6302</p>
<p>mmap 387.872 386.8</p>
<p>fancy mmap 384.261 383.197</p>
<p>mmap (shared) 387.046 385.94</p>
<p>fancy mmap (shared) 383.397 382.336</p>
<p>Cpp 172.464 171.993</p>
<p>fread 156.403 155.976</p>
<p>fread w sbuffer 158.51 158.086</p>
<p>fread w lbuffer 159.517 159.092</p>
<p>read2 61.7716 61.6078</p>
<p>mmap 388.036 386.946</p>
<p>fancy mmap 384.697 383.622</p>
<p>mmap (shared) 388.152 387.082</p>
<p>fancy mmap (shared) 383.987 382.92</p>
<p>Cpp 172.267 171.796</p>
</div>
</li>
</ol>
