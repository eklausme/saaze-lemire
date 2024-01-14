---
date: "2023-04-27 12:00:00"
title: "Hotspot performance engineering fails"
index: false
---

[17 thoughts on &ldquo;Hotspot performance engineering fails&rdquo;](/lemire/blog/2023/04-27-hotspot-performance-engineering-fails)

<ol class="comment-list">
<li id="comment-651367" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1d398fd59a4f724122e5a825999986d0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1d398fd59a4f724122e5a825999986d0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">nonnull</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-27T23:34:53+00:00">April 27, 2023 at 11:34 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
Developers often believe that software performance follows a Pareto distribution: 80% of the running time is spent in 20% of the code. Using this model, you can write most of your code without any care for performance and focus on the narrow pieces of code that are performance sensitive.
</p></blockquote>
<p>This also ignores nonlocal effects. It is entirely possible for all of the following to be true simultaneously:</p>
<p>80% of the time is spent in 20% of the code.<br/>
There is not much more optimization to be squeezed out of said 20% of the code.<br/>
The code can be optimized significantly.</p>
<p>If I write a piece of code that, for instance, temporarily grabs a huge amount of memory and causes the OS to drop most of its page cache as a result, said piece of code can be &ldquo;fast&rdquo; and thus not really show up on profiles&#8230; but its overall effect on the program can be huge.</p>
<p>This sort of aggressor/victim issue shows up all over the place: cpu cache, branch prediction, TLBs, OS page cache (and paging in general), texture cache, disk accesses, atomic contention, hyperthreading, JITter deoptimizations, etc, etc.</p>
<p>I&rsquo;ve seen too much code that is far slower than it could be, because the authors have effectively given up on optimizing it further, in turn because they&rsquo;ve heavily optimized the &ldquo;hot&rdquo; section and ignored the &ldquo;cold&rdquo; sections, missing that the reason the &ldquo;hot&rdquo; section is slow is that it is a victim of the &ldquo;cold&rdquo; sections.</p>
</div>
<ol class="children">
<li id="comment-651404" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e4eb6909b96dda2ef93f91d58c47c219?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e4eb6909b96dda2ef93f91d58c47c219?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Ruben Vorderman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-30T08:02:08+00:00">April 30, 2023 at 8:02 am</time></a> </div>
<div class="comment-content">
<p>I once made a custom hash table implementation as a python function. I used python&rsquo;s c-api to request a function pointer to pythpn&rsquo;s builtin hash function (SipHash). This performed well enough, but I found that using XXHash instead made the function even faster.</p>
<p>Then I started to benchmark the entire program rather than just the function, and the XXHash implementation made it slower. I think this is because python uses its own hash quite a lot (lots of things are python dictionaries under the hood) which kept the has in the L1 instruction cache. By the time my custom hash table function came around, fetching the instruction sequence for XXHash was slower than using python&rsquo;s builtin hash.</p>
<p>So this is exactly as nonnull describes.</p>
<p>Another example is where I benchmarked a python script that did not take into account cache locality by operating one large lists. The slowness did not show up in the profiler. The script took 26 seconds but the cumulative time of all the functions profiled was less than 8. So I rewrote it to perform all the transformations on one item at the time using iterators. That made it 10 times faster.</p>
</div>
</li>
</ol>
</li>
<li id="comment-651374" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a58f3cfd3e777191d56bf5df462ca4b5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a58f3cfd3e777191d56bf5df462ca4b5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Egon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-28T07:49:56+00:00">April 28, 2023 at 7:49 am</time></a> </div>
<div class="comment-content">
<p>I like to think of hotspot optimization as a way of getting closer to the local optimum; however not the global optimum.</p>
<p>One important thing about hotspot optimization is that the initial 2x wins are often trivial changes &#8212; and the sad part is that people don&rsquo;t do those initial optimizations. The &ldquo;trivial thing&rdquo; is usually something like, &ldquo;Oh, you forgot to configure your database connection pooling to allow multiple connections&rdquo;. It&rsquo;s also often not because they don&rsquo;t know how to do the trivial optimization, but because they haven&rsquo;t realized that there is a problem in a first place.</p>
<p>But as you&rsquo;ve said, there&rsquo;s only so far you can go with them. If I don&rsquo;t see an obvious place in the profile to make the small fix, then I&rsquo;ll stop.</p>
</div>
</li>
<li id="comment-651384" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f2ad5497f78310c288c26d22580b7e57?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f2ad5497f78310c288c26d22580b7e57?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Lee</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-28T21:42:21+00:00">April 28, 2023 at 9:42 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;Premature optimization is the root of all&rdquo; evil is sometimes attributed to Hoare, but <a href="https://shreevatsa.wordpress.com/2008/05/16/premature-optimization-is-the-root-of-all-evil/" rel="nofollow ugc">it was Knuth</a>.</p>
</div>
</li>
<li id="comment-651394" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cebdeb0b243aefc1b64012ed1e627495?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cebdeb0b243aefc1b64012ed1e627495?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://agayev@gmail.com" class="url" rel="ugc external nofollow">Abutalib Aghayev</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-29T14:20:07+00:00">April 29, 2023 at 2:20 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,</p>
<p>A fellow academic and a long time reader/fan of your blog here.</p>
<blockquote><p>
The code that handles errors could be quite slow and it would not impact most of your users.
</p></blockquote>
<p>This is a common belief/recommendation that &ldquo;optimizing the error path is unnecessary because it rarely happens&rdquo;. Our research shows that slow error paths can lead to what we call &ldquo;metastable failures&rdquo;. Please see <a href="https://sigops.org/s/conferences/hotos/2021/papers/hotos21-s11-bronson.pdf" rel="nofollow ugc">this paper</a> for a high-level description of these failures, specifically section 2.3, and <a href="https://www.usenix.org/system/files/osdi22-huang-lexiang.pdf" rel="nofollow ugc">this paper</a> for in-the-wild examples. Here&rsquo;s a public example (also cited in the 2nd paper) of a case where slow error path caused a metastable failure: <a href="https://engineering.atspotify.com/2013/06/incident-management-at-spotify/" rel="nofollow ugc">https://engineering.atspotify.com/2013/06/incident-management-at-spotify/</a></p>
<p>Cheers</p>
</div>
<ol class="children">
<li id="comment-651395" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-29T18:44:34+00:00">April 29, 2023 at 6:44 pm</time></a> </div>
<div class="comment-content">
<p>Yes, slow paths can be a vulnerability.</p>
</div>
</li>
</ol>
</li>
<li id="comment-651409" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3fa1cda290fd1e32df23d197346f2751?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3fa1cda290fd1e32df23d197346f2751?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">John McFarlane</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-30T13:13:25+00:00">April 30, 2023 at 1:13 pm</time></a> </div>
<div class="comment-content">
<p>A good idea is decoupling the 80/20 rule from the conclusion that change must be applied to that hot 20% of code.</p>
<p>Another is to broaden the 20/80 rule to data, rather than just code. Profilers can help by highlighting hot data.</p>
</div>
</li>
<li id="comment-651412" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/77616392012639d743a0e9a05563ddbd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/77616392012639d743a0e9a05563ddbd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">jerch</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-30T19:20:50+00:00">April 30, 2023 at 7:20 pm</time></a> </div>
<div class="comment-content">
<p>Have been confronted with the &ldquo;premature optimization&#8230;&rdquo; cite more than once as a sloppy excuse for weak code, worst case was (me) &ldquo;you have there a quadratic runtime, which can be done in linear&rdquo; &#8211; &ldquo;yeah, already figured, but it was more straight forward to code it this way, and btw premature optimization&#8230;&rdquo; &#8211; Haha, well the problem was sleeping for 2 months before it shot back, just when the first real data got processed&#8230;</p>
<p>I always understood Knuth&rsquo;s cite more as a warning not to go down the rabbit hole chasing the last &lt;5% of optimization, which gets harder and harder if the lowing hanging fruits are already fixed. But using it as an excuse not to think about a better approach in the first place is imho just wrong.</p>
<p>Sometimes I wonder if CS courses should emphasize bare metal mechs (computer architecture) &amp; complexity more again, as the knowledge, what a machine really has to do about the data, seems to get thinner. Ofc this is only anecdotical evidence from my side, but it got more of an issue in our local university, when they moved from C to Java as their introduction programming course. &ldquo;The GC will fix that for me&rdquo; is already pretty close to &ldquo;dont make me think&rdquo;. Oh wait there is ChatGPT for the rescue &#8211; isn&rsquo;t it? 😉</p>
</div>
</li>
<li id="comment-651426" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/96f136245a0ce6585ed08387a130f84e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/96f136245a0ce6585ed08387a130f84e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sean Jensen-Grey</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-01T18:26:46+00:00">May 1, 2023 at 6:26 pm</time></a> </div>
<div class="comment-content">
<p>The quote</p>
<blockquote><p>
We should forget about small efficiencies, say about 97% of the time: premature optimization is the root of all evil.
</p></blockquote>
<p>The quote will more context</p>
<blockquote><p>
There is no doubt that the grail of efficiency leads to abuse. Programmers waste enormous amounts of time thinking about, or worrying about, the speed of noncritical parts of their programs, and these attempts at efficiency actually have a strong negative impact when debugging and maintenance are considered. We should forget about small efficiencies, say about 97% of the time: premature optimization is the root of all evil.
</p></blockquote>
<p>Is Knuth from, &ldquo;<a href="https://dl.acm.org/doi/10.1145/356635.356640" rel="nofollow ugc">Structured Programming with go to Statements</a>&rdquo; on page 8 of 41. In the next paragraph the important part that everyone skips.</p>
<blockquote><p>
After working with such tools for seven years, I&rsquo;ve become convinced that all compilers written from now on should be designed to provide all programmers with feedback indicating what parts of their programs are costing the most; indeed, this feedback should be supplied automatically unless it has been specifically turned off.
</p></blockquote>
<p>The Knuth performance quote gets abused almost as often as programmers optimize the wrong things. It doesn&rsquo;t look like Knuth is arguing against architectural efficiency or thinking about performance. The context is optimizing existing code needlessly w/o measuring. And that measuring should be a critical part of developing a system, so much so that it should be always-on.</p>
</div>
<ol class="children">
<li id="comment-651431" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1d398fd59a4f724122e5a825999986d0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1d398fd59a4f724122e5a825999986d0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">nonnull</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-02T00:32:43+00:00">May 2, 2023 at 12:32 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
The context is optimizing existing code needlessly w/o measuring.
</p></blockquote>
<p>The fatal flaw in this approach is that you can have regions of inexpensive code that nevertheless significantly slow down the program overall. (For instance, forcing the OS to drop its page cache.) I talk about this more <a href="https://lemire.me/blog/2023/04/27/hotspot-performance-engineering-fails/#comment-651367" rel="ugc">in my prior comment</a>.)</p>
<p>If you require prior measurement of &ldquo;need&rdquo; to optimize a piece of code, you&rsquo;ll miss things like this and end up in a penny-wise-pound-foolish local optimum, where everything that takes a lot of time has been overoptimized, and yet you are still slow.</p>
</div>
<ol class="children">
<li id="comment-651438" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/77616392012639d743a0e9a05563ddbd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/77616392012639d743a0e9a05563ddbd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">jerch</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-02T10:57:17+00:00">May 2, 2023 at 10:57 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
The fatal flaw in this approach is that you can have regions of inexpensive code that nevertheless significantly slow down the program overall.
</p></blockquote>
<p>Would extend this issue to the whole (operating) system &#8211; in the end everything is fighting over register usage, cache lines, mem pages and so on, and the kernel tries to balance things out from its schedulers. But with wicked code you can raise the kernels runtime significantly (e.g. by sheer syscall pressure or lousy memory handling) &#8211; and the whole system may suffer.</p>
<p>The interesting bit here is the fact, that nowadays performance concerns are much more IO-related, while in the past the processing speed of the CPUs was a big limiting factor, too. We kinda put CPUs on steroids, but somehow the peripherals did not keep up. Which puts a major burden on clever resource management on kernel side.</p>
</div>
<ol class="children">
<li id="comment-651441" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-02T13:55:03+00:00">May 2, 2023 at 1:55 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>The interesting bit here is the fact, that nowadays performance concerns are much more IO-related, while in the past the processing speed of the CPUs was a big limiting factor</p></blockquote>
<p>My impression is that CPU performance has long stagnated due to the failure of Dennard scaling, and the repeated failures of the leader (Intel). However, we kept getting more bandwidth.</p>
<p>In the last decade, our disk IO was multiplied by at least 10. My PlayStation 5 has a 5 GB/s disk. The network speeds also improved by a similar factor.</p>
<p>Our single-processor performance surely did not improve in a similar manner after controlling for prices. That is, you can get a 32-core Intel PC today that will be worth about 10 CPUs from ten years ago, but it is going to be expensive. Of course, GPUs came to the rescue, but GPUs are specialized devices.</p>
</div>
<ol class="children">
<li id="comment-651442" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/77616392012639d743a0e9a05563ddbd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/77616392012639d743a0e9a05563ddbd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">jerch</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-02T15:09:08+00:00">May 2, 2023 at 3:09 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
My impression is that CPU performance has long stagnated due to the failure of Dennard scaling, and the repeated failures of the leader (Intel). However, we kept getting more bandwidth.
</p></blockquote>
<p>Yes true, just looking at the last 10ys we had bigger shifts on IO side. IO lost most of its ground in the 90s and early 2000s and has still way to go.</p>
<p>To me it seems, that most of the M1 success story is IO-related, which may give a glimpse on how bad things are on x86, where we instead get more cache to play with (and the 1001th SIMD instruction). Ofc the M1 has very different production needs and costs with its big-die-approach, no clue if that would even scale for broader industry adoption. However, it seems the M1 was needed to wake up x86 vendors from their slumber.</p>
<p>On a sidenote: I am really curious how the risc-v vector extension with its variable registers will turn out, it reads a bit like the re-invention of old Cray machines.</p>
</div>
<ol class="children">
<li id="comment-651443" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-02T15:31:13+00:00">May 2, 2023 at 3:31 pm</time></a> </div>
<div class="comment-content">
<p><em>To me it seems, that most of the M1 success story is IO-related,</em></p>
<p>The M1 can retire 8 instructions per cycle, something that no x64 can do.</p>
<p>The ARM-based Graviton processors on AWS can beat the best of the Intel server processors on a computational task (parsing URLs): <a href="https://lemire.me/blog/2023/03/01/arm-vs-intel-on-amazons-cloud/" rel="ugc">https://lemire.me/blog/2023/03/01/arm-vs-intel-on-amazons-cloud/</a></p>
<p>I am still very excited about Intel processors, especial AVX-512&#8230;</p>
</div>
<ol class="children">
<li id="comment-651612" class="comment even depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c98e795ed14daeb06ac7f311793bb52a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c98e795ed14daeb06ac7f311793bb52a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Pierre B.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-12T14:57:17+00:00">May 12, 2023 at 2:57 pm</time></a> </div>
<div class="comment-content">
<p>While the fact that M1 can retire 8 instructions per cycle and x86 do not, you surely knows this is a very misleading representation.<br/>
The historical take of x86 on this subject has always been &ldquo;well, our instructions do more per sintruction&rdquo;, which has always been only half-true at best. OTOH, the modern x86 processors convert the x86 instructions to an internal, hidden, instruction architecture, which is what really gets executed. While I believe there is no data sheet that tells us how many of those internal instructions are retired by cycle, simple logic guarantees that the number is higher that the known x86-level instructions per cycles.<br/>
So, it is almost certain that Intel and AMD are retiring just as many instructions per cycles as the M1. It&rsquo;s just that the instructions retired are the internal ones. As proof, one only has to look at the block diagram of such processor: the number of different execution units clearly indicates that they are handling more internal instructions than the IPC numbers indicates.</p>
</div>
<ol class="children">
<li id="comment-651613" class="comment byuser comment-author-lemire bypostauthor odd alt depth-8">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-12T15:56:33+00:00">May 12, 2023 at 3:56 pm</time></a> </div>
<div class="comment-content">
<p><em>it is almost certain that Intel and AMD are retiring just as many instructions per cycles as the M1.</em></p>
<p>I think you meant to refer to micro-operations.</p>
<p>See<br/>
<a href="https://lemire.me/blog/2023/05/12/arm-instructions-do-less-work/" rel="ugc">https://lemire.me/blog/2023/05/12/arm-instructions-do-less-work/</a></p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-654420" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5c18b0377ed13d8094eebeadfb45416d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5c18b0377ed13d8094eebeadfb45416d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">scineram</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-09-01T06:03:01+00:00">September 1, 2023 at 6:03 am</time></a> </div>
<div class="comment-content">
<p>If you keep buying Intel skill issue.</p>
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
