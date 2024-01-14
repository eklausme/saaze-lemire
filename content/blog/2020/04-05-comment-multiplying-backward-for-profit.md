---
date: "2020-04-05 12:00:00"
title: "Multiplying backward for profit"
index: false
---

[8 thoughts on &ldquo;Multiplying backward for profit&rdquo;](/lemire/blog/2020/04-05-multiplying-backward-for-profit)

<ol class="comment-list">
<li id="comment-499799" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e0e67c4608abbd54cbfc9af55e60ce17?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e0e67c4608abbd54cbfc9af55e60ce17?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.ekee.io" class="url" rel="ugc external nofollow">Alexandre Bernard</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-06T04:30:25+00:00">April 6, 2020 at 4:30 am</time></a> </div>
<div class="comment-content">
<p>Very interesting, thank you for the article ! I wonder if any of the bignum library every thought about this&#8230;</p>
</div>
<ol class="children">
<li id="comment-499959" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-06T15:12:12+00:00">April 6, 2020 at 3:12 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;d be interested in knowing the answer to this question&#8230; 🙂 I have looked at the usual suspects and found nothing.</p>
</div>
</li>
</ol>
</li>
<li id="comment-499981" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/KWillets/" class="url" rel="ugc external nofollow">KWillets</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-06T18:16:09+00:00">April 6, 2020 at 6:16 pm</time></a> </div>
<div class="comment-content">
<p>This is the same thing that I was doing last summer <a href="https://github.com/KWillets/range_generator/blob/master/include/range_generator.hpp#L189" rel="nofollow ugc">here</a> when I was fiddling with your range generator. The multiplication stops when a carry into the bits of interest is no longer possible; I ended up writing it as a tail-recursive carry() function.</p>
<p>I haven&rsquo;t read your code fully, but it looks like your gate on the carry flag is the same; I golfed it down to (x + w &lt; x) to cover the possibility of [-1,w-1] in the continued multiplication.</p>
<p>At the time I wrote this I didn&rsquo;t notice any algorithms that do the same, but I don&rsquo;t know much about numerics.</p>
</div>
<ol class="children">
<li id="comment-499985" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-06T18:37:05+00:00">April 6, 2020 at 6:37 pm</time></a> </div>
<div class="comment-content">
<p>Interesting. I was aware of your code, but I don&rsquo;t think I ever noticed that it is what you were doing.</p>
</div>
<ol class="children">
<li id="comment-499990" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/KWillets/" class="url" rel="ugc external nofollow">KWillets</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-06T19:05:59+00:00">April 6, 2020 at 7:05 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s&#8230;understandable.</p>
<p>It started as a finite extension of your modulo-and-discard to see if I could put off the modulo more; then I realized that extending the multiplication indefinitely was simpler in some ways.</p>
<p>Mysteriously, the range generation solutions all seemed to center on checking the [0,w) range, even your discard method. Backwards multiplication also requires looking for -1 which can carry from further right, but one addition and a CF check cover both cases.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-500107" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/706bfc4a6f4da473b87e55776dfdf547?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/706bfc4a6f4da473b87e55776dfdf547?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Brian Kessler</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-07T02:07:57+00:00">April 7, 2020 at 2:07 am</time></a> </div>
<div class="comment-content">
<p>This problem comes up in multi precision floating point multiplication where it is called the “short product”. MPFR uses a method similar to yours for small sizes (called “naive” in their docs) and a divide and conquer method due to Mulders for larger sizes. See the MPFR docs for the references.</p>
<p><a href="https://hal.inria.fr/inria-00070266/document" rel="nofollow ugc">https://hal.inria.fr/inria-00070266/document</a></p>
<p>“Naive” method</p>
<p><a href="https://www.researchgate.net/publication/2786248_Efficient_Multiprecision_Floating_Point_Multiplication_with_Optimal_Directional_Rounding" rel="nofollow ugc">https://www.researchgate.net/publication/2786248_Efficient_Multiprecision_Floating_Point_Multiplication_with_Optimal_Directional_Rounding</a></p>
<p>Mulders algorithm</p>
<p><a href="http://citeseerx.ist.psu.edu/viewdoc/download?doi=10.1.1.55.285&#038;rep=rep1&#038;type=pdf" rel="nofollow ugc">http://citeseerx.ist.psu.edu/viewdoc/download?doi=10.1.1.55.285&#038;rep=rep1&#038;type=pdf</a></p>
</div>
<ol class="children">
<li id="comment-500125" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-07T02:55:11+00:00">April 7, 2020 at 2:55 am</time></a> </div>
<div class="comment-content">
<p>Thank you for the references.</p>
</div>
</li>
<li id="comment-500265" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2d21a52a53d1691a5b596e24a95028ae?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2d21a52a53d1691a5b596e24a95028ae?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">multiplicator</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-07T12:43:33+00:00">April 7, 2020 at 12:43 pm</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s also studied for integer arithmetic:<br/>
Faster truncated integer multiplication &#8211; David Harvey -https://arxiv.org/abs/1703.00640</p>
</div>
</li>
</ol>
</li>
</ol>
