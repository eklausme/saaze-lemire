---
date: "2012-03-06 12:00:00"
title: "How fast is bit packing?"
index: false
---

[18 thoughts on &ldquo;How fast is bit packing?&rdquo;](/lemire/blog/2012/03-06-how-fast-is-bit-packing)

<ol class="comment-list">
<li id="comment-55034" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3ccaf45d7ab8ecc0e412fe911c9b9d10?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3ccaf45d7ab8ecc0e412fe911c9b9d10?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">John Regehr</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-06T22:40:35+00:00">March 6, 2012 at 10:40 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m missing something&#8230; how is packing 32-bit integers into 17 bits a savings of 90%? It sounds closer to 50%.</p>
</div>
</li>
<li id="comment-55035" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-06T22:46:41+00:00">March 6, 2012 at 10:46 pm</time></a> </div>
<div class="comment-content">
<p>@John </p>
<p>Well. I have that 32/17 &#8211; 1 is 90%. But I grant you that it is less confusing to say 50%, so I have updated my blog post accordingly.</p>
</div>
</li>
<li id="comment-55037" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/133e7795e156f59835b90f0376a69b3a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/133e7795e156f59835b90f0376a69b3a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jay Stein</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-07T10:25:12+00:00">March 7, 2012 at 10:25 am</time></a> </div>
<div class="comment-content">
<p>Please see my US patent no. 5,602,550, filed in 1995, granted in 1997, which describes a complete implementation of an adaptive compression utilizing bit packing, but also allowing for bit packing of deltas between successive values. This algorithm was built for speed.</p>
</div>
</li>
<li id="comment-55038" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4adeef4094cef099575b60cec053d382?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4adeef4094cef099575b60cec053d382?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://nklein.com/" class="url" rel="ugc external nofollow">Patrick Stein</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-07T11:05:05+00:00">March 7, 2012 at 11:05 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m missing something here. I was hoping to see a speed comparison between bit-packing and not bit-packing.</p>
<p>Given an array of k-bit integers stored in 32-bit integers, how long does it take to copy that array? how long does it take to pack that array? how long does it take to unpack the packed array?</p>
</div>
</li>
<li id="comment-55039" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-07T11:16:13+00:00">March 7, 2012 at 11:16 am</time></a> </div>
<div class="comment-content">
<p>@Patrick</p>
<p><em>I&rsquo;m missing something here. I was hoping to see a speed comparison between bit-packing and not bit-packing.</em></p>
<p>You get the non-packed approach when <em>bit</em> is set to 32.</p>
<p>Don&rsquo;t forget that my source code is available (see link) so you can run your own tests if you want!</p>
</div>
</li>
<li id="comment-55040" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4adeef4094cef099575b60cec053d382?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4adeef4094cef099575b60cec053d382?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://nklein.com" class="url" rel="ugc external nofollow">Patrick Stein</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-07T11:45:34+00:00">March 7, 2012 at 11:45 am</time></a> </div>
<div class="comment-content">
<p>Indeed. You even mention that in a part I skimmed through before. Thank you.</p>
</div>
</li>
<li id="comment-55041" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/30d6b6f4c0c25f26bb58cefdf01d4285?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/30d6b6f4c0c25f26bb58cefdf01d4285?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marsh Ray</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-07T13:02:13+00:00">March 7, 2012 at 1:02 pm</time></a> </div>
<div class="comment-content">
<p>It would be relevant to know how many numbers are in the data set being packed or unpacked, and compare that to no packing at all. Cache effects are likely to dominate above various sizes.</p>
<p>@Jay Stein &#8211; The only proper response to that is: <em>(rude language censored by D. Lemire)</em> go crawl back under the rock you came from software patenter.</p>
</div>
</li>
<li id="comment-55042" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/70a2c3f28ce878d1203dafd6f8ef8c8d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/70a2c3f28ce878d1203dafd6f8ef8c8d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">zav</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-07T22:56:20+00:00">March 7, 2012 at 10:56 pm</time></a> </div>
<div class="comment-content">
<p>The first word of your article is spelled wrong. </p>
<p>That&rsquo;s when I stop reading.</p>
</div>
</li>
<li id="comment-55043" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/19786e3e672151242c1952988d33483b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/19786e3e672151242c1952988d33483b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">David</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-08T00:06:26+00:00">March 8, 2012 at 12:06 am</time></a> </div>
<div class="comment-content">
<p>What a shame, zav. Most compilers are sophisticated enough to continue parsing even in the presence of syntax errors.</p>
<p>P.S. I think you meant &ldquo;stopped,&rdquo; not &ldquo;stop.&rdquo;</p>
</div>
</li>
<li id="comment-55044" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-08T09:27:20+00:00">March 8, 2012 at 9:27 am</time></a> </div>
<div class="comment-content">
<p>@zav </p>
<p>I fixed the typo. Thanks for reporting it.</p>
</div>
</li>
<li id="comment-55045" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/70a2c3f28ce878d1203dafd6f8ef8c8d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/70a2c3f28ce878d1203dafd6f8ef8c8d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">zav</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-08T09:49:47+00:00">March 8, 2012 at 9:49 am</time></a> </div>
<div class="comment-content">
<p>Thanks Dan. I&rsquo;m sure I&rsquo;ll love your article. Will check it out later on today. </p>
<p>Cheers.</p>
</div>
</li>
<li id="comment-55047" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/133e7795e156f59835b90f0376a69b3a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/133e7795e156f59835b90f0376a69b3a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jay Stein</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-08T12:22:25+00:00">March 8, 2012 at 12:22 pm</time></a> </div>
<div class="comment-content">
<p>@Marsh Ray &#8211; My compression algorithm was patented by the company where I was employed at the time. I did not think it was worth wasting anyone&rsquo;s time explaining that detail. The patent application is a publicly available explanation of the algorithm, which is relevant to the current discussion, unlike your trolling.</p>
</div>
</li>
<li id="comment-55048" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/70a2c3f28ce878d1203dafd6f8ef8c8d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/70a2c3f28ce878d1203dafd6f8ef8c8d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">zav</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-09T09:41:50+00:00">March 9, 2012 at 9:41 am</time></a> </div>
<div class="comment-content">
<p>Jay, would love to check out your patent. I&rsquo;ve been fascinated with the potential for this since 1995 while investigating systems and methods for storing quantized delta frames in video streams. None of my PAs are as fundamental. </p>
<p>David, this is nice. Wish I had time to play with this at the moment. Thanks for the source and the correction. Cheers.</p>
</div>
</li>
<li id="comment-55049" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/127a6fe13f712497547aeb2d175698cc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/127a6fe13f712497547aeb2d175698cc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michele Filannino</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-09T10:51:54+00:00">March 9, 2012 at 10:51 am</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,</p>
<p>this is my graph:<br/>
<a href="https://dl.dropbox.com/u/265383/bit_packing.png" rel="nofollow ugc">http://dl.dropbox.com/u/265383/bit_packing.png</a></p>
<p>It seems the opposite of that one showed in the post. What do you think?</p>
<p>Bye,<br/>
michele.</p>
</div>
</li>
<li id="comment-55050" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-09T11:03:15+00:00">March 9, 2012 at 11:03 am</time></a> </div>
<div class="comment-content">
<p>@michele</p>
<p>Interesting. Can you give me some details, like processor type, compiler and so on?</p>
</div>
</li>
<li id="comment-55052" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-12T08:55:36+00:00">March 12, 2012 at 8:55 am</time></a> </div>
<div class="comment-content">
<p>Michele,</p>
<p>It is not quite the opposite. The trend is the same:<br/>
1) There is very little difference between unpacked and packed readings<br/>
2) Some packed reads are more (though only slightly) efficient than unpacked ones.</p>
</div>
</li>
<li id="comment-55053" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-12T09:06:25+00:00">March 12, 2012 at 9:06 am</time></a> </div>
<div class="comment-content">
<p>@itman @michele</p>
<p>If you look closely at my code, you&rsquo;ll notice that I use a lot of loops that can and should probably be unrolled. I actually leave them rolled when it makes sense so that the compiler has more options (compilers don&rsquo;t typically &ldquo;roll back&rdquo; loops that were manually unrolled). </p>
<p>Anyhow. I adjusted the code until it looked like I got optimal results with GCC 4.6 and my particular hardware. Because Michele is using GCC 4.2, I am not surprised that the results differ. </p>
<p>However, even with GCC 4.2, it might be possible tweak the results with the proper optimization flags.</p>
<p>As you say @itman, the results are not really all that different. But it is nice to see independent tests.</p>
</div>
</li>
<li id="comment-55056" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/82301ed8aa65de5383cd5907257a0118?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/82301ed8aa65de5383cd5907257a0118?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Frederico Schardong</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-16T11:25:36+00:00">March 16, 2012 at 11:25 am</time></a> </div>
<div class="comment-content">
<p>Very nice post!</p>
<p>I&rsquo;m implementing the same idea, in C and in fewer lines. The code is here: pastebin.com/SfEkqKnv</p>
<p>Please take a look and if you want to help me I&rsquo;ll appreciate that. 🙂</p>
<p>I&rsquo;m having errors.. eg packing at 32 int variable numbers less than 17 are fine but when its greater than 16 it doesn&rsquo;t work well&#8230; I don&rsquo;t know what&rsquo;s the problem, will appreciate any help.</p>
<p>frede dot sch at gmail dot com</p>
</div>
</li>
</ol>
