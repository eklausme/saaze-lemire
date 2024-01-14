---
date: "2010-12-02 12:00:00"
title: "Over-normalization is bad for you"
index: false
---

[17 thoughts on &ldquo;Over-normalization is bad for you&rdquo;](/lemire/blog/2010/12-02-over-normalization-is-bad-for-you)

<ol class="comment-list">
<li id="comment-53962" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-02T16:58:33+00:00">December 2, 2010 at 4:58 pm</time></a> </div>
<div class="comment-content">
<p>@Antonio</p>
<p>I don&rsquo;t think I am missing the point. I do ask however whether this possibility you evoke&mdash;that the names will go out of sync whereas they shouldn&rsquo;t&mdash;is a real threat.</p>
<p>We used to think that catching bugs at design time was essential. Our experience in the last 20 years has shown that belief to be somewhat overblown. Facebook was built with PHP, Twitter with Ruby.</p>
<p>Many NoSQL databases work just like my example. There is no trace of normalization. And people seem to get real work done.</p>
</div>
</li>
<li id="comment-53963" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-02T17:21:44+00:00">December 2, 2010 at 5:21 pm</time></a> </div>
<div class="comment-content">
<p>@glenn</p>
<p><em>Which is fine if that&rsquo;s the correct application logic, and not fine if it isn&rsquo;t.</em></p>
<p>I&rsquo;d prefer to have strong data independence. That is, I would prefer to be able to change the application logic without having to change the database schema.</p>
<p>It seems best if the developer rarely needs to change the database schema, because that&rsquo;s an expensive operation. In practice, I suspect a lot of features are not implemented, or they are badly implemented, because they don&rsquo;t match the database schema.</p>
<p>I would rather make the database engine work harder to adapt, rather than have the developer redesign the tables.</p>
<p><em>I see lots of flattened data where the flattening has made it impossible or onerous to answer very reasonable and valuable questions.</em></p>
<p>In my example, there does not need to be any performance difference between the two databases. (I admit that there might be in the real world.) It is a matter of physical layout, but I&rsquo;m only discussing the logical representation.</p>
</div>
</li>
<li id="comment-53965" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-02T20:09:40+00:00">December 2, 2010 at 8:09 pm</time></a> </div>
<div class="comment-content">
<p>@glenn</p>
<p><em>Joins should be an internal issue below the query layer. </em></p>
<p>I think this is almost exactly what I am saying.</p>
</div>
</li>
<li id="comment-53960" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bb8fb8ec240b032402940d1592fdf87e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bb8fb8ec240b032402940d1592fdf87e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Antonio Badia</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-02T15:39:33+00:00">December 2, 2010 at 3:39 pm</time></a> </div>
<div class="comment-content">
<p>Daniel,<br/>
I think you are missing the point here. The problem with non-normalized data is not the added storage (which happens, but disk is cheap), but the anomalies that happen when data is stored redundantly: insertion, deletion, and update anomalies. If the Jane Wright in your example is one person, and it is represented by two in the non-normalized table, what stops an application from changing one row without changing the other (say, change the customerid in one and not the other), thus leaving the database in an inconsistent state? This, I think, it&rsquo;s the real reason to normalize.</p>
</div>
</li>
<li id="comment-53961" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/800078ddbf84f5b7232e6fcb460ecceb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/800078ddbf84f5b7232e6fcb460ecceb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.furia.com" class="url" rel="ugc external nofollow">glenn mcdonald</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-02T15:55:30+00:00">December 2, 2010 at 3:55 pm</time></a> </div>
<div class="comment-content">
<p>Two notes:</p>
<p>&ldquo;there is no need to change the schema to add such a feature&rdquo;</p>
<p>More accurately, this feature matches the logical structure of this database. So it&rsquo;s not that it&rsquo;s easy to &ldquo;add&rdquo; such a feature, it&rsquo;s that this database already has it. Which is fine if that&rsquo;s the correct application logic, and not fine if it isn&rsquo;t. And since the main pressure towards denormalization is bad tools for dealing with normalization, there&rsquo;s no reason to believe that denormalized data structures will reliably coincide with correct features you just hadn&rsquo;t thought about yet.</p>
<p>&ldquo;most of your queries will be shorter and more readable&rdquo;</p>
<p>But shorter and more readable is no victory if the results are wrong. And when you flatten a non-flat structure, you lose the ability to get reliable answers to questions along any dimension other than the one you used for flattening. If your application only ever needs to ask questions in one direction, that may be acceptable. But I almost never see non-trivial non-flat datasets where there actually is only one dimension anybody ever really cares about.</p>
<p>I should turn that around: I see lots of flattened data where the flattening has made it impossible or onerous to answer very reasonable and valuable questions.</p>
</div>
</li>
<li id="comment-53966" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-02T21:08:41+00:00">December 2, 2010 at 9:08 pm</time></a> </div>
<div class="comment-content">
<p>@Badia</p>
<p><em>disk is cheap</em></p>
<p>Yes, but you do want to load as much as possible into your L2 and L1 caches. Larger databases are often slower on that account.</p>
</div>
</li>
<li id="comment-53964" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/800078ddbf84f5b7232e6fcb460ecceb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/800078ddbf84f5b7232e6fcb460ecceb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.furia.com" class="url" rel="ugc external nofollow">glenn mcdonald</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-02T19:55:36+00:00">December 2, 2010 at 7:55 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;Data independence&rdquo; = full logical normalization. It&rsquo;s tempting to wish that wasn&rsquo;t the case, because we&rsquo;ve spent decades working with bad tools that make you pay for every bit of normalization with relentless pain. But it&rsquo;s really true, and shouldn&rsquo;t be scary. All the principles of relational database construction (I mean the logical principles, not any tactical crap about specific nominally-relational implementations) are precisely about making your database accurately express the logical structure of the data, such that your use of it will be constrained only by what it *is*, rather than how it&rsquo;s been stored. If you want to be able to change the application, with ebullient impunity, without changing the database schema, then you *have* to care about normalization. Normalization is to data what engineering is to bridges. Data modeling (calling it &ldquo;normalization&rdquo; was probably a mistake to begin with) is to data what physics is to things. You can&rsquo;t be against it. It *is*.</p>
<p>And yet, you&rsquo;re absolutely undeniably irrevocably right (I think) about at least two things:</p>
<p>1. Normalization orthodoxy encourages people to focus on database rules rather than scrutinizing actual logic, which often leads to them making bad modeling decisions. I think it&rsquo;s possible that the biggest single cause of this is the now-established ass-backwards pattern of teaching &ldquo;normalization&rdquo; as a series of pedantically phrased pennances you are guilted into doing to a nice, normal spreadsheet. If data modeling was taught by explaining how to construct a logical model the right way, the first time, I think it would seem vastly more comprehensible and a lot less frightening.</p>
<p>2. In SQL, normalization = pain. It makes perfect sense to hate joins, and want to not have to do them. But you should never have had to do them to begin with. Joins should be an internal issue below the query layer. You should be able to ask for a book&rsquo;s author without caring whether author is single or multiple or optional, and without knowing or caring how many &ldquo;tables&rdquo; are involved in answering your query.</p>
<p>Or, for my longer attempts at attacking this topic myself, see</p>
<p><a href="http://www.furia.com/page.cgi?type=log&#038;id=305" rel="nofollow ugc">http://www.furia.com/page.cgi?type=log&#038;id=305</a><br/>
<a href="http://www.furia.com/page.cgi?type=log&#038;id=311" rel="nofollow ugc">http://www.furia.com/page.cgi?type=log&#038;id=311</a></p>
</div>
</li>
<li id="comment-53989" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/272b69a6f7932242c7f6987d73ca7fd8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/272b69a6f7932242c7f6987d73ca7fd8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://blog.sydoracle.com" class="url" rel="ugc external nofollow">Gary</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-07T23:34:33+00:00">December 7, 2010 at 11:34 pm</time></a> </div>
<div class="comment-content">
<p>Taking your example one step further, what if you want to add an email address, and Jane Wright has three email addresses. Do you have three rows (one with a blank telephone number?) or six rows for each combination of telephone number and email address. The latter is effectively how you&rsquo;ve dealt with two telephone numbers.<br/>
What about other attributes ? Perhaps Jane Wright has made 10 orders each with 3 items. Do you have those six email/telephone number combinations against all 30 order lines ?</p>
</div>
</li>
<li id="comment-53990" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-08T07:46:13+00:00">December 8, 2010 at 7:46 am</time></a> </div>
<div class="comment-content">
<p>@Gary</p>
<p>You might have to add lots of rows, but remember that I am specifically saying that these don&rsquo;t need to be physical rows. They are merely logical. So you don&rsquo;t necessarily have more data to store than if the database was normalized. (And I&rsquo;ll admit that I don&rsquo;t know of a database engine that can do this. So my point is a bit theoretical.)</p>
</div>
</li>
<li id="comment-53996" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-08T17:46:10+00:00">December 8, 2010 at 5:46 pm</time></a> </div>
<div class="comment-content">
<p>@Gary</p>
<p>Oh! If you are not concerned about storage, then it is a different question. </p>
<p>I am not saying your web application should run out of a single table. I am saying however that it shouldn&rsquo;t use 15 tables if five will do. The sweet spot is not necessarily with the tables in third normal form. The normal forms are a dogma. (Knowledge without evidence.)</p>
</div>
</li>
<li id="comment-53994" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/272b69a6f7932242c7f6987d73ca7fd8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/272b69a6f7932242c7f6987d73ca7fd8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://blog.sydoracle.com" class="url" rel="ugc external nofollow">Gary</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-08T16:44:36+00:00">December 8, 2010 at 4:44 pm</time></a> </div>
<div class="comment-content">
<p>I never suggested they would have to by physical (and I suspect the compression mechanism in Oracle, which works on repeated values, would minimise storage space). That isn&rsquo;t the point. The point is that the code logic needs to deal with those rows. You need to make deliveries of those orders so your code need to work out whether you are delivering one item that happens to relate to two phone numbers or two items that have different phone number attributes.</p>
<p>That is the problem normalisation addresses. Normalisation is NOTHING to do with physical storage. It is to do with identifying dependencies between data values.</p>
</div>
</li>
<li id="comment-54016" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c37c50011af6c1e723d1c2252a1f9484?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c37c50011af6c1e723d1c2252a1f9484?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.sci-blog.com" class="url" rel="ugc external nofollow">Alex</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-10T09:56:04+00:00">December 10, 2010 at 9:56 am</time></a> </div>
<div class="comment-content">
<p>Daniel,<br/>
I absolutely agree with you post.<br/>
May be there is a trade-off in certain applications, but not for web &#8211; and this is what is driving NoSQL.<br/>
As soon as web application starts receiving some decent trafic &#8211; hundred users per minute, per second etc. Properly denormalized EBNF tables become very heavy liability and very quickly tables have to be denormalised into caching tables &#8211; one common table for view output and then denormalized data pushed into cache like memcached.<br/>
Pure SQL approach just doesn&rsquo;t work in real world web &#8211; you have to add features, you have to change DB schema as you add them and users can think of more ways to exploit you website then anticipated by fixed database schema.</p>
</div>
</li>
<li id="comment-54019" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8e2e3a01bf33747391457d97e0df832b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8e2e3a01bf33747391457d97e0df832b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://synthese.wordpress.com/" class="url" rel="ugc external nofollow">Andre Vellino</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-10T16:20:32+00:00">December 10, 2010 at 4:20 pm</time></a> </div>
<div class="comment-content">
<p>I once worked for a company that had an amazingly, beautifully hyper-normalized DB for storing e-mail on an embedded device. Efficiency / storage was one big concern. But the tradeoff was *impossible to maintain*, let alone properly understand or debug SQL queries. Which made the UI to the DB really nasty to work with (and often slow too!)</p>
<p>So I agree with you &#8211; Normal forms are a dogma and ultimately an expensive one too (in situations where they are not really needed).</p>
<p>I&rsquo;m using these two blog posts in my next DB class!</p>
</div>
</li>
<li id="comment-54020" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-10T17:15:20+00:00">December 10, 2010 at 5:15 pm</time></a> </div>
<div class="comment-content">
<p>@Andre </p>
<p>Thanks for the testimonial.</p>
</div>
</li>
<li id="comment-54273" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ba41c316d1c8c870ec12e44908beed15?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ba41c316d1c8c870ec12e44908beed15?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">tyler</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-03-12T20:01:05+00:00">March 12, 2011 at 8:01 pm</time></a> </div>
<div class="comment-content">
<p>I have a question. I&rsquo;m loving the idea of ditching normalization. But I&rsquo;m not quite sure how to solve one problem. I can picture a site with profile pages and forums all being denormalized. But what if you don&rsquo;t use their real name and a username&#8230; and they want to change their username? There would be thousands of records with the username hardcoded into the db. Or let&rsquo;s say you don&rsquo;t allow the user to change their username. But there is an avatar_url field. And they change their avatar?</p>
</div>
</li>
<li id="comment-54275" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-03-13T16:57:07+00:00">March 13, 2011 at 4:57 pm</time></a> </div>
<div class="comment-content">
<p>@tyler</p>
<p>(1) My claim is not that normalization is bad. Certainly master-detail schemas are useful and a good practice. I oppose &ldquo;over-normalization&rdquo; which leads to overly complicated schemas.</p>
<p>(2) Do you actually want the name to be updated in old posts? What about the reported home page and email addresses? The answer is maybe not so obvious. If you send an email today, and change your name tomorrow, email systems won&rsquo;t go back and update old emails. </p>
<p>(3) It can become quite wasteful to join the tables each and every time just for the rare event where someone might change his name. From an engineering point of view, it might make a lot more sense to take a big hit when the user does change his name, possibly doing it in an eventually consistent manner (for a time, both names may appear), than paying a price all the time for a feature that most users may never use. Which is better for your application is a matter of trade-off. You should maybe compare the two options experimentally.</p>
</div>
</li>
<li id="comment-54505" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b37c918d4ef2f6a16f8daa82608c0b0e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b37c918d4ef2f6a16f8daa82608c0b0e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ethan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-06-15T10:39:39+00:00">June 15, 2011 at 10:39 am</time></a> </div>
<div class="comment-content">
<p>To me, what your comments above (such as: I do ask however whether this possibility you evokeâ€”that the names will go out of sync whereas they shouldn&rsquo;tâ€”is a real threat) suggest is that you&rsquo;ve never been responsible for anything where you have to provide real data to real people with real results behind them.</p>
<p>Web apps have an advantage in this regard: they often don&rsquo;t matter. The company I work for does data processing and manipulation for law firms, and we provide a hosted data review platform for their convenience. It is a web app, but the data from it is provided, in the end, to courts and counsel.</p>
<p>So it matters greatly that what comes out relates to what goes in in a deterministic fashion. When a client decides to use redundant tags on objects, the result becomes easily apparent at production time, when it becomes a web to untangle to determine what is REALLY relevant/privileged/redacted/whatever.</p>
<p>Making sure that your information is normalized is ESSENTIAL if you are managing any data of actual consequence. While over-normalization is possible to some degree, it is really an esoteric idea suited only to highly performance-driven situations (and much of the time this can be fixed either by calling functions built into the database engine itself rather than reimplementing them in the application code&#8230; or by optimizing properly the applications database calls and caching the appropriate info&#8230; this all assumes that indexes are assigned right in the first place, of course.)</p>
<p>UNDER-normalization is a far, far more common situation, and one with real consequences.</p>
</div>
</li>
</ol>
