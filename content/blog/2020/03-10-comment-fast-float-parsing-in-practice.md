---
date: "2020-03-10 12:00:00"
title: "Fast float parsing in practice"
index: false
---

[15 thoughts on &ldquo;Fast float parsing in practice&rdquo;](/lemire/blog/2020/03-10-fast-float-parsing-in-practice)

<ol class="comment-list">
<li id="comment-494630" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://example.com" class="url" rel="ugc external nofollow">degski</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-10T13:54:25+00:00">March 10, 2020 at 1:54 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
Unfortunately, many standard libraries have not yet caught up the standard and they fail to support from_chars properly.
</p></blockquote>
<p>On Windows it&rsquo;s highly optimized (by Stephan T. Lavavej himself). Possibly you could add, which std-libs are lagging, or bad.</p>
</div>
<ol class="children">
<li id="comment-494631" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-10T13:59:07+00:00">March 10, 2020 at 1:59 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>Possibly you could add, which std-libs are lagging, or bad.</p>
</blockquote>
<p>I&rsquo;d be more interested in knowing which one support it. The only one I have seen mentioned is Visual Studio. This will no doubt improve in the future, thankfully.</p>
<blockquote>
<p>On Windows it’s highly optimized</p>
</blockquote>
<p>Currently, this would not produce portable code since most other standard libraries I have tried do not support it. One portable approach is to rely on abseil.</p>
</div>
<ol class="children">
<li id="comment-494654" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://example.com" class="url" rel="ugc external nofollow">degski</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-10T16:32:42+00:00">March 10, 2020 at 4:32 pm</time></a> </div>
<div class="comment-content">
<p>Implicitly, you&rsquo;ve added it now to the comments.</p>
<p>With some fiddling (if very important and worth the trouble, and some digging in the relevant docs) one could create an object file with clang-cl and link that in on linux or with MinGW. The thing has more or less a c-api anyway.</p>
</div>
<ol class="children">
<li id="comment-494656" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-10T16:35:53+00:00">March 10, 2020 at 4:35 pm</time></a> </div>
<div class="comment-content">
<p>Seems easier to use abseil for the time being, no?</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-494646" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f9eecd123a44f65b75927052e160bebf?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f9eecd123a44f65b75927052e160bebf?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://mensinmotus.com" class="url" rel="ugc external nofollow">Sander Bouwhuis</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-10T15:35:44+00:00">March 10, 2020 at 3:35 pm</time></a> </div>
<div class="comment-content">
<p>Could you please also check against the &lsquo;new&rsquo; c++ format? They state that their implementation is also very fast.</p>
</div>
<ol class="children">
<li id="comment-494650" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-10T16:03:05+00:00">March 10, 2020 at 4:03 pm</time></a> </div>
<div class="comment-content">
<p>As far as I can tell, the &ldquo;new&rdquo; way to parse floats in C++ is to use &ldquo;from_chars&rdquo; and I address this both in my benchmarks and my post. If you are thinking about something else, would you kindly elaborate?</p>
</div>
<ol class="children">
<li id="comment-494723" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f9eecd123a44f65b75927052e160bebf?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f9eecd123a44f65b75927052e160bebf?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://mensinmotus.com" class="url" rel="ugc external nofollow">Sander Bouwhuis</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-11T06:39:59+00:00">March 11, 2020 at 6:39 am</time></a> </div>
<div class="comment-content">
<p>Aha, ok. I didn&rsquo;t know that it was based on the from_chars routine (I&rsquo;m still on C++17). Seeing as this is also quite fast that sounds very good.<br/>
Is there any chance the std::format can use your algorithm, or does that have to go through the committee?</p>
</div>
<ol class="children">
<li id="comment-494747" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-11T12:04:37+00:00">March 11, 2020 at 12:04 pm</time></a> </div>
<div class="comment-content">
<p>Standard libraries could certainly adopt the approach we have designed.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-494761" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7162b2123d51b183b31a4dbb6548adaf?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7162b2123d51b183b31a4dbb6548adaf?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/boostorg/beast" class="url" rel="ugc external nofollow">Vinnie</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-11T14:21:34+00:00">March 11, 2020 at 2:21 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve been doing some tests and I don&rsquo;t think this is as fast as the algorithm in RapidJSON: <a href="https://github.com/Tencent/rapidjson/blob/7e68aa0a21b7800ec98133cb106e49bd6536e25c/include/rapidjson/internal/strtod.h#L131" rel="nofollow ugc">https://github.com/Tencent/rapidjson/blob/7e68aa0a21b7800ec98133cb106e49bd6536e25c/include/rapidjson/internal/strtod.h#L131</a></p>
<p>Am I correct in understanding that the goal of your number parser is to produce identical results to the C++ standard implementation, and this is the source of the performance difference from RapidJSON?</p>
<p>Thanks</p>
</div>
<ol class="children">
<li id="comment-494765" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-11T15:14:33+00:00">March 11, 2020 at 3:14 pm</time></a> </div>
<div class="comment-content">
<p>You are correct.</p>
<p>RapidJSON has at least two fast-parsing mode. The fast mode, which I think is what you refer to, is indeed quite fast, but it can be off by one ULP, so it is not standard compliant. Boost Spirit similarly offers fast parsing, but it is not again not standard compliant.</p>
<p>Our very own simdjson has also a fast number parsing mode&#8230;</p>
</div>
</li>
</ol>
</li>
<li id="comment-497707" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/58c1a3b7009d2666847289f4cd3d4dd9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/58c1a3b7009d2666847289f4cd3d4dd9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Albert Chan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-24T14:51:54+00:00">March 24, 2020 at 2:51 pm</time></a> </div>
<div class="comment-content">
<p>David Gay&rsquo;s <strong>dtoa.c</strong> had updated (2016) with 96-bits big float, which speed up his earlier version by quite a bit, an order of magnitude or faster in some cases.</p>
<p>see CHANGES dated 20160429,<br/>
<a href="http://www.netlib.org/fp/" rel="nofollow ugc">http://www.netlib.org/fp/</a></p>
</div>
<ol class="children">
<li id="comment-497711" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-24T15:31:18+00:00">March 24, 2020 at 3:31 pm</time></a> </div>
<div class="comment-content">
<p>Thank you.</p>
</div>
<ol class="children">
<li id="comment-498279" class="comment byuser comment-author-lemire bypostauthor even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-28T02:43:22+00:00">March 28, 2020 at 2:43 am</time></a> </div>
<div class="comment-content">
<p>Note for people reading this: dtoa goes in the opposite direction.</p>
</div>
<ol class="children">
<li id="comment-581214" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/69dcd277799bf98a2cd1c39dc48a82a3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/69dcd277799bf98a2cd1c39dc48a82a3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marcin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-30T20:06:59+00:00">March 30, 2021 at 8:06 pm</time></a> </div>
<div class="comment-content">
<p>The file name is confusing; dtoa.c contains both dtoa() and strtod(). I suppose Albert meant the latter.</p>
</div>
<ol class="children">
<li id="comment-581215" class="comment byuser comment-author-lemire bypostauthor even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-30T20:16:00+00:00">March 30, 2021 at 8:16 pm</time></a> </div>
<div class="comment-content">
<p>@Marcin Yes and I include benchmark against the updated code at <a href="https://github.com/lemire/simple_fastfloat_benchmark" rel="nofollow ugc">https://github.com/lemire/simple_fastfloat_benchmark</a></p>
<p>I do not think that the string parsing has been made orders of magnitude faster. At least, my tests do not reveal much difference.</p>
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
</ol>
