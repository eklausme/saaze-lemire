---
date: "2010-11-29 12:00:00"
title: "Why do we need database joins?"
index: false
---

[53 thoughts on &ldquo;Why do we need database joins?&rdquo;](/lemire/blog/2010/11-29-why-do-we-need-database-joins)

<ol class="comment-list">
<li id="comment-53935" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-29T21:43:00+00:00">November 29, 2010 at 9:43 pm</time></a> </div>
<div class="comment-content">
<p>@Bannister</p>
<p>I think that I allude to part of the question you thought I&rsquo;d be asking. I work in data warehousing where we don&rsquo;t even talk about normal forms because the typical usage calls for modest normalization, or none at all. But I decided to be more drastic in my post.</p>
</div>
</li>
<li id="comment-53938" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-30T00:48:23+00:00">November 30, 2010 at 12:48 am</time></a> </div>
<div class="comment-content">
<p>@Justin</p>
<p>(1) My example is a typical textbook example. Assuming that a user has one and only one last name throughout his life is typical. There are many more subtle limitations enforced by database schemas. Anyone who has had to use enterprise systems knows how inflexible they can be, if not unusable.</p>
<p>(2) I&rsquo;m well aware of the difference between transactions and warehousing. I would even say that I&rsquo;m accutely aware of the difference. But that&rsquo;s not so relevant to my main claims. Data warehouses almost all rely on normalization extensively. I&rsquo;m saying they shouldn&rsquo;t. I&rsquo;m saying we could build transaction systems with very few joins. </p>
<p>(3) I am outside the dogma here. If you think I am wrong, I&rsquo;m interested in reading your arguments. However, I see no need for &ldquo;an academic should know better&rdquo;. Academic researchers are wrong all the time, at least those who are any good. Criticizing the dogma is precisely my job, as I see it. The guy who runs the bank database can&rsquo;t afford to take risks and be wrong&#8230; I can afford to be dead wrong&#8230; as long as I&rsquo;m wrong in an interesting way. And this blog is precisely where I choose to test my craziest ideas. If you want more conservative, try my research papers&#8230; they are peer reviewed&#8230;</p>
</div>
</li>
<li id="comment-53939" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-30T01:01:39+00:00">November 30, 2010 at 1:01 am</time></a> </div>
<div class="comment-content">
<p>@Bannister</p>
<p>Absolutely. Stonebraker predicted the imminent rise of specialized engines. I think that he is a bit too eager.</p>
</div>
</li>
<li id="comment-53934" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-29T21:04:55+00:00">November 29, 2010 at 9:04 pm</time></a> </div>
<div class="comment-content">
<p>From the title, at first I thought you were going to ask a different question.</p>
<p>As to the SQL or no-SQL noise, I just cannot see any reason to get excited. Choose the database to fit the problem. By &ldquo;database&rdquo; I mean anything from a flat text file, through small and large SQL databases, or whatever else makes sense. </p>
<p>Follow the patterns in your application. Doing lots of complex queries, with more in the future? SQL should be a good bet. Doing simple queries in huge volume? A more specialized database may be a better fit. </p>
<p>What I thought you might be asking &#8211; what falls between &#8211; is what to do when you have <b>both</b> a high-volume special-purpose database, and an SQL database. Or when you have two SQL databases with different implementations (and differing performance characteristics). Joins <b>between</b> databases of differing nature are &#8230; not well treated?</p>
<p>Since we are visiting the topic of choosing differing sorts of databases, we should also be interested in clearly defined semantics and behavior when those differing databases need to be accessed to satisfy a query.</p>
</div>
</li>
<li id="comment-53936" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-29T22:17:02+00:00">November 29, 2010 at 10:17 pm</time></a> </div>
<div class="comment-content">
<p>To your arguments about normalization, I completely agree. </p>
<p>When using specialized databases, at some point you will encounter the &ldquo;join&rdquo; problem. The main bulk of the application may be best suited for a specialized sort of database, but there are likely some tasks best suited to an SQL database. Of course, you can write custom code to glue the two together, but this costs much developer time, and can work poorly if algorithms are poorly chosen. If use of specialized databases is to become common, then common use needs to support direct &ldquo;joins&rdquo; between dissimilar databases. </p>
<p>For long term adoption of specialized databases, this problem is the elephant-in-the-room that needs to be addressed &#8211; and is not much discussed.</p>
</div>
</li>
<li id="comment-53937" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fcf5054b638e8f76eb84507c08df83fd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fcf5054b638e8f76eb84507c08df83fd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Justin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-29T23:56:10+00:00">November 29, 2010 at 11:56 pm</time></a> </div>
<div class="comment-content">
<p>Surely you can&rsquo;t apply the design techniques for data warehousing in typical transaction oriented systems ?!</p>
<p>In addition, there is no DBA worth his title who would not de-normalize the schema as needed for the application. </p>
<p>I&rsquo;m really surprised at the use of the strawman example as well .. an academic should know better.</p>
</div>
</li>
<li id="comment-53942" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-30T09:28:04+00:00">November 30, 2010 at 9:28 am</time></a> </div>
<div class="comment-content">
<p>@Paul </p>
<p>In a relational database, you can handle the multi-author case without normalization by repeating the entries. Thus, there would be several entries with the same &ldquo;document ID&rdquo;. It looks wasteful, and would certainly be in most current database systems. Nevertheless, a sufficiently smart database engine could make it efficient, in theory. (Whether it is possible in practice, I do not know.)</p>
<p>This being said, it is trivial in a document-oriented database to avoid joins, and this was the topic of Curt Monash&rsquo;s post. I would argue, in fact, that for bibliographic data, the relational model is a poor match because the data is too often irregular. (That is, it can be made to work, but it will introduce unnecessary complexity for the programmer.)</p>
</div>
</li>
<li id="comment-53940" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1a73ee442b015b7eb4c65211a8982632?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1a73ee442b015b7eb4c65211a8982632?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mike Martin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-30T04:51:10+00:00">November 30, 2010 at 4:51 am</time></a> </div>
<div class="comment-content">
<p>Denormalization is just as important to normalization. It&rsquo;s a spectrum. Normalize a few tables to reduce redundant data and create faster writes. Denormalize a few tables to speed up reporting or database reads (because of less joins), although at the expense of having more redundant data. Normalization does improve database integrity. Denormalization means the application needs to manage the integrity.</p>
<p>Many an Indian programmer I&rsquo;ve run across has only been taught to normalize the heck out of everything, and they have not been taught about the benefits of denormalization.</p>
<p>So, if you have a call tracking system where calltakers are entering order records very fast, then normalize those tables a bit and you&rsquo;ll improve the write speed. And if you have a reporting system, or those call takers need to see summary information really fast on multiple accounts, then pull that from one or more denormalized tables.</p>
<p>I find it best to put the order entry tables in its own database in order to avoid abuse by other programmers who might want to denormalize it. As well, put the reporting system in another database in order to avoid abuse by programmers who might want to normalize it. And then use batch replication to move records between the two.</p>
<p>But in many companies, you really need 3 databases for a major system workflow. One is normalized fairly well and is for storing a queue of new records being entered in. But these are unqualified records &#8212; raw data. Once these records are cleaned up and merged with existing data (such as lookups that tack on extra columns or do code swaps for longer phrases) &#8212; that sort of thing needs to go into a production database that is slightly normalized, but not nearly as normalized as the order entry system. It is the production database that is the definitive database that gets the company stamp of approval for having the final say on a customer&rsquo;s latest approved data. But then you need a reporting database where heavy reads and number crunching can occur for all kinds of scenarios. And this is where a database needs to be created just for that, with a fair amount of denormalization.</p>
</div>
</li>
<li id="comment-53944" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-30T10:31:09+00:00">November 30, 2010 at 10:31 am</time></a> </div>
<div class="comment-content">
<p>@Paul</p>
<p><em>Now, if another field could have multiple values (paper awards?) you&rsquo;d start to face combinatorial duplication and would have to normalize eventually.</em></p>
<p>Who said that the physical layout needed to match the logical layout? Why can&rsquo;t the database automatically do the normalization if it needs to?</p>
<p>(Again, I stress that I don&rsquo;t know whether databases could actually remain efficient and do the equivalent of the normalization on their own.)</p>
<p><em>you have to develop an aversion for duplicated data</em></p>
<p>I don&rsquo;t think that it needs to be generally true. On a Mac, it is common to bundle the software libraries with the application. On Windows and Linux, it is often consider wasteful.</p>
<p>But is it wasteful, really? Yes. Mac applications use more memory and disk space. But they are much less likely to break down. They are much easier to install and uninstall. And testing a Mac application is much easier because you don&rsquo;t have to fear that the user might have a slightly different version of the software library you rely on.</p>
</div>
</li>
<li id="comment-53947" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-30T13:11:17+00:00">November 30, 2010 at 1:11 pm</time></a> </div>
<div class="comment-content">
<p><em>In the DB example I might fix a typo in just one version of the title.</em></p>
<p>It is a trade-off between agility and safety. </p>
<p>But remember that prior to the Web, people working on hypertext systems were awfully worried about broken links. People *thought* that high reliability mattered.</p>
<p>It practice, it seems that we often overestimate the problems caused by small failures, and we underestimate the benefits of agility.</p>
</div>
</li>
<li id="comment-53941" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c47d7a71160b9ec79d34316139ff3cdb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c47d7a71160b9ec79d34316139ff3cdb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://futurepaul.blogspot.com" class="url" rel="ugc external nofollow">Paul</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-30T08:57:23+00:00">November 30, 2010 at 8:57 am</time></a> </div>
<div class="comment-content">
<p>To some extent I agree: it&rsquo;s usually not the case that normalizing for the sake of normalizing is necessary. Personally, I tend to keep everything together until there&rsquo;s a significant reason not to. The caveat being my DB experience is in the context of data manipulating applications, and thus not necessarily applicable to more common use cases.</p>
<p>However, the example is easy, if crude, to fix: create an alias table that says lampron01 and smith02 are the same person, and use that whenever you&rsquo;re pulling articles by an author. More joins, longer queries, but it works. The counter example, though, is dealing with the first multi-author paper that arrives. In a slightly more normalized schema you just connect the doc_id to multiple author_id&rsquo;s. In a denormalized schema you&rsquo;re stuck with, what, delimiters? Now you&rsquo;ve got to use wildcard matches to look up an author, and querying by author count requires more work.</p>
<p>Of course, my terminology may be off: does that still constitute normalization, or is a many-to-many relationship just assumed to be inherently multi-tabular? In any case, it&rsquo;s one more example of how important it is to a) be able to easily change your schema or b) correctly predict the crazy data you&rsquo;ll eventually have to process.</p>
</div>
<ol class="children">
<li id="comment-252932" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/afe3ab01ae376c76ee9d9943c1f441a0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/afe3ab01ae376c76ee9d9943c1f441a0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://jerrygallagher.blogspot.com/" class="url" rel="ugc external nofollow">Jerry Gallagher</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-20T20:38:19+00:00">September 20, 2016 at 8:38 pm</time></a> </div>
<div class="comment-content">
<p>In a slightly more normalized schema you just connect the doc_id to multiple author_id&rsquo;s. In a denormalized schema you&rsquo;re stuck with, what, delimiters?</p>
<p>Hmm, No. In a denormalized Schema I just add the Second Author and the UUID of the Author and I still have the UUID of the Doc. Just because I have denormalized data in my schema just means I have redundant copies and groupings that make sense for read and application performance.</p>
</div>
</li>
</ol>
</li>
<li id="comment-53950" class="comment byuser comment-author-lemire bypostauthor even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-30T14:16:45+00:00">November 30, 2010 at 2:16 pm</time></a> </div>
<div class="comment-content">
<p>@Bannister</p>
<p><em>Are we talking about normalization, or (&#8230;) storing repeated column values once?</em></p>
<p>Storing repeated values once (or as few times as needed) is precisely what normalization is. We have come to view it strictly in terms of relational algebra, but the idea predates relational algebra. That&rsquo;s why I wrote <strong>many database compression techniques are types of normalization.</strong></p>
<p>Of course, normalization also does away with entire columns, so it is more than just storing column values once. You have to handle column dependencies as well.</p>
</div>
</li>
<li id="comment-53943" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c47d7a71160b9ec79d34316139ff3cdb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c47d7a71160b9ec79d34316139ff3cdb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://futurepaul.blogspot.com" class="url" rel="ugc external nofollow">Paul</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-30T09:53:16+00:00">November 30, 2010 at 9:53 am</time></a> </div>
<div class="comment-content">
<p>@Daniel</p>
<p>I think that hit home your point for me. My reaction to your suggestion was basically fear. Storing a city name in the row, fine. But two mostly duplicate records??? Thinking through, it&rsquo;s really no more dangerous than another setup, even lots of the queries would be identical. But working with computers, I think you have to develop an aversion for duplicated data, because in most cases they will fall out of sync. This is sort of an exception to that rule, where a healthy fear of ever storing the same constant in two places can be put aside.</p>
<p>Now, if another field could have multiple values (paper awards?) you&rsquo;d start to face combinatorial duplication and would have to normalize eventually.</p>
<p>But as you say, bibliographic data is often irregular and not a good fit for highly structured schemas. Hmm&#8230;semi-structured data&#8230;I wonder what we could <a rel="nofollow">use instead</a>? 🙂</p>
</div>
</li>
<li id="comment-53945" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c4e926fdc0905d11899b69c6387f6ed7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c4e926fdc0905d11899b69c6387f6ed7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Achilleas Margaritis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-30T11:37:59+00:00">November 30, 2010 at 11:37 am</time></a> </div>
<div class="comment-content">
<p>What if, instead of tables, only columns were used, and the database automatically eliminated duplicate entries for each column? multicolumn tables would exist only for keeping relationships between columns of data, using the indexes of entries into the column. This would automate normalization and make joins reduntant.</p>
</div>
</li>
<li id="comment-53946" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c47d7a71160b9ec79d34316139ff3cdb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c47d7a71160b9ec79d34316139ff3cdb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://futurepaul.blogspot.com" class="url" rel="ugc external nofollow">Paul</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-30T12:00:08+00:00">November 30, 2010 at 12:00 pm</time></a> </div>
<div class="comment-content">
<p>@Daniel</p>
<p>It&rsquo;s an interesting suggestion. In essence you&rsquo;d retain normalization when valuable, but handle the joins behind the scenes. Of course, the choice to normalize or not should be based on the work load of the db, so you&rsquo;d have to let it do load tracking and switch the schema, if, e.g., a certain insert is becoming a bottleneck. Technically complicated, and a master dba might do a better job, but for the 99% case it could let a developer run a db well with a very cursory knowledge of the topic. I suppose this is the way software tools are headed.</p>
<p>re: duplicated data, while code is technically just data, I was referring more specifically to the data code operates on (like what you&rsquo;d store in a db). When each application has its own address book, I might update a friend&rsquo;s email address in one place but not another. In the DB example I might fix a typo in just one version of the title. I am also somewhat hesitant to duplicate code, but only within an application boundary: I agree that shipping the libraries you need makes life much easier.</p>
</div>
</li>
<li id="comment-53948" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-30T13:50:33+00:00">November 30, 2010 at 1:50 pm</time></a> </div>
<div class="comment-content">
<p>Are we talking about normalization, or individual columns and storing repeated column values once?</p>
<p>(Though you might be able to derive something like normalization &#8230; with a few hints from both the compression algorithm and from the designer.)</p>
<p>Come to think of it &#8230; one of the algorithms I used for very high performance table extraction might be useful. Somewhat out of scope for this discussion.</p>
<p>(Have to think about this a bit.)</p>
</div>
</li>
<li id="comment-53953" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/aa70c72cd3f9ebece2345dd7c4fdcff2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/aa70c72cd3f9ebece2345dd7c4fdcff2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">jam</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-30T16:30:20+00:00">November 30, 2010 at 4:30 pm</time></a> </div>
<div class="comment-content">
<p>The problem here isn&rsquo;t normalization, it&rsquo;s a misunderstood requirement. You need to store the author name printed on the book, and that belongs with the book table. That&rsquo;s a different piece of data than the author&rsquo;s current name, which in a normalized database you would store in a different table. </p>
<p>This would help make clear what to do when the author&rsquo;s name changes: update it in the authors table, and leave the book table alone. </p>
<p>Without the authors table, you have to either update the author&rsquo;s old books, or you can&rsquo;t store the new name. Or you could query for the name associated with that authorid&rsquo;s latest book, but that&rsquo;s so much more of a pain than just looking it up in a table keyed by authorid.</p>
<p>(I would say that normalization is storing each semantically distinct piece of information once. Storing the value &ldquo;Tom Smith&rdquo; more than once is fine, as long as they refer to different things.)</p>
</div>
</li>
<li id="comment-53955" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8822a1b58354e1850ce7d35541d95ccb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8822a1b58354e1850ce7d35541d95ccb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.jroller.com/dmdevito/" class="url" rel="ugc external nofollow">Dominique De Vito</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-01T07:53:07+00:00">December 1, 2010 at 7:53 am</time></a> </div>
<div class="comment-content">
<p>1) I do agree NoSQL could be renamed as NoJoin, as I think NoSQL are very close to be disguised object databases as I wrote here:<br/>
<a href="http://www.jroller.com/dmdevito/entry/thinking_about_nosql_databases_classification" rel="nofollow ugc">http://www.jroller.com/dmdevito/entry/thinking_about_nosql_databases_classification</a></p>
<p>2) you wrote: &ldquo;Yet, we never retroactively change the names of the authors on a paper.&rdquo; and that&rsquo;s quite a great observation.</p>
<p>It leads me to think about critical IT systems. For quite a number of such systems I have worked on, data are never updated for tracability purposes; instead new values are added &ldquo;on top of the stack&rdquo;. So, it sounds like &ldquo;we never retroactively change the past data [like the names of the authors on a paper, as you wrote]&rdquo;. That&rsquo;s quite an interesting argument in favor of NoSQL databases, as RDBMS promoters say normalization is better, e.g. for update purposes. So, if there are less updates than expected, then there is less need for normalization (I am not writing here normalization is fully useless).</p>
<p>3) I like the idea of using a blog for testing craziest ideas, as I do the same.</p>
</div>
</li>
<li id="comment-53954" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/73bfac91877fce35c6d20e16e9e53677?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/73bfac91877fce35c6d20e16e9e53677?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">rxin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-01T03:42:30+00:00">December 1, 2010 at 3:42 am</time></a> </div>
<div class="comment-content">
<p>This comment is better to go in your previous post but you&rsquo;ve disabled commenting in there. So here we go.</p>
<p>First, &ldquo;NoSQL&rdquo; is a terrible name. NoSQL can contain a wide spectrum, from distributed key value stores to graph databases. For our discussion here, let&rsquo;s limit the domain to the NoSQL you were referring to in your NoJoin post.</p>
<p>Now my main point: NoSQL is about loosening consistency (ACID) rather than about NoJoin or No*SQL*.</p>
<p>RDBMSes were developed from the 70s to the 90s, originally for enterprise data management. There are two nice properties about traditional RDBMSes: ACID and data independence. ACID ensures transactions are processed reliably (e.g. you don&rsquo;t want to mess with financial data). Data independence enables the developer to specify what data they want, rather than how the data are read/write, and the optimizer chooses the execution plan. This (independence) is a big deal because the application can remain unchanged even though the underlying software/hardware system undergoes significant updates. </p>
<p>These two (ACID and independence), however, are orthogonal.</p>
<p>Traditional RDBMSes are based on the closed-world assumption, where the number of users and concurrent transactions are limited. Even for the largest enterprise, its database can probably run on a single super powerful node. ACID is easy when the number of nodes are small. Developers don&rsquo;t get a choice. ACID is strictly enforced.</p>
<p>In the last 10 &#8211; 15 years, databases are increasingly being used for the web (open-world). For most web applications, it is not uncommon to have thousands of nodes. To guarantee availability and balance load, data replication (both within datacenter and inter datacenter) is widely applied. In these cases, it is simply too expensive, if not impossible, to enforce ACID (CAP theorem). It is also OK to loosen the consistency constraint thanks to the nature of the applications (e.g. I don&rsquo;t mind xxx not being my friend on Facebook for 20 seconds).</p>
<p>Consistency aside, nothing prevents us from implementing a declarative query language and an optimizer for the NoSQL databases. The query language and optimizer can for sure support joins. There is actually an active research project at Berkeley on building a SQL-like language and an optimizer on a distributed key-value store that has predictable performance upper-bound.</p>
<p>The various NoSQL databases (MongoDB, Riak, etc) are really about loosening the C in CAP, not about joins or SQL itself.</p>
</div>
</li>
<li id="comment-53957" class="comment byuser comment-author-lemire bypostauthor even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-01T10:24:29+00:00">December 1, 2010 at 10:24 am</time></a> </div>
<div class="comment-content">
<p>@Huwing</p>
<p>I&rsquo;m not arguing against relational databases. I am arguing against complex schemas.</p>
</div>
</li>
<li id="comment-53956" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5dd7be33293332bbe32a1f5d749aa026?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5dd7be33293332bbe32a1f5d749aa026?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Steven Huwig</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-01T10:18:54+00:00">December 1, 2010 at 10:18 am</time></a> </div>
<div class="comment-content">
<p>Your strawman data modeler suggesting &ldquo;normalization&rdquo; of the example table is not familiar enough with the domain being modeled. It is a database of research papers, not a customer list. Research papers have named authors that they are published under, and that is what will always appear in a record of the research paper.</p>
<p>Managing author name changes is part of the practice called &ldquo;authority control,&rdquo; and you wouldn&rsquo;t just update an author&rsquo;s name. You would reference another record containing the accepted version of the author&rsquo;s name. For example, the Library of Congress has an entry for Samuel Clemens at <a href="https://goo.gl/hdm8F" rel="nofollow ugc">http://goo.gl/hdm8F</a> , but it just points to Mark Twain.</p>
<p>Since computerized bibliographic standards practices predate the relational model of data, the state of the art does not use data normalization. However, there is no reason that the relational model of data could not be used for this purpose, given sufficient expertise and investment in developing an appropriate schema.</p>
<p>Your example is more an argument against domain ignorance than against relational databases.</p>
</div>
</li>
<li id="comment-53958" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5dd7be33293332bbe32a1f5d749aa026?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5dd7be33293332bbe32a1f5d749aa026?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Steven Huwig</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-01T10:32:14+00:00">December 1, 2010 at 10:32 am</time></a> </div>
<div class="comment-content">
<p>If so, it seems to me that you&rsquo;ve successfully argued against complex schemas developed without the proper domain knowledge. But I am not sure that the argument against developing from ignorance is particularly novel&#8230;</p>
</div>
</li>
<li id="comment-53959" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0cbc613fbbbcb19cf5e00d6deeb6ca5e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0cbc613fbbbcb19cf5e00d6deeb6ca5e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.casualmiracles.com" class="url" rel="ugc external nofollow">Lance Walton</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-01T11:04:35+00:00">December 1, 2010 at 11:04 am</time></a> </div>
<div class="comment-content">
<p>In the example you have given, your model of the domain allows for surnames to vary for the same authorID and this suggests that there is no functional dependency between authorID and author name. The problem is that your database expert seems unaware of this and has made an assumption that turns out to be invalid.</p>
<p>The table is currently in at least 3NF, but would lose it the moment another row is added that contains the same combination of authorID and author name. In order to solve this, you&rsquo;d have to normalise it somehow, but doing that without understanding the domain would certainly require a further adjustment at a later time.</p>
<p>I have been working on &lsquo;enterprise&rsquo; systems with &lsquo;enterprise&rsquo; SQL databases for 18 years and the problem I have encountered most often is that SQL databases are unnormalised (as distinct from &lsquo;denormalised&rsquo;). In addition, &lsquo;keys&rsquo; are frequently unstable, relationships between tables are broken, etc. In other words, people don&rsquo;t know how to manage with their data.</p>
<p>This problem would be the case whether they use SQL databases, relational databases, object databases, or another non-relational forms of database. It would also be the case regardless of whether they managed the integrity of their data in the database or in the application.</p>
<p>It is this lack of comprehension that makes the database complex, not the fact of normalisation. Just as a lack of understanding about how to program makes for complex and usually buggy code.</p>
</div>
</li>
<li id="comment-53967" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de61f343fee369f06d1226ddcc74142c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de61f343fee369f06d1226ddcc74142c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Siva Narayanan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-03T09:12:45+00:00">December 3, 2010 at 9:12 am</time></a> </div>
<div class="comment-content">
<p>This is a nice subject and one that deserves a little survey. I ask a related question on Quora: <a href="https://www.quora.com/De-normalizing-views" rel="nofollow ugc">http://www.quora.com/De-normalizing-views</a></p>
</div>
</li>
<li id="comment-53969" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f00fd13956fb84308e75c35aaa8c1a10?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f00fd13956fb84308e75c35aaa8c1a10?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Otfried Cheong</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-04T09:54:03+00:00">December 4, 2010 at 9:54 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m appalled by the sexist assumptions in this post 🙂</p>
<p>You don&rsquo;t have to be female to change your name during your lifetime.</p>
<p><a href="http://www.informatik.uni-trier.de/~ley/db/indices/a-tree/c/Cheong:Otfried.html" rel="nofollow ugc">http://www.informatik.uni-trier.de/~ley/db/indices/a-tree/c/Cheong:Otfried.html</a></p>
<p><a href="http://academic.research.microsoft.com/Author/154726.aspx" rel="nofollow ugc">http://academic.research.microsoft.com/Author/154726.aspx</a></p>
</div>
</li>
<li id="comment-53970" class="comment byuser comment-author-lemire bypostauthor even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-04T12:48:32+00:00">December 4, 2010 at 12:48 pm</time></a> </div>
<div class="comment-content">
<p>@Cheong</p>
<p>I specifically wrote:&rdquo;And indeed, people have their names changed all the time. &rdquo; (Not just ladies.)</p>
<p>Yet, I was trying to make a joke of the fact that IT departments are often male only.</p>
<p>Sorry if my post felt sexist to you. I should have been more careful.</p>
</div>
</li>
<li id="comment-53971" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f00fd13956fb84308e75c35aaa8c1a10?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f00fd13956fb84308e75c35aaa8c1a10?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Otfried Cheong</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-04T20:22:24+00:00">December 4, 2010 at 8:22 pm</time></a> </div>
<div class="comment-content">
<p>I was joking, of course, hence the smiley.</p>
<p>DBLP is pretty good at this:</p>
<p><a href="http://www.informatik.uni-trier.de/~ley/db/indices/a-tree/b/Bereg:Sergey.html" rel="nofollow ugc">http://www.informatik.uni-trier.de/~ley/db/indices/a-tree/b/Bereg:Sergey.html</a></p>
<p>DBLP seems to have had the possibility of doing this right from the beginning, probably because it was created in a country were until recently nearly all women changed their family when they got married.</p>
<p>Microsoft&rsquo;s Academic Search did not have it &#8211; in China names are constant throughout a lifetime &#8211; and in fact the feature was added recently to handle variant spellings of the same name. (And I had to ask them to merge my two author profiles.) Sergey still has two profiles there (which, amusingly, shows the same photo).</p>
<p>In any case, our cases are so rare that I&rsquo;m mentioned in this paper: <a href="http://www.springerlink.com/content/c6472216637p57w4/" rel="nofollow ugc">http://www.springerlink.com/content/c6472216637p57w4/</a></p>
<p>On the other hand, many female researchers have published under more than one name during their career.</p>
</div>
</li>
<li id="comment-53972" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/07168c459dcd35c128757f8529306160?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/07168c459dcd35c128757f8529306160?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.votefromabroad.org/vote/home.htm" class="url" rel="ugc external nofollow">Kevin Lyda</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-05T16:48:55+00:00">December 5, 2010 at 4:48 pm</time></a> </div>
<div class="comment-content">
<p>There are good arguments against databases. This is not one of them.</p>
<p>authorID should be a number internally assigned by the DB. To translate into Unix FS semantics, it should be an inode number. Having a DB key based on the data is a dumb idea. For instance if it&rsquo;s a number it&rsquo;s faster to index/lookup than the variable length strings you have in your example.</p>
</div>
</li>
<li id="comment-53973" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b5275a38f8cbe9e3303864be17e38064?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b5275a38f8cbe9e3303864be17e38064?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Rommel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-05T17:02:22+00:00">December 5, 2010 at 5:02 pm</time></a> </div>
<div class="comment-content">
<p>I agree with the previous comments that point out that this is not a problem with normalization but with misunderstanding the problem domain. </p>
<p>I would like to add though that normalization is mischaracterized here (and is often so in other sources as well) to be about eliminating redundancy. Normalization tends to reduce redundancy but is not the point of it, otherwise its just data compression as alluded here. See <a href="https://en.wikipedia.org/wiki/Database_normalization" rel="nofollow ugc">http://en.wikipedia.org/wiki/Database_normalization</a>.</p>
<p>The primary goal of normalization is to eliminate update anomalies and its focus is not on redundancy per se but functional dependencies.</p>
<p>This reminds me of a newbie mistake of creating a string table (ID, String), a number table (ID, Number), etc. then creating a person table with (PersonID, FirstNameID, LastNameID, AgeID) that links to those &ldquo;data type&rdquo; tables arguing &ldquo;what if I store 2 persons with the same last name? or with the same age? those are redundancies that I need to eliminate in pursuit of normalization&rdquo;</p>
</div>
</li>
<li id="comment-53974" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/81df87e0d3e269d6fa6a17c6914fd656?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/81df87e0d3e269d6fa6a17c6914fd656?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://mikeschinkel.com" class="url" rel="ugc external nofollow">Mike Schinkel</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-05T23:44:49+00:00">December 5, 2010 at 11:44 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;d like to take issue with your example although I&rsquo;ll leave the debate on your thesis to others because frankly, even with 20+ years of database experience I still don&rsquo;t feel qualified to know for sure what is the right answer.</p>
<p>But in the case of &ldquo;author&rdquo; you are off base. One of the key reasons to normalize author (with an author_id that has no meaning other than to be a key) is to establish *identify* for the author record. Certainly the author may change their name but they doesn&rsquo;t change who they are. Without normalization you can too easily loose track of that identity. Have a system where knowing that identity is not important to your business case? Go ahead and denormalize.</p>
<p>Let me give another use-case that illustrates this even better: Invoices and Customers. If a customer moves we still want our invoices to show their old address that we actually shipped to. So by your argument I would store all my customer information in each of my invoices, in a denormalized manner. But without normalization, when my customer changes their address or their business name, now I&rsquo;ve lost track of their identity. </p>
<p>Instead we should store in the invoice that which we want to record about the customer at a point in time, i.e. their shipping address. But we want to know their *current* billing address even if it has changed because we don&rsquo;t want to loose track of who owes us money when they move! If we don&rsquo;t have a normalized customer record we really can&rsquo;t.</p>
<p>So while denormalization can have benefits, it&rsquo;s not a panacea. Or as a wise man once said: &ldquo;Moderation in all things.&rdquo;</p>
<p>-Mike</p>
</div>
</li>
<li id="comment-53975" class="comment byuser comment-author-lemire bypostauthor odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-06T09:24:38+00:00">December 6, 2010 at 9:24 am</time></a> </div>
<div class="comment-content">
<p>@Schinkel</p>
<p><em>So by your argument I would store all my customer information in each of my invoices, in a denormalized manner. </em></p>
<p>No. What I&rsquo;m saying is that should the developer choose to do so at a later date, he shouldn&rsquo;t need to change the database schema.</p>
</div>
</li>
<li id="comment-53976" class="comment byuser comment-author-lemire bypostauthor even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-06T09:32:04+00:00">December 6, 2010 at 9:32 am</time></a> </div>
<div class="comment-content">
<p>@Rommel </p>
<p><em>The primary goal of normalization is to eliminate update anomalies </em></p>
<p>It is the first reason listed in my post for normalization: &ldquo;To simplify the programming of the updates.&rdquo;</p>
<p>The problem is that nobody can give me any sort of documentation as to how often databases are corrupted due to update anomalies due to lack of normalization. These would have to come through programming bugs because you don&rsquo;t need normalization to do the updates right. It might just be more difficult. But it is only significantly more difficult if the schema is complicated. But why is the schema complicated in the first place?</p>
</div>
</li>
<li id="comment-53978" class="comment byuser comment-author-lemire bypostauthor odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-06T10:43:24+00:00">December 6, 2010 at 10:43 am</time></a> </div>
<div class="comment-content">
<p>@Rommel</p>
<p><em>Normalization is an attempt to address these problems â€œby designâ€ such that the system is not reliant on correct coding at all points in time. </em></p>
<p>Right, but there is a corresponding cost. This cost in inflexibility. The enterprise databases I have seen are such that it would nearly unthinkable to change the schema. You&rsquo;d be better off starting from scratch. And it would cost millions and a couple of years. That&rsquo;s fine if your business is slow-moving.</p>
<p>Here&rsquo;s a real example. I work for a school (Ph.D.-granting university) where someone assumed that students came in three times a year. Now, this assumption is seriously challenged. A lot of classes can now start and end at arbitrary times during the year. That&rsquo;s true when you offer online classes to professionals. This requires a schema change. I&rsquo;ve spent a lot of time with the people who could make this change possible&#8230; and honestly, it is not feasible. So, they are going to have to hack it. They create new tables that map out to the old tables, and they have scripts, and it is all very ugly and costly.And, frankly, it is probably going to be buggy as hell for the all times. It would be much better if we could alter the old schemas. But doing so is just too complicated: we would need to rewrite all of the software.</p>
<p>Where does the problem come from? It comes from the fact that the DBAs hard-coded their assumptions in the schemas, and then the developers had to embed these assumptions in their software. The assumptions have been mostly correct for 20 years and then they brake. But when they do brake, we have no upgrade path.</p>
<p>The sad thing is that it is not that much data. Much of the databases could fit on an USB key. And it is not all that complicated either. Student A takes classes B. It is not the end of world. Yet, it ended up using up a couple of hundreds of neatly normalized tables. The job is well done. But&#8230;</p>
<p>My conjecture is that this unnecessary pain. We could do build database engines in 2010 that would make such updates much less painful. And maybe DBAs should learn the value of &ldquo;hiding&rdquo; the assumptions they are making. Are you really sure you know the domain now and for all times?</p>
<p><em>Now joins are not exactly required only by normalization either.</em></p>
<p>No. See also the comments of Bannister who points out that joins are not even necessarily between tables within the same database.</p>
</div>
</li>
<li id="comment-53980" class="comment byuser comment-author-lemire bypostauthor even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-06T11:07:53+00:00">December 6, 2010 at 11:07 am</time></a> </div>
<div class="comment-content">
<p>@Mike</p>
<p>See my post:</p>
<p>You probably misunderstand XML<br/>
<a href="https://lemire.me/blog/archives/2010/11/17/you-probably-misunderstand-xml/" rel="ugc">http://lemire.me/blog/archives/2010/11/17/you-probably-misunderstand-xml/</a></p>
</div>
</li>
<li id="comment-53977" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b5275a38f8cbe9e3303864be17e38064?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b5275a38f8cbe9e3303864be17e38064?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Rommel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-06T09:52:19+00:00">December 6, 2010 at 9:52 am</time></a> </div>
<div class="comment-content">
<p>@Daniel<br/>
I have encountered a lot of databases in my career that have been subject to update anomalies and I have seen or been part of more than one &ldquo;data cleanup&rdquo; project to address these problems after the fact.</p>
<p>You can argue that the problem there was that the original programmers were lousy, but its almost always because the database designer was the one who was lousy.</p>
<p>Normalization is an attempt to address these problems &ldquo;by design&rdquo; such that the system is not reliant on correct coding at all points in time. It&rsquo;s better to get it right the first time and its solved from that point onwards than to rely that the business rules are enforced all throughout different systems or by different programmers over time.</p>
<p>Now joins are not exactly required only by normalization either. Anytime you only store a reference to something rather than the entire thing (because the entire thing is maintained by someone else), joins will be involved (storing just the URL and not the entire web page for example). If you vertically partition a table (to simplify the schema or to improve performance), you will probably doing some joins to bring the tables back together. These have nothing to do with normalization.</p>
</div>
</li>
<li id="comment-53979" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8111b34a07e6b3950a688e96d5855941?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8111b34a07e6b3950a688e96d5855941?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mike S</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-06T10:57:37+00:00">December 6, 2010 at 10:57 am</time></a> </div>
<div class="comment-content">
<p>One of the nice things about databases is that they impose structure on your data. (Assuming that it&rsquo;s more complicated than can fit into a single row.) Many years ago, when I worked @ one of the major energy trading companies (which is no longer with us in that form), we had a trading system that stored data in (XML like) strings. That aspect of the system was widely regarded as a major failure. Nothing else could read their data, and they ended up supporting 3(!) databases for communicating with external systems. It made the Daily WTF several years ago.</p>
</div>
</li>
<li id="comment-53981" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-06T12:30:31+00:00">December 6, 2010 at 12:30 pm</time></a> </div>
<div class="comment-content">
<p>Heh. Along the lines of the last, I tend to like the approach of serializing a bunch of attributes &#8211; those that I do not expect to participate as selection criteria in queries &#8211; into a single string for storage into the database. Allows the set of attributes to vary without needing changes to the schema, and keeps the schema simple. You could use XML for the bag-of-attributes, but I am more likely to use JSON.</p>
<p>I am sure Coad would disapprove.</p>
<p>(You could possibly use stored procedures to allow serialized attributes to participate in queries, but I&rsquo;d be wary of that approach.) </p>
<p>If you have ever had to write software that maintained both upwards and downwards compatibility, then I hope the motivation for the above is familiar.</p>
</div>
</li>
<li id="comment-53982" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/272b69a6f7932242c7f6987d73ca7fd8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/272b69a6f7932242c7f6987d73ca7fd8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://blog.sydoracle.com" class="url" rel="ugc external nofollow">Gary</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-06T18:34:25+00:00">December 6, 2010 at 6:34 pm</time></a> </div>
<div class="comment-content">
<p>Been there, tried it and seen it fail in MUMPS, Lotus Notes and COBOL flat files.</p>
<p>The difficulty in schema-less (or any less rigidly structured database) comes five/ten years down the track when your application still has to deal with documents stored in 2010, 2011, 2012 etc, with half a dozen different internal structures to those documents.</p>
<p>If you can version your documents, and (from a business point of view) purge old versions to reduce long term support, then the model can work. Its great for ephemeral stuff where the life of a document is hours, days or weeks. </p>
<p>The problem isn&rsquo;t in modifying schemas or even modifying applications, it&rsquo;s building a new business model that can still cope with the residue of long history of other business models.</p>
<p>There&rsquo;s ultimately no difference in having a data structure fixed at a schema level and a data structure fixed with individual documents</p>
</div>
</li>
<li id="comment-53984" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eec0e7e747eaf2d5d5b7082633ac8f29?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eec0e7e747eaf2d5d5b7082633ac8f29?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">JKF</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-07T10:39:10+00:00">December 7, 2010 at 10:39 am</time></a> </div>
<div class="comment-content">
<p>Objecting to complex schemas makes as much sense as objecting to complex problems. A schema is as complex as the problem that it is addressing.</p>
<p>You can&rsquo;t buy simplicity by ignoring complexity, and when it comes to data, you cannot recover complex structure from a simplified projection. If that was possible, then your projection wouldn&rsquo;t actually be simpler! On the other hand, when your rules change in a complex schema there are correctness preserving transforms on that data to get what you need.</p>
<p>In my experience a complex schema is far more flexible and safely transformed than complex code created to deal with data that has been poorly modeled.</p>
<p>My job used to be mostly performing enterprise data conversions and upgrades, moving data from one system to another. The hard work was always in making sense of poorly normalized data, but converting the entire database structure to new rules was easier than rewriting that horrible code in those older systems to get new functionality. The advice to move to less normalization as simplification is completely opposite to my experience with large systems. I&rsquo;ve never regretted a constraint in a database, but believe me I&rsquo;ve regretted the lack of one!</p>
</div>
</li>
<li id="comment-53985" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/81df87e0d3e269d6fa6a17c6914fd656?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/81df87e0d3e269d6fa6a17c6914fd656?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://mikeschinkel.com" class="url" rel="ugc external nofollow">Mike Schinkel</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-07T14:40:38+00:00">December 7, 2010 at 2:40 pm</time></a> </div>
<div class="comment-content">
<p>@Daniel:<br/>
&ldquo;No. What I&rsquo;m saying is that should the developer choose to do so at a later date, he shouldn&rsquo;t need to change the database schema.&rdquo;</p>
<p>They I completely didn&rsquo;t follow your point. And still don&rsquo;t.</p>
</div>
</li>
<li id="comment-53986" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0cbc613fbbbcb19cf5e00d6deeb6ca5e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0cbc613fbbbcb19cf5e00d6deeb6ca5e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.casualmiracles.com" class="url" rel="ugc external nofollow">Lance Walton</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-07T15:49:16+00:00">December 7, 2010 at 3:49 pm</time></a> </div>
<div class="comment-content">
<p>@Mike S</p>
<p>I&rsquo;m intrigued by your comment that &lsquo;databases impose structure&rsquo;, as I think of the relational model as being all about removing structure (&lsquo;logic without meaning&rsquo; and all that stuff).</p>
<p>I&rsquo;m not sure whether I&rsquo;m not interpreting &lsquo;structure&rsquo; as you intended though.</p>
<p>Regards,</p>
<p>Lance</p>
</div>
</li>
<li id="comment-53993" class="comment byuser comment-author-lemire bypostauthor even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-08T14:00:01+00:00">December 8, 2010 at 2:00 pm</time></a> </div>
<div class="comment-content">
<p>@Bannister</p>
<p><em>It might make sense to enforce discipline through a well defined database schema, with carefully thought-out constraints. If there are many (possibly less capable folk) writing applications against the database, this can be an excellent approach &#8230; but only works if you have the right guy responsible for the database. Not all DBAs are so capable. In my past exercises, the database is accessed indirectly via a service, and very few (carefully controlled) applications access the database. For my purpose, there is much less value in constraints or more complicated schemas. Discipline is maintained within the boundary of the service API.</em></p>
<p>This appears to be a very sensible analysis.</p>
</div>
</li>
<li id="comment-53991" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2b6b3967e1957143b215825c6349d53b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2b6b3967e1957143b215825c6349d53b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mike S</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-08T12:21:54+00:00">December 8, 2010 at 12:21 pm</time></a> </div>
<div class="comment-content">
<p>@Lance<br/>
Done correctly, a database schema forces your data to be stored a certain way. The client column will always contain client information, detail rows will always have a good reference to a master record, and so on. Schemas might change, but it should almost always be additions, which don&rsquo;t invalidate existing data. (This was really important in our case, since we had contracts which ran for 10+ years.)<br/>
If you store the data as binary blobs/strings/XML/what have you, then you&rsquo;re relying on the client(s) to always get it right. Unfortunately, with code drift, it&rsquo;s possible to get into a situation where your system can&rsquo;t read old data, which is what happened in this case.<br/>
I wasn&rsquo;t directly involved in the project (I worked on several systems which used it as a source), and several managers involved in the project told me that it was their biggest mistake.</p>
</div>
</li>
<li id="comment-53992" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-08T13:48:06+00:00">December 8, 2010 at 1:48 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;Schemas might change, but it should almost always be additions, which don&rsquo;t invalidate existing data.&rdquo;</p>
<p>This is the key point to maintaining upwards and downwards compatibility, but use the notion of schema in the greater sense, not just limited to what the SQL database knows of as a schema. If you maintain discipline, things work well. If you lose discipline, you end up with a rats nest. </p>
<p>In the end, the key is the folk working on the system, and having the right folk in the right roles. </p>
<p>It might make sense to enforce discipline through a well defined database schema, with carefully thought-out constraints. If there are many (possibly less capable folk) writing applications against the database, this can be an excellent approach &#8230; but only works if you have the right guy responsible for the database. Not all DBAs are so capable.</p>
<p>In my past exercises, the database is accessed indirectly via a service, and very few (carefully controlled) applications access the database. For my purpose, there is much less value in constraints or more complicated schemas. Discipline is maintained within the boundary of the service API.</p>
<p>As always, the most appropriate solution depends on your application.</p>
</div>
</li>
<li id="comment-53995" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0cbc613fbbbcb19cf5e00d6deeb6ca5e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0cbc613fbbbcb19cf5e00d6deeb6ca5e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.casualmiracles.com" class="url" rel="ugc external nofollow">Lance Walton</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-08T17:08:17+00:00">December 8, 2010 at 5:08 pm</time></a> </div>
<div class="comment-content">
<p>@Mike S</p>
<p>Ah, I see what you mean. I agree with the notions as you present them. We are considering different levels of structure.</p>
<p>I&rsquo;m not disagreeing with you now (and I have had some of the experiences you describe too &#8211; not pleasant). I&rsquo;m just going to wax rhapsodic for a while&#8230;</p>
<p>As I see it, the relational model flattens the high level structure out, which looks like a removal of structure to me. But as you kind of note, you achieve this by structuring your data into tuples which collectively make relations. So at that level, it&rsquo;s a highly structured form.</p>
<p>On the other hand, an XML document is a highly structured form too. The fact that you can put it into a string isn&rsquo;t really relevant to how structured the data is.</p>
<p>Yes, you can put anything into a string. If we serialized an entire relational schema into a string, would that make it unstructured data? Seems like a confusion of container with content to me&#8230;</p>
</div>
</li>
<li id="comment-53998" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ed6ed998566a3e8eb6bf1a0c79f9b017?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ed6ed998566a3e8eb6bf1a0c79f9b017?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://orastory.wordpress.com/" class="url" rel="ugc external nofollow">Dominic Brooks</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-09T04:42:44+00:00">December 9, 2010 at 4:42 am</time></a> </div>
<div class="comment-content">
<p>Your example of a research paper design is just an example of bad analysis and design, nothing to do with the pros and coms of relational databases or joins. </p>
<p>&ldquo;Did the bunch of guys in IT knew about this?&rdquo;<br/>
They should have. </p>
<p>Know your business.</p>
<p>If you don&rsquo;t, chances are that you&rsquo;ll do something bad whether it&rsquo;s a relational database, nosql, wherever, whatever.</p>
</div>
</li>
<li id="comment-54005" class="comment byuser comment-author-lemire bypostauthor odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-09T09:40:18+00:00">December 9, 2010 at 9:40 am</time></a> </div>
<div class="comment-content">
<p>@Mike</p>
<p>I agree with what you are saying, but I must nitpick. </p>
<p><em>The difference between storing data in a relational database and storing it as an XML document is that the DB makes guarantees about the structure of the data, and XML doesn&rsquo;t.</em></p>
<p>Relax NG, XML Schema and DTDs can be used to validate XML documents. In fact, an XML schema can be far richer than any relational schema. Lack of good schema validation is not a weakness of XML.</p>
<p>And, honestly, if you must store documents (such as the content of blog posts) in a database, can you do better than XML?</p>
<p>As an example, Atom stores are beautiful. They will not break (because the Atom format will remain backward compatible).</p>
<p>(Yes, that&rsquo;s not what you were talking about. That&rsquo;s why I say I&rsquo;m nitpicking.)</p>
</div>
</li>
<li id="comment-54001" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2b6b3967e1957143b215825c6349d53b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2b6b3967e1957143b215825c6349d53b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mike S</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-09T08:38:07+00:00">December 9, 2010 at 8:38 am</time></a> </div>
<div class="comment-content">
<p>@Lance<br/>
The difference between storing data in a relational database and storing it as an XML document is that the DB makes guarantees about the structure of the data, and XML doesn&rsquo;t.<br/>
While using a (single) web service can do a lot to validate that data gets saved correctly, you could still have an issue where old data was serialized in a format that new code can&rsquo;t understand. (That&rsquo;s what happened in the case I&rsquo;m thinking of. The middle tier couldn&rsquo;t read data it had written several years earlier, when it was just going into production.)<br/>
I&rsquo;m not saying the SQL databases are a silver bullet. One of my coworkers did a database migration where the meaning of some columns in the original DB had changed over time. Getting that cleaned up was a chore.</p>
</div>
</li>
<li id="comment-54015" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ff8e47c83d62f786dd2d16c5cfda8adf?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ff8e47c83d62f786dd2d16c5cfda8adf?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://academic.research.microsoft.com" class="url" rel="ugc external nofollow">xin</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-10T08:28:27+00:00">December 10, 2010 at 8:28 am</time></a> </div>
<div class="comment-content">
<p>Otfried Cheong and Otfried Schwarzkopf shares one ID in Microsoft Academic Search web site: <a href="http://academic.research.microsoft.com/Author/154726.aspx" rel="nofollow ugc">http://academic.research.microsoft.com/Author/154726.aspx</a></p>
</div>
</li>
<li id="comment-349409" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a7cbf9c6d0243496ea8509de30e1170d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a7cbf9c6d0243496ea8509de30e1170d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.techirons.com/" class="url" rel="ugc external nofollow">Tech Irons</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-15T17:27:44+00:00">September 15, 2018 at 5:27 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m not saying the SQL databases are a silver bullet. One of my coworkers did a database migration where the meaning of some columns in the original DB had changed over time. Getting that cleaned up was a chore.</p>
</div>
</li>
<li id="comment-377399" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/daaa5929d55cae46276ddc495d818611?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/daaa5929d55cae46276ddc495d818611?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://ustechportal.com/" class="url" rel="ugc external nofollow">Gurmanroop Kaur</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-31T09:19:31+00:00">December 31, 2018 at 9:19 am</time></a> </div>
<div class="comment-content">
<p>Hey, I agree with &ldquo;Tech Irons&rdquo; In SQL DataBase, some meaning columns had changed over time. This happened to us.</p>
</div>
</li>
<li id="comment-441655" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/29ddf996116011cebf59de730003d162?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/29ddf996116011cebf59de730003d162?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://bestdataprovider.com/client-database-for-business/" class="url" rel="ugc external nofollow">Atul pandey</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-11T06:04:59+00:00">November 11, 2019 at 6:04 am</time></a> </div>
<div class="comment-content">
<p>Are we talking about normalization, or individual columns and storing repeated column values once?</p>
</div>
</li>
</ol>
