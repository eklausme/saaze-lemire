---
date: "2006-07-01 12:00:00"
title: "Olivier Bousquet at Curves and Surfaces 2006: Learning on Manifolds"
index: false
---

[6 thoughts on &ldquo;Olivier Bousquet at Curves and Surfaces 2006: Learning on Manifolds&rdquo;](/lemire/blog/2006/07-01-olivier-bousquet-at-curves-and-surfaces-2006-learning-on-manifolds)

<ol class="comment-list">
<li id="comment-12427" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-07-01T10:37:58+00:00">July 1, 2006 at 10:37 am</time></a> </div>
<div class="comment-content">
<p>No, I don&rsquo;t think he made any sort of comparison and I don&rsquo;t recall mention of ISOMAP or LLE (though, they may have be cited?), and I think that in the talk, he only tested his technique on a toy case with images having two degrees of freedom, and 4 significant eigenvectors (corresponding to the corner of a 2D patch). I got the feeling he had his own Matlab implementation and that&rsquo;s all he used. He didn&rsquo;t claim, however, to either present a survey or that all the work presented was his own.</p>
<p>Naturally, the usual disclaimers apply: don&rsquo;t trust me too much and check with Olivier for details.</p>
</div>
</li>
<li id="comment-12405" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6537c0a681d22d4a3f7bf4ce7d209a0f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6537c0a681d22d4a3f7bf4ce7d209a0f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Suresh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-07-01T08:44:41+00:00">July 1, 2006 at 8:44 am</time></a> </div>
<div class="comment-content">
<p>Did he compare with ISOMAP and LLE ?</p>
</div>
</li>
<li id="comment-12485" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-07-01T16:54:10+00:00">July 1, 2006 at 4:54 pm</time></a> </div>
<div class="comment-content">
<p>With the warning that my understanding of what he presented is very limited (CS 2006 papers will only be out next year) and that I don&rsquo;t know what ISOMAP or LLE are (other than what I could learn in 10 seconds through Google), one argument he had was that you don&rsquo;t actually want to compute or estimate the manifold for the problem types he is interested in. Moreover, solving for the manifold can actually be an ill-posed problem in the sense that an actual manifold might not exist in the real problems, while the &ldquo;approximate idea&rdquo; of a manifold might still be useful. I don&rsquo;t know what ISOMAP or LLE do&#8230; My shallow understanding says the he casts the problem as a graph problem and remains there for all time (though it is a weighted graph!). The manifold idea kicks in only through the computation of the Laplacian which is used to find your clusters through a dominant eigenvector approach.</p>
<p>So, all he ever does is classification/clustering. You&rsquo;ve got nodes in your graph and you want to cluster them. Soooo&#8230; he does, essentially, discrete mathematics&#8230; (or at least solves discrete problems).</p>
<p>One point that wasn&rsquo;t entirely clear in his presentation is how you find the nearest points, and he got a question about this from Wolfang Dahmen, but I don&rsquo;t think he had worried about the computational complexity.</p>
<p>(Need I remind you again not to trust me too much?)</p>
<p>Now, I could imagine machine learning techniques where you actually, given dense and uniform data points, you try to compute the manifold (maybe by local patches?) for the purpose of, say, prediction/extrapolation/interpolation&#8230; that wouldn&rsquo;t be at all what he presented and I think he made a case against the practicality of such approaches.</p>
<p>A lot of learning theory seems to have to do with &ldquo;regression&rdquo;: given data points, find the &ldquo;function&rdquo; (and I extend &ldquo;function&rdquo; to include &ldquo;manifold&rdquo;) which best fits the data. Given some assumptions on the how nice the function (or the manifold) is, then you can prove some nice (theoretical) results about the rate of convergence and stuff. This is not what Olivier presented.</p>
<p>My blog post was actually a rant about some of these techniques that were not justified by applications: for example, smoothness is often a crazy expectation in the real world. There are many assumptions you can make, but differentiability of your data seems so unrealistic! (to me, but then again, it is only a blog post)</p>
</div>
</li>
<li id="comment-13616" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">FD</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-07-05T09:53:31+00:00">July 5, 2006 at 9:53 am</time></a> </div>
<div class="comment-content">
<p>Inviting accusations of self-promotion, I can point you to a few papers discussing the use of graph Laplacian-based techniques for ad hoc information retrieval. The CIKM paper in particular reduces a few classic IR techniques to graph regularization.</p>
</div>
</li>
<li id="comment-14168" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-07-06T18:43:45+00:00">July 6, 2006 at 6:43 pm</time></a> </div>
<div class="comment-content">
<p>My thinking is very clear-cut: theory and practice are at their best when they collaborate. A theorem is nothing without practical validation, and experimental results are nothing without a theorem. We should never go too far without a theory, and we should never go too far with experimental validation.</p>
<p>I&rsquo;m amazed at how few people share my views on this. I end up sounding like an extremist because I advocate something that ought to be common sense (I think).</p>
</div>
</li>
<li id="comment-14057" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/679b720c8058c6579039544232b5e9bb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/679b720c8058c6579039544232b5e9bb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://ml.typepad.com/" class="url" rel="ugc external nofollow">Olivier Bousquet</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-07-06T14:12:56+00:00">July 6, 2006 at 2:12 pm</time></a> </div>
<div class="comment-content">
<p>Thanks a lot for attending my talk and for your interest in this work. I must start by saying that what I presented is not my own work, but it was more a survey of recent work that has been done in the Machine Learning community.<br/>
The goal was to show to people in the audience that this community had worked on interesting problems and proposed interesting approaches to deal with those.</p>
<p>My own work was more on the theoretical side (trying to understand how these things work, what are their properties, how to unify the various algorithms that have been proposed&#8230;). But as you point out, I have been a bit shy when answering Ron DeVore&rsquo;s question about analytical results.<br/>
I am fine with the fact that, as a mathematician, Ron needs properly formulated questions to start looking for results to prove.<br/>
But on the other hand, I think the ultimate test is practical efficiency.<br/>
In a way, my brain is now split into two INDEPENDENT parts: one part of my brain likes to prove theorems, the other part likes to solve practical problems.<br/>
Unfortunately, I never managed to have them collaborate in a productive manner 😉<br/>
Still, I concede that it is necessary to try and formalize the problems one is working on. Not in order to prove things but in order to understand what you are doing.</p>
<p>For example, in the context of graph Laplacians, I think it is important to understand the meaning of the quantities you manipulate. For example, the fact that there are analogies between discrete quantities and continuous ones is important to guide intuition.<br/>
But proving that the former converge to the latter is just a mathematical exercise, which is often frustrating because you have to introduce a lot of assumptions (which the practical side of my brain is fighting against) in order to prove anything&#8230;</p>
<p>If you are interested, I will put the slides on my publications page. Most important is to look at the last slide which contains bibliographic references (and most important is to look for the references inside these papers, not the papers themselves which are too theoretically oriented;)</p>
</div>
</li>
</ol>
