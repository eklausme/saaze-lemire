---
date: "2008-07-30 12:00:00"
title: "Cool software design insight #1"
---



I plan to progressively discuss a few things I have learned about software design during the rest of the year. Trivial things that make a big difference in your productivity. I do not claim that any of these insights will be novel in any way.

As a college professor, I do not code full time. Usually, I build dirty software that will last just long enough to make a point. I do not need to build industrial-strength software. I have no business needs to satisfy. I can afford to throw away code and never look at it again once a research project is completed. None of my code needs to run for more than a few days at a time.

With this disclosure in place, here is insight #1:

> Remove features as often as you can.


Repeatedly, I have observed that my software is too complex for its own good as months go by. Often, I thought that my code would need to do X when, in reality, the need never arises. For example, maybe you wrote code that could sort strings or integers, and you realize that you never sort integers.

It is tempting to leave these extra functions in place. After all, what is the harm? And maybe I will need the extra power some day.

However, I have learned that __I systematically underestimate the cognitive overhead of these useless features.__ I always think that this little extra template parameter is harmless. It is only after removing it, and working with my code some more that I realize how much easier my work has become.

So, drop useless flags and parameters. Do your brain a favor!

