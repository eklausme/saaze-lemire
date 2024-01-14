---
date: "2019-01-29 12:00:00"
title: "Data scientists need to learn about significant digits"
index: false
---

[3 thoughts on &ldquo;Data scientists need to learn about significant digits&rdquo;](/lemire/blog/2019/01-29-data-scientists-need-to-learn-about-significant-digits)

<ol class="comment-list">
<li id="comment-385697" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3d6bd74e2e7210c80f9e12d1638878d2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3d6bd74e2e7210c80f9e12d1638878d2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">John the Scott</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-30T16:44:00+00:00">January 30, 2019 at 4:44 pm</time></a> </div>
<div class="comment-content">
<p>most excellent post. i recommend gustafson&rsquo;s book for another angle on digital error.</p>
<p><code>https://www.amazon.com/End-Error-Computing-Chapman-Computational/dp/1482239868/ref=sr_1_1?s=books&amp;ie=UTF8&amp;qid=1548866338&amp;sr=1-1&amp;keywords=the+end+of+error<br/>
</code></p>
</div>
</li>
<li id="comment-385856" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/083d33c95c105aeab6b6fb708a0e04fe?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/083d33c95c105aeab6b6fb708a0e04fe?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">ttoinou</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T06:25:15+00:00">January 31, 2019 at 6:25 am</time></a> </div>
<div class="comment-content">
<p>Of course you&rsquo;re right.</p>
<p>If you&rsquo;re exchanging information with scientists / engineers you could also provide with every F figure its Â±P &ldquo;precision&rdquo; (Y% of chance to be in the Gaussian centered on F with k(Y)*P standard-deviation, k to be computed from Y). That way if the person you&rsquo;re giving information to needs to compute a new statistic, it can combines Gaussian models and have a new (F&rsquo; Â± P&rsquo;)</p>
</div>
</li>
<li id="comment-657423" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c517308545af715e4f58985166f27d17?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c517308545af715e4f58985166f27d17?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michael Nelson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-26T23:13:24+00:00">December 26, 2023 at 11:13 pm</time></a> </div>
<div class="comment-content">
<p>I would add to the statement &ldquo;serious people will not be so easily fooled.&rdquo; When I see such precision in reduces my confidence in the source. My internal &ldquo;bozo&rdquo; warning light comes on.<br/>
I had the concept of significant digits pounded in to my head by my (very excellent) high school science teachers. Now I have an aversion to over-precision.</p>
</div>
</li>
</ol>
