---
date: "2009-11-13 12:00:00"
title: "More database compression means more speed? Right?"
index: false
---

[9 thoughts on &ldquo;More database compression means more speed? Right?&rdquo;](/lemire/blog/2009/11-13-more-database-compression-means-more-speed-right)

<ol class="comment-list">
<li id="comment-51905" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f9066aabfbe4756a4b22f401c7fcf5e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f9066aabfbe4756a4b22f401c7fcf5e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://glinden.blogspot.com/" class="url" rel="ugc external nofollow">Greg</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-11-13T10:52:41+00:00">November 13, 2009 at 10:52 am</time></a> </div>
<div class="comment-content">
<p>Google&rsquo;s compression is probably worth a mention here too. They tend to use very fast, lightweight compression as well (e.g. Zippy).</p>
<p>Some of it is described in their papers (a small section in the Bigtable paper) and talks (small mentions of it in Jeff Dean&rsquo;s talks, such as his Bigtable talk or his recent LADIS 2009 talk).</p>
</div>
</li>
<li id="comment-51906" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-11-13T10:58:27+00:00">November 13, 2009 at 10:58 am</time></a> </div>
<div class="comment-content">
<p>@Greg</p>
<p>Thanks Greg. This is the kind of comment that makes blogging so profitable.</p>
<p>Shame on me: I did not even think of BigTable, and I don&rsquo;t know anything about their compression techniques&#8230; more reading for me&#8230; I hope to blog about it in the future.</p>
</div>
</li>
<li id="comment-51908" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5b457c292ceb9b4b96c51c2ddf78e3d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5b457c292ceb9b4b96c51c2ddf78e3d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.neilconway.org/" class="url" rel="ugc external nofollow">Neil Conway</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-11-13T13:02:22+00:00">November 13, 2009 at 1:02 pm</time></a> </div>
<div class="comment-content">
<p><i>As we have more CPU cores, we also have more bandwidth to bring data to the the cores.</i></p>
<p>There is no reason for that to be true: advances in processor technology often follow a different curve than advances in memory architectures. It may well be the case that many-core architectures in the future are increasingly bandwidth-constrained: once data reaches a core, computation cycles are cheap, but data movement into / out of cores might be relatively expensive.</p>
</div>
</li>
<li id="comment-51909" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-11-13T13:31:19+00:00">November 13, 2009 at 1:31 pm</time></a> </div>
<div class="comment-content">
<p>@Conway</p>
<p>There reason for this to be true is stated in my post: <em>Otherwise, CPU cores would be constantly data-starved in most multimedia and business applications.</em> Intel will not mass-produce CPUs unless the technology to keep them busy with mainstream applications is out there.</p>
<p>Disclaimer: you can always find special cases, and nobody can predict the future.</p>
</div>
</li>
<li id="comment-51910" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5b457c292ceb9b4b96c51c2ddf78e3d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5b457c292ceb9b4b96c51c2ddf78e3d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.neilconway.org/" class="url" rel="ugc external nofollow">Neil Conway</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-11-13T17:41:57+00:00">November 13, 2009 at 5:41 pm</time></a> </div>
<div class="comment-content">
<p>Well, it may well be the case that &ldquo;CPU cores will be constantly data-starved&rdquo; in the future, certainly for many run-of-the-mill business applications.</p>
<p>In the recent past, most superscalar chips had only a very limited ability to extract instruction-level parallelism from most programs &#8212; that didn&rsquo;t stop Intel from mass-producing those chips, even though they were utilized relatively inefficiently. Those chips (e.g. Pentium IV) were still useful, despite the inefficiency. Similarly, manycore chips may still be useful, even if they are relatively bandwidth-starved &#8212; which would make communication-intelligent designs increasingly important.</p>
</div>
</li>
<li id="comment-51911" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-11-13T18:24:35+00:00">November 13, 2009 at 6:24 pm</time></a> </div>
<div class="comment-content">
<p>@Conway</p>
<p>Sure. It could happen that in the future the cores will be constantly data-starved. Nobody can predict the future. But it is not the case right now. Lightweight compression outperforms and has outperformed for years if not decades heavy compression within databases.</p>
<p>(Some papers have claimed that databases are I/O bound. They have just not convinced me, nor the database industry.)</p>
</div>
</li>
<li id="comment-51915" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/77ab94bee30d4bbc521c2fbb9bd574f1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/77ab94bee30d4bbc521c2fbb9bd574f1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.xtremecompression.com/" class="url" rel="ugc external nofollow">Glenn Davis</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-11-18T01:25:22+00:00">November 18, 2009 at 1:25 am</time></a> </div>
<div class="comment-content">
<p>Ready for a radical idea? Too bad, here it is anyway.</p>
<p>Having to categorize one&rsquo;s compression method as being lightweight or heavyweight suggests to me that the method just isn&rsquo;t very good or appropriate for the data. Good methods do a good job of data modeling, and with really good data modeling the otherwise-competing performance goals of speed and size can go hand in hand. To me, in the case of structured databases, good data modeling means multidimensional data modeling; unfortunately, nearly all the methods now being used are inherently one-dimensional and, predictably, wind up requiring compromise.</p>
<p>I say that after having developed compression software that achieves almost 8-to-1 compression of the TPC-H lineitem table, a common benchmark in the DBMS world. That is far beyond published results from Oracle and IBM, and it demonstrates how much better, and more appropriate, multidimensional data modeling is when one is dealing with multidimensional data.</p>
</div>
</li>
<li id="comment-51916" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-11-18T14:21:09+00:00">November 18, 2009 at 2:21 pm</time></a> </div>
<div class="comment-content">
<p>@Glenn</p>
<p>The type of compression ratio you are referring to is already possible using publicly available algorithms:</p>
<p>V. Raman and G. Swart. Entropy compression of relations and querying of compressed relations. In VLDB, 2006.</p>
</div>
</li>
<li id="comment-51917" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.xtremecompression.com/" class="url" rel="ugc external nofollow">Glenn Davis</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-11-18T21:10:42+00:00">November 18, 2009 at 9:10 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s a super paper and a good start in the right direction! Those results, although measured on entropy-reduced data, illustrate the power of multidimensional approaches and the goal alignment (speed with size) one can get from good models.</p>
<p>Their paper contains a footnote that I found not only intriguing but suggestive of a direction to go to reach the next level of performance:</p>
<p>&ldquo;By modeling the tuple sources as i.i.d., we lose the ability to exploit inter-tuple correlations. To our knowledge, no one has studied such correlations in databases â€“ all the work on correlations has been among fields within a tuple. If inter-tuple correlations are significant, the information theory literature on compression of non zero-order sources might be applicable.&rdquo;</p>
<p>Funny they should say that! The answer is both yes and no. Yes, inter-tuple correlations can and should be exploited to compress structured data; I led a team that did that with great success some 20 years ago. And no, we found the information theory literature to be irrelevant. Information theory concerns encoding modeled data, not the design of the data models themselves. That is where the challenges and benefits lie.</p>
</div>
</li>
</ol>
