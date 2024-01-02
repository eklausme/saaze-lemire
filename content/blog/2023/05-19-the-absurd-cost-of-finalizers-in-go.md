---
date: "2023-05-19 12:00:00"
title: "The absurd cost of finalizers in Go"
---



The Go programming language makes it easy to call C code. Suppose you have the following C functions:
```Go
char* allocate() {
  return (char*)malloc(100);
}
void free_allocated(char *c) {
  free(c);
}

```


Then you can call them from Go as follows:
```Go
c := C.allocate()
C.free_allocated(c)

```


It works well.

You might argue that my functions are useless, but I designed them to be trivial on purpose. In practice, you will call C code to do something actually useful. Importantly, there is an allocation followed by a necessary deallocation: this is typical in realistic code.

Reasonably, Go programmers are likely to insist that the memory allocated from Go be released automatically. Thankfully, Go has a mechanism for this purpose. You put the C data in a Go structure which is subject to automatic garbage collection. Then you tie the instances of this structure to a &ldquo;finalizer&rdquo; function which will be called before the Go structures is garbage collected. The code might look as follows:
```Go
type Cstr struct {
  cpointer *C.char
}

func AllocateAuto() *Cstr {
  answer := &Cstr{C.allocate()}
  runtime.SetFinalizer(answer, func(c *Cstr) {  C.free_allocated(c.cpointer); runtime.KeepAlive(c) })
  return answer
}

```


&nbsp;

So far so good. Go is doing very well up until now.

But what is the performance impact? We are comparing these two routines. First, the inconvenient version where you manually have to free the allocated memory&hellip;
```Go
p := Allocate()
Free(p)
```


and then the version which relies on Go&rsquo;s memory management&hellip;
```Go
AllocateAuto()
```


Let us benchmark it. [My benchmarking code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/05/19), your results will differ from mine but I care only about the big picture.

In my case, the automated version is nearly ten times slower.

AllocateAuto             |650 ns                   |
-------------------------|-------------------------|
Allocate-Free            |75 ns                    |


The 650 ns result is silly: it is thousands of CPU cycles.

Maybe it is the overhead due to garbage collection ? Thankfully, Go allows us to disable garbage collection with <tt>GOGC=off</tt>:

AllocateAuto (no GC)     |580 ns                   |
-------------------------|-------------------------|
Allocate-Free (no GC)    |75 ns                    |


So the numbers are slightly better, but barely so.

We can try to see where the problem lies with profiling:
```Go
go test -cpuprofile gah -bench BenchmarkAllocateAuto -run -
go tool pprof gah
> top
```


We get that most of the processing time is spent in <tt>runtime.cgocall</tt>:
```Go
     1.67s 70.17% 70.17%      1.67s 70.17%  runtime.cgocall
     0.23s  9.66% 79.83%      0.23s  9.66%  runtime.usleep
     0.12s  5.04% 84.87%      0.12s  5.04%  runtime.pthread_cond_signal
```


What if I try a dummy finalizer?
```Go
func AllocateDummy() *Cstr {
 answer := &Cstr{C.allocate()}
 runtime.SetFinalizer(answer, func(c *Cstr) {})
 return answer
}
```


I get the same poor performance, suggesting that it is really the finalizer that is expensive.

This is seemingly consistent with Java, which also has finalizers:

> Oh, and there&rsquo;s one more thing: __there is a _severe_ performance penalty for using finalizers__. On my machine, the time to create and destroy a simple object is about 5.6ns. Adding a finalizer increases the time to 2,400ns. In other words, it is about 430 times slower to create and destroy objects with finalizers. (<em>Effective Java 2nd Edition: Item 7: Avoid finalizers)</em>


Maybe there is a way to do better, I hope there is, but I suspect not.

__Further reading__. [Some notes on the cost of Go finalizers (in Go 1.20)](https://utcc.utoronto.ca/~cks/space/blog/programming/GoFinalizerCostsNotes) by Chris Siebenmann.

