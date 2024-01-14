---
date: "2018-06-26 12:00:00"
title: "Data processing on modern hardware"
index: false
---

[15 thoughts on &ldquo;Data processing on modern hardware&rdquo;](/lemire/blog/2018/06-26-data-processing-on-modern-hardware)

<ol class="comment-list">
<li id="comment-310614" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-26T22:56:59+00:00">June 26, 2018 at 10:56 pm</time></a> </div>
<div class="comment-content">
<p>I was looking at sizing a data warehouse on AWS the other day, and it really seems to come down 10 Gb/s networking, and sharing it for everything: loading, inter-cluster, storage, and query (S3 or EBS). Each hop basically redistributes the data by a different scheme (eg the load stream has to be parsed to get the target node for each row), so network is pretty much guaranteed to be the bottleneck.</p>
</div>
</li>
<li id="comment-310646" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-27T00:56:39+00:00">June 27, 2018 at 12:56 am</time></a> </div>
<div class="comment-content">
<blockquote>
<p>so network is pretty much guaranteed to be the bottleneck.</p>
</blockquote>
<p>Assume that this is true. Then what is the consequence? Do you go for cheap nodes, given that, in any case, they will always be starved&#8230; Or do you go for powerful nodes to minimize network usage?</p>
</div>
<ol class="children">
<li id="comment-310825" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-27T17:37:35+00:00">June 27, 2018 at 5:37 pm</time></a> </div>
<div class="comment-content">
<p>The query end depends heavily on SSD cache; basically terabytes of hot data. This stuff is often joined and aggregated locally, so network is less of a factor there (part of my job is to ensure this tendency).</p>
<p>SSD is only available on larger SKU&rsquo;s, so using many small nodes would likely decrease query performance while increasing load or insert throughput. However there is also a split strategy of having storageless &ldquo;compute&rdquo; nodes which handle loading while the main cluster handles storage and querying.</p>
</div>
</li>
</ol>
</li>
<li id="comment-310714" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Kurz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-27T06:01:15+00:00">June 27, 2018 at 6:01 am</time></a> </div>
<div class="comment-content">
<p>I feel like an even simpler thing we are lacking is the ability to easily coordinate all the cores in a single machine to work on the same data. The cores tend to share a common L3, it seems agreed that getting data from RAM to L3 is one of the bottlenecks, but there don&rsquo;t seem to be any efficient low level ways to help the cores share their common resources rather than competing for them.</p>
<p>This may seem like a silly complaint, since OS&rsquo;s have smoothly managed threads and processes across cores for decades, but for a lot of problems this is far to high level, and the coordination is far too expensive. For example, I&rsquo;d like is to be able to design &ldquo;workflows&rdquo; where each core can concentrate on each stage of a multistage process, where data can be passed between cores using the existing cache line coherence mechanisms.</p>
<p>Is there anything out there that does this? Or otherwise allows inter-core coordination at speeds comparable to L3 access?</p>
</div>
<ol class="children">
<li id="comment-310798" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-27T13:54:18+00:00">June 27, 2018 at 1:54 pm</time></a> </div>
<div class="comment-content">
<p>It seems that our Knight Landing box has some fancy core-to-core communication. You have to have that when the number of cores goes way up.</p>
<p>And what about AMD&rsquo;s Infinity Fabric and Intel&rsquo;s mesh topology for Skylake?</p>
</div>
<ol class="children">
<li id="comment-310838" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Kurz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-27T18:45:55+00:00">June 27, 2018 at 6:45 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;d guess that the hardware support is already present. What&rsquo;s lacking is a reasonable interface that allows access from userspace.</p>
<p>Consider the MONITOR/MWAIT pair: <a href="http://blog.andy.glew.ca/2010/11/httpsemipublic.html" rel="nofollow ugc">http://blog.andy.glew.ca/2010/11/httpsemipublic.html</a>. It&rsquo;s always seemed like there should be a way to use these to do high performance coordination between cores, and apparently they are finally available outside the kernel on KNL, but I&rsquo;ve never seen a project that makes use of them.</p>
<p>Alternatively, consider the number of papers you read that provide good whole processor numbers versus those that provide only single-threaded numbers. Almost everything that shows multicore results does it by running multiple parallel instantiations of the same code. Is there really no way further optimizations possible?</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-310800" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3f5c8ff7df2a8d8eeb983da2256fba54?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3f5c8ff7df2a8d8eeb983da2256fba54?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Yiannis Papadopoulos</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-27T14:07:34+00:00">June 27, 2018 at 2:07 pm</time></a> </div>
<div class="comment-content">
<p>Most times you have to move data from main memory to accelerator memory, but a lot of new platforms allow for cache coherent unified memory that blurs the line between CPU core and accelerator; the accelerator memory, if any, is more of a cache than anything else.</p>
<p>The fundamental problem is not how to move lots of data, but how to move enough to keep the GPU/FPGA busy.</p>
</div>
</li>
<li id="comment-310823" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://boytsov.info" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-27T17:27:49+00:00">June 27, 2018 at 5:27 pm</time></a> </div>
<div class="comment-content">
<p>Sorry, I don&rsquo;t get this exponentiality argument. GPU memory is much faster and much more expensive that commodity RAM. It is just not feasible to use GPU memory to store things: you can do it much cheaper without GPU.</p>
</div>
<ol class="children">
<li id="comment-310824" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-27T17:35:46+00:00">June 27, 2018 at 5:35 pm</time></a> </div>
<div class="comment-content">
<p>I think the model is to view the GPU as a smart cache. Whether it can deliver value outside of specific applications&#8230; I do not know.</p>
</div>
<ol class="children">
<li id="comment-310826" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://boytsov.info" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-27T17:39:55+00:00">June 27, 2018 at 5:39 pm</time></a> </div>
<div class="comment-content">
<p>But it sits on a weak PCI link. Unless you have a different interconnect such as infiniband.</p>
</div>
<ol class="children">
<li id="comment-310828" class="comment even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3f5c8ff7df2a8d8eeb983da2256fba54?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3f5c8ff7df2a8d8eeb983da2256fba54?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Yiannis Papadopoulos</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-27T17:48:55+00:00">June 27, 2018 at 5:48 pm</time></a> </div>
<div class="comment-content">
<p>There is also NVlink (NVIDIA Volta, IBM Power9) and CPU+GPU products (e.g., AMD Kaveri, nearly all smartphone processors).</p>
<p>The discussion should not be about interconnects or unified memory or not, but how much is the latency to access non-local memory and how you can hide it.</p>
</div>
<ol class="children">
<li id="comment-310834" class="comment odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://boytsov.info" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-27T18:24:44+00:00">June 27, 2018 at 6:24 pm</time></a> </div>
<div class="comment-content">
<p>The last time I checked on hybrid GPU/CPU solutions, I found them severely underpowered compared to the lineup of NVIDIA products.</p>
<p>I don&rsquo;t get your comment about latency and interconnects. The quality of the interconnect directly affects latency. Also having a fancy interconnect adds complexity.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-310833" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/47c618d891e6936b8596eaf65c4024b5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/47c618d891e6936b8596eaf65c4024b5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Neeraj Badlani</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-27T18:13:12+00:00">June 27, 2018 at 6:13 pm</time></a> </div>
<div class="comment-content">
<p>Seems like interesting seminar . Would you happen to know if they record this ?<br/>
Thanks</p>
</div>
<ol class="children">
<li id="comment-310897" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-27T23:50:24+00:00">June 27, 2018 at 11:50 pm</time></a> </div>
<div class="comment-content">
<p>They most certainly do not record it (they are not presentations but discussions), but there will be a written (free) report. Moreover, I will write more about some of these topics in the coming weeks and months.</p>
</div>
</li>
</ol>
</li>
<li id="comment-317541" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cc43ef934e4a5fb35afc4b64aeb74ee3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cc43ef934e4a5fb35afc4b64aeb74ee3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">alecco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-15T07:38:20+00:00">July 15, 2018 at 7:38 am</time></a> </div>
<div class="comment-content">
<p>Agree wholeheartedly to the issue of moving things into the GPU from RAM. But&#8230; It is now possible to have direct SSD-GPU without going through CPU or main memory. The GPU maps a portion of its memory into the PCIe bus. See pg-strom (though it doesn&rsquo;t seem to show much after 2016).</p>
<p>A problem GPUs with lots of memory are quite expensive. An Nvidia Tesla 24GB costs $500-$3000. And the way to use GPUs efficiently is with proprietary interfaces.</p>
</div>
</li>
</ol>
