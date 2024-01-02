---
date: "2011-06-14 12:00:00"
title: "The language interpreters are the new machines"
---



Most Computer Science textbooks assume that algorithms are written directly into machine language for an idealized machine under a [Von Neumann architecture](https://en.wikipedia.org/wiki/Von_Neumann_architecture). Alas, at best, these idealized models provide &ldquo;ballpark&rdquo; guidance to writing high performance software. They get you to avoid quadratic-time algorithms when linear-time algorithms are available. Yet there can be orders of magnitude of difference between two linear-time implementations.

To make matters worse, increasingly, programmers work with high level languages like JavaScript, Python or Ruby. The programmers are further away from the idealized machine. So much so that the intuition one might build from traditional [algorithmics](https://en.wikipedia.org/wiki/Algorithmics) can be detrimental.

Consider the following example. Sometimes you want to find the location of a maximum in an array. This operation is often called <tt>arg max</tt>. The Python language lacks a builtin <tt>arg max</tt> operation. [In one of the embarrassing moments of this blog](/lemire/blog/2004/11/25/computing-argmax-fast-in-python/), I proposed a fancy way to compute <tt>arg max</tt>, using a single pass through the data and a constant amount of memory. It is what Computer Scientists would consider a good solution. The inelegant and inefficient alternative is to first compute the maximum, and then scan the array again to find a matching location. To my surprise, [this simplistic solution was much more efficient than what I proposed](/lemire/blog/2008/12/17/fast-argmax-in-python/). Today, I repeated the [benchmark](http://pastebin.com/6rZx4qzM) under Python 3.01:

argmax function          |time                     |
-------------------------|-------------------------|
```C
array.index(max(array))```

&nbsp;                   |2.2 s                    |
```C
def maxarg(arr):
     counter = 0
     arg = 0
     m = arr[0]
     for x in arr:
          if x > m:
               m = x
               arg = counter
          counter += 1
    return arg```

&nbsp;                   |4.2 s                    |
```C
max(zip(array, range(len(array))))[1]```

&nbsp;                   |3.4 s                    |
```C
max([array[i],i] for i in range(len(array)))[1]```

&nbsp;                   |8.1 s                    |
```C
max((array[i],i) for i in range(len(array)))[1]```

&nbsp;                   |6.2 s                    |
```C
max(range(len(array)), key=array.__getitem__)```

&nbsp;                   |3.4 s                    |


<em>(Numbers and benchmark updated as of June 15, 2011.)</em>

All of these solutions except for the first one go through the data only once. Yet the first solution is nearly twice as fast as any other alternative.

Work blending high performance computing and  high level languages is likely to become increasingly important. Last week, I met with a [local start-up](http://datacratic.com/site/) that does [real-time Web ad](http://www.netpaths.net/blog/anatomy-of-a-real-time-google-ppc-auction/) auctions. Effectively, each time you visit a Web page, some of your data is sent to algorithms which must decide __very quickly__ what an ad to you is worth. Most of their real-time architecture is written in JavaScript and runs  under the [Google V8](https://code.google.com/p/v8/) engine. They assure me that JavaScript is not the bottleneck.

It used to be that to write high performance software, you needed to know a lot about how the hardware worked. This era is coming to an end. The language interpreters are the new machines.

__Further reading__: [High Performance JavaScript](http://shop.oreilly.com/product/9780596802806.do) by Zakas and [Python for high performance computing](http://www.johndcook.com/blog/2011/03/21/python-hpc/) by Cook.

__Challenge:__ Can you beat the silly <tt>arg max</tt> implementation (array.index(max(array))) using pure Python?

__Appendix:__ In C++, the one-pass <tt>arg max</tt> is about [twice as fast](http://pastebin.com/k4dq5Q9B).

__Code:__ Source code posted on my blog is available from a [github repository](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog).

