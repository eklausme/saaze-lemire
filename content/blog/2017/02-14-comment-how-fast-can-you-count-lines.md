---
date: "2017-02-14 12:00:00"
title: "How fast can you count lines?"
index: false
---

[12 thoughts on &ldquo;How fast can you count lines?&rdquo;](/lemire/blog/2017/02-14-how-fast-can-you-count-lines)

<ol class="comment-list">
<li id="comment-271692" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5ccac041165fd36509446db4ba6fbabc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5ccac041165fd36509446db4ba6fbabc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://github.com/powturbo" class="url" rel="ugc external nofollow">powturbo</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-14T19:33:14+00:00">February 14, 2017 at 7:33 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve upgrated a similar sse2 implementation to avx2:<br/>
<a href="https://gist.github.com/powturbo" rel="nofollow ugc">https://gist.github.com/powturbo</a></p>
<p>see also:<br/>
<a href="https://www.reddit.com/r/coding/comments/44ri8a/beating_the_optimizer/" rel="nofollow ugc">https://www.reddit.com/r/coding/comments/44ri8a/beating_the_optimizer/</a></p>
</div>
</li>
<li id="comment-271782" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://blog.lbs.ca/technology" class="url" rel="ugc external nofollow">Dominic Amann</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-15T13:52:48+00:00">February 15, 2017 at 1:52 pm</time></a> </div>
<div class="comment-content">
<p>Although your compiler should sort this out for you &#8211; it would be preferable to use the pre-increment operator unless you explicitly want the post increment.</p>
</div>
<ol class="children">
<li id="comment-271783" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-15T13:57:27+00:00">February 15, 2017 at 1:57 pm</time></a> </div>
<div class="comment-content">
<p>Can you demonstrate an example in C where there is any performance difference between pre-increment versus post-increment? (I do mean &ldquo;C&rdquo;, as in C99. Not C++.)</p>
</div>
</li>
</ol>
</li>
<li id="comment-271802" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24cfa9591263008553ae4c125b6a9934?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24cfa9591263008553ae4c125b6a9934?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">wmu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-15T17:46:42+00:00">February 15, 2017 at 5:46 pm</time></a> </div>
<div class="comment-content">
<p>Daniel, did you see what decent compiler do with the scalar code? GCC 5.4 (and newer) make attempt to vectorize the code: <a href="https://godbolt.org/g/uXl6g1" rel="nofollow ugc">https://godbolt.org/g/uXl6g1</a></p>
<p>The result is not the best code possible, thus the performance isn&rsquo;t good. Anyway, I&rsquo;m impressed.</p>
</div>
<ol class="children">
<li id="comment-271805" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24cfa9591263008553ae4c125b6a9934?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24cfa9591263008553ae4c125b6a9934?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">wmu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-15T18:07:21+00:00">February 15, 2017 at 6:07 pm</time></a> </div>
<div class="comment-content">
<p>BTW, I rewritten your basiccount method using some SWAR tricks. The procedure from gist[1] works at 0.45 cycles on Skylake.</p>
<p>[1] <a href="https://gist.github.com/WojciechMula/6200d3991c366b7d6b53c2dd35b785dc" rel="nofollow ugc">https://gist.github.com/WojciechMula/6200d3991c366b7d6b53c2dd35b785dc</a></p>
</div>
</li>
<li id="comment-271806" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-15T18:07:28+00:00">February 15, 2017 at 6:07 pm</time></a> </div>
<div class="comment-content">
<p>It seems that icc and clang also vectorize the problem. It is not surprising considering how common such code is likely to be. What is slightly disappointing is how they all seem to get it wrong, performance wise.</p>
</div>
</li>
</ol>
</li>
<li id="comment-272311" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/81e162a4d4206cc9e289dd87b817686c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/81e162a4d4206cc9e289dd87b817686c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cristi C</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-20T11:57:33+00:00">February 20, 2017 at 11:57 am</time></a> </div>
<div class="comment-content">
<p>According to <a href="https://github.com/vks/bytecounttest" rel="nofollow ugc">https://github.com/vks/bytecounttest</a>, llogiq&rsquo;s solution runs in about 29ms against your 40ms in the `avxu` version (if I read that benchmark correctly). I&rsquo;m a little worried about differences around inlining (since the bench code is written in Rust, linking with your C code), but I&rsquo;d say that the perf is very much in the same ballpark.</p>
</div>
<ol class="children">
<li id="comment-272322" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-20T14:00:10+00:00">February 20, 2017 at 2:00 pm</time></a> </div>
<div class="comment-content">
<p>Hmmm&#8230; the numbers I see reported are 29 ns vs. 40 ns. From my naive look at the Rust code, this seems to be measuring the time to process a whole string.</p>
</div>
<ol class="children">
<li id="comment-272326" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/81e162a4d4206cc9e289dd87b817686c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/81e162a4d4206cc9e289dd87b817686c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cristi C</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-20T14:32:11+00:00">February 20, 2017 at 2:32 pm</time></a> </div>
<div class="comment-content">
<p>Sorry, I meant `ns`, just typo&rsquo;d `ms` vs `ns`. I kept the same ratio though 😛</p>
</div>
<ol class="children">
<li id="comment-272330" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-20T14:57:20+00:00">February 20, 2017 at 2:57 pm</time></a> </div>
<div class="comment-content">
<p>Yes, but I cannot trust these numbers. Did you manage to compile this code and run it for yourself?</p>
</div>
<ol class="children">
<li id="comment-273528" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6d633a9adb678ae58ba053b521b41844?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6d633a9adb678ae58ba053b521b41844?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://llogiq.github.io" class="url" rel="ugc external nofollow">llogiq</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-01T08:07:13+00:00">March 1, 2017 at 8:07 am</time></a> </div>
<div class="comment-content">
<p>Sorry, I was not able to run the benchmarks so far due to a build script error I don&rsquo;t have sufficient time to debug at the moment.</p>
<p>In case it helps, I personally have met vks at multiple meetups and trust his results are accurate (on his machine, YMMV).</p>
<p>To help explain this, bytecount in its current version also uses AVX, and still does the intermediate reduction, which enables it to count more bytes with one 512bit counter.</p>
</div>
<ol class="children">
<li id="comment-273549" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-01T14:27:58+00:00">March 1, 2017 at 2:27 pm</time></a> </div>
<div class="comment-content">
<p><em>In case it helps, I personally have met vks at multiple meetups and trust his results are accurate</em></p>
<p>It is not a matter of putting into question the integrity of the individual. Rather it is a matter of having numbers that say what you think they say. </p>
<p>I report processing input bytes at a rate of 0.04 cycles per byte. </p>
<p>What should I infer from the 29 ns vs. 40 ns number? That he tested a faster approach that can process input bytes at a rate of 0.03 cycles per byte?</p>
<p>That&rsquo;s not an impossible number&#8230; but is that what is being claimed?</p>
<p>You see my problem? </p>
<p>When I write that I do not trust these numbers, I don&rsquo;t mean that the author made up numbers or cheated in some way&#8230; I mean that I am not confident people know what they mean exactly.</p>
<p>Something else bothers me. He reports two orders of magnitude gains over the basic code. I report a single order of magnitude difference. What explains this difference? Possibly the inefficiency of the Rust compiler, but once we start factoring in the possibility that the Rust compiler is deficient, all sorts of considerations must enter into play.</p>
<p>To put it bluntly, we need a lot more analysis to understand what is going on. </p>
<p>At this point, we do not have an analysis (e.g., how many CPU cycles are used per input byte) and it is not straight-forward to reproduce the benchmark.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
