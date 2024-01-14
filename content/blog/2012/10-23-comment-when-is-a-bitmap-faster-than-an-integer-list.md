---
date: "2012-10-23 12:00:00"
title: "When is a bitmap faster than an integer list?"
index: false
---

[13 thoughts on &ldquo;When is a bitmap faster than an integer list?&rdquo;](/lemire/blog/2012/10-23-when-is-a-bitmap-faster-than-an-integer-list)

<ol class="comment-list">
<li id="comment-57980" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-23T10:37:04+00:00">October 23, 2012 at 10:37 am</time></a> </div>
<div class="comment-content">
<p>There are some downsides to the bitmap approach: you first have to construct the bitmaps and then you have to extract the set bits. </p>
<p>If you do a bunch of intersections, you end up with few non-zero bits/bytes. Hence, extraction may be quite cheap.</p>
<p>PS: Is JavaEH a sparse bitmap?</p>
</div>
</li>
<li id="comment-57981" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-23T10:59:55+00:00">October 23, 2012 at 10:59 am</time></a> </div>
<div class="comment-content">
<p>@Itman</p>
<p>1) Bitmap decoding should be cheap compared to the cost of computing an intersection, but it is still a significant overhead. Thankfully, you can reduce this overhead with fast bitmap decoding algorithms (see <a href="https://lemire.me/blog/archives/2012/05/21/fast-bitmap-decoding/" rel="ugc">http://lemire.me/blog/archives/2012/05/21/fast-bitmap-decoding/</a>).</p>
<p>2) Yes, JavaEWAH supports sparse bitmaps. There is also a C++ counterpart (<a href="https://github.com/lemire/EWAHBoolArray" rel="nofollow ugc">https://github.com/lemire/EWAHBoolArray</a>) but JavaEWAH is more popular.</p>
</div>
</li>
<li id="comment-57989" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-23T13:35:48+00:00">October 23, 2012 at 1:35 pm</time></a> </div>
<div class="comment-content">
<p>A good question to ask is how few bits we have to examine to construct the intersection of 2 or more vectors, given any choice of encoding for the vectors (without pre-storing intersections, etc.).</p>
<p>I looked at this problem some years ago and decided that (delta and) Golomb-Rice coding could be rearranged into a sort of bucketed bitmap arrangement, where the range is broken into buckets of M consecutive int&rsquo;s, represented in a bitmap (corresponding the unary parts of the coding), and an array of offsets within each occupied bucket, encoded in truncated binary as in the original. </p>
<p>For example, a sorted vector of int&rsquo;s in the range 0-127, with a Golomb-Rice bucket size of 8, would be broken into a 16-bit bitmap (buckets 0-7,8-15, &#8230;,120-127), and an array of offsets r &lt; 8 within those buckets, in truncated binary (since a bucket can contain more than one value, the offsets also need a bit to indicate &quot;consecutive in the same bucket&quot; or some such).</p>
<p>Calculating the intersection is a two-step process of first and-ing the bitmaps, and then fetching and comparing offsets in any bucket where a 1 remains. Since the offsets may be slow to fetch, the idea is to use the bitmaps as much as possible.</p>
<p>The optimality of Golomb-Rice means the average bitmap will be about 50% sparse, and n-way intersections can get 2^-n sparsity before any bucket contents need to be examined. </p>
<p>I never decided on the best way to store the offsets, but this seemed like a good way to size the summary bitmaps.</p>
</div>
<ol class="children">
<li id="comment-273967" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tobin Baker</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-04T21:57:37+00:00">March 4, 2017 at 9:57 pm</time></a> </div>
<div class="comment-content">
<p>You have basically just described Elias-Fano coding, which is provably optimal. See these slides for a nice intro: <a href="http://shonan.nii.ac.jp/seminar/029/wp-content/uploads/sites/12/2013/07/Sebastiano_Shonan.pdf" rel="nofollow ugc">http://shonan.nii.ac.jp/seminar/029/wp-content/uploads/sites/12/2013/07/Sebastiano_Shonan.pdf</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-57990" class="comment byuser comment-author-lemire bypostauthor even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-23T13:49:40+00:00">October 23, 2012 at 1:49 pm</time></a> </div>
<div class="comment-content">
<p>@KWillets</p>
<p>It is a reasonable approach. Have you tried implementing it?</p>
</div>
</li>
<li id="comment-57993" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1250430baa32d5f5ce9a39189adf6528?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1250430baa32d5f5ce9a39189adf6528?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://ajinkya.info" class="url" rel="ugc external nofollow">Ajinkya Kale</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-23T15:13:07+00:00">October 23, 2012 at 3:13 pm</time></a> </div>
<div class="comment-content">
<p>I just love the way you treat simple problems into fun analysis!</p>
</div>
</li>
<li id="comment-57994" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-23T15:27:25+00:00">October 23, 2012 at 3:27 pm</time></a> </div>
<div class="comment-content">
<p>No, I did some fiddling with it, but my employer at the time wasn&rsquo;t interested, and I didn&rsquo;t have the time to flesh it out fully. It might be fun to code up a simple benchmark.</p>
</div>
</li>
<li id="comment-57995" class="comment byuser comment-author-lemire bypostauthor odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-23T15:51:05+00:00">October 23, 2012 at 3:51 pm</time></a> </div>
<div class="comment-content">
<p>@KWillets</p>
<p>Get in touch with me if you do.</p>
</div>
</li>
<li id="comment-58001" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-23T18:44:19+00:00">October 23, 2012 at 6:44 pm</time></a> </div>
<div class="comment-content">
<p>It might be worth a shot. </p>
<p>It&rsquo;s also easier in Rice coding, because the offsets/remainders are fixed width.</p>
</div>
</li>
<li id="comment-58029" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eccbfb99f2a3da9810b0b2cb23400ac4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eccbfb99f2a3da9810b0b2cb23400ac4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://plus.google.com/+RalphCorderoy/about" class="url" rel="ugc external nofollow">Ralph Corderoy</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-24T06:29:11+00:00">October 24, 2012 at 6:29 am</time></a> </div>
<div class="comment-content">
<p>Clearing the sparse bitmap can take a while and that&rsquo;s a pain if it&rsquo;s a frequent operation.â€‚Russ Cox gives a nice explanation of an old technique for using uninitialised memory for a sparse set that allows a fast clear with slightly higher cost to the set and test operations.â€‚http://research.swtch.com/sparse</p>
</div>
</li>
<li id="comment-58090" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3c241721f8170857a6ddf6d8b4ef8891?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3c241721f8170857a6ddf6d8b4ef8891?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Calum</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-25T06:37:14+00:00">October 25, 2012 at 6:37 am</time></a> </div>
<div class="comment-content">
<p>I read somewhere that the most efficient data structure to represent a deck of playing cards is actually a bitmap, perhaps organised as 4*16-bit numbers representing the suits. Then it becomes much simpler/faster to detect various hands using bitwise operations.</p>
<p>This is most useful in AI where a lot of eventualities need to be computed quickly.</p>
</div>
</li>
<li id="comment-58420" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/01cc07930d88f6f16a6dbaa6590942f4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/01cc07930d88f6f16a6dbaa6590942f4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maxime Caron</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-30T15:32:28+00:00">October 30, 2012 at 3:32 pm</time></a> </div>
<div class="comment-content">
<p>Any idea how EWAH compare in speed or size to &ldquo;COmpressed &lsquo;N&rsquo; Composable Integer SET&rdquo;<br/>
see: <a href="http://ricerca.mat.uniroma3.it/users/colanton/concise.html" rel="nofollow ugc">http://ricerca.mat.uniroma3.it/users/colanton/concise.html</a></p>
<p>I am trying to heuristic that would let a database engine decide which implementation to use.</p>
</div>
</li>
<li id="comment-58422" class="comment byuser comment-author-lemire bypostauthor even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-30T16:24:10+00:00">October 30, 2012 at 4:24 pm</time></a> </div>
<div class="comment-content">
<p>@Maxime</p>
<p>I have written a benchmark to compare the various bitmap libraries, including Concise.</p>
<p>Please go to </p>
<p><a href="https://github.com/lemire/simplebitmapbenchmark" rel="nofollow ugc">https://github.com/lemire/simplebitmapbenchmark</a></p>
<p>If you are interested in the results I get on my machine, you can browse:</p>
<p><a href="https://github.com/lemire/simplebitmapbenchmark/blob/master/RESULTS" rel="nofollow ugc">https://github.com/lemire/simplebitmapbenchmark/blob/master/RESULTS</a></p>
<p>As usual, there are trade-offs.</p>
<p>If you want to run the test yourself, grab a copy and execute the bash script &ldquo;run.sh&rdquo; (or the Windows equivalent).</p>
<p>If you want to hack the code or add your own benchmarks, I&rsquo;ll be very interested in any contribution.</p>
</div>
</li>
</ol>
