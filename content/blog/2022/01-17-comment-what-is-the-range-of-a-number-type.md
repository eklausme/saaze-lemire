---
date: "2022-01-17 12:00:00"
title: "What is the &#8216;range&#8217; of a number type?"
index: false
---

[8 thoughts on &ldquo;What is the &#8216;range&#8217; of a number type?&rdquo;](/lemire/blog/2022/01-17-what-is-the-range-of-a-number-type)

<ol class="comment-list">
<li id="comment-617007" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0b126774a8c8e5682f1562865369af89?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0b126774a8c8e5682f1562865369af89?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">peng</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-17T21:57:35+00:00">January 17, 2022 at 9:57 pm</time></a> </div>
<div class="comment-content">
<p>float numbers/ real numbers is much complicated than integers. the range of float needs to worry about more than upper and lower bound, but also minimum closet difference between any two consecutive float number.</p>
</div>
</li>
<li id="comment-617094" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Thomas Müller Graf</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-18T14:53:46+00:00">January 18, 2022 at 2:53 pm</time></a> </div>
<div class="comment-content">
<p>I find it weird that 0.0 1 is out of range (not rounded to 0), but 1.0 1 is not out of range, and rounded instead to 1. The round-trip behavior might also be weird for numbers very close to (but not exactly) 0. </p>
<p>gcc 11.2 can parse 2.22507e-308, but a bit below that is out of range.</p>
</div>
<ol class="children">
<li id="comment-617102" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-18T15:32:22+00:00">January 18, 2022 at 3:32 pm</time></a> </div>
<div class="comment-content">
<p>Your comment did not come out right. There is a formatting issue.</p>
</div>
<ol class="children">
<li id="comment-617220" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thomas Müller Graf</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-19T10:32:20+00:00">January 19, 2022 at 10:32 am</time></a> </div>
<div class="comment-content">
<p>I find it weird that 0.0 (&#8230;400 times 0&#8230;) 1 is out of range (not rounded to 0), but 1.0 (&#8230;400 times 0&#8230;) 1 is not out of range, and rounded instead to 1. </p>
<p>The round-trip behavior might also be weird for numbers very close to (but not exactly) 0: I&rsquo;m wondering if it will always work as expected if a number is first converted to a string, and then parsed again.</p>
<p>gcc 11.2 can parse 2.22507e-308, but a bit below that is out of range. This doesn&rsquo;t match the bound you gave with of 4.94e-324.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-617253" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0d1e2557d7b1ce876e1b2f12af68dd05?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0d1e2557d7b1ce876e1b2f12af68dd05?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nicolas</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-19T13:54:58+00:00">January 19, 2022 at 1:54 pm</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s probably best to consider 64-bit floating point range to be from 1.1e-308 to 1.8e308, i.e. excluding denormal values. Including denormal numbers is problematic because of the loss of precision. Including numbers beyond that is pointless because they are not representable.</p>
</div>
<ol class="children">
<li id="comment-617266" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-19T14:51:19+00:00">January 19, 2022 at 2:51 pm</time></a> </div>
<div class="comment-content">
<p>Surely, you want to include the two zeros as well as the negative numbers?</p>
</div>
<ol class="children">
<li id="comment-617269" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0d1e2557d7b1ce876e1b2f12af68dd05?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0d1e2557d7b1ce876e1b2f12af68dd05?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nicolas</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-19T14:58:09+00:00">January 19, 2022 at 2:58 pm</time></a> </div>
<div class="comment-content">
<p>Sure that would make sense.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-619225" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9aafe25b630c5b68aaefb00e38b4a00b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9aafe25b630c5b68aaefb00e38b4a00b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">pomarides Vofo</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-31T00:21:13+00:00">January 31, 2022 at 12:21 am</time></a> </div>
<div class="comment-content">
<p>&lt;&gt;</p>
<p>How infinity could be inclusive?</p>
<p>just only going from the definition it is simply impossible.</p>
</div>
</li>
</ol>
