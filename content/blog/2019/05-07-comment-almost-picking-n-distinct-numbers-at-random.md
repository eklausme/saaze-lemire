---
date: "2019-05-07 12:00:00"
title: "Almost picking N distinct numbers at random"
index: false
---

[24 thoughts on &ldquo;Almost picking N distinct numbers at random&rdquo;](/lemire/blog/2019/05-07-almost-picking-n-distinct-numbers-at-random)

<ol class="comment-list">
<li id="comment-405511" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-07T18:37:22+00:00">May 7, 2019 at 6:37 pm</time></a> </div>
<div class="comment-content">
<p>I think it&rsquo;s close, but it&rsquo;s not the geometric distribution exactly. Consider the case of picking 1 value out of 2 for example.</p>
<p>You are right that each value is chosen with probability N/R (with R the size of the range), but the probabilities when considering what value is be picked next are not independent.</p>
</div>
<ol class="children">
<li id="comment-405513" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-07T18:42:35+00:00">May 7, 2019 at 6:42 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>I think it’s close, but it’s not the geometric distribution exactly. Consider the case of picking 1 value out of 2 for example.</p>
</blockquote>
<p>I think we agree. From my blog post: &ldquo;My model is not quite correct. For one thing, we do not quite have a geometric distribution&rdquo;.</p>
</div>
</li>
</ol>
</li>
<li id="comment-405512" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-07T18:40:03+00:00">May 7, 2019 at 6:40 pm</time></a> </div>
<div class="comment-content">
<p>Also there is a concern with the failure mode: if you end up picking 999,999 values you stop early with less values but these values are at least somehow &ldquo;well distributed&rdquo;. What about the other case, where the fates direct you to pick 1,000,001 values? The algorithm cuts off early and values near the end of the range won&rsquo;t be chosen. So I think there is a significant bias against values near the end of the range.</p>
</div>
<ol class="children">
<li id="comment-405514" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-07T18:44:07+00:00">May 7, 2019 at 6:44 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>So I think there is a significant bias against values near the end of the range.</p>
</blockquote>
<p>Yes. There is going to be a bias. Of course, we could stop well short of the end and finish off the generation using some other mean.</p>
</div>
<ol class="children">
<li id="comment-405515" class="comment byuser comment-author-lemire bypostauthor even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-07T18:45:26+00:00">May 7, 2019 at 6:45 pm</time></a> </div>
<div class="comment-content">
<p>Note that the reason there is a bias at the end follows directly from the fact that the geometric distribution is an imperfect approximation.</p>
</div>
<ol class="children">
<li id="comment-405526" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-07T20:18:21+00:00">May 7, 2019 at 8:18 pm</time></a> </div>
<div class="comment-content">
<p>Yes and no. Drawing from the wrong distribution in this leads to a subtle bias throughout the range, and it also leads to not getting exactly the &ldquo;expected&rdquo; size most of the time.</p>
<p>However, just clipping off the array when you get to N is another thing and leads to a different, quite strong type of bias for the end elements.</p>
<p>I think you should choose the same strategy you do for fewer elements: you can return a 999,999 array element, why not a 1,000,001 one? There is a symmetry there and it eliminates one big source of bias. Instead of stopping when <code>i &lt;= N || range_size &lt;= (N - i)</code> just stop when out[i] &gt; range_max (of course, don&rsquo;t actually assign that last element).</p>
<p>Yes, from a C perspective, returning more than N elements is more problematic :).</p>
<p>Finally once you get your result, you can <em>stretch</em> or <em>shrink</em> it to exactly N by choosing random locations to insert elements and choosing them randomly from the range implied by the insertion position (yes another source of bias, I think, but small and evenly distributed in the sense that every number should have equal likelihood to appear).</p>
</div>
<ol class="children">
<li id="comment-405529" class="comment byuser comment-author-lemire bypostauthor even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-07T20:40:39+00:00">May 7, 2019 at 8:40 pm</time></a> </div>
<div class="comment-content">
<p>I agree with your concerns regarding the tail.</p>
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
<li id="comment-405531" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-07T20:50:22+00:00">May 7, 2019 at 8:50 pm</time></a> </div>
<div class="comment-content">
<p>Part of the problem is that the C qsort starts at a significant disadvantage: it takes its comparator by <em>function pointer</em> and has to make an indirect function call to compare each pair of elements. For fast comparisons like between <code>uint64_t</code> that&rsquo;s a lot of overhead for what boils doing to one assembly instruction.</p>
<p>I <a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/pull/35" rel="nofollow">sent a PR</a> to add C++&rsquo;s sort, everything else unchanged, and I find it to be almost 2x as fast as C&rsquo;s sort (it&rsquo;s the second reading here):</p>
<p><code>Generating 1000000 values in [0, 40000000000), density: 0.002500 %<br/>
timings: 0.171996 s 0.094119 s 0.063858 s<br/>
timings per value: 171.996000 ns 94.119000 ns 63.858000 ns<br/>
actual counts: 999993 999985 999998</p>
<p>Generating 10000000 values in [0, 40000000000), density: 0.025000 %<br/>
timings: 2.039629 s 1.103942 s 0.666784 s<br/>
timings per value: 203.962900 ns 110.394200 ns 66.678400 ns<br/>
actual counts: 9998779 9998723 9999999</p>
<p>Generating 100000000 values in [0, 40000000000), density: 0.250000 %<br/>
timings: 22.494848 s 12.375101 s 6.343137 s<br/>
timings per value: 224.948480 ns 123.751010 ns 63.431370 ns<br/>
actual counts: 99875477 99875035 100000000<br/>
</code></p>
<p>On this machine geometric is 3x to 4x as far as C sort, which is quite a bit faster (relatively) than your results. Maybe different compiler&#8230;</p>
</div>
<ol class="children">
<li id="comment-405550" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-07T22:38:31+00:00">May 7, 2019 at 10:38 pm</time></a> </div>
<div class="comment-content">
<p>Thanks Travis.</p>
<p>(As you may suspect, I was aware that qsort was slower the C++ sort, but I was writing a pure C benchmark.)</p>
</div>
<ol class="children">
<li id="comment-405557" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-07T23:26:04+00:00">May 7, 2019 at 11:26 pm</time></a> </div>
<div class="comment-content">
<p>You can write fast sorts in C too, it&rsquo;s just that qsort isn&rsquo;t one of them (unless the comparator time is large). Otherwise you just show &ldquo;why writing a generic function-pointer-taking sort in C is relatively slow&rdquo;.</p>
</div>
<ol class="children">
<li id="comment-405558" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-07T23:44:50+00:00">May 7, 2019 at 11:44 pm</time></a> </div>
<div class="comment-content">
<p>My belief is that I used the &ldquo;textbook&rdquo; or standard way to sort an array in C. If my belief is wrong, I&rsquo;d love to be corrected.</p>
</div>
<ol class="children">
<li id="comment-405561" class="comment odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-08T00:30:46+00:00">May 8, 2019 at 12:30 am</time></a> </div>
<div class="comment-content">
<p>Yes, as far as I know qsort is the &ldquo;textbook&rdquo; way to sort in C and a good example of why higher level languages can be faster than &ldquo;textbook C&rdquo;.</p>
</div>
<ol class="children">
<li id="comment-405564" class="comment byuser comment-author-lemire bypostauthor even depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-08T00:50:19+00:00">May 8, 2019 at 12:50 am</time></a> </div>
<div class="comment-content">
<p>I am not sure I understand why we can&rsquo;t easily fix the C qsort. I realize that qsort is compiled, but, surely, it is not impossibly hard engineering to fix this? Can&rsquo;t the compiler recognize the qsort call and do some inlining? Of course, it would only solve qsort, but so what?</p>
<p>The compiler already handles something like memcpy to optimize away the function call when needed. How hard could it be to do the same with qsort?</p>
</div>
<ol class="children">
<li id="comment-405566" class="comment odd alt depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-08T01:06:49+00:00">May 8, 2019 at 1:06 am</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t think it&rsquo;s that hard, but it just doens&rsquo;t matter a lot.</p>
<p>If libc was shipped with some LTO payload (i.e., intermediate representation code), then you could do it with LTO: the comparison function could be inlined in the final compile step.</p>
<p>That&rsquo;s probably never going to happen because compiler vendors want to keep their LTO info version specific and be allowed to change it at any point.</p>
<p>The real thing is that it just doesn&rsquo;t matter: you can easily write your own search method, or copy/paste the source of qsort or any other good sort you find on the internet and have your comparator inlined.</p>
<p>So in that sense it is not the same as memcpy: that&rsquo;s about compiling memcpy into the calling code with information only the compiler knows about alignment and copy length: you have no real practical alternative to the compiler doing a good job here in many cases.</p>
<p>You have a practical alternative to qsort: just don&rsquo;t use the copy of the sort that has been compiled ahead of time and stuck in libc. C++ doens&rsquo;t have this problem because sort is in a header, and JIT&rsquo;d languages don&rsquo;t have this problem because inlining happens at runtime.</p>
</div>
<ol class="children">
<li id="comment-405567" class="comment even depth-8">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-08T01:11:14+00:00">May 8, 2019 at 1:11 am</time></a> </div>
<div class="comment-content">
<p>Another solution for the primitive-valued-array case, implementable in the library only, would be if the standard library writers provided standard &ldquo;compare int&rdquo; type methods, and then qsort could check at runtime if a standard compare method was being used and then dispatch to the specialized version for that primitive.</p>
<p>Or it could inspect the machine code of the provided compare method and decide whether it was equivalent to the usual comparison &#8211; but now we&rsquo;re just getting crazy.</p>
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
</li>
<li id="comment-408524" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-23T20:59:04+00:00">May 23, 2019 at 8:59 pm</time></a> </div>
<div class="comment-content">
<p>As it turns out, you can do much better than <code>std::sort</code> also. I used a radix sort which was several times faster than <code>std::sort</code> and led to the sort-based method for generating unique numbers being significantly faster than the geometric distribution method (although of course there may be a lot of optimization to be done on that one).</p>
<p>I wrote more about radix sorts specifically <a href="https://travisdowns.github.io/blog/2019/05/22/sorting.html" rel="nofollow">over here</a>.</p>
</div>
<ol class="children">
<li id="comment-408531" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-23T21:42:34+00:00">May 23, 2019 at 9:42 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for sharing the link!</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-405730" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thomas Müller Graf</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-09T05:58:48+00:00">May 9, 2019 at 5:58 am</time></a> </div>
<div class="comment-content">
<p>I had a similar problem and implemented the following in my <a href="https://github.com/thomasmueller/minperf/blob/master/src/main/java/org/minperf/utils/RandomSetGenerator.java" rel="nofollow">minperf project, RandomSetGenerator.java</a>. It only need about 4-5 ns/entry.</p>
<p>Instead of a random number generator, I used a seeded hashing / mixing algorithm, similar to mix64, for a counter. It is guaranteed to return unique numbers without having to check for uniqueness.</p>
<p>If no sorting at all is needed, then you can just use the hashing algorithm. This is also used in <a href="https://github.com/FastFilter/fastfilter_cpp/blob/master/benchmarks/random.h#L14" rel="nofollow">fastfilter_cpp, random.h, GenerateRandom64Fast</a>, for 64 bit numbers. But mix functions can be written for any other number of bits (I wrote hash48, hash44, and hash32). If the range is not a power of 2, one might want to discard numbers outside of the range, and/or recursively split the range.</p>
<p>In my case, &ldquo;some&rdquo; sorting is needed (blocks with ascending ranges). For this, I recursively split the range. That will guarantee you get the right number of entries in total. Within each range, the &ldquo;no sorting&rdquo; approach from above is used.</p>
<p>Splitting a range: I have used the normal distribution to calculate the number of expected entries below the middle (RandomSetGenerator.randomHalf). It is somewhat slow, but if the ranges are large this isn&rsquo;t a problem.</p>
</div>
<ol class="children">
<li id="comment-405766" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-09T12:55:14+00:00">May 9, 2019 at 12:55 pm</time></a> </div>
<div class="comment-content">
<p>This is a great comment Thomas.</p>
</div>
</li>
</ol>
</li>
<li id="comment-408568" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b8cfd5ec0f88bf5b5f2eedda7d1a0746?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b8cfd5ec0f88bf5b5f2eedda7d1a0746?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.seebs.net/log/" class="url" rel="ugc external nofollow">seebs</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-24T01:18:31+00:00">May 24, 2019 at 1:18 am</time></a> </div>
<div class="comment-content">
<p>I wanted to do a thing similar to this at one point, stumbled across algorithms for generating permutations without having to generate the whole set, and realized that the first N values from a random permutation of M values are very much like a set of N distinct values from 0 to M&#8230; And if M is a power of 2, there&rsquo;s established methods for using a block cipher like AES-128 to generate a block cipher for fewer than 128 bits. Then you just encode values 0, 1, 2, &#8230; and get out distinct values in that range. There&rsquo;s some overhead, but the advantage is that you don&rsquo;t have to store them or sort them or anything to avoid duplicates.</p>
</div>
</li>
<li id="comment-408706" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0fc8b978210b4087257932d8579118e6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0fc8b978210b4087257932d8579118e6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">sh1</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-24T17:55:58+00:00">May 24, 2019 at 5:55 pm</time></a> </div>
<div class="comment-content">
<p>Others have already noted the <a href="https://en.wikipedia.org/wiki/Format-preserving_encryption" rel="nofollow">format-preserving encryption</a> method. I built a <a href="https://github.com/sh1boot/prpg/blob/master/prpg.c#L104" rel="nofollow">table</a> of mix function parameters for bits 8..128 so that it&rsquo;s possible to create a lightweight mix function with a range less than double the required range so the overhead isn&rsquo;t so bad. However, the real challenge is getting a function with decent coverage of the possible set of output permutations.</p>
<p>I recently used the sort method in a component that did need monotonic output; but then I added an optional post-shuffle for completeness. In that case I supported an arbitrary minimum distance, and to overcome the overflow problem I reduced the random range to <code>R - (N - 1) * d</code>, then sorted, then added<code>i * d</code> to each <code>result[i]</code>. I believe this is correct because any acceptable result cannot have more than one entry of value <code>R - 1</code>, etc., so the nth-to-last entry cannot be higher than <code>R - n</code>.</p>
<p>I would have to think harder to be confident, but you could probably use a rejection loop when your geometric generator went out of bounds on a per-element basis (rather than rejecting a complete set) for correct results, and you could apply the same arbitrary-minimum-distance tweak at that point.</p>
<p>Also, &ldquo;99,999&rdquo; doesn&rsquo;t really approximate &ldquo;100 million&rdquo; as implied in the original post.</p>
</div>
<ol class="children">
<li id="comment-408739" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0fc8b978210b4087257932d8579118e6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0fc8b978210b4087257932d8579118e6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">sh1</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-24T22:27:48+00:00">May 24, 2019 at 10:27 pm</time></a> </div>
<div class="comment-content">
<p>Sorry, I should clarify. That table I linked lists parameters that would plug in to @Thomas&rsquo; <a href="https://github.com/thomasmueller/minperf/blob/master/src/main/java/org/minperf/utils/RandomSetGenerator.java#L179" rel="nofollow"><code>hash44()</code></a> function, above, to generalise it to the fewest number of bits for whatever range you need so the rejection loop doesn&rsquo;t spend too much time rejecting out-of-range values.</p>
<p>That hash construction relates back to Murmur3 and appears all over the place, these days. Somebody described the process of searching for parameters here: <a href="https://zimbry.blogspot.com/2011/09/better-bit-mixing-improving-on.html" rel="nofollow ugc">http://zimbry.blogspot.com/2011/09/better-bit-mixing-improving-on.html</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-423043" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6ad8d674f3d6c9920d3b667534f7f1ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6ad8d674f3d6c9920d3b667534f7f1ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.aviz.fr/~fekete" class="url" rel="ugc external nofollow">Jean-Daniel Fekete</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-10T15:30:35+00:00">August 10, 2019 at 3:30 pm</time></a> </div>
<div class="comment-content">
<p>Hi,<br/>
Very interesting and insightful. Thanks for your blog entries!</p>
<p>There is a related blog post here:<br/>
<a href="http://erikerlandson.github.io/blog/2014/09/11/faster-random-samples-with-gap-sampling/" rel="nofollow ugc">http://erikerlandson.github.io/blog/2014/09/11/faster-random-samples-with-gap-sampling/</a><br/>
I have added his method to your code and it is even faster:</p>
<p>size_t veryfast_pick_N(uint64_t range_min, uint64_t range_max, size_t N, uint64_t *out) {<br/>
uint64_t range_size = range_max &#8211; range_min;<br/>
if(N == 0) return 0;<br/>
if(range_size = range_max) return 0;<br/>
out[0] = previous + range_min;<br/>
size_t i = 1;<br/>
for(; i &lt; N; i++) {<br/>
uint64_t newoffset = random_geometric(p);<br/>
previous += newoffset + 1;<br/>
if(previous &gt;= range_max) {<br/>
break;<br/>
}<br/>
out[i] = previous + range_min;<br/>
}<br/>
return i;<br/>
}</p>
<p>With that, I have an extra question/request, it would be great to be able to get a random sample of bits from a compressed bitmap. It seems to me that this code would be somewhat easy to use in Roaring Bitmap, am I right?<br/>
Something like <code>sample = bm.random_sample(N)</code> that returns a bitmap with all the bits in bm <code>bm &amp; sample == sample</code> and with a cardinality of N.<br/>
Would you consider adding it?</p>
</div>
<ol class="children">
<li id="comment-424787" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-21T00:45:06+00:00">August 21, 2019 at 12:45 am</time></a> </div>
<div class="comment-content">
<p><em>Would you consider adding it?</em></p>
<p>Would you be willing to help out?</p>
</div>
</li>
</ol>
</li>
</ol>
