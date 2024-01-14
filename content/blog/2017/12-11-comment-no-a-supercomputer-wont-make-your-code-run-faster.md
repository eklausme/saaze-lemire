---
date: "2017-12-11 12:00:00"
title: "No, a supercomputer won&#8217;t make your code run faster"
index: false
---

[12 thoughts on &ldquo;No, a supercomputer won&#8217;t make your code run faster&rdquo;](/lemire/blog/2017/12-11-no-a-supercomputer-wont-make-your-code-run-faster)

<ol class="comment-list">
<li id="comment-293317" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/12ea44e05fa256ee19c888a00ce1dbb9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/12ea44e05fa256ee19c888a00ce1dbb9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Raju</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-12T02:30:48+00:00">December 12, 2017 at 2:30 am</time></a> </div>
<div class="comment-content">
<p>It would be more interesting if you could please provide some specific examples and how you narrowed it down to a single dependency and/or a specific function. Were you using a profiler to determine the bottleneck? Can the techniques be automated? For example, is there a tool that can take &ldquo;too slow&rdquo; code and make it &ldquo;really fast&rdquo;?</p>
</div>
<ol class="children">
<li id="comment-293320" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-12T03:06:34+00:00">December 12, 2017 at 3:06 am</time></a> </div>
<div class="comment-content">
<p>I have updated my blog post with more concrete recommendations and examples.</p>
</div>
<ol class="children">
<li id="comment-293356" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/12ea44e05fa256ee19c888a00ce1dbb9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/12ea44e05fa256ee19c888a00ce1dbb9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Raju</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-12T15:10:56+00:00">December 12, 2017 at 3:10 pm</time></a> </div>
<div class="comment-content">
<p>Thank you very much. That is helpful.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-293322" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-12T03:16:42+00:00">December 12, 2017 at 3:16 am</time></a> </div>
<div class="comment-content">
<p>Great point. And one should take into account that a supercomputer nowadays is usually just a bunch of loosely connected GPUs or CPUs residing in different boxes. Not only I would disagree with your claim that ||-ion is easy, I would say it is super hard. For example, by taking a framework like MapReduce and running your || code can easily take longer or equivalent amount of time. The problem is that once you have loosely connected computing units, communication becomes an annoying bottleneck.</p>
</div>
<ol class="children">
<li id="comment-293325" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-12T05:17:16+00:00">December 12, 2017 at 5:17 am</time></a> </div>
<div class="comment-content">
<p>Parallel processing is sometimes easy because other people made it easy for us.</p>
</div>
</li>
</ol>
</li>
<li id="comment-293323" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-12T03:20:29+00:00">December 12, 2017 at 3:20 am</time></a> </div>
<div class="comment-content">
<p>PS: regarding the joys of ||-zation, there is a good joke: knock-knock, race condition, who&rsquo;s there?</p>
</div>
</li>
<li id="comment-293332" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/35649daef66e6333c9869a3a680c7dc9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/35649daef66e6333c9869a3a680c7dc9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Vishal Belsare</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-12T08:02:26+00:00">December 12, 2017 at 8:02 am</time></a> </div>
<div class="comment-content">
<p>&ldquo;Some software libraries are clever and do this work for youâ€¦ but if you wrote your code without care for performance, it is likely you did not select these clever libraries.&rdquo;</p>
<p>Daniel, can you please mention the clever libraries you referred to? Would be helpful to know.</p>
</div>
<ol class="children">
<li id="comment-293350" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-12T13:56:09+00:00">December 12, 2017 at 1:56 pm</time></a> </div>
<div class="comment-content">
<p>I am not sure it is of general interest, but here are some examples.</p>
<p>Under R, the &lsquo;boot&rsquo; package makes it really easy to parallelize the processing, one just needs to add a flag.</p>
<p>In Python, some <tt>numpy</tt> automatically parallelize (e.g., <tt>numpy.dot</tt>).</p>
<p>And so forth.</p>
</div>
</li>
</ol>
</li>
<li id="comment-293357" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6f48bcd42389d61e55a498beadec410e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6f48bcd42389d61e55a498beadec410e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Yaakov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-12T15:19:01+00:00">December 12, 2017 at 3:19 pm</time></a> </div>
<div class="comment-content">
<p>At one place I worked we had a data-crunching program that we thought ran reasonably well and took 45 minutes. In the process of adding a feature, a coworker cleaned up the code (mostly rearranging do loops and the like). Afterwards the program ran in 3 minutes &#8212; surprised everyone, including the coworker.</p>
</div>
</li>
<li id="comment-293619" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f0c06152522e0913232fc5178661dfdf?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f0c06152522e0913232fc5178661dfdf?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://chakpak.blogspot.in" class="url" rel="ugc external nofollow">Rohit Karlupia</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-16T12:21:49+00:00">December 16, 2017 at 12:21 pm</time></a> </div>
<div class="comment-content">
<p>Same is true for Spark. <a href="https://lnkd.in/fCsrKXj" rel="nofollow ugc">https://lnkd.in/fCsrKXj</a></p>
</div>
</li>
<li id="comment-293656" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ed27920a4ec4445d0e390a30df7145d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ed27920a4ec4445d0e390a30df7145d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://nkprince007.github.io" class="url" rel="ugc external nofollow">Naveen Kumar Sangi</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-17T01:52:35+00:00">December 17, 2017 at 1:52 am</time></a> </div>
<div class="comment-content">
<p>Usage of modern languages like Go and Rust, where memory management and concurrency is built-in is the best way to go for new projects. Also note that parallelism is not the only way for concurrency. Simple goroutines can bring about a lot of performance gain.</p>
</div>
</li>
<li id="comment-544875" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0839ac88cafe51cbe9112ccbbdb166ca?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0839ac88cafe51cbe9112ccbbdb166ca?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://akunidpro.vip/" class="url" rel="ugc external nofollow">Gaple online</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-25T06:16:54+00:00">July 25, 2020 at 6:16 am</time></a> </div>
<div class="comment-content">
<p>Ivey raises pre-flop through the button to 150,000 and<br/>
gets re-raised to 460,000. So if you&rsquo;re dealt so named &ldquo;suited connectors&rdquo; as the hole cards (two cards of the same<br/>
suit close to the other, say a nine and ten of hearts) and<br/>
hit three more hearts you&rsquo;re in a good position of strength.</p>
<p>Since it is a computerized game, and lacks real human intervention within the shuffling and<br/>
dealing, they need to use a software package for the job<br/>
of your poker dealer.</p>
</div>
</li>
</ol>
