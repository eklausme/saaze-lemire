---
date: "2007-07-27 12:00:00"
title: "Scalable Web Development"
index: false
---

[4 thoughts on &ldquo;Scalable Web Development&rdquo;](/lemire/blog/2007/07-27-scalable-web-development)

<ol class="comment-list">
<li id="comment-49422" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ab82fd8b5ffe4d09c2bb5f9c14d34b09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ab82fd8b5ffe4d09c2bb5f9c14d34b09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Parand</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-07-27T21:05:28+00:00">July 27, 2007 at 9:05 pm</time></a> </div>
<div class="comment-content">
<p>That sounds like a very good course. Many aspects of scale are hard to capture with simulations and tests; perhaps you can find a heavily used service in the university and test the implementations on that. </p>
<p>Note that Java does have its place in scaling discussions; programs written in Java can scale well, and some of the most exciting new directions involve hosting dynamic languages in the JVM (eg. RonR with JRuby).</p>
</div>
</li>
<li id="comment-49423" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.oshineye.com" class="url" rel="ugc external nofollow">ade</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-07-29T12:19:04+00:00">July 29, 2007 at 12:19 pm</time></a> </div>
<div class="comment-content">
<p>This would be a good course but you&rsquo;re missing a few essential elements of scalability. Firstly it&rsquo;s vital that you talk about maintainability both in terms of how easy it is to change your application as well as how easy it is to look after the application once it&rsquo;s in a production environment.<br/>
You&rsquo;re also missing the distributed computing perspective that Verner Wogels is always emphasising: handling component/machine failure, distributed consensus, monitoring etc. The job description here is highly educational: <a href="http://www.allthingsdistributed.com/2007/07/job_opening_for_a_senior_resea.html" rel="nofollow ugc">http://www.allthingsdistributed.com/2007/07/job_opening_for_a_senior_resea.html</a></p>
</div>
</li>
<li id="comment-49424" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d4e425f808f4af5407c837e0aeb8d232?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d4e425f808f4af5407c837e0aeb8d232?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.afroginthevalley.com/" class="url" rel="ugc external nofollow">Sylvain Carle</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-07-30T18:12:42+00:00">July 30, 2007 at 6:12 pm</time></a> </div>
<div class="comment-content">
<p>Développement d&rsquo;application web Ã  déploiement massif?</p>
<p>Sounds lame a bit. </p>
<p>Anyhow, Building Scalable Websites (the Flickr Way) by Cal Henderson published by Oreilly should be required reading.</p>
<p>PS. your spam &ldquo;captcha&rdquo; is so bad, I *almost* decided not to post (no, I am not that bad with roman numerals or math, but mixing the two is evil!)</p>
</div>
</li>
<li id="comment-49431" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4ba3e4c5c0e1ac65d5ff8fd6df326060?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4ba3e4c5c0e1ac65d5ff8fd6df326060?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://robin.millette.info/" class="url" rel="ugc external nofollow">Robin</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-08-04T23:57:58+00:00">August 4, 2007 at 11:57 pm</time></a> </div>
<div class="comment-content">
<p>Hi, I hadn&rsquo;t been here in a while, glad to see you&rsquo;ve kept the pace (or place?). Today I mentionned collaborative filtering in a post and somehow it reminded me of you, so here I am.</p>
<p>D&rsquo;aprÃ¨s le Grand dictionnaire ( <a href="http://granddictionnaire.com/" rel="nofollow ugc">http://granddictionnaire.com/</a> ), on peut traduire scalability par extensibilité, mÃªme si, dans l&rsquo;usage courant, extensibilité a une signification plus large (disons que le mot est scalable 😉</p>
<p>On pourrait traduire par Développement web extensible (ou programmation, mais je préfÃ¨re le mot &ldquo;développement&rdquo; en général).</p>
<p>Définition :<br/>
Aptitude d&rsquo;un service Ã  augmenter ou Ã  diminuer son niveau de performance et ses coÃ»ts pour répondre aux changements dans la capacité de production ou dans la demande.</p>
<p>I tried finding other source to translate the term but like you, I came back empty handed.</p>
<p>I&rsquo;d also touch on the subject of samples and standard deviations. Very often, we generate random data or run a few tests with no clue about their distribution.</p>
<p>Anyhow, it sounds like a much needed course. I&rsquo;d skip anything to do specifically with facebook though, but map reduce is essential I think.</p>
<p>P.S.: Sylvain, the captcha is much better then what used to be served here. And I was lucky enough a simple concatenation worked on my test. Try that with arabic with all numbers </p>
</div>
</li>
</ol>
