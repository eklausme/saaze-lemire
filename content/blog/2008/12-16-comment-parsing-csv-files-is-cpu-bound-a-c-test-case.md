---
date: "2008-12-16 12:00:00"
title: "Parsing CSV files is CPU bound: a C++ test case"
index: false
---

[3 thoughts on &ldquo;Parsing CSV files is CPU bound: a C++ test case&rdquo;](/lemire/blog/2008/12-16-parsing-csv-files-is-cpu-bound-a-c-test-case)

<ol class="comment-list">
<li id="comment-50355" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-18T18:34:06+00:00">December 18, 2008 at 6:34 pm</time></a> </div>
<div class="comment-content">
<p>You are most certainly right if you think that memory allocation is guilty. However, I specifically defined &ldquo;parsing&rdquo; as &ldquo;copying the fields into new arrays&rdquo;.</p>
<p>There is no question that if I just read the bytes and do nothing with them, it is not going to end up being CPU bound, but that is not very realistic of a real application, is it? Copying the fields and storing them into some array appears to me to me a basic operation.</p>
</div>
</li>
<li id="comment-50357" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-18T21:46:21+00:00">December 18, 2008 at 9:46 pm</time></a> </div>
<div class="comment-content">
<p><i>1. tokenize does heap allocation and copy *per value* via token string.</i></p>
<p>Heap allocation is avoided in latest version.</p>
<p><i>2. vector of strings also do an *extra* heap allocation and copy to copy construct *each element*.</i></p>
<p>Fixed this in latest version.</p>
<p><i>3. Shorter and complete I/O bound (for > then physical memory files) code can be written, using a custom allocator (~10 lines reusable code) that does only amortized 1 heap allocation and memcpy *per file*. Remember that you&rsquo;re using C++ not Java 🙂 The solution is left as an exercise for the readers 🙂</i></p>
<p>I wrote in my blog post:</p>
<p>Â«I do not claim that writing software where CSV parsing is strong I/O is not possible, or even easy.Â»</p>
</div>
</li>
<li id="comment-50356" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/715a901acf9741ff522d91f17694df3b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/715a901acf9741ff522d91f17694df3b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">vicaya</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-18T20:32:53+00:00">December 18, 2008 at 8:32 pm</time></a> </div>
<div class="comment-content">
<p>Major performance problems of the code:</p>
<p>0. getline does one heap allocation and copy for every line.</p>
<p>1. tokenize does heap allocation and copy *per value* via token string.</p>
<p>2. vector of strings also do an *extra* heap allocation and copy to copy construct *each element*.</p>
<p>3. Shorter and complete I/O bound (for &gt; then physical memory files) code can be written, using a custom allocator (~10 lines reusable code) that does only amortized 1 heap allocation and memcpy *per file*. Remember that you&rsquo;re using C++ not Java 🙂 The solution is left as an exercise for the readers 🙂</p>
</div>
</li>
</ol>
