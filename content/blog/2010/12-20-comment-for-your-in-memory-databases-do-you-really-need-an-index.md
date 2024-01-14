---
date: "2010-12-20 12:00:00"
title: "For your in-memory databases, do you really need an index?"
index: false
---

[20 thoughts on &ldquo;For your in-memory databases, do you really need an index?&rdquo;](/lemire/blog/2010/12-20-for-your-in-memory-databases-do-you-really-need-an-index)

<ol class="comment-list">
<li id="comment-54033" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-20T12:06:17+00:00">December 20, 2010 at 12:06 pm</time></a> </div>
<div class="comment-content">
<p>@Maria</p>
<p>Quite right, Maria. In this post, I took index to mean &ldquo;supplementary data structure on top of an existing row store&rdquo;.</p>
</div>
</li>
<li id="comment-54034" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f9066aabfbe4756a4b22f401c7fcf5e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f9066aabfbe4756a4b22f401c7fcf5e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://glinden.blogspot.com/" class="url" rel="ugc external nofollow">Greg Linden</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-20T12:53:02+00:00">December 20, 2010 at 12:53 pm</time></a> </div>
<div class="comment-content">
<p>Hi, Daniel. I think your general point is a good one, that a database optimized to fit in memory often will beat a database that is not, and that people should pay close attention to getting most or all of their active data in memory.</p>
<p>I&rsquo;m not sure the example of scanning the entire data set is all that compelling, though, since that usually isn&rsquo;t necessary to get the data in memory. But I understand you are making an extreme point with that.</p>
<p>By the way, this reminds me of a conversation I had with Udi Manber back in 2002 when he was still at Amazon. I was arguing that his old Glimpse work (which was disk-based and did a coarse-grained index to jump into blocks of compressed data that would then be sequentially scanned) potentially could be applied to newer in-memory systems. At the time, Udi disagreed with me, I remember, but you do see something vaguely similar to that implemented in Google&rsquo;s index nowadays (see the &ldquo;block-based&rdquo; index format now used for Google&rsquo;s massive in-memory web search indexes as described in Jeff Dean&rsquo;s WSDM 2009 talk). Fun stuff there.</p>
</div>
</li>
<li id="comment-54036" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-20T14:11:04+00:00">December 20, 2010 at 2:11 pm</time></a> </div>
<div class="comment-content">
<p>@Greg</p>
<p>I predicted that we will have servers with 1TB of RAM by 2020. If you believe this prediction or a weaker one, then you must concede that a lot of businesses will be able to keep most of their data in RAM. If you throw in fast persistent RAM on top of this&#8230; hard drves may become the new tape backups before long.</p>
<p>How many cores will servers have in 2020? I am guessing 64 cores (but I didn&rsquo;t do any reasearch).</p>
<p>If you combine these two effects, I think you start to see that software will spend a lot more time scanning data than it does right now. </p>
<p>This will probably be motivated by richer applications which access data in less predictable ways.</p>
<p>As for Mander&rsquo;s work&#8230; I think that it often makes little sense to recover single rows from disk, because there is hardly any difference between reading 1KB or 1MB of data due to disk buffering. RAM systems have a similar issue: it expensive to load stuff in L2 cache, but cheap to process once it is there. So, you don&rsquo;t need to know exactly where your data is, as long as you can find the small block where it is. So, yes, it looks like main memory is the new disk&#8230;</p>
<p>@Paul</p>
<p>Your numbers are interesting. Consider also that SQLite was probably written in C. So the gap between my Java implementation (cooked up in less than an hour) and SQLite is quite significant.</p>
<p>As for memory usage, I am pretty sure that Java will use about 700 MB of RAM to store the table, but it is because of the garbage collector.</p>
<p>The specific query I implemented is easy to index. If that is all you need then a hash table-like index is a must.</p>
<p>Obviously, I was thinking about someone who has to generate more generic queries. If you have to index your table for several possible types of queries, I think that the memory usage might grow quite large. For example, did you index every column? What the memory usage like then?</p>
</div>
<ol class="children">
<li id="comment-215347" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/efea7babf158a96789672b773feb5a5a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/efea7babf158a96789672b773feb5a5a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.marcinkossakowski.com" class="url" rel="ugc external nofollow">MarcinK</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-12-08T05:51:24+00:00">December 8, 2015 at 5:51 am</time></a> </div>
<div class="comment-content">
<p>One thing to mention here is that full scans can be found at the core of many high performance columnar databases. Where with row based engines you need to know for what queries you have to optimize, columnar stores often times do not require preparing indexes and in many cases are also self optimizing by gradually reorganizing it&rsquo;s internal data representations for even better performance (e.g. MonetDB)</p>
</div>
</li>
</ol>
</li>
<li id="comment-54038" class="comment byuser comment-author-lemire bypostauthor even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-20T15:59:35+00:00">December 20, 2010 at 3:59 pm</time></a> </div>
<div class="comment-content">
<p>@Paul</p>
<p>Thanks for the great numbers. </p>
<p>Unsurprisingly, indexing all columns takes roughly as much memory as the original table. If you think about it, it is unavoidable because you could reconstruct the whole table from the indexes (on every column) alone. Thus, the indexes have just as much information as the table, but it is organized differently. (This opens up the possibility of throwing away the row store, and just keep the indexes&#8230; but of course, reconstructing the rows then becomes painful.)</p>
<p><em>Perhaps the most meaningful tradeoff here is that if your data just barely fits in memory, you&rsquo;re better off scanning it than indexing it on disk.</em></p>
<p>I&rsquo;m sure we can find many counterexamples, but this statement matches my intuition.</p>
</div>
</li>
<li id="comment-54032" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/11bd95c4a26a75be4500e3d9b98d5537?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/11bd95c4a26a75be4500e3d9b98d5537?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maria Grineva</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-20T11:15:44+00:00">December 20, 2010 at 11:15 am</time></a> </div>
<div class="comment-content">
<p>It is always good to choose the optimum data structures even if your data fits in memory. Index, as I understand it in general, is an optimized data structure.</p>
<p>For example, when we processed wikipedia data to compute semantic relationships between pairs of concepts, we stored the whole Wikipedia data in memory (6 Gb). We processed text using this information about concept relationships. And it was very slow and needed a lot of optimizations.</p>
<p>Yes, you are right that indexes always optimize for specific queries, for your application.</p>
</div>
</li>
<li id="comment-54039" class="comment byuser comment-author-lemire bypostauthor even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-20T17:32:16+00:00">December 20, 2010 at 5:32 pm</time></a> </div>
<div class="comment-content">
<p>@Paul</p>
<p><em>(&#8230;) incremental reindexing should be much faster</em></p>
<p>Yes, but it is also much easier to support concurrency without the indexes.</p>
</div>
</li>
<li id="comment-54035" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c47d7a71160b9ec79d34316139ff3cdb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c47d7a71160b9ec79d34316139ff3cdb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://futurepaul.blogspot.com" class="url" rel="ugc external nofollow">Paul</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-20T13:18:20+00:00">December 20, 2010 at 1:18 pm</time></a> </div>
<div class="comment-content">
<p>Put 10M 10 column INT rows into a SQLite in memory db (random values from 1 to 10M. The executable grows to ~750MB, suggesting a less efficient storage mechanism than your test.</p>
<p>Processor is a Intel Core i7 2.93 GHZ</p>
<p>Unindexed select was 2.6 seconds, about 50x worse than your results. I find this very interesting, I&rsquo;m guessing between ACID and assumptions about usage, they optimized other queries at the expense of this?</p>
<p>Indexing took 36s (supporting your implication indexes may not be worth it if you change data far more than you read it, although incremental reindexing should be much faster)</p>
<p>Indexed select took .5ms, about 1/100th your scan (and 1/5,000 SQLite&rsquo;s scan).</p>
<p>My takeaway from this quick experiment? I can imagine some edge cases where an index isn&rsquo;t needed, but the 100-5000x speed up can offset a lot of penalties from added disk usage/slower updates.</p>
</div>
</li>
<li id="comment-54037" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c47d7a71160b9ec79d34316139ff3cdb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c47d7a71160b9ec79d34316139ff3cdb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://futurepaul.blogspot.com" class="url" rel="ugc external nofollow">Paul</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-20T15:48:11+00:00">December 20, 2010 at 3:48 pm</time></a> </div>
<div class="comment-content">
<p>Just did the test of per index growth:</p>
<p>Each single column index adds roughly 160MB.</p>
<p>Also created an index across all the columns, that one was ~680MB. So at the low end you&rsquo;re looking at just over a GB and a half to index every column, more if you want multi-column indexes (although in my experience, just having one part of the query indexed often goes far enough in reducing the domain of possible matches to make the whole query pretty efficient).</p>
<p>I also realized that by setting my random numbers as (1,10M) I was just modeling a sparse range, e.g. ids, time stamps, etc. So I reran with random values from 1 to 100 to model a database where each column has a small range of values.</p>
<p>Base size goes from: ~ 750MB=&gt;500MB,<br/>
index goes from: 160=&gt;140<br/>
index across 10 columns: 680=&gt;400<br/>
The size reduction is all/mostly SQLite storing ints in the smallest (power of 2) byte count needed to represent them.</p>
<p>Full scan (searching for 3 values to avoid excessive results) still takes 2.6 s, fully indexed is still .5ms, just using a single index gives 170 ms.</p>
<p>So it looks like any lessons anybody wants to take away are more or less independent of data sparsity.</p>
<p>Perhaps the most meaningful tradeoff here is that if your data just barely fits in memory, you&rsquo;re better off scanning it than indexing it on disk. Similarly, because multi-column indexes are the largest, indexing the most common columns is likely to be superior than completely indexing each query in a non-trivial number of cases.</p>
<p>Interesting stuff&#8230;</p>
</div>
</li>
<li id="comment-54041" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-22T13:04:29+00:00">December 22, 2010 at 1:04 pm</time></a> </div>
<div class="comment-content">
<p>What if you really need a join? That is denormalized structure is not an option?<br/>
For instance, to merge 10,000 records from one table with another table that is scanned sequentially?</p>
</div>
</li>
<li id="comment-54042" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-22T20:00:52+00:00">December 22, 2010 at 8:00 pm</time></a> </div>
<div class="comment-content">
<p>@Itman</p>
<p>I&rsquo;m not sure I understand the question: I&rsquo;m just scanning 32-bit integers which can be foreign keys for all I care (it is irrelevant to the test in question).</p>
<p>Fast joins are interesting on their own, of course. One of the best way to compute joins would be to first sort both tables and then scan them both very fast.</p>
</div>
</li>
<li id="comment-54043" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-22T23:55:04+00:00">December 22, 2010 at 11:55 pm</time></a> </div>
<div class="comment-content">
<p><i>One of the best way to compute joins would be to first sort both tables and then scan them both very fast.</i></p>
<p>Sorting of 10,000,000 records may be rather long. In many cases, you don&rsquo;t have the luxury of performing the full sort before doing the join.</p>
<p>In addition, if you have a high-throughput system, 0.06 for an operation (which may be many per single-user request) is also way too long.</p>
</div>
</li>
<li id="comment-54044" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-23T16:16:00+00:00">December 23, 2010 at 4:16 pm</time></a> </div>
<div class="comment-content">
<p>@Itman</p>
<p><em>In many cases, you don&rsquo;t have the luxury of performing the full sort before doing the join.</em></p>
<p>According to Intel and Oracle researchers, sort join will soon overtake hash join: </p>
<p>&ldquo;Our analysis projects that current architectural<br/>
trends of wider SIMD, more cores, and smaller memory bandwidth per core imply better scalability potential for sort-merge join. Consequently, sort-merge join is likely to outperform hash join on upcoming chip multiprocessors.&rdquo;</p>
<p>In : Sort vs. Hash Revisited: Fast Join Implementation on Modern Multi-Core CPUs by Kim et al. (VLDB 2009)</p>
<p><em>In addition, if you have a high-throughput system, 0.06 for an operation (which may be many per single-user request) is also way too long.</em></p>
<p>Right. Sure.</p>
<p>You could make your criticism stronger. It is likely that SQLite is only using one core to answer the indexed version of my slice-count query. Meanwhile, I&rsquo;m keeping 4 core busy for 0.06 s with my version. </p>
<p>This being said, my point was that you can scan through 10 million rows in 0.06 s on a regular desktop machine (server-class machines can do better). And it is only going to get better over time (more cores, more RAM, and so on).</p>
<p>If you have predictable, high selectivity queries, then indexes are a no brainer. I&rsquo;ve spent a good chunk of my life working on indexes, so I&rsquo;m not against them. But as the &ldquo;Sort vs. Hash Revisited&rdquo; paper I cite shows, there is a trend that makes data scanning a lot more useful.</p>
</div>
</li>
<li id="comment-54046" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-23T16:35:43+00:00">December 23, 2010 at 4:35 pm</time></a> </div>
<div class="comment-content">
<p>@Itman</p>
<p><em>When sequential searching is slow, one can always divide the data into buckets, locate buckets using a fancy index and search buckets sequentially.</em></p>
<p>Yes. I&rsquo;ll write more about this in 2011. 😉 I promise!</p>
</div>
</li>
<li id="comment-54045" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-23T16:24:59+00:00">December 23, 2010 at 4:24 pm</time></a> </div>
<div class="comment-content">
<p>Daniel,<br/>
Thank you for the reference. Looks like an interesting one.</p>
<p>Yes, I agree that the modern trend is to rely more on sequential search algorihm, which have fewer banch misprediction and have better locality of reference.</p>
<p>When sequential searching is slow, one can always divide the data into buckets, locate buckets using a fancy index and search buckets sequentially.</p>
</div>
</li>
<li id="comment-55642" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/04eed6ddd2d43b6c0e2550f17ea9ed5f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/04eed6ddd2d43b6c0e2550f17ea9ed5f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">jackon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-09-14T10:22:39+00:00">September 14, 2012 at 10:22 am</time></a> </div>
<div class="comment-content">
<p>Looking two data sets A 10millions and 10K, there is a join between 2 and filter on 10K set. without sort and join will perform buble search and it has been proven slow in computer algorithm.</p>
</div>
</li>
<li id="comment-215330" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/efea7babf158a96789672b773feb5a5a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/efea7babf158a96789672b773feb5a5a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.marcinkossakowski.com" class="url" rel="ugc external nofollow">MarcinK</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-12-08T04:19:19+00:00">December 8, 2015 at 4:19 am</time></a> </div>
<div class="comment-content">
<p>Hey Daniel. Thanks for this.<br/>
Results on my MBP are similar to yours.<br/>
I noticed you split up scan among available cores in the system. Wouldn&rsquo;t that potentially degrade performance on HDD&rsquo;s?<br/>
I also ran into a problem when I set 1 col and 100mil records. It would get stuck at loading to RAM&#8230; possibly GC complaining?</p>
</div>
<ol class="children">
<li id="comment-215461" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-12-08T14:19:24+00:00">December 8, 2015 at 2:19 pm</time></a> </div>
<div class="comment-content">
<p>@MarcinK</p>
<p><em>Wouldn&rsquo;t that potentially degrade performance on HDD&rsquo;s?</em></p>
<p>The blog post is entitled &ldquo;For your in-memory databases, do you really need an index?&rdquo;</p>
<p>If your data is on a slow disk, you probably need an index.</p>
</div>
</li>
</ol>
</li>
<li id="comment-639297" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e0d320918dd488cbf992c08277635d3d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e0d320918dd488cbf992c08277635d3d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">lizhibo</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-11T03:40:18+00:00">July 11, 2022 at 3:40 am</time></a> </div>
<div class="comment-content">
<p>Hello, see your blog says: Using normalization, you can replace each value by a 32-bit integer for a total of 381MB. May I ask, is value a string? Is there a specific way to convert a string into an int number? Can I reverse from 1 int to 1 string?</p>
</div>
<ol class="children">
<li id="comment-639329" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-11T13:10:53+00:00">July 11, 2022 at 1:10 pm</time></a> </div>
<div class="comment-content">
<p><em> Is there a specific way to convert a string into an int number?</em></p>
<p>You may map all strings into (consecutive) integers using a map of some kind. The processing is often call &lsquo;normalisation&rsquo; but you also find it under the name &ldquo;<a href="https://en.wikipedia.org/wiki/String_interning" rel="nofollow ugc">string interning</a>&ldquo;.</p>
</div>
</li>
</ol>
</li>
</ol>
