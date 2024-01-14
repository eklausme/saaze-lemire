---
date: "2022-12-30 12:00:00"
title: "Quickly checking that a string belongs to a small set"
index: false
---

[37 thoughts on &ldquo;Quickly checking that a string belongs to a small set&rdquo;](/lemire/blog/2022/12-30-quickly-checking-that-a-string-belongs-to-a-small-set)

<ol class="comment-list">
<li id="comment-648647" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c20381ee8508b1344dd4c1aaa1cc5aa8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c20381ee8508b1344dd4c1aaa1cc5aa8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Volker Simonis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-30T09:02:50+00:00">December 30, 2022 at 9:02 am</time></a> </div>
<div class="comment-content">
<p>Just out of interest, have you tried to measure a regex-based solution as well?</p>
</div>
<ol class="children">
<li id="comment-648658" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-30T17:59:48+00:00">December 30, 2022 at 5:59 pm</time></a> </div>
<div class="comment-content">
<p>In my tests, regex is 100x slower. Of course, results will vary based on the underlying implementation.</p>
</div>
</li>
<li id="comment-648659" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/335f4863ad3e7c521d63e242ab2886e0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/335f4863ad3e7c521d63e242ab2886e0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Myers</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-30T18:23:51+00:00">December 30, 2022 at 6:23 pm</time></a> </div>
<div class="comment-content">
<p>Seems like a good place for a bloom filter.</p>
<p>Presumably the overwhelming majority of words seen don&rsquo;t match, so you would win by rejecting non-matches quickly.</p>
</div>
<ol class="children">
<li id="comment-648660" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/edbd5f1c2f535b14165ae883fa7c3f37?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/edbd5f1c2f535b14165ae883fa7c3f37?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jens Alfke</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-30T18:59:29+00:00">December 30, 2022 at 6:59 pm</time></a> </div>
<div class="comment-content">
<p>A Bloom filter will require hashing the string six or seven times with different hash functions. And it has false positives, so you still have to do a real set-membership test if the filter returns true.</p>
<p>I didn’t see anything in the post stating that matches will be rare, and in the benchmark code 60% of the strings match, so this doesn’t seem like a good trade-off.</p>
</div>
<ol class="children">
<li id="comment-648661" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-30T19:07:02+00:00">December 30, 2022 at 7:07 pm</time></a> </div>
<div class="comment-content">
<p>A conventional Bloom filter would be overkill here, but a hashing based technique could work.</p>
</div>
</li>
<li id="comment-648681" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8d10fce01dd76d1438601f086ca1a33f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8d10fce01dd76d1438601f086ca1a33f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Herb Alist</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-31T04:16:00+00:00">December 31, 2022 at 4:16 am</time></a> </div>
<div class="comment-content">
<p>There is no need for different hash functions with a bloom filter. You just mix in a different salt for each iteration.</p>
<p>But if the list of strings is known in advance as in this example, then gperf would be even simpler.</p>
</div>
<ol class="children">
<li id="comment-648689" class="comment byuser comment-author-lemire bypostauthor even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-31T18:17:16+00:00">December 31, 2022 at 6:17 pm</time></a> </div>
<div class="comment-content">
<p>I have added gperf to the benchmark. It is competitive but it is not a match for the fast approaches I propose. This being said, it could maybe be made competitive with some extra engineering.</p>
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
<li id="comment-648650" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d6f8274f1c80d748f4c3d716a8d63c91?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d6f8274f1c80d748f4c3d716a8d63c91?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wouter Bijlsma</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-30T12:32:51+00:00">December 30, 2022 at 12:32 pm</time></a> </div>
<div class="comment-content">
<p>The ‘direct’ example uses bitwise | instead of logical ||, so no short-circuit evaluation? I guess that will affect the timing to 0.5x what you have now (amortised, if the needle is uniformly distributed)</p>
</div>
<ol class="children">
<li id="comment-648662" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-30T19:09:00+00:00">December 30, 2022 at 7:09 pm</time></a> </div>
<div class="comment-content">
<p>The code has both functions. Results are sensitive to the compiler.</p>
</div>
<ol class="children">
<li id="comment-648690" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-31T18:17:35+00:00">December 31, 2022 at 6:17 pm</time></a> </div>
<div class="comment-content">
<p>I have updated the blog post to include both versions.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-648652" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d695546ba627214cb293cf2d7046ddea?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d695546ba627214cb293cf2d7046ddea?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">JRL</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-30T16:19:16+00:00">December 30, 2022 at 4:19 pm</time></a> </div>
<div class="comment-content">
<p>It is a bit unfair to expect the input strings to be padded to 8 or 4 bytes. In practice, the parameter to memcpy should be input.size() instead of sizeof(uint..), but that seems to tank the performance.<br/>
I played a bit with the example (on godbolt: zd9c9YM8b), and the &ldquo;fast&rdquo; implementation was the most stable (similar duration over multiple runs). The branchless implementation is consistently the fastest, and the hash version is the sweet spot between clarity and performance.<br/>
I also tried a lame implementation of a letter graph, and it seems to be somewhere in between &ldquo;branchless&rdquo; and &ldquo;fast&rdquo;.</p>
</div>
<ol class="children">
<li id="comment-648663" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-30T19:10:27+00:00">December 30, 2022 at 7:10 pm</time></a> </div>
<div class="comment-content">
<p><em>It is a bit unfair to expect the input strings to be padded to 8 or 4 bytes.</em></p>
<p>For a general-purpose function, I agree, but if it is part of your own system where you control where the strings come from, then I disagree. Requiring padding to your strings is quite doable if you have fine control over your data structures.</p>
</div>
</li>
</ol>
</li>
<li id="comment-648653" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/096004ceafc6ed5eda354978bde70143?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/096004ceafc6ed5eda354978bde70143?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mark Hahn</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-30T16:41:15+00:00">December 30, 2022 at 4:41 pm</time></a> </div>
<div class="comment-content">
<p>I wonder when perfect hashing becomes the winner.</p>
</div>
</li>
<li id="comment-648654" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/129147e381a0a947ea9f0c074ee5760c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/129147e381a0a947ea9f0c074ee5760c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Xoranth</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-30T17:02:02+00:00">December 30, 2022 at 5:02 pm</time></a> </div>
<div class="comment-content">
<p>Wojciech Mula has written a note about a similar problem in the past. He found that using a perfect hash function was the fastest way, and that switching character by character was faster than SWAR techniques like the one you mention in this post.</p>
<p>I.e. see<br/>
<a href="http://0x80.pl/notesen/2022-01-29-http-verb-parse.html" rel="nofollow ugc">http://0x80.pl/notesen/2022-01-29-http-verb-parse.html</a></p>
</div>
<ol class="children">
<li id="comment-648664" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-30T19:11:34+00:00">December 30, 2022 at 7:11 pm</time></a> </div>
<div class="comment-content">
<p>Damn it. Wojciech is always one step ahead of me.</p>
<p>(For people reading this, Wojciech is a collaborator of mine.)</p>
</div>
</li>
<li id="comment-649002" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5d109eafc0efd7fe6e5ef707c0a75fa4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5d109eafc0efd7fe6e5ef707c0a75fa4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://fexl.com" class="url" rel="ugc external nofollow">Patrick</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-20T12:37:41+00:00">January 20, 2023 at 12:37 pm</time></a> </div>
<div class="comment-content">
<p>In my functional programming language Fexl I&rsquo;m using an &ldquo;index&rdquo; technique which identifies maximal common prefixes among keys, identifying the optimal sequences of individual three-way character comparisons to execute before doing a final definitive full key comparison.</p>
<p>Here are the operations index_get, index_put, index_del, index_pairs:</p>
<p><a href="https://github.com/chkoreff/Fexl/blob/master/src/test/lib/index/index.fxl" rel="nofollow ugc">https://github.com/chkoreff/Fexl/blob/master/src/test/lib/index/index.fxl</a></p>
<p>Here is a test suite:</p>
<p><a href="https://github.com/chkoreff/Fexl/blob/master/src/test/b15.fxl" rel="nofollow ugc">https://github.com/chkoreff/Fexl/blob/master/src/test/b15.fxl</a></p>
<p>My next step is to write a Fexl program which, when given a set of key-value pairs, automatically writes an optimal C function which looks up the value associated with a key. By &ldquo;optimal&rdquo; I mean using the index technique, not using a hash function. It would write the C function to be given the length of the key up front, not relying on trailing NUL.</p>
</div>
<ol class="children">
<li id="comment-649003" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5d109eafc0efd7fe6e5ef707c0a75fa4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5d109eafc0efd7fe6e5ef707c0a75fa4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://fexl.com" class="url" rel="ugc external nofollow">Patrick</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-20T12:40:20+00:00">January 20, 2023 at 12:40 pm</time></a> </div>
<div class="comment-content">
<p>I may also write the index_get, index_put, and other operations in native C instead of Fexl, but it&rsquo;s not a bottleneck for me so there&rsquo;s no hurry. I just think auto-generating C code for a particular index value will be interesting. I may even use the result to do the lookup for the set of standard Fexl functions already written directly in C.</p>
</div>
</li>
<li id="comment-649081" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5d109eafc0efd7fe6e5ef707c0a75fa4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5d109eafc0efd7fe6e5ef707c0a75fa4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://fexl.com" class="url" rel="ugc external nofollow">Patrick</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-28T21:05:21+00:00">January 28, 2023 at 9:05 pm</time></a> </div>
<div class="comment-content">
<p>OK, I&rsquo;ve written some code that &ldquo;compiles&rdquo; a list of key-value pairs into C code. The keys and values must be strings, and I don&rsquo;t yet do anything to detect special characters which must be escaped, or multi-line strings.</p>
<p>Here&rsquo;s a test suite that tries a few different lists:</p>
<p><a href="https://github.com/chkoreff/Fexl/blob/master/src/test/index_C.fxl" rel="nofollow ugc">https://github.com/chkoreff/Fexl/blob/master/src/test/index_C.fxl</a></p>
<p>Here&rsquo;s the reference output for that:</p>
<p><a href="https://github.com/chkoreff/Fexl/blob/master/src/out/index_C" rel="nofollow ugc">https://github.com/chkoreff/Fexl/blob/master/src/out/index_C</a></p>
<p>Here&rsquo;s the Fexl code which does the actual code generation work:</p>
<p><a href="https://github.com/chkoreff/Fexl/blob/master/src/test/lib/index/render_C.fxl" rel="nofollow ugc">https://github.com/chkoreff/Fexl/blob/master/src/test/lib/index/render_C.fxl</a></p>
<p>This generates a &ldquo;lookup&rdquo; function which takes a pointer to the key chars and a separate length. If you have NUL terminated data you can call strlen before calling lookup.</p>
<p>As far as I can tell the generated code is &ldquo;optimal&rdquo; in the sense that it does the fewest number of individual character comparisons needed to reach a point at which strncmp yields a definitive answer.</p>
</div>
<ol class="children">
<li id="comment-649082" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5d109eafc0efd7fe6e5ef707c0a75fa4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5d109eafc0efd7fe6e5ef707c0a75fa4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://fexl.com" class="url" rel="ugc external nofollow">Patrick</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-28T21:19:13+00:00">January 28, 2023 at 9:19 pm</time></a> </div>
<div class="comment-content">
<p>By the way, I could probably use &ldquo;switch&rdquo; instead of successive comparisons of the same key character, but I figure the optimizer will already have that covered.</p>
</div>
</li>
<li id="comment-649191" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5d109eafc0efd7fe6e5ef707c0a75fa4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5d109eafc0efd7fe6e5ef707c0a75fa4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://fexl.com" class="url" rel="ugc external nofollow">Patrick</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-08T18:52:07+00:00">February 8, 2023 at 6:52 pm</time></a> </div>
<div class="comment-content">
<p>I restructured the code a little, and here&rsquo;s the new file where &ldquo;compile_pairs&rdquo; is defined:</p>
<p><a href="https://github.com/chkoreff/Fexl/blob/master/src/test/lib/index_C/context.fxl" rel="nofollow ugc">https://github.com/chkoreff/Fexl/blob/master/src/test/lib/index_C/context.fxl</a></p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-648665" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f83572b506d931dcbc42dc729ea0ed67?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f83572b506d931dcbc42dc729ea0ed67?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">hexgrid</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-30T19:27:25+00:00">December 30, 2022 at 7:27 pm</time></a> </div>
<div class="comment-content">
<p>This seems like exactly the sort of thing a critbit trie is for.</p>
<p><a href="https://github.com/agl/critbit" rel="nofollow ugc">https://github.com/agl/critbit</a></p>
</div>
<ol class="children">
<li id="comment-648674" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-30T22:37:47+00:00">December 30, 2022 at 10:37 pm</time></a> </div>
<div class="comment-content">
<p>Did you run a benchmark?</p>
</div>
<ol class="children">
<li id="comment-648699" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f83572b506d931dcbc42dc729ea0ed67?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f83572b506d931dcbc42dc729ea0ed67?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">hexgrid</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-01T05:13:07+00:00">January 1, 2023 at 5:13 am</time></a> </div>
<div class="comment-content">
<p>Not recently, but I did when I built one into my game engine a few years back; once assembled, a critbit trie does (on average) one bit compare per log2 strings interned (which can trivially be made branchless), and a single string compare when the appropriate leaf node is found.<br/>
It&rsquo;s not faster for a set containing one or perhaps two strings, but for even five strings it was the fastest method I found, and I did compare against various other methods.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-648669" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b516af6931e1c844bc75596ca3316924?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b516af6931e1c844bc75596ca3316924?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">JY</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-30T20:13:07+00:00">December 30, 2022 at 8:13 pm</time></a> </div>
<div class="comment-content">
<p>&gt; You might be able to do slightly better if you can tell your compiler that the string you receive is ‘padded’ so that you can read eight bytes safely from it. I could not find a very elegant way to do it</p>
<p>There&rsquo;s std::assume in C++23 (<a href="https://en.cppreference.com/w/cpp/language/attributes/assume" rel="nofollow ugc">https://en.cppreference.com/w/cpp/language/attributes/assume</a>) but currently the only way is to use the compiler builtin functions, e.g.: <a href="https://godbolt.org/z/xxK939vca" rel="nofollow ugc">https://godbolt.org/z/xxK939vca</a><br/>
I&rsquo;ve also taken some liberties at rewriting your approach, but the generate assembly should be similar</p>
</div>
<ol class="children">
<li id="comment-648675" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-30T22:42:05+00:00">December 30, 2022 at 10:42 pm</time></a> </div>
<div class="comment-content">
<p>Transcribing your interesting code:</p>
<pre style="color:#000000;background:#ffffff;"><span style="color:#004a43; ">#</span><span style="color:#004a43; ">include </span><span style="color:#800000; ">&lt;</span><span style="color:#40015a; ">algorithm</span><span style="color:#800000; ">></span>
<span style="color:#004a43; ">#</span><span style="color:#004a43; ">include </span><span style="color:#800000; ">&lt;</span><span style="color:#40015a; ">array</span><span style="color:#800000; ">></span>
<span style="color:#004a43; ">#</span><span style="color:#004a43; ">include </span><span style="color:#800000; ">&lt;</span><span style="color:#40015a; ">bit</span><span style="color:#800000; ">></span>
<span style="color:#004a43; ">#</span><span style="color:#004a43; ">include </span><span style="color:#800000; ">&lt;</span><span style="color:#40015a; ">ranges</span><span style="color:#800000; ">></span>
<span style="color:#004a43; ">#</span><span style="color:#004a43; ">include </span><span style="color:#800000; ">&lt;</span><span style="color:#40015a; ">string_view</span><span style="color:#800000; ">></span>

<span style="color:#800000; font-weight:bold; ">static</span> constexpr <span style="color:#666616; ">std</span><span style="color:#800080; ">::</span><span style="color:#603000; ">array</span> protocols <span style="color:#808030; ">=</span> <span style="color:#800080; ">{</span>
    <span style="color:#800000; ">"</span><span style="color:#0000e6; ">https</span><span style="color:#800000; ">"</span><span style="color:#808030; ">,</span>
    <span style="color:#800000; ">"</span><span style="color:#0000e6; ">http</span><span style="color:#800000; ">"</span><span style="color:#808030; ">,</span>
    <span style="color:#800000; ">"</span><span style="color:#0000e6; ">file</span><span style="color:#800000; ">"</span><span style="color:#808030; ">,</span>
    <span style="color:#800000; ">"</span><span style="color:#0000e6; ">ftp</span><span style="color:#800000; ">"</span><span style="color:#808030; ">,</span>
    <span style="color:#800000; ">"</span><span style="color:#0000e6; ">wss</span><span style="color:#800000; ">"</span><span style="color:#808030; ">,</span>
    <span style="color:#800000; ">"</span><span style="color:#0000e6; ">ws</span><span style="color:#800000; ">"</span>
<span style="color:#800080; ">}</span><span style="color:#800080; ">;</span>

<span style="color:#800000; font-weight:bold; ">static</span> constexpr <span style="color:#800000; font-weight:bold; ">auto</span> string_to_uint64 <span style="color:#808030; ">=</span> <span style="color:#808030; ">[</span><span style="color:#808030; ">]</span><span style="color:#808030; ">(</span><span style="color:#666616; ">std</span><span style="color:#800080; ">::</span>string_view s<span style="color:#808030; ">)</span> constexpr <span style="color:#800080; ">{</span>
    <span style="color:#800000; font-weight:bold; ">using</span> CharT <span style="color:#808030; ">=</span> decltype<span style="color:#808030; ">(</span>s<span style="color:#808030; ">)</span><span style="color:#800080; ">::</span>value_type<span style="color:#800080; ">;</span>
    static_assert<span style="color:#808030; ">(</span><span style="color:#800000; font-weight:bold; ">sizeof</span><span style="color:#808030; ">(</span>CharT<span style="color:#808030; ">)</span> <span style="color:#808030; ">=</span><span style="color:#808030; ">=</span> <span style="color:#008c00; ">1</span><span style="color:#808030; ">)</span><span style="color:#800080; ">;</span>
    <span style="color:#666616; ">std</span><span style="color:#800080; ">::</span><span style="color:#603000; ">array</span><span style="color:#800080; ">&lt;</span>CharT<span style="color:#808030; ">,</span> <span style="color:#008c00; ">8</span><span style="color:#800080; ">></span> bytes<span style="color:#800080; ">{</span><span style="color:#800080; ">}</span><span style="color:#800080; ">;</span>
    <span style="color:#800000; font-weight:bold; ">const</span> <span style="color:#800000; font-weight:bold; ">auto</span> copy_size <span style="color:#808030; ">=</span> <span style="color:#666616; ">std</span><span style="color:#800080; ">::</span><span style="color:#603000; ">min</span><span style="color:#808030; ">(</span>s<span style="color:#808030; ">.</span>size<span style="color:#808030; ">(</span><span style="color:#808030; ">)</span><span style="color:#808030; ">,</span> <span style="color:#008c00; ">8</span><span style="color:#006600; ">ul</span><span style="color:#808030; ">)</span><span style="color:#800080; ">;</span>
    <span style="color:#666616; ">std</span><span style="color:#800080; ">::</span>copy_n<span style="color:#808030; ">(</span>s<span style="color:#808030; ">.</span>cbegin<span style="color:#808030; ">(</span><span style="color:#808030; ">)</span><span style="color:#808030; ">,</span> copy_size<span style="color:#808030; ">,</span> bytes<span style="color:#808030; ">.</span>begin<span style="color:#808030; ">(</span><span style="color:#808030; ">)</span><span style="color:#808030; ">)</span><span style="color:#800080; ">;</span>
    <span style="color:#800000; font-weight:bold; ">return</span> <span style="color:#666616; ">std</span><span style="color:#800080; ">::</span>bit_cast<span style="color:#800080; ">&lt;</span>uint64_t<span style="color:#800080; ">></span><span style="color:#808030; ">(</span>bytes<span style="color:#808030; ">)</span><span style="color:#800080; ">;</span>
<span style="color:#800080; ">}</span><span style="color:#800080; ">;</span>

<span style="color:#800000; font-weight:bold; ">static</span> constexpr <span style="color:#800000; font-weight:bold; ">auto</span> protocol_set <span style="color:#808030; ">=</span> <span style="color:#808030; ">[</span><span style="color:#808030; ">]</span> <span style="color:#800080; ">{</span>
    <span style="color:#666616; ">std</span><span style="color:#800080; ">::</span><span style="color:#603000; ">array</span><span style="color:#808030; ">&lt;</span>uint64_t<span style="color:#808030; ">,</span> protocols<span style="color:#808030; ">.</span>size<span style="color:#808030; ">(</span><span style="color:#808030; ">)</span><span style="color:#808030; ">></span> ps<span style="color:#800080; ">{</span><span style="color:#800080; ">}</span><span style="color:#800080; ">;</span>
    <span style="color:#666616; ">std</span><span style="color:#800080; ">::</span>ranges<span style="color:#800080; ">::</span><span style="color:#603000; ">transform</span><span style="color:#808030; ">(</span>protocols<span style="color:#808030; ">,</span> ps<span style="color:#808030; ">.</span>begin<span style="color:#808030; ">(</span><span style="color:#808030; ">)</span><span style="color:#808030; ">,</span> string_to_uint64<span style="color:#808030; ">)</span><span style="color:#800080; ">;</span>
    <span style="color:#800000; font-weight:bold; ">return</span> ps<span style="color:#800080; ">;</span>
<span style="color:#800080; ">}</span><span style="color:#808030; ">(</span><span style="color:#808030; ">)</span><span style="color:#800080; ">;</span>

<span style="color:#800000; font-weight:bold; ">bool</span> is_special<span style="color:#808030; ">(</span><span style="color:#666616; ">std</span><span style="color:#800080; ">::</span>string_view s<span style="color:#808030; ">)</span> <span style="color:#800080; ">{</span>
    __builtin_assume<span style="color:#808030; ">(</span>s<span style="color:#808030; ">.</span>size<span style="color:#808030; ">(</span><span style="color:#808030; ">)</span> <span style="color:#808030; ">=</span><span style="color:#808030; ">=</span> <span style="color:#008c00; ">8</span><span style="color:#006600; ">ul</span><span style="color:#808030; ">)</span><span style="color:#800080; ">;</span>
    <span style="color:#800000; font-weight:bold; ">const</span> <span style="color:#800000; font-weight:bold; ">auto</span> as_uint64<span style="color:#800080; ">{</span> string_to_uint64<span style="color:#808030; ">(</span>s<span style="color:#808030; ">)</span> <span style="color:#800080; ">}</span><span style="color:#800080; ">;</span>
    <span style="color:#800000; font-weight:bold; ">return</span> <span style="color:#666616; ">std</span><span style="color:#800080; ">::</span>ranges<span style="color:#800080; ">::</span><span style="color:#603000; ">count</span><span style="color:#808030; ">(</span>protocol_set<span style="color:#808030; ">,</span> as_uint64<span style="color:#808030; ">)</span><span style="color:#800080; ">;</span>
<span style="color:#800080; ">}</span>
</pre>
<p></p>
</div>
</li>
</ol>
</li>
<li id="comment-648676" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4de5ec88581c2e1e8d676c9679870c9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4de5ec88581c2e1e8d676c9679870c9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Steinar H. Gunderson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-30T22:50:50+00:00">December 30, 2022 at 10:50 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve worked on Chromium&rsquo;s HTML and CSS parsers, and in general, this is an unsolved problem. I&rsquo;ve seen all of these, depending on number of strings in the set, whether length is available and other circumstances:</p>
<p>Switch on first letter, test with strcmp/memcmp<br/>
Switch on length, test with strcmp/memcmp<br/>
Test first + last letter of word as a quick filter, test with strcmp/memcmp<br/>
Perfect hashing (through gperf)<br/>
Hash table lookup<br/>
Check four or eight bytes at a time (as in this post)</p>
<p>Probably others I forgot as well. One notable thing I haven&rsquo;t seen is special SIMD instructions. I know Intel wanted to people to use PCMPESTRI and such in the past, but it&rsquo;s a really slow instruction and SSE4.2 is a bit too new (alas!).</p>
</div>
</li>
<li id="comment-648677" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a22a8707c85dff1f5499eaa4fc90c6a9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a22a8707c85dff1f5499eaa4fc90c6a9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Chris O'Hara</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-30T23:06:28+00:00">December 30, 2022 at 11:06 pm</time></a> </div>
<div class="comment-content">
<p>We took a similar approach in our JSON decoder. We found that 8 bytes was too small, but 16 bytes was just right.</p>
<p>See:<br/>
&#8211; <a href="https://github.com/segmentio/asm/pull/57" rel="nofollow ugc">https://github.com/segmentio/asm/pull/57</a> (AMD64)<br/>
&#8211; <a href="https://github.com/segmentio/asm/pull/65" rel="nofollow ugc">https://github.com/segmentio/asm/pull/65</a> (ARM64)<br/>
&#8211; <a href="https://github.com/segmentio/encoding/pull/101" rel="nofollow ugc">https://github.com/segmentio/encoding/pull/101</a></p>
</div>
</li>
<li id="comment-648702" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-01T10:44:14+00:00">January 1, 2023 at 10:44 am</time></a> </div>
<div class="comment-content">
<p>Here&rsquo;s a simple perfect hashing solution which seems to beat all variants mentioned on the blog post on my M1. If one would have vectored 64-bit multiply high and variable vector shuffle instructions, this could be even massaged to work on vectors of padded strings:</p>
<p>const uint8_t table[64] =<br/>
{<br/>
&lsquo;w&rsquo;, &lsquo;s&rsquo;, 0, 0, 0, 0, 0, 0,<br/>
&lsquo;f&rsquo;, &lsquo;t&rsquo;, &lsquo;p&rsquo;, 0, 0, 0, 0, 0,<br/>
&lsquo;w&rsquo;, &lsquo;s&rsquo;, &lsquo;s&rsquo;, 0, 0, 0, 0, 0,<br/>
&lsquo;f&rsquo;, &lsquo;i&rsquo;, &lsquo;l&rsquo;, &lsquo;e&rsquo;, 0, 0, 0, 0,<br/>
&lsquo;h&rsquo;, &lsquo;t&rsquo;, &lsquo;t&rsquo;, &lsquo;p&rsquo;, 0, 0, 0, 0,<br/>
&lsquo;h&rsquo;, &lsquo;t&rsquo;, &lsquo;t&rsquo;, &lsquo;p&rsquo;, &lsquo;s&rsquo;, 0, 0, 0,<br/>
0, 0, 0, 0, 0, 0, 0, 0, /* comparison always fails */<br/>
0, 0, 0, 0, 0, 0, 0, 0 /* comparison always fails */<br/>
};</p>
<p>bool mulhi_is_special(std::string_view input) {<br/>
uint64_t inputu = string_to_uint64(input);</p>
<p> return *(uint64_t *)<br/>
(table +<br/>
(((inputu *<br/>
(unsigned __int128)39114211812342) &gt;&gt; 64) &amp; 0x38)) ==<br/>
inputu;<br/>
}</p>
<p></p>
</div>
<ol class="children">
<li id="comment-648703" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-01T12:06:14+00:00">January 1, 2023 at 12:06 pm</time></a> </div>
<div class="comment-content">
<p>The constant above is found by random brute force search, and is actually not very easy to create on ARM assembler. I tried finding constants which would be nicer to load and found them, but interestingly enough this made practically no difference, at least on M1.</p>
</div>
</li>
<li id="comment-648704" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-01T13:29:47+00:00">January 1, 2023 at 1:29 pm</time></a> </div>
<div class="comment-content">
<p>By the way, one could also use Intel PEXT (parallel bit extract) to construct a comparison table lookup address in this specific case. There are 285 four-bit bit position subsets for these strings which uniquely identify each string. On those microarchitectures where PEXT is implemented efficiently this might provide even faster checking, but I suspect applicability of the approach doesn&rsquo;t scale as well as multiplication, not to mention that ARM lacks the corresponding instruction.</p>
</div>
</li>
<li id="comment-648714" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-02T06:27:07+00:00">January 2, 2023 at 6:27 am</time></a> </div>
<div class="comment-content">
<p>A perfect hash index for a (16-entry) lookup table can also be constructed from a masked xor of two right shifts of inputu, but strangely enough it is slower than the mulhi variant on M1 when inlined (and equivalent in speed when not). It is curious how efficient the wide multipliers have become for these sort of tricks; even replacing a wide multiplication with a two-instruction sequence of constant shifts and a xor may be counterproductive.</p>
</div>
</li>
</ol>
</li>
<li id="comment-648749" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/87a08c1a47ade883c793d1f94422a78a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/87a08c1a47ade883c793d1f94422a78a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/rurban" class="url" rel="ugc external nofollow">Reini Urban</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-04T07:28:17+00:00">January 4, 2023 at 7:28 am</time></a> </div>
<div class="comment-content">
<p>When I encountered this very same problem, I&rsquo;ve generated code to do binary search on the padded strings as numbers. And compared it to various perfect hash generators.<br/>
<a href="https://blogs.perl.org/users/rurban/2014/08/perfect-hashes-and-faster-than-memcmp.html" rel="nofollow ugc">https://blogs.perl.org/users/rurban/2014/08/perfect-hashes-and-faster-than-memcmp.html</a></p>
</div>
</li>
<li id="comment-648753" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-04T15:59:44+00:00">January 4, 2023 at 3:59 pm</time></a> </div>
<div class="comment-content">
<p>The problem of converting an eight-byte NUL-terminated or partial string into an uint64_t where data after NUL is zeroed should be pretty straight-forward with modern vectorisation. The code below vectorises, at least as a lone function, pretty well on Clang 14 on my M1 Mac and with Intel ICX compiler (for Skylake, for instance):</p>
<p><code><br/>
uint64_t string_to_uint64(const char *str)<br/>
{<br/>
const uint64_t ps = 4096; /* minimum common page size */</p>
<p> uint8_t outputv[8];<br/>
uint64_t v;<br/>
uint64_t shift;</p>
<p> if (__builtin_expect(((intptr_t)str &amp; (ps - 1)) &gt; ps - 8, 0))<br/>
{<br/>
uint64_t buf = 0;</p>
<p> strncpy((char *)&amp;buf, str, sizeof(buf));<br/>
return buf;<br/>
}</p>
<p> for (size_t i = 0; i &lt; 8; i++)<br/>
{<br/>
outputv[i] = str[i] != 0 ? 0 : ~0;<br/>
}</p>
<p> v = *(uint64_t *)&amp;outputv;<br/>
shift = v ? __builtin_ctzll(v) : 64;</p>
<p> return *(uint64_t *)str &amp; ~(~0ULL &lt;&lt; shift);<br/>
}<br/>
</code></p>
<p>It generates on both about a dozen instruction fast path, of which about four instructions are just checking for the low likelihood of need to use the slow path, which is for strings which might cross the page boundary. (That part could be still optimized, but it&rsquo;s not really the low-hanging fruit.)</p>
<p>Problems arise when one attempts to use other compilers or inlining this to existing code. Suddenly autovectorisation becomes effectively impossible task for the compilers to handle gracefully, which is really quite appalling.</p>
<p>Nonetheless, even if a compiler would work like a charm, this sort of padding is going to take more time than, for instance, my multiply-mask-load check acting on its output, which takes effectively three instructions (with one multiply) to perform the check&#8230;</p>
</div>
</li>
<li id="comment-648804" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9a9b353291ae1032cd298a5125a5d5fc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9a9b353291ae1032cd298a5125a5d5fc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Shawn</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-07T09:01:39+00:00">January 7, 2023 at 9:01 am</time></a> </div>
<div class="comment-content">
<p>The regular expression versions can be sped up a lot (Though still a lot slower than the other approaches) by using the pattern <code>https?|ftp|file|wss?</code>, eliminating unused capture groups and reducing backtracking. And using a faster engine like RE2 gives an even bigger speedup. I tested a state machine compiled by re2c, too:</p>
<blockquote><p>
regex 214.626912 ns/string, matches = 6823<br/>
my regex 146.426463 ns/string, matches = 6823<br/>
boost regex 149.997056 ns/string, matches = 6823<br/>
my boost regex 123.283810 ns/string, matches = 6823<br/>
RE2 regex 75.450312 ns/string, matches = 6823<br/>
my RE2 regex 49.995401 ns/string, matches = 6823<br/>
re2c 9.409947 ns/string, matches = 6823
</p></blockquote>
</div>
<ol class="children">
<li id="comment-648822" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-08T08:52:58+00:00">January 8, 2023 at 8:52 am</time></a> </div>
<div class="comment-content">
<p>As long as state space explosion is not an issue one can translate regular expressions to DFAs. (Also, it is very hard to get more performant than this on regular CPUs and general-purpose pattern matching which can&rsquo;t be easily reduced to hashing.)</p>
<p>On long strings the bottleneck will be the load latency (but one can theoretically interleave processing of multiple strings). On short ones with unpredictable length branch misprediction is likely to be an issue.</p>
<p>It might actually be beneficial to write automata which are always run a fixed amount of rounds for the buffer, looping back to the same state on every byte after seeing the NUL termination. This would allow much more instructions to be in flight.</p>
</div>
</li>
<li id="comment-648826" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-08T11:10:52+00:00">January 8, 2023 at 11:10 am</time></a> </div>
<div class="comment-content">
<p>I implemented a simple hand-written DFA walker with 14 states. Branchless versions of it run at 1.85 to 2.42 ns per string on my M1 Mac (when regex takes around 400 ns similarly to the original blog post).</p>
<p>Branchy version is predictably slower if branch predictor doesn&rsquo;t learn the benchmark pattern, but modern branch predictors can remember surprisingly long sequences&#8230;</p>
</div>
</li>
</ol>
</li>
<li id="comment-648847" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-09T04:46:31+00:00">January 9, 2023 at 4:46 am</time></a> </div>
<div class="comment-content">
<p>I think &ldquo;fast&rdquo; and &ldquo;faster&rdquo; test results are highly dependent of the benchmarking working set size as a result of the capacity of the branch predictor learning the test set, at least on my M1 Mac. When the &ldquo;simulation&rdquo; size is increased from 8192 to 65536 their runtimes triple, unlike some other variants in the current repo. See a comparison chart: <a href="https://i.imgur.com/KFhuI27.png" rel="nofollow ugc">https://i.imgur.com/KFhuI27.png</a></p>
<p>Truly branchless solutions scale in this regard much better, but of course if input is highly skewed and these functions are sufficiently hot in the predictor, &ldquo;branchy&rdquo; alternatives are quite competitive. It&rsquo;s just that even a single branch can make a function &ldquo;branchy&rdquo; in this regard.</p>
</div>
</li>
</ol>
