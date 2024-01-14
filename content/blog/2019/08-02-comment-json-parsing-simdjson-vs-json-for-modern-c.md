---
date: "2019-08-02 12:00:00"
title: "JSON parsing: simdjson vs. JSON for Modern C++"
index: false
---

[5 thoughts on &ldquo;JSON parsing: simdjson vs. JSON for Modern C++&rdquo;](/lemire/blog/2019/08-02-json-parsing-simdjson-vs-json-for-modern-c)

<ol class="comment-list">
<li id="comment-421882" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://example.com" class="url" rel="ugc external nofollow">degski</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-03T04:11:57+00:00">August 3, 2019 at 4:11 am</time></a> </div>
<div class="comment-content">
<p>Thanks, for posting this.</p>
<p>That is well a mega difference, very impressive. I&rsquo;m just using it [nlohmann/json] for some settings and some data from the web, so speed is not relevant, but if it got to be relevant for another application, I&rsquo;d definitely look into simdjson.</p>
</div>
</li>
<li id="comment-422154" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://example.com" class="url" rel="ugc external nofollow">degski</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-05T02:51:17+00:00">August 5, 2019 at 2:51 am</time></a> </div>
<div class="comment-content">
<p>vcpkg has simdjson in its repo (for those that did not know).</p>
</div>
<ol class="children">
<li id="comment-422230" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-05T13:46:09+00:00">August 5, 2019 at 1:46 pm</time></a> </div>
<div class="comment-content">
<p>We are working toward releasing version 0.2 on vcpkg.</p>
</div>
</li>
</ol>
</li>
<li id="comment-422240" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24cfa9591263008553ae4c125b6a9934?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24cfa9591263008553ae4c125b6a9934?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">wmu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-05T16:43:48+00:00">August 5, 2019 at 4:43 pm</time></a> </div>
<div class="comment-content">
<p>Daniel, you wrote &ldquo;[JSON for Modern C++] is designed for ease-of-use: it makes the life of the programmer as easy as possible. In contrast, simdjson optimizes for speed, even when it requires a bit more work from the programmer.&rdquo; As a programmer I never used simdjson, but have some experience with nlohmann/json and I&rsquo;m wondering how difficult to use your library is.</p>
</div>
<ol class="children">
<li id="comment-422257" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-05T20:28:59+00:00">August 5, 2019 at 8:28 pm</time></a> </div>
<div class="comment-content">
<p>We support a conventional DOM traversal as well as JSON pointers. Our DOM tree is immutable.</p>
<p>Please try it out!</p>
</div>
</li>
</ol>
</li>
</ol>
