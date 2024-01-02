---
date: "2016-03-14 12:00:00"
title: "Artificial intelligence is mostly a matter of engineering?"
---



Unless you live under a rock, you should know by now that [AlphaGo](https://en.wikipedia.org/wiki/AlphaGo), an artificial intelligence, has beaten a world champion at the game of Go. After Tic Tac Toe, Checker and Chess, Go was the last conventional board games where computers could not beat the best human beings. We have made history!

John Langford [reminds us](http://hunch.net/?p=3692542) that defeating human beings at Go is not the same thing as achieving, generally, a human-level intelligence. Possibly, the AlphaGo software could be used to play a good game of Chess, but there are other simpler games that are easy for human beings to master, that AlphaGo-like software would find difficult.

Real progress often looks mundane in retrospect. For example, we have improved our health tremendously in the last few decades by smoking less. That does not look like a technological breakthrough, but to the scientists who had to built a case against smoking using science, I am sure it feels like a victory for science.

So how do we assess AlphaGo? Is it real progress or just hype?

Let us put aside the fact that there is clearly hype involved. It is a publicity stunt for Google. Starting today, they will have a much easier time recruiting the best researchers. The value of their brand went up.

But is there any meat?

To put things in perspective, let us recall what the New York Times was telling us in 1997: 

> When or if a computer defeats a human Go champion, it will be a sign that artificial intelligence is truly beginning to become as good as the real thing. ([NYT 1997](http://www.nytimes.com/1997/07/29/science/to-test-a-powerful-computer-play-an-ancient-game.html))


But how did AlphaGo succeed?

AlphaGo uses a lot of hardware. According to their Nature paper:

> Evaluating policy and value networks requires several orders of magnitude more computation than traditional search heuristics. To efficiently combine MCTS (Monte Carlo Tree Search) with deep neural networks, AlphaGo uses an asynchronous multi-threaded search that executes simulations on CPUs, and computes policy and value networks in parallel on GPUs. The final version of AlphaGo used 40 search threads, 48 CPUs, and 8 GPUs. We also implemented a distributed version of AlphaGo that exploited multiple machines, 40 search threads, 1,202 CPUs and 176 GPUs. The Methods section provides full details of asynchronous and distributed MCTS.


Miles Brundage wrote a [critical analysis of the more recent incarnation of AlphaGo](http://www.milesbrundage.com/blog-posts/alphago-and-ai-progress):

> AlphaGo (&hellip;) used 280 GPUs and 1920 CPUs. This is significantly more computational power than any prior reported Go program used, and a lot of hardware in absolute terms. 


Deep Blue, the system that defeated Kasparov, had 11 GFLOPS whereas a modern iPhone has close to 200 GFLOPS. A single GPU today can deliver about 7000 GFLOPS. So AlphaGo has computing capabilities that are maybe hundreds of thousands of times what Deep Blue had.

This is aside from all the hardware used to train the software. Don&rsquo;t expect a JavaScript version of AlphaGo to run in your browser and to do well any time soon. AlphaGo runs on powerful hardware and makes full use of it. 

Simply put, we should not be surprised if we get qualitatively different results when we throw hundreds of time more power behind it.

If &ldquo;all&rdquo; it takes to build superhuman intelligences is more hardware&hellip; and the ability to use it&hellip; then it is good news. Though hundreds of GPUs and thousands of CPUs is a lot, Google, Amazon, Microsoft, the NSA, Apple&hellip; could all throw a lot more power at the problem.

Does it make sense that more computation power, coupled with relatively simple algorithms, could be the path to superhuman intelligence? Naively, I&rsquo;d ask why not? 

It looks like all we need is the right hardware, a regular team of great scientists and engineers, and a few short years. No need for great unpredictable conceptual breakthroughs. No need for thousands of people.

I predict that if researchers today could look at the software of our personal assistants in the future, they would be disappointed. &ldquo;That&rsquo;s all it does? We knew about most of these techniques in 2016&hellip;&rdquo; 

__Update__: At its annual conference in May 2016, Google announced that AlphaGo has been running on custom hardware, the Tensor Processing Unit, which is reportedly [10 times faster](https://cloudplatform.googleblog.com/2016/05/Google-supercharges-machine-learning-tasks-with-custom-chip.html) than anything else on a per-Watt basis.

