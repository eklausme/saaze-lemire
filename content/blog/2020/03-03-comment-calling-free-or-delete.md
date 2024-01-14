---
date: "2020-03-03 12:00:00"
title: "Will calling &#8220;free&#8221; or &#8220;delete&#8221; in C/C++ release the memory to the system?"
index: false
---

[15 thoughts on &ldquo;Will calling &#8220;free&#8221; or &#8220;delete&#8221; in C/C++ release the memory to the system?&rdquo;](/lemire/blog/2020/03-03-calling-free-or-delete)

<ol class="comment-list">
<li id="comment-493739" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b4610b92810b55bfee0be46cc2c11586?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b4610b92810b55bfee0be46cc2c11586?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Jeffrey W. Baker</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-03T20:52:17+00:00">March 3, 2020 at 8:52 pm</time></a> </div>
<div class="comment-content">
<p>This seems &#8230; expected? People who care about this are going to override operator new (with tcmalloc or whatever suits their needs) People who don’t override evidently don’t care. People who want to know how much space it takes to allocate their data structure would do well by using nallocx.</p>
</div>
<ol class="children">
<li id="comment-493740" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-03T20:54:50+00:00">March 3, 2020 at 8:54 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>This seems … expected?</p>
</blockquote>
<p>People who know about tcmalloc will find my blog post unsurprising, but they are not the market for this post.</p>
</div>
</li>
</ol>
</li>
<li id="comment-493746" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/38ff31ad4de6130c4ae384eef31ebe59?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/38ff31ad4de6130c4ae384eef31ebe59?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Albert</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-03T21:39:33+00:00">March 3, 2020 at 9:39 pm</time></a> </div>
<div class="comment-content">
<p>This behavior is not specific to tcmalloc: any heap allocator has liberty to pre-allocate; returning memory to the system after <em>free</em> is even more rare. So the answer to the question in the title is <strong>NO</strong> and an implication is that heap memory commonly gets over-committed to save on the number of system calls, as your analysis demonstrates.</p>
<p>Notably, <em>malloc</em> is not even a system call, <em>brk</em> is. So when a user process calls <em>malloc</em> there may be no expectatiosn whatsoever that the allocator turns around does the <em>setbrk</em>. Things can get weirder as the allocator may choose to <em>mmap</em> a page far away from the <em>brk</em> threshold instead. This common technique is commonly used when a large chunk of memory is requested.</p>
<p>IMO, your conclusion that</p>
<blockquote><p>
&#8230; there are ways to force the memory to be released to the<br/>
system, but you should not expect that it will do so by default.
</p></blockquote>
<p>is spot on. You are absolutely correct to assume that the memory usage cannot be calculated from the SIZEOF alone, even the page alignment is taken into consideration.</p>
</div>
</li>
<li id="comment-493751" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-03T22:27:47+00:00">March 3, 2020 at 10:27 pm</time></a> </div>
<div class="comment-content">
<p>GLIBC has several <a href="https://www.gnu.org/software/libc/manual/html_node/Memory-Allocation-Tunables.html#Memory-Allocation-Tunables" rel="nofollow ugc">tunables</a> which allow you to decide how much memory is overallocated, at which size mmap will be used, and how quickly freed memory is returned to the system.</p>
<p>If every malloc/free required a system call, programs would run 1000x slower! GLIBC even checks whether the current process is single-threaded and bypasses atomic instructions if so. It is much faster to check this flag on each call than to just use atomics even if uncontended.</p>
</div>
<ol class="children">
<li id="comment-493752" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-03T23:01:41+00:00">March 3, 2020 at 11:01 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for the great link.</p>
</div>
</li>
</ol>
</li>
<li id="comment-493753" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/71bf23e95c46d7f04f61c2d32045292f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/71bf23e95c46d7f04f61c2d32045292f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">primepie</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-03T23:06:18+00:00">March 3, 2020 at 11:06 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t think it makes sense to talk about this topic without discussing the malloc library being used. C++ has nothing to do with anything happening here. Same goes to the previous alloc related posts.</p>
</div>
<ol class="children">
<li id="comment-493755" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-03T23:34:40+00:00">March 3, 2020 at 11:34 pm</time></a> </div>
<div class="comment-content">
<p>Of course, the specific results will depend on many different factors, but my point here is that you cannot be certain that the memory will be returned to the system. This is a general statement that I can make without specifying the details of my system.</p>
</div>
<ol class="children">
<li id="comment-493764" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/71bf23e95c46d7f04f61c2d32045292f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/71bf23e95c46d7f04f61c2d32045292f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">primepie</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-04T01:31:20+00:00">March 4, 2020 at 1:31 am</time></a> </div>
<div class="comment-content">
<p>Agreed. Maybe highlighting how many C++ memory operations have nothing to do with C++ language per se but rather are highly influenced by the malloc library and OS features. This way the user learns directly what&rsquo;s influenced by the language and what&rsquo;s influenced by the environment.</p>
<p>P.S Your compression/optimization posts + your papers are amazing!</p>
</div>
<ol class="children">
<li id="comment-493865" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-04T13:13:58+00:00">March 4, 2020 at 1:13 pm</time></a> </div>
<div class="comment-content">
<p>In my view, this is part of the C++ language, in the sense that the C++ specification does not require that memory be given back to the system. So if we ever have this expectation, we are making unwarranted inference.</p>
<p>I&rsquo;d go so far as to say that when teaching C++ programming one should explicitly state that &ldquo;free&rdquo; does not release the memory to the system necessarily and that new and malloc may claim much more memory from the system that the code suggests.</p>
<p>This is similar to how people who learn Java should know about JIT compilation and garbage collection.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-493791" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/335f4863ad3e7c521d63e242ab2886e0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/335f4863ad3e7c521d63e242ab2886e0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Myers</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-04T06:00:22+00:00">March 4, 2020 at 6:00 am</time></a> </div>
<div class="comment-content">
<p>There are usually very sound reasons not to release memory back to the OS, paricularly in a multithreaded program. Each such release causes a &ldquo;TLB shootdown&rdquo;, in which threads on other cores are blocked while the cores&rsquo; &ldquo;translation lookaside buffers&rdquo;, caches of page mappings, are cleared, and further stalls as their entries are re-filled.</p>
<p>This is another reason to prefer single-threaded processes, which are less subject to such shootdowns, with less-coupled forms of parallelism.</p>
<p>Besides the TLB potholes, releasing memory means that the next time is requested, the OS is obliged to zero it before the process gets to see it again. Furthermore, each page will be marked read-only, causing a trap the first time it is touched, and then zeroed lazily.</p>
<p>As a result, freeing memory to the OS should only be essayed with the support of a great deal of measurement of the consequences.</p>
</div>
</li>
<li id="comment-493847" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">jld</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-04T11:59:24+00:00">March 4, 2020 at 11:59 am</time></a> </div>
<div class="comment-content">
<p>If the memory is <em>not necessarily</em> released why bother with the hassle (and the danger of dangling references) of an explicit free and not just use the Boehm-Demers-Weiser <a href="https://www.hboehm.info/gc/" rel="nofollow ugc">garbage collector</a>?<br/>
I have been using it for more than 10 years with no trouble.</p>
</div>
<ol class="children">
<li id="comment-493866" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-04T13:16:26+00:00">March 4, 2020 at 1:16 pm</time></a> </div>
<div class="comment-content">
<p>You are right that whether you use a garbage collector or not, you typically do not have a tight control on how much RAM your program is using.</p>
</div>
</li>
</ol>
</li>
<li id="comment-493938" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e0f213c930ecf2e9971cce6beb70688?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e0f213c930ecf2e9971cce6beb70688?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">PSS</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-05T03:57:48+00:00">March 5, 2020 at 3:57 am</time></a> </div>
<div class="comment-content">
<p>What happens if you allocate, free, allocate and then freeing the memory again?<br/>
Would be interested the results for your test program that allocated/freed 30,000kb. If it does this twice, does it end up using 31,000kb or 61,000kb?</p>
</div>
<ol class="children">
<li id="comment-493989" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-05T12:59:18+00:00">March 5, 2020 at 12:59 pm</time></a> </div>
<div class="comment-content">
<p>My program actually does precisely what you suggest. I run through a loop to make sure I get stable results.</p>
</div>
</li>
<li id="comment-494035" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-05T23:50:36+00:00">March 5, 2020 at 11:50 pm</time></a> </div>
<div class="comment-content">
<p>Any freed memory is used by subsequent allocations. So the memory is reused within the same application. It&rsquo;s just not aggressively returned to the system.</p>
<p>It is possible for freed memory to become fragmented. For example allocate 101 blocks of 32 bytes, do some work, then free all except for one randomly chosen block. There are 3200 bytes of free memory which can be reused. However if you now try to allocate a single block of 3200 bytes, it won&rsquo;t fit, so more memory is needed.</p>
<p>Most programs only use a few different block sizes, making such fragmentation in long running processes rare.</p>
</div>
</li>
</ol>
</li>
</ol>
