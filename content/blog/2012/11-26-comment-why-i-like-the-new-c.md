---
date: "2012-11-26 12:00:00"
title: "Why I like the new C++"
index: false
---

[19 thoughts on &ldquo;Why I like the new C++&rdquo;](/lemire/blog/2012/11-26-why-i-like-the-new-c)

<ol class="comment-list">
<li id="comment-60299" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f668a451ba8852b7abd58a36eacce6a6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f668a451ba8852b7abd58a36eacce6a6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://mobile.twitter.com/amy8492" class="url" rel="ugc external nofollow">Amy</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-11-26T16:44:17+00:00">November 26, 2012 at 4:44 pm</time></a> </div>
<div class="comment-content">
<p>This is quite straightforward. Any C++ user can see the benefits immediately. Thanks for sharing.</p>
</div>
</li>
<li id="comment-60291" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6185a1e00a03c167e59258174d7b08f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6185a1e00a03c167e59258174d7b08f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://techniko.blogspot.com" class="url" rel="ugc external nofollow">Viru (@virup)</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-11-26T15:31:21+00:00">November 26, 2012 at 3:31 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for the information. How can I determine whether my compiler supports C++11?</p>
</div>
</li>
<li id="comment-60296" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-11-26T16:17:59+00:00">November 26, 2012 at 4:17 pm</time></a> </div>
<div class="comment-content">
<p>@Viru </p>
<p>Right now GCC 4.7 and better as well as LLVM (clang) 3.2 have good support for C++11.</p>
<p>Check the documentation of whatever compiler you are using but, obviously, you cannot expect good support for compilers released before 2012.</p>
</div>
</li>
<li id="comment-60337" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/be2cce3ca9c68d751a1c1decd389dd80?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/be2cce3ca9c68d751a1c1decd389dd80?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://natekohl.net" class="url" rel="ugc external nofollow">Nate</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-11-27T09:30:36+00:00">November 27, 2012 at 9:30 am</time></a> </div>
<div class="comment-content">
<p>If you don&rsquo;t mind changing one line of code, you might be able to get even more speed by using V.push_back(std::move(x)). </p>
<p>This speedup would be in addition to the gains that you&rsquo;d expect to get just by using a move-enabled std::vector, which allows the vector to avoid internal copies as it grows.</p>
</div>
</li>
<li id="comment-60766" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/44480ae60bb8231a1e95497a562aa0b7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/44480ae60bb8231a1e95497a562aa0b7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Will</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-12-03T22:18:25+00:00">December 3, 2012 at 10:18 pm</time></a> </div>
<div class="comment-content">
<p>Thank you for your clear write-up of the benefits of C++11. I haven&rsquo;t used C++ for a few years, but I remember spending tons of time typing in boilerplate container initialization code. The new syntax looks much clearer.</p>
<p>I&rsquo;m wondering if you ran into any pitfalls when using the new standard? Or did everything work about as you expected?</p>
</div>
</li>
<li id="comment-60768" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-12-03T22:31:24+00:00">December 3, 2012 at 10:31 pm</time></a> </div>
<div class="comment-content">
<p>@Will</p>
<p>An obvious (!!!) drawback of C++11 is that support is still incomplete in most compilers. This makes portability a major concern for the time being. However, I am confident that important compilers will catch with most of C++11. Developers will expect it.</p>
<p>One problem that I have touched upon is the initialization of data structures within the class declaration. I am not sure whether it is supposed to work within C++11, or not&#8230; but it did not work for me with GCC 4.7.</p>
<p>Also, the constexpr requirements are very strict. In theory, you&rsquo;d want all math. functions to be constexpr but in practice, I don&rsquo;t think it will get as much use as it should. It is a shame since it ought to help compilers with optimization&#8230; </p>
<p>There are more nice things that I have left out too&#8230;</p>
</div>
</li>
<li id="comment-62077" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8c730a9b121181e2fc48d6ee8c62cc70?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8c730a9b121181e2fc48d6ee8c62cc70?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">grep</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-12-14T18:38:19+00:00">December 14, 2012 at 6:38 pm</time></a> </div>
<div class="comment-content">
<p>isn&rsquo;t constexpr just equivalent of a macro definition then ? I do appreciate the typesafety provided by the compiler in the constexpr case but it doesn&rsquo;t seem to be all that revolutionary a change.</p>
</div>
</li>
<li id="comment-62079" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-12-14T18:54:42+00:00">December 14, 2012 at 6:54 pm</time></a> </div>
<div class="comment-content">
<p>@grep </p>
<p><em>isn&rsquo;t constexpr just equivalent of a macro definition then ? </em></p>
<p>No, it is not. </p>
<p>Functions from cmath such as acosh are constexpr so that acosh(2) is a compiler-time constant.</p>
<p>I guess you could find a way to write acosh using a macro, but are you going to rewrite all the math. functions as macros? Seems crazy.</p>
</div>
</li>
<li id="comment-62635" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/45d4a7ba0fb8e789356f5da87536444d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/45d4a7ba0fb8e789356f5da87536444d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://zverovich.net" class="url" rel="ugc external nofollow">Victor</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-12-21T00:08:52+00:00">December 21, 2012 at 12:08 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;d love to start using C++11, but compatibility with legacy compilers is rather important to the projects I&rsquo;m working on. One thing is to upgrade the compiler yourself which is simple and another is to make all the users to upgrade. Don&rsquo;t you have the same problem?</p>
</div>
</li>
<li id="comment-62645" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-12-21T07:55:30+00:00">December 21, 2012 at 7:55 am</time></a> </div>
<div class="comment-content">
<p>@Victor</p>
<p>That&rsquo;s a general remark that is true for all new programming language versions. Sometimes it pays to switch to the latest version early, sometimes it is best to best as late as possible. My own opinion is that C++11 is something you want to adopt earlier rather than later.</p>
<p>Vivek is at Google, this gives you are clue that Google is likely adopting C++11. Moreover, we have clues that Facebook is adopting C++11 as well.</p>
</div>
</li>
<li id="comment-62661" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dd3e6e03af80ebb65d7ab617646ab842?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dd3e6e03af80ebb65d7ab617646ab842?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://lwsffhs.wordpress.com" class="url" rel="ugc external nofollow">Marcel</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-12-21T09:45:56+00:00">December 21, 2012 at 9:45 am</time></a> </div>
<div class="comment-content">
<p>Thanks Daniel. Gives me a reason to go back to c++.<br/>
Marcel</p>
</div>
</li>
<li id="comment-74629" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a033c4463f0d197e0f94e5e9f83c100c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a033c4463f0d197e0f94e5e9f83c100c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.csl.cornell.edu/~skand" class="url" rel="ugc external nofollow">Skand</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-07T11:28:44+00:00">March 7, 2013 at 11:28 am</time></a> </div>
<div class="comment-content">
<p>There&rsquo;s always the question of C vs C++. I like C++, and love C++11, but when it comes to efficiency, nothing beats good ol&rsquo; C. By this, I don&rsquo;t mean that C++ must be thrown away, but that efficient data structures can be written only in a C-like fashion. The STL just doesn&rsquo;t come close.</p>
<p>As an example, check out the test code I wrote <a href="https://github.com/skandhurkat/CXX11-STL-Tests/blob/master/vector-vs-array.cpp" rel="nofollow">here</a>. The results are surprising, to say the least. The C implementation takes around 0.0025 (wall clock time) seconds on average, while the C++ implementation takes 0.019 seconds (wall clock) on an average (default optimisations).</p>
<p>So, while C++11 has a good STL support, it does not even come close to what custom data structures can do. Further, custom data structures can be adapted to the problem at hand, and optimised even further.<br/>
However, my test example is relatively simple, and hardly relies on any optimisations at C level. Yet, the STL version is almost 8x slower.</p>
</div>
</li>
<li id="comment-74640" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-07T12:35:54+00:00">March 7, 2013 at 12:35 pm</time></a> </div>
<div class="comment-content">
<p>@Skand</p>
<p>Is your comparison fair?</p>
</div>
</li>
<li id="comment-74645" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/45d4a7ba0fb8e789356f5da87536444d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/45d4a7ba0fb8e789356f5da87536444d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://zverovich.net" class="url" rel="ugc external nofollow">Victor</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-07T13:05:09+00:00">March 7, 2013 at 1:05 pm</time></a> </div>
<div class="comment-content">
<p>@Skand</p>
<p>As Daniel correctly pointed out, your comparison is not fair. Even Daniel&rsquo;s version does unnecessary initialization of the vector which can be easily avoided, e.g. using boost::counting_iterator . See <a href="https://github.com/vitaut/CXX11-STL-Tests/blob/master/vector-vs-array.cpp" rel="nofollow ugc">https://github.com/vitaut/CXX11-STL-Tests/blob/master/vector-vs-array.cpp</a> for example. In this case C++ version is marginally faster.</p>
<p>So STL is not slower, you just need to learn how to use it efficiently, but this is true for any library.</p>
</div>
</li>
<li id="comment-74674" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a033c4463f0d197e0f94e5e9f83c100c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a033c4463f0d197e0f94e5e9f83c100c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.csl.cornell.edu/~skand" class="url" rel="ugc external nofollow">Skand</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-07T18:19:44+00:00">March 7, 2013 at 6:19 pm</time></a> </div>
<div class="comment-content">
<p>@Daniel:<br/>
Your version gives the following output:<br/>
The C like implementation took 0.000224585 seconds<br/>
The C++ implementation took 0.00241526 seconds<br/>
The fair C++ implementation took 0.00284987 seconds</p>
<p>So, resize is actually slower than reserve (at least on my computer). This I&rsquo;d attribute to the fact that resize calls the constructor for the underlying element type, whereas reserve does not do so.<br/>
I&rsquo;m curious to your opinion on why vector::reserve may not be a fair comparison.</p>
<p>@Victor:<br/>
I&rsquo;m not sure what you mean by &ldquo;unnecessary initialisation&rdquo;. If you refer to the fact that a new vector is initialised in every iteration of the outer loop, it&rsquo;s because I wish to measure time taken to initialise a vector, and insert a bunch of elements in it.<br/>
Your code seems to rely on the fact that vector[i] = i. I just used this assignment for lack of a better option; using the counting_iterator approach will not work for vectors that store some useful data.<br/>
Or maybe I&rsquo;ve completely missed your point.</p>
</div>
</li>
<li id="comment-74678" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-07T18:53:16+00:00">March 7, 2013 at 6:53 pm</time></a> </div>
<div class="comment-content">
<p>@Skand</p>
<p>But my concern is that you are comparing a static array with a dynamic one. Is that fair?</p>
<p>I also object that you don&rsquo;t really compare C with C++. Both solutions are C++. No?</p>
</div>
</li>
<li id="comment-74685" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/45d4a7ba0fb8e789356f5da87536444d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/45d4a7ba0fb8e789356f5da87536444d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://zverovich.net" class="url" rel="ugc external nofollow">Victor</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-07T19:07:21+00:00">March 7, 2013 at 7:07 pm</time></a> </div>
<div class="comment-content">
<p>@Skand:</p>
<p>By unnecessary initialization I meant that v.resize(1000000) in Daniel&rsquo;s version did extra zero initialization. I just demonstrated that it is possible to achieve the same performance as your &ldquo;C&rdquo; version by initializing the vector in place and it is not limited to the case vector[i] = i, you can write arbitrarily complex initializers in a similar fashion.</p>
<p>However, if you have more complex initialization, bypassing zero initialization will likely to become unnecessary because it will only amount to a small fraction of the total computation time.</p>
</div>
</li>
<li id="comment-74687" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a033c4463f0d197e0f94e5e9f83c100c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a033c4463f0d197e0f94e5e9f83c100c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.csl.cornell.edu/~skand" class="url" rel="ugc external nofollow">Skand</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-07T19:24:57+00:00">March 7, 2013 at 7:24 pm</time></a> </div>
<div class="comment-content">
<p>@Daniel, I won&rsquo;t say that I&rsquo;m comparing a static array with a dynamic one. The reserve command essentially reserves the size of the container to contain as many elements, so I don&rsquo;t think that memory copies happen at any time. And I said &ldquo;C like data structures&rdquo; not C [:)]. I don&rsquo;t like C. I&rsquo;m a C++ guy.</p>
<p>My comparison was directed mainly towards a code that I&rsquo;m writing ATM. I wrote the code very quickly in C++11 using STL. The comparison of C like data structures (which, for me include raw pointers, memory management, etc.) with the STL was mainly to convince myself that a performance improvement could be obtained by using C like data structures. Initially, I was sceptical; now I think that C like data management may be a faster (performance wise) way to go.</p>
<p>According to <a href="https://youtu.be/MShbP3OpASA?t=20m30s" rel="nofollow">Linus Torvalds in his Aalto talk</a>; he likes C because he can figure out exactly what the assembly will look like, something that&rsquo;s not possible with C++. He also mentioned optimising path name lookups to work in parallel, with no contention, and optimised down to where he would worry about single cache misses.<br/>
I&rsquo;d safely bet that STL (or any library for that matter) cannot give as much control. 🙂</p>
</div>
</li>
<li id="comment-74710" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-07T22:45:24+00:00">March 7, 2013 at 10:45 pm</time></a> </div>
<div class="comment-content">
<p>@Skand</p>
<p>Your example is unfair because you are using push_back. </p>
<p>Please see my post <a href="https://lemire.me/blog/archives/2012/06/20/do-not-waste-time-with-stl-vectors/" rel="nofollow">Do not waste time with STL vectors</a> where I explain that push_back can be expensive. </p>
<p>The only reason to use push_back is when you have a dynamic array.</p>
<p>In your case, there is no good reason to use a dynamic array approach, so you should not use push_back.</p>
<p>Now, if you implement it with brackets, you will see that the STL version is just 2x slower. This seems like a lot, but it can be entirely explained by the extra initialization that STL does.</p>
<p>This is somewhat unfortunate, but if you care about performance, you should probably avoid allocating and unallocated memory anyhow, right?</p>
<p>See my test here:</p>
<p><a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2012/11/26/vector-vs-array.cpp" rel="nofollow ugc">https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2012/11/26/vector-vs-array.cpp</a></p>
</div>
</li>
</ol>
