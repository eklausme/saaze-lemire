---
date: "2019-05-16 12:00:00"
title: "Building better software with better tools: sanitizers versus valgrind"
index: false
---

[19 thoughts on &ldquo;Building better software with better tools: sanitizers versus valgrind&rdquo;](/lemire/blog/2019/05-16-building-better-software-with-better-tools-sanitizers-versus-valgrind)

<ol class="comment-list">
<li id="comment-407241" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b691c99f54aaf2f7a89b577343e2a13d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b691c99f54aaf2f7a89b577343e2a13d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Konstantin Yegupov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-17T16:03:57+00:00">May 17, 2019 at 4:03 pm</time></a> </div>
<div class="comment-content">
<p>Have you looked at third-party tools like <a href="https://www.viva64.com/en/pvs-studio/" rel="nofollow ugc">https://www.viva64.com/en/pvs-studio/</a> ?</p>
</div>
<ol class="children">
<li id="comment-407257" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-17T17:47:22+00:00">May 17, 2019 at 5:47 pm</time></a> </div>
<div class="comment-content">
<p>Static analysis has its uses, but it is no substitute for sanitizers.</p>
</div>
</li>
</ol>
</li>
<li id="comment-407274" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-17T20:21:27+00:00">May 17, 2019 at 8:21 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m not sure how one would read that list and come to the conclusion you should almost always prefer santizers. Things like &ldquo;install a new compiler&rdquo; seem like they might be pretty major roadblocks to someone who just wants a quick solution.</p>
<p>I use both tools and both are very useful in the areas where they overlap (so I&rsquo;m only talking about ASAN-type sanitizers which roughly overlap with valgrind not things like UBSAN which have no counterpart).</p>
<p>Valgrind catches one giant source of corruption that ASAN sanitizers doesn&rsquo;t: uninitalized reads. That has to be one of the biggest practical memory safety issues in C and C++, so failing to catch that is IMO a showstopper for ASAN-only-never-valgrind. ASAN also doesn&rsquo;t catch all problems even in the categories it supports because it tracks memory accesses only at a certain granularity, so wrong accesses that fall within that granularity aren&rsquo;t caught.</p>
<p>I just say &ldquo;use both tools&rdquo;.</p>
<p>That said, I usually use valgrind first, because it&rsquo;s 9 characters away: just replace <code>foo</code> with <code>valgrind foo</code> and you are off and running: no need to recompile, no need to worry about compiler support, recompiling dependencies, etc. For most small projects valgrind I need because I never have complicated enough issues to go beyond that.</p>
<p>On most projects, just use both: build and run your test suite with the sanitizers for sure, and now-and-then with valgrind to catch things the sanitizers don&rsquo;t. Making sure the santized versions of the binaries available in your build goes a long way to reducing the friction for santizer use. Note that most sanitizers cannot be enabled together, so if you want to use &ldquo;all&rdquo; the sanitizers you&rsquo;ll need to build many binaries. Maybe concentrate first on the most interesting ones.</p>
<p>Sanitizers are great but this idea they are so much better that Valgrind is just &#8230; weird. I find them very comparable (again, in the area where they overlap).</p>
</div>
<ol class="children">
<li id="comment-407326" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f97633fd053e05671d9433ebfe84fdda?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f97633fd053e05671d9433ebfe84fdda?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Daniel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-18T03:14:11+00:00">May 18, 2019 at 3:14 am</time></a> </div>
<div class="comment-content">
<p>Sanitizers can catch initialized reads:</p>
<blockquote><p>
MemorySanitizer (MSan) is a detector of uninitialized memory reads in C/C++ programs.
</p></blockquote>
<p><a href="https://github.com/google/sanitizers/wiki/MemorySanitizer" rel="nofollow ugc">https://github.com/google/sanitizers/wiki/MemorySanitizer</a></p>
</div>
<ol class="children">
<li id="comment-407497" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-19T00:11:17+00:00">May 19, 2019 at 12:11 am</time></a> </div>
<div class="comment-content">
<p>Agreed, but to be clear almost no one uses MSAN (I have never seen it used in the wild), because it requires all transitive dependencies to be recompiled using MSAN including the standard libraries.</p>
<p>Have you used a project using MSAN or have you used it yourself?</p>
<p>When people talk about good santizers to use, as you have done here, I always assume they are <em>not</em> talking about MSAN. If my assumption is wrong, let me know.</p>
</div>
<ol class="children">
<li id="comment-407521" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-19T01:26:27+00:00">May 19, 2019 at 1:26 am</time></a> </div>
<div class="comment-content">
<p>You mean -fsanitize=memory?</p>
<p>There are two reasons why I do not use this flag. The first one is that, to my knowledge, it is not supported by GNU GCC. The second one, and most important one, is that for what I do, this sanitizer throws off false positives (just like valgrind). Now, unlike valgrind, and given enough compiler maturity, I will be able to use this sanitizer after white-listing code using appropriate attributes. This may even be possible today, but given the lack of support in GNU GCC, I have not bothered.</p>
<p>It is possible that you are right, and that this sanitizer misses too much if you link with unsanitized libraries. But given that I am complaining about false positives, I would say that this has not been my concern.</p>
</div>
<ol class="children">
<li id="comment-407539" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-19T03:03:12+00:00">May 19, 2019 at 3:03 am</time></a> </div>
<div class="comment-content">
<p>Yes, MSAN is <code>-fsanitize=memory</code>.</p>
<p>No, I&rsquo;m not saying that MSAN &ldquo;misses too much&rdquo; if you don&rsquo;t recompile all dependencies. I&rsquo;m saying that MSAN requires you to recompile all dependencies as a basic requirement for <em>it even to work properly</em>. There is no mode where you run it on a subset of binaries. The MSAN documentation tells you straight up &ldquo;you have to recompile everything&rdquo;. It is not like ASAN in this regard.</p>
<p>Even for a basic project recompiling all the transitive dependencies of the various OS-provided libraries is not for the faint of heart and in some cases it is impossible (e.g., where source is not provided). On a larger project it becomes a bigger mess.</p>
<p>I doubt you or I will ever use MSAN unless this requirement disappears, and in any case there is a lot of functional overlap with ASAN so there is little pressure to get this to work in a more friendly way. You can basically consider it a Google-internal tool that happens to be available publicly, but is of little actual use to people who don&rsquo;t already have the entire forest of dependencies recompiled for MSAN.</p>
<p>About false positives, I am not sure what you are referring to, but if it were true that Valgrind suffers from false positives that ASAN does not (in scenarios were both can detect non-false positives), it would be a big point in favor. Details?</p>
<p>Are you referring to something like where you do something that is normally invalid (e.g., reading uninitialized memory, writing outside the bounds of allocated memory) but you somehow know it is correct (e.g., because you end up masking off the result of the uninitialized data, or because you expect to trap the OOB write with a signal handler and do something smart)?</p>
<p>In that case I don&rsquo;t think any sanitizer can avoid some types of false positives in those scenarios: you are doing something &ldquo;wrong&rdquo; by the rules of the game (language rules, or asm-level rules in Valgrind&rsquo;s case), so you have to understand each case and whitelist them. In my experience, Valgrind has <em>more sophisticated</em> analysis in an attempt to avoid false positives: it doesn&rsquo;t flag errors right away, but instead tracks &ldquo;invalid bytes&rdquo; through the code until it decides that an irreversible action uses the value of those bytes, such as jumping based on their value, has taken place. OTOH AFAICT ASAN flags errors right away. Both have their benefits: ASAN&rsquo;s approach is simpler to understand and implement (probably the Valgrind technique relies on its VM architecture), while Valgrind&rsquo;s approach reduces false positives.</p>
<p>Of course, it may be entirely true that Valgrind has more false positives because it detects the &ldquo;uninitialized memory read&rdquo; issue that ASAN ignores, and that&rsquo;s probably the largest source of false positives because uninitialized reads are more likely to be innocuous compare to out-of-bounds writes. You can hardly hold that against Valgrind though since it is additional functionality that leads to that: ASAN never false-positives on uninit reads because it never, ever detects such reads in the first place. If you really don&rsquo;t want to detect uninit reads, I guess just turn that part off?</p>
<p>Anecdotally I get zero false positives with Valgrind on every project I have used it on recently. I doubt the whitelisting capability of Valgrind are different than ASAN although I&rsquo;d be interested to hear differently.</p>
</div>
<ol class="children">
<li id="comment-407637" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-19T15:32:07+00:00">May 19, 2019 at 3:32 pm</time></a> </div>
<div class="comment-content">
<p>My reading of the documentation is that if you don&rsquo;t recompile everything, the memory sanitizers will issue false positives. Do you have another reading of the documentation?</p>
<p>Because I mostly write C-like code, whether the extension is cpp or not, I have never encountered this issue of having to recompile the C++ library to do away with the C++-specific false positives. I agree that it is a crippling limitation. It is certainly an argument in favour of valgrind that I did not have before.</p>
<p>As to the other point&#8230;</p>
<p>I get false positives all the time with valgrind, or rather, I get emails from people who complain about bugs that valgrind found in code that I wrote&#8230; that are provably not bugs&#8230;</p>
<p>I quickly made a toy example:</p>
<p><a href="https://gist.github.com/lemire/5212384d74c5f4b6eb762ac238eedc81" rel="nofollow ugc">https://gist.github.com/lemire/5212384d74c5f4b6eb762ac238eedc81</a></p>
<p>(This is not code that makes sense on its own. It is an illustration.)</p>
<p>To be clear, what I mean by false positive is not that valgrind is wrong per se. Uninitialized memory is indeed read in this example. What I mean is that there are legitimate uses of code that does not initialize everything. It is dangerous code, to be sure, but allocating a large buffer, and initializing only part of it, is a common paradigm in C (though, admittedly, STL/C++ makes it hard to do).</p>
<p>My example will pass the memory sanitizers because I have white-listed the offending function. It is possible that I can do the same with valgrind. If so, I&rsquo;d love to know how!</p>
</div>
<ol class="children">
<li id="comment-407651" class="comment even depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-19T17:37:17+00:00">May 19, 2019 at 5:37 pm</time></a> </div>
<div class="comment-content">
<p>We should be precise when talk about sanitizers. I think 90% of the time talk about &ldquo;memory sanitizers&rdquo; they actually mean ASAN (<code>-fsanitze=address</code>) and not MSAN (<code>-fsanitize=memory</code>) since ASAN is, in my experience, used an order of magnitude more than MSAN (because of its wide support and ease of use). MSAN got the better name, leading to confusion when people talk about lower-case-m memory sanitizers.</p>
<p>That&rsquo;s why I try to refer to MSAN and ASAN specifically.</p>
<p>About the documentation, I looked it up twice. Once when I first started to use the other sanitizers, long ago, and I noticed the existence of both MSAN and ASAN. I stopped when I read that MSAN requires specially instrumented runtime libraries.</p>
<p>The second time was fairly recently, when I spent a while debugging a sporadic uninitialized read issue using ASAN. Of course ASAN was never going to find it, because ASAN doesn&rsquo;t find that issue ever, and it prompted me to look again at MSAN because it does. Again I found text <a href="https://github.com/google/sanitizers/wiki/MemorySanitizer" rel="nofollow">like this</a>:</p>
<blockquote><p>
It is critical that you should build all the code in your program<br/>
(including libraries it uses, in particular, C++ standard library)<br/>
with MSan.
</p></blockquote>
<p>That, plus anecdotal reports that you can&rsquo;t use it without rebuilding means I didn&rsquo;t go further.</p>
<p>Yes, you can find text that suggests that if you <em>don&rsquo;t</em> do this, you&rsquo;ll get &ldquo;false reports&rdquo;, but I don&rsquo;t think that puts it in the same category of &ldquo;false reports&rdquo; you get from (actual) uninitialized reads in Valgrind: I think it becomes totally unusuable since any memory written by un-instrumented libraries becomes invisible to the sanitizers. When un-instrumented libraries includes the standard libraries, you are are dead in the water.</p>
<blockquote><p>
I quickly made a toy example:
</p></blockquote>
<p>Yes, this falls into the category of &ldquo;needs a human to intervene&rdquo;.</p>
<p>I would also argue that this function is not correct in general when it reads beyond the end of the initialized array: if the initialized part of the array has no zeros, the answer will depend on the uninitialized part, no? Your example has a zero in the array, so this particular call site will always return &ldquo;true&rdquo; but I think the function is bugged in the general case, so Valgrind&rsquo;s warning would be a <em>good thing</em> here. I pick on this point to point out that correctness is subtle even for people, and you&rsquo;ll never close this false positive hole permanently: even with perfect tracking of used bits or bytes you can have semantics that don&rsquo;t appear in the code like &ldquo;strings will be zero terminated&rdquo;.</p>
<p>I think 100% of existing sanitizers that can handle uninitialized reads will also trigger on this example. Certainly MSAN will.</p>
<p>In fact if you write a lot of <em>other</em> toy examples that will trigger MSAN, you&rsquo;ll find that Valgrind won&rsquo;t trigger: because Valgrind has (a) a bunch of heuristics for common &ldquo;innocent&rdquo; real-world unit-read and OOB read patterns that are known-safe and (b) is able to track validity at the byte (bit?) level from the origin of the uninit/OOB read to see if something bad is actually done with it.</p>
<p>Maybe you even wrote some other simpler examples first and found they didn&rsquo;t trigger Valgrind: that is the validity tracking at work. In this example the <code>_mm256_testz_si256</code> call &ldquo;taints&rdquo; the entire result if any bytes were tainted (after all, the result in principle depends on all bytes), and then you use the result, so that&rsquo;s why it triggers. One might argue that Valgrind could apply a more specific rule here: calculate the result of the <code>_mm256_testz_si256</code> on the valid bits alone, and then on the full registers including invalid bits, and only if the result is <em>different</em> should it trigger a warning. That would let you case pass, but still trigger if you had <code>a[1]='b'</code> instead. You can go pretty far down that rabbit hole though, and by &ldquo;pretty far&rdquo; I mean &ldquo;forever&rdquo;. One might also argue that it is better to fail always here since this is almost always a bug, so just whitelist the remaining cases.</p>
<blockquote><p>
It is possible that I can do the same with valgrind.
</p></blockquote>
<p>Valgrind definitely has whitelisting capabilities, and a search should turn up the details. Indeed, it comes with a default list of whitelist rules since otherwise maybe even &ldquo;Hello World&rdquo; wouldn&rsquo;t run clean.</p>
<p>Maybe you want to whitelist at the source level though? I&rsquo;m not sure if that is possible with Valgrind since it works on the binary, not the source. That&rsquo;s a nice advantage for sanitizers for sure, that you can include the whitelist &ldquo;annotation&rdquo; together with the source, and exactly at the place in the source where it applies.</p>
<blockquote><p>
but allocating a large buffer, and initializing only part of it, is a common paradigm in C
</p></blockquote>
<p>Agreed, but to be clear Valgrind has no issue with this in general, as it tracks which parts of the buffer have been initialized and only complains when you read and then subsequently <em>use</em> the unitialized part. That is much more rare and generally only appears in highly optimized code which is able to read slightly past the end of the buffer (yes, this is the code that you happen to deal with every day, so to you it probably seems like a lot of false positives).</p>
<p>IMO it is practical to whitelist these few places, or do what I do as a mitigation: just initialize (e.g.) at least 31 bytes past the last actually initialized bytes, so that the over-reads fall in that range.</p>
</div>
<ol class="children">
<li id="comment-408293" class="comment odd alt depth-8 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jörn Engel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-22T20:35:57+00:00">May 22, 2019 at 8:35 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
That is much more rare and generally only appears in highly optimized code which is able to read slightly past the end of the buffer [&#8230;]
</p></blockquote>
<p>Based on personal experience, I would consider such code to be broken. It tends to work most of the time, until your buffer happens to end on a page boundary and the next page is unmapped. The result is a segfault that is exceedingly hard to reproduce.</p>
<p>It is more effort to be careful, but doesn&rsquo;t affect performance in practice. Basically you create a loop like this:</p>
<p><code>for (;;) {<br/>
if (!close_to_end(p))<br/>
careless_operation(p);<br/>
else if (!reached_end(p))<br/>
careful_operation(p)<br/>
else<br/>
break;<br/>
}<br/>
</code></p>
<p>You have to check for the end anyway. If you check for end-15 or end-31, it doesn&rsquo;t make a difference in practice. The careful operation is slower, but you only use it a few times at the end of the loop.</p>
</div>
<ol class="children">
<li id="comment-408299" class="comment byuser comment-author-lemire bypostauthor even depth-9 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-22T21:04:39+00:00">May 22, 2019 at 9:04 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>Based on personal experience, I would consider such code to be broken.</p>
</blockquote>
<p>I do not disagree with this sentiment. Yet it is a cheap one-time cost to check whether you are going to cross a page.</p>
</div>
<ol class="children">
<li id="comment-408303" class="comment odd alt depth-10">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jörn Engel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-22T21:21:37+00:00">May 22, 2019 at 9:21 pm</time></a> </div>
<div class="comment-content">
<p>Is that test cheaper than the test for end-31?</p>
<p>You&rsquo;d still have to test for end, so you&rsquo;d end up with two conditionals instead of one. Also, given a multi-page buffer, you&rsquo;d hit &ldquo;false positives&rdquo; every time you cross a page within the buffer and a) needlessly use the slow version and b) pollute the branch predictor.</p>
<p>Main annoyance is that you need two copies of whatever you are doing. I have memcpy_fast and memcpy_slow, etc. So the cost is primarily to the human coder, not runtime cost.</p>
</div>
</article>
</li>
<li id="comment-408305" class="comment byuser comment-author-lemire bypostauthor even depth-10">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-22T21:36:42+00:00">May 22, 2019 at 9:36 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>Is that test cheaper than the test for end-31?</p>
</blockquote>
<p>You are thinking about a simple loop with no jumps or backtracking.</p>
<blockquote>
<p>Main annoyance is that you need two copies of whatever you are doing. I have memcpy_fast and memcpy_slow, etc. So the cost is primarily to the human coder, not runtime cost.</p>
</blockquote>
<p>Correct. I think that&rsquo;s how it is going to play out. Either you build simple and slow code, or else you build more complex but faster code. The &ldquo;safe buffer overflow&rdquo; part allows you to save complexity and still get the performance.</p>
<p>Of course, experienced programmers know that complexity is not free. Throw enough complexity into a code base and soon enough progress slows down to a crawl.</p>
<p>Important note: I do not disagree with you.</p>
</div>
</article>
</li>
</ol>
</li>
<li id="comment-411043" class="comment odd alt depth-9">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-08T17:39:53+00:00">June 8, 2019 at 5:39 pm</time></a> </div>
<div class="comment-content">
<p>Yes, I was talking about the type of code which reads past the end of the buffer, but makes sure it is <em>safe</em> first (typically by ensuring it will not cross into the next page).</p>
<p>The pattern you mention is one way. I don&rsquo;t necessarily agree it&rsquo;s free though: the <code>careful_operation</code> often involves a loop (i.e., to handle the last N bytes close to the end) which can be mispredicted, adding another mispredict to the one you usually suffered on exiting the main loop. Also, of course the careful code is usually slower too (since otherwise you&rsquo;d just do everything the careful way), but maybe that can&rsquo;t be avoided.</p>
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
<li id="comment-407629" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f97633fd053e05671d9433ebfe84fdda?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f97633fd053e05671d9433ebfe84fdda?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Daniel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-19T14:48:24+00:00">May 19, 2019 at 2:48 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve used it internally at Google and have used it on a few personal projects. The biggest thing I&rsquo;ve managed to use it with is <a href="https://mc-stan.org/" rel="nofollow">Stan</a>. It was a pain but only took me an afternoon to get running. You&rsquo;re right that it doesn&rsquo;t work at all for projects with closed source dependencies.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-407564" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/062dcd7178d4b8a46abd12ae5ba671a2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/062dcd7178d4b8a46abd12ae5ba671a2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://notstatschat.rbind.io" class="url" rel="ugc external nofollow">Thomas Lumley</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-19T05:03:10+00:00">May 19, 2019 at 5:03 am</time></a> </div>
<div class="comment-content">
<p>One way valgrind has been useful in R is in monitoring incorrect use of the language&rsquo;s own heap &#8212; you can tell it that particular parts of memory that are legal from the OS&rsquo;s point of view are illegal from the point of view of your program.</p>
</div>
</li>
<li id="comment-499899" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c177ab66c270248617a7ea4ff63fec36?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c177ab66c270248617a7ea4ff63fec36?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">CRISTIAN VASILE</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-06T09:28:14+00:00">April 6, 2020 at 9:28 am</time></a> </div>
<div class="comment-content">
<p>I find this interesting open source tool:<br/>
<a href="http://sei.pku.edu.cn/~gaoqing11/leakfix/" rel="nofollow ugc">http://sei.pku.edu.cn/~gaoqing11/leakfix/</a></p>
<p>Paper:<br/>
<a href="http://sei.pku.edu.cn/~gaoqing11/leakfix/leakfix-icse15.pdf" rel="nofollow ugc">Safe Memory-Leak Fixing for C Programs</a></p>
<p><em>LeakFix is a safe memory-leak fixing tool for C programs. It builds procedure summaries based on pointer analysis results, uses the summaries to analyze each procedure separately, and then generates fixes by inserting &ldquo;free(..)&rdquo; at certain program points.</em></p>
<p>Other resources on the matter:<br/>
<a href="https://github.com/analysis-tools-dev/static-analysis" rel="nofollow ugc">https://github.com/analysis-tools-dev/static-analysis</a></p>
</div>
</li>
<li id="comment-522557" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/01822efaf66e4b81d6f947cba7e0613a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/01822efaf66e4b81d6f947cba7e0613a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-01T11:07:44+00:00">June 1, 2020 at 11:07 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve used Valgrind extensively and lately picked up the sanitizers.</p>
<p>In my opinion Valgrind is much more mature. The sanitizers have bugs and way more false positives. The latter is a serious problem:</p>
<p>In one of my code bases I had a 100% false positive rate and spent a<br/>
week following false leads.</p>
<p>The sanitizers have found exactly one thread issue in another code<br/>
base. Valgrind rarely has false positives and has widely published suppression files for toolchain bugs.</p>
<p>So, by all means, use the sanitizers, but I don&rsquo;t think they are superior to Valgrind in any way.</p>
</div>
<ol class="children">
<li id="comment-522563" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-01T12:18:43+00:00">June 1, 2020 at 12:18 pm</time></a> </div>
<div class="comment-content">
<p>Part of the reason why sanitizers are more likely to have more false positives is that they can do much more. But though I am sure there are bugs, I have not encountered them. The false positives were logical.</p>
</div>
</li>
</ol>
</li>
</ol>
