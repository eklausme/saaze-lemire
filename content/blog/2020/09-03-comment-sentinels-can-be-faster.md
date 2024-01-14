---
date: "2020-09-03 12:00:00"
title: "Sentinels can be faster"
index: false
---

[22 thoughts on &ldquo;Sentinels can be faster&rdquo;](/lemire/blog/2020/09-03-sentinels-can-be-faster)

<ol class="comment-list">
<li id="comment-551520" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c730b0f42ec75a0b91234b285ee730c7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c730b0f42ec75a0b91234b285ee730c7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Mark</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-03T03:52:50+00:00">September 3, 2020 at 3:52 am</time></a> </div>
<div class="comment-content">
<p>Some of this sounds like facebook&rsquo;s std::string:</p>
<p><a href="https://www.youtube.com/watch?v=kPR8h4-qZdk" rel="nofollow ugc">https://www.youtube.com/watch?v=kPR8h4-qZdk</a></p>
<p>The sentinel in C bests their null termination?</p>
</div>
</li>
<li id="comment-551595" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-03T09:04:15+00:00">September 3, 2020 at 9:04 am</time></a> </div>
<div class="comment-content">
<p>NULL terminated strings are potentially also a security vulnerability if not handled properly. Other than making it easier to accidentally do buffer overflows, they&rsquo;re subject to NULL byte injection attacks. They also can&rsquo;t properly support binary data in general (since you&rsquo;re going to have data with NULLs in them), so you need to have support for a length-specified variant anyway.</p>
<p>Speed wise, they can be problematic, particularly if you&rsquo;re looking to parallelise code (e.g. SIMD). It can also effectively turn character iteration into a pointer-chasing problem &#8211; the CPU only knows it can check the next character if the current character isn&rsquo;t NULL (and a compiler can&rsquo;t help you), though, for a lot of string handling stuff, it&rsquo;s probably the same, unless you have fixed length fields, or known length processing, e.g. strcmp, or are willing to put effort in to work around it, e.g. SIMD.<br/>
Of course, you can always trivially append a value at the end if it would benefit your code.</p>
</div>
<ol class="children">
<li id="comment-552803" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-17T03:42:21+00:00">September 17, 2020 at 3:42 am</time></a> </div>
<div class="comment-content">
<p>I agree with most of this comment, but not the &ldquo;can also effectively turn character iteration into a pointer-chasing problem&rdquo;. It is true that it prevents easy vectorization because you can&rsquo;t be sure if you can access byte n+1 until you&rsquo;ve checked byte n &#8211; but it is materially different that pointer chasing since there is no <em>data dependency</em> there, only a well-predicted control dependency. That&rsquo;s the difference between say 1 cycle per byte versus 5 cycles per byte.</p>
<p>Vectorization is still possible, but you have to make some tough choices: e.g., aligning your reads and using the fact you won&rsquo;t cross a a page to do a read that is technically out of bounds, but known safe. Library code like <code>strlen()</code> does exactly that &#8211; but they have to get whitelisted in tools like ASAN and Valgrind which would otherwise complain. For libraries other than the standard library, this is less palatable since you&rsquo;ll probably have to convince users to add the whitelist rules yourself.</p>
</div>
</li>
</ol>
</li>
<li id="comment-551680" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c5d744640b5a0d326bf75e5579487324?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c5d744640b5a0d326bf75e5579487324?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://easyperf.net" class="url" rel="ugc external nofollow">Denis</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-03T16:16:32+00:00">September 3, 2020 at 4:16 pm</time></a> </div>
<div class="comment-content">
<p>Perhaps this <a href="https://easyperf.net/blog/2016/11/21/Sentinels" rel="nofollow ugc">article</a> is relevant.</p>
</div>
<ol class="children">
<li id="comment-551681" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-03T16:19:13+00:00">September 3, 2020 at 4:19 pm</time></a> </div>
<div class="comment-content">
<p>You are correct! It is the same idea expressed in similar terms.</p>
</div>
</li>
</ol>
</li>
<li id="comment-551682" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2f8cb3ef461ac7cf0e9012c129a0563b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2f8cb3ef461ac7cf0e9012c129a0563b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Raj Darman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-03T16:35:46+00:00">September 3, 2020 at 4:35 pm</time></a> </div>
<div class="comment-content">
<p>C newbie here, so apologies for my limited understanding.</p>
<p>We pass const char * start to the skip_leading_spaces() function, and inside we increment the start pointer. But this is a const char *, so we shouldn&rsquo;t be allowed to increment it, right?</p>
</div>
<ol class="children">
<li id="comment-551685" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-03T16:56:44+00:00">September 3, 2020 at 4:56 pm</time></a> </div>
<div class="comment-content">
<p>You are confusing const char * start with char * const start.</p>
</div>
<ol class="children">
<li id="comment-551944" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/096d991ae8bf781c317966ec99224bdd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/096d991ae8bf781c317966ec99224bdd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jonathan O'Connor</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-07T09:26:33+00:00">September 7, 2020 at 9:26 am</time></a> </div>
<div class="comment-content">
<p>To clarify for Raj, const char* means the char can&rsquo;t change, whereas char* const means the pointer can&rsquo;t change.</p>
<p>You can even have const char* const where both the pointer and the pointed to char are const.</p>
<p>Yes, at first this is confusing, but it&rsquo;ll become natural after some more months writing C or C++.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-551693" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://zeux.io" class="url" rel="ugc external nofollow">Arseny Kapoulkine</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-03T18:41:56+00:00">September 3, 2020 at 6:41 pm</time></a> </div>
<div class="comment-content">
<p>This is a complicated tradeoff. Sentinels can be faster, but they can also be slower.</p>
<p>In general I found that they are a great tool to micro-optimize parsers, but they make scanning using SIMD hard &#8211; unless the CPU provides instructions to load data that don&rsquo;t trigger fault handlers, or you&rsquo;re willing to cheat by detecting page boundaries (which doesn&rsquo;t work with address sanitizer / valgrind), null-terminated strings prevent ability to scan multiple characters at a time.</p>
<p>E.g. scanning an integer out of a string can be done with a few SIMD ops (load 16 bytes, subtract &lsquo;0&rsquo;, range check vs 10, movemask, find first 0 bit) if you know the 16 byte load is safe, but that&rsquo;s hard to establish without an explicit size.</p>
</div>
</li>
<li id="comment-552152" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/df65ecaa0c2c122642aeff08e00c55b1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/df65ecaa0c2c122642aeff08e00c55b1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://gorton-machine.org/rick" class="url" rel="ugc external nofollow">Richard Gorton</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-09T20:59:41+00:00">September 9, 2020 at 8:59 pm</time></a> </div>
<div class="comment-content">
<p>Noooo! Byte at a time is a sure way to kill performance.<br/>
&#8211; read glibc str<em>/mem</em> routines for your favorite architecture.<br/>
&#8211; understand them<br/>
&#8211; profit</p>
<p>I did some of the initial glibc vectorized versions for x86_64 back in 2010 while at AMD, and saw more than a 10x speedup for non-trivial strings. Bigger speedups for longer strings. Glibc developers have significantly improved upon those versions since then.</p>
</div>
</li>
<li id="comment-552153" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6dfb7841ea640362436975e36c553f99?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6dfb7841ea640362436975e36c553f99?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Rodriguez</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-09T21:08:51+00:00">September 9, 2020 at 9:08 pm</time></a> </div>
<div class="comment-content">
<p>Unless you are running these tests in a processor without branch prediction I honestly don&rsquo;t understand the 40% difference &#8211; I would have expected a very small (if any) difference. Actually, in your benchmarking code it looks you generate the data once&#8230;, not two identical copies (in different memory addresses) of the data for the &lsquo;regular&rsquo; and &lsquo;sentinel&rsquo; case, so I think that that is the source of the 40%&#8230;</p>
</div>
<ol class="children">
<li id="comment-552804" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-17T04:45:02+00:00">September 17, 2020 at 4:45 am</time></a> </div>
<div class="comment-content">
<p>Well predicted comparisons are not free: at a minimum there are still instructions and uops to make the comparison and take the branch. It can get worse from there: the compiler might not know which is the likely branch and it can end up organizing code so that the fast path has an always-taken branch which slows things down even more, etc.</p>
<p>A 40% improvement from removing one compare-and-branch from a loop that is extremely small, basically consisting of a single load and another compare-and-branch is not surprising.</p>
</div>
</li>
</ol>
</li>
<li id="comment-552195" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6dfb7841ea640362436975e36c553f99?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6dfb7841ea640362436975e36c553f99?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Rodriguez</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-10T11:28:14+00:00">September 10, 2020 at 11:28 am</time></a> </div>
<div class="comment-content">
<p>I compiled your code (and changed the order in which the tests are exercised), run it many times and I could not get more than 5% difference between the two with -O2 and -O3. So, I was wrong in that the difference would be small &#8211; 5% is significant to me, but for the 40% there must be some reason in how the code is generated or executed (which I don&rsquo;t have the time to analyze further).</p>
</div>
<ol class="children">
<li id="comment-552203" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-10T13:45:30+00:00">September 10, 2020 at 1:45 pm</time></a> </div>
<div class="comment-content">
<p>Here are my numbers on an AMD Rome processor:</p>
<pre><code>[dlemire@rome 09]$ c++ --version
c++ (GCC) 8.3.1 20190311 (Red Hat 8.3.1-3)
Copyright (C) 2018 Free Software Foundation, Inc.
This is free software; see the source for copying conditions.  There is NO
warranty; not even for MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.

