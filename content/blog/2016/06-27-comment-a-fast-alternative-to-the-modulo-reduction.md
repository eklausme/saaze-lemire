---
date: "2016-06-27 12:00:00"
title: "A fast alternative to the modulo reduction"
index: false
---

[67 thoughts on &ldquo;A fast alternative to the modulo reduction&rdquo;](/lemire/blog/2016/06-27-a-fast-alternative-to-the-modulo-reduction)

<ol class="comment-list">
<li id="comment-245507" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/062547509ea29cb1a75e7260a77bb6e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/062547509ea29cb1a75e7260a77bb6e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://mdpopescu.blogspot.com" class="url" rel="ugc external nofollow">Marcel Popescu</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-27T15:37:55+00:00">June 27, 2016 at 3:37 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m missing something&#8230; are you saying that x % N and (x * N) div 2^32 are equivalent? This is trivially false for, e.g., 1 % 7 vs (1 * 7) div 2^32.</p>
</div>
<ol class="children">
<li id="comment-245511" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-27T16:41:30+00:00">June 27, 2016 at 4:41 pm</time></a> </div>
<div class="comment-content">
<p>I am not saying that x % N is equal to (x * N) div 2^32 . This is obviously false, as you indicate. I am saying that they are both fair maps from the set of all 32-bit integers down to integers in [0,N).</p>
</div>
<ol class="children">
<li id="comment-245519" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-27T18:14:29+00:00">June 27, 2016 at 6:14 pm</time></a> </div>
<div class="comment-content">
<p>It is not, unless you have numbers uniformly distributed from 0 to numeric_limits::max()</p>
</div>
<ol class="children">
<li id="comment-245525" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-27T19:23:17+00:00">June 27, 2016 at 7:23 pm</time></a> </div>
<div class="comment-content">
<p>If you have, say, 31-bit integers, instead of 32-bit integers, as might happen with a call to <tt>rand</tt>, you can adapt the map by shifting by 31 instead of 32.</p>
</div>
</li>
</ol>
</li>
<li id="comment-245521" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-27T18:16:34+00:00">June 27, 2016 at 6:16 pm</time></a> </div>
<div class="comment-content">
<p>PS: Especially, if you use it for hashing and you numbers tend to be small then all your hash values will be horribly biased down. Perhaps, reducing div 2^32 to div 2^(some smaller degree of tw) may help.</p>
</div>
<ol class="children">
<li id="comment-245526" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-27T19:28:56+00:00">June 27, 2016 at 7:28 pm</time></a> </div>
<div class="comment-content">
<p>A good hash function should be regular. That is, it should be so that all integers are &ldquo;equally likely&rdquo; (given a random input). If your hash values do not cover the whole 32-bit range, you need to adapt the map, probably as you describe.</p>
</div>
<ol class="children">
<li id="comment-245532" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-27T20:24:56+00:00">June 27, 2016 at 8:24 pm</time></a> </div>
<div class="comment-content">
<p>What is the cost of computing a good hash value? 🙂 Perhaps, it should be included in the overall computation time. This may (drastically?) reduce the difference between two approaches.</p>
<p>I also suspect that in many cases, given a list of IDs you can get reasonable results by doing just ID % . In this case, you can get away without applying a hashing transformation. With your trick, you do need this. </p>
<p>For example, if you numbers are smaller than 2^20 (which is quite likely) and N &lt; 2^16, then it looks like all your hash values will be zero.</p>
</div>
<ol class="children">
<li id="comment-245533" class="comment odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-27T20:25:47+00:00">June 27, 2016 at 8:25 pm</time></a> </div>
<div class="comment-content">
<p>by doing just ID * some perhaps prime number. Angle brackets were removed by HTML 🙂</p>
</div>
</li>
<li id="comment-245537" class="comment byuser comment-author-lemire bypostauthor even depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-27T21:59:31+00:00">June 27, 2016 at 9:59 pm</time></a> </div>
<div class="comment-content">
<p><em>What is the cost of computing a good hash value? </em></p>
<p>Of course, you are correct that there are many cases where the modulo reduction will not be a bottleneck. In such cases, this fast map is useless.</p>
<p>However, there are real-world examples where people set their capacity to a power of two to improve performance. A latency of a couple of dozens of cycles (for a division) is not great. </p>
<p><em>I also suspect that in many cases, given a list of IDs you can get reasonable results by doing just ID % N.</em></p>
<p>Yes. Moreover, as alluded to in my post, if N is known ahead of time, you can avoid the modulo reduction entirely and replace it with a faster function. See Hacker&rsquo;s Delight.</p>
</div>
<ol class="children">
<li id="comment-245542" class="comment odd alt depth-7">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-28T00:12:32+00:00">June 28, 2016 at 12:12 am</time></a> </div>
<div class="comment-content">
<p>Agree. Good point about N known in advance.</p>
</div>
</li>
<li id="comment-490931" class="comment even depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ee62fef24448f1cbe62ca0eb89330e3c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ee62fef24448f1cbe62ca0eb89330e3c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">hlide fremen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-02-17T13:56:04+00:00">February 17, 2020 at 1:56 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
However, there are real-world examples where people set their capacity to a power of two to improve performance.
</p></blockquote>
<p>You mean: <em>ID % (2^N)</em>? If so, chance the compiler turns this expression into <em>ID &amp; ((2^N) &#8211; 1)</em> which is even faster than the fast alternative with a multiplication following a shift, isn&rsquo;t it?</p>
</div>
<ol class="children">
<li id="comment-490935" class="comment byuser comment-author-lemire bypostauthor odd alt depth-8">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-02-17T14:17:11+00:00">February 17, 2020 at 2:17 pm</time></a> </div>
<div class="comment-content">
<p>@hlide</p>
<p>Yes, though being limited by powers of two can be wasteful.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-281890" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4c476469ffae422c3dd50720fbd7ef2a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4c476469ffae422c3dd50720fbd7ef2a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maxim Egorushkin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-21T09:55:12+00:00">June 21, 2017 at 9:55 am</time></a> </div>
<div class="comment-content">
<p>Would byte-swapping x help to preserve lower-order bits, e.g.:</p>
<p>uint32_t reduce2(uint32_t x, uint32_t N) {<br/>
return static_cast&lt;uint64_t&gt;(bswap_32(x)) * N &gt;&gt; 32;<br/>
}</p>
<p>&nbsp;</p>
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
<li id="comment-245523" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-27T18:29:32+00:00">June 27, 2016 at 6:29 pm</time></a> </div>
<div class="comment-content">
<p>On a second thought, if modulo reduction slows you down, you may want to try SIMD and bulk conversion. You can something like:<br/>
__m128 recip = __mm_set1_ps(1/float(N));<br/>
__m128 mult = __mm_set1_ps(N);<br/>
__m128 to_convert = __mm_loadu_ps(&#8230;);<br/>
__m128 tmp = _mm_mul_ps(mult, _mm_floor_ps(_mm_mul_ps(to_convert_,recip)));<br/>
__m128i res = _mm_cvtps_epi32(_mm_floor_ps(_mm_sub_ps(to_convert, tmp)));<br/>
Peraphs, an additional SIMD min is required to ensure the value is &lt; N. Anyways, seems like it is worth trying such as solution.</p>
</div>
<ol class="children">
<li id="comment-245529" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-27T19:45:57+00:00">June 27, 2016 at 7:45 pm</time></a> </div>
<div class="comment-content">
<p>Yes, Leonid, I suspect that you are quite right. There are cases where using floating-point numbers, especially in conjunction with SIMD instructions, could lead to great results.</p>
</div>
</li>
<li id="comment-649007" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f8364132def52383c5e4e1b21bf7f371?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f8364132def52383c5e4e1b21bf7f371?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">moonchild</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-21T09:17:37+00:00">January 21, 2023 at 9:17 am</time></a> </div>
<div class="comment-content">
<p>As long as your reciprocal is rounded down (not hard to ensure when you create it; can decrement if desirable), you don&rsquo;t need a min, because float math is monotonic. However, you now only get 24 bits of (reduced) hash, which is not that much.</p>
</div>
</li>
</ol>
</li>
<li id="comment-245524" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-27T19:22:23+00:00">June 27, 2016 at 7:22 pm</time></a> </div>
<div class="comment-content">
<p>To re-phase Daniel:</p>
<p>We want to generate an index (I) chosen uniformly from the range 0..N-1.</p>
<p>We have a 32-bit random value (R), and assume a uniform distribution.</p>
<p>When N is a power-of-two, then the good/easy/fair answer: mask off the higher bits of R. (I have used this more than a few times, as a programmer.) </p>
<p>When N is not a power-of-two, the easy answer is:<br/>
I = R mod N<br/>
Two problems: the modulus operation is somewhat expensive, and the distribution is not *quite* even (that last wrap-around) &#8211; though likely good enough.</p>
<p>Daniel&rsquo;s solution is (in two steps):<br/>
R = R * N<br/>
We now have a value in the range to N * 2^32.<br/>
I = R &gt;&gt; 32<br/>
We now have a value in the range to N. The two operations (multiply and shift) are almost certainly cheaper than the modulus operation.</p>
<p>I suspect the values are not *quite* uniform, but likely good enough. (How uniformly distributed are the multiplication products in each of the N buckets?)</p>
<p>Might write a test program to measure. 🙂</p>
</div>
<ol class="children">
<li id="comment-245527" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-27T19:31:54+00:00">June 27, 2016 at 7:31 pm</time></a> </div>
<div class="comment-content">
<p>If N is small compared to 2^32, then I submit to you that you won&rsquo;t be able to measure any bias.</p>
</div>
</li>
</ol>
</li>
<li id="comment-245547" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-28T01:07:14+00:00">June 28, 2016 at 1:07 am</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s a fairly simple proof. You stretch the [0, 2^32) random variable range out to multiples of N in [0, N*2^32] and then map [0,2^32) to 0, [2^32, 2*2^32) to 1, etc. by integer division (&gt;&gt;32). The number of multiples of N in each range is floor or ceil(2^32/N).</p>
</div>
<ol class="children">
<li id="comment-245552" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-28T02:40:00+00:00">June 28, 2016 at 2:40 am</time></a> </div>
<div class="comment-content">
<p>Thanks. I had a relatively short proof that used elementary number theory (a few lines), but it slightly got out of hand when I tried to make it accessible to people who may not master these concepts. A more direct approach like you suggest would have been better! Kudos!</p>
</div>
<ol class="children">
<li id="comment-245595" class="comment byuser comment-author-lemire bypostauthor even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-28T15:32:17+00:00">June 28, 2016 at 3:32 pm</time></a> </div>
<div class="comment-content">
<p>I have updated my blog post with a more direct proof.</p>
</div>
<ol class="children">
<li id="comment-245604" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-28T18:07:17+00:00">June 28, 2016 at 6:07 pm</time></a> </div>
<div class="comment-content">
<p>Thanks &#8212; I actually thought it through hoping to find a different method, and ended up with a proof of the same one. Oh well.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-245678" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4c476469ffae422c3dd50720fbd7ef2a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4c476469ffae422c3dd50720fbd7ef2a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maxim Egorushkin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-29T12:54:16+00:00">June 29, 2016 at 12:54 pm</time></a> </div>
<div class="comment-content">
<p>Note that expression `((uint64_t) x * (uint64_t) N) &gt;&gt; 32` on x86-64 compiles into a 64-bit multiplication that yields a 128-bit result, followed by the shift. </p>
<p>With a bit of inline assembly it can use a shorter 32-bit mul instruction that yields a 64-bit result in EDX:EAX. The required result is in EDX, no shift instruction is required.</p>
</div>
<ol class="children">
<li id="comment-245685" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-29T15:19:09+00:00">June 29, 2016 at 3:19 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s a very good point. I am somewhat disappointed that the compiler fails to exploit this optimization.</p>
</div>
<ol class="children">
<li id="comment-245687" class="comment byuser comment-author-lemire bypostauthor even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-29T15:39:10+00:00">June 29, 2016 at 3:39 pm</time></a> </div>
<div class="comment-content">
<p>For the record, something like this could do the job&#8230;</p>
<p><code><br/>
uint32_t asm_highmult32to32(uint32_t u, uint32_t v) {<br/>
uint32_t answer;<br/>
__asm__ ("imull %[v]\n"<br/>
"movl %%edx,%[answer]\n"<br/>
: [answer] "+r" (answer) : [u] "a" (u), [v] "r" (v) :"eax","edx" );<br/>
return answer;<br/>
}<br/>
</code></p>
<p>But it is unlikely to help performance as is. You&rsquo;d probably need to rewrite a larger chunk of code using assembly.</p>
</div>
<ol class="children">
<li id="comment-249471" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/78b315ac36bae6a97dabdab07f3ae628?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/78b315ac36bae6a97dabdab07f3ae628?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/fsaintjacques" class="url" rel="ugc external nofollow">Francois Saint-Jacques</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-12T02:28:22+00:00">August 12, 2016 at 2:28 am</time></a> </div>
<div class="comment-content">
<p>For some reason, gcc does the correct thing with `uint128_t` operands.</p>
</div>
<ol class="children">
<li id="comment-249472" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/78b315ac36bae6a97dabdab07f3ae628?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/78b315ac36bae6a97dabdab07f3ae628?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/fsaintjacques" class="url" rel="ugc external nofollow">Francois Saint-Jacques</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-12T02:29:18+00:00">August 12, 2016 at 2:29 am</time></a> </div>
<div class="comment-content">
<p>See <a href="https://godbolt.org/g/kZ91Yu" rel="nofollow ugc">https://godbolt.org/g/kZ91Yu</a> .</p>
</div>
</li>
</ol>
</li>
<li id="comment-281895" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4c476469ffae422c3dd50720fbd7ef2a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4c476469ffae422c3dd50720fbd7ef2a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maxim Egorushkin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-21T10:43:29+00:00">June 21, 2017 at 10:43 am</time></a> </div>
<div class="comment-content">
<p>mulx instruction would be ideal here: takes 2 assembly instructions to produce the value in eax, no flags affected:</p>
<p>uint32_t reduce3(uint32_t x, uint32_t N) {<br/>
uint32_t r;<br/>
asm(&ldquo;movl %[N], %%edx\n\t&rdquo;<br/>
&ldquo;mulxl %[x], %[r], %[r]&rdquo;<br/>
: [r]&rdquo;=r&rdquo;(r)<br/>
: [x]&rdquo;r&rdquo;(x), [N]&rdquo;r&rdquo;(N)<br/>
: &ldquo;edx&rdquo;);<br/>
return r;<br/>
}</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-256351" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-19T18:40:45+00:00">October 19, 2016 at 6:40 pm</time></a> </div>
<div class="comment-content">
<p>Doing this for floats (random within [0,x)) is also fairly easy since it just requires subtracting 32 from the exponent, which ldexp can do, eg ldexp(rand(), -32) gives a float in [0,1) (assuming rand() is 32-bit here).</p>
<p>There&rsquo;s some loss of precision as floats discard lower-order bits automatically, unless we cast to a longer mantissa first.</p>
</div>
</li>
<li id="comment-273466" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/43faa3515948be37f0237f10e5f27fbc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/43faa3515948be37f0237f10e5f27fbc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Pablo</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-28T18:48:24+00:00">February 28, 2017 at 6:48 pm</time></a> </div>
<div class="comment-content">
<p>Since I don&rsquo;t read math proofs daily, this took me a bit of thinking to parse. At the end I realized all this was a variation of: </p>
<p>rand(1) * N</p>
<p>In order:</p>
<p> ( rand(2^32) * N ) / 2^32 </p>
<p>is equivalent to</p>
<p>( rand(2^32) / 2^32 ) * N</p>
<p>which is equivalent to</p>
<p>floor( (float)[0,1) * N )</p>
</div>
<ol class="children">
<li id="comment-273473" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-28T19:23:47+00:00">February 28, 2017 at 7:23 pm</time></a> </div>
<div class="comment-content">
<p>Yes, for some fuzzy notion of &ldquo;equivalent&rdquo;. For example, rand(2^32) / 2^32 is not equivalent to picking a number in [0,1) fairly.</p>
</div>
</li>
</ol>
</li>
<li id="comment-275987" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/edc4100b4c5df043ab5c99249464b412?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/edc4100b4c5df043ab5c99249464b412?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Chad Harrington</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-21T02:37:50+00:00">March 21, 2017 at 2:37 am</time></a> </div>
<div class="comment-content">
<p>This is a godsend for FPGAs. Modulus by an arbitrary number is expensive in both time and space in hardware. Shifts are free and nearly all modern FPGAs have hard multiplier blocks. This is a perfect solution. Thanks !</p>
</div>
</li>
<li id="comment-280404" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cba7f423f9e0ee3a0be1ca18978a6684?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cba7f423f9e0ee3a0be1ca18978a6684?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.idryman.org" class="url" rel="ugc external nofollow">Felix Chern</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-26T00:03:09+00:00">May 26, 2017 at 12:03 am</time></a> </div>
<div class="comment-content">
<p>I created a similar approach to fast range named &ldquo;fast mod and scale&rdquo;. I didn&rsquo;t realize fast range until I started to survey alternatives for writing my blog post. <a href="http://www.idryman.org/blog/2017/05/03/writing-a-damn-fast-hash-table-with-tiny-memory-footprints/" rel="nofollow ugc">http://www.idryman.org/blog/2017/05/03/writing-a-damn-fast-hash-table-with-tiny-memory-footprints/</a><br/>
I&rsquo;m happy to see other people also interested in this problem. Even though solution is just one or two lines are code, it is still a important problem to solve!</p>
<p>It first mask the hash value to next power of two, then do the fast range (I named it scaling) described in your post. It cost a bit more cycles, but are small enough because of modern cpu pipelining. The major usage of fast mod and scale (my method) is to make hash table probing as easy to implement as using strait mod. For hash tables that doesn&rsquo;t use probing, like cuckoo hashing or standard chaining, fast range is sufficient.</p>
<p>More analysis and implementation details are in the blog I posted above.</p>
</div>
</li>
<li id="comment-293801" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1804553e81624bd218eccca58dee4b9d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1804553e81624bd218eccca58dee4b9d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Joost VandeVondele</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-21T06:57:05+00:00">December 21, 2017 at 6:57 am</time></a> </div>
<div class="comment-content">
<p>This also made it in the world&rsquo;s strongest open source chess engine (stockfish) :</p>
<p><a href="https://github.com/official-stockfish/Stockfish/commit/2198cd0524574f0d9df8c0ec9aaf14ad8c94402b" rel="nofollow ugc">https://github.com/official-stockfish/Stockfish/commit/2198cd0524574f0d9df8c0ec9aaf14ad8c94402b</a></p>
</div>
<ol class="children">
<li id="comment-293878" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-22T22:55:09+00:00">December 22, 2017 at 10:55 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s amazing.</p>
</div>
</li>
</ol>
</li>
<li id="comment-316715" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d023b767b19ddb41cde8f37d90864c1a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d023b767b19ddb41cde8f37d90864c1a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">TQTrung</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-12T16:23:05+00:00">July 12, 2018 at 4:23 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m using x64 laptop-windows 10 and try fast modulo function but not success. Result is always zero. Why??? Did I miss something?</p>
</div>
<ol class="children">
<li id="comment-316721" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-12T16:55:29+00:00">July 12, 2018 at 4:55 pm</time></a> </div>
<div class="comment-content">
<p>Can you share the code that gives you always zero?</p>
</div>
<ol class="children">
<li id="comment-316722" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d023b767b19ddb41cde8f37d90864c1a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d023b767b19ddb41cde8f37d90864c1a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">TQTrung</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-12T16:58:54+00:00">July 12, 2018 at 4:58 pm</time></a> </div>
<div class="comment-content">
<p>include </p>
<p>using namespace std;</p>
<p>uint32_t reduce(uint32_t x, uint32_t N)<br/>
{<br/>
return (((uint64_t)x * (uint64_t)N) &gt;&gt; 32);<br/>
}</p>
<p>int main()<br/>
{<br/>
cout&lt;&lt; reduce(12, 7);<br/>
return 0;<br/>
}<br/>
I tried in my laptop (x64) and &ldquo;www.onlinegdb.com&rdquo; but i received the same result is zero. Did i miss something?</p>
</div>
<ol class="children">
<li id="comment-316725" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-12T17:02:25+00:00">July 12, 2018 at 5:02 pm</time></a> </div>
<div class="comment-content">
<p>What do you expect reduce(12,7) to do?</p>
</div>
<ol class="children">
<li id="comment-593371" class="comment odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6481ff18d8ea0c0338092b38d298e05a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6481ff18d8ea0c0338092b38d298e05a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Chuck #1</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-04T19:32:27+00:00">August 4, 2021 at 7:32 pm</time></a> </div>
<div class="comment-content">
<p><a href="https://xkcd.com/221/" rel="nofollow ugc">Yet wasn&rsquo;t 7 chosen by a fair single cubic die roll?</a></p>
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
<li id="comment-316726" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d023b767b19ddb41cde8f37d90864c1a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d023b767b19ddb41cde8f37d90864c1a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">TQTrung</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-12T17:04:53+00:00">July 12, 2018 at 5:04 pm</time></a> </div>
<div class="comment-content">
<p>I tried many different values as 20, 33, 5 (modulo for 7) and I received the same result is zero</p>
</div>
<ol class="children">
<li id="comment-316770" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-12T20:12:00+00:00">July 12, 2018 at 8:12 pm</time></a> </div>
<div class="comment-content">
<p>Did you try random 32-bit numbers? Please do. Here is a sample program&#8230;</p>
<p><a href="https://gist.github.com/lemire/b9596313593dcb6aa311f5e5aa60f517" rel="nofollow ugc">https://gist.github.com/lemire/b9596313593dcb6aa311f5e5aa60f517</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-316814" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d023b767b19ddb41cde8f37d90864c1a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d023b767b19ddb41cde8f37d90864c1a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">TQTrung</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-13T01:52:38+00:00">July 13, 2018 at 1:52 am</time></a> </div>
<div class="comment-content">
<p>Wow! Thank you very much!</p>
</div>
</li>
<li id="comment-421799" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/43b76f043fde2afc672345089ab93860?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/43b76f043fde2afc672345089ab93860?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thorham</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-02T12:19:33+00:00">August 2, 2019 at 12:19 pm</time></a> </div>
<div class="comment-content">
<p>Isn&rsquo;t this basically fixed point arithmetic where the bottom 32 bits are the fractional part?</p>
</div>
<ol class="children">
<li id="comment-421819" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-02T14:56:47+00:00">August 2, 2019 at 2:56 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>Isn’t this basically fixed point arithmetic where the bottom 32 bits<br/>
are the fractional part?</p>
</blockquote>
<p>Basically, yes. It is really not hard conceptually.</p>
</div>
</li>
</ol>
</li>
<li id="comment-430518" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/059c8854a5473111cc6739847f401306?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/059c8854a5473111cc6739847f401306?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cyril</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-07T09:48:01+00:00">October 7, 2019 at 9:48 am</time></a> </div>
<div class="comment-content">
<p>Unless <code>x * N &gt; (1&lt;&lt;shiftAmount)</code> the result is 0. I don&rsquo;t know how you are computing fairness but your post is misleading.</p>
<p>In fact, you&rsquo;re returning the quotient of the product by 2 raised to power of shiftAmount =&gt; reduce = floor[(x*N) / 2^shiftAmount]</p>
<p>Since, in a hash table, you are unlikely to use a power of 2 for the bucket&rsquo;s count, this is not going to work well, and you&rsquo;ll get a lot of collision if you&rsquo;re using a power of 2 for the divisor. Since N can not be in [0 ; powerOfTwoRange] this is useless.</p>
<p>If you know that N is in [0; 2^32] range, nice. But that&rsquo;s condition that rarely happens in real life.</p>
<p>Let&rsquo;s say you have a hash table to have a more compact storage of ID =&gt; Value, then this function will produce a huge amount of collision on the low bucket&rsquo;s indexes and almost no collision on the last buckets.</p>
<p>Obviously, in benchmark where N are as probable to happen in [0 2^32] range, this method is as fair as a modulo. Yet, these rarely happens in reality and the cost to handle collisions in a hash table is many times more important than the cost of the modulo.</p>
<p>You&rsquo;d probably get a better result by SWARing the product before dividing (that is, <code>p = x * N</code> <code>p = p ^ (p&gt;&gt;32)</code> and so on) then masking by <code>0xFFFFFFFF</code>. But at some point, I doubt you&rsquo;ll beat a modulo operation.</p>
</div>
<ol class="children">
<li id="comment-430790" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-08T18:12:55+00:00">October 8, 2019 at 6:12 pm</time></a> </div>
<div class="comment-content">
<p>Note that the trick described in this blog post is used in many real-life systems, some of which you are maybe relying upon. It definitively works.</p>
<p><em>If you know that N is in [0; 2^32] range, nice. But that’s condition that rarely happens in real life.</em></p>
<p>You are expected to use this trick, like the modulo reduction, after hashing. You can hash to the [0, 2^32) range.</p>
<p><em>But at some point, I doubt you’ll beat a modulo operation</em></p>
<p>You need to hash your objects in all cases. You should never &ldquo;just&rdquo; use the modulo reduction. What you typically do is hash and then reduce. You can either reduce using the modulo reduction or using this trick.</p>
<p>Most hash functions, just like most random number generators, have output sizes that are powers of two.</p>
</div>
</li>
</ol>
</li>
<li id="comment-481046" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8926692572e5f1daa120349551f8dac9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8926692572e5f1daa120349551f8dac9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">L. C.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-27T17:40:24+00:00">December 27, 2019 at 5:40 pm</time></a> </div>
<div class="comment-content">
<p>This works great! Thank you!</p>
</div>
</li>
<li id="comment-488404" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d3832d1a47249613c3ad9269443a1b62?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d3832d1a47249613c3ad9269443a1b62?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Piotr Grochowski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-30T20:16:18+00:00">January 30, 2020 at 8:16 pm</time></a> </div>
<div class="comment-content">
<p>Ok so what if the RNG output is 64-bit. Example, compiling xoshiro256** to a 32-bit executable, .</p>
</div>
<ol class="children">
<li id="comment-488638" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d3832d1a47249613c3ad9269443a1b62?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d3832d1a47249613c3ad9269443a1b62?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Piotr Grochowski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-31T11:16:13+00:00">January 31, 2020 at 11:16 am</time></a> </div>
<div class="comment-content">
<p>So, you can&rsquo;t do this method on 64-bit output on 32-bit platforms because there are no 128-bit integers on 32-bit platforms!</p>
</div>
<ol class="children">
<li id="comment-488683" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-31T14:20:00+00:00">January 31, 2020 at 2:20 pm</time></a> </div>
<div class="comment-content">
<p>On 32-bit systems, there are many optimizations you cannot do, so this technique should probably be the least of your worries.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-499225" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/beb21939f6a5a1e3b48faa2d5eed358a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/beb21939f6a5a1e3b48faa2d5eed358a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anonymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-03T21:56:36+00:00">April 3, 2020 at 9:56 pm</time></a> </div>
<div class="comment-content">
<p>Why not do real modulo though?</p>
<p><code>X % Y = (BITAND(CEILING(X*256/Y),255)*Y)&gt;&gt;8<br/>
</code></p>
<p>The reciprocal 256/Y can be approximate</p>
</div>
<ol class="children">
<li id="comment-499226" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-03T22:07:24+00:00">April 3, 2020 at 10:07 pm</time></a> </div>
<div class="comment-content">
<p>Yes, you can do this as well, though it is slightly more complicated. Please see</p>
<p>Faster Remainder by Direct Computation: Applications to Compilers and Software Libraries<br/>
Software: Practice and Experience 49 (6), 2019<br/>
<a href="https://arxiv.org/abs/1902.01961" rel="nofollow ugc">https://arxiv.org/abs/1902.01961</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-532044" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/431991a6d7982fd17fc7151a15a52299?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/431991a6d7982fd17fc7151a15a52299?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bo</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-26T14:10:34+00:00">June 26, 2020 at 2:10 pm</time></a> </div>
<div class="comment-content">
<p>Thanks. This is amazingly fast in my case of a bloomfilter probe function. Even faster than the SIMD implementation.</p>
</div>
<ol class="children">
<li id="comment-532120" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/431991a6d7982fd17fc7151a15a52299?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/431991a6d7982fd17fc7151a15a52299?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bo</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-27T02:29:51+00:00">June 27, 2020 at 2:29 am</time></a> </div>
<div class="comment-content">
<p>Correction. There was a bug in my implementation. The fast modulo is close to the performance of &ldquo;power-of-two&rdquo;. The SIMD (AVX512) method is still the fastest.</p>
</div>
</li>
</ol>
</li>
<li id="comment-587921" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6851ac0ccc58b3fe10c027346e0b51ae?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6851ac0ccc58b3fe10c027346e0b51ae?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Pieter Wuille</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-20T21:18:45+00:00">June 20, 2021 at 9:18 pm</time></a> </div>
<div class="comment-content">
<p>Hello Daniel,</p>
<p>Thank you for this technique; I have used it in a number of projects.</p>
<p>Today I was wondering about a generalization: say you have a hash output x (in range [0,2<strong>32) like here), but want to extract two independent ranged values from it, with ranges N1 and N2 (where N1*N2 &lt; 2</strong>32). And it seems there is a very clean solution:</p>
<p>out1 = (x * N1) &gt;&gt; 32;<br/>
x2 = (uint32_t)(x * N1);<br/>
out2 = (x2 * N2) &gt;&gt; 32;</p>
<p>Effectively the multiplication x*N1 leaves us with a 64-bit number whose high bits are the first output, and the low bits are the remaining entropy &#8211; conveniently scaled to range [0,2**32) again, ready to be used for a second reduction.</p>
<p>It can be applied iteratively, though the quality of the extracted numbers will degrade as more entropy is extracted.</p>
</div>
<ol class="children">
<li id="comment-587923" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-20T21:48:17+00:00">June 20, 2021 at 9:48 pm</time></a> </div>
<div class="comment-content">
<p>@Pieter It does not seem unreasonable.</p>
</div>
<ol class="children">
<li id="comment-587936" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6851ac0ccc58b3fe10c027346e0b51ae?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6851ac0ccc58b3fe10c027346e0b51ae?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Pieter Wuille</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-21T01:14:31+00:00">June 21, 2021 at 1:14 am</time></a> </div>
<div class="comment-content">
<p>An even better construction:</p>
<p>start with state = x<br/>
iterate over ranges N[i] of numbers to be extracted:</p>
<p>mask = ~N[i] &amp; (N[i]-1)<br/>
tmp = state * range<br/>
output[i] = tmp &gt;&gt; 32<br/>
state = (state + (out &amp; mask)) &amp; 0xFFFFFFFF</p>
<p>This preserves all entropy; every iteration merely permutes the state. This means that all produced numbers are individually as uniformly distributed as extracting directly from x. Furthermore, it moves the &ldquo;unused&rdquo; portion of the entropy to the top of the state, so that it gets preferentially used in the next step. Some testing with small numbers seems to indicate that this actually produces optimal joint distributions of subsequently produced numbers (i.e. the distribution of output[k&#8230;k+j] is as well distributed as extracting a number with range N[k] * N[k+1] * &#8230; * [k+j] directly).</p>
</div>
<ol class="children">
<li id="comment-587938" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-21T01:25:37+00:00">June 21, 2021 at 1:25 am</time></a> </div>
<div class="comment-content">
<p>What is &ldquo;out&rdquo; in your pseudocode?</p>
</div>
<ol class="children">
<li id="comment-587939" class="comment odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6851ac0ccc58b3fe10c027346e0b51ae?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6851ac0ccc58b3fe10c027346e0b51ae?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Pieter Wuille</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-21T01:28:59+00:00">June 21, 2021 at 1:28 am</time></a> </div>
<div class="comment-content">
<p>Oops, output[i].</p>
</div>
</li>
<li id="comment-587940" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6851ac0ccc58b3fe10c027346e0b51ae?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6851ac0ccc58b3fe10c027346e0b51ae?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Pieter Wuille</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-21T01:35:59+00:00">June 21, 2021 at 1:35 am</time></a> </div>
<div class="comment-content">
<p>I made another typo.</p>
<p>It is:</p>
<p>mask = ~N[i] &amp; (N[i]-1)<br/>
tmp = state * range<br/>
output[i] = tmp &gt;&gt; 32<br/>
state = (tmp + (output[i] &amp; mask)) &amp; 0xFFFFFFFF</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-591000" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/93d548079486bedf4a74f87ab889841d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/93d548079486bedf4a74f87ab889841d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Pieter Wuille</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-16T23:00:29+00:00">July 16, 2021 at 11:00 pm</time></a> </div>
<div class="comment-content">
<p>I wrote a bit more extensively about this idea: <a href="https://github.com/sipa/writeups/tree/main/uniform-range-extraction" rel="nofollow ugc">https://github.com/sipa/writeups/tree/main/uniform-range-extraction</a></p>
</div>
<ol class="children">
<li id="comment-591102" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-17T15:40:59+00:00">July 17, 2021 at 3:40 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for the link.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-623564" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/064748c8d08d3436ca7d30e620ef1e8a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/064748c8d08d3436ca7d30e620ef1e8a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kip Ingram</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-03-18T00:10:28+00:00">March 18, 2022 at 12:10 am</time></a> </div>
<div class="comment-content">
<p>For N=255 you can also get rid of that multiplication by 255 &#8211; it can be replaced by an eight bit shift left and a subtraction of the original value.<br/>
A nice trick for N=255 is to note that 1/255 = 2^-8 + 2^-16 + 2^-24 + 2^-32 + &#8230; If you&rsquo;re interested in handling 32-bit values and you&rsquo;re on a 64-bit processor, you can get a lot of mileage out of shifts and adds built around this. I did one today that uses about 12 lines of x86_64 assembly, just shifts and add/subtract. The &ldquo;wart&rdquo; is that you do have to truncate that series somewhere, and consequently exact multiples of 255 will return 255, rather than 0. But one below goes to 254, and one above goes to 1, so it&rsquo;s just a matter of catching the 255 results and replacing them with 0.</p>
<p>Sure beats the heck out of idiv.</p>
</div>
</li>
<li id="comment-646285" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3318a940a26fa3ae1175be4ab4b21311?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3318a940a26fa3ae1175be4ab4b21311?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">vbextreme</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-10-07T07:26:40+00:00">October 7, 2022 at 7:26 am</time></a> </div>
<div class="comment-content">
<p>I have try but not working, always return 0<br/>
<a href="https://godbolt.org/z/P51j1P3K3" rel="nofollow ugc">https://godbolt.org/z/P51j1P3K3</a></p>
</div>
<ol class="children">
<li id="comment-646291" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-10-07T12:35:37+00:00">October 7, 2022 at 12:35 pm</time></a> </div>
<div class="comment-content">
<p>Try to multiply numbers that cover the full range of values.</p>
</div>
</li>
</ol>
</li>
<li id="comment-653689" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24e043e85528adf57609c0a1d7430ff4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24e043e85528adf57609c0a1d7430ff4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Taras Tsugrii</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-08-09T19:33:23+00:00">August 9, 2023 at 7:33 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for as always insightful article! This technique is mentioned in <code>["Efficient Hash Probes on Modern Processors"][1]</code> but only in passing without a proof, analysis and implementation. I&rsquo;d only suggest emphasizing a little more the fact that it&rsquo;s not an alternative to `&rdquo;x % N&rdquo; as some may assume only to find out that for sequential identifiers with relatively small Ns they are getting 0s in production 🙂</p>
</div>
</li>
</ol>
