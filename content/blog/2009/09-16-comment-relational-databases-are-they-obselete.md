---
date: "2009-09-16 12:00:00"
title: "Relational databases: are they obsolete?"
index: false
---

[7 thoughts on &ldquo;Relational databases: are they obsolete?&rdquo;](/lemire/blog/2009/09-16-relational-databases-are-they-obselete)

<ol class="comment-list">
<li id="comment-51546" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-09-16T13:19:42+00:00">September 16, 2009 at 1:19 pm</time></a> </div>
<div class="comment-content">
<p>Thanks Jerome. My point exactly. Though I don&rsquo;t predict that Oracle will continue to do well&#8230; I just don&rsquo;t think that Stonebraker&rsquo;s arguments as to why it will soon fail are correct. Making predictions that come true and having the proper world model are two different things.</p>
<p>I should point out that I am a big fan of Stonebraker&rsquo;s research. I would just not hire him as a business analyst.</p>
</div>
</li>
<li id="comment-51544" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dd5bb5276f09d20c9c78005e29a5462a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dd5bb5276f09d20c9c78005e29a5462a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.jeromepineau.com" class="url" rel="ugc external nofollow">Jerome Pineau</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-09-16T13:08:55+00:00">September 16, 2009 at 1:08 pm</time></a> </div>
<div class="comment-content">
<p>Daniel, I think you make an excellent point. There might just be what I call a &ldquo;Borg effect&rdquo; whereas the big boys start absorbing from columnar and other such niche technologies (I use the term loosely). We see this in PAX/Hybrid approaches to tabular/columnar and of course the new improved Exadata V2 which kinda indicates an OLTP/OLAP mix although the latter seems a bit tough to swallow based on existing numbers.</p>
</div>
</li>
<li id="comment-51559" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b81e3cb671b57b1e4c816efc29e51932?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b81e3cb671b57b1e4c816efc29e51932?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.tonybain.com" class="url" rel="ugc external nofollow">Tony Bain</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-09-17T06:45:18+00:00">September 17, 2009 at 6:45 am</time></a> </div>
<div class="comment-content">
<p>I think the sentiment of Stonebraker&rsquo;s message and the hype assigned to get it noticed are probably two slightly different things.</p>
<p>Yes column like stores and hash tables, Berkley and so on have been around for a long time. But over the last two decades we have largely forgotten about them and moved towards the general purpose RBDMS for almost everything. Ask 100 dev shops when was the last time they built something data centric not for a GP RDBMS (or even not for MySQL, Oracle or SQL Server) and I would be surprised if you got more than a couple of responses. But, this has had a lot of highly positive benefits in terms of standardization of development and economies of scale in data management (plus the GP RDBMS brings a lot to the pary in terms of performance, reliability, availability, recoverability and consistency etc). </p>
<p>But right now it is clear we still have problems. Analytic data volumes some time ago began to exceed the levels that it was possible to process queries in a reasonable timeframe on a single node. Plucky young analytics startups realized this and now it is pretty common to find MPP solutions in many organizations across all sectors (yes I know MPP also isn&rsquo;t new and Teradata has been around since the late 70&rsquo;s, but MPP really hasn&rsquo;t been mainstream accessible until recently). Also now even fairly benign enterprises, which may have hundreds or thousands of general purposes RDBMS deployments, are commonly struggling with a set of very high transaction processing requirements that are restricted with the limitations of GP RDBMS. </p>
<p>And of course in the web space the GP RDBMS was prevalent with MySQL the modern default for any web related data store. But, Web 2.0 forced the big players to go off and solve their own scale problems. This has led to the development of Cassandra, Voldemort, Dynamo and Hadoop etc â€“ and of course spawned the whole NoSQL movement. This was needs driven, I am sure they would have preferred the database community to have had a solution for them.</p>
<p>Any slightly extreme requirement in terms of performance, scalability, predictability or volume on GP RDBMS becomes an expensive and continually frustrating challenge.</p>
<p>With over 90% of a $20b market GP RDBMS won&rsquo;t be going away soon. However I think it is clear that â€œone sizeâ€ really doesn&rsquo;t fit all, and the percentage of requirements it does fit is slowly declining (but still maintaining the vast majority for the time being). A more diverse set of data management options with specialized solutions in both OLTP &amp; analytics seems to me to be a positive path forward.</p>
</div>
</li>
<li id="comment-51562" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2081fd079bb8d1f0c7057a839d267015?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2081fd079bb8d1f0c7057a839d267015?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.sqlservercentral.com/blogs/sqlmanofmystery/" class="url" rel="ugc external nofollow">Wes Brown</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-09-17T08:14:22+00:00">September 17, 2009 at 8:14 am</time></a> </div>
<div class="comment-content">
<p>It is a case of standardization and the &ldquo;good enough&rdquo; effect. Will RDMS&rsquo;es always be on top of the heap? I don&rsquo;t think so. But I do think they are going to be around a long time. </p>
<p>The problem is there is a lot of things already built on top of them and quite a bit performs just fine. </p>
<p>Just because another technology is superior in every way doesn&rsquo;t guarantee that it will dominate over all others.</p>
</div>
</li>
<li id="comment-51564" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kevembuangga</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-09-17T14:24:44+00:00">September 17, 2009 at 2:24 pm</time></a> </div>
<div class="comment-content">
<p>Mmmmm&#8230;<br/>
Isn&rsquo;t that <a href="https://news.ycombinator.com/item?id=683807" rel="nofollow">old news</a>, I mean&#8230; <i>Internetwise</i>!</p>
</div>
</li>
<li id="comment-51567" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/880cbab435f00197613c9cc2065b4f5a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/880cbab435f00197613c9cc2065b4f5a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Daniel Haran</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-09-17T17:32:15+00:00">September 17, 2009 at 5:32 pm</time></a> </div>
<div class="comment-content">
<p>Mongodb use cases:<br/>
&ldquo;Highly transactional systems, such as banking systems and accounting. Applications with highly complex yet atomic transactions are more suited to a traditional relational DBMS.&rdquo;<br/>
<a href="http://www.mongodb.org/display/DOCS/Use+Cases" rel="nofollow ugc">http://www.mongodb.org/display/DOCS/Use+Cases</a></p>
<p>Maybe most applications will be better off with key-value stores, but there are applications where RDBMSs are close to the perfect solution.</p>
</div>
</li>
<li id="comment-51573" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kevembuangga</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-09-24T01:48:29+00:00">September 24, 2009 at 1:48 am</time></a> </div>
<div class="comment-content">
<p>What would be the equivalent of <a href="http://www.joelonsoftware.com/items/2009/09/23.html" rel="nofollow">this</a> for database development?<br/>
Ha! Ha!</p>
</div>
</li>
</ol>
