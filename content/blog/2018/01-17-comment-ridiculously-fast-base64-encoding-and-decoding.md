---
date: "2018-01-17 12:00:00"
title: "Ridiculously fast base64 encoding and decoding"
index: false
---

[13 thoughts on &ldquo;Ridiculously fast base64 encoding and decoding&rdquo;](/lemire/blog/2018/01-17-ridiculously-fast-base64-encoding-and-decoding)

<ol class="comment-list">
<li id="comment-295149" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c8004a09a1f62cf51330dc068cd4913a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c8004a09a1f62cf51330dc068cd4913a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://dubing.me" class="url" rel="ugc external nofollow">Bingo Du</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-18T10:43:37+00:00">January 18, 2018 at 10:43 am</time></a> </div>
<div class="comment-content">
<p>Wonderful results!</p>
</div>
</li>
<li id="comment-295152" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b44794299e70f2e798a74378c05cd2ed?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b44794299e70f2e798a74378c05cd2ed?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://www.idiommaster.com/" class="url" rel="ugc external nofollow">Translate</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-18T11:32:55+00:00">January 18, 2018 at 11:32 am</time></a> </div>
<div class="comment-content">
<p>Thanks, inspiring article!</p>
</div>
</li>
<li id="comment-295173" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a48f336120d4aa7be494df22a8df0544?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a48f336120d4aa7be494df22a8df0544?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.yosoygames.com.ar" class="url" rel="ugc external nofollow">Matias N. Goldberg</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-18T23:42:42+00:00">January 18, 2018 at 11:42 pm</time></a> </div>
<div class="comment-content">
<p>Great job!</p>
<p>But you should warn about the use of AVX2.<br/>
Unfortunately, the use of AVX2 severely throttles the CPU, which can cause system-wide performance issues as it affects other processes.</p>
<p>See <a href="https://blog.cloudflare.com/on-the-dangers-of-intels-frequency-scaling/" rel="nofollow ugc">https://blog.cloudflare.com/on-the-dangers-of-intels-frequency-scaling/</a></p>
<p>Nonetheless, great job pointing out it can be done better!</p>
</div>
<ol class="children">
<li id="comment-295228" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-19T14:44:33+00:00">January 19, 2018 at 2:44 pm</time></a> </div>
<div class="comment-content">
<p><em>But you should warn about the use of AVX2.</em></p>
<p>The paper is called: &ldquo;Faster Base64 Encoding and Decoding Using AVX2 Instructions&rdquo;.</p>
<p><em>Unfortunately, the use of AVX2 severely throttles the CPU, which can cause system-wide performance issues</em></p>
<p>Intel reduces the turbo frequency depending on the instruction mix. On Skylake X, AVX-512 instructions have a greater effect than AVX2 instructions with multiplications and floating points. Simple AVX2 instructions can be used without any reduction to the turbo frequency. The effect is tiny on processors having few active cores (e.g. 4), unlikely to be measurable, but it is larger on wide chips with many active cores (e.g., 28).</p>
<p>If you have a chip with many active cores (much more than 4) and if you have a CPU heavy load, and if AVX-512 does not accelerate the computation much, then you can get a negative outcome. This is discussed in Intel&rsquo;s optimization manual.</p>
<p>The link you refer to is in this scenario, they have 24-core processors, with all cores active, and they use AVX-512 instructions. </p>
</div>
<ol class="children">
<li id="comment-295374" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-21T19:44:57+00:00">January 21, 2018 at 7:44 pm</time></a> </div>
<div class="comment-content">
<p>To be fair to the grandparent poster, the &ldquo;normal&rdquo; frequency of almost any recent Intel chip is totally irrelevant. The chip almost never runs at that speed. It&rsquo;s almost always either &ldquo;off&rdquo; (in some non-zero C-state), running at minimum frequency (i.e,. most efficient freq, usually at Vmin around 500-1000Mhz), or running at maximum turbo frequency. Rarely you&rsquo;ll find it running at other frequencies between min up to including normal, which usually happens during workload transition.</p>
<p>&ldquo;Normal&rdquo; (the frequency printed on the box) isn&rsquo;t at all special here in terms of how often that&rsquo;s used your chip probably runs at &ldquo;normal&rdquo; frequency less than 1% of the time. If you want to know how fast your CPU will run something, the turbo frequency is essentially the only number you need to know (and the turbo ratio rable for multiple running cores, unfortunately).</p>
<p>Intel puts it on the box, probably for historical reasons and because of the confusing aspect of the turbo ration depending on the number of running CPUs, so for my 4-core CPU they can either say &ldquo;2.6 GHz&rdquo; or &ldquo;3.5/3.4/3.3/3.2 GHz&rdquo;, and for a 28-core CPU, well&#8230;</p>
<p>Intel also positions the normal frequency as a the &ldquo;guaranteed&rdquo; frequency, but in practice this has almost no meaning today: except in very small form factors or with very poor cooling you&rsquo;ll generally run at the max turbo indefinitely, and if you get hot enough or draw too much current you can go below normal anyways, so essentially all frequencies are &ldquo;if conditions permit&rdquo;.</p>
<p>Historically and still to some extent today, the normal frequency was important for the power management API the chip offers: they expose the ability to the OS to adjust the frequency between the min and normal frequencies, so normal was relevant there &#8211; for turbo speeds you had to let the hardware take control. Later on the chips offered more control over turbo rations too, but the interface (i.e., what MSRs you write and what you write) was totally different. These days the recommended mode of operation is &ldquo;HWP&rdquo; which is hardware performance management, essentially giving the CPU control over the whole frequency range (the P-states), so that distinction has most disapeared.</p>
<p>I wanted to comment on the AVX2/AVX512 throttling too, since I think there is some misunderstanding above, but this is already long enough&#8230; 🙂</p>
<p>I&rsquo;m happy to add that part later if anyone is interested.</p>
</div>
</li>
</ol>
</li>
<li id="comment-295510" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-24T01:11:58+00:00">January 24, 2018 at 1:11 am</time></a> </div>
<div class="comment-content">
<p>Another question is&#8230; how certain are we that our software does not already use AVX instructions?</p>
</div>
<ol class="children">
<li id="comment-295513" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-24T02:06:33+00:00">January 24, 2018 at 2:06 am</time></a> </div>
<div class="comment-content">
<p>It is pretty easy to prevent the compiler from emitting AVX2 in <i>code you are compiling</i> with the appropriate compiler flags, but that&rsquo;s only part of the story &#8211; you also have to check any third party libraries you use, especially the C and C++ standard libraries which almost everyone uses.</p>
<p>The C library especially is almost always implemented with AVX2 for methods like memcpy, and you&rsquo;ll often get these faster methods even if you didn&rsquo;t compile with AVX2 flags (or even if you compiled before AVX2 existed) through the magic of runtime dispatch (including the runtime linker IFUNC magic).</p>
<p>Finally, even interrupts or other processes running on the same CPU (including at the same time on the sibling hyperthread) might decide to use AVX2, slowing down your whole CPU (the interrupt case is admittedly a bit of a stretch!).</p>
</div>
<ol class="children">
<li id="comment-295514" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-24T02:12:05+00:00">January 24, 2018 at 2:12 am</time></a> </div>
<div class="comment-content">
<p>Right. Java certainly JIT compile code to use AVX if it detects that the processor supports it.</p>
</div>
<ol class="children">
<li id="comment-295515" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-24T02:34:57+00:00">January 24, 2018 at 2:34 am</time></a> </div>
<div class="comment-content">
<p>Exactly, which is one of the tick marks in the column for &ldquo;how a runtime-interpreted language like Java can be faster than a native compiled language like C&rdquo;. That is, it can use CPU instructions that weren&rsquo;t even invented when the source was compiled!</p>
</div>
<ol class="children">
<li id="comment-295840" class="comment odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d76b4b3ba7daf871cc03a6037fbaa019?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d76b4b3ba7daf871cc03a6037fbaa019?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alex</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-30T13:32:49+00:00">January 30, 2018 at 1:32 pm</time></a> </div>
<div class="comment-content">
<p>Good point, that never occurred to me!</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-295196" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6ac61630880576ab7c9539ec4ab6c510?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6ac61630880576ab7c9539ec4ab6c510?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mica</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-19T07:15:35+00:00">January 19, 2018 at 7:15 am</time></a> </div>
<div class="comment-content">
<p>Hi Daniel</p>
<p>It would be really GREAT if you can make a &ldquo;SIMD tutorial&rdquo; for new comers.</p>
<p>As you said, there very little information about how to use SIMD in practice.</p>
<p>And please, if you decide to do so use &ldquo;C&rdquo; for simplicity 🙂</p>
<p>Best<br/>
Mica</p>
</div>
<ol class="children">
<li id="comment-295255" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-19T22:09:04+00:00">January 19, 2018 at 10:09 pm</time></a> </div>
<div class="comment-content">
<p>I agree Mica.</p>
</div>
</li>
</ol>
</li>
<li id="comment-427729" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9079ccc1a0202b592c2154c4a23aea92?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9079ccc1a0202b592c2154c4a23aea92?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Amit Dhingra</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-19T05:07:51+00:00">September 19, 2019 at 5:07 am</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,</p>
<p>Is sending images and video files in base64 format in the html file through webAPI is a good approach in comparison with sending html,images,videos all in a zip file ?</p>
</div>
</li>
</ol>
