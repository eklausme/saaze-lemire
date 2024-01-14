---
date: "2020-11-30 12:00:00"
title: "Java Buffer types versus native arrays: which is faster?"
index: false
---

[6 thoughts on &ldquo;Java Buffer types versus native arrays: which is faster?&rdquo;](/lemire/blog/2020/11-30-java-buffer-types-versus-native-arrays-which-is-faster)

<ol class="comment-list">
<li id="comment-560220" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/562d5315600be7859bae7240b06a3530?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/562d5315600be7859bae7240b06a3530?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Viktor Szathmar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-01T09:21:53+00:00">December 1, 2020 at 9:21 am</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,</p>
<p>Thanks for benchmarking this! In my environment (Zulu14.28+21-CA, MacOS 11.0.1) the performance of the native byte-order buffer (buffer_crazy) is quite close to the int[] array. An off-heap version of the same (via allocateDirect) show as buffer_direct below fares much worse though:</p>
<p><code>Benchmark Mode Cnt Score Error Units<br/>
MyBenchmark.array avgt 15 3.801 ± 0.143 us/op<br/>
MyBenchmark.buffer avgt 15 18.480 ± 1.664 us/op<br/>
MyBenchmark.buffer_crazy avgt 15 4.087 ± 0.256 us/op<br/>
MyBenchmark.buffer_direct avgt 15 25.111 ± 0.536 us/op<br/>
</code></p>
<p>The differences seem to stem from writes, as modifying the benchmark to do reads only (summing array values to a long, consumed by Blackhole) yields the same performance for all IntBuffer variants:</p>
<p><code>Benchmark Mode Cnt Score Error Units<br/>
SumBenchmark.array avgt 15 16.227 ± 0.536 us/op<br/>
SumBenchmark.buffer avgt 15 16.879 ± 1.179 us/op<br/>
SumBenchmark.buffer_crazy avgt 15 16.659 ± 0.643 us/op<br/>
SumBenchmark.buffer_direct avgt 15 17.774 ± 1.067 us/op<br/>
</code></p>
<p>Regards,<br/>
Viktor</p>
</div>
<ol class="children">
<li id="comment-560346" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4cf74649b70fc946650115e0d5067ebe?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4cf74649b70fc946650115e0d5067ebe?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Petr Jane?ek</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-02T02:01:01+00:00">December 2, 2020 at 2:01 am</time></a> </div>
<div class="comment-content">
<p>Indeed, the &ldquo;buffer_crazy&rdquo; workaround was born from a discussion on Twitter, and is expected to be in par with array: <a href="https://twitter.com/lemire/status/1333466140178313216" rel="nofollow ugc">https://twitter.com/lemire/status/1333466140178313216</a></p>
<p>Mr. Lemire simply did not update the post.</p>
<p>There is now a bug filed on the IntArray version, too: <a href="https://bugs.openjdk.java.net/browse/JDK-8257531" rel="nofollow ugc">https://bugs.openjdk.java.net/browse/JDK-8257531</a></p>
</div>
<ol class="children">
<li id="comment-560350" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-02T02:11:00+00:00">December 2, 2020 at 2:11 am</time></a> </div>
<div class="comment-content">
<p>That is correct, the post has not been updated.</p>
<p>Thanks for linking to the tweet, I should have done so in the updated code. I did link to the tweet in a github issue.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-560280" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/77e4428df13e21425afb490a7e2098cd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/77e4428df13e21425afb490a7e2098cd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Markus Schaber</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-01T17:01:04+00:00">December 1, 2020 at 5:01 pm</time></a> </div>
<div class="comment-content">
<p>Is anyone here aware of a similar benchmark for C#, comparing the &ldquo;traditional&rdquo; methods of Arrays, <code>unsafe</code> pointers, and the Read/Write methods of the <code>System.Runtime.InteropServices.Marshal</code> class with the new Memory and Span types?</p>
</div>
</li>
<li id="comment-560677" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4cf74649b70fc946650115e0d5067ebe?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4cf74649b70fc946650115e0d5067ebe?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Petr Jane?ek</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-04T12:37:06+00:00">December 4, 2020 at 12:37 pm</time></a> </div>
<div class="comment-content">
<p>Note that the issue has been picked up: <a href="https://bugs.openjdk.java.net/browse/JDK-8257531" rel="nofollow ugc">https://bugs.openjdk.java.net/browse/JDK-8257531</a> and is being fixed: <a href="https://github.com/openjdk/jdk/pull/1618/files" rel="nofollow ugc">https://github.com/openjdk/jdk/pull/1618/files</a></p>
<p>If all goes well, Java 16 will correctly vectorize <code>Buffer</code> (and <code>MemorySegment</code>) accesses too, if appliable. The only missing piece are direct Buffers for now, but at least that&rsquo;s something they&rsquo;re aware of now, too.</p>
</div>
</li>
<li id="comment-561792" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6bf49a521dd0636a653d9bb32bb25a7e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6bf49a521dd0636a653d9bb32bb25a7e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.philipreames.com" class="url" rel="ugc external nofollow">Philip Reames</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-12T21:35:20+00:00">December 12, 2020 at 9:35 pm</time></a> </div>
<div class="comment-content">
<p>Just to highlight, the results here are rather specific to one particular VM implementation. I decided to check how this performed on Azul Zing (which uses a very different top tier compiler), and as I&rsquo;d somewhat expected, saw a very different performance picture.</p>
<p>JDK 11.0.9.1, OpenJDK 64-Bit Server VM, 11.0.9.1+1-Ubuntu-0ubuntu1.20.04</p>
<p><code>Benchmark Mode Cnt Score Error Units<br/>
MyBenchmark.array avgt 15 3.151 ± 0.005 us/op<br/>
MyBenchmark.buffer avgt 15 18.463 ± 0.006 us/op<br/>
MyBenchmark.buffer_crazy avgt 15 3.161 ± 0.003 us/op<br/>
MyBenchmark.buffer_direct avgt 15 89.536 ± 0.049 us/op<br/>
</code></p>
<p>JDK 11.0.9.1-internal, Zing 64-Bit Tiered VM, 11.0.9.1-zing_99.99.99.99.dev-b3323-product-linux-X86_64</p>
<p><code>Benchmark Mode Cnt Score Error Units<br/>
MyBenchmark.array avgt 15 3.683 ± 0.475 us/op<br/>
MyBenchmark.buffer avgt 15 3.871 ± 0.395 us/op<br/>
MyBenchmark.buffer_crazy avgt 15 3.856 ± 0.386 us/op<br/>
MyBenchmark.buffer_direct avgt 15 16.594 ± 0.002 us/op<br/>
</code></p>
<p>These results were collected on an AWS EC2 c5.4xlarge image (which is a skylake server part). This was run on the &ldquo;feature preview&rdquo; (i.e. weirdly named beta) for Zing downloadable from here: <a href="https://docs.azul.com/zing/zing-quick-start-tar-fp.htm" rel="nofollow ugc">https://docs.azul.com/zing/zing-quick-start-tar-fp.htm</a></p>
<p>Disclaimer: I used to work for Azul, and in particularly, on the Falcon JIT compiler Zing uses. I&rsquo;m definitely biased here.</p>
</div>
</li>
</ol>
