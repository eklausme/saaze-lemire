---
date: "2017-03-20 12:00:00"
title: "Does software performance still matter?"
---



This morning, a reader asked me about the real-world relevance of software performance:

> I&rsquo;m quite interested in your work on improving algorithm performance using techniques related to computer architecture. However, I think that this may only be of interest to academia. Do you think that there are jobs opportunities related with this profile, which is very specialized?


To paraphrase this reader, computers and software are fast enough. We may need people to implement new ideas, but performance is not important. And more critically, if you want to be gainfully employed, you do not need to worry about software performance.

To assess this question, we should first have a common understanding of what software performance is. Software performance is not about how quickly you can crunch numbers. It is how you manage memory, disks, networks, cores&hellip; it is also about architecture. It is not about rewriting your code in machine code: you can write fast applications in JavaScript and slow ones in C++. Software performance is related to algorithmic design, but distinct in one important way: you need to take into account your architecture. Many algorithms that look good on paper do really poorly in practice. And algorithms that appear naive and limited can sometimes be the best possible choice for performance. In some sense, being able to manage software performance requires you to have a good understanding of how computer hardware, operating systems, and runtime libraries work.

So, should we care about software performance in 2017?

Here is my short answer. There are two basic ways in which we can assess you as a programmer. Is your software correct? Is your software efficient? There are certainly other ways a programmer can bring value: some exploit their knowledge of some business domains, others will design marvelous user interfaces. However, when it comes down to hardcore programming, being correct and being efficient are the two main attributes.

Consider the great programmers. They are all good at producing software that is both correct and efficient. In fact, it is basically the definition of a great programmer. Programming is only challenging when you must be both correct and efficient. If you are allowed to sacrifice one or the other, you can trivialize most tasks.

In job ads, you probably won&rsquo;t see many requests for programmers who write efficient code, nor are you going to see many requests for programmers who write correct code. But then, you do not see many ads for doctors who cure people, nor do you see many ads for lawyers who avoid expensive lawsuits. Producing efficient code that takes into account the system&rsquo;s architecture is generally part of your job as a programmer.

Some of my thoughts in details:

- __Software performance only matters for a very small fraction of all source code. But what matters is the absolute value of this code, not it is relative size.__Software performance is likely to be irrelevant if you have few users and little data. The more important the software is, the more important its performance can become.

Given that over 90% of all software we write is rarely if ever used for real work, it is a safe bet to say that software performance is often irrelevant, but that&rsquo;s only because, in these cases, the software brings little value.

Let us make the statement precise: __Most performance or memory optimizations are useless.__

That&rsquo;s not a myth, it is actually true.

The bulk of the software that gets written is not performance sensitive or worth the effort. Pareto&rsquo;s law would tell you that 20% of the code accounts for 80% of the running time, but I think it is much worse than this. I think that 1% of the code accounts for 99% of the running time&hellip; The truth is maybe even more extreme.

So a tiny fraction of all code will ever matter for performance, and only a small fraction of it brings business value.

But what matters, if you are an employee, is how much value your optimized code brings to the business, not what fraction of the code you touch.
- __We can quantify the value of software performance and it is quite high. __If I go on Apple&rsquo;s website and I shop for a new MacBook Pro. The basic one is worth $1,800. If I want a processor with a 10% faster clock speed, it is going to cost me $2,100, or 15% more. An extra 10% in the clock speed does not make the machine nearly 10% faster. Let us say that it is maybe 5% faster. So to get a computer that runs 5% faster (if that) some people are willing to pay 15% more. I could do the same analysis with smartphones.

If constant factors related to performance did not matter, then a computer running at twice the speed would be worth the same. In practice, a computer running at twice the speed is worth multiple times the money.

