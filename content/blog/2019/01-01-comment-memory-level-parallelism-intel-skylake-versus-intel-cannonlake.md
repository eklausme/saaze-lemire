---
date: "2019-01-01 12:00:00"
title: "Memory-level parallelism: Intel Skylake versus Intel Cannonlake"
index: false
---

[8 thoughts on &ldquo;Memory-level parallelism: Intel Skylake versus Intel Cannonlake&rdquo;](/lemire/blog/2019/01-01-memory-level-parallelism-intel-skylake-versus-intel-cannonlake)

<ol class="comment-list">
<li id="comment-377966" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9cd0a4e9fca4e9a07e5c107b13b1c0ce?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9cd0a4e9fca4e9a07e5c107b13b1c0ce?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">bizude</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-01T22:12:41+00:00">January 1, 2019 at 10:12 pm</time></a> </div>
<div class="comment-content">
<p>What Skylake CPU was tested? What RAM types were used in both systems? Asking for /r/Intel</p>
</div>
<ol class="children">
<li id="comment-377969" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-01T22:18:37+00:00">January 1, 2019 at 10:18 pm</time></a> </div>
<div class="comment-content">
<p><em>What Skylake CPU was tested?</em></p>
<p>The Skylake microarchitecture is the last one we have had in a long time. All the recent Intel processors are based on Skylake.</p>
<p><em>What RAM types were used in both systems?</em></p>
<p>The skylake box has DDR4 (2133 MHz), the cannonlake box has LPDDR4 (3200 MT/s).</p>
</div>
</li>
</ol>
</li>
<li id="comment-378036" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9cd0a4e9fca4e9a07e5c107b13b1c0ce?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9cd0a4e9fca4e9a07e5c107b13b1c0ce?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">bizude</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-02T02:43:46+00:00">January 2, 2019 at 2:43 am</time></a> </div>
<div class="comment-content">
<p><em>The skylake box has DDR4 (2133 MHz), the cannonlake box has LPDDR4 (3200 MT/s).</em></p>
<p>Is there any way you could test using the same memory types? I would imagine that the bus differences, etc. between lpddr4 &amp; desktop DDR4 could account for the latency difference.</p>
</div>
</li>
<li id="comment-378080" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9cd0a4e9fca4e9a07e5c107b13b1c0ce?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9cd0a4e9fca4e9a07e5c107b13b1c0ce?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">bizude</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-02T05:45:36+00:00">January 2, 2019 at 5:45 am</time></a> </div>
<div class="comment-content">
<p>I just realized Skylake doesn&rsquo;t support LPDDR4 and Cannonlake doesn&rsquo;t support normal DDR4. Welp, I guess we&rsquo;ll be waiting for Sunny Cove before my question is answered.</p>
</div>
</li>
<li id="comment-378189" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/661badf0b33ddf581cbccbd7a87795c1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/661badf0b33ddf581cbccbd7a87795c1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">John</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-02T11:59:43+00:00">January 2, 2019 at 11:59 am</time></a> </div>
<div class="comment-content">
<p>It the bioses allow you can still set bandwidth and latency #s to the same to get a more equal comparison. Lp vs non lp doesn&rsquo;t really matter ..</p>
</div>
</li>
<li id="comment-378514" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3d540ddabdd3013d67723b76e340b0a0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3d540ddabdd3013d67723b76e340b0a0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Carl Nettelblad</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-03T11:27:26+00:00">January 3, 2019 at 11:27 am</time></a> </div>
<div class="comment-content">
<p>I went back to your previous stories, but it doesn&rsquo;t seem this is addressed conclusively. Do you believe this is a feature of the core, or the memory controller? I guess mainly the core at these levels, but it would for sure be interesting to know when one would saturate the higher core count Xeons for the pathological cases of essentially random accesses into very large data structures. My empirical results on a &ldquo;real&rdquo; application so far indicate huge benefits from prefetching, huge pages and hyperthreading combined, but I would guess the code in practice maybe is able to maintain 2-4 actual independent lanes per core in this config.</p>
</div>
<ol class="children">
<li id="comment-378534" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-03T13:02:24+00:00">January 3, 2019 at 1:02 pm</time></a> </div>
<div class="comment-content">
<p>The number of outstanding requests is a feature of the processor.</p>
</div>
</li>
<li id="comment-378984" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-04T19:56:16+00:00">January 4, 2019 at 7:56 pm</time></a> </div>
<div class="comment-content">
<p>The short answer is &ldquo;all of the above&rdquo;.</p>
<p>All parts of the path to memory play a part in the observed parallelism.</p>
<p>For example, the core itself must have some number of &ldquo;miss handling registers&rdquo; to support multiple outstanding misses in L1 &#8211; otherwise, there could be no parallelism at the core level.</p>
<p>Further along the path, the &ldquo;uncore&rdquo;, memory controller and DRAM itself support varying degrees of parallelism, all of which interact to produce the observed parallelism in this type of benchmark and also of course for real world code.</p>
<p>Note that the parallelism isn&rsquo;t simply the part of the path that itself supports the smallest parallel factor &#8211; it&rsquo;s more complicated than that, since each part of the path has a different &ldquo;occupancy time&rdquo; &#8211; the shorter the time, the lower the required parallelism for a given occupancy level. For example, DRAM itself has fairly low intrinsic parallelism: after all, at the physical level there is only a single set of address and data busses etched on the motherboard per memory channel, and at most one thing can be passing over those busses at any given moment. Even there, however, you have a type of parallelism inside the DRAM chips which can have multiple open <em>pages</em> and accessing an open page is faster than a closed one.</p>
<p>Backing up to the memory controller, these generally support many parallel requests. I don&rsquo;t have an exact figure, but manuals for older Xeons indicated 32 requests per controller and I don&rsquo;t think that figure has gotten any smaller. At the memory controller level parallelism helps in two ways: (1) the obvious way, which is the same for other parts of the path to memory, where it allows more requests in parallel increasing the total throughput via MLP and also (2) by having many requests visible to the controller at once, they can be rearranged so the DRAM is accessed in a pattern more friendly to the underlying hardware, e.g., accessing more open pages as discussed above.</p>
<p>Finally, between the core and the memory controller you have the so-called &ldquo;superqueue&rdquo; which covers the path approximately from L2 to L3, and is thought to have 16 or so entries (but it is likely more now on CNL since we see a higher observed MLP factor).</p>
<p>As far as multiple cores go, using many changes things dramatically. You can basically break the path above up into the &ldquo;core private&rdquo; and &ldquo;shared&rdquo; components per socket. The superqueue and everything closer to the core is private, and the L3/CHA, memory controller and DRAM are shared. Usually the shared resources aren&rsquo;t the bottleneck for a single core, since they are sized for multiple cores &#8211; but once you get a few cores running at maximum required bandwidth, the shared components will become a bottleneck and the achievable per-core MLP will drop. The detailed be of the core-private stuff is usually the same with a micro-architecture, even across client and server parts, but the shared stuff varies a lot, all the way down to the specific characteristics and number of DIMMs you are using.</p>
</div>
</li>
</ol>
</li>
</ol>
