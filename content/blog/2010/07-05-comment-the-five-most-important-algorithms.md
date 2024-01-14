---
date: "2010-07-05 12:00:00"
title: "The five most important algorithms?"
index: false
---

[21 thoughts on &ldquo;The five most important algorithms?&rdquo;](/lemire/blog/2010/07-05-the-five-most-important-algorithms)

<ol class="comment-list">
<li id="comment-53685" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Peter Turney</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-07-05T21:57:13+00:00">July 5, 2010 at 9:57 pm</time></a> </div>
<div class="comment-content">
<p>My favourites in the original list and in your subset are hashing and SVD. But both of these are perhaps better described as data structures or representations, rather than algorithms. Linked lists (for sparse matrices, trees, graphs, etc.) are another very useful invention of this type. This is a rather subjective question, but perhaps data structures (representations) are more important (interesting, fundamental) than algorithms? Of course, a data structure isn&rsquo;t much use without an algorithm, and vice versa.</p>
</div>
</li>
<li id="comment-53686" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Peter Turney</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-07-05T22:09:41+00:00">July 5, 2010 at 10:09 pm</time></a> </div>
<div class="comment-content">
<p>Another example: floating point numbers. We take them for granted, but there is a lot of engineering behind IEEE 754.</p>
</div>
</li>
<li id="comment-53688" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a7f4f9dcbbf1d46d660b0a6c98435751?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a7f4f9dcbbf1d46d660b0a6c98435751?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.johndcook.com/blog/" class="url" rel="ugc external nofollow">John</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-07-05T22:16:12+00:00">July 5, 2010 at 10:16 pm</time></a> </div>
<div class="comment-content">
<p>Some of his algorithms are not specific algorithms but classes, sometimes enormous classes, of algorithms. For example, methods for solving linear systems of equations.</p>
<p>The simplex method is important historically, but I assume it is on the list as a placeholder for the set of convex optimization methods that have replaced it in practice. </p>
<p>I&rsquo;d definitely put methods for solving linear systems in the top five. These algorithms are important in their own right, but they&rsquo;re also part of other algorithms, such as convex optimization.</p>
</div>
</li>
<li id="comment-53689" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2d512677f7d4b4f03dc7f5b28ee48cd6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2d512677f7d4b4f03dc7f5b28ee48cd6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.behind-the-enemy-lines.com/" class="url" rel="ugc external nofollow">Panos Ipeirotis</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-07-05T22:35:00+00:00">July 5, 2010 at 10:35 pm</time></a> </div>
<div class="comment-content">
<p>Would you consider the Expectation Maximization and Metropolis-Hasting to be algorithms? (Even though not invented within computer science?)</p>
</div>
</li>
<li id="comment-53690" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5dd2c5b46b528a1db0482f280670a84b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5dd2c5b46b528a1db0482f280670a84b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Philippe Beaudoin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-07-05T22:38:42+00:00">July 5, 2010 at 10:38 pm</time></a> </div>
<div class="comment-content">
<p>I agree with your list. Although I want to point out my most recent &ldquo;ahah!&rdquo; moment: the Wheeler-Burrows transform. <a href="https://en.wikipedia.org/wiki/Burrows%E2%80%93Wheeler_transform" rel="nofollow ugc">http://en.wikipedia.org/wiki/Burrows%E2%80%93Wheeler_transform</a></p>
<p>Like you, I didn&rsquo;t learn SVD until grad school. The best source I found for learning it on one&rsquo;s own is: <a href="http://www.uwlax.edu/faculty/will/svd/index.html" rel="nofollow ugc">http://www.uwlax.edu/faculty/will/svd/index.html</a></p>
<p>As far as such good learn-it-by-yourself-doc goes, thumbs up also to Jonathan Richard Shewchuk for his introduction to the conjugate gradient method:<br/>
<a href="http://www.cs.cmu.edu/~quake-papers/painless-conjugate-gradient.pdf" rel="nofollow ugc">http://www.cs.cmu.edu/~quake-papers/painless-conjugate-gradient.pdf</a></p>
</div>
</li>
<li id="comment-53683" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e49dee4f75542039bef9bdc8eeb09e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e49dee4f75542039bef9bdc8eeb09e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.ragibhasan.com" class="url" rel="ugc external nofollow">Ragib Hasan</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-07-05T21:56:07+00:00">July 5, 2010 at 9:56 pm</time></a> </div>
<div class="comment-content">
<p>My choices are:</p>
<p>1. Quicksort (though I find it ugly and difficult to explain to someone 🙁 )</p>
<p>2. Dijkstra&rsquo;s algorithm (Shortest path)</p>
<p>3. Euclidean algorithm for GCD</p>
<p>4. Strassen&rsquo;s algorithm for Matrix multiplication</p>
</div>
</li>
<li id="comment-53687" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2a23df58e755792e61c34a3aa762ef0b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2a23df58e755792e61c34a3aa762ef0b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://richworks.in" class="url" rel="ugc external nofollow">Richie</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-07-05T22:15:51+00:00">July 5, 2010 at 10:15 pm</time></a> </div>
<div class="comment-content">
<p>Good list but I think the RSA Encryption Algo and the Diffie Hellman Key exchange do need a mention 🙂</p>
<p>I would add two more to my list, the data compression and the viterbi algo 🙂</p>
</div>
</li>
<li id="comment-53691" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/23239de73df714a09dd05fe8ee69380d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/23239de73df714a09dd05fe8ee69380d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Guru Kini</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-07-06T00:47:03+00:00">July 6, 2010 at 12:47 am</time></a> </div>
<div class="comment-content">
<p>Great list.<br/>
I would add Quicksort, Public-Key Cryptography and LZ Compression algorithms to the list.</p>
</div>
</li>
<li id="comment-53695" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fb536e0c7ff2fcd44d314044cdb23831?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fb536e0c7ff2fcd44d314044cdb23831?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nicholas</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-07-06T05:52:56+00:00">July 6, 2010 at 5:52 am</time></a> </div>
<div class="comment-content">
<p>Simple gradient descent manybe? After all it is the basis of many first and second order optimization methods</p>
</div>
</li>
<li id="comment-53692" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4ed1d412d3d5b6a045fba095b900bf6f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4ed1d412d3d5b6a045fba095b900bf6f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">ponyo2</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-07-06T01:11:41+00:00">July 6, 2010 at 1:11 am</time></a> </div>
<div class="comment-content">
<p>I would rate the following algorithm families as more important than all of the algorithms on Koutschan&rsquo;s list:</p>
<p>&#8211; linear search: I think this is the single most *important* algorithm </p>
<p>&#8211; numerical addition, subtraction, multiplication, division</p>
<p>&#8211; random number generating algorithms</p>
<p>&#8211; stack-based algorithms, such as the use of a call-stack in (almost every) modern programming language</p>
<p>One other note: I&rsquo;ve always been struck by the paucity of real uses of binary search, especially as compared to things like linear search, stacks, or hashing. The fact that it only works on perfectly sorted data makes it nearly useless in practice &#8212; too beautiful for this ugly world, as the poet might say. It&rsquo;s mainly a nice introduction to the idea of divide-and-conquer.</p>
</div>
</li>
<li id="comment-53693" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7f42ed8d314f93a77988b0a7c1b8e1fc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7f42ed8d314f93a77988b0a7c1b8e1fc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://fph.altervista.org" class="url" rel="ugc external nofollow">Federico Poloni</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-07-06T02:47:30+00:00">July 6, 2010 at 2:47 am</time></a> </div>
<div class="comment-content">
<p>A couple of quick remarks&#8230;<br/>
1) the simplex algorithm is still widely used. Despite the better worst-case error bound, interior point methods perform better only on some classes of problems. AFAIK it is still an open issue to find a heuristic saying when it is better to use one rather than the other.<br/>
2) On the contrary, Strassen&rsquo;s algorithm is of theoretical interest, but AFAIK mostly unused in practice due to its numerical instability.</p>
<p>Oh, and another interesting view on the subject: here <a href="http://view.eecs.berkeley.edu/wiki/Dwarfs" rel="nofollow ugc">http://view.eecs.berkeley.edu/wiki/Dwarfs</a> is a list of 13 computational kernels that are believed to be the &ldquo;most important algorithms&rdquo; to implement efficiently on the computers of tomorrow.</p>
</div>
</li>
<li id="comment-53696" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5dd2c5b46b528a1db0482f280670a84b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5dd2c5b46b528a1db0482f280670a84b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Philippe Beaudoin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-07-06T12:25:00+00:00">July 6, 2010 at 12:25 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve extended Koutschan&rsquo;s original question to Stack Overflow, go vote for it before it&rsquo;s driven to the ground. 😉</p>
</div>
</li>
<li id="comment-53697" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5dd2c5b46b528a1db0482f280670a84b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5dd2c5b46b528a1db0482f280670a84b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Philippe Beaudoin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-07-06T12:25:24+00:00">July 6, 2010 at 12:25 pm</time></a> </div>
<div class="comment-content">
<p>Forgot the link:<br/>
<a href="http://stackoverflow.com/questions/3188614/what-are-the-most-important-algorithms" rel="nofollow ugc">http://stackoverflow.com/questions/3188614/what-are-the-most-important-algorithms</a></p>
</div>
</li>
<li id="comment-53698" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5dd2c5b46b528a1db0482f280670a84b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5dd2c5b46b528a1db0482f280670a84b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Philippe Beaudoin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-07-06T12:47:20+00:00">July 6, 2010 at 12:47 pm</time></a> </div>
<div class="comment-content">
<p>Closed already&#8230; I guess Stack Overflow wasn&rsquo;t the right forum for that. Unfortunate, though, as they have an excellent voting system. (Feel free to delete that comment and the 2 preceding.)</p>
</div>
</li>
<li id="comment-53699" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-07-06T12:50:28+00:00">July 6, 2010 at 12:50 pm</time></a> </div>
<div class="comment-content">
<p>@Beaudoin It looks like they closed your question on the following grounds:</p>
<p><em> questions of this type (&#8230;) usually lead to confrontation and argument.</em></p>
<p>I think that <strong>confrontation</strong> is a bit harsh.</p>
</div>
</li>
<li id="comment-53700" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5c167dcd3a1040ee7dde3705a884870a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5c167dcd3a1040ee7dde3705a884870a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Leon Palafox</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-07-07T04:18:14+00:00">July 7, 2010 at 4:18 am</time></a> </div>
<div class="comment-content">
<p>I would say that deppending on people is the algorithms they would deem most important. </p>
<p>And I agree, some of them are not even an algorithm: Solving a system of linear equations, is by no means an algorithm.</p>
<p>It is a cool problem.</p>
</div>
</li>
<li id="comment-53701" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/17765472a2569d99e7949b04fdb7b647?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/17765472a2569d99e7949b04fdb7b647?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Felix Gremmer</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-07-08T09:26:08+00:00">July 8, 2010 at 9:26 am</time></a> </div>
<div class="comment-content">
<p>1. Matrix Decompostion Algo e.g. LU-Decomposition<br/>
2. Krylov subspace iteration methods.<br/>
3. Monte Carlo method.<br/>
4. Fast Multipole Methods<br/>
5. Quicksort</p>
<p>I have picked out of this list:<br/>
<a href="http://amath.colorado.edu/resources/archive/topten.pdf" rel="nofollow ugc">http://amath.colorado.edu/resources/archive/topten.pdf</a></p>
<p>Everything on the list is an algo. when you try to use it&#8230;</p>
</div>
</li>
<li id="comment-53711" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f679cab1930c454ad3b33467aa0d8fcb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f679cab1930c454ad3b33467aa0d8fcb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Gasp</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-07-14T06:55:06+00:00">July 14, 2010 at 6:55 am</time></a> </div>
<div class="comment-content">
<p>Hi, nice article.<br/>
Do you have some nice, really understandable article about FFT (Fourier)?</p>
</div>
</li>
<li id="comment-54355" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f9612f7daf6a45f3e96114fbdbfc9950?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f9612f7daf6a45f3e96114fbdbfc9950?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Craig</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-04-23T23:37:00+00:00">April 23, 2011 at 11:37 pm</time></a> </div>
<div class="comment-content">
<p>Edmonds matching algorithm</p>
</div>
</li>
<li id="comment-54358" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/08246082c92c89bb256bf463b32bdc92?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/08246082c92c89bb256bf463b32bdc92?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">peter</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-04-27T11:31:26+00:00">April 27, 2011 at 11:31 am</time></a> </div>
<div class="comment-content">
<p>I think the question needs to be qualified a bit. Important is a vague word. Important to whom, and in what context? If I am stranded on a deserted island somewhere, an algorithm for making fire is more important than binary search. However, if have only 60 seconds to find a name in a giant phone book, in order to prevent a bomb from going off, then binary search is obviously key.</p>
</div>
</li>
<li id="comment-54684" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bec7b71cb7706847b69a50e22b2349bf?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bec7b71cb7706847b69a50e22b2349bf?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">John Rawlins</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-08-29T22:16:44+00:00">August 29, 2011 at 10:16 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;BEYOND SVD&rdquo;</p>
<p>&ldquo;Advanced Eigenvalue Vector Decomposition&rdquo;</p>
<p>We have made a significant improvement to the Singular Value<br/>
Decomposition methodology, This is actually an understatement.</p>
<p>We have discovered that the current Singular Value Decomposition mathematical techniques and resulting FORTRAN and C code is quite slow and inaccurate and what we have accomplished is to speed up computer execution by more than a factor of 1000 and to improve numerical accuracy by about 12 bits out of 48 bits for the standard double mantissa That is to say that there is no more than 1 bit different between the exact answer and my new solution method .Previous or current methods can barely achieve 24 bit accuracy (out of48).This improvement will make it possible to recognize red, green , blue, black, grey and white infrared images in real time as the first application .</p>
<p>The range of applications for this new technology can go well<br/>
beyond this.</p>
<p>Of course, we expect skeptics about these claims, but we have demo<br/>
programs that will read your data and produce results that they can compare and we can even executed this new code on their computers if they desire.</p>
<p>How AEVD Improves SVD Performance</p>
<p> AEVD Technology, LLC offers a fully developed, advanced form of the Singular Value Decomposition (SVD) algorithm, which offers a generational advance in speed and accuracy. Our Advanced Eigenvalue Vector Decomposition (or AEVD) was built upon a recognition of the shortcomings in how computers manipulate numbers, data and calculations, and reflects a painstaking analysis of the incremental steps in SVD processing to provide a faster process with fewer steps and improved inaccuracy. </p>
<p> The SVD mathematical proposition is linearly independent, in an algebraic sense, of the similarity theorem and as such provides a variety of available solution paths. One such path is to first reduce the input array to a real bidiagonal matrix with a sequence of intermediate left and right unitary transformations. This reduction to a real bidiagonal matrix is usually chosen to be a real diagonal and having one real super diagonal. All of the remaining matrix elements are numerically considered as zero. It is possible to choose other reduced forms of the input matrix, but the use of a real bidiagonal array provides for the most numerically accurate and computationally rapid solution. Additional numerical stability and computer accuracy is obtained by AEVD by choosing unitary transformations that place the larger bidiagonal elements in the upper left and the smaller elements in the lower right positions. This is true since the final determination of the left and right transformations and the SVD weights are always an iterative process for matrix sizes greater than four. Even for matrix sizes of four and less iterative methods are usually simpler and require computational steps comparable to closed form algebraic solutions. Also, when a real bidiagonal array format is chosen as the final iterate, the left and right transformations employed during iteration are orthogonal matrices. Other SVD iterative solution methods available employ orthogonal variations such as Jacobi rotation, Givens, and Householder reduction algorithms. Consistent among the more efficient and accurate SVD algorithms is the choice of the real</p>
<p>Regards,<br/>
John Rawlins</p>
<p>678-776-1343</p>
</div>
</li>
</ol>