With cloud computing, companies are now often billed for the resources (memory, compute time) that they use. Conveniently, this allows them to measure (in dollars) the benefits of a given optimization. We can find the stories of small companies that [save hundreds of thousands](https://overflow.buffer.com/2016/03/31/how-we-saved-132k-a-year-by-spring-cleaning-our-back-end/) of dollars with some elementary optimization.

We could also look at web browsers. For a long time, Microsoft had the lead with Internet Explorer. In many key markets, Google Chrome now dominates. There are many reasons for people to prefer Google Chrome, but speed is a key component. To test out my theory, I searched Google for guides to help me choose between Chrome and Internet Explorer, and the first recommendation I found was this:

> Chrome is best for speed  arguably, a web browser&rsquo;s most crucial feature is its ability to quickly load up web pages. We put both Chrome and Internet Explorer 11 through a series of benchmark tests using Sunspider, Octave and HTML 5 test. In every event, Google&rsquo;s Chrome was the clear winner.


So yes, performance is worth a lot to some users.
- __Adding more hardware does not magically make performance issues disappear. It requires engineering to use more hardware.__People object that we can always throw more machines, more cores at the problem if it is slow. However, even when [Amdahl&rsquo;s law](https://en.wikipedia.org/wiki/Amdahl's_law) does not limit you, you still have to contend with the fact it can be hard to scale up your software to run well on many machines. Throwing more hardware at a problem is just a particular way to boost software performance. It is not necessarily an inexpensive approach.

It should be said that nobody ever gets an asymptotically large number of processors in the real world. Moreover, when you do get many processors, coordination issues can make it difficult (even in principle) to use a very large number of processors on the same problem.

What about our practice? What the past decades have taught us is that parallelizing problems is hard work. You end up with more complex code and non-trivial overhead. Testing and debugging get a lot more difficult. With many problems, you are lucky if you manage to double the performance with three cores. And if you want to double the performance again, you might need sixteen cores.

This means that doubling the performance of your single-threaded code can be highly valuable. In other words, tuning hot code can be worth a lot&hellip; And adding more hardware does not make the performance problems go away magically, using this hardware requires extra work.
- __We use higher level programming language, but an incredible amount of engineering is invested in recovering the traded-away performance.__Today&rsquo;s most popular programming language is JavaScript, a relatively slow programming language. Isn&rsquo;t that a sign that performance is irrelevant? The performance of JavaScript was multiplied over the years through vast engineering investments. Moreover, we are moving forward with high-performance web programming techniques like [Web Assembly](https://github.com/WebAssembly/design/blob/master/UseCases.md) (see [video presentation](https://www.youtube.com/watch?v=o52_5qAJhNg)). If performance did not matter, these initiatives would fall flat.

It is true that, over time, people migrate to high-level languages. It is a good thing. These languages often trade performance for convenience, safety or simplicity.

But the performance of JavaScript in the browser has been improved by two orders of magnitude in the last fifteen years. By some estimates, JavaScript is only about ten times slower than C++.

I would argue that a strong component in the popularity of JavaScript is precisely its good performance. If JavaScript was still 1000 times slower than C++ at most tasks, it would not have the wide adoption we find today.

Last year, a colleague faced a performance issue where simulations would run forever. When I asked what the software was written in&hellip; she admitted with shame that it was written in Python. Maybe to her surprise, I was not at all dismissive. I&rsquo;d be depressed if, in 20 years, most of us were still programming in C, C++, and Java.

One of the things you can buy with better performance is more productivity.
- __Computers are asked to do more with less, and there is a never ending demand for better performance.__Software performance has been regularly dismissed as irrelevant. That&rsquo;s understandable under Moore&rsquo;s law: processors get faster, we get faster disks&hellip; who cares if the software is slow? It will soon get faster. Let us focus on writing nice code with nice algorithms, and we can ignore the rest.

It is true that if you manage to run Windows 3.1 on a recently purchased PC, it will be ridiculously fast. In fact, I bet you could run Windows 3.1 in your browser and make it fast.

It is true that some of the hardware progress reduces the pressure to produce very fast code&hellip; To beat the best chess players in the 1990s, one probably needed the equivalent of hand-tuned assembly code whereas I am sure I can write a good chess player in sloppy JavaScript and get good enough performance to beat most human players, if not the masters.

But computers are asked to do more with less. It was very impressive in 1990 to write a Chess program that could beat the best Chess players&hellip; but it would simply not be a great business to get into today. You&rsquo;d need to write a program that plays Go, and it is a lot harder.

Sure, smartphone hardware gets faster all the time&hellip; but there is pressure to run the same software on smaller and cheaper machines (such as watches). The mouse and the keyboard will look quaint in a few decades, having been replaced by more expensive interfaces (speech, augmented reality&hellip;).

And yes, soon, we will need devices the size of a smartwatch to be capable of autonomous advanced artificial intelligence. Think your sloppy unoptimized code will cut it?
- __We do want our processors to be idle most of the time. The fact that they are is not an indication that we could be sloppier.__Aren&rsquo;t most of our processors idle most of the time?

True, but it is like saying that it is silly to own a fast car because it is going to spend most of its time parked.

We have enormous overcapacity in computing, by design. Doing otherwise would be like going to a supermarket where all of the lines for the cashiers are always packed full, all day long.

We have all experienced what it is to use a laptop that has its CPU running at 100%. The laptop becomes sluggish, unresponsive. All your requests are queued. It is unpleasant.

Servers that are running at full capacity have to drop requests or make you wait. We hate it.

A mobile phone stressed to its full capacity becomes hot and burns through its battery in no time.

So we want our processors to be cold and to remain cold. Reducing their usage is good, even when they were already running cold most of the time. Fast code gets back to the users faster and burns less energy.

I imagine that the future will be made of dark silicon. We will have lots of computing power, lots of circuits, but most of them will be unpowered. I would not be surprised if we were to soon start rating software based on how much power it uses.


