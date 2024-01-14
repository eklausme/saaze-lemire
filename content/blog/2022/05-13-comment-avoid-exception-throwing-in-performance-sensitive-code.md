---
date: "2022-05-13 12:00:00"
title: "Avoid exception throwing in performance-sensitive code"
index: false
---

[18 thoughts on &ldquo;Avoid exception throwing in performance-sensitive code&rdquo;](/lemire/blog/2022/05-13-avoid-exception-throwing-in-performance-sensitive-code)

<ol class="comment-list">
<li id="comment-633017" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b0c28eb357bb2ad8dee40d974871340?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b0c28eb357bb2ad8dee40d974871340?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">E.S.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-05-15T17:47:48+00:00">May 15, 2022 at 5:47 pm</time></a> </div>
<div class="comment-content">
<p>To make the cost of exceptions more explicit, consider Java. When an exception is thrown, a full backtrace is stored. This involves quite some memory allocation.</p>
<p>Now if you are in a language with elegant and efficient optionals such as Rust, you can get some very nice code to handle nonstandard cases.<br/>
But things get more tricky when you need to, e.g., parse numbers from a stream. What if you expect a number, but it&rsquo;s syntax is invalid? In Java, the method then no longer can return a native int, but you would need to trust the hotspot compilers escape analysis to eliminate all overhead from returning a double boxed Optional.<br/>
Some tools (e.g., ELKI <a href="https://github.com/elki-project/elki/blob/146bcb9fbc428e9c4bccdfde3e6f17ae18a38ebd/elki-core-util/src/main/java/elki/utilities/io/ParseUtil.java#L162" rel="nofollow ugc">https://github.com/elki-project/elki/blob/146bcb9fbc428e9c4bccdfde3e6f17ae18a38ebd/elki-core-util/src/main/java/elki/utilities/io/ParseUtil.java#L162</a> ) use preallocated exceptions without a stack trace in performance critical paths, where exceptions are somewhat needed to not pay other overheads (boxing) and a lot of boilerplate code to unbox and handle the exceptions yourself.<br/>
I don&rsquo;t know if something similar would be possible in C?<br/>
The Rust solution here seems very nice and elegant to me.</p>
</div>
<ol class="children">
<li id="comment-648526" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/df65ecaa0c2c122642aeff08e00c55b1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/df65ecaa0c2c122642aeff08e00c55b1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://gorton-machine.org/rick" class="url" rel="ugc external nofollow">RICHARD GORTON</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-22T02:23:01+00:00">December 22, 2022 at 2:23 am</time></a> </div>
<div class="comment-content">
<p>do NOT use Java or any other interpreted languages.<br/>
do NOT implement on any architecture which does not hardware support for integer underflows or overflows.<br/>
do NOT use IEEE floating point EVER, when the number can underflow or overflow the IEEE values unless you REALLY, REALLY (really) understand the implications. 99% of folks do not understand said implications</p>
</div>
<ol class="children">
<li id="comment-648529" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/97b691cbe6a457fe1de58da61d411e0a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/97b691cbe6a457fe1de58da61d411e0a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">steve</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-22T04:04:57+00:00">December 22, 2022 at 4:04 am</time></a> </div>
<div class="comment-content">
<p>Java is not an interpreted language</p>
</div>
<ol class="children">
<li id="comment-648533" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f5c257f11daecf0b696b6a4aefd600e2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f5c257f11daecf0b696b6a4aefd600e2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://joshenders.com" class="url" rel="ugc external nofollow">Josh Enders</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-22T05:52:55+00:00">December 22, 2022 at 5:52 am</time></a> </div>
<div class="comment-content">
<p>I’m admittedly not deep in the Java ecosystem but my understanding is that the Java runtime (coretto/oracle JRE) is still an interpreter with a JIT.</p>
</div>
</li>
</ol>
</li>
<li id="comment-648534" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9f57a0b8bcfd77585fa2fd171455054e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9f57a0b8bcfd77585fa2fd171455054e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Carlos</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-22T08:23:10+00:00">December 22, 2022 at 8:23 am</time></a> </div>
<div class="comment-content">
<p>Stop living in the 90s.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-633111" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b03d059a843e13354bb9a57ffc85fb02?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b03d059a843e13354bb9a57ffc85fb02?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Champok Das</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-05-16T15:54:54+00:00">May 16, 2022 at 3:54 pm</time></a> </div>
<div class="comment-content">
<p>I think that optimizing for the most common path and then adjusting for the extraordinary path is the best way to do things.</p>
<p>Exceptions should be rare, building the context for an exception is done dynamically as far as I can remember. There is a fair amount of discussion about exactly this topic here on StackOverflow: <a href="https://stackoverflow.com/questions/13835817/are-exceptions-in-c-really-slow" rel="nofollow ugc">https://stackoverflow.com/questions/13835817/are-exceptions-in-c-really-slow</a></p>
<p>To build onto the comment of E.S., here is more historical context as to why C++ does not store the context except precisely where an exception occurs: <a href="https://stackoverflow.com/questions/3311641/c-exception-throw-catch-optimizations" rel="nofollow ugc">https://stackoverflow.com/questions/3311641/c-exception-throw-catch-optimizations</a></p>
<p>The current accepted answer as of May 16, 2022 links to the clang-dev mailing list describing why exceptions are done the way they are: <a href="https://lists.llvm.org/pipermail/cfe-dev/2015-March/042035.html" rel="nofollow ugc">https://lists.llvm.org/pipermail/cfe-dev/2015-March/042035.html</a></p>
<p>Lemire does make an excellent point and I wholly agree.</p>
<p>I have rather harsh opinion on error codes, mostly for the meat space aspect where context may not easily be understood or there is cascade of missing context(s) on the scheme of returning codes up the stack of a call that goes deep. But that is probably a discussion for a later time.</p>
</div>
</li>
<li id="comment-633518" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Joern Engel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-05-20T07:00:39+00:00">May 20, 2022 at 7:00 am</time></a> </div>
<div class="comment-content">
<p>The result of &ldquo;0.05 ns/value&rdquo; is highly dubious. If your test machine has 5GHz and you manage to execute 4 instructions per cycle, you still consume 0.05 ns/instruction. The code looks like it would take more than 1 instruction per value.</p>
<p>You use the result, so the compiler probably doesn&rsquo;t remove the entire loop. But the core looks simple enough for auto-vectorization. Depending on your view, that may make the comparison unfair.</p>
<p>Then again, even translated to scalar code I would expect throughput around 1ns/value, still 500x faster than the exception variant.</p>
</div>
<ol class="children">
<li id="comment-633547" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-05-20T14:21:26+00:00">May 20, 2022 at 2:21 pm</time></a> </div>
<div class="comment-content">
<p>I am not sure why you are saying that the result is dubious. You would expect most compilers to autovectorize the exception-free routine. That&rsquo;s the desired output.</p>
</div>
<ol class="children">
<li id="comment-634255" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">me</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-05-26T06:56:28+00:00">May 26, 2022 at 6:56 am</time></a> </div>
<div class="comment-content">
<p>I understand his argument that you end up measuring two effects at the same time: the (in-)ability to auto-vectorize this simple code and the overhead of exception handling. And that it would be better to test an example where no auto-vectorization happens when you&rsquo;re interested in the overhead of using exception traps itself.</p>
</div>
<ol class="children">
<li id="comment-634332" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-05-26T13:21:50+00:00">May 26, 2022 at 1:21 pm</time></a> </div>
<div class="comment-content">
<p>Please propose a benchmark which measures solely &ldquo;the overhead of exception handling&rdquo;.</p>
</div>
<ol class="children">
<li id="comment-635957" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">me</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-06-08T05:39:45+00:00">June 8, 2022 at 5:39 am</time></a> </div>
<div class="comment-content">
<p>I am not an expect on microbenchmarking C.<br/>
Maybe some compiler hint to prevent auto vectorization,<br/>
__attribute__((optimize(&ldquo;no-tree-vectorize&rdquo;)))<br/>
and a more expensive computation inside (say, sqrt or cos) helps. And a third version with no if statement, so we can measure the overhead of if/exception vs. branchless. Though I would expect branchless to not make much of a difference because of CPU pipelining. It if we get the 500 ns/value again, we know it&rsquo;s reliable. Then try with positive/negative input data only to see if the cost is asymmetric. Because if it&rsquo;s highly asymmetric, it may still be fine to use for low frequency case handling.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-634662" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Joern Engel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-05-28T21:53:35+00:00">May 28, 2022 at 9:53 pm</time></a> </div>
<div class="comment-content">
<p>Maybe &ldquo;surprising&rdquo; would have been a better term. Typically when I see performance numbers far outside my expectation, there is a bug somewhere. In this case the answer is auto-vectorization, so not a bug.</p>
<p>Whether it is a fair comparison is a matter of debate. Both answers seem defensible. Anyway, thank you for the interesting benchmark.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-634866" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/813a73d7279efdda53dc8cd61a2348a2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/813a73d7279efdda53dc8cd61a2348a2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Luke Peterson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-05-31T08:24:10+00:00">May 31, 2022 at 8:24 am</time></a> </div>
<div class="comment-content">
<p>I randomly stumbled across this article and decided to measure it using Google&rsquo;s benchmark library. I did it locally and on Quickbench and did not observe the same results as you. You can take a look here:</p>
<p><a href="https://godbolt.org/z/EohfcxMx6" rel="nofollow ugc">https://godbolt.org/z/EohfcxMx6</a></p>
<p>Click on the &ldquo;Quick-bench&rdquo; link above the source code, and then &ldquo;Run benchmark&rdquo; on quick bench website. Alternatively you could build this locally and test, though you do need to ensure you turn of cpu throttling to get accurate numbers.</p>
<p>If you haven&rsquo;t already, Niall Douglas&rsquo; outcome and status-code are worth checking out (as well as std::expected), Niall has done some interesting benchmarks:</p>
<p><a href="https://www.boost.org/doc/libs/master/libs/outcome/doc/html/faq.html#is-outcome-suitable-for-fixed-latency-predictable-execution-coding-such-as-for-high-frequency-trading-or-audio" rel="nofollow ugc">https://www.boost.org/doc/libs/master/libs/outcome/doc/html/faq.html#is-outcome-suitable-for-fixed-latency-predictable-execution-coding-such-as-for-high-frequency-trading-or-audio</a></p>
<p><a href="https://github.com/ned14/outcome" rel="nofollow ugc">https://github.com/ned14/outcome</a><br/>
<a href="https://github.com/ned14/status-code" rel="nofollow ugc">https://github.com/ned14/status-code</a></p>
</div>
<ol class="children">
<li id="comment-634874" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-05-31T13:51:12+00:00">May 31, 2022 at 1:51 pm</time></a> </div>
<div class="comment-content">
<p>Your benchmark measures the time needed to sum empty arrays. Unsurprisingly, it is a flat tiny cost.</p>
<p>Try with the following routine.</p>
<p><code>for (size_t i = 0; i != 10000; i++) {<br/>
data.push_back((rand() % 1000) - 500);<br/>
}<br/>
</code></p>
<p>Google Benchmark is convenient, but it does not do anything magical. This being said, tools like Google Benchmark do report the effective CPU frequency when they can so any throttling would be detected. In this instance, it is highly unlikely you will experience throttling on a reasonable platform. In any case, the result is so plain that no sophistication is needed to measure it.</p>
<p>Thanks for the links.</p>
</div>
<ol class="children">
<li id="comment-634897" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/813a73d7279efdda53dc8cd61a2348a2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/813a73d7279efdda53dc8cd61a2348a2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Luke Peterson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-05-31T17:50:19+00:00">May 31, 2022 at 5:50 pm</time></a> </div>
<div class="comment-content">
<p>Oops! You are correct, I&rsquo;ve updated the example here:</p>
<p><a href="https://godbolt.org/z/Yq3oh9oo7" rel="nofollow ugc">https://godbolt.org/z/Yq3oh9oo7</a></p>
<p>On this updated benchmark on Quickbench, the with exception version is 450 times slower than the without exception version.</p>
<p>I agree that Google benchmark doesn&rsquo;t do anything magical, but it does make sharing benchmarks much more concise and does offer quite a few nice utility functions/macros that are annoying to re-implement.</p>
</div>
<ol class="children">
<li id="comment-634922" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-05-31T18:38:17+00:00">May 31, 2022 at 6:38 pm</time></a> </div>
<div class="comment-content">
<p>The next blog post chronologically reports on benchmarks written with Google Benchmarks&#8230;</p>
<p><a href="https://lemire.me/blog/2022/05/25/parsing-json-faster-with-intel-avx-512/" rel="ugc">https://lemire.me/blog/2022/05/25/parsing-json-faster-with-intel-avx-512/</a></p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-648530" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1e9866c16456de429c0ea0d353e0ef8c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1e9866c16456de429c0ea0d353e0ef8c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://mongodb.com" class="url" rel="ugc external nofollow">Geert Bosch</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-22T04:17:14+00:00">December 22, 2022 at 4:17 am</time></a> </div>
<div class="comment-content">
<p>Some time ago, I optimized a very performance sensitive data validation routine. While the original code was good, it didn&rsquo;t pay a lot of attention to optimizing the common path and separating the more difficult cases. In addition there were some places where we could replace branchy code by small table lookups. I expected gains there.</p>
<p>The code also returned a status that was either OK or some error code. Mostly for code readability and I-cache footprint, I decided to remove the explicit status handling in favor of throwing exceptions on (very rare) exception cases where the input fails validation. To my surprise, the performance benefits were large (like 2x), even for the Google benchmark loops that have great cache locality. The knock-on benefits of telling the compiler (&ldquo;this will not actually happen&rdquo;, which implicitly confers a will-not-return attribute and puts all code dominating the basic block in question in a cold segment) are tremendous. If gives the compiler information that it can propagate forward and backward through the code: it serves either as a challenge to prove an assertion (and then use that for optimization purposes), or leave a dynamic check with a &ldquo;known&rdquo; outcome, resulting in great code on the happy path. In all, validation speed improved by about an order of magnitude, something inconceivable without taking advantage of never-taken exception paths. </p>
<p>(The code in question is in the validateBSON routine of the MongoDB server.)</p>
</div>
</li>
<li id="comment-648531" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1e9866c16456de429c0ea0d353e0ef8c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1e9866c16456de429c0ea0d353e0ef8c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://mongodb.com" class="url" rel="ugc external nofollow">Geert Bosch</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-22T04:32:21+00:00">December 22, 2022 at 4:32 am</time></a> </div>
<div class="comment-content">
<p>To add to my previous comment, a corollary to your post would be: &ldquo;Avoid returning error codes from performance sensitive code.&rdquo; There&rsquo;s great benefit in focusing on the happy no-error path, and entirely separating out error-handling code.</p>
<p>For the input validation part, we expect it never to fail in production code. However, we can&rsquo;t afford to omit validation. While true zero-cost error handling may be a holy grail that we&rsquo;ll never find, current C++ exception handling comes pretty close. Without a doubt, it&rsquo;s a significant improvement over explicit error code handling, both for performance as well as code clarity.</p>
</div>
</li>
</ol>
