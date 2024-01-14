---
date: "2015-10-15 12:00:00"
title: "On the memory usage of maps in Java"
index: false
---

[8 thoughts on &ldquo;On the memory usage of maps in Java&rdquo;](/lemire/blog/2015/10-15-on-the-memory-usage-of-maps-in-java)

<ol class="comment-list">
<li id="comment-196968" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8af88bac916c9bf3f45831c114d30b0e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8af88bac916c9bf3f45831c114d30b0e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://jltsiren.kapsi.fi/" class="url" rel="ugc external nofollow">Jouni</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-15T09:46:45+00:00">October 15, 2015 at 9:46 am</time></a> </div>
<div class="comment-content">
<p>As someone working on algorithms in bioinformatics, I often get the feeling that no computer ever has a sufficient amount of memory. When datasets have billions of elements or more, pointer-based trees and hash tables can&rsquo;t always be used, because the pointers would require too much memory. Data is often stored in static arrays with batch updates, because dynamic updates would require too much space overhead.</p>
<p>My typical &ldquo;map-like&rdquo; data structures are based on (plain or compressed) bitmaps with rank/select support. The data is stored in an array, sorted by integer keys. One bitmap records the key values that are present, while another marks the entries that have a different key than the previous entry. Searching involves one rank query, one select query, and a constant number of cache misses.</p>
</div>
<ol class="children">
<li id="comment-196982" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Simon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-15T14:00:42+00:00">October 15, 2015 at 2:00 pm</time></a> </div>
<div class="comment-content">
<p>I totally agree, Journi.</p>
<p>For example a tree structure holding all IPv4 ranges is very expensive in pointers and navigation. However, each range is two 32bit numbers. By reducing all ranges to max 256, and by using the first 24 bits of the start range as an index &#8212; think of it like a perfect hash &#8212; then we end up with a fixed sized index of 2^24 * 32 bits or 64 MB. So you can now do one random read whereas a tree would have taken up to 24 reads. Dealing with the last 8 bits of the IPv4 is left as an exercise for the reader 🙂 The final data structure is 30 times smaller than the tree.</p>
<p>This is a good example where using a built in tree or hash map &ldquo;off the shelf&rdquo; would cause unnecessarily high memory overhead.</p>
</div>
</li>
<li id="comment-196987" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-15T15:15:25+00:00">October 15, 2015 at 3:15 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;As someone working on algorithms in bioinformatics, I often get the feeling that no computer ever has a sufficient amount of memory.&rdquo;</p>
<p>You and I both work on compressed data structures and corresponding indexes&#8230; and this work has certainly its place.</p>
<p>However, most organizations can easily afford a machine with 128 GB of memory or more&#8230; and for the rest, you can use SSDs. Meanwhile, actual datasets are often not that huge. The human genome fits in 2 GB.</p>
<p>I am not saying that saving memory is pointless, if I thought so, I would not be benchmarking memory usage&#8230; but we should not exaggerate the importance of memory as a bottleneck. Having lots of data, but processing it in a predictable way is fine&#8230;</p>
</div>
<ol class="children">
<li id="comment-196991" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Simon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-15T15:37:04+00:00">October 15, 2015 at 3:37 pm</time></a> </div>
<div class="comment-content">
<p>I beg to disagree regarding how common huge datasets are. Very many organizations these days do &ldquo;big data&rdquo; and they have some sort of data workflow set up that takes a team weeks or months to implement. However, often it&rsquo;s necessary to venture off the well beaten data workflow path in order to explore a portion of the data for some reason. Here the 128 GB RAM system suddenly becomes a limitation because you want to process the sample data in minutes or hours rather than days.</p>
<p>This is where awareness of algorithm and memory usage is very important. For example, most languages support some kind of hash table. But if you want to serialize it to disk then it normally involves iterating over the number of keys in the hash table. So 100 million keys means 100 million iterations. However, Perl has a module called Storable which can dump a data structure to disk without having to iterate over all nodes. This makes it faster than possibly all other comparable languages for this particular task. Developers should always question the status quo!</p>
</div>
</li>
<li id="comment-196994" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8af88bac916c9bf3f45831c114d30b0e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8af88bac916c9bf3f45831c114d30b0e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://jltsiren.kapsi.fi/" class="url" rel="ugc external nofollow">Jouni</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-15T16:35:38+00:00">October 15, 2015 at 4:35 pm</time></a> </div>
<div class="comment-content">
<p>An assembled human genome is small, but the actual datasets are much larger. The genome comes out from a sequencing machine as a billion sequences of length ~100 each, accompanied by another 100 gigabytes of quality/metadata. Sequencing has become cheap enough that research projects sequencing hundreds or even thousands of individuals are everywhere. The amount of raw data in a single project is now often in hundreds of terabytes.</p>
<p>Bioinformatics is one of the few fields, where compressed data structures are used everywhere. Maybe it&rsquo;s an attempt to compensate for the lack of suitable hardware with better software. After all, world&rsquo;s high-performance computing infrastructure appears to be optimized for processing small numerical/categorical objects, while we have large combinatorial objects such as sequences and graphs.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-196995" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-15T16:38:08+00:00">October 15, 2015 at 4:38 pm</time></a> </div>
<div class="comment-content">
<p>I did some research recently and found that koloboke is one of the best libraries in terms of both memory usage and retrieval efficiency.</p>
<p>BTW, I have also re-written a crucial piece of my Java pipeline in C++. It became 6 times faster. Memory usage also halved at the very least (more like 1/3 I think). </p>
<p>One big problem in Java is that it&rsquo;s hard to avoid memory allocations. In C++, certain things can be made virtually allocation free. Another problem is that all standard math is double precision. Why? You don&rsquo;t always need doubles.</p>
</div>
</li>
<li id="comment-197076" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1ad9a9886ccdc489d0dfc559afe40eb1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1ad9a9886ccdc489d0dfc559afe40eb1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ben Alex</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-16T02:22:36+00:00">October 16, 2015 at 2:22 am</time></a> </div>
<div class="comment-content">
<p>I published a fork at <a href="https://github.com/benalexau/HashVSTree" rel="nofollow ugc">https://github.com/benalexau/HashVSTree</a> which contains a few enhancements:</p>
<p>&#8211; Provide capacity information at initialization time (seemed reasonable given the array case had that information)<br/>
&#8211; Add Fastutil&rsquo;s Int2IntArrayMap, Int2IntRBTreeMap and Int2IntAVLTreeMap<br/>
&#8211; Add int[] (ie primitive array)</p>
<p>The results were int[] and Fastutil&rsquo;s Int2IntArrayMap consumed 8 bytes per entry, which is the optimal native (uncompressed) size expected given an int is 32 bits in Java (ie 4 bytes per int key + 4 bytes per int value).</p>
<p>The advantage of Int2IntArrayMap is it implements the Map interface abstraction while still providing dynamic resizing. This makes it simpler than directly using an int[] alternative.</p>
<p>Failure to specify a construction-time initialization size for Int2IntArrayMap reduces its space efficiency, but never to worse than Int2IntOpenHashMap (which is 13.1 bytes/entry). While the Int2IntArrayMap and int[] are the most space efficient, it comes with linear scanning access time costs. As an aside, Fastutil also offers &ldquo;big arrays&rdquo;, which can be useful if your arrays are so large they would exceed an integer-based index.</p>
<p>The Fastutil Red-Black and AVL tree maps both came in at 32 bytes per entry. As such they&rsquo;re still more efficient than any JDK provided version.</p>
<p>Those interested in map performance benchmarks might like to visit <a href="https://github.com/mikvor/hashmapTest/issues/3" rel="nofollow ugc">https://github.com/mikvor/hashmapTest/issues/3</a> for the latest hash map performance tests. It compares many implementations, including Koloboke and Fastutil.</p>
<p>Similarly if hashing performance is critical to your problem domain (eg Fastutil has various Object maps which can accept a custom hasher), I&rsquo;ve published graphs of 114 Java hash, CRC and checksum implementations at <a href="https://github.com/benalexau/hash-bench" rel="nofollow ugc">https://github.com/benalexau/hash-bench</a>.</p>
</div>
<ol class="children">
<li id="comment-197129" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-16T13:37:18+00:00">October 16, 2015 at 1:37 pm</time></a> </div>
<div class="comment-content">
<p><em>Fastutil also offers â€œbig arraysâ€, which can be useful if your arrays are so large they would exceed an integer-based index.</em></p>
<p>For these times when you really need an array that exceeds 8 GB.</p>
</div>
</li>
</ol>
</li>
</ol>
