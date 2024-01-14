---
date: "2017-05-23 12:00:00"
title: "Counting exactly the number of distinct elements: sorted arrays vs. hash sets?"
index: false
---

[23 thoughts on &ldquo;Counting exactly the number of distinct elements: sorted arrays vs. hash sets?&rdquo;](/lemire/blog/2017/05-23-counting-exactly-the-number-of-distinct-elements-sorted-arrays-vs-hash-sets)

<ol class="comment-list">
<li id="comment-280264" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7c817f972df58e0bbda28335dc05f641?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7c817f972df58e0bbda28335dc05f641?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Rob</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-23T18:20:09+00:00">May 23, 2017 at 6:20 pm</time></a> </div>
<div class="comment-content">
<p>Very interesting post, Daniel (as always!). One thing that is probably worth at leadt mentioning is that the hash approach can apply in situations where the sorting approach might not (e.g., when the elements don&rsquo;t have a total ordering &#8212; or any orderibg at all), since it only requires hashing and equality operations, whole sorting requires less-than comparability. Though, usually, one could come up with an irderibg thasy works for this purpose, even if it&rsquo;s not completely natural.</p>
</div>
<ol class="children">
<li id="comment-280265" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7c817f972df58e0bbda28335dc05f641?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7c817f972df58e0bbda28335dc05f641?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Rob</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-23T18:22:32+00:00">May 23, 2017 at 6:22 pm</time></a> </div>
<div class="comment-content">
<p>P.S. sorry for the mis-spellings; I&rsquo;m on a new mobile phone :P.</p>
</div>
</li>
<li id="comment-280267" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-23T18:44:36+00:00">May 23, 2017 at 6:44 pm</time></a> </div>
<div class="comment-content">
<p>There are other benefits to the hash set approach, such as the fact that it can maintain counts dynamically.</p>
<p>However, the sorting approach can be optimized far more than in my example. There is no good reason to actually fully sort the data and the call to <tt>unique</tt> is easy to optimize.</p>
</div>
<ol class="children">
<li id="comment-280269" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-23T19:29:05+00:00">May 23, 2017 at 7:29 pm</time></a> </div>
<div class="comment-content">
<p>Sorting a multiset is actually O(Hn), since you get back the work of sorting the duplicates. For ternary quicksort I think you can also just modify it to count how many times it gets called, since each call consumes a unique pivot value.</p>
<p>Are you interested in doing a similar comparison for strings?</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-280271" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2c1dd4727d07c7dbb6ff8c3a83e400b5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2c1dd4727d07c7dbb6ff8c3a83e400b5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tony Delroy</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-23T20:06:05+00:00">May 23, 2017 at 8:06 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for the post &#8211; it&rsquo;s an useful insight that hashing may not be fastest. Couple factors though for consideration&#8230;.</p>
<p>When the input includes many duplicate values, the vector approach needs to store the full data set in memory whereas the hash table approach only needs to retain the distinct elements &#8211; past a point that can be the difference between driving the machine into heavy swapping and running just fine.</p>
<p>std::unordered_set is not a particularly good choice for this, as it&rsquo;s implemented as a vector of iterators into a linked list. A hash table implementation that uses open addressing (aka closed hashing) should outperform it &#8211; I think my old benchmarks that show about an order of magnitude difference should be applicable here, but unfortunately there&rsquo;s no such implementation in the Standard Library that makes that easy for you to try.</p>
<p>When the performance is dominated by the time it takes to read in the values, the hash table approach has the advantage of doing its work gradually as the input becomes available, so the final count of unique elements is available almost immediately after the final input&rsquo;s processed. That contrasts with the vector approach, where std::sort and std::unique are easiest to do after all the values are known, though there are some optimisation options for doing some of the work earlier.</p>
</div>
<ol class="children">
<li id="comment-280275" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-23T20:26:03+00:00">May 23, 2017 at 8:26 pm</time></a> </div>
<div class="comment-content">
<p>@Tony</p>
<p><em>When the performance is dominated by the time it takes to read in the values, the hash table approach has the advantage of doing its work gradually as the input becomes available, so the final count of unique elements is available almost immediately after the final input&rsquo;s processed. That contrasts with the vector approach, where std::sort and std::unique are easiest to do after all the values are known, though there are some optimisation options for doing some of the work earlier.</em></p>
<p>Absolutely, the hash set is the best way (out of the two options) to solve the problem the problem online, without delay.</p>
<p><em>When the input includes many duplicate values, the vector approach needs to store the full data set (&#8230;)</em></p>
<p>I address this point I believe with the paragraph that starts with &ldquo;Simple engineering considerations do ensure that as long as the number of distinct elements is small (&#8230;)&rdquo;.</p>
<p><em>std::unordered_set is not a particularly good choice for this, as it&rsquo;s implemented as a vector of iterators into a linked list.</em></p>
<p>Open addressing, given enough data, will also be hurting from cache misses. I debated about whether extending the benchmark to include other implementations, but, in the end, I decided against it for the sake of simplicity. The same conclusion would apply, with different numbers.</p>
</div>
</li>
</ol>
</li>
<li id="comment-280272" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/25999b45c3bd15412dbf85ca281cde8f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/25999b45c3bd15412dbf85ca281cde8f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Peter Boothe</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-23T20:13:52+00:00">May 23, 2017 at 8:13 pm</time></a> </div>
<div class="comment-content">
<p>It intuitively feels like you might be able to do even better with a modification of 3-way quicksort that throws away all elements equal to the pivot. Then, once the array is sorted, it also contains the right number of elements.</p>
</div>
<ol class="children">
<li id="comment-280273" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-23T20:15:37+00:00">May 23, 2017 at 8:15 pm</time></a> </div>
<div class="comment-content">
<p>I agree that it ought to be possible to do much better but I wanted two-three lines of code.</p>
</div>
</li>
</ol>
</li>
<li id="comment-280276" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7838ac992b785b1bee4535637ae96ad9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7838ac992b785b1bee4535637ae96ad9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alex Poliakov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-23T20:52:47+00:00">May 23, 2017 at 8:52 pm</time></a> </div>
<div class="comment-content">
<p>Cool! I think another interesting aspect of hashing worth mentioning is hash collisions &#8211; meaning that insertions into a hash table are no longer O(1) even regardless of the CPU cache problem. And then, of course, rehashing is often used to &ldquo;fix&rdquo; that as the table grows. Also not a cheap operation.</p>
<p>But a hybrid method is quite approachable. Start with the hash table. After the table exceeds some number of distinct elements, fall back to a sort. That method would adapt fairly well to various datasets.</p>
</div>
<ol class="children">
<li id="comment-280277" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-23T21:29:41+00:00">May 23, 2017 at 9:29 pm</time></a> </div>
<div class="comment-content">
<p><em>I think another interesting aspect of hashing worth mentioning is hash collisions â€“ meaning that insertions into a hash table are no longer O(1) even regardless of the CPU cache problem</em></p>
<p>In this instance, collisions are not the problem. You can increase the capacity of the hash table, and it won&rsquo;t fix the issue&#8230; it might even make it worse.</p>
<p><em>But a hybrid method is quite approachable. Start with the hash table. After the table exceeds some number of distinct elements, fall back to a sort. That method would adapt fairly well to various datasets.</em></p>
<p>Yes.</p>
</div>
</li>
</ol>
</li>
<li id="comment-280287" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1e95595d7f541d5b27a1b7d841f0b30f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1e95595d7f541d5b27a1b7d841f0b30f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://tromp.github.io/" class="url" rel="ugc external nofollow">John Tromp</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-24T02:11:24+00:00">May 24, 2017 at 2:11 am</time></a> </div>
<div class="comment-content">
<p>Copying my comment from the Hacker News thread on your blog entry (<a href="https://news.ycombinator.com/item?id=14403840" rel="nofollow ugc">https://news.ycombinator.com/item?id=14403840</a>) :</p>
<p>Just weeks ago, I had to pay out a $5000 bounty on my Cuckoo Cycle proof of work scheme [1], because I had wrongly assumed that hash sets were faster, even though the hash set was reduced to a simple bitmap.</p>
<p>Where the article considers up to 10M elements,<br/>
Cuckoo Cycle deals with about a billion elements,<br/>
thus answering the question of what happens when cranking up the data size. It turns out that despite using 32x to 64x more memory than the bitmap, sorting is about 4x faster.</p>
<p>Blog entry [2] explains how Cuckoo Cycle reduces to a counting problem.</p>
<p>[1] <a href="https://github.com/tromp/cuckoo" rel="nofollow ugc">https://github.com/tromp/cuckoo</a><br/>
[2] <a href="http://cryptorials.io/beyond-hashcash-proof-work-theres-mining-hashing" rel="nofollow ugc">http://cryptorials.io/beyond-hashcash-proof-work-theres-mining-hashing</a></p>
</div>
</li>
<li id="comment-280288" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/903177d449b90a4991ab4cf25da90bc1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/903177d449b90a4991ab4cf25da90bc1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Giuseppe Ottaviano</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-24T02:30:17+00:00">May 24, 2017 at 2:30 am</time></a> </div>
<div class="comment-content">
<p>This is not exactly a fair comparison, unordered_set is a bad hash table for small types because it does one allocation per entry. So you&rsquo;re really benchmarking the allocator, not the hash table. This is not even about open vs closed addressing.<br/>
Try google::dense_hash_set for a reasonably good hash table.</p>
</div>
</li>
<li id="comment-280294" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://zeuxcg.org" class="url" rel="ugc external nofollow">Arseny Kapoulkine</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-24T04:16:38+00:00">May 24, 2017 at 4:16 am</time></a> </div>
<div class="comment-content">
<p>Daniel, I believe your conclusion is incorrect. You aren&rsquo;t really comparing sorting an array to a hash set &#8211; you a comparing a particular (maybe slow?) sort implementation to a particular (slow!) hash set implementation. Your problem isn&rsquo;t just cache misses, it&rsquo;s a lot of things &#8211; an allocation per unordered_set insertion is one of them.</p>
<p>I have tried to solve this problem for a set of 32-bit integers and the fastest solution was a well tuned hash set, similar to Google&rsquo;s dense hash set.</p>
<p>Here&rsquo;s the same hash set adapted for this problem, in your benchmark: <a href="https://gist.github.com/zeux/e271d172b820e67bebd565a9cd13de30" rel="nofollow ugc">https://gist.github.com/zeux/e271d172b820e67bebd565a9cd13de30</a></p>
<p>In this case for 10M elements I get 170 cycles/element for the hash and 260 cycles/element for sort. I haven&rsquo;t profiled or instrumented the resulting hash code, it might be that the hash function isn&rsquo;t a very good one in this case.</p>
<p>Now, the sort is also not necessarily the fastest possible in this case; for my problem (with 32-bit integers) a 3-step radix sort was faster than std::sort but that still wasn&rsquo;t enough to beat the hash. Maybe this case is different &#8211; I didn&rsquo;t analyze this in detail.</p>
</div>
<ol class="children">
<li id="comment-280295" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://zeuxcg.org" class="url" rel="ugc external nofollow">Arseny Kapoulkine</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-24T04:24:20+00:00">May 24, 2017 at 4:24 am</time></a> </div>
<div class="comment-content">
<p>Updated the gist with a slightly better hash function, now it&rsquo;s 145 cycles vs 260 cycles. I will leave exploring other sort options, such as radix, to somebody else, although radix will probably lose here because it will require many passes (around 6) and have significant issues wrt cache as well.</p>
</div>
</li>
<li id="comment-280303" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f9ed6413b67cfa6ddc0a37675d9e065a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f9ed6413b67cfa6ddc0a37675d9e065a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stefano Miccoli</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-24T09:35:21+00:00">May 24, 2017 at 9:35 am</time></a> </div>
<div class="comment-content">
<p>Maybe you (Arseny) are right, but there is nothing magical in the 10M point. You should provide an estimate of the asymptotics of your implementation, ant not just a single point. Maybe for your implementation the crossover between hash sets and sorting is just father away&#8230;</p>
</div>
<ol class="children">
<li id="comment-280312" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8af88bac916c9bf3f45831c114d30b0e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8af88bac916c9bf3f45831c114d30b0e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://iki.fi/jouni.siren/" class="url" rel="ugc external nofollow">Jouni</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-24T11:05:45+00:00">May 24, 2017 at 11:05 am</time></a> </div>
<div class="comment-content">
<p>I tried hashing vs sorting with larger amounts of data:</p>
<p>10M elements: 146 vs 259 cycles (hashing vs sorting)<br/>
100M elements: 169 vs 285 cycles<br/>
1G elements: 199 vs 322 cycles<br/>
8G elements: 286 vs 364 cycles</p>
<p>Of course, the real difference with 8G elements is memory usage: 187 vs 119 GB. If we can work in-place, the memory usage of the sorting-based method is reduced to 60 GB.</p>
<p>I also tried the multithreaded std::sort implementations from libstdc++ parallel mode. When working in-place, I got the following improvements over the sequential version with 8G elements and 32 threads:</p>
<p>Quicksort: 5.5x speedup, same memory usage<br/>
Mergesort: 9.6x speedup, 2x memory usage</p>
<p>I wonder how the hashing-based algorithm would work with tens of threads.</p>
</div>
<ol class="children">
<li id="comment-280322" class="comment even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://zeuxcg.org" class="url" rel="ugc external nofollow">Arseny Kapoulkine</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-24T16:02:47+00:00">May 24, 2017 at 4:02 pm</time></a> </div>
<div class="comment-content">
<p>Thanks, this is good data. I&rsquo;m not sure how to exactly explain the slow deterioration of performance for hash set &#8211; the only thing that comes to mind is that TLB misses grow more and more expensive as you need more levels in the page table hierarchy and/or more cache misses *into* the page table structure. Is this using 4K pages, and if so, can you try using huge pages if this is an option? (not sure what the system you&rsquo;re testing is).</p>
<p>I don&rsquo;t think it&rsquo;s straightforward to implement the hashing algorithm on multiple threads assuming that the input set is mostly unique (if it has high redundancy ratio then doing a unique pass with local hash tables will probably be a win). If you do have a few hundred gigabytes of memory and a matching dataset, multithreaded sorting followed by merging might be a faster solution overall (you can even do a unique count without actually merging, so the entire algorithm can work in place) &#8211; although 6x speedup on 32 threads is not as exciting as it could have been :).</p>
</div>
<ol class="children">
<li id="comment-280327" class="comment odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8af88bac916c9bf3f45831c114d30b0e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8af88bac916c9bf3f45831c114d30b0e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://iki.fi/jouni.siren/" class="url" rel="ugc external nofollow">Jouni</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-24T17:55:20+00:00">May 24, 2017 at 5:55 pm</time></a> </div>
<div class="comment-content">
<p>Slower random access due to TLB misses is the expected behavior with large arrays. You could avoid it with hugepages, but that seems a bit artificial, as you usually cannot expect hugepages in a production system. (I also can&rsquo;t test it myself, as I don&rsquo;t have root access to the system I run my benchmarks on.)</p>
<p>The last test with 8G elements also ran into a NUMA bottleneck. As the system has two Opterons and 256 GB memory, the first 64 GB (the original data) is in local memory, while there rest (the hash table) is in non-local memory.</p>
<p>The &ldquo;perfect&rdquo; speedup from 32 threads tends to be around 18x on that system. CPU frequency goes down whan all cores are running, the memory bottleneck gets worse, and the data is usually in non-local memory. Mergesort achieved half of that, which is a bit worse than what I expected, while the slower quicksort reached 1/3.</p>
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
<li id="comment-280302" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/94c891e24b3a17b6f647d433872ce118?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/94c891e24b3a17b6f647d433872ce118?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Danny Birch</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-24T09:06:41+00:00">May 24, 2017 at 9:06 am</time></a> </div>
<div class="comment-content">
<p>I think the O(1)/O(N lg N) comparison you make is a little misleading, you compare sorting an array of N elements and inserting 1 element into a hash map, I think it should be O(N) with a single insertion being O(1). Your point will still remain valid.</p>
<p>Good research!</p>
</div>
</li>
<li id="comment-280320" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6c8eec48ab6414b4983a292826bed6cf?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6c8eec48ab6414b4983a292826bed6cf?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Doug</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-24T15:56:52+00:00">May 24, 2017 at 3:56 pm</time></a> </div>
<div class="comment-content">
<p>Great post! I was curious how Judy arrays would stack up, so I modified your code a bit and wrote a blog post with the results:</p>
<p><a href="https://logperiodic.com/blog/2017/05/counting-distinct-elements-judy-arrays" rel="nofollow ugc">https://logperiodic.com/blog/2017/05/counting-distinct-elements-judy-arrays</a></p>
</div>
</li>
<li id="comment-280421" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/969f14c388e980e308be0d2decf47924?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/969f14c388e980e308be0d2decf47924?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">HA2</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-26T07:00:21+00:00">May 26, 2017 at 7:00 am</time></a> </div>
<div class="comment-content">
<p>Sounds like there&rsquo;s a few lessons to potentially be learned here&#8230;</p>
<p>The first is one I hear a lot from people trying to do optimization &#8211; you have to focus not on &ldquo;operations&rdquo; as is common in College CS 101 but on data access, specifically cache misses of various types. Doesn&rsquo;t matter how few operations you do if your algorithm accidentally causes data to be written to a hard drive in the middle of it.</p>
<p>The second is that there&rsquo;s no substitute for real-world testing. You can write out the &ldquo;algorithm&rdquo; on paper as much as you want, but reality has all sorts of messy edge cases that can dominate, and the implementation matters a lot (see previous point). </p>
<p>Nice post!</p>
</div>
</li>
<li id="comment-280507" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Oren Tirosh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-27T17:21:13+00:00">May 27, 2017 at 5:21 pm</time></a> </div>
<div class="comment-content">
<p>With multiple threads a hash table suffers from serious synchronization overhead issues. Locking and atomics have both an immediate cost and a secondary cost in inter-CPU synchronization of shared cache rows (whether false or true sharing). It is possible to use a hash table per thread and merge them later but I don&rsquo;t think it&rsquo;s likely to be worth it.</p>
<p>Merge sort has excellent memory prefetch behavior &#8211; straight linear reads. At the top levels of the merge sort recursion it may be better to use the non-temporal memory access instructions that do not update the cache &#8211; it will be too long before these locations are accessed again for it to have any effect and cache contention can be minimized for the benefit of other (hyper)threads that share some of the same cache layers.</p>
<p>QuickSort and friends with access patterns that jump around are less prefetch-friendly but will better benefit from caching &#8211; as long as they fit in the cache. Below a certain size threshold it pays to switch to a quicksort or even insertion sort for the deeper levels of the merge sort recursion. </p>
<p>A variation of merge sort that stores counts of repeated unique values instead of actually repeating the value could make a significant improvement, unless the values are mostly unique. Some clever encoding to avoid having lots of &ldquo;1&rdquo; counts take extra space could overcome that and be the overall winner for all value distributions.</p>
</div>
</li>
<li id="comment-306199" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6551768bdd8c7dd86d258753cb2f7e9d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6551768bdd8c7dd86d258753cb2f7e9d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Valentin Deleplace</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-31T12:17:50+00:00">May 31, 2018 at 12:17 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for this concise reminder that big-O doesn&rsquo;t tell the whole story.</p>
<p>Log <strong><em>n</em></strong> grows so slowly that I usually consider it as a constant factor, that can often be dwarfed by other down-to-earth hidden factors including slow allocations, CPU-cache-misses, etc.</p>
<p>I love this quote from Damian Gryski in &ldquo;Slices: Performance through cache-friendliness&rdquo;<br/>
<a href="https://www.youtube.com/watch?v=jEG4Qyo_4Bc" rel="nofollow ugc">https://www.youtube.com/watch?v=jEG4Qyo_4Bc</a> :<br/>
&ldquo;What <strong><em>n</em></strong> needs to be in order to be considered <em>small</em> &#8230; is getting bigger all the time.&rdquo;</p>
</div>
</li>
</ol>
