---
date: "2021-05-28 12:00:00"
title: "Computing the number of digits of an integer quickly"
index: false
---

[32 thoughts on &ldquo;Computing the number of digits of an integer quickly&rdquo;](/lemire/blog/2021/05-28-computing-the-number-of-digits-of-an-integer-quickly)

<ol class="comment-list">
<li id="comment-585384" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fe8b5a83c7d5db95a67d616dde60935d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fe8b5a83c7d5db95a67d616dde60935d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Pawel Palinkiewicz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-28T20:21:14+00:00">May 28, 2021 at 8:21 pm</time></a> </div>
<div class="comment-content">
<p>I have arrived at n=floor( log10(integer) +1 )<br/>
Finding a proof of this formula would be interesting. I guess derivation of it is the proof itself.</p>
<p>python version is, of course, len(str(integer))</p>
</div>
<ol class="children">
<li id="comment-585421" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">George Spelvin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-29T06:04:12+00:00">May 29, 2021 at 6:04 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
I have arrived at n=floor( log10(integer) +1 )
</p></blockquote>
<p>Note that this cannot work for integers more than 2^53 or so, which cannot be represented exactly by IEEE double. The IEEE double-precision format can&rsquo;t distinguish between 10^17 &#8211; 1 = ‭0x16345785d89ffff‬ and 10^17 = ‭0x16345785d8a0000‬. (In fact, it doesn&rsquo;t work for me for 10^15 &#8211; 1, but that depends on the vagaries of the log10() implementation.)</p>
<p>(Also, floating-point logarithms are not quick.)</p>
</div>
</li>
</ol>
</li>
<li id="comment-585394" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/45d4a7ba0fb8e789356f5da87536444d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/45d4a7ba0fb8e789356f5da87536444d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.zverovich.net/" class="url" rel="ugc external nofollow">Victor Zverovich</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-28T23:12:41+00:00">May 28, 2021 at 11:12 pm</time></a> </div>
<div class="comment-content">
<p>Please note that this may give a wrong answer for 0 because the result of __builtin_clz for 0 is undefined. A common fix is to OR __builtin_clz&rsquo;s argument with 1.</p>
</div>
</li>
<li id="comment-585434" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6504fad0830c1dd03086ee35097cea11?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6504fad0830c1dd03086ee35097cea11?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">camel-cdr</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-29T10:04:46+00:00">May 29, 2021 at 10:04 am</time></a> </div>
<div class="comment-content">
<p>I found that the assembly of</p>
<p><code>int digit_count(uint32_t x) {<br/>
static uint32_t table[] = {9, 99, 999, 9999, 99999, 999999, 9999999, 99999999, 999999999};<br/>
int y = (9 * (31 - __builtin_clz(x|1))) &gt;&gt; 5;<br/>
y += x &gt; table[y];<br/>
return y + 1;<br/>
}<br/>
</code></p>
<p>looks a slightly faster, because the multiply by 9 can be done using lea instead of imul: <a href="https://godbolt.org/z/rGx43MzTs" rel="nofollow ugc">https://godbolt.org/z/rGx43MzTs</a></p>
</div>
<ol class="children">
<li id="comment-585450" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-29T15:25:01+00:00">May 29, 2021 at 3:25 pm</time></a> </div>
<div class="comment-content">
<p>You are correct, it should reduce the latency. I think it works with both x64 and other ISAs as well (including ARM).</p>
</div>
</li>
</ol>
</li>
<li id="comment-585476" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/134b8de0aceaba40d4b30757a3bffd48?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/134b8de0aceaba40d4b30757a3bffd48?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Josh Bleecher Snyder</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-29T21:43:00+00:00">May 29, 2021 at 9:43 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for ruining my Saturday morning. 😛</p>
<p>Here&rsquo;s a digit count that takes a slightly different approach: Fix up the input to <code>int_log2</code> so that the rounding doesn&rsquo;t matter. When compiled with clang 12.0.0, it shaves an extra instruction off. Note that to get good compiled code, I had to add <code>-O3</code> and change the definition of <code>int_log2</code> a bit. (Two changes: Move <code>|1</code> to the caller for more control, and use <code>31^</code> instead of <code>31-</code> so that the compiler could do a better elimination job.)</p>
<p><code>int int_log2(uint32_t x) { return 31 ^ __builtin_clz(x); }</p>
<p>int digit_count(uint32_t x) {<br/>
static uint32_t table[] = {<br/>
0, 0, 0, (1&lt;&lt;4) - 10,<br/>
0, 0, (1&lt;&lt;7) - 100,<br/>
0, 0, (1&lt;&lt;10) - 1000,<br/>
0, 0, 0, (1&lt;&lt;14) - 10000,<br/>
0, 0, (1&lt;&lt;17) - 100000,<br/>
0, 0, (1&lt;&lt;20) - 1000000,<br/>
0, 0, 0, (1&lt;&lt;24) - 10000000,<br/>
0, 0, (1&lt;&lt;27) - 100000000,<br/>
0, 0, (1&lt;&lt;30) - 1000000000,<br/>
0, 0,<br/>
};<br/>
int l2 = int_log2(x);<br/>
x += table[l2];<br/>
l2 = int_log2(x|1);<br/>
int ans = (77*l2)&gt;&gt;8;<br/>
return ans + 1;<br/>
}<br/>
</code></p>
<p>Perhaps it can be improved further.</p>
<p>I also have a reasonably optimized Go implementation that I&rsquo;ll probably publish soon. (I&rsquo;ll leave a note here if/when I do.)</p>
<p><a href="https://godbolt.org/z/W8Wc1bK3M" rel="nofollow ugc">https://godbolt.org/z/W8Wc1bK3M</a></p>
</div>
<ol class="children">
<li id="comment-585780" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">George Spelvin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-02T08:09:15+00:00">June 2, 2021 at 8:09 am</time></a> </div>
<div class="comment-content">
<p>This us, unfortunately, silly. You&rsquo;re calling ilog2 twice and using a larger table (one entry per bit rather than one per digit). All to save one conditional increment (e.g. compare, <a href="https://www.felixcloutier.com/x86/setcc" rel="nofollow ugc">SETcc</a>, add, or subtract, shift-right, add).</p>
</div>
<ol class="children">
<li id="comment-585802" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/134b8de0aceaba40d4b30757a3bffd48?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/134b8de0aceaba40d4b30757a3bffd48?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Josh Bleecher Snyder</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-02T16:38:32+00:00">June 2, 2021 at 4:38 pm</time></a> </div>
<div class="comment-content">
<p>It may be many things, but I do not believe it is silly.</p>
<p>On my M1 laptop, it performs incrementally better than the post&rsquo;s code. To run the entire 32 bit range, the 9*x&gt;&gt;5 approach takes 2.75s; this takes 2.67s.</p>
<p>On my 2016 intel laptop, it performs worse, but I believe that that is because of a compiler shortcoming. When I use inline assembly thus:</p>
<p><code>int in_asm(uint32_t x) {<br/>
static uint64_t table[] = {16, 14, 12, 246, 240, 224, 3996, 3968, 3840, 64536, 64512, 63488, 61440, 1038576, 1032192, 1015808, 16677216, 16646144, 16515072, 267435456, 267386880, 266338304, 264241152, 4284967296, 4278190080, 4261412864, 68619476736, 68585259008, 68451041280, 1098511627776, 1098437885952, 1097364144128};<br/>
int ret;<br/>
__asm__ (<br/>
"movl %%eax, %%edx;"<br/>
"orl $1, %%edx;"<br/>
"bsrl %%edx, %%edx;"<br/>
"addq (%%rbx,%%rdx,8), %%rax;"<br/>
"bsrq %%rax, %%rax;"<br/>
"sarl $2, %%eax;"<br/>
: "=a" (ret)<br/>
: "a" (x), "b" (table)<br/>
: "dx"<br/>
);<br/>
return ret;<br/>
}<br/>
</code></p>
<p>I get the original code takes 4.09s to process all 32 bit integers, and the asm takes 3.03s. (This isn&rsquo;t entirely fair, as I made no attempt to hand-optimize the original code. But I think it is enough to establish that this isn&rsquo;t silly.)</p>
<p>It is unfortunate that BSR has such a significant latency.</p>
<p>Even if this wasn&rsquo;t faster at all, I think it is interesting, because it is a fairly different kind of approach. It stemmed from the observation that the lookup table isn&rsquo;t doing that much work. I was curious whether the lookup table could eliminate much of the extra calculations, which it turns out it can (no increments, lets us use x / 4 instead of 9x / 32).</p>
</div>
<ol class="children">
<li id="comment-585804" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-02T17:07:43+00:00">June 2, 2021 at 5:07 pm</time></a> </div>
<div class="comment-content">
<p>It looks like AMD processors (Zen+, Zen2 and Zen3) have the lzcnt instruction with a short (1 cycle) latency.</p>
<p>I was surprised at the 3 cycle latency for bsr. I somehow assumed in my head that it was a 1-cycle instruction.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-585478" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/134b8de0aceaba40d4b30757a3bffd48?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/134b8de0aceaba40d4b30757a3bffd48?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Josh Bleecher Snyder</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-29T22:16:32+00:00">May 29, 2021 at 10:16 pm</time></a> </div>
<div class="comment-content">
<p>Go package: <a href="https://github.com/josharian/log10" rel="nofollow ugc">https://github.com/josharian/log10</a></p>
<p>There&rsquo;s more to do on it, but I&rsquo;ve already wasted too much of the day&#8230;</p>
</div>
</li>
<li id="comment-585526" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thomas Müller Graf</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-30T07:55:59+00:00">May 30, 2021 at 7:55 am</time></a> </div>
<div class="comment-content">
<p>There&rsquo;s a relatively large number of github repositories that fork <a href="https://github.com/miloyip/itoa-benchmark" rel="nofollow ugc">https://github.com/miloyip/itoa-benchmark</a> . I also spent some time on this challenge. I have used a very similar approach: <a href="https://github.com/thomasmueller/itoa-benchmark/blob/master/src/tmueller.cpp#L108" rel="nofollow ugc">https://github.com/thomasmueller/itoa-benchmark/blob/master/src/tmueller.cpp#L108</a></p>
<p><code>int zeros = 64 - __builtin_clzl(v);<br/>
int len = (1233 * zeros) &gt;&gt; 12;<br/>
uint64_t p10 = POW_10[len];<br/>
if (v &gt;= p10) {<br/>
len++;<br/>
}<br/>
</code></p>
</div>
</li>
<li id="comment-585530" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eee0b68f7271e22bf075564408f45e44?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eee0b68f7271e22bf075564408f45e44?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Martin Capousek</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-30T10:31:36+00:00">May 30, 2021 at 10:31 am</time></a> </div>
<div class="comment-content">
<p>Just for fun I would try this approach&#8230; use : log10(x) = log2(x) / log2(10)</p>
<p>const float Recip_Log2_10 = 1f / log2( 10f );</p>
<p>digit_count( x ) = 1 + (int)( log2(x) * Recip_Log2_10 )</p>
<p>But instead of floating math do it in fixed-point?</p>
<p>const int Recip_Log2_10 = (int)(( 1f / log2( 10f ) &lt;&lt; 24 )</p>
<p>digit_count( x ) = 1 + ( log2(x) * Recip_Log2_10 ) &gt;&gt; 24</p>
<p>Its is on 99% total bulshit or at least 2 order slower&#8230; but that me 🙂</p>
</div>
</li>
<li id="comment-585555" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/134b8de0aceaba40d4b30757a3bffd48?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/134b8de0aceaba40d4b30757a3bffd48?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Josh Bleecher Snyder</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-30T19:31:08+00:00">May 30, 2021 at 7:31 pm</time></a> </div>
<div class="comment-content">
<p>Congrats, you ruined Sunday, too. 🙂</p>
<p>I got it down to 5 instructions! (Well, it should be five, but clang and gcc each emit 6, because each sees an optimization the other missed.)</p>
<p><code> bsr eax, edi<br/>
mov ecx, edi<br/>
add rcx, qword ptr [8*rax + j_digit_count.table]<br/>
bsr rax, rcx<br/>
sar eax, 2<br/>
</code></p>
<p>(gcc emits two movs after the first bsr; clang emits xor shr xor instead of sar.)</p>
<p>Code is:</p>
<p><code>int int_log2_64(uint64_t x) { return 63 ^ __builtin_clzll(x); }</p>
<p>int digit_count(uint32_t x) {<br/>
static uint64_t table[] = {16, 14, 12, 246, 240, 224, 3996, 3968, 3840, 64536, 64512, 63488, 61440, 1038576, 1032192, 1015808, 16677216, 16646144, 16515072, 267435456, 267386880, 266338304, 264241152, 4284967296, 4278190080, 4261412864, 68619476736, 68585259008, 68451041280, 1098511627776, 1098437885952, 1097364144128};<br/>
int lg2 = int_log2(x);<br/>
uint64_t n = (uint64_t)(x) + table[lg2];<br/>
return int_log2_64(n) &gt;&gt; 2;<br/>
}<br/>
</code></p>
<p>I plan to write up an explanation of how this works on my own blog post soon(ish).</p>
</div>
<ol class="children">
<li id="comment-585815" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://travisdowns.github.io" class="url" rel="ugc external nofollow">Travis Downs</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-02T22:10:46+00:00">June 2, 2021 at 10:10 pm</time></a> </div>
<div class="comment-content">
<p><code>mov ecx, edi</code> is redundant there and you could probably get rid of it by casting to 32-bits in a strategic place. It&rsquo;s just a quirk of the ABI that the high bits might contain garbage but in this case it&rsquo;s harmless because it&rsquo;s used as a shift count which has an implicit mask anyway.</p>
</div>
<ol class="children">
<li id="comment-585816" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://travisdowns.github.io" class="url" rel="ugc external nofollow">Travis Downs</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-02T22:22:59+00:00">June 2, 2021 at 10:22 pm</time></a> </div>
<div class="comment-content">
<p>Nevermind, it&rsquo;s not redundant, but it is just a quirk of the x86-64 ABI for passing 32-bit values in a 64-bit register. You could expect it to go away after inlining or if you made the parameter x a 64-bit value (but the top 32 bits must be zero).</p>
</div>
</li>
</ol>
</li>
<li id="comment-585817" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://travisdowns.github.io" class="url" rel="ugc external nofollow">Travis Downs</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-02T22:24:23+00:00">June 2, 2021 at 10:24 pm</time></a> </div>
<div class="comment-content">
<p>This is really clever, BTW.</p>
</div>
</li>
<li id="comment-585831" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-03T00:39:21+00:00">June 3, 2021 at 12:39 am</time></a> </div>
<div class="comment-content">
<blockquote>
<p>I plan to write up an explanation of how this works on my own blog<br/>
post soon(ish).</p>
</blockquote>
<p>Please either ping me back or just add a comment here&#8230; so I can edit the blog post to refer to your blog post. (We want people who arrive at my blog post to find yours.)</p>
</div>
</li>
<li id="comment-585850" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-03T06:17:10+00:00">June 3, 2021 at 6:17 am</time></a> </div>
<div class="comment-content">
<p>I see &#8211; you&rsquo;re moving the step in decimal log to where the step in binary (actually base 16) log is. This technique should work for any set of ranges where log10 changes by at most 1 in each, ie where the end is less than 10 times the start.</p>
<p>If we work with log base 8 for example, we can have one entry for 1-7, the next for 8-63, 64-511, and so on.</p>
</div>
</li>
</ol>
</li>
<li id="comment-585597" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thomas Müller Graf</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-31T07:24:41+00:00">May 31, 2021 at 7:24 am</time></a> </div>
<div class="comment-content">
<p>Where the &ldquo;if (v &gt;= p10)&rdquo; can result in an a slow branch, then (9 * l2) &gt;&gt;&gt; 5 might not be best. The following results in fewer cases of &ldquo;ans++&rdquo; over the whole integer range (116 million instead of 1.6 billion).</p>
<p><code>int l2 = 64 - Long.numberOfLeadingZeros(num | 1);<br/>
int ans = (21845 * l2) &gt;&gt;&gt; 16;<br/>
long p10 = POW_10[ans];<br/>
if (num &gt;= p10) {<br/>
ans++;<br/>
}<br/>
return ans;<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-585626" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-31T12:58:24+00:00">May 31, 2021 at 12:58 pm</time></a> </div>
<div class="comment-content">
<p>I expect that the branch gets compiled to a conditional move&#8230; so that there are no mispredicted branches&#8230; don&rsquo;t you have the same expectation?</p>
</div>
<ol class="children">
<li id="comment-585632" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thomas Müller Graf</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-31T14:46:10+00:00">May 31, 2021 at 2:46 pm</time></a> </div>
<div class="comment-content">
<p>Yes, I also hope a conditional move is possible here. For this case, I assume it&rsquo;s more important to have multiply by 5 (or 9, 17,&#8230;). Only if a conditional move isn&rsquo;t possible, reducing the probability of branches makes sense.</p>
</div>
</li>
<li id="comment-585747" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-01T23:22:34+00:00">June 1, 2021 at 11:22 pm</time></a> </div>
<div class="comment-content">
<p>Well if the probability of needing the fixup is low enough, then it would be better to use a branch instead and move this part off of the critial path (control dependency vs a data dependency).</p>
<p>This would be provide a nice latency improvement at the cost of the occasional mispredict.</p>
</div>
<ol class="children">
<li id="comment-585755" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-02T01:26:35+00:00">June 2, 2021 at 1:26 am</time></a> </div>
<div class="comment-content">
<p>Yes. That&rsquo;s a good point, but I am not convinced that Thomas&rsquo; code has this effect. Maybe I just misunderstand it.</p>
</div>
<ol class="children">
<li id="comment-585756" class="comment odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://travisdowns.github.io" class="url" rel="ugc external nofollow">Travis Downs</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-02T01:53:34+00:00">June 2, 2021 at 1:53 am</time></a> </div>
<div class="comment-content">
<p>No, I think it does either, just sort of mentioning this for completeness since it did come up in some other approaches I considered.</p>
<p>I don&rsquo;t think any approach which is purely a function of lzcnt(num) can achieve low correction probability because too much information has been lost in the truncation.</p>
</div>
<ol class="children">
<li id="comment-585761" class="comment byuser comment-author-lemire bypostauthor even depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-02T02:20:19+00:00">June 2, 2021 at 2:20 am</time></a> </div>
<div class="comment-content">
<p>I am sure that there must be a clever way to get this sort of result.</p>
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
<li id="comment-585916" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-03T17:57:36+00:00">June 3, 2021 at 5:57 pm</time></a> </div>
<div class="comment-content">
<p>Last night I realized that Josh&rsquo;s approach can be modified to use a simpler function after the table mapping. More specifically, the table entry has the integer log10 in the upper 32 bits, and the lower 32 generate a carry when the appropriate threshold is reached, eg the entry around 100 is (3&lt;&lt;32) -100. We only need a &gt;&gt;32 to pull out the integer log after the add:</p>
<p><code> mov eax, edi<br/>
bsr rcx, rax<br/>
add rax, qword ptr [8*rcx + digit_count(unsigned int)::table]<br/>
shr rax, 32<br/>
</code></p>
<p>(clang)</p>
</div>
<ol class="children">
<li id="comment-585919" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-03T18:17:17+00:00">June 3, 2021 at 6:17 pm</time></a> </div>
<div class="comment-content">
<p>&#8230;.!!!!!&#8230;..</p>
</div>
</li>
<li id="comment-585924" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-03T18:59:43+00:00">June 3, 2021 at 6:59 pm</time></a> </div>
<div class="comment-content">
<p>Here is the source &#8212; pardon my macro:</p>
<p><code>int int_log2_64(uint64_t x) { return 63 ^ __builtin_clzll(x); }</p>
<p>// this increments the upper 32 bits (log10(T) - 1) when &gt;= T is added<br/>
#define K(T) (((sizeof(#T)-1)&lt;&lt;32) - T)</p>
<p>int digit_count(uint32_t x) {</p>
<p> static uint64_t table[] = {<br/>
K(0),K(0),K(0),<br/>
K(10),K(10),K(10), // 64<br/>
K(100),K(100),K(100), // 512<br/>
K(1000),K(1000),K(1000), // 4096<br/>
K(10000),K(10000),K(10000), // 32k<br/>
K(100000),K(100000),K(100000), // 256k<br/>
K(1000000),K(1000000),K(1000000), // 2048k<br/>
K(10000000),K(10000000),K(10000000), // 16M<br/>
K(100000000),K(100000000),K(100000000), // 128M<br/>
K(1000000000),K(1000000000),K(1000000000), // 1024M<br/>
K(1000000000),K(1000000000) // 4B<br/>
};</p>
<p> int lg2 = int_log2_64(x);</p>
<p> uint64_t n = (uint64_t)(x) + table[lg2];</p>
<p> return n &gt;&gt; 32;<br/>
}<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-585925" class="comment byuser comment-author-lemire bypostauthor even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-03T19:00:55+00:00">June 3, 2021 at 7:00 pm</time></a> </div>
<div class="comment-content">
<p>Oh. I already had reimplemented it. The idea is simple enough (though brilliant).</p>
</div>
<ol class="children">
<li id="comment-585926" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-03T19:01:06+00:00">June 3, 2021 at 7:01 pm</time></a> </div>
<div class="comment-content">
<p>Blog post coming up.</p>
</div>
<ol class="children">
<li id="comment-585928" class="comment byuser comment-author-lemire bypostauthor even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-03T19:22:56+00:00">June 3, 2021 at 7:22 pm</time></a> </div>
<div class="comment-content">
<p>Blog post at <a href="https://lemire.me/blog/2021/06/03/computing-the-number-of-digits-of-an-integer-even-faster/" rel="ugc">https://lemire.me/blog/2021/06/03/computing-the-number-of-digits-of-an-integer-even-faster/</a></p>
<p>My code differs slightly.</p>
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
<li id="comment-639800" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/136f4c71facafdb75bfaa0e4f047f1fc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/136f4c71facafdb75bfaa0e4f047f1fc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/nmmmnu/HM4" class="url" rel="ugc external nofollow">Nikolay</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-17T08:56:16+00:00">July 17, 2022 at 8:56 am</time></a> </div>
<div class="comment-content">
<p>I am wondering if a fast solution exists for uint64_t numbers.</p>
<p>I am also interested, if there is fast solution to count the digits with over-estimation. What I mean is let say input is 12345, then the output can be 5,6,7 or even 20.</p>
<p>This is very handy, if you have a digit, you want to convert it to string, but you need to know in advance how much memory bytes you need to allocate for the string. Think about 1000&rsquo;s of strings.</p>
<p>I thought I can calculate using octal numbers, however it not as easy as it may sound.</p>
</div>
</li>
</ol>
