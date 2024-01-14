---
date: "2018-01-16 12:00:00"
title: "Microbenchmarking calls for idealized conditions"
index: false
---

[8 thoughts on &ldquo;Microbenchmarking calls for idealized conditions&rdquo;](/lemire/blog/2018/01-16-microbenchmarking-calls-for-idealized-conditions)

<ol class="comment-list">
<li id="comment-295373" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-21T19:30:19+00:00">January 21, 2018 at 7:30 pm</time></a> </div>
<div class="comment-content">
<p>Great article.</p>
<p>In large part, the &ldquo;stability&rdquo; of results is only an issue if your test is long enough to experience the various external things that affect the results, such as frequency transitions, interrupts, context switches, another process being scheduled on the sibling hyperthread, etc.</p>
<p>Then the suggestion &ldquo;solution&rdquo; is to run your test so many times that all this noise &ldquo;averages out&rdquo;. Much better is to remove these sources of influence, as much as possible. Very short tests are a start: you run the test enough times so it doesn&rsquo;t (usually) receive any interrupt (and if it does you detect it and throw out the result).</p>
<p>Here are the other things which reduce the noise:</p>
<p>1) Disable hyperthreading: unless you specifically testing how some algorithm works when running on both hypercores, disabling hyperthreading reduced noise by an order of magnitude or more for me (for longer tests): the OS will sometimes schedule something on the sibling thread of the one running the benchmark which will start competing for all sorts of resources.</p>
<p>2) Disable turboboost. This is the biggest one and reduced test noise by two orders of magnitude. CPUs have max turbo ration that depend on the number of cores currently running. This means that any activity of *any* core during your benchmark will suddenly change the speed of your benchmark: both because the frequency changes and because there is a short &ldquo;dead time&rdquo; where all cores stop running entirely while the voltage/current stabilizes across the CPU. This one is really important because the main way that other activity on your system can interfere what what appears to be a &ldquo;core local&rdquo; benchmark.</p>
<p>3) Disable DVFS, aka &ldquo;frequency scaling&rdquo;. Even if TB is off, you&rsquo;ll usually get sub-nominal frequency scaling to save power with the default settings with most OSes and CPU. This one doesn&rsquo;t have the same effect as TB, since there is no cross-core &ldquo;max turbo ratio&rdquo; effect, and in fact you can ignore it with a sufficient long warmup (since the CPU will reach max frequency and stay there), but it removes another variable and avoids the need for a lengthy warmup period. If you ever see a weird peformance graph where the performance of the function seems to steady increase the more you run it it&rsquo;s often frequency scaling messing up the results!</p>
<p>4) Use performance counters with rdpmc instruction to measure true cycles rather than wall time. This has the advantage of mostly being frequency independent, so even if you have some kind of frequency scaling you&rsquo;ll get about the same number. It also lets you record only cycles in user-space if you want, avoiding counting system interrupts (but interrupts still perturb your results in other ways). It let&rsquo;s you get results in cycles directly, rather than trying to convert based on what you guess is the CPU frequency, and avoids the timing routines which may be more complex than necessary and may not be constant time (and the overhead is highly OS dependent). With this approach you can get reproducible results down to a single cycle, without looping your test at all!</p>
<p>5) Various other things to &ldquo;isolate&rdquo; your CPU from the scheduler, such as setting cpu_isols or using realtime priority or tickless kernels. The idea here is to prevent the scheduler from interrupting your process. I did this, but haven&rsquo;t actually found it necessary in practice for most benchmarks since as long as your test is very short the scheduler usually won&rsquo;t interrupt it anyways (e.g., if your scheduler tick frequency is 250Hz, a test that runs for 1 us is almost never interrupted).</p>
<p>6) Use &ldquo;delta&rdquo; measurement. The simple way to do this is if you test has a measurement loop and times the entire loop, run it for N iterations and 2N, and then use (run2 &#8211; run1)/N as the time. This cancels out all the fixed overhead, such as the clock/rdpmc call, the call to your benchmark method, any loop setup overhead. It doesn&rsquo;t cancel out the actual loop overhead though (e.g., increment and end-of-loop check) &#8211; even though that&rsquo;s often small or zero. If you want to do that you need actually two separate loops with different numbers of calls (or inlined copies) of the code under test and apply delta. It&rsquo;s kind of risky to do that due to alignment effects so the loop approach is usually fine.</p>
<p>7) Look at the &ldquo;min&rdquo; and &ldquo;median&rdquo; of repeated results. If you did everything right the min and median will usually be identical (or off by a few parts per million) +/- one cycle sometimes. Or just look at a histogram as Daniel suggests. It&rsquo;s super obvious if your results are stable or not.</p>
<p>I use these approaches in uarch-bench:</p>
<p><a href="https://github.com/travisdowns/uarch-bench" rel="nofollow ugc">https://github.com/travisdowns/uarch-bench</a></p>
<p>which is intended for short, very accurate tests of things that might reveal interesting architectural details (although I haven&rsquo;t added a ton of tests yet) &#8211; but it can also just be used as a micro-benchmark framework to throw random tests into.</p>
</div>
<ol class="children">
<li id="comment-295394" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-22T00:16:12+00:00">January 22, 2018 at 12:16 am</time></a> </div>
<div class="comment-content">
<p>This is brilliant.</p>
</div>
</li>
<li id="comment-295418" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/57c7b4bf7981f7a178efa7af03944014?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/57c7b4bf7981f7a178efa7af03944014?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://tratt.net/laurie/" class="url" rel="ugc external nofollow">Laurence Tratt</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-22T08:53:46+00:00">January 22, 2018 at 8:53 am</time></a> </div>
<div class="comment-content">
<p>Hello Travis,</p>
<p>I agree with most of your suggestions &#8212; indeed Krun does 1&#8211;5 (inclusive). For very small benchmarks, which I think Daniel is also most interested in, I can well believe that this approach does give quite stable numbers. uarch-bench looks very interesting!</p>
<p>That said, we&rsquo;re looking at benchmarks which, whether we want them to be or not, are too big to hope that we can isolate them from things like syscalls. That opens us up to a new world of pain and instability. For example, we can&rsquo;t, in my opinion, use performance counters for two reasons. First, because users don&rsquo;t perceive performance in terms of such counters: they can only perceive wall clock time. Second, because performance counters only measure userspace costs, we might provide a perverse incentive to move benchmark overhead into the kernel by abusing various features.</p>
<p>An open question in my mind is: what all the potential sources of performance non-determinism in a system? I think we have something of a handle on the software sources (though I&rsquo;m sure there are things I haven&rsquo;t thought of), but, beyond a few obvious things (e.g. frequency scaling, caches) I have very little insight as to what performance non-determinism modern processors might introduce.</p>
<p>Laurie</p>
</div>
<ol class="children">
<li id="comment-295439" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-22T16:41:18+00:00">January 22, 2018 at 4:41 pm</time></a> </div>
<div class="comment-content">
<p><em>That said, we&rsquo;re looking at benchmarks which, whether we want them to be or not, are too big to hope that we can isolate them from things like syscalls. That opens us up to a new world of pain and instability. </em></p>
<p>I think we need proper terminology. There are many reasons to &ldquo;benchmark&rdquo; and somehow, we end up with a single word encompassing various different activities. In my view, a microbenchmark is something you design so as to better understand software behavior. A microbenchmark, to me, is a &ldquo;pure&rdquo; and ideal benchmark, with as much of the complexity taken out as possible. If whatever I describe does not sound like a &ldquo;microbenchmark&rdquo; to you, then I am more than willing to use another term.</p>
</div>
<ol class="children">
<li id="comment-295458" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/57c7b4bf7981f7a178efa7af03944014?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/57c7b4bf7981f7a178efa7af03944014?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Laurence Tratt</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-22T21:35:52+00:00">January 22, 2018 at 9:35 pm</time></a> </div>
<div class="comment-content">
<p>Hello Daniel,</p>
<p>Unfortunately microbenchmark is a heavily overloaded term already :/ I once tried to get some colleagues to use &ldquo;picobenchmark&rdquo; for very small benchmarks (i.e. a for loop with one statement inside), but failed. In retrospect, I&rsquo;m not sure that name would have been hugely helpful; but, there again, I still don&rsquo;t have any better ideas&#8230;</p>
<p>Laurie</p>
</div>
</li>
</ol>
</li>
<li id="comment-295507" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-24T00:51:01+00:00">January 24, 2018 at 12:51 am</time></a> </div>
<div class="comment-content">
<p>Yeah, it&rsquo;s horses for courses. Performance counters are a tool for (a) repeatedly measuring performance very exactly and (b) diagnosing performance problems. </p>
<p>The (b) use is the common one: you want to know what your bottlenecks are and performance counters can tell you. I don&rsquo;t think that use is controversial, and it&rsquo;s useful to have them in a benchmarking framework since people tend to stick stuff in there they want to make faster.</p>
<p>I guess we are mostly talking about (a) though. You are right that users don&rsquo;t perceive performance in terms of performance counters, but in terms of wall-clock time. Sometimes, however, you just use performance counters as a high-precision proxy for wall clock time. E.g., when tuning a very small loop you might want to immediately get cycle-accurate feedback on a single change. Doing this will a heavy wall-clock timer might introduce enough noise to make this difficult, but a cycle-accurate performance counter makes this easy.</p>
<p>Of course, you always need to go back and confirm the performance counter was in fact a good proxy for wall-clock time! It would be unfortunately if you were busy optimizing your perf-counter based metric and it turns out wall clock time was going in a different direction. Luckily, metrics like cycles have a direct relationship to wall clock so there aren&rsquo;t many gotchas there.</p>
<p>Note that performance counters measure kernel time just fine (it&rsquo;s configurable: you can measure U only, K only or both). Measuring only user time can be a &ldquo;feature&rdquo; here too: if you know your code is user-only you can remove some noise from interrupts by excluding K time, although getting rid of the interrupts would be even better.</p>
<p>About your last question, there aren&rsquo;t _too_ many sources on non-determinism inside the CPUs themselves: although what you consider inside vs outside is up for debate (e.g., most interrupts are externally generated, but what about SMI?), at least in my experience. Many things are seem non-deterministic only because they are incompletely modeled (e.g., you often seen variance in caching performance from run-to-run, but this can just be caused by the varying virtual-to-phy mapping you get for your pages making L2 caching more or less effective &#8211; deterministic from the CPU point of view, but not from the process running in the OS).</p>
<p>So I think a practical list would probably have things that are truly deterministic, and also ones that may be deterministic if you can put your hardware into an exact initial state and avoid all external perturbation, but since you can&rsquo;t do that, and butterly effect and all that, they end up looking non-deterministic.</p>
<p>In my experience the list above still isn&rsquo;t too bad. The big ones are solved if you have consistent code and data alignment (including physical addresses, not just virtual), avoid hyperthreading and any contention for the core, keep your benchmark core-local, don&rsquo;t experience any throttling conditions, and don&rsquo;t get close to the ragged edge of any uarch resource (e.g., physical regs, ROB entries, LSD size, store buffers, etc, etc). Things then mostly work according to a reasonable model of processor performance.</p>
</div>
</li>
</ol>
</li>
<li id="comment-500680" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/571d37ad1e830b4349f5c2ec7c07d228?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/571d37ad1e830b4349f5c2ec7c07d228?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">LIJUAN PI</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-09T22:48:36+00:00">April 9, 2020 at 10:48 pm</time></a> </div>
<div class="comment-content">
<p>Hi Professor Lemire.</p>
<p>Your benchmarking strategy (6) is very useful. It successfully stabilized my benchmark test results and it is so easy to implement. Thanks for your brilliant idea and posting it online.</p>
</div>
<ol class="children">
<li id="comment-500688" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-10T02:17:52+00:00">April 10, 2020 at 2:17 am</time></a> </div>
<div class="comment-content">
<p>Strategy 6 should be credited to Travis. Thanks for the good words.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
