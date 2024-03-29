---
date: "2023-04-27 12:00:00"
title: "Hotspot performance engineering fails"
---



Developers often believe that software performance follows a Pareto distribution: 80% of the running time is spent in 20% of the code. Using this model, you can write most of your code without any care for performance and focus on the narrow pieces of code that are performance sensitive. Engineers like Casey Muratori have rightly criticized this model. [You can read Muratori excellent piece on his blog](https://www.computerenhance.com/p/performance-excuses-debunked).<br/>
<a href="https://twitter.com/strager/status/1651347849924456448?s=20"><img decoding="async" class="alignnone size-full wp-image-20475" src="https://lemire.me/blog/wp-content/uploads/2023/04/Screenshot-2023-04-27-at-11.30.10-AM.png" alt width="80%" srcset="https://lemire.me/blog/wp-content/uploads/2023/04/Screenshot-2023-04-27-at-11.30.10-AM.png 1010w, https://lemire.me/blog/wp-content/uploads/2023/04/Screenshot-2023-04-27-at-11.30.10-AM-300x184.png 300w, https://lemire.me/blog/wp-content/uploads/2023/04/Screenshot-2023-04-27-at-11.30.10-AM-768x471.png 768w" sizes="(max-width: 1010px) 100vw, 1010px" /></a>

It is definitively true that not all of your code requires attention. For example, it is possible that 99% of the time, your code processes correct data. The code that handles errors could be quite slow and it would not impact most of your users.

But the hotspot predicts something more precise: you should be able to just keep all of your code, identify the specific bottlenecks, optimize these bottlenecks, and then get great performance all around. Muratori relies on empirical evidence to falsify the model: many companies embarked in large rewrites of their codebase to optimize it. Why bother with such expenses if they could simply identify the bottlenecks and fix those?

We have tools today called profilers that can tell you roughly where your software spends its time. And if you apply such a tool to your software, you may indeed find massive bottlenecks. It may sometimes work wonders. For example, there was a video game ([GTA Online](https://arstechnica.com/gaming/2021/03/hacker-reduces-gta-online-load-times-by-over-70-percent/)) that was loading a JSON file. Simply optimizing this one bottleneck solved a massive performance issue. It did not make the game more performant, but it made it start much faster. So bottlenecks do exist. We should hunt them down and optimize them. But that&rsquo;s not what the hotspot model predicts: it predicts that it is all you need to do to get performance. Hit a few bottlenecks and you are done.

Sadly, it does not work.

Let us run down through a few reasons:

- __Overall architecture trumps everything__. If you first build a bus, you cannot then turn it into a sports car with a few changes. A few years ago, a company came to me and offered me a ton of money if I could make their database engine faster. They had money, but their software was much too slow. At first I was excited by the project, but I started reading their code and doing benchmarks, and then I realized that the entire architecture was wrong. They insisted that they knew where the hotspots were and that they just needed the expertise to optimize these few components. They told me that their code was spending 80% of its time in maybe 100 lines. And that is what profilers said. It is true, formally speaking, that if you could have made these 100 lines of code twice as fast, the code would have run twice as fast&hellip; but these lines of code were pulling data from memory and software cannot beat Physics. There are elementary operations that are not time compressible: you cannot move data faster than what is allowed by the hardware. The key point is that if your software does not have a good overall architecture, if it is not well organized for performance, you may have no choice but to rewrite it from the ground up, to re-architecture it.
- __As you optimize, the hotspots multiply__. Going back to the example of GTA Online, it is easy to find that the program spends 10 seconds loading a 10 MB JSON file. However, the next steps are going to be more difficult. You will find that that finding the bottlenecks become difficult: we are subject to a Heisenberg principle: measuring big effects is easy, measuring small ones becomes impossible because the action of measuring interacts with the software execution. But even if you can find the bottlenecks, they become more numerous with each iteration. Eventually, much of your code needs to be considered.


<em>The effort needed to optimize code grows exponentially.</em> In other words, to multiply the performance by N, you need 2<sup>N</sup> optimizations. The more you optimize, the more code you must consider. It is relatively easy to double the performance of an unoptimized piece of code, but much harder to multiply it by 10. You quickly hit walls that can be unsurmountable: the effort needed to double the performance again would just be too much. In effect, we have a [long tail effect](https://en.wikipedia.org/wiki/Long_tail): though there are clearly easy wins, much of the work lies in the &lsquo;tail&rsquo;.

And that explain why companies do full rewrites of their code for performance: the effort needed to squeeze more performance from the existing code becomes too much and a complete rewrite is cheaper.

It also means that you should be acutely concerned about performance when you design your software if you want to avoid a rewrite. Knuth told us that <em>premature optimization is the root of all evil</em>, but he meant that before you worry about replacing your switch/case routine with gotos, you should work on the algorithmic design and code architecture. Knuth was not telling you to forgo efficiency, on the contrary. He was urging you to make your effort count.

__Further content__: [Federico Lois — Patterns for high-performance C#](https://www.youtube.com/watch?v=7GTpwgsmHgU&amp;t=555s).

