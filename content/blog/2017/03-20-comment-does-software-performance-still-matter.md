---
date: "2017-03-20 12:00:00"
title: "Does software performance still matter?"
index: false
---

[27 thoughts on &ldquo;Does software performance still matter?&rdquo;](/lemire/blog/2017/03-20-does-software-performance-still-matter)

<ol class="comment-list">
<li id="comment-275953" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://blog.lbs.ca/technology" class="url" rel="ugc external nofollow">Dominic Amann</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-20T20:02:02+00:00">March 20, 2017 at 8:02 pm</time></a> </div>
<div class="comment-content">
<p>I would agree that performance probably only matters in a fraction of all the code written today. Much code is (still) written for batch processes that are run episodically. One can consider a web application to essentially be a batch process.</p>
<p>Additionally, interpreted languages such as Java, Javascript and Python have been designed in part to reduce programming errors (such as memory leaks) and to make correctness more likely, by a number of routes including trivialising certain tasks with libraries and so on. Even C# takes this route.</p>
<p>The prevalence of such languages suggests to me that the industry considers the improvements in correctness are worth the trade-off in performance. In many cases, the performance at the back end will make no difference &#8211; the bottle neck will be the transmission line.</p>
<p>In short &#8211; performance only really matters where it matters &#8211; which is probably in about 1% of the code being written. I have the good fortune to work in such an area &#8211; developing embedded code that must do a lot of number crunching on large datasets (geophysical data, mathematical transformations) on relatively slow (battery powered) systems. I write in C++. I interface with folks who write code where performance does not matter very much &#8211; they write the UI (in Python using Pygame).</p>
</div>
<ol class="children">
<li id="comment-275956" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-20T20:15:32+00:00">March 20, 2017 at 8:15 pm</time></a> </div>
<div class="comment-content">
<p><em>In short â€“ performance only really matters where it matters â€“ which is probably in about 1% of the code being written.</em></p>
<p>Possibly even less than 1%. But a lot of code gets written. And this tiny fraction is still considerable especially if you consider that it may require orders of magnitude more time per line of code to write optimized code than to write generic code.</p>
</div>
</li>
</ol>
</li>
<li id="comment-276000" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/11246ef0203dec00e61a34f4d35987e7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/11246ef0203dec00e61a34f4d35987e7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Paul Jurczak</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-21T05:42:22+00:00">March 21, 2017 at 5:42 am</time></a> </div>
<div class="comment-content">
<p>There is another aspect of software performance &#8211; power efficiency. Computing devices in the USA use more than 2% of total electrical power generated (<a href="http://www.datacenterknowledge.com/archives/2016/06/27/heres-how-much-energy-all-us-data-centers-consume/" rel="nofollow ugc">http://www.datacenterknowledge.com/archives/2016/06/27/heres-how-much-energy-all-us-data-centers-consume/</a>). We are cooking the planet in order to allow hugely wasteful programming techniques, e.g. virtual machines everywhere (dynamic languages, server virtualization), bloated data formats (HTML, JSON), etc. </p>
<p>Maybe this is a reasonable tradeoff, but it is far from clear for a member of older generation who still remembers delivering perfectly useful software fitting in 64KB RAM and running on 4MHz CPU. I&rsquo;m not advocating going back to such drastic resource constraints, but I suggest that 4 orders of magnitude or more increase in computational resources typically available to a person over last couple of decades, did not bring equivalent increase in productivity or any other societal value metric. We are at a point of diminishing returns.</p>
</div>
<ol class="children">
<li id="comment-276043" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-21T13:26:54+00:00">March 21, 2017 at 1:26 pm</time></a> </div>
<div class="comment-content">
<p>@Paul </p>
<blockquote><p>I suggest that 4 orders of magnitude or more increase in computational resources typically available to a person over last couple of decades, did not bring equivalent increase in productivity or any other societal value metric</p></blockquote>
<p>The original PC XT ran on a 130-Watt power supply. You can recharge your iPhone using about 10 Watt-hours, and it will then be good for a day of use. So it seems quite clear that, even though an iPhone does infinitely many things, the PC XT used a lot more power.</p>
<p>We have done a lot of progress. With very little power, we give people access to a world of information. It is easy to believe that yesterday&rsquo;s software was more efficient, but I doubt it. The COBOL and Basic software from the 1980s was not always exactly very efficient.</p>
</div>
<ol class="children">
<li id="comment-276063" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f9ed6413b67cfa6ddc0a37675d9e065a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f9ed6413b67cfa6ddc0a37675d9e065a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stefano</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-21T17:35:45+00:00">March 21, 2017 at 5:35 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>With very little power, we give people access to a world of information.</p></blockquote>
<p>True: present day computers are order of magnitude more power-efficient than the &ldquo;old-days ones&rdquo;.</p>
<p>However mobile applications are backed by huge data centres and internet infrastructure. So when measuring the &ldquo;power footprint&rdquo; it is a little misleading to consider only mobile devices, and not the whole eco-system.</p>
<p>Nevertheless modern data centres are <em>very</em> power efficient: the <a href="https://www.top500.org/green500/list/2016/11/" rel="nofollow">2016-11 Green500 list</a> reports a top performance of 9.4 GFlops/W! (And the excellent document linked by Paul Jurczak confirms this point.)</p>
<p>Modern trends are towards very high energy efficiency: on the hand-held side because we like long battery run times, on the data-center side because nobody wants to pay huge energy bills.</p>
<p>How will this pattern (diffused dark silicon with very bright hot-spots at data-centres) evolve in the near future? I really have no idea (I&rsquo;m not good at making predictions.)</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-276039" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3c4c581d5e782bd1114e3fbb60bc91b7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3c4c581d5e782bd1114e3fbb60bc91b7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mike Yearwood</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-21T13:18:58+00:00">March 21, 2017 at 1:18 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve been programming for over 35 years. Users are always grumbling about slowness. Many times I get amazing performance improvements rewriting others&rsquo; code. Recently I took a 10 hour process and cut it to 30 mins. The original code was written by a guy well versed in his business and language. All I did was apply my own best practices. The point is people don&rsquo;t seem to know how to write really fast code the first time. Why teach the insertion sort algorithm at all since no one ever uses it? Ask anyone how to count weekdays between 2 dates. They use a loop and an if. Which even an 8 year old would do. I use 5/7ths of number of days and correct for start and end. The right way of thinking and experience helps pick good practices.</p>
</div>
</li>
<li id="comment-276041" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fe9dff71939e3547781434a7a16174e6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fe9dff71939e3547781434a7a16174e6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michael Kellett</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-21T13:20:51+00:00">March 21, 2017 at 1:20 pm</time></a> </div>
<div class="comment-content">
<p>The article is written from a very large systems point of view. Most of my work is concerned with single processor systems where low power is key performance requirement. The cost of the processor is frequently important (if you make a lot of widgets then there is a cost attached to16k of code rather than 8k).<br/>
So I spend a fair amount of time carefully tuning for small code size, and fast execution (ie minimizing processor cycles).<br/>
So it comes to what counts as &ldquo;performance&rdquo; &#8211; it varies according to the application but there are plenty of opportunities where traditional speed and smallness are needed.</p>
</div>
<ol class="children">
<li id="comment-276044" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-21T13:30:25+00:00">March 21, 2017 at 1:30 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>The article is written from a very large systems point of view. </p></blockquote>
<p>I do write: &ldquo;computers are asked to do more with less (&#8230;) there is pressure to run the same software on smaller and cheaper machines (such as watches)&rdquo;.</p>
</div>
</li>
</ol>
</li>
<li id="comment-276046" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c2437e72c55ed0b7fb4a252e379677c5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c2437e72c55ed0b7fb4a252e379677c5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alasdair Scott</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-21T14:47:47+00:00">March 21, 2017 at 2:47 pm</time></a> </div>
<div class="comment-content">
<p>When working with minicomputers in the 1970s prior to the PC, boot times were typically less than one second. Now computers and phones etc. often take up to a minute to boot. One of the problems is the current over reliance on textual configuration data in formats such as XML or JSON, and the heavy associated overheads to parse it all. Most of this data never changes, so it would be good if there could be a switch back to appropriate binary formats &#8211; enabling host devices to be ready for use immediately after power-up.</p>
</div>
<ol class="children">
<li id="comment-276047" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-21T14:56:48+00:00">March 21, 2017 at 2:56 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>Now computers and phones etc. often take up to a minute to boot. </p></blockquote>
<p>As a user, I unconcerned by how long computers take to boot because I never boot them. My computers are always powered though they may be asleep.</p>
<p>If you have a macOS, Android or iOS computer, you get &lsquo;instant on&rsquo;. When I lift the lid of my MacBook, the MacBook is already &lsquo;on&rsquo;. It resumes from sleep almost instantly. All modern smartphones and tablets do this also. </p>
<blockquote><p>One of the problems is the current over reliance on textual configuration data in formats such as XML or JSON, and the heavy associated overheads to parse it all. </p></blockquote>
<p>I mostly have a problem loading time with Windows PCs. I am not sure why resuming a Windows laptop from sleep should take seconds, but I strongly suspect it has nothing to do with parsing text files.</p>
</div>
</li>
<li id="comment-276143" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/33008536cdf6697c002fd5f2629ca895?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/33008536cdf6697c002fd5f2629ca895?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bob Kerns</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-22T15:41:58+00:00">March 22, 2017 at 3:41 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t recall anything except extremely minimal OS booting in les than a second! Disks then we&rsquo;re extremely slow. Loading the OS image, checking the filesystem integrity, initializing the slow hardware and verifying it, generally took a small number of minutes. A full check of a large filesystem could take hours. </p>
<p>Sure, RTOS and similar could boot quickly but that is a poor comparison. </p>
<p>Parsing text configuration files is not where any significant part of boot time goes then or today. Even with fast SSD drives you will spend more time reading programs and data from disk than you will parsing. </p>
<p>If it were an actual problem, we would simply cache the result and only parse when the data changes. But the benefit would be negated by the need to have configuration tools to inspect and modify the binary files. </p>
<p>Most configuration files fit in one filesystem cluster, so involve a single disk read, and parse in microseconds. </p>
<p>Windows has the slowest boot times around. It uses binary configuration in the form of the registry. </p>
<p>I don&rsquo;t know why Windows is so slow to boot. It is better than it used to be. It is not so much slower that any one thing stands out. And the answer for my configuration may be different than for yours. </p>
<p>But the real mystery for me is why it is so slow to shut down!</p>
</div>
<ol class="children">
<li id="comment-276144" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-22T15:50:04+00:00">March 22, 2017 at 3:50 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t think that Windows 10 boots slowly though Windows 7 definitively did.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-276050" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4abadf1f953bdc92f0d2305a53a0d580?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4abadf1f953bdc92f0d2305a53a0d580?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Eric Texley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-21T15:44:20+00:00">March 21, 2017 at 3:44 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;Does software performance still matter?&rdquo; I ponder, distracting myself from the swirling Eclipse icon that just appears for no apparent reason. &ldquo;As long as living creatures are mortal, performance matters&rdquo;&#8230;.I say to myself as I call Keil.. &ldquo;You guys still sell a non-eclipse based IDE for ARM, right?&rdquo;</p>
</div>
</li>
<li id="comment-276053" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c2437e72c55ed0b7fb4a252e379677c5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c2437e72c55ed0b7fb4a252e379677c5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alasdair Scott</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-21T16:23:29+00:00">March 21, 2017 at 4:23 pm</time></a> </div>
<div class="comment-content">
<p>You clearly are more disciplined about keeping your phone charged than I sometimes am Daniel!</p>
<p>Sleep modes tend to exacerbate the halting problem and often lead to memory fragmentation, so are not always appropriate.</p>
<p>Also, consider the case of a server virtual host reboot following a lock-up &#8211; not uncommon, regardless of the service provider. For a critical busy website, it can be a tense time waiting to see what damage might have been done.</p>
<p>A typical Linux boot involves reading and parsing many process configuration files and the time is significant.</p>
<p><a href="http://serverfault.com/questions/580047/how-much-data-does-linux-read-on-average-boot" rel="nofollow ugc">http://serverfault.com/questions/580047/how-much-data-does-linux-read-on-average-boot</a></p>
<p>The Windows Registry was a well-meaning attempt to avoid some of this overhead. However, it has not worked out as well as one might have hoped. It is interesting to speculate as to why there has been a preference for text configuration files over a database approach. This returns us to the question: does software performance still matter? As both a (somewhat long in the tooth now) programmer and user, I believe it does and consider lengthy boot-up times one area where it does.</p>
</div>
<ol class="children">
<li id="comment-276064" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-21T17:45:01+00:00">March 21, 2017 at 5:45 pm</time></a> </div>
<div class="comment-content">
<p><em>Also, consider the case of a server virtual host reboot following a lock-up â€“ not uncommon, regardless of the service provider. For a critical busy website, it can be a tense time waiting to see what damage might have been done.</em></p>
<p>Granted. Booting time is critically important in some cases. You wouldn&rsquo;t want your alarm system to reboot for 2 minutes after a failure.</p>
<p><em>You clearly are more disciplined about keeping your phone charged than I sometimes am Daniel!</em></p>
<p>If I pick a device and its battery is empty, the time required to reboot is typically the last of my concerns.</p>
<p><em>Sleep modes tend to exacerbate the halting problem and often lead to memory fragmentation, so are not always appropriate.</em></p>
<p>My impression is that modern operating systems can deal with memory fragmentation without a reboot. </p>
<p><em>It is interesting to speculate as to why there has been a preference for text configuration files over a database approach. </em></p>
<p>The reason is quite clear I think, and closely related to the reason the web is still text driven. It is convenient to have human readable files. And the performance hit is small in most cases. This last point is only true up to a point, of course. </p>
<p><em><br/>
This returns us to the question: does software performance still matter? As both a (somewhat long in the tooth now) programmer and user, I believe it does and consider lengthy boot-up times one area where it does.<br/>
</em></p>
<p>It seems that 10 years ago, people were able to boot up Linux in 5 seconds&#8230; <a href="https://lwn.net/Articles/299483/" rel="nofollow ugc">https://lwn.net/Articles/299483/</a> This old article is amusing&#8230; </p>
<blockquote>
<ul>
<li>
It spends a full second starting the loopback deviceâ€”checking to see if all the network interfaces on the system are loopback.
</li>
<li>
Then there&rsquo;s two seconds to start &ldquo;sendmail.&rdquo; &ldquo;Everybody pays because someone else wants to run a mail server,&rdquo;
</li>
<li>
Another time-consuming process on Fedora was &ldquo;setroubleshootd,&rdquo; a useful tool for finding problems with Security Enhanced Linux (SELinux) configuration. It took five seconds.
</li>
<li>
The X Window System runs the C preprocessor and compiler on startup, in order to build its keyboard mappings.
</li>
<li>
It spends 12 seconds running modprobe running a shell running modprobe, which ends up loading a single module.
</li>
<li>
The tool for adding license-restricted drivers takes 2.5 secondsâ€”on a system with no restricted drivers needed. &ldquo;Everybody else pays for the binary driver,&rdquo;
</li>
<li>And Ubuntu&rsquo;s GDM takes another 2.5 seconds of pure CPU time, to display the background image.</li>
</ul>
</blockquote>
<p>My impression is that with the right configuration, in 2017, it is easy to boot Linux under 5 seconds.</p>
</div>
</li>
</ol>
</li>
<li id="comment-276070" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/70ff9a294fa0d6b740b22d3d72081498?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/70ff9a294fa0d6b740b22d3d72081498?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.guntheroth.com" class="url" rel="ugc external nofollow">Kurt Guntheroth</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-21T19:07:59+00:00">March 21, 2017 at 7:07 pm</time></a> </div>
<div class="comment-content">
<p>Performance matters any time there is a constraint; processor speed, power consumption, run time, response latency, etc.</p>
<p>Performance matters any time your code runs simultaneously on multiple servers, as it becomes the difference between spending on 100 servers or cloud instances, or 1,000.</p>
<p>Performance matters any time you are in a frame-rate or transaction processing rate shootout with a competitor.</p>
<p>Performance (of the other programs) matters any time your code shares the system with other programs.</p>
<p>It doesn&rsquo;t matter how fast a processor is, if 30% of its instructions go to unnecessary code, a program could be made to run 30% faster. It doesn&rsquo;t matter how high the aggregate performance of a multi-core processor is, if your code is single-threaded and has a performance issue.</p>
<p>My book on performance <a href="https://www.amazon.com/dp/1491922060/Optimized-C++" rel="nofollow ugc">https://www.amazon.com/dp/1491922060/Optimized-C++</a></p>
</div>
</li>
<li id="comment-276071" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/99c8cdf5133b9e112df2d270b6b0c820?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/99c8cdf5133b9e112df2d270b6b0c820?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Henri de Feraudy</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-21T19:22:31+00:00">March 21, 2017 at 7:22 pm</time></a> </div>
<div class="comment-content">
<p>In biometrics efficiency is extremely important.<br/>
Suppose you have a fingerprint and you must search through hundreds of millions of recorded fingerprints to see which one matches the closest, then you really need good processing, perhaps clever indexing.<br/>
In image processing it&rsquo;s very important as well.</p>
</div>
<ol class="children">
<li id="comment-276145" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/33008536cdf6697c002fd5f2629ca895?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/33008536cdf6697c002fd5f2629ca895?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bob Kerns</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-22T15:58:13+00:00">March 22, 2017 at 3:58 pm</time></a> </div>
<div class="comment-content">
<p>I will argue for your biometrics example, it is indexing, not coding efficiency that matters. Algorithms and data representation pay off far more than processing speed per se. Often by many orders of magnitude. </p>
<p>By contrast, image processing generally only can be sped up by making the code run faster, parallelism, and making good use of any available GPU. </p>
<p>But producing images from a model puts us largely back into algorithmic territory again at the first level, yet with a need to ship much of the work to the GPU. </p>
<p>It is always about the bottlenecks.</p>
</div>
</li>
<li id="comment-276146" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/33008536cdf6697c002fd5f2629ca895?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/33008536cdf6697c002fd5f2629ca895?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bob Kerns</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-22T16:17:17+00:00">March 22, 2017 at 4:17 pm</time></a> </div>
<div class="comment-content">
<p>The benefit of improving performance must always be weighed against the cost of achieving it and maintaining it.</p>
<p>We have all seen bugs introduced in the quest for performance. Optimizations that over their life won&rsquo;t pay back the CPUA spent compiling them. Optimizations that make the code hard to understand and deter future improvements. </p>
<p>5he challenge is always finding the right &lt;1% of code to optimize. </p>
<p>Compilers and runtimes already do a great job of speeding up the small stuff- &#8211; the constant factor speedups. The payoff there is because the benefit is so ubiquitous. Libraries often provide a similar broad benefit, when key routines are optimized. </p>
<p>Individual application optimizations have to pay off on their own merits, on their on impact on the bottlenecks faced by that application. That can be response time, or scaling, or number of servers to be run&#8230;</p>
</div>
</li>
</ol>
</li>
<li id="comment-276092" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/991c4ced8217cdd213b752de55567257?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/991c4ced8217cdd213b752de55567257?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">TS</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-22T00:01:10+00:00">March 22, 2017 at 12:01 am</time></a> </div>
<div class="comment-content">
<p>There is an exception for the &ldquo;&gt;90% of [possible] optimization are irrelevant&rdquo;: If youÂ´re optimizing for code size it doesnÂ´t matter where the optimization takes place &#8211; as long as it reduces the size of the containing code block it is as useful as any other optimizations. This is mainly interesting for small embedded systems, but might also be useful in situations where fetching code over and over has a relevant performance hit.</p>
<p>Something to note is that fast code is way more important with faster machines: Back in the past no matter how well your software was optimized it would quickly reach the memory and computation limits of the hardware, thus only rather simple problems were practical. Today computation power is many magnitudes higher, thus the difference between well-performing and slow software makes more difference than ever before: Maybe not for a simple word processor, but definitely for stuff like video encoding, any kind of detailed simulation (no matter if it is research or gaming), image processing,&#8230;. Not to mention that todays multi-core hardware with parallel processing and several layers of memory as well as lots of specialized add-ons is more complex than older hardware where the hardware behaves more uniform.</p>
<p>However, today the most relevant performance difference is caused by perceived difference: An application which always reacts in a fraction of a second will be perceived as being quicker than a benchmark-winning piece of software which takes an occasional multi-second break here and then.</p>
</div>
</li>
<li id="comment-276100" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/25999b45c3bd15412dbf85ca281cde8f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/25999b45c3bd15412dbf85ca281cde8f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Peter Boothe</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-22T03:11:30+00:00">March 22, 2017 at 3:11 am</time></a> </div>
<div class="comment-content">
<p>The &ldquo;datacenter tax&rdquo; is pretty severe &#8211; <a href="http://www.eecs.harvard.edu/~skanev/papers/isca15wsc.pdf" rel="nofollow ugc">http://www.eecs.harvard.edu/~skanev/papers/isca15wsc.pdf</a> &#8211; and represents 30% of the load in most datacenters. Every percentage improvement can represent real money if there are enough datacenters involved.</p>
</div>
</li>
<li id="comment-276156" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/339a4588f298b385c4cbe6ba154b2794?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/339a4588f298b385c4cbe6ba154b2794?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Steffen Guhlemann</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-22T19:18:50+00:00">March 22, 2017 at 7:18 pm</time></a> </div>
<div class="comment-content">
<p>Some remarks:<br/>
1. one has to distinguish between 3 impacts of how performant something is:<br/>
a) immediate response on gui actions (not just in games): If i click a checkbox, i want to see immediately, what that means for my data.<br/>
b) throughput: how much data can i process in a given timeframe (usually on a server, but we do stuff like this also on a client)<br/>
c) general resource usage: if everything happens fast enough using all my cpu cores, i might be unable to browse the web in the mean time, because my whole computer is unresponsive</p>
<p>2. Nobody mentioned the power of time complexity. I deal a lot with problems at work, that are more than linear in time. The chess problem is a good example of this. This is an exponential problem, which means, if my computer now is 1 million times faster than in the 80ies, i can now just look 4 halfsteps more ahead. This will probably not help me, beat a median level chess player, i need other techniques, not to bit-bash-optimizes the linear program flow, but to reduce the exponent in the exponential time complexity.<br/>
For problems like this, pure speed means not so much. One really needs to think about efficient algorithms to beat a human master chess player.<br/>
=&gt; That means, efficient algorithms not only reduce user waiting time a bit, they really allow us to process problems, we could not solve otherwise (and still could not solve, if we only relied on computers getting faster)</p>
</div>
<ol class="children">
<li id="comment-276157" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-22T19:35:26+00:00">March 22, 2017 at 7:35 pm</time></a> </div>
<div class="comment-content">
<p><em>efficient algorithms not only reduce user waiting time a bit, they really allow us to process problems, we could not solve otherwise</em></p>
<p>I would argue that this is true of software performance in general, not just of algorithms. It is common to take one fixed algorithm and to improve its implementation to get a 10x gain. Well, a 10x gain can make something that is not financially viable, and make it practical.</p>
</div>
</li>
<li id="comment-280082" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/176e6f4febc3750a6f3dbf0b4ed4aba6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/176e6f4febc3750a6f3dbf0b4ed4aba6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">TS</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-20T16:05:14+00:00">May 20, 2017 at 4:05 pm</time></a> </div>
<div class="comment-content">
<p>Time (and also space) complexity actually is what I was referring to with &rdquo; fast code is more important with faster machines&rdquo;:</p>
<p>In general optimized algorithms have a rather high per-step or setup cost, non-linear access patterns, reduced flexibility, complicated write/parallel access, etc. compared to simple flat array or list structures. Thus the benefit isnÂ´t visible until a certain data size is reached &#8211; which is more likely with increasing processing power as it usually comes with increased storage capabilities.</p>
<p>Another important factor is hardware latency: A O(n) algorithm running in main memory can crunch through gigabytes whenever a O(log n) algorithm working on disk storage is waiting for each of its few bytes accessed. Even worse with parallel algorithms which are often quickly limited by contention issues.<br/>
Thus, proper data layout and partitioning is an important part in getting full benefit of a certain algorithm as well.</p>
<p>In reality the data and requirements often changes over time, thus an implementation which serves the original demand perfectly might perform rather poor after a while, thus regularly adapting and rewriting parts is an important part for software performance as well &#8211; most likely the hardest one since business is often unwilling to spend effort on something which still works somewhat well and the degradation usually happens slowly and is masked by technology advancements to a certain degree.</p>
</div>
</li>
</ol>
</li>
<li id="comment-276449" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5c707672f157d85209a49302acab78d0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5c707672f157d85209a49302acab78d0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.joseduarte.com" class="url" rel="ugc external nofollow">Joe Duarte</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-27T03:17:33+00:00">March 27, 2017 at 3:17 am</time></a> </div>
<div class="comment-content">
<p>Daniel, this reminds me that your integer libraries are outstanding.</p>
<p>Separately, I think performance could be made to matter much more to users if an enterprising company offered a clean-sheet, profoundly faster OS. Legacy OSes â€“ Windows 10, macOS, Linux â€“ are all unreasonably slow (though as you said Windows is slowest, probably because Macs are SSD-only these days, at least the laptops).</p>
<p>None of theses OSes are architected for instant response to trivial user actions, and at this point I think it&rsquo;s reasonable to expect computers to complete trivial tasks instantly, where &ldquo;instant&rdquo; is a half-second or less. An InstantOS would fully open any and all applications instantly, and the apps would be completely ready for whatever subsequent actions a user could take at that stage. It would also close apps instantly, both visibly and with respect to background tasks and memory usage. We&rsquo;re still waiting far too long for apps to open, and for them to do things, and a consistently half-second or faster response would change the experience of using a computer.</p>
<p>Even Macs are much slower than this most of the time. I don&rsquo;t think users will understand the advantage of an InstantOS until they actually use it and are made to comprehend how long they&rsquo;ve been waiting on computers to do stuff, and how it feels to use an InstantOS. Until then, lots of people will mouth nonsense about performance not mattering, because they don&rsquo;t know what a performant computer feels like.</p>
<p>So I think it&rsquo;s a great time for a team to build a new OS. Everyone&rsquo;s asleep and thinks that Windows and Mac are good enough. They&rsquo;ll keep thinking that until someone shows them what&rsquo;s possible (and a new OS could take the opportunity to have fundamentally different security properties, more secure by design â€“ e.g. it&rsquo;s completely absurd that data can leave our computers without our awareness or any easy user insight or control into the process. That&rsquo;s a core dependency of many, many hacks, that our computers allow massive outbound traffic with little control or transparency.)</p>
<p>A reasonable OS should also boot instantly (you referred to wake-up, but booting still matters to some people).</p>
</div>
<ol class="children">
<li id="comment-276478" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-27T13:28:29+00:00">March 27, 2017 at 1:28 pm</time></a> </div>
<div class="comment-content">
<p><em>though as you said Windows is slowest</em></p>
<p>To clarify: I wrote that macOS had &ldquo;instant on&rdquo; recovery from sleep mode whereas Windows did not.</p>
</div>
</li>
</ol>
</li>
<li id="comment-294082" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/84d586b91ff37698ff9dd7cdcd629d50?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/84d586b91ff37698ff9dd7cdcd629d50?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.belatrixsf.com" class="url" rel="ugc external nofollow">Belatrix Software</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-27T13:18:26+00:00">December 27, 2017 at 1:18 pm</time></a> </div>
<div class="comment-content">
<p>Software performance only matters a minute fraction. Genuine software innovation center companies understand that the value of actual code behind that software is what matters the most not its size. Quite a Blog. Keep Writing.</p>
</div>
</li>
</ol>
