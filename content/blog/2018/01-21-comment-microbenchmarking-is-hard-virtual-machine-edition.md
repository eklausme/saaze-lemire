---
date: "2018-01-21 12:00:00"
title: "Microbenchmarking is hard: virtual machine edition"
index: false
---

[5 thoughts on &ldquo;Microbenchmarking is hard: virtual machine edition&rdquo;](/lemire/blog/2018/01-21-microbenchmarking-is-hard-virtual-machine-edition)

<ol class="comment-list">
<li id="comment-295361" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c5d744640b5a0d326bf75e5579487324?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c5d744640b5a0d326bf75e5579487324?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://dendibakh.github.io" class="url" rel="ugc external nofollow">Denis</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-21T13:58:31+00:00">January 21, 2018 at 1:58 pm</time></a> </div>
<div class="comment-content">
<p>I more than agree that writing a good (micro)benchmark is hard. And not only in Java, in C++ as well. Benchmarking a simplest function can become a hard problem when you face code alignment issues or other CPU architectural effects like caches, etc. Take a look at my recent post. <a href="https://dendibakh.github.io/blog/2018/01/18/Code_alignment_issues" rel="nofollow ugc">https://dendibakh.github.io/blog/2018/01/18/Code_alignment_issues</a></p>
</div>
<ol class="children">
<li id="comment-295389" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-21T23:18:05+00:00">January 21, 2018 at 11:18 pm</time></a> </div>
<div class="comment-content">
<p>It is a cool post.</p>
</div>
</li>
<li id="comment-295469" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-23T02:31:46+00:00">January 23, 2018 at 2:31 am</time></a> </div>
<div class="comment-content">
<p>Do you have RSS/Atom feed for your blog?</p>
</div>
</li>
</ol>
</li>
<li id="comment-295384" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-21T21:26:59+00:00">January 21, 2018 at 9:26 pm</time></a> </div>
<div class="comment-content">
<p>Actually with JMH, I find it easier to write a micro-benchmark in Java. It solves most of the hard problems (within reason: if, for example, you allocate memory in your test you&rsquo;ll always have significant variance), and offers you the tools at hand you need to sink results, measure latency, measure throughput, etc. You can have the tool annotate the generated assembly level for you with cycle counts, you can record performance counters, etc.</p>
<p>The tool has definitely been written by experts and it shows. </p>
<p>Other than that, I agree &#8211; any type of analysis of low-level performance in these higher level languages than run a in VM add a whole layer of complicating factors, on top of the ones that the OS and runtime already impose.</p>
<p>That last point is important: some of these issues exist even for stuff written in C or C++: transparent hugepages, for example, is essentially a garbage collector running asynchronously in the OS, possibly changing your virtual to physical mapping at runtime, sometimes giving you huge pages, and sometimes not, etc. You can see big run-to-run variation due to this. Of course, once you know about it, you can control it. This stuff is getting more common, not less.</p>
</div>
<ol class="children">
<li id="comment-295391" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-21T23:46:08+00:00">January 21, 2018 at 11:46 pm</time></a> </div>
<div class="comment-content">
<p>I agree that JMH makes it easier to write benchmarks in Java. I think that all my Java benchmarks have relied on JMH for years now.</p>
</div>
</li>
</ol>
</li>
</ol>
