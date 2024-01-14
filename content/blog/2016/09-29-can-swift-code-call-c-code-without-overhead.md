---
date: "2016-09-29 12:00:00"
title: "Can Swift code call C code without overhead?"
---



Swift is the latest hot new language from Apple. It is becoming the standard programming language on Apple systems.
I complained in a previous post that [Swift 3.0 has only about half of Java&rsquo;s speed](/lemire/blog/2016/09/22/swift-versus-java-the-bitset-performance-test/) in tests that I care about. That&rsquo;s not great for high-performance programming.

But we do have a language that produces very fast code: the C language.
Many languages like Objective-C, C++, Python and Go allow you to call C code with relative ease. C++ and Objective-C can call C code with no overhead. Go makes it very easy, but the performance overhead is huge. So it is almost never a good idea to call C from Go for performance. Python also suffers from a significant overhead when calling C code, but since native Python is not so fast, it is often a practical idea to rewrite performance-sensitive code in C and call it from Python. Java makes it hard to call C code, so it is usually not even considered.

What about Swift? We know, as per Apple&rsquo;s requirements, that Swift must interact constantly with legacy Objective-C code. So we know that it must be good. How good is it?

To put it to the test, I decided to call from Swift a simple Fibonacci recurrence function :
```C
void fibo(int * x, int * y) {
  int c = * y;
  *y = *x + *y;
  *x = c;
}
```


(Note: this function can overflow and that is undefined behavior in C.)

How does it fare against pure Swift code?
```C
let c = j;
j = i &+ j;
i = c;
```


To be clear, this is a really extreme case. You should never rewrite such a tiny piece of code in C for performance. I am intentionally pushing the limits.

I wrote a test that calls these functions 3.2 billion times. The pure Swift takes 9.6 seconds on a Haswell processor&hellip; or about 3 nanosecond per call. The C function takes a bit over 13 seconds or about 4 nanoseconds per iteration. Ok. But what if I rewrote the whole thing into one C function, called only once? Then it runs in 11 seconds (it is slower than pure Swift code).
The numbers I have suggest that calling C from Swift is effectively free.

In these tests, I do not pass to Swift any optimization flag. The way you build a swift program is by typing &ldquo;<tt>swift build</tt>&rdquo; which is nice and elegant. To optimize the binary, you can type &ldquo;<tt>swift build --configuration release</tt>&ldquo;. Nice! But benchmark code is part of your tests. Sadly, swift seems to insist on only testing &ldquo;debug&rdquo; code for some reason. Typing &ldquo;<tt>swift test --configuration release</tt>&rdquo; fails since the test option does not have a configuration flag. (Calling <tt>swift test -Xswiftc -O</tt> gives me linking errors.)

I rewrote the code using a pure C program, without any Swift. Sure enough, the program runs in about 11 seconds without any optimization flag. This confirms my theory that Swift is testing the code with all optimizations turned off. What if I turn on all C optimizations? Then I go down to 1.7 seconds (or about half a nanosecond per iteration).

So while calling C from Swift is very cheap, insuring that Swift properly optimizes the code might be trickier.
It seems odd that, by default, Swift runs benchmarks in debug mode. It is not helping programmers who care about performance.

Anyhow, a good way around this problem is to simply build binaries in release mode and measure how long it takes them to run. It is crude, but it gets the job done in this case:
```C
$ swift build --configuration release
$ time ./.build/release/LittleSwiftTest
3221225470

real       0m2.030s
user       0m2.028s
sys        0m0.000s
$ time ./.build/release/LittleCOverheadTest
3221225470

real       0m1.778s
user       0m1.776s
sys        0m0.000s

$ clang -Ofast -o purec  code/purec.c
$ time ./purec
3221225470

real       0m1.747s
user       0m1.744s
sys        0m0.000s
```


So there is no difference between a straight C program, and a Swift program that calls billions of times a C function. They are both just as fast.
The pure Swift program is slightly slower in this case, however. It suggests that using C for performance-sensitive code could be beneficial in a Swift project.

So I have solid evidence that calling C functions from Swift is very cheap. That is very good news. It means that if for whatever reason, Swift is not fast enough for your needs, you stand a very good chance of being able to rely on C instead.

[My Swift source code is available (works under Linux and Mac).](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2016/09/29)

__Credit__: Thanks to Stephen Canon for helping me realize that I could lower the call overhead by calling directly the C function instead of wrapping it first in a tiny Swift function.

