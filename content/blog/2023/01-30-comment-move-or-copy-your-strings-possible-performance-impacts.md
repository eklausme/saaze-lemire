---
date: "2023-01-30 12:00:00"
title: "Move or copy your strings? Possible performance impacts"
index: false
---

[7 thoughts on &ldquo;Move or copy your strings? Possible performance impacts&rdquo;](/lemire/blog/2023/01-30-move-or-copy-your-strings-possible-performance-impacts)

<ol class="comment-list">
<li id="comment-649097" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1fee087d7a1ca17c8ad348271819a8d5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1fee087d7a1ca17c8ad348271819a8d5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Antoine</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-30T18:30:22+00:00">January 30, 2023 at 6:30 pm</time></a> </div>
<div class="comment-content">
<p>&gt; But that’s not the fastest approach: the fastest approach is to just hold a pointer.</p>
<p>If you&rsquo;re only storing the string and not doing anything else with it, then perhaps. But if you frequently access the string as the same time as the rest of your existing data structure, than an additional pointer dereference might reduce cache efficiency and increase latency.</p>
<p>So, if you&rsquo;re preoccupied with the cost of that string, you should probably measure your actual use case.</p>
</div>
<ol class="children">
<li id="comment-649098" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-30T22:23:50+00:00">January 30, 2023 at 10:23 pm</time></a> </div>
<div class="comment-content">
<p>Interesting point.</p>
</div>
</li>
</ol>
</li>
<li id="comment-649100" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/40a99e4781defef73486cd362ebb5f49?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/40a99e4781defef73486cd362ebb5f49?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tim Parker</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-31T08:53:14+00:00">January 31, 2023 at 8:53 am</time></a> </div>
<div class="comment-content">
<p>Referencing the string by raw pointer is efficient on the initial copy but realistically only has downsides after that e.g.<br/>
* Lifetime guarantees/invariants of the original string<br/>
* Null pointer checks in all accessor/calling code<br/>
* Memory locality and cache behaviour (as already pointed out)</p>
<p>&#8230;so a judgment call would need to be made on the use expectations as Antoine mentioned.</p>
</div>
</li>
<li id="comment-649233" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-12T07:22:28+00:00">February 12, 2023 at 7:22 am</time></a> </div>
<div class="comment-content">
<p>First, almost a nit. The &ldquo;outdata&rdquo; is reused once, so perhaps not the same. I did see a change when block-scoping &ldquo;outdata&rdquo;.</p>
<p><code>$ ./build/b0<br/>
short strings:<br/>
5.09394 **1.63144** 0.405696 0.60292<br/>
long strings:<br/>
13.0458 **2.9494** 0.384981 1.36331<br/>
</code></p>
<p>Run with &ldquo;outdata&rdquo; virgin for both tests.</p>
<p><code>$ ./build/b0<br/>
short strings:<br/>
5.21159 **1.46637** 0.344897 0.573364<br/>
long strings:<br/>
13.6949 **1.62891** 0.351345 0.788565<br/>
</code></p>
</div>
</li>
<li id="comment-649288" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-15T19:36:23+00:00">February 15, 2023 at 7:36 pm</time></a> </div>
<div class="comment-content">
<p>Had some free time, so played around with benchmarking C-with-classes style strings.<br/>
<a href="https://github.com/pbannister/C-with-classes" rel="nofollow ugc">C-with-classes string benchmark on Github</a></p>
<p>Seems that <strong>std::string</strong> improved dramatically at some point?</p>
</div>
<ol class="children">
<li id="comment-649289" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-15T19:57:00+00:00">February 15, 2023 at 7:57 pm</time></a> </div>
<div class="comment-content">
<p>Your link is not working (private content?).</p>
<p>One powerful trick that std::string relies upon are short-string optimization, whereas short strings are stored directly in the string object itself, therefore avoiding any kind of heap allocation.</p>
</div>
<ol class="children">
<li id="comment-649290" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-15T20:02:54+00:00">February 15, 2023 at 8:02 pm</time></a> </div>
<div class="comment-content">
<p>Yep, was private, and is now public.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
