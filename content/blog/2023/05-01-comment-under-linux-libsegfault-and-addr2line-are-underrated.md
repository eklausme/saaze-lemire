---
date: "2023-05-01 12:00:00"
title: "Under Linux, libSegFault and addr2line are underrated"
index: false
---

[10 thoughts on &ldquo;Under Linux, libSegFault and addr2line are underrated&rdquo;](/lemire/blog/2023/05-01-under-linux-libsegfault-and-addr2line-are-underrated)

<ol class="comment-list">
<li id="comment-651435" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d5590e292657121e3c8151e7ab076968?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d5590e292657121e3c8151e7ab076968?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Roberto Natella</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-02T08:20:49+00:00">May 2, 2023 at 8:20 am</time></a> </div>
<div class="comment-content">
<p>It seems that libSegFault was removed from the GNU C library (<a href="https://savannah.gnu.org/forum/forum.php?forum_id=10111" rel="nofollow ugc">https://savannah.gnu.org/forum/forum.php?forum_id=10111</a>). On Ubuntu, you can still get it by installing &ldquo;glibc-tools&rdquo;.</p>
</div>
</li>
<li id="comment-651446" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/62973c158ab04e7701275704efc4b3b6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/62973c158ab04e7701275704efc4b3b6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Valerio Messina</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-02T18:56:42+00:00">May 2, 2023 at 6:56 pm</time></a> </div>
<div class="comment-content">
<p>in your article it is not clear which compiler you use under Linux, but GCC since v4.8 from 2013/03, see</p>
<blockquote><p>
<a href="https://gcc.gnu.org/gcc-4.8/changes.html" rel="nofollow ugc">https://gcc.gnu.org/gcc-4.8/changes.html</a>
</p></blockquote>
<p>(and CLang/LLVM since its first version) has implemented support for &ldquo;address sanitizer&rdquo;, which in addition to finding seg faults, finds double frees, uses after free, vector overruns, and much more at runtime.<br/>
Just build in with:</p>
<p><code>CFLAGS=-O1 -g -fsanitize=address<br/>
LDFLAGS=-fsanitize=address<br/>
</code></p>
<p>and at the price of a binary enlargement and a slight execution slowdown, when the error occurs, it shows you a clear backtrace and the C source line where the error is generated, and where the memory was allocated. I always use it when build a debug binary</p>
</div>
<ol class="children">
<li id="comment-651447" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-02T19:32:39+00:00">May 2, 2023 at 7:32 pm</time></a> </div>
<div class="comment-content">
<p>You might find the following blog posts interesting:</p>
<p><a href="https://lemire.me/blog/2022/08/20/catching-sanitizer-errors-programmatically/" rel="ugc">https://lemire.me/blog/2022/08/20/catching-sanitizer-errors-programmatically/</a></p>
<p><a href="https://lemire.me/blog/2016/04/20/no-more-leaks-with-sanitize-flags-in-gcc-and-clang/" rel="ugc">https://lemire.me/blog/2016/04/20/no-more-leaks-with-sanitize-flags-in-gcc-and-clang/</a></p>
<p>I love sanitizers and I think that they ought to be enabled by default when debugging.</p>
</div>
</li>
</ol>
</li>
<li id="comment-651448" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/62973c158ab04e7701275704efc4b3b6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/62973c158ab04e7701275704efc4b3b6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Valerio Messina</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-02T20:08:19+00:00">May 2, 2023 at 8:08 pm</time></a> </div>
<div class="comment-content">
<p>yes, C built with ASAN is slow like Java or .Net languages.<br/>
Once cleaned from bugs, rebuild without ASAN and you get all the power of C</p>
</div>
</li>
<li id="comment-651449" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0a79fe3cdd2e398c54f96e64f0de73ee?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0a79fe3cdd2e398c54f96e64f0de73ee?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Atanas Palavrov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-02T21:07:11+00:00">May 2, 2023 at 9:07 pm</time></a> </div>
<div class="comment-content">
<p>For deeply embedded systems sometimes it is really valuable to get the stack back trace on error or for all running thread when there is a thread deadlock. The problem is that -fomit-frame-pointer makes function stack frames chaining unstable so you need to disable this optimization. But sometimes even that is not enough as for example for ARM Thumb2 GCC even with -fno-omit-frame-pointer still doesn&rsquo;t generate predictable frames chaining to avoid generation of one additional instruction in the function prologue/epilogue. The only solution is to patch GCC or to switch to CLANG if your platform allows it.</p>
<p>Not sure how this will work with address sanitizing.</p>
</div>
</li>
<li id="comment-651450" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fd559a85dcf968d4996c990439b033fc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fd559a85dcf968d4996c990439b033fc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maks Verver</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-02T21:57:37+00:00">May 2, 2023 at 9:57 pm</time></a> </div>
<div class="comment-content">
<p>Note that you can also compile with <code>-Og</code> which is like <code>-O1</code> except it prevents certain optimizations that make debugging harder.</p>
<p>Similarly, GCC supports different levels of debug information, from <code>-g0</code> (no debug information) to <code>-g3</code>, with <code>-g</code> equivalent to <code>-g2</code>. For maximum debugability the optimal flags are probably something like <code>-Og -g3</code> , though beware this may slow down compilation and/or make your binaries larger.</p>
</div>
</li>
<li id="comment-651455" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9df3da994139c4dc56900b170d8824a6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9df3da994139c4dc56900b170d8824a6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marko</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-03T05:26:16+00:00">May 3, 2023 at 5:26 am</time></a> </div>
<div class="comment-content">
<p>One can also achieve this by linking against glog (Google logging library) and installing failure signal handler.</p>
<p>When writing c or c++ programs I always link against glog, gflags, googletest and Google benchmark by default. These are statically linked and the whole program compiled with &ldquo;-g -O2&rdquo;. This is a pretty safe place to start from.</p>
</div>
</li>
<li id="comment-651469" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a022689a291c2da272d1098e2987b21e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a022689a291c2da272d1098e2987b21e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">azelcer</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-03T20:24:51+00:00">May 3, 2023 at 8:24 pm</time></a> </div>
<div class="comment-content">
<p>Minor comment: The code in the post and in github do not coincide. Github&rsquo;s code will indeed trigger a segfault on line 6, but the code in the post does not have an empty line before the definition of the <code>go</code> function and will trigger it in line 5.</p>
</div>
</li>
<li id="comment-651546" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/62973c158ab04e7701275704efc4b3b6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/62973c158ab04e7701275704efc4b3b6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Valerio Messina</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-07T15:48:11+00:00">May 7, 2023 at 3:48 pm</time></a> </div>
<div class="comment-content">
<p>the developer of ASAN suggest use &ldquo;-O1 -g&rdquo; with -fsanitize=address<br/>
and optionally add -fno-omit-frame-pointer to get better stacktrace</p>
</div>
</li>
<li id="comment-652196" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24f90bbbdbfb28787d99b3ab18868eb3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24f90bbbdbfb28787d99b3ab18868eb3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://keypuncher.net" class="url" rel="ugc external nofollow">Michael Day</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-06T22:19:39+00:00">June 6, 2023 at 10:19 pm</time></a> </div>
<div class="comment-content">
<p>Turning on optimizations resulted in addr2line giving me the incorrect line for me.</p>
</div>
</li>
</ol>
