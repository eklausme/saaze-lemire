---
date: "2021-03-24 12:00:00"
title: "Counting cycles and instructions on the Apple M1 processor"
index: false
---

[21 thoughts on &ldquo;Counting cycles and instructions on the Apple M1 processor&rdquo;](/lemire/blog/2021/03-24-counting-cycles-and-instructions-on-the-apple-m1-processor)

<ol class="comment-list">
<li id="comment-580671" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d04b751c5e1583edfe8f7bac8975d753?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d04b751c5e1583edfe8f7bac8975d753?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Mohit</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-24T22:34:29+00:00">March 24, 2021 at 10:34 pm</time></a> </div>
<div class="comment-content">
<p>I just tried it on my side on a macbook air m1, and am getting way lower results for instructions/float (not sure what it means). I am running latest version of osx.</p>
<p>parsing random numbers</p>
<p>model: generate random numbers uniformly in the interval [0.000000,1.000000]<br/>
volume: 10000 floats<br/>
volume = 0.0762939 MB<br/>
strtod 376.04 instructions/float (+/- 0.0 %)<br/>
75.53 cycles/float (+/- 0.0 %)<br/>
4.98 instructions/cycle<br/>
88.95 branches/float (+/- 0.0 %)<br/>
0.6005 mis. branches/float<br/>
fastfloat 162.01 instructions/float (+/- 0.0 %)<br/>
22.01 cycles/float (+/- 0.0 %)<br/>
7.36 instructions/cycle<br/>
38.00 branches/float (+/- 0.0 %)<br/>
0.0001 mis. branches/float</p>
<p>Thanks a lot for the post. Very interesting.</p>
</div>
<ol class="children">
<li id="comment-580686" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-24T23:37:42+00:00">March 24, 2021 at 11:37 pm</time></a> </div>
<div class="comment-content">
<p>I updated my blog post, my new numbers match your numbers. I had used a printout from an earlier version of my program.</p>
</div>
</li>
</ol>
</li>
<li id="comment-580679" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/657785b06699b2cd27bd03ae30858105?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/657785b06699b2cd27bd03ae30858105?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marshall Ward</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-24T23:18:58+00:00">March 24, 2021 at 11:18 pm</time></a> </div>
<div class="comment-content">
<p>Do you know if the perf Linux tool works on the M1s (or any Mac)? It&rsquo;s very easy to inspect performance monitors with perf.</p>
</div>
<ol class="children">
<li id="comment-580682" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-24T23:24:55+00:00">March 24, 2021 at 11:24 pm</time></a> </div>
<div class="comment-content">
<p>The perf Linux tools are tied to the Linux kernel as far as I know so I would not expect them to work when being directly under macOS.</p>
</div>
</li>
</ol>
</li>
<li id="comment-580680" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fd55bf483eadf8e81377407a923df5b8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fd55bf483eadf8e81377407a923df5b8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Frank Astier</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-24T23:22:06+00:00">March 24, 2021 at 11:22 pm</time></a> </div>
<div class="comment-content">
<p>A blog I wrote some time back on CPU frequency scaling, but that was for for a server: <a href="https://medium.com/@ferd/cpu-frequency-scaling-658ed502cba3" rel="nofollow ugc">https://medium.com/@ferd/cpu-frequency-scaling-658ed502cba3</a>.</p>
</div>
<ol class="children">
<li id="comment-580681" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fd55bf483eadf8e81377407a923df5b8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fd55bf483eadf8e81377407a923df5b8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Frank Astier</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-24T23:23:09+00:00">March 24, 2021 at 11:23 pm</time></a> </div>
<div class="comment-content">
<p>Showing effects of thermals.</p>
</div>
</li>
</ol>
</li>
<li id="comment-580704" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c98e795ed14daeb06ac7f311793bb52a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c98e795ed14daeb06ac7f311793bb52a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Pierre B.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-25T00:32:40+00:00">March 25, 2021 at 12:32 am</time></a> </div>
<div class="comment-content">
<p>I found strange that you characterize 7.36 instructions by cycle as &ldquo;close to 8&rdquo;. Maybe you forgot to change this sentence when you updated your numbers?</p>
<p>(There is also a typo in &ldquo;then the time elapsed in often not ideal&rdquo;: i belive the in should be a is. Also earlier &rdquo; it is right measure&rdquo; seems to be missing a &ldquo;the&rdquo;.)</p>
</div>
<ol class="children">
<li id="comment-580724" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5bebde4e761c492dd1fcec6f42d108ff?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5bebde4e761c492dd1fcec6f42d108ff?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dougall Johnson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-25T02:42:45+00:00">March 25, 2021 at 2:42 am</time></a> </div>
<div class="comment-content">
<p>For context, 8 is the absolute maximum possible number for any combination of instructions. Sure, 7.36 is closer to seven, but 92% is really amazingly and surprisingly close to 100% of possible IPC for any real-world code.</p>
</div>
<ol class="children">
<li id="comment-580869" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maynard Handley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-26T04:13:52+00:00">March 26, 2021 at 4:13 am</time></a> </div>
<div class="comment-content">
<p>Also worth noting that what&rsquo;s characterized as the &ldquo;number of instructions&rdquo; is, as far as I can tell, the number of DECODED instructions.<br/>
This is not exactly the same thing as the number of RETIRED instructions because of mis speculation. (I haven&rsquo;t done enough testing to be certain, but I am pretty sure that counter setting (8c) increment in Decode, while the counter that&rsquo;s locked as counter[1] is the number of Retired instructions.</p>
<p>Even putting speculation aside, the M1 does a fascinating job of splitting instructions for some purposes (primarily resource allocation where two registers are required like ldp, or a load or store with a pre/post increment) and then joining them again.<br/>
So for example LDP will count as<br/>
1 for Decode<br/>
2 for Map/Rename (allocate two registers)<br/>
1 for Execute<br/>
2 for Retire (have to deallocate the two registers)</p>
<p>Surprisingly many instructions can be performed at Map time (zero cycle moves, zero cycle immediates). A number of instructions that look like they would split (like ADDS) don&rsquo;t because of a clever way of handling flags. A number of instructions that have to perform two tasks (like ADD(extend) ) split into to ops, but only require one register allocation because the temporary that&rsquo;s generated is snarfed off the bypass bus, and never written out.<br/>
etc etc</p>
<p>The community is still figuring out all the details, but like so much else in computing, the simple models people have of &ldquo;number of instructions executed&rdquo; is not appropriate when you look closely; you have to be much more careful in exactly what you are asking, for what purpose.</p>
</div>
<ol class="children">
<li id="comment-580911" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-26T14:31:59+00:00">March 26, 2021 at 2:31 pm</time></a> </div>
<div class="comment-content">
<p>Thanks. I am aware that the number of instructions is not a precise phrase, especially if you have speculative execution and fused/splitted instructions.</p>
<p>In my particular case, there is not much branch misprediction so it is not a good benchmark to test that effect.</p>
<p>Accessing counter[1] seems to give me the same numbers (or very close).</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-580708" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5bebde4e761c492dd1fcec6f42d108ff?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5bebde4e761c492dd1fcec6f42d108ff?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dougall Johnson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-25T00:56:22+00:00">March 25, 2021 at 12:56 am</time></a> </div>
<div class="comment-content">
<p>Great post &#8211; glad some of that code has been useful!</p>
<p>If it&rsquo;s of interest, these performance events (and the whitelist for this API), are described by Apple at <a href="https://github.com/apple/darwin-xnu/blob/main/osfmk/arm64/kpc.c" rel="nofollow ugc">https://github.com/apple/darwin-xnu/blob/main/osfmk/arm64/kpc.c</a></p>
<p>Counters.app is the official way to access performance counters. I believe it can use a few more (non-whitelisted) events, which are described in /usr/share/kpep/a14.plist</p>
<p>(And, for my own measurements, I use a kernel module to bypass the whitelist, which is even more likely to blow up the computer, and definitely not recommended: <a href="https://github.com/dougallj/applecpu/tree/main/timer-hacks" rel="nofollow ugc">https://github.com/dougallj/applecpu/tree/main/timer-hacks</a> )</p>
</div>
<ol class="children">
<li id="comment-580901" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/28e3a6e2c8201e531d5ea4ff1a1067f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/28e3a6e2c8201e531d5ea4ff1a1067f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Laurent</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-26T12:01:18+00:00">March 26, 2021 at 12:01 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m surprised by the event numbers, they don&rsquo;t match what the Arm Architecture Reference Manual lists (section D7.10).</p>
<p>Are they doing some internal remapping (perhaps to match Intel numbers)?</p>
</div>
</li>
</ol>
</li>
<li id="comment-580732" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/df187c54252fd096504b2ff8390324b4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/df187c54252fd096504b2ff8390324b4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">ibireme</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-25T03:20:53+00:00">March 25, 2021 at 3:20 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve done some reverse engineer work on Xcode, kperf, kperfdata, and wrap the kpc APIs into some simple functions: <a href="https://github.com/ibireme/yybench/blob/master/src/yybench_perf.h" rel="nofollow ugc">https://github.com/ibireme/yybench/blob/master/src/yybench_perf.h</a></p>
</div>
</li>
<li id="comment-626031" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9a740f94e6da659e898343d0af1ddf56?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9a740f94e6da659e898343d0af1ddf56?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ignacio Castano</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-04-07T18:45:37+00:00">April 7, 2022 at 6:45 pm</time></a> </div>
<div class="comment-content">
<p>This is pretty cool, but doesn&rsquo;t seem to work on the M1 Pro. Any idea what needs to be done to make it work? My macbook returns 8 and 6 from kpc_get_counter_count and kpc_get_config_count respectively, but simply fixing those constants still causes kpc_get_thread_counters to fail (even with sudo).</p>
</div>
<ol class="children">
<li id="comment-626054" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maynard Handley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-04-07T21:04:20+00:00">April 7, 2022 at 9:04 pm</time></a> </div>
<div class="comment-content">
<p>Ignacio Castano, if you want you can look at my code at<br/>
<a href="https://github.com/name99-org/AArch64-Explore" rel="nofollow ugc">https://github.com/name99-org/AArch64-Explore</a><br/>
and copy out the stuff that has to do with both wall-time recording and performance monitors. It definitely works on an MBA M1 and the most recent macOS. </p>
<p>Conceivably details may have changed for the Pro, Max, and Ultra? But there&rsquo;s been no chatter about that on Twitter and such.</p>
</div>
</li>
</ol>
</li>
<li id="comment-649340" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f816c0bd5b9723812eeee9934c490fc8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f816c0bd5b9723812eeee9934c490fc8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mike Battaglia</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-18T04:47:48+00:00">February 18, 2023 at 4:47 am</time></a> </div>
<div class="comment-content">
<p>As of 2023, I can&rsquo;t seem to get this to work on a 2021 M1 MBP with an M1 max in it. I get the following (with sudo):</p>
<p><code>wrong fixed counters count<br/>
# parsing random numbers<br/>
model: generate random numbers uniformly in the interval [0.000000,1.000000]<br/>
volume: 10000 floats<br/>
volume = 0.0762939 MB<br/>
strtod 0.00 instructions/float (+/- nan %)<br/>
0.05 cycles/float (+/- 95.9 %)<br/>
0.00 instructions/cycle<br/>
0.00 branches/float (+/- nan %)<br/>
0.0000 mis. branches/float</p>
<p> fastfloat 0.00 instructions/float (+/- nan %)<br/>
0.04 cycles/float (+/- 64.5 %)<br/>
0.00 instructions/cycle<br/>
0.00 branches/float (+/- nan %)<br/>
0.0000 mis. branches/float<br/>
</code></p>
<p>Note that &ldquo;wrong fixed counters count&rdquo;. Is anyone else also getting this and what is the cause?</p>
</div>
<ol class="children">
<li id="comment-649350" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-18T16:06:36+00:00">February 18, 2023 at 4:06 pm</time></a> </div>
<div class="comment-content">
<p>The code in this older blog post is only valid for the M1 processors.</p>
</div>
</li>
</ol>
</li>
<li id="comment-649353" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f816c0bd5b9723812eeee9934c490fc8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f816c0bd5b9723812eeee9934c490fc8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mike Battaglia</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-18T19:10:48+00:00">February 18, 2023 at 7:10 pm</time></a> </div>
<div class="comment-content">
<p>This blog post was written in 2021, and as I said above, this a 2021 MacBook Pro with an M1 Max in it.</p>
<p>When you say &ldquo;M1 Processors&rdquo;, does that not include M1 Max?</p>
</div>
<ol class="children">
<li id="comment-649371" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-19T13:43:49+00:00">February 19, 2023 at 1:43 pm</time></a> </div>
<div class="comment-content">
<p>The M1 Max was made available at the end of October 2021. The blog post you are responding to was published in March 2021. I am pretty sure that when this blog post was written, the existence of the M1 Max wasn&rsquo;t known outside of Apple.</p>
<p>We now have more complete code used in different projects. I will try to write a blog post about it.</p>
</div>
<ol class="children">
<li id="comment-649379" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f816c0bd5b9723812eeee9934c490fc8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f816c0bd5b9723812eeee9934c490fc8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mike Battaglia</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-19T23:22:00+00:00">February 19, 2023 at 11:22 pm</time></a> </div>
<div class="comment-content">
<p>Ok, apologies for the confusion &#8211; if you do write a blog post would love to see how to get this up and running on M1 Max!</p>
</div>
<ol class="children">
<li id="comment-652997" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-15T18:14:52+00:00">July 15, 2023 at 6:14 pm</time></a> </div>
<div class="comment-content">
<p>I did: <a href="https://lemire.me/blog/2023/03/21/counting-cycles-and-instructions-on-arm-based-apple-systems/" rel="ugc">https://lemire.me/blog/2023/03/21/counting-cycles-and-instructions-on-arm-based-apple-systems/</a></p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
