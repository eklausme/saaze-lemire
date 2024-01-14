---
date: "2023-02-27 12:00:00"
title: "Regular Visual Studio versus ClangCL"
index: false
---

[21 thoughts on &ldquo;Regular Visual Studio versus ClangCL&rdquo;](/lemire/blog/2023/02-27-visual-studio-versus-clangcl)

<ol class="comment-list">
<li id="comment-649526" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7b6f84b044d71985a9f3812b66d226b2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7b6f84b044d71985a9f3812b66d226b2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">zahir</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-27T02:37:01+00:00">February 27, 2023 at 2:37 am</time></a> </div>
<div class="comment-content">
<p>Cloud servers may have ramdisk mounted for tmp.</p>
<p><a href="https://m.youtube.com/watch?v=t4M3yG1dWho" rel="nofollow ugc">https://m.youtube.com/watch?v=t4M3yG1dWho</a></p>
</div>
<ol class="children">
<li id="comment-649527" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-27T02:46:51+00:00">February 27, 2023 at 2:46 am</time></a> </div>
<div class="comment-content">
<p>Intriguing.</p>
</div>
</li>
</ol>
</li>
<li id="comment-649536" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6045c55ac4829c105fc4a9cbee52e59?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6045c55ac4829c105fc4a9cbee52e59?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Quan Anh Mai</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-27T07:26:05+00:00">February 27, 2023 at 7:26 am</time></a> </div>
<div class="comment-content">
<p>Did you build in WSL from its native file system or from the Windows one? WSL access to the Windows file system is notoriously slow, so it may be better to make a copy of the project in the WSL file system to measure the build speed. Thanks.</p>
</div>
<ol class="children">
<li id="comment-649544" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-27T13:47:47+00:00">February 27, 2023 at 1:47 pm</time></a> </div>
<div class="comment-content">
<p>I did not make a copy.</p>
</div>
<ol class="children">
<li id="comment-649546" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-27T13:59:15+00:00">February 27, 2023 at 1:59 pm</time></a> </div>
<div class="comment-content">
<p>Blog post updated.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-649540" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2e57709bdd575d555964aedca48b33f4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2e57709bdd575d555964aedca48b33f4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Charlie Tangora</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-27T13:08:38+00:00">February 27, 2023 at 1:08 pm</time></a> </div>
<div class="comment-content">
<p>Have you excluded your Windows source and build directories from antivirus scanning? In my experience that’s the most common reason for slow builds on Windows.</p>
</div>
<ol class="children">
<li id="comment-649547" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-27T14:10:46+00:00">February 27, 2023 at 2:10 pm</time></a> </div>
<div class="comment-content">
<p>I disabled Defender temporarily and it did not impact the speed, at least not in a noticeable manner for me.</p>
</div>
</li>
</ol>
</li>
<li id="comment-649542" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1f2c27156b0eefb3182783dcd72699f1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1f2c27156b0eefb3182783dcd72699f1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Joseph</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-27T13:42:43+00:00">February 27, 2023 at 1:42 pm</time></a> </div>
<div class="comment-content">
<p>Might be related: <a href="https://dev.blog.documentfoundation.org/2023/02/21/telemetry-required-ask-users-first/" rel="nofollow ugc">https://dev.blog.documentfoundation.org/2023/02/21/telemetry-required-ask-users-first/</a></p>
</div>
<ol class="children">
<li id="comment-649545" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-27T13:47:56+00:00">February 27, 2023 at 1:47 pm</time></a> </div>
<div class="comment-content">
<p>I am not getting build errors.</p>
</div>
<ol class="children">
<li id="comment-649561" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1f2c27156b0eefb3182783dcd72699f1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1f2c27156b0eefb3182783dcd72699f1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Joseph</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-28T12:26:36+00:00">February 28, 2023 at 12:26 pm</time></a> </div>
<div class="comment-content">
<p>Sure, but the point was that there&rsquo;s telemetry in the build process thst many don&rsquo;t expect, and that that might be related to slower builds.</p>
</div>
<ol class="children">
<li id="comment-649564" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-02-28T14:35:16+00:00">February 28, 2023 at 2:35 pm</time></a> </div>
<div class="comment-content">
<p>Could be.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-649571" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f239ba02f355de6af14cac9e3ac47fdb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f239ba02f355de6af14cac9e3ac47fdb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">maksqwe</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-01T11:31:09+00:00">March 1, 2023 at 11:31 am</time></a> </div>
<div class="comment-content">
<p>I think it worth to report such performance gap between clang-cl and native msvc cl for the release mode at least with minimal reproduce code.<br/>
<a href="https://developercommunity.visualstudio.com/cpp" rel="nofollow ugc">https://developercommunity.visualstudio.com/cpp</a></p>
</div>
<ol class="children">
<li id="comment-649574" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-01T15:28:14+00:00">March 1, 2023 at 3:28 pm</time></a> </div>
<div class="comment-content">
<p>I think I provide enough information for reproduction in my blog post. I already formally reported that Visual Studio has non-competitive performance with SIMD kernels like simdutf.</p>
</div>
</li>
</ol>
</li>
<li id="comment-649580" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/05cf4f26b6ecf3a8d3e1c6375819a418?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/05cf4f26b6ecf3a8d3e1c6375819a418?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Patrick Stewart</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-02T02:23:03+00:00">March 2, 2023 at 2:23 am</time></a> </div>
<div class="comment-content">
<p>If you&rsquo;re using a recentish version of LLVM and CMake on windows, you don&rsquo;t need to use the clang-cl driver at all. A trivial toolchain file for cmake like:</p>
<p><code>set(CMAKE_C_COMPILER clang)<br/>
set(CMAKE_CXX_COMPILER clang++)<br/>
set(CMAKE_RC_COMPILER llvm-rc)<br/>
</code></p>
<p>run in the VS development prompt will get it working with the normal clang frontend, so you can use the normal GCCish arguments.<br/>
If it&rsquo;s linking that&rsquo;s taking the time, adding the &ldquo;-fuse-ld=lld&rdquo; argument will speed it up a lot, as lld is much faster than link.exe.</p>
</div>
<ol class="children">
<li id="comment-649592" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-02T16:18:15+00:00">March 2, 2023 at 4:18 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s useful.</p>
<p>I tried the following&#8230;</p>
<p>cmake -D CMAKE_LINKER=&rdquo;ldd&rdquo; -D CMAKE_CXX_COMPILER=clang++ -D CMAKE_RC_COMPILER=llvm-rc -B buildfastclang3</p>
<p>A debug build then takes 2 minutes and slightly over 2 minutes for a release build.</p>
</div>
</li>
</ol>
</li>
<li id="comment-649581" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e7d7001fb9cbf35e2d0d304a20e30ac2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e7d7001fb9cbf35e2d0d304a20e30ac2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michael Walcott</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-02T03:59:32+00:00">March 2, 2023 at 3:59 am</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t know if it applies here but one thing I&rsquo;ve noticed in particular is that clang-cl tends to inline a lot more aggressively than MSVC.</p>
</div>
<ol class="children">
<li id="comment-649583" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2380196a5610be6ca44d33bda86492e7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2380196a5610be6ca44d33bda86492e7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Chris</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-02T07:50:17+00:00">March 2, 2023 at 7:50 am</time></a> </div>
<div class="comment-content">
<p>Note that with Visual Studio 2019+, you can use the /Ob3 flag for more aggressive inlining.<br/>
/Ob2 is the default when using /O2<br/>
I haven&rsquo;t tested if this actually makes a difference though.</p>
</div>
<ol class="children">
<li id="comment-649591" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-02T15:54:58+00:00">March 2, 2023 at 3:54 pm</time></a> </div>
<div class="comment-content">
<p>I have found that Ob3 did not make a difference in a project of mine: <a href="https://github.com/simdjson/simdjson/issues/847" rel="nofollow ugc">https://github.com/simdjson/simdjson/issues/847</a></p>
<p>Note that you can give compiler hints to Visual Studio, telling it to inline a function. I think it works.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-649596" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a0112f9429ee33ee213b7ca9bc2202ed?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a0112f9429ee33ee213b7ca9bc2202ed?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Orgad</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-02T20:47:07+00:00">March 2, 2023 at 8:47 pm</time></a> </div>
<div class="comment-content">
<p>The linker is lld, ldd prints dependencies for dynamic executables.</p>
</div>
<ol class="children">
<li id="comment-649598" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-02T22:39:28+00:00">March 2, 2023 at 10:39 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for catching the typographical error. I did use lld.</p>
</div>
</li>
</ol>
</li>
<li id="comment-653207" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9f226f651f6bc94d6aa7e515374ed43a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9f226f651f6bc94d6aa7e515374ed43a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Andreas</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-25T03:43:34+00:00">July 25, 2023 at 3:43 am</time></a> </div>
<div class="comment-content">
<p>Process creation on Windows is really expensive. It was bad enough for the chrome build that they finally changed the clang driver to call its internal drivers directly in-process instead of in a new process.</p>
<p>And file system operations are slow for many small files. Someone said that&rsquo;s only because of hooks like antivirus but it still feels like ntfs is slower in general then ext4.</p>
</div>
</li>
</ol>
