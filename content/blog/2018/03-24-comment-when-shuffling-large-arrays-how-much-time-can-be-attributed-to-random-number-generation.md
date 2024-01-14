---
date: "2018-03-24 12:00:00"
title: "When shuffling large arrays, how much time can be attributed to random number generation?"
index: false
---

[22 thoughts on &ldquo;When shuffling large arrays, how much time can be attributed to random number generation?&rdquo;](/lemire/blog/2018/03-24-when-shuffling-large-arrays-how-much-time-can-be-attributed-to-random-number-generation)

<ol class="comment-list">
<li id="comment-299273" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8c04e8d64df709d32505addd42d69140?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8c04e8d64df709d32505addd42d69140?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://emergent.unpythonic.net/" class="url" rel="ugc external nofollow">Jeff Epler</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-24T03:24:44+00:00">March 24, 2018 at 3:24 am</time></a> </div>
<div class="comment-content">
<p>If it&rsquo;s really a matter of prediction / prefetch, then generate e.g., 256 numbers and then perform 256 swaps. I dashed off the (C) program to test that theory, so it&rsquo;s likely that I botched something, but doing just that seems to get (or slightly beat) the speed of the precomputed shuffle with a fixed overhead of extra memory: <a href="https://emergent.unpythonic.net/files/sandbox/shuffy.c" rel="nofollow ugc">https://emergent.unpythonic.net/files/sandbox/shuffy.c</a></p>
</div>
<ol class="children">
<li id="comment-299275" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-24T03:32:32+00:00">March 24, 2018 at 3:32 am</time></a> </div>
<div class="comment-content">
<p><em>doing just that seems to get (or slightly beat) the speed of the precomputed shuffle with a fixed overhead of extra memory</em></p>
<p>I see what you are doing. Let me be clearer: my precomputed approach <em>excludes</em> the generation of the random numbers, so it is not a random shuffle.</p>
<p>I am also not claiming that it is practically useful. It is a demonstration. So I do not really care about memory usage.</p>
</div>
<ol class="children">
<li id="comment-299284" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/352603e575430df8997dad0ab4e35e17?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/352603e575430df8997dad0ab4e35e17?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Janne</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-24T05:58:27+00:00">March 24, 2018 at 5:58 am</time></a> </div>
<div class="comment-content">
<p>I wonder what the reason is for starting at the end of the array and looping backwards? I suspect that&rsquo;s slightly less efficient than a forward loop since the CPU is more likely to be able to predict memory accesses in the latter case.</p>
</div>
<ol class="children">
<li id="comment-299308" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-24T14:19:52+00:00">March 24, 2018 at 2:19 pm</time></a> </div>
<div class="comment-content">
<p><em> I suspect that&rsquo;s slightly less efficient than a forward loop since the CPU is more likely to be able to predict memory accesses in the latter case.</em></p>
<p>I don&rsquo;t expect that to be true on recent Intel processors. They are devilishly good at predicting access patterns.</p>
</div>
</li>
</ol>
</li>
<li id="comment-299311" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8c04e8d64df709d32505addd42d69140?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8c04e8d64df709d32505addd42d69140?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://emergent.unpythonic.net/" class="url" rel="ugc external nofollow">Jeff Epler</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-24T15:17:15+00:00">March 24, 2018 at 3:17 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for the clarification. I&rsquo;m glad I misunderstood, though. I think my benchmark finding is interesting in its own right.</p>
<p>There was at least one implementation error in my program (negative random numbers were erroneously being generated, leading to out of bounds memory accesses).</p>
<p>I updated the above link with a new version. I still measure version 3 (which alternates generating indices and swapping entries in blocks) to be the faster alternative compared to the traditional algorithm or the one that pregenerates <em>ALL</em> swap indices.</p>
</div>
<ol class="children">
<li id="comment-299375" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-25T17:48:57+00:00">March 25, 2018 at 5:48 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>I updated the above link with a new version. I still measure version 3 (which alternates generating indices and swapping entries in blocks) to be the faster alternative compared to the traditional algorithm or the one that pregenerates ALL swap indices.</p>
</blockquote>
<p>That might well be true.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-299412" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/62aaaf6dfc5c0fd3c037fa9fb106c677?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/62aaaf6dfc5c0fd3c037fa9fb106c677?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marc Reynolds</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-26T08:24:54+00:00">March 26, 2018 at 8:24 am</time></a> </div>
<div class="comment-content">
<p>FWIW Aside: For an LCG mod should be avoided since the low-bits are garbage and generally mod will introduce bias when range is not a power-of-two (although probably not worth thinking about in this case)</p>
</div>
</li>
</ol>
</li>
<li id="comment-299292" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8384efde6dc676fca7fcae9fb4730314?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8384efde6dc676fca7fcae9fb4730314?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sean O'Connor</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-24T10:25:36+00:00">March 24, 2018 at 10:25 am</time></a> </div>
<div class="comment-content">
<p>If you use a fast random number generator like one of these:<br/>
<a href="http://xoroshiro.di.unimi.it/" rel="nofollow">xoroshiro</a><br/>
Or the RDRAND assembly language instruction.</p>
<p>Then with the Fisherâ€“Yates shuffle algorithm for sure most of the time is spent waiting for memory.</p>
<p>To get numbers between 0 and n quick you can multiply a 32 bit random number by n+1 to get a 64 bit product and shift right 32 bits. 64 bit random, 128 bit product is also possible and better.</p>
<p>Also possible for very large arrays is to replace the butterfly operations in an FFT/WHT with butterfly random swaps, though I think that would have the same problem as the naive shuffle with nonuniform distribution of permutations.</p>
<p>Also off topic there is this:<br/>
<a href="https://discourse.numenta.org/t/similarity-alignment-a-missing-link-between-structure-function-and-algorithms/3683" rel="nofollow">Similarity Alignment</a></p>
</div>
<ol class="children">
<li id="comment-299309" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-24T14:25:33+00:00">March 24, 2018 at 2:25 pm</time></a> </div>
<div class="comment-content">
<p><em>If you use a fast random number generator like one of these: xoroshiro Or the RDRAND assembly language instruction.</em></p>
<p>The Java random number generator I used in these examples is a simple linear congruential generator. It is hard to be much faster. I expect RDRAND to be far slower.</p>
<p><em> Then with the Fisherâ€“Yates shuffle algorithm for sure most of the time is spent waiting for memory.</em></p>
<p>Do you have some benchmark numbers?</p>
<p><em>To get numbers between 0 and n quick you can multiply a 32 bit random number by n+1 to get a 64 bit product and shift right 32 bits. 64 bit random, 128 bit product is also possible and better.</em></p>
<p>Yes, see <a href="https://lemire.me/blog/2016/06/30/fast-random-shuffling/" rel="ugc">https://lemire.me/blog/2016/06/30/fast-random-shuffling/</a></p>
</div>
<ol class="children">
<li id="comment-299413" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/62aaaf6dfc5c0fd3c037fa9fb106c677?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/62aaaf6dfc5c0fd3c037fa9fb106c677?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marc Reynolds</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-26T08:30:00+00:00">March 26, 2018 at 8:30 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m pretty sure than ThreadLocalRandom is a cascade of xorshift-multiplies.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-299327" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://zeuxcg.org" class="url" rel="ugc external nofollow">Arseny Kapoulkine</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-25T01:00:57+00:00">March 25, 2018 at 1:00 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m not sure the implications are as straightforward as suggested in this post &#8211; it must highly depend on the RNG.</p>
<p>1.9s / 100M elements on a 2 GHz CPU is 38 cycles/element; 0.8s is 16 cycles. 20 cycles per RNG operation seems excessive, although I&rsquo;m not sure what builtin Java RNG is doing &#8211; and moreover you can&rsquo;t get an L3 miss or even an L2 miss to complete in 16 cycles. What seems to be more likely to me is that somehow your RNG is limiting the amount of swap instructions that can get pipelined, thus the same amount of L2/3 misses take more time because fewer of them are issuing concurrently. Alternatively your RNG is slow 🙂</p>
<p>For a more accurate model of what&rsquo;s going on I&rsquo;d suggest separately timing filling the indirection array and reordering the actual data.</p>
<p>Here&rsquo;s a quick C++ program; I&rsquo;ve copied PCG32 from the PCG web site and the bounded RNG function from your previous blog post, I may have introduced off by one errors in some cases. I&rsquo;m also including a forward Fisher Yates shuffle (copied from Wikipedia more or less).</p>
<p><a href="https://gist.github.com/zeux/cd41829e610fd3ce33e4ca9a16a16293" rel="nofollow ugc">https://gist.github.com/zeux/cd41829e610fd3ce33e4ca9a16a16293</a></p>
<p>The numbers that I get are very different from yours:</p>
<p>shuf 2.195379 s, gen 0.338417 s, shuf-gen 2.731224 s, fwd shuf 2.227119 s<br/>
shuf 2.167099 s, gen 0.122208 s, shuf-gen 2.870520 s, fwd shuf 2.314143 s<br/>
shuf 2.269147 s, gen 0.122214 s, shuf-gen 2.845593 s, fwd shuf 2.367242 s<br/>
shuf 2.270375 s, gen 0.122476 s, shuf-gen 2.867398 s, fwd shuf 2.314249 s<br/>
shuf 2.258742 s, gen 0.120076 s, shuf-gen 2.863602 s, fwd shuf 2.328118 s<br/>
shuf 2.265792 s, gen 0.126285 s, shuf-gen 2.923946 s, fwd shuf 2.356490 s<br/>
shuf 2.264414 s, gen 0.122542 s, shuf-gen 2.880007 s, fwd shuf 2.365302 s</p>
<p>You can see that running the RNG is an order of magnitude faster than shuffling &#8211; which is to be expected! &#8211; and pre-computing doesn&rsquo;t help.</p>
<p>One slightly odd part is that the precomputed shuffle is slower.</p>
<p>Using % range instead of (*range)&gt;&gt;32 doesn&rsquo;t change this significantly:</p>
<p>shuf 2.178649 s, gen 0.472895 s, shuf-gen 2.286348 s, fwd shuf 2.317720 s<br/>
shuf 2.186121 s, gen 0.253171 s, shuf-gen 2.286875 s, fwd shuf 2.242044 s<br/>
shuf 2.634489 s, gen 0.251526 s, shuf-gen 2.319564 s, fwd shuf 2.079921 s<br/>
shuf 2.155671 s, gen 0.250882 s, shuf-gen 2.167186 s, fwd shuf 2.028764 s<br/>
shuf 2.106639 s, gen 0.253934 s, shuf-gen 2.246153 s, fwd shuf 2.216789 s<br/>
shuf 2.179187 s, gen 0.263325 s, shuf-gen 2.218668 s, fwd shuf 2.288851 s</p>
<p>(note that the first run has gen always running slower than subsequent runs &#8211; this is expected since this is the run that pagefaults when writing to freshly allocated memory).</p>
</div>
<ol class="children">
<li id="comment-299328" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://zeuxcg.org" class="url" rel="ugc external nofollow">Arseny Kapoulkine</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-25T01:05:25+00:00">March 25, 2018 at 1:05 am</time></a> </div>
<div class="comment-content">
<p>ugh, the second set of numbers was taken in a different power mode where the clocks were somewhat higher; the correct run went as follows:</p>
<p>/mnt/c/work $ g++ -O2 rngshuf.cpp &amp;&amp; ./a.out<br/>
shuf 2.501412 s, gen 0.489999 s, shuf-gen 3.500264 s, fwd shuf 3.093110 s<br/>
shuf 2.473130 s, gen 0.259736 s, shuf-gen 2.852467 s, fwd shuf 2.476890 s<br/>
shuf 2.495287 s, gen 0.294554 s, shuf-gen 2.757949 s, fwd shuf 2.401504 s<br/>
shuf 2.398867 s, gen 0.252998 s, shuf-gen 2.830588 s, fwd shuf 2.467871 s<br/>
shuf 2.415531 s, gen 0.255211 s, shuf-gen 2.830087 s, fwd shuf 2.483296 s</p>
<p>(so slightly slower than fast bounded RNG but still reasonably close)</p>
</div>
<ol class="children">
<li id="comment-299354" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Me</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-25T11:30:55+00:00">March 25, 2018 at 11:30 am</time></a> </div>
<div class="comment-content">
<p>Given the mismatch between the C results and the Java results &#8211; where the precomputed random version was a lot faster, which would mean that memory accesses are cheaper than random generation &#8211; I think it is necessary to look at the generated assembler for both. Otherwise, it is just speculation what is going on here.</p>
</div>
<ol class="children">
<li id="comment-299371" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-25T17:20:13+00:00">March 25, 2018 at 5:20 pm</time></a> </div>
<div class="comment-content">
<p>I <a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2018/03/23/rngshuf.cpp" rel="nofollow">modified Arseny&rsquo;s code so that it follows the algorithms of the blog post</a> and I get very similar numbers:</p>
<pre>
 g++ -O3 -o rngshuf rngshuf.cpp &#038;& ./rngshuf
Reproducing the Java numbers from blog post https://lemire.me/blog/2018/03/24/when-shuffling-large-arrays-how-much-time-can-be-attributed-to-random-number-generation/#comments
Caveat: we use PCG instead of the LCG from Java.
java-bound PCG shuffle 1.623154 s
precomp  shuffle 0.824944 s
</pre>
<p>Arseny did not try to reproduce the same algorithms, he is benchmarking something different. He shows that you can make the shuffle fast if you use a fast ranged number generator. That&rsquo;s a different point.</p>
<p>Note also that Arseny&rsquo;s numbers are somewhat high which suggests that he is not testing on a server PC configured for testing&#8230;</p>
</div>
<ol class="children">
<li id="comment-299383" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6fc755fdd2e7d73ecaad1a84b8679c34?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6fc755fdd2e7d73ecaad1a84b8679c34?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Iwan Zotow</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-25T20:55:29+00:00">March 25, 2018 at 8:55 pm</time></a> </div>
<div class="comment-content">
<p>Frankly, even benchmark is a bit useless. Your precomputed arrays in taking up RAM and, what is more important, cache. In real life there is bunch of code consuming shuffled array, and it might want to use this cache. Xoroshiro+128 is very fast, takes likely no more than one cache line, and in real life which is NOT measured here, not allocating/using precomputed random number might be a big win for consumers of the shuffled array.</p>
</div>
<ol class="children">
<li id="comment-299385" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-25T21:11:29+00:00">March 25, 2018 at 9:11 pm</time></a> </div>
<div class="comment-content">
<p><em>Frankly, even benchmark is a bit useless. Your precomputed arrays in taking up RAM and, what is more important, cache. In real life there is bunch of code consuming shuffled array, and it might want to use this cache.</em></p>
<p>The precomputed version is not meant to be used to shuffle arrays, it is meant to answer the question &ldquo;When shuffling large arrays, how much time can be attributed to random number generation?&rdquo; To answer this question, we precompute the random numbers.</p>
<p><em> Xoroshiro+128 is very fast, takes likely no more than one cache line, and in real life which is NOT measured here, not allocating/using precomputed random number might be a big win for consumers of the shuffled array.</em></p>
<p>Xoroshiro+128 is not going to be faster than the default thread-local random number generator. Java uses a linear congruential generator. It is very fast.</p>
<p>See <a href="https://github.com/lemire/testingRNG" rel="nofollow ugc">https://github.com/lemire/testingRNG</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-348971" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maynard Handley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-12T00:25:32+00:00">September 12, 2018 at 12:25 am</time></a> </div>
<div class="comment-content">
<p>Is your interest in the implications for Java, or the implications for CPU HW? Because I find myself agreeing with &ldquo;Me&rdquo;; without access to the assembly it&rsquo;s hard to know what is going on. Is the pipeline of java compiler+JIT inlining both the nextInt() RNG call and the swap()? Does it inline the swap() in the second case but not in the first (because there is some heuristic that functions with function calls in their arguments are not inlined or whatever).</p>
<p>Even if inlining is ideal in both cases, there&rsquo;s question of exactly how many instructions the RNG results in. Under ideal circumstances we want the critical item, the queue that fills up first, to be (I assume) the L2 MSHRs, resulting in maximal memory level parallelism.<br/>
It&rsquo;s possible (hard to tell without assembly) that some earlier in-core queue fills up before the MSHRs under the &ldquo;generate RNG&rdquo; condition.</p>
</div>
<ol class="children">
<li id="comment-349609" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-17T00:55:10+00:00">September 17, 2018 at 12:55 am</time></a> </div>
<div class="comment-content">
<blockquote>
<p>Is your interest in the implications for Java, or the implications for CPU HW? Because I find myself agreeing with â€œMeâ€; without access to the assembly it&rsquo;s hard to know what is going on.</p>
</blockquote>
<p>I have posted both the Java and C code, and we get the same results. I posted the assembly resulting from the C code as a gist:</p>
<p><a href="https://gist.github.com/lemire/d2047ce1e3b511c54bb47b779a3028f5" rel="nofollow ugc">https://gist.github.com/lemire/d2047ce1e3b511c54bb47b779a3028f5</a></p>
<blockquote>
<p>It&rsquo;s possible (hard to tell without assembly) that some earlier in-core queue fills up before the MSHRs under the â€œgenerate RNGâ€ condition.</p>
</blockquote>
<p>Now that I have posted the assembly, can you answer the question?</p>
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
<li id="comment-299384" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6fc755fdd2e7d73ecaad1a84b8679c34?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6fc755fdd2e7d73ecaad1a84b8679c34?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Iwan Zotow</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-25T21:03:36+00:00">March 25, 2018 at 9:03 pm</time></a> </div>
<div class="comment-content">
<p>What would be interesting to test is how it behaves in macro-benchmark &#8211; when there is MT consumer of shuffled array, which wants all memory and cache lines for itself. Only in micro-benchmark like yours, 100M arrays (400Mb) is free, not using and polluting L3/L2/L1.</p>
</div>
</li>
</ol>
</li>
<li id="comment-299369" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-25T17:08:52+00:00">March 25, 2018 at 5:08 pm</time></a> </div>
<div class="comment-content">
<p>This type of cache miss overhead is also common with string sorting, where a list of pointers is dereferenced in (increasingly) random order.</p>
<p>I&rsquo;m not aware of any memory prediction schemes that automatically prefetch vectors of references like this, but it seems like it can be done with explicit prefetch instructions.</p>
</div>
</li>
<li id="comment-299426" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Oren Tirosh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-26T13:50:23+00:00">March 26, 2018 at 1:50 pm</time></a> </div>
<div class="comment-content">
<p>The LCG may be simple and fast, but it imposes a pipeline tight pipeline dependency. Try using a number of LCGs in round robin fashion, where you use the previous output of the LCG before updating it.</p>
<p>Alternatively, you can alternate between random precomputation and shuffling. Use precomputed chunks that are large enough to be a good approximation of a long continuous run yet short enough to fit in the L1 cache. The difference in timing with and without the shuffling should be a good microbenchmark. The only remaining overhead would be that of sequentially fetching values for a small buffer in the CPU cache.</p>
</div>
<ol class="children">
<li id="comment-299439" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-26T15:51:29+00:00">March 26, 2018 at 3:51 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>Alternatively, you can alternate between random precomputation and shuffling.</p>
</blockquote>
<p>I believe that this the idea described by Jeff Epler (see previous comments). After it was tested by Richard Startin in Java, I updated my GitHub repo.</p>
<p>See <a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2018/03/23/src/main/java/me/lemire/microbenchmarks/algorithms/Shuffle.java#L32-L48" rel="nofollow ugc">https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2018/03/23/src/main/java/me/lemire/microbenchmarks/algorithms/Shuffle.java#L32-L48</a></p>
<p>It works well. I call it &ldquo;blocked&rdquo;. Here are the results&#8230;</p>
<pre><code>Shuffle.test_shuffle_java                  avgt    5  1.927 Â±  0.016 s/op Shuffle.test_shuffle_java_blocked          avgt    5  1.309 Â±  0.051 s/op Shuffle.test_shuffle_precomp               avgt    5  0.818 Â±  0.001 s/op
</code></pre>
</div>
</li>
</ol>
</li>
</ol>
