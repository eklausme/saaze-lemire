---
date: "2019-05-19 12:00:00"
title: "Measuring the system clock frequency using loops (Intel and ARM)"
index: false
---

[24 thoughts on &ldquo;Measuring the system clock frequency using loops (Intel and ARM)&rdquo;](/lemire/blog/2019/05-19-measuring-the-system-clock-frequency-using-loops-intel-and-arm)

<ol class="comment-list">
<li id="comment-407511" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-19T00:48:41+00:00">May 19, 2019 at 12:48 am</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t think the 1 vs 2 cycle throughput is related to fusion, but rather a limitation on taken branches per cycle. Probably those CPUs cannot do a branch more than once every two cycles or some similar limitation.</p>
<p>You could test this by unrolling the loop <em>including the branch instruction but not taken for all by the last (make it beq)</em>, I think you get 1 cycle per sub/bne pair even on those CPU once you don&rsquo;t need the loop to have a taken branch every cycle.</p>
<p>Note that Intel CPUs fuse such pairs but also cannot do a taken branch every cycle except in special cases of very small displacement backwards branches, so fusion is no guarantee of one branch per cycle.</p>
</div>
<ol class="children">
<li id="comment-407515" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-19T01:04:06+00:00">May 19, 2019 at 1:04 am</time></a> </div>
<div class="comment-content">
<p>I verified your assertion and it appears correct. The limitation might be in the number of branch taken per cycle.</p>
</div>
</li>
</ol>
</li>
<li id="comment-407661" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5994c4ce4787f18cc38aa61e6d2cff95?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5994c4ce4787f18cc38aa61e6d2cff95?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">DL</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-19T19:15:48+00:00">May 19, 2019 at 7:15 pm</time></a> </div>
<div class="comment-content">
<p>Another way is macros. You can generate a pretty big block of assembly while maintaining readable code. I&rsquo;ve got versions with and without the bne. Sketch of the no bne approach:</p>
<p><code>#define TEN (x) x x x x x x x x x x<br/>
#define HUNDRED (x) TEN(TEN(x))<br/>
#define THOUSAND (x) TEN(HUNDRED(x)) </p>
<p>getFrequency() {<br/>
//start timer here<br/>
for (i=0; i&lt;1000000; i++) {<br/>
//&lt;prolog here&gt;<br/>
THOUSAND(asm("add x0, x0, x0"););<br/>
}<br/>
//stop timer here<br/>
}<br/>
</code></p>
</div>
</li>
<li id="comment-407691" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/02645fccf0e885c607f3d07a4abf4f95?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/02645fccf0e885c607f3d07a4abf4f95?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Saagar Jha</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-19T23:00:10+00:00">May 19, 2019 at 11:00 pm</time></a> </div>
<div class="comment-content">
<p>Instruments provides access to a set of performance counters, including ones such as <code>INST_A64</code> and <code>FIXED_CYCLES</code>: perhaps these could be useful?</p>
</div>
<ol class="children">
<li id="comment-407803" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-20T14:05:12+00:00">May 20, 2019 at 2:05 pm</time></a> </div>
<div class="comment-content">
<p>Does it run in a simulator or on the device? If it can run on the device, then I want to know more.</p>
</div>
<ol class="children">
<li id="comment-407979" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/02645fccf0e885c607f3d07a4abf4f95?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/02645fccf0e885c607f3d07a4abf4f95?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Saagar Jha</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-21T07:26:37+00:00">May 21, 2019 at 7:26 am</time></a> </div>
<div class="comment-content">
<p>This is for a physical device (I tried this on my iPad, which has an A10 &ldquo;Fusion&rdquo; processor, but I don&rsquo;t see why it wouldn&rsquo;t work on an A12); out of the events I tried, I was able to pull information out of <code>FIXED_INSTRUCTIONS</code> and <code>FIXED_CYCLES</code>. To use this, you can connect your device to a Mac and launch Instruments, selecting the &ldquo;Counters&rdquo; template and your device (and profiling app). Then go to File &gt; Recording Options and click the + in the &ldquo;Events and Formulas&rdquo; section, and pick the events you want to measure from there. You should then be able to record your app: in mine, for example, I set it to run a three-instruction loop a billion times and I ended up with a little bit over 3 billion instructions executed total. I&rsquo;m sure it&rsquo;s possible to get more accurate results, but I was having issues getting the recording to work correctly if I didn&rsquo;t call <code>UIApplicationMain</code>, which added overhead. Maybe you can rig up something better?</p>
</div>
<ol class="children">
<li id="comment-408011" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-21T12:08:20+00:00">May 21, 2019 at 12:08 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s interesting but these two metrics are not very helpful if you are looking for the frequency, since neither of them tell you much about actual frequency I expect. Fixed cycle, I would guess, is just a measure of time elapsed. The instruction count is just&#8230; well, the instruction count.</p>
<p>Now, if I had the real number of cycles, that&rsquo;d be great. Combined with the instruction count, that gives me something useful. I need to look into it.</p>
</div>
<ol class="children">
<li id="comment-408017" class="comment odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/02645fccf0e885c607f3d07a4abf4f95?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/02645fccf0e885c607f3d07a4abf4f95?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Saagar Jha</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-21T13:42:56+00:00">May 21, 2019 at 1:42 pm</time></a> </div>
<div class="comment-content">
<p><code>FIXED_CYCLES</code> seems to vary with time in a similar manner to <code>FIXED_INSTRUCTIONS</code>, for what it&rsquo;s worth, and telling Instruments to plot cycles per instruction seems to give something that looks reasonable.</p>
</div>
</li>
<li id="comment-408052" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-21T16:14:24+00:00">May 21, 2019 at 4:14 pm</time></a> </div>
<div class="comment-content">
<p>I think FIXED_CYCLES is CPU cycles, not a fixed real-time counter.</p>
<p>Here &ldquo;FIXED&rdquo; refers to the fact the event can be counted by a dedicated fixed-function counter, rather than a programable one, and not that the cycle period (measured in time) is &ldquo;fixed&rdquo; or anything like that.</p>
</div>
<ol class="children">
<li id="comment-408053" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-21T16:17:45+00:00">May 21, 2019 at 4:17 pm</time></a> </div>
<div class="comment-content">
<p>Yeah. I am going to try to test it out.</p>
</div>
<ol class="children">
<li id="comment-408074" class="comment byuser comment-author-lemire bypostauthor even depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-21T18:34:17+00:00">May 21, 2019 at 6:34 pm</time></a> </div>
<div class="comment-content">
<p>Ok. So FIXED_CYCLE varies over time and it seems to be highly correlated, visually, with the number of instructions per unit of time.</p>
<p>Anyhow, FIXED_INSTRUCTION goes up to 29346274130 whereas FIXED_CYCLES is 9408002514 so that is 3.12 instructions per cycle. That&rsquo;s for the whole program. It is much higher than on x64 where the highest you reach for part of the benchmark is 2.6 instructions per cycle.</p>
</div>
<ol class="children">
<li id="comment-408158" class="comment odd alt depth-8 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/02645fccf0e885c607f3d07a4abf4f95?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/02645fccf0e885c607f3d07a4abf4f95?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Saagar Jha</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-22T05:09:51+00:00">May 22, 2019 at 5:09 am</time></a> </div>
<div class="comment-content">
<p>You may have found this already, but I though I&rsquo;d mention it anyways: you can create your &ldquo;formulas&rdquo; in the view where you add the event counters by clicking on the gear instead of the + button. You can just type in <code>Instructions / Cycles</code> if that&rsquo;s what you were trying to measure, which lets the computer do the work for you instead of you having to do the calculation manually 🙂</p>
</div>
<ol class="children">
<li id="comment-408219" class="comment byuser comment-author-lemire bypostauthor even depth-9 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-22T13:18:44+00:00">May 22, 2019 at 1:18 pm</time></a> </div>
<div class="comment-content">
<p>What I&rsquo;d like even better is a handy way to export the data to a spreadsheet. 🙂</p>
</div>
<ol class="children">
<li id="comment-408608" class="comment odd alt depth-10">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/02645fccf0e885c607f3d07a4abf4f95?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/02645fccf0e885c607f3d07a4abf4f95?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Saagar Jha</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-24T05:41:26+00:00">May 24, 2019 at 5:41 am</time></a> </div>
<div class="comment-content">
<p>Uh, I think you can copy/paste things out of Instruments and get tab-separated data. As for getting the raw data out, I&rsquo;m not sure: you might be able to write a tool that links against some of the frameworks inside of the Instruments app bundle to extract these.</p>
</div>
</article>
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
<li id="comment-408072" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-21T18:26:23+00:00">May 21, 2019 at 6:26 pm</time></a> </div>
<div class="comment-content">
<p>For future reference, your instructions work, but, importantly, you have to indicate that you want to sample by time. Otherwise, if you sample by event, where event is 1,000,000 cycles, then you just record nothing (which I am sure makes sense, but is not explained anywhere).</p>
</div>
<ol class="children">
<li id="comment-408167" class="comment odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/02645fccf0e885c607f3d07a4abf4f95?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/02645fccf0e885c607f3d07a4abf4f95?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Saagar Jha</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-22T05:50:45+00:00">May 22, 2019 at 5:50 am</time></a> </div>
<div class="comment-content">
<p>Yeah, I saw that too where sampling by event didn&rsquo;t seem to produce anything. Mine defaulted to time though so I forgot to mention it.</p>
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
<li id="comment-407719" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-20T04:15:51+00:00">May 20, 2019 at 4:15 am</time></a> </div>
<div class="comment-content">
<p>On Intel processors, there is the TSC register and instruction &#8230; which is pretty damned important. Not clear the current ARM CPUs have an equivalent. Worth spending a bit of thought on the how the TSC can be (very) useful.</p>
</div>
<ol class="children">
<li id="comment-407783" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-20T11:59:24+00:00">May 20, 2019 at 11:59 am</time></a> </div>
<div class="comment-content">
<p>AArch64 has cntvct_el0 which is a fixed frequency counter (typically 50-100MHz) which is useful for accurate timing. Counters that vary with the rapid changing clock frequency are less useful to software.</p>
</div>
<ol class="children">
<li id="comment-407796" class="comment byuser comment-author-lemire bypostauthor even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-20T13:25:09+00:00">May 20, 2019 at 1:25 pm</time></a> </div>
<div class="comment-content">
<p>TSC also runs at a fixed frequency on modern Intel CPUs.</p>
</div>
<ol class="children">
<li id="comment-407851" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-20T17:34:58+00:00">May 20, 2019 at 5:34 pm</time></a> </div>
<div class="comment-content">
<p>I can verify this. Used the TSC to collect ultra-precise timing measurements from a custom Linux device driver. The tick rate is CPU specific (1600 MHz on the target box), and very steady. Has proved extremely useful.</p>
</div>
</li>
</ol>
</li>
<li id="comment-407827" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d5f76116d8d53323eff02ceca5396fdd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d5f76116d8d53323eff02ceca5396fdd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Steve Canon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-20T15:29:04+00:00">May 20, 2019 at 3:29 pm</time></a> </div>
<div class="comment-content">
<p>That depends a lot on what you&rsquo;re actually measuring, and for what purpose. If you&rsquo;re benchmarking an inner compute kernel for tuning with no dependencies on L2 or beyond, you want to isolate that measurement from thermal variation, frequency transients, memory/cache contention, etc. Cycles is great for that purpose.</p>
<p>For tuning or comparing bigger systems, wall clock time (like these fixed-frequency counters provide) in often more meaningful (but beware coherency of such measurements between cores if a process migrates or has multiple threads; what you can count on differs across platforms).</p>
</div>
<ol class="children">
<li id="comment-408007" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-21T11:01:56+00:00">May 21, 2019 at 11:01 am</time></a> </div>
<div class="comment-content">
<p>Indeed, cycles are useful when you&rsquo;re optimizing small kernels. I typically use performance counters to get more detail when trying to figure out what is limiting performance.</p>
<p>But at the end of the day the goal is to reduce total time taken of a complete application.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-407828" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-20T15:37:37+00:00">May 20, 2019 at 3:37 pm</time></a> </div>
<div class="comment-content">
<p>Yeah, but the TSC (and ARM equivalents, I think) all count in &ldquo;real time&rdquo; not &ldquo;CPU clock cycles&rdquo; &#8211;<br/>
that makes them directly useful for ehat most people want (real time measurement, time-stamping, etc), but not <em>directly</em> useful for counting cycles. Still they can serve as the real-time clock part of the calibration.</p>
<p>I usually don&rsquo;t bother because things like the std::chrono clocks and clock_gettime tend to use rdtsc under the covers so I just use the portable alternatives and get most of the rdtsc advantage.</p>
<p>If you want to measure CPU clock cycles directly, you can on Intel but it takes a <code>rdpmc</code> and you have to program the performance counters, so it&rsquo;s definitely a level of difficulty up, and less portable (eg on Windows I still haven&rsquo;t seen a way to access the performance counters without a kernel driver).</p>
</div>
<ol class="children">
<li id="comment-407830" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-20T15:51:47+00:00">May 20, 2019 at 3:51 pm</time></a> </div>
<div class="comment-content">
<p>And I am still waiting for someone to teach me how to setup performance counters on my iPhone. (For all I know, it is possible but held a secret&#8230;)</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
