---
date: "2008-08-03 12:00:00"
title: "Cool software design insight #2"
index: false
---

[14 thoughts on &ldquo;Cool software design insight #2&rdquo;](/lemire/blog/2008/08-03-cool-software-design-insight-2)

<ol class="comment-list">
<li id="comment-50068" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dc20f7fc7b7dab70033b2a9d86c70144?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dc20f7fc7b7dab70033b2a9d86c70144?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://mark.reid.name" class="url" rel="ugc external nofollow">Mark Reid</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-08-03T22:31:40+00:00">August 3, 2008 at 10:31 pm</time></a> </div>
<div class="comment-content">
<p>I can&rsquo;t agree with this insight more. </p>
<p>The single most important thing I learnt when programming commercially was the importance of tests.</p>
<p>I cannot imagine implementing a numerical algorithm now without first defining some simple tests for expected input/output behaviour. </p>
<p>As I said in <a href="https://lemire.me/blog/2008/07/30/cool-software-design-insight-1/#comment-50059" rel="nofollow">my comment</a> on your previous post, writing tests also have the added bonus of making you focus on the important code first.</p>
<p>If you&rsquo;re interested, the *second* most important thing I learnt while programming commercially was the proper use of version control systems (CVS, then SVN, now git) and using them to define processes for code maturation (e.g., having &ldquo;sandpit&rdquo; and &ldquo;production&rdquo; branches and tagging releases).</p>
<p>I&rsquo;ve found both unit testing and version control very useful in my hobby and research programming.</p>
</div>
</li>
<li id="comment-50069" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1dc1fdd9d8acd4c9118bd0fc85c1c208?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1dc1fdd9d8acd4c9118bd0fc85c1c208?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">David Eppstein</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-08-03T23:14:42+00:00">August 3, 2008 at 11:14 pm</time></a> </div>
<div class="comment-content">
<p>For more complicated algorithmic problems, I&rsquo;ve also heard anecdotal evidence of good results from &ldquo;property testing&rdquo;: your algorithm should return a short proof that the result is actually what it says it is, and then check that this proof is valid.</p>
<p>Example: suppose you want an algorithm that determines whether a graph is bipartite, and returns the answer as a Boolean. Rather than just doing that, implement a (not much more complicated) algorithm that, when the graph is bipartite, returns a two-coloring, and when it is not bipartite, returns an odd cycle, and then add to the implementation some simple code for checking whether the result returned by this algorithm really is a two-coloring or an odd cycle.</p>
<p>Unit testing can ensure that your code runs correctly on the test cases you&rsquo;ve thought to try. Property testing can ensure that your code runs correctly on the cases your users actually run it on. And when done well, it doesn&rsquo;t much hurt the efficiency of the code because the testing part should be much faster than the original algorithm.</p>
</div>
</li>
<li id="comment-50067" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8d98221c72ad0dc0e7b24480161e13cc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8d98221c72ad0dc0e7b24480161e13cc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.ragibhasan.com" class="url" rel="ugc external nofollow">Ragib Hasan</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-08-03T22:25:42+00:00">August 3, 2008 at 10:25 pm</time></a> </div>
<div class="comment-content">
<p>So true. I used to write all of my research code in the Cowboy coding manner, and the only &ldquo;debugging&rdquo; tool I used was printf. While that type of code is easy to write, I also spent hundreds of hours scratching my head over why the code broke.</p>
<p>But as I spent my last summer at Google, I was forced to go through unit testing. While it took me a while to get used to it, my code never broke after I added a change. I found &ldquo;unit testing&rdquo; to be sort of like a religion in the industry &#8230; and I wish more academics emphasized on this for research code.</p>
</div>
</li>
<li id="comment-50072" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-08-04T11:41:26+00:00">August 4, 2008 at 11:41 am</time></a> </div>
<div class="comment-content">
<p>David:</p>
<p>There are instances I can think of where unit testing is appropriate, but &ldquo;property testing&rdquo; less so.</p>
<p>1) Any form of indexing&#8230; &ldquo;find all elements having property X&rdquo;. Ok, you can check cheaply that all your elements do have the required property, but checking that you have all of them all the time is going to make your fast algorithm useless. </p>
<p>2) Any form of approximation algorithm&#8230; suppose you wanted to compute some measure within epsilon of the true value&#8230; computing the true value each time would defeat the purpose of the approximation.</p>
<p>3) Any form of optimization problem. Suppose your algorithm finds a low-cost instance, how do you check that it is the best possible solution? In many real-life cases, it may just be totally impractical (or impossible) to check numerically that you have the best solution.</p>
<p>Many practical problems are such that constants do matter. Being twice as fast is a big deal. Even being 40% faster is a big deal. So checking your solution at runtime is very costly.</p>
<p>However, unit testing does not impact the performance of your software negatively.</p>
<p>That is not to say that property testing is not a cool idea. But is it as practical as unit testing?</p>
</div>
</li>
<li id="comment-50071" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4d102649ca02e45a9b0ed6a00ff84804?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4d102649ca02e45a9b0ed6a00ff84804?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://wozniak.ca/" class="url" rel="ugc external nofollow">Geoff Wozniak</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-08-04T07:44:23+00:00">August 4, 2008 at 7:44 am</time></a> </div>
<div class="comment-content">
<p>Your point leads to an important corollary: You will write a lot more code than just the algorithm in order to properly implement the algorithm.</p>
<p>This may contribute to poor delivery time estimates, even for research projects implemented by a single person.</p>
</div>
</li>
<li id="comment-50073" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1dc1fdd9d8acd4c9118bd0fc85c1c208?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1dc1fdd9d8acd4c9118bd0fc85c1c208?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">David Eppstein</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-08-04T12:47:46+00:00">August 4, 2008 at 12:47 pm</time></a> </div>
<div class="comment-content">
<p>Not as practical as unit testing, maybe, and as you say it doesn&rsquo;t work well for all problems. I was just throwing it out as a counterexample to your â€œall more sophisticated strategies are usually not worth the costâ€ claim.</p>
</div>
</li>
<li id="comment-50074" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-08-04T13:51:33+00:00">August 4, 2008 at 1:51 pm</time></a> </div>
<div class="comment-content">
<p>Right. Of course, but I think that even if you do property testing, you should also do unit testing. I could elaborate, but I think that static, deterministic tests are very good for your sanity.</p>
<p>Now. If only I would do unit testing for all software I publish. 😉</p>
</div>
</li>
<li id="comment-50076" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-08-04T22:45:27+00:00">August 4, 2008 at 10:45 pm</time></a> </div>
<div class="comment-content">
<p>I wrote:</p>
<p>&ldquo;&rdquo;&rdquo;&rdquo;You should always do unit testing for any kind of code that is supposed to have lasting value.&rdquo;&rdquo;&rdquo;&rdquo;</p>
<p>See the second part? 😉</p>
</div>
</li>
<li id="comment-50077" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1dc1fdd9d8acd4c9118bd0fc85c1c208?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1dc1fdd9d8acd4c9118bd0fc85c1c208?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">David Eppstein</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-08-04T23:31:39+00:00">August 4, 2008 at 11:31 pm</time></a> </div>
<div class="comment-content">
<p>Re: <i>even if you do property testing, you should also do unit testing</i>: I agree. It&rsquo;s better to find out about the bugs yourself while you&rsquo;re working on the code than to let your users find them for you later.</p>
</div>
</li>
<li id="comment-50075" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a05d00c7d0b4dba76793b2dae0644bb0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a05d00c7d0b4dba76793b2dae0644bb0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">jeremy</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-08-04T20:36:27+00:00">August 4, 2008 at 8:36 pm</time></a> </div>
<div class="comment-content">
<p>I see a tension between insight #1 (keep it simple, because you&rsquo;re going to throw the code away in 4 days) and insight #2 (develop unit tests for everything).</p>
<p>Given that I also do a lot of throwaway code, just to get a sense about whether certain ideas are worth pursuing or not, should I also be writing unit tests for that code? It seems like it would take me longer to write the code than I would actually use it. So why should I write unit tests for all my throwaway sed and awk code? My disposable matlab functions? My one-off unix pipe structures?</p>
</div>
</li>
<li id="comment-50078" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kevembuangga</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-08-05T03:48:51+00:00">August 5, 2008 at 3:48 am</time></a> </div>
<div class="comment-content">
<p><i>There are instances I can think of where unit testing is appropriate, but â€œproperty testingâ€ less so.</i></p>
<p>I only agree with the following <i>point 3</i> because for 1 and 2 you don&rsquo;t seem to make the distinction between test runs and production runs.</p>
<p>(Huh? in the roman numeral spam protection the example matches the <b>actual</b> test case: I + II + IX= XII !!! )</p>
</div>
</li>
<li id="comment-50079" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kevembuangga</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-08-05T03:52:47+00:00">August 5, 2008 at 3:52 am</time></a> </div>
<div class="comment-content">
<p><i>It&rsquo;s better to find out about the bugs yourself while you&rsquo;re working on the code than to let your users find them for you later.</i></p>
<p>You&rsquo;ll never be employed by Microsoft!<br/>
Or have you and been kicked off?</p>
</div>
</li>
<li id="comment-50080" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a05d00c7d0b4dba76793b2dae0644bb0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a05d00c7d0b4dba76793b2dae0644bb0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">jeremy</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-08-05T10:46:23+00:00">August 5, 2008 at 10:46 am</time></a> </div>
<div class="comment-content">
<p><i>See the second part?</i></p>
<p>Ah, yes! Silly me.</p>
<p>But then I guess the next interesting question is: As a researcher, at what point do you make the decision to turn throwaway code into real, unit-tested code? And what is your migration path? Do you take your scripts and integrate them into the larger project? Or do you rewrite the ideas in a more &ldquo;stable&rdquo; language? Or does it always depend on the situation?</p>
</div>
</li>
<li id="comment-50084" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-08-05T16:56:10+00:00">August 5, 2008 at 4:56 pm</time></a> </div>
<div class="comment-content">
<p>What I should do is this:</p>
<p>1) Build code for a project<br/>
2) Publish the source code with unit testing (only the part of the source code used in the production of papers)<br/>
3) Publish the paper(s)</p>
<p>What I actually do is a hybrid where I sometimes omit the unit testing. I have no excuse except that I sometimes run out of energy or time.</p>
</div>
</li>
</ol>
