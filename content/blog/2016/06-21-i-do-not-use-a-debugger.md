---
date: "2016-06-21 12:00:00"
title: "I do not use a debugger"
---



I learned to program with [BASIC](https://en.wikipedia.org/wiki/BASIC) back when I was twelve. I would write elaborate programs and run them. Invariably, they would surprise me by failing to do what I expect. I would struggle for a time, but I&rsquo;d eventually give up and just accept that whatever &ldquo;bugs&rdquo; I had created were there to stay.

It would take me a decade to learn how to produce reliable and useful software. To this day, I still get angry with people who take it for granted that software should do what they expect without fail.

In any case, I eventually graduated to something better: [Turbo Pascal](https://en.wikipedia.org/wiki/Turbo_Pascal). Turbo Pascal was a great programming language coupled with a fantastic programming environment that is comparable, in many ways, to modern [integrated development environments](https://en.wikipedia.org/wiki/Integrated_development_environment) (IDEs). Yet it is three decades old. It had something impressive: you could use a &ldquo;debugger&rdquo;. What this means is that you could run through the program, line by line, watching what happened to variables. You could set breakpoints where the program would halt and give you control.

Recently, [Chris Wellon wrote about Borland C++](http://nullprogram.com/blog/2018/04/13/), an environment from the 1990s:

> I made a couple of test projects, built and ran them with different options, and poked around with the debugger. The debugger is actually pretty decent, especially for the 1990s.


At the time, I thought that programming with a debugger was the future.

Decades later, I program in various languages, C, JavaScript, Go, Java, C++, Python&hellip; and I almost never use a debugger. I use fancy tools (sanitizers, static analyzers, continuous integration), and I certainly do use tools that are called debuggers (like <tt>gdb</tt>), but I almost never step through my programs line-by-line watching variable values. I almost never set breakpoints. I say &ldquo;almost&rdquo; because there are cases where a debugger is the right tool, mostly on simple or quick-and-dirty projects, or in contexts where my brain is overwhelmed because I do not fully master the language or the code. This being said I do not recall the last time I used a debugger as a debugger to step through the code. I have a vague recollection of doing so to debug a dirty piece of JavaScript.

I am not alone. In five minutes, I was able to find several famous programmers who took positions against debuggers or who reported barely using them.

- [Linus Torvalds](https://en.wikipedia.org/wiki/Linus_Torvalds), the creator of Linux, [does not use a debugger](http://lwn.net/2000/0914/a/lt-debugger.php3). He wrote:<br/>

> I don&rsquo;t like debuggers. Never have, probably never will. I do not condone single-stepping through code to find the bug. And sure, when things crash and you fsck and you didn&rsquo;t even get a clue about what went wrong, you get frustrated. Tough. There are two kinds of reactions to that: you start being careful, or you start whining. Quite frankly, I&rsquo;d rather weed out the people who don&rsquo;t start being careful early rather than late. Without a debugger, you tend to think about problems another way. You want to understand things on a different _level_. Without a debugger, you basically have to go the next step: understand what the program does. Not just that particular line. And quite frankly, for most of the real problems (as opposed to the stupid bugs, a debugger doesn&rsquo;t much help. And the real problems are what I worry about. The rest is just details. It will get fixed eventually.

- [Robert C. Martin](https://en.wikipedia.org/wiki/Robert_Cecil_Martin), one of the inventors of agile programming, thinks that debuggers are [a wasteful timesink](http://www.artima.com/weblogs/viewpost.jsp?thread=23476).
- [John Graham-Cumming](https://en.wikipedia.org/wiki/John_Graham-Cumming) [hates debuggers](http://blog.jgc.org/2007/01/tao-of-debugging.html).
- [Brian W. Kernighan](https://en.wikipedia.org/wiki/Brian_Kernighan) and [Rob Pike](https://en.wikipedia.org/wiki/Rob_Pike) wrote that <em>stepping through a program less productive than thinking harder and adding output statements and self-checking code at critical places</em>. Kernighan once wrote that <em>the most effective debugging tool is still careful thought, coupled with judiciously placed print statements</em>.
- The author of Python, [Guido van Rossum](https://en.wikipedia.org/wiki/Guido_van_Rossum) has been quoted as saying that uses print statements for 90% of his debugging.
- [Matteo Collina](https://nodeland.dev), the author of some of the most widely used JavaScript libraries in the world, responded to someone who implied that only junior programmers do not use debuggers: &ldquo;[call me a junior](https://x.com/matteocollina/status/1729993889744859402?s=20)&ldquo;. Many Node.js contributors share Collina&rsquo;s sentiment such as[ James Snell from Cloudflare](https://x.com/jasnell/status/1730019848112181487?s=20) and [Yagiz Nizipli from Sentry.](https://twitter.com/yagiznizipli/status/1730002557181866190?s=12&amp;t=-zo9kVFDyKuN4X1cdtkIrw)
- Maxime Chevalier also does not rely on debuggers. She designed the best JIT compiler from Ruby at Shopify. She explains that [she writes code defensively, in a way that hard bugs are less likely to happen](https://twitter.com/love2code/status/1730045059872026921?s=12&amp;t=-zo9kVFDyKuN4X1cdtkIrw).
- Ben Deane, an experienced game developer who worked on Goldeneye, Medal of Honor, StarCraft, Diable, World of Warcraft, and so forth, [wrote in 2018](http://www.elbeno.com/blog/?p=1598):<br/>

> The principal problem with debugging is that it doesn&rsquo;t scale. (&hellip;) in order to catch bugs, we often need to be able to run with sufficiently large and representative data sets. When we&rsquo;re at this point, the debugger is usually a crude tool to use (&hellip;) Using a debugger doesn&rsquo;t scale. Types and tools and tests do.



I should make it clear that I do not think that there is one objective truth regarding tools. It is true that our tools shape us, but there is a complex set of interactions between how you work, what you do, who you work with, what other tools you are using and so forth. Whatever works for you might be best.

However, the fact that Linus Torvalds, who is in charge of a critical piece of our infrastructure made of 15 million lines of code (the Linux kernel), does not use a debugger tells us something about debuggers

Anyhow, so why did I stop using debuggers?

Debuggers were conceived in an era where we worked on moderately small projects, with simple processors (no thread, no out-of-order execution), simple compilers, relatively small problems and no formal testing.

For what I do, I feel that debuggers do not scale. There is only so much time in life. You either write code, or you do something else, like running line-by-line through your code. Doing &ldquo;something else&rdquo; means (1) rethinking your code so that it is easier to maintain or less buggy (2) adding smarter tests so that, in the future, bugs are readily identified effortlessly. Investing your time in this manner makes your code better in a lasting manner&hellip; whereas debugging your code line-by-line fixes one tiny problem without improving your process or your future diagnostics. The larger and more complex the project gets, the less useful the debugger gets. Will your debugger scale to hundreds of processors and terabytes of data, with trillions of closely related instructions? I&rsquo;d rather not take the risk.

My ultimate goal when work on a difficult project is that when problems arise, as they always do, it should require almost no effort to pinpoint and fix the problem. Relying on a debugger as your first line of defense can be a bad investment, you should always try to improve the code first.

[Rob Pike](https://en.wikipedia.org/wiki/Rob_Pike) (one of the authors of the Go language) once came to [a similar conclusion](http://www.informit.com/articles/article.aspx?p=1941206):

> If you dive into the bug, you tend to fix the local issue in the code, but if you think about the bug first, how the bug came to be, you often find and correct a higher-level problem in the code that will improve the design and prevent further bugs.


I don&rsquo;t want to be misunderstood, however. We need to use tools, better tools&hellip; so that we can program ever more sophisticated software. However, running through the code line-by-line checking the values of your variables is no way to scale up in complexity and it encourages the wrong kind of designs.

Let me end with a quote that sums up my sentiment:

> &ldquo;Debuggers don&rsquo;t remove bugs. They only show them in slow motion.&rdquo;


