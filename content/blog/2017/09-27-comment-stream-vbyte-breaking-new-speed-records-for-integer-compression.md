---
date: "2017-09-27 12:00:00"
title: "Stream VByte: breaking new speed records for integer compression"
index: false
---

[11 thoughts on &ldquo;Stream VByte: breaking new speed records for integer compression&rdquo;](/lemire/blog/2017/09-27-stream-vbyte-breaking-new-speed-records-for-integer-compression)

<ol class="comment-list">
<li id="comment-287305" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8d437e8e6fcc94c9320e4b95e177933f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8d437e8e6fcc94c9320e4b95e177933f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Bye Fruit</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-27T19:59:17+00:00">September 27, 2017 at 7:59 pm</time></a> </div>
<div class="comment-content">
<p>This is interesting and the paper is very readable.</p>
<p>That said, are there any cases where you&rsquo;d use Stream VByte if you already had access to something like SIMD-BP128 or SIMD-PFOR?</p>
</div>
<ol class="children">
<li id="comment-287306" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-27T20:20:53+00:00">September 27, 2017 at 8:20 pm</time></a> </div>
<div class="comment-content">
<p>Thanks!</p>
<p>In the end, it is about having options as there is no silver bullet as far as software and algorithms are concerned.</p>
<p>For raw speed, it is hard to beat SIMD-BP128 if you have sizeable arrays and all you care about is decoding blocks to cache. And the compression rate is going to be quite good.</p>
<p>Stream VByte is simpler in the sense that you require just a few instructions to decode a block of 4 integers. So you can trivially iterate over blocks of 4 integers and process them while they are still in registers, without writing them to cache.</p>
<p>For SIMD-BP128, if you want to do something of the sort, it is simply going to be harder to program if you want to get the best possible performance (i.e., if you want to avoid writing the uncompressed data to cache and reloading it).</p>
<p>To sum it up, sometimes it is just desirable to iterate over values in tiny blocks that stay in vector registers.</p>
<p>We allude to this toward the end of the paper where we benchmark &ldquo;seek&rdquo; functions.</p>
<p>So, for some applications, Stream VByte will definitively be more appropriate.</p>
</div>
<ol class="children">
<li id="comment-287310" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8d437e8e6fcc94c9320e4b95e177933f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8d437e8e6fcc94c9320e4b95e177933f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bye Fruit</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-27T20:50:40+00:00">September 27, 2017 at 8:50 pm</time></a> </div>
<div class="comment-content">
<p>Great explanation, thanks.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-287479" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e214f5c143b40458c473bef6ee05823e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e214f5c143b40458c473bef6ee05823e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Martin Cohen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-29T05:30:17+00:00">September 29, 2017 at 5:30 am</time></a> </div>
<div class="comment-content">
<p>Minor typo: &ldquo;we need to keep the fed&rdquo;.</p>
</div>
</li>
<li id="comment-295282" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/507fe1a177b3d7ae2b67ad025b216340?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/507fe1a177b3d7ae2b67ad025b216340?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mike Scirocco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-20T05:01:22+00:00">January 20, 2018 at 5:01 am</time></a> </div>
<div class="comment-content">
<p>Very clear article, quite readable, and very generous of you not to patent this impressive bit of work.</p>
</div>
</li>
<li id="comment-433574" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1609b077dbe732d6f4095f6a9fd5d6bb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1609b077dbe732d6f4095f6a9fd5d6bb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kaartic Sivaraam</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-25T14:30:10+00:00">October 25, 2019 at 2:30 pm</time></a> </div>
<div class="comment-content">
<p>I think there is a typo in the following snippet:</p>
<blockquote><p>
you can compute y[0], y[0] + y[1], y[1] + y[2],&#8230; to recover x[0], x[1], x[2],&#8230;
</p></blockquote>
<p>y[1] + y[2] does not give x[2]. x[1] + y[2] does give x[2], though.</p>
</div>
<ol class="children">
<li id="comment-433673" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-26T02:06:54+00:00">October 26, 2019 at 2:06 am</time></a> </div>
<div class="comment-content">
<p>You are correct. This is what was meant: <tt>y[0], y[0] + y[1], y[0] + y[1] + y[2],...</tt>. It is a prefix sum.</p>
</div>
</li>
</ol>
</li>
<li id="comment-656923" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/692c2c21bffbbec8b782f333784a0b07?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/692c2c21bffbbec8b782f333784a0b07?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-13T23:31:29+00:00">December 13, 2023 at 11:31 pm</time></a> </div>
<div class="comment-content">
<p>Hi, great blog and papers! My interest is in analog-to-digital measurement streams of physical processes, say from an oscilloscope. These typically produce measurement integers 16 bit or less with zigzag encoded deltas typically no more than 8 bits. Subsequent operations on the decoded integers might be multiplying and adding calibration constants to recover the measured voltage data, finding elements greater than a voltage threshold, and performing DSP such as numerically integrating, window averaging, etc. The encoded stream would be loaded from disk or network as it does not make sense as an in-memory index like a database might use. Is Stream VByte, either off-the-shelf or adapted for 16 bit integers (e.g. 1 control bit instead of 2), a good fit for this? Is there any other approach you think might work better or are any performance gains unlikely to be realized by a delta encoding scheme? TYVM, I have learned a lot.</p>
</div>
<ol class="children">
<li id="comment-656924" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-14T00:30:00+00:00">December 14, 2023 at 12:30 am</time></a> </div>
<div class="comment-content">
<p>Without domain knowledge, it can be difficult to make technical recommendations. I do not know enough about your area to comment.</p>
</div>
<ol class="children">
<li id="comment-656947" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/692c2c21bffbbec8b782f333784a0b07?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/692c2c21bffbbec8b782f333784a0b07?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-14T16:45:34+00:00">December 14, 2023 at 4:45 pm</time></a> </div>
<div class="comment-content">
<p>That is reasonable. Thanks all the same. Are there some good searchable terms or resources you can recommend so I can learn how to evaluate the efficacy on my own?</p>
</div>
<ol class="children">
<li id="comment-656949" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-14T18:36:37+00:00">December 14, 2023 at 6:36 pm</time></a> </div>
<div class="comment-content">
<p>You can pick up an open source library and test different codecs on your data. You could start, for example, with <a href="https://github.com/lemire/SIMDCompressionAndIntersection" rel="nofollow ugc">https://github.com/lemire/SIMDCompressionAndIntersection</a> if you are a C++ programmer. There are comparable libraries in most programming languages.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
