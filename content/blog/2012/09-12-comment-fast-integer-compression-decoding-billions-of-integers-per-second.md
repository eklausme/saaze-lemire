---
date: "2012-09-12 12:00:00"
title: "Fast integer compression: decoding billions of integers per second"
index: false
---

[24 thoughts on &ldquo;Fast integer compression: decoding billions of integers per second&rdquo;](/lemire/blog/2012/09-12-fast-integer-compression-decoding-billions-of-integers-per-second)

<ol class="comment-list">
<li id="comment-55583" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1d8f866997d12f817ae4347a9797265a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1d8f866997d12f817ae4347a9797265a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">oscarbg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-09-13T09:59:05+00:00">September 13, 2012 at 9:59 am</time></a> </div>
<div class="comment-content">
<p>Hi,<br/>
pretty interesting.. altough I don&rsquo;t know much about this topic I was thinking if this scheme is compatible with wider vector sets and perform well with new Intel AVX2 (256 bit wide integer instructions) and BMI2 instructions which would bring 2x wider vectorization.. and also what about Intel Xeon Phi with 512 bit wide vector instructions.. would new algorithms be thought?<br/>
Only desiring for you to share your thoughts on the effect of upcoming vector instructions for integer compression..<br/>
thanks..</p>
</div>
</li>
<li id="comment-55587" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-09-13T10:34:51+00:00">September 13, 2012 at 10:34 am</time></a> </div>
<div class="comment-content">
<p>@oscarbg</p>
<p>Thanks for your excellent comment. We do discuss the issue of wider vectors in the paper, see section 7 (page 22).</p>
<p>Reference: <a href="http://arxiv.org/abs/1209.2137" rel="nofollow ugc">http://arxiv.org/abs/1209.2137</a></p>
</div>
</li>
<li id="comment-55616" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-09-13T21:35:58+00:00">September 13, 2012 at 9:35 pm</time></a> </div>
<div class="comment-content">
<p>@oscarbg<br/>
Unlike varint it uses only simple SSE2 instructions: 4-int additions, ORs, and ANDs. I believe these instructions should be efficiently supported by all CPUs that have SIMD operations.</p>
</div>
</li>
<li id="comment-55618" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1d8f866997d12f817ae4347a9797265a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1d8f866997d12f817ae4347a9797265a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">oscarbg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-09-13T23:09:33+00:00">September 13, 2012 at 11:09 pm</time></a> </div>
<div class="comment-content">
<p>thanks for responses..</p>
</div>
</li>
<li id="comment-55705" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4124e11d4b9bd750e5afb8d2d03b3ffa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4124e11d4b9bd750e5afb8d2d03b3ffa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">omar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-09-17T01:00:04+00:00">September 17, 2012 at 1:00 am</time></a> </div>
<div class="comment-content">
<p>Hi Daniel, very interesting work here from what I can understand. Question for you, does this finding have an effect on how data could be transmitted through cell towers to smart phones? Essentially I want to know if this finding implies it would be twice as easy to transmit let&rsquo;s say a youtube video to a mobile device? Where do you see the upper bounds of compression going in the near future compared to where it is today? Thanks.</p>
</div>
</li>
<li id="comment-55710" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-09-17T08:18:39+00:00">September 17, 2012 at 8:18 am</time></a> </div>
<div class="comment-content">
<p>@omar</p>
<p>1) Our work is mostly applicable to in-memory databases and search engines. If you are sending data over a network, then pure CPU decoding speed is less important. The goal is our work is to decode the data very, very fast even if it means having a lesser compression. That&rsquo;s because we assume that the data to be decoding is already in memory.</p>
<p>2) As for&#8230;</p>
<p><em>Where do you see the upper bounds of compression going in the near future compared to where it is today? </em></p>
<p>We can still improve matters quite a bit. Despite 40 years of research, there is still plenty of room to compress better and faster.</p>
</div>
</li>
<li id="comment-56220" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9036fdd3def5eae9979c02b3c99665df?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9036fdd3def5eae9979c02b3c99665df?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://grundprinzip.de" class="url" rel="ugc external nofollow">Martin</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-09-30T23:34:17+00:00">September 30, 2012 at 11:34 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,</p>
<p>I have a question with regard to what you mention in your paper for the binary packing algorithm by Willhalm et al. You say, that they need at least 11 assembly instructions and then you don&rsquo;t consider this at all anymore. However, my assumption would be that it&rsquo;s not only the number of instructions but as well their latency etc.</p>
<p>If I look at the results in their paper their decoding speed is at least the same as yours. </p>
<p>For 7 bit/int you get 2800 mis and Willhalm et al get ~300ms for 1000 mis =&gt; ~3000 mis.</p>
<p>Is there a specific reason you left it out in your observations? Or did I misunderstand something completely and their approach is simply not viable in your benchmark.</p>
<p>Thanks,<br/>
Martin</p>
</div>
</li>
<li id="comment-56240" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-01T08:21:42+00:00">October 1, 2012 at 8:21 am</time></a> </div>
<div class="comment-content">
<p>@Martin</p>
<p>If you want to deduce speed from their Figure 11, then you need to look at our Figure 8 for comparison. We reach 6000 mis on bit packing alone.</p>
<p>The numbers we report (outside our Fig. 8) *include* delta decoding which, as we stress in our paper, is a significant cost.</p>
</div>
</li>
<li id="comment-56242" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-01T08:35:50+00:00">October 1, 2012 at 8:35 am</time></a> </div>
<div class="comment-content">
<p>@Martin</p>
<p>Thank you for pointing it out. Yes, comparing just the number of assembly instructions is a bit naive. We might even need to implement this method in the future. Note, however, that</p>
<p>1) The latencies in Willhalm et al algorithms are same or higher. They are doing very similar things except that they have the shuffle operation and an additional memory access for the shuffle table. Essentially, their method is varint + a few extra masks and shifts. And we know that varint is slower.</p>
<p>2) As Daniel pointed out, the speeds are not directly comparable. I would elaborate on this. First, deltas can entail a significant cost. It is possible to incorporate them better, but this wasn&rsquo;t done in the current work and is planned for the follow up article. Second, their bit case is not equivalent to ours. They only decode integers that fit into B bits exactly. In our case, it is B bits ON AVERAGE. They did not implement switching about different bitcases in a single integer array.</p>
</div>
</li>
<li id="comment-56243" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-01T08:47:35+00:00">October 1, 2012 at 8:47 am</time></a> </div>
<div class="comment-content">
<p>@Martin </p>
<p>For bit widths less than 8, our unpacking speed is always higher than 6000 mis (see Fig. 8b) whereas they have half this speed (3300 mis) when the bit width is 6: indeed, they require 300 ms to unpack 1000 billion integers (see their Fig. 11). For a larger bit width (10), their speed falls to less than 2500 mis whereas our worse overall unpacking speed is 4000 mis.</p>
</div>
</li>
<li id="comment-56244" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9036fdd3def5eae9979c02b3c99665df?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9036fdd3def5eae9979c02b3c99665df?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://grundprinzip.de" class="url" rel="ugc external nofollow">Martin</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-01T08:52:12+00:00">October 1, 2012 at 8:52 am</time></a> </div>
<div class="comment-content">
<p>@Daniel, thanks for the clarification, this explains a lot since you are focussing on vertical processing instead of horizontal.</p>
</div>
</li>
<li id="comment-56245" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9036fdd3def5eae9979c02b3c99665df?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9036fdd3def5eae9979c02b3c99665df?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://grundprinzip.de" class="url" rel="ugc external nofollow">Martin</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-01T09:01:31+00:00">October 1, 2012 at 9:01 am</time></a> </div>
<div class="comment-content">
<p>@Itman, what I was missing from this picture was that I mis-read the part about vertical and horizontal bit packing. I&rsquo;m intrigued to try using vertical bit packing in our column store prototype and compare it to horizontal bit packing to see what happens.</p>
<p>Since I&rsquo;m a traditional In-Memory RDBMS guy, code length never change until we recompress the whole data partition.</p>
<p>It looks like there is some interesting meat left that one could look at 🙂</p>
<p>Thanks for the great read.</p>
</div>
</li>
<li id="comment-56256" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-01T11:43:42+00:00">October 1, 2012 at 11:43 am</time></a> </div>
<div class="comment-content">
<p>@Martin, no problem. Daniel made a good point: I suspect that Willhalm et al does not include storing and/or preprocessing costs into timings. Essentially, they should be decompressing into L1 and discard data at some point. We, in contrast, reported mostly very conservative estimates that included storing uncompressed integers. </p>
<p>Since memory is slow and you have to write 4-byte integers, this limits decoding speed. Data in Fig 8b represents a scenario that should be closer to that of Willhalm et al. We do read compressed integers from memory, but this is a small cost, because integers occupy one byte on average (you can read 20 billions per second on our machine). In this scenario, we are getting 5000-7000 mis.</p>
<p>Again, to remove all doubts we would need to implement this approach some day. Because, we are not doing it right away, we are curious to learn your results (should you decide and try vertical layout).</p>
</div>
</li>
<li id="comment-56419" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/966e33d2543b9ceeca0495887a0cbf99?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/966e33d2543b9ceeca0495887a0cbf99?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Todd Lipcon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-04T19:31:10+00:00">October 4, 2012 at 7:31 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel. Quick question: the README for the github source says the license is &ldquo;APL 2.0&rdquo;. Does this mean the &ldquo;Apache License 2.0&rdquo;?</p>
<p>Thanks<br/>
-Todd</p>
</div>
</li>
<li id="comment-56420" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-04T20:06:25+00:00">October 4, 2012 at 8:06 pm</time></a> </div>
<div class="comment-content">
<p>@Todd</p>
<p>Yes, that&rsquo;s what it means.</p>
</div>
</li>
<li id="comment-56556" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/216e922a9e4a5abea55716ea03334c13?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/216e922a9e4a5abea55716ea03334c13?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">JanPierres</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-06T03:24:29+00:00">October 6, 2012 at 3:24 am</time></a> </div>
<div class="comment-content">
<p>&ldquo;Update: D. Lemire believes that this scheme was patented by Rose, Stepanov et al. (patent 20120221539).</p>
<p>We wrote this code before the patent was published (August 2012)&rdquo;</p>
<p>does it make their patent useless?</p>
</div>
</li>
<li id="comment-56630" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-06T22:50:44+00:00">October 6, 2012 at 10:50 pm</time></a> </div>
<div class="comment-content">
<p>Hi JanPierres,</p>
<p>We found several teams that discovered this or a similar algorithm about the same time. This all happened before the patent obtained. You can check details in the paper.</p>
<p>Unfortunately, it is not clear how a patent would work in this case. Hopefully, it was defensive and they will not sue anybody for using this code. Otherwise, a judge will decide whether the patent is useless or not :-)))</p>
</div>
</li>
<li id="comment-56631" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-06T22:54:19+00:00">October 6, 2012 at 10:54 pm</time></a> </div>
<div class="comment-content">
<p>@JanPierres</p>
<p>Varint-G8IU is patented but not (as far as I can tell) the other schemes we use. Their paper appeared before the patent was granted. We implemented it without knowing about the patent for the purpose of comparing performance. </p>
<p>Regarding prior art, what matters is the filling date of the patent application. So anyone using varint-G8IU in a commercial application could be in for a lawsuit. That is why I included this warning.</p>
<p>With patents, you can play the following game: you apply for a patent, then entice people to use your work without telling them about the patent, and then once the patent is granted, you are free to require licensing and sue them.</p>
<p>Of course, I would not want anyone to get sued because I posted software online. But my warning should keep people safe.</p>
<p>I think that patents are evil. See </p>
<p>Do we need patents?<br/>
<a href="https://lemire.me/blog/archives/2012/01/06/do-we-need-patents/" rel="ugc">http://lemire.me/blog/archives/2012/01/06/do-we-need-patents/</a></p>
</div>
</li>
<li id="comment-56853" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a92863062c505f9216d0ad4c13b25143?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a92863062c505f9216d0ad4c13b25143?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">dg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-08T21:40:19+00:00">October 8, 2012 at 9:40 pm</time></a> </div>
<div class="comment-content">
<p>How does this PFOR implementation compare with LZ4 in terms of compression ratio and performance?</p>
<p><a href="https://code.google.com/p/lz4/" rel="nofollow ugc">http://code.google.com/p/lz4/</a></p>
</div>
</li>
<li id="comment-56862" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-08T22:45:54+00:00">October 8, 2012 at 10:45 pm</time></a> </div>
<div class="comment-content">
<p>@dg</p>
<p>I believe you can&rsquo;t really compare something generic like LZ4 with the integer compression schemes we review in this paper. However, because we expected this sort of question, we did benchmark Google Snappy and got that it was not usable for these purposes (see the paper for details). I expect the same conclusion to hold with LZ4.</p>
</div>
</li>
<li id="comment-64398" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/859fba845f1fcb23ced3ecd457cca7e4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/859fba845f1fcb23ced3ecd457cca7e4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://aleccolocco.blogspot.com" class="url" rel="ugc external nofollow">Alecco</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-07T11:12:23+00:00">January 7, 2013 at 11:12 am</time></a> </div>
<div class="comment-content">
<p>This is amazing! I wish more papers were like this.</p>
</div>
</li>
<li id="comment-251264" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ac3a8e317b6e738469c9c3034ee3df88?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ac3a8e317b6e738469c9c3034ee3df88?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Deep</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-01T10:17:22+00:00">September 1, 2016 at 10:17 am</time></a> </div>
<div class="comment-content">
<p>Can this be used for other datatypes such as double ?</p>
</div>
<ol class="children">
<li id="comment-251279" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-01T13:55:22+00:00">September 1, 2016 at 1:55 pm</time></a> </div>
<div class="comment-content">
<p>Yes, but I don&rsquo;t have code for this.</p>
</div>
</li>
</ol>
</li>
<li id="comment-282889" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/97cdaaaa61e5541b98a01bbdfbdcff09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/97cdaaaa61e5541b98a01bbdfbdcff09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Pascal S. de Kloe</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-05T17:18:47+00:00">July 5, 2017 at 5:18 pm</time></a> </div>
<div class="comment-content">
<p>I just published a new algorithm including a reference implementation in C and Go.<br/>
<a href="https://github.com/pascaldekloe/flit" rel="nofollow ugc">https://github.com/pascaldekloe/flit</a><br/>
Feedback is welcome!<br/>
<a href="https://news.ycombinator.com/item?id=14704158" rel="nofollow ugc">https://news.ycombinator.com/item?id=14704158</a></p>
</div>
</li>
</ol>
