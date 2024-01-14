---
date: "2018-09-07 12:00:00"
title: "AVX-512: when and how to use these new instructions"
index: false
---

[15 thoughts on &ldquo;AVX-512: when and how to use these new instructions&rdquo;](/lemire/blog/2018/09-07-avx-512-when-and-how-to-use-these-new-instructions)

<ol class="comment-list">
<li id="comment-347572" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de6b81bfecb8f853f52667679b090492?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de6b81bfecb8f853f52667679b090492?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Francois Piednoel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-07T16:03:28+00:00">September 7, 2018 at 4:03 pm</time></a> </div>
<div class="comment-content">
<p>You instruction stream density is what decides the frequency decrease you will have when you use AVX512. You frequency decrease can go from few 100Mhz to 1Ghz on the Xeon Gold. To understand how much you will lose in frequency, the Power Control Unit (PCU) will count the &ldquo;unit of power&rdquo; (it has a look up table for almost every operation in the SoC, including fabric and Cores). Some of the heavy instructions, like Fuse Multiply ADD (FMA) get a really high count of unit of energy, that is very likely that if you end up at 2.9Ghz on the Xeon, you are using ALOT of that. You are usually rewarded by the SIMD speed up of the 512bits if you have a high count of FMAs. Optimizing for AVX512 requires a good understanding of the instruction stream, and ASM optimization, AND a good understanding of how the PCU works. Here is Efi explaining how it was working in SandyB, the mechanisms have changed a little, but not enough to be not useful. <a href="https://www.hotchips.org/wp-content/uploads/hc_archives/hc23/HC23.19.9-Desktop-CPUs/HC23.19.921.SandyBridge_Power_10-Rotem-Intel.pdf" rel="nofollow ugc">https://www.hotchips.org/wp-content/uploads/hc_archives/hc23/HC23.19.9-Desktop-CPUs/HC23.19.921.SandyBridge_Power_10-Rotem-Intel.pdf</a><br/>
Globally, if you are using instructions son of MMX, using int SIMD, if your stream is optimized properly you will end up around 3.5Ghz. IF you have a dense IS of SIMD FP (Instruction stream), you will end up at 2.9Ghz to 3.2Gz, Those numbers are only good on the Xeon Gold, if you using SKX, get to the UEFI settings, and equalize frequency of AVX2 and AVX512, and this will solve all of your problems. I never find a SKX (ExtremeEdition) that can not sustain the POR frequency doing AVX512, if you put it into a motherboard with a strong VR (Voltage regulation) and a 1000 Watt power supply.<br/>
Good day !</p>
</div>
<ol class="children">
<li id="comment-347616" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-07T18:48:09+00:00">September 7, 2018 at 6:48 pm</time></a> </div>
<div class="comment-content">
<p>Are you saying there are more than three levels? Based on my tests and all the documentation I&rsquo;ve seen there are only three levels, and when you enter them is more or less deterministic. The main remaining question mark is exactly how &ldquo;dense&rdquo; the wide FP instructions have to be, and how many you have to run, in order to trigger the L0 -&gt; L1 and L1 -&gt; L2 transitions.</p>
<p>This puts aside actual chip-wide temperature, power or current throttling which is a different thing and doesn&rsquo;t seem to kick in on the server chip we tested.</p>
</div>
<ol class="children">
<li id="comment-347662" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e4ff3d078ed69c9e017dc963a389b3f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e4ff3d078ed69c9e017dc963a389b3f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Francois Piednoel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-07T23:43:27+00:00">September 7, 2018 at 11:43 pm</time></a> </div>
<div class="comment-content">
<p>Actually, they are not different thing , they are all linked inside the PCU, there are more than 3 levels if you experiment properly, when you get into the transitional phase where your code is dense, the PCU will adjust to try to shave the TDPs of your socket. This is why all dense workload using AVX512 do not all end up at 2.9GHz when doing so. You really need to get to understand the PCU if you want to understand the behaviors of the Xeons</p>
</div>
<ol class="children">
<li id="comment-347762" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-08T14:55:16+00:00">September 8, 2018 at 2:55 pm</time></a> </div>
<div class="comment-content">
<p>You might run into other types of throttling which cause the chips to deviate from the published turbo levels of the three licenses, especially if your cooling is inadequate or your chip has a low configured TDP, but <em>in general</em> our tests and the documentation seems to indicate that the three levels are largely what matters, especially for well-cooled, high TDP server chips.</p>
<p>Note that there are three licenses, but the frequency levels depend also on the active core count, as described above, so the frequency is a two-dimensional matrix: on a 14-core chip like the 5120, there are 3 * 14 = 42 possible frequency levels. Note that these values are published by Intel!</p>
<p><code>This is why all dense workload using AVX512 do not all end up at 2.9GHz when doing so.<br/>
</code></p>
<p>Based on our experiments, dense workloads ran at the expected frequency on all cores: which is only 2.9 GHz for 1 or 2 cores. For 9 or more cores, the frequency is 1.6 GHz, for example.</p>
<p>Finally, there is also transition behavior, not described in this article, when entering and leaving the various licenses and also when changing core counts: but as far as I can tell this involves only throttling instruction dispatch and/or executing wide instructions on narrower units, and periods where the chip is halted, but not any new frequency levels.</p>
<p>Do we agree yet?</p>
<p>Note that you can run the same tests we did using <a href="https://github.com/travisdowns/avx-turbo" rel="nofollow">avx-turbo</a>.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-347757" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ca5506250a7d2282b08a55a8f6b53033?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ca5506250a7d2282b08a55a8f6b53033?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ben</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-08T14:13:04+00:00">September 8, 2018 at 2:13 pm</time></a> </div>
<div class="comment-content">
<p>Interesting article, I recently did some energy experiments on an Intel Skylake Gold 6154 based machine and also had to tackle these issues.</p>
<p>I found the Microway database insightful on AVX-based frequency reductions.</p>
<p><a href="https://www.microway.com/knowledge-center-articles/detailed-specifications-of-the-skylake-sp-intel-xeon-processor-scalable-family-cpus/" rel="nofollow ugc">https://www.microway.com/knowledge-center-articles/detailed-specifications-of-the-skylake-sp-intel-xeon-processor-scalable-family-cpus/</a></p>
<p>They imply that the chip is free to do whatever it wishes so long as it does not violate the TDP constraints. I&rsquo;m not sure if this contradicts your findings with 3 discrete license states or not. Maybe that is how they choose to implement this feature. Although this wouldn&rsquo;t take into account processor binning. Therefore I assumed it would be finer-grained than this.</p>
<p>On our heavily vectorised (AVX-512 flops) code we actually found the frequency drop was not as large as initially feared. This could have had something to do with effective water-cooling which keeps the temperatures down.</p>
<p>Would be so much easier if Intel gave some hints&#8230;rather than leaving it to educated guesswork!</p>
</div>
<ol class="children">
<li id="comment-347760" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-08T14:45:55+00:00">September 8, 2018 at 2:45 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>They imply that the chip is free to do whatever it wishes so long as it does not violate the TDP constraints.</p>
</blockquote>
<p>Can you point me at the exact quote where they imply that the chip is free to do anything?</p>
<p>What is certainly true is that above and beyond downclocking, there is TDP-related frequency throttling.</p>
<p>That is, you cannot be sure that the chip will run at the specified frequency. For example, if it gets too hot, it might run slower, certainly.</p>
<p>I would not describe that as the chip being free to do whatever it wishes. That would be quite a painful design for software engineers to cope with.</p>
</div>
<ol class="children">
<li id="comment-347764" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-08T15:11:26+00:00">September 8, 2018 at 3:11 pm</time></a> </div>
<div class="comment-content">
<p>Perhaps Ben is referring to the charts in the section &ldquo;AVX-512, AVX, and Non-AVX Turbo Boost&rdquo;, which imply that each of the licenses cover a range of frequencies (with the range being very large in the case of the single-core frequencies).</p>
<p>What these charts are showing is the the turbo speed for the license and core count at the top of each interval and the published &ldquo;base frequency&rdquo; at the bottom of each interval. Since there is only a single published base frequency (which doesn&rsquo;t depend on core count &#8211; hence should work even for max cores), the bottom limit of each range is the same for both graphs.</p>
<p>Essentially this is a claim that you&rsquo;ll get performance somewhere between the base frequency and the turbo, frequency which is correct in principle! Intel only really guarantees operation at the base frequency and speeds above that are &ldquo;opportunistic&rdquo; so you may not always get them depending on various factors. In practice, the turbo speeds are very reliable, unless you are doing something weird or you are using a very low TDP chip: you usually get exactly the max turbo you are allowed to get, consistently. People purchase chips based on that behavior too: you&rsquo;d be pretty annoyed if for some reason you didn&rsquo;t hit the published turbo frequencies.</p>
<p>If someone has any evidence that Skylake Xeon chips consistently run at somewhere other than the published max turbo for the license and core count, with the standard TDP configuration (i.e., not setting a lower than expected TDP in the BIOS/firmware), I&rsquo;d like to see it!</p>
</div>
<ol class="children">
<li id="comment-347770" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ca5506250a7d2282b08a55a8f6b53033?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ca5506250a7d2282b08a55a8f6b53033?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ben</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-08T15:38:37+00:00">September 8, 2018 at 3:38 pm</time></a> </div>
<div class="comment-content">
<p>@Travis that was exactly the point I was trying to make, although I agree I was a bit ambiguous.</p>
<p>Intel publishes essentially a list of guarantees for the maximum and minimum frequencies on the various possible workloads: number of cores executing different type of instructions. The microway link I posted publishes these in a series of box plots. So when you buy a 3GHz chip this is the minimum for non vectorised operations on a single core I believe. Even though it will usually be able to run at near enough the maximum &ldquo;TurboBoost&rdquo; frequency.</p>
<p>These guarantees are made to ensure that even the worst quality chips they push out can make those frequencies while staying within the TDP. In our testing we found that it often did much better than advertised. It never had to go down to the 1.6GHz AVX-512 minimum frequency.</p>
<p>With this new knowledge of the licenses, I will try to find some time to go back over the data and see if there are any &ldquo;clustering points&rdquo; around these license frequencies.</p>
<p>Maybe they are used as a hint to the core as to a rough frequency and then the PCU does the rest?</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-347774" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-08T16:18:45+00:00">September 8, 2018 at 4:18 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
Intel publishes essentially a list of guarantees for the maximum and minimum frequencies on the various possible workloads: number of cores executing different type of instructions.
</p></blockquote>
<p>I have never seen published minimum values on a per-core basis. The microway link just uses the same minimum &ldquo;base frequency&rdquo; for the single-core and all-cores case, which is especially unrealistic (i.e., will never happen unless you put your CPU in an oven) for the single-core case. If you have a link to minimum per-core frequencies published by Intel, I&rsquo;d like to see it!</p>
<p>As far as I can tell, they publish only max turbo frequencies, and these are also the ones you care about because you&rsquo;ll usually be running at that speed.</p>
<blockquote><p>
Maybe they are used as a hint to the core as to a rough frequency and<br/>
then the PCU does the rest?
</p></blockquote>
<p>Here&rsquo;s my rough model of how this works: first you have the deterministic published behavior described in this post, and also by Intel. This puts a hard cap on the max speed in a given configuration, and generally can&rsquo;t be adjusted (outside of chips with &ldquo;unlocked multipliers&rdquo;. This works &ldquo;deterministically&rdquo; in a fairly simple way based on the core count + license charts, and is the same for every CPU of a given model. The only relevant numbers here are the &ldquo;turbo&rdquo; frequencies: I don&rsquo;t think the base frequency ever comes into play. In general, the CPU will &ldquo;try&rdquo; to run at the speed looked up from the tables.</p>
<p>These tables mean that CPUs will generally run &ldquo;slower&rdquo; if they are executing heavier instructions, or are running with more cores, but I wouldn&rsquo;t tall this throttling: there are just different <em>design speeds</em> for different points in this matrix. So in some extend they are the modern equivalent of the marketed CPU speeds, but for marketing and sanity reasons Intel is of course not printing this matrix &ldquo;on the box&rdquo;.</p>
<p>Then, behind that, you have a complex PCU layer which has several feed-forward and feed-back mechanisms to monitor the predicted and/or actual power, current and temperature levels and to potentially apply additional throttling based on various thresholds. This can only slow down your chip compared to the design speeds, never speed it up.</p>
<p>For example, it may measure the instantaneous current and use that to calculate instantaneous power, and then insure that the power over some interval doesn&rsquo;t exceed some threshold. It may use different thresholds for different time periods too: you may be allowed to run with a TDP of 130W for 20 seconds, but only 100W longer term. This type of speed adjustment by the PCU I would label as &ldquo;throttling&rdquo;. It may be implemented by changing the frequency/voltage (p-state change), or perhaps by clock gating to change the duty cycle (more instantaneous and fine-grained, but less efficient longer term).</p>
<p>In addition to power the PCU will monitor temperature as kind of a last result: the TDP throttling should prevent the termperature from rising too high in normal circumstances, but it&rsquo;s no guaranteed, e.g., if the ambient temperature is high, the cooling system isn&rsquo;t working properly (vent blocked, etc) or the values are just too optimistic: if the temperature reaches some threshold, usually right around 100C you&rsquo;ll again get throttling.</p>
<p>Many of these &ldquo;throttling&rdquo; behaviors are somewhat configurable: the manufacturer (might be the system integrator, or the motherboard manufacturer or the cloud provider or whatever in various scenarios), can actually <em>set</em> some of these values, rather than use the default. For example a system with better than average cooling can set a higher TDP values: this doesn&rsquo;t allow it to run faster than the max set by the matrix, but it might delay or eliminate TDP related throttling by the PCU: since that&rsquo;s using the configurable thresholds. Similarly a cool &amp; quiet system might want to set lower TDPs.</p>
<p>These kinds of configurable thresholds are one reason you see CPU performance differences between different motherboards/systems even with the identical CPU (not the only reason: they have have slightly different base clocks too).</p>
<p>Unlike the matrix lookup, this behavior isn&rsquo;t really going to be deterministic from an end user point of view as it depends on many fine-grained internal and external factors. However, it is at least very observable: the PCU sets various bits in MSRs indicating what it did: throttling due to TDP limits, current throttling, temperature-throttling, etc &#8211; you can determine pretty much if any of them happened over any interval. Intel XTU on Windows shows some of this, but if you dig into the MSR you can get even more info.</p>
<p>Since you have these two quite different methods to determine the actual frequency, the question naturally arises: which is more important? Are you usually running at the &ldquo;max turbo&rdquo; that is described by the license + active core matrix? Or are you usually running in some kind of throttled state described in the second half of my description above? It depends on the chip. For server chips, like the ones we&rsquo;ve tested for this article with AVX-512, it is my impression and observation that they can usually run indefinitely at their &ldquo;max turbo&rdquo; without throttling, at least with reasonable cooling (which cloud providers probably have). This was true also on the Skylake W-2104 that we tested, a &ldquo;workstation&rdquo; chip (but it&rsquo;s a small, cheap one). So in those scenarios I think you should consider the max turbo the dominant factor.</p>
<p>The situation is different for chips and devices with restricted TDP. A 4-core 15W laptop chip is probably not going to be able to run with all cores at max speed indefinitely: you&rsquo;ll exceed the TDP. It probably <em>will</em> run that way for a short burst, since Intel has these thresholds where you can exceed your TDP for 10 seconds or something like that, but then it will slow down to keep the TDP at the configured value.</p>
<p>This kind of behavior is common for the chips that go in small and light devices like thin laptops and tablets. You can see it in the &ldquo;throttling&rdquo; tests that some reviews provide, showing performance over time for a sustained loads. It&rsquo;s super prevalent in phones (which of course are not x86) and usually the dominant factor for sustained CPU loads over a minute or so.</p>
<p>Not all laptop chips fall into this category though: I have a 45W i7-6700HQ (Skylake) and as far as I can tell it is OK to run pretty much any load on all cores at the max turbo (which on this chip varies only by core count, not by &ldquo;license&rdquo; &#8211; so that includes AVX2 FMA operations), although the fans do spin up and the CPU cores sit at about 90C).</p>
<p>Well that&rsquo;s my mental model anyways!</p>
</div>
</li>
<li id="comment-347776" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-08T16:28:36+00:00">September 8, 2018 at 4:28 pm</time></a> </div>
<div class="comment-content">
<p>After all that, I forgot to add the part about chip to chip variation that I was building towards&#8230;</p>
<p>So the matrix will be the same for every chip of a given model, and the PCU algorithms and thresholds will likely also be the same, but two chips of the same model may run at slightly different frequencies and slightly different power draws depending on characteristics of that particular wafer, where the chip appeared in the wafer and minor process changes over time.</p>
<p>So one chip might draw more power running the same load than another chip with the same model, which in the case that PCU throttling occurs, could mean that one chip runs faster. Of course this can also happen due to external factors, such as a server&rsquo;s position within the rack, the socket&rsquo;s position relative to the airflow, whatever.</p>
<p>The key is that this should only apply to &ldquo;throttling&rdquo; type scenarios, and not to the usual operating mode that normally applies to servers. So you often won&rsquo;t see any differences since you often don&rsquo;t see throttling.</p>
<p>For thin laptops and so on, you might be &ldquo;always throttling&rdquo; so it&rsquo;s important there &#8211; but the external factors on laptops are huge and probably overwhelm any chip-to-chip variation: if you have it on your lap, the outside temperature, whether the GPU is being used, if the bottom vents are blocked, etc.</p>
<p>About binning in general, remember that Intel is producing something like 20+ Xeon models from only 3 different dies, so there is already a huge opportunity for binning between the models since one die can make many different chips depending on its frequency response characteristics and any faulty cores.</p>
</div>
<ol class="children">
<li id="comment-347777" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ca5506250a7d2282b08a55a8f6b53033?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ca5506250a7d2282b08a55a8f6b53033?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ben</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-08T16:36:06+00:00">September 8, 2018 at 4:36 pm</time></a> </div>
<div class="comment-content">
<p>A comprehensive reply, thanks! I agree, and I think your mental model matches mine!</p>
<blockquote><p>
I have never seen published minimum values on a per-core basis. The microway link just uses the same minimum â€œbase frequencyâ€ for the single-core and all-cores case, which is especially unrealistic (i.e., will never happen unless you put your CPU in an oven) for the single-core case. If you have a link to minimum per-core frequencies published by Intel, I&rsquo;d like to see it!
</p></blockquote>
<p>Sorry I realised Microway didn&rsquo;t publish it for the Skylake line (not sure why this is the case). In my experiments I was comparing it to a Broadwell chip for which they did:<br/>
<a href="https://www.microway.com/knowledge-center-articles/detailed-specifications-of-the-intel-xeon-e5-2600v4-broadwell-ep-processors/" rel="nofollow ugc">https://www.microway.com/knowledge-center-articles/detailed-specifications-of-the-intel-xeon-e5-2600v4-broadwell-ep-processors/</a></p>
<p>Under: &ldquo;Top Clock Speeds for Specific Core Counts&rdquo;</p>
<p>I see no reason why the situation is not similar for Skylake and newer models.</p>
<p>The key point from your post that resonated with me is that Intel has to be flexible. They do not know where this chip will end up. It might end up living the life of luxury in a watercooled rack on its own or crammed in to an overheating server next to 20 others! That&rsquo;s why I find it hard to believe this &ldquo;license&rdquo; idea works. It&rsquo;s impossible to prescribe a frequency for a certain instruction unless you know the operating conditions.</p>
</div>
<ol class="children">
<li id="comment-347998" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-10T02:07:23+00:00">September 10, 2018 at 2:07 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
That&rsquo;s why I find it hard to believe this â€œlicenseâ€ idea works. It&rsquo;s<br/>
impossible to prescribe a frequency for a certain instruction unless<br/>
you know the operating conditions.
</p></blockquote>
<p>To be clear, I think the license idea works, and while it won&rsquo;t <em>always</em> be the thing that determines the actual speed, in many situations it will often or nearly always be the thing that determines the speed, to the extent that for your analysis you can use the simplified model where the license model is the only thing that exists (this is particularly true for the server chips we are discussing).</p>
<p>Most of the buyers who shell out thousands for a Skylake Xeon are likely to be professionals who will install it in a properly cooled rack, I think. In fact, the primary consumers to date are no doubt the big 3 (ish) cloud providers (Amazon, Google, Microsoft).</p>
<p>Note that the license model isn&rsquo;t something that we made it: Intel documents it themselves and these terms come straight from their documents. They even have performance counters in SKX that will tell you exactly what fraction of the time you spent in license 0, 1 or 2 as mentioned above (the CORE_POWER.LVL0_TURBO_LICENSE and related events).</p>
</div>
</li>
</ol>
</li>
<li id="comment-348006" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e4ff3d078ed69c9e017dc963a389b3f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e4ff3d078ed69c9e017dc963a389b3f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Francois Piednoel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-10T02:52:29+00:00">September 10, 2018 at 2:52 am</time></a> </div>
<div class="comment-content">
<p>You understand that I was one of the performance Architect of Core and that I was known to be a very good software optimizer, just to make sure before we go forward.</p>
<p>so, yes, there are hard limits, and it is not up for discussion, that are fact you can find here: <a href="https://en.wikichip.org/wiki/intel/xeon_gold/6154" rel="nofollow ugc">https://en.wikichip.org/wiki/intel/xeon_gold/6154</a> (For the hard limits)</p>
<p>The PCU does try to get you to your maximum TDP to maximize performance, so, if your instruction stream does not include any particular instruction set, you are likely to end up higher than the supposed bas3d frequency, for example, when you run cinebench, you do run one or 2 bins higher than the 3.7Ghz that Xeon is supposed to be limited to, at the beginning, then, later, it may drop, depending if your cooling can keep up with the energy produced.<br/>
Then , when you get to AVX2 or AVX512, you have the same mechanism in place, the PCU knows the floor of the respective instruction set, based on how many cores are active, and how dense is your instruction stream.<br/>
Then, The PCU will regulate, if you are using SIMD 512 bits adds, for example, you will not drop to the minimum 2.8Ghz, you will operate around 3.2Ghz (Just tested it)<br/>
IF you add FMA with no dependancies between the 2 FMAs, in 512 bits, you will go down to 2.8Ghz (Just tested it too)</p>
<p>Those mechanisms are working this way, any other way to look at this is voodoo stuff.<br/>
For the fun of it , a video of me speaking of a top end config of Intel when I was working there. <a href="https://www.youtube.com/watch?v=2W_79ZUyYWw" rel="nofollow ugc">https://www.youtube.com/watch?v=2W_79ZUyYWw</a></p>
</div>
<ol class="children">
<li id="comment-349564" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">BeeOnRope</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-16T17:52:15+00:00">September 16, 2018 at 5:52 pm</time></a> </div>
<div class="comment-content">
<p>I think we disagree, but it&rsquo;s hard for me to be certain, because I&rsquo;m not totally clear on what you are claiming &#8211; so it&rsquo;s possible we don&rsquo;t disagree at all.</p>
<p>When you say &ldquo;so, if your instruction stream does not include any particular instruction set, you are likely to end up higher than the supposed bas3d frequency, for example, when you run cinebench, you do run one or 2 bins higher than the 3.7Ghz that Xeon is supposed to be limited to&rdquo;, in the reference to &ldquo;supposed bas3d frequency&rdquo; are you talking about the <em>turbo</em> frequencies (which are 3.7, 3.6, 3.5 GHz for 1 active core for L0,1,2 respectively for the Gold 6154 you linked to), or are you talking about the &ldquo;base&rdquo; frequency of 3.0, 2.6, 2.1 given in the base column?</p>
<p>If you talking about the latter (&ldquo;base frequency&rdquo;) then I think we agree on least that part: the CPU will generally always be running in one of the turbo speeds which is greater than the base frequency. Something would have to quite unusual (configuration-wise or hardware) for the chip to run in a sustained manner only at the base frequency, which is much lower than even the wost-case turbo frequencies.</p>
<p>If you are talking about the former (turbo frequencies), then your claim is that the chip can run for some period above the turbo frequency for its license, right? That seems remarkable (and in direct contradiction to your previous paragraph where you say these are &ldquo;hard limits&rdquo;) &#8211; and I&rsquo;d like to see a reproducible test that shows it! You can start with <a href="https://github.com/travisdowns/avx-turbo" rel="nofollow">avx-turbo</a> as a base or do it from scratch, or use existing tools &#8211; just make it open and reproducible.</p>
<p>The only time-based effect I&rsquo;m aware of that kind of aligns with your description is the ability to exceed the long-term TDP threshold for various time periods, e.g., run up to 140W on a 100W TDP chip for 1 second an up to 125W for 14 seconds or something like that. That&rsquo;s a separate mechanism and it doesn&rsquo;t let you go <em>above</em> the turbo frequency matrix, it just lets you exceed the TDP for a short period, effectively using the thermal mass of chip and cooling solution as a buffer to absorb heat above the long-term cooling capability. These values are configurable in the BIOS/firmware. This feature is especially useful and commonly triggered in low-TDP chips like &lt; 40W thin-and-light laptop chips.</p>
<blockquote><p>
Then, The PCU will regulate, if you are using SIMD 512 bits adds, for<br/>
example, you will not drop to the minimum 2.8Ghz, you will operate<br/>
around 3.2Ghz (Just tested it)
</p></blockquote>
<p>Can you share your test? Or at least describe the inner loop in terms of what type of adds and how they were dependent. This wouldn&rsquo;t be surprising &#8211; as described above, <em>most</em> AVX-512 kernels will run in the L1 license, which is 3.3 GHz: only if you have a &ldquo;dense enough&rdquo; sequence of heavy AVX-512 instructions will you drop to L2. I wouldn&rsquo;t be surprised to find out that the measurement of &ldquo;dense enough&rdquo; depends in a fine-grained way on the actual instructions. I would be surprised in the CPU uses a frequency <em>higher</em> than the turbo frequency for the current licenses and active core count. I would also be surprised if the CPU selects dynamically a frequency lower than the max-turbo frequency, except where max TDP throttling or another type of throttling is occurring. Perhaps if you run the 6154 at 18 active cores, with a heavy AVX-512 load you get TDP throttling, and in that case I&rsquo;d completely agree that you can see lower frequencies: but I haven&rsquo;t run into TDP throttling on the server chips I&rsquo;ve tested (which doesn&rsquo;t include the 6154) or that other people have tested with avx-turbo and provided the results.</p>
<blockquote><p>
Those mechanisms are working this way, any other way to look at this<br/>
is voodoo stuff.
</p></blockquote>
<p>You should be more specific about what you disagree with (and try to use precise language in order to reduce mis-understandings) &#8211; but I&rsquo;m quite convinced it&rsquo;s not voodoo. This post is just a restatement of how <em>Intel themselves describes this working</em> &#8211; both in marking materials and technical documents. They themselves publish the frequency matrices! They invented terms we use here like &ldquo;license&rdquo; and they have performance counters which use these terms and show you exactly how many cycles you spend running in each license.</p>
<p>More importantly, our testing code is completely open and our results can be reproduced by anyone. Our results line up exactly with how Intel describes the system working, and are generally precisely and exactly reproducible. I welcome you to provide reproducible evidence to the contrary (and first to be specific about what you disagree about), rather than vague appeals to authority or youtube links.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-349621" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e4ff3d078ed69c9e017dc963a389b3f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e4ff3d078ed69c9e017dc963a389b3f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://ark.intel.com/products/120492/Intel-Xeon-Gold-6130-Processor-22M-Cache-2_10-GHz" class="url" rel="ugc external nofollow">Francois Piednoel</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-17T01:28:04+00:00">September 17, 2018 at 1:28 am</time></a> </div>
<div class="comment-content">
<p>I spent a week to collect all public info available for this topics online, to make sure I was not pushing intel confidential info, and I did not:</p>
<p>I think you do not understand the Turbo Max 3.0 at all &#8230; so, I recommend that you go and read the link attached. (see here that Xeon Gold support Turbo 3.0 ( <a href="https://ark.intel.com/products/120492/Intel-Xeon-Gold-6130-Processor-22M-Cache-2_10-GHz" rel="nofollow ugc">https://ark.intel.com/products/120492/Intel-Xeon-Gold-6130-Processor-22M-Cache-2_10-GHz</a>)</p>
<p>Turbo 3.0 Max in more detail:<br/>
<a href="https://www.pcper.com/reviews/Processors/Intel-Core-i7-6950X-10-core-Broadwell-E-Review/Intel-Turbo-Boost-Max-Technology-3" rel="nofollow ugc">https://www.pcper.com/reviews/Processors/Intel-Core-i7-6950X-10-core-Broadwell-E-Review/Intel-Turbo-Boost-Max-Technology-3</a></p>
<p>Then, please read about Speedshift:<br/>
<a href="https://www.anandtech.com/show/11550/the-intel-skylakex-review-core-i9-7900x-i7-7820x-and-i7-7800x-tested/7" rel="nofollow ugc">https://www.anandtech.com/show/11550/the-intel-skylakex-review-core-i9-7900x-i7-7820x-and-i7-7800x-tested/7</a> (supported by Xeon Gold too)</p>
<p>Then, read this:<br/>
<a href="https://www.anandtech.com/show/11550/the-intel-skylakex-review-core-i9-7900x-i7-7820x-and-i7-7800x-tested/7" rel="nofollow ugc">https://www.anandtech.com/show/11550/the-intel-skylakex-review-core-i9-7900x-i7-7820x-and-i7-7800x-tested/7</a> (the code in this article here was written by my peer fellow Principal Engineer in my group then)</p>
<p>Now, important point to notice in the definition of turbo boost:<br/>
<a href="https://www.intel.com/content/www/us/en/architecture-and-technology/turbo-boost/turbo-boost-technology.html" rel="nofollow ugc">https://www.intel.com/content/www/us/en/architecture-and-technology/turbo-boost/turbo-boost-technology.html</a></p>
<p>&ldquo;Availability and frequency upside of IntelÂ® Turbo Boost Technology 2.0 state depends upon a number of factors including, but not limited to, the following:<br/>
Type of workload<br/>
Number of active cores<br/>
Estimated current consumption<br/>
Estimated power consumption<br/>
Processor temperature&rdquo;</p>
<p>AND PLEASE NOTICE &ldquo;but not limited to&rdquo; part of it &#8230;</p>
<p>Then, when you are done with this, you have to go and read carefully how does Turbo 2.0 Here: <a href="https://www.hotchips.org/wp-content/uploads/hc_archives/hc23/HC23.19.9-Desktop-CPUs/HC23.19.921.SandyBridge_Power_10-Rotem-Intel.pdf" rel="nofollow ugc">https://www.hotchips.org/wp-content/uploads/hc_archives/hc23/HC23.19.9-Desktop-CPUs/HC23.19.921.SandyBridge_Power_10-Rotem-Intel.pdf</a></p>
<p>Then, understand that Turbo 3 and SpeedShift/SpeedSpeed and Turbo2.0 are stack on the top of each other.</p>
<p>So, AVX512 has the transitional mode that you keep decline to exist. you can run a medium dense instruction AVX512 stream and not end up at the lowest frequency attributed the AVX512 by the frequency table, and this is how it works, and if you do not agree with all of those, well, can&rsquo;t help you.</p>
</div>
</li>
</ol>
