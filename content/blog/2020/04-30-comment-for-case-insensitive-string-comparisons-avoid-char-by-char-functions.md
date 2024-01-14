---
date: "2020-04-30 12:00:00"
title: "For case-insensitive string comparisons, avoid char-by-char functions"
index: false
---

[13 thoughts on &ldquo;For case-insensitive string comparisons, avoid char-by-char functions&rdquo;](/lemire/blog/2020/04-30-for-case-insensitive-string-comparisons-avoid-char-by-char-functions)

<ol class="comment-list">
<li id="comment-503611" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b8cfd5ec0f88bf5b5f2eedda7d1a0746?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b8cfd5ec0f88bf5b5f2eedda7d1a0746?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://seebs.net/log" class="url" rel="ugc external nofollow">seebs</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-30T16:54:24+00:00">April 30, 2020 at 4:54 pm</time></a> </div>
<div class="comment-content">
<p>Long ago, in the hot path of a performance critical application, I found a case-insensitive string compare that worked by calling strdup on both strings, then case-smashing them, then comparing the results, then freeing the strings. The typical use case was iterating through a large list of strings comparing a reference string to each of them as a table lookup.</p>
<p>At the time, I thought per-character comparison would be better. (There wasn&rsquo;t, yet, a library function for this in that environment.) I think it might have been, given the allocation overhead. These days, I&rsquo;d have had the objects store a smashed-case version of their strings and compare those.</p>
</div>
<ol class="children">
<li id="comment-503612" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-30T17:00:05+00:00">April 30, 2020 at 5:00 pm</time></a> </div>
<div class="comment-content">
<p>Note that my post starts with the ASCII context. None of these approaches will work with UTF-8, I think.</p>
<p>If you assume ASCII, I am not too sure why you&rsquo;d need to do memory allocations.</p>
<p>If you need to support unicode, you have other problems that this blog post does not cover. Obviously.</p>
</div>
<ol class="children">
<li id="comment-503913" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">degski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-02T11:07:22+00:00">May 2, 2020 at 11:07 am</time></a> </div>
<div class="comment-content">
<p>Indeed, what someone explained to me once is that this task (with unicode) is as a matter of principle impossible. There are &lsquo;situations&rsquo; where the only way to know what &lsquo;the&rsquo; minor is, is to have more context. Let&rsquo;s just stick to ascii and English.</p>
</div>
</li>
<li id="comment-504357" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/KWillets/" class="url" rel="ugc external nofollow">KWillets</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-04T16:09:08+00:00">May 4, 2020 at 4:09 pm</time></a> </div>
<div class="comment-content">
<p>The Unicode Comparison Algorithm is anything but &#8212; it seems to be a list of problems that an algorithm should solve, but not a prescriptive method.</p>
<p>One approach that seems relevant here is to bet that characters will be binary equal more often than they are case-insensitive equal; you use a strcmp-type loop to find the common prefix and then do the expensive collation only on the first code points that mismatch. If you&rsquo;ve bet correctly, the first mismatch will collate into inequality; otherwise you continue (with binary, not collated comparisons).</p>
<p>That&rsquo;s a performance optimization that ICU only belatedly applied to strcoll, and the UCA unfortunately says almost nothing about it.</p>
<p>With strcasecmp, you could try a loop or vector comparison to find the longest common <em>binary</em> prefix and then apply case conversion only to the next character. Performance is entirely dependent on how often you get mixed-case equality, eg &ldquo;Daniel&rdquo; vs. &ldquo;DANIEL&rdquo; would have one fast and five slow comparisons, while &ldquo;Daniel&rdquo; vs. &ldquo;daniel&rdquo; would have one slow and five fast.</p>
<p>In this instance I doubt it would be faster (it&rsquo;s certainly branchy), but with more expensive collations it seems like the way to go.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-503638" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8f8ff21a67437febebc70afd19364e95?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8f8ff21a67437febebc70afd19364e95?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Pete</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-30T20:34:35+00:00">April 30, 2020 at 8:34 pm</time></a> </div>
<div class="comment-content">
<p>Strncasecmp is character by character as well under the hood, except that it cheats with a pre-mapped table</p>
<p><a href="https://github.com/openbsd/src/blob/master/lib/libc/string/strcasecmp.c" rel="nofollow ugc">https://github.com/openbsd/src/blob/master/lib/libc/string/strcasecmp.c</a></p>
</div>
<ol class="children">
<li id="comment-503642" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-30T21:32:23+00:00">April 30, 2020 at 9:32 pm</time></a> </div>
<div class="comment-content">
<p>I think that glibc must be doing something smarter.</p>
</div>
</li>
</ol>
</li>
<li id="comment-503653" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-01T00:12:31+00:00">May 1, 2020 at 12:12 am</time></a> </div>
<div class="comment-content">
<p>glibc on my system uses an AVX specialization if the locale is &ldquo;compatible with ASCII for single bytes&rdquo; (basically it seems like that means that it does something reasonable if it just uses the ASCII A-Z:a-z mapping and treats all other values without changing the case.</p>
<p>It uses a 128-bit wide vector algorithm:</p>
<p><a href="https://github.com/bminor/glibc/blob/master/sysdeps/x86_64/multiarch/strcmp-sse42.S#L201" rel="nofollow ugc">https://github.com/bminor/glibc/blob/master/sysdeps/x86_64/multiarch/strcmp-sse42.S#L201</a></p>
<p>You could get 2x as fast with 256-bits, almost certainly. You don&rsquo;t need the SSE4.2 stuff to detect the null character.</p>
</div>
<ol class="children">
<li id="comment-503655" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-01T00:23:35+00:00">May 1, 2020 at 12:23 am</time></a> </div>
<div class="comment-content">
<p>I find it interesting that the same function under macOS seem much less optimized. Possibly a freeBSD/macOS thing. I wonder how well Windows fare?</p>
</div>
</li>
</ol>
</li>
<li id="comment-503945" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2fb1d0febf487a1d0b6ece2ff02affaa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2fb1d0febf487a1d0b6ece2ff02affaa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christopher Chang</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-02T17:33:53+00:00">May 2, 2020 at 5:33 pm</time></a> </div>
<div class="comment-content">
<p>A major practical issue here is that case-insensitive comparisons involve short strings far more often than long ones, so low constant overhead is usually more important for this function than great length-&gt;infinity asymptotic behavior.</p>
</div>
<ol class="children">
<li id="comment-503982" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-03T00:01:13+00:00">May 3, 2020 at 12:01 am</time></a> </div>
<div class="comment-content">
<p>Do you have a reason to believe that the conclusion would change if we were to benchmark on small strings?</p>
</div>
<ol class="children">
<li id="comment-504206" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-04T04:26:33+00:00">May 4, 2020 at 4:26 am</time></a> </div>
<div class="comment-content">
<p>I do: the glibc versions won&rsquo;t exhibit their large advantage for short strings because the vectorization advantage goes to zero (and possibly even becomes negative) as the string length goes to zero.</p>
</div>
<ol class="children">
<li id="comment-504381" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-04T17:06:14+00:00">May 4, 2020 at 5:06 pm</time></a> </div>
<div class="comment-content">
<p>I have updated the C program so that it benchmarks both small and long strings, and though, obviously, the gap closes on small strings, the strncasecmp function is still faster.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-518376" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eca51f4b3bd00462ae5934f1476c6c7b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eca51f4b3bd00462ae5934f1476c6c7b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">David</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-22T20:16:45+00:00">May 22, 2020 at 8:16 pm</time></a> </div>
<div class="comment-content">
<p>Any intelligent library will use a faster string-matching algorithm like Boyer-Moore or similar, doing far fewer than N compare operations for strings of length N.</p>
<p>By lowercasing the strings first, you guarantee you do at least N*2 operations even if the strings don&rsquo;t match right at the beginning!</p>
</div>
</li>
</ol>
