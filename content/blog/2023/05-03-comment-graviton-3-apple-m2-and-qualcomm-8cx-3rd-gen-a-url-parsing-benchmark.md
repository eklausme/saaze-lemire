---
date: "2023-05-03 12:00:00"
title: "Graviton 3, Apple M2 and Qualcomm 8cx 3rd gen: a URL parsing benchmark"
index: false
---

[7 thoughts on &ldquo;Graviton 3, Apple M2 and Qualcomm 8cx 3rd gen: a URL parsing benchmark&rdquo;](/lemire/blog/2023/05-03-graviton-3-apple-m2-and-qualcomm-8cx-3rd-gen-a-url-parsing-benchmark)

<ol class="comment-list">
<li id="comment-651473" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b2a445f0595a024275d91690a682b1fc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b2a445f0595a024275d91690a682b1fc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">s w</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-03T21:37:44+00:00">May 3, 2023 at 9:37 pm</time></a> </div>
<div class="comment-content">
<p>asahi is fast 🙂</p>
<p>Run on (8 X 2424 MHz CPU s)<br/>
BasicBench_AdaURL_aggregator_href 15501605 ns 15478609 ns 45 speed=561.297M/s time/byte=1.78159ns time/url=154.747ns url/s=6.46214M/s</p>
<p>uname -a</p>
<p>Linux amac 6.2.0-asahi-11-1-edge-ARCH #2 SMP PREEMPT_DYNAMIC Sun, 19 Mar 2023 10:26:57 +0000 aarch64 GNU/Linux</p>
<p>sudo dmesg | grep Machine<br/>
[ 0.000000] Machine model: Apple MacBook Air (13-inch, M2, 2022)</p>
</div>
<ol class="children">
<li id="comment-651485" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-04T02:08:38+00:00">May 4, 2023 at 2:08 am</time></a> </div>
<div class="comment-content">
<p><a href="https://arstechnica.com/gadgets/2022/03/asahi-linux-is-already-running-on-the-mac-studios-new-m1-ultra-chip/" rel="nofollow ugc">https://arstechnica.com/gadgets/2022/03/asahi-linux-is-already-running-on-the-mac-studios-new-m1-ultra-chip/</a></p>
<p>?</p>
</div>
</li>
</ol>
</li>
<li id="comment-651486" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e09f5c36d14aec03632ba1666c7ff179?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e09f5c36d14aec03632ba1666c7ff179?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">hamed</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-04T04:26:15+00:00">May 4, 2023 at 4:26 am</time></a> </div>
<div class="comment-content">
<p>but why WSL? there is some performace penalty for WSL</p>
</div>
<ol class="children">
<li id="comment-651496" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-04T13:56:48+00:00">May 4, 2023 at 1:56 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>but why WSL? there is some performace penalty for WSL</p>
</blockquote>
<p>This benchmark is purely computational, there is no disk and IO access, so I do not expect any penalty from WSL. This being said, given that nobody knows how to install Linux on the Windows Dev Kit, the point is somewhat moot regarding Linux.</p>
<p>Admittedly, I could have installed FreeBSD on it, but that&rsquo;s a fair amount of effort.</p>
<p>As for running the benchmarks under Windows proper&#8230; Visual Studio is typically behind in terms of optimization and performance. Running benchmarks under WSL, with native GCC or CLANG, is <a href="https://lemire.me/blog/2023/03/03/float-parsing-benchmark-regular-visual-studio-clangcl-and-linux-gcc/" rel="ugc">often better than compiling binaries using Visual Studio</a>.</p>
<p>It is disappointing, but Microsoft has not kept up very well in terms of compiler technology.</p>
</div>
</li>
</ol>
</li>
<li id="comment-651492" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5289c9bbd80e627d5fc71496209f7a9c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5289c9bbd80e627d5fc71496209f7a9c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">obf</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-04T11:58:43+00:00">May 4, 2023 at 11:58 am</time></a> </div>
<div class="comment-content">
<p>AMD 7950x, clang 14 (targeting GCC 11.2&rsquo;s STL), linux:<br/>
BasicBench_AdaURL_aggregator_href 10916160 ns 10902775 ns 64 GHz=5.41849 cycle/byte=6.81415 cycles/url=591.872 instructions/byte=23.2465 instructions/cycle=3.4115 instructions/ns=18.4852 instructions/url=2.01917k ns/url=109.232 speed=796.87M/s time/byte=1.25491ns time/url=109ns url/s=9.17427M/s</p>
<p>Corrected for 3.0 GHz:<br/>
* using the reported frequency of 5.4 &#8211; it is 196 ns/url, which is still faster. 🙂<br/>
* using the max boost of 5.7 &#8211; it is 207 ns/url</p>
</div>
<ol class="children">
<li id="comment-651495" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-04T13:49:58+00:00">May 4, 2023 at 1:49 pm</time></a> </div>
<div class="comment-content">
<p>AMD Zen 4 looks very competitive.</p>
</div>
</li>
</ol>
</li>
<li id="comment-651501" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b7d8733dee56c2c4b014f198675e7edc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b7d8733dee56c2c4b014f198675e7edc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nonya</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-04T23:08:36+00:00">May 4, 2023 at 11:08 pm</time></a> </div>
<div class="comment-content">
<p>Intel and AMD embarrassed Apple&rsquo;s M2. 1280P and 5900HS are proven to be generally better. Apples silicone is generally inferior. But hey, that&rsquo;s just after a total of 190 benchmarks.</p>
</div>
</li>
</ol>
