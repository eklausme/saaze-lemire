---
date: "2017-09-29 12:00:00"
title: "How smart is Swift with abstraction? A trivial experiment with protocols"
index: false
---

[4 thoughts on &ldquo;How smart is Swift with abstraction? A trivial experiment with protocols&rdquo;](/lemire/blog/2017/09-29-how-smart-is-swift-with-abstraction-a-trivial-experiment-with-protocols)

<ol class="comment-list">
<li id="comment-287736" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f8a7ccb41af2422d10599464b96cf034?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f8a7ccb41af2422d10599464b96cf034?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://franklinchen.com/" class="url" rel="ugc external nofollow">Franklin Chen</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-01T22:16:02+00:00">October 1, 2017 at 10:16 pm</time></a> </div>
<div class="comment-content">
<p>Rust version also inlines all the way to 800.</p>
<p><a href="https://godbolt.org/g/2gw5Tj" rel="nofollow ugc">https://godbolt.org/g/2gw5Tj</a></p>
</div>
<ol class="children">
<li id="comment-287737" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-01T22:17:31+00:00">October 1, 2017 at 10:17 pm</time></a> </div>
<div class="comment-content">
<p>That would have been my expectation, but thanks for checking!</p>
</div>
</li>
</ol>
</li>
<li id="comment-289845" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/88122adf04e76df968866fc8424478e0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/88122adf04e76df968866fc8424478e0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Elazar Leibovich</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-24T17:12:26+00:00">October 24, 2017 at 5:12 pm</time></a> </div>
<div class="comment-content">
<p>Are you sure C would do that by default with two translation units?</p>
<p>Is LTO on by default?</p>
</div>
<ol class="children">
<li id="comment-289847" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-24T17:20:08+00:00">October 24, 2017 at 5:20 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s a fair point. In C and C++, you may end up with slower code.</p>
<p>Point is: Swift does well in this instance.</p>
</div>
</li>
</ol>
</li>
</ol>
