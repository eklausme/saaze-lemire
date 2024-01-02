---
date: "2008-08-03 12:00:00"
title: "Cool software design insight #2"
---



The number 1 difference between an experienced hacker and the random guy out of school is [unit testing](https://en.wikipedia.org/wiki/Unit_testing). Unit testing is simple. Anyone can do it. You do not need a sophisticated library. All you need is to run a program that does sanity checks over the different components of your software. The rule is simple:

__You should always do unit testing for any kind of code that is supposed to have lasting value.__

It is worth repeating: the single most important non-trivial strategy in software design is unit testing. All more sophisticated strategies are usually not worth the cost, and all simpler strategies are somewhat trivial. While you can discover most good coding techniques on your own, unit testing is not something very natural to most hackers.

If you sell software for a living, unit testing is extremely important to keep your sanity. While you cannot provide bug-free code, you can at least provide software that passes some unit tests.

