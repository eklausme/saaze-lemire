---
date: "2012-02-08 12:00:00"
title: "Effective compression using frame-of-reference and delta coding"
index: false
---

[12 thoughts on &ldquo;Effective compression using frame-of-reference and delta coding&rdquo;](/lemire/blog/2012/02-08-effective-compression-using-frame-of-reference-and-delta-coding)

<ol class="comment-list">
<li id="comment-54965" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-02-10T09:47:10+00:00">February 10, 2012 at 9:47 am</time></a> </div>
<div class="comment-content">
<p>I would also recommend a a link to <a href="http://www.springerlink.com/content/j66851228120170t/" rel="nofollow ugc">http://www.springerlink.com/content/j66851228120170t/</a><br/>
Delta and Golomb codes are kinda slow to be used in a high-throughput search engine (though they definitely make sense in other apps). Byte and word-aligned codes work much faster in this case.</p>
<blockquote><p>Note by D. Lemire: The link above is to the following paper</p>
<p>Anh, Vo Ngoc and Moffat, Alistair, Inverted Index Compression Using Word-Aligned Binary Codes, Information Retrieval 8 (1), 151&#8211;166, 2005.</p></blockquote>
</div>
</li>
<li id="comment-54966" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-02-10T10:42:54+00:00">February 10, 2012 at 10:42 am</time></a> </div>
<div class="comment-content">
<p>@Itman</p>
<p>Golomb-Rice is definitively a bit slow for high-throughput applications. I am not sure that it is true for Yan et al.&rsquo;s NewPFD. According to Delbru et al., it is just as fast, and even faster, than word-aligned codes (S9-64): </p>
<p>R. Delbru, S. Campinas, K. Samp Giovanni Tummarello, <a href="http://www.renaud.delbru.fr/doc/pub/deri2010-afor.pdf" rel="nofollow">Adaptive frame of reference for compressing inverted lists</a>, DERI Technical Report 2010-12-16, 2010.</p>
<p>Delbru also posted a <a href="http://mail-archives.apache.org/mod_mbox/lucene-dev/201004.mbox/%3C1628107767.661361270224987316.JavaMail.jira@brutus.apache.org%3E" rel="nofollow">comparison on the Lucene mailing list</a>.</p>
</div>
</li>
<li id="comment-54967" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-02-10T10:50:13+00:00">February 10, 2012 at 10:50 am</time></a> </div>
<div class="comment-content">
<p>Cool, I am certainly going to check it out. With respect to the Golomb and Delta codes, by slow I mean really slow. Even the not-so-efficient VBC is twice is fast as Golomb.</p>
</div>
</li>
<li id="comment-54968" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-02-10T10:57:41+00:00">February 10, 2012 at 10:57 am</time></a> </div>
<div class="comment-content">
<p>@Itman</p>
<p>I agree regarding Golomb-Rice coding, and I believe that&rsquo;s because it introduces a lot of branching. But the Delbru reference hints that delta coding can be quite fast when properly implemented. Moreover, szip which uses delta coding <a href="https://www.hdfgroup.org/doc_resource/SZIP/" rel="nofollow">can be quite a bit faster than gzip</a> during compression.</p>
<p>Why do you think that delta coding is necessarily slow? For example, if I notice that within blocks successive xors are small integers, and I pack them, this ought to be very fast (no branching, and only very fast operations). In fact, I am pretty sure I can implement it using no more than 1 CPU cycle per value on average with pipelining, and maybe less. Of course, it may compress poorly, but that&rsquo;s another story.</p>
</div>
</li>
<li id="comment-54969" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-02-10T11:11:29+00:00">February 10, 2012 at 11:11 am</time></a> </div>
<div class="comment-content">
<p>From my experience: just re-ran a test on my laptop. Well, of course, I cannot guarantee that this holds true for all implementations and platforms. New architectures have amazing surprises like<br/>
1) Unfolding loops does not help<br/>
2) Aligned reading is as good as unaligned<br/>
Anyways, for my implementations the differences between VBC and Delta is not even two-fold, it is 10+-fold. Perhaps, I should rexamine my code some day.</p>
</div>
</li>
<li id="comment-54970" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-02-10T11:14:21+00:00">February 10, 2012 at 11:14 am</time></a> </div>
<div class="comment-content">
<p>@Itman </p>
<p>Would you share your code with me? I&rsquo;d like to examine it. (I don&rsquo;t need a license to it, I just would like to see exactly what you are comparing.)</p>
</div>
</li>
<li id="comment-54971" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-02-10T11:21:03+00:00">February 10, 2012 at 11:21 am</time></a> </div>
<div class="comment-content">
<p>Sure, no problem. I will it do it next week, because I want to do a quick check myself.</p>
</div>
</li>
<li id="comment-203717" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7024d10123e72df27a94144d68a7daf6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7024d10123e72df27a94144d68a7daf6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Oscar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-11-04T21:48:24+00:00">November 4, 2015 at 9:48 pm</time></a> </div>
<div class="comment-content">
<p>Just ran into this page after googling &ldquo;delta compression xor&rdquo;.<br/>
It seems to me the hoops to jump through in the unsorted case for delta encoding (negative deltas) go away if you encode your deltas using base -2 . Then, all you need is for the absolute value of the differences to be small. There are then tricks to compute using the -2 encoded numbers directly.</p>
</div>
<ol class="children">
<li id="comment-203754" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-11-04T23:36:49+00:00">November 4, 2015 at 11:36 pm</time></a> </div>
<div class="comment-content">
<p>Can you elaborate?</p>
</div>
<ol class="children">
<li id="comment-203776" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7024d10123e72df27a94144d68a7daf6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7024d10123e72df27a94144d68a7daf6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Oscar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-11-05T00:34:44+00:00">November 5, 2015 at 12:34 am</time></a> </div>
<div class="comment-content">
<p>What I mean is, related to the problem with coding up the -1,<br/>
You offered three solutions: xor rather than delta which is good except in cases where the hamming distance is large (even though the delta is small), a second solution that I didn&rsquo;t fully follow and one where &ldquo;we add a pointer to the second last difference to indicate that we are missing 5 bits (11111).&rdquo;. </p>
<p>Another approach is the following: Using base -2 to encode the deltas. Hacker&rsquo;s delight explains base -2 better than I can. But roughly: a number b_k, &#8230; , b1 b0 corresponds to b0 &#8211; 2 (b1) + 4 (b2) &#8211; 8 (b3) &#8230;. + (-2)^k (b_k). In practice, this means 0 maps to &lsquo;0&rsquo;, 1 maps to &lsquo;1&rsquo;, -1 maps to &rsquo;11&rsquo;, 2 maps to &lsquo;110&rsquo;, -2 maps to &rsquo;10&rsquo;, 3 maps to &lsquo;111&rsquo;. The property I care about in this case is that numbers with small absolute values will have small numbers non-zero bits. A positive number may be penalized in this case since it requires slightly more bits.</p>
<p>I haven&rsquo;t done a full analysis of when this will be a win over the other methods (how many bits does it actually take for your sequence, how much does encoding/ decoding cost), but there are tricks to operate add the numbers without fully decoding them. It was just exciting because it looks like a possible application of this encoding 😉</p>
</div>
<ol class="children">
<li id="comment-203960" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-11-05T12:48:58+00:00">November 5, 2015 at 12:48 pm</time></a> </div>
<div class="comment-content">
<p>I have updated the blog post with zig-zag encoding. I think it is closely related to your concept of base -2.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-291872" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6ba6a72ddc9eb9f5362875892b09120b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6ba6a72ddc9eb9f5362875892b09120b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">saddam</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-21T23:37:53+00:00">November 21, 2017 at 11:37 pm</time></a> </div>
<div class="comment-content">
<p>how it(delta compression) works on sensor received data, which is a 16 bit continuous data&rsquo;s . The standard delta encoding doesnt work, because i have random values. ?</p>
</div>
</li>
</ol>
