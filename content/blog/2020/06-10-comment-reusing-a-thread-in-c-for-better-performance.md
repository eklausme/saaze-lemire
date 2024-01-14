---
date: "2020-06-10 12:00:00"
title: "Reusing a thread in C++ for better performance"
index: false
---

[15 thoughts on &ldquo;Reusing a thread in C++ for better performance&rdquo;](/lemire/blog/2020/06-10-reusing-a-thread-in-c-for-better-performance)

<ol class="comment-list">
<li id="comment-525946" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/95a20051ae9a0bd56b2feb2d6a3763f8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/95a20051ae9a0bd56b2feb2d6a3763f8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">KasOb.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-11T09:15:38+00:00">June 11, 2020 at 9:15 am</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,<br/>
<em>(Been following this blog for years, yet this is my first comment.)</em></p>
<p>Every now and then and for very long time, this subject was intriguing me, i have similar result like yours, and that is not the question, the question is why CPU technology/industry is and was mostly driven by the need for more speed and more cores, yet it doesn&rsquo;t focus or even ignore this exact point, switching between thread, i mean GPU&rsquo;s have hundreds cores, CPU&rsquo;s already have tens, yet having specific instruction like similar to HLT (halt) to be waked up by another instruction or dedicated instructions set to time very short sleep to save power, this might be very useful and will boost the speed in cases or save power in different cases,<br/>
Why the need of switching between threads in an efficient way seems to be like not important or not a priority?</p>
<p>For me it looks like been decided, this one is a software issue to resolute or to live with, yet those CPU technologies do evolve to hasten specific software problems, may be it is hard or wrong to do in hardware, may be, on other hand seeing what was considered to be hard or impossible 15 or 20 years ago <em>(or even more)</em> , in a device you can hold in one hand does means one thing, that hard and impossible are relative matter and not absolute.<br/>
Is it wrong to begin with ? or just wrong now in relative to our time, and this can be seen differently in few years.</p>
<p>Daniel, i would love to read your opinion and thoughts about that, may be blog post.</p>
</div>
<ol class="children">
<li id="comment-526039" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3b22a16d5d87f2747684b614a3fd5f0d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3b22a16d5d87f2747684b614a3fd5f0d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Jorge</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-12T13:12:59+00:00">June 12, 2020 at 1:12 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
switching between threads in an efficient way seems to be like not important or not a priority
</p></blockquote>
<p>It is very application dependent. In HPC (scientific computing) programs typically pin one thread to each core so they don&rsquo;t disturb each other, meanwhile operative systems are optimized to minimize the noise introduced by other applications taking CPU time.</p>
<blockquote><p>
yet having specific instruction like similar to HLT (halt) to be waked up by another instruction or dedicated instructions set to time very short sleep to save power
</p></blockquote>
<p>In Intel processors you already got something like that. The instructions monitor and mwait track a memory location and put the core in a low power state. The problem is that it is processor specific and not portable to other platforms.</p>
</div>
</li>
<li id="comment-526106" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/95ecc9e1db5fa222b6cff691ed31c8d1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/95ecc9e1db5fa222b6cff691ed31c8d1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://nicolas.braud-santoni.eu" class="url" rel="ugc external nofollow">nicoo</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-13T18:03:20+00:00">June 13, 2020 at 6:03 pm</time></a> </div>
<div class="comment-content">
<p>Hi KasOb,</p>
<p>There&rsquo;s definitely a lot going on in CPU technology to reduce the cost of concurrency and context switching:</p>
<p>Hyperthreads are definitely the most well-known: the CPU exposes a single core (with a single set of execution ports) as a pair of “logical” cores to the OS, which can schedule 2 different tasks on it; the CPU executes both tasks interleaved, and whenever one task blocks (for instance, due to a cache miss or atomic memory operation, or if it&rsquo;s spinning over a lock and signals it with <code>mm_pause</code>) the other task can run.<br/>
In a more-traditional system (no HT, software scheduler) the cycles that the task spent blocking would simply be “lost” (no useful work happening).<br/>
New concurrency-related hardware features (lock elision, hardware transactional memory, &#8230;) enable faster implementations of locks/semaphores, work queues, etc&#8230;<br/>
Those hardware features are not really consumed directly by most software engineers, as they require very specialised knowledge to use effectively, but libraries of high-performance concurrency primitives tend to leverage them.<br/>
On ARMv8 CPUs, the <a href="https://developer.arm.com/docs/ddi0337/e/nested-vectored-interrupt-controller/about-the-nvic" rel="nofollow ugc">NVIC</a> (Nested Vectored Interrupt Controller) supports fairly complex/flexible task configurations.<br/>
For instance, the <a href="https://rtic.rs/0.5/book/en/" rel="nofollow ugc">RTIC</a> (Real-Time, Interrupt-driven Concurrency) framework reduces a program&rsquo;s scheduling policy (i.e. the relative priorities of various tasks) to an NVIC configuration at compile time, meaning that all context switching and task management is managed by the hardware, rather than having a software scheduler. Cherry on top, RTIC extracts information about which resources are used by each task, to both avoid unnecessary locks (if a task uses a given shared resource, but no higher-priority task does, it can safely avoid taking-and-releasing the lock) and avoid unnecessarily blocking (when a task <code>A</code> is in a critical section, only tasks which use some of the same resources are blocked; higher-priority tasks that do not interact with <code>A</code> can still preempt it as needed).<br/>
I&rsquo;m not aware of any general-purposed OS doing this, though. 🙁</p>
</div>
<ol class="children">
<li id="comment-526154" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/95a20051ae9a0bd56b2feb2d6a3763f8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/95a20051ae9a0bd56b2feb2d6a3763f8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KasOb.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-14T15:49:41+00:00">June 14, 2020 at 3:49 pm</time></a> </div>
<div class="comment-content">
<p>Thank you Nicolas,</p>
<p>What did you described about ARMv8 is in fact very interesting <em>(i didn&rsquo;t know that)</em> , also reading that Apple will release its Mac with ARM processors in 2021, indicate the processing technology race is not slowing down on contrary it is picking up pace.</p>
<p>The Cherry you mentioned, IMHO it makes sense to be used to simplify the multi-reader single-writer implementation <em>(may be for multi-writer in atomic behaviour !)</em>, to provide higher level of efficiency with lower power consumption.</p>
<p>Thank you again for replying with these information.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-525960" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/119cbb15cdeb3958ea358e52b0cb7d84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/119cbb15cdeb3958ea358e52b0cb7d84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Vk3y</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-11T11:19:18+00:00">June 11, 2020 at 11:19 am</time></a> </div>
<div class="comment-content">
<p>Hope you will do optimization research on JavaScript 😭 plz</p>
</div>
</li>
<li id="comment-525964" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/10c44e0d9568e48d05708ae196ad936f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/10c44e0d9568e48d05708ae196ad936f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Rozenberg, Eyal</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-11T12:55:45+00:00">June 11, 2020 at 12:55 pm</time></a> </div>
<div class="comment-content">
<p>Why implement your own 1-thread <a href="https://en.wikipedia.org/wiki/Thread_pool" rel="nofollow ugc">thread pool</a>? Just use an existing library. <a href="https://duckduckgo.com/?q=thread%20pool" rel="nofollow ugc">DuckDuckGo Search</a>.</p>
</div>
<ol class="children">
<li id="comment-525965" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-11T13:13:55+00:00">June 11, 2020 at 1:13 pm</time></a> </div>
<div class="comment-content">
<p><em>Why implement your own 1-thread thread pool</em></p>
<p>To run benchmarks so that we can understand what the trade-offs are.</p>
</div>
</li>
</ol>
</li>
<li id="comment-525974" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://blog.lbs.ca/blog" class="url" rel="ugc external nofollow">Dominic A Amann</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-11T14:04:38+00:00">June 11, 2020 at 2:04 pm</time></a> </div>
<div class="comment-content">
<p>In our case, since the operating system closes a thread down in its own time, we quickly ran out of threads using the first approach. Re-using the thread was the only workable solution.</p>
</div>
<ol class="children">
<li id="comment-525988" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-11T16:02:25+00:00">June 11, 2020 at 4:02 pm</time></a> </div>
<div class="comment-content">
<p>It is intriguing. Did you join your threads and still get the problem? I am hoping that once the call to join succeeds, the thread is gone. Callign detach would be something else&#8230; but I hope that &ldquo;join&rdquo; actually cleans the thread up&#8230;</p>
</div>
</li>
</ol>
</li>
<li id="comment-526021" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ecfedbd5939b3c499404a41be0eb6dd4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ecfedbd5939b3c499404a41be0eb6dd4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Rudi</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-12T06:11:28+00:00">June 12, 2020 at 6:11 am</time></a> </div>
<div class="comment-content">
<p>The spinlock approach is something that should be avoided by any means. Especially on single core machines this will effectvely kill the performance of the whole system. I would never ever do that!</p>
</div>
</li>
<li id="comment-526046" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/710874b630f0c67517df9d070f1ec0ff?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/710874b630f0c67517df9d070f1ec0ff?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ryan Olson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-12T17:51:34+00:00">June 12, 2020 at 5:51 pm</time></a> </div>
<div class="comment-content">
<p>I like to use a ThreadPool for such circumstances.</p>
<p>This is a nice implementation.</p>
<p><a href="https://github.com/progschj/ThreadPool" rel="nofollow ugc">https://github.com/progschj/ThreadPool</a></p>
</div>
</li>
<li id="comment-526047" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/710874b630f0c67517df9d070f1ec0ff?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/710874b630f0c67517df9d070f1ec0ff?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ryan Olson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-12T17:54:05+00:00">June 12, 2020 at 5:54 pm</time></a> </div>
<div class="comment-content">
<p>PS &#8211; subscribing without comment is broken.</p>
</div>
<ol class="children">
<li id="comment-526067" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-12T22:26:09+00:00">June 12, 2020 at 10:26 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>PS – subscribing without comment is broken.</p>
</blockquote>
<p>I am not sure what this means. Can you elaborate?</p>
</div>
</li>
</ol>
</li>
<li id="comment-526103" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/95ecc9e1db5fa222b6cff691ed31c8d1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/95ecc9e1db5fa222b6cff691ed31c8d1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://nicolas.braud-santoni.eu" class="url" rel="ugc external nofollow">nicoo</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-13T17:12:19+00:00">June 13, 2020 at 5:12 pm</time></a> </div>
<div class="comment-content">
<p>Some quick observations you might not be aware of:</p>
<p>when spinning on a lock, it&rsquo;s usually a good idea to emit an instruction signalling that to the CPU (<a href="https://software.intel.com/sites/landingpage/IntrinsicsGuide/#text=_mm_pause&amp;expand=4141" rel="nofollow ugc"><code>mm_pause</code></a> on x86/amd64, <a href="http://infocenter.arm.com/help/index.jsp?topic=/com.arm.doc.dui0473j/dom1361289926796.html" rel="nofollow ugc"><code>yield</code></a> on Arm) : it enables optimisations such as switching to another hyperthread on the same core when waiting for the lock, or going low-power (modern CPUs are often bottlenecked by heat management, so going low-power can let other, useful work happen at a higher clock frequency)<br/>
good mutex and work queues implementations already spin for a short while (to optimise away the context switch when duty cycle is high) before parking the thread (typically using a <a href="https://man7.org/linux/man-pages/man7/futex.7.html" rel="nofollow ugc"><code>futex</code></a>, so the OS scheduler knows exactly when to wake up a thread as work becomes available) ; I wasn&rsquo;t quite capable of figuring out what the GNU <code>libstdc++</code> does, from reading the relevant code, but it seems not to do spin-then-futex for some reason.<br/>
in more general work-queue usecases, using a spinlock alone is susceptible to priority inversion: if some thread gets interrupted in the critical section, the OS might schedule the other threads (that are spinning uselessly) instead of the one holding the lock.</p>
</div>
</li>
<li id="comment-526105" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/710874b630f0c67517df9d070f1ec0ff?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/710874b630f0c67517df9d070f1ec0ff?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ryan Olson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-13T17:51:59+00:00">June 13, 2020 at 5:51 pm</time></a> </div>
<div class="comment-content">
<p>I couldn&rsquo;t get it to work. The validation logic required a value in the message.</p>
</div>
</li>
</ol>
