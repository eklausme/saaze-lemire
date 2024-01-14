---
date: "2018-11-17 12:00:00"
title: "Simple table size estimates and 128-bit numbers (Java Edition)"
index: false
---

[6 thoughts on &ldquo;Simple table size estimates and 128-bit numbers (Java Edition)&rdquo;](/lemire/blog/2018/11-17-simple-table-size-estimates-and-128-bit-numbers-java-edition)

<ol class="comment-list">
<li id="comment-365459" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-17T04:51:01+00:00">November 17, 2018 at 4:51 am</time></a> </div>
<div class="comment-content">
<p>To address the precision problem you could also take the first few terms of the binomial expansion of (1 &#8211; 1/p)^n &#8211; with a large p the terms go to zero essentially immediately so only the first few terms matter. The first term is 1, which nicely cancels out with the the preceeding <code>(1 -</code> part. Finally, you can multiply in the initial p since it cancels out also, since every other term is of the form <code>C / p^m</code>.</p>
<p>So you are left only with a few terms like A + B/p + C/p^2 &#8230; where A, B, C are the binomial coefficents (are these easy to calculate when big? <a href="https://math.stackexchange.com/a/927064/346316" rel="nofollow">maybe</a>).</p>
<p>I dunno if that&rsquo;s better or worse, but it&rsquo;s a common approach to tackling this kind of problem: re-arranging the problematic part of the formula.</p>
</div>
<ol class="children">
<li id="comment-365460" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-17T04:51:42+00:00">November 17, 2018 at 4:51 am</time></a> </div>
<div class="comment-content">
<p>Forgot to add: I haven&rsquo;t tried it, so I could definitely be full of it&#8230;</p>
</div>
</li>
<li id="comment-365673" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maynard Handley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-17T23:41:49+00:00">November 17, 2018 at 11:41 pm</time></a> </div>
<div class="comment-content">
<p>Since p is HUGE, the zero&rsquo;th order approximation is going to be pretty much perfect.<br/>
(1-1/p)^n~ 1-n/p,<br/>
expand everything out, and to zeroth&rsquo;s order the approximation is n.</p>
<p>If you want to go further, do a Taylor series in 1/p and you get<br/>
n &#8211; ((-1 + n) n)/(2 p) + ((-2 + n) (-1 + n) n)/(6 p^2)</p>
<p>But these correction terms are miniscule.<br/>
The exact (to 20 digits) answer is<br/>
48841.999999999999398<br/>
and that correction (of magnitude 10^-12) is the first order in 1/p correction. The second order correction is magnitude 10^-30.</p>
<p>So, yeah, for all practical purpose, no need for 128-bit arithmetic, just approximate Cardenas ~= n</p>
</div>
</li>
</ol>
</li>
<li id="comment-365477" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5224712291f60128ae70bd44338310d1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5224712291f60128ae70bd44338310d1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://moderndescartes.com" class="url" rel="ugc external nofollow">brian</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-17T06:51:06+00:00">November 17, 2018 at 6:51 am</time></a> </div>
<div class="comment-content">
<p>You can use the lim (1+1/n)^n approximation to $e$ to solve this problem mathematically. An example computation: <a href="http://www.moderndescartes.com/essays/birthday_paradox/" rel="nofollow ugc">http://www.moderndescartes.com/essays/birthday_paradox/</a></p>
</div>
</li>
<li id="comment-365495" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/79496390df1f49a4d253b2d1bab3a0d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/79496390df1f49a4d253b2d1bab3a0d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://pages.di.unipi.it/fpoloni/" class="url" rel="ugc external nofollow">Federico Poloni</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-17T08:20:01+00:00">November 17, 2018 at 8:20 am</time></a> </div>
<div class="comment-content">
<p>This can also be done in standard &ldquo;double&rdquo; arithmetic, using the log1p and expm1 functions, which are inteded exactly to counter this sort of instabilities.</p>
<p>See my answer here for how to perform exactly this calculation: <a href="https://math.stackexchange.com/a/2317045/65548" rel="nofollow ugc">https://math.stackexchange.com/a/2317045/65548</a> . I guess this method is going to be much faster than using BigDecimal.</p>
</div>
<ol class="children">
<li id="comment-365569" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-17T14:42:41+00:00">November 17, 2018 at 2:42 pm</time></a> </div>
<div class="comment-content">
<p>Aptroot on twitter suggested product * -Math.expm1(Math.log1p(-1.0/product) * n).</p>
</div>
</li>
</ol>
</li>
</ol>
