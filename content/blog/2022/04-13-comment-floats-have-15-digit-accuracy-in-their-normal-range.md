---
date: "2022-04-13 12:00:00"
title: "Floats have 15-digit accuracy in their normal range"
index: false
---

[4 thoughts on &ldquo;Floats have 15-digit accuracy in their normal range&rdquo;](/lemire/blog/2022/04-13-floats-have-15-digit-accuracy-in-their-normal-range)

<ol class="comment-list">
<li id="comment-627709" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/95e38a3c10b5b4899cea9930ad99556e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/95e38a3c10b5b4899cea9930ad99556e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Erich Schubert</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-04-15T14:22:46+00:00">April 15, 2022 at 2:22 pm</time></a> </div>
<div class="comment-content">
<p>Some libraries such as Facebook AI FAISS use single precision, so they only have 7 digits.</p>
<p>When working with squared values, e.g., when computing variance, covariance, PCA, or kmeans, going back from squares to linear values tends to cut this precision in half. So 4 digits for single precision, 8 for double.</p>
<p>Try computing the variance of 10000, 10002 in some of these tools&#8230; or of 1000000 and 1000000.02 in some SQL databses.</p>
</div>
<ol class="children">
<li id="comment-627711" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-04-15T14:55:19+00:00">April 15, 2022 at 2:55 pm</time></a> </div>
<div class="comment-content">
<p>The variance of 100000000 and 100000002 is a problem with 32-bit floating-point numbers, but I think that the variance of 10000 and 10002 is fine.</p>
<p>Can you elaborate ?</p>
</div>
</li>
<li id="comment-627771" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">George Spelvin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-04-16T06:49:05+00:00">April 16, 2022 at 6:49 am</time></a> </div>
<div class="comment-content">
<p>Actually, squared values are an exponent problem, not a mantissa problem. Squaring can be thought of (very approximately) as moving the msbit of the mantissa to the lsbit of the exponent.</p>
<p>So any two distinct floats have distinct squares, <em>if there is no over/underflow</em> This is not true in reverse; on average each float has one other which shares the same square root.</p>
<p>So this mean that an algorithm which computes an accurate variance loses one additional lsbit when converting to standard deviation, but that&rsquo;s not horrible.</p>
<p>The problem with variance is cancellation; the naive algorithms require a large amount of excess precision. But if you have a good estimate of the mean (e.g. using a first pass), then the two-pass compensated algorithm produces an excellent variance without needing extra-precision temporaries.</p>
</div>
<ol class="children">
<li id="comment-628806" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b0c28eb357bb2ad8dee40d974871340?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b0c28eb357bb2ad8dee40d974871340?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Erich Schubert</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-04-22T07:12:26+00:00">April 22, 2022 at 7:12 am</time></a> </div>
<div class="comment-content">
<p>Several libraries still use the naive approach when computing such values!<br/>
E.g. FAISS for PCA (and PCA based indexing&#8230;)<br/>
E.g., sklearn when computing Euclidean distance using sqrt(a²+b²-2ab) &#8211; but they always use double precision here to lessen the effects for single precision input data.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
