---
date: "2020-01-14 12:00:00"
title: "How fast can you allocate a large block of memory in C++?"
index: false
---

[22 thoughts on &ldquo;How fast can you allocate a large block of memory in C++?&rdquo;](/lemire/blog/2020/01-14-how-fast-can-you-allocate-a-large-block-of-memory-in-c)

<ol class="comment-list">
<li id="comment-485575" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b4610b92810b55bfee0be46cc2c11586?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b4610b92810b55bfee0be46cc2c11586?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Jeffrey W. Baker</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-14T16:58:04+00:00">January 14, 2020 at 4:58 pm</time></a> </div>
<div class="comment-content">
<p>What about an actual huge page allocated with mmap instead of operator new? And what’s the allocator under test in your table?</p>
</div>
<ol class="children">
<li id="comment-485576" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-14T17:04:53+00:00">January 14, 2020 at 5:04 pm</time></a> </div>
<div class="comment-content">
<p><em>And what’s the allocator under test in your table?</em></p>
<p>I am using GNU GCC 8.3 under Ubuntu 16.04.6.</p>
</div>
</li>
</ol>
</li>
<li id="comment-485579" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/609b16e9fe24dc905fdb9e4f7114197a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/609b16e9fe24dc905fdb9e4f7114197a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wayne Scott</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-14T17:14:33+00:00">January 14, 2020 at 5:14 pm</time></a> </div>
<div class="comment-content">
<p>In theory, a malloc library could cheat for calloc() and allocate the same read-only zero 4k page for every page in the region. And then still defer allocation for the first real write.</p>
</div>
<ol class="children">
<li id="comment-485582" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9fab95d1172eaf8a52b1b424526ee29c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9fab95d1172eaf8a52b1b424526ee29c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Gil</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-14T17:41:03+00:00">January 14, 2020 at 5:41 pm</time></a> </div>
<div class="comment-content">
<p>Not a theory. OS X has deferred zeroing each page as long as I can remember: <a href="https://developer.apple.com/library/archive/documentation/Performance/Conceptual/ManagingMemory/Articles/MemoryAlloc.html" rel="nofollow ugc">https://developer.apple.com/library/archive/documentation/Performance/Conceptual/ManagingMemory/Articles/MemoryAlloc.html</a></p>
</div>
<ol class="children">
<li id="comment-485600" class="comment byuser comment-author-lemire bypostauthor even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-14T18:35:41+00:00">January 14, 2020 at 6:35 pm</time></a> </div>
<div class="comment-content">
<p>I am have a mac, and if it did what I think Wayne means, it could achieve seemingly impossible speeds on my benchmark&#8230; yet it is no faster than my Linux box.</p>
</div>
<ol class="children">
<li id="comment-485603" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/609b16e9fe24dc905fdb9e4f7114197a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/609b16e9fe24dc905fdb9e4f7114197a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wayne Scott</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-14T18:50:59+00:00">January 14, 2020 at 6:50 pm</time></a> </div>
<div class="comment-content">
<p>That is why I said calloc() instead of a C++ constructor for a char. I am not surprised that libstd++ doesn&rsquo;t specialize initialization to call calloc() in this case.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-485588" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-14T17:49:30+00:00">January 14, 2020 at 5:49 pm</time></a> </div>
<div class="comment-content">
<p>Yes, it could. My benchmark should be viewed as a lower bound. It is yet possible that the system is cheating in all sorts of fun ways.</p>
</div>
</li>
</ol>
</li>
<li id="comment-485584" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0364e19483896e0390d56507a829469c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0364e19483896e0390d56507a829469c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://extensa.tech" class="url" rel="ugc external nofollow">Franek Korta</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-14T17:45:30+00:00">January 14, 2020 at 5:45 pm</time></a> </div>
<div class="comment-content">
<p>Possibly it can be faster if allocation is done normal way, without initialisation, but later you just “touch” each page (4K or 2M). Touching can also be parallelised which improves performance (tested that some time ago)</p>
</div>
<ol class="children">
<li id="comment-485592" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-14T17:59:47+00:00">January 14, 2020 at 5:59 pm</time></a> </div>
<div class="comment-content">
<p>You are correct, allocating and then touching is faster in my tests.</p>
</div>
</li>
</ol>
</li>
<li id="comment-485602" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/01822efaf66e4b81d6f947cba7e0613a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/01822efaf66e4b81d6f947cba7e0613a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-14T18:42:16+00:00">January 14, 2020 at 6:42 pm</time></a> </div>
<div class="comment-content">
<p>It is much more basic to allocate memory on the stack instead of the heap. I would expect it to be much faster to allocate since you are just bumping a stack pointer. You will have to increase the maximum stack size though.</p>
</div>
<ol class="children">
<li id="comment-485641" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ef8df2187ebb0e7d66510151c17696c0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ef8df2187ebb0e7d66510151c17696c0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">jbn</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-14T21:56:00+00:00">January 14, 2020 at 9:56 pm</time></a> </div>
<div class="comment-content">
<p>good luck allocating 512MB on the stack (I doubt it would be allowed OOTB on Linux, but i&rsquo;d love to be proven wrong&#8230;) !</p>
</div>
</li>
</ol>
</li>
<li id="comment-485642" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e7387a2ec3ad44a1559f3efd513b85bc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e7387a2ec3ad44a1559f3efd513b85bc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dato</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-14T22:09:37+00:00">January 14, 2020 at 10:09 pm</time></a> </div>
<div class="comment-content">
<p>These are two other possibilities that you could have tested (I was expecting them, in fact), and that come closest to each other:</p>
<p><code>// malloc + memset (7.7 GB/s)<br/>
char *buf1 = (char*)malloc(s);<br/>
memset(buf1, 0, s);<br/>
</code></p>
<p>and:</p>
<p><code>// new char[s] + memset (9.4 GB/s)<br/>
char *buf1 = new char[s];<br/>
memset(buf1, 0, s);<br/>
</code></p>
<p>(It is difficult to outperform calloc because the zeroing will be done by the kernel, I guess.)</p>
</div>
</li>
<li id="comment-485656" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d4f2926c49ea1ae794c7d394b0ef10e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d4f2926c49ea1ae794c7d394b0ef10e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">A Panicek</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-14T23:49:33+00:00">January 14, 2020 at 11:49 pm</time></a> </div>
<div class="comment-content">
<p>Is this a reason why redis recommends to turn off THP?</p>
</div>
</li>
<li id="comment-485751" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24ea4c3a3eb95dee6222215087f5884c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24ea4c3a3eb95dee6222215087f5884c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Oliver Schönrock</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-15T12:11:24+00:00">January 15, 2020 at 12:11 pm</time></a> </div>
<div class="comment-content">
<p>cleaned code via github pull request and comments here:</p>
<p><a href="https://www.reddit.com/r/cpp/comments/eoq6ly/how_fast_can_you_allocate_a_large_block_of_memory/fegce62/" rel="nofollow ugc">https://www.reddit.com/r/cpp/comments/eoq6ly/how_fast_can_you_allocate_a_large_block_of_memory/fegce62/</a></p>
</div>
</li>
<li id="comment-485785" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1dce13820f5be5cc1bf5594aa02b980b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1dce13820f5be5cc1bf5594aa02b980b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ben</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-15T17:14:16+00:00">January 15, 2020 at 5:14 pm</time></a> </div>
<div class="comment-content">
<p>Why not interleave allocation and initialization ?<br/>
E.g. you request a large block, but the allocator call (you&rsquo;d need to write a custom allocator) would block on the first page, not the entire request.<br/>
E.g. in the background you would use the overcommit usage of the default allocator, then start async init of the pages and return access as each is completed.</p>
<p>Alternatively if you know your memory usage pattern an arena allocator could work faster here for you (think zero on delete).</p>
</div>
<ol class="children">
<li id="comment-485788" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-15T17:19:00+00:00">January 15, 2020 at 5:19 pm</time></a> </div>
<div class="comment-content">
<p>@Ben</p>
<p>The pages have to come from the operating system. If you are getting pages at 3 GB/s and your program needs 30 GB of memory, it is going to take 10 seconds. Writing a custom allocator is not going to solve this problem.</p>
</div>
<ol class="children">
<li id="comment-485789" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1dce13820f5be5cc1bf5594aa02b980b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1dce13820f5be5cc1bf5594aa02b980b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ben</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-15T17:23:21+00:00">January 15, 2020 at 5:23 pm</time></a> </div>
<div class="comment-content">
<p>I understand, I think I misunderstood the way the OS releases the pages.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-485862" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8c7b799ecee1cb14e596162ce3dd17de?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8c7b799ecee1cb14e596162ce3dd17de?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://rsaxvc.net" class="url" rel="ugc external nofollow">rsaxvc</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-16T06:19:28+00:00">January 16, 2020 at 6:19 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
You might wonder why the memory needs to be initialized&#8230;
</p></blockquote>
<p>Linux supports page allocation without erasing previous contents as a kernel config somewhere. It would be interesting to compare allocation speed with and without it.</p>
</div>
<ol class="children">
<li id="comment-485870" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8c7b799ecee1cb14e596162ce3dd17de?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8c7b799ecee1cb14e596162ce3dd17de?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://rsaxvc.net" class="url" rel="ugc external nofollow">rsaxvc</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-16T06:58:16+00:00">January 16, 2020 at 6:58 am</time></a> </div>
<div class="comment-content">
<p>Oh, it&rsquo;s only for no-MMU systems:</p>
<p><a href="https://cateee.net/lkddb/web-lkddb/MMAP_ALLOW_UNINITIALIZED.html" rel="nofollow ugc">https://cateee.net/lkddb/web-lkddb/MMAP_ALLOW_UNINITIALIZED.html</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-485938" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-16T17:23:39+00:00">January 16, 2020 at 5:23 pm</time></a> </div>
<div class="comment-content">
<p>You are probably not getting huge pages, or few of them.</p>
<p>To get hugepages you have go jump through more hoops, e.g., allocate to a 2 MiB boundary, and do madvise on the memory before touching it. You can use mmap directly or one of the aligned allocators.</p>
<p>Better, you can check to see if you got huge pages: I wrote <a href="https://github.com/travisdowns/page-info" rel="nofollow ugc">page-info</a> to do that, integrating it is fairly easy (you can find integrations in some of our shared projects, including how to jump through the aforementioned hoops). Note that it only works on Linux.</p>
</div>
</li>
<li id="comment-589195" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/90d545c6b737634ae230e15315ef97e2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/90d545c6b737634ae230e15315ef97e2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Yurii Hordiienko</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-03T17:33:35+00:00">July 3, 2021 at 5:33 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
char *buf = new char<a href rel="nofollow ugc">s</a>;
</p></blockquote>
<p>For this and similar, like std::string* p = new std::string<a href rel="nofollow ugc">10</a>, compiler just generates a code to call memset for whole area before of actual construction (ctor call) each object.</p>
</div>
<ol class="children">
<li id="comment-589196" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-03T17:49:07+00:00">July 3, 2021 at 5:49 pm</time></a> </div>
<div class="comment-content">
<p>Maybe you refer to this C++ construction (link to the source code accompanying the post):</p>
<p><a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/9f197e799e3481b523f1c13943d54c2bdccb1881/2020/01/14/alloc.cpp#L124" rel="nofollow ugc">https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/9f197e799e3481b523f1c13943d54c2bdccb1881/2020/01/14/alloc.cpp#L124</a></p>
</div>
</li>
</ol>
</li>
</ol>
