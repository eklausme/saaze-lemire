---
date: "2022-07-20 12:00:00"
title: "How quickly can you convert floats to doubles (and back)?"
index: false
---

[5 thoughts on &ldquo;How quickly can you convert floats to doubles (and back)?&rdquo;](/lemire/blog/2022/07-20-how-quickly-can-you-convert-floats-to-doubles-and-back)

<ol class="comment-list">
<li id="comment-640166" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a16c77f11bbe59a0a9c4dc7398e1de99?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a16c77f11bbe59a0a9c4dc7398e1de99?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Alexander</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-20T20:09:44+00:00">July 20, 2022 at 8:09 pm</time></a> </div>
<div class="comment-content">
<p>Hello.<br/>
Can you explain why you are creating a random number generator and don&rsquo;t use it. But filling the array with increasing values?</p>
</div>
<ol class="children">
<li id="comment-640185" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-20T20:32:35+00:00">July 20, 2022 at 8:32 pm</time></a> </div>
<div class="comment-content">
<p>It is dead code that I used at first but that I am no longer using. You don&rsquo;t need the random generator because the conversion is not data dependent.</p>
</div>
</li>
</ol>
</li>
<li id="comment-640442" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.joseduarte.com" class="url" rel="ugc external nofollow">Joe Duarte</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-22T16:27:15+00:00">July 22, 2022 at 4:27 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel – Why is the latency 3-4 cycles if one conversion takes one cycle? What is latency here? You&rsquo;re using 1 cycle/conversion in your throughput estimates, so is the latency a one-time thing?</p>
</div>
<ol class="children">
<li id="comment-640445" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-22T17:35:38+00:00">July 22, 2022 at 5:35 pm</time></a> </div>
<div class="comment-content">
<p>I did not write that the conversion took one cycle, I wrote that one number could be converted per cycle. Our processors are superscalar: they can execute many instructions at once.</p>
</div>
<ol class="children">
<li id="comment-640446" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-22T17:39:48+00:00">July 22, 2022 at 5:39 pm</time></a> </div>
<div class="comment-content">
<p>In fact, the M1 processor in my Apple laptop can sustain 8 instructions per cycle.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
