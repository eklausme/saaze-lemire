---
date: "2013-03-05 12:00:00"
title: "Do NULL markers in SQL cause any harm?"
index: false
---

[20 thoughts on &ldquo;Do NULL markers in SQL cause any harm?&rdquo;](/lemire/blog/2013/03-05-do-null-markers-in-sql-cause-harm)

<ol class="comment-list">
<li id="comment-74342" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ca33cf3a10766186f28474e097ad0890?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ca33cf3a10766186f28474e097ad0890?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://daniel.yokomizo.org" class="url" rel="ugc external nofollow">Daniel Yokomizo</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-05T12:20:58+00:00">March 5, 2013 at 12:20 pm</time></a> </div>
<div class="comment-content">
<p>Tony Hoare called null references his billion dollar mistake (<a href="http://www.infoq.com/presentations/Null-References-The-Billion-Dollar-Mistake-Tony-Hoare" rel="nofollow ugc">http://www.infoq.com/presentations/Null-References-The-Billion-Dollar-Mistake-Tony-Hoare</a>), similar reasoning applies to 3-valued logic. It&rsquo;s very easy to get bugs in queries when you forget to handle nulls and such bugs usually aren&rsquo;t noticed until very late in the development cycle. It also leads to things like automatically conversion of values to NULL and vice-versa (e.g. empty varchars are NULL in Oracle).</p>
</div>
</li>
<li id="comment-74343" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.apperceptual.com/" class="url" rel="ugc external nofollow">Peter Turney</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-05T12:34:48+00:00">March 5, 2013 at 12:34 pm</time></a> </div>
<div class="comment-content">
<p>Many-valued logic is not inherently inconsistent (see <a href="http://plato.stanford.edu/entries/logic-manyvalued/" rel="nofollow ugc">http://plato.stanford.edu/entries/logic-manyvalued/</a>). Why not allow three values but use a consistent logic?</p>
</div>
</li>
<li id="comment-74344" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7efeeb0d9fe2a53e84d0d77e2ab7e44e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7efeeb0d9fe2a53e84d0d77e2ab7e44e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christopher Smith</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-05T12:39:59+00:00">March 5, 2013 at 12:39 pm</time></a> </div>
<div class="comment-content">
<p>I think people unfairly treat clustering of their bugs around features as indications that those features are a huge problem. NULL is a classic case of this.</p>
<p>Yes NULL is error prone. Yes NULL is inconsistent. Yes a lot of errors occur because of NULL.</p>
<p>That&rsquo;s because NULL is a necessary tool to address error prone, inconsistent aspects of reality. We need it.</p>
</div>
</li>
<li id="comment-74346" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-05T12:44:43+00:00">March 5, 2013 at 12:44 pm</time></a> </div>
<div class="comment-content">
<p>@Peter Turney</p>
<p>Assuming that you do want 3-value logic, there is a computational cost to pay if you want consistency. Yet efficiency is very important for a database system, maybe more so than theoretical rigor.</p>
<p>Let me quote John Grant from &ldquo;Null Values in SQL&rdquo;:</p>
<blockquote><p>
Using Kleene&rsquo;s 3-valued logic I showed that a truth-functional (i.e. the connectives are defined by truth-tables) 3-valued logic, where the third truth value stands for â€unknownâ€, will not give some formulas the correct truth value, and proposed a non-truth-functional 3-valued logic that gives all formulas correct truth values. In the case of null values for a relational database this means that the 3-valued logic truth tables used by Codd (the same as in Kleene&rsquo;s 3-valued logic) do not always give correct answers to queries. First I wrote to Dr. Codd explaining the problem and after his reply I wrote a short article pointing out the problem. (&#8230;) for the correct evaluation of a query in the presence of a null value, all different cases must be considered.
</p></blockquote>
<p>What is amazing to me is that Codd got away with an inconsistent 3-value system and not only that, but this became the de facto standard for database systems.</p>
</div>
</li>
<li id="comment-74347" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a91e245ecf7e7d842c5ac290608d0946?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a91e245ecf7e7d842c5ac290608d0946?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.essi.upc.edu/~farre/" class="url" rel="ugc external nofollow">Carles FarrÃ©</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-05T13:14:16+00:00">March 5, 2013 at 1:14 pm</time></a> </div>
<div class="comment-content">
<p>3-valued logic is &ldquo;flattened&rdquo; in SQL: In SELECT sentences, if the whole WHERE expression is &ldquo;unknown&rdquo; then it is assumed to be &ldquo;false&rdquo;. In constrat, in CHECK constraints, if the expression is evaluated to &ldquo;unknown&rdquo; (e.g. CHECK X&gt;0) then it is assumed to be &ldquo;true&rdquo;.<br/>
Some aggegate operators behave in a contra-intuitive way in presence of NULL marks.<br/>
However, there is, in my opinion, a situation where NULLs make sense: when representing a N:0..1 relationship between two tables and you don&rsquo;t want to have an extra table to represent such a relationship.</p>
</div>
</li>
<li id="comment-74359" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7efeeb0d9fe2a53e84d0d77e2ab7e44e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7efeeb0d9fe2a53e84d0d77e2ab7e44e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christopher Smith</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-05T15:30:06+00:00">March 5, 2013 at 3:30 pm</time></a> </div>
<div class="comment-content">
<p>I should clarify my previous post: obviously there are ways to get the job done without NULL. However, we need to model and address the bits of reality that give rise to NULL, and while their are approaches that avoid the Date&rsquo;s theoretical problem with NULL, I don&rsquo;t think there is an approach which avoids all the bugs that so often occur and are attributed to NULL. Unlike say, C&rsquo;s buffer overflows or NULL terminated strings, the bugs are caused by the nature of the problem, not the nature of the solution.</p>
<p>I&rsquo;d even argue NULL handles those problems better than most other solutions I&rsquo;ve seen, but perhaps someone has a better alternative.</p>
</div>
</li>
<li id="comment-74464" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dominic Amann</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-06T09:10:59+00:00">March 6, 2013 at 9:10 am</time></a> </div>
<div class="comment-content">
<p>An interesting side note &#8211; in ieee floating point representation, there is &ldquo;NaN&rdquo; (not a number). If I have</p>
<p>double a = numberic_limits::quietNaN();</p>
<p>bool e = (a == a);</p>
<p>will evaluate to false.</p>
</div>
</li>
<li id="comment-74468" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dominic Amann</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-06T09:38:54+00:00">March 6, 2013 at 9:38 am</time></a> </div>
<div class="comment-content">
<p>@Daniel I agree it follows the standard. I was cnotrasting its behaviour to sql&rsquo;s null.</p>
</div>
</li>
<li id="comment-74497" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dominic Amann</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-06T12:43:57+00:00">March 6, 2013 at 12:43 pm</time></a> </div>
<div class="comment-content">
<p>@Danieal &#8211; you may be right &#8211; I wasn&rsquo;t commenting on the rightness of the approach, just the different choice. Sorry I wasn&rsquo;t clear.</p>
<p>To look at Codd&rsquo;s approach &#8211; I think there are two problems here:</p>
<p>one is &ldquo;this answer is not defined for the arguments given&rdquo;, and the other is &ldquo;this data item has not been assigned a value&rdquo;.</p>
</div>
</li>
<li id="comment-74467" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-06T09:23:57+00:00">March 6, 2013 at 9:23 am</time></a> </div>
<div class="comment-content">
<p>@Dominic Amann</p>
<p>NaN is supposed to be non-reflexive under IEEE 734. C++ supports IEEE 734.</p>
<p>PostgreSQL and Oracle do claim to support IEEE 734 but I think that their NaN is reflexive (thus violating the standard).</p>
<p>IEEE 734 is logically consistent, and relies on simple 2-value logic (false or true). Elements in IEEE 734 do not form equivalence classes, however, but that is not required for logical consistency.</p>
</div>
</li>
<li id="comment-74469" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-06T09:49:19+00:00">March 6, 2013 at 9:49 am</time></a> </div>
<div class="comment-content">
<p>@Dominic Amann</p>
<p>Well, the designers of IEEE 734 did not see a need to use 3-value logic. I think they were right. I think Codd was wrong.</p>
</div>
</li>
<li id="comment-74510" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b396ad0823bf6f19707a27012b865a81?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b396ad0823bf6f19707a27012b865a81?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Onne</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-06T15:39:50+00:00">March 6, 2013 at 3:39 pm</time></a> </div>
<div class="comment-content">
<p>Actually &ldquo;1 = NULL&rdquo; might not be false, but it is falsy. That is, SELECT * FROM table WHERE field = null; will simply select nothing, because the predicate is always falsy, even if field itself contains null for a record.</p>
<p>The trouble is when you expect negation of falsy. The negation of something undefined is still undefined. Hence &ldquo;not null&rdquo; is still null in sql. And &ldquo;1 null&rdquo; is still falsy. (But funny enough, &ldquo;1 (null OR false)&rdquo; is true because &ldquo;null OR false&rdquo; is false and not null but &ldquo;null AND true&rdquo; is null.)</p>
<p>The conclusion is, read the SQL null as &ldquo;undefined&rdquo; or &ldquo;don&rsquo;t know&rdquo;, where the c/c++/java null is more like zero. Too bad javascript has undefined, but &ldquo;undefined == undefined&rdquo; is true. So undefined in javascript is just a marker and not a true undefined value, like null is in sql. But then javascript has NaN and &ldquo;NaN == NaN&rdquo; is false. So NaN behaves like a real undefined value.</p>
<p>If anything, sql could benefit from a value that represents undefined and a value that represents nothing. But maybe todays situation is better, otherwise nobody would understand which value to use in what situation. And now everybody gets burned by sql null at least once and then learns 🙂</p>
</div>
</li>
<li id="comment-74500" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-06T13:45:26+00:00">March 6, 2013 at 1:45 pm</time></a> </div>
<div class="comment-content">
<p>@Dominic Amann</p>
<p>Yes. Codd did, in fact, propose to handle different markers to represent just the kind of distinctions you are making, but it was never picked up.</p>
</div>
</li>
<li id="comment-74513" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-06T15:57:18+00:00">March 6, 2013 at 3:57 pm</time></a> </div>
<div class="comment-content">
<p>@Onne</p>
<p><em>The trouble is when you expect negation of falsy</em></p>
<p>I think that the trouble is deeper than that. You do end up with inconsistent results. Period. It is not just that NULL is difficult to understand, it is mathematically improper. Please see the detailed explanation Grant gave: <a href="http://www09.sigmod.org/sigmod/record/issues/0809/p23.grant.pdf" rel="nofollow ugc">http://www09.sigmod.org/sigmod/record/issues/0809/p23.grant.pdf</a></p>
<p>Even Codd admitted as much: to him, the NULL markers were outside of the relational model and not subject to normalization. He knew of the problems, because they were reported to him, but he viewed them as irrelevant.</p>
<p>In some sense, history proved him right. Or did it?</p>
</div>
</li>
<li id="comment-74553" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b396ad0823bf6f19707a27012b865a81?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b396ad0823bf6f19707a27012b865a81?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Onne</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-07T02:03:01+00:00">March 7, 2013 at 2:03 am</time></a> </div>
<div class="comment-content">
<p>@Daniel</p>
<p>In the example of the paper, P1 has NULL for a city, and the author poses that whatever you fill in for NULL, it must result in the predicate to become true. However, maybe the parts supplier P1 is omnipresent, it is in every city all at once. In that case the predicate should stay false on two accounts: P1 is the same city as S1 and P1 is in Paris.</p>
<p>NULL is not a value, it is outside the domain of the values that could have been in its place.</p>
<p>Is that mathematically improper? I am not convinced; it is practical, however. So yes, I think Codd was proven right.</p>
</div>
</li>
<li id="comment-74650" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b396ad0823bf6f19707a27012b865a81?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b396ad0823bf6f19707a27012b865a81?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Onne</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-07T13:32:01+00:00">March 7, 2013 at 1:32 pm</time></a> </div>
<div class="comment-content">
<p>@Daniel</p>
<p>Going back to my first statement. Notice how there are no inconsistencies if you don&rsquo;t use negations (not or unequal). If need be use &ldquo;select inverse&rdquo;.</p>
<p>So how do you deal with this as a programmer? Just don&rsquo;t use negations unless you think about how you want to deal with null. Basically you need to deal with the fact that the sql engine does not know that the domain of cities is finite and void of quantum values.</p>
<p>And surely not having null is much more of a burden&#8230; it is like saying because division by zero is such a problem that we don&rsquo;t want zero in math.</p>
</div>
</li>
<li id="comment-74615" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-07T09:23:24+00:00">March 7, 2013 at 9:23 am</time></a> </div>
<div class="comment-content">
<p>@Onne</p>
<p>Yes, it is mathematically inconsistent. There is no way around it. I&rsquo;ll update my blog post right away with a more elaborate discussion. Your interpretation falls apart too as you&rsquo;ll see.</p>
</div>
</li>
<li id="comment-74631" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anonymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-07T11:45:22+00:00">March 7, 2013 at 11:45 am</time></a> </div>
<div class="comment-content">
<p>@Daniel</p>
<p>I see what you mean, but your reasoning is incorrect, see NULL might mean is nowhere, or everywhere, or only paris or only london. Or it might even be a quantum value that is london if you compare it to paris, and paris when you compare it to london. (This is easier to see if you stop using singular values and use sets of cities instead, now what does the NULL set mean, or a set containing Paris and NULL mean?)</p>
<p>The only sensible answer to a comparison with null is to return null again. The inconsistency is the pragmatic choice to let null be a falsy value when it comes to actually doing work (selecting records).</p>
<p>The sound thing to do in sql is not to return a list of some records when encountering null, instead to collapse the whole result into null itself. As in, I don&rsquo;t know the answer to your question. But that is not very pragmatic &#8230;</p>
</div>
</li>
<li id="comment-74642" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-07T12:43:24+00:00">March 7, 2013 at 12:43 pm</time></a> </div>
<div class="comment-content">
<p>@Anonymous</p>
<p><em>The sound thing to do in sql is not to return a list of some records when encountering null, instead to collapse the whole result into null itself. As in, I don&rsquo;t know the answer to your question.</em></p>
<p>But that is not what SQL does. It does return an answer even when nulls are involved. SQL itself does not offer any consistent view.</p>
<p>Of course, the programmer can check (painfully) to see if any nulls are involved. Or he can forbid nulls. Or he can use other, more complicated schemas, or special values&#8230; Anyhow, the burden is on the programmer to do the right thing with nulls&#8230; SQL will not help you. Arguably, it makes it hard for you to do the right thing.</p>
</div>
</li>
<li id="comment-74651" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-07T13:50:25+00:00">March 7, 2013 at 1:50 pm</time></a> </div>
<div class="comment-content">
<p>@Onne</p>
<p>Just so we are clear: I am not arguing against NULLs.</p>
</div>
</li>
</ol>
