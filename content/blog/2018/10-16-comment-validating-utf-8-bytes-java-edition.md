---
date: "2018-10-16 12:00:00"
title: "Validating UTF-8 bytes (Java edition)"
index: false
---

[14 thoughts on &ldquo;Validating UTF-8 bytes (Java edition)&rdquo;](/lemire/blog/2018/10-16-validating-utf-8-bytes-java-edition)

<ol class="comment-list">
<li id="comment-359649" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-24T04:18:56+00:00">October 24, 2018 at 4:18 am</time></a> </div>
<div class="comment-content">
<p>In principle, the (single-stream) DFA approach is limited by the L1 latency: the lookups it does in the transition table are all serially dependent from one byte to the next. This only applies to the transition lookup through (the outermost one): the other two loads (reading a byte from the string, and doing the byte value to class lookup) can be done in parallel and don&rsquo;t contribute directly to the dependency chain.</p>
<p>In this context the L1 latency on Intel is 5 cycles, plus one cycle for the addition operation (the <code>s + ...</code> part of calculating the transition lookup), so the &ldquo;speed limit&rdquo; here is 6 cycles. Since there is only a small amount of additional work to do within those 6 cycles (two more loads, basically), one might expect this &ldquo;speed limit&rdquo; and the measured speed to be very close.</p>
<p>However you measure 7.5 cycles, as do I on my local system. Where are the extra 1.5 cycles coming from?</p>
<p>It turns out that the form of the indexing in the loop is very important. Java is able to eliminate bounds checks from static final arrays where it can prove that the index value are always in bounds. So if restricting the index to 0-255 <code>&amp; 0xFF</code> removes the bounds check if the array has at least 256 elements. This is news to me (I learned about it from a comment in the source), and pretty cool. This was only working for the first lookup (character value to class), but not for the second, so the JIT puts in a lot of bounds checking (in theory it should be only a couple of instructions, but in practice it ended up being a lot more due to some sub-optimal code generation). You can see the effect with <code>-prof perfasm</code> in JMH.</p>
<p>If you move the <code>&amp; 0xFF</code> to the outside of this indexing calculation, <a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/pull/25/files#diff-bd92c1efdb61f2edef6bd48ec2c23889R199" rel="nofollow">like this</a>, this gets fixed and I measure about 5.96 cycles now &#8211; right at our speed limit. In fact, slightly less than our speed limit. How is that possible? Well a single call is itself a long dependency chain, but some overlap is possible <em>between</em> calls to <code>isUTF8</code>: so when you get near the end of the string, you might actually start on the next string, so it&rsquo;s possible to break the speed limit slightly due to that effect. I&rsquo;m testing 944 byte strings (N=191), so the effect is still noticeable but overall it goes to zero as your strings get longer. Just another pitfall to watch out for in benchmarking.</p>
<p>The DFA approach has lots of room left to execute instructions but is limited by the dependency chain. One &ldquo;fix&rdquo; is to do run more than one DFA at once (it is in this context I said &ldquo;single-stream&rdquo; above): you could start both at the beginning of the string, and half way through the string and run the two DFAs in the same loop. If the JIT doesn&rsquo;t go crazy it should be almost twice as fast.</p>
<p>You can do more than two steams, but it will run out of steam pretty quickly: when you run out of registers, or when you bottleneck on some other execution resource.</p>
</div>
<ol class="children">
<li id="comment-359658" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-24T05:05:24+00:00">October 24, 2018 at 5:05 am</time></a> </div>
<div class="comment-content">
<p>Here&rsquo;s an example of the two-stream DFA approach:</p>
<p><code> public static boolean isUTF8_double(byte[] b) {<br/>
int length = b.length, half = length / 2;<br/>
while (b[half] &lt;= (byte)0xBF &amp;&amp; half &gt; 0) {<br/>
half--;<br/>
}<br/>
int s1 = 0, s2 = 0;<br/>
for (int i = 0, j = half; i &lt; half; i++, j++) {<br/>
s1 = utf8d_transition[(s1 + (utf8d_toclass[b[i] &amp; 0xFF])) &amp; 0xFF];<br/>
s2 = utf8d_transition[(s2 + (utf8d_toclass[b[j] &amp; 0xFF])) &amp; 0xFF];<br/>
}<br/>
for (int i = half * 2; i &lt; b.length; i++) {<br/>
s1 = utf8d_transition[(s1 + (utf8d_toclass[b[i] &amp; 0xFF])) &amp; 0xFF];<br/>
}<br/>
return s1 == 0 &amp;&amp; s2 == 0;<br/>
}<br/>
</code></p>
<p>After warmup, I get a speedup of 1.98x, so it&rsquo;s almost exactly twice as fast (but the first iteration behavior is slightly weird, slower for the two-stream DFA, which is normal, but faster for the single one, so the JIT is maybe making a bad decision &#8211; but in any case the speedup appears to be close to 2x regardless).</p>
<p>This not tested, but it should be &ldquo;approximately right&rdquo; and I don&rsquo;t expect fixes to hurt the performance.</p>
</div>
<ol class="children">
<li id="comment-359759" class="comment byuser comment-author-lemire bypostauthor even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-24T14:05:46+00:00">October 24, 2018 at 2:05 pm</time></a> </div>
<div class="comment-content">
<p>Post and code updated, I credit you in the updated blog post.</p>
<p>Given how fast the Guava code is, it is hard to make a case for the finite-state-machine approach. The main drawback to the Guava approach are the branch mispredictions, but I was not able to make it suffer. Of course, with real data it could well happen. Or maybe someone could generate more clever synthetic data (wouldn&rsquo;t be very hard as I did a hasty job).</p>
<p>Still, if you expect your strings to be often &ldquo;almost ASCII&rdquo; then the Guava code is probably pretty good.</p>
</div>
<ol class="children">
<li id="comment-359774" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-24T15:46:50+00:00">October 24, 2018 at 3:46 pm</time></a> </div>
<div class="comment-content">
<p>I think the ns column is out of date.</p>
<p>Don&rsquo;t give up on the DFA entirely: the two stream version in the push request is about twice as fast and you can add more streams which should be faster yet. Perhaps it can beat the Guava approach at least on mixed text.</p>
<p>For stuff that is almost entirely ASCII it&rsquo;s a different game: Guava has a special loop to handle ASCII (even after it finds the first non-ASCII character), so I expect it to be fairly fast. However, other algorithms like the DFA approach can also be adopted to the same approach, although sometimes it slows down the mixed case.</p>
<p>The fastest way to do the ASCII check in Java is if you can get SWAR going, which is possible but tricky &#8211; maybe I&rsquo;ll post a bit on that later.</p>
</div>
<ol class="children">
<li id="comment-359857" class="comment byuser comment-author-lemire bypostauthor even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-24T22:02:42+00:00">October 24, 2018 at 10:02 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>I think the ns column is out of date.</p>
</blockquote>
<p>It is. I deleted it for now.</p>
<blockquote>
<p>Guava has a special loop to handle ASCII (even after it finds the first non-ASCII character)</p>
</blockquote>
<p>It does, but I am not sure it is necessarily a fruitful optimization. If you think about it, the naive code is just a loop over the characters. You first check whether it is an ASCII character, if so, you just continue the loop. If it is not, you look at more characters. That&rsquo;s the general pseudocode. Maybe it is a failure of imagination on my part, but I think that there is nothing particularly optimized in the Guava code. (Note: this is not criticism. It is good code. )</p>
<p>The real story is whether a finite state machine can beat a Guava-like routine when most of the data is ASCII.</p>
<p>Of course, you can bypass the state machine with a fast ASCII check&#8230; but you have to patch the state.</p>
<p>Probably what you have in mind is to use SWAR to check for ASCII, and if so, you just jump ahead.</p>
<p>SWAR is conceptually easy, I would think&#8230; it is just a bitwise OR and a comparison. But you need to convince Java to produce the right code.</p>
</div>
<ol class="children">
<li id="comment-359879" class="comment odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-25T00:58:06+00:00">October 25, 2018 at 12:58 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
It does, but I am not sure it is necessarily a fruitful optimization.<br/>
If you think about it, the naive code is just a loop over the<br/>
characters. You first check whether it is an ASCII character, if so,<br/>
you just continue the loop.
</p></blockquote>
<p>It might not be in all cases, but it often is, and I have a fair amount of confidence that&rsquo;s probably how this &ldquo;redundant&rdquo; code ended up there as I have a fair amount of faith in the quality of Guava.</p>
<p>Basically splitting out these simpler loops makes a better optimization target, or communicates more information to the compiler.</p>
<p>The compiler usually tries optimizes loops: that is, it does more work outside the loop and reorganizes the loop so that the body of the loop is as fast as possible. If you have a separate ASCII loop, the compiler will optimize that loop which will give you (in principle) the fastest way the the compiler knows how to optimize that loop.</p>
<p>Once you have a bigger loop, with several checks and exit condition, the compiler will try to optimize that whole loop the best it knows how. It doesn&rsquo;t know which branches are likely to be taken. It might try to reduce branches by using conditional moves, it might reorder your branches or use another trick like a jump table. It might hoist instructions needed in most branches but not in the ASCII one. Basically it is much less likely to produce an optimal result for the thing you consider fast path.</p>
<p>By splitting it out into its own loop you take advantage of the compilers natural behavior of optimizing loops kind of as a &ldquo;unit&rdquo;.</p>
<p>A practical example that doesn&rsquo;t require discussing in detail specific x86 loops would be vectorization: you could see how a small loop like the isASCII loop could be vectorized efficiently by the compiler. Actually as it happens none of them vectorize this specific loop since it has an &ldquo;early exit&rdquo; which makes it trickier, but it in principle it can be done. However, vectorizing the whole loop is much harder: it can also be done, but you end up with a much slower loop since it has to handle all the cases, via blends and so on. By splitting out the loop, you tell the compiler: hey, it&rsquo;s OK to vectorize this part separately.</p>
<p>We can run a quick check. Here are three results:</p>
<p>ASCII only</p>
<p><code>Benchmark (N) Mode Cnt Score Error Units<br/>
Utf8Validate.testGuava_utf8 191 avgt 3 243.306 Â± 0.864 ns/op<br/>
Utf8Validate.testGuava_utf8 1910 avgt 3 2447.032 Â± 30.404 ns/op<br/>
Utf8Validate.testGuava_utf8 19100 avgt 3 24043.625 Â± 148.429 ns/op<br/>
Utf8Validate.testGuava_utf8 191000 avgt 3 239788.187 Â± 2045.625 ns/op<br/>
</code></p>
<p>ASCII mostly Google style</p>
<p><code>Benchmark (N) Mode Cnt Score Error Units<br/>
Utf8Validate.testGuava_utf8 191 avgt 3 417.054 Â± 2.246 ns/op<br/>
Utf8Validate.testGuava_utf8 1910 avgt 3 4148.617 Â± 97.589 ns/op<br/>
Utf8Validate.testGuava_utf8 19100 avgt 3 40847.803 Â± 2004.263 ns/op<br/>
Utf8Validate.testGuava_utf8 191000 avgt 3 407459.188 Â± 3612.164 ns/op<br/>
</code></p>
<p>ASCII mostly Daniel style</p>
<p><code>Benchmark (N) Mode Cnt Score Error Units<br/>
Utf8Validate.testGuava_utf8 191 avgt 3 2935.855 Â± 53.121 ns/op<br/>
Utf8Validate.testGuava_utf8 1910 avgt 3 28493.618 Â± 346.513 ns/op<br/>
Utf8Validate.testGuava_utf8 19100 avgt 3 281275.029 Â± 3620.771 ns/op<br/>
Utf8Validate.testGuava_utf8 191000 avgt 3 866452.130 Â± 38382.579 ns/op<br/>
</code></p>
<p>This is the same benchmark as you but code, but with a modified string. ASCII only zeros the top bit so all chars are single-byte ASCII chars. Here we never drop into <code>isWellFormedSlowPath</code> at all, so we are testing the initial loop that you describe in your blog post above. We get about 0.66 cycles per byte &#8211; very fast!</p>
<p>Then the ASCII mostly has a single Chinese (I think) character then all ASCII, so we avoid this first loop. &ldquo;Google style&rdquo; is the existing Guava code, and &ldquo;Daniel style&rdquo; is removing the loop part of <code>isWellFormedSlowPath</code> and adding a check <code>if (byte &gt; 0) continue;</code> before the other conditions.</p>
<p>We see that the existing code does benefit from the initial loop: breaking it into the fast and slow path gives a 1.7x speedup, probably because the compiler can make an even simpler loop when it doesn&rsquo;t have to track the byte value and can probably unroll it.</p>
<p>Removing the special case ASCII loop in the slow path produces a much bigger impact, the speedup of that trick was 7x! So here it paid off big time, for mostly ASCII strings. It changes the result from around 1.1 cycles per byte to 8 cycles per byte! This blog post might look very different if that implementation had been used.</p>
<p>Such a big difference is frankly pretty weird. I could have messed up or perhaps you can blame the JIT for doing something stupid. However, I have seen this pattern repeated in high performance code and have seen the generated code myself so the general effect is real enough.</p>
<blockquote><p>
but I think that there is nothing particularly optimized in the Guava code.
</p></blockquote>
<p>It seems optimized to me in the sense that I don&rsquo;t see what more you could do once you&rsquo;ve decided on &ldquo;explicit checks and branches&rdquo;. They definitely seem to have gotten the non-obvious ASCII part right with two apparently redundant loops that got more than a 10x speedup. They use some clever tricks for detecting the various byte classes that take advantage of signed bytes in order to detect byte types in a single comparison that would natively take 2 comparisons or some other operation plus 1 comparison.</p>
<blockquote><p>
The real story is whether a finite state machine can beat a Guava-like<br/>
routine when most of the data is ASCII.
</p></blockquote>
<p>Well my claim is sort of like if your stuff is mostly ASCII then you want special ASCII handling which will look mostly similar regardless of your slow path, so &ldquo;guava like&rdquo; or &ldquo;DFA like&rdquo; is most irrelevant at that point, at least as you approach the limit of &ldquo;all ASCII&rdquo;.</p>
<blockquote><p>
Of course, you can bypass the state machine with a fast ASCII checkâ€¦ but you have to patch the state.
</p></blockquote>
<p>Well the state is always zero in between valid characters, so you can just skip as many ASCII bytes as you want and the state stays zero (said another way, state 0 is mapped to state 0 every time an ASCII character occurs).</p>
<p>So probably you&rsquo;d do some kind of fast ASCII check and then fall back to X when you detect non-ASCII chars. Depending on how frequent non-ASCII chars actually are, what X is may vary, and also the strategy of bouncing back and forth would vary.</p>
</div>
<ol class="children">
<li id="comment-359885" class="comment byuser comment-author-lemire bypostauthor even depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-25T01:08:28+00:00">October 25, 2018 at 1:08 am</time></a> </div>
<div class="comment-content">
<p><em>Well the state is always zero in between valid characters, so you can just skip as many ASCII bytes as you want and the state stays zero (said another way, state 0 is mapped to state 0 every time an ASCII character occurs).</em></p>
<p>Suppose that X1 X2 X3 is a valid 3-byte UTF-8 code point. Suppose that I insert an ASCII character A in there: X1 A X2 X3. The result is non valid. If I just skip the ASCII characters, I will not properly validate the string. So I need to do &ldquo;something&rdquo; to &ldquo;patch the state&rdquo;. This cost can be tiny, but you can&rsquo;t ignore the state.</p>
</div>
<ol class="children">
<li id="comment-359888" class="comment odd alt depth-8">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-25T01:20:46+00:00">October 25, 2018 at 1:20 am</time></a> </div>
<div class="comment-content">
<p>Well are are just using different definitions for &ldquo;skip&rdquo;. I don&rsquo;t mean that you skip ASCII characters in such a way that previous non-adjacent characters like X1 and X2 now appear next to each other (i.e., somehow &ldquo;filtering out&rdquo; ASCII characters and then processing the merged string).</p>
<p>I just mean if you have consecutive ASCII characters you can skip them in the sense that you only process the characters before and after, but &ldquo;before&rdquo; and &ldquo;after&rdquo; are separate strings and the state has to be checked at the end of the &ldquo;before&rdquo; string. Maybe this can be called &ldquo;patching&rdquo; the state, but I think it probably naturally falls out of the code since you have to do more things at the transition point.</p>
<p>The game is more to balance the code in the middle region where there are &ldquo;some&rdquo; non-ASCII, characters, as this is common in many languages, like French which are largely ASCII but for accented characters. Large skips probably aren&rsquo;t possible here, but still perhaps 90% of characters are ASCII.</p>
</div>
</li>
</ol>
</li>
<li id="comment-359890" class="comment byuser comment-author-lemire bypostauthor even depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-25T01:28:44+00:00">October 25, 2018 at 1:28 am</time></a> </div>
<div class="comment-content">
<p>I already had coded a <a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2018/10/16/src/main/java/me/lemire/microbenchmarks/algorithms/Utf8Validate.java#L180-L232" rel="nofollow">simpler version</a>. There is a difference, but it is tiny. It seems just as fast as the Guava version in my tests, plus/minus some small margin. We seem to agree that, algorithmically, it is equivalent. I don&rsquo;t doubt that it can result in different code&#8230; compilers are sensitive to how the code is written, certainly.</p>
<p>Here are my exact results&#8230;</p>
<pre><code>Utf8Validate.testGuavaSimpler_utf8  191   ASCII  avgt    3   2481476.591 Â±   562462.623  ns/op
Utf8Validate.testGuavaSimpler_utf8  191    UTF8  avgt    3  19083439.790 Â±   130528.023  ns/op
Utf8Validate.testGuava_utf8         191   ASCII  avgt    3   2483272.792 Â±   240088.451  ns/op
Utf8Validate.testGuava_utf8         191    UTF8  avgt    3  19061683.123 Â±   465399.508  ns/op
</code></pre>
<p>I wrote this code before you wrote your comment, as you can check through my commits.</p>
<p>I&rsquo;ll repeat once more, just so that there is no misunderstanding, that I am not critical of Guava and of the quality of its code. I recommend using Guava in this case.</p>
</div>
<ol class="children">
<li id="comment-359927" class="comment odd alt depth-8 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-25T05:28:18+00:00">October 25, 2018 at 5:28 am</time></a> </div>
<div class="comment-content">
<p>As far as I understand your code, the ASCII mode is only ASCII characters, so the &ldquo;slowpath&rdquo; code highlighted and that we&rsquo;ve been discussing never gets executed at all, so yes it performs identically since it only ever executes identical code.</p>
<p>You need at least one non-ASCII char (logically, near the beginning of the string) to test the code path we&rsquo;re discussing here.</p>
</div>
<ol class="children">
<li id="comment-360077" class="comment byuser comment-author-lemire bypostauthor even depth-9">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-26T01:32:26+00:00">October 26, 2018 at 1:32 am</time></a> </div>
<div class="comment-content">
<p>Ah. Now I understand. Yes, I agree with you entirely then.</p>
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
<li id="comment-359847" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-24T20:44:21+00:00">October 24, 2018 at 8:44 pm</time></a> </div>
<div class="comment-content">
<p>I also found it surprising that Guava is &ldquo;so fast&rdquo;. As you mention, you&rsquo;d expect branch misses to impact this algorithm.</p>
<p>As it turns out they do, but your string needs to be long enough. In the N=191 (944 bytes) case, the branch predictor is able to <em>memorize the entire pattern</em> &#8211; there is less than one branch (on average 0.2) for the entire function. Even at N=1910 (about 9440 bytes), the predictor can memory substantially the entire function: there are on average only 10 mispredicts, or about 1 mispredict every 1000 bytes.</p>
<p>Yes, TAGE is quite amazing and in fact this type of pattern is where it excels: the random nature of the branches forms an effective high-entropy &ldquo;key&rdquo; to look up the predictor tables, allowing many unique histories to be predicted. This is not the first time I&rsquo;ve seen sequences of thousands of random branches well-predicted. On the other hand, TAGE does poorly when predicting the exit of simple fixed-count loops: if you loop 30 or 40 times and always exit at the same count, TAGE will reliably fail. In fact it is only able to predict the loop exit precisely in this case (for N=191 there are only 0.2 mispredicts, so it must get the loop exit right most of the time), because the random branches <em>inside</em> the loop give it enough information to key off of to predict the branch. I recommend any of the early TAGE papers: the mechanism is simple and powerful.</p>
<p>Anyways, finally at N=19100 the branch prediction fails: and the performance drops substantially. The mispredicts jump to 18,000 (across about 94,400 bytes) and time jumps to 6.2 cycles per byte. The double, triple and quad stream DFA approaches are much faster, since they stay steady at about 2.4 to 2.6 cycles per byte, for all N values.</p>
<p>So I think you can say that the DFA approach is better, as long as you use at least double streams, <em>in the case the stream to validate</em> has a heavy mix of character lengths, and is not predictable. I think in the usual case (outside of benchmarks) the &ldquo;is not predictable&rdquo; condition holds, but the character composition obvious depends on the application and especially the language.</p>
<p>You can see the branch prediction information by appending <code>-prof perfnorm</code> to the command line when you run your benchmark.</p>
</div>
<ol class="children">
<li id="comment-359859" class="comment byuser comment-author-lemire bypostauthor even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-24T22:22:30+00:00">October 24, 2018 at 10:22 pm</time></a> </div>
<div class="comment-content">
<p>I have updated the code and the post to reflect this important insight.</p>
<p>I could not figure out why the branch mispredictions did not kill the performance. In retrospect, it seems somewhat obvious.</p>
<p>Thanks!</p>
</div>
<ol class="children">
<li id="comment-359880" class="comment odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-25T01:00:12+00:00">October 25, 2018 at 1:00 am</time></a> </div>
<div class="comment-content">
<p>I think the non-obvious part is that the branch predictor can memorize a series of 20,000 branches with almost 100% accuracy. That&rsquo;s pretty interesting.</p>
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
