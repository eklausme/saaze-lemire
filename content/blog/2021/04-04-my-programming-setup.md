---
date: "2021-04-04 12:00:00"
title: "My programming setup"
---



As my [GitHub profile indicates](https://github.com/lemire), I program almost every single working day of the year. I program in many different languages such C++, C, Go, Java, JavaScript, Python, R, Swift, Rust, C#; even though I do not master all of these languages. Some of the projects I work on can be considered &ldquo;advanced programming&rdquo;. Some of my code is used in production.

I was recently asked how I build code.

[I do not use a debugger](/lemire/blog/2016/06/21/i-do-not-use-a-debugger/) in my main work. I will use debuggers exceptionally for hacking code that I do not understand. Before you object, keep in mind that I am in good company: Linus Torvalds, Brian W. Kernighan, Rob Pike and Guido van Rossum have stated that they do not rely primarily (or at all) on debuggers. Stepping through code is a slow, tiring process.

My primary environnement these days is Visual Studio Code. It is great for the following reasons:

1. It is portable. I can switch from macOS to Windows and back, and it keeps working.
1. It is fast. I know that&rsquo;s a ridiculous statement to make considering that it is written in JavaScript, but it is just very smooth.
1. It is simple. It is only a text editor after all.
1. It allows me to program in all of the languages I care about.
1. It is a state-of-the-art editor. I am never frustrated by a missing feature. I very rarely encounter bugs.
1. I use fancy regular expressions all of the time and Visual Studio Code supports every expression I can throw to it.
1. It has a a great terminal application embedded. It is better than most of the terminal applications provided by operating systems (especially under Windows).
1. It integrates very nicely with ssh. A lot of my work involving hacking code that resides on a server (often linux). With Visual Studio Code, I can basically edit and run code on any system where ssh lives. It is so good that I sometimes forget that I am connected to a remote server.


That is pretty much all you would see on my screen when I am programming: Visual Studio Code. I do a lot of my work in the terminal. I use git all of the time for version control. The Go and Rust tools work nicely in a shell. For C++ and C, I use CMake or simple Makefiles, again mostly with command lines. You can invoke CMake command lines under Windows too, and have the Visual Studio compiler build your code. I find that C# has really nice support for command line builds and tests. Obviously, Java works well with gradle or maven. JavaScript has node and npm. I use Swift though not for build applications so I can rely on the Swift Package Manager. My go-to scripting language is Python. From the command-line results, if there are errors, Visual Studio Code often allows me to click and get directly at the offending line.

[I often program inside Docker containers](https://github.com/lemire/docker_programming_station) and that works really well with a terminal and an editor. Docker has been a game changer for me: I am no longer limited by whatever tools I can install on my host system.

I stay away from IDEs. [People keep in mind that IDEs are not at all recent](/lemire/blog/2017/07/15/what-is-modern-programming/). Like many people, I started programming using IDEs. I learned to program seriously with Turbo Pascal, and then I used Visual Basic, Delphi, Visual Studio, Eclipse and so forth. I am not against IDEs per se and I will happily spin up Visual Studio, Xcode or IntelliJ but I do not want my workflow to depend on a specific tool and I like to script everything away. I realize that many people want to be able to press a button that builds and test their code, but I prefer to type `ctest` or <tt>go test</tt> or <tt>cargo test</tt> or <tt>npm test</tt>. Importantly, I want my code to work for other people no matter what their setup is: I find it offensive to require that collaborators use the same graphical tools that I do. Furthermore, my experience has been that though learning to use the command-line tools is initially harder, it tends to pay off in the long term via better maintainability, more automation, and a deeper knowledge of the tools.

Importantly, I am not &ldquo;locked in&rdquo; with Visual Studio Code. I can switch to any other text editor in an instant. And I sometimes do. If I need to change a file remotely, I might often use vim.

I never use code completion. If the editor provides it, I disable it. However, I often spend a lot of time reading a project&rsquo;s documentation. If the documentation is missing, I might read the source code instead.

How do I deal with bugs? As I just stated, I will almost never run through the code execution. Instead I will use one of the following strategies:

1. In an unsafe language like C++, you can get really nasty problems if you have illegal memory accesses. If I am getting strange bugs, I might run my code with [sanitizers](/lemire/blog/2016/04/20/no-more-leaks-with-sanitize-flags-in-gcc-and-clang/). It is a game changer: it makes C and C++ usable languages. There are various limitations to sanitizers and they do tend to make the compile-run cycle longer, so I do not use them routinely. In fact, I build most of my code in release mode; I rarely compile in debug mode.
1. I write a lot of tests. In fact, most of the code that I write consists of tests. Once you have extensive tests, you usually can narrow down the bugs to one piece of code. I will then just read it over carefully. If I just sit quietly and study a small enough piece of code, I can often eventually understand and fix the bug. I am probably not a better programmer than you are, but you do not write tests, then I can be certain that your code has more bugs.
1. I can make an obsessive use of continuous integration tests. Running all tests, on all platforms, with every single code change is great. In this manner, I avoid accumulating several bugs.
1. I write documentation. Often, merely explaining (in the code or elsewhere) what a function should do is enough to figure out the bugs.
1. I might use logging in hard cases. That is, I print out how the data is being processed. In sufficiently complex code, it pays to insert logging instructions describing the execution of the code, these logging instructions are enabled or disabled at compile time. These logs are rarely about the state of specific variables or location in the code. Rather, they present a semantically consistent log of how the data is getting processed. In my experience, it is only needed in specific cases to study what I might call &ldquo;meta-bugs&rdquo;: all of your functions are bug-free, but they interact poorly due to bad assumptions.


My work is often focused on performance. I sometimes examine the assembly output from the compiler, but rarely so. You can get most of the performance with simple programming techniques. However, you need to run benchmarks. I might not know your systems better than you do, but if you never write benchmarks, then my code is probably faster.

I also do not tend to rely very much on static analysis. I do not pay much attention to compiler warnings. I also shy away from &ldquo;grand theories&rdquo; of programming. I will happily use functional programming or object-oriented-programming, but I will never get stuck in one approach.

I would describe my approach to programming as being mostly empirical. I write code, then I test it then I benchmark it. This works in all programming languages, from C to JavaScript.

__Remark__: This is how I work but not a prescription on how other people should work. It is fine that you prefer to work differently, I encourage diversity. It is not fine to act as if I am lecturing you to work a certain way.

