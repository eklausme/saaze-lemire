---
date: "2017-09-26 12:00:00"
title: "Runtime constants: Swift"
---



[In an earlier post](/lemire/blog/2017/09/26/runtime-constants-go-vs-c/), I reported that if you have a variable in C++ such that the compiler can determine it to be effectively constant&hellip; that is, in practice, we cannot change its value, then the C++ optimizing compiler will treat it as if it were an actual constant. The same thing is not true in a language like Go.

Some readers asked about Swift, Apple&rsquo;s new language.

Let us consider a fair comparison:```C
fileprivate var length = 10

func sum(array : [Int]) -> Int {
    var answer = 0
    for i in 0..<length {
        answer = answer &+ array[i]
    }
    return answer
}
```


So we have a function that depends on a variable `length` that is very specifically not defined as a constant. Swift, like Go and C++, has a notion of a constant, that is, I could write <tt>let length = 10</tt>. However, I declared it with the `var` keyword which means that the compiler must assume that I can modify the value of <tt>length</tt>.

Yet, I defined `length` to be `fileprivate` which is the closest thing to C++&rsquo;s <tt>static</tt>: it means that if the variable is accessed at all, it must be accessed within the current file (meaning the actual text file containing Swift code). This means that the Swift compiler can examine the current code contained in the file to check whether `length` is ever modified. In my case, it never is.

So what happens?

Like in C++, it gets compiled to a tight set of additions:
```C
add rax, qword ptr [rdi + 32]
add rax, qword ptr [rdi + 48]
add rax, qword ptr [rdi + 56]
add rax, qword ptr [rdi + 64]
add rax, qword ptr [rdi + 72]
add rax, qword ptr [rdi + 80]
add rax, qword ptr [rdi + 88]
add rax, qword ptr [rdi + 96]
add rax, qword ptr [rdi + 104]
```


What this means is that the Swift compiler deduced correctly that `length` was a constant. You do have to turn the optimizations (-O), of course.

But is Swift safe?

Let us do something bad:
```C
var x  = [1, 2, 3, 4, 5, 6, 7, 8, 9];

print(sum(array:x))
```


My array is too short. In C++, this would lead the `sum` function to read memory out of bound. If you compiled your code just right, you might get a warning, but the C++ language itself does not do anything to help you.
In Swift, you get the following:
```C

$ swiftc -O mytest.swift
$ ./mytest
(crash)
$
```


That is, by default Swift relies on bound checking. This means that your program will crash if you try to access memory out-of-bound.

It is important to note that I do mean &ldquo;crash&rdquo;. It will not throw a nice exception. Your program just dies a horrible death.

Still, Swift can be used without bound checking:
```C

$ swiftc -Ounchecked mytest.swift
$ ./mytest
45
```


I got &ldquo;45&rdquo; but you could possibly get different values.
That is, with normal optimization levels (typical of a release), you have bound checking and crashing programs. With the crazy optimization level (-Ounchecked), you get no safety.

So the Swift compiler is a state-of-the-art optimizing compiler, at least as far as deducing runtime constants. That&rsquo;s not surprising, but it is nice to know.

