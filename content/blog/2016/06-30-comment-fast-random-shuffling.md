---
date: "2016-06-30 12:00:00"
title: "Fast random shuffling"
index: false
---

[35 thoughts on &ldquo;Fast random shuffling&rdquo;](/lemire/blog/2016/06-30-fast-random-shuffling)

<ol class="comment-list">
<li id="comment-245771" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/37f080c97205e2b72a6d25a5be3babd5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/37f080c97205e2b72a6d25a5be3babd5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://github.com/Erkaman" class="url" rel="ugc external nofollow">Eric ArnebÃ¤ck</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-30T06:29:35+00:00">June 30, 2016 at 6:29 am</time></a> </div>
<div class="comment-content">
<p>Nice article! </p>
<p>Do you know if it is possible to implement an even faster shuffle on the GPU, using something like CUDA?</p>
</div>
<ol class="children">
<li id="comment-245800" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-30T13:56:16+00:00">June 30, 2016 at 1:56 pm</time></a> </div>
<div class="comment-content">
<p>It is important to distinguish a random shuffle from a &ldquo;fair&rdquo; random shuffle as discussed. For a fair random shuffle, I do not know a good way to benefit from GPU execution.</p>
</div>
</li>
<li id="comment-296632" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4cf428b20781c0363edea41d922f0bd0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4cf428b20781c0363edea41d922f0bd0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://facebook.com/patrickayan" class="url" rel="ugc external nofollow">Joseph Hoover</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-02-11T23:32:54+00:00">February 11, 2018 at 11:32 pm</time></a> </div>
<div class="comment-content">
<p>it is not because you cannot parallize routines that depend on shared memory if that shared memory is being used by other threads for swapping routines</p>
</div>
</li>
</ol>
</li>
<li id="comment-245804" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9522425587344b887bcb7c65d236f3a3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9522425587344b887bcb7c65d236f3a3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://blog.demofox.org" class="url" rel="ugc external nofollow">Demofox</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-30T14:28:38+00:00">June 30, 2016 at 2:28 pm</time></a> </div>
<div class="comment-content">
<p>Appologies for double posting this, but it applies here too in a way that might not be obvious! On the &ldquo;Picking N distinct numbers at random&rdquo; post i mention you can use &ldquo;format preserving encryption&rdquo; to get those N distinct numbers. You can actually also use it to get distinct numbers [0,N) which means that the numbers you get out are the index for a shuffle. Since encryption requires a key, it&rsquo;s seedable to generate multiple shuffles.</p>
<p>In other words, you can use format preserving encryption to make a shuffle iterator that visits each item once and only once, and tells you when you have visited all items. You can do this in O(1), without actually shuffling the list or even storing the whole list in memory at once!</p>
<p>If you care about cache friendliness, it (by itself?) isn&rsquo;t the way to go, but it can be very good for a very quick, virtually storageless shuffle.</p>
<p><a href="http://blog.demofox.org/2013/07/06/fast-lightweight-random-shuffle-functionality-fixed/" rel="nofollow ugc">http://blog.demofox.org/2013/07/06/fast-lightweight-random-shuffle-functionality-fixed/</a></p>
</div>
<ol class="children">
<li id="comment-245806" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-30T14:38:47+00:00">June 30, 2016 at 2:38 pm</time></a> </div>
<div class="comment-content">
<p>Yes, that&rsquo;s an interesting approach.</p>
<p>As noted at the beginning of my blog post, it is remarkably difficult to come up with algorithms that produce a fair shuffle. You have to demonstrate that every possible permutation is equally likely. If you drop this fairness requirement, then various faster alternatives become possible.</p>
</div>
</li>
</ol>
</li>
<li id="comment-245827" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/33f0d62420aaf69e20088bf068076248?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/33f0d62420aaf69e20088bf068076248?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">George Kangas</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-30T18:32:00+00:00">June 30, 2016 at 6:32 pm</time></a> </div>
<div class="comment-content">
<p>About that piece of C code: in line 3, is &ldquo;newpos&rdquo; supposed to be &ldquo;p&rdquo;?</p>
</div>
<ol class="children">
<li id="comment-245832" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-30T18:45:22+00:00">June 30, 2016 at 6:45 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for paying attention. Yes. It was a typo.</p>
</div>
</li>
</ol>
</li>
<li id="comment-245842" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/62aaaf6dfc5c0fd3c037fa9fb106c677?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/62aaaf6dfc5c0fd3c037fa9fb106c677?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marc Reynolds</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-30T21:33:32+00:00">June 30, 2016 at 9:33 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t understand the:<br/>
&ldquo;no map from all 32-bit integers to a range can be perfectly fair&rdquo;</p>
<p>If the source is assumed to be uniform and the mapping to a smaller range is unbiased then what is not &ldquo;fair&rdquo; about the result?</p>
</div>
<ol class="children">
<li id="comment-245845" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/62aaaf6dfc5c0fd3c037fa9fb106c677?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/62aaaf6dfc5c0fd3c037fa9fb106c677?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marc Reynolds</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-30T21:48:07+00:00">June 30, 2016 at 9:48 pm</time></a> </div>
<div class="comment-content">
<p>Ah! Nevermind you&rsquo;re saying in general..mapping a single value to the smaller range. I find the wording off&#8230;I was assuming you were talking about a rejection method.</p>
</div>
</li>
</ol>
</li>
<li id="comment-245915" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0b1c230af87044cc435069d076ce51f7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0b1c230af87044cc435069d076ce51f7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jim Apple</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-01T14:23:26+00:00">July 1, 2016 at 2:23 pm</time></a> </div>
<div class="comment-content">
<p>Have you considered submitting patches for libstdc++, libc++, glibc, etc.?</p>
</div>
<ol class="children">
<li id="comment-245920" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-01T14:49:09+00:00">July 1, 2016 at 2:49 pm</time></a> </div>
<div class="comment-content">
<p>@Jim </p>
<p>Does <em>glibc</em> have a function providing a fair random shuffle?</p>
<p>As for the C++ libraries, that could be interesting.</p>
</div>
<ol class="children">
<li id="comment-245921" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-01T14:50:49+00:00">July 1, 2016 at 2:50 pm</time></a> </div>
<div class="comment-content">
<p>Of course, one problem that one can encounter in such cases is that standard libraries may depend on really slow random number generators (for good or bad reasons). That can make the point irrelevant since the bottleneck is not in the shuffle function itself.</p>
</div>
</li>
<li id="comment-246106" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0b1c230af87044cc435069d076ce51f7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0b1c230af87044cc435069d076ce51f7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jim Apple</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-03T16:11:25+00:00">July 3, 2016 at 4:11 pm</time></a> </div>
<div class="comment-content">
<p>strfry isn&rsquo;t fair, but it is random.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-247889" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b0c28eb357bb2ad8dee40d974871340?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b0c28eb357bb2ad8dee40d974871340?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Erich</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-25T23:20:35+00:00">July 25, 2016 at 11:20 pm</time></a> </div>
<div class="comment-content">
<p>Is there a similar approach for generating doubles in [0;1[?</p>
<p>Java generates a 53 bit long, then does a division by (double)(1L &lt;&lt; 53).</p>
</div>
<ol class="children">
<li id="comment-247892" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-25T23:43:31+00:00">July 25, 2016 at 11:43 pm</time></a> </div>
<div class="comment-content">
<p>Are you sure that a division is computed by the CPU? I suspect that Java might be smart enough to turn the division into a multiplication.</p>
</div>
<ol class="children">
<li id="comment-247918" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b0c28eb357bb2ad8dee40d974871340?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b0c28eb357bb2ad8dee40d974871340?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Erich</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-26T05:48:34+00:00">July 26, 2016 at 5:48 am</time></a> </div>
<div class="comment-content">
<p>Not that I know of &#8211; as far as I know, it can improve Java performance to write *0.5 instead of /2 if it is a highly critical path (it may not often make a difference because of cache wait times). In general 1/N is usually no longer exact representable by a double; so this transformation only works for powers of two without loss IIRC.</p>
<p>I plan on doing some benchmarks with JMH; but if you have some other ideas, I&rsquo;d be happy to know.</p>
</div>
<ol class="children">
<li id="comment-247952" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-26T13:13:36+00:00">July 26, 2016 at 1:13 pm</time></a> </div>
<div class="comment-content">
<p>What would prevent the compiler from turning &ldquo;/ (double)(1L << 53)" into " * (1 /(double)(1L << 53))" where " (1 /(double)(1L << 53))" can be computed at compile time?
</p>
</div>
<ol class="children">
<li id="comment-248027" class="comment odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b0c28eb357bb2ad8dee40d974871340?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b0c28eb357bb2ad8dee40d974871340?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Erich</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-27T09:17:49+00:00">July 27, 2016 at 9:17 am</time></a> </div>
<div class="comment-content">
<p>The Java compiler is not meant to do any such optimization &#8211; I believe by design they want the compiler to only translate into bytecode, and have HotSpot to do such optimizations. But I don&rsquo;t think it ever does division to mulitplication optimizations. I believe ProGuard may be able to do such though at the bytecode level.</p>
<p>In general, it will not be possible: if I&rsquo;m not mistaken /3 and *(1/3) may not produce the exact same results due to numerical issues. (powers of 2 are; so for above case it is possible &#8211; but I could not find such transformations in hotspot).</p>
</div>
<ol class="children">
<li id="comment-248046" class="comment byuser comment-author-lemire bypostauthor even depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-27T14:39:58+00:00">July 27, 2016 at 2:39 pm</time></a> </div>
<div class="comment-content">
<p>I think you are correct that the Java compiler won&rsquo;t do this optimization (though, admittedly, I did not check). But I do not think it is difficult as clang appears to do it automagically with C code when dividing by a power of two.</p>
<p>This being said, Java does benefit from this optimization in the end because it is hand coded in ThreadLocalRandom (in the Java 8 version I checked). </p>
<p>I suspect that you got â€œ/ (double)(1L << 53)" by looking at the Random class, but that's an hopelessly slow class, almost by design. Please see my other blog post on this topic:
<a href="https://lemire.me/blog/2016/02/01/default-random-number-generators-are-slow/" rel="ugc">http://lemire.me/blog/2016/02/01/default-random-number-generators-are-slow/</a></p>
<p>So I think it does answer your original query, does it not?</p>
</div>
<ol class="children">
<li id="comment-248051" class="comment odd alt depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b0c28eb357bb2ad8dee40d974871340?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b0c28eb357bb2ad8dee40d974871340?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Erich</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-27T16:17:20+00:00">July 27, 2016 at 4:17 pm</time></a> </div>
<div class="comment-content">
<p>Yes, in particular at compile time this should be rather easy to do. I can imagine that some of these easy things just add up too much when you do this at runtime.</p>
<p>But from initial benchmarks, I may be wrong and HotSpot does optimize this to no measureable difference; or CPU pipelineing makes up for these differences.</p>
</div>
<ol class="children">
<li id="comment-248055" class="comment byuser comment-author-lemire bypostauthor even depth-8">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-27T17:18:59+00:00">July 27, 2016 at 5:18 pm</time></a> </div>
<div class="comment-content">
<p><em>CPU pipelineing makes up for these differences</em></p>
<p>Your benchmark might have other bottlenecks&#8230; but a division is massively more expensive than a multiplication so it has to show in the end result if you don&rsquo;t have much else going on. Pipelining does not help much with the division because it has both a low throughput and a low latency.</p>
<p>My own test seems to indicate that Java is smart enough to turn a division by a power of two into a multiplication:<br/>
<code><br/>
Benchmark Mode Samples Score Error Units<br/>
m.l.m.r.Division.division thrpt 5 115439397.412 Â± 65683.557 ops/s<br/>
m.l.m.r.Division.divisionBy3 thrpt 5 60568277.782 Â± 13316.776 ops/s<br/>
m.l.m.r.Division.divisionBy3ThroughMultiplication thrpt 5 115443682.953 Â± 91673.580 ops/s<br/>
m.l.m.r.Division.precompDivision thrpt 5 115446809.914 Â± 75424.232 ops/s<br/>
</code></p>
<p><a href="https://github.com/lemire/microbenchmarks/blob/master/src/main/java/me/lemire/microbenchmarks/random/Division.java" rel="nofollow ugc">https://github.com/lemire/microbenchmarks/blob/master/src/main/java/me/lemire/microbenchmarks/random/Division.java</a></p>
<p>In this particular instance, we see that the throughput is diminished by a factor of two. I would expect a larger difference, but my microbenchmark has limitations.</p>
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
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-252079" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bc7600990942c71ed5e01e0372a4dd14?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bc7600990942c71ed5e01e0372a4dd14?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Damian Vuleta</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-10T14:15:50+00:00">September 10, 2016 at 2:15 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;What can we expect to limit the speed of this algorithm? Let me assume that we do not use fancy SIMD instructions or parallelization.&rdquo;</p>
<p>The Fisher-Yates algorithm appears to me to be inherently sequential. How might parallelisation or SIMD be applicable here (apart from the random number generation)?</p>
</div>
<ol class="children">
<li id="comment-252087" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-10T16:33:54+00:00">September 10, 2016 at 4:33 pm</time></a> </div>
<div class="comment-content">
<p>I think that you are correct. Fisher-Yates appears inherently sequential.</p>
</div>
<ol class="children">
<li id="comment-252180" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bc7600990942c71ed5e01e0372a4dd14?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bc7600990942c71ed5e01e0372a4dd14?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Damian Vuleta</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-12T12:12:31+00:00">September 12, 2016 at 12:12 pm</time></a> </div>
<div class="comment-content">
<p>Which makes me wonder: how many other shuffling algorithms which might be parallelisable (is that a word?) are as thorough, and anywhere near as simple, as Fisher-Yates?</p>
</div>
<ol class="children">
<li id="comment-252190" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-12T13:03:58+00:00">September 12, 2016 at 1:03 pm</time></a> </div>
<div class="comment-content">
<p>You can easily parallelize shuffling in the following manner. During a first pass, send each of the values to one of N buckets, by picking a random integer in [0,N). Then shuffle each bucket using Fisher-Yates. Finally, aggregate the shuffled buckets: take all values from the first bucket, then all values from the second bucket and so forth.</p>
<p>One major defect of such an alternative is that it is not in-place.</p>
</div>
<ol class="children">
<li id="comment-592064" class="comment odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4f0c4b69380ca0a9d450433d5d7a48c1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4f0c4b69380ca0a9d450433d5d7a48c1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Damian Vuleta</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-25T10:15:22+00:00">July 25, 2021 at 10:15 am</time></a> </div>
<div class="comment-content">
<p>You were quite right:<br/>
<a href="https://blog.janestreet.com/how-to-shuffle-a-big-dataset/" rel="nofollow ugc">https://blog.janestreet.com/how-to-shuffle-a-big-dataset/</a></p>
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
<li id="comment-263827" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3179e3e91f86a74d223264a25fef417e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3179e3e91f86a74d223264a25fef417e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Pauli</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-26T20:20:46+00:00">December 26, 2016 at 8:20 pm</time></a> </div>
<div class="comment-content">
<p>Parallel shuffle can be done inplace using partitions (equal size balanced &ldquo;tree&rdquo;, unbalanced remainder requires separate shuffling). Partitions are shuffled with Fisher-Yates in parallel. After that one can use random element swap merge to combine partitions with reducing number of threads. Merge can be optimized with simd with store mask or blend.<br/>
Partitions improve cache utilization for data sets that are larger than cache. While merge with linear memory access pattern should use memory bandwidth more efficiently than random access shuffle. This will be slower for small data sets when cache provides enough bandwidth to make Fisher-Yates very fast.</p>
<p>But after reading your numbers I&rsquo;m pretty happy with my scalar shuffle because it can shuffle 52 elements (64 bit ints, aka a pack of cards) and reduce to 4 mask elements in 220-240 cycles. I&rsquo;m currently using lcg generator and multiplicative bound reduction including bitwise-and optimization for power of two ranges. Removing division was the largest optimization (2200 cycles to 450 cycles). </p>
<p>Second largest improvement was taking stack a temporary stack copy of random number generator (450-&gt;280). Without generator copy c++ compiler generated loads and stores for each random number. Loads and stores removed fairly few instructions but those were bottlenecks allowing average instructions per cycle raise from 2.8 to 3.4.</p>
<p>I end up here looking for simd replacement for Fisher-Yates after my attempt to use vpermq to shuffle 4 element partitions resulted to slower code than scalar shuffle. sse/avx permutations have problem that permutation selecting must be immediate value. Immediate value force slow jump table conversion from random number to permutation operation. Result was about 25% reduction to instruction count but 60% reduction to IPC.</p>
</div>
<ol class="children">
<li id="comment-263834" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-26T23:29:48+00:00">December 26, 2016 at 11:29 pm</time></a> </div>
<div class="comment-content">
<p>@Pauli</p>
<p>Thanks for sharing your numbers. Very interesting.</p>
<p><em>Parallel shuffle can be done inplace using partitions (equal size balanced â€œtreeâ€, unbalanced remainder requires separate shuffling).</em></p>
<p>My blog post is concerned with a &ldquo;fair&rdquo; random shuffles where all possible permutations (N!) must be equally likely. If you divide up the inputs into fixed-sized blocks, shuffle them, and remerge, you will not get a fair shuffle. That might be fine, depending on your needs, but if you allow biased shuffles, it opens up many opportunities, in general, depending on the needed quality.</p>
</div>
<ol class="children">
<li id="comment-365128" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8e1cce73399411748ed72e9a20e8e405?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8e1cce73399411748ed72e9a20e8e405?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">fewer herb</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-16T01:20:35+00:00">November 16, 2018 at 1:20 am</time></a> </div>
<div class="comment-content">
<p>This is a bit late, but a fair &ldquo;merge&rdquo; shuffle is possible: <a href="https://arxiv.org/abs/1508.03167" rel="nofollow ugc">https://arxiv.org/abs/1508.03167</a></p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-305298" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/58c1a3b7009d2666847289f4cd3d4dd9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/58c1a3b7009d2666847289f4cd3d4dd9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Albert Chan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-27T19:04:44+00:00">May 27, 2018 at 7:04 pm</time></a> </div>
<div class="comment-content">
<p>What is the &ldquo;no division, no bias&rdquo; method actually called ?<br/>
If I googled for it, what should be entered ?</p>
</div>
<ol class="children">
<li id="comment-305673" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-29T01:39:40+00:00">May 29, 2018 at 1:39 am</time></a> </div>
<div class="comment-content">
<p>If you need a formal reference, please see:</p>
<ul>
<li>Daniel Lemire, <a href="https://arxiv.org/abs/1805.10941" rel="nofollow">Fast Random Integer Generation in an Interval</a>, ACM Transactions on Modeling and Computer Simulation (to appear)</li>
</ul>
</div>
</li>
</ol>
</li>
<li id="comment-628140" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c1fd1e343f8009ec97647ed8e6e87d13?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c1fd1e343f8009ec97647ed8e6e87d13?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">JJShao</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-04-17T16:24:54+00:00">April 17, 2022 at 4:24 pm</time></a> </div>
<div class="comment-content">
<p>Is the distribution unbias when &ldquo;leftover &gt;= range&rdquo; (without div)?<br/>
I mean, take range = 5 &amp; bit length = 4 for example, when random4bit range from 0 to 15, we have:<br/>
0, 4, 7, 10, 13 is rejected, 1-3 return 0, 5-6 return 1, 8-9 return 2, 11-12 return 3, 14-15 return 4.<br/>
which means 0 has 3/16 chance to return without div, but 1-4 has 2/16 chance to return without div, and 5/16 chance we need 1 div(which afterwards is unbias).<br/>
Isn&rsquo;t this bias?</p>
</div>
<ol class="children">
<li id="comment-628143" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-04-17T17:59:25+00:00">April 17, 2022 at 5:59 pm</time></a> </div>
<div class="comment-content">
<p>Please refer to the manuscript for the mathematical analysis <a href="https://arxiv.org/abs/1805.10941" rel="nofollow ugc">https://arxiv.org/abs/1805.10941</a></p>
</div>
<ol class="children">
<li id="comment-628166" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c1fd1e343f8009ec97647ed8e6e87d13?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c1fd1e343f8009ec97647ed8e6e87d13?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">JJShao</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-04-18T04:34:23+00:00">April 18, 2022 at 4:34 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve read that. But while the inner &ldquo;while&rdquo; loop does satisfied the lemma 4.1, the outer &ldquo;if&rdquo; does not since range != 2^L mod range.</p>
</div>
<ol class="children">
<li id="comment-628235" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-04-18T15:39:13+00:00">April 18, 2022 at 3:39 pm</time></a> </div>
<div class="comment-content">
<p>The algorithm is correct. It provides unbiased results.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
