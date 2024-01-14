---
date: "2015-10-13 12:00:00"
title: "Where are all the search trees?"
index: false
---

[21 thoughts on &ldquo;Where are all the search trees?&rdquo;](/lemire/blog/2015/10-13-where-are-all-the-search-trees)

<ol class="comment-list">
<li id="comment-196658" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-13T20:31:35+00:00">October 13, 2015 at 8:31 pm</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s a little surprising to look at textbook algorithms and data structures and see which ones have retained popularity in the real world. A number of sorting algorithms seem also to have fallen by the wayside, to be mentioned in programming interviews and then never again. </p>
<p>With hashes I&rsquo;m not sure if it&rsquo;s a big deal or just a lot of usage of the small case, say an associative array with 5-10 members.</p>
</div>
</li>
<li id="comment-196680" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/07ffb930c0d898b974782e950c958112?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/07ffb930c0d898b974782e950c958112?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://maweki.de" class="url" rel="ugc external nofollow">Mario Wenzel</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-13T22:03:05+00:00">October 13, 2015 at 10:03 pm</time></a> </div>
<div class="comment-content">
<p>I think it is obvious why search trees not seen often. For a search tree you need a total ordering on all keys which implies either that all keys are of the same type or you extend your ordering to an ordering of types which is only a half-order in most (all?) type systems. So for a mapping between arbitrary keys to values there is no obvious way to implement that in search tree.</p>
<p>Whereas a hasmap &ldquo;only&rdquo; needs a hashing function (that&rsquo;s unique and uniformly distributed and so on). So besides having that function, no restrictions are placed on the set of all keys.</p>
<p>In a search tree, the set of all keys need to have a total ordering.</p>
</div>
<ol class="children">
<li id="comment-196683" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-13T22:18:05+00:00">October 13, 2015 at 10:18 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s a good point but how often do you have maps where keys have varied types? In JavaScript, all keys to an Object must be a string, and there is a natural (lexicographical) ordering for strings. JavaScript&rsquo;s Set type supports varied types however. In Go, you have to specify the type, and the type has to implement comparable but may not be ordered. Python natively supports hash maps with varied types.</p>
</div>
<ol class="children">
<li id="comment-196685" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/07ffb930c0d898b974782e950c958112?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/07ffb930c0d898b974782e950c958112?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://maweki.de" class="url" rel="ugc external nofollow">Mario Wenzel</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-13T22:33:18+00:00">October 13, 2015 at 10:33 pm</time></a> </div>
<div class="comment-content">
<p>Not only varied types but compound types also. If you have struct/tuple of an int and a string as keys you have to implement your own compare function that compares first by the int and then by the string (or the other way around) were both ways to sort might not be &ldquo;natural&rdquo;. You still need total ordering.</p>
<p>Using hash maps, just use the hash functions of your elements, bitshift and xor them. If there is no natural way to sort your items then there is no need to traverse them in some order and then you don&rsquo;t have to write some sorting functions.</p>
<p>In databases where b-trees are used as indexes, even for compound keys you need to define an order and most other Indexable database types are naturally orderable.</p>
<p>Of course many things can go wrong in writing a hash function but given that most environments (thinking of java and python here) give good hash functions for simple types and tools to combine them, this might be preferred to every key needing to implement the Comparable Interface.</p>
</div>
<ol class="children">
<li id="comment-196686" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-13T22:57:12+00:00">October 13, 2015 at 10:57 pm</time></a> </div>
<div class="comment-content">
<p>Yes. I like your answer very much. Clearly the answer has to do with the relevance of having an order to your keys.</p>
<p>But consider this. If you want to build a search tree in JavaScript, Go or Python, you are basically on your own. There is no easy solution.</p>
<p>Yet, there are certainly lots of cases where there is a natural ordering. Strings and integers are ordered. Their order is probably relevant in some way to the application.</p>
<p>Still, there is apparently very little need to go through these keys in sorted order.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-196735" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5656edc4940573d102f8cbd48965484f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5656edc4940573d102f8cbd48965484f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://funkcionalne.cz" class="url" rel="ugc external nofollow">k47</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-14T02:46:19+00:00">October 14, 2015 at 2:46 am</time></a> </div>
<div class="comment-content">
<p>Trees are basis for every persistent data structure used in functional programming.</p>
</div>
</li>
<li id="comment-196835" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dominic Amann</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-14T12:15:07+00:00">October 14, 2015 at 12:15 pm</time></a> </div>
<div class="comment-content">
<p>Of course in C++, you can use the boost property_tree, for which each node provides an ordered list of its subnodes.</p>
</div>
</li>
<li id="comment-196837" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/648cbb3135d4aa4ca7fc2a7849d7acd2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/648cbb3135d4aa4ca7fc2a7849d7acd2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://cs.coloradocollege.edu/~bylvisaker/" class="url" rel="ugc external nofollow">Ben</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-14T12:43:09+00:00">October 14, 2015 at 12:43 pm</time></a> </div>
<div class="comment-content">
<p>A couple thoughts:</p>
<p>As already mentioned by another commenter, trees are central to persistent data structures. While persistent data structures are not ubiquitous in mainstream software, my sense is that they are becoming more popular because they help somewhat with making it easier to write parallel and multitasking code.</p>
<p>And relatively recently (in data structure terms; about 15 years again) it was shown that hash-based structures can be made tree-shaped: hash array mapped tries. For any data structure nerds out there who don&rsquo;t know it already, learning about the HAMT is a treat.</p>
<p>In my experience it&rsquo;s reasonably common to build search trees layered on top of some other data structure, rather than as a core container library. I agree with the sentiment that for sets and maps, hash-based is often more convenient than comparison-based. However, I don&rsquo;t think search trees as a concept are going the way of the dodo any time soon.</p>
</div>
</li>
<li id="comment-196847" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Simon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-14T14:04:22+00:00">October 14, 2015 at 2:04 pm</time></a> </div>
<div class="comment-content">
<p>On modern CPUs then navigating a larger tree means navigating many more potentially uncached lines of memory. This can make larger tree structures orders of magnitude slower than hash maps.</p>
<p>Example, I recently replaced a tree structure holding all IPv4 ranges with a hash map approach. The tree usually needed 32 branches traversed to get an answer. However, the hash map only touched 3 cache lines and is 20 times faster. However, the reason to switch is because the hash map is 30 times smaller.</p>
</div>
<ol class="children">
<li id="comment-196867" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-14T16:19:42+00:00">October 14, 2015 at 4:19 pm</time></a> </div>
<div class="comment-content">
<p>1. How could a hash map be 30 times smaller? Surely, there is more to your story&#8230;</p>
<p>2. A red-black tree can scale poorly, because of the log n data accesses, but a B-tree ought to fix that&#8230;</p>
</div>
<ol class="children">
<li id="comment-196984" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Simon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-15T14:23:22+00:00">October 15, 2015 at 2:23 pm</time></a> </div>
<div class="comment-content">
<p>There is more to the story. The first 24 bits of each range are used as an array index or perfect hash. The last 8 bits of each range are stored in a sequential blob which has to be brute force searched. However, an interesting side effect of uncached line fetch speeds is that it&rsquo;s often faster to brute force search (no memory expensive meta data like pointers needed!) within cached lines than to fetch a single uncached line. This brute force approach is unintuitive for most developers. You have to think about the CPU as having a split personality; operations on cached memory are like walking across the street to the store, while operations on uncached memory are like driving to the store and having to deal with parking&#8230; You can do a whole lot of walking if you don&rsquo;t have to drive 🙂</p>
<p>This leads us to the memory prefetch instruction which most data structures ignore. But that&rsquo;s another story&#8230;</p>
</div>
</li>
</ol>
</li>
<li id="comment-196871" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-14T16:33:25+00:00">October 14, 2015 at 4:33 pm</time></a> </div>
<div class="comment-content">
<p>Cache complexity has indeed surpassed instruction count for in-memory sorting and searching performance. Essentially we&rsquo;ve moved to an external memory model for anything larger than a few megabytes. </p>
<p>Also, for long keys, such as urls or file paths, with long distinguishing prefixes, structures such as tries do poorly. I suspect there&rsquo;s been an inflation in key length as memory has become cheaper.</p>
</div>
</li>
</ol>
</li>
<li id="comment-196860" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/554f6616508cbaa4872bc7b17317c04f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/554f6616508cbaa4872bc7b17317c04f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Reinhard</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-14T15:39:50+00:00">October 14, 2015 at 3:39 pm</time></a> </div>
<div class="comment-content">
<p>I think this is a merely a symptom of a larger issue:<br/>
In academia, algorithms are evaluated using computer models from the 80s (or earlier). However, actual computers work like @Simon said, which is fundamentally different from the old models.</p>
<p>Developers care about actual performance. Academia cares about theoretical performance and rarely compares algorithms using more recent models or actual software. If they do, it is often unoptimized (and write-only) and therefore do not suffice to compare properly.</p>
<p>There are some exceptions (I think you, Daniel, are a particularly good one) but they are quite rare.</p>
</div>
<ol class="children">
<li id="comment-196988" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Simon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-15T15:17:47+00:00">October 15, 2015 at 3:17 pm</time></a> </div>
<div class="comment-content">
<p>I agree with you, Reinhard. However, I think that most developers are not aware of the cost of caching lines of memory. Which might be okay if their Java or C++ built-in library functions were aware. But sadly most of them are not.</p>
<p>As a high profile developer blog, I would love to see @Daniel blogging about real world experiments illustrating how slow fetching memory is, and how the memory prefetch instruction might be used to make some algorithms ~ 10 times faster.</p>
</div>
<ol class="children">
<li id="comment-196990" class="comment byuser comment-author-lemire bypostauthor even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-15T15:35:10+00:00">October 15, 2015 at 3:35 pm</time></a> </div>
<div class="comment-content">
<p><em>I would love to see @Daniel blogging about real world experiments illustrating how slow fetching memory is, and how the memory prefetch instruction might be used to make some algorithms ~ 10 times faster.</em></p>
<p>This is not a bad idea.</p>
</div>
<ol class="children">
<li id="comment-196996" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-15T16:45:56+00:00">October 15, 2015 at 4:45 pm</time></a> </div>
<div class="comment-content">
<p>This paper is a start; it goes quite a bit into prefetch and locality effects on real-world hardware: <a href="http://arxiv.org/pdf/1509.05053.pdf" rel="nofollow ugc">http://arxiv.org/pdf/1509.05053.pdf</a> .</p>
</div>
<ol class="children">
<li id="comment-197024" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Simon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-15T21:08:27+00:00">October 15, 2015 at 9:08 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for posting the link.</p>
<p>Page 16 talks about explicitly prefetching using the prefetch instruction. I have found this instruction very difficult to use in a regular algorithm and see any big benefit. Why? It&rsquo;s very difficult to predict how far ahead of time you need to execute it.</p>
<p>However, I have had great results using the instruction in what I&rsquo;ll call &ldquo;batch mode&rdquo;. Let&rsquo;s say you have a hash table and have a batch of 20 keys to look up. You hash each key and then in a loop prefetch the random location in memory that you want to access. By the time the last prefetch is done then the code can continue to actually access the memory for the 1st key without any delay because it just got cached. This gives a huge performance boost to the hash table because so much stuff is happening in parallel and not sequentially. So ~ 10 x performance but only when doing batched operations.</p>
</div>
</li>
<li id="comment-197030" class="comment byuser comment-author-lemire bypostauthor odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-15T21:29:06+00:00">October 15, 2015 at 9:29 pm</time></a> </div>
<div class="comment-content">
<p>It is a very interesting paper. They do seem to make a good use of prefetch in this instance. Note however that regarding binary search, they could have gotten pretty much the same performance characteristics by simply switching from the branchless to the branchy algorithm, depending on data size&#8230; and that would have the benefit of using only straight C code.</p>
<p>So we are not talking about making algorithms 10 times faster through prefetching&#8230;</p>
</div>
</li>
<li id="comment-197062" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-16T00:19:16+00:00">October 16, 2015 at 12:19 am</time></a> </div>
<div class="comment-content">
<p>I would add that cache prediction in general is hard.</p>
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
<li id="comment-197033" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Simon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-15T21:38:04+00:00">October 15, 2015 at 9:38 pm</time></a> </div>
<div class="comment-content">
<p>&gt;&gt;&gt; So we are not talking about making algorithms 10 times faster through prefetchingâ€¦ &lt;&lt;&lt;</p>
<p>Not in that particular paper. But had they implemented a batch lookup version which does e.g. 20 lookups concurrently then I believe they could have achieved such a significant speed-up. Unfortunately, they didn&#039;t make optimal use of the prefetch instruction IMO.</p>
</div>
</li>
<li id="comment-432825" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2626223241e8734c22cfbc22c2d12d61?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2626223241e8734c22cfbc22c2d12d61?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://hackr.io/" class="url" rel="ugc external nofollow">Ankit Dixit</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-23T07:10:55+00:00">October 23, 2019 at 7:10 am</time></a> </div>
<div class="comment-content">
<p>Map is a type that specifically represents key-value pairs. The stored values are not inherited from the prototype. The keys can be of any type, not necessarily strings.</p>
<p>The documentation on MDN ( Map ) lists the differences as follows:<br/>
An Object has a prototype, so there are default keys in the map. However, this can be bypassed using map = Object.create(null).<br/>
The keys of an Object are Strings, where they can be any value for a Map.<br/>
You can get the size of a Map easily while you have to manually keep track of size for an Object.<br/>
Check this out: <a href="https://hackr.io/blog/javascript-map" rel="nofollow ugc">https://hackr.io/blog/javascript-map</a></p>
</div>
</li>
</ol>
