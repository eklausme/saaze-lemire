---
date: "2018-01-31 12:00:00"
title: "Picking distinct numbers at random: benchmarking a brilliant algorithm (JavaScript edition)"
index: false
---

[10 thoughts on &ldquo;Picking distinct numbers at random: benchmarking a brilliant algorithm (JavaScript edition)&rdquo;](/lemire/blog/2018/01-31-picking-distinct-numbers-at-random-benchmarking-a-brilliant-algorithm-javascript-edition)

<ol class="comment-list">
<li id="comment-296153" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-02-05T07:56:57+00:00">February 5, 2018 at 7:56 am</time></a> </div>
<div class="comment-content">
<p>The array backed FastBitSet will work great when n is small enough, in particular when it happens to fit in the L2 cache (or better). Here you use n = 1,000,000 which only requires ~122 KiB of memory (assuming the JavaScript FastBitSet works like the Java one &#8211; i.e., doesn&rsquo;t have any optimization for sparse sets).</p>
<p>What happens for n = 800,000,000 and some m values (that don&rsquo;t trigger the m * 1024 fallback condition? This should no longer fit in L2 (or even L3 unless you have some extreme type of CPU), and here the FastBitSet approach will probably fall behind (or at least the gap will narrow).</p>
<p>The naive solutions (certainly in Java, and it&rsquo;s probably not better in JavaScript) are really hurt by the fact that HashSet is frankly a terrible set for integers, memory-wise: each Integer probably has an overhead of 2000% or so (say 80 bytes per 4 byte integer). A simple int[] based hash set would do much better (or there are plenty of good third party libraries too).</p>
</div>
<ol class="children">
<li id="comment-296404" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-02-06T21:18:18+00:00">February 6, 2018 at 9:18 pm</time></a> </div>
<div class="comment-content">
<p>Yes, JavaScript FastBitSet works much like Java&rsquo;s BitSet.</p>
<p>If you look at my code, in the post, you will notice that I do fall back on the regular, hash-based algorithm when a bitset is obviously inefficient. Look again:</p>
<pre><code>function fastsampleS(m, n) {
  if(m &gt; n / 2 ) {
    let negatedanswer = fastsampleS(n-m, n)
    return negate(negatedanswer)
  }
  if(m * 1024 &gt; n) {
    return sampleBitmap(m, n)
  }
  return sampleS(m, n)
}
</code></pre>
<p>See the &ldquo;1024&rdquo; factor? Well&#8230; 1024 is kind of arbitrary, you can tweak it.</p>
<blockquote>
<p>A simple int[] based hash set would do much better (or there are plenty of good third party libraries too).</p>
</blockquote>
<p>Using the following script I estimate the memory usage of the JavaScript Set to be around 40 bytes per entry:</p>
<pre><code>for (let key in process.memoryUsage()) {
  console.log(`${key} ${Math.round(process.memoryUsage()[key] / 1024 / 1024 * 100) / 100} MB`);
}
var s = new Set();
for (let i = 0; i &lt; 1000000 ; i ++) {
  s.add(i);
}
for (let key in process.memoryUsage()) {
  console.log(`${key} ${Math.round(process.memoryUsage()[key] / 1024 / 1024 * 100) / 100} MB`);
}
</code></pre>
<p>Obviously, 40 bytes is something like an order of magnitude more than needed.</p>
<p>It could be tricky to do better (though not impossible). JavaScript does have programmer-specified typed arrays, but they do not come for free performance-wise (which is odd but there you go). However, JavaScript is smart enough to recognize typed arrays by their usage. So it should be possible to do better&#8230;</p>
</div>
<ol class="children">
<li id="comment-296464" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-02-07T22:00:11+00:00">February 7, 2018 at 10:00 pm</time></a> </div>
<div class="comment-content">
<p>Right, I saw the fallback code which is why I mentioned &ldquo;[without triggering] the m * 1024 fallback condition&rdquo; (let&rsquo;s call n/m the &ldquo;density factor&rdquo;). If we say each integer takes 40 bytes as you found, then the cutover point for memory use would be around a density factor of 320 (since each integer uses 320 bits), not far off of 1024. The &ldquo;performance&rdquo; cutover point will generally be higher than the memory one (since even when bitset uses more memory it is simpler and will generally be faster), so perhaps 1024 is a good choice.</p>
<p>My points are more along the lines of:</p>
<p>The BitSet in Java and this one for JavaScipt happen to have a representation that is compact and &ldquo;hardware sympathetic&rdquo; compared to the ideal representation (i.e., very close to 1 actual bit used per bit), whereas the use of generic Set for an explicit set of integers tends to have quite a terrible representation, using 10x more memory than needed. So the BitSet approaches have a giant built-in lead in this comparison due to differences gap between actual and ideal implementation. It would be interesting to compare against Set implementations that didn&rsquo;t suck so much for this purpose.<br/>
The memory use of the BitSet approach grows with n, while the Set approach grows with m. So I expect there to be some range where Set is better, but this range is much smaller than it has to be due to (1). In particular, there will be &ldquo;plateaus&rdquo; in the performance of each implementation, at different locations, based on the memory-intensity of the algorithm and the cache sizes. These will mostly become interesting when the working set moves out of L2 into L3 since I suspect out-of-order will have a generally easy time hiding even the L2 latency since both algorithms have &ldquo;unlimited&rdquo; MLP. As it happens n = 1,000,000 fits nicely into L2 for both algorithms, so it&rsquo;s a point where expect the BitSet advantage to be relatively higher (i.e., the plateaus overlap here).</p>
<p>A few other notes:</p>
<p>There are really two separate things being tested here: the use of BitSet to store an integer set instead of Set, and the use of the negate() approach to make the problem almost symmetric around m == n/2, rather than very slow when m &gt; n/2. The negate() thing I think is a common approach and also one you can/should apply to any algorithm (indeed, you might take it a step further and remove the brute-force &ldquo;negate&rdquo; entirely and propagate the &ldquo;is negated&rdquo; state to your consuming code which could often consume the negated set for free or nearly so).</p>
<p>The set representation question, on the other hand, I find a bit deeper and more interesting from a performance point of view. For example, one thing not mentioned is that these algorithms don&rsquo;t return the same type of object &#8211; some return a Set and some a BitSet. Which is more convenient depends on the consumer: if you want to consumer the values in sorted order, BitSet does that &ldquo;for free&rdquo; as a consequence of how it is represented. If any old order is fine, however, then the Set representation is probably more efficient (but this is also subject to issue (1) above) since you can just iterate though the already-materialized values in underlying hash versus iterating through the BitSet (here there is probably also a cutover point depending on the density factor).</p>
<blockquote><p>
However, JavaScript is smart enough to recognize typed arrays by their usage. So it should be possible to do betterâ€¦
</p></blockquote>
<p>Indeed &#8211; doing better is just a matter of using an array of integers as the basis for your set &#8211; I&rsquo;m quite sure that under the covers this is exactly what FastBitSet does. I&rsquo;m not actually 100% sure how typed-arrays and bitwise math works in JavaScipt: internally number are using 8-bit floats &#8211; but does this allow you to use all 64-bits of a value as if it were a 64-bit integer to implement BitSet?</p>
<p>In Java it is clear how it works, mostly because you have the explicit distinction between primitive and boxed values. BitSet uses a long[] and so is pretty much the ideal representation (and bulk operations can even be vectorized) &#8211; and you have zero objects per &ldquo;entry&rdquo;. Set uses an Object[] pointing to Integer objects, so you have 2 objects and about ~54 bytes per entry. Fast integer set implementations use an int[] and have 0 objects and 4 bytes per entry (all numbers are the asymptotic limits &#8211; obviously the array itself counts as 1 object, and there are resizing considerations, but these go quickly to 0 on a per-element basis as the size increases).</p>
<p>Don&rsquo;t take any of this as bashing BitSet &#8211; they are a great representation when sets are relative dense. I just want to make the tradeoff clear and point out that the fully optimized cutover point would be different than the &ldquo;optimized vs not&rdquo; cutover you might calculate from this post.</p>
<p>Finally, if you really want to do this quickly, I think a much faster approach for most density is as follows:</p>
<p>From your unbiased random bitstream (i.e., your source of randomness like random() or whatever), generate a biased bitstream where each bit is set with probability p&rsquo; ~= p where p is m/n, i.e., the probability that any given value will appear in the final set. I.e., you generate the BitSet representation directly, rather than starting with all zeros and setting bits one-by-one. This lets you, for example, generate the BitSet 64 bits (or 128 or 256 with SIMD) at a time, and the generating operation is much simpler and free of branches.</p>
<p>Now you&rsquo;d have to be pretty lucky (like, <em>really lucky</em> for n = 1,000,000) for this to give you exactly the right m in the end, but if you don&rsquo;t need <em>exactly</em> m values &#8211; but just something close you can stop here: the resultant number of set values (m&rsquo;) will generally be very close to m (for example, with m=500,000 and n=1,000,000 we have m&rsquo; in the range m +/- 1000 about 95% of the time based on my rusty math and an online calculator &#8211; so usually within about 0.2% of the expected value).</p>
<p>Now, we should be fair and do apples to apples and get an exact m &#8211; so all you have to do is to apply any algorithm discussed in Daniel&rsquo;s post to correct the selected values (either adding or removing) until we reach the correct m.</p>
<p>For density factors near 0.5, I&rsquo;m will to bet this is an order of magnitude faster than the above approaches: and it only uses ~1 bit of entropy per value, rather than 32 (or whatever Random.getInt() uses per invocation). It is also very amenable to vectorization and other techniques as well. Note also that it is symmetric: you don&rsquo;t really need the concept of negation because the behavior is naturally the same at m and (n &#8211; m), since we aren&rsquo;t really distinguishing between chosen and unchosen values.</p>
<p>The performance at other density values is tougher to characterize: you need to generate the biased bit sequence, which is harder when p != 0.5, but still generally fast. In general you can pick a p&rsquo; different than p to optimize the overall performance since some p&rsquo; values are faster to generate (especially those that have the form 1/(2^x) for small x) and you will ultimately do a corrective step anyways. Generating the biases bit streams is an interesting topic in itself!</p>
<p>I think this approach is bias-free: every value is selected independently and the correction step seems bias-free also. If you are willing to accept small biases you can probably do it even faster.</p>
<p>This approach will be so fast that things like &ldquo;how is your entropy generated&rdquo; become important &#8211; if you use a slow RNG it will be the limiting factor! It&rsquo;s also worth noting that the amount of entropy consumed, for the simple/fastest biased bitstream generation methods, depend on p in a &ldquo;backwards&rdquo; way: it is smallest near p = 0.5 and gets larger at the extremes, even though at the extremes the amount of information-theoretic entropy in the returned set is much lower (indeed, at m = 1 the other methods need only 1 random number, while this technique would need much more). So again there will be cutover points where this doesn&rsquo;t make sense, which will depend on how expensive entropy is to generate.</p>
</div>
<ol class="children">
<li id="comment-296489" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-02-08T16:00:58+00:00">February 8, 2018 at 4:00 pm</time></a> </div>
<div class="comment-content">
<p><em>(&#8230;) internally number are using 8-bit floats â€“ but does this allow you to use all 64-bits of a value as if it were a 64-bit integer to implement BitSet?</em></p>
<p>JavaScript supports 32-bit integers in practice.</p>
<p><em>Generating the biases bit streams is an interesting topic in itself! (&#8230;) I think this approach is bias-free: every value is selected independently and the correction step seems bias-free also.</em></p>
<p>Agreed.</p>
</div>
<ol class="children">
<li id="comment-296630" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-02-11T22:24:26+00:00">February 11, 2018 at 10:24 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
JavaScript supports 32-bit integers in practice.
</p></blockquote>
<p>Right, I think since it represents everything as 64-bit floats, 32-bit integers work because all 32-bit ints are easily representable exactly as a 64-bit float (53-bit mantissa) &#8211; but that would imply that bitwise operations, which are conceptually defined on the 32-bit ints which don&rsquo;t necessarily exist &ldquo;in memory&rdquo; would need to unpack from a float representation, do the bitwise math, and then pack back?</p>
<p>See this answer and the comments, for example:</p>
<p><a href="https://stackoverflow.com/a/11159148/149138" rel="nofollow ugc">https://stackoverflow.com/a/11159148/149138</a></p>
<p>So it&rsquo;s a problem in theory, and perhaps in practice. The optimization mentioned in the comments probably applies mostly to non-escaping variables with local operations, not to arrays which I think usually have to use the 64-bit representation. So I&rsquo;m curious if/how FastBitSet works around this (or if it does). Not curious enough to test it though since my JavaScript is &#8230; weak.</p>
</div>
<ol class="children">
<li id="comment-296631" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-02-11T23:01:50+00:00">February 11, 2018 at 11:01 pm</time></a> </div>
<div class="comment-content">
<p>You have to take into account that modern JavaScript engines have a JIT compiler&#8230; and this compiler can tell apart floats from ints (from profiling).</p>
<p>My mental model is that current JavaScript engines can do heroic optimizations and JIT compile the code assuming that the numbers are 32-bit integers.</p>
<p>That is, when you create an array and only store 32-bit integers in it&#8230; you get roughly the same performance as if you&rsquo;d used a typed array. (JavaScript has typed array which really are arrays of ints like in Java). That part of the story is something I know for sure!</p>
<p>It is easy enough to have access to the JIT code being generated&#8230; but such code is not easy to read.</p>
<p>JavaScript is fast!</p>
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
<li id="comment-296174" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/thomasmueller/minperf" class="url" rel="ugc external nofollow">Thomas Mueller</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-02-05T13:47:42+00:00">February 5, 2018 at 1:47 pm</time></a> </div>
<div class="comment-content">
<p>It might be faster (maybe 4 ns/key) <em>not</em> to use a bit set, but split the range into sub-ranges of 2^n, and then <a href="https://stackoverflow.com/questions/664014/what-integer-hash-function-are-good-that-accepts-an-integer-hash-key/12996028#12996028" rel="nofollow">hash integer</a> entries of a <a href="https://github.com/thomasmueller/minperf/blob/master/src/test/java/org/minperf/hem/RandomGenerator.java#L61" rel="nofollow">sequence</a> (&ldquo;<a href="https://github.com/thomasmueller/minperf/blob/master/src/test/java/org/minperf/hash/Mix.java#L26" rel="nofollow">bit mixing</a>&ldquo;), with a hash function that is guaranteed to have no collisions. For a 2^64 range, that is:</p>
<p><code>static long[] createRandomUniqueListFast(int len, int seed) {<br/>
long[] list = new long[len];<br/>
for (int i = 0; i &lt; len; i++) {<br/>
list[i] = hash64(seed + i);<br/>
}<br/>
return list;<br/>
}</p>
<p>static long hash64(long x) {<br/>
x = (x ^ (x &gt;&gt;&gt; 30)) * 0xbf58476d1ce4e5b9L;<br/>
x = (x ^ (x &gt;&gt;&gt; 27)) * 0x94d049bb133111ebL;<br/>
x = x ^ (x &gt;&gt;&gt; 31);<br/>
return x;<br/>
}<br/>
</code></p>
<p>A similar algorithm can be used for smaller n. I used that recently to <a href="https://github.com/thomasmueller/minperf/blob/master/src/test/java/org/minperf/utils/RandomSetGenerator.java" rel="nofollow">generate lots of unique random numbers in somewhat sorted order</a> (also split the range into randomly sized sub-ranges, and used the bit mixing trick for small ranges).</p>
</div>
<ol class="children">
<li id="comment-296470" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-02-07T23:20:20+00:00">February 7, 2018 at 11:20 pm</time></a> </div>
<div class="comment-content">
<p>Interesting approach: so these generators for a given n have a period of n and every value appears exactly once? Do they give up some randomness quality to achieve this behavior (clearly they aren&rsquo;t uniformly random in the usual sense since once you&rsquo;ve generated n-1 values, for example, the last value is exactly known)?</p>
<p>You mention &ldquo;A similar algorithm can be used for smaller n&rdquo; &#8211; how does it work, and can you generate it efficiently at runtime (i.e., can you take an arbitrary n, or do the possible n values need to be known at runtime?).</p>
</div>
<ol class="children">
<li id="comment-296583" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/thomasmueller/minperf" class="url" rel="ugc external nofollow">Thomas Mueller</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-02-10T21:21:17+00:00">February 10, 2018 at 9:21 pm</time></a> </div>
<div class="comment-content">
<p>Yes, they should have a period of n, and every value appears once. The randomness quality is not all that great in my view. Quality could be improved by adding more iterations (one iteration is multiplication + shift), which would make it slower of course. &ldquo;A similar algorithm can be used for smaller n&rdquo;: I managed to implement that, but didn&rsquo;t test the randomness quality (it&rsquo;s probably quite bad). My pull request is <a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2018/01/31/randomsample.js" rel="nofollow">merged in the example code</a>. To improve randomness quality, a different algorithm could be used (eg. XTEA, or some other Feistel cipher).</p>
<p>My point is, it&rsquo;s not needed to have a set (bit set or hash set). Some might not know this. (I think Daniel Lemire already knows this, and for him it was more important to show how bit sets / hash sets can be made faster.)</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-296468" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-02-07T23:15:41+00:00">February 7, 2018 at 11:15 pm</time></a> </div>
<div class="comment-content">
<p>Bleh, the blog ate my numbered list (despite the preview showing it OK). When I refer to point (1) and point (2) above, I&rsquo;m referring to the paragraphs starting &ldquo;The BitSet in Java and this one&#8230;&rdquo; and &ldquo;The memory use of the BitSet &rdquo; respectively.</p>
</div>
</li>
</ol>
