---
date: "2023-03-10 12:00:00"
title: "Trimming spaces from strings faster with SVE on an Amazon Graviton 3 processor"
index: false
---

[13 thoughts on &ldquo;Trimming spaces from strings faster with SVE on an Amazon Graviton 3 processor&rdquo;](/lemire/blog/2023/03-10-trimming-spaces-from-strings-faster-with-sve-on-an-amazon-graviton-3-processor)

<ol class="comment-list">
<li id="comment-649759" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/43975618962ee410fba61c44d2847068?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/43975618962ee410fba61c44d2847068?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://notlikely.ca" class="url" rel="ugc external nofollow">Bill</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-13T14:28:48+00:00">March 13, 2023 at 2:28 pm</time></a> </div>
<div class="comment-content">
<p>I wonder if it would speed up Unicode whitespace removal or could be twisted into removing all whitespace type of characters (VT, HT, NL, CR, &#8230;)?</p>
</div>
<ol class="children">
<li id="comment-649760" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-13T14:59:44+00:00">March 13, 2023 at 2:59 pm</time></a> </div>
<div class="comment-content">
<p>It can be generalized, yes. Note that the functions described in the blog post will work correctly with UTF-8 inputs.</p>
</div>
</li>
</ol>
</li>
<li id="comment-649762" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b29538e6dc6cb2bf25813f35562e974b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b29538e6dc6cb2bf25813f35562e974b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Evan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-13T19:11:13+00:00">March 13, 2023 at 7:11 pm</time></a> </div>
<div class="comment-content">
<p>The documentation I have seen shows that SVE does not need a drain operation, it can instead be predicated to do a partial operation for the remainder elements.</p>
<p>See slides 32 and 33 of this <a href="http://www.cse.iitm.ac.in/~rupesh/events/arm2021/CDAC%20-%20Overview%20of%20the%20Arm%20ISA%20for%20HPC.pdf" rel="nofollow ugc">SVE presentation</a> for an example of what I mean.</p>
<p>Is there a specific reason why you coded it do work in two steps? I could see this being a naive translation from SIMD (NEON) style to SVE, but I don’t think it is leveraging the full benefits of SVE predication.</p>
</div>
<ol class="children">
<li id="comment-649764" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-13T19:56:49+00:00">March 13, 2023 at 7:56 pm</time></a> </div>
<div class="comment-content">
<p><em>See slides 32 and 33 of this SVE presentation for an example of what I mean.</em></p>
<p>If you write it in this manner, you will have an additional intrinsic function per loop (and the accompanying instruction) compared to my solution (focus on the main loop).</p>
<p><em>Is there a specific reason why you coded it do work in two steps? </em></p>
<p>For better performance. I have added the single-loop function to my benchmark, you can test it out and verify that it is slower.</p>
</div>
<ol class="children">
<li id="comment-649766" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b29538e6dc6cb2bf25813f35562e974b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b29538e6dc6cb2bf25813f35562e974b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Evan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-13T20:13:25+00:00">March 13, 2023 at 8:13 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for the response, I suspected that may be the reason why.</p>
<p>What if you use the optimization given on slide 34 to elide the i &lt; len comparison? Does it catch back up? Sorry I do not have access right now to test it myself 🙂</p>
</div>
<ol class="children">
<li id="comment-649768" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-13T21:01:47+00:00">March 13, 2023 at 9:01 pm</time></a> </div>
<div class="comment-content">
<p>I have added the one loop alternative you pointed to. The performance is slightly improved but still very much inferior to the two-loop approach.</p>
<p>I should point out that my expectation is that my implementation with a loop and a trail is probably too simple and could be optimized further (at the cost of greater code complexity).</p>
<pre>
scalar
cycles/bytes 1.75

sve one loop
cycles/bytes 0.70

sve one loop alt
cycles/bytes 0.66

sve
cycles/bytes 0.47 
</pre>
<p>So, unfortunately, the pretty code that ARM is displaying on their slides is likely not optimal.</p>
<p>Of course, this could change with future compilers and/or processors. For example, the compiler could do the unrolling for you.</p>
</div>
</li>
</ol>
</li>
<li id="comment-649767" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b29538e6dc6cb2bf25813f35562e974b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b29538e6dc6cb2bf25813f35562e974b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Evan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-13T20:17:51+00:00">March 13, 2023 at 8:17 pm</time></a> </div>
<div class="comment-content">
<p>Also sorry for saying it was a somehow bad or naive translation from neon, clearly not the case.</p>
<p>Enjoyed the post, thanks for sharing.</p>
</div>
<ol class="children">
<li id="comment-649769" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-13T21:04:57+00:00">March 13, 2023 at 9:04 pm</time></a> </div>
<div class="comment-content">
<p><em>Also sorry for saying it was a somehow bad or naive translation from neon, clearly not the case.</em></p>
<p>You might be interested in going back in time to how I started with SVE:<br/>
<a href="https://lemire.me/blog/2022/06/23/filtering-numbers-quickly-with-sve-on-amazon-graviton-3-processors/" rel="ugc">https://lemire.me/blog/2022/06/23/filtering-numbers-quickly-with-sve-on-amazon-graviton-3-processors/</a></p>
<p>You might notice that my early code matched the ARM slides more than my recent code.</p>
<p>So, in some sense, what looked to you like &ldquo;naive&rdquo; code is, from my point of view, more sophisticated (optimized) code&#8230;i.e., it will run faster.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-649763" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b29538e6dc6cb2bf25813f35562e974b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b29538e6dc6cb2bf25813f35562e974b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Evan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-13T19:13:59+00:00">March 13, 2023 at 7:13 pm</time></a> </div>
<div class="comment-content">
<p>Also why does the second operation use svcmpeq while the loop uses svcmpne?</p>
</div>
<ol class="children">
<li id="comment-649765" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-13T19:57:07+00:00">March 13, 2023 at 7:57 pm</time></a> </div>
<div class="comment-content">
<p>A typographical error. Thanks for pointing it out.</p>
</div>
</li>
</ol>
</li>
<li id="comment-649774" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-14T10:34:31+00:00">March 14, 2023 at 10:34 am</time></a> </div>
<div class="comment-content">
<p>Do you have any speed comparisons against NEON versions of the earlier despacer?</p>
</div>
<ol class="children">
<li id="comment-649775" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-14T15:58:03+00:00">March 14, 2023 at 3:58 pm</time></a> </div>
<div class="comment-content">
<p>My source code online includes the NEON version. The performance is comparable. However, the NEON version requires a large table.</p>
</div>
<ol class="children">
<li id="comment-649785" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-15T13:18:26+00:00">March 15, 2023 at 1:18 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for the info!</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
