---
date: "2022-12-15 12:00:00"
title: "Checking for the absence of a string, naive AVX-512 edition"
index: false
---

[8 thoughts on &ldquo;Checking for the absence of a string, naive AVX-512 edition&rdquo;](/lemire/blog/2022/12-15-checking-for-the-absence-of-a-string-naive-avx-512-edition)

<ol class="comment-list">
<li id="comment-648447" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/02d257cd405544564222bbdf504ef4d7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/02d257cd405544564222bbdf504ef4d7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://branchfree.org" class="url" rel="ugc external nofollow">Geoff Langdale</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-16T02:19:28+00:00">December 16, 2022 at 2:19 am</time></a> </div>
<div class="comment-content">
<p>We do something similar in Hyperscan &#8211; entry point for the most heavily used single string search is at: </p>
<p><a href="https://github.com/intel/hyperscan/blob/64a995bf445d86b74eb0f375624ffc85682eadfe/src/hwlm/noodle_engine.c#L221" rel="nofollow ugc">https://github.com/intel/hyperscan/blob/64a995bf445d86b74eb0f375624ffc85682eadfe/src/hwlm/noodle_engine.c#L221</a></p>
<p>The pragmatic approach is to look for the first 2 &ldquo;distinct&rdquo; characters in the string (i.e. if the string is &ldquo;aabb&rdquo; use &ldquo;ab&rdquo; for a contiguous 2-character search, not &ldquo;aa&rdquo; or &ldquo;bb&rdquo;) and follow up with a simple AND/CMP type check on a hit. This runs &lsquo;fast enough&rsquo; &#8211; single-string search is rarely a bottleneck in Hyperscan.</p>
</div>
<ol class="children">
<li id="comment-648467" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Joern Engel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-17T08:07:42+00:00">December 17, 2022 at 8:07 am</time></a> </div>
<div class="comment-content">
<p>It has been a while since I read it, but <a href="https://blog.burntsushi.net/ripgrep/" rel="nofollow ugc">https://blog.burntsushi.net/ripgrep/</a> had a few neat tricks.</p>
<p>Branches are expensive, so comparing two bytes instead of one before the first branch makes sense. Selecting the most uncommon bytes from the needle reduces the branches taken even further.</p>
</div>
</li>
<li id="comment-648497" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/693444e5424f08503eb24d00d37271c1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/693444e5424f08503eb24d00d37271c1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mischa Sandberg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-19T21:37:03+00:00">December 19, 2022 at 9:37 pm</time></a> </div>
<div class="comment-content">
<p>Agreed on looking for two chars. Tried various schemes of choosing them (including the above) and performance varied little; memory bandwidth and cache line boundaries seemed to rule. Settled on the two chars whose first occurrences in the pattern string were the closest to the end.</p>
</div>
</li>
</ol>
</li>
<li id="comment-648456" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/03f43ed76893838269f44c451d2ed653?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/03f43ed76893838269f44c451d2ed653?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Matt Palmer</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-16T12:52:57+00:00">December 16, 2022 at 12:52 pm</time></a> </div>
<div class="comment-content">
<p>See the EPSM search algorithm for a very fast SIMD based search.</p>
<p><a href="https://www.sciencedirect.com/science/article/pii/S1570866714000471" rel="nofollow ugc">https://www.sciencedirect.com/science/article/pii/S1570866714000471</a></p>
</div>
</li>
<li id="comment-648460" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5d109eafc0efd7fe6e5ef707c0a75fa4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5d109eafc0efd7fe6e5ef707c0a75fa4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://fexl.com" class="url" rel="ugc external nofollow">Patrick Chkoreff</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-16T15:47:40+00:00">December 16, 2022 at 3:47 pm</time></a> </div>
<div class="comment-content">
<p>In my functional programming language Fexl I&rsquo;ve been using the following naive version. Note that I use a &ldquo;string&rdquo; structure which is a length followed by the actual bytes, so I could have a string of 1000 NULs for example.</p>
<p>/* Search x for the first occurrence of y, starting at offset. Return the<br/>
position within x where y was found. If the position returned is past the end<br/>
of x, then y was not found. */<br/>
unsigned long str_search(string x, string y, unsigned long offset)<br/>
{<br/>
unsigned long xn = x-&gt;len;<br/>
unsigned long yn = y-&gt;len;</p>
<p> /* Avoid unnecessary work if a match is impossible based on lengths. */<br/>
if (xn &lt; yn || offset &gt; xn &#8211; yn) return xn;</p>
<p> {<br/>
char *xs = x-&gt;data;<br/>
char *ys = y-&gt;data;<br/>
unsigned long xi = offset;<br/>
unsigned long yi = 0;<br/>
while (1)<br/>
{<br/>
if (yi &gt;= yn) return xi &#8211; yi; /* found */<br/>
if (xi &gt;= xn) return xn; /* not found */</p>
<p> if (xs[xi] == ys[yi])<br/>
yi++;<br/>
else<br/>
{<br/>
xi -= yi;<br/>
yi = 0;<br/>
}</p>
<p> xi++;<br/>
}<br/>
}<br/>
}</p>
<p>(Tip of the hat for tohtml.com by the way.)</p>
<p>I perused the source code for strstr and it&rsquo;s pretty amazing. I was surprised to see actual calls to memcmp in it, though I suppose they&rsquo;re leveraging on some known efficiencies in there.</p>
</div>
</li>
<li id="comment-648465" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/90a974556e81a7a479a4cb82de9dc5fa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/90a974556e81a7a479a4cb82de9dc5fa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">weineng</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-17T06:12:49+00:00">December 17, 2022 at 6:12 am</time></a> </div>
<div class="comment-content">
<p>your avx2/avx256 implementation requires the CPU to implement avx-512, which my machine did not have. Hacked around with the following solution for avx2. Note that masking don&rsquo;t play well with avx2 and chars. What I did was to fall back to memcmp for the remaining few comparisons. If anyone could figure out a way to not fall back to memcmp using only avx2 instructions, lmk!</p>
<p>inline const char *find_avx256(const char *in, size_t len, const char *needle,<br/>
size_t needle_len) {<br/>
size_t i = 0;<br/>
for (; i + 32 + needle_len &#8211; 1 &lt; len; i += 32) {<br/>
__m256i comparator = _mm256_set1_epi8(needle[0]);<br/>
__m256i input = _mm256_load_si256(reinterpret_cast(in + i));<br/>
int matches = _mm256_movemask_epi8(_mm256_cmpeq_epi8(comparator, input));<br/>
for (size_t char_index = 1; matches &amp;&amp; char_index &lt; needle_len; char_index++) {<br/>
comparator = _mm256_set1_epi8(needle[char_index]);<br/>
input = _mm256_load_si256(reinterpret_cast(in + i + char_index));<br/>
matches &amp;= _mm256_movemask_epi8(_mm256_cmpeq_epi8(comparator, input));<br/>
}<br/>
if(matches) {<br/>
return in + i + __builtin_ctz(matches);<br/>
}<br/>
}<br/>
while (i + needle_len &#8211; 1 &lt; len) {<br/>
if (memcmp(in + i, needle, needle_len) == 0) {<br/>
return in + i;<br/>
}<br/>
++i;<br/>
}<br/>
return nullptr;<br/>
}</p>
</div>
</li>
<li id="comment-648504" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7a31aade60f527b641825da317cbb524?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7a31aade60f527b641825da317cbb524?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ben Bridgwater</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-20T18:12:26+00:00">December 20, 2022 at 6:12 pm</time></a> </div>
<div class="comment-content">
<p>Not all implementations of strstr() are going to be the same, but certainly a naieve &ldquo;advance one character if match fails at this position&rdquo; is far from optimal.</p>
<p>A much smarter string search algorithm is Boyer-Moore which skips past positions where a match cannot exist.</p>
<p><a href="https://www.cs.utexas.edu/users/moore/best-ideas/string-searching/" rel="nofollow ugc">https://www.cs.utexas.edu/users/moore/best-ideas/string-searching/</a></p>
</div>
<ol class="children">
<li id="comment-648505" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-20T19:49:16+00:00">December 20, 2022 at 7:49 pm</time></a> </div>
<div class="comment-content">
<p>The strstr function in glibc uses an optimized Boyer-Moore-Horspool algorithm.</p>
</div>
</li>
</ol>
</li>
</ol>
