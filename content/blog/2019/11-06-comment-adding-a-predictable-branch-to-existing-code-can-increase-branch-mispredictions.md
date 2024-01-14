---
date: "2019-11-06 12:00:00"
title: "Adding a (predictable) branch to existing code can increase branch mispredictions"
index: false
---

[5 thoughts on &ldquo;Adding a (predictable) branch to existing code can increase branch mispredictions&rdquo;](/lemire/blog/2019/11-06-adding-a-predictable-branch-to-existing-code-can-increase-branch-mispredictions)

<ol class="comment-list">
<li id="comment-439583" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dde75d10e9c2535f324af2c717f52b67?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dde75d10e9c2535f324af2c717f52b67?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Jesse Jenkins</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-06T18:10:13+00:00">November 6, 2019 at 6:10 pm</time></a> </div>
<div class="comment-content">
<p>How did you measure the predicts/mispredicts?</p>
</div>
<ol class="children">
<li id="comment-439584" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-06T18:18:59+00:00">November 6, 2019 at 6:18 pm</time></a> </div>
<div class="comment-content">
<p>Using the processor&rsquo;s counters.</p>
</div>
</li>
</ol>
</li>
<li id="comment-439782" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ba27f89768c0aec50c898b1fe9b4b780?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ba27f89768c0aec50c898b1fe9b4b780?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mike G.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-07T19:32:46+00:00">November 7, 2019 at 7:32 pm</time></a> </div>
<div class="comment-content">
<p>Wow that&rsquo;s a low baseline mispredict rate on Intel.</p>
<p>Does that rng function result in an easily predictable even/odd pattern?</p>
</div>
<ol class="children">
<li id="comment-439823" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-07T21:23:41+00:00">November 7, 2019 at 9:23 pm</time></a> </div>
<div class="comment-content">
<p>What matters is that these are always the same pseudo-random integers from run to run.</p>
</div>
</li>
</ol>
</li>
<li id="comment-440343" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-08T22:03:42+00:00">November 8, 2019 at 10:03 pm</time></a> </div>
<div class="comment-content">
<p>Yes this is kind of obvious since adding the 3rd branch adds useless entries in the branch history, reducing its effective length and thus the number of unique patterns it can remember.</p>
<p>Unrolling it 4x or 8x will have the opposite effect since it removes the always taken loop branch which has the same effect.</p>
</div>
</li>
</ol>
