---
date: "2017-11-01 12:00:00"
title: "The dual-shotgun theorem of software engineering"
index: false
---

[18 thoughts on &ldquo;The dual-shotgun theorem of software engineering&rdquo;](/lemire/blog/2017/11-01-the-dual-shotgun-theorem-of-software-engineering)

<ol class="comment-list">
<li id="comment-290643" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/77ea7ac93c9ba630b2e6c0e38d62987d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/77ea7ac93c9ba630b2e6c0e38d62987d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://twitter.com/j_mora" class="url" rel="ugc external nofollow">jmora</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-01T19:05:24+00:00">November 1, 2017 at 7:05 pm</time></a> </div>
<div class="comment-content">
<p>Have you ever tried to translate a pseudocode algorithm to actual code? I bet you tried and succeeded. I failed at first:<br/>
<a href="https://stackoverflow.com/questions/6575058/tarjans-strongly-connected-components-algorithm-in-python-not-working" rel="nofollow ugc">https://stackoverflow.com/questions/6575058/tarjans-strongly-connected-components-algorithm-in-python-not-working</a></p>
<p>Many algorithms in papers (formally proven to be correct), usually related with computationally complex problems [&gt;O(n log n)] use clever tricks to be fast. As a result, of both circumstances, they are usually very hard to modify.</p>
<p>My guess is that partitioning a problem in smaller problems as independent (decoupled) as possible is the best approach for software that is easy to modify. For example, ideally, in the functional programming paradigm, we would have a number of pure functions that are composed to create the program. It should be straightforward to modify one of these functions or the function composition (dropping, adding, permuting, or replacing functions).</p>
<p>Finally, for evaluation, we could consider programming katas, where a problem needs to be solved and then the problem is modified. It may be untenable for teams of programmers, but it may be very instructive for groups of students. As students need to learn different paradigms (object oriented programming, functional programming, and what not) the testing and comparing of the paradigms and approaches should be feasible and could be interesting.</p>
</div>
<ol class="children">
<li id="comment-290645" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-01T19:18:18+00:00">November 1, 2017 at 7:18 pm</time></a> </div>
<div class="comment-content">
<p><em>Many algorithms in papers (formally proven to be correct), usually related with computationally complex problems [>O(n log n)] use clever tricks to be fast. As a result, of both circumstances, they are usually very hard to modify.</em></p>
<p>I should make it precise that I meant &ldquo;fast software&rdquo;, not &ldquo;fast algorithm on paper&rdquo;.</p>
<p><em>For example, ideally, in the functional programming paradigm, we would have a number of pure functions that are composed to create the program. It should be straightforward to modify one of these functions or the function composition (dropping, adding, permuting, or replacing functions).</em></p>
<p>Our entire civilization runs on code written in C using no fancy paradigm&#8230; no object-orientation, no function programming&#8230; The Linux kernel is beautiful and powerful code that lots of people, me included, have modified for fun or profit. </p>
<p>You can write slow and unparseable buggy code in Haskell, scala, and so forth. It is great that people enjoy functional programming with pure functions and no side-effects and all that&#8230; and sure, it can work, but there are many good ways to produce high-quality code. Fortran, Go, C++, Lisp, JavaScript&#8230; all of those can serve to write good code.</p>
<p><em>Finally, for evaluation, we could consider programming katas, where a problem needs to be solved and then the problem is modified. It may be untenable for teams of programmers, but it may be very instructive for groups of students. As students need to learn different paradigms (object oriented programming, functional programming, and what not) the testing and comparing of the paradigms and approaches should be feasible and could be interesting.</em></p>
<p>For training, that could be great.</p>
</div>
<ol class="children">
<li id="comment-290653" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/77ea7ac93c9ba630b2e6c0e38d62987d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/77ea7ac93c9ba630b2e6c0e38d62987d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://twitter.com/j_mora" class="url" rel="ugc external nofollow">jmora</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-01T21:03:16+00:00">November 1, 2017 at 9:03 pm</time></a> </div>
<div class="comment-content">
<p>Crappy code (and analogously good code) can be written on every language and every paradigm, but in some it is easier than in others.</p>
<p>&ldquo;Computer languages differ not so much in what they make possible, but in what they make easy.&rdquo; &#8211; Larry Wall</p>
<p>Most paradigms (if not all) have been created to make better software more easily, taking different approaches. I am not saying that functional programming is &ldquo;the right paradigm&rdquo; (disclaimer: I certainly like it), but I think it is an easy context to explain the point of simple, composable, and modifiable parts of code to preserve ease of modification in large codebases.</p>
<p>For example, we can consider microservices and software modules (e.g. Java packages). Both allow for the decoupling of the software, but microservices make harder to violate it. (There are many more and greater pros and cons to microservices). With pressing deadlines, and Alice on holidays, Bob may be tempted to create a subclass of a class from Alice in his package, &ldquo;for a quick fix to be patched later&rdquo; (which may be never).</p>
<p>Wrt OOP, abstraction and encapsulation in classes and objects was a nice try, it has been a successful one, but it is troublesome as it hides state, and this is a problem for parallel and concurrent code execution. Changing a program to make it parallel is normally differently difficult in OOP and FP.</p>
<p>Wrt the Linux kernel, after so many years either it is wonderful or Hell on Earth. To make it wonderful it takes expertise and discipline (probably in different amounts depending on languages and paradigms, if there was a choice). A different approach was Hurd, supposedly more modular, it has not been so successful (possibly for non-technical reasons). Would it be more easy to change? We may never know.</p>
<p>Wrt fast software, it can be faster by removing nonsense or by using clever tricks. I have seen lots of both. While removing nonsense makes code cleaner, clever tricks usually make it more fragile, as they are often dependent on particular context conditions that may not be generalizable or not hold in the future. Therefore, I see the correlation between fast and maintainable as weak.</p>
</div>
<ol class="children">
<li id="comment-290669" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-02T02:08:24+00:00">November 2, 2017 at 2:08 am</time></a> </div>
<div class="comment-content">
<p>It is hard to build really fast systems by adding up clever tricks on top of a spaghetti. First step in making code fast is to have a great design.</p>
<p><em>Most paradigms (if not all) have been created to make better software more easily, taking different approaches. </em></p>
<p>In my view, programming is now a lot better than it was 20 years ago, but very little has to do with programming paradigms. For every scala programmer who swears by functional programming, you have a Go programmer who swears by the minimalistic nature of the language&#8230; and then you have tons of C++ programmers who swear by its amazing powers&#8230; and then you have the Python folks and so forth.</p>
<p>They are all correct.</p>
</div>
<ol class="children">
<li id="comment-290913" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/77ea7ac93c9ba630b2e6c0e38d62987d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/77ea7ac93c9ba630b2e6c0e38d62987d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://twitter.com/j_mora" class="url" rel="ugc external nofollow">jmora</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-05T18:22:21+00:00">November 5, 2017 at 6:22 pm</time></a> </div>
<div class="comment-content">
<p>Nobody said it would be easy. Sometimes the spaghetti is created by adding the clever tricks, until the software is unmaintainable and needs to be re-started from scratch.</p>
<p>Good software is robust. Bad software is fragile. Really bad software is unmaintainable. Good software processes result in anti-fragile software: modifying the code means refactorising it, producing better results. Software that is fast because it has been optimized for years may fall in the anti-fragile group, but what we would have in such case is a survivor bias. Software that has been optimized in ways that make it more fragile is simply not around for very long.</p>
<p>In short, I agree when you say: &ldquo;First step in making code fast is to have a great design&rdquo;, but I would reword it as: &ldquo;First step in making code fast _should be_ to have a great design&rdquo;. Then, making it fast could serve as a validation method of the quality of the design, but focusing on making the code fast is not going to be sufficient (or necessary) to make a good design, or to make a design good.</p>
<p>In contrast, I like this quote (found in the Falcon web page, a Python web framework):</p>
<p>&ldquo;Perfection is finally attained not when there is no longer anything to add, but when there is no longer anything to take away.&rdquo; &#8211; Antoine de Saint-Exupéry</p>
<p>The classic KISS, YAGNI, etc. is likely to produce code that is easy for humans to understand and maintain, and for computers to execute, to some extent, the problem being that computers and humans do not &ldquo;think&rdquo; in the same ways.</p>
<p>Now, different languages and paradigms forget about KISS in different ways. There are talks, books, collections of examples (e.g. the DailyWTF), and jokes[1] on that. But in a &ldquo;too late&rdquo; attempt at KISS, I stop digressing about that now, because there is just too much to discuss about it. </p>
<p>Finally, wrt everybody being correct, probably they are more than I will ever be, this is not my field of expertise (if I have any). Nevertheless, I think that using katas to evaluate paradigms and languages could be an interesting and acceptably scientific approach to some aspects of language design and software engineering that, still to date, are more akin to a craft or an art than to engineering as usually understood. Cognitive ergonomics is hard, IMHO.</p>
<p>[1] <a href="http://i.imgur.com/mh3P7CD.png" rel="nofollow ugc">http://i.imgur.com/mh3P7CD.png</a></p>
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
<li id="comment-290650" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6d633a9adb678ae58ba053b521b41844?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6d633a9adb678ae58ba053b521b41844?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://llogiq.github.io" class="url" rel="ugc external nofollow">llogiq</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-01T20:05:33+00:00">November 1, 2017 at 8:05 pm</time></a> </div>
<div class="comment-content">
<p>Correct and fast may be a good enough approximation for many cases. Alas, current systems require bespoke micro-optimizations to eke out the last 10s of percents of performance, as you are surely keenly aware.</p>
<p>Those optimizations make the code more specialized, less readable and thus less malleable. This directly contradicts your theory.</p>
<p>All is not lost however. Current plain Rust code will often perform within an order of magnitude of hand-optimized C code. The strong type system and borrow checker benefit writing correct code. Together this will likely lead to code that is easy to read and change, while being fast enough for many applications.</p>
<p>We don&rsquo;t have enough experience yet to tell whether this is also *good* code, but current results are encouraging.</p>
</div>
</li>
<li id="comment-290695" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/401da44c9202003f9b80bc745c6db1ed?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/401da44c9202003f9b80bc745c6db1ed?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://rastergraphics.worspress.com" class="url" rel="ugc external nofollow">Mauricio Lopez</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-02T23:01:56+00:00">November 2, 2017 at 11:01 pm</time></a> </div>
<div class="comment-content">
<p>Neither correct nor fast code imply good code. Why the combination of both should imply good quality? </p>
<p>Also you imply that optimizations can only be added to well designed code. That is false. Optimizations can be added easily to good code and can be added painfuly to bad code. The result is fast code, irrespective of quality. Similar statement can be said of correctness. </p>
<p>Accorsing to theory of computation the same software (fast and correct) can be equivalently expressed in several languages and very different ways, that accounts for the existence of bad code and good code solving the same problem in equivalent forms.</p>
</div>
<ol class="children">
<li id="comment-290767" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-03T15:26:10+00:00">November 3, 2017 at 3:26 pm</time></a> </div>
<div class="comment-content">
<p>I think that there is some confusion between &ldquo;applying optimizations&rdquo; and having &ldquo;fast code&rdquo;.</p>
<p>In my experience, it is very hard (in general) to make non-trivial software run faster. There is a reason why we have substantial performance differences between browsers, for example. It is not that the other guys, the team that is leading the slower browser, can just apply &ldquo;optimizations&rdquo; to make their browser faster. Optimizations don&rsquo;t come in the form of a magical powder you can spray on existing code.</p>
<p>It is very hard work to make things faster, just as it is very hard work to make it correct. Both are very demanding.</p>
</div>
</li>
</ol>
</li>
<li id="comment-290949" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/70da8631de4162dbc27f1aedd91de000?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/70da8631de4162dbc27f1aedd91de000?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://ithare.com/" class="url" rel="ugc external nofollow">'No Bugs' Hare</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-06T14:49:44+00:00">November 6, 2017 at 2:49 pm</time></a> </div>
<div class="comment-content">
<p>&gt; â€œThe best software is the software that is easy to change.â€<br/>
Depends on the metric of the quality (whatever marketing guys tell us, not all the software needs to be changed) &#8211; but as a default, it will do.</p>
<p>&gt; Code that is both correct and fast can be modified easily.</p>
<p>It is soooo wrong that I don&rsquo;t even see where to start. Being &ldquo;fast&rdquo; has absolutely nothing to do with being maintainable. Moreover, the-absolutely-fastest code tends to be rather unmaintainable. As for the examples &#8211; they&rsquo;re abundant; take, for example, OpenSSL &#8211; the fastest versions are still asm-based, and believe me, you really REALLY don&rsquo;t want to read this kind of asm, leave alone modify it&#8230; The same thing follows from Knuth&rsquo;s &ldquo;premature optimization is a root of all evil&rdquo;, and so on and so forth.</p>
</div>
<ol class="children">
<li id="comment-290954" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-06T16:27:49+00:00">November 6, 2017 at 4:27 pm</time></a> </div>
<div class="comment-content">
<p>I would probably rank OpenSSL as one of the greatest code bases of all times.</p>
</div>
</li>
</ol>
</li>
<li id="comment-290999" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/87a96a1ab9e1dbc56689c1d36667fb2d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/87a96a1ab9e1dbc56689c1d36667fb2d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://blog.tksfz.org" class="url" rel="ugc external nofollow">Tksfz</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-07T05:18:02+00:00">November 7, 2017 at 5:18 am</time></a> </div>
<div class="comment-content">
<p>This is demonstrably false. Correct code can be arbitrarily complicated while still being correct and this is true in a non-trivial sense. As for fast code being more maintainable, on the contrary, everyone knows to avoid premature optimization precisely because it&rsquo;s understood that optimization of code typically leads to more complicated, harder-to-maintain code. </p>
<p>For your argument that there&rsquo;s some kind of pressure that causes streamlined code to become more maintainable: on the contrary, it&rsquo;s fixing the corner cases and bugs that tends to cause large code bases to become even more complicated. </p>
<p>As for counterexamples: take two implementations of the same functionality, but one is implemented in C (or assembly if you want an extreme example) and the other is implemented in, say Ruby or Python or Java. The C program will undoubtedly be faster. But it will also undoubtedly be many times longer in length, and harder to maintain. I think you can easily imagine this. </p>
<p>As for the notion you assume that there is a trade-off between abstraction and performance, there&rsquo;s a widely pursued long-held goal with both C++ and Rust to enable abstraction with zero (runtime) cost. As for the notion that abstraction complicates things, I&rsquo;d agree &#8211; abstraction needs to be coupled with actual reuse to pay for itself. But I don&rsquo;t think abstraction implies a performance cost. </p>
<p>Am I misunderstanding your argument?</p>
</div>
</li>
<li id="comment-291014" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/33ba1c6213a1c4eb2ca6181a29fee8e4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/33ba1c6213a1c4eb2ca6181a29fee8e4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://wtpayne.info" class="url" rel="ugc external nofollow">William Payne</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-07T09:49:28+00:00">November 7, 2017 at 9:49 am</time></a> </div>
<div class="comment-content">
<p>Programming is about people, not code.</p>
<p>The ease with which something can be modified depends upon the person doing the modification and the knowledge that they have: Knowledge of the system, it&rsquo;s architecture, the requirements that it is designed to fulfil, the processes and tools used to develop; build; deploy and maintain it; how knowledge of different components is distributed around the organisation, and the social context within which it is developed and used. Even the notions of correctness and speed are a function of the expectations that have been set; and how those expectations have been communicated.</p>
<p>Having said that, the OP&rsquo;s instincts are right. Every time we add a new abstraction, we add new vocabulary, new concepts that need to be communicated and understood. Highly abstract code is only easier to modify if you already understand what it does. </p>
<p>This is why we as a community are so keen on idioms, standards, and the principle of least surprise. </p>
<p>As a final point, I would like to emphasise the fact that in order to perform well at our chosen discipline, we need to capture, organise and communicate a huge amount of information; only some of which is code. Architecture; vocabulary; the mental model which arises from our analysis of the problem, and the abstractions and concepts which arise in the design of it&rsquo;s solution &#8211; All of these need to be captured and communicated.</p>
<p>The teaching of other developers is the central problem that the programming discipline aims to solve. Recognise the truth in this, and we may finally make some progress.</p>
</div>
</li>
<li id="comment-291045" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/784316336915cd51997764d5896961fa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/784316336915cd51997764d5896961fa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mikhail Glushenkov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-07T21:53:48+00:00">November 7, 2017 at 9:53 pm</time></a> </div>
<div class="comment-content">
<p>&gt; What is nice about my conjecture is that it is falsifiable. That is, if you can come up with code that is fast and correct, but hard to modify, then you have falsified my conjecture. </p>
<p>Judy arrays come to mind.</p>
</div>
<ol class="children">
<li id="comment-291083" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1e5aa68931fd6f60e25314cc2f18d12b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1e5aa68931fd6f60e25314cc2f18d12b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://beza1e1.tuxen.de" class="url" rel="ugc external nofollow">qznc</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-08T14:35:38+00:00">November 8, 2017 at 2:35 pm</time></a> </div>
<div class="comment-content">
<p>I would say TeX is a counter example.</p>
<p>It is correct because Don Knuth says so. Proof by authority. Also, in use by thousands of people all over the world.</p>
<p>It is fast because it was usable on computer 30 years ago.</p>
<p>It is not easy to change. Just look at XeTeX and LuaTeX. Adding a feature like Unicode support is not easy.</p>
</div>
<ol class="children">
<li id="comment-291090" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-08T18:05:14+00:00">November 8, 2017 at 6:05 pm</time></a> </div>
<div class="comment-content">
<p>Interesting point.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-291170" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/787c2355d7333f7899f3077cc285189b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/787c2355d7333f7899f3077cc285189b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jake</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-10T18:20:29+00:00">November 10, 2017 at 6:20 pm</time></a> </div>
<div class="comment-content">
<p>For any compiled language, in order to even correctly measure its speed and correctness, you must first compile it into a less readable, less changeable instruction set. By definition, the compiled instruction set is equally fast and equally correct (as it&rsquo;s the artifact actually being measured.) But it is unquestionably harder to modify</p>
</div>
</li>
<li id="comment-291241" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6dc54e95bbb1442e9bb296f56726868d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6dc54e95bbb1442e9bb296f56726868d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://mormac39.no-ip.biz/?ref=0412.171111-1500" class="url" rel="ugc external nofollow">Randy A MacDonald</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-11T19:01:38+00:00">November 11, 2017 at 7:01 pm</time></a> </div>
<div class="comment-content">
<p>Code that is both correct and _small_ can be modified easily.<br/>
. smallness justifies merciless refactoring;<br/>
. smallness justifies removal of extraneous information.<br/>
. correctness, of course, justifies test-first development.</p>
</div>
</li>
<li id="comment-293617" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8fd675d09c5c7d4ae5608e531f6803a4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8fd675d09c5c7d4ae5608e531f6803a4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Andreas Abel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-16T10:19:09+00:00">December 16, 2017 at 10:19 am</time></a> </div>
<div class="comment-content">
<p>&gt; Code that is both correct and fast can be modified easily.<br/>
&gt; What is nice about my conjecture is that it is falsifiable. &#8230; So it is scientific!</p>
<p>I&rsquo;d be a bit careful here. A precondition is that there is a &ldquo;conjecture&rdquo;. That presupposes well-defined terms. </p>
<p>&ldquo;Code&rdquo; : not well-defined, but ok, we can think of a well-defined instance, like Haskell or Java code.<br/>
&ldquo;correct&rdquo; : you cannot be correct unless you have specification.<br/>
&ldquo;fast&rdquo; : not well-defined.<br/>
&ldquo;modified easily&rdquo; : not well-defined, little chance to come up with a definition.</p>
<p>First, before speaking about verification or falsification of a hypotheses, you need to have one. Meaning a statement whose meaning cannot be debated.</p>
<p>No science here (yet), I am afraid.</p>
</div>
</li>
</ol>
