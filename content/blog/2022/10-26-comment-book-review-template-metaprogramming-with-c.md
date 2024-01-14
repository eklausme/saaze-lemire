---
date: "2022-10-26 12:00:00"
title: "Book Review : Template Metaprogramming with C++"
index: false
---

[3 thoughts on &ldquo;Book Review : Template Metaprogramming with C++&rdquo;](/lemire/blog/2022/10-26-book-review-template-metaprogramming-with-c)

<ol class="comment-list">
<li id="comment-647064" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2796b8f6f9bb92cfb03793296e997d47?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2796b8f6f9bb92cfb03793296e997d47?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Denis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-10-26T20:05:06+00:00">October 26, 2022 at 8:05 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;Up until recently, you could not mix templates and lambdas, but now you can with C++20:&rdquo;</p>
<p>You could since C++14.<br/>
<code><br/>
int g(int x, int y) {<br/>
auto lambda = [](auto x, auto y) { return x + y; };<br/>
return lambda(x, y);<br/>
}<br/>
</code><br/>
It&rsquo;s the same as<br/>
<a href="https://godbolt.org/z/f59cezsje" rel="nofollow ugc">https://godbolt.org/z/f59cezsje</a></p>
</div>
<ol class="children">
<li id="comment-647301" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/096d991ae8bf781c317966ec99224bdd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/096d991ae8bf781c317966ec99224bdd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jonathan O'Connor</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-03T09:41:08+00:00">November 3, 2022 at 9:41 am</time></a> </div>
<div class="comment-content">
<p>I think the change in C++20 was to make it easier to get the type of x and y. Before C++20, you&rsquo;d need the following code:<br/>
<code><br/>
int g(int x, int y) {<br/>
auto lambda = [](auto x, auto y) {<br/>
using T = decltype(x);<br/>
return T(x + y);<br/>
};<br/>
return lambda(x, y);<br/>
}<br/>
</code></p>
<p>C++20 allows the following:<br/>
<code><br/>
int g(int x, int y) {<br/>
auto lambda = [](T x, T y) {<br/>
return T(x + y);<br/>
};<br/>
return lambda(x, y);<br/>
}<br/>
</code></p>
<p>This last example also ensures that x and y have the same type, which the C++14 example does not.</p>
</div>
</li>
</ol>
</li>
<li id="comment-647065" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2796b8f6f9bb92cfb03793296e997d47?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2796b8f6f9bb92cfb03793296e997d47?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Denis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-10-26T20:06:04+00:00">October 26, 2022 at 8:06 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;Up until recently, you could not mix templates and lambdas, but now you can with C++20:&rdquo;</p>
<p>You could since C++14.<br/>
<code><br/>
int g(int x, int y) {<br/>
auto lambda = [](auto x, auto y) { return x + y; };<br/>
return lambda(x, y);<br/>
}<br/>
</code><br/>
It&rsquo;s the same as<br/>
<code><br/>
[](T1 x, T2 y) { return x + y; };<br/>
</code><br/>
however, hence the C++20 syntax.<br/>
<a href="https://godbolt.org/z/f59cezsje" rel="nofollow ugc">https://godbolt.org/z/f59cezsje</a></p>
</div>
</li>
</ol>
