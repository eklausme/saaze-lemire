---
date: "2008-07-07 12:00:00"
title: "Sorting 1 terabyte in 209 seconds"
index: false
---

[2 thoughts on &ldquo;Sorting 1 terabyte in 209 seconds&rdquo;](/lemire/blog/2008/07-07-sorting-1-terabyte-in-209-seconds)

<ol class="comment-list">
<li id="comment-50007" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Kevembuangga</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-07-09T14:29:45+00:00">July 9, 2008 at 2:29 pm</time></a> </div>
<div class="comment-content">
<p>The Terabyte sort seem pretty silly, of course throwing a shitload of ressources at a problem is bound to give &ldquo;impressive results&rdquo; but where is the benefit for the average user?<br/>
i.e your 6000 seconds sort.<br/>
This looks like the Formula 1 racing which is supposed to further technological progress and which does once in a while, but at which cost?<br/>
The Penny sort on the same page seem more sensible.<br/>
BTW, from experience with my linear sort the 6000 seconds you report for 2Gb fall within plausible range of elapsed time due to disk access latency when sorted records are shuffled around, <b>not</b> a compute bound limit, you might check it.</p>
</div>
</li>
<li id="comment-50008" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-07-09T17:29:47+00:00">July 9, 2008 at 5:29 pm</time></a> </div>
<div class="comment-content">
<p>The 6000 seconds is definitively not &ldquo;internal memory&rdquo; since the whole machine has 2 GiB of RAM and it tries to sort 2 GiB of data. So there is quite a bit of IO overhead. Sure.</p>
</div>
</li>
</ol>
