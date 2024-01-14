---
date: "2018-05-16 12:00:00"
title: "Validating UTF-8 strings using as little as 0.7 cycles per byte"
index: false
---

[16 thoughts on &ldquo;Validating UTF-8 strings using as little as 0.7 cycles per byte&rdquo;](/lemire/blog/2018/05-16-validating-utf-8-strings-using-as-little-as-0-7-cycles-per-byte)

<ol class="comment-list">
<li id="comment-303726" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-16T16:17:47+00:00">May 16, 2018 at 4:17 pm</time></a> </div>
<div class="comment-content">
<p>The counter-rolling can actually be done logarithmically by shifting 1,2,4, etc., eg:</p>
<p>[4,0,0,0] + ([0,4,0,0]-[1,1,1,1]) = [4,3,0,0]</p>
<p>[4,3,0,0] + ([0,0,4,3]-[2,2,2,2]) = [4,3,2,1]</p>
<p>but in this case the distances didn&rsquo;t seem big enough to beat the linear method.</p>
<p>The distances can even be larger than the register size I believe if the last value in the register is carried over to the first element of the next. It&rsquo;s a good way to delineate inline variable-length encodings.</p>
</div>
<ol class="children">
<li id="comment-303887" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-17T19:29:17+00:00">May 17, 2018 at 7:29 pm</time></a> </div>
<div class="comment-content">
<p>We just merged a PR with this, and it is indeed faster.</p>
</div>
</li>
</ol>
</li>
<li id="comment-303742" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2fb1d0febf487a1d0b6ece2ff02affaa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2fb1d0febf487a1d0b6ece2ff02affaa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christopher Chang</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-16T18:47:54+00:00">May 16, 2018 at 6:47 pm</time></a> </div>
<div class="comment-content">
<p>For more fun, combine the _mm{256}_movemask_epi8() intrinsic, which lets you rapidly seek to the next non-ASCII character when there is one or validate that there aren&rsquo;t any, with unaligned loads.</p>
</div>
<ol class="children">
<li id="comment-303744" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2fb1d0febf487a1d0b6ece2ff02affaa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2fb1d0febf487a1d0b6ece2ff02affaa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christopher Chang</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-16T18:56:16+00:00">May 16, 2018 at 6:56 pm</time></a> </div>
<div class="comment-content">
<p>(on second thought, might be better to stick to aligned loads, less special-case code for the end of the string may be a bigger deal than special-case code for a UTF-8 code point that crosses a vector boundary.)</p>
</div>
</li>
<li id="comment-303748" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-16T19:36:39+00:00">May 16, 2018 at 7:36 pm</time></a> </div>
<div class="comment-content">
<p>I have something similar to that in my version &#8212; I look for counters that go off the end, and do the next unaligned load at the start of that character instead of carrying intermediate state over. Lemire found an elegant way of shifting in the needed bytes from the previous block with _mm_alignr_epi8 which is likely faster and keeps the 16-byte stride.</p>
<p>There&rsquo;s also a slight rewrite I did to examine all 5 bits in the initials; it turns out that splitting into ascii/non-ascii on the high bit, and then doing the mapping on the next 4 bits of the non-ascii chars allows us to cover all 5 bits correctly <em>and</em> do the all-ascii shortcut based on movemask. I&rsquo;ll see if I can check this into the repo.</p>
</div>
</li>
</ol>
</li>
<li id="comment-303811" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f6202f093efd33cb66565170a55b4d8d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f6202f093efd33cb66565170a55b4d8d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Claude</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-17T08:06:45+00:00">May 17, 2018 at 8:06 am</time></a> </div>
<div class="comment-content">
<p>et pourquoi pas:</p>
<p>size_t fast_validate_ascii(unsigned char* src, long len) {<br/>
__m128i minusbyte = _mm_set1_epi8(0x80);<br/>
__m128i current_bytes = _mm_setzero_si128();</p>
<p><code>size_t i = 0;<br/>
for (; i + 15 &lt; len; i += 16) {<br/>
//we load our section, the length should be larger than 16<br/>
current_bytes = _mm_loadu_si128((const __m128i *)(src + i));<br/>
if (!_mm_testz_si128(minusbyte, current_bytes))<br/>
return i;<br/>
}</p>
<p>// last part<br/>
if (i &lt; len) {<br/>
char buffer[16];<br/>
memset(buffer, 0, 16);<br/>
memcpy(buffer, src + i, len - i);<br/>
current_bytes = _mm_loadu_si128((const __m128i *)buffer);<br/>
if (!_mm_testz_si128(minusbyte, current_bytes))<br/>
return i;<br/>
}</p>
<p>return -1;<br/>
</code></p>
<p>}<br/>
On teste directement le bit de signe pour chaque octet. Si tous les caractÃ¨res sont en ascii on renvoie -1, sinon, on renvoie la position Ã  partir de laquelle, on sait que dans une zone de 16 caractÃ¨res se cache peut-Ãªtre un UTF8.</p>
</div>
</li>
<li id="comment-303815" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f6202f093efd33cb66565170a55b4d8d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f6202f093efd33cb66565170a55b4d8d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Claude</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-17T08:37:09+00:00">May 17, 2018 at 8:37 am</time></a> </div>
<div class="comment-content">
<p>oups&#8230; I forgot that on certain platforms, size_t is unsigned&#8230;</p>
<p>long fast_validate_ascii(unsigned char* src, long len) {<br/>
__m128i minusbyte = _mm_set1_epi8(0x80);<br/>
__m128i current_bytes = _mm_setzero_si128();</p>
<p>long i = 0;<br/>
for (; i + 15 &lt; len; i += 16) {<br/>
//we load our section, the length should be larger than 16<br/>
current_bytes = _mm_loadu_si128((const __m128i *)(src + i));<br/>
if (!_mm_testz_si128(minusbyte, current_bytes))<br/>
return i;<br/>
}</p>
<p>// last part<br/>
if (i &lt; len) {<br/>
char buffer[16];<br/>
memset(buffer, 0, 16);<br/>
memcpy(buffer, src + i, len &#8211; i);<br/>
current_bytes = _mm_loadu_si128((const __m128i *)buffer);<br/>
if (!_mm_testz_si128(minusbyte, current_bytes))<br/>
return i;<br/>
}</p>
<p>return -1;</p>
<p>}</p>
</div>
<ol class="children">
<li id="comment-303855" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-17T14:00:12+00:00">May 17, 2018 at 2:00 pm</time></a> </div>
<div class="comment-content">
<p>Your code is fine, but it is slower if you expect the content to be valid ASCII&#8230;</p>
<pre>
validate_ascii_fast(data, N)                                    :  0.086 cycles per operation (best)    0.087 cycles per operation (avg)
clauderoux_validate_ascii(data, N)                              :  0.106 cycles per operation (best)    0.106 cycles per operation (avg)
</pre>
<p>So it becomes a data-dependent engineering issue.</p>
</div>
<ol class="children">
<li id="comment-303858" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f6202f093efd33cb66565170a55b4d8d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f6202f093efd33cb66565170a55b4d8d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Claude</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-17T15:35:49+00:00">May 17, 2018 at 3:35 pm</time></a> </div>
<div class="comment-content">
<p>I see&#8230; That&rsquo;s quite fascinating. It means that _mm_testz_si128 is much slower than doing a &ldquo;gt&rdquo; comparison and a OR bitwise&#8230;</p>
<p>Which is quite surprising since all this instruction does is a AND bitwise then a check on 0.</p>
<p>Still more than 10 times slower is very weird&#8230;</p>
<p>However, I implemented this routine in my own code, and I have a 25% improvement on checking out if a string is UTF8 or in converting it from UTF8 (or various latin table characters) to Unicode&#8230;<br/>
It also works on Mac OS, my main platform of development. I haven&rsquo;t tested yet on Windows, but I guess I should expect the same results&#8230;</p>
</div>
<ol class="children">
<li id="comment-303859" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-17T15:46:20+00:00">May 17, 2018 at 3:46 pm</time></a> </div>
<div class="comment-content">
<p>According to Agner Fog, the relevant instruction (ptest) counts for two muops and has a latency of 3 cycles. Note that you are also adding an extra branch (that depends on a high latency instruction).</p>
<p><em>Still more than 10 times slower is very weirdâ€¦</em></p>
<p>What is 10 times slower than what?</p>
</div>
<ol class="children">
<li id="comment-303952" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f6202f093efd33cb66565170a55b4d8d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f6202f093efd33cb66565170a55b4d8d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Claude</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-18T08:05:52+00:00">May 18, 2018 at 8:05 am</time></a> </div>
<div class="comment-content">
<p>Hem&#8230; I misread the numbers in a very ridiculous way&#8230;</p>
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
<li id="comment-303958" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8d388380ebee5b495177d88eb1ee5b55?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8d388380ebee5b495177d88eb1ee5b55?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Visitor</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-18T09:54:05+00:00">May 18, 2018 at 9:54 am</time></a> </div>
<div class="comment-content">
<p>This perform pretty badly if the first character of a large string is invalid utf-8 because it still scans the whole string till the end.</p>
</div>
<ol class="children">
<li id="comment-303979" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-18T13:37:26+00:00">May 18, 2018 at 1:37 pm</time></a> </div>
<div class="comment-content">
<p><em>This perform pretty badly if the first character of a large string is invalid utf-8 because it still scans the whole string till the end.</em></p>
<p>The blog post assumes that most of your data is valid UTF-8 and that it is an exceptional case when it is invalid.</p>
<p>If you expect the data to be frequently invalid UTF-8, then you need to proceed differently.</p>
</div>
</li>
</ol>
</li>
<li id="comment-357885" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ad4ee71956de6520a70d92a93b0ad145?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ad4ee71956de6520a70d92a93b0ad145?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Antoine</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-17T10:07:59+00:00">October 17, 2018 at 10:07 am</time></a> </div>
<div class="comment-content">
<p>SIMD does not seem required for the ASCII validation function. The following non-SIMD version is almost as fast here (~0.08 cycle per operation on a Ryzen 7 with gcc 7.3.0):</p>
<p><code>static bool validate_ascii_fast(const char *src, size_t len) {<br/>
const char* end = src + len;<br/>
uint64_t mask1 = 0, mask2 = 0, mask3 = 0, mask4 = 0;</p>
<p> for (; src &lt; end - 32; src += 32) {<br/>
const uint64_t* p = (const uint64_t*) src;<br/>
mask1 |= p[0];<br/>
mask2 |= p[1];<br/>
mask3 |= p[2];<br/>
mask4 |= p[3];<br/>
}<br/>
for (; src &lt; end - 8; src += 8) {<br/>
const uint64_t* p = (const uint64_t*) src;<br/>
mask1 |= p[0];<br/>
}<br/>
uint8_t tail_mask = 0;<br/>
for (; src &lt; end; src++) {<br/>
tail_mask |= * (const uint8_t*) src;<br/>
}<br/>
uint64_t final_mask = mask1 | mask2 | mask3 | mask4 | tail_mask;<br/>
return !(final_mask &amp; 0x8080808080808080);<br/>
}<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-357939" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-17T13:57:07+00:00">October 17, 2018 at 1:57 pm</time></a> </div>
<div class="comment-content">
<p>To prevent the compiler from using SIMD instructions, you need to insert a function attribute or disable it with a compiler flag. If you do that, I think you will find that SIMD instructions are indeed essential to get the best performance.</p>
<p><a href="https://github.com/lemire/fastvalidate-utf-8/issues/15#issuecomment-430637860" rel="nofollow ugc">https://github.com/lemire/fastvalidate-utf-8/issues/15#issuecomment-430637860</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-582258" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/212bf05ba88cb5705ff5bb32e9c69e1f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/212bf05ba88cb5705ff5bb32e9c69e1f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sirmabus</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-15T16:06:15+00:00">April 15, 2021 at 4:06 pm</time></a> </div>
<div class="comment-content">
<p>Merci beaucoup!</p>
<p>Brilliant work. The internet didn&rsquo;t fail me today when I went looking for fast UTF-8 string validation.</p>
<p>And poor guy, some of the comments in your other UTF-8 blog posts are funny. You express (and prove) your answers logically/mathematically, yet people humorously counter repeatedly with the least thought out counter-arguments 😛</p>
<p>très apprécié.</p>
</div>
</li>
</ol>
