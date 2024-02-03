---
date: "2017-09-05 12:00:00"
title: "Go does not inline functions when it should"
---



I have designed a benchmark that I run in different programming languages. Two languages that I like are Go (from Google) and Java (from Oracle). My expectation would be that Go and Java should have similar performance in due time. Indeed, both are modern garbage-collected languages supported by major corporations with deep pockets.

It used to be that Go was handicapped in my benchmark because the language did not offer a simple way to compute population counts using specialized processor instructions. Go 1.9 changes that with the introduction of the [math/bits](https://golang.org/pkg/math/bits/) package. I was hoping for Go to catch up to Java.

So how does Go fare against Java now?

Let us sum this up:

&nbsp;                   |create                   |count                    |iterate                  |
-------------------------|-------------------------|-------------------------|-------------------------|
Java 8                   |5 ms                     |0.6 ms                   |4 ms                     |
Go 1.9                   |10 ms                    |1.2 ms                   |6 ms                     |


So Go is often running at half the speed compared to Java. The Count benchmark in Go is about two times faster than it was prior to Go 1.9, but it is still far from Java.

What could explain such a difference? If you look at the code, it is all very simple loops.

Modern programming involves many short functions. Programming with short functions makes code review much easier, and it avoids code duplication.

Calling a function can be a relatively expensive process. The system has to copy the data in the right registers, allocate stack memory, and so forth. Moreover, functions are somewhat opaque to the optimizing compiler so that many easy optimizations are simply not possible without function inlining.

As programmers, we usually do not worry about the performance cost of having many function calls because we expect the function calls to be mostly optimized away. One way the system optimizes away function calls is by &ldquo;inlining&rdquo; the function&hellip; in effect, it &ldquo;copies&rdquo; the code in place, so that there is no function call at all. That&rsquo;s hardly bleeding edge technology in 2017: most optimizing compilers have been doing it for decades.

Inlining is not always useful: when used indiscriminately, it can grow the size of the executables. You do not want to inline large functions. But if you have a long loop that repeatedly calls the same small function, you can expect to greatly benefit by inlining the function in question.

Yet, as far as I can tell, Go is terribly shy about inlining function calls even when it would obviously make sense. We can verify that Go does not inline small hot functions within tight loops in my benchmark by examining the assembly:
```Go

$ go test -c && go tool objdump -S -s BenchmarkLemireCreate bitset.test |grep CALL
  0x5193d3		e848c9ffff		CALL github.com/willf/bitset.(*BitSet).Set(SB)
```


What the `Set` function does is simple: it sets a single bit in a single machine word, but Go won&rsquo;t inline it, possibly because there is a branch involved. We can double the speed of the `Create` test if we manually inline the `Set` function calls and do some minor surgery on how the data gets reallocated.

Even when Go apparently inline the function calls, as in the math/bits calls, it seems to surround the single instruction that should be emitted by guarding code. In effect, the processor checks that the instruction in question is supported each and every time it needs to be called. That can probably reduce the performance of the instruction by a factor of two.

Should you care? I think you should. Having half the speed means that you might end up using two cores to solve the same problem in the same time. That&rsquo;s twice the energy usage! And that is if you are lucky: parallelizing is hardly free from complexity and pitfalls.

Of course, my benchmark is probably not representative of whatever systems people build, but it is also not crazily unrealistic. It is likely representative of many performance bottlenecks.

Go has to get inlining right.

__Further reading__:

- [Proposal: cmd/compile: add a go:inline directive](https://github.com/golang/go/issues/21536)
- [cmd/compile: improve inlining cost model](https://github.com/golang/go/issues/17566)
- [Mid-stack inlining in the Go compiler](https://docs.google.com/presentation/d/1Wcblp3jpfeKwA0Y4FOmj63PW52M_qmNqlQkNaLj0P5o/edit#slide=id.p)
- [cmd/compile: enable mid-stack inlining](https://github.com/golang/go/issues/19348)
- [cmd/compile: for-loops cannot be inlined](https://github.com/golang/go/issues/14768)
- [cmd/compile: inline function calls that return a closure](https://github.com/golang/go/issues/10292)


George Tankersley has a GopherCon 2017 talk ([I want to Go fast](https://youtu.be/7y2LhWm04FU)) about how to get Go to inline small functions. He gets good results, but the process is not pretty. It is clearly a case where he is fighting against the optimizing compiler in a manner that should not be necessary.

__Appendix__. My results are reproducible.

Let us first run the benchmark using Java 8:
```Go

$ git clone https://github.com/lemire/microbenchmarks
$ cd microbenchmarks
$ mvn install
$ java -cp target/microbenchmarks-0.0.1-jar-with-dependencies.jar me.lemire.microbenchmarks.bitset.Bitset

Benchmark                   Mode  Samples  Score   Error  Units
m.l.m.b.Bitset.construct    avgt        5  0.008 ± 0.001   s/op
m.l.m.b.Bitset.count        avgt        5  0.001 ± 0.000   s/op
m.l.m.b.Bitset.iterate      avgt        5  0.005 ± 0.000   s/op
```


Let us run the benchmark using Go 1.9:
```Go

$ go get github.com/willf/bitset
$ cd ~/go/src/github.com/willf/bitset
$ go test -bench=Lemire
{0,1,2,3,4,5,6,7,8,9}
goos: linux
goarch: amd64
pkg: github.com/willf/bitset
BenchmarkLemireCreate-2    	     100	  10440889 ns/op
BenchmarkLemireCount-2     	    1000	   1271236 ns/op
BenchmarkLemireIterate-2   	     200	   6111728 ns/op
PASS
ok  	github.com/willf/bitset	4.414s
```


