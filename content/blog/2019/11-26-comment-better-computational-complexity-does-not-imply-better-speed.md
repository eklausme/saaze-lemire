---
date: "2019-11-26 12:00:00"
title: "Better computational complexity does not imply better speed"
index: false
---

[13 thoughts on &ldquo;Better computational complexity does not imply better speed&rdquo;](/lemire/blog/2019/11-26-better-computational-complexity-does-not-imply-better-speed)

<ol class="comment-list">
<li id="comment-449826" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7a09a10e61701b016db6bc7e55a9956b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7a09a10e61701b016db6bc7e55a9956b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Piet Cordemans</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-26T15:20:06+00:00">November 26, 2019 at 3:20 pm</time></a> </div>
<div class="comment-content">
<p>It should be possible to calculate the tipping point when the authors algorithm outperforms gmplib without implementing &amp; running the algorithm. Just don&rsquo;t ignore all constants and lower order terms in the cost function. It would still be an approximation, so your remark remains valid, however it would make clear if the algorithm optimization still holds on a realistic computer system.</p>
</div>
<ol class="children">
<li id="comment-449829" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-26T15:32:33+00:00">November 26, 2019 at 3:32 pm</time></a> </div>
<div class="comment-content">
<p><em> it would make clear if the algorithm optimization still holds on a realistic computer system</em></p>
<p>Importantly, in the breakthrough paper, the authors make no such claim as far as I can tell.</p>
<p>I think you could make reasonable estimates if you are sufficiently careful, and it could be a scientific claim (i.e., that can be invalidated). Knuth has done such work, for example. It is uncommon.</p>
</div>
</li>
</ol>
</li>
<li id="comment-449845" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-26T16:57:12+00:00">November 26, 2019 at 4:57 pm</time></a> </div>
<div class="comment-content">
<p>I think the primary reason they don&rsquo;t even demonstrate their algorithm is &#8211; if I understood it correctly &#8211; that the algorithm doesn&rsquo;t actually differ in running behavior from previous best theoretical run time complexity algorithms for reasonably sized inputs. Here being outside &ldquo;reasonable&rdquo; means that tipping point where differences start to show may require more storage than the whole observable universe could provide for a classical computer, plainly as a requirement for inputs that would show the difference. Surely this is well beyond any real-life machinery we could think for practical benchmarking&#8230;</p>
</div>
</li>
<li id="comment-450031" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/648cbb3135d4aa4ca7fc2a7849d7acd2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/648cbb3135d4aa4ca7fc2a7849d7acd2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ben</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-27T03:39:33+00:00">November 27, 2019 at 3:39 am</time></a> </div>
<div class="comment-content">
<p>You seem a bit too harsh on purely mathematical algorithms research. Perhaps their algorithm isn&rsquo;t generally better-in-practice, but their analysis opens the door to someone else making further progress later. Of course I do wonder if much of the research going on now will ever lead anywhere interesting. But in principle there can be value in foundational theoretical work.</p>
</div>
<ol class="children">
<li id="comment-450219" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-27T13:18:50+00:00">November 27, 2019 at 1:18 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>their analysis opens the door to someone else making further progress later.</p>
</blockquote>
<p>My second last paragraph makes this point.</p>
</div>
</li>
</ol>
</li>
<li id="comment-450087" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/01822efaf66e4b81d6f947cba7e0613a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/01822efaf66e4b81d6f947cba7e0613a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-27T07:48:25+00:00">November 27, 2019 at 7:48 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
Better computational complexity does not imply better speed
</p></blockquote>
<p>It implies there exists a point where it will have a better speed past a certain value of n.</p>
<blockquote><p>
Mathematics is a fine activity, but it is not to be confused with science or engineering
</p></blockquote>
<p>Good. It would be an embarrassment to be known as a scientist or an engineer.</p>
</div>
<ol class="children">
<li id="comment-450217" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-27T13:18:08+00:00">November 27, 2019 at 1:18 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>It implies there exists a point where it will have a better speed past a certain value of n.</p>
</blockquote>
<p>It does not.</p>
<blockquote>
<p>It would be an embarrassment to be known as a scientist or an<br/>
engineer.</p>
</blockquote>
<p>People who look down on engineering should not make engineering claims.</p>
</div>
</li>
</ol>
</li>
<li id="comment-450315" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-27T20:15:26+00:00">November 27, 2019 at 8:15 pm</time></a> </div>
<div class="comment-content">
<p>Good post, and fully agreed! Unfortunately this issue is prevalent even among software engineers. All too often people focus on theoretical worst-case behaviour without any regard for performance in the real world (eg. replacing Quicksort with a much slower sort).</p>
<p>In my experience a good implementation of an algorithm with worst case of O(N * N) can seriously outperform a guaranteed O(N) algorithm (see eg. [1]). For the strstr case the constant factors in the O-notation vary by about about 2 orders of magnitude, and triggering the worst cases requires special randomized inputs which maximize the number of branch mispredictions in each implementation.</p>
<p>So yes, claiming one algorithm is better than another solely based on theoretical complexity is completely missing the point. Another crazy assumption is that using O(N) temporary storage is just for &ldquo;free&rdquo;. Many string search algorithms require a pointer for every input character, ie. 8N bytes for N input bytes, making them completely useless in the real world.</p>
<p>[1] <a href="https://github.com/bminor/glibc/blob/master/string/strstr.c" rel="nofollow ugc">https://github.com/bminor/glibc/blob/master/string/strstr.c</a></p>
</div>
</li>
<li id="comment-450414" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-28T01:35:37+00:00">November 28, 2019 at 1:35 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
Please pause to consider: if you are a scientist, you need to make predictions that apply to our universe otherwise you are doing mathematics.
</p></blockquote>
<p>I think that&rsquo;s the issue and it&rsquo;s one of semantics. Theoretical CS has always had one foot firmly in the &ldquo;pure math&rdquo; camp. Based on my non-exhaustive Google search, it seems that a lot of people are in the &ldquo;math is not science&rdquo; camp because it lacks empirical verification or experiments involving natural phenomena. So therefore the &ldquo;S&rdquo; in &ldquo;CS&rdquo; becomes problematic for you.</p>
<p>Really, who cares? At the level of the original paper and the claims of the author, no one is being fooled. Everyone in the know understands the difference between these theoretical bounds and real-world performance. Yes, it&rsquo;s math result, not a &ldquo;applied CS&rdquo; result. A lot of other important results in CS qualify as &ldquo;math&rdquo;. What do you want the others to do? Refuse to publish their (IMO, very important) result because it doesn&rsquo;t satisfy your &ldquo;this universe, empirical&rdquo; requirement?</p>
<p>So I think you can only really pick a bone with the terminology in the Quanta article. Frankly, this is an article for lay people, even if Quanta still goes deeper than say &ldquo;USA Today&rdquo;. Yeah, it is very remiss for not mentioning that this technique is totally infeasible. I don&rsquo;t think the bar is very high for this kind of article and honestly a lot of it is good. They could have been more honest by walking back some of the claims and including a good disclaimer about practical speeds, but I feel your attack here is broader than called for.</p>
</div>
<ol class="children">
<li id="comment-452865" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-03T15:45:13+00:00">December 3, 2019 at 3:45 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>Everyone in the know understands the difference between these<br/>
theoretical bounds and real-world performance.</p>
</blockquote>
<p>Everyone who builds systems does. The authors of the cited paper almost surely do.</p>
</div>
<ol class="children">
<li id="comment-452998" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-03T23:53:30+00:00">December 3, 2019 at 11:53 pm</time></a> </div>
<div class="comment-content">
<p>Admittedly, I haven&rsquo;t read the paper (maybe link it?), but do the others claim anything other than a pure mathematical result?</p>
<p>That is, do they make the kind of &ldquo;faster and applicable in the real world&rdquo; claims that you object to, or do those only appear in the magazine?</p>
</div>
<ol class="children">
<li id="comment-453001" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-04T00:00:42+00:00">December 4, 2019 at 12:00 am</time></a> </div>
<div class="comment-content">
<p>They do not. I would have criticized them.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-451539" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3b22a16d5d87f2747684b614a3fd5f0d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3b22a16d5d87f2747684b614a3fd5f0d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jorge Bellón</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-30T09:23:49+00:00">November 30, 2019 at 9:23 am</time></a> </div>
<div class="comment-content">
<p>This problem of misusing asymptotic efficiency often takes place in the area of data structures.</p>
<p>We tend as humans to simplify very complex topics into a simple number or description for comparison, and then we ignore the actual meaning of the simplification when we do a comparison.</p>
<p>In the topic of data structures, big O notation usually means number of operations. However this becomes unrealistic for state of the art memory hierarchies, which is why, for example, cache oblivious algorithms use number of memory accesses for asymptotic efficiency instead.</p>
<p>I think the point of the article is not to speak bad about the publication per se, but rather the media that claims existing multiply implementations are slower. The fact that they assume the ability to handle big enough numbers does not mean existing computers will handle it properly.</p>
<p>It reminds me about the claims about quantum computers and their superior ability to tackle any problem than traditional computers.</p>
</div>
</li>
</ol>
