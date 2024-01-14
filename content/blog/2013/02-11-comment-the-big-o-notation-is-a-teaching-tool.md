---
date: "2013-02-11 12:00:00"
title: "The big-O notation is a teaching tool"
index: false
---

[14 thoughts on &ldquo;The big-O notation is a teaching tool&rdquo;](/lemire/blog/2013/02-11-the-big-o-notation-is-a-teaching-tool)

<ol class="comment-list">
<li id="comment-71689" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/db30653dd9479bbbcc01413081ee2496?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/db30653dd9479bbbcc01413081ee2496?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://mcw.wordpress.fos.auckland.ac.nz" class="url" rel="ugc external nofollow">Mark C. Wilson</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-02-11T12:59:24+00:00">February 11, 2013 at 12:59 pm</time></a> </div>
<div class="comment-content">
<p>Another point that is often overlooked: all your comments apply to Theta, rather than Omicron, in which case there is some actual content. &ldquo;Big-O&rdquo; is not at all relevant, for another reason. See</p>
<p>my old post.</p>
</div>
</li>
<li id="comment-71684" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c94c3db34cb5ad5d4f0e52460581b0f9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c94c3db34cb5ad5d4f0e52460581b0f9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Abdullah</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-02-11T11:14:32+00:00">February 11, 2013 at 11:14 am</time></a> </div>
<div class="comment-content">
<p>Well, you didn&rsquo;t mention the right answer for such a question. clearly with big enough input, the algorithm with smaller big O will run faster and this seems to be the right answer wither we like it or not. still, it could be the case that we always or most of the time have input size much smaller than &ldquo;big enough&rdquo; in which it makes perfect sense to switch to an algorithm that run slower with big input and faster with small ones. thanks for yet another good entry.</p>
</div>
</li>
<li id="comment-71686" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-02-11T11:29:42+00:00">February 11, 2013 at 11:29 am</time></a> </div>
<div class="comment-content">
<p>@Abdullah</p>
<p><em>(&#8230;) with big enough input, the algorithm with smaller big O will run faster (&#8230;) </em></p>
<p>It will run faster in some cases. And that is assuming that the computational model matches your architecture. </p>
<p>Very often, the big-O notation says nothing about how fast the algorithm will be in practice.</p>
<p>I am not saying you should use bubble sort on large arrays&#8230; I&rsquo;m saying that there is a lot more to high performance computing than the big-O notation the same way there is a lot more to engine design than thermodynamics.</p>
</div>
</li>
<li id="comment-71687" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c94c3db34cb5ad5d4f0e52460581b0f9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c94c3db34cb5ad5d4f0e52460581b0f9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Abdullah</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-02-11T11:41:40+00:00">February 11, 2013 at 11:41 am</time></a> </div>
<div class="comment-content">
<p>I get it now and this part says it all:</p>
<p>The problem with the big-O notation is that it is only meant to help you think about algorithmic problems. It is not meant to serve as the basis by which you select an algorithm!</p>
<p>thanks for the clarification.</p>
</div>
</li>
<li id="comment-71688" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/aaf21f137b69cc5154c8afb29b793e18?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/aaf21f137b69cc5154c8afb29b793e18?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alex</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-02-11T12:40:33+00:00">February 11, 2013 at 12:40 pm</time></a> </div>
<div class="comment-content">
<p>The hyperbole surrounding worst case complexity analysis these days is really distasteful. Headlines like &ldquo;The big-O notation is a teaching tool&rdquo; or &ldquo;O-notation considered harmful&rdquo; seem to advocate that people be ignorant, even if the article text ends up amounting to: average-case is often more important. </p>
<p>Any good developer should understand and consider both average and worst case performance. Both have real world implications, as to things like cache and memory structure. </p>
<p>Big-oh notation is just an efficient way for people to express ideas like &ldquo;doubling the size of the data multiplies the running time by four.&rdquo; It has nothing to do with teaching nor &ldquo;programmer experience.&rdquo;</p>
</div>
</li>
<li id="comment-71691" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-02-11T14:16:43+00:00">February 11, 2013 at 2:16 pm</time></a> </div>
<div class="comment-content">
<p>@Alex</p>
<p>My title is indeed hyperbolic. However, I am not advocating that people be ignorant. I believe that the big-O notation is one of the first things anyone serious about software should learn as it will save them much pain later on.</p>
<p>I am, however, also saying that it is far from enough. If that&rsquo;s all you know about how to assess the speed of an algorithm, you do not know enough.</p>
</div>
</li>
<li id="comment-71693" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Aykut Bulut</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-02-11T19:36:12+00:00">February 11, 2013 at 7:36 pm</time></a> </div>
<div class="comment-content">
<p>Hi Lemire. I follow your blog. Being on my way to get my PhD degree, I learn a lot from your writings. Especially the ones about academic writing.</p>
<p>I have a comment about the following section.</p>
<p>&ldquo;When asked why the an algorithm with better computational complexity fails to be faster, people often give the wrong answers:&rdquo;</p>
<p>I think you mean an algorithm with a better running time. Computational complexity is defined for problems. Performance of algorithms are measured by running time. Complexity of a problem is determined by the best algorithm that solves the problem.</p>
</div>
</li>
<li id="comment-71694" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-02-11T20:44:43+00:00">February 11, 2013 at 8:44 pm</time></a> </div>
<div class="comment-content">
<p>@Aykut Bulut</p>
<p>I think you make a valid point. I have updated my blog post.</p>
</div>
</li>
<li id="comment-71702" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b9d1ac6bd28925d3fae536b3cdb2a54?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b9d1ac6bd28925d3fae536b3cdb2a54?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mehmet Suzen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-02-12T05:51:26+00:00">February 12, 2013 at 5:51 am</time></a> </div>
<div class="comment-content">
<p>@Aykut Bulut</p>
<p>&rdquo; Computational complexity is defined for problems.&rdquo;</p>
<p>Complexity can also be defined for an algorithm or a program. More precisely information content of its data structures using algorithmic information theory i.e. Kolmogorov complexity. </p>
<p>&ldquo;Complexity of an problem is determined by the best algorithm that solves the problem.&rdquo; </p>
<p>Instead of the best, I think you mean the shortest algorithm. Measures of complexity varies. Seth Lloyd has a list of measures:</p>
<p><a href="http://web.mit.edu/esd.83/www/notebook/Complexity.PDF" rel="nofollow ugc">http://web.mit.edu/esd.83/www/notebook/Complexity.PDF</a></p>
</div>
</li>
<li id="comment-71703" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b9d1ac6bd28925d3fae536b3cdb2a54?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b9d1ac6bd28925d3fae536b3cdb2a54?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://memosisland.blogspot.de/" class="url" rel="ugc external nofollow">Mehmet Suzen</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-02-12T06:25:52+00:00">February 12, 2013 at 6:25 am</time></a> </div>
<div class="comment-content">
<p>&ldquo;..doubling the data size will multiply the running time by a factor of four, in the worst case. &rdquo;</p>
<p>I think our &lsquo;misconception&rsquo; come from that; Big-O notation measures asymptotic behaviour of the run time against the size of the input N i.e. very large N behaviour. So, the above statement may not be true for &ldquo;small inputs&rdquo;. For example if run-time complexity measured as 4*N^2 , we still call algorithms&rsquo; run time complexity as N^2. However for small N doubling the small data size MAY multiply the run time by a factor of 16!</p>
</div>
</li>
<li id="comment-71705" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-02-12T09:26:05+00:00">February 12, 2013 at 9:26 am</time></a> </div>
<div class="comment-content">
<p>@Mehmet Suzen</p>
<p>Are you sure of that example with 4*N^2?</p>
</div>
</li>
<li id="comment-71706" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b9d1ac6bd28925d3fae536b3cdb2a54?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b9d1ac6bd28925d3fae536b3cdb2a54?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://memosisland.blogspot.de/" class="url" rel="ugc external nofollow">Mehmet Suzen</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-02-12T10:21:08+00:00">February 12, 2013 at 10:21 am</time></a> </div>
<div class="comment-content">
<p>@Daniel Lemire</p>
<p>It is an elementary concept. Sorry, 4*N^2 was not a good example and my numbers were wrong. Idea was illustrating asymptotic behaviour shown by big-O notation could be &ldquo;misleading&rdquo; for &ldquo;smaller&rdquo; input. Let&rsquo;s take number of operation T(N)=4*N^2 &#8211; 2N. T'(4) must be 4 times of T'(2) if we consider as T'(N) = N^2. But if we use<br/>
T(N) instead, T(4) would be 4.666667 time of T(2). Actually you have given this in your post, but I don&rsquo;t know where 10TB example comes from, usually using more data full fills the scaling. Of course within reason, 10TB is too big for single machine (for now). In my experience with N-body force calculation O(N^2) algorithm performs better compare to O(NlogN) ones up to a break-even point even 50K particles. This is a good paper explaining this:</p>
<p>Pringle, Gavin J. &ldquo;Comparison of an O (N) and an O (N log N) N-body solver.&rdquo; PPSC (1995): 337-342.</p>
</div>
</li>
<li id="comment-72289" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Itman</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-02-17T16:55:59+00:00">February 17, 2013 at 4:55 pm</time></a> </div>
<div class="comment-content">
<p>Well, there are two problems with big-Os. One is that architecture does matter. A second one is that the constant under the big-O does matter as well (in certain cases, it is a bit more complicated than a constant, but a constant is a good approximation, anyway). In fact, these considerations are interconnected. </p>
<p>An architecture, e.g., using a cache-friendly algorithm, or SIMD-instructions, does affect the constant. Yet, the effect is typically not so great. But it is of practical importance so that one should not rely on just asymptotic estimates.</p>
<p>However, it really helps to think in terms Big-O plus a constant. This is not a premature optimization and often helps a lot. Regular expressions, as you may guess, is a bad example in my opinion. Because, it is possible to make most of them efficient. We could have even avoided this problem with developers who (1) respect the theory (2) understand not only Big-O, but also a hidden constant.</p>
</div>
</li>
<li id="comment-72565" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e1305fee562b70958e65b557ce049e31?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e1305fee562b70958e65b557ce049e31?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nir</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-02-19T15:30:41+00:00">February 19, 2013 at 3:30 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve encountered this effect firsthand. I was aware of the ideas here (at least to some degree); for instance I know that standard implementations of quicksort often switch to insertion sort on small arrays. </p>
<p>I recently solved a problem in Matlab in three different ways. Two were Theta(N) solutions that involved making several passes and processing. The third involved sorting the array first, and then a comparatively simple follow up. To my surprise, the algorithm involving sorting was faster for all the array sizes that I tried (I think on the order of N = 1 million). </p>
<p>Built in functions like sorting are likely to be so tweaked and optimized (especially in high level languages) compared to other functions you can write, that they may beat out Theta(N) algorithms.</p>
</div>
</li>
</ol>
