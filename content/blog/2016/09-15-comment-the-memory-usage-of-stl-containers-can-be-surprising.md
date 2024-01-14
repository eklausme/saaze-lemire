---
date: "2016-09-15 12:00:00"
title: "The memory usage of STL containers can be surprising"
index: false
---

[20 thoughts on &ldquo;The memory usage of STL containers can be surprising&rdquo;](/lemire/blog/2016/09-15-the-memory-usage-of-stl-containers-can-be-surprising)

<ol class="comment-list">
<li id="comment-252470" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/956220eebc5804eceb81539142452c88?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/956220eebc5804eceb81539142452c88?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Marcus Ritt</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-15T16:33:01+00:00">September 15, 2016 at 4:33 pm</time></a> </div>
<div class="comment-content">
<p>There&rsquo;s also std::forward_list, which has pointer less and thus consumes less, as expected (16b on my Linux box).</p>
</div>
</li>
<li id="comment-252473" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-15T16:52:21+00:00">September 15, 2016 at 4:52 pm</time></a> </div>
<div class="comment-content">
<p>It looks as though you are counting memory allocated without the overhead of heap structures &#8230; which could possibly add up to quite a lot.</p>
</div>
<ol class="children">
<li id="comment-252476" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-15T17:18:35+00:00">September 15, 2016 at 5:18 pm</time></a> </div>
<div class="comment-content">
<p>Yes, the numbers I offer are &ldquo;optimistic&rdquo;. I am assuming that the overhead is a constant quantity that becomes irrelevant if you have enough data.</p>
</div>
<ol class="children">
<li id="comment-252500" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/344d0650594b40c684cd8a536cc760d5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/344d0650594b40c684cd8a536cc760d5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://vlsiblog.coloquinte.net" class="url" rel="ugc external nofollow">Gabriel Gouvine</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-15T20:32:30+00:00">September 15, 2016 at 8:32 pm</time></a> </div>
<div class="comment-content">
<p>In practice, you can expect 16B overhead per heap allocation (64b glibc malloc, but most do the same AFAIK). There is a single allocation for the vector/deque, but one per element for the others, so not quite negligible.</p>
<p>At first I was puzzled with your results for unordered_set and deque, but it makes sense.<br/>
unordered_set uses singly-linked buckets and stores the hash: already 24B/node + a table of pointers. deque (like vector) overallocates: depending on the size you will measure different overheads but 2x isn&rsquo;t surprising.</p>
</div>
</li>
<li id="comment-252507" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-15T21:19:27+00:00">September 15, 2016 at 9:19 pm</time></a> </div>
<div class="comment-content">
<p>Depends on whether the STD code does lots of small allocations, and the heap implementation. My guess is there at least one word of overhead, per allocation.</p>
</div>
<ol class="children">
<li id="comment-252513" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-15T21:39:46+00:00">September 15, 2016 at 9:39 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s a good point. I am not sure how to improve my benchmark to take this into account. Got any ideas? I can track carefully all allocations, I just don&rsquo;t know how to measure their *actual* cost. Any standard way to do that?</p>
</div>
</li>
</ol>
</li>
<li id="comment-252515" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-15T21:55:07+00:00">September 15, 2016 at 9:55 pm</time></a> </div>
<div class="comment-content">
<p>Sorry, that was an incomplete statement. You want to compute the number of allocations, and thus the average size of an allocation. The overhead is usually fixed per allocation, usually at least one (32-bit or 64-bit) word. Depends on the heap manager code. (I have not looked at the GNU library heap code in a few decades. Your runtime library may be different.)</p>
<p>Note also that the general-purpose heap manager has a compute cost on allocation and de-allocation. When the pattern of usage is not random, you can use allocation pools (few/large allocations from the general-purpose heap) and free-lists to make huge reductions in memory and CPU usage.</p>
<p>I only use C++ when I need bare-metal performance, so these optimizations are usually relevant.</p>
<p>If you do a lot of allocation/de-allocation of large numbers of small items, the cost of the heap can a problem. </p>
<p>The general purpose heap code has to be thread-safe, which adds an additional cost. Application code can often be made thread-safe at a higher level, with lower cost.</p>
<p>You theme in this post is exactly relevant. I use C++ when I need bare-metal performance. STL is a general purpose library, that puts generality ahead of performance. Frankly, writing exactly-focused array/list/hash classes is pretty easy. So &#8230; why would I use STL?</p>
<p>Of course, some parts of even highly performant applications do not need to be especially efficient. Perhaps STL is a good fit there. </p>
<p>If I had deep knowledge of the STL implementation, I would know when the STL code was as efficient as the code I might write. That knowledge would require an investment of time. If I can write an write an equivalent class in the same time, hard to justify the time to study (and periodically re-studying) the STL.</p>
<p>If I were not very good at understanding and implementing algorithms, using the STL written by (hopefully) better programmers would be an excellent idea. I would have a very hard time justifying that case, as I believe we are long past the time when average programmers should be using C++.</p>
<p>Which leaves the STL in an odd corner.</p>
</div>
<ol class="children">
<li id="comment-252551" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-16T15:39:31+00:00">September 16, 2016 at 3:39 pm</time></a> </div>
<div class="comment-content">
<p>It is true in any language that most of the code you write does not need to be particularly fast or memory conscious. The bottlenecks are often very specific. </p>
<p>In C++, at least, you can rewrite the problematic code so it is fast and memory conscious.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-252509" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e2235dec7378abc2a23d8a76c2efba02?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e2235dec7378abc2a23d8a76c2efba02?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">davetweed</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-15T21:28:50+00:00">September 15, 2016 at 9:28 pm</time></a> </div>
<div class="comment-content">
<p>Particularly with respect to the unordered_set, there&rsquo;s the question of whether it&rsquo;s &ldquo;abstraction&rdquo; or &ldquo;uniformity&rdquo; that&rsquo;s the problem. From my (admittedly poor) understanding, the C++ specification of an unordered_set and its behaviour with respect to object storage pretty much requires a hash table with separate chaining in the buckets for an unknown general class. In that case the memory usage is maybe double what you might hope to achieve with really careful optimization. As you say, for a type like an int32_t you can use other representations to use much less memory and still get &ldquo;as if&rdquo; behaviour with respect to the guarantees stated in the standard. At which point it becomes a question: should the STL include such specialisations of the STL containers, or would that be better done in a different library (boost, or something different yet again)?</p>
<p>I don&rsquo;t know the answer to that question, but I do know (from working at companies who have &ldquo;reimplemented the STL to be more efficient&rdquo;) that something that violates the guarantees in the standard discussed all over the place (stackoverflow answers, etc) in some corner cases is NOT a nice programming environment.</p>
</div>
<ol class="children">
<li id="comment-252512" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-15T21:38:44+00:00">September 15, 2016 at 9:38 pm</time></a> </div>
<div class="comment-content">
<p>My instinct would not be to reimplement STL. Rather, I would create new, specialized data structures with their own documentation and API.</p>
</div>
</li>
</ol>
</li>
<li id="comment-252550" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://blog.lbs.ca/technology" class="url" rel="ugc external nofollow">Dominic Amann</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-16T15:25:39+00:00">September 16, 2016 at 3:25 pm</time></a> </div>
<div class="comment-content">
<p>Of course, the biggest &ldquo;problem&rdquo; I see with stl containers is that people either use the wrong one for their job (and performance requirements is part of that), or they fail to use them (and implement their own).</p>
<p>The problem in the real (non academic) world with implementing one&rsquo;s own &ldquo;super efficient&rdquo; version, is that people in the private sector switch jobs frequently, and it is often the case that one has to take over code written by someone else. For all its flaws (which are few in my view), the stl is well documented and understood. Joe Blows&rsquo; super-set class &#8211; less so. The limitations of Joe Blows&rsquo; super-set class will have long been forgotten until they manifest as bugs when someone uses the class in a manner which only Joe knew would not be supported.</p>
<p>We have been using the boost libraries for some time, and we find they offer true (cross platform) portability, and substantially reduce bug counts, while maintaining or improving performance. I haven&rsquo;t noticed memory utilization go up over our legacy code &#8211; but then our legacy code had many leaks and corner case that never worked properly.</p>
</div>
<ol class="children">
<li id="comment-252553" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-16T15:45:57+00:00">September 16, 2016 at 3:45 pm</time></a> </div>
<div class="comment-content">
<p><em>The problem in the real (non academic) world with implementing one&rsquo;s own â€œsuper efficientâ€ version, is that people in the private sector switch jobs frequently, and it is often the case that one has to take over code written by someone else. For all its flaws (which are few in my view), the stl is well documented and understood. Joe Blows&rsquo; super-set class â€“ less so. The limitations of Joe Blows&rsquo; super-set class will have long been forgotten until they manifest as bugs when someone uses the class in a manner which only Joe knew would not be supported.</em></p>
<p>You may have noticed that my blog post was not critical at all of STL. I share your feeling. STL is well known, well tested, well documented. *Except* that when it comes to performance-sensitive tasks, STL can be tricky.</p>
<p>I&rsquo;d like to respond to your criticism of &ldquo;academic work&rdquo;. I don&rsquo;t think it is particularly common for academics to write their own data structure code. That&rsquo;s probably a lot more common in industry.</p>
<p>Academic software is slow and broken, but that&rsquo;s not because the authors shy away from things like STL.</p>
</div>
</li>
</ol>
</li>
<li id="comment-252580" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/550c4685cffaf969c61caed723964d11?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/550c4685cffaf969c61caed723964d11?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/greg7mdp/sparsepp" class="url" rel="ugc external nofollow">Greg Popovitch</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-17T00:43:54+00:00">September 17, 2016 at 12:43 am</time></a> </div>
<div class="comment-content">
<p>Indeed, the memory usage of std::unordered_set can be a serious issue for big data problems. In that case, consider using the sparse_hash_set from sparsepp, which is faster than std::unordered_set, but can fit 2 to 3 times more integers in the same memory. <a href="https://github.com/greg7mdp/sparsepp" rel="nofollow ugc">https://github.com/greg7mdp/sparsepp</a></p>
</div>
</li>
<li id="comment-252609" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c85e35facf190a19fcc185d47ccb8778?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c85e35facf190a19fcc185d47ccb8778?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bender</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-17T11:41:01+00:00">September 17, 2016 at 11:41 am</time></a> </div>
<div class="comment-content">
<p>Hi,<br/>
article is good but it misses some important stuff that would make it much better:<br/>
Overhead is constant per element, so if you had sets of shorts it would look even worse for structures with pointers. If you used<br/>
struct Point that has 2 doubles overhead would be smaller. </p>
<p>Also vector has 0 overhead only if you know its size in advance and you do reserve. Naive push_back (that is sometimes needed when you do no know how many elements you will get) can cause a lot of waste. Resize factor for gcc is 2 so in theory 49.99% of memory can be wasted.<br/>
<a href="https://github.com/facebook/folly/blob/master/folly/docs/FBVector.md" rel="nofollow ugc">https://github.com/facebook/folly/blob/master/folly/docs/FBVector.md</a></p>
</div>
<ol class="children">
<li id="comment-252794" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-19T14:10:17+00:00">September 19, 2016 at 2:10 pm</time></a> </div>
<div class="comment-content">
<p>I should point out that this was *measured* memory usage (minus the object overhead). </p>
<p>Regarding std::vector, one can use shrink_to_fit (something I did not do here).</p>
</div>
</li>
</ol>
</li>
<li id="comment-386672" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/40231a11da5f1c627fd21d6700edddff?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/40231a11da5f1c627fd21d6700edddff?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Lucas Clemente Vella</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-05T19:20:01+00:00">February 5, 2019 at 7:20 pm</time></a> </div>
<div class="comment-content">
<p>I just want to point that memory usage for <code>std::set</code> is not linear to its size, and the overhear might be smaller for larger datasets.</p>
</div>
<ol class="children">
<li id="comment-386674" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-05T19:31:20+00:00">February 5, 2019 at 7:31 pm</time></a> </div>
<div class="comment-content">
<p>I use 1024 elements, for smaller sets, it is indeed likely that the memory usage per element could be greater.</p>
<p>I do expect the memory usage to be linear, for large enough sets (I am guessing that 1024 is &ldquo;large enough&rdquo;).</p>
</div>
</li>
</ol>
</li>
<li id="comment-501350" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c12b162e20abc332b0541cba67d83351?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c12b162e20abc332b0541cba67d83351?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Frank Seidl</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-16T16:20:48+00:00">April 16, 2020 at 4:20 pm</time></a> </div>
<div class="comment-content">
<p>What are the costs per entry when entries are larger? I imagine that the additional memory from a linked list comes from pointers, which stay small as the size of the entries increases. If this is the case, std::list should become more efficient when the entries themselves are large. Meanwhile a hash table might allocate enough space to store 2-4 times as many entries as it actually contains. So I would expect std::unordered_set to keep a ratio similar to 36:4 even for large entries.</p>
</div>
<ol class="children">
<li id="comment-501351" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-16T16:28:41+00:00">April 16, 2020 at 4:28 pm</time></a> </div>
<div class="comment-content">
<p>I agree that a linked list probably becomes more efficient as the values get large. Note, however, that if your values are large, it becomes inefficient to copy them so you want to be using memory pointers.</p>
</div>
</li>
</ol>
</li>
<li id="comment-652473" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/552385f28bdeadfcd7cf5c0d493adb5b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/552385f28bdeadfcd7cf5c0d493adb5b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">alexpanter</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-22T11:39:26+00:00">June 22, 2023 at 11:39 am</time></a> </div>
<div class="comment-content">
<p>Hi,<br/>
dunno if this thread is still alive &#8211; very interesting read, in particular the comment section!</p>
<p>It also reminded me that video games often have very particular memory requirements, and prefer injecting their own allocators wherever they can. For this reason they rarely use STL in AAA games afaik, but rather create their own STL-library, e.g. EASTL.</p>
<p>Andrei Alexandrescu made an interesting talk about std::allocator in 2015, which fits into this narrative. But will that require us to rewrite STL at some point? I don&rsquo;t know, maybe someone else does.</p>
</div>
</li>
</ol>
