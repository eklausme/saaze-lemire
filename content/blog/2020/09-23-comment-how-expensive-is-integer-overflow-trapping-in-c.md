---
date: "2020-09-23 12:00:00"
title: "How expensive is integer-overflow trapping in C++?"
index: false
---

[11 thoughts on &ldquo;How expensive is integer-overflow trapping in C++?&rdquo;](/lemire/blog/2020/09-23-how-expensive-is-integer-overflow-trapping-in-c)

<ol class="comment-list">
<li id="comment-553333" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6d633a9adb678ae58ba053b521b41844?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6d633a9adb678ae58ba053b521b41844?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://llogiq.github.io" class="url" rel="ugc external nofollow">Andre Bogus</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-24T07:25:20+00:00">September 24, 2020 at 7:25 am</time></a> </div>
<div class="comment-content">
<p>&ldquo;Overall this one test does establish that checking for overflows can be expensive. &rdquo;</p>
<p>That&rsquo;s a load-bearing &ldquo;can&rdquo; right here. So the gcc people chose not to optimize overflow checking to emit something sensible, therefore overflow checking is too slow, therefore we are stuck with the sad state of affairs.</p>
<p>In practice, we are likely to see tasks far more complex than adding an array of integers, so the actual overhead is likely to be in the single digit percents.</p>
<p>Rust chose to omit checks in release mode because a) it&rsquo;s not <em>memory unsafe</em> to have overflows (though the results can also be dire depending on context), and they in my opinion correctly assumed that they need to reach perf parity with C and C++, or else they wouldn&rsquo;t be seen as an alternative.</p>
<p>At least Rust does bounds-checking by default (which can often be optimized out by using iterators instead of indexing, or by asserting the length by taking a slice).</p>
</div>
<ol class="children">
<li id="comment-553362" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-24T13:57:11+00:00">September 24, 2020 at 1:57 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>therefore overflow checking is too slow, therefore we are stuck with<br/>
the sad state of affairs.</p>
</blockquote>
<p>The other side of the coin is that the first step in fixing a performance problem is to document it. GCC could multiply its performance.</p>
</div>
</li>
</ol>
</li>
<li id="comment-553339" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/542066970ce220b23881f4eac4525e6b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/542066970ce220b23881f4eac4525e6b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thomas Neumann</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-24T08:22:30+00:00">September 24, 2020 at 8:22 am</time></a> </div>
<div class="comment-content">
<p>It is interesting to note that without -ftrapv clang uses SIMD instructions, while with -ftrapv clang uses a scalar addition plus jo instruction. Which probably causes most of the performance difference, the overflow check itself is not that expensive, but it prevents SIMD usage.</p>
<p>Your demo program computes the sum over an array, which allows for auto-vectorization. In programs where the compiler cannot vectorize computations the overhead is probably smaller. When I add -fno-vectorize to your demo program the runtime difference with and without -ftrapv is 43% on an AMD 1950X.</p>
</div>
</li>
<li id="comment-553341" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a8f06f5424c8234cf108e1d8c581e2b0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a8f06f5424c8234cf108e1d8c581e2b0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">John Smith</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-24T08:30:16+00:00">September 24, 2020 at 8:30 am</time></a> </div>
<div class="comment-content">
<p>You write the check yourself with __builtin_add_overflow.</p>
</div>
</li>
<li id="comment-553355" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1a47b42a409b2c89b6092b0a93ee2203?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1a47b42a409b2c89b6092b0a93ee2203?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Peter Dimov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-24T11:56:31+00:00">September 24, 2020 at 11:56 am</time></a> </div>
<div class="comment-content">
<p>-fsanitize=undefined is a better way to trap integer overflow nowadays.</p>
</div>
</li>
<li id="comment-553357" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d2523e9c49893b16d27aafcc40987ab9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d2523e9c49893b16d27aafcc40987ab9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dmitrii Loginov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-24T12:12:58+00:00">September 24, 2020 at 12:12 pm</time></a> </div>
<div class="comment-content">
<p>Did you check __builtin_add_overflow or similar functions?</p>
</div>
</li>
<li id="comment-553358" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d2523e9c49893b16d27aafcc40987ab9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d2523e9c49893b16d27aafcc40987ab9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dmitrii Loginov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-24T12:28:47+00:00">September 24, 2020 at 12:28 pm</time></a> </div>
<div class="comment-content">
<p><a href="https://gcc.godbolt.org/z/bsTxPv" rel="nofollow ugc">https://gcc.godbolt.org/z/bsTxPv</a></p>
<p>GCC implements -frtapv like replacement &lsquo;+&rsquo; to &lsquo;addvsi3&rsquo; function <a href="https://github.com/gcc-mirror/gcc/blob/41d6b10e96a1de98e90a7c0378437c3255814b16/libgcc/libgcc2.c#L87" rel="nofollow ugc">https://github.com/gcc-mirror/gcc/blob/41d6b10e96a1de98e90a7c0378437c3255814b16/libgcc/libgcc2.c#L87</a></p>
<p>Clang implements it by using &lsquo;setno&rsquo;. Same as __builtin_add_overflow. <a href="https://gcc.godbolt.org/z/eqxYxc" rel="nofollow ugc">https://gcc.godbolt.org/z/eqxYxc</a></p>
<p>That means clang crash program by &lsquo;UD2&rsquo; instruction, but GCC call &lsquo;abort&rsquo;. Which behaviour is more desirable to you?</p>
</div>
<ol class="children">
<li id="comment-553380" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b3070ad3bb35d6e518f2dd2ba96c55c9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b3070ad3bb35d6e518f2dd2ba96c55c9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://skanthak.homepage.t-online.de/llvm.html" class="url" rel="ugc external nofollow">Stefan Kanthak</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-24T19:15:40+00:00">September 24, 2020 at 7:15 pm</time></a> </div>
<div class="comment-content">
<p>Better dare to take a look at the code of the addv?i3() functions shipped in libgcc.a: it&rsquo;s outright HORRIBLE!</p>
<p><code> lea rax, [rdi, rsi]<br/>
test rsi, rsi<br/>
js .negative<br/>
cmp rdi, rax<br/>
jg .somewhere<br/>
...<br/>
.negative:<br/>
cmp rdi, rax<br/>
jl .elsewhere<br/>
....<br/>
</code></p>
<p>JFTR: what LLVM ships in their compiler-rt is equally bad. It&rsquo;s a real shame, for both of them!</p>
</div>
</li>
</ol>
</li>
<li id="comment-553363" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f8b25df4d1b6e783c407e25da7642490?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f8b25df4d1b6e783c407e25da7642490?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Robert Ruedisueli</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-24T14:06:16+00:00">September 24, 2020 at 2:06 pm</time></a> </div>
<div class="comment-content">
<p>It would be nice to be able to turn this on in specific variables, operations or blocks of code that are security sensitive, as well as adjust behavior based on what the variable does, including falling back on an alternate algorithm that won&rsquo;t overflow in such cases.</p>
</div>
</li>
<li id="comment-555267" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ad4ee71956de6520a70d92a93b0ad145?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ad4ee71956de6520a70d92a93b0ad145?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Antoine</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-16T15:11:11+00:00">October 16, 2020 at 3:11 pm</time></a> </div>
<div class="comment-content">
<p>The portable-snippets library has portable wrappers for many useful operations, including overflow-checking arithmetic. They use the relevant compiler intrinsics where possible.<br/>
<a href="https://github.com/nemequ/portable-snippets/tree/master/safe-math" rel="nofollow ugc">https://github.com/nemequ/portable-snippets/tree/master/safe-math</a></p>
</div>
</li>
<li id="comment-555484" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b3070ad3bb35d6e518f2dd2ba96c55c9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b3070ad3bb35d6e518f2dd2ba96c55c9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://skanthak.homepage.t-online.de/llvm.html" class="url" rel="ugc external nofollow">Stefan Kanthak</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-19T08:32:03+00:00">October 19, 2020 at 8:32 am</time></a> </div>
<div class="comment-content">
<p>For the real horror show perform multiplication instead of addition: on an AMD EPYC 7262, GCC shows a 14x slowdown, beaten by Clang with a <strong>whopping 537x slowdown</strong>!<br/>
This is just one of the many</p>
<blockquote><p>
highly tuned implementations of the low-level code generator support routines
</p></blockquote>
<p>which LLVM braggs about on their web pages.<br/>
You gotta love such blatant lies!</p>
</div>
</li>
</ol>
