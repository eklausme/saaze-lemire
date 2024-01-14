---
date: "2019-08-30 12:00:00"
title: "How fast can scancount be?"
index: false
---

[9 thoughts on &ldquo;How fast can scancount be?&rdquo;](/lemire/blog/2019/08-30-how-fast-can-scancount-be)

<ol class="comment-list">
<li id="comment-425985" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-02T07:52:13+00:00">September 2, 2019 at 7:52 am</time></a> </div>
<div class="comment-content">
<p>I think that if your integer lists were (sorted and) dense, you could theoretically go significantly below two reads and one write per element on the update operation by partially transposing the update loop, especially if you can benefit from wide reads and writes (AVX2/AVX-512). The optimal case would cause only the integer lists to be read once with the widest possible read size, and the output array to be written once(!) with maximum width, that is, very close to zero memory operations per element. (Actually you could collect the results straight away at this phase.)</p>
<p>The problem here is all the juggling required in the middle. Maybe some of those very un-RISCy vector instructions could save the day? (I don&rsquo;t believe current architectures would be that good, or at least this would require significant register spilling which would undo large portion of potential benefits.)</p>
</div>
<ol class="children">
<li id="comment-426018" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Jörn Engel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-02T16:34:07+00:00">September 2, 2019 at 4:34 pm</time></a> </div>
<div class="comment-content">
<p>The most common trick in this direction is to use the AH/AL pair for byte reads or writes. Requires minimal loop unrolling.</p>
<p><code>read(AL, foo);<br/>
read(AH, bar);<br/>
write(AX, baz); // writes two bytes in one instruction<br/>
</code></p>
<p>It doesn&rsquo;t always help and compilers tend to forget about this optimization once you get into register pressure. But it allows you to double the number of byte reads/writes without writing vector code.</p>
</div>
<ol class="children">
<li id="comment-426091" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-03T09:25:01+00:00">September 3, 2019 at 9:25 am</time></a> </div>
<div class="comment-content">
<p>That is not the hard part in this case, the hard part is expanding an array of sorted integers into a corresponding bit-mappy vector of 1/0 integers (probably of the same size) in an efficient manner. 🙂</p>
<p>I think this could be accomplished with AVX-512 with a core loop magic consisting basically of a broadcast, a compare to mask and a VPERM instruction. Reasoning about AVX-512 instructions sincerely makes my head hurt, but it would seem plausible that this kind of a loop could process 8 32-bit input integers per one loop iteration for 50% dense integer list. What would probably be the performance killer is conditional branching&#8230;</p>
</div>
<ol class="children">
<li id="comment-426191" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-04T17:01:41+00:00">September 4, 2019 at 5:01 pm</time></a> </div>
<div class="comment-content">
<p>Apparently my idea was naive, but you can still perform the following operation relatively efficiently on AVX-512:</p>
<p>A list of sorted unique integers (32 32-bit integers in a pair of AVX-512 registers):</p>
<p>0, 3, 4, 6, 9, 10, 11, 20, 25, 26, 30, 35, &#8230;</p>
<p>can be converted to a list of integers (or maybe their two&rsquo;s complements) on similarly sized vector entries:</p>
<p>1, 0, 0, 1, 1, 0, 1, 0, 0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 1, 0, 0, 0, 1, 0 (35 didn&rsquo;t fit on first 32 entries)</p>
<p>These results could be added with a vectored operation 16 entries at a time.</p>
<p>My back-of-an-envelope calculation of this operation requires around 4 instructions for masking outlying values, 2 instructions for adjusting offsets, 2 variable vectored shifts, 11 operations for 32-way reduction (OR or ADD operation and shuffles) and two TEST-like compares against constant vectors to achieve this result. This is on the ballparks of 23 uops per 32 resulting output values. (No, I didn&rsquo;t write the actual code&#8230;)</p>
<p>Density of input lists is a crucial point, but with densities of &gt;20% this approach might be very competitive with less vectorised approaches.</p>
</div>
<ol class="children">
<li id="comment-426197" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-04T18:28:15+00:00">September 4, 2019 at 6:28 pm</time></a> </div>
<div class="comment-content">
<p>The benchmarks on the scancount problem are sparse, but I believe here is a chance for another toy problem (unless it&rsquo;s already solved!):</p>
<p>How fast can you convert a sorted array of integers into the corresponding bitmap?</p>
<p>That is essentially the reverse of this problem: <a href="https://lemire.me/blog/2018/03/08/iterating-over-set-bits-quickly-simd-edition/" rel="ugc">https://lemire.me/blog/2018/03/08/iterating-over-set-bits-quickly-simd-edition/</a></p>
<p>My bet is that naive implementation is fastest for sparse bitmaps (roughly one clock cycle per set bit, but not that fast for dense bitmaps!), but AVX-512 implementation might be faster for dense bitmaps (as a wild-assed guess, possibly something like four bits of bitmap produced per clock cycle).</p>
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
<li id="comment-426044" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Kurz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-02T23:21:00+00:00">September 2, 2019 at 11:21 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
Assuming that our hardware can do either two loads per cycle or one<br/>
store per cycle, then we get a limit of at least two cycles per input<br/>
element.
</p></blockquote>
<p>For modern Intel processors you can actually do two loads and a write within the same cycle. The trickiness is that the addressing mode for the write would need to be &ldquo;simple&rdquo;, which is to say, based on just one register plus a fixed offset (rather than a base and index register). That&rsquo;s difficult to achieve in this case, since we want to index into the counter array by the value we just read. So in practice, I think you are right that this algorithm can&rsquo;t achieve 1 cycle timings. But this is because of the demands of the algorithm, rather than a simple hardware limitation.</p>
<p>And it&rsquo;s not necessarily the case that just because we can&rsquo;t achieve 1.0 cycles, that the minimum jumps to 2.0 &#8212; it might be fractional. For example, a pattern of R+R, R+W, R+W gives you 4 reads and 2 writes in 3 cycles, which allows 1.5 cycles per element. Anyway, by fiddling with the range and array sizes, I&rsquo;ve gotten results that are getting pretty close to 2 cycles per iteration. For example, demo(100000000, 1500000, 50, 5) gets down to 2.2 cycles/element for scalar:</p>
<p><code>nate@skylake:~/git/fastscancount$ perf record counter<br/>
Got 9924 hits<br/>
optimized cache-sensitive scancount<br/>
2.19437 cycles/element<br/>
3.66452 instructions/cycles<br/>
0.00227307 miss/element<br/>
AVX2-based scancount<br/>
2.48756 cycles/element<br/>
2.5749 instructions/cycles<br/>
0.00199687 miss/element<br/>
</code></p>
<p>I still don&rsquo;t quite understand why some sizes are faster than others. I think the issue is that both the data and counter arrays are competing for the same space in L3, such that increasing the number or size of the data arrays causes significantly slower results. It&rsquo;s possible that a streaming read for the data (reading in a way that avoids polluting L3) might help get things a little bit faster.</p>
</div>
</li>
<li id="comment-426271" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-05T14:30:38+00:00">September 5, 2019 at 2:30 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
The trickiness is that the addressing mode for the write would need to<br/>
be “simple”, which is to say, based on just one register plus a fixed<br/>
offset (rather than a base and index register). That’s difficult to<br/>
achieve in this case, since we want to index into the counter array by<br/>
the value we just read.
</p></blockquote>
<p>One way to get simple addressing is to use a static (global) array. Then the only register needed in the addressing expression is the one holding the just loaded value: the array base is a constant offset. <a href="https://godbolt.org/z/ZOXEsj" rel="nofollow">Here&rsquo;s a godbolt</a>.</p>
<p>Of course, this code is not thread-safe, so if you really wanted to do this type of really, really low-level optimization and keep things thread safe, you&rsquo;d have to use a mutex to protect this code, perhaps falling back to the non-static array variant if the function is called while another thread holds the lock.</p>
<p>One downside of this approach is that you don&rsquo;t really have any control over the allocation of the array, in particular you probably won&rsquo;t be able to ask for huge pages (<em>perhaps</em> you can if the array lives in the .bss and you do a madvise before the page is accessed &#8211; but there are a lot of issues to work out).</p>
<p>Another approach is to keep using a dynamically allocated counters array, but JIT-compile the core loop embedding the array offset as a static offset in the same way as above. Yes, a crazy hack.</p>
<blockquote><p>
I think the issue is that both the data and counter arrays are<br/>
competing for the same space in L3, such that increasing the number or<br/>
size of the data arrays causes significantly slower results.
</p></blockquote>
<p>How big was the counter array? I thought that most of the performance effects as probably related to L1 cache misses on the counter array: stores to L2 (i.e., stores that miss in L1 bit hit in L2) have a speed limit of 3 cycles per store, so any result less than 3 cycles indicates that you are getting at least some hits in L1 for the counter increments, which I think requires a small counter array (or dense values, i.e., more than one hit in the same cache line).</p>
</div>
</li>
<li id="comment-426272" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-05T14:42:20+00:00">September 5, 2019 at 2:42 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
I was using textbook C++ with iterators and STL algorithms. Converting<br/>
the problem into lower-level code (using pointers or indexes) seems<br/>
better for performance.
</p></blockquote>
<p>I would caution readers from using this as any kind of general rule.</p>
<p>In fact, for the aliasing stuff, using iterators or <em>even more</em> idiomatic C++ such as for-each loops would have helped also, versus say indexing with <code>vector[i]</code> (it may not be simple if you wanted the value of i for another purpose in the loop).</p>
<p>Some C++ abstractions are zero cost, some are not. As we&rsquo;ve seen here, replacing plain array indexing with vector indexing is not always zero cost, especially in the presence of char writs and the consequent aliasing problems.</p>
<p>You can still make it fast using C++ idioms, but indeed it might require a bit more care.</p>
<blockquote><p>
Of course, we also need to load data: say one load to get the element,<br/>
and one load to get the corresponding counter.
</p></blockquote>
<p>Strictly speaking you don&rsquo;t need 1 load to get the element: these elements are adjacent, so in principle you can get say 2 elements with a 64-bit load, or 8 elements with a 256-bit vector load. In practice this doesn&rsquo;t help too much because your &ldquo;budget&rdquo; of stuff you can do per cycle (4 ops) is too small for this to save much &#8211; but it&rsquo;s something to keep in mind when one input or output is contiguous.</p>
<p>I think a carefully tuned implementation could achieve ~1.5 cycles per cycle for your parameters (20M, 50K, 100, 3) which are kind of a worst case (admittedly the &ldquo;worst case&rdquo; region is very large). At some other points you could do better, e.g., when the data arrays are dense, since vectorized approaches become feasible, or when the threshold is much larger (since you can eliminate many elements without performing the corresponding store).</p>
</div>
<ol class="children">
<li id="comment-426275" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-05T15:03:46+00:00">September 5, 2019 at 3:03 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>I would caution readers from using this as any kind of general rule.</p>
</blockquote>
<p>I agree with you. My statement was not meant as a prescription.</p>
</div>
</li>
</ol>
</li>
</ol>
