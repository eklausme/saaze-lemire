---
date: "2009-12-09 12:00:00"
title: "Run-length encoding (part 3)"
index: false
---

[13 thoughts on &ldquo;Run-length encoding (part 3)&rdquo;](/lemire/blog/2009/12-09-run-length-encoding-part-3)

<ol class="comment-list">
<li id="comment-51973" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Kevembuangga</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-10T01:56:35+00:00">December 10, 2009 at 1:56 am</time></a> </div>
<div class="comment-content">
<p>But did you try Burrowsâ€“Wheeler within a single column irrespective of other columns/rows shuffling?</p>
</div>
</li>
<li id="comment-51975" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-10T07:57:22+00:00">December 10, 2009 at 7:57 am</time></a> </div>
<div class="comment-content">
<p>@Kevembuangga<br/>
Yes, I thought about it&#8230; But reordering the columns independently makes reconstructing single rows a messy adventure.</p>
</div>
</li>
<li id="comment-51984" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kevembuangga</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-11T02:38:09+00:00">December 11, 2009 at 2:38 am</time></a> </div>
<div class="comment-content">
<p><i>makes reconstructing single rows a messy adventure</i></p>
<p>Beside having to &ldquo;guess&rdquo; the value of the given row items from BW reordered columns how is that more <i>messy</i> than having to unfold the RLE compressed columns up to the row rank you are interested in?</p>
</div>
</li>
<li id="comment-51985" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-11T07:39:52+00:00">December 11, 2009 at 7:39 am</time></a> </div>
<div class="comment-content">
<p>@Kevembuangga Suppose you want to get all row IDs where the first column has value X and the second column has value Y. How do you extract these row IDs quickly, if the columns were reordered independently?</p>
</div>
</li>
<li id="comment-51986" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kevembuangga</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-11T11:36:40+00:00">December 11, 2009 at 11:36 am</time></a> </div>
<div class="comment-content">
<p><i>How do you extract these row IDs quickly</i></p>
<p>You would have to run the inverse BWT on each whole column, this is just another stage of decompression, unless there is a very clever hack (on a level of this kind!) to peek the ID values from the encoded BWT.<br/>
Do you mean that with simple RLE you can pick the row IDs corresponding to the Xs an Ys somehow by &ldquo;direct access&rdquo; from the compressed columns without actually running thru the whole columns?<br/>
And don&rsquo;t you use boolean operations on bit maps to compute such sets of IDs?</p>
<p>Anyway, may be you should forget about Burrows-Wheeler which is overrated due to its good performance on text but bad for Markov sources, which column data probably are most often.<br/>
See <a href="http://www.math.tau.ac.il/~haimk/pubs.html" rel="nofollow">Most Burrows-Wheeler based compressors are not optimal</a><br/>
H. Kaplan and E. Verbin, CPM&rsquo;07</p>
</div>
</li>
<li id="comment-51987" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-11T12:09:00+00:00">December 11, 2009 at 12:09 pm</time></a> </div>
<div class="comment-content">
<p>@Kevembuangga </p>
<p>Thank you for the pointers.</p>
<p><i>You would have to run the inverse BWT on each whole column, this is just another stage of decompression (&#8230;)</i> </p>
<p>Who said anything about decompressing the data?</p>
<p>I can scan RLE-compressed data looking for the row IDs I need without ever decompressing them. So, the running time is a linear function of the compressed size of my input. (Times some factor which depends on the number of columns.)</p>
<p>If I first decompress the data, then my processing time will be a function of the real (uncompressed) data size. I save on storage but not on processing time. In fact, the processing time will be longer than if I had worked with uncompressed data (not accounting for possible IO savings).</p>
<p>And I am not even discussing the processing overhead of computing several BWT.</p>
</div>
</li>
<li id="comment-51988" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kevembuangga</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-11T13:26:11+00:00">December 11, 2009 at 1:26 pm</time></a> </div>
<div class="comment-content">
<p><i>I can scan RLE-compressed data looking for the row IDs I need without ever decompressing them. So, the running time is a linear function of the compressed size of my input. </i></p>
<p>Mmmmmm&#8230; I see, but you still do run thru the whole column, if you were <b>really</b> clever you could have the running time a linear function of <b>ONLY the size of the compressed output</b> (number of rows matching the sought for value(s)):<br/>
Instead of storing some kind of map of the row values, store <i>for each possible row value (cardinality)</i><i> a compressed bit map of the corresponding row IDs.<br/>
So whenever you know which values you are looking for you only pick and process the corresponding bit maps.<br/>
Compressed sparse bit maps can be cheap&#8230;</i></p>
</div>
</li>
<li id="comment-51989" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kevembuangga</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-11T13:33:14+00:00">December 11, 2009 at 1:33 pm</time></a> </div>
<div class="comment-content">
<p>Typo: &ldquo;each possible <i>column</i> value&rdquo; instead of &ldquo;each possible row value&rdquo;</p>
</div>
</li>
<li id="comment-51990" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-11T14:09:18+00:00">December 11, 2009 at 2:09 pm</time></a> </div>
<div class="comment-content">
<p>@Kevembuangga</p>
<p><em>if you were really clever you could have the running time a linear function of ONLY the size of the compressed output</em></p>
<p>The curse of dimensionality makes this cleverness extremely difficult unless you expect specific queries.</p>
<p>Consider these queries for example:</p>
<p><code><br/>
select X*Y*Z where (X*Y-Z&lt;W);<br/>
select * where (X*X+Y*Y&lt;Z*Z+W*W+V*V);<br/>
</code></p>
<p>Certainly, you can find ways to index them. But if I am free to come up with others, you will eventually get in serious trouble.</p>
<p>The lesson here is that there is not one indexing strategy that will always work. </p>
<p>You may enjoy this earlier blog post:</p>
<p>Understanding what makes database indexes work<br/>
<a href="http://www.daniel-lemire.com/blog/archives/2008/11/07/understanding-what-makes-database-indexes-really-work/" rel="nofollow ugc">http://www.daniel-lemire.com/blog/archives/2008/11/07/understanding-what-makes-database-indexes-really-work/</a></p>
</div>
</li>
<li id="comment-52009" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kevembuangga</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-12T00:35:41+00:00">December 12, 2009 at 12:35 am</time></a> </div>
<div class="comment-content">
<p><i>The curse of dimensionality &#8230;</i></p>
<p>Looks like we are not talking about the same topic, never mind.</p>
</div>
</li>
<li id="comment-52010" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-12T10:28:49+00:00">December 12, 2009 at 10:28 am</time></a> </div>
<div class="comment-content">
<p>@Kevembuangga Yes, I think we are talking about the same thing. If you only focus on one column at a time, you can indeed index things up very nicely using a (compressed) B-tree or hash table. But we are dealing with a multidimensional list&#8230; a table with several columns&#8230; that&rsquo;s much harder to index.</p>
</div>
</li>
<li id="comment-52011" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kevembuangga</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-12T12:25:52+00:00">December 12, 2009 at 12:25 pm</time></a> </div>
<div class="comment-content">
<p><i>I think we are talking about the same thing. </i></p>
<p>Then <b>you</b> missed my point!<br/>
I am not proposing a scheme that will resolve the multicolumns sorting conundrum any better than your (or anyone else&rsquo;s) RLE compression.<br/>
What I say is that when working within anyone column during a complex search it is possible to reduce the computation load to be only proportional to the compressed size of the intermediate result (set of row IDs) for this column <b>NOT</b> to the compressed size of the whole column.<br/>
Though that is of practical import only if there isn&rsquo;t a constant multiplicative factor hidden somewhere in the algorithm I envision which will spoil the better asymptotic performance, many a &ldquo;theoretically best&rdquo; algorithm is crippled by this.<br/>
All this of course assuming that we are still speaking about columns for which <a href="https://lemire.me/blog/2009/11/12/which-should-you-pick-a-bitmap-index-or-a-b-tree/" rel="nofollow">a bitmap is to be preferred</a>.</p>
</div>
</li>
<li id="comment-52013" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/67d383ef404dc3f3ee8173be1063ef7f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/67d383ef404dc3f3ee8173be1063ef7f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Willfred</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-14T19:20:02+00:00">December 14, 2009 at 7:20 pm</time></a> </div>
<div class="comment-content">
<p>Interesting, simple and effective.</p>
</div>
</li>
</ol>
