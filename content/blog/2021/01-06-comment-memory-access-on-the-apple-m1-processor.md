---
date: "2021-01-06 12:00:00"
title: "Memory access on the Apple M1 processor"
index: false
---

[29 thoughts on &ldquo;Memory access on the Apple M1 processor&rdquo;](/lemire/blog/2021/01-06-memory-access-on-the-apple-m1-processor)

<ol class="comment-list">
<li id="comment-565383" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0f5d41c9d13f82b8a3fe751f53ab5c5d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0f5d41c9d13f82b8a3fe751f53ab5c5d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://www.jongi.za.net/" class="url" rel="ugc external nofollow">Jongilanga Guma</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-06T20:08:14+00:00">January 6, 2021 at 8:08 pm</time></a> </div>
<div class="comment-content">
<p>Hi,<br/>
This is interesting, I ran this on my Mac, with processor:2,2 GHz Quad-Core Intel Core i7<br/>
There are the results:</p>
<p><code> $ ./two_or_three<br/>
N = 1000000000, 953.7 MB<br/>
starting experiments.<br/>
two : 44.7 ns<br/>
two+ : 45.0 ns<br/>
three: 67.6 ns<br/>
bogus 137531640<br/>
</code></p>
<p>Way too slow for my PC 🙂<br/>
Thanks for sharing.<br/>
Regards,<br/>
Jongi</p>
</div>
<ol class="children">
<li id="comment-565387" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-06T20:16:54+00:00">January 6, 2021 at 8:16 pm</time></a> </div>
<div class="comment-content">
<p>You may want to upgrade to the Apple M1. It is a massively better processor.</p>
</div>
</li>
</ol>
</li>
<li id="comment-565399" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fd55bf483eadf8e81377407a923df5b8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fd55bf483eadf8e81377407a923df5b8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Frank Astier</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-06T20:58:00+00:00">January 6, 2021 at 8:58 pm</time></a> </div>
<div class="comment-content">
<p>Did you look at the compiled assembly code? That could be interesting too.</p>
</div>
<ol class="children">
<li id="comment-565405" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-06T21:09:00+00:00">January 6, 2021 at 9:09 pm</time></a> </div>
<div class="comment-content">
<p>See <a href="https://gist.github.com/lemire/1c9e8827b45d057d7546e2743ad34496" rel="nofollow ugc">https://gist.github.com/lemire/1c9e8827b45d057d7546e2743ad34496</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-565401" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e2f0f360b06d021ae2f94d315bcf7538?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e2f0f360b06d021ae2f94d315bcf7538?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Olivier Galibert</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-06T21:00:47+00:00">January 6, 2021 at 9:00 pm</time></a> </div>
<div class="comment-content">
<p>In the first version, the compiler may have scheduled the first memory access to run in parallel with the second random calculation, and failed to do it in the second. Looking at the asm could shine some light on what&rsquo;s going on.</p>
</div>
<ol class="children">
<li id="comment-565406" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-06T21:09:07+00:00">January 6, 2021 at 9:09 pm</time></a> </div>
<div class="comment-content">
<p>See <a href="https://gist.github.com/lemire/1c9e8827b45d057d7546e2743ad34496" rel="nofollow ugc">https://gist.github.com/lemire/1c9e8827b45d057d7546e2743ad34496</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-565409" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9653670e890f8b649c576389204bcf7d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9653670e890f8b649c576389204bcf7d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Chris</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-06T22:05:15+00:00">January 6, 2021 at 10:05 pm</time></a> </div>
<div class="comment-content">
<p>Hello,</p>
<p>Isn&rsquo;t this also dependent of the memory&rsquo;s speed?</p>
</div>
<ol class="children">
<li id="comment-565411" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-06T22:19:29+00:00">January 6, 2021 at 10:19 pm</time></a> </div>
<div class="comment-content">
<p>The Apple M1 comes with builtin memory, so the memory speed is a constant.</p>
</div>
</li>
</ol>
</li>
<li id="comment-565410" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f82c06fc432babfe76dd994ebf6e05e4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f82c06fc432babfe76dd994ebf6e05e4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://okms.github.io" class="url" rel="ugc external nofollow">Ole Kristian Mørch-Storstein</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-06T22:17:18+00:00">January 6, 2021 at 10:17 pm</time></a> </div>
<div class="comment-content">
<p>Great read! Getting these results on my M1 Basemodel MBA (8GB/256)</p>
<p><code>two : 10.2 ns<br/>
two+ : 12.1 ns<br/>
three: 12.4 ns<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-565412" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-06T22:23:54+00:00">January 6, 2021 at 10:23 pm</time></a> </div>
<div class="comment-content">
<p>Thanks. As I indicated (see Notes), there are run-to-run variations so you should expect to get different numbers.</p>
</div>
</li>
</ol>
</li>
<li id="comment-565447" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Kurz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-07T02:20:03+00:00">January 7, 2021 at 2:20 am</time></a> </div>
<div class="comment-content">
<p>Since no-one else has speculated on why the observed results are what they are, I&rsquo;ll take a stab. My guess is that the different functions are being limited by different factors. For &ldquo;compute_two&rdquo; and &ldquo;compute_three&rdquo;, we&rsquo;re being limited by MLP. But for &ldquo;compute_two_plus&rdquo;, we&rsquo;re not able to achieve maximum MLP because the extra instruction cause us to be limited by the size of the Reorder Buffer (ROB).</p>
<p>Looking at the assembly (and noting that I don&rsquo;t actually know how to read ARM assembly) it looks like (only) the &ldquo;compute_two&rdquo; function has been unrolled 2x, which slightly reduces the loop overhead. If we presume the sequential reads from random[] are approximately free, we are issuing 4 uncached reads in 15 instructions. If we assume the ROB holds about 200 instructions (Skylake holds 224), this means we can fit about 12 copies of this loop into the ROB, and thus the processor can look ahead to see 48 memory accesses. If we assume the M1 can do 30 parallel accesses, and 48 &gt; 30, this means we max out on MLP and are memory bandwidth limited.</p>
<p>The function &ldquo;compute_three&rdquo; is not unrolled, and the inner loop does 3 memory reads in 12 instructions. Applying the same logic, we can fit 15 copies of the loop into the ROB, and the processor has 45 memory accesses to choose from. 45 &gt; 30, MLP limited. Since we are doing 50% more memory reads per iteration, we expect 50% greater time, which is just about exactly what we see.</p>
<p>The function &ldquo;computer_two_plus&rdquo; is not unrolled, and does 2 full memory reads in each 15 instructions. We&rsquo;ll assume for now that the adjacent reads to the same cache line are free. If 12 copies of the loop fit in the ROB, this means the processor sees only 24 full memory reads at a time. 24 &lt; 30, and thus we are not able to take full advantage of the possible MLP! Naively, we might expect to see about 25% slowdown from this. In actuality it&rsquo;s a bit more, but I&rsquo;m willing to hand wave this difference away because our assumption that the adjacent accesses are free is probably not quite true.</p>
<p>I&rsquo;m guessing at the exact numbers here, but my guess would that that something like this explains the numbers you are seeing. But an argument against this theory are claims that the M1 actually has a much deeper ROB: <a href="https://www.anandtech.com/show/16226/apple-silicon-m1-a14-deep-dive/2" rel="nofollow ugc">https://www.anandtech.com/show/16226/apple-silicon-m1-a14-deep-dive/2</a>. They suggest that it&rsquo;s more than 600! I haven&rsquo;t really looked at what they are measuring, though, and I feel like your example suggests otherwise. It might be interesting to try some other methods of increasing the per-iteration instruction count, and seeing whether they cause the same slowdown as the adjacent accesses.</p>
</div>
<ol class="children">
<li id="comment-565609" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-07T13:39:45+00:00">January 7, 2021 at 1:39 pm</time></a> </div>
<div class="comment-content">
<p>@Nathan : Thanks for the analysis. I will happily test any code you&rsquo;d like me to test&#8230;</p>
<p>My only claim here is that the naive memory-access model fails. I have not investigated further to see what the limiting factors are. I often run tests under Docker with perf with macOS&#8230; but, to my knowledge, Docker still hasn&rsquo;t released a version of Docker for the M1. I could run the benchmark under Xcode and get performance counters there but it is not as convenient to me.</p>
</div>
<ol class="children">
<li id="comment-610560" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b4436c47c8a6a169e0707eed8b15caa5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b4436c47c8a6a169e0707eed8b15caa5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Not important</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-12-09T14:36:43+00:00">December 9, 2021 at 2:36 pm</time></a> </div>
<div class="comment-content">
<p>From what I saw of apple doing , it seem that if some don’t use apple stuff , exemple , Xcode swift etc ! Performance is lower , likely some optimisation apple do to their own ! So far most optimisation outside apple are mainly back end ! But as apple have showed , their way work , I mean we have a lot of exemple online how performing it is ! I believe. The neural engine is the big underestimated portion!</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-565474" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fd25a6de3435e266ec521d15ca91881e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fd25a6de3435e266ec521d15ca91881e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://twitter.com/louchenyao" class="url" rel="ugc external nofollow">Chenyao Lou</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-07T04:17:55+00:00">January 7, 2021 at 4:17 am</time></a> </div>
<div class="comment-content">
<p>The problem is that the CPU can speculatively execute the memory access. That is, the branch predictor will help to unroll your loop and execute all the memory access at once so that the memory latency is<br/>
as low as 10ns.</p>
<p>The right way to do this benchmark is generating indexes by <code>idx = random[i] ^ answer</code> for preventing speculation.</p>
<p>See <a href="https://gist.github.com/louchenyao/75c3a6a3eeb0d7d9b1e8af7e18aacb03" rel="nofollow ugc">https://gist.github.com/louchenyao/75c3a6a3eeb0d7d9b1e8af7e18aacb03</a></p>
<p>The fixed benchmark result on my Macbook Air with the M1 processor is the following, which is pretty reasonable.</p>
<p><code>two : 130.3 ns<br/>
two+ : 131.0 ns<br/>
three: 133.2 ns<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-565603" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-07T13:32:59+00:00">January 7, 2021 at 1:32 pm</time></a> </div>
<div class="comment-content">
<p>@Chenyao : You are suggesting that we turn the benchmark into a pointer chasing benchmark, but if you follow the link for the memory-level parallelism, you will notice that this is how we do it to measure memory parallelism&#8230; we just create several independent lanes that work as you describe&#8230;</p>
<p><a href="https://github.com/lemire/testingmlp" rel="nofollow ugc">https://github.com/lemire/testingmlp</a></p>
<p>This being said, the benchmark described at the end of this blog post was deliberately designed, so it is not a mistake. That is, I specifically did want the processor to be able to start issuing new memory request ahead of time.</p>
<p>The pointer-chasing benchmark you suggest is also interesting and I might use such an approach in a follow-up post. Thanks!</p>
</div>
<ol class="children">
<li id="comment-565615" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fd25a6de3435e266ec521d15ca91881e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fd25a6de3435e266ec521d15ca91881e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://twitter.com/louchenyao" class="url" rel="ugc external nofollow">Chenyao Lou</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-07T13:51:35+00:00">January 7, 2021 at 1:51 pm</time></a> </div>
<div class="comment-content">
<p>@Daniel @Nathan. Sorry, I misunderstood the point. Thanks for point out that.</p>
<p>Then I would guess there is a limitation on #speculated memory accesses (cache line prefetch), so there is a difference between 2-wise and 3-wise. But due to some unknown reasons, the 2-wise+ performs similar to 3-wise. Kudo to Daniel for this finding!</p>
</div>
</li>
</ol>
</li>
<li id="comment-565608" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Kurz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-07T13:39:40+00:00">January 7, 2021 at 1:39 pm</time></a> </div>
<div class="comment-content">
<p>You are right about the speculation, but I think you are missing that Daniel has intentionally designed his benchmark to allow this speculation. This is why he included the graph about Memory Level Parallelism and has lines like &ldquo;Such a high degree of memory-level parallelism makes it less likely that our naive random-memory model applies.&rdquo;</p>
<p>Daniel&rsquo;s goal in this benchmark is to maximize the available MLP so as to highlight the difference between the M1 and Intel chips. One benchmark isn&rsquo;t more &ldquo;right&rdquo; than they other, it&rsquo;s just that they are measuring different things. Your numbers are interesting, though, since they show how just much benefit there is from the speculation. And note that there is still speculation in your example, which is why making two parallel random read requests per iteration takes almost exactly the same amount of as making three.</p>
</div>
<ol class="children">
<li id="comment-565659" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-07T15:07:48+00:00">January 7, 2021 at 3:07 pm</time></a> </div>
<div class="comment-content">
<p>To be clear, this benchmark is not meant to be used to compare different processors on different systems. It certainly was never meant to be run under Windows. Among other limitations is the fact that the rand() function can return values that are limited to a small range on some systems.</p>
<p>It is fine if folks want to run it on different system, but they have to make it sufficiently robust.</p>
<p>Even on macOS, the tool has limited robustness. Just enough to make the point&#8230;</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-565501" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/45d5b933fb8d6983853e2efdbdb88475?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/45d5b933fb8d6983853e2efdbdb88475?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Neo</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-07T06:47:41+00:00">January 7, 2021 at 6:47 am</time></a> </div>
<div class="comment-content">
<p>Hi, this is really interesting. I want to understand code and memory optimizations , any suggestions for a beginner?</p>
</div>
<ol class="children">
<li id="comment-565599" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-07T13:24:40+00:00">January 7, 2021 at 1:24 pm</time></a> </div>
<div class="comment-content">
<p>Neo: keep reading my blog!!! 🙂</p>
</div>
</li>
</ol>
</li>
<li id="comment-565522" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/51cac1b840c367404bc4985def8457a5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/51cac1b840c367404bc4985def8457a5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dominique</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-07T08:46:53+00:00">January 7, 2021 at 8:46 am</time></a> </div>
<div class="comment-content">
<p>M1 is fast indeed.<br/>
For comparison, this is what I get with a i7-8700K CPU @ 3.7GHz, xubuntu-18.04.5:</p>
<p><code>$ ./two_or_three<br/>
N = 1000000000, 953.7 MB<br/>
starting experiments.<br/>
two : 16.5 ns<br/>
two+ : 18.0 ns<br/>
three: 24.6 ns<br/>
bogus 1422321000<br/>
</code></p>
<p>With clang-11:</p>
<p><code>$ ./two_or_three<br/>
N = 1000000000, 953.7 MB<br/>
starting experiments.<br/>
two : 17.0 ns<br/>
two+ : 18.6 ns<br/>
three: 25.3 ns<br/>
bogus 1422321000<br/>
</code></p>
<p>Hmmm, the value &ldquo;bogus&rdquo; is different than on M1.<br/>
rand() does not give the same results on different platforms.<br/>
I wonder how much this matters when comparing.<br/>
It would be better to use a deterministic random number generator.</p>
</div>
</li>
<li id="comment-565561" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9db706e7dca36f85eaa0b3c0b6f4867a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9db706e7dca36f85eaa0b3c0b6f4867a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Igor</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-07T11:28:33+00:00">January 7, 2021 at 11:28 am</time></a> </div>
<div class="comment-content">
<p>Hi,<br/>
I&rsquo;ve run your tests on my Windows laptop (i7-8665U) and results are much better:</p>
<p>c:\work\test&gt;&gt;two_or_three.exe<br/>
N = 1000000000, 953.7 MB<br/>
starting experiments.<br/>
two : 1.0 ns<br/>
two+ : 1.4 ns<br/>
three: 1.7 ns<br/>
bogus 1458643000</p>
<p>The variance of first test is pretty big (up to 1.4 ns) while the other two are stable.</p>
</div>
<ol class="children">
<li id="comment-565614" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Kurz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-07T13:50:30+00:00">January 7, 2021 at 1:50 pm</time></a> </div>
<div class="comment-content">
<p>Interesting, although I think it&rsquo;s extremely unlikely that your results are correct. I&rsquo;d suspect a bug. Did you change anything in the code to allow it to run on Windows? Maybe reducing the sizes to everything fits in L1? If not, I&rsquo;m guessing there is something wrong with the Daniel&rsquo;s time measurement code on Windows. It probably hasn&rsquo;t been tested nearly as much as on Mac or Linux. Alternatively, maybe the compiler on Windows has figured out a way to defeat the benchmark by optimizing out the actual memory accesses? If you have time, I think it would be useful to figure out what&rsquo;s happening here.</p>
</div>
</li>
</ol>
</li>
<li id="comment-565589" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/498a47a5dba4347e539ca84572533720?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/498a47a5dba4347e539ca84572533720?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/linpengcheng/PurefunctionPipelineDataflow" class="url" rel="ugc external nofollow">Lin Pengcheng</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-07T13:00:45+00:00">January 7, 2021 at 1:00 pm</time></a> </div>
<div class="comment-content">
<p>Apple M1 chip adopts &ldquo;warehouse/workshop model&rdquo;</p>
<p>Warehouse: unified memory<br/>
Workshop: CPU, GPU, and other cores<br/>
Product( material): information, data</p>
<p>there&rsquo;s also a new <strong>unified memory</strong> architecture that lets the <strong>CPU, GPU, and other cores</strong> exchange <strong>information</strong> between one another, and with unified memory, the CPU and GPU can access memory simultaneously rather than copying data between one area and another. Accessing the same pool of memory without the need for copying speeds up information exchange for faster overall performance.</p>
<p>reference: <a href="https://www.macrumors.com/2020/11/30/m1-chip-speed-explanation-developer/" rel="nofollow ugc">Developer Delves Into Reasons Why Apple&rsquo;s M1 Chip is So Fast</a></p>
</div>
<ol class="children">
<li id="comment-565592" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/498a47a5dba4347e539ca84572533720?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/498a47a5dba4347e539ca84572533720?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/linpengcheng/PurefunctionPipelineDataflow" class="url" rel="ugc external nofollow">Lin Pengcheng</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-07T13:02:31+00:00">January 7, 2021 at 1:02 pm</time></a> </div>
<div class="comment-content">
<p>from: <a href="https://github.com/linpengcheng/PurefunctionPipelineDataflow" rel="nofollow ugc">The Grand Unified Programming Theory: The Pure Function Pipeline Data Flow with Warehouse/Workshop Model</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-566010" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/aab47e115c9dfc4222a11437481e6261?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/aab47e115c9dfc4222a11437481e6261?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Yichao Yu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-08T13:29:46+00:00">January 8, 2021 at 1:29 pm</time></a> </div>
<div class="comment-content">
<p>The 2 vs 2+ results is indeed interesting. However, I’m a bit not sure about the point of the 3 test.</p>
<p>Should the 3 version be any different from the 2 version with a M that’s 50% larger? I feel like this should be the case (apart from the loop overhead) no matter what system this runs on. Since there’s no barriers or anything like that between loop iterations, shouldn’t the total number of memory references be the only thing that matters.</p>
</div>
<ol class="children">
<li id="comment-566011" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-08T13:35:04+00:00">January 8, 2021 at 1:35 pm</time></a> </div>
<div class="comment-content">
<p><em>However, I’m a bit not sure about the point of the 3 test. (&#8230;) shouldn’t the total number of memory references be the only thing that matters</em></p>
<p>Naively, you would think so, wouldn&rsquo;t you? But that&rsquo;s not what happens in the M1.</p>
<p>That&rsquo;s the point of the three tests, to show that what you think might happen does not.</p>
</div>
</li>
</ol>
</li>
<li id="comment-566024" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b7c92cfe3ec362c79a6795c592f45a65?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b7c92cfe3ec362c79a6795c592f45a65?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ali Mirza</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-08T17:06:00+00:00">January 8, 2021 at 5:06 pm</time></a> </div>
<div class="comment-content">
<p>Hello! Thanks for sharing.</p>
<p>I have done my test on Ryzen 4500u on Lenovo Flex 5<br/>
and Ubuntu OS.</p>
<p>Here my results.<br/>
N = 1000000000, 953.7 MB<br/>
starting experiments.</p>
<p>two : 40.4 ns<br/>
two+ : 49.7 ns<br/>
three: 59.9 ns<br/>
bogus 1422321000</p>
</div>
</li>
<li id="comment-646261" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5dd056d107ce08862ffe5064b543b9cb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5dd056d107ce08862ffe5064b543b9cb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Yaron</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-10-05T15:06:01+00:00">October 5, 2022 at 3:06 pm</time></a> </div>
<div class="comment-content">
<p>I think M1 has much more parallelism than you might think: </p>
<p><a href="https://breaking-the-system.blogspot.com/2022/10/m1-is-much-faster-than-what-people.html" rel="nofollow ugc">https://breaking-the-system.blogspot.com/2022/10/m1-is-much-faster-than-what-people.html</a></p>
<p>I got different results than you, but I might miss something here.</p>
</div>
</li>
</ol>
