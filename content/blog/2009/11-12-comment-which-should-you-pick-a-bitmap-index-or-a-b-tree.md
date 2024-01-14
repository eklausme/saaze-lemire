---
date: "2009-11-12 12:00:00"
title: "Which should you pick: a bitmap index or a B-tree?"
index: false
---

[7 thoughts on &ldquo;Which should you pick: a bitmap index or a B-tree?&rdquo;](/lemire/blog/2009/11-12-which-should-you-pick-a-bitmap-index-or-a-b-tree)

<ol class="comment-list">
<li id="comment-51898" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-11-13T07:42:11+00:00">November 13, 2009 at 7:42 am</time></a> </div>
<div class="comment-content">
<p>@Pagh I agree that your paper, which I read when it first came out on arxiv, is very interesting.</p>
<p>Of course, we often using fixed-length counters in actual databases since delta codes, such as the one you use, may require many CPU operations to read a single number. Trading space for fewer CPU operations is often worth it. So it is not entirely clear how your data structure would hold out on our current breed of CPUs.</p>
<p>(This is not to be taken as a criticism of your work, which I found to be excellent.)</p>
</div>
</li>
<li id="comment-51900" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-11-13T08:28:26+00:00">November 13, 2009 at 8:28 am</time></a> </div>
<div class="comment-content">
<p>@Pagh I&rsquo;ll answer your comment with my next blog post.</p>
</div>
</li>
<li id="comment-51896" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/15e1863aa7f8d91fddc20b9e799bcbcc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/15e1863aa7f8d91fddc20b9e799bcbcc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.itu.dk/people/pagh/" class="url" rel="ugc external nofollow">Rasmus Pagh</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-11-13T03:33:56+00:00">November 13, 2009 at 3:33 am</time></a> </div>
<div class="comment-content">
<p>This is an interesting question, both in practice and theory. I cannot resist pointing out a related paper by Srinivasa Rao and myself that appeared at PODS 2009:</p>
<p><a href="http://www.itu.dk/people/pagh/papers/second.pdf" rel="nofollow">Secondary Indexing in One Dimension: Beyond B-trees and Bitmap Indexes</a></p>
<p>It is an extension of previous work by Sinha and Winslett, and suggests a data structure that combines the best properties of bitmap indexes and B-trees, with particular focus on range queries. I would be very interested in seeing an engineering of these ideas, with experiments &#8211; currently we are missing the resources to do this kind of things ourselves&#8230;</p>
</div>
</li>
<li id="comment-51902" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-11-13T10:10:56+00:00">November 13, 2009 at 10:10 am</time></a> </div>
<div class="comment-content">
<p>@Callaghan</p>
<p>You are totally right. WAH is an update to BBC. Conceptually, it is the same idea. (But you could object that BBC is just an update on the classic run-length encoding techniques.) My own work is also merely an update, in this sense, except that I considered very carefully table sorting as a factor (<a href="http://arxiv.org/abs/0901.3751" rel="nofollow ugc">http://arxiv.org/abs/0901.3751</a> ).</p>
</div>
</li>
<li id="comment-51903" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-11-13T10:44:40+00:00">November 13, 2009 at 10:44 am</time></a> </div>
<div class="comment-content">
<p>@Pagh Oh! And if you are thinking about Zukowski et al. paper with Peter Boncz on Super-Scalar RAM-CPU Cache Compression, then no, their technique does not involve any form of run-length encoding. It is mostly dictionary coding. So it is probably not applicable to bitmaps.</p>
</div>
</li>
<li id="comment-51899" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/15e1863aa7f8d91fddc20b9e799bcbcc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/15e1863aa7f8d91fddc20b9e799bcbcc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.itu.dk/people/pagh/" class="url" rel="ugc external nofollow">Rasmus Pagh</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-11-13T08:00:09+00:00">November 13, 2009 at 8:00 am</time></a> </div>
<div class="comment-content">
<p>@Daniel I agree completely that the compression/decompression of bitmaps is likely to be the practical bottleneck of what we propose. We crucially rely on compression that is close to the best information-theoretical bounds. I know that Peter Boncz and co-authors have some extremely fast compression methods, but I never got around to seeing if they compress 0-1 sequences optimally. Do you know if people tried to use multi-cores to be able to do better compression?</p>
</div>
</li>
<li id="comment-51901" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d1fa154903ca7ed342c36888aab05236?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d1fa154903ca7ed342c36888aab05236?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://mysqlha.blogspot.com" class="url" rel="ugc external nofollow">Mark Callaghan</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-11-13T09:49:03+00:00">November 13, 2009 at 9:49 am</time></a> </div>
<div class="comment-content">
<p>The folklore even exists in Oracle docs, although the Data Warehousing guide gets it right &#8212; <a href="http://download.oracle.com/docs/cd/E11882_01/server.112/e10810/indexes.htm#DWHSG006" rel="nofollow ugc">http://download.oracle.com/docs/cd/E11882_01/server.112/e10810/indexes.htm#DWHSG006</a>. By &lsquo;right&rsquo; I mean that they state the important factor is the ratio of distinct keys to the number of rows.</p>
<p>I worked on the bitmap code at Oracle and did my best to fix the folklore internally. But change is hard.</p>
<p>Gennady Antoshenkov, the person who provided BBC, did a remarkable job. I read a few of the WAH papers and my impression is that they were more of an update of BBC for modern computer architecture than something new. But maybe I am biased given my appreciation for the work of Antoshenkov.</p>
</div>
</li>
</ol>
