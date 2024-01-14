---
date: "2018-08-15 12:00:00"
title: "The dangers of AVX-512 throttling: a 3% impact  on Xeon Gold processors?"
index: false
---

[10 thoughts on &ldquo;The dangers of AVX-512 throttling: a 3% impact on Xeon Gold processors?&rdquo;](/lemire/blog/2018/08-15-the-dangers-of-avx-512-throttling-a-3-impact)

<ol class="comment-list">
<li id="comment-341017" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Nathan Kurz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-16T02:27:41+00:00">August 16, 2018 at 2:27 am</time></a> </div>
<div class="comment-content">
<p>Were running this benchmark on your Skylake-X, or on the Packet Xeon Gold? The link that Travis provided on the previous post was useful: <a href="https://en.wikichip.org/wiki/intel/xeon_gold/5120" rel="nofollow ugc">https://en.wikichip.org/wiki/intel/xeon_gold/5120</a></p>
<p>It says that the expected single core drop for that particular Xeon Gold would be from 3200 MHz for &ldquo;normal&rdquo;, to 3100 MHz for &ldquo;AVX2&rdquo;, and then down to 2900 MHz for &ldquo;AVX512&rdquo;. The drop from &ldquo;normal&rdquo; to &ldquo;AVX2&rdquo; is suspiciously close to the 3% that you report.</p>
<p>What becomes more interesting is that the expected drop when running on 9 or more cores is much more dramatic. At 9, 2700 Mhz is &ldquo;normal&rdquo;, 2300 MHz is &ldquo;AVX2&rdquo;, and 1600 MHz is &ldquo;AVX512&rdquo;.</p>
<p>The linked explanation from that page seems to be a good overview of the frequency selection algorithm on Intel: <a href="https://en.wikichip.org/wiki/intel/frequency_behavior" rel="nofollow ugc">https://en.wikichip.org/wiki/intel/frequency_behavior</a></p>
</div>
<ol class="children">
<li id="comment-341481" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-16T21:29:16+00:00">August 16, 2018 at 9:29 pm</time></a> </div>
<div class="comment-content">
<p>Thanks Nate.</p>
<p>So the theory is that my benchmark simply does not use enough cores. But I already ran Vlad&rsquo;s multicore benchmark on this same hardware and saw no effect.</p>
<p>I am inviting reproducible benchmarks, I will gladly run them.</p>
</div>
</li>
</ol>
</li>
<li id="comment-341100" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Me</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-16T06:06:41+00:00">August 16, 2018 at 6:06 am</time></a> </div>
<div class="comment-content">
<p>It depends a lot on your cooling.</p>
<p>On my laptop, using AVX2 heavily on a single core with turbo boost disabled is enough to cause the fan go to max and cause CPU throttling that usually only would kick in with multiple cores and turbo boost.<br/>
But of course the cooling on a laptop isn&rsquo;t designed for such load.</p>
</div>
<ol class="children">
<li id="comment-341140" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-16T11:16:57+00:00">August 16, 2018 at 11:16 am</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s different than possible necessity to clock down the core in order to cope with complex AVX-512 instructions. If all of this more or less boils down to cooling budget, it&rsquo;s no wonder people see very different results depending on their setup.</p>
<p>It might be interesting to see how CPU power usage differs between different variations of the test. I think modern CPUs quite fine grained abilities to measure used energy in Joules. It might be that although throughput of a CPU doesn&rsquo;t vary much, energy efficiency may vary quite a bit &#8211; and that tends to be important to organisations running large numbers of servers.</p>
</div>
</li>
</ol>
</li>
<li id="comment-341102" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/423a1a4f867f2773f553579fa721552c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/423a1a4f867f2773f553579fa721552c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Paul Graydon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-16T06:18:19+00:00">August 16, 2018 at 6:18 am</time></a> </div>
<div class="comment-content">
<p>I think you&rsquo;re missing one of the key points that came out between the blog posts and the top comments on it, and that&rsquo;s that the different tiers of processors, Bronze, Silver, Gold and Platinum all have very different performance characteristics when it comes to AVX-512.</p>
<p>In the original cloudflare blog post, Vlad was testing against a Xeon Silver instance. Note the frequency table here: <a href="https://en.wikichip.org/wiki/intel/xeon_silver/4116" rel="nofollow ugc">https://en.wikichip.org/wiki/intel/xeon_silver/4116</a><br/>
Then compare it to the frequency table for that Xeon Gold chip you&rsquo;re testing on:<br/>
<a href="https://en.wikichip.org/wiki/intel/xeon_gold/5120" rel="nofollow ugc">https://en.wikichip.org/wiki/intel/xeon_gold/5120</a></p>
<p>Note that the Silver drops maximum core speed below base speed as soon as you have <em>any</em> cores working on AVX-512. In the benchmarks Vlad was running, AVX-512 didn&rsquo;t make up the majority of instructions, just single digit percentage, but the rest of the chip would end up throttled down to 1.8Ghz or as low as 1.4Ghz depending on how those AVX-512 requests landed. It only takes 9 active cores doing AVX-512 to get a Silver down to 1.4Ghz.</p>
<p>In the Gold case, you have to get to at least 4 cores working on AVX-512 simultaneously before the maximum core speed drops below base speed, and even then the Gold retains a much higher clock rate for quite a ways across the board. Even with all cores working on AVX-512, the Gold chip you&rsquo;re testing against doesn&rsquo;t touch 1.4Ghz.</p>
<p>Here&rsquo;s a fun comparison. If you go to the more premium side, the systems the cloud provider I work for have Xeon Platinum 8160-somethings in them. Take a look at how drastically different the frequency table is for a Platinum 8168:<br/>
<a href="https://en.wikichip.org/wiki/intel/xeon_platinum/8168" rel="nofollow ugc">https://en.wikichip.org/wiki/intel/xeon_platinum/8168</a>. You have to get <em>17</em> cores simultaneously working on AVX-512 instructions to get the maximum core speed down below the normal core speed.</p>
<p>Or to go further to the cheap side, the Bronze chips:<br/>
<a href="https://en.wikichip.org/wiki/intel/xeon_bronze/3106" rel="nofollow ugc">https://en.wikichip.org/wiki/intel/xeon_bronze/3106</a><br/>
As soon as you do any AVX-512 operations, your core speed drops by more than half, from 1.7Ghz to just 800Mhz. AVX2 isn&rsquo;t great there, but it&rsquo;s not as catastrophic to performance.</p>
<p>What&rsquo;s concerning here is that there isn&rsquo;t immediately apparent ways of figuring this out at runtime. The chips will show up as all supporting AVX-512, and while that&rsquo;s certainly accurate, I can easily see that I would likely want to avoid AVX-512 instructions on a Bronze and Silver, while embracing them on Gold and Platinum.</p>
</div>
</li>
<li id="comment-341257" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/423a1a4f867f2773f553579fa721552c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/423a1a4f867f2773f553579fa721552c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Paul Graydon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-16T15:40:21+00:00">August 16, 2018 at 3:40 pm</time></a> </div>
<div class="comment-content">
<p>Not sure if my prior comment got swallowed by spam filters (probably, I did link to wikichip a whole bunch. Unfortunately something seems to be up with their DNS today so I&rsquo;m writing my comments off of my memory of the frequency tables I saw last night).</p>
<p>There are some very important differences between your benchmarking and Vlad&rsquo;s:</p>
<p>1) He&rsquo;s using Xeon Silver chips. Bronze, Silver, Gold, and Platinum Xeon chips have <em>very</em> different responses to running AVX-512 instructions.</p>
<p>2) He&rsquo;s using a very mixed workload, where AVX-512 instructions only play a relatively small part (&lt;10%) of the workload being carried out by the processor. The workload he&rsquo;s using is simulating a webserver environment, where the processor is handling nginx, etc. workload as well as OpenSSL/cryptography stuff that&rsquo;s leveraging AVX instructions. Silver chips are likely to be popular for similar workload. At least on the surface of things they strike a good price/$ point.</p>
<p>With regard to frequency scaling:<br/>
On the low end Bronze chips, just having 1 single core running an AVX-512 instruction is enough to drop the base frequency of the chip down to 800Mhz.</p>
<p>On the Silver chip that Vlad was using, it&rsquo;s not quite as dramatic, but still, the moment you run an AVX-512 instruction the core frequency drops noticeably. By the time you get more than 4 cores running it, it drops down from 2.2Ghz to 1.4Ghz.</p>
<p>By the time you get to Gold, you can have several cores running AVX-512 instructions before the core frequency drops below base frequency. On Platinum you can have more than half the cores running AVX instructions and not see an impact.</p>
<p>The unfortunate outcome of the approach Intel has taken here is that if you&rsquo;re using Xeon Bronze or Silver chips, you&rsquo;re likely going to want to avoid AVX-512, unless you&rsquo;re doing purely AVX-512.</p>
<p>What seems particularly dangerous about this approach thinking about things from a compiler perspective, is that no longer are you having to target architecture with optimisations, you need to be aware of specific models to figure out which approach is correct.</p>
<p>I wonder if this may be a place where JIT&rsquo;d languages might see a notable advantage, being able to gather a lot more information at run-time to guide optimisations?</p>
</div>
<ol class="children">
<li id="comment-342183" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-17T18:58:22+00:00">August 17, 2018 at 6:58 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
By the time you get to Gold, you can have several cores running<br/>
AVX-512 instructions before the core frequency drops below base<br/>
frequency. On Platinum you can have more than half the cores running<br/>
AVX instructions and not see an impact.
</p></blockquote>
<p>I think this part embeds a wrong assumption. Yes, you can have several cores running AVX-512 without seeing a drop below <em>base</em> frequency, but there is nothing really special about base frequency: it&rsquo;s just the number on the box and Intel makes some kind of loose guarantees about it &#8211; but it is almost irrelevant for most code.</p>
<p>Most cores are going going to be running at &ldquo;turbo&rdquo; frequencies most of the time, including &ldquo;AVX-512 turbo&rdquo; which may be above or below base &#8211; but the logical comparison is between AVX-512 turbo and the scalar (non-AVX) turbo, not between AVX turbo and base. Or more precisely, the right comparison is between the actual frequencies, both for AVX-using and non-AVX code and the turbo frequencies are good proxies for those.</p>
<p>So regarding: &ldquo;On Platinum you can have more than half the cores running AVX instructions <strong>and not see an impact.</strong>&rdquo; &#8211; the bolded part is not true: almost chips will suffer a frequency impact relative to the scalar case as soon as they run some heavy AVX-256 or any AVX-512: only relative to the arbitrary base frequency is there no &ldquo;impact&rdquo;.</p>
</div>
</li>
</ol>
</li>
<li id="comment-341518" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Kurz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-16T22:45:41+00:00">August 16, 2018 at 10:45 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
On the low end Bronze chips, just having 1 single core running an<br/>
AVX-512 instruction is enough to drop the base frequency of the chip<br/>
down to 800Mhz.
</p></blockquote>
<p>You probably understand this, but to clarify for others, &ldquo;chip&rdquo; here means just that particular core, and not all the cores on the CPU. The belief (likely correct) is that if you use single &ldquo;heavy&rdquo; AVX512 instruction (such as a 512-bit multiplication), that particular core will momentarily be slowed down to 800 MHz. Do we know how long &ldquo;momentary&rdquo; is here, and what transition penalty is?</p>
<p>Thus if you are performing a task that is already at maximum IPC, you would expect a greater than 50% slowdown. On the other hand, if you are already slowed down by memory accesses, you might not notice anything even on Xeon Bronze. So while it should be possible to come up with a benchmark that shows the full impact, it might not be easy to come up with one that doesn&rsquo;t feel &ldquo;artificial&rdquo;.</p>
</div>
<ol class="children">
<li id="comment-342248" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/423a1a4f867f2773f553579fa721552c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/423a1a4f867f2773f553579fa721552c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Paul Graydon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-17T22:06:16+00:00">August 17, 2018 at 10:06 pm</time></a> </div>
<div class="comment-content">
<p>With full Intel Speed Step support, which got introduced with Skylake the latency in changing speed is reportedly ~35ms. Without it, it&rsquo;s ~100ms. Even at 35ms to change speeds, that&rsquo;s going to have an impact on performance.</p>
</div>
<ol class="children">
<li id="comment-342336" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-18T03:03:33+00:00">August 18, 2018 at 3:03 am</time></a> </div>
<div class="comment-content">
<p>I have measured certainly types of transitions on Skylake and they are faster than ~35ms. For example, the frequency transitions between various turbo speeds (which are forced as various cores come out of sleep) take about ~20,000 cycles, which is about 8us, or more than 1000x faster than 35ms.</p>
<p>Perhaps there are some types of transitions that take longer, however, e.g,. if the voltage needs to change.</p>
<p>There is also another type of transition where the frequency doesn&rsquo;t change, but the &ldquo;upper lanes&rdquo; of the ALUs are powered up, which occurs on some chips if you don&rsquo;t run 256-bit instructions for a while, then you run one. Agner describes it at the end of this <a href="https://www.agner.org/optimize/blog/read.php?i=415#415" rel="nofollow">comment on his blog</a>. This transition is also in the &ldquo;microseconds&rdquo; not &ldquo;milliseconds&rdquo; range.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
