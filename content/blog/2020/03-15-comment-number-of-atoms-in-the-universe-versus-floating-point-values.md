---
date: "2020-03-15 12:00:00"
title: "Number of atoms in the universe versus floating-point values"
index: false
---

[7 thoughts on &ldquo;Number of atoms in the universe versus floating-point values&rdquo;](/lemire/blog/2020/03-15-number-of-atoms-in-the-universe-versus-floating-point-values)

<ol class="comment-list">
<li id="comment-496103" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/38ff31ad4de6130c4ae384eef31ebe59?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/38ff31ad4de6130c4ae384eef31ebe59?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Albert</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-15T22:34:29+00:00">March 15, 2020 at 10:34 pm</time></a> </div>
<div class="comment-content">
<p>An implicit assumption is that the only thing one can do with numbers is count physical objects. (Actually, that would be two assumptions, but who&rsquo;s counting?) This assumption directly contradicts my experience.<br/>
Besides, it is impossible to represent most integers in the range between 0 to 10308 with <em>float64</em>.</p>
</div>
<ol class="children">
<li id="comment-496160" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-16T00:50:05+00:00">March 16, 2020 at 12:50 am</time></a> </div>
<div class="comment-content">
<p>I did not write that binary64 was good enough for all purposes. That&rsquo;s not what I believe.</p>
</div>
</li>
</ol>
</li>
<li id="comment-496524" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/706bfc4a6f4da473b87e55776dfdf547?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/706bfc4a6f4da473b87e55776dfdf547?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Brian Kessler</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-16T20:34:29+00:00">March 16, 2020 at 8:34 pm</time></a> </div>
<div class="comment-content">
<p>I think it would be more accurate to ay you can represent the magnitude of the number of atoms in the universe. A double only has 53 bits of precision so you can’t use it to “count” that high, but you can represent the leading 53 bits (~17 decimal digits) of a number that large.</p>
<p>But yes, if you exceed the range of a double, you likely have an issue with your calculation such as poor choice of units.</p>
</div>
</li>
<li id="comment-496649" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f1af8c26a18981db6eea476031b0d7ad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f1af8c26a18981db6eea476031b0d7ad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">traski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-17T12:36:01+00:00">March 17, 2020 at 12:36 pm</time></a> </div>
<div class="comment-content">
<p>*<strong>Observable</strong> universe</p>
</div>
</li>
<li id="comment-496669" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5c0dede5080523ee4dc59672dd34ce6e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5c0dede5080523ee4dc59672dd34ce6e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marcos</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-17T18:12:29+00:00">March 17, 2020 at 6:12 pm</time></a> </div>
<div class="comment-content">
<p>Nobody will ever make a machine with 2^53 parts either, so for counting a double is enough.</p>
<p>The entire problem with floating point numbers is loss of precision on calculation. That one is a completely mathematical phenomenon, so pointing at physics is missing the point, and errors do accumulate on superlinear fashion, so that large mantissa is way less useful than it looks like.</p>
<p>There is a reason why quad-precision floats exist.</p>
</div>
<ol class="children">
<li id="comment-496672" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-17T18:45:38+00:00">March 17, 2020 at 6:45 pm</time></a> </div>
<div class="comment-content">
<p>Again: this post was not a defence of binary64 in general.</p>
</div>
</li>
</ol>
</li>
<li id="comment-496973" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2fb1d0febf487a1d0b6ece2ff02affaa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2fb1d0febf487a1d0b6ece2ff02affaa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christopher Chang</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-18T18:57:42+00:00">March 18, 2020 at 6:57 pm</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s worth noting that this rule of thumb is not true in the other direction: likelihood values between 0 and the smallest positive value representable by a double (~5 * 10^{-324}) frequently show up. This can sometimes be worked around by normalizing against the likelihood of a specific event, but library support for log-likelihoods is very valuable.</p>
</div>
</li>
</ol>
