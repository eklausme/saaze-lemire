---
date: "2017-01-16 12:00:00"
title: "Best programming language for high performance (January 2017)?"
---



I keep hoping that the field of programming language will evolve. I am a bit tired to program in Java and C&hellip; I&rsquo;d like better languages.

I am particularly interested in what I generally call &ldquo;high-performance programming&rdquo;. I want to pick languages where I can get the most out of my hardware. It is fine to program in JavaScript and Python, but there comes a time where you tackle large problems on hardware that is barely sufficient.

- For my purposes, I am going to narrow it down to &ldquo;system programming languages&rdquo; which means Swift, Rust, Go, C++, C. These are languages that well-suited to build more than applications, but also servers, database engines and so forth. They all offer ahead-of-time compilation, which makes the performance easier to reason about.

I think there will be no disagreement that C and C++ are system programming languages. Whether Go and Swift qualify is somewhat subjective. Would you write an operating system in Go? I would not. But Wikipedia seems to be happy to consider them all as [system programming languages](https://en.wikipedia.org/wiki/System_programming_language).
- I am going to ignore assembly because I can&rsquo;t imagine using it all the time. It is simply not practical unless you are working on a tiny code base (maybe on embedded software).
- I am going to ignore Rust, D and Nim as they have too few users. Programming is a social activity: if nobody can use your code, it does not matter that it runs fast. I think that they are very interesting languages but until many more people start coding in these languages, I am going to ignore them. Fortran is out for similar reasons: it still has important users, but they are specialized.
- I am not including non-system languages such as JavaScript, PHP, Matlab, Ruby, R, Python because though they can be fast, they are simply not generally well suited for high performance. They are typically &ldquo;fast enough&rdquo; for specific purposes, but they also have hard limitations. For example, JavaScript and Python appear unable to support natively multithreaded execution. (Spawning new processes does not count.) 
- Java and C# are interesting cases. They have been both described and used as &ldquo;system programming languages&rdquo;. I think that the evidence is overwhelming that Java can be used to build significant systems that perform very well. However, I think that running in a virtual machine (JVM, CLR) is a hard limitation: you can never be &ldquo;bare metal&rdquo;. I lump Scala with Java.
- There is a countless number of niche languages that I have not mentioned. Most of them will never pick up any amount of users.


Let me run through a few desirable features for high-performance programming along with the current languages that fare well.

- Operating systems are built in C or C++. Moreover, many important libraries have C interfaces. This means that being able to call C functions with minimal overhead is important in some instance. While Go allows you to call C functions, there is considerable overhead in terms of performance. All other programming languages can call C with minimal overhead.

- Obvious winners: C, C++
- Good players: Swift
- Loser: Go

<li>Though this is controversial, I think that a language with manual memory management may have the upper hand. In modern systems, managing memory is often a major overhead. C and C++ have manual memory management. Swift has reference counting which is a form of automated memory management, but with the advantage of being purely deterministic: when your data goes out of scope, the memory is reclaimed. However, reference counting does have an overhead, especially in a multithreaded context. Go has generational garbage collection (like Java or C#) which means that &ldquo;it stops the world&rdquo; at some point to reclaim memory, but the Go engineers have optimized for short pauses. That&rsquo;s a good thing too because &ldquo;stopping the world&rdquo; is not desirable. I don&rsquo;t know which approach I prefer: Swift or Go.

- Winners: C, C++
- Losers: Go, Swift

<li>Our computers have many cores. Parallel programming is important. We would like our languages to support elegantly multicore programming. I think that Go has clearly the upper hand. Of course, for example, it is possible to do everything Go does from C as far as multicore programming, but not as easily. As far as I can tell, Swift has one standard way to use multiple cores: Grand Central Dispatch. It also has Operation/OperationQueue for higher level multi-threading. ï»¿ It might be fine, but it does not look on par with what I find in other languages.

- Special mention: Go
- Winners : C++, C
- Loser: Swift

<li>For high performance, a good programming language should have &ldquo;easy to reason about performance&rdquo;. This means that when looking at a piece of code, you should have a good appreciation for how fast it will run. Honestly, this has gotten very hard over time, forcing us to rely more and more on benchmarking. However, simpler languages like C and Go makes it easier to reason about performance. Simply put, the more expansive the language, the harder it gets to compile it in your head.

- Winners: C, Go
- Losers: Swift, C++

<li>Our processors have fancy new instructions, like SIMD instructions (AVX2, Neon&hellip;). These should be readily available from the programming language. No programming language is easy to program with something like SIMD instructions, but C and C++ clearly come on top. In Go, you can write functions in assembly and call them from the language, but it comes with a discouraging performance overhead. Swift is barely better (there is a simd package, but it only works under macOS).

- Winners: C, C++ 
- Losers: Go, Swift

<li>It has been decades and there is still no universal way to manage dependencies in C. There is also no standard build mechanism. Sure, your favorite IDE can make it easier to add a dependency and build your program, but having something built into the language makes life much easier. In Go and Swift, there is a standard, cross-platform way to build programs, run tests and add dependencies.

- Winners: Go, Swift (special mention for Go)
- Losers: C, C++



Let me summarize my analysis with a table:

&nbsp;                   |C                        |C++                      |Go                       |Swift                    |
-------------------------|-------------------------|-------------------------|-------------------------|-------------------------|
Call C                   |Yes                      |Yes                      |Slow                     |Fair
                         |
Bare metal memory        |Yes                      |Yes                      |No                       |No
                         |
Cores                    |Yes                      |Yes                      |Great                    |Maybe (GCD)
                         |
Simple syntax            |Yes                      |No                       |Yes                      |No
                         |
Safety                   |Minimal                  |Minimal                  |Yes                      |Yes
                         |
SIMD                     |Yes                      |Yes                      |Slow                     |Maybe (macOS only)
                         |
Tools                    |None                     |None                     |Great                    |Good
                         |


If I were hired to build high-performance programming, I&rsquo;d be happy to be &ldquo;forced&rdquo; into any one of these languages. They are all fine choices. They are all improving at a fast pace. I think that Go, for example, has improved tremendously since I first learned it.

