---
date: "2017-05-09 12:00:00"
title: "Signed integer division by a power of two can be expensive!"
index: false
---

[6 thoughts on &ldquo;Signed integer division by a power of two can be expensive!&rdquo;](/lemire/blog/2017/05-09-signed-integer-division-by-a-power-of-two-can-be-expensive)

<ol class="comment-list">
<li id="comment-279492" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ecb5b4801bc4b316431b30da9cd6ee53?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ecb5b4801bc4b316431b30da9cd6ee53?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Yoav</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-09T17:05:23+00:00">May 9, 2017 at 5:05 pm</time></a> </div>
<div class="comment-content">
<p>Performance aside, the way you calculated middleIndex (both versions) is buggy (<a href="https://research.googleblog.com/2006/06/extra-extra-read-all-about-it-nearly.html" rel="nofollow ugc">https://research.googleblog.com/2006/06/extra-extra-read-all-about-it-nearly.html</a>).</p>
</div>
<ol class="children">
<li id="comment-279494" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-09T17:26:45+00:00">May 9, 2017 at 5:26 pm</time></a> </div>
<div class="comment-content">
<p>Sure, though if you have arrays spanning 4GB of memory, you probably have other problems to worry about.</p>
</div>
</li>
<li id="comment-279529" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/575869bc1cf09af66d0b7c2ba9fe149a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/575869bc1cf09af66d0b7c2ba9fe149a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.cs.ru.nl/~arjen/" class="url" rel="ugc external nofollow">Arjen</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-10T08:35:53+00:00">May 10, 2017 at 8:35 am</time></a> </div>
<div class="comment-content">
<p>That is a nice pointer, but the &gt;&gt;&gt; should be right, actually!<br/>
<a href="http://stackoverflow.com/a/19058871/2127435" rel="nofollow ugc">http://stackoverflow.com/a/19058871/2127435</a></p>
</div>
</li>
<li id="comment-279584" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4498276b0ee7ff747881d6566b36cca5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4498276b0ee7ff747881d6566b36cca5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/xfix" class="url" rel="ugc external nofollow">Konrad Borowski</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-11T06:15:19+00:00">May 11, 2017 at 6:15 am</time></a> </div>
<div class="comment-content">
<p>The page you are linking even says that &gt;&gt;&gt; 1 is one of methods to fix it.</p>
</div>
</li>
</ol>
</li>
<li id="comment-279521" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c0df029eecc064d2fb64e5be52b06972?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c0df029eecc064d2fb64e5be52b06972?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alessandro</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-10T05:05:31+00:00">May 10, 2017 at 5:05 am</time></a> </div>
<div class="comment-content">
<p>Keep in mind that signed right shift are implementation dependent in C! (And signed left shifts are in general undefined). You should put in place compile time checks when using them.</p>
</div>
</li>
<li id="comment-284313" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/42b2ee5de35930cf9a8fbc5499768b1d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/42b2ee5de35930cf9a8fbc5499768b1d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">lyrachord</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-18T16:54:54+00:00">August 18, 2017 at 4:54 pm</time></a> </div>
<div class="comment-content">
<p>My benchmark result:<br/>
# JMH version: 1.19<br/>
# VM version: JDK 1.8.0_144, VM 25.144-b01<br/>
# VM invoker: C:\work\JDK8\jre\bin\java.exe<br/>
# VM options: </p>
<p>Benchmark Mode Cnt Score Error Units<br/>
IntBinarySearch.SequentialSearch thrpt 5 49816.892 Â± 579.960 ops/s<br/>
IntBinarySearch.branchlessBinarySearch thrpt 5 587342.727 Â± 21659.254 ops/s<br/>
IntBinarySearch.branchyBinarySearch thrpt 5 1000197.755 Â± 40677.488 ops/s<br/>
IntBinarySearch.branchyBinarySearchWithDivision thrpt 5 856292.173 Â± 56034.160 ops/s<br/>
IntBinarySearch.standardBinarySearch thrpt 5 1019794.676 Â± 19766.743 ops/s</p>
</div>
</li>
</ol>
