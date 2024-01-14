---
date: "2023-03-21 12:00:00"
title: "Counting cycles and instructions on ARM-based Apple systems"
index: false
---

[6 thoughts on &ldquo;Counting cycles and instructions on ARM-based Apple systems&rdquo;](/lemire/blog/2023/03-21-counting-cycles-and-instructions-on-arm-based-apple-systems)

<ol class="comment-list">
<li id="comment-651168" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6834faa83de3659cfc8a214b1bacc9c1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6834faa83de3659cfc8a214b1bacc9c1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Zhongpu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-21T05:23:25+00:00">April 21, 2023 at 5:23 am</time></a> </div>
<div class="comment-content">
<p>I have some doubts about linux-perf-events.h.</p>
<p>Question 1: it seems that ids is never used. Why not a local variable?</p>
<p><code>for (auto config : config_vec) {<br/>
attribs.config = config;<br/>
fd = static_cast&lt;int&gt;(syscall(__NR_perf_event_open, &amp;attribs, pid, cpu, group, flags));<br/>
if (fd == -1) {<br/>
report_error("perf_event_open");<br/>
}<br/>
ioctl(fd, PERF_EVENT_IOC_ID, &amp;ids[i++]);<br/>
if (group == -1) {<br/>
group = fd;<br/>
}<br/>
}<br/>
</code></p>
<p>Question 2: how to understand &ldquo;our actual results are in slots 1,3,5&rdquo;?</p>
<p><code>for (uint32_t i = 1; i &lt; temp_result_vec.size(); i += 2) {<br/>
results[i / 2] = temp_result_vec[i];<br/>
}<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-651200" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-21T15:07:22+00:00">April 21, 2023 at 3:07 pm</time></a> </div>
<div class="comment-content">
<p>Pull requests invited !</p>
</div>
</li>
</ol>
</li>
<li id="comment-656181" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d2e07f546f9065911f6b10b2fede85b7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d2e07f546f9065911f6b10b2fede85b7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Quazi Irfan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-17T03:34:58+00:00">November 17, 2023 at 3:34 am</time></a> </div>
<div class="comment-content">
<p>Why instruction count is double? Shouldn&rsquo;t be a whole number?</p>
</div>
<ol class="children">
<li id="comment-656182" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-17T03:54:04+00:00">November 17, 2023 at 3:54 am</time></a> </div>
<div class="comment-content">
<p>Yes. Of course, you can represent an integer using a floating-point number… which is convenient if you want to compute an average, for example.</p>
</div>
<ol class="children">
<li id="comment-656183" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d2e07f546f9065911f6b10b2fede85b7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d2e07f546f9065911f6b10b2fede85b7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Quazi Irfan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-17T05:07:38+00:00">November 17, 2023 at 5:07 am</time></a> </div>
<div class="comment-content">
<p>I was able to reproduce the measurement on my end using Dougall&rsquo;s code. Thank you for linking it in your code.</p>
<p>On x86, rdtsc starts during CPU power on, and keeps increasing. But it is not the case for Dougall&rsquo;s code. I think the counting starts with the program, as I&rsquo;ve noticed it start with a small number everytime. Do you concur? Here[1] is the snippet I am running. Example run,</p>
<p>// start, stop, stop-start</p>
<p>1363160, 6005521463, 6004158303</p>
<p>6005554311, 12010098583, 6004544272</p>
<p>12010107912, 18013040904, 6002932992</p>
<p>18013048020, 24017295657, 6004247637</p>
<p>24017306678, 30023735547, 6006428869</p>
<p>30023751252, 36031294826, 6007543574</p>
<p>36031304510, 42037625498, 6006320988</p>
<p>42037635149, 48046499216, 6008864067</p>
<p>48046506980, 54050169260, 6003662280</p>
<p>54050174555, 60058717182, 6008542627</p>
<p>It&rsquo;s mostly copy paste of the original code. I intend to expose rdtsc function and call it from a python program.</p>
<p>[1] <a href="https://gist.github.com/quazi-irfan/3ee4789e9752bc8b3b958300157235a5" rel="nofollow ugc">https://gist.github.com/quazi-irfan/3ee4789e9752bc8b3b958300157235a5</a></p>
</div>
<ol class="children">
<li id="comment-656192" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-17T13:29:21+00:00">November 17, 2023 at 1:29 pm</time></a> </div>
<div class="comment-content">
<p>You should make sure you understand what rdtsc outputs on modern CPUs.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
