---
date: "2019-05-16 12:00:00"
title: "Building better software with better tools: sanitizers versus valgrind"
---



We often have to write code using  permissive programming languages like C and C++. They tend to generate hard-to-debug problems that can crash your applications. Thankfully, many compilers offer &ldquo;sanitizers&rdquo;. I discussed them in my post [No more leaks with sanitize flags in gcc and clang](/lemire/blog/2016/04/20/no-more-leaks-with-sanitize-flags-in-gcc-and-clang/). I strongly encourage the use of sanitizers as I think it is the modern way to write C and C++. When many people describe how impossibly difficult it is to build good software in C and C++, they often think about old-school bare metal C and C++ where the code do all sorts of mysterious things without any protection. Then they feel compelled to run their code in a debugger and to manually run through it. You should not write code this way! Get some tools! Sanitizers can catch undefined behaviour, memory leaks, buffer overflows, data races, and so forth.

Sanitizers are a game changer, they bring C++ closer to languages like Java and Rust. They do not bring the safety to production, since you probably do not want to use sanitizers in production or release, but as you are building and testing your code, they help you a great deal catch potential issues right away.

A competitive solution that people often use is a great tool called &ldquo;[valgrind](http://valgrind.org)&ldquo;. It is a general-purpose tool that checks your software as it runs. Under Windows, you have related programs like [Application Verifier](https://docs.microsoft.com/en-us/windows-hardware/drivers/debugger/application-verifier) and [WinDbg](https://docs.microsoft.com/en-us/windows-hardware/drivers/debugger/debugger-download-tools). Under macOS, valgrind used to be supported, but that is no longer the case.

I believe you should almost always use sanitizers when they are available. Here is a comparison between tools like valgrind and sanitizers.

<li style="list-style-type: none;">

1. With the caveat that valgrind needs support for all the instructions your software is using, valgrind can run pretty much any software, even when you do not have the source code. Sanitizers work at the compiler level, so you need the source code. Thus if you need to debug a closed source library, sanitizers are unhelpful.
1. Sanitizers can catch problems that valgrind will not catch. For example, it will catch undesirable undefined behaviour: code that may work right now but may not work if you use a different compiler or a different processor. They can catch unsafe memory accesses that will look safe to valgrind.
1. Sanitizers are more precise. You often can turn on or off specific sanitizers for specific functions.
1. If your compiler has sanitizers, you can run your tests with the sanitizers on simply by turning on some flags.
1. Valgrind is slow. Like debuggers, it often does not scale. If you are working over large data sets, it might take a really long time. People often dismiss &ldquo;execution time&rdquo;, and it is easy to do if you work on toy problems, but performance is an essential quality-of-life attribute. I do not think you can run valgrind in a simulated production setting. However, you can compile your code with sanitizers and emulate a production setting. Sure, your throughput is going to be impacted, but the effect is not large. Code with sanitizers is not 10x slower, valgrind is.
1. Sanitizers are relatively new and so the support is sometimes missing.

- For example, under macOS, Apple does not yet ship a compiler that can detect memory leaks, [you need to install your own compiler](https://stackoverflow.com/questions/53456304/mac-os-leaks-sanitizer).
- Even if you compile your code with debug symbols, it is common for the sanitizers to report the errors without proper links to the source code, you often need to fiddle with the system configuration.
- Under Linux, when using GNU GCC, I have found it necessary to use the gold linker to get good results (<tt>-fuse-ld=gold</tt>): the default link frequently gives me errors when I try to use sanitizers.
- The &ldquo;memory sanitizer&rdquo; that check that you do not read from uninitialized inputs is not available under GNU GCC and under LLVM requires you to manually replace the C++ standard library and possibly recompile all of your software with the sanitizer enabled (including all dependencies) if you want to avoid false positives.
- And Visual Studio has some of its own sanitizers, but it is largely behind LLVM. [Better sanitizers may be coming to Visual Studio 2019](https://devblogs.microsoft.com/cppblog/addresssanitizer-asan-for-the-linux-workload-in-visual-studio-2019/). (Update: [better sanitizers have arrived.](https://devblogs.microsoft.com/cppblog/addresssanitizer-asan-for-windows-with-msvc/))
- Furthermore, you cannot freely use all possible sanitizers at once.




So, sadly, there are cases when sanitizers are just not available to you. Yet I think it is a safe bet that all competitive C/C++ compilers will soon have powerful sanitizers.

