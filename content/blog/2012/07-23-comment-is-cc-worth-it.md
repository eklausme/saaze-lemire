---
date: "2012-07-23 12:00:00"
title: "Is C++ worth it?"
index: false
---

[106 thoughts on &ldquo;Is C++ worth it?&rdquo;](/lemire/blog/2012/07-23-is-cc-worth-it)

<ol class="comment-list">
<li id="comment-55452" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6bff78c6f2a5cc3c893bd8bb9adfdf59?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6bff78c6f2a5cc3c893bd8bb9adfdf59?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://mobile.twitter.com/siah" class="url" rel="ugc external nofollow">Siah (@siah)</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-23T14:28:35+00:00">July 23, 2012 at 2:28 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,</p>
<p>You start by highlighting the role of efficient languages in energy consumption of devices. So let me ask you this. Don&rsquo;t you think that languages like C++ can help in lowering the energy usage?</p>
</div>
</li>
<li id="comment-55451" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/571df3c3b8615b1cfc2e96171770ccc4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/571df3c3b8615b1cfc2e96171770ccc4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">mars</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-23T14:28:09+00:00">July 23, 2012 at 2:28 pm</time></a> </div>
<div class="comment-content">
<p>Wow it&rsquo;s surprising how fast Java is. Who would have guessed?!</p>
<p>If we are doing scientific computation, and sending off the code to clusters, would Java perform similarly good?</p>
</div>
</li>
<li id="comment-55453" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-23T14:38:52+00:00">July 23, 2012 at 2:38 pm</time></a> </div>
<div class="comment-content">
<p>@Siah</p>
<p><em>Don&rsquo;t you think that languages like C++ can help in lowering the energy usage?</em></p>
<p>Yes, I think so.</p>
</div>
</li>
<li id="comment-55454" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-23T14:40:34+00:00">July 23, 2012 at 2:40 pm</time></a> </div>
<div class="comment-content">
<p>@mars</p>
<p><em>If we are doing scientific computation, and sending off the code to clusters, would Java perform similarly good?</em></p>
<p>A lot of cluster computing is done in Java and it seems to work well.</p>
</div>
</li>
<li id="comment-55455" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b3eeb7653c4df9b0f1332b9b0ec201ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b3eeb7653c4df9b0f1332b9b0ec201ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Max Lybbert</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-23T14:58:40+00:00">July 23, 2012 at 2:58 pm</time></a> </div>
<div class="comment-content">
<p>Is there any reason std::partial_sum isn&rsquo;t in the test ( <a href="http://www.cplusplus.com/reference/std/numeric/partial_sum/" rel="nofollow ugc">http://www.cplusplus.com/reference/std/numeric/partial_sum/</a> )? Sure, most C++ programmers probably do write the loop out as shown, but personally, I reach for STL algorithms before I try optimizing by hand.</p>
</div>
</li>
<li id="comment-55456" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-23T15:18:50+00:00">July 23, 2012 at 3:18 pm</time></a> </div>
<div class="comment-content">
<p>@Max</p>
<p>Good point.</p>
<p>Is partial_sum fine for in place computations?</p>
</div>
</li>
<li id="comment-55457" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/34d1f4550593f8fe9aed0d1b2b395921?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/34d1f4550593f8fe9aed0d1b2b395921?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Donny</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-23T15:20:50+00:00">July 23, 2012 at 3:20 pm</time></a> </div>
<div class="comment-content">
<p>The amount of work gone into the JVM is amazing and the first time I saw the Computer Language Benchmarks site, I was shocked at the tiny marginal difference over C++ (the other surprise being Haskell!).</p>
<p>However, there&rsquo;s a warm-up/start-up cost to be paid and I wonder how much control you will get in cases where CPU cache issues affect your performance.</p>
</div>
</li>
<li id="comment-55458" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ben L. Titzer</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-23T15:27:43+00:00">July 23, 2012 at 3:27 pm</time></a> </div>
<div class="comment-content">
<p>Please stop posting misleading microbenchmarks like these. Your methodology is not rigid and your benchmark is 3 lines of code. The whole loop might be replaced with a nop if the array doesn&rsquo;t escape.</p>
</div>
</li>
<li id="comment-55459" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b3eeb7653c4df9b0f1332b9b0ec201ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b3eeb7653c4df9b0f1332b9b0ec201ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Max Lybbert</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-23T15:29:49+00:00">July 23, 2012 at 3:29 pm</time></a> </div>
<div class="comment-content">
<p>I believe partial_sum is OK for in place computation (SGI&rsquo;s version was: <a href="http://www.sgi.com/tech/stl/partial_sum.html" rel="nofollow ugc">http://www.sgi.com/tech/stl/partial_sum.html</a> , Note 1) and Microsoft&rsquo;s version is ( <a href="http://msdn.microsoft.com/en-us/library/et8wc8tt.aspx" rel="nofollow ugc">http://msdn.microsoft.com/en-us/library/et8wc8tt.aspx</a> , first sentence under &ldquo;Remarks&rdquo;).</p>
</div>
</li>
<li id="comment-55460" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b969cb7d681c2a7bd5cbb50a1bbc78b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b969cb7d681c2a7bd5cbb50a1bbc78b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Pierre Barbier de Reuille</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-23T15:32:47+00:00">July 23, 2012 at 3:32 pm</time></a> </div>
<div class="comment-content">
<p>Interestingly, here is what I get for the basic sum implementation:</p>
<p>Java: ~1470<br/>
gcc 4.7 with -O3: ~960<br/>
clang 3.1 with -O3: ~1350</p>
<p>optimized C++ version:<br/>
gcc 4.7: ~1350<br/>
clang: ~1470</p>
<p>Also, if you replace your use the std::partial_sum function, with gcc 4.7, you get ~1100, but it get slower with clang &#8230;</p>
</div>
</li>
<li id="comment-55461" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-23T15:46:18+00:00">July 23, 2012 at 3:46 pm</time></a> </div>
<div class="comment-content">
<p>@Ben</p>
<p><em>The whole loop might be replaced with a nop (&#8230;)</em></p>
<p>It could but it is not.</p>
<p><em>Your methodology is not rigid </em></p>
<p>Fair enough, but are you saying that my conclusions are wrong?</p>
<p><em> your benchmark is 3 lines of code. </em></p>
<p>These could be 3 very important lines of code in an application.</p>
</div>
</li>
<li id="comment-55462" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e9f6a1dac29d0ce33af7b0e416d52191?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e9f6a1dac29d0ce33af7b0e416d52191?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://peekaboo-vision.blogspot.com" class="url" rel="ugc external nofollow">And</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-23T16:07:29+00:00">July 23, 2012 at 4:07 pm</time></a> </div>
<div class="comment-content">
<p>Why do you think Java is a higher level language as C++? Higher because it has one abstraction level more?</p>
<p>I think that is not the usual definition.</p>
</div>
</li>
<li id="comment-55463" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-23T16:12:47+00:00">July 23, 2012 at 4:12 pm</time></a> </div>
<div class="comment-content">
<p>@And</p>
<p>I was going to add a disclaimer saying that some people would argue that Java is not a higher level language.</p>
<p>Just accept for the sake of this discussion that Java is a higher level language.</p>
</div>
</li>
<li id="comment-55464" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-23T16:14:23+00:00">July 23, 2012 at 4:14 pm</time></a> </div>
<div class="comment-content">
<p>Ben L. Titzer, </p>
<p>it is a well-known fact that higher-level languages can optimize the code better than C++. Given that Java is equipped with a just-in-time compiler/profiler, the results here are not surprising at all. </p>
<p>Next, there are scenarios when a garbage collector can be much faster than malloc (though, in general performance is comparable).</p>
<p>Last, but not least is that copy-on-read behavior favored in many (especially functional) languages can be beneficial in multi-threading applications. Few people know, but the current reference-based implementation of strings in GCC can kill your performance! I know examples, when using STL leads to a 2 fold increase in performance (for the application in general, not only for a small part).</p>
</div>
</li>
<li id="comment-55476" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d46affa26bb4e732f1b1b119cb817a11?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d46affa26bb4e732f1b1b119cb817a11?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://mobile.twitter.com/cegme" class="url" rel="ugc external nofollow">Christan</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-23T21:18:05+00:00">July 23, 2012 at 9:18 pm</time></a> </div>
<div class="comment-content">
<p>The STL is tough to optimize. The vanilla array structures beat fast sum std::vector about 1560 to 1390.</p>
<p> int data_array[50*1000*1000];<br/>
for (size_t i = 0; i != 50*1000*1000; ++i) {<br/>
data_array[i] = (i+i/3);<br/>
}</p>
<p> for (size_t i = 1; i != 50*1000*1000; ++i) {<br/>
data_array[i] += data_array[i &#8211; 1] ;<br/>
}</p>
<p>But your point is well taken.</p>
</div>
</li>
<li id="comment-55465" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e9f6a1dac29d0ce33af7b0e416d52191?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e9f6a1dac29d0ce33af7b0e416d52191?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://peekaboo-vision.blogspot.com" class="url" rel="ugc external nofollow">Andy</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-23T16:20:01+00:00">July 23, 2012 at 4:20 pm</time></a> </div>
<div class="comment-content">
<p>But if Java is is not a higher level language, then you make no point.<br/>
The numbers you provide are just wrt Java. looking at any script language in the benchmark game reveals big differences between C++ and Java and languages like Ruby, Python, Lua, Clojure,&#8230;</p>
<p>If you want to argue &ldquo;Java is sometimes as fast as C&rdquo;, ok. Ben gave some good arguments why this can be the case.</p>
<p>But this is not really connected to &ldquo;higher level&rdquo; imho.</p>
</div>
</li>
<li id="comment-55466" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/08273d5f7fe210be4bfcdd60b9b3fe09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/08273d5f7fe210be4bfcdd60b9b3fe09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">J. Andrew Rogers</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-23T16:28:34+00:00">July 23, 2012 at 4:28 pm</time></a> </div>
<div class="comment-content">
<p>Java has long been competitive with C/C++ for tight numerical loops.</p>
<p>Where C/C++ is consistently integer factors faster than Java in the performance department is in memory-intensive codes. Hence why, for example, C/C++ is still the preferred language for database engines and high-performance server code. Even if you use ugly non-idiomatic Java for performance purposes, it is not uncommon for C++ to be 2x faster for apps that abuse the memory subsystem.</p>
</div>
</li>
<li id="comment-55467" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-23T16:35:36+00:00">July 23, 2012 at 4:35 pm</time></a> </div>
<div class="comment-content">
<p>First *optimal* C++ code might be faster or more efficient than Java (or other higher level code). Most programmers do not write optimal code most of the time. Average programmers tend to turn out fairly horrible code, and C++ code can be hideously dangerous, in careless hands. These are not casually interchangable choices.</p>
<p>Second, the simple example given here is to raise a valid point, not to provide comprehensive proof. Some sorts of code optimize to near the same level of performance across languages.</p>
<p>Third, your choice of algorithm can make a greater difference than a more efficient compiler. If a higher order language allows you to write the first version in less time, and eases later refactoring, then you have the opportunity to fold in better algorithms when you understand the problem better. So for the same programmer effort, a higher order language can yield a more efficient end product.</p>
</div>
</li>
<li id="comment-55468" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/14f960db36a5288512a6aa757e37b8e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/14f960db36a5288512a6aa757e37b8e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Gregory</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-23T16:38:30+00:00">July 23, 2012 at 4:38 pm</time></a> </div>
<div class="comment-content">
<p>I also believe such a microbenchmark lead people to draw wrong conclusions yes</p>
<p>You didn&rsquo;t even look at the generated asm code did you?<br/>
You&rsquo;re missing all the steps of:<br/>
1) benchmark something real, with a wall clock (the time command is useful)<br/>
2) profile and identify hot spots<br/>
3) look at generated assembly</p>
<p>Here are the results on my linux, g++ 4.7.1, x86<br/>
basic sum 409.836<br/>
smarter sum 403.226<br/>
fast sum 409.836</p>
<p>and here are the results on my mac, g++ 4.2, x86_64<br/>
basic sum 1086.96<br/>
smarter sum 724.638<br/>
fast sum 847.458</p>
<p>what do my numbers tell you? and then, how smart are the smart implementations?</p>
<p>here is the modified code:<br/>
<a href="http://pastebin.com/F67R8pUK" rel="nofollow ugc">http://pastebin.com/F67R8pUK</a></p>
<p>depending on the compiler, data.size() calls may be issued PER ITERATION<br/>
same goes for operator[]&rsquo;s implementation that may dereference this-&gt;_m_data or whatever it&rsquo;s called in your STL implementation again PER ITERATION</p>
<p>why is it so? the C++ optimizer might not realize size() hasn&rsquo;t changed, or this-&gt;_m_data is the same as the previous iteration etc&#8230; there are many reasons for that, one of them can be pointer aliasing</p>
<p>interestingly enough, JIT compilers/optimizers likely realize this and perform well!</p>
<p>likely, you can come up with a microbenchmark involving virtual functions: the C++ compiler would generate indirect vtbl calls per iteration while at somepoint the JIT compiler might realize there&rsquo;s nothing virtual and it&rsquo;s always the same leaf method invoked again and again and save indirect call. get the idea?</p>
<p>anyways, very capable people explain that better than me and once in a while someone on the internet pops out with a naive (excuse me but it is) microbenchmark and draws big conclusions about languages</p>
<p>cheers,<br/>
g</p>
</div>
</li>
<li id="comment-55469" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-23T17:04:46+00:00">July 23, 2012 at 5:04 pm</time></a> </div>
<div class="comment-content">
<p>@Andy</p>
<p>Look at JavaScript in the benchmarks. It fares nearly as well as Go.</p>
</div>
</li>
<li id="comment-55470" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Curious mind</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-23T17:18:52+00:00">July 23, 2012 at 5:18 pm</time></a> </div>
<div class="comment-content">
<p>Your test shows you have little understanding of how a processor works. The way the code is written leaves all to optimized at the processor&rsquo;s registers, you findings have little to no real significance. Try writing code that will force data to be copied to and from registersRAM and run you comparison again. Only then you may find something meaninful&#8230; then revise your perspective.</p>
</div>
</li>
<li id="comment-55471" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-23T17:40:30+00:00">July 23, 2012 at 5:40 pm</time></a> </div>
<div class="comment-content">
<p>@Gregory</p>
<p><em> while someone on the internet pops out with a naive (excuse me but it is) microbenchmark and draws big conclusions about languages</em></p>
<p>Here&rsquo;s what I wrote: &ldquo;Of course, from a sample of a 3 compilers on single problem, I only provide an anecdote, but there are extensive and well established benchmarks supporting my points&rdquo;.</p>
<p><em>You didn&rsquo;t even look at the generated asm code did you?</em></p>
<p>Yes I did. </p>
<p><em>You&rsquo;re missing all the steps (&#8230;)</em></p>
<p>How do you know I did not benchmark something real, identify the hot spot, read the assembly, tried with different compilers? Because this is exactly what I did and I&rsquo;ve got witnesses.</p>
<p><em>what do my numbers tell you? and then, how smart are the smart implementations?</em></p>
<p>The version I do report in the blog post is a default implementation in C++, something many programmers would use. Yes, you can do better, but I also acknowledge this.</p>
<p>For the record, I did test with GCC 4.2, but using different machines&#8230; here are the results&#8230;</p>
<p>My GCC 4.2 tests using my code on my macbook air (I keep only best results): </p>
<p>$ ./cumulsum<br/>
reporting speed in million of integers per second<br/>
test # 0<br/>
basic sum 120.773<br/>
smarter sum 352.113<br/>
fast sum 847.458</p>
<p>Same test, same machine, with GCC 4.7 (still on the macbook, again best results):</p>
<p>$ ./cumulsum<br/>
reporting speed in million of integers per second<br/>
test # 0<br/>
basic sum 1111.11<br/>
smarter sum 1388.89<br/>
fast sum 1388.89</p>
<p>Best Java result: 1315.</p>
<p>Here are the results on an older iMac&#8230; first with GCC 4.2:</p>
<p>$ ./cumulsum<br/>
reporting speed in million of integers per second<br/>
test # 0<br/>
basic sum 537.634<br/>
smarter sum 549.451<br/>
fast sum 617.284</p>
<p>next with GCC 4.7:</p>
<p>$ ./cumulsum<br/>
reporting speed in million of integers per second<br/>
test # 0<br/>
basic sum 1041.67<br/>
smarter sum 1351.35<br/>
fast sum 1351.35</p>
<p>Best result using Java: 1219</p>
<p>Of course, all my tests are done using a core i7 processor. Results will vary if you have a different processor.</p>
<p>Still, in both cases, Java beats GCC 4.2 by a wide margin and GCC 4.7 is not much faster.</p>
<p>BTW your numbers appear low. How old is your hardware? My iMac dates back to 2009 and it can easily do over 1000 mis.</p>
</div>
</li>
<li id="comment-55472" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-23T17:42:25+00:00">July 23, 2012 at 5:42 pm</time></a> </div>
<div class="comment-content">
<p>@Curious mind</p>
<p><em>Your test shows you have little understanding of how a processor works. The way the code is written leaves all to optimized at the processor&rsquo;s registers, you findings have little to no real significance. Try writing code that will force data to be copied to and from registersRAM and run you comparison again.</em></p>
<p>Why on Earth would I introduce extra copying?</p>
</div>
</li>
<li id="comment-55473" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b517b629a15b209342028fc88595954f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b517b629a15b209342028fc88595954f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">bad_sheep</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-23T18:47:25+00:00">July 23, 2012 at 6:47 pm</time></a> </div>
<div class="comment-content">
<p>This is exactly my feeling. I am in a field where performance has its kind of importance (Video), we are probably one of the very few companies working in Java.</p>
<p>Despite some of our products are not supposed to be well fitted for Java (always reading the same kind of data very fast, but without handling ourself the allocations), we can reach the same (most of the time, it is even better) performance as our competitors because we simply spend less time on micro optimization while we can work on real algorithms optimizations.</p>
<p>But the key point is our team can work less than half the time that would needed for the competitor to have the same product. I am not event talking about parallelization which is sometime very difficult to perform in C/C++ while Java (while not being the best at that game) offers far more tools.</p>
</div>
</li>
<li id="comment-55474" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0cb262780bd22f92d2a93008ae56b8c1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0cb262780bd22f92d2a93008ae56b8c1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">sumodds</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-23T19:43:10+00:00">July 23, 2012 at 7:43 pm</time></a> </div>
<div class="comment-content">
<p>I can see what you are saying to some extend. </p>
<p>Since many have been complaining about realistic benchmark, here is a decent one. As you and many other mention, java might be off by a factor of two.<br/>
<a href="http://shootout.alioth.debian.org/" rel="nofollow ugc">http://shootout.alioth.debian.org/</a></p>
<p>I think this kind of goes in line with Paul Graham&rsquo;s thoughts, where he explains ITA use of lisp for leverage on a specific class of problem.<br/>
<a href="http://www.paulgraham.com/icad.html" rel="nofollow ugc">http://www.paulgraham.com/icad.html</a></p>
</div>
</li>
<li id="comment-55475" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-23T20:40:31+00:00">July 23, 2012 at 8:40 pm</time></a> </div>
<div class="comment-content">
<p>@sumodds</p>
<p>Thanks. I do link to the shootout in the post, even though my critics failed to notice. 😉</p>
</div>
</li>
<li id="comment-55477" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b3eeb7653c4df9b0f1332b9b0ec201ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b3eeb7653c4df9b0f1332b9b0ec201ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Max Lybbert</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-23T21:56:37+00:00">July 23, 2012 at 9:56 pm</time></a> </div>
<div class="comment-content">
<p>@Christian beat me to it: the fact that the original code uses a std::vector places a limit on how much can be handled at compile time. Assuming that you have the stack space, using a stack-allocated array would give the compiler enough information (where every element of the array is allocated, and what that value will be) to actually do the entire calculation at compile time and allocate the array with the final results. It&rsquo;s hard to imagine a more optimized version than that.</p>
<p>I&rsquo;m not sure if any compilers would go that far, but it would be theoretically possible.</p>
</div>
</li>
<li id="comment-55478" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Peter Ashford</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-23T22:14:13+00:00">July 23, 2012 at 10:14 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m a Java programmer and I&rsquo;ve done lots of very high performance code in Java (I used to be a C/C++ programmer, so I know what the difference is in optimising both platforms also). I agree with your core point: Java can be very fast but also fast at much less development cost than C or C++ programs, but one area where C and C++ always win over Java (at least in my benchmarks) is memory usage &#8211; if use of memory must be minimised then C/C++ programs can often be made that use half the memory of an equivalent Java program. Personally, I&rsquo;m ok with that trade-off: Memory is cheap and abundant for most purposes whereas development time is a big deal.</p>
</div>
</li>
<li id="comment-55484" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/26e0963e76bf85cb06c8c2fbce2f06df?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/26e0963e76bf85cb06c8c2fbce2f06df?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://kynosarges.wordpress.com/" class="url" rel="ugc external nofollow">Chris Nahr</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T03:37:15+00:00">July 24, 2012 at 3:37 am</time></a> </div>
<div class="comment-content">
<p>Interesting experiment. On a Core i7 920 machine with Windows 7 x64, the 64-bit Oracle JVM produces ~1470 mi/s, similar to other results posted here.</p>
<p>Then I felt like being mean and tested Microsoft Visual C++ and C# (both VS2010 SP1, max optimization). The results were only ~450, roughly the same for both compilers and all tests, even when I used a C++ array instead of vector. That matches my anecdotal experience that Microsoft&rsquo;s compilers are rather terrible at optimizing numerical code.</p>
<p>Overall I think the results posted here are illuminating, not because Java beats C++ in some benchmark but because such a simple Java algorithm beats so many C++ compilers. If you need a specific combination of C++ compiler and hand-optimized C++ algorithm to narrowly beat a dead simple Java algorithm, that&rsquo;s a very compelling argument for Java and against C++.</p>
</div>
</li>
<li id="comment-55479" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f832f56a7bbf7e8ab7a5dd3d2e34997b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f832f56a7bbf7e8ab7a5dd3d2e34997b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jimmy Smith</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T00:43:02+00:00">July 24, 2012 at 12:43 am</time></a> </div>
<div class="comment-content">
<p>I find this sort of example a little frustrating. It is similar to what a Harvard grad must think when hearing, &ldquo;My school&rsquo;s Energy Economics department is just as good Harvard&rsquo;s.&rdquo; </p>
<p>For almost any language/implementation, you can find an example were it performs better than the similar C program. The real performance issue is what do you do when your code is off by a factor of 10 or 100 from the expected run time? With C and some experience, you can almost always coax the compiler into doing the right thing. With Java, there can be some limitation in the JVM implementation which you cannot work around. In which case, you are out of luck (or you use JNI). </p>
<p>This along with malloc/free (I cannot afford to wait for the garbage collector to do its job) is why C and C++ (and Fortran) are still being used. And will continue to be used. </p>
<p>That said, unless you are one of the small number of people writing HPC code for multi-million dollar computers, C is probably not the best language for you. I agree with the author; Java is a great language. However, I find this speed argument does Java a disservice.</p>
</div>
</li>
<li id="comment-55480" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b969cb7d681c2a7bd5cbb50a1bbc78b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b969cb7d681c2a7bd5cbb50a1bbc78b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Pierre Barbier de Reuille</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T01:43:39+00:00">July 24, 2012 at 1:43 am</time></a> </div>
<div class="comment-content">
<p>Just a few other things: as you know, the new C++ introduced features with the purpose to be more efficient. And indeed, if you add the function:</p>
<p>void partialSum(std::vector&amp; array)<br/>
{<br/>
int acc = 0;<br/>
for(int&amp; i: array)<br/>
{<br/>
i = (acc += i);<br/>
}<br/>
}</p>
<p>Then, you get with gcc on my machine ~1350 (~1470 for java)</p>
<p>And, at last, if you use float instead of int, suddenly, java is slower than gcc:<br/>
java ~730<br/>
gcc 4.7 ~960<br/>
clang 3.1 ~960</p>
<p>I find interesting that their optimisation doesn&rsquo;t trigger for floats.</p>
</div>
</li>
<li id="comment-55481" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">garbage</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T02:02:57+00:00">July 24, 2012 at 2:02 am</time></a> </div>
<div class="comment-content">
<p>Well, Java is a fast language&#8230; until GC kicks in and everything freezes for several seconds. 😛 I heard this again recently from developers of social network site written in Java.</p>
<p>I think your benchmark is flawed because it is a micro benchmark with a very clear and small (not much code) &ldquo;bottleneck&rdquo;. Sure it&rsquo;s easy for JIT to identify and optimize it. However in real applications there is no 3-line bottleneck. Most of the time is spent in hundreds and thousands lines of code and JIT adds overhead itself while trying to find some spots for optimization.</p>
<p>Code produced by mediocre Java programmer might perform better that code written by mediocre C++ programmer because of tool support/JIT. However with recent C++11 standard C++ has become much better and it&rsquo;s less verbose than Java.</p>
</div>
</li>
<li id="comment-55482" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/59d77fe8ddbe994c4b99e13ef78354c6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/59d77fe8ddbe994c4b99e13ef78354c6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christoph</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T02:06:05+00:00">July 24, 2012 at 2:06 am</time></a> </div>
<div class="comment-content">
<p>The C++ programm produces undefined behaviour because it creates integer overflows. 🙂</p>
</div>
</li>
<li id="comment-55483" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6638e7205e8cdf6f03e83fefeea87bdd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6638e7205e8cdf6f03e83fefeea87bdd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kumar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T02:34:28+00:00">July 24, 2012 at 2:34 am</time></a> </div>
<div class="comment-content">
<p>Whoa ! No need to reinvent the wheel with WallClockTimer. Standard way to benchmark is to use time.h (ctime in c++). </p>
<p>Example (<a href="http://www.cplusplus.com/reference/clibrary/ctime/difftime/" rel="nofollow ugc">http://www.cplusplus.com/reference/clibrary/ctime/difftime/</a>):<br/>
time_t start, end;<br/>
double overhead, elapsed;<br/>
time(&amp;start);<br/>
time(&amp;end);<br/>
overhead = difftime(end, start);<br/>
time(&amp;start);<br/>
// code to benchmark goes here&#8230;<br/>
time(&amp;end);<br/>
elapsed = difftime(end, start) &#8211; overhead;</p>
<p>With these changes, I get the elapsed time as 0.0 !</p>
<p>Meaning, the problem is how you are measuring! My code is here, it uses another method (using time_t):</p>
<p><a href="https://gist.github.com/3168607" rel="nofollow ugc">https://gist.github.com/3168607</a></p>
</div>
</li>
<li id="comment-55493" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dominic Amann</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T08:15:33+00:00">July 24, 2012 at 8:15 am</time></a> </div>
<div class="comment-content">
<p>I find that in real world programs, the apparent speed of Java seems to diminish as size and memory use increases &#8211; so for complex real world numerically intense applications, a core library of c/c++ for number crunching will outperform Java for more than a factor of 2 (and sometimes an order of magnitude). Factor in precise control of memory handling (for large arrays), and c++ is definitely the way to go.</p>
</div>
</li>
<li id="comment-55485" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6638e7205e8cdf6f03e83fefeea87bdd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6638e7205e8cdf6f03e83fefeea87bdd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">bdsatish</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T03:44:06+00:00">July 24, 2012 at 3:44 am</time></a> </div>
<div class="comment-content">
<p>I used C++11&rsquo;s high_resolution_timer to measure accurately to milliseconds. The C++ version and my results are here:</p>
<p><a href="https://github.com/bdsatish/cumulsum" rel="nofollow ugc">https://github.com/bdsatish/cumulsum</a></p>
</div>
</li>
<li id="comment-55486" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/14f960db36a5288512a6aa757e37b8e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/14f960db36a5288512a6aa757e37b8e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Gregory</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T04:00:50+00:00">July 24, 2012 at 4:00 am</time></a> </div>
<div class="comment-content">
<p>@Daniel</p>
<p>linux: intel core 2 6600 @ 2.4ghz<br/>
mac: 2.66 GHz Intel Core i7</p>
<p>compiled with g++ -O3 -o cumulsum cumulsum.cpp</p>
<p>&#8212;<br/>
ok you did look at asm; but you didn&rsquo;t tell us you did, and a reader of your post surely doesn&rsquo;t notice the steps I mentioned are in fact mandatory</p>
<p>the point is the post conveys the false idea a small microbenchmark is enough to draw conclusions about relative language performance</p>
</div>
</li>
<li id="comment-55487" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T06:59:33+00:00">July 24, 2012 at 6:59 am</time></a> </div>
<div class="comment-content">
<p>@Gregory </p>
<p><em>ok you did look at asm; but you didn&rsquo;t tell us you did, and a reader of your post surely doesn&rsquo;t notice the steps I mentioned are in fact mandatory</em></p>
<p>Maybe, but I was not trying to say anything about optimizing code. I am just stressing that Java (and also JavaScript) is faster than you might think. If this was an obvious and well known fact, I don&rsquo;t think this post would have gotten so much reaction (including angry ones).</p>
<p><em>the point is the post conveys the false idea a small microbenchmark is enough to draw conclusions about relative language performance</em></p>
<p>Perhaps it can give out impressions but my post says no such thing and as a scientist I would never draw such conclusions so easily. I do rely and link however to existing benchmarks.</p>
<p>It should be a known fact by now that Java and JavaScript are very fast languages. There are good reasons to favor C++ over Java, but raw speed is probably not a good reason in most cases.</p>
<p>This looks like a political issue. I think a lot of people have been saying &ldquo;we can&rsquo;t write this in Java because it will be slower, we need C++&rdquo;. I think a lot these folks did not run the benchmarks to justify their choices. They work from prejudice.</p>
</div>
</li>
<li id="comment-55488" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T07:01:39+00:00">July 24, 2012 at 7:01 am</time></a> </div>
<div class="comment-content">
<p>@Christoph</p>
<p><em>The C++ programm produces undefined behaviour because it creates integer overflows.</em></p>
<p>The code in the blog post does, granted, but the actual code being benchmarked does not because we check whether the size is zero. I simplified the code when I copied and pasted it in the blog post.</p>
<p>So I don&rsquo;t think that&rsquo;s the issue.</p>
</div>
</li>
<li id="comment-55489" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/14f960db36a5288512a6aa757e37b8e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/14f960db36a5288512a6aa757e37b8e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Gregory</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T07:17:07+00:00">July 24, 2012 at 7:17 am</time></a> </div>
<div class="comment-content">
<p>@Daniel,</p>
<p>(I&rsquo;m not angry, sorry if I gave that impression &#8212; blame media and english not being my mother tongue?)</p>
<p>I get your point.</p>
<p>&ldquo;If your sole reason for using C++ is speed, and you lack the budget for intensive optimization, you might be misguided.&rdquo;</p>
<p>It&rsquo;s even more than that. If you&rsquo;re sole reason for using C++ is speed, and you apply OOP like in Java then you&rsquo;re very misguided. Pointer chasing, scattered heap allocations, lack of data locality, cache trashed by vcalls, etc. All those come from doing OOP by the book and go against program efficiency</p>
</div>
</li>
<li id="comment-55490" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/67ad59a6c75a4129f972f0a0ef903ad4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/67ad59a6c75a4129f972f0a0ef903ad4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://gdr.name/" class="url" rel="ugc external nofollow">GDR!</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T07:27:45+00:00">July 24, 2012 at 7:27 am</time></a> </div>
<div class="comment-content">
<p>Yeah, right. I too tried to avoid low level programming when writing a 3-D Kirchhoff Migration implementation (n^5 complexity). I only executed the C# version a few times, each run taking about two days to complete, before moving to carefully optimized C. It now takes only a few hours to complete and I&rsquo;m still going to rewrite it to OpenCL (which is &#8211; guess what &#8211; a C variant) to make it faster.</p>
<p>It depends what you&rsquo;re doing, of course, but for computation intensive applications C is still unbeatable.</p>
</div>
</li>
<li id="comment-55491" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T07:47:40+00:00">July 24, 2012 at 7:47 am</time></a> </div>
<div class="comment-content">
<p>@garbage</p>
<p><em>Well, Java is a fast language&#8230; until GC kicks in and everything freezes for several seconds. 😛 I heard this again recently from developers of social network site written in Java. </em></p>
<p>Garbage collection can indeed be a problem but this is maybe overstated. Good Java programmers reuse objects, for example, to avoid stressing the garbage collector.</p>
<p>This being said, given the choice between writing a social network in C++, JavaScript or Java, I would go with JavaScript.</p>
<p>The C++ version could be faster if you have the kind of budgets that Facebook has. Otherwise, it is almost certainly going to be a nightmare.</p>
</div>
</li>
<li id="comment-55492" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b969cb7d681c2a7bd5cbb50a1bbc78b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b969cb7d681c2a7bd5cbb50a1bbc78b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Pierre Barbier de Reuille</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T08:07:44+00:00">July 24, 2012 at 8:07 am</time></a> </div>
<div class="comment-content">
<p>It is sad to note that what could have been a nice little test turned quickly into C++ bashing, and an unjustified one at that! Try you program with any type beside int and the perfs go down to be largely behind the simplest C++ solution.<br/>
You could almost think the java compiler is &ldquo;cheating&rdquo; by hyper-optimizing this micro-benchmark. Otherwise, how do you explain that adding short integers is twice as slow as adding integers?<br/>
As usual for any benchmark, stick to the what the benchmark says, don&rsquo;t extrapolate, ever!</p>
</div>
</li>
<li id="comment-55494" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T08:32:36+00:00">July 24, 2012 at 8:32 am</time></a> </div>
<div class="comment-content">
<p>@Pierre Barbier de Reuille </p>
<p><em>It is sad to note that what could have been a nice little test turned quickly into C++ bashing, and an unjustified one at that! </em></p>
<p>I&rsquo;m not bashing C++. I write C++ almost every single day, by choice.</p>
<p><em>how do you explain that adding short integers is twice as slow as adding integers?</em></p>
<p>I just checked in a new test with shorts. I get that Java is 25% slower with shorts than with ints. I get nothing close to &ldquo;twice as slow&rdquo;. And even then, Java can still beat C++ under GCC 4.5 easily.</p>
<p>I don&rsquo;t think that&rsquo;s a case where Java optimizes the int case and fails to optimize for shorts. As a rule, you do expect shorts to be slower, unless you have lots of cache misses. (Compilers might be able to turn the use of short to its benefits in specific cases though. But failure to do so is not a surprise to me.)</p>
</div>
</li>
<li id="comment-55495" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/59d77fe8ddbe994c4b99e13ef78354c6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/59d77fe8ddbe994c4b99e13ef78354c6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christoph</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T09:46:35+00:00">July 24, 2012 at 9:46 am</time></a> </div>
<div class="comment-content">
<p>@Daniel I wrote about integer overflow and not about invalid memory accesses. The program overflows int at index 56756 on my machine and data[56756] becomes negative.<br/>
This certainly can be ignored here and will not affect the results, but it shows the perils of C++ programming.</p>
</div>
</li>
<li id="comment-55496" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f79a7909dfca0088f4fdc01f109f497e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f79a7909dfca0088f4fdc01f109f497e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Isaac Gouy</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T10:22:17+00:00">July 24, 2012 at 10:22 am</time></a> </div>
<div class="comment-content">
<p>&gt;&gt;Really clever and hard working C/C++ programmers can beat higher-level languages by a wide margin given enough time. However, their code will typically become less portable and harder to maintain.&lt;&lt;</p>
<p>Maybe the Java and JavaScript programs that perform well in the benchmarks game were contributed by clever Java and JavaScript programmers who put a lot of effort into those programs?</p>
<p>Maybe those Java and JavaScript programs have also become less portable and harder to maintain? </p>
<p>(Less portable in the sense that the same performance is not maintained &#8211; performance is brittle).</p>
</div>
</li>
<li id="comment-55497" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T10:56:52+00:00">July 24, 2012 at 10:56 am</time></a> </div>
<div class="comment-content">
<p>@Isaac Gouy</p>
<p>The shootout benchmark is open source and you can inspect their source code. It looks good to me.</p>
<p>There is no doubt that you can make JavaScript unreadable, but my point is that it is unfair to compare a heavily optimized C++ program with a straight JavaScript program. C++ offers you more room for improving your performance, so if you have a lot of time on your hands, then go for C++. But in real life, people have to ship software at some point. So an honest comparison is one where you just take nice looking code in both languages.</p>
</div>
</li>
<li id="comment-55498" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/10bff5b3dcd1d96a554a354ab05c62ce?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/10bff5b3dcd1d96a554a354ab05c62ce?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">sj</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T13:48:17+00:00">July 24, 2012 at 1:48 pm</time></a> </div>
<div class="comment-content">
<p>Java uses jvm optimization on the loop. </p>
<p>so it is silly to compare the java loop and c++ loop just on the source file. You need to compare the assembly language output, and try to match the source code on the both language to get a fair stat.</p>
<p>try running your iteration 20 times and see the difference. Why is looping 1mil times important? If that is important then just use linear algebra lib ..</p>
</div>
</li>
<li id="comment-55499" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/773f90d7d7a3bfea376ba86dd16d27e0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/773f90d7d7a3bfea376ba86dd16d27e0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Keck</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T14:05:54+00:00">July 24, 2012 at 2:05 pm</time></a> </div>
<div class="comment-content">
<p>Have you tried a good C or C++ implementation using intrinsics?</p>
<p>Java 1785<br/>
GCC 4.7 (with -funroll-loops) 2000<br/>
Is that not more than 10%? Are you saying loop unrolling is not a &ldquo;fair optimization&rdquo; to compare or use? If you&rsquo;re doing this type of operation, you&rsquo;d be silly to not take advantage of it.</p>
<p>I agree with you, that unless you have the time/ability/compiler/etc to make a very optimized by hand version, it&rsquo;s probably not worth, except in the cases it is worth it. The point I feel is better expressed is, each language has its purpose, but sometimes, for some problems, you get more for free in different languages.</p>
<p>I&rsquo;ve worked on some absolutely, incredibly, stringent, projects where I couldn&rsquo;t use say the Math Kernel Library Matrix Multiplication, even though it is super optimized, because it wasn&rsquo;t optimized as well as it could be for some obscure matrices&rsquo; sizes, e.g. m = 28&#215;16384 and n = 16384&#215;856. SO, I got to write a hand version and sometimes meta template programming won for some sizes on smaller multiplications, sometimes(most of the time for me) intrinsics won when you get to this level of optimization. It depends almost completely on what you&rsquo;re trying to accomplish. </p>
<p>Now, the C++ compilers, more recent ones catch the easy ones for a lot of this by planting SSE2 or better in where it can (why your GCC 4.7 is so much faster than GCC 4.5), the loop unrolling can save a lot too, especially as your iterations gets larger. So, I don&rsquo;t consider that an unrealistic optimization. Java&rsquo;s VM most definitely attempts to do loop unrolling.</p>
<p>In this example, by how you are doing the sum, you are masking some of the power of what the C/C++ compiler can do, or hand optimization in C/C++ period, can do by how you&rsquo;re choosing to do your sum. Because of how you are doing the sum, you are forcing the inrinsics to use an unaligned load for the 128bit representation of the integer, because you are always doing &ldquo;i &#8211; 1.&rdquo; Meaning never on the boundary, meaning more costly load even if it does catch the SSE optimization. If you could spare it up front, to have two copies, your sum might be faster. Also, I can decide based on how many registers I have personally to do things like say do 4, 128bit loads at a time and accumulate partial sums and then add up the sub blocks. Or, if I know my values are small, I can saturate a 128bit block and do addition on smalls and do 8 at a time. The point is I think it&rsquo;s one thing to say, &ldquo;there are examples where other languages get you pretty great results out of the gate,&rdquo; but it&rsquo;s another thing to have an algorithm that is not the optimal way of doing things in one language only to say, &ldquo;look it&rsquo;s not much better than language X.&rdquo;</p>
<p>const size_t C_SIZE = 100000000; //- or whatever sufficiently large value, if it&rsquo;s small you wouldn&rsquo;t do intrinsics anyways<br/>
for (size_t i = 1; i != C_SIZE &#8211; remainder; i+=4)<br/>
{<br/>
__m128i left = _mm_loadu_si128( (__m128i *)&amp;data[i] );<br/>
__m128i right = _mm_loadu_si128( (__m128i *)&amp;data[i &#8211; 1] );<br/>
_mm_storeu_si128( (__m128i *)&amp;data[i], _mm_add_epi32(left, right) );<br/>
}</p>
<p>for (size_t i = C_SIZE &#8211; remainder; i != C_SIZE; ++i)<br/>
{<br/>
data[i] += data[i &#8211; 1] ;<br/>
}</p>
<p>That&rsquo;s one thing, but thta&rsquo;s a lot slower than if I have a second in memory that is 16byte aligned and &ldquo;one ahead&rdquo; of the other.<br/>
for (size_t i = 1; i != C_SIZE &#8211; remainder; i+=4)<br/>
{<br/>
__m128i left = _mm_load_si128( (__m128i *)&amp;data[i] );<br/>
__m128i right = _mm_load_si128( (__m128i *)&amp;data2[i ] );<br/>
_mm_store_si128( (__m128i *)&amp;data[i], _mm_add_epi32(left, right) );<br/>
}</p>
<p>for (size_t i = C_SIZE &#8211; remainder; i != C_SIZE; ++i)<br/>
{<br/>
data[i] += data[i &#8211; 1] ;<br/>
}</p>
<p>I wouldn&rsquo;t write either that way though. I have too many architecture questions to worry about. This code is not portable. It&rsquo;s fragile, but it has it&rsquo;s place.<br/>
That aside, the Intel Compiler will catch if I just have two data structures, one replicated and &ldquo;one ahead&rdquo; and both 16 byte aligned, and turn:</p>
<p>for (size_t i = 1; i != data.size(); ++i) {<br/>
data[i] += data[i &#8211; 1] ;<br/>
}</p>
<p>into something beautiful (most of the time)</p>
<p>So, it&rsquo;s a &ldquo;use the right tool for the job&rdquo; argument, in my mind. Each language has it&rsquo;s place, sometimes you get more stuff for free in other languages. BUT, I think your example is slightly faulty because you don&rsquo;t provide an avenue with how you write your algorithm &#8211; if you really are trying for speed of cumulative sum &#8211; for the C/C++ compilers to do all they can for you, for free.</p>
</div>
</li>
<li id="comment-55500" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T14:38:35+00:00">July 24, 2012 at 2:38 pm</time></a> </div>
<div class="comment-content">
<p>@Keck</p>
<p><em>Have you tried a good C or C++ implementation using intrinsics?</em></p>
<p>No. I also did not look at a solution using assembly code.</p>
<p>Though I did not examine all of the assembly code for all the compilers, my impression is that SSE is not used to optimize the main loops. As evidence, the numbers don&rsquo;t change if I had &ldquo;-mno-sse2&rdquo; to the compiler flags.</p>
<p><em>Are you saying loop unrolling is not a â€œfair optimizationâ€ to compare or use?</em></p>
<p>No but it is not a default switch because it can worsen performance. Anyhow, I do provide the results with -funroll-loops in my blog post.</p>
<p><em>Is that not more than 10%</em></p>
<p>That&rsquo;s 10.8%. Literally speaking higher than 10%. </p>
<p><em>it&rsquo;s another thing to have an algorithm that is not the optimal way of doing things in one language only to say, â€œlook it&rsquo;s not much better than language X.â€</em></p>
<p>These three lines of codes are how the majority of C++ programmers would code it. The use of intrinsics you describe is not common C++.</p>
</div>
</li>
<li id="comment-55501" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/773f90d7d7a3bfea376ba86dd16d27e0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/773f90d7d7a3bfea376ba86dd16d27e0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Keck</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T15:21:23+00:00">July 24, 2012 at 3:21 pm</time></a> </div>
<div class="comment-content">
<p>@Daniel Lemire</p>
<p>No doubt it&rsquo;s not normal C++, that doesn&rsquo;t mean the compiler can&rsquo;t do it or there aren&rsquo;t developers that can&rsquo;t. ICC and even VS 2010, and definitely GCC 4.7 will optimize that loop for such a simple sum operation to some SSE2 if the architecture supports it, anything since 2000 pretty much. ICC will do a better job than either out of the box. BUT, I know for a fact that GCC 4.7 optimizes that loop very differently than GCC 4.5, and that&rsquo;s most likely for two reasons: GCC 4.5 was released before his your processor, also GCC put in a lot of SSE and vectorization in GCC 4.6/GCC 4.7.</p>
<p>So, it&rsquo;s not &ldquo;normal&rdquo; but it&rsquo;s possible. So it&rsquo;s still a &ldquo;pick the best tool for the job,&rdquo; and as the C++ compilers get better, yes people work on that one too to make it better all the time not just Java, it&rsquo;ll catch more and more of these types of optimizations. Heck, even microsoft from vc2008 to vc2010 did a ton of work in this. </p>
<p>My point was this particular example isn&rsquo;t necessarily the best algorithm to prove what the compiler can do by itself to optimize your code, because of how you&rsquo;ve decided to do the sum. For instance, the Intel Compiler even picks up your version as being aliased differently and writes better assembly that uses some shuffling to align as it goes in a different register that it determined it didn&rsquo;t need to use to do the sum operation.</p>
<p>1785 to 2000 is not 10.8% difference, or am I missing something? I do think when I&rsquo;m benchmarking things in a loop that loop optimizations for the benchmark do matter. ALSO, I can pragma in the optimization just for the loop I want and not have everything subject to the unrolling.</p>
<p>Loop unrolling isn&rsquo;t a standard optimization, most definitely because it can worsen performance. Pick a low prime number(I say prime because I&rsquo;ll assume the Duff&rsquo;s device is going to try 4, 8, 16, 32 and I&rsquo;m just covering my bases) and watch it really make it worse. But, weren&rsquo;t you comparing this in general over an extreme example? Unless you&rsquo;re in the science field, when are you writing a program that is going to do a million cumulative sums? Then, you&rsquo;re more likely to pick your language based on the libraries available to it. I might even go fortran if I&rsquo;m doing Digital Signal Processing and my client needs/uses Column Major Format. It&rsquo;s almost always going to be &ldquo;best tool for the job,&rdquo; or what libraries do I have for this that make my life easier.</p>
<p>My point is the example you picked has a hole with the compilers you used that hides some of the performance difference. I&rsquo;d try a test with all languages/compilers you care to that does something that all should be more equally good at. Otherwise, it&rsquo;ll always come down to the problem you are solving.</p>
</div>
</li>
<li id="comment-55503" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T15:54:56+00:00">July 24, 2012 at 3:54 pm</time></a> </div>
<div class="comment-content">
<p>@Keck</p>
<p><em>1785 to 2000 is not 10.8% difference,</em></p>
<p> (1785-2000)/2000 = 0.1075.</p>
<p><em>ALSO, I can pragma in the optimization just for the loop I want and not have everything subject to the unrolling.</em></p>
<p>I tried it in various ways but it failed to work. Can you provide the code that does it?</p>
<p><em>(&#8230;)when are you writing a program that is going to do a million cumulative sums?</em></p>
<p>Image processing, data compression, numerical analysis, data mining, machine learning, business intelligence&#8230; Basically, most areas where performance matters.</p>
<p><em>My point is the example you picked has a hole with the compilers you used that hides some of the performance difference.</em></p>
<p>This is an example to illustrate my point, but not my evidence.</p>
</div>
</li>
<li id="comment-55504" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/773f90d7d7a3bfea376ba86dd16d27e0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/773f90d7d7a3bfea376ba86dd16d27e0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Keck</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T15:55:15+00:00">July 24, 2012 at 3:55 pm</time></a> </div>
<div class="comment-content">
<p>@Daniel Lemire </p>
<p>I&rsquo;m sorry, I typed one thing and thought another. yes, 1785 is 10.8% difference from 2000. I lined up those values wrong 🙂</p>
</div>
</li>
<li id="comment-55505" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6b34a2a81515583dc95e5c0809db06bb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6b34a2a81515583dc95e5c0809db06bb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.craig-wood.com/nick/" class="url" rel="ugc external nofollow">Nick Craig-Wood</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T15:55:35+00:00">July 24, 2012 at 3:55 pm</time></a> </div>
<div class="comment-content">
<p>As I&rsquo;m learning Go at the moment I converted the code here:</p>
<p> <a href="https://gist.github.com/3172562" rel="nofollow ugc">https://gist.github.com/3172562</a></p>
<p>Interestingly it runs at almost identical speed to the &ldquo;basic sum (C++-like)&rdquo; using gcc 4.6.3 and g++ -funroll-loops -O3 -o cumuls cumuls.cpp</p>
<p>Go&rsquo;s compiler isn&rsquo;t particularly well optimised at the moment but I thought it did OK here.</p>
</div>
</li>
<li id="comment-55507" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/773f90d7d7a3bfea376ba86dd16d27e0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/773f90d7d7a3bfea376ba86dd16d27e0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Keck</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T16:10:33+00:00">July 24, 2012 at 4:10 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;when are you writing a program that is going to do a million cumulative sums?&rdquo;<br/>
&ldquo;Image processing, data compression, numerical analysis, data mining, machine learning, business intelligenceâ€¦ Basically, most areas where performance matters.&rdquo;</p>
<p>Perhaps my question is better said as this, &ldquo;When are you going to write a program that does a million cumulative sums where you care enough to benchmark but not enough to use the best language for it.&rdquo;</p>
<p>These are the fields I work in&#8230; I&rsquo;ve done DSP processing and image processing/manipulation for my entire career. So, yes, I do it daily, but most people don&rsquo;t. I feel your point is better proven on more common tasks. On many non-scientific projects, the gap is probably even closer between the languages! </p>
<p>I don&rsquo;t even disagree with your point. When I sit down and write prototypes, I use numpy and Python&#8230; I&rsquo;ve delivered things using this because it performed well enough.</p>
<p>I&rsquo;m just saying on a purely mathematical example, the way the code is written keeps some of the better compilers from optimizing this to a degree where the difference is larger out of the box. I just wanted to make you, possibly you already were aware, that this is actually where the most improvement is being seen/focused on in C/C++ compilers at the moment. Make this floating point math, and do the 10 * log(x^2 + y^2) (Amplitude in dB) in java and C/C++ and show me the speed difference &#8230;</p>
<p>The loop unroll pragma is just &ldquo;#pragma unroll.&rdquo; It&rsquo;s in extensions to GCC, and in msvc and ICC by default.</p>
</div>
</li>
<li id="comment-55508" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/773f90d7d7a3bfea376ba86dd16d27e0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/773f90d7d7a3bfea376ba86dd16d27e0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Keck</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T16:18:10+00:00">July 24, 2012 at 4:18 pm</time></a> </div>
<div class="comment-content">
<p>I feel C++ is worth it when it&rsquo;s worth it. It&rsquo;s not worth it when it&rsquo;s not &#8211; same is true of java over scala at times. Same is true of C over Ada. Or C over Fortran. Same is true as, &ldquo;how well do I know this language and how hard is my problem in it?&rdquo; over &#8230; </p>
<p>It&rsquo;s completely based on the problem, knowledge of what language for what type of problem each language is better at. I mean, C/C++ is worth it for me daily. I don&rsquo;t have a good Java FFT library yet &#8230; (If I do it&rsquo;s a C library wrapped for Java). All these languages have their place! &ldquo;Languages of the World, unite!(for the job you are best at)&rdquo;</p>
</div>
</li>
<li id="comment-55509" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemrie</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T16:21:59+00:00">July 24, 2012 at 4:21 pm</time></a> </div>
<div class="comment-content">
<p>@Keck</p>
<p>Java is used extensively in data mining, machine learning, business intelligence, information retrieval and so on. In another life I even wrote a high performance Java CODEC for wavelet-based compression. </p>
<p><em>The loop unroll pragma is just â€œ#pragma unroll.â€ It&rsquo;s in extensions to GCC </em></p>
<p>Yes, or you can do it with function attributes, but it does not work. It never worked for me and I could never find documented examples on the web where you could use pragmas to selectively apply unroll-loops. I use pragmas for other purposes such as disabling warnings, but it does not work to selectively tweak optimization in C++, in my experience.</p>
</div>
</li>
<li id="comment-55510" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T16:44:05+00:00">July 24, 2012 at 4:44 pm</time></a> </div>
<div class="comment-content">
<p>@Keck</p>
<p><em> I don&rsquo;t have a good Java FFT library yet â€¦</em></p>
<p>So your C++ FFT library is consistently much more than twice as fast as JTransform?(<a href="https://sites.google.com/site/piotrwendykier/software/jtransforms" rel="nofollow ugc">https://sites.google.com/site/piotrwendykier/software/jtransforms</a>) You should let the JTransform guys know because they think otherwise.</p>
</div>
</li>
<li id="comment-55511" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/773f90d7d7a3bfea376ba86dd16d27e0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/773f90d7d7a3bfea376ba86dd16d27e0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Keck</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T17:01:10+00:00">July 24, 2012 at 5:01 pm</time></a> </div>
<div class="comment-content">
<p>Actually, I use CUDA for FFT when I can anyways, for instance we have one such system that has 5 GPUs and we use CUFFT 4 and split the work up on our 3211264 because we have a 10ms processing window for that particular project. And CUDA 2.0 vs CUDA 4.0 is night and day for performance on FFT and Matrix Multiplication. This is definitely a bad argument too since it&rsquo;s not a very good CUDA card compared to what&rsquo;s available now for those large of FFTs. The difference in this probably only got worse.</p>
<p>They also used GCC 4.2.3 for their comparisons? Why? </p>
<p>Wait, GCC 4.2.3, but a newer Xeon processor in a benchmark of baseline optimizations? (okay let&rsquo;s cook the books on this from a generic optimization standpoint by just throwing a better CPU in this mix, but not use a version of GCC more recent in regards to it). Oh, let&rsquo;s pick big numbers and use 64bit java too.</p>
<p>&#8230; yes, I would bet latest MKL FFT library &#8211; if I have to stay complete in the CPU world &#8211; would beat it by more than 2x. Even with GCC 4.2.3 it did beat it by 2x most of the time, and it especially beat it by 2x in the FFT sizes that matter most for image/audio processing.</p>
<p>Especially if I have a version that takes advantage of Sandy Bridge/Ivy Bridge Stream Processors &#8230;</p>
<p>I do, I absolutely, most definitely disagree with JTransforms and their benchmarks from last year using a 3 year old at that time compiler. This gap in this specific realm has gotten much wider recently. This is not a good example for your case &#8230;</p>
</div>
</li>
<li id="comment-55512" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/599f9d9ca31b1fc95c906221705f20e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/599f9d9ca31b1fc95c906221705f20e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">David Stocking</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T18:28:04+00:00">July 24, 2012 at 6:28 pm</time></a> </div>
<div class="comment-content">
<p>You don&rsquo;t have a iterator based C++ version even though it basically compiles to the C version &#8230; but its still important.</p>
<p><a href="http://pastebin.com/Z1UT0pEA" rel="nofollow ugc">http://pastebin.com/Z1UT0pEA</a></p>
<p>That being said I think it will be an amazing day when we don&rsquo;t use C/C++ because of speed.</p>
</div>
</li>
<li id="comment-55513" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T20:48:49+00:00">July 24, 2012 at 8:48 pm</time></a> </div>
<div class="comment-content">
<p>@Keck</p>
<p><em>They also used GCC 4.2.3 for their comparisons? Why?</em></p>
<p>So you think it is unfair to compare a version of Java released in 2006 with a version of GCC released in 2008?</p>
<p>Well. Yes. I would say it is unfair to Java. </p>
<p>Note that in all my tests here, I have used Java 6, an *old* version of Java (I did not test java 7) compared with the latest and neatest C++ compilers (clang 3.1 and gcc 4.7).</p>
<p>Java 7 is substantially faster (on some benchmarks) than the version of Java I have used for my tests:</p>
<p><a href="http://geeknizer.com/java-7-whats-new-performance-benchmark-1-5-1-6-1-7/" rel="nofollow ugc">http://geeknizer.com/java-7-whats-new-performance-benchmark-1-5-1-6-1-7/</a></p>
<p>Strange you did not call me on this unfairness?</p>
</div>
</li>
<li id="comment-55514" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T20:53:51+00:00">July 24, 2012 at 8:53 pm</time></a> </div>
<div class="comment-content">
<p>@David Stocking</p>
<p>Great idea. The iterator-based approach is actually faster than the C version in my tests under GCC 4.7, but much slower under clang.</p>
<p>I&rsquo;ve added it.</p>
</div>
</li>
<li id="comment-55515" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c20a2c08c0072173d19fb94283c77737?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c20a2c08c0072173d19fb94283c77737?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://blog.vivekhaldar.com" class="url" rel="ugc external nofollow">Vivek Haldar</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-24T23:53:54+00:00">July 24, 2012 at 11:53 pm</time></a> </div>
<div class="comment-content">
<p>My full-length response: </p>
<p><a href="http://blog.vivekhaldar.com/post/27962511395/is-c-c-worth-it" rel="nofollow ugc">http://blog.vivekhaldar.com/post/27962511395/is-c-c-worth-it</a></p>
</div>
</li>
<li id="comment-55517" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/773f90d7d7a3bfea376ba86dd16d27e0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/773f90d7d7a3bfea376ba86dd16d27e0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Keck</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-25T10:04:14+00:00">July 25, 2012 at 10:04 am</time></a> </div>
<div class="comment-content">
<p>@Daniel Lemire</p>
<p><a href="http://www.readwriteweb.com/hack/2011/06/cpp-go-java-scala-performance-benchmark.php" rel="nofollow ugc">http://www.readwriteweb.com/hack/2011/06/cpp-go-java-scala-performance-benchmark.php</a></p>
<p><a href="https://days2011.scala-lang.org/sites/days2011/files/ws3-1-Hundt.pdf" rel="nofollow ugc">https://days2011.scala-lang.org/sites/days2011/files/ws3-1-Hundt.pdf</a></p>
<p>It matters much more what&rsquo;s in a version than how old it is, especially one specifically addresses something that change this particular discussion a lot. I&rsquo;m aware Java 1.7 has had a lot of performance increases. I&rsquo;m positive that compared to newer versions of FFTW, with a much newer compiler, the margin will be even worse against JTransforms even with Java 1.7. Also, probably even worse against MKL. I won&rsquo;t pit it against CUDA because that&rsquo;s not a fair test at all.</p>
<p>But, you seem very sure that JTransforms will not be more than 2x as slow&#8230; In things like this where performance matters, 2x as slow is probably unacceptable for real time analysis. Heck, sometimes 10% is unnacceptable, or even 1%. I&rsquo;m saying there is a purpose to all these things, and that your specific example does not prove your point well in my mind. </p>
<p>I&rsquo;m not even arguing against your point overall. I use a variety of languages often times based purely on productivity. But, I&rsquo;m saying your example you used is not a great one. But, you seem pretty certain. </p>
<p>So, I&rsquo;m wondering, if I show you that JTransforms on java 1.7 is more than 2x slower than say a more modern C++ compiler on either FFTW or MKL (which can use FFTW as it&rsquo;s implementation, I just have access to it as a commercial license), what would that show you?</p>
</div>
</li>
<li id="comment-55518" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-25T10:23:21+00:00">July 25, 2012 at 10:23 am</time></a> </div>
<div class="comment-content">
<p>@Keck</p>
<p><em>I&rsquo;m saying your example you used is not a great one. But, you seem pretty certain.</em></p>
<p>I&rsquo;m not sure how my blog post could be clearer as to how I view my example: &ldquo;Of course, from a sample of a 3 compilers on single problem, I only provide an anecdote (&#8230;)&rdquo;.</p>
<p>I have used this example because it is simple. Everyone can understand it and tweak it.</p>
<p>Implementing FFT efficiently is hard work. Not everyone can see what is going on. Benchmarking entire applications, for the scope of a blog post, is even crazier&#8230; nobody would ever go through my blog post.</p>
<p><em>So, I&rsquo;m wondering, if I show you that JTransforms on java 1.7 is more than 2x slower than say a more modern C++ compiler on either FFTW (&#8230;), what would that show you?</em></p>
<p>It will support the following statement I made: &ldquo;Really clever and hard working C/C++ programmers can beat higher-level languages by a wide margin given enough time. &rdquo;</p>
<p>I&rsquo;ll offer you a test that could falsify the claim of my blog post. We take ten undergraduates. We ask all of them to implement, from scratch, the FFT in both Java and C++. Then we benchmark. Are you still willing to bet that the C++ versions will be more than 2x faster?</p>
<p>I actually predict that some of the fastest implementations will be in Java. I predict that among the flawed implementations, most of them will be C++ ones. (I also predict that if you benchmark memory usage, the Java versions will be dead.)</p>
</div>
</li>
<li id="comment-55519" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-25T10:29:38+00:00">July 25, 2012 at 10:29 am</time></a> </div>
<div class="comment-content">
<p>@Keck</p>
<p>And the paper you link to makes my point in a different way:</p>
<p><em>We find that in regards to performance, C++ wins out by a large margin. However, it also required the most extensive tuning efforts, many of which were done at a level of sophistication that would not be available to the average programmer.</em></p>
<p>Compare with what I wrote:</p>
<p><em>Conclusion: If your sole reason for using C++ is speed, and you lack the budget for intensive optimization, you might be misguided.<br/>
</em></p>
<p>That is, I am saying the same thing.</p>
<p>If you have a limitless budget, C++ can be much faster. No question about it. But people, in real life, don&rsquo;t have limitless budget. So either you improve the algorithm (possibly gaining 10x or 100x), or you hack low-level. In real life, you can&rsquo;t do both.</p>
<p>Sure, people can spend 20 years optimizing the FFT, and that&rsquo;s important, but few people will have the luxury to optimize their code for 20 years.</p>
</div>
</li>
<li id="comment-55520" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/773f90d7d7a3bfea376ba86dd16d27e0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/773f90d7d7a3bfea376ba86dd16d27e0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Keck</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-25T10:34:08+00:00">July 25, 2012 at 10:34 am</time></a> </div>
<div class="comment-content">
<p>@Daniel Lemire</p>
<p>I think somehow we are disconnecting but saying the same thing in some respects. I don&rsquo;t disagree with your overall comments. I disagree with that specific example for a very specific reason.</p>
<p>Now, I do fervently believe in this quote about optimizations:<br/>
1) Don&rsquo;t Optimize<br/>
2) For Experts: Don&rsquo;t Optimize yet.</p>
<p>I&rsquo;m paid to optimize, and I don&rsquo;t want to do it half the time. Sometimes you have to bleed to get minuscule gains. My point is more that &lsquo;if you have to, your options are less limited in C/C++ for getting that extra,&rsquo; and if you&rsquo;re near the wall to begin with, then Java might not be the best choice. Doesn&rsquo;t mean I don&rsquo;t like Java. Doesn&rsquo;t mean they haven&rsquo;t done a lot with the VM. Doesn&rsquo;t mean it&rsquo;s not a great language and can most definitely be the best language for certain tasks &#8211; based on developer strengths.</p>
<p>I believe probably that nearly every java FFT program by an undergrad will be faster than C/C++ version. Especially true, if they are not allowed to use google &#8211; Cooley/Tukey examples are out there that are. &ldquo;okay.&rdquo; And, by okay I really mean bad. Or implementations of radix 2 butterfly FFT for C/C++ that if a parallel algorithm was written in java would likely be a very non-optimal solution.</p>
<p>That aside. I just have a problem with this specific example. Google found their findings to be very much in line with mine as well. I just feel like, yeah, it&rsquo;s good, it&rsquo;s getting closer in some things. C++ is still worth it, in some cases.</p>
</div>
</li>
<li id="comment-55521" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-25T11:04:05+00:00">July 25, 2012 at 11:04 am</time></a> </div>
<div class="comment-content">
<p>@Keck</p>
<p>For the record, I hate Java as a language. I much prefer C++: I love templates. Java is overengineered and too low-level. I only program in Java because it is a lingua franca.</p>
<p>I say this to make it clear that I am not a Java fan boy.</p>
</div>
</li>
<li id="comment-55522" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/773f90d7d7a3bfea376ba86dd16d27e0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/773f90d7d7a3bfea376ba86dd16d27e0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Keck</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-07-25T11:11:03+00:00">July 25, 2012 at 11:11 am</time></a> </div>
<div class="comment-content">
<p>@Daniel Lemire</p>
<p>I agree with it being Lingua Franca. I&rsquo;ll also agree that at times it&rsquo;s tough for me to see the forest for the trees, as I live in a world where I cannot have anything slow, ever. I, like you, have Mathematics and Computer Science degrees &#8211; I just ventured out of Academia after my Masters because a lot of money got thrown at me &#8230; sell out!</p>
<p>I love templates, especially C++11 style, and meta template programming for FFTs is delicious for small sizes. Your compile times are horrendous, but It&rsquo;s definitely been a blessing on a few implementations where I couldn&rsquo;t use any third party things, and I had a very tight timeline.</p>
<p>I&rsquo;m not a Java fan boy, clearly. I&rsquo;m actually a pretty &ldquo;this language works for this,&rdquo; fan boy. I just get paid to use C/C++ as my dominant language &#8211; usually with no choice as some things I can&rsquo;t even use other languages as it&rsquo;s part of the specification. I don&rsquo;t disagree with your findings. It&rsquo;s that particular example, and recent compilers have made a leap on that auto-vectorization. So, at this state in the game, it&rsquo;s back to the VM languages to make similar ones to close that gap. Things that leveraged AVX and double precision FFTs would only make the FFT argument work.</p>
</div>
</li>
<li id="comment-55702" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4bed79082c4decd3f78e48f3313024bf?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4bed79082c4decd3f78e48f3313024bf?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Branimir</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-09-16T19:59:48+00:00">September 16, 2012 at 7:59 pm</time></a> </div>
<div class="comment-content">
<p>Seems that gcc 4.7 , gcc 4.8 and clang 3.1 have bug in optimizer for 64 bit versions, as on my machine they get around 550,<br/>
while gcc 4.6.3 gets around 2000, and<br/>
java around 2200 (seems that java unrolls a bit).<br/>
That is for plain array loop, but<br/>
if vector is used, 64 bit clang cannot optimize, while 32 bit can. None of gcc can optimize vector.<br/>
If loop is written this way:<br/>
static void sum(std::vector&amp; data) {<br/>
if(data.empty()) return;<br/>
for( unsigned i = 0; i != data.size()-1; ++i)<br/>
{<br/>
data[i+1] += data[i];<br/>
}<br/>
}</p>
<p>all gcc can optimize, but insert redundant code at beginning of loop slowing it down to 1600.</p>
<p>I have i5 3570k @ 4Ghz</p>
</div>
</li>
<li id="comment-56367" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bcc7fcad012a2857e009813c72b33062?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bcc7fcad012a2857e009813c72b33062?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Yann</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-03T18:12:54+00:00">October 3, 2012 at 6:12 pm</time></a> </div>
<div class="comment-content">
<p>Hi,</p>
<p>Found the post very interesting: remove all complexities and see what we can conclude from what remains.</p>
<p>So I&rsquo;ve taken the opportunity to see what Julia, an LLVM based language, could achieve. It turns out it runs at 25% the speed of C++ when coding directly, and 70% when adding some types. I didn&rsquo;t try to optimize any further than that.</p>
<p>The code is also much easier to read, and so much faster to write.</p>
<p>Check it out here: </p>
<p><a href="https://sites.google.com/a/hpu4science.org/hpu4science/projects/brownianCoding/integercrunchingwithjulia" rel="nofollow ugc">https://sites.google.com/a/hpu4science.org/hpu4science/projects/brownianCoding/integercrunchingwithjulia</a></p>
<p>Yann</p>
</div>
</li>
<li id="comment-57410" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e369cd1752558625f83fafc41ddbac94?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e369cd1752558625f83fafc41ddbac94?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Vinicius Miranda</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-13T18:09:55+00:00">October 13, 2012 at 6:09 pm</time></a> </div>
<div class="comment-content">
<p>Dear,</p>
<p> First I would like to say that is a very good discussion. Now, may I add 3 important points to your code.</p>
<p> (1) size() is an expensive operation. For example, Scott Meyers says in one of his book that is always a good idea to replace size() by empty() when we just want to check if a vector has size() &gt; 0.</p>
<p> (2) the operator [] in vectors has an implementation that difficult loop vectorization by compiler. According to Georg Hager &#8211; Introduction to HPC for scientists, we should always use iterators (which is = C pointer in case of vectors) in loops to allow better loop vectorization by compiler.</p>
<p> third: loops with this kind of dependence (that i depends on i-1 ) has a huge performance penalty according to Georg Hager, because compile cannot doop loop unrolling and vectorization.</p>
<p> Using this 3 ideas, why dont you try use iterator (stl always use iterator ) and a temporary. Example</p>
<p> double temp(0.0);</p>
<p> for( std::vector::iterator ia = data.begin(); ia != data.end(); ++ia)<br/>
{<br/>
temp += (*ia)<br/>
}</p>
<p>or something analogous.</p>
<p>Best<br/>
vinicius</p>
</div>
</li>
<li id="comment-58108" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d61e1cb727caa342913a6bb936b0f372?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d61e1cb727caa342913a6bb936b0f372?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilma</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-25T10:56:53+00:00">October 25, 2012 at 10:56 am</time></a> </div>
<div class="comment-content">
<p>Surfing around stumbleupon.com I noticed your site book-marked as: Is C++ worth it?. Now i&rsquo;m assuming you book marked it yourself and wanted to ask if social bookmarking gets you a good deal of targeted visitors? I&rsquo;ve been thinking about doing some bookmarking for a few of my websites but wasn&rsquo;t certain if it would produce any positive results. Appreciate it.</p>
</div>
</li>
<li id="comment-58110" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-25T11:03:15+00:00">October 25, 2012 at 11:03 am</time></a> </div>
<div class="comment-content">
<p>@Wilma</p>
<p>I do not &ldquo;bookmark&rdquo; my own blog posts though I do share them through my Twitter and Google+ accounts.</p>
<p>I don&rsquo;t think there is much point trying to spread your content through several systems. It is best to focus on writing good content.</p>
</div>
</li>
<li id="comment-58447" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/efe3dcebff1c01cdbb1d8ce459f23343?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/efe3dcebff1c01cdbb1d8ce459f23343?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.edwardbeckett.com" class="url" rel="ugc external nofollow">Edward Beckett</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-31T00:11:48+00:00">October 31, 2012 at 12:11 am</time></a> </div>
<div class="comment-content">
<p>I love Java &#8230; But if you want to see C++ smoke java&rsquo;s ass try compiling the same code with Intel Compiler </p>
<p><a href="http://software.intel.com/en-us/intel-parallel-studio-xe/" rel="nofollow ugc">http://software.intel.com/en-us/intel-parallel-studio-xe/</a></p>
</div>
</li>
<li id="comment-58478" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-31T08:23:31+00:00">October 31, 2012 at 8:23 am</time></a> </div>
<div class="comment-content">
<p>@Edward</p>
<p>Do you have any benchmark results with the Intel compiler?</p>
</div>
</li>
<li id="comment-58480" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-31T08:34:11+00:00">October 31, 2012 at 8:34 am</time></a> </div>
<div class="comment-content">
<p>@Daniel,</p>
<p>In my experience it&rsquo;s 10-20% better. I would not call it exactly ass burning.</p>
</div>
</li>
<li id="comment-58484" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4bed79082c4decd3f78e48f3313024bf?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4bed79082c4decd3f78e48f3313024bf?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Branimir</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-31T09:05:17+00:00">October 31, 2012 at 9:05 am</time></a> </div>
<div class="comment-content">
<p>Intel fortran is pretty good but intel c++ is not better than g++ 4.7.<br/>
I have tried some benchmarks from language benchmarks site and found<br/>
that intel is slower on average than gcc.<br/>
Perhaps intel is optimized for special<br/>
cases but in general case I found it<br/>
slower.<br/>
In this particular case for example:<br/>
static void sum(std::vector&amp; data)<br/>
{<br/>
if(data.empty()) return;<br/>
for( unsigned i = 0; i != data.size()-1; ++i)<br/>
{<br/>
data[i+1] += data[i];<br/>
}<br/>
}</p>
<p>bmaxa@maxa:~/examples$ icc -fast Cumul.cpp -o Cumul<br/>
bmaxa@maxa:~/examples$ ./Cumul<br/>
last 262486571 time 534.530682061<br/>
last 262486571 time 526.421073688<br/>
last 262486571 time 527.175918604<br/>
last 262486571 time 534.159500027<br/>
last 262486571 time 533.942739981<br/>
last 262486571 time 531.575590049<br/>
last 262486571 time 534.456404391<br/>
last 262486571 time 533.122927485<br/>
last 262486571 time 534.222279206<br/>
last 262486571 time 535.011128231<br/>
bmaxa@maxa:~/examples$ g++ -O3 Cumul.cpp -o Cumul<br/>
bmaxa@maxa:~/examples$ ./Cumul<br/>
last 262486571 time 1600.051201638<br/>
last 262486571 time 1523.600572874<br/>
last 262486571 time 1561.377759735<br/>
last 262486571 time 1568.479829349<br/>
last 262486571 time 1525.413387028<br/>
last 262486571 time 1579.080343608<br/>
last 262486571 time 1590.684948939<br/>
last 262486571 time 1592.305977517<br/>
last 262486571 time 1587.856076725<br/>
last 262486571 time 1578.880889226</p>
<p>bmaxa@maxa:~/examples$ java Cumul<br/>
last 262486571 time 2083.3333333333335<br/>
last 262486571 time 2272.7272727272725<br/>
last 262486571 time 2272.7272727272725<br/>
last 262486571 time 2272.7272727272725<br/>
last 262486571 time 2272.7272727272725<br/>
last 262486571 time 2272.7272727272725<br/>
last 262486571 time 2173.913043478261<br/>
last 262486571 time 2272.7272727272725<br/>
last 262486571 time 2173.913043478261<br/>
last 262486571 time 2173.913043478261</p>
<p>Java blows out of the water both icc and g++&#8230;</p>
</div>
</li>
<li id="comment-58503" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/efe3dcebff1c01cdbb1d8ce459f23343?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/efe3dcebff1c01cdbb1d8ce459f23343?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.edwardbeckett.com" class="url" rel="ugc external nofollow">Edward Beckett</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-31T11:43:44+00:00">October 31, 2012 at 11:43 am</time></a> </div>
<div class="comment-content">
<p>@Daniel &#8230; Personally I do not. However, I must admit, I am by no means an expert in the field of compiler optimization. </p>
<p>However, there is an extremely good post on the subject of branch determination that provides some insight into how the ICC compiler optimizes code. (See user mysticals answer @ <a href="http://stackoverflow.com/questions/11227809/why-is-processing-a-sorted-array-faster-than-an-unsorted-array" rel="nofollow ugc">http://stackoverflow.com/questions/11227809/why-is-processing-a-sorted-array-faster-than-an-unsorted-array</a>) </p>
<p>I&rsquo;d love to hear your opinion on the subject post as well as apparently there are specific use cases where the ICC compiler is par or slower than GCC as @Branimar has shown &#8230;</p>
</div>
</li>
<li id="comment-58505" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/efe3dcebff1c01cdbb1d8ce459f23343?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/efe3dcebff1c01cdbb1d8ce459f23343?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.edwardbeckett.com" class="url" rel="ugc external nofollow">Edward Beckett</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-31T11:54:30+00:00">October 31, 2012 at 11:54 am</time></a> </div>
<div class="comment-content">
<p>@itman &#8230; I admit, using &lsquo;smokes java&rsquo;s ass&rsquo; is a poor choice of words. Nevertheless, If we were in a ten-mile marathon a ten percent win would probably qualify for the being &lsquo;smoked&rsquo; 😉</p>
</div>
</li>
<li id="comment-58514" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-31T12:51:22+00:00">October 31, 2012 at 12:51 pm</time></a> </div>
<div class="comment-content">
<p>In a marathon yes. But if you are in a triathlon, being 10% faster in running does not automatically brings you a victory.</p>
</div>
</li>
<li id="comment-58519" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/efe3dcebff1c01cdbb1d8ce459f23343?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/efe3dcebff1c01cdbb1d8ce459f23343?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.edwardbeckett.com" class="url" rel="ugc external nofollow">Edward Beckett</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-31T13:51:15+00:00">October 31, 2012 at 1:51 pm</time></a> </div>
<div class="comment-content">
<p>@Itman &#8230; True &#8211; there&rsquo;s a lot of different use cases to consider. I.E. The function of the application as in systems requiring zero-tolerance(air-traffic control, or emergency services, etc.) vs a generic user-space desktop app &#8230;</p>
</div>
</li>
<li id="comment-64199" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b149d11236b8a0484ad0f25f2b0e2321?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b149d11236b8a0484ad0f25f2b0e2321?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Oleg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-05T13:38:00+00:00">January 5, 2013 at 1:38 pm</time></a> </div>
<div class="comment-content">
<p>try this one (I got best time with it):<br/>
void pointerStraightsum(short * data, size_t size)<br/>
{<br/>
if(size == 0) return;<br/>
const short*const end = data + size;<br/>
short* it = data;<br/>
short s = *it++;</p>
<p> const short*const end8 = data + ( (size-1) / 8 ) * 8;<br/>
while ( end8 &gt; it )<br/>
{<br/>
s += *it;<br/>
*it++ = s;<br/>
s += *it;<br/>
*it++ = s;<br/>
s += *it;<br/>
*it++ = s;<br/>
s += *it;<br/>
*it++ = s;<br/>
s += *it;<br/>
*it++ = s;<br/>
s += *it;<br/>
*it++ = s;<br/>
s += *it;<br/>
*it++ = s;<br/>
s += *it;<br/>
*it++ = s;<br/>
}<br/>
while ( end != it )<br/>
{<br/>
s += *it;<br/>
*it++ = s;<br/>
}<br/>
}</p>
</div>
</li>
<li id="comment-64207" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b149d11236b8a0484ad0f25f2b0e2321?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b149d11236b8a0484ad0f25f2b0e2321?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Oleg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-05T14:10:40+00:00">January 5, 2013 at 2:10 pm</time></a> </div>
<div class="comment-content">
<p>#include<br/>
/**<br/>
* Fast computations of cumulative sums.<br/>
* D. Lemire, July 2012<br/>
*<br/>
* Best results with:<br/>
*</p>
<p>$ g++-4.7 -funroll-loops -O3 -o cumulsum cumulsum.cpp</p>
<p>$ ./unrolldeltas</p>
<p>but we want to avoid the -funroll-loops flag.<br/>
*/</p>
<p>// This may require GCC 4.4/</p>
<p>#include<br/>
#include<br/>
#include<br/>
#include<br/>
#include<br/>
#include<br/>
#include<br/>
#include </p>
<p>using namespace std;</p>
<p>class WallClockTimer {<br/>
public:<br/>
clock_t start;<br/>
WallClockTimer()<br/>
{<br/>
}<br/>
void reset()<br/>
{<br/>
start = clock();<br/>
}<br/>
int elapsed()<br/>
{<br/>
return (clock() &#8211; start);<br/>
}<br/>
int split()<br/>
{<br/>
return elapsed();<br/>
}<br/>
};</p>
<p>short* givemeanarray_simple(size_t N) {<br/>
short* bigarray;<br/>
bigarray=new short[N];<br/>
for(unsigned int k=0;k&lt;N;k++)<br/>
bigarray[k]=(k+k/3);<br/>
return bigarray;<br/>
}</p>
<p>vector givemeanarray(size_t N) {<br/>
vector bigarray;<br/>
bigarray.reserve(N);<br/>
for(unsigned int k = 0; k it )<br/>
{<br/>
s += *it;<br/>
*it++ = s;<br/>
s += *it;<br/>
*it++ = s;<br/>
s += *it;<br/>
*it++ = s;<br/>
s += *it;<br/>
*it++ = s;<br/>
s += *it;<br/>
*it++ = s;<br/>
s += *it;<br/>
*it++ = s;<br/>
s += *it;<br/>
*it++ = s;<br/>
s += *it;<br/>
*it++ = s;<br/>
}<br/>
while ( end != it )<br/>
{<br/>
s += *it;<br/>
*it++ = s;<br/>
}<br/>
}</p>
<p>void straightsum(short * data, size_t size) {<br/>
if(size == 0) return;<br/>
for (size_t i = 1; i != size; ++i) {<br/>
data[i] += data[i &#8211; 1] ;<br/>
}<br/>
}</p>
<p>void slowishSum(vector &amp; data) {<br/>
if(data.size() == 0) return;<br/>
for (size_t i = 1; i != data.size(); ++i) {<br/>
data[i] += data[i &#8211; 1] ;<br/>
}<br/>
}</p>
<p>// By Vasily Volkov, improved by Daniel Lemire<br/>
void fastSum(vector &amp; data) {<br/>
if(data.size() == 0) return;</p>
<p> const size_t UnrollQty = 4;<br/>
size_t sz0 = (data.size() / UnrollQty) * UnrollQty; // equal to 0, if data.size() =UnrollQty) {<br/>
short a = data[0];<br/>
for (; i &lt; sz0 &#8211; UnrollQty ; i += UnrollQty) {<br/>
a = (data[i] += a);<br/>
a = (data[i + 1] += a);<br/>
a = (data[i + 2] += a);<br/>
a = (data[i + 3] += a);<br/>
}<br/>
}<br/>
for (; i != data.size(); ++i) {<br/>
data[i] += data[i- 1] ;<br/>
}<br/>
}</p>
<p>// loop unrolling helps avoid the need for -funroll-loops<br/>
void sum(vector &amp; data) {<br/>
if(data.size() == 0) return;<br/>
size_t i = 1;<br/>
for (; i &lt; data.size() &#8211; 1; i+=2) {<br/>
data[i] += data[i &#8211; 1];<br/>
data[i+1] += data[i ];<br/>
}<br/>
for (; i != data.size(); ++i) {<br/>
data[i] += data[i &#8211; 1];<br/>
}<br/>
}</p>
<p>void test(size_t N, const int experiments ) {<br/>
WallClockTimer time;<br/>
vector data = givemeanarray(N) ;<br/>
vector copydata(data);</p>
<p> time.reset();<br/>
for (int i = 0; i &lt; experiments; ++i)<br/>
stdPartialSum(&amp;data[0],N);<br/>
cout&lt;&lt;&quot;std::partial_sum &quot;&lt;&lt; N * experiments / (1000.0*time.split()) &lt;&lt;endl;</p>
<p> time.reset();<br/>
for (int i = 0; i &lt; experiments; ++i)<br/>
pointerStraightsum(&amp;data[0],N);<br/>
cout&lt;&lt;&quot;pointer straight sum (C-like) with pointers &quot;&lt;&lt; N * experiments / (1000.0*time.split()) &lt;&lt;endl;</p>
<p> time.reset();<br/>
for (int i = 0; i &lt; experiments; ++i)<br/>
slowishSum(data);<br/>
cout&lt;&lt;&quot;basic sum (C++-like) &quot;&lt;&lt; N * experiments / (1000.0*time.split()) &lt;&lt;endl;</p>
<p> data = copydata;</p>
<p> time.reset();<br/>
for (int i = 0; i &lt; experiments; ++i)<br/>
sum(data);<br/>
cout&lt;&lt;&quot;smarter sum &quot;&lt;&lt; N * experiments / (1000.0*time.split()) &lt;&lt;endl;</p>
<p> data = copydata;</p>
<p> time.reset();<br/>
for (int i = 0; i &lt; experiments; ++i)<br/>
fastSum(data);<br/>
cout&lt;&lt;&quot;fast sum &quot;&lt;&lt; N * experiments / (1000.0*time.split()) &lt;&lt;endl;<br/>
}</p>
<p>int main(int argc, char *argv[])<br/>
{<br/>
QCoreApplication a(argc, argv);<br/>
cout &lt;&lt; &quot;reporting speed in million of integers per second &quot;&lt;&lt;endl;<br/>
size_t N = 50 * 1000 * 100 ;<br/>
const int experiments = 100;<br/>
test(N, experiments);<br/>
return a.exec();<br/>
}</p>
</div>
</li>
<li id="comment-64209" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b149d11236b8a0484ad0f25f2b0e2321?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b149d11236b8a0484ad0f25f2b0e2321?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Oleg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-05T14:11:17+00:00">January 5, 2013 at 2:11 pm</time></a> </div>
<div class="comment-content">
<p>/*<br/>
* To change this template, choose Tools | Templates<br/>
* and open the template in the editor.<br/>
*/<br/>
package cumulativesum;</p>
<p>/**<br/>
*<br/>
* @author Oleg<br/>
*/<br/>
public class CumulativeSum {</p>
<p>public static void sum(int[] data) {<br/>
if(data.length == 0) return;<br/>
for( int i = 1; i != data.length; ++i)<br/>
data[i] += data[i-1];<br/>
}</p>
<p> public static int[] givemeanarray(int N) {<br/>
int[] bigarray = new int[N];<br/>
for(int k = 0; k&lt;N; ++k)<br/>
bigarray[k] = k+k/3;<br/>
return bigarray;<br/>
}</p>
<p> public static void test(int N, int experiments) {<br/>
int[] data = givemeanarray(N);<br/>
long bef = System.currentTimeMillis();<br/>
for (int i = 0; i &lt; experiments; ++i)<br/>
sum(data);<br/>
long aft = System.currentTimeMillis();<br/>
System.out.println( N * experiments / ( 1000.0 * (aft-bef) ) );<br/>
}</p>
<p> public static void main(String[] args) {<br/>
final int experiments = 100;<br/>
test( 50 * 1000 * 100, experiments );<br/>
}<br/>
}</p>
</div>
</li>
<li id="comment-64210" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b149d11236b8a0484ad0f25f2b0e2321?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b149d11236b8a0484ad0f25f2b0e2321?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Oleg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-05T14:16:24+00:00">January 5, 2013 at 2:16 pm</time></a> </div>
<div class="comment-content">
<p>In last 2 comments a little bit changed you code. ( N 10 times less but 100 experiments and counting average perfomance).</p>
<p>I tested c++ code with MinGw 4.4</p>
<p>Java result = 411.<br/>
C++ results:<br/>
1779<br/>
2475<br/>
410<br/>
781<br/>
2008</p>
</div>
</li>
<li id="comment-64228" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b149d11236b8a0484ad0f25f2b0e2321?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b149d11236b8a0484ad0f25f2b0e2321?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Oleg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-05T17:48:20+00:00">January 5, 2013 at 5:48 pm</time></a> </div>
<div class="comment-content">
<p>faster sum in java:<br/>
public static void sum(int[] data) {<br/>
if(data.length == 0) return;<br/>
int s = data[0];<br/>
for( int i = 0, end = data.length-1; i != end; )<br/>
{<br/>
s = (data[++i] += s);<br/>
}<br/>
}</p>
</div>
</li>
<li id="comment-64230" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b149d11236b8a0484ad0f25f2b0e2321?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b149d11236b8a0484ad0f25f2b0e2321?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Oleg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-05T17:51:13+00:00">January 5, 2013 at 5:51 pm</time></a> </div>
<div class="comment-content">
<p>faster c++ sum:<br/>
void pointerUnrolledSum(NUM * data, size_t size)<br/>
{<br/>
if(size == 0) return;<br/>
const NUM*const end = data + size-1;<br/>
NUM* it = data;<br/>
NUM s = *it;</p>
<p> const NUM*const end8 = data + ( (size-1) / 8 ) * 8;<br/>
while ( end8 &gt; it )<br/>
{<br/>
s = (*(++it) += s);<br/>
s = (*(++it) += s);<br/>
s = (*(++it) += s);<br/>
s = (*(++it) += s);<br/>
s = (*(++it) += s);<br/>
s = (*(++it) += s);<br/>
s = (*(++it) += s);<br/>
s = (*(++it) += s);<br/>
}<br/>
while ( end != it )<br/>
{<br/>
s = (*(++it) += s);<br/>
}<br/>
}</p>
</div>
</li>
<li id="comment-64197" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anonymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-05T13:34:25+00:00">January 5, 2013 at 1:34 pm</time></a> </div>
<div class="comment-content">
<p>try this one:</p>
<p>void pointerStraightsum(short * data, size_t size)<br/>
{<br/>
if(size == 0) return;<br/>
const short*const end = data + size;<br/>
short* it = data;<br/>
short s = *it++;</p>
<p> const short*const end8 = data + ( (size-1) / 8 ) * 8;<br/>
while ( end8 &gt; it )<br/>
{<br/>
s += *it;<br/>
*it++ = s;<br/>
s += *it;<br/>
*it++ = s;<br/>
s += *it;<br/>
*it++ = s;<br/>
s += *it;<br/>
*it++ = s;<br/>
s += *it;<br/>
*it++ = s;<br/>
s += *it;<br/>
*it++ = s;<br/>
s += *it;<br/>
*it++ = s;<br/>
s += *it;<br/>
*it++ = s;<br/>
}<br/>
while ( end != it )<br/>
{<br/>
s += *it;<br/>
*it++ = s;<br/>
}<br/>
}</p>
</div>
</li>
<li id="comment-64342" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Professor</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-07T03:21:15+00:00">January 7, 2013 at 3:21 am</time></a> </div>
<div class="comment-content">
<p>(1785-2000)/1785 gives approx 12% improved performance</p>
</div>
</li>
<li id="comment-64435" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/330ab31805135fcc4005226974035bf3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/330ab31805135fcc4005226974035bf3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dmitry Chichkov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-07T14:47:06+00:00">January 7, 2013 at 2:47 pm</time></a> </div>
<div class="comment-content">
<p>Straighter/faster C sum:</p>
<p>void straightersum(int * data, size_t size) {<br/>
if(size == 0) return;<br/>
int *end = data + size;<br/>
int *prev = data;<br/>
for(int *p = data + 1 ; p &lt; end; p++)<br/>
{<br/>
*p += *prev;<br/>
prev = p;<br/>
}<br/>
}</p>
</div>
</li>
<li id="comment-66092" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2be67c478bd88613dfecad541b287ddd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2be67c478bd88613dfecad541b287ddd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Abdurrahim</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-18T04:11:38+00:00">January 18, 2013 at 4:11 am</time></a> </div>
<div class="comment-content">
<p>C++ way of doing this is should be like this (couse you don&rsquo;t modify size of data right?):<br/>
for (size_t i = 1, end=data.size(); i != end; ++i)<br/>
{<br/>
data[i] += data[i &#8211; 1] ;<br/>
}<br/>
and even more :<br/>
######################################<br/>
#include<br/>
#include<br/>
#include </p>
<p>using namespace std;</p>
<p>int main()<br/>
{<br/>
DWORD Last, Now;</p>
<p> volatile int * volatile data = new volatile int volatile [100000000];<br/>
ZeroMemory((void*)data, 100000000);</p>
<p> Last = GetTickCount();</p>
<p> for(int n = 0; n != 500000000; ++n)<br/>
{<br/>
for(volatile int *i = data + 1, *old = data, *end = data + sizeof(data) / sizeof(data[1]);<br/>
i != end; ++i, ++old)<br/>
{<br/>
*i = *old + 100;<br/>
}<br/>
}</p>
<p> Now = GetTickCount();</p>
<p> delete data;</p>
<p> std::cout &lt;&lt; &quot;Milliseconds passed = &quot; &lt;&lt; Now &#8211; Last &lt;&lt; std::endl;</p>
<p> return 0;<br/>
}<br/>
in vs2008 gave me : 422 milliseconds.</p>
<p>#######<br/>
and java here:<br/>
################<br/>
/*<br/>
* To change this template, choose Tools | Templates<br/>
* and open the template in the editor.<br/>
*/<br/>
package javaapplication1;</p>
<p>import java.util.Date;</p>
<p>/**<br/>
*<br/>
* @author Abdurrahim<br/>
*/<br/>
public class JavaApplication1 {</p>
<p> /**<br/>
* @param args the command line arguments<br/>
*/<br/>
public static void main(String[] args) {<br/>
// TODO code application logic here</p>
<p> int[] data = new int[100000000];</p>
<p> long Last = System.currentTimeMillis();</p>
<p> for(int n = 0; n != 500000000; ++n)<br/>
{<br/>
for (int i = 1; i != data.length; ++i) {<br/>
data[i] += data[i &#8211; 1];<br/>
}<br/>
}</p>
<p> long Now = System.currentTimeMillis();</p>
<p> System.out.println(String.format(&quot;Milliseconds passed = %d&quot;,<br/>
Now &#8211; Last));<br/>
}<br/>
}<br/>
####<br/>
Still runs :)!</p>
<p>if i give n 50000 and sizeof data 20000 java gave me 502 ms run.<br/>
Now i ask you &#039;is-cc-worth-it&#039; ?</p>
</div>
</li>
<li id="comment-66171" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dominic Amann</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-18T11:10:43+00:00">January 18, 2013 at 11:10 am</time></a> </div>
<div class="comment-content">
<p>You are all comparing trivial operations that can easily be optimized by either c++ or java.</p>
<p>Doing real world work that involves serious math and memory allocations on the stack and the heap would be a much more useful test, such as an FFT operation on a 2d array of amplitude data.</p>
</div>
</li>
<li id="comment-66193" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dominic Amann</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-18T12:23:32+00:00">January 18, 2013 at 12:23 pm</time></a> </div>
<div class="comment-content">
<p>I know it was discussed &#8211; I was just responding to the latest post. I also mentioned memory allocation as a vital factor in comparing the languages.</p>
<p>Plus no-one has shown me that some Java library is actually not just a wrapper for an underlying c library. Here I am just asking.</p>
</div>
</li>
<li id="comment-66176" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-18T11:31:55+00:00">January 18, 2013 at 11:31 am</time></a> </div>
<div class="comment-content">
<p>@Dominic Amann</p>
<p>Please read the thread of comments, we do discuss the FFT specifically.</p>
</div>
</li>
<li id="comment-66222" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Itman</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-18T16:58:09+00:00">January 18, 2013 at 4:58 pm</time></a> </div>
<div class="comment-content">
<p>@Abdurrahim, there is apparently a bug in your code. Try print:</p>
<p>sizeof(data) / sizeof(data[1])</p>
<p>You code would have been even faster if you had a 32-bit CPU :-))</p>
<p>This is why a language like Java is so much better than C++! It is harder to shoot yourself in the foot.</p>
</div>
</li>
<li id="comment-66375" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2be67c478bd88613dfecad541b287ddd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2be67c478bd88613dfecad541b287ddd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Abdurrahim</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-19T17:43:25+00:00">January 19, 2013 at 5:43 pm</time></a> </div>
<div class="comment-content">
<p>@Itman<br/>
You are right! &lsquo;shoot yourself in the foot&rsquo;.. yes i agree. I use java too but when i came performance issue java is not much good choice. I can say in c++, only adding &lsquo;#pragma omp &#8230;&rsquo; can make your loop multi-threaded and this is only one thing about performance&#8230; Anyway c++ is a minefield and i hate it this point.<br/>
One more thing :<br/>
&lsquo;Most C++ programmers would implement it as follows:&rsquo;<br/>
memmove (data, data+1, size &#8211; 1);<br/>
Thanks.</p>
</div>
</li>
<li id="comment-66480" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d3b1a158e65d313915cc48623049193e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d3b1a158e65d313915cc48623049193e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://users.livejournal.com/_winnie/" class="url" rel="ugc external nofollow">Ivan Dobrokotov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-20T07:14:10+00:00">January 20, 2013 at 7:14 am</time></a> </div>
<div class="comment-content">
<p>Run every function 150 times, parsed output of measurement, got following plot: <a href="http://dobrokot.ru/pics/i2013-01-20__16-15-15_53kb.png" rel="nofollow ugc">http://dobrokot.ru/pics/i2013-01-20__16-15-15_53kb.png</a></p>
<p>As you can see, there is strange clustering of times.</p>
<p>Second strange thing: &ldquo;basic sum (C++)&rdquo; has the same performance as smartest hand-unrolled implementations. g++ 4.3.4 is used.</p>
<p>Plot code: <a href="https://gist.github.com/4578192" rel="nofollow ugc">https://gist.github.com/4578192</a></p>
<p>&#8230;..<br/>
for (int i = 0; i &lt; 10; ++i) {<br/>
cout&lt;&lt;&quot;============&quot;&lt;&lt;endl;<br/>
test(N);<br/>
}<br/>
&#8230;..<br/>
void test(size_t N ) {<br/>
for(int t = 0; t&lt;15;++t) {<br/>
cout&lt;&lt;&quot;:straight sum (C-like) //prefix each by colon &quot;:&quot;<br/>
&#8230;..</p>
</div>
</li>
<li id="comment-66481" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d3b1a158e65d313915cc48623049193e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d3b1a158e65d313915cc48623049193e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://users.livejournal.com/_winnie/" class="url" rel="ugc external nofollow">Ivan Dobrokotov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-20T07:16:03+00:00">January 20, 2013 at 7:16 am</time></a> </div>
<div class="comment-content">
<p>Median is used for estimation (not mean).</p>
</div>
</li>
<li id="comment-66485" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d3b1a158e65d313915cc48623049193e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d3b1a158e65d313915cc48623049193e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://users.livejournal.com/_winnie/" class="url" rel="ugc external nofollow">Ivan Dobrokotov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-20T07:39:20+00:00">January 20, 2013 at 7:39 am</time></a> </div>
<div class="comment-content">
<p>cout&lt;&lt;&quot;X&quot; &lt;&lt; time() &#8211; POSSIBLE MEASUREMENT OF CONSOLE OUTPUT!!!</p>
</div>
</li>
<li id="comment-66607" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b6a8d8d4eab8d90dba5baf69381c6fb8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b6a8d8d4eab8d90dba5baf69381c6fb8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">7</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-21T00:57:50+00:00">January 21, 2013 at 12:57 am</time></a> </div>
<div class="comment-content">
<p>Holy hell, a language war going on for months now, over a narrow scope benchmark that is anything but conclusive. </p>
<p>The Computer Language Benchmarks Game shows a much more conclusive result &#8211; in terms of CPU time Java is anywhere from a tad slower to twice as slow than GCC, which BTW is far from being the most aggressively optimizing compiler. Intel&rsquo;s compiler is about 10-20% faster than GCC, much better loop unrolling, much better vectorization, that is why it is also the slowest C++ compiler in terms of compile time, it does a lot of compile time work to ensure the best possible performance during runtime.</p>
<p>But then again, we have memory efficiency &#8211; where Java is simply awful. It often uses 20-30 times the amount of memory that C++ uses. In a benchmark scenario this might not be an issue, but in actual real world multi process scenario that memory consumption may easily stack up to exceed the capacity of the system and force the machine to swap, which will cause Java performance to plummet, bottlenecked by the dreadfully slow HDD.</p>
<p>So we have a tad better performance, huge memory efficiency advantage and better platform support &#8211; C++ can compile to native binary for almost any processor out there, as for Java &#8211; there are plenty of platforms that Java has no VM and runtime implementations for. Also C++ doesn&rsquo;t enforce OOP, which I happen to like.</p>
<p>So regard the facts and stop this pointless arguing over a pointless benchmark.</p>
</div>
</li>
<li id="comment-66677" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-21T08:32:25+00:00">January 21, 2013 at 8:32 am</time></a> </div>
<div class="comment-content">
<p>@7</p>
<p><em>Holy hell, a language war going on for months now, over a narrow scope benchmark that is anything but conclusive.</p>
<p>The Computer Language Benchmarks Game shows a much more conclusive result â€“ in terms of CPU time Java is anywhere from a tad slower to twice as slow (&#8230;) </em></p>
<p>To be fair to my post, I state that the example is nothing but an anecdote, I even repeat it later (<em>I do not, nor have I ever, based my conclusions on 3 lines of code</em>) and then I link to the Benchmark Game.</p>
</div>
</li>
<li id="comment-66726" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2be67c478bd88613dfecad541b287ddd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2be67c478bd88613dfecad541b287ddd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Abdurrahim</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-21T11:57:02+00:00">January 21, 2013 at 11:57 am</time></a> </div>
<div class="comment-content">
<p>Sorry about one thing: I did not see &lsquo;+&rsquo; sign so i said about using &lsquo;memlame&rsquo;. What a shame 😀 i apologise!</p>
</div>
</li>
<li id="comment-265888" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f3ada405ce890b6f8204094deb12d8a8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f3ada405ce890b6f8204094deb12d8a8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-14T03:40:03+00:00">January 14, 2017 at 3:40 am</time></a> </div>
<div class="comment-content">
<p>If it weren&rsquo;t for manual memory management, C++ would just be another shit Java mock up. Its main point is to solve allot of problems for business apps, unfortunately no one uses it for anything other than OOP.</p>
<p>Java is what you get when you strap a cement tow to a forklift.</p>
<p>C++ is what you get when you strap an old geezer into a rocket car.</p>
<p>.Net is just Pagan shit!</p>
</div>
</li>
<li id="comment-273142" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d3ede374915531b7f07c8bb5836249ac?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d3ede374915531b7f07c8bb5836249ac?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Max</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-25T15:29:17+00:00">February 25, 2017 at 3:29 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m very late to the discussion, but I wrote a c++ version that&rsquo;s twice as fast as anything here so I thought it was worth sharing.</p>
<p>void maxSum(int * data, size_t size) {<br/>
if(size == 0) return;<br/>
int tmp = 0;<br/>
for (size_t i = 0; i != size; ++i) {<br/>
tmp += data[i] ;<br/>
}<br/>
data[size-1] = tmp;<br/>
}</p>
<p>Your compiler just can&rsquo;t vectorize your loops if you&rsquo;re changing the value you&rsquo;re going to access on the next iteration. G++ seems to have a much easier time figuring what&rsquo;s you&rsquo;re trying to do if you&rsquo;re storing the sum outside the loop.</p>
<p>with -O3 -funroll-loops, I get about 3500 millions operations per second versus about 1700 for the c-ish version.</p>
</div>
<ol class="children">
<li id="comment-273143" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-25T15:33:41+00:00">February 25, 2017 at 3:33 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t think your code solves the same problem.</p>
</div>
</li>
</ol>
</li>
</ol>
