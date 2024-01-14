---
date: "2013-07-11 12:00:00"
title: "Big-O notation and real-world performance"
index: false
---

[16 thoughts on &ldquo;Big-O notation and real-world performance&rdquo;](/lemire/blog/2013/07-11-big-o-notation-and-real-world-performance)

<ol class="comment-list">
<li id="comment-89765" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b85e6b127c527c8dcebe18d1c985e48?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b85e6b127c527c8dcebe18d1c985e48?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://willwhim.wpengine.com" class="url" rel="ugc external nofollow">Will Fitzgerald</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-07-11T09:28:33+00:00">July 11, 2013 at 9:28 am</time></a> </div>
<div class="comment-content">
<p>This reminds me of my post, O(n) beats O(lg n) I wrote a while ago:</p>
<p><a href="http://willwhim.wpengine.com/2011/07/07/on-beats-olg-n/" rel="nofollow ugc">http://willwhim.wpengine.com/2011/07/07/on-beats-olg-n/</a></p>
</div>
</li>
<li id="comment-89813" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Itman</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-07-11T22:42:17+00:00">July 11, 2013 at 10:42 pm</time></a> </div>
<div class="comment-content">
<p>Further, Jeff Ulmann complained about people using easy test sets that show their algorithm working, while, in the real word this would not happen. Some, even cheat.</p>
<p>The same problem is with Big-O notation. Computer scientists derive new estimates using clever mathematical tricks. The problem is that these tricks introduce such enormous constants, so that (I believe) a majority of Big-O published formulas are totally bogus. </p>
<p>They are mathematically correct, but you would never get a sufficiently large n.</p>
</div>
</li>
<li id="comment-89823" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3484e2a454a76cba8a1bc2a81244d26a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3484e2a454a76cba8a1bc2a81244d26a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.walkingrandomly.com" class="url" rel="ugc external nofollow">Mike Croucher</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-07-12T02:44:38+00:00">July 12, 2013 at 2:44 am</time></a> </div>
<div class="comment-content">
<p>I recently optimised an algorithm that was part of a scientist&rsquo;s MATLAB program. I described how I did it to a computer scientist who poured scorn on my work &lsquo;Trival! It changes nothing in the big-O sense&rsquo; </p>
<p>The scientist, who&rsquo;s workflow was now many times faster, bought me a case of wine.</p>
</div>
</li>
<li id="comment-89843" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://sciencehouse.wordpress.com/" class="url" rel="ugc external nofollow">Carson Chow</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-07-12T11:54:38+00:00">July 12, 2013 at 11:54 am</time></a> </div>
<div class="comment-content">
<p>I think another way to say this is that for real world problems the constant matters. If you really want to know what is faster you need to work harder and get a sharp bound. Big-O just tells you how the bound will scale with size. However, if the difference is between O(log(n)) and O(n), then the ratio of constants must be pretty big for log(n) not to win for any appreciable n.</p>
</div>
</li>
<li id="comment-89845" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Itman</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-07-12T12:22:04+00:00">July 12, 2013 at 12:22 pm</time></a> </div>
<div class="comment-content">
<p>@Carson Chow. The problem is that it is not always log(n) vs n. Quite often it is log^3(n) or, say, log^5(n). (have a real example, of course).</p>
</div>
</li>
<li id="comment-89848" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3ccaf45d7ab8ecc0e412fe911c9b9d10?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3ccaf45d7ab8ecc0e412fe911c9b9d10?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.cs.utah.edu/~regehr/" class="url" rel="ugc external nofollow">John Regehr</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-07-12T12:47:44+00:00">July 12, 2013 at 12:47 pm</time></a> </div>
<div class="comment-content">
<p>Mike, you need to find a computer scientist to talk to who isn&rsquo;t an idiot.</p>
</div>
</li>
<li id="comment-89851" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/db30653dd9479bbbcc01413081ee2496?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/db30653dd9479bbbcc01413081ee2496?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://mcw.wordpress.fos.auckland.ac.nz" class="url" rel="ugc external nofollow">Mark C. Wilson</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-07-12T13:34:50+00:00">July 12, 2013 at 1:34 pm</time></a> </div>
<div class="comment-content">
<p>In addition to this point, the smaller but important point is that big-O gives only an upper bound, asymptotically, and not necessarily a tight one. Use big-Omega for that. See <a href="http://mcw.wordpress.fos.auckland.ac.nz/2011/09/27/big-omicron-and-big-omega-and-big-theta/" rel="nofollow ugc">http://mcw.wordpress.fos.auckland.ac.nz/2011/09/27/big-omicron-and-big-omega-and-big-theta/</a></p>
</div>
</li>
<li id="comment-89863" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b4f7452c0ec9116cd0e4cdb9c3262726?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b4f7452c0ec9116cd0e4cdb9c3262726?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michael Mitzenmacher</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-07-12T18:29:43+00:00">July 12, 2013 at 6:29 pm</time></a> </div>
<div class="comment-content">
<p>So, if I may paraphrase, big O-notation is a mathematically very useful notion that allows us to talk about algorithms very reasonably, and often corresponds pretty directly to reality. But you have to consider it with a grain of salt &#8212; hidden constant factors, the fact that it&rsquo;s asymptotic, it doesn&rsquo;t (by itself, necessarily) take into account parallelism/caches/other hardware issues all are things to worry about. </p>
<p>Great. My lecture in my algorithms class has all bases covered.</p>
</div>
</li>
<li id="comment-89864" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b4f7452c0ec9116cd0e4cdb9c3262726?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b4f7452c0ec9116cd0e4cdb9c3262726?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michael Mitzenmacher</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-07-12T18:30:29+00:00">July 12, 2013 at 6:30 pm</time></a> </div>
<div class="comment-content">
<p>(Oh, and I forgot &#8212; it&rsquo;s worst case analysis, not average/typical/whatever your case is analysis. That&rsquo;s in my lecture too.)</p>
</div>
</li>
<li id="comment-89884" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-07-12T23:23:41+00:00">July 12, 2013 at 11:23 pm</time></a> </div>
<div class="comment-content">
<p>@Michael</p>
<p>I would hope that everything in this blog post is standard knowledge and uncontroversial.</p>
</div>
</li>
<li id="comment-89887" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b4f7452c0ec9116cd0e4cdb9c3262726?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b4f7452c0ec9116cd0e4cdb9c3262726?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michael Mitzenmacher</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-07-12T23:45:48+00:00">July 12, 2013 at 11:45 pm</time></a> </div>
<div class="comment-content">
<p>While I&rsquo;d agree that the limitations of the O notation you describe should be uncontroversial (and should be clearly taught with the notation), I think you exaggerate when you say:<br/>
&ldquo;However, when designing a software system, the fraction of your decisions that rely on big-O analysis is small. Good engineers rely on more sophisticated models and metrics.&rdquo;<br/>
and<br/>
&ldquo;The big-O notation is far more limited in its applications.&rdquo;<br/>
In my experience, a great many basic decisions stem from understanding what your code is doing at the level of counting operations &#8212; is it linear, quadratic, n log n, etc. &#8212; and then fine-tuning for constant factors. </p>
<p>So while I agree with all of your caveats, I think of O-notation as not being useful as still an exceptional rather than common case.</p>
</div>
</li>
<li id="comment-90038" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8af88bac916c9bf3f45831c114d30b0e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8af88bac916c9bf3f45831c114d30b0e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://jltsiren.kapsi.fi/" class="url" rel="ugc external nofollow">Jouni</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-07-15T09:49:22+00:00">July 15, 2013 at 9:49 am</time></a> </div>
<div class="comment-content">
<p>Asymptotic analysis tends to be more relevant with polynomial complexities than with (poly-)logarithmic ones. After all, log n â‰ˆ 30 is usually a reasonable estimate, while cache misses cost from tens to hundreds of CPU cycles.</p>
</div>
</li>
<li id="comment-90040" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Itman</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-07-15T10:07:33+00:00">July 15, 2013 at 10:07 am</time></a> </div>
<div class="comment-content">
<p>Jouni, as far as I remember (let anybody correct me if I am wrong), quadratic time algorithm for suffix-tree(array) construction are faster in practice than linear ones.</p>
</div>
</li>
<li id="comment-90043" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8af88bac916c9bf3f45831c114d30b0e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8af88bac916c9bf3f45831c114d30b0e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://jltsiren.kapsi.fi/" class="url" rel="ugc external nofollow">Jouni</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-07-15T10:36:05+00:00">July 15, 2013 at 10:36 am</time></a> </div>
<div class="comment-content">
<p>Itman: A few years ago the fastest suffix array construction algorithms (at least under some assumptions) were indeed O(n^2 log n)-time. These days the fastest well-known implementation (under similar assumptions) is Yuta Mori&rsquo;s libdivsufsort, which uses an O(n log n)-time algorithm.</p>
<p>The caveat is that the benchmarks are usually done with small inputs of up to ~100 MB in size. With such small inputs, memory locality and various heuristic tricks play more important role than in the multi-gigabyte range.</p>
</div>
</li>
<li id="comment-90047" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Itman</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-07-15T11:16:14+00:00">July 15, 2013 at 11:16 am</time></a> </div>
<div class="comment-content">
<p>Jouni,</p>
<p>Thank you for the update. Yes, this may be the case. But, still, up to a &ldquo;small&rdquo; 100 MB input, the quadratic beats the classic LINEAR.</p>
</div>
</li>
<li id="comment-90075" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8af88bac916c9bf3f45831c114d30b0e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8af88bac916c9bf3f45831c114d30b0e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://jltsiren.kapsi.fi/" class="url" rel="ugc external nofollow">Jouni</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-07-15T23:28:30+00:00">July 15, 2013 at 11:28 pm</time></a> </div>
<div class="comment-content">
<p>Itman: The quadratic complexities of those fast algorithms are basically rough upper bounds. A reasonably straightforward implementation of naive suffix sorting takes O(nL log n) time, where L is the average LCP value. The fast &ldquo;quadratic time&rdquo; algorithms basically improve upon this in two ways:</p>
<p>1) They identify a subset of suffixes, whose sorted order can be used to induce the order of the rest of the suffixes. This typically improves the running time by a constant factor.</p>
<p>2) They use some heuristics to identify long repetitions, and sort them in some other way. There are known bad cases for some of the heuristics, but even then the asymptotic complexity does not grow over the naive O(nL log n). For other heuristics, neither bad cases nor better time bounds are known.</p>
<p>Now consider a snapshot of the English language Wikipedia. In the first tens of megabytes, the average LCP is in low tens. When we increase dataset size to hundreds of megabytes or even a few gigabytes, L increases into the 50-100 range. After that, L starts to rise, reaching the 500-1000 range with dataset size in tens of gigabytes.</p>
<p>Then consider the human genome. Due to the long runs of Ns (unknown bases), the average LCP in the entire reference genome is in hundreds of thousands. Yet this is exactly the kind of repetition the heuristics in the quadratic algorithms can easily handle. If we ignore the Ns, the average LCP drops below 100 for the most of the chromosomes (I couldn&rsquo;t find the numbers for the entire genome).</p>
<p>In both cases, asymptotic analysis gives us reasons to believe that the speed of the &ldquo;quadratic&rdquo; algorithms should be in the same neighborhood as the linear and O(n log n)-time algorithms, at least if we consider the typical ~100 MB test cases. Yet as the Wikipedia example suggests, the situation may change with larger inputs.</p>
</div>
</li>
</ol>
