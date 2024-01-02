---
date: "2017-08-25 12:00:00"
title: "Quantifying the performance benefits of Go 1.9 on bitsets"
---



Go, the programming language initiated at Google, has recently shipped its version 1.9. One big change is the introduction of the [math/bits](https://golang.org/pkg/math/bits/) package which offers hardware-accelerated functions to manipulate data.

When working with bitsets, we often need to count the numbers of 1s in a word. That&rsquo;s called a population count. [The fastest way to compute population counts on array involves SIMD instructions](https://arxiv.org/abs/1611.07612). Yet, the second best way is to use the dedicated population count instructions offered by modern-day processors. In both Will Fitzgerald&rsquo;s [bitset package](https://github.com/willf/bitset) and in the [roaring package](https://github.com/RoaringBitmap/roaring) (offering [compressed bitsets](http://roaringbitmap.org)), we resorted to hand-crafted assembly code to improve the performance. That&rsquo;s a poor solution. It makes the code harder to maintain, it tends to get disabled in a cloud computing setting, and so forth. Thankfully, Go now gives us [access to these fast instructions with its dedicated functions](https://golang.org/pkg/math/bits/#OnesCount64).

But we might be concerned that, maybe, using these new functions could deliver worse performance than the hand-tuned assembly. Let us test it out.

First I consider Fitzgerald&rsquo;s bitset package:
```Go
$ go test -run=XXX -bench Count >old.txt
$ git checkout go19
$ go get golang.org/x/tools/cmd/benchcmp
$ go test -run=XXX -bench Count >new.txt
$ benchcmp old.txt new.txt
benchmark                  old ns/op     new ns/op     delta
BenchmarkCount-4           2676          1352          -49.48%
BenchmarkLemireCount-4     2569228       1401137       -45.46%
```


Wow! Will made this benchmark nearly twice as fast!!! (Credit: Will did the work, I just checked the speed.)

Ok. What about [bitset package](https://github.com/willf/bitset)?
```Go
$ go test -run=XX -bench=BenchmarkPopcount > oldwasm.txt
// grap new version
$ go test -run=XX -bench=BenchmarkPopcount > new.txt
$ benchcmp oldwasm.txt new.txt
benchmark               old ns/op     new ns/op     delta
BenchmarkPopcount-2     97.6          61.1          -37.40%
```


Again, pretty much the same story, almost doubling the performance. The benchmark and the test machines are different, so we cannot compare the relative gains, but the gains are enormous, that much is clear!

(The roaring [work](https://github.com/RoaringBitmap/roaring/pull/103) was done by [Maciej](https://github.com/maciej).)

Whether this matters in any given application is hard to tell, but take into account that these performance gains are basically &ldquo;for free&rdquo;. It is the difference between using the dedicated silicon on your chip, or doing something twice as complicated instead.

This is great, but Go is still missing some key intrinsics. One particular annoyance is that most 64-bit processors today can cheaply compute the most significant 64 bits of the multiplication between two 64-bit integers. In the case of x64 processors, this computation is literally free most of the time. Yet there is no way to access this, and you are stuck doing something much slower instead, just because of the limitations of the language.

Don&rsquo;t get me started with SIMD instructions: there is no good way to write vectorized algorithms in Go.

