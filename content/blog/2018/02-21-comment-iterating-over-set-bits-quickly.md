---
date: "2018-02-21 12:00:00"
title: "Iterating over set bits quickly"
index: false
---

[18 thoughts on &ldquo;Iterating over set bits quickly&rdquo;](/lemire/blog/2018/02-21-iterating-over-set-bits-quickly)

<ol class="comment-list">
<li id="comment-297144" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a24eac6bd28238052223a548765823c9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a24eac6bd28238052223a548765823c9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">D.I.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-02-21T12:27:32+00:00">February 21, 2018 at 12:27 pm</time></a> </div>
<div class="comment-content">
<p>Instead of</p>
<p><code> uint64_t t = bitset &amp; -bitset;<br/>
bitset ^= t;<br/>
</code></p>
<p>should also be possible</p>
<p><code>bitset -= ((uint64_t)1) &lt;&lt; r;<br/>
</code></p>
<p>I should admit that while there are only two operations here, the performance on a particular platform/compiler may depend and is yet to be tested&#8230; 🙂</p>
</div>
<ol class="children">
<li id="comment-297187" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1cd46a26ceada395ae900bd4cd40a052?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1cd46a26ceada395ae900bd4cd40a052?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://fulmicoton.com" class="url" rel="ugc external nofollow">Paul Masurel</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-02-22T01:37:45+00:00">February 22, 2018 at 1:37 am</time></a> </div>
<div class="comment-content">
<p>I think bitset ^= ((uint64_t)1) &lt;&lt; r is better than -=, but otherwise, that&rsquo;s how it is is implemented in tantivy.</p>
<p>Just benched it against the x &amp; -x trick. For a density of 1% over a bitset of 1M capacity, they are very close (around 15ns per elements on my laptop).</p>
<p>(bitset ^= 1u64 &lt;&lt; r) was maybe a notch faster.</p>
</div>
<ol class="children">
<li id="comment-297321" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-02-24T04:54:00+00:00">February 24, 2018 at 4:54 am</time></a> </div>
<div class="comment-content">
<p>Using the variable shift is probably generates worse code in all cases on x86, although you might get a tie in benchmarking due to the overhead of callback() dominating. Before BMI (Haswell) variables shifts are somewhat slow (needing 3 uops), although they are better with BMI (shlx and friends) &#8211; but with BMI the whole two lines:</p>
<p><code>uint64_t t = bitset &amp; -bitset;<br/>
bitset ^= t;<br/>
</code></p>
<p>end up as a single BLSR instruction on compilers that recognize it. It would have been simpler to write the two lines above as the single line:</p>
<p><code>bitset = bitset &amp; (bitset - 1);<br/>
</code></p>
<p>Which is the usual idiom for &ldquo;clearing the lowest bit&rdquo; &#8211; although gcc was smart enough to compile both to the same form (and you don&rsquo;t need the temporary and all that).</p>
</div>
<ol class="children">
<li id="comment-298123" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1cd46a26ceada395ae900bd4cd40a052?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1cd46a26ceada395ae900bd4cd40a052?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Paul Masurel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-09T03:49:45+00:00">March 9, 2018 at 3:49 am</time></a> </div>
<div class="comment-content">
<p>Thanks for the explanation!</p>
<p>I implemented both in Rust, and I am unsure the generated code ended up using a BLSR instruction. I&rsquo;ll investigate what happened there.</p>
<p>The work done in my bench is small and inlinable so I am not too worried about the callback cost.</p>
</div>
<ol class="children">
<li id="comment-298190" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1cd46a26ceada395ae900bd4cd40a052?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1cd46a26ceada395ae900bd4cd40a052?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Paul Masurel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-10T06:16:34+00:00">March 10, 2018 at 6:16 am</time></a> </div>
<div class="comment-content">
<p>I had a look at the assembly code. Both version compile to the same assembly. BLSR is indeed used.</p>
<p>Link to godbolt:<br/>
<a href="https://godbolt.org/g/sT24rm" rel="nofollow ugc">https://godbolt.org/g/sT24rm</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-584312" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d198c433c7b4990d0aacab446b1e67fb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d198c433c7b4990d0aacab446b1e67fb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://blog.snowfrogdev.com" class="url" rel="ugc external nofollow">Philippe Vaillancourt</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-17T13:40:25+00:00">May 17, 2021 at 1:40 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for this. Whether it is faster or not, it&rsquo;s still worth mentioning this alternative because I believe in some languages, like C#, while you can do</p>
<p><code>long t = bitset &amp; -bitset;<br/>
</code></p>
<p>it won&rsquo;t let you do</p>
<p><code>ulong t = bitset &amp; -bitset;<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-584318" class="comment byuser comment-author-lemire bypostauthor even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-17T15:20:26+00:00">May 17, 2021 at 3:20 pm</time></a> </div>
<div class="comment-content">
<p>I would be surprised if</p>
<pre><code>ulong t = bitset &amp; -bitset;
</code></pre>
<p>could not be achieved with something</p>
<pre><code>ulong t = bitset &amp; (0-bitset);
</code></pre>
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
<li id="comment-297149" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1a5d5efe652c6001692435e4a578c6df?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1a5d5efe652c6001692435e4a578c6df?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://deadpelican.com" class="url" rel="ugc external nofollow">nixo</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-02-21T14:04:47+00:00">February 21, 2018 at 2:04 pm</time></a> </div>
<div class="comment-content">
<p>Depends on your use case. There&rsquo;s some sets of data that tend to group whatever the bits represent to be all the same.</p>
<p>So you may find that there are situations where comparing to 0 or 0xFFFFFFFF tells you right away that the next 64 bits are all the same.</p>
<p>Can&rsquo;t wait for 128 bit processors, this will work even faster.</p>
<p>There are optimizations to be had everywhere.</p>
</div>
</li>
<li id="comment-297153" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8a20b6c052e6178c98b8026c28fb75cc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8a20b6c052e6178c98b8026c28fb75cc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Vitaly</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-02-21T15:15:59+00:00">February 21, 2018 at 3:15 pm</time></a> </div>
<div class="comment-content">
<p>Did you start blocking Russian IPs by any chance, or is it me moving to Russia from the Netherlands? I know for a fact LinkedIn is blocked in Russia, but I wonder why would anyone want to block this blog :/</p>
</div>
<ol class="children">
<li id="comment-297170" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-02-21T21:01:50+00:00">February 21, 2018 at 9:01 pm</time></a> </div>
<div class="comment-content">
<p>I am not blocking anyone, but it is possible that my blog is blocked in some countries. My blog was blocked in China and South Korea some years ago.</p>
<p>I am unsure why anyone would block my blog. I am just a computer scientist.</p>
</div>
<ol class="children">
<li id="comment-297197" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8a20b6c052e6178c98b8026c28fb75cc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8a20b6c052e6178c98b8026c28fb75cc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Vitaly</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-02-22T08:13:12+00:00">February 22, 2018 at 8:13 am</time></a> </div>
<div class="comment-content">
<p>My exact thoughts, just wanted to confirm. Thank you for your reply.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-297160" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4bafdfdb4a8ff3e836171de1f7030233?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4bafdfdb4a8ff3e836171de1f7030233?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Roman Leventov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-02-21T18:50:00+00:00">February 21, 2018 at 6:50 pm</time></a> </div>
<div class="comment-content">
<p>The difference is so bit that it&rsquo;s hard to believe in those results. Did you test those routines functionally?</p>
<p>There is one other way to write this loop:</p>
<blockquote><p>
<code>int r = 0;<br/>
while (bitset != 0) {<br/>
int zeros = __builtin_ctzl(bitset);<br/>
r += zeros;<br/>
callback(k * 64 + r);<br/>
r += 1;<br/>
bitset &gt;&gt;= zeros + 1;<br/>
}<br/>
</code>
</p></blockquote>
</div>
<ol class="children">
<li id="comment-297166" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-02-21T20:18:43+00:00">February 21, 2018 at 8:18 pm</time></a> </div>
<div class="comment-content">
<p>What happens in your code when <tt>zeros</tt> is 63? You could add a branch to check if bitset is equal to 1&lt;&lt;63. Since this will almost never happen, the branch is going to be free (and you only need one branch per word).</p>
<p><em>The difference is so bit that it&rsquo;s hard to believe in those results. Did you test those routines functionally?</em></p>
<p>The fast version (ctz) has been benchmarked thoroughly and is in production code.</p>
<p>The other version was proposed by Wojciech. It is my first time benchmarking it.</p>
<p>I offer my source code, it is quite short, so you should be able to check whether I made a mistake or whether my results are robust. I encourage re-examination of my results. Please prove me wrong!</p>
<p>This code is sensitive to branch prediction so your results will vary depending on the data. I used random data with uniform density. You should expect slower processing with realistic data having non-uniform density.</p>
</div>
<ol class="children">
<li id="comment-297306" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4bafdfdb4a8ff3e836171de1f7030233?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4bafdfdb4a8ff3e836171de1f7030233?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Roman Leventov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-02-23T23:40:20+00:00">February 23, 2018 at 11:40 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
What happens in your code when zeros is 63? You could add a branch to<br/>
check if bitset is equal to 1&lt;&lt;63. Since this will almost never<br/>
happen, the branch is going to be free (and you only need one branch<br/>
per word).
</p></blockquote>
<p>Or, it could be split into two instructions: bitset &gt;&gt;= zeros; bitset &gt;&gt;= 1. I think the previous three operations, especially callback (if it&rsquo;s something non-trivial) have enough data parallelism to perform this extra operation with the same overall thoughput.</p>
<blockquote><p>
The fast version (ctz) has been benchmarked thoroughly and is in production code.
</p></blockquote>
<p>Another option is that the inferior alternative works worse than it could.</p>
</div>
</li>
</ol>
</li>
<li id="comment-297316" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-02-24T03:13:00+00:00">February 24, 2018 at 3:13 am</time></a> </div>
<div class="comment-content">
<p>These results are not at all hard to believe and in fact you can ballpark from the results from first principles: consider that the naive approach will take a branch misprediction on at least every set bit, which bounds its performance from above at about 20 cycles per set bit. When the density gets lower it also wastes a lot of time examining every unset bit.</p>
<p>The ctz approach never examines unset bits and just jumps immediately to the next set bit, and only involves about 4 instructions per bit (plus the callback overhead). For really dense bitmaps you can get close to 1 cycle per int!</p>
<p>The main cost as density gets lower is branch prediction on the inner (bitmap != 0) loop: you&rsquo;ll almost always mispredict the exit iteration and you can pretty much model the performance exactly as 1 mispredict divided by the average number of set bits in a 64-bit bitmap (until density gets so low that most bitmaps are zero: then you approach 1 mispredict per set bit).</p>
<p>You can play some tricks to avoid the mispredicts, such as conditional moves rather than nested loops &#8211; but it&rsquo;s all highly dependent on the bit frequency and typical patterns. I settled on using various strategies, branching and not, depending on the frequency.</p>
</div>
</li>
</ol>
</li>
<li id="comment-297167" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f38a8dc91f316cac1f78e64de271e215?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f38a8dc91f316cac1f78e64de271e215?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/powturbo" class="url" rel="ugc external nofollow">powturbo</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-02-21T20:48:44+00:00">February 21, 2018 at 8:48 pm</time></a> </div>
<div class="comment-content">
<p>The fastest way is to use the expand instructions (ex. _mm256_maskz_expand_epi32) on AVX-512 or a shuffle/permute table for SSE/AVX2 and process mutiple (4/8/16) integers at a time with SIMD. This technique is used in the TurboPFor (<a href="https://github.com/powturbo/TurboPFor" rel="nofollow ugc">https://github.com/powturbo/TurboPFor</a>) package.</p>
</div>
<ol class="children">
<li id="comment-297169" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-02-21T20:56:05+00:00">February 21, 2018 at 8:56 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for your comment. I got so-so results in the past from similar vectorized code (some of which was written by Nathan Kurz), but I think I will make a blog post out of it. Crediting you of course, as needed.</p>
</div>
</li>
</ol>
</li>
<li id="comment-297904" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2fb1d0febf487a1d0b6ece2ff02affaa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2fb1d0febf487a1d0b6ece2ff02affaa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christopher Chang</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-05T17:48:46+00:00">March 5, 2018 at 5:48 pm</time></a> </div>
<div class="comment-content">
<p>I have hundreds of loops of the following form in my code:</p>
<p><code>uint32_t variant_uidx = 0;<br/>
// Iterate over all variant_ct set bits in variant_include, which is a bitmap of type const uintptr_t*.<br/>
for (uint32_t variant_idx = 0; variant_idx &lt; variant_ct; ++variant_idx, ++variant_uidx) {<br/>
if (!IsSet(variant_include, variant_uidx)) {<br/>
variant_uidx = FindFirst1BitFrom(variant_include, variant_uidx);<br/>
}<br/>
// ...do stuff...<br/>
}<br/>
</code></p>
<p>IsSet() and FindFirst1BitFrom() are currently defined on Linux and OS X as follows:</p>
<p><code>inline uintptr_t IsSet(const uintptr_t* bitarr, uintptr_t idx) {<br/>
return (bitarr[idx / kBitsPerWord] &gt;&gt; (idx % kBitsPerWord)) &amp; 1;<br/>
}</p>
<p>uintptr_t FindFirst1BitFrom(const uintptr_t* bitarr, uintptr_t loc) {<br/>
const uintptr_t* bitarr_iter = &amp;(bitarr[loc / kBitsPerWord]);<br/>
uintptr_t ulii = (*bitarr_iter) &gt;&gt; (loc % kBitsPerWord);<br/>
if (ulii) {<br/>
return loc + __builtin_ctzl(ulii);<br/>
}<br/>
do {<br/>
ulii = *(++bitarr_iter);<br/>
} while (!ulii);<br/>
return static_cast&lt;uintptr_t&gt;(bitarr_iter - bitarr) * kBitsPerWord + __builtin_ctzl(ulii);<br/>
}<br/>
</code></p>
<p>I&rsquo;ve been pretty happy with the performance of this idiom in both the common all-bits-are-1 case and the sparse case, but if you can find a better approach I&rsquo;m all ears.</p>
</div>
</li>
</ol>
