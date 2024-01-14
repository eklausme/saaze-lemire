---
date: "2023-01-05 12:00:00"
title: "Transcoding Unicode with AVX-512: AMD Zen 4 vs. Intel Ice Lake"
index: false
---

[12 thoughts on &ldquo;Transcoding Unicode with AVX-512: AMD Zen 4 vs. Intel Ice Lake&rdquo;](/lemire/blog/2023/01-05-transcoding-unicode-with-avx-512-amd-zen-4-vs-intel-ice-lake)

<ol class="comment-list">
<li id="comment-648771" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/31a1f7d227cb910a6fbc2784b374a2e7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/31a1f7d227cb910a6fbc2784b374a2e7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Alex</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-05T23:07:44+00:00">January 5, 2023 at 11:07 pm</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s worth noting that Zen 4 implements AVX-512 by splitting execution into two 256 bit stages, so instructions take twice more cycles (at least those that are 1-cycle on Intel, for complex instructions the difference is less than 2x, and in fact Zen 4 has powerful shuffling units, IIRC).</p>
</div>
<ol class="children">
<li id="comment-648776" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-06T04:18:50+00:00">January 6, 2023 at 4:18 am</time></a> </div>
<div class="comment-content">
<p>Evidently, this does not seem to affect the performance negatively in a significant manner, at least in these tests. Note that we make extensive use of AVX-512.</p>
</div>
</li>
<li id="comment-648788" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5a4cdc11a1fa1317c3b56610b258ff95?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5a4cdc11a1fa1317c3b56610b258ff95?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Goran Mitrovic</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-06T13:00:04+00:00">January 6, 2023 at 1:00 pm</time></a> </div>
<div class="comment-content">
<p>That is not true. It uses two 256-bit units (if available), but it takes only a single amount of cycles.</p>
</div>
</li>
</ol>
</li>
<li id="comment-648773" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9edec95805331d63cc244c95205412af?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9edec95805331d63cc244c95205412af?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">David</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-06T02:27:02+00:00">January 6, 2023 at 2:27 am</time></a> </div>
<div class="comment-content">
<p>Intel made their compilers available at no cost some time back. They can be found at <a href="https://www.intel.com/content/www/us/en/developer/articles/tool/oneapi-standalone-components.html" rel="nofollow ugc">https://www.intel.com/content/www/us/en/developer/articles/tool/oneapi-standalone-components.html</a> .</p>
</div>
<ol class="children">
<li id="comment-648775" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-06T04:17:54+00:00">January 6, 2023 at 4:17 am</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s interesting. I gave up on Intel compilers some time ago because it was tiring to manage the licensing. It seems like great news that they have simplified the process.</p>
</div>
<ol class="children">
<li id="comment-648791" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://validscience.substack.com/" class="url" rel="ugc external nofollow">Joe Duarte</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-06T17:25:27+00:00">January 6, 2023 at 5:25 pm</time></a> </div>
<div class="comment-content">
<p>Intel switched to LLVM two years ago for their main C/C++ compiler, but they still release and update their Compiler Classic, based on their own compiler internals: <a href="https://en.wikipedia.org/wiki/Intel_C%2B%2B_Compiler#Release_history" rel="nofollow ugc">https://en.wikipedia.org/wiki/Intel_C%2B%2B_Compiler#Release_history</a></p>
<p>They seem to support a lot more optimization and acceleration than competitors, though the branding for the features is hard to keep track of. They might be the only compiler to support the new matrix instructions (AMX), and have lots of support for OpenMP up through 5.x, and their libraries like Threaded Building Blocks and SYCL/OpenCL support.</p>
<p>But it&rsquo;s hard to keep track of their branding, products, and features. A lot of it is under &ldquo;OneAPI&rdquo; now. I think OneAPI is meant to include their compiler, but I&rsquo;m not sure.</p>
<p>Have you looked at the matrix instructions?</p>
</div>
<ol class="children">
<li id="comment-648906" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-12T15:21:24+00:00">January 12, 2023 at 3:21 pm</time></a> </div>
<div class="comment-content">
<p>I have not yet had access to a processor with AMX instructions.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-648783" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cd663067a9c9e9067d435c96c22d5f6f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cd663067a9c9e9067d435c96c22d5f6f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">SubOptimal</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-06T10:18:55+00:00">January 6, 2023 at 10:18 am</time></a> </div>
<div class="comment-content">
<p>Only a tiny adjustment to the instructions.</p>
<p># will download the file as d2cIxRx<br/>
wget <a href="https://cutt.ly/d2cIxRx" rel="nofollow ugc">https://cutt.ly/d2cIxRx</a></p>
<p># will download the file as Arabic-Lipsum.utf8.txt<br/>
wget &#8211;content-disposition <a href="https://cutt.ly/d2cIxRx" rel="nofollow ugc">https://cutt.ly/d2cIxRx</a></p>
<p></p>
</div>
<ol class="children">
<li id="comment-648789" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-06T13:00:07+00:00">January 6, 2023 at 1:00 pm</time></a> </div>
<div class="comment-content">
<p>Thanks!</p>
</div>
</li>
</ol>
</li>
<li id="comment-648941" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/07f2a57fc1bf6585bc68ec07d954e1d5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/07f2a57fc1bf6585bc68ec07d954e1d5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alex</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-14T21:42:30+00:00">January 14, 2023 at 9:42 pm</time></a> </div>
<div class="comment-content">
<p>Is there any reason for maintaining &ldquo;a database formatted with UTF-16&rdquo;? I had thought that the only use for UTF-16 in the modern age is for legacy operating system interfaces.</p>
</div>
<ol class="children">
<li id="comment-648942" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-14T22:19:43+00:00">January 14, 2023 at 10:19 pm</time></a> </div>
<div class="comment-content">
<p>Last I checked, SQL Server defaulted on UTF-16. It is possible to use UTF-8 with recent versions, but it wasn&rsquo;t the default when I last looked into it.</p>
</div>
</li>
</ol>
</li>
<li id="comment-649820" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ffb227869df0532cc8aa8da462f31faa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ffb227869df0532cc8aa8da462f31faa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anton Ertl</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-16T08:45:36+00:00">March 16, 2023 at 8:45 am</time></a> </div>
<div class="comment-content">
<p>Results from a Xeon W-1370P (Rocket Lake); I don&rsquo;t know which ones you used, so I provide all those that are UTF-8-&gt;UTF16 with icelake or iconv:</p>
<p><code>convert_utf8_to_utf16+icelake, input size: 81685, iterations: 3000, dataset: Arabic-Lipsum.utf8.txt<br/>
1.403 ins/byte, 0.440 cycle/byte, 11.871 GB/s (0.3 %), 5.224 GHz, 3.189 ins/cycle<br/>
2.505 ins/char, 0.785 cycle/char, 6.651 Gc/s (0.3 %) 1.78 byte/char<br/>
convert_utf8_to_utf16+iconv, input size: 81685, iterations: 3000, dataset: Arabic-Lipsum.utf8.txt<br/>
32.378 ins/byte, 5.294 cycle/byte, 0.983 GB/s (0.2 %), 5.202 GHz, 6.115 ins/cycle<br/>
57.791 ins/char, 9.450 cycle/char, 0.550 Gc/s (0.2 %) 1.78 byte/char<br/>
convert_utf8_to_utf16_with_dynamic_allocation+icelake, input size: 81685, iterations: 3000, dataset: Arabic-Lipsum.utf8.txt<br/>
1.660 ins/byte, 0.526 cycle/byte, 9.919 GB/s (0.6 %), 5.220 GHz, 3.155 ins/cycle<br/>
2.964 ins/char, 0.939 cycle/char, 5.557 Gc/s (0.6 %) 1.78 byte/char<br/>
convert_utf8_to_utf16_with_errors+icelake, input size: 81685, iterations: 3000, dataset: Arabic-Lipsum.utf8.txt<br/>
1.403 ins/byte, 0.435 cycle/byte, 12.009 GB/s (0.5 %), 5.225 GHz, 3.225 ins/cycle<br/>
2.505 ins/char, 0.777 cycle/char, 6.728 Gc/s (0.5 %) 1.78 byte/char<br/>
</code></p>
</div>
</li>
</ol>
