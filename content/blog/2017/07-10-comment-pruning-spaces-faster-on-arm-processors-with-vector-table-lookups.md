---
date: "2017-07-10 12:00:00"
title: "Pruning spaces faster on ARM processors with Vector Table Lookups"
index: false
---

[16 thoughts on &ldquo;Pruning spaces faster on ARM processors with Vector Table Lookups&rdquo;](/lemire/blog/2017/07-10-pruning-spaces-faster-on-arm-processors-with-vector-table-lookups)

<ol class="comment-list">
<li id="comment-283064" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Cyril Lashkevich</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-10T17:31:21+00:00">July 10, 2017 at 5:31 pm</time></a> </div>
<div class="comment-content">
<p>Great work! In the future ARM Scalable Vector Extension there is prefect instruction &lsquo;COMPACT&rsquo; which &ldquo;Read the active elements from the source vector and pack them into the lowest-numbered elements of the destination vector. Then set any remaining elements of the destination vector to zero.&rdquo; This instruction will make shufmask unneeded. <a href="https://developer.arm.com/docs/ddi0584/latest/arm-architecture-reference-manual-supplement-the-scalable-vector-extension-sve-for-armv8-a" rel="nofollow ugc">https://developer.arm.com/docs/ddi0584/latest/arm-architecture-reference-manual-supplement-the-scalable-vector-extension-sve-for-armv8-a</a></p>
</div>
<ol class="children">
<li id="comment-283065" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-10T17:41:23+00:00">July 10, 2017 at 5:41 pm</time></a> </div>
<div class="comment-content">
<p><em>Great work!</em></p>
<p>Thanks. I have not made any attempt to optimize the code, beyond writing something that I can understand and that is likely to be correct. So it seems likely we can do even better.</p>
<p><em>This instruction will make shufmask unneeded. </em></p>
<p>Are you sure? Some AVX-512 instruction sets have compress instructions that do something similar, but they compress 32-bit words, not bytes. So I&rsquo;d be interested in verifying that the documentation refers to the application of COMPACT to bytes.</p>
</div>
<ol class="children">
<li id="comment-283068" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cyril Lashkevich</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-10T18:11:31+00:00">July 10, 2017 at 6:11 pm</time></a> </div>
<div class="comment-content">
<p>You are right, COMPACT works with words and doublewords only. But it still can be used, expand 2 times, compact, than narrow 2 times.</p>
</div>
<ol class="children">
<li id="comment-283070" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-10T18:18:51+00:00">July 10, 2017 at 6:18 pm</time></a> </div>
<div class="comment-content">
<p><em>But it still can be used (&#8230;) </em></p>
<p>Of course, the only way to know if it is practical is to write the code and test it out on actual hardware, but I don&rsquo;t think I have any hardware for it&#8230; Do we know when that will be available?</p>
</div>
<ol class="children">
<li id="comment-283071" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cyril Lashkevich</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-10T18:29:36+00:00">July 10, 2017 at 6:29 pm</time></a> </div>
<div class="comment-content">
<p>Yes, it would be interesting to experiment with such HW. I hope annual update of iPhones brings us it.</p>
</div>
</li>
</ol>
</li>
<li id="comment-283130" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5b398936012c5ab568223ef64750d802?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5b398936012c5ab568223ef64750d802?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sam Lee</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-11T17:21:44+00:00">July 11, 2017 at 5:21 pm</time></a> </div>
<div class="comment-content">
<p>Full disclosure, I&rsquo;m a graduate at ARM (and I&rsquo;m not commenting on behalf of ARM in any way)</p>
<p>In SVE, the new SPLICE instruction will be able to act on bytes and should cover this benchmark nicely (again performance will be implementation dependent, so we shall see how that goes):<br/>
&ldquo;Splice two vectors under predicate control. Copy the first active to last active elements (inclusive) from the first source vector to the lowest-numbered elements of the result. Then set any remaining elements of the result to a copy of the lowest-numbered elements from the second source vector. The result is placed destructively in the first source vector.&rdquo;</p>
<p>So in SVE this should boil down to 5 instructions per vector (interleaved as appropriate to hide latencies):<br/>
LD1B //load contiguous vector<br/>
CMPGT //set a predicate to 1 where non-white and 0 where whitespace<br/>
SPLICE //group non-white characters in bottom of vector (we don&rsquo;t care what happens at the top)<br/>
ST1B //store contiguous vector<br/>
INCP //increment pointer by number of non-white characters (using predicate)</p>
<p>(You can have a look at what&rsquo;s coming in more detail if you check the XML files from the zip in the link Cyril pointed to)</p>
</div>
<ol class="children">
<li id="comment-283131" class="comment byuser comment-author-lemire bypostauthor even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-11T17:32:45+00:00">July 11, 2017 at 5:32 pm</time></a> </div>
<div class="comment-content">
<p>Ah yes. So it is like Intel&rsquo;s Parallel Bits Extract, except that it is for bytes.</p>
<p>That would be wonderful.</p>
</div>
</li>
<li id="comment-283350" class="comment odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24cfa9591263008553ae4c125b6a9934?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24cfa9591263008553ae4c125b6a9934?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">wmu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-15T19:20:05+00:00">July 15, 2017 at 7:20 pm</time></a> </div>
<div class="comment-content">
<p>Sam, is there any ARM emulator that works like Intel Software Emulator? I mean one can run their compiled program using selected instruction set, and thanks to that would be able to test at least correctness of implementation for upcoming architectures.</p>
</div>
<ol class="children">
<li id="comment-283440" class="comment byuser comment-author-lemire bypostauthor even depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-17T15:53:25+00:00">July 17, 2017 at 3:53 pm</time></a> </div>
<div class="comment-content">
<p>The answer is apparently positive, you can run ARM SVE through an emulator:</p>
<p><a href="https://developer.arm.com/products/software-development-tools/hpc/documentation/running-sve-code-with-arm-instruction-emulator" rel="nofollow ugc">https://developer.arm.com/products/software-development-tools/hpc/documentation/running-sve-code-with-arm-instruction-emulator</a></p>
<p>Sadly, I could not find the emulator itself.</p>
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
<li id="comment-283067" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cyril Lashkevich</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-10T18:05:59+00:00">July 10, 2017 at 6:05 pm</time></a> </div>
<div class="comment-content">
<p>Btw size of table can be reduced 2 times, because row_n+1 == row_n &lt;&gt; 1));<br/>
if (index &amp; 1) {<br/>
shuf0 = vextq_u8(vdupq_n_u8(0), shuf, 1);<br/>
}</p>
<p>2. remove all even lines form shufmask, replace last unused values by zero and load shuf like this:<br/>
uint16_t index = neonmovemask_addv(w0);<br/>
uint8x16_t shuf0 = vld1q_u8(shufmask + 16 * (index &gt;&gt; 1) &#8211; index &amp;1);</p>
<p>In first case there is additional instruction and branch, in second access to unaligned memory. In fact indexes in shufmask are 4-bit, and the table can be compressed 2 times more, but unpacking will require 1 vector multiplication and 1 vector and.</p>
</div>
<ol class="children">
<li id="comment-283069" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cyril Lashkevich</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-10T18:14:01+00:00">July 10, 2017 at 6:14 pm</time></a> </div>
<div class="comment-content">
<p>Seems parser ate part of my comment 🙁 I have to use LSL for logical shift left<br/>
row_n+1 == row_n LSL 8<br/>
1. remove all even lines form shufmask, and calculate shuf like this.<br/>
uint16_t index = neonmovemask_addv(w0);<br/>
uint8x16_t shuf0 = vld1q_u8(shufmask + 16 * (index &gt;&gt; 1));<br/>
if (index &amp; 1) {<br/>
shuf0 = vextq_u8(vdupq_n_u8(0), shuf, 1);<br/>
}</p>
</div>
<ol class="children">
<li id="comment-283072" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-10T18:41:25+00:00">July 10, 2017 at 6:41 pm</time></a> </div>
<div class="comment-content">
<p>I think you were clear enough.</p>
<p>My guess is that adding a branch to save memory might often be a negative. My current benchmark leaves us with an &ldquo;easy to predict&rdquo; branch, so my guess is that if were to implement it, we would not see a performance difference&#8230; however, this could degenerate in other, harder benchmarks.</p>
<p>Your other change is more likely to be beneficial generally speaking. Not that it will be faster, but it will cut in the size of the binary.</p>
<p>We could do a lot better by replacing the 16-bit lookup with two 8-bit lookups, but it might double the number of instructions&#8230;</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-283407" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a7168e483cc5eac4b0928204956fc72e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a7168e483cc5eac4b0928204956fc72e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Derek Ledbetter</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-16T22:02:00+00:00">July 16, 2017 at 10:02 pm</time></a> </div>
<div class="comment-content">
<p>Here&rsquo;s my attempt. Like your newest method, I construct a bit mask recording whether each of the 8 characters in a block passed or failed the test, and then using vtbl to extract the correct characters and write them with a single instruction. But I didn&rsquo;t want to use a lookup table. </p>
<p>I couldn&rsquo;t find a simple way to construct the vtbl indices all at once, so I decided to flip the problem around. I do 16 8-character blocks at a time, and I construct the vtbl indices by doing the same operation 8 times, and then I do three rounds of zipping to put them in the correct order.</p>
<p>In each of the 8 steps, I find the location of the rightmost set bit by computing popcount((b &#8211; 1) &amp; ~b), and then I clear that bit by doing b &amp;= b &#8211; 1.</p>
<p>But it turns out to be more than twice as slow as your giant look-up table. On an iPhone 5s, in ns per operation:<br/>
despace: 1.28<br/>
neon_despace: 1.04<br/>
neon_despace_branchless: 0.64<br/>
neontbl_despace: 0.24<br/>
neon_interleaved_despace (my function): 0.58</p>
<p>I also wrote a simple test app for iOS. I posted all of this at GitHub.<br/>
<a href="https://github.com/DerekScottLedbetter/space-pruner" rel="nofollow ugc">https://github.com/DerekScottLedbetter/space-pruner</a></p>
<p>I have a new idea for computing the vtbl indices, but it probably won&rsquo;t beat the look-up table.</p>
</div>
<ol class="children">
<li id="comment-283439" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-17T15:45:57+00:00">July 17, 2017 at 3:45 pm</time></a> </div>
<div class="comment-content">
<p>That sounds very impressive.</p>
</div>
</li>
<li id="comment-283536" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a7168e483cc5eac4b0928204956fc72e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a7168e483cc5eac4b0928204956fc72e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Derek Ledbetter</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-20T23:51:20+00:00">July 20, 2017 at 11:51 pm</time></a> </div>
<div class="comment-content">
<p>I found a method for taking an integer and separating alternate set bits. I use NEON&rsquo;s polynomial multiplication feature and multiply the 8-bit integer by 0xFF, then AND the original with the product to get the 1st, 3rd, 5th, â€¦ set bits, and AND with the original with the complement of the product to get the 2nd, 4th, 6th, â€¦ set bits. Then I do this once more, so now I have four bytes, each with at most two set bits. Then I count the leading and trailing zeroes to get the indices of the bits.</p>
<p>Doing this cut the time from 0.58 to 0.49. Unrolling the loop, doing 256 bytes at once, reduces the time to 0.37, compared with 0.24 using the look-up table.</p>
</div>
<ol class="children">
<li id="comment-283538" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-21T00:39:12+00:00">July 21, 2017 at 12:39 am</time></a> </div>
<div class="comment-content">
<p>Wow. I will be checking it out.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
