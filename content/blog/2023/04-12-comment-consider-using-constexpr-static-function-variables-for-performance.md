---
date: "2023-04-12 12:00:00"
title: "Consider using constexpr static function variables for performance in C++"
index: false
---

[3 thoughts on &ldquo;Consider using constexpr static function variables for performance in C++&rdquo;](/lemire/blog/2023/04-12-consider-using-constexpr-static-function-variables-for-performance)

<ol class="comment-list">
<li id="comment-655842" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c20d4fcfaa4f97727d53f213935fcd15?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c20d4fcfaa4f97727d53f213935fcd15?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Romin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-30T15:01:30+00:00">October 30, 2023 at 3:01 pm</time></a> </div>
<div class="comment-content">
<p>Hi!</p>
<p>I wonder if the benchmark between std::string and std::string_view is 100% fair.</p>
<p>Your functions that return std::string need to explicitly copy the grabbed string. If you make your &ldquo;static const std::string&rdquo; version return by reference, it really makes it as fast as the &ldquo;static std::string_view&rdquo; version.</p>
<p>About code bloat, I fully agree that the constexpr version is better.</p>
<p>Anyway, thanks for sharing!</p>
</div>
<ol class="children">
<li id="comment-655851" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-31T00:53:17+00:00">October 31, 2023 at 12:53 am</time></a> </div>
<div class="comment-content">
<p>I agree that the performance (in terms of speed) is sometimes (but not always) identical.</p>
</div>
</li>
</ol>
</li>
<li id="comment-656628" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cc12eb7066fa3426487ceb067d7f2987?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cc12eb7066fa3426487ceb067d7f2987?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Juliean</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-04T15:18:02+00:00">December 4, 2023 at 3:18 pm</time></a> </div>
<div class="comment-content">
<p>The reason why static and constexpr perform similar is that, most likely, the compiler will detect that the array is a constant expression (even if not specified), and remove it. This can be observed with your example-code in Godbolt. This is true for most code &#8211; a lot of the time, an optimizing compiler can do the same work regardless of whether a function is marked constexpr or not (as long as it can see the definition).</p>
<p>constexpr is mainly used to enforce this, even in a debug-build (aside from all the other uses where non-constexpr function cannot be used to). constexpr also forced the functions definition to be visible when used.</p>
</div>
</li>
</ol>
