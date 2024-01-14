---
date: "2017-12-06 12:00:00"
title: "Simplistic programming is underrated"
index: false
---

[65 thoughts on &ldquo;Simplistic programming is underrated&rdquo;](/lemire/blog/2017/12-06-simplistic-programming-is-underrated)

<ol class="comment-list">
<li id="comment-292771" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f2f50209e20d463abe3cd859f3ecb057?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f2f50209e20d463abe3cd859f3ecb057?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://endormitoire.wordpress.com" class="url" rel="ugc external nofollow">Benoit St-Jean</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-06T10:28:51+00:00">December 6, 2017 at 10:28 am</time></a> </div>
<div class="comment-content">
<p>I must say that, most of the time I had to deal with complex code, it was often a case of early optimization. Some people just don&rsquo;t get it : make it work first, optimize only when necessary!</p>
</div>
<ol class="children">
<li id="comment-292905" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/82327e990dd049a5ba08438ad3db505a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/82327e990dd049a5ba08438ad3db505a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Greg Baryza</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T15:19:59+00:00">December 7, 2017 at 3:19 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;d go even further: make it work correctly and let the compiler optimize it. Once it&rsquo;s written, future maintenance work may completely undo any hand-optimization you have implemented. The compiler, on the other hand, always has (or always should have) a global view of the program. Let it do its work.</p>
</div>
</li>
<li id="comment-292906" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9cf3f23658c5f020a5104ec3bd2c63ca?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9cf3f23658c5f020a5104ec3bd2c63ca?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://jacopretorius.net" class="url" rel="ugc external nofollow">Jaco Pretorius</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T15:25:21+00:00">December 7, 2017 at 3:25 pm</time></a> </div>
<div class="comment-content">
<p>This resonates with me &#8211; often when I&rsquo;m dealing with complex code (or at least code that feels complex but shouldn&rsquo;t) is just to rewrite it in a very simplistic way &#8211; collapse multiple classes into one, collapse multiple methods into one, remove leaky abstractions in favor of duplication etc. Often the root of the problem is that an engineer will try to create an abstraction before understanding the contracts and interactions between different objects.</p>
</div>
<ol class="children">
<li id="comment-293177" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6f48bcd42389d61e55a498beadec410e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6f48bcd42389d61e55a498beadec410e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Yaakov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-10T18:18:08+00:00">December 10, 2017 at 6:18 pm</time></a> </div>
<div class="comment-content">
<p>How is one method more simplistic than multiple methods, each simple in itself? Isn&rsquo;t that the Unix/Linux/etc. way of doing things, to write many simple methods that can work together?</p>
</div>
</li>
</ol>
</li>
<li id="comment-292913" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a6763cc3723519b8c50e2cba1c4b9fa0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a6763cc3723519b8c50e2cba1c4b9fa0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.simplesoftwarebydesign.com" class="url" rel="ugc external nofollow">Bruce W. Roeser</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T16:05:03+00:00">December 7, 2017 at 4:05 pm</time></a> </div>
<div class="comment-content">
<p>Absolutely.</p>
</div>
</li>
</ol>
</li>
<li id="comment-292782" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ec88587b867c47ffd61c3942dd3ff89a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ec88587b867c47ffd61c3942dd3ff89a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-06T14:11:40+00:00">December 6, 2017 at 2:11 pm</time></a> </div>
<div class="comment-content">
<p>Pure functional programming often has very simple syntax, and is arguably more simple than object oriented programming. Many when they learn it first actually have an easier time than learning object oriented programming and its inheritance, parametric polymorphism, dependency injection as well as the numerous complicated patterns that go with them. Monads, Monoids and all those big mathy words FP users talk about exist in every programming language. People who use functional languages just like talking about them because its a very broad group. Just like every other language, you don&rsquo;t have to use them, or you can use them without knowing that very broad grouping.</p>
</div>
<ol class="children">
<li id="comment-292783" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ec88587b867c47ffd61c3942dd3ff89a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ec88587b867c47ffd61c3942dd3ff89a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-06T14:12:21+00:00">December 6, 2017 at 2:12 pm</time></a> </div>
<div class="comment-content">
<p>Being said I agree there is a lot of wisdom in only using the level of complexity required for the job.</p>
</div>
<ol class="children">
<li id="comment-292914" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a6763cc3723519b8c50e2cba1c4b9fa0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a6763cc3723519b8c50e2cba1c4b9fa0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.simplesoftwarebydesign.com" class="url" rel="ugc external nofollow">Bruce W. Roeser</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T16:08:25+00:00">December 7, 2017 at 4:08 pm</time></a> </div>
<div class="comment-content">
<p>Exactly right. Couldn&rsquo;t agree more. One time, a number of years ago, I increased the performance of a dealer-locator table generation routine just a bit, replacing a program that took 4-and-a-half days to complete with one that took a little under an hour by writing a simple little C program that took almost no memory (I think it was a 24K COM executable). Extremely simple, and absolutely fast.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-292784" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8d876883ba77ec7869f0f6fb3326427b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8d876883ba77ec7869f0f6fb3326427b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">J</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-06T14:17:20+00:00">December 6, 2017 at 2:17 pm</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s really sad that you lost your love of words due to peer pressure.</p>
</div>
<ol class="children">
<li id="comment-292917" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d6f522872bf07297c81b821db68df96a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d6f522872bf07297c81b821db68df96a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Justin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T16:13:15+00:00">December 7, 2017 at 4:13 pm</time></a> </div>
<div class="comment-content">
<p>Nope, it&rsquo;s awesome. Drop the love of words and focus on the love for *communicating*.</p>
</div>
</li>
<li id="comment-292934" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/df3562b3e9f5824e325086f7d2875888?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/df3562b3e9f5824e325086f7d2875888?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Doug</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T18:59:19+00:00">December 7, 2017 at 6:59 pm</time></a> </div>
<div class="comment-content">
<p>I would guess that he did not lose his love of words, he just learned how to contextualize. There is a time and a place (and a people group) for everything.</p>
</div>
</li>
</ol>
</li>
<li id="comment-292785" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d1fe56977211dee2445a3f1ef7c37b88?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d1fe56977211dee2445a3f1ef7c37b88?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michael Wayne Lunsford</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-06T14:21:25+00:00">December 6, 2017 at 2:21 pm</time></a> </div>
<div class="comment-content">
<p>I totally agree, make it work, then optimize. It&rsquo;s so exciting when it works then the art of beautification comes later.</p>
</div>
<ol class="children">
<li id="comment-292862" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1f2203ef6e59f89946ca1762dd81fc22?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1f2203ef6e59f89946ca1762dd81fc22?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Laszlo Varga</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T08:36:43+00:00">December 7, 2017 at 8:36 am</time></a> </div>
<div class="comment-content">
<p>When the art of beautification comes later, it many times depends on the business/budget. If the pressure is hight, it&rsquo;s really difficult to have more time to beautify.<br/>
If you write beautiful code from the beginning, you don&rsquo;t need to convince anybody that it worths the beautification.</p>
</div>
<ol class="children">
<li id="comment-292915" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a6763cc3723519b8c50e2cba1c4b9fa0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a6763cc3723519b8c50e2cba1c4b9fa0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.simplesoftwarebydesign.com" class="url" rel="ugc external nofollow">Bruce W. Roeser</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T16:10:52+00:00">December 7, 2017 at 4:10 pm</time></a> </div>
<div class="comment-content">
<p>Yup. If you write your code as simple and &ldquo;pretty&rdquo; as possible from the start, you&rsquo;ll find rework less necessary. Getting it right the first time can be done if you just take enough time to think the problem out and put it together a piece at a time.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-292786" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e039c3c2e54e4eb62c21f74e339a11ef?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e039c3c2e54e4eb62c21f74e339a11ef?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Francis Lalonde</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-06T14:50:21+00:00">December 6, 2017 at 2:50 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m doing the &ldquo;Advent of Code&rdquo; competition for the first time this year and decided to revisit programming languages I&rsquo;ve used in the past, starting with the oldest. I&rsquo;ve even decided to stick with deprecated conventions for good measure. </p>
<p>As a warm up I typed:</p>
<p>10 PRINT &ldquo;BONJOUR&rdquo;<br/>
20 GOTO 10</p>
<p>As childish as it is, I felt great joy seeing this run for the first time in decades. There is definitely something to be said for simplicity.</p>
</div>
</li>
<li id="comment-292794" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/558ea1f66cb437936d74c8e447bc3f43?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/558ea1f66cb437936d74c8e447bc3f43?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://shiroyasha.io" class="url" rel="ugc external nofollow">Igor Sarcevic</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-06T16:16:09+00:00">December 6, 2017 at 4:16 pm</time></a> </div>
<div class="comment-content">
<p>Writing simple code is actually very hard. You need to have a deep understanding of the underlying concepts.</p>
<p>Going from complex ideas, to simpler ones is usually a sign of technical maturity. It comes with time, and many many years of writing code.</p>
</div>
<ol class="children">
<li id="comment-292899" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/961155915d3e65113b92cc50936e2464?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/961155915d3e65113b92cc50936e2464?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jim Pucci</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T14:26:16+00:00">December 7, 2017 at 2:26 pm</time></a> </div>
<div class="comment-content">
<p>good observation</p>
</div>
</li>
<li id="comment-292911" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/017206687bef34fdcfa4d9cd3523788b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/017206687bef34fdcfa4d9cd3523788b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Drago Vuckovic</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T15:48:49+00:00">December 7, 2017 at 3:48 pm</time></a> </div>
<div class="comment-content">
<p>I agree with you on this.</p>
</div>
</li>
<li id="comment-292916" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a6763cc3723519b8c50e2cba1c4b9fa0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a6763cc3723519b8c50e2cba1c4b9fa0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.simplesoftwarebydesign.com" class="url" rel="ugc external nofollow">Bruce W. Roeser</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T16:11:47+00:00">December 7, 2017 at 4:11 pm</time></a> </div>
<div class="comment-content">
<p>Yes sir, well said.</p>
</div>
</li>
</ol>
</li>
<li id="comment-292799" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/252a2d40d0dc35b68b0455c63f448781?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/252a2d40d0dc35b68b0455c63f448781?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kyle</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-06T16:52:00+00:00">December 6, 2017 at 4:52 pm</time></a> </div>
<div class="comment-content">
<p>Focusing too much on &ldquo;simple&rdquo; can also be an easy trap to fall into. Good code is a balance between concisely expressing your intent, and minimizing complexity. Less code is better even if the code is more complex, but too much complexity can end up swamping the savings you get from reducing the code. Generally, once you strip away all the things you MIGHT someday need, and get down to what you ACTUALLY need right now, you can express that using concise and simple constructs.</p>
</div>
<ol class="children">
<li id="comment-292900" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/23d2ff9623d55d61031554d09d58da24?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/23d2ff9623d55d61031554d09d58da24?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.teledynelecroy.com" class="url" rel="ugc external nofollow">Joseph S.</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T14:32:49+00:00">December 7, 2017 at 2:32 pm</time></a> </div>
<div class="comment-content">
<p>I understand your point, but somewhere this is a boundary between stripping out things that MIGHT someday be needed vs writing code that is easy to modify for the suspected next requirement coming.</p>
</div>
</li>
<li id="comment-292918" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a6763cc3723519b8c50e2cba1c4b9fa0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a6763cc3723519b8c50e2cba1c4b9fa0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.simplesoftwarebydesign.com" class="url" rel="ugc external nofollow">Bruce W. Roeser</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T16:13:48+00:00">December 7, 2017 at 4:13 pm</time></a> </div>
<div class="comment-content">
<p>I disagree. You can never be too simple in your coding. You can certainly design it with growth in mind but &ldquo;leaving hooks&rdquo; in your design to implement said growth can be a natural part of the design if you have that in mind while developing the code.</p>
</div>
</li>
<li id="comment-292932" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9c85908e1e08c0aa2f900b8f1c305952?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9c85908e1e08c0aa2f900b8f1c305952?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Paul</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T17:21:26+00:00">December 7, 2017 at 5:21 pm</time></a> </div>
<div class="comment-content">
<p>In general I disagree with less code is better even if it&rsquo;s more complex. Most of the cost of a program is in maintaining it. If complex code runs a millisecond faster most of the time it does not matter. If it takes longer for you to understand what you did six months ago or hours for someone else to understand and modify the code, then the complexity has a price far above a few extra lines of code. </p>
<p>That being said, if speed is of the essence, then complexity for the sake of speed is acceptable.</p>
<p>Simpler code will better express your intent. Especially to someone reading your code for the first time.</p>
</div>
</li>
</ol>
</li>
<li id="comment-292800" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/084631ae4526b838d9bdfb5da11d6262?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/084631ae4526b838d9bdfb5da11d6262?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Errol Brown</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-06T17:01:46+00:00">December 6, 2017 at 5:01 pm</time></a> </div>
<div class="comment-content">
<p>KISS. Keep It Simple S&#8230;.</p>
</div>
<ol class="children">
<li id="comment-293291" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cd2ed7da34fed2dc403203f61a29c691?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cd2ed7da34fed2dc403203f61a29c691?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">madvad</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-11T16:41:20+00:00">December 11, 2017 at 4:41 pm</time></a> </div>
<div class="comment-content">
<p>Keep It Stupid Simple</p>
</div>
</li>
</ol>
</li>
<li id="comment-292801" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/67c6e5cf74d9bd0320f6ae0c03684177?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/67c6e5cf74d9bd0320f6ae0c03684177?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">N. L. Vijaykumar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-06T17:04:14+00:00">December 6, 2017 at 5:04 pm</time></a> </div>
<div class="comment-content">
<p>Fantastic text. Mind opening. Congrats. Cheers.</p>
<p>Vijay</p>
</div>
</li>
<li id="comment-292804" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e510fe34d3d4fc05bfb639becfb19e26?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e510fe34d3d4fc05bfb639becfb19e26?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michael Londeen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-06T18:07:03+00:00">December 6, 2017 at 6:07 pm</time></a> </div>
<div class="comment-content">
<p>We&rsquo;ll put. Thank you for this.</p>
</div>
</li>
<li id="comment-292808" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8681971d92902a61784aac4b42973aa4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8681971d92902a61784aac4b42973aa4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jacques Richer</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-06T19:37:48+00:00">December 6, 2017 at 7:37 pm</time></a> </div>
<div class="comment-content">
<p>I have spent the largest part of my career cleaning up messes. I try to write simple, understandable code because I know that I won&rsquo;t be on a project forever, and I need to leave the next programmer something that they can actually work with. This doesn&rsquo;t mean that I won&rsquo;t use functional programming or metaprogramming, just that if I do, it will be in a defined area where that approach leads to simpler code that makes more sense.</p>
</div>
<ol class="children">
<li id="comment-292921" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a6763cc3723519b8c50e2cba1c4b9fa0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a6763cc3723519b8c50e2cba1c4b9fa0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.simplesoftwarebydesign.com" class="url" rel="ugc external nofollow">Bruce W. Roeser</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T16:15:23+00:00">December 7, 2017 at 4:15 pm</time></a> </div>
<div class="comment-content">
<p>You and me, both, Jacques! (Cleaning up messes that is!)</p>
<p>-bruce 😉</p>
</div>
</li>
</ol>
</li>
<li id="comment-292812" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/90664a3c93685f403171d58d13a3531e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/90664a3c93685f403171d58d13a3531e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.rajivprab.com" class="url" rel="ugc external nofollow">RvPr</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-06T20:33:44+00:00">December 6, 2017 at 8:33 pm</time></a> </div>
<div class="comment-content">
<p>This was a great writeup. Good message, and well elaborated. One suggestion on your writing style though: where&rsquo;s the ending? It felt about as abrupt as the Sopranos&rsquo; finale. A concluding paragraph that ties the whole thing together, would have made this essay even stronger.</p>
</div>
</li>
<li id="comment-292828" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3d374372c065d369acb1009c93b03e6c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3d374372c065d369acb1009c93b03e6c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dan Todor</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T00:53:25+00:00">December 7, 2017 at 12:53 am</time></a> </div>
<div class="comment-content">
<p>â€œAny fool can write code that a computer can understand. Good programmers write code that humans can understand.â€ &#8211; Martin Fowler</p>
</div>
</li>
<li id="comment-292829" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c8e25765e530579d6dbd9e984d4dc6b5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c8e25765e530579d6dbd9e984d4dc6b5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Harold Acker</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T01:33:40+00:00">December 7, 2017 at 1:33 am</time></a> </div>
<div class="comment-content">
<p>Avoid the OO snake oil dealers and the typeclass zealots and the Monoids. If you want simplicity watch Rich Hickey&rsquo;s videos and enjoy the freedom of Clojure.</p>
</div>
</li>
<li id="comment-292840" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T04:14:24+00:00">December 7, 2017 at 4:14 am</time></a> </div>
<div class="comment-content">
<p>Heh. A few years before, but much the same.</p>
<p>In high school, quickly learned that to communicate effectively, I could not use the majority of my rapidly acquiring vocabulary. Spent a couple years working after high school, to afford University, with the same limitation. </p>
<p>In University, the chance to fully use my vocabulary of words and ideas was &#8230; absolutely freaking wonderful!!</p>
<p>At this point I have to differ somewhat with the suggestion that going to a traditional college might be a waste. There is something powerful in living with folk of similar ability, and that needs count.</p>
<p>As a programmer, I have found that when I write a white paper describing a product, the group finds clarity.</p>
<p>On the flip side, I spent years building a solution for a particularly complex problem. The solution performed extremely well. The problem was &#8230; I could not pass on the result to other programmers. They could easily understand subsets, but not the whole.</p>
<p>More simplistic solutions might be better, when possible.</p>
<p>On the more theoretic side, I am a bit of a skeptic. The notion of &ldquo;functional programming&rdquo; has been around since I was young, but has only limited effect. On the other hand, the last project I worked on &#8211; which shipped to customer on time and on goal &#8211; used much from the notions of functional programming in the test code. (Trying to explain that code to both old and young programmers &#8230; was an effort. Keep in mind I was the oldest guy in the group.)</p>
<p>So &#8230; using too much of your vocabulary might not be good?</p>
</div>
</li>
<li id="comment-292842" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0562a7e657047d172f5dcdd12900d78a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0562a7e657047d172f5dcdd12900d78a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://Wiltel49@gmail.com" class="url" rel="ugc external nofollow">Joseph Williams</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T04:55:47+00:00">December 7, 2017 at 4:55 am</time></a> </div>
<div class="comment-content">
<p>I would rather have a leading by example of 1. Complex program language. 2. Simple program language. None given!</p>
</div>
</li>
<li id="comment-292843" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/91e492055eb1e3374021cd46a645cd23?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/91e492055eb1e3374021cd46a645cd23?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Pietro Giuliano</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T05:11:06+00:00">December 7, 2017 at 5:11 am</time></a> </div>
<div class="comment-content">
<p>Well, i could care less about programming style. That&rsquo;s not where the core problems exist. 1. Please be able to write unit tests that could approach upwards of 95% 2. Please know some creations, structural and behavioral design patterns. 3. Know SOLID principals.<br/>
Why? Because when one is dealing with hundreds of thousands of lines of code &#8230; I don&rsquo;t want to decipher your code. The unit tests will tell me what I need to know</p>
</div>
<ol class="children">
<li id="comment-292908" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/17d0b0eb3b52e6c6981a0f29fb6e5b2f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/17d0b0eb3b52e6c6981a0f29fb6e5b2f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kolya</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T15:35:05+00:00">December 7, 2017 at 3:35 pm</time></a> </div>
<div class="comment-content">
<p>Concur.</p>
<p>1. OOP is thought to make programs simpler to understand and modify. There is a possibility that you&rsquo;ll mess everything up, but that&rsquo;s the art of programming.<br/>
2. Functional programming &#8211; same thing here.</p>
</div>
</li>
</ol>
</li>
<li id="comment-292845" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fb2732acd2fe8bc7c378190e1e4d62d2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fb2732acd2fe8bc7c378190e1e4d62d2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ronnel Pastrana</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T05:32:59+00:00">December 7, 2017 at 5:32 am</time></a> </div>
<div class="comment-content">
<p>That is this &ldquo;complexity&rdquo; that delay if not stall the world&rsquo;s progress.and peace. Everything should be approached and done simply. Look at GOD&rsquo;s creation, everything was done by &ldquo;two&rsquo;s&rdquo; or binary. There&rsquo;s always the opposite of each creation. Example: man-woman, love-hate, hot-cold, white-black, zero-one, poor-rich, up-down, heaven-hell, devil-angel, ugly-pretty, short-tall, fast-slow, war-peace, foul odor-pleasant odor, male-female, north-south, etc. etc&#8230; We have yet to explore the universe and only until that point. There is only one that was not created and has no opposite, and that is GOD. Make your programs as simple as possible. Anyway when programs are compiled, it is sent to processors as1 and 0 only. Happy programming!</p>
</div>
</li>
<li id="comment-292852" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cec82b7e96d4ab45fb06343f277cfd97?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cec82b7e96d4ab45fb06343f277cfd97?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">mikey</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T06:17:44+00:00">December 7, 2017 at 6:17 am</time></a> </div>
<div class="comment-content">
<p>this is very inspiring i definitely hit that ceiling from time to time, knowing that i am moderately intelligent and reluctant to put effort into things. </p>
<p>however, here&rsquo;s an open thought: the next big idea lies beyond all platonic solutions. we&rsquo;ve witnessed alpha go&rsquo;s astonishing evolution speed, yet no human go master can understand its reasoning and its skills. some theoreticians agree with the idea that if p=np, a breakthrough solution to that np-complete problem has a really high degree, like x to the one million and it&rsquo;s just beyond human capacity. ronald graham, a combinatorist once said something like the really interesting mathematics happens at really big numbers, that we have very interesting theories involving astronomical numbers. the hard problem of consciousness appears to have a really complicated solution as well. so maybe the next big breakthrough is done by some more generalized ai that has way more computing ability than any human being instead of a really smart human.</p>
</div>
</li>
<li id="comment-292857" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b140d930112461d7b9d242b8bd7d04ed?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b140d930112461d7b9d242b8bd7d04ed?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://thechiao.com" class="url" rel="ugc external nofollow">Chiao Cheng</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T07:29:01+00:00">December 7, 2017 at 7:29 am</time></a> </div>
<div class="comment-content">
<p>Classical Mechanics is a rich analogy. Newton&rsquo;s Laws are simple, but difficult to extend. If you do work in Physics, you are almost never going to be using the Equation of Motion formulation (Newton&rsquo;s Laws); the Lagrangian and Hamiltonian formulations are more complex but are much easier to modify and play with. Lagrangian and Hamiltonian Mechanics are refactorings of Newton&rsquo;s Laws!</p>
</div>
</li>
<li id="comment-292870" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/62ad02da7128a00f35e7ccb62d0e3d4b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/62ad02da7128a00f35e7ccb62d0e3d4b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Karthik</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T09:06:39+00:00">December 7, 2017 at 9:06 am</time></a> </div>
<div class="comment-content">
<p>Vocabulary development and finding the chances to use those are completely different from using the latest programming technique (opinion is different). The fundamental differences between these two are revisit and maintenance not required after you speak. Probably winning the audience may matter in this case ðŸ˜Š. </p>
<p>But using the latest programming technique will solve the problem easier provided, we had knowledge-wise equal people around us. At the same time, we could not make sound using single hand. As you described, if some-one want to be a programming &#8211; Sesquipedalian then he must create the audience in this case (peers). Because programming is not about winning single person. It Is always associated with the group of people. It is NOT necessary to use 10 simple words to describe the thing, when we had single word to do same, while the time, cost and maintenance are matter.</p>
</div>
</li>
<li id="comment-292877" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0a0f5f44ddd67f61643514922a4a4c3a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0a0f5f44ddd67f61643514922a4a4c3a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">alex</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T10:55:24+00:00">December 7, 2017 at 10:55 am</time></a> </div>
<div class="comment-content">
<p>You have rediscovered:<br/>
In der BeschrÃ¤nkung zeigt sich erst der Meister. (1802)</p>
<p>i agree, nice article,</p>
<p> thank you</p>
</div>
</li>
<li id="comment-292890" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ef66013e6740c7ff5fcd7cd5510ba6ab?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ef66013e6740c7ff5fcd7cd5510ba6ab?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.vladest.org" class="url" rel="ugc external nofollow">vladest</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T12:31:49+00:00">December 7, 2017 at 12:31 pm</time></a> </div>
<div class="comment-content">
<p>If you think easy implementations are same, think twice<br/>
&rdquo; if you choose the quick and easy path as Vader did â€” you will become an agent of evil.â€ (c)</p>
</div>
</li>
<li id="comment-292901" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/961155915d3e65113b92cc50936e2464?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/961155915d3e65113b92cc50936e2464?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jim Pucci</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T14:33:07+00:00">December 7, 2017 at 2:33 pm</time></a> </div>
<div class="comment-content">
<p>As a manager responsible for code life cycle I very much agree with your analysis, but would add that this depends a little on the circumstances. I was talking with some of my team yesterday and we were discussing the power of regex in .NET. We never use it because it comes up so infrequently that none of us are proficient at it. The syntax is something we would have to study every time we write or modify code that uses it. Another department with a heavy need for the use of regex may have a team of folks proficient in it. So I guess my point is that complexity can be relative to your team environment.</p>
</div>
</li>
<li id="comment-292902" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2f5ea90fec1dae0106e2a19eabfb8f1c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2f5ea90fec1dae0106e2a19eabfb8f1c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ed</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T14:55:23+00:00">December 7, 2017 at 2:55 pm</time></a> </div>
<div class="comment-content">
<p>Old school-programmer here, i have learned to work with to many frameworks in so may languages, made the journey from basic to COBOL, vb, db, c#, .net,php&#8230;.. I can not emphasize this enough, keep it simple. We are not all writing for Facebook or Netflix. The whole react movement is a great thing, beautiful things are done, but boy, do we make things complicated. I do a lot of code reviews and i&rsquo;m still surprised that to change a button with behavior you have to touch 26 scripts. ( not always but i have seen it it multiple times during reviews )</p>
</div>
</li>
<li id="comment-292910" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a6763cc3723519b8c50e2cba1c4b9fa0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a6763cc3723519b8c50e2cba1c4b9fa0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.simplesoftwarebydesign.com" class="url" rel="ugc external nofollow">Bruce W. Roeser</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T15:40:36+00:00">December 7, 2017 at 3:40 pm</time></a> </div>
<div class="comment-content">
<p>Exactly! I&rsquo;ve been trying to promote the concept of simplicity in software design for years! Preach it, brother!</p>
</div>
</li>
<li id="comment-292912" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e18f02978f4f1246b92ec7401479c27f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e18f02978f4f1246b92ec7401479c27f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.blackfalconsoftware.com" class="url" rel="ugc external nofollow">Steve Naidamast</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T15:51:14+00:00">December 7, 2017 at 3:51 pm</time></a> </div>
<div class="comment-content">
<p>The author follows the tenets of KISS very well in his easy to read essay.</p>
<p>I have always followed a single rule in my 42+ years in corporate development that was promoted in my mainframe days; write for the least experienced person who may need to maintain your code.</p>
<p>It is a rule that has always kept my code very easy to read and to maintain. What more could a good technical manager want?</p>
</div>
</li>
<li id="comment-292919" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/796b514885c46f26b3382fefc442d27b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/796b514885c46f26b3382fefc442d27b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Charlie</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T16:14:26+00:00">December 7, 2017 at 4:14 pm</time></a> </div>
<div class="comment-content">
<p>I believe that, in our writing, it is not unreasonable to ask the reader to look up a word when they are unfamiliar with it. We should try not to make this demand too often, but motivated readers will do this if our writing contains something valuable for them.</p>
<p>Perhaps even more so for computer instructions, we should not be afraid of complex expressions, especially when they improve clarity and compactness.</p>
<p>My coworker recently needed a file transfer procedure for bash/ksh88. Is my implementation a masterpiece? No, but it&rsquo;s clear and does the job, and pieces of it are already showing up in other departments.</p>
<p>#!/bin/sh<br/>
FILE=/tmp/some_data.dat</p>
<p>if [[ -f &ldquo;${FILE}&rdquo; ]]<br/>
then<br/>
fage=$(stat -c %Y &ldquo;${FILE}&rdquo;)<br/>
now=$(date +%s)<br/>
((diff=now-fage))</p>
<p> if [[ ${diff} -gt 600 ]]<br/>
then<br/>
ENV=${ORACLE_SID:0:3}</p>
<p> if [[ ${ENV} = &ldquo;prd&rdquo; ]]<br/>
then HOST=prd.foo.com<br/>
else HOST=dev.foo.com<br/>
fi</p>
<p> x=&rdquo;$(dirname &ldquo;${FILE}&rdquo;)/$(basename &ldquo;${FILE}&rdquo; .dat).$(date +&rsquo;%y%m%d%H%M%S&rsquo;).dat&rdquo;</p>
<p> mv -v &ldquo;${FILE}&rdquo; &ldquo;${x}&rdquo;</p>
<p> echo &ldquo;cd job_orders<br/>
put ${x}<br/>
quit&rdquo; |<br/>
sftp &ldquo;trfacct@${HOST}&rdquo;</p>
<p> mv -v &ldquo;${x}&rdquo; &ldquo;${VAR_LOG}&rdquo;<br/>
fi<br/>
fi</p>
</div>
</li>
<li id="comment-292928" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5c9580e3a7140cc3ca602575ab459352?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5c9580e3a7140cc3ca602575ab459352?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.usm2014.com" class="url" rel="ugc external nofollow">Gheorghe Matei</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T16:52:03+00:00">December 7, 2017 at 4:52 pm</time></a> </div>
<div class="comment-content">
<p>There are here some very big problems. I can talk about two chapters: 1. The Current Software Model (CSM) in which we see C++, C#, Java, classes and objects, databases, clouds, fogs and an unlimited string of programs&#8230;.., AND 2. The Universal Software Model (USM) in which I work directly with the parameters of the problems and the relationships among these parameters. The name of the unique and universal language is usm (the language of the Universal Software Model). All is different. The usm language works directly in Problem Space with the parameters of the problems. No pointers. No objects. CSM is over. The future is USM. With CSM the entire planet becomes a planet of programmers. The usm language can be learned in a week! The language has a small number of concepts. Our effort have to be done for knowing the real problems. In CSM 95% of the problems are inside the model itself (inside CSM).</p>
</div>
<ol class="children">
<li id="comment-292931" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cc40d83777f370934cefe0f22b66c63e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cc40d83777f370934cefe0f22b66c63e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Astr0wiz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T17:15:14+00:00">December 7, 2017 at 5:15 pm</time></a> </div>
<div class="comment-content">
<p>Hey Ghorghe, I visited your site. Way too complex for my simple programmer mind. Guess I&rsquo;ll get back to my if-then-else work now&#8230;</p>
</div>
</li>
<li id="comment-293342" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/71eb5edc171e6b3ce28327f8a44a3b4b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/71eb5edc171e6b3ce28327f8a44a3b4b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://semorad.com/janosemo_work/public/DSL_BL/motor_004.png" class="url" rel="ugc external nofollow">janosemo</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-12T11:05:03+00:00">December 12, 2017 at 11:05 am</time></a> </div>
<div class="comment-content">
<p>maybe you discovered DSL</p>
</div>
</li>
</ol>
</li>
<li id="comment-292930" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0ebc43ad6da6e18f058baf38eabbfcdf?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0ebc43ad6da6e18f058baf38eabbfcdf?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Darryl Wagoner</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T17:14:10+00:00">December 7, 2017 at 5:14 pm</time></a> </div>
<div class="comment-content">
<p>As a gray beard I have went from CBasic to Angular/TypeScript. One of the things that I have found is that programmers spend 50-80% of their development time reading code. </p>
<p>Knowing this, the bottom line is that code must convey intent and be readable. (Clean Coding, SOLID, etc all helps with this). I try to write a lot of small methods. They are easy to unit test, easy to name that conveys intent, etc.</p>
</div>
</li>
<li id="comment-292943" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0ec7abd2e8acf52ccc32a5863084af2c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0ec7abd2e8acf52ccc32a5863084af2c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Roger Kaplan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T21:27:42+00:00">December 7, 2017 at 9:27 pm</time></a> </div>
<div class="comment-content">
<p>I disagree. </p>
<p>The analogy between human language and programming languages is specious. (see that? I used an SAT word to be concise)</p>
<p>Communication is designed to transfer thoughts from one brain to another, and if the receiver is convinced or motivated as a result, the communication is effective.</p>
<p>Programming is a completely different endeavor. You don&rsquo;t need to convince or motivate a computer to execute its programs.</p>
<p>Writing simplistic but voluminous code with lots of small statements is not good programming. Operating at a higher level of abstraction, requiring less code and depending more on patterns, is superior. If other programmers don&rsquo;t understand the patterns, they need to learn them.</p>
<p>Programming patterns were inspired by architecture. Following your logic, we would still be living in mud huts as architecture would not have progressed the point at which the &ldquo;average&rdquo; architect could operate.</p>
</div>
<ol class="children">
<li id="comment-292977" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/17d0b0eb3b52e6c6981a0f29fb6e5b2f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/17d0b0eb3b52e6c6981a0f29fb6e5b2f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kolya Ivankov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-08T07:56:00+00:00">December 8, 2017 at 7:56 am</time></a> </div>
<div class="comment-content">
<p>I totally agree. </p>
<p>When writing my code, I spend some 25% of my just thinking, how am I to approach the problem in terms of responsibility chains, inheritance and so on, how do I make my code scalable. It takes the whole 25% of time because, when the code is written, there is usually no need to come back to it any more, rewrite everything from scratch, fix a thousand bugs that appeared after fixing a single one, and so on and so forth. Extending your metaphor, a crush of a mud hut is much less dangerous than a crush of a skyscraper &#8211; but you&rsquo;ll never build a skyscraper basing on the mud hut technology, for it will collapse inevitably.</p>
</div>
</li>
</ol>
</li>
<li id="comment-292945" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/672ccf6c152df8cd07275f8a17d07436?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/672ccf6c152df8cd07275f8a17d07436?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Asnownymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T22:04:53+00:00">December 7, 2017 at 10:04 pm</time></a> </div>
<div class="comment-content">
<p>I agree with this, and to express one self in the most simple manner a language has to allow metaprogramming so that the programmer can remove all unnecessary information from a piece of code.<br/>
This makes the code say what it needs to say without hard to understand abstractions (like design patterns).</p>
</div>
</li>
<li id="comment-292946" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a057b8bbe27cec5c2677978640ca1fea?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a057b8bbe27cec5c2677978640ca1fea?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">MaverickDoe</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T22:08:07+00:00">December 7, 2017 at 10:08 pm</time></a> </div>
<div class="comment-content">
<p>While I agree at some level, there is a reason more complicated programming paradigms were invented. And it wasn&rsquo;t just to look/sound smart. It was to solve problems inherited by programmers who found themselves having to wade through mountains of unmanageable code. Doing it the simple way often leads to code that repeats itself all over the place, is difficult to modify without breaking other parts of the system, etc.<br/>
And I often hear the&#8230;&rdquo;oh, it&rsquo;s okay, we&rsquo;ll refactor it later if it becomes necessary&rdquo; line. I have yet to meet a professional programmer who is ever given the time to refactor code that &ldquo;already works&#8230;don&rsquo;t fix it&rdquo;.</p>
</div>
</li>
<li id="comment-292948" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3d6bd74e2e7210c80f9e12d1638878d2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3d6bd74e2e7210c80f9e12d1638878d2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">John tthe Scott</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-07T22:49:23+00:00">December 7, 2017 at 10:49 pm</time></a> </div>
<div class="comment-content">
<p>small words are good;<br/>
old words are better.<br/>
small old words are best.</p>
</div>
</li>
<li id="comment-292966" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c5d4cd98747c1e203e26937d718325d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c5d4cd98747c1e203e26937d718325d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://codeinfig.wordpress.com" class="url" rel="ugc external nofollow">codeinfig</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-08T03:07:49+00:00">December 8, 2017 at 3:07 am</time></a> </div>
<div class="comment-content">
<p>ive been saying these things for years&#8211; and theyre the centre of my philosophy about &ldquo;easylangs.&rdquo; its not a crusade against complicated languages, its a call for more options that are easier to learn to code in.</p>
<p>i think coding continues to get more complicated, faster than is necessary. the idea that &ldquo;computers do more things now, thats why we need more complex languages&rdquo; is a bit misleading, and less than 100% true.</p>
<p>i really hope you will consider fig as an example of what youre talking about&#8211; a language with &lt; 100 commands, designed as a bridge to python or other languages&#8211; designed for the people i couldnt interest in python or even basic.</p>
<p>ive taught people how coding works in fig in bars, while we were both drinking. its not &quot;just&quot; an educational language, i actually use it for coding. but id like for more people to work on easier languages, not just fig.</p>
<p>cheers.</p>
</div>
</li>
<li id="comment-292981" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0db110c6b7650235632d0371aa5095e7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0db110c6b7650235632d0371aa5095e7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">David</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-08T08:55:34+00:00">December 8, 2017 at 8:55 am</time></a> </div>
<div class="comment-content">
<p>I read the first two paragraphs and left.</p>
<p>Glad I came back to it. After spending so much column length not merely establishing the context that you are smart, but just *how* smart you are, you finally got to the point of how that turns people off.</p>
<p>Your advice about modesty is sound: &ldquo;Really smart people have no need to show off. If you are showing off, you are broadcasting that you aren&rsquo;t really smart.&rdquo;</p>
<p>Thinking about other people has other benefits, unless you want to do all the maintenance and extension of every bit of code you ever write. I might suggest &ldquo;Considerate&rdquo; coding, or &ldquo;Modest&rdquo; coding. Unless I mistook what you laid out as advice.</p>
<p>The word &ldquo;Simplistic&rdquo; just begs the question, and leads to explaining, at length, how it is the opposite of high intelligence, and exactly why you feel the need to explain it that way.</p>
</div>
</li>
<li id="comment-292991" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/edad850bf21986daba444bc44b3ffb85?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/edad850bf21986daba444bc44b3ffb85?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Prinz Rowan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-08T14:18:48+00:00">December 8, 2017 at 2:18 pm</time></a> </div>
<div class="comment-content">
<p>To make the simpliest solution, you have to understand the Problem in ist full complexity. Most of the time, this is not the case. There are programmers, which add to much &ldquo;sugar&rdquo; to a solution, but they are not very widespread.<br/>
The simplistic approach bears some inherent problems. The biggest is the question of scaling. A colleague hacked an export to Excel on our web Server in the late 90s. It worked on his 1000 entry data modell. But the customer had 250000 date entries and the algorithm was n^^3.</p>
<p>But these are the simple problems today. Data Manipulation is testable an reproducible. A running industrial process with hundreds of inputs mapped to a hundred threads, which have to work together at some Moments is the challeging Problem. To much serialisation will break real time communication. To many Looks will break Performance and leads to deadlocks. Unfortunately you don&rsquo;t get your own Million Dollar machine for testing the stuff in your Office.</p>
</div>
</li>
<li id="comment-292996" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0df890a521d619b81737972dd1242966?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0df890a521d619b81737972dd1242966?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://paulgehrman.com" class="url" rel="ugc external nofollow">Paul Gehrman</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-08T16:33:03+00:00">December 8, 2017 at 4:33 pm</time></a> </div>
<div class="comment-content">
<p>I completely agree. The biggest problem is the number of hipsters who have joined the programming ranks. They are always trying to grab on to the latest thing (ORM, TDD, etc.) and they can&rsquo;t control their narcissism. The other problem is the way programming is taught in our schools. It is divorced from the reality of solving real-world problems in an efficient way.</p>
</div>
</li>
<li id="comment-293190" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b9ebecd80a3bf4e94ce4848553dbc195?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b9ebecd80a3bf4e94ce4848553dbc195?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">lylebot</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-10T19:49:07+00:00">December 10, 2017 at 7:49 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t know. Writing is not only a means to an end, it is also an art in and of itself. Something is lost to me when the art is stripped away to focus only on the utilitarian end goal. Coding is an art too, but obviously 99% of code has to meet utilitarian goals, so it makes perfect sense to me to focus on that in that context.</p>
<p>Reading your post, I was reminded of some of my Facebook friends that have training in photography and are more than capable of taking beautiful pictures, yet post FB albums full of blurry, poorly-composed shots. I guess that&rsquo;s fine if you just see FB as a medium for showing people what you were doing and with who, just like writing short, simple sentences is fine if you just see papers as a medium for telling people what you did and how. I feel like both can be more than that.</p>
</div>
</li>
<li id="comment-293264" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/80c637c6aa3d5fefd48a6d5e9ce5d32c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/80c637c6aa3d5fefd48a6d5e9ce5d32c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Pee Gee</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-11T10:26:34+00:00">December 11, 2017 at 10:26 am</time></a> </div>
<div class="comment-content">
<p>I think you&rsquo;re talking about too many different things at the same time, intertwining them and mixing one with another. I totally agree with showing-off and being smart just for the sake of being smart is harmful. But what does it have to do with using modern, advanced programming techniques? Making your code simple (as an opposite to complex) requires a lot of engineering, requires putting enough thought to make it understandable and easy to maintain; it&rsquo;s probably the opposite of &lsquo;simplistic code&rsquo;. There&rsquo;s a reason people try to abstract away from implementation details &#8211; to make programs more declarative and easy to understand. There&rsquo;s a reason C is a niche language now &#8211; I cannot think of a language more simplistic, yet it&rsquo;s not used nowadays for each and every programming task.<br/>
Complexity scares poorly, I&rsquo;m totally with you on that; but complexity of a system is, again, a sign that not enough engineering has been put into it. The reason Newtons&rsquo; laws are still taught at school is that to understand something more difficult, you should start with something easy. Understanding of Newton&rsquo;s laws scales way better than understanding of Einstein&rsquo;s theory, sure, because it&rsquo;s _easier_. But appliances don&rsquo;t.<br/>
We won&rsquo;t get much further without difficult to understand systems, but we gotta work on keeping them simple.</p>
</div>
</li>
<li id="comment-293341" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/71eb5edc171e6b3ce28327f8a44a3b4b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/71eb5edc171e6b3ce28327f8a44a3b4b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://semorad.com/janosemo_work/public/DSL_BL/motor_004.png" class="url" rel="ugc external nofollow">janosemo</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-12T10:53:38+00:00">December 12, 2017 at 10:53 am</time></a> </div>
<div class="comment-content">
<p>Bingo. IT is the biggest procrastination. My former boss said Industry4.0 does not concern IT. It is so. Real IT is about money, so complications meet this goal. Complications helps to generate more money. Resulting software is not a major goal. Simple things? People are bored with simple solution. At the meeting, they want to talk about difficult issues. It does not matter that those things are not really needed. But it will get budget! 😉 Simple things and solutions frighten people. The ease of being is unbearable. With some problem is easier life. The problem lets you dream a dream of a great future, because reality is boring. Reality is a compromise. Reality may mean multiple points of view. Reality may require dialogue and empathy. Reality may assume cooperation. But the complicated code will rid you of all this junk and give you freedom, peace and budget. Do you already understand why open source is great? Start charging money and you will see &#8230; 😉</p>
</div>
</li>
<li id="comment-293366" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/71eb5edc171e6b3ce28327f8a44a3b4b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/71eb5edc171e6b3ce28327f8a44a3b4b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://semorad.com/janosemo_work/public/DSL_BL/motor_004.png" class="url" rel="ugc external nofollow">janosemo</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-12T16:48:44+00:00">December 12, 2017 at 4:48 pm</time></a> </div>
<div class="comment-content">
<p>Another nail in the coffin of software is durability. When I&rsquo;m reconciled with overenginnering software, it will not even survive. Again money and copyrights&#8230;</p>
<p>Is it something older than last year&rsquo;s software version? </p>
<p>That&rsquo;s why I prefer javascript and open source. no vendor lock. On all sides. Chrome has a 63rd reincarnation. In silence. No problem. And in terms of simplicity and sugestibility, javascript is the first to choose from. Pity it is not case-insensitive. Transpilers can not discard this burden (if they want to be compatible). </p>
<p>I personally introduced DSL comprehensibility including language (= national), punctuation and caseInsensitive independence. Even in the current world (life), each domain has its native language. It&rsquo;s normal, no wonder. It&rsquo;s foolish to want one programming language for everything. Most programming languages â€‹â€‹originated for technology, not for users. Such techno-languages â€‹â€‹are a lot today. Languages â€‹â€‹for users, business decision makers are needed. Even that is understandability and understanding.</p>
</div>
</li>
<li id="comment-296427" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cbbd943818fd6aaf1df9b25397fbe010?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cbbd943818fd6aaf1df9b25397fbe010?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">powturbo</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-02-07T07:47:00+00:00">February 7, 2018 at 7:47 am</time></a> </div>
<div class="comment-content">
<p>The best things are simple, but finding these simple things is not simple</p>
</div>
</li>
</ol>
