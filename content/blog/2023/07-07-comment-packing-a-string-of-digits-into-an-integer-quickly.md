---
date: "2023-07-07 12:00:00"
title: "Packing a string of digits into an integer quickly"
index: false
---

[5 thoughts on &ldquo;Packing a string of digits into an integer quickly&rdquo;](/lemire/blog/2023/07-07-packing-a-string-of-digits-into-an-integer-quickly)

<ol class="comment-list">
<li id="comment-652811" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/88c61a0dceed259d3922177cef68898c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/88c61a0dceed259d3922177cef68898c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://github.com/costin" class="url" rel="ugc external nofollow">Costin</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-07T18:02:11+00:00">July 7, 2023 at 6:02 pm</time></a> </div>
<div class="comment-content">
<p>Small typo:<br/>
&ldquo;Recent Intel processors have performance on par with Intel&rdquo;<br/>
should be Recent AMD (or Zen) processors have performance&#8230;</p>
</div>
</li>
<li id="comment-652824" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/77616392012639d743a0e9a05563ddbd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/77616392012639d743a0e9a05563ddbd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">jerch</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-08T09:53:44+00:00">July 8, 2023 at 9:53 am</time></a> </div>
<div class="comment-content">
<p>(offtopic)</p>
<p>I wonder if there is a really fast SIMD-based calculation possible for itoa, maybe something along bitfield multiplication and pext extraction steps. Had to deal with it recently and was quite surprised, how hard the binary number to decimal digits conversion still is.</p>
<p>@Lemire Do you happen to have dealt with that in the past, or have some good pointers? Sorry if I overlooked it.</p>
</div>
<ol class="children">
<li id="comment-652831" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-08T18:44:25+00:00">July 8, 2023 at 6:44 pm</time></a> </div>
<div class="comment-content">
<p>You may like&#8230;<br/>
<a href="https://lemire.me/blog/2021/11/18/converting-integers-to-fix-digit-representations-quickly/" rel="ugc">Converting integers to fix-digit representations quickly</a></p>
</div>
<ol class="children">
<li id="comment-652860" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/77616392012639d743a0e9a05563ddbd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/77616392012639d743a0e9a05563ddbd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">jerch</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-10T08:05:17+00:00">July 10, 2023 at 8:05 am</time></a> </div>
<div class="comment-content">
<p>Many thanks you for the link. At a first glance it seems that I also went with the small table approach (2 digits lookup after divmod 100). Will see if I can get that somewhat faster without going into big table realms.</p>
</div>
</li>
</ol>
</li>
<li id="comment-652841" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1ed3c49378b2eb71ddba7fa3760abf5e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1ed3c49378b2eb71ddba7fa3760abf5e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://clickhouse.com/" class="url" rel="ugc external nofollow">Alexey Milovidov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-09T04:00:44+00:00">July 9, 2023 at 4:00 am</time></a> </div>
<div class="comment-content">
<p>Here is the optimized implementation from ClickHouse:<br/>
<a href="https://github.com/ClickHouse/ClickHouse/blob/master/base/base/itoa.h" rel="nofollow ugc">https://github.com/ClickHouse/ClickHouse/blob/master/base/base/itoa.h</a></p>
<p>No SIMD there, though.</p>
</div>
</li>
</ol>
</li>
</ol>