[dlemire@rome 09]$ make
c++ -O3 -std=c++11 -o sentinel sentinel.cpp
[dlemire@rome 09]$ ./sentinel
 N = 10000
range 1313.74
sentinel 892.865
ratio 1.47138
@
</code></pre>
<p>Here are the numbers on a 2008 imac:</p>
<pre><code>$ c++ --version
Apple clang version 11.0.3 (clang-1103.0.32.62)
Target: x86_64-apple-darwin19.6.0
Thread model: posix
InstalledDir: /Applications/Xcode.app/Contents/Developer/Toolchains/XcodeDefault.xctoolchain/usr/bin
lemire@iMac-2018 ~/CVS/github/Code-used-on-Daniel-Lemire-s-blog/2020/09 $ make
c++ -O3 -std=c++11 -o sentinel sentinel.cpp
lemire@iMac-2018 ~/CVS/github/Code-used-on-Daniel-Lemire-s-blog/2020/09 $ ./sentinel
 N = 10000
range 1040.48
sentinel 725.152
ratio 1.43484
@
</code></pre>
<p>Here are my numbers on a Linux-based skylake (Intel) box:</p>
<pre><code>$ c++ --version
c++ (Ubuntu 8.4.0-1ubuntu1~16.04.1) 8.4.0
Copyright (C) 2018 Free Software Foundation, Inc.
This is free software; see the source for copying conditions.  There is NO
warranty; not even for MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.

