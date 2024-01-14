---
date: "2018-05-24 12:00:00"
title: "Graph algorithms and software prefetching"
index: false
---

[13 thoughts on &ldquo;Graph algorithms and software prefetching&rdquo;](/lemire/blog/2018/05-24-graph-algorithms-and-software-prefetching)

<ol class="comment-list">
<li id="comment-304829" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/36b37e6fddb33c8b4ecd9d09baf5c97f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/36b37e6fddb33c8b4ecd9d09baf5c97f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Semih Salihoglu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-24T20:57:01+00:00">May 24, 2018 at 8:57 pm</time></a> </div>
<div class="comment-content">
<p>Thanks Daniel for the post! Quite interesting to see this potential. An immediate thing to see is what happens on a non-random graph. The benefits might go down. The higher the randomness of connections, the more prefetching should help probably, because the cache locality of the regular (non-prefetching) traversal should be the worst when the connections are totally random. I should play around with your code myself.</p>
<p>There are several algorithmic and data structure-related optimizations for shortest path queries to speed up the vanilla BFS-based solution you started with. Most of the algorithmic and data-structure related optimizations are trying to address the same problem though: often batch graph computations are memory-bound. For example, there are smart ways of assigning node-IDS (e.g., according to a hilbert curve), the compressed sparse row format of storing the edges, or partitioning the neighbors of each node so that each partition fits in the lowest-level CPU caches. These optimizations do not change the total number of edges BFS will read but instead try to increase the CPU cache hit rate when reading the edges from the memory. There is also several algorithmic optimizations for the single-pair shortest-paths problem you took, i.e., when the query has a source and a destination. One well-understood one is to do a bidirectional BFS, one from the source and one from the vertex. This one for example directly decreases the number of edges BFSÂ reads.</p>
<p>I see these optimizations in publications and integrated into many graph processing software. However, I don&rsquo;t think prefetching-like processor-level optimizations are as well studied (nor integrated into systems I study), so work here would be quite interesting. I&rsquo;m curious which low-level optimizations are available that can enhance other existing optimizations.</p>
<p>Semih</p>
</div>
<ol class="children">
<li id="comment-304837" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-24T21:47:38+00:00">May 24, 2018 at 9:47 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>An immediate thing to see is what happens on a non-random graph. The benefits might go down.</p>
</blockquote>
<p>True. But I also expect that with larger graphs, larger gains are possible. Of course, the challenges also increase.</p>
<blockquote>
<p>The higher the randomness of connections, the more prefetching should help probably, because the cache locality of the regular (non-prefetching) traversal should be the worst when the connections are totally random. I should play around with your code myself.</p>
</blockquote>
<p>One definitively wants to use real graphs.</p>
<blockquote>
<p>There is also several algorithmic optimizations for the single-pair shortest-paths problem you took, i.e., when the query has a source and a destination. One well-understood one is to do a bidirectional BFS, one from the source and one from the vertex. This one for example directly decreases the number of edges BFS reads.</p>
</blockquote>
<p>I remembered this approach from our chat, but I deliberately went for something naive.</p>
<blockquote>
<p>However, I don&rsquo;t think prefetching-like processor-level optimizations are as well studied (nor integrated into systems I study), so work here would be quite interesting. I&rsquo;m curious which low-level optimizations are available that can enhance other existing optimizations.</p>
</blockquote>
<p>There is probably quite a bit of optimization possible above and beyond purely algorithmic gains. But it is probably not as simple as spraying prefetch instructions in the code (though, if done right, it might be better than nothing).</p>
</div>
</li>
</ol>
</li>
<li id="comment-304935" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5f841a89e555ea666567c9572b26c0e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5f841a89e555ea666567c9572b26c0e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Frank Tetzel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-25T13:30:55+00:00">May 25, 2018 at 1:30 pm</time></a> </div>
<div class="comment-content">
<p>One has to be very careful when using the word memory bound in a graph context as memory bound has two very different aspects. There is bandwidth bound and latency bound. Graph traversals like BFS are latency bound that is why prefetching helps. On the other hand, page rank is usually bandwidth bound.</p>
<p>I actually doubt that you can rewrite a graph traversal in such a way that current hardware prefetchers can help. They are optimized for sequential and strided accesses. The accesses of graph traversals are too irregular. As already mentioned CSR and node reordering can improve data locality.</p>
<p>Other proposals add a graph prefetcher in hardware.<br/>
<a href="http://www-dyn.cl.cam.ac.uk/~tmj32/wordpress/hardware-graph-prefetchers/" rel="nofollow ugc">http://www-dyn.cl.cam.ac.uk/~tmj32/wordpress/hardware-graph-prefetchers/</a></p>
</div>
<ol class="children">
<li id="comment-304949" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/36b37e6fddb33c8b4ecd9d09baf5c97f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/36b37e6fddb33c8b4ecd9d09baf5c97f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Semih Salihoglu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-25T16:38:39+00:00">May 25, 2018 at 4:38 pm</time></a> </div>
<div class="comment-content">
<p>This is an interesting point. Whether you&rsquo;d be latency or bandwidth bound, even in BFS, will depend on the implementation, specifically your parallelism. Say you have ten threads (say on a single core machine) running a parallel BFS from a single source to traverse a large graph, I would expect you&rsquo;ll be bandwidth bound. A single threaded implementation might be less bandwidth bound, so prefetchers here might help more. So, yes, if we were to parallelize Daniel&rsquo;s code, the benefits of prefetching will likely go down.</p>
</div>
<ol class="children">
<li id="comment-304951" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-25T16:57:07+00:00">May 25, 2018 at 4:57 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>So, yes, if we were to parallelize Daniel&rsquo;s code, the benefits of prefetching will likely go down.</p>
</blockquote>
<p>&#8230; with the caveat stated in my blog post that memory access is a shared resource on multicore systems&#8230;</p>
</div>
</li>
</ol>
</li>
<li id="comment-324702" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-29T20:57:37+00:00">July 29, 2018 at 8:57 pm</time></a> </div>
<div class="comment-content">
<p>Even the concepts of &ldquo;latency bound&rdquo; and &ldquo;bandwidth bound&rdquo; are a bit fuzzy when it comes to modern hardware. The DRAM configuration will have a certain maximum bandwidth which is a simple product of the data transfer size and rate (e.g., DDR4-2400) and number of memory channels. Maybe this is 50 GB/s on your system.</p>
<p>An algorithm that on given hardware would otherwise achieve more than 50 GB/s could definitely be called DRAM bandwith limited: you are exploiting the RAM bandwidth to its limits. In principle, a reduction in memory latency wouldn&rsquo;t help at all (but a RAM bandwidth increase would).</p>
<p>At the other end of the spectrum, you have a classic &ldquo;pointer chasing&rdquo; memory latency bound algorithm such as iterating through a linked list (assume the nodes are spread around randomly in memory so prefetching doesn&rsquo;t let you cheat the latency). This always has an MLP factor of 1 (exactly one outstanding request at any time). The performance of this algorithm is entirely dependent on the latency: if you cut the latency in half, the runtime is cut in half as well.</p>
<p>The latency bound algorithms as above are usually easy to identify statically by examining the data dependency graph: they are the ones where the address for any memory access depends on the result of the prior access (or as a relaxation some prior access). You aren&rsquo;t really restricted to MLP 1 algorithms either: consider simultaneously iterating from both ends of a doubly-linked list towards the center: this has an MLP of 2, but is still in some sense entirely latency bound: if you halve the latency you again halve the runtime.</p>
<p>We might then intuitively define bandwidth bound algorithms as those were memory accesses aren&rsquo;t serially dependent at all, i.e., &ldquo;infinite MLP&rdquo;. Essentially, that the memory addresses are calculable without involving prior memory accesses (i.e., in the data dependence graph, the memory access nodes are all accessible without passing through any other memory access nodes). A simple example is summing all the elements in an array, or a vector dot-product or whatever: all the addresses to load are calculable without any dependence on earlier loads.</p>
<p>Does the above definition of bandwidth limited algorithms line up with our earlier hardware based definition (an algorithm that is capable of saturating the DRAM interface)? Unfortunately not, at least for single-threaded algorithms on most modern x86 chips (and probably most other high performance chips, but I&rsquo;m not familiar with the details)!</p>
<p>Modern x86 chips have a limited number of buffers between the core and the memory subsystem. On Intel these are called (Line) Fill Buffers, in the literature they are more generically called MHSR (miss handling status registers). An MLP 1 algorithm will only ever use one of these at a time. An &ldquo;infinite MLP&rdquo; algorithm will probably fill all of them. There are a limited number of these buffers. The key observation is that on most chips, even if all of these buffers are filled, <em>the DRAM bandwidth cannot be reached</em>. Intel chips have 10 such buffers, so on a system with 90 ns memory latency, the maximum achievable bandwidth (ignoring prefetching) is 64 bytes/line * 10 LFBs / (90 ns/line) = ~7.1 GB/s. Yet modern CPUs have DRAM bandwidths of ~20-30 GB/s (dual channel) or 50-60 GB/s (quad channel). So it would take several copies of the above core working in parallel to hit the DRAM bandwidth limit.</p>
<p>So I would propose something like &ldquo;concurrency limited&rdquo; for algorithms which are limited by the number of outstanding requests at the core level, rather than the memory bandwidth.</p>
<p>One might argue that &ldquo;concurrency limited&rdquo; versus &ldquo;bandwidth limited&rdquo; is a distinction without a difference, but I think it matters. In particular, it implies that the maximum per-core bandwidth is actually directly dependent on the latency: if you cut the latency in half, your runtime is cut in half even for the apparently &ldquo;bandwidth limited&rdquo; algorithms: since the occupancy time of each request in the fill buffers is cut in half and so you get twice as much work done. That&rsquo;s very different than a truly DRAM bandwidth limited algorithm, where memory latency barely matters.</p>
<p>It also matters because it contradicts advice you&rsquo;ll often see: that parallelizing &ldquo;memory bandwidth bound&rdquo; algorithms by running them on multiple cores doesn&rsquo;t work since memory bandwidth is a shared resource. Well, the fill buffers are <em>not</em> shared resources, so concurrency-limited algorithms <em>do</em> scale when you add more cores, since you get more fill buffers and hence more parallel requests. Of course this scaling stops when you hit the bandwidth wall: then the parallel version of the algorithm becomes bandwidth limited (the MLP factor for each core stays the same at 10, but the observed latency, aka occupancy time increases so that the DRAM bandwith limit is respected).</p>
<p>So I think the most useful way to characterize an algorithm, independently of hardware is to evaluate its MLP factor (maximum theoretical MLP).</p>
<p>Then to apply this to specific hardware, and you determine the HMLP (hardware MLP factor &#8211; essentially the number of fill buffers) and then the actual MLP will be the lower of the algorithm MLP and the HMLP. In the case the algorithm MLP is lower than the HMLP we could call the algorithm &ldquo;latency bound&rdquo;. In the case that the algorithm MLP is larger than the HMLP, we then also compare the achieved core bandwidth at maximum HMLP (e.g., the ~7.1 GB/s figure calculated above) to the DRAM memory bandwidth figure. If the HMLP-implied bandwidth is lower (as it is on most x86 chips), we could call the algorithm &ldquo;concurrency limited&rdquo;, if it is larger we could call the algorithm &ldquo;RAM bandwidth limited&rdquo;. Note that this evaluation is hardware dependent: any algorithm with an MLP greater than 1 could fall into any of the three categories, depending on the hardware!</p>
<p>This gives the following intuitive &ldquo;litmus tests&rdquo; for the three categorizations, based on the effect of three hypothetical hardware changes (where &ldquo;Helps!&rdquo; means a direct proportional effect on runtime):</p>
<p>Decreasing memory latency.<br/>
Increasing fill buffer count.<br/>
Increasing RAM bandwidth.</p>
<p><strong>Latency Bound</strong></p>
<p>Helps!<br/>
Does nothing<br/>
Does nothing</p>
<p><strong>Concurrency Bound</strong></p>
<p>Helps!<br/>
Helps!<br/>
Does nothing</p>
<p><strong>RAM Bandwidth Bound</strong></p>
<p>Does nothing<br/>
Does nothing<br/>
Helps!</p>
<p>Of course, in practice you can never change (2) without a uarch change, and you can only limited changes to change (1) or (3) &#8211; but this is more a way to think about this stuff than a tuning guide.</p>
<p>Which brings me back to the point I originally wanted to make, but which took a long time to set up the prerequisites! It seems to be that BFS is not likely to be latency limited, unless the average out degree of your graph is very small (close to 1). On most graphs, BFS should be concurrency-limited: as long as the current horizon is at least as large as the HMLP you should get to full concurrency and hence be no more latency-limited than another single core algorithm.</p>
<p>Something like DFS seems more likely to be latency limited, since it is essentially a series of pointer-chasing like serially dependent loads (of course, a lot depends on the graph shape and especially on how the brach predictor ends up working on your graph).</p>
<p>I almost entirely ignored hardware prefetching in the above. I don&rsquo;t want to cover it fully because this is long enough, but briefly: prefetching complicates the above but doesn&rsquo;t change the core conclusions. Hardware prefetching can lead to an apparent increase in the number of fill buffers, but they are still limited. You basically then end up with two different types of &ldquo;concurrency limited&rdquo; algorithms: prefetch friendly and prefetch unfriendly: you can use the same basic framework to analyze them, but with different HMLP values.</p>
</div>
<ol class="children">
<li id="comment-324705" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-29T20:59:32+00:00">July 29, 2018 at 8:59 pm</time></a> </div>
<div class="comment-content">
<p>Those &ldquo;Helps!&rdquo; lists showed as numbered in the post preview, but not when I actually posted. Anyways, they line up 1,2,3 with the 3 litmus tests noted above (decreasing latency, increasing fill buffers, increasing RAM BW).</p>
</div>
</li>
<li id="comment-637443" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/47aa5496c9d7a5174580d209a02a3c8d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/47aa5496c9d7a5174580d209a02a3c8d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ting Ye</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-06-26T13:06:12+00:00">June 26, 2022 at 1:06 pm</time></a> </div>
<div class="comment-content">
<p>How many buffers hardware prefetcher has?</p>
</div>
</li>
</ol>
</li>
<li id="comment-405404" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b1b7dc4b18224efab9f7dd744b341a02?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b1b7dc4b18224efab9f7dd744b341a02?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Yongkee</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-06T23:05:25+00:00">May 6, 2019 at 11:05 pm</time></a> </div>
<div class="comment-content">
<p>I would agree in general BFS is bounded by latency while PR may be bounded by bandwidth, particularly as compared to BFS. However, it&rsquo;s often very hard to just simply say like that until it&rsquo;s mapped to real hardware to see how locality comes into play.</p>
<p>For example [REF], Pagerank on Intel SKX and Intel KNL exhibits very different behavior with a certain size of graph. If you take a look at Fig(3(a) and (b), would you still conclude that PR is memory bound even on KNL?</p>
<p>I think we should be careful even when we say it&rsquo;s memory bandwidth bounded, like Travis commented below.</p>
<p>[REF] <a href="http://heirman.net/papers/sc2018.pdf" rel="nofollow ugc">http://heirman.net/papers/sc2018.pdf</a></p>
</div>
</li>
<li id="comment-653084" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/00e37f775b9a40d339b82c1079ea5dc2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/00e37f775b9a40d339b82c1079ea5dc2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Axman6</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-19T06:47:24+00:00">July 19, 2023 at 6:47 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
They are optimized for sequential and strided accesses. The accesses of graph traversals are too irregular.
</p></blockquote>
<p>Based in my understanding, this is the opposite of what prefetch instructions exist for &#8211; CPUs are quite good at predicting sequential and strided accesses already, but aren&rsquo;t (and in many cases, can&rsquo;t be) good at predicting&#8230; unpredictable fetches. The reason CPUs include prefetch instructions is so that the software developer can give a hint to the CPU that something will be needed shortly, so it should opportunistically start loading it. BFS is exactly one of the data access patterns where CPUs will struggle to predict future loads, and happens to be quite common in garbage collectors.</p>
</div>
</li>
</ol>
</li>
<li id="comment-305596" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ccc29802f05112c73f8df6806b2cc110?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ccc29802f05112c73f8df6806b2cc110?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://yangxi.github.io" class="url" rel="ugc external nofollow">Xi Yang</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-28T21:56:35+00:00">May 28, 2018 at 9:56 pm</time></a> </div>
<div class="comment-content">
<p>GC is a similar problem, Effective Prefetch for Mark-Sweep Garbage Collection (<a href="http://users.cecs.anu.edu.au/~steveb/downloads/pdf/pf-ismm-2007.pdf" rel="nofollow ugc">http://users.cecs.anu.edu.au/~steveb/downloads/pdf/pf-ismm-2007.pdf</a>)</p>
</div>
<ol class="children">
<li id="comment-305601" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-28T22:14:13+00:00">May 28, 2018 at 10:14 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for the reference.</p>
</div>
</li>
<li id="comment-305883" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-29T20:14:56+00:00">May 29, 2018 at 8:14 pm</time></a> </div>
<div class="comment-content">
<p>There is prior work: <a href="https://engineering.purdue.edu/~vijay/papers/2004/gc.pdf" rel="nofollow">Software Prefetching for Mark-Sweep Garbage Collection</a> (2004).</p>
</div>
</li>
</ol>
</li>
</ol>
