---
date: "2023-07-14 12:00:00"
title: "Recognizing string prefixes with SIMD instructions"
index: false
---

[16 thoughts on &ldquo;Recognizing string prefixes with SIMD instructions&rdquo;](/lemire/blog/2023/07-14-recognizing-string-prefixes-with-simd-instructions)

<ol class="comment-list">
<li id="comment-652966" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/609b16e9fe24dc905fdb9e4f7114197a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/609b16e9fe24dc905fdb9e4f7114197a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Wayne Scott</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-14T10:12:20+00:00">July 14, 2023 at 10:12 am</time></a> </div>
<div class="comment-content">
<p>You could also just build a DFA:</p>
<p><code>const int num_tokens = ...;<br/>
const int num_states = ...;<br/>
int char2token[256] = { ... };<br/>
int statetable[num_states][num_tokens] = {...};</p>
<p>bool match(const char *str)<br/>
{<br/>
int s = 0;<br/>
while (*str &amp;&amp; s &gt;= 0) {<br/>
int tok = char2token(*str);<br/>
s = statetable[s][tok];<br/>
}<br/>
return (s == -1);<br/>
}<br/>
</code></p>
<p>A state of -2 might be the non-matching condition.</p>
<p>The single branch here is way more predictable than your switch tables.</p>
</div>
<ol class="children">
<li id="comment-652967" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/609b16e9fe24dc905fdb9e4f7114197a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/609b16e9fe24dc905fdb9e4f7114197a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Wayne Scott</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-14T10:15:00+00:00">July 14, 2023 at 10:15 am</time></a> </div>
<div class="comment-content">
<p>missing the ++ on this line:`</p>
<p><code>int tok = char2token[*str++];<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-652971" class="comment byuser comment-author-lemire bypostauthor even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-14T13:19:05+00:00">July 14, 2023 at 1:19 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s true, it is a viable approach worth testing.</p>
</div>
<ol class="children">
<li id="comment-652972" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-14T13:23:12+00:00">July 14, 2023 at 1:23 pm</time></a> </div>
<div class="comment-content">
<p>Note that you can&rsquo;t just process the whole input string. In my model, the input string could be infinite for all we know. So you need more branching to terminate the processing.</p>
</div>
<ol class="children">
<li id="comment-652973" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/609b16e9fe24dc905fdb9e4f7114197a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/609b16e9fe24dc905fdb9e4f7114197a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wayne Scott</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-14T14:04:51+00:00">July 14, 2023 at 2:04 pm</time></a> </div>
<div class="comment-content">
<p>No, my code sample will stop when it hits a null or an exit state that indicates the starting place couldn&rsquo;t possibly be one of your N prefixes. The state machine indicates you are still matching one or more of the prefixes. We can even have N negative states to return which prefix was matched and an additional state for &ldquo;no match&rdquo;.</p>
</div>
<ol class="children">
<li id="comment-652975" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-14T14:27:42+00:00">July 14, 2023 at 2:27 pm</time></a> </div>
<div class="comment-content">
<p>I stand corrected, I misread your code.</p>
</div>
<ol class="children">
<li id="comment-652994" class="comment byuser comment-author-lemire bypostauthor even depth-7">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-15T18:07:40+00:00">July 15, 2023 at 6:07 pm</time></a> </div>
<div class="comment-content">
<p>I have added my implementation and updated the blog post.</p>
</div>
</li>
</ol>
</li>
<li id="comment-652985" class="comment odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-15T06:11:17+00:00">July 15, 2023 at 6:11 am</time></a> </div>
<div class="comment-content">
<p>There are several ways to still reduce branch misprediction penalties on DFA code: one can stop advancing the input pointer using branchless code after seeing a specific terminator, or one can use &ldquo;don&rsquo;t care&rdquo; DFA states on a longer buffer, which doesn&rsquo;t even need to be zero-padded from the end. This way one can effectively run the loop a fixed number of iterations without unpredictable branches &#8211; which is practical if the length of possible input strings doesn&rsquo;t vary much, but if it does this is not such a great idea.</p>
<p>Of course the issue with general-purpose DFAs is that even the L1 load-to-load latency tends to be like three cycles, and you can&rsquo;t really parallelise an individual DFA.</p>
<p>There&rsquo;s earlier code for a compact DFA with variations in the repo: <a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/b067aa68e3810de200c2b575e9130d54aeeb118d/2022/12/29/protocol.cpp#L98-L361" rel="nofollow ugc">https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/b067aa68e3810de200c2b575e9130d54aeeb118d/2022/12/29/protocol.cpp#L98-L361</a> &#8211; it does only a match instead of separating between different correct matches but it could be easily extended to also return an index of recognised input&#8230;</p>
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
<li id="comment-652987" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-15T08:57:57+00:00">July 15, 2023 at 8:57 am</time></a> </div>
<div class="comment-content">
<p>There&rsquo;s another method which doesn&rsquo;t demand state table lookup dependency chains. One can create a bit vector where every bit represents a possible matching string position. On a table of masks those bits which correspond to a matching character at specific position for a specific string are set &#8211; single-character multiple choices/wildcards/don&rsquo;t cares are possible by setting more bits. Now a match can be sought simply by looking up mask value for every character position in the input and ANDing these together, and looking for bits which are still set on the input.</p>
<p>Since the benchmark on this blog post has over 64 candidate matches and compiles gracefully only on x86 I didn&rsquo;t experiment with this approach in this case, but it should be possible to at least match typical DFA performance for small number of potential string matches.</p>
</div>
<ol class="children">
<li id="comment-652999" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-15T18:33:47+00:00">July 15, 2023 at 6:33 pm</time></a> </div>
<div class="comment-content">
<p>Because we have lots of strings, with various lengths, it would be hard to avoid doing a bunch of branching in the approach you propose?</p>
<p><em>compiles gracefully only on x86</em></p>
<p>Yes. It is specific to x86 at this time (old Westmere processors), but can be ported with relative ease to more recent (e.g., AVX-2, AVX-512, NEON) systems.</p>
</div>
<ol class="children">
<li id="comment-653001" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-15T20:23:38+00:00">July 15, 2023 at 8:23 pm</time></a> </div>
<div class="comment-content">
<p>Well, it depends. One might have only couple unpredictable branches as a compromise. It might help, especially if there would be a practical cut-off for this purpose. I do doubt if there&rsquo;s much of a benefit, though, as long as efficient hashing works.</p>
<p>No problem with the fact this code is x86 only &#8211; just that formulating my code in a benchmarkable fashion is a bit tedious today. 😐</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-653045" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-17T17:07:26+00:00">July 17, 2023 at 5:07 pm</time></a> </div>
<div class="comment-content">
<p>I fiddled with this problem back then, and I came up with a method of building byte-sized running hashes. The property of the running hash is that it will emit the same bytes for identical prefixes, and it doesn&rsquo;t need to know where the string ends, so it can be built for a fixed-size chunk of the input string and compared bytewise for matches.</p>
<p>The matching step is to compare the prefix hash byte at the end of each string in the table (preprocessed) to the corresponding byte in the hashed input string, extracted with pshufb. Any hits then have to be compared against the original of course.</p>
<p>An easy 8-byte running hash is (little-endian) multiplication by a constant.</p>
</div>
<ol class="children">
<li id="comment-653047" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-17T19:12:57+00:00">July 17, 2023 at 7:12 pm</time></a> </div>
<div class="comment-content">
<p>@KWillets Can you elaborate?</p>
</div>
<ol class="children">
<li id="comment-653064" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-18T15:44:35+00:00">July 18, 2023 at 3:44 pm</time></a> </div>
<div class="comment-content">
<p>Here&rsquo;s the github, sorry I didn&rsquo;t have it handy when posting earlier: <a href="https://github.com/KWillets/prefix_in_table/blob/master/prefix_set.cpp" rel="nofollow ugc">https://github.com/KWillets/prefix_in_table/blob/master/prefix_set.cpp</a></p>
<p>That code only indicates a hash match; a full string match is also needed.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-653071" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/530ee6794861e89d935ced6a18bb87a4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/530ee6794861e89d935ced6a18bb87a4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jeff Plaisance</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-18T20:57:24+00:00">July 18, 2023 at 8:57 pm</time></a> </div>
<div class="comment-content">
<p>I tested out doing this with vectorscan (hyperscan) 5.4.9 on an AMD 7950x3d with the following results:</p>
<p><code>sse_type : 1.82 GB/s 481.4 Ma/s 2.08 ns/d 5.48 GHz 11.39 c/d 44.00 i/d 3.0 c/b 11.67 i/b 3.86 i/c<br/>
sse_table : 1.61 GB/s 426.5 Ma/s 2.34 ns/d 5.46 GHz 12.80 c/d 50.00 i/d 3.4 c/b 13.26 i/b 3.91 i/c<br/>
simple_trie : 0.37 GB/s 97.6 Ma/s 10.25 ns/d 5.66 GHz 57.99 c/d 44.58 i/d 15.4 c/b 11.82 i/b 0.77 i/c<br/>
bsearch : 0.09 GB/s 24.8 Ma/s 40.33 ns/d 5.56 GHz 224.30 c/d 332.53 i/d 59.5 c/b 88.19 i/b 1.48 i/c<br/>
sse_length : 2.70 GB/s 716.9 Ma/s 1.39 ns/d 5.23 GHz 7.30 c/d 19.00 i/d 1.9 c/b 5.04 i/b 2.60 i/c<br/>
finite_match : 0.62 GB/s 165.4 Ma/s 6.05 ns/d 5.43 GHz 32.85 c/d 63.02 i/d 8.7 c/b 16.71 i/b 1.92 i/c<br/>
std::lower_bound : 0.05 GB/s 13.6 Ma/s 73.45 ns/d 5.50 GHz 403.78 c/d 665.70 i/d 107.1 c/b 176.55 i/b 1.65 i/c<br/>
vectorscan : 0.10 GB/s 27.6 Ma/s 36.26 ns/d 5.51 GHz 199.84 c/d 537.14 i/d 53.0 c/b 142.46 i/b 2.69 i/c<br/>
</code></p>
<p>I was expecting vectorscan to do better than that and found this result somewhat surprising. I think case insensitive matching is having a significant impact on vectorscan&rsquo;s performance on this task.</p>
</div>
</li>
<li id="comment-653674" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/77e4428df13e21425afb490a7e2098cd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/77e4428df13e21425afb490a7e2098cd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Markus Schaber</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-08-09T13:33:44+00:00">August 9, 2023 at 1:33 pm</time></a> </div>
<div class="comment-content">
<p>I had a similar problem those days, but my code already knew the position of the separator char, and thus, the length of the string to match.<br/>
So I could just skip when the length was smaller than the shortest keyword, or longer than the longest keyword.<br/>
Also, I had only 1 or 2 keywords with the same length, so using the length as preselection criteria came naturally.</p>
</div>
</li>
</ol>
