---
date: "2016-06-21 12:00:00"
title: "I do not use a debugger"
index: false
---

[94 thoughts on &ldquo;I do not use a debugger&rdquo;](/lemire/blog/2016/06-21-i-do-not-use-a-debugger)

<ol class="comment-list">
<li id="comment-244847" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f7233687203d846a04f461a3ad9c3bfe?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f7233687203d846a04f461a3ad9c3bfe?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">M. Eric DeFazio</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-21T15:06:20+00:00">June 21, 2016 at 3:06 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve always felt like I missed the boat on the value of debuggers. A coworker once showed me how &ldquo;cool&rdquo; it was that he had a remote debugger running on a Server stepping through code and looking at the state of things&#8230; it occurred to me that the tool was needed BECAUSE the code was a mess, (too many &ldquo;smart&rdquo;/hierarchical/mutable objects interacting with each other). </p>
<p>I do see the value of using a debugger to understand code you don&rsquo;t own&#8230;but there is always the idea that you ended up using a debugger because you really don&rsquo;t understand the model and state transitions the program can go through. If that is the case, time should be spent figuring out the model and state transitions in a top down way&#8230; rather than iterating on figuring out where the model and or transitions are broken (in a bottom up way) by figuring out the appropriate places to put breakpoints. (But I guess this is an art in and of itself)</p>
</div>
<ol class="children">
<li id="comment-245999" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1155be1ed8e9c17511be9479582238e1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1155be1ed8e9c17511be9479582238e1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://blog.jooq.org" class="url" rel="ugc external nofollow">Lukas Eder</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-02T14:24:25+00:00">July 2, 2016 at 2:24 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>time should be spent figuring out the model and state transitions in a top down way</p></blockquote>
<p>Excellent! Just put a breakpoint in your main() method, and step into each relevant method, seeing what&rsquo;s going on.</p>
</div>
</li>
</ol>
</li>
<li id="comment-244864" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9781c89fde560ae6e0c030a90ceb87e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9781c89fde560ae6e0c030a90ceb87e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://wiip.fr" class="url" rel="ugc external nofollow">Maxence</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-21T17:04:47+00:00">June 21, 2016 at 5:04 pm</time></a> </div>
<div class="comment-content">
<p>A debugger is a very useful tool. I think people which are not using them is people who have catch bad habits while working in environments where there was no good debugger. When you work with Visual Studio with its marvelous debugger, you can find and resolve bugs faster. Of course, you can always think harder to the problem and review your code, but when you&rsquo;re tired, the debugger is a nice helper.</p>
</div>
<ol class="children">
<li id="comment-244871" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-21T18:12:30+00:00">June 21, 2016 at 6:12 pm</time></a> </div>
<div class="comment-content">
<p><em> I think people which are not using them is people who have catch bad habits while working in environments where there was no good debugger.</em></p>
<p>Good debuggers are hardly new. Turbo Pascal had a fantastic debugger three decades ago, and even then it wasn&rsquo;t a particularly innovative feature. A debugger is a very widely available tool and it has been so for many decades. IDEs (with debuggers) are also widely available and have been for a very long time&#8230; E.g., Visual Studio, Eclipse, Intellij, KDevelop and so forth.</p>
<p>There are a few small things that have improved with respect to debuggers&#8230; such as backward execution, remote cross-platform debugging, pretty-printing STL data structures&#8230; but overall, debuggers have not changed very much. </p>
<p>IDEs have gotten quite a bit nicer and smarter&#8230; Do IDEs make you more productive? That&rsquo;s another debate.</p>
<p><em>Of course, you can always think harder to the problem and review your code, but when you&rsquo;re tired, the debugger is a nice helper.</em></p>
<p>I agree that using tools to make yourself more effective, especially when you are cognitively impaired in some way, is very important. But in most cases there are better tools than a debugger.</p>
</div>
</li>
<li id="comment-497292" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/26877f0e5c6f79952314beab2a6a7ab8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/26877f0e5c6f79952314beab2a6a7ab8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Paul Carroll</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-21T06:22:53+00:00">March 21, 2020 at 6:22 am</time></a> </div>
<div class="comment-content">
<p>The corollary to that however is that <em>you</em> may find the bug quickly on <em>your</em> machine, but when you come to debugging something on a SIT, UAT or (god forbid) PROD machine/cluster/network you are doomed.</p>
<p>This is why, having followed a similar career path to OP, I have switched to good old trusty debug logging where the parallelism is strikingly apparent. Terse injection of variable is immeasurably useful and rather akin to watch variables&#8230; not only that, but they translate to others that may have to maintain/debug your code, oh and they jog you memory as to how the code can/needs to be debugged.</p>
<p>Each to his own of course, but I enjoy my new perspective FWIW.</p>
</div>
</li>
</ol>
</li>
<li id="comment-244874" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/35539930e432fdb79795a0f5ed4326e2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/35539930e432fdb79795a0f5ed4326e2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.tripleboot.org" class="url" rel="ugc external nofollow">Henry Skoglund</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-21T19:25:17+00:00">June 21, 2016 at 7:25 pm</time></a> </div>
<div class="comment-content">
<p>I also shy from using the debugger, main reason for me is to avoid the overhead of switching context, i.e. one minute you&rsquo;re in your familiar IDE editing your program, and the next you&rsquo;re in a different environment with new windows (the debugger).</p>
<p>It&rsquo;s like watching 2 movies at the same time.</p>
<p>It&rsquo;s much less burden for my tiny brain to just insert some printf()s where my code is suspect and watch that output.</p>
</div>
</li>
<li id="comment-244876" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f9ed6413b67cfa6ddc0a37675d9e065a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f9ed6413b67cfa6ddc0a37675d9e065a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stefano Miccoli</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-21T20:03:56+00:00">June 21, 2016 at 8:03 pm</time></a> </div>
<div class="comment-content">
<p>My two cents is that for me <a href="https://en.wikipedia.org/wiki/Assertion_(software_development)" rel="nofollow"><code>assert</code></a> and <code>print</code> are by far the most useful debugging tools, in a wide range of programming paradigms.</p>
<p>Well designed <code>assert</code>s are helpful for both catching logic errors and documenting the code. In fact <code>assert</code>s explicitly highlight assumptions about the algorithm state that otherwise could go unnoticed.</p>
<p>As Daniel Lemire correctly points out, one should not focus its attention on <em>where</em> the code is wrong, but on <em>why</em> the code is wrong, and <code>assert</code>s are ideal to this purpose.</p>
<p>As what regards <code>print</code> statements, they are the poor man&rsquo;s debugger, but somehow I learned to cope with the fact that I&rsquo;m a poor man, without the energy for mastering a high polish modern debugger tool&#8230;</p>
</div>
<ol class="children">
<li id="comment-244981" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/648cbb3135d4aa4ca7fc2a7849d7acd2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/648cbb3135d4aa4ca7fc2a7849d7acd2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ben</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-22T13:01:13+00:00">June 22, 2016 at 1:01 pm</time></a> </div>
<div class="comment-content">
<p>I also try to write as many good assertions as I can in my code. There&rsquo;s also the new-ish thing in reliability: property based testing (a la QuickCheck). I like to think of property based testing as somewhere in the nebulous space between conventional use of assertions and full-blown formal verification. Doing property based testing well involves thinking carefully about the logical properties that your code relies on and adheres to, which I think is usually a good investment.</p>
</div>
</li>
<li id="comment-653400" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7087b666ddddeafee8d799b31ca4479b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7087b666ddddeafee8d799b31ca4479b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Gabriel THOMAS</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-08-02T08:56:32+00:00">August 2, 2023 at 8:56 am</time></a> </div>
<div class="comment-content">
<p>Great : each IDE is so much work to learn it. I agree.</p>
</div>
</li>
</ol>
</li>
<li id="comment-244909" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/46f8d282d1f946c9ffe6fc1e71d93b43?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/46f8d282d1f946c9ffe6fc1e71d93b43?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">ok</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-22T01:47:52+00:00">June 22, 2016 at 1:47 am</time></a> </div>
<div class="comment-content">
<p>I use frameworks like spring-boot. And with dependency injection its sometimes hard to figure out, why i get a result that i did not expect. So i use the debugger to get a feeling, what is called and how that thing has been wired together and where the part actually is, that produces my result. That helps me.</p>
</div>
</li>
<li id="comment-244942" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7843307a1f8a74b602624c5a3f15d71c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7843307a1f8a74b602624c5a3f15d71c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tomasz Jamroszczak</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-22T07:35:34+00:00">June 22, 2016 at 7:35 am</time></a> </div>
<div class="comment-content">
<p>When showing disregard to debuggers, people usually make very serious assumptions.</p>
<p>1. Debug printfs are better than debugger. In reality, it&rsquo;s easier to set up ad debug printf inside debugger than inline. So the distinction debug printf vs. debugger is a false one.</p>
<p>2. It&rsquo;s better to know and understand your code. For sure it is, but frequently you just cannot. Imagine code with poor quality, written by strangers, as a quick hacky proof of concept and developed for the next ten years in the same manner. You don&rsquo;t have infinite time to make mental model of the code and finding flow is hard in itself, so then debugger greatly speeds up the process by simply showing call stack and state of local variables. Or imagine implementation of simple graph algorithm &#8211; without drawing it on a piece of paper it&rsquo;s hard to grasp what&rsquo;s going on, even if it is short, well structured, with comments and unit tests and functional tests. It&rsquo;s easier to use debugger with conditional statements to figure out what to write with pen and paper.</p>
<p>That&rsquo;s the same argument mathematicians did with regards to mathematical proofs: I don&rsquo;t need no tools other than those from primary school to do maths. And then came four color theorem proof.</p>
<p>3. It&rsquo;s better to have tests. But what if there&rsquo;s a bug without a test for it? In case of Linux kernel it&rsquo;s relatively easy to use sheer power of your mind, especially when you&rsquo;re authoritarian who&rsquo;ve seen all the changes. Try to do the same with UI code of Chromium with hundreds of committers and frequent serious redesigns. </p>
<p>What if the tests are unstable? What if the tests started failing because of two different, on a first glance not connected reasons, and one of the reason was introduced into code few months ago in place you&rsquo;re not familiar with?</p>
<p>Again, it&rsquo;s false dichotomy.</p>
<p>4. I own the code, thus I have the obligation to understand it now and for the future. But what if you have to understand minified JavaScript of a random webpage without contacting its authors?</p>
<p>5. In some cases some people don&rsquo;t need debuggers, thus debuggers are superfluous. Those people are famous, so they have to be right. Typical demagogy.</p>
<p>6. Editor and debugger are distinct environments. Well, no, IDE contains both editor and debugger.</p>
<p>7. I dislike Microsoft so I don&rsquo;t consider Visual Studio debugger as a decent tool just because.</p>
<p>8. I mainly program in languages which debuggers are inferior or with operating systems on which debuggers are inferior thus all debuggers are unusable.</p>
</div>
<ol class="children">
<li id="comment-244987" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7301d4aece2b460211db202de13f1d05?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7301d4aece2b460211db202de13f1d05?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mat</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-22T13:34:13+00:00">June 22, 2016 at 1:34 pm</time></a> </div>
<div class="comment-content">
<p>Thank you!</p>
</div>
</li>
<li id="comment-244989" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-22T13:50:31+00:00">June 22, 2016 at 1:50 pm</time></a> </div>
<div class="comment-content">
<p>It seems that a lot of your argument is that using tools can make you more productive. I agree with that. </p>
<p>Some comments&#8230;</p>
<p>Tools are not neutral. Some systems discourage good practices like clean maintainable code and systematical testing. Getting people to use tools to cope with crappy code instead of having them fix the crappy code is not a net win.</p>
<p><em> It&rsquo;s better to have tests. But what if there&rsquo;s a bug without a test for it?</em></p>
<p>Then write one. I sure hope you are not trying to fix bugs without systematic testing. It is not 1985 anymore.</p>
<p>I won&rsquo;t blame you for using a debugger&#8230; but I will certainly blame you for working without systematic testing.</p>
<p><em>Try to do the same with UI code of Chromium with hundreds of committers and frequent serious redesigns.</em></p>
<p>I sure hope that Chromium is not held together by people running the code line-by-line in a debugger.</p>
<p><em>Those people are famous, so they have to be right.</em></p>
<p>That&rsquo;s not my argument. My argument is that if these highly productive programmers do well without debuggers&#8230; then it tells us something. Short answer: debuggers are not required to be highly productive. Note that it does not tell us that using a debugger prevents you from being productive. Donald Knuth, for example, uses debuggers.</p>
<p><em>I dislike Microsoft so I don&rsquo;t consider Visual Studio debugger as a decent tool just because.</em></p>
<p>I am unclear why Microsoft keep popping up in this thread. I don&rsquo;t think I mention Microsoft in my post. It is irrelevant.</p>
<p><em>I mainly program in languages which debuggers are inferior or with operating systems on which debuggers are inferior thus all debuggers are unusable.</em></p>
<p>I am not sure what these languages or systems are. JavaScript used to have poor support for debuggers, maybe that&rsquo;s what you have in mind, but that has changed in recent years. It is fairly easy to use a debugger with JavaScript today.</p>
</div>
</li>
</ol>
</li>
<li id="comment-244949" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1a4fb7cb821400e179ba75d466ae8326?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1a4fb7cb821400e179ba75d466ae8326?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Damien C.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-22T08:16:12+00:00">June 22, 2016 at 8:16 am</time></a> </div>
<div class="comment-content">
<p>I would like to know how those people do to find memory leaks in a monstruous piece of very bad code that has been managed by other people during 10 years (and of course you&rsquo;re unable to use precious things like valgrind and others).</p>
<p>I have a limited use of debuggers but there are cases where they are just usefull.</p>
</div>
<ol class="children">
<li id="comment-359515" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/14ffa3e0a86607175971ead35d1b717f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/14ffa3e0a86607175971ead35d1b717f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Frans O.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-23T15:46:31+00:00">October 23, 2018 at 3:46 pm</time></a> </div>
<div class="comment-content">
<p>@Damien C.: Valgrind is precious, I agree. If you cannot use that, then &#8212; if you are able to reconfigure your build and recompile your code &#8212; there are various wrappers for C standard library memory allocation API (malloc, realloc, calloc, strdup, free, maybe others) that help finding memory leaks. GNU C library also allows registering hook functions for those functions (see <a href="https://www.gnu.org/software/libc/manual/html_node/Hooks-for-Malloc.html" rel="nofollow ugc">https://www.gnu.org/software/libc/manual/html_node/Hooks-for-Malloc.html</a>). There seems to be also builtin support for malloc debugging within GNU C library itself (see <a href="https://www.gnu.org/software/libc/manual/html_node/Heap-Consistency-Checking.html" rel="nofollow ugc">https://www.gnu.org/software/libc/manual/html_node/Heap-Consistency-Checking.html</a>). With LD_PRELOAD_PATH trick on Linux and perhaps using other methods in other platforms, you could override the malloc functions with your own versions. I do not see how debuggers help you find the location of memory leaks, as for big application there are so much to look for without indications given by these kind of tools.</p>
</div>
</li>
</ol>
</li>
<li id="comment-244966" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c45e71faa10cc2ba781366e5da097bea?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c45e71faa10cc2ba781366e5da097bea?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Gerome Datenblatt</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-22T11:59:58+00:00">June 22, 2016 at 11:59 am</time></a> </div>
<div class="comment-content">
<p>The article is correctly arguing but wrongly labeled. It is in almost all cases correct not to use a debugger &#8230; to single-step through code. But there are plenty of other things debuggers do. The most important one for me may be the ability to add printfs into an executable while it is running or even after it has failed. In case of hard-to-trigger bugs that may save crucial time that is otherwise spend on reproducing the failure. I also often use the debugger as disassembler of the important parts to check wether the compiler actually agreed with me that some abstraction was zero-overhead or some optimization might be a good idea.</p>
<p>That said, most languages come with debuggers worse than those of Turbo Pascal, so spending time to learn to use one may be wasted effort nonetheless.</p>
</div>
</li>
<li id="comment-245000" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/144f9ba23a545e47d7fe9523700383a5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/144f9ba23a545e47d7fe9523700383a5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tropper</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-22T15:46:27+00:00">June 22, 2016 at 3:46 pm</time></a> </div>
<div class="comment-content">
<p>I feel bad for your students. I agree that a most simple bugs can be detected just by thinking about what happen, what should happen and how the code looks. And I also agree that there are cases where it is really hard to use a debugger.</p>
<p>But: all in all not using a debugger and saying it is useless is one of the dumbest things i&rsquo;ve heard in a long time. I&rsquo;ve seen people &ldquo;not using a debugger&rdquo; &#8211; and if they would knew how to use a debugger properly they could says so much time.</p>
<p>And for the println/assert guys:<br/>
&#8211; assert are just are poor mens unit test. You wouldn&rsquo;t need them if you had proper units test.<br/>
&#8211; using logs to monitor a running system is fine. But using println to find a bug on your local system is most inefficient way to do it. And if you teach your student such nonsense they will have a pretty hard time in there professional life.</p>
</div>
<ol class="children">
<li id="comment-245681" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/96de880b33a52b3646e1535c2380afd4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/96de880b33a52b3646e1535c2380afd4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Igmar Palsenberg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-29T14:09:33+00:00">June 29, 2016 at 2:09 pm</time></a> </div>
<div class="comment-content">
<p>Debuggers tend to become decreasingly useful, especially if you have high-volume throughput systems that are full of async code. Debuggers are pretty useless here, since the debugger state usually doesn&rsquo;t match up reality.</p>
<p>We tend to have a lot of error checking and asserts in code, since they tell is we have a real problem. We use debuggers, but mainly as a tool to catch certain asserts (which don&rsquo;t always directly show the root cause), and as a means to see state at a certain point, without having to dig though a logfile that spits out 4000 lines of debug info for every request.</p>
<p>It&rsquo;s also pretty difficult to unit test bugs that happen to pop up very infrequent, and only occur in certain situations, when certain messages arrive in a certain order. I&rsquo;ve had asserts catch more then the unit tests.</p>
</div>
</li>
<li id="comment-245722" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f9ed6413b67cfa6ddc0a37675d9e065a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f9ed6413b67cfa6ddc0a37675d9e065a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stefano Miccoli</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-29T20:48:09+00:00">June 29, 2016 at 8:48 pm</time></a> </div>
<div class="comment-content">
<p>In my (limited) experience, unit testing and <code>assert</code>s lie on almost orthogonal dimensions: you cannot substitute one for the other. Suppose you are developing a CUDA kernel, say for some linear algebra algorithm: a few well designed <code>assert</code>s can catch bugs that are very hard to even notice by unit testing. On the contrary, without unit testing, broken but &ldquo;formally correct&rdquo; portions of code do not trigger any assertion failure&#8230;</p>
</div>
</li>
<li id="comment-300837" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/adec8399b3b08f70ab473a33ffc942d5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/adec8399b3b08f70ab473a33ffc942d5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Joe</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-16T20:39:43+00:00">April 16, 2018 at 8:39 pm</time></a> </div>
<div class="comment-content">
<p>An assert works always, not only on a particular set of inputs.</p>
</div>
</li>
</ol>
</li>
<li id="comment-245001" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fb989b04d9d7fc932822a548ea4387a4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fb989b04d9d7fc932822a548ea4387a4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://imgur.com/PKdkoUE" class="url" rel="ugc external nofollow">Roger</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-22T16:02:28+00:00">June 22, 2016 at 4:02 pm</time></a> </div>
<div class="comment-content">
<p>I can see some of the points you&rsquo;re getting at, but I found the following amusing.</p>
<p><a href="http://imgur.com/PKdkoUE" rel="nofollow ugc">http://imgur.com/PKdkoUE</a></p>
</div>
</li>
<li id="comment-245002" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9788f13f9c118c750a09f4d5165a08fe?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9788f13f9c118c750a09f4d5165a08fe?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Vinod Khare</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-22T16:06:06+00:00">June 22, 2016 at 4:06 pm</time></a> </div>
<div class="comment-content">
<p>I agree with what you say. I tend to use debuggers as glorified print statements. With a debugger, I don&rsquo;t need to write a print statement for every variable I need to watch, all variable values are available when a breakpoint is hit.</p>
<p>One important information that a debugger offers is the stack trace which is very useful especially when debugging event based software. Stack traces are hard to obtain with simple printfs.</p>
</div>
<ol class="children">
<li id="comment-245014" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-22T17:07:25+00:00">June 22, 2016 at 5:07 pm</time></a> </div>
<div class="comment-content">
<p>Stack traces are very useful when you can get them. As Java demonstrates however, it does not require a debugger.</p>
</div>
</li>
</ol>
</li>
<li id="comment-245063" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Simon Hardy-Francis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-22T22:47:32+00:00">June 22, 2016 at 10:47 pm</time></a> </div>
<div class="comment-content">
<p>I also stopped using a debugger and over 15 years ago. The reason for this is that debuggers are not that useful if the program being debugged is multi-threaded. Instead, logs are useful. And once you start down the path of logging then there&rsquo;s almost no need for the debugger. Plus logs are universal but your favorite debugger feature might be available only in gdb but not in the Windows or embedded system debugger.</p>
<p>I&rsquo;ve worked on a few bigger projects which have the printf()s embedded all the time in what could be called &lsquo;permanent instrumentation&rsquo;. In these projects then it was possible to build a debug version of the program which contained all printf()s for all levels of verbosity. And you could also build a non-debug version which had most of the printf()s stripped out. The debug versions also supported special function entry and exit printf()s in order to format the resulting log hierarchically to show something similar to the stack trace but for the entire run-time call tree, i.e. you can see the last assert in the log, see the printf()s before it, see the called function, and all the other called functions before it.</p>
<p>As a side note, I&rsquo;ve also developed techniques in the past to automatically instrument C functions with entry and exit printf()s. It&rsquo;s a useful technique to comprehend a new source base faster. For example, I tried it on WebKit which was about 500 MB of source code and just too big to look through! I also have a prototype somewhere for automatically instrumenting projects without changing one line of source code or make file. I remember it worked pretty well on the NGINX and Tor code bases. It worked by pretending to be the compiler (e.g. CC=secretly_instrument make) and then during the compile of the debug version it would secretly generate assembly output, and change that assembly output so that each function had a shadow function and called through a vector. This was a bit clunky and only worked for Intel CPUs, but was an easy way to generate the run-time entry and exit printf()s without doing any work.</p>
<p>Anyway, once the permanent instrumentation is available then there are special benefits, especially in a team environment. For example, if a unit test stops working or becomes flappy, just compare the debug log with the last running version with the debug log of the failing version. 9 times out of 10 it&rsquo;s completely obvious what the problem is after doing the comparison, and this is generally much faster than firing up the debugger and single stepping etc. And if log info is missing then just add more instrumentation. And for new developers joining a team then the permanent instrumentation gives them a new way of comprehending the code base in addition to reading the source code; they can read the human friendly debug logs and see which function calls which other function and the main flow etc. When you start programming like this then you soon start to realize that the permanent instrumentation just mostly replaces comments, but are way more useful than comments.</p>
<p>It&rsquo;s sucky however when you get used to this technique and then try to use it in higher level languages. Why? Because the more permanent instrumentation is added to a code base then generally the slower it runs at run-time. In C it&rsquo;s possible to work around this issue with the non-debug version using pre-processor macros to ignore printf()s at compile time which have a verbosity which is too high. In this way the non-debug version of the program is not impacted at run-time with constantly executing the equivalent of if($current_verbosity &gt; $this_verbosity){ printf(&#8230;); }. Also, the physical size of the source code is not impacted&#8230; which can have an effect on performance too. However, most scripting languages do not have an equivalent mechanism and who wants to use the C pre-processor with PHP? Not me 🙂 Plus it&rsquo;s difficult to retro-fit an existing source base with the C pre-processor.</p>
<p>So what can you do? You can use Perl which has a feature called &lsquo;constant folding&rsquo; built in. That means if you write if(MYCONSTANT){} and MYCONSTANT is zero then the entire if() statement never gets compiled. In this way you can add as much permanent instrumentation to a Perl script as desired and if you switch off logging then the Perl script will run as fast as if it had no logging; there is no if() clauses getting constantly executed under the covers.</p>
<p>However, recently I wanted to add permanent instrumentation to PHP. So what to do in this case? PHP doesn&rsquo;t have any equivalent to constant folding, so the more if(verbosity){printf()} statements I add then the slower the PHP scripts run, not to mention that the run-time byte code gets fatter 🙁 In the end I created a simple FUSE file system which duplicates one source tree into another one called the debug tree, e.g. ./my-source/&#8230; and ./my-source-debug/&#8230; . If a program loads a PHP script from the debug source tree then under the covers the FUSE program loads the source code from the other source tree, but before delivering the source code, it &lsquo;uncomments&rsquo; permanent instrumentation lines. In this way the permanent instrumentation lives in the source code as regular comments and is therefore guaranteed to not cause a performance issues at run-time for the non-debug version of the code.</p>
<p>Using no debugger, permanent instrumentation, unit tests, and enforcing 100% code coverage then it&rsquo;s possible to create programs with remarkably few bugs in them. I recommend this technique.</p>
</div>
</li>
<li id="comment-245078" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/58803d9127b739fffe18647f3a5522b8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/58803d9127b739fffe18647f3a5522b8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-23T03:46:04+00:00">June 23, 2016 at 3:46 am</time></a> </div>
<div class="comment-content">
<p>I think the new trend is to write good unit tests with high coverage plus having good logging statements in case something goes wrong and you want to find out where the problem occurred. The logs are the new standard in big companies for figuring out where the problem happened. This is specially useful in today&rsquo;s big server software where you cannot really step through the code.</p>
</div>
</li>
<li id="comment-245102" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9e2af3eb210334bedb4094a38146b56b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9e2af3eb210334bedb4094a38146b56b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jan Schulz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-23T09:48:37+00:00">June 23, 2016 at 9:48 am</time></a> </div>
<div class="comment-content">
<p>I once watched a pro using the Visual Age for Java (that was 2001&#8230;) debugger&#8230; wow, just wow! I think you could use the debugger in VA to **write** code which was then loaded into the VM and executed. So basically you could step into your empty function, see what you have and then write the next line and step one step below and so on.</p>
<p>I agree with the &ldquo;think about the design of your code&rdquo; stuff and using unittests and logging. But regarding prints vs debugger, if you know how to use a debugger, you get a much better overview and are much faster than (iteratively) adding print statements. Especially if you use unittests together with a debugger: you get the bug nicely isolated and can then run through the internals. Usually, when I come to a hard to debug problem, I&rsquo;m often annoyed that I started with print statements and didn&rsquo;t go the debugger route directly.</p>
<p>[Note: I just used interpreter based languages like java, python, and R, not C and I use only the fancy GUI based debuggers in graphical IDEs]</p>
</div>
<ol class="children">
<li id="comment-351694" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dcdf21b6117dfa050ee2e733cbdc6b7c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dcdf21b6117dfa050ee2e733cbdc6b7c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">keithy</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-23T15:13:18+00:00">September 23, 2018 at 3:13 pm</time></a> </div>
<div class="comment-content">
<p>Visual Age for Java got that from the original Visual Age which was Smalltalk, and I remember doing back in 1994. Smalltalk&rsquo;s interactive debugging capabilities goes back to the 1980s. Still the best!</p>
</div>
</li>
</ol>
</li>
<li id="comment-245105" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5e699b061a35261e3faf52bacfbac231?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5e699b061a35261e3faf52bacfbac231?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Patrick</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-23T10:46:58+00:00">June 23, 2016 at 10:46 am</time></a> </div>
<div class="comment-content">
<p>Debuggers are not an alternative to good code design, it&rsquo;s not about &ldquo;using a debugger&rdquo; OR &ldquo;writing good quality code&rdquo;. You can (and should) do both. Tools are here to save time and help you find issues you didn&rsquo;t even think of, they are no substitute to best practices.</p>
<p>You are talking of line-by-line interactive debugging, but that&rsquo;s only a small part of the picture. Modern debuggers can:<br/>
&#8211; be started non-interactively, without GUI, and generate bug reports<br/>
&#8211; can rely on data provided by version control<br/>
&#8211; can be fully integrated within continuous integration tools<br/>
&#8211; etc.</p>
<p>In my company, we use debuggers. That doesn&rsquo;t mean we waste our time with tools or botch our applications. Quite the opposite. We use them every day without even noticing because we have seamlessly integrated them in our development workflow. </p>
<p>Also, keep in mind that all developers are not experts. Some people (e.g. students) are beginners and debugging tools can really help them understand what they are doing.</p>
</div>
</li>
<li id="comment-245125" class="comment byuser comment-author-lemire bypostauthor even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-23T13:46:29+00:00">June 23, 2016 at 1:46 pm</time></a> </div>
<div class="comment-content">
<p>@Patrick</p>
<p>Elsewhere on this blog, I have repeated promoted the use of better tools. I am definitively not a fan of working on &ldquo;raw&rdquo; code as if compilers had just been invented and we had nothing else to go by.</p>
<p>I think that my blog post is clear on what I mean by &ldquo;debugger&rdquo; which is interactive line-by-line execution. I specifically say that I use tools that are called debuggers. But I do not use them as debuggers.</p>
</div>
</li>
<li id="comment-245496" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/54fc0d7b9b4d55356dfb9599e1adb444?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/54fc0d7b9b4d55356dfb9599e1adb444?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://siderite.blogspot.com" class="url" rel="ugc external nofollow">Siderite</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-27T13:45:51+00:00">June 27, 2016 at 1:45 pm</time></a> </div>
<div class="comment-content">
<p>I think your article stands on a semantic issue only. What is a debugger, other than a tool that displays values at certain points in your program? The step by step line execution is not what defines it. Even when software scales to much that it is impossible to step-by-step, as it is in case of parallel programming, you still use a debugger to check states at a certain point. As such, using print statements or placing a breakpoint and then checking what values are at that point seems to be the same thing. </p>
<p>But maybe you are on to something. I would find value in a hybrid approach that just appends bits of code in certain places of a program. With this system pausing the execution and then displaying some user interface would just be a piece of code you appended, but not part of the source code. You want to log the values in some part of your program, you can add logging code in this way. Food for thought.</p>
</div>
<ol class="children">
<li id="comment-245502" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-27T14:22:31+00:00">June 27, 2016 at 2:22 pm</time></a> </div>
<div class="comment-content">
<p><em>I think your article stands on a semantic issue only. </em></p>
<p>I don&rsquo;t think it is only semantics. I used to debug my programming with breakpoints and line-by-line execution (15, 30 years ago). I think it is quite common still. </p>
<p>I think that my use of the terminology is common and clear from my post. Here is what Linus wrote:</p>
<blockquote><p>I don&rsquo;t like debuggers. Never have, probably never will. I use gdb all the time, but I tend to use it not as a debugger, but as a disassembler on steroids that you can program. </p></blockquote>
<p><em>As such, using print statements or placing a breakpoint and then checking what values are at that point seems to be the same thing.</em></p>
<p>Exactly. That is, if you define &ldquo;using a debugger&rdquo; broadly enough, then everyone uses a debugger and the statement is void of meaning.</p>
</div>
</li>
</ol>
</li>
<li id="comment-245520" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/34b5ec4a143dd4a12a8be0a65f71b0df?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/34b5ec4a143dd4a12a8be0a65f71b0df?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://vlasovstudio.com/" class="url" rel="ugc external nofollow">Sergey Vlasov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-27T18:16:16+00:00">June 27, 2016 at 6:16 pm</time></a> </div>
<div class="comment-content">
<p>First of all, I totally agree that rethinking code and adding tests/assertions are much more productive in the long run than debugging.</p>
<p>The thing I want to clarify is what exactly makes &ldquo;stepping line-by-line through code&rdquo; bad. I think there are three big problems: you need to know beforehand where to place an initial break point, the debugger shows variable values/call stack only for a single point in the program lifetime, and it takes time to get to this point.</p>
<p>&ldquo;Print statements&rdquo; are better as they create a log showing program state in multiple points and it is faster than stepping through code manually.</p>
<p>Personally, I rarely use print statements either as there are tools that can show program execution details without manual instrumentation. (Like my Runtime Flow tool for .NET and other similar offerings for Java.)</p>
</div>
</li>
<li id="comment-245530" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-27T19:57:58+00:00">June 27, 2016 at 7:57 pm</time></a> </div>
<div class="comment-content">
<p>I am pretty much in the &ldquo;all-the-above&rdquo; camp. I use assertions. I build tests. I think carefully about what I write. And I use debuggers.</p>
<p>But not all the code I use is mine, or as carefully done. I do not know all the possible state transitions. </p>
<p>In a prior project, for my code to work, all the other code incorporated in the project had to work. This included code from other developers (who were not as careful), and boatloads third-party libraries. (This was Java code, and the group had unfortunately chosen to use the Spring framework &#8211; which is full of unexpected behaviors.)</p>
<p>Using a debugger (in the Eclipse Java IDE) was an enormous productivity boost. When running tests (quite a large set towards the end of the project), an error occurs. Perhaps there is a stack trace (often but not always useful). Using log entries to narrow down the scope of the error, place a breakpoint. (Ideally on a path only taken in the error case. If possible, introduce such a path.) Re-start the test(s).</p>
<p>Sometime later &#8211; possibly minutes or hours &#8211; the breakpoint is hit, and the IDE is showing the point of error (or near). Often inspection reveals the error, update the code, and Eclipse IDE can do in-place replacement of the code. Resume the test.</p>
<p>When you are using long running tests, and failures are somewhat non-deterministic, this approach is an enormous boost.</p>
<p>That said, I used a debugger much less often on the last project (Python code with OpenStack), and could primarily rely on logging. Depends on the problem.</p>
</div>
<ol class="children">
<li id="comment-245531" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-27T20:14:43+00:00">June 27, 2016 at 8:14 pm</time></a> </div>
<div class="comment-content">
<p>I agree that there are cases where using a debugger with breakpoints is the right thing to do. I also agree that IDEs like Eclipse can be great, sometimes. What you describe does not sound like fun however:</p>
<p><em>Sometime later â€“ possibly minutes or hours â€“ the breakpoint is hit, and the IDE is showing the point of error (or near). Often inspection reveals the error, update the code, and Eclipse IDE can do in-place replacement of the code. Resume the test.</em></p>
<p>I think that people like Rob Pike are telling us that there ought to be a better way.</p>
</div>
</li>
</ol>
</li>
<li id="comment-245789" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/55e787c116d1116b5d120f30b3b4a3ce?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/55e787c116d1116b5d120f30b3b4a3ce?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">serhan iskander</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-30T11:06:13+00:00">June 30, 2016 at 11:06 am</time></a> </div>
<div class="comment-content">
<p>if you work alone &ldquo;Maybe&rdquo;,<br/>
but working in any company you will have code that existed for a long time, and even you will forget your code, debugger help you pinpoint the problem much faster.<br/>
you need to write good code and know where the problem is but it&rsquo;s extra tool than can help and your as good as your tools.</p>
</div>
<ol class="children">
<li id="comment-245803" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-30T14:06:22+00:00">June 30, 2016 at 2:06 pm</time></a> </div>
<div class="comment-content">
<p><em>your as good as your tools</em></p>
<p>I do believe that there is a lot of truth in this.</p>
<p><em>you will have code that existed for a long time, and even you will forget your code</em></p>
<p>Linus Torvalds does not use a debugger. Do you have code that is qualitatively larger, older and more complex than the Linux kernel?</p>
<p><em>if you work alone Maybe</em></p>
<p>There are at least 300 developers involved in any new version of the Linux kernel. How big is your team?</p>
</div>
</li>
</ol>
</li>
<li id="comment-245931" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d2b7e329d6c0c8ac56f19e9904462887?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d2b7e329d6c0c8ac56f19e9904462887?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/dragonsinth" class="url" rel="ugc external nofollow">Scott Blum</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-01T16:43:21+00:00">July 1, 2016 at 4:43 pm</time></a> </div>
<div class="comment-content">
<p>Agree with the points others have raised. Even as someone with a bit of a reputation among my colleagues for spotting bugs via inspection a on code review (and also writing understandable code myself), I still find a debugger so valuable and time-saving on occasion that I tend to avoid environments where running a debugger is impossible.</p>
<p>The central problem is, no matter how good your own designs and code are, developers are not islands anymore. In any project of a reasonable size, your own code is only a tiny fraction of what&rsquo;s happening. The rest of it is your coworkers, the language&rsquo;s core libraries, and numerous third-party libraries of varying quality&#8211; both in terms of correctness and how easy the code is to read. The former you can&rsquo;t change, and for the latter, you might submit a fix for a third party lib, but you&rsquo;re probably not going to investing in cleaning up the architecture. There&rsquo;s just no substitute for stepping through JRE classes which something really unexpected is happening.</p>
</div>
</li>
<li id="comment-246000" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1155be1ed8e9c17511be9479582238e1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1155be1ed8e9c17511be9479582238e1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://blog.jooq.org" class="url" rel="ugc external nofollow">Lukas Eder</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-02T14:27:05+00:00">July 2, 2016 at 2:27 pm</time></a> </div>
<div class="comment-content">
<p>Interestingly, those people you cite probably hardly ever work on other people&rsquo;s code (or other people&rsquo;s libraries).</p>
<p>For the rest of us, debuggers are excellent tools for figuring out how the legacy software that we&rsquo;re maintaining works, or to report bugs in third party libraries.</p>
</div>
<ol class="children">
<li id="comment-395870" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a9b1202f33020d88b0e65f58aa0877f2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a9b1202f33020d88b0e65f58aa0877f2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Rainan Miranda de Jesus</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-19T12:52:58+00:00">March 19, 2019 at 12:52 pm</time></a> </div>
<div class="comment-content">
<p>Linus Torvalds have about 300 developers working in Linux kernel with him&#8230; I think you might rethink your comment.</p>
</div>
</li>
</ol>
</li>
<li id="comment-246428" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://joseduarte.com" class="url" rel="ugc external nofollow">JosÃ© Duarte</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-07T11:36:29+00:00">July 7, 2016 at 11:36 am</time></a> </div>
<div class="comment-content">
<p>Linus&rsquo; coding practices are not to be commended, especially after the recent Git security vulnerabilities, which were completely predicable given the software development process that is typical in the Unix/C orbit. There&rsquo;s a certain steampunk, almost Luddite, approach to software in Unix, and the debuggers are pretty bad.</p>
<p>The reason Microsoft keeps coming up here is that Visual Studio&rsquo;s C++ debugger is widely regarded as the best in the world. (I&rsquo;d expect the same to be the case for their C# debugger, but they have less competition there.)</p>
<p>Putting together some recent threads, here and elsewhere, I think there&rsquo;s a real deficit in the academic CS community, a stunning lack of awareness of large swaths of present day computing. There&rsquo;s little awareness of Microsoft tools, Windows, and related file systems, languages, and so forth. This is compromising the quality of CS research &#8211; the community is far homogeneous and conformist with this whole Unix and C thing. And it leads to things like advice to not use debuggers, based only on this steampunk Unix/C paradigm. I feel like this monoculture slows progress in computing. Separately, software security is devastating right now, and we need much more powerful tools to deal with it than C and its printf flintstones. We need much richer debuggers with all sorts of modeling methods.</p>
</div>
<ol class="children">
<li id="comment-246436" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-07T14:05:36+00:00">July 7, 2016 at 2:05 pm</time></a> </div>
<div class="comment-content">
<p><em>Linus&rsquo; coding practices are not to be commended, especially after the recent Git security vulnerabilities, which were completely predicable given the software development process that is typical in the Unix/C orbit. </em></p>
<p>There are more computers running the Linux kernel than computers running any other operating system. Linux is the foundation of our Internet&#8230;</p>
<p><em>Putting together some recent threads, here and elsewhere, I think there&rsquo;s a real deficit in the academic CS community, a stunning lack of awareness of large swaths of present day computing. There&rsquo;s little awareness of Microsoft tools, Windows, and related file systems, languages, and so forth.</em></p>
<p>I think that the vast majority of CS academics are Windows users. The vast majority of CS courses are prepared on Windows for Windows users. Probably, in second, you find Apple technology followed, far below, by Linux technology. Though I use Linux machines (as servers), I haven&rsquo;t used Linux as my main machine in a decade or so. I know a few exceptional CS professors who use Linux as their primary machine&#8230; but they are few.</p>
<p>It is rather in industry that you find the most massive Linux adoption&#8230; at key corporations like Google, Amazon and so forth. Academics are not behind the sustained Linux popularity. In fact, if you go to a random CS school and pick a random CS professor, chances are that he won&rsquo;t be able to tell you much about modern Linux development tools. Most academics have had nothing to do with cloud computing and have never setup a container, assuming they know what it is.</p>
</div>
</li>
<li id="comment-562331" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ce82726817f3ad51e97718e5ffcef219?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ce82726817f3ad51e97718e5ffcef219?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Andy</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-16T20:13:06+00:00">December 16, 2020 at 8:13 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
Visual Studio’s C++ debugger is widely regarded as the best in the world
</p></blockquote>
<p>Just visiting to LOL at this!</p>
</div>
<ol class="children">
<li id="comment-562332" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-16T20:14:54+00:00">December 16, 2020 at 8:14 pm</time></a> </div>
<div class="comment-content">
<p>Please elaborate.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-247572" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b4c6e82eee4e5981a358a05eda262213?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b4c6e82eee4e5981a358a05eda262213?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anselmo</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-21T19:14:37+00:00">July 21, 2016 at 7:14 pm</time></a> </div>
<div class="comment-content">
<p>Great post! As an engineer, I always thought that using prints to debug code was an amateur thing. I hardly use debuggers, only when I cannot figure out the problem by investigating the prints.</p>
<p>Greetings from Brazil.</p>
</div>
</li>
<li id="comment-262815" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d356593419033868b71f816382675670?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d356593419033868b71f816382675670?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.linkedin.com/in/ashishh" class="url" rel="ugc external nofollow">Ashish Hanwadikar</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-17T20:47:55+00:00">December 17, 2016 at 8:47 pm</time></a> </div>
<div class="comment-content">
<p>Agree 100%. I made the same point in an linkedin post (<a href="https://www.linkedin.com/pulse/interactive-debugger-considered-harmful-ashish-hanwadikar" rel="nofollow ugc">https://www.linkedin.com/pulse/interactive-debugger-considered-harmful-ashish-hanwadikar</a>).</p>
</div>
</li>
<li id="comment-265544" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6e1f1bbd66670470d4874ab024af821?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6e1f1bbd66670470d4874ab024af821?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dirk Schuster</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-11T15:26:23+00:00">January 11, 2017 at 3:26 pm</time></a> </div>
<div class="comment-content">
<p>Thank you!</p>
<p>Just stumbled upon the sentence &ldquo;step-debugging is one of the key skills for any developer&rdquo; somewhere and wanted to see whether there is anyone else but me who is missing this &ldquo;key skill&rdquo; and so arrived at your post.</p>
<p>My history is quite similar to your&rsquo;s (Basic at school back in the 70ies, Turbo Pascal, then C++ and now mostly Java). </p>
<p>Very much like you said I actually stopped using a debugger when I (or rather my code) started to get seriously multi-threaded. For debugging I use assertions, sometimes only &ldquo;soft assertions&rdquo;, ie. simply error-logging when some expected condition does not hold, and logging/tracing. And yes, I frequently read and work on code produced by others, in particular when taking over after someone has left the company. To understand other&rsquo;s code &lsquo;grep&rsquo; and &lsquo;etags&rsquo; are much more helpful tools for me than a debugger.</p>
<p>Stepping, break-points and watches usually don&rsquo;t provide more information than logging statements can do, but logging statements provide a history of the program execution and are still there when some error occurs at later stages of the program&rsquo;s life cycle, ie. in production. When talking about logging/tracing I refer to configurable logging tools not printing to stdout (like log4j/slf4j rather than System.out.println in context of Java).</p>
<p>Actually I once was in a situation where even logging didn&rsquo;t help, because the error disappeared whenever even the least logging statement was inserted &#8212; obviously a tight race condition. In this case there was no way other than debugging in mind and it actually took me two days of mental stepping through the code to find the bug.</p>
<p>Currently I only use a debugger when debugging Lisp (Elisp) code but then exactly as you analyzed it is a single-threaded situation and small debugging objects (code units with at most a few functions).</p>
</div>
</li>
<li id="comment-269653" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/017fdaf98059caf1992a3fcf2799e1b1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/017fdaf98059caf1992a3fcf2799e1b1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Razvan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-03T19:02:09+00:00">February 3, 2017 at 7:02 pm</time></a> </div>
<div class="comment-content">
<p>I disagree. One says that a debugger doesn&rsquo;t scale, but logging (print is a primitive form of logging) does. Now, your 15 million lines code would be only 10 million without extensive logging you had to do because of lacking debugger. Plus, searching something in the agglomeration of messages turns not scaleable too.</p>
<p>To me, debugger is a great tool, by providing the capability of inspecting at once, in a given moment, all the local variables, stack or the members of a class.</p>
<p>In my career I&rsquo;ve debugged C, C++, -O3 C++, Java, Pyton and Assembler. If an IDE doesn&rsquo;t have debugger, it does not qualify for my attention. Not knowing to use a debugger (as well as a profiler) is a red flag.</p>
</div>
<ol class="children">
<li id="comment-269664" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-03T20:24:41+00:00">February 3, 2017 at 8:24 pm</time></a> </div>
<div class="comment-content">
<p><em>One says that a debugger doesn&rsquo;t scale, but logging (print is a primitive form of logging) does. Now, your 15 million lines code would be only 10 million without extensive logging you had to do because of lacking debugger.</em></p>
<p>Must debuggers and logging be our primary tools to debug problems?</p>
</div>
</li>
</ol>
</li>
<li id="comment-281299" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9dd9e63f5d90380e65d4093faaa453ca?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9dd9e63f5d90380e65d4093faaa453ca?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">asm123</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-12T18:43:01+00:00">June 12, 2017 at 6:43 pm</time></a> </div>
<div class="comment-content">
<p>15 millions of code lines for a kernel sounds like the most mismanaged project in the Solar System. I wouldn&rsquo;t give a cent for that code, the binaries nor 100 hours of the one managing such nonsense.</p>
</div>
</li>
<li id="comment-290903" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7634b5c7febc7a74e87fb9c4142fe5ae?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7634b5c7febc7a74e87fb9c4142fe5ae?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Andrew Norris</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-05T06:10:27+00:00">November 5, 2017 at 6:10 am</time></a> </div>
<div class="comment-content">
<p>The advantage of print statements is you are printing the key data you need to verify. </p>
<p>Often code goes wrong more than once. Esp. when first making it but can happen much later on. </p>
<p>So it goes wrong again at some date in the future : you have all the key results printed out for you. This both helps you see how it works and also at what point it stops working. </p>
<p>I usually just rem out the print statements once the code is running so I can come back to them later if the code is not working right. </p>
<p>Profilers, however are quite a different story than debuggers. Very useful !</p>
</div>
</li>
<li id="comment-295506" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/81842c3186cf426caca39581bc518700?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/81842c3186cf426caca39581bc518700?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Herbert</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-24T00:43:32+00:00">January 24, 2018 at 12:43 am</time></a> </div>
<div class="comment-content">
<p>It all depends on the problem, for debugging GUI apps, using print statements is not always viable. Sometimes it&rsquo;s simply not possible to use a debugger and print statements are the only thing possible for example in multithreaded apps. It&rsquo;s foolish to say that one doesn&rsquo;t use a debugger just because. Stack tracing alone in a complex piece of code is really useful especially is one is not familiar with the code. What&rsquo;s most likely happening is that those who don&rsquo;t want to use debuggers have probably never used a modern debugger and don&rsquo;t see the productivity benefits. When I refer to a debugger I&rsquo;m thinking of those that come with Visual Studio or the Delphi IDE not the command line debuggers like GDB, there is a world of difference between the two. Perhaps this is why Linus doesn&rsquo;t use debuggers simply because there weren&rsquo;t any truly modern debuggers when he wrote Linux.</p>
</div>
<ol class="children">
<li id="comment-295512" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-24T01:53:09+00:00">January 24, 2018 at 1:53 am</time></a> </div>
<div class="comment-content">
<p><em>It&rsquo;s foolish to say that one doesn&rsquo;t use a debugger just because. </em></p>
<p>Except that I don&rsquo;t write &ldquo;just because&rdquo;.</p>
<p><em>Stack tracing alone in a complex piece of code is really useful especially is one is not familiar with the code. </em></p>
<p>I include this as an exception in my post.</p>
<p><em> I&rsquo;m thinking of those that come with Visual Studio or the Delphi IDE not the command line debuggers like GDB, there is a world of difference to between the two</em></p>
<p>As my post makes clear, it is hardly &ldquo;modern&rdquo; to have a graphical user interface for your debugger. It existed well before Linus built Linux.</p>
<p><em>Perhaps this is why Linus doesn&rsquo;t use debuggers simply because there weren&rsquo;t any truly modern debuggers when he wrote Linux.</em></p>
<p>If you use inferior tools, you will be outcompeted by others. If you have massively superior tools than Linus, then I am sure you are producing much better software. Right? Are you confident about that?</p>
</div>
</li>
</ol>
</li>
<li id="comment-357811" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/669c1c183d575d64b7172dc8d0b9dc6d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/669c1c183d575d64b7172dc8d0b9dc6d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.zglue.com" class="url" rel="ugc external nofollow">Bill</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-17T06:48:08+00:00">October 17, 2018 at 6:48 am</time></a> </div>
<div class="comment-content">
<p>One tool not mentioned for debugging is dtrace, ftrace. The ability to turn debug paths on and off dynamically and to target the debug to narrow portions of operation pretty much gives you an interactive logging retargetting approach which would be very difficult in a typical debugger no matter how you used it.</p>
<p>When debugging infrequent non deterministic bugs this is quite a bit more likely to expose both the bug and the path leading to it. Scheduling entities are more essily captured.</p>
<p>The minimal hit to timing is not possible with any globally aware debugger.</p>
<p>This turns out to be the more productive path for me</p>
</div>
</li>
<li id="comment-358809" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d91710108c384f7120147a4b4687f7cc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d91710108c384f7120147a4b4687f7cc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">wqweto</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-20T12:50:22+00:00">October 20, 2018 at 12:50 pm</time></a> </div>
<div class="comment-content">
<p>Not using a debugger is like not using a linter. Your project is not going to die but usually the debugger gives you a new perspective as to what this monster of code you&rsquo;ve created is doing behind the scenes.</p>
<p>Linus might not need a debugger but are you as good as him to claim you understand all of your codebase and no more insights are needed?</p>
<p>My point is: Be humble and use a debugger, man! You are not that much better than the schoolboy that dabbled with those Borland&rsquo;s awesome debuggers. (You remember Ctrl+F2 to evaluate <em>any</em> expression with local and global variables at run-time with no recompilation?)</p>
</div>
<ol class="children">
<li id="comment-358836" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-20T14:32:17+00:00">October 20, 2018 at 2:32 pm</time></a> </div>
<div class="comment-content">
<p>I love linters!</p>
<p>And no, I am not much better but I work on much harder problems with more sophisticated tools. Conventional debuggers just don&rsquo;t scale to billions of function calls and tens of threads. My optimized code gets compiled to something that barely looks like my source code. I use gigabytes of memory not 512 bytes.</p>
</div>
</li>
</ol>
</li>
<li id="comment-405135" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a22f40f9a5203888afe5b8bdaf0f229a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a22f40f9a5203888afe5b8bdaf0f229a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">icsa</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-04T23:59:35+00:00">May 4, 2019 at 11:59 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m definitely in the &ldquo;I don&rsquo;t use a debugger.&rdquo; camp. With that said, I&rsquo;ve used some extraordinary debuggers including the Jasik Debugger for the Macintosh.</p>
<p>However, when I went to use a debugger after having inserted print statements, I always came to one or more of the same conclusions:<br/>
* I didn&rsquo;t understand the program<br/>
* I didn&rsquo;t understand the problem the program was supposed to solve<br/>
* I didn&rsquo;t understand the programming language used to solve the problem.</p>
<p>Once I made sure that I understood all of the above, the need for a debugger went away.</p>
</div>
<ol class="children">
<li id="comment-405137" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a22f40f9a5203888afe5b8bdaf0f229a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a22f40f9a5203888afe5b8bdaf0f229a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">icsa</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-05T00:00:42+00:00">May 5, 2019 at 12:00 am</time></a> </div>
<div class="comment-content">
<p>I do still use print statements or logging to show the state of a running program.</p>
</div>
</li>
</ol>
</li>
<li id="comment-405138" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7f9b95cca0167ea1eea460dbf47cb431?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7f9b95cca0167ea1eea460dbf47cb431?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">adampasz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-05T00:02:28+00:00">May 5, 2019 at 12:02 am</time></a> </div>
<div class="comment-content">
<p>Debuggers are like microscopes. They are great for untangling complicated problems at the function level. They are not so useful for understanding interactions between components, or for dealing with asynchronous events.<br/>
Lately, I&rsquo;ve been using trepan and vim for Node development. I use tmux to switch back and forth, with very little impact or slowdown from context switching. I also like running my code frequently while I&rsquo;m writing it.<br/>
This is what works for me. I&rsquo;ve found when I use debuggers less, I end up adding more logging which is merely an approximation of what I could see in the debugger, and adds a lot of clutter to my work, and slows me down. I get that, once you deploy, you can&rsquo;t always rely on debuggers. This is the point when I think about adding well-crafted logging.<br/>
Different programmers have different approaches. That&rsquo;s OK.</p>
</div>
</li>
<li id="comment-405174" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a4591e565200025a3e0ae1c2e104abd3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a4591e565200025a3e0ae1c2e104abd3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sameer Patil</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-05T04:35:46+00:00">May 5, 2019 at 4:35 am</time></a> </div>
<div class="comment-content">
<p>Interesting blog. Your arguments are valid. But if I don&rsquo;t use GPS navigation, I would know the roads better. If I don&rsquo;t use calculator, I would be better at mental arithmetic. Well, productivity is also important.</p>
</div>
<ol class="children">
<li id="comment-405358" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-06T13:29:40+00:00">May 6, 2019 at 1:29 pm</time></a> </div>
<div class="comment-content">
<p>I am not advocating using lesser tools. I am pointing out that debuggers are limited and may impair productivity.</p>
</div>
</li>
</ol>
</li>
<li id="comment-405249" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3b7e1bba8adaa852ee405d10a67f6b46?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3b7e1bba8adaa852ee405d10a67f6b46?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://ferozedaud.blogspot.com" class="url" rel="ugc external nofollow">Feroze Daud</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-05T19:50:35+00:00">May 5, 2019 at 7:50 pm</time></a> </div>
<div class="comment-content">
<p>Daniel, I think you make some good points. And I know you are not really saying nobody should ever use a debugger. However&#8230;</p>
<p>1) No matter how much clean code I write, with unit tests and all, I cannot cover everything.</p>
<p>2) Writing printfs only helps when you have an inkling of where the bug might be, and you have the luxury of being able to repro it on your machine.</p>
<p>3) This works fine in SAAS/PAAS scenarios where no product is being shipped to the end user.</p>
<p>4) When you have products being shipped to the end user, and you get crash reports or other telemetry indicating problems, you cannot go back and write printf or log statements. Even if you did and shipped an update to the customer, it is not necessary that he will be able to repro it.</p>
<p>5) Of course, reproes are not guaranteed in the debugger too&#8230; but atleast you can try complex things, like seeing if thread races are causing problems, by pausing a thread in debugger and letting others continue.</p>
<p>6) A class of bugs, eg, off-by-1 bit errors due to memory problems, access violations etc, esp in the presence of no symbols, are sometimes only invetigatable using a debugger.</p>
</div>
<ol class="children">
<li id="comment-405354" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-06T13:12:35+00:00">May 6, 2019 at 1:12 pm</time></a> </div>
<div class="comment-content">
<p>Of course, I do not think we should never use a debugger, but your comment suggests you might be advocating something different.</p>
<ol>
<li>
<p>Testing cannot cover everything but the time you spend in the debugger is time you are not investing on testing.</p>
</li>
<li>
<p>If you do not have access to the machine, how do you run a debugger on it? Are you mixing up the concept of a debugger (a manual tool the programmer use) with the build settings? Releasing the code with bound checking is entirely different from using a debugger.</p>
</li>
<li>
<p>If the product is getting shipped, then you should prioritize testing and logging over debuggers since you are not going to be able to use a debugger on the running code.</p>
</li>
<li>
<p>See my 3.</p>
</li>
<li>
<p>and 6. There are definitely automated techniques to detect data races and access violations. If people think that the only tool for these problems are manual debuggers, then they are wrong. We have had checkers and sanitizers for decades. Fixing the problems is still manual labor, of course.</p>
</li>
</ol>
</div>
<ol class="children">
<li id="comment-405414" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3b7e1bba8adaa852ee405d10a67f6b46?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3b7e1bba8adaa852ee405d10a67f6b46?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://ferozedaud.blogspot.com" class="url" rel="ugc external nofollow">Feroze daud</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-07T00:43:10+00:00">May 7, 2019 at 12:43 am</time></a> </div>
<div class="comment-content">
<p>Ok now imagine I am a developer at Microsoft. Everyday I get crash dumps sure to my Software crashing users machines. How do I find out where the problem might be?</p>
</div>
<ol class="children">
<li id="comment-405419" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-07T01:10:58+00:00">May 7, 2019 at 1:10 am</time></a> </div>
<div class="comment-content">
<p>Debugging from core dump is not what I would typically think of as &ldquo;using a debugger&rdquo; though it may involve that.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-405411" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/21dbbc796fe477960fbfba676b9c75af?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/21dbbc796fe477960fbfba676b9c75af?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Eric</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-07T00:33:43+00:00">May 7, 2019 at 12:33 am</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t really understand this. I agree that gray-matter debugging is extremely useful, but for any moderately complex project there are bound to be third-party libraries brought in. Sometimes these can do unexpected things that debuggers are great at catching.</p>
<p>Unless it&rsquo;s an outdated or terrible debugger, modern debuggers are fantastic at showing the behavior of locking primitives and the interweaving of async code. I use Visual Studio, which allows me to see the call stack of each thread in my process and then step back in time and play &ldquo;what-if&rdquo; scenarios with the outputs of various modules. By being able to see why each thread is where it is at and playing with the data that comes back from functions in the stack, I can quickly narrow an issue down to something in my code or an unexpected side effect in a library we brought in.</p>
<p>As a side note, we adopted F# as our primary language (we&rsquo;re mostly a .NET shop). It was not an easy transition since OOP has been banged into our heads for the last 20 years, but thinking about problems as a flow of data through idempotent functions rather than the evolution of system state has made our code much easier to reason about mentally. As good as we are at having automated tests and continuous integration, we still sometimes catch bugs in the debugger that would have been gnarly to catch with printf&rsquo;s. The quickest way to narrow these types of things down is to set up explicit break conditions for things that shouldn&rsquo;t happen and inspect the runtime history of the threads involved if they do.</p>
<p>Debuggers are not a panacea but they are a useful tool for projects that have at least a moderate integration topology.</p>
</div>
<ol class="children">
<li id="comment-405417" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-07T00:59:27+00:00">May 7, 2019 at 12:59 am</time></a> </div>
<div class="comment-content">
<p>I specifically allude to this use case&#8230; <em>there are cases where a debugger is the right tool (&#8230;) in contexts where my brain is overwhelmed because I do not fully master the language or the code</em>.</p>
</div>
</li>
</ol>
</li>
<li id="comment-405797" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3b7e1bba8adaa852ee405d10a67f6b46?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3b7e1bba8adaa852ee405d10a67f6b46?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://ferozedaud.blogspot.com" class="url" rel="ugc external nofollow">Feroze Daud</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-09T20:41:30+00:00">May 9, 2019 at 8:41 pm</time></a> </div>
<div class="comment-content">
<p>Definitely, good coding practices help lessen the need for debuggers but do not eliminate them.</p>
<p>Grey matter debugging works fine if you have the luxury of working on the same problem for a long time, without distractions, or if the code is something you wrote or is simple to grok. For all other real world applications, it does not work&#8230;</p>
<p>But there does come a time if you are firing up the debugger frequently to debug a piece of code, where you have to think if it would be better to write more unit tests instead. But again that works if it is your own code, or component on which you can make changes.</p>
</div>
</li>
<li id="comment-410794" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2b490145c0e45a9ff069d9969b28012b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2b490145c0e45a9ff069d9969b28012b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">fdf</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-07T11:20:54+00:00">June 7, 2019 at 11:20 am</time></a> </div>
<div class="comment-content">
<p>R studio is terrible. Because you dont like debuggers it does not mean that people should not debug. sorry<br/>
R is in general quite a weird structure scripting language. I think its complicate manner makes people feel its a language.</p>
</div>
</li>
<li id="comment-413030" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a19a0604efee195711b7dc9cf49672da?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a19a0604efee195711b7dc9cf49672da?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Carla Sanchez</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-22T17:51:32+00:00">June 22, 2019 at 5:51 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;&#8230;I was able to find several famous programmers who took positions against debuggers&#8230;&rdquo;</p>
<p>That&rsquo;s when I stopped reading.<br/>
<a href="https://en.wikipedia.org/wiki/Argument_from_authority" rel="nofollow ugc">https://en.wikipedia.org/wiki/Argument_from_authority</a></p>
<p>Never trust an argument that starts with a fallacy, particularly one that is common enough to have a name.</p>
</div>
<ol class="children">
<li id="comment-413458" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-24T13:48:21+00:00">June 24, 2019 at 1:48 pm</time></a> </div>
<div class="comment-content">
<p>Stating that many people do important work without debuggers is not a fallacy. It is a fact.</p>
</div>
</li>
</ol>
</li>
<li id="comment-414103" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b8cfd5ec0f88bf5b5f2eedda7d1a0746?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b8cfd5ec0f88bf5b5f2eedda7d1a0746?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.seebs.net/log/" class="url" rel="ugc external nofollow">seebs</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-27T19:36:52+00:00">June 27, 2019 at 7:36 pm</time></a> </div>
<div class="comment-content">
<p>I use debuggers raarely enough that I don&rsquo;t actually know whether I <em>have</em> a debugger for the language I&rsquo;m currently working in most. After a great deal of watching other people debugging, I&rsquo;ve concluded that, on modern systems, a debugger is almost always <em>slower</em> than studying carefully-considered logs, with the key exceptions being mostly memory corruption. For nearly everything else, being able to see a series of logs over time seems to work better.</p>
<p>In particular, I think I get a lot of benefit from <em>thinking</em> about what I want the logs to tell me.</p>
</div>
</li>
<li id="comment-418077" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/62bd9edf0e1f47d1c9d1ce84cea05253?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/62bd9edf0e1f47d1c9d1ce84cea05253?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Luis Goncalves</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-16T05:41:39+00:00">July 16, 2019 at 5:41 am</time></a> </div>
<div class="comment-content">
<p>There&rsquo;s one thing that most debuggers/languages don&rsquo;t have (except for Matlab) that would allow debugging to scale : &ldquo;dbstop if error&rdquo;. That means if an error occurs, the program doesn&rsquo;t crash and exit, but it stops right there into debug mode, where you can inspect what happened without having to set a breakpoint and re-run the code again to recreate the error. (In matlab that means you get the same fully functional interpreter prompt that you started with (unlike python&rsquo;s pdb!), and can do anything you want (plot, call functions, compute, as well as move up and down the calling stack to understand how you got to the error).)</p>
<p>The concept of debugging on error with a fully functional prompt may seem trivial and not much of an improvement, but it actually is quite significant, because it speeds up the debug cycle immensely. I&rsquo;m both saddened and frustrated that python and julia don&rsquo;t offer something equivalent. It would be a significant improvement to both languages.</p>
</div>
<ol class="children">
<li id="comment-418403" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-16T23:57:35+00:00">July 16, 2019 at 11:57 pm</time></a> </div>
<div class="comment-content">
<p>Can you elaborate?</p>
<p><em>it stops right there into debug mode</em></p>
<p>Would you want this to happen in production? I think that, in production, you want a clean crash.</p>
<p>If this is not in production, then surely you can run your script in debug mode, right?</p>
</div>
<ol class="children">
<li id="comment-419530" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dc10fac0c663c22ac53fb29bcf9bee72?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dc10fac0c663c22ac53fb29bcf9bee72?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Joe O'Leary</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-22T17:13:40+00:00">July 22, 2019 at 5:13 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t know about Luis but I know that I would certainly want to be able make this happen in a production build. In fact, I do it all the time. Some obscure crash is occurring, particularly those that happen at an indeterminate time. Perhaps it is some specific std::exception derivative being thrown. On Windows, perhaps it is some hardware exception like an access violation.</p>
<p>The ability to run a production build in the debugger with the debugger set to break at the exact moment such an exception occurs is invaluable. I don&rsquo;t need to go in and start inserting printfs everywhere. I just see a snapshot live, as it is happening.</p>
<p>Regarding your response to Feroze above, I don&rsquo;t know if you&rsquo;ve ever dealt with production crash files on Windows (or if Linux even has an equivalent) but on Windows the process is something like this:</p>
<p>Customer reports application crash in the field.<br/>
Customer sends log files back to us along with a crash dump file back to us (which we dump as a last resort)<br/>
Usually the log files make the problem clear. But no matter how good you are or how many development/testing resources you have, eventually they wont.<br/>
In that case I take the dump file and open it up in the debugger along with the snapshot build of that specific release.<br/>
Debugger gives me a live call stack of the crash. I can examine the data live. I can switch back up the call stack and look at data in those functions. Obviously much is optimized away and I cannot examine it live. But a some of it is not. And what is notI can examine in raw memory<br/>
Furthermore the debugger gives me the call stack of every other thread exactly it was running at that time. I can switch to other threads, examine live data in them as well.</p>
<p>In my experience, the ability to do this is a huge time saver. It can be often the difference between finding a problem immediately and finding it days/weeks/months down the line. Especially in the 3-person development shop scenario. Or the &ldquo;I-inherited-this-godawful-codebase&rdquo; scenario</p>
</div>
<ol class="children">
<li id="comment-419535" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-22T17:57:26+00:00">July 22, 2019 at 5:57 pm</time></a> </div>
<div class="comment-content">
<p>@Joe</p>
<blockquote><p>(&#8230;) I would certainly want to be able make this happen in a production build. In fact, I do it all the time. Some obscure crash is occurring, particularly those that happen at an indeterminate time. (&#8230;) The ability to run a production build in the debugger with the debugger set to break at the exact moment such an exception occurs is invaluable. </p></blockquote>
<p>A friend of mine teaches computer security and he has a whole 3-hour lesson on how to exploit debuggers running in production. Microsoft says that <a href="https://docs.microsoft.com/en-us/visualstudio/debugger/debugger-security?view=vs-2019" rel="nofollow">debugging should be disabled on production machine</a>. Admittedly, maybe the concerns are overblown and it is fine to run your production servers in debug mode.</p>
<blockquote><p>Regarding your response to Feroze above, I don’t know if you’ve ever dealt with production crash files on Windows (or if Linux even has an equivalent) but on Windows the process is something like this: (&#8230;)</p></blockquote>
<p>Yes. I am familiar with it, and yes, as far as I can tell, all major operating systems have core dumps. It should since it is a technology from the 1950s (according to Wikipedia).</p>
</div>
<ol class="children">
<li id="comment-419537" class="comment odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dc10fac0c663c22ac53fb29bcf9bee72?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dc10fac0c663c22ac53fb29bcf9bee72?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Joe O'Leary</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-22T18:20:28+00:00">July 22, 2019 at 6:20 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
A friend of mine teaches computer security and he has a whole 3-hour<br/>
lesson on how to exploit debuggers running in production. Microsoft<br/>
says that debugging should be disabled on production machine.<br/>
Admittedly, maybe the concerns are overblown and it is fine to run<br/>
your production servers in debug mode.
</p></blockquote>
<p>To be clear getting a crash file does not require enabling debugging on a client&rsquo;s machine. We don&rsquo;t send them the debug symbols or anything.</p>
<blockquote><p>
Yes. I am familiar with it, and yes, as far as I can tell, all major<br/>
operating systems have core dumps. It should since it is a technology<br/>
from the 1950s (according to Wikipedia).
</p></blockquote>
<p>Oh yes, of course. I wasn&rsquo;t implying that they didn&rsquo;t have crash dumps. I&rsquo;m saying that a debugger is an invaluable tool for examining one</p>
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
<li id="comment-420950" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6579c4705c5cee7399c609ebe3a37665?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6579c4705c5cee7399c609ebe3a37665?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Or Weis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-30T08:49:10+00:00">July 30, 2019 at 8:49 am</time></a> </div>
<div class="comment-content">
<p>How about trying a modern debugging/datapoint extraction solution that scales?</p>
<p>Like <a href="https://www.rookout.com" rel="nofollow">Rookout</a></p>
</div>
</li>
<li id="comment-430176" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1cd9723b643e827c0a29ff6d104ce9bb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1cd9723b643e827c0a29ff6d104ce9bb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ian Newson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-05T19:51:23+00:00">October 5, 2019 at 7:51 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t understand this post.</p>
<p>None of your reasons are reasons not to use a debugger, merely descriptions of situations where they&rsquo;re not the best tool. There are plenty more of those types of systems, such as when you&rsquo;re trying to debug a real time system, but that&rsquo;s not a reason to use debuggers in situations where they are appropriate. Debuggers aren&rsquo;t my first port of call either, I&rsquo;ll typically start by reading the code and trying to imagine states which could produce the issue I&rsquo;m seeing. Debuggers aren&rsquo;t my last port of call either, it&rsquo;d be silly to skip over a debugger before jumping to more intensive forms of testing such as creating and analysing memory dumps, or building extra tools yourself.</p>
<p>I guess not even CS professors are immune to the allure of a click bait headline!</p>
</div>
<ol class="children">
<li id="comment-430186" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-05T20:54:20+00:00">October 5, 2019 at 8:54 pm</time></a> </div>
<div class="comment-content">
<p>I merely describe how I work, pointing out that other credible programmers share the same approach.</p>
<p>I write pretty complicated code and I really never use a debugger for debugging.</p>
<p>It is a statement of fact.</p>
<p>That I am a professor has nothing to do with it.</p>
</div>
<ol class="children">
<li id="comment-430190" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4c60b0c699456df449906c4dc07f59e4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4c60b0c699456df449906c4dc07f59e4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ian Newson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-05T21:11:54+00:00">October 5, 2019 at 9:11 pm</time></a> </div>
<div class="comment-content">
<p>You stated in the post that you do use debuggers, that&rsquo;s the main reason the post is click bait. The title is the only reason I clicked.</p>
<p>Honestly it doesn&rsquo;t matter, of course you should work in the way that benefits you most. The click bait headline is really the only part I take exception to. It&rsquo;s unhelpful and I&rsquo;m afraid of the possibility that it helps produce programmers who can&rsquo;t or don&rsquo;t see the value in a debugger.</p>
<p>In a while crocodile!</p>
</div>
<ol class="children">
<li id="comment-430191" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-05T21:19:58+00:00">October 5, 2019 at 9:19 pm</time></a> </div>
<div class="comment-content">
<p>It is not clickbait. I am openly discouraging reliance on debuggers.</p>
</div>
</li>
<li id="comment-430207" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4c60b0c699456df449906c4dc07f59e4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4c60b0c699456df449906c4dc07f59e4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ian Newson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-05T22:21:02+00:00">October 5, 2019 at 10:21 pm</time></a> </div>
<div class="comment-content">
<p>I do not use a debugger<br/>
.</p>
<p><code>there are cases where a debugger is the right tool<br/>
</code></p>
<p>.</p>
<p><code>I used a debugger ... to debug a dirty piece of JavaScript.<br/>
</code></p>
<p>These quotes from your article show that you do use debuggers, in defiance of your post title. Therefore the title is a terminalogical inexactitude.</p>
<p>I don&rsquo;t care if you want to discourage the use of a debugger, I&rsquo;m certainly amenable to that notion, but to suggest it shouldn&rsquo;t be in a programmers toolbelt is foolish and at odds with the content of your post.</p>
</div>
<ol class="children">
<li id="comment-430213" class="comment byuser comment-author-lemire bypostauthor even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-05T22:48:04+00:00">October 5, 2019 at 10:48 pm</time></a> </div>
<div class="comment-content">
<p>There few absolutes in programming: it is hard to find practices that one can really never have to do.</p>
<p>But as a general rule, I do not program using a debugger.</p>
<p>I also do not drink my coffee with sugar.</p>
<p>I do not eat desert.</p>
<p>I do not memorize phone numbers.</p>
<p>Etc.</p>
<p>Does it mean that there can be no exception? Of course, there can be.</p>
<p>I would also say that I don’t use assembly when programming&#8230; but you’ll find exceptions.</p>
<p>I would also say that I don’t program in Rust or D or Haskell, but you’ll find code in these languages on this blog.</p>
<p>Note the exception about JavaScript: I specifically refer to dirty code.</p>
<p>So I stand by my statement: I do not use a debugger&#8230; Not as an absolutist religious statement but as a method of programming.</p>
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
<li id="comment-430264" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3b7e1bba8adaa852ee405d10a67f6b46?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3b7e1bba8adaa852ee405d10a67f6b46?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://ferozedaud.blogspot.com" class="url" rel="ugc external nofollow">feroze Daud</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-06T05:06:33+00:00">October 6, 2019 at 5:06 am</time></a> </div>
<div class="comment-content">
<p>I can grant you that a debugger should never be the first tool you go to. But if you say that you never used a debugger, then maybe you are not facing the situations where it is indispensable, and in some situations the only one that makes sense.</p>
<p>When I worked in microsoft, the saying was that you formulate why a system crashed &#8211; you try to examine the code and come up with a hypothesis, then use the debugger to prove or disprove it. Just blindly going to a debugger is not going to help.</p>
<p>And as I said, when you are shipping software that runs on end users machines, and then crashes and you get a core dump, you dont have the luxury of looking at the code always. You have to look at the dump along with the other metadata in it ( users OS, patch level etc) and try to figure out what happened.</p>
<p>Can you get by without ever using a debugger for the code you write ? Sure. But try doing that when you are part of an organization shipping something complicated like windows, linux, office, sql server etc. And you will not get very far with that approach. You just wont have the bandwidth to read everybody&rsquo;s code and do mental debugging.</p>
</div>
<ol class="children">
<li id="comment-430362" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-06T16:00:01+00:00">October 6, 2019 at 4:00 pm</time></a> </div>
<div class="comment-content">
<p>Linus ships something as complicated as the Linux kernel and he does not use a debugger. Python was built without relying on a debugger. Go was built without relying on a debugger. And so forth.</p>
<p>So the story where you get away without relying on a debugger because you are building simple things does not work. Lots of people who build widely deploying, difficult software do not rely on debuggers.</p>
<p>In some sense, as I have argued, the opposite is true: for many hard problems, the debugger is not helpful. Debuggers are certainly fine to debug throw-away code where you don&rsquo;t want to invest in long-term maintainability, you just want to get going.</p>
<p>Now, I have very clearly, indicated that I do believe that debuggers can be useful, and they have their place. It is certainly the case that if you have to debug code that you do not understand, that was built in a less than optimal way&#8230; then a debugger can be a life saver.</p>
<p>Yet, to me, this is like saying that firemen are life savers. They are. But we don&rsquo;t maintain cities by relying on firemen. We make sure that we rarely need firemen.</p>
<p>My main beef is with the debugger-oriented approach to programming which often means few to no unit tests, no assertions, no fuzz testing, messy code architectures, missing or incomplete documenation. I think you should almost always program in such a way that a debugger won&rsquo;t be needed. You should use the time you would spend in the debugger writing code that can be maintained without a debugger.</p>
<p>It is far better to improve your testing, for example, than to spend time in a debugger.</p>
<p>Of course, if you work for a company, you may not get a choice. Maybe your employer won&rsquo;t let you spend 3 months writing tests for your code instead of producing a new feature. And maybe this makes sense because the code will get thrown away in 3 weeks anyhow&#8230;</p>
</div>
</li>
</ol>
</li>
<li id="comment-430463" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3b7e1bba8adaa852ee405d10a67f6b46?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3b7e1bba8adaa852ee405d10a67f6b46?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://ferozedaud.blogspot.com" class="url" rel="ugc external nofollow">feroze Daud</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-07T02:05:06+00:00">October 7, 2019 at 2:05 am</time></a> </div>
<div class="comment-content">
<p>But again you are making a false dichotomy. The choice is not between debugger and logging/unit testing etc. The choice should be both. Absolutely fortify your product at development / testing time with uni tests, log messages etc. And if that results in bug free product, so be it.</p>
<p>Also.. I dont understand when you give examples about python/go/linux etc. Are you saying that they were developed without using debuggers at all? Or are you saying that they do not ship with debuggers because they dont think end users are served by them?</p>
<p>Again, I dont know the details but I find it really hard to swallow that python /linux were built without ever relying on debuggers. Maybe Linus can pull it off. But what about so many other contributors ? Debugging is kind of like a first class citizen in python. Just &ldquo;import pdb;pdb.set_trace()&rdquo; and you are set.</p>
<p>This argument is kind of like a homeopath and MD arguing. Can the homeopath claim that he has cured people. Sure. Can that claim be sustained with the general population? Very few would say &ldquo;I have never used a doctor&rdquo;</p>
<p>Debuggers are like that. Should you write your code so that the choice of debugger is rare? Yes! But saying that nobosdy should ever need to use it is far fetched. As they say YMMV. If you can do without one, well and good.</p>
</div>
</li>
<li id="comment-430565" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-07T14:40:48+00:00">October 7, 2019 at 2:40 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>But again you are making a false dichotomy.</p>
</blockquote>
<p>I don&rsquo;t think I am. Your time is finite. The time you spend in a debugger is time you are not spending doing other work.</p>
<p>If you are building software by relying on a debugger, then the time you spend in the debugger, going line by line or setting up watches or whatever, is time you are not spending writing code, documentation, and so forth.</p>
<p>Now, if you are rarely using a debugger, to the point where the time spend in a debugger is virtually zero, then you are, for all practical purposes, in complete agreement with my post.</p>
<blockquote>
<p>I dont understand when you give examples about python/go/linux etc.<br/>
Are you saying that they were developed without using debuggers at<br/>
all?</p>
</blockquote>
<p>Linus in particular does not use a debugger. Many famous programmers who built the infrastructure you built are in the same boat. Please follow the links I offered in my post.</p>
<p>Maybe you find it incredible that people can write sophisticated, complex real-world software without a debugger. But it happens.</p>
<p>I write hard-to-write software myself, and lots of people are relying on some of it. I&rsquo;m a not a naive programmer. I write pretty difficult code, all the time. And I don&rsquo;t rely on a debugger while I am doing it.</p>
<p>I know how to use debuggers, that&rsquo;s how I started to debug non-trivial code many years ago, but over time I stopped doing it. Exceptionally, I will use a debugger, but that&rsquo;s usually a sign that something is wrong: either the code is poor or my understanding is poor. When the code is good and I am on top of it, I don&rsquo;t need a debugger.</p>
<blockquote>
<p>Should you write your code so that the choice of debugger is rare?<br/>
Yes! But saying that nobosdy should ever need to use it is far<br/>
fetched.</p>
</blockquote>
<p>I very specifically and very carefully point out that I am not saying you should never use a debugger. Even just in my reply to you, just now, I wrote: <em>I have very clearly, indicated that I do believe that debuggers can be useful</em>.</p>
<p>What I am claiming is that you are routinely going to the debugger, then it is probably a sign that you should improve your methods. The debugger should be a last resort tool&#8230;</p>
<p>You can reasonably disagree with me, of course. You can believe that using a debugger frequently is sane and productive.</p>
</div>
</li>
<li id="comment-543644" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d1043eb5fb5084c29d29fd09dc285e6e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d1043eb5fb5084c29d29fd09dc285e6e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stevek</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-23T22:51:10+00:00">July 23, 2020 at 10:51 pm</time></a> </div>
<div class="comment-content">
<p>I totally agree. I used to use a debugger extensively. Then I changed my development environment to always use optimization when compiling, to match production compiler flags. This makes the debugger not really useable.</p>
<p>But I found that finding bugs by print statements much more efficient. Often just thinking where to put print statements will have you see the issue. It is quite quick.</p>
</div>
</li>
<li id="comment-595277" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a691204b536b947b83d8897f4ff885fc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a691204b536b947b83d8897f4ff885fc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Peter Guo</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-19T06:14:01+00:00">August 19, 2021 at 6:14 am</time></a> </div>
<div class="comment-content">
<p>It is better to know what&rsquo;s happening with a debugger.</p>
</div>
</li>
<li id="comment-612313" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/da1ec6b849208eab397b93da98e3144c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/da1ec6b849208eab397b93da98e3144c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Arshad T. McGillicuddy III, BSc.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-12-20T20:38:28+00:00">December 20, 2021 at 8:38 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m perceiving an interesting logger-vs.-debugger dichotomy I wasn&rsquo;t aware of.</p>
<p>I arrived here while searching for comments about logging. In my experience, logs are mostly useless and a minor tool at best. A debugger (however one uses it) is, to me at least, almost indispensable. </p>
<p>And yet most developers will swear up and down that logs are fantastically useful, that they use them all the time, etc. and conversely, we have this phenomenon of people claiming they don&rsquo;t even use a debugger!</p>
<p>I don&rsquo;t know if they&rsquo;re doing it wrong, or if I am, or if it&rsquo;s just a legitimate difference of mere style. I do know, though, that if you watch a developer work you&rsquo;ll sometimes observe things that are at odds with how he *says* he works. For example, I know that some of the people who extol the virtues of logging to me simply don&rsquo;t open up log files very often. </p>
<p>Do Torvalds, etc. surreptitiously step through code in GDB like closeted preachers sneaking to the &ldquo;wrong&rdquo; end of Bourbon Street? I don&rsquo;t know, but if you remove the typical bombast from his statement I think he&rsquo;s saying that he&rsquo;s smart and knowledgeable enough to do better than just stepping through code slack-jawed until the light bulb of ideation turns on, and I believe him&#8230; usually.</p>
</div>
<ol class="children">
<li id="comment-612315" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-12-20T20:53:49+00:00">December 20, 2021 at 8:53 pm</time></a> </div>
<div class="comment-content">
<p><em>I know that some of the people who extol the virtues of logging to me simply don’t open up log files very often.</em></p>
<p>I would argue that if they are doing it often, they are doing it wrong.</p>
</div>
</li>
</ol>
</li>
<li id="comment-636600" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f0e508ee0d5b2ed6907a4b078e0ac7b0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f0e508ee0d5b2ed6907a4b078e0ac7b0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Shane Dalton</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-06-17T00:01:34+00:00">June 17, 2022 at 12:01 am</time></a> </div>
<div class="comment-content">
<p>I think stating that a few talented programmers write code without a debugger and therefore debuggers are inferior in some way is not a statistically accurate representation of the value of not using or using a debugger. Consider the converse, I wonder how many &lsquo;regular&rsquo; programmers do important work with debuggers that keep our information systems alive? Would it not be the case that the debugger provides a greater net utility to software development? Economics overrides idealism in this argument I believe. </p>
<p>The debugger is faster for a lot of things; though certainly not all things. An example is when I write new code I write unit tests that fail and in the process of their execution I then trigger a break point in my code, at this point I open my IDE&rsquo;s evaluate expression box and write a bunch of code, which I can do incorrectly a large number of times with no time penalty (or a lower time penalty than staring intently at my code and wasting my mental energy to manually execute it in my head which is finite) and when it returns the result I need for the next step of the function/process I just paste the code into my function and move on to the next piece and move my breakpoint as well as restart the test, while !done repeat. In this way I encounter silly syntax mistakes in the debugger and not after a 15-45 second write/test/debug cycle with print statements, and this probably saves days of my life over a year. Many times I will write large sections of my code without running the debugger, but when it fails modifications are much faster in the REPL of the debugger.</p>
<p>I do use print statements/logging to give me a general idea of the state of the program before it failed, but this is just to optimize the time it takes to zero in on the correct breakpoint locations.</p>
<p>I also do write Python which is a lot more dynamic I can import objects in the repl and manipulate as well as explore them (and there are many many objects with many attributes/methods each in a decent sized codebase), and I think for a language like C where the individual context of the point where the debugger freezes is more limited it might be kind of useless and similar to reading a dictionary with a microscope. With python I can hop through the entire call stack, modify things dynamically at run time and inspect the system at a level that&rsquo;s just not possible with printf, assert, log, etc.</p>
<p>Maybe if I was writing mathematical libraries the utility of a debugger would be less useful, but I would write those with a pen and paper first and then put them in code.</p>
<p>I think a balanced diet of logging, unit testing, and debugging is the best option for the work I do (and I believe I represent the general population of people who write software, that is what my job title says, although I may be a bit junior on the CV). Avoiding or ignoring any of those three would be foolish in that it would waste more time and I need my time to be productive and maintain the security of my job, perhaps that is the difference in our perspectives on this element.</p>
<p>I do value your insight and the general message you are trying to portray (or maybe it&rsquo;s just clickbait ; ) of not relying on a single item to the extent that it becomes a crutch, but I think the opposite is also true, in that excluding a valuable tool on dogmatism alone is inviting inefficiency and is also a crutch.</p>
<p>Thanks for the time it took to write this and I will be keeping an eye on how to better incorporate logging in my work in the future.</p>
</div>
<ol class="children">
<li id="comment-636650" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-06-17T13:54:37+00:00">June 17, 2022 at 1:54 pm</time></a> </div>
<div class="comment-content">
<p>Thanks. It is not clickbait. I genuinely do not use debuggers &ldquo;to debug&rdquo; good code that I write and maintain. I do use debuggers for other purposes. And I might use debuggers for other people&rsquo;s code. Debugging with a debugger would be a &ldquo;last resort&rdquo;.</p>
</div>
</li>
</ol>
</li>
<li id="comment-650205" class="pingback odd alt thread-odd thread-alt depth-1">
<div class="comment-body">
Pingback: <a href="https://csvelocity.wordpress.com/2023/04/07/tracing-in-rails/" class="url" rel="ugc external nofollow">Tracing in Rails &#8211; Beyond Velocity</a> </div>
</li>
</ol>
