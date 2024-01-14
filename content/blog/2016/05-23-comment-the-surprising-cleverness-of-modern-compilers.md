---
date: "2016-05-23 12:00:00"
title: "The surprising cleverness of modern compilers"
index: false
---

[18 thoughts on &ldquo;The surprising cleverness of modern compilers&rdquo;](/lemire/blog/2016/05-23-the-surprising-cleverness-of-modern-compilers)

<ol class="comment-list">
<li id="comment-242023" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-05-23T22:41:01+00:00">May 23, 2016 at 10:41 pm</time></a> </div>
<div class="comment-content">
<p>Can confirm the same on OS X&rsquo;s clang-600.0.54.</p>
</div>
</li>
<li id="comment-242062" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-05-24T01:47:02+00:00">May 24, 2016 at 1:47 am</time></a> </div>
<div class="comment-content">
<p>Aha: <a href="https://llvm.org/bugs/show_bug.cgi?id=1488" rel="nofollow ugc">https://llvm.org/bugs/show_bug.cgi?id=1488</a></p>
<p>It&rsquo;s been in there for a while apparently.</p>
</div>
</li>
<li id="comment-242072" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6cb78ebe15c6f99383e945c4a0c1053c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6cb78ebe15c6f99383e945c4a0c1053c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stefan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-05-24T03:06:09+00:00">May 24, 2016 at 3:06 am</time></a> </div>
<div class="comment-content">
<p>Note, however, that this optimization in LLVM is highly-specialized, and it pattern-matches against the exact implementation you gave and turns it into a popcnt. There is no magic going on, and any number of semantics-preserving rewrites of the C code will cause LLVM to miss the optimization, because the pattern isn&rsquo;t recognized any longer.</p>
</div>
</li>
<li id="comment-242094" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f537f091ecab9dc0920725cf227569fa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f537f091ecab9dc0920725cf227569fa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Oleg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-05-24T07:25:56+00:00">May 24, 2016 at 7:25 am</time></a> </div>
<div class="comment-content">
<p>The one that caught me off guard while trying to get some O(n) loops to benchmark, automatic conversion of sum(i^n) to polynom(n): <a href="https://godbolt.org/g/p6RxBh" rel="nofollow ugc">https://godbolt.org/g/p6RxBh</a></p>
</div>
</li>
<li id="comment-242101" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/830377de0a36351ceb468229568027d1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/830377de0a36351ceb468229568027d1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anonymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-05-24T09:23:50+00:00">May 24, 2016 at 9:23 am</time></a> </div>
<div class="comment-content">
<p>I probably wouldn&rsquo;t understand an in-depth explanation, but I would still like to know &#8211; at least on superficial level &#8211; how clang does this. It seems to me that an extremely sophisticated algorithm would be needed to achieve this.</p>
<p>What if you change the code slightly? Like change x != 0 to x != 1 or something.</p>
</div>
<ol class="children">
<li id="comment-242118" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f3634cbe07c52f93ba49ec9d52ffa6c7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f3634cbe07c52f93ba49ec9d52ffa6c7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Corralx</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-05-24T13:06:57+00:00">May 24, 2016 at 1:06 pm</time></a> </div>
<div class="comment-content">
<p>It does that by transforming the AST in a normal form and then performing some pattern matching on that, trying to find common subsection of codes it can optimize. It can work wonderfully but all these patterns are handcrafted and to be really useful they often require the programmer to know how to write the code the make it easy for the compiler to recognize them.</p>
</div>
</li>
<li id="comment-242120" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/81c6c8040fc0263607edd05c09dacf6b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/81c6c8040fc0263607edd05c09dacf6b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Julian Squires</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-05-24T13:27:58+00:00">May 24, 2016 at 1:27 pm</time></a> </div>
<div class="comment-content">
<p>You might find this section of the LLVM code interesting:<br/>
<a href="https://github.com/llvm-mirror/llvm/blob/f36485f7ac2a8d72ad0e0f2134c17fd365272285/lib/Transforms/Scalar/LoopIdiomRecognize.cpp#L960" rel="nofollow ugc">https://github.com/llvm-mirror/llvm/blob/f36485f7ac2a8d72ad0e0f2134c17fd365272285/lib/Transforms/Scalar/LoopIdiomRecognize.cpp#L960</a></p>
<p>All the idiom recognition stuff is pretty interesting.</p>
</div>
</li>
<li id="comment-242122" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/af7db0ed5e2a7787c35848a7d25a8932?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/af7db0ed5e2a7787c35848a7d25a8932?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://stackoverflow.com/users/224132/peter-cordes" class="url" rel="ugc external nofollow">Peter Cordes</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-05-24T14:53:12+00:00">May 24, 2016 at 2:53 pm</time></a> </div>
<div class="comment-content">
<p>compilers look for certain patterns in the logic of what the code does.</p>
<p>A simpler example of this is rotate instructions, where the common idiom is x&gt;&gt;3 | x&lt;&lt;(32-3)</p>
<p>Compilers have recognized that for a long time as a 32bit rotate instruction.</p>
<p>(There are caveats, though, esp for variable shift-counts: <a href="http://stackoverflow.com/questions/776508/best-practices-for-circular-shift-rotate-operations-in-c" rel="nofollow ugc">http://stackoverflow.com/questions/776508/best-practices-for-circular-shift-rotate-operations-in-c</a>)</p>
</div>
</li>
</ol>
</li>
<li id="comment-242109" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d098a8ef2d2494d034ecb48308d1028f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d098a8ef2d2494d034ecb48308d1028f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Paul D.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-05-24T11:32:06+00:00">May 24, 2016 at 11:32 am</time></a> </div>
<div class="comment-content">
<p>You might be interested in seeing what&rsquo;s happening with synthesizing superoptimizers, exploiting the big advances that have been made in SAT solvers.</p>
<p><a href="http://blog.regehr.org/archives/1219" rel="nofollow ugc">http://blog.regehr.org/archives/1219</a></p>
</div>
</li>
<li id="comment-242115" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ef9c8d27eda1b595eb23d9c5011739be?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ef9c8d27eda1b595eb23d9c5011739be?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">JP</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-05-24T12:28:57+00:00">May 24, 2016 at 12:28 pm</time></a> </div>
<div class="comment-content">
<p>does it do the same for any other standard pop count algorithms?</p>
</div>
<ol class="children">
<li id="comment-425883" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/532456a3fd0e8698743fdfcfe79ebe02?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/532456a3fd0e8698743fdfcfe79ebe02?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">bsa</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-01T09:51:43+00:00">September 1, 2019 at 9:51 am</time></a> </div>
<div class="comment-content">
<p>Current versions of clang and gcc will also optimize this (the K&amp;R implementation for counting bits) to popcount. I <a href="https://godbolt.org/z/a7pIdG" rel="nofollow">tested with the Godbolt compiler explorer</a>):</p>
<p><code>static inline size_t _count_bits(uint64_t n) {<br/>
size_t count;<br/>
for (count = 0; n; count++) n &amp;= n - 1;<br/>
return count;<br/>
}<br/>
</code></p>
<p>Another example is this code, which performs a bitwise left shift with wrap (unlike the &lt;&lt; operator), and is optimized to either a rotl or rotr instruction depending on the shift size.</p>
<p><code>static inline uint64_t rotl(const uint64_t x, int k) {<br/>
return (x &lt;&lt; k) | (x &gt;&gt; (64 - k));<br/>
}<br/>
</code></p>
<p>I really wish there were a solid cross-platform library for bitwise operations like these which resolve to native instructions where possible, and fall back to decent software implementations on architectures where those instructions aren&rsquo;t present. Maybe there is and I don&rsquo;t know what it&rsquo;s called, or there is a bigger picture I&rsquo;m missing.</p>
</div>
</li>
</ol>
</li>
<li id="comment-242119" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/78b315ac36bae6a97dabdab07f3ae628?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/78b315ac36bae6a97dabdab07f3ae628?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/fsaintjacques" class="url" rel="ugc external nofollow">Francois Saint-Jacques</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-05-24T13:26:55+00:00">May 24, 2016 at 1:26 pm</time></a> </div>
<div class="comment-content">
<p>@Anonymous, the code is here:</p>
<p><a href="https://github.com/llvm-mirror/llvm/blob/ae889d36724efb174e8cc05d26e655c4c4ab8867/lib/Transforms/Scalar/LoopIdiomRecognize.cpp#L1077-L1123" rel="nofollow ugc">https://github.com/llvm-mirror/llvm/blob/ae889d36724efb174e8cc05d26e655c4c4ab8867/lib/Transforms/Scalar/LoopIdiomRecognize.cpp#L1077-L1123</a></p>
</div>
</li>
<li id="comment-242121" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c8971b9927d5a599875279bd85004f73?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c8971b9927d5a599875279bd85004f73?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://shape-of-code.coding-guidelines.com" class="url" rel="ugc external nofollow">Derek Jones</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-05-24T13:48:29+00:00">May 24, 2016 at 1:48 pm</time></a> </div>
<div class="comment-content">
<p>x &amp;= x &#8211; 1 is the first example in Waren&rsquo;s book &ldquo;Hacker&rsquo;s delight&rdquo;. </p>
<p>I think one measure of optimization quality is producing the same code for all programs that do the same thing:<br/>
<a href="http://shape-of-code.coding-guidelines.com/2011/07/24/compiler-benchmarking-for-the-21st-century/" rel="nofollow ugc">http://shape-of-code.coding-guidelines.com/2011/07/24/compiler-benchmarking-for-the-21st-century/</a></p>
</div>
</li>
<li id="comment-242142" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/039431394c9f65e3d473ceb8d82173b3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/039431394c9f65e3d473ceb8d82173b3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sigi</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-05-24T19:03:42+00:00">May 24, 2016 at 7:03 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s not magic when you have a basic understanding on hamming weight.</p>
<p>C is a general-purpose language. You can use it as you like.</p>
<p>Disable all compiler optimization and than look at the asm code.</p>
</div>
</li>
<li id="comment-242181" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f8a7ccb41af2422d10599464b96cf034?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f8a7ccb41af2422d10599464b96cf034?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://FranklinChen.com/" class="url" rel="ugc external nofollow">Franklin Chen</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-05-24T21:23:36+00:00">May 24, 2016 at 9:23 pm</time></a> </div>
<div class="comment-content">
<p>Some cool compiler optimization stuff going on with Spark recently:</p>
<p><a href="https://blog.acolyer.org/2016/05/23/efficiently-compiling-efficient-query-plans-for-modern-hardware/" rel="nofollow ugc">https://blog.acolyer.org/2016/05/23/efficiently-compiling-efficient-query-plans-for-modern-hardware/</a></p>
</div>
</li>
<li id="comment-242393" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e039c3c2e54e4eb62c21f74e339a11ef?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e039c3c2e54e4eb62c21f74e339a11ef?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Chagor Lango</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-05-26T08:55:43+00:00">May 26, 2016 at 8:55 am</time></a> </div>
<div class="comment-content">
<p>And how many CPU cycles does it take for popcnt to complete? Compiler might save on program size, but you&rsquo;re ultimately dependent on microcode for non-trivial instructions. That&rsquo;s not magic either.</p>
</div>
<ol class="children">
<li id="comment-242407" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-05-26T13:13:06+00:00">May 26, 2016 at 1:13 pm</time></a> </div>
<div class="comment-content">
<p><tt>popcnt</tt> has a throughput of 1 instruction every cycle on recent x64 processors.</p>
</div>
</li>
</ol>
</li>
<li id="comment-284987" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6a8fcdad0f89dba3017fd5992b47db65?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6a8fcdad0f89dba3017fd5992b47db65?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://blog.teknik.io/phoe" class="url" rel="ugc external nofollow">MichaÅ‚ "phoe" Herda</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-26T10:13:21+00:00">August 26, 2017 at 10:13 am</time></a> </div>
<div class="comment-content">
<p>&gt; What does that mean? It means that C is a high-level language.</p>
<p>No. This means that C has high-level compilers, if anything.</p>
<p>They happen to recognize the pattern (or patterns) in the code outlined as special cases for optimization, and finally manage to optimize it into a single assembly instruction.</p>
<p>C is still as low level as it was.</p>
</div>
</li>
</ol>
