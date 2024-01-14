---
date: "2007-12-13 12:00:00"
title: "Netflix: an interesting Machine Learning game, but is it good science?"
index: false
---

[2 thoughts on &ldquo;Netflix: an interesting Machine Learning game, but is it good science?&rdquo;](/lemire/blog/2007/12-13-netflix-an-interesting-machine-learning-game-but-is-it-good-science)

<ol class="comment-list">
<li id="comment-49630" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ebec6abd2b9f1eb4de865aed01242171?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ebec6abd2b9f1eb4de865aed01242171?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://mendicantbug.com" class="url" rel="ugc external nofollow">Jason Adams</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-12-13T20:28:19+00:00">December 13, 2007 at 8:28 pm</time></a> </div>
<div class="comment-content">
<p>I tend to agree with the intuition that the systems being thrown at this are overfitting to the data set. The KorBell system is a hodgepodge of different methods that it seems unlikely would generalize to anything else without a lot of tweaking. I also agree that metrics like root mean squared error and mean absolute error have both reached the limit of their usefulness (there seems to be a collaborative filtering equivalent of a sound barrier). That said, I guess we can always hope the prize purse will bring someone to the field who makes a breakthrough.</p>
</div>
</li>
<li id="comment-49641" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/171b8293a9c54b32d28e532d06a2bd86?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/171b8293a9c54b32d28e532d06a2bd86?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Yehuda Koren</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-12-18T21:41:37+00:00">December 18, 2007 at 9:41 pm</time></a> </div>
<div class="comment-content">
<p>Daniel,</p>
<p>You made a blatant statement: &ldquo;do not think that the next step in collaborative filtering is to find ways to improve accuracy according to some metric. I think this game got old circa 2000&rdquo;. My blatant response is that competitors revealed pretty soon that methods developed till circa 2006 got old, and cannot lead to significant improvements or further insight into the data. That&rsquo;s why quite a few innovations were developed by competitors, thanks to the Netflix challenge, during the past year. </p>
<p>It will take some time to fully recognize and appreciate these innovations. Certainly better familiarity with the methods themselves is required. The chosen RMSE error measure (which is an excellent choice in my eyes, but that&rsquo;s another topic) has the tendency to miniaturize impression of progress, due to that square root&#8230;<br/>
However, a deeper look into the new developments would reveal some important contributions to the field: (1) Improvement in accuracy will definitely have an impact on user experience. E.g., our studies show that 8% drop in RMSE means a very significant improvement in the quality of the top-K recommendations. (2) Key innovations are not specific to the contest, but general, and can be leveraged by a company like Netflix to obtain further improvements based on integrating the extra information that they hold. (3) Almost all new methods are scalable and computationally efficient (what is implied by the size of the Netflix dataset, which is much larger than previous ones.) </p>
<p>I sympathize your willing to think bigger, beyond improving prediction error, but we should never forget the basics and the important impact they have on recommenders&rsquo; quality.</p>
<p>Best wishes for the new year,<br/>
Yehuda</p>
</div>
</li>
</ol>
