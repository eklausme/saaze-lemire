---
date: "2012-10-29 12:00:00"
title: "Is reading memory faster than writing on a PC?"
index: false
---

[5 thoughts on &ldquo;Is reading memory faster than writing on a PC?&rdquo;](/lemire/blog/2012/10-29-is-reading-memory-faster-than-writing-to-memory-on-a-pc)

<ol class="comment-list">
<li id="comment-58360" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://yosefk.com" class="url" rel="ugc external nofollow">Yossi Kreinin</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-30T01:58:26+00:00">October 30, 2012 at 1:58 am</time></a> </div>
<div class="comment-content">
<p>Interesting. In theory, writing is fundamentally cheaper than reading, because you typically have to wait for the value you read but not for the completion of your write requests. </p>
<p>However, a cache using an allocate-on-write policy will frequently end up reading a cache line so that it can then write to that cache line (because caches are maintained at line granularity and you can&rsquo;t just write a word without knowing its &ldquo;surroundings&rdquo; or else you&rsquo;ll eventually overwrite these surroundings with garbage); and then eventually it&rsquo;ll have to evict the dirty cache line &#8211; making writing more work than reading, after all. And if large arrays are involved, high-end CPUs will eliminate the waiting for read results through prefetching.</p>
<p>An interesting thing to test is scattered reads and writes, where prefetching doesn&rsquo;t kick in so reading gets more expensive (but writing still involves reading, just not necessarily waiting for its completion).</p>
<p>A more &ldquo;extreme&rdquo; thing to test is writing to non-cachable memory regions (so no reading of &ldquo;surroundings&rdquo; is involved), and still more &ldquo;extreme&rdquo; would be using some sort of DMA engine and local memory instead of cache; thus, the large latency of read and a lack thereof for write would be very visible. Of course this type of &ldquo;close to the metal&rdquo; work can be irrelevant if your target is commodity CPUs and OSes.</p>
</div>
</li>
<li id="comment-58389" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eccbfb99f2a3da9810b0b2cb23400ac4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eccbfb99f2a3da9810b0b2cb23400ac4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://plus.google.com/+RalphCorderoy" class="url" rel="ugc external nofollow">Ralph Corderoy</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-30T09:20:58+00:00">October 30, 2012 at 9:20 am</time></a> </div>
<div class="comment-content">
<p>Hi Daniel, unpack()&rsquo;s &ldquo;d[x] = compressed[x];&rdquo; needs a mask above;â€‚you&rsquo;ve already fixed it in the code proper.</p>
<p>Also, Nathan Baum pointed out the code looks wrong elsewhere and I agree.â€‚A single index, x, is used in pack() and unpack() and strides on eight at a time.â€‚This means the compressed bytes holding eight bools have seven unused bytes between them.â€‚Referring to the github code, char comp[N / 8] would be too small given the long stride but fortunately, pack() and unpack() are both wrongly told there&rsquo;s N / 8 bools in play, rather than N, so comp[]&rsquo;s big enough but only the first eighth of bool data[] is used.â€‚Clearing the source array in the middle of the test loop before unpacking back into it should show the assert failing.</p>
</div>
</li>
<li id="comment-58403" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-30T11:42:38+00:00">October 30, 2012 at 11:42 am</time></a> </div>
<div class="comment-content">
<p>@Ralph</p>
<p>Yes, I have merged the bug fix contributed by Nathan Baum and updated the code in this blog post. It does not change the analysis.</p>
</div>
</li>
<li id="comment-260890" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a4bee6f79e7601d51ea22638aac6d40f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a4bee6f79e7601d51ea22638aac6d40f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michiel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-11-24T23:50:01+00:00">November 24, 2016 at 11:50 pm</time></a> </div>
<div class="comment-content">
<p>Reading is two times faster than writing, due to DDR design (the R stands for read, not write), assuming sequential access.<br/>
Writing is faster than reading, because the processor does not need to wait, see Yossi.</p>
</div>
<ol class="children">
<li id="comment-360822" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cbb67141d9b974ae13a251e07e79968f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cbb67141d9b974ae13a251e07e79968f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://gogetdeals.co.uk/store/crucial-uk" class="url" rel="ugc external nofollow">Shane Taylor</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-29T12:48:50+00:00">October 29, 2018 at 12:48 pm</time></a> </div>
<div class="comment-content">
<p>Totally Agree with you.</p>
</div>
</li>
</ol>
</li>
</ol>
