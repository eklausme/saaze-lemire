---
date: "2022-09-30 12:00:00"
title: "A review of elementary data types : numbers and strings"
index: false
---

[12 thoughts on &ldquo;A review of elementary data types : numbers and strings&rdquo;](/lemire/blog/2022/09-30-a-review-of-elementary-data-types-numbers-and-strings)

<ol class="comment-list">
<li id="comment-646180" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a6d8825d696f4922955bd31d496d6b87?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a6d8825d696f4922955bd31d496d6b87?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Some Person</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-10-01T12:11:35+00:00">October 1, 2022 at 12:11 pm</time></a> </div>
<div class="comment-content">
<p>Typo: “We may also use the hexadecimal (base 16) notation with the 0x prefix: in that case, we use 16 different digits in the list 0, 1, 2, 3,&#8230;, 9, A, B, C, D, E, F. These digits have values 0, 1, 2, 3,&#8230;, 9, 10, 11, 12, 13, 14, 16”</p>
<p>As you well know, that “16” should be “15”.</p>
</div>
<ol class="children">
<li id="comment-646219" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-10-03T16:19:06+00:00">October 3, 2022 at 4:19 pm</time></a> </div>
<div class="comment-content">
<p>Thanks.</p>
</div>
</li>
<li id="comment-646329" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fc6ad13b3fd38bc75a0fea2884883211?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fc6ad13b3fd38bc75a0fea2884883211?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Manish Kumar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-10-09T15:06:38+00:00">October 9, 2022 at 3:06 pm</time></a> </div>
<div class="comment-content">
<p>-513 should not it be -3*256+255, so it would map to 255</p>
</div>
<ol class="children">
<li id="comment-646436" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-10-12T13:18:48+00:00">October 12, 2022 at 1:18 pm</time></a> </div>
<div class="comment-content">
<p>Thanks.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-646214" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d961a4c2af6ed489db206e6e41a7dd90?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d961a4c2af6ed489db206e6e41a7dd90?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">alexey</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-10-03T10:53:25+00:00">October 3, 2022 at 10:53 am</time></a> </div>
<div class="comment-content">
<p>could you please change &ldquo;As 256-bit integers, they are mapped to&rdquo; to either &ldquo;as 256-modulo integers&rdquo; or &ldquo;8-bit integers&rdquo;?</p>
</div>
<ol class="children">
<li id="comment-646218" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-10-03T16:18:59+00:00">October 3, 2022 at 4:18 pm</time></a> </div>
<div class="comment-content">
<p>Correct. Thanks.</p>
</div>
</li>
</ol>
</li>
<li id="comment-646292" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/40e891bdd2c6212a26300e9ea91d5efd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/40e891bdd2c6212a26300e9ea91d5efd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">mz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-10-07T13:44:06+00:00">October 7, 2022 at 1:44 pm</time></a> </div>
<div class="comment-content">
<p>Typo : &ldquo;The UTF-16 format can represent all characters, except for the supplemental characters such as emojis, using **two** bytes&rdquo;</p>
<p>it should be &ldquo;four&rdquo; instead of &ldquo;two&rdquo;</p>
</div>
<ol class="children">
<li id="comment-646295" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-10-07T14:00:38+00:00">October 7, 2022 at 2:00 pm</time></a> </div>
<div class="comment-content">
<p>It is indeed two, there is no error.</p>
</div>
</li>
</ol>
</li>
<li id="comment-646293" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/40e891bdd2c6212a26300e9ea91d5efd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/40e891bdd2c6212a26300e9ea91d5efd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">mz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-10-07T13:49:53+00:00">October 7, 2022 at 1:49 pm</time></a> </div>
<div class="comment-content">
<p>Typo : &ldquo;For example, the bitwise AND between 0b101 and 0b1100 is 0b100. The bitwise OR is **0b1111**. The bitwise XOR (exclusive OR) is 0b1001.&rdquo;</p>
<p>It should be &ldquo;0b1101&rdquo; instead of &ldquo;0b1111&rdquo;</p>
</div>
<ol class="children">
<li id="comment-646297" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-10-07T14:02:27+00:00">October 7, 2022 at 2:02 pm</time></a> </div>
<div class="comment-content">
<p>Thank you.</p>
</div>
</li>
</ol>
</li>
<li id="comment-646294" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/40e891bdd2c6212a26300e9ea91d5efd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/40e891bdd2c6212a26300e9ea91d5efd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">mz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-10-07T13:53:13+00:00">October 7, 2022 at 1:53 pm</time></a> </div>
<div class="comment-content">
<p>Typo : &ldquo;For example, 17 is 0b10001. Multiplying it by 4, we get 0b1000100 or 68. If we were to multiply **17** by 4, we would get 0b100010000 or, as an 8-bit integer, 0b10000. That is, as 8-bit unsigned integers, we have that 17 * 16 is 16. Thus we have that 17 * 16 == 1 * 16.&rdquo;</p>
<p>It should be &ldquo;68&rdquo; instead of &ldquo;17&rdquo; between asterisks</p>
</div>
<ol class="children">
<li id="comment-646296" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-10-07T14:00:45+00:00">October 7, 2022 at 2:00 pm</time></a> </div>
<div class="comment-content">
<p>Thanks.</p>
</div>
</li>
</ol>
</li>
</ol>
