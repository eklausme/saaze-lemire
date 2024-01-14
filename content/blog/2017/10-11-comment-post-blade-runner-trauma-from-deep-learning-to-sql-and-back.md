---
date: "2017-10-11 12:00:00"
title: "Post-Blade-Runner trauma: From Deep Learning to SQL and back"
index: false
---

[12 thoughts on &ldquo;Post-Blade-Runner trauma: From Deep Learning to SQL and back&rdquo;](/lemire/blog/2017/10-11-post-blade-runner-trauma-from-deep-learning-to-sql-and-back)

<ol class="comment-list">
<li id="comment-288656" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-11T16:16:01+00:00">October 11, 2017 at 4:16 pm</time></a> </div>
<div class="comment-content">
<p>It looks like we are actually very far. I don&rsquo;t think, e.g., that there is a single implementation of an end-to-end dialog system that learned to do useful things. For example, how do you train a system that will book hotels, flights, rental cars, shop on Amazon etc&#8230; It needs to read forms, fill them and do a lot of things. If humans can decompose these tasks into much smaller one that heavily rely on classification, collect and clean data, architecture training pipelines, only then deep learning comes into play.</p>
</div>
<ol class="children">
<li id="comment-288657" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-11T16:29:54+00:00">October 11, 2017 at 4:29 pm</time></a> </div>
<div class="comment-content">
<p>I agree though I would not dare to put a time frame. It could be that we are one week away from the breakthrough we lack.</p>
</div>
</li>
</ol>
</li>
<li id="comment-288658" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Leonid Boytsov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-11T16:51:24+00:00">October 11, 2017 at 4:51 pm</time></a> </div>
<div class="comment-content">
<p>I agree, predictions are hard.</p>
</div>
</li>
<li id="comment-288672" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4611f83b6c5b6360f5f75084e9ee1919?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4611f83b6c5b6360f5f75084e9ee1919?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.downes.ca" class="url" rel="ugc external nofollow">Stephen Downes</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-11T21:36:03+00:00">October 11, 2017 at 9:36 pm</time></a> </div>
<div class="comment-content">
<p>Lovely post.</p>
<p>It&rsquo;s interesting, but exactly the same thing could be said of humans:<br/>
&#8211; they are not easy to implement and maintain: their aggregated data cannot be easily interpreted by the average engineer and algorithms (if any) are not easy to implement and test;<br/>
&#8211; they are not updateable on the fly;<br/>
&#8211; they are not efficient at query time: queries should be fast.</p>
<p>By contrast, humans *do* satisfy the two criteria you dropped from the original version of this post:<br/>
&#8211; they work with little data if needed;<br/>
&#8211; they are accurate within reason.</p>
</div>
<ol class="children">
<li id="comment-288680" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-12T00:07:08+00:00">October 12, 2017 at 12:07 am</time></a> </div>
<div class="comment-content">
<p>You are a bit too clever, especially because you went to see my original paper and found out that I quoted myself selectively.</p>
</div>
<ol class="children">
<li id="comment-288739" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4611f83b6c5b6360f5f75084e9ee1919?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4611f83b6c5b6360f5f75084e9ee1919?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.downes.ca" class="url" rel="ugc external nofollow">Stephen Downes</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-12T22:26:14+00:00">October 12, 2017 at 10:26 pm</time></a> </div>
<div class="comment-content">
<p>Just taking my commentary to the next level. 🙂</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-288683" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/434f10a650dac564db4cd18e78717ff6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/434f10a650dac564db4cd18e78717ff6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.singliar.info" class="url" rel="ugc external nofollow">Tomas Singliar</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-12T02:57:12+00:00">October 12, 2017 at 2:57 am</time></a> </div>
<div class="comment-content">
<p>The hype is heavy indeed. My framework for thinking about this is closed-world problems vs open-world problems.<br/>
Machine learning is closed world, artificial intelligence, is, by definition, open-world: dictionary defines intelligence as &ldquo;ability to react in new situations&rdquo;.</p>
<p>Closed-world problems (like chess or go) can and will be beaten into submission through massive power learning very wiggly models &#8211; the problem space will be sufficiently densely explored so that it becomes an interpolative ML problem dealing with &ldquo;old situations&rdquo;.</p>
<p>Open-world problems (like driving a car, or designing a meaningful data warehouse schema) will not be solved in the foreseeable future. They are extrapolative, *-intelligence problems with a large &ldquo;new situation&rdquo; content. The best we have on &ldquo;general AI&rdquo; is Douglas Hofstadter stuff, really.</p>
<p>The open-world character in conjunction with the number of 9s required is one of the reasons self-driving cars will not be in-production for another at least 10 years.</p>
</div>
</li>
<li id="comment-288690" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/148b132ec683643e1d15623209ead9f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/148b132ec683643e1d15623209ead9f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://twitter.com/trylks" class="url" rel="ugc external nofollow">trylks</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-12T05:42:46+00:00">October 12, 2017 at 5:42 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m happy to see that you didn&rsquo;t mention IBM in the list of companies. Extraordinary disclaimer: I work for a company that would like to be like IBM. I have a PhD in AI, but not in machine learning, so maybe it&rsquo;s not AI by current standards/hype.</p>
<p>Laptops are made for laps. Awkwardness is probably the most salient characteristic of academics.</p>
<p>My not-as-educated-as-I&rsquo;d-like-to guess is that DL works, but it&rsquo;s not the end of the road for AI. I hope the next steps don&rsquo;t get patented&#8230;</p>
<p>Relevant: <a href="https://xkcd.com/1838/" rel="nofollow ugc">https://xkcd.com/1838/</a></p>
<p>If you want to optimize performance in data engineering, put a bit of old AI (logic) and you will have a lot of optimization to do, to make it work again.</p>
<p>WRT AGI, IMHO it&rsquo;s the 90% syndrome. The data used is becoming bigger and bigger, we may not be getting closer at all. On the negative side, AI would be the last problem that humanity needs to solve. On the positive one, we still have to figure out many things before that day, like a way for economic transition.</p>
</div>
</li>
<li id="comment-288701" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/073f67f5295376245c787a0aa3b99842?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/073f67f5295376245c787a0aa3b99842?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michel Lemay</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-12T13:41:33+00:00">October 12, 2017 at 1:41 pm</time></a> </div>
<div class="comment-content">
<p>Nice mind-wandering post! It was nice to meet you [again] in a summit somewhere.!</p>
<p>One thing that always amaze me with deep learning is the fact that, as you mention it as well, is so brute force. What an awful amount of joules and compute dollars wasted over and over just replicating existing experiments. Can we share theses hidden layers? Can we share theses building blocks? Currently we are directly aimed at an oligopoly where only big corporations or select few research centers can afford to train theses architectures. </p>
<p>The end goal of that always seems to be human-level intelligence but are we gonna be able to reach it in a world of limited resources?</p>
</div>
<ol class="children">
<li id="comment-288705" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-12T14:21:36+00:00">October 12, 2017 at 2:21 pm</time></a> </div>
<div class="comment-content">
<p>Michel: When I started my post, I was planning to include our meeting&#8230; it would have made the story even nicer&#8230; maybe next time! We ought to coordinate to make sure to meet again!</p>
<p>Regarding power usage&#8230; We cannot build a drone that can fly as well as a bee. Yet we know that it is possible to do so while using very little power (a bee&rsquo;s brain uses barely any power at all) and very little training. This suggests that scaling up will require more than just brute force.</p>
</div>
</li>
</ol>
</li>
<li id="comment-288702" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0d5a5c6e09634c94aecf1cc6f01115ca?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0d5a5c6e09634c94aecf1cc6f01115ca?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dmitry Ganyushin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-12T13:53:59+00:00">October 12, 2017 at 1:53 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;The standard advice I provide is not to trust the academic work.&rdquo; &#8211; very nice!</p>
</div>
</li>
<li id="comment-288756" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9dff9e34098cc24c69222c87e0fac44b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9dff9e34098cc24c69222c87e0fac44b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Chris</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-13T03:45:25+00:00">October 13, 2017 at 3:45 am</time></a> </div>
<div class="comment-content">
<p>I strongly recommend Hinton&rsquo;s talk on what is wrong with convolutional neural nets: </p>
<p>(<a href="https://www.youtube.com/watch?v=rTawFwUvnLE" rel="nofollow ugc">https://www.youtube.com/watch?v=rTawFwUvnLE</a>)</p>
<p>The essential complaint is &ldquo;yes, it kind of works, if you have enough data, but we need an approach that is not so data hungry&rdquo;. He has a long, detailed and compelling example about vision, and shows what it would take to build something that has better long-term prospects, at least for vision. Part of the argument is that people do not need to see an object from all kinds of different angles before learning to recognize it, but current machine learning algorithms do need this. Something is being missed, and Hinton has a suggestion for what this is.</p>
<p>The reason I like this talk so much is that Hinton really knows the biology as well as the engineering, thinks deeply about the task, and has no need to indulge in hype.</p>
</div>
</li>
</ol>
