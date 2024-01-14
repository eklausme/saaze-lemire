---
date: "2019-03-28 12:00:00"
title: "Java is not a safe language"
index: false
---

[40 thoughts on &ldquo;Java is not a safe language&rdquo;](/lemire/blog/2019/03-28-java-is-not-a-safe-language)

<ol class="comment-list">
<li id="comment-397832" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f3e232ee129f31366b9e744d1e7ca942?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f3e232ee129f31366b9e744d1e7ca942?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">nobody</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-28T22:19:20+00:00">March 28, 2019 at 10:19 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;Memory leaks are memory safe in Rust&rdquo;</p>
<p><a href="https://doc.rust-lang.org/book/ch15-06-reference-cycles.html" rel="nofollow ugc">https://doc.rust-lang.org/book/ch15-06-reference-cycles.html</a></p>
</div>
</li>
<li id="comment-397852" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c65c7991822f827780a2cae38c5c31a2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c65c7991822f827780a2cae38c5c31a2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://seth-holladay.com" class="url" rel="ugc external nofollow">Seth Holladay</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-29T00:18:56+00:00">March 29, 2019 at 12:18 am</time></a> </div>
<div class="comment-content">
<p>I was hoping you would give some more examples of languages that are very safe, after having pointed out languages that are not. For me, Haskell comes to mind, and you did mention Rust, but what other modern languages are there that have learned from history and avoid these pitfalls that many &ldquo;safe&rdquo; languages still have?</p>
</div>
<ol class="children">
<li id="comment-398079" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/16f22ec87b976711a875a505e248c215?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/16f22ec87b976711a875a505e248c215?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Yawar Amin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-30T00:25:20+00:00">March 30, 2019 at 12:25 am</time></a> </div>
<div class="comment-content">
<p>I wouldn&rsquo;t call it modern, (and that&rsquo;s a good thing in my books), but Ada certainly has a ton of safety features that Java lacks.</p>
</div>
<ol class="children">
<li id="comment-398590" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ad52250349d052368f51a76d1a5f898d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ad52250349d052368f51a76d1a5f898d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Steve Schwarm</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-01T12:49:53+00:00">April 1, 2019 at 12:49 pm</time></a> </div>
<div class="comment-content">
<p>Ada is not allowed to have subsets or supper set which is a VERY good thing. There is a subset language SPARK which is very safe. I think it beats Rust.</p>
<p>I do not understand the Modern Language issue. Ada 2012 is a modern language. The language standard is available for free and a very readable document. There are some excellent compilers including a gcc based one.</p>
</div>
<ol class="children">
<li id="comment-489704" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ff3e69fbe02143af98482c18035ef29f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ff3e69fbe02143af98482c18035ef29f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">FooKJ</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-02-07T04:29:25+00:00">February 7, 2020 at 4:29 am</time></a> </div>
<div class="comment-content">
<p>Yeah&#8230;Ada is clearly &lsquo;safe&rsquo; and has nearly 40 years of history. And there are plenty of others. But the industry continues to pretend safe languages don&rsquo;t exist, won&rsquo;t invest in building on actual experience in this area and pretend our only hope is some future innovation (current incarnation: Rust will save us from all the bugs&#8230;).</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-436576" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/00757e62b8e477bdb1c21b9e2a559fc9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/00757e62b8e477bdb1c21b9e2a559fc9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jerry</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-31T01:23:23+00:00">October 31, 2019 at 1:23 am</time></a> </div>
<div class="comment-content">
<p>Pony is: <a href="https://www.ponylang.io/" rel="nofollow ugc">https://www.ponylang.io/</a></p>
<p>Here is a mathematical proof:<br/>
<a href="https://www.ponylang.io/media/papers/fast-cheap-with-proof.pdf" rel="nofollow ugc">https://www.ponylang.io/media/papers/fast-cheap-with-proof.pdf</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-397885" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8d529bafee19e75a60b00f035a7a58ae?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8d529bafee19e75a60b00f035a7a58ae?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Steven Stewart-Gallus</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-29T02:50:33+00:00">March 29, 2019 at 2:50 am</time></a> </div>
<div class="comment-content">
<p>And here I thought this was going to talk about array variancy or null-related soundness bugs in generics (not a major problem because it is papered over by generics erasure and compiler inserted casting checks.)</p>
<p>The <strong>key</strong> benefit of Java&rsquo;s safety is that correctness bugs do not cause spooky action at a distance.</p>
<p>A broken linked list implementation on the JVM will not cause your password checking code to break.</p>
<p>This is fundamentally different to C++ where a broken linked list implementation can lead to arbitrary memory corruption, overwriting the return pointer and then jumping past the password checking code.</p>
<p>I do agree that memory leaks are a problem. IMO a proper VM for the future should support isolated heaps sort of like Erlang or the Midori project.</p>
<p>Do note that data races on the JVM are specifically limited (and consequently lead to slower code) in a few ways such as that final fields have a storestore fence after them and object references and values other than doubles and longs do not tear and so careful enforcement of Java&rsquo;s sandboxing is theoretically possible (although often flawed in practise.)</p>
</div>
</li>
<li id="comment-397912" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/04ac4cbb4abfeb057a688c222217c2dc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/04ac4cbb4abfeb057a688c222217c2dc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Gunnar Þór Magnússon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-29T04:47:40+00:00">March 29, 2019 at 4:47 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
Starting with Java 8, you have Optional objects in the standard library, but they are an afterthought.
</p></blockquote>
<p>Optional can also be null.</p>
</div>
</li>
<li id="comment-397976" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/46814cb72562ea0b2e5b9da4cad32ea6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/46814cb72562ea0b2e5b9da4cad32ea6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Aaron</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-29T11:29:24+00:00">March 29, 2019 at 11:29 am</time></a> </div>
<div class="comment-content">
<p>Java is also not safe with variance in generics.<br/>
Kotlin is a good example of a language that improves on language safety with generics and null. It doesn&rsquo;t have nulls (although it&rsquo;s untagged union None type happens to be named &ldquo;null&rdquo;)</p>
</div>
</li>
<li id="comment-398389" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/45a0c19f3084d130b5383c2c907fec70?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/45a0c19f3084d130b5383c2c907fec70?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Peter Ashford</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-31T21:39:31+00:00">March 31, 2019 at 9:39 pm</time></a> </div>
<div class="comment-content">
<p>None of these issues are the things that spring to mind when language &ldquo;safety&rdquo; is mentioned. I think of language safety as exclusively the issue of memory safety. Java <em>is</em> memory safe. You won&rsquo;t get buffer overrun exploits like you can with C/C++.<br/>
A null pointer exception or an overflow is annoying but it&rsquo;s unlikely to lead to someone hacking your computer.<br/>
TL;DR I don&rsquo;t think your definition of language &ldquo;safety&rdquo; matches what most people mean by the word.</p>
</div>
<ol class="children">
<li id="comment-398406" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-01T00:21:15+00:00">April 1, 2019 at 12:21 am</time></a> </div>
<div class="comment-content">
<p>Would you say that Java is the safest a language can be? That is, with Java, we reached peak language safety?</p>
</div>
<ol class="children">
<li id="comment-398597" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9caf9b3351fba163ebabe0814058efef?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9caf9b3351fba163ebabe0814058efef?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mike Ober</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-01T13:13:33+00:00">April 1, 2019 at 1:13 pm</time></a> </div>
<div class="comment-content">
<p>Java is so far behind some of the other languages on the market today it&rsquo;s not even valid to consider it safe anymore. About the only place where it&rsquo;s safe is buffer overruns, but as the author pointed out simple scaler operations can result in uncaught overflows. Dartmouth BASIC was safer.</p>
</div>
<ol class="children">
<li id="comment-398675" class="comment even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/45a0c19f3084d130b5383c2c907fec70?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/45a0c19f3084d130b5383c2c907fec70?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Peter M Ashford</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-01T19:58:03+00:00">April 1, 2019 at 7:58 pm</time></a> </div>
<div class="comment-content">
<p>A scalar overflow is not going to give a hacker access to your computer. There&rsquo;s a difference between actual safety of your computer and nice to have language features</p>
</div>
<ol class="children">
<li id="comment-398676" class="comment byuser comment-author-lemire bypostauthor odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-01T20:11:29+00:00">April 1, 2019 at 8:11 pm</time></a> </div>
<div class="comment-content">
<p><em>A scalar overflow is not going to give a hacker access to your computer.</em></p>
<p><a href="https://cwe.mitre.org/data/definitions/190.html" rel="nofollow">How sure are you about that?</a></p>
</div>
<ol class="children">
<li id="comment-398732" class="comment even depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/50bc93c10126e018a08f4ee3135d3930?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/50bc93c10126e018a08f4ee3135d3930?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nikolay</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-02T00:36:16+00:00">April 2, 2019 at 12:36 am</time></a> </div>
<div class="comment-content">
<p>Despite the name this still seems more like a result of the direct access to the memory (which you dont have in java) rather than the integer overflow.</p>
<p>And sure if you really try hard, any language idiosyncrasy when overlooked, can cause a bug, and any bug can potentially be a security risk if you keep trying really hard.</p>
<p>But this article doesn&rsquo;t make a single valid point from the first to the last word. Utter nonsense</p>
</div>
<ol class="children">
<li id="comment-398875" class="comment byuser comment-author-lemire bypostauthor odd alt depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-02T15:40:58+00:00">April 2, 2019 at 3:40 pm</time></a> </div>
<div class="comment-content">
<p>So Nikolay, is it fair to say that you think that the engineers who design languages that, for example, trap overflows in the name of safety, are misguided?</p>
<p>Would you say that a programming language that prevents data races is not safer?</p>
<p>Would you say that preventing data races is not a safety feature&#8230; It is a waste of engineering time on the part of language designers?</p>
</div>
<ol class="children">
<li id="comment-398924" class="comment even depth-8 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/45a0c19f3084d130b5383c2c907fec70?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/45a0c19f3084d130b5383c2c907fec70?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Peter M Ashford</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-02T20:11:34+00:00">April 2, 2019 at 8:11 pm</time></a> </div>
<div class="comment-content">
<p>Preventing data races is a great feature. Its part of what&rsquo;s great about Rust. But if not preventing data races is &lsquo;unsafe&rsquo; then all the languages on the top of the Tiobe index are unsafe.<br/>
Again, not saying that these are not good features to have &#8211; totally agree that they are &#8211; but when you say a language is unsafe I believe that means memory-safety to most people.</p>
</div>
<ol class="children">
<li id="comment-398928" class="comment byuser comment-author-lemire bypostauthor odd alt depth-9 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-02T20:33:49+00:00">April 2, 2019 at 8:33 pm</time></a> </div>
<div class="comment-content">
<p>I did not state that Java was unsafe without qualification. Safety is necessarily a relative statement (that&rsquo;s explicit in my post). Here is my specific claim:</p>
<p><em>If ‘safety’ is your primary concern, then you have better options.</em></p>
<p>Do you disagree with this statement?</p>
<p>If you disagree, then you have to believe that you do not have better options. Why not?</p>
<p><em>all the languages on the top of the Tiobe index are unsafe</em></p>
<p>Python is up there in the top 3 right now. It has decent safety features. I certainly consider it safer than Java.</p>
</div>
<ol class="children">
<li id="comment-398957" class="comment even depth-10 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/50bc93c10126e018a08f4ee3135d3930?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/50bc93c10126e018a08f4ee3135d3930?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nikolay</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-02T22:51:23+00:00">April 2, 2019 at 10:51 pm</time></a> </div>
<div class="comment-content">
<p>Then consider changing the title of the article to &ldquo;If ‘safety’ is your primary concern, then you have better options (than quite a bunch of languages)&rdquo;. And not the bombastic click bait that it is now. And please don&rsquo;t start with a C++ vs Java anecdote, C++ probably is on the top of the &ldquo;unsafe languages&rdquo; list, by a margin.</p>
<p>I am not saying anyone doing thing differently than java is misguided or waste of whatever. I might actually even agree that trapping overflow is a good idea. But not in the name of safety, because, it has hardly anything to do with safety.</p>
<p>You keep throwing the word &ldquo;safety feature&rdquo;, &ldquo;in the name of safety&rdquo; etc. before any feature, but, again i told you you can do that with any language idiosyncrasy. Let me illustrate:<br/>
&#8211; Duck typing in Ruby is not safe, because people who don&rsquo;t know what duck typing is can make mistakes or not read the code properly and that mistake might hypothetically sometimes have something do with security.<br/>
&#8211; in JavaScript, 1 == &ldquo;1&rdquo; is true and safety safety safety safety&#8230;</p>
<p>I mean you are a genius. Each week you can come up with an article like this and even use the same 4 reasons and just plug different language every time. Then eventually maybe come up with a new unrelated to safety reason for the sake of variety and write about some other languages that lack that feature.</p>
</div>
</article>
</li>
<li id="comment-398962" class="comment byuser comment-author-lemire bypostauthor odd alt depth-10">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-02T23:12:05+00:00">April 2, 2019 at 11:12 pm</time></a> </div>
<div class="comment-content">
<p>So catching overflows is unrelated to safety, that is, it does not help to prevent bugs and programming errors&#8230; is that what you think? Why is it being introduced in other programming languages?</p>
<p>C++ is indeed less safe than Java in most (but not all) ways. However, my point should be quite clear I would hope: Java is safer than C++ but not nearly as safe as a language can be.</p>
</div>
</article>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-398921" class="comment even depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/45a0c19f3084d130b5383c2c907fec70?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/45a0c19f3084d130b5383c2c907fec70?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Peter M Ashford</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-02T20:05:48+00:00">April 2, 2019 at 8:05 pm</time></a> </div>
<div class="comment-content">
<p>You did notice that your example was from C?</p>
</div>
<ol class="children">
<li id="comment-398927" class="comment byuser comment-author-lemire bypostauthor odd alt depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-02T20:25:35+00:00">April 2, 2019 at 8:25 pm</time></a> </div>
<div class="comment-content">
<p>The C#, Swift, Rust (etc.) people trap overflows in the name of safety. Java does not trap overflows. (That&rsquo;s just one example from my list which is meant as a list of examples.)</p>
<p>Either you agree with people who think that trapping overflows is a safety feature, in which case you must conclude that Java lacks at least this one safety feature&#8230; Or else you disagree that it is a safety feature and you think that these other language designers are misguided.</p>
<p>The same issue goes for data races. Some languages prevent data races, Java does not. If you agree that preventing data races makes the programming language safer, then you must agree that Java lacks this safety feature and is thus less safe than it should be. Or else you think that preventing data races is not a safety feature.</p>
<p>And so forth.</p>
<p>If you think that unchecked overflows are safe, then I want to hear you argument. On the other hand, nobody cares whether I am right or wrong.</p>
<p>Please offer your insights.</p>
</div>
<ol class="children">
<li id="comment-439422" class="comment even depth-8 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/87591fa8a5d0040dfaf8d3945f347791?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/87591fa8a5d0040dfaf8d3945f347791?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wiktor Wandachowicz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-06T05:17:38+00:00">November 6, 2019 at 5:17 am</time></a> </div>
<div class="comment-content">
<p>In C# programmer decides when to check (or not) for overflows.</p>
<p><a href="https://docs.microsoft.com/en-us/dotnet/csharp/language-reference/language-specification/introduction#statements" rel="nofollow">See example: <strong>checked</strong> and <strong>unchecked</strong> statements</a></p>
<p><code>static void Main() {<br/>
int i = int.MaxValue;<br/>
checked {<br/>
Console.WriteLine(i+1);<br/>
// Exception<br/>
}<br/>
unchecked {<br/>
Console.WriteLine(i+1);<br/>
// Overflow<br/>
}<br/>
}<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-439565" class="comment byuser comment-author-lemire bypostauthor odd alt depth-9">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-06T15:24:49+00:00">November 6, 2019 at 3:24 pm</time></a> </div>
<div class="comment-content">
<p>Looks like a good design.</p>
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
</ol>
</li>
<li id="comment-398674" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/45a0c19f3084d130b5383c2c907fec70?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/45a0c19f3084d130b5383c2c907fec70?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Peter M Ashford</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-01T19:55:46+00:00">April 1, 2019 at 7:55 pm</time></a> </div>
<div class="comment-content">
<p>Oh, absolutely not. I really like a lot of the ideas in Rust &#8211; like borrow checking &#8211; for example. But a lot of the things being listed as unsafe are a little silly &#8211; named parameters for example. It&rsquo;s syntactic sugar and its something that most IDEs make redundant (by displaying the parameter names as you write or introspect the code).<br/>
Don&rsquo;t get me wrong, I think all the features in the article are nice things to have, but if we restricted ourselves to languages that implemented all these, we&rsquo;d exclude pretty much everything on the top of the Tiobe index which is not really a practical or helpful position to take.</p>
</div>
<ol class="children">
<li id="comment-398876" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-02T15:48:15+00:00">April 2, 2019 at 3:48 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>It’s syntactic sugar and its something that most IDEs make redundant (by displaying the parameter names as you write or introspect the code).</p>
</blockquote>
<p>The problem is not that the user can&rsquo;t tell which parameter is which&#8230; the problem is that someone casually reviewing the code will not spot the problem.</p>
</div>
<ol class="children">
<li id="comment-398923" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/45a0c19f3084d130b5383c2c907fec70?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/45a0c19f3084d130b5383c2c907fec70?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Peter M Ashford</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-02T20:07:22+00:00">April 2, 2019 at 8:07 pm</time></a> </div>
<div class="comment-content">
<p>Mouse over function &#8211; parameters appear.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-398626" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/50bc93c10126e018a08f4ee3135d3930?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/50bc93c10126e018a08f4ee3135d3930?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nikolay</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-01T15:32:56+00:00">April 1, 2019 at 3:32 pm</time></a> </div>
<div class="comment-content">
<p>this comment is so far the only sane thing i&rsquo;ve read as part of this idiotic article.</p>
<p>Thank you!</p>
</div>
</li>
</ol>
</li>
<li id="comment-398519" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/87591fa8a5d0040dfaf8d3945f347791?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/87591fa8a5d0040dfaf8d3945f347791?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wiktor Wandachowicz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-01T07:16:22+00:00">April 1, 2019 at 7:16 am</time></a> </div>
<div class="comment-content">
<p>Maybe you could also mention upcoming change in Oracle licensing JDK 11 for commerial use. Otherwise only OpenJDK 11 will stay royalty-free. As stupid as it may be, this only reason may very well bring down the whole Java platform.</p>
<p>See for example:<br/>
<a href="https://www.google.com/search?q=change+in+Oracle+licensing+Java+11" rel="nofollow ugc">https://www.google.com/search?q=change+in+Oracle+licensing+Java+11</a></p>
</div>
<ol class="children">
<li id="comment-398880" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-02T15:52:27+00:00">April 2, 2019 at 3:52 pm</time></a> </div>
<div class="comment-content">
<p>It looks like folks like Amazon are willing to provide support going forward for OpenJDK&#8230;</p>
<p><a href="https://aws.amazon.com/blogs/opensource/amazon-corretto-no-cost-distribution-openjdk-long-term-support/" rel="nofollow ugc">https://aws.amazon.com/blogs/opensource/amazon-corretto-no-cost-distribution-openjdk-long-term-support/</a></p>
<p>So it is unclear to me how Oracle&rsquo;s actions will pan out.</p>
</div>
</li>
</ol>
</li>
<li id="comment-398554" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3f8d556afb5ff8b6d771bcea40f9d230?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3f8d556afb5ff8b6d771bcea40f9d230?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tomas</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-01T09:19:28+00:00">April 1, 2019 at 9:19 am</time></a> </div>
<div class="comment-content">
<p>The 4th point is not an issue. If you use an advanced IDE like IntelliJ IDEA from JetBrains, it will show you argument hints. Also, instead of having a method which takes two arguments, you can have a method which takes a single object with clearly named properties.</p>
</div>
<ol class="children">
<li id="comment-398879" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-02T15:50:38+00:00">April 2, 2019 at 3:50 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>If you use an advanced IDE like IntelliJ IDEA from JetBrains, it will show you argument hints.</p>
</blockquote>
<p>All the time when you browse the code, or just when the intern coded it in two years ago?</p>
</div>
</li>
</ol>
</li>
<li id="comment-398567" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e71a87b8dbbc1564e0da755c4afb9f0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e71a87b8dbbc1564e0da755c4afb9f0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Luke</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-01T11:00:15+00:00">April 1, 2019 at 11:00 am</time></a> </div>
<div class="comment-content">
<p>Ada can handle 1 and 4 and has been able to since Ada83.</p>
<p>Modular types will wrap around, other types will raise an exception.<br/>
Ada allows data races, but you can control that by wrapping inside a protected object when using tasks.<br/>
Ada added &ldquo;not null&rdquo; access types (pointers) to handle this, but it&rsquo;s an afterthought and they&rsquo;re not &ldquo;not null&rdquo; by default.<br/>
You can use named parameters and you can write them in any order you like, as long as they are named.</p>
</div>
</li>
<li id="comment-398576" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/017fdaf98059caf1992a3fcf2799e1b1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/017fdaf98059caf1992a3fcf2799e1b1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Razvan P</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-01T11:35:52+00:00">April 1, 2019 at 11:35 am</time></a> </div>
<div class="comment-content">
<p>No general purpose language is safe, or should be safe given the statements in the blog.</p>
<p>Preventing a memory leak as described would prevent the user to allocate memory when needed. Even if C++ still offers the faster memory allocation, allocating/de-allocating memory is not realtime safe (as it can generate an unexpected delay) and shall be avoided.</p>
<p>My two cents on the issue:<br/>
&#8211; programming languages are generally safe, the problem is that people are not safe.<br/>
&#8211; people safety can be achieved by better management flows (like implementing CMMI), by educating people and/or by adding redundancy in the development (expensive).<br/>
&#8211; there are always syntax candies (named parameters is one) the mainstream languages are missing. Still, I can write a perfectly Object Oriented and structured code in COBOL if needed. If you want to write good code, the key is the mindset, not the language.</p>
</div>
</li>
<li id="comment-398580" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/39c72569abace3705cfaab61cf594d0b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/39c72569abace3705cfaab61cf594d0b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">TheRaven</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-01T11:46:39+00:00">April 1, 2019 at 11:46 am</time></a> </div>
<div class="comment-content">
<p>There are also issues surrounding fuzzing the JVM that further supports arguments against Java safety. Had initially looked forward to developing software in Java, returning to it after many years, only to find that security as well as real world memory issues plague the language. Quite a bit of wasted time and energy -sad, but had to cut off the romance.</p>
</div>
</li>
<li id="comment-398603" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/16d4840a70bc7e181cc23f0db8bcd619?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/16d4840a70bc7e181cc23f0db8bcd619?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jorge sainz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-01T13:32:21+00:00">April 1, 2019 at 1:32 pm</time></a> </div>
<div class="comment-content">
<p>The security with which an application is programmed using any language is relative and depends on the experience of the programmer.</p>
</div>
</li>
<li id="comment-398633" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7d62c6594a2cba5471574c392bf3ac1f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7d62c6594a2cba5471574c392bf3ac1f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">adam felson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-01T15:50:32+00:00">April 1, 2019 at 3:50 pm</time></a> </div>
<div class="comment-content">
<p>Safe in what manner? Any competent programmer will understand variable volatility and overflows. What are actual unsafe practices such as heap/stack overflows into code and the possibility of executing malicious code injected via buffer overflow(s)?</p>
</div>
</li>
<li id="comment-398909" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1c3024e353b9bd0094b0ceaee05f0c97?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1c3024e353b9bd0094b0ceaee05f0c97?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Fernando Arturo Gómez Flores</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-02T18:50:07+00:00">April 2, 2019 at 6:50 pm</time></a> </div>
<div class="comment-content">
<p>Regarding the safety issues here discussed, how safer/unsafer is C# compared to Java? If I recall correctly, C# has the checked/unchecked statements to prevent arithmetic overflow. Although C# explicitly lets you include unsafe code like pointer arithmetic. C# has memory leaks as well, no doubt, and while it has syntactic sugar to allow disposing objects in a deterministic way, it does not enforce it. C# has named arguments, and C# 8 will add nullable reference types, meaning any object will have to have a valid reference and cannot be assigned null unless specifically indicated by the programmer. On the other hand, C# has dynamic objects, which throws type-safety away.</p>
<p>Any thoughts?</p>
</div>
<ol class="children">
<li id="comment-398914" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-02T19:12:40+00:00">April 2, 2019 at 7:12 pm</time></a> </div>
<div class="comment-content">
<p>My own impression is that C# is generally safer, more modern than Java, for many of the reasons you invoke and others as well. C# makes it easier to get multithreading right, for example.</p>
</div>
</li>
<li id="comment-398922" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/16f22ec87b976711a875a505e248c215?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/16f22ec87b976711a875a505e248c215?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Yawar Amin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-02T20:06:20+00:00">April 2, 2019 at 8:06 pm</time></a> </div>
<div class="comment-content">
<p>C#&rsquo;s dynamic objects does not mean that C# is unsafe in general. It means it provides a specific, explicit, escape hatch for when you need to do something not feasible within the type system. For the same reason, Rust&rsquo;s &lsquo;unsafe&rsquo; feature does not mean that Rust is unsafe, it just means there&rsquo;s an escape hatch if you need it.</p>
</div>
</li>
</ol>
</li>
</ol>
