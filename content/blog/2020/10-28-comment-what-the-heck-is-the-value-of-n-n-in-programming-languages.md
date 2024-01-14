---
date: "2020-10-28 12:00:00"
title: "What the heck is the value of &#8220;-n % n&#8221; in programming languages?"
index: false
---

[18 thoughts on &ldquo;What the heck is the value of &#8220;-n % n&#8221; in programming languages?&rdquo;](/lemire/blog/2020/10-28-what-the-heck-is-the-value-of-n-n-in-programming-languages)

<ol class="comment-list">
<li id="comment-556383" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/07d4b484c6b2bebf3510163647c2f6dc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/07d4b484c6b2bebf3510163647c2f6dc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Patrice Tremblay</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-28T16:18:13+00:00">October 28, 2020 at 4:18 pm</time></a> </div>
<div class="comment-content">
<p>Sorry, but I miss the point of such code, then. If the value of <strong>-range % range</strong> is always 0, what&rsquo;s the intent?</p>
</div>
<ol class="children">
<li id="comment-556385" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-28T17:37:09+00:00">October 28, 2020 at 5:37 pm</time></a> </div>
<div class="comment-content">
<p>It is only zero when you have signed types. It is non trivial when you have unsigned types. You should be able to test it out for yourself.</p>
</div>
</li>
</ol>
</li>
<li id="comment-556384" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/56cf0d83dc108a339f7617bc12bd7a75?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/56cf0d83dc108a339f7617bc12bd7a75?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Robert Godin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-28T17:03:21+00:00">October 28, 2020 at 5:03 pm</time></a> </div>
<div class="comment-content">
<p>Petite coquille : &ldquo;just by examining just&rdquo;</p>
</div>
</li>
<li id="comment-556405" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4919386b4d3a64de8d79d70f652c5b90?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4919386b4d3a64de8d79d70f652c5b90?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-28T20:54:46+00:00">October 28, 2020 at 8:54 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
As I was telling a student of mine yesterday: you are not supposed to read new code and understand it right away all of the time.
</p></blockquote>
<p>I reckon a whole series of posts could be inspired by that statement.</p>
</div>
<ol class="children">
<li id="comment-556447" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d081923c9998bd094289a54a0ee1045b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d081923c9998bd094289a54a0ee1045b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Eden Segal</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-29T05:41:26+00:00">October 29, 2020 at 5:41 am</time></a> </div>
<div class="comment-content">
<p>That resonated with me, it&rsquo;s the opposite of &ldquo;software should be readable like proze&rdquo; which always sounded odd to me.</p>
</div>
</li>
</ol>
</li>
<li id="comment-556406" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/094d46275192922435ee4adaf57136cb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/094d46275192922435ee4adaf57136cb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alex JB</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-28T20:58:35+00:00">October 28, 2020 at 8:58 pm</time></a> </div>
<div class="comment-content">
<p>Tiny amendment: % is the percent sign, not the ampersand (that&rsquo;s &amp;).</p>
</div>
</li>
<li id="comment-556413" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/17be705e4e71f71e4d54b27039a786d9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/17be705e4e71f71e4d54b27039a786d9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bert</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-28T22:44:34+00:00">October 28, 2020 at 10:44 pm</time></a> </div>
<div class="comment-content">
<p>This is a neat trick! But I found something surprising with <code>unsigned short</code>: <a href="https://gcc.godbolt.org/z/4xWo1G" rel="nofollow ugc">https://gcc.godbolt.org/z/4xWo1G</a>. It looks like <code>-n</code> is type-promoted (probably to a signed integer? I haven&rsquo;t checked the standard) so unless you re-cast it (I&rsquo;m not sure that cast isn&rsquo;t UB&#8230;) you don&rsquo;t get the expected result.</p>
</div>
</li>
<li id="comment-556417" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Kurz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-28T23:49:53+00:00">October 28, 2020 at 11:49 pm</time></a> </div>
<div class="comment-content">
<p>You do an excellent job of explaining what this seemingly odd construction does, but it might be good to mention in the intro why &ldquo;-n %n&rdquo; is a common construction in the first place. Stealing from an <a href="https://news.ycombinator.com/item?id=24924357" rel="nofollow ugc">HN comment</a> making the same suggestions, &ldquo;It computes (2^b) % n, assuming n is an unsigned b-bit integer. You can&rsquo;t do this directly, since 2^b itself doesn&rsquo;t fit into a b-bit integer.&rdquo;</p>
</div>
<ol class="children">
<li id="comment-556418" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-28T23:51:57+00:00">October 28, 2020 at 11:51 pm</time></a> </div>
<div class="comment-content">
<p>Yes, this fault in my blog post was pointed out to me on twitter.</p>
</div>
</li>
</ol>
</li>
<li id="comment-556426" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4281d60d2ab6061c2d0d95f80c7a36d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4281d60d2ab6061c2d0d95f80c7a36d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">dan sullivan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-29T01:20:52+00:00">October 29, 2020 at 1:20 am</time></a> </div>
<div class="comment-content">
<p>A nit: I believe you meant to write &lsquo;percent&rsquo; (%) and not &lsquo;ampersand&rsquo; (&amp;). cheers.</p>
</div>
</li>
<li id="comment-556487" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/65d8c50123be27a6b210ef06d79f3870?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/65d8c50123be27a6b210ef06d79f3870?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michael Rademeyer</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-29T14:47:53+00:00">October 29, 2020 at 2:47 pm</time></a> </div>
<div class="comment-content">
<p>I dont understand. I tried it in C# and printed out the result of -8%8 and i got 0 so i dont get what is supposed to be happening</p>
</div>
<ol class="children">
<li id="comment-556490" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-29T15:03:20+00:00">October 29, 2020 at 3:03 pm</time></a> </div>
<div class="comment-content">
<p>In C#, try <tt>(4294967295 - n + 1) % n</tt> if <tt>n</tt> is of type <tt>uint</tt><tt>.</tt></p>
</div>
</li>
</ol>
</li>
<li id="comment-556530" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/17be705e4e71f71e4d54b27039a786d9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/17be705e4e71f71e4d54b27039a786d9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bert</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-29T23:13:19+00:00">October 29, 2020 at 11:13 pm</time></a> </div>
<div class="comment-content">
<p>I noticed unexpected results with unsigned short and unsigned char. It’s worth noting that -n will be converted to a signed int if n is a narrower type.</p>
</div>
</li>
<li id="comment-556682" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0a4d47ee41d52878600685b4d295a047?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0a4d47ee41d52878600685b4d295a047?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://derrick.pallas.us/" class="url" rel="ugc external nofollow">Derrick</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-31T03:11:22+00:00">October 31, 2020 at 3:11 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m finding out the hard way that gcc 10 seems to optimize this expression to 0 for unsigned values. I&rsquo;m having to cast to signed to get the unary minus to take effect, and then cast back to unsigned for the modulo to work the way it should. YMMV.</p>
</div>
<ol class="children">
<li id="comment-556727" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-31T16:52:20+00:00">October 31, 2020 at 4:52 pm</time></a> </div>
<div class="comment-content">
<p>See my reference to the standard C++ library in my blog post. It is used in GCC 10.</p>
</div>
</li>
</ol>
</li>
<li id="comment-557336" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ad4ee71956de6520a70d92a93b0ad145?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ad4ee71956de6520a70d92a93b0ad145?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Antoine</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-11-06T17:49:16+00:00">November 6, 2020 at 5:49 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
In programming languages (like Go and C++) where unsigned integers<br/>
cannot overflow, then there is always one, and only one, additive<br/>
inverse to every integer value.
</p></blockquote>
<p>This sentence is a bit confusing to read. If unsigned integers cannot overflow (i.e. unsigned overflow doesn&rsquo;t exist), then there can be no (unsigned) additive inverse.</p>
<p>By the way, I expected this post to discuss something else entirely. In Python, you have the following:</p>
<p><code>&gt;&gt;&gt; (-3) % 5<br/>
2<br/>
&gt;&gt;&gt; (-3) % (-5)<br/>
-3<br/>
&gt;&gt;&gt; 3 % (-5)<br/>
-2<br/>
</code></p>
<p>But in C (and presumably other C-like languages), the results are -3, -3, 3 respectively.</p>
</div>
<ol class="children">
<li id="comment-557342" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-11-06T18:16:25+00:00">November 6, 2020 at 6:16 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>This sentence is a bit confusing to read.</p>
</blockquote>
<p>I agree. I rephrased it as &ldquo;wrap around&rdquo;.</p>
</div>
</li>
<li id="comment-557343" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-11-06T18:28:13+00:00">November 6, 2020 at 6:28 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>By the way, I expected this post to discuss something else entirely. In Python, you have the following: (&#8230;) But in C (and presumably other C-like languages), the results are -3, -3, 3 respectively.</p>
</blockquote>
<p>The division and remainder (modulo) between signed integers are defined differently depending on the programming. E.g., we all agree that 4/3 is 1. But what is -4/3? It could be -2 or -1. You can round toward zero or toward minus infinity.</p>
</div>
</li>
</ol>
</li>
</ol>
