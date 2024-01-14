---
date: "2020-10-10 12:00:00"
title: "Why is 0.1 + 0.2 not equal to 0.3?"
index: false
---

[8 thoughts on &ldquo;Why is 0.1 + 0.2 not equal to 0.3?&rdquo;](/lemire/blog/2020/10-10-why-is-0-1-0-2-not-equal-to-0-3)

<ol class="comment-list">
<li id="comment-554761" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c47da5409467699dae2d85ba459e8d75?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c47da5409467699dae2d85ba459e8d75?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Louka Lemire</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-10T00:58:29+00:00">October 10, 2020 at 12:58 am</time></a> </div>
<div class="comment-content">
<p>-I’m very fast in maths!<br/>
-Ok, what’s 56&#215;38?<br/>
-450!<br/>
-That’s not right&#8230;<br/>
-I said I was fast, not precise!</p>
</div>
</li>
<li id="comment-554864" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-11T07:37:48+00:00">October 11, 2020 at 7:37 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
Computers can do computations the way human beings do. For example, WolframAlpha has none of the problems above because it uses symbolic computations.
</p></blockquote>
<p>I actually wonder what WolframAlpha does internally, and if it works as neatly as you describe. For instance, if you input (0.1^(1/1000))^1000 without pressing enter, it shows an imprecise approximation (frankly, this could be a Javascript hack!), which would indicate it is at least not fully symbolic (for instance, it doesn&rsquo;t replace 0.1 with 1/10, which would show up on other computations). Final results (after pressing enter) are impressively correct, though.</p>
<p>WolframAlpha is based on Mathematica (or what they like to call &ldquo;Wolfram Language&rdquo;) which has traditionally taken a little different approach on numbers: it has exact values (effectively built up from integers, predefined constants and symbolic solutions built from these), approximate numbers with tracked precision, and machine-precision numbers.</p>
<p>When you enter something like 0.1 + 0.2 in Mathematica, these numbers are machine-precision reals &#8211; effectively binary64 type. 0.1 + 0.2 == 0.3 returns True in Mathematica, but this is not because it would perform symbolic or decimal presentation arithmetic, but because Mathematica ignores couple least significant bits of the mantissa as it knows rounding errors are going to creep in, choosing different semantics (with different tradeoffs). (One can also evaluate 0.1 + 0.2 // InputForm in Mathematica and see that rounding errors indeed creep in on this computation.)</p>
<p>I suspect WolframAlpha has some sort of heuristics to remove binary floating point kinks from the layperson user experience. What these heuristics precisely are is not immediately obvious to me. It definitely doesn&rsquo;t straight away replace 0.1 with 1/10&#8230;</p>
</div>
</li>
<li id="comment-554876" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c3dc49a179160f2c80b4354cb607e71e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c3dc49a179160f2c80b4354cb607e71e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Foobar-2</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-11T11:50:51+00:00">October 11, 2020 at 11:50 am</time></a> </div>
<div class="comment-content">
<p>Scaled integers or rationals? In my view these are good approaches for this type of problem. Rational data types where a nice surprise when I started to use Haskell.</p>
</div>
</li>
<li id="comment-554958" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Oren Tirosh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-12T17:33:25+00:00">October 12, 2020 at 5:33 pm</time></a> </div>
<div class="comment-content">
<p>The Android Calculator uses an internal number representation that is pretty much indistinguishable from real numbers for a human user.</p>
<p>See this article by Hans Boehm:</p>
<p><a href="https://dl.acm.org/doi/abs/10.1145/3385412.3386037" rel="nofollow ugc">https://dl.acm.org/doi/abs/10.1145/3385412.3386037</a></p>
</div>
<ol class="children">
<li id="comment-554976" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-12T21:55:57+00:00">October 12, 2020 at 9:55 pm</time></a> </div>
<div class="comment-content">
<p>Adrian Colyer&rsquo;s blog had a writeup on some recent work of his: <a href="https://blog.acolyer.org/2020/10/02/toward-an-api-for-the-real-numbers/" rel="nofollow ugc">https://blog.acolyer.org/2020/10/02/toward-an-api-for-the-real-numbers/</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-555713" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d86baafa595fec12e4b3492e89a3b736?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d86baafa595fec12e4b3492e89a3b736?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">James McCafferty</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-21T10:31:03+00:00">October 21, 2020 at 10:31 am</time></a> </div>
<div class="comment-content">
<p>COBOL allows one to define a variable as containing any arbitrary number of whole and decimal values, like all modern languages that dare to represent &ldquo;business logic&rdquo; should.</p>
</div>
</li>
<li id="comment-647574" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dc5669da9db7f7cef057d344105e5361?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dc5669da9db7f7cef057d344105e5361?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Florent DUPONT</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-19T19:10:53+00:00">November 19, 2022 at 7:10 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for your article. I&rsquo;m still wondering why, for some reason, Java is not consistent when computing floats and doubles.</p>
<p>for instance :<br/>
0.1d + 0.2d is not equal to 0.3d (as you explained in your article).</p>
<p>But 0.1f + 0.2f (the same operation using float with a mantissa of 24 bits) IS equal to 0.3. Following the same logic it shouldn&rsquo;t : 0.1 + 0.2 should be equal to 0.30000004.</p>
<p>0.3 is internally represented as 0.3000000119<br/>
0.1 is internally represented as 0.10000000149<br/>
0.2 is internally represented as 0.20000000298<br/>
so, 0.1 + 0.2 as 0.30000000447<br/>
and the closed representable matching value shoud be 0.3000000417 , not 0.3000000119&#8230;</p>
<p>Any ideas why this is inconsistent ?</p>
</div>
<ol class="children">
<li id="comment-647757" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-23T16:59:59+00:00">November 23, 2022 at 4:59 pm</time></a> </div>
<div class="comment-content">
<p>As 32-bit numbers, 0.1f is represented as 26843546*2**-28, so slightly over 0.1 (about 0.10000000149).</p>
<p>0.2f is represented as 26843546*2**-27, so slightly over 0.2 (about 0.20000000298).</p>
<p>0.3f is represented as 20132660*2**-26, so slightly over 0.3 (about 0.3000000119).</p>
<p>If you were to assume that the sum is lossless, you would indeed expect about 0.30000000447034836, but when computing the sum, the processor rounds up to about 0.3000000119.</p>
<p>Doing the computation manually, we get that the mantissa of 0.1f + 0.2f should be round(((26843546*2)+26843546)/4.0) = round(20132659.5) = 20132660 under round-to-even.</p>
</div>
</li>
</ol>
</li>
</ol>
