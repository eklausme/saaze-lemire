---
date: "2018-06-19 12:00:00"
title: "Roaring Bitmaps in JavaScript"
index: false
---

[4 thoughts on &ldquo;Roaring Bitmaps in JavaScript&rdquo;](/lemire/blog/2018/06-19-roaring-bitmaps-in-javascript)

<ol class="comment-list">
<li id="comment-515304" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3e9622192e033920c6387f061ace6d1d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3e9622192e033920c6387f061ace6d1d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Dima Tisnek</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-21T02:22:59+00:00">May 21, 2020 at 2:22 am</time></a> </div>
<div class="comment-content">
<p>Maybe it&rsquo;s time to update a note on maturity of <code>wasm</code> port.</p>
</div>
<ol class="children">
<li id="comment-515327" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-21T02:36:43+00:00">May 21, 2020 at 2:36 am</time></a> </div>
<div class="comment-content">
<p>Right. This was many years ago, and the maturity is much better.</p>
</div>
</li>
</ol>
</li>
<li id="comment-595153" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/270984ba396d4bd793181115b87dc790?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/270984ba396d4bd793181115b87dc790?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Chance</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-18T19:08:30+00:00">August 18, 2021 at 7:08 pm</time></a> </div>
<div class="comment-content">
<p>Daniel, are you familiar with a roaring project that is wasm ready?<br/>
roaring-wasm hasn&rsquo;t been touched in 3 years.</p>
<p>I haven&rsquo;t done any rust development but it seems like roaring-rs would be the most likely candidate for conversion if there isn&rsquo;t one out there?</p>
</div>
<ol class="children">
<li id="comment-595188" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-18T22:42:44+00:00">August 18, 2021 at 10:42 pm</time></a> </div>
<div class="comment-content">
<p>I agree, working from the Rust version seems like a great move.</p>
</div>
</li>
</ol>
</li>
</ol>
