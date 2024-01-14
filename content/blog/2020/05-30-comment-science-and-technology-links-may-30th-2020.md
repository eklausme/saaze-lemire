---
date: "2020-05-30 12:00:00"
title: "Science and Technology links (May 30th 2020)"
index: false
---

[2 thoughts on &ldquo;Science and Technology links (May 30th 2020)&rdquo;](/lemire/blog/2020/05-30-science-and-technology-links-may-30th-2020)

<ol class="comment-list">
<li id="comment-521932" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d081923c9998bd094289a54a0ee1045b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d081923c9998bd094289a54a0ee1045b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Eden Segal</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-30T18:31:12+00:00">May 30, 2020 at 6:31 pm</time></a> </div>
<div class="comment-content">
<p>Regarding Neural Network: At my last job, we tried to find the best representation of algorithms to test their perf. There was several things that I got opinions about:</p>
<p>Recomendation systems are too secret at the moment. You can&rsquo;t find a real open source recomendation system that is big enough for you to care about. I think that&rsquo;s the reason the 6/9 Neural Networks were better than regular approaches. It&rsquo;s still possible that the real hidden networks are worse than the regular, but I just can&rsquo;t be sure.<br/>
Quantization works only when your SNR is high enough, at least without retraining, which makes sense. On classification networks, it&rsquo;s fairly easy to quantize because lowering your SNR does almost nothing to the result. On GANs, I think it&rsquo;s almost impossible to quantize without seeing worse results. As NN started with classification, it was easy to jump on that train. I don&rsquo;t think it&rsquo;s still that much of a viable solution. I believe that bfloat16 or tensorfloat32 is a better solution<br/>
It&rsquo;s fairly hard to get performance out of prunning. Just taking out 90% of the values and setting them to zero means nothing for simd mat multiply. You need to chop out a bunch of channels to make it worth while, and even then, it&rsquo;s not that easy to get meaningful performance out of it.<br/>
I don&rsquo;t think that LSTM is really that good. It&rsquo;s old and it passed the test of time, but you really need to change all of those sigmoids to a normal activation function like relu or something suffiencently easy to compute.</p>
</div>
</li>
<li id="comment-522272" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">degski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-31T13:50:42+00:00">May 31, 2020 at 1:50 pm</time></a> </div>
<div class="comment-content">
<p>The article on neural networks is interesting.</p>
<p>I have dabbled with ann&rsquo;s since the 90&rsquo;s. There was no tensorflow or caffe, write from scratch, while the research was slowly advancing, it was all (the research) written down on trees (imagine). I don&rsquo;t know where to begin to explain why I think it&rsquo;s all wrong.</p>
<p>It starts with (of course the usual guys), but for me there was in particular Bogdan Wilamovski (<a href="http://www.eng.auburn.edu/~wilambm/" rel="nofollow ugc">http://www.eng.auburn.edu/~wilambm/</a>), he&rsquo;s not pretty, but has something to say. He demonstrates that a fully connected cascade network is the most general shape of (feed-forward) ann&rsquo;s (all shape networks are captured by this architecture). This implies that optimizing a network comes down to giving it enough nodes that it has enough plasticity to function (too little, won&rsquo;t converge), too much over-learning and waste of calculation.</p>
<p>Optimizing the size of the network is easy, coz you only have to modify one variable with no knock-on effect. Dealing in bulk with these kind of networks can be implemented very efficiently using blas. I have trained such a network of 5 nodes (yes five) using GE to play snake at breakneck speed while learning how to play and growing and growing (too large size, it&rsquo;s impressive what 5 cells can do).</p>
<p>The repo: <a href="https://github.com/degski/SimdNet" rel="nofollow ugc">https://github.com/degski/SimdNet</a> . It&rsquo;s called SimdNet, coz that&rsquo;s how it started, it ended up being an ordinary BlasNet ;(. For output I use the new W10 unicode console functionality, it allows to write to the console at will basically, no flicker or artifacts (and all &lsquo;ascii&rsquo;, like a real snake game). The latter makes it non-portable, the core code is portable of course.</p>
<p>To conclude, you see the difference, I use 5 nodes and a bit of Blas on a moderate computer, and then there is &lsquo;modern&rsquo; ann&rsquo;s. One has too read the right book.</p>
<p>PS: Wilamovski has also published a very efficient 2nd order algorithm for &lsquo;backprop&rsquo;, notably he decomposes the jacobian in such a way that it can be calculated without first fully expanding it, which would be prohibitive.<br/>
PS: All literature is on his web-site, chapter 11,12,13 are the core of his work (in this respect, he seems very busy with the soldering iron otherwise).</p>
</div>
</li>
</ol>
