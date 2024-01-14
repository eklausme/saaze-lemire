---
date: "2020-01-17 12:00:00"
title: "Allocating large blocks of memory: bare-metal C++ speeds"
index: false
---

[7 thoughts on &ldquo;Allocating large blocks of memory: bare-metal C++ speeds&rdquo;](/lemire/blog/2020/01-17-allocating-large-blocks-of-memory-bare-metal-c-speeds)

<ol class="comment-list">
<li id="comment-486270" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Jörn Engel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-17T19:20:48+00:00">January 17, 2020 at 7:20 pm</time></a> </div>
<div class="comment-content">
<p>My best interpretation of the result is that they are dominated by the Linux kernel&rsquo;s mmap_sem. That lock protects all address space operations (mmap, munmap, mprotect, etc.) plus a few seemingly unrelated things. And importantly it is a reader-writer-lock. Mmap is considered a writer, so it will be single-threaded. Page fault is considered a reader, so you can fault in pages on all CPUs in parallel.</p>
<p>In the previous benchmark, you presumably ended up calling mmap with MAP_POPULATE, so the entire memory allocation was done in one large critical section. This benchmark presumably does not, so the kernel will only give you virtual memory without any actual memory backing things. Then your initialization loop is faulting pages in one-by-one.</p>
<p>Transparant huge pages should be faster once the page fault is handling 2MiB at a time, not 4kiB. Might take a while until this kicks in and you might get different results if the system has been running long enough for fragmentation to kick in. If you cannot find 512 contiguous small pages, you cannot create a huge page.</p>
<p>Back to the mmap_sem, your userspace code still looks single-threaded. But the kernel page fault handler can grab a free page and return, while another kernel thread on another CPU detects that the free page pool is getting low, runs the LRU list and creates new free pages. With careful profiling you might detect the kernel background work.</p>
<p>And if my theory is correct, you should get noticeably worse performance if you reboot with a single CPU and rerun the test.</p>
</div>
<ol class="children">
<li id="comment-486379" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-18T16:42:51+00:00">January 18, 2020 at 4:42 pm</time></a> </div>
<div class="comment-content">
<p>The difference is simply because of the huge overhead of trapping into the kernel to allocate and zero a page (and that overhead has increased due to all the security issues).</p>
<p>With huge pages the number of page faults reduces dramatically, so we&rsquo;re limited by the speed of memset. To improve performance various systems use a larger default pagesize: eg. iOS uses 16KB, and some AArch64 servers use 64KB.</p>
<p>Note pages are always cleared on a pagefault in Linux (even huge pages), unlike on Windows there is no background process which clears pages.</p>
</div>
</li>
</ol>
</li>
<li id="comment-486303" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/68ba2440d05f6c04300a8171c6e0015d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/68ba2440d05f6c04300a8171c6e0015d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Steffen Bauch</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-18T00:21:45+00:00">January 18, 2020 at 12:21 am</time></a> </div>
<div class="comment-content">
<p>Thank you for your nice article.</p>
<p>I performed some further experiments by tuning malloc parameters. <a href="https://www.gnu.org/software/libc/manual/html_node/Malloc-Tunable-Parameters.html" rel="nofollow ugc">https://www.gnu.org/software/libc/manual/html_node/Malloc-Tunable-Parameters.html</a></p>
<p>My Baseline</p>
<p><code> 65536 pages 256 MB calloc 92.287 ms 2.71 GB/s<br/>
65536 pages 256 MB new_and_touch 87.187 ms 2.87 GB/s<br/>
65536 pages 256 MB new_and_memset 106.538 ms 2.35 GB/s<br/>
65536 pages 256 MB new_and_value_init 188.074 ms 1.33 GB/s<br/>
65536 pages 256 MB new_and_value_init_nothrow 191.691 ms 1.30 GB/s<br/>
65536 pages 256 MB memset_existing_allocation 22.110 ms 11.31 GB/s<br/>
65536 pages 256 MB mempy_into_existing_allocation 32.831 ms 7.61 GB/s<br/>
65536 pages 256 MB mmap_populate 52.721 ms 4.74 GB/s<br/>
</code></p>
<p>With mallopt(M_MMAP_MAX, 0); results for 256 MB changed:</p>
<p><code> 65536 pages 256 MB calloc 92.635 ms 2.70 GB/s<br/>
65536 pages 256 MB new_and_touch 0.876 ms 285.44 GB/s<br/>
65536 pages 256 MB new_and_memset 22.872 ms 10.93 GB/s<br/>
65536 pages 256 MB new_and_value_init 186.411 ms 1.34 GB/s<br/>
65536 pages 256 MB new_and_value_init_nothrow 189.933 ms 1.32 GB/s<br/>
65536 pages 256 MB memset_existing_allocation 23.459 ms 10.66 GB/s<br/>
65536 pages 256 MB mempy_into_existing_allocation 33.645 ms 7.43 GB/s<br/>
65536 pages 256 MB mmap_populate 56.151 ms 4.45 GB/s<br/>
</code></p>
<p>Measurement values for larger allocations don&rsquo;t show this difference.</p>
<p>I wonder if there is some temporal influence between the different allocation methods.</p>
</div>
</li>
<li id="comment-486485" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2c1476a85776d9e0a4fff1ccaef52431?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2c1476a85776d9e0a4fff1ccaef52431?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">F R</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-19T14:54:04+00:00">January 19, 2020 at 2:54 pm</time></a> </div>
<div class="comment-content">
<p>If you compare the code generated by the compiler in -O2 vs -O3 (<a href="https://godbolt.org/z/t2ifR7" rel="nofollow ugc">https://godbolt.org/z/t2ifR7</a>) you can see why -O2 lacks a bit in the speed department:</p>
<p>-O2: Writes one byte element at a time</p>
<p>-O3: Writes a qword worth of elements at a time (similar to what an optimized memset() would do)</p>
</div>
<ol class="children">
<li id="comment-487104" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-21T20:40:02+00:00">January 21, 2020 at 8:40 pm</time></a> </div>
<div class="comment-content">
<p>Yes that&rsquo;s a GCC bug &#8211; GCC9.2 still gets it wrong, but it works as expected on GCC10 trunk. It&rsquo;s never a good idea to emit a simple byte loop.</p>
</div>
</li>
</ol>
</li>
<li id="comment-486737" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4c27ac75da9840a8e08583c516635ef4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4c27ac75da9840a8e08583c516635ef4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Theophilos Pisokas</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-20T09:55:52+00:00">January 20, 2020 at 9:55 am</time></a> </div>
<div class="comment-content">
<p>I have trouble reproducing the results. I am using Ubuntu 18.04, Piledriver processor, GNU gcc 8.3.1.</p>
<p><code>$ ./alloc<br/>
131072 pages 512 MB new_and_touch 216.895 ms 2.31 GB/s<br/>
131072 pages 512 MB memset_existing_allocation 91.879 ms 5.44 GB/s<br/>
$ sudo ./run_with_huge_pages.sh ./alloc<br/>
131072 pages 512 MB new_and_touch 107.466 ms 4.65 GB/s<br/>
131072 pages 512 MB memset_existing_allocation 94.135 ms 5.31 GB/s<br/>
</code></p>
<p>I got similar results (i.e. no speed increase) with gcc 7.4.0, and on a Kaby Lake with Fedora 29 and gcc 8.3.1. Could you please help me out on this?</p>
</div>
<ol class="children">
<li id="comment-487093" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-21T17:39:30+00:00">January 21, 2020 at 5:39 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t think it is possible for memset to be that slow. Something is off in your results.</p>
</div>
</li>
</ol>
</li>
</ol>
