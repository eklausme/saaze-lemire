---
date: "2014-06-06 12:00:00"
title: "Software performance is&#8230; counterintuitive"
index: false
---

[8 thoughts on &ldquo;Software performance is&#8230; counterintuitive&rdquo;](/lemire/blog/2014/06-06-software-performance-is-counterintuitive)

<ol class="comment-list">
<li id="comment-128997" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" decoding="async" /> <b class="fn">Peter</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-06-06T09:58:22+00:00">June 6, 2014 at 9:58 am</time></a> </div>
<div class="comment-content">
<p>You are absolutely right. You can even say it on a more abstract level: The performance of a piece of code has not to be measured based on the FLOPS but on the amount of work it actually does.</p>
<p>Putting it this way, performance is not reduced to the somewhat blind view on the instruction level (blind as in &lsquo;It doesn&rsquo;t matter what the code does as long as it&rsquo;s doing it fast&rsquo;). Instead the algorithm itself is taken into consideration.</p>
</div>
</li>
<li id="comment-129005" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9d386c878599019da877e61fb9a9b15f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9d386c878599019da877e61fb9a9b15f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.bfilipek.com" class="url" rel="ugc external nofollow">fenbf</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-06-06T13:33:35+00:00">June 6, 2014 at 1:33 pm</time></a> </div>
<div class="comment-content">
<p>Nice explanation!<br/>
Such effects are especially visible when we look also on memory latency. Sometimes ALU instructions can &lsquo;hide&rsquo; because we are waiting for the memory.</p>
<p>AVX256 is for instance not twice as fast as SIMD128.</p>
</div>
</li>
<li id="comment-129007" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bc40eb0aff49fb0aeef0b781db35e29d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bc40eb0aff49fb0aeef0b781db35e29d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Kurz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-06-06T14:08:12+00:00">June 6, 2014 at 2:08 pm</time></a> </div>
<div class="comment-content">
<p>Your explanation actually understates the counterintuitive behaviour, since not only are you sneaking a &lsquo;popcount&rsquo; per iteration, you are also getting an extra &lsquo;add&rsquo; for free with no additional wall time.</p>
<p>A more charitable view of the academic approach would be that as the superscalar prowess of modern processors increases, the tradition of ignoring constants and assuming one O(n) algorithm is as good as a another is finally becoming true.</p>
<p>I tried your code on Haswell i7-4770 with three different compilers, all using &ldquo;-march=native -O3&rdquo;. The different levels of performance for such a simple loop are fairly large:</p>
<p>icc-14.0.3: 873 873<br/>
gcc-4.8.1: 582 582<br/>
clang-3.4: 599 499</p>
<p>The numbers on Sandy Bridge E5-1620 are quite different:</p>
<p>icc-14.0.1: 748 748<br/>
gcc-4.8.0: 700 676<br/>
clang-3.2: 700 676</p>
<p>That is to say, icc shows a speedup from Sandy Bridge to Haswell, but gcc and clang slow down. I think this is because for everything except the icc/Haswell test, the memory access speed is the limiting factor. This SB test system has quad-channel RAM vs the dual-channel HSW. Still, it&rsquo;s probably worth noting that on Haswell, icc somehow manages to be 50% faster on such a simple loop. </p>
<p>My personal conclusion from this isn&rsquo;t that one should therefor switch to icc, but that even when doing something simple in C, one should realize that the compiler has tremendous influence on the results you see. If you really care about performance on a particular processor family, you should probably lock your loop down in assembly rather trusting to the winds of fate.</p>
</div>
</li>
<li id="comment-129013" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bc40eb0aff49fb0aeef0b781db35e29d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bc40eb0aff49fb0aeef0b781db35e29d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Kurz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-06-06T15:30:32+00:00">June 6, 2014 at 3:30 pm</time></a> </div>
<div class="comment-content">
<p>Wondering whether the speed of reading from memory was a limiting factor, I just tried modifying the program to show what happens for a variety of buffer sizes. It presents a very different picture, with the simpler loop running much faster until the buffers get too large to fit in the different levels of cache (L1 = 32KB, L3 = ~10MB). </p>
<p>I used the same binary on both Haswell and Sandy Bridge, compiled with &lsquo;icc -Wall -std=c99 -xAVX -O3 -o card-icc card.c&rsquo;. There are probably some rounding issues involved, but I think the numbers are realistic. The amount of cache/memory used should be 3 * 8 * N (two input buffers and one output * 8 bytes per uint64_t * buffer size). </p>
<p>Haswell:<br/>
N=2048 repeat=200000 2925.714286 1241.212121 0.424242 156502015344<br/>
N=4096 repeat=100000 2925.714286 1241.212121 0.424242 91025568816<br/>
N=8192 repeat=50000 2925.714286 1204.705882 0.411765 77936987128<br/>
N=16384 repeat=25000 1861.818182 1412.413793 0.758621 76607756564<br/>
N=32768 repeat=12500 1780.869565 1321.290323 0.741935 77661022020<br/>
N=65536 repeat=6250 1780.869565 1365.333333 0.766667 88572242330<br/>
N=131072 repeat=3125 1706.666667 1365.333333 0.800000 92097612397<br/>
N=262144 repeat=1562 1574.880492 1204.320376 0.764706 94307193854<br/>
N=524288 repeat=781 787.440246 758.275793 0.962963 95454643365<br/>
N=1048576 repeat=390 567.978667 552.627892 0.972973 95913647420<br/>
N=2097152 repeat=195 567.978667 552.627892 0.972973 96253977139<br/>
N=4194304 repeat=97 573.024631 557.325326 0.972603 95938535739<br/>
N=8388608 repeat=48 575.218834 551.579704 0.958904 95029871800<br/>
N=16777216 repeat=24 575.218834 551.579704 0.958904 95073245884<br/>
N=33554432 repeat=12 575.218834 551.579704 0.958904 95092915964</p>
<p>Sandy Bridge:<br/>
N=2048 repeat=200000 2560.000000 952.558140 0.372093 156502015344<br/>
N=4096 repeat=100000 2409.411765 975.238095 0.404762 91025568816<br/>
N=8192 repeat=50000 2409.411765 975.238095 0.404762 77936987128<br/>
N=16384 repeat=25000 1517.037037 1050.256410 0.692308 76607756564<br/>
N=32768 repeat=12500 1365.333333 1024.000000 0.750000 77661022020<br/>
N=65536 repeat=6250 1412.413793 1024.000000 0.725000 88572242330<br/>
N=131072 repeat=3125 1365.333333 975.238095 0.714286 92097612397<br/>
N=262144 repeat=1562 1106.672778 890.149843 0.804348 94307193854<br/>
N=524288 repeat=781 772.582883 744.488960 0.963636 95454643365<br/>
N=1048576 repeat=390 717.446737 705.076966 0.982759 95913647420<br/>
N=2097152 repeat=195 693.126508 670.401049 0.967213 96253977139<br/>
N=4194304 repeat=97 666.963095 678.079147 1.016667 95938535739<br/>
N=8388608 repeat=48 671.088640 671.088640 1.000000 95029871800<br/>
N=16777216 repeat=24 682.463024 671.088640 0.983333 95073245884<br/>
N=33554432 repeat=12 671.088640 682.463024 1.016949 95092915964</p>
<p>This shows the Haswell system running slightly faster out of L1 and L3, and the Sandy Bridge running faster once we are reading from RAM. But the simple loop remains faster than the complex one until we start reading out of RAM.</p>
</div>
</li>
<li id="comment-129016" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-06-06T17:07:57+00:00">June 6, 2014 at 5:07 pm</time></a> </div>
<div class="comment-content">
<p>I would love to see more test results, but so far AVX was as fast as SSE. Perhaps, it is faster when you have many fewerstore/load operations.</p>
</div>
</li>
<li id="comment-129017" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-06-06T17:23:48+00:00">June 6, 2014 at 5:23 pm</time></a> </div>
<div class="comment-content">
<p>@Nathan </p>
<p>I have updated my blog post and revised my code. I agree that the shorter loop becomes faster on pure cache processing.</p>
</div>
</li>
<li id="comment-129018" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-06-06T17:43:54+00:00">June 6, 2014 at 5:43 pm</time></a> </div>
<div class="comment-content">
<p>@Nathan</p>
<p>BTW I am suspicious of your results with the Intel compiler. In my experience, it does a good job at defeating microbenchmarks. I&rsquo;d like to see the code it generates and see how it differs from gcc. We may find very similar compiled code for the loops, but differences elsewhere.</p>
<p><strong>Update</strong>: Turns out that the Intel compiler is not cheating.</p>
</div>
</li>
<li id="comment-129044" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d4d28bd014f9e7324bad99dcc3b0d390?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d4d28bd014f9e7324bad99dcc3b0d390?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.cfcl.com/rdm/" class="url" rel="ugc external nofollow">Rich Morin</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-06-07T06:06:59+00:00">June 7, 2014 at 6:06 am</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s also worth keeping in mind that longer code may actually have a shorter code path (eg, because it performs tests and optimizations).</p>
<p>Basically, no amount of straight-line code (ie, outside of a loop or recursion) is likely to add significantly to run time.</p>
</div>
</li>
</ol>
