---
date: "2016-09-21 12:00:00"
title: "My thoughts on Swift"
---



[Swift](https://en.wikipedia.org/wiki/Swift_(programming_language)) is a new programming language produced by Apple for its iOS devices (primarily the iPhone). It first appeared two years ago and it has been gaining popularity quickly.

Before Swift, Apple programmers were &ldquo;stuck&rdquo; with [Objective-C](https://en.wikipedia.org/wiki/Objective-C). Objective-C is old and hardly ever used outside the Apple ecosystem.

Swift, at least the core language, is [fully available on Linux](https://swift.org/download/#snapshots). There are rumours that it should soon become available for Windows.
If you want to build mobile apps, then learning Swift is probably wise. But setting this context aside, how does Swift stands on its own?

To find out, I wrote and published [a small Bitset library in Swift 3.0](https://github.com/lemire/SwiftBitset).

- Java initially compiles to byte code and then it uses just-in-time compilation to generate machine code on-the-fly based on profiling. Swift compiles directly to machine code once and for all like Go, Rust, C and C++. In theory, this gives an advantage to Java, since it can compile code given knowledge of how it runs. In particular, this should help Java inline functions that Swift can&rsquo;t inline due to its lack of profile-guided-optimization (PGO) by default. However, this also means that Java needs more time and memory when the application is starting up. Moreover, for the developer, having ahead-of-time compilation makes the performance easier to measure which may help people write better and faster Swift code.- Like most recent languages (e.g., Rust, Go), Swift 3.0 comes with standard and universal tools to test, build and manage dependencies. In contrast, languages like C, C++ or Java depend on additional tools that are not integrated in the language per se. There is no reason, in 2016, to not include unit testing, benchmarking and dependency management as part of a programming language itself. Swift shines in this respect.- Swift feels a lot like Java. It should be easy for Java programmers to learn the language. Swift passes classes per reference and everything else per value though there is an `inout` parameter annotation to override the default. The ability to turn what would have been a pass-by-reference class in Java and make it a pass-by-value &ldquo;struct&rdquo; opens up optimization opportunities in Swift.
- Java only supports advanced processor instructions in a very limited manner. Go is similarly limited. Swift compiles to optimized machine code with full support for autovectorization like Rust, C and C++.- In Java, all strings are immutable. In Swift, strings can be either immutable or mutable. I suspect that this may give Swift a performance advantage in some cases.
- Swift supports automatic type inference which is meant to give the syntax a &ldquo;high-level&rdquo; look compared to Java. I am not entirely convinced that it is actual progress in practice.
- Swift uses automatic reference counting instead of a more Java-like garbage collection. Presumably, this means fewer long pauses which might be advantageous when latency is a problem (as is the case in some user-facing applications). Hopefully, it should also translate into lower memory usage in most cases. For the programmer, it appears to be more or less transparent.
- Swift has operator overloading like C++. It might even be more powerful than C++ in the sense that you can create your own operators on the fly.- By default, Swift &ldquo;crashes&rdquo; when an operation overflows (like casting, multiplication, addition&hellip;). The intention is noble but I am not sure crashing applications in production is a good default especially if it comes with a performance penalty. Swift also &ldquo;crashes&rdquo; when you try to allocate too much memory, with apparently no way for the application to recover sanely. Again, I am not sure why it is a good default though maybe it is.
- It looks like it is easy to link against C libraries. I built [a simple example](https://github.com/lemire/SwiftCallingCHeader). Unlike Go, I suspect that the performance will be good.- Available benchmarks so far indicate that Swift is slower than languages like Go and Java, which are themselves slower than C. So Swift might not be a wise choice for high-performance programming.

My verdict? Swift compares favourably with Java. I&rsquo;d be happy to program in Swift if I needed to build an iOS app.
Would I use Swift for other tasks? There is a lot of talk about using Swift to build web applications. I am not sure.
