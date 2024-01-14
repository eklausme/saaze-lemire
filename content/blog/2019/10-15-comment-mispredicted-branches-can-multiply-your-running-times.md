---
date: "2019-10-15 12:00:00"
title: "Mispredicted branches can multiply your running times"
index: false
---

[28 thoughts on &ldquo;Mispredicted branches can multiply your running times&rdquo;](/lemire/blog/2019/10-15-mispredicted-branches-can-multiply-your-running-times)

<ol class="comment-list">
<li id="comment-431697" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/50a270d01123f5c9606957df416516fc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/50a270d01123f5c9606957df416516fc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Janos</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-15T22:24:27+00:00">October 15, 2019 at 10:24 pm</time></a> </div>
<div class="comment-content">
<p>Good article!<br/>
I think the second random in the second and third code examples should be replaced by val.</p>
</div>
<ol class="children">
<li id="comment-431698" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-15T22:26:54+00:00">October 15, 2019 at 10:26 pm</time></a> </div>
<div class="comment-content">
<p>Thanks.</p>
</div>
</li>
</ol>
</li>
<li id="comment-431777" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c3e04903fa366b30853676ee1fc4a62c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c3e04903fa366b30853676ee1fc4a62c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Phil</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-16T12:25:59+00:00">October 16, 2019 at 12:25 pm</time></a> </div>
<div class="comment-content">
<p>But in the second one, the last value in the out[] array could be odd, no?</p>
</div>
<ol class="children">
<li id="comment-431789" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4d9afd102e6e3944a18eb01a0eab0779?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4d9afd102e6e3944a18eb01a0eab0779?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">LB</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-16T14:56:04+00:00">October 16, 2019 at 2:56 pm</time></a> </div>
<div class="comment-content">
<p>You mean it could be even? If so, yes, but index won&rsquo;t have been advanced so you will know to ignore it.</p>
</div>
</li>
</ol>
</li>
<li id="comment-431804" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6110fb5254b500f6784a8fef35fa4260?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6110fb5254b500f6784a8fef35fa4260?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Evan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-16T18:17:08+00:00">October 16, 2019 at 6:17 pm</time></a> </div>
<div class="comment-content">
<p>Removing branches can be pretty tricky. I&rsquo;d be interested to hear your thoughts on <code>__builtin_expect</code> / <code>__builtin_expect_with_probability</code> / <code>__builtin_unpredictable</code> if you have any.</p>
<p>I know MSVC has historically refused to implement anything similar, but with <code>[[likely]]</code> and <code>[[unlikely]]</code> <a href="http://wg21.link/p0479r5" rel="nofollow">coming in C++2a</a> (which I&rsquo;m guessing MSVC will support in VS 2021) it should be possible to have <a href="https://github.com/nemequ/hedley/blob/f57289ea9774401c1f872bacd1067564b1011226/hedley.h#L1007" rel="nofollow">something</a> portable to most modern compilers.</p>
</div>
<ol class="children">
<li id="comment-431811" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-16T19:10:18+00:00">October 16, 2019 at 7:10 pm</time></a> </div>
<div class="comment-content">
<p>If the branch is predictable and you want to tell so to the compiler, this can help because the compiler can reorder the instructions so that the likely path is close to the stream of instructions. I have never seen huge gains from this approach, but I have measured some worthwhile further gains&#8230; after optimizing almost everything else.</p>
<p>However, if the branch is unpredictable, and there is no way to remove the branching, then what can the compiler do? I do not know.</p>
</div>
<ol class="children">
<li id="comment-431818" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6110fb5254b500f6784a8fef35fa4260?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6110fb5254b500f6784a8fef35fa4260?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Evan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-16T20:15:41+00:00">October 16, 2019 at 8:15 pm</time></a> </div>
<div class="comment-content">
<p>That pretty much matches up with my experience. IIRC I&rsquo;ve only seen around ~1-2% improvements on x86/x86_64 in real code.</p>
<p>It&rsquo;s just so easy, especially compared to figuring out how to make something branchless (if possible). It&rsquo;s also pretty handy for error checking macros since the improvement tends to get replicated all over the place for free.</p>
</div>
<ol class="children">
<li id="comment-431829" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-16T23:03:09+00:00">October 16, 2019 at 11:03 pm</time></a> </div>
<div class="comment-content">
<p>The likely/unlikely hints haven&rsquo;t in principle or practice helped much with branch prediction problems like the one described here, because they indicate branches that are likely to go a specific way, hence &ldquo;predictable&rdquo;. At best, they will organize code so the &ldquo;fall through&rdquo; path is the likely taken one, as Daniel mentions, which helps for a variety of reasons. This often helps a bit &#8211; but you could certainly see some small loops that get re-arranged for a 100% benefit (e.g., doubled in speed), but due to front-end effects, not branch prediction per-se.</p>
<p>__builtin_unpredictable on the other hand could have a big effect here, since in practice it says &ldquo;try harder to make this branch free&rdquo;. Compilers can make things branch free much more than they do &#8211; they are reluctant to do this because <em>most</em> branches are predictable, and a branchfree transformation often slows things down for predictable branches. So they are conservative and only choose branchfree for the simplest cases or where some (IMO often dubious) heuristic indicates it is worthwhile (e.g., PGO although that&rsquo;s not really in the dubious category). Empirically, I have not seen gcc insert more than 2 cmov instructions in order to remove one branch.</p>
<p>Hopefully builtin_unpredictable can give a huge hint to make something branch free, even if it costs more than that.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-431815" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c5d744640b5a0d326bf75e5579487324?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c5d744640b5a0d326bf75e5579487324?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://easyperf.net" class="url" rel="ugc external nofollow">Denis Bakhvalov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-16T19:33:36+00:00">October 16, 2019 at 7:33 pm</time></a> </div>
<div class="comment-content">
<p>Yeah, likely/unlikely hints do not affect branch prediction (maybe only as a side effect).</p>
<p>You can see examples where they do help</p>
<p>here: <a href="https://easyperf.net/blog/2019/03/27/Machine-code-layout-optimizatoins#basic-block-placement" rel="nofollow ugc">https://easyperf.net/blog/2019/03/27/Machine-code-layout-optimizatoins#basic-block-placement</a></p>
<p>and here:<a href="https://easyperf.net/blog/2019/04/10/Performance-analysis-and-tuning-contest-2#improving-machine-block-placement-15" rel="nofollow ugc">https://easyperf.net/blog/2019/04/10/Performance-analysis-and-tuning-contest-2#improving-machine-block-placement-15</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-431816" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c5d744640b5a0d326bf75e5579487324?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c5d744640b5a0d326bf75e5579487324?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://easyperf.net" class="url" rel="ugc external nofollow">Denis bakhvalov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-16T19:39:31+00:00">October 16, 2019 at 7:39 pm</time></a> </div>
<div class="comment-content">
<p>Yes, compilers can&rsquo;t do such tricks, because those 2 versions have different observable behavior. The version where stores to memory are guarded under if &lsquo;statement&rsquo; can&rsquo;t touch the memory of even elements. I tend to think this also prevents vectorization of the loop. Daniel, you probably checked that but still, is there unexpected difference in generated assembly?</p>
</div>
<ol class="children">
<li id="comment-431820" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-16T20:29:21+00:00">October 16, 2019 at 8:29 pm</time></a> </div>
<div class="comment-content">
<p>Can you elaborate on &rdquo; unexpected difference in generated assembly&rdquo;?</p>
</div>
<ol class="children">
<li id="comment-432356" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c5d744640b5a0d326bf75e5579487324?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c5d744640b5a0d326bf75e5579487324?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://easyperf.net" class="url" rel="ugc external nofollow">Denis bakhvalov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-21T19:43:18+00:00">October 21, 2019 at 7:43 pm</time></a> </div>
<div class="comment-content">
<p>Like, one of the versions is vectorized, the other is not.</p>
</div>
<ol class="children">
<li id="comment-432358" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-21T20:00:14+00:00">October 21, 2019 at 8:00 pm</time></a> </div>
<div class="comment-content">
<p>I use GNU GCC with -O2, so there is no autovectorization.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-431834" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-16T23:29:27+00:00">October 16, 2019 at 11:29 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
For example, branches can sometimes be replaced by “conditional moves” or other arithmetic tricks. However, there are tricks that compilers cannot use safely.
</p></blockquote>
<p>Actually many compilers have been doing exactly this routinely and automatically for many decades! GCC generates a branchless sequence for the example on Arm by default: <a href="https://www.godbolt.org/z/ZemW4j" rel="nofollow ugc">https://www.godbolt.org/z/ZemW4j</a></p>
<p>It can give major speedups in common cases, especially on simpler, in-order cores which don&rsquo;t have advanced (read: complex and huge) branch predictors. On advanced CPUs the gain is more modest, a few percent on average.</p>
<p>This particular example uses a conditional store which is non-trivial if you don&rsquo;t have full conditional execution like Arm. Compilers can safely emit such a store using a conditional move:</p>
<p><code>*(cond ? p : &amp;dummy_var) = x;</code></p>
<p>Loads can be done in the same way &#8211; so it&rsquo;s always possible to remove branches from code if there is at least one conditional instruction (it&rsquo;s not always faster though &#8211; that&rsquo;s the hard part!).</p>
<p>As for giving branch and inlining hints to compilers, only worry about that for highly performance critical functions where it will help. It should be based on execution statistics of real code, not a &ldquo;guess&rdquo; as this is often incorrect. I&rsquo;ve used these hints in GLIBC in the fast paths in malloc/free, highly optimized string and math functions with significant gains. However it can be counterproductive if you don&rsquo;t know what you&rsquo;re doing or forget to disassemble your code to verify the compiler optimized it the way you expected.</p>
</div>
<ol class="children">
<li id="comment-431849" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-17T03:17:30+00:00">October 17, 2019 at 3:17 am</time></a> </div>
<div class="comment-content">
<p>The method of storing to a dummy memory location is a new one to me! I think it would translate into 1-3 extra decoded instructions (executed uops) per store on Intel, which would be trivially beneficial on large amount of unpredictable code, unless it would cause register spilling or the memory location would act as a dependency on a tight loop.</p>
<p>Sadly it sounds like you can&rsquo;t really make the compiler do it. I mean, you can hardcode this functionality on your code, but not make the compiler choose it or a branchy variant depending on which is deemed more profitable on basis of static analysis / profiling / hints.</p>
</div>
</li>
<li id="comment-431905" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-17T12:52:14+00:00">October 17, 2019 at 12:52 pm</time></a> </div>
<div class="comment-content">
<p>Interestingly I think the compiler could perform the dummy pointer optimization without violating any rule in the C standard, or such. Just allocate the dummy location by the runtime (either from the stack &#8211; in which case it could be an stack location already easily available on a register, or from a dedicated thread-local memory mapping), and choose either the real or dummy store address for the store. I don&rsquo;t think this would violate any rules any more than something like register spilling or ABI-specific register handling does.</p>
<p>Of course another question that arises from all this is that why x86 doesn&rsquo;t have a (non-vectored) conditional store instruction for this purpose&#8230;</p>
</div>
<ol class="children">
<li id="comment-431941" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-17T22:14:09+00:00">October 17, 2019 at 10:14 pm</time></a> </div>
<div class="comment-content">
<p>The compiler could definitely do it, but as you&rsquo;ve mentioned I&rsquo;ve never seen it. Usually the compiler prefers branches. It knows how to remove some types of branches for &ldquo;mathematical&rdquo; expressions using conditional moves, but I&rsquo;ve never seen it use dummy stores (or dummy loads, a similar technique) &#8211; although there&rsquo;s nothing preventing it in the standard. Using a stack location would be fine.</p>
<p>You can use the idiom by hand though (although maybe the optimizer will see though it and revert it).</p>
</div>
<ol class="children">
<li id="comment-431965" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-18T06:05:56+00:00">October 18, 2019 at 6:05 am</time></a> </div>
<div class="comment-content">
<p>I think one reason why such an optimization is missing is that &ldquo;unpredictable&rdquo; hints are a rather recent thing and I haven&rsquo;t really heard of branch prediction profiling driven optimizations. Also, this solution doesn&rsquo;t arise spontaneously as a combination of other optimizations.</p>
<p>I wonder how hard it would be to implement this on a modern compiler. They emit conditional stores on architectures that support them, so it shouldn&rsquo;t be awfully hard to implement the variant with fixed dummy destination, somewhat harder to reuse pointers to valid but unused locations in existing registers.</p>
</div>
<ol class="children">
<li id="comment-432005" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-18T15:09:38+00:00">October 18, 2019 at 3:09 pm</time></a> </div>
<div class="comment-content">
<p>One of the main optimizations that PFO performs is branch related, i.e., calculating the taken % of branches which affect code generation. I believe it can, for example, result in a cmov where no combination of hints would have without PGO.</p>
<p>Agree with everything else.</p>
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
<li id="comment-431876" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7b4b3e7c9ac68b7d2c93ad02d0b9c79d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7b4b3e7c9ac68b7d2c93ad02d0b9c79d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Orson Peters</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-17T08:43:58+00:00">October 17, 2019 at 8:43 am</time></a> </div>
<div class="comment-content">
<p>There&rsquo;s multiple bugs in the faster version. Firstly, it doesn&rsquo;t output <code>howmany</code> elements, it can output way fewer or even none. Secondly, the last element it outputs can be even as it never gets overridden.</p>
<p>Finally, in this toy problem the real answer is simply to set <code>out[index] = random() | 1;</code> to get uniform odd numbers.</p>
</div>
<ol class="children">
<li id="comment-431906" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-17T12:56:26+00:00">October 17, 2019 at 12:56 pm</time></a> </div>
<div class="comment-content">
<p>These are not bugs. It is never specified that I output &ldquo;howmany&rdquo; values.</p>
</div>
<ol class="children">
<li id="comment-431918" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7b4b3e7c9ac68b7d2c93ad02d0b9c79d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7b4b3e7c9ac68b7d2c93ad02d0b9c79d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Orson Peters</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-17T15:49:21+00:00">October 17, 2019 at 3:49 pm</time></a> </div>
<div class="comment-content">
<p>I&#8230; eh.. what? That is simply not true, if we cross-reference your code to the numbers you report. You report &ldquo;cycles per integer&rdquo;, and you compute this (for all algorithms) as <code>total_cycles / howmany</code>, regardless of how many integers the algorithm actually output.</p>
<p>Furthermore, we are looking at performance optimizations. If your optimized implementation isn&rsquo;t functionally the same as the non-optimized one, then what is the point of it all?</p>
<p>Worse, the bug in your optimized implementation causes it to simply <em>do less work</em>. Of course it is faster, it just decides to stop halfway through! About half of the random values will be odd. So at the end you can expect that your optimized buggy implementation has output about <code>howmany/2</code> elements. And then it stops, having output about half as much as requested.</p>
<p>This also makes your measurements bogus, the <code>3.8</code> cycles per integer for the optimized implementation you report is wrong. It is at least twice that, perhaps more.</p>
</div>
<ol class="children">
<li id="comment-431926" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-17T18:25:59+00:00">October 17, 2019 at 6:25 pm</time></a> </div>
<div class="comment-content">
<p>You misread the post. There is no bug.</p>
</div>
<ol class="children">
<li id="comment-431933" class="comment odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7b4b3e7c9ac68b7d2c93ad02d0b9c79d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7b4b3e7c9ac68b7d2c93ad02d0b9c79d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Orson Peters</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-17T19:53:06+00:00">October 17, 2019 at 7:53 pm</time></a> </div>
<div class="comment-content">
<p>Alright, final attempt to communicate the issue by making the example more extreme. Let&rsquo;s modify your code to only generate random integers from [0, 5) instead of odd numbers.</p>
<p><code>while (howmany != 0) {<br/>
val = random();<br/>
out[index] = val;<br/>
index += val &lt; 5; // MODIFIED<br/>
howmany--;<br/>
}<br/>
</code></p>
<p>Will you still report &ldquo;3.8 cycles per integer&rdquo; for this random number generation code, even though it only successfully outputs (assuming <code>val</code> is <code>uint64_t</code> like in your actual code) an integer 5/2^64 of the time? You&rsquo;ll have to run this code for hundreds of hours with an incredibly large <code>howmany</code> before it&rsquo;ll even output a single number.</p>
</div>
<ol class="children">
<li id="comment-431936" class="comment byuser comment-author-lemire bypostauthor even depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-17T20:03:17+00:00">October 17, 2019 at 8:03 pm</time></a> </div>
<div class="comment-content">
<p>Yes. It is the number of iterations, that is the number of branches, that matter for this experiment. In fact, you could modify this problem to compute the last odd integer generated or something else. Actually I pretty much assume that writing things out is free. If you read my blog post, at no point do I talk in terms of the size of the output.</p>
<p>The point of this blog post is in the title &ldquo;Mispredicted branches can multiply your running times&rdquo;. It is not about generating random numbers quickly. That&rsquo;s also an interesting problem but, as you point out, generating odd integers is certainly not interesting.</p>
<p>If you look through the content of my blog post, you will find work on random number generation, and performance. This particular blog post is not about that.</p>
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
<li id="comment-441054" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/12c218482f8a54b4428af1dbfb7b82b9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/12c218482f8a54b4428af1dbfb7b82b9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Pete DiMarco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-10T00:18:40+00:00">November 10, 2019 at 12:18 am</time></a> </div>
<div class="comment-content">
<p>This will probably sound sacrilegious, but isn&rsquo;t the real lesson here that branch prediction is a poor method of optimization? After all, branch prediction gave us the Spectre vulnerability. Wouldn&rsquo;t it be better to either:</p>
<p>Explore both branches at the same time using 2 isolated cores/pipelines/compute units, and then clearing the one that is invalid, or<br/>
Avoid the problem entirely by using a faster (photonic?) memory bus.</p>
<p>I realize that may sound a bit naive, but surely it&rsquo;s better than doing things like adding neural networks to CPUs for branch prediction&#8230;</p>
</div>
<ol class="children">
<li id="comment-441512" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-10T14:43:02+00:00">November 10, 2019 at 2:43 pm</time></a> </div>
<div class="comment-content">
<p>Exploring multiple paths at once can quickly become prohibitive&#8230; the number of code paths grows exponentially&#8230; so it is not feasible over a long window.</p>
<p>I don&rsquo;t think that the problem is memory speed per se. The problem can occur even if you are just in L1 cache.</p>
</div>
<ol class="children">
<li id="comment-441614" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/12c218482f8a54b4428af1dbfb7b82b9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/12c218482f8a54b4428af1dbfb7b82b9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Pete DiMarco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-10T23:48:25+00:00">November 10, 2019 at 11:48 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for the reply. I&rsquo;m a software engineer, so my knowledge of the subject is limited. I just read this article, which seems to be a nice introduction to branch prediction:</p>
<p><a href="https://danluu.com/branch-prediction/" rel="nofollow">https://danluu.com/branch-prediction/</a></p>
<p>Maybe the next step is to get rid of pipelines all together? What if we had pools of pipeline stages and dynamically chained them together during thread execution? I&rsquo;m imagining something analogous to how microservices are used to build distributed applications. (Of course, ideas are easy. Implementation is the hard part.)</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
