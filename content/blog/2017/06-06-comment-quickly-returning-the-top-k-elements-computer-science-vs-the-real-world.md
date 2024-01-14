---
date: "2017-06-06 12:00:00"
title: "Quickly returning the top-k elements: computer science vs. the real world"
index: false
---

[14 thoughts on &ldquo;Quickly returning the top-k elements: computer science vs. the real world&rdquo;](/lemire/blog/2017/06-06-quickly-returning-the-top-k-elements-computer-science-vs-the-real-world)

<ol class="comment-list">
<li id="comment-281010" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5bd93327dd2a32e2a26fb699e742f1b2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5bd93327dd2a32e2a26fb699e742f1b2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://ceng.metu.edu.tr/~altingovde" class="url" rel="ugc external nofollow">Ismail Sengor Altingovde</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-06T01:41:27+00:00">June 6, 2017 at 1:41 am</time></a> </div>
<div class="comment-content">
<p>Hi, thanks for the nice post and a couple of comments:<br/>
&#8211; Depending on the application, sorting may fail badly. In web search, for instance, each server (in the data center) is responsible for scoring millions of documents and returning top-k, where k is very small (like 10 or 100). So, using a heap may yield a huge performance gain (+ there is no need for an array for millions of docs, a gain from the space and advantage for multi-core parallelism).</p>
<p>Databases is another story and I would agree on your observation (although there was once a huge interest on making such top-k queries efficient; and at one point (back in 2004) we have also proposed an extended SQL algebra for handling tuple scores natively in databases, together with processing algorithms that would also exploit such scores for faster processing). Nevertheless, I am not aware of industrial adoption of such ideas, but maybe in some research prototypes&#8230;</p>
</div>
</li>
<li id="comment-281015" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e214f5c143b40458c473bef6ee05823e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e214f5c143b40458c473bef6ee05823e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Martin Cohen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-06T04:10:28+00:00">June 6, 2017 at 4:10 am</time></a> </div>
<div class="comment-content">
<p>How about a simple-minded insertion sort into an array of size K. After a while most entries would be immediately rejected.</p>
</div>
<ol class="children">
<li id="comment-282048" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/28cf2552dfa2910fbfe4f4e8a2fc08f4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/28cf2552dfa2910fbfe4f4e8a2fc08f4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.haidrali.com" class="url" rel="ugc external nofollow">Haider Ali</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-22T10:21:50+00:00">June 22, 2017 at 10:21 am</time></a> </div>
<div class="comment-content">
<p>Insertion sort could be a simpler solution but it won&rsquo;t beat binary heap solution because of its average and worst case compexity is O(n^2).</p>
</div>
</li>
</ol>
</li>
<li id="comment-281016" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-06T04:24:20+00:00">June 6, 2017 at 4:24 am</time></a> </div>
<div class="comment-content">
<p>Vertica does <a href="https://my.vertica.com/docs/7.1.x/HTML/index.htm#Authoring/AnalyzingData/Optimizations/OptimizingLIMITQueriesWithROW_NUMBERPredicates.htm" rel="nofollow">top-K optimization</a>. A lot of queries wouldn&rsquo;t finish without it.</p>
</div>
</li>
<li id="comment-281017" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c561acfe4c438a4387f8c7d62876c4f7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c561acfe4c438a4387f8c7d62876c4f7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thibaut</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-06T05:06:23+00:00">June 6, 2017 at 5:06 am</time></a> </div>
<div class="comment-content">
<p>Note that from the computer science perspective it is possible to do better than the heap solution:</p>
<p>1. find the Kth smallest element from the list using the quick select algorithm. This takes time O(N)</p>
<p>2. Use the Kth smallest element as the pivot to partition the array and only keep the elements smaller than the pivot (similar to what is done in quicksort). This takes time O(N).</p>
<p>The resulting algorithm is linear and thus optimal. If the result needs to be sorted this simply requires an extra O(K log K) additional time, for an overall running time of O(N + K log K).</p>
<p>However, this algorithm seems to have worse locality of reference than the heap-based one, so I wouldn&rsquo;t expect it to perform better in pratice. It could be interesting to try though</p>
</div>
</li>
<li id="comment-281021" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/15e1863aa7f8d91fddc20b9e799bcbcc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/15e1863aa7f8d91fddc20b9e799bcbcc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.itu.dk/people/pagh/" class="url" rel="ugc external nofollow">Rasmus Pagh</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-06T05:58:28+00:00">June 6, 2017 at 5:58 am</time></a> </div>
<div class="comment-content">
<p>Did you try QuickSelect followed by a linear scan? Should outperform the heap at least if k is not too small.</p>
</div>
<ol class="children">
<li id="comment-281033" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/073f67f5295376245c787a0aa3b99842?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/073f67f5295376245c787a0aa3b99842?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michel Lemay</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-06T13:36:11+00:00">June 6, 2017 at 1:36 pm</time></a> </div>
<div class="comment-content">
<p>(guava use this)</p>
</div>
</li>
</ol>
</li>
<li id="comment-281032" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/073f67f5295376245c787a0aa3b99842?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/073f67f5295376245c787a0aa3b99842?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michel Lemay</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-06T13:35:35+00:00">June 6, 2017 at 1:35 pm</time></a> </div>
<div class="comment-content">
<p>For the sake of the comparison, one could use guava greatestOf/leastOf that runs in O(n + k log k). In my tests, it outperform any other of the shelf approaches by a large margin for any combination of K and N.</p>
<p> <a href="https://plus.google.com/+googleguava/posts/QMD74vZ5dxc" rel="nofollow ugc">https://plus.google.com/+googleguava/posts/QMD74vZ5dxc</a></p>
</div>
</li>
<li id="comment-281036" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1d70af08e4a97eb82aa2e4086317bd9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1d70af08e4a97eb82aa2e4086317bd9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tim Armstrong</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-06T14:31:43+00:00">June 6, 2017 at 2:31 pm</time></a> </div>
<div class="comment-content">
<p>The database engine I work on (Impala) uses the binary heap solution for top-k (ORDER BY/LIMIT) queries. It&rsquo;s a common pattern in practice (and in benchmarks). I suspect other engines do too. Maybe Postgres is an outlier.</p>
</div>
</li>
<li id="comment-281690" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-18T11:30:47+00:00">June 18, 2017 at 11:30 am</time></a> </div>
<div class="comment-content">
<p>As coincidence would have it, I just ran across the Postgres commit for top-N sorting.<a href="https://postgrespro.com/list/thread-id/1270227Apparently" rel="nofollow ugc">https://postgrespro.com/list/thread-id/1270227Apparently</a> it shows up in the plan as a regular sort, since it uses the same module and switches modes only when the tuple count is large: Â https://github.com/postgres/postgres/blob/2df537e43fdc432cccbe64de166ac97363cbca3c/src/backend/utils/sort/tuplesort.c#L1587</p>
</div>
</li>
<li id="comment-282046" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/28cf2552dfa2910fbfe4f4e8a2fc08f4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/28cf2552dfa2910fbfe4f4e8a2fc08f4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.haidrali.com" class="url" rel="ugc external nofollow">Haider Ali</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-22T10:17:00+00:00">June 22, 2017 at 10:17 am</time></a> </div>
<div class="comment-content">
<p>I got exactly same question in Amazon interivew and like an average programmer I followed the sorting approach and I failed the interview miserably. Then I spend some time on what went wrong and later found what went wrong with me and I came to know about binary heap way of solving this problem. But this RDBMS is good way of solving this approach in real world senarios. Also people have shared other solutions too like @Thibaut have shared a good solution i would definitely like to give it a try</p>
</div>
</li>
<li id="comment-283468" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4098928029d14e02180e0c427ff1bc60?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4098928029d14e02180e0c427ff1bc60?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://pempek.net/" class="url" rel="ugc external nofollow">Gregory</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-18T09:48:36+00:00">July 18, 2017 at 9:48 am</time></a> </div>
<div class="comment-content">
<p>Hello Daniel,</p>
<p>There&rsquo;s a bit of inconsistency in this post:<br/>
&#8211; you say you&rsquo;re generating 1408 random integers but then say blocks is set to 10<br/>
&#8211; you say you&rsquo;re looking for the 128 smallest integers but with defaultcomparator you&rsquo;re polling the smallest one each time</p>
</div>
<ol class="children">
<li id="comment-283482" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-18T14:50:10+00:00">July 18, 2017 at 2:50 pm</time></a> </div>
<div class="comment-content">
<p><em>you say you&rsquo;re generating 1408 random integers but then say blocks is set to 10</em></p>
<p>There are (blocks + 1) * 128 values being generated. You can verify that 11 * 128 is indeed 1408.</p>
</div>
</li>
<li id="comment-283483" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-18T14:57:07+00:00">July 18, 2017 at 2:57 pm</time></a> </div>
<div class="comment-content">
<p><em>you say you&rsquo;re looking for the 128 smallest integers but with defaultcomparator you&rsquo;re polling the smallest one each time</em></p>
<p>Yes, I have updated the blog post to reflect the fact that we seek the 128 largest values. </p>
<p>I also corrected a critical mistake in the code samples: the sorting code was flat out wrong (incredibly).</p>
</div>
</li>
</ol>
</li>
</ol>
