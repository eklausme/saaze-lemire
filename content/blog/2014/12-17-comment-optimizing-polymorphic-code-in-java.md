---
date: "2014-12-17 12:00:00"
title: "Optimizing polymorphic code in Java"
index: false
---

[23 thoughts on &ldquo;Optimizing polymorphic code in Java&rdquo;](/lemire/blog/2014/12-17-optimizing-polymorphic-code-in-java)

<ol class="comment-list">
<li id="comment-142680" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f8a7ccb41af2422d10599464b96cf034?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f8a7ccb41af2422d10599464b96cf034?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Franklin Chen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-12-17T16:17:07+00:00">December 17, 2014 at 4:17 pm</time></a> </div>
<div class="comment-content">
<p>I wonder if Java will get annotated miniboxing or specialization as currently available for Scala for efficiency of generic code: <a href="http://scala-miniboxing.org/" rel="nofollow ugc">http://scala-miniboxing.org/</a></p>
</div>
</li>
<li id="comment-142668" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/26e0963e76bf85cb06c8c2fbce2f06df?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/26e0963e76bf85cb06c8c2fbce2f06df?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://news.kynosarges.org" class="url" rel="ugc external nofollow">Chris Nahr</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-12-17T13:05:09+00:00">December 17, 2014 at 1:05 pm</time></a> </div>
<div class="comment-content">
<p>Did you check the generated machine code? I suspect these methods are in fact inlined, but another stage of optimization is missing: special-casing arrays to eliminate bounds checking on every element access. That&rsquo;s what you get when you write those manually inlined loops over back.length.</p>
</div>
</li>
<li id="comment-142670" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c251f356ee80573008335447f3bec220?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c251f356ee80573008335447f3bec220?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dmitry Platonoff</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-12-17T13:35:30+00:00">December 17, 2014 at 1:35 pm</time></a> </div>
<div class="comment-content">
<p>I realize this point is not directly relevant to your topic of optimizing polymorphism, but optimization is always a sum of several efforts. For example, changing the loops in your BasicSummer to </p>
<p>for(int k = array.size() &#8211; 1; k &gt;= 0; k&#8211;)</p>
<p>cuts execution time by almost 40%. People seriously underestimate reverse loops and the savings they offer.</p>
</div>
</li>
<li id="comment-142671" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-12-17T13:49:21+00:00">December 17, 2014 at 1:49 pm</time></a> </div>
<div class="comment-content">
<p>@Chris</p>
<p>That is a distinct possibility.</p>
<p>Of course, there can be different ways to &ldquo;inline&rdquo; code in Java&#8230; but I had this in mind when I qualified &ldquo;inline&rdquo; with &ldquo;fully&rdquo;. </p>
<p>I am not exactly sure how to access the machine code in java since it is JIT compiling&#8230; and javac will not, as far as I can tell, inline functions.</p>
</div>
</li>
<li id="comment-142682" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-12-17T16:23:26+00:00">December 17, 2014 at 4:23 pm</time></a> </div>
<div class="comment-content">
<p>@Franklin</p>
<p>Thanks for pointing out miniboxing to me.</p>
</div>
</li>
<li id="comment-142691" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">BB</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-12-17T18:01:43+00:00">December 17, 2014 at 6:01 pm</time></a> </div>
<div class="comment-content">
<p>In Java people can play tricks with the class loader and reflexion, the runtime cannot make sure that other implementations of Array don&rsquo;t exist.<br/>
As one more Array impl may be loaded later on without its class name being part of the code, the VM is unable to optimize the code.</p>
<p>In this situation you could use a bytecode optimization library like Soot. Here as your object has a single effectively final member, it can be completely optimized away into static calls with that one object as one extra parameter.</p>
</div>
</li>
<li id="comment-142716" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-12-18T00:13:03+00:00">December 18, 2014 at 12:13 am</time></a> </div>
<div class="comment-content">
<p>@BB</p>
<p>Given the example of this blog post, can you share with us how you would optimize it using Soot?</p>
</div>
</li>
<li id="comment-142746" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-12-18T04:50:15+00:00">December 18, 2014 at 4:50 am</time></a> </div>
<div class="comment-content">
<p>@Dmitry Platonoff great observation, we get 1.5x reduction for BasicSummer and 1.2x reduction for FastSummer (Java8, core i7).</p>
<p>Do you have any idea why there is a much larger difference for BasicSummer?</p>
<p>@Lemire This is what I hate in Java and some other languages. It is all great until you have to create atrocities like parallel arrays.</p>
</div>
</li>
<li id="comment-142780" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-12-18T10:50:18+00:00">December 18, 2014 at 10:50 am</time></a> </div>
<div class="comment-content">
<p>@Leonid</p>
<p>It is indeed quite surprising that simply looping in reverse, you can go 40% faster with BasicSummer. This makes little sense as very little of the computational burden has to do with the loop itself in this case.</p>
<p>In C, reverse loops are not typically faster, they may even be slower at times. So I am not even sure why reverse loops are faster in Java.</p>
</div>
</li>
<li id="comment-142781" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/26e0963e76bf85cb06c8c2fbce2f06df?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/26e0963e76bf85cb06c8c2fbce2f06df?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://news.kynosarges.org" class="url" rel="ugc external nofollow">Chris Nahr</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-12-18T10:57:04+00:00">December 18, 2014 at 10:57 am</time></a> </div>
<div class="comment-content">
<p>Reverse loops only need to evaluate the method call once, for the starting index. The ending index must be evaluated for every cycle unless the optimizer can prove that the returned value won&rsquo;t change. I&rsquo;m guessing this is the cause.</p>
<p>That&rsquo;s another built-in optimization for arrays, by the way, so there should be no difference when looping over array.length.</p>
</div>
</li>
<li id="comment-142783" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c251f356ee80573008335447f3bec220?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c251f356ee80573008335447f3bec220?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dmitry Platonoff</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-12-18T11:02:49+00:00">December 18, 2014 at 11:02 am</time></a> </div>
<div class="comment-content">
<p>The gain with reverse loops is pretty trivial, it helps you eliminate an extra method call per iteration. As you demonstrated in the original post, function calls add a lot of overhead, and it really adds up. It&rsquo;s common not to think twice about adding that size() or length() call in the middle of the &ldquo;for&rdquo; statement. In our example, removing it halves the number of method invocations per loop.</p>
</div>
</li>
<li id="comment-142784" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-12-18T11:06:02+00:00">December 18, 2014 at 11:06 am</time></a> </div>
<div class="comment-content">
<p>@Chris</p>
<p>Good point, but we do see a 20% gain with reverse loops on straight arrays.</p>
<p>That is, this is faster:</p>
<p><a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2014/12/17/ReverseFastSummer.java#L8-L15" rel="nofollow ugc">https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2014/12/17/ReverseFastSummer.java#L8-L15</a></p>
<p>than this&#8230;</p>
<p><a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2014/12/17/FastSummer.java#L8-L15" rel="nofollow ugc">https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2014/12/17/FastSummer.java#L8-L15</a></p>
<p>I realize that at the assembly level, a reverse loop can save an instruction sometimes, by checking the overflow bit (or something of the sort), but recent Intel processors can go just as fast when iterating forward&#8230;</p>
<p>I find this very mysterious.</p>
</div>
</li>
<li id="comment-142785" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-12-18T11:08:43+00:00">December 18, 2014 at 11:08 am</time></a> </div>
<div class="comment-content">
<p>@Dmitry</p>
<p>I understand how saving function calls can help, but it does not explain why reverse loops on straight arrays are significantly faster.</p>
</div>
</li>
<li id="comment-142787" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-12-18T11:10:38+00:00">December 18, 2014 at 11:10 am</time></a> </div>
<div class="comment-content">
<p>@Daniel, perhaps, comparing against zero is faster or it might be related to branch misprediction.</p>
</div>
</li>
<li id="comment-142788" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c251f356ee80573008335447f3bec220?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c251f356ee80573008335447f3bec220?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dmitry Platonoff</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-12-18T11:16:22+00:00">December 18, 2014 at 11:16 am</time></a> </div>
<div class="comment-content">
<p>@Daniel Sorry, I was replying to Leonid. Should&rsquo;ve refreshed the page before posting as Chris chimed in already&#8230;</p>
<p>Oddly enough, I had also not observed any gains with reverse loops on straight arrays. They were in fact a little bit slower on my PC (Java 1.8.0_25-b18, Win8.1, AMD FX 8-core CPU).</p>
</div>
</li>
<li id="comment-142790" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-12-18T11:33:17+00:00">December 18, 2014 at 11:33 am</time></a> </div>
<div class="comment-content">
<p>@Dmitry </p>
<p>Can you post your results using the latest version of the code from GitHub?</p>
<p>Here is what I get&#8230;</p>
<pre>
$ java Benchmark
refast fast basic smart resmart silly fixed rebasic
0.8537767 0.933717 5.8813856 0.9737157 0.9292436 5.8855361 3.7857766 3.3170692 3.7141652
</pre>
</div>
</li>
<li id="comment-142792" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-12-18T11:39:22+00:00">December 18, 2014 at 11:39 am</time></a> </div>
<div class="comment-content">
<p>@Dmitry,<br/>
right but this has nothing to do with reverse loops per se. I am getting the same gain by memorizing the size in the variable and using this variable in the loop.</p>
</div>
</li>
<li id="comment-142793" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-12-18T11:41:14+00:00">December 18, 2014 at 11:41 am</time></a> </div>
<div class="comment-content">
<p>PS: array.length call is inlined or something like this. There&rsquo;s no point in memorizing it.</p>
<p>Regarding doing things backwardly: I really wonder how this is supported by various CPU and memory &ldquo;predictors&rdquo;. For example, if you read long arrays, will prefetch understand that what you are going to read next?</p>
</div>
</li>
<li id="comment-142794" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/08273d5f7fe210be4bfcdd60b9b3fe09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/08273d5f7fe210be4bfcdd60b9b3fe09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">J. Andrew Rogers</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-12-18T11:46:38+00:00">December 18, 2014 at 11:46 am</time></a> </div>
<div class="comment-content">
<p>Daniel, I immediately see one reason why the reverse could be faster than forward. In the forward case, the call to array.size() has to be evaluated in each loop iteration, which might not be optimized away in Java in the way it would be for C. </p>
<p>In C, both cases would compile to something like initializing a register with the number of iterations and loop the operation until the register hit zero. For the reverse case in Java, where the iteration termination test is an immediate literal, I would expect the Java to produce virtually identical code to the C. For the forward case, there is room for Java to do something less optimal, especially if the optimizer is shy about inlining as you demonstrate. It doesn&rsquo;t make much sense but Java has a lot of odd edges in practice.</p>
</div>
</li>
<li id="comment-142795" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c251f356ee80573008335447f3bec220?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c251f356ee80573008335447f3bec220?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dmitry Platonoff</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-12-18T11:50:50+00:00">December 18, 2014 at 11:50 am</time></a> </div>
<div class="comment-content">
<p>@Daniel there&rsquo;s no rebasic on github. Could you push the latest changes?</p>
</div>
</li>
<li id="comment-142797" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c251f356ee80573008335447f3bec220?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c251f356ee80573008335447f3bec220?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dmitry Platonoff</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-12-18T11:56:14+00:00">December 18, 2014 at 11:56 am</time></a> </div>
<div class="comment-content">
<p>This is what I get</p>
<p>refast fast basic smart resmart silly fixed<br/>
1.6447691 1.6076136 7.4859653 1.6031647 1.6433024 7.4883121 4.7948762 4.9081517</p>
</div>
</li>
<li id="comment-142799" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c251f356ee80573008335447f3bec220?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c251f356ee80573008335447f3bec220?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dmitry Platonoff</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-12-18T12:08:18+00:00">December 18, 2014 at 12:08 pm</time></a> </div>
<div class="comment-content">
<p>The last value is refixed (it was missing a label). The odd part is that it&rsquo;s not significantly slower or faster than fixed. It floats up and down a bit, but there&rsquo;s no noticeable gain or loss. Here&rsquo;s a few more runs:<br/>
<a href="http://pastebin.com/raw.php?i=f1SGgDwx" rel="nofollow ugc">http://pastebin.com/raw.php?i=f1SGgDwx</a></p>
</div>
</li>
<li id="comment-142808" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-12-18T16:09:34+00:00">December 18, 2014 at 4:09 pm</time></a> </div>
<div class="comment-content">
<p>@Dmitry</p>
<p>I have pushed the code, sorry.</p>
<p>I was able to reproduce the negative results on an AMD processor. It seems that backward loops on standard arrays are faster on Haswell processors, but not necessarily on other processors.</p>
</div>
</li>
</ol>
