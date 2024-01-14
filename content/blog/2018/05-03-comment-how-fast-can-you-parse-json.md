---
date: "2018-05-03 12:00:00"
title: "How fast can you parse JSON?"
index: false
---

[11 thoughts on &ldquo;How fast can you parse JSON?&rdquo;](/lemire/blog/2018/05-03-how-fast-can-you-parse-json)

<ol class="comment-list">
<li id="comment-302429" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/02d257cd405544564222bbdf504ef4d7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/02d257cd405544564222bbdf504ef4d7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Geoff Langdale</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-03T01:33:24+00:00">May 3, 2018 at 1:33 am</time></a> </div>
<div class="comment-content">
<p>Another question (open to debate): should the cost of parsing include validation? Is it reasonable to quietly return &ldquo;reasonable&rsquo; results of a query on something that isn&rsquo;t valid JSON?</p>
<p>This is a query that affects Mison more (as far as I can tell). Mison&rsquo;s ability to skip fields <em>might</em> allow it to pass over JSON syntax errors without noticing (they didn&rsquo;t publish code, so I can tell for sure).</p>
</div>
</li>
<li id="comment-302445" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/310888ddd541f84065eb6fa2a820d09d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/310888ddd541f84065eb6fa2a820d09d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://github.com/plokhotnyuk" class="url" rel="ugc external nofollow">Andriy Plokhotnyuk</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-03T04:34:23+00:00">May 3, 2018 at 4:34 am</time></a> </div>
<div class="comment-content">
<p>How fast? It depends&#8230;</p>
<p>If you consider Jackson from the JVM world then, please, try jsoniter-scala:</p>
<p><a href="https://github.com/plokhotnyuk/jsoniter-scala" rel="nofollow ugc">https://github.com/plokhotnyuk/jsoniter-scala</a></p>
<p>It parses from input streams or byte arrays immediately to Scala data structures without any intermediate representation like strings, hash maps, etc.</p>
<p>So jsoniter-scala is much safer and efficient than any other JSON-parser for Scala.</p>
<p>It has methods for scanning through multi-Gb value streams or JSON arrays and parse values without need to hold them all in memory:</p>
<p><a href="https://github.com/plokhotnyuk/jsoniter-scala/blob/master/core/src/main/scala/com/github/plokhotnyuk/jsoniter_scala/core/package.scala#L79" rel="nofollow ugc">https://github.com/plokhotnyuk/jsoniter-scala/blob/master/core/src/main/scala/com/github/plokhotnyuk/jsoniter_scala/core/package.scala#L79</a></p>
<p>Also, it has outstanding features like fast skipping of not needed fields (key/value pairs) or crazily fast parsing and serialization of java.time.* classes.</p>
<p>Just see benchmark results below. BTW, they include results for parsing and serialization of messages from the Twitter API:</p>
<p><a href="http://jmh.morethan.io/?source=https://plokhotnyuk.github.io/jsoniter-scala/jdk8.json" rel="nofollow ugc">http://jmh.morethan.io/?source=https://plokhotnyuk.github.io/jsoniter-scala/jdk8.json</a></p>
<p>All results for JDK 8/10 and GraalVM CE/EE on the one page:</p>
<p><a href="https://plokhotnyuk.github.io/jsoniter-scala/" rel="nofollow ugc">https://plokhotnyuk.github.io/jsoniter-scala/</a></p>
<p>WARNING: Results of GraalVM CE/EE are only for a rough evaluation of possible potential of this new tech.<br/>
Final results can be changed significantly after JMH tool and GraalVM developers will provide mutual compatibility.</p>
<p>In most cases jsoniter-scala works on par with best <em>binary</em> serializers for Java and Scala:</p>
<p><a href="https://github.com/dkomanov/scala-serialization/pull/8" rel="nofollow ugc">https://github.com/dkomanov/scala-serialization/pull/8</a></p>
</div>
<ol class="children">
<li id="comment-348898" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/310888ddd541f84065eb6fa2a820d09d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/310888ddd541f84065eb6fa2a820d09d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/plokhotnyuk/jsoniter-scala" class="url" rel="ugc external nofollow">Andriy Plokhotnyuk</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-11T16:03:19+00:00">September 11, 2018 at 4:03 pm</time></a> </div>
<div class="comment-content">
<p>For some limited kind of work like parsing with projection or parsing of arrays of UUIDs jsoniter-scala can archive 2 bytes per cycle (or ~2Gb per second on contemporary desktops) that is quite competitive with the state of art filter/parsers like <a href="https://github.com/guillaumebort/mison" rel="nofollow">Mison</a> or <a href="https://github.com/stanford-futuredata/sparser" rel="nofollow">Sparser</a>.</p>
<p>Results and code of projection benchmark:</p>
<p><a href="https://github.com/guillaumebort/mison/pull/1" rel="nofollow ugc">https://github.com/guillaumebort/mison/pull/1</a></p>
<p>Results (need to scroll down to ArrayOfUUIDsBenchmark section) and code of benchmark for parsing of UUID arrays:</p>
<p><a href="http://jmh.morethan.io/?source=https://plokhotnyuk.github.io/jsoniter-scala/oraclejdk11.json" rel="nofollow ugc">http://jmh.morethan.io/?source=https://plokhotnyuk.github.io/jsoniter-scala/oraclejdk11.json</a></p>
<p><a href="https://github.com/plokhotnyuk/jsoniter-scala/blob/master/jsoniter-scala-benchmark/src/main/scala/com/github/plokhotnyuk/jsoniter_scala/macros/ArrayOfUUIDsBenchmark.scala" rel="nofollow ugc">https://github.com/plokhotnyuk/jsoniter-scala/blob/master/jsoniter-scala-benchmark/src/main/scala/com/github/plokhotnyuk/jsoniter_scala/macros/ArrayOfUUIDsBenchmark.scala</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-302457" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4e12e7f8340bf6bdf4b57992d8f9c692?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4e12e7f8340bf6bdf4b57992d8f9c692?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Vincent Bernat</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-03T06:37:50+00:00">May 3, 2018 at 6:37 am</time></a> </div>
<div class="comment-content">
<p>Using a loop with the same input may give an unfair advantage to Java as the JIT may kick in and optimize the code for the input. The effect could exist in C++ at a smaller scale with the branch prediction getting better. As an example of such flawed benchmark: <a href="https://github.com/nodejs/node/pull/1457#issuecomment-94188258" rel="nofollow ugc">https://github.com/nodejs/node/pull/1457#issuecomment-94188258</a>.</p>
<p>I didn&rsquo;t read the Microsoft paper, so this is pure speculation on my side.</p>
</div>
</li>
<li id="comment-302461" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/78ca803e4484e6d52a2ed46334163b1f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/78ca803e4484e6d52a2ed46334163b1f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">stegua</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-03T06:50:29+00:00">May 3, 2018 at 6:50 am</time></a> </div>
<div class="comment-content">
<p>I am a happy user of RapidJSON, selected after looking at this nice benchmarks: <a href="https://github.com/miloyip/nativejson-benchmark" rel="nofollow">nativejson-benchmark</a>.<br/>
Unfortunately, that benchmark does not include Java libraries.</p>
</div>
</li>
<li id="comment-302466" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d02f3f0f51f07cabb11ad9589b64f4a4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d02f3f0f51f07cabb11ad9589b64f4a4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-03T08:02:43+00:00">May 3, 2018 at 8:02 am</time></a> </div>
<div class="comment-content">
<p>It does make a lot of sense!</p>
<p>Does it look like they claim 16 cycles per byte and you think it is 4? You may be right. Benchmarking is hard. But take a look at the abstract &#8211; 10x improvement for &ldquo;analytical&rdquo;, &ldquo;FSM&rdquo; (and probably some SIMD)?</p>
<p>Analytical? Dom style parser will always loose reading 3 out of 20 (per record). I would expect streaming parser to do 2x+ better. No allocations, copying or parsing digits into numbers nobody will use.</p>
<p>How are streaming parsers implemented? Which one is not a loop reading character by character (byte by byte)? Can any compiler vectorize that? (and remove branching?)</p>
<p>Modern regexp libraries (like hyperscan) show great results with vectorized FSM. I believe such techniques would speed up analytical query over json (scanning for 50 bytes out of 1000 bytes record).</p>
<p>Does it matter? Json is de facto standard format for data exchange between companies these days. Many open datasets and just about every startup use json extensively. So yeah, if someone (Microsoft?) spend the time doing it, please open source it! I would greatly appreciate having it in spark!</p>
<p>BTW: No, you will not get 10x in practice. Nobody does json, everybody does json.gz. But gzip is very slow. Thanks to Amdahl&rsquo;s law you will get only 2x improvement with vectorized FSM json parser. Gunzip will take 90% cpu then.</p>
</div>
</li>
<li id="comment-303218" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://boyts" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-11T17:27:25+00:00">May 11, 2018 at 5:27 pm</time></a> </div>
<div class="comment-content">
<p>Great pointer: it&rsquo;s fast and header-only. Thanks a lot!<br/>
Regarding Java vs C++. They are pretty close. In the land of the search engines, we see more carefully implemented Java engines beat C++ implementations. We all know Lucene is very fast and hard to beat. There is another example: Galago is a Java re implementation of Indri. So, it uses a similar query evaluation paradigm, but it is nevertheless about 2x faster.</p>
</div>
<ol class="children">
<li id="comment-303234" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-11T20:43:52+00:00">May 11, 2018 at 8:43 pm</time></a> </div>
<div class="comment-content">
<p>Yes. I am not assuming that Java is slower than C++ in actual systems, but RapidJSON is C++ written with performance in mind.</p>
<p>When parsing bytes, there are tricks that are easy in C++ but hard in Java.</p>
</div>
</li>
</ol>
</li>
<li id="comment-306812" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e56972270335da29ddd62580416412c4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e56972270335da29ddd62580416412c4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.codesign2.co.uk" class="url" rel="ugc external nofollow">Lewis Cowles</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-04T07:38:31+00:00">June 4, 2018 at 7:38 am</time></a> </div>
<div class="comment-content">
<p>Surely being stringly makes JSON inefficient from a processor standpoint anyway?</p>
<p>Also are those 8 cycles / byte a simplification because of amortised costs? (unless it&rsquo;s unique to Skylake lines).</p>
</div>
<ol class="children">
<li id="comment-306948" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-05T03:54:30+00:00">June 5, 2018 at 3:54 am</time></a> </div>
<div class="comment-content">
<p><em>Surely being stringly makes JSON inefficient from a processor standpoint anyway?</em></p>
<p>Not necessarily.</p>
<p><em>Also are those 8 cycles / byte a simplification because of amortised costs? (unless it&rsquo;s unique to Skylake lines).</em></p>
<p>It is specific to the machine I tested on.</p>
</div>
</li>
</ol>
</li>
<li id="comment-348883" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/310888ddd541f84065eb6fa2a820d09d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/310888ddd541f84065eb6fa2a820d09d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/plokhotnyuk/jsoniter-scala" class="url" rel="ugc external nofollow">Andriy Plokhotnyuk</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-11T14:35:23+00:00">September 11, 2018 at 2:35 pm</time></a> </div>
<div class="comment-content">
<p>For some limited kind of work like parsing with projection or parsing of arrays of UUIDs jsoniter-scala can archive 2 bytes per cycle (or ~2Gb per second on contemporary desktops) that is quite competitive with the state of art filter/parsers like <a href="https://github.com/guillaumebort/mison" rel="nofollow">Mison</a> or <a href="https://github.com/stanford-futuredata/sparser" rel="nofollow">Sparser</a>.</p>
<p>Results and code of projection benchmark:</p>
<p><a href="https://github.com/guillaumebort/mison/pull/1" rel="nofollow ugc">https://github.com/guillaumebort/mison/pull/1</a></p>
<p>Results (need to scroll down to ArrayOfUUIDsBenchmark section) and code of benchmark for parsing of UUID arrays:</p>
<p><a href="http://jmh.morethan.io/?source=https://plokhotnyuk.github.io/jsoniter-scala/oraclejdk11.json" rel="nofollow ugc">http://jmh.morethan.io/?source=https://plokhotnyuk.github.io/jsoniter-scala/oraclejdk11.json</a></p>
<p><a href="https://github.com/plokhotnyuk/jsoniter-scala/blob/master/jsoniter-scala-benchmark/src/main/scala/com/github/plokhotnyuk/jsoniter_scala/macros/ArrayOfUUIDsBenchmark.scala" rel="nofollow ugc">https://github.com/plokhotnyuk/jsoniter-scala/blob/master/jsoniter-scala-benchmark/src/main/scala/com/github/plokhotnyuk/jsoniter_scala/macros/ArrayOfUUIDsBenchmark.scala</a></p>
</div>
</li>
</ol>
