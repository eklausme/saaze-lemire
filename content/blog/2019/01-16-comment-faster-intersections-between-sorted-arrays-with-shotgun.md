---
date: "2019-01-16 12:00:00"
title: "Faster intersections between sorted arrays with shotgun"
index: false
---

[26 thoughts on &ldquo;Faster intersections between sorted arrays with shotgun&rdquo;](/lemire/blog/2019/01-16-faster-intersections-between-sorted-arrays-with-shotgun)

<ol class="comment-list">
<li id="comment-382309" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a3db5f6d59c6bd8a6d6d3b8ab8dfdc93?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a3db5f6d59c6bd8a6d6d3b8ab8dfdc93?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">HUGO VILLENEUVE</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-16T07:45:37+00:00">January 16, 2019 at 7:45 am</time></a> </div>
<div class="comment-content">
<p>Why not do the galloping algorithm but alternating from the small array head and tail (1, N, 2, N-1, 3, &#8230;) and cache the upper and lower indices of the last binary search on the large array? Not a big saving, approximately M*log 2 fewer ops but possibly comparable.</p>
</div>
<ol class="children">
<li id="comment-382428" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-16T16:50:57+00:00">January 16, 2019 at 4:50 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;d love to see a benchmark of your idea. Did you try to code it up?</p>
</div>
<ol class="children">
<li id="comment-391473" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/98a44c3a4a527bb5702caa45905aff62?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/98a44c3a4a527bb5702caa45905aff62?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://coosto.com" class="url" rel="ugc external nofollow">Frank Scheelen</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-25T15:54:18+00:00">February 25, 2019 at 3:54 pm</time></a> </div>
<div class="comment-content">
<p>I tried something along the suggested line recently. For each element in the small array I kept an upper and lower limit which I updated depending on the values I encountered while probing. The small array was in memory, the large array on disk. (Since disk probes are very expensive, I figured I could waste some time on updating the limits.) It worked quite nicely in the sense that it saved a lot of disk probes in typical cases.</p>
<p>However, the running time was less than ideal. It took me a while to figure out what was happening. Because the elements of the small array now all had different lower and upper limits, the midpoints would differ ever so slightly all the time, thereby frustrating the disk cache.</p>
<p>This led me to discard the idea of adjusting the limits and instead add a LRU cache to the binary search. Since a large part of the &ldquo;search tree&rdquo; is repeated for each lookup, this resulted in a handsome speedup!</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-382328" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Leonid Boytsov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-16T09:03:22+00:00">January 16, 2019 at 9:03 am</time></a> </div>
<div class="comment-content">
<p>It has been fascinating to observe the trend from &ldquo;let&rsquo;s design the fastest algorithm&rdquo; to &ldquo;let&rsquo;s design an algorithm that ||-es better&rdquo;.</p>
</div>
</li>
<li id="comment-382398" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7bb1ae8703b69a060de9c48774616184?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7bb1ae8703b69a060de9c48774616184?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-16T14:29:13+00:00">January 16, 2019 at 2:29 pm</time></a> </div>
<div class="comment-content">
<p>If the two arrays are sorted, can&rsquo;t the same be accomplished using a &lsquo;merge&rsquo; operation with complexity O(M) faster? (no comparison with N-array needs to be made twice)</p>
</div>
</li>
<li id="comment-382400" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f15818ff6b6b8fd769f20d5c52f045d9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f15818ff6b6b8fd769f20d5c52f045d9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-16T14:48:16+00:00">January 16, 2019 at 2:48 pm</time></a> </div>
<div class="comment-content">
<p>To clear up my last comment, it seems your benchmark code is doing a &lsquo;merge&rsquo; in the sense of line 115: <code>idx_l = index1;</code> and then line 84 says: <code>int base1 = idx_l;</code>. My proposed optimization would be to have 115 use <code>index4</code> to really get ahead in the long array.</p>
<p>In any case the O(M*log N + M) remains the complexity.</p>
</div>
<ol class="children">
<li id="comment-382422" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-16T16:26:46+00:00">January 16, 2019 at 4:26 pm</time></a> </div>
<div class="comment-content">
<p>It depends on whether you expect the arrays to be strictly sorted or merely sorted (possibly with repeated values).</p>
</div>
<ol class="children">
<li id="comment-382436" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f15818ff6b6b8fd769f20d5c52f045d9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f15818ff6b6b8fd769f20d5c52f045d9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-16T17:53:55+00:00">January 16, 2019 at 5:53 pm</time></a> </div>
<div class="comment-content">
<p>Still can&rsquo;t see how repeats could make <code>idx_l = index4</code> fail, since <code>index4</code> points to <code>target4</code> if found and next target value will be at or after <code>index4</code>. If <code>target4</code> not found <code>index4</code> will be just one cell after lower-than-<code>target4</code> value in long list, and next target in short list must surely be higher by non-strict monotonicity (probably should be coding and running this myself).</p>
</div>
<ol class="children">
<li id="comment-382441" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-16T18:31:01+00:00">January 16, 2019 at 6:31 pm</time></a> </div>
<div class="comment-content">
<p>You might be right.</p>
</div>
<ol class="children">
<li id="comment-382443" class="comment byuser comment-author-lemire bypostauthor odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-16T18:34:57+00:00">January 16, 2019 at 6:34 pm</time></a> </div>
<div class="comment-content">
<p>I think you are right. I have updated the code.</p>
</div>
<ol class="children">
<li id="comment-382446" class="comment even depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f15818ff6b6b8fd769f20d5c52f045d9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f15818ff6b6b8fd769f20d5c52f045d9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-16T18:57:59+00:00">January 16, 2019 at 6:57 pm</time></a> </div>
<div class="comment-content">
<p>It might be a bit faster. New timing?</p>
</div>
<ol class="children">
<li id="comment-382449" class="comment byuser comment-author-lemire bypostauthor odd alt depth-7">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-16T19:03:17+00:00">January 16, 2019 at 7:03 pm</time></a> </div>
<div class="comment-content">
<p>Deliberately, I am giving rough numbers with one or two significant digits. My timings are not going to be affected by micro-optimizations.</p>
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
<li id="comment-382427" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Leonid Boytsov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-16T16:35:07+00:00">January 16, 2019 at 4:35 pm</time></a> </div>
<div class="comment-content">
<p>I think the old complexity definition largely doesn&rsquo;t work nowadays. For posting processing we have a bunch of &ldquo;same-complexity&rdquo; methods to do unions and intersections, but they have very different run-times easily orders of magnitude different.</p>
</div>
<ol class="children">
<li id="comment-382490" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dc1bd267dee075e966e84e48942ff35c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dc1bd267dee075e966e84e48942ff35c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://richardstartin.uk" class="url" rel="ugc external nofollow">Richard Startin</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-16T22:28:07+00:00">January 16, 2019 at 10:28 pm</time></a> </div>
<div class="comment-content">
<p>I agree. Even on the JVM, the same or worse complexity can win when some exposed feature of the underlying hardware can be utilised.</p>
</div>
</li>
<li id="comment-382497" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-16T22:53:15+00:00">January 16, 2019 at 10:53 pm</time></a> </div>
<div class="comment-content">
<p>Indeed.</p>
<p>Sometimes the problem is simply that the wrong thing is being counted. E.g., most searching algorithms give the complexity in the number of &ldquo;comparisons&rdquo;.</p>
<p>However, for searching in large arrays or many small arrays (such that the aggregate is large), what dominates is the memory access time, so you&rsquo;d be better of counting something like &ldquo;unique memory locations accessed&rdquo;, with the idea that once you&rsquo;ve accessed a location once, it&rsquo;s basically free to access it again (it&rsquo;s cached). Of course, even that&rsquo;s not exactly right: since, for example, caching isn&rsquo;t forever and also adjacent locations (within a cache line) will also come along for the ride, so you maybe you should count &ldquo;unique cache lines accessed&rdquo; &#8211; but if you go far enough down that rabbit hole you end up building a complete machine model.</p>
</div>
<ol class="children">
<li id="comment-382528" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Leonid Boytsov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-17T01:33:44+00:00">January 17, 2019 at 1:33 am</time></a> </div>
<div class="comment-content">
<p>This, but also the effect of parallelization that is hard to take into account many times. Things that run in parallel are often for run by using little or no resources.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-382493" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5f841a89e555ea666567c9572b26c0e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5f841a89e555ea666567c9572b26c0e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Frank Tetzel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-16T22:37:14+00:00">January 16, 2019 at 10:37 pm</time></a> </div>
<div class="comment-content">
<p>Looks like interleaved execution but done by hand. I don&rsquo;t think that interleaving all operation one-by-one gives any benefit. Only the memory access in parallel results in a speedup.</p>
<p>There are recent publications using C++ coroutines for interleaved execution which provide a nicer abstraction and leave the algorithm mostly unchanged.<br/>
<a href="http://www.vldb.org/pvldb/vol11/p230-psaropoulos.pdf" rel="nofollow ugc">http://www.vldb.org/pvldb/vol11/p230-psaropoulos.pdf</a></p>
<p>There was also a recent CppCon talk about the topic:<br/>
<a href="https://www.youtube.com/watch?v=j9tlJAqMV7U" rel="nofollow ugc">https://www.youtube.com/watch?v=j9tlJAqMV7U</a></p>
</div>
<ol class="children">
<li id="comment-383322" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-20T23:18:27+00:00">January 20, 2019 at 11:18 pm</time></a> </div>
<div class="comment-content">
<p>Thanks, the cppcon talk is well worth watching.</p>
<p>I understand your comment better now. Yes, this is even a lower level of interleaving than the approaches presented there, which break the work into resumable &ldquo;tasks&rdquo; &#8211; either by hand using an array of state objects, or using coroutines TS and then &ldquo;schedule&rdquo; these tasks round-robin using a more-or-less generic scheduler.</p>
<p>Here, the algorithm is simply modified to process within the main loop, more than one element at a time. It&rsquo;s a less generic approach (in particular, you cannot easily vary the number of interleaved elements), but in principle it could be since the barrier between the scheduler and the tasks is removed. For example, either task based approach will probably never keep state values in registers even if there are few enough tasks that it would be feasible, but in this type hard-coded batched loop approach it is possible.</p>
<p>Now the relative results here are much worse: a speedup of ~1.4x vs more than 3x for co-routines, but this have more to do with Java vs C++ than any inherent deficiency.</p>
</div>
<ol class="children">
<li id="comment-383396" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5f841a89e555ea666567c9572b26c0e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5f841a89e555ea666567c9572b26c0e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Frank Tetzel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-21T09:17:45+00:00">January 21, 2019 at 9:17 am</time></a> </div>
<div class="comment-content">
<p>There is still a fundamental difference: the number of computations between memory accesses.</p>
<p>In your shotgun approach you have all memory accesses right after each other. The next operations require the loaded values. There is not enough computation to load the first value from main memory, resulting in memory stalls. By grouping all operations before the memory access together and only issue a prefetch, we increase the number of computations before we use the loaded value. If we have N searches, (N-1) other searches execute all the operations leading to the next prefetch. We hide the memory latency with useful computation resulting in reduced CPU stalls.</p>
</div>
<ol class="children">
<li id="comment-383653" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-23T03:36:58+00:00">January 23, 2019 at 3:36 am</time></a> </div>
<div class="comment-content">
<p>In this example of binary search (that&rsquo;s the same example as the linked CppCon talk), there is essentially no computation. Maybe something like 1 or 2 cycles of work (a shift, compare and branch) pretty much, compared to the 100s of cycles needed for the memory access. So the compared to the memory access time, the time needed for computation rounds down to 0.</p>
<p>So the goal here is not to overlap memory access with computation, but memory access with more memory accesses. That&rsquo;s how the coroutine method gets its speedup.</p>
<p>In either Daniels code or the coroutine case, ignoring the complication of prefetching vs loading, the pattern is the same: a bunch of loads, then a bunch of &ldquo;computation&rdquo; (not actually a bunch at all). So having &ldquo;all memory accesses right after each other&rdquo; is fine (and coroutine does the same thing, at least if the arrays are the same size) &#8211; the only requirement is that the adjacent loads are <em>independent</em> so they can all execute without waiting for any other one.</p>
<p>Within a single search, the loads are all dependent &#8211; when considering the whole group of searches, there are many independent loads (i.e., each new search involves loads independent of all the other ones), but the CPU can&rsquo;t &ldquo;see&rdquo; them in the middle of a single search because all in can see is a stream of dependent loads all part of the current search. Its internal resources will often fill up before it speculates into the next search (and even then you are only at 2 parallel searches: you want many more).</p>
<p>So interleaving is all about reorganizing the stream of accesses so any random window of say 50-200 instructions contains a lot of independent accesses. The code Daniel presents here and coroutines both accomplish that.</p>
</div>
<ol class="children">
<li id="comment-385060" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5f841a89e555ea666567c9572b26c0e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5f841a89e555ea666567c9572b26c0e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Frank Tetzel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-28T15:46:39+00:00">January 28, 2019 at 3:46 pm</time></a> </div>
<div class="comment-content">
<p>Looks like you are right about the computation. There is just not enough in a binary search. I did some quick&amp;dirty measurements with the following code:</p>
<p><a href="https://github.com/tetzank/interleaved-algorithms" rel="nofollow ugc">https://github.com/tetzank/interleaved-algorithms</a></p>
<p>Group prefetching (simpler version of what coroutines do) and plain interleaving (called shotgun in the article) have pretty much the same performance on my machine. I have not thoroughly profiled it and only briefly checked the assembly (gcc creates branchless code (cmov) for both). I also threw in an AVX2 version. On Haswell it&rsquo;s slower as the gather instruction is not performant enough. Might be better on Skylake.</p>
<p>Just a testbed to get some numbers into the discussion. And, eventually, to try it on other memory latency bound algorithms.</p>
</div>
<ol class="children">
<li id="comment-405258" class="comment odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-05T21:29:57+00:00">May 5, 2019 at 9:29 pm</time></a> </div>
<div class="comment-content">
<p>I tested your SIMD code and it is good on Skylake, the 2-way version being at least twice as fast as the fastest &ldquo;plain4&rdquo; interleaved variant.</p>
<p>The 2-way SIMD version was nearly twice as fast as the 1-way SIMD version which was itself slightly faster than the fastest plain variants.</p>
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
<li id="comment-382502" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-16T23:08:07+00:00">January 16, 2019 at 11:08 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
Looks like interleaved execution but done by hand. I don&rsquo;t think that<br/>
interleaving all operation one-by-one gives any benefit. Only the<br/>
memory access in parallel results in a speedup.
</p></blockquote>
<p>Well I think Daniel&rsquo;s result here shows that it does give a benefit, right?</p>
<p>In particular, the parallel memory access is made <em>possible</em> (or at least &ldquo;more possible&rdquo;) by interleaving since there are more independent memory operations visible in the out-of-order window of the processor. Typical binary search is kind of a worst case for memory parallelism since each access in the search depends on the prior one, either via a control dependence (with a probability of a wrong prediction and hence a pointless probe) or a data dependency (even worse since now all accesses are serialized).</p>
<p>So yeah, &ldquo;only the memory access in parallel results in a speedup&rdquo;, but that&rsquo;s like saying &ldquo;only the sugar and chocolate in this brownie results in deliciousness&rdquo; or something to that effect.</p>
<p>I will check out the work you linked &#8211; but my initial question is always &ldquo;how much does the abstraction cost&rdquo; &#8211; even a few instructions limits how fine-grained you can do the switching. So I am very interested in this stuff but still in &ldquo;see it when I believe it&rdquo; mode.</p>
</div>
<ol class="children">
<li id="comment-382611" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5f841a89e555ea666567c9572b26c0e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5f841a89e555ea666567c9572b26c0e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Frank Tetzel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-17T09:24:56+00:00">January 17, 2019 at 9:24 am</time></a> </div>
<div class="comment-content">
<p>The problem is that with interleaving each operation you carry a lot of state around. If every value still fits in the registers, it&rsquo;s probably faster than other approaches. But if it doesn&rsquo;t, one loads and stores too often from and to the stack. Sure stack is in L1, but still. I would assume that it limits the number of searches you can interleave too much. On Intel CPUs, we can have up to 10 memory loads in flight. Getting close to 10 interleaved searches would be ideal.</p>
</div>
<ol class="children">
<li id="comment-382663" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-17T17:09:03+00:00">January 17, 2019 at 5:09 pm</time></a> </div>
<div class="comment-content">
<p>Yes there is definitely a limit to the interleaving before code quality drops and you start spilling registers, and this limit depends in the number of registers available (obviously) and also the code in question. Sometimes you can come up with a level transformation that reduces the number of registers used.</p>
<p>In this example, I think you only need one additional register per interleaved search, plus a few other registers (whose number doesn&rsquo;t depend on the number of searches) as temporaries and to track the current search span &#8211; so you could in principle get to your desired limit of 10 on an 16-reigster architecture.</p>
<p>As you point out, spilling isn&rsquo;t necessarily all that bad if you fighting main memory latencies as your primary limiting factor, since spills to L1 take only a small fraction of the time of a miss to main memory (but spills also tend to clog up the out of order window with more instructions, which may also limit the achieved memory parallelism).</p>
<p>Coroutines don&rsquo;t have any magic way around spills though, do they? They also have to dealing with saving and restoring registers, and I don&rsquo;t see them having access to any tricks that the register allocator in a compiler would not (and on the contrary, the &ldquo;single moment in time&rdquo; switch implies additional restrictions which result in more spills.</p>
</div>
</li>
<li id="comment-383186" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6fff5350c6615902c2176ce665453029?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6fff5350c6615902c2176ce665453029?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maynard Handley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-20T01:32:46+00:00">January 20, 2019 at 1:32 am</time></a> </div>
<div class="comment-content">
<p>But that&rsquo;s always the case. Optimal code has to target the particular properties of the machine, and there are limits to how much you can hope for the compiler intuiting your goal and appropriately matching HW!</p>
<p>For example back in the day (early 90s) I wrote a DFT to handle AAC audio. Most practical books presented radix-2 code, and for x86 that was probably the optimal solution given the paucity of x87 registers. But for PPC I could just fit a radix-8 DFT into the 32 FP registers.</p>
<p>This seems to me analogous &#8212; optimal structure (ie optimal &ldquo;interleaving&rdquo;) for x86 may differ from optimal structure for &ldquo;generic&rdquo; ARM which will in turn differ from optimal structure for Apple ARM.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
