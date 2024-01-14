---
date: "2017-11-16 12:00:00"
title: "Fast software is a discipline, not a purpose"
index: false
---

[25 thoughts on &ldquo;Fast software is a discipline, not a purpose&rdquo;](/lemire/blog/2017/11-16-fast-software-is-a-discipline-not-a-purpose)

<ol class="comment-list">
<li id="comment-291486" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6d5b2bd9dccd6a06f98e0ce8eba71328?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6d5b2bd9dccd6a06f98e0ce8eba71328?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Yosef</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-16T08:04:07+00:00">November 16, 2017 at 8:04 am</time></a> </div>
<div class="comment-content">
<p>&ldquo;Don&rsquo;t use floating-point operations when integers will do.&rdquo;</p>
<p>I don&rsquo;t see why this is true &#8211; while integers are faster to add and subtract by a tiny margin, they are incredibly slower to divide (and modulus). That&rsquo;s one reason why fixed point numbers are used less than floating point numbers.</p>
<p>How about &#8211; &ldquo;Choose types according to the operations you want to perform on them&rdquo;?</p>
</div>
<ol class="children">
<li id="comment-291515" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-16T17:06:53+00:00">November 16, 2017 at 5:06 pm</time></a> </div>
<div class="comment-content">
<p><em>I don&rsquo;t see why this is true â€“ while integers are faster to add and subtract by a tiny margin, they are incredibly slower to divide (and modulus). That&rsquo;s one reason why fixed point numbers are used less than floating point numbers.</em></p>
<p>It is true that 64-bit integers can be slow, if divisions are involved. But if you do need the full 64 bits, it is not immediate that you can just use floats.</p>
<p>Still, your point is well made.</p>
</div>
</li>
<li id="comment-291532" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3ccba2630e88064d385e4bb65d2891a1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3ccba2630e88064d385e4bb65d2891a1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://sh1ftchg.com" class="url" rel="ugc external nofollow">Jay</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-16T21:03:13+00:00">November 16, 2017 at 9:03 pm</time></a> </div>
<div class="comment-content">
<p>I disagree. Mostly in lieu of the last bullet: &ldquo;Learn how the data is actually represented in bits, and learn to dance with these bits when you need to.&rdquo; </p>
<p>Ultimately it really depends on what you&rsquo;re trying to accomplish. And your compiler, but a good developer shouldn&rsquo;t expect a compiler to make up for their own inadequacy. Division and multiplication of integers can be computed via bitwise and binary operations instead of the costly counterparts&#8230; A well designed algorithm might use bitmasks instead of a modulo and zero-extend right for division. (See gailos field bit manipulation for one example.) Personally, I&rsquo;d expect the compiler to optimize nearby division/remainder operations into a single instruction but it&rsquo;s been my experience that unless you&rsquo;re using the Intel compiler, properly, you&rsquo;re out of luck.</p>
<p>While I agree, they are costly, isn&rsquo;t piping to an accelerator just as costly (even the optimized and on chip extensions). Unless you&rsquo;re doing lots of floating point calculations, then the comment stands. If you only need one or the other in limited quantities, a bit sieve should suffice.</p>
</div>
</li>
</ol>
</li>
<li id="comment-291489" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/47245ef95fe25122e7785b61a511ea7d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/47245ef95fe25122e7785b61a511ea7d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://singletoned.com" class="url" rel="ugc external nofollow">Ed Singleton</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-16T09:33:23+00:00">November 16, 2017 at 9:33 am</time></a> </div>
<div class="comment-content">
<p>No one believes that slow code is better than fast code. Everyone would make their code fast if it was trivial to do so, so what I think you must be saying is making your code fast is more important than other forms of optimisation.</p>
<p>Off the top of my head, some things you can optimise code for are:</p>
<p>&#8211; speed (processor time)<br/>
&#8211; speed (developer time)<br/>
&#8211; memory<br/>
&#8211; disk usage (storage)<br/>
&#8211; disk usage (fewest lines)<br/>
&#8211; readability<br/>
&#8211; maintainability<br/>
&#8211; clarity<br/>
&#8211; security<br/>
&#8211; enjoyment / satisfaction<br/>
&#8211; cost (a balance of developer time, memory, speed and storage)</p>
<p>All of these can be optimised at the expense of the others, and I definitely can see no reason why speed of processor time should be at the top of the list except in special cases.</p>
<p>I suspect that really you are putting enjoyment/satisfaction at the top of the list (which is perfectly reasonable to do), and that you enjoy optimising code for speed.</p>
<p>Personally I enjoy optimising code for readability/maintainability, which is why I put that near the top of the list (along with developer time and enjoyment). I tend to find that speed conflicts with all of those fairly often.</p>
<p>I do entirely agree with your broader point that one should have discipline. I personally don&rsquo;t think discipline in optimising for speed is a particularly good general usage of discipline, neither do I think that personal cleanliness is a very good use of it (it is in fact a very bad use and has been linked to allergies, asthma and weak immune systems).</p>
</div>
<ol class="children">
<li id="comment-291506" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-16T14:36:47+00:00">November 16, 2017 at 2:36 pm</time></a> </div>
<div class="comment-content">
<p><em>I enjoy optimising code for readability/maintainability</em></p>
<p>I have looked hard and long, and I have never come up with satisfying measures of what it means to be readable in objective terms. Lots of reasonable people object to C because it is harder to read, so they work in C++ instead. Lots of equally reasonable people find old-school C more readable than C++. Many people, maybe most people, love pure functional programming because it is easier to read and more maintainable. There has been lots of formal studies to assess this point, and, frankly, the scientific evidence is lacking. The latest fashionable language is Rust, and people swear by it for its safety, readability, and maintainability. Other, equally reasonable people, find it very hard to work with Rust.</p>
<p>I could go on.</p>
</div>
</li>
</ol>
</li>
<li id="comment-291490" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a8f469d5b2386c02947d043ee2b9692f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a8f469d5b2386c02947d043ee2b9692f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">TheFattestNinja</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-16T09:48:26+00:00">November 16, 2017 at 9:48 am</time></a> </div>
<div class="comment-content">
<p>I agree with the whole &ldquo;you should care&rdquo; points, but (pretty much) all the recommendations you posted relate to writing more performing code, not cleaner code. </p>
<p>Arguably, some of them are at times in conflict with cleaner code, such as &ldquo;avoid multiple passes&rdquo; (keeping track of multiple state during a single pass is messier than doing one thing at a time) and &ldquo;prefer simple value types&rdquo; (using a String instead of creating a specific strong type for say, a ProductId and a CustomerId).</p>
<p>It almost seem you (I don&rsquo;t know your background exactly) come from a fairly low-level of coding background, where there is a generally different sense of what &ldquo;beautiful&rdquo; and &ldquo;good&rdquo; code are (not judging it wrong or right, just not universal).</p>
<p>Imho adaptability and readability are far more important and worthy to pursue than performance, but I agree on the overall &ldquo;at least do care about SOMETHING&rdquo;! 🙂</p>
</div>
<ol class="children">
<li id="comment-291502" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-16T14:29:27+00:00">November 16, 2017 at 2:29 pm</time></a> </div>
<div class="comment-content">
<p><em>â€œprefer simple value typesâ€ (using a String instead of creating a specific strong type for say, a ProductId and a CustomerId).</em></p>
<p>I&rsquo;d argue that your ProductId should be an integer.</p>
<p>Strings are hard. There are entire books written about <a href="https://www.amazon.com/Unicode-Explained-Internationalize-Documents-Programs/dp/059610121X" rel="nofollow">just character encodings</a>. There are long debates about how you define what a character is, what is the &ldquo;string length&rdquo; and so forth. How does your favorite language handle strings? See my post <a href="https://lemire.me/blog/2017/07/07/are-your-strings-immutable/">Are your strings immutable?</a>: there is no widespread agreement on how to consider string values.</p>
<p><em>Imho adaptability and readability are far more important and worthy to pursue than performance</em></p>
<p>&ldquo;Adaptability and readability&rdquo; can mean many things to different people. To some people, it means transforming all your code so it relies on pure functional programming. Then, for others, it means compile-time template metaprogramming. And so forth.</p>
<p>Adaptability and readability are frequently at odds. Specialized code that does one thing and only one thing is often much more readable than highly customizable code.</p>
</div>
</li>
<li id="comment-291508" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5c30403d77047cd6ff49f2c1b78352e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5c30403d77047cd6ff49f2c1b78352e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://chriswarbo.net" class="url" rel="ugc external nofollow">Chris Warburton</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-16T15:03:18+00:00">November 16, 2017 at 3:03 pm</time></a> </div>
<div class="comment-content">
<p>It seems to me that we&rsquo;re talking about nice-to-haves and ideals, i.e. things to optimise if we can afford the effort, and if they don&rsquo;t impact our other concerns (readability, correctness, etc.).</p>
<p>In which case, I think your examples are poorly chosen:</p>
<p>&gt; Arguably, some of them are at times in conflict with cleaner code, such as â€œavoid multiple passesâ€ (keeping track of multiple state during a single pass is messier than doing one thing at a time)</p>
<p>There&rsquo;s a difference between the code we write and the code that runs. *Ideally* we would write each pass as a separate chunk of code, self-contained and unable to conflict with each other, and these would be combined into a single pass by some other chunk of code. In fact, such pass-combining code might turn out to be useful for many other projects 🙂 I say &ldquo;chunk of code&rdquo;, since there may be many ways to implement this, e.g. with functions, templates, compiler optimisations, multi-stage programming, etc.</p>
<p>&gt; and â€œprefer simple value typesâ€ (using a String instead of creating a specific strong type for say, a ProductId and a CustomerId).</p>
<p>Strong types aren&rsquo;t in conflict with fast, zero-overhead code. We can use &ldquo;nominal types&rdquo; to solve this; these are types where checking only succeeds when the names match. We can define ProductId and CustomerId as nominal types, which are implemented as (say) String. Then, if we use a String or CustomerId when a ProductId is expected, we get a type error, since it&rsquo;s the name which gets checked, even though they&rsquo;re all represented by the same bit-patterns in memory. After type checking, the code generator can replace all occurrences of ProductId and CustomerId with String, and compile-away any casts (e.g. `mkCustomerId(myString)`, or whatever) since it knows they&rsquo;re no-ops. I&rsquo;m not sure how widespread support for this is, but I know it&rsquo;s available in Haskell with the `newtype` keyword.</p>
</div>
</li>
</ol>
</li>
<li id="comment-291495" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">jld</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-16T11:01:02+00:00">November 16, 2017 at 11:01 am</time></a> </div>
<div class="comment-content">
<p>Hummm&#8230;<br/>
No, I think the best quality in software is that it should be easy to understand, so a &ldquo;dumb&rdquo; linear search is <b>better</b> than any other more clever search if it is good enough given the context.<br/>
And don&rsquo;t tell me that it couldn&rsquo;t possibly scale (YANGNI&#8230;)</p>
</div>
<ol class="children">
<li id="comment-291498" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-16T13:03:20+00:00">November 16, 2017 at 1:03 pm</time></a> </div>
<div class="comment-content">
<p>A linear search is often the fastest code you can write.</p>
</div>
</li>
</ol>
</li>
<li id="comment-291499" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b284df1f0902c08d53a702aa08ad874d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b284df1f0902c08d53a702aa08ad874d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Martin Pal</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-16T13:17:36+00:00">November 16, 2017 at 1:17 pm</time></a> </div>
<div class="comment-content">
<p>I think what you&rsquo;re really saying is that it is inconsiderate to write code that makes its readers cringe. I agree that if code can be changed to look less offensive on the &ldquo;this looks stupid slow&rdquo; front without sacrificing on other dimensions (readability, modularity, maintainability) it&rsquo;s a win. But everything can be taken too far.</p>
<p>As an example, a good rule of thumb for keeping things efficient is to pass large objects by reference. This makes a ton of sense if you spend your days writing C++ code for a high qps web service or a data pipeline crunching terabytes of data. At Google, we have automated tools that complain if you pass say an object by value when a const reference would do.</p>
<p>On the other hand, if you find yourself writing configuration logic for your data pipeline, different rules apply. The configuration logic (I&rsquo;m talking about Google&rsquo;s Flume) is run once at the beginning of a multi-hour many-machine job, and no matter how inefficiently you write it, it will finish under a second. For the configuration logic, readability and obvious correctness are traits to optimize for, and nobody should care if that input file name string is copied a few more times than strictly necessary.</p>
</div>
<ol class="children">
<li id="comment-291500" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-16T14:07:23+00:00">November 16, 2017 at 2:07 pm</time></a> </div>
<div class="comment-content">
<p><em>As an example, a good rule of thumb for keeping things efficient is to pass large objects by reference. This makes a ton of sense if you spend your days writing C++ code for a high qps web service or a data pipeline crunching terabytes of data. At Google, we have automated tools that complain if you pass say an object by value when a const reference would do.</em></p>
<p>The only programming language where I ended up accidentally copying large objects is C++. And it is not always trivial to find out where it happens, unfortunately. And it will rarely end up being a performance concern because copies are really very fast.</p>
<p><em>nobody should care if that input file name string is copied a few more times than strictly necessary</em></p>
<p>Copying data is fast and it can be faster to work from local copies of the data than to constantly refer back to some functions&#8230; with the caveat that caching can be evil too when values can change dynamically.</p>
</div>
</li>
</ol>
</li>
<li id="comment-291512" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Simon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-16T15:46:26+00:00">November 16, 2017 at 3:46 pm</time></a> </div>
<div class="comment-content">
<p>FYI I recently answered a question on Quora about writing better and faster code [1]. It&rsquo;s a longer answer and after you&rsquo;ve read it then discipline is definitely a word which pops into the mind. Although in my experience developers all have different levels of discipline so IMO it&rsquo;s important to create a system which enforces discipline where possible, e.g. code cannot beer pushed if it doesn&rsquo;t meet code coverage requirements, or stress tests do not meet a certain throughout. Even the best coders can relax their discipline late on Friday afternoon 🙂 And this is also a reason why pair programming is useful because you get &lsquo;redundant discipline&rsquo; 🙂</p>
<p>[1] <a href="https://www.quora.com/What-are-some-techniques-to-write-better-and-faster-code/answer/Simon-Hardy-Francis" rel="nofollow ugc">https://www.quora.com/What-are-some-techniques-to-write-better-and-faster-code/answer/Simon-Hardy-Francis</a></p>
</div>
<ol class="children">
<li id="comment-291516" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-16T17:09:15+00:00">November 16, 2017 at 5:09 pm</time></a> </div>
<div class="comment-content">
<p>Good post!</p>
</div>
</li>
</ol>
</li>
<li id="comment-291520" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/891924a7ffca0ea7e86241edca222d00?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/891924a7ffca0ea7e86241edca222d00?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Miron Brezuleanu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-16T18:34:01+00:00">November 16, 2017 at 6:34 pm</time></a> </div>
<div class="comment-content">
<p>IMO following your advice would wipe out most PHP software 🙂</p>
<p>What&rsquo;s more valuable: bad software that gets the job done or no software?</p>
<p>I think this is the &ldquo;PHP question&rdquo;.</p>
<p>I remember reading some time ago that one of the bosses on the Microsoft Office team allegedly said that &ldquo;we could build a bug free Office, but it would cost at least 5kUSD for one copy and nobody would buy it at that price point.&rdquo;</p>
<p>I think we should consciously optimize for value while aware of the short/long term compromises, but that&rsquo;s just my way of keeping my tee-shirt clean 🙂</p>
</div>
<ol class="children">
<li id="comment-291521" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-16T19:25:11+00:00">November 16, 2017 at 7:25 pm</time></a> </div>
<div class="comment-content">
<p>There is amazing PHP software out there. It started out as a rather naive programming language, but modern-day PHP is quite amazing. </p>
<p>Could it not be reasonable to think that most of the value in software is produced by few individuals? The salary distribution sure seems to indicate that it is the case. The average programmer is poorly paid whereas others make as much as rock stars.</p>
<p><em>What&rsquo;s more valuable: bad software that gets the job done or no software?</em></p>
<p>The value of most software (99%) is zero. You know all this enterprise software that gets pushed onto employees? Yeah. That. We don&rsquo;t care. It could go away tomorrow and the world would be better off.</p>
<p><em>I remember reading some time ago that one of the bosses on the Microsoft Office team allegedly said that â€œwe could build a bug free Office, but it would cost at least 5kUSD for one copy and nobody would buy it at that price point.â€</em></p>
<p>There was office sofware before Microsoft published the first Windows. Microsoft mopped the floor with its competitors. Their competitors could not keep up. Then the Web came, altavista dominated as the search platform&#8230; but they could not update their index because of their crappy software. Google won.</p>
<p>And so on.</p>
<p>Crappy, unreliable and slow software kills businesses all the time.</p>
<p>The Mozilla folks were close to a massive victory in the browser war. But they did not care about performance. They could not adapt to mobile platforms because of their top-heavy approach. People moved to other browsers. Will they survive? I don&rsquo;t know. If they do, it will be because of a massive reengineering that they just completed.</p>
</div>
<ol class="children">
<li id="comment-291524" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Simon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-16T19:45:24+00:00">November 16, 2017 at 7:45 pm</time></a> </div>
<div class="comment-content">
<p>PHP is an interesting language because it still is very useful if not the sexy language of the day like Rust is said to be. However, many people don&rsquo;t realize that PHP is actually a rock star language in Asia and powers many of the giant Asian social media and web sites which are so big that they make our western house-hold names like twitter and Facebook look puny. As such, there is amazing technology like Swoole [1] powered by Asian rock star developers, available on GitHub, but not recognized much in the western world&#8230; 🙂</p>
<p>[1] <a href="https://github.com/swoole/swoole-src" rel="nofollow ugc">https://github.com/swoole/swoole-src</a></p>
</div>
<ol class="children">
<li id="comment-294411" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/26d076bda281acfdbcefb372f1cf5f74?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/26d076bda281acfdbcefb372f1cf5f74?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stephan Sokolow</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-03T10:22:03+00:00">January 3, 2018 at 10:22 am</time></a> </div>
<div class="comment-content">
<p>I always point back to <a href="https://eev.ee/blog/2012/04/09/php-a-fractal-of-bad-design/" rel="nofollow ugc">https://eev.ee/blog/2012/04/09/php-a-fractal-of-bad-design/</a> when I hear these kinds of arguments.</p>
<p>Sure, PHP may have improved, but the kinds of problems shown there are the kind where, even supposing a massive influx of highly-experienced language designers to prevent new mistakes from creeping in, you&rsquo;re still left with a language with deep flaws which would require a Python 2/3-style split to fix.</p>
<p>(ie. I see claims that PHP &ldquo;is better now&rdquo; as being equivalent to claims by C++ afficionados who dismiss Rust by pointing to all of the proposals to add its features to C++. The &ldquo;secret sauce&rdquo; isn&rsquo;t just in the new stuff that a competitor brings to the mix, but also in the baggage the incumbent is forced to carry to remain compatible with existing code and developer expertise.)</p>
</div>
<ol class="children">
<li id="comment-294429" class="comment byuser comment-author-lemire bypostauthor even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-03T15:50:25+00:00">January 3, 2018 at 3:50 pm</time></a> </div>
<div class="comment-content">
<p>At this point, I don&rsquo;t think you can make C++ worse by adding new features to it.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-291530" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3ccba2630e88064d385e4bb65d2891a1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3ccba2630e88064d385e4bb65d2891a1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://sh1ftchg.com" class="url" rel="ugc external nofollow">Jay</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-16T20:24:19+00:00">November 16, 2017 at 8:24 pm</time></a> </div>
<div class="comment-content">
<p>Fun fact, Mozilla stays afloat by selling out via Google and Yahoo. </p>
<p>As far as I know they only recently stopped selling user statistics to Google. There are also talks of switching from Google&rsquo;s $300M deal (to make Google the default search engine) to $375M with Yahoo.</p>
<p>I&rsquo;m not much of a Mozilla fan but it&rsquo;s my opinion that the Mozilla Foundation will stay afloat thanks to its frivolous investment alone, regardless of their statistics and user-information-vending side ventures. Much of their API&rsquo;s wind up as de facto standards long before they ever become the de jure; bolstering their continuity.</p>
<p>Regarding the Microsoft Office suite&#8230; I completely agree because, let&rsquo;s be honest, does anyone really miss Lotus?</p>
</div>
</li>
<li id="comment-291694" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/891924a7ffca0ea7e86241edca222d00?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/891924a7ffca0ea7e86241edca222d00?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Miron Brezuleanu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-19T09:33:50+00:00">November 19, 2017 at 9:33 am</time></a> </div>
<div class="comment-content">
<p>Hello again,</p>
<p>first, I think there is a problem with your comment system: I expected to get an email notification when there was a reply to my comment, but I didn&rsquo;t get any notification (I did check the spam folder 🙂 ).</p>
<p>I think we don&rsquo;t have the same definition for &ldquo;value&rdquo;. Sure, for you and me most enterprise value has no value (or even negative value, as in &ldquo;it seems to do more harm than good&rdquo;), but for whoever is buying it it may solve problems. Problems we don&rsquo;t even think about, possibly. Problems they probably wouldn&rsquo;t have if they had done other things right. But in the context of the buyer, problems they need to solve (and solving them badly is much better than not solving them at all).</p>
<p>&ldquo;Value&rdquo; to you and me probably means that the valuable thing solves big problems for lots of people. To other people, it may simply mean &ldquo;I get home in time for dinner today&rdquo;. There is nothing wrong with either view. And yes, individual salaries for adding the first kind of value are larger than individual salaries for adding the second kind. But I also think the aggregate salary for the first kind is less than the aggregate salary for the second kind 🙂</p>
<p>So while &ldquo;value&rdquo; in general is a very complicated term to define, I guess I meant &ldquo;value to the buyer&rdquo;.</p>
<p>So, to clarify, I try to optimize for &ldquo;value to the buyer&rdquo;. And yes, that means good performance a lot of times. But not always. Sometimes giving them a good model of their problem and solution is so much more important than the performance of the solution implementation (with a good model they can switch to a better implementation later, if needed). Not all stains on teeshirts are cleaned the same way 🙂</p>
<p>As for Mozilla, I think they constantly cared for performance (the simple fact that they tried to trim down Mozilla to Phoenix/Firebird/Firefox shows that they cared). They just had a big horrible code base to deal with. I remember at some point they had some projects that detected dead code in a large code base so it could be removed. I guess they had a pretty bad problem with global dead code. I do wonder why they didn&rsquo;t just rewrite it (they had 15 years to do it). I guess they thought it would end up the same if they started with the same tools (C++ etc.). They are doing a rewrite now in Rust (which they developed because they do care about performance AND maintainability).</p>
</div>
<ol class="children">
<li id="comment-294412" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/26d076bda281acfdbcefb372f1cf5f74?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/26d076bda281acfdbcefb372f1cf5f74?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stephan Sokolow</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-03T10:30:32+00:00">January 3, 2018 at 10:30 am</time></a> </div>
<div class="comment-content">
<p>Mozilla didn&rsquo;t rewrite it because their &ldquo;killer app&rdquo; was their extension ecosystem and legacy extensions were based on a design of &ldquo;There is no API. Monkey patch whatever browser internals you like.&rdquo;</p>
<p>That&rsquo;s what gave them their power to innovate, but also locked the browser into old designs. (Look at any long-running Firefox extension where the author has a history of supporting a wide span of browser versions from each extension release and you&rsquo;ll see a ton of &ldquo;If browser version X, do Y&rdquo; blocks DESPITE the browser hamstringing itself to remain compatible.</p>
<p>WebExtensions is essentially their admission that the legacy extension APIs (the foundation of their primary advantage over Chrome) had become a gangrenous limb and, rather than amputating it, they kept trying to adapt the old paradigm to a multi-process future for so long that, when they finally admitted they had to amputate, the migration to WebExtensions came across as rushed and it&rsquo;s still uncertain whether Firefox&rsquo;s market share can recover.</p>
</div>
</li>
<li id="comment-294428" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-03T15:43:33+00:00">January 3, 2018 at 3:43 pm</time></a> </div>
<div class="comment-content">
<p><em>As for Mozilla, I think they constantly cared for performance &#8230; They just had a big horrible code base to deal with. I remember at some point they had some projects that detected dead code in a large code base so it could be removed. I guess they had a pretty bad problem with global dead code.</em></p>
<p>I think you could say the same thing about any business that fails due to its poor software. &ldquo;Oh! They cared, but they had to deal with this big ugly code base&rdquo;.</p>
<p><em>They are doing a rewrite now in Rust (which they developed because they do care about performance AND maintainability).</em></p>
<p>You can spin the story in different ways. You could say that they care a lot because they are doing a rewrite. You could also say that they are doing a rewrite because they did not care enough.</p>
<p>I&rsquo;d say that the adoption of Rust is definitively a good sign, but I view it as a sign that they are doing a course correction necessary to stay relevant&#8230;</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-291522" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Simon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-16T19:37:32+00:00">November 16, 2017 at 7:37 pm</time></a> </div>
<div class="comment-content">
<p>â€œwe could build a bug free Office, but it would cost at least 5kUSD for one copy and nobody would buy it at that price point.â€</p>
<p>I think this is the type of comment is by people who imagine scaling their existing and already badly functioning QA process to an imagined bug free level. Of course it&rsquo;s going to be expensive.</p>
<p>And there&rsquo;s tons of psychology behind an answer like this too. Firstly, it justifies the crappy status quo with the regular testing methods so nobody is losing their jobs regarding their bad decisions so far. And secondly, most developers hate writing tests themselves and instead rely on QA departments and QA developers etc. So the answer is &lsquo;test-hater-developer friendly&rsquo; too.</p>
<p>Also, many companies have neglected tests for so long that there would be a huge and unwanted expense associated with building up the level of code coverage via writing tests. And of course, while you&rsquo;re writing those tests you&rsquo;re not writing sexy new features. However, in the past I started work for a company which only had 37% code coverage on it&rsquo;s code base. I then implemented an automated &lsquo;code amnesty&rsquo; whereby only brand new code needed to have 100% code coverage. Leave this to bake for a few years and don&rsquo;t write any special tests for the code without coverage and bingo&#8230; after a few years code coverage is over 90%. This is because writing tests for the new code ends up testing the old code around it a bit too. So there are many ways to achieve high levels of QA without huge expense. But it&rsquo;s probably not going to work well for those companies who pamper their developers who are too good for writing automated test code&#8230;</p>
</div>
</li>
</ol>
</li>
<li id="comment-291531" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cbb1c4de7d40bd415f85378d56de77ed?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cbb1c4de7d40bd415f85378d56de77ed?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://worksonarm.com" class="url" rel="ugc external nofollow">Ed Vielmetti</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-16T20:55:23+00:00">November 16, 2017 at 8:55 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;Avoid multiple passes over the data when one would do.&rdquo;</p>
<p>This is especially true in this age when the bottleneck is often memory bandwidth.</p>
<p>I love this account of awk vs Hadoop (spoiler: awk wins):</p>
<p><a href="https://aadrake.com/command-line-tools-can-be-235x-faster-than-your-hadoop-cluster.html" rel="nofollow ugc">https://aadrake.com/command-line-tools-can-be-235x-faster-than-your-hadoop-cluster.html</a></p>
</div>
</li>
</ol>
