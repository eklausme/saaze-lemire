---
date: "2023-02-01 12:00:00"
title: "Serializing IPs quickly in C++"
index: false
---

[22 thoughts on &ldquo;Serializing IPs quickly in C++&rdquo;](/lemire/blog/2023/02-01-serializing-ips-quickly-in-c)

<ol class="comment-list">
<li id="comment-649119" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cb7dbd4dd3d95da35558ef5dedc9042e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cb7dbd4dd3d95da35558ef5dedc9042e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">pg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-02T14:18:10+00:00">February 2, 2023 at 2:18 pm</time></a> </div>
<div class="comment-content">
<p>There&rsquo;s a copy/paste bug on lines 261 and 262 in str.cpp.</p>
</div>
</li>
<li id="comment-649120" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cb7dbd4dd3d95da35558ef5dedc9042e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cb7dbd4dd3d95da35558ef5dedc9042e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">pg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-02T14:34:41+00:00">February 2, 2023 at 2:34 pm</time></a> </div>
<div class="comment-content">
<p>Faster C code:</p>
<blockquote><p>
std::string ipv53(const uint64_t address) noexcept {<br/>
std::string output(4 * 3 + 3, &lsquo;\0&rsquo;);<br/>
char *p = output.data();</p>
<p> uint32_t a = __builtin_bswap32(address);</p>
<p> for (int i = 0; i &gt;= 8;<br/>
}<br/>
&#8211;p;</p>
<p> output.resize(p &#8211; output.data());<br/>
return output;<br/>
}
</p></blockquote>
</div>
</li>
<li id="comment-649121" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0159b6fbc37dba3c29b20a5f8cc31783?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0159b6fbc37dba3c29b20a5f8cc31783?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sean Hoffman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-02T16:18:34+00:00">February 2, 2023 at 4:18 pm</time></a> </div>
<div class="comment-content">
<p>The uglier version might be faster still if you reduced the calls to output.data() and stored them in a local pointer rather than make 3 separate calls to the same function in scope.</p>
</div>
</li>
<li id="comment-649123" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marcin Zukowski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-02T19:51:09+00:00">February 2, 2023 at 7:51 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel, As always, you take on interesting challenges. First, a minor fix, your code for ipv41 is incorrect, check this out &#8211; output.append(std::to_string((address &gt;&gt; (i * 8)) % 256) + &ldquo;.&rdquo;); + output.append(&ldquo;.&rdquo; + std::to_string((address &gt;&gt; (i * 8)) % 256) ); Now, I took a quick look, and another idea came to me. All &ldquo;parts&rdquo; of the IP are at most 4 bytes, so instead of working with strings, you can work with integers. The code below on my notebook is 3x faster than the fastest previous version by Dimov from your repo. Hopefully useful!</p>
<p>std::string ipv52(const uint64_t address) noexcept {<br/>
std::string output(4 * 3 + 3, &lsquo;\0&rsquo;);<br/>
char *p = output.data();<br/>
p = to_chars_52(p, uint8_t(address &gt;&gt; 24));<br/>
*p++ = &lsquo;.&rsquo;;<br/>
p = to_chars_52(p, uint8_t(address &gt;&gt; 16));<br/>
*p++ = &lsquo;.&rsquo;;<br/>
p = to_chars_52(p, uint8_t(address &gt;&gt; 8));<br/>
*p++ = &lsquo;.&rsquo;;<br/>
p = to_chars_52(p, uint8_t(address &gt;&gt; 0));<br/>
output.resize(p &#8211; output.data());<br/>
return output;<br/>
}<br/>
class Foo {<br/>
public:<br/>
Foo() {<br/>
for (int i = 0; i &lt; 256; i++) {<br/>
std::string s0 = std::to_string(i);<br/>
std::string s1 = std::string(&ldquo;.&rdquo;) + s0;<br/>
v0[i] = *(int*)s0.data();<br/>
v1[i] = *(int*)s1.data();<br/>
l0[i] = (i &lt; 10) ? 1 : (i &lt; 100 ? 2 : 3);<br/>
l1[i] = l0[i] + 1;<br/>
}<br/>
}<br/>
int v0[256]; // value for the 0th byte<br/>
int v1[256]; // value for the 1+ byte<br/>
int l0[256]; // length for the 0th byte<br/>
int l1[256]; // length for the 1+ byte<br/>
};<br/>
Foo foo;<br/>
std::string ipv61(const uint64_t address) noexcept {<br/>
std::string output(4 * 3 + 3, &lsquo;\0&rsquo;);<br/>
char *point = output.data();<br/>
uint8_t by;<br/>
by = address &gt;&gt; 24;<br/>
*(int*)point = foo.v0[by];<br/>
point += foo.l0[by];<br/>
by = address &gt;&gt; 16;<br/>
*(int*)point = foo.v1[by];<br/>
point += foo.l1[by];<br/>
by = address &gt;&gt; 8;<br/>
*(int*)point = foo.v1[by];<br/>
point += foo.l1[by];<br/>
by = address &gt;&gt; 0;<br/>
*(int*)point = foo.v1[by];<br/>
point += foo.l1[by];<br/>
output.resize(point &#8211; output.data());<br/>
return output;<br/>
}<br/>
</p>
</div>
</li>
<li id="comment-649124" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marcin Zukowski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-02T19:54:47+00:00">February 2, 2023 at 7:54 pm</time></a> </div>
<div class="comment-content">
<p>Something went wrong in copy/paste, trying again</p>
<p>std::string ipv52(const uint64_t address) noexcept {<br/>
std::string output(4 * 3 + 3, &lsquo;\0&rsquo;);<br/>
char *p = output.data();<br/>
p = to_chars_52(p, uint8_t(address &gt;&gt; 24));<br/>
*p++ = &lsquo;.&rsquo;;<br/>
p = to_chars_52(p, uint8_t(address &gt;&gt; 16));<br/>
*p++ = &lsquo;.&rsquo;;<br/>
p = to_chars_52(p, uint8_t(address &gt;&gt; 8));<br/>
*p++ = &lsquo;.&rsquo;;<br/>
p = to_chars_52(p, uint8_t(address &gt;&gt; 0));<br/>
output.resize(p &#8211; output.data());<br/>
return output;<br/>
}<br/>
class Foo {<br/>
public:<br/>
Foo() {<br/>
for (int i = 0; i &lt; 256; i++) {<br/>
std::string s0 = std::to_string(i);<br/>
std::string s1 = std::string(&ldquo;.&rdquo;) + s0;<br/>
v0[i] = *(int*)s0.data();<br/>
v1[i] = *(int*)s1.data();<br/>
l0[i] = (i &lt; 10) ? 1 : (i &lt; 100 ? 2 : 3);<br/>
l1[i] = l0[i] + 1;<br/>
}<br/>
}<br/>
int v0[256]; // value for the 0th byte<br/>
int v1[256]; // value for the 1+ byte<br/>
int l0[256]; // length for the 0th byte<br/>
int l1[256]; // length for the 1+ byte<br/>
};<br/>
Foo foo;<br/>
std::string ipv61(const uint64_t address) noexcept {<br/>
std::string output(4 * 3 + 3, &lsquo;\0&rsquo;);<br/>
char *point = output.data();<br/>
uint8_t by;<br/>
by = address &gt;&gt; 24;<br/>
*(int*)point = foo.v0[by];<br/>
point += foo.l0[by];<br/>
by = address &gt;&gt; 16;<br/>
*(int*)point = foo.v1[by];<br/>
point += foo.l1[by];<br/>
by = address &gt;&gt; 8;<br/>
*(int*)point = foo.v1[by];<br/>
point += foo.l1[by];<br/>
by = address &gt;&gt; 0;<br/>
*(int*)point = foo.v1[by];<br/>
point += foo.l1[by];<br/>
output.resize(point &#8211; output.data());<br/>
return output;<br/>
}<br/>
</p>
</div>
</li>
<li id="comment-649125" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marcin Zukowski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-02T20:04:23+00:00">February 2, 2023 at 8:04 pm</time></a> </div>
<div class="comment-content">
<p>Argh, copy-pasting somehow doesn&rsquo;t work.<br/>
Created a PR here: <a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/pull/70" rel="nofollow ugc">https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/pull/70</a></p>
<p>BTW, you can extend my idea probably by combining two integers into a long and one write, not sure if it&rsquo;s worth optimizing further though.</p>
</div>
<ol class="children">
<li id="comment-649126" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-02T20:07:06+00:00">February 2, 2023 at 8:07 pm</time></a> </div>
<div class="comment-content">
<p>WordPress insists on stripping codes. Sorry about that. I have had several fixes over the year for this issue, but it stops working with new WordPress updates.</p>
</div>
</li>
<li id="comment-649128" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cb7dbd4dd3d95da35558ef5dedc9042e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cb7dbd4dd3d95da35558ef5dedc9042e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">pg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-02T21:33:24+00:00">February 2, 2023 at 9:33 pm</time></a> </div>
<div class="comment-content">
<p>Hi Marcin,</p>
<p>I made a vectorized version that uses similar ideas to yours: stick the bytes in a u32x4 vector, and do a gather_epi32 from a table. Then remove the 0 bytes with _mm_shuffle_epi8 (like in <a href="https://lemire.me/blog/2017/01/20/how-quickly-can-you-remove-spaces-from-a-string/" rel="ugc">https://lemire.me/blog/2017/01/20/how-quickly-can-you-remove-spaces-from-a-string/</a>).</p>
<p>In the end it&rsquo;s pretty much a wash with your version.</p>
<p><code> std::string output(4 * 3 + 3, '\0');<br/>
char *p = output.data();</p>
<p> __m128i bytes = _mm_cvtepu8_epi32(_mm_set1_epi32(__builtin_bswap32(address)));<br/>
__m128i strs = _mm_i32gather_epi32(table, bytes, 4);<br/>
__m128i zeroes = _mm_cmpeq_epi8(strs, _mm_set1_epi32(0));<br/>
int mask16 = _mm_movemask_epi8(zeroes);<br/>
__m128i x = _mm_shuffle_epi8(strs, _mm_loadu_si128((const __m128i *)despace_mask16 + (mask16 &amp; 0x7fff)));</p>
<p> _mm_storeu_si128((__m128i *)p, x);</p>
<p> output.resize(16 - _mm_popcnt_u32(mask16) - 1);</p>
<p> return output;<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-649138" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marcin Zukowski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-03T20:00:45+00:00">February 3, 2023 at 8:00 pm</time></a> </div>
<div class="comment-content">
<p>Cool. For such small tasks SIMD might be an overkill, but it&rsquo;s great to see that it works. You should send a PR to Daniel. Unfortunately, don&rsquo;t have an x86 machine around to test it.</p>
<p>Another interesting fun task would be to write a non-scalar function (&ldquo;vectorized&rdquo; in database terms, not like SIMD), which would convert many ints into many strings. Wonder if there are some opportunities there, and if that could be much faster than <code>N * time_of_scalar</code></p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-649133" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a41b373bd54e61390502b2dd698153ab?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a41b373bd54e61390502b2dd698153ab?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anonymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-03T11:02:18+00:00">February 3, 2023 at 11:02 am</time></a> </div>
<div class="comment-content">
<p>What about std::stringstream? Is it too slow and thus not worth considering?</p>
</div>
<ol class="children">
<li id="comment-649166" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-06T14:54:08+00:00">February 6, 2023 at 2:54 pm</time></a> </div>
<div class="comment-content">
<p>Added to the benchmark:</p>
<pre>
Time per string in ns.
stringstream        350.224
std::to_string (1)  78.8603
std::to_string (2)  79.012
blog post (similar) 16.5528
blog post           16.2065
Dimov 1             10.8528
Dimov 2             16.7799
Zukowski            3.86899
Zukowski by oc      3.89452
thin table          4.16718
combined table      2.99737
</pre>
</div>
</li>
<li id="comment-649168" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marcin Zukowski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-06T17:10:45+00:00">February 6, 2023 at 5:10 pm</time></a> </div>
<div class="comment-content">
<p>About the <code>std::stringstream</code> suggestion &#8211; I learned the hard way a while back that it should not be used anywhere performance critical. It looks at locale settings, which might result in things like environment varialbe lookups, mutexes etc. Terrible? Yes. Since then I am on a mission to educate people to <code>NOT USE std::stringstream</code> 😀</p>
<p>You can work around this with static variables etc, but it&rsquo;s not worth the complexity.</p>
</div>
</li>
</ol>
</li>
<li id="comment-649154" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-05T13:59:17+00:00">February 5, 2023 at 1:59 pm</time></a> </div>
<div class="comment-content">
<p>It would also be plausible to pack the string (including the ending/preceding period) in a 32-bit integer and one should be able to extract the string with an AND, and the length with an unsigned fixed shift right, which would allow using only one load operation per input byte. Two top bits of all string characters are zero; just put length bits on two topmost bits of the integer&#8230;</p>
<p>With high ALU parallelism it might competitive with two-loads-and-no-arithmetic versions &#8211; also, it should be vectorisable. I suspect I&rsquo;m too lazy to implement it, at least today.</p>
</div>
<ol class="children">
<li id="comment-649156" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-05T14:21:26+00:00">February 5, 2023 at 2:21 pm</time></a> </div>
<div class="comment-content">
<p>It should be plausible to pack both the string and the length in 32-bit integer is what I meant&#8230;</p>
</div>
</li>
<li id="comment-649161" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-06T05:27:44+00:00">February 6, 2023 at 5:27 am</time></a> </div>
<div class="comment-content">
<p>Merge request is in, and this &ldquo;combined table&rdquo; beats others on Mac M1; no idea how it fares on x86.</p>
<p><code>$ ./str<br/>
Running tests.<br/>
Functions are ok.<br/>
Time per string in ns.<br/>
std::to_string (1) 85.8071<br/>
std::to_string (2) 90.9182<br/>
blog post (similar) 18.6132<br/>
blog post 18.5872<br/>
Dimov 1 11.8821<br/>
Dimov 2 18.5636<br/>
Zukowski 4.15277<br/>
Zukowski by oc 4.22096<br/>
thin table 4.54168<br/>
combined table 3.78396<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-649162" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-06T06:08:38+00:00">February 6, 2023 at 6:08 am</time></a> </div>
<div class="comment-content">
<p>And with a minor modification, I was able to push this to 3.3 ns on Mac M1. I wonder how large a portion of that is actually the call to string allocation routine?</p>
</div>
<ol class="children">
<li id="comment-649165" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-06T14:41:02+00:00">February 6, 2023 at 2:41 pm</time></a> </div>
<div class="comment-content">
<p>It is a good question.</p>
</div>
<ol class="children">
<li id="comment-649175" class="comment odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-07T06:20:23+00:00">February 7, 2023 at 6:20 am</time></a> </div>
<div class="comment-content">
<p>I believe the std::string calls (inlined or not) are a significant source of overhead when single-iteration run time of a function, like ipv81, is around 3 nanoseconds. Just eliminating single store saved 6% in run time, and in comparison to hypothetical plain C string variant, the code zeroes the string unnecessarily (optimally one or two stores, depending on microarchitectural details), and does whatever the constructor does, at best (if worse, it could do a lot more), which is pretty certainly more than just a little, since this code doesn&rsquo;t get inlined.</p>
<p>In theory compilers could do better, but apparently not in practice&#8230;</p>
</div>
</li>
<li id="comment-649176" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-07T06:35:23+00:00">February 7, 2023 at 6:35 am</time></a> </div>
<div class="comment-content">
<p>I rewrote ipv81 with plain C, writing a zero-terminated string to a fixed, pre-allocated buffer (and forcing compiler to run all iterations properly, I did check the assembler output). My M1 succeeded running this routine at 1.19 ns/iteration, while earlier variations were 3.04-3.3 ns depending on slight variations in code. So, vast majority of benchmarked time on the fastest variations is probably &ldquo;overhead.&rdquo;</p>
</div>
<ol class="children">
<li id="comment-649178" class="comment odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-07T10:24:40+00:00">February 7, 2023 at 10:24 am</time></a> </div>
<div class="comment-content">
<p>&#8230; and that can be still pushed further, to 1.02 ns, of which probably quarter a nanosecond goes to looping. If lookup table entries are made 64-bit the masking of the string can be avoided, and this allows dropping per-iteration time to 0.88 ns, but I highly doubt that makes much sense in the real world.</p>
<p>So, with hot caches one can achieve roughly one-nanosecond (3.25 cycle) throughput on IPv4 string generation, at least on amenable microarchitectures.</p>
</div>
<ol class="children">
<li id="comment-651121" class="comment even depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ebb53d621ad68a6e34eee7464153958c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ebb53d621ad68a6e34eee7464153958c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">David Fetter</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-20T16:01:32+00:00">April 20, 2023 at 4:01 pm</time></a> </div>
<div class="comment-content">
<p>Did you happen to keep this code around?</p>
</div>
<ol class="children">
<li id="comment-651126" class="comment odd alt depth-8">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-20T17:18:33+00:00">April 20, 2023 at 5:18 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t think I have it on version control, but there wasn&rsquo;t really anything particularly fancy; just handle strings as static C char arrays when possible, and avoid dynamic allocation in inner loops. My general, C++ strings oriented changes are in the repo, though.</p>
<p>One thing I noticed was that these routines didn&rsquo;t really translate <em>that</em> well to x86. Certain idioms of ARM assembler such as barrel shifters integrated to other instructions made the implementation significantly more efficient on ARM than x86.</p>
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
