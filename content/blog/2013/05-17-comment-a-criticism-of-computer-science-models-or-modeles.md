---
date: "2013-05-17 12:00:00"
title: "A criticism of computer science: models or modèles?"
index: false
---

[20 thoughts on &ldquo;A criticism of computer science: models or modèles?&rdquo;](/lemire/blog/2013/05-17-a-criticism-of-computer-science-models-or-modeles)

<ol class="comment-list">
<li id="comment-84993" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2f5b3fa26595bc45871213860db4668f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2f5b3fa26595bc45871213860db4668f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">CS</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-05-17T09:07:34+00:00">May 17, 2013 at 9:07 am</time></a> </div>
<div class="comment-content">
<p>CS follows the mathematical conception of model and there is nothing wrong with that. I have more trouble understanding the (ab)use of model by health and social sciences than computer scientists.</p>
</div>
</li>
<li id="comment-84997" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6f2f058debdde1bacf111a186841ab0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6f2f058debdde1bacf111a186841ab0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">rodrigob</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-05-17T09:51:32+00:00">May 17, 2013 at 9:51 am</time></a> </div>
<div class="comment-content">
<p>Using &ldquo;modÃ¨le&rdquo; to mean anything else than &ldquo;model&rdquo; would create chaos amongst the French speakers, please refrain. Plus as non-native speaker I would have no clue how to pronounce differently these two words.</p>
<p>Why not something more like &ldquo;weak models&rdquo; versus &ldquo;strong models&rdquo;, or even better, plain English: &ldquo;falsifiable models&rdquo; versus &ldquo;unfalsifiable models&rdquo; ?</p>
</div>
</li>
<li id="comment-84999" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/08273d5f7fe210be4bfcdd60b9b3fe09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/08273d5f7fe210be4bfcdd60b9b3fe09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">J. Andrew Rogers</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-05-17T09:59:04+00:00">May 17, 2013 at 9:59 am</time></a> </div>
<div class="comment-content">
<p>I have been making a similar observation about computer science literature for a long time. Much of it is technically correct but studiously avoids measuring and characterizing aspects that would make it relevant to real systems. I realize this makes the computer science easier &#8212; it allows greatly simplified assumptions &#8212; but also makes it less useful. </p>
<p>This leads to apparently counterintuitive implementations of software. For example, there are many examples where the best algorithms in implementation are objectively worse, in terms of various common Big-O et al metrics, than the best algorithms in literature. Or the software exhibits worse characteristics in the general case than Big-O asserts. Technically the literature is correct but the real implication is that they aren&rsquo;t characterizing important aspects of algorithms. </p>
<p>This also leads to a lot of algorithm research designing to their model rather than real systems, which renders many advances not that valuable in practice while ignoring potentially useful parts of the design space.</p>
</div>
</li>
<li id="comment-85001" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b3eeb7653c4df9b0f1332b9b0ec201ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b3eeb7653c4df9b0f1332b9b0ec201ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Max Lybbert</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-05-17T10:37:16+00:00">May 17, 2013 at 10:37 am</time></a> </div>
<div class="comment-content">
<p>You may be giving doctors too much credit. I remember a drug salesman I knew. He took his job seriously because he expected doctors to prescribe drugs based on what he told them before they got a chance to read the supporting literature.</p>
<p>Programmers don&rsquo;t like to be wrong. I&rsquo;m not as bad as I used to be, but I can still have a hard time biting my tongue during code reviews.</p>
<p>The idea behind saying &ldquo;approach X is better than approach Y under the following assumptions&rdquo; is that if assumptions change (say computers ship with more CUPs, or computers ship with multiple kinds of CUPs, or accessing memory becomes more expensive compared to calculating things) you can, in theory, decide which approach is going to work better. And the original researcher gets to claim he was right based on what was true when he published the original paper.</p>
<p>The problem, of course, is that very few programmers know what assumptions apply to the hardware their code runs on. They might know some general information (accessing cache is faster than accessing RAM), but they don&rsquo;t know real numbers, and they don&rsquo;t know enough about the implementation of libraries they use to see how their general knowledge applies. For instance, C++ programmers often pride themselves on programming close to the metal, but cannot say whether it&rsquo;s faster to use std::set or atd::binary_search and a sorted std::vector. Or they don&rsquo;t know if string operations are slower than virtual function calls, or how expensive memory allocations really are, etc.</p>
</div>
</li>
<li id="comment-85002" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b3eeb7653c4df9b0f1332b9b0ec201ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b3eeb7653c4df9b0f1332b9b0ec201ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Max Lybbert</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-05-17T10:38:59+00:00">May 17, 2013 at 10:38 am</time></a> </div>
<div class="comment-content">
<p>Autocorrect strikes again. CPUs, not CUPs.</p>
</div>
</li>
<li id="comment-85010" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1ad29fe8ff728ba6e807547de024a358?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1ad29fe8ff728ba6e807547de024a358?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.klausschmid.net" class="url" rel="ugc external nofollow">Klaus Schmid</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-05-17T13:04:55+00:00">May 17, 2013 at 1:04 pm</time></a> </div>
<div class="comment-content">
<p>I fully agree and it is a major problem of much of computer science. But, the comparison with medical science might not be optimal. The falsifiability criterion initially divised by Popper was created based on the example of natural science and this is also the strongest claim to its fame. For engineering science (which most of computer science ultimately amounts to) another criterion, which is closely related, comes into play: usefulness.<br/>
A model is useful if it helps to build better systems. Unfortunately, often the notion of &ldquo;better&rdquo; is already created in the abstract and this leads then to results, which are in principle great and might even be theoretically useful, but if taken to the real world just break down, because they make unrealistic assumptions about the world. </p>
<p>It is like engineering great machines that would work well if our planet would have zero gravity, while it (luckily) does not.</p>
</div>
</li>
<li id="comment-85012" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-05-17T13:18:36+00:00">May 17, 2013 at 1:18 pm</time></a> </div>
<div class="comment-content">
<p>@Klaus</p>
<p>I agree with you that I may have overplayed falsifiability.</p>
<p>Though I am acutely aware that a lot of medical research is abstract nonsense, it remains true that medical practitioners have a moral obligation to stay up-to-date with at least the clinical component of it.</p>
<p>Why don&rsquo;t we put the same obligation on, say, software developers? I think it is quite telling.</p>
</div>
</li>
<li id="comment-85019" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anonymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-05-17T14:19:19+00:00">May 17, 2013 at 2:19 pm</time></a> </div>
<div class="comment-content">
<p>Ok, if you want to look at it from the ethics side &#8211; sure: <a href="http://www.acm.org/about/se-code" rel="nofollow ugc">http://www.acm.org/about/se-code</a><br/>
especially point 8 of the preamble.<br/>
&#8211; so we actually do.</p>
<p>.. but I am not sure someone cares..</p>
</div>
</li>
<li id="comment-85041" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7c33a18c2c5a3836ff6661e28f22ee6f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7c33a18c2c5a3836ff6661e28f22ee6f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.cs.mcgill.ca/~akazna/" class="url" rel="ugc external nofollow">Artem Kaznatcheev</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-05-17T23:41:45+00:00">May 17, 2013 at 11:41 pm</time></a> </div>
<div class="comment-content">
<p>Interesting post Daniel, but I think you are misrepresenting modeling in the natural and social sciences. Predictive models are few and far between in any field that isn&rsquo;t close to physics. The ones that do exist are usually verbal and would feel completely foreign to a mathematician or cstheorist. </p>
<p>Of course, the abstract modÃ¨les that you describe, are even fewer. This, unfortunately, seems to be not because people find them pointless, but because of a general uneasiness in math. But there is one field where modÃ¨les proliferate and probably for ill: neoclassical economics.</p>
<p>The last type of models, and by far the most common among mathematical or computational models in the natural and social sciences, are heuristic models. These models are not connected to experiment and can never be falsified. They all start off wrong and everybody is fine with that. As the famous saying goes: &ldquo;all models are wrong, but some are useful&rdquo;. These models, especially their computer variants &#8212; simulations, usually through agent-based modeling &#8212; can actually be detrimental to the field at the expense of potential understanding offered by modÃ¨les. I call this the <a href="https://egtheory.wordpress.com/2013/05/14/curse-of-computing/" rel="nofollow">curse of computing</a>.</p>
<p>Finally, on your opening example of doctors vs. programmers. This is a completely unreasonable comparison. One of these groups has <i>significantly</i> more training than the other. A typical programmer doesn&rsquo;t even need an undergraduate degree for the sort of work they usually do. Not to mention that for a typical programmer (compared to a typical doctor) what is at stake is completely different (slightly slower website load times vs a person&rsquo;s health). Thus, it is not reasonable to look at how they approach the scientific literature.</p>
<p>If you want to stay in the medical disciplines then a slightly more fair comparison would be nurses vs. programmers, but even then I would argue that a nurse requires more qualifications than a typical programmer. Maybe nurses vs. software engineers is fair.</p>
</div>
</li>
<li id="comment-85106" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Some Guy</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-05-18T14:56:56+00:00">May 18, 2013 at 2:56 pm</time></a> </div>
<div class="comment-content">
<p>There is a whole branch of mathematics called &ldquo;Model Theory&rdquo; &#8211; the Dover book by that name is a good starting point. Computer science uses that kind of model.</p>
</div>
</li>
<li id="comment-85286" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f668a451ba8852b7abd58a36eacce6a6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f668a451ba8852b7abd58a36eacce6a6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://mobile.twitter.com/amy8492" class="url" rel="ugc external nofollow">Amy</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-05-21T05:38:23+00:00">May 21, 2013 at 5:38 am</time></a> </div>
<div class="comment-content">
<p>I agree with the idea that a lot of computer science research is disconnected from reality, thus difficult to test.</p>
<p>But I oppose using the french vs. english word. How then am i supposed to translate the notion?</p>
<p>I support @rodrigob 🙂</p>
</div>
</li>
<li id="comment-85323" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Itman</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-05-21T07:54:12+00:00">May 21, 2013 at 7:54 am</time></a> </div>
<div class="comment-content">
<p>This has nothing to do with computer science, per se. All other sciences are no better (and oftentimes worse) than Computer Science from this perspective. In CS, at least, you compare at least more or less realistic things. In Math, e.g., you prove what you can prove, not what it is useful.</p>
</div>
</li>
<li id="comment-85557" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4ce8ec2b86c99d30f6064a7be9ed7b81?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4ce8ec2b86c99d30f6064a7be9ed7b81?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://memosisland.blogspot.com" class="url" rel="ugc external nofollow">Mehmet Suzen</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-05-24T07:15:44+00:00">May 24, 2013 at 7:15 am</time></a> </div>
<div class="comment-content">
<p>There was a recent article by the Vinton Cerf about <a href="http://cacm.acm.org/magazines/2012/10/155530-where-is-the-science-in-computer-science/abstract" rel="nofollow">science in CS</a>.</p>
</div>
</li>
<li id="comment-85701" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.apperceptual.com/" class="url" rel="ugc external nofollow">Peter Turney</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-05-26T07:59:39+00:00">May 26, 2013 at 7:59 am</time></a> </div>
<div class="comment-content">
<p>This is not true of all computer scientists. In particular, researchers in computational linguistics and machine learning are always testing their algorithms will real-word data.</p>
</div>
</li>
<li id="comment-85781" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4ce8ec2b86c99d30f6064a7be9ed7b81?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4ce8ec2b86c99d30f6064a7be9ed7b81?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://memosisland.blogspot.com" class="url" rel="ugc external nofollow">Mehmet Suzen</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-05-27T09:49:27+00:00">May 27, 2013 at 9:49 am</time></a> </div>
<div class="comment-content">
<p>@Daniel Lamiere</p>
<p>&ldquo;Though I am acutely aware that a lot of medical research is abstract nonsense&rdquo;</p>
<p>I think this is a very strong statement. Consider that, Medical research these days almost exclusively relies on computational statistics and applied computer science. Specially if you thing of medical imaging and data mining on medical data.</p>
</div>
</li>
<li id="comment-85807" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Itman</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-05-27T16:14:18+00:00">May 27, 2013 at 4:14 pm</time></a> </div>
<div class="comment-content">
<p>@Mehmet, there are thousands of ways to make statistics look good and people are sure using them.</p>
</div>
</li>
<li id="comment-85830" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Itman</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-05-27T19:57:25+00:00">May 27, 2013 at 7:57 pm</time></a> </div>
<div class="comment-content">
<p>I suggest that &ldquo;&#8230; almost exclusively relies on computational statistics and applied computer science&rdquo; means nothing on its own. Using statistics does not save research from being abstract nonsense, if it is abstract nonsense in the first place. </p>
<p>Note that I am not trying to estimate which percentage of medical research is relevant and which is not.</p>
</div>
</li>
<li id="comment-85815" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4ce8ec2b86c99d30f6064a7be9ed7b81?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4ce8ec2b86c99d30f6064a7be9ed7b81?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mehmet Suzen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-05-27T18:34:09+00:00">May 27, 2013 at 6:34 pm</time></a> </div>
<div class="comment-content">
<p>@Itman</p>
<p>I am not following. What are you suggesting? Should we discredit all medical sciences based on what you say? Statistics could reveal lots of information from plain data. if it used by competent professionals. Statistics is used a lot in computer science as well, specially in machine learning as you know very well. Whole discovery of Higgs boson is based on statistics on the data produced by <a href="http://cds.cern.ch/record/1099994?ln=en" rel="nofollow">LHC</a>. I would not discredit statistics totally as you mock.</p>
</div>
</li>
<li id="comment-85835" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4ce8ec2b86c99d30f6064a7be9ed7b81?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4ce8ec2b86c99d30f6064a7be9ed7b81?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mehmet Suzen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-05-27T23:48:05+00:00">May 27, 2013 at 11:48 pm</time></a> </div>
<div class="comment-content">
<p>@Itman</p>
<p>&ldquo;Using statistics does not save research from being abstract nonsense, if it is abstract nonsense in the first place. &rdquo;</p>
<p>I give that example to establish parallels with the methods used in computer science. There are a lot of overlapping research areas with CS and medical sciences, specially biomedical research. They say &rdquo; Biology easily has 500 years of exciting problems to work on&rdquo; which attributed to Donald Knuth.<br/>
I don&rsquo;t know what are you defending. But every field of science has its own merits. If you don&rsquo;t accept that, that&rsquo;s your prejudice.</p>
</div>
</li>
<li id="comment-85898" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5d14fc41fc06a88ef049af6963545718?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5d14fc41fc06a88ef049af6963545718?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://faculty.washington.edu/stiber/" class="url" rel="ugc external nofollow">Mike Stiber</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-05-28T14:45:52+00:00">May 28, 2013 at 2:45 pm</time></a> </div>
<div class="comment-content">
<p>Couldn&rsquo;t agree more with you, Daniel. In fact, much of CS research is worse, with an approach like:</p>
<p>Propose an algorithm A that solves a type of problem P. Implement A and show that it solves some subset of examples p of P. Rinse and repeat.</p>
</div>
</li>
</ol>
