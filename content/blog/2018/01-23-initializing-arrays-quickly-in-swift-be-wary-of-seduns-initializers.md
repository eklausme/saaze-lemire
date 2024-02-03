---
date: "2018-01-23 12:00:00"
title: "Initializing arrays quickly in Swift: be wary of Sadun´s initializers"
---



Swift is Apple&rsquo;s go-to programming language. It is the new default to build applications for iPhones. It also runs well on Linux.

It is not as low-level as C or C++, but it has characteristics that I like. For example, it does not use a &ldquo;fancy&rdquo; garbage collector, relying instead on deterministic reference counting. It is also a compiled language. It also benefits from a clean syntax.

Suppose you want to initialize an array in Swift with the values 0, 100, 200&hellip; Let us pick a sizeable array (containing 1000 elements). The fastest way to initialize the array in my tests is as follows:
```C
Array((0..<1000).lazy.map { 100 * $0 })
```


The &ldquo;lazy&rdquo; call is important for performance&hellip; I suspect that without it, some kind of container is created with the desired values, and then it gets copied back to the Array.

One of the worse approaches, from a performance point of view, is to repeatedly append elements to the Array:
```C
var b = [Int]()
for i in stride(from: 0, to: maxval, by: skip) {
     b.append(i)
}
```


It is more than 5 times slower! [Something similar is true with vectors in C++](/lemire/blog/2012/06/20/do-not-waste-time-with-stl-vectors/). In effect, constructing an array by repeatedly adding elements to it is not ideal performance-wise.

One nice thing about Swift is that it is extensible. So while Arrays can be initialized by sequences, as in my code example&hellip; they cannot be initialized by &ldquo;generators&rdquo; by default (a generator is a function with a state that you can call repeatedly)&hellip; we can fix that in a few lines of code.

Erica Sadun proposed to extend Swift arrays so that they can be initialized by generators&hellip; [Her code is elegant](https://academy.realm.io/posts/try-swift-nyc-2017-erica-sadun-swift-flexibility-arrays/):
```C
public extension Array {
  public init(count: Int, generator: @escaping() -> Element) {
    precondition(count >= 0, "arrays must have non-negative size")
    self.init(AnyIterator(generator).prefix(count))
  }
}
```


I can use Erica Sadun&rsquo;s initializer to solve my little problem:
```C
var runningTotal : Int = 0
let b = Array(count: 1000) {() -> Int in
           runningTotal += 100
           return runningTotal
}
```


How fast is Erica&rsquo;s initializer?
```C

$ swift build    --configuration release && ./.build/release/arrayinit
append                           6.091  ns
lazymap                          1.097  ns
Erica Sadun                      167.311  ns
```


So over 100 times slower. Not good.

Performance-wise, Swift is a rather opinionated language: it really wants you to initialize arrays from sequences.

We can fix Erica&rsquo;s implementation to get back to the best performance:
```C
public extension Array {
  public init(count: Int, generator: @escaping() -> Element) {
    precondition(count >= 0, "arrays must have non-negative size")
    self.init((0..<count).lazy.map { Element in generator() })
  }
}
```


[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/01/23).

