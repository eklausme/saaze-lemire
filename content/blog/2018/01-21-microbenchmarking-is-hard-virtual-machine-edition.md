---
date: "2018-01-21 12:00:00"
title: "Microbenchmarking is hard: virtual machine edition"
---



To better understand software performance, we often use small controlled experiments called microbenchmarks. [In an earlier post](/lemire/blog/2018/01/04/dont-make-it-appear-like-you-are-reading-your-own-recent-writes/), I remarked that it is hard to reason from a Java benchmark. This brought me some criticism from Aleksey Shipilëv who is one of the top experts on Java benchmarking. I still stand by my belief and simply promised Aleksey to, one day, argue with him over a beer.

In a follow-up post, [I insisted that microbenchmarks should be relying on very tightly controlled conditions](/lemire/blog/2018/01/16/microbenchmarking-calls-for-idealized-conditions/), and I recommended avoiding just-in-time compilers if possible (such as is standard in Java). Indeed, you want your microbenchmarks to be as deterministic as possible (it should always be the same) yet just-in-time compilers are, almost by definition, non-deterministic. There is no reason to believe that your Java code will always be executed in the same manner from run to run. I also advocate avoiding memory allocation (and certainly garbage collection).

I am basing my opinion on practice. When developing software, I have often found it frustratingly difficult to determine whether a change would impact performance positively or negatively when using a language like Java or JavaScript, but much easier when using a more deterministic language like Go, Swift, C or C++.

Laurence Tratt shared with me his paper &ldquo;[Virtual Machine Warmup Blows Hot and Cold](http://soft-dev.org/pubs/html/barrett_bolz-tereick_killick_mount_tratt__virtual_machine_warmup_blows_hot_and_cold_v6/)&rdquo; (presented at OOPSLA last year). I believe that it is remarkable paper, very well written. Tratt&rsquo;s paper is concerned with microbenchmarks written for languages with a virtual machine, like Java, JavaScript, Python (PyPy), Ruby, Scala and so forth. Note that they use machines configured for testing and not any random laptop.

Here are some interesting quotes from the paper:

> in almost half of cases, the same benchmark on the same VM on the same machine has more than one performance characteristic


> However, in many cases (&hellip;) neither JIT compilation, nor garbage collection, are sufficient to explain odd behaviours (&hellip;) we have very little idea of a likely cause of the unexpected behaviour.


> It is clear that many benchmarks take considerable time to reach a steady state; that different process executions of the same benchmark reach a steady state at different points; and that some process executions do not ever reach a steady state.


> What should we do if P contains a no steady state? (&hellip;) no meaningful comparison can be made.


> We suggest that in many cases a reasonable compromise might be to use smaller numbers (e.g. 500) of in-process iterations most of the time, while occasionally using larger numbers (e.g. 1500) to see if longer-term stability has been affected.


My thoughts on their excellent work:

1. Their observation that many benchmarks never reach a steady state is troubling. The implicit assumption in many benchmarks is that you have some true performance, and they have noise. Many times, it is assumed that the noise is normally distributed. So, for example, you may rarely hit a performance that is much higher or much lower than the true (average) performance. That&rsquo;s, of course, not how it works. If you plot timings, you rarely find a normal distribution. But Tratt&rsquo;s paper puts into question the concept of a performance distribution itself&hellip; it says that performance may evolve, and keep on evolving. Furthermore, it hints at the fact that it might be difficult to determine whether your benchmark has gone to a true steady state.
1. They recommend running more benchmarks, meaning that quantity as a quality of its own. I agree with them. The counterpart to this that they do not fully address is that benchmarking has to be easy if it is to be plentiful. It is not easy to write a microbenchmark in Java (despite [Aleksey&rsquo;s excellent work](http://openjdk.java.net/projects/code-tools/jmh/)). Languages like Go make it much easier.
1. They argue for long-running benchmarks on the basis that a single event (e.g., a context switch) will have a larger relative effect on a short benchmark than on a long benchmark. My view is that, as far as microbenchmarks are concerned, you want to idealize away outlier events (like a context switch), that is, you do not want them to enter into your reported numbers at all, and that&rsquo;s difficult to do with a long-running benchmark if you are reporting an aggregate like an average.Moreover, if you have a really idealized setup, the minimum running time should be a constant: it is the fastest your processor can do. If you cannot measure that, you are either working on a problem that is hard to benchmark (e.g., involving random memory accesses, involving hard-to-predict branches, and so forth), or you have a non-ideal scenario.

Of course, if you have a more complicated (non-ideal) setup, as is maybe unavoidable in a language like Java, then it is a different game. I would argue that you should be headed toward &ldquo;system benchmarks&rdquo; where you try benchmark a whole system for engineering purposes. The downside is that it is going to be harder to reason about the performance with confidence.

Thus, when I really want to understand something difficult, even if it arose from Java or JavaScript, I try to reproduce it with a low-level language like C where things are more deterministic. Even that can be ridiculously difficult at times, but it is at least easier.


I would conclude that benchmarking is definitively not a science. But I&rsquo;m not sure paranoia is the answer, I think we need better, easier tools. We need more visualization. We need more metrics. And, no, we don&rsquo;t want to wait longer while sipping coffee. That won&rsquo;t make us any smarter.

