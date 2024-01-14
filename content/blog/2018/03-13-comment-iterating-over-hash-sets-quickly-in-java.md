---
date: "2018-03-13 12:00:00"
title: "Iterating over hash sets quickly in Java"
index: false
---

[11 thoughts on &ldquo;Iterating over hash sets quickly in Java&rdquo;](/lemire/blog/2018/03-13-iterating-over-hash-sets-quickly-in-java)

<ol class="comment-list">
<li id="comment-298679" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4bafdfdb4a8ff3e836171de1f7030233?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4bafdfdb4a8ff3e836171de1f7030233?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://github.com/leventov" class="url" rel="ugc external nofollow">Roman Leventov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-13T22:10:18+00:00">March 13, 2018 at 10:10 pm</time></a> </div>
<div class="comment-content">
<p>HashSet jumps over the memory randomly. Locality could be a big contribution factor. See <a href="https://shipilev.net/jvm-anatomy-park/11-moving-gc-locality/" rel="nofollow ugc">https://shipilev.net/jvm-anatomy-park/11-moving-gc-locality/</a></p>
<p>It would be interesting to see how do benchmark results change if <code>System.gc()</code> is called right before the iteration.</p>
</div>
<ol class="children">
<li id="comment-298680" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-13T22:11:33+00:00">March 13, 2018 at 10:11 pm</time></a> </div>
<div class="comment-content">
<p><em>HashSet jumps over the memory randomly.</em></p>
<p>Can you elaborate?</p>
</div>
<ol class="children">
<li id="comment-298681" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4bafdfdb4a8ff3e836171de1f7030233?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4bafdfdb4a8ff3e836171de1f7030233?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/leventov" class="url" rel="ugc external nofollow">Roman Leventov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-13T22:20:31+00:00">March 13, 2018 at 10:20 pm</time></a> </div>
<div class="comment-content">
<p>When elements are inserted one after another in a HashSet, newly allocated HashMap.Entry are allocated sequentially (in a TLAB), but end up being stored at random positions in the HashMap&rsquo;s array. HashSet&rsquo;s (= HashMap&rsquo;s) iteration goes over the array sequentially, but it means jumping over HashMap.Entries, allocated at random positions in TLAB.</p>
<p>System.gc() may actually fix that, read the Alexey Shipilev&rsquo;s post for details.</p>
<p>LinkedHashMap links the entries in the allocation order, and iterates in the same order, it means that it scans TLAB memory sequentially.</p>
</div>
<ol class="children">
<li id="comment-298685" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-14T00:46:12+00:00">March 14, 2018 at 12:46 am</time></a> </div>
<div class="comment-content">
<p>I modified my code so that I call gc after creating the sets. It seems to only have a small effect. Calling the gc can even have a negative effect.</p>
<p>I tried recreating a new hash set from the previous hash set in the hope that the data would be allocated in the right order&#8230;</p>
<p>No luck:</p>
<pre>
Benchmark                                 (gc)   Mode  Samples    Score   Error  Units
m.l.m.h.OrderHash.scanHashSet            false  thrpt        5   51.079 Â± 0.431  ops/s
m.l.m.h.OrderHash.scanHashSet             true  thrpt        5   68.155 Â± 0.484  ops/s
m.l.m.h.OrderHash.scanHashSet2           false  thrpt        5   80.694 Â± 0.295  ops/s
m.l.m.h.OrderHash.scanHashSet2            true  thrpt        5   71.542 Â± 0.377  ops/s
m.l.m.h.OrderHash.scanLinkedHashSet      false  thrpt        5  165.367 Â± 2.858  ops/s
m.l.m.h.OrderHash.scanLinkedHashSet       true  thrpt        5  173.329 Â± 2.596  ops/s
</pre>
<p>See <a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2018/03/13/src/main/java/me/lemire/microbenchmarks/hash/OrderHash.java" rel="nofollow ugc">https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2018/03/13/src/main/java/me/lemire/microbenchmarks/hash/OrderHash.java</a></p>
</div>
<ol class="children">
<li id="comment-298700" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4bafdfdb4a8ff3e836171de1f7030233?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4bafdfdb4a8ff3e836171de1f7030233?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/leventov" class="url" rel="ugc external nofollow">Roman Leventov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-14T07:17:02+00:00">March 14, 2018 at 7:17 am</time></a> </div>
<div class="comment-content">
<p>Degradation is observed when a &ldquo;recreated&rdquo; set is iterated, as far as I can see. Possible reason might be that GC scans arrays in decreasing order (I don&rsquo;t know and don&rsquo;t assert that!), So GC might put objects in not very favourable order again.</p>
<p>Anyway, it&rsquo;s all just assumtions. Both of your benchmark results might be completely misleading, affected by some bugs or contribution factors that we didn&rsquo;t consider yet. Only study of perfasm with cycle as well as cache miss counts could help to answer those questions for sure.</p>
</div>
</li>
<li id="comment-298712" class="comment odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1674dda7ab81592f3b6f64909e31b56d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1674dda7ab81592f3b6f64909e31b56d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://marchmadness2018s.com" class="url" rel="ugc external nofollow">Illiash</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-14T13:44:20+00:00">March 14, 2018 at 1:44 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s work for me by the way 😀</p>
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
<li id="comment-298701" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Me</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-14T07:18:28+00:00">March 14, 2018 at 7:18 am</time></a> </div>
<div class="comment-content">
<p>Fastutil has additional implementations.<br/>
In particular, a hash set without chaining, but open addressing.</p>
<p>Can you include these in your benchmark? It would be interesting to see the differences even without the primitive specializations that make fastutil attractive.</p>
</div>
<ol class="children">
<li id="comment-298999" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-19T18:31:29+00:00">March 19, 2018 at 6:31 pm</time></a> </div>
<div class="comment-content">
<p>Pull Requests invited!</p>
</div>
</li>
</ol>
</li>
<li id="comment-299313" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b5b9c7a526b8a9c02dc8ba15ed5e151a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b5b9c7a526b8a9c02dc8ba15ed5e151a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mario Marinero</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-24T15:56:16+00:00">March 24, 2018 at 3:56 pm</time></a> </div>
<div class="comment-content">
<p>JavaScript only preserves insertion order for non-numeric properties. The actual iteration order is:</p>
<p>Numeric properties in ascending order.<br/>
String properties in insertion order.<br/>
Symbols.</p>
<p>ES 3 however described objects as &ldquo;unordered&rdquo;. A few years ago Firefox used insertion order for all properties and V8 browsers the current behavior. It seems ES6 finally established the iteration rules as it was causing quite a few bugs. <a href="http://2ality.com/2015/10/property-traversal-order-es6.html" rel="nofollow ugc">http://2ality.com/2015/10/property-traversal-order-es6.html</a></p>
</div>
<ol class="children">
<li id="comment-299316" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-24T17:06:13+00:00">March 24, 2018 at 5:06 pm</time></a> </div>
<div class="comment-content">
<p><em>JavaScript only preserves insertion order for non-numeric properties. (&#8230;) Numeric properties in ascending order.</em></p>
<p>Can you please type this in your favorite JavaScript console:</p>
<pre>$ var x = new Set()
$ x.insert(3)
$ x.insert(2)
$ x.insert(1)
$ for (let i of x) console.log(i);
</pre>
<p>(Update: I had pasted Swift code initially.)</p>
</div>
</li>
</ol>
</li>
<li id="comment-426274" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e6015dfaa65f69e10845aa7a86b8c83f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e6015dfaa65f69e10845aa7a86b8c83f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">zakhar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-05T14:59:25+00:00">September 5, 2019 at 2:59 pm</time></a> </div>
<div class="comment-content">
<p>I executed test on my pc and it show the following results</p>
<p>Benchmark (gc) Mode Cnt Score Error Units<br/>
collectionUtils.OrderHash.scanHashSet false thrpt 5 39,380 ± 1,357 ops/s<br/>
collectionUtils.OrderHash.scanHashSet true thrpt 5 38,749 ± 0,897 ops/s<br/>
collectionUtils.OrderHash.scanHashSet2 false thrpt 5 55,521 ± 15,549 ops/s<br/>
collectionUtils.OrderHash.scanHashSet2 true thrpt 5 64,839 ± 3,105 ops/s<br/>
collectionUtils.OrderHash.scanLinkedHashSet false thrpt 5 141,776 ± 23,246 ops/s<br/>
collectionUtils.OrderHash.scanLinkedHashSet true thrpt 5 143,821 ± 1,604 ops/s</p>
<p>why is that scanHashSet2 is almost twice as fast as scanHashSet?<br/>
it depends on the way it was filled?</p>
</div>
</li>
</ol>
