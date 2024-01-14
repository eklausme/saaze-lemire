---
date: "2010-10-26 12:00:00"
title: "Who is going to need a database engine in 2020?"
index: false
---

[25 thoughts on &ldquo;Who is going to need a database engine in 2020?&rdquo;](/lemire/blog/2010/10-26-who-is-going-to-need-a-database-engine-in-2020)

<ol class="comment-list">
<li id="comment-53843" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9188ae6a53409f48237dc8e7054a6a91?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9188ae6a53409f48237dc8e7054a6a91?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Steven Shaw</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-10-26T23:18:36+00:00">October 26, 2010 at 11:18 pm</time></a> </div>
<div class="comment-content">
<p>Wondering what language you recommend as alternatives to Java?</p>
<p>Scala springs to mind of course as an obvious choice for reforming Java devs.</p>
<p>Could it be something more unusual like Haskell, Erlang, O&rsquo;Caml, Scheme, Google Go or the likes of Ruby/Python/JS?</p>
</div>
</li>
<li id="comment-53844" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b07850a75112132e9284dc7f428ad5e0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b07850a75112132e9284dc7f428ad5e0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Virgilio</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-10-27T01:08:37+00:00">October 27, 2010 at 1:08 am</time></a> </div>
<div class="comment-content">
<p>I think that the C++ of today has nothing to do comparing with the one that lost The battle agallas Java yeraa ago. It only needs standard libs for standard problems (threads, sockets, &#8230;) there are a few good libs like qt, but they Are not standard.<br/>
I believe something like jsr&rsquo;s for C++ could be a solution&#8230;</p>
</div>
</li>
<li id="comment-53845" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8528397254e98a159c68bb0ce20eae71?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8528397254e98a159c68bb0ce20eae71?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Zeno</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-10-27T05:30:50+00:00">October 27, 2010 at 5:30 am</time></a> </div>
<div class="comment-content">
<p>Just as a sidenote, regular expressions are not an esoteric feature, but a standard tool for many programmers (on Unix systems: every programmer).</p>
</div>
</li>
<li id="comment-53846" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1eb0efe2452fde758bb36c20e57de9e0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1eb0efe2452fde758bb36c20e57de9e0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.xtremecompression.com" class="url" rel="ugc external nofollow">Glenn Davis</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-10-27T07:55:38+00:00">October 27, 2010 at 7:55 am</time></a> </div>
<div class="comment-content">
<p>Especially data compression, and in particular content-aware compression methods designed specifically for structured data.</p>
<p>Database volumes are growing faster than Moore&rsquo;s law, but the state of the art of database compression has never kept pace. In the absence of systematic methods designed for database records, decades-old, one-dimensional, conventional methods, intended for long-obsolete hardware, are instead being brought to bear ad-hoc on database data.</p>
</div>
</li>
<li id="comment-53848" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-10-27T13:09:01+00:00">October 27, 2010 at 1:09 pm</time></a> </div>
<div class="comment-content">
<p>@Shaw</p>
<p><em>Wondering what language you recommend as alternatives to Java?</em></p>
<p>I use Python, Java and C++ myself. They are all getting better all the time. </p>
<p>Scala is interesting, but it feels challenging.</p>
<p>I won&rsquo;t make predictions except to say that I expect new and more powerful programming languages to replace the existing ones. I&rsquo;ll be pretty sad if in 2020, I&rsquo;m still primarily using Python, Java and C++. There is so much innovation out there that something strong has to emerge out of it.</p>
<p>For reference, hardly anyone was using Python and Ruby ten years ago. C# didn&rsquo;t even exist. We are not standing still. (Though some would object that we have never improved over Lisp. I won&rsquo;t get into this debate.)</p>
<p>@Zeno</p>
<p><em>regular expressions are not an esoteric feature</em></p>
<p>No. They are not. I&rsquo;m sorry I wasn&rsquo;t clear: it was irony. My point was that 20 years ago, regular expressions would have appeared as an esoteric feature whereas it is now taken for granted. Thus, programmers are much more powerful than they were 20 years ago. A program that had taken months to write can now be written much faster. I conjecture that the trend will continue. </p>
<p>@Paul</p>
<p><em>Even if we switch to RAM storage, the concepts will remain in accessing data across a network.</em></p>
<p>Good point.</p>
<p><em>I recall a lot of database work being figuring out how to make sure you&rsquo;re accessing contiguous chunks whenever possible to avoid having to wait around for a spinning platter to get to the next bit you need. Storage advances look to be moving away from that model, which will make writing db code and interacting with them that much easier</em></p>
<p>Yes. I agree.</p>
</div>
<ol class="children">
<li id="comment-411294" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-10T14:09:59+00:00">June 10, 2019 at 2:09 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m pretty sure I was writing C# more than ten years ago. I either I&rsquo;m very clever and invented it for my personal use before MS got around to it, or it was already around in the early 2000s.</p>
</div>
<ol class="children">
<li id="comment-411299" class="comment byuser comment-author-lemire bypostauthor even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-10T15:48:37+00:00">June 10, 2019 at 3:48 pm</time></a> </div>
<div class="comment-content">
<p>My blog post was written in 2010. As far as I can tell, C# came up in the early 2000s. If you were programming in C# before then&#8230; something is off.</p>
</div>
<ol class="children">
<li id="comment-411307" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-10T17:24:55+00:00">June 10, 2019 at 5:24 pm</time></a> </div>
<div class="comment-content">
<p>Huh, oops! I got fooled by the recent comments. Interesting to look back and see the perspective.</p>
<p>Are you still using Java, C++ and Python?</p>
</div>
<ol class="children">
<li id="comment-411312" class="comment byuser comment-author-lemire bypostauthor even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-10T18:38:08+00:00">June 10, 2019 at 6:38 pm</time></a> </div>
<div class="comment-content">
<p><em>Are you still using Java, C++ and Python? </em></p>
<p>Yes. I try hard to use as many languages as I can.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-53847" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c47d7a71160b9ec79d34316139ff3cdb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c47d7a71160b9ec79d34316139ff3cdb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://futurepaul.blogspot.com" class="url" rel="ugc external nofollow">Paul</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-10-27T09:02:55+00:00">October 27, 2010 at 9:02 am</time></a> </div>
<div class="comment-content">
<p>There will always be this shift as &ldquo;db&rdquo; problems start fitting in memory and &ldquo;impossible&rdquo; problems turn into feasible db problems. Thus there will always be a need for quick, in memory solutions; for general purpose databases; and for specialized solutions. Even if we switch to RAM storage, the concepts will remain in accessing data across a network.</p>
<p>The one thing I do see changing is the quirks of databases necessitated by spinning disks. From my DB class back in college, I recall a lot of database work being figuring out how to make sure you&rsquo;re accessing contiguous chunks whenever possible to avoid having to wait around for a spinning platter to get to the next bit you need. Storage advances look to be moving away from that model, which will make writing db code and interacting with them that much easier, when, e.g. you don&rsquo;t need to pick a primary variable to index on, but can have every variable indexed at identical speeds</p>
</div>
</li>
<li id="comment-53849" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/62c442374e02dad34f1338a17d5eb5b9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/62c442374e02dad34f1338a17d5eb5b9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stanley Lee</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-10-27T15:47:09+00:00">October 27, 2010 at 3:47 pm</time></a> </div>
<div class="comment-content">
<p>Even though I&rsquo;m a bit of a tech-recluse these days, this is a great wake-up call for the over-ambitious idiots in the industry. With that said, which pre-existing database engine did you find superior in general (I saw a few listed on Wikipedia: <a href="https://en.wikipedia.org/wiki/Database_engine" rel="nofollow ugc">http://en.wikipedia.org/wiki/Database_engine</a> )</p>
</div>
</li>
<li id="comment-53850" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-10-27T15:53:31+00:00">October 27, 2010 at 3:53 pm</time></a> </div>
<div class="comment-content">
<p>@Stanley</p>
<p>All the database engines currently listed in the database engine wikipedia article are related to MySQL. Seems a bit biased to me.</p>
<p>As for a review of database engines, that would make a blog post of its own. Maybe later&#8230; 😉</p>
</div>
</li>
<li id="comment-53851" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1ccb5123d1af92e24b32cec62abcf9a8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1ccb5123d1af92e24b32cec62abcf9a8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jack Dempsey</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-10-27T23:18:44+00:00">October 27, 2010 at 11:18 pm</time></a> </div>
<div class="comment-content">
<p>Given the mention of Java and databases, I&rsquo;m almost surprised to see no one mention Clojure yet. The basics of the STM system should be familiar to many, while the reliance on the JVM should help some move towards it as well.</p>
<p>I&rsquo;m only just getting into it now and really liking what I see. Take a look if you haven&rsquo;t heard of it: <a href="http://clojure.org" rel="nofollow ugc">http://clojure.org</a></p>
</div>
</li>
<li id="comment-268639" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/857401730f5ef504066a70df9b9fb9c3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/857401730f5ef504066a70df9b9fb9c3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Antonio Badia</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-27T16:38:50+00:00">January 27, 2017 at 4:38 pm</time></a> </div>
<div class="comment-content">
<p>Daniel,<br/>
the title of your post is &ldquo;Who is going to need a database engine in 2020?&rdquo; But then in the post you go to talk about a different (albeit related) issue: who would want to write their own database engine? As you point out, that&rsquo;s kind of crazy (unless you work at Google/Twitter/Amazon/Facebook). There are already many distinct database engines available (SQL and no-SQL, in-memory and in-disk; centralized and distributed). It feels like reinventing the wheel.<br/>
Once this said, I think the original question (title) is much more interesting. I hope you write a post on that. We can discuss why databases are not used for data analysis/analytics.</p>
</div>
</li>
<li id="comment-268665" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-27T19:58:11+00:00">January 27, 2017 at 7:58 pm</time></a> </div>
<div class="comment-content">
<p>Just what is &ldquo;Big Data&rdquo;? </p>
<p>I am curious about the performance of the H2 database. Given the preference for running in-memory, the low impedance when embedded in a Java application, and the increasing size of main memory &#8211; when does the problem become too big for a single instance? Put differently, what fraction of &ldquo;Big Data&rdquo; problems can be handled in-memory on a single box, using a very fast single-instance SQL database?</p>
<p>The H2 database is *very* fast when embedded in a Java application, and operating in-memory. I believe you can also write your stored procedures (when needed) in Java. </p>
<p>If we can partition the problem, we could fire up a herd of single-instances to operate on segments of the data. Using an SQL database we can easily do some fairly complex transformations. How does this compare in performance to non-SQL databases?</p>
<p>If this approach works, there is no (or less) need to write custom engines.</p>
<p>Expanding your question, more than answering. 🙂</p>
<p>The JVM is also one of my concerns. I distrust Oracle. Can we port the JVM used by Google on Android?</p>
</div>
<ol class="children">
<li id="comment-268685" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-27T22:51:46+00:00">January 27, 2017 at 10:51 pm</time></a> </div>
<div class="comment-content">
<p>Google is using OpenJDK. There is only so much Oracle can do with OpenJDK.</p>
</div>
<ol class="children">
<li id="comment-411137" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1d8e66b87a568543b5c36660c1e0d4cb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1d8e66b87a568543b5c36660c1e0d4cb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">ShalokShalom</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-09T04:48:48+00:00">June 9, 2019 at 4:48 am</time></a> </div>
<div class="comment-content">
<p>Google reimplemented JVM as Dalvik, they are not using OpenJDK. Even more so: They implement it as Register based, as opposed to Stack-based, which is a huge effort on its own.</p>
<p>You are also completely incorrect on the difficulty of concurrency since these challenges apply only on imperative code.</p>
<p>Functional languages get concurrency without even need to think about, its one of the lots advantages of them.</p>
</div>
<ol class="children">
<li id="comment-411210" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-09T16:01:33+00:00">June 9, 2019 at 4:01 pm</time></a> </div>
<div class="comment-content">
<p><em>Google (&#8230;) are not using OpenJDK.</em></p>
<blockquote><p>“As an open-source platform, Android is built upon the collaboration of the open-source community,” a Google spokesperson told VentureBeat. “In our upcoming release of Android, we plan to move Android’s Java language libraries to an OpenJDK-based approach, creating a common code base for developers to build apps and services. Google has long worked with and contributed to the OpenJDK community, and we look forward to making even more contributions to the OpenJDK project in the future.”</p></blockquote>
<p><a href="https://venturebeat.com/2015/12/29/google-confirms-next-android-version-wont-use-oracles-proprietary-java-apis/" rel="nofollow">Source</a>.</p>
<p><a href="https://en.wikipedia.org/wiki/OpenJDK" rel="nofollow">Quoting Wikipedia</a>:</p>
<blockquote><p>On Android Nougat, OpenJDK replaces the now-discontinued Apache Harmony as the Java libraries in the source code of the mobile operating system. Google has been in an ongoing legal dispute with Oracle over claims of copyright and patent infringement through its use of re-implementations of copyrighted Java APIs via Harmony. While also stating that this change was to create a more consistent platform between Java on Android and other platforms, the company admitted that the switch was motivated by the lawsuit, arguing that Oracle had authorized its use of the OpenJDK code by licensing it under the GPL.</p></blockquote>
</div>
<ol class="children">
<li id="comment-411537" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1d8e66b87a568543b5c36660c1e0d4cb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1d8e66b87a568543b5c36660c1e0d4cb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">ShalokShalom</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-12T18:25:22+00:00">June 12, 2019 at 6:25 pm</time></a> </div>
<div class="comment-content">
<p>Yeah, this is the library collection. Dalvik or now the ART (Android Runtime) itself is a new implementation.</p>
<p><a href="https://en.wikipedia.org/wiki/Dalvik_(software)#Architecture" rel="nofollow ugc">https://en.wikipedia.org/wiki/Dalvik_(software)#Architecture</a></p>
</div>
<ol class="children">
<li id="comment-411548" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-12T18:53:16+00:00">June 12, 2019 at 6:53 pm</time></a> </div>
<div class="comment-content">
<p>You are correct; Google, Microsoft, IBM and others have built their own VMs. There are many available, including free ones&#8230; OpenJ9, Excelsior&#8230; See this list on Wikipedia: <a href="https://en.wikipedia.org/wiki/List_of_Java_virtual_machines" rel="nofollow ugc">https://en.wikipedia.org/wiki/List_of_Java_virtual_machines</a></p>
<p>But Java itself is bound to its standard libraries. That&rsquo;s what makes Java, Java. And that&rsquo;s the part you cannot legally reproduce.</p>
<p>So the larger point is whether one needs to trust Oracle to use Java.</p>
<p>OpenJDK is the key.</p>
</div>
<ol class="children">
<li id="comment-412228" class="comment even depth-7">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1d8e66b87a568543b5c36660c1e0d4cb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1d8e66b87a568543b5c36660c1e0d4cb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">ShalokShalom</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-17T07:16:54+00:00">June 17, 2019 at 7:16 am</time></a> </div>
<div class="comment-content">
<p>Well, the original post asked to port JVM, not JRE and JDK.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-411211" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-09T16:09:42+00:00">June 9, 2019 at 4:09 pm</time></a> </div>
<div class="comment-content">
<p><em>Functional languages get concurrency without even need to think about, its one of the lots advantages of them.</em></p>
<p>If your world is stateless, then concurrency is a solved problem.</p>
</div>
<ol class="children">
<li id="comment-411538" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1d8e66b87a568543b5c36660c1e0d4cb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1d8e66b87a568543b5c36660c1e0d4cb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">ShalokShalom</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-12T18:27:18+00:00">June 12, 2019 at 6:27 pm</time></a> </div>
<div class="comment-content">
<p>Correct. And functional languages are stateless per design.</p>
</div>
<ol class="children">
<li id="comment-411541" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-12T18:42:59+00:00">June 12, 2019 at 6:42 pm</time></a> </div>
<div class="comment-content">
<p>Databases are not stateless in general. When they are, then concurrency is not a problem. But that is true irrespective of your programming paradigm.</p>
</div>
<ol class="children">
<li id="comment-411551" class="comment even depth-7">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1d8e66b87a568543b5c36660c1e0d4cb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1d8e66b87a568543b5c36660c1e0d4cb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">ShalokShalom</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-12T19:04:54+00:00">June 12, 2019 at 7:04 pm</time></a> </div>
<div class="comment-content">
<p>It gets much more easy with message passing, preemptive scheduling and supervisors, so Erlangs design. Also Akka.NET to a certain extent, etc. If you call that a programming paradigm..</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
