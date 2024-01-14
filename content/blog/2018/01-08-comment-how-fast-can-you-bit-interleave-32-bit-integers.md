---
date: "2018-01-08 12:00:00"
title: "How fast can you bit-interleave 32-bit integers?"
index: false
---

[20 thoughts on &ldquo;How fast can you bit-interleave 32-bit integers?&rdquo;](/lemire/blog/2018/01-08-how-fast-can-you-bit-interleave-32-bit-integers)

<ol class="comment-list">
<li id="comment-294706" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d46bf32204da4a8edefbeeaee969c794?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d46bf32204da4a8edefbeeaee969c794?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Evan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-09T17:47:39+00:00">January 9, 2018 at 5:47 pm</time></a> </div>
<div class="comment-content">
<p>Your post makes it sound like PDEP and PEXT are available on all AMD64 CPUs, but that&rsquo;s not the case; they&rsquo;re in BMI2, which is an optional extension to AMD64. IIRC they appear in â‰¥ Haswell (2013) on the Intel side, and Excavator (2015) on AMD, so you need a pretty new CPU.</p>
<p>Reading this post, people may think to use the `__amd64` macro (or `_M_AMD64` for VS), but `__BMI2__` is the right one on GCC-like compilers (I don&rsquo;t know that VS has one). Run-time detection is a bit more complicated if you want to do it portably, but if all you care about is GCC 5.1+: `__builtin_cpu_init()` and `__builtin_cpu_supports(&ldquo;bmi2&rdquo;)`.</p>
</div>
<ol class="children">
<li id="comment-294708" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-09T18:04:40+00:00">January 9, 2018 at 6:04 pm</time></a> </div>
<div class="comment-content">
<p>Everything you wrote is correct, I believe.</p>
</div>
</li>
<li id="comment-294717" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kendall Willets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-09T22:02:38+00:00">January 9, 2018 at 10:02 pm</time></a> </div>
<div class="comment-content">
<p>IIRC they&rsquo;re also excruciatingly slow on Ryzen.</p>
</div>
<ol class="children">
<li id="comment-294718" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-09T22:13:08+00:00">January 9, 2018 at 10:13 pm</time></a> </div>
<div class="comment-content">
<p>I see this. 18 cycles of latency?</p>
<p>Probably that AMD has figured out that these instructions only rarely occur in live binaries.</p>
</div>
<ol class="children">
<li id="comment-295321" class="comment even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-20T18:13:05+00:00">January 20, 2018 at 6:13 pm</time></a> </div>
<div class="comment-content">
<p>Yes, I bet it has a microscopic presence in binaries today because (a) it was introduced relatively recently in the BMI2 extension (Haswell) and (b) the operation is pretty obscure: it is very unlikely a compiler would ever generate this instruction when compiling &#8211; use will pretty much be entirely from hand-written asm or intrinsic calls as in your example.</p>
<p>That said, this (and pext) are my two favorite newly introduced scalar instructions: they are very powerful in that they are hard to emulate (that&rsquo;s why it takes 18 cycles!), unlike many of the rest of the BMI instructions, which are often fairly trivial combinations of a few primitive operations (popcnt, lzcnt and tzcnt are the other &ldquo;hard to emulate&rdquo; exceptions, but the latter two are just slight tweaks of the existing bsf and bsr). Once you have them in mind, you find that have a lot of use in various bit-manipulation operations, as you&rsquo;ve found here with interleaving.</p>
<p>AMD is taking a bit of a risk here, IMO &#8211; it is possible that at least some interesting application will make use of these instructions in a critical loop, and the 18x worse performance (throughput) will come back to bite them. I can understand not implementing them though: it requires a novel and still somewhat expensive circuit to implement quickly (see here for example <a href="http://ieeexplore.ieee.org/abstract/document/4019493" rel="nofollow ugc">http://ieeexplore.ieee.org/abstract/document/4019493</a> ). In particular, it won&rsquo;t have much overlap with other ALU circuits. </p>
<p>AMD actually does really well on most of the other interesting BMI instructions: they can do 4 popcnt or lzcnt instructions per cycle, with a latency of 1 cycle, versus Intel&rsquo;s 1 per cycle and 3 cycle latency. This is probably a reflect of the general observation that AMDs ALUs are more homogeneous. </p>
<p>Developers are in a bit of a catch-22 now: should they use pdep/pext at all? At least before Ryzen, no AMD machines supported it, so at least if it was present at all, it was fast. Now you have Ryzen machines with BMI2 which nominally support, but it is terribly slow. Do you now make three code paths, one for non-BMI, one for Intel-BMI (fast pdep) and one for AMD-BMI (slow pdep)? Maybe you just force AMD to always use the slow non-BMI path that you probably already have? Some options have good outcomes, strategically for AMD and some bad. No matter what, I think this will further slow the use of these interesting instructions, which is unfortunate.</p>
</div>
<ol class="children">
<li id="comment-295333" class="comment byuser comment-author-lemire bypostauthor odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-20T22:51:06+00:00">January 20, 2018 at 10:51 pm</time></a> </div>
<div class="comment-content">
<p><em>they can do 4 popcnt or lzcnt instructions per cycle, with a latency of 1 cycle, versus Intel&rsquo;s 1 per cycle and 3 cycle latency</em></p>
<p>That&rsquo;s amazing!</p>
</div>
<ol class="children">
<li id="comment-295370" class="comment even depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-21T18:04:33+00:00">January 21, 2018 at 6:04 pm</time></a> </div>
<div class="comment-content">
<p>Yes, it&rsquo;s quite nice: you usually don&rsquo;t need &ldquo;so much&rdquo; throughput for these options, but sometimes being actually able to count bits very quickly helps.</p>
<p>In general people have noted that the Ryzen execution units are very homogeneous: many or most operations execute on all 4 integer ALUs (exceptions include multiplication, which is expensive in area). On Intel, common operations like add, sub, and bitwise operations execute on all 4 ALUs, but many other operations are restricted to 1 or 2 ALUs. This is probably an effort to optimize chip area. Usually it&rsquo;s not a bottleneck, but it can be.</p>
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
<li id="comment-295319" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-20T17:49:15+00:00">January 20, 2018 at 5:49 pm</time></a> </div>
<div class="comment-content">
<p>When benchmarking very short operations like this, I think it would be good to clarify whether the numbers you report are the operation *latency* (the time a single operation takes from input to output) or something else, like inverse throughput. </p>
<p>I think the lay definition of &ldquo;how long something takes&rdquo; corresponds more to latency, since we usually have a mental model of starting a clock, running an operation, stopping the clock, and observing the elapsed time. It&rsquo;s why we say it takes 9 months to make a baby, even though the &ldquo;throughput&rdquo; is higher if you have multiple expectant mothers, or are having twins (it&rsquo;s still 9 months, not 4.5 months/twin).</p>
<p>When analyzing the raw instructions that make up a function, that distinction is very important: pdep, for example, has a latency of 3 cycles: it takes 3 cycles to complete. However it has an &ldquo;inverse throughput&rdquo; of 1 cycle: you can start a new pdep each cycle and each will complete 3 cycles later, but the total throughput is 1 per cycle. </p>
<p>Your numbers here are &ldquo;inverse throughput&rdquo; &#8211; indeed you can&rsquo;t use pdep to produce a result faster than 3 cycles, so it&rsquo;s not possible you are measuring latency. I&rsquo;m guessing the pdep technique will have a latency of 5 cycles: the critical path flows through whichever pdep instructions starts second (remember, only one starts per cycle), and then the final OR of the results.</p>
<p>So what is actually important, lantency or throughput? Well it depends on the surrounding code, of course! If you&rsquo;re just trying to find the interleaving of a large array of numbers, each operation is independent, and throughput will matter (and the SIMD solutions will make sense). If the operation is part of some critical path (e.g., you use this value to do a lookup in a hash map and then proceed to do further calculations on the result) then latency matters. </p>
<p>Conventionally, compiler and performance analysis people have seemed to think latency is &ldquo;usually&rdquo; the one that matters for general purpose code, based on the observation that most code is bottlenecked on one or more dependency chains rather than by throughput limitations like the processor width or port utilization. Personally, I don&rsquo;t usually make a call either way: it&rsquo;s best to report both numbers and &ldquo;let the user choose&rdquo;. Often the best &ldquo;latency optimized&rdquo; function is different than the best &ldquo;throughput optimized function&rdquo;!</p>
<p>Finally, note that the distinction between latency and (inverse) throughput largely goes away when describing a &ldquo;large&rdquo; function (usually one that has a longish loop inside). As the total latency grows the relative amount of overlap between parallel executions of the function goes to zero and so latency and throughput become the same thing (but conceptually, I think, people are usually reporting &ldquo;latency&rdquo; for such functions: the time one call takes).</p>
</div>
<ol class="children">
<li id="comment-295334" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-20T23:09:02+00:00">January 20, 2018 at 11:09 pm</time></a> </div>
<div class="comment-content">
<p><em>When benchmarking very short operations like this, I think it would be good to clarify whether the numbers you report are the operation *latency* (&#8230;) or something else, like inverse throughput.</em></p>
<p>You are correct, but I think my post did hint that I was measuring throughput (here: &ldquo;Suppose that you have a bunch of data points, is it worth it to use the fancy x64 instructions?&rdquo;). That is, I refer to a batch interleave of many data points.</p>
<p>You can compute the minimal latency from instruction latencies, port availability and data dependencies&#8230; (sadly, it is getting harder to do, not easier) but then the latency won&rsquo;t be the same when the function gets inlined within a tight loop as when it gets called once. And if it is inlined in a tight loop, then you probably don&rsquo;t care about the latency. </p>
<p>So you have to refer to the latency of the function when it gets called once in a blue moon without inlining&#8230; That&rsquo;s clearly dozens of CPU cycles&#8230; I am not sure how to measure it.</p>
</div>
<ol class="children">
<li id="comment-295369" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-21T17:58:58+00:00">January 21, 2018 at 5:58 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t agree about inlining: whether latency matters depends basically entirely on how you are using it (i.e., how the interleaving interacts with the surrounding code).</p>
<p>Even if you are doing it &ldquo;many&rdquo; times, the latency is what matters is there is a critical dependency chain in your code that is the critical path. This is the case *more often than not*, and is the main reason why you&rsquo;ll usually see an IPC of ~1 on most code when the CPU can in principle sustain an IPC of 4.</p>
<p>For example, let&rsquo;s you use the result of the interleave operation to look up in a structure the next value to interleave. In this case each interleave is dependent on the prior (admittedly, I just made this up, but such things are common in practice, even if not with bit-interleaving), so the latency matters. This is all independent of inlining: inlining doesn&rsquo;t break the fundamental data dependency that exists.</p>
<p>In, fact, inlining is totally orthogonal to the latency vs throughput discussion: the CPU has no problem running multiple functions in parallel, even if not inlined, so if you have a fundamentally parallel operation, it will be parallelized even within functions (the mechanics of call/ret do add a serial dependency on the top of the stack though, so if your functions are shorter than about 4 cycles, you&rsquo;ll hit this limit).</p>
<p>We don&rsquo;t even need to be talking about &ldquo;functions&rdquo; &#8211; that&rsquo;s a convenient term, but they can also just be snippets of assembly placed end-to-end in the binary or whatever. Conceptually it&rsquo;s a function f(a, b) -&gt; c, but I don&rsquo;t necessarily mean a &ldquo;call&rdquo; instruction is involved.</p>
<p>The good news though is that it is very easy to measure the latency of an &ldquo;function&rdquo; (or operation) &#8211; use the same framework you used to measure throughput, but ensure the output of one interleave operation is fed into the input(s) of the next. Then you&rsquo;ll get a latency measurement.</p>
<p>This also raises an interesting observation for functions with more than one input: the latency can be different depending on which input(s) the dependency &ldquo;flows&rdquo; through. Here the arguments are symmetric, so the time will be similar, but in some cases some arguments might be part of a longer dependency chain. A reasonable, simple, approach is to make *all* inputs dependent on the output.</p>
</div>
<ol class="children">
<li id="comment-295456" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-22T21:31:22+00:00">January 22, 2018 at 9:31 pm</time></a> </div>
<div class="comment-content">
<p><em>is the main reason why you&rsquo;ll usually see an IPC of ~1 on most code</em></p>
<p>Your statement is likely correct&#8230; but I submit to you that hot code runs at more than 1 instruction per cycle, typically.</p>
<p>So if you take, say, a matrix multiplication routine, then it should run at much more than 1 instruction per cycle.</p>
<p>Often, I get low instruction counts per cycle when there are hard to predict branches&#8230; or cache misses&#8230; </p>
<p>One exception to this is integer division&#8230;</p>
<p><em>The good news though is that it is very easy to measure the latency of an â€œfunctionâ€ (or operation) â€“ use the same framework you used to measure throughput, but ensure the output of one interleave operation is fed into the input(s) of the next. Then you&rsquo;ll get a latency measurement.</em></p>
<p>So you are thinking about a function that is in a critical path, that is, it will receive its data late&#8230; and the processor won&rsquo;t be able to do anything until the function complete its work.</p>
<p>In a lot of work I do, the processor can reorder work around so that this does not happen.</p>
<p>Optimizing compiler can also do crazy things. I am confident that you will agree that the story changes dramatically in the code below when I remove the noinline attribute:</p>
<pre style="color:#000000;background:#ffffff;">__attribute__ <span style="color:#808030; ">(</span><span style="color:#808030; ">(</span>noinline<span style="color:#808030; ">)</span><span style="color:#808030; ">)</span>
uint64_t somefunction<span style="color:#808030; ">(</span>uint64_t a<span style="color:#808030; ">)</span> <span style="color:#800080; ">{</span>
    a <span style="color:#808030; ">/</span><span style="color:#808030; ">=</span> <span style="color:#008c00; ">3</span><span style="color:#800080; ">;</span>
    <span style="color:#800000; font-weight:bold; ">return</span> a<span style="color:#800080; ">;</span>
<span style="color:#800080; ">}</span>

uint64_t somefunctionloop<span style="color:#808030; ">(</span>uint64_t a<span style="color:#808030; ">)</span> <span style="color:#800080; ">{</span>
    uint64_t z <span style="color:#808030; ">=</span> a<span style="color:#800080; ">;</span>
    <span style="color:#800000; font-weight:bold; ">for</span><span style="color:#808030; ">(</span><span style="color:#800000; font-weight:bold; ">int</span> k <span style="color:#808030; ">=</span> <span style="color:#008c00; ">0</span><span style="color:#800080; ">;</span> k <span style="color:#808030; ">&lt;</span> <span style="color:#008c00; ">32</span><span style="color:#800080; ">;</span> k<span style="color:#808030; ">+</span><span style="color:#808030; ">+</span><span style="color:#808030; ">)</span>
      z <span style="color:#808030; ">=</span> somefunction<span style="color:#808030; ">(</span>z<span style="color:#808030; ">)</span><span style="color:#800080; ">;</span>
    <span style="color:#800000; font-weight:bold; ">return</span> z<span style="color:#800080; ">;</span>
<span style="color:#800080; ">}</span>
</pre>
<p>I&rsquo;m interested in continuing this discussion, but I think it would be most interesting with concrete code examples, so that I can better understand what you have in mind.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-295500" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-23T22:51:26+00:00">January 23, 2018 at 10:51 pm</time></a> </div>
<div class="comment-content">
<p>Well when I say &ldquo;most code runs at 1 IPC&rdquo; I mean the &ldquo;when measured, the average IPC over the entire run of many interesting programs tend to hover around 1&rdquo;. So that metric is inherently &ldquo;execution time weighted&rdquo; &#8211; i.e., the numerator is total dynamic instruction count and the denominator is dynamic cycle count. </p>
<p>That inherently already weights the measurement to hot code. I wasn&rsquo;t claiming for example that most functions have an IPC of 1 or that weighted by code size typical IPC is 1 &#8211; that&rsquo;s not interesting as you point out.</p>
<p>I have no doubt matrix multiply has a much higher IPC than 1 &#8211; that&rsquo;s a classic mostly-embarrassingly parallel problem, after all. In practice it pretty much scales directly with FMADD throughput (as long as there are enough registers to hide the latency).</p>
<p>In general, HPC codes probably tend to have high IPC (at least when they aren&rsquo;t bandwidth limited) and also to see a bigger uplift from SIMD.</p>
<p>I&rsquo;m not thinking in terms of functions at all really: functions are a higher-level language concept &#8211; they mostly &ldquo;disappear&rdquo; in the instruction stream seen by the CPU after all &#8211; perhaps there is a trace in terms of a call/ret pair, or a jmp, or nothing at all if inlined, but the CPU doesn&rsquo;t work &ldquo;a function at a time&rdquo; &#8211; it can overlap the work of many functions, and even when one function depends on an earlier one, it could start work on parts of the second function that don&rsquo;t depend on the first.</p>
<p>You are right that the reason for IPC less than &ldquo;max&rdquo; has a lot of possible reasons, such as cache misses and branch mispredicts (there is a great paper that I haven&rsquo;t been able to find again that actually breaks down exactly all the factors that go into less than max IPC for a variety of bottlenecks, using Intel&rsquo;s TopDown methodology IIRC, but I can&rsquo;t find it) &#8211; but some of those are can still be characterized as latency problems! </p>
<p>For example, if your application is heavily impacted by branch mispredicts, a huge lever on the performance will be how fast you can get to the &ldquo;next&rdquo; branch, so that it can be resolved and you can get back on the right path. The penalty for even dense branch mispredicts can be zero if you get to them fast enough and resolve them early such that front-end stays ahead of some backend-limited critical path (this isn&rsquo;t theoretical, you can easily show this in a benchmark).</p>
<p>&#8230;. all that said, yes your example is exactly how you&rsquo;d test the latency of some function. Yes, optimizing compilers can do crazy things, but they won&rsquo;t be able to break *true* data dependencies. Fake benchmarks often have a problem is that they are written in a way that there aren&rsquo;t true dependencies, so optimization may indeed change the nature of the problem. Overall though I think optimization is orthogonal to this discussion.</p>
<p>In the specific example, you gave, I agree that optimization _could_ change the behavior entirely, because a smart optimizer could entirely unroll the loop and inline the call so you end up with z = a / 3 / 3 / 3 / 3 / 3, which in turn is simplified to z = a * 3 * 3 * 3 and in turn to a * 1853020188851841, and indeed clang does more or less that. So the whole complexity of the problem was more or less brought down to zero via mathematical transformation &#8211; but how does that inform the discussion regarding latency and throughput? The example is &ldquo;too fake&rdquo; unfortunately. Another way to look at it is that my claims are based on the final &ldquo;after optimization&rdquo; stage of the compiler&#8230;</p>
<p>I can put some code examples, but how do you format code on this blog?</p>
</div>
<ol class="children">
<li id="comment-295502" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-23T23:11:43+00:00">January 23, 2018 at 11:11 pm</time></a> </div>
<div class="comment-content">
<p><em>The example is too fake unfortunately. * I was teasing you. *I can put some code examples, but how do you format code on this blog?</em> I use <a href="https://tohtml.com" rel="nofollow ugc">tohtml.com</a> myself to convert code to HTML.</p>
</div>
</li>
</ol>
</li>
<li id="comment-295625" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-26T00:23:59+00:00">January 26, 2018 at 12:23 am</time></a> </div>
<div class="comment-content">
<p>I see, HTML is allowed.</p>
<p>Let&rsquo;s take a quick look at very slightly tweaked example, where the compiler can&rsquo;t remove the substance of the benchmark, and compare &ldquo;latency&rdquo; and &ldquo;throughput&rdquo; measuring versions:</p>
<p>static inline uint64_t somefunction(uint64_t a) {<br/>
return 10000 / a;<br/>
}</p>
<p>uint64_t div64_lat(uint64_t iters, void *arg) {<br/>
uint64_t z = (uintptr_t)arg;<br/>
for(uint64_t k = 0; k &lt; iters; k++)<br/>
z = somefunction(z);<br/>
return z;<br/>
}</p>
<p>uint64_t div64_tput_templ(uint64_t iters, void *arg) {<br/>
uint64_t z = 0;<br/>
for(uint64_t k = 0; k &lt; iters; k++)<br/>
z += somefunction(k + 1);<br/>
return z;<br/>
}</p>
<p>The main difference is that somefunction has been flipped so the non-constant is now the denominator. This prevents optimization (in practice, today) because compilers don&rsquo;t perform strength reduction to multiplication when the denominator is variable (and the strength reduction was the starting point for clang to remove the loop entirely). Also, the number of iterations is passed as a parameter, to make it more convenient for me to benchmark.</p>
<p>There are now two variants of the looping function which repeatedly calls somefunction: a &ldquo;lat[enncy]&rdquo; bound version and a &ldquo;t[hrough]put&rdquo; bound version. They are very similar except that the latency version feeds the result from the prior iteration into argument for the next (as in your original example), while the throughput version sums the result from each iteration, but uses the loop counter as input.</p>
<p>At the assembly level they are <i>even more similar</i>! The latency version looks like:</p>
<p>.L4:<br/>
mov rax, r8<br/>
xor edx, edx<br/>
add ecx, 1<br/>
div rdi<br/>
mov rdi, rax<br/>
cmp esi, ecx<br/>
jne .L4</p>
<p>&#8230; while the throughput version is:</p>
<p>.L13:<br/>
mov rax, r8<br/>
xor edx, edx<br/>
div rcx<br/>
add rcx, 1<br/>
add rdi, rax<br/>
cmp rsi, rcx<br/>
jne .L13</p>
<p>The same number of instructions (7), and almost exactly the same number of instructions (the latency version has one mov instead of an add in the throughput version), and the same general structure. Of course, the effect is quite different since the source functions are quite different. The key difference is that the output of the idiv in the latency version feeds back into the input of the next idiv, while in the throughput version it doesn&rsquo;t.</p>
<p>Let&rsquo;s benchmark them, with both an inlined version (as shown above) and a non-inlined version. In the latter case there will be a call instruction in the loop, calling the out-of-line somefunction like this:</p>
<p>&lt;somefunction_noinline(unsigned long)&gt;:<br/>
xor edx,edx<br/>
mov eax,0x2710<br/>
div rdi<br/>
ret </p>
<p>; latency main loop<br/>
mov rdi,rax<br/>
call 88 &lt;somefunction_noinline(unsigned long)&gt;<br/>
add rcx,0x1<br/>
cmp r8,rcx<br/>
jne 80 &lt;div64_lat_noinline(unsigned long, void*)+0x10&gt;</p>
<p>; throughput main loop<br/>
add rcx,0x1<br/>
mov rdi,rcx<br/>
call bc &lt;somefunction_noinline(unsigned long)&gt;<br/>
add rsi,rax<br/>
cmp r8,rcx<br/>
jne b0 &lt;div64_tput_noinline(unsigned long, void*)+0x10&gt;</p>
<p>Again, the complexity is almost the same &#8211; the throughput version suffers in this case a single extra add in the main loop. Both loops call the <i>same</i> function which does the division.</p>
<p>Let&rsquo;s time these 4 variants:</p>
<p>&#8212;<br/>
Benchmark Cycles UOPS_I<br/>
Dependent inline divisions 37.23 41.38<br/>
Dependent 64-bit divisions 37.27 44.38<br/>
Independent inline divisions 25.54 41.38<br/>
Independent divisions 26.39 45.39</p>
<p>First note that the inline or not made almost no difference &#8211; the latency version was virtually identical, and the throughput version was slower by less than a cycle (about 3%). The second column shows the micro-ops executed, and you can see that the no-inline versions executed 3 or 4 more uops compared to the inline ones, about as expected.</p>
<p>The latency version is considerably slower than the throughput version, despite nearly identical instructions, because idiv is partially pipeline: it has a latency larger than the inverse throughput. idiv is actually quite complicated since it broken down into a long stream of micro-ops, so it&rsquo;s hard to analyze exactly, but if you replaced with a single-uop multiply instead, you&rsquo;d expect then a 3-to-1 ratio in the times of the two mechanisms.</p>
<p>This is all down to the CPU executing things in parallel when it can, and also &ldquo;seeing through&rdquo; the function call in the not-inline case: it doesn&rsquo;t have to wait for one function to finish before starting the next (indeed, you might have parts of 10 or more functions all running at once) for certainly types of code.</p>
<p>The tests themselves can be found here:</p>
<p><a href="https://github.com/travisdowns/uarch-bench/commit/69b28c0d2c26ca17b33fa823a48f41b2d672688e#diff-a78c8aeb3e451bfb766f448d0529d873" rel="nofollow ugc">https://github.com/travisdowns/uarch-bench/commit/69b28c0d2c26ca17b33fa823a48f41b2d672688e#diff-a78c8aeb3e451bfb766f448d0529d873</a></p>
<p>A godbolt link to play with:</p>
<p><a href="https://godbolt.org/g/ztqjTM" rel="nofollow ugc">https://godbolt.org/g/ztqjTM</a></p>
</div>
<ol class="children">
<li id="comment-295626" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-26T00:59:06+00:00">January 26, 2018 at 12:59 am</time></a> </div>
<div class="comment-content">
<p>Somehow all my carefully constructed HTML blocks (starting with pre tags), just show up as plain text. Is there an edit function (or a preview function)?</p>
<p>Oddly the first time I submitted I got an internal server error, but I was able to save my work via the back button and post. I&rsquo;m not sure if that was related.</p>
</div>
</li>
<li id="comment-295871" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-30T23:15:45+00:00">January 30, 2018 at 11:15 pm</time></a> </div>
<div class="comment-content">
<p>I think it is a fantastic example.</p>
</div>
</li>
</ol>
</li>
<li id="comment-295706" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-27T21:25:50+00:00">January 27, 2018 at 9:25 pm</time></a> </div>
<div class="comment-content">
<p>test (this can be deleted) </p>
<p> Benchmark Cycles UOPS_I<br/>
Dependent inline divisions 37.23 41.38<br/>
Dependent 64-bit divisions 37.27 44.38<br/>
Independent inline divisions 25.54 41.38<br/>
Independent divisions 26.39 45.39</p>
</div>
</li>
<li id="comment-295710" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-27T21:31:19+00:00">January 27, 2018 at 9:31 pm</time></a> </div>
<div class="comment-content">
<p>It doesn&rsquo;t seem like the blog accepts/processes &lt;pre&gt; tags? tohtml uses them for all of its output, but based on the test they dont&rsquo; work (for me). Feel free to delete the posts above.</p>
</div>
<ol class="children">
<li id="comment-295747" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-28T16:46:27+00:00">January 28, 2018 at 4:46 pm</time></a> </div>
<div class="comment-content">
<p>My blog runs on a stock wordpress engine. You are correct, it seems, that pre tags are not allowed in comments.</p>
<p>I once tried WYSIWYG plugins for the comments, and it ended up being a nightmare because people would complain that it does not work in their browser, and so forth.</p>
<p>I&rsquo;ll try again.</p>
</div>
<ol class="children">
<li id="comment-295749" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-28T17:01:13+00:00">January 28, 2018 at 5:01 pm</time></a> </div>
<div class="comment-content">
<p>So I enabled a <em>MarkDown</em>-based syntax thingy for comments. It seems to support code samples:</p>
<pre><code>for (int i  = 0; i &lt;10; i--) {
  printf("hello");
}
</code></pre>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
