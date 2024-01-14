---
date: "2018-04-17 12:00:00"
title: "Iterating in batches over data structures can be much faster&#8230;"
index: false
---

[13 thoughts on &ldquo;Iterating in batches over data structures can be much faster&#8230;&rdquo;](/lemire/blog/2018/04-17-iterating-in-batches-over-data-structures-can-be-much-faster)

<ol class="comment-list">
<li id="comment-300948" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8e1086eadc88de1e47fbffca9a73fd82?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8e1086eadc88de1e47fbffca9a73fd82?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Stuart</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-17T18:42:00+00:00">April 17, 2018 at 6:42 pm</time></a> </div>
<div class="comment-content">
<p>I cannot agree with this more strongly. I&rsquo;ve made improvements to InfluxDB cursors to move batches of time series data between stages that with measurable performance improvements ðŸ‘ðŸ»</p>
</div>
</li>
<li id="comment-301186" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Simon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-20T21:25:10+00:00">April 20, 2018 at 9:25 pm</time></a> </div>
<div class="comment-content">
<p>Try doing batch operations with gcc and its __builtin_prefetch() command. Try doing a batch of n (e.g. 8 or so; experiment with different batch sizes for your particular CPU) prefetches for n different memory addresses, immediately (or sometimes you can do other work in between because prefetching memory can be SLOW&#8230;) followed by a batch of n actual operations on the memory just fetched. I&rsquo;ve seen massive latency savings in the past doing this. Good luck!</p>
<p>[1] <a href="https://gcc.gnu.org/onlinedocs/gcc/Other-Builtins.html" rel="nofollow ugc">https://gcc.gnu.org/onlinedocs/gcc/Other-Builtins.html</a></p>
</div>
<ol class="children">
<li id="comment-301190" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-20T21:58:41+00:00">April 20, 2018 at 9:58 pm</time></a> </div>
<div class="comment-content">
<p>My experience with __builtin_prefetch() for performance has not been fruitful. I use it as part of benchmarks to help ensure that the cache is properly populated, but otherwise I rely on the processor to prefetch.</p>
</div>
<ol class="children">
<li id="comment-301196" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Simon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-20T23:53:34+00:00">April 20, 2018 at 11:53 pm</time></a> </div>
<div class="comment-content">
<p>It is difficult to get results using __builtin_prefetch() but don&rsquo;t give up! I&rsquo;ve found it easiest to get results using it in a batch. There are a special circumstances where it&rsquo;s going to help: (a) Don&rsquo;t make your batch size too big or too small. The CPU can only prefetch so many cache lines at a time. (b) Only use __builtin_prefetch() if you&rsquo;re expecting two or more cache lines fetches not to be in the cache, otherwise it&rsquo;ll just get in the way. Generally speaking the data structures you&rsquo;re working on need to be much bigger than the CPU cache memory and not cached. I wonder if you have not had success because you tend to experiment with smaller &lsquo;demo sized&rsquo; data structures rather than &lsquo;production sized&rsquo; data structures? An example, of a situation where __builtin_prefetch() would be useful is looking up a batch of keys in a larger hash table. HTH and don&rsquo;t give up on __builtin_prefetch() ! 🙂</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-301203" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-21T02:58:13+00:00">April 21, 2018 at 2:58 am</time></a> </div>
<div class="comment-content">
<p>Can you give me a short C program (say 30 lines of code) where __builtin_prefetch() helps tremendously, and such that the code without __builtin_prefetch() is not simply poorly designed so as to make __builtin_prefetch() look good.</p>
<p>That is, give me an example where __builtin_prefetch() helps a lot and where I cannot, using straight portable C, get the same kind of performance.</p>
<p>Feel free to use lots of RAM.</p>
</div>
<ol class="children">
<li id="comment-301204" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-21T02:58:47+00:00">April 21, 2018 at 2:58 am</time></a> </div>
<div class="comment-content">
<p>And to set the rules, let us agree to use a recent Intel processor with a recent C compiler on Linux.</p>
</div>
</li>
</ol>
</li>
<li id="comment-301265" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Simon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-21T21:37:57+00:00">April 21, 2018 at 9:37 pm</time></a> </div>
<div class="comment-content">
<p>Have a look at [1] which uses a 1 GB block of memory and then runs a series of experiments on it by looping over it in differing batch sizes (1, 2, 4, 8, 16, 32, 64, 128, and 256), differing increments between reads (1, 65, 513, and 525,225 bytes), and with and without __builtin_prefetch(). Each experiment reads from the block of memory the same number of times; 500 million times.</p>
<p>It should be possible for you to easily run this on your Linux box with little or no changes. The results will likely be sensitive to the exact CPU type, and the speed of the RAM. Please let me know how you get on. Also, I created this example especially for you, so it&rsquo;s possible there are flaws / bugs. If you find any then please let me know! 🙂</p>
<p>The results show that the biggest gains are using __builtin_prefetch() where auto prefetching has little effect and where the cache also has little effect. Let&rsquo;s look at the inc 524,225 results which represent the slowest, non-cached memory reads. The fastest batch size on my CPU without prefetch is batch size 2 with 84.5 million reads per second. And with prefetch this jumps up to 94.3 million reads per second, or 11.5% faster. However, with a batch size of 64 then using prefetch is 40% faster.</p>
<p>I think the experiment is also interesting because it shows how effective the CPU cache is. For example, the best result without prefetching is 970 million per second with batch size 16 with inc 1. And the worst is 70.4 million per second with batch size 16 and inc 524,225. So the fastest with CPU cache acceleration (without prefetching) is 13.8 times faster&#8230; over an order of magnitude faster. This also shows that between the prefetch loop and the batch loop, it would be possible to do quite a lot of CPU work on cached memory while waiting for the prefetched RAM to be cached. Perhaps a further experiment could prove this?</p>
<p>Also, interesting is that without prefetch reads per second generally get consistently slower as the batch size gets bigger, except for batch size 1 or inc 1. However, that&rsquo;s not the case with prefetch because as the batch size gets bigger the reads per second do not necessarily get consistently slower.</p>
<p>Looking forwards to any comments.</p>
<p>[1] <a href="https://gist.github.com/simonhf/caaa33ccb87c0bf0775a863c0d6843c2" rel="nofollow ugc">https://gist.github.com/simonhf/caaa33ccb87c0bf0775a863c0d6843c2</a></p>
</div>
</li>
<li id="comment-301424" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Simon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-23T16:54:25+00:00">April 23, 2018 at 4:54 pm</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s interesting when you try this code on an Amazon box&#8230; which I did (but not for the results above). I found an unused Amazon c3.8xl box. Of course, it&rsquo;s unused by me&#8230; but there maybe other (&lsquo;noisy&rsquo;?) neighbours on the box doing stuff. Although the virtualization layer gives each OS running a fair slice of CPU time&#8230; AFAIK there is no way to virtualize the CPU cache&#8230; which means that the fair slice of CPU time really depends upon how much memory is cached. We saw above that having memory cached and make an order of magnitude difference.</p>
<p>So I the tests seven times on the Amazon box and here is one set of results which varied enormously from test run to test run:</p>
<p>500000000 incs in 8.485089 seconds or 58926901 incs per second without prefetch using batch_size 8 and inc 524225<br/>
500000000 incs in 23.625080 seconds or 21163949 incs per second without prefetch using batch_size 8 and inc 524225<br/>
500000000 incs in 8.736761 seconds or 57229446 incs per second without prefetch using batch_size 8 and inc 524225<br/>
500000000 incs in 35.973597 seconds or 13899083 incs per second without prefetch using batch_size 8 and inc 524225<br/>
500000000 incs in 9.903223 seconds or 50488613 incs per second without prefetch using batch_size 8 and inc 524225<br/>
500000000 incs in 8.794001 seconds or 56856941 incs per second without prefetch using batch_size 8 and inc 524225<br/>
500000000 incs in 10.606903 seconds or 47139113 incs per second without prefetch using batch_size 8 and inc 524225</p>
<p>Most test runs, this particular test took between 8.5 and 10.6 seconds. However, on two of the test runs it took 23.6 and 36 seconds! Surely this must be because of &lsquo;noisy CPU cache neighbors&rsquo;?</p>
</div>
<ol class="children">
<li id="comment-301425" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-23T16:56:04+00:00">April 23, 2018 at 4:56 pm</time></a> </div>
<div class="comment-content">
<p>Thanks. I am not ignoring your code&#8230; there might just be a delay before I get to it because I have many urgent tasks to complete in a timely manner.</p>
</div>
<ol class="children">
<li id="comment-301427" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Simon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-23T18:14:53+00:00">April 23, 2018 at 6:14 pm</time></a> </div>
<div class="comment-content">
<p>No worries 🙂</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-302145" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Simon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-01T00:27:52+00:00">May 1, 2018 at 12:27 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve been looking into this a bit more and discovered that when you run the same memory bandwidth benchmark on the same hardware but with different OSs then the results can differ in several different ways:</p>
<p>The benchmark can simply be generally faster for some OSs.<br/>
The benchmark can be slower for hyperthreads for some OSs.<br/>
The benchmark percentile at 90% and above can be abnormally slow.</p>
<p>For example, I have included raw results below (because cannot figure out how to attach a graph) of 6 sessions; 3 different types of &lsquo;bare metal&rsquo; hardware from packet net [1] (ARM c2, Intel Xeon m1, and different Intel Xeon m2) running the same benchmark under 2 different OSs. In each session the benchmark is run 100s of times and the percentile results are on the x axis.</p>
<p>read 720 lines: max-packet-net-centos7/c2.medium/cache-line-example-2-b.log ;[1.03 p0][1.04 p5][1.04 p10][1.04 p15][1.04 p20][1.04 p25][1.04 p30][1.05 p35][1.05 p40][1.05 p45][1.06 p50][1.06 p55][1.06 p60][1.06 p65][1.06 p70][1.06 p75][1.06 p80][1.06 p85][1.06 p90][1.07 p95][1.07 p100]<br/>
read 720 lines: max-packet-net-centos7/m1.xlarge/cache-line-example-2-b.log ;[1.02 p0][1.03 p5][1.05 p10][1.07 p15][1.08 p20][1.08 p25][1.09 p30][1.09 p35][1.09 p40][1.09 p45][1.09 p50][1.09 p55][1.09 p60][1.10 p65][1.10 p70][1.10 p75][1.10 p80][1.10 p85][1.11 p90][1.13 p95][1.90 p100]<br/>
read 840 lines: max-packet-net-centos7/m2.xlarge/cache-line-example-2-b.log ;[1.21 p0][1.22 p5][1.22 p10][1.22 p15][1.22 p20][1.23 p25][1.23 p30][1.24 p35][1.24 p40][1.25 p45][1.26 p50][1.26 p55][1.26 p60][1.26 p65][1.27 p70][1.27 p75][1.27 p80][1.27 p85][1.28 p90][1.29 p95][1.99 p100]<br/>
read 720 lines: max-packet-net-ubuntu1604/c2.medium/cache-line-example-2-b.log;[0.99 p0][0.99 p5][0.99 p10][0.99 p15][0.99 p20][0.99 p25][0.99 p30][1.00 p35][1.00 p40][1.00 p45][1.00 p50][1.00 p55][1.00 p60][1.00 p65][1.00 p70][1.01 p75][1.01 p80][1.01 p85][1.01 p90][1.02 p95][1.03 p100]<br/>
read 720 lines: max-packet-net-ubuntu1604/m1.xlarge/cache-line-example-2-b.log;[1.01 p0][1.02 p5][1.04 p10][1.07 p15][1.08 p20][1.08 p25][1.08 p30][1.08 p35][1.09 p40][1.09 p45][1.20 p50][1.23 p55][1.24 p60][1.25 p65][1.25 p70][1.25 p75][1.25 p80][1.25 p85][1.25 p90][1.26 p95][1.57 p100]<br/>
read 840 lines: max-packet-net-ubuntu1604/m2.xlarge/cache-line-example-2-b.log;[1.21 p0][1.21 p5][1.21 p10][1.22 p15][1.22 p20][1.22 p25][1.23 p30][1.23 p35][1.23 p40][1.23 p45][1.24 p50][1.31 p55][1.31 p60][1.31 p65][1.32 p70][1.32 p75][1.35 p80][1.35 p85][1.35 p90][1.36 p95][1.36 p100]</p>
<p>Notes:</p>
<p>c2 and m1 have 48 CPUs each including hyper threads, while m2 has 56 CPUs.<br/>
Each benchmark was run 15 times on each CPU.</p>
<p>I have also got similar results on Amazon testing different OSs. For same reason, Amazon Linux 2 performs consistently much worse than either CentOS 7 or Ubuntu 16.04.</p>
<p>[1] <a href="https://www.packet.net/" rel="nofollow ugc">https://www.packet.net/</a></p>
</div>
</li>
<li id="comment-303747" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b48def645758b95537d4424c84d1a9ff?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b48def645758b95537d4424c84d1a9ff?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Gerg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-16T19:35:12+00:00">May 16, 2018 at 7:35 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t understand the comment that you&rsquo;re adding a &ldquo;memory copy over a small buffer&rdquo;. Surely the net effect is to copy the same total amount of data regardless of the size of the buffer.</p>
<p>The metric that will matter here is the ratio between the time needed to copy all the data and the amount of work being done with all that data. If the data is large and there&rsquo;s very little work being done on it then copying it all is going to add a lot of extra time. If the data is small and there&rsquo;s lots of work being done on each datum then the time to copy it all will be insignificant and the cache efficiency will dominate.</p>
<p>This is especially true if the data structure itself requires lots of effort to look up individual data. If you&rsquo;re descending a btree for each datum then even if you don&rsquo;t optimize that for batch processing descending it again for the next one will be much faster if all those addresses are still in cache.</p>
</div>
<ol class="children">
<li id="comment-303757" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-16T21:44:12+00:00">May 16, 2018 at 9:44 pm</time></a> </div>
<div class="comment-content">
<p><em>I don&rsquo;t understand the comment that you&rsquo;re adding a â€œmemory copy over a small bufferâ€. Surely the net effect is to copy the same total amount of data regardless of the size of the buffer.</em></p>
<p>I am not sure why we don&rsquo;t understand each other. Yes. I agree that the size of the buffer, as long as it fits in L1 cache, is probably not super important. Did I write something different?</p>
</div>
</li>
</ol>
</li>
</ol>
