---
date: "2017-08-15 12:00:00"
title: "On Melissa O&#8217;Neill&#8217;s PCG random number generator"
index: false
---

[11 thoughts on &ldquo;On Melissa O&#8217;Neill&#8217;s PCG random number generator&rdquo;](/lemire/blog/2017/08-15-on-melissa-oneills-pcg-random-number-generator)

<ol class="comment-list">
<li id="comment-284212" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/350f8b9bc0095b911ffc87206ca05bfa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/350f8b9bc0095b911ffc87206ca05bfa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Aleksey Demakov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-15T18:55:53+00:00">August 15, 2017 at 6:55 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s interesting. I chose Sebastiano Vigna&rsquo;s last PRNG based mostly on that it was the last thing published on the internet and that the claims made by the author were bold and generally reasonable. I never bothered to run the benchmarks myself and verify the claims. I just took them for granted. I guess the peope who chose PCG in their projects just did it when it was the last cool thing published. There is a room for accident in software engineering.</p>
</div>
<ol class="children">
<li id="comment-284214" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-15T21:00:10+00:00">August 15, 2017 at 9:00 pm</time></a> </div>
<div class="comment-content">
<p>What you did is reasonable. Certainly, Vigna has been clear on how he recommends against PCG and he is a good researcher and programmer. Of course, we should remain open to the possibility that the people who went with PCG are correct in their choice. I refer you to John Cook who has been doing comparisons.</p>
</div>
<ol class="children">
<li id="comment-284242" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/62aaaf6dfc5c0fd3c037fa9fb106c677?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/62aaaf6dfc5c0fd3c037fa9fb106c677?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marc Reynolds</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-16T12:28:19+00:00">August 16, 2017 at 12:28 pm</time></a> </div>
<div class="comment-content">
<p>For what it&rsquo;s worth I&rsquo;ve run ~500 testu01 crush battery runs on the main PCG variants and xorshift128+ and xorshiro with no questionable p-values, so I feel OK using any of these with sample size per problem &lt;= 10^5 which is way more than I ever care about. John Cook mostly talks about DIEHARDER and the NIST suites, which I personally don&#039;t have much confidence in (too easy to pass). Of course to make me feel like a jerk he&#039;s just put up a post using PractRand (which I know nothing about) on all of these&#8230;so it goes:<br/>
<a href="https://www.johndcook.com/blog/2017/08/14/testing-rngs-with-practrand/" rel="nofollow ugc">https://www.johndcook.com/blog/2017/08/14/testing-rngs-with-practrand/</a></p>
</div>
<ol class="children">
<li id="comment-284243" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-16T12:34:55+00:00">August 16, 2017 at 12:34 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;d like to clarify that I did not mean to suggest in any way that Vigna&rsquo;s RNG were not good choices.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-284216" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a2687db108c1a7877b64e20c4bf62ee2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a2687db108c1a7877b64e20c4bf62ee2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Random pedestrian</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-15T22:07:02+00:00">August 15, 2017 at 10:07 pm</time></a> </div>
<div class="comment-content">
<p>You also might be interested in Xoroshiro:<br/>
<a href="http://xoroshiro.di.unimi.it" rel="nofollow ugc">http://xoroshiro.di.unimi.it</a></p>
</div>
</li>
<li id="comment-284228" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9d2b1314ce4ee39ae05a50a449ca837b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9d2b1314ce4ee39ae05a50a449ca837b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cellar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-16T05:41:33+00:00">August 16, 2017 at 5:41 am</time></a> </div>
<div class="comment-content">
<p>I think you&rsquo;re misunderstanding the peer-review-and-publishing process. Ending up published is supposed to be at the end of a peer-review process. Though many &ldquo;scientific journals&rdquo; now exist where no such thing happens, as has been demonstrated, e.g. through fake papers, time and again. Not ending up published doesn&rsquo;t mean no peer review happened. That happens, formally at each submission, presumably, and informally any time the author receives comments from other readers of the paper.</p>
<p>So what happens at &ldquo;peer review&rdquo;? Well, in this case it appears the paper didn&rsquo;t convey enough of that &ldquo;one of us&rdquo;-smell for some reviewers to assent to publishing. Because the prose was too accessible, maybe? (Which is a silly proposition since science is useless if inaccessible, so its prevalence is a problem.) That doesn&rsquo;t mean the work is any good, just that it is accessible.</p>
<p>And that is perhaps the core problem with any scientific work these days. You still have to read the paper and make up your own mind. The number of people who&rsquo;ve just copied the ideas into (at least seemingly) working code says nothing about how good the presented method is, either; all it does is give some indication of popularity. But that is a different thing.</p>
</div>
<ol class="children">
<li id="comment-284244" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-16T12:36:45+00:00">August 16, 2017 at 12:36 pm</time></a> </div>
<div class="comment-content">
<p>I think we are in agreement but I&rsquo;d like you to consider the possibility that I am less naive about the process than you suggest.</p>
</div>
</li>
</ol>
</li>
<li id="comment-285013" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/630cb93dde2b32bd302a1a597f4aa485?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/630cb93dde2b32bd302a1a597f4aa485?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Robert Zeh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-26T18:57:35+00:00">August 26, 2017 at 6:57 pm</time></a> </div>
<div class="comment-content">
<p>As a someone who builds computer systems, I&rsquo;m far more likely to use something like PCG &#8212; something with clear and easy to read public documentation and a public code repository &#8212; than I am to use something from a paper. If the paper is only available in a paywalled journal I&rsquo;m unlikely to grab it.<br/>
My experience has been that the closer in spirit an academic project is to an open source project, the more likely it will be to have working code I can use and contribute to.<br/>
I know that academic papers are intended to describe novel ideas, not working code, but I&rsquo;ve found that unimplementable ideas are plentiful. Novel ideas that also good engineering solutions are much rarer.</p>
</div>
<ol class="children">
<li id="comment-610064" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5780d81ca8ef00d7951b96617e1c3ee7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5780d81ca8ef00d7951b96617e1c3ee7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">.Tom</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-12-06T13:10:52+00:00">December 6, 2021 at 1:10 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s an important point. O&rsquo;Neill made it easy to use the works.</p>
</div>
</li>
</ol>
</li>
<li id="comment-301783" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/47ec7b2d660eca555609656792844511?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/47ec7b2d660eca555609656792844511?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Hrobjartur Thorsteinsson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-27T13:56:12+00:00">April 27, 2018 at 1:56 pm</time></a> </div>
<div class="comment-content">
<p>Melissa seems to be right that PRNG are largely verified benchmarks, hopefully well designed and possibly research published statistical tests.</p>
<p>I imagine all these tests that all these professors have devised and applied will eventually fault the PCG in some way as they fault other generators. She is also very right to advertise that many of the worst generators are still defaults in our modern compilers and programming languages.</p>
<p>The current default Golang math/rand.go is a very scary choice, because nobody seems to have been able to track down the creator of that algorithm, nor any publication describing it.</p>
<p>PCG will not disappear just because the professor has quirks when it comes to academia and publishing &#8212; loads of quirky ones out there. As you indicate also, no evidence seems to have surface to reject PCG, are academics not trying hard enough to fault the algorithm?</p>
<p>Someone expert in testing randomness may want to write a statistical test to fault PCG soon because it seems it may become a prime choice for Go 2.0 and future versions of C++. After all, most software developers, compiler developers and hardware developers love benchmarks, and the benchmarks that exist say this one is better. Problem is maybe that we have a selection effect here, someone just hasn&rsquo;t yet written a benchmark that specifically faults PCG?</p>
</div>
</li>
<li id="comment-303304" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/58c1a3b7009d2666847289f4cd3d4dd9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/58c1a3b7009d2666847289f4cd3d4dd9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Albert Chan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-12T15:29:03+00:00">May 12, 2018 at 3:29 pm</time></a> </div>
<div class="comment-content">
<p>Some criticisms of PCG:</p>
<p><a href="https://groups.google.com/forum/m/#!topic/prng/jJVEldv3sH0" rel="nofollow ugc">https://groups.google.com/forum/m/#!topic/prng/jJVEldv3sH0</a></p>
</div>
</li>
</ol>
