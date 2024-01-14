---
date: "2012-09-03 12:00:00"
title: "Your programming language does not know about elementary mathematics"
index: false
---

[7 thoughts on &ldquo;Your programming language does not know about elementary mathematics&rdquo;](/lemire/blog/2012/09-03-programming-elementary-mathematics)

<ol class="comment-list">
<li id="comment-55550" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3d1877e21c369bc5870dbf262a3e3948?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3d1877e21c369bc5870dbf262a3e3948?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Anon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-09-03T14:57:20+00:00">September 3, 2012 at 2:57 pm</time></a> </div>
<div class="comment-content">
<p>Old news:</p>
<p>What Every Computer Scientist Should Know About Floating-Point Arithmetic</p>
<p><a href="http://docs.oracle.com/cd/E19957-01/806-3568/ncg_goldberg.html" rel="nofollow ugc">http://docs.oracle.com/cd/E19957-01/806-3568/ncg_goldberg.html</a></p>
</div>
</li>
<li id="comment-55551" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/78766c5ec70381185e2cc14264f43c5e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/78766c5ec70381185e2cc14264f43c5e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Stefano Miccoli</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-09-03T15:59:30+00:00">September 3, 2012 at 3:59 pm</time></a> </div>
<div class="comment-content">
<p>Giving a theory a sound axiomatic structure is an hard job: ask Euclid, Peano, Hilbert&#8230;</p>
<p>The same is true for designing consistent and efficient finite precision arithmetic systems, both for human and machine computers! (Long before the introduction of computing machines, approximate numerical calculations were performed by great scientists like Gauss.)</p>
<p>While naive mapping between exact number theory and finite precision arithmetic may give paradoxical results, there is much more than &ldquo;organically grown compromises&rdquo; in the specification and implementation of let say IEEE 754 floating point arithmetic. </p>
<p>In fact as much as an axiomatic system is the end point of a long and complex evolution (with errors, corrections, changes of perspective) so the main driving force in the present day deployment of computer arithmetic is a profound and mathematically sound understanding of finite precision calculations.</p>
</div>
</li>
<li id="comment-55552" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-09-03T16:43:42+00:00">September 3, 2012 at 4:43 pm</time></a> </div>
<div class="comment-content">
<p>@Stefano</p>
<p>There is a good reason why floating point numbers are not reflexive, but it is still a compromise. They were very concerned with performance, for example.</p>
</div>
</li>
<li id="comment-55553" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3d1877e21c369bc5870dbf262a3e3948?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3d1877e21c369bc5870dbf262a3e3948?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-09-03T17:06:14+00:00">September 3, 2012 at 5:06 pm</time></a> </div>
<div class="comment-content">
<p>&gt; There is a good reason why floating point numbers are not reflexive, but it is still a compromise. They were very concerned with performance, for example.</p>
<p>Nope. Not performance. The lack of reflectivity comes directly from the fact that a base-2 number system (floating point numbers in most conventional computers are base-2) with limited precision can not accurately represent all possible fractional base-10 number values. </p>
<p>Just as base-10 can not accurately represent the fraction 1/3, base-2 is worse. Any fractional value which does not have 2 as the only prime factor of the denominator is an infinitely repeating base-2 value (<a href="https://en.wikipedia.org/wiki/Binary_numeral_system#Fractions_in_binary" rel="nofollow ugc">http://en.wikipedia.org/wiki/Binary_numeral_system#Fractions_in_binary</a>). And just as .3333 is an approximation in base-10 of 1/3, 0.000110011 in base-2 is only an approximation of 1/10.</p>
<p>When combined with a finite size representation (usually 32 or 64 or 128 bits) any fractional value which is actually a repeating base-2 value is approximated by floating point. It is this approximation that results in the lack of reflexivity.</p>
</div>
</li>
<li id="comment-55554" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-09-03T17:26:31+00:00">September 3, 2012 at 5:26 pm</time></a> </div>
<div class="comment-content">
<p>@Anon </p>
<p>I disagree.</p>
<p>(1) Only NaN has the property that it is different from itself. The number 0.000110011 in base 2 is equal to itself. </p>
<p>Formally, you do not need the number NaN. The software could simply bail out and throw an exception instead of using NaN. This would introduce compulsory branching throughout and be a bit bad&#8230; though we could probably optimize some of the cost away given enough work.</p>
<p>(2) Arbitrary precision real number arithmetic is indeed possible. Symbolic algebra system have been doing for decades. But you won&rsquo;t be crunching billions of numbers per second using those.</p>
<p>There is nothing very hard in programming a computer to keep track of 1/10, it is just hard to do it fast.</p>
<p>(3) The problems I pointed out in my blog post have nothing to do with representing all possible fractional base-10 number values. Indeed, I do not even use fractions.</p>
</div>
</li>
<li id="comment-55565" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2e30146f7d72648fc21f1a532f06c78e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2e30146f7d72648fc21f1a532f06c78e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Darek NÄ™dza</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-09-04T11:44:10+00:00">September 4, 2012 at 11:44 am</time></a> </div>
<div class="comment-content">
<p>I think failure in this 3 rules is not big problem. The main problem is that programming language&rsquo;s creators deals with this problem in different way than you may think. For example, 2+3*4 can be solved as 2+(3*4) but creator may do this in this way: (2+3)*4.<br/>
And what is worse each creators can define his own method of solving one particular problem and can results in different results. Even in one PL you can achieve 2 different results. Some time ago I have been trying some haskell&rsquo;s tutorial. They have showed how to make this table: [1.0,1.2,1.4,1.6,1.8,2.0]. In normal way: [1.0,1.2..2.0] gives you this: [1.0,1.2,1.4,1.5999999999999999,1.7999999999999998,1.9999999999999998]. Other method I have worked up is: map (/10) [10,12..20] which gives proper results.<br/>
ps. This post is very interesting post. There isn&rsquo;t to much blogs about this topics.</p>
</div>
</li>
<li id="comment-55568" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1f02b46eac3c7b3950d861570b08422a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1f02b46eac3c7b3950d861570b08422a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://redantliberationarmy.wordpress.com/" class="url" rel="ugc external nofollow">B.J. Murphy</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-09-04T19:38:49+00:00">September 4, 2012 at 7:38 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;We used to think that if we knew one, we knew two, because one and one are two. We are finding that we must learn a great deal more about &lsquo;and&rsquo;.&rdquo;</p>
<p>&#8211;Sir Arthur Eddington, The Harvest of a Quiet Eye</p>
</div>
</li>
</ol>
