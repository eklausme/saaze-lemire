---
date: "2023-04-06 12:00:00"
title: "Are your memory-bound benchmarking timings normally distributed?"
index: false
---

[14 thoughts on &ldquo;Are your memory-bound benchmarking timings normally distributed?&rdquo;](/lemire/blog/2023/04-06-are-your-memory-bound-benchmarking-timings-normally-distributed)

<ol class="comment-list">
<li id="comment-650199" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9acee3f0ef79132b823e7cd6b6ab60f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9acee3f0ef79132b823e7cd6b6ab60f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://www.jabperf.com" class="url" rel="ugc external nofollow">Mark E Dawson Jr</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-06T22:30:34+00:00">April 6, 2023 at 10:30 pm</time></a> </div>
<div class="comment-content">
<p>Yes, this is why I generally use nonparametric statistical tests for my end-to-end performance benchmarks &#8211; e.g., Kolmogorov–Smirnov, Wasserstein Distance, etc.</p>
</div>
</li>
<li id="comment-650200" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a9220dff7c6e48a125c747dd2eb74ffe?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a9220dff7c6e48a125c747dd2eb74ffe?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://adrianco.medium.com/percentiles-dont-work-analyzing-the-distribution-of-response-times-for-web-services-ace36a6a2a19" class="url" rel="ugc external nofollow">Adrian Cockcroft</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-06T22:49:24+00:00">April 6, 2023 at 10:49 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel &#8211; thanks for raising this issue and proposing a better metric. One way of thinking about this is that normal distribution applies when the random errors are additive/subtractive, however for computer response times the errors are multiplicative. E.g. the system is slower so everything takes 10% longer rather than taking a fixed extra 100ms (or whatever), and that is the log normal model. I recently blogged about this &#8211; <a href="https://adrianco.medium.com/percentiles-dont-work-analyzing-the-distribution-of-response-times-for-web-services-ace36a6a2a19" rel="nofollow ugc">https://adrianco.medium.com/percentiles-dont-work-analyzing-the-distribution-of-response-times-for-web-services-ace36a6a2a19</a></p>
</div>
</li>
<li id="comment-650203" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/45a168cb9eb8454d66c78f18e29d9342?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/45a168cb9eb8454d66c78f18e29d9342?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://brandon.si" class="url" rel="ugc external nofollow">Brandon Simmons</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-06T23:18:15+00:00">April 6, 2023 at 11:18 pm</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s odd min seems not commonly used as a summary statistic, e.g. for performance regression reports. It&rsquo;s intuitively an asymptote for any real workload: on a given machine an operation can get arbitrarily slow for any number of reasons (scheduling, contention for resources, hot cpu, etc etc), but it can only get so fast&#8230;</p>
<p>At hasura we get a histogram view of latencies and also do something which I think is quite useful: we overlay a histogram from just the first half of the samples taken (but with the counts doubled), with the full set of samples. This lets you see if the distribution is drifting over time, or suggests whether you should take more samples.</p>
</div>
</li>
<li id="comment-650210" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6f7114f33eec890642397f06e8ea12ea?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6f7114f33eec890642397f06e8ea12ea?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.probablydance.com" class="url" rel="ugc external nofollow">Malte Skarupke</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-07T01:34:56+00:00">April 7, 2023 at 1:34 am</time></a> </div>
<div class="comment-content">
<p>I once heard in a talk that you should use the median. (I think the talk was by Andrei Alexandrescu)</p>
<p>With enough samples the median approaches the minimum, but it&rsquo;s more robust to outliers.</p>
<p>Why would the minimum be an outlier? Because CPUs are good at predicting things, so you want randomness to undo the prediction. But if you randomly get a fast run, or the CPU randomly predicts everything right, you get an unrealistic measurement. (See Emery Berger&rsquo;s talk &ldquo;performance matters&rdquo; on why you want randomness)</p>
<p>Why not use the average? Because you never actually measured that number. The talk &ldquo;How not to measure latency&rdquo; by Gil Tene gives lots of reasons for why you only want numbers that actually happened.</p>
</div>
<ol class="children">
<li id="comment-650261" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-07T15:39:56+00:00">April 7, 2023 at 3:39 pm</time></a> </div>
<div class="comment-content">
<p><em>Because CPUs are good at predicting things, so you want randomness to undo the prediction. </em></p>
<p>Though I am sure it happens, I have never seen, in my work, the minimum be an outlier.</p>
<p>If you run something in a loop, and the branch predictor does well in one run, it is likely to do well in other runs.</p>
</div>
<ol class="children">
<li id="comment-650302" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6f7114f33eec890642397f06e8ea12ea?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6f7114f33eec890642397f06e8ea12ea?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.probablydance.com" class="url" rel="ugc external nofollow">Malte Skarupke</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-08T03:35:17+00:00">April 8, 2023 at 3:35 am</time></a> </div>
<div class="comment-content">
<p>I agree that the branch predictor is likely to do well in many runs if it does well in the minimum run. So the minimum won&rsquo;t be an outlier because of the branch predictor.</p>
<p>But I&rsquo;ve had microbenchmarks that run fast, and when I make innocent changes and recompile, they run measurably slower. Why? Because they had randomly gotten a good layout, just like Emery Berger mentions in &ldquo;performance matters&rdquo;. It&rsquo;s not a theoretical concern, it really has happened to me and I have wasted lots of time trying to understand why seemingly similar things have measurable differences.</p>
<p>So at some point I turned on ASLR and changed my benchmarking code to run the executable from scratch for every N iterations of the benchmark. And immediately the differences from before disappeared. The code that I expected to have the same performance actually did have the same performance. But this only works if I use the median measured time. (which I had already done before) If I use the min instead, I&rsquo;d find the one random run where ASLR gives an unusually good layout, and then I&rsquo;d be confused again why two similar things have different performance.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-650227" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b36b481af86f6d34a878f66fb1f569b9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b36b481af86f6d34a878f66fb1f569b9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.mersenne.org/" class="url" rel="ugc external nofollow">Mihai Preda</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-07T06:41:28+00:00">April 7, 2023 at 6:41 am</time></a> </div>
<div class="comment-content">
<p>A distribution that has a similar shape is the Gumbel distribution <a href="https://en.wikipedia.org/wiki/Gumbel_distribution" rel="nofollow ugc">https://en.wikipedia.org/wiki/Gumbel_distribution</a><br/>
which models the distribution of the maximum (or minimum) of a set of samples with some underlying distribution.</p>
<p>IMO this &ldquo;extreme value distribution&rdquo; may naturally arise in some benchmarks &#8212; e.g. when the &ldquo;task&rdquo; that is measured lasts the duration of the longest of a number of subtasks, the duration of the subtasks being randomly distributed [according to some underlying distribution].</p>
<p>Just wandering how you decided it&rsquo;s a lognormal you have vs. a Gumbel, because if it&rsquo;s by eyeing, they both look pretty similar.</p>
</div>
<ol class="children">
<li id="comment-650262" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-07T15:43:14+00:00">April 7, 2023 at 3:43 pm</time></a> </div>
<div class="comment-content">
<p><em>Just wandering how you decided it’s a lognormal</em></p>
<p>My blog post says that in some cases, the log normal is a better model than the normal distribution (at a high level). My argument and methods do not rely on the exact nature of the distribution.</p>
</div>
</li>
</ol>
</li>
<li id="comment-650235" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1fee087d7a1ca17c8ad348271819a8d5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1fee087d7a1ca17c8ad348271819a8d5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Antoine</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-07T08:44:42+00:00">April 7, 2023 at 8:44 am</time></a> </div>
<div class="comment-content">
<p>The slidedeck is very interesting.</p>
<p>Question: your definition of a compute-bound benchmark is that the data fits in CPU cache. When designing a micro-benchmark, would you make a difference between fitting in L3 cache (which is typically shared between cores and may incur additional benchmark noise) and L1/L2 caches? Would you actively try to avoid the L3 (or last-level cache more generally)?</p>
</div>
<ol class="children">
<li id="comment-650260" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-07T15:37:40+00:00">April 7, 2023 at 3:37 pm</time></a> </div>
<div class="comment-content">
<p>It is possible to design a routine that is bound by the speed of the L3 cache, while not memory-bound per se, but I don&rsquo;t expect that to be a common occurence.</p>
</div>
</li>
</ol>
</li>
<li id="comment-650238" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c8f95dc8f67d0d14ece35e2c1137ea8a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c8f95dc8f67d0d14ece35e2c1137ea8a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Lars Clausen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-07T10:00:55+00:00">April 7, 2023 at 10:00 am</time></a> </div>
<div class="comment-content">
<p>Why not use the median?</p>
</div>
</li>
<li id="comment-650421" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ca45063da41a9f3aa9028295d8b66d89?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ca45063da41a9f3aa9028295d8b66d89?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://jnwllm.be/" class="url" rel="ugc external nofollow">Janwillem Swalens</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-09T15:29:22+00:00">April 9, 2023 at 3:29 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve also always learned that &ldquo;the minimum is more sensitive to outliers&rdquo;. However, I suppose there&rsquo;s a difference between a microbenchmark and a larger benchmark: in a microbenchmark there&rsquo;s naturally less variation, so the minimum is more &ldquo;stable&rdquo;, while in a larger benchmark you&rsquo;re less likely to find the true minimum after a limited number of runs.</p>
<p>I&rsquo;d also add that I&rsquo;ve always considered the goal of statistics as a way to reduce many numbers (e.g. 1000s of individual measurements) to a few. However, trying to summarize performance results in just one or two numbers – whether it&rsquo;s the minimum, median, or average &amp; std dev – will always be too simplistic. Especially because distributions are often asymmetric. So an average and standard deviation doesn&rsquo;t tell you much. Therefore I think it&rsquo;s practically a necessity to use something like a box plot (or violin plot). Then you automatically get the minimum, median, etc, and an overview of the underlying distribution, which is much more informative.</p>
</div>
<ol class="children">
<li id="comment-650440" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-09T21:14:45+00:00">April 9, 2023 at 9:14 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>I’ve also always learned that “the minimum is more sensitive to<br/>
outliers”.</p>
</blockquote>
<p>Do you have an example in the context of a benchmark, where you are measuring the running time of a function and the minimum ends up being an outlier in the data?</p>
</div>
<ol class="children">
<li id="comment-654743" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fae1704291b10722d46c592ffed1815a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fae1704291b10722d46c592ffed1815a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://martin.ankerl.com/" class="url" rel="ugc external nofollow">Martin Leitner-Ankerl</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-09-17T08:40:12+00:00">September 17, 2023 at 8:40 am</time></a> </div>
<div class="comment-content">
<p>A simple example would be to benchmark random access in a unordered map. If you are really lucky, the random access will look up consecutive elements (or even the same element)</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
