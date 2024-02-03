---
date: "2018-07-31 12:00:00"
title: "Getting 4 bytes or a full cache line: same speed or not?"
---



Many software operations are believed to be &ldquo;memory bound&rdquo;, meaning that the processor spins empty while waiting for data to come from memory. To compensate, our processors rely on fast cache memory. If your problem fits in cache, it will typically run much faster than if the processor constantly needs to query the memory subsystem.

If you need to retrieve a block of data, the processor does not retrieve just the necessary bytes. It retrieves data in units of a &ldquo;cache line&rdquo; which is typically 64 bytes on Intel processors. So the first 64 bytes of memory addresses are on the first cache line, the next 64 bytes are on the second cache line, and so forth.

To be clear, it means that you should not expect it to be faster to retrieve only 8 bytes of data rather than 64 bytes of data, assuming that all the data in question lies in a single cache line. That is what I expect most programmers to tell you.

Let me state this as a &ldquo;law&rdquo;:

> Given a large out-of-cache memory block, the time (latency) required to access 4, 8, 16 or 64 bytes of data from a cache line is the same.


How well does this mental model works in the real world?

Suppose that you build a large array of 32-bit integers. There are sixteen 32-bit integers per cache line. The array is large enough to exceed your cache by a wide margin. Then you repeatedly select a cache line at random and sum up a few 32-bit integers in the cache. Maybe you just pick one integer per cache line, maybe you pick four, maybe eight, maybe sixteen. Your code might look like the follow, where `percache` is the number of integer you access per cache line:
```C
uint32_t counter = 0;
for(size_t i = 0; i < howmany; i++) {
    size_t idx = pick_address_of_random_cache_line();
    // there are 16 uint32_t per 64-byte cache line...
    for(size_t j = 0; j < percache; j++) {
       counter += array[16 * idx + j];
    }
}
```


So, how sensitive is the running to the parameter <tt>percache</tt>? A simple theory is that if the array is large enough, it does not matter whether you access one, two, four or sixteen values per cache line.

Let us run an experiment to see. I generate an 8 GB array, it far exceeds my CPU cache. Then I vary the number of integers accessed per cache line, and I sum it all up.

Integer per cache line   |Cycles per cache line    |
-------------------------|-------------------------|
1                        |38                       |
4                        |60                       |
8                        |70                       |
16                       |110                      |


So even though I am randomly accessing cache lines, out of cache, whether I access one, eight, or sixteen 32-bit values per cache line matters a great deal.

To make things interesting, I can try to accelerate these operations by using SIMD instructions. SIMD instructions can do many additions at once. Let us see&hellip;

Integer per cache line   |Cycles per cache line    |
-------------------------|-------------------------|
8                        |35                       |
16                       |41                       |


Wow! So hand-tuned vectorized helped this problem a lot, even though I am randomly accessing cache lines from a large array.

Let me twist the problem around. After accessing each cache line, and updating my counter by summing up one, two, four, eight or sixteen value, I am going to change the state of my random number generator in a way that depends on the newly computed counter. This makes the problem harder for my computer because, before it can fetch the next cache line, it absolutely must wait for the computation of the counter to be finished.

Integer per cache line   |Cycles per cache line    |
-------------------------|-------------------------|
1                        |300                      |
4                        |310                      |
8                        |320                      |
16                       |330                      |


As we can see, the problem is about an order of magnitude harder. However, even then, whether I access one or sixteen values per cache line matters: the difference is about 10%. It is not negligible.

Thus it might be a lot harder than you expect to be &ldquo;memory bound&rdquo;. Counting the number of cache lines accessed is not a sane way to measure the efficiency of an out-of-cache algorithm.

[My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/07/31).

