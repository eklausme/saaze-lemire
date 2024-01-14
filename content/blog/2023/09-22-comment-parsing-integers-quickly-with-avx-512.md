---
date: "2023-09-22 12:00:00"
title: "Parsing integers quickly with AVX-512"
index: false
---

[5 thoughts on &ldquo;Parsing integers quickly with AVX-512&rdquo;](/lemire/blog/2023/09-22-parsing-integers-quickly-with-avx-512)

<ol class="comment-list">
<li id="comment-654860" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f2819cd9c715383fea7c039b2fd68e8c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f2819cd9c715383fea7c039b2fd68e8c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">John Keiser</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-09-22T23:22:01+00:00">September 22, 2023 at 11:22 pm</time></a> </div>
<div class="comment-content">
<p>Oh nice, thanks for fleshing this one out!</p>
<p>I think it&rsquo;s important to note that we&rsquo;re not doing traditional parsing (at least as I&rsquo;ve seen it), which involves parsing from left to right (most significant to least). The thing that makes this work is that we &ldquo;right-justify&rdquo; the number in the SIMD register (put the least significant digit in the most significant byte of the SIMD register), .</p>
<p>This contrasts with traditional left-to-right number parsers: by knowing where the least significant digit of the number is, we know exactly how much each digit is worth (the rightmost is digit<em>10^0, penultimate is digit</em>10^1, etc&#8230;). We no longer need to do the conventional &ldquo;read the next digit, multiply the total by 10, read the next digit and add it in,&rdquo; which creates data dependency from digit to digit.</p>
<p>Because we support up to 20 digit numbers, we start with a 32 byte register (though we quickly shrink to a 16-byte register in step 2, since 2 digits can still fit in one byte):</p>
<p><code>String: 1234567890<br/>
SIMD step 1 (8-bit x 32): 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 1 2 3 4 5 6 7 8 9 0<br/>
SIMD step 2 (8-bit x 16): 00 00 00 00 00 00 00 00 00 00 00 12 34 56 78 90<br/>
SIMD step 3 (16-bit x 8): 0000 0000 0000 0000 0000 0012 3456 7890<br/>
SIMD step 4 (32-bit x 4): 00000000 00000000 00000012 34567890<br/>
</code></p>
<p>And after that, we manually extract the 32-bit numbers, multiply them by 10^16, 10^8 and 10^0, and add them to get the 64-bit result (in this case, 1234567890).</p>
<p>One interesting bit to me: with AVX-512, we could also parse 2 numbers simultaneously without modifying the algorithm. (We could parse much more if we knew they were all 8 bytes or less!) If we want 32-bit numbers, you could parse 4 at a time!</p>
<p>Note that you could do this without knowing the full size of the number if you load the 32 bytes (assumes padding), look for non-digits, and use that to <em>find</em> the end, and then &ldquo;right-justifying&rdquo; all the digits with a byte shift/shuffle.</p>
</div>
</li>
<li id="comment-654910" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/275d6ccbf6ac0d40942ed813e1aa38c7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/275d6ccbf6ac0d40942ed813e1aa38c7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">sasuke420</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-09-25T04:09:55+00:00">September 25, 2023 at 4:09 am</time></a> </div>
<div class="comment-content">
<p>A commenter on another blog suggests using vpshldvw then vpdpbusd to do the first 2 multiply-and-add steps at once by computing 4a, 4b, c, d then mul-adding with 250, 25, 10, 1.</p>
<p>I have various thoughts about this problem from <a href="https://highload.fun/tasks/1" rel="nofollow ugc">https://highload.fun/tasks/1</a> but that seems to be a very different problem (it is a lot about detecting the edge of the number and zeroing out the rest of the register, or finding a way to shuffle certain digits from several numbers of unknown lengths into fixed locations in multiple registers).</p>
</div>
</li>
<li id="comment-654914" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d081923c9998bd094289a54a0ee1045b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d081923c9998bd094289a54a0ee1045b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">eden segal</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-09-25T07:13:59+00:00">September 25, 2023 at 7:13 am</time></a> </div>
<div class="comment-content">
<p>In here<br/>
<a href="https://kholdstare.github.io/technical/2020/05/26/faster-integer-parsing.html#comment-6285552965" rel="nofollow ugc">https://kholdstare.github.io/technical/2020/05/26/faster-integer-parsing.html#comment-6285552965</a><br/>
The blogger talks about this problem too, which is pretty similar to your discussion, but please look at the comment by sharp-o which describes how to use vnni to simplify the byte to 32 bit reduction, after which you need a regular mul and horizontal add.</p>
<p>Horizontal add of u32 can be done using _mm_mpsadbw_epu8 in a new method you probably heard about, but I can&rsquo;t find a link.</p>
</div>
<ol class="children">
<li id="comment-654922" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/275d6ccbf6ac0d40942ed813e1aa38c7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/275d6ccbf6ac0d40942ed813e1aa38c7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">sasuke420</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-09-25T13:07:21+00:00">September 25, 2023 at 1:07 pm</time></a> </div>
<div class="comment-content">
<p>This horizontal add technique sounds quite interesting!</p>
</div>
</li>
</ol>
</li>
<li id="comment-655966" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/be26590626dd7132d00036033861a58e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/be26590626dd7132d00036033861a58e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Subhajit Sahu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-04T17:09:23+00:00">November 4, 2023 at 5:09 pm</time></a> </div>
<div class="comment-content">
<p>Thanks a lot, this gives awesome performance. I didnt need the non-digit check, so i skipped it.</p>
</div>
</li>
</ol>
