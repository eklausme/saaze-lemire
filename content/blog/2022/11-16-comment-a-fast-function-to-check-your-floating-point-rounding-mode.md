---
date: "2022-11-16 12:00:00"
title: "A fast function to check your floating-point rounding mode"
index: false
---

[11 thoughts on &ldquo;A fast function to check your floating-point rounding mode&rdquo;](/lemire/blog/2022/11-16-a-fast-function-to-check-your-floating-point-rounding-mode)

<ol class="comment-list">
<li id="comment-647525" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f50dbecd09873054262ddbaf68eaad34?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f50dbecd09873054262ddbaf68eaad34?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">anon coward</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-17T02:27:11+00:00">November 17, 2022 at 2:27 am</time></a> </div>
<div class="comment-content">
<p>Something like this: <a href="https://godbolt.org/z/svo8hjq9K" rel="nofollow ugc">https://godbolt.org/z/svo8hjq9K</a> may be preferable to the volatile.</p>
<p>Specifically</p>
<p><code><br/>
/* Make the compiler believe that something it cannot see is reading<br/>
this value either from a register or directly from its location in<br/>
memory. */</p>
<p>#define extern_write(p) asm volatile("" : "+rm"(p) : : )</p>
<p>bool rounds_to_nearest() noexcept {<br/>
float a = 1.0f + 1e-38f;<br/>
float b = 1.0f - 1e-38f;</p>
<p> // fake a write to a and b so compiler<br/>
// cannot elide the compare</p>
<p> extern_write(a);<br/>
extern_write(b);</p>
<p> return a == b;<br/>
}<br/>
</code><code></code></p>
</div>
<ol class="children">
<li id="comment-647549" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-18T15:36:37+00:00">November 18, 2022 at 3:36 pm</time></a> </div>
<div class="comment-content">
<p>A downside is that it is not portable. So a full solution, supporting all C++ compilers, will be more complex.</p>
</div>
</li>
<li id="comment-648352" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a8f1f03245fb8eb790f989193efd2086?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a8f1f03245fb8eb790f989193efd2086?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maarten Bosmans</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-09T06:44:08+00:00">December 9, 2022 at 6:44 am</time></a> </div>
<div class="comment-content">
<p>This will not work, as the compiler will happily precalculate the sum and difference and load those constants at run time. This is exactly what your godbolt link shows clang doing.</p>
<p>There is also something funny going on with storing and loading the constants multiple times, so it seems the compiler will generate better code with volatile.</p>
</div>
<ol class="children">
<li id="comment-648378" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f50dbecd09873054262ddbaf68eaad34?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f50dbecd09873054262ddbaf68eaad34?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">anon coward</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-10T18:46:47+00:00">December 10, 2022 at 6:46 pm</time></a> </div>
<div class="comment-content">
<p>Hey! Good catch, my code is not correct at all.</p>
<p>Here&rsquo;s a better version in which I actually take a look at the output and I&rsquo;m pretty sure it&rsquo;s doing the right thing!</p>
<p><a href="https://godbolt.org/z/rbqjTP5EM" rel="nofollow ugc">https://godbolt.org/z/rbqjTP5EM</a></p>
<p>This one is using a less clever and more correct macro to pretend that some instruction read and wrote to a general purpose register, breaking the compiler&rsquo;s ability to fold constants. The code gen in this version is much better and much more correct than the previous broken one..</p>
<p>#define munge(p) asm (&ldquo;# munge(&rdquo; #p &ldquo;[%0])@&rdquo; : &ldquo;+r&rdquo;(p) : : )</p>
<p>this version results in bouncing our values off of register instead of the L1 (as the (volatile has to do, kinda), and performance does seem to be better on both my M1 arm machine and a rather ancient Ivy Bridge machine I have.</p>
<p>On x68:</p>
<p>$ ./a.out<br/>
v 932007<br/>
f 341029<br/>
v 698101<br/>
f 340962<br/>
v 698105<br/>
f 340962<br/>
v 705098<br/>
f 326151<br/>
done!</p>
<p>but this is all a bit dubiously useful. I only mention it because I&rsquo;ve switched from using volatiles to hide info from compilers to using macros like this, but I usually inspect the ASM much more carefully!</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-647532" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c8971b9927d5a599875279bd85004f73?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c8971b9927d5a599875279bd85004f73?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://shape-of-code.com" class="url" rel="ugc external nofollow">Derek Jones</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-17T13:18:36+00:00">November 17, 2022 at 1:18 pm</time></a> </div>
<div class="comment-content">
<p>There is a 25% chance that this test will return true when stochastic rounding is being used.</p>
<p><a href="https://www.ncbi.nlm.nih.gov/pmc/articles/PMC8905452/" rel="nofollow ugc">https://www.ncbi.nlm.nih.gov/pmc/articles/PMC8905452/</a></p>
</div>
</li>
<li id="comment-647541" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fd7d11144ccdac2024b528921e9be665?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fd7d11144ccdac2024b528921e9be665?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/nmcclatchey" class="url" rel="ugc external nofollow">Nathaniel McClatchey</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-18T05:18:31+00:00">November 18, 2022 at 5:18 am</time></a> </div>
<div class="comment-content">
<p>A couple comments, in no particular order:<br/>
&#8211; Loading fmin to a temporary saves a load, at least on GCC.<br/>
&#8211; With flags such as -ffast-math / -funsafe-math-optimizations, the volatile trick still doesn&rsquo;t guarantee that the compiler won&rsquo;t invalidate your code because it sees 1.0f on both sides of the comparison. See the following failed implementation of a rounds_down variant for an example (though not in your code): <a href="https://godbolt.org/z/ef7W7b4c7" rel="nofollow ugc">https://godbolt.org/z/ef7W7b4c7</a></p>
<p>Just for fun, here are quick implementations of the other 3 &ldquo;official&rdquo; rounding modes in the C standard (that is, not &ldquo;implementation-defined&rdquo;):<br/>
<a href="https://godbolt.org/z/x441KdGs1" rel="nofollow ugc">https://godbolt.org/z/x441KdGs1</a><br/>
I&rsquo;m interested to see a faster variant of fegetround(), supporting all 4 modes, and comparisons against the current standard library version.</p>
</div>
<ol class="children">
<li id="comment-647550" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-18T15:40:07+00:00">November 18, 2022 at 3:40 pm</time></a> </div>
<div class="comment-content">
<p>By definition, fast-math breaks the floating-point standard compliance, so I expect that you are unlikely to both care about standard compliance and to allow fast-math.</p>
</div>
</li>
<li id="comment-647555" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e7d7001fb9cbf35e2d0d304a20e30ac2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e7d7001fb9cbf35e2d0d304a20e30ac2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michael Walcott</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-18T20:08:24+00:00">November 18, 2022 at 8:08 pm</time></a> </div>
<div class="comment-content">
<p>Yes, I would imagine using a temporary should improve things for most compilers. Because otherwise the compiler is forced to load it twice to preserve the access of the volatile variable.</p>
<p>I get why you want to use &ldquo;std::numeric_limits::epsilon() / 2&rdquo; and that is certainly a number that makes more sense in certain respects. But it needs to be slightly smaller than that since with nearest rounding (1.0f &#8211; (std::numeric_limits::epsilon() / 2)) does not equal 1.0f. This is due to the fact epsilon is the difference between the 1.0 and the next representable number GREATER than 1.0. The difference going toward zero happens to be smaller than that. Example of your rounds_to_nearest failing <a href="https://godbolt.org/z/86e6778xe" rel="nofollow ugc">https://godbolt.org/z/86e6778xe</a> because of this.</p>
</div>
<ol class="children">
<li id="comment-647580" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fd7d11144ccdac2024b528921e9be665?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fd7d11144ccdac2024b528921e9be665?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/nmcclatchey" class="url" rel="ugc external nofollow">Nathaniel McClatchey</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-19T21:00:19+00:00">November 19, 2022 at 9:00 pm</time></a> </div>
<div class="comment-content">
<p>That is an excellent point; as an alternative to adjusting epsilon (which would need to vary based on sign), selecting a base value precisely representable in the range (1,2) suffices.</p>
<p>As an example, selecting 1.5f instead of 1.0f gives the desired behavior. See corrected implementations here: <a href="https://godbolt.org/z/Mr8enbMWo" rel="nofollow ugc">https://godbolt.org/z/Mr8enbMWo</a></p>
<p>Thank you for highlighting the value of code review.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-647546" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://zeux.io" class="url" rel="ugc external nofollow">Arseny Kapoulkine</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-18T08:24:58+00:00">November 18, 2022 at 8:24 am</time></a> </div>
<div class="comment-content">
<p>It might be worth noting that 1e-100 can *not* be represented exactly, just as the sum of 1 and 1e-100 (this doesn&rsquo;t matter for the mechanics of the rounding mode estimation, but it confused me).</p>
</div>
<ol class="children">
<li id="comment-647548" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-18T15:32:00+00:00">November 18, 2022 at 3:32 pm</time></a> </div>
<div class="comment-content">
<p>Thank you. I fixed my example to make it easier to follow.</p>
</div>
</li>
</ol>
</li>
</ol>
