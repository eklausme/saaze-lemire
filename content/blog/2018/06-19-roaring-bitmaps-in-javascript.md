---
date: "2018-06-19 12:00:00"
title: "Roaring Bitmaps in JavaScript"
---



[Roaring bitmaps](http://roaringbitmap.org) are a popular data structure to represents sets of integers. Given such sets, you can quickly compute unions, intersections, and so forth. It is a convenient tool when doing data processing.

I used to joke that Roaring bitmaps had been implemented in every language (Java, C, Rust, Go, and so forth), except JavaScript. This was a joke because I did not expect that one could implement Roaring bitmaps reasonably using JavaScript. I have written a few performance-oriented libraries in JavaScript ([FastBitSet.js](https://github.com/lemire/FastBitSet.js), [FastPriorityQueue.js](https://github.com/lemire/FastPriorityQueue.js), [FastIntegerCompression.js](https://github.com/lemire/FastIntegerCompression.js)), but I could not imagine doing a whole Roaring bitmap implementation in JavaScript.

However, it turns out that many people who program in JavaScript run their code under Node.js. And Node.js supports &ldquo;native addons&rdquo;&hellip; which basically means that you can call a C/C++ library from JavaScript when you are working in Node.js, as long as someone packaged it for you.

[And Salvatore Previti did just that for Roaring bitmaps](https://github.com/SalvatorePreviti/roaring-node). So you can, say, [generate Roaring bitmaps in Java](https://github.com/RoaringBitmap/RoaringBitmap), then [load them in Python](https://github.com/Ezibenroc/PyRoaringBitMap) modify them, and then load them again in Node.js before shipping them your [Go](https://github.com/RoaringBitmap/roaring) program. Not that anyone is doing it, but it is possible, in theory.

Anyhow, how is the performance of Roaring bitmaps in Node.js? We can compare them with [JavaScript&rsquo;s Set data structure](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Set) as well as against [FastBitSet.js](https://github.com/lemire/FastBitSet.js).
```JavaScript

 suite intersection size
  262144 elements
Set                   33.26 ops/sec
FastBitSet        14,364.56 ops/sec
RoaringBitmap32  266,718.85 ops/sec
  âž” Fastest is RoaringBitmap32

 suite intersection (in place)
  65536 elements
Set                    199.99 ops/sec
FastBitSet          93,394.64 ops/sec
RoaringBitmap32  4,720,764.58 ops/sec
  âž” Fastest is RoaringBitmap32

 suite intersection (new)
  1048576 elements
Set                  3.32 ops/sec
FastBitSet       1,436.14 ops/sec
RoaringBitmap32  3,557.16 ops/sec
  âž” Fastest is RoaringBitmap32

 suite union (in place)
  65536 elements
Set                  201.71 ops/sec
FastBitSet       147,147.28 ops/sec
RoaringBitmap32  497,687.77 ops/sec
  âž” Fastest is RoaringBitmap32

 suite union size
  262144 elements
 Set                   22.77 ops/sec
 FastBitSet         7,766.65 ops/sec
 RoaringBitmap32  274,167.71 ops/sec
  âž” Fastest is RoaringBitmap32

 suite union (new)
  1048576 elements
Set                  1.72 ops/sec
FastBitSet         698.26 ops/sec
RoaringBitmap32  2,033.11 ops/sec
  âž” Fastest is RoaringBitmap32
```


So Roaring bitmaps can be thousands of times faster than a native JavaScript Set. they can can be two orders of magnitude faster than FastBitSet.js. That Roaring bitmaps could beat FastBitSet.js is impressive: I wrote FastBitSet.js and it is fast!

Of course results will vary. No data structure is ever optimal in all use cases. But these numbers suggest that, in some cases, Roaring bitmaps will be useful in JavaScript.

What if you are not using Node.js. Maybe you are running your code in a browser? Salvatore Previti wrote a [WebAssembly](https://github.com/SalvatorePreviti/roaring-wasm) version as well, basically compiling the C code from the [CRoaring library](https://github.com/RoaringBitmap/CRoaring) into WebAssembly. The wrapper is still incomplete and it is unclear whether WebAssembly is mature enough to give you good performance, but, one day soon, it might be possible to have fast Roaring bitmaps in the browser.

