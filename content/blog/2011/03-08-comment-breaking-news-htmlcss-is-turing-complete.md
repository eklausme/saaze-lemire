---
date: "2011-03-08 12:00:00"
title: "Breaking news: HTML+CSS is Turing complete"
index: false
---

[29 thoughts on &ldquo;Breaking news: HTML+CSS is Turing complete&rdquo;](/lemire/blog/2011/03-08-breaking-news-htmlcss-is-turing-complete)

<ol class="comment-list">
<li id="comment-54251" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4ca67c5e98323c3bb628f4f815de762e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4ca67c5e98323c3bb628f4f815de762e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.hugedomains.com/domain_profile.cfm?d=leduotang&#038;e=com" class="url" rel="ugc external nofollow">Sylvain HallÃ©</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-03-08T19:10:58+00:00">March 8, 2011 at 7:10 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;Does it rely on specific features of CSS3 and HTML5? Were previous versions of HTML+CSS also Turing complete?&rdquo;</p>
<p>My guess: the CSS in the example uses the -nth-of-type(ax+b) pseudo class, which applies to every (ax+b) child, where a and b are constants and by taking x=0, 1, &#8230; So the CSS can count arbitrary numbers and even perform elementary arithmetic.</p>
<p>This pseudo-class is new to CSS3, see:<br/>
<a href="http://www.w3.org/TR/css3-selectors/#nth-of-type-pseudo" rel="nofollow ugc">http://www.w3.org/TR/css3-selectors/#nth-of-type-pseudo</a></p>
</div>
</li>
<li id="comment-54258" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6bff78c6f2a5cc3c893bd8bb9adfdf59?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6bff78c6f2a5cc3c893bd8bb9adfdf59?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://mobile.twitter.com/siah" class="url" rel="ugc external nofollow">Siah</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-03-09T01:23:19+00:00">March 9, 2011 at 1:23 am</time></a> </div>
<div class="comment-content">
<p>Is SQL Turing complete? I doubt it.</p>
</div>
<ol class="children">
<li id="comment-242694" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6bdbf84217f83ae9ca19cebef684f0ff?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6bdbf84217f83ae9ca19cebef684f0ff?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">balping</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-05-29T21:25:35+00:00">May 29, 2016 at 9:25 pm</time></a> </div>
<div class="comment-content">
<p>Yes, it is. You can have variables, you have if-else structure, you can define loops, even functions and methods. What else would you need?</p>
</div>
<ol class="children">
<li id="comment-262605" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/65fd14e20c73bb18674a8d3c99268ab9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/65fd14e20c73bb18674a8d3c99268ab9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Praveen Kumar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-16T06:11:24+00:00">December 16, 2016 at 6:11 am</time></a> </div>
<div class="comment-content">
<p>It is not purely SQL but it is PL/SQL or T-sql which has all the features you mentioned. So, SQL is not Turing complete but pl/SQL and T-sql are.</p>
</div>
<ol class="children">
<li id="comment-263044" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-19T20:33:31+00:00">December 19, 2016 at 8:33 pm</time></a> </div>
<div class="comment-content">
<p>The SQL standard itself is Turing complete.</p>
</div>
</li>
<li id="comment-285097" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6bb92b9ae61d6d647bff5f73873e7949?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6bb92b9ae61d6d647bff5f73873e7949?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bert</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-28T12:54:55+00:00">August 28, 2017 at 12:54 pm</time></a> </div>
<div class="comment-content">
<p>Just what I was thinking.</p>
</div>
</li>
<li id="comment-649607" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ab1644a81945460fc3d4f2862f402951?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ab1644a81945460fc3d4f2862f402951?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mayuresh Kathe</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-03T18:04:03+00:00">March 3, 2023 at 6:04 pm</time></a> </div>
<div class="comment-content">
<p>Yes, and I also remember PL/SQL and even T-SQL not supporting recursion, which isn&rsquo;t such a big hindrance because it can be provided for by implementing a Y-combinator.</p>
<p>I have a long-term goal of implementing a mini/micro-Kanren using SQL-PL (under IBM DB2) to perform deductive reasoning over records without incurring the performance penalty imposed by moving data out (and back into) of the database to be reasoned with using something like Datalog (or even Prolog).</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-287303" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2409a111fe771334bc611d0286bfcd2f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2409a111fe771334bc611d0286bfcd2f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">sameer</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-27T19:20:07+00:00">September 27, 2017 at 7:20 pm</time></a> </div>
<div class="comment-content">
<p>It is not. sql depends on axioms of relational algebra and not turing axioms, in order to be correct.</p>
</div>
</li>
<li id="comment-412897" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ed8221786ea52367c76ef55b74cb1d2d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ed8221786ea52367c76ef55b74cb1d2d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Negarrak</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-21T21:44:47+00:00">June 21, 2019 at 9:44 pm</time></a> </div>
<div class="comment-content">
<p>if you can put &ldquo;if&rdquo; statements and &ldquo;goto&rdquo;, yes, it&rsquo;s only what it takes.</p>
</div>
</li>
<li id="comment-592432" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f5bf28e92655b4d1c59dbf06df57d058?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f5bf28e92655b4d1c59dbf06df57d058?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">kncklcht</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-28T15:36:08+00:00">July 28, 2021 at 3:36 pm</time></a> </div>
<div class="comment-content">
<p>Someone implemented a raytracing renderer in SQL&#8230;</p>
</div>
</li>
</ol>
</li>
<li id="comment-54264" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e41f852c5c471370a0d08ba8dc1c032?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e41f852c5c471370a0d08ba8dc1c032?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Billy O'Neal</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-03-09T09:20:22+00:00">March 9, 2011 at 9:20 am</time></a> </div>
<div class="comment-content">
<p>@Ex: That is incorrect. Obviously real machines are limited in memory and therefore cannot act like true Turing machines; they are technically speaking linear bounded automata. However, real machines are still &ldquo;said to be&rdquo; Turing complete if they can meet all requirements except that of unlimited memory. See the second paragraph of <a href="https://en.wikipedia.org/wiki/Turing_completeness#Overview" rel="nofollow ugc">http://en.wikipedia.org/wiki/Turing_completeness#Overview</a> .</p>
</div>
</li>
<li id="comment-54259" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1f3083754b79e77c7d06f353c2f7cbd9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1f3083754b79e77c7d06f353c2f7cbd9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.mostlymaths.net" class="url" rel="ugc external nofollow">Ruben Berenguel</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-03-09T06:15:21+00:00">March 9, 2011 at 6:15 am</time></a> </div>
<div class="comment-content">
<p>Well, I (personally) think the manners of the company reflect the owner and creator. A few months ago I read an article about some cellular automata (I don&rsquo;t remember exactly what the details were, I was just curious, after all I&rsquo;m in dynamical systems), and his view of the proof/result was&#8230; Well, along the lines of &ldquo;it is not interesting as I have not done it&rdquo;. This is only from memory, but that&rsquo;s the impression I got, it can&rsquo;t be too far off.</p>
<p>Cheers, </p>
<p>Ruben</p>
</div>
</li>
<li id="comment-54260" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a87f31f4ab88f90c7806a718bd170ff1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a87f31f4ab88f90c7806a718bd170ff1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.mrspeaker.net/" class="url" rel="ugc external nofollow">Mr Speaker</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-03-09T06:24:04+00:00">March 9, 2011 at 6:24 am</time></a> </div>
<div class="comment-content">
<p>It also relies on human interaction every tick&#8230; so don&rsquo;t get your hopes up about writing all javascript in Lisp anytime soon 😉</p>
</div>
</li>
<li id="comment-54261" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ex</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-03-09T06:58:13+00:00">March 9, 2011 at 6:58 am</time></a> </div>
<div class="comment-content">
<p>Erm C is not turing complete (except, possibly, with file IO).</p>
<p>A turing complete programming language would be able to handle unbounded memory. In C all memory must be directly addressable, and all pointers must be castable to a void* which must be of finite size.</p>
<p>This results in C not being Turing complete 🙂</p>
</div>
</li>
<li id="comment-54263" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-03-09T09:13:10+00:00">March 9, 2011 at 9:13 am</time></a> </div>
<div class="comment-content">
<p>Ex,<br/>
Clearly, no computer is strictly Turing complete, because the storage is always limited. The term TC, is used in a loose form, IMHO. That is, it the language is TC as long, it can simulate a TM with a limited size tape. Yet, there should be no principal limit: if we have a larger computer, we can simulate a larger Turing machine (without changing the program, IMHO).</p>
</div>
</li>
<li id="comment-54265" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a076154395aedaa4ca81f31067b7de1b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a076154395aedaa4ca81f31067b7de1b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://jakoblog.de/" class="url" rel="ugc external nofollow">Jakob</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-03-09T10:17:40+00:00">March 9, 2011 at 10:17 am</time></a> </div>
<div class="comment-content">
<p>@Siah The current SQL specification is a monster, every RDBMS implements his subset plus some proprietary goodies. So I bet that some dialects of SQL are turing complete. To answer the question, you should first define what you mean by SQL (the latest version of SQL that a test suite was provided for was SQL-92).</p>
</div>
</li>
<li id="comment-54266" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-03-09T16:39:15+00:00">March 9, 2011 at 4:39 pm</time></a> </div>
<div class="comment-content">
<p>@Siah @Jakob</p>
<p>By &ldquo;SQL&rdquo;, I meant either SQL 2003 or any of the popular dialects.</p>
</div>
</li>
<li id="comment-54267" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6f9653ef43a9e05d3b1597f1b19a6a4f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6f9653ef43a9e05d3b1597f1b19a6a4f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">rvasques</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-03-09T17:17:30+00:00">March 9, 2011 at 5:17 pm</time></a> </div>
<div class="comment-content">
<p><em>This post censored for violation of the <a href="https://lemire.me/blog/terms-of-use/" rel="nofollow">terms of use</a>: &ldquo;You can criticize me or the other people who post on this blog, but being rude is likely to get your comment deleted. Go start your own blog if you want to be insulting.&rdquo;.</em></p>
</div>
</li>
<li id="comment-54818" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dd2d775dea75b381edb1bbf0600a0907?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dd2d775dea75b381edb1bbf0600a0907?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.marnen.org" class="url" rel="ugc external nofollow">Marnen Laibow-Koser</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-11-28T18:14:11+00:00">November 28, 2011 at 6:14 pm</time></a> </div>
<div class="comment-content">
<p>About Cook&rsquo;s proof: as I understand it, he was under NDA regarding the research he was doing for Wolfram (so Wolfram could publish it in his book). Silly NDA, but he should have respected it&#8230;</p>
<p>Comment #3: based on what I&rsquo;ve seen of Wolfram himself (I was a student at NKS Summer School 2010), that would surprise me. He seems to be extremely curious about what other people make of cellular automata.</p>
</div>
</li>
<li id="comment-55019" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4ca67c5e98323c3bb628f4f815de762e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4ca67c5e98323c3bb628f4f815de762e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.hugedomains.com/domain_profile.cfm?d=leduotang&#038;e=com" class="url" rel="ugc external nofollow">Sylvain HallÃ©</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-03T08:17:27+00:00">March 3, 2012 at 8:17 am</time></a> </div>
<div class="comment-content">
<p>@Christian: Yes, but we should keep in mind that the Postscript format, dating back from the 1980s, was already a full-fledged programming language.</p>
</div>
</li>
<li id="comment-55018" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/058ec0a9b42e06fd58f05dedb9e5952d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/058ec0a9b42e06fd58f05dedb9e5952d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christian Berger</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-03T07:43:03+00:00">March 3, 2012 at 7:43 am</time></a> </div>
<div class="comment-content">
<p>Isn&rsquo;t it scary that even important file formats which are the base of much of our computing world are now so complex they are Turing complete?</p>
</div>
</li>
<li id="comment-55020" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ef708e3307f37beee8b4f1e937c993c2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ef708e3307f37beee8b4f1e937c993c2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Simon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-03T14:04:53+00:00">March 3, 2012 at 2:04 pm</time></a> </div>
<div class="comment-content">
<p>This thread may be of interest (especially the comment by usr):<br/>
<a href="http://stackoverflow.com/questions/5357725/how-does-this-implementation-of-turing-complete-rule-110-in-html5css3-work" rel="nofollow ugc">http://stackoverflow.com/questions/5357725/how-does-this-implementation-of-turing-complete-rule-110-in-html5css3-work</a></p>
</div>
</li>
<li id="comment-55286" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/69c28cd5a6009dc633f0c59924aa0e58?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/69c28cd5a6009dc633f0c59924aa0e58?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Misha</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-03T15:38:07+00:00">June 3, 2012 at 3:38 pm</time></a> </div>
<div class="comment-content">
<p>@EX: It is indeed true that their maybe no Turing *machine* due to the bounds on memory but we could easily image a Turing complete language that could scale to the memory size of any machine.</p>
</div>
</li>
<li id="comment-55287" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e41f852c5c471370a0d08ba8dc1c032?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e41f852c5c471370a0d08ba8dc1c032?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Billy O'Neal</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-03T21:14:32+00:00">June 3, 2012 at 9:14 pm</time></a> </div>
<div class="comment-content">
<p>@Misha: What looping construct exists in CSS and HTML? A turing machine needs such a construct.</p>
</div>
</li>
<li id="comment-73915" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">flip</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-02T05:47:22+00:00">March 2, 2013 at 5:47 am</time></a> </div>
<div class="comment-content">
<p>@Billy O&rsquo;Neal </p>
<p>Or you need to implement the SKI-calculus, the one instruction processor, some cellular automata or certain rewrite systems. There are a lot of possibilities, you only need to show, that system A is equivalent to system B, which is turing complete and you have proved it.</p>
</div>
</li>
<li id="comment-74214" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anonymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-04T11:03:26+00:00">March 4, 2013 at 11:03 am</time></a> </div>
<div class="comment-content">
<p>@flip: My assertion is that showing equivalence to a Turing machine requires a looping construct. Or at least a &ldquo;goto&rdquo; construct which could be used to construct a looping construct. For instance, it is easy to build a Turing Machine that runs forever; this is not possible with HTML5 + CSS.</p>
</div>
</li>
<li id="comment-74215" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e41f852c5c471370a0d08ba8dc1c032?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e41f852c5c471370a0d08ba8dc1c032?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Billy O'Neal</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-04T11:03:38+00:00">March 4, 2013 at 11:03 am</time></a> </div>
<div class="comment-content">
<p>@flip: My assertion is that showing equivalence to a Turing machine requires a looping construct. Or at least a &ldquo;goto&rdquo; construct which could be used to construct a looping construct. For instance, it is easy to build a Turing Machine that runs forever; this is not possible with HTML5 + CSS.</p>
</div>
</li>
<li id="comment-412898" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ed8221786ea52367c76ef55b74cb1d2d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ed8221786ea52367c76ef55b74cb1d2d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Negarrak</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-21T21:45:33+00:00">June 21, 2019 at 9:45 pm</time></a> </div>
<div class="comment-content">
<p>Please, take a look into my Kialo discussion about it.<br/>
<a href="https://www.kialo.com/is-html-a-programming-language-29611?path=29611.0~29611.1&amp;active=~29611.1" rel="nofollow">https://www.kialo.com/is-html-a-programming-language-29611?path=29611.0~29611.1&#038;active=~29611.1</a></p>
</div>
</li>
<li id="comment-657278" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a5424dd407b3f9c254a7c2ddd2adb9a5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a5424dd407b3f9c254a7c2ddd2adb9a5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://bryanveloso.com/" class="url" rel="ugc external nofollow">Bryan Veloso</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-24T03:26:01+00:00">December 24, 2023 at 3:26 am</time></a> </div>
<div class="comment-content">
<p>13 years later and we’re still debating this. ChatGPT 4 told me it’s not turing complete, even I specifically mentioned HTML5+CSS3 and the Rule 110 Automation.</p>
</div>
</li>
</ol>
