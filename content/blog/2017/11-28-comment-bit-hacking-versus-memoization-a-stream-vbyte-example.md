---
date: "2017-11-28 12:00:00"
title: "Bit hacking versus memoization: a Stream VByte  example"
index: false
---

[8 thoughts on &ldquo;Bit hacking versus memoization: a Stream VByte example&rdquo;](/lemire/blog/2017/11-28-bit-hacking-versus-memoization-a-stream-vbyte-example)

<ol class="comment-list">
<li id="comment-292373" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-28T18:00:30+00:00">November 28, 2017 at 6:00 pm</time></a> </div>
<div class="comment-content">
<p>Mask and add is probably going to win in this situation, but aqrit&rsquo;s comment (on github) made me realize that the codes (and their sums) are small enough to fit into nybbles so that a single shift, or, and mask (&amp;) would get them into place for a multiply to add them all up. He uses an initial multiply to do that, but (x &lt;&lt; 10 | x ) &amp; 0x33033 would do the same.</p>
<p>Multiplies are good when the number of desired shifts and bitwise or/add&#039;s is high, but individual shifts should be considered otherwise. </p>
<p>The other fun thing about multiply is that it can give prefix sum for regularly-spaced small operands, so eg if we have numbers in byte spacing, like 0x04030201, multiplying by 0x01010101 gives 0x0A060301, which is the (little-endian) prefix sum of the bytes. Again, this all relies on zero-padding to keep one byte from carrying into the next, but for small values it&#039;s very handy.</p>
</div>
</li>
<li id="comment-292453" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://github.com/thomasmueller/minperf" class="url" rel="ugc external nofollow">Thomas Mueller</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-30T07:23:59+00:00">November 30, 2017 at 7:23 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m missing the comparison with the various popcnt options, for example the 64-bit variant:</p>
<p> v = Long.bitCount(v &amp; 0x5555555555555555L) +<br/>
(Long.bitCount(v &amp; 0xaaaaaaaaaaaaaaaaL) &lt;&lt; 1);</p>
<p>or the 8-bit variant with one popcnt:</p>
<p> v = Integer.bitCount(((v &lt;&lt; 8) | v) &amp; 0xaaff);</p>
</div>
<ol class="children">
<li id="comment-292467" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-30T15:43:05+00:00">November 30, 2017 at 3:43 pm</time></a> </div>
<div class="comment-content">
<p>Yes. This is nice. I have added it (with credit to you) to the code.</p>
</div>
</li>
</ol>
</li>
<li id="comment-292454" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/thomasmueller/minperf" class="url" rel="ugc external nofollow">Thomas Mueller</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-30T08:47:57+00:00">November 30, 2017 at 8:47 am</time></a> </div>
<div class="comment-content">
<p>Sorry&#8230; the 64-bit variant can be simplified to </p>
<p>v = Long.bitCount(v) + Long.bitCount(v &amp; 0xaaaaaaaaaaaaaaaaL)</p>
</div>
</li>
<li id="comment-292533" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Kurz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-01T20:37:35+00:00">December 1, 2017 at 8:37 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m more positive to the &ldquo;lookup&rdquo; approach than you seem to be. You&rsquo;re right that the &ldquo;batch&rdquo; approach is going to scale better in situations where there is a simple algorithmic transformation from key to value, but a table gives you the flexibility of arbitrary (or changing) mappings with surprisingly good performance. </p>
<p>I think the limitations of the compiled code conceals just how fast the lookups can be. On Skylake, you can sustain 2 lookups per cycle, so if we are loading one byte of input and then doing one table lookup per byte, the &ldquo;actual&rdquo; speed for a table lookup should be closer to 1.0 cycles per byte. </p>
<p>But since we can &ldquo;batch&rdquo; the reading of the input by reading more than one byte at a time and then extracting the individual keys, we can actually get well under 1 cycle per byte (2 table lookups per cycle, plus some smaller overhead for reading and extracting input). </p>
<p>Here&rsquo;s what I see on Skylake for a 4096 byte input:</p>
<p>bitsum_c_loop(input, count): 1.342 (best) 1.346 (avg)<br/>
bitsum_asm_loop(input, count): 1.007 (best) 1.011 (avg)<br/>
bitsum_asm_rotate(input, count): 0.827 (best) 0.839 (avg)<br/>
bitsum_asm_gather(input, count): 0.635 (best) 0.637 (avg)</p>
<p>To be fair, for this case where easy transformations from bit pattern key to lookup value exist, an &ldquo;in-register&rdquo; approach is going to be even faster. If you add &ldquo;-march=native&rdquo; to your compilation options, you can see the start of the effect of vectorization. The 64-bit popcnt() variant should be able to get down to .25 cycles per byte, and the AVX2 popcnt() analogue can go even lower (although I haven&rsquo;t tested these two). </p>
<p>So yes, for this particular problem (and any problem where the transformation is easily vectorized), lookups are probably a dead-end (unless you can make the key substantially wider than 8-bits?) But I&rsquo;m generally more excited by the universality of the gather-based lookup. It&rsquo;s quite fast, easy to understand, and far more flexible. </p>
<p>Here&rsquo;s a though-exercise: In practice, is the L1 cache significantly different from an enormous vector register split into cacheline sized lanes? Some of the slower AVX operations are already slower than he 4 cycle latency to L1, so I don&rsquo;t think it&rsquo;s just a matter of speed.</p>
</div>
</li>
<li id="comment-292605" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2f4c567fa22e1d1949be12e161fcab5b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2f4c567fa22e1d1949be12e161fcab5b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">aqrit</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-03T02:43:28+00:00">December 3, 2017 at 2:43 am</time></a> </div>
<div class="comment-content">
<p>minor improvements:</p>
<p>// batch<br/>
v = ((v &gt;&gt; 2) &amp; 0x33333333) + (v &amp; 0x33333333);<br/>
v = (v + (v &gt;&gt; 4)) &amp; 0x0F0F0F0F;</p>
<p>// Thomas Mueller 8-bit variant<br/>
x = Integer.bitCount(((x &lt;&lt; 8) | (x &amp; 0xAA)));</p>
</div>
<ol class="children">
<li id="comment-377413" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/956e4ba44068f958cb6b47af4a84bebe?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/956e4ba44068f958cb6b47af4a84bebe?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mack</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-31T10:27:10+00:00">December 31, 2018 at 10:27 am</time></a> </div>
<div class="comment-content">
<p>Hi aqrit , did you have a solution work for each 3 bits, example:<br/>
0b101100101101= 0b101+0b100+0b101+0b101=19,<br/>
for above example , how to calculate?</p>
</div>
</li>
</ol>
</li>
<li id="comment-378031" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a5918ca9d2fb7ee42ec22da9ec3d3413?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a5918ca9d2fb7ee42ec22da9ec3d3413?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mack</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-02T02:23:15+00:00">January 2, 2019 at 2:23 am</time></a> </div>
<div class="comment-content">
<p>Hi, how about calculate each 3bits , example :<br/>
0b101100101101=0b101+0100+0101+0101=19,<br/>
any one know how to do?Thanks</p>
</div>
</li>
</ol>
