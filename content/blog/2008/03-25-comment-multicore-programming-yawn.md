---
date: "2008-03-25 12:00:00"
title: "Multicore programming? Yawn!"
index: false
---

[5 thoughts on &ldquo;Multicore programming? Yawn!&rdquo;](/lemire/blog/2008/03-25-multicore-programming-yawn)

<ol class="comment-list">
<li id="comment-49804" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bbe0edf00e5e8600f01d5d8896a47008?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bbe0edf00e5e8600f01d5d8896a47008?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Maverick</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-03-25T10:55:01+00:00">March 25, 2008 at 10:55 am</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t know if I can agree that &ldquo;there is no upcoming multicore revolution in computer programming&rdquo;. I consider making parallel programming easier at the small scale a revolution in computer programming, just like the introduction of garbage collection into mainstream (by Java).</p>
<p>By small, I mean code that runs on a local machine and is not about intensive data processing. I guess &ldquo;client&rdquo; is a good characterization. For instance, many interactive applications can benefit from multicore but not yet, usually because the ability to multithread is not exposed at a suitably high level and so it doesn&rsquo;t get used until late in the game. However, I think all of us would enjoy some speedup here and there in our daily work on our laptops, no? </p>
<p>Intel, in particular, has made a good step in releasing the Thread Building Blocks that efficiently supports nested and irregular parallelism. TBB is what I would think of when I hear &ldquo;intel&rdquo; and &ldquo;multicore&rdquo;, and it most certainly is not about replacing OpenMP and MPI which are geared for high performance computing. (And now one can start talking about MapReduce and friends&#8230; but we are getting &ldquo;large&rdquo;, and at the large scale, I am with you.)</p>
<p>I should add that there is a common thread (pardon the pun!) among the parallel programming ideas large and small: expose the parallelism and let the scheduler worry about the actual scheduling. Now perhaps we can both agree that the only thing that have ever happened in computer programming is higher and yet higher level of programming. 😛</p>
</div>
</li>
<li id="comment-49805" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-03-25T12:21:07+00:00">March 25, 2008 at 12:21 pm</time></a> </div>
<div class="comment-content">
<p><i> I don&rsquo;t know if I can agree that &ldquo;there is no upcoming multicore revolution in computer programming&rdquo;. I consider making parallel programming easier at the small scale a revolution in computer programming, just like the introduction of garbage collection into mainstream (by Java).</i></p>
<p>By the Spolsky&rsquo;s principle of leaking abstractions, I don&rsquo;t think we can ever expect &ldquo;small scale parallel programming&rdquo; to be ever as easy as Java&rsquo;s garbage collection. </p>
<p><i> However, I think all of us would enjoy some speedup here and there in our daily work on our laptops, no?</i></p>
<p>There is no question that some client software is CPU-bound. Video games and image processing software are examples. We might see a revolution in video editing tools, for example. I can imagine live 3D rendering with a photo-quality. The Playstation 3 has what? 7 cores? I would not think of designing a gaming engine without thinking about multicore CPUs.</p>
</div>
</li>
<li id="comment-49808" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/95b946433b8244f61818d58bdf9461b8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/95b946433b8244f61818d58bdf9461b8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-03-25T19:22:41+00:00">March 25, 2008 at 7:22 pm</time></a> </div>
<div class="comment-content">
<p>&gt; By the Spolsky&rsquo;s principle of leaking abstractions, I don&rsquo;t think we can ever expect â€œsmall scale parallel programmingâ€ to be ever as easy as Java&rsquo;s garbage collection.</p>
<p>Ever tried Erlang?</p>
</div>
</li>
<li id="comment-49814" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michael B</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-03-28T04:32:31+00:00">March 28, 2008 at 4:32 am</time></a> </div>
<div class="comment-content">
<p>Well I agree with you that revolution is nonsense, even if it where only for the fact that it&rsquo;s evolution.</p>
</div>
</li>
<li id="comment-49914" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/706f14bf25ce0a0331b4e5d880416ad3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/706f14bf25ce0a0331b4e5d880416ad3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://ninjamonkeys.co.za" class="url" rel="ugc external nofollow">Vaughn</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-05-16T07:51:50+00:00">May 16, 2008 at 7:51 am</time></a> </div>
<div class="comment-content">
<p>No multi-core revolution in enterprise, but there&rsquo;s definitely one in multimedia processing. Just look at the speed-ups the Cell processor in the Playstation 3 can get in signal and graphics processing when used correctly.</p>
</div>
</li>
</ol>
