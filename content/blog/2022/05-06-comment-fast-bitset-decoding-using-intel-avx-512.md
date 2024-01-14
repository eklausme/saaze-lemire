---
date: "2022-05-06 12:00:00"
title: "Fast bitset decoding using Intel AVX-512"
index: false
---

[3 thoughts on &ldquo;Fast bitset decoding using Intel AVX-512&rdquo;](/lemire/blog/2022/05-06-fast-bitset-decoding-using-intel-avx-512)

<ol class="comment-list">
<li id="comment-631864" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6b1dc3e7d3657b4f5bd5e1c9029c7b2b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6b1dc3e7d3657b4f5bd5e1c9029c7b2b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Adrien</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-05-07T11:43:22+00:00">May 7, 2022 at 11:43 am</time></a> </div>
<div class="comment-content">
<p>I think &ldquo;the bitset 0b111010, you would generate the output 1,3,4,6.&rdquo; should be &ldquo;&#8230; 1,3,4,5&rdquo;.</p>
<p>Very interesting as always 👍</p>
</div>
</li>
<li id="comment-631935" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f9536133b5f68dc4e73fed440a6758ab?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f9536133b5f68dc4e73fed440a6758ab?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.parallel-engines.com" class="url" rel="ugc external nofollow">Jatin Bhateja</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-05-07T18:42:42+00:00">May 7, 2022 at 6:42 pm</time></a> </div>
<div class="comment-content">
<p>AVX512_VBMI2 offers VPCOMPRESSB thus one can directly compress 512 bit packed byte vector holding 0-63 values under influence of 64 bit mask. This can replace above unrolled instructions sequence.</p>
</div>
<ol class="children">
<li id="comment-632091" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0066c9b8214ff2db6c99e8216746408d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0066c9b8214ff2db6c99e8216746408d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kim Walisch</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-05-08T12:09:28+00:00">May 8, 2022 at 12:09 pm</time></a> </div>
<div class="comment-content">
<p>I have implemented a modified version of the AVX512_VBMI2 bitset decoding algorithm in my primesieve project that was partially inspired by Daniel&rsquo;s previous blog posts on the same topic. The great thing about using VPCOMPRESSB is that this significantly improves performance for sparse bit streams (that are distributed relatively evenly), e.g. if there are only &lt;= 16 bits set in the uint64_t bits variable an algorithm using VPCOMPRESSB would executed only about 1/4 of the instructions compared to the algorithm from this blog post. Here is a link to my AVX512_VBMI2 algorithm: <a href="https://github.com/kimwalisch/primesieve/blob/9e4e5773f122f71520a9561282e41a78948e6c89/src/PrimeGenerator.cpp#L422" rel="nofollow ugc">https://github.com/kimwalisch/primesieve/blob/9e4e5773f122f71520a9561282e41a78948e6c89/src/PrimeGenerator.cpp#L422</a></p>
</div>
</li>
</ol>
</li>
</ol>
