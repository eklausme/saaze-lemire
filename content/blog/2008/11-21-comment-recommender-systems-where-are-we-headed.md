---
date: "2008-11-21 12:00:00"
title: "Recommender systems: where are we headed?"
index: false
---

[8 thoughts on &ldquo;Recommender systems: where are we headed?&rdquo;](/lemire/blog/2008/11-21-recommender-systems-where-are-we-headed)

<ol class="comment-list">
<li id="comment-50285" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ee8eab881a571c167cd91c9e14559024?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ee8eab881a571c167cd91c9e14559024?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Aleks</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-11-21T19:56:11+00:00">November 21, 2008 at 7:56 pm</time></a> </div>
<div class="comment-content">
<p>The NYT article actually does raise a few issues that you mention &#8211; such as the importance of diversity (through Maes&rsquo; complaint about narrow-mindedness).</p>
<p>Also, I&rsquo;ve elaborated on the problems of RMSE on our blog &#8211; it was interesting to see Koren&rsquo;s comment to your Dec 07 post about RMSE giving a misleading measure of progress.</p>
</div>
</li>
<li id="comment-50286" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dc20f7fc7b7dab70033b2a9d86c70144?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dc20f7fc7b7dab70033b2a9d86c70144?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://ww38.conflate.net/inductio" class="url" rel="ugc external nofollow">Mark Reid</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-11-21T21:31:19+00:00">November 21, 2008 at 9:31 pm</time></a> </div>
<div class="comment-content">
<p>Regarding your criticisms of machine learning, there is research in that field that considers diversity constraints and non-static data sets. </p>
<p>Section 5.1 of <a href="http://arxiv.org/pdf/0704.3359.pdf" rel="nofollow">this paper</a> by Smola and Le explicitly considers diversity constraints for ranking problems, of which collaborative filtering is a special case.</p>
<p>There is also quite a lot of research in ML on what you call &ldquo;non-static&rdquo; data sets. However, the ML community refers to this as &ldquo;online&rdquo; learning. <a href="https://en.wikipedia.org/wiki/Stochastic_gradient_descent" rel="nofollow">Stochastic gradient descent</a> is a well known and practical example of these type of algorithms.</p>
<p>There is even research that addresses both of your short-coming at once. For example, Crammer and Singer have <a href="http://dl.acm.org/citation.cfm?id=1119619" rel="nofollow">a paper</a> that provides an online algorithm for ranking and apply it to the EachMovie data set. Searching for &ldquo;online learning&rdquo; and &ldquo;ranking&rdquo; reveals more along these lines.</p>
</div>
</li>
<li id="comment-50287" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-11-22T00:31:36+00:00">November 22, 2008 at 12:31 am</time></a> </div>
<div class="comment-content">
<p><i> There is also quite a lot of research in ML on what you call &ldquo;non-static&rdquo; data sets. </i></p>
<p>Here is the problem again. When working with a static data set, such as what Crammer and Singer do with the EachMovie data set, they ignore the fact that, in practise, the ratings are influenced by the collaborative filtering algorithm! If you change the algorithm, you will collect different ratings. That&rsquo;s because your users browse the movies, say, based on what the recommender suggests (for example, Amazon says 30% of their sales is due to the recommenders they use)&#8230; so they will rate different items, differently, if you change the algorithm. In turn, this will influence the algorithm which will then change how it influences the users.</p>
<p>This is like the polls right before the election. The polls are supposed to measure how people vote, but in fact, they influence people&#8230; there is a feedback loop.</p>
<p>That has *absolutely* nothing to do with whether you do batch or online processing. The online versus batch is a performance issue, I&rsquo;m talking about how the *algorithm* changes the *data* (and vice versa).</p>
<p><i> Section 5.1 of this paper by Smola and Le explicitly considers diversity constraints for ranking problems, of which collaborative filtering is a special case.</i></p>
<p>Thanks. This recent non-peer-reviewed paper looks good indeed. But it is hardly representative of the algorithmic research done in collaborative filtering though. The diversity issue has not be ignored in collaborative filtering. I have a survey report somewhere of what was done. Several people, from way back, talked about diversity in recommender systems. However, the diversity work is tiny and vastly ignored.</p>
<p>Why? Because it is a lot easier to measure accuracy. So, all the work (99%) focuses on this one issue above all else.</p>
</div>
</li>
<li id="comment-50288" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-11-22T00:34:11+00:00">November 22, 2008 at 12:34 am</time></a> </div>
<div class="comment-content">
<p>Aleks : Yes, people know about the diversity issue. In fact, every user knows about this problem. It has just been vastly ignored for the last 10 years.</p>
<p>I love the post you link to!</p>
</div>
</li>
<li id="comment-50289" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dc20f7fc7b7dab70033b2a9d86c70144?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dc20f7fc7b7dab70033b2a9d86c70144?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://ww38.conflate.net/inductio" class="url" rel="ugc external nofollow">Mark Reid</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-11-22T01:54:54+00:00">November 22, 2008 at 1:54 am</time></a> </div>
<div class="comment-content">
<p>I see what you mean by non-static data now and take your point. However, I disagree that online processing has &ldquo;absolutely nothing to do&rdquo; with non-static data since online methods are able to track non-stationary targets. That is, if the results of the algorithm are changing the distributions underlying the data then as more data is taken into account the algorithm will adapt to them.</p>
<p>I also agree that there is not much work on diversity measures but I thought you were too quick to discount ML research with a sweeping statement so felt compelled to offer a counter-example.</p>
</div>
</li>
<li id="comment-50290" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-11-22T11:47:20+00:00">November 22, 2008 at 11:47 am</time></a> </div>
<div class="comment-content">
<p><i> I see what you mean by non-static data now and take your point. However, I disagree that online processing has &ldquo;absolutely nothing to do&rdquo; with non-static data since online methods are able to track non-stationary targets. That is, if the results of the algorithm are changing the distributions underlying the data then as more data is taken into account the algorithm will adapt to them.</i></p>
<p>An online algorithm will have a tighter feedback loop, but ultimately, you are limited by how quickly your users can react and input data. Hence, the difference between a batch algorithm run every day, and an online algorithm that adapts on the fly, might not be so large.</p>
<p>Of course, I would favor the online algorithm given a chance&#8230; 😉 But google seems to do well with batch indexing algorithms. I understand that they run PageRank in batch mode&#8230; and they seem to do fine.</p>
<p><i> I also agree that there is not much work on diversity measures but I thought you were too quick to discount ML research with a sweeping statement so felt compelled to offer a counter-example.</i></p>
<p>I am equally critical of my own work, of the work in any domain. It is by seeking flaws that we make progress. And I have received my share of criticism from the ML community and from the TCS community as well. (Note that I have published papers in ML and TCS journals/conferences. I refuse to live in closed gardens.)</p>
<p>Please go read my papers and criticize them! Publicly! If people can&rsquo;t take criticism, they should stay home, in the labs, and never publish.</p>
<p>However, my impression is that the ML community suffer from the same flaw than any of these tightly integrated communities: it becomes strongly biased. See my post <a href="https://lemire.me/blog/2008/07/23/encouraging-diversity-in-science/" rel="nofollow">Encouraging<br/>
diversity in science</a> for a related discussion.</p>
<p>I believe research should not occur within groups, but within networks. The communities should be open, not closed. Single-minded people (&ldquo;accuracy above all else&rdquo;) should be left behind. Science requires us to be open minded, to have a dialogue not only with people who &ldquo;think alike&rdquo; but also with people who think differently, so that we can do &ldquo;richer&rdquo; science.</p>
</div>
</li>
<li id="comment-50291" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dc20f7fc7b7dab70033b2a9d86c70144?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dc20f7fc7b7dab70033b2a9d86c70144?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://ww38.conflate.net/inductio" class="url" rel="ugc external nofollow">Mark Reid</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-11-22T18:45:36+00:00">November 22, 2008 at 6:45 pm</time></a> </div>
<div class="comment-content">
<p>I definitely agree with your last point. I&rsquo;m also wary of very tightly knit groups. On that not, you&rsquo;ll be happy to hear that I&rsquo;m presenting a paper at a conference on Australian literary culture next month. Is that diverse enough for you? 🙂</p>
</div>
</li>
<li id="comment-50292" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/880cbab435f00197613c9cc2065b4f5a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/880cbab435f00197613c9cc2065b4f5a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Daniel Haran</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-11-23T10:57:12+00:00">November 23, 2008 at 10:57 am</time></a> </div>
<div class="comment-content">
<p>I just came across:<br/>
<a href="http://www.informatik.uni-freiburg.de/~cziegler/BX/" rel="nofollow ugc">http://www.informatik.uni-freiburg.de/~cziegler/BX/</a></p>
<p>It mentions diversity, but uses taxonomy (!) to compute it.</p>
</div>
</li>
</ol>
