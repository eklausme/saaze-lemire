---
date: "2019-03-12 12:00:00"
title: "Multiplying by the inverse is not the same as the division"
index: false
---

[12 thoughts on &ldquo;Multiplying by the inverse is not the same as the division&rdquo;](/lemire/blog/2019/03-12-multiplying-by-the-inverse-is-not-the-same-as-the-division)

<ol class="comment-list">
<li id="comment-394355" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-12T15:51:02+00:00">March 12, 2019 at 3:51 pm</time></a> </div>
<div class="comment-content">
<p>I would hope that anyone with a passing familiarity with floating point numbers and numerical issues would not find this surprising!</p>
<p>As a rule of thumb, I assume that <em>any</em> transformation which changes the order of operations, or combines or splits operations into new ones, may have a different result as the original formulation.</p>
<p>I&rsquo;m curious about the counter-examples to this rule. I can think of only a few trivial transformations that can work, like <code>a - b = a + (-b)</code> because in that case the magnitude of everything is the same after the transformation, but for pretty much anything interesting it seems, naively, like the rule would apply.</p>
</div>
<ol class="children">
<li id="comment-394374" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-12T18:13:32+00:00">March 12, 2019 at 6:13 pm</time></a> </div>
<div class="comment-content">
<p><em>I would hope that anyone with a passing familiarity with floating point numbers and numerical issues would not find this surprising!</em></p>
<p>Indeed, but it could be true (that x/y = x * (1/y)), in C/C++ if you use the &ldquo;-ffast-math&rdquo; flag on some compilers. When examining outputs from godbolt, I find that compilers do not seem to make use of the optimizations described in Reynold&rsquo;s post. However, if you use the &ldquo;-ffast-math&rdquo; flag, they do turn the division into a multiplication, but without any apparent correction factor.</p>
</div>
<ol class="children">
<li id="comment-394392" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-12T20:03:27+00:00">March 12, 2019 at 8:03 pm</time></a> </div>
<div class="comment-content">
<p>Yes, because that&rsquo;s what basically what<code>-ffast-math</code> means: perform transformations on floating point &ldquo;expressions&rdquo; that do not necessarily preserve the exact C/C++-rules-following IEEE754 results of the literal expression in the source.</p>
<p>This doesn&rsquo;t always mean a <em>worse</em> result either: sometimes the result of <code>-ffast-math</code> is closer to the true result than the version that follows the literal source (e.g., when using an FMA to replace discrete multiply and addition, since it preserves precision in the intermediate value).</p>
<p>I see what you are saying though: <code>-ffast-math</code> may perform a transformation on what appears to be a single operation, transforming it to a reciprocal multiplication and giving a different result. So it&rsquo;s not just multi-operation expressions that might be eligible for this type of transformation.</p>
<blockquote><p>
Indeed, but it could be true
</p></blockquote>
<p>I&rsquo;m going to admit to not understanding what the &ldquo;it&rdquo; is in this sentence.</p>
</div>
<ol class="children">
<li id="comment-394396" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-12T20:26:11+00:00">March 12, 2019 at 8:26 pm</time></a> </div>
<div class="comment-content">
<p>The &ldquo;it&rdquo; was a reference to &ldquo;x/y = x * (1/y) is true&rdquo;. Bad English on my part.</p>
</div>
<ol class="children">
<li id="comment-394403" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-12T21:52:01+00:00">March 12, 2019 at 9:52 pm</time></a> </div>
<div class="comment-content">
<p>I see.</p>
<p>It ends up being true because both sides are calculating it the less precise way, not because both sides are calculating it the precise way!</p>
<p>Every day I count my blessings that I have don&rsquo;t actually need to use floating point math in any significant capacity in my day-to-day activities :).</p>
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
<li id="comment-394488" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-13T08:30:49+00:00">March 13, 2019 at 8:30 am</time></a> </div>
<div class="comment-content">
<p>An interesting question on the subject: what floating point values of a satisfy the following for all x:</p>
<p>x / a == x * (1 / a)</p>
<p>Only trivial solutions I can think of are 0 or of the form 2^n (n being integer, of course), because any other inverse of a would result an infinite binary expansion. But floating point arithmetic is finite in precision, so are there non-trivial variants that work correctly (at least on some rounding mode)?</p>
</div>
<ol class="children">
<li id="comment-394657" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-14T06:20:00+00:00">March 14, 2019 at 6:20 am</time></a> </div>
<div class="comment-content">
<p>Quick empirical estimation suggests that no values which would avoid errors, apart from powers of two, really exist. There are constants for which rounding errors are rarer than for others, but even for the square root of two which is one of the better candidates almost 13% of results are wrong, and for the square root of three which is on the worse end around 50% of results are off.</p>
<p>On average, multiplication by floating point inverse seems to differ from IEEE division for about 27% of (uniformly distributed) values.</p>
</div>
<ol class="children">
<li id="comment-395627" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/62aaaf6dfc5c0fd3c037fa9fb106c677?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/62aaaf6dfc5c0fd3c037fa9fb106c677?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://marc-b-reynolds.github.io/" class="url" rel="ugc external nofollow">Marc Reynolds</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-18T20:04:27+00:00">March 18, 2019 at 8:04 pm</time></a> </div>
<div class="comment-content">
<p>Yeah 1/y is only exact for POT. Reference support: <a href="https://hal.inria.fr/ensl-00409366" rel="nofollow ugc">https://hal.inria.fr/ensl-00409366</a></p>
<p>And the approximate number of exact is also tight. Reference: <a href="http://perso.ens-lyon.fr/jean-michel.muller/fpdiv.html" rel="nofollow ugc">http://perso.ens-lyon.fr/jean-michel.muller/fpdiv.html</a> (in the supplement)</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-394633" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/14d5cef9d2549ed933b1dd68bf8cabe1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/14d5cef9d2549ed933b1dd68bf8cabe1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">John Campbell</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-14T02:31:53+00:00">March 14, 2019 at 2:31 am</time></a> </div>
<div class="comment-content">
<p>The difference identified appears to be related to how round-off is applied to the last bit for floating point numbers.<br/>
-ffast-math also modifies how round-off is applied.<br/>
The other modifier is multi-threaded calculations, which frequently has a more significant effect on round-off, not only for the last bit but for more significant precision loss in sums, often with more significant effects.<br/>
When summing floating point values, any assessment of the significance of this last-bit error needs to consider the accuracy available from the input values, which should show the available accuracy is much less than this last-bit error. Variations in the last bit are rarely a significant problem.</p>
</div>
<ol class="children">
<li id="comment-395026" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-16T16:52:59+00:00">March 16, 2019 at 4:52 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
The other modifier is multi-threaded calculations, which frequently<br/>
has a more significant effect on round-off, not only for the last bit<br/>
but for more significant precision loss in sums, often with more<br/>
significant effects.
</p></blockquote>
<p>I&rsquo;m not quite following this. By multi-threaded I assume you mean breaking a serial computation into parts, calculating the parts and then recombining the result?</p>
<p>Although this leads to a <em>different</em> result in general it is not obvious to me that it generally leads to a less precise result.</p>
<p>Indeed, for basic examples like a sum of all elements in a vector, I would expect multiple accumulators needed for parallel sums to <em>reduce</em> error since magnitudes are smaller and split across more mantissa bits.</p>
</div>
<ol class="children">
<li id="comment-395424" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/14d5cef9d2549ed933b1dd68bf8cabe1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/14d5cef9d2549ed933b1dd68bf8cabe1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">John Campbell</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-18T05:06:48+00:00">March 18, 2019 at 5:06 am</time></a> </div>
<div class="comment-content">
<p>I agree that in some cases summing the parts can reduce the apparent error.<br/>
When subtracting two near equal values (a-b), the accuracy is not due to the last bit adjustment, but an assessment of the available accuracy of a and b. So I often find that the maximum error estimate, based on the (storage) accuracy of each input value, can be more significant than the error due to using the inverse.<br/>
It is in sums, rather than products that accuracy needs to be reviewed.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-394708" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Me</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-14T13:46:03+00:00">March 14, 2019 at 1:46 pm</time></a> </div>
<div class="comment-content">
<p>The main question is how big the loss in accuracy is compared to the performance gains.</p>
<p>In your example, the error probably is about 1 ulp? That is usually well within tolerance.</p>
</div>
</li>
</ol>
