---
date: "2020-10-20 12:00:00"
title: "Ridiculously fast unicode (UTF-8) validation"
index: false
---

[24 thoughts on &ldquo;Ridiculously fast unicode (UTF-8) validation&rdquo;](/lemire/blog/2020/10-20-ridiculously-fast-unicode-utf-8-validation)

<ol class="comment-list">
<li id="comment-555596" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7162b2123d51b183b31a4dbb6548adaf?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7162b2123d51b183b31a4dbb6548adaf?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://github.com/boostorg/json/" class="url" rel="ugc external nofollow">Vinnie Falco</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-20T16:07:59+00:00">October 20, 2020 at 4:07 pm</time></a> </div>
<div class="comment-content">
<p>First, great work!</p>
<p>This seems to require SSE3. What is the best that can be done using only SSE2? Thanks!</p>
</div>
<ol class="children">
<li id="comment-555603" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-20T16:29:49+00:00">October 20, 2020 at 4:29 pm</time></a> </div>
<div class="comment-content">
<p><em>This seems to require SSE3. What is the best that can be done using only SSE2? Thanks!</em></p>
<p>On Intel processors, you need SSSE3 which came out in 2006. Unfortunately, I do not have access to hardware that old. I think that the oldest x64 processor I have is the Jaguar in my PS4 and it has SSSE3. Even old embedded Intel Atom processors have SSSE3.</p>
<p>My expectation is that a processor so old as to not support SSSE3 would not be supported by Windows 10.</p>
<p>What types of computers are you working on? Pentium 4 systems maybe? From a legacy architecture?</p>
</div>
<ol class="children">
<li id="comment-555612" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/99a0953560f19307e405df13740d887e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/99a0953560f19307e405df13740d887e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://gsnedders.com" class="url" rel="ugc external nofollow">Sam Sneddon</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-20T18:05:51+00:00">October 20, 2020 at 6:05 pm</time></a> </div>
<div class="comment-content">
<p>Windows 10 only requires SSE2, FWIW, and plenty of consumer software still targets SSE2 as its baseline.</p>
<p>The <a href="https://store.steampowered.com/hwsurvey" rel="nofollow ugc">Steam Hardware Survey</a> shows 98.88% support for SSSE3 (versus 100% for SSE2, which I believe is inevitable given Steam requires SSE2), so it&rsquo;s not totally universal ever today. (And Steam users possibly have quicker hardware than on average?)</p>
</div>
<ol class="children">
<li id="comment-555621" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-20T18:47:52+00:00">October 20, 2020 at 6:47 pm</time></a> </div>
<div class="comment-content">
<p>*Windows 10 only requires SSE2 (&#8230;) The Steam Hardware Survey shows 98.88% support for SSSE3 *</p>
<p>The same survey shows that Windows 10 represents 89% of all OSes with somewhere between 5% to 10% of PCs running older versions of Windows. Out of the 1.2% of folks with PCs that fail to support SSSE3, what fraction of them run on Windows 10? I&rsquo;d guess a small fraction, certainly less than 1%. My understanding is that Microsoft only commits to supporting Windows 10 on hardware that falls within an OEM support agreement. It is almost certainly the case that a system that does not have SSSE3 is not part of a supported licence agreement with Microsoft. No matter how you look at it, we are talking about the legacy tail end.</p>
<p><em>(And Steam users possibly have quicker hardware than on average?)</em></p>
<p>I am sure that&rsquo;s true. My sons&rsquo; school runs on Windows 2000. And a University I will not name runs its infrastructure on Windows NT. It is still legacy. Do not expect big exciting contracts building high speed software for Windows 2000. These customers using Windows 2000 are not shopping for new software to improve the performance of their machines.</p>
<p>You are absolutely not going to 100% SSE2 out in the real world. In fact, you have many 16-bit x86 software systems out there. There are people running companies on Apple II computers or the like.</p>
<p>There are many people who will laugh at the idea of using anything so modern as C++, and let us not even get into recent standards. C99 is esoteric. They are coding in C with a vendor-supplied compiler that has not seen any update in 20 years.</p>
<p>There is no end to the tail end&#8230; it goes far back and will always do so.</p>
<p>But do not for a minute think that you are going to spin out a 20-year old system and run Doom in your browser.</p>
</div>
<ol class="children">
<li id="comment-555691" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9549113c77c249a66c9042ab36b22217?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9549113c77c249a66c9042ab36b22217?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dave</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-21T05:28:05+00:00">October 21, 2020 at 5:28 am</time></a> </div>
<div class="comment-content">
<p>Can you provide some evidence? Some of these examples are flirting with a gossipy tone that suggests campfire stories, while others are simply irrelevant and would never be considered in scope of the &ldquo;100%&rdquo; target.</p>
</div>
<ol class="children">
<li id="comment-555730" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-21T13:52:21+00:00">October 21, 2020 at 1:52 pm</time></a> </div>
<div class="comment-content">
<p><em>Can you provide some evidence?</em></p>
<p>Evidence of what?</p>
<p>That some people run 16-bit software to this day? Come on. Live a little&#8230; go in the underbelly of large and old organizations. Just google about how one can run 16-bit applications under Windows 10. There is plenty of discussions on the topic.</p>
<p>Pascal code written in the 1980s is still the backbone of large organizations.</p>
<p>But even Pascal is too modern for some. <a href="https://www.npr.org/2020/04/22/841682627/cobol-cowboys-aim-to-rescue-sluggish-state-unemployment-systems" rel="nofollow ugc">Look at this 2020 article</a> about unemployment system and ATM still relying on COBOL code from people long since retired.</p>
<p>That people use really old computers to run businesses? <a href="https://gizmodo.com/this-old-ass-commodore-64-is-still-being-used-to-run-an-1787196319" rel="nofollow ugc">See this 2016 article about a business relying on a Commodore 64</a>.</p>
<p>Schools that still run Windows 2000 or Windows NT? <a href="https://www.quora.com/Do-people-still-use-Windows-NT-4-0/answer/Tim-Browne-12" rel="nofollow ugc">Here is an answer on Quora from 2018</a>:</p>
<blockquote>
<p>they where still running 5 NT 4 servers on machines with P2<br/>
processors, 2 IBM Thinkcentres running NT4 workstation and about 10<br/>
PC’s running XP. Unbelievable. Looking at the dates on the system, I<br/>
think some of the NT4 servers where installed in 2004.</p>
</blockquote>
<p>That you are not going to get 100% SSE2 in the real world on x86 processors? <a href="https://www.romanstefko.com/pale-moon-sse/" rel="nofollow ugc">There are people maintaining Firefox forks for CPUs without SSE</a>.</p>
<p>Look at this quote from the COBOL article&#8230;</p>
<blockquote>
<p>Some COBOL experts bristle at state leaders&rsquo; blaming current backlogs<br/>
of unemployment claims on a lack of coders. (&#8230;) The explanation,<br/>
they say, is that governments have not updated the bulky and sluggish<br/>
computers that run on COBOL, according to Derek Britton, product<br/>
director at England-based Micro Focus, which helps clients navigate<br/>
such updates.</p>
</blockquote>
<p>Do you think that the bulky and slugglish computers they refer to have SSE2 support? No, they do not.</p>
<p>If you doubt that there are really old systems still running today, they have simply never worked for an old conservative organization. Period.</p>
<p>The legacy tail end is very long.</p>
</div>
</li>
<li id="comment-555978" class="comment even depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e07b34170d1c6e17b43add44715e5ac2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e07b34170d1c6e17b43add44715e5ac2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">minirop</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-24T15:28:31+00:00">October 24, 2020 at 3:28 pm</time></a> </div>
<div class="comment-content">
<p>One of Paris&rsquo; airports had to shutdown for several hours in 2015 because a computer crashed. They were running windows 3.1.</p>
</div>
<ol class="children">
<li id="comment-555988" class="comment byuser comment-author-lemire bypostauthor odd alt depth-7">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-24T17:58:05+00:00">October 24, 2020 at 5:58 pm</time></a> </div>
<div class="comment-content">
<p>Reference: <a href="https://www.zdnet.com/article/a-23-year-old-windows-3-1-system-failure-crashed-paris-airport/" rel="nofollow ugc">https://www.zdnet.com/article/a-23-year-old-windows-3-1-system-failure-crashed-paris-airport/</a></p>
<p>The article reminds us that the US military still relies on floppy drives.</p>
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
<li id="comment-555686" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-21T04:56:37+00:00">October 21, 2020 at 4:56 am</time></a> </div>
<div class="comment-content">
<p>AMD K10 (Phenom, Phenom II and similar) was the last uArch to not support SSSE3. I think they were first released in 2007 and the last ones were released around 2010 (the 6 core Phenom IIs, and probably some APUs).</p>
<p>The CPUs were fairly popular in the day, as they were good value, and its successor, AMD&rsquo;s Bulldozer line, often performed worse, so many people kept buying K10s even after BD&rsquo;s release. As such, there&rsquo;s still quite a number of them around (in fact, I have one right here &#8211; mostly for testing SSE2 fallback performance).</p>
<p>Note that while the early Atoms (and AMD Bobcat) <em>supported</em> SSSE3, PSHUFB performance on them was fairly poor (5-6 cycle recip. throughput). Still, PSHUFB is difficult to emulate on SSE2, and you may be better of falling back to scalar code there.</p>
</div>
<ol class="children">
<li id="comment-555727" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-21T13:26:04+00:00">October 21, 2020 at 1:26 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for the informative comment.</p>
<p><em>Still, PSHUFB is difficult to emulate on SSE2, and you may be better of falling back to scalar code there.</em></p>
<p>Right. If someone follows my advice regarding production use, that is what is going to happen. If you are using 10-year old processors from AMD, you will get a fallback code routine that should serve you well, but will be nowhere close to what a Zen 2 can do.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-555607" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-20T17:26:21+00:00">October 20, 2020 at 5:26 pm</time></a> </div>
<div class="comment-content">
<p>To answer more directly your question, if someone has legacy hardware, I would not bother with any of software optimization. It is seems misplaced to try to optimize software for hardware that cannot be purchased anymore.</p>
<p>Software and hardware are in a closed loop of self-improvements. We upgrade the hardware, then upgrade the software to benefit from the hardware which further motivates new hardware, and so forth.</p>
<p>People are willing to pay large extra for relatively small gains. A 20% boost in hardware performance often translates into twice the price or more. To these people, who pay extra for small performance gains, the added software performance is valuable.</p>
<p>The counterpart to this observation is that for applications where the extra cost of upgrading your server every decade is too much, we can infer that the value of software performance is low.</p>
<p>If you are in a cost minimization routine, that is you are willing to trade hardware performance for low cost, then you probably want to do as few software upgrades as you can. My view is that if you have legacy hardware, you are probably well served with older software.</p>
</div>
</li>
</ol>
</li>
<li id="comment-555624" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a38054904e39e36fab7c4d779abf3752?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a38054904e39e36fab7c4d779abf3752?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://ian.mckellar.org/" class="url" rel="ugc external nofollow">Ian McKellar</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-20T19:13:14+00:00">October 20, 2020 at 7:13 pm</time></a> </div>
<div class="comment-content">
<p><a href="https://travisdowns.github.io/blog/2020/01/17/avxfreq1.html" rel="nofollow ugc">Travis Downs&rsquo;s tests</a> indicate that simply touching the upper 128 bits of an AVX register will trigger a (latency inducing) voltage transition. Did you observe that? This kind of fear has kept me from chasing SIMD acceleration of UTF-8 validation that&rsquo;s in the middle of a bunch of other work.</p>
</div>
<ol class="children">
<li id="comment-555625" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-20T19:19:52+00:00">October 20, 2020 at 7:19 pm</time></a> </div>
<div class="comment-content">
<p>Let me see if I can get Travis to answer this&#8230; Pinging him on Twitter now.</p>
</div>
</li>
<li id="comment-555631" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-20T19:54:49+00:00">October 20, 2020 at 7:54 pm</time></a> </div>
<div class="comment-content">
<p>Well this is a one time cost, so it is hard to measure it in any type of &ldquo;typical&rdquo; benchmark which executes the code under test millions of times. E.g., if your benchmark runs for at least 10 milliseconds (most run much longer), a transition period of 20 us (at the high end of what I measured) would add only 0.2% to the benchmark and be totally lost in the noise.</p>
<p>Furthermore, any benchmark which does any type of &ldquo;warmup&rdquo; iteration and doesn&rsquo;t include this in the timing would never see the effect at all.</p>
<p>Overall, I don&rsquo;t expect the transition timing to make much of a difference in most use cases that care about &ldquo;milliseconds&rdquo; (rather than nano or microseconds) or about throughput. The max throughput loss is small and the max latency penalty is small. Only people who might lose a bunch of money for occasional latency spikes in the order of 10s of microseconds are likely to care.</p>
<p>This is different from (but related to) <em>frequency downclocking</em>, where the CPU runs at a lower frequency for a significant period of time: this is a more significant effect and more people would care about this, but you aren&rsquo;t likely to experience it just by using 256-bit instructions.</p>
<p>Finally, you might not care about this at all in the context of the algorithms presented here because you expect the rest of your binary to already be full of 256-bit instructions, as it will be if you compile with the CPU architecture set to something modern like <code>-march=skylake</code> or <code>-march=native</code> (the latter depending on where you compile it).</p>
</div>
<ol class="children">
<li id="comment-555636" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-20T20:13:03+00:00">October 20, 2020 at 8:13 pm</time></a> </div>
<div class="comment-content">
<p>Thanks Travis. Certainly a better answer than what I could have come up with.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-555639" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ad4ee71956de6520a70d92a93b0ad145?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ad4ee71956de6520a70d92a93b0ad145?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Antoine</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-20T20:49:13+00:00">October 20, 2020 at 8:49 pm</time></a> </div>
<div class="comment-content">
<p>I wonder why Intel, who likes creating new instructions all the time, didn&rsquo;t create a couple of instructions for vectorized UTF8 parsing and validation. It should be cheap in hardware resources, and UTF8 is here to stay.</p>
</div>
<ol class="children">
<li id="comment-555642" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-20T21:07:35+00:00">October 20, 2020 at 9:07 pm</time></a> </div>
<div class="comment-content">
<p>They did create string comparisons functions and it did not end well.</p>
<p>In the broader scheme of things, you are right that hardware support for UTF-8 is not at all silly. In fact, I bet it already exists&#8230; just not in mainstream Intel processors.</p>
</div>
</li>
</ol>
</li>
<li id="comment-555644" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/77845fecafba9044f7a810251dec3d9d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/77845fecafba9044f7a810251dec3d9d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tom</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-20T21:27:47+00:00">October 20, 2020 at 9:27 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
A value in the range 0 to 16 is sometimes called a nibble
</p></blockquote>
<p>Did you mean &ldquo;0 to 15&rdquo;? Or is range meant to be right-open (&ldquo;[0, 16)&rdquo;)?</p>
</div>
<ol class="children">
<li id="comment-555646" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-20T21:36:19+00:00">October 20, 2020 at 9:36 pm</time></a> </div>
<div class="comment-content">
<p>I had [0, 16) in mind, yes.</p>
</div>
</li>
</ol>
</li>
<li id="comment-555651" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://twitter.com/srchvrs" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-20T22:15:19+00:00">October 20, 2020 at 10:15 pm</time></a> </div>
<div class="comment-content">
<p>Great work, as usual!</p>
</div>
</li>
<li id="comment-580521" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7162b2123d51b183b31a4dbb6548adaf?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7162b2123d51b183b31a4dbb6548adaf?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://boost.org" class="url" rel="ugc external nofollow">Vinnie Falco</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-23T15:42:23+00:00">March 23, 2021 at 3:42 pm</time></a> </div>
<div class="comment-content">
<p>The benefit of SSE2 is that you can assume it is available. The problem with SSE3 is that you have to write a bit of application prolog code which checks for whether or not SSE3 is available, at runtime. And then you need to provide a non-SSE3 implementation if necessary. This adds an additional run-time check. And it makes designing the library more difficult because you have a global variable (&ldquo;static bool isSSE3Available;&rdquo;). This is done with a &ldquo;magic static&rdquo; which adds costs.</p>
</div>
<ol class="children">
<li id="comment-580524" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-23T16:41:10+00:00">March 23, 2021 at 4:41 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>The benefit of SSE2 is that you can assume it is available.</p>
</blockquote>
<p>Of course, there are many more ARM systems than there are SSE2 systems.</p>
</div>
</li>
</ol>
</li>
<li id="comment-656370" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d3832d1a47249613c3ad9269443a1b62?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d3832d1a47249613c3ad9269443a1b62?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">265 993 303</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-26T18:12:40+00:00">November 26, 2023 at 6:12 pm</time></a> </div>
<div class="comment-content">
<p>It really just shows that UTF-16 is a much simpler encoding to deal with. Only 2 different encoding lengths and only mismatched surrogates are error, not 4 different encoding lengths and all those pesky combinations of two and three and four byte mismatches, overlong sequence rejecting, etc. a total of 13 different error cases in UTF-8. It is also easier to parse a minus sign by checking for 0x2212 than checking three consecutive bytes. UTF-8 is the bloatware text encoding.</p>
</div>
<ol class="children">
<li id="comment-656375" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-26T20:17:03+00:00">November 26, 2023 at 8:17 pm</time></a> </div>
<div class="comment-content">
<p>UTF-16 is definitively simpler.</p>
</div>
</li>
</ol>
</li>
</ol>
