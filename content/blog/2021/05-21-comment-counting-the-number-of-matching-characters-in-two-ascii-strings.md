---
date: "2021-05-21 12:00:00"
title: "Counting the number of matching characters in two ASCII strings"
index: false
---

[14 thoughts on &ldquo;Counting the number of matching characters in two ASCII strings&rdquo;](/lemire/blog/2021/05-21-counting-the-number-of-matching-characters-in-two-ascii-strings)

<ol class="comment-list">
<li id="comment-584654" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bdb513a354c30a33056a303797bfc40c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bdb513a354c30a33056a303797bfc40c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Marc Bommert</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-21T15:45:39+00:00">May 21, 2021 at 3:45 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
An optimizing compiler will turn these function calls into a single<br/>
load instruction.
</p></blockquote>
<p>Mmmh, I would not rely on that. The strinsg have to be aligned to a multiple of 8 byte to do so. How should the compiler know? Maybe in cases where this function is inlined (which would require it to be qualified with static visibility) but not on a general basis I guess.</p>
</div>
<ol class="children">
<li id="comment-584660" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-21T17:33:27+00:00">May 21, 2021 at 5:33 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>The strinsg have to be aligned to a multiple of 8 byte to do so.</p>
</blockquote>
<p>Compilers are hardware-aware are most hardware you might care about (x64, 64-bit ARM) can load data from any address, aligned or not. You should expect these memcpy function call to be compiled to a single instruction. And it is a fast instruction. See my post <a href="https://lemire.me/blog/2012/05/31/data-alignment-for-speed-myth-or-reality/">Data alignment for speed: myth or reality?</a> for more details.</p>
</div>
<ol class="children">
<li id="comment-584676" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bdb513a354c30a33056a303797bfc40c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bdb513a354c30a33056a303797bfc40c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marc Bommert</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-21T20:01:47+00:00">May 21, 2021 at 8:01 pm</time></a> </div>
<div class="comment-content">
<p>You are right. I&rsquo;m in a different domain with mostly 32-Bit ARMs, PPC, MIPS, AVR, where the compiler would generated particular instructons for byte, word and dword access or you would at least get a significant perfomance penalty in the silicon from unaligned access in case the chip is capable of it. Has to be considered and measured for a specific hardware to be really sure here. Thanks for the article. Good to know modern CPUs seem to be so much more merciful here.</p>
</div>
<ol class="children">
<li id="comment-584677" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-21T20:34:43+00:00">May 21, 2021 at 8:34 pm</time></a> </div>
<div class="comment-content">
<p>You are correct, on some old or small processors, there might be a significant performance penalty to unaligned loads, but even then, you&rsquo;d expect the compiler to basically get the job done. If the platform lacks an unaligned load instruction, it will have to do some computations to figure out the alignment, do two loads, and fuse the result. It will be harmful.</p>
<p>But most people do not program for such small processors.</p>
<p>It used to be that &ldquo;mobile&rdquo; computing meant &ldquo;small and limited&rdquo;, but even an old iPhone can do unaligned loads and more.</p>
</div>
<ol class="children">
<li id="comment-584680" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bdb513a354c30a33056a303797bfc40c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bdb513a354c30a33056a303797bfc40c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marc Bommert</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-21T21:39:33+00:00">May 21, 2021 at 9:39 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
it will have to do some computations to figure out the alignment
</p></blockquote>
<p>Well, it can&rsquo;t. That is what I was referring to initially.<br/>
The memcpy implementation will have to respect the aligment dynamically during runtime.</p>
<p>The addresses of s1 and s2 are not known since the function is exported. LTO may catch this, though. Unsure.</p>
</div>
<ol class="children">
<li id="comment-584684" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-21T22:07:02+00:00">May 21, 2021 at 10:07 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>The memcpy implementation will have to respect the aligment dynamically during runtime.</p>
</blockquote>
<p>Well, it cannot know the alignment at compile-time, but it could figure it out at runtime.</p>
<p>However, thinking twice about the problem, I think that what an optimizing compiler might do is load 8 bytes (using 8 instructions) and then combine them using shifts. It is going to be expensive at least in terms of instruction count.</p>
<p>What I described at first would not work because it would entails reading more bytes than necessary.</p>
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
<li id="comment-584658" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f32afb6d9267792eeac2fb2f7556b2f1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f32afb6d9267792eeac2fb2f7556b2f1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Daniel deLamare</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-21T17:06:56+00:00">May 21, 2021 at 5:06 pm</time></a> </div>
<div class="comment-content">
<p>Pardon my ignorance, but couldn&rsquo;t the memcpy be avoided if we instead type x and y and uint64_t* and assign the address instead of copying the bytes? For example: x = (uint64_t*)c1 + i; Or would this be the same or worse after being put through an optimizing compiler?</p>
</div>
<ol class="children">
<li id="comment-584663" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-21T17:37:56+00:00">May 21, 2021 at 5:37 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>couldn’t the memcpy be avoided if we instead type x and y and uint64_t* and assign the address instead of copying the bytes?</p>
</blockquote>
<p>You have to load the data into a register one way or another. A load cannot avoided. Some x64 instructions can take an address as a parameter, but there is effectively a load happening in any case&#8230;</p>
<p>I use memcpy to avoid undefined behaviours. Doing a cast to a wider type is not good C code. You have to use a memcpy or the equivalent (in C, C++).</p>
<blockquote>
<p>Or would this be the same or worse after being put through an optimizing compiler?</p>
</blockquote>
<p>If you are using undefined behaviour, the risk is that the compiler could do something wrong.</p>
<p>Otherwise, I have no way to think that avoid a memcpy could ever speed things up.</p>
</div>
<ol class="children">
<li id="comment-584674" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b9095f7347ba74b6ef7d0144085b006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b9095f7347ba74b6ef7d0144085b006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Vincenzo Romano</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-21T19:22:40+00:00">May 21, 2021 at 7:22 pm</time></a> </div>
<div class="comment-content">
<p>ASCII only</p>
</div>
<ol class="children">
<li id="comment-584679" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-21T21:06:09+00:00">May 21, 2021 at 9:06 pm</time></a> </div>
<div class="comment-content">
<p>I do not understand the comment.</p>
<p>Yes, my code above effectively compares bytes so as-is it assumes ASCII. You can rather easily extend it to UTF-16 if you check for surrogate pairs. Matching UTF-8 characters would be a fun challenge. But then matching UTF-8 would be tricky no matter what.</p>
<p>If you decode to UTF-32 first, then matching the characters fast is the last of your concerns.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-584681" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d269c0228684029dedb75d73b81a64c3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d269c0228684029dedb75d73b81a64c3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Steve Fink</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-21T21:48:42+00:00">May 21, 2021 at 9:48 pm</time></a> </div>
<div class="comment-content">
<p>Note that you specified ASCII, so the high bit will always be clear, so t1 will always be 0x8080808080808080LL.</p>
<p>But (1) your version works for Latin1, and (2) it may be too hard to come up with a new name for matching_bytes_in_word. 😉</p>
<p>(I also don&rsquo;t know if compilers can convert the last line of that function into a popcnt instruction on their own?)</p>
</div>
<ol class="children">
<li id="comment-584682" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-21T22:00:14+00:00">May 21, 2021 at 10:00 pm</time></a> </div>
<div class="comment-content">
<p>You are correct. My code is more general than just ASCII. I actually did not try to optimize for ASCII.</p>
<blockquote>
<p>I also don’t know if compilers can convert the last line of that function into a popcnt instruction on their own?</p>
</blockquote>
<p>I am skeptical.</p>
<p>I only wanted to rely on standard C for this post. You could indeed just call popcnt which, on recent x64 hardware, is probably much cheaper than a shift followed by a multiplication followed by a shift. But I&rsquo;d be impressed if a compiler could figure that out.</p>
<p>The trouble is that if I can assume popcnt, I may as well assume SIMD instructions and the whole problem takes a different turn.</p>
</div>
</li>
</ol>
</li>
<li id="comment-584685" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3347f1852ef13d4019cbc2fe71faef03?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3347f1852ef13d4019cbc2fe71faef03?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dru Nelson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-21T22:14:00+00:00">May 21, 2021 at 10:14 pm</time></a> </div>
<div class="comment-content">
<p>return ((zeros &gt;&gt; 7) * 0x0101010101010101ULL) &gt;&gt; 56;</p>
<p>That one line is quite a gem. I haven&rsquo;t seen that trick before.</p>
<p>Thanks for this post Daniel.</p>
</div>
</li>
<li id="comment-584715" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/772a802341e3848e248626d044dc2493?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/772a802341e3848e248626d044dc2493?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Falk Hüffner</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-22T08:53:40+00:00">May 22, 2021 at 8:53 am</time></a> </div>
<div class="comment-content">
<p><code>zeros</code> in <code>matching_bytes_in_word</code> can be calculated with one instruction less (although it&rsquo;s unlikely to affect speed much):</p>
<p><code>uint64_t matching_bytes_in_word(uint64_t x, uint64_t y) {<br/>
uint64_t xor_xy = x ^ y;<br/>
uint64_t zeros = (((xor_xy &gt;&gt; 1) | 0x8080808080808080) - xor_xy) &amp; 0x8080808080808080;<br/>
return ((zeros &gt;&gt; 7) * 0x0101010101010101ULL) &gt;&gt; 56;<br/>
}<br/>
</code></p>
</div>
</li>
</ol>
