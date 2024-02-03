---
date: "2017-07-15 12:00:00"
title: "What is &#8220;modern&#8221; programming?"
---



As a young teenager, I dabbled with basic and some assembly. Things got serious when I learned Turbo Pascal. &ldquo;Now we are talking&rdquo;, I thought.[ Turbo Pascal offered one of the earliest examples of Integrated Development Environment (IDE)](https://photos.app.goo.gl/WcxNIutwtWmFTdzL2). In effect, an IDE is a program that lets you conveniently write, compile, debug and run code, all within a friendly environment. Turbo Pascal did not have much in the way of graphics (it was text-based), but it had menus and windows. You could enter a debugging mode, track the value of variables, and so forth.

Then I moved on to [Delphi](https://photos.app.goo.gl/QnCWPHDcp4Drzev12) (a graphical Turbo Pascal) and it had a superb IDE that would still look good today. I played with [Visual Basic](https://www.youtube.com/watch?v=TgIrzFqGIKM), designing a &ldquo;talking clock&rdquo; that I published on Bulletin Board Systems at the time (with Windows 3.1). Then I found out about Visual Studio&hellip; For years, my reference for C++ programming was Visual Studio. So it was all IDEs, all the time.

[Smalltalk famously had powerful graphical IDEs back in the early 1980s](https://www.youtube.com/watch?v=e0LfndNxqZg).

[Chris Wellon wrote about Borland C++](http://nullprogram.com/blog/2018/04/13/), an IDE from the 1990s:

> To test drive the IDE, I made a couple of test projects, built and ran them with different options, and poked around with the debugger. The debugger is actually pretty decent, especially for the 1990s. It can be operated via the IDE or standalone, so I could use it without firing up the IDE and making a project. (&hellip;) The toolchain includes an assembler, and I can inspect the compiler&rsquo;s assembly output. (&hellip;) Imagining myself as a software developer in the mid 1990s, this means I can see exactly what the compiler&rsquo;s doing as well as write some of the performance sensitive parts in assembly if necessary.


My point is that using an IDE is not &ldquo;modern&rdquo;. The present is very much like the past. What we program has changed, but, in many instances, how we program has not changed. I have the latest Visual Studio on my Dell laptop. The man I was 20 years ago would be perfectly at ease with it. Debugging, code completion, code execution&hellip; it is much like it was. In fact, Visual Studio was never very different from Turbo Pascal. And I find this deeply depressing. I think we should make much faster progress than we are.

I submit to you that modern programming has little to do with the look of your desktop. Graphical user interfaces are only skin deep. Modern programming techniques are all about processes and actual tools, not the skin on top of them. I don&rsquo;t care whether you are using Eclipse or Emacs&hellip; this tells me nothing about how modern you are.

So what is &ldquo;modern&rdquo;?

- Coding is social. Twenty years ago, it was sensible to require everyone in your organization to use the exact same IDE and to depend uniquely on your IDE to build, test, deploy code&hellip; But there are lots of smart people outside of your organization and they often do not use your IDE. And today you can reach them. This means that you must be wise regarding the tools and processes you adopt.

If you mock people who program using the Atom text editor, Visual Studio or Emacs, you are not being social. You need to be as inclusive as possible, or pay the price.
- The Go language comes with its own formatting tool. I don&rsquo;t care whether you reformat your code automagically as you save, or whether click a button, or whether you type <tt>go fmt</tt>, it is all the same&hellip; and it is definitively a great, modern idea. It is progress. All programming languages should force upon the users a unique code format. No more bikeshedding.

And so we are clear, Java had guidelines, but guidelines are insufficient. We need a tool that takes the code as an input and generates a uniquely defined output where everything is dealt with, from line length to spaces.

The goals are that there is never any possible argument as to how the code should be formatted and that the correct format is produced without effort. I cannot tell you how important that is.
- Programming languages like Rust, Go, Swift&hellip; come with their own package management system. So, in Swift, for example, I can create a small text file called <tt>Package.swift</tt> and put it at the root of my project, where I declare my dependencies&hellip;
```C
import PackageDescription

let package = Package(
    name: "SwiftBitsetBenchmark",
    dependencies: [
   .Package(url: "https://github.com/lemire/SwiftBitset.git",
          majorVersion: 0),
   .Package(url: "https://github.com/lemire/Swimsuit.git",
          majorVersion: 0)
    ]
)
```


([Source example](https://github.com/lemire/SwiftBitsetBenchmark).)

Then I can type <tt>swift build</tt> and the software will automatically grab the dependencies and build my program. And this works everywhere Swift runs. It does not matter which text editor or IDE you are using.

You don&rsquo;t want to use text editor, and you prefer to use a graphical interface? Fine. It makes no difference.

Why is that modern? Because automatically resolving dependencies with so little effort would have looked like magic to me 20 years ago. And it is immensely important to resolve dependencies automatically and systematically. I do not want to ever have to manually install and deploy a dependency. I want other people to be able to add my library to their project in seconds, not minutes or hours.

Yes, you can add it to existing languages (e.g., as Maven or IDEs do with Java), but there needs to be a unique approach that just works.
- Programming languages like Go, Swift and Rust support unit testing from the start. In Go, for example, create a file <tt>myproject_test.go</tt> and add functions like <tt>func TestMyStuff(t *testing.T)</tt>, then type <tt>go test</tt> and that is all. Twenty years ago, hardly anyone tested their code, today it is an absolute requirement and it needs to be done in a unique manner so you can move from project to project and always know how the tests are done.

If I cannot spot sane unit tests in your code right away, I will assume that your code is badly broken.
- Continuous integration: as code changes, you want a remote tool to grab the new code and test it&hellip; so that a regression can be stopped early. It is not enough that people can run tests on your code, they also need to see the results of automated testing and check the eventual failures for themselves.

Continuous integration is part of a larger scheme: you must automate like crazy when you program. Manual labor should be minimized. And sometimes that means that you really ought to only click on a button, but what it should never mean is that you repeatedly need to follow a complicated sequence of commands, whether through a graphical user interface or through a command shell.
- Version control. Twenty years ago, it made sense to write your code on your desktop and send the new code (as patches) by email. But this only makes sense when the pace of collaboration is slow. Today, this would be insane. Anything less than Git is backward. Note that even Microsoft builds Windows using Git today.


So what happens when you work with smart students who never learned about modern programming? They look at a command like <tt>go get</tt> and they only see the skin (a command line). They think it is backward. Where are the flashy graphics?

They work within a nice-looking IDE like Visual Studio or Eclipse and they are convinced that they are &ldquo;modern&rdquo;, totally oblivious to the fact that IDEs go back decades. And then instead of using the IDE for its strengths, such as better affordance and faster operations, and adopting modern programming techniques elsewhere&hellip; they stick with old-school programming:

- No test. At least, no automated and systematic test.
- Hard dependencies on a specific setup.
- No automation. No continuous integration. No automated deployment.


They are programming just like I did when I started out decades ago with [Turbo Pascal](https://photos.app.goo.gl/WcxNIutwtWmFTdzL2). It is very much old school, despite the graphical user interfaces.

