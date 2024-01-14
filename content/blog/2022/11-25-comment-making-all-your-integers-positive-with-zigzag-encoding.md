---
date: "2022-11-25 12:00:00"
title: "Making all your integers positive with zigzag encoding"
index: false
---

[26 thoughts on &ldquo;Making all your integers positive with zigzag encoding&rdquo;](/lemire/blog/2022/11-25-making-all-your-integers-positive-with-zigzag-encoding)

<ol class="comment-list">
<li id="comment-647900" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/75daf5de97d363ea4a59e2e6e6dd196b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/75daf5de97d363ea4a59e2e6e6dd196b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://bitismyth.wordpress.com" class="url" rel="ugc external nofollow">Frederico L. Pissarra</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-25T17:36:30+00:00">November 25, 2022 at 5:36 pm</time></a> </div>
<div class="comment-content">
<p>Beware that, in C, right shift with signed integers is a undef. behavior.</p>
</div>
<ol class="children">
<li id="comment-647901" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-25T17:47:11+00:00">November 25, 2022 at 5:47 pm</time></a> </div>
<div class="comment-content">
<p>Up until C23 it was implementation defined. I expect that C23 will fix this particular issue.</p>
<p>In Go or Java, there is no issue.</p>
</div>
</li>
<li id="comment-647905" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/182d0ce855c8324a596648c04643e8f9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/182d0ce855c8324a596648c04643e8f9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">harold</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-25T18:22:35+00:00">November 25, 2022 at 6:22 pm</time></a> </div>
<div class="comment-content">
<p>Right shift of signed integers was not UB, the spec text was &ldquo;If E1 has a signed type and a negative value, the resulting value is implementation-defined&rdquo;</p>
</div>
</li>
</ol>
</li>
<li id="comment-647913" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">me</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-25T23:26:01+00:00">November 25, 2022 at 11:26 pm</time></a> </div>
<div class="comment-content">
<p>Maybe point out that this works well in combination with varint integers in protobuf.</p>
</div>
</li>
<li id="comment-647927" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marcin Zukowski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-26T06:04:33+00:00">November 26, 2022 at 6:04 am</time></a> </div>
<div class="comment-content">
<p>To add to other comments, I believe signed int overflows are formally undefined, and you can get overflows here. But it probably works in all &ldquo;sane&rdquo; compilers.</p>
</div>
</li>
<li id="comment-647934" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/889daaf0e6372e5aa9a7f75dfc44f037?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/889daaf0e6372e5aa9a7f75dfc44f037?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tim</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-26T11:53:56+00:00">November 26, 2022 at 11:53 am</time></a> </div>
<div class="comment-content">
<p>Is &ldquo;2*x&rdquo; with int x safe to do in C? Seems like you&rsquo;d hit UB.</p>
</div>
<ol class="children">
<li id="comment-648012" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/698f146ee822125defd70b3f3949734b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/698f146ee822125defd70b3f3949734b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Karol</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-28T17:20:25+00:00">November 28, 2022 at 5:20 pm</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s not, you have to cast to unsigned to make it safe.</p>
</div>
<ol class="children">
<li id="comment-648021" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-28T22:39:04+00:00">November 28, 2022 at 10:39 pm</time></a> </div>
<div class="comment-content">
<p>Can you safely cast all signed integers to unsigned integers (in current C standards)?</p>
</div>
<ol class="children">
<li id="comment-648625" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b6417fe00100e501ed2f6dc0e5139a78?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b6417fe00100e501ed2f6dc0e5139a78?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://gms.tf" class="url" rel="ugc external nofollow">Georg Sauthoff</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-28T23:47:34+00:00">December 28, 2022 at 11:47 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
Can you safely cast all signed integers to unsigned integers (in current C standards)?
</p></blockquote>
<p>Yes, C99 and C11 specify in Section 6.3.1.3 (Signed and unsigned integers), 2nd paragraph:</p>
<blockquote><p>
Otherwise, if the new type is unsigned, the value is converted by repeatedly adding or<br/>
subtracting one more than the maximum value that can be represented in the new type<br/>
until the value is in the range of the new type.
</p></blockquote>
<p>So with that requirement one get bit-identical values if integers are in two&rsquo;s complement &#8211; which is already assumed.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-647938" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6d633a9adb678ae58ba053b521b41844?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6d633a9adb678ae58ba053b521b41844?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://llogiq.github.io" class="url" rel="ugc external nofollow">Andre Bogus</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-26T16:48:48+00:00">November 26, 2022 at 4:48 pm</time></a> </div>
<div class="comment-content">
<p>Rust has the i*::rotate_left(_) and ::rotate_right(_) functions on all integer types. So the correct encode function would be n.rotate_left(1); and decode would be n.rotate_right(1).</p>
<p>At least on x86_64, this maps to the respective rol/ror assembly instructions, and the compiler doesn&rsquo;t need to optimize more complex code.</p>
</div>
<ol class="children">
<li id="comment-648030" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0dcee6e0746589b790e09c095bb2a8ca?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0dcee6e0746589b790e09c095bb2a8ca?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Lockal</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-29T04:20:56+00:00">November 29, 2022 at 4:20 am</time></a> </div>
<div class="comment-content">
<p>And speaking of vectorization in avx512, there is even vprold to convert many integers in a single instruction.</p>
</div>
</li>
</ol>
</li>
<li id="comment-647942" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f8364132def52383c5e4e1b21bf7f371?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f8364132def52383c5e4e1b21bf7f371?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">moonchild</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-26T22:18:32+00:00">November 26, 2022 at 10:18 pm</time></a> </div>
<div class="comment-content">
<p>An alternative, if you know the range ahead of time, is to represent numbers with offsets from the low end of the range. This way, if (e.g.) you don&rsquo;t have a lot of negative numbers, you don&rsquo;t unfairly punish the positive ones by stealing a bit from them all.</p>
</div>
</li>
<li id="comment-647990" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3347f1852ef13d4019cbc2fe71faef03?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3347f1852ef13d4019cbc2fe71faef03?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dru Nelson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-28T05:08:54+00:00">November 28, 2022 at 5:08 am</time></a> </div>
<div class="comment-content">
<p>There is another way to present this idea.</p>
<p>You are making the lowest bit the &lsquo;sign&rsquo; bit.<br/>
This is a sign bit like a &lsquo;sign&rsquo; bit in floating point as opposed to the method in twos-complement.</p>
<p>Once you see that, it is much more intuitive.</p>
<p>I don&rsquo;t know why it isn&rsquo;t presented like this more often.</p>
</div>
<ol class="children">
<li id="comment-648007" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-28T14:38:32+00:00">November 28, 2022 at 2:38 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s not quite what it is though, is it?</p>
</div>
</li>
</ol>
</li>
<li id="comment-648006" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0eac901624f3af9b385abb2ebac30d61?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0eac901624f3af9b385abb2ebac30d61?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">David Plass</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-28T14:29:45+00:00">November 28, 2022 at 2:29 pm</time></a> </div>
<div class="comment-content">
<p>I cannot fathom a practical requirement or use of this algorithm. What&rsquo;s the motivation?</p>
</div>
<ol class="children">
<li id="comment-648041" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-29T14:54:51+00:00">November 29, 2022 at 2:54 pm</time></a> </div>
<div class="comment-content">
<p>It is commonly used as part of compression routines.</p>
</div>
<ol class="children">
<li id="comment-648042" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0eac901624f3af9b385abb2ebac30d61?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0eac901624f3af9b385abb2ebac30d61?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">David Plass</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-29T14:58:59+00:00">November 29, 2022 at 2:58 pm</time></a> </div>
<div class="comment-content">
<p>You should start with that as a motivator, instead of burying the lede.</p>
</div>
<ol class="children">
<li id="comment-648043" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-29T15:03:26+00:00">November 29, 2022 at 3:03 pm</time></a> </div>
<div class="comment-content">
<p>The first paragraph is as follows&#8230;</p>
<p><em>You sometimes feel the need to make all of your integers positive, without losing any information. That is, you want to map all of your integers from ‘signed’ integers (e.g., -1, 1, 3, -3) to ‘unsigned integers’ (e.g., 3,2,6,7). This could be useful if you have a fast function to compress integers that fails to work well for negative integers.</em></p>
<p>I am sure it could be improved, but it is meant to provide motivation.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-648015" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f111c352cd5721b0f944af0138b33611?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f111c352cd5721b0f944af0138b33611?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ethan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-28T19:18:01+00:00">November 28, 2022 at 7:18 pm</time></a> </div>
<div class="comment-content">
<p>What about the case of having unequal amounts of negative and positive integers and wanting to avoid gaps?</p>
<p>I.E. let&rsquo;s say our initial set is. -1, -2, -3, 1, 2, 3, 4, 5, 6, 7, 8</p>
<p>With zig-zag encoding applied we are left with<br/>
1, 3, 5, 2, 4, 6, 8, 10, 12, 14, 16. </p>
<p>Which leaves us with &ldquo;gaps&rdquo; (below). These gaps now make the positive integers in our initial set take up more space in their binary representation.<br/>
7, 9, 11, 13, 15. </p>
<p>What do compression ratios end up looking like in the varying scenarios of<br/>
1. Equal amounts of negative and positive integers<br/>
2. More or less negative and positive integers relative to each other.</p>
</div>
<ol class="children">
<li id="comment-648023" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-28T22:43:17+00:00">November 28, 2022 at 10:43 pm</time></a> </div>
<div class="comment-content">
<p>Can you define what you mean by &ldquo;compression ratios&rdquo;? The blog post does not describe a compression routine.</p>
<p>This being said, zigzag encoding tends to favour values that are close (in absolute value) to zero&#8230; in the sense that such values get mapped to &lsquo;small positive integers&rsquo;.</p>
</div>
<ol class="children">
<li id="comment-648024" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marcin Zukowski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-28T22:56:52+00:00">November 28, 2022 at 10:56 pm</time></a> </div>
<div class="comment-content">
<p>Indeed, zigzag doesn&rsquo;t necessarily compress per-se. At the same time, like @me (who&rsquo;s that?:)) mentioned, it enables e.g. varint encoding (which, in my book, is also not compression, but hey 😛 )</p>
<p>@moonchild also mentioned adjusting the base, aka FOR encoding. If there&rsquo;s a difference in positive/negative ranges, FOR indeed will create a better (smaller) range of integers. But you need to know that base upfront, which is a weakness.</p>
<p>In general, if someone is interested in more efficient integer compression, Daniel&rsquo;s PFOR library is not the worst place to start: <a href="https://github.com/lemire/FastPFor" rel="nofollow ugc">https://github.com/lemire/FastPFor</a> 🙂</p>
</div>
</li>
<li id="comment-648048" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f111c352cd5721b0f944af0138b33611?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f111c352cd5721b0f944af0138b33611?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ethan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-29T18:12:48+00:00">November 29, 2022 at 6:12 pm</time></a> </div>
<div class="comment-content">
<p>&gt; This could be useful if you have a fast function to compress integers that fails to work well for negative integers.</p>
<p>This is what motivated that question (from the top of the post). I&rsquo;d also need a definition of what it means for a function that compresses integers to work or not work well for negative integers :). </p>
<p>I guess a clearer question is &#8212; if we&rsquo;re talking about zigzag encoding in terms of being a solution to &ldquo;dealing with&rdquo; negative integers so that they can be compressed &ldquo;well&rdquo; by some function that compresses integers &#8212; Is zigzag encoding the best encoding method for &ldquo;getting rid of&rdquo; negative integers for whichever function that compresses integers well, but doesn&rsquo;t compress negative integers well. </p>
<p>The second part of your response I think partially answers my question. And while it does map those negative values close to 0 to small positive integers, it does also map existing positive integers to larger positive integers.</p>
</div>
<ol class="children">
<li id="comment-648050" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-29T19:20:39+00:00">November 29, 2022 at 7:20 pm</time></a> </div>
<div class="comment-content">
<p>My blog post absolutely does not answer this question:</p>
<p><em>Is zigzag encoding the best encoding method for “getting rid of” negative integers for whichever function that compresses integers well, but doesn’t compress negative integers well.</em></p>
</div>
<ol class="children">
<li id="comment-648051" class="comment odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f111c352cd5721b0f944af0138b33611?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f111c352cd5721b0f944af0138b33611?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ethan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-29T19:47:46+00:00">November 29, 2022 at 7:47 pm</time></a> </div>
<div class="comment-content">
<p>Of course it doesn&rsquo;t. That&rsquo;s why I&rsquo;m here in the comments! However the blog post does directly state that there exists, or at least probably exists, some function that compresses (positive) integers well. </p>
<p>This is why I was quoting this piece:<br/>
&gt; This could be useful if you have a fast function to compress integers that fails to work well for negative integers.</p>
<p>I&rsquo;m wondering what the usefulness you mention there is like in practice. If it&rsquo;s not that important of a detail it seems like it wouldn&rsquo;t be included in your post. Maybe it&rsquo;s not. However, I don&rsquo;t think it&rsquo;s a trivial detail, which is why I&rsquo;m asking questions about it. </p>
<p>I&rsquo;ll think about this some more on my own.</p>
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
<li id="comment-648052" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marcin Zukowski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-29T19:50:59+00:00">November 29, 2022 at 7:50 pm</time></a> </div>
<div class="comment-content">
<p>From what I saw, varint is probably the most obvious example of such a function, and that&rsquo;s where I&rsquo;ve seen zigzag often.</p>
</div>
<ol class="children">
<li id="comment-648055" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-29T21:16:26+00:00">November 29, 2022 at 9:16 pm</time></a> </div>
<div class="comment-content">
<p>It would probably enhance zstd compression in this example:</p>
<p><a href="https://lemire.me/blog/2022/11/28/generic-number-compression-zstd/" rel="ugc">https://lemire.me/blog/2022/11/28/generic-number-compression-zstd/</a></p>
<p>It is also obviously applicable to other formats: <a href="https://github.com/lemire/streamvbyte" rel="nofollow ugc">https://github.com/lemire/streamvbyte</a></p>
</div>
</li>
</ol>
</li>
</ol>
