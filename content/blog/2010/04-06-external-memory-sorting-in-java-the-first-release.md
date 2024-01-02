---
date: "2010-04-06 12:00:00"
title: "External-Memory Sorting in Java : the First Release"
---



In my previous post, you were invited to help with a reference implementation of [external sorting](https://en.wikipedia.org/wiki/External_sorting) in Java. Several people tested and improved the code. I like the result.

- I posted the code on [Google code](https://code.google.com/p/externalsortinginjava/). All contributors are  owners of the project. The source code is under subversion.
- I have added a link to it from the [wikipedia page](https://en.wikipedia.org/wiki/External_sorting#External_links).


What is left to do?

- The code remains untested. Please run your benchmarks! Find bugs!
- Please contribute [unit tests](https://en.wikipedia.org/wiki/Unit_tests).
- Can you write a tutorial on how to use the code?
- Can you simplify the code further while making it faster and more robust?


__Caveat__: My intent was for the code to be in the public domainâ€”nobody should own reference implementationsâ€”but Google code would not allow it. I selected the lesser GPL license instead, for now.

__Reference__: There is a [fast external sorting implementation](http://forums.sun.com/thread.jspa?threadID=5310310) in Java by the Yahoo! people. (Thanks to Thierry Faure for pointing it out.) I have not looked at it.

