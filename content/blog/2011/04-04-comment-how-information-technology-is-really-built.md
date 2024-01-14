---
date: "2011-04-04 12:00:00"
title: "How information technology is really built"
index: false
---

[16 thoughts on &ldquo;How information technology is really built&rdquo;](/lemire/blog/2011/04-04-how-information-technology-is-really-built)

<ol class="comment-list">
<li id="comment-54333" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">jld</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-04-04T23:09:42+00:00">April 4, 2011 at 11:09 pm</time></a> </div>
<div class="comment-content">
<p>Thus you gave up <a href="https://existentialtype.wordpress.com/" rel="nofollow">hard core computer science</a>?</p>
</div>
</li>
<li id="comment-54335" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-04-05T07:41:17+00:00">April 5, 2011 at 7:41 am</time></a> </div>
<div class="comment-content">
<p>@jld</p>
<p>Not sure what you mean. This blog post is right in line with a lot of things I have been writing about for a long time, including NoSQL, recommender systems and the failures of formal conceptual design.</p>
</div>
</li>
<li id="comment-54336" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-04-05T08:41:35+00:00">April 5, 2011 at 8:41 am</time></a> </div>
<div class="comment-content">
<p>@mt</p>
<p>This is indeed a nice story about how to sustain creativity.</p>
</div>
</li>
<li id="comment-54334" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bf8347dfa47065b025211e29a565c857?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bf8347dfa47065b025211e29a565c857?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">mt</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-04-05T06:34:12+00:00">April 5, 2011 at 6:34 am</time></a> </div>
<div class="comment-content">
<p>A similar tale just came out yesterday by the folks at github:</p>
<p><a href="http://zachholman.com/posts/why-github-hacks-on-side-projects/" rel="nofollow ugc">http://zachholman.com/posts/why-github-hacks-on-side-projects/</a></p>
<p>Another good story.</p>
</div>
</li>
<li id="comment-54338" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-04-05T17:44:48+00:00">April 5, 2011 at 5:44 pm</time></a> </div>
<div class="comment-content">
<p>@Justin</p>
<p><em>â€œMethodologyâ€ is a tool, and like any tool has to be applied sanely.</em></p>
<p>Absolutely. And this means rejecting a methodology if it fails you.</p>
<p><em>I have a feeling that the examples are not universally applicable. (&#8230;) I really wouldn&rsquo;t want lost updates, data races et al in my banking or medical informatics application.</em></p>
<p>Working for a bank is very different than working for Facebook. But I submit to you that banks are also susceptible to disruptive innovation. They have to be conservative, but they have to keep up with the pace of technology and offer things like micro-transactions, otherwise others will.</p>
<p>One of the reason I chose the bank I am with is that they have a decent web site, with cool features that other banks did not implement, possibly because they are too conservative. This must be a trade-off for my bank: each one of these features is a security risk.</p>
<p>In any case, banking systems are largely built around eventual consistency, not strong consistency. If someone pays someone else, but it takes time to check whether the payment can actually be made, you record the transaction (optimistically) but flag it as frozen for a time. Optimistic transactions are just one way to deal with possible inconsistencies. Several NoSQL engines use this model.</p>
<p>Moreover, a lot data recorded by banks is of lesser importance. Surely, a banking system needs a web log to detect fraud. But does this web log need to be ACID? Probably not.</p>
<p>A good engineer working for a bank would identify the critical paths and prove that the system cannot leak any money over time. However, you cannot <strong>not</strong> have exceptions. So you probably want to build a system that can respond to exceptions without freezing everything. Moreover, the good engineer would also identify the right accessibility/consistency trade-off. He would not require ACID compliance of everything.</p>
<p>As for the medical systems, at least in Canada, they are already quite a bit lossy. If you undergo a test, there is little check to make sure it ever makes it to your doctor. Papers move around, but mistakes are made all the time. An eventually consistent electronic system would be far superior to the current setup.</p>
<p>Let me offer you a scenario. A laboratory has uploaded a bunch of tests to your record, which includes a financial transaction. For strong consistency, there must be a financial transaction for each medical test. Yet there is a problem with your bill and the system refuses it (maybe your billing account was wrong). Do you want to abort the whole transaction? This would only allow your doctor to have access to the data when you billing account would be back in good standing. Possibly, this could delay a diagnostic and result in your death. Surely, that is not what we want. So ACID compliance is not required, not for the entire system.</p>
<p>So a good engineer working on medical systems would differentiate between the critical operations and the non-critical ones.</p>
</div>
</li>
<li id="comment-54337" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fcf5054b638e8f76eb84507c08df83fd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fcf5054b638e8f76eb84507c08df83fd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Justin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-04-05T16:42:46+00:00">April 5, 2011 at 4:42 pm</time></a> </div>
<div class="comment-content">
<p>I have a feeling that the examples are not universally applicable.</p>
<p>IMHO, Facebook can trade-off consistency because the value of the data is not critical. I really wouldn&rsquo;t want lost updates, data races et al in my banking or medical informatics application.</p>
<p>&ldquo;Methodology&rdquo; is a tool, and like any tool has to be applied sanely.</p>
</div>
</li>
<li id="comment-54339" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e17720df4dd03f6d39bd994cbd8ac0da?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e17720df4dd03f6d39bd994cbd8ac0da?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://raynux.com/" class="url" rel="ugc external nofollow">Md. Rayhan Chowdhury</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-04-06T01:19:21+00:00">April 6, 2011 at 1:19 am</time></a> </div>
<div class="comment-content">
<p>Wow, what a great post! thanks for explaining such a nice idea. These are not commonly shared among end users..</p>
</div>
</li>
<li id="comment-54340" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e84a89ae299286875a316f9d3fc04077?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e84a89ae299286875a316f9d3fc04077?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://prekopcsak.hu" class="url" rel="ugc external nofollow">Preko</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-04-06T03:57:51+00:00">April 6, 2011 at 3:57 am</time></a> </div>
<div class="comment-content">
<p>This was an excellent read, including the comments too, thanks.</p>
</div>
</li>
<li id="comment-54341" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b0e19d9b09887c1660a86e5f05aa7c35?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b0e19d9b09887c1660a86e5f05aa7c35?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cristian Gonzalez</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-04-07T10:00:46+00:00">April 7, 2011 at 10:00 am</time></a> </div>
<div class="comment-content">
<p>Agree partially, we could also add the level of uncertainty into which many web companies are involved when re-defining the business along with the wind&rsquo;s change, as the lack of knowledge about the user, I mean compared to traditional known and more stable user requirements over intranet systems. So if we focus only facebook and youtube then we&rsquo;ll have a very biased perspective of the whole IT situation. Smaller teams have better sinergy and less risks than bigger teams, where structured and conservative approaches attempt to handle the situation.</p>
</div>
</li>
<li id="comment-54343" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-04-07T23:06:50+00:00">April 7, 2011 at 11:06 pm</time></a> </div>
<div class="comment-content">
<p>@Bob</p>
<p><em>There&rsquo;s a whole literature on this kind of thing under the headings extreme and agile programming.</em></p>
<p>True. Agile programming is closely related. But I never paid much attention because I think it is more of a social awakening than an intellectual discovery. Was any good software developer unaware of the ideas expressed by the Manifesto for Agile Software Development? I think people have been doing agile programming well before the term was coined. I certainly was.</p>
<p>I was maybe most inspired by Fred Brooks who is probably the person who spent most time writing and talking about real-world system design. His latest book is well worth the price tag. You can see my short review here:<br/>
<a href="https://lemire.me/blog/archives/2010/04/13/on-the-design-of-design/" rel="ugc">http://lemire.me/blog/archives/2010/04/13/on-the-design-of-design/</a></p>
<p><em>PS: Could I write â€œdecemâ€ as the response to â€œSum of Ã»nus plus novem?â€? I played it safe and went with â€œ10â€³. Being able to write â€œXâ€ would be cool, too.</em></p>
<p>Maybe for version 2.0.</p>
</div>
</li>
<li id="comment-54342" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/57058fc9812bc7b090fbb1fbc4746b0e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/57058fc9812bc7b090fbb1fbc4746b0e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://lingpipe-blog.com/" class="url" rel="ugc external nofollow">Bob Carpenter</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-04-07T22:11:19+00:00">April 7, 2011 at 10:11 pm</time></a> </div>
<div class="comment-content">
<p>There&rsquo;s a whole literature on this kind of thing under the headings extreme and agile programming. The so-called software engineers (aka architecture astronauts) have an even larger competing literature on process. </p>
<p>Even for a large project, the biggest reason to not front-load design too much is that a little prototyping can go a long way in clarifying a design and reducing risk by evaluating how some things can work in a more realistic setting than a whiteboard or UML diagram. </p>
<p>The second biggest reason is so that management can see something concrete and not cancel you and/or the project before it gets off the ground. There&rsquo;s no argument for feasibility like a demo, even if it&rsquo;s a prototype.</p>
<p>PS: Could I write &ldquo;decem&rdquo; as the response to &ldquo;Sum of Ã»nus plus novem?&rdquo;? I played it safe and went with &ldquo;10&rdquo;. Being able to write &ldquo;X&rdquo; would be cool, too.</p>
</div>
</li>
<li id="comment-54345" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-04-11T17:29:27+00:00">April 11, 2011 at 5:29 pm</time></a> </div>
<div class="comment-content">
<p>@Jakob </p>
<p><em> But they have also been created this way before!<br/>
</em></p>
<p>True, but the question I ask is why are they created this way? We have formal methods that should work. Why do they appear to fail? They appear to fail more dramatically since the end of the nineties. Why is that? I identified two elements which help answer partially the question: sophisticated users and distributed computers.</p>
<p><em> â€œPost-methodologicalâ€ sounds like just playing around without thinking. (&#8230;) But I strongly doubt that good designers do not have methodology. It needs creativity *and* expertise in methods to build great systems.</em></p>
<p>People will always use some methodology to get work done. What Avison and Fitzgerald meant is that there is now a great diversity of methodologies, including informal ones. Certainly, some organizations (e.g., Amazon or Facebook) have their own methodologies.</p>
</div>
</li>
<li id="comment-54344" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a076154395aedaa4ca81f31067b7de1b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a076154395aedaa4ca81f31067b7de1b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://jakoblog.de/" class="url" rel="ugc external nofollow">Jakob</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-04-11T16:34:23+00:00">April 11, 2011 at 4:34 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for the interesting summary. Yes it is right to stress how systems are actually created. But they have also been created this way before! Agile programming is just one example. About the general limits of formal conceptual methodologies you are right too, but often some more informal conceptual methodologies would still help. &ldquo;Post-methodological&rdquo; sounds like just playing around without thinking. To some degree this is also important to experiment. But I strongly doubt that good designers do not have methodology. It needs creativity *and* expertise in methods to build great systems.</p>
</div>
</li>
<li id="comment-54346" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b0e19d9b09887c1660a86e5f05aa7c35?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b0e19d9b09887c1660a86e5f05aa7c35?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://hadooper.blogspot.com" class="url" rel="ugc external nofollow">Cristian</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-04-11T18:39:41+00:00">April 11, 2011 at 6:39 pm</time></a> </div>
<div class="comment-content">
<p>Clearly, in human processes the last word will never be pronounced, we always need to customize our own ways, we&rsquo;re not a machine with a behaviour to standarize. There&rsquo;s no final methodology. Is so wrong to think of working without organization, as is wrong to completely follow a methodology, this looks pretty absurd to debate.<br/>
We&rsquo;re just talking about how trends and experience leads us to smoothly evolution, cause we dont buy flying pigs anymore..</p>
</div>
</li>
<li id="comment-54349" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/660b6c2c690930bbc509a72d3cc25fe2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/660b6c2c690930bbc509a72d3cc25fe2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alain DÃ©silets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-04-19T12:58:46+00:00">April 19, 2011 at 12:58 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m not ready yet to predict the demise of methodology, but I can say that personally, I have always preferred &ldquo;craftmanship&rdquo; to methodologies. </p>
<p>The interesting thing about craftmanship is that:</p>
<p>* It can be formalized into a bunch of simple rules and tricks<br/>
* But it is not as monolithic as a methodology. You can cherry pick the tricks that are appropriate for you.</p>
<p>This is why I really like Agile &ldquo;methodologies&rdquo;. Extreme Programming in particular, is more a collection of &ldquo;habits of highly successful software teams&rdquo; than it is an actual methodology.</p>
</div>
</li>
<li id="comment-299585" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8aa2420d9a6398c1025777132c1ecab3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8aa2420d9a6398c1025777132c1ecab3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://dbmsall.blogspot.in/" class="url" rel="ugc external nofollow">rahul Singodiya</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-29T18:21:55+00:00">March 29, 2018 at 6:21 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m not ready yet to predict the demise of methodology, but I can say that personally, I have always preferred â€œcraftmanshipâ€ to methodologies.</p>
<p>The interesting thing about craftmanship is that:</p>
<p>It can be formalized into a bunch of simple rules and tricks<br/>
But it is not as monolithic as a methodology. You can cherry pick the tricks that are appropriate for you.</p>
</div>
</li>
</ol>
