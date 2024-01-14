---
date: "2021-07-29 12:00:00"
title: "Measuring memory usage: virtual versus real memory"
index: false
---

[4 thoughts on &ldquo;Measuring memory usage: virtual versus real memory&rdquo;](/lemire/blog/2021/07-29-measuring-memory-usage-virtual-versus-real-memory)

<ol class="comment-list">
<li id="comment-592951" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5b71e3bfffd87a8fe2731a23488f6a34?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5b71e3bfffd87a8fe2731a23488f6a34?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Ron</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-02T08:35:12+00:00">August 2, 2021 at 8:35 am</time></a> </div>
<div class="comment-content">
<p>Are we still mostly using 4 KiB pages though? I would think 64-bit architectures and desktop systems would be using 16 KiB or even 64 KiB pages by now.</p>
</div>
<ol class="children">
<li id="comment-592984" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-02T14:12:35+00:00">August 2, 2021 at 2:12 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>Are we still mostly using 4 KiB pages though?</p>
</blockquote>
<p>What is the page size on your PC?</p>
</div>
</li>
</ol>
</li>
<li id="comment-592953" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d8b5cf3679fa7a4f32994df31d6fb180?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d8b5cf3679fa7a4f32994df31d6fb180?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://pveentjer.blogspot.com/" class="url" rel="ugc external nofollow">Peter Veentjer</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-02T09:29:48+00:00">August 2, 2021 at 9:29 am</time></a> </div>
<div class="comment-content">
<p>Under Linux a large allocation can be done with an anonymous mapping using mmap. The zero-page will be used for the memory mapping. The zero-page is readonly and managed by the OS; so as long as you don&rsquo;t write to the page, no page frames will be allocated. And you won&rsquo;t end up with garbage when you read from a zero page since it is zeroed out. Only when there is a write, the copy on write feature kicks in and a page frame will be allocated. This is when physical RAM is being used.</p>
</div>
</li>
<li id="comment-592975" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6aea6e2f57f2a7b1cd6870375fbdc42f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6aea6e2f57f2a7b1cd6870375fbdc42f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ivan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-02T12:40:11+00:00">August 2, 2021 at 12:40 pm</time></a> </div>
<div class="comment-content">
<p>I think this post is highly confusing for junior developers.</p>
<p>There <strong>is</strong> a point in micro optimizing the memory application if you do <strong>many</strong> small memory allocations. They do not magically become cheap because 100 of them fit in 4kb page. Those allocs still need to be accounted for so malloc and free will work, they are not free..</p>
</div>
</li>
</ol>
