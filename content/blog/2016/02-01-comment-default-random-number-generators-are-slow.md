---
date: "2016-02-01 12:00:00"
title: "Default random-number generators are slow"
index: false
---

[13 thoughts on &ldquo;Default random-number generators are slow&rdquo;](/lemire/blog/2016/02-01-default-random-number-generators-are-slow)

<ol class="comment-list">
<li id="comment-225001" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f9ed6413b67cfa6ddc0a37675d9e065a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f9ed6413b67cfa6ddc0a37675d9e065a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Stefano</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-02-02T08:23:41+00:00">February 2, 2016 at 8:23 am</time></a> </div>
<div class="comment-content">
<p>Choosing the correct pseudo-random number generator for a Monte Carlo simulation requires a careful analysis, but as a rule of thumb linear congruential generators (LCG) are inadequate. (At least if you are doing computational science, and not video games. This is not because computational science is a more noble endeavour than video game developing: the simulation of physical systems has different requirements than the simulation of a synthetic world. ) </p>
<p>Moreover LCGs are unsuitable for cryptographic applications. </p>
<p>In my opinion the real question is not whether the default pseudo-random generator is fast enough, but whether it is good enough for your application.</p>
</div>
<ol class="children">
<li id="comment-225047" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-02-02T16:21:21+00:00">February 2, 2016 at 4:21 pm</time></a> </div>
<div class="comment-content">
<p>What are your thoughts on PCG? </p>
<p><a href="http://www.pcg-random.org/" rel="nofollow ugc">http://www.pcg-random.org/</a></p>
<p>I have included PCG in my benchmark but not in my post. It is quite fast.</p>
</div>
<ol class="children">
<li id="comment-225243" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f9ed6413b67cfa6ddc0a37675d9e065a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f9ed6413b67cfa6ddc0a37675d9e065a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stefano</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-02-03T22:08:01+00:00">February 3, 2016 at 10:08 pm</time></a> </div>
<div class="comment-content">
<p>Sound interesting, but I do not have hands on experience. (Disclaimer: my background is in computational science and engineering, but I&rsquo;ve never run large scale Monte Carlo simulations. Speed never was my main concern&#8230; but this depends of the applications in my area of interest.)</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-225035" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/648cbb3135d4aa4ca7fc2a7849d7acd2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/648cbb3135d4aa4ca7fc2a7849d7acd2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://cs.coloradocollege.edu/~bylvisaker/" class="url" rel="ugc external nofollow">Ben</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-02-02T13:34:20+00:00">February 2, 2016 at 1:34 pm</time></a> </div>
<div class="comment-content">
<p>This kind of thing is exactly why I think threads should be used approximately never by applications. Non-parallel abstractions (events, coroutines, coop threads, etc) for multitasking, and pools of worker processes for parallelism! That way be default you never have to worry about the memory nightmares that lead to by-default thread safe RNGs.</p>
</div>
<ol class="children">
<li id="comment-225048" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-02-02T16:22:16+00:00">February 2, 2016 at 4:22 pm</time></a> </div>
<div class="comment-content">
<p>Go has also a slow default random number generator. I focused on Java because it is a more popular language&#8230; but the problem is not limited to Java&#8230;</p>
</div>
<ol class="children">
<li id="comment-225183" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/648cbb3135d4aa4ca7fc2a7849d7acd2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/648cbb3135d4aa4ca7fc2a7849d7acd2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://cs.coloradocollege.edu/~bylvisaker/" class="url" rel="ugc external nofollow">Ben</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-02-03T13:52:53+00:00">February 3, 2016 at 1:52 pm</time></a> </div>
<div class="comment-content">
<p>Goroutines are just dressed-up threads. The Go community promotes a CSP style of programming with channels, but you can share memory between goroutines and get data races just like you can in Java or C (or almost any other popular language these days).</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-225128" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a55b2c872b332e48db6d1de4936f7011?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a55b2c872b332e48db6d1de4936f7011?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stefano</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-02-03T06:51:28+00:00">February 3, 2016 at 6:51 am</time></a> </div>
<div class="comment-content">
<p>In mono-threaded env. i&rsquo;ve used XorShift1024* and i&rsquo;ve tested it with a bloom filter of 800Mil elem Precision 0.000001f and it&rsquo;s seems real fast and good enough to not create clash: or not?</p>
</div>
</li>
<li id="comment-225185" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/562d5315600be7859bae7240b06a3530?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/562d5315600be7859bae7240b06a3530?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Viktor Szathmary</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-02-03T13:55:24+00:00">February 3, 2016 at 1:55 pm</time></a> </div>
<div class="comment-content">
<p>You should give ThreadLocalRandom a try 🙂</p>
</div>
<ol class="children">
<li id="comment-225230" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-02-03T18:00:44+00:00">February 3, 2016 at 6:00 pm</time></a> </div>
<div class="comment-content">
<p>Excellent. I have updated my blog post and credited you with this important observation.</p>
<p>It does not change the message of my blog post, but it does point the programmers in a useful direction.</p>
</div>
</li>
</ol>
</li>
<li id="comment-226817" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fc3b290038a97f5df6fec7660c357ef4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fc3b290038a97f5df6fec7660c357ef4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.k2r.org/kenji/" class="url" rel="ugc external nofollow">Kenji Rikitake</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-02-15T17:03:06+00:00">February 15, 2016 at 5:03 pm</time></a> </div>
<div class="comment-content">
<p>Does the &ldquo;concurrent random number generator&rdquo; mean the one which *locks* the seed or the internal state every time during the computation? That might be *very* slow. I would appreciate if you could clarify this. Giving independent seeds for each threads would not cause this locking overhead. </p>
<p>FYI, Erlang/OTP PRNGs in rand module has three algorithms: Xorshift116+ as default, Xorshift64* and Xorshift1024* are the other choices. Seeds must be given explicitly, or chosen to use the one stored in the process dictionary (a per-process storage area). Note in Erlang processes are roughly equivalent to C or Java threads, but each process has its own dictionary, not sharable with other processes.</p>
</div>
<ol class="children">
<li id="comment-226845" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-02-15T19:08:18+00:00">February 15, 2016 at 7:08 pm</time></a> </div>
<div class="comment-content">
<p>Yes. I think that Java locks the seeds, effectively. Other languages like Go do the same.</p>
</div>
</li>
</ol>
</li>
<li id="comment-227507" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d32f9c43d730bec85b7021a80ad492ac?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d32f9c43d730bec85b7021a80ad492ac?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jesper Louis Andersen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-02-18T16:01:28+00:00">February 18, 2016 at 4:01 pm</time></a> </div>
<div class="comment-content">
<p>Another point, which can be important for a PRNG is the ability to split it. That is, support a function `split : rngstate -&gt; rngstate * rngstate` which produces a fork in the RNG seed at that state.</p>
<p>This allows you to carry out concurrent work but recreate the original state from a seed, since you can use this to handle non-determinism. And it allows you to use the same RNG for a binary tree, but cut off a subtree without having to roll forward the RNG state. You just split at each node.</p>
<p>Some libraries, notably those who provide tooling for property-based-testing are extremely reliant on such a splitting function in the PRNG they use.</p>
</div>
<ol class="children">
<li id="comment-227516" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-02-18T16:29:34+00:00">February 18, 2016 at 4:29 pm</time></a> </div>
<div class="comment-content">
<p>Interesting. Can you elaborate? Which libraries rely on splitting?</p>
</div>
</li>
</ol>
</li>
</ol>
