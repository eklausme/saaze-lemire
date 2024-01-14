---
date: "2017-07-15 12:00:00"
title: "What is &#8220;modern&#8221; programming?"
index: false
---

[23 thoughts on &ldquo;What is &#8220;modern&#8221; programming?&rdquo;](/lemire/blog/2017/07-15-what-is-modern-programming)

<ol class="comment-list">
<li id="comment-283343" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/13d8ad84212acddbfb7242900f6ee1cf?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/13d8ad84212acddbfb7242900f6ee1cf?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">David Poole</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-15T17:56:20+00:00">July 15, 2017 at 5:56 pm</time></a> </div>
<div class="comment-content">
<p>The use of container technology also helps. My code is developed into a Docker container and on passing all tests gets added to a repository of Docker images. That image is deployed to any post development environment and we can absolutely guarantee that the app will behave identically in all environments.<br/>
For me having consistent environments has revolutionised what we do.</p>
</div>
<ol class="children">
<li id="comment-283344" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-15T17:58:39+00:00">July 15, 2017 at 5:58 pm</time></a> </div>
<div class="comment-content">
<p>Right, so my list is not meant to be exhaustive. There are many &ldquo;modern&rdquo; things in programming&#8230; that came out in the last decade.</p>
</div>
</li>
</ol>
</li>
<li id="comment-283345" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f2f50209e20d463abe3cd859f3ecb057?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f2f50209e20d463abe3cd859f3ecb057?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://endormitoire.wordpress.com" class="url" rel="ugc external nofollow">Benoit St-Jean</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-15T18:19:51+00:00">July 15, 2017 at 6:19 pm</time></a> </div>
<div class="comment-content">
<p>Ever had to code in Smalltalk? I suggest you try Pharo : you&rsquo;ll be blown away!!</p>
</div>
</li>
<li id="comment-283348" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/306747eda5c2ffeb8d3e714aeb95877c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/306747eda5c2ffeb8d3e714aeb95877c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://johnrom.com" class="url" rel="ugc external nofollow">John Rom</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-15T18:58:34+00:00">July 15, 2017 at 6:58 pm</time></a> </div>
<div class="comment-content">
<p>You wrote, &lsquo;Visual Studio is not modern, this is what a modern dev environment should do,&rsquo; and then listed a ton of things that VS does pretty well within its target stack. Granted, I only use VS for full-stack enterprise-level asp.net, but I just figured I&rsquo;d point out that it supports:</p>
<p>&#8211; auto formatting<br/>
&#8211; node and other flavors of build tools<br/>
&#8211; unit testing<br/>
&#8211; nuget in asp.net at least, which means fewer &lsquo;hard dependencies&rsquo;<br/>
&#8211; continuous integration<br/>
&#8211; containerization (or will soon)</p>
<p>That said, I generally step out of the full IDE and recommend VS Code, Atom etc when it comes to working outside of the asp.net stack (and soon even for asp.net core) and using Git, ci, and Docker.</p>
<p>My only point is that all the editors have their pros, and you can use them all in an antiquated fashion, but I don&rsquo;t agree with blaming VS for that, and in fact I think recent iterations of VS have really kept up with a modern dev environment for its stack. (stepping into 2010 for some projects though&#8230; Ugh).</p>
<p>But I agree in that we should be educating new devs on the proper build pipeline regardless of the stack and editor they use, because ftp ugh.</p>
</div>
<ol class="children">
<li id="comment-283352" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-15T19:37:46+00:00">July 15, 2017 at 7:37 pm</time></a> </div>
<div class="comment-content">
<p><em>You wrote, â€˜Visual Studio is not modern, this is what a modern dev environment should do,&rsquo;</em></p>
<p>That&rsquo;s not what I wrote.</p>
<p>What I am saying is that if you go back 20, 30 years ago&#8230; there were things that looked like modern-day Visual Studio. The graphical interface is very much old school. So, using Visual Studio in 2017 does not make you &ldquo;modern&rdquo;.</p>
<p>Regarding Microsoft in general, they are definitively embracing best practices and helping to move the field in the right direction.</p>
</div>
<ol class="children">
<li id="comment-283358" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/10de3426654a2eec114b3d198bd7c6d0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/10de3426654a2eec114b3d198bd7c6d0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.jakubpas.net" class="url" rel="ugc external nofollow">Jakub PaÅ›</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-15T22:44:04+00:00">July 15, 2017 at 10:44 pm</time></a> </div>
<div class="comment-content">
<p>There are several other features worth notting for modern IDE&rsquo;s like InteliJ:<br/>
&#8211; refactoring, extracting methods, subclasses, crateing interfaces from implementations and vice versa&#8230;<br/>
&#8211; hinting &#8211; not only syntax highlighting but performance tips ets, predicted compilation and runtime errors<br/>
&#8211; database connections, persistance, ER diagrams to/from entities and classes<br/>
&#8211; automatic code generaion: test cases, surrounding, wrapping with loops/try-catch and so on</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-283353" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/377b00bebbba9c6ecff8f05cbf606edf?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/377b00bebbba9c6ecff8f05cbf606edf?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.outsystems.com" class="url" rel="ugc external nofollow">Pedro Oliveira</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-15T20:06:19+00:00">July 15, 2017 at 8:06 pm</time></a> </div>
<div class="comment-content">
<p>Modern programming is less programming. It&rsquo;s building your app at a higher abstraction level using visual languages and low code tools where you can focus on the core of what you want to build and not in all the boiler plate around it, therefore delivering much faster.</p>
<p><a href="https://www.outsystems.com/low-code-platforms/" rel="nofollow ugc">https://www.outsystems.com/low-code-platforms/</a></p>
</div>
</li>
<li id="comment-283365" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-16T01:30:59+00:00">July 16, 2017 at 1:30 am</time></a> </div>
<div class="comment-content">
<p>To be fair, this part seems unusual to me:</p>
<p>&gt; So what happens when you work with smart students who never learned about modern programming?<br/>
&gt; They look at a command like go get and they only see the skin (a command line).<br/>
&gt; They think it is backward. Where are the flashy graphics?</p>
<p>My experience is that most students (here I mean post-secondary students) are well-accustomed to the command line, and are (initially) tied very little to IDEs, or at least understand very well how to use their favored IDE to develop against most projects. Indeed, though my entire post-secondary education IDEs were basically invisible. The religions of recent students seem to be more about languages, licenses and development philosophies than specific IDE choies.</p>
<p>In the real world, including &ldquo;students&rdquo; who self-learn and perhaps students of schools that actually include IDEs in the curriculum (which?), I think you really want to do two things: make your code portably compilable with the standard platform capabilities, and at least ensure it isn&rsquo;t hostile to IDE use. On unix-like platforms that generally means a make, autotools or cmake build (or at least something that boils down to the same thing) and at least fixing bug reports from IDE users that don&rsquo;t otherwise compromise the software.</p>
<p>On Windows platforms, it&rsquo;s a bit tougher because of the large gulf in functionality between approximately POSIX-compliant software and Windows, but you can get pretty close with MinGW and cmake, or even cmake alone (depending on the source).</p>
</div>
</li>
<li id="comment-283367" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/af313e1141717f494075d9f06a3358de?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/af313e1141717f494075d9f06a3358de?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">John Smith</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-16T02:33:40+00:00">July 16, 2017 at 2:33 am</time></a> </div>
<div class="comment-content">
<p>The problem with all these general advice about programming is that you never show what you have accomplished. Point to a successful software project where your methods were employed so we can have some verifiable proof that you are actually a productive programmer and not an ivory tower professor with no experience in the real world. Have you ever worked in a real company?</p>
<p>Kind regards,<br/>
John Smith</p>
</div>
<ol class="children">
<li id="comment-283372" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-16T03:45:48+00:00">July 16, 2017 at 3:45 am</time></a> </div>
<div class="comment-content">
<p>I make it easy to find out about me.</p>
</div>
</li>
<li id="comment-283409" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Leonid Boytsov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-17T02:11:14+00:00">July 17, 2017 at 2:11 am</time></a> </div>
<div class="comment-content">
<p>Tell us about your real world experience, we are dying to be amazed.</p>
</div>
</li>
</ol>
</li>
<li id="comment-283368" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ebb23c3b7ceb0dfabb0f833d673bc07a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ebb23c3b7ceb0dfabb0f833d673bc07a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Gene Arthur</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-16T03:06:44+00:00">July 16, 2017 at 3:06 am</time></a> </div>
<div class="comment-content">
<p>Started programming in 1980, with extended basic on a Ti99, with 16k of memory, 13K USABLE FOR PROGRAM., Moved up to a Osborne, with64k memory, and an about 4 inch green screen built in, Z80 cpu. 8080/z80 assembly, basic, forth, and yuck, Cobal.. verbose, Fortran.. Then Compaq Deskpro, 640k mem, 20meg hardrive, TI LISP, ICON,C, TURBO PASCAL, FORTH. I still use Unicon-lang and Icon. Many boxes later, Added: C,PHP, Prolog, &#8230; then around 2002, Haskell. That has been the most mind expanding/busting, ever since, along with still using Icon/Unicon for scripting, and utilities. Not a fan of object oriented langs. Elixir is one that I will be Trying in earnest soon. That could be I think a super addition, love what I&rsquo;ve seen so far.. was put off with the Erlang syntax, but elixir has put a clean face on the great erlang run-time. Cheers, gene</p>
</div>
</li>
<li id="comment-283381" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">jld</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-16T08:41:13+00:00">July 16, 2017 at 8:41 am</time></a> </div>
<div class="comment-content">
<p>&ldquo;Modern programming&rdquo; is very easy:<br/>
You just need to be politically correct in your programming and voila! you&rsquo;re modern 😀</p>
</div>
</li>
<li id="comment-283383" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e90d667b01b7b8df139d2b512f946cc2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e90d667b01b7b8df139d2b512f946cc2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alexander Smith</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-16T09:02:36+00:00">July 16, 2017 at 9:02 am</time></a> </div>
<div class="comment-content">
<p>One key aspect around go is that it&rsquo;s spec is about 1/6 of the size of Java. This makes training and ramping up significantly faster and cheaper.<br/>
Also modern programming is much more functional/ immutable/ stream &#8211; closure based than it used to be ( leads to more reliable concurrent code). </p>
<p>To me powerful ide&rsquo;s are often a sticking plaster for a language/framework&rsquo;s deficiencies.</p>
</div>
</li>
<li id="comment-283393" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/50326051fa7ade46a9242e5ac6edcf7d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/50326051fa7ade46a9242e5ac6edcf7d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Hicham Assoudi</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-16T12:28:31+00:00">July 16, 2017 at 12:28 pm</time></a> </div>
<div class="comment-content">
<p>Very nice post Prof. Daniel. In my opinion &ldquo;Modern Programming&rdquo; is a paradigm shift that goes hand in hand with &ldquo;Modern Applications&rdquo; e.g. Mobile and cloud based applications. In fact, for some legacy applications (e.g. packaged application), which already have their own dev/deployment processes a and frameworks, its hard to introduce and sell the modern programming approach to the project decision makers.<br/>
Cheers</p>
</div>
</li>
<li id="comment-283413" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/34b5ec4a143dd4a12a8be0a65f71b0df?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/34b5ec4a143dd4a12a8be0a65f71b0df?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://vlasovstudio.com/" class="url" rel="ugc external nofollow">Sergey Vlasov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-17T04:33:16+00:00">July 17, 2017 at 4:33 am</time></a> </div>
<div class="comment-content">
<p>How about adding stackoverflow.com to the list?</p>
<p>20 years ago we used offline API documentation describing function parameters. Today we google complete, ready to use code fragments for all common tasks.</p>
</div>
<ol class="children">
<li id="comment-283432" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-17T13:20:10+00:00">July 17, 2017 at 1:20 pm</time></a> </div>
<div class="comment-content">
<p><em>How about adding stackoverflow.com to the list?</em></p>
<p>I think that this is closely related to &ldquo;programming is social&rdquo;. We used to program in closed silos, with reference books and limited teams. This is no longer true.</p>
</div>
</li>
</ol>
</li>
<li id="comment-283431" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://blog.lbs.ca/technology" class="url" rel="ugc external nofollow">Dominic Amann</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-17T12:31:39+00:00">July 17, 2017 at 12:31 pm</time></a> </div>
<div class="comment-content">
<p>A key commonality of all the aspects that are described as &ldquo;modern programming&rdquo; is that they are relatively recent (not over 20 years old) as &ldquo;best practice&rdquo;. I would put &ldquo;Learning on the job&rdquo; (or Just in Time) as the key attribute for a modern programmer.</p>
<p>I have been at it for 30 years, and I learn something new at least every year. In the last 10 I added git, jenkins, docker, snap, vscode on linux, boost::test, agile (scrum), Raspberry Pi, Arduino, Python and many others to my arsenal, and I look forward (with some trepidation) to the next (r)evolution.</p>
</div>
</li>
<li id="comment-283527" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b2464f71fe78e950c09ea7fc141832cc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b2464f71fe78e950c09ea7fc141832cc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">lavita-rica.com</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-20T15:35:33+00:00">July 20, 2017 at 3:35 pm</time></a> </div>
<div class="comment-content">
<p>What majority of supposed graduates of whatever programming related education you care to cite are basically ignorant of the importance and qualities of a stack?</p>
</div>
</li>
<li id="comment-283556" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/70da8631de4162dbc27f1aedd91de000?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/70da8631de4162dbc27f1aedd91de000?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">'No Bugs' Hare</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-21T13:25:35+00:00">July 21, 2017 at 1:25 pm</time></a> </div>
<div class="comment-content">
<p>IMNSHO, modern programming is <em>exactly</em> the same as &ldquo;old&rdquo; programming. Exactly like 20 years ago (when I started my architectural career as a co-architect of a stock exchange) programming is all about getting things done. </p>
<p>Everything else is just a tool in a toolbox to achieve that task. Moreover &#8211; whatever-fans-of-specific-technology-will-tell-you &#8211; most of the modern tools may be a blessing or a curse depending on specifics. Examples are numerous, including but not limited to: (a) automated deployment button being devastating if it gets to wrong hands; (b) over-reliance on IDE debugger which becomes a detriment for a wide class of debugging problems (people spend too much time trying to follow the code, when logging shows the problem much better); (c) over-reliance on IDE class browsers &#8211; which leads to crappy source file organization and reduces code readability (and to make things worse &#8211; it supports a misunderstanding that design is about classes, while way too often class is way too small unit for thinking about the code); (d) over-reliance on automated testing (especially on automated _unit_ testing) leads to false sense of security &#8211; and unit testing is known to be of extremely little value at least in real-world interactive systems (=&rdquo;if you want to avoid regressions, code review &#8211; in addition to automated testing &#8211; is a MUST&rdquo;). And so on, and so forth. </p>
<p>Looking at the very same thing from a bit different perspective &#8211; we can say <em>exactly</em> as 30 years ago, the real art of programming has nothing with the book by Knuth (it is a really good book, but it is about science, not art); rather &#8211; the real art of programming is all about finding what out of all those shiny-things-in-the-toolbox is applicable <em>to your specific project</em>, and what is not.</p>
</div>
</li>
<li id="comment-283769" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f4c6d75f1aa18c05ba127a6f7e3dc40f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f4c6d75f1aa18c05ba127a6f7e3dc40f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">H. Sahyoun</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-31T00:00:58+00:00">July 31, 2017 at 12:00 am</time></a> </div>
<div class="comment-content">
<p>Prof,</p>
<p>Your Student.</p>
<p>In modernisation let talk cloud, git, etc. There is the question of security issues.</p>
<p>Second, 5 gl or 6 gl languages or ide make no smart effort to build your own tool but you&rsquo;ll be dependable on others.</p>
<p>An opinion from you master&rsquo;s degree student.</p>
<p>Kind regards</p>
<p>H. Sahyoun</p>
</div>
</li>
<li id="comment-285753" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3b62f80b2115b63cc987021a817dbd2f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3b62f80b2115b63cc987021a817dbd2f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://junjiah.com" class="url" rel="ugc external nofollow">Junjia</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-12T08:16:21+00:00">September 12, 2017 at 8:16 am</time></a> </div>
<div class="comment-content">
<p>hi Professor Daniel,</p>
<p>can I ask your permission to translate this blog post to Chinese and publish in my blog with reference and citation?</p>
<p>thanks!<br/>
Junjia</p>
</div>
<ol class="children">
<li id="comment-285759" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-12T12:01:55+00:00">September 12, 2017 at 12:01 pm</time></a> </div>
<div class="comment-content">
<p>Yes, you can translate and repost the content.</p>
</div>
</li>
</ol>
</li>
</ol>
