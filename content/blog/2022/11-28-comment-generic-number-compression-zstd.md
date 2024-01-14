---
date: "2022-11-28 12:00:00"
title: "Generic number compression (zstd)"
index: false
---

[16 thoughts on &ldquo;Generic number compression (zstd)&rdquo;](/lemire/blog/2022/11-28-generic-number-compression-zstd)

<ol class="comment-list">
<li id="comment-648014" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f111c352cd5721b0f944af0138b33611?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f111c352cd5721b0f944af0138b33611?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Ethan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-28T19:11:17+00:00">November 28, 2022 at 7:11 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;from one byte to eight byte&rdquo; should this read in the opposite order: &ldquo;from eight byte to one byte&rdquo; ?</p>
</div>
<ol class="children">
<li id="comment-648022" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-28T22:39:32+00:00">November 28, 2022 at 10:39 pm</time></a> </div>
<div class="comment-content">
<p>You are correct. Thank you.</p>
</div>
</li>
</ol>
</li>
<li id="comment-648028" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cc5724189e7213b187533dfb8275b0ae?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cc5724189e7213b187533dfb8275b0ae?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://evelance.de" class="url" rel="ugc external nofollow">Stefan</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-29T01:09:49+00:00">November 29, 2022 at 1:09 am</time></a> </div>
<div class="comment-content">
<p>Interesting. The default compression level of zstd seems to be only 3 of 22, though. And brotli can squeeze even more out of it, although at a high price (of CPU time).</p>
<p>Here are some more results for all levels of zstd, brotli and gzip:<br/>
<a href="https://github.com/evelance/generic-number-compression" rel="nofollow ugc">https://github.com/evelance/generic-number-compression</a></p>
<p>Somehow, brotli manages to get the file size down to 44% for the float32-in-double file:<br/>
<code><br/>
Versions: gzip 1.12, brotli 1.0.9, zstd 1.5.2<br/>
Checking compression for file 'testfloat.dat'<br/>
00000000: 0000 00c0 128d e63f 0000 00a0 f321 cf3f<br/>
00000010: 0000 00a0 2580 eb3f 0000 00e0 012a ea3f<br/>
gzip-1 0.14s 4497086 56.21%<br/>
gzip-5 0.26s 4217599 52.72%<br/>
gzip-9 5.50s 4093342 51.17%<br/>
brotli-0 0.02s 4835457 60.44%<br/>
brotli-5 0.31s 4045934 50.57%<br/>
brotli-9 1.55s 3986579 49.83%<br/>
brotli-11 10.15s 3517421 43.97%<br/>
zstd-1 0.02s 4508213 56.35%<br/>
zstd-3 0.04s 4190227 52.38%<br/>
zstd-8 0.17s 3878348 48.48%<br/>
zstd-16 1.56s 3754120 46.93%<br/>
zstd-22 2.31s 3755501 46.94%<br/>
Checking compression for file 'testint.dat'<br/>
00000000: 7e00 0000 0000 0000 f1ff ffff ffff ffff<br/>
00000010: 2200 0000 0000 0000 2100 0000 0000 0000<br/>
gzip-1 0.06s 1896180 23.70%<br/>
gzip-5 0.15s 1675779 20.95%<br/>
gzip-9 7.20s 1519492 18.99%<br/>
brotli-0 0.01s 1743049 21.79%<br/>
brotli-5 0.15s 1523142 19.04%<br/>
brotli-9 0.48s 1521837 19.02%<br/>
brotli-11 9.44s 1234645 15.43%<br/>
zstd-1 0.02s 1593200 19.91%<br/>
zstd-3 0.02s 1656052 20.70%<br/>
zstd-8 0.12s 1675177 20.94%<br/>
zstd-16 1.56s 1323872 16.55%<br/>
zstd-22 2.67s 1297221 16.22%<br/>
</code></p>
<p>I am currently pondering on the implementation of a time series database for tiny embedded devices and simply compressing a list of appropriately sized (delta) values yields pretty good results 🙂</p>
<p>By the way, can you recommend a good compression algorithm for uint32 timestamp values that are increasing or strictly increasing? A pointer to the right direction would be greatly appreciated.</p>
</div>
<ol class="children">
<li id="comment-648056" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/317ec2ceb7698ce278aa1a63c6d10d5f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/317ec2ceb7698ce278aa1a63c6d10d5f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">The Alchemist</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-29T22:21:53+00:00">November 29, 2022 at 10:21 pm</time></a> </div>
<div class="comment-content">
<p>Depends how extreme you wanna get, and what the requirements are. 🙂 Like, do you need random access? What language?</p>
<p>sux4j, a Java package, has a large list of data structures for this kind of thing that provide close to the information-theoretical lower bound, like the Elias-Fano encoding. There&rsquo;s a C++ implementation from Facebook (<a href="https://github.com/facebook/folly/blob/main/folly/experimental/EliasFanoCoding.h" rel="nofollow ugc">https://github.com/facebook/folly/blob/main/folly/experimental/EliasFanoCoding.h</a>). You mentioned embedded, so that&rsquo;s why I threw the C++ lib in there. I bet there&rsquo;s a C implementation out there too.</p>
<p>Also, check out <a href="https://pdal.io/en/stable/" rel="nofollow ugc">https://pdal.io/en/stable/</a>, a LIDAR compression software.</p>
</div>
<ol class="children">
<li id="comment-648152" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cc5724189e7213b187533dfb8275b0ae?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cc5724189e7213b187533dfb8275b0ae?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stefan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-04T13:56:35+00:00">December 4, 2022 at 1:56 pm</time></a> </div>
<div class="comment-content">
<p>Thanks a lot for the links!</p>
<p>For the requirements, the code size is ~1MB, RAM ~16MB and the database is capped at 10MB. So, actually tiny 🙂</p>
<p>Random indexing and performance is generally not important, the database just needs to compress as many IoT data points as possible (our test data has ~60M data points) and deliver time segments of values for a graph.</p>
</div>
</li>
</ol>
</li>
<li id="comment-648178" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fd559a85dcf968d4996c990439b033fc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fd559a85dcf968d4996c990439b033fc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maks Verver</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-05T13:24:59+00:00">December 5, 2022 at 1:24 pm</time></a> </div>
<div class="comment-content">
<p>You are mistaken that the optimal compression for random floats as doubles should be “roughly equal to two”.</p>
<p>The entropy of IEEE floats between 0 and 1 is (slightly under) 25 bits: 23 bits for the mantissa, plus 2 bits for the exponent, using Shannon&rsquo;s formula for entropy.</p>
<p>So that means that random floats should already be compressible to a ratio of 25/32 = 0.78125 = ~78% and when converted to doubles, the optimal compression ratio is 25/64 = 0.390625 = ~39%, not 50%. That explains why Stefan was able to compress these files in much less than 50%, which would have been theoretically impossible otherwise.</p>
</div>
<ol class="children">
<li id="comment-648187" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-05T17:45:33+00:00">December 5, 2022 at 5:45 pm</time></a> </div>
<div class="comment-content">
<p><em>You are mistaken that the optimal compression for random floats as doubles should be “roughly equal to two”.</em></p>
<p>Your computation suggests that the exact answer is ~2.6x.</p>
</div>
</li>
</ol>
</li>
<li id="comment-648950" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c177ab66c270248617a7ea4ff63fec36?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c177ab66c270248617a7ea4ff63fec36?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cristian Vasile</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-15T18:41:32+00:00">January 15, 2023 at 6:41 pm</time></a> </div>
<div class="comment-content">
<p>FYI.<br/>
Lossless compressor and decompressor for numerical data using quantiles<br/>
<a href="https://github.com/mwlon/quantile-compression" rel="nofollow ugc">https://github.com/mwlon/quantile-compression</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-648032" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marcin Zukowski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-29T08:06:41+00:00">November 29, 2022 at 8:06 am</time></a> </div>
<div class="comment-content">
<p>Hi Daniel, interesting experiment, but I guess you&rsquo;ll agree the results can not be generalized, as it depends dramatically on the details of the data.</p>
<p>For example, the floats you&rsquo;re generating are not really random, as you&rsquo;re using a very small subset of the mantisa domain (half of your values will have the exact same mantisa), making every 8 bytes you generate have identical 4 bytes, and there are only 8 versions of 5-byte patterns there. zstd can surely compress that very well, with &ldquo;-9&rdquo; you&rsquo;ll even get under your 50% threshold.</p>
<p>Similarly, if you change your integer domain to [0, 255], suddenly you get to 13% compression, because you only generate 7-byte sequences of 00s, not both 00s and FFs.</p>
<p>In general, you&rsquo;re right, it&rsquo;s easy to generate data distributions where zstd will lose badly to specific encodings. On the flip side, for any of these encodings, there will be distributions where zlib will crush it 🙂</p>
<p>Side note: zstd for me is a true revolution in compression tech &#8211; the compression ratios and speed it provides makes most of the general purpose alternatives mostly obsolete IMO. </p>
<p>Fun!</p>
</div>
</li>
<li id="comment-648039" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-29T14:37:50+00:00">November 29, 2022 at 2:37 pm</time></a> </div>
<div class="comment-content">
<p><em>Hi Daniel, interesting experiment, but I guess you’ll agree the results can not be generalized, as it depends dramatically on the details of the data.</em></p>
<p>I think we are in agreement.</p>
<p>I expect a codec like zstd to be often within a factor of two of a reasonable information theoretical bound when doing data engineering work. And it is often fast enough. There are specific instances, and these instances are important, where you can do much better (better compression, better speed)&#8230; and I care a lot about these instances&#8230; but if you just have generic data&#8230; then using something like zstd will be good enough&#8230; meaning that the engineering work needed to do better will not be worth the effort.</p>
<p><em>the floats you’re generating are not really random, as you’re using a very small subset of the mantisa domain (half of your values will have the exact same mantisa)</em></p>
<p>Am I? The code is meant to generate random numbers between 0 and 1&#8230;</p>
<pre style="color:#000000;background:#ffffff;"> std<span style="color:#808030; ">:</span><span style="color:#808030; ">:</span>random_device rd<span style="color:#800080; ">;</span>
  std<span style="color:#808030; ">:</span><span style="color:#808030; ">:</span>default_random_engine eng<span style="color:#808030; ">(</span>rd<span style="color:#808030; ">(</span><span style="color:#808030; ">)</span><span style="color:#808030; ">)</span><span style="color:#800080; ">;</span>
  std<span style="color:#808030; ">:</span><span style="color:#808030; ">:</span>uniform_real_distribution<span style="color:#808030; ">&lt;</span><span style="color:#800000; font-weight:bold; ">float</span><span style="color:#808030; ">></span> distr<span style="color:#808030; ">(</span><span style="color:#008000; ">0.0</span><span style="color:#006600; ">f</span><span style="color:#808030; ">,</span> <span style="color:#008000; ">1.0</span><span style="color:#006600; ">f</span><span style="color:#808030; ">)</span><span style="color:#800080; ">;</span>
  <span style="color:#800000; font-weight:bold; ">for</span> <span style="color:#808030; ">(</span>size_t i <span style="color:#808030; ">=</span> <span style="color:#008c00; ">0</span><span style="color:#800080; ">;</span> i <span style="color:#808030; ">&lt;</span> N<span style="color:#800080; ">;</span> i<span style="color:#808030; ">+</span><span style="color:#808030; ">+</span><span style="color:#808030; ">)</span> <span style="color:#800080; ">{</span>
    x<span style="color:#808030; ">[</span>i<span style="color:#808030; ">]</span> <span style="color:#808030; ">=</span> distr<span style="color:#808030; ">(</span>eng<span style="color:#808030; ">)</span><span style="color:#800080; ">;</span>
  <span style="color:#800080; ">}</span>
</pre>
<p>Admittedly, not all floats fall in this interval&#8230; Only about a quarter of them&#8230; so I expect slightly less than 30 bits of randomness per float&#8230; </p>
<p>Looking at the raw data, I do not see that half of the mantissa have the exact same value&#8230; maybe I misunderstand what you meant?</p>
<pre>
 ./generate &#038; hexdump test.dat |  head -n 10
0000000 0000 0000 1c50 3fcb 0000 4000 e34a 3feb
0000010 0000 e000 8443 3fee 0000 6000 6eeb 3fdb
0000020 0000 4000 5b10 3fbf 0000 c000 f3ae 3fd8
0000030 0000 0000 3b2b 3fe2 0000 8000 eb88 3fb4
0000040 0000 e000 fa1a 3fe4 0000 a000 de15 3fbb
0000050 0000 4000 1eb4 3fe5 0000 e000 833a 3fe8
0000060 0000 c000 906b 3fe0 0000 e000 88e3 3fdf
0000070 0000 a000 69d3 3fe2 0000 0000 4785 3f92
0000080 0000 8000 dd59 3fe5 0000 2000 613a 3fc1
</pre>
<p><em><br/>
Similarly, if you change your integer domain to [0, 255], suddenly you get to 13% compression, because you only generate 7-byte sequences of 00s, not both 00s and FFs.<br/>
</em></p>
<p>In that scenario, we get roughly an 8x compression ratio, so effectively as good as it gets. When I built my example, I deliberately used a signed value because I think it is more impressive that you can get a 5x compression ratio with signed values !!!</p>
<p>I was neither trying to set zstd for a fall nor trying to make it look good.</p>
</div>
<ol class="children">
<li id="comment-648045" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marcin Zukowski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-29T17:48:42+00:00">November 29, 2022 at 5:48 pm</time></a> </div>
<div class="comment-content">
<p>Argh, silly me, I meant exponent, not mantisa &#8211; half of the values will fall in the range [0.5, 1) which will have the same mantisa 🙂 Sorry, I was typing this late.</p>
</div>
<ol class="children">
<li id="comment-648046" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marcin Zukowski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-29T17:49:27+00:00">November 29, 2022 at 5:49 pm</time></a> </div>
<div class="comment-content">
<p>Ha, you see, my brain does it again. &ldquo;which will have the same exponent&rdquo; !</p>
</div>
<ol class="children">
<li id="comment-648047" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-29T18:04:04+00:00">November 29, 2022 at 6:04 pm</time></a> </div>
<div class="comment-content">
<p>Smart people make mistakes and yet the world does not fall apart.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-648179" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fd559a85dcf968d4996c990439b033fc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fd559a85dcf968d4996c990439b033fc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maks Verver</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-05T13:29:14+00:00">December 5, 2022 at 1:29 pm</time></a> </div>
<div class="comment-content">
<p>(Sorry, I posted this comment in reply to Stefan above, but it&rsquo;s more appropriate here. Please feel free to delete my earlier reply.)</p>
<p>The entropy of IEEE floats between 0 and 1 is (slightly under) 25 bits: 23 bits for the mantissa, plus 2 bits for the exponent, using Shannon’s formula for entropy. So that means that random floats should already be compressible to a ratio of 25/32 = 0.78125 = ~78% and when converted to doubles, the optimal compression ratio is 25/64 = 0.390625 = ~39%, not 50%. That explains why Stefan was able to compress these files in much less than 50%, which would have been theoretically impossible otherwise.</p>
</div>
</li>
</ol>
</li>
<li id="comment-648071" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1fee087d7a1ca17c8ad348271819a8d5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1fee087d7a1ca17c8ad348271819a8d5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Antoine</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-30T16:13:32+00:00">November 30, 2022 at 4:13 pm</time></a> </div>
<div class="comment-content">
<p>It should be noted that zstd is not exclusive to type-specific compression.<br/>
For example, the &ldquo;byte stream split&rdquo; encoding recently added to the Parquet format provides a valuable preprocessing step that increases the efficiency of Zstd compression on floating-point data:<br/>
<a href="https://issues.apache.org/jira/browse/PARQUET-1622" rel="nofollow ugc">https://issues.apache.org/jira/browse/PARQUET-1622</a></p>
</div>
<ol class="children">
<li id="comment-648072" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-30T16:21:08+00:00">November 30, 2022 at 4:21 pm</time></a> </div>
<div class="comment-content">
<p>zstd is generic, indeed, and there are definitively preprocessing steps that may help compression.</p>
</div>
</li>
</ol>
</li>
</ol>
