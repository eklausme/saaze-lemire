---
date: "2019-08-16 12:00:00"
title: "Faster threshold queries with cache-sensitive scancount"
index: false
---

[14 thoughts on &ldquo;Faster threshold queries with cache-sensitive scancount&rdquo;](/lemire/blog/2019/08-16-faster-threshold-queries-with-cache-sensitive-scancount)

<ol class="comment-list">
<li id="comment-424322" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Nathan Kurz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-17T13:46:14+00:00">August 17, 2019 at 1:46 pm</time></a> </div>
<div class="comment-content">
<p>Daniel is probably already viewing it this way, but readers might benefit from making the example more concrete.</p>
<p>Assume that the lists of sorted integers are &ldquo;posting lists&rdquo; from an inverted index, with each integer representing a document in which a word appears. Assume that we have a &ldquo;query&rdquo; that consists of 100 words, so that each of the 100 lists of integers represent all the documents that contain a given word. We&rsquo;d like to return as the result of the query all documents that contain at least 3 of the words. How can we do this efficiently? And while we are at it, wouldn&rsquo;t it be nice if we could sort the results (the list of documents that contain the words) based on how many of the terms they contain?</p>
<p>Operations like this are essential to the functioning of search engines, and thus making them more efficient is a big deal.</p>
</div>
<ol class="children">
<li id="comment-424331" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-17T15:37:00+00:00">August 17, 2019 at 3:37 pm</time></a> </div>
<div class="comment-content">
<p>Thank you Nathan.</p>
</div>
</li>
</ol>
</li>
<li id="comment-424535" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1afdc0c205940092b322354b7aa4b6be?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1afdc0c205940092b322354b7aa4b6be?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/alldroll" class="url" rel="ugc external nofollow">Alexander Petrov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-18T22:48:30+00:00">August 18, 2019 at 10:48 pm</time></a> </div>
<div class="comment-content">
<p>Nice article!</p>
<p>I have implemented <a href="https://github.com/alldroll/suggest/tree/master/pkg/merger" rel="nofollow">here</a> some &ldquo;T-overlap&rdquo; algorithms such as<br/>
&ldquo;ScanCount&rdquo;, &ldquo;MergeSkip&rdquo;, &ldquo;DivideSkip&rdquo;, &ldquo;CPMerge&rdquo; and there is a really good performance for &ldquo;CPMerge&rdquo; algorithm described <a href="https://www.aclweb.org/anthology/C10-1096" rel="nofollow">here</a></p>
</div>
<ol class="children">
<li id="comment-424621" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/kwillets" class="url" rel="ugc external nofollow">KWillets</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-19T21:30:43+00:00">August 19, 2019 at 9:30 pm</time></a> </div>
<div class="comment-content">
<p>Please see my other comment in this thread; it was meant to be a reply to this comment.</p>
</div>
</li>
</ol>
</li>
<li id="comment-424620" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/kwillets" class="url" rel="ugc external nofollow">KWillets</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-19T21:26:38+00:00">August 19, 2019 at 9:26 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for that reference; I was wondering if anyone had any use for this type of algorithm &#8212; I came up with MergeSkip in the early 00&rsquo;s as part of a frequent itemset finder. Any iterator that can &ldquo;skip&rdquo; in sublinear time can benefit; I believe even graph cliques are possible.</p>
<p>My version had some tweaks that might help performance &#8212; I always kept T elements below the heap in a ring buffer instead of dynamically expanding each run. I started each iteration by swapping the tail of the FIFO with the top of the heap and rotating the ring head pointer. The new heap top would then skip and sift down as in MergeSkip.</p>
<p>One of my todo&rsquo;s is to look into how this method might compare for simpler types like arrays &#8212; thanks for helping to answer that question.</p>
</div>
<ol class="children">
<li id="comment-425077" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1afdc0c205940092b322354b7aa4b6be?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1afdc0c205940092b322354b7aa4b6be?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/alldroll" class="url" rel="ugc external nofollow">Alexander Petrov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-24T09:44:13+00:00">August 24, 2019 at 9:44 am</time></a> </div>
<div class="comment-content">
<p>Interesting design! I definitely will try to implement it. My benchmarks show that the bottleneck of this algorithm is a heap: <code>Pop</code> and <code>Push</code>. Thank you for the idea</p>
</div>
<ol class="children">
<li id="comment-425096" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-24T17:28:22+00:00">August 24, 2019 at 5:28 pm</time></a> </div>
<div class="comment-content">
<p>It looks like Go&rsquo;s heap has a Fix method that allows you to update element 0 and sift down, so that&rsquo;s good (many heap implementations only allow sift-up). The skip operation seems like it would produce a new value near the minimum.</p>
<p>The ring buffer to be clear had only one pointer, as it was always full, making head/tail adjacent. A standard two-pointer version might have more overhead.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-425206" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-25T20:18:23+00:00">August 25, 2019 at 8:18 pm</time></a> </div>
<div class="comment-content">
<p>I was able to get it down to around 4 cycles/element with a few changes.</p>
<p>Also, on my machine (Skylake i7-6700HQ) the benefit of the cache-blocked technique is even better than you show: I still get ~16 cycles for the blocked approach, but usually around 50 cycles for other one. It may depend on activity on my system.</p>
</div>
<ol class="children">
<li id="comment-425218" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-25T23:16:50+00:00">August 25, 2019 at 11:16 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>I was able to get it down to around 4 cycles/element with a few<br/>
changes.</p>
</blockquote>
<p>Can you tell us more?</p>
</div>
<ol class="children">
<li id="comment-425315" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Kurz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-27T04:16:53+00:00">August 27, 2019 at 4:16 am</time></a> </div>
<div class="comment-content">
<p>Let&rsquo;s flip the question and ask: When it took 16 cycles to do what should be a load, a compare, and a write per element, where did you think the extra time was going?</p>
<p>Having not heard back from Travis, I played with it a little. The first thing was to use &ldquo;-Ofast&rdquo; instead of &ldquo;-O2&rdquo;, which got me down from 16 cycles to 12. Beyond that I had to use &ldquo;perf record&rdquo;. The next thing I noticed was that the second loop that checks the threshold and writes the hits takes a surprising amount of time. This can easily be combined with the other loop, so that a value gets written as soon as it equals the threshold. This gets down from 12 to 8.</p>
<p>The next step was to blame C++. Well, maybe that&rsquo;s just me. But I think there is a big abstraction issue that&rsquo;s causing it to do a lot more reads and writes than should be necessary. Every time you call &ldquo;it++&rdquo; it&rsquo;s writing the new value to memory (well, cache) and then rereading it on the next iteration.</p>
<p>Worse, it seems like almost everything else is working off the stack too. The IO for the inner loop should be basically a single read and write, but instead it&rsquo;s got two writes and a half-dozen reads. By the time I figured out what the assembly was doing, my C++ allergy was making it hard for me to breath normally, so I didn&rsquo;t actually try to fix this. But I think if you were to write something straightforward in C, I think you&rsquo;d easily get down to 4 cycles, possibly fewer. Travis is stronger than I am, and probably managed to avoid the excessive IO without switching languages.</p>
</div>
<ol class="children">
<li id="comment-425318" class="comment even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-27T04:52:24+00:00">August 27, 2019 at 4:52 am</time></a> </div>
<div class="comment-content">
<p>Yeah the constant reloading from memory thing was interesting enough that I wrote a post about it:</p>
<p><a href="https://travisdowns.github.io/blog/2019/08/26/vector-inc.html" rel="nofollow ugc">https://travisdowns.github.io/blog/2019/08/26/vector-inc.html</a></p>
<p>The motivation was exactly this problem. Basically once you have writes to <code>char</code> (or <code>uint8_t</code>) arrays in some loop, you better make sure everything else is an unescaped local variable.</p>
<p>Sorry I didn&rsquo;t get back to this: I got to 4 cycles quickly (basically std:fill -&gt; memset, fix the iterator problems Nathan mentions, vectorize the final scanning of the counters array), but of course I wanted more. I tried a few things that got close to 3 cycles but then also tried a bunch of unproductive things and got the code in an ugly state without being faster so I didn&rsquo;t want to send a PR with that mess.</p>
<p>The speed of light here is 1 cycle since the only absolutely compulsory thing that is O(N) in the size of the input elements seems to be the scattered writes, and I can&rsquo;t see an easy way to vectorize that (it&rsquo;s basically similar to radix sort, which is also limited by the scattered writes). It seems hard to get to 1, but 2 could be possible.</p>
<blockquote><p>
This can easily be combined with the other loop, so that a value gets<br/>
written as soon as it equals the threshold.
</p></blockquote>
<p>That&rsquo;s a good idea. I took a different approach of vectorizing the scan of the counter array: it&rsquo;s almost all zeros so this goes fast, but I feel your approach may be faster if it can slip in for free among all the other work. I&rsquo;m going to try it.</p>
</div>
<ol class="children">
<li id="comment-425320" class="comment odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-27T04:56:11+00:00">August 27, 2019 at 4:56 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
it’s almost all zeros so this goes fast
</p></blockquote>
<p>Sorry, that should say &ldquo;it&rsquo;s almost all values below the threshold&rdquo;, and that still goes fast. Only about 2,500 hits over the entire input, so the scanning has to be fast but the hit handling doesn&rsquo;t.</p>
</div>
</li>
<li id="comment-425345" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Kurz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-27T14:10:19+00:00">August 27, 2019 at 2:10 pm</time></a> </div>
<div class="comment-content">
<p>Great writeup! Comparing it to my semi-coherent blog post reply, I feel slightly outdone by your complete and coherent explanation. I hadn&rsquo;t figured out that the char-type aliasing was the base issue.</p>
<p>I&rsquo;m still confused why the generated assembly is rereading all the constants from memory in the inner loop. I tried changing all the uint8_t&rsquo;s to uint32_t&rsquo;s (which solves the aliasing issues at the cost of some cache), but GCC still rereads things like &lsquo;threshold&rsquo; from the stack on every iteration. I&rsquo;m not sure that this is a performance issue (clang doesn&rsquo;t seem do it and ends up slower), but it seems like a silly choice. Is there a good way to convince GCC to behave more sensibly?</p>
</div>
<ol class="children">
<li id="comment-425347" class="comment odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-27T15:14:15+00:00">August 27, 2019 at 3:14 pm</time></a> </div>
<div class="comment-content">
<p>Yes, what you noticed about those reads comes from another effect: the function is complicated enough that it runs out of registers and gcc makes some not ideal choices about which registers to spill, and this results in it reading spilled regs from the stack in the inner loop.</p>
<p>I work around this by using &ldquo;noinline&rdquo; to force the loop to a standalone function, where it gets a full set of registers and so doesn&rsquo;t need to spill. An interesting case of forcing things out of line causing it to speed up, without having anything to do with code size effects (indeed, the inline version may be smaller).</p>
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
</ol>
