---
date: "2007-12-22 12:00:00"
title: "Collaborative Filtering: Why working on static data sets is not enough"
index: false
---

[6 thoughts on &ldquo;Collaborative Filtering: Why working on static data sets is not enough&rdquo;](/lemire/blog/2007/12-22-collaborative-filtering-why-working-on-static-data-sets-is-not-enough)

<ol class="comment-list">
<li id="comment-49652" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7361130199533952178a6d87e9b29faa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7361130199533952178a6d87e9b29faa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Peter Turney</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-12-22T10:30:59+00:00">December 22, 2007 at 10:30 am</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,</p>
<p>This related work comes to mind:</p>
<p><a href="https://tinyurl.com/2uolhv" rel="nofollow ugc">http://tinyurl.com/2uolhv</a></p>
<p>Intelligent Information Access Publications</p>
<p>&#8211; A Learning Agent that Assists the Browsing of Software Libraries<br/>
&#8211; A Learning Apprentice For Browsing<br/>
&#8211; Accelerating Browsing by Automatically Inferring a User&rsquo;s Search Goal</p>
</div>
</li>
<li id="comment-49654" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/171b8293a9c54b32d28e532d06a2bd86?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/171b8293a9c54b32d28e532d06a2bd86?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Yehuda Koren</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-12-22T23:00:57+00:00">December 22, 2007 at 11:00 pm</time></a> </div>
<div class="comment-content">
<p>I agree that this is a very important complication in the evaluation of collaborative filtering.<br/>
To sharpen the point, I think that there are two separate issues:<br/>
(1)<br/>
The fact that the interactive recommender system influences the users&rsquo; behaviors, which, in turn, feedback into the CF system, and so in a loop. In other words, the CF mechanism is a active part of the system that it is supposed to learn and judge.</p>
<p>(2)<br/>
All the feedback to the collaborative filtering is conditioned on the fact that the users actually performed an action. All our observations on a product are based on the very narrow and unrepresentative sub-population that chose to reflect their opinion (implicitly or explicitly) on that product. Naturally, such a population is highly biased to like the product. For example, when we say that &ldquo;the average rating for The Six Sense movie is 4.5 stars&rdquo; we really mean to say: &ldquo;the average rating for The Six Sense movie AMONG PEOPLE THAT CHOSE TO RATE THAT MOVIE is 4.5 stars&rdquo;. Now what is really the average rating for The Six Sense across all population? Well, that&rsquo;s hard to know. But the whole population is the one that really counts&#8230;</p>
<p>I used to be much more concerned about the second issue&#8230;</p>
<p>Yehuda</p>
</div>
</li>
<li id="comment-49655" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-12-22T23:13:35+00:00">December 22, 2007 at 11:13 pm</time></a> </div>
<div class="comment-content">
<p>The key challenge seems to be: how do we study (with rigor) these problems?</p>
</div>
</li>
<li id="comment-49657" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d85d14bde9896007ed3b6b2d9731c14d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d85d14bde9896007ed3b6b2d9731c14d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mike</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-12-23T01:31:48+00:00">December 23, 2007 at 1:31 am</time></a> </div>
<div class="comment-content">
<p>[Caveat: I&rsquo;m a programmer, not a researcher]</p>
<p>The production recommendation systems that i&rsquo;ve had experience with attempt to avoid self-reinforcing behavior by introducing a degree of randomness. In other words, you determine recommendations based on the user&rsquo;s rating profile, but then you augment that with some percentage of more remotely related items and possibly even a small percentage of unrelated items. I wish i could provide evidence that this helps, but it&rsquo;s mostly a hack.</p>
<p>There are a couple of other biases in rating data though, at least in the area that i&rsquo;m familiar with (music). One is the &ldquo;selection bias&rdquo;, or the fact that people don&rsquo;t rate everything that&rsquo;s presented to them but rather only things they love or hate. The other is that peoples&rsquo; rating behavior can differ substantially from their actual listening behavior (probably more when their rating profile is public).</p>
<p>It might be possible to model users in the sense of reproducing the distribution of ratings in a dataset like NetFlix&rsquo;s. But i think the bigger challenge for recommendation technology right now is to capture the things we aren&rsquo;t getting from users, like how to correlate mood to preferences, or how to distinguish true favorites from temporary enthusiasms.</p>
</div>
</li>
<li id="comment-49789" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-03-19T10:36:59+00:00">March 19, 2008 at 10:36 am</time></a> </div>
<div class="comment-content">
<p>Thanks for the comment. Yes, it would interesting. We need people to do this. (I can&rsquo;t &#8212; at least not alone.)</p>
</div>
</li>
<li id="comment-49788" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/80a981cc54672b19b9301c1217519ef0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/80a981cc54672b19b9301c1217519ef0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://christian.typepad.com/" class="url" rel="ugc external nofollow">Christian Campbell</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-03-19T10:27:31+00:00">March 19, 2008 at 10:27 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve always figured sites powering recommendation systems would need to perform some sort of experimentation on their users to control for the effect of recommendations. This could include selectively omitting recommendations (perhaps altogether for certain items and/or users) to establish control groups.</p>
<p>Regarding Note 1, I think a simulation of human behaviour adequate to explore the consequences of ratings on human behaviour would require already knowing the answer, so that&rsquo;s a circular and prohibitive way of going about things.</p>
</div>
</li>
</ol>
