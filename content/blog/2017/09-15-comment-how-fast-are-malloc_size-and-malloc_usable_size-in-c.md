---
date: "2017-09-15 12:00:00"
title: "How fast are  malloc_size and malloc_usable_size in C?"
index: false
---

[2 thoughts on &ldquo;How fast are malloc_size and malloc_usable_size in C?&rdquo;](/lemire/blog/2017/09-15-how-fast-are-malloc_size-and-malloc_usable_size-in-c)

<ol class="comment-list">
<li id="comment-286318" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3bcc2e0f60fe12078bfced929aa851f3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3bcc2e0f60fe12078bfced929aa851f3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Scott Hess</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-19T03:59:56+00:00">September 19, 2017 at 3:59 am</time></a> </div>
<div class="comment-content">
<p>malloc_size can be useful for cases where you&rsquo;re allocating a buffer which is dynamically changing size over time, and you want to just use the entire buffer you get rather than leaving a bunch slack. For instance, think of std::vector storage, you would prefer that both the STL and underlying malloc library don&rsquo;t each have a bunch of unused padding in there. Better would be to use something like malloc_good_size(), since the library can usually answer that question directly without any heap references, but that&rsquo;s also non-standard.</p>
<p>Apple&rsquo;s implementation stores the length in a side bitmap which covers a large chunk of memory. Some other implementations store the info in a prefix of the allocated space, which will generally be very fast since it&rsquo;s likely to share cache lines with the allocated data.</p>
</div>
</li>
<li id="comment-286501" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a4f96894ca46c1c7e7c3aba97cb1c642?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a4f96894ca46c1c7e7c3aba97cb1c642?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">A S Gowri Sankar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-21T06:45:46+00:00">September 21, 2017 at 6:45 am</time></a> </div>
<div class="comment-content">
<p>If the issue with the search algorithm efficiency is in the Kernel, I really hope it&rsquo;s in the Darwin piece of it, not the BSD piece</p>
</div>
</li>
</ol>
