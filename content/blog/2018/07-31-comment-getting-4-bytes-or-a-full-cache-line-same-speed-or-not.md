---
date: "2018-07-31 12:00:00"
title: "Getting 4 bytes or a full cache line: same speed or not?"
index: false
---

[23 thoughts on &ldquo;Getting 4 bytes or a full cache line: same speed or not?&rdquo;](/lemire/blog/2018/07-31-getting-4-bytes-or-a-full-cache-line-same-speed-or-not)

<ol class="comment-list">
<li id="comment-327450" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dd001572ef01005cf4a27107e971638a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dd001572ef01005cf4a27107e971638a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Andrea</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-01T11:13:36+00:00">August 1, 2018 at 11:13 am</time></a> </div>
<div class="comment-content">
<p>Really interesting, do you have an explanation for why there&rsquo;s so much sensitivity to the &ldquo;percache&rdquo; tunable? I&rsquo;d honestly expect not that much difference in working with 1, 2, or 16 integers in the same cacheline once the cache miss penalty has been paid&#8230;</p>
</div>
</li>
<li id="comment-327638" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/609b16e9fe24dc905fdb9e4f7114197a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/609b16e9fe24dc905fdb9e4f7114197a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Wayne Scott</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-01T14:19:04+00:00">August 1, 2018 at 2:19 pm</time></a> </div>
<div class="comment-content">
<p>So your &ldquo;law&rdquo; is true. Even before your change to make each loop iteration dependant on the previous iteration the latency for each cache line was around 300 cycles. But processors can fetch multiple cache lines in parallel and so an OOO processor is very good at hiding this latency. Basically the same as your conclusion.</p>
</div>
<ol class="children">
<li id="comment-336688" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-10T18:59:29+00:00">August 10, 2018 at 6:59 pm</time></a> </div>
<div class="comment-content">
<p>The law is true, indeed, but it can be misinterpreted.</p>
</div>
</li>
</ol>
</li>
<li id="comment-327640" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-01T14:20:56+00:00">August 1, 2018 at 2:20 pm</time></a> </div>
<div class="comment-content">
<p>It is an understandable architectural optimization that cache line fills can provide data &ldquo;early&rdquo; instead of first reading the whole cache line (although I wonder how this goes with ECC memory). After all, SDRAM bandwidth, measured in whole cache lines, is sufficiently low to make this kind of a latency optimization worthwhile.</p>
<p>Even more interesting (or maybe just more esoteric) experiment would be to look at the effect of read order of the filled cache line. SDRAM burst ordering can bring a specific &ldquo;critical SDRAM word&rdquo; on the front of the read, but may shuffle the rest of the burst in a somewhat unintuitive manner. On top of all this, modern processors may reorder reads, which may improve performance in this scenario, but make it less obvious what is going on.</p>
<p>The clearest scenario is the following: reading bytes sequentially from beginning with a large alignment (such as a cache line boundary) onwards should result a sequential burst ordering, providing data on address-sequential manner. Starting the operation from some other alignment is likely not to do so, and a data-dependent address chaining might expose this fact.</p>
<p>This information may be valuable to an extent when performing multiple, possibly interdepent accesses to a data structure likely not to reside in the cache hierarchy. At least I can fathom some microbenchmarks to expose such implementation details.</p>
</div>
<ol class="children">
<li id="comment-327687" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-01T14:56:43+00:00">August 1, 2018 at 2:56 pm</time></a> </div>
<div class="comment-content">
<p>One such a microbenchmark would be to construct all circular linked lists of eight pointers, eight bytes each (both the native x64 pointer size as well as the most likely SDRAM word size), each list aligned on a cache line. Then simply traverse off-cache linked lists each by eight steps; assembly code couldn&rsquo;t be simpler. I would expect that there are eight time-optimal traversal orders among those 43020 possible (taking the starting offset into account).</p>
</div>
<ol class="children">
<li id="comment-327702" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-01T15:08:46+00:00">August 1, 2018 at 3:08 pm</time></a> </div>
<div class="comment-content">
<p>One more addition: reading just two pointers on such lists would be likely expose most of the oddity involved. Say, lists which have their first read entry on the beginning of the cache line and the second entry on the end of it. It is important to keep these reads dependent; otherwise the DRAM controller might (I don&rsquo;t really know if they do it in reality) be able to find a burst ordering which brings latency of reading all required words down.</p>
</div>
</li>
</ol>
</li>
<li id="comment-328095" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-01T21:05:47+00:00">August 1, 2018 at 9:05 pm</time></a> </div>
<div class="comment-content">
<p>Interesting I hadn&rsquo;t thought of critical word first stuff being a contributor here &#8211; does modern hardware still even use it? I had heard that they don&rsquo;t: the high bandwidth and relatively long latnecy (and the wide busses which means a lot of data arrives at the same time anyways) would make the relative benefit quite small.</p>
<p>It would be an interesting test though. I&rsquo;ll do it soon in uarch-bench.</p>
<p>FWIW my impression of the primary effect here, in the first set of &ldquo;throughput&rdquo; tests, is that the extra work done by the versions with more than one read ends up reducing the memory level parallelism by clogging both the ROB and load buffers with instructions and loads so that after the first miss the CPU can&rsquo;t get far enough ahead to max out MLP.</p>
<p>GCC decided not to inline the test functions, but if you had the inline keyword it does, and the results are a lot closer, especially for 4 and 8, because the loop overhead disappears, cutting down instructions clogging the ROB. The 16 case probably maxes out the load buffers and is still fairly slow.</p>
</div>
<ol class="children">
<li id="comment-328769" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-02T03:13:56+00:00">August 2, 2018 at 3:13 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
Interesting I hadn&rsquo;t thought of critical word first stuff being a contributor here â€“ does modern hardware still even use it? I had heard that they don&rsquo;t
</p></blockquote>
<p>Frankly, I&rsquo;m not certain if they do. It should be checked out by benchmarking, but if any of the effects seen in the tests in this blog post actually result from the latency caused by simple bandwidth bottleneck on the memory bus (there definitely are other plausible explanations on modern hardware), the effect could be sufficient to provide a low-hanging fruit for optimization on purely random dependent reads, such as traversing large graphs or executing DFAs. Unless, of course, critical word ordering has an overhead which makes it impractical to be a benefit these days.</p>
<p>I quickly estimated that performance effect of this could be up to 10-20% (&lt; 8 clock cycles), assuming sequential burst reads and critical word first reads are equal on all other aspects.</p>
<p>My knowledge on the subject is at least a decade old. Carefully constructed benchmarks could smash my assumptions&#8230;</p>
</div>
<ol class="children">
<li id="comment-329090" class="comment even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-02T05:36:31+00:00">August 2, 2018 at 5:36 am</time></a> </div>
<div class="comment-content">
<p>I started writing a test along the lines you suggested, but before I even got to the critical word (from RAM) part, I found another weired effect: when multiple loads hit the same L2 line (after missing in L1) <em>only the first loads gets the &ldquo;expected&rdquo; L2 latency of 12 cycles.</em> The rest of the loads get a significantly longer latency of 19 cycles.</p>
<p>This almost sounds like &ldquo;critical word first&rdquo; at the L2 to L1 level, but I don&rsquo;t think it is: 7 extra cycles makes no sense for a 64-byte bus that should transfer the whole cache line in one shot and that has 64-byte bandwidth, and more importantly the effect occurs even if the other reads are for the exact same location.</p>
<p>More likely what happens is something like an optimized path for waking up the load that triggered the L1 miss and providing it the value directly, while the other loads just get woken up without receiving a value and have to read from L1 (although the difference of 7 cycles is even a bit longer than the usual L1 latency).</p>
<p>I put <a href="https://www.realworldtech.com/forum/?threadid=178902&amp;curpostid=178902" rel="nofollow">more details at RWT</a>.</p>
<p>This effect would also explain some of part of Daniel&rsquo;s results: e.g., part of the final latency test: there would be at least an additional 7 cycles added on (which BTW exactly explains 310 cycles vs 300 for 4 vs 1 adds: 7 cycles extra + 3 cycles of adds).</p>
</div>
<ol class="children">
<li id="comment-329168" class="comment odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-02T06:15:04+00:00">August 2, 2018 at 6:15 am</time></a> </div>
<div class="comment-content">
<p>Uh-oh, that&rsquo;s very curious! I think I have heard of such an effect before, but I can&rsquo;t really get a grasp where or when that would have been.</p>
</div>
</li>
<li id="comment-331310" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-03T04:22:49+00:00">August 3, 2018 at 4:22 am</time></a> </div>
<div class="comment-content">
<p>I think the Intel glitch Travis found on RWT is worth noting in this thread too. Essentially, a trivial linked list sum generated by all mainstream compilers seems to generate code which runs unexpectedly 19 cycles per iteration, when a similar, but more convoluted piece of code does the same at 12 cycles per iteration when data is in L2:</p>
<p><a href="https://www.realworldtech.com/forum/?threadid=178902&amp;curpostid=178969" rel="nofollow">https://www.realworldtech.com/forum/?threadid=178902&#038;curpostid=178969</a></p>
<p>Modern microarchitectures are occasionally strange indeed!</p>
</div>
<ol class="children">
<li id="comment-331322" class="comment odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-03T04:30:47+00:00">August 3, 2018 at 4:30 am</time></a> </div>
<div class="comment-content">
<p>Well, this is was partially a restatement of what Travis described above, but with a concrete, real-world example that probably would surprise many, more than a synthetic and partially a nonsensical benchmark written in assembly.</p>
<p>Also, this must have been the case of &ldquo;an effect&rdquo; I had run into earlier on. Many others must have also run into it&#8230;</p>
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
<li id="comment-328401" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6841b425a579f529babbcae1373b4ad6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6841b425a579f529babbcae1373b4ad6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://const.me" class="url" rel="ugc external nofollow">Konstantin</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-02T00:13:19+00:00">August 2, 2018 at 12:13 am</time></a> </div>
<div class="comment-content">
<p>With MSVC compiler, there&rsquo;s very small difference when testing with 8GB vectors, only 8% between 1 and 16.</p>
<p>I think the problem is GCC optimizer doesn&rsquo;t like that code for some reason.</p>
<p>Here&rsquo;s my version that should be portable across compilers, scalar-only, C++, without assembly, and slightly more optimized: <a href="https://github.com/Const-me/MemoryAccessCosts" rel="nofollow ugc">https://github.com/Const-me/MemoryAccessCosts</a></p>
<p>The results are in result-gcc.txt and result-msvc.txt in that repo. They&rsquo;re from the same PC, I&rsquo;m using gcc 5.4.0 running in WSL in Windows 10.</p>
<p>If you want to build my code, run <code>cmake .</code> then <code>make</code> then <code>./memory-access-demo</code>.</p>
</div>
<ol class="children">
<li id="comment-336687" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-10T18:58:26+00:00">August 10, 2018 at 6:58 pm</time></a> </div>
<div class="comment-content">
<p>Thank you. It appears that MSVC is better at vectorizing this code than GCC. According to your assembly, MSVC relies on SIMD instructions. Note that my post does report what happens if you vectorize: a much smaller difference. The smaller difference is apparently related to the fact that we use far fewer instructions.</p>
</div>
<ol class="children">
<li id="comment-337265" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6841b425a579f529babbcae1373b4ad6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6841b425a579f529babbcae1373b4ad6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://const.me" class="url" rel="ugc external nofollow">Konstantin</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-11T16:51:23+00:00">August 11, 2018 at 4:51 pm</time></a> </div>
<div class="comment-content">
<p>I dunno what&rsquo;s going on.</p>
<p>I&rsquo;d like to point out that even ignoring the caches, RAM delivers 128 bits / transfer on my PC. I have dual-channel DDR3 RAM, each channel delivers 64 bits / transfer. 128 bits is exactly an SSE register.</p>
<p>One possible explanation is Intel optimizes performance of their chips for their own compiler, AFAIK ICC is even better at vectorizing than MSVC. Unfortunately I don&rsquo;t own an ICC to test that. So the performance of scalar RAM loads just wasn&rsquo;t a priority for Intel (just like performance of e.g. x87 floating point math, modern compilers tend to use SSE &amp; SSE2 instead of x87).</p>
<p>Another possible explanation is, it&rsquo;s an unfortunate accident. CPU decodes memory load instruction, issues a load request, decodes another one, discovers it loads from the same line, repeats a few more times, and then hits a hardware limit of in-flight instructions, or in-flight RAM requests, and just stops and waits. Meanwhile with SSE there&rsquo;re fewer instructions and fewer RAM loads, maybe the CPU does deeper pipelining.</p>
<p>Another possible explanation is the prefetcher silicon screwing things up. CPU tries to detect consecutive RAM reads and optimize them by prefetching next memory addresses. Maybe when CPU decoded 16 scalar load instructions reading consecutive addresses the prefetcher kicked in and started prefetching unneeded data, while 4 vector load instructions isn&rsquo;t enough for that.</p>
<p>Optimization is hard. I&rsquo;m not in academia, I&rsquo;m a software developer often working on performance-sensitive code. I&rsquo;ve experienced many weird things, e.g. couple months ago I&rsquo;ve ported my relatively large C++ project from VS2015 to VS2017, and for some functions I saw up to 2x performance degradation, just because the compiler produced slightly different code from the same C++ source. I had to refactor a couple of things to maintain the performance (for that kind of work, a good profiler helps a lot).</p>
</div>
<ol class="children">
<li id="comment-337937" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-13T01:35:33+00:00">August 13, 2018 at 1:35 am</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s not the prefetcher: the results are more or less the same with prefetching turned off.</p>
<p>IMO the parallel results (the first set Daniel presents, with large relative difference) are explained simply by the higher &ldquo;percache&rdquo; runs having less MLP. You can measure this with perf and see the difference: MLP drops as you move to accessing more elements per cache. For example, I get MLP factors of 5.4, 4.0, 2.9, 2.1, for percache of 1, 4, 8, 16, respectively. At least on my machine this largely explains the average performance difference of ~35, ~51, ~69, ~94 cycles per operation (i.e,. the MLP is very nearly proportional to performance).</p>
<p>You can measure this yourself with perf or ocperf with the events l1d_pend_miss_pending and l1d_pend_miss_pending_cycles: dividing the former by the latter gives the observed MLP.</p>
<p>The MLP is lowered with higher percache values because of the extra work done. E.g., percache 16 executes 9 million instructions for my test versus 3 million for percache 1. It works out to about 90 instructions per cache line. Since the ROB (reorder buffer) is only ~200ish instructions, it means you can only fit at most 224 / 90 = 2.5 cache-line misses in the instruction window, compared to 3x that number for the percache 1 case. Note that 2.5 is approximately the observed MLP: in fact, the ROB-based max MLP approximately bounds by above all the observed MLP numbers.</p>
<p>This also explains why vectorization is helpful: not because it is inherently &ldquo;faster&rdquo; (the time to execute the actual sums is fairly small compared to the observed per-line runtime, with or without vectorization) &#8211; but because it uses fewer <em>instructions</em> so the instruction window is much larger. For example, sumrandom in Daniel&rsquo;s code, which is vectorized, only executes ~21 instructions per cache line despite summing the entire line, so the instruction window can fit roughly 10 or 11 lines and the observed MLP is 7.1: much higher than even percache 1.</p>
</div>
<ol class="children">
<li id="comment-405392" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b1b7dc4b18224efab9f7dd744b341a02?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b1b7dc4b18224efab9f7dd744b341a02?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Yongkee</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-06T21:01:27+00:00">May 6, 2019 at 9:01 pm</time></a> </div>
<div class="comment-content">
<p>It appears to be a bit late to add comments here but I would buy this interpretation reasoning about the realized MLP. The only concern is how to measure it precisely.</p>
<p>It seems the way Travis suggsted with ocperf wrapper is a good enough to measure MLP for this problem but I wonder if there is any direct way to measure utilization of (L1) MSHR. I also wonder what if L2 MSHR is taken account. Would it increase or constraint MLP at the core/L1 level or not?</p>
<p>Could you add any comment on these?</p>
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
<li id="comment-332574" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cc43ef934e4a5fb35afc4b64aeb74ee3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cc43ef934e4a5fb35afc4b64aeb74ee3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">alecco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-04T08:33:05+00:00">August 4, 2018 at 8:33 am</time></a> </div>
<div class="comment-content">
<p>Something related and very interesting is the knock-on effect of kicking out data out of the cache. If your data is sparse every time you fetch a cache line and you want significantly less data (e.g. 4 bytes) you are kicking out of cache a previous cache line (e.g. 64 bytes).</p>
<p>For data structures benefiting from caching it&rsquo;s imperative to have the minimum memory access units/nodes be as compact as possible within a cache line. If this is not possible and the effects of caching are negligible, consider using non-temporal memory access so you keep the existing cached data for some other parts of the program.</p>
</div>
<ol class="children">
<li id="comment-332940" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-04T19:27:58+00:00">August 4, 2018 at 7:27 pm</time></a> </div>
<div class="comment-content">
<p>Definitely. This is also one source of the sometimes big gap between microbenchmark and real world results.</p>
<p>Lets say you are tuning some lookup structure using a &ldquo;realistic&rdquo; microbenchmark (i.e., it reproduces the access pattern in your application, perhaps even using a trace of real application accesses). You&rsquo;ll end up with something that balances cache use optimally only with the respect to the microbenchmark: i.e., kicking a line out only penalizes later iterations of the microbennchmark (if at all).</p>
<p>Drop that think into the real application and you&rsquo;re now kicking out lines used by the application code that will run after your lookup, which might have a very different cost than it did in your benchmark. As always, microbenchmarks are useful but have to be used very carefully, especially when comparing implementations with different memory impacts.</p>
</div>
</li>
</ol>
</li>
<li id="comment-332635" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/609b16e9fe24dc905fdb9e4f7114197a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/609b16e9fe24dc905fdb9e4f7114197a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wayne Scott</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-04T10:04:18+00:00">August 4, 2018 at 10:04 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
Something related and very interesting is the knock-on effect of kicking out data out of the cache.
</p></blockquote>
<p>When I was building benchmarks like this you would see this especially when testing array sizes that fit in the L2 cache. If you build a chain of pointers and then start walking the list immediately then all the data in the L2 is modified and then it gets pulled to the L1 cache it stays in the modified state. So then every read would need to do a dirty writeback and evict data from the L1 and put it back in the L2. This is much slower.</p>
<p>So I moved to writing a large junk array of data on the side to flush the cache before starting my measurements. Works much better if my goal is simple cache miss latencies.</p>
<p>before: <a href="https://www.dropbox.com/s/raqv6eubcti0ir3/mem_lat1.jpg?dl=0" rel="nofollow ugc">https://www.dropbox.com/s/raqv6eubcti0ir3/mem_lat1.jpg?dl=0</a><br/>
after: <a href="https://www.dropbox.com/s/t7ebunoxpzzyc18/mem_lat3.jpg?dl=0" rel="nofollow ugc">https://www.dropbox.com/s/t7ebunoxpzzyc18/mem_lat3.jpg?dl=0</a></p>
</div>
<ol class="children">
<li id="comment-333061" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-04T22:44:31+00:00">August 4, 2018 at 10:44 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s interesting: I wouldn&rsquo;t necessary expect that. It would seem that L1 could have its own dirty flag, separate from the L2 MESI state, so it would only be written back if actually changed. It seems you are saying that the line in L1 will inherit the L2&rsquo;s modified state, permanently (until the line is flushed out of L2). Hmm&#8230;</p>
<p>I will check out your code.</p>
</div>
</li>
</ol>
</li>
<li id="comment-340273" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/915d635425bd290ca15a7765a88c8e5f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/915d635425bd290ca15a7765a88c8e5f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.evanjones.ca/" class="url" rel="ugc external nofollow">Evan Jones</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-15T12:05:52+00:00">August 15, 2018 at 12:05 pm</time></a> </div>
<div class="comment-content">
<p>Seems to me this means memory locality matters a lot! Ignoring the SIMD version, my estimate of the actual &ldquo;work&rdquo; performed is:</p>
<p>Integers/line | Cycles/integer | Original cycles/line</p>
<p> 1 | 38 | 38<br/>
4 | 15 | 60<br/>
8 | 8.75 | 70<br/>
16 | 6.875 | 110</p>
<p>That is a 5.5X speed up, just by putting data closer together! I spent more time than I would like during my PhD tweaking an in-memory B-tree, which has similar performance characteristics.</p>
</div>
<ol class="children">
<li id="comment-340862" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-15T23:51:48+00:00">August 15, 2018 at 11:51 pm</time></a> </div>
<div class="comment-content">
<p><em>memory locality matters a lot! </em></p>
<p>Undoubtedly.</p>
</div>
</li>
</ol>
</li>
</ol>
