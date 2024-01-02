---
date: "2006-01-03 12:00:00"
title: "Are debuggers obselete?"
---



Are debuggers still useful? The main use of GNU debugger (gdb), for me, is to make sure I get a stack trace, like in Java. Putting break points and watching variables is just not something I do outside the code. Putting asserts and various checks __in__ the code is far more valuable in my opinion even if it &ldquo;dirties&rdquo; (to dirty) the code.

One issue you must not forget about debuggers, is that once your code is deployed, you no longer have a debugger running on your client&rsquo;s machine. Even if you don&rsquo;t release your code, others might have to use it, and they may have trouble with it&hellip; What is worse is that some nasty problems only occur __outside__ the debugger. I&rsquo;ve never seen this happen under Linux, but I have seen i happen again and again under Windows. Also, consider that most modern applications are web applications. Of course, you can run a web application in &ldquo;debugging&rdquo; mode, but it is quite the same as web applications tend to be distributed (web server, database, etc.). I think you need to learn to debug applications live.

I will also add that it is well known that the Linux kernel is built is C with printf statements. If you can build something so complex without a debugger, using a nasty language like C&hellip; then debuggers are not __so__ useful.

What I find tremendously useful are unit tests. We never have enough unit testing. And I don&rsquo;t think it is stressed enough in the curriculum. If there is one thing you must learn from modern software engineering, it is __not__ UML, it is __not__ business processes, it is unit testing.

