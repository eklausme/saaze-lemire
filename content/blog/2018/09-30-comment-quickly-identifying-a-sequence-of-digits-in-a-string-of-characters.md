---
date: "2018-09-30 12:00:00"
title: "Quickly identifying a sequence of digits in a string of characters"
index: false
---

[10 thoughts on &ldquo;Quickly identifying a sequence of digits in a string of characters&rdquo;](/lemire/blog/2018/09-30-quickly-identifying-a-sequence-of-digits-in-a-string-of-characters)

<ol class="comment-list">
<li id="comment-353310" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e310c7f6ad7ff821cdd4392f6ed8548?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e310c7f6ad7ff821cdd4392f6ed8548?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Sam Hardwick</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-30T19:44:51+00:00">September 30, 2018 at 7:44 pm</time></a> </div>
<div class="comment-content">
<p>It would be interesting to know why there&rsquo;s an almost factor of two difference between gcc and clang in the conventional case!</p>
</div>
<ol class="children">
<li id="comment-353353" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Travis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-30T23:42:56+00:00">September 30, 2018 at 11:42 pm</time></a> </div>
<div class="comment-content">
<p>Loop unrolling. Newer gcc doesn&rsquo;t unroll at all at -O2, but clang unrolls aggressively. The -O2 loop on gcc contains only a single check and is about half loop overhead. If you use -O3 they end up equivalent.</p>
<p>This observation applies to other types of optimizations as well: -O2 in clang is in no way equivalent to -O2 in gcc. For example gcc never vectorizes at -O2 but clang vectorizes all the time, etc.</p>
<p>The above doesn&rsquo;t apply if you use PGO.</p>
<p>Definitely makes it hard to do apples to apples comparison.</p>
</div>
</li>
</ol>
</li>
<li id="comment-353343" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-30T23:14:01+00:00">September 30, 2018 at 11:14 pm</time></a> </div>
<div class="comment-content">
<p>How about:</p>
<p><code>( val &amp; (val + 0x0606060606060606) &amp; 0xF0F0F0F0F0F0F0F0 ) == 0x3030303030303030<br/>
</code></p>
<p>?</p>
<p>Cuts out two operations. It is usually faster than the existing branchless version, although nothing ever beat &ldquo;branchy&rdquo; for the compilers I tried.</p>
</div>
<ol class="children">
<li id="comment-353356" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-01T00:17:44+00:00">October 1, 2018 at 12:17 am</time></a> </div>
<div class="comment-content">
<p>Blog post updated, you have been given credit for this better approach. It is not gigantically faster, but it does seem to help a bit.</p>
</div>
<ol class="children">
<li id="comment-353359" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-01T00:20:36+00:00">October 1, 2018 at 12:20 am</time></a> </div>
<div class="comment-content">
<p>It seems highly compiler dependent, but I saw speedups of between 1.0 (no speedup) and 1.3x or so (clang-5.0).</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-353352" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-30T23:33:37+00:00">September 30, 2018 at 11:33 pm</time></a> </div>
<div class="comment-content">
<p>I posted another comment with a possibly improved &ldquo;branchless&rdquo; solution, but it never showed up.</p>
<p>Anyways, is either test supposed to lead to unpredictable results? As far as I can tell the generatefloats and generatevarfloats routines both generate floats with random values but predictable length (16 vs 12) but don&rsquo;t otherwise differ?</p>
<p>The branch solution is favored here because the results follow a predictable pattern, and because the failure (the non-digit results) shortcut most of the work. If you create variable length floats, with this one line change:</p>
<p><code>pos += sprintf((char *)stroutput + pos, "%.*f,", rand() % 20 + 1, output);<br/>
</code></p>
<p>Then branchy starts to lose.</p>
<p>It is also possible that the compiler compiles branchy to branchless code: but all the ones I checked went half-way: they do the first check branchy and the second check branchless. Since the first check usually fails for any non-digit character (except for 6 characters right below <code>0</code>), this works well in the predictable case!</p>
</div>
</li>
<li id="comment-353354" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-30T23:52:29+00:00">September 30, 2018 at 11:52 pm</time></a> </div>
<div class="comment-content">
<p>Here&rsquo;s a <a href="https://graphics.stanford.edu/~seander/bithacks.html#HasBetweenInWord" rel="nofollow">relevant link</a> &#8211; the approach there is general, but the condition is slightly different (it looks for any byte in the range, rather than all bytes in the range, but you could transform one to the other in a straightforward way.</p>
<p>The idea is more or less the same (exploit carries to do a specific range check), but a bit slower since it&rsquo;s more general.</p>
<p>The &ldquo;Determine if a word has a byte greater than n&rdquo; is interesting since its only three op, if you add one op to subtract &lsquo;\0&rsquo; then it&rsquo;s 4 ops, just either tried or one more than my suggestion above, depending on if you treat the implicit == 0 which is not counted on that page as an op or not. On x86 it is probably &ldquo;not an op&rdquo; since compare against zero is automatic, unlike comparison against other values: you just use the ZF after your last arithmetic op.</p>
</div>
</li>
<li id="comment-353408" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/02d257cd405544564222bbdf504ef4d7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/02d257cd405544564222bbdf504ef4d7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://branchfree.org" class="url" rel="ugc external nofollow">Geoff Langdale</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-01T07:33:30+00:00">October 1, 2018 at 7:33 am</time></a> </div>
<div class="comment-content">
<p>I replied to this on Twitter, but for the record&#8230; I think there is a version of this that works with a add/compare on SIMD. Specifically one would add a magic number (70, IIRC) that pushes &lsquo;0&rsquo; to 118 in the result and &lsquo;9&rsquo; to 127.</p>
<p>+127 is the maximal signed byte, so signed-gt comparison against 117 should do the trick.</p>
<p>This doesn&rsquo;t necessarily seem faster than the best SWAR variant but might be handy if you are looking for more than 8 chars.</p>
</div>
</li>
<li id="comment-647563" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0bc624bb19867fc4ff397ffec40b1adf?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0bc624bb19867fc4ff397ffec40b1adf?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Amaury Séchet</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-19T03:07:30+00:00">November 19, 2022 at 3:07 am</time></a> </div>
<div class="comment-content">
<p>i was wondering if a similar approach could be used to validate hexadecimal strings. I tried today, but I&rsquo;m afraid I failed. Any help, tips or trick appreciated!</p>
</div>
<ol class="children">
<li id="comment-647759" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-23T17:07:34+00:00">November 23, 2022 at 5:07 pm</time></a> </div>
<div class="comment-content">
<p>It seems more difficult to do it efficiently in portable C code. In our routine, we use the fact that the digits are consecutive (0x30 to 0x39) in ASCII. It is no longer true if you want to consider hexadecimal &lsquo;digits&rsquo; which include a,b, A,B&#8230; etc. It suggests that the check for hexadecimal strings could be more expensive.</p>
</div>
</li>
</ol>
</li>
</ol>
