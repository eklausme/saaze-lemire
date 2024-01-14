---
date: "2007-12-05 12:00:00"
title: "Formal definitions are less useful than you think"
index: false
---

[5 thoughts on &ldquo;Formal definitions are less useful than you think&rdquo;](/lemire/blog/2007/12-05-formal-definitions-are-less-useful-than-you-think)

<ol class="comment-list">
<li id="comment-49614" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8b70790f2d886a2568bf35f10a3af9b1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8b70790f2d886a2568bf35f10a3af9b1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.entish.org/willwhim/" class="url" rel="ugc external nofollow">Will</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-12-05T10:37:24+00:00">December 5, 2007 at 10:37 am</time></a> </div>
<div class="comment-content">
<p>(Remember, that in the AI wars, I am a &lsquo;scruffy&rsquo;)</p>
<p>The fact that &lsquo;your computer&rsquo; is storing 8/9 as a floating point is an artifact of the programming language/math system you are using. Languages/systems that support a &lsquo;full numeric tower&rsquo; can store rationals, and it&rsquo;s very nice when that numeric equality is formally defined, as in the Scheme spec, or the Common Lisp spec. </p>
<p>It really does matter, in practical terms; real engineering disasters occur when the numeric representations and translations and limits are not understood or not formally defined. </p>
<p>for example:</p>
<p><a href="http://www.ima.umn.edu/~arnold/disasters/ariane.html" rel="nofollow ugc">http://www.ima.umn.edu/~arnold/disasters/ariane.html</a></p>
</div>
</li>
<li id="comment-49615" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-12-05T11:22:20+00:00">December 5, 2007 at 11:22 am</time></a> </div>
<div class="comment-content">
<p>I agree. The equality between two numbers is not a trivial issue.</p>
<p>Trying to figure out what x=y means for an engineer and whether it means the same thing for another engineer, is hard.<br/>
Hence, we have to expect semantic technologies (such as the ones you are no doubt working on) to have hard limits.</p>
</div>
</li>
<li id="comment-49616" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8b70790f2d886a2568bf35f10a3af9b1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8b70790f2d886a2568bf35f10a3af9b1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.entish.org/willwhim/" class="url" rel="ugc external nofollow">Will</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-12-05T11:30:13+00:00">December 5, 2007 at 11:30 am</time></a> </div>
<div class="comment-content">
<p>One point of this is to develop technologies with &lsquo;soft&rsquo; limits. For example, checking whether 2 numbers are within some delta of one another, rather than equal. For the semantic technologies, we are using lots of statistical techniques in combination with symbolic techniques.</p>
<p>Another point is be careful of assumptions, and, to as great extent as practical, don&rsquo;t build those into the engineered system. For example, it probably actually does not make sense to have a &lsquo;=&rsquo; function for floating point numbers. </p>
<p>A third point is that &lsquo;equality&rsquo; is tricky, and almost always means &lsquo;equality for some purpose.&rsquo;</p>
</div>
</li>
<li id="comment-49620" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8e2e3a01bf33747391457d97e0df832b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8e2e3a01bf33747391457d97e0df832b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://synthese.wordpress.com/" class="url" rel="ugc external nofollow">Andre Vellino</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-12-05T16:06:31+00:00">December 5, 2007 at 4:06 pm</time></a> </div>
<div class="comment-content">
<p>Some years ago (at BNR) I was mired in the problem of floating-point representations for real numbers and, in an effort to obey the formal definitions for arithmetic operations &#8211; such as Commutativity and Distribution &#8211; we developed a constraint programming system on bounded intervals. It was an interesting system.</p>
<p>There&rsquo;s a significant literature on the subject</p>
<p><a href="https://www.google.ca/search?q=constraints+on+interval+logic+programming" rel="nofollow ugc">http://www.google.ca/search?q=constraints+on+interval+logic+programming</a></p>
<p>You can also compute real numbers using continued fractions:</p>
<p><a href="https://en.wikipedia.org/wiki/Continued_fraction" rel="nofollow ugc">http://en.wikipedia.org/wiki/Continued_fraction</a></p>
</div>
</li>
<li id="comment-49622" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/69efccdc4ea5f98aecb4e5ee35a8d991?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/69efccdc4ea5f98aecb4e5ee35a8d991?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://webphilosophus.blogspot.com" class="url" rel="ugc external nofollow">Jean Robillard</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-12-06T10:10:40+00:00">December 6, 2007 at 10:10 am</time></a> </div>
<div class="comment-content">
<p>The problem, from a philosophical point of view, is with the concept of definition itself. Descartes, Frege, Brouwer, and so many others have tackled with it. But no definitive concept of definition was vastly accepted. Why? Because, simply, as turns out, not that any concept will do, it is just that a definition generally relies on an overlapping conceptual schema, build on a proposed convention by which it therefore becomes possible to infer or deduce what is so being demonstrated. We then can see that the concept of definition is a concept of a larger theory of demonstration or of proof theory, which has to contain some extraneous &#8230; defintions of its own in order to fulfill its function: semantics. And we then go back to GÃ¶ddell and understand a little bit more of this intricate relation in between syntaxis and semantics.</p>
</div>
</li>
</ol>
