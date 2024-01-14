---
date: "2020-12-14 12:00:00"
title: "Converting floating-point numbers to integers while preserving order"
index: false
---

[11 thoughts on &ldquo;Converting floating-point numbers to integers while preserving order&rdquo;](/lemire/blog/2020/12-14-converting-floating-point-numbers-to-integers-while-preserving-order)

<ol class="comment-list">
<li id="comment-562110" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">George Spelvin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-15T03:02:08+00:00">December 15, 2020 at 3:02 am</time></a> </div>
<div class="comment-content">
<p>It might be worth mentioning the similar code for <em>signed</em> integers, which seem a more natural target for signed floating-point values:</p>
<p><code>int64_t sign_flip(int64_t x) {<br/>
uint64_t mask = x &gt;&gt; 62; // Or 63, your choice<br/>
return x ^ (mask &gt;&gt; 1);<br/>
}<br/>
</code></p>
<p>Here, you <em>never</em> flip the sign bit, so the mask needs to cover only the low 63 bits.</p>
<p>On most modern machines, shift instructions are smaller and faster than large immediate constants, but there are some processors (particularly synthesizable cores for FPGA implementation) which have slow shifts. In such cases, an alternative is:</p>
<p><code> uint64_t mask = x &amp; ((uint64_t)1 &lt;&lt; 63);<br/>
return x ^ (mask - 1);<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-562205" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-15T18:46:45+00:00">December 15, 2020 at 6:46 pm</time></a> </div>
<div class="comment-content">
<p>Very nice indeed.</p>
</div>
</li>
</ol>
</li>
<li id="comment-562229" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2f4c567fa22e1d1949be12e161fcab5b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2f4c567fa22e1d1949be12e161fcab5b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">aqrit</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-15T21:14:55+00:00">December 15, 2020 at 9:14 pm</time></a> </div>
<div class="comment-content">
<p>Is it possible to compare signed integers with a floating-point compare, or do some bit-patterns not work?</p>
<p>Context: SSE2 has a 64-bit floating-point compare <code>_mm_cmpgt_pd()</code> but has only 32-bit integer compares.</p>
<p>Current work-around:</p>
<p><code>__m128i pcmpgtq_sse2 (__m128i a, __m128i b) {<br/>
__m128i r = _mm_and_si128(_mm_cmpeq_epi32(a, b), _mm_sub_epi64(b, a));<br/>
r = _mm_or_si128(r, _mm_cmpgt_epi32(a, b));<br/>
return _mm_shuffle_epi32(r, _MM_SHUFFLE(3,3,1,1));<br/>
}<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-562241" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/abdc56636d8d76cfb91fe792460c9699?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/abdc56636d8d76cfb91fe792460c9699?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Per Vognsen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-15T23:44:46+00:00">December 15, 2020 at 11:44 pm</time></a> </div>
<div class="comment-content">
<p>There&rsquo;s a simple combinatorial reason you can&rsquo;t express a 64-bit integer comparison, signed or unsigned, with a 64-bit floating-point comparison: some floating-point numbers &ldquo;are the same&rdquo; as far as float comparisons are concerned, notably all the NaN bit patterns, and hence by the pigeonhole principle any mapping from 64-bit ints to 64-bit floats must map some ints to values that won&rsquo;t order correctly.</p>
<p>But if you have 64-bit uints where the two most significant bits are 0 (i.e. values in the range 0 to 2^62), so the float sign is positive and the exponent can&rsquo;t be the all 1s pattern which signifies a NaN, you should be able to load it as a 64-bit float and get isomorphic comparisons. If you want 2&rsquo;s complement signed comparisons this way, I think you&rsquo;d have to do a pre-transform.</p>
</div>
<ol class="children">
<li id="comment-562252" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2f4c567fa22e1d1949be12e161fcab5b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2f4c567fa22e1d1949be12e161fcab5b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">aqrit</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-16T02:11:51+00:00">December 16, 2020 at 2:11 am</time></a> </div>
<div class="comment-content">
<p>Thank You.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-562238" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/772a802341e3848e248626d044dc2493?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/772a802341e3848e248626d044dc2493?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Falk Hüffner</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-15T22:22:54+00:00">December 15, 2020 at 10:22 pm</time></a> </div>
<div class="comment-content">
<p>This can be done with two instructions less:</p>
<p><code>bool generic_comparator(double x1, double x2) {<br/>
uint64_t i0 = to_uint64(x1);<br/>
uint64_t i1 = to_uint64(x2);<br/>
uint64_t mask = uint64_t(int64_t(i0) &gt;&gt; 63);<br/>
mask |= 0x8000000000000000;<br/>
return (i0 ^ mask) &lt; (i1 ^ mask);<br/>
}<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-562242" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-15T23:53:02+00:00">December 15, 2020 at 11:53 pm</time></a> </div>
<div class="comment-content">
<p>Yes, that&rsquo;s credible. Thanks.</p>
</div>
</li>
</ol>
</li>
<li id="comment-586002" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b3b2b3fd0c2dea2fcd401d9c37f31606?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b3b2b3fd0c2dea2fcd401d9c37f31606?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">James Sadler</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-04T02:59:45+00:00">June 4, 2021 at 2:59 am</time></a> </div>
<div class="comment-content">
<p>Thanks for the great post &#8211; this is going to come in very handy!</p>
<p>I assumed the sign_flip function would be reversible by changing the direction of the bit shift. This seems to work for some values, but not quite. Negative values seem to be incorrect by a small amount. It feels like the most insignificant bit is incorrect in the result. Can you see what I&rsquo;m doing wrong here?</p>
<p><code>uint64_t inverse_sign_flip(uint64_t x) {<br/>
// credit http://stereopsis.com/radix.html<br/>
// when the most significant bit is set, we need to<br/>
// flip all bits<br/>
uint64_t mask = uint64_t(int64_t(x) &lt;&lt; 63);<br/>
// in all case, we need to flip the most significant bit<br/>
mask |= 0x8000000000000000;<br/>
return x ^ mask;<br/>
}<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-586075" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-04T12:15:30+00:00">June 4, 2021 at 12:15 pm</time></a> </div>
<div class="comment-content">
<p>Can you elaborate on how you arrive at this inverse function? What is your expectation with respect to what is in the <code>mask</code> variable?</p>
</div>
<ol class="children">
<li id="comment-586185" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b3b2b3fd0c2dea2fcd401d9c37f31606?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b3b2b3fd0c2dea2fcd401d9c37f31606?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">James Sadler</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-05T11:10:39+00:00">June 5, 2021 at 11:10 am</time></a> </div>
<div class="comment-content">
<p>My goal is to implement a function that when passed the return value of sign_flip as its argument it returns the original value.</p>
<p>The following must hold true: i.e. <code>b = sign_flip(a)</code> then <code>a = inverse_sign_flip(b)</code>.</p>
<p>My bit twiddling skills are not my string point, however the above code that I pasted seems to <em>almost</em> work &#8211; the result looks incorrect on the least significant bit.</p>
<p>I wouldn&rsquo;t be able to explain how it worked backwards, but I am surprised the result was so close to being correct for all values I&rsquo;ve thrown at it (-ve, +ve, large and small numbers).</p>
</div>
<ol class="children">
<li id="comment-586201" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-05T13:23:29+00:00">June 5, 2021 at 1:23 pm</time></a> </div>
<div class="comment-content">
<p>I would recommend against doing it with trial and error&#8230;</p>
<p>I have not tested it, but it should be something like that&#8230;</p>
<pre><code>   uint64_t mask = uint64_t(int64_t(x ^ 0x8000000000000000) &gt;&gt; 63);    
   mask |= 0x8000000000000000;    
   return x ^ mask;
</code></pre>
<p>Basically, you can recover the most significant bit by flipping it. It if is 1, you need to flip all bits&#8230; if it is 0, you need to flip just the most significant bit. I think that the code above does that&#8230; but I am not sure, you should check.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
