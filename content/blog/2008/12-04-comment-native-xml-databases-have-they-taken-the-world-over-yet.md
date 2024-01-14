---
date: "2008-12-04 12:00:00"
title: "Native XML databases: have they taken the world over yet?"
index: false
---

[10 thoughts on &ldquo;Native XML databases: have they taken the world over yet?&rdquo;](/lemire/blog/2008/12-04-native-xml-databases-have-they-taken-the-world-over-yet)

<ol class="comment-list">
<li id="comment-50324" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/880cbab435f00197613c9cc2065b4f5a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/880cbab435f00197613c9cc2065b4f5a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Daniel Haran</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-04T16:03:55+00:00">December 4, 2008 at 4:03 pm</time></a> </div>
<div class="comment-content">
<p>Those databases came around a time I was starting to throw up XML and XSLT.</p>
<p>The new hotness &#8211; one that&rsquo;s not just driven by marketing hype &#8211; is document dbs. CouchDB looks like it&rsquo;s on course to let me do things as a developer that none of these legacy vendors are really attempting.</p>
</div>
</li>
<li id="comment-50325" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-04T17:59:03+00:00">December 4, 2008 at 5:59 pm</time></a> </div>
<div class="comment-content">
<p>XML and XSLT are fine. I like them both. For some tasks, they are ideal. (And no, they are not good for most things.)</p>
<p>Document-based databases such as CouchDB and Lotus Notes are indeed very interesting. I am just too cheap and lazy to get a cluster and work with CouchDB.</p>
</div>
</li>
<li id="comment-50326" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/880cbab435f00197613c9cc2065b4f5a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/880cbab435f00197613c9cc2065b4f5a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Daniel Haran</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-04T18:06:44+00:00">December 4, 2008 at 6:06 pm</time></a> </div>
<div class="comment-content">
<p>A cluster isn&rsquo;t stricly necessary to try out CouchDB.</p>
</div>
</li>
<li id="comment-50328" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/112d61920c9daa3192b59458acf1c8d2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/112d61920c9daa3192b59458acf1c8d2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://blog.jovermeulen.com/" class="url" rel="ugc external nofollow">Jo Vermeulen</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-05T03:40:11+00:00">December 5, 2008 at 3:40 am</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t know anything about document-based databases, but doesn&rsquo;t RDF already solve the same problem (i.e. handling schema updates in a more flexible way)?</p>
</div>
</li>
<li id="comment-50327" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cc6a6addc5eea5173dbed508b93719d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cc6a6addc5eea5173dbed508b93719d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">jason monberg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-05T01:53:50+00:00">December 5, 2008 at 1:53 am</time></a> </div>
<div class="comment-content">
<p>Mark Logic (I work there) offers an XML database that can be used for free for personal non-commercial projects:<br/>
<a href="http://developer.marklogic.com/" rel="nofollow ugc">http://developer.marklogic.com/</a></p>
<p>XML databases are ideal for the storage and query of documents where the content and the structure of the document are part of the query. In this case an XML database provides the ability to query documents at an arbitrary granularity across different document schemas.</p>
<p>An interesting read related to the topic of trends in different types of database systems is the â€˜One Size Fits All&rsquo; paper from Stonebraker et al:<br/>
<a href="http://www.cs.brown.edu/~ugur/fits_all.pdf" rel="nofollow ugc">http://www.cs.brown.edu/~ugur/fits_all.pdf</a></p>
</div>
</li>
<li id="comment-50330" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-05T09:38:30+00:00">December 5, 2008 at 9:38 am</time></a> </div>
<div class="comment-content">
<p>@Vermeulen </p>
<p>RDF is a (flexible) data model, not a database technology. Comparing CouchDB to RDF is apple-to-oranges. RDF does not say anything about indexing, aggregation, querying, updating&#8230; it is just a data model. In fact, RDF is not even XML (a common misconception)&#8230; it is just often written as XML.</p>
<p>What something like CouchDB does is to allow you to search and aggregate without *any* top-down schema definition.</p>
<p>Suppose, for example, that you want to add a new attribute to an existing database, say &ldquo;cost in Canada&rdquo;. With a tool like MySQL, this means you must change some table definition. But you cannot allow just any user to do it.</p>
<p>So your tool is not very flexible. With CouchDB&#8230; you are free as a bird.</p>
<p>But how do they still get fast queries? Ah! There is the magic!</p>
</div>
</li>
<li id="comment-50332" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/112d61920c9daa3192b59458acf1c8d2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/112d61920c9daa3192b59458acf1c8d2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://blog.jovermeulen.com/" class="url" rel="ugc external nofollow">Jo Vermeulen</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-05T12:36:01+00:00">December 5, 2008 at 12:36 pm</time></a> </div>
<div class="comment-content">
<p>@Daniel Thanks for the detailed explanation!</p>
<p>I was actually referring to RDF mapped into a relational DB to allow for more flexible schemas. But I&rsquo;m not at all sure if this will really work, and what will be the performance implications. See: <a href="http://www.rdfabout.com/comparisons.xpd#versus-rdbms" rel="nofollow ugc">http://www.rdfabout.com/comparisons.xpd#versus-rdbms</a> and <a href="http://infolab.stanford.edu/~melnik/rdf/db.html" rel="nofollow ugc">http://infolab.stanford.edu/~melnik/rdf/db.html</a> for how RDF could be mapped to a relational DB.</p>
<p>CouchDB certainly seems interesting, I should have a better look at it.</p>
</div>
</li>
<li id="comment-50333" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-05T12:50:35+00:00">December 5, 2008 at 12:50 pm</time></a> </div>
<div class="comment-content">
<p>@Vermeulen Ok. But still, RDF is at the model level. Something like CouchDB is really at the physical level. (It is actually an implementation of a physical model.)</p>
<p>I guess you could map a RDF model to CouchDB or to just about any database engine. As far as I can see, any database able to represent a 3-column table can be used with RDF.</p>
</div>
</li>
<li id="comment-50335" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/112d61920c9daa3192b59458acf1c8d2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/112d61920c9daa3192b59458acf1c8d2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://blog.jovermeulen.com/" class="url" rel="ugc external nofollow">Jo Vermeulen</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-06T05:50:41+00:00">December 6, 2008 at 5:50 am</time></a> </div>
<div class="comment-content">
<p>I see. I often just use RDF as a distributed data store whose schema can evolve easily 🙂 Heavy inferencing is usually too slow on mobile devices anyway. Maybe CouchDB can then be an alternative for this particular use case.</p>
<p>I believe so as well, representing (subject predicate object) triples is all you need.</p>
</div>
</li>
<li id="comment-50345" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b5228307a9ef9ddda2084b8b39af42e6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b5228307a9ef9ddda2084b8b39af42e6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://marklogic.blogspot.com" class="url" rel="ugc external nofollow">Dave Kellogg</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-10T16:03:14+00:00">December 10, 2008 at 4:03 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,</p>
<p>Having worked at an object database company (Versant) and an XML database company (Mark Logic), I believe that things are different this time.</p>
<p>I believe ODBMS failed to achieve broad adoption for two reasons: (1) the RDBMS itself was just being adopted so the timing was too early, (2) the primary value of an ODBMS was in easy persistence of C++ objects that could be worked around with about 15% more effort to map them relationally.</p>
<p>I think XML databases are different in a few respects. (1) ODBMS were DBMS i.e., they focused on D, data. Successful XML databases (e.g., MarkLogic) focus on content (i.e., documents). The data/document divide is real and there is a bigger gap that&rsquo;s harder for the RDBMSs to simply absorb. Sure they can stuff XML in columsn, but can they search large amounts of it effectively? No yet. </p>
<p>(2) XML databases are emerging at a time of general specialization in the DBMS market. </p>
<p>Think Teradata (data warehouse), Netezza (DW), Streambase (streams), MarkLogic (XML), Vertica (columns), and arguably even BigTable (parallelization) as many different types of DBMSs that are emerging.</p>
<p>So the idea isn&rsquo;t as simple as one new type of DBMS will replace the RDBMS. The RDBMS, slowly and over time, will be replaced by a family of specialized ones.</p>
</div>
</li>
</ol>
