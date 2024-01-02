---
date: "2012-04-20 12:00:00"
title: "Computer scientists need to learn about significant digits"
---



I probably spend too much time reviewing research papers. It makes me cranky.

Nevertheless, one thing that has become absolutely clear to me is that computer scientists do not know about [significant digits](https://en.wikipedia.org/wiki/Significant_digits).

When you write that the test took 304.03&nbsp;s, you are telling me that the 0.03 s is somehow significant (otherwise, why tell me about it?). Yet it is almost certainly __insignificant__.

In computer science, you should almost never use more than two significant digits. So 304.03&nbsp;s is indistinguishable from 300&nbsp;s. And 33.14 MB is the same thing as 33 MB.

Why does it matter?

- Cutting down numbers to their significant digits simplifies the exposition. It is simpler to say that it took 300 s than to say that it took 304.03 s.
- Numbers expressed without significant digits often lie. Running your program does not take 304.03 s. Maybe it did this one time, but if you run it again, you will get a different number.


Please learn to express your experimental results using as few digits as you can.

