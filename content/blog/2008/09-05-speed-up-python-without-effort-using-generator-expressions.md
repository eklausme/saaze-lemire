---
date: "2008-09-05 12:00:00"
title: "Speed up Python without effort using generator expressions"
---



Here are two ways to count the numbers from 1 to 1000000 in Python. First, the classical way:

<code>sum([i for i in xrange(1000000)])</code>

Runs 0.8s on an old Linux box. It uses quite a bit of memory.

Second, the better way:

<code>sum((i for i in xrange(1000000)))</code>

Runs 0.2s on the same box. It uses a tiny amount of memory.

That is right. The second option is 4 times faster! According to my tests, the second option remains better even if you only sum the numbers between 1 and 1000, though the benefits are then tiny.

__Note__: Yes, I am aware that I could simply do 1000000*(1000000-1)/2.

__Source__: Parand.

