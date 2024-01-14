---
date: "2020-06-04 12:00:00"
title: "The Go compiler needs to be smarter"
---



One of my favorite languages is the Go language. I love its simplicity. It is popular and useful in a cloud setting. Many popular tools are written in Go, and for good reasons.

I gave a talk on Go last year and I was asked for a criticism of Go. I do not mind that Go lacks exceptions or generics. These features are often overrated.

However, as charming as Go might be, I find that its compiler is not on par with what I expect from other programming languages. It could be excused when Go was young and immature. But I think that the Go folks now need to tackle these issues.

My first beef with the compiler is that it is shy about inlining. Inlining is the process by which you bring  a function into another function, bypassing the need for a function call. Even when the function call is inexpensive, inlining often brings many benefits.

Go improved its inlining strategies over time, but I would still describe it as &ldquo;overly shy&rdquo;.

Let me consider the following example where I first define a function which sums the element in an array, and then I call this function on an array I just defined:
```Go
func sum(x  []uint64) uint64 {
    var sum = uint64(0)
    for _, v := range x {
        sum += v
    }
    return  sum
}


func fun() uint64 {
    x := []uint64{10, 20, 30}
    return sum(x)
}
```


Whether you use Rust, Swift, C, C++&hellip; you expect a good optimizing compiler to basically inline the call to the &lsquo;sum&rsquo; function and then to figure out that the answer can be determined at compile time and to optimize the &lsquo;fun&rsquo; function to something trivial.

Not so in Go. [It will construct the array and then call the &lsquo;sum&rsquo; function](https://godbolt.org/z/CNMLMo).

In practice, it means that if you want good performance in Go, you often have to manually inline your functions. And I mean: fully inline. You have to write a really explicit function if you want the Go compiler to optimize the computation away, like so:
```Go
func fun3() uint64 { 
    x := [3]uint64{10001, 21, 31}
    return x[0] + x[1] + x[2] 
}
```


My second concern with the Go language is that it has no real concept of runtime constant variable. That is, you have compile-time constants but if you have a variable that is set once in the life of your program, and never change, Go will still treat it as if it could change. The compiler does not help you.

Let us take an example. Go has added nice function that give you access to fast processor instructions. For example, most x64 processors have a popcnt instruction that gives you the number 1-bit in a 64-bit word. It used to be that the only way to access this instruction in Go was by writing assembly. Thas been resolved. So let us put this code into action:
```Go
import "math/bits"

func silly() int {
    return  bits.OnesCount64(1) + bits.OnesCount64(2)
}
    
```


This function should return 2 since both values provided (1 and 2) have exactly one bit set. I bet that most C/C++ compilers can figure that one out. But we may excuse Go for not getting there.

Go needs to check, before using the popcnt instruction, that the processor supports it. When you start Go, it queries the processor and fills a variable with this knowledge. This could be done at compile-time but then your binary would crash or worse when run on a processor that does not support popcnt.

In a language with just-in-time compilation like Java or C#, the processor is detected at compile-time so no check is needed. In less fanciful languages like C or C++, the programmer needs to check what the processor supports themselves.

I can excuse Go for checking that popcnt is supported each and every time that the &lsquo;silly&rsquo; function called. But that is not what Go does. [Go checks it twice](https://godbolt.org/z/iYLQx-):
```Go
        cmpb    runtime.x86HasPOPCNT(SB), $0
        jeq     silly_pc115
        movl    $1, AX
        popcntq AX, AX
        cmpb    runtime.x86HasPOPCNT(SB), $0
        jeq     silly_pc85
        movl    $2, CX
        popcntq CX, CX
```


That is because the compiler does not trust, or cannot determine, that the variable &lsquo;runtime<span style="color: #808030;">.</span>x86HasPOPCNT&rsquo; is a runtime constant.

Some people will object that such checks are inexpensive. I think that this view should be challenged:

- As is apparent in the assembly code I provide, you might be doubling or at least increasing by 50% the number of instructions required. A comparison and a jump is cheap, but so is popcnt (some processors can retire two popcnt per cycle!). Increasing the number of instructions makes code slower.
- It is true that the branch/jump is likely to be correctly predicted by the processor. This makes the guarding code much cheaper than a branch that could sometimes be mispredicted. [But that does not mean that you are not getting hurt:](https://www.infoq.com/articles/making-code-faster-taming-branches/)<br/>

> Even when it is impossible to remove all branches, reducing the number of branches &ldquo;almost always taken&rdquo; or &ldquo;almost never taken&rdquo; may help the processor better predict the remaining branches.  (&hellip;) A possible simplified explanation for this phenomenon is that processors use the history of recent branches to predict future branches. Uninformative branches may reduce the ability of the processors to make good predictions.



Go&rsquo;s saving grace is that it makes it easy to integrate assembly code into your code base. So you can write your performance-critical in C, compile it, and use the result in your Go project. That is how we do it in [roaring](https://github.com/RoaringBitmap/roaring), for example. People have ported [the really fast Stream VByte encoding](https://github.com/bmkessler/streamvbyte) and t[he very fast simdjson parser](https://github.com/minio/simdjson-go) in Go, again by using assembly. It works.

However, it leaves the bulk of the Go software running at a fraction of the performance it could reach with a great optimizing compiler.

__Appendix__: Compiling Go with gccgo solves these particular problems. However, reportedly, [the overall performance of gccgo is worse](https://meltware.com/2019/01/16/gccgo-benchmarks-2019.html).

