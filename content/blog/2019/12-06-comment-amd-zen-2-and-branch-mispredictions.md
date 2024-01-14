---
date: "2019-12-06 12:00:00"
title: "AMD Zen 2 and branch mispredictions"
index: false
---

[11 thoughts on &ldquo;AMD Zen 2 and branch mispredictions&rdquo;](/lemire/blog/2019/12-06-amd-zen-2-and-branch-mispredictions)

<ol class="comment-list">
<li id="comment-454546" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T21:53:51+00:00">December 6, 2019 at 9:53 pm</time></a> </div>
<div class="comment-content">
<p>Well the rng is in the timed loop as well, so I am not sure you can be certain the difference is solely in the branch prediction part.</p>
<p>The timing looking more or less in line with what I&rsquo;d expect: each branch can&rsquo;t resolve until the rng value is calculated, and there are 3 shifts, 3 xors, and 2 muls in the rng, for a total of 12 cycles of latency, plus the <code>&amp; 1</code> and <code>&amp; 2</code> ops for 2 more cycles, so 14 cycles. The &ldquo;standard&rdquo; BP latency for Intel is usually quoted as 16 cycles, so 14 + 16 = 30, almost exactly in line with your results.</p>
<p>A more precise test would move the rng outside of the timed loop, although the most obvious way to do that (read from an array) means you now how to be careful of caching effects. Another way would be to run the loop w/o mispredicts to see if the (latency limited) baseline is the same.</p>
</div>
<ol class="children">
<li id="comment-454699" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T23:46:52+00:00">December 6, 2019 at 11:46 pm</time></a> </div>
<div class="comment-content">
<p>I agree that my benchmark is not sufficient to support my conclusion but the opposite might be true: the misprediction cost could be worse. </p>
</div>
<ol class="children">
<li id="comment-454796" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-07T00:41:10+00:00">December 7, 2019 at 12:41 am</time></a> </div>
<div class="comment-content">
<p>Indeed, my comment cuts both ways.</p>
<p>Another way to check, would be to vary the mispredict rate from 0% to 100% (100% being what you have now) &#8211; if AMD and Intel times overlap at 0% and then diverge by 2 cycles at 100% you have strong proof.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-454675" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T23:33:28+00:00">December 6, 2019 at 11:33 pm</time></a> </div>
<div class="comment-content">
<p>According to <a href="https://www.7-cpu.com/" rel="nofollow ugc">https://www.7-cpu.com/</a> Skylake mispredict penalty is 16.5 cycles and Zen1 is 19 cycles. Zen2 results aren&rsquo;t there, but it may not have changed from Zen1.</p>
<p>Zen does seem to have a curiously long pipeline &#8211; about as long as the Bulldozer family. I&rsquo;ve heard speculation that the intent was to allow the chip to clock fairly high (but the process didn&rsquo;t allow it).<br/>
Interestingly to note that Icelake increases the mispredict penalty by 1 cycle, so there also may be a trend towards longer pipelines.</p>
</div>
<ol class="children">
<li id="comment-454795" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-07T00:38:29+00:00">December 7, 2019 at 12:38 am</time></a> </div>
<div class="comment-content">
<p>The penalty (apparently) also varies depending on whether the code after the mispredict hits in the uop cache or not. Intuitively this makes sense: if you need to decode the new target, you add all the decode stages to the penalty. I recall, however, that Agner said he couldn&rsquo;t measure a difference.</p>
<p>Those numbers seem fairly consistent with the gap Daniel found.</p>
</div>
<ol class="children">
<li id="comment-456692" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-07T16:41:22+00:00">December 7, 2019 at 4:41 pm</time></a> </div>
<div class="comment-content">
<p>My best guess after hacking a bit more (and adding a few more details) is that Zen 2 has an extra cycle of penalty per mispredicted branch compared with Skylake.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-456740" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6aea6e2f57f2a7b1cd6870375fbdc42f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6aea6e2f57f2a7b1cd6870375fbdc42f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ivan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-07T17:13:11+00:00">December 7, 2019 at 5:13 pm</time></a> </div>
<div class="comment-content">
<p>While correct your post is misleading&#8230;<br/>
Real performance depends on branch prediction cost and the <strong>count</strong> of missed branches.</p>
<p>In your example they are the same for Intel and AMD(since code is totally unpredictable), but in more realistic scenario it is possible that AMD has better branch prediction.</p>
<p>You could benchmark that but it is very tricky to say what is &ldquo;realistic branchy&rdquo; code.</p>
</div>
<ol class="children">
<li id="comment-457008" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-07T19:02:47+00:00">December 7, 2019 at 7:02 pm</time></a> </div>
<div class="comment-content">
<p>Right. So by design, I made the branches unpredictable.</p>
<p>I expect that Zen 2 has better branch prediction.</p>
</div>
</li>
</ol>
</li>
<li id="comment-463598" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e592a80181a9a6ef87677007d3cce48b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e592a80181a9a6ef87677007d3cce48b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Chou Keihou</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-12T13:28:17+00:00">December 12, 2019 at 1:28 pm</time></a> </div>
<div class="comment-content">
<p>Well, some similar analysis has been done on the branch misprediction penalty of zen uarch with bdw and skl. <a href="https://www.evolife.cn/computer/54351.html/6" rel="nofollow ugc">https://www.evolife.cn/computer/54351.html/6</a></p>
<p>&ldquo;Zen&rsquo;s branch prediction penalty is around 17 to 21 cycles, Kaby Lake is 16 to 20 cycles and Broadwell is 15 to 21 cycles. In general, Broadwell&rsquo;s branch penalty is generally lower, about 15 cycles, KabyLake is slightly higher, about 17 cycles, and Zen&rsquo;s predicted penalty value is generally about 19 cycles.<br/>
Through testing, we infer that Zen&rsquo;s pipeline number of bits should be around 19, but due to factors such as µOp-Cache (micro-operation cache), it can be as low as about 17 cycles.&rdquo;</p>
<p>This is not a new thing sence zen(zen2) has got a deeper pipeline and this is <strong>NOT</strong> necessarily relative to IPC (bdw&rsquo;s penalty is lower than skylake and if you are using a 8086 processor the penalty is only 4 cycles).</p>
<p>If you want to take branch misprediction penalty&rsquo;s affect into consideration it will be better to combine it with branch misprediction rate using some real-world workload instead of a random integer where you will get 50% branch misprediction rate.</p>
<p>Also, by saying &ldquo;my good old Intel Skylake (2015) processor&rdquo;, I hope you didn&rsquo;t forget that Intel failed to ship a new architecture for server and desktop platform(where high perf is really in need) in 4 years and the NEW architecture sunny cove(cannonlake is dead, intel even wants everyone to forget about it together with first gen 10nm process) is limited to ultrabook. That&rsquo;s why ZEN2 is on the same stage competing with intel&rsquo;s SKL uarch. And for 2020 intel will ship cometlake(skylake refresh refresh refresh refresh) to survive the year.</p>
</div>
<ol class="children">
<li id="comment-463646" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-12T14:10:31+00:00">December 12, 2019 at 2:10 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for the detailed comment.</p>
<p>I have alluded to Zen 2’s better branch predictor in the past on this blog and I will come back to it.</p>
</div>
</li>
</ol>
</li>
<li id="comment-493335" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/84663519e417a83e0ba5d38c8997586f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/84663519e417a83e0ba5d38c8997586f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Burak</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-01T17:31:22+00:00">March 1, 2020 at 5:31 pm</time></a> </div>
<div class="comment-content">
<p>I am having trouble to understand that when I use specific cpu/pid pinning on <em>linux-perf-events.h</em> I get one cycle less on Zen+,</p>
<p><code> #include &lt;sys/types.h&gt;<br/>
....<br/>
pid_t pid2 = getpid();<br/>
const int cpu = 1; // 0 indexed, second cpu<br/>
....<br/>
fd = syscall(__NR_perf_event_open, &amp;attribs, pid2, cpu, group, flags);<br/>
</code></p>
<p>then running via (taskset on debian):</p>
<p><code>make clean &amp;&amp; make &amp;&amp; taskset 0x2 ./condrng<br/>
</code></p>
<p>gives me:</p>
<p><code>cond 4.56 cycles/value 15.00 instructions/value branch misses/value 0.00<br/>
cond 32.59 cycles/value 19.00 instructions/value branch misses/value 1.00<br/>
</code></p>
<p>But without this pinning I get:</p>
<p><code>cond 4.51 cycles/value 15.00 instructions/value branch misses/value 0.00<br/>
cond 33.90 cycles/value 19.00 instructions/value branch misses/value 1.00<br/>
</code></p>
<p><a href="http://man7.org/linux/man-pages/man2/perf_event_open.2.html" rel="nofollow ugc">Man page</a> (<a href="http://man7.org/linux/man-pages/man2/perf_event_open.2.html" rel="nofollow ugc">http://man7.org/linux/man-pages/man2/perf_event_open.2.html</a>) states that current version in repo seems valid, all I can suspect is that cpu lookup is adding overhead</p>
</div>
</li>
</ol>
