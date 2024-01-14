---
date: "2023-03-15 12:00:00"
title: "Runtime asserts are not free"
index: false
---

[16 thoughts on &ldquo;Runtime asserts are not free&rdquo;](/lemire/blog/2023/03-15-runtime-asserts-are-not-free)

<ol class="comment-list">
<li id="comment-649795" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1b8e7be51a9257fb1f08a7f01c9c29e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1b8e7be51a9257fb1f08a7f01c9c29e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Bowie Owens</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-15T23:36:38+00:00">March 15, 2023 at 11:36 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for this post. It is always helpful to hear other perspectives on things we might take for granted everyone sees the same way.</p>
<p>Note though, you have your assert on the destination array prior to the assignment.</p>
<p><code>for (size_t i = 0; i &lt; N; i++) {<br/>
assert(x1[i] &lt; RAND_MAX);<br/>
x1[i] = x2[i];<br/>
}<br/>
</code></p>
<p>Should that assert be after the assignment? Or perhaps on the source array?</p>
<p>I don&rsquo;t think this affects the conclusion you are making. It just seems unusual to be checking the value against the threshold prior to overwriting it.</p>
</div>
<ol class="children">
<li id="comment-649796" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-15T23:40:00+00:00">March 15, 2023 at 11:40 pm</time></a> </div>
<div class="comment-content">
<p>It was a typo, thank you.</p>
</div>
</li>
<li id="comment-649828" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5c92221064568ae9ad9f19cfca37123e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5c92221064568ae9ad9f19cfca37123e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nam</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-16T12:08:02+00:00">March 16, 2023 at 12:08 pm</time></a> </div>
<div class="comment-content">
<p>It&rsquo; not free in debug mode.<br/>
in release mode with &ldquo;NDEBUG&rdquo; is defined, the assertion is just nothing, so that assertion is sure free with NDEBUG</p>
</div>
<ol class="children">
<li id="comment-649829" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-16T12:48:50+00:00">March 16, 2023 at 12:48 pm</time></a> </div>
<div class="comment-content">
<p>As pointed out in the blog post, many systems release code with asserts active. If you write code for others, you cannot always know whether they will set NDEBUG when releasing their software. Compilers do not require NDEBUG to be set even when fully optimizing the binary.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-649799" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f256678460c5afe31bdab98049fcde6f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f256678460c5afe31bdab98049fcde6f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">NRK</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-16T00:12:47+00:00">March 16, 2023 at 12:12 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
One might object that you can choose to only enable assertions for the release version of your binary…
</p></blockquote>
<p>I think you meant to say &ldquo;debug version&rdquo; here, not release.</p>
<blockquote><p>
Compilers like GCC or clang (LLVM) do not deactivate asserts when compiling with optimizations.
</p></blockquote>
<p>This is indeed a bit unfortunate, but the way I deal with it is via making assertions opt-in, instead of opt-out. More concretely, you need to pass <code>-DDEBUG</code> to enable assertions, and they are disabled by default.</p>
<blockquote><p>
So having asserts in your library may disqualify it for some uses.
</p></blockquote>
<p>I believe this stems from a poor understanding of assertions. They exist to catch programming mistakes <em>as early as possible</em> instead of marching forward as if everything is OK. It&rsquo;s hard to describe how effective this is during debugging (especially in early development where the code and requirements are changing rapidly).</p>
<blockquote><p>
But spreading asserts in performance critical code might be unwise.
</p></blockquote>
<p>Respectfully disagree, because assertions are supposed to document &ldquo;impossible conditions&rdquo;, you can use that information to enable better optimization in release builds. For example you can turn the assertions into something like <code>if (!(EXPR)) __builtin_unreachable();</code> when <code>DEBUG</code> isn&rsquo;t defined.</p>
<p>Here&rsquo;s a very trivial example which shows that assertions (coupled with <code>unreachable()</code>) can improve performance by giving the compiler more information about &ldquo;impossible situation&rdquo; (while at the same time helping you catch bugs in debug builds if that &ldquo;impossible&rdquo; situation somehow is reached): <a href="https://godbolt.org/z/MPWhrhGxx" rel="nofollow ugc">https://godbolt.org/z/MPWhrhGxx</a></p>
</div>
<ol class="children">
<li id="comment-649802" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-16T02:01:36+00:00">March 16, 2023 at 2:01 am</time></a> </div>
<div class="comment-content">
<p>Thanks. Everything you write is sensible.</p>
<p>I would nitpick that assume expressions and asserts are distinct. They certainly are in the C++ standard:</p>
<p><a href="https://godbolt.org/z/nchh5jv9v" rel="nofollow ugc">https://godbolt.org/z/nchh5jv9v</a></p>
<p>In simdjson, we have SIMDJSON_ASSUME(COND) which is unrelated to asserts.</p>
</div>
<ol class="children">
<li id="comment-649807" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f256678460c5afe31bdab98049fcde6f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f256678460c5afe31bdab98049fcde6f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">NRK</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-16T04:20:04+00:00">March 16, 2023 at 4:20 am</time></a> </div>
<div class="comment-content">
<p>You&rsquo;re correct, C23 also adds a distinct <code>unreachable()</code> macro in the &lt;stddef.h&gt; header.</p>
<p>And UBSan is capable of detecting if program reaches an unreachable state, which is quite nice (<a href="https://godbolt.org/z/5b196jaTr" rel="nofollow ugc">https://godbolt.org/z/5b196jaTr</a>). So this <em>does</em> weaken my argument of catching unreachable state in debug builds.</p>
</div>
</li>
</ol>
</li>
<li id="comment-649847" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6d8712967beef90b21957faec1e204ac?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6d8712967beef90b21957faec1e204ac?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Benjamen R. Meyer</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-16T23:19:58+00:00">March 16, 2023 at 11:19 pm</time></a> </div>
<div class="comment-content">
<p>If your library causes my application to fail via assert you can guarantee that I&rsquo;ll rip it out of the dependencies.</p>
<p>Instead of asserting, generate a error that can be handled, whether that is an Exception or an Error Code doesn&rsquo;t matter (though libraries really shouldn&rsquo;t let Exceptions escape them either, but that&rsquo;s a different discussion).</p>
<p>All-in-all, the application needs to be stable regardless of input to function.</p>
<p>dontcrashmyapp</p>
</div>
<ol class="children">
<li id="comment-649852" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f256678460c5afe31bdab98049fcde6f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f256678460c5afe31bdab98049fcde6f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">NRK</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-17T02:49:22+00:00">March 17, 2023 at 2:49 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
Instead of asserting, generate a error that can be handled
</p></blockquote>
<p>It all depends on where the input is coming from. If it&rsquo;s from uncontrolled source (such as a file) then it shouldn&rsquo;t be asserted. But if the input is under control of the programmer (e.g an interface requires an argument to be a power of 2 integer, let&rsquo;s say for alignment purposes) then that&rsquo;s a prime example of where assertions come in handy.</p>
<p>If the caller has already proven himself to be buggy, what are the chances that the buggy caller is checking for error returns? Not high. And what are the chances that assertion (in debug builds) will be ignored? Pretty much 0.</p>
<p>Assertions are not much different than ASan/UBSan/Valgrind in the regard that they&rsquo;re a debugging tool meant to check for programming mistakes so that it can be caught as early as possible.</p>
<blockquote><p>
the application needs to be stable regardless of input to function.
</p></blockquote>
<p>An application that produces incorrect results is anything but stable.</p>
<blockquote><p>
dontcrashmyapp
</p></blockquote>
<p>It won&rsquo;t if the application is not buggy (or if you link against the release build with assertions compiled out).</p>
</div>
<ol class="children">
<li id="comment-649872" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6817b2b797174ea91cbbfd2972a33fd5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6817b2b797174ea91cbbfd2972a33fd5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">M.W.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-18T21:38:50+00:00">March 18, 2023 at 9:38 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
But if the input is under control of the programmer (e.g an interface requires an argument to be a power of 2 integer, let’s say for alignment purposes) then that’s a prime example of where assertions come in handy.
</p></blockquote>
<p>My recent example of this was a code ignoring the output of sscanf, and dereferencing a NULL pointer. That led to a dabort, which &#8211; as the stack pointer for this exception was not set &#8211; led to another dabort, this time with the source address gone (ARM). Searching for this took a while, and the mind-bending debugging of sscanf will stay with me forever. All because &ldquo;oh, this can never happen, so we don&rsquo;t need to check&rdquo; attitude.</p>
</div>
</li>
<li id="comment-651472" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tobin Baker</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-03T21:31:17+00:00">May 3, 2023 at 9:31 pm</time></a> </div>
<div class="comment-content">
<p>I disagree: assertions should be used to enforce internal assumptions on state, not external API requirements. It should not be possible for a library client to trigger an assert due to a programming error in their code (though they might trigger an assert due to a programming error in the library itself). A library simply can&rsquo;t make assumptions about the environment in which it&rsquo;s used. In some environments it might be fine to crash with an informative message; in others the program must keep running (perhaps after reverting to a known-good state). Throwing exceptions or returning error codes leaves the decision to the client, where it belongs. (Note that the Erlang &ldquo;let it crash&rdquo; approach is actually about handling software errors, not expected faults, and is designed for &ldquo;always-on&rdquo; systems where a full crash is unacceptable.)</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-649817" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1fee087d7a1ca17c8ad348271819a8d5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1fee087d7a1ca17c8ad348271819a8d5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Antoine</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-16T08:19:54+00:00">March 16, 2023 at 8:19 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
Compilers like GCC or clang (LLVM) do not deactivate asserts when compiling with optimizations.
</p></blockquote>
<p>Hmm&#8230; ok, if you build the command line from scratch. Common pratice is to include <code>-DNDEBUG</code> in release flags, and that&rsquo;s what you get by default from CMake, for example.</p>
<blockquote><p>
One might object that you can choose to only enable assertions for the debug version of your binary… but this choice is subject to debate.
</p></blockquote>
<p>Why not have that debate? 🙂</p>
<p>My personal position is that if a check is important to keep a release mode, then your API should have proper error-return semantics, and the check should be turned to return an error instead of crashing out.</p>
<p>In other words: use asserts to check internal invariants in debug mode, when running your test suite (and perhaps a fuzzer of sorts); use error returns for conditions that can happen even if the code is right (for example bad user input, IO error, memory allocation failure&#8230;).</p>
<p>One strong argument in favor of that policy is that the code may be called from a higher level language. Crashing out for errors in Python, for example, makes users&rsquo; lives miserable.</p>
</div>
<ol class="children">
<li id="comment-649824" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/07d4081ad8a24878349505da7778651c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/07d4081ad8a24878349505da7778651c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Konstantin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-16T10:54:24+00:00">March 16, 2023 at 10:54 am</time></a> </div>
<div class="comment-content">
<p>The best and easiest mitigation to various design and performance problems with asserts is to write your own assert system. This gives you severity control (fine-tuning per-assert behavior), streaming, feedback, and many more things.</p>
<p>I always found the C assert a bit heavy-handed and lacking.</p>
</div>
</li>
</ol>
</li>
<li id="comment-649850" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f9729f4dd728850a023727afc36b0ebf?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f9729f4dd728850a023727afc36b0ebf?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Donovan T Baarda</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-17T01:57:17+00:00">March 17, 2023 at 1:57 am</time></a> </div>
<div class="comment-content">
<p>IMHO if your asserts are load-bearing, you are doing it wrong. If the program runs correctly with asserts turned on, it should run correctly with them turned off.</p>
<p>Using asserts liberally to check pre/post/invariant conditions is a simple way to do contract-programming, but they must be safe to turn off for non-debug builds.</p>
</div>
</li>
<li id="comment-649855" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/34da0bb9f7bba069b572df5ca6ba1007?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/34da0bb9f7bba069b572df5ca6ba1007?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Globules</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-17T02:59:42+00:00">March 17, 2023 at 2:59 am</time></a> </div>
<div class="comment-content">
<p>You might be able to have two versions of a function, such as <code>arrayCopyFast</code> and <code>arrayCopySafe</code>. Users could call the fast version when they know their input is valid.</p>
</div>
<ol class="children">
<li id="comment-649879" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-19T19:03:37+00:00">March 19, 2023 at 7:03 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;d call the first one arrayCopyUnsafe.</p>
<p>Yes. I agree with that approach and it is very sensible.</p>
</div>
</li>
</ol>
</li>
</ol>
