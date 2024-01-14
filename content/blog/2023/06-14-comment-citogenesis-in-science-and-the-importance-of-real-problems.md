---
date: "2023-06-14 12:00:00"
title: "Citogenesis in science and the importance of real problems"
index: false
---

[13 thoughts on &ldquo;Citogenesis in science and the importance of real problems&rdquo;](/lemire/blog/2023/06-14-citogenesis-in-science-and-the-importance-of-real-problems)

<ol class="comment-list">
<li id="comment-54933" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/76b44c7bca8bbfde592937ad891d7140?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/76b44c7bca8bbfde592937ad891d7140?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://ocam.cl" class="url" rel="ugc external nofollow">Alejandro Weinstein</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-01-27T20:10:29+00:00">January 27, 2012 at 8:10 pm</time></a> </div>
<div class="comment-content">
<p>May be this is an instance of what you&rsquo;re saying:</p>
<p><a href="http://stackoverflow.com/questions/504823/has-anyone-actually-implemented-a-fibonacci-heap-efficiently" rel="nofollow ugc">http://stackoverflow.com/questions/504823/has-anyone-actually-implemented-a-fibonacci-heap-efficiently</a></p>
<p>Theory say that the performance of Dijkstra shortest path algorithm is best when using a Fibonacci Heap, but some experiments disagree.</p>
</div>
</li>
<li id="comment-54934" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-01-27T20:43:00+00:00">January 27, 2012 at 8:43 pm</time></a> </div>
<div class="comment-content">
<p>@Alejandro</p>
<p>It is a benign example of what I am pointing out. There are indeed countless engineering papers written every year using the Fibonacci heap. It is unclear *why* they use the Fibonacci heap because we now have overwhelming evidence that it is not worth it.</p>
<p>However, there are many hidden Fibonacci heaps out there in research papers.</p>
</div>
</li>
<li id="comment-54936" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/354c65588cca696086551858e5e316a2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/354c65588cca696086551858e5e316a2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Denzil Correa</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-01-28T09:17:31+00:00">January 28, 2012 at 9:17 am</time></a> </div>
<div class="comment-content">
<p>Is this also a BIG reason why authors don&rsquo;t make available their source code publicly? I believe it is.</p>
</div>
</li>
<li id="comment-54935" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/91873c50f543ae3c2102607911f8a219?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/91873c50f543ae3c2102607911f8a219?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">JeffE</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-01-28T08:58:11+00:00">January 28, 2012 at 8:58 am</time></a> </div>
<div class="comment-content">
<p>Fibonacci heaps are still cited only because authors are too lazy to look past their textbooks to the more recent literature, where simpler, faster, and more practical data structures with the same theoretical guarantees have been known for years. (Fibonacci heaps are still cited in textbooks because _textbook_ authors are too lazy to look past _their_ textbooks to the more recent literature, where etc.)</p>
</div>
</li>
<li id="comment-54938" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Steve</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-01-29T15:54:33+00:00">January 29, 2012 at 3:54 pm</time></a> </div>
<div class="comment-content">
<p>The point where things completely come full circle is when the engineers come out with an open source package/library (e.g., pyX) that implements several of the techniques, including X, X+, and X++, making it easy for researchers to try them all.</p>
</div>
</li>
<li id="comment-54939" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0a1160c4d7ae6dfd290db4f9d11579e0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0a1160c4d7ae6dfd290db4f9d11579e0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">James</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-01-29T16:43:22+00:00">January 29, 2012 at 4:43 pm</time></a> </div>
<div class="comment-content">
<p>From my personal experience, it&rsquo;s the lack of experience and exposure to better / more advanced techniques that means that these better methods get left on the shelf.<br/>
The cognitive effort required to apply, let alone come up with, is prohibitive to their adoption, and yet the majority of developers I know would rather work things out from first principals and use inappropriate levels of abstraction, more for macho purposes than practical ones.<br/>
my 2c. 😉</p>
</div>
</li>
<li id="comment-54943" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/23d9ebfa3c32d719f7f324efc99d28ca?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/23d9ebfa3c32d719f7f324efc99d28ca?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jens Teubner</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-01-30T05:02:31+00:00">January 30, 2012 at 5:02 am</time></a> </div>
<div class="comment-content">
<p>It is even worse. Suppose I find that X+ is no better (or even worse) than X and thus mention X+ negatively in my paper. Very quickly, my mentioning is going to be reduced to &ldquo;a citation&rdquo; and increase X+&rsquo;s citation count. Even with my negative result, I&rsquo;ll actually help promote X+!</p>
</div>
</li>
<li id="comment-54942" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.optimizelife.com" class="url" rel="ugc external nofollow">Gustavo Lacerda</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-01-30T03:31:44+00:00">January 30, 2012 at 3:31 am</time></a> </div>
<div class="comment-content">
<p>This sounds analogous to how software bloat can accumulate: <a href="https://en.wikipedia.org/wiki/Software_bloat" rel="nofollow ugc">http://en.wikipedia.org/wiki/Software_bloat</a></p>
</div>
</li>
<li id="comment-54944" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-01-30T08:48:56+00:00">January 30, 2012 at 8:48 am</time></a> </div>
<div class="comment-content">
<p>@Jens</p>
<p>True. Good point.</p>
</div>
</li>
<li id="comment-54948" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/112d61920c9daa3192b59458acf1c8d2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/112d61920c9daa3192b59458acf1c8d2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.jozilla.net/" class="url" rel="ugc external nofollow">Jo Vermeulen</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-01-31T07:44:11+00:00">January 31, 2012 at 7:44 am</time></a> </div>
<div class="comment-content">
<p>Doesn&rsquo;t this all come down to the need for more replication of findings in CS research, and the related problem of actually valuing this type of article?</p>
<p>Last year, there was a panel at the CHI conference on the topic of replication in the Human-Computer Interaction field.</p>
<p>See also: <a href="http://www.slideshare.net/mbernst/replichi-graduate-student-perspectives" rel="nofollow">Graduate Student Perspectives on replication</a></p>
</div>
</li>
<li id="comment-652352" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c8971b9927d5a599875279bd85004f73?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c8971b9927d5a599875279bd85004f73?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://shape-of-code.com" class="url" rel="ugc external nofollow">Derek Jones</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-14T20:02:20+00:00">June 14, 2023 at 8:02 pm</time></a> </div>
<div class="comment-content">
<p>There are whole <a href="https://shape-of-code.com/2021/01/17/software-effort-estimation-is-mostly-fake-research/" rel="nofollow ugc">subfields that are essentially fake,</a>, and others that have long ceased to be going anywhere, e.g., mutation testing.</p>
<p>It&rsquo;s not surprising that industry laughs academic research in software engineering.</p>
</div>
</li>
<li id="comment-652496" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">me</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-23T16:21:06+00:00">June 23, 2023 at 4:21 pm</time></a> </div>
<div class="comment-content">
<p>It is even worse.<br/>
Negative results are not only harder to publish, but they will also not receive citations. One could argue that we could and should publish negative results at least on arXiv. Or make a journal dedicated to negative results.<br/>
But citations tend to be even more important than the number of papers you published. So even if we would publish negative results, they will not advance your career; and we can make better use of the time spent for the write-up.<br/>
What we really need to do is publish the source codes of failed reproductions, by contributing them to tools, so others can more easily see that some algorithm does not work as promised.</p>
</div>
</li>
<li id="comment-652497" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ebb53d621ad68a6e34eee7464153958c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ebb53d621ad68a6e34eee7464153958c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">David Fetter</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-23T16:42:56+00:00">June 23, 2023 at 4:42 pm</time></a> </div>
<div class="comment-content">
<p>No tiny part of the obsession with novelty is the political economy.</p>
<p>Things that are &ldquo;novel&rdquo; are ones that be made into property and thus can most easily have economic rents extracted from them under our current system, so that&rsquo;s where funding goes, and where prestige goes. Where there are incentives, we should not feign surprise at the fact that people respond to same and optimize their outlook and their conduct in a way that they have reason to believe maximizes their advantage, given those incentives.</p>
</div>
</li>
</ol>
