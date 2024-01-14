---
date: "2016-03-03 12:00:00"
title: "Statistics is overrated: the rise of data science"
index: false
---

[9 thoughts on &ldquo;Statistics is overrated: the rise of data science&rdquo;](/lemire/blog/2016/03-03-statistics-is-overrated-the-rise-of-data-science)

<ol class="comment-list">
<li id="comment-230528" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/272a350fbff4308ac6a1181be4f56e88?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/272a350fbff4308ac6a1181be4f56e88?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">James</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-03-03T21:22:31+00:00">March 3, 2016 at 9:22 pm</time></a> </div>
<div class="comment-content">
<p>I would halfway disagree. Yes, some branches of classical statistics are ripe for takeover. That doesn&rsquo;t mean that there&rsquo;s not great theoretical work going on in statistics. What is the best prior to put on a complicated distribution? is an example of a question where stats remains relevant. However, from an applied perspective, I think that statistics without data analysis is at best marginally useful.</p>
</div>
</li>
<li id="comment-230533" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8af88bac916c9bf3f45831c114d30b0e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8af88bac916c9bf3f45831c114d30b0e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://iki.fi/jouni.siren/" class="url" rel="ugc external nofollow">Jouni</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-03-03T21:39:52+00:00">March 3, 2016 at 9:39 pm</time></a> </div>
<div class="comment-content">
<p>There seem to be to largely separate fields called &ldquo;statistics&rdquo;. One is the classical statistics, which has its roots in the social sciences, and which is also widely used in medicine.</p>
<p>Another, more computational field, has been prominent since at least the 90s. Some of its practicioners call themselves statisticians, while others prefer to be called mathematicians, computer scientists, physicists, or electrical engineers. Regardless of what they call themselves, everyone seems to be doing more or less the same thing. As far as I undertand, &ldquo;data science&rdquo; is supposed to be a new name for this field of computational statistics, though it sounds more like marketing BS in the same way as &ldquo;big data&rdquo;.</p>
</div>
</li>
<li id="comment-230560" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/224bdce23ff5bdc1d79517fb512665cb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/224bdce23ff5bdc1d79517fb512665cb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tom Dietterich</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-03-04T03:47:28+00:00">March 4, 2016 at 3:47 am</time></a> </div>
<div class="comment-content">
<p>With all due respect, you need to do some reading about inductive inference and the history of science. The goal of statistical inference is to draw conclusions about the real world from data, whereas in computer science, we are mostly just interested in exploiting statistical regularities to make predictions, filter spam, and so on. You had better hope that the people doing medical research are performing randomized trials and controlling for the type I errors of their causal inferences. Statistics did NOT start in the social sciences, although social science is where statistics are most commonly abused. Statistics started in physics and chemistry, but took its biggest leaps in agricultural research under R. A. Fisher. Recommended blogs: Andrew Gelman (<a href="http://andrewgelman.com/" rel="nofollow ugc">http://andrewgelman.com/</a>) and Deborah Mayo (<a href="http://errorstatistics.com/" rel="nofollow ugc">http://errorstatistics.com/</a>).</p>
</div>
<ol class="children">
<li id="comment-230624" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-03-04T15:18:37+00:00">March 4, 2016 at 3:18 pm</time></a> </div>
<div class="comment-content">
<p>I am long time follower of Andrew Gelman and he referenced my own blog on at least one occasion.</p>
<p>Medical research is a mess specifically because of statistics.</p>
</div>
<ol class="children">
<li id="comment-254993" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c2cc7e263a46df3e8498057778df8fe7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c2cc7e263a46df3e8498057778df8fe7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-08T09:36:16+00:00">October 8, 2016 at 9:36 am</time></a> </div>
<div class="comment-content">
<p>Hi, Daniel! I&rsquo;m interested in more of what you have to say regarding Statistics making medical research a mess. Can you please elaborate? I am intending on getting my Statistics degree in medical research&#8211; but am having doubts myself in terms of its efficacy. I would love to get your opinion.</p>
</div>
<ol class="children">
<li id="comment-255027" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-08T15:55:54+00:00">October 8, 2016 at 3:55 pm</time></a> </div>
<div class="comment-content">
<p>Please look up work by John Ioannidis starting by &ldquo;Why Most Published Research Findings Are False&rdquo;.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-230649" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8af88bac916c9bf3f45831c114d30b0e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8af88bac916c9bf3f45831c114d30b0e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://iki.fi/jouni.siren/" class="url" rel="ugc external nofollow">Jouni</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-03-04T19:14:09+00:00">March 4, 2016 at 7:14 pm</time></a> </div>
<div class="comment-content">
<p>Where do you think the word &ldquo;statistics&rdquo; comes from? Its literal meaning is something like &ldquo;(the science) of the state&rdquo;.</p>
<p>Statistics started as the study of demographic and economic data, and later widened its scope to the gathering and analysis of data in general. Because of this legacy, some traditional universities still place statistics in the Faculty of Social Sciences.</p>
</div>
</li>
</ol>
</li>
<li id="comment-232964" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3e82a30171dec55a7b72eef852056fb1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3e82a30171dec55a7b72eef852056fb1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Visgean Skeloru</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-03-22T17:57:58+00:00">March 22, 2016 at 5:57 pm</time></a> </div>
<div class="comment-content">
<p>Well your conclusion seems to very much depend where you draw the line between statistics and data science. At least for some it is the same thing.</p>
</div>
</li>
<li id="comment-296881" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5821cef1d0440f892d46d20754270d76?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5821cef1d0440f892d46d20754270d76?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">DataSage</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-02-15T11:34:25+00:00">February 15, 2018 at 11:34 am</time></a> </div>
<div class="comment-content">
<p>Stupid you are not. But ignorant and stupid, this blog post is. Arrogant and prideful, you are. You want to throw the baby out with the bath water. Computer scientist, I am, but sadly some computer scientists let it go to their head and start trashing other fields that they fully not understand. If people don&rsquo;t know what a p-value is, that says more about them than about statistics. Common sense.</p>
</div>
</li>
</ol>
