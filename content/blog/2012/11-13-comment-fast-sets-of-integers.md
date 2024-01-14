---
date: "2012-11-13 12:00:00"
title: "Fast sets of integers"
index: false
---

[20 thoughts on &ldquo;Fast sets of integers&rdquo;](/lemire/blog/2012/11-13-fast-sets-of-integers)

<ol class="comment-list">
<li id="comment-59455" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5d7a88911adca5c79177b4316ae65408?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5d7a88911adca5c79177b4316ae65408?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Norman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-11-13T14:49:13+00:00">November 13, 2012 at 2:49 pm</time></a> </div>
<div class="comment-content">
<p>It might be because the bitset is more cache friendly. I personally love the bitmagic C++ library (<a href="http://bmagic.sourceforge.net/" rel="nofollow ugc">http://bmagic.sourceforge.net/</a>) as it handles sparse sets really well.</p>
</div>
</li>
<li id="comment-59466" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2c9cb1de22e9da153a5e4518010d3a96?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2c9cb1de22e9da153a5e4518010d3a96?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://taint.org" class="url" rel="ugc external nofollow">Justin Mason</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-11-13T18:45:08+00:00">November 13, 2012 at 6:45 pm</time></a> </div>
<div class="comment-content">
<p>Have you got perf figures for that StaticBitSet class, compared to a BitSet?</p>
</div>
</li>
<li id="comment-59468" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-11-13T19:22:33+00:00">November 13, 2012 at 7:22 pm</time></a> </div>
<div class="comment-content">
<p>@Justin</p>
<p>They are in the repository, right there:</p>
<p><a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2012/11/13/results.txt" rel="nofollow ugc">https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2012/11/13/results.txt</a></p>
<p>You can also run the code and see for yourself what happens on your own machine. Results may vary.</p>
<p>BTW I am not saying that BitSet is bad. My StaticBitSet class just does better, it seems, on this particular test.</p>
</div>
</li>
<li id="comment-59471" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/08273d5f7fe210be4bfcdd60b9b3fe09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/08273d5f7fe210be4bfcdd60b9b3fe09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">J. Andrew Rogers</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-11-13T22:59:51+00:00">November 13, 2012 at 10:59 pm</time></a> </div>
<div class="comment-content">
<p>Daniel, this is entirely consistent with my experience. A well-implemented bit set is a nearly optimal data structure for modern CPU architectures. It is brute force but in a manner CPUs are highly optimized for. If you are saturating all the ALUs then the number of entry evaluations per clock cycle is very high. Hash sets have to overcome their cache line overhead and relatively low number of evaluations per clock cycle.</p>
<p>As you undoubtedly know, when bit sets become large/sparse enough to become inefficient, a very good alternative is compressed bit sets.</p>
</div>
</li>
<li id="comment-59483" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2c9cb1de22e9da153a5e4518010d3a96?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2c9cb1de22e9da153a5e4518010d3a96?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://taint.org" class="url" rel="ugc external nofollow">Justin Mason</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-11-14T07:09:03+00:00">November 14, 2012 at 7:09 am</time></a> </div>
<div class="comment-content">
<p>Of course. I&rsquo;m just wondering since I have some extremely performance-sensitive code which uses java.util.BitSet &#8212; it&rsquo;ll be nice to benchmark it there too, given those numbers&#8230;.</p>
</div>
</li>
<li id="comment-59506" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/206690a26526f07467ecfd6662f8b152?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/206690a26526f07467ecfd6662f8b152?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://karussell.wordpress.com/" class="url" rel="ugc external nofollow">Peter</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-11-14T12:37:39+00:00">November 14, 2012 at 12:37 pm</time></a> </div>
<div class="comment-content">
<p>nice results :)!</p>
<p>this seems to be a bit offtopic but 🙂</p>
<p>does somebody know of a sparse hashset implementation in Java which is more memory efficient than the THashSet?</p>
<p>I need some memory efficient datastructure for the case that there are areas of consecutive integer values &#8230; or how would you implement that?</p>
</div>
</li>
<li id="comment-59507" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/206690a26526f07467ecfd6662f8b152?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/206690a26526f07467ecfd6662f8b152?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://karussell.wordpress.com/" class="url" rel="ugc external nofollow">Peter</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-11-14T12:39:18+00:00">November 14, 2012 at 12:39 pm</time></a> </div>
<div class="comment-content">
<p>to be more specific: do you think that one could combine bitset and hashset?</p>
<p>I mean a hashset which is baken by (linked or whatever) several bitsets?</p>
</div>
</li>
<li id="comment-59489" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6aea6e2f57f2a7b1cd6870375fbdc42f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6aea6e2f57f2a7b1cd6870375fbdc42f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ivan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-11-14T08:29:08+00:00">November 14, 2012 at 8:29 am</time></a> </div>
<div class="comment-content">
<p>Hi,<br/>
would be nice to see some b search + sorted vector in comparison, like in your linked blog post. Even more interesting would be some cache aware or even (if they exist) cache oblivious &ldquo;kind of b search + sorted vector&rdquo;. I guess binary tree &ldquo;flattened&rdquo; to array would behave nicely with regards to cache perf.</p>
</div>
</li>
<li id="comment-59515" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/206690a26526f07467ecfd6662f8b152?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/206690a26526f07467ecfd6662f8b152?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://karussell.wordpress.com/" class="url" rel="ugc external nofollow">Peter</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-11-14T14:51:59+00:00">November 14, 2012 at 2:51 pm</time></a> </div>
<div class="comment-content">
<p>@Daniel</p>
<p>of course I&rsquo;m aware of your nice projects 🙂 </p>
<p>but I think compressed bitsets are not an option for me as I need random access.</p>
</div>
</li>
<li id="comment-59494" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-11-14T10:10:13+00:00">November 14, 2012 at 10:10 am</time></a> </div>
<div class="comment-content">
<p>@Justin</p>
<p>You are welcome to steal my StaticBitSet implementation and benchmark it for your purposes. It is available on github.</p>
</div>
</li>
<li id="comment-59495" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-11-14T10:11:19+00:00">November 14, 2012 at 10:11 am</time></a> </div>
<div class="comment-content">
<p>@Rogers @Ivan</p>
<p>Agreed. It would be interesting to throw in more data structures and more strategies. I will do so in the future.</p>
</div>
</li>
<li id="comment-59518" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/206690a26526f07467ecfd6662f8b152?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/206690a26526f07467ecfd6662f8b152?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://karussell.wordpress.com/" class="url" rel="ugc external nofollow">Peter</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-11-14T15:47:57+00:00">November 14, 2012 at 3:47 pm</time></a> </div>
<div class="comment-content">
<p>@Daniel</p>
<p>Sorry for the confusion! I should have thought about my problem a bit more 🙂</p>
<p>I need a hashmap or a &lsquo;compressed&rsquo; integer array which efficiently &lsquo;maps&rsquo; ints to ints (or longs to longs)</p>
</div>
</li>
<li id="comment-59514" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-11-14T14:36:01+00:00">November 14, 2012 at 2:36 pm</time></a> </div>
<div class="comment-content">
<p>@Peter</p>
<p>It is a reasonable request, but I don&rsquo;t know of an existing solution.</p>
<p>You might want to look at compressed bitsets. They could meet your needs. See <a href="https://github.com/lemire/simplebitmapbenchmark" rel="nofollow ugc">https://github.com/lemire/simplebitmapbenchmark</a> for a comparative benchmark.</p>
</div>
</li>
<li id="comment-59519" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-11-14T16:16:27+00:00">November 14, 2012 at 4:16 pm</time></a> </div>
<div class="comment-content">
<p>@Peter</p>
<p>Yes, I understand what you seek.</p>
<p>If you ever find a good solution, please email me.</p>
</div>
</li>
<li id="comment-59539" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/206690a26526f07467ecfd6662f8b152?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/206690a26526f07467ecfd6662f8b152?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://karussell.wordpress.com/" class="url" rel="ugc external nofollow">Peter</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-11-15T02:16:57+00:00">November 15, 2012 at 2:16 am</time></a> </div>
<div class="comment-content">
<p>I found the SparseArray/LongSparseArray of the android project. Still a *full* re-allocation is necessary if the space is not sufficient but the key/values are stored very compact. Access is done via binary search, so not O(1) &#8230;</p>
</div>
</li>
<li id="comment-60637" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a537e488485f9ecc8e9b7988aa95598e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a537e488485f9ecc8e9b7988aa95598e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://researcher.watson.ibm.com/researcher/view.php?person=us-msridhar" class="url" rel="ugc external nofollow">Manu Sridharan</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-12-01T12:55:07+00:00">December 1, 2012 at 12:55 pm</time></a> </div>
<div class="comment-content">
<p>Cool post! For those who are interested, we have a wide variety of integer set implementations in WALA:</p>
<p><a href="http://wala.sourceforge.net" rel="nofollow ugc">http://wala.sourceforge.net</a></p>
<p>See the com.ibm.wala.util.intset.IntSet interface and its implementations. Efficient representation of integer sets is critical to the scalability of many program analyses.</p>
</div>
</li>
<li id="comment-60672" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cbbb0e98d83ed2ee0204397f4b509c0c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cbbb0e98d83ed2ee0204397f4b509c0c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Walter</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-12-02T06:19:15+00:00">December 2, 2012 at 6:19 am</time></a> </div>
<div class="comment-content">
<p>Interesting post! <a href="http://www.censhare.com/en/aktuelles/censhare-labs/efficient-concurrent-long-set-and-map" rel="nofollow ugc">http://www.censhare.com/en/aktuelles/censhare-labs/efficient-concurrent-long-set-and-map</a> shows a different approach for sparse sets using a bit trie.</p>
</div>
</li>
<li id="comment-279441" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tobin Baker</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-08T17:50:28+00:00">May 8, 2017 at 5:50 pm</time></a> </div>
<div class="comment-content">
<p>Here&rsquo;s another approach: randomize the integers using a pseudorandom permutation (aka block cipher), and divide them into buckets indexed by the MSB of their randomized value. (The bucket size should be chosen to fit into a cache line in expectation.) Then to look up an integer, encode it and scan its bucket (linear search should suffice if the bucket fits in a cache line). To intersect two of these sets, intersect each corresponding bucket (sets of different sizes will have different bucket counts, so this requires intersecting each bucket of the smaller set with all buckets in the larger set of which that bucket&rsquo;s index is a prefix). Again, this is just a linear scan on cache-line-sized buckets (if encoded values are stored in order within a bucket then you can pick up the scan where you left off from the last value you looked up). Note that no decoding is required for intersections if both sets share the same permutation (and you don&rsquo;t want to enumerate the result). You can enumerate the whole set simply by scanning and decoding each bucket. I&rsquo;ve been able to get around 60% compression this way with a few million 32-bit integers, and around 78% with a more complex version of the structure (using Elias-Fano coding in the buckets). For the permutation, any 2-round balanced Feistel network with a fast round function works fine; a couple of rounds of RC5 (too weak for crypto!) seems fast enough in practice.</p>
</div>
</li>
<li id="comment-279445" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tobin Baker</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-08T20:23:43+00:00">May 8, 2017 at 8:23 pm</time></a> </div>
<div class="comment-content">
<p>Heh, I forgot to mention the detail that achieves compression in this scheme: each bucket only stores the suffixes of the encoded value (the prefix is implicitly stored in the bucket index). I don&rsquo;t have Knuth handy but I believe he refers to this technique as &ldquo;quotienting&rdquo;. Of course since buckets are variable-sized, an index storing bucket counts or offsets is necessary, but that requires very little space relative to the compression gain. (The distribution of bucket sizes is well described by the Poisson approximation to the binomial distribution.)</p>
</div>
</li>
<li id="comment-295951" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/59551ab4fae822169aa07936d08cb424?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/59551ab4fae822169aa07936d08cb424?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Rob Au</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-02-01T09:19:44+00:00">February 1, 2018 at 9:19 am</time></a> </div>
<div class="comment-content">
<p>Also check out the SparseFixedBitSet from the Lucene project: <a href="https://lucene.apache.org/core/7_2_1/core/org/apache/lucene/util/SparseFixedBitSet.html" rel="nofollow ugc">https://lucene.apache.org/core/7_2_1/core/org/apache/lucene/util/SparseFixedBitSet.html</a></p>
</div>
</li>
</ol>
