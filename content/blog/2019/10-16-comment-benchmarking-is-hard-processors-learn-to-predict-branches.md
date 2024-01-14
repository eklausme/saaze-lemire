---
date: "2019-10-16 12:00:00"
title: "Benchmarking is hard: processors learn to predict branches"
index: false
---

[11 thoughts on &ldquo;Benchmarking is hard: processors learn to predict branches&rdquo;](/lemire/blog/2019/10-16-benchmarking-is-hard-processors-learn-to-predict-branches)

<ol class="comment-list">
<li id="comment-431779" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-16T13:04:21+00:00">October 16, 2019 at 1:04 pm</time></a> </div>
<div class="comment-content">
<p>So, the branch predictor incrementally learns a 2000-iteration branch sequence to a pretty high level of accuracy? I must say I&rsquo;m curious about the internal state and evolution of this machinery. I suppose Intel doesn&rsquo;t really provide much public details on it, could it be a Hopfield network or something similar, maybe mixing in some stochastic evolution?</p>
</div>
<ol class="children">
<li id="comment-431780" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-16T13:12:19+00:00">October 16, 2019 at 1:12 pm</time></a> </div>
<div class="comment-content">
<p>I have updated my post with numbers from AMD Rome.</p>
</div>
<ol class="children">
<li id="comment-431783" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-16T13:32:28+00:00">October 16, 2019 at 1:32 pm</time></a> </div>
<div class="comment-content">
<p>I suppose AMD has advertised their branch predictor using &ldquo;neural network&rdquo; in its operation &#8211; which on this kind of silicon would probably be more of a perceptron type than those tensor engines that hyped up NNs are nowadays.</p>
</div>
<ol class="children">
<li id="comment-431786" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-16T13:50:03+00:00">October 16, 2019 at 1:50 pm</time></a> </div>
<div class="comment-content">
<p>Oddly, they are using that ever before the current ML hype. On their recent chips they are also using TAGE, but still have the perception too – it isn&rsquo;t clear to me what is responsible for what and if they are arranged in a hierarchy or what.</p>
</div>
<ol class="children">
<li id="comment-431787" class="comment byuser comment-author-lemire bypostauthor even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-16T13:50:50+00:00">October 16, 2019 at 1:50 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m ordering an AMD Rome server this week.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-431785" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-16T13:48:28+00:00">October 16, 2019 at 1:48 pm</time></a> </div>
<div class="comment-content">
<p>Look up TAGE.</p>
<p>It does well on this kind of test, because it uses a limited history of say 20-30 branches as a lookup into a history table. Here, each 20-30 branch sequence, with very high probability identifies the exact position within the random sequence. I.e., the &ldquo;tag&rdquo; has a high amount of information.</p>
<p>On the other hand, TAGE does poorly for apparently much simpler cases. Consider a nested loop with a <em>fixed</em> number of iterations. Here, Intel chips fail to predict the inner loop exit with as few as 30ish iterations (the transition is sharp, from 100% to 0% basically when you cross the threshold).</p>
<p>That&rsquo;s because the tag is now very sparse in entropy/information. Assuming a taken branch is 1, the history looks like 1111111011111110&#8230;. for 7 iteration loop. I.e., mostly ones. Even though a 26-bit tag (say) could distinguish almost 70 million patterns (and in Daniel&rsquo;s random test you could get close if you didn&rsquo;t hit some other resource limit), in this case it&rsquo;s basically all 1s. The only think you can key on is that occasional 0, and as soon as you get to 27 interactions, the 0 won&rsquo;t appear in a 26-bit key, and all the predictor sees is a long string of 1s and it always fails.</p>
<p>This is why you sometimes see recommendations to keep nested loops to less than 16.</p>
<p>Intel chips used to have a specific loop predictor which could remember iteration counts for loops like this (indeed, a much easier problem in principle than remembering a series of 2,000 random branches) but it was removed sometime around the start of the Core series, IIRC.</p>
</div>
<ol class="children">
<li id="comment-431792" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-16T15:25:41+00:00">October 16, 2019 at 3:25 pm</time></a> </div>
<div class="comment-content">
<p>I wonder how these graphs would look like if one could completely flush (or reset to a known state, say, &ldquo;all branches not taken&rdquo;) the predictor state before the run. Maybe what I thought was not so much incremental &ldquo;learning&rdquo; as it might have been incremental &ldquo;unlearning&rdquo; of branch histories which were essentially random in the context of this benchmark.</p>
<p>Which makes me actually wonder how much one might be able to fish information from the branch predictor in the regard of its past by careful timing or performance counter measurements.</p>
</div>
<ol class="children">
<li id="comment-431793" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-16T15:41:44+00:00">October 16, 2019 at 3:41 pm</time></a> </div>
<div class="comment-content">
<p>Yeah, the same things that make TAGE good at predicting long series of correlated branch directions makes it hard to flush: it&rsquo;s not just a matter of executing a large number of branches at different addresses, since those will never access the longer history tables (or maybe will <em>only</em> access the longer tables).</p>
<p>You basically need a TAGE-aware flusher that uses mutilple sequences each which targets a specific TAGE length (and you might need mutilple depending on if there are independent TAGE states eg hashed by address). Furthermore there are probably, fast-but dumb non-TAGE predictors to catch easy cases that you&rsquo;ll have to flush and defeat as well.</p>
<p>I think you can saw that most of the behavior is incremental learning, not unlearning. At least the long tail where the predictions become very good should be mostly &ldquo;learning&rdquo; since unlearning really just means you can go from 0% to 50% (totally wrong, to random guess i.e., right half the time). To get above 50 and towards 99 must be learning.</p>
<p>That said, there is probably some unlearning right at the start: you&rsquo;ll get a lot of false predictions (still 50% tho) for short TAGE lengths since you&rsquo;ll be matching against earlier hits that don&rsquo;t have any relationship. I don&rsquo;t think that&rsquo;s a major effect.</p>
<p>Interesting challenge: design a series of branches which gets a 100% misprediction rate. You could do it if you knew the internal behavior of the predictor, but even if not you could maybe do it incrementally.</p>
</div>
<ol class="children">
<li id="comment-431795" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-16T16:07:04+00:00">October 16, 2019 at 4:07 pm</time></a> </div>
<div class="comment-content">
<p>Interesting points, thanks for the insight!</p>
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
<li id="comment-432334" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5b84c934695024f5a7b50e073ed3979d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5b84c934695024f5a7b50e073ed3979d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Zelakt</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-21T14:59:32+00:00">October 21, 2019 at 2:59 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m confused. If the branch is completely random, what is there to predict? How is branch prediction improving?</p>
</div>
<ol class="children">
<li id="comment-432336" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-21T15:34:51+00:00">October 21, 2019 at 3:34 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>If the branch is completely random</p>
</blockquote>
<p>Importantly, from run to run, we generate the same random integers. We use pseudo-random numbers.</p>
</div>
</li>
</ol>
</li>
</ol>
