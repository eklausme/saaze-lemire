---
date: "2022-07-08 12:00:00"
title: "Go generics are not bad"
index: false
---

[6 thoughts on &ldquo;Go generics are not bad&rdquo;](/lemire/blog/2022/07-08-go-generics-are-not-bad)

<ol class="comment-list">
<li id="comment-638951" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2f0cf9749990f7cf217ead19aaec89a1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2f0cf9749990f7cf217ead19aaec89a1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://cafxx.strayorange.com" class="url" rel="ugc external nofollow">Carlo Alberto Ferraris</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-09T00:07:25+00:00">July 9, 2022 at 12:07 am</time></a> </div>
<div class="comment-content">
<p>Some of these basic interfaces are also available in <a href="https://pkg.go.dev/golang.org/x/exp/constraints" rel="nofollow ugc">https://pkg.go.dev/golang.org/x/exp/constraints</a></p>
</div>
<ol class="children">
<li id="comment-639134" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-09T17:34:17+00:00">July 9, 2022 at 5:34 pm</time></a> </div>
<div class="comment-content">
<p>Thanks.</p>
</div>
</li>
</ol>
</li>
<li id="comment-638965" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/39b9a3cdd4b66ccd50baed70da654862?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/39b9a3cdd4b66ccd50baed70da654862?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://dbj.org" class="url" rel="ugc external nofollow">DBJ</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-09T05:35:27+00:00">July 9, 2022 at 5:35 am</time></a> </div>
<div class="comment-content">
<p>C++ On and off the bandwagon</p>
<p><a href="https://dbj.org/c-on-and-off-the-bandwagon/" rel="nofollow ugc">https://dbj.org/c-on-and-off-the-bandwagon/</a></p>
</div>
</li>
<li id="comment-638977" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">me</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-09T07:45:14+00:00">July 9, 2022 at 7:45 am</time></a> </div>
<div class="comment-content">
<p>This is the simplest case only, and could be done with C preprocessor macros. Simply by substituting Number by the four permitted values, compiling it four times. But what if you had a high precision number type instead?<br/>
Any of the many &ldquo;template engines&rdquo; can be used to generate such code in Java (and most of the &ldquo;primitive collections&rdquo; libraries work this way.<br/>
I believe the actual test case for expressability of generics is when you have polymorphism at the same time, and the type may not yet known at compilation time.</p>
<p>What impressed me a bit more is the expressivity of Rust with it&rsquo;s numeric traits &#8211; you could express that you want to fail on overflow, use a saturating add, etc. &#8211; but honestly that takes the fun out of it eventually. And how many &ldquo;saturating add&rdquo; types do you have? Pretty much only the primitive integers, not even floats&#8230;</p>
</div>
<ol class="children">
<li id="comment-639137" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-09T17:35:53+00:00">July 9, 2022 at 5:35 pm</time></a> </div>
<div class="comment-content">
<p><em>This is the simplest case only, and could be done with C preprocessor macros. </em></p>
<p>Yes.</p>
</div>
</li>
</ol>
</li>
<li id="comment-646556" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a720efddabde8f3c09e21180dc3c989b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a720efddabde8f3c09e21180dc3c989b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Klaus</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-10-14T08:53:54+00:00">October 14, 2022 at 8:53 am</time></a> </div>
<div class="comment-content">
<p>The more I (try to) use them, the more I realize how incomplete they are, and how bad they sometimes are. To everyone: First google what&rsquo;s all missing and virtually impossible, it will save you time.</p>
</div>
</li>
</ol>
