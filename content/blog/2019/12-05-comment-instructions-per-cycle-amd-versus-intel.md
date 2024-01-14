---
date: "2019-12-05 12:00:00"
title: "Instructions per cycle: AMD Zen 2 versus Intel"
index: false
---

[62 thoughts on &ldquo;Instructions per cycle: AMD Zen 2 versus Intel&rdquo;](/lemire/blog/2019/12-05-instructions-per-cycle-amd-versus-intel)

<ol class="comment-list">
<li id="comment-453598" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1cd46a26ceada395ae900bd4cd40a052?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1cd46a26ceada395ae900bd4cd40a052?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Paul Masurel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-05T04:08:54+00:00">December 5, 2019 at 4:08 am</time></a> </div>
<div class="comment-content">
<p>The last table shows twice the IPC for the Zen 2, which is in contradiction to your conclusion. Did you swap the two value by any chance?</p>
</div>
<ol class="children">
<li id="comment-453670" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a4b27fdf36dd3ffbfe94bcb718d14a51?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a4b27fdf36dd3ffbfe94bcb718d14a51?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Ivan Bobev</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-05T08:49:56+00:00">December 5, 2019 at 8:49 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m wondering about the same thing. 🙂</p>
</div>
</li>
<li id="comment-453705" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-05T12:47:56+00:00">December 5, 2019 at 12:47 pm</time></a> </div>
<div class="comment-content">
<p>Yes, I entered the numbers in reverse, this has been fixed.</p>
</div>
</li>
</ol>
</li>
<li id="comment-453661" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6f1fc39c44d567198c5f7a35d72adfce?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6f1fc39c44d567198c5f7a35d72adfce?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nigel Horspool</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-05T08:12:13+00:00">December 5, 2019 at 8:12 am</time></a> </div>
<div class="comment-content">
<p>What is really making Intel nervous is that at each price point, the AMD processor has many more cores than the corresponding Intel processor AND consumes less power (an important issue for server farms).</p>
</div>
<ol class="children">
<li id="comment-453739" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-05T17:10:22+00:00">December 5, 2019 at 5:10 pm</time></a> </div>
<div class="comment-content">
<p>Nigel: I am quite excited about AMD being back in the race&#8230;</p>
</div>
</li>
</ol>
</li>
<li id="comment-453712" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6e53d27571e5635a6aaf627be49845de?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6e53d27571e5635a6aaf627be49845de?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jens Nurmann</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-05T13:21:10+00:00">December 5, 2019 at 1:21 pm</time></a> </div>
<div class="comment-content">
<p>The second one seems to be a frustrating example of &ldquo;implementational divergence due to instruction set bloat&rdquo; on the AMD side IMHO. Looking up instruction throughput on Zen 2 one finds</p>
<p>bsf / bsr &#8211; 3 / 4 cycles on r64<br/>
tzcnt / lzcnt &#8211; 0.5 / 1 cycles on r64</p>
<p>I&rsquo;d assume that the compiler generates bsf in your benchmark &#8211; if it is the one you presented some time ago. So I am surprised that this is &ldquo;only&rdquo; 1/2 of Intel IPC for AMD in this case. Replacing bsf with tzcnt might reverse the situation.</p>
</div>
<ol class="children">
<li id="comment-453731" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-05T16:31:45+00:00">December 5, 2019 at 4:31 pm</time></a> </div>
<div class="comment-content">
<p>I have added my code to the blog post so that it is clearer, I specifically request tzcnt.</p>
<p>So, I don&rsquo;t think that&rsquo;s the issue.</p>
</div>
<ol class="children">
<li id="comment-453734" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6e53d27571e5635a6aaf627be49845de?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6e53d27571e5635a6aaf627be49845de?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jens Nurmann</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-05T16:51:40+00:00">December 5, 2019 at 4:51 pm</time></a> </div>
<div class="comment-content">
<p>Now I am surprised &#8211; most vexing. I&rsquo;ll try to take a closer look at that.</p>
</div>
</li>
</ol>
</li>
<li id="comment-453932" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T14:31:27+00:00">December 6, 2019 at 2:31 pm</time></a> </div>
<div class="comment-content">
<p>I checked the assembly and tzcnt is generated.</p>
</div>
<ol class="children">
<li id="comment-453945" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T14:39:39+00:00">December 6, 2019 at 2:39 pm</time></a> </div>
<div class="comment-content">
<p>Thanks Travis.</p>
<p>I don’t know why Zen 2 is inferior on this test but it is no conspiracy on my part. It is not doing well.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-453723" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b24655febc3b802edc94d30088797d25?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b24655febc3b802edc94d30088797d25?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jeremiah Hoyet</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-05T15:15:21+00:00">December 5, 2019 at 3:15 pm</time></a> </div>
<div class="comment-content">
<p>What model CPUs did you use for your comparison? Cache levels, clock speed, and many other factors play into CPU performance.</p>
</div>
<ol class="children">
<li id="comment-453728" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-05T16:15:18+00:00">December 5, 2019 at 4:15 pm</time></a> </div>
<div class="comment-content">
<p>Clock speed is not very relevant because these numbers are per-cycle. Cache is not also very relevant since these are not memory bound benchmarks.</p>
</div>
</li>
</ol>
</li>
<li id="comment-453740" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3f1845d9e53d284f03690bca810fb4c0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3f1845d9e53d284f03690bca810fb4c0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Benjamin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-05T17:16:16+00:00">December 5, 2019 at 5:16 pm</time></a> </div>
<div class="comment-content">
<p>Couple of open questions:<br/>
&#8211; were the Spectre and following mitigations applied on both rigs? That can go a long way explaining differences in the ~10/15% range, but not a x2 factor of course</p>
<p><em>if the build is CPU specific</em>, counting instructions seems like a weird way to measure performance, since as you mentioned some instructions are a lot wider than others. By this metric an AVX512 build of a given benchmark could give pretty bad results when compared to an SSE build (which is not true with any metric which actually counts in that case, like throughput or perf/watt)<br/>
<em>if the build is not CPU specific</em>, counting instruction throughput is only interesting if this is a close enough optimal build for both, IMO. One could imagine a CPU which is very good at extracting ILP from low performance builds, which would be a nice skill but could be useless in an HPC context for instance.</p>
<p>you keep mentioning an &ldquo;old Intel CPU&rdquo;, but skylake is basically the only available architecture for anything but some thin laptops. So it&rsquo;s both &ldquo;old&rdquo; and &ldquo;current&rdquo;, which contributes to making AMD competitive</p>
<p>this being said I agree with your initial point that &ldquo;better IPC&rdquo; claims are not really qualified. I guess that the implicit meaning is &ldquo;getting more work done per clock cycle&rdquo;.</p>
</div>
<ol class="children">
<li id="comment-453742" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3f1845d9e53d284f03690bca810fb4c0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3f1845d9e53d284f03690bca810fb4c0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Benjamin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-05T17:19:36+00:00">December 5, 2019 at 5:19 pm</time></a> </div>
<div class="comment-content">
<p>another point is that you discard benchmarks which are memory bound, but that goes against some other tests that you did concerning memory requests parallelism for instance. Extracting good IPC <em>in memory starved contexts</em> is also meaningful, right ?</p>
</div>
<ol class="children">
<li id="comment-453745" class="comment byuser comment-author-lemire bypostauthor even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-05T17:32:53+00:00">December 5, 2019 at 5:32 pm</time></a> </div>
<div class="comment-content">
<p>In memory starved contexts, the number of instructions being retired is probably not the measure you care about. Instead, you might want to report the effective bandwidth or something that has to do with the actual bottleneck.</p>
</div>
<ol class="children">
<li id="comment-453760" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3f1845d9e53d284f03690bca810fb4c0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3f1845d9e53d284f03690bca810fb4c0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Benjamin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-05T19:06:36+00:00">December 5, 2019 at 7:06 pm</time></a> </div>
<div class="comment-content">
<p>I disagree on that, it is my understanding that the IPC that manage to go through would be a good proxy for job being done, despite the bottleneck. This whole &ldquo;job being done&rdquo; is I think the logic behind most of the &ldquo;IPC&rdquo; claims around</p>
</div>
<ol class="children">
<li id="comment-453762" class="comment byuser comment-author-lemire bypostauthor even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-05T19:37:07+00:00">December 5, 2019 at 7:37 pm</time></a> </div>
<div class="comment-content">
<p>We can reason about IPC for instruction-dense code. We know what 4.0 instructions per cycle means: it is great. For instruction-dense code, 1.0 is going to be mediocre. Basically, we have a measure of how superscalar (wide) the processor is. Achieving 6 instructions per cycle in real code would be fantastic.</p>
<p>For memory-bound problems, what would be a good IPC?&#8230; is 0.1 instructions per cycle good or bad? I can&rsquo;t reason about it. I have some idea of what a bandwidth of 10 GB/s in random access means (it is very good).</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-453747" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-05T17:38:43+00:00">December 5, 2019 at 5:38 pm</time></a> </div>
<div class="comment-content">
<p>In the simdjson benchmarks above, the builds are not CPU specific. All CPUs run almost entirely the same instructions. So yes, the number of instructions retired per cycle follows closely the performance per cycle. On a per-cycle basis, in this AVX2-intensive benchmark, AMD comes down under Intel in every way.</p>
<blockquote>
<p>you keep mentioning an “old Intel CPU”, but skylake is basically the<br/>
only available architecture for anything but some thin laptops. So<br/>
it’s both “old” and “current”, which contributes to making AMD<br/>
competitive</p>
</blockquote>
<p>That is true.</p>
</div>
<ol class="children">
<li id="comment-453761" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3f1845d9e53d284f03690bca810fb4c0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3f1845d9e53d284f03690bca810fb4c0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Benjamin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-05T19:17:04+00:00">December 5, 2019 at 7:17 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>In the simdjson benchmarks above, the builds are not CPU specific. All CPUs run almost entirely the same instructions. So yes, the number of instructions retired per cycle follows closely the performance per cycle. Changing the builds (for instance -O3 vs vanilla) would change the instruction mix and throughput, all other things (task and hardware) being equal. So the correct quote is &ldquo;for a given build, the number of instructions retired per cycle follows closely the performance per cycle.&rdquo;, which may or may not be a good proxy for absolute performance (see AVX512 for instance)</p>
</blockquote>
</div>
<ol class="children">
<li id="comment-453771" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-05T22:12:22+00:00">December 5, 2019 at 10:12 pm</time></a> </div>
<div class="comment-content">
<p>True. There is just one x64 build here, same binary throughout.</p>
</div>
</li>
<li id="comment-583647" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/80c9c22a7db6845697c69de3079cb4ef?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/80c9c22a7db6845697c69de3079cb4ef?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">RGRHON</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-09T07:19:01+00:00">May 9, 2021 at 7:19 am</time></a> </div>
<div class="comment-content">
<p>I’m just a lowly programmer, but the speed of a single gcc compile seems irrelevant to me. Both processors perform small tasks it in the blink of an eye, so if that blink is 10ms or 12ms isn’t usually very significant to me. Small compiles are pretty equivalent in terms of time required for gcc, and trying to extrapolate those small compile results on a single core to a large number of cores is missing the point. What is relevant is if you use a parallel make (make -j) with a large number of source files and cores like 24, 32, or 64, the AMD processor will usually beat the pants off a processor with a lower number of cores. Same with rendering and many other long tasks. That’s significant to me in my wall-clock development time. Sure, sometimes the AMD may be a bit slower on small tasks, but small tasks don’t take long, so a single TR core is usually only fractionally slower and works fine for small tasks anyway. TR is fast enough to game on my PC with maximum settings on almost every title at 1440p and above. Not that I game much, but it’s fine. Same for analytical graphics, they just don’t take that long on today’s 3000 Nvidia GPU’s. I’ll admit that there are some tasks where bleeding edge core speed is important, but Ive noticed I don’t do those things TA’s often as I compile, for example.</p>
</div>
</li>
</ol>
</li>
<li id="comment-453796" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T02:12:50+00:00">December 6, 2019 at 2:12 am</time></a> </div>
<div class="comment-content">
<p>Keep in mind that this project (SIMDjson) was extensively tuned on Intel and machines and then just incidentally run on AMD as a comparison. Many choices made based on benchmark results might have gone a different way on the AMD machine, so the Intel specific quirks get built in this way.</p>
<p>I&rsquo;m not saying it would reverse the conclusion in this case, but it&rsquo;s something to remember when testing something that has been carefully tuned.</p>
</div>
<ol class="children">
<li id="comment-454056" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T15:56:27+00:00">December 6, 2019 at 3:56 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>Keep in mind that this project (SIMDjson) was extensively tuned on Intel and machines and then just incidentally run on AMD as a comparison.</p>
</blockquote>
<p>That&rsquo;s true, so it is a bias but I submit to you that the same bias exists on highly tuned software out there.</p>
<p>Furthermore, when people say that AMD Zen 2 has superior IPC, they rarely qualify this statement by saying that it requires tuning or recompiling the software. If that&rsquo;s a requirement, it should be stated.</p>
</div>
<ol class="children">
<li id="comment-454233" class="comment odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T18:31:30+00:00">December 6, 2019 at 6:31 pm</time></a> </div>
<div class="comment-content">
<p>Agreed, it is a bias that applies to other software, although I suspect SIMDJson is more highly tuned than the average, so I suggest it applies more in this case.</p>
<p>I don&rsquo;t know about higher IPC, but when <em>I</em> say something like &ldquo;Zen 2 has comparable IPC to Skylake&rdquo; I don&rsquo;t mean after recompiling. I just draw that conclusion from broad-based tests performed by others, on existing binaries without recompiling.</p>
<p>The IPC relationship between two different uarches isn&rsquo;t constant across benchmarks so &ldquo;comparable IPC on average across a range of benchmarks&rdquo; doesn&rsquo;t translate to &ldquo;comparable IPC on every benchmark&rdquo;. Quite the opposite, I&rsquo;d expect any given benchmark to show an advantage for one platform or the other since they are not the same.</p>
</div>
<ol class="children">
<li id="comment-454236" class="comment byuser comment-author-lemire bypostauthor even depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T18:36:03+00:00">December 6, 2019 at 6:36 pm</time></a> </div>
<div class="comment-content">
<p>What you describe matches my expectation but I feel that there is some amount of hype in favor of AMD.</p>
</div>
<ol class="children">
<li id="comment-454249" class="comment odd alt depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T18:45:05+00:00">December 6, 2019 at 6:45 pm</time></a> </div>
<div class="comment-content">
<p>I can&rsquo;t speak for everyone, but from my part the hype isn&rsquo;t that Zen 2 has higher IPC than Intel, or has released a better uarch than Intel, but that AMD has something <em>at least roughly comparable, on average</em> and is making it available at prices and core counts that undercut Intel by 50% or more.</p>
<p>After years of release the Skylake chip under a new name, and increasing the price each time, Intel has slashed many of their new chips by <em>half</em> over the old lines, and core counts on all parts are suddenly shooting up.</p>
<p>That&rsquo;s what&rsquo;s deserving of hype, not big microarchitectural improvements. From a microarchitectural point of view, Zen and Zen 2 are in many ways Skylake (client) clones!</p>
</div>
<ol class="children">
<li id="comment-454257" class="comment byuser comment-author-lemire bypostauthor even depth-8">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T18:56:57+00:00">December 6, 2019 at 6:56 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;From a microarchitectural point of view, Zen and Zen 2 are in many ways Skylake (client) clones!&rdquo;</p>
<p>Great quote.</p>
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
<li id="comment-453793" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T01:47:29+00:00">December 6, 2019 at 1:47 am</time></a> </div>
<div class="comment-content">
<p>How can I reproduce your results for the second table?</p>
<p>I went into the <code>2019/05/03</code> folder, ran make and ran the resulting <code>./bitmapdecoding</code> binary and look at the reported &ldquo;instructions per cycle&rdquo; value</p>
<p>I consistently get IPC 1.76 or 1.77 for Intel and 1.43 or 1.44 for AMD Zen 2 (on skylake-x and rome servers, respectively).</p>
</div>
<ol class="children">
<li id="comment-453795" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T02:04:08+00:00">December 6, 2019 at 2:04 am</time></a> </div>
<div class="comment-content">
<p>I tried on Skylake server (rather than Skylake-X) and got an IPC of 2.00, which is closer but still not 2.8.</p>
<p>It&rsquo;s weird there is such a difference between SKL and SKX here.</p>
</div>
<ol class="children">
<li id="comment-454053" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T15:52:35+00:00">December 6, 2019 at 3:52 pm</time></a> </div>
<div class="comment-content">
<p>Some time ago, I revised the post to 2.1 from 2.8. You have access to my skylake-x box.</p>
<pre>
$ ./dockerscript.sh
x86_64
$uname_p is [x86_64]
rm -r -f bitmapdecoding bitmapdecoding.s bitmapdecoding_countbranch sanibitmapdecoding
Sending build context to Docker daemon  4.946MB
Step 1/6 : FROM gcc:9.1
 ---> c7637321bf71
