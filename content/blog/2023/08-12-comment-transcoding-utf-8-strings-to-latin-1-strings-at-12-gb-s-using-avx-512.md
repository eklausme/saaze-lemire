---
date: "2023-08-12 12:00:00"
title: "Transcoding UTF-8 strings to Latin 1 strings at 18 GB/s using AVX-512"
index: false
---

[12 thoughts on &ldquo;Transcoding UTF-8 strings to Latin 1 strings at 18 GB/s using AVX-512&rdquo;](/lemire/blog/2023/08-12-transcoding-utf-8-strings-to-latin-1-strings-at-12-gb-s-using-avx-512)

<ol class="comment-list">
<li id="comment-653981" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6504fad0830c1dd03086ee35097cea11?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6504fad0830c1dd03086ee35097cea11?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">camel-cdr</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-08-12T13:34:17+00:00">August 12, 2023 at 1:34 pm</time></a> </div>
<div class="comment-content">
<p>I wrote a RVV version:</p>
<p><code>size_t convert_rvv(uint8_t *utf8, size_t len, uint8_t *latin1)<br/>
{<br/>
uint8_t *beg = latin1;<br/>
uint8_t last = 0;</p>
<p> vuint8m4_t v, s;<br/>
vbool2_t ascii, cont, leading, sleading;</p>
<p> for (size_t vl, VL; len &gt; 1; ) {<br/>
VL = vl = __riscv_vsetvl_e8m4(len);</p>
<p> v = __riscv_vle8_v_u8m4(utf8, vl);<br/>
ascii = __riscv_vmsgtu_vx_u8m4_b2(v, 0x80-1, vl);<br/>
if (__riscv_vfirst_m_b2(ascii, vl) &lt; 0)<br/>
goto skip;</p>
<p> s = __riscv_vslide1up_vx_u8m4(v, last, vl);</p>
<p> leading = __riscv_vmsltu_vx_u8m4_b2(__riscv_vadd_vx_u8m4(v, 0b11000010, vl), 2, vl);<br/>
sleading = __riscv_vmsltu_vx_u8m4_b2(__riscv_vadd_vx_u8m4(s, 0b11000010, vl), 2, vl);<br/>
cont = __riscv_vmsne_vx_u8m4_b2(__riscv_vsrl_vx_u8m4(v, 6, vl), 0b10, vl);<br/>
if (__riscv_vcpop_m_b2(__riscv_vmand_mm_b2(sleading, cont, vl), vl) != __riscv_vcpop_m_b2(sleading, vl) ||<br/>
__riscv_vfirst_m_b2(__riscv_vmnor_mm_b2(ascii, __riscv_vmor_mm_b2(leading, cont, vl), vl), vl) &gt;= 0)<br/>
return 0;</p>
<p> s = __riscv_vor_vv_u8m4(__riscv_vsll_vx_u8m4(__riscv_vand_vx_u8m4(v, 1, vl), 6, vl), s, vl);<br/>
s = __riscv_vmerge_vvm_u8m4(v, s, ascii, vl);</p>
<p> v = __riscv_vcompress_vm_u8m4(s, cont, vl);<br/>
vl = __riscv_vcpop_m_b2(cont, vl);<br/>
skip:<br/>
__riscv_vse8_v_u8m4(latin1, v, vl);<br/>
latin1 += vl; utf8 += VL; len -= VL;<br/>
last = utf8[-1];<br/>
}</p>
<p> return (latin1 - (uint8_t*)beg);<br/>
}<br/>
</code></p>
<p>Results from a 2 GHz C920:</p>
<p><code>SWAR: 0.419896 GiB/s<br/>
RVV: 3.707396 GiB/s<br/>
</code></p>
<p>(I hope this isn&rsquo;t a duplicate, I couldn&rsquo;t tell if the previous posting got through)</p>
</div>
<ol class="children">
<li id="comment-653983" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6504fad0830c1dd03086ee35097cea11?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6504fad0830c1dd03086ee35097cea11?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">camel-cdr</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-08-12T13:40:36+00:00">August 12, 2023 at 1:40 pm</time></a> </div>
<div class="comment-content">
<p>Looks like the formatting got a bit messed up, here is a godbolt link: <a href="https://godbolt.org/z/6M7T938aE" rel="nofollow ugc">https://godbolt.org/z/6M7T938aE</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-653999" class="comment byuser comment-author-lemire bypostauthor even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-08-12T18:15:35+00:00">August 12, 2023 at 6:15 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for sharing!</p>
</div>
</li>
<li id="comment-654030" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-08-13T04:46:44+00:00">August 13, 2023 at 4:46 am</time></a> </div>
<div class="comment-content">
<p>Isn&rsquo;t this just a case of moving the bottom bit of the leading byte to the 6th of the following byte, then stripping out all leading bytes?</p>
<p><code>__m512i input = _mm512_loadu_si512((__m512i *)(buf + pos));<br/>
__mmask64 leading = _mm512_cmpge_epu8_mask(input, _mm512_set1_epi8(-64));<br/>
__mmask64 bit6 = _mm512_mask_test_epi8_mask(leading, input, _mm512_set1_epi8(1));<br/>
input = _mm512_mask_sub_epi8(input, (bit6&lt;&lt;1) | next_bit6, input, _mm512_set1_epi8(-64));<br/>
next_bit6 = bit6 &gt;&gt; 63;<br/>
_mm512_mask_compressstoreu_epi8((__m512i*)latin_output, ~leading, input); // WARNING: bad on Zen4<br/>
</code></p>
<p>I tried putting it into the full code, and it appears to work: <a href="https://pastebin.com/Jbzm16pF" rel="nofollow ugc">https://pastebin.com/Jbzm16pF</a><br/>
I&rsquo;m not sure if the test cases can pick up all possible errors though.</p>
</div>
<ol class="children">
<li id="comment-654056" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-08-13T20:57:10+00:00">August 13, 2023 at 8:57 pm</time></a> </div>
<div class="comment-content">
<p>Except that my full code validates the input. I don&rsquo;t think your code does&#8230;</p>
</div>
<ol class="children">
<li id="comment-654058" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-08-13T20:59:52+00:00">August 13, 2023 at 8:59 pm</time></a> </div>
<div class="comment-content">
<p>Oh. I see that you have completed it. I will run benchmarks.</p>
</div>
<ol class="children">
<li id="comment-654059" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-08-13T21:56:04+00:00">August 13, 2023 at 9:56 pm</time></a> </div>
<div class="comment-content">
<p>Blog post updated. Great results.</p>
</div>
<ol class="children">
<li id="comment-654063" class="comment odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-08-14T02:33:48+00:00">August 14, 2023 at 2:33 am</time></a> </div>
<div class="comment-content">
<p>Thanks for trying it out!</p>
</div>
<ol class="children">
<li id="comment-654078" class="comment byuser comment-author-lemire bypostauthor even depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-08-14T14:23:43+00:00">August 14, 2023 at 2:23 pm</time></a> </div>
<div class="comment-content">
<p>I was estimating 0.5 instructions per byte for an optimized routine but your approach is a tad better which is amazing.</p>
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
<li id="comment-654051" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6379da1a289c548ef8208f8cae08d8bd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6379da1a289c548ef8208f8cae08d8bd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Eggz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-08-13T15:40:21+00:00">August 13, 2023 at 3:40 pm</time></a> </div>
<div class="comment-content">
<p>oke intel fanboy. Are you done? Can we shelve complicated avx512 indoctrination completely now? Good heavens&#8230;</p>
</div>
<ol class="children">
<li id="comment-654057" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-08-13T20:57:30+00:00">August 13, 2023 at 8:57 pm</time></a> </div>
<div class="comment-content">
<p>AMD Zen 4 has superb AVX-512 support.</p>
</div>
</li>
<li id="comment-654064" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-08-14T02:35:32+00:00">August 14, 2023 at 2:35 am</time></a> </div>
<div class="comment-content">
<p>If you have a competitive alternative, you&rsquo;re welcome to post it.</p>
</div>
</li>
</ol>
</li>
</ol>
