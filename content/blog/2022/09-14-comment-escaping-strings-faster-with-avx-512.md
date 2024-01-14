---
date: "2022-09-14 12:00:00"
title: "Escaping strings faster with AVX-512"
index: false
---

[22 thoughts on &ldquo;Escaping strings faster with AVX-512&rdquo;](/lemire/blog/2022/09-14-escaping-strings-faster-with-avx-512)

<ol class="comment-list">
<li id="comment-645696" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3132337a1d6c56c8410832d96791a99d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3132337a1d6c56c8410832d96791a99d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Attila</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-15T07:07:09+00:00">September 15, 2022 at 7:07 am</time></a> </div>
<div class="comment-content">
<p>How would this be extended to quote *all* characters that need quoting? Tabs, backslashes and whatnot.</p>
</div>
<ol class="children">
<li id="comment-645715" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-15T15:21:00+00:00">September 15, 2022 at 3:21 pm</time></a> </div>
<div class="comment-content">
<p>It gets trickier, evidently. I might do it in a future blog post.</p>
</div>
<ol class="children">
<li id="comment-645747" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/77fcffd3bc9baf5770d9951b5f1334ef?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/77fcffd3bc9baf5770d9951b5f1334ef?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bernard B</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-16T10:01:04+00:00">September 16, 2022 at 10:01 am</time></a> </div>
<div class="comment-content">
<p>This whole post is outdated. Why do coders fail to keep up with hardware development? The two go hand in hand. Intel have removed avx512 instructions. But the good news is the upcoming 7000 series from AMD have introduced them.</p>
</div>
<ol class="children">
<li id="comment-645784" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2e41d52b2986c0c63a2f464e34b7b3f3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2e41d52b2986c0c63a2f464e34b7b3f3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">no</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-17T05:57:51+00:00">September 17, 2022 at 5:57 am</time></a> </div>
<div class="comment-content">
<p>By &ldquo;removed&rdquo; you mean willingly installed a BIOS update that removes the AVX512 support? I&rsquo;ve go an Alder Lake that has AVX512, and it&rsquo;ll stay that way, because I can read BIOS changelogs.</p>
</div>
<ol class="children">
<li id="comment-648705" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8c5548eb0b2b80924f237953392df5e7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8c5548eb0b2b80924f237953392df5e7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">3yav1xu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-01T13:39:35+00:00">January 1, 2023 at 1:39 pm</time></a> </div>
<div class="comment-content">
<p>If you expect Users to change bios settings in order to run your code on their systems, you will not have any users. Of course if you are writing software for private use this is not a concern.</p>
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
<li id="comment-645699" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/79d02df773a89187e82fddbfa13a6296?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/79d02df773a89187e82fddbfa13a6296?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dennis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-15T08:57:29+00:00">September 15, 2022 at 8:57 am</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,</p>
<p>I made a very similar discovery quite a few years ago in one of my university courses. It was a course on string search algorithms in which we all had to implement one of the algorithms. I decided to to a simple sliding window algorithm. Which one exactly I don&rsquo;t remember but the catch was that I implemented it in x64 Assembler with the use of AVX instructions.</p>
<p>At the end of the course we did a comparision of the different implementations on one machine and needless to say mine blew everything away by far.<br/>
More modern implementations with dictionaries and other improvements stood no chance because of the overhead introduced by the programming languages used.</p>
<p>Your approach using C++ is for sure way easier to implement as I spent weeks learning and debugging assembler in NASM. After all that I wondered if there is any company that&rsquo;s so much in need of performance-optimised code.</p>
</div>
</li>
<li id="comment-645701" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-15T10:08:22+00:00">September 15, 2022 at 10:08 am</time></a> </div>
<div class="comment-content">
<p>`VPEXPANDB` can alternatively be used to do this. You may need to use a PDEP/PEXT combo on the mask to get it to the right place though.</p>
</div>
<ol class="children">
<li id="comment-645712" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-15T15:14:56+00:00">September 15, 2022 at 3:14 pm</time></a> </div>
<div class="comment-content">
<p>I wanted to use `VPEXPANDB initially but I found it easier to go in the other direction.</p>
</div>
</li>
<li id="comment-645718" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3132337a1d6c56c8410832d96791a99d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3132337a1d6c56c8410832d96791a99d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Attila</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-15T17:37:51+00:00">September 15, 2022 at 5:37 pm</time></a> </div>
<div class="comment-content">
<p>Would it still be 5x faster? I am just worrying a bit that someone inexperienced goes and says “yay, five times faster!” and implements a quote without realizing that it does not quote everything. And things like that tend to turn into vulnerabilities.</p>
</div>
<ol class="children">
<li id="comment-645728" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-15T22:43:09+00:00">September 15, 2022 at 10:43 pm</time></a> </div>
<div class="comment-content">
<p>I wouldn&rsquo;t be surprised if it&rsquo;s actually faster, due to reducing shuffle port pressure, but I have no benchmarks. And yes, it fully works. See the following for a bit of a writeup (aim is different, but concept is same):<br/>
<a href="https://www.reddit.com/r/simd/comments/x10e3x/avx512vbmi2_doubling_space/" rel="nofollow ugc">https://www.reddit.com/r/simd/comments/x10e3x/avx512vbmi2_doubling_space/</a></p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-645702" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/275d6ccbf6ac0d40942ed813e1aa38c7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/275d6ccbf6ac0d40942ed813e1aa38c7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">sasuke420</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-15T10:38:34+00:00">September 15, 2022 at 10:38 am</time></a> </div>
<div class="comment-content">
<p>Does it go any faster if you use pshufb then cmpeq_mask instead of two cmpeq_mask and an or?</p>
</div>
<ol class="children">
<li id="comment-645711" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-15T15:14:04+00:00">September 15, 2022 at 3:14 pm</time></a> </div>
<div class="comment-content">
<p>How would that work? Can you provide a code sample?</p>
</div>
<ol class="children">
<li id="comment-645729" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-15T22:50:43+00:00">September 15, 2022 at 10:50 pm</time></a> </div>
<div class="comment-content">
<p>Looks something like</p>
<p>is_quote_or_solidus = _mm512_cmpeq_epi8_mask(<br/>
input1,<br/>
_mm512_shuffle_epi8(input1, _mm512_broadcast_i32x4(_mm_set_epi8(<br/>
0, 0, 0, &lsquo;\\&rsquo;, 0, 0, 0, 0, 0, 0, 0, 0, 0, &lsquo;&rdquo;&lsquo;, 0, -1<br/>
)))<br/>
);</p>
<p>Works better if there&rsquo;s more characters to match, as long as the bottom 4 bits are unique between them (if not, you can prod the data to make it so).</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-645704" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/434718fad75737beed232159b45149dd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/434718fad75737beed232159b45149dd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://xania.org" class="url" rel="ugc external nofollow">Matt Godbolt</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-15T12:18:51+00:00">September 15, 2022 at 12:18 pm</time></a> </div>
<div class="comment-content">
<p>I think I step 4 you mean &ldquo;compare&rdquo;, not &ldquo;copy these bytes with&#8230;&rsquo;</p>
</div>
<ol class="children">
<li id="comment-645714" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-15T15:18:28+00:00">September 15, 2022 at 3:18 pm</time></a> </div>
<div class="comment-content">
<p>Thanks.</p>
</div>
</li>
</ol>
</li>
<li id="comment-645723" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24cfa9591263008553ae4c125b6a9934?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24cfa9591263008553ae4c125b6a9934?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wojciech Mu?a</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-15T20:40:36+00:00">September 15, 2022 at 8:40 pm</time></a> </div>
<div class="comment-content">
<p>The blend __m512i escaped = _mm512_mask_blend_epi8(is_quote_or_solidus, shifted_input1, solidus); can be an unconditional bitwise-OR escaped = _mm512_or_si512(shifted_input1, _mm512_set1_epi16(&lsquo;\\&rsquo;)). Later on, the compress applies the mask.</p>
</div>
<ol class="children">
<li id="comment-645767" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-16T14:55:49+00:00">September 16, 2022 at 2:55 pm</time></a> </div>
<div class="comment-content">
<p>Correct.</p>
</div>
</li>
</ol>
</li>
<li id="comment-645743" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2acbcecf370188ef1fb9651b23adf5fe?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2acbcecf370188ef1fb9651b23adf5fe?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://kopytjuk.github.io/" class="url" rel="ugc external nofollow">Marat Kopytjuk</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-16T07:52:59+00:00">September 16, 2022 at 7:52 am</time></a> </div>
<div class="comment-content">
<p>Thanks for interesting insights! I (an mechatronics engineer working mainly with Python) spent whole evening reading about SIMD/AVX512 and NEON.</p>
<p>I tried to compile the espace.cpp &#8211; but onfortunately it does not build with g++ 9.4 (on my ubuntu20.04-wsl2 windows machine).</p>
<p><a href="https://gcc.gnu.org/bugzilla/show_bug.cgi?id=95483" rel="nofollow ugc">https://gcc.gnu.org/bugzilla/show_bug.cgi?id=95483</a></p>
<p>I think you need min. gcc-11.1.0 for your benchmark.</p>
</div>
<ol class="children">
<li id="comment-645762" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-16T14:14:03+00:00">September 16, 2022 at 2:14 pm</time></a> </div>
<div class="comment-content">
<p>You definitively need a compiler with full support for VBMI2.</p>
</div>
</li>
</ol>
</li>
<li id="comment-645748" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/77fcffd3bc9baf5770d9951b5f1334ef?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/77fcffd3bc9baf5770d9951b5f1334ef?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bernard B</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-16T10:02:20+00:00">September 16, 2022 at 10:02 am</time></a> </div>
<div class="comment-content">
<p>This whole post is outdated. Why do coders fail to keep up with hardware development? The two go hand in hand. Intel have removed avx512 instructions. But the good news is the upcoming 7000 series from AMD have introduced them.</p>
</div>
<ol class="children">
<li id="comment-645763" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-16T14:15:05+00:00">September 16, 2022 at 2:15 pm</time></a> </div>
<div class="comment-content">
<p>Intel has not removed AVX-512 instructions. Some of its processors support AVX-512 instructions, others do not.</p>
</div>
</li>
</ol>
</li>
<li id="comment-649116" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2cd3724ac9efd3405892d8fa9dbe945b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2cd3724ac9efd3405892d8fa9dbe945b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nerijus</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-02T04:45:22+00:00">February 2, 2023 at 4:45 am</time></a> </div>
<div class="comment-content">
<p>Nice article.</p>
<p>Wondering if similar approach can be used implementing KISS frame escapes. I KISS frame every 0xC0 must be replaced into 0xDB and 0xDC and similarly for 0xDB &#8211; to another two bytes .</p>
</div>
</li>
</ol>
