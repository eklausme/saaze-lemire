---
date: "2022-07-27 12:00:00"
title: "Comparing strtod with from_chars (GCC 12)"
index: false
---

[2 thoughts on &ldquo;Comparing strtod with from_chars (GCC 12)&rdquo;](/lemire/blog/2022/07-27-comparing-strtod-with-from_chars-gcc-12)

<ol class="comment-list">
<li id="comment-643751" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5522149b2f3ae587f43dac4b027e518a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5522149b2f3ae587f43dac4b027e518a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Anupam Kapoor</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-22T14:54:45+00:00">August 22, 2022 at 2:54 pm</time></a> </div>
<div class="comment-content">
<p>have a trivial question: if the entire range needs to be parsed, shouldn&rsquo;t the check be &lsquo;p != st.data() + st.size()&rsquo; for an error condition ? thereby ensuring that all characters in the range were used ?</p>
</div>
<ol class="children">
<li id="comment-645422" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-09T19:57:02+00:00">September 9, 2022 at 7:57 pm</time></a> </div>
<div class="comment-content">
<p>If the entire string is matched, it does not mean that there was an error.</p>
</div>
</li>
</ol>
</li>
</ol>
