---
date: "2009-04-08 12:00:00"
title: "Why are dynamic languages easier than static languages?"
index: false
---

[17 thoughts on &ldquo;Why are dynamic languages easier than static languages?&rdquo;](/lemire/blog/2009/04-08-why-are-dynamic-languages-easier-than-static-languages)

<ol class="comment-list">
<li id="comment-50850" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3d90e526857eabb3a2627b635f94895c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3d90e526857eabb3a2627b635f94895c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://bitcortex.com/" class="url" rel="ugc external nofollow">Rod Furlan</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-04-09T00:05:23+00:00">April 9, 2009 at 12:05 am</time></a> </div>
<div class="comment-content">
<p>I absolutely agree that dynamic languages are initially more productive and definitely easier to use than static languages.</p>
<p>My counter argument is that making code easier to write does not necessarily yield long term gains. In bigger projects, the lack of language formality can be detrimental to the maintenance bottom line.</p>
<p>Unit testing helps but we can&rsquo;t forget that unit tests are a form of sampling and as such, they tend to suffer from selection bias.</p>
<p>Static analysis, while limited in what it can accomplish, it has a 100% success rate for what is covered. </p>
<p>Unit tests on the other hand have a failure rate due to limited input/output/state coverage and should not be considered as a replacement for basic error checking (type mismatch, undefined vars, etc.) but as a supplement to it.</p>
</div>
</li>
<li id="comment-50853" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a7f4f9dcbbf1d46d660b0a6c98435751?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a7f4f9dcbbf1d46d660b0a6c98435751?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.johndcook.com/blog/" class="url" rel="ugc external nofollow">John</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-04-09T07:17:54+00:00">April 9, 2009 at 7:17 am</time></a> </div>
<div class="comment-content">
<p>Daniel, thank you for this post and for your reply on StackOverflow. I agree that duck typing speeds up the programming process. I&rsquo;ve experienced that in Python, and to a lesser extent with C++ templates. </p>
<p>Assume you could eliminate typing concerns completely: not only do you not have to explicitly type variables, but in addition you have some magical assurance that you won&rsquo;t introduce any type-related bugs. That would be great! But I don&rsquo;t imagine that would make someone 2x more productive. Do people really spend half their programming time on type-related matters?</p>
</div>
</li>
<li id="comment-50855" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-04-09T09:49:54+00:00">April 9, 2009 at 9:49 am</time></a> </div>
<div class="comment-content">
<p>@Kevin Roughly: Ontologies are formal definitions, folksonomies are informal and flexible &ldquo;de facto&rdquo; definitions.</p>
</div>
</li>
<li id="comment-50856" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/880cbab435f00197613c9cc2065b4f5a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/880cbab435f00197613c9cc2065b4f5a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Daniel Haran</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-04-09T09:51:48+00:00">April 9, 2009 at 9:51 am</time></a> </div>
<div class="comment-content">
<p>This week I presented Ruby on Rails to two senior developers at a company &#8211; one doing Java, the other .Net work.</p>
<p>I expect developers to express surprise at the speed of development, scaffolding, validations or migrations. I was shocked that script/console seemed to them the biggest gain. This is such a basic tool for me now, any language that doesn&rsquo;t have it seems broken.</p>
<p>There&rsquo;s a lot of culture and tools surrounding a language. Sometimes those tools require certain language features to even be possible. Either way, part of the reason programmers are more productive with these languages doesn&rsquo;t have anything at all to do with the language itself. Refactoring support is nice in theory, but a faster REPL kicks it in the nuts.</p>
<p>Not having a lot of ceremony means a single person can try lots of small personal projects and *become a better hacker, faster*.</p>
<p>Type:</p>
<p>In 3 years working with Ruby, I&rsquo;ve yet to have a type mismatch problem that wasn&rsquo;t caught by unit tests.</p>
<p>Having worked on very large Java apps I&rsquo;d say the sheer magnitude of the code base is a maintainability hazard. Smaller code bases do in fact yield long-term gains.</p>
<p>3 years ago, many people dissed RoR as a toy, but it was promptly copied by nearly every language community. &ldquo;Oh, that&rsquo;s nice, but that&rsquo;s only for greenfield development&rdquo;. Now it&rsquo;s &ldquo;Oh, that&rsquo;s nice, but you couldn&rsquo;t ever do a big project with Ruby&rdquo;</p>
<p>The skeptics have a poor track record on this one 🙂</p>
</div>
</li>
<li id="comment-50857" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-04-09T09:52:21+00:00">April 9, 2009 at 9:52 am</time></a> </div>
<div class="comment-content">
<p>@Reinier Thanks for the insights and corrections. But I doubt my blog post will turn even one programmer away from Python. 😉</p>
</div>
</li>
<li id="comment-50858" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3d90e526857eabb3a2627b635f94895c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3d90e526857eabb3a2627b635f94895c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bitcortex.com/" class="url" rel="ugc external nofollow">Rod Furlan</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-04-09T10:37:04+00:00">April 9, 2009 at 10:37 am</time></a> </div>
<div class="comment-content">
<p>&ldquo;In 3 years working with Ruby, I&rsquo;ve yet to have a type mismatch problem that wasn&rsquo;t caught by unit tests.&rdquo;</p>
<p>In 15 years working with C++ I&rsquo;ve yet to have a type mismatch problem that wasn&rsquo;t caught by the compiler.</p>
<p>The difference is that I didn&rsquo;t have to build or maintain the compiler 🙂</p>
<p>As I said on my previous comment, while static analysis might have a limited scope it has a 100% success rate and it does not cost you anything to build or maintain.</p>
<p>Unit tests should be considered a supplemental measure because it have a non-quantifiable failure rate. Your code could pass all your tests and still have silly type mismatch/undefined var errors in covered code due to uncovered input/state parameters.</p>
</div>
</li>
<li id="comment-50859" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a7f4f9dcbbf1d46d660b0a6c98435751?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a7f4f9dcbbf1d46d660b0a6c98435751?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.johndcook.com/blog/" class="url" rel="ugc external nofollow">John</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-04-09T10:53:36+00:00">April 9, 2009 at 10:53 am</time></a> </div>
<div class="comment-content">
<p>I think Ruby gets credit that rightfully belongs to Ruby on Rails. RoR is designed to make routine web development easy. Programmers give up control of many details in exchange for fast development. That&rsquo;s a great idea. Most developers don&rsquo;t need the level of control they think they do.</p>
<p>But if DHH had been a Python programmer and had written a Python on Rails web framework, I imagine people would see equivalent productivity gains.</p>
</div>
</li>
<li id="comment-50851" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dad76156ab304d9571fca2ca5d45cdc1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dad76156ab304d9571fca2ca5d45cdc1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://zwitserloot.com/" class="url" rel="ugc external nofollow">Reinier Zwitserloot</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-04-09T06:20:30+00:00">April 9, 2009 at 6:20 am</time></a> </div>
<div class="comment-content">
<p>Duck typing isn&rsquo;t static typing.</p>
<p>Some languages are statically typed but infer almost the entire type graph, such as Boo.</p>
<p>I believe you meant to say:</p>
<p>Dynamic, Latent, Structurally typed languages like Python or Ruby are considerably easier than static, manifest, nominally typed languages like Java and C++.</p>
<p>Also note that as far as usefulness of type graphs go, your two examples (Java and C++) mostly suck at being useful with them; neither language truly does type systems particularly well. For example, java does now have generics, but it cannot express generic positional wildcards (&lsquo;meta-generics&rsquo;, where I say: X is any type which has exactly 1 generics parameter, where e.g. that parameter is called &lsquo;Y&rsquo; and extends Number), its generics are not reified (at runtime, instances of objects forget their generics), and their generic types are not considered in the type graph (You cannot implement both Comparable and Comparable at the same time).</p>
<p>At the risk of sounding rude, it&rsquo;s exactly these kinds of posts that keep the smart programmer AWAY from Python and Ruby. The rabid and mostly clueless blather of supporters on their type systems is a big fat red dot in the &lsquo;reasons NOT to join this community&rsquo; column.</p>
<p>FWIW, I think you&rsquo;re mostly on the right track, at least from small projects. The value of your static type graph grows exponential with the size of your code base.</p>
<p>Also: A big part of utility for static type graphs lies in your tooling. If you&rsquo;re hacking away in notepad, no amount of type graph awesomeness (think Haskell) is really going to help all that much, which makes it so painful that there&rsquo;s no good haskell editor. Java (and smalltalk, for those who know what that is) shows what can happen when people write nice tools: Amazing refactor support, no need to learn APIs through and through (auto-complete will tell you all you need to know), and interfaces that mostly write themselves, as well as very decent auto-bug-checking, generally in areas where you weren&rsquo;t thinking of (so areas where unit tests don&rsquo;t do particularly well, historically). You do need to kit out your java build process with PMD or FindBugs to get this, but that isn&rsquo;t very difficult.</p>
<p>Now imagine those tools combined with tricks only serious type systems, such as haskell&rsquo;s, can do, like automatically generating unit tests, or inferring a large chunk of the type graph, and its clear to me that the hypothetical best programming language ever would have static typing. We&rsquo;re just not there yet.</p>
</div>
</li>
<li id="comment-50852" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dad76156ab304d9571fca2ca5d45cdc1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dad76156ab304d9571fca2ca5d45cdc1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://zwitserloot.com/" class="url" rel="ugc external nofollow">Reinier Zwitserloot</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-04-09T06:27:24+00:00">April 9, 2009 at 6:27 am</time></a> </div>
<div class="comment-content">
<p>those two comparables were meant to be Comparable of Integer, and Comparable of String, but the HTML tag remover got to them.</p>
</div>
</li>
<li id="comment-50860" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/880cbab435f00197613c9cc2065b4f5a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/880cbab435f00197613c9cc2065b4f5a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Daniel Haran</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-04-09T13:20:31+00:00">April 9, 2009 at 1:20 pm</time></a> </div>
<div class="comment-content">
<p>John: I think you are correct.</p>
<p>It&rsquo;s telling though that you used Python as an example, it&rsquo;s one of the few languages a high-level framework like Rails can effectively be built in.</p>
<p>If much of the power of Rails is from Ruby, a lot of the productivity gains are from cultural aspects. &ldquo;Convention over configuration&rdquo;, writing tests, YAGNI, DRY&#8230; the list goes on.</p>
</div>
</li>
<li id="comment-50861" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/880cbab435f00197613c9cc2065b4f5a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/880cbab435f00197613c9cc2065b4f5a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Daniel Haran</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-04-09T13:26:08+00:00">April 9, 2009 at 1:26 pm</time></a> </div>
<div class="comment-content">
<p>Daniel: without getting too formal about it, do you have a good definition of &ldquo;productivity&rdquo;?</p>
<p>Normally we measure as how fast you can get to a certain outcome, but with dynamic languages these outcomes are often quite different.</p>
</div>
</li>
<li id="comment-50854" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ffa727c56fac05e11ee84f798e93eed7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ffa727c56fac05e11ee84f798e93eed7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://noteonx.blogspot.com/" class="url" rel="ugc external nofollow">Kevin</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-04-09T09:28:30+00:00">April 9, 2009 at 9:28 am</time></a> </div>
<div class="comment-content">
<p>Could anyone explain the second difference: Ontologies vs Folksonomies? I don&rsquo;t get it.</p>
</div>
</li>
<li id="comment-50862" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-04-09T15:22:48+00:00">April 9, 2009 at 3:22 pm</time></a> </div>
<div class="comment-content">
<p>@Haran No, I don&rsquo;t have a good definition of productivity. In fact, I would love to find a way to determine how productive I am, in general. Alas, I never found any satisfying measure. My salary is a poor measure of my productivity.</p>
<p>But that is also my whole point, formal definitions are not as useful as you may think. I don&rsquo;t need a definition of productivity to work with the concept.</p>
</div>
</li>
<li id="comment-50863" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3d90e526857eabb3a2627b635f94895c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3d90e526857eabb3a2627b635f94895c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bitcortex.com/" class="url" rel="ugc external nofollow">Rod Furlan</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-04-09T17:13:18+00:00">April 9, 2009 at 5:13 pm</time></a> </div>
<div class="comment-content">
<p>I think TCO would be the ideal metric of productivity. A language that can deliver a piece of software with a lower lifetime TCO should be considered more productive because more was produced for less.</p>
<p>TCO encompasses everything from time-to-market risk, development costs, maintenance cost, failure-rate cost as well any other overhead incurred.</p>
<p>Without a formal definition of metrics used for comparison and decision making, everything is just subjective opinion and nothing can be objectively quantified.</p>
</div>
</li>
<li id="comment-50866" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9ebcb424936c7a6d6eb19bc6607f0f96?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9ebcb424936c7a6d6eb19bc6607f0f96?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://singyourownlullaby.blogspot.com" class="url" rel="ugc external nofollow">mariana</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-04-15T03:30:13+00:00">April 15, 2009 at 3:30 am</time></a> </div>
<div class="comment-content">
<p>I do not understand the 4 by 2 chart comparing the 2 styles. Can you clarify it a little for me.<br/>
-For example how do you compare a folksonomy with an Ontology? you can say that a folksonomy is the informal version of a taxonomy, but an ontology has a much more complex structure, that includes logical inference.<br/>
-Why can&rsquo;t static language have a sort of generic solution?</p>
<p>Anyway I completely agree that dynamic languages are easier, I am a phython fan.</p>
<p>Comment:I think you are kind of mixing definition with metric of productivity. I was wondering if you need a definition of a concept to be able to measure it. Or if you have a metric, is the definition allways deducible from it?</p>
</div>
</li>
<li id="comment-50868" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-04-15T08:39:44+00:00">April 15, 2009 at 8:39 am</time></a> </div>
<div class="comment-content">
<p><i>For example how do you compare a folksonomy with an Ontology? you can say that a folksonomy is the informal version of a taxonomy, but an ontology has a much more complex structure, that includes logical inference.</i></p>
<p>Ontologies require definitive definitions. You need to know the identity of object A if you are to use the ontology on object A.</p>
<p>Folksonomies do not require definitions. Yet, they effectively define classes and features.</p>
<p><i>Why can&rsquo;t static language have a sort of generic solution?</i></p>
<p>It is not that they can&rsquo;t, they do, but the make the programmer pay a price.</p>
<p><i>I was wondering if you need a definition of a concept to be able to measure it.</i></p>
<p>No. You don&rsquo;t. I can tell you that it is warm or cold outside without any definition of what it means to be warm or cold.</p>
</div>
</li>
<li id="comment-50872" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9ebcb424936c7a6d6eb19bc6607f0f96?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9ebcb424936c7a6d6eb19bc6607f0f96?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://SingYourOwnLullaby.blogspot.com" class="url" rel="ugc external nofollow">Mariana</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-04-18T00:16:55+00:00">April 18, 2009 at 12:16 am</time></a> </div>
<div class="comment-content">
<p>Thank you very much for your clarifications!</p>
</div>
</li>
</ol>
