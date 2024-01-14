---
date: "2019-06-27 12:00:00"
title: "Bounding the cost of the intersection between a small array and a large array"
index: false
---

[18 thoughts on &ldquo;Bounding the cost of the intersection between a small array and a large array&rdquo;](/lemire/blog/2019/06-27-bounding-the-cost-of-the-intersection-between-a-small-array-and-a-large-array)

<ol class="comment-list">
<li id="comment-414102" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b8cfd5ec0f88bf5b5f2eedda7d1a0746?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b8cfd5ec0f88bf5b5f2eedda7d1a0746?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://www.seebs.net/log/" class="url" rel="ugc external nofollow">seebs</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-27T19:32:39+00:00">June 27, 2019 at 7:32 pm</time></a> </div>
<div class="comment-content">
<p>In our roaring implementation, we have an <code>intersectionCountArrayArray</code>, which does exactly what it sounds like, and during some unrelated benchmarking, I noticed that the performance varied significantly depending on whether the first or second array was larger. Looking at the current code, it appears that we got noticably better performance when the larger array is the inner loop. I think I did look at trying to binary-search instead, but ended up leaving it alone for now. Total amounts of data are smallish (&lt;8KB for each array), and having the accesses be sequential seems to improve cache performance enough to make up for reading more bits than are probably necessary. It&rsquo;s been too long for me to remember the impact of the simple change, but I think that particular op ended up about 20% faster across &ldquo;random&rdquo; cases. (It matters less in practice, since N is nearly always under 5.)</p>
</div>
</li>
<li id="comment-414108" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f38a8dc91f316cac1f78e64de271e215?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f38a8dc91f316cac1f78e64de271e215?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">powturbo</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-27T20:10:13+00:00">June 27, 2019 at 8:10 pm</time></a> </div>
<div class="comment-content">
<p>For two sorted arrays we can use the SVS algorithm see : <a href="http://citeseerx.ist.psu.edu/viewdoc/download?doi=10.1.1.415.2636&#038;rep=rep1&#038;type=pdf" rel="nofollow ugc">http://citeseerx.ist.psu.edu/viewdoc/download?doi=10.1.1.415.2636&#038;rep=rep1&#038;type=pdf</a></p>
<p>For a two levels structure like Roaring-Bitmaps it might be possible to use intersections with skip intervals like in the TurboPFor &ldquo;inverted index&rdquo; demo.</p>
</div>
</li>
<li id="comment-414223" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8378a47a5f4a901d23222cef70df3203?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8378a47a5f4a901d23222cef70df3203?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Lio</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-28T12:35:06+00:00">June 28, 2019 at 12:35 pm</time></a> </div>
<div class="comment-content">
<p>Maybe this is a typo:<br/>
&ldquo;The log of the factorial is almost equal to n log k&rdquo;<br/>
Should have been &ldquo;k log k&rdquo;</p>
</div>
</li>
<li id="comment-414262" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2fb1d0febf487a1d0b6ece2ff02affaa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2fb1d0febf487a1d0b6ece2ff02affaa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christopher Chang</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-28T18:10:37+00:00">June 28, 2019 at 6:10 pm</time></a> </div>
<div class="comment-content">
<p>Ignoring memory hierarchy considerations for the time being, you can approach (log n &#8211; (log k!) / k) comparisons by performing a suitably imbalanced binary search. I.e. when searching the large array for the smallest element in the small array with k = 1000, you first compare against the element at position ~0.693 * (n/1000) in the large array, since that comes the closest to dividing the state space evenly. The principle of dividing the state space evenly can be used to estimate all the other optimal binary search indices (this isn&rsquo;t guaranteed to yield the minimal worst-case number of comparisons, but it should come close enough); and then you can come up with a simple approximation to use to select comparison indices in practice.</p>
</div>
<ol class="children">
<li id="comment-414263" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2fb1d0febf487a1d0b6ece2ff02affaa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2fb1d0febf487a1d0b6ece2ff02affaa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christopher Chang</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-28T18:18:00+00:00">June 28, 2019 at 6:18 pm</time></a> </div>
<div class="comment-content">
<p>More precisely, the approach I just described should do a good job of reducing the average-case # of comparisons. To optimize more for the worst case, you&rsquo;d want to round the first comparison index to a power of 2, and switch to plain binary search once you&rsquo;ve found a larger element in the large array.</p>
</div>
</li>
<li id="comment-414297" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-28T22:05:22+00:00">June 28, 2019 at 10:05 pm</time></a> </div>
<div class="comment-content">
<p>Thanks. I have now sketched something like what you describe in the blog post.</p>
</div>
</li>
<li id="comment-414422" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jörn Engel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-29T18:29:50+00:00">June 29, 2019 at 6:29 pm</time></a> </div>
<div class="comment-content">
<p>Ignoring memory hierarchy won&rsquo;t work in practice. A regular binary search will hit L1 most of the time, as the indices are the same as from the previous binary search. By doing something fancy like binary search of an array subset, we reduce the number of memory lookups, but frequently go to L3 or DRAM instead. L3 is 10x more expensive than L1, DRAM is 50x more expensive.</p>
<p>But we could do something like evenly divide the large array into 1024 fixed subsets. Make a guess which subset contains what you are searching for. If you guessed right, you saved yourself the first 10 steps of binary search. If you guessed wrong, you can merge subsets following buddy-allocator rules. That way you keep reusing the same indices, so they are likely in L1.</p>
<p>Now I wonder how far that approach could be extended. One way to deal with latency is to replace bisection with octasection. I use that approach for git bisection already &#8211; if tests take a long time, but you can run them in parallel, octasection is 3x faster while doing 2.3x more work. But bisection is doing a single search. For intersection, you can do multiple searches in parallel and get a speedup without doing 2.3x more work, so probably not a good idea.</p>
<p>But you could just do a streaming lookup of the edges between the 1024 subsections. That removes the guessing. With k=1000, you expect to continue the search in most of those subsections, so effectively you just removed the 10 (fast) lookups at the beginning. In Daniels table, that means 22-10=12 lookups, which seems impressive, but remember that the remaining 12 lookups are likely cache-cold and 10x more expensive. So overall more like a 5% improvement, not 50%.</p>
</div>
<ol class="children">
<li id="comment-414740" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-01T14:47:15+00:00">July 1, 2019 at 2:47 pm</time></a> </div>
<div class="comment-content">
<p><em>Ignoring memory hierarchy won’t work in practice.</em></p>
<p>I agree.</p>
</div>
</li>
<li id="comment-414766" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/750ecd0b942a57f278fc2fb3e27fc240?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/750ecd0b942a57f278fc2fb3e27fc240?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jörn Engel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-01T17:51:37+00:00">July 1, 2019 at 5:51 pm</time></a> </div>
<div class="comment-content">
<p>There is another optimization we can copy from various sort-implementations. Things like quicksort and binary search work great when your n is large. But after enough divisions, the remaining set is small and things like bubble sort or linear search can outperform the fancy algorithms. Most sort-implementations eventually fall back to something like bubble-sort when dealing with leaves.</p>
<p>Here the obvious choice would be to stop bisections once you reached 1-2 cachelines and do linear search within the remainder. Or to vectorize the compare, movemask and tzcnt to find the precise index without branches.</p>
<p>If you have 4-byte integers in 64-byte cachelines, you replace the last 4-5 compares with this. Again, benefit is relatively low because we optimize the cheap L1 accesses, not the expensive ones.</p>
<p>If the goal is to replace the expensive accesses, I&rsquo;d try to do better than binary search. If you have a search window of 100 values between 0 and 1000 and are searching for 20, the assumption would be that you&rsquo;re looking for the second entry or one very close to that. If the values are typically spread very evenly, you can guess a tight search window and skip a lot of bisections. If the value are clumped with random patterns, you need a wide search window and might revert back to binary search.</p>
<p>You could try to hard-code whether you assume random clumps are even distribution. Or you could do a feedback loop, where future searches are influenced by past searches. If guessing worked well in the past, do more guessing. If not, fall back to binary search.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-414267" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-28T18:39:52+00:00">June 28, 2019 at 6:39 pm</time></a> </div>
<div class="comment-content">
<p><a href="http://citeseerx.ist.psu.edu/viewdoc/summary?doi=10.1.1.419.8292" rel="nofollow">Hwang and Lin</a> have a similar bound in their paper, although they use a slightly different choice formulation (it appears you allow duplicates). Their lower bound is basically log2((n+k) choose k).</p>
<p>The UB complexity of their algorithm g is similar: log(n/k) and change. It comes from probing the n/k-th element first and binary-searching within that range only.</p>
</div>
<ol class="children">
<li id="comment-414269" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-28T18:49:57+00:00">June 28, 2019 at 6:49 pm</time></a> </div>
<div class="comment-content">
<p>Interesting reference. Though I have not read it, I have come away with a similar idea.</p>
</div>
</li>
<li id="comment-414298" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-28T22:05:43+00:00">June 28, 2019 at 10:05 pm</time></a> </div>
<div class="comment-content">
<p>Right. And it is a bit like what Christopher (another commenter) described.</p>
</div>
<ol class="children">
<li id="comment-414299" class="comment byuser comment-author-lemire bypostauthor even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-28T22:06:03+00:00">June 28, 2019 at 10:06 pm</time></a> </div>
<div class="comment-content">
<p>And N. Kurz also privately alluded to the same idea, months ago.</p>
</div>
<ol class="children">
<li id="comment-414305" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-28T23:05:02+00:00">June 28, 2019 at 11:05 pm</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s in Knuth 😉</p>
</div>
<ol class="children">
<li id="comment-414402" class="comment byuser comment-author-lemire bypostauthor even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-29T15:12:10+00:00">June 29, 2019 at 3:12 pm</time></a> </div>
<div class="comment-content">
<p>Of course, it would be in Knuth.</p>
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
<li id="comment-415878" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/910303b69297a0c162bdc83f5fe957a6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/910303b69297a0c162bdc83f5fe957a6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jim Apple</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-06T05:36:16+00:00">July 6, 2019 at 5:36 am</time></a> </div>
<div class="comment-content">
<p>I think you can do this in the same time bound (big O, not exact) by iterating over the smaller array in order and doing exponential search in the larger array from the front until you exceed the sought-for key, then doing binary search on the induced prefix of the larger array. On the next key from the smaller array, start your exponential search in the larger array at the index you stopped at in the previous search.</p>
<p>If the ith search covers b_i range in the indexes of the larger array, the total cost is 2 * sum(lg b_i), where sum(b_i) &lt; 2n. Since lg is convex, the cost is maximized when all the b_i’s are equal, so lg (2n/k).</p>
<p>I suspect the constant factors could be eliminated by reusing more of the exponential overshoot when searching subsequent keys.</p>
</div>
<ol class="children">
<li id="comment-415981" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-06T15:11:32+00:00">July 6, 2019 at 3:11 pm</time></a> </div>
<div class="comment-content">
<p>Thanks. This algorithm is described in the reference I offer&#8230; <a href="https://arxiv.org/abs/1401.6399" rel="nofollow">SIMD Compression and the Intersection of Sorted Integers</a>, Software: Practice and Experience 46 (6), 2016. In this instance, I am concerned with constants and caching&#8230; so whether this is the best algorithm is in question.</p>
<p>(I will come back on this topic later, on this blog.)</p>
</div>
<ol class="children">
<li id="comment-416162" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1ac5b20d794793b8d6967ae5fff5cb5d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1ac5b20d794793b8d6967ae5fff5cb5d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jim Apple</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-07T06:26:11+00:00">July 7, 2019 at 6:26 am</time></a> </div>
<div class="comment-content">
<p>As far as caching goes, if the large array is arranged as a level-linked B-tree with parent pointers, I think the exponential search algorithm turns into a finger search algorithm with cost O(k log_B (n/k)).</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
