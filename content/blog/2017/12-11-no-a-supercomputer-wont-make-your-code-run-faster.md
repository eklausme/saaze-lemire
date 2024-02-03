---
date: "2017-12-11 12:00:00"
title: "No, a supercomputer won´t make your code run faster"
---



I sometimes consult with bright colleagues from other departments who do advanced statistical models or simulations. They are from economics, psychology, and so forth. Quite often, their code is slow. As in &ldquo;it takes weeks to run&rdquo;. That&rsquo;s not good.

Given the glacial pace of academic research, you might think that such long delays are nothing to worry about. However, my colleagues are often rightfully concerned. If it takes weeks for you to get the results back, you can only iterate over your ideas a few times a year. This limits drastically how deeply you can investigate issues.

These poor folks are often sent my way. In an ideal world, they would have a budget so that their code can be redesigned for speed&hellip; but most research is not well funded. They are often stuck with whatever they put together.

Too often they hope that I have a powerful machine that can run their code much faster. I do have a few fast machines, but it is often not as helpful as they expect.

- Powerful computers tend to be really good at parallelism. Maybe counter-intuitively, these same computers can run non-parallel code slower than your ordinary PC. So dumping your code on a supercomputer can even make things slower!
- In theory, you would think that software could be &ldquo;automatically&rdquo; parallelized so that it can run fast on supercomputers. Sadly, I cannot think of many examples where the software automatically tries to run using all available silicon on your CPU. Programmers still need to tell the code to run in parallel (though, often, it is quite simple). Some software libraries are clever and do this work for you&hellip; but if you wrote your code without care for performance, it is likely you did not select these clever libraries. 
- If you just grabbed code off the Internet, and you do not fully understand what is going on&hellip; or you don&rsquo;t know anything about software performance&hellip; it is quite possible that a little bit of engineering can make the code run 10, 100 or 1000 times faster. So messing with a supercomputer could be entirely optional. It probably is.

More than a few times, by changing just a single dependency, or just a single function, I have been able to switch someone&rsquo;s code from &ldquo;too slow&rdquo; to &ldquo;really fast&rdquo;.


How should you proceed?

- I recommend making back-of-the-envelope computations. A processor can do billions of operations a second. How many operations are you doing, roughly? If you are doing a billion simple operations (like a billion multiplications) and it takes minutes, days or weeks, something is wrong and you can do much better.

If you genuinely require millions of billions of operations, then you might need a supercomputer.

Estimates are important. A student of mine once complained about running out of memory. I stupidly paid for much more RAM. Yet all I had to do to establish that the machine was not at fault was to compare the student code with a standard example found online. The example was much, much faster than the student&rsquo;s code running on the same machine, and yet the example did much more work with not much more code. That was enough to establish the problem: I encouraged the student to look at the example code.
- You often do not need fancy tools to make code run faster. Once you have determined that you could run your algorithm faster, you can often inspect the code and determine at a glance where most of the work is being done. Then you can search for alternatives libraries, or just think about different ways to do the work.

In one project, my colleague&rsquo;s code was generating many random integers, and this was a bottleneck since random number generation is slow in Python by default, so I just proposed a [faster random number generation](https://github.com/lemire/fastrand) written in C. (See my blog post [Ranged random-number generation is slow in Python&hellip;](/lemire/blog/2016/03/21/ranged-random-number-generation-is-slow-in-python/) for details.) Most times, I do not need to work so hard, I just need to propose trying a different software library.

If you do need help finding out the source of the problem, there are nifty tools like [line-by-line profilers in Python](https://github.com/rkern/line_profiler). There are also [profilers in R](https://stackoverflow.com/a/32742799/73007).


My main insight is that most people do not need supercomputers. Some estimates and common sense are often enough to get code running much faster.

