---
date: "2016-12-06 12:00:00"
title: "Don&#8217;t assume that safety comes for free: a Swift case study"
index: false
---

[19 thoughts on &ldquo;Don&#8217;t assume that safety comes for free: a Swift case study&rdquo;](/lemire/blog/2016/12-06-dont-assume-that-safety-comes-for-free-a-swift-case-study)

<ol class="comment-list">
<li id="comment-261805" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3056f1011deed57876c4a08713f0e1e7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3056f1011deed57876c4a08713f0e1e7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://www.pelock.com" class="url" rel="ugc external nofollow">Bartosz WÃ³jcik</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-06T23:02:56+00:00">December 6, 2016 at 11:02 pm</time></a> </div>
<div class="comment-content">
<p>Exceptions on 64 bit overflows? I guess every crypto code written in Swift needs to use this &ldquo;unsafe&rdquo; notation (I wonder if the compiler throws countless warnings about it?). I&rsquo;m from the old school of x86 assembly and I never like signed integers in HLL languages and even worse &#8211; lack of unsigned integers (Java), because to me and the hardware they are natural things, but this &ldquo;invention&rdquo; goes against the hardware CPU design, if it doesn&rsquo;t trigger an exception in low level code why should it crash in high level? God damn future&#8230;</p>
</div>
<ol class="children">
<li id="comment-261810" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-07T01:10:36+00:00">December 7, 2016 at 1:10 am</time></a> </div>
<div class="comment-content">
<p><em>Exceptions on 64 bit overflows?</em></p>
<p>It is a runtime assert. The program crashes.</p>
<p><em>I guess every crypto code written in Swift needs to use this â€œunsafeâ€ notation (I wonder if the compiler throws countless warnings about it?).</em></p>
<p>The compiler won&rsquo;t complain, this is at runtime. You can use &ldquo;+&rdquo; for checked additions, and the ampersand notation for unchecked overflow. If you do want unchecked overflows, then you have to use the ampersand notation.</p>
<p><em>I&rsquo;m from the old school of x86 assembly and I never like signed integers in HLL languages and even worse â€“ lack of unsigned integers (Java), because to me and the hardware they are natural things, but this â€œinventionâ€ goes against the hardware CPU design, if it doesn&rsquo;t trigger an exception in low level code why should it crash in high level? God damn futureâ€¦</em></p>
<p>You are right that there is a mismatch between hardware and software. See John Regher&rsquo;s blog post (link at the bottom).</p>
</div>
</li>
</ol>
</li>
<li id="comment-261840" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/648cbb3135d4aa4ca7fc2a7849d7acd2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/648cbb3135d4aa4ca7fc2a7849d7acd2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://cs.coloradocollege.edu/~bylvisaker/" class="url" rel="ugc external nofollow">Ben</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-07T13:28:26+00:00">December 7, 2016 at 1:28 pm</time></a> </div>
<div class="comment-content">
<p>In my fantasy world, a decade or two from now it will be mainstream for programs to be written in the more abstract style and for compilers to prove that fancy optimizations are safe (in the cases when they are actually safe, of course). This has been some people&rsquo;s fantasy for at least a generation or two, but it feels like we&rsquo;re actually getting closer to having this technology (see, e.g., seL4 and CompCert).</p>
<p>The difference between &ldquo;safe&rdquo; and safe is interesting. I would characterize it as the difference between avoiding certain implementation-level bad behaviors versus ensuring that an application behaves sensibly in terms of high-level behavior. The latter is much harder in general, but I still believe the former has value.</p>
<p>Your analogy with optical illusions feels a little off to me. Natural neural systems have tons of checks and balances to increase the likelihood of reasonable behavior. If software goes out of its intended execution path (for example via numerical overflow), it is much less likely that the result will be acceptable.</p>
</div>
<ol class="children">
<li id="comment-261851" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-07T16:40:25+00:00">December 7, 2016 at 4:40 pm</time></a> </div>
<div class="comment-content">
<p><em>Your analogy with optical illusions feels a little off to me. Natural neural systems have tons of checks and balances to increase the likelihood of reasonable behavior. </em></p>
<p>Good engineering is not about preventing faults at a high cost. It is about managing the damages when faults occur. </p>
<p>Your software *will* fail. There is no getting around that. Thinking that &ldquo;safe&rdquo; software is software that does not fail is wrong.</p>
<p>So what we do when problems occur matters a great deal. Is &ldquo;falling dead&rdquo; the right approach?</p>
</div>
<ol class="children">
<li id="comment-261920" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/648cbb3135d4aa4ca7fc2a7849d7acd2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/648cbb3135d4aa4ca7fc2a7849d7acd2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://cs.coloradocollege.edu/~bylvisaker/" class="url" rel="ugc external nofollow">Ben</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-08T13:58:26+00:00">December 8, 2016 at 1:58 pm</time></a> </div>
<div class="comment-content">
<p>&gt; Good engineering is not about preventing faults at a high cost. It is about managing the damages when faults occur.</p>
<p>I think you&rsquo;ve stated this too strongly. Good engineering practice involves both avoiding and managing problems. Even some of the &ldquo;move fast and break things&rdquo; zealots acknowledge that it&rsquo;s possible to take that motto too far.</p>
<p>&gt; So what we do when problems occur matters a great deal. Is â€œfalling deadâ€ the right approach?</p>
<p>Of course not, at least from a complete system perspective. But languages like C and C++ by default allow suspicious things like numerical overflow and out-of-bounds accesses to go by unnoticed. It&rsquo;s hard to take any compensatory action when the system doesn&rsquo;t notice there&rsquo;s a problem.</p>
<p>I have very little experience with Swift, and I think immediately killing the process might be too severe. But even that approach can be managed by having another process monitoring the application and restarting it as needed.</p>
</div>
<ol class="children">
<li id="comment-261921" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-08T14:33:08+00:00">December 8, 2016 at 2:33 pm</time></a> </div>
<div class="comment-content">
<p><em>I think you&rsquo;ve stated this too strongly.</em></p>
<p>Millions of people die in car accidents. We could prevent all of it if we built cars like tanks. We don&rsquo;t all drive military-grade tanks because costs matter. We accept that there will be accidents and failures. If you design things with the assumption that you can make the faults go away, your costs will be out of this world or you&rsquo;ll fool yourself, and when a fault does occur it will be terrible because unplanned for.</p>
<p>The choice Swift makes is to indeed assume that there will be overflows, but then that when they occur, a crash is harmless enough.</p>
<p><em>But languages like C and C++ by default allow suspicious things like numerical overflow and out-of-bounds accesses to go by unnoticed.</em></p>
<p>With clang and GNU GCC, you can compile you C and C++ code with runtime checks:<br/>
<a href="https://lemire.me/blog/2016/04/20/no-more-leaks-with-sanitize-flags-in-gcc-and-clang/" rel="ugc">http://lemire.me/blog/2016/04/20/no-more-leaks-with-sanitize-flags-in-gcc-and-clang/</a></p>
<p>I presume that most industrial-strength C and C++ compilers must have similar capabilities. Of course, it comes with a performance penalty.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-261860" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/325a809e0b59a9cbfce62cbcb48c6506?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/325a809e0b59a9cbfce62cbcb48c6506?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Yathaid</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-07T18:58:11+00:00">December 7, 2016 at 6:58 pm</time></a> </div>
<div class="comment-content">
<p>Well, this is kinda implementation specific. By implementation, I mean the compiler and the runtime provided by the language. There are arguments to be made in favor of Rust where the abstraction still does not pay a cost in runtime: <a href="https://ruudvanasseldonk.com/2016/11/30/zero-cost-abstractions" rel="nofollow ugc">https://ruudvanasseldonk.com/2016/11/30/zero-cost-abstractions</a></p>
</div>
<ol class="children">
<li id="comment-261864" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-07T19:24:57+00:00">December 7, 2016 at 7:24 pm</time></a> </div>
<div class="comment-content">
<p>My blog post was about safety (overflow checks). I guess you refer to something else, which is the &ldquo;cost&rdquo; of abstraction (functional programming idioms in this case). Then, sure, I was surprised that the reduce approach was slower than the loop approach myself and I don&rsquo;t think that the reason for the performance difference is all that clear.</p>
<p>I would like you to consider the following points:</p>
<p>1. Rust (in release mode) does not check for overflows unlike Swift. So it is not directly comparable with Swift.</p>
<p>2. There are plenty of cases where Swift, Rust, JavaScript, C++, and Java, will have the same performance whether using loops or functional programming idioms&#8230; but this, by itself, does not prove that abstraction does not have a performance cost. There are definitively cases where functional programming idioms have a performance cost (as shown here).</p>
</div>
</li>
</ol>
</li>
<li id="comment-261900" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/278764f4cefc97b94f5748f722ecf53b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/278764f4cefc97b94f5748f722ecf53b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Matthew Self</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-08T05:20:09+00:00">December 8, 2016 at 5:20 am</time></a> </div>
<div class="comment-content">
<p>An Ariane V rocket was destroyed during takeoff because the guidance software (written in Ada) caused an overflow that caused the program to halt. The computation being performed wasn&rsquo;t even needed for flight, but was running anyway.</p>
</div>
</li>
<li id="comment-270484" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7fa8ca92a2857976d4a322810cba6400?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7fa8ca92a2857976d4a322810cba6400?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://duriansoftware.com" class="url" rel="ugc external nofollow">Joe Groff</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-08T23:28:16+00:00">February 8, 2017 at 11:28 pm</time></a> </div>
<div class="comment-content">
<p>We looked at your `reduce` example, and in the latest compiler, it appears that the for loop and reduce get essentially equivalent performance now:</p>
<p>Array_for: 0m1.675s user time</p>
<p>Array_reduce: 0m1.638s time</p>
<p>Thanks for the test case!</p>
</div>
<ol class="children">
<li id="comment-270497" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-09T00:21:57+00:00">February 9, 2017 at 12:21 am</time></a> </div>
<div class="comment-content">
<p>Any chance you might look at my post <a href="https://lemire.me/blog/2017/01/23/resizing-arrays-can-be-slow-in-swift/">Resizing arrays can be slow in Swift</a>?</p>
</div>
<ol class="children">
<li id="comment-270505" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7fa8ca92a2857976d4a322810cba6400?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7fa8ca92a2857976d4a322810cba6400?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://duriansoftware.com" class="url" rel="ugc external nofollow">Joe Groff</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-09T00:40:56+00:00">February 9, 2017 at 12:40 am</time></a> </div>
<div class="comment-content">
<p>We do have a known issue that `isUniquelyReferenced` checks don&rsquo;t get hoisted out of an `append` loop. That might account for part of the problem there. I&rsquo;ll file a bug to make sure we investigate.</p>
</div>
<ol class="children">
<li id="comment-270515" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-09T01:14:02+00:00">February 9, 2017 at 1:14 am</time></a> </div>
<div class="comment-content">
<p>Thanks. My argument is that this should never be the fastest way to do things&#8230;</p>
<pre>
func extendArray(_ x : inout [Int], size: Int) 
         -> [Int] {
   var answer = Array(repeating: 0, count: size)
   for i in 0..&lt;x.count {
     answer[i] = x[i]
   }
   x = answer
}
</pre>
<p>If that&rsquo;s the fast way, then performance is left on the table.</p>
</div>
<ol class="children">
<li id="comment-270535" class="comment odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7fa8ca92a2857976d4a322810cba6400?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7fa8ca92a2857976d4a322810cba6400?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://duriansoftware.com" class="url" rel="ugc external nofollow">Joe Groff</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-09T02:51:53+00:00">February 9, 2017 at 2:51 am</time></a> </div>
<div class="comment-content">
<p>By all means, that&rsquo;s a deficiency in Swift&rsquo;s optimizer. There is another way to initialize the array, using the initializer from another Sequence:</p>
<p>x = Array((0..&lt;size).lazy.map { $0 &lt; x.count ? x[i] : 0 })</p>
<p>which will avoid the initial cost of bzero-ing the array buffer, but isn&#039;t always the clearest way to express the initialization.</p>
</div>
<ol class="children">
<li id="comment-270545" class="comment byuser comment-author-lemire bypostauthor even depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-09T03:35:26+00:00">February 9, 2017 at 3:35 am</time></a> </div>
<div class="comment-content">
<p>I think that this syntax <tt>x = Array((0..&lt;size).lazy.map { $0 &lt; x.count ? x[$0] : 0 })</tt> in Swift is very elegant. I&rsquo;ll remember it. </p>
<p>Elegance aside, I am not sure it is necessarily very fast given the current state of Swift. Granted, in principle, it could be fast, but it would require lots of work from the compiler.</p>
<p>This would make for a long exchange, but I am not sure that map/filter are well suited to high performance computing. They can be slower than simple old-fashioned procedural code because the latter is more transparent to the compiler&#8230; especially as you chain them.</p>
<p>Anyhow. </p>
<p>I find that your proposal is a tad slower than <tt>x += repeatElement(0,count:newcount)</tt>, and that&rsquo;s not the fastest way.</p>
<p>They are both easily 3x slower than they should be.</p>
</div>
<ol class="children">
<li id="comment-270668" class="comment odd alt depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7fa8ca92a2857976d4a322810cba6400?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7fa8ca92a2857976d4a322810cba6400?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://duriansoftware.com" class="url" rel="ugc external nofollow">Joe Groff</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-09T16:31:21+00:00">February 9, 2017 at 4:31 pm</time></a> </div>
<div class="comment-content">
<p>There&rsquo;s no fundamental reason the `lazy` variations of `map` and `filter` should be slower than a loop. They&rsquo;re fully inlinable and don&rsquo;t produce temporary copies, only &ldquo;views&rdquo; over the underlying collection. It sounds like Xcode 8&rsquo;s compiler had some problems optimizing away closure overhead, hence the perf difference you saw between `reduce` and the for loop, but those issues seem to be fixed in 8.3 beta 1. I just tried this, and consistently get ~17% better results with &ldquo;B&rdquo;:</p>
<p>import Dispatch</p>
<p>var x = Array(repeating: 1738, count: 1_000_000)<br/>
var sink = x</p>
<p>print(&ldquo;A:&rdquo;)<br/>
print(dispatch_benchmark(1_000) {<br/>
var answer = Array(repeating: 0, count: 2_000_000)<br/>
for i in 0 ..&lt; x.count {<br/>
answer[i] = x[i]<br/>
}<br/>
// Prevent `answer` from being DCE&#039;d<br/>
sink = answer<br/>
})</p>
<p>print(&quot;B:&quot;)<br/>
print(dispatch_benchmark(1_000) {<br/>
var answer = Array((0..&lt;2_000_000).lazy.map { $0 &lt; x.count ? x[$0] : 0 })<br/>
// Prevent `answer` from being DCE&#039;d<br/>
sink = answer<br/>
})</p>
<p>Perhaps neither is still as fast as it should be yet, but we&#039;re working on it!</p>
</div>
<ol class="children">
<li id="comment-270674" class="comment byuser comment-author-lemire bypostauthor even depth-8">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-09T17:05:52+00:00">February 9, 2017 at 5:05 pm</time></a> </div>
<div class="comment-content">
<p><em>those issues seem to be fixed in 8.3 beta 1</em></p>
<p>Excellent!</p>
</div>
</li>
<li id="comment-270687" class="comment byuser comment-author-lemire bypostauthor odd alt depth-8 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-09T18:06:09+00:00">February 9, 2017 at 6:06 pm</time></a> </div>
<div class="comment-content">
<p>By the way, please do not think that I am trying to take down Swift. I am a fan.</p>
</div>
<ol class="children">
<li id="comment-270743" class="comment even depth-9">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7fa8ca92a2857976d4a322810cba6400?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7fa8ca92a2857976d4a322810cba6400?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://duriansoftware.com" class="url" rel="ugc external nofollow">Joe Groff</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-09T21:58:00+00:00">February 9, 2017 at 9:58 pm</time></a> </div>
<div class="comment-content">
<p>No problem at all! I appreciate that you&rsquo;re finding and raising all these performance issues; it gives us motivation to fix them!</p>
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
</ol>
</li>
</ol>
</li>
</ol>
