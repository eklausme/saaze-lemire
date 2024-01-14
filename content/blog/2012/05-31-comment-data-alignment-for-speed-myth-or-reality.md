---
date: "2012-05-31 12:00:00"
title: "Data alignment for speed: myth or reality?"
index: false
---

[53 thoughts on &ldquo;Data alignment for speed: myth or reality?&rdquo;](/lemire/blog/2012/05-31-data-alignment-for-speed-myth-or-reality)

<ol class="comment-list">
<li id="comment-55271" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-05-31T12:08:13+00:00">May 31, 2012 at 12:08 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,</p>
<p>You are testing this using new hardware. I asked the very same question in 2009 and in 2011. </p>
<p>Results are speaking for themselves. This is not just a fluke. Intel did change the architecture.</p>
<p>Then in 2009:<br/>
time 33837 us -&gt; 0%<br/>
time 47012 us -&gt; 38%<br/>
time 47065 us -&gt; 39%<br/>
time 47001 us -&gt; 38%<br/>
time 33788 us -&gt; 0%<br/>
time 47018 us -&gt; 39%<br/>
time 47049 us -&gt; 39%<br/>
time 47014 us -&gt; 39% </p>
<p>Now in 2011:</p>
<p>time 89400 us -&gt; 0%<br/>
time 90374 us -&gt; 1%<br/>
time 90299 us -&gt; 1%<br/>
time 90365 us -&gt; 1%<br/>
time 89348 us -&gt; 0%<br/>
time 90672 us -&gt; 1%<br/>
time 90372 us -&gt; 1%<br/>
time 90318 us -&gt; 1%</p>
</div>
</li>
<li id="comment-55272" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/89e850f604368d148203365062089615?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/89e850f604368d148203365062089615?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Thomas</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-05-31T12:33:41+00:00">May 31, 2012 at 12:33 pm</time></a> </div>
<div class="comment-content">
<p>Interesting.<br/>
The version of the myth that I heard said the slowdown was because the processor will have to do two aligned reads and then construct the unaligned read from that. If I read your code correctly, you&rsquo;re accessing memory sequentially. In that case, the extra reads might not hit memory. If the compiler figures it out, there might not even be extra reads. Well, actually, I don&rsquo;t really know what I&rsquo;m talking about with these low-level things. Still. I&rsquo;m not saying your test is wrong, but it is always important to be careful about what you&rsquo;re actually testing and how that generalises.</p>
<p>That said, these low-level tests you&rsquo;re posting are really cool :). Thanks.</p>
</div>
<ol class="children">
<li id="comment-592580" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0ba57886380485febe3117271f21b582?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0ba57886380485febe3117271f21b582?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Henry</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-29T23:51:01+00:00">July 29, 2021 at 11:51 pm</time></a> </div>
<div class="comment-content">
<p>Maybe that&rsquo;s the point though. Maybe cache behavior and cache-line alignment (rather than word alignment) is the dominant factor here.</p>
<p>It raises the question whether, on some processors, you could get good results by scrapping word alignment all together and just worrying about cache.</p>
</div>
<ol class="children">
<li id="comment-598390" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maynard+Handley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-09-19T00:59:18+00:00">September 19, 2021 at 12:59 am</time></a> </div>
<div class="comment-content">
<p>What people commenting on this are missing is that the &ldquo;addressable&rdquo; units of a cache may be different from what you think.</p>
<p>It&rsquo;s natural to believe that the basic unit of a cache is the cache line (say 64B) and that reading from that is like reading from an array. But in fact most designs split a cache line into multiple smaller pieces that are somewhat independently addressable, either for power reasons or for banking reasons (ie to allow multiple independent accesses into the same line in a cycle).<br/>
Intel up till, I think Sandy Bridge, banked by 8B units (ie imagine the stack of cache lines 64B wide, split them at 8B boundaries, and these 8 sub-arrays form 8 independently addressable banks). This was subject to frequent (ie noticeable) bank collisions (two accesses want to hit the same bank, perhaps in the same row, perhaps in different rows). This was somehow improved in Sandy Bridge and later &#8212; though apparently it&rsquo;s still based on 8B wide units, and details remain uncertain/unknown.</p>
<p>It&rsquo;s not clear, in such a design, that a load that crosses two banks would automatically cost no extra cycles (perhaps the logic to shift and stitch two loads together might require an extra cycle). This is even more true in really old (by our standards) designs which can sustain only one access (or perhaps one load and one store) per cycle, so may have to run the load twice to get the two pieces before stitching them.</p>
<p>In the case of Apple (this is probably just as true of other manufacturers) we can see from the patent record how they do this.</p>
<p>Apple has two attempts:<br/>
The first is 2005 <a href="https://patents.google.com/patent/US8117404B2" rel="nofollow ugc">https://patents.google.com/patent/US8117404B2</a>.<br/>
Notable features are<br/>
&#8211; use of a predictor to track loads or stores that will cross cache line boundaries<br/>
&#8211; if the predictor fires then crack the instruction into three parts that load low, load high, and stitch.<br/>
In other words<br/>
&#8211; already at this stage (2005) the problem is when crossing a line. Within line is not a problem &#8212; we&rsquo;ll see why.<br/>
&#8211; crossing a line is handled slowly but by reusing existing CPU functionality.</p>
<p>The 2011 patent, <a href="https://patents.google.com/patent/US9131899B2" rel="nofollow ugc">https://patents.google.com/patent/US9131899B2</a> , is much more slick. Here the important parts are:<br/>
&#8211; the cache is defined as two banks, one holding even lines, one holding odd lines. Regardless of their interior sub-banking, these two banks can be accessed in parallel.<br/>
&#8211; the array holding <em>addresses</em> for the store queue has a structure that can also describe both an even line and an odd line, with the store data held in a separate array.</p>
<p>These mean that<br/>
&#8211; a load that straddles lines (and in the usual case of both lines in cache) can access both banks in parallel and pick up the data, and stitch it within cycle time. ie you don&rsquo;t even pay a penalty for crossing cache lines.<br/>
&#8211; a load that hits in store queue can, likewise, do the equivalent of probing for address matches in the even and odd halves of line address space to detect presence of matching non-aligned stores.<br/>
&#8211; there is also a piece of auxiliary storage (the &ldquo;sidecar&rdquo;) to hold parts of the load for the truly horror story cases like part of the load from a line in cache, part in DRAM, or a short store that crosses a cache boundary and is within a large load that also crosses a cache boundary (so some data from store queue, some data from L1D).</p>
<p>So almost all cases pay no latency cost, though they will pay a bandwidth cost (since the loads will use two &ldquo;units&rdquo; of the limited bandwidth to the cache). I believe that a transaction that crosses a page will pay a one cycle latency cost because the TB will have to be hit twice, but I have not validated that.</p>
<p>The reason I started (for Apple) with cache line crossings is that the Apple sub-arrays within the two banks are remarkably short!<br/>
(2014) <a href="https://patents.google.com/patent/US9448936B2" rel="nofollow ugc">https://patents.google.com/patent/US9448936B2</a><br/>
describes them as being one byte wide. This means (among other things) that stores can happen concurrently with loads to the same line, as long as they touch different bytes, and that is the focus of the patent.<br/>
As far as I can tell experimentally (though the full picture still remains murky) this is true as of the M1, except that the minimal width is the double-byte not the single byte.</p>
<p>In other words, whereas the Intel history was something like<br/>
&#8211; extract all the data from an 8B unit &#8212; that will cover an aligned 8B load and many misaligned shorter loads, then<br/>
&#8211; expand that to, in one cycle, extract from two 8B units and stitch</p>
<p>the Apple history was more like<br/>
&#8211; from the beginning, figure out which sub-banks (ie which bytes within a line) to activate and<br/>
&#8211; how to route the bytes collected from those sub-banks to the load store unit</p>
<p>What seems like a reasonable compromise, or an easy extension, in each case depends on your starting point &#8212; in this case &ldquo;aggregating bytes&rdquo; vs &ldquo;de-aggregating oct-bytes&rdquo;.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-55273" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/89e850f604368d148203365062089615?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/89e850f604368d148203365062089615?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thomas</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-05-31T12:40:04+00:00">May 31, 2012 at 12:40 pm</time></a> </div>
<div class="comment-content">
<p>Ah, from the page you linked to: &ldquo;On the Sandy Bridge, there is no performance penalty for reading or writing misaligned memory operands, except for the fact that it uses more cache banks so that the risk of cache conflicts is higher when the operand is misaligned. Store-to-load forwarding also works with misaligned operands in most cases.&rdquo;<br/>
Sorry for commenting before reading the linked material ;).</p>
</div>
</li>
<li id="comment-55282" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ce048be9728fbb8dc496f58b92f9f91b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ce048be9728fbb8dc496f58b92f9f91b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://plus.google.com/+LaurentGauthier/posts" class="url" rel="ugc external nofollow">Laurent Gauthier</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-05-31T17:49:27+00:00">May 31, 2012 at 5:49 pm</time></a> </div>
<div class="comment-content">
<p>Daniel,</p>
<p>I do not agree with your comment saying that it is a cache issue. All the memory used in this test is most likely in the cache.</p>
<p>It really is a case of two 256-bit wide read instead of one the word you are reading is crossing the boundary.</p>
<p>(Note: I guess it is 256-bit wide, it might really be 128-bit wide reads, its just that 256-bit wide reads seems more likely)</p>
</div>
</li>
<li id="comment-55274" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-05-31T12:52:45+00:00">May 31, 2012 at 12:52 pm</time></a> </div>
<div class="comment-content">
<p>@Thomas </p>
<p>Thanks for the good words.</p>
<p>I agree that you have to be careful, but that is why I post all my source code. If I&rsquo;m wrong, then someone can hopefully show it by tweaking my experiment.</p>
</div>
</li>
<li id="comment-55275" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-05-31T13:06:52+00:00">May 31, 2012 at 1:06 pm</time></a> </div>
<div class="comment-content">
<p>Testing this is going to be tricky. Last I looked closely, CPUs fetch and cache chunks of words from memory. So unaligned sequential access are going to make no extra trips to memory (for the most part). If the cache handles misaligned references efficiently, then you might see little or no cost to misaligned access.</p>
<p>If a misaligned reference crosses a chunk boundary, so that two chunks are pulled from memory, and only a single word is used of the two chunks, then you might see a considerable cost.</p>
<p>Without building in knowledge of specific CPUs, you could construct a test. Allocate a buffer much larger than CPU cache. Access a single word, bump the pointer by a power of two, increasing the exponent on each sweep of the buffer (until the stride is bigger than the cache line). Repeat the set of sweeps, bumping the starting index by one byte, until the starting index exceeds a cache line. (You are going to have to lookup the biggest cache line for any CPU you test.)</p>
<p>What I expect you to see is that most sweeps are fairly uniform, with spikes where a misaligned access crosses a cache line boundary. </p>
<p>What that means (if true) is that most misaligned access will cost you very little, with the occasional optimally cache misaligned joker. (Requires the right starting offset and stride.)</p>
<p>Still worth some attention, but much less likely you will get bit.</p>
</div>
</li>
<li id="comment-55276" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/89e850f604368d148203365062089615?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/89e850f604368d148203365062089615?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thomas</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-05-31T13:15:29+00:00">May 31, 2012 at 1:15 pm</time></a> </div>
<div class="comment-content">
<p>This cache-chunk business sounds reasonable, but luckily also sounds like it might be relatively rare. And then you would care for cache-chunk alignedness, not something like word alignedness.</p>
<p>I just had a look at the disassembly of an optimised build by Visual Studio 10. It looks to me like it is indeed doing unaligned reads. </p>
<p>p.s.: It seems to have unrolled the Rabin-Karp-like loop 5(?!) times.</p>
</div>
</li>
<li id="comment-55277" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-05-31T13:17:42+00:00">May 31, 2012 at 1:17 pm</time></a> </div>
<div class="comment-content">
<p>@Thomas</p>
<p>5 times?</p>
</div>
</li>
<li id="comment-55278" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/89e850f604368d148203365062089615?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/89e850f604368d148203365062089615?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thomas</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-05-31T13:21:01+00:00">May 31, 2012 at 1:21 pm</time></a> </div>
<div class="comment-content">
<p>Right, I guess &ldquo;unrolled 5 times&rdquo; doesn&rsquo;t mean what I wanted to say. I mean: it does 5 iterations, then jump back.</p>
</div>
</li>
<li id="comment-55279" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-05-31T13:33:31+00:00">May 31, 2012 at 1:33 pm</time></a> </div>
<div class="comment-content">
<p>Thomas,</p>
<p>BTW, unrolling loops did not get you a performance boost either. In the case of new hardware, in most situations.</p>
</div>
</li>
<li id="comment-55280" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-05-31T14:13:50+00:00">May 31, 2012 at 2:13 pm</time></a> </div>
<div class="comment-content">
<p>For most general random logic, this is unlikely to bite. The special cases are a *little* less unlikely than they appear. Power-of-two sized structures are not at all unlikely for some sorts of large problems. Accessing only the first or last word of a block is a common pattern. If the block start is misaligned, and the block is a multiple of a cache line size &#8230; you could get bit.</p>
</div>
</li>
<li id="comment-55281" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-05-31T17:36:16+00:00">May 31, 2012 at 5:36 pm</time></a> </div>
<div class="comment-content">
<p>@Bannister</p>
<p>There is now an example closely related to your analysis in github. I have also updated my blog post accordingly.</p>
</div>
</li>
<li id="comment-55283" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-05-31T20:32:21+00:00">May 31, 2012 at 8:32 pm</time></a> </div>
<div class="comment-content">
<p>@Laurent </p>
<p>I have removed the misleading comment.</p>
</div>
</li>
<li id="comment-55284" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ef46915ca77ac4200ee279e9e7274ce?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ef46915ca77ac4200ee279e9e7274ce?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">A. Non</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-02T13:39:55+00:00">June 2, 2012 at 1:39 pm</time></a> </div>
<div class="comment-content">
<p>The speed of unaligned access is architecture-dependent. On the DEC Alphas, it would slow down your program by immense amounts because each unaligned access generated an interrupt. Since we don&rsquo;t know what the future holds, its best to design your programs so they have aligned accesses when possible. After all, unaligned access has NEVER been faster than aligned access.</p>
</div>
</li>
<li id="comment-55288" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-04T08:45:07+00:00">June 4, 2012 at 8:45 am</time></a> </div>
<div class="comment-content">
<p>@A. Non</p>
<p>Certainly, avoiding unaligned accesses makes your code more portable, but if you are programming in C/C++ with performance in mind, you are probably making many portability trade-offs anyhow (e.g., using SSE instructions).</p>
</div>
</li>
<li id="comment-55289" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Yifei</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-04T20:01:38+00:00">June 4, 2012 at 8:01 pm</time></a> </div>
<div class="comment-content">
<p>if other operations in your code is slower than memory access, then most of the time is spent on the other operations, so you can&rsquo;t see the difference between align vs un-align. </p>
<p>In your source code, the other operation is the multiply.</p>
<p>You can try memory copy instead &#8212; use a for loop to copy an array manually.</p>
</div>
</li>
<li id="comment-55290" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-04T20:31:25+00:00">June 4, 2012 at 8:31 pm</time></a> </div>
<div class="comment-content">
<p>@Yifei</p>
<p>After disabling the multiplication, I get the same sort of result.</p>
<p>Multiplication over integers is not expensive on modern processors due to pipelining.</p>
</div>
</li>
<li id="comment-55292" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6b34a2a81515583dc95e5c0809db06bb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6b34a2a81515583dc95e5c0809db06bb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.craig-wood.com/nick/" class="url" rel="ugc external nofollow">Nick Craig-Wood</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-06T11:40:12+00:00">June 6, 2012 at 11:40 am</time></a> </div>
<div class="comment-content">
<p>Interesting article thanks!</p>
<p>I used to do a lot of ARM coding, and from what I remember exactly what the ARM does on a unaligned access depends on how the supporting hardware has been set up.</p>
<p>You can either get an abort which then gives the kernel an opportunity to fixup the nonaligned access in software (very slow!)</p>
<p>Or you can read a byte rotated word, so if you read a word at offset 1 you would read the 32 byte word at offset 0 but rotated by 8 bits. That was actually useful sometimes!</p>
<p>I&rsquo;m not sure about newer ARMs though.</p>
</div>
</li>
<li id="comment-64397" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/859fba845f1fcb23ced3ecd457cca7e4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/859fba845f1fcb23ced3ecd457cca7e4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://aleccolocco.blogspot.com" class="url" rel="ugc external nofollow">Alecco</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-07T11:06:25+00:00">January 7, 2013 at 11:06 am</time></a> </div>
<div class="comment-content">
<p>DarkShikari has some great insight on this issue, 4 years ago now.</p>
<p>Cacheline splits, aka Intel hell (Feb 2008)<br/>
<a href="http://x264dev.multimedia.cx/archives/8" rel="nofollow ugc">http://x264dev.multimedia.cx/archives/8</a></p>
<p>Nehalem optimizations: the powerful new Core i7 (Nov 2008)<br/>
<a href="http://x264dev.multimedia.cx/archives/51" rel="nofollow ugc">http://x264dev.multimedia.cx/archives/51</a></p>
</div>
</li>
<li id="comment-76413" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://rsaxvc.net" class="url" rel="ugc external nofollow">Richard</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-18T00:52:13+00:00">March 18, 2013 at 12:52 am</time></a> </div>
<div class="comment-content">
<p>You need to include stdint.h before using uintptr_t.</p>
</div>
</li>
<li id="comment-218888" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bf402f309d40d607a369395e32a984fc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bf402f309d40d607a369395e32a984fc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://hgomersall.wordpress.com" class="url" rel="ugc external nofollow">Henry Gomersall</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-12-24T15:22:03+00:00">December 24, 2015 at 3:22 pm</time></a> </div>
<div class="comment-content">
<p>This is an interesting post. I did a related analysis a little while ago looking at the specific case of speeding up convolution (very much a real world example):<br/>
<a href="https://hgomersall.wordpress.com/2012/11/02/speedy-fast-1d-convolution-with-sse/" rel="nofollow ugc">https://hgomersall.wordpress.com/2012/11/02/speedy-fast-1d-convolution-with-sse/</a><br/>
and code here:<br/>
<a href="https://github.com/hgomersall/SSE-convolution" rel="nofollow ugc">https://github.com/hgomersall/SSE-convolution</a></p>
<p>Even with modern hardware (an i7-5600), there is a substantial improvement (~20%) when aligned loads are used in the inner loop, at least for SSE instructions, even when additional necessary array copies are factored in.</p>
<p>In my example, I compared SSE initially but extended it to AVX (in the code), though without repeating the aligned vs unaligned experiments., though it turns out the benefit is not so apparent when going to 256 byte alignment from 128 byte alignemt (the half alignment is good enough for AVX).</p>
</div>
<ol class="children">
<li id="comment-218891" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-12-24T15:33:43+00:00">December 24, 2015 at 3:33 pm</time></a> </div>
<div class="comment-content">
<p>Interesting. Can you point me directly to two functions where the only difference is that one uses aligned load SSE instructions and the other one uses unaligned load instructions? What I see in convolve.c is a function using unaligned loads, but it seemingly relies on a different (more sophisticated) algorithm.</p>
</div>
<ol class="children">
<li id="comment-219107" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bf402f309d40d607a369395e32a984fc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bf402f309d40d607a369395e32a984fc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://hgomersall.wordpress.com" class="url" rel="ugc external nofollow">Henry Gomersall</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-12-25T13:27:33+00:00">December 25, 2015 at 1:27 pm</time></a> </div>
<div class="comment-content">
<p>I extended my code a bit to test some additional cases.</p>
<p>It seems that the results show that aligned SSE is important (compare `convolve_sse_partial_unroll` and `convolve_sse_in_aligned`) but aligned AVX makes very little difference (`convolve_avx_unrolled_vector` versus `convolve_avx_unrolled_vector_unaligned`).</p>
<p>The fastest I can achieve is pretty close to the maximum theoretical throughput (about 90% of the peak clock speed * 8 flops), which is using the unaligned load, which agrees with your assessment that alignment is pretty unimportant &#8211; this is the `convolve_avx_unrolled_vector_unaligned` case.</p>
<p>It&rsquo;s interesting that the SSE operations don&rsquo;t benefit from the better AVX unaligned loads.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-221931" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1e84aa6ea78576f1783e45837e2c89fb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1e84aa6ea78576f1783e45837e2c89fb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Olumide</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-01-13T22:09:47+00:00">January 13, 2016 at 10:09 pm</time></a> </div>
<div class="comment-content">
<p>I too did not really believe that misaligned data could significantly affect runtimes until I fixed the alignment of my data structures and the performance jumped by about 750% (from about 3.9 seconds to 0.04 seconds). </p>
<p>What&rsquo;s more interesting is that I fixed the alignment by changing from floats to doubles on a Intel i7 (64 bit) which made all my data structures and data (doubles) have the same 8 byte alignment (sometimes more is more). Using floats (4 byte aligned) meant that my data was unaligned with the other data structures. Alignment matters. Intel says so. Please stop suggesting otherwise.</p>
</div>
<ol class="children">
<li id="comment-221933" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-01-13T22:30:17+00:00">January 13, 2016 at 10:30 pm</time></a> </div>
<div class="comment-content">
<p>Can you share a code sample that shows that by changing data alignment, you are able to multiply by 100 the speed (from 4 s to 0.04 s)?</p>
<p>Please keep the data types the same. Alignment and data types are distinct concerns.</p>
</div>
</li>
</ol>
</li>
<li id="comment-224455" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d8615afdf832f6b608593e53134ed148?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d8615afdf832f6b608593e53134ed148?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stan Chang</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-01-30T02:08:22+00:00">January 30, 2016 at 2:08 am</time></a> </div>
<div class="comment-content">
<p>Coming from embedded side with older processors such as MIPS32 and PPC, properly aligned data structure was de facto.<br/>
Seeing is believing, both test results (<a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2012/05/31/test.cpp" rel="nofollow ugc">https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2012/05/31/test.cpp</a> and <a href="https://www.ibm.com/developerworks/library/pa-dalign/" rel="nofollow ugc">https://www.ibm.com/developerworks/library/pa-dalign/</a>) showed no noticeable differences on PPC e500v2 and Xeon E5-2660 v2, whether or not aligned.<br/>
However, per <a href="https://software.intel.com/en-us/articles/data-alignment-when-migrating-to-64-bit-intel-architecture" rel="nofollow ugc">https://software.intel.com/en-us/articles/data-alignment-when-migrating-to-64-bit-intel-architecture</a>, &lsquo;The fundamental rule of data alignment is that the safest (and most widely supported) approach relies on what Intel terms &ldquo;the natural boundaries.&rdquo;&lsquo;<br/>
Very interesting! Thanks for sharing.</p>
</div>
</li>
<li id="comment-235387" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/295e3d00a4acd43cf88aca34a5ee4c75?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/295e3d00a4acd43cf88aca34a5ee4c75?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">David Bailey</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-04-10T11:03:33+00:00">April 10, 2016 at 11:03 am</time></a> </div>
<div class="comment-content">
<p>Daniel,</p>
<p>Thanks for that! I have long felt that alignment requirements spoiled computing because they aren&rsquo;t just issues for compiler writers, they complicate general programming as well. For example, a structure containing 32-bit integers and doubles is no longer just a collection of adjacent items, gaps are inserted to maintain alignment.</p>
<p>To me (I am a bit long in the tooth) they remind me of the way many architectures used to divide memory into segments. This structure was supposedly useful, but it gradually became clear that the disruption as you crossed a segment boundary was definitely not useful!</p>
<p>I hope computer architectures soon evolve into being totally alignment free &#8211; including operations such as MULPD, which actually faults if the data isn&rsquo;t 16-byte aligned, even though the individual data items are 8-bytes long!</p>
</div>
</li>
<li id="comment-263951" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/619a84eb8c7dbab15564bf7afc795e4f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/619a84eb8c7dbab15564bf7afc795e4f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ras</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-28T10:26:37+00:00">December 28, 2016 at 10:26 am</time></a> </div>
<div class="comment-content">
<p>please consider the bellowing pages:<br/>
<a href="https://software.intel.com/en-us/articles/coding-for-performance-data-alignment-and-structures" rel="nofollow ugc">https://software.intel.com/en-us/articles/coding-for-performance-data-alignment-and-structures</a></p>
<p><a href="http://www.geeksforgeeks.org/structure-member-alignment-padding-and-data-packing/" rel="nofollow ugc">http://www.geeksforgeeks.org/structure-member-alignment-padding-and-data-packing/</a></p>
<p><a href="http://www.catb.org/esr/structure-packing/#_padding" rel="nofollow ugc">http://www.catb.org/esr/structure-packing/#_padding</a></p>
</div>
</li>
<li id="comment-265546" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/63245d5cd991930632468aa326103e8b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/63245d5cd991930632468aa326103e8b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Matthieu M.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-11T16:27:33+00:00">January 11, 2017 at 4:27 pm</time></a> </div>
<div class="comment-content">
<p>Note: unaligned access has an impact beyond performance, though.</p>
<p>Specifically, the C and C++ Standard specify that unaligned access is Undefined Behavior. This, in turn, means that a C++ compiler can reasonably expect that if `int` is 4-bytes aligned, then an `int*` has an address divisible by 4.</p>
<p>At the very least, I remember an instance of gcc optimizing away the &ldquo;misalignment checks&rdquo; performed on an `int*`, which in turn resulted in accessing an array out-of-bounds (because it did not have a number of bytes divisible by 4).</p>
<p>I would be very wary of using unaligned access directly in C or C++, unless specifically supported by the compiler (packed structures). Assembly can get away with it, but in C and C++ it&rsquo;s dangerous.</p>
</div>
<ol class="children">
<li id="comment-265547" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-11T17:07:30+00:00">January 11, 2017 at 5:07 pm</time></a> </div>
<div class="comment-content">
<p>@Matthieu</p>
<p>A very good point: it is potentially unsafe in C even if the underlying hardware is happy with unaligned loads and stores. But you can make it safe by calling memcpy which gcc will translate into a load on an x64 machine, without performance penalty.</p>
</div>
</li>
</ol>
</li>
<li id="comment-267069" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d3de2189b2843b5dafaadc2dbb175eec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d3de2189b2843b5dafaadc2dbb175eec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Steve</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-21T09:43:42+00:00">January 21, 2017 at 9:43 am</time></a> </div>
<div class="comment-content">
<p>Cross cache line locked instructions are a nightmare, particularly with multiple cores hitting the same cache line.</p>
</div>
<ol class="children">
<li id="comment-267584" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-23T15:56:12+00:00">January 23, 2017 at 3:56 pm</time></a> </div>
<div class="comment-content">
<p>@Steve</p>
<p>Can you provide a benchmark?</p>
</div>
<ol class="children">
<li id="comment-267824" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2b9e36b791f355865074f0d87488061e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2b9e36b791f355865074f0d87488061e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Steve</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-24T10:58:37+00:00">January 24, 2017 at 10:58 am</time></a> </div>
<div class="comment-content">
<p>Pastebin isn&rsquo;t my favorite, but it&rsquo;s late&#8230; Updated test.cpp: <a href="http://pastebin.com/EqtvpZeS" rel="nofollow ugc">http://pastebin.com/EqtvpZeS</a></p>
<p>Speaking of it being late, this may have, uh, errors in it. Inline asm isn&rsquo;t really meant to be written half-asleep.</p>
<p>Anyway, the results:<br/>
&ldquo;&rdquo;&rdquo;<br/>
processing word of size 4<br/>
&#8230;<br/>
average time for offset 60 is 1.4<br/>
&#8230;<br/>
average time for offset 61 is 102<br/>
&ldquo;&rdquo;&rdquo;</p>
<p>Superficially, I&rsquo;d call this a factor of 70, but I distrust my lack of samples. Certainly, at least an order of magnitude slow down, and this is without intercpu conflicts.</p>
</div>
<ol class="children">
<li id="comment-267826" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2b9e36b791f355865074f0d87488061e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2b9e36b791f355865074f0d87488061e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Steve</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-24T11:05:36+00:00">January 24, 2017 at 11:05 am</time></a> </div>
<div class="comment-content">
<p>Forgot to specify: CPUID says my CPU has 64-byte cache lines. Not sure this really changes on Intel CPUs often, but in case it has, it&rsquo;s worth checking /proc/cpuinfo or whatever your platform provides.</p>
</div>
<ol class="children">
<li id="comment-267859" class="comment byuser comment-author-lemire bypostauthor even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-24T13:52:22+00:00">January 24, 2017 at 1:52 pm</time></a> </div>
<div class="comment-content">
<p>All x64 processors seem to have a 64-byte cache line.</p>
</div>
</li>
</ol>
</li>
<li id="comment-267867" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-24T14:21:20+00:00">January 24, 2017 at 2:21 pm</time></a> </div>
<div class="comment-content">
<p>I had no trouble reproducing your results, thanks.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-279525" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/08aae9fc37cf83ed24da488a581a6ed0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/08aae9fc37cf83ed24da488a581a6ed0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cev Ing</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-10T07:43:57+00:00">May 10, 2017 at 7:43 am</time></a> </div>
<div class="comment-content">
<p>This is a really silly test, because alignment can not be tested with a C or C++ compiler, because the compiler is free to align the data in any way he wants. The compiler produces only aligned instruction. This test can only be done in an assembly language. Processor manufacturers explain in detail the penalty of unaligned code:</p>
<p><a href="http://infocenter.arm.com/help/index.jsp?topic=/com.arm.doc.ddi0439b/CHDIJAFG.html" rel="nofollow ugc">http://infocenter.arm.com/help/index.jsp?topic=/com.arm.doc.ddi0439b/CHDIJAFG.html</a></p>
<p>Unaligned word or halfword loads or stores add penalty cycles. A byte aligned halfword load or store adds one extra cycle to perform the operation as two bytes. A halfword aligned word load or store adds one extra cycle to perform the operation as two halfwords. A byte-aligned word load or store adds two extra cycles to perform the operation as a byte, a halfword, and a byte.</p>
</div>
<ol class="children">
<li id="comment-279548" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-10T16:03:56+00:00">May 10, 2017 at 4:03 pm</time></a> </div>
<div class="comment-content">
<p>You are linking to the documentation of 7-year-old ARM microcontroller processor whereas my blog post explicitly addresses x86 processors.</p>
<p>There are certainly microcontroller processors made today where unaligned loads are not an option. That&rsquo;s not what my blog post is about.</p>
<p><em> The compiler produces only aligned instruction. This test can only be done in an assembly language. </em></p>
<p>Keeping in mind that my blog post addresses x86 processors and not, say, microcontrollers, which instruction would that be? The compiler generates <tt>mov</tt> which is what I&rsquo;d use in assembly. What else would you use?</p>
</div>
</li>
</ol>
</li>
<li id="comment-294529" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a3eddbb3c2598249d3f331190e10e09f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a3eddbb3c2598249d3f331190e10e09f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">doubleday</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-05T18:19:54+00:00">January 5, 2018 at 6:19 pm</time></a> </div>
<div class="comment-content">
<p>&gt;&gt; because alignment can not be tested with a C or C++ compiler</p>
<p>you might want to google `alignas` &#8230;</p>
</div>
</li>
<li id="comment-294833" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7943eecf9b2ecb88daaad4b181217360?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7943eecf9b2ecb88daaad4b181217360?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">archimede</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-12T03:10:21+00:00">January 12, 2018 at 3:10 am</time></a> </div>
<div class="comment-content">
<p>For correct measurements:</p>
<p>1) Taking the time has a cost. You need to repeat the experiment multiple times without stopping the timer, then divide by the number of repetitions.<br/>
2) Tye vector size should fit in L1 cache. This seems ok in your code.<br/>
3) The loop should be carried out with intrinsic s which explicitly use aligned or unaligned load instructions which cross the cache line.</p>
</div>
<ol class="children">
<li id="comment-294834" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7943eecf9b2ecb88daaad4b181217360?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7943eecf9b2ecb88daaad4b181217360?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">archimede</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-12T03:11:39+00:00">January 12, 2018 at 3:11 am</time></a> </div>
<div class="comment-content">
<p>To be more clear: you need to use simd instructions!</p>
</div>
</li>
</ol>
</li>
<li id="comment-301589" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/14d5cef9d2549ed933b1dd68bf8cabe1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/14d5cef9d2549ed933b1dd68bf8cabe1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">John Campbell</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-25T11:35:22+00:00">April 25, 2018 at 11:35 am</time></a> </div>
<div class="comment-content">
<p>Interesting to read your comments on the alignment &ldquo;myth&rdquo;. I have also not been able to reproduce performance delays due to alignment on i5 &amp; i7 processors.<br/>
I do wonder if 8-byte reals that span memory pages could have problems, but they are low probability events.<br/>
Problems of 8-byte, 16-byte or 32-byte alignment are also posed for real*8 AVX calculations, although I also can&rsquo;t demonstrate these.<br/>
My conclusion is : by far the most significant issue for AVX performance is having the values in cache (which cache?), rather than their memory alignment.</p>
</div>
<ol class="children">
<li id="comment-301683" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-26T15:28:00+00:00">April 26, 2018 at 3:28 pm</time></a> </div>
<div class="comment-content">
<p><em>by far the most significant issue for AVX performance is having the values in cache (which cache?), rather than their memory alignment.</em></p>
<p>Right. With AVX you can produce scenarios where alignment matters&#8230; but in real code, I think it can be safely ignored as an issue. It is unlikely that alignment is ever going to be a bottleneck.</p>
</div>
</li>
</ol>
</li>
<li id="comment-360520" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/15fe007069bda6ed5318ed74fc2ec794?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/15fe007069bda6ed5318ed74fc2ec794?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marc Lehmann</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-28T03:10:02+00:00">October 28, 2018 at 3:10 am</time></a> </div>
<div class="comment-content">
<p>Indeed, newer intel chips do not suffer from noteworthy alignment penalties.</p>
<p>However, a lot of people who come here or refer to this article use it to make the (wrong) claim that you can make unaligned accesses in C or C++, and indeed, the C++ program presented here might crash due to illegal unaligned accesses, even on X86 or similar architectures.</p>
<p>The reason is that compilers for those architectures can (and regularly) assume proper alignment for types, and can take advantage of instructions that require alignment (which exist even on X86, mostly in the form of SIMD insns). The reason why it almost always works is because compilers in the past rarely took advantage of these instructions, but this is rapdily changing, causing more and more unaligned accesses to crash.</p>
<p>One correct way to make an unaligned access in C or C++ is using memcpy, i.e. instead of:</p>
<p>val = *unaligned_uint64_t_ptr;</p>
<p>You do:</p>
<p>memcpy (val, unaligned_uint64_t_ptr, sizeof (val));</p>
<p>This works on any architecture (that has uint7_t :), and usually is optimized into an instruction guaranteed to support unaligned accesses on X86/X86_64, so doe snot typically incur a speed penalty.</p>
</div>
<ol class="children">
<li id="comment-360626" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-28T16:21:49+00:00">October 28, 2018 at 4:21 pm</time></a> </div>
<div class="comment-content">
<p>This is correct, one should use memcpy to avoid undefined behavior and possible bugs.</p>
<p>My code presented here is not technically correct though it does get the job done.</p>
</div>
<ol class="children">
<li id="comment-360700" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/44f7c1d6b13ed02642e8098bcec7990c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/44f7c1d6b13ed02642e8098bcec7990c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marc Lehmann</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-28T23:46:26+00:00">October 28, 2018 at 11:46 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s my point &#8211; your code only gets the job done with compiler extensions, specifically, it must not optimize too much and must not take future CPUs into account. It is a bad example on how to take advantage of unaligned accesses, even if it is immaterial to the point you are making.</p>
<p>Or to put it differently, since your code invokes undefined behaviour, it&rsquo;s not actually proving your point, your measurement is flawed, even if it happens to give correct results accidentally &#8211; but who knows what the code really does&#8230;</p>
</div>
<ol class="children">
<li id="comment-360861" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-29T18:08:53+00:00">October 29, 2018 at 6:08 pm</time></a> </div>
<div class="comment-content">
<p>I agree with you.</p>
<p>In this instance, we have looked at the assembly code, so we know that it does what we think it does because we have looked at the assembly code.</p>
<p>If I had to redo this post and the code, I would definitively use memcpy.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-429135" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4790a4fbaa1f7666b52d96a78f5a056f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4790a4fbaa1f7666b52d96a78f5a056f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Guilherme</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-27T12:58:06+00:00">September 27, 2019 at 12:58 pm</time></a> </div>
<div class="comment-content">
<p>Hi, I&rsquo;ve run your tests and it seems that the unaligned is actually faster than aligned (?). I am on a Mid 2015 Macbook Pro.</p>
<p><code>➜ data-alignment-test gcc -Ofast -o bench_alignment_unaligned bench_alignment_unaligned.c<br/>
bench_alignment_unaligned.c:75:45: warning: format specifies type 'int' but the argument has type<br/>
'unsigned long' [-Wformat]<br/>
printf("result = %d, time = %d\n", result, ((end-start)/CLOCKS_PER_SEC));<br/>
~~ ^~~~~~~~~~~~~~~~~~~~~~~~~~~~<br/>
%lu<br/>
1 warning generated.<br/>
➜ data-alignment-test gcc -Ofast -o bench_alignment bench_alignment.c<br/>
bench_alignment.c:73:45: warning: format specifies type 'int' but the argument has type<br/>
'unsigned long' [-Wformat]<br/>
printf("result = %d, time = %d\n", result, ((end-start)/CLOCKS_PER_SEC));<br/>
~~ ^~~~~~~~~~~~~~~~~~~~~~~~~~~~<br/>
%lu<br/>
1 warning generated.<br/>
➜ data-alignment-test ./bench_alignment<br/>
result = -886424448, time = 38<br/>
➜ data-alignment-test ./bench_alignment_unaligned<br/>
result = -889155136, time = 27<br/>
</code></p>
</div>
</li>
<li id="comment-581204" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7241c07b5e6a92c24c2e3e2af011153b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7241c07b5e6a92c24c2e3e2af011153b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Frank</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-30T17:28:44+00:00">March 30, 2021 at 5:28 pm</time></a> </div>
<div class="comment-content">
<p>Generally speaking, I&rsquo;ve always written C to be as portable as possible. It&rsquo;s not hard to align data so I do so. Maybe my current microprocessor doesn&rsquo;t care, but the next one to run this code might.</p>
<p>Without writing an example program, I think I could sketch out a potential performance problem of unaligned data, that suffers from &ldquo;false sharing.&rdquo; This is when two cores are trying to read and write from the same cache line. Once one writes, it invalidates the any other reader&rsquo;s cache, forcing them to access main memory.</p>
<p>For instance, let us make an array of cache-line-sized (64 byte) data objects, with a number of entries equal to number of cores. Have each core read the data into memory, and treating it as a 64-byte int, increment it. Then, write it back out. Have each thread do a billion increments.</p>
<p>I imagine such a program might be 20-30x faster should the data be aligned on 64-byte boundaries, totally eliminating false sharing, than with any other alignment, which would guarantee it.</p>
<p>I do understand this isn&rsquo;t exactly the issue you&rsquo;re discussing, but it is a fairly closely-associated one.</p>
</div>
</li>
<li id="comment-603419" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/947248f241070d3f9831cdd993f42ec9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/947248f241070d3f9831cdd993f42ec9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jon Ross</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-25T21:18:43+00:00">October 25, 2021 at 9:18 pm</time></a> </div>
<div class="comment-content">
<p>I ran Laurent Gauthier&rsquo;s counter-example, and the results no longer show a difference. At least not on this specific CPU, and GCC-11.</p>
<p><code><br/>
``#&gt; head /proc/cpuinfo | grep "model name"<br/>
model name : Intel(R) Core(TM) i7-8700K CPU @ 3.70GHz</p>
<p>#&gt; ./bench_alignment<br/>
result = -1223964992, time = 33<br/>
#&gt; ./bench_alignment_unaligned<br/>
result = 490453024, time = 30<br/>
</code></p>
</div>
</li>
<li id="comment-634702" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8f7fb0278117dec081cb238137cda49d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8f7fb0278117dec081cb238137cda49d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Demindiro</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-05-29T22:18:06+00:00">May 29, 2022 at 10:18 pm</time></a> </div>
<div class="comment-content">
<p>(Apologies if I posted this comment twice, it wasn&rsquo;t obvious to me whether it actually got submitted without Javascript enabled)</p>
<p>I have a Ryzen 2700X and while I observe only sometimes penalties when reading from an unaligned address (be it SIMD or not) there is a potentially severe penalty when writing unaligned data.</p>
<p>I use the following test program (compiled with <code>gcc -nostartfiles main.s</code>):</p>
<p>.intel_syntax noprefix<br/>
.globl _start</p>
<p>.section .text._start<br/>
_start:</p>
<p> mov rcx, 1000 * 1000 * 1000<br/>
lea rax, [rip + p + 0]</p>
<p>2:<br/>
#vmovdqu xmm0, [rax]<br/>
#vmovdqu [rax], xmm0<br/>
#movdqu xmm0, [rax]<br/>
#movdqu [rax], xmm0<br/>
#mov edi, [rax]<br/>
mov [rax], edi</p>
<p> dec rcx<br/>
jnz 2b</p>
<p> mov eax, 60<br/>
xor edi, edi<br/>
syscall<br/>
ud2</p>
<p>.section .bss<br/>
.p2align 12<br/>
.zero 4096 &#8211; 128<br/>
p: .zero 64 # cache boundary<br/>
q: .zero 64 # page boundary<br/>
.zero 64</p>
<p>These are some of the results I get:</p>
<p>&#8211; mov [rax], edi &amp; p + 0: 264.23 msec<br/>
&#8211; mov [rax], edi &amp; p + 1: 265.35 msec<br/>
&#8211; mov [rax], edi &amp; p + 5: 272.88 msec<br/>
&#8211; mov [rax], edi &amp; p + 62: 1225.18 msec<br/>
&#8211; mov [rax], edi &amp; p + 63: 1227.44 msec<br/>
&#8211; mov [rax], edi &amp; q + 62: 5758.66 msec<br/>
&#8211; mov [rax], edi &amp; q + 63: 5735.20 msec</p>
<p>So a non-SIMD store within a cache line does not seem to have any penalty, but crossing a cache boundary imposes a heavy penalty (~5x). Crossing a page boundary imposes a devastating penalty (~21x).</p>
<p>When using SIMD instructions alignment matters even within a cache line:</p>
<p>&#8211; movdqu [rax], xmm0 &amp; p + 0: 271.28 msec<br/>
&#8211; movdqu [rax], xmm0 &amp; p + 8: 517.36 msec<br/>
&#8211; movdqu [rax], xmm0 &amp; p + 4: 500.24 msec<br/>
&#8211; movdqu [rax], xmm0 &amp; p + 2: 1230.46 msec<br/>
&#8211; movdqu [rax], xmm0 &amp; p + 1: 1233.34 msec<br/>
&#8211; movdqu [rax], xmm0 &amp; p + 63: 1249.21 msec<br/>
&#8211; movdqu [rax], xmm0 &amp; q + 63: 5692.39 msec</p>
<p>When reading data a penalty may be observed when loading many times per iteration:</p>
<p>&#8211; vmovdqu xmm0, [rax] &amp; p + 0: 272.77 msec<br/>
&#8211; vmovdqu xmm0, [rax] &amp; q + 63: 275.50 msec<br/>
&#8211; 3x vmovdqu xmm0, [rax] &amp; p + 0: 385.73 msec<br/>
&#8211; 3x vmovdqu xmm0, [rax] &amp; p + 1: 389.73 msec<br/>
&#8211; 3x vmovdqu xmm0, [rax] &amp; p + 63: 745.43 msec<br/>
&#8211; 3x vmovdqu xmm0, [rax] &amp; q + 63: 750.51 msec</p>
<p>So while alignment may be disregarded when reading data on modern CPUs it is still very important to align data when writing.</p>
</div>
</li>
</ol>
