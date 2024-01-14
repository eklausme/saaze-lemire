---
date: "2016-10-10 12:00:00"
title: "A case study in the performance cost of abstraction (C++&#8217;s std::shuffle)"
index: false
---

[15 thoughts on &ldquo;A case study in the performance cost of abstraction (C++&#8217;s std::shuffle)&rdquo;](/lemire/blog/2016/10-10-a-case-study-in-the-performance-cost-of-abstraction-cs-stdshuffle)

<ol class="comment-list">
<li id="comment-255211" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fdd630f72eef3790bfb4ef38d08c7f85?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fdd630f72eef3790bfb4ef38d08c7f85?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://klmr.me" class="url" rel="ugc external nofollow">Konrad Rudolph</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-10T17:30:56+00:00">October 10, 2016 at 5:30 pm</time></a> </div>
<div class="comment-content">
<p>Oddly, the difference persists when using 64 integer types throughout, and when using a different (64 bit) random number generator. But only on clang/libc++. Using g++ 6.0 and libstdc++, the difference vanishes completely. </p>
<p>This suggests a rather serious bug in the libc++ implementation of std::shuffle: std::shuffle was specifically specified to allow implementations that do not cause runtime penalties due to abstraction, and in this function it replaces the now-deprecated std::random_shuffle, the interface of which required inefficient implementations.</p>
<p>For what&rsquo;s it worth, I don&rsquo;t think an implementation can actually do better than your â€œnaÃ¯veâ€ textbook implementation, and implementors should use it (libstdc++ does, libc++ doesn&rsquo;t).</p>
</div>
</li>
<li id="comment-255221" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7139aec6dc0f93b7c978dd91bd960783?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7139aec6dc0f93b7c978dd91bd960783?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">ahminus</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-10T19:24:09+00:00">October 10, 2016 at 7:24 pm</time></a> </div>
<div class="comment-content">
<p>And there&rsquo;s a reason he doesn&rsquo;t actually show input and produce a total running time output and instead cheats and just shows &ldquo;clock cycles per value&rdquo;. Because for any small shuffle, it makes no difference, and for any very large value, you need to consider whether you&rsquo;re shuffling billions of values.<br/>
Hence, std::shuffle.<br/>
Unless you&rsquo;re shuffling many collections constantly, this optimization isn&rsquo;t worthy of any note. BTW, just for edification, I wrote a shuffler that runs as a micro-service on the network. All it does is return a shuffled deck of cards for the next hand of poker for thousands and thousands of tables of poker running concurrently (for a real live poker app. that is in production). I would never have bothered with this &ldquo;optimization&rdquo;.<br/>
EDIT: If I&rsquo;m doing the math right (and I often don&rsquo;t), his example code runs in about 25ns using std::shuffle. And roughly half that using his &ldquo;textbook&rdquo; version. So, how many items do we need to be shuffling for any of this to make any real difference? Roughly billions (see above). Talk about useless/premature optimization.</p>
</div>
<ol class="children">
<li id="comment-255224" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-10T19:54:56+00:00">October 10, 2016 at 7:54 pm</time></a> </div>
<div class="comment-content">
<p><em>Unless you&rsquo;re shuffling many collections constantly, this optimization isn&rsquo;t worthy of any note.</em></p>
<p>It is not an optimization to write 3 lines of code straight out of a textbook.</p>
</div>
<ol class="children">
<li id="comment-255252" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f942f2c9b5afaee653896d64a5d1cdfe?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f942f2c9b5afaee653896d64a5d1cdfe?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bob.jones" class="url" rel="ugc external nofollow">Bob Jones</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-11T03:40:24+00:00">October 11, 2016 at 3:40 am</time></a> </div>
<div class="comment-content">
<p>clearly it is, since it improves the speed&#8230;</p>
</div>
<ol class="children">
<li id="comment-255286" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-11T13:34:49+00:00">October 11, 2016 at 1:34 pm</time></a> </div>
<div class="comment-content">
<p>I think that the term &ldquo;optimization&rdquo; refers to an intent. That is, you mean the code to be faster. Otherwise the term is meaningless.</p>
</div>
<ol class="children">
<li id="comment-255298" class="comment odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-11T16:05:05+00:00">October 11, 2016 at 4:05 pm</time></a> </div>
<div class="comment-content">
<p>I would call it a de-pessimization.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-255283" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d2859a9c8b49548871130fdb74eee4d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d2859a9c8b49548871130fdb74eee4d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Moschops</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-11T12:10:48+00:00">October 11, 2016 at 12:10 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;Talk about useless/premature optimization.&rdquo;</p>
<p>This is neither useless nor premature. I surmise you are from the school that misinterprets Hoare and Knuth, and uses it as an excuse to not bother thinking about what you&rsquo;re coding.</p>
</div>
</li>
</ol>
</li>
<li id="comment-255331" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e1305fee562b70958e65b557ce049e31?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e1305fee562b70958e65b557ce049e31?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nir Friedman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-11T21:36:21+00:00">October 11, 2016 at 9:36 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t think I can get on board with the conclusion/title.</p>
<p>First off, std::string vs const char * seems to me to be entirely orthogonal to the implementation of std::shuffle. shuffle will shuffle any iterable container, so you can have an array of string or an array of const char *. Maybe you are adding string vs const char * to the &ldquo;cost of abstraction&rdquo; argument (title makes it seems like it&rsquo;s only shuffe)? But in any case, string is not slower than const char * in this particular case because of abstraction. It&rsquo;s slower here because it has different performance characteristics (as part of a deliberate choice); knowing its own size, having extra space, and avoiding heap allocations in many cases, all allow it to be faster than const char * in many other cases, just not in this one.</p>
<p>Second, the thing that actually makes shuffle slow is not abstraction, it&rsquo;s an implementation detail, which is motivated by a need for correctness (arrays with at least 4 billion elements, which with const char * would only require 32 gigs of RAM, btw). The only abstraction in shuffle&rsquo;s interface is the use of iterators instead of raw pointers, but this hasn&rsquo;t been shown to have any cost.</p>
<p>Ironically, shuffle&rsquo;s implementation could be trivially altered to have optimal performance/correctness characteristics by adding more abstraction. Namely, you could add another template parameter controlling the integer type used. It would default to size_t for correctness, but users could switch it to whatever was fastest on their platform if they had foreknowledge of their array size.</p>
<p>Of course, this comes at a cost in interface complexity. Anyhow, interesting information, but I don&rsquo;t agree with the conclusions.</p>
</div>
<ol class="children">
<li id="comment-255429" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-12T13:33:10+00:00">October 12, 2016 at 1:33 pm</time></a> </div>
<div class="comment-content">
<p><em>Anyhow, interesting information, but I don&rsquo;t agree with the conclusions</em></p>
<p>That&rsquo;s fair. Note however that I always post my code and that my experimental results should be easily reproducible. So you can disagree with my interpretation, but, hopefully, you should not disagree with the experimental observations.</p>
<p><em> Maybe you are adding string vs const char * to the â€œcost of abstractionâ€ argument (title makes it seems like it&rsquo;s only shuffe)? But in any case, string is not slower than const char * in this particular case because of abstraction. It&rsquo;s slower here because it has different performance characteristics (as part of a deliberate choice); knowing its own size, having extra space, and avoiding heap allocations in many cases, all allow it to be faster than const char * in many other cases, just not in this one.</em></p>
<p><tt>std::string</tt> has a higher abstraction level than <tt>char *</tt>. For performance-sensitive code, I avoid <tt>std::string</tt>. For the type of work I do, it has historically always been slower than a C string. I hear that in C++11, some of the performance issues with <tt>std::string</tt> have been addressed, but prior to this, there is ample documentation on the problems caused by <tt>std::string</tt>. I should add that I am not a fan of the <tt>char *</tt> paradigm on the principle that it encourages branching&#8230; but experimental evidence shows that it is very good for performance in many applications.</p>
<p><em>Second, the thing that actually makes shuffle slow is not abstraction, it&rsquo;s an implementation detail, (&#8230;)</em></p>
<p>We are comparing calling a library that handles all the implementation details for us, with coding our own so that the implementation is transparent. The library call has a higher level of abstraction. A higher level of abstraction can be beneficial, and it can have a cost&#8230; usually, you have a bit of both&#8230; benefits and costs&#8230;</p>
<p><em>The only abstraction in shuffle&rsquo;s interface is the use of iterators instead of raw pointers, but this hasn&rsquo;t been shown to have any cost.</em></p>
<p>I haven&rsquo;t checked but I do not expect the iterators to be an issue as far as performance goes (based on past experience).</p>
<p>Iterators in C++ are great performance-wise. (In Java, they can be a problem.)</p>
<p><em>Ironically, shuffle&rsquo;s implementation could be trivially altered to have optimal performance/correctness characteristics by adding more abstraction. Namely, you could add another template parameter controlling the integer type used. It would default to size_t for correctness, but users could switch it to whatever was fastest on their platform if they had foreknowledge of their array size.</em></p>
<p>Or you could branch on the number of elements that there are in the container. I think that the library could be engineered so that the difference I indicate goes away.</p>
</div>
</li>
</ol>
</li>
<li id="comment-255440" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e221d9dbfef47421609b13e3f87afa9f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e221d9dbfef47421609b13e3f87afa9f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dag BrÃ¼ck</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-12T15:55:37+00:00">October 12, 2016 at 3:55 pm</time></a> </div>
<div class="comment-content">
<p>Unfortunately you do not conclusively answer the question &lsquo;why?&rsquo; Please investigate further what the reason is, for example by analyzing the generated code.</p>
</div>
<ol class="children">
<li id="comment-255447" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-12T16:34:46+00:00">October 12, 2016 at 4:34 pm</time></a> </div>
<div class="comment-content">
<p>Because I provide my full source code, you should feel free to proceed with any analysis you have in mind.</p>
</div>
<ol class="children">
<li id="comment-255448" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e221d9dbfef47421609b13e3f87afa9f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e221d9dbfef47421609b13e3f87afa9f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dag BrÃ¼ck</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-12T16:46:34+00:00">October 12, 2016 at 4:46 pm</time></a> </div>
<div class="comment-content">
<p>Why should I? It is your blog. Work out the details and you can make some interesting observations.</p>
</div>
<ol class="children">
<li id="comment-255458" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-12T17:54:17+00:00">October 12, 2016 at 5:54 pm</time></a> </div>
<div class="comment-content">
<p>I did work it out and it is explained in my blog post. Divisions are the bottleneck (I explain that by removing them I can multiply the speed by 10x). The standard library uses 64-bit arithmetic. (Hint: a 64-bit division is much slower than a 32-bit division&#8230;) So that is all in the blog post.</p>
<p>It is entirely reasonable to want a more thorough analysis, but I keep my blog posts short by design, preferring instead to refer the readers to the code and encouraging experiments.</p>
<p>In any case, whatever deep analysis I come up with can be reasonably questioned. Why did you use this compiler and not this other compiler? Why did you use this standard library? What about the processor, what happens if you try another&#8230; it is a rabbit hole&#8230; one has to define the scope somehow.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-255574" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c73607835b9f2b7799a0dbb271f500c5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c73607835b9f2b7799a0dbb271f500c5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Risto Lankinen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-13T10:57:39+00:00">October 13, 2016 at 10:57 am</time></a> </div>
<div class="comment-content">
<p>Here&rsquo;s one more argument supporting custom (as opposed to std::) shuffling algorithm:</p>
<p>How often is it that you need a whole array shuffled anyway? Most use cases for shuffling only require a handful of items (say, two hands of five cards from a deck of 52+2) where items are only required to be distinct from each other, and from other hands. Hence a more efficient algorithm would amortize the shuffling cost over each draw of a next item, in order to never need to shuffle the entire array.</p>
</div>
<ol class="children">
<li id="comment-257378" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/838bbde3bf9563256b3b0acda34dfa3e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/838bbde3bf9563256b3b0acda34dfa3e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">jrodman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-29T01:57:39+00:00">October 29, 2016 at 1:57 am</time></a> </div>
<div class="comment-content">
<p>There is some surprising unexpectedness in the behavior of many psuedo-random number generation situations, where random-pick does not contain enough variation to approximate real behavior of cards as compared to an actual shuffle.</p>
<p>There may scenarios where this possible weakness does not matter, but when modelling cards, an actual shuffle is typically a much closer modelling than a random-pick.</p>
</div>
</li>
</ol>
</li>
</ol>
