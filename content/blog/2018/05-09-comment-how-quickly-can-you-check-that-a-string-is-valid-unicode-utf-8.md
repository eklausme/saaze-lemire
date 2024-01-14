---
date: "2018-05-09 12:00:00"
title: "How quickly can you check that a string is valid unicode (UTF-8)?"
index: false
---

[20 thoughts on &ldquo;How quickly can you check that a string is valid unicode (UTF-8)?&rdquo;](/lemire/blog/2018/05-09-how-quickly-can-you-check-that-a-string-is-valid-unicode-utf-8)

<ol class="comment-list">
<li id="comment-302950" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-09T07:34:39+00:00">May 9, 2018 at 7:34 am</time></a> </div>
<div class="comment-content">
<p>The multibyte sequences basically start (in the high bits) with a unary count of the bytes to follow, and the following bytes all start with 10. So if each byte knows the 3 bytes to its right, it can figure out what it should look like if it&rsquo;s the initial byte of a sequence. A simple bitmap is sufficient to build this branchlessly (the sequence must be contiguous, ie the first non-10 byte ends the frame, so a bitmap is needed).</p>
<p>A rough idea:</p>
<p>mask in all 10xxx bytes, map them to 0x01, 0x00 otherwise.<br/>
shift left 2x and concatenate low bits, eg 0x0101 =&gt; 0x03. (not easy in SSE)<br/>
mask off the 3-bit maps and map them to correct unary, eg 101 =&gt; 100.<br/>
In byte positions which really are initial, compare constructed unary with original input. </p>
<p>There are a few other parts to look for ascii and check ranges, but the multibyte structure seems solvable with this method.</p>
</div>
<ol class="children">
<li id="comment-302990" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-09T15:27:42+00:00">May 9, 2018 at 3:27 pm</time></a> </div>
<div class="comment-content">
<p>I think something like what you describe can be worked out.</p>
</div>
<ol class="children">
<li id="comment-302999" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-09T17:21:33+00:00">May 9, 2018 at 5:21 pm</time></a> </div>
<div class="comment-content">
<p>Another approach is sort of the reverse of that &#8212; translate the upper 4 bits to a following byte count and roll it right with saturating subtract. Output is nonzero where 01xxxxxx bytes should be.</p>
</div>
<ol class="children">
<li id="comment-303025" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-09T21:37:14+00:00">May 9, 2018 at 9:37 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s a hopeful direction!</p>
</div>
<ol class="children">
<li id="comment-303121" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-10T18:43:54+00:00">May 10, 2018 at 6:43 pm</time></a> </div>
<div class="comment-content">
<p>I emailed you some code, but for others here, I implemented this method and got about 16 SSE instructions to validate that the right types of bytes (ascii, continuation, 2-3-4 byte initials) are in the right places, including the lengths of continuations.</p>
<p>The remaining parts are overlong sequences (basically numbers that should be encoded in fewer bytes, eg a 7-bit number encoded in a 2-byte sequence) and certain excluded ranges.</p>
<p>I haven&rsquo;t benchmarked yet, but the work so far looks like about 1 cycle/byte. The remaining checks may push that up quite a bit however.</p>
</div>
<ol class="children">
<li id="comment-303154" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-11T01:40:11+00:00">May 11, 2018 at 1:40 am</time></a> </div>
<div class="comment-content">
<p>Yes. Thanks for the code. We&rsquo;ll hopefully discuss it some more in the near future.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-605850" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eb264fc6a5312560a1ce86dfe5622ced?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eb264fc6a5312560a1ce86dfe5622ced?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/milahu/alchi" class="url" rel="ugc external nofollow">milahu</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-11-09T07:49:46+00:00">November 9, 2021 at 7:49 am</time></a> </div>
<div class="comment-content">
<p>valid unicode byte ranges in decimal</p>
<p>converted with [hex2dec.py](<a href="https://stackoverflow.com/a/43545026/10440128" rel="nofollow ugc">https://stackoverflow.com/a/43545026/10440128</a>)</p>
<p>First Byte | Second Byte | Third Byte | Fourth Byte<br/>
&#8212; | &#8212; | &#8212; | &#8212;<br/>
[0,127] |   |   |  <br/>
[194,223] | [128,191] |   |  <br/>
224 | [160,191] | [128,191] |  <br/>
[225,236] | [128,191] | [128,191] |  <br/>
237 | [128,159] | [128,191] |  <br/>
[238,239] | [128,191] | [128,191] |  <br/>
240 | [144,191] | [128,191] | [128,191]<br/>
[241,243] | [128,191] | [128,191] | [128,191]<br/>
244 | [128,143] | [128,191] | [128,191]</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-303046" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6c42283aeb1521ae0e27bd41b7fdb227?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6c42283aeb1521ae0e27bd41b7fdb227?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anthony</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-09T23:31:01+00:00">May 9, 2018 at 11:31 pm</time></a> </div>
<div class="comment-content">
<p>Damnit, my thoughts exactly. I guess that means you must have the right idea.</p>
</div>
</li>
</ol>
</li>
<li id="comment-302975" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d2859a9c8b49548871130fdb74eee4d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d2859a9c8b49548871130fdb74eee4d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Moschops</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-09T12:50:05+00:00">May 9, 2018 at 12:50 pm</time></a> </div>
<div class="comment-content">
<p>If char is unsigned, as permitted, does the function <em>is_ascii</em> still work?</p>
</div>
<ol class="children">
<li id="comment-302988" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-09T15:22:17+00:00">May 9, 2018 at 3:22 pm</time></a> </div>
<div class="comment-content">
<p>My code uses a different convention (signed char) than my prose and it can be confusing.</p>
<p>If you rewite the function so that it takes unsigned char inputs, as is assumed in the text, then you need to change the check for something like &ldquo;is the value greater than or equal to 128&rdquo;.</p>
<p>Otherwise it is all equivalent from a practical point of view.</p>
</div>
<ol class="children">
<li id="comment-303013" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7edfa54ae01d1b58540d8785c73b04e6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7edfa54ae01d1b58540d8785c73b04e6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">JJ</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-09T20:53:57+00:00">May 9, 2018 at 8:53 pm</time></a> </div>
<div class="comment-content">
<p>This isn&rsquo;t about rewriting the function to take unsigned char inputs, this is about the fact that the plain &ldquo;char&rdquo; inputs in your code snippet may be unsigned already (whether &ldquo;char&rdquo; is the same as &ldquo;signed char&rdquo; or &ldquo;unsigned char&rdquo; is not guaranteed by the standard; it is left up to the implementation in question).</p>
<p>So your function only works some of the time (i.e. on systems+compilers where &ldquo;char&rdquo; is &ldquo;signed char&rdquo;) and fails on others (i.e. on systems+compilers where &ldquo;char&rdquo; is &ldquo;unsigned char&rdquo;).</p>
</div>
<ol class="children">
<li id="comment-303022" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-09T21:35:16+00:00">May 9, 2018 at 9:35 pm</time></a> </div>
<div class="comment-content">
<p>If you want to be pedantic then there is no reason to believe that the system is using two&rsquo;s complement, which I assume&#8230; and, of course, my code assumes support for SSE 4.2 instructions which are in no way provided by the standard. I also use online assembly specific to recent x86 processors. I also assume that chars are octets, not something specified in the standard.</p>
</div>
<ol class="children">
<li id="comment-303037" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7edfa54ae01d1b58540d8785c73b04e6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7edfa54ae01d1b58540d8785c73b04e6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">JJ</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-09T22:27:49+00:00">May 9, 2018 at 10:27 pm</time></a> </div>
<div class="comment-content">
<p>Don&rsquo;t be so defensive, there&rsquo;s no need. Someone asked a question (&ldquo;will your code work where characters are unsigned&rdquo;) and you misinterpreted the question and answered some other question. I clarified the question for you; no one&rsquo;s trying to pick your code apart and be pedantic&#8230;</p>
<p>And there are plenty of systems in use where chars are unsigned. PowerPC is one of them. Also gcc has an &ldquo;-funsigned-char&rdquo; option that makes chars unsigned everywhere.</p>
<p>But that&rsquo;s not the point&#8230;</p>
</div>
<ol class="children">
<li id="comment-303040" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-09T22:56:50+00:00">May 9, 2018 at 10:56 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s a reasonable point of view.</p>
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
<li id="comment-303047" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6c42283aeb1521ae0e27bd41b7fdb227?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6c42283aeb1521ae0e27bd41b7fdb227?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anthony</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-09T23:46:45+00:00">May 9, 2018 at 11:46 pm</time></a> </div>
<div class="comment-content">
<p>To do an initial check to see if the entire string is ascii, couldn&rsquo;t you do a bitwise operation to check if all bytes match the pattern 0xxxxxxx? Like run one operation across all of them at once, so they are checking themselves (so to speak) as well as the provided mask? Or am I talking magic talk? (Which isn&rsquo;t uncommon for when my limited understanding of logic meets my even more limited understanding of lower level programming.)</p>
</div>
<ol class="children">
<li id="comment-303049" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-09T23:55:09+00:00">May 9, 2018 at 11:55 pm</time></a> </div>
<div class="comment-content">
<p>You are correct. What you are describing is likely faster if you expect the string to be ASCII, most of the time.</p>
</div>
</li>
<li id="comment-303055" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-10T03:00:56+00:00">May 10, 2018 at 3:00 am</time></a> </div>
<div class="comment-content">
<p>Goffart&rsquo;s code uses pmovmskb to move a mask of the high bits of each char into an int for this reason. Since it&rsquo;s already keyed off of the high bit, it&rsquo;s one instruction.</p>
</div>
</li>
</ol>
</li>
<li id="comment-303119" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d1a2c96c8d962a955cbe35e3fb6c1e1c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d1a2c96c8d962a955cbe35e3fb6c1e1c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Luu Vinh Phuc</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-10T17:11:01+00:00">May 10, 2018 at 5:11 pm</time></a> </div>
<div class="comment-content">
<p>I haven&rsquo;t tried running your code but that checking for UTF-8 representation isn&rsquo;t simply check the byte ranges like you said above because it has many more rules like the bytes for a code point must be the shortest possible.</p>
<blockquote>
<p> All of the two-byte characters are made of a byte in [0xC2,0xDF] followed by a byte in [0x80,0xBF].<br/>
There are four types of characters made of three bytes. For example, if the first by is 0xE0, then the next byte must be in [0xA0,0xBF] followed by a byte in [0x80,0xBF].</p>
</blockquote>
<p>For example although C0 9F is a correct 2-byte sequence according the above statement, it&rsquo;s not actually valid UTF-8 because it should be represented as 6F in UTF-8 which is the shortest form. Encoding code points that are surrogate pairs is also prohibited. For example ED A0 81 is also invalid because it decodes into D801 which is a surrogate</p>
</div>
<ol class="children">
<li id="comment-303155" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-11T01:42:08+00:00">May 11, 2018 at 1:42 am</time></a> </div>
<div class="comment-content">
<p>Thanks for your comment.</p>
</div>
</li>
<li id="comment-303223" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-11T18:12:46+00:00">May 11, 2018 at 6:12 pm</time></a> </div>
<div class="comment-content">
<p>0xC0 &lt; 0xC2.</p>
<p>I didn&rsquo;t check too closely, but the overlong sequences are all defined as having 0&rsquo;s in their high bits down to the next smaller bit width, eg bits [7:10] of the 11-bit 2-byte encoding should have at least one 1 bit, and that translates to a minimum of 0xC2 in the 2-byte initial. So minimum thresholds (sometimes carried across 2 bytes) are sufficient to prevent overlongs.</p>
<p>The <a href="https://en.wikipedia.org/wiki/UTF-8" rel="nofollow">UTF-8 wiki page</a> has a clearer table of bit patterns and forbidden sequences. <a href="https://en.wikipedia.org/wiki/UTF-8" rel="nofollow ugc">https://en.wikipedia.org/wiki/UTF-8</a>. One thing they note is that the encoded sequences sort lexicographically to the same order as the integers they encode, so ranges, maxima, etc. translate across as well.</p>
</div>
</li>
</ol>
</li>
</ol>