dlemire@skylake:~/CVS/github/Code-used-on-Daniel-Lemire-s-blog/2020/09$ make
c++ -O3 -std=c++11 -o sentinel sentinel.cpp
dlemire@skylake:~/CVS/github/Code-used-on-Daniel-Lemire-s-blog/2020/09$ ./sentinel
 N = 10000
range 1194.83
sentinel 871.197
ratio 1.37148
@
</code></pre>
</div>
<ol class="children">
<li id="comment-552234" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6dfb7841ea640362436975e36c553f99?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6dfb7841ea640362436975e36c553f99?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Rodriguez</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-10T21:02:37+00:00">September 10, 2020 at 9:02 pm</time></a> </div>
<div class="comment-content">
<p>I tried your latest version in my computer (which is &ldquo;old&rdquo;, an Intel(R) Core(TM) i7-2620M CPU @ 2.70GHz, c++/gcc 9.3.0) and got:</p>
<p><code>$ make<br/>
c++ -O3 -std=c++11 -o sentinel sentinel.cpp<br/>
$ ./sentinel<br/>
N = 10000<br/>
range 1411.8<br/>
sentinel 1353.81<br/>
ratio 1.04284<br/>
@<br/>
</code></p>
<p>I see that you get the ~40% and I am sure that that outcome is really happening.</p>
<p>However, it is very difficult to explain the reason why (such a large percentage) in a general way. Both the range condition and is_space() require the new value of start (which just takes an addition), whereas the main latency is incurred in bringing the character from cache/memory and checking the table within is_space(). A modern speculative processor will already have computed the next &ldquo;start++&rdquo;, performed the check &ldquo;start != end&rdquo; (but not committed), and could in principle even initiate the next memory/cache request before is_space() finishes, also, being sequential access, the data for the speculative path is also probably in the cache. If I do the loop without calling is_space(), it takes 16 ns, i.e., the overhead of the range check alone is very small, and the overhead of &lsquo;is_space()&rsquo; we also know it (the &lsquo;sentinel&rsquo; version). I changed the order of the comparisons for the range check to:</p>
<p><code>while (is_space(*start) &amp;&amp; (start != end))<br/>
</code></p>
<p>and got even a smaller difference (~1%):</p>
<p><code>$ ./sentinel-v<br/>
N = 10000<br/>
range 1348.07<br/>
sentinel 1337.33<br/>
ratio 1.00803<br/>
@<br/>
</code></p>
<p>Because I am pretty sure that the 40% is actually happening, this has me puzzled, puzzled because the underlying reason has to be more complex than just having two comparisons. I possibility that crossed my mind is that the overhead we are seeing with the range comparison could be related to the fact that we are comparing &ldquo;chars&rdquo; and maybe this causes a barrier effect as the next character is aliased in the same word and maybe this messes with speculation, the compiler, or both (I&rsquo;m just speculating now, as I can&rsquo;t go much further into that rabbit hole, but interesting anyway).</p>
</div>
<ol class="children">
<li id="comment-552240" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-10T22:11:19+00:00">September 10, 2020 at 10:11 pm</time></a> </div>
<div class="comment-content">
<p>If you email me, I&rsquo;ll give you access to one of my servers.</p>
<blockquote>
<p>whereas the main latency is incurred in bringing the character from cache/memory</p>
</blockquote>
<p>Memory/cache access latency is almost surely irrelevant for this benchmark. We are reading sequentially.</p>
<blockquote>
<p>while (is_space(*start) &amp;&amp; (start != end))</p>
</blockquote>
<p>I expect that this is incorrect code.</p>
<blockquote>
<p>puzzled because the underlying reason has to be more complex than just having two comparisons</p>
</blockquote>
<p>Here is the assembly of the sentinel version&#8230;</p>
<pre><code>    movzx   ecx, byte ptr [rax + 1]
    add     rax, 1
    cmp     byte ptr [rcx + is_space(unsigned char)::table], 0
    jne     .LBB0_1
    ret
