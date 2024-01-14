---
date: "2022-12-23 12:00:00"
title: "Fast base16 encoding"
index: false
---

[8 thoughts on &ldquo;Fast base16 encoding&rdquo;](/lemire/blog/2022/12-23-fast-base16-encoding)

<ol class="comment-list">
<li id="comment-648616" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1d398fd59a4f724122e5a825999986d0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1d398fd59a4f724122e5a825999986d0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">nonnull</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-28T07:21:31+00:00">December 28, 2022 at 7:21 am</time></a> </div>
<div class="comment-content">
<p>May be worth tossing in a comparison with the &lsquo;traditional&rsquo; approach, that is roughly:</p>
<p>void encode_avx2(const uint8_t *restrict source, size_t len, char *restrict target) {<br/>
__m256i lomask = _mm256_set1_epi8(0x0F);<br/>
__m256i himask = _mm256_set1_epi8(0xF0);<br/>
__m256i letter = _mm256_set1_epi8(9);<br/>
__m256i numberdiff = _mm256_set1_epi8(&lsquo;0&rsquo;);<br/>
__m256i letterdiff = _mm256_set1_epi8(&lsquo;a&rsquo; &#8211; 10);</p>
<p> for (size_t i = 0; i + 32 &lt;= len; i += 32) {<br/>
__m256i input = _mm256_loadu_si256((const __m256i *)(source + i));<br/>
__m256i sinput = _mm256_permute4x64_epi64(input, 0b11011000);</p>
<p> __m256i hs = _mm256_and_si256(sinput, himask);<br/>
__m256i hi = _mm256_srli_epi16(hs, 4);<br/>
__m256i lo = _mm256_and_si256(sinput, lomask);</p>
<p> __m256i loletter = _mm256_cmpgt_epi8(lo, letter);<br/>
__m256i hiletter = _mm256_cmpgt_epi8(hi, letter);</p>
<p> __m256i looffset = _mm256_blendv_epi8(numberdiff, letterdiff, loletter);<br/>
__m256i hioffset = _mm256_blendv_epi8(numberdiff, letterdiff, hiletter);</p>
<p> __m256i loout = _mm256_add_epi8(lo, looffset);<br/>
__m256i hiout = _mm256_add_epi8(hi, hioffset);</p>
<p> __m256i firstt = _mm256_unpacklo_epi8(loout, hiout);<br/>
__m256i second = _mm256_unpackhi_epi8(loout, hiout);<br/>
_mm256_storeu_si256((__m256i *)(target), firstt);<br/>
target += 32;<br/>
_mm256_storeu_si256((__m256i *)(target), second);<br/>
target += 32;<br/>
}<br/>
}</p>
<p>(Warning: completely untested.)</p>
<p>This is just a fairly rote translation of:</p>
<p>uint8_t lo = input &amp; 0xF;<br/>
uint8_t hi = (input &gt;&gt; 4) &amp; 0xF;<br/>
lo += (lo &gt; 9) ? (&lsquo;a&rsquo; &#8211; 10) : &lsquo;0&rsquo;;<br/>
hi += (hi &gt; 9) ? (&lsquo;a&rsquo; &#8211; 10) : &lsquo;0&rsquo;;</p>
<p>The shuffle approach should be faster. 2x vpshufb versus 2x vpcmpgtb and 2x vpblendvb and 2x vpaddb.</p>
</div>
</li>
<li id="comment-648697" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/94f49719dd16d949dd4e10e54e4d267a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/94f49719dd16d949dd4e10e54e4d267a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://faithlife.codes/" class="url" rel="ugc external nofollow">Bradley Grainger</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-01T01:19:51+00:00">January 1, 2023 at 1:19 am</time></a> </div>
<div class="comment-content">
<p>The comment in the K4os.Text.BaseX README is slightly out-of-date; there is now an optimised Base16 encoding method in .NET: <a href="https://learn.microsoft.com/en-us/dotnet/api/system.convert.tohexstring?view=net-7.0" rel="nofollow ugc">Convert.ToHexString</a>.</p>
<p>The source code is vectorised: <a href="https://github.com/dotnet/runtime/blob/main/src/libraries/Common/src/System/HexConverter.cs" rel="nofollow ugc">https://github.com/dotnet/runtime/blob/main/src/libraries/Common/src/System/HexConverter.cs</a></p>
<p>I did not profile the built-in NET implementation against the one you linked to.</p>
<p>(Turns out I wrote the Ascii85 test code that Milosz linked to in the README, though!)</p>
</div>
</li>
<li id="comment-649058" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/13f83087e0abc142a946cfed55b8b76a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/13f83087e0abc142a946cfed55b8b76a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ciprian</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-26T16:05:55+00:00">January 26, 2023 at 4:05 pm</time></a> </div>
<div class="comment-content">
<p>Man, that memcpy looks criminal there. Why not have your table of shorts?<br/>
Then you could write:<br/>
for (; len; len&#8211;) {<br/>
*target++ = table[*source++];<br/>
}</p>
<p>Don&rsquo;t be shy with pointer arithmetic, either. Most likely the compiler would do the right thing for you, but you can never know.</p>
<p>And then people doubtful of compilers go further and unroll the loop. Sometimes is makes a difference, sometimes it doesn&rsquo;t.</p>
<p>And still this is not half of what you could do.</p>
<p>Compare the SIMD code with the best non SIMD code you can write.<br/>
Otherwise, what&rsquo;s the point?</p>
</div>
<ol class="children">
<li id="comment-649059" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-26T18:01:29+00:00">January 26, 2023 at 6:01 pm</time></a> </div>
<div class="comment-content">
<p>We want to store the content to a string. The string is not (in my mind) always aligned on a two-byte boundary. Now, if it is, your code is indeed simpler. But the code from the blog post won&rsquo;t trigger undefined behaviour.</p>
<p>Is your code faster ? You seem to think so, but you do not report on any benchmark. I remind you that I publish my code, so you can modify it and see whether you can make it go faster.</p>
<p>Of course, which compiler you use matters, and which settings.</p>
<p>Using GCC with -O3, your code compiles to :</p>
<pre>
encode_scalar_short(unsigned char const*, unsigned long, unsigned short*):
        movdqa  .LC0(%rip), %xmm0
        movl    $26214, %eax
        movw    %ax, -24(%rsp)
        movaps  %xmm0, -40(%rsp)
        testq   %rsi, %rsi
        je      .L1
        xorl    %eax, %eax
.L3:
        movzbl  (%rdi,%rax), %ecx
        movzwl  -40(%rsp,%rcx,2), %ecx
        movw    %cx, (%rdx,%rax,2)
        addq    $1, %rax
        cmpq    %rsi, %rax
        jne     .L3
.L1:
        ret
</pre>
<p>GCC compiles the code from the blog post to</p>
<pre>
encode_scalar(unsigned char const*, unsigned long, char*):
        movdqa  .LC0(%rip), %xmm0
        movl    $26214, %eax
        movw    %ax, -24(%rsp)
        movaps  %xmm0, -40(%rsp)
        testq   %rsi, %rsi
        je      .L9
        xorl    %eax, %eax
.L11:
        movzbl  (%rdi,%rax), %ecx
        movzwl  -40(%rsp,%rcx,2), %ecx
        movw    %cx, (%rdx,%rax,2)
        addq    $1, %rax
        cmpq    %rax, %rsi
        jne     .L11
.L9:
        ret
</pre>
<p>It looks very similar to me.</p>
<p>It also looks like what you&rsquo;d expect. Load the byte value, look up the short, store the short, increment, check if we are at the end of the loop.</p>
<p>Unrolling might reduce the instruction count, but GCC is not eager to unroll, even with -O3. I would also not be tempted to unroll.</p>
<p>So I think that the code from the blog post is decent and high performance.</p>
</div>
</li>
</ol>
</li>
<li id="comment-649065" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/13f83087e0abc142a946cfed55b8b76a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/13f83087e0abc142a946cfed55b8b76a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ciprian</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-27T08:24:09+00:00">January 27, 2023 at 8:24 am</time></a> </div>
<div class="comment-content">
<p>In this case, the memcpy was nicely optimized away. When that does not happen, all bets are off.</p>
<p>On my system (i5-6200U CPU @ 2.30GHz from 2015)</p>
<p> for (size_t i = 0; i &gt;= 2;<br/>
for (; len; len&#8211;) {<br/>
*target++ = table[*source++];<br/>
*target++ = table[*source++];<br/>
*target++ = table[*source++];<br/>
*target++ = table[*source++];<br/>
}<br/>
for (; i; i&#8211;) {<br/>
*target++ = table[*source++];<br/>
}</p>
<p>runs in .45s.</p>
<p>admittedly, one never knows when the loop unrolling pays off.</p>
</div>
</li>
<li id="comment-649073" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/13f83087e0abc142a946cfed55b8b76a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/13f83087e0abc142a946cfed55b8b76a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ciprian</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-28T12:10:17+00:00">January 28, 2023 at 12:10 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t know what happened with my earlier reply.<br/>
The site made a mess of it.</p>
<p>this:</p>
<p> for (size_t i = 0; i &gt;= 2;<br/>
for (; len; len&#8211;) {<br/>
*target++ = table[*source++];<br/>
*target++ = table[*source++];<br/>
*target++ = table[*source++];<br/>
*target++ = table[*source++];<br/>
}<br/>
for (; i; i&#8211;) {<br/>
*target++ = table[*source++];<br/>
}</p>
<p>runs in .45s.</p>
</div>
</li>
<li id="comment-649074" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/13f83087e0abc142a946cfed55b8b76a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/13f83087e0abc142a946cfed55b8b76a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ciprian</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-28T12:13:45+00:00">January 28, 2023 at 12:13 pm</time></a> </div>
<div class="comment-content">
<p>Hmm. Same thing again. Some text is removed in the middle.<br/>
Strange bug. Maybe there&rsquo;s some character it doesn&rsquo;t like.</p>
<p> for (size_t i = 0; i &gt;= 2;<br/>
for (; len; len&#8211;) {<br/>
*target++ = table[*source++];<br/>
*target++ = table[*source++];<br/>
*target++ = table[*source++];<br/>
*target++ = table[*source++];<br/>
}<br/>
for (; i; i&#8211;) {<br/>
*target++ = table[*source++];<br/>
}</p>
<p>With target being short *.</p>
</div>
</li>
<li id="comment-649075" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/13f83087e0abc142a946cfed55b8b76a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/13f83087e0abc142a946cfed55b8b76a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ciprian</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-28T12:14:53+00:00">January 28, 2023 at 12:14 pm</time></a> </div>
<div class="comment-content">
<p>Right. I can&rsquo;t do this.</p>
<p>What I was saying is that the original code takes .62s.<br/>
The unrolled code is .45s.</p>
</div>
</li>
</ol>
