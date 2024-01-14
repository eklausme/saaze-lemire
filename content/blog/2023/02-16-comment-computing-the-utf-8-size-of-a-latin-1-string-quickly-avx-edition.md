---
date: "2023-02-16 12:00:00"
title: "Computing the UTF-8 size of a Latin 1 string quickly (AVX edition)"
index: false
---

[7 thoughts on &ldquo;Computing the UTF-8 size of a Latin 1 string quickly (AVX edition)&rdquo;](/lemire/blog/2023/02-16-computing-the-utf-8-size-of-a-latin-1-string-quickly-avx-edition)

<ol class="comment-list">
<li id="comment-649318" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b3070ad3bb35d6e518f2dd2ba96c55c9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b3070ad3bb35d6e518f2dd2ba96c55c9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://skanthak.homepage.t-online.de/quirks.html#quirk33" class="url" rel="ugc external nofollow">Stefan Kanthak</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-17T07:54:42+00:00">February 17, 2023 at 7:54 am</time></a> </div>
<div class="comment-content">
<p>&ldquo;it suffices to count two output bytes for each input byte having the most significant bit set, and one output byte for other bytes.&rdquo;</p>
<p>This works until your HTML5 compliant WWW browser (and derived applications) treats ISO-8859-1 as Windows-1252.</p>
</div>
</li>
<li id="comment-649331" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ce3ea4ffd1023d4382f397312352726d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ce3ea4ffd1023d4382f397312352726d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Rici Lake</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-17T19:43:12+00:00">February 17, 2023 at 7:43 pm</time></a> </div>
<div class="comment-content">
<p>Windows-1252 contains a number of characters whose codes exceed the 11-bit limit for two-octet UTF-8. Common example: €, the Euro sign. (There are others.)</p>
<p>ISO-8859-1 only contains codepoints with one- and two-octet UTF-8 sequences, but you&rsquo;ll find pages labelled as Latin1 which are actually Windows-1252 or even Latin15 (also with €).</p>
</div>
<ol class="children">
<li id="comment-649333" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-17T20:34:05+00:00">February 17, 2023 at 8:34 pm</time></a> </div>
<div class="comment-content">
<p>I stand corrected.</p>
<p>Even so, if you are incorrectly identifying Windows-1252 as Latin 1 then you simply cannot convert it to Unicode properly, and there is no sure way to correct and identify a mislabel of the sort.</p>
</div>
<ol class="children">
<li id="comment-649338" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b3070ad3bb35d6e518f2dd2ba96c55c9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b3070ad3bb35d6e518f2dd2ba96c55c9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stefan Kanthak</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-18T03:54:01+00:00">February 18, 2023 at 3:54 am</time></a> </div>
<div class="comment-content">
<p>You can&rsquo;t and MUST NO trust a designation &ldquo;charset=ISO-8859-1&rdquo;; if your code is used to determine the size of buffer allocations, this can result in buffer overruns. Who will assign a CVE then?</p>
<p>About 28 years ago, when adding MIME support to Windows, some imbeciles at Microsoft assigned the Codepage &ldquo;CP_1252&rdquo; to &ldquo;charset=ISO-8859-1&rdquo;:</p>
<p><code>[HKEY_LOCAL_MACHINE\SOFTWARE\Classes\MIME\DataBase\CharSet\iso-8859-1]<br/>
"CodePage"=dword:000004e4<br/>
</code></p>
<p>From then, every piece of (not just) their crap, like FrontPage or Word, which composes mail or HTML pages AND relies on Windows MIME database, labels text encoded with CP_1252 as ISO-8859-1 (the other &ldquo;charset=ISO-8859-<em>&rdquo; have also wrong codepages assigned).<br/>
Years later, Microsoft registered several &ldquo;charset=Windows-</em>&rdquo; with IANA, but never fixed their wrong database &#8212; a REAL shame.<br/>
When the W3C standardized HTML5, to avoid a misrepresentation of HTML pages generated with Microsoft crap, they specified that ISO-8859-1 must be handled as Windows-1252.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-649354" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a81016e1bb223d67c2992644a7bb3d85?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a81016e1bb223d67c2992644a7bb3d85?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Yaffle</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-18T19:30:23+00:00">February 18, 2023 at 7:30 pm</time></a> </div>
<div class="comment-content">
<p>Do you know what performance will those functions have with 64BM strings (when cpu cache is much smaller then the string length) ?</p>
</div>
<ol class="children">
<li id="comment-649368" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-19T12:34:21+00:00">February 19, 2023 at 12:34 pm</time></a> </div>
<div class="comment-content">
<p>If you are dealing with large strings, you probably want to fragment the problem: process substrings. See this blog post where I explain that working with large inputs all at once is a performance anti-pattern: <a href="https://lemire.me/blog/2021/08/21/the-big-load-anti-pattern/" rel="ugc">https://lemire.me/blog/2021/08/21/the-big-load-anti-pattern/</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-649361" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f256678460c5afe31bdab98049fcde6f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f256678460c5afe31bdab98049fcde6f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">NRK</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-19T07:44:55+00:00">February 19, 2023 at 7:44 am</time></a> </div>
<div class="comment-content">
<p>Great read as usual!</p>
<p>Out of curiosity, I went ahead and wrote a SWAR version using <code>uint_fast32_t</code>. Going by cycles/byte &#8211; it&rsquo;s about 3.5x faster than the autovectorized scalar version on my zen2 machine.</p>
<p><code>size_t swar_utf8_len(const uint8_t *s, size_t len) {<br/>
typedef uint_fast32_t V; static_assert(sizeof(V) &lt;= sizeof(uint64_t));<br/>
size_t mask = V{0x80808080} | (V{0x80808080} &lt;&lt; 16 &lt;&lt; 16);<br/>
size_t answer = 0;<br/>
size_t swar_rounds = len / sizeof(V);<br/>
size_t swar_bytes = swar_rounds * sizeof(V);<br/>
for (size_t i = 0; i &lt; swar_bytes; i += sizeof(V)) {<br/>
V v;<br/>
memcpy(&amp;v, s + i, sizeof v);<br/>
v &amp;= mask;<br/>
answer += std::popcount(v);<br/>
}<br/>
return len + answer + scalar_utf8_length(s + swar_bytes, len - swar_bytes);<br/>
}<br/>
</code></p>
<p>(Note that <code>std::popcount</code> requires c++20.)</p>
<p>3.5x speed up from just dozen lines of (mostly) portable code seems like a good deal!</p>
</div>
</li>
</ol>
