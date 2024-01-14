---
date: "2022-03-28 12:00:00"
title: "Converting integers to decimal strings faster with AVX-512"
index: false
---

[4 thoughts on &ldquo;Converting integers to decimal strings faster with AVX-512&rdquo;](/lemire/blog/2022/03-28-converting-integers-to-decimal-strings-faster-with-avx-512)

<ol class="comment-list">
<li id="comment-624789" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3c220d1ed04a50b5add09e2cbd9d32bc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3c220d1ed04a50b5add09e2cbd9d32bc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Florian Lemaitre</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-03-29T07:24:51+00:00">March 29, 2022 at 7:24 am</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s the kind of code that shows AVX512 is worth for regular computing and not only for scientific computing.</p>
<p>Few people understand SIMD well enough to bring SIMD to &ldquo;regular problems&rdquo; that are not crunching numbers. You sir, are one of them, and I&rsquo;m glad for that.</p>
</div>
</li>
<li id="comment-625250" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">George Spelvin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-04-03T04:39:21+00:00">April 3, 2022 at 4:39 am</time></a> </div>
<div class="comment-content">
<p>Comments on the two code samples:The table would be a lot more comprehensible as <code>static const char table[200] = "0001020304 ... 9899";</code>.Could someone produce a brief outline of the algorithm? In particular, the <code>ifma_const</code> magic values (which I <em>think</em> are 52-bit approximations to 1/10, 1/100, 1/1000, etc.) and the peculiarly non-zero value of <code>zmmzero</code>.</p>
</div>
<ol class="children">
<li id="comment-625251" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">George Spelvin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-04-03T04:58:05+00:00">April 3, 2022 at 4:58 am</time></a> </div>
<div class="comment-content">
<p>Sorry for the poor formatting of the above. I had tried to use <code>&lt;ol&amp;gt</code>, but the list tags got stripped.</p>
</div>
</li>
</ol>
</li>
<li id="comment-652236" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c0d5ed9e2acae99d5933c13c36fb588a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c0d5ed9e2acae99d5933c13c36fb588a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">pzq_alex</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-09T12:32:55+00:00">June 9, 2023 at 12:32 pm</time></a> </div>
<div class="comment-content">
<p>How about the reverse operation, i.e. scanning integers from a string? (I&rsquo;d expect this to be partially answered by the fast_float library. )</p>
</div>
</li>
</ol>
