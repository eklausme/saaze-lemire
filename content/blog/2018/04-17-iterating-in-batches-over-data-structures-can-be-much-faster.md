---
date: "2018-04-17 12:00:00"
title: "Iterating in batches over data structures can be much faster&#8230;"
---



We often need to iterate over the content of data structures. It is surprisingly often a performance bottleneck in big-data applications. Most iteration code works one value at a time&hellip;
```C
for value in datastructure {
  do something with value
}
```


There is a request to the data structure for a new value at each iteration. Alternatively, we can query the data structure far less often by asking the data structure to fill a buffer&hellip;
```C
for blockofvalues datastructure {
  for value in blockofvalues {
      do something with value
  }
}
```


It is not automatically faster: you have to store values to a buffer and then read them again. It involves copying data from registers to memory and back. There is some inherent latency and it is an extra step.

However, if you make your buffer large enough but not too large (e.g., 1kB), the latency will not matter much and you will remain in CPU cache (fast memory). Thus you should, in the worst case, be only slightly slower. What do I mean by &ldquo;slightly&rdquo;? Basically, you are adding the equivalent of a memory copy over a small buffer.
When accessing data over a network, or even across processes on the same machine, it worth it to process the data in batches because the cost of the transaction is high. When working in data structures that are in your own process, the transaction cost might be low. Repeated function calls in a loop are cheap, and they can become free after inlining. To my knowledge, batched iterations is not typically available in standard libraries.

Thus, until recently, I did not pay much attention to the idea of iterating in batches over data structures. I could imagine some gains, but I expected them to be small.

In the [Go implementation](https://github.com/RoaringBitmap/roaring) of [Roaring bitmaps](http://roaringbitmap.org), [Ben Shaw](https://github.com/cakey) contributed a way to iterate over values in batches, recovering many values in a buffer with each function call. It helped the performance considerably ([almost doubling the speed on some tests](https://github.com/RoaringBitmap/roaring/pull/150)). [Richard Startin](http://richardstartin.uk) then did the same in the [Java implementation](https://github.com/RoaringBitmap/RoaringBitmap). It also helped a lot:

> The batch iterator is always at least twice as fast as the standard iterator (&hellip;) Depending on the contents and size of the bitmap, the batch iterator can be 10x faster.


So I started to wonder&hellip; is this an underrated strategy?

I modified the popular [Go bitset library](https://github.com/willf/bitset/pull/62) and on some iteration test, the batched iteration was nearly twice as fast!

The batched code is more complex, but not so terrible:
```C
buffer := make([]uint, 256)
j := uint(0)
j, buffer = bitmap.NextSetMany(j, buffer)
for ; len(buffer) > 0; j, buffer = bitmap.NextSetMany(j, buffer) {
     for k := range buffer {
        // do something with buffer[k]
     }
     j += 1
}
```


Then I modified the [cbitset library](https://github.com/lemire/cbitset). I saw, again, almost a doubling of the speed. The code is once more a bit more complicated:
```C
size_t buffer[256];
size_t howmany = 0;
for(size_t startfrom = 0; 
         (howmany = nextSetBits(b1,buffer,256, &startfrom)) > 0 ;
          startfrom++) {
       for(size_t i = 0; i < howmany ; i++) {
         // do something with  buffer[i];
       }
}
```


These good results depend on what kind of data you iterate over, how you use the data, and what kind of data structure you have. Obviously, it is useless to batch iterations over an array of values. Yet my few tests provide enough evidence to conclude that batch iteration is worth investigating when speed is a limitation.

On Twitter, [Milosz Tanski explained the result as follows](https://twitter.com/mtanski/status/986318769227272192):

> One thing to remember about CPU and optimization in general is that almost hardware is designed to operate at maximum speed when it&rsquo;s doing similar work on similar data. Branch prediction, prefetch, caches, op code level parallelization all make this assumption.



