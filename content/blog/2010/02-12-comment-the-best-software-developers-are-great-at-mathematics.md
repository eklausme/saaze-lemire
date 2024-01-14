---
date: "2010-02-12 12:00:00"
title: "The best software developers are great at Mathematics?"
index: false
---

[13 thoughts on &ldquo;The best software developers are great at Mathematics?&rdquo;](/lemire/blog/2010/02-12-the-best-software-developers-are-great-at-mathematics)

<ol class="comment-list">
<li id="comment-52247" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6537c0a681d22d4a3f7bf4ce7d209a0f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6537c0a681d22d4a3f7bf4ce7d209a0f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://blog.geomblog.org/" class="url" rel="ugc external nofollow">Suresh</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-02-12T12:11:20+00:00">February 12, 2010 at 12:11 pm</time></a> </div>
<div class="comment-content">
<p>not sure I follow this example. Isn&rsquo;t the confusion stemming from the fact that you&rsquo;re treating $x as a set of objects rather than as a single object, and you&rsquo;re interpreting the operator &lsquo;=&rsquo; really as &lsquo;contains&rsquo;, and the operator != as something different from &ldquo;not contains&rdquo; ?</p>
</div>
</li>
<li id="comment-52249" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-02-12T12:36:58+00:00">February 12, 2010 at 12:36 pm</time></a> </div>
<div class="comment-content">
<p>@Suresh </p>
<p>Expressions in XPath return sequences of values. </p>
<p>In XPath, two sequences are &ldquo;equal&rdquo; if you can find one element from the first sequence which is &ldquo;equal&rdquo; to one element of the other sequence. </p>
<p>My claim is that thinking through this sort of definition is what good XML developers need to do routinely.</p>
<p>And equality between two objects does not imply that they are the &ldquo;same&rdquo; object, so we are not in set theory. For example, an attribute value containing the string &ldquo;Suresh&rdquo; and the string &ldquo;Suresh&rdquo; are &ldquo;equal&rdquo;.</p>
<p>And yes, of course, if $x is a sequence of one object, then $x=a and not($x!=a) are the same thing.</p>
<p>For extra points, is equality transitive in XPath? That is, if $a=$b and $b=$c, does $a=$c? Hint: this may help Itman&rsquo;s claim that XPath is a lame language.</p>
</div>
</li>
<li id="comment-52250" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6537c0a681d22d4a3f7bf4ce7d209a0f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6537c0a681d22d4a3f7bf4ce7d209a0f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://blog.geomblog.org/" class="url" rel="ugc external nofollow">Suresh</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-02-12T12:41:27+00:00">February 12, 2010 at 12:41 pm</time></a> </div>
<div class="comment-content">
<p>ok. I understand the semantics now. I guess what I don&rsquo;t understand is what this has to do with the understanding of mathematics, or whether students should be confused or not. My feeling is one should not use the term &ldquo;=&rdquo; to describe the relation you mention, because the relation is not an equivalence relation,(since transitivity is violated). This is confusing because &lsquo;=&rsquo; traditionally refers to some kind of equivalence relation. </p>
<p>In other words, it&rsquo;s actually the use of bad mathematical notation that&rsquo;s causing confusion here, imo.</p>
</div>
</li>
<li id="comment-52251" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-02-12T12:51:11+00:00">February 12, 2010 at 12:51 pm</time></a> </div>
<div class="comment-content">
<p>@Suresh Well. The notation is what confused you, but my students go through 135 hours of XML.</p>
</div>
</li>
<li id="comment-52253" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-02-12T13:29:15+00:00">February 12, 2010 at 1:29 pm</time></a> </div>
<div class="comment-content">
<p>@Carr I think we need to sell t-shirts with this joke on them. Perfect nerd humor.</p>
</div>
</li>
<li id="comment-52254" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d0408d7a07f6d5460814d9016aef947c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d0408d7a07f6d5460814d9016aef947c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://stoa.usp.br/portal/index.html" class="url" rel="ugc external nofollow">Ricardo Guiraldelli</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-02-12T14:36:19+00:00">February 12, 2010 at 2:36 pm</time></a> </div>
<div class="comment-content">
<p>Well, once great computer scientists like Adriaan Wijngaarden, Alan Turing, Andrey Kolmogorov, Donald Knuth, Edsger Dijkstra (although a theoretical physicist) and John von Neumann (among others) come from Mathematics (or have a mathematical background), my intuition guides me to believe that excellent programmers have some math skill above the average.<br/>
If we think that all computer science (CS) formalism is a kind of mathematical formalism &#8212; actually, CS is a subset of Math &#8212;, the answer to the title question is &ldquo;Yes!&rdquo;<br/>
And if you believe that outstanding software developers (that I &ldquo;translate&rdquo; as those that deliver codes with almost no error) have a kind of &ldquo;internal methods for software validation&rdquo; and relate it with Formal Methods (from Software Engineer), I think you are sure about the answer: &ldquo;yes&rdquo;!<br/>
Well, my two cents about the subject.</p>
</div>
</li>
<li id="comment-52248" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-02-12T12:21:27+00:00">February 12, 2010 at 12:21 pm</time></a> </div>
<div class="comment-content">
<p>@Suresh me neither. To me, this is yet another example why XSLT/XPATH is a lame language.</p>
</div>
</li>
<li id="comment-52252" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ab3095db4c3fe94d799aedd6155a5eff?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ab3095db4c3fe94d799aedd6155a5eff?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">F. Carr</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-02-12T13:18:06+00:00">February 12, 2010 at 1:18 pm</time></a> </div>
<div class="comment-content">
<p>The notation is confusing, yes.</p>
<p>Pointy-haired boss: &ldquo;Your salary equals $100K per year.&rdquo;<br/>
Recent hire: &ldquo;Then why is my monthly gross only $1000?&rdquo;<br/>
PHB: &ldquo;Because we hired you to work with XML, and in 135 years from now, you will be making $100K per year. This should all be obvious.&rdquo;</p>
</div>
</li>
<li id="comment-52257" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kevembuangga</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-02-13T00:32:13+00:00">February 13, 2010 at 12:32 am</time></a> </div>
<div class="comment-content">
<p>Is it not the other way around?<br/>
<i><a href="http://xona.com/quotes/programming.html" rel="nofollow">&ldquo;A logician trying to explain logic to a programmer is like a cat trying to explain to a fish what it&rsquo;s like to get wet.&rdquo;</a></i></p>
</div>
</li>
<li id="comment-52258" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/880cbab435f00197613c9cc2065b4f5a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/880cbab435f00197613c9cc2065b4f5a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Daniel Haran</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-02-13T12:59:03+00:00">February 13, 2010 at 12:59 pm</time></a> </div>
<div class="comment-content">
<p>Writing not($x!=&rdquo;some string&rdquo;) in real code is a fireable offence.</p>
<p>I&rsquo;d venture that great programmers today are likely to be great writers. Clarity is paramount. Avoiding double negatives isn&rsquo;t unlikely to make your code less difficult to read. See? That&rsquo;s shit.</p>
<p>Great mathematicians tend to value elegant proofs. Great software craftspeople value clear code. Math and writing are two disciplines that help; which is more important depends mostly on the problem domain you are facing.</p>
<p>I believe there are underlying qualities that can make people great at math, writing and software development. Being great in one domain implies you can do well in another.</p>
</div>
</li>
<li id="comment-52260" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">DL</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-02-14T02:12:50+00:00">February 14, 2010 at 2:12 am</time></a> </div>
<div class="comment-content">
<p>While I&rsquo;d have trouble vouching for mathematics&rsquo; utility when it comes to subtleties in syntactical parsing vis a vis xml transformations, one argument that seems stronger is RDBMSs as a whole, which are founded soundly on set theory. alternatives may have their place, but RDBMS&rsquo;s still rule the roost. bonus points would be that they are more relevant to the information systems&rsquo; question.</p>
</div>
</li>
<li id="comment-52265" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f4f5e0c1cbdb86c73b397de0bd03405d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f4f5e0c1cbdb86c73b397de0bd03405d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://petro.tanrei.ca" class="url" rel="ugc external nofollow">Petro</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-02-20T13:09:11+00:00">February 20, 2010 at 1:09 pm</time></a> </div>
<div class="comment-content">
<p>In general I agree with the point that this post is trying to make. However, the code example used is sub-par. As previously pointed out, it has little to do with mathematics and everything to do with XPath being a poor language.</p>
<p>I think a better example would be the Haskell programming language which has deep ties to math.</p>
</div>
</li>
<li id="comment-52267" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/45e36ecc4e05bce124f6347e12f4dc4e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/45e36ecc4e05bce124f6347e12f4dc4e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.shenzhenmarketing.com" class="url" rel="ugc external nofollow">Shenzhen Marketing</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-02-22T05:59:23+00:00">February 22, 2010 at 5:59 am</time></a> </div>
<div class="comment-content">
<p>I think so. Because a good developer need a good logistic brain. Mathematics can make your mind very clear on each logic step. So i think it&rsquo;s right.</p>
</div>
</li>
</ol>
