---
date: "2005-08-09 12:00:00"
title: "The Free Lunch Is Over: A Fundamental Turn Toward Concurrency in Software"
---



[There seems to be a flood of paper predicting the golden era of thread-based programming.](http://www.gotw.ca/publications/concurrency-ddj.htm) The key reason is that we seem to have hit a wall in CPU clock speed: we have reached 2GHz in 2001, but can&rsquo;t seem to get to 4GHz processors in 2005. However, the number of transistors per CPU keeps on growing and growing fast, but CPUs are being optimized to work with exotic techniques like hyperthreading where one CPU can run two operations at the same time. This seems like a good thing for Computer Science university programs: just like object oriented programming made programming a more noble art, the need for thread-based programming will turn programming into a superior form of art.

Myself, I remain skeptical. Will we start programming in a fundamental new way? I doubt it and the reason can be found in one of those [&ldquo;threads are the future&rdquo; papers](http://www.gotw.ca/publications/concurrency-ddj.htm):

> A few rare classes of applications are naturally parallelizable, but most aren&rsquo;t. Even when you know exactly where you&rsquo;re CPU-bound, you may well find it difficult to figure out how to parallelize those operations; all the most reason to start thinking about it now. Implicitly parallelizing compilers can help a little, but don&rsquo;t expect much; they can&rsquo;t do nearly as good a job of parallelizing your sequential program as you could do by turning it into an explicitly parallel and threaded version.


I rather forsee that 95% of the programmers will keep on developing single-threaded applications, but most of these applications will eventually be web-based and run on a server which is, by definition, multithreaded. Maybe game programming will see a small revolution, assuming they don&rsquo;t already use threads a lot. I don&rsquo;t think the business application programmers will jump on the &ldquo;I must optimize my application for multicore CPUs&rdquo; train. They will probably keep on throwing more memory at their problems, should they need to.

I think what a lot of these &ldquo;threads are going to change everything&rdquo; people forget that the web revolution happened some time ago. I use web applications to read and write emails, to design my courses, manage my research notes, to blog and so on. By definition, all these functions are already multithreaded, though most of the code running it might not worry too much about these threads.

I once wrote a [posting board engine in Java (under GPL)](http://webforum.sourceforge.net) which is fully threaded. I think it must run twice as fast as any PHP posting board engine out there. Why am I not using it? Because, frankly, it was a pain to maintain compared to a PHP application. And this is the main reason why I think multithread programming is not going to become the norm: it is just too damn hard to maintain.

(Before you ask, yes, my [posting board engine](http://webforum.sourceforge.net) really does run safely on servers with several processors and it uses a custom-made database engine too! I even recall some graduate student used webforum for a M.Sc. thesis on thread programming. Not that I claim it is good software.)

