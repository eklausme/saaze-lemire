---
date: "2007-09-17 12:00:00"
title: "No, you do not have to settle on a poor language because you have bad programmers"
---



I do not entirely believe the title of this post. Clearly, if you hire subpar programmers, you have to settle for whatever programming languages they know. These days, it is probably going to be Java. And you could do a lot worse than choose Java. Or maybe it is PHP. Again, PHP is fine.

The real question is&hellip; should you prevent your programmers from using Ruby or Python because you worry about what will happen to the next guy who needs to maintain their code?

On this issue, [Eugene makes a great point](http://faculty.chas.uni.edu/~wallingf/blog/). What languages like Java offer that &ldquo;crazier languages&rdquo; like Ruby do not offer is builtin testing. In Java, types are checked at compile time, except of course, when it does not, such as when you use collections of objects. In languages with dynamic typing, fewer tests are done at compile time.

The solution? Simply get programmers to use unit testing more aggressively. In my experience, unit testing is relatively painless to put in place. It is a great way to document what you expect your code to do, way beyond what static typing offers.

So, next time a programmer working for you wants to use Ruby, just say yes, but require him to do unit testing.

