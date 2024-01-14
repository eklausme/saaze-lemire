---
date: "2023-04-14 12:00:00"
title: "Interfaces are not free in Go"
---



We are all familiar with the concept even if we are not aware of it: when you learn about arithmetic in school, you use the same mathematical symbols whether you are dealing with integers, fractions or real numbers. In software programming, this concept is called <em>polymorphism</em>. To be precise, in software programming, polymorphism means that can access objects of different types through the same interface.

The Go programming language has &ldquo;polymorphism&rdquo; through the notion of &lsquo;interface&rsquo;. It is somewhat similar to interfaces in Java, if you are a Java programmer.

Let us illustrate. Sometimes we like to &lsquo;iterate&rsquo; through a set of values&hellip; we often call the software implementation of this concept an iterator. You can specify an _iterator_ as an interface in Go&hellip; and once you have that, you can define a function to count the number of elements:
```Go
type IntIterable interface {
    HasNext() bool
    Next() uint32
    Reset()
}

func Count(i IntIterable) (count int) {
    count = 0
    i.Reset()
    for i.HasNext() {
        i.Next()
        count++
    }
    return
}

```


So far, so good. This function Count will count the number of elements in any Go instance that satisfies the interface (hasNext, Next, Reset): any structure in Go that implements these functions can be processed by the function.

Next you can provide Go with an actual implementation of the &lsquo;IntIterable&rsquo; interface:
```Go
type IntArray struct {
    array []uint32
    index int
}

func (a *IntArray) HasNext() bool {
    return a.index < len(a.array)
}

func (a *IntArray) Next() uint32 {
    a.index++
    return a.array[a.index-1]
}

func (a *IntArray) Reset() {
    a.index = 0
}

```


And magically, you can call <tt>Count(&amp;array)</tt> on an instance of `IntArray` and it will count the number of elements. This seems a lot better than specialized code such as&hellip;
```Go
func CountArray(a *IntArray) (count int) {
    count = 0
    a.Reset()
    for a.HasNext() {
        a.Next()
        count++
    }
    return
}

```


Unfortunately, it is not entirely better because the specialized function may be significantly faster than the function taking an interface. For sizeable arrays, the specialized function is about twice as fast in some of my tests:

Count (interface)        |2 ns/element             |
-------------------------|-------------------------|
CountArray               |1 ns/element             |


Your results will vary, but the concept remains: Go does not ensure that interfaces are free computationally. If it is a performance bottleneck, it is your responsibility to optimize the code accordingly.

Sadly, both of these functions are too slow: the computation of the number of elements should be effectively free (0 ns/element for sizeable arrays) since it is just the length of the array, a constant throughout the benchmarks. In fact, in my benchmarks, the size of the array is even known at compile time.

[My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/04/14).

In the next blog post, [I compare with what is possible in C++](/lemire/blog/2023/04/18/defining-interfaces-in-c-with-concepts-c20/).

