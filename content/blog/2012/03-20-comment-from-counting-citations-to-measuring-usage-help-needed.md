---
date: "2012-03-20 12:00:00"
title: "From counting citations to measuring usage (help needed!)"
index: false
---

[17 thoughts on &ldquo;From counting citations to measuring usage (help needed!)&rdquo;](/lemire/blog/2012/03-20-from-counting-citations-to-measuring-usage-help-needed)

<ol class="comment-list">
<li id="comment-55066" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/233a6e9188d0a9ac816afa2c497ad3f1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/233a6e9188d0a9ac816afa2c497ad3f1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://danigayo.info/PFCblog/" class="url" rel="ugc external nofollow">Daniel Gayo-Avello</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-20T17:45:07+00:00">March 20, 2012 at 5:45 pm</time></a> </div>
<div class="comment-content">
<p>I find your approach interesting but I&rsquo;m afraid you are going to collect a too sparse dataset to be useful 🙁</p>
<p>On another hand, in the form you say &ldquo;By an essential reference, we mean a reference that was highly influential or inspirational for the core ideas in your paper&rdquo;. Unfortunately, I respectfully disagree with this being the only way of finding great papers and/or better metrics for influence in other researchers. </p>
<p>First of all, not always a paper&rsquo;s influence is so strong in another paper; specially as time goes by and some influential papers are considered basic literature that must be cited just to provide context for a current work but not because they are &ldquo;inspirational&rdquo; for that work.</p>
<p>Secondly, some papers do not have any inspiration, they simply appear out of thin air. In this sense you have mentioned John Nash since his PhD dissertation is a great example of this: 2 reference, 1 is a self-cite 🙂</p>
<p>In my first reading of this post I thought &ldquo;why don&rsquo;t they use PageRank or a similar algorith to compute that&rdquo;. Now I&rsquo;ve found the comment about eigenfactor.org. That approach is quite interesting *but* I simply don&rsquo;t like the idea of computing the score for journals, why not compute it for individual papers?</p>
<p>In fact, I think that would be a rather sensible approach: a relevant/interesting/influential paper would be a paper cited by many relevant/interesting/influential papers.</p>
<p>In other words, once such a score was computed for all of the papers you can find the most influential papers cited by any paper and the most influential papers citing one paper.</p>
<p>*And* with that information you could train a ML method to &ldquo;distinguish&rdquo; between the context surrounding cites to the papers which have been really influential in a given work and the context surrounding the supportive cites.</p>
<p>Needless to say, there are tons of details missing here and it wouldn&rsquo;t be as easy as I assume but I&rsquo;d give it a try (provided the citation graph data was available).</p>
</div>
</li>
<li id="comment-55062" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-20T12:55:28+00:00">March 20, 2012 at 12:55 pm</time></a> </div>
<div class="comment-content">
<p>Applying an ML algorithm is all about building good features. In, IR, for instance, it took decades. Considering how controversial this issue is, I would predict that it will take at least 10 years. Besiders, to come up with good features, you will probably have to do some nontrivial NLP.</p>
</div>
</li>
<li id="comment-55063" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-20T13:05:53+00:00">March 20, 2012 at 1:05 pm</time></a> </div>
<div class="comment-content">
<p>@Itman</p>
<p>Sure but there is already some research on this going back to 2000 or even slightly before. Some people even published a Weka-based open source tool for this problem (circa 2010). So it is not exactly like we have no clue on what to do. However, it has remained a relatively obscure topic. I hope we change that.</p>
<p>But ok, it could take more than two years before it becomes mainstream. I can dream though, can&rsquo;t I?</p>
</div>
</li>
<li id="comment-55069" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/233a6e9188d0a9ac816afa2c497ad3f1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/233a6e9188d0a9ac816afa2c497ad3f1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://danigayo.info/PFCblog/" class="url" rel="ugc external nofollow">Daniel Gayo-Avello</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-20T18:43:13+00:00">March 20, 2012 at 6:43 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,</p>
<p>Regarding 1 and 4. Maybe I&rsquo;m too stubborn but a citation graph would be a great asset in addition to the dataset you are planning to collect.</p>
<p>Regarding 2. My fault, you did not mention a better metric. It&rsquo;s me who&rsquo;s thinking of the need for better metrics 🙂</p>
<p>And yes, I hope to find time soon to complete the form 🙂 </p>
<p>Best, Dani</p>
</div>
</li>
<li id="comment-55064" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/76b44c7bca8bbfde592937ad891d7140?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/76b44c7bca8bbfde592937ad891d7140?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.ocam.cl" class="url" rel="ugc external nofollow">Alejandro Weinstein</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-20T14:47:16+00:00">March 20, 2012 at 2:47 pm</time></a> </div>
<div class="comment-content">
<p>* Are you familiar with <a href="http://www.eigenfactor.org/" rel="nofollow ugc">http://www.eigenfactor.org/</a> ?</p>
<p>It seems to be quite related to what you&rsquo;re talking about.</p>
<p>* I don&rsquo;t know how much sense it makes, and how much biased it might be, but I think the people from Mendeley (www.mendeley.com) are in a good position to evaluate paper popularity in a more precise way. They already show some rankings based on how many people have a paper in their library, but I guess you can go beyond that and see how much time people actually spent reading the paper.</p>
<p>If interested, you may want to contact this guy from Mendeley:</p>
<p><a href="https://plus.google.com/114096599366011465749/posts" rel="nofollow ugc">https://plus.google.com/114096599366011465749/posts</a></p>
</div>
</li>
<li id="comment-55065" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-20T14:57:45+00:00">March 20, 2012 at 2:57 pm</time></a> </div>
<div class="comment-content">
<p>@Alejandro</p>
<p>Yes, I have been a member of Mendeley ever since it started. There are many initiatives to measure the overall impact of a research paper, including counting the number of downloads&#8230; the number of times the paper is mentioned, and so on. But my specific interest on &ldquo;meaningful&rdquo; citations goes beyond measuring the &ldquo;importance&rdquo; of a research paper.</p>
</div>
</li>
<li id="comment-55068" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-20T18:18:57+00:00">March 20, 2012 at 6:18 pm</time></a> </div>
<div class="comment-content">
<p>@Daniel</p>
<p>1) Really, I should stress that all I am doing is taking the initiative, with the help of others, of building a data set that I think researchers (including myself, perhaps) would find useful in their own research. I do this because I am genuinely interested in the tools that might be constructed based on this research.</p>
<p>2) I am not proposing some &ldquo;better metric&rdquo;. I am merely proposing that we make more mainstream the identification of meaningful references.</p>
<p>By analogy, in the context of the web, that&rsquo;s like arguing that we should differentiate meaningful links from shallow links by analyzing the text of the web pages. That, in itself, does not tell you how to rank web pages.</p>
<p>3) I am not solely interested in recognizing influential work.</p>
<p>4) I am not sure what you mean by &ldquo;too sparse&rdquo;? I guess you are thinking in a graph theoretical sense? The result of this project will not be a graph.</p>
<p>I hope you will contribute to the data set. I expect you might be one of the researchers who might benefit from this data set.</p>
</div>
</li>
<li id="comment-55070" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-20T19:09:52+00:00">March 20, 2012 at 7:09 pm</time></a> </div>
<div class="comment-content">
<p>@Daniel</p>
<p>We feel that the authors should provide this information, because it is difficult for an independent expert to make the assessment reliably.</p>
</div>
</li>
<li id="comment-55071" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/233a6e9188d0a9ac816afa2c497ad3f1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/233a6e9188d0a9ac816afa2c497ad3f1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://danigayo.info/PFCblog/" class="url" rel="ugc external nofollow">Daniel Gayo-Avello</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-21T07:35:35+00:00">March 21, 2012 at 7:35 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve just completed the form. </p>
<p>I must confess that I see things from a different perspective now. Certainly, there are a huge number of papers which are supportive for one&rsquo;s work and a few which are really relevant (or meaningful in your wording).</p>
<p>I&rsquo;m now really curious to know whether ML methods will be able to tell apart one kind of citation from another.</p>
<p>Good luck in this endeavor.</p>
<p>Best, Dani</p>
</div>
</li>
<li id="comment-55072" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0323030ba08b06021422307cf679d5c8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0323030ba08b06021422307cf679d5c8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Charlie</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-21T08:23:46+00:00">March 21, 2012 at 8:23 am</time></a> </div>
<div class="comment-content">
<p>A subject close to my heart, although I am not much for publishing my work&#8230;<br/>
Years ago, I found that the best filter for finding relevant information on a subject new to me was what I have often referred to as the &ldquo;inverse frequency&rdquo; filter- an author that is publishing too frequently generally is contributing nothing new to the body of knowledge on a given subject- just rehashing historical results. On the other hand, an author that publishes at most once or twice a year, or, even better, once every couple of years, is more likely going to provide new and useful information.</p>
<p>In the past, frequency of citation has been useful, but it seems the system is being gamed these days, and the fact that a certain author is frequently cited may be more an indication of how many &ldquo;agreements&rdquo; he has for mutual citations (or how strongly a particular publisher is promoting his work). Finding good technical literature is getting as hard as finding pertinent information on the public Internet!</p>
<p>When one is familiar with a topic, one can quickly identify the key contributors to the knowledge base. However, when one is investigating a new field of interest or endeavor, sorting the wheat from the chafe is a daunting task. I don&rsquo;t have time to read 10,000 papers (or even scan 10,000 bibliographies of published papers) to find the information crucial to my understanding of a subject. Therefore, any viable filter that can identify to true innovators would be of significant value to me personally (a service I would even willingly pay for!).</p>
<p>Citation frequency is probably a better measure of the worth of a reference document than the author&rsquo;s frequency of publication, but, as you point out, there is a crying need for some weighting measure to identify crucial, meaningful work&#8230;</p>
</div>
</li>
<li id="comment-55073" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6537c0a681d22d4a3f7bf4ce7d209a0f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6537c0a681d22d4a3f7bf4ce7d209a0f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Suresh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-21T10:51:43+00:00">March 21, 2012 at 10:51 am</time></a> </div>
<div class="comment-content">
<p>One interesting heuristic that a colleague of mine had proposed was to overweight citations within the meat of the paper, as opposed to those in the related work. It would be interesting to see if the data you collect has anything to say about this.</p>
</div>
</li>
<li id="comment-55074" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-21T14:38:32+00:00">March 21, 2012 at 2:38 pm</time></a> </div>
<div class="comment-content">
<p>@Suresh</p>
<p>I agree. There are many simple heuristics which could be surprisingly accurate.</p>
</div>
</li>
<li id="comment-55087" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9dc8783d8ff42565db30cc90e29ad01c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9dc8783d8ff42565db30cc90e29ad01c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.carlboettiger.info/" class="url" rel="ugc external nofollow">Carl</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-22T14:52:15+00:00">March 22, 2012 at 2:52 pm</time></a> </div>
<div class="comment-content">
<p>Are you familiar with the citation ontology (CiTO)? <a href="http://speroni.web.cs.unibo.it/cgi-bin/lode/req.py?req=http:/purl.org/spar/cito#introduction" rel="nofollow ugc">http://speroni.web.cs.unibo.it/cgi-bin/lode/req.py?req=http:/purl.org/spar/cito#introduction</a></p>
<p>This provides an ontology for turning citations into linked data &#8212; i.e. the reason for the citation (supports, refutes, uses methods from, etc) is encoded in markup around the citation, so it doesn&rsquo;t have to be guessed from the context by machine learning. Long-term this is surely a better solution, though until publishers adopt this standard, machine-learning algorithms such as yours may be the best we can do. Perhaps cito-marked up papers could be used as a training set?</p>
</div>
</li>
<li id="comment-55094" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://nova.apperceptual.com/" class="url" rel="ugc external nofollow">Peter Turney</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-23T10:23:39+00:00">March 23, 2012 at 10:23 am</time></a> </div>
<div class="comment-content">
<p>@Carl Very interesting. Thanks!</p>
</div>
</li>
<li id="comment-55110" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/937655a75eb3f0fd943151f4e5ab5167?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/937655a75eb3f0fd943151f4e5ab5167?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://iproc.ru" class="url" rel="ugc external nofollow">Anton</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-25T02:03:01+00:00">March 25, 2012 at 2:03 am</time></a> </div>
<div class="comment-content">
<p>Lets say, for example, that Russian paper cites Chinese paper. It will be hard for automatic system to analyse that.</p>
<p>For example, Google Scholar is very weak at analysing Russian papers. It lists only about 20% of them and correcly shows only about 10% of citations.</p>
</div>
</li>
<li id="comment-231097" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f28d38430aa19897d8cc35708f49ffc1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f28d38430aa19897d8cc35708f49ffc1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://scholar.google.co.il/citations?user=uDx2ItYAAAAJ&#038;hl=en" class="url" rel="ugc external nofollow">Dan</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-03-08T09:02:54+00:00">March 8, 2016 at 9:02 am</time></a> </div>
<div class="comment-content">
<p>Do you plan to make the feature extraction code, and the processed data (i.e the data with extracted features) available?<br/>
The linked-to &ldquo;Dataset&rdquo; is just the questionaire with links to the papers. </p>
<p>Thanks!</p>
</div>
<ol class="children">
<li id="comment-231128" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-03-08T14:09:45+00:00">March 8, 2016 at 2:09 pm</time></a> </div>
<div class="comment-content">
<p>I cannot release the software as I did not write it, but you can contact the first author of our study about it: <a href="http://www.xiaodanzhu.com/about.html" rel="nofollow ugc">http://www.xiaodanzhu.com/about.html</a> He might be able to help.</p>
</div>
</li>
</ol>
</li>
</ol>
