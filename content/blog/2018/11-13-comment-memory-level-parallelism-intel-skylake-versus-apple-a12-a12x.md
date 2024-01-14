---
date: "2018-11-13 12:00:00"
title: "Memory-level parallelism: Intel Skylake versus Apple A12/A12X"
index: false
---

[21 thoughts on &ldquo;Memory-level parallelism: Intel Skylake versus Apple A12/A12X&rdquo;](/lemire/blog/2018/11-13-memory-level-parallelism-intel-skylake-versus-apple-a12-a12x)

<ol class="comment-list">
<li id="comment-364511" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/05d12e4277599f9b9b9e71c6262d9674?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/05d12e4277599f9b9b9e71c6262d9674?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Victor Stewart</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-13T16:36:57+00:00">November 13, 2018 at 4:36 pm</time></a> </div>
<div class="comment-content">
<p>would it be equivalent to convert these findings to a concept of &ldquo;memory bandwidth&rdquo;?</p>
</div>
<ol class="children">
<li id="comment-364531" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-13T17:45:09+00:00">November 13, 2018 at 5:45 pm</time></a> </div>
<div class="comment-content">
<p>At the margin, we are bound by the available bandwidth.</p>
</div>
<ol class="children">
<li id="comment-364577" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/253139dd9bc1e911c7a0be5415c16378?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/253139dd9bc1e911c7a0be5415c16378?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sagar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-13T20:04:17+00:00">November 13, 2018 at 8:04 pm</time></a> </div>
<div class="comment-content">
<p>That 2x lift between Skylake and the A12 is a little suspicious. Is the benchmark bottlenecked by memory bandwidth? Skylake uses DDR4-2133 when not overclocked, and the A12 seems to be using LPDDR4x (4266?). I&rsquo;m not too familiar with how DDR RAM works, but I think LPDDR4 has a minimum access size of 256 or 512 bits, so bandwidth could become a problem. Based on your numbers, the A12 takes about one second for reading 256 MB with only one lane, and the maximum speedup is 25x. So, the highest transfer rate observed is 6.4 GB/s. That&rsquo;s not too far from the maximum bandwidth especially if 75% of the transferred bits are discarded.</p>
</div>
<ol class="children">
<li id="comment-364598" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6fff5350c6615902c2176ce665453029?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6fff5350c6615902c2176ce665453029?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maynard Handley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-13T21:43:32+00:00">November 13, 2018 at 9:43 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m not sure what you think you are calculating so I can&rsquo;t comment, but Geekbench4 reports the A12&rsquo;s memory bandwidth as either<br/>
&#8211; 14.9 GB/s (copy) or<br/>
-19.1 GB/s (&ldquo;Bandwidth&rdquo;).</p>
<p>(The former uses SYSTEM memcpy() and, more important, operates on a random mix of offsets and sizes that are supposed to match the distribution found across real programs; the latter is a balls-to-the-wall maximum &ldquo;bandwidth&rdquo;, though it&rsquo;s unclear what the precise details are. I&rsquo;m assuming equal reads and writes, with fairly large [multiple MB] between them, so minimal R/W turnaround cost.)</p>
<p>The DRAM used is Micron MT53D512M64D4SB-046.<br/>
The part of that that matters is the initial 53 (meaning Mobile LPDDR4) and the trailing -046 (meaning 2133MHz). (So best currently available LPDDR4, not some exotic Apple-exclusive higher speed.) This has a peak throughput of 17GB/s per 64 bits.</p>
<p>I <em>THINK</em>, but I am not at all sure about this, that Apple runs two memory controllers each controlling an independent 64-bit lane, which gives higher latency to an individual cache-line transfer, but allows more independent pages to be open since the pages on the two DRAM dies don&rsquo;t have to be correlated. And the iPads do the same thing (two memory controllers, but each now control a 128-bit wide lane) so they get much better peak higher bandwidth (~31GB/s for A12X) but not much difference once latency starts dominating your throughput (~18GB/s for GB4&rsquo;s memcpy for A12X).</p>
</div>
</li>
<li id="comment-364630" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-14T01:08:00+00:00">November 14, 2018 at 1:08 am</time></a> </div>
<div class="comment-content">
<p>The minimum access size may indeed be 256 bits (32 bytes) or 512 bits (64 bytes), but this generally doens&rsquo;t matter for software since loads and stores to memory will occur in cache line sized chunks (64 bytes). Things would get weird if one day a memory technology had a minimum access size of more than 64 bytes, but that&rsquo;s not likely for mainstream RAM exactly because of the cache line size.</p>
<p>Anyways, Skylake systems have a bandwidth of 30 to 100 GB/s generally (depending basically on the number of channels), and this test probably only gets to 10 GB/s or so and so I wouldn&rsquo;t expect a bandwidth limitation. Indeed, the performance is &ldquo;exactly as expected&rdquo; for a system with 10 line fill buffers, as is fairly widely documented and the performance counters also back up this measurement.</p>
<p>In this context it is the Apple measurement that is surprising(ly good).</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-364693" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/235b4d98d752081abb501039495a0724?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/235b4d98d752081abb501039495a0724?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bill Broadley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-14T08:45:31+00:00">November 14, 2018 at 8:45 am</time></a> </div>
<div class="comment-content">
<p>Not really. Spinning disks for instance can return 400,000 512 byte sectors a second. But only 100-150 or so if they are random. SSDs on the other hand can often return 50,000 or more random reads.</p>
<p>So random access for IO is often referred to as IOPS, and spinning disks only handle 50-150, but they handle sequential well. Often sequential performance is measured in MB/sec.</p>
<p>Same with memory, but there&rsquo;s numerous issues. Does the memory access pattern fit in L1, L2, or L3 caches? Is it sequential? Random? On a few memory pages, or many?</p>
<p>Additionally on most platforms a single core, or maybe two can saturate the memory system for sequential access. But you need a significant number of independent processes to saturate the memory system with random requests. Usually somewhere around twice as many request streams as the number of memory channels, although that can change significantly platform to platform.</p>
<p>So generally referring to memory latency (accesses per second) is rather over simplified when referred to bandwidth. Bandwidth generally implies sequential access and the difference in parallelism, pattern, and performance can make huge differences in performance. When graphing these results the slowest performance is often in the GB/sec range and the highest end performance in the TB/sec range.</p>
</div>
</li>
</ol>
</li>
<li id="comment-364592" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6fff5350c6615902c2176ce665453029?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6fff5350c6615902c2176ce665453029?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maynard Handley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-13T20:52:08+00:00">November 13, 2018 at 8:52 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;The fact that the A12 has higher timings when using a single lane suggests that its memory subsystem has higher latency than a Skylake-based PC. Why is that?&rdquo;</p>
<p>(a) Apple may be using drowsy caching more aggressively than Intel?</p>
<p>(b) Apple may be using one or more of the various techniques to amplify the coverage of caches, at the cost of some latency. (For example, though Apple may not be doing this [yet?], you can add compression to your LLC to give it effectively about twice the coverage, ~8% average performance boost [best case 20%], ~20% energy reduction, at the cost of ~10 cycles or so in latency.)</p>
</div>
<ol class="children">
<li id="comment-364631" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-14T01:16:14+00:00">November 14, 2018 at 1:16 am</time></a> </div>
<div class="comment-content">
<p>â€œThe fact that the A12 has higher timings when using a single lane suggests that its memory subsystem has higher latency than a Skylake-based PC. Why is that?â€</p>
<p>Because the single lane test is pretty much the <em>definition</em> of memory latency.</p>
<p>Note that &ldquo;memory latency&rdquo; here refers to software-observed memory latency, not any particular thing you might be able to measure at the hardware level. So maybe some component of the memory subsystem has lower latency on the Apple chips, but then something else adds additional latency so that the observed figure is higher, who knows.</p>
<p>This isn&rsquo;t news: most reports have shown the Apple A# chips to have longer latency than contemporary. That&rsquo;s not necessary any kind of flaw, maybe it&rsquo;s part of a smart tradeoff. Note for example that Intel server systems also have much longer latencies than their client systems, despite (and perhaps partly because of) their beefier &ldquo;server class&rdquo; memory subsystems.</p>
</div>
</li>
</ol>
</li>
<li id="comment-364614" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Kurz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-13T22:31:11+00:00">November 13, 2018 at 10:31 pm</time></a> </div>
<div class="comment-content">
<p>In addition to &ldquo;huge pages&rdquo;, another factor that might be artificially limiting the Apple results is register spilling. The current test keeps track of each lane with a regular register, and the Apple processor supports 32 registers. As a result, because some additional registers are needed for testing, the compiled code starts spilling the lane registers to the stack once the number of lanes gets to the mid-twenties. Since this spillage involves extra stores and loads, it&rsquo;s possible that the Apple chips have even more potential for parallelism than the testing so far shows. Does anyone have ideas for how to design a better test that would show this?</p>
</div>
<ol class="children">
<li id="comment-364637" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-14T02:05:02+00:00">November 14, 2018 at 2:05 am</time></a> </div>
<div class="comment-content">
<p>Starting from a simple pointer chasing test, you could design one that accesses N additional regions &ldquo;in lockstep&rdquo; with the original by adding offsets, N1, N2, N3, etc to the original pointer. These offsets can often be added &ldquo;for free&rdquo; in the addressing mode (up to a certain size at least), but even if not you just need to do the addition yourself which needs only a single temporary register for the entire loop.</p>
<p>You want to keep the offsets unequal so they don&rsquo;t trigger prefetching, or at least far enough apart since accesses that are far apart also generally don&rsquo;t trigger prefetching (for example, on Intel, accesses that are more than 2048 bytes apart don&rsquo;t trigger prefetching, since the next access following that pattern would lie in another line anyways).</p>
</div>
</li>
</ol>
</li>
<li id="comment-364629" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/235b4d98d752081abb501039495a0724?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/235b4d98d752081abb501039495a0724?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bill Broadley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-14T01:06:28+00:00">November 14, 2018 at 1:06 am</time></a> </div>
<div class="comment-content">
<p>Cool. I&rsquo;ve been making these measurements on various Intel/AMD platforms for awhile. One thing I wanted to mention was that you have to be careful to ensure that a random walk is a memory latency tester and not a TLB tester. One easy hack is to be very friendly to TLB, but still just as hard on the memory latency is to use a sliding window. I use a knuth shuffle modified to swap members of an array within a user defined range. That way you can tweak the benchmark from use memory latency to pure TLB test, or anywhere in between.</p>
<p>Oh and I also wanted to mention that the parallelism varies in L1, L2, L3, and of course per socket.</p>
</div>
<ol class="children">
<li id="comment-364634" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-14T01:44:57+00:00">November 14, 2018 at 1:44 am</time></a> </div>
<div class="comment-content">
<p><em>One easy hack is to be very friendly to TLB, but still just as hard on the memory latency is to use a sliding window. </em></p>
<p>I&rsquo;d be interested in knowing more.</p>
</div>
<ol class="children">
<li id="comment-364636" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-14T02:00:48+00:00">November 14, 2018 at 2:00 am</time></a> </div>
<div class="comment-content">
<p>Presumably this means do all the accesses randomly, but within a sliding window of say 4 KiB or 16 KiB or whatever, the window sides by a N bytes after you access N bytes. So the number of TLB misses is as low as possible because once a page is brought in, it is used heavily while it is in the sliding window, then never used again.</p>
<p>A related scheme that I use is to do what I usually see call &ldquo;page random&rdquo; which is to randomly access every line within a page (or a range of pages), then move on to the next page. It&rsquo;s the same as the sliding window except that the &ldquo;sliding&rdquo; is not fine-grained but jumps in page-sized quanta.</p>
<p>I thought it was simpler since you just do a &ldquo;normal&rdquo; shuffle on each page, but as Bill points out the existing shuffle algorithm is pretty easy to adopt to a sliding window (perhaps this introduces some kind of light bias near the edges, but this is fine for this purpose).</p>
</div>
<ol class="children">
<li id="comment-365192" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-16T09:02:51+00:00">November 16, 2018 at 9:02 am</time></a> </div>
<div class="comment-content">
<p>Having too small a sliding window may bring up different problems: Intel documentation talks of prefetchers which heuristically fetch adjacent cache line pairs under some circumistances. If the sliding window easily fits in caches and actual memory bus load is too low, this prefetcher may be activated. Also, sufficiently small window and small parallelism will affect the amount of DRAM pages being opened, which can reduce latency of read operations. All this has to be balanced with TLB misses, especially if huge pages can&rsquo;t be employed.</p>
<p>Simply put: getting an unbiased picture of the memory subsystem operation by software benchmarkin is not easy.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-364639" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/235b4d98d752081abb501039495a0724?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/235b4d98d752081abb501039495a0724?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bill Broadley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-14T02:12:45+00:00">November 14, 2018 at 2:12 am</time></a> </div>
<div class="comment-content">
<p>From the wiki page, a Knuth shuffle:</p>
<p>for i from 0 to nâˆ’2 do<br/>
j â† random integer such that i â‰¤ j &lt; n<br/>
exchange a[i] and a[j]</p>
<p>I like that particular method because it guarantees I visit each cache line exactly once. But then I noticed strange behavior, looking at the CPU counters I realized the bottleneck wasn&rsquo;t cache misses, but TLB misses.</p>
<p>TLBs aren&rsquo;t nearly as well documented as caches, unfortunately. So I made a small modification.<br/>
j â† random integer such that i â‰¤ j &lt; 2048</p>
<p>So if I allocate a 1GB each member of the array is visited exactly once. But in the vast majority of cases they will be only on the same few pages. Sure a particularly unlucky item might get bumped ahead by up to 2047 several times, but generally that won&rsquo;t happen often.</p>
<p>Of course you&rsquo;ll likely want to replace by 2048 with a variable so you can control the TLB impact.</p>
<p>Oh, keep in mind that at the very end of the list i+j might be past the end of the array. I&rsquo;d just replace 2048 with min(arraysize-i,2048) or similar.</p>
<p>A few other gotchas:<br/>
* Compilers are (to me surprisingly) good at cheating, I had to add code to randomly check to make sure it was safe to iterate for accurate timings.<br/>
* I tried visiting every cache line exactly once, but noticed anomalous readings. Turns out some platforms with certain settings (sometimes exposed in BIOS) will prefetch the next cacheline. So I visit half the cache lines exactly once.</p>
<p>With the above changes I&rsquo;m getting exactly the numbers I expect. What was surprising to me is that with a 8 memory channel system the ideal parallelism for maximum throughput was 16 or so. In retrospect that makes sense, 8 threads cache miss through L1, L2, and L3. They sit in the memory controller waiting for a memory channel to free. There are small additional benefits up to 24 or so. Presumably because even with 16 threads, not all 8 memory channels are always busy. Occasionally less than 8 channels will be over committed, and 1 or more channels idle.</p>
</div>
<ol class="children">
<li id="comment-364642" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-14T02:20:52+00:00">November 14, 2018 at 2:20 am</time></a> </div>
<div class="comment-content">
<p>What does you access code look like after the shuffle?</p>
<p>Knuth suffle (aka Fisher-Yates) won&rsquo;t guarantee you to visit each line once, unless you use a separate arrays to hold your indexes or something like that (but then you introduce a doubling of memory accesses). Usually you will fall into a short cycle and visit only a faction of the lines.</p>
<p>You probably want Satttolo&rsquo;s algorith, which is conveniently described in the same article. The only difference is to replace <code>i â‰¤ j &lt; n</code> with <code>i &lt; j &lt; n</code> &#8211; but the effect is huge: you are guaranteed the indexes in the array make up a single cycle of the maximum possible length.</p>
</div>
<ol class="children">
<li id="comment-364645" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/235b4d98d752081abb501039495a0724?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/235b4d98d752081abb501039495a0724?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bill Broadley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-14T02:39:07+00:00">November 14, 2018 at 2:39 am</time></a> </div>
<div class="comment-content">
<p>I just use:<br/>
while (p != 0) {<br/>
p = a[p];<br/>
}</p>
<p>Ha, I don&rsquo;t think I read that far, but indeed I stopped at i-1 to avoid problems. Didn&rsquo;t realize that small tweak had a different name, until you mentioned it.</p>
<p>I don&rsquo;t remember exactly the sequence, but I did compare the expected cache and TLB misses and they pretty much matched what I found with my code. That might well have been the reason I stopped at i-1.</p>
</div>
<ol class="children">
<li id="comment-364651" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-14T03:00:31+00:00">November 14, 2018 at 3:00 am</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s not the stopping point you need to adjust but the range you select your random number from.</p>
<p>While considering swapping element i out of a total array of size n, the Fisher-Yates shuffle choose j in the range [i, n-1] (inclusive), while to get Sattolo&rsquo;s algorithm you need to choose in the range [i+1, n-1]. Note the +1.</p>
<p>It&rsquo;s possible you are using Fisher-Yates but &ldquo;get lucky&rdquo; and happen to get a large cycle! It&rsquo;s not that improbable. A simple way to check your code is to start at position 0 and chase until you see 0 again (just like your loop above) and see if it is equal to n.</p>
</div>
<ol class="children">
<li id="comment-364653" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/235b4d98d752081abb501039495a0724?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/235b4d98d752081abb501039495a0724?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bill Broadley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-14T03:04:13+00:00">November 14, 2018 at 3:04 am</time></a> </div>
<div class="comment-content">
<p>Heh, yeah I got it right. I ran it a few 1000 times counting the times through the loop to make sure.</p>
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
<li id="comment-364689" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d5f252f907b95001d7bab577ae1a514c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d5f252f907b95001d7bab577ae1a514c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">XYZ</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-14T08:17:43+00:00">November 14, 2018 at 8:17 am</time></a> </div>
<div class="comment-content">
<p><a href="https://github.com/google/multichase" rel="nofollow ugc">https://github.com/google/multichase</a></p>
</div>
</li>
<li id="comment-364727" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bc4eabb8fd77eb2935e13a2e45ba2425?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bc4eabb8fd77eb2935e13a2e45ba2425?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dragontamer</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-14T11:24:04+00:00">November 14, 2018 at 11:24 am</time></a> </div>
<div class="comment-content">
<p>I wrote an entry on Hacker News highlighting the difference in load/load, store/store, load/store, and store/load memory reordering between ARM and x86. My overall theory is that ARM&rsquo;s weaker memory ordering allows it to better use large buffers.</p>
<p>Intel may take cache misses in an out-of-order manner, but must put all operations back in order before retirement. ARM can stay fully out of order from cache-miss all the way to retirement. This suggests that Intel&rsquo;s buffers are doing more work and are more expensive than ARM&rsquo;s.</p>
</div>
</li>
</ol>
