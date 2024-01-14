---
date: "2022-01-21 12:00:00"
title: "SWAR explained: parsing eight digits"
index: false
---

[12 thoughts on &ldquo;SWAR explained: parsing eight digits&rdquo;](/lemire/blog/2022/01-21-swar-explained-parsing-eight-digits)

<ol class="comment-list">
<li id="comment-617811" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/06d7149600e5d82f4066dc611594635d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/06d7149600e5d82f4066dc611594635d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Ben</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-22T12:08:49+00:00">January 22, 2022 at 12:08 pm</time></a> </div>
<div class="comment-content">
<p>Please put a HTML code element inside of HTML pre text</p>
<p><a href="https://developer.mozilla.org/en-US/docs/Web/HTML/Element/code#notes" rel="nofollow ugc">https://developer.mozilla.org/en-US/docs/Web/HTML/Element/code#notes</a></p>
</div>
</li>
<li id="comment-617994" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/02da80ef28dfd4009104da44c5dca0f9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/02da80ef28dfd4009104da44c5dca0f9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Werner Randelshofer</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-23T15:08:21+00:00">January 23, 2022 at 3:08 pm</time></a> </div>
<div class="comment-content">
<p>I am very much intrigued by the differences of the algorithms in the two code snippets.</p>
<p>The algorithm in the C code looks slower than the one in C# because it has 3 multiplications that depend on each other. The last two multiplications of the C# code are independent of each other.</p>
<p>I am also curious on why you did not use &lsquo;val = (val * 2561) &gt;&gt; 8&rsquo; in the second last line of the C# code?</p>
<p>I have implemented both algorithms in Java, and measurements with JMH indicate that the C# algorithm is slower than the C algorithm. However when I use &lsquo;val = (val * 2561) &gt;&gt; 8&rsquo; in the C# algorithm, it has the same speed as the C algorithm.</p>
</div>
<ol class="children">
<li id="comment-618261" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-24T19:29:05+00:00">January 24, 2022 at 7:29 pm</time></a> </div>
<div class="comment-content">
<p>I have merged the two versions. Thank for your comment.</p>
</div>
</li>
</ol>
</li>
<li id="comment-618287" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4a339607155cef3d53b1c8505a215cf8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4a339607155cef3d53b1c8505a215cf8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Todd Lehman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-25T00:17:53+00:00">January 25, 2022 at 12:17 am</time></a> </div>
<div class="comment-content">
<p>Hi, Daniel. A couple things I just noticed in <code>parse_eight_digits_swar</code>&#8230; (1) It seems to be missing the declaration and loading of the variable <code>val</code>. (2) <code>val</code> was declared earlier as type <code>int64_t</code> but the return value of the function is <code>uint32_t</code>. This should be fine since $log_2(10^8) &lt; 32$, but is likely to generate a compiler warning in the absence of an explicit cast, e.g., <code>return (uint32_t)val;</code>.</p>
</div>
<ol class="children">
<li id="comment-618302" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-25T01:31:00+00:00">January 25, 2022 at 1:31 am</time></a> </div>
<div class="comment-content">
<p><em> is likely to generate a compiler warning</em></p>
<p>Yes. It is likely to generate a warning since there is an implicit cast.</p>
<p><em> It seems to be missing the declaration and loading of the variable val.</em></p>
<p>It is passed as a parameter to the function.</p>
</div>
<ol class="children">
<li id="comment-618308" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4a339607155cef3d53b1c8505a215cf8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4a339607155cef3d53b1c8505a215cf8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Todd Lehman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-25T02:50:04+00:00">January 25, 2022 at 2:50 am</time></a> </div>
<div class="comment-content">
<blockquote><p>It is passed as a parameter to the function.</p></blockquote>
<p>It is now (thank you for fixing it!), but at the time I posted my comment, it was not. The only parameter being passed was <code>const char *chars</code> (I&rsquo;m looking at it right now on my screen, which still has the old code in another window.)<br/>
Cheers!</p>
</div>
<ol class="children">
<li id="comment-618311" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-25T03:00:48+00:00">January 25, 2022 at 3:00 am</time></a> </div>
<div class="comment-content">
<p>Thanks for your comment. You are correct.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-618415" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4a339607155cef3d53b1c8505a215cf8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4a339607155cef3d53b1c8505a215cf8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Todd Lehman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-25T21:17:49+00:00">January 25, 2022 at 9:17 pm</time></a> </div>
<div class="comment-content">
<p>It may be worth noting that this technique is not only useful for converting an 8-digit decimal integer to binary, but can also be used to load 8 digits at a time from a larger number, if you treat the 8 characters as a base-100,000,000 digit. So, say you were loading a 40-digit base-10 number with leading zeros into a uint128_t variable. It would require only five invocations of the 8-digit parsing function, with five additional multiplications (by the constant 100,000,000) and five additions accumulate the five base-100,000,000 digits.</p>
</div>
</li>
<li id="comment-618417" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4a339607155cef3d53b1c8505a215cf8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4a339607155cef3d53b1c8505a215cf8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Todd Lehman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-25T21:24:37+00:00">January 25, 2022 at 9:24 pm</time></a> </div>
<div class="comment-content">
<p>One other related thought for possible exploration is whether or not SWAR techniques can be used to efficiently count the number of ASCII base-10 digits (&lsquo;0&rsquo;..&rsquo;9&#8242;) appearing sequentially at a given position in a string or at a given memory location. If so, then one could construct 8 versions of the SWAR parser, one for each count of available characters, 1 to 8, and invoke the appropriate version, thus eliminating the requirement for leading zeros to be present.</p>
</div>
</li>
<li id="comment-621211" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b8d95b92cb1730c590b8fe61e5615cd9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b8d95b92cb1730c590b8fe61e5615cd9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ioann_V</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-02-18T18:27:14+00:00">February 18, 2022 at 6:27 pm</time></a> </div>
<div class="comment-content">
<p>Hey, Dave, it&rsquo;s mb interesting for u:</p>
<p>Here, 1+ year ago i wrote a publication (in Russian) about parsing decimal numbers, without using LUT:</p>
<p><a href="https://habr.com/ru/post/522820/" rel="nofollow ugc">https://habr.com/ru/post/522820/</a></p>
<p>It s also using this trick, which u named SWAR :]</p>
</div>
</li>
<li id="comment-621466" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ebb53d621ad68a6e34eee7464153958c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ebb53d621ad68a6e34eee7464153958c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">David Fetter</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-02-22T23:59:54+00:00">February 22, 2022 at 11:59 pm</time></a> </div>
<div class="comment-content">
<p>There&rsquo;s a typo which is a little confusing.</p>
<p>1000000*(10*b1+b2) + 100*(10*b3+b6)<br/>
should read:<br/>
1000000*(10*b1+b2) + 100*(10*b5+b6)</p>
</div>
<ol class="children">
<li id="comment-621467" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-02-23T00:02:52+00:00">February 23, 2022 at 12:02 am</time></a> </div>
<div class="comment-content">
<p>Thank you!</p>
</div>
</li>
</ol>
</li>
</ol>
