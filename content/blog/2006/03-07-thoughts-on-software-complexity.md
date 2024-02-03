---
date: "2006-03-07 12:00:00"
title: "Thoughts on Software Complexity"
---



Kurt shares with us his thoughts on software complexity:

>Over the years, I&rsquo;ve noticed that in programming, as in other systems, there seems to be a fairly invariant rule out there:

 You can never eliminate complexity from a system, you can only move it from place to place.


Yep. This is yet another instance of the [No-Free-Lunch Theorem](https://en.wikipedia.org/wiki/No-free-lunch_theorem). It basically says that while you can find more accurate algorithms, very often, all you are doing is specializing your algorithm to perform better in some conditions, but worse in others.

Of course, specializing is good. Some cases are more important than others. But be skeptical if someone says that X is __better in every respect__ than Y. There is, usually, a catch.

The same must be true in software. Fancier platforms make it easier to do some things, but harder to do other things. What you have to worry about is whether these cases are important for you.

J2EE, at least the early versions, is a beautiful example where the designers did a great job at making some cases very easy, while making others, very important cases, much harder, leaving J2EE developers in tough spots.