Step 2/6 : COPY . /usr/src/myapp
 ---> Using cache
 ---> e09e94f2e750
Step 3/6 : WORKDIR /usr/src/myapp
 ---> Using cache
 ---> c41c4c3dcc24
Step 4/6 : RUN make clean
 ---> Using cache
 ---> a9a9b7ea79ba
Step 5/6 : RUN make
 ---> Using cache
 ---> 4fbe6b324968
Step 6/6 : CMD ["./bitmapdecoding", "test"]
 ---> Using cache
 ---> 969acefc46b8
Successfully built 969acefc46b8
Successfully tagged my-gcc-app:latest
just scanning:
bogus
.matches = 129996 words = 21322 1-bit density 9.526 % 1-bit per word 6.097
bytes per index = 10.497
instructions per cycle 3.85, cycles per value set:  0.341, instructions per value set: 1.312, cycles per word: 2.078, instructions per word: 8.001
 cycles per input byte 0.03 instructions per input byte 0.13
min:    44301 cycles,   170595 instructions,           2 branch mis.,        4 cache ref.,        2 cache mis.
avg:  57490.1 cycles, 170607.6 instructions,         3.0 branch mis.,    960.9 cache ref.,     75.0 cache mis.

simdjson_decoder:
Tests passed.
matches = 129996 words = 21322 1-bit density 9.526 % 1-bit per word 6.097
bytes per index = 10.497
instructions per cycle 2.48, cycles per value set:  4.018, instructions per value set: 9.974, cycles per word: 24.499, instructions per word: 60.812
 cycles per input byte 0.38 instructions per input byte 0.95
