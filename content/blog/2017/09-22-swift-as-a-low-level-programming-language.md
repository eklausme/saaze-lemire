---
date: "2017-09-22 12:00:00"
title: "Swift as a low-level programming language?"
---



Modern processors come with very powerful instructions that are simply not available in many high-level languages JavaScript or Python. Here are a few examples:

- Most programming languages allow you to multiply two 64-bit integers and to get the 64-bit results (it is typically written as <tt>x = a * b</tt>). But the multiplication of two 64-bit integers actually occupies 128 bits. Reasonably enough, most programming languages (including C, Java, Go, Swift, C++,&hellip;) do not have 128-bit integers as a standard data type. So these programming languages have no way to represent the result, other than as two 64-bit integers. In practice, they often offer no direct way to get to the most significant 64 bits. Yet 64-bit processors (x64, ARM Aarch64&hellip;) have no problem computing the most significant 64 bits. 
- Similarly, processors have specialized instructions to compute population counts (also called Hamming weight). A population count is the number of ones contained in the binary representation of a machine word. It is a critical operation in many advanced algorithms and data structures. You can compute it with shifts and additions, but it is much, much slower than when using the dedicated processors that all modern processors have to solve this problem. And I should stress that [you can beat the dedicated instructions with vector instructions](https://arxiv.org/abs/1611.07612).


This disconnect between programming languages and processors is somewhat problematic because programmers have to get around the problem by doing more work, essentially letting the perfectly good instructions that processors offer go to waste. To be clear, that&rsquo;s not an issue for most people, but most people do not deal with difficult programming challenges.

That is, 95% of all programming tasks can be solved with Python or JavaScript. Then, out of the remaining 5%, the vast majority are well served with something like Java or C#. But then, for the top 1% of all programming problems, the most challenging ones, then you need all of the power you can get your hands on. Historically, people have been using C or C++ for these problems. 

I like C and C++, and they are fine for most things. These languages are aging well, in some respect. However, they also carry a fair amount of baggage.

But what else is there? 

Among many other good choices, there is Apple&rsquo;s Swift. 

Swift is progressing fast. Swift 4.0 is a step forward. And, in some sense, it is beating C and C++. Let me consider the two problems I mentioned: getting the most significant bits of a product and computing the population count. C and C++ offer no native way to solve these problems. At best, there are common, non-portable, extensions that help.

Swift 4.0 solves both problems optimally in my view:

- <tt>value1.multipliedFullWidth(by: value2).high</tt> gets mapped to the `mulx` instruction on my x64 laptop
- <tt>value.nonzeroBitCount</tt> gets mapped to the `popcnt` instruction on my x64 laptop


(The phrase `nonzeroBitCount` is a weird way to describe the population count, but I can live with it.)

If you call these operations in a tight loop, they seem to generate very efficient code. In fact, consider the case where you repeatedly call <tt>value.nonzeroBitCount</tt> over an array:
```C
func popcntArray( _  value  : inout [UInt64] ) -> Int {
    return value.reduce( 0, { x, y in
        x &+ popCnt(y)
        })
}
```


The compiler does not use <tt>popcnt</tt>, but rather the more efficient vectorized approach (see [MuÅ‚a et al.](https://arxiv.org/abs/1611.07612)). That&rsquo;s because Swift benefits from the powerful LLVM machinery in the back-end.

[I wrote a small Swift 4.0 program to illustrate my points](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2017/09/21). You can compile a swift program for your hardware using a command such as <tt>swiftc myprogram.swift -O -Xcc -march=native</tt>. You can then use the lldb debugger to automatically get the assembly produced by a given function.

__Conclusion.__ If you are not targeting iOS, it is crazy to use Swift for high-performance low-level programming language at this time. However, it is getting less and less crazy.