</code></pre>
<p>You can retire easily 4 instructions per cycle. Depending on the processor, there may be a limit at home many jumps you can make (e.g., you could be limited to one every two cycles). I believe however that in this case recent Intel and AMD processors should be able to sustain one jump per cycle given how short the loop is.</p>
<p>Note that a sandy bridge processor like yours is not something I have recent experience with (it is 10 years old).</p>
<p>Here is the assembly of the other version&#8230;</p>
<pre><code>    movzx   ecx, byte ptr [rax]
    cmp     byte ptr [rcx + is_space(unsigned char)::table], 0
    je      .LBB1_4
    add     rax, 1
    cmp     rsi, rax
    jne     .LBB1_1
    mov     rax, rsi
</code></pre>
<p>I would expect that the compare/jump instructions get fused. However, you surely can&rsquo;t execute two fused compare/jump instruction per cycle. So the long version has a limit of two cycles per iteration.</p>
<p>So I get a speed limit of one iteration per cycle for the sentinel version and a speed limit of two iteration every two cycles for the regular version. Of course, these are speed limitations and we probably do not manage to achieve this ideal performance.</p>
</div>
<ol class="children">
<li id="comment-552277" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6dfb7841ea640362436975e36c553f99?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6dfb7841ea640362436975e36c553f99?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Rodriguez</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-11T05:49:25+00:00">September 11, 2020 at 5:49 am</time></a> </div>
<div class="comment-content">
<p>Wow, that was a very valuable deep dive. Many thanks. This exercise was more valuable than I would have thought initially.</p>
<p>Now I think I see it. It doesn&rsquo;t matter how much speculative work the processor could have done, in this case, if I understand it correctly, we are gated by the number and type of instructions that can be retired per cycle, and there lies, for me, an important takeaway. It is a very illustrative example to teach about the state of modern microarchitecture.</p>
<p>Also, I agree with all other points (sequential access, means that accessing the data is not the limiting factor), also, when inverting the comparisons I was sloppy (I cannot think of an excuse for that). My Sandy Bridge still feels very powerful if I don&rsquo;t compare it against any modern processor 🙂</p>
</div>
<ol class="children">
<li id="comment-552315" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-11T12:38:27+00:00">September 11, 2020 at 12:38 pm</time></a> </div>
<div class="comment-content">
<p>I have not &ldquo;reasoned out&rdquo; the performance to my satisfaction. It would have taken me quite a few more minutes. I just wanted to illustrate that the 40% difference is credible.</p>
<p>For such a small benchmark, it should be possible to model the performance entirely and know exactly the expected performance.</p>
<p>A sandy bridge processor is really not very far from current processors as far as the main architectural features are concerned but on microbenchmarks, there can certainly be sizeable differences.</p>
</div>
<ol class="children">
<li id="comment-552339" class="comment even depth-7">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6dfb7841ea640362436975e36c553f99?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6dfb7841ea640362436975e36c553f99?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Rodriguez</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-11T15:19:58+00:00">September 11, 2020 at 3:19 pm</time></a> </div>
<div class="comment-content">
<p>The ways in which complexity leaks out of anything even when it looks short and simple never ceases to overwhelm me.</p>
<p>At the beginning, the 40% looked to me too extraordinary for a simple explanation &#8211; I wanted to know where could it come from, <em>exactly</em>.</p>
<p>BTW, I came across <a href="https://www.agner.org/optimize/microarchitecture.pdf" rel="nofollow ugc">https://www.agner.org/optimize/microarchitecture.pdf</a>, which actually contains a section on the bottlenecks of each microarchitecture that I found interesting (assuming it is an accurate report).</p>
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
<li id="comment-552679" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5821bf1e14b2f2a1597426c84b115d30?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5821bf1e14b2f2a1597426c84b115d30?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Rickey Bowers</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-15T11:15:45+00:00">September 15, 2020 at 11:15 am</time></a> </div>
<div class="comment-content">
<p>mov al,&rsquo; &lsquo;<br/>
repz scasb<br/>
jz @F<br/>
dec rdi</p>
<p>I&rsquo;d probably inline it. (c: The CISC goodness of x86 has been neglected by CPU manufacturers for decades &#8211; with good reason. Instructions like <code>JRCXZ</code> make handling Pascal type strings easy though.</p>
<p>The main benefit of not using sentinels is that the zero byte can be used for something else &#8211; typically, binary data needing the full range of values.</p>
<p>Each method has their uses: sentinel, count or range.</p>
</div>
<ol class="children">
<li id="comment-552754" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6dfb7841ea640362436975e36c553f99?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6dfb7841ea640362436975e36c553f99?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Rodriguez</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-16T12:03:39+00:00">September 16, 2020 at 12:03 pm</time></a> </div>
<div class="comment-content">
<p>I inlined the code you suggested and tested in my laptop (I know that could be considered a sin, an Intel(R) Core(TM) i7-2620M CPU @ 2.70GHz, c++/gcc 9.3.0) and found no difference between the generated C code or the inlined CISC instructions; I am curious if you get different results in a different machine and why the results would be different or not (I can imagine ways in which it could be slower or faster, I just don&rsquo;t know enough of each concrete microarchitecture to figure out why before running the benchmark).</p>
<p>I did it like this:</p>
<p><code>const char *skip_leading_spaces_asm1(const char *start) {<br/>
asm("mov al, ' ';\n\t"<br/>
"repz scasb;\n\t"<br/>
"jz 1f;\n\t"<br/>
"dec rdi;\n\t"<br/>
"1:\n"<br/>
: "+D"(start)<br/>
: "m"(*(const char(*)[])start), "c"(-1)<br/>
: "cc", "al");<br/>
return start;<br/>
}<br/>
</code></p>
<p>Or alternatively (effectively the same code, but using Extended ASM&rsquo;s features better to set &lsquo;al&rsquo;):</p>
<p><code>const char *skip_leading_spaces_asm(const char *start) {<br/>
asm volatile("repz scasb;\n\t"<br/>
"jz 1f;\n\t"<br/>
"dec rdi;\n\t"<br/>
"1:\n"<br/>
: "+D"(start)<br/>
: "m"(*(const char(*)[])start), "a"(' '), "c"(-1)<br/>
: "cc");<br/>
return start;<br/>
}<br/>
</code></p>
<p>I believe that the code is correct (I printed the &lsquo;start&rsquo; at then end of each run and compared it against the C++ function&rsquo;s output). I would nonetheless welcome that if something in the code is dangerous or wrong or not best practice, or could be radically improved, it&rsquo;d be pointed out.</p>
<p>I modified the Makefile like this:</p>
<p><code>tolower: sentinel.cpp<br/>
c++ -O3 -masm=intel -std=c++11 -o sentinel sentinel.cpp<br/>
c++ -O3 -masm=intel -std=c++11 -S -o sentinel.asm sentinel.cpp<br/>
</code></p>
<p>This was one output:</p>
<p><code>./sentinel<br/>
N = 10000<br/>
range 1413.99<br/>
sentinel 1340.31<br/>
sentinel_asm 1354.13<br/>
ratio range/sentinel 1.05497<br/>
ratio range/sentinel_asm 1.04421<br/>
`<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-552999" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5821bf1e14b2f2a1597426c84b115d30?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5821bf1e14b2f2a1597426c84b115d30?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Rickey Bowers</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-19T15:55:43+00:00">September 19, 2020 at 3:55 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for testing. I didn&rsquo;t expect it to be faster in this context &#8211; just as small as the call overhead of a separate function and more featureful. Timing such a small piece of code is error prone. From a practical standpoint: using such a routine is surely to be followed by a response for an empty string &#8211; which the forward branch would also handle.</p>
<p>There is another thing though. Intel&rsquo;s processor design has religated the complex CICS instructions to reduced silicon instead of improving their speed &#8211; for a couple decades. This is because compilers don&rsquo;t generate these instructions. Further examples are: LOOP*, J<em>CXZ, etc.. Exceptions are REP STOS</em>/MOVS*, which have been optimized in recent generations.</p>
<p>J<em>CXZ and LOOP</em> seem to have not been neglected on AMD processors.</p>
<p>Unpopular instructions are not optimized. In extreme cases they are repurposed (like BOUND, and the BCD instructions). The unfortunate consequence has us programming like RISC machines &#8211; which are boring, imho.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