min:   522358 cycles,  1296638 instructions,        8171 branch mis.,      254 cache ref.,        0 cache mis.
avg: 536409.7 cycles, 1296650.8 instructions,     8351.8 branch mis.,   1111.6 cache ref.,      5.7 cache mis.

Tests passed.
basic_decoder:
matches = 129996 words = 21322 1-bit density 9.526 % 1-bit per word 6.097
bytes per index = 10.497
instructions per cycle 2.06, cycles per value set:  4.499, instructions per value set: 9.283, cycles per word: 27.432, instructions per word: 56.599
 cycles per input byte 0.43 instructions per input byte 0.88
min:   584913 cycles,  1206795 instructions,       14050 branch mis.,      251 cache ref.,        0 cache mis.
avg: 592380.1 cycles, 1206795.0 instructions,    14329.2 branch mis.,   1269.4 cache ref.,     79.9 cache mis.
</pre>
</div>
<ol class="children">
<li id="comment-454239" class="comment even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T18:42:03+00:00">December 6, 2019 at 6:42 pm</time></a> </div>
<div class="comment-content">
<p>Did you collect your results on SKX or SKL?</p>
</div>
<ol class="children">
<li id="comment-454248" class="comment byuser comment-author-lemire bypostauthor odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T18:45:01+00:00">December 6, 2019 at 6:45 pm</time></a> </div>
<div class="comment-content">
<p>I think that my dump above is from SKX.</p>
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
<li id="comment-453799" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0332c95e0a87741174cb90dc6a40ec5d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0332c95e0a87741174cb90dc6a40ec5d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Darren Rushworth-Moore</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T03:01:42+00:00">December 6, 2019 at 3:01 am</time></a> </div>
<div class="comment-content">
<p>Tests seem quite vague to be honest, nothing about the specific processors being used clock speeds cache sizes etc.</p>
<p>Specific instruction sets being used If using AVX2 workloads Intel would come out on top everytime as it supports AVX 256 or 512 while Ryzen only supports AVX 128 so in that case yes Intel would come out on top and by quite a bit. Intel designed it and although AMD can use it due to their licence agreement but incorporating it takes a long time and typically architecture change and is not something that can just be added. Clock speed boosts vary quite a lot on load, if the load is short Intel will boost to maximum clock speed and never stabilise at the lower frequency after 30 seconds which you would normally see which can invalidate the results along with motherboards that may enable MCE as always on.</p>
<p>AMD don&rsquo;t do instruction sets anymore as applications typically geared towards the most common MMX was preferred over AMD 3D Now even if 3D now was more efficient but Intel like it is today has a bigger market thus not worth investing in a specific instruction set when the devices are limited.</p>
<p>Ryzen architecture boosts vary quite a bit depending on background tasks running it could be 4.6GHz or it could be 4GHz. Due to the nature of the architecture and the way it boosts it can only maintain that frequency for a short time, less than a second and the load is moved over to another core this includes flushing the data from L1 and L2 cache and move over to the to other core then boost the new core at a higher frequency to continue the task this can add latency but is quite small as it would typically be in the same CCX.</p>
<p>When people go on about Zen 2 having a higher IPC they have it as apples to apples, i.e All CPU&rsquo;s run at the same clock speed and see what architecture differences there are that distinguish from each at a given clock frequency without random boost clock speeds and use more generalised instruction sets like SSE4 skewing the results. If you have something that boosts randomly due to CPU temps, voltage, current ripple, VRM temps even ambient temperatures. If you can&rsquo;t set a base line and have so many variables into your results then the end result is also useless</p>
</div>
<ol class="children">
<li id="comment-453883" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T13:41:28+00:00">December 6, 2019 at 1:41 pm</time></a> </div>
<div class="comment-content">
<p><em>Tests seem quite vague to be honest, nothing about the specific processors being used clock speeds cache sizes etc.</em></p>
<p>These are not memory-bound tests. The processor with the highest frequency in these tests is Skylake. Given that memory access is not a significant burden here, and that we report &ldquo;per cycle&rdquo; instructions, it is ok not to mention frequency. But if we do, then the Intel Skylake processor is maybe at a disadvantage.</p>
<p><em>Specific instruction sets being used If using AVX2 workloads Intel would come out on top everytime as it supports AVX 256 or 512 while Ryzen only supports AVX 128 so in that case yes Intel would come out on top and by quite a bit.</em></p>
<p>No, none of this code uses AVX-512.</p>
<p><em>If you can’t set a base line and have so many variables into your results then the end result is also useless</em></p>
<p>I disagree. I can measure reliably how many cycles a computationally intensive tasks take. Yes, if there are expensive cache misses, then we have an issue, but it is not the case here.</p>
</div>
</li>
</ol>
</li>
<li id="comment-453842" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5cbc5141e715303e0a0706f3d0c74d1b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5cbc5141e715303e0a0706f3d0c74d1b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Archie</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T07:49:45+00:00">December 6, 2019 at 7:49 am</time></a> </div>
<div class="comment-content">
<p>Those influencers online that post stuff without specifying a lot of things. Short boost clock is extremely important in your test and that is what intel cpu&rsquo;s are good at. If you think that only two tests are important you are wrong again. If it was that huge gap you said about between these cpu&rsquo;s everybody woulf notice that and intel wouldn&rsquo;t lower their prices fot selling.</p>
</div>
<ol class="children">
<li id="comment-453882" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T13:36:50+00:00">December 6, 2019 at 1:36 pm</time></a> </div>
<div class="comment-content">
<p><em> Short boost clock is extremely important in your test and that is what intel cpu’s are good at.</em></p>
<p>Short boost in the clock frequency would not be relevant. If anything, as Yoav pointed out in another comment, higher frequencies in Intel would mean lower IPC whenever memory latency is at issue.</p>
<p><em>If you think that only two tests are important you are wrong again. If it was that huge gap you said about between these cpu’s everybody woulf notice that and intel wouldn’t lower their prices fot selling.</em></p>
<p>Please read my post again. I am explicit is stating that I believe AMD has probably better processors than Intel at this point. All I am saying is that we should qualify these statements.</p>
</div>
</li>
</ol>
</li>
<li id="comment-453844" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6b27909e731414f91eb563ac8a2113cd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6b27909e731414f91eb563ac8a2113cd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Darien</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T08:04:58+00:00">December 6, 2019 at 8:04 am</time></a> </div>
<div class="comment-content">
<p>I see the flag <code>-march=native</code> in the Makefile. When these containers are built, which system is used?</p>
</div>
<ol class="children">
<li id="comment-453884" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T13:42:14+00:00">December 6, 2019 at 1:42 pm</time></a> </div>
<div class="comment-content">
<p>In my tests, it is the same binary across systems.</p>
</div>
<ol class="children">
<li id="comment-454611" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Kurz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T22:41:02+00:00">December 6, 2019 at 10:41 pm</time></a> </div>
<div class="comment-content">
<p>I think Darien understands that it is the same binary, and is asking a different question. Since you used &ldquo;-march=native&rdquo;, you might get a different compilation depending on whether you generated the binary on AMD or Intel. In theory, this binary might always be faster on the machine it is compiled on than on the opposite machine. In practice, the assembly here is straightforward enough that this is unlikely the case. But it&rsquo;s still a question worth asking, and worth answering.</p>
</div>
<ol class="children">
<li id="comment-454899" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-07T02:03:57+00:00">December 7, 2019 at 2:03 am</time></a> </div>
<div class="comment-content">
<p>I agree.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-453849" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3927068ff1661b33ceaf345bc545dbde?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3927068ff1661b33ceaf345bc545dbde?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Yoav</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T08:59:38+00:00">December 6, 2019 at 8:59 am</time></a> </div>
<div class="comment-content">
<p>Frequency is very important when measuring IPC. This is because memory latency doesn&rsquo;t scale with frequency. So higher frequency means usually lower IPC.<br/>
Also the memory speed is very important.</p>
</div>
<ol class="children">
<li id="comment-453881" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T13:33:13+00:00">December 6, 2019 at 1:33 pm</time></a> </div>
<div class="comment-content">
<p>@Yoav Memory latency is not the issue here. This being said, the Intel Skylake processor has a higher frequency so if there is any frequency-related bias, it would be favorable to AMD Rome.</p>
</div>
</li>
</ol>
</li>
<li id="comment-453885" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c7006fe3de5100e19d5b524ad4b245ff?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c7006fe3de5100e19d5b524ad4b245ff?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Matthew Montgomery</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T13:51:45+00:00">December 6, 2019 at 1:51 pm</time></a> </div>
<div class="comment-content">
<p>These results are really odd. The Zen core has much wider decoding and far more pipelines that can complete instructions. Did you optimize for both systems or just the skylake one?</p>
</div>
<ol class="children">
<li id="comment-453904" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T14:06:04+00:00">December 6, 2019 at 2:06 pm</time></a> </div>
<div class="comment-content">
<p>The simdjson library targets westmere at the compiler level, the AVX code is written with intrinsics.</p>
</div>
<ol class="children">
<li id="comment-453933" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c7006fe3de5100e19d5b524ad4b245ff?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c7006fe3de5100e19d5b524ad4b245ff?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Matthew Montgomery</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T14:32:27+00:00">December 6, 2019 at 2:32 pm</time></a> </div>
<div class="comment-content">
<p>So yes, purely optimized for skylake and likely with optimizations that harm zen.</p>
</div>
<ol class="children">
<li id="comment-453944" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T14:36:25+00:00">December 6, 2019 at 2:36 pm</time></a> </div>
<div class="comment-content">
<p>I disagree. Neither of my tests is optimized for skylake or against zen.</p>
</div>
<ol class="children">
<li id="comment-453986" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c7006fe3de5100e19d5b524ad4b245ff?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c7006fe3de5100e19d5b524ad4b245ff?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Matthew Montgomery</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T15:16:23+00:00">December 6, 2019 at 3:16 pm</time></a> </div>
<div class="comment-content">
<p>Then you don&rsquo;t understand microarchitecture. Nehalem has the same core layout and scheduler layout as Skylake and Cannon lake. If it&rsquo;s optimized for one, it&rsquo;s optimized for all of them on the base level. Zen has a <em>very</em> different layout for both core and scheduler.</p>
<p>Skylake has 5 decoders and Zen has 4, but Zen can pack up to 8 instructions for those 4 and Skylake only 6. And that&rsquo;s just the first example.</p>
</div>
<ol class="children">
<li id="comment-454000" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T15:31:22+00:00">December 6, 2019 at 3:31 pm</time></a> </div>
<div class="comment-content">
<p>The <a href="https://github.com/lemire/simdjson" rel="nofollow ugc">simdjson</a> is an open project and we could use help from someone who can help us optimize the code for Zen architectures. Please help out.</p>
<p>Even on AMD, it is the fastest JSON parser in existence as far as I know.</p>
</div>
<ol class="children">
<li id="comment-454005" class="comment even depth-7">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c7006fe3de5100e19d5b524ad4b245ff?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c7006fe3de5100e19d5b524ad4b245ff?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Matthew Montgomery</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T15:40:51+00:00">December 6, 2019 at 3:40 pm</time></a> </div>
<div class="comment-content">
<p>After I code my game engine, maybe I&rsquo;ll pop in and restructure some things. Maybe.</p>
</div>
</li>
</ol>
</li>
<li id="comment-454140" class="comment odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T17:24:20+00:00">December 6, 2019 at 5:24 pm</time></a> </div>
<div class="comment-content">
<p>Zen and Skylake are way more similar than either of those are to Nehalem.</p>
<p>In general though compilers favor code that is faster on Intel than AMD.</p>
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
<li id="comment-453942" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9d275c171095ae1df26034c5659ee42a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9d275c171095ae1df26034c5659ee42a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">blah</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T14:35:48+00:00">December 6, 2019 at 2:35 pm</time></a> </div>
<div class="comment-content">
<p>Who&rsquo;s claiming Zen 2 has beat Intel on IPC? All the benches Ive seen puts the top mainstream i9 9900 and/or 9700 on top even against the mighty 3950x. The claim I&rsquo;ve seen is that AMD has narrowed the IPC gap significantly while destroying Intel on multithreaded tasks by a very very large margin. It is my understanding that the IPC gap between Zen2 and 9th gen is small enough that it&rsquo;s a better value to go with a Zen2 for a more robust CPU if you are a mix usage, content creation and gaming, etc.</p>
<p>Zen2 is not exactly cheap also. Platform costs (X570), memory cost (higher bandwidth memory) makes it a bit more expensive than an i9. The good news is that you can pop in a Zen2 into an X370 mobo&#8230;</p>
<p>It&rsquo;s an exciting time for the PC market. competition drives innovation!</p>
</div>
<ol class="children">
<li id="comment-454323" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T19:44:42+00:00">December 6, 2019 at 7:44 pm</time></a> </div>
<div class="comment-content">
<p>The link I offer in my post is one instance where folks claim that Zen 2 has better IPC.</p>
<p>I agree with your comment.</p>
</div>
</li>
</ol>
</li>
<li id="comment-454311" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/02bb729118e0173ec1c6be6f123f8b72?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/02bb729118e0173ec1c6be6f123f8b72?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Roland Homoki</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T19:31:00+00:00">December 6, 2019 at 7:31 pm</time></a> </div>
<div class="comment-content">
<p>This article feels so unfinished.<br/>
Nothing specified about test setup, and answer is always avoided.<br/>
What specs (chipset, CPU, RAM, OS)? What settings for CPU and RAM?<br/>
Why so specific software and such small selection? Maybe inclusion of actual performance (not IPC) at the same clockspeed.</p>
</div>
<ol class="children">
<li id="comment-454315" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T19:36:38+00:00">December 6, 2019 at 7:36 pm</time></a> </div>
<div class="comment-content">
<p>This blog post is specifically about IPC, not performance (please see the title).</p>
<p>The microarchitectures are specified; RAM and operating systems are not relevant.</p>
<p><em>Why so specific software and such small selection?</em></p>
<p>Because this is the software I care about. You will undoubtably run different code and software. That&rsquo;s fine.</p>
</div>
</li>
</ol>
</li>
<li id="comment-454413" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/63ab3284cd28d9504d10a6ede2328ccc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/63ab3284cd28d9504d10a6ede2328ccc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ksec</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T20:36:44+00:00">December 6, 2019 at 8:36 pm</time></a> </div>
<div class="comment-content">
<p>Came across this article on HN,</p>
<p>The problem is Guru3D, they are is not a technical site, so they got IPC wrong. But IPC in everybody&rsquo;s ( or normal peoples ) terms is exactly that they / you describe, work per clock, so in that sense it is right for their target audience. ( May be it should be used as PPC, performance per clock )</p>
<p>Having said that even the AMD bias site and fans dont ever claim Zen 2 has better than Intel&rsquo;s Single Core / Thread / IPC performance. Having better IPC / PPC is absolutely not the mainstream sentiment. As a matter of fact this is the first time I heard about it having casually serving a dozen of tech sites and social media.</p>
</div>
<ol class="children">
<li id="comment-454642" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0332c95e0a87741174cb90dc6a40ec5d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0332c95e0a87741174cb90dc6a40ec5d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Darren Rushworth-Moore</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-06T22:46:00+00:00">December 6, 2019 at 10:46 pm</time></a> </div>
<div class="comment-content">
<p>See it&rsquo;s not really the sites that&rsquo;s at fault, it&rsquo;t the manufactures that indicate what the &ldquo;IPC&rdquo; uplift is and this is before clock speeds are taking into account because they are at the stage in development where clock speeds have not yet been finalised as of yet thus sites like Guru3D etc set a baseline and to confirm if a specific manufacture is accurate in their assessment. Now maybe PPC would be a better assessment and neither AMD or Intel tried to diverge from it.</p>
<p>Intel typically will say 2% IPC gain before frequency as does AMD, while Intels typical 2% is within margin are error and people are like meh, no one really cares at that point but some people do indeed test it and do typically see a 2% uplift. They do it like this as both Intel and AMD are competitors yet at the same time they want people to be interested in their product while not giving away the full performance that frequency contributes to it.</p>
<p>People are more interested with AMD since when Zen was first launched 52% over piledriver, Zen+ 5%, Zen 2 13% and the upcoming Zen 3 15% with these percentages from Zen+ being compared to first Gen Zen, these are sizeable gains outside of margin of error. Then of course Intel and their Ice Lake&rsquo;s 18% IPC uplift. How sites test the devices to determine if they are true or not, as in the past they have been over inflated but thus far it has been accurate at least for the Zen microarchitecture. Thus this is how a majority of people how/now understand what IPC is.</p>
</div>
</li>
</ol>
</li>
<li id="comment-454878" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5c7b0ea3d2e62e5d4d26586bcb62e547?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5c7b0ea3d2e62e5d4d26586bcb62e547?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Keef</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-07T01:21:26+00:00">December 7, 2019 at 1:21 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m not necessarily a mega AMD fanboi and tend to suspect that the underlying point may still hold up. But this article feels very dubious since it carefully selected to benchmarks that would specifically be MOSTLY using AVX512 instructions on Intel, which AMD doesn&rsquo;t have implemented. I&rsquo;d like to see the performance difference using <em>only</em> x86-64 instructions with no SSE/AVX</p>
</div>
<ol class="children">
<li id="comment-454880" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5c7b0ea3d2e62e5d4d26586bcb62e547?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5c7b0ea3d2e62e5d4d26586bcb62e547?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Keef</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-07T01:22:11+00:00">December 7, 2019 at 1:22 am</time></a> </div>
<div class="comment-content">
<p>Two*</p>
</div>
</li>
<li id="comment-454945" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-07T02:50:10+00:00">December 7, 2019 at 2:50 am</time></a> </div>
<div class="comment-content">
<p>There is no AVX-512 anywhere. I assure you.</p>
</div>
</li>
</ol>
</li>
<li id="comment-463152" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/22a8f44f40b47c6cca5c9a91045932cd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/22a8f44f40b47c6cca5c9a91045932cd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">misdake</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-12T04:43:34+00:00">December 12, 2019 at 4:43 am</time></a> </div>
<div class="comment-content">
<p>Since tech sites compare Intel/AMD CPU performance, they are talking about the same binary file (and the same list of instrunctions to be executed), running on different x86-64 compatible CPUs.</p>
<p>In this specific but very common scenario, for any benchmark of fixed amount of work/instructions, “work per unit of time normalized per CPU frequency” = constant “instruction count of work” * “instructions per cycle”. These two work the same way hen comparing architectures.</p>
<p>So I suppose tech sites are not wrong. You and they just use different benchmarks and get different results.</p>
</div>
<ol class="children">
<li id="comment-463657" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-12T14:24:43+00:00">December 12, 2019 at 2:24 pm</time></a> </div>
<div class="comment-content">
<p>If you present a plot where on the y-axis you claim to present the number of instructions per cycle and you give some other number, you are making a mistake.</p>
<p>For many benchmarks, the number of instructions is not the proper benchmark.</p>
<p>Furthermore, even if you have the same binary, there is no reason to think that the processors will execute the same instructions. Branch predictors, difference in ISA can all trigger different code paths.</p>
</div>
</li>
</ol>
</li>
<li id="comment-549892" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9074a1e7df23bbb115c41e8c79566d2a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9074a1e7df23bbb115c41e8c79566d2a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">ChrisGX</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-08-22T15:31:10+00:00">August 22, 2020 at 3:31 pm</time></a> </div>
<div class="comment-content">
<p>From where I stand, work per unit of time normalized per CPU frequency, is the only consequential measure of IPC. IPC numbers offered by manufacturer only tell us about whether later generations of CPU achieve higher IPC than earlier generations of CPU. That is a relative measure only. It is nice to know that IPC is improving over successive years by this or that percentage but putting meat to the bones of IPC involves determining what those instructions are worth. You can only discover that by running appropriate benchmarks. And, that is why I say that work per unit of time normalized per CPU frequency is the more substantial way of thinking about IPC, whereas manufacturers numbers hold less significance.</p>
</div>
</li>
</ol>
