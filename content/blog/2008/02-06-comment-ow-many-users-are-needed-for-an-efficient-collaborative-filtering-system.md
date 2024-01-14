---
date: "2008-02-06 12:00:00"
title: "How many users are needed for an efficient collaborative filtering system?"
index: false
---

[2 thoughts on &ldquo;How many users are needed for an efficient collaborative filtering system?&rdquo;](/lemire/blog/2008/02-06-ow-many-users-are-needed-for-an-efficient-collaborative-filtering-system)

<ol class="comment-list">
<li id="comment-49726" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9dbab7553ade7a69721326137a371d69?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9dbab7553ade7a69721326137a371d69?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://blogs.oracle.com/roller-ui/errors/404.jsp" class="url" rel="ugc external nofollow">Paul</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-02-06T16:44:26+00:00">February 6, 2008 at 4:44 pm</time></a> </div>
<div class="comment-content">
<p>Daniel:</p>
<p>I am interested in how you use &lsquo;accuracy&rsquo; here &#8211; since there is no &lsquo;right&rsquo; answer for a recommender, accuracy is hard to measure, let alone improve. I suspect that you are really talking about predicting ratings (such as one can do for the Netflix prize). </p>
<p>I think that the rating prediction accuracy is a vastly overrated metric for evaluating recommender systems. This metric ignores all sorts of aspects of recommendation that can add or detract from the quality of recommendation: novelty, transparency, resistance to hacking and shilling, diversity all contribute to the quality of a recommendation.</p>
<p>The canonical wisdom for CF systems is that more data is better &#8211; and if you are just predicting ratings, then I agree, but I think we&rsquo;ve seen many examples of recommendation in the wild where more users result in poorer recommendations. Just look at the diversity of recommendations at sites like Digg or Last.fm. As their user base goes up, the diversity of recommendations goes down, the recommender hacks goes up, and the overall recommender experience gets worse. Look at the top 10 tracks at last.fm this week. As the size Last.fm user base has increased it has become a very homogenized music site.</p>
<p><a href="http://www.last.fm/music/+charts/track/" rel="nofollow ugc">http://www.last.fm/music/+charts/track/</a></p>
<p>(well, sorry for the rant, thanks for the interesting and provocative list).</p>
</div>
</li>
<li id="comment-49727" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-02-06T17:04:55+00:00">February 6, 2008 at 5:04 pm</time></a> </div>
<div class="comment-content">
<p><i> I am interested in how you use &lsquo;accuracy&rsquo; here &#8211; since there is no &lsquo;right&rsquo; answer for a recommender, accuracy is hard to measure, let alone improve. I suspect that you are really talking about predicting ratings (such as one can do for the Netflix prize).</i></p>
<p>Yes. I am. And I agree with you. A friend of mine, Peter Turney, who also reads this blog, might answer something along the line that an incomplete metric is better than no metric at all.</p>
<p><i> I think that the rating prediction accuracy is a vastly overrated metric for evaluating recommender systems. This metric ignores all sorts of aspects of recommendation that can add or detract from the quality of recommendation: novelty, transparency, resistance to hacking and shilling, diversity all contribute to the quality of a recommendation.</i></p>
<p>I agree 100%. I have written about this on my blog in the past.</p>
<p><i> The canonical wisdom for CF systems is that more data is better &#8211; and if you are just predicting ratings, then I agree, but I think we&rsquo;ve seen many examples of recommendation in the wild where more users result in poorer recommendations. Just look at the diversity of recommendations at sites like Digg or Last.fm. As their user base goes up, the diversity of recommendations goes down, the recommender hacks goes up, and the overall recommender experience gets worse. Look at the top 10 tracks at last.fm this week. As the size Last.fm user base has increased it has become a very homogenized music site.</i></p>
<p>Very interesting comment. And I agree.</p>
</div>
</li>
</ol>
