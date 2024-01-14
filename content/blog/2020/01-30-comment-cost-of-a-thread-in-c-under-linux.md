---
date: "2020-01-30 12:00:00"
title: "Cost of a thread in C++ under Linux"
index: false
---

[26 thoughts on &ldquo;Cost of a thread in C++ under Linux&rdquo;](/lemire/blog/2020/01-30-cost-of-a-thread-in-c-under-linux)

<ol class="comment-list">
<li id="comment-488689" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/433c8247303c42b6fe5cef5821f79a5a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/433c8247303c42b6fe5cef5821f79a5a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Sandeep</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-31T14:36:24+00:00">January 31, 2020 at 2:36 pm</time></a> </div>
<div class="comment-content">
<p>I am curious if you are following your practice of significant digits when reporting these numbers? 🙂</p>
<p><a href="https://lemire.me/blog/2012/04/20/computer-scientists-need-to-learn-about-significant-digits/" rel="ugc">https://lemire.me/blog/2012/04/20/computer-scientists-need-to-learn-about-significant-digits/</a></p>
</div>
<ol class="children">
<li id="comment-488724" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-31T16:52:27+00:00">January 31, 2020 at 4:52 pm</time></a> </div>
<div class="comment-content">
<p>I actually do. I use one significant digit.</p>
</div>
<ol class="children">
<li id="comment-493348" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/75699b60f5b187bb81596a4802af98a8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/75699b60f5b187bb81596a4802af98a8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tom</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-01T19:25:36+00:00">March 1, 2020 at 7:25 pm</time></a> </div>
<div class="comment-content">
<p>But you don&rsquo;t use scientific notation, so nobody knows.</p>
</div>
<ol class="children">
<li id="comment-493373" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-01T21:20:47+00:00">March 1, 2020 at 9:20 pm</time></a> </div>
<div class="comment-content">
<p>You do not need to use the scientific notation to express your results using a given number of significant digits. Of course, the scientific notation is more precise in this respect, but it is also less readable.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-488731" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-31T17:25:24+00:00">January 31, 2020 at 5:25 pm</time></a> </div>
<div class="comment-content">
<p>It seems fine.</p>
<p>The reported times are a blink of an eye: a <em>less than 1% of one millisecond</em> in the case of the Intel server. That&rsquo;s a small fraction of almost any total process runtime (i.e., much faster than a &ldquo;hello world&rdquo; process), so when it comes to amortization, I think you&rsquo;ll either have enough work, or it didn&rsquo;t matter anyway.</p>
<p>What would be interesting would be to an evaluation of the fastest <em>amortized</em> methods of using threads. I still don&rsquo;t think functions of ~100 cycles are going to see a benefit, just due to inter-core communication costs, but you can probably squeeze out a benefit at 1,000 cycles.</p>
<p>All this definitely means that extracting performance from threads isn&rsquo;t <em>easy</em> &#8211; it&rsquo;s a hard engineering problem.</p>
</div>
<ol class="children">
<li id="comment-488752" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/433c8247303c42b6fe5cef5821f79a5a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/433c8247303c42b6fe5cef5821f79a5a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sandeep</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-31T18:46:48+00:00">January 31, 2020 at 6:46 pm</time></a> </div>
<div class="comment-content">
<p>We use thread pools at work quite a lot, and it is really difficult to squeeze out full performance via them.</p>
<p>According to Martin Thompson (<a href="https://mechanical-sympathy.blogspot.com/2011/08/inter-thread-latency.html" rel="nofollow ugc">https://mechanical-sympathy.blogspot.com/2011/08/inter-thread-latency.html</a>), his inter core latency is 45ns, however for real physical cores, I have never been able to get below ~75ns on skylake (same numa) which implies a roundtrip time of ~150 (~500-600 cycles). All these are sort of theoretical numbers, so I agree with your assertion that if the task is taking less than &lt; 1000 cycles, you can&rsquo;t squeeze out performance via threading.</p>
</div>
<ol class="children">
<li id="comment-488764" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-31T19:26:07+00:00">January 31, 2020 at 7:26 pm</time></a> </div>
<div class="comment-content">
<p>Yeah I think 1,000 is where it starts to become interesting, since now your inter-core RT times are say single-digit % of the total time, so it starts to seem plausible, but it is a hard problem to exploit it: you have virtually no slack.</p>
<p>Forget even making one kernel call per thread, it has to be zero on average.</p>
</div>
<ol class="children">
<li id="comment-493486" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ee42f9eb0be3e642c4877d0d40003d77?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ee42f9eb0be3e642c4877d0d40003d77?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stephen P. Schaefer</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-02T13:16:49+00:00">March 2, 2020 at 1:16 pm</time></a> </div>
<div class="comment-content">
<p>Why do kernel calls diminish thread benefits? If other threads can can continue to do useful work, what burden does the kernel call in one thread impose on the others?</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-493327" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4404588ef48e6181686902738875a9d7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4404588ef48e6181686902738875a9d7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">John Dubchak</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-01T16:23:15+00:00">March 1, 2020 at 4:23 pm</time></a> </div>
<div class="comment-content">
<p>I like your scale here. It puts it into terms that engineers can start to reason about as they design their applications and think about introducing concurrency primitives.</p>
</div>
</li>
</ol>
</li>
<li id="comment-488822" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5451d93a080c8d280c3f88452c0c0510?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5451d93a080c8d280c3f88452c0c0510?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">JEAN-BAPTISTE</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-31T23:41:57+00:00">January 31, 2020 at 11:41 pm</time></a> </div>
<div class="comment-content">
<p>Wouldn&rsquo;t one plug this cost into the formula to <a href="https://en.wikipedia.org/wiki/Amdahl%27s_law" rel="nofollow ugc">https://en.wikipedia.org/wiki/Amdahl%27s_law</a> to determine when it&rsquo;s worth attempting to use multiple threads ?</p>
</div>
<ol class="children">
<li id="comment-488823" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-31T23:45:49+00:00">January 31, 2020 at 11:45 pm</time></a> </div>
<div class="comment-content">
<p>I think that&rsquo;s different. Here I am measuring overhead&#8230;</p>
<p>If you have a small, embarrassingly parallel problem, Amdahl&rsquo;s law will allow for good results&#8230; but if the problem is too small, you won&rsquo;t get good results.</p>
<p>Suppose you have four independent jobs to do, but it takes you one hour on the phone to hire an intern to do them. You might be better off doing the four tasks yourself.</p>
</div>
<ol class="children">
<li id="comment-489004" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-02-01T19:05:47+00:00">February 1, 2020 at 7:05 pm</time></a> </div>
<div class="comment-content">
<p>I think you can use a variant of Amdahl&rsquo;s law and this is kind of how I think of it.</p>
<p>Essentially, the overhead is like the serial portion in Amdahl&rsquo;s law. So if the overhead is 1000 ns and the work, single threaded is 3000 ns, you use a serial fraction of 0.25. Really, the overhead is <em>not</em> serial, but rather <em>parallel but proportional to the number of threads</em> but that works out to almost the same thing.</p>
<p>One way of thinking about it is that the serial part is the part where the original thread is doing work, and the other threads are suffering their overhead period, after which there is a parallel phase.</p>
<p>This derivation is inexact in the sense that some of the overhead also occurs on the original thread, so the overhead is not really all parallel. I fact, I think this makes it kind of very not-Amdahl if most of the overhead ends up on the original thread, but I&rsquo;m going to submit this comment anyways.</p>
</div>
<ol class="children">
<li id="comment-489026" class="comment even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/feb376c46090e026354af5ea84481d65?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/feb376c46090e026354af5ea84481d65?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">JEAN-BAPTISTE NIVOIT</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-02-01T21:47:44+00:00">February 1, 2020 at 9:47 pm</time></a> </div>
<div class="comment-content">
<p>I like the way you put it.<br/>
To me, the &ldquo;p&rdquo; parameter in Amdahl&rsquo;s law is the &ldquo;total work&rdquo;, and that work is composed of 1/ overhead and 2/ useful work that can be carried out in parallel.<br/>
Furthermore, the overhead has 2 components: one that is spent on the main thread while spawning another thread (or communicating with other threads) and another that is spent on the worker thread before doing useful work and that is just the cost of acquiring the task (for instance it&rsquo;s the cost of dequeueing the task).</p>
<p>I agree with Travis that the cost of spawning threads or communicating with a pool of threads is proportional to the number of workers (i.e. it gets worse when there are more workers).</p>
<p>Another note, just doing &ldquo;counter++&rdquo; causes inter-core traffic and false sharing, so this example might even be susceptible to overhead of the CPU architecture (not even talking about OS or C runtime overhead).</p>
</div>
<ol class="children">
<li id="comment-489333" class="comment byuser comment-author-lemire bypostauthor odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-02-03T15:03:54+00:00">February 3, 2020 at 3:03 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>Another note, just doing “counter++” causes inter-core traffic and false sharing</p>
</blockquote>
<p>I am not sure that there is false sharing. My own definition is of false sharing is when two active threads modify the same cache line, but at different locations in the cache line.</p>
</div>
<ol class="children">
<li id="comment-489337" class="comment even depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5451d93a080c8d280c3f88452c0c0510?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5451d93a080c8d280c3f88452c0c0510?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">JEAN-BAPTISTE NIVOIT</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-02-03T15:31:56+00:00">February 3, 2020 at 3:31 pm</time></a> </div>
<div class="comment-content">
<p>That may be the strict definition of false sharing, but the effects are the same: the cache lines must be synchronized between cores and that makes other cores stall when the variable is modified on one core (marked &ldquo;E&rdquo; in the MESI protocol). This forces local caches to wait and refresh their copy, only to attempt making the line exclusive locally.</p>
</div>
<ol class="children">
<li id="comment-489347" class="comment byuser comment-author-lemire bypostauthor odd alt depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-02-03T17:32:07+00:00">February 3, 2020 at 5:32 pm</time></a> </div>
<div class="comment-content">
<p>I understand and agree with what you write, but coming back to the terminology, why would it be &ldquo;false&rdquo; sharing? My understanding of &ldquo;false sharing&rdquo; is that you may have two threads that appear to work on different data&#8230; and they are&#8230; except that if the cache lines are the same, then it is as if they shared the same data. Hence the qualifier &ldquo;false&rdquo; (they are not really sharing).</p>
<p>BTW I have updated my code with an empty thread benchmark. The empty thread is slightly faster as you would expect.</p>
</div>
<ol class="children">
<li id="comment-489349" class="comment even depth-8 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5451d93a080c8d280c3f88452c0c0510?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5451d93a080c8d280c3f88452c0c0510?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">JEAN-BAPTISTE</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-02-03T17:38:34+00:00">February 3, 2020 at 5:38 pm</time></a> </div>
<div class="comment-content">
<p>You are right, I was abusing the meaning of &ldquo;false sharing&rdquo;. Indeed in the case of this code, the sharing is very much true 🙂<br/>
My sentence was &lsquo;just doing “counter++” causes inter-core traffic and false sharing&rsquo;, so &lsquo;inter-core traffic&rsquo; (a.k.a true sharing) is the concern here, although there could also be false sharing if so other variable colocated with &ldquo;counter&rdquo; happens to be read/written from other threads (not the case in your code).</p>
</div>
<ol class="children">
<li id="comment-489409" class="comment odd alt depth-9">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-02-04T02:48:30+00:00">February 4, 2020 at 2:48 am</time></a> </div>
<div class="comment-content">
<p>I agree, but I guess the effect is probably very small here because Daniel is only creating one thread at a time and this type of inter-core communication is probably on the order of 100 ns, but the tests results are roughly 10,000 ns per thread in the best case.</p>
<p>This kind of stuff becomes much more important once you&rsquo;ve eliminated the overhead of creating and tearing down a thread for each unit of work, and especially once you&rsquo;ve eliminated any kernel calls (at which point the 100 ns matters and may be the dominant factor limiting how much you can do in parallel).</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-488905" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ec8543447c3161a6bf01ca186767cda8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ec8543447c3161a6bf01ca186767cda8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marius Miku?ionis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-02-01T07:17:21+00:00">February 1, 2020 at 7:17 am</time></a> </div>
<div class="comment-content">
<p>I am surprised about such great variability among CPUs with the same kernel, thanks for that. Other OSes would probably be a terrible publicity stunt..</p>
<p>Could you try the following cheat?</p>
<p><code>auto f = std::async(std::launch::deferred, []{counter++;}) ;<br/>
f.get();<br/>
</code></p>
<p>Also, C++ does not have standard thread pools, but the C++17 parallel algorithms have to manage threads automagically somehow. It would be interesting to inspect their overhead. There are several competing implementations though.</p>
</div>
<ol class="children">
<li id="comment-489334" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-02-03T15:18:44+00:00">February 3, 2020 at 3:18 pm</time></a> </div>
<div class="comment-content">
<p>I added async but with std::launch::async. I think that std::launch::deferred is guarantee not to start a new thread so it is not relevant.</p>
</div>
</li>
</ol>
</li>
<li id="comment-489223" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/172e398d1ae16a50b35a1ecd329b7107?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/172e398d1ae16a50b35a1ecd329b7107?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://twitter.com/tech31842" class="url" rel="ugc external nofollow">Jason Bucata</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-02-03T00:42:43+00:00">February 3, 2020 at 12:42 am</time></a> </div>
<div class="comment-content">
<p>I have a recollection from my undergrad years, when I was reading some of the Solaris man pages, that they advised that you shouldn&rsquo;t create a new thread for a task unless that task had a minimum of 1,000 instructions required, otherwise the overhead wasn&rsquo;t worth it.</p>
<p>It&rsquo;s a bit curious that 20+ years later, despite advances in hardware, your own analysis comes to about the same conclusion. Maybe I shouldn&rsquo;t be surprised&#8230; even if the instructions are 10x faster now (say), I suppose the ratios would all stay the same.</p>
</div>
</li>
<li id="comment-493365" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ce5027193e06329ac55e2a4a4aa9b9b0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ce5027193e06329ac55e2a4a4aa9b9b0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Karen T</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-01T20:38:39+00:00">March 1, 2020 at 8:38 pm</time></a> </div>
<div class="comment-content">
<p>Does Rust have more or less overhead than C++ when creating threads?</p>
</div>
</li>
<li id="comment-493457" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cba29917ee6ab434c85c205b4f499224?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cba29917ee6ab434c85c205b4f499224?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Olzvoi</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-02T10:38:16+00:00">March 2, 2020 at 10:38 am</time></a> </div>
<div class="comment-content">
<p>It woud be interesting to compare the energy costs of the three CPUs. ARM is said to be energy efficient, but it took more time for the task.</p>
<p>So, how much energy per task does the CPUs consume?</p>
</div>
</li>
<li id="comment-493540" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3fbbff51744cc77431369651657f4372?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3fbbff51744cc77431369651657f4372?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lucraymond.net" class="url" rel="ugc external nofollow">luc r</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-02T18:42:40+00:00">March 2, 2020 at 6:42 pm</time></a> </div>
<div class="comment-content">
<p>Structuring your code to use thread pools could be helpful in some situations. Same purpose as database connections pool. We know that establish a connection is slow, you need to re-use them instead.</p>
</div>
</li>
<li id="comment-636633" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f113893fa3966c310b78b0b1fe7a1db1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f113893fa3966c310b78b0b1fe7a1db1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tarun Elankath</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-06-17T11:55:27+00:00">June 17, 2022 at 11:55 am</time></a> </div>
<div class="comment-content">
<p>If you are measuring thread overhead creation+termination time, then why are you using a shared counter and incrementing the same ? That will likely consume a large component of your time in a loop.</p>
</div>
<ol class="children">
<li id="comment-636648" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-06-17T13:27:55+00:00">June 17, 2022 at 1:27 pm</time></a> </div>
<div class="comment-content">
<p>Incrementing a counter is a negligible cost.</p>
</div>
</li>
</ol>
</li>
</ol>
