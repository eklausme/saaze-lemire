---
date: "2018-05-28 12:00:00"
title: "Greater speed in memory-bound graph algorithms with just straight C code"
index: false
---

[17 thoughts on &ldquo;Greater speed in memory-bound graph algorithms with just straight C code&rdquo;](/lemire/blog/2018/05-28-greater-speed-in-memory-bound-graph-algorithms-with-just-straight-c-code)

<ol class="comment-list">
<li id="comment-305610" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/36b37e6fddb33c8b4ecd9d09baf5c97f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/36b37e6fddb33c8b4ecd9d09baf5c97f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Semih Salihoglu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-28T22:39:27+00:00">May 28, 2018 at 10:39 pm</time></a> </div>
<div class="comment-content">
<p>This is getting more interesting. Which optimization is kicking in here? Is it the processor sending multiple requests to the memory before doing any computation and that capturing some kind of locality?</p>
<p>Also should this also work in Java? I wrote this Java code quickly that does a 7 step BFS traversal starting from a random source doing it 1-by-1, or by your 8-by-8 trick. The 8-by-8 trick doesn&rsquo;t seem to help on my Mac OS. I&rsquo;m using Java 8. I didn&rsquo;t check your code in detail, I just wrote it based on the pseudocode.</p>
</div>
<ol class="children">
<li id="comment-305613" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/36b37e6fddb33c8b4ecd9d09baf5c97f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/36b37e6fddb33c8b4ecd9d09baf5c97f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Semih Salihoglu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-28T22:40:06+00:00">May 28, 2018 at 10:40 pm</time></a> </div>
<div class="comment-content">
<p>The link got lost for my code: <a href="https://github.com/semihsalihoglu-uw/misc/blob/master/java-bfs-opt/ScratchPad.java" rel="nofollow ugc">https://github.com/semihsalihoglu-uw/misc/blob/master/java-bfs-opt/ScratchPad.java</a></p>
</div>
</li>
<li id="comment-305637" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-28T23:44:07+00:00">May 28, 2018 at 11:44 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>Which optimization is kicking in here? Is it the processor sending multiple requests to the memory before doing any computation and that capturing some kind of locality?</p>
</blockquote>
<p>Exactly. The idea is that you can replace a software prefetch by a data access that is &ldquo;ahead of time&rdquo;. This data access will get stuck, but the processor will work for you, trying to fill it in.</p>
<p>I should warn you that the code above is not optimal. It is a hack to prove the concept.</p>
<blockquote>
<p>Also should this also work in Java?</p>
</blockquote>
<p>Yes.</p>
<p>I chose C because it will allow me to do things that are not possible in Java. (I am not nearly done!) But what I just did is language independent.</p>
<p>I&rsquo;ll look at your Java code. (Next week?)</p>
</div>
<ol class="children">
<li id="comment-305980" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5f841a89e555ea666567c9572b26c0e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5f841a89e555ea666567c9572b26c0e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Frank Tetzel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-30T08:51:58+00:00">May 30, 2018 at 8:51 am</time></a> </div>
<div class="comment-content">
<p>Your data access is not really &ldquo;ahead-of-time&rdquo;, but out-of-order execution kicks in as the accesses in the batch are independent.</p>
<p>There is prior work doing very similar things with prefetching as out-of-order execution has its limits (window size). But I&rsquo;m not aware of anybody doing it for graph traversals.<br/>
All of them utilize memory parallelism to reduce or hide memory latency such that the cache miss penalty is less severe.</p>
<p>group prefetching<br/>
<a href="https://dl.acm.org/citation.cfm?id=1272747" rel="nofollow ugc">https://dl.acm.org/citation.cfm?id=1272747</a><br/>
Asynchronous memory access chaining<br/>
<a href="http://www.vldb.org/pvldb/vol9/p252-kocberber.pdf" rel="nofollow ugc">http://www.vldb.org/pvldb/vol9/p252-kocberber.pdf</a><br/>
Interleaving with Coroutines<br/>
<a href="http://www.vldb.org/pvldb/vol11/p230-psaropoulos.pdf" rel="nofollow ugc">http://www.vldb.org/pvldb/vol11/p230-psaropoulos.pdf</a></p>
</div>
<ol class="children">
<li id="comment-324632" class="comment even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-29T19:08:57+00:00">July 29, 2018 at 7:08 pm</time></a> </div>
<div class="comment-content">
<p>I would be surprised if techniques like this to include MLP on graph algorithms aren&rsquo;t widely used in the industry. I have looked at very few graph traversal algorithms, but one I did look at a long time ago: the mark part of the JDK&rsquo;s mark &amp; sweep garbage collector definitely used a strategy to ensure multiple requests were in flight at once: the nodes to visit were kept in a queue, and prefetch requests were issued to the N elements at the head of the queue, to try to keep about N requests in flight at once.</p>
<p>I remember reading it way back then and thinking &ldquo;that&rsquo;s clever!&rdquo;. If you were really sure you were almost always missing to DRAM, you might even apply other tricks such as sorting the nodes in the queue so that they have a more linear access pattern, or visiting them in an order that was otherwise cache or memory controller friendly.</p>
</div>
<ol class="children">
<li id="comment-324675" class="comment byuser comment-author-lemire bypostauthor odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-29T20:18:28+00:00">July 29, 2018 at 8:18 pm</time></a> </div>
<div class="comment-content">
<p>It depends what you mean by &ldquo;the industry&rdquo;. There is related published work in the field of garbage collection, and I expect state-of-the-art garbage collectors to optimize accordingly.</p>
</div>
<ol class="children">
<li id="comment-324729" class="comment even depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-29T21:30:06+00:00">July 29, 2018 at 9:30 pm</time></a> </div>
<div class="comment-content">
<p>By &ldquo;industry&rdquo; I just mean the collection of people writing software for use, whether commercial, open source, internal use, whatever. More or less as opposed to &ldquo;in the literature&rdquo; and/or academia.</p>
<p>Above there was some discussion of whether this idea had been explored, and a comment that its applicability to graphs perhaps hadn&rsquo;t been explored. My claim then is that this has almost certainly been repeatedly explored &ldquo;in the industry&rdquo; (i.e., software about which no paper is written, or at least no paper exploring this issue) since one of the few graph algorithms I looked at long ago already used the trick of explicitly managing a queue of future memory accesses and prefetches to get MLP.</p>
<p>Perhaps that &ldquo;trick&rdquo; originated in a GC paper, but in my experience that is not the normal direction of flow for such O(1) (i.e., not changing the complexity) tricks.</p>
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
</ol>
</li>
<li id="comment-305657" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/02d257cd405544564222bbdf504ef4d7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/02d257cd405544564222bbdf504ef4d7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://branchfree.org" class="url" rel="ugc external nofollow">Geoff Langdale</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-29T00:49:47+00:00">May 29, 2018 at 12:49 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m not surprised. Algorithms textbooks assume that the difference between a machine with 220 instructions in flight at a time and 1 instruction in flight is O(1), which of course it is. 🙂 However, there is a huge speedup that can be had by these sort of transformations if you can break dependencies. I&rsquo;m working on a Random Forest implementation off-and-on and <em>all</em> the first-order issues I&rsquo;m having with it are identical to what you discuss, although a binary tree is way easier to deal with than an arbitrary graph and more amenable to optimizations. It is interesting that there is way more work on naive parallelism of this sort of thing (&ldquo;let&rsquo;s chuck 8 cores at it&rdquo;) than there is extracting the parallelism latent in one core. Of course, if you get <strong>too</strong> good at extracting per-core parallelism you will wind up potentially saturating uncore resources like L3 or the memory bus. But I have plenty of algorithms whose naive versions really do nothing but sit around and wait for L2 all day, and max-ing out L2 utilization is just fine as far as core scaling goes.</p>
</div>
</li>
<li id="comment-305674" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3bcc2e0f60fe12078bfced929aa851f3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3bcc2e0f60fe12078bfced929aa851f3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Scott Hess</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-29T01:51:11+00:00">May 29, 2018 at 1:51 am</time></a> </div>
<div class="comment-content">
<p>The nice thing about an explicit prefetch version is that I, the reader, look at it and immediately know &ldquo;This is designed to target a specific memory hierarchy&rdquo;. The groups-of-8 version certainly <strong>can</strong> have a comment which describes why it is that way, but in my experience the more likely thing you&rsquo;ll find is a piece of code which feels like it&rsquo;s more complicated than it needs to be, without any explanation of how or why.</p>
</div>
<ol class="children">
<li id="comment-305675" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-29T01:54:10+00:00">May 29, 2018 at 1:54 am</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t disagree but the approach I have taken here is probably both suboptimal and overly complicated. I think you can get both better speed and simpler code with some effort.</p>
</div>
</li>
</ol>
</li>
<li id="comment-305678" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/02d257cd405544564222bbdf504ef4d7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/02d257cd405544564222bbdf504ef4d7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://branchfree.org" class="url" rel="ugc external nofollow">Geoff Langdale</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-29T02:10:36+00:00">May 29, 2018 at 2:10 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m thinking prefetch and gather are both potentially interesting optimization areas to look at, even though I have never had a particularly fun time with gather. Both address the problem of running out of places to stash data items fetched in a wide pipeline (in radically different ways).</p>
</div>
</li>
<li id="comment-305719" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24cfa9591263008553ae4c125b6a9934?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24cfa9591263008553ae4c125b6a9934?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">wmu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-29T06:17:35+00:00">May 29, 2018 at 6:17 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
I use a random graph containing 10 million nodes and where each node has degree 16 (meaning that each node has 16 neighbours).
</p></blockquote>
<p>I&rsquo;d love to see results with less regular data, when the degree varies.</p>
</div>
<ol class="children">
<li id="comment-305837" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-29T15:49:30+00:00">May 29, 2018 at 3:49 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;d like to move this to real data, but there is more at the implementation side of things that could be done.</p>
</div>
</li>
</ol>
</li>
<li id="comment-306272" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5e4320b1cd07fde01941d11c188ff416?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5e4320b1cd07fde01941d11c188ff416?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Keith Burns</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-31T22:33:23+00:00">May 31, 2018 at 10:33 pm</time></a> </div>
<div class="comment-content">
<p>VPP has been doing this for 15 years. Well worth a look for some brilliant performant patterns</p>
<p>Wiki.fd.io</p>
</div>
<ol class="children">
<li id="comment-306306" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-01T00:58:11+00:00">June 1, 2018 at 12:58 am</time></a> </div>
<div class="comment-content">
<p><em>Well worth a look for some brilliant performant patterns</em></p>
<p>Can you point to some of these patterns?</p>
</div>
</li>
</ol>
</li>
<li id="comment-324382" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5f70b3921b7ccd5d3e350cc392ef08d0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5f70b3921b7ccd5d3e350cc392ef08d0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marwan Burelle</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-29T12:05:09+00:00">July 29, 2018 at 12:05 pm</time></a> </div>
<div class="comment-content">
<p>Interesting!</p>
<p>Some years ago, we&rsquo;ve done tests that somehow may be in line with this.</p>
<p>We were trying to speed-up diameter algorithms (which involve a lot of breadth first traversal) and find out that just renumbering the graph with the order of a bfs can have huge impact. Our guess was that it increases locality. Unfortunately we had other projects more important &#8230;</p>
</div>
</li>
<li id="comment-544892" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/35d0a9c0b1829f21dac10b5c29ab057c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/35d0a9c0b1829f21dac10b5c29ab057c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">cwl</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-25T09:10:42+00:00">July 25, 2020 at 9:10 am</time></a> </div>
<div class="comment-content">
<p>Will this work when using openmp ?</p>
</div>
</li>
</ol>
