---
date: "2019-08-01 12:00:00"
title: "A new release of simdjson: runtime dispatching, 64-bit ARM support and more"
index: false
---

[3 thoughts on &ldquo;A new release of simdjson: runtime dispatching, 64-bit ARM support and more&rdquo;](/lemire/blog/2019/08-01-a-new-release-of-simdjson-runtime-dispatching-64-bit-arm-support-and-more)

<ol class="comment-list">
<li id="comment-421813" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://example.com" class="url" rel="ugc external nofollow">degski</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-02T13:47:34+00:00">August 2, 2019 at 1:47 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve gotten interested in this lately, and I opted for <a href="https://github.com/nlohmann/json" rel="nofollow ugc">https://github.com/nlohmann/json</a>. nlohmann acknowledges that it might not be the fastest parser, but he says it&rsquo;s easy to use [and it is]. When I look at <a href="https://github.com/lemire/simdjson#navigating-the-parsed-document" rel="nofollow ugc">https://github.com/lemire/simdjson#navigating-the-parsed-document</a> , I must concede that as compared to navigating through nested std::maps, this seems to be rather rudimentary. What I miss in the qualification of &lsquo;it is the fastest parser&rsquo;, is how fast or easy is it to use the data after the parsing. A [speed] comparison would obviously be welcome, so one can balance speed against ease of use.</p>
</div>
<ol class="children">
<li id="comment-421818" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-02T14:49:46+00:00">August 2, 2019 at 2:49 pm</time></a> </div>
<div class="comment-content">
<p>I think that even if you end up not using simdjson, simdjson can be beneficial to you because it tells you something about how fast the parsing can be (as an engineering constraint).</p>
</div>
</li>
<li id="comment-421822" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-02T15:58:23+00:00">August 2, 2019 at 3:58 pm</time></a> </div>
<div class="comment-content">
<p>I have answered your question by another blog post:<br/>
<a href="https://lemire.me/blog/2019/08/02/json-parsing-simdjson-vs-json-for-modern-c/" rel="ugc">https://lemire.me/blog/2019/08/02/json-parsing-simdjson-vs-json-for-modern-c/</a></p>
</div>
</li>
</ol>
</li>
</ol>
