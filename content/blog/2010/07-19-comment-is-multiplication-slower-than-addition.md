---
date: "2010-07-19 12:00:00"
title: "Is multiplication slower than addition?"
index: false
---

[17 thoughts on &ldquo;Is multiplication slower than addition?&rdquo;](/lemire/blog/2010/07-19-is-multiplication-slower-than-addition)

<ol class="comment-list">
<li id="comment-53717" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8221f28456f092aa496959632de8be57?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8221f28456f092aa496959632de8be57?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Francis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-07-19T12:20:03+00:00">July 19, 2010 at 12:20 pm</time></a> </div>
<div class="comment-content">
<p>Unless I am mistaken, the [] operator on an array in C/C++ is a multiplication itself (pointer + (index * sizeof element)). So removing the one multiplication out of the lot might not make a true impact.</p>
<p>The gcc optimizer might also mess with the loop and optimize some things out.</p>
<p>You can remove those [] operators by walking your array with pointer arithmetic (++). Maybe your results would be different.</p>
</div>
</li>
<li id="comment-53718" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-07-19T12:35:35+00:00">July 19, 2010 at 12:35 pm</time></a> </div>
<div class="comment-content">
<p>Using pointer arithmetics does speed things up, but it does not change the conclusion:</p>
<p><a href="http://pastebin.com/d0kgLPwA" rel="nofollow ugc">http://pastebin.com/d0kgLPwA</a></p>
</div>
</li>
<li id="comment-53720" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-07-19T12:56:32+00:00">July 19, 2010 at 12:56 pm</time></a> </div>
<div class="comment-content">
<p>@Thomas In this case, I multiply 64-bit integers.</p>
<p>I&rsquo;m not saying there is no difference at all between multiplications and additions. However, going from two to one multiplications per unit of data might not do you any good.</p>
<p>Basically, I&rsquo;m arguing that it is silly to count the number of multiplications and conclude that whenever you have fewer multiplications, your code is faster. It does not seem to stand true on recent microprocessors.</p>
</div>
<ol class="children">
<li id="comment-282712" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dadde6abc68d13f78c8170d42540967f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dadde6abc68d13f78c8170d42540967f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ben C</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-02T21:20:20+00:00">July 2, 2017 at 9:20 pm</time></a> </div>
<div class="comment-content">
<p>Multiplication is slower, that&rsquo;s a fact. It may not be slower in your situation because of many other issues that allows the Out of Order execution and pipelining to mask the issue.</p>
<p>Intel Skylake has a 1 cycle throughput on the imul instruction, but 3 cycle latency. This means it can process 1 integer multiplication per clock cycle, but you can&rsquo;t access the result for 3 cycles. As long as you don&rsquo;t immediately need to access its value within the next 3 cycles, it will have the &ldquo;same performance&rdquo; as addition. </p>
<p>Addition has a throughput of of 1/3 cycle, meaning it can process 3 adds per clock cycle, but a latency of 1 cycle, which makes sense. If you need to immediately access the result of the computation, addition is 3x faster than multiplication.</p>
</div>
<ol class="children">
<li id="comment-282763" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-03T20:17:56+00:00">July 3, 2017 at 8:17 pm</time></a> </div>
<div class="comment-content">
<p>@Ben</p>
<p><em>in your situation because of many other issues that allows the Out of Order execution and pipelining to mask the issue</em></p>
<p>Processor vendors and compilers have worked hard to mask latency issues. That&rsquo;s why they are rarely a bottleneck (except for memory latency, of course).</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-53719" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/89e850f604368d148203365062089615?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/89e850f604368d148203365062089615?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thomas</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-07-19T12:44:52+00:00">July 19, 2010 at 12:44 pm</time></a> </div>
<div class="comment-content">
<p>Multiplication of what? I suppose you&rsquo;re talking about integers or maybe floats? In defense of the cryptography papers, they probably had (very) large integers in mind, for which I&rsquo;m pretty sure we don&rsquo;t know how to multiply as fast as add.<br/>
Still, good to know there&rsquo;s no time difference for machine words; bust the myth.</p>
</div>
</li>
<li id="comment-53721" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-07-19T13:27:27+00:00">July 19, 2010 at 1:27 pm</time></a> </div>
<div class="comment-content">
<p>Answering this is going to be a bit tricky.</p>
<p>I believe the on-chip hardware for doing one-cycle multiply landed in mass-market CPUs quite a long ways back (much more than ten years). So if you are using a current generation mass-market desktop CPU, likely all you will see is one-cycle execution.</p>
<p>However&#8230;</p>
<p>The one-cycle multiply requires a much larger chunk of chip space than does (say) the more common [add, substract, and, or, xor, shift] operations. The device budget on desktop chips is huge, so the space needed for multiply does not matter.</p>
<p>When the device budget does matter, chip designers make trade-offs.</p>
<p>On some (past?) chips a multiply operation would put a bubble in the pipeline. Where a chip might routinely work one two or three instructions at once, with multiply in the pipeline it might only work on one. A CPU often has more than one unit capable simpler operations, but only one multiplier unit.</p>
<p>If you wrote a micro-benchmark (timing runs of a single instruction, written in assembly), you would find the multiplies take only a single cycle, but everything else runs a bit slower.</p>
<p>As to what exact trade-offs are used by current chip designers, I have no idea. </p>
<p>Chips aimed at low-cost and low-power are more likely to make this sort of trade-off. So you may not see any (or much) difference on a desktop CPU, but the CPU in a cell-phone (or iPad?) might yield more interesting (and different) results. You might also see a difference in designs like Sun&rsquo;s &ldquo;Niagara&rdquo; chip &#8211; where the aim was many CPUs at the most efficient MIPS/power ratio.</p>
</div>
</li>
<li id="comment-53722" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-07-19T13:43:27+00:00">July 19, 2010 at 1:43 pm</time></a> </div>
<div class="comment-content">
<p>Incidental notes&#8230;</p>
<p>Array index references do not necessarily invoke multiply. If the elements in the array are a power-of-two in size, a simple left-shift will suffice. Some CPUs embed the indexing operation into their addressing modes, and so do not even require a separate instruction. (I used to know which, but lost interest in this level much more than a decade back.)</p>
<p>Chip designers spend a lot of time analyzing &ldquo;typical&rdquo; instruction-stream workloads, so to choose the optimal numbers of integer-add, integer-multiply, and floating-point units within the chip. Conversely, you can make a pretty good guess at the intended market segment for a new CPU chip from the relative number of integer and floating point units within each CPU. Gamers, CAD workers, and scientific workloads require more floating point. Web servers have little need for floating point.</p>
</div>
</li>
<li id="comment-53724" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f9066aabfbe4756a4b22f401c7fcf5e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f9066aabfbe4756a4b22f401c7fcf5e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://glinden.blogspot.com/" class="url" rel="ugc external nofollow">Greg Linden</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-07-19T21:24:43+00:00">July 19, 2010 at 9:24 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m not sure I agree with your conclusion, Daniel, at least if your conclusion is that we shouldn&rsquo;t care about multiplications. It may be true that &ldquo;in cryptography, there are many papers on how to trade multiplications for additions, to speed up software.&rdquo; But the higher level point is that, in a tight inner loop that is responsible for most of the run-time of an application, it can be important to squeeze out every last bit of performance in that inner loop. Whether it is done by removing multiplications and whether that still works on modern hardware is irrelevant. The post is to maximize the performance on machines it will run on. Usually, but not always, that means minimizing instructions and maximizing cache hits, but the important thing is to test the changes on actual hardware.</p>
<p>On a related note, did you see &ldquo;You&rsquo;re Doing It Wrong&rdquo; in the July 2010 CACM? Main point of that article is that very little else matters if you are ever hitting disk since they cost the equivalent of millions of instructions. A good point there, and more evidence that what matters for optimization is only what matters, that is, what actually is proven to matter on the hardware on which the code will be running.</p>
</div>
</li>
<li id="comment-53725" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-07-19T22:25:38+00:00">July 19, 2010 at 10:25 pm</time></a> </div>
<div class="comment-content">
<p>@Linden</p>
<p>I&rsquo;m confused about your disagreement. I totally agree with Kamp&rsquo;s paper and with what you are saying : &ldquo;what matters for optimization is only what matters, that is, what actually is proven to matter on the hardware on which the code will be running&rdquo;.</p>
<p>That is why I have this humble quest here on this blog to get people to think about all these truisms we pick up, like &ldquo;multiplication is slower than addition.&rdquo;</p>
</div>
</li>
<li id="comment-53726" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f9066aabfbe4756a4b22f401c7fcf5e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f9066aabfbe4756a4b22f401c7fcf5e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://glinden.blogspot.com/" class="url" rel="ugc external nofollow">Greg Linden</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-07-19T22:42:49+00:00">July 19, 2010 at 10:42 pm</time></a> </div>
<div class="comment-content">
<p>Hi, Daniel. Sorry for my confusion, maybe it is a matter of emphasis. I completely agree that people should not focus on multiplication being slower than addition, but wanted to say what the focus should be on, which is not that we shouldn&rsquo;t worry about multiplication in inner loops, but that we should focus on testing what makes a real difference in performance (and that what often makes the most difference in practice is cache misses or, much worse, hitting disk).</p>
</div>
</li>
<li id="comment-53723" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/97876d03834f4ce1434ac02f45bb2fc7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/97876d03834f4ce1434ac02f45bb2fc7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">JSC</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-07-19T19:52:06+00:00">July 19, 2010 at 7:52 pm</time></a> </div>
<div class="comment-content">
<p>I agree with your conclusion. In my thesis, we were looking at designing efficient byte-aligned coding algorithms, and the old tricks of strength-reduced arithmetic and unwinding showed very little performance improvement. I&rsquo;m pretty sure I discuss this somewhere in the final thesis.</p>
<p>You can now take some of the carefully crafted arithmetic coders of the late 90s which did a lot of work to avoid multiplication and division, simplify them, and get nearly identical performance for the two variants on new hardware. The same definitely wasn&rsquo;t true 10 years ago. </p>
<p>Of course, this may not be true on low power embedded chips. These processors have different design goals, and are clearly the real growth area over the next few years. I haven&rsquo;t done much work with these processors, but would be interested to see if this is a universal or localised phenomenon.</p>
</div>
</li>
<li id="comment-53727" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/512b3d09ef2bb3bff938dcb1647d0b6f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/512b3d09ef2bb3bff938dcb1647d0b6f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Khairul</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-07-20T01:56:00+00:00">July 20, 2010 at 1:56 am</time></a> </div>
<div class="comment-content">
<p>I find it interesting that the Intel Core i7 presents a different timing profile. The Intel Nehalem processor family, in which the Core i7 is a member, has a feature called Turbo Boost which automatically boosts performance on demand based on workload. If not disabled, this feature does appear to invalidate results from benchmarks run in sequence, since later benchmarks will run at higher clock frequencies. Unfortunately, I do not have a Nehalem processor on hand to test this, so I&rsquo;m curious to know whether Turbo Boost was enabled when you ran the benchmarks.</p>
</div>
</li>
<li id="comment-53729" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Devil's advocate</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-07-28T00:44:16+00:00">July 28, 2010 at 12:44 am</time></a> </div>
<div class="comment-content">
<p>With this aren&rsquo;t you mistakenly <a href="http://ubiquity.acm.org/" rel="nofollow">indulging in premature optimization</a>?</p>
</div>
</li>
<li id="comment-53757" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-08-17T10:09:57+00:00">August 17, 2010 at 10:09 am</time></a> </div>
<div class="comment-content">
<p><i>I&rsquo;m arguing that it is silly to count the number of multiplications and conclude that whenever you have fewer multiplications, your code is faster. </i></p>
<p>This is generally not true, because on modern architectures cache miss ratio (both L1/L2 &#8230; and disk cache) may cost much more than adding a few extra operations.</p>
<p>The well known example from searching is a trie (string prefix tree). Even though it performs approximately the same number of operations as a hash, it is often 5-10 times slower.</p>
</div>
</li>
<li id="comment-53758" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-08-17T10:14:40+00:00">August 17, 2010 at 10:14 am</time></a> </div>
<div class="comment-content">
<p><i>I agree with your conclusion. In my thesis, we were looking at designing efficient byte-aligned coding algorithms, and the old tricks of strength-reduced arithmetic and unwinding showed very little performance improvement.</i></p>
<p>JSC, one should be careful to say that unwinding loops does not help on modern architectures. Because it does for many reasons: first it indeed decreases the number of operations. Second, unwinded loops work better with pipelines.</p>
<p>Next, byte-aligned codes do work considerably (2-3 times) faster in many cases.</p>
<p>However, I agree with your opinion on strength-reduced arithmetic. It may not have sense any more in many cases. For instance, because I/O operations may take much longer time.</p>
</div>
</li>
<li id="comment-62181" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/130b55e1d8296fe66fffc9aa25098719?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/130b55e1d8296fe66fffc9aa25098719?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.whatsacreel.net76.net/" class="url" rel="ugc external nofollow">Chris</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-12-15T19:31:12+00:00">December 15, 2012 at 7:31 pm</time></a> </div>
<div class="comment-content">
<p>On my CPU (Phenom II) a 32 bit MUL can retire every clock cycle which seems pretty brisk until you consider that 3 Adds can retire per clock cycle.</p>
</div>
</li>
</ol>
