---
date: "2017-01-16 12:00:00"
title: "Best programming language for high performance (January 2017)?"
index: false
---

[70 thoughts on &ldquo;Best programming language for high performance (January 2017)?&rdquo;](/lemire/blog/2017/01-16-best-programming-language-for-high-performance-january-2017)

<ol class="comment-list">
<li id="comment-266289" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6a3b2b2e3e34161724b478f8202ecd4e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6a3b2b2e3e34161724b478f8202ecd4e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Skand Hurkat</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-16T20:05:11+00:00">January 16, 2017 at 8:05 pm</time></a> </div>
<div class="comment-content">
<p>I really like this way of reasoning about languages. I have, however, a bone to pick with your reasoning about no particular cross-platform build system for C/C++. While it is true that there is no cross-platform build and test system as defined by the standard, CMake comes really close to such a system. With the new C++11â€“17 standards that abstract away many of the OS-specifics such as multithreading and file systems, C++ with CMake gets as cross-platform as it could possibly get.</p>
</div>
<ol class="children">
<li id="comment-266292" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-16T20:24:15+00:00">January 16, 2017 at 8:24 pm</time></a> </div>
<div class="comment-content">
<p>@Skand</p>
<p>Have you tried Go tools? Ok. We have this project in Go. You know what you need to do to get it and all its dependencies? And then run tests to make sure that it works?</p>
<pre>
go get -t github.com/RoaringBitmap/roaring
go test
</pre>
<p>That&rsquo;s it. And this pretty much works with any Go project. </p>
<p>There is simply nothing like it in C++. </p>
<p>I don&rsquo;t know what fraction of C++ programmers use CMake. I estimate that it is actually quite small. For one thing, users of Visual Studio won&rsquo;t touch CMake and I would not be surprised if they made up more than the majority of users.</p>
<p>While CMake can call your tests, it does not really provide a testing framework, you have to roll your own. If there are dependencies, you have to provide them on your own. If users need to resolve dependencies, they have to figure it out on their own.</p>
<p>With Go, you can just pick up any project and you have a pretty good idea how to build it, no matter where you are.</p>
<p>That&rsquo;s not to say that Go is perfect. It still has major faults. But CMake is nowhere close.</p>
</div>
<ol class="children">
<li id="comment-266321" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4083d695cc59dcbce81cf4affae0d190?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4083d695cc59dcbce81cf4affae0d190?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.calebwherry.com" class="url" rel="ugc external nofollow">Caleb Wherry</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-17T01:06:32+00:00">January 17, 2017 at 1:06 am</time></a> </div>
<div class="comment-content">
<p>Visual Studio 2017 ships with CMake. They are actively working on CMake integration and working nicely with the C++ community to figure out how best to make things work in real production environments. So your intuition about Visual Studio is completely off.</p>
<p>And CMake&rsquo;s support for Visual Studio is not the best, but it does work. After some digging, I can usually get what I want done in a cross-platform manner. The rub is that I&rsquo;m dealing with decades-old legacy 3rd party libs and brand spanking new libs. Nothing will ever, EVER, cover these builds/configs in one simple way. CMake makes it so that I can work with these disparate technologies and still have a flexible build system.</p>
<p>The main problem with your analysis is that I think it&rsquo;s unfair to compare the build tools and say &ldquo;CMake is nowhere close&rdquo; because CMake does so much more than the Go tools have to. For large, cross-platform C and C++ projects where they do dev work with Visual Studio and things like CLion, CMake is the way to go. And if you look up projects that actually use CMake, I think you&rsquo;d be surprised at the list.</p>
</div>
<ol class="children">
<li id="comment-266326" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-17T02:25:49+00:00">January 17, 2017 at 2:25 am</time></a> </div>
<div class="comment-content">
<p>@Caleb</p>
<p>So we are clear, I use CMake all the time, almost daily. E.g., see <a href="https://github.com/RoaringBitmap/CRoaring" rel="nofollow ugc">https://github.com/RoaringBitmap/CRoaring</a></p>
<p><em>Visual Studio 2017 ships with CMake.</em></p>
<p>Ah! That&rsquo;s interesting. So I was wrong to underestimate Microsoft. I am happy that my pessimism was unwarranted. Thanks for educating me on this issue.</p>
<p><em>The main problem with your analysis is that I think it&rsquo;s unfair to compare the build tools and say â€œCMake is nowhere closeâ€ because CMake does so much more than the Go tools have to. For large, cross-platform C and C++ projects where they do dev work with Visual Studio and things like CLion, CMake is the way to go. And if you look up projects that actually use CMake, I think you&rsquo;d be surprised at the list.</em></p>
<p>I don&rsquo;t think I am being unfair. CMake is a major contribution. I do not underestimate the difficulty.</p>
<p>But the truth remains that CMake solves a fraction of what the Go or Swift tools solve. </p>
<p>You point is that I am being unfair because neither Go nor Swift has to support &ldquo;decades-old legacy 3rd party libs&rdquo;. I agree with your wording, but I think I am being fair. Hear me out.</p>
<p>When the C and C++ came about, nobody had the idea that testing, building and managing dependencies had to be part of the language. So it was built separately, by different people, and it evolved without any standard. It is too late today to really solve this problem. It is like retro-engineering a Chevy Impala so that it runs on solar energy. I mean, in theory, it could be done, but you just know it won&rsquo;t get done.</p>
<p>So CMake is a lot better than autoconf/automake. No question about it. It solves hard problems&#8230; ok. But it is only so incredibly hard because we are retro-engineering.</p>
<p>But let me go back to my Go example. Realize that what I described, running tests, downloading dependencies, and so forth&#8230; that can all be done without any configuration file. With Swift, there is a configuration file, but it is maybe 5 lines at the most. Rust is similar. </p>
<p>So Swift, Go, Rust&#8230; they have this idea that the language needs to come with its own high-quality tools, by default. I submit to you that it is an innovation. They did not invent this idea&#8230; I mean &ldquo;Turbo Pascal&rdquo; came with its own IDE. So did Visual Basic and so forth. But you have to give credit to the folks involved: they knew enough to realize that languages today need to be a lot more than just syntax and a compiler.</p>
<p>If we are going to move forward in software, we have to learn from our collective mistakes. C and C++ are great, but if we had to do them over, we could do a lot better.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-266361" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24cfa9591263008553ae4c125b6a9934?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24cfa9591263008553ae4c125b6a9934?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">wmu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-17T06:21:16+00:00">January 17, 2017 at 6:21 am</time></a> </div>
<div class="comment-content">
<p>If world were ideal then you would be right. 🙂 But C++ build-world is a mess, and nothing will change. In the wild you find: custom makefiles, autotools, Microsoft&rsquo;s VC files, even Boost has own build system. There are too many libraries, too many eco-systems (unix, windows, mac) and incompatible compilers. I work with C++ and every time I need to compile an external library it is a pain in neck.</p>
<p>C++17 would be an answer if it were came 10-20 years ago, now it&rsquo;s too late, there are billions of lines written in C++98, C++03 or C++11.</p>
</div>
<ol class="children">
<li id="comment-419199" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0620f543129132d44fef456b3ab31a39?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0620f543129132d44fef456b3ab31a39?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">stgatilov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-20T06:41:01+00:00">July 20, 2019 at 6:41 am</time></a> </div>
<div class="comment-content">
<p>I cannot disagree with the point of C/C++ builds being a mess, but I must point out that there are ways to build a wide variety of libraries on wide variety of platforms in uniform way. Recently, I have used <a href="https://conan.io/" rel="nofollow">conan package manager</a> to automate downloading and building of a <a href="http://wiki.thedarkmod.com/index.php?title=Libraries_and_Dependencies" rel="nofollow">bunch of libraries</a>. This includes building custom-configured FFmpeg (which is a <a href="http://wiki.thedarkmod.com/index.php?title=Compiling_FFmpeg_for_TDM" rel="nofollow">huge pain on Windows otherwise</a>), managing dependencies between zlib/minizip/mbedtls/libcurl, using static libraries instead of DLLs, and some project-specific hacks.</p>
<p>In conan, one can write a &ldquo;recipe&rdquo; for a library, which is basically a Python script for building it. There are also tons of helpers of all kind, dependency management, packaging customization, tagging artefacts, etc. Of course, in order to use it successfully, one has to invest tons of time into learning conan and specifics of platforms, ABI, build systems, etc. Otherwise you will be limited to using already available recipes with default configurations, Which, by the way, include boost, qt, poco =)</p>
<p>So, a uniform system for dependencies exists, but it will never be as easy as npm/pip install.</p>
<p>P.S. Some other signs of gradual improvement:</p>
<p>CMake becomes more and more popular for C/C++ libraries, even old ones migrate to it.<br/>
Header-only libraries are quite convenient to use. Just remember that there are <a href="https://github.com/onqtam/doctest/blob/master/doc/markdown/benchmarks.md" rel="nofollow">good and bad header-only libraries</a>, otherwise you will quickly get into build time issues.</p>
</div>
</li>
</ol>
</li>
<li id="comment-294504" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ee69c36999e1dae5d6dd9a9887a03f25?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ee69c36999e1dae5d6dd9a9887a03f25?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="c6aaa3aea9a7a8a1a2afa8aeb2b3a7a886a1aba7afaae8a5a9ab">[email&#160;protected]</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-05T01:26:29+00:00">January 5, 2018 at 1:26 am</time></a> </div>
<div class="comment-content">
<p>I love C++ with CMake<br/>
I&rsquo;m an java programmer and now begining with C++ to prepare for any kind of future project in future.</p>
</div>
</li>
</ol>
</li>
<li id="comment-266296" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ed831e0fb888d0c690a19795207aab42?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ed831e0fb888d0c690a19795207aab42?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://lion137.blogspot.co.uk" class="url" rel="ugc external nofollow">lion137</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-16T20:53:12+00:00">January 16, 2017 at 8:53 pm</time></a> </div>
<div class="comment-content">
<p>Python comes with JIT (pypy) and cool libraries libraries like numpy, theano, so, is also a choice, imo.</p>
</div>
<ol class="children">
<li id="comment-266297" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-16T20:55:35+00:00">January 16, 2017 at 8:55 pm</time></a> </div>
<div class="comment-content">
<p>I do address Python. It is certainly possible to write very fast software in Python&#8230; but I don&rsquo;t think it is in the same class as the languages I consider.</p>
</div>
<ol class="children">
<li id="comment-293646" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6c0a6807cc7c05483035f35ed32404c9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6c0a6807cc7c05483035f35ed32404c9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://markdesign.pl" class="url" rel="ugc external nofollow">Marek Marczak</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-16T23:22:08+00:00">December 16, 2017 at 11:22 pm</time></a> </div>
<div class="comment-content">
<p>Some Python libraries are essentially C libraries just with Python bindings. They&rsquo;re very fast hitting almost C performance. Google ie. Numba. It is possible to write fast apps (regarding Python is interpreted &#8211; not compiled!), but the programmer should know which part of code are executed slower and then ie prefer list comprehensions instead of &ldquo;normal&rdquo; for loops which are not very fast in python (but comprehensions are quite fast indeed!).</p>
<p>Go. You can turn off GC in Go and use &ldquo;bare metal&rdquo; memory allocation. However Go is not very suitable for processor programing, because the Go niche is internet and Go executables contain a lot of additional stuff (they&rsquo;re much bigger than C ones) .</p>
</div>
</li>
<li id="comment-427704" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/41db2ecac7bd9fb0b6977cd645fc19de?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/41db2ecac7bd9fb0b6977cd645fc19de?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Penguin Monkey</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-19T02:53:11+00:00">September 19, 2019 at 2:53 am</time></a> </div>
<div class="comment-content">
<p>You can transpile your Python code to Julia, Rust, or C++ to get additional performance. Sometimes you can use Pypy (but you can&rsquo;t use certain libraries if you do this), and sometimes you can use numba&rsquo;s jit, @rpython, or cython.</p>
</div>
<ol class="children">
<li id="comment-428050" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-20T20:11:27+00:00">September 20, 2019 at 8:11 pm</time></a> </div>
<div class="comment-content">
<p>Even Pypy is not exactly &ldquo;high performance&rdquo;.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-266305" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a951ab8567d1603a1d8087f2bf5347b7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a951ab8567d1603a1d8087f2bf5347b7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">GaryNemming</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-16T21:51:02+00:00">January 16, 2017 at 9:51 pm</time></a> </div>
<div class="comment-content">
<p>Ada with the Ravenscar profile would likely hit all your points with flying colors. Its syntax is quite simple to read, and GNAT is pretty much all you need.</p>
</div>
<ol class="children">
<li id="comment-294005" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/30e43af2639fd48e226761b7bc10a735?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/30e43af2639fd48e226761b7bc10a735?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Shiran Abbasi</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-25T14:35:04+00:00">December 25, 2017 at 2:35 pm</time></a> </div>
<div class="comment-content">
<p>yes you are right. Ada is amazingly fast and safe as well.</p>
</div>
</li>
</ol>
</li>
<li id="comment-266306" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5dec5ec3d8a7e5551ec0c39088e0313b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5dec5ec3d8a7e5551ec0c39088e0313b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">JSC</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-16T22:05:32+00:00">January 16, 2017 at 10:05 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t think you can ignore Rust in such a comparison. It was designed specifically to address many of your criteria. While it&rsquo;s certainly too early to tell if it can win the hearts of c/c++ programmers such as myself or if something better will come along first, it is gaining momentum in certain circles. Personally I still find the language overly difficult to work with, but really interesting system level projects such as <a href="https://github.com/jwilm/alacritty" rel="nofollow ugc">https://github.com/jwilm/alacritty</a> are starting to pop up which are quite intriguing.</p>
</div>
<ol class="children">
<li id="comment-266314" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e561b2537c68f592b9aacf22ed62b18c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e561b2537c68f592b9aacf22ed62b18c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Matthew</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-16T23:20:11+00:00">January 16, 2017 at 11:20 pm</time></a> </div>
<div class="comment-content">
<p>I definitely agree. After all, Mozilla is actively working on implementing parts of Firefox in Rust right now, along with a number of companies and organizations (albeit mostly smaller ones) who already have production software based on Rust.</p>
</div>
</li>
<li id="comment-266316" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-16T23:22:42+00:00">January 16, 2017 at 11:22 pm</time></a> </div>
<div class="comment-content">
<p>I have put a time stamp in the title of my post because I expect that my current opinion might change drastically in a year or so. Maybe Rust will grow. </p>
<p>I think that my rationale (&ldquo;coding is a social activity&rdquo;) makes a whole lot of sense. It is not simply how many people use the language, of course&#8230; but also, very much, how many people &ldquo;like me&rdquo; use the language.</p>
<p>I don&rsquo;t know how much trust you can put in those things, but <a href="http://www.tiobe.com/tiobe-index/" rel="nofollow">TIOBE puts Rust at position 41, below Haskell and Logo</a>. In contrast, Swift and Go are ranked at position 13 and 14. <a href="http://redmonk.com/sogrady/2016/07/20/language-rankings-6-16/" rel="nofollow">Redmonk has roughly the same ranking</a> with respect to these languages.</p>
</div>
</li>
</ol>
</li>
<li id="comment-266318" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3f0dca2a49b77013585c0fd9cffb267c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3f0dca2a49b77013585c0fd9cffb267c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://twitter.com/trylks" class="url" rel="ugc external nofollow">trylks</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-17T00:17:14+00:00">January 17, 2017 at 12:17 am</time></a> </div>
<div class="comment-content">
<p>A Lisp family language that &ldquo;transpiles&rdquo; to C would be optimal, if it did a good job. Chicken and Gambit are in that category, if I remember correctly, but they don&rsquo;t seem mature/polished/stable.</p>
<p>I would like to have a good language for efficiency, e.g. in a raspberry pi, but there&rsquo;s no perfect language, and if I have to concede on something, efficiency seems like a good candidate to give up on it. Expressiveness is much more important, and much more than that the libraries, frameworks, and tools available for the language.</p>
</div>
</li>
<li id="comment-266332" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/46f8d282d1f946c9ffe6fc1e71d93b43?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/46f8d282d1f946c9ffe6fc1e71d93b43?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Olaf</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-17T03:46:37+00:00">January 17, 2017 at 3:46 am</time></a> </div>
<div class="comment-content">
<p>Even if Java was already take out of the question, the Garbage Collector is configurable, so that one can avoid the FullGC and &lsquo;stopping the world&rsquo;.</p>
</div>
<ol class="children">
<li id="comment-266422" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-17T14:55:53+00:00">January 17, 2017 at 2:55 pm</time></a> </div>
<div class="comment-content">
<p><em>the Garbage Collector is configurable, so that one can avoid the FullGC and â€˜stopping the world&rsquo;</em></p>
<p>Not in any realistic sense. Sure, you can choose a different GC configuration, but all of them stop the world for significant lengths of time.</p>
</div>
<ol class="children">
<li id="comment-278913" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2572ac85624babce7c9ca4f42019e29c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2572ac85624babce7c9ca4f42019e29c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Steven Sagaert</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-29T11:15:35+00:00">April 29, 2017 at 11:15 am</time></a> </div>
<div class="comment-content">
<p>Not Azul Zing <a href="https://www.azul.com/products/zing/" rel="nofollow ugc">https://www.azul.com/products/zing/</a></p>
</div>
<ol class="children">
<li id="comment-279241" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-04T16:05:55+00:00">May 4, 2017 at 4:05 pm</time></a> </div>
<div class="comment-content">
<p>Is there any independent assessment of Azul Zing?</p>
</div>
<ol class="children">
<li id="comment-285018" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b58a419a4c7642cac436301ca2cb0e56?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b58a419a4c7642cac436301ca2cb0e56?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">helikal</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-26T21:03:15+00:00">August 26, 2017 at 9:03 pm</time></a> </div>
<div class="comment-content">
<p>Customers pay for Azul Zing. That&rsquo; s evidence.</p>
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
<li id="comment-266436" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c579d284617f7828c054c3a8f5b61938?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c579d284617f7828c054c3a8f5b61938?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">sean</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-17T16:33:57+00:00">January 17, 2017 at 4:33 pm</time></a> </div>
<div class="comment-content">
<p>One language that you should consider that is probably a very good fit for your specific requirements is Delphi. If you&rsquo;ve never tried it, try it. You&rsquo;ll be surprised to see how fast is is to code with, how fast the compiler is, how fast and efficient the code that is produced is, how good the memory manager is, how well multi-threading is supported, and how you can embed assembly inline in the few situations where you might want to use special cpu instructions.</p>
</div>
<ol class="children">
<li id="comment-266438" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c579d284617f7828c054c3a8f5b61938?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c579d284617f7828c054c3a8f5b61938?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">sean</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-17T16:48:57+00:00">January 17, 2017 at 4:48 pm</time></a> </div>
<div class="comment-content">
<p>Oh, and it&rsquo;s super easy to call C functions.</p>
</div>
</li>
<li id="comment-266453" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-17T18:56:48+00:00">January 17, 2017 at 6:56 pm</time></a> </div>
<div class="comment-content">
<p>After Basic, I learned Pascal (Turbo Pascal). When I moved to Windows, I started using Delphi in the 1990s.</p>
<p>I have nice memories of Pascal. Free Pascal is alive and well. Performance is still good. Pascal got many things right.</p>
<p>However, I think it is fair to say that Pascal is, at best, a niche language. And there is little chance that it will ever become popular again. I am not exactly sure why it faded.</p>
</div>
<ol class="children">
<li id="comment-266461" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c579d284617f7828c054c3a8f5b61938?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c579d284617f7828c054c3a8f5b61938?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">sean</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-17T20:31:03+00:00">January 17, 2017 at 8:31 pm</time></a> </div>
<div class="comment-content">
<p>Every language is niche. That&rsquo;s why we have so many of them and why they are so very different. Delphi is becoming popular again despite the fact that it is also expensive and not &ldquo;free&rdquo; like the &ldquo;popular&rdquo; languages. But, sometimes you get what you pay for. If it&rsquo;s been 20 years since you&rsquo;ve touched Delphi, I would suggest that you look into it again. If your not sure why it faded, I would offer a perspective: maybe it didn&rsquo;t fade away, rather, maybe programmers that once touched it faded away from it. Also curious to note, it&rsquo;s #11 in 2017 on the TIOBE list as shown in the link above by a previous comment. It&rsquo;s ranked higher than Swift and Go, so maybe it&rsquo;s not as faded as you might think. Every programmer I&rsquo;ve ever met (including myself) gets stuck in their ways. We choose a language or technique usually based on what we know and what we are comfortable with. We rarely take the time to investigate the possibility of using a different tool even if it might be a better tool for the job than the one we are familiar with. One final note: I do like your thought process on this blog post. It feels like it has an authentic tone of objectivity (which is very rare these days).</p>
</div>
<ol class="children">
<li id="comment-266473" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-17T23:58:51+00:00">January 17, 2017 at 11:58 pm</time></a> </div>
<div class="comment-content">
<p><em> Also curious to note, it&rsquo;s #11 in 2017 on the TIOBE list as shown in the link above by a previous comment. </em></p>
<p>That&rsquo;s an interesting observation. I had not realized that Delphi remained so popular throughout the years.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-344442" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1b4ed816a73416b9ca370b1528e985ea?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1b4ed816a73416b9ca370b1528e985ea?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Edwin Santos</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-25T17:02:21+00:00">August 25, 2018 at 5:02 pm</time></a> </div>
<div class="comment-content">
<p>Delphi is, by far, the best programming language and tool. Currently, Embarcadero just released Delphi Community and it compiles native to Android, Windows , iOS and also web with Intraweb. In case you you want open souce software you could try freepascal</p>
<p>The language syntax is more human, is consistent (passing variables is always the same behaviour as it copy data). Has ARC for memory management that gives you fast performance than stop the world garbage collection algorithms.</p>
<p>You have a experienced languange with high performance, fast and deterministic garbage collection, consistency, well known RAD tools that compiles to all platform.</p>
</div>
<ol class="children">
<li id="comment-407249" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c2968a9b0cfba5be82d66c0257885894?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c2968a9b0cfba5be82d66c0257885894?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Miguel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-17T17:05:14+00:00">May 17, 2019 at 5:05 pm</time></a> </div>
<div class="comment-content">
<p>Agree!!!</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-266454" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/946689e35037cd05bef463fe1f9b3aec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/946689e35037cd05bef463fe1f9b3aec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">anonymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-17T19:01:20+00:00">January 17, 2017 at 7:01 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;I am going to ignore&#8230;&rdquo;</p>
<p>Just thought that once you ignored all, you would be left with only one choice.</p>
</div>
</li>
<li id="comment-266468" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/20f57595c7d4893e8ab834e6f69fc449?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/20f57595c7d4893e8ab834e6f69fc449?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.scintilla.org" class="url" rel="ugc external nofollow">Neil Hodgson</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-17T22:05:15+00:00">January 17, 2017 at 10:05 pm</time></a> </div>
<div class="comment-content">
<p>Swift does have some access to SIMD as discussed here: <a href="http://www.russbishop.net/swift-2-simd" rel="nofollow ugc">http://www.russbishop.net/swift-2-simd</a></p>
</div>
<ol class="children">
<li id="comment-266474" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-18T00:07:49+00:00">January 18, 2017 at 12:07 am</time></a> </div>
<div class="comment-content">
<p>@Neil</p>
<p>Swift does have a simd package, but it is macOS only for now. It is not a critical issue because Swift can call C without overhead, so you can design your own SIMD functions if you want.</p>
</div>
</li>
</ol>
</li>
<li id="comment-266483" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/37b967a090e923bea78d7928152fa846?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/37b967a090e923bea78d7928152fa846?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Matthew Fernandez</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-18T02:11:31+00:00">January 18, 2017 at 2:11 am</time></a> </div>
<div class="comment-content">
<p>Interesting post. A couple of nitpicks:</p>
<p>You say that you narrow it down to a list including Rust, but then later you say you&rsquo;re ignoring Rust, but then within the same paragraph imply that you&rsquo;re talking about two languages instead of three. I&rsquo;m not sure if I&rsquo;m misreading or there&rsquo;s a typo somewhere there, but it seems slightly off. Either way, I got the impression you wrote off Rust, which I personally would not have.</p>
<p>&gt; &#8230; and Python appear unable to support natively multithreaded execution</p>
<p>I&rsquo;m not sure exactly what you mean by &ldquo;natively multithreaded,&rdquo; but Python&rsquo;s multiprocessing module *does* let you use multiple cores if that&rsquo;s where you were going with this statement. Having said that, I agree with you that Python is unsuitable for systems programming.</p>
<p>Overall, nice article though 🙂</p>
</div>
<ol class="children">
<li id="comment-266486" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-18T03:08:42+00:00">January 18, 2017 at 3:08 am</time></a> </div>
<div class="comment-content">
<p><em>You say that you narrow it down to a list including Rust, but then later you say you&rsquo;re ignoring Rust (&#8230;) </em></p>
<p>I first narrow it down to system programming languages, and I include Rust in this list&#8230; but then I remove Rust because I fear it is not yet popular enough. I had a misleading &ldquo;both&rdquo; that I removed. As I have written elsewhere in the comments, this may change if Rust becomes a lot more popular. I don&rsquo;t think &ldquo;I wrote off Rust&rdquo;. I specifically mention it has a valid system language. But look&#8230; one has to be realistic&#8230; Rust is below Haskell, Scheme, Lisp, Logo in the TIOBE ranking. We hear that Mozilla (the organization that promotes Rust) might use Rust for some things. It is not a great validation. Swift has the whole might of Apple behind it. Go has&#8230; well, Google&#8230; Docker, Netflix, Dropbox&#8230; </p>
<p>For all I know, Rust is the future&#8230; but I&rsquo;d like to have hard data to back this up.</p>
<p><em>I&rsquo;m not sure exactly what you mean by â€œnatively multithreaded,â€ but Python&rsquo;s multiprocessing module *does* let you use multiple cores if that&rsquo;s where you were going with this statement.</em></p>
<p>I distinguish &ldquo;process-based parallelism&rdquo; and &ldquo;multithread execution&rdquo;.</p>
</div>
</li>
</ol>
</li>
<li id="comment-266847" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eccbfb99f2a3da9810b0b2cb23400ac4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eccbfb99f2a3da9810b0b2cb23400ac4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://plus.google.com/+RalphCorderoy" class="url" rel="ugc external nofollow">Ralph Corderoy</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-19T20:21:04+00:00">January 19, 2017 at 8:21 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel, I don&rsquo;t know how up to date are you with Go&rsquo;s garbage collector.â€‚It runs concurrently with the program most of the time, had two short phases that were &ldquo;stop the world&rdquo;, and recently managed to remove one of them. <a href="https://github.com/golang/proposal/blob/master/design/17503-eliminate-rescan.md" rel="nofollow ugc">https://github.com/golang/proposal/blob/master/design/17503-eliminate-rescan.md</a></p>
</div>
</li>
<li id="comment-266850" class="comment byuser comment-author-lemire bypostauthor even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-19T20:31:54+00:00">January 19, 2017 at 8:31 pm</time></a> </div>
<div class="comment-content">
<p>From my post&#8230;</p>
<p><em>Go has generational garbage collection (like Java or C#) which means that â€œit stops the worldâ€ at some point to reclaim memory, but the Go engineers have optimized for short pauses. That&rsquo;s a good thing too because â€œstopping the worldâ€ is not desirable.</em></p>
</div>
<ol class="children">
<li id="comment-267511" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eccbfb99f2a3da9810b0b2cb23400ac4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eccbfb99f2a3da9810b0b2cb23400ac4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://plus.google.com/+RalphCorderoy" class="url" rel="ugc external nofollow">Ralph Corderoy</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-23T10:24:57+00:00">January 23, 2017 at 10:24 am</time></a> </div>
<div class="comment-content">
<p>Yes, I did read the fine article before commenting, I just thought you might be interested in the recent improvement regarding StW since that description could describe a year ago.â€‚:-)</p>
</div>
</li>
</ol>
</li>
<li id="comment-267422" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/84a106ec8100e1edf7d2cc2b5341b6fb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/84a106ec8100e1edf7d2cc2b5341b6fb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://trevorjim.com" class="url" rel="ugc external nofollow">Trevor Jim</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-23T03:47:37+00:00">January 23, 2017 at 3:47 am</time></a> </div>
<div class="comment-content">
<p>Your headline is misleading because high performance is far from the only criterion you are using, otherwise assembly language would be at the top of your list.</p>
<p>As long as you are using other criteria, you might consider that C and C++ are security nightmares, safe languages are much easier to program, and consequently, less and less programming is being done in C and C++.</p>
<p>Perhaps the future of C and C++ is like assembly today, where the great majority of programs are written in other languages that might call into a small assembly language stub when it really makes sense.</p>
<p>More here: <a href="http://trevorjim.com/c-and-c++-are-dead-like-cobol-in-2017/" rel="nofollow ugc">http://trevorjim.com/c-and-c++-are-dead-like-cobol-in-2017/</a></p>
</div>
<ol class="children">
<li id="comment-267562" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-23T14:40:27+00:00">January 23, 2017 at 2:40 pm</time></a> </div>
<div class="comment-content">
<p><em>Your headline is misleading because high performance is far from the only criterion you are using, otherwise assembly language would be at the top of your list.</em></p>
<p>In the real world, you want to produce the best/fastest software possible given a time budget.</p>
<p>Even so, I would not be able to consistently or even generally beat a C compiler on performance in assembly. I need tools to get the job done and programming languages and compilers are a must.</p>
<p>At a higher level, if you don&rsquo;t put enough effort into it, it is far from certain that your Java program will run slower than your Java program. And there are many cases where you just don&rsquo;t have that much time. If I had to write very quickly some high-performance backend, I am not sure that C/C++ would win out.</p>
<p><em>As long as you are using other criteria, you might consider that C and C++ are security nightmares, safe languages are much easier to program, and consequently, less and less programming is being done in C and C++.</em></p>
<p>I relative terms, there is no denying that C and C++ are less popular than ever&#8230; but I am not sure what the picture is in absolute terms. I submit to you that there are probably more C++ programmers in 2017 than ever in history.</p>
<p><em>Perhaps the future of C and C++ is like assembly today, where the great majority of programs are written in other languages that might call into a small assembly language stub when it really makes sense.</em></p>
<p>Yes. This makes sense to me.</p>
</div>
</li>
<li id="comment-268979" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e1305fee562b70958e65b557ce049e31?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e1305fee562b70958e65b557ce049e31?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nir</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-30T04:34:36+00:00">January 30, 2017 at 4:34 am</time></a> </div>
<div class="comment-content">
<p>I think it&rsquo;s bizarre that you miss such a major topic as compile time dispatch. In C you are frequently stuck using function pointers which can&rsquo;t get inlined. Or passing an array with fixed compile time size as a pointer + size into a function. This can easily lead to introducing indirection where it&rsquo;s not necessary. This is very avoidable in C++ and D, mostly so in Rust (and afaik Swift), and very hard to avoid in Go and C.</p>
<p>I also wouldn&rsquo;t put safety at C++ as &ldquo;minimal&rdquo;, on par with C. While you can shoot yourself in the foot in either, RAII and the standard library definitely encourage you to write modern C++ quite safely.</p>
</div>
<ol class="children">
<li id="comment-274106" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1d543fa8c242f3dd7a940af720935434?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1d543fa8c242f3dd7a940af720935434?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christophe</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-05T19:01:04+00:00">March 5, 2017 at 7:01 pm</time></a> </div>
<div class="comment-content">
<p>I agree. And with modern C++ you can use smart pointers to eliminate risk of memory leaking. Standard containers almost eliminate the need for manual memory allocation.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-273970" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c7d57ec92d67621287dcae824a3b96bb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c7d57ec92d67621287dcae824a3b96bb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kevin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-04T22:11:24+00:00">March 4, 2017 at 10:11 pm</time></a> </div>
<div class="comment-content">
<p>Another point you neglected: Swift&rsquo;s support for Windows is inexistant. To my eyes, that disqualifies it immediately.</p>
</div>
<ol class="children">
<li id="comment-274203" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-06T14:54:46+00:00">March 6, 2017 at 2:54 pm</time></a> </div>
<div class="comment-content">
<p>@Kevin Generally, Swift supports few platforms at this point. It reflects the lack of maturity inherent to the language at this point. </p>
<p>I expect full Windows support in a couple of years.</p>
</div>
<ol class="children">
<li id="comment-279929" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/321c907b646a328001f0a489d7aaaded?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/321c907b646a328001f0a489d7aaaded?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Benny</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-17T12:57:51+00:00">May 17, 2017 at 12:57 pm</time></a> </div>
<div class="comment-content">
<p>Version 4 looks like it will have Windows support. From reading the Swift Git commits anyway. People already have working versions, so &#8230;</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-279930" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/321c907b646a328001f0a489d7aaaded?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/321c907b646a328001f0a489d7aaaded?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Benny</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-17T13:05:21+00:00">May 17, 2017 at 1:05 pm</time></a> </div>
<div class="comment-content">
<p>Regarding your point about Swift and non ARC/GC free memory management.</p>
<p><a href="https://github.com/apple/swift/blob/master/docs/OwnershipManifesto.md" rel="nofollow ugc">https://github.com/apple/swift/blob/master/docs/OwnershipManifesto.md</a></p>
<p>Swift 4 is on track to have manual, none ARC managed memory.</p>
</div>
</li>
<li id="comment-283373" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c33572c36e973202ab1f0ce38fc7d3d6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c33572c36e973202ab1f0ce38fc7d3d6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Gabriel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-16T04:07:17+00:00">July 16, 2017 at 4:07 am</time></a> </div>
<div class="comment-content">
<p>If you consider Rust, how would be the table shown at the bottom of your analysis?</p>
<p>Just curious.</p>
</div>
<ol class="children">
<li id="comment-283450" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-17T20:28:48+00:00">July 17, 2017 at 8:28 pm</time></a> </div>
<div class="comment-content">
<p>As I explain in the post, I set Rust aside for the time being because I do not judge the uptake to be sufficient.</p>
<p>This being said, here is my poorly informed opinion about Rust:</p>
<ul>
<li> Rust allows you to call C with minimal performance overhead, though not as easily as C++, say.</li>
<li> Rust has &ldquo;bare metal memory management&rdquo; unlike Go. In fact, memory management is a strong point of the language, obviously.</li>
<li> Regarding parallelism, I am worried about how this interacts with the ownership model, but I nevertheless expect Rust to have top notch parallelization.</li>
<li> From my point of view, Rust has a terribly complicated syntax that reminds me of C++.</li>
<li> Rust is obviously quite safe.</li>
<li> I am not sure how well Rust supports SIMD instructions.</li>
<li> Rust looks like it has top notch tools.</li>
</ul>
<p>There are few things that make me think Rust will have trouble gaining a wide audience:</p>
<ul>
<li> It has a complicated syntax that is far from C/C++/Java.<br/>
I know that I am repeating myself, but this issue should not be understated. Rust relies on a lot of explicit annotation. To be fair, C++ has a terrible syntax, so the path from C++ to Rust can be seen as a step forward&#8230; but it all comes down to perceived productivity. Is Rust readable to Rust programmers? I think C++ is not readable even to C++ programmers. </li>
<li> It is backed by Mozilla, not exactly the strongest organization around in 2017. Go has Google. Swift has Apple and IBM. Historically, programming languages often managed to thrive without a strong corporate backer, but programmers often need an incentive to learn a programming language and entities able to create good jobs matter.</li>
<li> There seems to be a general lack of stability as in &ldquo;I would not bet my company on this language&rdquo;. Specifically, I have routinely been unable to build Rust projects. I am sure that people will complain that I am being unfair, maybe so&#8230; but that is my impression at this point. For example, I go to the documentation under SIMD and I see &ldquo;unstable&rdquo;. This does not fill me with confidence. Do I program against this API or not?</li>
</ul>
</div>
</li>
</ol>
</li>
<li id="comment-283467" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5eab86c1a81bd23b6275504dc7510c5c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5eab86c1a81bd23b6275504dc7510c5c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://wireless-head.net" class="url" rel="ugc external nofollow">Gary</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-18T09:37:21+00:00">July 18, 2017 at 9:37 am</time></a> </div>
<div class="comment-content">
<p>Thanks for this excellent read.<br/>
I have not been programming for a living some years, but I always enjoyed it and am about to embark on some coding projects again.<br/>
So it was good to see a current analysis from the perspective of active and informed programmers.</p>
</div>
</li>
<li id="comment-283545" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/29f902b2d87f7effa0f3e0691113b760?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/29f902b2d87f7effa0f3e0691113b760?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Steve</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-21T08:37:45+00:00">July 21, 2017 at 8:37 am</time></a> </div>
<div class="comment-content">
<p>Hello.<br/>
If you consider concurrent, safe, and bare metal programming languages, how about Ada2012. The language inspired Rust to some extend and it is mature to run on mission critical systems like Helicopters, Sattelites,&#8230; Even NXP used it for their board printing machines for motor control. It is suitable for true Real Time systems.<br/>
Just to give you an incitement.</p>
</div>
<ol class="children">
<li id="comment-283552" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-21T12:34:41+00:00">July 21, 2017 at 12:34 pm</time></a> </div>
<div class="comment-content">
<p>See this paragraph which applies to Ada:</p>
<blockquote><p>I am going to ignore Rust, D and Nim as they have too few users. Programming is a social activity: if nobody can use your code, it does not matter that it runs fast. I think that they are very interesting languages but until many more people start coding in these languages, I am going to ignore them. Fortran is out for similar reasons: it still has important users, but they are specialized.</p></blockquote>
</div>
<ol class="children">
<li id="comment-284014" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c995b3c52f83e55a0b3b5e33fad1f2f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c995b3c52f83e55a0b3b5e33fad1f2f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">RD</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-08T20:43:21+00:00">August 8, 2017 at 8:43 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;until many more people start coding in these languages, I am going to ignore them&rdquo;</p>
<p>Instead of being ignorant, please take a very good look at ADA 2012. You talk about &ldquo;high-performance programming&rdquo;, but you are very vague about the specific requirements and your analysis table is rather primitive. Performance is not everything, quite often scalability, reliability and maintainability are much more important.</p>
</div>
<ol class="children">
<li id="comment-284015" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-08T20:49:21+00:00">August 8, 2017 at 8:49 pm</time></a> </div>
<div class="comment-content">
<p><em>Instead of being ignorant, (&#8230;)</em></p>
<p>In 2017, programming is a social activity. That&rsquo;s why we all learn English. Not because English is intrinsically superior, but because many people use English.</p>
</div>
<ol class="children">
<li id="comment-294494" class="comment odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/29f902b2d87f7effa0f3e0691113b760?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/29f902b2d87f7effa0f3e0691113b760?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Steve</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-04T21:01:45+00:00">January 4, 2018 at 9:01 pm</time></a> </div>
<div class="comment-content">
<p>Hello,<br/>
as long as we are no social streetworkers only and we like (at least I do) to code things that WORK in the end, the language matters, no matter how &ldquo;unpopular&rdquo; it might be. C is fast, bare metal and has a high library variety. But here it ends already. The big joke is, that most of the systems are programmed in a language that is least reliable and totally error prone. You will not see this language very often in mission critical systems, you have to rely on. Automative still uses C and we all know the headaches (I guess Audi calls back again, not for the lying part of diesel consumption, because a bug is in the control software). The avionics requirement DO178B has strict usage rules for C (even C++ is mentioned nowhere), like MISRA. But countless code lines, one hour or one coffee too much and a programmer misses the curly braces around an if()-statement&#8230; On a train-track control system. NO GOOD. Klocwork tells, that there is a possible NULL pointer dereference, but missed braces around an if? Naaa. and According to the vague requirements you made, no one exactly knows your criteria. English might be used by most people. Use English when talking to other developers, yes. But there are also around 70 Million people (at least) that talk German. That is a huge user group, don&rsquo;t you think? Ada for instance is used by more people than Rust. So where is your &ldquo;critical mass&rdquo; of users? You use the tool which is best for the job to be done. When you want to crank out all of the speed possible out of a device driver and want a bit more flexibility than Assembler -&gt; please use C! But test the hell out of it, if someone&rsquo;s life depends on it. and C++: What is a language of use that offers me 1000 ways to do things where you have 999 of them being pure crap? And you cannot even detect this. When you want a reliable and fast system with more than 500000 lines of code, that is of advantage programming multithreaded, and you are willing to sacrifice 10% speed penalty due to runtime checks compared to C, and need an average size user group use Ada. Make the code generation automation easy or write down a test frame for your fast code system in a day? Use Python.</p>
</div>
<ol class="children">
<li id="comment-294498" class="comment byuser comment-author-lemire bypostauthor even depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-04T22:27:11+00:00">January 4, 2018 at 10:27 pm</time></a> </div>
<div class="comment-content">
<p><em>as long as we are no social streetworkers only and we like (at least I do) to code things that WORK in the end, the language matters, no matter how â€œunpopularâ€ it might be.</em></p>
<p>If it works, but you alone can review and maintain it, you have a problem. If you can&rsquo;t use tools developed by other people because they don&rsquo;t care for your language, you have a problem.</p>
<p><em> English might be used by most people. Use English when talking to other developers, yes. But there are also around 70 Million people (at least) that talk German. </em></p>
<p>Using German is fine.</p>
<p><em>The big joke is, that most of the systems are programmed in a language that is least reliable and totally error prone. </em></p>
<p>And yet, here we stand. The software industry dominates the world. So we must be doing something right. Note that most software is not written in C. I bet that PHP and JavaScript are more popular.</p>
<p><em>You will not see this language very often in mission critical systems, you have to rely on.</em></p>
<p>I am pretty sure that C is being used for critical systems.</p>
<p><em> Ada for instance is used by more people than Rust. So where is your â€œcritical massâ€ of users? You use the tool which is best for the job to be done.</em></p>
<p>And how many people know and use the tool in question matters.</p>
<p><em> Use Python.</em></p>
<p>I love Python.</p>
</div>
<ol class="children">
<li id="comment-294653" class="comment odd alt depth-7">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/caaa17215cbb0bf0954aad185cd5902d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/caaa17215cbb0bf0954aad185cd5902d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Efried</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-08T16:15:30+00:00">January 8, 2018 at 4:15 pm</time></a> </div>
<div class="comment-content">
<p>Python is somewhat fragile when it comes to using includes on different target platforms.<br/>
I&rsquo;m curious about multiprocessing performance for Monte Carlo Analyse for each of the hardware systems on the market.</p>
</div>
</li>
<li id="comment-302475" class="comment even depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/59e36376a35b6794f16e1c78bdc1428a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/59e36376a35b6794f16e1c78bdc1428a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Rajarshi Muhuri</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-03T11:16:00+00:00">May 3, 2018 at 11:16 am</time></a> </div>
<div class="comment-content">
<p>Loved this article . In one of my earlier profession as a nuclear engineer , We used FORTRAN , supposedly that was the fastest for mathematical functions . and the language was also simple . But ofcourse as you mentioned , its use case is completely different from system programming languages .</p>
<p>I like C for its simplicity and power . ( Not that I used it professionally ) and same for for python .</p>
<p>I wish that they had created python with the under pining of C</p>
<p>or maybe a flag for turn off and on<br/>
1) memory management<br/>
2) pre compiled vs interpreted</p>
</div>
<ol class="children">
<li id="comment-393534" class="comment odd alt depth-8 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/357a20e8c56e69d6f9734d23ef9517e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/357a20e8c56e69d6f9734d23ef9517e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Arish Makito</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-08T17:45:02+00:00">March 8, 2019 at 5:45 pm</time></a> </div>
<div class="comment-content">
<p>Every major energy suppliers management systems are based on FORTRAN. Hands down, today, FORTRAN compiles faster code on any platforms than C does. AI is undoubtedly relies on mathematical functions, heavily. Not surprising Nvidia supports FORTRAN, search cuda-fortran, so not a marginalized language at all. Also Pypy in many high performance needs is faster than C. Benchmark them before you judge. As per German, more Europeans speak German than English or French 😉 , not me unfortunately.</p>
</div>
<ol class="children">
<li id="comment-393541" class="comment byuser comment-author-lemire bypostauthor even depth-9">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-08T18:55:05+00:00">March 8, 2019 at 6:55 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>Every major energy suppliers management systems are based on FORTRAN.</p>
</blockquote>
<p>That&rsquo;s a good argument for learning the language if you want to work on these legacy systems.</p>
<blockquote>
<p>Hands down, today, FORTRAN compiles faster code on any platforms than C does.</p>
</blockquote>
<p>Outside of Fortran&rsquo;s main applications (i.e., numerical analysis), <a href="https://benchmarksgame-team.pages.debian.net/benchmarksgame/faster/fortran.html" rel="nofollow">I doubt this statement</a>.</p>
<blockquote>
<p>AI is undoubtedly relies on mathematical functions, heavily. Not surprising Nvidia supports FORTRAN, search cuda-fortran, so not a marginalized language at all.</p>
</blockquote>
<p>For the record, here is what I wrote about Fortran: &ldquo;Fortran is out for similar reasons: it still has important users, but they are specialized.&rdquo;</p>
<blockquote>
<p>Also Pypy in many high performance needs is faster than C. Benchmark them before you judge.</p>
</blockquote>
<p>If you want to make such extraordinary claims, you need to provide the evidence.</p>
<p><em>As per German, more Europeans speak German than English or French ðŸ˜‰ , not me unfortunately.</em></p>
<p>I did not object to using German anywhere on this page.</p>
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
</ol>
</li>
</ol>
</li>
<li id="comment-292591" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9129755eff9b3fc512116e46e058e5bf?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9129755eff9b3fc512116e46e058e5bf?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mohammed Elshambakey</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-02T21:21:53+00:00">December 2, 2017 at 9:21 pm</time></a> </div>
<div class="comment-content">
<p>Hi</p>
<p>Can Julia (<a href="https://julialang.org/" rel="nofollow ugc">https://julialang.org/</a>) be considered a comparable choice?</p>
</div>
</li>
<li id="comment-293188" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f879926a58cc0b5b239f64f58d630e89?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f879926a58cc0b5b239f64f58d630e89?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">TAH2</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-10T19:35:40+00:00">December 10, 2017 at 7:35 pm</time></a> </div>
<div class="comment-content">
<p>I think you have a few errors in your Swift assessment. While Swift has been moving very fast, with major releases every year&#8230; Many of your points were true at Ver. 1.</p>
<p>1) Swift has ALWAYs had low level memory access, pointers, and byte level memory tweaking. Anything doable in C and C++ on bare-metal is doable in native swift. </p>
<p>Swift adds some nice features too that aren&rsquo;t available in C/C++. Pointers can understand and introspect their pointees. I can walk around a pointer in memory, then ask the pointer, what kind of memory is this, and then return it in that type, or or increment the pointer by the length of the pointee. Neat (and safe) stuff.</p>
<p>2) Core isn&rsquo;t maybe, but yes++. GCD/Libdispatch has been available on other platforms since the open sourcing of Swift. We use it on Linux. It is several levels of sophistication, safety management, flow control, and small task issuance over and above threads.</p>
<p>3) Simple syntax. There is no doubt that Go&rsquo;s goal is syntactic simplicity. Swift&rsquo;s goal is to be a powerful all-in-one multi-paradigm toolbox. But Swift isn&rsquo;t C++ either. It was built around the idea of Progressive Disclosure. You can start writing swift with 1 line in a RPEL: print(&ldquo;Hello&rdquo;)&#8230; done. Simple as python. complexity builds with expertise.</p>
</div>
</li>
<li id="comment-303014" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/aef1230f84f5b83aa07b73178c991e79?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/aef1230f84f5b83aa07b73178c991e79?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">James</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-09T21:00:04+00:00">May 9, 2018 at 9:00 pm</time></a> </div>
<div class="comment-content">
<p>There&rsquo;s a typo in this sentence: &ldquo;I think there will be no disagreement that C and C++ and system programming languages&rdquo;</p>
<p>Do you mean &ldquo;I think there will be no disagreement that C and C++ <strong><em>are</em></strong> system programming languages&rdquo;?</p>
</div>
<ol class="children">
<li id="comment-303024" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-09T21:36:48+00:00">May 9, 2018 at 9:36 pm</time></a> </div>
<div class="comment-content">
<p>Indeed.</p>
</div>
</li>
</ol>
</li>
<li id="comment-335280" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3ffc2f3573a495c6913677905014a733?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3ffc2f3573a495c6913677905014a733?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jimmy Merrild Krag</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-09T10:09:04+00:00">August 9, 2018 at 10:09 am</time></a> </div>
<div class="comment-content">
<p>Have you heard of Vala?<br/>
It compiles to C and uses reference counting.</p>
</div>
</li>
<li id="comment-337927" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d6550112f6a27da8c4596d6a2e63bc6c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d6550112f6a27da8c4596d6a2e63bc6c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">juan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-13T00:01:07+00:00">August 13, 2018 at 12:01 am</time></a> </div>
<div class="comment-content">
<p>You missed Julia and Chapel</p>
</div>
</li>
<li id="comment-354210" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3327b09b2b925a95efac2a3b61508a58?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3327b09b2b925a95efac2a3b61508a58?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Abi</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-04T14:27:30+00:00">October 4, 2018 at 2:27 pm</time></a> </div>
<div class="comment-content">
<p>It was unfair that you removed Rust from the list, and put Swift (Apple) and Go (Google) inside. As I understand if you added Rust to the list you should remove them almost in each sections. Sorry to mention but it is too much commercial oriented article.<br/>
And also for high-performance things we used cython that you can call it pythonic-C and you can do whatever you like with real high-performance and embed it inside Python. I understand that python class is different but removing Rust in favor of that mostly Go it is just fun, there is an OS written in Rust man :/</p>
</div>
<ol class="children">
<li id="comment-354231" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-04T15:55:39+00:00">October 4, 2018 at 3:55 pm</time></a> </div>
<div class="comment-content">
<p><em>Sorry to mention but it is too much commercial oriented article.</em></p>
<p>I want to build software that businesses will use. If that is what you mean by &ldquo;too much commercial oriented&rdquo;, then I am guilty of that.</p>
<p><em>And also for high-performance things we used cython that you can call it pythonic-C and you can do whatever you like with real high-performance and embed it inside Python.</em></p>
<p>That is true, but in these instances Python is using C as the high-performance language.</p>
<p><em>I understand that python class is different but removing Rust in favor of that mostly Go it is just fun, there is an OS written in Rust man :/</em></p>
<p>At least in January 2017, I felt that Rust was too much of a niche language. Things have changed since then and I consider Rust as a more serious contender now.</p>
</div>
</li>
</ol>
</li>
<li id="comment-355174" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c177ab66c270248617a7ea4ff63fec36?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c177ab66c270248617a7ea4ff63fec36?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cristian Vasile</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-08T17:34:26+00:00">October 8, 2018 at 5:34 pm</time></a> </div>
<div class="comment-content">
<p>Hello Daniel,</p>
<p>Just a few pointers to interesting resources:<br/>
&#8211; GraalVM (<a href="http://www.graalvm.org/" rel="nofollow ugc">http://www.graalvm.org/</a>) backed by Oracle. You could write code in n languages and run it on the new SubstrateVM. Or you could compile Java code to binary, high speed &amp; low memory executable format.<br/>
On this front please read this blog article: 10 Things To Do With GraalVM (<a href="https://chrisseaton.com/truffleruby/tenthings/" rel="nofollow ugc">https://chrisseaton.com/truffleruby/tenthings/</a>)</p>
<p>FN project(<a href="https://fnproject.io/" rel="nofollow ugc">https://fnproject.io/</a>), also backed by Oracle; write a function in Java/GO/Python/Scala/JS/Ruby and then pack it in a tiny container.<br/>
PARLANSE language by Semantic Design (<a href="http://www.semdesigns.com/Products/Parlanse/index.html?Home=Main" rel="nofollow ugc">http://www.semdesigns.com/Products/Parlanse/index.html?Home=Main</a>)<br/>
Chapel Parallel Programming Language (<a href="https://chapel-lang.org/" rel="nofollow ugc">https://chapel-lang.org/</a>) backed by Cray<br/>
my favorite under the radar language is pony (<a href="https://www.ponylang.io/" rel="nofollow ugc">https://www.ponylang.io/</a>)</p>
<p>Regards,<br/>
Cristian.</p>
</div>
</li>
<li id="comment-355252" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-08T22:49:39+00:00">October 8, 2018 at 10:49 pm</time></a> </div>
<div class="comment-content">
<p>Something is interesting about the GrallVM vs non-Grall benchmark there. Grall runs it in:</p>
<p><code>real 0m17.367s<br/>
user 0m32.355s<br/>
sys 0m1.456s<br/>
</code></p>
<p>While non-Grall takes:</p>
<p><code>real 0m23.511s<br/>
user 0m24.293s<br/>
sys 0m0.579s<br/>
</code></p>
<p>So yes, it&rsquo;s running in about 73% of the wall clock time as HotSpot (assuming the second run is HotSpot), but it takes about 36% more CPU! So you can&rsquo;t really argue that the GrallVM is more efficient in this benchmark, but rather that it finds some way to run on about 2 cores on average, while the other benchmark runs on only ~1, and this additional parallelism is able to overcome its CPU-time inefficiency.</p>
<p>There doesn&rsquo;t look like any inherent parallelism in the benchmark itself (unless Grall has some magic autopar going on), so maybe it&rsquo;s a different in garbage collection?</p>
</div>
</li>
<li id="comment-364194" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fdc895221675887b18d714bbcab4675f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fdc895221675887b18d714bbcab4675f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">bob</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-12T23:32:25+00:00">November 12, 2018 at 11:32 pm</time></a> </div>
<div class="comment-content">
<p>Dropbox is actually powered by Rust as well as NPM, and a whole lot more.</p>
</div>
</li>
</ol>
