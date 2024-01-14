---
date: "2017-02-06 12:00:00"
title: "Sorting sorted arrays in Swift"
index: false
---

[2 thoughts on &ldquo;Sorting sorted arrays in Swift&rdquo;](/lemire/blog/2017/02-06-sorting-sorted-arrays-in-swift)

<ol class="comment-list">
<li id="comment-270058" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://zeuxcg.org" class="url" rel="ugc external nofollow">Arseny Kapoulkine</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-07T05:04:55+00:00">February 7, 2017 at 5:04 am</time></a> </div>
<div class="comment-content">
<p>I am not sure I&rsquo;m looking at the right source code, but this looks like a median-of-3:</p>
<p><a href="https://github.com/apple/swift/blob/master/stdlib/public/core/Sort.swift.gyb#L166-L172" rel="nofollow ugc">https://github.com/apple/swift/blob/master/stdlib/public/core/Sort.swift.gyb#L166-L172</a></p>
</div>
<ol class="children">
<li id="comment-270083" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3bf2a6dfd289ef500e63e59b512ae850?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3bf2a6dfd289ef500e63e59b512ae850?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Oscar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-07T10:38:32+00:00">February 7, 2017 at 10:38 am</time></a> </div>
<div class="comment-content">
<p>Yes, looks like this was fixed in <a href="https://github.com/apple/swift/commit/606bf83af393cdde2ff4de419e833de77226e90f" rel="nofollow ugc">https://github.com/apple/swift/commit/606bf83af393cdde2ff4de419e833de77226e90f</a></p>
</div>
</li>
</ol>
</li>
</ol>
