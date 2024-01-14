---
date: "2022-07-24 12:00:00"
title: "Round a direction vector to an 8-way compass"
index: false
---

[12 thoughts on &ldquo;Round a direction vector to an 8-way compass&rdquo;](/lemire/blog/2022/07-24-round-a-direction-vector-to-the-nearest-8-way-compass)

<ol class="comment-list">
<li id="comment-640813" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d081923c9998bd094289a54a0ee1045b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d081923c9998bd094289a54a0ee1045b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">The 8th mage</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-25T00:06:56+00:00">July 25, 2022 at 12:06 am</time></a> </div>
<div class="comment-content">
<p>1. Cos(atan(x)) has a nice identity as 1/sqrt(x^2+1), while sin is x/sqrt(x^2+1). What about implementing it that way? In this way you have a branch less solution which can be vectorized (although your scenario suggests there&rsquo;s only one vector). </p>
<p>2. it seems to me that you don&rsquo;t normalize the input vector. is the input circle in the unit disk? What happens if both x and y are lower than cos(3pi/8) then the vector will be zero, and you have the dead zone dependent on your rouding. If you assume the unit disk, can some of the branches be filded together in that scenario?</p>
</div>
<ol class="children">
<li id="comment-640814" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-25T00:21:46+00:00">July 25, 2022 at 12:21 am</time></a> </div>
<div class="comment-content">
<p><em>In this way you have a branch less solution which can be vectorized</em></p>
<p>My version can be compiled to branchless code and is vectorizable.</p>
<p><em> it seems to me that you don’t normalize the input vector.</em></p>
<p>We are assuming here that the direction vector has been normalized (it is a &lsquo;unit&rsquo; direction vector).</p>
<p><em>If you assume the unit disk, can some of the branches be filded together in that scenario?</em></p>
<p>You can rewrite the the logic to have fewer apparent branches, but all my branches are subject to becoming mere selection (condition moves).</p>
<p>I certainly do not claim that my code is the most efficient possible. In fact, I am sure you can do better !!!</p>
</div>
</li>
</ol>
</li>
<li id="comment-640844" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c98e795ed14daeb06ac7f311793bb52a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c98e795ed14daeb06ac7f311793bb52a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Pierre B.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-25T15:16:05+00:00">July 25, 2022 at 3:16 pm</time></a> </div>
<div class="comment-content">
<p>The original code could avoid both sin and cos by computing as value between 0 and 7 and a switch with hard-coded values. Your code would still be faster vy avoiding atan2, but by a lesser factor.</p>
</div>
<ol class="children">
<li id="comment-640859" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/edc3dc63c3d52f43af6ad8bddc04d8c2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/edc3dc63c3d52f43af6ad8bddc04d8c2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Lorin K.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-25T21:40:08+00:00">July 25, 2022 at 9:40 pm</time></a> </div>
<div class="comment-content">
<p>Remove the if, instead use a ternary operator and then we get branchless code when using clang.<br/>
Funny that Clang only successfully goes branchless when using ternary operator instead of if.</p>
<p><a href="https://godbolt.org/z/so5hhqvMo" rel="nofollow ugc">https://godbolt.org/z/so5hhqvMo</a></p>
</div>
<ol class="children">
<li id="comment-640861" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-25T22:13:43+00:00">July 25, 2022 at 10:13 pm</time></a> </div>
<div class="comment-content">
<p>Correct.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-641005" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/949132549f3bb51cdb7db02600b96b4f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/949132549f3bb51cdb7db02600b96b4f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Grisha</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-27T15:09:40+00:00">July 27, 2022 at 3:09 pm</time></a> </div>
<div class="comment-content">
<p>I am sorry, I didn&rsquo;t get it. Why do you need four comparisons in the first snippet? I think two are enough.</p>
</div>
<ol class="children">
<li id="comment-641010" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-27T16:28:58+00:00">July 27, 2022 at 4:28 pm</time></a> </div>
<div class="comment-content">
<p><em>Why do you need four comparisons in the first snippet? I think two are enough.</em></p>
<p>I do not need four, I use four. You are correct that two are sufficient. However, we want to entice the compiler to produce branchless code.</p>
<p>Branchless code may not be faster in absolute terms, but it is has consistent (fixed) performance.</p>
</div>
<ol class="children">
<li id="comment-642996" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/40a99e4781defef73486cd362ebb5f49?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/40a99e4781defef73486cd362ebb5f49?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tim Parker</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-14T09:24:21+00:00">August 14, 2022 at 9:24 am</time></a> </div>
<div class="comment-content">
<p>Putting your &lsquo;branch&rsquo; results into a two element vector, and casting the (single evaluation) of the comparison to bool() as an index, is also a technique used to more forcibly result in branch-less coding, with a little less reliance on the compiler. Almost certainly not a issue with this small, localised, example but may be useful when you truly want to remove branches.</p>
</div>
<ol class="children">
<li id="comment-643021" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-14T15:19:08+00:00">August 14, 2022 at 3:19 pm</time></a> </div>
<div class="comment-content">
<p>At least under GCC, the compiled result may be that you move the two values to the stack and then load back the desired value from the stack. It is significantly more inefficient that a conditional move.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-641117" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5b398936012c5ab568223ef64750d802?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5b398936012c5ab568223ef64750d802?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Samuel Lee</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-28T15:15:16+00:00">July 28, 2022 at 3:15 pm</time></a> </div>
<div class="comment-content">
<p>Heads up that in the latest version of your code/the post you seem to have lost the sin(PI/8) constant.</p>
<p>A had a couple of thoughts on this just getting around to tidying.<br/>
1) Handling the making the doubles positive for comparison before making putting the sign back can be achieved more efficiently with the use of fabs and copysign:<br/>
<a href="https://godbolt.org/z/aebx9b48a" rel="nofollow ugc">https://godbolt.org/z/aebx9b48a</a><br/>
This should clearly work and give a modest uplift.</p>
<p>2) You actually don&rsquo;t need to be using floating point at all for this, and possibly can get much better speed using uint64_ts to perform the logic. You can even avoid using flags 🙂 :<br/>
<a href="https://godbolt.org/z/Yxq3o7hnc" rel="nofollow ugc">https://godbolt.org/z/Yxq3o7hnc</a><br/>
I have not tested this code at all, but I think it should work (assuming you have well-formed inputs &#8211; obviously doesn&rsquo;t handle NaNs for example).</p>
</div>
<ol class="children">
<li id="comment-641119" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5b398936012c5ab568223ef64750d802?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5b398936012c5ab568223ef64750d802?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Samuel Lee</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-28T15:32:12+00:00">July 28, 2022 at 3:32 pm</time></a> </div>
<div class="comment-content">
<p>Ah, just read the new code more closely, and understand the change to remove the sin(PI/8) constant &#8211; nice! The same could apply to my suggestions</p>
</div>
</li>
<li id="comment-641136" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-28T17:42:04+00:00">July 28, 2022 at 5:42 pm</time></a> </div>
<div class="comment-content">
<p>Congratulations, you have the fastest approach. It is under 1 ns on my laptop! I estimate it is about 2.5 cycles per conversion&#8230; </p>
<p>I agree that you can almost surely do it without using floats but it could be going too far down the rabbit hole.</p>
</div>
</li>
</ol>
</li>
</ol>
