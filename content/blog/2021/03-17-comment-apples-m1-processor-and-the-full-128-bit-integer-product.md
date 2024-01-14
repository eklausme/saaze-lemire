---
date: "2021-03-17 12:00:00"
title: "Apple&#8217;s M1 processor and the full 128-bit integer product"
index: false
---

[17 thoughts on &ldquo;Apple&#8217;s M1 processor and the full 128-bit integer product&rdquo;](/lemire/blog/2021/03-17-apples-m1-processor-and-the-full-128-bit-integer-product)

<ol class="comment-list">
<li id="comment-580029" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/498a47a5dba4347e539ca84572533720?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/498a47a5dba4347e539ca84572533720?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://github.com/linpengcheng" class="url" rel="ugc external nofollow">Lin Pengcheng</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-18T01:06:47+00:00">March 18, 2021 at 1:06 am</time></a> </div>
<div class="comment-content">
<p>Apple M1 chip is a warehouse/workshop model</p>
<p>Copyright © 2018 Lin Pengcheng. All rights reserved.</p>
<p>Introduction</p>
<p>Computer hardware is also a factory that produces data, so it can also apply the &ldquo;warehouse/workshop model&rdquo;, The model uses memory as the core, not the CPU. Finally, we can achieve the grand unification of all IT fields such as hardware, software, Internet, and Internet of Things.</p>
<p>Warehouse: Memory<br/>
Workshop: CPU, graphics card, sound card, etc.<br/>
Standardized data: data transmitted between hardware that conforms to industry standard interfaces<br/>
Acceptance: Motherboard with standardized interfaces such as PCI, SATA, USB, etc.<br/>
External standardized data: hard disk, flash drive, etc.</p>
<p>The out-of-order execution technology of modern CPUs is a mistake (February 16, 2021)</p>
<p>Out-of-order execution is a product of wrong programming methodology, wrong computer architecture and weak compiler conditions.</p>
<p>In the &ldquo;warehouse/workshop model&rdquo;, the workshop is an orderly and high-speed ray (pipeline). The warehouse scheduling function performs dynamic planning and unified scheduling for all workshops and resources, without conflict and competition, and runs in the optimal order and efficiency.</p>
<p>Follower Case</p>
<p>My computer hardware architecture design was published on February 06, 2019. One or two years later, the Apple M1 chip adopted the &ldquo;warehouse/workshop model&rdquo; design and was released on November 11, 2020.</p>
<p>Warehouse: unified memory<br/>
Workshop: CPU, GPU and other cores<br/>
Products (raw materials): information, data</p>
<blockquote><p>
there&rsquo;s also a new unified memory architecture that lets the CPU, GPU, and other cores exchange information between one another, and with unified memory, the CPU and GPU can access memory simultaneously rather than copying data between one area and another. Accessing the same pool of memory without the need for copying speeds up information exchange for faster overall performance. reference: <a href="https://www.macrumors.com/2020/11/30/m1-chip-speed-explanation-developer/" rel="nofollow ugc">Developer Delves Into Reasons Why Apple&rsquo;s M1 Chip is So Fast</a>
</p></blockquote>
<p>From the introduction</p>
<p>Apple M1 has not done global optimization of various core (workshop) scheduling.<br/>
Apple M1 only optimizes the access to memory data (materials and products in the warehouse).<br/>
Apple needs to further improve the programming language and compiler to support and promote my programming methodology.<br/>
My architecture supports a wider range of workshop types than Apple M1, with greater efficiency, scalability and flexibility.</p>
<p>Conclusion</p>
<p>Apple M1 chip still needs a lot of optimization work, now its optimization level is still very simple, after all, it is only the first generation of works, released in stages.</p>
<p>Forecast(2021-01-19): I think Intel, AMD, ARM, supercomputer, etc. will adopt the &ldquo;warehouse/workshop model&rdquo;</p>
<p>In the past, the performance of the CPU played a decisive role in the performance of the computer. There were few CPU cores and the number and types of peripherals. Therefore, the CPU became the center of the computer hardware architecture.</p>
<p>Now, with more and more CPU and GPU cores, and the number and types of peripherals, the communication, coordination, and management of cores (or components, peripherals) have become more and more important, They become a key factor in computer performance.</p>
<p>The core views of management science and computer science are the same: Use all available resources to complete the goal with the highest efficiency. It is the best field of management science to accomplish production goals through communication, coordination, and management of various available resources. The most effective, reliable, and absolutely mainstream way is the &ldquo;warehouse/workshop model&rdquo;.</p>
<p>Only changing the architecture, not changing or only expanding the CPU instruction set, not only will not affect the CPU compatibility, but also bring huge optimization space.</p>
<p>So I think Intel, AMD, ARM, supercomputing, etc. will adopt the &ldquo;warehouse/workshop model&rdquo;, which is an inevitable trend in the development of computer hardware. My unified architecture and programming methodology will be vigorously promoted by these CPU companies, sweeping the world from the bottom up.</p>
<p>Finally, the &ldquo;warehouse/workshop model&rdquo; will surely replace the &ldquo;von Neumann architecture&rdquo; and become the first architecture in the computer field, and it is the first architecture to achieve a unified software and hardware.</p>
<p><a href="https://github.com/linpengcheng/PurefunctionPipelineDataflow" rel="nofollow ugc">link: The Grand Unified Programming Theory: The Pure Function Pipeline Data Flow with principle-based Warehouse/Workshop Model</a></p>
</div>
<ol class="children">
<li id="comment-580226" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/194ef8f807c34a9d7aab0e11a8674768?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/194ef8f807c34a9d7aab0e11a8674768?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Andrew</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-20T05:05:36+00:00">March 20, 2021 at 5:05 am</time></a> </div>
<div class="comment-content">
<p>Did you just post an <em>essay</em> as a comment on someone else&rsquo;s blog?</p>
</div>
</li>
</ol>
</li>
<li id="comment-580044" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maynard Handley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-18T03:14:43+00:00">March 18, 2021 at 3:14 am</time></a> </div>
<div class="comment-content">
<p>For people who are interested in the details: what suggested to me that the pair UMULH+MUL might be fused is the following patent:</p>
<p><a href="https://patents.google.com/patent/US9223577B2/" rel="nofollow ugc">https://patents.google.com/patent/US9223577B2/</a></p>
<p>This patent is interesting because traditional fused instructions were restricted to zero or no output register (think eg the traditional cmp+branch pair, or the ARM crypto fused pairs). The reason for this is that the traditional pipeline has a destination register allocation stage (usually called Rename) which (for various good reasons) is set up to allocate one destination register per instruction.</p>
<p>What the patent describes is a very neat scheme whereby an instruction can be split at decode into multiple sub-instructions that pass through rename separately but then (and this is the novel part) they are recombined for the purposes of scheduling and execution.</p>
<p>This is actually a remarkably nice idea. It allows Apple to treat the common ARM instruction Load Pair as a single unit for most purposes, even though that overwrites two instructions. And it allows various interesting instruction pairs (like UMULH and MUL) to be fused into one operation where that makes sense, even if that combined operation generates two destination registers.</p>
<p>It would be interesting if anyone reading this can think of further instruction pairs that are likely fused.<br/>
Dougall Johnson&rsquo;s initial M1 explorations at</p>
<p><a href="https://dougallj.github.io/applecpu/firestorm.html" rel="nofollow ugc">https://dougallj.github.io/applecpu/firestorm.html</a></p>
<p>lists the known fused instructions (some crypto, and what are essentially compare+branch).<br/>
His list omits</p>
<p>the obvious case of ADR+ADRP (done since the first ARMv8 cores)<br/>
arithmetic followed by a branch (but without setting a flag, eg ADD+CBZ)<br/>
the probable case (but not yet tested) of constructing large immediates via MOV+MOVK</p>
<p>All those are obvious. Not obvious (but the obvious next interesting case to test for the purposes of this blog!) is the reverse of multiplication, namely division.<br/>
The problem is suppose you want to perform both a divide and a remainder, another situation that&rsquo;s generally tricky to handle optimally because once again there are two result registers.<br/>
The ARMv8 solution is a UDIV (to generate the divid result) followed by MSUB (to generate the remainder). This is another obvious fusion candidate if you have the ability for one fused instruction to overwrite two registers.</p>
</div>
</li>
<li id="comment-580057" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/28e3a6e2c8201e531d5ea4ff1a1067f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/28e3a6e2c8201e531d5ea4ff1a1067f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Laurent</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-18T07:51:57+00:00">March 18, 2021 at 7:51 am</time></a> </div>
<div class="comment-content">
<p>Apple M1 has two fully pipelined integer pipes that can do MUL or MULH. This means it can produce one full 64-bit x 64-bit -&gt; 128-bit per cycle. (More information is available on <a href="https://dougallj.github.io/applecpu/firestorm.html" rel="nofollow ugc">Dougall Johnson site</a>.)</p>
<p><a href="https://gmplib.org/devel/asm" rel="nofollow ugc">GMP lib assembly loop results</a> prove how well it does on such code. For instance the multi-precision multiplication loop mul_1 produces 64-bit each cycle, while the fastest x86 chip needs 1.5 cycle.</p>
<p>Of course the number of cycles is not the full story, but that M1 is quite good at crunching integer numbers 🙂</p>
</div>
</li>
<li id="comment-580073" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/97dfebf4098c0f5c16bca61e2b76c373?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/97dfebf4098c0f5c16bca61e2b76c373?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">rando</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-18T12:18:31+00:00">March 18, 2021 at 12:18 pm</time></a> </div>
<div class="comment-content">
<p>Why dont you ever post/look at the generated assembly in such small<br/>
benchmarks? Especially in profiler tools like Intel Vtune and Amd uProf, which would provide instruction level insight on modern CPUs and give potentially true answers to architecture questions. Eg if a bottleneck is the number of ALUs or pipeline width or dependencies , etc.</p>
<p>For example I looked at Lehmers rng in godbold Clang/Gcc and they generate slightly different order of imul/mul/add.</p>
<p>[imul mul add] OR [mul imul add] &#8211; where imul and add have the dependency and are in direct sequence, while imul mul add have 1 instruction between them. Still one cant really tell if that would be helpful on modern out-of-order machines. A profiler would tell.</p>
<p>Are there profiler tools like that for the Apple M1?</p>
<p>I think posting asm/profiles would be more enlightening (and entertaining&#8230;) than just counting the number of potentially expensive instructions. Though more work involved&#8230;</p>
</div>
<ol class="children">
<li id="comment-580091" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-18T14:12:12+00:00">March 18, 2021 at 2:12 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>Why dont you ever post/look at the generated assembly in such small<br/>
benchmarks?</p>
</blockquote>
<p>I recommend using <a href="https://godbolt.org" rel="nofollow ugc">godbolt.org</a>.</p>
<blockquote>
<p>Especially in profiler tools like Intel Vtune and Amd uProf, which<br/>
would provide instruction level insight on modern CPUs and give<br/>
potentially true answers to architecture questions. Eg if a bottleneck<br/>
is the number of ALUs or pipeline width or dependencies , etc.</p>
</blockquote>
<p>I do not expect Intel Vtune and Amd uProf to work on Apple M1 macbooks. One can use Apple&rsquo;s Instruments, however.</p>
</div>
<ol class="children">
<li id="comment-580135" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-19T01:39:58+00:00">March 19, 2021 at 1:39 am</time></a> </div>
<div class="comment-content">
<p>I posted assembly code and I have updated the benchmark with instrumented code which records the cycles and instructions retired.</p>
</div>
</li>
</ol>
</li>
<li id="comment-581227" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c9974cea6136dcc96d4431c22801bd10?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c9974cea6136dcc96d4431c22801bd10?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Eddy Current</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-30T22:55:39+00:00">March 30, 2021 at 10:55 pm</time></a> </div>
<div class="comment-content">
<p>Why don&rsquo;t you post your source code plus the URLs you got from compiler explorer?</p>
</div>
</li>
</ol>
</li>
<li id="comment-580076" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1fee087d7a1ca17c8ad348271819a8d5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1fee087d7a1ca17c8ad348271819a8d5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Antoine</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-18T13:15:28+00:00">March 18, 2021 at 1:15 pm</time></a> </div>
<div class="comment-content">
<p>Or simply, the M1 has enough execution units and reordering capacity to compute two or three 64-bit multiplications at once?</p>
<p>Note that the way wyhash() is implemented, computing the next state is just a trivial addition from the current state, so a modern CPU would be able to overlap several consecutive calls to wyhash(). You don&rsquo;t need a 128-bit multiplier to explain the timings, IMHO (which doesn&rsquo;t mean the 128-bit multiplier doesn&rsquo;t exist, of course :-)).</p>
</div>
<ol class="children">
<li id="comment-580082" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1fee087d7a1ca17c8ad348271819a8d5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1fee087d7a1ca17c8ad348271819a8d5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Antoine</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-18T13:51:58+00:00">March 18, 2021 at 1:51 pm</time></a> </div>
<div class="comment-content">
<p>Uh, by the way, this page (at the time I&rsquo;m writing this) and the RSS feed show different numbers. The RSS feed says 0.30ns vs 0.45ns for wyhash vs splitmix, this page says 0.60ns vs 0.85ns. What are the right values?</p>
</div>
<ol class="children">
<li id="comment-580093" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-18T14:23:16+00:00">March 18, 2021 at 2:23 pm</time></a> </div>
<div class="comment-content">
<p>The blog post was updated because I was dividing by half the number of integers. This is explained in the blog post (see at the bottom).</p>
<p>Both the page and the RSS feed are updated in sync.</p>
</div>
</li>
</ol>
</li>
<li id="comment-580094" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-18T14:25:36+00:00">March 18, 2021 at 2:25 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>Or simply, the M1 has enough execution units and reordering capacity<br/>
to compute two or three 64-bit multiplications at once?</p>
</blockquote>
<p>My tests are not thorough enough to enable me to conclude one way or the other about the underlying technology, so my conclusion is merely stated as &ldquo;Apple Silicon is efficient at computing the full 128-bit product of two 64-bit integers&rdquo;.</p>
</div>
</li>
<li id="comment-580134" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">George Spelvin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-19T01:24:33+00:00">March 19, 2021 at 1:24 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
Note that the way <code>wyhash()</code> is implemented, computing the next state is just a trivial addition from the current state, so a modern CPU would be able to overlap several consecutive calls to <code>wyhash()</code>.
</p></blockquote>
<p>Er, <em>both</em> functions are of this type. <code>splitmix64</code> uses an additive constant of 0x9E3779B97F4A7C15, while <code>wyhash</code> uses an additive constant of 0x60bee2bee120fc15. Thus, there should be enough ILP in either function to saturate the processor&rsquo;s functional units.</p>
<p>64&times;64 multipliers are large and expensive, and integer multiply isn&rsquo;t that common an operation. It&rsquo;s hard to imagine equipping a non-DSP processor with more than one.</p>
</div>
<ol class="children">
<li id="comment-580136" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-19T01:41:47+00:00">March 19, 2021 at 1:41 am</time></a> </div>
<div class="comment-content">
<p>It is correct, both functions can interleave their operations so that the throughput differs from the reciprocal of the latency.</p>
</div>
<ol class="children">
<li id="comment-580137" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-19T01:42:38+00:00">March 19, 2021 at 1:42 am</time></a> </div>
<div class="comment-content">
<p>But it is absolutely true that there is no need for the mul/mulh to be fused, and my blog post does not claim that they are.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-580079" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5775b0c90e7e12eaa31d097dc1f7a1e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cyril</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-18T13:27:36+00:00">March 18, 2021 at 1:27 pm</time></a> </div>
<div class="comment-content">
<p>This is not M1 specific and happened somewhere around Apple A10 SOC. Unfortunately I do not have device with A10 to test but here are results for devices form A9 to A14. And referring to our <a href="https://lemire.me/blog/2019/03/19/the-fastest-conventional-random-number-generator-that-can-pass-big-crush/#comment-396538">discussion</a> it would expect the similar performance results from Cortex A75.</p>
<p><code>A14<br/>
splitmix 0.45 ns/value (5.65 %)<br/>
wyrng 0.3 ns/value (13.9 %) </p>
<p>A13<br/>
splitmix 0.5 ns/value (3.76 %)<br/>
wyrng 0.35 ns/value (11.6 %)</p>
<p>A12X<br/>
splitmix 0.55 ns/value (8.7 %)<br/>
wyrng 0.4 ns/value (3.67 %) </p>
<p>A11<br/>
splitmix 0.6 ns/value (4.24 %)<br/>
wyrng 0.4 ns/value (7.36 %) </p>
<p>A9<br/>
splitmix 1.2 ns/value (29.7 %)<br/>
wyrng 1.5 ns/value (31.1 %)<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-580095" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-18T14:26:54+00:00">March 18, 2021 at 2:26 pm</time></a> </div>
<div class="comment-content">
<p>Yes Cyril, thank you.</p>
</div>
</li>
</ol>
</li>
</ol>
