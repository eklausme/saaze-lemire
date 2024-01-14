---
date: "2023-03-01 12:00:00"
title: "ARM vs Intel on Amazon&#8217;s cloud: A URL Parsing Benchmark"
index: false
---

[11 thoughts on &ldquo;ARM vs Intel on Amazon&#8217;s cloud: A URL Parsing Benchmark&rdquo;](/lemire/blog/2023/03-01-arm-vs-intel-on-amazons-cloud)

<ol class="comment-list">
<li id="comment-649579" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/847335d01f0681a1a00217b259b9dcd3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/847335d01f0681a1a00217b259b9dcd3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://threedots.ovh/blog/" class="url" rel="ugc external nofollow">never_released</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-02T01:22:30+00:00">March 2, 2023 at 1:22 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
The Intel processors have the crazily good AVX-512 instructions: ARM processors have nothing close
</p></blockquote>
<p>Graviton3 has Arm SVE, which includes predication. (in a 2x 256b setup, so significantly less throughput though)</p>
</div>
<ol class="children">
<li id="comment-649589" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-02T15:03:45+00:00">March 2, 2023 at 3:03 pm</time></a> </div>
<div class="comment-content">
<p>AVX-512 is far superior to SVE in terms of how powerful the instructions are. And though the Graviton 3 has 256-bit registers, it looks like most ARM designs are going back to 128-bit registers which will leave x64 processors with significantly more powerful SIMD instructions than ARM processors.</p>
</div>
</li>
</ol>
</li>
<li id="comment-649584" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/28e3a6e2c8201e531d5ea4ff1a1067f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/28e3a6e2c8201e531d5ea4ff1a1067f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Laurent</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-02T09:06:11+00:00">March 2, 2023 at 9:06 am</time></a> </div>
<div class="comment-content">
<p>Hello,</p>
<p>a point worth considering is that hyperthreading likely is enabled on the x86 instances which will have a negative impact even on single-threaded workloads if the machine is fully used.</p>
<p>For a fully loaded machine, 2 vCPU x86 are likely worse than 2 CPU Arm (until memory bandwidth hits the Arm machine with all its CPUs competing to access it :-).</p>
<p>I think this might explain why you don&rsquo;t see the same speedup as opdroid1234 who seems to be running heavily threaded tasks (compilation).</p>
</div>
<ol class="children">
<li id="comment-649590" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-02T15:07:57+00:00">March 2, 2023 at 3:07 pm</time></a> </div>
<div class="comment-content">
<p>One can always object that the comparison is biased in favour of Intel but in this instance, the x64 node is more expensive than the ARM node.</p>
<p>Granted, it is possible that Amazon is subsidizing its ARM hardware.</p>
</div>
</li>
</ol>
</li>
<li id="comment-649587" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b61b66405d0e13d136e8539b1cf37ad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b61b66405d0e13d136e8539b1cf37ad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://None." class="url" rel="ugc external nofollow">N</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-02T14:46:56+00:00">March 2, 2023 at 2:46 pm</time></a> </div>
<div class="comment-content">
<p>Here is a output from Oracle cloud Neoverse-N1 Arm64 &ldquo;Shared CPU&rdquo;</p>
<p>[root@instance-20220729-0825 ada]# ./build/benchmarks/bench &#8211;benchmark_filter=Ada<br/>
2023-03-02T14:44:17+00:00<br/>
Running ./build/benchmarks/bench<br/>
Run on (4 X 50 MHz CPU s)<br/>
Load Average: 0.61, 0.27, 0.10<br/>
ada spec: Ada follows whatwg/url<br/>
bytes/URL: 73.454545<br/>
curl : OMITTED<br/>
input bytes: 808<br/>
number of URLs: 11</p>
<p>performance counters: Enabled</p>
<p>Benchmark Time CPU Iterations UserCounters&#8230;</p>
<p>BasicBench_AdaURL 4152 ns 4145 ns 167020 GHz=3.06742 cycle/byte=25.0557 cycles/url=1.84045k instructions/byte=41.4072 instructions/cycle=1.65261 instructions/ns=5.06924 instructions/url=3.04155k ns/url=600 speed=194.92M/s time/byte=5.1303ns time/url=376.844ns url/s=2.65362M/s</p>
</div>
<ol class="children">
<li id="comment-649588" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b61b66405d0e13d136e8539b1cf37ad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b61b66405d0e13d136e8539b1cf37ad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://None." class="url" rel="ugc external nofollow">N</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-02T14:48:30+00:00">March 2, 2023 at 2:48 pm</time></a> </div>
<div class="comment-content">
<p>Sorry about unreadable copy/paste</p>
<p> performance counters: Enabled</p>
<p>Benchmark Time CPU Iterations UserCounters&#8230;</p>
<p>BasicBench_AdaURL 4152 ns 4145 ns 167020</p>
<p>GHz=3.06742 cycle/byte=25.0557 cycles/url=1.84045k instructions/byte=41.4072 instructions/cycle=1.65261 instructions/ns=5.06924 instructions/url=3.04155k ns/url=600 speed=194.92M/s time/byte=5.1303ns time/url=376.844ns url/s=2.65362M/s</p>
</div>
<ol class="children">
<li id="comment-649595" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b4610b92810b55bfee0be46cc2c11586?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b4610b92810b55bfee0be46cc2c11586?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jeffrey W. Baker</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-02T20:38:35+00:00">March 2, 2023 at 8:38 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s pretty useful, demonstrates well that Graviton 2 is nothing but a vanilla implementation of Neoverse-N1, and it can be replicated by any licensee.</p>
</div>
<ol class="children">
<li id="comment-649600" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-03T01:24:25+00:00">March 3, 2023 at 1:24 am</time></a> </div>
<div class="comment-content">
<p>In this test, the Oracle system does a bit worse (376.844ns/url vs 320 ns/url) but that&rsquo;s a small difference. Furthermore, I used the Graviton 3, not 2.</p>
<p>No matter: your point is correct, I think, others can no doubt compete against the Amazon&rsquo;s Graviton processors. It just happens that it is easy for me to have access to AWS, so that&rsquo;s what I use.</p>
<p>This makes Intel&rsquo;s stance even more perilous, it seems to me.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-649614" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/009550b9e16e7dc4cbd1aeea4d99fa5c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/009550b9e16e7dc4cbd1aeea4d99fa5c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://-" class="url" rel="ugc external nofollow">Alex Petrov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-03T22:23:28+00:00">March 3, 2023 at 10:23 pm</time></a> </div>
<div class="comment-content">
<p>Historical tails of x86, complex instruction set CISC, heavy logics, hard prediction, modes switches, workarounds for old bugs, extra logics/extra silicone bigger size/latency &#8211; making x86 less efficient.</p>
<p>Check this article from Erik.<br/>
<a href="https://erik-engheim.medium.com/arm-vs-risc-v-vector-extensions-992f201f402f" rel="nofollow ugc">https://erik-engheim.medium.com/arm-vs-risc-v-vector-extensions-992f201f402f</a></p>
</div>
</li>
<li id="comment-649693" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1bf48ab39f56debcc0a700130e4a6c00?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1bf48ab39f56debcc0a700130e4a6c00?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Oliver Jones</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-07T18:06:29+00:00">March 7, 2023 at 6:06 pm</time></a> </div>
<div class="comment-content">
<p>You know what metric would be super-interesting?</p>
<p>watt hours / URL or maybe joules / URL.</p>
<p>I understand it&rsquo;s impossible to estimate VM power consumption. Nevertheless, energy cost is important.</p>
</div>
<ol class="children">
<li id="comment-649694" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-07T18:10:35+00:00">March 7, 2023 at 6:10 pm</time></a> </div>
<div class="comment-content">
<p>I agree.</p>
</div>
</li>
</ol>
</li>
</ol>
