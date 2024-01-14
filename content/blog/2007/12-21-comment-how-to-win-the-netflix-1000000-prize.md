---
date: "2007-12-21 12:00:00"
title: "How to win the Netflix $1,000,000 prize?"
index: false
---

[4 thoughts on &ldquo;How to win the Netflix $1,000,000 prize?&rdquo;](/lemire/blog/2007/12-21-how-to-win-the-netflix-1000000-prize)

<ol class="comment-list">
<li id="comment-49650" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/880cbab435f00197613c9cc2065b4f5a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/880cbab435f00197613c9cc2065b4f5a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Daniel Haran</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-12-21T16:33:22+00:00">December 21, 2007 at 4:33 pm</time></a> </div>
<div class="comment-content">
<p>I subscribed to your blog after finding your work on CF for research on Netflix.</p>
<p>A few things I&rsquo;m curious about and would appreciate reading your thoughts on:</p>
<p>-SVM&rsquo;s barely get a mention by competitors. It seems odd that they wouldn&rsquo;t be used. Do you know if performance is the issue? They are of course one of the worst for explainability.</p>
<p>-Date seems to have a large effect on ratings, but all I find is people saying they can&rsquo;t take advantage of it to improve their scores. Have you heard of any good research on this? With several percentage points variation over the year in average score, it boggles my mind nothing could be squeezed out of it.</p>
</div>
</li>
<li id="comment-49651" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-12-21T17:04:01+00:00">December 21, 2007 at 5:04 pm</time></a> </div>
<div class="comment-content">
<p>As for date&#8230; certainly, if you knew when the user entered his ratings, or at least when the user was active, you could leverage this information&#8230; but otherwise, it is hard to see where to go.</p>
<p>There is published work on taking into account the time factor, mostly to dampen older ratings.</p>
<p>I do not have the faintest idea how SVMs would fare on Netflix. However, scalability is definitively a serious issue for all algorithms. Most of academic machine learning work is done on relatively small data sets, and Netflix is huge in comparison, though it is still modest compared to what you face in industry.</p>
</div>
</li>
<li id="comment-49653" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/171b8293a9c54b32d28e532d06a2bd86?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/171b8293a9c54b32d28e532d06a2bd86?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Yehuda Koren</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-12-22T22:44:59+00:00">December 22, 2007 at 10:44 pm</time></a> </div>
<div class="comment-content">
<p>Two comments&#8230;</p>
<p>About explain-ability:<br/>
I am the last one to argue against the importance of explaining the recommendations to the user. (See my talk@Netflix&#8230;) However, the seemingly tradeoff between parsimonious explanation and accuracy is much exaggerated, especially when considering real life systems rather than idealist situations. Basically, you want to push as much as you can on both frontiers. Top-notch accuracy lets you stay with the more confident recommendations, and/or assume more risk, which allows you to dare and surprise the customer with not so popular recommendation specially tailored for him. Then, at a *second stage*, you may need to explain &ldquo;why&rdquo;. To this end, you are going to utilize the best explaining techniques in your disposal. And BTW, contrary to some belief, latent factor models, such as SVD, won&rsquo;t prevent coming up with working explanations. </p>
<p>About dates:<br/>
We did utilize them. Description is scattered across our papers. Overall, they are far less helpful than what we hoped, especially considering the significant transitions over time that are present in the data. Maybe it won&rsquo;t be true in other datasets.</p>
<p>Regards,<br/>
Yehuda</p>
</div>
</li>
<li id="comment-49736" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e2174970aac12b931e7058b94171c930?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e2174970aac12b931e7058b94171c930?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jan Christiansen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-02-18T19:04:55+00:00">February 18, 2008 at 7:04 pm</time></a> </div>
<div class="comment-content">
<p>In my view scale invariance is one of the indicators of a robust algorithm in all of numerical analysis. Any algorithm that can be defeated by a simple transformation is not correctly identifying the information in the data. It was Peter Deuflhard who first introduced me to this insight with a paper on affine invariance.</p>
</div>
</li>
</ol>
