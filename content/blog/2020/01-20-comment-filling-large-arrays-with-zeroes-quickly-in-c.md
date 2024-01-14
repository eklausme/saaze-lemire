---
date: "2020-01-20 12:00:00"
title: "Filling large arrays with zeroes quickly in C++"
index: false
---

[25 thoughts on &ldquo;Filling large arrays with zeroes quickly in C++&rdquo;](/lemire/blog/2020/01-20-filling-large-arrays-with-zeroes-quickly-in-c)

<ol class="comment-list">
<li id="comment-486927" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24cfa9591263008553ae4c125b6a9934?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24cfa9591263008553ae4c125b6a9934?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">wmu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-20T21:02:39+00:00">January 20, 2020 at 9:02 pm</time></a> </div>
<div class="comment-content">
<p>At -O3 level GCC insert a call to memset. I checked at godbolt that this optimization is available since GCC 4.8.</p>
</div>
<ol class="children">
<li id="comment-486933" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-20T22:12:18+00:00">January 20, 2020 at 10:12 pm</time></a> </div>
<div class="comment-content">
<p>True, but my guess is that most code does not get compiled with -O3.</p>
</div>
<ol class="children">
<li id="comment-486999" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6454925bde1c6d87823e8973588b1018?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6454925bde1c6d87823e8973588b1018?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">PR</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-21T07:59:06+00:00">January 21, 2020 at 7:59 am</time></a> </div>
<div class="comment-content">
<p>Interesting. Any particular reason -O3 is not used? My first guess would be compile times for large projects?</p>
</div>
<ol class="children">
<li id="comment-487090" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-21T17:34:45+00:00">January 21, 2020 at 5:34 pm</time></a> </div>
<div class="comment-content">
<p>I think that the rationale is part of the GNU GCC documentation, it states that -O2 &ldquo;performs nearly all supported optimizations that do not involve a space-speed tradeoff&rdquo;. That is, the -O3 flag may grow the binary size to achieve better speed. And, of course, -O3 may fail to deliver better speed because of the trade-offs involved.</p>
<p>I think that if -O3 delivered consistently better performance, it would be the new default at release time, but I don&rsquo;t think it works this way.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-487000" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b21d3854f5dd59080e758d0310e5752f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b21d3854f5dd59080e758d0310e5752f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tommaso</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-21T08:04:11+00:00">January 21, 2020 at 8:04 am</time></a> </div>
<div class="comment-content">
<p>Disclaimer: this is on clang, so maybe it doesn&rsquo;t matter.</p>
<p>Anyway, looking at the code I noticed that the memory is set to 1 only once and then re-zeroed in all subsequent benchmarks&#8230; so perhaps only the first benchmark (std::fill) is doing something.<br/>
So I swapped around the memset bench and the std::fill bench and this came out:</p>
<p><code>page count: 32, volume:0.125 MB<br/>
memset(p,0,n) : 9.2219 GB/s<br/>
std::fill(p, p + n, '\0') : 39.1376 GB/s<br/>
std::fill(p, p + n, 0) : 39.3015 GB/s</p>
<p>memset(p,0,n) : 39.3268 GB/s<br/>
std::fill(p, p + n, '\0') : 39.5562 GB/s<br/>
std::fill(p, p + n, 0) : 39.6719 GB/s</p>
<p>memset(p,0,n) : 39.4922 GB/s<br/>
std::fill(p, p + n, '\0') : 39.8012 GB/s<br/>
std::fill(p, p + n, 0) : 39.8272 GB/s<br/>
</code></p>
<p>and suddenly, memset is the bad one!<br/>
In fact the first bench is the slowest almost every time on my machine.</p>
<p>This is on MacOS 16 + clang&#8230; maybe this happens because once a page is zeroed, it&rsquo;s remapped to the read-only zero-page and subsequent 0-writes don&rsquo;t do anything?</p>
<p>I changed the code to give each benchmark its own memory area, and that way I get about the same speed for all 3 methods, +/- some (pretty big) random fluctuations on all 3:</p>
<p><code>char* src = new char[i*3];<br/>
memset(src, 1, i * 3);</p>
<p>for (int z = 0; z &lt; 3; z++) {<br/>
char* p = src;<br/>
bench2(p, i);</p>
<p> p += i;<br/>
bench1(p, i);</p>
<p> p += i;<br/>
bench(p, i);</p>
<p> std::cout &lt;&lt; std::endl;<br/>
}</p>
<p>delete[] src;<br/>
</code></p>
<p>&#8230; although the very first bench*() call (no matter which) is still at 9 gb/s. No idea why 🙂</p>
</div>
<ol class="children">
<li id="comment-487092" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-21T17:37:11+00:00">January 21, 2020 at 5:37 pm</time></a> </div>
<div class="comment-content">
<p>I run the benchmark three times for a reason! 🙂</p>
</div>
</li>
<li id="comment-487113" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-21T22:16:49+00:00">January 21, 2020 at 10:16 pm</time></a> </div>
<div class="comment-content">
<p>The first bench will run slowly simply because of the pagefaults to allocate and zero the memory.</p>
</div>
</li>
</ol>
</li>
<li id="comment-487062" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4c476469ffae422c3dd50720fbd7ef2a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4c476469ffae422c3dd50720fbd7ef2a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maxim Egorushkin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-21T14:16:55+00:00">January 21, 2020 at 2:16 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t think your analysis is correct, you missed the main point of the original post which is using the right type for the fill value.</p>
<p><a href="https://gcc.godbolt.org/z/pjeh25" rel="nofollow ugc">Here is <code>fill</code> with correct type and -O2 optimization compiling down to <code>memset</code></a> on godbolt.</p>
</div>
<ol class="children">
<li id="comment-487064" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-21T14:30:07+00:00">January 21, 2020 at 2:30 pm</time></a> </div>
<div class="comment-content">
<p>How is my analysis wrong?</p>
<p>I agree with what you wrote but it agrees with my post.</p>
</div>
<ol class="children">
<li id="comment-487066" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4c476469ffae422c3dd50720fbd7ef2a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4c476469ffae422c3dd50720fbd7ef2a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maxim Egorushkin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-21T14:40:09+00:00">January 21, 2020 at 2:40 pm</time></a> </div>
<div class="comment-content">
<p>This is a bug in GNU C++ library <code>std::fill</code>/<code>std::fill_n</code>. Using the argument of the exact correct type for the fill value fixes the bug and makes it use <code>memset</code>.</p>
<p>On one other hand you have <code>memset</code>, which you need to specify the correct size in bytes, despite it taking an <code>int</code> fill value (specifying wrong size for <code>memset</code> is a common bug in stackoverflow questions).</p>
</div>
<ol class="children">
<li id="comment-487070" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-21T14:59:38+00:00">January 21, 2020 at 2:59 pm</time></a> </div>
<div class="comment-content">
<p>Yes, you can get around the performance issue, as Travis explains. Whether it is a bug is debatable: it has been around forever and it is standard compliant.</p>
<p>But the larger point is that nothing at all in the C++ standard guarantees that you will get the best possible performance with std::fill. This is just one example of many where using the idiomatic approach will fail you.</p>
<p>Please check my previous posts where I show that just about the worse possible way to allocate and initialize memory is via &ldquo;new()&rdquo;, at least in GNU GCC.</p>
<p>My argument is not that you should forgo the idiomatic way, or drop C++ in favor of C. My argument is laid out in my post. (Last paragraph.)</p>
</div>
<ol class="children">
<li id="comment-487072" class="comment odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4c476469ffae422c3dd50720fbd7ef2a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4c476469ffae422c3dd50720fbd7ef2a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maxim Egorushkin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-21T15:05:07+00:00">January 21, 2020 at 3:05 pm</time></a> </div>
<div class="comment-content">
<p>Well, you are intentionally measuring performance of code hitting the library bug and yet you are not using <code>-O3</code> optimization, despite targeting for top performance. It is hard to call such an approach scientifically sound, IMHO.</p>
</div>
<ol class="children">
<li id="comment-487083" class="comment byuser comment-author-lemire bypostauthor even depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-21T16:40:20+00:00">January 21, 2020 at 4:40 pm</time></a> </div>
<div class="comment-content">
<p>The first link in the blog post is to Travis&rsquo; blog post, where he describes the issue in details. I have the following line &ldquo;He also explains how to fix the C++ so that it is as fast as the memset function.&rdquo;</p>
<p>Do you disagree with the point I am making? The point is the following: &ldquo;writing your code in idiomatic C++ is not sufficient to guarantee good performance&rdquo;.</p>
<p>If you disagree, I have many more arguments. In fact, I have literally hundreds of blog posts on this topic over 15 years.</p>
<p>This happens <em>all the time</em>. It is actually kind of difficult to get bare metal performance out of C++ systematically. It is comparatively quite easy to write idiomatic C++.</p>
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
<li id="comment-487086" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4c476469ffae422c3dd50720fbd7ef2a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4c476469ffae422c3dd50720fbd7ef2a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maxim Egorushkin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-21T17:13:47+00:00">January 21, 2020 at 5:13 pm</time></a> </div>
<div class="comment-content">
<p>You are trying to write idiomatic code, but you made an intentional mistake in it by using a wrong type, which resulted in the sub-optimal code path. And to add insult to injury you pessimize it with <code>-O2</code> instead of <code>-O3</code>.</p>
<p>So, you have idiomatically looking code with a subtle bug in it and that&rsquo;s what you benchmark.</p>
</div>
<ol class="children">
<li id="comment-487087" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-21T17:18:45+00:00">January 21, 2020 at 5:18 pm</time></a> </div>
<div class="comment-content">
<p>Please be clear, Maxim, about your disagreement. Here is my statement: “writing your code in idiomatic C++ is not sufficient to guarantee good performance”.</p>
<p>Do you agree or do you disagree?</p>
</div>
<ol class="children">
<li id="comment-487089" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4c476469ffae422c3dd50720fbd7ef2a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4c476469ffae422c3dd50720fbd7ef2a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maxim Egorushkin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-21T17:30:57+00:00">January 21, 2020 at 5:30 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;Writing your code in idiomatic C++ is not sufficient to guarantee good performance”. &#8211; I agree, just as well as I agree with &ldquo;writing your code in non-idiomatic C++ is not sufficient to guarantee good performance either”.</p>
<p>In both cases the code must be bug free, however subtle the bugs are.</p>
<p>May be you are trying to say that passing literal <code>0</code> into <code>memset</code> doesn&rsquo;t create a subtle performance bug, unlike with <code>std::fill</code>, and that can <em>conditionally</em> be true. People compiling with <code>-O3</code> (like me) wouldn&rsquo;t experience that bug either.</p>
<p>I value information from most of your posts, nevertheless.</p>
</div>
<ol class="children">
<li id="comment-487094" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-21T17:43:24+00:00">January 21, 2020 at 5:43 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for the good words.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-487114" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-21T22:25:52+00:00">January 21, 2020 at 10:25 pm</time></a> </div>
<div class="comment-content">
<p>This issue with std::fill has already been fixed in latest GCC: <a href="https://godbolt.org/z/ctoECs" rel="nofollow ugc">https://godbolt.org/z/ctoECs</a></p>
<p>Note compilers would become much better quickly if people take the time to report optimization issues rather than just complaining about them in various blogs&#8230;</p>
</div>
<ol class="children">
<li id="comment-487116" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-21T22:37:44+00:00">January 21, 2020 at 10:37 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>Note compilers would become much better quickly if people take the<br/>
time to report optimization issues rather than just complaining about<br/>
them in various blogs…</p>
</blockquote>
<p>I am not exactly sure how it works regarding GNU GCC. For example, I know how to double the speed of the random shuffle and <a href="https://lemire.me/blog/2019/09/28/doubling-the-speed-of-stduniform_int_distribution-in-the-gnu-c-library/">I sent a patch</a>. I&rsquo;m looking forward to see whether it makes it.</p>
</div>
<ol class="children">
<li id="comment-487117" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-21T22:41:10+00:00">January 21, 2020 at 10:41 pm</time></a> </div>
<div class="comment-content">
<p>Note that the point of my post was <em>not</em> to complain about the compilers.</p>
</div>
<ol class="children">
<li id="comment-487123" class="comment even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-21T23:10:18+00:00">January 21, 2020 at 11:10 pm</time></a> </div>
<div class="comment-content">
<p>Call it what you like! It is interesting to point out that various C++ constructs can have very different performance characteristics across compilers and even different versions of the same compiler.</p>
<p>However these are examples of optimization inefficiencies which should not happen and are easily fixable in compilers &#8211; if only we hear about them!</p>
<p><a href="https://gcc.gnu.org/bugzilla/" rel="nofollow ugc">GCC has a bugzilla</a> where you can report bugs or optimization issues. <a href="https://gcc.gnu.org/contribute.html" rel="nofollow ugc">Contributing patches to GCC</a> requires a copyright assignment, and to get your patches accepted you may need to post them repeatedly if people are busy and they don&rsquo;t get any attention&#8230;</p>
</div>
<ol class="children">
<li id="comment-487220" class="comment byuser comment-author-lemire bypostauthor odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-22T16:16:16+00:00">January 22, 2020 at 4:16 pm</time></a> </div>
<div class="comment-content">
<p><em>Contributing patches to GCC requires a copyright assignment</em></p>
<p>Yes, I did the copyright assignment last year. It has been accepted.</p>
</div>
</li>
<li id="comment-487259" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-23T00:22:19+00:00">January 23, 2020 at 12:22 am</time></a> </div>
<div class="comment-content">
<p>My experience across a few compiler and similar projects is that most reported issues are either ignored, or initially discussed then subsequently ignored.</p>
<p>Even compiler developers admit that the best way to get something fixed is to complain about it in a visible way (not saying Daniel is doing this), at which point it gets fixed.</p>
</div>
<ol class="children">
<li id="comment-487377" class="comment odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-24T12:36:17+00:00">January 24, 2020 at 12:36 pm</time></a> </div>
<div class="comment-content">
<p>Well the best way to get things done in an open source project is to be <em>extremely</em> proactive, so ask questions, file bugs, post patches etc. There are always reports about trivial things which don&rsquo;t matter much for performance.</p>
<p>A common example is emitting a redundant move in a small function (usually due to argument passing, register allocation/scheduling interactions etc). 100% optimal code is as impossible as perfect register allocation or scheduling.</p>
<p>Compiler experts are busy, and prefer to spend their time on things that are achievable and make a measurable improvement!</p>
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
<li id="comment-487376" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2e118e17ad4b2625419183912f0c8fb2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2e118e17ad4b2625419183912f0c8fb2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Francesco Biscani</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-24T12:04:04+00:00">January 24, 2020 at 12:04 pm</time></a> </div>
<div class="comment-content">
<p>I think it is at least arguable that using</p>
<p><code>std::fill(p, p + n, 0);<br/>
</code></p>
<p>where p is a char pointer is not really idiomatic C++, because std::fill is defined in terms of assignments and thus is pretty clear that (formally) a type conversion is going to take place. Still, it&rsquo;s clearly desirable for an implementation to detect and optimise this usage as well.</p>
<p>(This example reminds me a bit of how people regularly misuse std::iota, std::accumulate, etc. by using the wrong type for the initializer)</p>
</div>
</li>
</ol>
