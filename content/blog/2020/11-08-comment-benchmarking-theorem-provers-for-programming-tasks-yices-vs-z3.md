---
date: "2020-11-08 12:00:00"
title: "Benchmarking theorem provers for programming tasks: yices vs. z3"
index: false
---

[9 thoughts on &ldquo;Benchmarking theorem provers for programming tasks: yices vs. z3&rdquo;](/lemire/blog/2020/11-08-benchmarking-theorem-provers-for-programming-tasks-yices-vs-z3)

<ol class="comment-list">
<li id="comment-557656" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/679c627903d3aa9aee11951e380c0f6b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/679c627903d3aa9aee11951e380c0f6b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Richard Bonichon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-11-09T13:48:19+00:00">November 9, 2020 at 1:48 pm</time></a> </div>
<div class="comment-content">
<p>For bitvector theory (aka machine integers), another solver that gives great results is <a href="https://boolector.github.io/" rel="nofollow ugc">boolector</a>. It might be better than yices. Z3 is especially good as the swiss-army knife of SMT solvers (aka, I want to be able to do everything)/</p>
</div>
<ol class="children">
<li id="comment-557657" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-11-09T14:01:34+00:00">November 9, 2020 at 2:01 pm</time></a> </div>
<div class="comment-content">
<p>I am going with Geoff&rsquo;s advice who found boolector to be slower than yices.</p>
<p>Did you try benchmarking boolector?</p>
</div>
<ol class="children">
<li id="comment-557843" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/679c627903d3aa9aee11951e380c0f6b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/679c627903d3aa9aee11951e380c0f6b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://rbonichon.github.io/" class="url" rel="ugc external nofollow">Richard Bonichon</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-11-11T08:14:39+00:00">November 11, 2020 at 8:14 am</time></a> </div>
<div class="comment-content">
<p>I haven&rsquo;t come around to benchmarking boolector on your example. If I have the time by the end of the week, I&rsquo;ll report in this thread.</p>
<p>However, in the annual competition of the SMT community (see this year&rsquo;s results at <a href="https://smt-comp.github.io/2020/results.html" rel="nofollow ugc">https://smt-comp.github.io/2020/results.html</a>, where I learned about Bitwuzla), boolector has regularly been at the top in the &ldquo;QF-ABV (this is the category of formulas you are interested in) in the last few years.</p>
<p>Yices is usually not very far behind and, in practice, our research group has used both since they have slightly different heuristics.</p>
<p>One good way to have SMT solvers go at your problem is to make them available to SMT-LIB, the library of problems used to evaluate the solvers, in particular during SMT-COMP.</p>
</div>
</li>
<li id="comment-557945" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/679c627903d3aa9aee11951e380c0f6b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/679c627903d3aa9aee11951e380c0f6b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://rbonichon.github.io/" class="url" rel="ugc external nofollow">Richard Bonichon</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-11-12T08:57:15+00:00">November 12, 2020 at 8:57 am</time></a> </div>
<div class="comment-content">
<p>So, I&rsquo;ve taken some (procrastination) time to run the benchmark with boolector and cvc4 as well.</p>
<p>The key take away is that yices is indeed clearly better for this problem.<br/>
The surprise to me is that z3 beats boolector in single query mode and that boolector is super slow in incremental mode (which is the mode you seem to be using through the API AFAIK).</p>
<p>The repo with the details is here<br/>
<a href="https://github.com/rbonichon/smt-inverse-benchmark" rel="nofollow ugc">https://github.com/rbonichon/smt-inverse-benchmark</a></p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-561119" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/18292150a67dc592d4de4356dc8b7baf?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/18292150a67dc592d4de4356dc8b7baf?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://nerdralph.blogspot.ca" class="url" rel="ugc external nofollow">Ralph Doncaster</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-07T16:16:43+00:00">December 7, 2020 at 4:16 pm</time></a> </div>
<div class="comment-content">
<p>I had never played with solvers before. I always wrote my own program for these types of problems. Guessing that even the &ldquo;fast&rdquo; solver is still much slower than I wrote a crude equivalent in C. Running on a google cloud shell console server, it finds the inverses of odd integers up to 9999 in 0.09 seconds.</p>
<p><a href="https://gist.github.com/nerdralph/aba30d4d1145bcc9129f1b97604dc480" rel="nofollow ugc">https://gist.github.com/nerdralph/aba30d4d1145bcc9129f1b97604dc480</a></p>
</div>
<ol class="children">
<li id="comment-561126" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-07T17:47:18+00:00">December 7, 2020 at 5:47 pm</time></a> </div>
<div class="comment-content">
<p>In most cases, you can design a specific solver by hand that is much faster. However, you are trading your own engineering time against CPU cycles.</p>
</div>
</li>
</ol>
</li>
<li id="comment-613410" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/88fbed499a5ee5b7c711605d73810373?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/88fbed499a5ee5b7c711605d73810373?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alex C</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-12-27T08:23:21+00:00">December 27, 2021 at 8:23 am</time></a> </div>
<div class="comment-content">
<p>The difference is about 2x, and not 15x if you set the proper mode for z3 (although I agree that this should be documented better and/or it should be smarter about figuring out the required mode).</p>
<p>Use the following diff:<br/>
<s> s = SolverFor(&ldquo;QF_BV&rdquo;)</s></p>
</div>
</li>
<li id="comment-613412" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/88fbed499a5ee5b7c711605d73810373?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/88fbed499a5ee5b7c711605d73810373?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alex C</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-12-27T08:24:31+00:00">December 27, 2021 at 8:24 am</time></a> </div>
<div class="comment-content">
<p>The difference is about 2x, and not 15x if you set the proper mode for z3 (although I agree that this should be documented better and/or it should be smarter about figuring out the required mode). Use the following:</p>
<p>s = SolverFor(“QF_BV”)</p>
<p>instead of</p>
<p>s = Solver()</p>
</div>
</li>
<li id="comment-650049" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/906b9045e643b5a8a3bc564c90084971?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/906b9045e643b5a8a3bc564c90084971?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Rale</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-02T22:22:14+00:00">April 2, 2023 at 10:22 pm</time></a> </div>
<div class="comment-content">
<p>I think it is not fair to call SMT solvers &ldquo;theorem provers&rdquo;. Yes, they are very useful, they can automate certain (sub)tasks, especially in real theorem provers, but they have some fundamental limitations. No SMT can deal on it&rsquo;s own with problems like verification of floating point algorithms or floating point units. Much like bounded model checkers, great for bug hunting in control path, but totally inadequate for datapaths.</p>
</div>
</li>
</ol>
