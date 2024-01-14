---
date: "2013-07-10 12:00:00"
title: "Should computer scientists run experiments?"
index: false
---

[5 thoughts on &ldquo;Should computer scientists run experiments?&rdquo;](/lemire/blog/2013/07-10-should-computer-scientists-run-experiments)

<ol class="comment-list">
<li id="comment-89701" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" decoding="async" /> <b class="fn">Anonymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-07-10T12:27:00+00:00">July 10, 2013 at 12:27 pm</time></a> </div>
<div class="comment-content">
<p>Daniel &#8212; you&rsquo;re not the &ldquo;villain&rdquo; in my story. But I disagree with (what I interpret as) your criticism of models that do not model absolutely every aspect of a computation. Would you dismiss computing the communication cost of a MapReduce algorithm, even though there are other costs involved (but communication cost typically dominates)? Do you dismiss any claim of a big-oh or big-omega bound, because no such claim can ever be falsified by a finite experiment?<br/>
&#8211;Jeff Ullman</p>
</div>
</li>
<li id="comment-89705" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-07-10T13:04:03+00:00">July 10, 2013 at 1:04 pm</time></a> </div>
<div class="comment-content">
<p><em>Would you dismiss computing the communication cost of a MapReduce algorithm, even though there are other costs involved (but communication cost typically dominates)?</em></p>
<p>No.</p>
<p><em>Do you dismiss any claim of a big-oh or big-omega bound, because no such claim can ever be falsified by a finite experiment?</em></p>
<p>If you want to be formal about it, no model can ever be proven wrong. </p>
<p>We both know that, in practice, if you plot the performance curves and you get something that is quadratic in n&#8230; you have effectively disproved the n log n model. </p>
<p>You may argue that formally, I have disproved nothing&#8230; but the point of a scientific model is to tell you something about the real world. If you constantly get quadratic curves&#8230; you can argue until you are blue in the face that it is really n log n&#8230; engineers are going to reject your performance model and use a better one.</p>
<p>So falsification is not a black and white thing. Rather, in practice, it becomes increasingly harder to fit a model to the facts. Now, that&rsquo;s assuming you have a scientific model. If it is not a scientific model, then you can always fit it to any fact&#8230; because facts don&rsquo;t matter.</p>
</div>
</li>
<li id="comment-89711" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/91873c50f543ae3c2102607911f8a219?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/91873c50f543ae3c2102607911f8a219?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">JeffE</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-07-10T13:45:36+00:00">July 10, 2013 at 1:45 pm</time></a> </div>
<div class="comment-content">
<p>Big-O notation may very well be _practically useless_, but it is certainly not _meaningless_, even in the context of a universe with a finite number of elementary particles.</p>
<p>_We both know that, in practice, if you plot the performance curves and you get something that is quadratic in nâ€¦ you have effectively disproved the n log n model._</p>
<p>No, we don&rsquo;t. We both know that in practice, if one sorting algorithm has better performance on real-world data, then it has better performance on real-world data, by definition. But that&rsquo;s not a falsification of the asymptotic complexity model, because that&rsquo;s not what the asymptotic complexity model describes.</p>
<p>It&rsquo;s not the _model&rsquo;s_ fault if you&rsquo;re using it wrong.</p>
</div>
</li>
<li id="comment-89712" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-07-10T14:03:14+00:00">July 10, 2013 at 2:03 pm</time></a> </div>
<div class="comment-content">
<p>@JeffE</p>
<p>If you want to be formal about it, then big-O notation is a purely mathematical construct that has no bearing on reality.</p>
<p>Take sorting&#8230; just artificially pad any array so that it has at least 10^10 elements. You haven&rsquo;t changed the big-O notation, but you have drastically altered the real-world performance for all practical cases.</p>
<p>If you insist on this interpretation, then yes, big-O notation belongs to math. departments. </p>
<p>But that is not how it is used. Clearly, Jeffrey&rsquo;s intent is that his big-O analysis has some bearing on real world performance in this universe.</p>
</div>
</li>
<li id="comment-89725" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6f8e0087234b2359ea596326ddfd62d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6f8e0087234b2359ea596326ddfd62d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Vladimir N</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-07-10T16:46:25+00:00">July 10, 2013 at 4:46 pm</time></a> </div>
<div class="comment-content">
<p>Model&rsquo;s prediction and experimental results are separate things, but they are not unrelated. What the model says, if it&rsquo;s constructed under assumptions similar to what holds for the experiment, is evidence about what the experimental results will be. And the shape of experimental results is evidence for the existence of a reasonable model that would predict it.</p>
</div>
</li>
</ol>
