---
date: "2020-11-25 12:00:00"
title: "How fast does interpolation search converge?"
index: false
---

[17 thoughts on &ldquo;How fast does interpolation search converge?&rdquo;](/lemire/blog/2020/11-25-how-fast-does-interpolation-search-converge)

<ol class="comment-list">
<li id="comment-559424" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/264878c6822bc39fe305a96b2e1d2d4f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/264878c6822bc39fe305a96b2e1d2d4f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.lukas-barth.net" class="url" rel="ugc external nofollow">Lukas Barth</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-11-25T22:33:05+00:00">November 25, 2020 at 10:33 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for the article &#8211; indeed, interpolation search is not something I usually think of when searching in sorted lists. I should probably change that.</p>
<p>However, there is one major downside that you did not mention: If the data that you search in is in some way generated by a second party (say, a user), an adversary can easily construct worst-case input data, and I think you can force the algorithm to visit every single element in the array. Of course, in this case your initial assumption that you <em>know the distribution of the values</em> is not true anymore.</p>
</div>
</li>
<li id="comment-559437" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/93f5fbdd8c7941827fd66f21c8e28654?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/93f5fbdd8c7941827fd66f21c8e28654?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Jon Stewart</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-11-26T01:16:53+00:00">November 26, 2020 at 1:16 am</time></a> </div>
<div class="comment-content">
<p>Howdy, I came up with a variant of interpolation search for when the data set is immutable—use the expected slot as the midpoint to binary search but then choose the low and high guards based off the precomputed maximum error of any item in the set (i.e., distance from its expected slot). In digital forensics/information security, we often have large sets of cryptographic hash values (MD5/SHA-1/SHA2-256) from previously examined files and simply want to know whether a provided hash value is in the set. Since these sets are largely immutable, we just write the hash values as sorted binary, with a simple file header that stores the determined error. The first hash value then begins at offset 4096 and the file can be memory mapped for binary search.</p>
<p>At least twice as many lookups per second can be done this way than with a naive binary search. With a real world hash set that’s about a GB in size, the maximum error only has an ~8KB radius, so we only need to hit a couple of pages right next to each other. And&#8230; the implementation is pleasingly simple.</p>
</div>
<ol class="children">
<li id="comment-559441" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-11-26T01:32:59+00:00">November 26, 2020 at 1:32 am</time></a> </div>
<div class="comment-content">
<p><em>use the expected slot as the midpoint to binary search but then choose the low and high guards based off the precomputed maximum error of any item in the set (i.e., distance from its expected slot).</em></p>
<p>That&rsquo;s an interesting proposal.</p>
</div>
</li>
</ol>
</li>
<li id="comment-559439" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/28c2ad0c8763feac0b431881de7f97fe?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/28c2ad0c8763feac0b431881de7f97fe?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.pvk.ca" class="url" rel="ugc external nofollow">Paul Khuong</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-11-26T01:24:12+00:00">November 26, 2020 at 1:24 am</time></a> </div>
<div class="comment-content">
<p>A few years ago, AppNexus used static interpolation search (<a href="https://dl.acm.org/doi/abs/10.5555/982792.982870" rel="nofollow ugc">https://dl.acm.org/doi/abs/10.5555/982792.982870</a>) for range queries in large sorted arrays (one of the heaviest user at the time was a static variant of Chazelle&rsquo;s filtered search for 1D stabbing queries). Ruchir Khaitan gave a talk about the static interpolation search itself at !!Con 2017 <a href="https://www.youtube.com/watch?v=RJU2cXvQ9po" rel="nofollow ugc">https://www.youtube.com/watch?v=RJU2cXvQ9po</a></p>
</div>
</li>
<li id="comment-559492" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c02423845547062a36de3912554890c4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c02423845547062a36de3912554890c4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/brianherman" class="url" rel="ugc external nofollow">Brian Herman</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-11-26T05:42:44+00:00">November 26, 2020 at 5:42 am</time></a> </div>
<div class="comment-content">
<p>I converted your implementation to python.<br/>
<a href="https://gist.github.com/brianherman/7e58b48ddbb7060663139416ed4901fa" rel="nofollow ugc">github gist</a></p>
</div>
<ol class="children">
<li id="comment-559553" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-11-26T16:46:34+00:00">November 26, 2020 at 4:46 pm</time></a> </div>
<div class="comment-content">
<p>Thank you.</p>
</div>
</li>
</ol>
</li>
<li id="comment-559500" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://zeux.io" class="url" rel="ugc external nofollow">Arseny Kapoulkine</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-11-26T06:48:58+00:00">November 26, 2020 at 6:48 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;d also recommend reading &ldquo;Efficiently Searching In-Memory Sorted Arrays: Revenge of the Interpolation Search&rdquo;</p>
<p><a href="http://pages.cs.wisc.edu/~chronis/files/efficiently_searching_sorted_arrays.pdf" rel="nofollow ugc">http://pages.cs.wisc.edu/~chronis/files/efficiently_searching_sorted_arrays.pdf</a></p>
<p>It summarizes a few practical tricks of running the search quickly including a 3-point interpolation technique which fits non-linear distributions better.</p>
<p>3-point interpolation can be useful as a search acceleration method when you&rsquo;re trying to approximate a complex function; my library, meshoptimizer, uses this in one of the algorithms instead of a binary search to find the optimal parameter in the optimization algorithm to get faster convergence.</p>
</div>
<ol class="children">
<li id="comment-559543" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-11-26T14:38:03+00:00">November 26, 2020 at 2:38 pm</time></a> </div>
<div class="comment-content">
<p>Thank you for the reference.</p>
</div>
</li>
</ol>
</li>
<li id="comment-559580" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a39e5293837ba1d2201e51111f3d800f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a39e5293837ba1d2201e51111f3d800f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://john.freml.in" class="url" rel="ugc external nofollow">John Fremlin</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-11-26T21:42:31+00:00">November 26, 2020 at 9:42 pm</time></a> </div>
<div class="comment-content">
<p>Interpolation search, including automatic fallback to bisection has been used for a long time in optimization!</p>
<p>For example,<br/>
<a href="https://en.wikipedia.org/wiki/Brent%27s_method" rel="nofollow ugc">https://en.wikipedia.org/wiki/Brent%27s_method</a> &#8211; available in scipy, Boost, etc. &#8211; has careful conditions for when to use interpolation or bisection, which improves worst case behaviour.</p>
</div>
<ol class="children">
<li id="comment-559586" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-11-26T21:57:15+00:00">November 26, 2020 at 9:57 pm</time></a> </div>
<div class="comment-content">
<p>Thanks John.</p>
<p>I used to teach numerical analysis so I am familiar with such techniques, at least at a high level, but I was focusing on the search problem within arrays, as a data structure.</p>
</div>
</li>
</ol>
</li>
<li id="comment-559720" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/KWillets/" class="url" rel="ugc external nofollow">KWillets</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-11-27T17:32:24+00:00">November 27, 2020 at 5:32 pm</time></a> </div>
<div class="comment-content">
<p>Adrian Colyer recently featured a <a href="https://blog.acolyer.org/2020/10/19/the-case-for-a-learned-sorting-algorithm/" rel="nofollow ugc">learned sorting algorithm</a> that is fancy interpolation. It doesn&rsquo;t actually learn the algorithm, just the distribution of the data.</p>
<p>The authors don&rsquo;t seem to understand strings though &#8212; they use some kind of vector representation instead of the natural embedding of binary strings as numbers in [0,1).</p>
</div>
<ol class="children">
<li id="comment-559738" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/KWillets/" class="url" rel="ugc external nofollow">KWillets</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-11-27T19:12:41+00:00">November 27, 2020 at 7:12 pm</time></a> </div>
<div class="comment-content">
<p>On second reading, they do encode strings as numbers, but they also appear to do a sample sort to smooth out the distribution, so it&rsquo;s not clear how important the numeric model is.</p>
<p>FWIW many data warehouse products use some form of block range index that amounts to a piecewise specification of the distribution. It seems more robust against clumpy distributions.</p>
</div>
</li>
</ol>
</li>
<li id="comment-566265" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/77b3cdb83326d081dd0eae938d6034ed?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/77b3cdb83326d081dd0eae938d6034ed?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michael</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-09T18:25:56+00:00">January 9, 2021 at 6:25 pm</time></a> </div>
<div class="comment-content">
<p>The comparison you make between a hash table and a sorted array seems flawed to me. I agree that the array is an easier way to traverse the data in order, and I would need to think about the merging distinction more before drawing a conclusion.</p>
<p>Regarding hash table implementations using more memory to gain performance, what is this in regard to? I can think of a few meanings:</p>
<p>If you are referring to storing the hash to quicken the comparison, that can be eliminated.<br/>
If you are referring to leaving slots open for new items, that implies that the dataset is mutable. I assume that mutable sorted array implementations have much worse write performance if they don&rsquo;t leave slots open. Copying the entire array is linear to add an item. Linear-complexity writes, although most-likely much slower, could be achieved in an exact-size array hash table. Given that the extra space is typically included to improve write performance (and to slightly improve scan performance), I suppose that an implementation could eliminate the empty slots if memory usage is more concerning.<br/>
If you are referring to an immutable &ldquo;perfect&rdquo; hash table, given enough time, is it not possible to find a hash algorithm that uniquely associates each item with a slot in an exact-size array? The only memory overhead would be constant-sized inputs into the hash algorithm.</p>
<p>I&rsquo;m interested in understanding which distinction you mean and, if it&rsquo;s as substantial as you originally meant, how so.</p>
<p>Thanks!</p>
</div>
<ol class="children">
<li id="comment-566283" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-09T22:28:00+00:00">January 9, 2021 at 10:28 pm</time></a> </div>
<div class="comment-content">
<p><em>The comparison you make between a hash table and a sorted array seems flawed to me. I agree that the array is an easier way to traverse the data in order, and I would need to think about the merging distinction more before drawing a conclusion.</em></p>
<p>Have you tried implementing code that merges two sorted arrays, and then benchmark against code that merges two distinct hash tables?</p>
<p><em>Regarding hash table implementations using more memory to gain performance, what is this in regard to?</em></p>
<p>My statement is &lsquo;you should be mindful that many hash table implementations gain performance at the expense of higher memory usage&rsquo;. If you disagree then you have to demonstrate that not many hash table implementations use a lot of memory. You can use, say, an unordered_set in C++ or a HashSet in Java. To store integers, you will need tens of bytes per entry.</p>
</div>
<ol class="children">
<li id="comment-567466" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-15T08:30:29+00:00">January 15, 2021 at 8:30 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
You can use, say, an unordered_set in C++ or a HashSet in Java. To store integers, you will need tens of bytes per entry.
</p></blockquote>
<p>It is true that specifically <code>unordered_set</code> and <code>HashSet</code> use a lot of memory per entry and their practical performance often suffers because of it, but I would argue that it is not &ldquo;fundamental&rdquo; to hash tables and it is not really related to the memory/performance tradeoff that hash tables make.</p>
<p>Rather, in the case of Java it is related to a type-erased generics implementation which makes <em>all</em> collection types inefficient for primitives. Only primitive arrays like <code>int[]</code> escape this penalty. If you care, you can use per-primitive type specialized hash sets which use the primitive underlying array type. I would consider this a Java quirk (it also applies in some other language) and nothing to do with hash sets, per se.</p>
<p>Similarly, C++ made the unfortunate decision to make their hash sets effectively require a node based design: needing a dynamically allocated node per element. Very unfortunate, but not an intrinsic property of hashes. Plenty of good C++ hash sets/maps out there without this problem.</p>
<p>Now, hash sets/maps <em>do</em> make a space/speed tradeoff: having a load factor &lt; 1, which wastes some space. However, this penalty is usually less than 2x, i.e., it should take less than 8 bytes to store a 4-byte integer in most implementations. I.e., it is much lower than the unfortunate implementations above would suggest.</p>
</div>
</li>
</ol>
</li>
<li id="comment-644061" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tobin Baker</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-25T23:19:26+00:00">August 25, 2022 at 11:19 pm</time></a> </div>
<div class="comment-content">
<p>If you squint at them the right way, open-addressed hash tables like Robin Hood or Bidirectional Linear Probing[1] are nothing but sorted arrays (sorted by exact hash value). That makes merging two hash tables trivial (and it also means that a lookup in such a hash table is essentially just interpolation search).</p>
<p>[1] <a href="https://www.semanticscholar.org/paper/Ordered-Hash-Tables-Amble-Knuth/174468273bbb4b13b47bf5b0055845ac33254ab7" rel="nofollow ugc">https://www.semanticscholar.org/paper/Ordered-Hash-Tables-Amble-Knuth/174468273bbb4b13b47bf5b0055845ac33254ab7</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-568548" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0af763b95a6c72ea31584f51e4052fe4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0af763b95a6c72ea31584f51e4052fe4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Vladimír ?unát</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-20T18:25:36+00:00">January 20, 2021 at 6:25 pm</time></a> </div>
<div class="comment-content">
<p>I think the typical stumbling point for interpolation search approach is that the stored distribution isn&rsquo;t known or easy to approximate (with sufficient precision). Hash-like keys might make sense in some cases I guess. On theory one can do something like explained at end of section 3.4 in <a href="http://v.cunat.cz/theses/master.pdf" rel="nofollow ugc">http://v.cunat.cz/theses/master.pdf</a> but perhaps getting the (space) constants low could be difficult, though full dynamic-ity might be worth that cost.</p>
<p>Maybe if the rate of changes were low, some dynamization of the static array would be worthwile. Perhaps just keeping spaces (with copies of some of the two adjacent keys), as there&rsquo;s a simple way [1] of keeping even worst-case amortized moves to log-squared factor &#8211; which might be OK-ish in practice. Moreover if the distribution is not changing (much) over time, note that all insertions are expected to be uniformly distributed within the array (say&#8230; the array index is roughly uniformly distributed, at least if I disregard any spaces or if those are uniform).</p>
<p>[1] Bender &amp;al.: Two Simplified Algorithms for Maintaining<br/>
Order in a List</p>
<p>My text in the previous link also contains lots of other theoretical stuff related to interpolation search (for anyone interested). My conclusion overall was that these techniques don&rsquo;t pay off in practice. Perhaps some variation on that special case above, but otherwise&#8230; I expect it would have to be some veeery special use case.</p>
</div>
</li>
</ol>
