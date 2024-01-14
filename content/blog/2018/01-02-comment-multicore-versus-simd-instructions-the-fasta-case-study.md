---
date: "2018-01-02 12:00:00"
title: "Multicore versus SIMD instructions: the &#8220;fasta&#8221; case study"
index: false
---

[11 thoughts on &ldquo;Multicore versus SIMD instructions: the &#8220;fasta&#8221; case study&rdquo;](/lemire/blog/2018/01-02-multicore-versus-simd-instructions-the-fasta-case-study)

<ol class="comment-list">
<li id="comment-294388" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24f283f61b2d361c1c7bb25597f97d23?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24f283f61b2d361c1c7bb25597f97d23?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Sean O'Connor</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-03T00:04:45+00:00">January 3, 2018 at 12:04 am</time></a> </div>
<div class="comment-content">
<p>I use SIMD a lot in assembly language. If you are doing arithmetic you see a 4 by or 8 by speedup depending on the SIMD slot size. If you have do something no covered by the SIMD instruction set and can&rsquo;t find a bit hack then you are back to 1 by. Also L1, L2 caching issues can limit SIMD when processing large arrays.<br/>
SIMD is very easy to program though compared to GPU multicore.<br/>
I think genuine CPU multicore with say 1000 RISC cores on one chip with good caching and memory behavior would be both relatively easy to program and a lot faster for say AI applications. There were only 56,000 transistors on a Z80 CPU in the 1970&rsquo;s. Actually Intel are killing themselves with super high complexity CPUs that are now full of bugs:<br/>
<a href="https://hothardware.com/news/intel-cpu-bug-kernel-memory-isolation-linux-windows-macos" rel="nofollow ugc">https://hothardware.com/news/intel-cpu-bug-kernel-memory-isolation-linux-windows-macos</a></p>
</div>
<ol class="children">
<li id="comment-294430" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-03T16:00:59+00:00">January 3, 2018 at 4:00 pm</time></a> </div>
<div class="comment-content">
<p>Memory access problems can make all forms of CPU optimizations irrelevant. You have to first keep your processors fed with data before anything else comes into play.</p>
<p>The more cores you add, the more likely that memory access will become an issue.</p>
</div>
</li>
</ol>
</li>
<li id="comment-294414" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">jld</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-03T10:36:58+00:00">January 3, 2018 at 10:36 am</time></a> </div>
<div class="comment-content">
<p>Why are your software samples so Yuuuge for such tiny programs?<br/>
(also wanted to see your Roaring bit maps but deleted it without even unzipping when I saw the size)</p>
</div>
</li>
<li id="comment-294427" class="comment byuser comment-author-lemire bypostauthor odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-03T15:12:57+00:00">January 3, 2018 at 3:12 pm</time></a> </div>
<div class="comment-content">
<p><em>Why are you software samples so Yuuuge for such tiny programs?</em></p>
<p>What is a software sample? If you are alluding to the source code, I wrote very little of it and just modified existing programs. The single-threaded C program is quite short. All these programs are very short thought the multithreaded code takes up more lines.</p>
<p>Myself, I wrote maybe 20 lines of code in preparation for this blog post.</p>
<p>Regarding the size of the Roaring Bitmap code releases&#8230; The Java source code for the Java Roaring Bitmap library is 150 kB. That&rsquo;s a long running piece of software written in a verbose language with lots and lots of features and two dozen contributors from diverse organizations. This source code litterally fits in the cache of one of the cores on your CPU. The average web page is 2.3 MB (<a href="https://www.wired.com/2016/04/average-webpage-now-size-original-doom/" rel="nofollow ugc">https://www.wired.com/2016/04/average-webpage-now-size-original-doom/</a>) so ten times larger.</p>
<p>You can grab the released jars on maven:</p>
<p><a href="http://central.maven.org/maven2/org/roaringbitmap/RoaringBitmap/0.6.66/" rel="nofollow ugc">http://central.maven.org/maven2/org/roaringbitmap/RoaringBitmap/0.6.66/</a></p>
</div>
</li>
<li id="comment-294456" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2a606c837eb20f020aacdbcfa660ea94?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2a606c837eb20f020aacdbcfa660ea94?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Vijayender Joshi</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-04T03:08:59+00:00">January 4, 2018 at 3:08 am</time></a> </div>
<div class="comment-content">
<p>What about readability? </p>
<p>In a lot of settings (corporate) it is more preferable to have readable code over pure performance, that&rsquo;s why we see the trend of threads and goroutines. </p>
<p>I think what would be more appealing is if we could somehow make SIMD stupid simple.</p>
</div>
<ol class="children">
<li id="comment-294457" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-04T03:12:27+00:00">January 4, 2018 at 3:12 am</time></a> </div>
<div class="comment-content">
<p>I agree but I don&rsquo;t think multithreaded programming is stupid simple. It has been made simpler but that&rsquo;s the result of a lot of effort.</p>
</div>
</li>
</ol>
</li>
<li id="comment-294487" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8af88bac916c9bf3f45831c114d30b0e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8af88bac916c9bf3f45831c114d30b0e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://iki.fi/jouni.siren/" class="url" rel="ugc external nofollow">Jouni</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-04T19:28:54+00:00">January 4, 2018 at 7:28 pm</time></a> </div>
<div class="comment-content">
<p>When we run benchmarks, we generally assume that the system is otherwise idle. This may be a reasonable assumption in mobile/client code, but it tends to underestimate the benefits of multithreaded server code.</p>
<p>Most HPC/cloud systems have little free capacity. If you&rsquo;re not using it, you don&rsquo;t want to pay for it. If your code isn&rsquo;t using all CPU cores, some other code probably is. The CPU runs slower than in single-threaded benchmarks, and even single-threaded code is competing with other processes for memory, caches, and memory bandwidth. If 32-threaded code gives you an 18x speedup over single-threaded code in benchmarks, you probably won&rsquo;t get any better performance with 32 independent single-threaded jobs.</p>
<p>Running independent jobs is the easiest way to take advantage of many CPU cores. Unfortunately, at least in bioinformatics, you often run out of memory before you can utilize all CPU cores. Multithreading is the second-best solution. If many jobs share the same read-only data structures, you can often combine them easily into a single job. With well-designed code, it might only require a few OMP statements or similar constructs. On the other hand, SIMD instructions and other low-level improvements can be expensive, as you need to understand the code in order to use them.</p>
</div>
<ol class="children">
<li id="comment-294496" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-04T22:10:04+00:00">January 4, 2018 at 10:10 pm</time></a> </div>
<div class="comment-content">
<p><em> On the other hand, SIMD instructions and other low-level improvements can be expensive, as you need to understand the code in order to use them.</em></p>
<p>Designing algorithms for SIMD is hard. I agree. I am not sure it needs to hard, however.</p>
</div>
</li>
</ol>
</li>
<li id="comment-294625" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4cccdb88eea9d96de6d2180390a266c8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4cccdb88eea9d96de6d2180390a266c8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">mappu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-08T05:17:47+00:00">January 8, 2018 at 5:17 am</time></a> </div>
<div class="comment-content">
<p>&gt;Thus you may be able to complete the processing faster, but it is unclear if, all things said, you are going to use less energy</p>
<p>The AVX2 unit uses a different amount of energy to the ALU, so it&rsquo;s not strictly better either 🙂</p>
<p>For a more extreme example, the new AVX512 instructions can draw so much power that the CPU has to throttle back its frequency to fit within the TDP.</p>
</div>
<ol class="children">
<li id="comment-294654" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-08T16:16:16+00:00">January 8, 2018 at 4:16 pm</time></a> </div>
<div class="comment-content">
<p><em>The AVX2 unit uses a different amount of energy to the ALU, so it&rsquo;s not strictly better either</em></p>
<p>This has been well documented:</p>
<blockquote><p>It is a well known that SIMD computing is energy efficient. Our results show that under the ideal conditions vector instruction can increase performance with only a nominal increase in dynamic energy consumption. (&#8230;) Doubling the SIMD width with AVX instructions doubles performance and only increases total power by 4.3%, which results in a 1.9x improvement in energy efficiency. Similarly, the use of the FMA instructions can double the performance and only increase power by 5.0%, which also nearly doubles energy efficiency. By fully exploiting both the FMA instructions and the wide SIMD width of the AVX instructions, HSW can achieve up to 6.3 GFlops/watt, a 7x improvement over the 0.9 GFlops/watt on PNY. (<a href="https://dl.acm.org/citation.cfm?id=2665743" rel="nofollow">Czechowski et al.</a>)</p></blockquote>
<p><em>For a more extreme example, the new AVX512 instructions can draw so much power that the CPU has to throttle back its frequency to fit within the TDP.</em></p>
<p>Are you aware of a formal study that reviewed the energy usage of AVX-512 code?</p>
</div>
</li>
</ol>
</li>
<li id="comment-316102" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5d491316c434c37966b2619e4f1ef2dd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5d491316c434c37966b2619e4f1ef2dd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Salles</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-10T23:32:37+00:00">July 10, 2018 at 11:32 pm</time></a> </div>
<div class="comment-content">
<p>Another reason parallel programs may not scale so well is because of techniques such as Intel Turbo Boost: the clock of your computer is typically higher if you are using fewer cores.</p>
</div>
</li>
</ol>
