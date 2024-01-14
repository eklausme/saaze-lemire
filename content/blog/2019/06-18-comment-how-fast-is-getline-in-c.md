---
date: "2019-06-18 12:00:00"
title: "How fast is getline in C++?"
index: false
---

[28 thoughts on &ldquo;How fast is getline in C++?&rdquo;](/lemire/blog/2019/06-18-how-fast-is-getline-in-c)

<ol class="comment-list">
<li id="comment-412392" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e0c5018cde795b4bf3e692d20eff97d9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e0c5018cde795b4bf3e692d20eff97d9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://twitter.com/Wunkolo" class="url" rel="ugc external nofollow">Joey</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-18T20:38:12+00:00">June 18, 2019 at 8:38 pm</time></a> </div>
<div class="comment-content">
<p>I wonder how much of a speed-up it is to memory-map a file(<code>mmap</code>) and implementing <code>getline</code> as a re-entrant function with just pointer arithmetic(<code>string_view</code>?).</p>
</div>
<ol class="children">
<li id="comment-412393" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-18T20:46:27+00:00">June 18, 2019 at 8:46 pm</time></a> </div>
<div class="comment-content">
<p>My benchmark avoids disk access entirely.</p>
</div>
<ol class="children">
<li id="comment-412408" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2f0cf9749990f7cf217ead19aaec89a1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2f0cf9749990f7cf217ead19aaec89a1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">CAFxX</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-18T23:21:55+00:00">June 18, 2019 at 11:21 pm</time></a> </div>
<div class="comment-content">
<p>But it does not avoid the syscalls that a pre-faulted mapped view of the file would avoid, no?</p>
</div>
<ol class="children">
<li id="comment-412443" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-19T03:38:01+00:00">June 19, 2019 at 3:38 am</time></a> </div>
<div class="comment-content">
<p>The benchmark is entirely in userspace: it is not reading from a file at all, but building a long stream in memory and passing that inside a <code>std::istringstream</code> to getline which works on any stream, not just files.</p>
</div>
<ol class="children">
<li id="comment-412444" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-19T03:40:24+00:00">June 19, 2019 at 3:40 am</time></a> </div>
<div class="comment-content">
<p>I.e., Daniel&rsquo;s point is &ldquo;even cutting files entirely out of the equation, getline is still limited to 2 GB/s&rdquo;.</p>
</div>
<ol class="children">
<li id="comment-412494" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-19T13:20:45+00:00">June 19, 2019 at 1:20 pm</time></a> </div>
<div class="comment-content">
<p>That’s right. My claim is that the getline function can be a bottleneck.</p>
</div>
</li>
</ol>
</li>
<li id="comment-412471" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d623906de58d8530c4efbc8f19102e86?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d623906de58d8530c4efbc8f19102e86?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">victor Bogado da Silva Lins</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-19T09:16:38+00:00">June 19, 2019 at 9:16 am</time></a> </div>
<div class="comment-content">
<p>But then the whole stringstream mechanic will take a hold on the process. Iostreams use virtual calls all over the place and that is know to break the CPU pipeline.</p>
</div>
<ol class="children">
<li id="comment-412491" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-19T13:15:17+00:00">June 19, 2019 at 1:15 pm</time></a> </div>
<div class="comment-content">
<p>Do you expect that getline would be faster on an ifstream?</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-412493" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-19T13:18:19+00:00">June 19, 2019 at 1:18 pm</time></a> </div>
<div class="comment-content">
<p>There is no file involved.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-412404" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2f0cf9749990f7cf217ead19aaec89a1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2f0cf9749990f7cf217ead19aaec89a1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">CAFxX</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-18T22:28:29+00:00">June 18, 2019 at 10:28 pm</time></a> </div>
<div class="comment-content">
<p>I think a better example would help drive the point home, as if you only care about the size of the file fseek+ftell or fstat should be O(1) instead of O(n).</p>
<p>(Unless you really need the size of the file excluding newlines, but that seems to have somewhat limited utility)</p>
</div>
<ol class="children">
<li id="comment-412406" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-18T22:36:04+00:00">June 18, 2019 at 10:36 pm</time></a> </div>
<div class="comment-content">
<p>Implicitly, I am inviting the reader to fill in the function and actually do something with the strings; that&rsquo;s the homework assignment.</p>
</div>
</li>
</ol>
</li>
<li id="comment-412418" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-19T00:25:41+00:00">June 19, 2019 at 12:25 am</time></a> </div>
<div class="comment-content">
<p>Is getline implemented in libstdc++? If so, one would think that its performance would definitely depend on what C++ library implementation you&rsquo;re using.</p>
<p>There could also be overheads when dealing with streams and strings, but I&rsquo;m not knowledgeable enough with C++ to really know.</p>
</div>
<ol class="children">
<li id="comment-412436" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-19T03:18:40+00:00">June 19, 2019 at 3:18 am</time></a> </div>
<div class="comment-content">
<p><code>getline</code> is a C function, so it&rsquo;s not implemented in libstdc++, but rather libc or whatever MSVCRT thing is used on Windows.</p>
</div>
<ol class="children">
<li id="comment-412442" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-19T03:30:28+00:00">June 19, 2019 at 3:30 am</time></a> </div>
<div class="comment-content">
<p>Nevermind, I was mixing it up with the identically named getline(3) function in POSIX. Daniel is talking about std::getline in C++ and yes it would be implemented in libstc++.</p>
</div>
</li>
</ol>
</li>
<li id="comment-412492" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-19T13:17:42+00:00">June 19, 2019 at 1:17 pm</time></a> </div>
<div class="comment-content">
<p>Yes: I expect that the performance depends on the standard library. I use docker with a gcc container.</p>
</div>
</li>
<li id="comment-412525" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2a23f1eaa56bd9309254a7408803207e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2a23f1eaa56bd9309254a7408803207e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Max Lybbert</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-19T17:56:56+00:00">June 19, 2019 at 5:56 pm</time></a> </div>
<div class="comment-content">
<p>C++ streams are locale-aware, and have plenty of virtual methods (so that it’s possible to have streams that get their input from files, and others that get their input from strings, etc.), and C++ strings allocate memory when needed.</p>
<p>That is, there are plenty of opportunities for overhead in std::getline. Whenever I write C++, I honestly ask “do I need this input to be fast or convenient?” anytime I read from a file.</p>
</div>
<ol class="children">
<li id="comment-412601" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-20T05:39:35+00:00">June 20, 2019 at 5:39 am</time></a> </div>
<div class="comment-content">
<p>Thanks for the info!</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-412439" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-19T03:27:32+00:00">June 19, 2019 at 3:27 am</time></a> </div>
<div class="comment-content">
<p>It varies by OS, but there are some hard limits depending on how the &ldquo;IO&rdquo; is done (in quotes, because it might not involve any IO in the usual case the pages are cached).</p>
<p>If you use mmap, you need to fault-in every 4k page you read. Linux has &ldquo;fault around&rdquo; which means several pages are mapped in for every fault but you still end up limited to about 10 GB/s.</p>
<p>The situation is worse for read(2) which needs to make a system call every time it needs to fill a buffer. No doubt getline() is ultimately using read(2) or something equivalent under the covers. Every system call costs ~1000 cycles or more after Spectre and Meltdown, so you need to use large buffers enough to amortize the cost &#8211; but large buffers only work to an extent: too large and you end up missing in cache. Finally, the kernel has to copy from the page cache to your process. I measured limits around 6 GB/s although I haven&rsquo;t tried since Spectre &amp; Meltdown.</p>
<p>OTOH if you can get your file mapped into a 2 MIB page, the speed limit is 100 GB/s or more for mmap(). I&rsquo;m not sure if that&rsquo;s supported by any file system other than tmpfs yet.</p>
<p>All of those limits are significantly higher than 2 GB/s, so I guess this benchmark is mostly CPU-bound inside the getline call.</p>
</div>
</li>
<li id="comment-412502" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-19T14:30:59+00:00">June 19, 2019 at 2:30 pm</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s worth pointing out (again) that this does not test IO at all. Getline is just memchr + memcpy with buffer overflow checking &#8211; the benchmark spends more time in memchr than in getline.</p>
<p>If I do a loop with memchr to find the end of a line followed by memcpy into a fixed buffer, it is 70% faster. But with no checks whatsoever, it&rsquo;s not safe or robust&#8230;</p>
<p>However if I increase the average string size by 10x, the C++ version becomes more than 4 times as fast and the bare-bones version is 3 times as fast. The C++ overhead is now less than 25%.</p>
<p>So clearly the C++ overhead is not what is killing us here, it&rsquo;s the cost of doing many small unpredictable memchr/memcpy. Placing the line ends exactly 80 characters apart doubles performance of the memchr/memcpy.</p>
</div>
</li>
<li id="comment-412535" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bc014ec5e51a461d4ee0fae05875d05b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bc014ec5e51a461d4ee0fae05875d05b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Hung Dang</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-19T19:38:21+00:00">June 19, 2019 at 7:38 pm</time></a> </div>
<div class="comment-content">
<p>From my experience, there are two items that can speed up getline: faster memchr. This is my simple avx2 implementation <a href="https://github.com/hungptit/utils/blob/master/src/memchr.hpp" rel="nofollow ugc">https://github.com/hungptit/utils/blob/master/src/memchr.hpp</a> for memchr function which has been used in fast-wc. Manage all memory related operations in the userspace if possible. Below are simple benchmark results for a very large log file in the mapped memory disk to demonstrate that both wc ad fast-wc can process lines with the speed of 4GB/s.</p>
<p><strong>CPU</strong><br/>
<code>shell<br/>
processor : 87<br/>
vendor_id : GenuineIntel<br/>
cpu family : 6<br/>
model : 79<br/>
model name : Intel(R) Xeon(R) CPU E5-2699 v4 @ 2.20GHz<br/>
stepping : 1<br/>
microcode : 0xb00002e<br/>
cpu MHz : 2200.081<br/>
cache size : 56320 KB<br/>
</code></p>
<p><strong>wc</strong><br/>
<code>Linux> time wc /log/workqueue-execution-2019-06-17_00000<br/>
^C15.32user 0.22system 0:15.56elapsed 99%CPU (0avgtext+0avgdata 672maxresident)k<br/>
0inputs+0outputs (0major+197minor)pagefaults 0swaps<br/>
Linux> time wc -l /log/workqueue-execution-2019-06-17_00000<br/>
9333291 /log/workqueue-execution-2019-06-17_00000<br/>
1.48user 4.21system 0:05.70elapsed 99%CPU (0avgtext+0avgdata 644maxresident)k<br/>
0inputs+0outputs (0major+191minor)pagefaults 0swaps</code></p>
<p><strong>fast-wc</strong><br/>
<code>Linux> ls -l /log/workqueue-execution-2019-06-17_00000<br/>
-rw-r--r-- 1 hdang users 21650199150 Jun 19 15:08 /log/workqueue-execution-2019-06-17_00000<br/>
Linux> time fast-wc /log/workqueue-execution-2019-06-17_00000<br/>
Number of lines: 9333291<br/>
Max line length: 978370<br/>
Min line length: 132<br/>
File size: 21650199150<br/>
1.06user 3.82system 0:04.89elapsed 99%CPU (0avgtext+0avgdata 684maxresident)k<br/>
0inputs+0outputs (0major+188minor)pagefaults 0swaps</code></p>
</div>
<ol class="children">
<li id="comment-412661" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bc014ec5e51a461d4ee0fae05875d05b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bc014ec5e51a461d4ee0fae05875d05b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Hung Dang</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-20T14:36:37+00:00">June 20, 2019 at 2:36 pm</time></a> </div>
<div class="comment-content">
<p>The format of my above comment is screwed. Is there any way to fix it?</p>
</div>
<ol class="children">
<li id="comment-412669" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-20T15:20:01+00:00">June 20, 2019 at 3:20 pm</time></a> </div>
<div class="comment-content">
<p>Fixed.</p>
</div>
<ol class="children">
<li id="comment-412686" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bc014ec5e51a461d4ee0fae05875d05b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bc014ec5e51a461d4ee0fae05875d05b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Hung Dang</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-20T17:08:20+00:00">June 20, 2019 at 5:08 pm</time></a> </div>
<div class="comment-content">
<p>Thank a lot Daniel.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-412539" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a5279b0f5b528dbeee3758f5cb9ccd9d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a5279b0f5b528dbeee3758f5cb9ccd9d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://byteterrace.com" class="url" rel="ugc external nofollow">David Smith</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-19T20:09:56+00:00">June 19, 2019 at 8:09 pm</time></a> </div>
<div class="comment-content">
<p>Here&rsquo;s the fastest version I&rsquo;ve been able to come up with for handling multi-line text; after a single execution rax will contain the current bufferOffset and rdx will contain the isQuotedSequence indicator. Actual handling of the string is left as an exercise to the reader =P.</p>
<p><a href="https://gist.github.com/Kittoes0124/c2288ec4daee90f549dfe73430494847" rel="nofollow ugc">https://gist.github.com/Kittoes0124/c2288ec4daee90f549dfe73430494847</a></p>
<p>Would love to see you improve upon!</p>
</div>
<ol class="children">
<li id="comment-413745" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-25T23:17:07+00:00">June 25, 2019 at 11:17 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m not sure what this is supposed to do, however this code can be sped up a lot. For example with unrolling you only really need to check the buffer end once every N characters. Similarly you only need one compare to check all the special cases, eg. if ((ch ^ 2) &lt;= 0x20) will catch all special cases. And when handling the special cases you&rsquo;d use logical operations and conditional moves to avoid branch mispredictions. An advanced version would use SIMD instructions to do all this on N characters at a time.</p>
</div>
</li>
</ol>
</li>
<li id="comment-413720" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2fb1d0febf487a1d0b6ece2ff02affaa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2fb1d0febf487a1d0b6ece2ff02affaa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christopher Chang</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-25T18:34:31+00:00">June 25, 2019 at 6:34 pm</time></a> </div>
<div class="comment-content">
<p>I wrote a low-level ReadLineStream interface (<a href="https://github.com/chrchang/plink-ng/blob/master/2.0/plink2_decompress.h#L188" rel="nofollow ugc">https://github.com/chrchang/plink-ng/blob/master/2.0/plink2_decompress.h#L188</a> ) to take care of this issue, along with transparent zstd/bgzf decompression. It&rsquo;s not directly usable in other programs, but it shouldn&rsquo;t take that much work to make it into a normal library.</p>
</div>
</li>
<li id="comment-420714" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-29T04:30:03+00:00">July 29, 2019 at 4:30 am</time></a> </div>
<div class="comment-content">
<p>Using <code>setvbuf(file, 0, _IOFBF, 102400);</code> can do wonders to improve reads on a C FILE stream. Last time I measured (~20 years ago?), the knee of the curve was under 100K.</p>
<p>I simply have found no reason to use the C++ streams, so I cannot comment on any equivalent.</p>
<p>For bare-metal performance, I do read() into a very large buffer, and parse out the lines, as in:</p>
<p><a href="https://github.com/pbannister/wide-finder/blob/master/ZReader.cpp" rel="nofollow ugc">https://github.com/pbannister/wide-finder/blob/master/ZReader.cpp</a></p>
<p>Recently used a very similar approach to parse raw radar data and dump in text form. Must be very fast to be useful to the customer, as the data can easily be tens of gigabytes per run. Tool is bottlenecked on storage performance, on the target system (eight spinning disks in RAID 0). Not code I can share, in this case.</p>
</div>
</li>
<li id="comment-421033" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4c476469ffae422c3dd50720fbd7ef2a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4c476469ffae422c3dd50720fbd7ef2a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maxim Egorushkin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-30T16:13:39+00:00">July 30, 2019 at 4:13 pm</time></a> </div>
<div class="comment-content">
<p>You may like to call std::ios_base::sync_with_stdio(false) before reading, it often speeds things up.</p>
</div>
</li>
</ol>
