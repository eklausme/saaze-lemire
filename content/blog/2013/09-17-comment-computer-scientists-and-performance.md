---
date: "2013-09-17 12:00:00"
title: "What do computer scientists know about performance?"
index: false
---

[11 thoughts on &ldquo;What do computer scientists know about performance?&rdquo;](/lemire/blog/2013/09-17-computer-scientists-and-performance)

<ol class="comment-list">
<li id="comment-93680" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5f2716777689db5a800e9cab12812f93?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5f2716777689db5a800e9cab12812f93?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://awelonblue.wordpress.com/" class="url" rel="ugc external nofollow">David Barbour</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-09-17T19:57:05+00:00">September 17, 2013 at 7:57 pm</time></a> </div>
<div class="comment-content">
<p>You speak of performance &lsquo;in the small&rsquo;, e.g. &ldquo;how do I make this map lookup faster&rdquo; instead of &ldquo;can I use precise dataflow analysis to eliminate the intermediate storage for the tuple space?&rdquo; I think this isn&rsquo;t unusual. Computer scientists tend to focus on the problem in front of them, not the larger context. </p>
<p>Unfortunately, this narrow focus a great deal of impedance and inefficiency at larger scales. Often, it is necessary to relinquish &lsquo;local&rsquo; efficiency to improve &lsquo;global&rsquo; efficiency &#8211; e.g. switch from high-performance batch-processing algorithms to lower-performance variations that can be pipelined compositionally.</p>
<p>I think we still have plenty to learn about performance in-the-large. And there is much to gain, especially with regards to removing <a href="http://alarmingdevelopment.org/?p=805" rel="nofollow">walls</a> between <a href="https://pchiusano.blogspot.com/2013/05/the-future-of-software-end-of-apps-and.html" rel="nofollow">applications</a>.</p>
</div>
</li>
<li id="comment-93653" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b751676001ff4a52b48504f2ed1ab043?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b751676001ff4a52b48504f2ed1ab043?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://patricklam.ca" class="url" rel="ugc external nofollow">plam</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-09-17T15:58:11+00:00">September 17, 2013 at 3:58 pm</time></a> </div>
<div class="comment-content">
<p>I teach a fourth-year course which spends time on the constant factors, Programming for Performance. <a href="http://patricklam.ca/p4p" rel="nofollow ugc">http://patricklam.ca/p4p</a>.</p>
</div>
</li>
<li id="comment-93657" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-09-17T16:16:59+00:00">September 17, 2013 at 4:16 pm</time></a> </div>
<div class="comment-content">
<p>@plam </p>
<p>It is obviously a great course. BTW my point is not that there aren&rsquo;t courses in computer science programs about performance.</p>
</div>
</li>
<li id="comment-93686" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/77f083909d955b715846250a33340a14?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/77f083909d955b715846250a33340a14?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://lingpipe-blog.com/" class="url" rel="ugc external nofollow">Bob Carpenter</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-09-17T20:34:05+00:00">September 17, 2013 at 8:34 pm</time></a> </div>
<div class="comment-content">
<p>What I didn&rsquo;t know about performance when I moved from academia to industry was variance. When I was at SpeechWorks, I had to build a parser that ran in under 60ms on average, but never peaked above 200ms. The garbage collector in JavaScript killed us. Everything ran in 20ms on average, but JavaScript kept peaking times at over a minute with garbage collection. So the solution was to rebuild and tear down the virtual machine each call. Took about 20ms, so average run time was now 40ms, and no more bumps from garbage collection.</p>
<p>Similarly, there&rsquo;s a notion of latency vs. bandwidth in accessing disk or solid-state drive or memory or cache or a register that&rsquo;s very very important in real applications, but you tend not to think about a lot in analysis-of-algorithms classes where there&rsquo;s usually a memory abstraction (in both constant-time access and unlimited size).</p>
</div>
</li>
<li id="comment-93691" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/77f083909d955b715846250a33340a14?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/77f083909d955b715846250a33340a14?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://lingpipe-blog.com/" class="url" rel="ugc external nofollow">Bob Carpenter</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-09-17T21:37:30+00:00">September 17, 2013 at 9:37 pm</time></a> </div>
<div class="comment-content">
<p>@David Barbour: Even the basic analysis of algorithms books like Cormen, Leisersohn and Rivest touch on these issues when discussing the motivations for algorithms like B-trees. It blew my mind when I first realized this also applied at the memory level. I at first thought my test harness was misbehaving or something was getting compiled away when I added a bunch more floating point arithmetic per loop and the timing didn&rsquo;t change. It finally dawned on me that my algorithm was memory bound. I don&rsquo;t think many people realize just how expensive cache misses or failed branch predictions are. Large natural language processing models are problematic because on average, every other lookup or so is a cache miss (there&rsquo;s a very long tail, and it&rsquo;s important for prediction).</p>
</div>
</li>
<li id="comment-93851" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8767bd5b599615b306d847e15920f7d1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8767bd5b599615b306d847e15920f7d1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Valrandir</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-09-18T22:16:27+00:00">September 18, 2013 at 10:16 pm</time></a> </div>
<div class="comment-content">
<p>Bob Carpenter, the solution was simply &ldquo;do not use java&rdquo;.</p>
</div>
</li>
<li id="comment-93930" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/77f083909d955b715846250a33340a14?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/77f083909d955b715846250a33340a14?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://lingpipe-blog.com/" class="url" rel="ugc external nofollow">Bob Carpenter</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-09-19T13:44:05+00:00">September 19, 2013 at 1:44 pm</time></a> </div>
<div class="comment-content">
<p>It was JavaScript (aka ECMAScript) wrapped in C, wrapped in C++, and it wasn&rsquo;t me, it was the VoiceXML standard dictating JavaScript. </p>
<p>Java has the same issues as C++ in a lot of ways, but the garbage collector can be a killer.</p>
<p>I&rsquo;m doing numerical analysis these days, and it&rsquo;s all C++ template metaprogramming to move as much computation down to the static (compile time) level as possible.</p>
</div>
</li>
<li id="comment-94909" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/43314a37c30454481331eb4e4c604657?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/43314a37c30454481331eb4e4c604657?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://fpgacpu.ca/" class="url" rel="ugc external nofollow">Eric LaForest</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-09-26T13:36:22+00:00">September 26, 2013 at 1:36 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;&#8230;pipeline width, number of units, throughput and latency of the various instructions, memory latency and bandwidth, CPU caching strategies, CPU branching predictions, instruction reordering, superscalar execution, compiler heuristics and vectorizationâ€¦ and so on.&rdquo;</p>
<p>Maybe I&rsquo;m biased because I went to schools where there is a sharp division between CS and ECE (Waterloo and Toronto), but those factors fall squarely in Computer Engineering, not Science. Not saying they should never intersect, but generally they don&rsquo;t.</p>
</div>
</li>
<li id="comment-94912" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-09-26T14:06:37+00:00">September 26, 2013 at 2:06 pm</time></a> </div>
<div class="comment-content">
<p>@LaForest</p>
<p>How a CPU works is certainly part of a computer science education&#8230; no?</p>
</div>
</li>
<li id="comment-95017" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/43314a37c30454481331eb4e4c604657?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/43314a37c30454481331eb4e4c604657?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://fpgacpu.ca/" class="url" rel="ugc external nofollow">Eric LaForest</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-09-27T09:58:39+00:00">September 27, 2013 at 9:58 am</time></a> </div>
<div class="comment-content">
<p>@Lemire</p>
<p>Not in any micro-architectural detail I think. CS (at UW and UofT, at least) is very much a branch of the Math Dept., not Engineering. So there is mostly emphasis on proofs, not the messy details of actual hardware. </p>
<p>(Again, not saying this is bad, and I&rsquo;m glad *they* can go prove things, and then explain them to me so I can build them. I can&rsquo;t prove my way out of a wet paper bag. 🙂 )</p>
<p>And yes, the knowledge exists, but it&rsquo;s not widespread yet. (re: cache-oblivious algorithms)</p>
<p>Case in point: <a href="https://queue.acm.org/detail.cfm?id=1814327" rel="nofollow ugc">https://queue.acm.org/detail.cfm?id=1814327</a></p>
</div>
</li>
<li id="comment-95018" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-09-27T10:14:51+00:00">September 27, 2013 at 10:14 am</time></a> </div>
<div class="comment-content">
<p>@Eric</p>
<p>Computer scientists have been aware of caching issues for decades. It is a core element of computer science&#8230; part of any sane algorithm textbook. So yes, you have cache-aware and cache-oblivious algorithms. But this is essentially mathematical modelling&#8230; sometimes with little to no validation in the real world.</p>
<p>Poul-Henning Kamp is basically saying what I am saying: that computer scientists don&rsquo;t know nearly as much as they think they do about performance.</p>
<p>Regarding mathematics&#8230; there is an infinite number of results that you can prove. An infinite subset of them will appear interesting to some human beings. It does not mean that coming up with one more mathematical result is a valuable contribution&#8230; if you take &ldquo;valuable&rdquo; as in &ldquo;making people&rsquo;s life better&rdquo;.</p>
</div>
</li>
</ol>
