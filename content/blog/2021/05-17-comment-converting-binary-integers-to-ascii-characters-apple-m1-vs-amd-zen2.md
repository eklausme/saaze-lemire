---
date: "2021-05-17 12:00:00"
title: "Converting binary integers to ASCII characters: Apple M1 vs AMD Zen2"
index: false
---

[9 thoughts on &ldquo;Converting binary integers to ASCII characters: Apple M1 vs AMD Zen2&rdquo;](/lemire/blog/2021/05-17-converting-binary-integers-to-ascii-characters-apple-m1-vs-amd-zen2)

<ol class="comment-list">
<li id="comment-584345" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-17T21:19:09+00:00">May 17, 2021 at 9:19 pm</time></a> </div>
<div class="comment-content">
<p>It is not necessary to do a division for each step: a single multiplication by 10 suffices.</p>
<p>For example, you can interpret a number like 1235 as 0.1235 by setting the decimal point to the left of the highest digit (so-called &ldquo;fixed point&rdquo; representation). Depending on the size of the involved integers, this can be a simple reinterpretation, not requiring any code.</p>
<p>Then, you can extract each digit one at a time by multiplying by 10: <code>0.1235 * 10 = 1.2345</code> and extracting the integer part (the part to the left of the fixed point). You can further optimize this by multiplying by 5 rather than 10, since the final missing factor of two can be rolled into the shift. This is a big advantage on Intel <code>x86</code> since * 5 can be done with a single 1-cycle latency <code>lea</code> instruction.</p>
<p>The approach is covered quite well <a href="https://stackoverflow.com/a/32818030/149138" rel="nofollow ugc">here</a>.</p>
<p>Now the approach you describe only <em>nominally</em> uses a division, but the compiler transforms it into a multiplication: but using the multiplication directly results in fewer instructions and opens up other opportunities for optimization like the <code>lea</code> trick.</p>
<blockquote><p>
Hence, at least in this instance, your best chance of speeding up this<br/>
function is either by dividing by 10 faster (in latency) or else by<br/>
reducing the number of iterations (by processing the data in large<br/>
chunks). The latter is already found in production code.
</p></blockquote>
<p>There&rsquo;s a third way: try for increased ILP within a single conversion. E.g., you could split the number into two and extra one digit from each half per iteration. This does more total work but has two latency chains of half the length (plus some overhead for the splitting and combining). There are several other tricks which decrease the latency at the cost of a bit more work.</p>
</div>
<ol class="children">
<li id="comment-584350" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-17T23:52:05+00:00">May 17, 2021 at 11:52 pm</time></a> </div>
<div class="comment-content">
<p>You are entirely correct, of course, a third way is to try to break down the problem into two (or more) tasks. Thanks for the great link.</p>
</div>
</li>
<li id="comment-610556" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b4436c47c8a6a169e0707eed8b15caa5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b4436c47c8a6a169e0707eed8b15caa5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Not important</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-12-09T14:14:11+00:00">December 9, 2021 at 2:14 pm</time></a> </div>
<div class="comment-content">
<p>Sorry to disturb you by I stumbled on your place while searching for Mac m1 info ! I come from windows , I switched to Mac mini m1 when it came out ! I feel apple do things very differently ! Or have other name , not sure !apple often do things insanelly good in some stuff and bad in other it seem , then I read your post about 64 bit wide vs 128 bit wide ! if i know something it’s that when ms went 64 bit from 32 in 2004 coder had a hard time going to 64 oh they had some data , but going from 32 to 64 bit wide was and even today still is a huge challenge parallel does not seem to be the strength we were thinking it was going to be ! I suspect 2 x 64 bit is likely having same issue ! Like shader ! they end up with these millions of layer , I mean apple did mention to make less layer but old habit die hard ! and now it seem that neural engine play a major role in m1 ! it seem to be the chef d’orquestre of the whole cpu gpu h264 optimisation thing ! do you have basic pointer for the gaming side ? I don’t mean the game themselves , but more like , install tip or ajustement. To be done to the m1 for better experience and performance ! many things are hidden under short cut key often and if you don’t know them ! For that person they don’t exist ! No need to reply to me personally ! maybe eventually you ll get to make a post !</p>
</div>
</li>
</ol>
</li>
<li id="comment-584358" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maynard Handley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-18T02:37:15+00:00">May 18, 2021 at 2:37 am</time></a> </div>
<div class="comment-content">
<p>&ldquo;The Apple M1 processor can retire up to 8 instructions per cycle.&rdquo;</p>
<p>M1 can decode, map, and rename 8 instructions per cycle.</p>
<p>It can retire (as in clear and free) 16 History File entries per cycle (ie free 16 register per cycle)<br/>
It can (I kid you not) retire up to 56(!) instructions from the ROB per cycle.</p>
</div>
<ol class="children">
<li id="comment-584359" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-18T02:52:30+00:00">May 18, 2021 at 2:52 am</time></a> </div>
<div class="comment-content">
<p>Can we verify this with performance counters?</p>
</div>
<ol class="children">
<li id="comment-584362" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-18T04:31:10+00:00">May 18, 2021 at 4:31 am</time></a> </div>
<div class="comment-content">
<p>In any case I think your original statement was correct in a sense: the M1 can <em>sustain</em> retirement of 8 instructions per cycle. Technically, on any given cycle it might retire more, but this is kind of uarch trivia in the sense that <em>sustained</em> retirement will be limited by earlier bottlenecks such as decode.</p>
</div>
<ol class="children">
<li id="comment-584386" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-18T13:22:24+00:00">May 18, 2021 at 1:22 pm</time></a> </div>
<div class="comment-content">
<p>Well, if it is able to retire 10, 20, 30 instructions per cycle even just some of the time, then it suggests that we should be able to see higher-than-8 retired instructions per cycle in some cases using performance counters&#8230; does it not?</p>
</div>
<ol class="children">
<li id="comment-584404" class="comment odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-18T19:32:58+00:00">May 18, 2021 at 7:32 pm</time></a> </div>
<div class="comment-content">
<p>Yes, you can measure it: see <a href="https://twitter.com/trav_downs/status/1380405585015795715" rel="nofollow ugc">here</a> for example.</p>
<p>I just mean that as far as I can tell when you said &ldquo;The Apple M1 processor can retire up to 8 instructions per cycle.&rdquo; you are just using retire as a standin for &ldquo;process&rdquo; or said in another way: &ldquo;The M1 is 8 wide&rdquo; or &ldquo;The M1 has a maximum IPC of 8&rdquo;.</p>
<p>As Maynard points out, the statement isn&rsquo;t strictly true when you refer to &ldquo;retire&rdquo; specifically, because it happens that this process has a larger retirement bandwidth than its width (unlike many x86 processors where retire was the limiting or tied-for-limiting factor). So the spirit of what you said is correct: it can handle up to 8 instructions per cycle, and even though some parts of the pipeline may momentarily exceed that, they will have be preceded by periods of &lt; 8 throughput so the average never exceeds 8.</p>
</div>
<ol class="children">
<li id="comment-584406" class="comment even depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maynard Handley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-18T20:07:55+00:00">May 18, 2021 at 8:07 pm</time></a> </div>
<div class="comment-content">
<p>To add to Travis&rsquo; points:</p>
<p>(a) The big &ldquo;strategic&rdquo; point is that one of the design principles for creating a truly fast CPU is that you want to split the machine into as many independent parts as possible, each connected by queues, and things are working well if those queue are as dynamic as possible &#8212; ideally they should <em>constantly</em> be alternating between almost full (just absorbed a large block of activity) and almost empty (ready to absorb the next block).<br/>
Or to put it differently, designing for mean behavior (mean rate of integer instructions, mean rate of loads, etc) is table stakes; to do substantially better means designing beyond the mean to the standard deviation. Many, dynamic, queues are part of that design principle.</p>
<p>(b) So while the M1 can only sustain 8 instructions per cycle, you want queues that are substantially more ambitious than this.</p>
<p>You want your Fetch queue (sitting between the L1I$ and Decode) to be asynchronous, and able to pull in substantially more than 8 instructions per cycle, to provide a buffer against bad luck (either a jump to the end of a cache line from which you can only pull a few instructions; or a jump that misses L1I completely).</p>
<p>You provide buffers between Rename and (int/fp/loadstore) Scheduling that can accept 8 instructions, even though int scheduling is only 6-wide, and fp and loadstore scheduling are each 4-wide &#8212; so that even in the case of a long burst of int/fp/loadstore you can clear eight instructions out of Decode per cycle and move onto the next eight &#8212; your 8-wide front-end is not throttled by the 6 or 4-wide capacity of your execution core, at least not for shortish (~50 or so) burst lengths.</p>
<p>And you try to clear out the ROB machinery as rapidly as possible after a blocking head -of-ROB clears.<br/>
Naively you might consider this unimportant &#8211; &#8211; unlike the previous cases, there is apparently no compelling reason for the back-end to have to clear faster than it can be fed by the front end.<br/>
The point that is missed by this naive analysis is heterogeneity of resources, and the fact that resources are cleared in order after a blocking head of ROB clears.<br/>
So, suppose the machine has stalled in Rename because it can no longer allocate a physical int register. When the head of ROB clears, registers will start to be freed &#8212; but in-order. And if all the registers cleared in the first cycle are FP registers, that doesn&rsquo;t help the stall in Decode, which doesn&rsquo;t make progress until an int register is freed. That&rsquo;s why we want registers freed at faster than they can be consumed, to deal with this heterogeneity.</p>
<p>The same holds for the ROB proper. Recall that the M1 ROB consists of ~330 rows, each of which can hold up to seven instructions of which one (and only one) can be a failable instruction (ie an instruction that can misspeculate &#8212; a load, store, or branch).<br/>
The throughput constraint is, if you want to be able to process 7 instructions per cycle of exactly the right mix (4 load/store + 3 branches) you have to be able to clear 7 failables from the ROB per cycle.<br/>
In fact Apple clear 8 rows per cycle, of which failables are the important part (you have to test that each one does not in fact result in a flush); the rest are just unimportant detritus at this point.<br/>
Given that the History File (for tracking register dependencies and freeing registers) is a separate structure that operates on its own schedule (of 16 free&rsquo;s per cycle), it&rsquo;s in fact fairly easy to free up lots of the ROB in a single cycle!</p>
<p>(Experts might ask about that three branches claim above &#8212; M1 only has two branch units! True &#8212; but simple branches [non conditional, don&rsquo;t use the link register] &ldquo;execute&rdquo; at Decode, not in a branch unit&#8230;)</p>
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
