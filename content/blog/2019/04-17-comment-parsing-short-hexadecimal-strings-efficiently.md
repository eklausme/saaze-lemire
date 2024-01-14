---
date: "2019-04-17 12:00:00"
title: "Parsing short hexadecimal strings efficiently"
index: false
---

[36 thoughts on &ldquo;Parsing short hexadecimal strings efficiently&rdquo;](/lemire/blog/2019/04-17-parsing-short-hexadecimal-strings-efficiently)

<ol class="comment-list">
<li id="comment-402132" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/510bdda8988ed0d4b0ec0b738b4edb73?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/510bdda8988ed0d4b0ec0b738b4edb73?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">MikeD</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-17T18:17:21+00:00">April 17, 2019 at 6:17 pm</time></a> </div>
<div class="comment-content">
<p>How about a super lazy and wasteful method where you make a 4GB lookup table? Of those 4GB only 64KB (the 16^4 possible digits) will ever need to be read and the chunks should be close together that they should get cached. It&rsquo;s silly, but your metric was instruction count 🙂</p>
<p>uint32_t hex_to_u32_lookup(const uint32_t src) {<br/>
return digittoval[src];<br/>
}</p>
</div>
<ol class="children">
<li id="comment-402136" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-17T18:38:32+00:00">April 17, 2019 at 6:38 pm</time></a> </div>
<div class="comment-content">
<p>My metric is not instruction count! However, the mathematical approach generates many more instructions than you&rsquo;d like.</p>
</div>
</li>
</ol>
</li>
<li id="comment-402140" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6d633a9adb678ae58ba053b521b41844?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6d633a9adb678ae58ba053b521b41844?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://llogiq.github.io" class="url" rel="ugc external nofollow">Llogiq</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-17T18:55:17+00:00">April 17, 2019 at 6:55 pm</time></a> </div>
<div class="comment-content">
<p>Might it be possible to pseudo-vectorize this via bit twiddling, thus better amortizing the math operations?</p>
</div>
<ol class="children">
<li id="comment-402147" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-17T19:15:53+00:00">April 17, 2019 at 7:15 pm</time></a> </div>
<div class="comment-content">
<p>Yes, it is, <a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2019/04/17/hexparse.cpp#L73-L83" rel="nofollow">see my code</a>. Unfortunately, the SWAR/vector approach I have (borrowed from Mula) has two downsides. One is that it uses a fancy instruction (pext) to gather the nibbles&#8230; this instruction is famously slow on AMD processors and does not exist on non-x64 processors. The other problem is that it does not check for bad input.</p>
<p>So I get a 15% performance gain, but I trade portability and error checking.</p>
<p>We need to do better.</p>
</div>
</li>
</ol>
</li>
<li id="comment-402174" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8057ede6c5d48f27d9e39f0d3876287b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8057ede6c5d48f27d9e39f0d3876287b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">some dude</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-17T20:47:01+00:00">April 17, 2019 at 8:47 pm</time></a> </div>
<div class="comment-content">
<p>maybe (i &amp; 0xF)+ (i &gt;&gt; 6 &lt;&lt; 3) + (i &gt;&gt; 6) will pipeline better than (c &amp; 0xF) + 9 * (c &gt;&gt; 6),<br/>
swapping out a multiplication for a shift and an addition (assuming i&gt;&gt;6 is pipelined well)</p>
</div>
</li>
<li id="comment-402180" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b8cfd5ec0f88bf5b5f2eedda7d1a0746?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b8cfd5ec0f88bf5b5f2eedda7d1a0746?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.seebs.net/log" class="url" rel="ugc external nofollow">seebs</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-17T21:05:27+00:00">April 17, 2019 at 9:05 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;d be curious about the performance with a 16-bit lookup table, for parsing pairs of hex digits at a time, since nearly all uses of hex lookups are looking them up in pairs anyway. (So, tab[0x3131] = 17)</p>
</div>
</li>
<li id="comment-402188" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a25471bd196c114b2a6ceee2c88677f2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a25471bd196c114b2a6ceee2c88677f2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">216</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-17T21:50:35+00:00">April 17, 2019 at 9:50 pm</time></a> </div>
<div class="comment-content">
<p>no pext or bswap needed if you do this:</p>
<p><code>val = (val &amp; 0xf0f0f0f) + 9 * (val &gt;&gt; 6 &amp; 0x1010101);<br/>
val = (val | val &lt;&lt; 12) &amp; 0xff00ff00;<br/>
return (val&gt;&gt;24 | val) &amp; 0xffff;<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-402196" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a25471bd196c114b2a6ceee2c88677f2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a25471bd196c114b2a6ceee2c88677f2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">216</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-17T22:22:57+00:00">April 17, 2019 at 10:22 pm</time></a> </div>
<div class="comment-content">
<p>Well ok, seems that&rsquo;d be essentially the same as Lee&rsquo;s fast algorithm.. I guess modern x86&rsquo;s are pretty crazy good at optimizing cached memory accesses if it&rsquo;s still losing (despite lack of error-checking).</p>
</div>
<ol class="children">
<li id="comment-402207" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-17T22:54:44+00:00">April 17, 2019 at 10:54 pm</time></a> </div>
<div class="comment-content">
<p>@216 Your approach is more portable but slower than Mula&rsquo;s according my updated benchmarks.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-402197" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/183065534e7fc7f0cd415be71beffc74?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/183065534e7fc7f0cd415be71beffc74?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Zach B</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-17T22:24:11+00:00">April 17, 2019 at 10:24 pm</time></a> </div>
<div class="comment-content">
<p>I know this is for &ldquo;short&rdquo; strings, but since you&rsquo;re interested in SIMD, there are a few published hex SIMD encoders/decoders that you might enjoy:</p>
<p>My version at <a href="https://github.com/zbjornson/fast-hex" rel="nofollow ugc">https://github.com/zbjornson/fast-hex</a><br/>
Peter Cordes&rsquo; methods at <a href="https://stackoverflow.com/questions/53823756/how-to-convert-a-number-to-hex/53823757#53823757" rel="nofollow ugc">https://stackoverflow.com/questions/53823756/how-to-convert-a-number-to-hex/53823757#53823757</a><br/>
Agner Fog&rsquo;s, <a href="https://github.com/darealshinji/vectorclass/blob/master/special/decimal.h#L828" rel="nofollow ugc">https://github.com/darealshinji/vectorclass/blob/master/special/decimal.h#L828</a></p>
</div>
<ol class="children">
<li id="comment-402211" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-17T23:06:31+00:00">April 17, 2019 at 11:06 pm</time></a> </div>
<div class="comment-content">
<p>It looks like Cordes&rsquo; and og&rsquo;s methods convert numbers to hex, whereas we are going the other way.</p>
<p>Your link seems more relevant, and it is certainly interesting but you appear to critically rely on the fact that you have sizeable blocks of hexadecimal numbers (like 32 hex characters in a row). That certainly occurs in cryptography, for example.</p>
<p>Do you check that the input is valid?</p>
</div>
<ol class="children">
<li id="comment-402242" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/183065534e7fc7f0cd415be71beffc74?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/183065534e7fc7f0cd415be71beffc74?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Zach B</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-18T01:13:11+00:00">April 18, 2019 at 1:13 am</time></a> </div>
<div class="comment-content">
<p>You&rsquo;re right, I misremembered there being string-&gt;number procedures in the two later links. My version doesn&rsquo;t check the input characters, no, was just an exercise in encoding/decoding without much practical consideration :).</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-402209" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2fb1d0febf487a1d0b6ece2ff02affaa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2fb1d0febf487a1d0b6ece2ff02affaa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christopher Chang</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-17T22:57:44+00:00">April 17, 2019 at 10:57 pm</time></a> </div>
<div class="comment-content">
<p>No love for _mm_packs_epi16() and _mm256_packs_epi16()? It only applies to length &gt;= 16 and really wants length &gt;= 32, but if you care about the speed of this operation, it&rsquo;s pretty likely you&rsquo;re dealing with such lengths.</p>
<p>Basic idea: there are a bunch of ways to use SIMD operations to replace all &lsquo;0&rsquo;..&rsquo;9&#8242; bytes in a vector with 0..9 byte values, and &lsquo;A&rsquo;..&rsquo;F&rsquo;/&rsquo;a&rsquo;..&rsquo;f&rsquo; bytes with 10..15 byte values. From there,</p>
<p>(&ldquo;m8&rdquo; is assumed to have even bytes initialized to 0, and odd bytes to 0xff. &ldquo;base16_vec&rdquo; is the result of the aforementioned preprocessing step.)</p>
<p><code>// Copy the low bits of byte 1, 3, 5, ... to the high bits of byte 0, 2, 4, ... so that the even positions have the final values of interest.<br/>
base16_vec = _mm_or_si128(base16_vec, _mm_srli_epi64(base16_vec, 4));<br/>
// Mask out odd bytes.<br/>
__m128i prepack0 = _mm_and_si128(base16_vec, m8);<br/>
// Gather and pack even bytes. This can also be done with _mm_shuffle_epi8.<br/>
// prepack1 corresponds to another 16 bytes of the input. If they don't exist, you can put an arbitrary second argument, and then store just the bottom 8 bytes of the result.<br/>
__m128i packed = _mm_packs_epi16(prepack0, prepack1);<br/>
_mm_storeu_si128(target, packed);<br/>
</code></p>
<p>Throw a _mm256_permute4x64_epi64(&#8230;, 0xd8) in the middle to make the AVX2 version of this work, since both _mm256_packs_epi16() and _mm256_shuffle_epi8() handle each lane separately.</p>
</div>
<ol class="children">
<li id="comment-402210" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2fb1d0febf487a1d0b6ece2ff02affaa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2fb1d0febf487a1d0b6ece2ff02affaa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christopher Chang</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-17T23:06:22+00:00">April 17, 2019 at 11:06 pm</time></a> </div>
<div class="comment-content">
<p>Oops, just noticed the &ldquo;short&rdquo; part of the title, so I guess the code above isn&rsquo;t so relevant here.</p>
</div>
</li>
<li id="comment-402213" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-17T23:09:54+00:00">April 17, 2019 at 11:09 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>there are a bunch of ways to use SIMD operations to replace all ‘0’..’9′ bytes in a vector with 0..9 byte values, and ‘A’..’F’/’a’..’f’ bytes with 10..15 byte values</p>
</blockquote>
<p>I think that the efficiency of this part in particular is important&#8230; and, for extra points, whether you can also detect bad inputs in the process.</p>
</div>
</li>
</ol>
</li>
<li id="comment-402219" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2f4c567fa22e1d1949be12e161fcab5b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2f4c567fa22e1d1949be12e161fcab5b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">aqrit</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-17T23:44:34+00:00">April 17, 2019 at 11:44 pm</time></a> </div>
<div class="comment-content">
<p>uint32_t hex_to_u32_test(const uint8_t *src) {<br/>
uint32_t in;<br/>
uint64_t v, x;<br/>
const int64_t magic = INT64_C(0x1001001000000000);<br/>
memcpy(&amp;in, src, 4);<br/>
v = in;<br/>
x = (((0x00404040 &amp; v) &gt;&gt; 6) * 9) + (v &amp; 0x000F0F0F); // do 3<br/>
x = (((uint64_t)((int64_t)x * magic)) &gt;&gt; 48) &amp; ~15; // bswap and pack<br/>
v = ((v &gt;&gt; 30) * 9) + ((v &gt;&gt; 24) &amp; 0x0F); // do the 4th<br/>
return (x | v);<br/>
}</p>
<p>Experiment: replace <code>pext</code> with <code>multiply/shift</code><br/>
The benchmark is returning strange numbers on my pc&#8230;</p>
</div>
<ol class="children">
<li id="comment-402221" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-17T23:55:25+00:00">April 17, 2019 at 11:55 pm</time></a> </div>
<div class="comment-content">
<p>It is nice because you get rid of pext. The net result is slower but more portable.</p>
</div>
</li>
</ol>
</li>
<li id="comment-402423" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c66880ca4a955efc70226ab4bc293890?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c66880ca4a955efc70226ab4bc293890?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">dabble</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-18T12:54:41+00:00">April 18, 2019 at 12:54 pm</time></a> </div>
<div class="comment-content">
<p>According to your benchmarking code, looking up 2 digits at a time is faster without affecting cache misses on average.</p>
<p><code> uint32_t lookup2[65536];</p>
<p> void init_lookup2() {</p>
<p> for (int i = 0; i &lt; 0x10000; i++) {<br/>
lookup2[i] = (uint32_t) -1;<br/>
}</p>
<p> for (int i = 0; i &lt; 256; i++) {<br/>
char digits[3];<br/>
sprintf(digits, "%02x", i);</p>
<p> uint16_t lvalue;<br/>
memcpy(&amp;lvalue, digits, 2);<br/>
lookup2[lvalue] = i;</p>
<p> char digits_upper[3];<br/>
digits_upper[0] = toupper(digits[0]);<br/>
digits_upper[1] = toupper(digits[1]);<br/>
digits_upper[2] = 0;</p>
<p> if ((digits_upper[0] != digits[0]) ||<br/>
(digits_upper[1] != digits[1])) {</p>
<p> memcpy(&amp;lvalue, digits_upper, 2);<br/>
lookup2[lvalue] = i;<br/>
}<br/>
}<br/>
}</p>
<p> uint32_t hex_2bytes_lookup(const uint8_t *src) {<br/>
uint32_t v1 = lookup2[((uint16_t*) src)[0]];<br/>
uint32_t v2 = lookup2[((uint16_t*) src)[1]];<br/>
return v1 &lt;&lt; 8 | v2;<br/>
}<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-402462" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-18T16:13:54+00:00">April 18, 2019 at 4:13 pm</time></a> </div>
<div class="comment-content">
<p>I have added it to my benchmark and you are correct. It is really fast.</p>
</div>
</li>
</ol>
</li>
<li id="comment-402438" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a25ee55957c0e6a174f0d377078a06c8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a25ee55957c0e6a174f0d377078a06c8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Philipp</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-18T14:20:43+00:00">April 18, 2019 at 2:20 pm</time></a> </div>
<div class="comment-content">
<p>Is there a specific reason for not using -O3 ?</p>
<p>Compared to -O2, -O3 leads to &ldquo;math&rdquo; being the most efficient approach with 2.63 cycles per 4-character hex string (&ldquo;lookup&rdquo;: 3.51) and an instruction count of 13.3 (lookup: 14.3) on a skylake cpu.</p>
<p>Interestingly, modifying the line (&ldquo;lookup&rdquo; approach):</p>
<p><code>return static_cast&lt;uint32_t&gt;(v1 &lt;&lt; 12 | v2 &lt;&lt; 8 | v3 &lt;&lt; 4 | v4);<br/>
</code></p>
<p>to</p>
<p><code>return static_cast&lt;uint32_t&gt;(v1 *16*16*16 + v2 *16*16 + v3 *16 + v4);<br/>
</code></p>
<p>while using -O2 + -fpredictive-commoning (part of -O3) leads to this customized &ldquo;lookup&rdquo; being the best approach having ~10% reduced cycle count [and ~25% reduced cache misses with -O3]. I wasn&rsquo;t expecting that!</p>
</div>
<ol class="children">
<li id="comment-402461" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-18T16:13:30+00:00">April 18, 2019 at 4:13 pm</time></a> </div>
<div class="comment-content">
<p><em>Is there a specific reason for not using -O3 ? Compared to -O2, -O3 leads to “math” being the most efficient approach with 2.63 cycles per 4-character hex string (“lookup”: 3.51) and an instruction count of 13.3 (lookup: 14.3) on a skylake cpu.</em></p>
<p>On GCC, -O3 enables autovectorization which is likely able to totally defeat the benchmark. I have switched the flags to -O3, but I have added function attributes to prevent function inlining (to ensure that each 4-char is processed) and there is no change.</p>
</div>
</li>
</ol>
</li>
<li id="comment-402620" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">degski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-19T14:02:19+00:00">April 19, 2019 at 2:02 pm</time></a> </div>
<div class="comment-content">
<p>I cannot run your benchmark-code (on Windows), but this is an option (maybe):</p>
<p>include &lt;frozen/unordered_map.h&gt;</p>
<p>int main ( ) {</p>
<p><code>constexpr frozen::unordered_map&lt;char, char, 22&gt; lookup {<br/>
{ '0', 0 },<br/>
{ '1', 1 },<br/>
{ '2', 2 },<br/>
{ '3', 3 },<br/>
{ '4', 4 },<br/>
{ '5', 5 },<br/>
{ '6', 6 },<br/>
{ '7', 7 },<br/>
{ '8', 8 },<br/>
{ '9', 9 },<br/>
{ 'a', 10 },<br/>
{ 'b', 11 },<br/>
{ 'c', 12 },<br/>
{ 'd', 13 },<br/>
{ 'e', 14 },<br/>
{ 'f', 15 },<br/>
{ 'A', 10 },<br/>
{ 'B', 11 },<br/>
{ 'C', 12 },<br/>
{ 'D', 13 },<br/>
{ 'E', 14 },<br/>
{ 'F', 15 }<br/>
};</p>
<p>std::cout &lt;&lt; ( int ) lookup.at ( 'A' ) &lt;&lt; nl;</p>
<p>return EXIT_SUCCESS;<br/>
</code></p>
<p>}</p>
<p><a href="https://github.com/serge-sans-paille/frozen" rel="nofollow ugc">https://github.com/serge-sans-paille/frozen</a></p>
</div>
<ol class="children">
<li id="comment-402622" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">degski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-19T14:26:46+00:00">April 19, 2019 at 2:26 pm</time></a> </div>
<div class="comment-content">
<p>Swapping out the frozen::unordered_map (size 1088 bytes) for a frozen::map (size 45 bytes) possibly improves things due to better locality.</p>
<p>include &lt;frozen/map.h&gt;</p>
<p>int main ( ) {</p>
<p><code>alignas ( 64 ) constexpr frozen::map&lt;char, char, 22&gt; lookup {<br/>
{ '0', 0 },<br/>
{ '1', 1 },<br/>
{ '2', 2 },<br/>
{ '3', 3 },<br/>
{ '4', 4 },<br/>
{ '5', 5 },<br/>
{ '6', 6 },<br/>
{ '7', 7 },<br/>
{ '8', 8 },<br/>
{ '9', 9 },<br/>
{ 'a', 10 },<br/>
{ 'b', 11 },<br/>
{ 'c', 12 },<br/>
{ 'd', 13 },<br/>
{ 'e', 14 },<br/>
{ 'f', 15 },<br/>
{ 'A', 10 },<br/>
{ 'B', 11 },<br/>
{ 'C', 12 },<br/>
{ 'D', 13 },<br/>
{ 'E', 14 },<br/>
{ 'F', 15 }<br/>
};</p>
<p>std::cout &lt;&lt; ( int ) lookup.at ( 'A' ) &lt;&lt; nl;</p>
<p>std::cout &lt;&lt; sizeof ( frozen::map&lt;char, char, 22&gt; ) &lt;&lt; nl;</p>
<p>return EXIT_SUCCESS;<br/>
</code></p>
<p>}</p>
</div>
<ol class="children">
<li id="comment-402636" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-19T16:23:51+00:00">April 19, 2019 at 4:23 pm</time></a> </div>
<div class="comment-content">
<p>I have implemented and benchmarked your &lsquo;frozen&rsquo; proposal. See my README.</p>
<p><a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/04/17" rel="nofollow ugc">https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/04/17</a></p>
<p>The numbers are not good.</p>
</div>
<ol class="children">
<li id="comment-402752" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">degski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-20T05:23:31+00:00">April 20, 2019 at 5:23 am</time></a> </div>
<div class="comment-content">
<p>Thanks for adding those two!</p>
<p>Does indeed not look good at all [I wasn&rsquo;t expecting anything stellar, but still]. Interesting and food for thought! The unordered_map is faster, branch misses seem to be the culprit of it all. What&rsquo;s going on with a 45 bytes map?</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-402686" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/10e954ded216db8b956ffc9b12e39dee?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/10e954ded216db8b956ffc9b12e39dee?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/mayeut" class="url" rel="ugc external nofollow">mayeut</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-19T21:45:13+00:00">April 19, 2019 at 9:45 pm</time></a> </div>
<div class="comment-content">
<p>Another method used in some base64 decoders uses 4&#215;256 uint32 LUT (4kB) such as in:</p>
<p>Nick Galbreath: <a href="https://github.com/client9/stringencoders/blob/master/src/modp_b64.c#L208" rel="nofollow">client9/stringencoders</a><br/>
Alfred Klomp: <a href="https://github.com/aklomp/base64/blob/master/lib/arch/generic/32/dec_loop.c#L14" rel="nofollow">aklomp/base64</a></p>
<p>That allows to get rid of all shits and have them precomputed. It still has error checking:</p>
<p><code>__attribute__ ((noinline))<br/>
uint32_t hex_to_u32_lookup4x32(const uint8_t *src) {<br/>
uint32_t v1 = digittoval1[src[0]];<br/>
uint32_t v2 = digittoval2[src[1]];<br/>
uint32_t v3 = digittoval3[src[2]];<br/>
uint32_t v4 = digittoval4[src[3]];<br/>
return static_cast&lt;uint32_t&gt;(v1 | v2 | v3 | v4);<br/>
}<br/>
</code></p>
<p>The 4 LUTs can even be &ldquo;compressed&rdquo; a bit by getting rid of redundant &ldquo;-1&rdquo; between LUTS (I guess the compiler/linker should already do it but when one wants to make sure, or have an assembly implementation using the same LUT where we can&rsquo;t rely on compiler/linker to do the job).</p>
<p><code>__attribute__ ((noinline))<br/>
uint32_t hex_to_u32_lookup_mayeut(const uint8_t *src) {<br/>
uint32_t v1 = static_cast&lt;uint32_t&gt;(digittoval32[0 + src[0]]);<br/>
uint32_t v2 = static_cast&lt;uint32_t&gt;(digittoval32[210 + src[1]]);<br/>
uint32_t v3 = static_cast&lt;uint32_t&gt;(digittoval32[420 + src[2]]);<br/>
uint32_t v4 = static_cast&lt;uint32_t&gt;(digittoval32[630 + src[3]]);<br/>
return v1 | v2 | v3 | v4;<br/>
}<br/>
</code></p>
<p>This is as fast as mula&rsquo;s method on my Haswell while still having a checked input.</p>
<p>It&rsquo;s more portable than both mula&rsquo;s method and the big LUT implementation.</p>
<p>Portability of mula&rsquo;s method was already discussed.</p>
<p>Portability of the big LUT: it casts the input uint8_t pointer to an uint16_t pointer which requires a stricter alignment (UBSAN will complain about that on unaligned access). It does not matter on x86/x64 where it&rsquo;s supported and fast but might crash or be dead slow on other architectures when the input is not aligned.</p>
</div>
</li>
<li id="comment-403393" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-24T11:26:38+00:00">April 24, 2019 at 11:26 am</time></a> </div>
<div class="comment-content">
<p>I wonder how rewriting convertone using a conditional move instruction (for example, lea+lea+cmp+cmov) would compare.</p>
<p>More interestingly, I think this could be performed in a vectored fashion even with pre-AVX instructions: couple 8-bit-wide add, cmp* and blend operations. With a 8-bit-wide shuffle and 16-bit-wide madd (all of these are relatively light-weight instructions), one could construct 16-bit parts of the decoded integer in couple extra instructions&#8230;(?)</p>
<p>I might be horribly mistaken as I didn&rsquo;t really try to implement it, but maybe this (four hexadecimal digits to an int) could be accomplished in six vectorized computing instructions plus couple of register moves! Eight hexadecimal digits could maybe accomplished with an additional packssdw.</p>
</div>
<ol class="children">
<li id="comment-403396" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-24T11:40:46+00:00">April 24, 2019 at 11:40 am</time></a> </div>
<div class="comment-content">
<p>OK, case insensitivity probably requires one more and instruction. Nonetheless, vectored version operating essentially on 64-bit wide registers should be roughly of comparable performance with non-vectored variants&#8230; (in theory.)</p>
</div>
</li>
</ol>
</li>
<li id="comment-403413" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-24T15:29:35+00:00">April 24, 2019 at 3:29 pm</time></a> </div>
<div class="comment-content">
<p>The use of -O3 combined with a loop increment of 1 (rather than 4) causes the benchmark to report incorrect data. GCC unrolls the loop by 3x and removes many of the loads (since the same lookups are done 4 times for each byte!) so that there are only 9 loads per 3 iterations instead of the expected 3 * 8 = 24. This significantly overestimates performance, particularly of the inlined variants.</p>
<p>Changing the increment to 4 generates the expected code. Eg. for AArch64:</p>
<p><code>.L281:<br/>
ldrb w5, [x0, 1]<br/>
add x6, x6, 4<br/>
ldrb w1, [x0]<br/>
cmp x19, x6<br/>
ldrb w4, [x0, 2]<br/>
add x0, x0, 4<br/>
ldrb w7, [x0, -1]<br/>
ldrsb w5, [x3, w5, sxtw]<br/>
ldrsb w1, [x3, w1, sxtw]<br/>
ldrsb w4, [x3, w4, sxtw]<br/>
ldrsb w7, [x3, w7, sxtw]<br/>
lsl w5, w5, 8<br/>
orr w1, w5, w1, lsl 12<br/>
orr w4, w7, w4, lsl 4<br/>
orr w1, w1, w4<br/>
add x23, x23, x1<br/>
bhi .L281<br/>
</code></p>
<p>It confirms that the parser loop is load-limited. We can optimize this by reading a word at a time, extract the bytes using masking, and then do the lookup. This way you need at most 5 loads every 4 bytes rather than 8.</p>
</div>
<ol class="children">
<li id="comment-403416" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-24T15:38:10+00:00">April 24, 2019 at 3:38 pm</time></a> </div>
<div class="comment-content">
<p>Thank you. I will modify the benchmark code.</p>
</div>
<ol class="children">
<li id="comment-403475" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-25T00:56:33+00:00">April 25, 2019 at 12:56 am</time></a> </div>
<div class="comment-content">
<p>It starts to make more sense with less difference between the inlined and out-of-line versions (as you&rsquo;d expect). However the inlined big lookup result at 2.6 instructions per 4 bytes is obviously wrong &#8211; it should be 11. I didn&rsquo;t check the rest, but there are more odd results, for example the empty function instruction count/cycles (presumably it was optimized since the function has no side effects).</p>
<p>To be sure the code is as expected you always need to disassemble, especially when it&rsquo;s a benchmark. Compilers are far smarter than most people think, it&rsquo;s typical for benchmark loops to be optimized away!</p>
</div>
<ol class="children">
<li id="comment-403477" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-25T01:15:28+00:00">April 25, 2019 at 1:15 am</time></a> </div>
<div class="comment-content">
<p>(Comment edited.)</p>
<p><em>(&#8230;) for example the empty function instruction count/cycles (presumably it was optimized since the function has no side effects)</em></p>
<p>My belief is that GCC will never optimize away a noinline function, even if it has no side-effect.</p>
<p>(Update: this is wrong due to the -O3 flag but not under the -O2 flag.)</p>
<p><em>it&#039;s typical for benchmark loops to be optimized away</em></p>
<p>I am explicitly using noinline attributes. I have the following comment throughout my source code&#8230;</p>
<p>&gt; &#95;&#95;attribute&#95;&#95;((noinline)) // we do not want the compiler to rewrite the problem<br/>
My expectation is that with GCC, such functions do not get inlined and thus we genuinely benchmark the cost of the function (with additional overhead due to the function call).</p>
<p>I left a couple of inlineable functions, marking them as such for reference. Maybe this is a source of confusion?</p>
<p>I will delete them right away.</p>
</div>
<ol class="children">
<li id="comment-403478" class="comment byuser comment-author-lemire bypostauthor even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-25T01:29:34+00:00">April 25, 2019 at 1:29 am</time></a> </div>
<div class="comment-content">
<p>Interesting. -O3 under GCC seems to allow cheating on the noinline attribute.</p>
<p>I have reverted back to -O2 and put the noinline. And I now check that the compiler is GCC.</p>
<p>I have removed all inlineable functions.</p>
</div>
<ol class="children">
<li id="comment-403728" class="comment odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-26T12:33:26+00:00">April 26, 2019 at 12:33 pm</time></a> </div>
<div class="comment-content">
<p>GCC will always honor the noinline attribute, but that doesn&rsquo;t stop it from optimizing the call out of the loop if it is pure or const. Inline functions are fine but they need to be given real work to do, otherwise the compiler will just remove the loop.</p>
</div>
<ol class="children">
<li id="comment-403730" class="comment byuser comment-author-lemire bypostauthor even depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-26T13:00:16+00:00">April 26, 2019 at 1:00 pm</time></a> </div>
<div class="comment-content">
<p>Looking at the assembly, what seems to be happening is that under -O3, the compiler must figure out that the function is const and thus while it still calls it it can optimize away calls.</p>
<p>You can get around the problem, even under -O3, by actually returning the input itself.</p>
<p>That is, under -O3, it seems that it can optimize away const noinline functions but not all pure functions. Under -O2, it will not optimize away the calls at all.</p>
<blockquote>
<p>Inline functions are fine&#8230;</p>
</blockquote>
<p>It is a typo, right? You meant &ldquo;noinline functions&rdquo;?</p>
<hr/>
<p>Note that this does not affect my actual benchmarks&#8230; the &ldquo;bogus&rdquo; function call was added as a reference but never actually used for anything. I should even remove it.</p>
</div>
<ol class="children">
<li id="comment-403756" class="comment odd alt depth-8">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-26T17:09:31+00:00">April 26, 2019 at 5:09 pm</time></a> </div>
<div class="comment-content">
<p>No I did mean inline. On AArch64 I can build with -O3 -Dnoinline=inline and everything except for &ldquo;bogus&rdquo; function executes as expected. I haven&rsquo;t checked what went wrong with the big lookup previously, but the disassembly for the inlined big lookup seems fine (we could save another 2 instructions if GCC did the address computations more efficiently):</p>
<p><code>.L593:<br/>
add x4, x19, x0<br/>
ldrh w1, [x19, x0]<br/>
add x0, x0, 4<br/>
cmp x21, x0<br/>
ldrh w4, [x4, 2]<br/>
ldr w1, [x3, x1, lsl 2]<br/>
ldr w4, [x3, x4, lsl 2]<br/>
orr w1, w4, w1, lsl 8<br/>
add x20, x20, x1<br/>
bhi .L593<br/>
</code></p>
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
</ol>
