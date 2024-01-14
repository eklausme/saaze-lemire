---
date: "2016-03-25 12:00:00"
title: "Declarative programming is a dead-end for the lowly programmer"
index: false
---

[19 thoughts on &ldquo;Declarative programming is a dead-end for the lowly programmer&rdquo;](/lemire/blog/2016/03-25-declarative-programming-is-a-dead-end-for-the-lowly-programmer)

<ol class="comment-list">
<li id="comment-233453" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-03-25T16:13:59+00:00">March 25, 2016 at 4:13 pm</time></a> </div>
<div class="comment-content">
<p>Minimal cue: View HTML as Lisp written with a funny notion. As with Lisp, you define your own atoms (tags) and attach behavior.</p>
<p>I failed to explain this well to the HTML5 WG early. So the plumbing is a bit of a mess. We since have frameworks that use exactly this approach.</p>
<p>Lisp is usually described as extensible. 🙂</p>
</div>
<ol class="children">
<li id="comment-233454" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-03-25T16:21:30+00:00">March 25, 2016 at 4:21 pm</time></a> </div>
<div class="comment-content">
<p>I meant the above as a metaphor. Just occurred to me, you could take literally, and implement Lisp using HTML and Javascript. </p>
<p>An amusing and horrible notion. 🙂</p>
</div>
</li>
</ol>
</li>
<li id="comment-233492" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/abc66ea88dfdf7ab4b52f1d41a7727fd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/abc66ea88dfdf7ab4b52f1d41a7727fd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Matt</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-03-25T23:56:24+00:00">March 25, 2016 at 11:56 pm</time></a> </div>
<div class="comment-content">
<p>So, logical languages (like Prolog, miniKanren, etc.) are also declarative. Do they fall under the same criticisms? They are not mainstream programming, and are used to handle a different domain of problems.</p>
</div>
<ol class="children">
<li id="comment-233497" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-03-26T00:40:14+00:00">March 26, 2016 at 12:40 am</time></a> </div>
<div class="comment-content">
<p><em>So, logical languages (like Prolog, miniKanren, etc.) are also declarative.</em></p>
<p>I would claim that they are obvious dead-ends for the lowly programmer.</p>
</div>
<ol class="children">
<li id="comment-233517" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8e2e3a01bf33747391457d97e0df832b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8e2e3a01bf33747391457d97e0df832b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Andre Vellino</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-03-26T03:24:30+00:00">March 26, 2016 at 3:24 am</time></a> </div>
<div class="comment-content">
<p>Maybe you are right about Prolog Haskell etc (that they are dead ends for programmers) but not for the same reasons. A prolog programmer can solve all the same problems as a python programmer.</p>
</div>
<ol class="children">
<li id="comment-233520" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-03-26T03:48:38+00:00">March 26, 2016 at 3:48 am</time></a> </div>
<div class="comment-content">
<p>Andre: There is a pattern to this madness though. XSLT is &ldquo;hot and new&rdquo; and yet it is as much a dead-end as Prolog on Haskell.</p>
</div>
<ol class="children">
<li id="comment-233731" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/abc66ea88dfdf7ab4b52f1d41a7727fd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/abc66ea88dfdf7ab4b52f1d41a7727fd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Matt</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-03-28T03:23:18+00:00">March 28, 2016 at 3:23 am</time></a> </div>
<div class="comment-content">
<p>I thought XSLT rose and fell in the 2000s&#8230; I haven&rsquo;t seen it being &ldquo;hot and new&rdquo;&#8230;</p>
</div>
<ol class="children">
<li id="comment-233791" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-03-28T15:12:31+00:00">March 28, 2016 at 3:12 pm</time></a> </div>
<div class="comment-content">
<p>Compared to Prolog, XSLT is hot and new.</p>
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
</ol>
</li>
<li id="comment-233526" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c4bb0e94e0f705dc3647722d55b71b84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c4bb0e94e0f705dc3647722d55b71b84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.e-dejong.com" class="url" rel="ugc external nofollow">edward de jong</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-03-26T04:55:41+00:00">March 26, 2016 at 4:55 am</time></a> </div>
<div class="comment-content">
<p>Dear Mr. Lemire,</p>
<p>The distinction between declarative, imperative, functional programming is like beauty. In the eye of the beholder. It is true that highly focused declarative languages can give one they are not particularly flexible. But every so-called functional language has declarative aspects, and even good fortran programs from 50 years ago made heavy use of functions, so weren&rsquo;t they functional too? I find all these terms unproductive. Programmers are always looking for leverage, and generality. Sometimes a powerful tool is narrow in application. Occasionally a nice balance between flexibility and general purpose use arises, and that language becomes popular. The best languages and tools rarely become popular because as an industry, programmers are more attuned to job protection than productivity. I have seen time and time again an inferior language or toolchain adopted, always with the excuse that it is more popular and therefore &ldquo;safer&rdquo;. I have been working on a new language that combines some of the most powerful features of prolog, with the cleanliness of Modula-2, and novel data structures. Since algorithms + data structures = programs, isn&rsquo;t the lack of innovation in data structures really the problem nowadays? Seems to me that the relational table is a dead-end. As for LISP, its insidious parenthetical notation makes it unreadable to most people, and transformative languages as categorized by John Backus don&rsquo;t transfer well between people, which is probably why he never liked them. The truth is that all languages are merely a notation that allows one to more conveniently express a program that ultimately is mapped to the low level instruction set of the CPU, which hasn&rsquo;t change significantly in 50 years; we still have memory, registers, the basic operations, boolean, etc. &#8230; so every program is a bridge from the problem domain to a CPU implementation, and the directness, brevity, clarity, simplicity, all very depending on the language and toolchain selected. The goal of modern language design is improve our overall productivity by simplifying and streamlining the notation, and introducing new productive concepts.</p>
</div>
</li>
<li id="comment-233665" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/648cbb3135d4aa4ca7fc2a7849d7acd2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/648cbb3135d4aa4ca7fc2a7849d7acd2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://cs.coloradocollege.edu/~bylvisaker/" class="url" rel="ugc external nofollow">Ben</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-03-27T12:50:13+00:00">March 27, 2016 at 12:50 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ll add my voice to the small chorus that I think &ldquo;declarative&rdquo; is not the best word for the languages you&rsquo;re lumping together. I think the general purpose vs special purpose/domain specific spectrum is much more relevant.</p>
<p>Agreeing with Andre: You can say bad things about the marketability of functional language programming skills. However, languages like Haskell and OCaml are _at least_ as extensible as languages Java, Python or R. If you insist on ranking the latter over the former, then I think you&rsquo;re just talking about the vibrancy of the respective library ecosystems, which has little to do with the technical properties of the languages themselves.</p>
</div>
</li>
<li id="comment-234811" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/321b7bbd03fc1a7f0f4607d3466eb739?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/321b7bbd03fc1a7f0f4607d3466eb739?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jim Peiffer</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-04-05T20:54:53+00:00">April 5, 2016 at 8:54 pm</time></a> </div>
<div class="comment-content">
<p>&#8230;perhaps why I am an &ldquo;Applications Developer&rdquo; and not a &ldquo;Programmer&rdquo; &#8211; lowly or otherwise? </p>
<p>Found this blog as a reference from something else I was researching. Over my head, but incredibly interesting. I&rsquo;ll come back when I can.</p>
</div>
</li>
<li id="comment-236252" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/75d94bf3d2f3bef523e21d102bdde89c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/75d94bf3d2f3bef523e21d102bdde89c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">RLa</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-04-18T14:31:25+00:00">April 18, 2016 at 2:31 pm</time></a> </div>
<div class="comment-content">
<p>I use Prolog to write web applications yet I&rsquo;m not a PhD or a Google engineer. I get well paid for doing it. Yet by your article it&rsquo;s s dead end for me. I definitely do not agree with this.</p>
</div>
<ol class="children">
<li id="comment-236262" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-04-18T16:09:00+00:00">April 18, 2016 at 4:09 pm</time></a> </div>
<div class="comment-content">
<p>I am sure you also use SQL. Most web folks do. A lot of them get well paid.</p>
</div>
</li>
</ol>
</li>
<li id="comment-246702" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1056a38ecd323c658a8c9e93bb41b18d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1056a38ecd323c658a8c9e93bb41b18d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://maxtoroq.github.io/" class="url" rel="ugc external nofollow">Max Toro</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-11T05:19:31+00:00">July 11, 2016 at 5:19 am</time></a> </div>
<div class="comment-content">
<p>SQL, HTML and CSS are domain-specific. What&rsquo;s the point of using the same language for every domain?</p>
<p>How about the problems you can solve with SPARQL, those are not interesting?</p>
<p>XSLT might be a dead end, yet it&rsquo;s the most advanced language I know, with built-in service location, dependency injection, pattern-matching at the declaration level and high code reusability in both in source and compiled (in 3.0) form.</p>
<p>JavaScript sucks.</p>
</div>
</li>
<li id="comment-253045" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3f0dca2a49b77013585c0fd9cffb267c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3f0dca2a49b77013585c0fd9cffb267c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://twitter.com/trylks" class="url" rel="ugc external nofollow">trylks</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-22T00:27:55+00:00">September 22, 2016 at 12:27 am</time></a> </div>
<div class="comment-content">
<p>&lsquo;I use the term â€œlowly programmerâ€ to distinguish regular programmers from PhDs with IQs above 200 and teams of highly paid Google engineers.&rsquo;</p>
<p>I would like to be one of those &ldquo;highly paid Google engineers&rdquo;. You can remove the &ldquo;Google&rdquo; name from there, that doesn&rsquo;t change anything. that would make for a more interesting blog post.</p>
</div>
</li>
<li id="comment-267387" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1f5f4eb97e56150618912359a7ffb964?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1f5f4eb97e56150618912359a7ffb964?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Syh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-23T01:15:37+00:00">January 23, 2017 at 1:15 am</time></a> </div>
<div class="comment-content">
<p>Css is not Turing complete. Do you even know what that means?</p>
</div>
<ol class="children">
<li id="comment-267563" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-23T14:41:10+00:00">January 23, 2017 at 2:41 pm</time></a> </div>
<div class="comment-content">
<p>See <a href="https://lemire.me/blog/2011/03/08/breaking-news-htmlcss-is-turing-complete/" rel="ugc">http://lemire.me/blog/2011/03/08/breaking-news-htmlcss-is-turing-complete/</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-415886" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a071db2c28a76fca4d84929d907d0b4b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a071db2c28a76fca4d84929d907d0b4b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">mike</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-06T06:15:22+00:00">July 6, 2019 at 6:15 am</time></a> </div>
<div class="comment-content">
<p>I liked your provacative article.</p>
<p>Declarative languages like sql are not a dead end.</p>
<p>Thats like saying the axioms of group theory are a dead end because they havent changed since they were formulated.</p>
<p>Sql has been extended with analytic clauses, model clauses, procedural calls, inline functions&#8230; and some relational databses can now handle objects, xml, json.</p>
<p>Also declarative &ldquo;code&rdquo; is being more widely used to control cutting edge products like Docker and Kubernetes.</p>
<p>Products like Spring tools are becoming more and more decalarative.</p>
<p>Lowly programmers are becoming more like army generals who commands their forces by issuing orders which can be specific procedural: advance 5 mile to hill x or declarative: surround the enemy seventh corp with battalion ten.</p>
</div>
</li>
<li id="comment-443502" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6317402e3c1586ea633b97c308211fd0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6317402e3c1586ea633b97c308211fd0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://mzsolt.blogspot.com/" class="url" rel="ugc external nofollow">Zsolt Minier</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-15T17:35:45+00:00">November 15, 2019 at 5:35 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
Java, C, JavaScript, PHP, Python… all these languages make it easy to build any software you like.
</p></blockquote>
<p>Understatement of the century. I think if it was so easy to do anything we like in these languages, there would be no need for CSS/HTML/SQL. These latter languages solve problems that are <em>nearly</em> impossible to solve in Java, C, &#8230; That&rsquo;s why they exist and will always exist.</p>
</div>
</li>
</ol>
