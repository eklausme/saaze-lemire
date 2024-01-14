---
date: "2007-08-20 12:00:00"
title: "Is the cosine similarity transitive?"
index: false
---

[3 thoughts on &ldquo;Is the cosine similarity transitive?&rdquo;](/lemire/blog/2007/08-20-is-the-cosine-similarity-transitive)

<ol class="comment-list">
<li id="comment-49451" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-08-20T21:33:05+00:00">August 20, 2007 at 9:33 pm</time></a> </div>
<div class="comment-content">
<p><i> What exactly do you mean by transitivity for a function that returns a numeric value ? are you looking for a triangle inequality by any chance ?</i></p>
<p>A triangle inequality is a form of transitivity. Specifically, it implies sum-transitivity (as opposed to, say, product-transitivity).</p>
<p>There is no true formal and universal definition of transitivity here, but similarity measures are used by Machine Learning people to define classes (think clustering algorithms), but this only makes sense if you have some form of transitivity.</p>
<p>The cosine similarity measure is neither sum nor product transitive. Yet, it is clearly (as you point out next) &ldquo;transitive&rdquo; in a &ldquo;geometrical way&rdquo;.</p>
<p><i> The geometric interpretation of the cosine similarity should get you what you want: it corresponds to the chordal distance between the points u, and v, when projected onto the unit sphere.</i></p>
<p>Sure. Anyone can draw a picture and &ldquo;know&rdquo; that it must be transitive. But then&#8230; I am not entirely satisfied by this explanation.</p>
<p>What I did was to derive a simple bound on cos(v,z) given cos(v,w) and cos(w,z). It is trivial algebra, but I did a rough job. I do not recall how it goes exactly, but I think I have something like cos(v,z) >= cos(w,z)+sqrt(1-cos(v,w)^2). (It it not very nice, you see.) Being lazy, I do not want to go through five lines of algebra to derive the nicest lower bound possible, and I hope that someone has worked out the math. before. Or maybe someone has a surprisingly nice two-liner argument for transitivity that goes beyond &ldquo;draw a picture and you&rsquo;ll see&rdquo;.</p>
<p>There is probably a very nice and trivial lower bound for cos(v,z) given cos(w,z) and cos(v,w). That&rsquo;s probably something given out to smart students in high school. </p>
<p>For extra points, generalize your work to the Tanimoto similarity measure.</p>
</div>
</li>
<li id="comment-49450" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6537c0a681d22d4a3f7bf4ce7d209a0f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6537c0a681d22d4a3f7bf4ce7d209a0f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Suresh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-08-20T17:34:57+00:00">August 20, 2007 at 5:34 pm</time></a> </div>
<div class="comment-content">
<p>What exactly do you mean by transitivity for a function that returns a numeric value ? are you looking for a triangle inequality by any chance ? </p>
<p>The geometric interpretation of the cosine similarity should get you what you want: it corresponds to the chordal distance between the points u, and v, when projected onto the unit sphere.</p>
</div>
</li>
<li id="comment-49452" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anonymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-08-20T21:59:57+00:00">August 20, 2007 at 9:59 pm</time></a> </div>
<div class="comment-content">
<p>Well, the geometric intuition is what you need. Intuitively, the worst scenario for cos(v,z) comes about when the projections of v, w, z, are in a geodesic on the unit circle. In this case, if the angle between v and w = a, and the angle between w and z = b, then we can see that </p>
<p>cos(v,z) = cos(a + b), and some taylor expansion messiness will give you something like </p>
<p>cos(v,z) &gt;= [cos(v,w) + cos(w,z)]^2/2 &#8211; 1</p>
<p>i guess the question is: how messy do you want the inequality to be ?</p>
</div>
</li>
</ol>
