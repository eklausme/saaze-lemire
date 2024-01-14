---
date: "2021-04-28 12:00:00"
title: "Ideal divisors: when a division compiles down to just a multiplication"
index: false
---

[15 thoughts on &ldquo;Ideal divisors: when a division compiles down to just a multiplication&rdquo;](/lemire/blog/2021/04-28-ideal-divisors-when-a-division-compiles-down-to-just-a-multiplication)

<ol class="comment-list">
<li id="comment-583003" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b2c28ed0305f51f872a22da153f8dd89?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b2c28ed0305f51f872a22da153f8dd89?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Pete</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-28T18:26:50+00:00">April 28, 2021 at 6:26 pm</time></a> </div>
<div class="comment-content">
<p>Are there similar numbers for 128 and 256-bit unsigned integers? And are these useful in cryptographic contexts? Obviously not as a secret prime, but as something to speed up big-number arithmetic..</p>
</div>
<ol class="children">
<li id="comment-583007" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-28T18:51:24+00:00">April 28, 2021 at 6:51 pm</time></a> </div>
<div class="comment-content">
<p>Yes.</p>
<p>For 128 bits: 59649589127497217 and 5704689200685129054721</p>
<p>For 256 bits: 1238926361552897 and 93461639715357977769163558199606896584051237541638188580280321</p>
</div>
</li>
</ol>
</li>
<li id="comment-583016" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bce6d5fcf91e209532b281fb50b751d1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bce6d5fcf91e209532b281fb50b751d1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jeff</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-28T21:47:51+00:00">April 28, 2021 at 9:47 pm</time></a> </div>
<div class="comment-content">
<p>Over the years I&rsquo;ve noticed that trying to write a lot of numbers to text log can seriously slow down the sections doing the logging. Seems that printf(&ldquo;%d”,&#8230;) is quite the little delay statement. I figure this is down to the the necessity to divide by 10 (with remainder) for every digit thusly printed.</p>
<p>On account of printing human readable numbers, dividing by 10 must be one of the most common divisors encountered. So you&rsquo;d think that CPU designers would give us dedicated optimized divide-by-10 instructions. I&rsquo;ll admit I&rsquo;m pretty out of touch with current instruction sets, but given how doggy printf %d still is, I&rsquo;d guess they haven&rsquo;t.</p>
</div>
<ol class="children">
<li id="comment-583022" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-28T22:47:33+00:00">April 28, 2021 at 10:47 pm</time></a> </div>
<div class="comment-content">
<p>You are right that calls to <tt>printf</tt> are slow. I do not expect that the conversion from integers to strings is what slows you down in such a case.</p>
</div>
</li>
<li id="comment-583089" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">George Spelvin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-29T22:28:21+00:00">April 29, 2021 at 10:28 pm</time></a> </div>
<div class="comment-content">
<p>For some fast decimal-output ideas, have a look at the <a href="https://git.kernel.org/pub/scm/linux/kernel/git/torvalds/linux.git/tree/lib/vsprintf.c#n141" rel="nofollow ugc">Linux kernel binary-to-decimal conversion code</a>. It uses a number of tricks, including smaller constants for restricted ranges and a 200-byte mod-100-to-2-digits lookup table.</p>
</div>
</li>
</ol>
</li>
<li id="comment-583078" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ef8df2187ebb0e7d66510151c17696c0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ef8df2187ebb0e7d66510151c17696c0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">JB</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-29T13:51:39+00:00">April 29, 2021 at 1:51 pm</time></a> </div>
<div class="comment-content">
<p>I think it is worth noting that this is an instance of strength reduction<br/>
(see <a href="https://en.wikipedia.org/wiki/Strength_reduction" rel="nofollow ugc">https://en.wikipedia.org/wiki/Strength_reduction</a> ) and also that compilers really have a cost model to pick when to apply this reduction.</p>
<p>Some HN comments on this post correctly note that the relative cost of division and multiplication varies with time and target architectures.</p>
</div>
</li>
<li id="comment-583108" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">George Spelvin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-30T07:10:15+00:00">April 30, 2021 at 7:10 am</time></a> </div>
<div class="comment-content">
<p>One problem with the direct computation of a remainder is the need for (using the notation of <a href="https://arxiv.org/abs/1902.01961" rel="nofollow ugc">the 2019 paper</a>) a multiplication with an N+L-bit input, where the numerator is N bits long, and the computation needs L guard bits. (<a href="https://arxiv.org/abs/2012.12369" rel="nofollow ugc">arxiv:2012.12369</a> defines N differently.)</p>
<p>This means that the algorithm requires the input range be restricted, Yes, we can hash 48-bit pointers on 64-bit machines, but it would be nice to find something that could handle 64-bit inputs directly.</p>
<p>Unfortunately, just dropping the least significant L bits of the intermediate product fails immediately; just computing n/3 requires L=1, and when n = 1, <code>(n*c&gt;&gt;L) * d &gt;&gt; L</code> returns 0, while 1 % 3 = 1.</p>
<p>Okay, I think, what if I round the division by 2L up? (Adding <code>(1 &lt;&lt; L) - 1</code> before shifting down by L.)</p>
<p>Well, testing with N=16, that fails on 65416%670. L=8, c = 0x61d1, n*c = 0x61a32608, and 0x61=97 is the correct quotient, but 0xa327 * 670 = 0x1ab0012, while the correct remainder is 0x1aa.</p>
<p>But I wonder if it&rsquo;s possible in general to find some additive constant 0 &lt; b &lt; 2L that would work&#8230;</p>
<p>Nope. 65443%670 has n<em>c=0x61ad7713 and requires b &lt;= 0xec, while 16%670 has n</em>c=0x61d10 and requires b &gt;= 0xf0.</p>
</div>
<ol class="children">
<li id="comment-583120" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-30T12:51:56+00:00">April 30, 2021 at 12:51 pm</time></a> </div>
<div class="comment-content">
<p>The number of bits needed is divisor-dependent (as this blog post demonstrate). You are correct that it does not work for all divisors and word sizes. But, at least for compile-time optimizations, it does not need to.</p>
<p>You might enjoy this software implementation:<br/>
<a href="https://github.com/lemire/fast_division" rel="nofollow ugc">https://github.com/lemire/fast_division</a></p>
</div>
<ol class="children">
<li id="comment-583185" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">George Spelvin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-01T20:23:16+00:00">May 1, 2021 at 8:23 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
The number of bits needed is divisor-dependent (as this blog post demonstrate).<br/>
You are correct that it does not work for all divisors and word sizes.
</p></blockquote>
<p>The division technique is more useful because it can usually be done with a multiply-high and a right shift. And even the exceptions can be handled with a small number of additional simple instructions.</p>
<p>I was lamenting that the direct remainder computation technique isn&rsquo;t more useful, because it <em>almost always</em> requires a multiply with an input range wider than the modulo operation it&rsquo;s emulating. I was (foolishly?) hoping someone might be able to find an improvement.</p>
<p>One application I&rsquo;m thinking about is the remainder of a bignum modulo a number of small primes, as the first trial-division step in an isprime() test. This generally starts by choosing a single-word divisor d = p1<em>p2</em>p3*&#8230;, and finding the 1-word remainder, then checking for divisibility by the individual primes.</p>
<p>Each step consists of finding r = (r &lt;&lt; N | limb[i]) % d. N can be chosen to match available operation sizes (64 bits for x86 native divide, 32 bits for emulation via 64-bit multiply), and the primes can be partitioned into divisors d in a variety of ways.</p>
<p>The figure of merit depends on the cost of the remainder and the probability of finding a factor (and therefore obviating future tests). So more smaller divisors can be advantageous if the remainder computation is sped up enough.</p>
</div>
<ol class="children">
<li id="comment-583253" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6e53d27571e5635a6aaf627be49845de?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6e53d27571e5635a6aaf627be49845de?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">MathMan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-03T14:17:06+00:00">May 3, 2021 at 2:17 pm</time></a> </div>
<div class="comment-content">
<p>If you are lamenting about the speed of 64 bit remainder value calculation for bignums then take a look at the paper of E. W. Mayer (arXiv:1303.0328). I did an implementation on Skylake architecture with &lt; 6 cycles per limb of the given bignum.</p>
<p>For the decomposition of a 64-bit remainder divisibility to the individual primes you don&rsquo;t need the reduced remainder value &#8211; just an indicator if it is 0 or not. I think that can be done with one mullo and one comparison (if my math doesn&rsquo;t leave me).</p>
</div>
<ol class="children">
<li id="comment-583266" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">George Spelvin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-03T19:38:16+00:00">May 3, 2021 at 7:38 pm</time></a> </div>
<div class="comment-content">
<p>Ooh, interesting, thank you! Actually, as soon as I heard the title, I said &ldquo;oh, that&rsquo;s right, you probably can&#8230;&rdquo;.</p>
<p>More specifically, when testing for divisibility by multiple primes, I don&rsquo;t need the true remainder r; s = 2kr is fine, as s &equiv; 0 iff r &equiv; 0 (mod p).</p>
<p>If k is fixed, then any tests for particular non-zero values of the remainder can also be simply translated.</p>
</div>
<ol class="children">
<li id="comment-583311" class="comment odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">George Spelvin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-04T14:58:30+00:00">May 4, 2021 at 2:58 pm</time></a> </div>
<div class="comment-content">
<p>BTW, that &ldquo;2kr&rdquo; was supposed to have a superscript k (2^k r), but despite the fact that it&rsquo;s documented that HTML can be used in markdown, &ldquo;2&lt;sup&gt;k&lt;/sup&gt;r&rdquo; renders as &ldquo;2kr&rdquo;.</p>
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
<li id="comment-583156" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-01T07:40:27+00:00">May 1, 2021 at 7:40 am</time></a> </div>
<div class="comment-content">
<p>I think there are still corners to improve on remainder range check optimization on modern compilers. For instance, I found out by brute force that x % 7 &lt; 3 where x is uint8_t can be replaced by (uint16_t)(9363 * x) &lt;= 18906. (Compilers seem to emit a dozen-instruction sequence for this.) Similar solutions can be found for other variations, I did just look for these in brute force.</p>
</div>
<ol class="children">
<li id="comment-583158" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-01T08:50:55+00:00">May 1, 2021 at 8:50 am</time></a> </div>
<div class="comment-content">
<p>&#8230; and with (uint16_t)(9363 * x) &lt; 28087 x can go up to 13109. 9363 is simply ceil(2^16 / 7) and 28087 is round(2^16 * (3/7)). Is there a good reason why such optimizations are not generated? (Of course they should be correct for the whole input range&#8230;)</p>
</div>
<ol class="children">
<li id="comment-583174" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-01T14:44:52+00:00">May 1, 2021 at 2:44 pm</time></a> </div>
<div class="comment-content">
<p>Well, of course it should be 28088 instead of 28087 and 3 * ceil(2^16 / 7). Nonetheless, I&rsquo;m surprised why remainder range check strength reductions with &ldquo;next higher word size&rdquo; aren&rsquo;t implemented on compilers.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
