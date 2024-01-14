---
date: "2020-05-02 12:00:00"
title: "Encoding binary in ASCII very fast"
index: false
---

[8 thoughts on &ldquo;Encoding binary in ASCII very fast&rdquo;](/lemire/blog/2020/05-02-encoding-binary-in-ascii-very-fast)

<ol class="comment-list">
<li id="comment-503957" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8c04e8d64df709d32505addd42d69140?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8c04e8d64df709d32505addd42d69140?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://unpythonic.net" class="url" rel="ugc external nofollow">Jeff Epler</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-02T20:12:22+00:00">May 2, 2020 at 8:12 pm</time></a> </div>
<div class="comment-content">
<p>Is the input range actually up to 2<sup>56</sup>, rather than 2<sup>48</sup> as the comment currently suggests?</p>
</div>
<ol class="children">
<li id="comment-503958" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-02T20:24:28+00:00">May 2, 2020 at 8:24 pm</time></a> </div>
<div class="comment-content">
<p>Yes. You are correct.</p>
</div>
</li>
</ol>
</li>
<li id="comment-503968" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9fab95d1172eaf8a52b1b424526ee29c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9fab95d1172eaf8a52b1b424526ee29c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Gil Pedersen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-02T21:07:33+00:00">May 2, 2020 at 9:07 pm</time></a> </div>
<div class="comment-content">
<p>To encode in four instructions:</p>
<p><code>uint64_t convert_to_ascii(uint64_t x) {<br/>
return ((0x2040810204081 * (x &amp; 0x80808080808080)) &amp; 0xff80808080808080) ^ x;<br/>
}<br/>
</code></p>
</div>
</li>
<li id="comment-509965" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-15T23:44:37+00:00">May 15, 2020 at 11:44 pm</time></a> </div>
<div class="comment-content">
<p>If you are willing to use a bigger chunk size, you can probably do it faster with something like:</p>
<p><code>uint64_t encode(uint64_t bits, uint64_t&amp; high) {<br/>
high = (high &gt;&gt; 1) | (bits &amp; 0x8080808080808080) ;<br/>
return bits &amp; 0x7F7F7F7F7F7F7F7F;<br/>
}</p>
<p>// encode a 64-byte input chunk into 72 output bytes<br/>
uint64_t high = 0;<br/>
for (size_t i = 0; i &lt; 8; i++)<br/>
result[0] = encode(input[0], high);<br/>
result[8] = high;<br/>
</code></p>
<p>By my count this is fewer operations and all basic ops: no potentially expensive multiply. Also, it processes 8 bytes at a time, not 7, which keeps all accesses aligned (this matters much more on non-x86).</p>
<p>On x86, you could take advantage of LEA, which can do (bits &lt;&lt; 1) + x in a single instruction, but because you&rsquo;re shifting left, not right, I think you can only process 7 bytes at a time (like your suggested algorithm), losing some benefit. Still, even at 7 bytes i calculate this as fewer total ops.</p>
</div>
<ol class="children">
<li id="comment-512432" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2d26034a16369272528e8f323c5f3660?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2d26034a16369272528e8f323c5f3660?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">randomPoster</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-18T07:06:06+00:00">May 18, 2020 at 7:06 am</time></a> </div>
<div class="comment-content">
<p>You must stop your loop one step before, and encode 56bytes in 64bytes, otherwise result[8] will not fit in ascii.</p>
</div>
<ol class="children">
<li id="comment-512749" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-19T00:02:00+00:00">May 19, 2020 at 12:02 am</time></a> </div>
<div class="comment-content">
<p>Yes, that&rsquo;s right: it should only be 7 iterations of the inner loop before storing the upper bits.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-509999" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-15T23:58:21+00:00">May 15, 2020 at 11:58 pm</time></a> </div>
<div class="comment-content">
<p>The formatter wrecks the indentation in the code samples, but that should be:</p>
<p><code>for (size_t i = 0; i &lt; 8; i++) result[i] = encode(input[i], high);<br/>
result[8] = high;<br/>
</code></p>
</div>
</li>
<li id="comment-518618" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8d529bafee19e75a60b00f035a7a58ae?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8d529bafee19e75a60b00f035a7a58ae?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Steven Stewart-Gallus</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-23T01:01:22+00:00">May 23, 2020 at 1:01 am</time></a> </div>
<div class="comment-content">
<p>Less instructions is not always faster.<br/>
Not sure what the best way to exploit ILP is though.</p>
</div>
</li>
</ol>
