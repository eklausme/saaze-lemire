---
date: "2017-06-21 12:00:00"
title: "Top speed for top-k queries"
index: false
---

[12 thoughts on &ldquo;Top speed for top-k queries&rdquo;](/lemire/blog/2017/06-21-top-speed-for-top-k-queries)

<ol class="comment-list">
<li id="comment-281953" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Kendall Willets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-21T22:03:39+00:00">June 21, 2017 at 10:03 pm</time></a> </div>
<div class="comment-content">
<p>One thing I just noticed is that add/poll can be replaced with swapping the root and percolating down, so that two separate heap adjustments aren&rsquo;t needed. </p>
<p> //b.add(x);<br/>
//b.poll();<br/>
b.array[0]=x;<br/>
b._percolateDown(0); </p>
<p>This gives another 50% increase in performance.</p>
</div>
<ol class="children">
<li id="comment-282089" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-22T17:22:03+00:00">June 22, 2017 at 5:22 pm</time></a> </div>
<div class="comment-content">
<p>Unfortunately I&rsquo;m not seeing that increase on the most recent version of the test, but it still seems like the right way to do it. </p>
<p>And, this heap operation is known as a &ldquo;replace top&rdquo; in Postgres; they quote Knuth and Heapsort as the source. It&rsquo;s required for heapify, but I agree with Yonik that it should be exposed as a method.</p>
<p>Looking at their code now I see that they also do the peek() check. It&rsquo;s fairly standard.</p>
<p>The Quickselect method seems like it should be faster, since it uses the previous k-th value as the pivot on each new run (I checked), and that should yield the same pruning as the peek() check during the first pass through the data buffer. The overhead is probably in the array storage before the Quickselect call, and the fact that half the array is already pivoted.</p>
</div>
</li>
<li id="comment-282093" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-22T17:49:43+00:00">June 22, 2017 at 5:49 pm</time></a> </div>
<div class="comment-content">
<p>Yes, it improves the performance, I have updated the blog post.</p>
</div>
</li>
</ol>
</li>
<li id="comment-281973" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d40d912ea09cff5744a3d2d23f345e19?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d40d912ea09cff5744a3d2d23f345e19?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Yingfeng</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-22T00:56:13+00:00">June 22, 2017 at 12:56 am</time></a> </div>
<div class="comment-content">
<p><a href="https://queue.acm.org/detail.cfm?id=1814327" rel="nofollow ugc">https://queue.acm.org/detail.cfm?id=1814327</a><br/>
What about b-heap?</p>
<p>Years before I had performed a benchmark between b-heap and binary heap according to this repository<br/>
<a href="https://github.com/valyala/gheap" rel="nofollow ugc">https://github.com/valyala/gheap</a>, however it had not been proven to be faster than standard std::priority_queue, perhaps it&rsquo;s because of the implementation details which I did not dive into.</p>
</div>
<ol class="children">
<li id="comment-282341" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://boytsov.info" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-26T16:09:36+00:00">June 26, 2017 at 4:09 pm</time></a> </div>
<div class="comment-content">
<p>I ran some rather comprehensive tests. Turns out for moderate-size queues, it&rsquo;s quite hard to beat the binary heap. Perhaps, some years ago caching was a problem, but now it seems to be less of a problem. My tests are available online:<br/>
<a href="https://github.com/searchivarius/BlogCode/tree/master/2016/bench_prio" rel="nofollow ugc">https://github.com/searchivarius/BlogCode/tree/master/2016/bench_prio</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-282072" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c142081bd84e031f1951dc8fa42745f2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c142081bd84e031f1951dc8fa42745f2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://yonik.com" class="url" rel="ugc external nofollow">Yonik Seeley</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-22T13:13:23+00:00">June 22, 2017 at 1:13 pm</time></a> </div>
<div class="comment-content">
<p>Lucene also uses peek to see if a new entry is competitive, but a further important optimization that we make is that we only do a single rebalance of the binary heap.</p>
<p>Rather than add() followed by poll() (each of which will reestablish heap variants), we update the root (the smallest element that peek saw) and fix up the heap once. This cuts the time for a new insert by a factor of 2. </p>
<p>Unfortunately, we don&rsquo;t see this capability in standard heap or priority queue implementations and thus maintain our own.</p>
</div>
<ol class="children">
<li id="comment-282092" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-22T17:49:15+00:00">June 22, 2017 at 5:49 pm</time></a> </div>
<div class="comment-content">
<p>I have updated the blog post with a merged add-poll call and the performance is improved.</p>
</div>
</li>
<li id="comment-282342" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://boytsov.info" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-26T16:11:24+00:00">June 26, 2017 at 4:11 pm</time></a> </div>
<div class="comment-content">
<p>It cuts by a factor of 2 only for small queues. Somewhat unsurprisingly, as you use larger queues, the processing time seems to be dominated by cache misses.</p>
</div>
</li>
</ol>
</li>
<li id="comment-282108" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/266dc7340dbfc62ab9ff7cc3dbe63a0d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/266dc7340dbfc62ab9ff7cc3dbe63a0d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Orhan Ozalp</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-22T20:57:30+00:00">June 22, 2017 at 8:57 pm</time></a> </div>
<div class="comment-content">
<p>Have you tried to use a bigger random number margin? It&rsquo;s going to change priority queue performance because right now, after the first 5000 elements, priority queue values are all between 0 and 5 and this makes it harder to find a smaller value than 5.</p>
</div>
</li>
<li id="comment-282343" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://boytsov.info" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-26T16:12:07+00:00">June 26, 2017 at 4:12 pm</time></a> </div>
<div class="comment-content">
<p>Nice series of posts on priority queues. Why does sort has the largest throughput, do I miss something?</p>
</div>
<ol class="children">
<li id="comment-282348" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-26T18:41:11+00:00">June 26, 2017 at 6:41 pm</time></a> </div>
<div class="comment-content">
<p>Sort has the worst results&#8230;</p>
</div>
</li>
</ol>
</li>
<li id="comment-283476" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4098928029d14e02180e0c427ff1bc60?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4098928029d14e02180e0c427ff1bc60?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://pempek.net/" class="url" rel="ugc external nofollow">Gregory</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-18T13:37:52+00:00">July 18, 2017 at 1:37 pm</time></a> </div>
<div class="comment-content">
<p>Hello Daniel,</p>
<p>I believe that to be fair, you should always go through the comparator function and should write !reverseddefaultcomparator(x, b.peek()) instead of (x &lt; b.peek()).</p>
<p>Also, I implemented a priority queue that remembers a max size and to which you always add(). It&#039;s on par with FastPriorityQueue-KWillets-replaceTop, maybe a bit faster.</p>
<p>After having read the Wikipedia article (<a href="https://en.wikipedia.org/wiki/Binary_heap#Building_a_heap" rel="nofollow ugc">https://en.wikipedia.org/wiki/Binary_heap#Building_a_heap</a>) that states Floyd&#039;s faster than Williams&#039;, I tried to implement add2() that keeps the heap in a &quot;degraded&quot; state:<br/>
&#8211; array[0] is always the min element<br/>
&#8211; I heapify the array once this.size reaches this.maxsize</p>
<p>To my surprise, FastPriorityQueueGP-add2 is much slower than FastPriorityQueueGP-add.</p>
<p>$ node ./test.js<br/>
Platform: darwin 16.6.0 x64<br/>
Intel(R) Core(TM) i7-4960HQ CPU @ 2.60GHz<br/>
Node version 8.1.3, v8 version 5.8.283.41</p>
<p>starting dynamic queue/enqueue benchmark<br/>
FastPriorityQueue-KWillets-replaceTop x 6,522 ops/sec Â±2.40% (87 runs sampled)<br/>
FastPriorityQueueGP-add x 7,234 ops/sec Â±0.77% (91 runs sampled)<br/>
FastPriorityQueueGP-add2 x 4,435 ops/sec Â±1.64% (86 runs sampled)<br/>
sort x 240 ops/sec Â±1.11% (83 runs sampled)</p>
<p><a href="https://gist.github.com/gpakosz/655b087fc4135580c5025870316c4c6e" rel="nofollow ugc">https://gist.github.com/gpakosz/655b087fc4135580c5025870316c4c6e</a></p>
</div>
</li>
</ol>
