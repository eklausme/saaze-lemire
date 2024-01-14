---
date: "2022-12-06 12:00:00"
title: "Optimizing compilers reload vector constants needlessly"
index: false
---

[7 thoughts on &ldquo;Optimizing compilers reload vector constants needlessly&rdquo;](/lemire/blog/2022/12-06-optimizing-compilers-reload-vector-constants-needlessly)

<ol class="comment-list">
<li id="comment-648219" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7f69c6d69a64fda4cbaf711d553b16fb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7f69c6d69a64fda4cbaf711d553b16fb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Philip Trettner</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-06T17:50:18+00:00">December 6, 2022 at 5:50 pm</time></a> </div>
<div class="comment-content">
<p>There is one potential reason why GCC loads the constant twice: in the assembly you see the &ldquo;jb .L2&rdquo; -&gt; &ldquo;jb .L8&rdquo; -&gt; ret path that will never load the constant. At least from the assembly you cannot a priori say that each loop is entered at least once or even that if one is entered, the other is entered as well. If one loop is taken and the other is not, you would need the constant in the common parent of those blocks. That would be a pessimization of the &ldquo;no loop is taken&rdquo; path from the beginning.</p>
<p>Some of the obvious optimizations like merging the two loops are also not really allowed because the ranges might overlap in memory. A simple __restrict doesn&rsquo;t seem to help though.</p>
</div>
<ol class="children">
<li id="comment-648222" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-06T18:42:38+00:00">December 6, 2022 at 6:42 pm</time></a> </div>
<div class="comment-content">
<p>Even if you make sure that the constant is used at least twice&#8230; for sure (unconditionally), GCC still loads the constant twice&#8230;</p>
<p>I agree that you can eventually get GCC to stop doing that with enough coddling&#8230; but that does not help at scale&#8230;</p>
<pre style="color:#000000;background:#ffffff;">#include <span style="color:#808030; ">&lt;</span>x86intrin<span style="color:#808030; ">.</span>h<span style="color:#808030; ">></span>
#include <span style="color:#808030; ">&lt;</span>stdint<span style="color:#808030; ">.</span>h<span style="color:#808030; ">></span>
<span style="color:#800000; font-weight:bold; ">void</span> process_avx2<span style="color:#808030; ">(</span><span style="color:#800000; font-weight:bold; ">const</span> uint32_t <span style="color:#808030; ">*</span>in1<span style="color:#808030; ">,</span> <span style="color:#800000; font-weight:bold; ">const</span> uint32_t <span style="color:#808030; ">*</span>in2<span style="color:#808030; ">,</span> size_t len<span style="color:#808030; ">)</span> <span style="color:#800080; ">{</span>
  <span style="color:#696969; ">// define the constant, 8 x 10001</span>
  __m256i c <span style="color:#808030; ">=</span> _mm256_set1_epi32<span style="color:#808030; ">(</span><span style="color:#008c00; ">10001</span><span style="color:#808030; ">)</span><span style="color:#800080; ">;</span>
  <span style="color:#800000; font-weight:bold; ">const</span> uint32_t <span style="color:#808030; ">*</span>finalin1 <span style="color:#808030; ">=</span> in1 <span style="color:#808030; ">+</span> len<span style="color:#800080; ">;</span>
  <span style="color:#800000; font-weight:bold; ">const</span> uint32_t <span style="color:#808030; ">*</span>finalin2 <span style="color:#808030; ">=</span> in2 <span style="color:#808030; ">+</span> len<span style="color:#800080; ">;</span>
  <span style="color:#800080; ">{</span>
    <span style="color:#696969; ">// load 8 integers into a 32-byte register</span>
    __m256i x <span style="color:#808030; ">=</span> _mm256_loadu_si256<span style="color:#808030; ">(</span><span style="color:#808030; ">(</span>__m256i <span style="color:#808030; ">*</span><span style="color:#808030; ">)</span>in1<span style="color:#808030; ">)</span><span style="color:#800080; ">;</span>
    <span style="color:#696969; ">// add the 8 integers just loaded to the 8 constant integers</span>
    x <span style="color:#808030; ">=</span> _mm256_add_epi32<span style="color:#808030; ">(</span>c<span style="color:#808030; ">,</span> x<span style="color:#808030; ">)</span><span style="color:#800080; ">;</span>
    <span style="color:#696969; ">// store the 8 modified integers</span>
    _mm256_storeu_si256<span style="color:#808030; ">(</span><span style="color:#808030; ">(</span>__m256i <span style="color:#808030; ">*</span><span style="color:#808030; ">)</span>in1<span style="color:#808030; ">,</span> x<span style="color:#808030; ">)</span><span style="color:#800080; ">;</span>
    in1 <span style="color:#808030; ">+</span><span style="color:#808030; ">=</span> <span style="color:#008c00; ">8</span><span style="color:#800080; ">;</span>
  <span style="color:#800080; ">}</span><span style="color:#800080; ">;</span>
  <span style="color:#800000; font-weight:bold; ">for</span> <span style="color:#808030; ">(</span><span style="color:#800080; ">;</span> in1 <span style="color:#808030; ">+</span> <span style="color:#008c00; ">8</span> <span style="color:#808030; ">&lt;</span><span style="color:#808030; ">=</span> finalin1<span style="color:#800080; ">;</span> in1 <span style="color:#808030; ">+</span><span style="color:#808030; ">=</span> <span style="color:#008c00; ">8</span><span style="color:#808030; ">)</span> <span style="color:#800080; ">{</span>
    <span style="color:#696969; ">// load 8 integers into a 32-byte register</span>
    __m256i x <span style="color:#808030; ">=</span> _mm256_loadu_si256<span style="color:#808030; ">(</span><span style="color:#808030; ">(</span>__m256i <span style="color:#808030; ">*</span><span style="color:#808030; ">)</span>in1<span style="color:#808030; ">)</span><span style="color:#800080; ">;</span>
    <span style="color:#696969; ">// add the 8 integers just loaded to the 8 constant integers</span>
    x <span style="color:#808030; ">=</span> _mm256_add_epi32<span style="color:#808030; ">(</span>c<span style="color:#808030; ">,</span> x<span style="color:#808030; ">)</span><span style="color:#800080; ">;</span>
    <span style="color:#696969; ">// store the 8 modified integers</span>
    _mm256_storeu_si256<span style="color:#808030; ">(</span><span style="color:#808030; ">(</span>__m256i <span style="color:#808030; ">*</span><span style="color:#808030; ">)</span>in1<span style="color:#808030; ">,</span> x<span style="color:#808030; ">)</span><span style="color:#800080; ">;</span>
  <span style="color:#800080; ">}</span><span style="color:#800080; ">;</span>
  <span style="color:#800080; ">{</span>
    <span style="color:#696969; ">// load 8 integers into a 32-byte register</span>
    __m256i x <span style="color:#808030; ">=</span> _mm256_loadu_si256<span style="color:#808030; ">(</span><span style="color:#808030; ">(</span>__m256i <span style="color:#808030; ">*</span><span style="color:#808030; ">)</span>in2<span style="color:#808030; ">)</span><span style="color:#800080; ">;</span>
    <span style="color:#696969; ">// add the 8 integers just loaded to the 8 constant integers</span>
    x <span style="color:#808030; ">=</span> _mm256_add_epi32<span style="color:#808030; ">(</span>c<span style="color:#808030; ">,</span> x<span style="color:#808030; ">)</span><span style="color:#800080; ">;</span>
    <span style="color:#696969; ">// store the 8 modified integers</span>
    _mm256_storeu_si256<span style="color:#808030; ">(</span><span style="color:#808030; ">(</span>__m256i <span style="color:#808030; ">*</span><span style="color:#808030; ">)</span>in2<span style="color:#808030; ">,</span> x<span style="color:#808030; ">)</span><span style="color:#800080; ">;</span>
    in2 <span style="color:#808030; ">+</span><span style="color:#808030; ">=</span> <span style="color:#008c00; ">8</span><span style="color:#800080; ">;</span>
  <span style="color:#800080; ">}</span>
  <span style="color:#800000; font-weight:bold; ">for</span> <span style="color:#808030; ">(</span><span style="color:#800080; ">;</span> in2 <span style="color:#808030; ">+</span> <span style="color:#008c00; ">8</span> <span style="color:#808030; ">&lt;</span><span style="color:#808030; ">=</span> finalin2<span style="color:#800080; ">;</span> in2 <span style="color:#808030; ">+</span><span style="color:#808030; ">=</span> <span style="color:#008c00; ">8</span><span style="color:#808030; ">)</span> <span style="color:#800080; ">{</span>
    <span style="color:#696969; ">// load 8 integers into a 32-byte register</span>
    __m256i x <span style="color:#808030; ">=</span> _mm256_loadu_si256<span style="color:#808030; ">(</span><span style="color:#808030; ">(</span>__m256i <span style="color:#808030; ">*</span><span style="color:#808030; ">)</span>in2<span style="color:#808030; ">)</span><span style="color:#800080; ">;</span>
    <span style="color:#696969; ">// add the 8 integers just loaded to the 8 constant integers</span>
    x <span style="color:#808030; ">=</span> _mm256_add_epi32<span style="color:#808030; ">(</span>c<span style="color:#808030; ">,</span> x<span style="color:#808030; ">)</span><span style="color:#800080; ">;</span>
    <span style="color:#696969; ">// store the 8 modified integers</span>
    _mm256_storeu_si256<span style="color:#808030; ">(</span><span style="color:#808030; ">(</span>__m256i <span style="color:#808030; ">*</span><span style="color:#808030; ">)</span>in2<span style="color:#808030; ">,</span> x<span style="color:#808030; ">)</span><span style="color:#800080; ">;</span>
  <span style="color:#800080; ">}</span>
<span style="color:#800080; ">}</span>
</pre>
</div>
</li>
</ol>
</li>
<li id="comment-648226" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f2115fcd55f81a820c5d51ce3526487f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f2115fcd55f81a820c5d51ce3526487f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">tarq</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-06T19:41:29+00:00">December 6, 2022 at 7:41 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t this would have any kind of measurable impact at scale, you have other kind of issues such as push/pop the registers for each func call playing a stronger role here.<br/>
We know that, doing higher level programming with C or C++ we leave this kind of control to the compiler.<br/>
The issue is always the same: we trust the compiler to do a decent job, and if it&rsquo;s not enough we dive into the assembly to squeeze the last bit of cycles we can.<br/>
That shouldn&rsquo;t be an issue if you&rsquo;re already proficient writing SIMD code and looking at the assembly output.<br/>
Always appreciate thoughts on that matter though 🙂</p>
</div>
<ol class="children">
<li id="comment-648231" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-06T21:12:37+00:00">December 6, 2022 at 9:12 pm</time></a> </div>
<div class="comment-content">
<p>I agree that it is unlikely to have a measurable impact on performance.</p>
</div>
</li>
</ol>
</li>
<li id="comment-648239" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/96a1083a4171c9b2a684f538d2782bdd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/96a1083a4171c9b2a684f538d2782bdd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Daniel Berlin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-06T22:30:55+00:00">December 6, 2022 at 10:30 pm</time></a> </div>
<div class="comment-content">
<p>There is definitely the &ldquo;not sure if loop executes&rdquo; problem mentioned earlier, which causes it to move it to execute once per loop because it thinks that guarantees it executes the minimum number of times it can (by the CFG).</p>
<p>What is happening otherwise (IE if you make the loops constant-number-of-iterations for loops) is that constant propagation at a high level determines the vector is a constant, and propagates it forward into both loops, which is fine. Note that<br/>
It is expected that later, after lowering, etc, something with a machine cost model will commonize it if necessary.</p>
<p>The low level definitely knows it is constant in both cases.<br/>
But it does not compute that commonizing it will save anything from what i can tell (I haven&rsquo;t looked at every single pass dump at the RTL level to verify this, only a few that i would have expected to eliminate it).</p>
<p>See <a href="https://godbolt.org/z/jxWKcnTT1" rel="nofollow ugc">https://godbolt.org/z/jxWKcnTT1</a><br/>
This will show you the ccp1 pass, which propagates the constant forward<br/>
if you swap over to the final rtl pass, you can see it knows it is equivalent to a constant<br/>
Nothing in between CSE&rsquo;s it, even if i turn on size optimization.</p>
<p>This is likely related to believing that constants are free in most cases (at the high level this is definitely the right view. As I said, at the low level where it has a machine cost model, it&rsquo;s weirder that it doesn&rsquo;t eliminate it even though it&rsquo;s a constant)</p>
</div>
</li>
<li id="comment-648607" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-27T21:34:59+00:00">December 27, 2022 at 9:34 pm</time></a> </div>
<div class="comment-content">
<p>Is there any difference in declaring:</p>
<p> const register __m256i c = _mm256_set1_epi32(10001);</p>
<p>Seems the *register* keyword might be ignored.</p>
</div>
<ol class="children">
<li id="comment-648622" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-28T17:41:46+00:00">December 28, 2022 at 5:41 pm</time></a> </div>
<div class="comment-content">
<p>The register keyword in such a context seems quite useless in my experience.</p>
</div>
</li>
</ol>
</li>
</ol>
